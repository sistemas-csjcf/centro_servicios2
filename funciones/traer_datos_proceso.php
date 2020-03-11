<?php

	require_once('../libs/Conexion_Funciones.php');

	$cadena   = "";
	
	$idradicado = trim($_GET['idradicado']);
	
	$idaccion   = trim($_GET['idaccion']);
	
	$conexion = db_connect();
	
	$sql = "SELECT * FROM signot_proceso
			WHERE radicado = '$idradicado'";

	
	$resultado = mysql_query($sql);
	
   	while($fila = mysql_fetch_array($resultado)){
	
		//echo $fila['numero'];
		
		$datos0  = $fila["radicado"];

		$cadena  = $datos0;
		
   	}
	
	echo trim($cadena."//////".$idaccion);

	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	