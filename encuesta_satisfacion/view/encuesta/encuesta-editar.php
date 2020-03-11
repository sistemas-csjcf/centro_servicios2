<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user    = $_SESSION['idUsuario'];
    //echo $_SESSION['id_proceso_cs'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo             = new Encuesta();
  
    $idaccion           = '36';
    $datos_us_accion    = $modelo->get_lista_usuario_accionesJE($idaccion);
    $us_encuesta        = $datos_us_accion->fetch();
    $usuario_encu       = explode("////",$us_encuesta[usuario]);
    
	/*if(isset($id_user)){
        if ( in_array($_SESSION['idUsuario'],$usuario_encu) ) {*/
    if(isset($id_user)){
        if ($_SESSION['idUsuario']) {
?>
<h1 class="page-header">
    <?php echo $enc->id != null ? $enc->Nombre : 'Nuevo Registro'; ?>
</h1>
<ol class="breadcrumb">
  <li><a href="#">Encuestas </a></li>
  <li class="active"><?php echo $enc->id != null ? $enc->Nombre : 'Nuevo Registro'; ?></li>
</ol>
<form id="frm-encuesta" action="?c=Encuesta&a=Guardar_Encuesta" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $enc->id; ?>" />
    <div class="form-group">
        <label>Número de Cédula </label>
        <input type="text" name="cedula" onkeyup="buscar_us(this.value)" class="form-control" placeholder="Ingrese Nª Cédula" data-validacion-tipo="requerido|min:3" />
    </div>
     <div id="load"></div>
    <div id="resultado"></div>
    
    <div class="form-group">
        <label>¿Cómo califica la atención recibida en términos de amabilidad y respeto?</label><br/>
        <input type="radio" name="calificacion1" value="Excelente" required="" />Excelente
        <input type="radio" name="calificacion1" value="Bueno" required="" />Bueno
        <input type="radio" name="calificacion1" value="Regular" required="" />Regular
        <input type="radio" name="calificacion1" value="Malo" required="" />Malo
    </div>
	<div class="form-group">
        <label>¿Cómo califica la atención recibida en términos de respuesta oportuna?</label><br/>
        <input type="radio" name="calificacion2" value="Excelente" required="" />Excelente
        <input type="radio" name="calificacion2" value="Bueno" required="" />Bueno
        <input type="radio" name="calificacion2" value="Regular" required="" />Regular
        <input type="radio" name="calificacion2" value="Malo" required="" />Malo
    </div>
	<div class="form-group">
        <label>¿Califique su nivel de satisfacción en cuanto a la información que recibió frente a su solicitud o trámite?</label><br/>
        <input type="radio" name="calificacion3" value="Excelente" required="" />Excelente
        <input type="radio" name="calificacion3" value="Bueno" required="" />Bueno
        <input type="radio" name="calificacion3" value="Regular" required="" />Regular
        <input type="radio" name="calificacion3" value="Malo" required="" />Malo
    </div>
    <div class="form-group">
        <label>Observaciones</label>
        <textarea class="form-control" name="observaciones" id="comment" rows="5" placeholder="Observaciones"></textarea>
    </div>
    <hr />
    <div class="text-right">
        <button class="btn btn-success">Guardar</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        $("#frm-encuesta").submit(function(){
            return $(this).validate();
        });
    });
</script>
<?php }else{ ?> 
        <h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para acceder a esta opción</h4>
    <?php } ?> 
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } 