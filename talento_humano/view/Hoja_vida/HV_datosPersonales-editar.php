<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user            = $_SESSION['idUsuario'];
    $return_flag        = $_REQUEST['return_flag'];
    $bandera            = $_REQUEST['band'];
    $user_select        = $_REQUEST['us'];
    $modelo             = new HojaVida();
    $lista_departamento = $modelo->get_Departamento();
    $lista_municipio    = $modelo->Get_Municipio_Asociado($hv->per_id_dep_nacimiento);
   
//    // JUAN ESTEBAN MUNERA BETANCUR
//    $modelo               = new Visita();
//    $campos               = 'usuario';
//    $nombrelista          = 'pa_usuario_acciones';
//    $idaccion             = '20';
//    $campoordenar         = 'id';
//    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
//    $usuarios             = $datosusuarioacciones->fetch();
//    $usuariosa            = explode("////",$usuarios[usuario]);
//    date_default_timezone_set('America/Bogota'); 
//    $fecha_actual = date('Y-m-d');
//    if(isset($id_user)){
//        if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
    if($bandera == 1){
        $datos_usuario = $modelo->get_Datos_User($_REQUEST['us']);
        while($row = $datos_usuario->fetch()){
            $cedula =$row['nombre_usuario'];
            $nombres =$row['empleado'];
        }
    }
    $tokens = explode(' ', trim($nombres));
    $cantidad = count($tokens);
    //print_r ($tokens);
    if($cantidad ==3){
        $nombre     = $tokens[0];
        $apellidos  = $tokens[1]." ".$tokens[2];
    }else if($cantidad == 4){
        $nombre = $tokens[0]." ".$tokens[1];
        $apellidos = $tokens[2]." ".$tokens[3];        
    }


