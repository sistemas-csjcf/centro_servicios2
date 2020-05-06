<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user = $_SESSION['idUsuario'];
    $id_hv =0;
    require_once "core/conexion.php";
    $link=conectarse();
    $sql="SELECT * FROM th_personas WHERE per_id_usuario = '$id_user'";
    $res=mysql_query($sql,$link);

    $modelo             = New HojaVida();
    $lista_areas_cs     = $modelo->get_Areas_cs();
    $lista_departamento = $modelo->get_Departamento();
    $lista_municipio    = $modelo->Get_Municipio_Asociado($hv->per_id_dep_nacimiento);
    $nivel_educacion    = $modelo->get_nivelEducacion();
    
    while ($row = mysql_fetch_array($res)) {
        $user = $row[0];
    }
    $Listar_HV    = $modelo->get_Datos_HV($user);
    while($r = $Listar_HV->fetch()){
        $id_hv = $r[0];
    }
    $num_filas = mysql_num_rows($res);
    //************
    $Listar_DP    = $modelo->Listar_DatosPersona($id_user);
    $total_datos = count($Listar_DP);
    $estudios = $modelo->Listar_FormacionProfesional($id_hv);
    $total_estudios = count($estudios);
    $laboral =$modelo->Listar_Exp_Laboral($id_hv);
    $total_laboral= count($laboral);
    $refe = $modelo->Listar_Ref_Personal($id_hv);
    $total_refe = count($refe); 
    
    if($total_datos >0){
        $flag_DP = 33.3;
    }
    if($total_estudios >0){
        $flag_FP = 33.3;
    }
    if($total_laboral >0){
        $flag_EL = 33.3;
    }
    if($total_refe >0){
        $flag_RP = 25;
    }
    //$porcentaje = $flag_DP+$flag_FP+$flag_EL+$flag_RP;
    $porcentaje = $flag_DP+$flag_FP+$flag_EL;
    
    if($porcentaje < 1){
        $porcentaje = 2;
        $bg_bar = "danger";
    }else if($porcentaje>0 && $porcentaje <75 ){
        $bg_bar = "warning";
    }else if($porcentaje>74 && $porcentaje <100 ){
        $bg_bar = "info";
    }else {
        $bg_bar = "success";
    }
    if(isset($id_user)){      
?>
    <div class="progress " >
        <div class="progress-bar progress-bar-<?php echo $bg_bar; ?>" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $porcentaje; ?>%">
            <?php echo $porcentaje; ?>% Completado
        </div>
    </div>
    <h1 class="page-header">Datos Personales</h1>
    <div class="well well-sm text-right">
        <?php if($num_filas<1){ ?>
            <a class="btn btn-primary" href="?c=Hoja_vida&a=Crud&return_flag=1"><span class="icon-user-plus"> </span> Registrar Datos Personales</a>
        <?php }else{ ?>
            <a class="btn btn-primary" href="?c=Hoja_vida&a=Crud&id=<?php echo $user; ?>&return_flag=1"><i class="fa fa-pencil"></i> Actualizar Datos Personales</a>
        <?php } ?>    
    </div>
    <table id="example0" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Cèdula</th>
                <th>Nombre</th>
                <th>Fecha Nacimiento</th>
                <th>Dirección Residencia</th>
                <th>Correo Electrónico</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($this->model->Listar_DatosPersona($id_user) as $r): ?>
                <tr>
                    <td><?php echo $r->per_cedula; ?></td>
                    <td><?php echo $r->per_nombres." ".$r->per_apellidos; ?></td>
                    <td><?php echo $r->per_fecha_nacimiento; ?></td>
                    <td><?php echo $r->per_direccion; ?></td>
                    <td><?php echo $r->per_email; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h1 class="page-header">Formación Profesional</h1>
    <div class="well well-sm text-right">
        <?php if($num_filas>0){ ?>
           <a class="btn btn-primary" href="?c=Hoja_vida&a=Crud_FormacionProfesional"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Agregar Formación Profesional</a>


            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#Modal_Estudios" data-id_us="<?php echo $user; ?>"data-id_hv="<?php echo $id_hv ?>"data-return_flag="1" ><i class="fa fa-graduation-cap" aria-hidden="true"></i> Agregar Formación Profesional</a>
        <?php } ?>    
    </div>
    <table id="example1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th title="Código Identificación">ID</th>
                <th>Nivel Educación</th>
                <th>Institución</th>
                <th>Título</th>
                <th>Fecha</th>
                <th>Certificado</th>
                <th title="Editar Datos">Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($this->model->Listar_FormacionProfesional($id_hv) as $r): ?>
                <tr>
                    <td><?php echo $r->for_pro_id; ?></td>
                    <td><?php echo $r->niv_titulo; ?></td>
                    <td><?php echo $r->for_pro_institucion; ?></td>
                    <td><?php echo $r->for_pro_titulo; ?></td>
                    <td><?php echo $r->for_pro_fecha_inicio." - ".$r->for_pro_fecha_fin; ?></td>
                    <td><a href="#" class="btn btn-default" onclick="ver_pdf(2,'<?php echo $r->for_pro_ruta_certificado; ?>');return false;" target="_blank"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a></td>
                    <td><a href="#" class="btn btn-success" id="edit" data-toggle="modal" data-target="#Modal_EDITAR_for_Profesional" data-id="<?php echo $r->for_pro_id; ?>" data-id_us="<?php echo $user; ?>"data-id_hv="<?php echo $id_hv ?>"data-nivel="<?php echo $r->for_pro_id_nivel_educacion; ?>"data-institucion="<?php echo $r->for_pro_institucion; ?>"data-titulo="<?php echo $r->for_pro_titulo; ?>"data-fecha_inicio="<?php echo $r->for_pro_fecha_inicio; ?>"data-fecha_fin="<?php echo $r->for_pro_fecha_fin ?>"data-ruta="<?php echo $r->for_pro_ruta_certificado ?>"data-return_flag="1" ><span class="glyphicon glyphicon-pencil"></span></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h1 class="page-header">Experiencia Laboral</h1>
    <div class="well well-sm text-right">
        <?php if($num_filas>0){ ?>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#Modal_Exp_Laboral" data-id_us="<?php echo $user; ?>"data-id_hv="<?php echo $id_hv ?>"data-return_flag="1" ><i class="fa fa-briefcase" aria-hidden="true"></i> Agregar Experiencia Laboral</a>


        <?php } ?>
    </div>
    <table id="example_historial_lab" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Empresa</th>
                <th>Cargo</th>
                <th>Ciudad</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Total Experiencia</th>
                <th title="Descargar Certificado/Constancia Laboral">Certificado</th>
                <th title="Editar Datos">Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($this->model->Listar_Exp_Laboral($id_hv) as $r): ?>
                <tr>
                    <td><?php echo $r->exp_empresa; ?></td>
                    <td><?php echo $r->exp_cargo; ?></td>
                    <td><?php echo $r->departamento.", ".$r->municipio; ?></td>
                    <td><?php echo $r->exp_fecha_inicio; ?></td>
                    <?php if($r->exp_fecha_actualmente ==0 ){ ?>
                        <td><?php echo $r->exp_fecha_fin; ?></td>
                    <?php }else{ ?>
                        <td>Actualmente</td>
                    <?php } ?>
                    <td>
                        <?php
                            if($r->anios >0){
                                echo $r->anios." año(s) "; 
                            }
                            if($r->dias<30){
                                $total_d = $r->dias+1;
                                if($total_d == 30 || $total_d ==31){
                                    echo " 1 mes";
                                }else{
                                    echo $total_d." día(s) ";
                                }
                            }
                            if($r->dias>30){
//                                $total_D=$r->anios*365;
//                                $dias_d = $r->dias-$total_D;
//                                //echo " dd ".$dias_d;
//                                $val_dif = $dias_d/30;
//                                $arr = explode(".", $val_dif);
//                                //print_r($arr);
//                                $dias_T = $val_dif-$arr[0];
//                                $cant_dias = ($dias_T*30)+1;
                                
                                $dias_dif=$r->dias/365;
                                $meses_dif =$dias_dif-$r->anios;
                                $total_M = ((int)($meses_dif*12));
                                if($total_M>0){
                                    echo $total_M." mes(es)";
                                }
                                //while($dias_d>30){
                                  //  $dias_d=$dias_d-30;
                                    //echo $dias_d=$dias_d-30;echo " /n ";
                                    //echo $dias_d=$dias_d/30;echo " /n ";
                                    //$cont++;
                                //}
                                //echo " int ".$cont;
                                //$cant_dias=$dias_d+1;
                                //echo $cont." mes(es) ".$cant_dias." día(s) ";
                                //echo $arr[0]." mes(es) ".$cant_dias." día(s) ";
                            }
                        ?>
                    </td>
                    <td><a href="#" class="btn btn-default" onclick="ver_pdf(3,'<?php echo $r->exp_ruta_certificado ?>');return false;" target="_blank"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a></td>
                    <td><a href="#" class="btn btn-success" id="edit_expLab" data-toggle="modal" data-target="#Modal_EDITAR_Exp_Laboral" data-id="<?php echo $r->exp_id; ?>" data-id_us="<?php echo $user; ?>"data-id_hv="<?php echo $id_hv ?>"data-id_departamento="<?php echo $r->exp_id_departamento; ?>"data-id_municipio="<?php echo $r->exp_id_municipio; ?>"data-rama_flag="<?php echo $r->exp_rama_flag; ?>"data-empresa="<?php echo $r->exp_empresa; ?>"data-cargo="<?php echo $r->exp_cargo; ?>"data-flag_cs="<?php echo $r->exp_CS_flag; ?>"data-id_area_cs="<?php echo $r->exp_id_area_CS; ?>" data-fecha_ini="<?php echo $r->exp_fecha_inicio; ?>"data-exp_fecha_act="<?php echo $r->exp_fecha_actualmente; ?>"data-fecha_fin="<?php echo $r->exp_fecha_fin; ?>"data-ruta="<?php echo $r->exp_ruta_certificado; ?>"data-return_flag="1" ><span class="glyphicon glyphicon-pencil"></span></a></td>
                </tr>
                
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <!--<h1 class="page-header">Referencias Personales</h1>
    <div class="well well-sm text-right">
        <?php //if($num_filas>0){ ?>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#Modal_Ref_Personal" data-id_us="<?php echo $user; ?>"data-id_hv="<?php echo $id_hv ?>"data-return_flag="1" ><i class="fa fa-users"></i> Agregar Referencia Personal</a>
            
        <?php //} ?>
    </div>
    <table id="example4" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Cargo</th>
                <th>Empresa</th>
                <th>Telèfono</th>
                <th title="Editar Datos">Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php /*foreach($this->model->Listar_Ref_Personal($id_hv) as $r): ?>
                <tr>
                    <td><?php echo $r->ref_id; ?></td>
                    <td><?php echo $r->ref_nombre; ?></td>
                    <td><?php echo $r->ref_cargo; ?></td>
                    <td><?php echo $r->ref_empresa; ?></td>
                    <td><?php echo $r->ref_telefono; */?></td>
                    <td><a href="#" class="btn btn-success" data-toggle="modal" data-target="#Modal_EDITAR_Ref_Personal" data-ref_id="<?php echo $r->ref_id; ?>" data-id_us="<?php echo $user; ?>"data-id_hv="<?php echo $id_hv ?>"data-ref_nombre="<?php echo $r->ref_nombre; ?>"data-ref_cargo="<?php echo $r->ref_cargo; ?>"data-ref_empresa="<?php echo $r->ref_empresa; ?>"data-red_telefono="<?php echo $r->ref_telefono; ?>"data-return_flag="1" ><span class="glyphicon glyphicon-pencil"></span></a></td>
                </tr>
            <?php //endforeach; ?>
        </tbody>
    </table>-->
<!-- ****************************** JUAN ESTEBAN MUNERA BETANCUR   ********************************************************************************
    ****************************************** MODAL   ****************************************************************************************  -->

<!-- ///////////// Modal AGREGAR FORMACIÓN PROFESIONAL ////////////////////////////////////////////////////// -->
    <div class="modal fade" id="Modal_Estudios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Formación Profesional <icon class="fa fa-graduation-cap"></icon>
                    </h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form role="form" action="?c=hoja_vida&a=Registrar_Estudios" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" readonly="" class="form-control" name="id" id="id" placeholder="id Hoja Vida"/>
                            <input type="hidden" readonly="" class="form-control" name="id_user" id="id_user" placeholder="id USER"/>
                            <input type="hidden" readonly="" class="form-control" name="usuario" id="usuario" value="<?php echo $id_user; ?>" placeholder="id USER"/>
                            <input type="hidden" readonly="" class="form-control" name="return_flag" id="return_flag" placeholder="Return Flag"/>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="nivel_Edu">Nivel Educación </label>
                                <select id="for_pro_id_nivel" name="for_pro_id_nivel" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="requerido">
                                    <option>Seleccione Nivel Educación</option>
                                    <?php while($row = $nivel_educacion->fetch()){ ?>
                                        <option value="<?php echo $row['niv_id']; ?>"><?php echo $row['niv_titulo']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-xs-6">
                                <label for="institucion">Institución </label>
                                <input type="text" class="form-control" id="for_pro_institucion" name="for_pro_institucion" placeholder="Institución" ata-validacion-tipo="requerido|min:3">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="titulo">Título </label>
                            <input type="text" class="form-control" id="for_pro_titulo" name="for_pro_titulo" placeholder="Ingrese Título Obtenido" ata-validacion-tipo="requerido|min:3">
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="fecha_inicio">Fecha Inicio </label>
                                <input type="date" class="form-control" id="for_pro_fecha_inicio" name="for_pro_fecha_inicio" data-validacion-tipo="requerido">
                            </div>
                            <div class="col-xs-6">
                                <label for="fecha_fin">Fecha Fin </label>
                                <input type="date" class="form-control" id="for_pro_fecha_fin" name="for_pro_fecha_fin" data-validacion-tipo="requerido">
                            </div>
                        </div>
                        <div class="form-group">
                            <i class="icon-file-text" aria-hidden="true"></i> <label>Certificación o título </label>
                            <input id="file-1" name="for_pro_ruta_certificado" type="file" placeholder="Ingrese Documento" class="file" required="" data-preview-file-type="any">
                        </div>
                        <hr />
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="subir"><span class="icon-floppy-disk"></span> Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#Modal_Estudios').on('show.bs.modal', function (event) {
            var button  = $(event.relatedTarget) 
            var id_us   = button.data('id_us') 
            var id_hv   = button.data('id_hv')
            var flag_r  = button.data('return_flag')

            var modal = $(this)
            modal.find('.modal-body input[name="id"]').val(id_hv), 
            modal.find('.modal-body input[name="id_user"]').val(id_us)
            modal.find('.modal-body input[name="return_flag"]').val(flag_r)
        })
    </script>
