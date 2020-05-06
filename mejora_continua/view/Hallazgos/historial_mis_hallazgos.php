<?php
    $id_user = $_SESSION['idUsuario'];
    $modelo         = new mejora_c();

    date_default_timezone_set('America/Bogota'); 
    $fecha  = date('Y-m-d');
    $lista_us_all       = $modelo->get_Responsable();
    $lista_despachos    = $modelo->Get_Juzgados();
    
    $lista_us_all       = $modelo->get_Responsable_lider($_SESSION['id_proceso_cs'] );
    
    $idaccion           = '34';
    $datos_us_accion    = $modelo->get_lista_usuario_accionesJE($idaccion);
    $us_lider_MC        = $datos_us_accion->fetch();
    $usuario_lider_mc   = explode("////",$us_lider_MC[usuario]);
    
    if(isset($id_user)){
?>
    <div class="form-group row">
        <div class="col-xs-3">
            <label for="fecha_inicio">Código Solicitud</label>
            <input type="number" name="id" id="id" placeholder="Ingrese Código Solicitud" class="form-control">
            <input type="hidden" name="id_responsable" id="id_responsable" value="<?php echo $id_user; ?>" placeholder="Ingrese USER" class="form-control">
        </div>
        <div class="col-xs-3">
            <label for="fecha_inicio">Fecha Inicial</label>
            <input readonly="" name="fechaI" id="fechaInicio" type="date" class="form-control datepicker">
        </div>
        <div class="col-xs-3">
            <label for="fecha_fin">Fecha Final</label>
            <input readonly="" name="fechaF" id="fechaFin" type="date" class="form-control datepicker">
        </div>
    </div>
    <hr />
    <div>
        <button class="btn btn-info" id="btn_guardar" onclick="search_Historial_mis_HallazgosUS();"><span class="glyphicon glyphicon-search"></span> Consultar</button>
        <button class="btn btn-default" onclick="location.reload();" ><i class="fa fa-eraser" aria-hidden="true"></i> Restablecer</button>
    </div>
    <h1 class="page-header">Historial Hallazgos</h1>
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
                <?php foreach($this->model->Procedure_Mis_hallazgos_Historial($id_user) as $r): ?>
                    <tr>
                        <td>
                            <?php echo $r->hal_id; ?>
                            <?php if($r->hal_estado != 0){ ?>
                                <i class="icon-checkmark" aria-hidden="true" style="color: green" title="Solicitud Gestionada"></i>
                            <?php }else{ ?>
                                <i class="glyphicon glyphicon-info-sign" aria-hidden="true" style="color: goldenrod" title="Solicitud En Tramite"></i>
                            <?php } ?>
                        </td>
                        <td><?php echo $r->hal_fecha; ?></td>
                        <td><?php echo $r->hal_fecha_limite; ?></td>
                        <td><?php echo $r->hal_fecha_gestion; ?></td>
                        <td><?php echo $r->empleado; ?></td>
                        <td><button class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal_Ver_M" data-descripcion="<?php echo $r->hal_descripcion ?>" ><i class="icon-zoom-in" style="font-size: 20px;" title="Ver Descripción"> </i></button></td>
                        <td>
                            <?php if($r->hal_ruta_doc !=""){ ?>
                                <a href="void()" class="btn btn-default" onclick="ver_doc_adjunto(3,'<?php echo $r->hal_ruta_doc; ?>');return false;" target="_blank" title="Descargar Documento Adjunto"><span class="icon icon-download3" style="font-size: 18px; color: #009900;"></span></a>
                            <?php }else{ ?>
                                <span class="icon-blocked" style="color: red; font-size: 18px;" title="Sin Documento Adjunto"> </span>
                            <?php } ?>
                        </td>
                        
                        <?php if($r->hal_descripcion_gestion !="") { ?>
                            <td><button class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal_Ver_MG" data-obs_gestion="<?php echo $r->hal_descripcion_gestion; ?>" ><i class="icon-zoom-in" style="font-size: 20px;" title="Ver Descripción Gestión"> </i></button></td>
                        <?php }else{ ?>
                            <td><i class="icon-blocked" style="font-size: 20px;" title="Descripción Vacia"> </i></td>
                        <?php } ?>
                        <td>
                            <?php if($r->hal_ruta_doc_gestion !=""){ ?>
                                <a href="void()" class="btn btn-default" onclick="ver_doc_adjunto(4,'<?php echo $r->hal_ruta_doc_gestion; ?>');return false;" target="_blank" title="Descargar Documento Adjunto"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a>
                            <?php }else{ ?>
                                <span class="icon-blocked" style="color: red; font-size: 18px;" title="Sin Documento Adjunto"> </span>
                            <?php } ?>
                        </td>
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
                    <h4 class="modal-title" id="myModalLabel">Descripción del Hallazgo </h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label> Descripción </label>
                        <textarea class="form-control" readonly="" name="comentarios" id="comment" rows="5" placeholder="Descripción Tarea" data-validacion-tipo="requerido|min:5" ></textarea>
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
            var button      = $(event.relatedTarget) 
            var descripcion = button.data('descripcion') 

            var modal = $(this)
            modal.find('.modal-body textarea[name="comentarios"]').val(descripcion)
        })
    </script>
    <!-- Modal Ver Más Gestión-->
        <div class="modal fade" id="myModal_Ver_MG" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Descripción de la Gestión </h4>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label> Descripción Gestiòn</label>
                            <textarea class="form-control" readonly="" name="obs_gestion" id="comment" rows="5" placeholder="Descripción Gestión" data-validacion-tipo="requerido|min:5" ></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#myModal_Ver_MG').on('show.bs.modal', function (event) {
                var button          = $(event.relatedTarget) 
                var obs_gestion = button.data('obs_gestion') 

                var modal = $(this)
                modal.find('.modal-body textarea[name="obs_gestion"]').val(obs_gestion)
            });
        </script>
<?php }else{ ?> 
    <h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para acceder a esta opción</h4>
<?php } ?> 
