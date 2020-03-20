<?php
    session_start();
    $_SESSION['nombre'];
    
    $id_user    = $_SESSION['idUsuario'];
    $fechad     = $_POST['fechaI'];
    $fechah     = $_POST['fechaF'];
    $datox1     = $_POST['radicado'];
    $datox5     = $_POST['id'];
    $datox6     = $_POST['juzgado'];
    $parte1     = $_POST['demandante'];
    $parte2     = $_POST['demandado'];

    require_once "../../core/conexion.php";
    $link=conectarse(); 
    if ( !empty($fechad) && !empty($fechah) ) {
        $filtrof = " AND (pre_fecha BETWEEN '$fechad' AND '$fechah') ";
    }
    if ( !empty($datox1) ) {
        $filtro1 = " AND pre_radicado LIKE '%$datox1%' ";
    }

    if ( !empty($datox5) ) {
        $filtro5 = " AND pre_id = '$datox5' ";
    }
    if ( !empty($datox6) ) {
        $filtro6 = " AND pre_radicado LIKE '%$datox6%' ";
    }
    
    if ( !empty($accionante) ) {
        $filtro8 = " AND pre_demandante LIKE '%$accionante%' ";
    }
    if ( !empty($accionado) ){
        $filtro9 = " AND pre_demandado LIKE '%$accionado%' ";
    }
    
    $filtrox = $filtro1." ".$filtro5." ".$filtro6." ".$filtro8." ".$filtro9." ".$filtrof;

    $sql="SELECT *
        FROM archivo_prestamo_proceso AS pre
        INNER JOIN pa_usuario AS us ON pre.pre_id_usuario = us.id    
        WHERE pre_id >= '1'" .$filtrox. " 
        ORDER BY pre_id DESC";
    
    $res=mysql_query($sql,$link);
    $num_filas = mysql_num_rows($res);
    if($num_filas>0){ 
        $alerta = "success";
        $mensaje = "SOLICITUDES PRESTAMOS";
    }else{
        $alerta = "danger";
        $mensaje = "No existen datos registrados";
    }
    if(isset($id_user)){
?>
        <div class="alert alert-<?php echo $alerta; ?>" role="alert">Resultado Registros: <?php echo $num_filas;?> <strong><?php echo $mensaje; ?></strong></div>
        <table id="example" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr class="alert-info">
                    <th title="Código Interno Solicitud">ID</th>
                    <th>Fecha</th>
                    <th>Juzgado</th>
                    <th>Radicado</th>
                    <th>Demandante</th>
                    <th>Demandado</th>
                    <th>Archivo</th>
                    <th>Observaciones</th>
                    <th title="Usuario Registra">Registra</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row=mysql_fetch_array($res)){ ?>
                    <tr>
                        <td><?php echo $row['pre_id']; ?></td>
                        <td><?php echo $row['pre_fecha']; ?></td>
                        <td><?php echo $row['pre_juzgado']; ?></td>
                        <td><?php echo $row['pre_radicado']; ?></td>
                        <td><?php echo $row['pre_demandante']; ?></td>
                        <td><?php echo $row['pre_demandado']; ?></td>
                        <td><?php echo $row['pre_info_archivo']; ?></td>
                        <td><?php echo $row['pre_observaciones']; ?></td>
                        <td><?php echo $row['empleado']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>