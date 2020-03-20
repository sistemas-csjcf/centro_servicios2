<?php 
//    session_start();
//    $_SESSION['nombre'];
//    $id_user              = $_SESSION['idUsuario'];
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
?>
    <h1 class="page-header">
        <?php echo $hv->vis_TSoci_id != null ? $hv->vis_TSoci_nombre : 'Nuevo Registro'; ?>
    </h1>

    <ol class="breadcrumb">
        <li><a href="?c=hoja_vida">Datos Personales</a></li>
        <li class="active"><?php echo $vis->vis_TSoci_id != null ? $vis->vis_TSoci_nombre : 'Nuevo Registro'; ?></li>
    </ol>
    <form id="frm-HVDatosPersonales" action="?c=hoja_vida&a=Guardar_datosPersonales" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $vis->vis_TSoci_id; ?>" />
        <input type="text" name="idU" value="<?php echo $vis->vis_TSoci_id_usuario; ?>" />
         <div class="form-group row">
            <div class="col-xs-6">
                <i class="glyphicon glyphicon-folder-open" aria-hidden="true"></i> <label for="departamento">Nivel Educación</label>
                <select class="form-control" name="id_departamento">
                    <option>Seleccione Departamento</option>
                </select>
            </div>
            <div class="col-xs-6">
                <i class="icon-books" aria-hidden="true"></i> <label for="hora_fin">Titulo Formación</label>
                <select class="form-control" name="id_municipio">
                    <option>Seleccione Municipio</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <i class="icon-office"></i> <label>Organización </label>
                <input type="text" name="per_nombres" id="per_nombres" value="<?php echo $vis->per_nombres; ?>" class="form-control" placeholder="Ingrese Nombres" data-validacion-tipo="requerido|min:5" />    
            </div>
            <div class="col-xs-6">
                <i class="glyphicon glyphicon-globe"></i> <label>Ciudad </label>
                <input type="text" name="per_apellidos" id="per_apellidos" value="<?php echo $vis->per_apellidos; ?>" class="form-control" placeholder="Ingrese Apellidos" data-validacion-tipo="requerido|min:5" />     
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-4">
                <i class="icon-calendar" aria-hidden="true"></i> <label>Duración en Meses</label>
                <input type="number" name="per_fecha_nacimiento" id="duracion" value="<?php echo $vis->th_fecha_nacimiento; ?>" class="form-control" placeholder="Ingrese fecha Nacimiento" data-validacion-tipo="requerido" />
            </div>
            <div class="col-xs-4">
                <i class="glyphicon glyphicon-calendar" aria-hidden="true"></i> <label for="departamento">Año Incio</label>
                <input type="date" class="form-control">
            </div>
            <div class="col-xs-4">
                <i class="glyphicon glyphicon-pushpin" aria-hidden="true"></i> <label for="hora_fin">Año Finalización</label>
                <input type="date" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
               <i class="glyphicon glyphicon-open-file" aria-hidden="true"></i> <label>Certificado </label>
            <input type="file" name="ruta_certificado" id="ruta_foto" value="<?php echo $vis->th_ruta_foto; ?>" class="form-control" placeholder="Ingrese Certificado" data-validacion-tipo="requerido|min:0" />    
            </div>
            <div class="col-xs-6">
                <i class="glyphicon glyphicon-education" aria-hidden="true"></i> <label for="hora_fin">Graduado</label>
                <div class="radio">
                    <label class="radio-inline"><input type="radio" name="optradio" value="1">Si</label>
                    <label class="radio-inline"><input type="radio" name="optradio" value="0">No</label>
                </div>
            </div>
        </div>
        <hr />
        <div class="text-right">
            <button class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
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
        }
    </script>
<?php // }else{ ?><br/>
    <h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para acceder a esta opción</h4>
<?php //} ?>
<?php// }else{ ?>
    <!--<script type="text/javascript">alert("ERROR, autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>-->
<?php // header( "refresh:2; url=http://172.16.175.30/centro_servicios2" ); } ?>
