<?php
date_default_timezone_set('America/Bogota');
// Recopilación de Datos
$nombre     = trim($_POST['nombre']);
$documento  = trim($_POST['documento']);
$correo     = trim($_POST['correo']);
$contrasena = md5(trim($_POST['contrasena']));
$es_abogado = trim($_POST['es_abogado']);
$fecha      = date('Y-m-d');
$hora       = date('H:i:s');
$user       = trim($_POST['uid']);

require_once("conect_and_data.php");
$sql = "
INSERT INTO pa_usuario_ext
(nombre_usuario, idperfil, tipo_perfil, empleado, contrasena, foto, iniciales_reporte, idareaempleado, idestadoempleado, pantalla, ingreso, edita_hv, cargo, idareaacargo, idareapertenece, nivelusuario, modulos, id_juzgado, fecha, hora, tipousuario, iddepartamento, idmunicipio, idofireparto) VALUES
('".$documento."', 1, 'admin', '".$nombre."', '".$contrasena."', 'views/fotos/usuario.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '".$fecha."', '".$hora."', 'PUBLICO', NULL, NULL, NULL);
";

if ( mysql_query($sql) or die ( mysql_error($conexion) ) ) {
  $update = "
  UPDATE solic_usu_ext
  SET chk = 1
  WHERE n_documento = '".$documento."'
  AND correo = '".$correo."'
  AND contrasena = '".$_POST['contrasena']."'
  AND nombre_usuario = '".$nombre."'
  ";
  if ( mysql_query($update) or die ( mysql_error($conexion) ) ) {
    echo "<a href='pendaprob.php?uid=".$user."'><img src='img/success.png' style='margin-left: calc((100% - 1400px) /2); margin-top: 2%;'></a>";
  } else {
    echo "<a href='pendaprob.php?uid=".$user."'><img src='img/fail.png' style='margin-left: calc((100% - 1400px) /2); margin-top: 2%;'></a>";
  }
} else {
  echo "<a href='pendaprob.php?uid=".$user."'><img src='img/fail.png' style='margin-left: calc((100% - 1400px) /2); margin-top: 2%;'></a>";
}
?>
