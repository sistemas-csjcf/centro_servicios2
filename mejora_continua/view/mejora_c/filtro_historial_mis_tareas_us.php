<?php
    session_start();
    $_SESSION['nombre'];
    $id_user = $_SESSION['idUsuario'];
    require_once "../../core/conexion.php";
    require_once "../../model/mejora_continua_model.php";
    $modelo  = new mejora_c();
    $lista_us_all   = $modelo->get_Responsable_lider($_SESSION['id_proceso_cs'] );
    while($row = $lista_us_all->fetch()){ 
        $us_areas[] = $row[0];
    }
    $us_area    = implode(",", $us_areas);
    $link       = conectarse();
    $id             = $_POST['id'];
    $fechaI         = $_POST['inicio'];
    $fechaF         = $_POST['fin'];
    $id_responsable = $_POST['id_responsable'];
    
    if ( !empty($id_responsable) ) {
        $filtro1 = " AND tar_id_user_responsable = '$id_responsable' ";
    }else{
        $filtro1 = " AND tar_id_user_responsable IN ($us_area) ";
    }
    if ( !empty($fechaI) && !empty($fechaF) ) {		
        $filtro2 = " AND (tar_fecha_limite BETWEEN '$fechaI' AND '$fechaF') ";
    }
    if ( !empty($id) ) {
        $filtro4 = " AND tar_id = '$id' ";
    }
    $filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4;
   
    $sql=("SELECT * 
        FROM mc_historial_tareas_admin
        WHERE tar_id > '0' " .$filtrox. " ORDER BY tar_id DESC");
    $result=mysql_query($sql,$link);
    
    $num_filas = mysql_num_rows($result); 
    if($num_filas>0){
        $alerta  = "success";
        $mensaje = "";
    }else{
        $alerta  = "danger";
        $mensaje = "No existen datos registrados";
    }
    if(isset($id_user)){
?>
        <div class="alert alert-<?php echo $alerta; ?>" role="alert">Total Registros: <strong><?php echo $num_filas;?> <?php echo $mensaje; ?></strong></div>
        <table id="example4" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #B71F56; color: white;">
                    <th style="width:12px;" title="Código Interno Acción de Gestión">ID</th>
                    <th style="width:10px;">Fecha Tarea</th>
                    <th style="width:10px;" title="Fecha Limite">Fecha Limite</th>
                    <th style="width:10px;" title="Fecha Gestiòn">Fecha Gestión</th>
                    <th style="width:12px;" title="Despacho Solicitante">Solicitante</th>
                    <th style="width:12px;" title="Descripción de la Acción de Gestión">Descripción</th>
                    <th style="width:12px;">Documento</th>
                    <th style="width:120px;" title="Descripción de la Gestión" >Descripción Gestión</th>
                    <th style="width:12px;">Documento</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=0; $i <$num_filas; $i++){ ?>
                   <?php while ($r = mysql_fetch_array($result)){ ?>
                        <tr>
                            <td>
                                <?php echo $r['tar_id']; ?>
                                <?php if($r['tar_estado'] > 0){ ?>
                                    <i class="icon-checkmark" aria-hidden="true" style="color: green" title="Tarea Gestionada"></i>
                                <?php }else{ ?>
                                    <i class="glyphicon glyphicon-info-sign" aria-hidden="true" style="color: goldenrod" title="Tarea En Tramite"></i>
                                <?php } ?>
                            </td>
                            <td><?php echo $r['tar_fecha']; ?></td>
                            <td><?php echo $r['tar_fecha_limite']; ?></td>
                            <td><?php echo $r['tar_fecha_gestion']; ?></td>
                            <td>
                                <?php 
                                    if($r['tar_id_userE'] >0){
                                        $datos_user = $modelo->get_dato_Usuario1($r['tar_id_userE']);
                                        $get_user   = $datos_user->fetch();
                                        echo $get_user['empleado']; 
                                    }else{
                                        echo $r['empleado']; 
                                    }
                                ?>
                            </td>
                            <td><button class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal_Ver_M" data-descripcion="<?php echo $r['tar_descripcion']; ?>" ><i class="icon-zoom-in" style="font-size: 20px;" title="Ver Descripción"> </i></button></td>
                            <td>
                                <?php if($r['tar_ruta_doc'] !=""){ ?>
                                    <a href="void()" class="btn btn-default" onclick="ver_doc_adjunto(1,'<?php echo $r['tar_ruta_doc']; ?>');return false;" target="_blank" title="Descargar Documento Adjunto"><span class="icon icon-download3" style="font-size: 18px; color: #009900;"></span></a>
                                <?php }else{ ?>
                                    <span class="icon-blocked" style="color: red; font-size: 18px;" title="Sin Documento Adjunto"></span>
                                <?php } ?>
                            </td>
                            <td><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal_Ver_MG" data-obs_gestion="<?php echo $r['tar_descripcion_gestion']; ?>" ><i class="icon-zoom-in" style="font-size: 20px;" title="Ver Descripción"> </i></button></td>
                            <td>
                                <?php if($r['tar_ruta_doc_gestion'] !=""){ ?>
                                    <a href="void()" class="btn btn-default" onclick="ver_doc_adjunto(2,'<?php echo $r['tar_ruta_doc_gestion']; ?>');return false;" target="_blank" title="Descargar Documento Adjunto"><span class="icon icon-download3" style="font-size: 18px;"></span></a>
                                <?php }else{ ?>
                                    <span class="icon-blocked" style="color: red; font-size: 18px;" title="Sin Documento Adjunto"> </span>
                                <?php } ?>
                            </td>
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
<?php header( "refresh:2; url=http://172.16.175.30/centro_servicios2" ); } 