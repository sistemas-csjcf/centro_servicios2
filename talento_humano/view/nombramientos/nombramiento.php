<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user            = $_SESSION['idUsuario'];
    $modelo             = new HojaVida();
    $lista_cargos       = $modelo->get_Cargos();
    $lista_cargosEnc    = $modelo->get_Cargos();
    $lista_claseN       = $modelo->get_ClaseNombramiento();
    $lista_ubicacion    = $modelo->get_Ubicacion();
    $lista_ubicacionProv= $modelo->get_Ubicacion();
    $lista_ubicacionEnca= $modelo->get_Ubicacion();
    $lista_areas_cs     = $modelo->get_AreasCS();
    $lista_areas_csProv = $modelo->get_AreasCS();
    $lista_areas_csEnc  = $modelo->get_AreasCS();
    
   
    $datos_usuario = $modelo->get_Datos_User($_REQUEST['id']);
    while($row = $datos_usuario->fetch()){
        $cedula     = $row['nombre_usuario'];
        $nombres    = $row['empleado'];
    }
   
    // JUAN ESTEBAN MUNERA BETANCUR
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '30';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
    date_default_timezone_set('America/Bogota'); 
    $fecha_actual = date('Y-m-d');
    if(isset($id_user)){
        if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
?>
    <h1 class="page-header">
        <?php echo $hv->per_id != null ? $hv->per_nombres : 'Nuevo Registro'; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="?c=hoja_vida">Listado de Personal</a></li>
        <li class="active"><?php echo $vis->vis_TSoci_id != null ? $vis->vis_TSoci_nombre : 'Nuevo Registro'; ?></li>
    </ol>
    <form id="frm-DatosResolucion" action="?c=hoja_vida&a=Guardar_ResolucionNombramiento" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $hv->res_id; ?>" />
        <input type="hidden" name="id_usuarioR" value="<?php echo $id_user; ?>" />
        
        <div class="form-group row">
            <div class="col-xs-4">
                <label>Persona Nombrar</label>
                <select name="res_id_usuario" id="id_user_reemplaza" class="form-control selectpicker" data-live-search="true" >
                    <?php foreach($this->model->ListarUsuariosHV() as $r): ?>
                        <?php if($hv->id_user == $r->id){ ?>
                            <option value="<?php echo $r->id; ?>" selected=""><?php echo $r->empleado; ?></option>
                        <?php }else{ ?>
                            <option value="<?php echo $r->id; ?>"><?php echo $r->empleado; ?></option>
                        <?php } ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-xs-2">
                <label>Agregar Usuario </label>
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#Modal_AgregarUSer" data-return_flag="1" ><i class="fa fa-plus" aria-hidden="true"></i> Agregar</a>
            </div>
            <div class="col-xs-2">
                <label for="clase">Clase Nombramiento</label>
                <select name="res_id_clase" id="pla_id_clase" class="form-control selectpicker" onchange="Res_Clase_nombramiento(this.value)" data-live-search="true" data-validacion-tipo="requerido" required="">
                    <option>Seleccione Clase de Nombramiento</option>
                    <?php while($row = $lista_claseN->fetch()){ ?>
                        <?php if($hv->clas_id == $row['clas_id']){ ?>
                            <option value="<?php echo $row['clas_id']; ?>" selected=""><?php echo $row['clas_titulo']; ?></option>
                        <?php }else{ ?>
                            <option value="<?php echo $row['clas_id'] ?>"><?php echo $row['clas_titulo']; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
            <div class="col-xs-3">
                <label for="cargo">Nombre Cargo</label>
                <select name="res_id_cargo" id="pla_id_cargo" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="requerido" required="">
                    <option>Seleccione Nombre Cargo</option>
                    <?php while($row = $lista_cargos->fetch()){ ?>
                        <?php if($hv->car_id == $row['car_id']){ ?>
                            <option value="<?php echo $row['car_id']; ?>" selected=""><?php echo $row['car_titulo']; ?></option>
                        <?php }else{ ?>
                            <option value="<?php echo $row['car_id'] ?>"><?php echo $row['car_titulo']; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
<!--  ///////////////////// ****************      ADICIONAL PROPIEDAD   ************************* ////////////////////////// -->
        <div class="form-group row" id="adicional_propiedad" style="display: none">
            <div class="col-xs-4">
                <label>Nùmero de Oficio Nombramiento</label>
                <input type="text" name="res_oficio" id="num_oficio" value="<?php echo $hv->num_oficio; ?>" class="form-control" placeholder="Ingrese Nùmero de Oficio y Fecha" />
            </div>
            <div class="col-xs-4">
                <label>Nùmero de Acuerdo</label>
                <input type="text" name="res_acuerdo" id="num_acuerdo" value="<?php echo $hv->num_acuerdo; ?>" class="form-control" placeholder="Ingrese Nùmero de Acuerdo y Fecha" />
            </div>
            <div class="col-xs-4">
                <label>Certificado Disponibilidad Presupuestal</label>
                <input type="text" name="cdp_Pro" id="num_cdp" value="<?php echo $hv->num_acuerdo; ?>" class="form-control" placeholder="Ingrese Nùmero de Acuerdo y Fecha CDP" />
            </div>
        </div>
        <div class="form-group row" id="adicional_propiedad1" style="display: none">
            <div class="col-xs-4">
                <label>Persona Reemplaza</label>
                <select name="res_id_user_Reemplaza_Pro" id="id_user_reemplaza" class="form-control selectpicker" data-live-search="true" >
                    <option value="0">Vacante Definitiva</option>
                    <?php foreach($this->model->ListarUs_VAcanteDef() as $r): ?>
                        <?php if($hv->id_user == $r->id){ ?>
                            <option value="<?php echo $r->id; ?>" selected=""><?php echo $r->empleado; ?></option>
                        <?php }else{ ?>
                            <option value="<?php echo $r->id; ?>"><?php echo $r->empleado; ?></option>
                        <?php } ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-xs-4" id="ubicacionR">
                <label>Ubicación </label>
                <select name="id_ubicacionPro" id="res_id_ubicacion" class="form-control selectpicker" onchange="ubicacion_ResProp(this.value)" data-live-search="true" >
                    <option value="0">Seleccione Ubicación</option>
                    <?php while($row = $lista_ubicacion->fetch()){ ?>
                        <?php if($hv->ubi_id == $row['ubi_id']){ ?>
                            <option value="<?php echo $row['ubi_id']; ?>" selected=""><?php echo $row['ubi_titulo']; ?></option>
                        <?php }else{ ?>
                            <option value="<?php echo $row['ubi_id'] ?>"><?php echo $row['ubi_titulo']; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
            <div class="col-xs-4" id="area_cs" style="visibility: hidden" >
                <label>Àrea </label>
                <select name="id_arePro" id="res_id_are" class="form-control selectpicker" data-live-search="true" >
                    <option value="0">Seleccione Área</option>
                    <?php while($row = $lista_areas_cs->fetch()){ ?>
                        <?php if($hv->proc_id == $row['proc_id']){ ?>
                            <option value="<?php echo $row['proc_id']; ?>" selected=""><?php echo $row['proc_titulo']; ?></option>
                        <?php }else{ ?>
                            <option value="<?php echo $row['proc_id'] ?>"><?php echo $row['proc_titulo']; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
<!--***** // **************** FIN PROPIEDAD *********************** // *************** -->
<!--  ///////////////////// ****************      ADICIONAL PROVISIONALIDAD   ************************* ////////////////////////// -->
        <div class="form-group row" id="adicional_provisionalidad" style="display: none">
            <div class="col-xs-4">
                <label>Certificado Disponibilidad Presupuestal</label>
                <input type="text" name="cdp_ProVi" id="num_cdp" value="<?php echo $hv->cdp; ?>" class="form-control" placeholder="Ingrese Nùmero de Acuerdo y Fecha CDP" />
            </div>
            <div class="col-xs-4" id="ubicacionR">
                <label>Ubicación </label>
                <select name="id_ubicacionProv" id="res_id_ubicacion" class="form-control selectpicker" onchange="ubicacion_ResProv(this.value)" data-live-search="true" >
                    <option value="0">Seleccione Ubicación</option>
                    <?php while($row = $lista_ubicacionProv->fetch()){ ?>
                        <?php if($hv->ubi_id == $row['ubi_id']){ ?>
                            <option value="<?php echo $row['ubi_id']; ?>" selected=""><?php echo $row['ubi_titulo']; ?></option>
                        <?php }else{ ?>
                            <option value="<?php echo $row['ubi_id'] ?>"><?php echo $row['ubi_titulo']; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
            <div class="col-xs-4" id="area_csProv" style="visibility: hidden" >
                <label>Àrea </label>
                <select name="id_areProv" id="res_id_areProv" class="form-control selectpicker" data-live-search="true" >
                    <option value="0">Seleccione Área</option>
                    <?php while($row = $lista_areas_csProv->fetch()){ ?>
                        <?php if($hv->proc_id == $row['proc_id']){ ?>
                            <option value="<?php echo $row['proc_id']; ?>" selected=""><?php echo $row['proc_titulo']; ?></option>
                        <?php }else{ ?>
                            <option value="<?php echo $row['proc_id'] ?>"><?php echo $row['proc_titulo']; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row" id="adicional_provisionalidad1" style="display: none">
            <div class="col-xs-4">
                <label>Persona Reemplaza</label>
                <select name="res_id_user_Reemplaza_ProV" id="id_user_reemplaza" class="form-control selectpicker" data-live-search="true" >
                    <option value="0">Vacante Definitiva</option>
                    <?php foreach($this->model->ListarUsuariosHV() as $r): ?>
                        <?php if($hv->id_user == $r->id){ ?>
                            <option value="<?php echo $r->id; ?>" selected=""><?php echo $r->empleado; ?></option>
                        <?php }else{ ?>
                            <option value="<?php echo $r->id; ?>"><?php echo $r->empleado; ?></option>
                        <?php } ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-xs-3">
                <label>Fecha Inicio </label>
                <input type="date" name="res_fecha_inicio_Prov" id="pla_fecha_inicio" value="<?php echo $hv->per_direccion; ?>" class="form-control" placeholder="Ingrese Fecha Inicio" />
            </div>
            <div class="col-xs-2">
                <p><label for="licencia">¿Abierto?</label></p>
                <label class="radio-inline">
                    <input type="radio" onchange="Provisionalidad_Abierto(1)" name="optAbierto" value="1" >Si
                </label>
                <label class="radio-inline">
                    <input type="radio" onchange="Provisionalidad_Abierto(0)"name="optAbierto" value="0">No
                </label>
            </div>
            <div class="col-xs-3">
                <label>Fecha Fin </label>
                <input type="date" name="res_fecha_fin_Prov" id="pla_fecha_finProv" value="<?php echo $hv->per_direccion; ?>" class="form-control" placeholder="Ingrese Fecha Fin" />
            </div>
        </div>
<!-- *********************************** FIN PROVISIONALIDAD ****************************** --> 
<!--  ///////////////////// ****************      ADICIONAL ENCARGO   ************************* ////////////////////////// -->
        <div class="form-group row" id="adicional_encargo" style="display: none">
            <div class="col-xs-4">
                <label for="cargo">Cargo Actual</label>
                <select name="pla_id_cargo" id="pla_id_cargo" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="requerido">
                    <?php while($row = $lista_cargosEnc->fetch()){ ?>
                        <?php if($hv->car_id == $row['car_id']){ ?>
                            <option value="<?php echo $row['car_id']; ?>" selected=""><?php echo $row['car_titulo']; ?></option>
                        <?php }else{ ?>
                            <option value="<?php echo $row['car_id'] ?>"><?php echo $row['car_titulo']; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
            <div class="col-xs-3">
                <label>Fecha Inicio </label>
                <input type="date" name="res_fecha_inicio_Enc" id="fecha_inicio" value="<?php echo $hv->per_direccion; ?>" class="form-control" placeholder="Ingrese Fecha Inicio" />
            </div>
           
        </div>
        <div class="form-group row" id="adicional_encargo1" style="display: none">
            <div class="col-xs-4">
                <label>Certificado Disponibilidad Presupuestal</label>
                <input type="text" name="cdp_Enc" id="num_cdp" value="<?php echo $hv->num_acuerdo; ?>" class="form-control" placeholder="Ingrese Nùmero de Acuerdo y Fecha CDP" />
            </div>
            <div class="col-xs-4" id="ubicacionR">
                <label>Ubicación </label>
                <select name="id_ubicacionEnc" id="res_id_ubicacion" class="form-control selectpicker" onchange="ubicacion_ResEnc(this.value)" data-live-search="true" >
                    <option value="0">Seleccione Ubicación</option>
                    <?php while($row = $lista_ubicacionEnca->fetch()){ ?>
                        <?php if($hv->ubi_id == $row['ubi_id']){ ?>
                            <option value="<?php echo $row['ubi_id']; ?>" selected=""><?php echo $row['ubi_titulo']; ?></option>
                        <?php }else{ ?>
                            <option value="<?php echo $row['ubi_id'] ?>"><?php echo $row['ubi_titulo']; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
            <div class="col-xs-4" id="area_csEnc" style="visibility: hidden" >
                <label>Àrea </label>
                <select name="id_areEnc" id="res_id_are" class="form-control selectpicker" data-live-search="true" >
                    <option value="0">Seleccione Área</option>
                    <?php while($row = $lista_areas_csEnc->fetch()){ ?>
                        <?php if($hv->proc_id == $row['proc_id']){ ?>
                            <option value="<?php echo $row['proc_id']; ?>" selected=""><?php echo $row['proc_titulo']; ?></option>
                        <?php }else{ ?>
                            <option value="<?php echo $row['proc_id'] ?>"><?php echo $row['proc_titulo']; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
<!-- *********************************** FIN ENCARGO *************************************** -->     
<!-- **************** DATOS GENERALES*************************************************** -->
<!-- **************** DOCUMENTACIÓN GENERAL REQUERIDA *************************************************** -->
        <div class="form-group row"> 
            <div class="col-xs-1">
                <label>1° vez </label>
                <input type="checkbox" class="form-control" name="flag_first_vez" id="flag_first_vez"  value="1" onchange="first_timeFlag()">
            </div>
            <div class="col-xs-3">
                <label>N° Paz y Salvo</label>
                <input type="text" name="num_pazSalvo" id="num_pazSalvo" placeholder="Ingrese N° y Fecha de Paz y Salvo" class="form-control" readonly="true">
            </div>
            <div class="col-xs-4">
                <label>Certificado Responsabilidad Social Contraloria</label>
                <input type="hidden" name="res_contraloria" value="<?php echo $hv->res_ruta_contraloria; ?>" class="form-control" placeholder="Ingrese Foto" />
                <?php if ($hv->res_ruta_contraloria == ''){ ?>
                    <input id="file-1" name="res_ruta_contraloria" type="file" placeholder="Ingrese Documento" class="file"  data-preview-file-type="any">
                <?php }else{ ?>
                    <input id="file-1" name="res_ruta_contraloria" type="file" placeholder="Ingrese Documento" class="file" data-preview-file-type="any">
                <?php } ?>
            </div>
            
            <div class="col-xs-4">
                <label>Certificado Antecedentes Procuraduria </label>
                <input type="hidden" name="res_procuraduria" value="<?php echo $hv->res_ruta_procuraduria; ?>" class="form-control" placeholder="Ingrese Foto" />
                <?php if ($hv->res_ruta_procuraduria == ''){ ?>
                    <input id="file-1" name="res_ruta_procuraduria" type="file" placeholder="Ingrese Documento" class="file"  data-preview-file-type="any">
                <?php }else{ ?>
                    <input id="file-1" name="res_ruta_procuraduria" type="file" placeholder="Ingrese Documento" class="file" data-preview-file-type="any">
                <?php } ?>
            </div>
            
        </div> 
        <div class="form-group row">        
            <div class="col-xs-4">
                <div class="col-xs-3">
                    <?php if($hv->res_ruta_contraloria != ''): ?>
                        <div class="img-thumbnail " style="border: 0px;">
                            <img src="documentos_TH/Doc_Resoluciones/<?php echo $hv->res_ruta_contraloria; ?>" style="width:40%; " />
                            <a href="documentos_TH/Doc_Resoluciones/<?php echo $hv->res_ruta_contraloria; ?>" target="_blank" style="text-decoration:none;"><i class="icon-download3"></i>Descargar</a>
                        </div>
                    <?php endif; ?>            
                </div>  
            </div>
            <div class="col-xs-4">
                <?php if($hv->res_ruta_procuraduria != ''): ?>
                    <div class="img-thumbnail " style="border: 0px;">
                        <img src="documentos_TH/Doc_Resoluciones/<?php echo $hv->res_ruta_procuraduria; ?>" style="width:40%; " />
                        <a href="documentos_TH/Doc_Resoluciones/<?php echo $hv->res_ruta_procuraduria; ?>" target="_blank" style="text-decoration:none;"><i class="icon-download3"></i>Descargar</a>
                    </div>
                <?php endif; ?>            
            </div>
            
        </div>
        <div class="form-group row">
            <div class="col-xs-4">
                <label>Certificado Medidas Correctivas </label>
                <input type="hidden" name="res_medidas" value="<?php echo $hv->res_ruta_medidas; ?>" class="form-control" placeholder="Ingrese Foto" />
                <?php if ($hv->res_ruta_medidas == ''){ ?>
                    <input id="file-1" name="res_ruta_medidas" type="file" placeholder="Ingrese Documento" class="file"  data-preview-file-type="any">
                <?php }else{ ?>
                    <input id="file-1" name="res_ruta_medidas" type="file" placeholder="Ingrese Documento" class="file" data-preview-file-type="any">
                <?php } ?>
            </div>
            <div class="col-xs-4">
                <label>Certificado Antecedentes Judiciales</label>
                <input type="hidden" name="res_antecedentes" value="<?php echo $hv->res_ruta_antecedentes; ?>" class="form-control" placeholder="Ingrese Foto" />
                <?php if ($hv->res_ruta_antecedentes == ''){ ?>
                    <input id="file-1" name="res_ruta_antecedentes" type="file" placeholder="Ingrese Documento" class="file"  data-preview-file-type="any">
                <?php }else{ ?>
                    <input id="file-1" name="res_ruta_antecedentes" type="file" placeholder="Ingrese Documento" class="file" data-preview-file-type="any">
                <?php } ?>
            </div>
            <div class="col-xs-4">
                <label>Declaraciòn Juramentada de Inhabilidades </label>
                <input type="hidden" name="res_inhabilidades" value="<?php echo $hv->res_ruta_inhabilidades; ?>" class="form-control" placeholder="Ingrese Foto" />
                <?php if ($hv->res_ruta_inhabilidades == ''){ ?>
                    <input id="file-1" name="res_ruta_inhabilidades" type="file" placeholder="Ingrese Documento" class="file"  data-preview-file-type="any">
                <?php }else{ ?>
                    <input id="file-1" name="res_ruta_inhabilidades" type="file" placeholder="Ingrese Documento" class="file" data-preview-file-type="any">
                <?php } ?>
            </div> 
        </div> 
        <div class="form-group row"> 
            <div class="col-xs-4">
                <?php if($hv->res_ruta_medidas != ''): ?>
                    <div class="img-thumbnail " style="border: 0px;">
                        <img src="documentos_TH/Doc_Resoluciones/<?php echo $hv->res_ruta_medidas; ?>" style="width:40%; " />
                        <a href="documentos_TH/Doc_Resoluciones/<?php echo $hv->res_ruta_medidas; ?>" target="_blank" style="text-decoration:none;"><i class="icon-download3"></i>Descargar</a>
                    </div>
                <?php endif; ?>            
            </div>
            <div class="col-xs-4">
                <div class="col-xs-3">
                    <?php if($hv->res_ruta_antecedentes != ''): ?>
                        <div class="img-thumbnail " style="border: 0px;">
                            <img src="documentos_TH/Doc_Resoluciones/<?php echo $hv->res_ruta_antecedentes; ?>" style="width:40%; " />
                            <a href="documentos_TH/Doc_Resoluciones/<?php echo $hv->res_ruta_antecedentes; ?>" target="_blank" style="text-decoration:none;"><i class="icon-download3"></i>Descargar</a>
                        </div>
                    <?php endif; ?>            
                </div>  
            </div>
            <div class="col-xs-4">
                <?php if($hv->res_ruta_inhabilidades != ''): ?>
                    <div class="img-thumbnail " style="border: 0px;">
                        <img src="documentos_TH/Doc_Resoluciones/<?php echo $hv->res_ruta_inhabilidades; ?>" style="width:40%; " />
                        <a href="documentos_TH/Doc_Resoluciones/<?php echo $hv->res_ruta_inhabilidades; ?>" target="_blank" style="text-decoration:none;"><i class="icon-download3"></i>Descargar</a>
                    </div>
                <?php endif; ?>            
            </div>
            
        </div>
<!-- *************************************** FIN DOCUMENTACIÒN REQUERIDA ******************************************** -->
        <hr />
        <div class="text-right">
            <button class="btn btn-success" ><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
        </div>
    </form>

    
<!-- /////////////////////// Modal AGREGAR USUARIOS ////////////////////////////////////////////////////// -->
    <div class="modal fade" id="Modal_AgregarUSer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Agregar Usuario <icon class="fa fa-plus"></icon>
                    </h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form role="form" action="?c=hoja_vida&a=Registrar_usuario" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" readonly="" class="form-control" name="return_flag" id="return_flag" placeholder="Return Flag"/>
                        </div>
                       
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="numero">Nùmero Cèdula</label>
                                <input type="number" class="form-control" id="usu_cedula" name="usu_cedula" placeholder="Nùmero Cèdula" required="">
                            </div>
                            <div class="col-xs-6">
                                <label for="cargo">Nombre Completo</label>
                                <input type="text" class="form-control" id="usu_nombre" name="usu_nombre" placeholder="Nombre Completo" required="">
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
        $('#Modal_AgregarUSer').on('show.bs.modal', function (event) {
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

    <script type="text/javascript">
        $(document).ready(function(){
            $("#frm-DatosResolucion").submit(function(){
                return $(this).validate();
            });
        });
        function validarSiNumero(numero){
            if (!/^([0-9])*$/.test(numero) ){
                alert("Por favor ingrese solo números");
                document.getElementById("btn_consultar").disabled=true;
            }else{
                document.getElementById("btn_consultar").disabled=false;
            }
        };
        $(document).ready(function() {
            $("#per_id_departamento").change(function(event){        
                var id    = $("#per_id_departamento").find(':selected').val();
                //alert(id);
                $("#per_id_municipio").load('content/funciones_jest.php?id='+id+"&flag="+1);		
            });
        });
        
    </script>
<?php }else{ ?><br/>
    <h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para acceder a esta opción</h4>
<?php } ?>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php  header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>
