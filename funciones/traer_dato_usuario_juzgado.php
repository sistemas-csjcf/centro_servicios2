<?php

	require_once('../libs/Conexion_Funciones.php');

	$cadena   = "";
	
	$id		= trim($_GET['id']);
	
	$conexion = db_connect();
	
	$sql = "SELECT pu.empleado FROM (pa_juzgado pj INNER JOIN pa_usuario pu ON pj.idusuariojuzgado = pu.id)  WHERE pj.id = '$id'";

	
	$resultado = mysql_query($sql);
	
   	while($fila = mysql_fetch_array($resultado)){
	
		$datos0  = $fila["empleado"];
		/*$datos1  = $fila["idusuario"];
		$datos2  = $fila["identrada"];
		$datos3  = $fila["idtipodocumento"];
		$datos4  = $fila["numero"];
		$datos5  = $fila["dirigidoa"];
		$datos6  = $fila["nombre"];
		$datos7  = $fila["cargo"];
		$datos8  = $fila["dependencia"];
		$datos9  = $fila["fechageneracion"];
		$datos10 = $fila["asunto"];
		$datos11 = $fila["contenido"];*/
		
		
		//$cadena .= $datos0."//////".$datos1."//////".$datos2."//////".$datos3."//////".$datos4."//////".$datos5."//////".$datos6."//////".$datos7."//////".$datos8."//////".$datos9."//////".$datos10."//////".$datos11;
		
		
		
   	}
	
	//echo trim($cadena);
	
	echo trim($datos0);

	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	