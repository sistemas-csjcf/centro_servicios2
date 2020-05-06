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
                    <th style="width:12px;">Documento</th>
                    <th style="width:12px;">Responsable</th>
                    <th title="Descripción de la Gestión" style="width:120px;">Descripción Gestión</th>
                    <th style="width:12px;">Documento</th>
                    <th style="width:12px;">Detalles</th>
                    <th style="width:12px;">Adicionar Proceso</th>
                    <th style="width:12px;">Procesos</th>
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
                        <td>
                            <?php
                                $datos_user = $modelo->get_dato_Usuario1($r->tar_id_user_responsable);
                                $get_user   = $datos_user->fetch();
                                echo $get_user['empleado'];
                            ?>
                        </td>
                        <?php if($r->tar_descripcion_gestion !="") { ?>
                            <td><button class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal_Ver_MG" data-obs_gestion="<?php echo $r->tar_descripcion_gestion; ?>" ><i class="icon-zoom-in" style="font-size: 20px;" title="Ver Descripción Gestión"> </i></button></td>
                        <?php }else{ ?>
                            <td><i class="icon-blocked" style="font-size: 20px;" title="Descripción Vacia"> </i></td>
                        <?php } ?>
                        <td>
                            <?php if($r->tar_ruta_doc_gestion !=""){ ?>
                                <a href="void()" class="btn btn-default" onclick="ver_doc_adjunto(2,'<?php echo $r->tar_ruta_doc_gestion; ?>');return false;" target="_blank" title="Descargar Documento Adjunto"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a>
                            <?php }else{ ?>
                                <span class="icon-blocked" style="color: red; font-size: 18px;" title="Sin Documento Adjunto"> </span>
                            <?php } ?>
                        </td>

                        <td><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal_verCompleto" data-codi="<?php echo $r->tar_id; ?>"data-clase="<?php echo $r->clase ?>"data-norma="<?php echo $r->norma ?>"data-causa="<?php echo $r->causa; ?>"data-metodologia="<?php echo $r->metodologia ?>"data-generada="<?php echo $r->generada; ?>" data-afectado="<?php echo $r->afectado; ?>" ><i class="icon icon-info" style="font-size: 20px;" title="Ver Acción de Gestión"> </i></button></td>

                        <td><button data-toggle="modal" data-target="#myModal_Completar_AG" data-codi="<?php echo $r->tar_id; ?>" data-tar_id="<?php echo $r->tar_id; ?>"><img src="../views/images/add.png"></button></td>
                        
                            <td><?php
                                $conn2=mysql_connect("localhost","root","servicios2017");
                                    $db=mysql_select_db("centro_servicios2",$conn2);
                                        $consulta=mysql_query("SELECT * FROM mc_tareas_detalles WHERE det_tar_id=$r->tar_id",$conn2);
                                            while($rows=mysql_fetch_row($consulta)){
                                                $det_id=$rows[0];
                                                $det_tar_id=$rows[1];
                                                echo $det_id;
                                mysql_close($conn2);
                            ?>

                            <button data-toggle="modal" data-target="#myModal_Detalles" data-codi="<?php echo $det_id; ?>" data-tar_id="<?php echo $det_id; ?>" data-det_tar_id="<?php echo $det_tar_id; ?>"><img src="../views/images/add.png"></button>
                            <?php
                                            }
                            ?></td>
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
                                <textarea class="form-control" name="det_descripcion" id="det_descripcion" rows="5" placeholder="Ingrese" data-validacion-tipo="requerido|min:5" >...........</textarea>
                            </div>
                            <div class="form-group">
                                <label for="flag_estado">Responsable</label>
                                <select type="text" name="det_responsable" id="det_responsable" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="requerido">
                                    <option value="">Seleccione una opción</option>
                                        <?php while($row = $lista_responsables->fetch()){ ?>
                                    <option value="<?php echo $row['id'] ?>" ><?php echo $row['empleado']; ?></option>
                                <?php } ?>
                            </select>
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




        **************
<?php foreach($this->model->Vista_Detalles() as $r2):

    
                                                ?>
                <!-- Modal Ver detalles tareas-->
        <div class="modal fade" id="myModal_Detalles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form role="form" action="?c=Mejora_C&a=Completar_AG" method="post" id="frm-CompletarAG" enctype="multipart/form-data">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Detalles</h4>
                        </div>
                        <!-- Modal Body -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="id">ID Acción</label>
                                <input readonly type="text" class="form-control" name="det_tar_id" id="det_tar_id"/>
                                <!--<input readonly type="text" class="form-control" name="tar_id" id="tar_id"/>-->
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



        <?php endforeach ?>
        <script>
            $('#myModal_Detalles').on('show.bs.modal', function (event) {
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

    <?php }else{ ?> 
        <h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para acceder a esta opción</h4>
    <?php } ?> 
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>



