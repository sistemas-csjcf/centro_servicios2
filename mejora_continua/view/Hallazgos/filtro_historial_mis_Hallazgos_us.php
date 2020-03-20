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
        $filtro1 = " AND hal_id_user_responsable = '$id_responsable' ";
    }
    if ( !empty($fechaI) && !empty($fechaF) ) {		
        $filtro2 = " AND (hal_fecha_limite BETWEEN '$fechaI' AND '$fechaF') ";
    }
    if ( !empty($id) ) {
        $filtro4 = " AND hal_id = '$id' ";
    }
    $filtrox = $filtro1." ".$filtro2." ".$filtro4;
   
    $sql=("SELECT * 
        FROM mc_historial_Hallazgos
        WHERE hal_id > '0' " .$filtrox. " ORDER BY hal_id DESC");
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
                    <th title="Código Interno Hallazgo" style="width:12px;">ID</th>
                    <th style="width:10px;">Fecha Tarea</th>
                    <th style="width:10px;" title="Fecha Limite">Fecha Limite</th>
                    <th style="width:10px;" title="Fecha Gestiòn">Fecha Gestión</th>
                    <th title="Despacho Solicitante" style="width:12px;">Solicitante</th>
                    <th title="Descripción del Hallazgo" style="width:120px;">Descripción Hallazgo</th>
                    <th style="width:12px;">Documento</th>
                    <th title="Descripción de la Gestión" style="width:120px;">Descripción Gestión</th>
                    <th style="width:12px;">Documento</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=0; $i <$num_filas; $i++){ ?>
                   <?php while ($r = mysql_fetch_array($result)){ ?>
                        <tr>
                            <td>
                                <?php echo $r['hal_id']; ?>
                                <?php if($r['hal_estado'] > 0){ ?>
                                    <i class="icon-checkmark" aria-hidden="true" style="color: green" title="Tarea Gestionada"></i>
                                <?php }else{ ?>
                                    <i class="glyphicon glyphicon-info-sign" aria-hidden="true" style="color: goldenrod" title="Tarea En Tramite"></i>
                                <?php } ?>
                            </td>
                            <td><?php echo $r['hal_fecha']; ?></td>
                            <td><?php echo $r['hal_fecha_limite']; ?></td>
                            <td><?php echo $r['hal_fecha_gestion']; ?></td>
                            <td>
                                <?php 
                                    if($r['hal_id_userE'] >0){
                                        $datos_user = $modelo->get_dato_Usuario1($r['hal_id_userE']);
                                        $get_user   = $datos_user->fetch();
                                        echo $get_user['empleado']; 
                                    }else{
                                        echo $r['empleado']; 
                                    }
                                ?>
                            </td>
                            <td><button class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal_Ver_M" data-descripcion="<?php echo $r['hal_descripcion']; ?>" ><i class="icon-zoom-in" style="font-size: 20px;" title="Ver Descripción"> </i></button></td>
                            <td>
                                <?php if($r['hal_ruta_doc'] !=""){ ?>
                                    <a href="void()" class="btn btn-default" onclick="ver_doc_adjunto(3,'<?php echo $r['hal_ruta_doc']; ?>');return false;" target="_blank" title="Descargar Documento Adjunto"><span class="icon icon-download3" style="font-size: 18px; color: #009900;"></span></a>
                                <?php }else{ ?>
                                    <span class="icon-blocked" style="color: red; font-size: 18px;" title="Sin Documento Adjunto"></span>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if($r['hal_descripcion_gestion'] !=""){ ?>
                                    <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal_Ver_MG" data-obs_gestion="<?php echo $r['hal_descripcion_gestion']; ?>" ><i class="icon-zoom-in" style="font-size: 20px;" title="Ver Descripción"> </i></button>
                                <?php }else{ ?>
                                    <span class="icon-blocked" style=" font-size: 19px;" title="Sin Documento Adjunto"></span>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if($r['hal_ruta_doc_gestion'] !=""){ ?>
                                    <a href="void()" class="btn btn-default" onclick="ver_doc_adjunto(4,'<?php echo $r['hal_ruta_doc_gestion']; ?>');return false;" target="_blank" title="Descargar Documento Adjunto"><span class="icon icon-download3" style="font-size: 18px;"></span></a>
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