<?php
    session_start();
    $_SESSION['nombre'];
    $id_user = $_SESSION['idUsuario'];
    require_once "../../core/conexion.php";
    $link=conectarse();
    
    $radicado   = $_POST['radi'];
    //echo "rad ".$radicado;
    
    // CONSULTA SQL LOCAL
    $sql="SELECT * FROM pa_base_datos WHERE id =7";
    // CONSULTA SQL REAL
    //$sql="SELECT * FROM pa_base_datos WHERE id =3";
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
    
    $sql = ("SELECT 
                 info_pro.[A103LLAVPROC]
                ,info_pro.[A103CODIAREA]
                ,info_pro.[A103CODIPROC]
                ,info_pro.[A103CODICLAS]
                ,info_pro.[A103CODISUBC]
                ,info_pro.[A103CODIESPO]
                ,info_pro.[A103CODIPONE]
                ,info_pro.[A103NOMBPONE]
                ,pro_clas.[A053CODICLAS]
                ,pro_clas.[A053DESCCLAS]
                ,sub_clas.[A071CODISUBC]
                ,sub_clas.[A071DESCSUBC]
            FROM [$datosbd_2].[dbo].[T103DAINFOPROC] AS info_pro
            INNER JOIN [$datosbd_2].[dbo].[T053BACLASGENE] AS pro_clas
            ON info_pro.[A103CODICLAS] = pro_clas.[A053CODICLAS]
            INNER JOIN [$datosbd_2].[dbo].[T071BASUBCGENE] AS sub_clas
            ON info_pro.[A103CODISUBC] = sub_clas.[A071CODISUBC]
            WHERE info_pro.[A103LLAVPROC] = "."'$radicado'".";");
    $params  = array();
    $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $sql , $params, $options );
    
    while( $row = sqlsrv_fetch_array( $stmt)){
        $ponente            = htmlentities($row['A103NOMBPONE']);
        $clase_proceso      = htmlentities($row['A053DESCCLAS']);
        $subclase_proceso   = htmlentities($row['A071DESCSUBC']);
    }
    $num_filas = sqlsrv_num_rows( $stmt );
    //echo $class;
    $sql_partes = ("
            SELECT 
                info_suje.[A112LLAVPROC]
                ,info_suje.[A112CODISUJE]
                ,info_suje.[A112NUMESUJE]
                ,info_suje.[A112NOMBSUJE]
                ,tipo_suje.[A057CODISUJE]
                ,tipo_suje.[A057DESCSUJE]
                FROM [$datosbd_2].[dbo].[T112DRSUJEPROC] AS info_suje
                INNER JOIN [$datosbd_2].[dbo].[T057BASUJEGENE] AS tipo_suje
                ON info_suje.[A112CODISUJE] = tipo_suje.A057CODISUJE
                WHERE info_suje.[A112LLAVPROC] = "."'$radicado'".";");
    
    $stmt1 = sqlsrv_query( $conn, $sql_partes , $params, $options );  
    $num_filas_p = sqlsrv_num_rows( $stmt1 );
    if($num_filas>0){ 
        $alerta = "success";
        $mensaje = "PARTES DEL PROCESO";
        $bandera = "1";
    }else{
        $alerta = "danger";
        $mensaje = "Resultado";
        $bandera = "0";
    }
    
    if($num_filas_p>0){ 
        $alerta_p = "info";
    }else{
        $alerta_p = "danger";
    }
    $query="SELECT count(*) AS cantidad_registros FROM visitas_programacion WHERE vis_pro_radicado = '$radicado'";
    $rs=mysql_query($query,$link);
    while($fila=mysql_fetch_array($rs)){ 
        $num_vis_pro = $fila['cantidad_registros'];
    }
    if(isset($id_user)){
?>
    <?php if($num_vis_pro > 0){ ?>
        <div class="alert alert-warning alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>ADVERTENCIA!</strong> Ya existe una solicitud con este número de RADICADO.
        </div>
    <?php } ?>
    <input type="hidden" name="id_usuarioR" value="<?php echo $id_user; ?>">
    <input type="hidden" name="solicitante" value="<?php echo $ponente; ?>">
    <input type="hidden" name="clase_proceso" value="<?php echo $clase_proceso; ?>">
    <input type="hidden" name="sub_clase" value="<?php echo $subclase_proceso; ?>">
    <input type="hidden" name="bandera" value="<?php echo $bandera; ?>" required="">
    <div class="alert alert-<?php echo $alerta; ?>" role="alert">Resultado Registros: <?php echo $num_filas; ?></div>
        <table id="example1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Solicitante</th>
                    <th>Clase Proceso</th>
                    <th>Sub Clase</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $ponente ?></td>
                    <td><?php echo $clase_proceso ?></td>
                    <td><?php echo $subclase_proceso ?></td>
                </tr>
            </tbody>
        </table>
        <div class="alert alert-<?php echo $alerta_p; ?>" role="alert"> <?php echo $mensaje; ?></div>
        <table id="example2" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Cod. Parte</th>
                    <th># Documento</th>
                    <th>Nombre</th>
                    <th>Tipo Parte</th>
                </tr>
            </thead>
            <tbody>
                <?php while( $row = sqlsrv_fetch_array( $stmt1)){ ?>
                    <?php
                        $parte_proceso []= $row['A112NUMESUJE']."//".htmlentities($row['A112NOMBSUJE'])."***".htmlentities($row['A057DESCSUJE']."*****");
                    ?>
                    <tr>
                        <td><?php echo $row['A112CODISUJE']; ?></td>
                        <td><?php echo $row['A112NUMESUJE']; ?></td>
                        <td><?php echo htmlentities($row['A112NOMBSUJE']); ?></td>
                        <td><?php echo htmlentities($row['A057DESCSUJE']); ?></td>
                    </tr>
                <?php }  $datos_partes = implode("",$parte_proceso);?>
                <?php if($num_vis_pro > 0){ ?>
                    <script type="text/javascript">alert("Ya existe una solicitud con este número de RADICADO");</script>
                <?php } ?>
            </tbody>
        </table>
        <input type="hidden" name="datos_partes" value="<?php echo $datos_partes; ?>">
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.30/centro_servicios2" ); } ?>