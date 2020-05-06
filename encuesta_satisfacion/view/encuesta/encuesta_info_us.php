<?php
    session_start();
    $_SESSION['nombre'];
    $id_user = $_SESSION['idUsuario'];
    require_once "../../core/conexion.php";
    $link=conectarse();
    $cedula   = $_POST['us'];
    $sql="SELECT * FROM encuestado_datos WHERE cedula ='$cedula'";
    $res=mysql_query($sql,$link);
    while($row=mysql_fetch_array($res)){ 
        $id     = $row[0];
        $cedula = $row[1];
        $nombre = $row[2];
    }
    $num_filas = mysql_num_rows($res);
    if($num_filas>0){ 
        $alerta = "success";
        $mensaje = "Información Usuario";
        $flag =1;
    }else{
        $alerta = "danger";
        $mensaje = "Número Cédula no se encuentra registrado, intente nuevamente.";
        $flag=0;
    }  
    if(isset($id_user)){
?>
    <input type="hidden" name="id_usuarioR" value="<?php echo $id_user; ?>">
    <input type="hidden" name="id_encuestado" value="<?php echo $id; ?>">
    <input type="hidden" name="bandera" value="<?php echo $flag; ?>" required="" >
    <div class="alert alert-<?php echo $alerta; ?>" role="alert"><?php echo $mensaje; ?></div>
    <table id="example1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Código</th>
                <th>Cèdula</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $id ?></td>
                <td><?php echo $cedula ?></td>
                <td><input type="text" name="nombre" class="form-control" placeholder="Ingrese Nombre Encuestado" value="<?php echo $nombre; ?>" data-validacion-tipo="requerido|min:3"></td>
            </tr>
        </tbody>
    </table>
<?php }else{ ?>
   <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>