<?php
    session_start();
    $_SESSION['nombre'];
    $id_user = $_SESSION['idUsuario'];
    require_once "../../core/conexion.php";
    require_once "../../model/mejora_continua_model.php";
    $modelo  = new mejora_c();
    $link       = conectarse();
    $id             = $_POST['id'];
    $fechaI         = $_POST['inicio'];
    $fechaF         = $_POST['fin'];
    $solicitante    = $_POST['id_solicitante'];
    $responsable    = $_POST['id_responsable'];
    $id_clase       = $_POST['id_clase'];
    $id_norma       = $_POST['id_norma'];
    $id_metodologia = $_POST['id_metodologia'];
    $id_generadax   = $_POST['id_generadax'];
    $estado         = $_POST['estado'];
    
    if ( !empty($responsable) ) {   
        $filtro1 = " AND tar_id_user_responsable = '$responsable' ";
    }
    if ( !empty($fechaI) && !empty($fechaF) ) {     
        $filtro2 = " AND (tar_fecha BETWEEN '$fechaI' AND '$fechaF') ";
    }
    if ( $solicitante != '') {
        $filtro3 = " AND tar_id_user = '$solicitante' ";
    }
    if ( !empty($id) ) {    
        $filtro4 = " AND tar_id = '$id' ";
    }
    if ( !empty($id_clase) ) {  
        $filtro5 = " AND tar_id_clase = '$id_clase' ";
    }
    if ( !empty($id_norma) ) {  
        $filtro6 = " AND tar_id_numeral = '$id_norma' ";
    }
    if ( !empty($id_metodologia) ) {    
        $filtro7 = " AND tar_id_metodologia = '$id_metodologia' ";
    }
    if ( !empty($id_generadax) ) {  
        $filtro8 = " AND tar_id_generada = '$id_generadax' ";
    }
    if ($estado !="" ) {    
        $filtroEst = " AND tar_estado = '$estado' ";
    }
    $filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtroEst;
    
    $sql=("SELECT DATEDIFF(tar_fecha_limite, `tar_fecha_gestion`)AS diferencia,`tar_id`, `tar_fecha`,`ta`.`tar_fecha_limite` AS `tar_fecha_limite`, `tar_fecha_gestion`,
            `tar_id_user`,`tar_id_user_responsable`, `tar_descripcion`, `tar_ruta_doc`, `ta`.`tar_id_userE` AS `tar_id_userE`,
            `ta`.`tar_fechaE` AS `tar_fechaE`,`ta`.`tar_fecha_gestion` AS `tar_fecha_gestion`,`ta`.`tar_descripcion_gestion` AS `tar_descripcion_gestion`,
            `ta`.`tar_ruta_doc_gestion` AS `tar_ruta_doc_gestion`,`tar_estado`, `tar_fecha_limite`, us.empleado, clas_titulo AS clase, nor.nor_titulo AS norma, pro.proc_titulo AS afectado, tar_causa AS causa, met_titulo as metodologia, gen.gen_titulo AS generada

                FROM `mc_tareas` AS ta
                INNER JOIN pa_usuario AS us ON ta.tar_id_user = us.id
LEFT join `mc_clase` AS `clas` ON `ta`.`tar_id_clase` = `clas`.`clas_id`
LEFT JOIN `mc_normas` AS `nor` ON `ta`.`tar_id_numeral` = `nor`.`nor_id`
LEFT JOIN `mc_procesos_cs` AS `pro` ON `pro`.`proc_id` = `ta`.`tar_id_proceso_afectado`
LEFT JOIN `mc_metodologias` AS `met` ON `ta`.`tar_id_metodologia` = `met`.`met_id`
LEFT JOIN `mc_generada` AS `gen` ON `ta`.`tar_id_generada` = `gen`.`gen_id`
        WHERE tar_id > '0' AND tar_id NOT IN (14,100) " .$filtrox. " ORDER BY tar_id DESC");
    $result=mysql_query($sql,$link);
    
    $num_filas = mysql_num_rows($result); 
     if($num_filas>0){ 
        $alerta = "success";
        $mensaje = "";
    }else{
        $alerta = "danger";
        $mensaje = "No existen datos registrados";
    }
    if(isset($id_user)){
?>
        <div class="alert alert-<?php echo $alerta; ?>" role="alert">Total Registros: <strong><?php echo $num_filas;?> <?php echo $mensaje; ?></strong></div>
        <table id="example4" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #B71F56; color: white;">
                    <th title="Código Interno Tarea" style="width:12px;">ID</th>
                    <th style="width:10px;">Fecha Tarea</th>
                    <th style="width:10px;" title="Fecha Limite">Fecha Limite</th>
                    <th style="width:10px;" title="Fecha Gestiòn">Fecha Gestión</th>
                    <th title="Despacho Solicitante" style="width:12px;">Solicitante</th>
                    <th title="Descripción de la Solicitud/Tarea" style="width:120px;">Descripción Tarea</th>
                    <th style="width:12px;">Documento</th>
                    <th style="width:12px;">Responsable</th>
                    <th title="Descripción de la Gestión" style="width:120px;">Descripción Gestión</th>
                    <th style="width:12px;">Documento</th>
                    <!--<th style="width:12px;">Completar</th> -->
                    <th style="width:12px;">Ver más</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=0; $i <$num_filas; $i++){ ?>
                   <?php while ($r = mysql_fetch_array($result)) { ?>
                        <tr>
                            <td>
                                <?php echo $r['tar_id']; ?>
                                <?php if($r['tar_estado'] != 0){ ?>
                                    <i class="icon-checkmark" aria-hidden="true" style="color: green" title="Solicitud Gestionada"></i>
                                <?php }else{ ?>
                                    <i class="glyphicon glyphicon-info-sign" aria-hidden="true" style="color: goldenrod" title="Solicitud En Tramite"></i>
                                <?php } ?>
                            </td>
                            <td><?php echo $r['tar_fecha']; ?></td>
                            <?php 
                                if($r['tar_fecha_limite'] =='0000-00-00'){
                                    $color="red";
                                    $txt = "Sin asignar Fecha";
                                }else{
                                    $color="";
                                    $txt = $r['tar_fecha_limite'];
                                }
                            ?>
                            <td style="color: <?php echo $color; ?>"><?php echo $txt; ?></td>
                            <?php 
                                if($r['diferencia'] >= 0){
                                    $colorC = "";
                                }else if($r['diferencia'] <0){
                                    $colorC = "danger";
                                }else{
                                    $colorC = "";
                                }
                            ?>
                            <td class="alert alert-<?php echo $colorC; ?>" ><?php echo $r['tar_fecha_gestion']; ?></td>
                            <td><?php echo $r['empleado']; ?></td>
                            <td><button class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal_Ver_M" data-descripcion="<?php echo $r['tar_descripcion'] ?>" ><i class="icon-zoom-in" style="font-size: 20px;" title="Ver Descripción"> </i></button></td>
                            <td>
                                <?php if($r['tar_ruta_doc'] !=""){ ?>
                                    <a href="void()" class="btn btn-default" onclick="ver_doc_adjunto(1,'<?php echo $r['tar_ruta_doc']; ?>');return false;" target="_blank" title="Descargar Documento Adjunto"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a>
                                <?php }else{ ?>
                                    <span class="icon-blocked" style="color: red; font-size: 18px;" title="Sin Documento Adjunto"> </span>
                                <?php } ?>
                            </td>
                            <td><?php
                                    $datos_user = $modelo->get_dato_Usuario1($r['tar_id_user_responsable']);
                                    $get_user   = $datos_user->fetch();
                                    echo $get_user['empleado'];
                                ?>
                            </td>
                            <?php if($r['tar_descripcion_gestion'] !="") { ?>
                                <td><button class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal_Ver_MG" data-obs_gestion="<?php echo $r['tar_descripcion_gestion'] ?>" ><i class="icon-zoom-in" style="font-size: 20px;" title="Ver Descripción Gestión"> </i></button></td>
                            <?php }else{ ?>
                                <td><i class="icon-blocked" style="font-size: 20px;" title="Descripción Vacia"> </i></td>
                            <?php } ?>
                            <td>
                                <?php if($r['tar_ruta_doc_gestion'] !=""){ ?>
                                    <a href="void()" class="btn btn-default" onclick="ver_doc_adjunto(1,'<?php echo $r['tar_ruta_doc_gestion']; ?>');return false;" target="_blank" title="Descargar Documento Adjunto"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a>
                                <?php }else{ ?>
                                    <span class="icon-blocked" style="color: red; font-size: 18px;" title="Sin Documento Adjunto"> </span>
                                <?php } ?>
                            </td>
                            <!--<td><button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal_Completar_AG" data-codi="<?php echo $r['tar_id']; ?>" ><i class="icon icon-pencil2" style="font-size: 20px;" title="Completar Acción de Gestión"> </i></button></td>-->

                            <td><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal_verCompleto" data-codi="<?php echo $r['tar_id']; ?>"data-clase="<?php echo $r['clase'] ?>"data-norma="<?php echo $r['norma'] ?>"data-causa="<?php echo $r['causa']; ?>"data-metodologia="<?php echo $r['metodologia'] ?>"data-generada="<?php echo $r['generada']; ?>"data-afectado="<?php echo $r['afectado']; ?>" ><i class="icon icon-info" style="font-size: 20px;" title="Ver Acción de Gestión"> </i></button></td>
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
                            <label for="id">ID Acción Gestión</label>
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
                            <input type="text" readonly="" class="form-control" name="afectado" id="afectado" placeholder="Proceso Afectado"/>
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
                var afectado       = button.data('afectado')
                var causa       = button.data('causa') 
                //alert(causa);
                var generada    = button.data('generada') 
                alert(generada);
                var metodologia = button.data('metodologia') 

                var modal = $(this)
                modal.find('.modal-body input[name="id"]').val(id),
                modal.find('.modal-body input[name="clase"]').val(clase)
                modal.find('.modal-body input[name="norma"]').val(norma)
                modal.find('.modal-body input[name="afectado"]').val(afectado)
                modal.find('.modal-body textarea[name="causas"]').val(causa)
                modal.find('.modal-body input[name="metodologia"]').val(metodologia)
                modal.find('.modal-body input[name="generada"]').val(generada)
            });
            $(document).ready(function(){
                $("#frm-CompletarAG").submit(function(){
                    return $(this).validate();
                });
            })
        </script>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>