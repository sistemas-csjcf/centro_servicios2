<?php
    mysql_connect("localhost", "root", "admin");
    mysql_select_db("centro_servicios2");
    mysql_query("SET NAMES 'utf8'");
    function conectarse(){
        if(!($link=mysql_connect ("localhost","root","admin"))){
            echo 'Error conectando con el servidor';
            exit();
	}
	if(!mysql_select_db("centro_servicios2",$link)){
            echo 'Error seleccionando la base de datos';
            exit();
	}
	return $link;
    }
?>