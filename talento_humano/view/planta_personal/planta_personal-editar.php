<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user            = $_SESSION['idUsuario'];
    $user_select        = $_REQUEST['id'];
    $modelo             = new HojaVida();
    $lista_cargos       = $modelo->get_Cargos();
    $lista_claseN       = $modelo->get_ClaseNombramiento();
    $lista_ubicacion    = $modelo->get_Ubicacion();
    $lista_ubicacionProv= $modelo->get_Ubicacion();
    $lista_ubicacionEnca= $modelo->get_Ubicacion();
    $lista_areas_cs     = $modelo->get_AreasCS();
    $lista_areas_csPro  = $modelo->get_AreasCS();
    $lista_areas_csEnc  = $modelo->get_AreasCS();
    
    $lista_usuariosRemp = $modelo->ListarUsuariosHV();
    $lista_usuariosTitu = $modelo->ListarUsuariosHV();
    
    $datos_usuario = $modelo->get_Datos_User($_REQUEST['id']);
    while($row = $datos_usuario->fetch()){
        $cedula     = $row['nombre_usuario'];
        $nombres    = $row['empleado'];
    }
   
    // JUAN ESTEBAN MUNERA BETANCUR
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '28';
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
    <form id="frm-DatosPlantaPersonal" action="?c=hoja_vida&a=Guardar_PlantaPersonal" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $hv->pla_id; ?>" />
        <input type="hidden" name="id_usuarioR" value="<?php echo $id_user; ?>" />
        <input type="hidden" name="pla_user_select" value="<?php echo $user_select; ?>" />
        <div class="form-group row">
            <div class="col-xs-6">
                <label>Cédula </label>
                <input type="number" readonly="" name="pla_cedula" id="per_cedula" onkeyup="validarSiNumero(this.value)" value="<?php echo $cedula; ?>" class="form-control" placeholder="Ingrese número de Cédula" data-validacion-tipo="requerido|min:2" /> 
            </div>
            <div class="col-xs-6">
                <label>Nombres </label>                
                <input type="text" readonly="" name="pla_nombres" id="per_nombres" value="<?php echo $nombres; ?>" class="form-control" placeholder="Ingrese Nombres" data-validacion-tipo="requerido|min:5" />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="cargo">Nombre Cargo</label>
                <select name="pla_id_cargo" id="pla_id_cargo" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="requerido">
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
            <div class="col-xs-6">
                <label for="clase">Clase Nombramiento</label>
                <select name="pla_id_clase" id="pla_id_clase" class="form-control selectpicker" onchange="clase_nombramiento(this.value)" data-live-search="true" data-validacion-tipo="requerido" >
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
        </div>
        <div class="form-group" id="licencia" style="display: none">
            <p><label for="licencia">¿Está en Licencia?</label></p>
            <label class="radio-inline">
                <input type="radio" onchange="licencia(1)" name="optpropiedad" value="1">Si
            </label>
            <label class="radio-inline">
                <input type="radio"  onchange="licencia(0)"name="optpropiedad" value="0">No
            </label>
        </div>
        <div class="form-group row" id="ext_field_propiedad" style="display: none">
            <div class="col-xs-4">
                <label>Nùmero de Resoluciòn Nombramiento</label>
                <input type="text" name="pla_num_res_nomb_Pro" id="pla_num_resolucion1" value="<?php echo $hv->per_direccion; ?>" class="form-control" placeholder="Ingrese Nùmero de Resoluciòn" />
            </div>
            <div class="col-xs-4">
                <label>Fecha Inicio </label>
                <input type="date" name="pla_fecha_inicio_Pro" id="pla_fecha_inicio" value="<?php echo $hv->per_direccion; ?>" class="form-control" placeholder="Ingrese Fecha Inicio"  />
            </div>
            <div class="col-xs-4">
                <label>Fecha Fin </label>
                <input type="date" name="pla_fecha_fin_Pro" id="pla_fecha_fin" value="<?php echo $hv->per_direccion; ?>" class="form-control" placeholder="Ingrese Fecha Fin" />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6" id="ext_field_licencia" style="display: none">
                <label>Ubicación </label>
                <select name="pla_id_ubicacion_Pro" id="pla_id_ubicacion" class="form-control selectpicker" onchange="ubicacion_propiedad(this.value)" data-live-search="true" >
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
            <div class="col-xs-6" id="area_pro" style="display: none">
                <label>Àrea </label>
                <select name="pla_id_are_Pro" id="pla_id_are" class="form-control selectpicker" data-live-search="true" >
                    <option value="0">Seleccione Área</option>
                    <?php while($row = $lista_areas_csPro->fetch()){ ?>
                        <?php if($hv->proc_id == $row['proc_id']){ ?>
                            <option value="<?php echo $row['proc_id']; ?>" selected=""><?php echo $row['proc_titulo']; ?></option>
                        <?php }else{ ?>
                            <option value="<?php echo $row['proc_id'] ?>"><?php echo $row['proc_titulo']; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
<!-- *********************************** FIN PROPIEDAD****************************** --> 

<!-- *********************************** INICIO PROVISIONALIDAD ****************************** --> 
        <div class="form-group row" id="ubicacion_provi" style="display: none">
            <div class="col-xs-6">
                <label>Ubicación </label>
                <select name="pla_id_ubicacion_Prov" id="pla_id_clase" class="form-control selectpicker" onchange="ubicacion_Prov(this.value)" data-live-search="true" >
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
            <div class="col-xs-6">
                <label>Nùmero de Resoluciòn Nombramiento</label>
                <input type="text" name="pla_num_res_nomb_Prov" id="pla_num_res_nomb_Prov" value="<?php echo $hv->per_direccion; ?>" class="form-control" placeholder="Ingrese Nùmero de Resoluciòn" />
            </div>
        </div>
        <div class="form-group row" id="ext_field_provisionalidad" style="display: none">
            <div class="col-xs-4">
                <label>Àrea </label>
                <select name="pla_id_are_Prov" id="pla_id_are" class="form-control selectpicker" data-live-search="true" >
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
            <div class="col-xs-3">
                <label>Fecha Inicio </label>
                <input type="date" name="pla_fecha_inicio_Prov" id="pla_fecha_inicio" value="<?php echo $hv->per_direccion; ?>" class="form-control" placeholder="Ingrese Fecha Inicio" />
            </div>
            <div class="col-xs-2">
                <p><label for="licencia">¿Abierto?</label></p>
                <label class="radio-inline">
                    <input type="radio" onchange="Provisionalidad_Abierto(1)" name="optAbierto" >Si
                </label>
                <label class="radio-inline">
                    <input type="radio" onchange="Provisionalidad_Abierto(0)"name="optAbierto">No
                </label>
            </div>
            <div class="col-xs-3">
                <label>Fecha Fin </label>
                <input type="date" name="pla_fecha_fin_Prov" id="pla_fecha_finProv" value="<?php echo $hv->per_direccion; ?>" class="form-control" placeholder="Ingrese Fecha Fin" />
            </div>
        </div>
        <div class="form-group row" id="ext_field_provisionalidad1" style="display: none">
            <div class="col-xs-6">
                <label>Persona Propiedad </label>
                <select name="pla_id_user_Reemplaza_Prov" id="id_user_reemplaza" class="form-control selectpicker" data-live-search="true" >
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
            <div class="col-xs-6"></div>
        </div>
        <div class="form-group row" id="resolTras_provi" style="display: none">
            <div class="col-xs-6">
                <label>Nùmero de Resoluciòn Traslado</label>
                <input type="text" name="pla_resol_traslado_Prov" id="pla_resol_traslado_Prov" value="<?php echo $hv->per_direccion; ?>" class="form-control" placeholder="Ingrese Nùmero de Resoluciòn" />
            </div>
            <div class="col-xs-6">
                <label>Persona Propiedad </label>
                <select name="pla_id_user_Reemplaza_Prov1" id="id_user_reemplaza" class="form-control selectpicker" data-live-search="true" >
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
        </div>
<!-- *********************************** FIN PROVISIONALIDAD****************************** --> 

<!-- *********************************** INICIO ENGARGO ********************************** --> 
        <div class="form-group row" id="ext_field_encargo" style="display: none">
            <div class="col-xs-4">
                <label>Fecha Inicio </label>
                <input type="date" name="pla_fecha_inicio_Enc" id="pla_fecha_inicio_Enc" value="<?php echo $hv->per_direccion; ?>" class="form-control" placeholder="Ingrese Fecha Inicio" />
            </div>
            <div class="col-xs-4">
                <label>Fecha Fin </label>
                <input type="date" name="pla_fecha_fin_Enc" id="pla_fecha_fin_Enc" value="<?php echo $hv->per_direccion; ?>" class="form-control" placeholder="Ingrese Fecha Fin"  />
            </div>
            <div class="col-xs-4"  >
                <label>Nùmero de Resoluciòn</label>
                <input type="text" name="pla_num_res_nomb_Enc" id="pla_num_res_nomb_Enc" value="<?php echo $hv->pla_num_res_nomb_Enc; ?>" class="form-control" placeholder="Ingrese Nùmero de Resoluciòn" />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-4" id="ext_ubicacion_Enc" style="display: none">
                <label>Ubicación </label>
                <select name="pla_id_ubicacion_Enc" id="pla_id_ubicacion_Enc" onchange="ubicacion_encargo(this.value)" class="form-control selectpicker" data-live-search="true" >
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
            <div class="col-xs-4" id="area_enc" style="display: none">
                <label>Àrea </label>
                <select name="pla_id_are_Enc" id="pla_id_are_enc" class="form-control selectpicker" data-live-search="true" >
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
            <div class="col-xs-4" id="resolucion_encargo" style="display: none">
                <label>Nùmero de Resoluciòn Traslado</label>
                <input type="text" name="pla_resol_traslado_Enc" id="pla_resol_traslado_Enc" value="<?php echo $hv->pla_resol_traslado_Enc; ?>" class="form-control" placeholder="Ingrese Nùmero de Resoluciòn" />
            </div>
        </div>
        
        <div class="form-group" id="txt_reemplaza" style="display: none">
            <label>Persona Reemplaza </label>
            <select name="pla_id_user_Reemplaza_Enc" id="id_user_reemplaza" class="form-control selectpicker" data-live-search="true" >
                <option value="0">Seleccione Persona</option>
                <?php foreach($this->model->ListarUsuariosHV() as $r): ?>
                    <?php if($hv->id_user == $r->id){ ?>
                        <option value="<?php echo $r->id; ?>" selected=""><?php echo $r->empleado; ?></option>
                    <?php }else{ ?>
                        <option value="<?php echo $r->id; ?>"><?php echo $r->empleado; ?></option>
                    <?php } ?>
                <?php endforeach; ?>
            </select>
        </div>
        
        <hr />
        <div class="text-right">
            <button class="btn btn-primary" ><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
        </div>
    </form>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#frm-DatosPlantaPersonal").submit(function(){
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
