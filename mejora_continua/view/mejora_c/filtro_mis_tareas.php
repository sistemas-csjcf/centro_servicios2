<?php
    session_start();
    $_SESSION['nombre'];
    $id_user = $_SESSION['idUsuario'];
    require_once "../../core/conexion.php";
    require_once "../../model/mejora_continua_model.php";
    $modelo  = new mejora_c();
    
    $link   = conectarse();
    $id     = $_POST['id'];
    $fechaI = $_POST['inicio'];
    $fechaF = $_POST['fin'];
    
    if ( !empty($id_user) ) {	
        $filtro1 = " AND tar_id_user_responsable = '$id_user' ";
    }
    if ( !empty($fechaI) && !empty($fechaF) ) {		
        $filtro2 = " AND (tar_fecha_limite BETWEEN '$fechaI' AND '$fechaF') ";
    }
    if ( !empty($id) ) {	
        $filtro4 = " AND tar_id = '$id' ";
    }
    $filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4;
   
    $sql=("SELECT DATEDIFF(tar_fecha_limite, NOW())AS diferencia, `tar_id`, `tar_fecha`,`tar_id_user`, `tar_id_user_responsable`, 
                    `tar_descripcion`, `tar_ruta_doc`, `tar_fecha_gestion`,`tar_estado`, `tar_fecha_limite`, us.empleado, tar_id_userE 
            FROM `mc_tareas` AS ta
            INNER JOIN pa_usuario AS us ON ta.tar_id_user = us.id
        WHERE tar_id > '0' AND tar_estado =0 " .$filtrox. " ORDER BY tar_id DESC");
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
                    <th title="Código Interno Tarea" style="width:12px;">ID</th>
                    <th style="width:10px;">Fecha Límite</th>
                    <th title="Solicitante" style="width:12px;">Solicitante</th>
                    <th title="Descripción de la Tarea" style="width:120px;">Descripción</th>
                    <th style="width:12px;" title="Documento Adjunto Tarea">Documento</th>
                    <th title="Gestionar Tarea" style="width:12px;">Gestionar</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=0; $i <$num_filas; $i++){ ?>
                   <?php while ($r = mysql_fetch_array($result)){ ?>
                        <tr>
                            <td>
                                <?php
                                    echo $r['tar_id']; 
                                    if($r['diferencia'] > 2){ 
                                        $flag="green";
                                    }else if($r['diferencia'] < 0){
                                        $flag="red";
                                    }else if($r['diferencia'] >=0 && $r['diferencia'] <3){
                                        $flag="goldenrod";
                                    }
                                ?>
                                <i class="fa fa-flag" aria-hidden="true" style="font-size: 20px; color: <?php echo $flag; ?>" title="Tarea En Tramite"></i>
                            </td>
                            <td><?php echo $r['tar_fecha_limite'] ?></td>
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
                            <td><button class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal_Ver_M" data-descripcion="<?php echo $r['tar_descripcion'] ?>" ><i class="icon-zoom-in" style="font-size: 20px;" title="Ver Descripción"> </i></button></td>
                            <td>
                                <?php if($r['tar_ruta_doc'] !=""){ ?>
                                    <a href="void()" class="btn btn-default" onclick="ver_doc_adjunto(1,'<?php echo $r['tar_ruta_doc']; ?>');return false;" target="_blank" title="Descargar Documento Adjunto"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a>
                                <?php }else{ ?>
                                    <span class="icon-blocked" style="color: red; font-size: 18px;" title="Sin Documento Adjunto"></span>
                                <?php } ?>
                            </td>
                            <td><button class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModalGestionarTask" data-id="<?php echo $r['tar_id']; ?>" data-fecha_limite="<?php echo $r['tar_fecha_limite']; ?>" data-descripcion="<?php echo $r['tar_descripcion']; ?>" ><i class="glyphicon glyphicon-folder-open" style="font-size: 20px; color: darkkhaki" title="Gestionar Tarea"></i></button></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
        
        <!-- Modal Asignar Responsable-->
        <div class="modal fade" id="myModalAsignarUS" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Cerrar</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">
                            Asignar Responsable Tarea 
                        </h4>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form role="form" action="?c=Mejora_C&a=Reasignar_Task" method="post" id="frm-Asignartarea" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="id">ID Solicitud</label>
                                <input type="text" readonly="" class="form-control" name="id" id="id" placeholder="id"/>
                            </div>
                            <div class="form-group">
                                <i class="icon-user-check"ria-hidden="true"></i> <label for="motivo"> Asignar Responsable </label>
                                <select name="id_user_responsable" id="id_user_responsable" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="requerido" >
                                    <option value="">Seleccione una opción</option>
                                    <?php while($row = $lista_us_all->fetch()){ ?>
                                        <option value="<?php echo $row['id'] ?>" ><?php echo $row['empleado']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <i class="glyphicon glyphicon-calendar" aria-hidden="true"></i> <label> Fecha Límite </label>
                                <input readonly type="text" name="fecha_limite" class="form-control datepicker" placeholder="Ingrese Límite tarea" id="fecha_limite" data-validacion-tipo="requerido" />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary"><span class="icon-floppy-disk"></span> Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#myModalAsignarUS').on('show.bs.modal', function (event) {
                var button          = $(event.relatedTarget) 
                var id              = button.data('id')

                var modal = $(this)
                modal.find('.modal-body input[name="id"]').val(id)
            })
            $(document).ready(function(){
                $("#frm-Asignartarea").submit(function(){
                    return $(this).validate();
                });
            })
        </script>
        
        <!-- Modal Gestionar Task-->
        <div class="modal fade" id="myModalGestionarTask" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Cerrar</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Gestionar Tarea </h4>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form role="form" action="?c=Mejora_C&a=Gestionar_Task" method="post" id="frm-gestionar_Task" enctype="multipart/form-data">
                            <input type="hidden" name="fecha_limite" class="form-control datepicker" placeholder="Fecha Límite tarea" id="fecha_limite" data-validacion-tipo="requerido" />
                            <div class="form-group">
                                <label for="id">ID Solicitud</label>
                                <input type="text" readonly="" class="form-control" name="id" id="id" placeholder="id"  />
                            </div>
                            <div class="form-group">
                                <label for="comentarios">Descripción Tarea</label>
                                <textarea class="form-control" name="comentarios" placeholder="Observaciones de la Tarea" rows="5" readonly=""><p ></p></textarea>
                            </div><hr />
    <!--       ********************      INGRESAR CAMPOS PARA LA GESTIÖN DE LA TAREA-->
                            <div class="form-group">
                                <label> Descripción Gestión </label>
                                <textarea class="form-control" name="descripcion_gestion" id="comment" rows="5" placeholder="Ingrese Descripción Gestión" data-validacion-tipo="requerido|min:5" ></textarea>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-6">
                                    <i class="glyphicon glyphicon-paperclip" aria-hidden="true"></i> <label>Adjuntar Documento</label>
                                    <input id="file-1" name="tar_ruta_doc_adjunto_gestion" type="file" placeholder="Ingrese Documento" class="file" data-preview-file-type="any">
                                </div>
                            </div>
                            <hr />
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-success"><span class="icon-floppy-disk"></span> Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#myModalGestionarTask').on('show.bs.modal', function (event) {
                var button      = $(event.relatedTarget) 
                var id          = button.data('id') 
                var fecha_limite= button.data('fecha_limite'),
                var descripcion = button.data('descripcion') 
                
                var modal = $(this)
                modal.find('.modal-body input[name="id"]').val(id),
                modal.find('.modal-body input[name="fecha_limite"]').val(fecha_limite),
                modal.find('.modal-body textarea[name="comentarios"]').val(descripcion)

            });
            $(document).ready(function(){
                $("#frm-gestionar_Task").submit(function(){
                    return $(this).validate();
                });
            })
        </script>
        <!-- Modal Ver Más-->
        <div class="modal fade" id="myModal_Ver_M" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Descripción de la Solicitud </h4>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label> Descripción </label>
                            <textarea class="form-control" readonly="" name="comentarios" id="comment" rows="5" placeholder="Descripción Solicitud" data-validacion-tipo="requerido|min:5" ></textarea>
                        </div> 
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#myModal_Ver_M').on('show.bs.modal', function (event) {
                var button          = $(event.relatedTarget) 
                var descripcion = button.data('descripcion') 

                var modal = $(this)
                modal.find('.modal-body textarea[name="comentarios"]').val(descripcion)
            })
        </script>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>