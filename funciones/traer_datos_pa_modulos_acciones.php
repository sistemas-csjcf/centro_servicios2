<?php

	require_once('../libs/Conexion_Funciones.php');

	$cadena   = "";
	
	$id		  = trim($_GET['idvalor']);
	
	$conexion = db_connect();
	
	
	$sql = "SELECT * FROM pa_modulo_acciones
			WHERE id = '$id'";

	$resultado = mysql_query($sql);
	$fila      = mysql_fetch_array($resultado);
   	$datos0    = $fila["idtabla"];
	$cadena    = $datos0;
	
	echo trim($cadena);

	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	