<!-- ---------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- ############################################################################################################################################# -->
<!-- Modal EDITAR FORMACIÓN PROFESIONAL -->
    <div class="modal fade" id="Modal_EDITAR_for_Profesional" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                       Actualizar Formación Profesional <icon class="fa fa-graduation-cap"></icon>
                    </h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="frm-E_estudios" role="form" action="?c=hoja_vida&a=Actualizar_Estudios" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" readonly="" class="form-control" name="id" id="id" placeholder="id estudio"/>
                            <input type="hidden" readonly="" class="form-control" name="id_hv" id="id_hv" placeholder="id Hoja Vida"/>
                            <input type="hidden" readonly="" class="form-control" name="id_user" id="id_user" placeholder="id USER"/>
                            <input type="hidden" readonly="" class="form-control" name="return_flag" id="return_flag" placeholder="Return Flag"/>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="nivel_Edu">Nivel Educación</label>
                                <div id="nivel_edu"></div>
                            </div>
                            <div class="col-xs-6">
                                <label for="institucion">Institución</label>
                                <input type="text" class="form-control" id="for_pro_institucion" name="for_pro_institucion" placeholder="Institución" ata-validacion-tipo="requerido|min:3">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" class="form-control" id="for_pro_titulo" name="for_pro_titulo" placeholder="Ingrese Título Obtenido" ata-validacion-tipo="requerido|min:3">
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="fecha_inicio">Fecha Inicio</label>
                                <input type="date" class="form-control" id="for_pro_fecha_inicio" name="for_pro_fecha_inicio" data-validacion-tipo="requerido">
                            </div>
                            <div class="col-xs-6">
                                <label for="fecha_fin">Fecha Fin</label>
                                <input type="date" class="form-control" id="for_pro_fecha_fin" name="for_pro_fecha_fin" data-validacion-tipo="requerido">
                            </div>
                        </div>
                        <div class="form-group">
                            <i class="icon-file-text" aria-hidden="true"></i> <label>Certificación o título </label>
                            <input id="file-1" name="for_pro_ruta_certificado" type="file" placeholder="Ingrese Documento" class="file" data-preview-file-type="any">
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <div id="certificado_estudio"></div>
                                <input type="hidden" name="ruta_recu"  class="form-control" placeholder="nivel id Recu" />
                            </div>
                        </div>
                        <hr />
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="subir"><span class="icon-floppy-disk"></span> Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(document).on('click', '#edit', function(e){
                // Definimos las variables de javascrpt 
                var nivel = $(this).data('nivel');
                var ruta  = $(this).data('ruta');
                if(ruta!=""){
                    var rutaFormato = "documentos_HV/Certificados_Estudios/"+ruta;
                }else{
                    var rutaFormato = "#";
                }
                // Ejecutamos AJAX
                $("#nivel_edu").load('content/Exp_Get_nivel.php?nivel='+nivel);
                $("#certificado_estudio").load('content/For_rutaDoc.php?ruta='+rutaFormato);
            }); 
        });
       
        $('#Modal_EDITAR_for_Profesional').on('show.bs.modal', function (event) {
            var button          = $(event.relatedTarget) 
            var id              = button.data('id')
            var id_us           = button.data('id_us') 
            var id_hv           = button.data('id_hv')
            var institucion     = button.data('institucion')
            var titulo          = button.data('titulo')
            var fecha_inicio    = button.data('fecha_inicio')      
            var fecha_fin       = button.data('fecha_fin')
            var ruta            = button.data('ruta')
            if(ruta!=""){
                var rutaFormato = "documentos_HV/Certificados_Estudios/"+ruta;
            }else{
                var rutaFormato = "#";
            }
            var flag_r  = button.data('return_flag')
  
            var modal = $(this)
            modal.find('.modal-body input[name="id"]').val(id); 
            modal.find('.modal-body input[name="id_hv"]').val(id_hv);
            modal.find('.modal-body input[name="id_user"]').val(id_us);
            modal.find('.modal-body input[name="for_pro_institucion"]').val(institucion);
            modal.find('.modal-body input[name="for_pro_titulo"]').val(titulo);
            modal.find('.modal-body input[name="for_pro_fecha_inicio"]').val(fecha_inicio);
            modal.find('.modal-body input[name="for_pro_fecha_fin"]').val(fecha_fin);
            modal.find(document.getElementById("ruta").setAttribute("href",rutaFormato));
            modal.find('.modal-body input[name="ruta_recu"]').val(ruta);
            modal.find('.modal-body input[name="return_flag"]').val(flag_r)
        })
    </script>

