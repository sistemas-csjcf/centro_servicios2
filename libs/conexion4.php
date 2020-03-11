<!--Conexion Oficina Judicial-->
<?php 
/*$cs = mysql_connect("localhost", "root", "admin");
mysql_select_db("bd_oficina_judicial", $cs);*/
$cs = mysql_connect("192.168.89.28", "cscf_salud", "Servicios25%") or die(mysql_error());
mysql_select_db("bd_oficina_judicial", $cs);
?>