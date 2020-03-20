<?php
    require_once "../../../core/conexion.php";
    require_once "../../../model/proceso_model.php";
    $link=conectarse();
    $inicio     = $_POST['inicio'];
    $fin        = $_POST['fin'];
    $user       = $_POST['user'];
    $radicado   = $_POST['radicado'];
    
    
    $modelo               = new Proceso();
    $us                   = $_SESSION['idUsuario'];
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '19';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
    

    if ( !empty($inicio) && !empty($fin) ) {
        $inicio     = $_POST['inicio']." 00:00:00.000";
        $fin        = $_POST['fin']." 00:00:00.000";
        $filtroFecha = " AND [A103FECHPROC] BETWEEN '$inicio' AND '$fin'  ";
    }
    if (!empty($radicado)){
        $filtroRadi = " AND [A103LLAVPROC] LIKE '%$radicado%'  ";
    }
    $filtro_final = $filtroFecha." ".$filtroRadi;
    //echo $filtro_final;
    // CONSULTA SQL LOCAL
    //$sql="SELECT * FROM pa_base_datos WHERE id =6";
    // CONSULTA SQL REAL
    $sql="SELECT * FROM pa_base_datos WHERE id =7";
    $res=mysql_query($sql,$link);
    while($row=mysql_fetch_array($res)){ 
        $datosbd_1 = $row['ip'];
        $datosbd_2 = $row['bd'];
        $datosbd_3 = $row['usuario'];
        $datosbd_4 = $row['clave'];
    }
    $serverName = $datosbd_1; //serverName\instanceName
    $connectionInfo = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    $sql = ("SELECT * FROM [$datosbd_2].[dbo].[T103DAINFOPROC] WHERE 
            [A103CODICLAS] IN (0000, 0005, 0013,0014, 0517, 2005, 3001, 3002,3003,3004,3005,3006,3007,3008,3009,3010,3011, 3015,3016, 3051, 3052,3053,3054,3055,3056,3057,3058,3063,3064,3065,3066,3067,3068,3988,3999,5007, 6001,6002,6003,6004,6005,6006,6008,6014,6015,6016,6018,6019,6020,6021,6022,8023,9013,9910,9911,9912,9913,9914,9915)  
            " .$filtro_final. "
			AND [A103CODIESPO] IN (03,10)
            ORDER BY [A103FECHPROC] DESC;");

    $params  = array();
    $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $sql , $params, $options );
    $stmt1 = sqlsrv_query( $conn, $sql , $params, $options );
    while( $row = sqlsrv_fetch_array( $stmt1)){
        $datos_arreglo[]="'".$row['A103LLAVPROC']."'";
    }
    $datos = implode(",", $datos_arreglo);
?>
    <table id="example1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Radicado</th>
                <th>
                    <a href="?c=proceso&a=Bloquear_conjunto&arreglo_radicado=<?php echo $datos ?>&dato_u=<?php echo $user; ?>" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-ban-circle icon-warning"></span> BLOQUEAR</a>
                </th>
                <th>
                    <?php if ( in_array($us,$usuariosa) ) { ?>
                        <a href="?c=proceso&a=Desbloquear_conjunto&arreglo_radicado=<?php echo $datos ?>&dato_u=<?php echo $user; ?>" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-ok-circle icon-success"></span> DESBLOQUEAR</a>
                    <?php }else{ echo "SOLICITAR DESBLOQUEAR"; } ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php while( $row = sqlsrv_fetch_array( $stmt)){ ?>
                <tr>
                    <td>
                        <?php 
                            echo $row['A103LLAVPROC']; 
                            if($row['A103FLAGPROC'] == 1 ){
                                echo ' <i class="glyphicon glyphicon-flag" aria-hidden="true" style="color:red"></i>';
                            }
                        ?>
                    </td>
                    <td>
                        <?php if($row['A103FLAGPROC'] == 0 ){ ?>
                            <a href="?c=proceso&a=Ocultar&radicado=<?php echo $row['A103LLAVPROC']; ?>&dato_u=<?php echo $user; ?>">Bloquear</a>
                        <?php } ?>    
                    </td>
                    <td>
                        <?php if ( in_array($us,$usuariosa) ) { ?>
                            <?php if($row['A103FLAGPROC'] == 1 ){ ?>
                                <a href="?c=proceso&a=Ver&radicado=<?php echo $row['A103LLAVPROC']; ?>&dato_u=<?php echo $user; ?>">Desbloquear</a>
                            <?php } ?> 
                        <?php } ?> 
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>