?>
    <h1 class="page-header">
        <?php echo $hv->per_id != null ? $hv->per_nombres : 'Nuevo Registro'; ?>
    </h1>

    <ol class="breadcrumb">
        <li><a href="?c=hoja_vida">Datos Personales</a></li>
        <li class="active"><?php echo $vis->vis_TSoci_id != null ? $vis->vis_TSoci_nombre : 'Nuevo Registro'; ?></li>
    </ol>

    <form id="frm-HVDatosPersonales" action="?c=hoja_vida&a=Guardar_datosPersonales" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $hv->per_id; ?>" />
        <input type="hidden" name="return_flag" value="<?php echo $return_flag ?>" />
        <input type="hidden" name="id_usuarioR" value="<?php echo $id_user; ?>" />
        <input type="hidden" name="band" value="<?php echo $bandera; ?>" />
        <div class="form-group">
            <i class="fa fa-address-card-o" aria-hidden="true"></i> <label>Cédula </label>
            <?php if($bandera>0){ ?>
                <input type="number" name="per_cedula" id="per_cedula" onkeyup="validarSiNumero(this.value)" value="<?php echo $cedula; ?>" class="form-control" placeholder="Ingrese número de Cédula" data-validacion-tipo="requerido|min:2" />   
            <?php }else{  ?>
                <input type="number" name="per_cedula" id="per_cedula" onkeyup="validarSiNumero(this.value)" value="<?php echo $hv->per_cedula; ?>" class="form-control" placeholder="Ingrese número de Cédula" data-validacion-tipo="requerido|min:2" />   
            <?php } ?>   
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <i class="fa fa-user"></i> <label>Nombres </label>
                <?php if($bandera>0){ ?>
                    <input type="text" name="per_nombres" id="per_nombres" value="<?php echo $nombre; ?>" class="form-control" placeholder="Ingrese Nombres" data-validacion-tipo="requerido|min:5" />    
                <?php }else{  ?>
                    <input type="text" name="per_nombres" id="per_nombres" value="<?php echo $hv->per_nombres; ?>" class="form-control" placeholder="Ingrese Nombres" data-validacion-tipo="requerido|min:5" />    
                <?php } ?>    
            </div>
            <div class="col-xs-6">
                <i class="fa fa-user bigicon"></i> <label>Apellidos </label>
                <?php if($bandera>0){ ?>
                    <input type="text" name="per_apellidos" id="per_apellidos" value="<?php echo $apellidos; ?>" class="form-control" placeholder="Ingrese Apellidos" data-validacion-tipo="min:5" />     
                <?php }else{  ?>
                    <input type="text" name="per_apellidos" id="per_apellidos" value="<?php echo $hv->per_apellidos; ?>" class="form-control" placeholder="Ingrese Apellidos" data-validacion-tipo="min:5" />     
                <?php } ?>    
            </div>
        </div>
        <div class="form-group">
            <i class="glyphicon glyphicon-calendar" aria-hidden="true"></i> <label>Fecha Nacimiento </label>
            <input readonly type="text" name="per_fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $hv->per_fecha_nacimiento; ?>" class="form-control datepicker" placeholder="Ingrese fecha Nacimiento" />
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <i class="glyphicon glyphicon-globe" aria-hidden="true"></i> <label for="departamento">Departamento Nacimiento</label>
                <select name="per_id_departamento" id="per_id_departamento" class="form-control selectpicker" data-live-search="true">
                    <option>Seleccione Departamento</option>
                    <?php while($row = $lista_departamento->fetch()){ ?>
                        <?php if($hv->per_id_dep_nacimiento == $row['id']){ ?>
                            <option value="<?php echo $row['id']; ?>" selected=""><?php echo $row['nombre']; ?></option>
                        <?php }else{ ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre']; ?></option>
                        <?php }} ?>
                </select>
            </div>
            <div class="col-xs-6">
                <i class="glyphicon glyphicon-pushpin" aria-hidden="true"></i> <label for="hora_fin">Municipio Nacimiento</label>
                <select name="per_id_municipio" id="per_id_municipio" class="form-control">
                    <?php if($hv->per_id_ciu_nacimiento !=""){ ?> 
                        <?php while($row = $lista_municipio->fetch()){ ?>
                            <?php if($hv->per_id_ciu_nacimiento == $row['id']){ ?>
                                <option value="<?php echo $row['id']; ?>" selected=""><?php echo $row['nombre']; ?></option>
                                <?php }else{ ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre']; ?></option>
                                <?php } ?>
                        <?php }}else{ ?>
                            <option>Seleccione Municipio</option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <i class="glyphicon glyphicon-home" aria-hidden="true"></i> <label>Dirección Residencia </label>
                <input type="text" name="per_direccion" id="per_direccion" value="<?php echo $hv->per_direccion; ?>" class="form-control" placeholder="Ingrese Dirección Residencia" data-validacion-tipo="min:5" />
            </div>
            <div class="col-xs-6">
                <i class="fa fa-phone" aria-hidden="true"></i> <label>Teléfono </label>
                <input type="text" name="per_telefono" id="per_telefono" value="<?php echo $hv->per_telefono; ?>" class="form-control" placeholder="Ingrese N° Teléfono Fijo" />    
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <i class="glyphicon glyphicon-phone" aria-hidden="true"></i> <label>N° Celular </label>
                <input type="text" name="per_celular" id="celular" value="<?php echo $hv->per_celular; ?>" class="form-control" placeholder="Ingrese Nª Celular" min="10" />    
            </div>
            <div class="col-xs-6">
                <i class="fa fa-envelope-o" aria-hidden="true"></i> <label>Correo Electrónico </label>
                <input type="email" name="per_email" id="email" value="<?php echo $hv->per_email; ?>" class="form-control" placeholder="Ingrese Correo Electrónico" data-validacion-tipo="email" />    
            </div>
        </div>
        <div class="form-group">
            <i class="fa fa-user-circle" aria-hidden="true"></i> <label>Foto </label>
            <input type="hidden" name="per_foto" value="<?php echo $hv->per_ruta_foto; ?>" class="form-control" placeholder="Ingrese Foto" />
            <?php if ($hv->per_ruta_foto == ''){ ?>
                <input id="file-1" name="per_ruta_foto" type="file" placeholder="Ingrese Documento" class="file" data-preview-file-type="any">
            <?php }else{ ?>
                <input id="file-1" name="per_ruta_foto" type="file" placeholder="Ingrese Documento" class="file" data-preview-file-type="any">
            <?php } ?>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <?php if($hv->per_ruta_foto != ''): ?>
                    <div class="img-thumbnail " style="border: 0px;">
                        <img src="documentos_HV/fotos/<?php echo $hv->per_id_usuario.'/'.$hv->per_ruta_foto; ?>" style="width:40%; " />
                        <a href="documentos_HV/fotos/<?php echo $hv->per_id_usuario.'/'.$hv->per_ruta_foto; ?>" target="_blank" style="text-decoration:none;"><i class="icon-download3"></i>Descargar</a>
                    </div>
                <?php endif; ?>            
            </div>
        </div>
        <hr />
        <div class="text-right">
            <button class="btn btn-primary" ><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
        </div>
    </form>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#frm-HVDatosPersonales").submit(function(){
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
<?php // }else{ ?><br/>
    <!--<h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para acceder a esta opción</h4>-->
<?php //} ?>
<?php// }else{ ?>
    <!--<script type="text/javascript">alert("ERROR, autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>-->
<?php // header( "refresh:2; url=http://172.16.175.30/centro_servicios2" ); } ?>