<!-- ///////////// Modal AGREGAR EXPERIENCIA LABORAL ////////////////////////////////////////////////////// -->
    <div class="modal fade" id="Modal_Exp_Laboral" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Experiencia Laboral <icon class="fa fa-briefcase"></icon>
                    </h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form role="form" action="?c=hoja_vida&a=Registrar_Exp_laboral" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" readonly="" class="form-control" name="id" id="id" placeholder="id Hoja Vida"/>
                            <input type="hidden" readonly="" class="form-control" name="id_user" id="id_user" placeholder="id USER"/>
                            <input type="hidden" readonly="" class="form-control" name="usuario" id="usuario" value="<?php echo $id_user; ?>" placeholder="id USER"/>
                            <input type="hidden" readonly="" class="form-control" name="return_flag" id="return_flag" placeholder="Return Flag"/>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-4">
                                <div class="form-check">
                                    <!--<input type="checkbox" id="exp_rama_flag" name="exp_rama_flag" onchange="clicRama()" class="form-control">-->
                                    <label class="form-check-label" for="exampleCheck1">¿Experiencia Rama Judicial?</label>
                                    <input type="checkbox" class="form-check-input" id="exp_rama_flag" name="exp_rama_flag" onchange="clicRama()">
                                    <input type="hidden" id="exp_rama" name="exp_rama" class="form-control" value="0">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-check">
                                    <label class="form-check-label" for="exampleCheck1">¿Centro Servicios?</label>
                                    <input type="checkbox" class="form-check-input" id="exp_CS_flag" name="exp_CS_flag" onchange="clic_CS()">
                                    <input type="hidden" id="exp_CS" name="exp_CS" class="form-control" value="0">
                                </div>
                            </div>
                            <div class="col-xs-5" id="list_area_cs" style="display: none">
                                <label for="cargo">Área</label>
                                <select name="exp_id_area" id="exp_id_area" class="form-control selectpicker" data-live-search="true">
                                    <option value="0">Seleccione Área</option>
                                    <?php while($row = $lista_areas_cs->fetch()){ ?>
                                        <option value="<?php echo $row['are_id']; ?>"><?php echo $row['are_titulo']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="empresa">Empresa</label>
                            <input type="text" class="form-control" id="exp_empresa" name="exp_empresa" placeholder="Empresa" required="">
                        </div>
                        <div class="form-group">
                            <label for="cargo">Cargo</label>
                            <input type="text" class="form-control" id="exp_cargo" name="exp_cargo" placeholder="Cargo" required="">
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="cargo">Departamento</label>
                                <select name="exp_id_departamento" id="exp_id_departamento" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="requerido">
                                    <option>Seleccione Departamento</option>
                                    <?php while($row = $lista_departamento->fetch()){ ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-xs-6">
                                <label for="cargo">Municipio</label>
                                <select name="exp_id_municipio" id="exp_id_municipio" class="form-control" data-live-search="true" data-validacion-tipo="requerido">
                                    <option>Seleccione Municipio</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-5">
                                <label for="fecha_inicio">Fecha Inicio</label>
                                <input type="date" class="form-control" id="exp_fecha_inicio" name="exp_fecha_inicio" required="">
                            </div>
                            <div class="col-xs-1">
                                <label for="fecha_actualmente">Actualmente</label>
                                <input type="checkbox" id="exp_actualmente_flag" name="exp_actualmente_flag" onchange="clic()" class="form-control">
                                <input type="hidden" id="exp_fecha_actualmente" name="exp_fecha_actualmente" class="form-control" value="0">
                            </div>
                            <div class="col-xs-1"></div>
                            <div class="col-xs-5">
                                <label for="fecha_fin">Fecha Fin</label>
                                <input type="date" class="form-control" id="exp_fecha_fin" name="exp_fecha_fin" >
                            </div>
                        </div>
                        <div class="form-group">
                            <i class="icon-file-text" aria-hidden="true"></i> <label>Certificado Laboral. </label>
                            <input id="file-1" name="exp_ruta_certificado" type="file" placeholder="Ingrese Documento." class="file" data-preview-file-type="any">
                        </div>
                        <hr />
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="subir"><span class="icon-floppy-disk"></span> Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#Modal_Exp_Laboral').on('show.bs.modal', function (event) {
            var button  = $(event.relatedTarget) 
            var id_us   = button.data('id_us') 
            var id_hv   = button.data('id_hv')
            var flag_r  = button.data('return_flag')

            var modal = $(this)
            modal.find('.modal-body input[name="id"]').val(id_hv), 
            modal.find('.modal-body input[name="id_user"]').val(id_us)
            modal.find('.modal-body input[name="return_flag"]').val(flag_r)
        })
    </script>
