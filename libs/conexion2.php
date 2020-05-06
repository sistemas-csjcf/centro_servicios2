<!--Conexion Centro de Servicios-->
<?php
/*$cs = mysql_connect("localhost", "root", "admin") or die(mysql_error());
	mysql_select_db("centro_servicios2", $cs);*/
$cs = mysql_connect("localhost", "root", "servicios2017") or die(mysql_error());
	mysql_select_db("centro_servicios2", $cs);
?>