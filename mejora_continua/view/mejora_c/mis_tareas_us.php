<?php
    $id_user = $_SESSION['idUsuario'];
    $modelo         = new mejora_c();
   
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '33';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
    
    $lista_us_all       = $modelo->get_Responsable_lider($_SESSION['id_proceso_cs'] );
    $idaccion           = '34';
    $datos_us_accion    = $modelo->get_lista_usuario_accionesJE($idaccion);
    $us_lider_MC        = $datos_us_accion->fetch();
    $usuario_lider_mc   = explode("////",$us_lider_MC[usuario]);
    
    date_default_timezone_set('America/Bogota'); 
    $fecha  = date('Y-m-d');
    if(isset($id_user)){
        if ( $_SESSION['idUsuario'] != 22 ) {
?>
    <div class="form-group row">
        <div class="col-xs-3">
            <label for="fecha_inicio">Código Acción de Gestión</label>
            <input type="number" name="id" id="id" placeholder="Ingrese Código Acción Gestión" class="form-control" title="Código Acción Gestión">
            <input type="hidden" name="user" id="id_user" value="<?php echo $id_user; ?>" placeholder="Ingrese USER" class="form-control">
        </div>
        <div class="col-xs-3">
            <label for="fecha_inicio">Fecha Inicial</label>
            <input readonly="" name="fechaI" id="fechaInicio" type="date" class="form-control datepicker" title="Fecha Limite Inicial">
        </div>
        <div class="col-xs-3">
            <label for="fecha_fin">Fecha Final</label>
            <input readonly="" name="fechaF" id="fechaFin" type="date" class="form-control datepicker" title="Fecha Limite Inicial">
        </div>
    </div>
    <hr />
    <div>
        <button class="btn btn-info" id="btn_guardar" onclick="search_mis_tareas();"><span class="glyphicon glyphicon-search"></span> Consultar</button>
        <button class="btn btn-default" onclick="location.reload();" ><i class="fa fa-eraser" aria-hidden="true"></i> Restablecer</button>
    </div>
    <h1 class="page-header">Consultar Acción de Gestión</h1>
    <div id="load" style="display: none">
        <div class="progress" >
            <div id="bar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                <span class="sr-only">10% Complete</span>
            </div>
        </div>
    </div>
    <div class="well well-sm text-right">
        <!--<a class="btn btn-primary" href="?c=Mejora_C&a=Crud_tarea"><i class="glyphicon glyphicon-plus-sign"></i> Nuevo Registro</a> -->
    </div>
    <div id="resultado"></div>
    <div id="tb_inicial">
        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #B71F56; color: white;">
                    <th title="Código Interno Acción Gestión" style="width:12px;">ID</th>
                    <th style="width:10px;" title="Fecha Solicitud Acción Gestión">Fecha</th>
                    <th style="width:10px;" title="Fecha Límite Acción Gestión">Fecha Límite</th>
                    <th title="Solicitante" style="width:12px;">Solicitante</th>
                    <th title="Descripción Acción Gestión" style="width:120px;">Descripción</th>
                    <th style="width:12px;">Documento</th>
                    <th title="Gestionar Acción Gestión" style="width:12px;">Gestionar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($this->model->mis_tareas_pendientes($id_user) as $r): ?>
                    <tr>
                        <td>
                            <?php 
                                echo $r->tar_id;
                                if($r->diferencia > 2){ 
                                    $flag="green";
                                }else if($r->diferencia<0){
                                    $flag="red";
                                }else if($r->diferencia>=0 && $r->diferencia<3){
                                    $flag="goldenrod";
                                }
                            ?>
                            <i class="fa fa-flag" aria-hidden="true" style="font-size: 20px; color: <?php echo $flag; ?>" title="Tarea En Tramite"></i>
                        </td>
                        <td><?php echo $r->tar_fecha; ?></td>
                        <td><?php echo $r->tar_fecha_limite; ?></td>
                        <td><?php echo $r->empleado; ?>
                            <?php 
//                                if($r->tar_id_userE >0){
//                                    $datos_user = $modelo->get_dato_Usuario1($r->tar_id_userE);
//                                    $get_user   = $datos_user->fetch();
//                                    echo $get_user['empleado']; 
//                                }else{
//                                    echo $r->empleado;
//                                }
                            ?>
                        </td>
                        <td><button class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal_Ver_M" data-descripcion="<?php echo $r->tar_descripcion ?>" ><i class="icon-zoom-in" style="font-size: 20px;" title="Ver Descripción"> </i></button></td>
                        <td>
                            <?php if($r->tar_ruta_doc !=""){ ?>
                                <a href="void()" class="btn btn-default" onclick="ver_doc_adjunto(1,'<?php echo $r->tar_ruta_doc; ?>');return false;" target="_blank" title="Descargar Documento Adjunto"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a>
                            <?php }else{ ?>
                                <span class="icon-blocked" style="color: red; font-size: 18px;" title="Sin Documento Adjunto"> </span>
                            <?php } ?>
                        </td>
                        <td><button class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModalGestionarTask" data-id="<?php echo $r->tar_id ?>" data-fecha_limite="<?php echo $r->tar_fecha_limite; ?>" data-descripcion="<?php echo $r->tar_descripcion; ?>" ><i class="glyphicon glyphicon-folder-open" style="font-size: 20px; color: darkkhaki" title="Gestionar Tarea"></i></button></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
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
                        <textarea class="form-control" readonly="" name="comentarios" id="comment" rows="5" placeholder="Descripción Acción Gestión" data-validacion-tipo="requerido|min:5" ></textarea>
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
    <!-- Modal Gestionar Task-->
    <div class="modal fade" id="myModalGestionarTask" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" enctype="multipart/form-data">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Gestionar Acción Gestión</h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form role="form" action="?c=Mejora_C&a=Gestionar_TaskUS" method="post" id="frm-gestionar_Task" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="id">ID Acción Gestión</label>
                            <input type="text" readonly="" class="form-control" name="id" id="id" placeholder="id"/>
                        </div>    
                        <input type="hidden" name="fecha_limite" class="form-control datepicker" placeholder="Ingrese Límite Acción Gestión" id="fecha_limite" data-validacion-tipo="requerido" />
                        <div class="form-group">
                            <label for="comentarios">Descripción Acción Gestión</label>
                            <textarea class="form-control" name="comentarios" placeholder="Observaciones de la Acción Gestión" rows="5" readonly=""><p ></p></textarea>
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
            var fecha_limite= button.data('fecha_limite') 
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
    <?php }else{ ?> 
        <h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para acceder a esta opción</h4>
    <?php } ?> 
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>