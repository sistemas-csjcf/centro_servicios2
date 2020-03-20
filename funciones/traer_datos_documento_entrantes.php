<?php

	require_once('../libs/Conexion_Funciones.php');

	$cadena   = "";
	
	$id		= trim($_GET['id']);
	
	$conexion = db_connect();
	
	$sql = "SELECT * FROM sigdoc_entrante WHERE id = '$id'";

	
	$resultado = mysql_query($sql);
	
   	while($fila = mysql_fetch_array($resultado)){
	
		//echo $fila['numero'];
		
		$datos0  = $fila["id_recibe"];
		$datos1  = $fila["fecha_recepcion"];
		$datos2  = $fila["hora_recepcion"];
		$datos3  = $fila["quien_envia"];
		$datos4  = $fila["id_tipo_documento"];
		$datos5  = $fila["numero"];
		$datos6  = $fila["asunto"];
		$datos7  = $fila["area_destino"];
		$datos8  = $fila["id_empleado"];
		$datos9  = $fila["fecharespuesta"];
		
		$cadena .= $datos0."//////".$datos1."//////".$datos2."//////".$datos3."//////".$datos4."//////".$datos5."//////".$datos6."//////".$datos7."//////".$datos8."//////".$datos9;
		
   	}
	
	echo trim($cadena);

	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	