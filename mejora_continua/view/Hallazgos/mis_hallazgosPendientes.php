<?php
    $id_user = $_SESSION['idUsuario'];
    $modelo         = new mejora_c();
  
    date_default_timezone_set('America/Bogota'); 
    $fecha  = date('Y-m-d');
    $lista_us_all       = $modelo->get_Responsable();
    $lista_despachos    = $modelo->Get_Juzgados();
    $lista_auditores    = $modelo->Get_us_Audi(35);
    if(isset($id_user)){
?>
    <div class="form-group row">
        <div class="col-xs-3">
            <label for="fecha_inicio">Código Hallazgo</label>
            <input type="number" name="id" id="id" placeholder="Ingrese Código Hallazgo" class="form-control">
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
<!--        <div class="col-xs-3">
            <label for="flag_estado">Solicitante</label>
            <select name="id_solicitante" id="id_solicitante" class="form-control selectpicker" data-live-search="true">
                <option value="">Seleccione una opción</option>
                <?php while($row = $lista_us_all->fetch()){ ?>
                    <?php ?>
                    <option value="<?php echo $row['id'] ?>" ><?php echo $row['empleado']; ?></option>
                <?php } ?>
            </select>
        </div>-->
    </div>
    <hr />
    <div>
        <button class="btn btn-info" id="btn_guardar" onclick="search_mis_hallazgos();"><span class="glyphicon glyphicon-search"></span> Consultar</button>
        <button class="btn btn-default" onclick="location.reload();" ><i class="fa fa-eraser" aria-hidden="true"></i> Restablecer</button>
    </div>
    <h1 class="page-header">Consultar Hallazgos</h1>
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
                    <th title="Código Interno Hallazgo" style="width:12px;">ID</th>
                    <th style="width:10px;">Fecha Solicitud</th>
                    <th style="width:10px;">Fecha Limite</th>
                    <th title="Solicitante" style="width:12px;">Solicitante</th>
                    <th title="Descripción del Hallazgo" style="width:120px;">Descripción</th>
                    <th style="width:12px;">Documento</th>
                    <th title="Gestionar Hallazgo" style="width:12px;">Gestionar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($this->model->Procedure_Mis_hallazgos_pendientes($id_user) as $r): ?>
                    <tr>
                        <td>
                            <?php echo $r->hal_id; ?>
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
                            <i class="fa fa-flag" aria-hidden="true" style="font-size: 20px; color: <?php echo $flag; ?>" title="Hallazgo En Tramite"></i>
                        </td>
                        <td><?php echo $r->hal_fecha; ?></td>
                        <?php 
                            if($r->hal_fecha_limite =='0000-00-00'){ 
                                $color="red";
                                $txt = "Sin asignar Fecha";
                            }else{
                                $color="";
                                $txt = $r->hal_fecha_limite;
                            }
                        ?>
                        <td style="color: <?php echo $color; ?>"><?php echo $txt; ?></td>
                        <td><?php echo $r->empleado; ?></td>
                        <td><button class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal_Ver_M" data-descripcion="<?php echo $r->hal_descripcion ?>" ><i class="icon-zoom-in" style="font-size: 20px;" title="Ver Descripción"> </i></button></td>
                        <td>
                            <?php if($r->tar_ruta_doc !=""){ ?>
                                <a href="void()" class="btn btn-default" onclick="ver_doc_adjunto(3,'<?php echo $r->hal_ruta_doc; ?>');return false;" target="_blank" title="Descargar Documento Adjunto"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a>
                            <?php }else{ ?>
                                <span class="icon-blocked" style="color: red; font-size: 18px;" title="Sin Documento Adjunto"> </span>
                            <?php } ?>
                        </td>
                        <td><button class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModalGestionarFind" data-id="<?php echo $r->hal_id ?>" data-fecha_limite="<?php echo $r->hal_fecha_limite ?>" data-solicitante="<?php echo $r->empleado; ?>" data-descripcion="<?php echo $r->hal_descripcion; ?>" ><i class="glyphicon glyphicon-folder-open" style="font-size: 20px; color: darkkhaki" title="Gestionar Tarea"></i></button></td>
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
                        Descripción del Hallazgo 
                    </h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label> Descripción </label>
                        <textarea class="form-control" readonly="" name="comentarios" id="comment" rows="5" placeholder="Descripción Hallazgo" data-validacion-tipo="requerido|min:5" ></textarea>
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
        <div class="modal-dialog">
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
                    <form role="form" action="?c=Mejora_C&a=Reasignar_Task" method="post" id="frm-Asignartarea">
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
    
    <!-- Modal Gestionar Find-->
    <div class="modal fade" id="myModalGestionarFind" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Gestionar Hallazgo 
                    </h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form role="form" action="?c=Mejora_C&a=Gestionar_Find" method="post" id="frm-gestionar_Task" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="id">ID Hallazgo</label>
                            <input type="text" readonly="" class="form-control" name="id" id="id" placeholder="id"/>
                        </div>
                        <div class="form-group">
                            <label for="id">Solicitante</label>
                            <input type="text" readonly="" class="form-control" name="solicitante" id="solicitante" placeholder="Solicitante"/>
                        </div>
                        <div class="form-group">
                            <label for="comentarios">Descripción</label>
                            <textarea class="form-control" name="comentarios" placeholder="Observaciones del Hallazgo" rows="5" readonly=""><p ></p></textarea>
                        </div><hr />
<!--       ********************      INGRESAR CAMPOS PARA LA GESTIÖN DE LA TAREA-->
                        <div class="form-group">
                            <i class="glyphicon glyphicon-calendar" aria-hidden="true"></i> <label> Fecha Límite </label>
                            <input readonly type="date" name="fecha_limite" class="form-control" placeholder="Ingrese Límite Hallazgo" id="fecha_lim" data-validacion-tipo="requerido" />
                        </div>
                        <div class="form-group">
                            <label> Descripción Gestión </label>
                            <textarea class="form-control" name="descripcion_gestion" id="comment" rows="5" placeholder="Ingrese Descripción Gestión" data-validacion-tipo="requerido|min:5" ></textarea>
                        </div> 
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <i class="glyphicon glyphicon-paperclip" aria-hidden="true"></i> <label>Adjuntar Documento</label>
                                <input id="file-1" name="hal_ruta_doc_adjunto_gestion" type="file" placeholder="Ingrese Documento" class="file" data-preview-file-type="any">
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
        $('#myModalGestionarFind').on('show.bs.modal', function (event) {
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
            
            var modal = $(this)
            modal.find('.modal-body input[name="id"]').val(id),
            modal.find('.modal-body input[name="fecha_limite"]').val(fecha_limite),
            
            modal.find('.modal-body input[name="solicitante"]').val(solicitante),
            modal.find('.modal-body textarea[name="comentarios"]').val(descripcion)
            
        })
        $(document).ready(function(){
            $("#frm-gestionar_Task").submit(function(){
                return $(this).validate();
            });
        })
    </script>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.30/centro_servicios2" ); } ?>