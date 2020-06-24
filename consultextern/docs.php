<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (!isset($_POST["objeto"])){
  header("refresh: 0; URL=/centro_servicios2/");
  exit;
}
else{
  require("conect_and_data.php");
  $objeto = json_decode($_POST["objeto"], true);
  $id     = $objeto["id"];
  $response = "";

  $consulta = "
  SELECT memorial FROM enlaceadoc WHERE id_proceso = ".$id.";
  ";
  $resultado = mysql_query($consulta);
  while ($object = mysql_fetch_array($resultado)){
    $response = $response."|".$object['memorial'];
  }
  echo $response;
}
?>
