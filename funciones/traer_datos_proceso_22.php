<?php
	require_once('../libs/Conexion_Funciones.php');
	$cadena   = "";
	$cadena2  = "";
	$cadena3  = "";
	$id		= trim($_GET['idvalor']);
	$conexion = db_connect();	
	$sql = "SELECT sp.id,sp.radicado,sp.radicadosignotanterior,pj.nombre AS nombrejuzgado,pj.id AS idjuzgado,pc.nombre_proceso AS nombreproceso,pc.id AS idclaseproceso,sp.iddevolucion,td.nombre_tipo_documento,sp.claseproceso2,sp.entidadcomisiona,sp.asunto,sp.despacholibra
	        FROM (((signot_proceso sp LEFT JOIN pa_juzgado pj ON sp.idjuzgadoorigen = pj.id)
            LEFT JOIN signot_pa_clase_proceso pc ON sp.idclaseproceso = pc.id)
			LEFT JOIN pa_tipodocumento td ON sp.iddevolucion = td.id)
            WHERE sp.radicado = '$id' GROUP BY sp.radicado";
	$resultado = mysql_query($sql);
   	while($fila = mysql_fetch_array($resultado)){
		$datos0  = $fila["id"];
		$datos1  = $fila["radicado"];
		$datos2  = $fila["nombrejuzgado"];
		$datos2b = $fila["idjuzgado"];
		$datos3  = $fila["nombreproceso"];
		$datos3b = $fila["idclaseproceso"];
		$datos4  = $fila["iddevolucion"];
		$datos4b = $fila["nombre_tipo_documento"];
		$datos5  = $fila["radicadosignotanterior"];
		$datos6  = $fila["claseproceso2"];
		$datos7  = $fila["entidadcomisiona"];
		$datos8  = $fila["asunto"];
		$datos9  = $fila["despacholibra"];
		$cadena .= $datos0."//////".$datos1."//////".$datos2."//////".$datos3."//////".$datos2b."//////".$datos3b."//////".$datos4."//////".$datos4b."//////".$datos5."//////".$datos6."//////".$datos7."//////".$datos8."//////".$datos9;
   	}
	$sql_2 = "SELECT pa.id,pa.cedula,pa.nombre,cp.id AS idclasificacion,cp.descripcion AS clasificacion
				FROM (((signot_proceso sp  LEFT JOIN signot_parteproceso pp ON sp.id = pp.idproceso)
				LEFT JOIN signot_parte pa ON pa.id = pp.idparte)
				LEFT JOIN signot_clasificacion_parte cp ON cp.id = pp.idclaseparte)
				WHERE sp.radicado = '$id'
				ORDER BY pa.nombre";
	$resultado = mysql_query($sql_2);
   	while($fila = mysql_fetch_array($resultado)){
		$datost0  = $fila["id"];
		$datost1  = $fila["cedula"];
		$datost2  = $fila["nombre"];
		$datost3  = $fila["idclasificacion"];
		$datost4  = $fila["clasificacion"];
		$cadena2 .= $datost0."//////".$datost1."//////".$datost2."//////".$datost3."//////".$datost4."------";
   	}
	$sql3 = "SELECT spo.fechaob,spo.observacion
			 FROM (signot_proceso sp LEFT JOIN signot_proceso_observacion spo ON sp.id = spo.idradicado)
			 WHERE sp.radicado = '$id'
			 ORDER BY spo.id DESC";
	$resultado = mysql_query($sql3);
   	while($fila = mysql_fetch_array($resultado)){
		$datoso0  = $fila["fechaob"];
		$datoso1  = $fila["observacion"];
		$cadena3 .= $datoso0."//////".$datoso1."------";
   	}
	echo trim(utf8_encode($cadena."******".$cadena2."******".$cadena3));
	mysql_close($conexion);	
?>