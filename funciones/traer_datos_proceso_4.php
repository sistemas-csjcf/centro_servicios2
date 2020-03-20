<?php

	require_once('../libs/Conexion_Funciones.php');

	$cadena   = "";
	
	$id		= trim($_GET['idvalor']);
	
	$conexion = db_connect();
	
	$sql = "SELECT sp.id,sp.radicado,pj.nombre AS nombrejuzgado,pj.id AS idjuzgado,pc.nombre_proceso AS nombreproceso,pc.id AS idclaseproceso,
			sp.iddevolucion
			FROM ((signot_proceso sp LEFT JOIN pa_juzgado pj ON sp.idjuzgadoorigen = pj.id)
			LEFT JOIN signot_pa_clase_proceso pc ON sp.idclaseproceso = pc.id)
			WHERE sp.radicado LIKE '%$id%' group by sp.id";
			

	$resultado = mysql_query($sql);
	
   	while($fila = mysql_fetch_array($resultado)){
	
		//echo $fila['numero'];
		
		$datos0  = $fila["id"];
		$datos1  = $fila["radicado"];
		$datos2  = $fila["nombrejuzgado"];
		$datos2b = $fila["idjuzgado"];
		$datos3  = $fila["nombreproceso"];
		$datos3b = $fila["idclaseproceso"];
		$datos4  = $fila["iddevolucion"];
		//$datos4b = $fila["nombre_tipo_documento"];
		
		
		$cadena .= $datos0."//////".$datos1."//////".$datos2."//////".$datos3."//////".$datos2b."//////".$datos3b."------";
		
   	}
	
	echo trim($cadena);

	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	