<!-- ---------------------------------------------------------------------------------------------------------------------------------------- -->

<!-- ///////////// Modal EDITAR EXPERIENCIA LABORAL ////////////////////////////////////////////////////// -->
    <div class="modal fade" id="Modal_EDITAR_Exp_Laboral" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Experiencia Laboral <icon class="fa fa-briefcase"></icon>
                    </h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form role="form" action="?c=hoja_vida&a=Editar_Exp_laboral" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" readonly="" class="form-control" name="id" id="id" placeholder="id experiencia"/>
                            <input type="hidden" readonly="" class="form-control" name="id_hv" id="id_hv" placeholder="id Hoja Vida"/>
                            <input type="hidden" readonly="" class="form-control" name="id_user" id="id_user" placeholder="id USER"/>
                            <input type="hidden" readonly="" class="form-control" name="return_flag" id="return_flag" placeholder="Return Flag"/>
                        </div>
                        <div id="experiencia_rama"></div>
                        <div class="form-group">
                            <label for="cargo">Cargo</label>
                            <input type="text" class="form-control" id="exp_cargo" name="exp_cargo" placeholder="Cargo" required="">
                        </div>
                        <div id="experiencia_Lugar"></div>
                        <div id="fecha_experiencia"></div>
                        <div class="form-group">
                            <i class="icon-file-text" aria-hidden="true"></i> <label>Certificado Laboral </label>
                            <input id="file-1" name="exp_ruta_certificado" type="file" placeholder="Ingrese Documento" class="file" data-preview-file-type="any">
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                               <label for="id">Descargar Documento</label>
                               <a id="ruta" class="form-control" href="#" target="_blank" style="text-decoration:none;"><i class="icon-download3"></i>Descargar</a>
                               <input type="hidden" name="ruta_recu"  class="form-control" placeholder="doc Recu" />
                            </div>
                        </div>
                        <hr />
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="subir"><span class="icon-floppy-disk"></span> Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(document).on('click', '#edit_expLab', function(e){
                // Definimos las variables de javascrpt 
                // EXPERIENCIA RAMA
                var empresa   = $(this).data('empresa');
                var rama_flag = $(this).data('rama_flag');
                // LUGAR EXPERIENCIA
                var departamento   = $(this).data('id_departamento');
                var municipio   = $(this).data('id_municipio');
                // FECHA EXPERIENCIA
                var fecha_ini   = $(this).data('fecha_ini');
                var fecha_act   = $(this).data('exp_fecha_act');
                var fecha_fin   = $(this).data('fecha_fin');
                 // EXPERIENCIA CENTRO SERVICIOS
                var cs_flag     = $(this).data('flag_cs');
                var id_areaCS   = $(this).data('id_area_cs');
                //alert(rama_flag+" "+empresa);
                //alert(municipio);
                //alert(fecha_act);
                params={};
                params.rama_flag = rama_flag;
                params.empresa = empresa; 
                //*********************************** ***************************************************
                params.departamento = departamento;
                params.municipio = municipio; 
                //*********************************** ***************************************************
                params.fecha_ini = fecha_ini;
                params.fecha_act = fecha_act; 
                params.fecha_fin = fecha_fin;
                //*********************************** ***************************************************
                params.cs_flag   = cs_flag;
                params.id_areaCS = id_areaCS;
                // Ejecutamos AJAX
                $('#fecha_experiencia').load('content/Exp_FechaHV.php',params,function(){})
                // Ejecutamos AJAX
                $('#experiencia_Lugar').load('content/Exp_Lugar.php',params,function(){})
                // Ejecutamos AJAX
                $('#experiencia_rama').load('content/Exp_datosRama.php',params,function(){})
                // $("#experiencia_rama").load('content/Exp_datosRama.php?rama_flag='+rama_flag+'&empresa='+empresa); 
            }); 
            
        });
        $('#Modal_EDITAR_Exp_Laboral').on('show.bs.modal', function (event) {
            var button  = $(event.relatedTarget) 
            var id              = button.data('id')
            var id_us           = button.data('id_us')
            var id_hv           = button.data('id_hv')
            var id_departamento = button.data('id_departamento')
            var id_municipio    = button.data('id_municipio')
            //var rama_flag       = button.data('rama_flag')
            //var empresa         = button.data('empresa')
            var cargo           = button.data('cargo')
            //var fecha_inicio    = button.data('fecha_ini')
            //var fecha_act       = button.data('exp_fecha_act')
            //var fecha_fin       = button.data('fecha_fin')
            var ruta            = button.data('ruta')
            if(ruta!=""){
                var rutaFormato = "documentos_HV/Certificados_Laborales/"+ruta;
            }else{
                var rutaFormato = "#";
            }
            var flag_r  = button.data('return_flag')

            var modal = $(this)
            modal.find('.modal-body input[name="id"]').val(id);
            modal.find('.modal-body input[name="id_hv"]').val(id_hv);
            modal.find('.modal-body input[name="id_user"]').val(id_us);
            modal.find('.modal-body input[name="for_pro_departamento"]').val(id_departamento);
            modal.find('.modal-body input[name="for_pro_municipio"]').val(id_municipio);
            //modal.find('.modal-body input[name="rama_flag"]').val(rama_flag);
            //modal.find('.modal-body input[name="exp_empresa"]').val(empresa);
            modal.find('.modal-body input[name="exp_cargo"]').val(cargo);
            //modal.find('.modal-body input[name="exp_fecha_inicio"]').val(fecha_inicio);
            //modal.find('.modal-body input[name="fecha_actualmente"]').val(fecha_act);
            //modal.find('.modal-body input[name="exp_fecha_fin"]').val(fecha_fin);
            modal.find(document.getElementById("ruta").setAttribute("href",rutaFormato));
            modal.find('.modal-body input[name="ruta_recu"]').val(ruta);
            modal.find('.modal-body input[name="return_flag"]').val(flag_r)
        })
    </script>
