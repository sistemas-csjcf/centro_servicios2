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
    
    date_default_timezone_set('America/Bogota'); 
    $fecha  = date('Y-m-d');
    $lista_us_all       = $modelo->get_Responsable();
    $lista_despachos    = $modelo->Get_Juzgados();
    $lista_clase        = $modelo->Get_Clases();
    $lista_norma        = $modelo->Get_Normas();
    $lista_metodologia  = $modelo->Get_Metodologia();
    $lista_generada     = $modelo->Get_Generada();
    $lista_proceso      = $modelo->Get_Procesos();
    
    $lista_claseG       = $modelo->Get_Clases();
    $lista_normaG       = $modelo->Get_Normas();
    $lista_metodologiaG = $modelo->Get_Metodologia();
    $lista_generadaG    = $modelo->Get_Generada();
    $lista_procesoG    = $modelo->Get_Procesos();
    
    if(isset($id_user)){
        if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
?>
    <div class="form-group row">
        <div class="col-xs-3">
            <label for="id_solicitud">Código Acción Gestión</label>
            <input type="number" name="id" id="id" placeholder="Ingrese Código Solicitud" class="form-control">
            <input type="hidden" name="user" id="id_user" value="<?php echo $id_user; ?>" placeholder="Ingrese USER" class="form-control">
        </div>
        <div class="col-xs-3">
            <label for="fecha_inicio">Fecha Inicial</label>
            <input readonly="" name="fechaI" id="fechaInicio" type="date" class="form-control datepicker">
        </div>
        <div class="col-xs-3">
            <label for="fecha_fin">Fecha Final</label>
            <input readonly="" name="fechaF" id="fechaFin" type="date" class="form-control datepicker">
        </div>
        <div class="col-xs-3">
            <label for="flag_estado">Juzgado</label>
            <select name="id_despacho" id="id_despacho" class="form-control selectpicker" data-live-search="true">
                <option value="">Seleccione una opción</option>
                <?php while($row = $lista_despachos->fetch()){ ?>
                    <option value="<?php echo $row['cod_usuario_juzgado'] ?>" ><?php echo $row['nombre']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <hr />
    <div>
        <button class="btn btn-info" id="btn_guardar" onclick="search_solicitudes_admin();"><span class="glyphicon glyphicon-search"></span> Consultar</button>
        <button class="btn btn-default" onclick="location.reload();" ><i class="fa fa-eraser" aria-hidden="true"></i> Restablecer</button>
    </div>
    <h1 class="page-header">Consultar Acciones de Gestión</h1>
    <div id="load" style="display: none">
        <div class="progress" >
            <div id="bar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                <span class="sr-only">10% Complete</span>
            </div>
        </div>
    </div>
    <div id="resultado"></div>
    <div id="tb_inicial">
        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #B71F56; color: white;">
                    <th title="Código Interno Acción de Gestión" style="width:12px;">ID</th>
                    <th style="width:10px;">Fecha Solicitud</th>
                    <th style="width:10px;">Fecha Limite</th>
                    <th title="Despacho Solicitante" style="width:12px;">Despacho</th>
                    <th title="Descripción de la Acción de Gestión" style="width:120px;">Descripción</th>
                    <th style="width:12px;">Documento</th>
                    <th title="Asignar Responsable" style="width:12px;">Asignar</th>
<!--                    <th title="Estado Solicitud" style="width:12px;">Estado</th>-->
                    <th title="Gestionar " style="width:12px;">Gestionar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($this->model->solicitudes_pendientes_admin($id_user) as $r): ?>
                    <tr>
                        <td>
                            <?php echo $r->tar_id; ?>
                            <?php 
                                if($r->diferencia > 2){ 
                                    $flag="green";
                                }else if($r->diferencia < 0){
                                    $flag="red";
                                }else if($r->diferencia >=0 && $r->diferencia <3){
                                    $flag="goldenrod";
                                }else{
                                    $flag="white";
                                }
                            ?>
                            <i class="fa fa-flag" aria-hidden="true" style="font-size: 20px; color: <?php echo $flag; ?>" title="Tarea En Tramite"></i>
                        </td>
                        <td><?php echo $r->tar_fecha; ?></td>
                        <?php 
                            if($r->tar_fecha_limite =='0000-00-00'){
                                $color="red";
                                $txt = "Sin asignar Fecha";
                            }else{
                                $color="";
                                $txt = $r->tar_fecha_limite;
                            }
                        ?>
                        <td style="color: <?php echo $color; ?>"><?php echo $txt; ?></td>
                        <td><?php echo $r->empleado; ?></td>
                        <td><button class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal_Ver_M" data-descripcion="<?php echo $r->tar_descripcion ?>" ><i class="icon-zoom-in" style="font-size: 20px;" title="Ver Descripción"> </i></button></td>
                        <td>
                            <?php if($r->tar_ruta_doc !=""){ ?>
                                <a href="void()" class="btn btn-default" onclick="ver_doc_adjunto(1,'<?php echo $r->tar_ruta_doc; ?>');return false;" target="_blank" title="Descargar Documento Adjunto"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a>
                            <?php }else{ ?>
                                <span class="icon-blocked" style="color: red; font-size: 18px;" title="Sin Documento Adjunto"> </span>
                            <?php } ?>
                        </td>
                        <td><button class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModalAsignarUS" data-id="<?php echo $r->tar_id ?>" ><i class="icon-user-check" style="font-size: 20px;" title="Asignar Responsable"> </i></button></td>
                        <td><button class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModalGestionarTask" data-id="<?php echo $r->tar_id ?>" data-fecha_limite="<?php echo $r->tar_fecha_limite ?>" data-solicitante="<?php echo $r->empleado; ?>" data-descripcion="<?php echo $r->tar_descripcion; ?>" data-clase="<?php echo $r->clase; ?>" data-norma="<?php echo $r->norma; ?>" data-causa18="<?php echo $r->causa; ?>" ><i class="glyphicon glyphicon-folder-open" style="font-size: 20px; color: darkkhaki" title="Gestionar Acción de Gestión"></i></button></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Modal Ver Más-->
    <div class="modal fade" id="myModal_Ver_M" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
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
    <!-- Modal Asignar Responsable-->
    <div class="modal fade" id="myModalAsignarUS" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Asignar Responsable Tarea 
                    </h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form role="form" action="?c=Mejora_C&a=Reasignar_Task" method="post" id="frm-Asignartarea" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="id">ID Acción Gestión</label>
                            <input type="text" readonly="" class="form-control" name="id" id="id" placeholder="id"/>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="flag_estado">Clase </label>
                                <select name="id_clase" id="id_clase" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="requerido" >
                                    <option value="">Seleccione clase</option>
                                    <?php while($row = $lista_clase->fetch()){ ?>
                                        <option value="<?php echo $row['clas_id'] ?>" ><?php echo $row['clas_titulo']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-xs-6">
                                <label for="flag_estado">Numeral Norma </label>
                                <select name="id_norma" id="id_norma" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="requerido" >
                                    <option value="">Seleccione Numeral Norma</option>
                                    <?php while($row = $lista_norma->fetch()){ ?>
                                        <option value="<?php echo $row['nor_id'] ?>" ><?php echo $row['nor_titulo']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <i class="icon-user-check"ria-hidden="true"></i> <label for="motivo"> Asignar Responsable </label>
                            <select name="id_user_responsable" id="id_user_responsable" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="requerido" >
                                <option value="">Seleccione una opción</option>
                                <?php while($row = $lista_us_all->fetch()){ ?>
                                    <option value="<?php echo $row['id']."// ".$row['id_proceso_cs'] ?>" ><?php echo $row['empleado']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="flag_estado">Proceso Afectado o Impactado </label>
                            <select name="id_procesoImp[]" id="id_procesoImp" class="form-control selectpicker show-tick" multiple title="Seleccione Proceso(s) Afectado" data-validacion-tipo="requerido">
                                
                                <?php while($row = $lista_proceso->fetch()){ ?>
                                    <option value="<?php echo $row['proc_id'] ?>" ><?php echo $row['proc_titulo']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label> Análisis de Causas </label>
                            <textarea class="form-control" name="causas" id="comment" rows="5" placeholder="Ingrese Análisis de Causas" data-validacion-tipo="requerido|min:5" ></textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="flag_estado">Metodología</label>
                                <select name="id_metodologia" id="id_metodologia" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="requerido" >
                                    <option value="">Seleccione Metodología</option>
                                    <?php while($row = $lista_metodologia->fetch()){ ?>
                                        <option value="<?php echo $row['met_id'] ?>" ><?php echo $row['met_titulo']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-xs-6">
                                <label for="flag_estado">Generada por </label>
                                <select name="id_generado" id="id_generado" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="requerido" >
                                    <option value="">Seleccione una Opción</option>
                                    <?php while($row = $lista_generada->fetch()){ ?>
                                        <option value="<?php echo $row['gen_id'] ?>" ><?php echo $row['gen_titulo']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <i class="glyphicon glyphicon-calendar" aria-hidden="true"></i> <label> Fecha Límite </label>
                            <input readonly type="text" name="fecha_limite" class="form-control datepicker" placeholder="Ingrese Límite Acción Gestión" id="fecha_limite" data-validacion-tipo="requerido" />
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
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Gestionar Acción Gestión 
                    </h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form role="form" action="?c=Mejora_C&a=Gestionar_Task" method="post" id="frm-gestionar_Task" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="id">ID Acción Gestión</label>
                            <input type="text" readonly="" class="form-control" name="id" id="id" placeholder="id"/>
                        </div>
                        <div class="form-group">
                            <label for="id">Solicitante</label>
                            <input type="text" readonly="" class="form-control" name="solicitante" id="solicitante" placeholder="Solicitante"/>
                        </div>
                        <div class="form-group">
                            <label for="comentarios">Descripción</label>
                            <textarea class="form-control" name="comentarios" placeholder="Observaciones de la Tarea" rows="5" readonly=""><p ></p></textarea>
                        </div><hr />
<!--       ********************      INGRESAR CAMPOS PARA LA GESTIÖN DE LA TAREA-->
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="flag_estado">Clase </label>
                                <select name="id_clase" id="id_clase" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="requerido" >
                                    <option value="">Seleccione clase</option>
                                    <?php while($row = $lista_claseG->fetch()){ ?>
                                        <option value="<?php echo $row['clas_id'] ?>" ><?php echo $row['clas_titulo']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-xs-6">
                                <label for="flag_estado">Numeral Norma </label>
                                <select name="id_norma" id="id_norma" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="requerido" >
                                    <option value="">Seleccione Numeral Norma</option>
                                    <?php while($row = $lista_normaG->fetch()){ ?>
                                        <option value="<?php echo $row['nor_id'] ?>" ><?php echo $row['nor_titulo']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="flag_estado">Proceso Afectado o Impactado </label>
                            <select name="id_procesoImp[]" id="id_procesoImp" class="form-control selectpicker show-tick" multiple title="Seleccione Proceso(s) Afectado" data-validacion-tipo="requerido">
                                
                                <?php while($row = $lista_procesoG->fetch()){ ?>
                                    <option value="<?php echo $row['proc_id'] ?>" ><?php echo $row['proc_titulo']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label> Análisis de Causas </label>
                            <textarea class="form-control" name="causas" id="comment" rows="5" placeholder="Ingrese Análisis de Causas" data-validacion-tipo="requerido|min:5" ></textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="flag_estado">Metodología</label>
                                <select name="id_metodologia" id="id_metodologia" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="requerido" >
                                    <option value="">Seleccione Metodología</option>
                                    <?php while($row = $lista_metodologiaG->fetch()){ ?>
                                        <option value="<?php echo $row['met_id'] ?>" ><?php echo $row['met_titulo']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-xs-6">
                                <label for="flag_estado">Generada por </label>
                                <select name="id_generado" id="id_generado" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="requerido" >
                                    <option value="">Seleccione una Opción</option>
                                    <?php while($row = $lista_generadaG->fetch()){ ?>
                                        <option value="<?php echo $row['gen_id'] ?>" ><?php echo $row['gen_titulo']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <i class="glyphicon glyphicon-calendar" aria-hidden="true"></i> <label> Fecha Límite </label>
                            <input readonly type="text" name="fecha_limite" class="form-control datepicker" placeholder="Ingrese Límite tarea" id="fecha_limiteG" data-validacion-tipo="requerido" />
                        </div>
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
            var fecha_limite= button.data('fecha_limite');
            var solicitante = button.data('solicitante') 
            var descripcion = button.data('descripcion') 
            if(fecha_limite !='0000-00-00'){
                fecha_limite = fecha_limite;
            }else{
                fecha_limite='';
            }
            var causa = button.data('causa18') 
			
            var modal = $(this)
            modal.find('.modal-body input[name="id"]').val(id),
            modal.find('.modal-body input[name="fecha_limite"]').val(fecha_limite),
            
            modal.find('.modal-body input[name="solicitante"]').val(solicitante),
            modal.find('.modal-body textarea[name="comentarios"]').val(descripcion)
			modal.find('.modal-body textarea[name="causas"]').val(causa)
            
        })
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