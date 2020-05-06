<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user              = $_SESSION['idUsuario'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo               = new Visita();
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '20';
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
        <?php echo $vis->vis_TSoci_id != null ? $vis->vis_TSoci_nombre : 'Nuevo Registro'; ?>
    </h1>

    <ol class="breadcrumb">
      <li><a href="?c=Visitas&a=TSocial">Trabajo Social</a></li>
      <li class="active"><?php echo $vis->vis_TSoci_id != null ? $vis->vis_TSoci_nombre : 'Nuevo Registro'; ?></li>
    </ol>

    <form id="frm-tSocial" action="?c=Visitas&a=Guardar_TSocial" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $vis->vis_TSoci_id; ?>" />
        <input type="hidden" name="idU" value="<?php echo $vis->vis_TSoci_id_usuario; ?>" />
        <?php if($vis->vis_TSoci_id == null){ ?>
            <div class="form-group">
                <label>Cédula </label>
                <input type="number" name="cedulaTS" id="cedulaTS" onkeyup="validarSiNumero(this.value)" value="<?php echo $vis->vis_TSoci_cedula; ?>" class="form-control" placeholder="Ingrese número de Cédula" data-validacion-tipo="requerido|min:2" />   
                <br><button type="button" id="btn_consultar" class="btn btn-info" onclick="buscar_user()">Consultar</button>
            </div>
            <div id="load"></div>
            <div id="resultado"></div> 
        <?php }else{ ?>
            <div class="form-group">
                <label>Nombre </label>
                <input type="text" name="nombreTS" id="nombreTS" value="<?php echo $vis->vis_TSoci_nombre; ?>" class="form-control" placeholder="Ingrese nombre completo" data-validacion-tipo="requerido|min:5" />    
            </div>
        <?php } ?>
        <div class="form-group">
            <label>Contador </label>
            <input type="number" name="contadorTS" id="contadorTS" value="<?php echo $vis->vis_TSoci_contador; ?>" class="form-control" placeholder="Ingrese número iniciar contador" data-validacion-tipo="requerido|min:0" />    
        </div>
        <div class="form-group">
            <label>Estado</label>
            <select name="estadoTS" class="form-control">
                <option <?php echo $vis->vis_TSoci_estado == 1 ? 'selected' : ''; ?> value="1">Activo</option>
                <option <?php echo $vis->vis_TSoci_estado == 0 ? 'selected' : ''; ?> value="0">Inactivo</option>
            </select>
        </div>
        <hr />
        <div class="text-right">
            <button class="btn btn-success">Guardar</button>
        </div>
    </form>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#frm-tSocial").submit(function(){
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
<?php }else{ ?><br/>
    <h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para acceder a esta opción</h4>
<?php } ?>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.30/centro_servicios2" ); } ?>