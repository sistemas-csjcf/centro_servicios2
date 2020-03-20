<?php
//Configuracion de la conexion a base de datos
$bd_host     = "localhost"; 
$bd_usuario  = "root"; 
$bd_password = "servicios2017"; 
$bd_base     = "centro_servicios2"; 
$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
mysql_select_db($bd_base, $con); 
?>