<?php
    session_start();
    $_SESSION['nombre'];
    $id_user = $_SESSION['idUsuario'];
    require_once "../../../core/conexion.php";
    $link       = conectarse();
    // VARIABLES 
    $fechad         = $_POST['inicio'];
    $fechah         = $_POST['fin'];
    $id             = $_POST['id'];
    $radicado       = $_POST['radicado'];
    $fechaFallo     = $_POST['fecha_fallo'];
    $cod_despacho   = $_POST['cod_despacho'];
    $flag_fallo     = $_POST['flag_fallo'];
      //echo "FD: ".$fechad." FH: ".$fechah." ID: ".$id." radi: ".$radicado." FF: ".$fechaFallo." cod_des: ".$cod_despacho." flag_fallo: ".$flag_fallo." ";
    if ( !empty($fechad) && !empty($fechah) ) {
        $filtrof = " AND (tut_fecha BETWEEN '$fechad' AND '$fechah') ";
    }
    if ( !empty($radicado) ) {
        $filtro1 = " AND tut_radicado LIKE '%$radicado%' ";
    }
    if ( !empty($id) ) {
        $filtro2 = " AND tut_id = '$id' ";
    }
    if ( !empty($cod_despacho) ) {
        $filtro3 = " AND tut_codi_despacho = '$cod_despacho' ";
    }
    if ( !empty($fechaFallo) ) {
        $filtro4 = " AND (tut_fecha_fallo = '$fechaFallo') ";
    }
    if ( !empty($flag_fallo) ) {
        if($flag_fallo == "no"){
            $flag_fallo =1;
        }else{
            $flag_fallo =0;
        }
        $filtro5 = " AND tut_flag_vencimiento = '$flag_fallo' ";
    }
//    if ( !empty($accionante) ) {
//        $filtro8 = " AND doc_parte_demandante LIKE '%$accionante%' ";
//    }
//    if ( !empty($accionado) ){
//        $filtro9 = " AND doc_parte_demandado LIKE '%$accionado%' ";
//    }
//    if ( !empty($doc_id_tipo) ){
//        $filtro10 = " AND doc_id_tipo = '$doc_id_tipo' ";
//    }
//    if ( !empty($doc_id_subtipo) ){
//        $filtro11 = " AND doc_id_subtipo = '$doc_id_subtipo' ";
//    }
    $filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtrof;
    //echo $filtrox;
    $sql="SELECT `tut_id`, `tut_id_usuario`, `tut_id_despacho`, `tut_fecha`, `tut_radicado`, `tut_despacho`, `tut_codi_despacho`, 
                `tut_clase`, `tut_subclase`, `tut_partes`, `tut_fecha_reparto`, `tut_hora_reparto`, `tut_fecha_vencimiento`, `tut_flag_vencimiento`,
                `tut_fecha_fallo`, `tut_id_usuario_falloE`, `tut_fechaE`
            FROM `reparto_tutelas` AS tu
            
            WHERE tut_id >= '1'" .$filtrox. " 
            ORDER BY tut_id DESC";
    
    $res=mysql_query($sql,$link);
    $num_filas = mysql_num_rows($res);
    if($num_filas>0){ 
        $alerta = "success";
        $mensaje = "LISTADO TUTELAS";
    }else{
        $alerta = "danger";
        $mensaje = "No existen datos registrados";
    }
    
    if(isset($id_user)){
?>
    <div class="alert alert-<?php echo $alerta; ?>" role="alert">Resultado Registros: <?php echo $num_filas;?> <strong><?php echo $mensaje; ?></strong></div>
        <table id="example_historial" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #4682B4; color: white;">
                    <th title="Código Interno Tutela">ID</th>
                    <th>Radicado</th>
                    <th>Juzgado</th>
                    <th title="Fecha Recibido en el Juzgado">Fecha Registro</th>
                    <th title="Fecha Vencimiento Tutela">Fecha Vencimiento</th>
                    <th title="Fecha Fallo Tutela">Fecha Fallo</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row=mysql_fetch_array($res)){ ?>
                    <tr>
                        <td><?php echo $row['tut_id']; ?></td>
                        <td><?php echo $row['tut_radicado']; ?></td>
                        <td><?php echo $row['tut_despacho']; ?></td>
                        <td><?php echo $row['tut_fecha']; ?></td>
                        <td><?php echo $row['tut_fecha_vencimiento']; ?></td>
                        <?php
                            if($row['tut_fecha_fallo'] <= $row['tut_fecha_vencimiento'] && $row['tut_fecha_fallo'] !=""){
                                $alerta= "alert-success";
                            }else if($row['tut_fecha_fallo'] > $row['tut_fecha_vencimiento']){
                                $alerta= "alert-danger";
                            }else{
                                $alerta= "alert-default";
                            }
                        ?>
                        <td class="alert <?php echo $alerta; ?>"><?php echo $row['tut_fecha_fallo']; ?></td>
                    </tr>
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
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>