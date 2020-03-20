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
    $lista_us_all       = $modelo->get_All_users();
    $lista_solicitante  = $modelo->get_solicitanteAdmin();
    $lista_responsable  = $modelo->get_Responsable();
    $lista_responsables = $modelo->get_Responsables();
    
    $lista_clase        = $modelo->Get_Clases();
    $lista_claseF       = $modelo->Get_Clases();
    $lista_norma        = $modelo->Get_Normas();
    $lista_normaF       = $modelo->Get_Normas();
    $lista_metodologia  = $modelo->Get_Metodologia();
    $lista_metodologiaF = $modelo->Get_Metodologia();
    $lista_generada     = $modelo->Get_Generada();
    $lista_generadaF    = $modelo->Get_Generada();
    $lista_proceso      = $modelo->Get_Procesos();
    $lista_detalle      = $modelo->Get_Detalles();

    if(isset($id_user)){
        if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
?>
    <div class="form-group row">
        <div class="col-xs-2">
            <label for="fecha_inicio">Código Solicitud</label>
            <input type="number" name="id" id="id" placeholder="Código Solicitud" class="form-control">
            <input type="hidden" name="user" id="id_user" value="<?php echo $id_user; ?>" placeholder="Ingrese USER" class="form-control">
        </div>
        <div class="col-xs-3">
            <label for="fecha_inicio">Fecha Inicial</label>
            <input readonly="" name="fechaI" id="fechaInicio" type="date" class="form-control datepicker" title="Fecha Inicio ">
        </div>
        <div class="col-xs-3">
            <label for="fecha_fin">Fecha Final</label>
            <input readonly="" name="fechaF" id="fechaFin" type="date" class="form-control datepicker" title="Fecha Final">
        </div>
        <div class="col-xs-4">
            <label for="solicitante">Solicitante</label>
            <select name="id_solicitante" id="id_solicitante" class="form-control selectpicker" data-live-search="true">
                <option value="">Seleccione una opción</option>
                <?php while($row = $lista_solicitante->fetch()){ ?>
                    <option value="<?php echo $row['id'] ?>" ><?php echo $row['empleado']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group row">    
        <div class="col-xs-3">
            <label for="flag_responsable">Responsable</label>
            <select name="id_responsable" id="id_responsable" class="form-control selectpicker" data-live-search="true">
               <option value="">Seleccione una opción</option>
                <?php while($row = $lista_responsable->fetch()){ ?>
                    <option value="<?php echo $row['id'] ?>" ><?php echo $row['empleado']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-xs-3">
            <label for="flag_estado">Clase</label>
            <select name="id_clase" id="id_clase" class="form-control" >
                <option value="">Seleccione clase</option>
                <?php while($row = $lista_claseF->fetch()){ ?>
                    <option value="<?php echo $row['clas_id'] ?>" ><?php echo $row['clas_titulo']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-xs-3">
            <label for="flag_estado">Norma</label>
            <select name="id_norma" id="id_norma" class="form-control" >
                <option value="">Seleccione Numeral Norma</option>
                <?php while($row = $lista_norma->fetch()){ ?>
                    <option value="<?php echo $row['nor_id'] ?>" ><?php echo $row['nor_titulo']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-xs-3">
            <label for="flag_estado">Metodología</label>
            <select name="id_metodologia" id="id_metodologia" class="form-control" >
                <option value="">Seleccione una opción</option>
                <?php while($row = $lista_metodologiaF->fetch()){ ?>
                    <option value="<?php echo $row['met_id'] ?>" ><?php echo $row['met_titulo']; ?></option>
                <?php } ?>
            </select>
        </div>
        
    </div>
    <div class="form-group row"> 
        <div class="col-xs-3">
            <label for="flag_estado">Generada por </label>
            <select name="id_generado" id="id_generado" class="form-control" >
                <option value="">Seleccione una Opción</option>
                <?php while($row = $lista_generadaF->fetch()){ ?>
                    <option value="<?php echo $row['gen_id'] ?>" ><?php echo $row['gen_titulo']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-xs-3">
            <label for="flag_estado">Estado</label>
            <select name="estado" id="estado" class="form-control" >
                <option value="">Seleccione una opción</option>
                <option value="0">Pendiente</option>
                <option value="1">Finalizada</option>
            </select>
        </div>
    </div>
    <hr />
    <div>
        <button class="btn btn-info" id="btn_guardar" onclick="all_task_admin(1);"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
        <button class="btn btn-default" onclick="location.reload();" ><i class="fa fa-eraser" aria-hidden="true"></i> Restablecer</button>
    </div>
    <h1 class="page-header">Historial Tareas</h1>
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
                    <th title="Código Interno Solicitud" style="width:12px;">ID</th>
                    <th style="width:10px;">Fecha Solicitud</th>
                    <th style="width:10px;" title="Fecha Limite">Fecha Limite</th>
                    <th style="width:10px;" title="Fecha Gestiòn">Fecha Gestión</th>
                    <th title="Despacho Solicitante" style="width:12px;">Solicitante</th>
                    <th title="Descripción de la Acción de Gestión" style="width:120px;">Descripción</th>
                    <th title="Adjunto" style="width:120px;">Adjunto</th>
                    <th style="width:12px;">Detalles</th>
                    <th title="Descripción de la Gestión" style="width:120px;">Descripción Gestión</th>
                    <th style="width:12px;">editar</th>
                    <th style="width:12px;">Adicionar Actividad</th>
                    <th style="width:12px;">Listado de Actividades</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach($this->model->Vista_historial_tareasAD() as $r): ?>
                    <tr>
                        <td>
                            <?php echo $r->tar_id; ?>
                            <?php if($r->tar_estado != 0){ ?>
                                <i class="icon-checkmark" aria-hidden="true" style="color: green" title="Solicitud Gestionada"></i>
                            <?php }else{ ?>
                                <i class="glyphicon glyphicon-info-sign" aria-hidden="true" style="color: goldenrod" title="Solicitud En Tramite"></i>
                            <?php } ?>
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
                        <?php 
                            if($r->diferencia >= 0){
                                $colorC = "";
                            }else if($r->diferencia <0){
                                $colorC = "danger";
                            }else{
                                $colorC = "";
                            }
                        ?>
                        <td class="alert alert-<?php echo $colorC; ?>" ><?php echo $r->tar_fecha_gestion; ?></td>
                        <td><?php echo $r->empleado; ?></td>
                        <td><button class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal_Ver_M" data-descripcion="<?php echo $r->tar_descripcion ?>" ><i class="icon-zoom-in" style="font-size: 20px;" title="Ver Descripción"> </i></button></td>
                        <td>
                            <?php if($r->tar_ruta_doc !=""){ ?>
                                <a href="void()" class="btn btn-default" onclick="ver_doc_adjunto(1,'<?php echo $r->tar_ruta_doc; ?>');return false;" target="_blank" title="Descargar Documento Adjunto"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a>
                            <?php }else{ ?>
                                <span class="icon-blocked" style="color: red; font-size: 18px;" title="Sin Documento Adjunto"> </span>
                            <?php } ?>
                        </td>
                        <td><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal_verCompleto" data-codi="<?php echo $r->tar_id; ?>"data-clase="<?php echo $r->clase ?>"data-norma="<?php echo $r->norma ?>"data-causa="<?php echo $r->causa; ?>"data-metodologia="<?php echo $r->metodologia ?>"data-generada="<?php echo $r->generada; ?>" data-afectado="<?php echo $r->afectado; ?>" ><i class="icon icon-info" style="font-size: 20px;" title="Ver Acción de Gestión"> </i></button></td>
                        <?php if($r->tar_descripcion_gestion !="") { ?>
                            <td><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal_Ver_MG" data-obs_gestion="<?php echo $r->tar_descripcion_gestion; ?>" ><i class="icon icon-info" style="font-size: 20px;" title="Ver Descripción Gestión"> </i></button></td>
                        <?php }else{ ?>
                            <td><i class="icon-blocked" style="font-size: 20px;" title="Descripción Vacia"> </i></td>
                        <?php } ?>
                        <td>
                            editar..
                        </td>
                        <td><button data-toggle="modal" data-target="#myModal_Completar_AG" data-codi="<?php echo $r->tar_id; ?>" data-tar_id="<?php echo $r->tar_id; ?>"><img src="../views/images/add.png"></button></td>
                        
                            <td><br><?php
                                $conn2=mysql_connect("localhost","root","servicios2017");
                                    $db=mysql_select_db("centro_servicios2",$conn2);
                                        $consulta=mysql_query("SELECT det_id,det_tar_id,det_fecha_inicial,det_fecha_final,det_descripcion,pa_usuario.empleado,tar_ruta_doc,id FROM mc_tareas_detalles INNER JOIN pa_usuario ON mc_tareas_detalles.det_responsable = pa_usuario.id WHERE det_tar_id=$r->tar_id",$conn2);
                                            while($rows=mysql_fetch_row($consulta)){
                                                $det_id=$rows[0];
                                                $det_tar_id=$rows[1];
                                                $det_fecha_inicial=$rows[2];
                                                $det_fecha_final=$rows[3];
                                                $det_descripcion=$rows[4];
                                                $empleado=$rows[5];
                                                $tar_ruta_doc=$rows[6];
                            ?>
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <td>Responsable</td>
                                        <td>Documento</td>
                                        <td>Ver Más</td>
                                    </tr>
                                </thead>
                                <tr>
                                    <td><?php echo $empleado; ?></td>
                                    <td><?php if($tar_ruta_doc !=""){ ?>
                            <a href="void()" class="btn btn-default" onclick="ver_doc_adjunto(1,'<?php echo $tar_ruta_doc; ?>');return false;" target="_blank" title="Descargar Adjunto"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a>
                            <?php }else{ ?>
                                <span class="icon-blocked" style="color: red; font-size: 18px;" title="Sin Documento Adjunto"> </span>
                            <?php } ?></td>
                                    <td><button class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal_listaDetalles" data-tar_id="<?php echo $r->tar_id; ?>" data-det_id="<?php echo $det_id; ?>" data-det_fecha_inicial="<?php echo $det_fecha_inicial; ?>" data-det_fecha_final="<?php echo $det_fecha_final; ?>" data-det_descripcion="<?php echo $det_descripcion; ?>" data-empleado="<?php echo $empleado; ?>" data-tar_ruta_doc="<?php echo $tar_ruta_doc; ?>"><i class="icon-zoom-in" style="font-size: 20px;" title="Ver Detalles"> </i></button></td>
                                </tr>
                            </table>
                            <!--<button class="btn btn-info" data-toggle="modal" data-target="#myModal_listaDetalles2" data-tar_id="<?php echo $r->tar_id; ?>" data-det_id="<?php echo $det_id; ?>" data-det_fecha_inicial="<?php echo $det_fecha_inicial; ?>" data-det_fecha_final="<?php echo $det_fecha_final; ?>" data-det_descripcion="<?php echo $det_descripcion; ?>" data-empleado="<?php echo $empleado; ?>" data-tar_ruta_doc="<?php echo $tar_ruta_doc; ?>"><i class="icon-zoom-in" style="font-size: 20px;" title="Ver Detalles"> </i></button>-->
                            <br>
                            <?php
                                mysql_close($conn2);
                                            }
                            ?>
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

        <!-- Modal Ver Completar Acción de Gestión-->
        <div class="modal fade" id="myModal_Completar_AG" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form role="form" action="?c=Mejora_C&a=Completar_AG" method="post" id="frm-CompletarAG" enctype="multipart/form-data">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Completar Acción de Gestión </h4>
                        </div>
                        <!-- Modal Body -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="id">ID Acción</label>
                                <input readonly type="text" class="form-control" name="det_tar_id" id="det_tar_id"/>
                                <!--<input readonly type="text" class="form-control" name="tar_id" id="tar_id"/>-->
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-6">
                                    <label for="flag_estado">Fecha Inicial</label>
                                    <input readonly type="text" name="det_fecha_inicial" id="det_fecha_inicial" class="form-control datepicker" placeholder="Ingrese Fecha Inicial" data-validacion-tipo="requerido" />

                                </div>
                                <div class="col-xs-6">
                                    <label for="flag_estado">Fecha Final</label>
                                    <input readonly type="text" name="det_fecha_final" id="det_fecha_final" class="form-control datepicker" placeholder="Ingrese Fecha Final" data-validacion-tipo="requerido">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea class="form-control" name="det_descripcion" id="det_descripcion" rows="5" placeholder="Descripción de la Tarea" data-validacion-tipo="requerido|min:15" ></textarea>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-6">
                                    <label for="flag_estado">Responsable</label>
                                    <select type="text" name="det_responsable" id="det_responsable" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="requerido">
                                        <option value="">Seleccione una opción</option>
                                            <?php while($row = $lista_responsables->fetch()){ ?>
                                        <option value="<?php echo $row['id'] ?>" ><?php echo $row['empleado']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                                <div class="col-xs-6">
                                    <i class="glyphicon glyphicon-paperclip" aria-hidden="true"></i> <label>Adjuntar</label>
                                    <input id="file-1" name="tar_ruta_doc_adjunto" type="file" placeholder="Ingrese Documento" class="file" data-preview-file-type="any">
                                </div>
                                </div>
                                    <div class="col-xs-6">
                                        <?php if($mc->tar_ruta_doc_adjunto != ''): ?>
                                            <div class="img-thumbnail " style="border: 0px;">
                                                <a href="upload_tareas/<?php echo $mc->tar_ruta_doc_adjunto; ?>" target="_blank" style="text-decoration:none;"><i class="icon-download3"></i>Descargar</a>
                                            </div>
                                        <?php endif; ?>            
                                    </div>
                                </div>
                                <hr />
                            <div class="modal-footer">
                                <div class="text-right">
                                    <button class="btn btn-success" ><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar..</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>
            $('#myModal_Completar_AG').on('show.bs.modal', function (event) {
                var button          = $(event.relatedTarget) 
                var det_tar_id = button.data('tar_id')

                var modal = $(this)
                modal.find('.modal-body input[name="det_tar_id"]').val(det_tar_id)
            });
            $(document).ready(function(){
                $("#frm-CompletarAG").submit(function(){
                    return $(this).validate();
                });
            })
        </script>

        <!-- Modal Ver Acción de Gestión Completa-->
        <div class="modal fade" id="myModal_verCompleto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Acción de Gestión </h4>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="id">ID Acción VERcompl</label>
                            <input type="text" readonly="" class="form-control" name="id" id="id" placeholder="id"/>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="flag_estado">Clase </label>
                                <input type="text" readonly="" class="form-control" name="clase" id="clase" placeholder="Clase"/>
                            </div>
                            <div class="col-xs-6">
                                <label for="flag_estado">Numeral Norma </label>
                                <input type="text" readonly="" class="form-control" name="norma" id="norma" placeholder="Norma"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="flag_estado">Proceso Afectado o Impactado </label>
                            <input type="text" readonly="" class="form-control" name="afectado" id="afectado" placeholder="Norma"/>
                        </div>
                        <div class="form-group">
                            <label> Análisis de Causas </label>
                            <textarea class="form-control" readonly="" name="causas" id="comment" rows="5" placeholder="Análisis de Causas" ></textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="flag_estado">Metodología</label>
                                <input type="text" readonly="" class="form-control" name="metodologia" id="metodologia" placeholder="Metodologìa"/>
                            </div>
                            <div class="col-xs-6">
                                <label for="flag_estado">Generada por</label>
                                <input type="text" readonly="" class="form-control" name="generada" id="generada" placeholder="generada por"/>
                            </div>
                        </div>
                        <hr />
                        <div class="modal-footer">
                            <div class="text-right">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#myModal_verCompleto').on('show.bs.modal', function (event) {
                var button          = $(event.relatedTarget) 
                var id          = button.data('codi') 
                var clase       = button.data('clase') 
                var norma       = button.data('norma') 
                var afectado    = button.data('afectado')
                var causa       = button.data('causa') 
                var generada    = button.data('generada') 
                //alert(causa);
                var metodologia = button.data('metodologia') 
                var det_id      = button.data('det_id')

                var modal = $(this)
                modal.find('.modal-body input[name="id"]').val(id),
                modal.find('.modal-body input[name="clase"]').val(clase)
                modal.find('.modal-body input[name="norma"]').val(norma)
                modal.find('.modal-body input[name="afectado"]').val(afectado)
                modal.find('.modal-body textarea[name="causas"]').val(causa)
                modal.find('.modal-body input[name="metodologia"]').val(metodologia)
                modal.find('.modal-body input[name="generada"]').val(generada)

                modal.find('.modal-body input[name="det_id"]').val(det_id)
            });
            $(document).ready(function(){
                $("#frm-CompletarAG").submit(function(){
                    return $(this).validate();
                });
            })
        </script>


  
        <!-- Modal Ver Acción de Gestión Completa-->
       <div class="modal fade" id="myModal_listaDetalles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">             
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Lista Tareas</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ID Acción</label>
                            <input type="text" readonly="" class="form-control" name="tar_id" id="tar_id" placeholder="tar_id"/>
                            <!--<input type="text" readonly="" class="form-control" name="det_id" id="tar_id" placeholder="det_id"/>-->
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label>Fecha Inicial</label>
                                <input readonly="" type="text" name="det_fecha_inicial" id="det_fecha_inicial" class="form-control datepicker" placeholder="Ingrese Fecha Inicial" data-validacion-tipo="requerido" />
                            </div>
                            <div class="col-xs-6">
                                <label for="det_fecha_final">Fecha Final</label>
                                <input readonly="" type="text" name="det_fecha_final" id="det_fecha_final" class="form-control datepicker" placeholder="Ingrese Fecha Final" data-validacion-tipo="requerido">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea readonly="" class="form-control" name="det_descripcion" id="det_descripcion" rows="5" placeholder="Descripción de la Tarea" data-validacion-tipo="requerido|min:15" ></textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="responsable">Responsable</label>
                                <input readonly="" name="empleado" id="empleado" class="form-control">
                            </div>
                            <div class="col-xs-6">
                                <label for="responsable">Adjunto</label>
                                <input readonly="" name="tar_ruta_doc" id="tar_ruta_doc" class="form-control">
                            </div>
                        </div>
                        <hr />
                        <div class="modal-footer">
                            <div class="text-right">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="myModal_listaDetalles2" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4>Editar Contacto</h4>
                    </div>
                    <div class="modal-body"> 
                    <form action="actualizar.php" method="POST">
                        <div class="form-group">
                            <label for="det_id">tar_id:</label>
                            <input id="tar_id" name="tar_id" type="text" ></input>
                        </div>
                        <div class="form-group">
                            <label for="det_id">det_id:</label>
                            <a class="form-control" id="det_id" name="det_id" type="text" required="true" maxlength="35">ver</a>
                        </div> 
                        <input type="submit" class="btn btn-success" value="Actualizar"> 
                    </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#myModal_listaDetalles2').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient0 = button.data('tar_id')
                var recipient1 = button.data('det_id')

                var modal = $(this)
                modal.find('.modal-body #tar_id').val(recipient0)
                modal.find('.modal-body #det_id').val(recipient1)
            });
        </script>

        <script>
            /*function myFunction() {
                var option_value = document.getElementById("numbers").value;
                if (option_value == "3") {
                    alert("Hai !");
                }
            }*/

            $('#myModal_listaDetalles').on('show.bs.modal', function (event) {
                var button            = $(event.relatedTarget)
                var tar_id            = button.data('tar_id')  
                var det_id            = button.data('det_id')
                var det_fecha_inicial = button.data('det_fecha_inicial')  
                var det_fecha_final   = button.data('det_fecha_final')
                var det_descripcion   = button.data('det_descripcion')  
                var empleado          = button.data('empleado')
                var tar_ruta_doc      = button.data('tar_ruta_doc')

                var modal = $(this)
                modal.find('.modal-body input[name="tar_id"]').val(tar_id)
                modal.find('.modal-body input[name="det_id"]').val(det_id)
                modal.find('.modal-body input[name="det_fecha_inicial"]').val(det_fecha_inicial)
                modal.find('.modal-body input[name="det_fecha_final"]').val(det_fecha_final)
                modal.find('.modal-body textarea[name="det_descripcion"]').val(det_descripcion)
                modal.find('.modal-body input[name="empleado"]').val(empleado)
                modal.find('.modal-body input[name="tar_ruta_doc"]').val(tar_ruta_doc)
               // modal.find('.modal-body #tar_ruta_doc').val(tar_ruta_doc)
            });
            $(document).ready(function(){
                $("#frm-CompletarAG").submit(function(){
                    return $(this).validate();
                });
            })
        </script>

<?php //foreach($this->model->Vista_Detalles() as $r2): ?>
                <!-- Modal Ver detalles tareas-->
        <div class="modal fade" id="myModal_Detalles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="#" role="form" action="?c=Mejora_C&a=Completar_AG" method="post" id="frm-CompletarAG" enctype="multipart/form-data">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Detalles Tarea</h4>
                        </div>
                        <!-- Modal Body -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="id">ID Acción</label>
                                <input readonly type="text" class="form-control" name="det_tar_id" id="det_tar_id"/>
                                <!--<input readonly type="text" class="form-control" name="tar_id" id="tar_id"/>-->
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-6">
                                    <label for="id">Fecha Inicial</label>
                                    <input readonly type="text" class="form-control" name="det_fecha_inicial" id="det_fecha_inicial"/>
                                </div>
                                <div class="col-xs-6">
                                    <label for="id">Fecha Final</label>
                                    <input readonly type="text" class="form-control" name="det_fecha_final" id="det_fecha_final"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea class="form-control" name="det_descripcion" id="det_descripcion" rows="5"></textarea>
                            </div>

                            <div class="form-group row">
                                <div class="col-xs-6">
                                    <label for="flag_estado">Responsable</label>
                                    <input type="text" name="empleado" id="empleado" class="form-control">
                                </div>
                                <div class="col-xs-6">
                                    <label for="flag_estado">Documento</label>
                                    <input type="hidden" id="tar_ruta_doc" name="tar_ruta_doc" value="<?php echo $_POST['tar_ruta_doc']; ?>"  />
                                    <?php
                                        $doc= "$_POST[tar_ruta_doc]";
                                    ?></div>
                                <input type="submit" value="<?php echo $doc; ?>">
                                <?php echo $doc;
                                  echo $fac = $_GET['tar_ruta_doc'];
                                ?>
                            </div>
                            <hr />
                            <div class="modal-footer">
                                <div class="text-right">
                                    <button class="btn btn-success" ><i class="glyphicon glyphicon-floppy-disk"></i> Guarda</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar..</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php //endforeach ?>

        <script>
            $('#myModal_Detalles').on('show.bs.modal', function (event) {
                var button            = $(event.relatedTarget) 
                var det_tar_id        = button.data('tar_id')
                var det_fecha_inicial = button.data('det_fecha_inicial')
                var det_fecha_final   = button.data('det_fecha_final')
                var det_descripcion   = button.data('det_descripcion')
                var empleado          = button.data('empleado')
                var tar_ruta_doc      = button.data('tar_ruta_doc')

                var modal = $(this)
                modal.find('.modal-body input[name="det_tar_id"]').val(det_tar_id)
                modal.find('.modal-body input[name="det_fecha_inicial"]').val(det_fecha_inicial)
                modal.find('.modal-body input[name="det_fecha_final"]').val(det_fecha_final)
                modal.find('.modal-body textarea[name="det_descripcion"]').val(det_descripcion)
                modal.find('.modal-body input[name="empleado"]').val(empleado)
                //modal.find('.modal-body a[href="tar_ruta_doc"]').val(tar_ruta_doc)
                modal.find('.modal-body input[name="tar_ruta_doc"]').val(tar_ruta_doc)

                modal.find('.modal-body').attr("href", "{{ url('/companies') }}" + "/" + tar_ruta_doc)

            });
            $(document).ready(function(){
                $("#frm-CompletarAG").submit(function(){
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