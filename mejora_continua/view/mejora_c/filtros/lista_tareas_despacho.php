<?php
    $id_user = $_SESSION['idUsuario'];
    $modelo         = new mejora_c();
   
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '13';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
    
    date_default_timezone_set('America/Bogota'); 
    $fecha  = date('Y-m-d');
    if(isset($id_user)){
        if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
?>
    <div class="form-group row">
        <div class="col-xs-3">
            <label for="fecha_inicio">Código Solicitud</label>
            <input type="number" name="id" id="id" placeholder="Ingrese Código Solicitud" class="form-control">
            <input type="hidden" name="user" id="id_user" value="<?php echo $id_user; ?>" placeholder="Ingrese USER" class="form-control">
        </div>
        <div class="col-xs-3">
            <label for="fecha_inicio">Fecha Inicial</label>
            <input readonly="" name="fechaI" id="fechaInicio" type="date" class="form-control datepicker">
        </div>
        <div class="col-xs-3">
            <label for="fecha_fin">Fecha Final</label>
            <input readonly="" name="fechaF" id="fechaFin" type="date"    class="form-control datepicker">
        </div>
        <div class="col-xs-3">
            <label for="flag_estado">Estado</label>
            <select name="flag_estado" id="flag_estado" class="form-control">
                <option value="">Seleccione una opción</option>
                <option value="0">Pendiente</option>
                <option value="1">Gestionada</option>
            </select>
        </div>
    </div>
    <hr />
    <div>
        <button class="btn btn-info" id="btn_guardar" onclick="search_tareas();"><span class="glyphicon glyphicon-search"></span> Consultar</button>
        <button class="btn btn-default" onclick="location.reload();" ><i class="fa fa-eraser" aria-hidden="true"></i> Restablecer</button>
    </div>
    <h1 class="page-header">Consultar Solicitudes</h1>
    <div id="load" style="display: none">
        <div class="progress" >
            <div id="bar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                <span class="sr-only">10% Complete</span>
            </div>
        </div>
    </div>
    <div class="well well-sm text-right">
        <a class="btn btn-primary" href="?c=Mejora_C&a=Crud_tarea_despacho"><i class="glyphicon glyphicon-plus-sign"></i> Nuevo Registro</a>
    </div>
    <div id="resultado"></div>
    <div id="tb_inicial">
        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
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
                <?php foreach($this->model->solicitudes_despacho($id_user) as $r): ?>
                    <tr>
                        <td>
                            <?php echo $r->tar_id; ?>
                            <?php if($r->tar_estado != 0){ ?>
                                <i class="fa fa-flag" aria-hidden="true" style="color: green" title="Solicitud Gestionada"></i>
                            <?php }else{ ?>
                                <i class="fa fa-flag" aria-hidden="true" style="color: goldenrod" title="Solicitud En Tramite"></i>
                            <?php } ?>
                        </td>
                        <td><?php echo $r->tar_fecha; ?></td>
                        <td><button class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal_Ver_M" data-descripcion="<?php echo $r->tar_descripcion ?>" ><i class="icon-zoom-in" style="font-size: 20px;" title="Ver Descripción"> </i></button></td>
                        <td>
                            <?php if($r->tar_ruta_doc != ""){ ?>
                                <a href="void()" class="btn btn-default" onclick="ver_doc_adjunto(1,'<?php echo $r->tar_ruta_doc; ?>');return false;" target="_blank" title="Descargar Documento Adjunto"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a>
                            <?php }else{ ?>
                                <span class="icon-blocked" style="color: red; font-size: 18px;" title="Sin Documento Adjunto"> </span>
                            <?php } ?>
                        </td>
                        
                        <?php
                            if($r->tar_estado == 0 ){
                                $alerta= "alert-warning";
                                $mensaje ="Pendiente";
                                $show = 0;
                            }else if($r->tar_estado == 1){
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
                            <td><?php echo $r->tar_descripcion_gestion; ?></td>
                            <td><a href="void()" class="btn btn-default" onclick="ver_doc_adjunto(2,'<?php echo $r->tar_ruta_doc_gestion; ?>');return false;" target="_blank" title="Descargar Documento Adjunto"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a></td>
                        <?php } ?>
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
                    <h4 class="modal-title" id="myModalLabel">
                        Descripción de la Solicitud 
                    </h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label> Descripción </label>
                        <textarea class="form-control" name="comentarios" id="comment" rows="5" placeholder="Descripción Solicitud" data-validacion-tipo="requerido|min:5" ></textarea>
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
        <h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para acceder a esta opción</h4>
    <?php } ?> 
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.30/centro_servicios2" ); } ?>