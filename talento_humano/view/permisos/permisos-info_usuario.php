<?php
    session_start();
    $_SESSION['nombre'];
    $id_user = $_SESSION['idUsuario'];
    require_once "../../core/conexion.php";
    $link=conectarse();
    $cedula   = $_POST['cedu'];
    $sql="SELECT * FROM pa_usuario WHERE nombre_usuario = '$cedula'";
    $res=mysql_query($sql,$link);
    while($row=mysql_fetch_array($res)){ 
        $us_id      = $row['id'];
        $cedula  = $row['nombre_usuario'];
        $us_nombre  = $row['empleado'];
    }
    $num_filas = mysql_num_rows($res);
    if($num_filas>0){ 
        $alerta = "success";
        $mensaje = "Información Usuario";
    }else{
        $alerta = "danger";
        $mensaje = "Número Cédula no se encuentra registrado, intente nuevamente.";
    }  
    
    if(isset($id_user)){
?>
    <input type="hidden" name="id_usuario" value="<?php echo $us_id; ?>">
    <input type="hidden" name="cedula_us" value="<?php echo $cedula; ?>">
    <input type="hidden" name="nombre_us" value="<?php echo $us_nombre; ?>">
    <div class="alert alert-<?php echo $alerta; ?>" role="alert"><?php echo $mensaje; ?></div>
    <div class="form-group row">
        <div class="col-xs-6">
            <label title="Código Usuario">ID </label>
            <input type="text" name="id_user" readonly="" id="id_user" value="<?php echo $us_id ?>" class="form-control" placeholder="Ingrese id Usuario" data-validacion-tipo="requerido|min:3" required=" " />    
        </div>
        <div class="col-xs-6">
            <label>Nombre </label>
            <input type="text" name="nombreUs" readonly="" id="nombreUs" value="<?php echo $us_nombre ?>" class="form-control" placeholder="Ingrese nombre completo" data-validacion-tipo="requerido|min:3" />    
        </div>
    </div>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.30/centro_servicios2" ); } ?>