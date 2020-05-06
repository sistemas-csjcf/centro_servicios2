<?php
    session_start();
    $_SESSION['nombre'];
    $id_user = $_SESSION['idUsuario'];
    require_once "../../../core/conexion.php";
    $link       = conectarse();
    $id         = $_POST['id'];
    $fechaI     = $_POST['inicio'];
    $fechaF     = $_POST['fin'];
    $estado     = $_POST['estado'];
    
    if ( !empty($id_user) ) {	
        $filtro1 = " AND tar_id_user = '$id_user' ";
    }
    if ( !empty($fechaI) && !empty($fechaF) ) {		
        $filtro2 = " AND (tar_fecha BETWEEN '$fechaI' AND '$fechaF') ";
    }
    if ( $estado != '') {
        $filtro3 = " AND tar_estado = '$estado' ";
    }
    if ( !empty($id) ) {	
        $filtro4 = " AND tar_id = '$id' ";
    }
    $filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4;
   
    $sql=("SELECT *
        FROM mc_tareas
        WHERE tar_id > '0'" .$filtrox. " ORDER BY tar_id DESC");
    $result=mysql_query($sql,$link);
    
    $num_filas = mysql_num_rows($result); 
     if($num_filas>0){ 
        $alerta = "success";
        $mensaje = "";
    }else{
        $alerta = "danger";
        $mensaje = "No existen datos registrados";
    }
    if(isset($id_user)){
?>
        <div class="alert alert-<?php echo $alerta; ?>" role="alert">total Registros: <strong><?php echo $num_filas;?> <?php echo $mensaje; ?></strong></div>
        <table id="example4" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #B71F56; color: white;">
                    <th style="width:12px;" title="Còdigo Solicitud">ID</th>
                    <th style="width:180px;" title="Fecha Solicitud">Fecha Solicitud</th>
                    <th>Descripciòn</th>
                    <th>Adjunto</th>
                    <th>Estado</th>
                    <th style="width:60px;">Gestión</th>
                    <th style="width:60px;" title="Documento Adjunto Gestión">Adjunto</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=0; $i <$num_filas; $i++){ ?>
                   <?php while ($r = mysql_fetch_array($result)) { ?>
                        <tr>
                            <td><?php echo $r['tar_id'] ?></td>
                            <td><?php echo $r['tar_fecha'] ?></td>
                            <td><?php echo $r['tar_descripcion'] ?></td>
                            <td>
                                <?php if($r['tar_ruta_doc'] !=""){ ?>
                                    <a href="void()" class="btn btn-default" onclick="ver_doc_adjunto(1,'<?php echo $r['tar_ruta_doc']; ?>');return false;" target="_blank" title="Descargar Documento Adjunto"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a>
                                <?php }else{ ?>
                                    <span class="icon-blocked" style="color: red; font-size: 18px;" title="Sin Documento Adjunto"> </span>
                                <?php } ?>
                            </td>
                            
                            <?php
                            if($r['tar_estado'] == 0 ){
                                $alerta= "alert-warning";
                                $mensaje ="Pendiente";
                                $show = 0;
                            }else if($r['tar_estado'] == 1){
                                $alerta= "alert-success";
                                $mensaje ="Gestinada";
                                $show = 1;
                            }else{
                                $alerta= "alert-danger";
                                $mensaje ="-";
                                $show = 0;
                            }
                        ?>
                        <td class="alert <?php echo $alerta; ?>"><?php echo $mensaje; ?></td>
                        <?php if($show == 0){ ?>
                            <td><span class="icon-hour-glass" title="Pendiente" style="font-size: 18px;"></span></td>
                            <td><span class="icon-blocked" style="color: red; font-size: 18px;" title="Sin Documento Adjunto"> </span></td>
                        <?php }else{  ?>
                            <td><?php echo $r['tar_descripcion_gestion']; ?></td>
                            <td><a href="void()" class="btn btn-default" onclick="ver_doc_adjunto(2,'<?php echo $r['tar_ruta_doc_gestion']; ?>');return false;" target="_blank" title="Descargar Documento Adjunto"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a></td>
                        <?php } ?>
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