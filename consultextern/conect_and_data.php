<?php

mysql_connect("localhost", "root", "servicios2017");
mysql_select_db("centro_servicios2");
mysql_query("SET NAMES 'utf8'");

function db_connect(){
	if(!($link=mysql_connect ("localhost","root","servicios2017"))){
		echo 'Error conectando con el servidor';
		exit();
	}
	if(!mysql_select_db("centro_servicios2",$link)){
		echo 'Error seleccionando la base de datos';
		exit();
	}
	return $link;
}

$conexion = db_connect();
?>
