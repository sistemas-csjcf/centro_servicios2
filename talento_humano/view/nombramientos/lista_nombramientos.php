<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user              = $_SESSION['idUsuario'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo               = new HojaVida();
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '30';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios['usuario']);
    $lista_usuario        = $modelo->get_datos_usuariosTH();
    
    if(isset($id_user)){
        if ( in_array($_SESSION['idUsuario'], $usuariosa) ) {
?>
    <h1 class="page-header">Resoluciones Nombramiento</h1>
    <div class="form-group row">
        <div class="col-xs-4">
            <label for="usuario">Empleado</label>
            <select name="id_usuario" id="id_usuario" class="form-control selectpicker" data-live-search="true">
                <option value="">Seleccionar Empleado</option>
                <?php while ($row = $lista_usuario->fetch()){ ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['empleado'] ?></option>
                <?php } ?>
            </select>
        </div>
        
        <div class="col-xs-4">
            <label for="tipo_nombramiento">Tipo Nombramiento</label>
            <select name="tipo_nombramiento" id="tipo_nombramiento" class="form-control">
                <option value="">Seleccionar Tipo nombramiento</option>
                <option value="1">Propiedad</option>
                <option value="2">Provisionalidad</option>
                <option value="3">Encargo</option>
            </select>
        </div>
        <div class="col-xs-4">
            
        </div>
    </div>
    <div>
        <div class="col-xs-8 well well-sm text-left">
            <button class="btn btn-info" id="btn_guardar" onclick="filtro_resoluciones_nombramiento();"><span class="glyphicon glyphicon-search"></span> Consultar</button>
            <button class="btn btn-default" onclick="location.reload();" ><i class="fa fa-eraser" aria-hidden="true"></i>Restablecer</button>
        </div>

        <div class="col-xs-4 well well-sm text-right">
            <a class="btn btn-primary" href="?c=hoja_vida&a=Crud_Res_Nombramiento"><i class="glyphicon glyphicon-plus-sign"></i> Nuevo Registro</a>
        </div>
    </div>
    <br />
     
    <div id="load" style="display: none">
        <div class="progress" >
            <div id="bar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                <span class="sr-only">10% Complete</span>
            </div>
        </div>
    </div>
    <div id="resultado"></div>
    <div id="tb_inicial">
        <table id="example" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #4682B4; color: white;">
                    <th title="Código Interno Resoluciòn Nombramiento" style="width:12px;">ID</th>
                    <th style="width:12px;">Clase Nombramiento</th>
                    <th title="Empleado" style="width:12px;">Nombre Empleado</th>
                    <th style="width:12px;">Cargo</th>
                    <th style="width:12px;"># Resoluciòn</th>
                    <th style="width:12px;">Fecha Inicio</th>
                    <th style="width:12px;">Fecha Fin</th>
                    <th title="Documentaciòn Relacionada" style="width:12px;">Documentaciòn Anexada</th>
                    <th title="Generar Resoluciòn/Acta" style="width:12px;">Generar Documento</th>
                    <th style="width:12px;">Editar</th>
                </tr>
            </thead>
            <tbody> 
                <?php 
                    foreach($this->model->Lista_Resoluciones_Nombramiento() as $r): 
                        $id_est = $r->res_nom_id;
                ?>
                    <tr>
                        <td>
                            <?php 
                                if($r->res_nom_fecha_inicio == '0000-00-00'){
                                    $estado = "En Proceso";
                                    $color ="sandybrown";
                                    $icon = "warning";
                                }else{
                                    $estado = "Aprobado";
                                    $color ="green";
                                    $icon = "flag";
                                }
                            ?>
                            <span class="icon-<?php echo $icon; ?>" style="color: <?php echo $color; ?>"></span>
                            <?php echo $r->res_nom_id; ?>
                        </td>
                        <td><?php echo $r->clas_titulo; ?></td>
                        <td><?php echo $r->empleado; ?></td>
                        <td><?php echo $r->cargo; ?></td>
                        <td><?php echo $r->res_nom_consecutivo; ?></td>
                        <td><?php echo $r->res_nom_fecha_inicio; ?></td>
                        <td><?php echo $r->res_nom_fecha_fin; ?></td>
                        <td>
                            <?php if($r->res_nom_ruta_contraloria !=""){ ?>
                                <a href="#" class="btn btn-default" title="Certificado Responsabilidad Social - CONTRALORIA" onclick="ver_pdf(9,'<?php echo $r->res_nom_ruta_contraloria; ?>');return false;" target="_blank">
                                    <span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span><p style="font-size: 8px;">Contraloria</p>
                                </a>
                            <?php }else{ ?>
                                <a href="#" class="btn btn-default" title="Certificado Responsabilidad Social - CONTRALORIA" onclick="ver_pdf(9,'<?php echo $r->res_nom_ruta_contraloria; ?>');return false;" target="_blank">
                                    <span class="icon icon-cross" style="font-size: 18px; color: red;"></span>
                                </a>
                            <?php } ?>
                            <?php if($r->res_nom_ruta_procuraduria !=""){ ?>
                                <a href="#" class="btn btn-default" title="Certificado Antecedentes - PROCURADURIA" onclick="ver_pdf(9,'<?php echo $r->res_nom_ruta_procuraduria; ?>');return false;" target="_blank">
                                    <span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span><p style="font-size: 8px;">Procuraduria</p>
                                </a>
                            <?php }else{ ?>
                                <a href="#" class="btn btn-default" title="Certificado Antecedentes - PROCURADURIA" onclick="ver_pdf(9,'<?php echo $r->res_nom_ruta_procuraduria; ?>');return false;" target="_blank">
                                    <span class="icon icon-cross" style="font-size: 18px; color: red;"></span>
                                </a>
                            <?php } ?>
                            <?php if($r->res_nom_ruta_medidas !=""){ ?>
                                <a href="#" class="btn btn-default" title="Certificado Medidas Correctivas" onclick="ver_pdf(9,'<?php echo $r->res_nom_ruta_medidas; ?>');return false;" target="_blank">
                                    <span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span><p style="font-size: 8px;">Medidas</p>
                                </a>
                            <?php }else{ ?>
                                <a href="#" class="btn btn-default" title="Certificado Medidas Correctivas" onclick="ver_pdf(9,'<?php echo $r->res_nom_ruta_medidas; ?>');return false;" target="_blank">
                                    <span class="icon icon-cross" style="font-size: 18px; color: red;"></span>
                                </a>
                            <?php } ?>
                            <?php if($r->res_nom_ruta_antecedentes !=""){ ?>
                                <a href="#" class="btn btn-default" title="Certificado Antecedentes Judiciales" onclick="ver_pdf(9,'<?php echo $r->res_nom_ruta_antecedentes; ?>');return false;" target="_blank">
                                    <span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span><p style="font-size: 8px;">Antecedentes</p>
                                </a>
                            <?php }else{ ?>
                                <a href="#" class="btn btn-default" title="Certificado Antecedentes Judiciales" onclick="ver_pdf(9,'<?php echo $r->res_nom_ruta_antecedentes; ?>');return false;" target="_blank">
                                    <span class="icon icon-cross" style="font-size: 18px; color: red;"></span>
                                </a>
                            <?php } ?>
                            <?php if($r->res_nom_ruta_inhabilidades !=""){ ?>
                                <a href="#" class="btn btn-default" title="Declaración Juramentada de Inhabilidades" onclick="ver_pdf(9,'<?php echo $r->res_nom_ruta_inhabilidades; ?>');return false;" target="_blank">
                                    <span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span><p style="font-size: 8px;">Inhabilidades</p>
                                </a>
                            <?php }else{ ?>
                                <a href="#" class="btn btn-default" title="Declaración Juramentada de Inhabilidades" onclick="ver_pdf(9,'<?php echo $r->res_nom_ruta_inhabilidades; ?>');return false;" target="_blank">
                                    <span class="icon icon-cross" style="font-size: 18px; color: red;"></span>
                                </a>
                            <?php } ?>
                        </td>
                        <td>
                            <?php 
                                if($r->clas_id == 1){
                                    $ruta_doc = "crear_resolucion_nombramiento_propiedad.php";
                                }else if($r->clas_id == 2){
                                    $ruta_doc = "crear_resolucion_nombramiento_provisionalidad.php";
                                }else if($r->clas_id == 3){
                                    $ruta_doc = "crear_resolucion_nombramiento_encargo.php";
                                }else{
                                    $ruta_doc = "#";
                                }
                            ?>
                            <a href="app/libs/plantillero/<?php echo $ruta_doc; ?>?id=<?php echo $r->res_nom_id; ?>" style="text-decoration: none;" title="Resolución Nombramiento">
                                <span class="icon-file-word" style="font-size: 25px;"> </span>
                            </a>
                            <?php if($r->res_nom_fecha_inicio != '0000-00-00'){ ?>
                                <a href="app/libs/plantillero/crear_acta_nombramiento.php?id=<?php echo $r->res_nom_id; ?>" style="text-decoration: none;" title="Acta de Posesión">
                                    <i class="fa fa-file-word-o" aria-hidden="true" style="font-size: 25px;"></i>
                                </a>
                            <?php }else{ ?>
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-id="<?php echo $r->res_nom_id; ?>" data-target="#Modal_Acta" data-return_flag="1" ><i class="fa fa-plus" aria-hidden="true"></i> Adicionar</a>
                            <?php } ?>
                        </td>
                        <td>
                            <a href="#" class="btn btn-default" id="editarR" data-toggle="modal" data-id="<?php echo $r->res_nom_id; ?>"data-id_usuario="<?php echo $r->res_nom_id_usuario; ?>" data-fecha_inicio="<?php echo $r->res_nom_fecha_inicio; ?>"data-num_cdp="<?php echo $r->res_nom_cdp; ?>"data-id_cargo="<?php echo $r->res_nom_id_cargo; ?>" data-target="#Modal_Editar" data-return_flag="1" >
                                <span class="icon icon-pencil" style="font-size: 18px; color: goldenrod;"></span> 
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Modal Acta-->
    <div class="modal fade" id="Modal_Acta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Adicionar Datos Acta</h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form role="form" action="?c=Hoja_vida&a=change_data_actaNombramiento" method="post" >
                        <div class="form-group">
                            <label for="id">ID Nombramiento</label>
                            <input type="text" readonly="" class="form-control" name="id" id="id" placeholder="id"/>
                        </div>
                        <div class="form-group">
                            <label for="motivo">Fecha Inicio Nombramiento</label>
                            <input type="date" name="res_fecha_inicio" class="form-control" placeholder="fecha_inicio" > 
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
        $('#Modal_Acta').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var id     = button.data('id') 
            
            var modal  = $(this)
            modal.find('.modal-body input[name="id"]').val(id)
            
        })
    </script>

    <!-- Modal Editar-->
    <div class="modal fade" id="Modal_Editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Editar Datos Resoluciòn</h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form role="form" action="?c=Hoja_vida&a=Editar_data_Nombramiento" method="post" >
                        <div class="form-group">
                            <label for="id">ID Nombramiento</label>
                            <input type="text" readonly="" class="form-control" name="id" id="id" placeholder="id"/>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="motivo">Empleado</label>
                                <div id="empleado"></div>
                            </div>
                            <div class="col-xs-6">
                                <label for="motivo">Cargo</label>
                                <div id="cargo"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="motivo">Fecha Inicio Nombramiento</label>
                                <input type="date" name="res_fecha_inicio" class="form-control" placeholder="fecha_inicio" > 
                            </div>
                            <div class="col-xs-6">
                                <label for="motivo">CDP</label>
                                <input type="text" name="res_cdp" class="form-control" placeholder="Certificado Disponibilidad Presupuestal" > 
                            </div>
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
        $(document).ready(function(){
            $(document).on('click', '#editarR', function(e){
                // Definimos las variables de javascrpt 
                var id_empleado = $(this).data('id_usuario');
                var id_cargo    = $(this).data('id_cargo');
                var ruta        = $(this).data('ruta');

                if(ruta!=""){
                    var rutaFormato = "documentos_HV/Certificados_Estudios/"+ruta;
                }else{
                    var rutaFormato = "#";
                }
                // Ejecutamos AJAX
                $("#empleado").load('content/Res_Nomb_empleado.php?id_empleado='+id_empleado);
                $("#cargo").load('content/Res_Nomb_Cargo.php?id_cargo='+id_cargo);
                $("#certificado_estudio").load('content/For_rutaDoc.php?ruta='+rutaFormato);
            }); 
        });
        
        $('#Modal_Editar').on('show.bs.modal', function (event) {
            var button  = $(event.relatedTarget)
            var id      = button.data('id') 
            var FI      = button.data('fecha_inicio')
            var num_cdp = button.data('num_cdp');
            
            var modal  = $(this)
            modal.find('.modal-body input[name="id"]').val(id)
            modal.find('.modal-body input[name="res_fecha_inicio"]').val(FI)
            modal.find('.modal-body input[name="res_cdp"]').val(num_cdp)
            
        })
    </script>
    
    
<?php }else{ ?><br/>
    <h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para acceder a esta opción</h4>
<?php } ?>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php  header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>