<!-- ---------------------------------------------------------------------------------------------------------------------------------------- -->

<!-- Modal AGREGAR REFERENCIAS PERSONALES-->
    <div class="modal fade" id="Modal_Ref_Personal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Referencia Personal <icon class="fa fa-users"></icon>
                    </h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form role="form" action="?c=hoja_vida&a=Registrar_Ref_Personal" method="post" >
                        <div class="form-group">
<!--                            <label for="id">ID Hoja Vida</label>-->
                            <input type="hidden" readonly="" class="form-control" name="id" id="id" placeholder="id Hoja Vida"/>
                            <input type="hidden" readonly="" class="form-control" name="id_user" id="id_user" placeholder="id USER"/>
                            <input type="hidden" readonly="" class="form-control" name="usuario" id="usuario" value="<?php echo $id_user; ?>" placeholder="id USER"/>
                            <input type="hidden" readonly="" class="form-control" name="return_flag" id="return_flag" placeholder="Return Flag"/>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre Completo</label>
                            <input type="text" class="form-control" id="ref_per_nombre" name="ref_per_nombre" placeholder="Nombre Completo" required="">
                        </div>
                        <div class="form-group">
                            <label for="cargo">Cargo</label>
                            <input type="text" class="form-control" id="ref_per_cargo" name="ref_per_cargo" placeholder="Cargo" required="">
                        </div>
                        <div class="form-group">
                            <label for="empresa">Empresa</label>
                            <input type="text" class="form-control" id="ref_per_empresa" name="ref_per_empresa" placeholder="Empresa" required="">
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" id="ref_per_telefono" name="ref_per_telefono" placeholder="Teléfono/Celular" required="">
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
        $('#Modal_Ref_Personal').on('show.bs.modal', function (event) {
            var button  = $(event.relatedTarget) 
            var id_us   = button.data('id_us') 
            var id_hv   = button.data('id_hv')
            var flag_r  = button.data('return_flag')

            var modal = $(this)
            modal.find('.modal-body input[name="id"]').val(id_hv), 
            modal.find('.modal-body input[name="id_user"]').val(id_us)
            modal.find('.modal-body input[name="return_flag"]').val(flag_r)
        })
    </script>
    
    <!-- Modal EDITAR REFERENCIAS PERSONALES-->
    <div class="modal fade" id="Modal_EDITAR_Ref_Personal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                       Actualizar Referencia Personal <icon class="fa fa-users"></icon>
                    </h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form role="form" action="?c=hoja_vida&a=Actualizar_Ref_Personal" method="post" >
                        <div class="form-group">
                            <input type="hidden" readonly="" class="form-control" name="id" id="id" placeholder="id Referencia"/>
                            <input type="hidden" readonly="" class="form-control" name="id_hv" id="id_hv" placeholder="id Hoja Vida"/>
                            <input type="hidden" readonly="" class="form-control" name="id_user" id="id_user" placeholder="id USER"/>
                            <input type="hidden" readonly="" class="form-control" name="return_flag" id="return_flag" placeholder="Return Flag"/>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre Completo</label>
                            <input type="text" class="form-control" id="ref_per_nombre" name="ref_per_nombre" placeholder="Nombre Completo" required="">
                        </div>
                        <div class="form-group">
                            <label for="cargo">Cargo</label>
                            <input type="text" class="form-control" id="ref_per_cargo" name="ref_per_cargo" placeholder="Cargo" required="">
                        </div>
                        <div class="form-group">
                            <label for="empresa">Empresa</label>
                            <input type="text" class="form-control" id="ref_per_empresa" name="ref_per_empresa" placeholder="Empresa" required="">
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" id="ref_per_telefono" name="ref_per_telefono" placeholder="Teléfono/Celular" required="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary"><span class="icon-floppy-disk"></span> Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#Modal_EDITAR_Ref_Personal').on('show.bs.modal', function (event) {
            var button          = $(event.relatedTarget) 
            var id_ref          = button.data('ref_id')
            var id_us           = button.data('id_us') 
            var id_hv           = button.data('id_hv')
            var ref_nombre      = button.data('ref_nombre')
            var ref_cargo       = button.data('ref_cargo')
            var ref_empresa     = button.data('ref_empresa')
            var red_telefono    = button.data('red_telefono')     
            var return_flag     = button.data('return_flag')    


            var modal = $(this)
            modal.find('.modal-body input[name="id"]').val(id_ref), 
            modal.find('.modal-body input[name="id_hv"]').val(id_hv), 
            modal.find('.modal-body input[name="id_user"]').val(id_us),
            modal.find('.modal-body input[name="ref_per_nombre"]').val(ref_nombre),
            modal.find('.modal-body input[name="ref_per_cargo"]').val(ref_cargo),
            modal.find('.modal-body input[name="ref_per_empresa"]').val(ref_empresa),
            modal.find('.modal-body input[name="ref_per_telefono"]').val(red_telefono),
            modal.find('.modal-body input[name="return_flag"]').val(return_flag)

        })
    </script>
    <script>
        $(document).ready(function() {
            $("#exp_id_departamento").change(function(event){        
                var id    = $("#exp_id_departamento").find(':selected').val();
                //alert(id);
                $("#exp_id_municipio").load('content/funciones_jest.php?id='+id+"&flag="+1);        
            });
        });
        function clic (){
            if (document.getElementById('exp_actualmente_flag').checked){
                document.getElementById("exp_fecha_fin").required = false;
                document.getElementById("exp_fecha_fin").readOnly = true;
                document.getElementById("exp_fecha_actualmente").value=1;
            } else{
                document.getElementById("exp_fecha_fin").required = true;
                document.getElementById("exp_fecha_fin").readOnly = false;
                document.getElementById("exp_fecha_actualmente").value=0;
            }
        };
        function clicRama(){
            if (document.getElementById('exp_rama_flag').checked){
                document.getElementById("exp_empresa").value = "Rama Judicial";
                document.getElementById("exp_empresa").readOnly = true;
                document.getElementById("exp_rama").value=1;
            } else{
                document.getElementById("exp_empresa").value = "";
                document.getElementById("exp_empresa").readOnly = false;
                document.getElementById("exp_rama").value=0;
            }  
        };
        function clic_CS(){
            if (document.getElementById('exp_CS_flag').checked){
                document.getElementById("list_area_cs").style.display = "block";
                document.getElementById("exp_id_area").required = true;
                document.getElementById("exp_CS").value=1;
            } else{
                document.getElementById("list_area_cs").style.display = "none";
                document.getElementById("exp_id_area").required = false;
                document.getElementById("exp_CS").value=0;
            }  
        };
        $(document).ready(function(){
            $("#frm-E_estudios").submit(function(){
                return $(this).validate();
            });
        });
    </script>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>