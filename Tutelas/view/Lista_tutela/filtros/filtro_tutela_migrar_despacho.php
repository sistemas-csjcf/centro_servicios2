<?php
    session_start();
    $_SESSION['nombre'];
    $id_user = $_SESSION['idUsuario'];
    require_once "../../../core/conexion.php";
    $link       = conectarse();
    $fechad     = $_POST['inicio'];
    $fechah     = $_POST['fin'];
    
    $query_J="SELECT cod_juzgado FROM pa_juzgado WHERE cod_usuario_juzgado ='$id_user'";
    $rs_J=mysql_query($query_J,$link);
    while($r=mysql_fetch_array($rs_J)){ 
        $cod_juzgado = $r[0];
    }
    $entidad        = substr($cod_juzgado, 5,2);
    $especialidad   = substr($cod_juzgado, 7,2);
    $num_juzgado    = substr($cod_juzgado, 9);
    
    $datos_tutelas_migradas ="SELECT tut_radicado FROM reparto_tutelas WHERE tut_codi_despacho = '$cod_juzgado'";
    $rs_tutelasM=mysql_query($datos_tutelas_migradas,$link);
    while($r=mysql_fetch_array($rs_tutelasM)){
        $tutelas_migradas_despacho[] = $r[0];
    }
    $sql="SELECT * FROM pa_base_datos WHERE id =7";
    $res=mysql_query($sql,$link);
    while($row=mysql_fetch_array($res)){ 
        $datosbd_1 = $row['ip'];
        $datosbd_2 = $row['bd'];
        $datosbd_3 = $row['usuario'];
        $datosbd_4 = $row['clave'];
    }
    $serverName = $datosbd_1; //serverName\instanceName
    
    //$connectionInfo = array( "Database"=>$datosbd_2);
    $connectionInfo = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    
    $sql = ("SELECT [A103LLAVPROC],[A103ANOTACTS],[A103FECHREPA],[A103CIUDRADI],[A103ENTIRADI],[A103ESPERADI],[A103NUENRADI],[A103CODIPROC],
                [A103CODICLAS],[A103CODIPONE],[A103NOMBPONE] ,[A103HORAREPA]
            FROM [$datosbd_2].[dbo].[T103DAINFOPROC]
            WHERE ( [A103FECHREPA] BETWEEN convert(datetime, '$fechad' , 121) AND convert(datetime, '$fechah' , 121) )
            AND [A103CODIPROC]= '3009' AND [A103CODICLAS]='0007'
            AND [A103ENTIRADI]= '$entidad' AND [A103ESPERADI]= '$especialidad' 
            AND [A103NUENRADI]= '$num_juzgado';");

    $params  = array();
    $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $sql , $params, $options );
    $num_filas = sqlsrv_num_rows( $stmt );
    
    while( $row = sqlsrv_fetch_array($stmt)){
        $radi[]     = $row['A103LLAVPROC'];
        $fecha[]    = date_format($row['A103FECHREPA'],'Y-m-d');
        $hora[]     = $row['A103HORAREPA'];
        $ponente[]  = $row['A103NOMBPONE'];
        $despacho[] = $row['A103CIUDRADI'].$row['A103ENTIRADI'].$row['A103ESPERADI'].$row['A103NUENRADI'];
    }
    $matriz =  array ($radi, $ponente, $fecha, $hora);
    //print_r($matriz);
    if(isset($id_user)){
?>
        <table id="example4" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #4682B4; color: white;">
                    <th>Radicado</th>
                    <th>Juzgado</th>
                    <th>Fecha</th>
                    <th style="width:120px;">Hora</th>
                    <th>Migrar</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=0; $i <$num_filas; $i++){ ?>
                   <?php if(in_array($matriz[0][$i], $tutelas_migradas_despacho)){}else{ ?>
                        <tr>
                            <td><?php echo $matriz[0][$i]; ?></td>
                            <td><?php echo $matriz[1][$i]; ?></td>
                            <td><?php echo $matriz[2][$i]; ?></td>
                            <td><?php echo $matriz[3][$i]; ?></td>
                            <td><a href="?c=tutela&a=Migrar&id_Rd=<?php echo $matriz[0][$i]; ?>&flag_rtn=22" style="text-decoration: none;" title="Migrar tutela"><i class="icon-download" style="font-size: 20px;"></i></a></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
        <script>
            $(document).ready(function() {
                $('#example4').DataTable();
                $('#example_historial').DataTable({
                    "order": [[ 0, "desc" ]]
                });
            } );
            $('.selectpicker').selectpicker({
                style: 'btn-info',
                size: 4
            });
        </script> 
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.30/centro_servicios2" ); } ?>