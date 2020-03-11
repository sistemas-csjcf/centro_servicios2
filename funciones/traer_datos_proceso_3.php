<?php

	require_once('../libs/Conexion_Funciones.php');

	$cadena   = "";
	$cadena2  = "";
	$cadena3  = "";
	
	$id		= trim($_GET['idvalor']);
	
	$conexion = db_connect();
	
	/*$sql = "SELECT sp.id,sp.radicado,pj.nombre AS nombrejuzgado,pj.id AS idjuzgado,pc.nombre_proceso AS nombreproceso,pc.id AS idclaseproceso, 
			sp.iddevolucion,td.nombre_tipo_documento
	        FROM (((signot_proceso sp INNER JOIN pa_juzgado pj ON sp.idjuzgadoorigen = pj.id)
            INNER JOIN signot_pa_clase_proceso pc ON sp.idclaseproceso = pc.id)
			LEFT JOIN pa_tipodocumento td ON sp.iddevolucion = td.id)
            WHERE sp.radicado = '$id'";*/
			
			
	$sql = "SELECT sp.id,sp.radicado,pj.nombre AS nombrejuzgado,pj.id AS idjuzgado,pc.nombre_proceso AS nombreproceso,pc.id AS idclaseproceso, 
			sp.iddevolucion,td.nombre_tipo_documento
	        FROM (((signot_proceso sp LEFT JOIN pa_juzgado pj ON sp.idjuzgadoorigen = pj.id)
            LEFT JOIN signot_pa_clase_proceso pc ON sp.idclaseproceso = pc.id)
			LEFT JOIN pa_tipodocumento td ON sp.iddevolucion = td.id)
            WHERE sp.radicado = '$id'";
			
	
	
			
			
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
		$datos4b = $fila["nombre_tipo_documento"];
		
		
		$cadena .= $datos0."//////".$datos1."//////".$datos2."//////".$datos3."//////".$datos2b."//////".$datos3b."//////".$datos4."//////".$datos4b;
		
   	}
	
	/*$sql_2 = "SELECT pa.cedula,pa.nombre,sd.direccion,sd.telefono,cp.descripcion AS clasificacion,d.descripcion AS departamento,m.descripcion AS municipio
			  FROM ((((((signot_proceso sp INNER JOIN signot_parteproceso pp ON sp.id = pp.idproceso)
			  INNER JOIN signot_parte pa ON pa.id = pp.idparte)
			  INNER JOIN signot_direccion sd ON sd.idparte = pa.id)
			  INNER JOIN signot_clasificacion_parte cp ON cp.id = pp.idclaseparte)
			  INNER JOIN signot_pa_departamento d ON d.Cod_departamento = sd.iddepartamento)
			  INNER JOIN signot_pa_municipio m ON m.Cod_Municipio = sd.idmunicipio)
			  WHERE sp.radicado = '$id'
			  GROUP BY pa.cedula
			  ORDER BY pa.nombre";*/
			 
	
	//NOTA : SE REALIZA ESTE CAMBIO DE SQL YA QUE SOLO NECESITO VISUALIZAR LA CEDULA NOMBRE Y CLASIFICACION PARTE
	//POR QUE SI UNA PARTE TIENE MAS DE UNA DIRECCION ME CARGA REGISTROS REPETIDOS EN LA TABLA PARTES DEL PROCESO 
	//DE LA VISTA signot_modificar_proceso.php
	
	/*$sql_2 = "SELECT pa.cedula,pa.nombre,cp.descripcion AS clasificacion
			  FROM (((signot_proceso sp INNER JOIN signot_parteproceso pp ON sp.id = pp.idproceso)
			  INNER JOIN signot_parte pa ON pa.id = pp.idparte)
			  INNER JOIN signot_clasificacion_parte cp ON cp.id = pp.idclaseparte)
			  WHERE sp.radicado = '$id'
			  ORDER BY pa.nombre";*/
			  
	/*$sql_2 = "SELECT pa.cedula,pa.nombre,cp.descripcion AS clasificacion, dir.direccion
			  FROM ((((signot_proceso sp INNER JOIN signot_parteproceso pp ON sp.id = pp.idproceso)
			  INNER JOIN signot_parte pa ON pa.id = pp.idparte)
			  INNER JOIN signot_clasificacion_parte cp ON cp.id = pp.idclaseparte)
			  INNER JOIN signot_direccion dir ON dir.idproceso = pp.idproceso AND dir.idparte = pa.id)
			  WHERE sp.radicado = '$id'
			  ORDER BY pa.nombre";*/
	
	//NOTA: LA DIFERENCIA CON traer_datos_proceso_2.php ES QUE EN DICHO CODIGO LA $sql_2
	//CONTIENE GROUP BY cp.descripcion,pa.cedula PARA QUE UNA PARTE NO SALGA REPETIDA SI TIENE VARIAS DIRECCIONES
	//EN LA VISTA signot_modificar_proceso, EN CAMBIO EN documentos_generar.php SI SE NECESITA QUE TRAIGA TODAS LAS PARTES
	//CON SUS DIRECCIONES PARA PODER CREAR LAS CITACIONES.
	/*$sql_2 = "SELECT pa.id,pa.cedula,pa.nombre,cp.descripcion AS clasificacion, dir.direccion, 
	          dep.descripcion AS departamento, muni.descripcion AS municipio
			  FROM ((((((signot_proceso sp INNER JOIN signot_parteproceso pp ON sp.id = pp.idproceso)
			  INNER JOIN signot_parte pa ON pa.id = pp.idparte)
			  INNER JOIN signot_clasificacion_parte cp ON cp.id = pp.idclaseparte)
			  INNER JOIN signot_direccion dir ON dir.idproceso = pp.idproceso AND dir.idparte = pa.id)
			  INNER JOIN signot_pa_departamento dep ON dep.Cod_departamento = dir.iddepartamento)
			  INNER JOIN signot_pa_municipio muni ON muni.Cod_Municipio = dir.idmunicipio)
			  WHERE sp.radicado = '$id'
			  ORDER BY pa.nombre";*/
			  
			  
	
	$sql_2 = "SELECT pa.id,pa.cedula,pa.nombre,cp.descripcion AS clasificacion,
	          dir.id AS iddir,dir.direccion,dir.endevolucion AS devolucion,  
	          dep.descripcion AS departamento, muni.descripcion AS municipio,pp.endevolucion,pp.idclaseparte,dir.estadodir
			  FROM ((((((signot_proceso sp LEFT JOIN signot_parteproceso pp ON sp.id = pp.idproceso)
			  LEFT JOIN signot_parte pa ON pa.id = pp.idparte)
			  LEFT JOIN signot_clasificacion_parte cp ON cp.id = pp.idclaseparte)
			  LEFT JOIN signot_direccion dir ON dir.idproceso = pp.idproceso AND dir.idparte = pa.id)
			  LEFT JOIN signot_pa_departamento dep ON dep.Cod_departamento = dir.iddepartamento)
			  LEFT JOIN signot_pa_municipio muni ON muni.Cod_Municipio = dir.idmunicipio)
			  WHERE sp.radicado = '$id'
			  ORDER BY pa.id";
			  
			  
	
	

	
	$resultado = mysql_query($sql_2);
	
   	while($fila = mysql_fetch_array($resultado)){
	
		//echo $fila['numero'];
		
		$datost0  = $fila["cedula"];
		$datost1  = $fila["nombre"];
		$datost2  = $fila["direccion"];
		$datost3  = $fila["telefono"];
		$datost4  = $fila["clasificacion"];
		$datost5  = $fila["departamento"];
		$datost6  = $fila["municipio"];
		$datost7  = $fila["id"];
		$datost8  = $fila["endevolucion"];
		$datost9  = $fila["idclaseparte"];
		$datost10 = $fila["iddir"];
		$datost11 = $fila["devolucion"];
		$datost12 = $fila["estadodir"];
		
		$cadena2 .= $datost0."//////".$datost1."//////".$datost2."//////".$datost3."//////".$datost4."//////".$datost5."//////".$datost6."//////".$datost7."//////".$datost8.
		            "//////".$datost9."//////".$datost10."//////".$datost11."//////".$datost12."------";
		
   	}
	
	/*$sql3 = "SELECT spo.fechaob,spo.observacion
			 FROM (signot_proceso sp INNER JOIN signot_proceso_observacion spo ON sp.id = spo.idradicado)
			 WHERE sp.radicado = '$id'
			 ORDER BY spo.id DESC";*/
			 
	$sql3 = "SELECT spo.fechaob,spo.observacion
			 FROM (signot_proceso sp LEFT JOIN signot_proceso_observacion spo ON sp.id = spo.idradicado)
			 WHERE sp.radicado = '$id'
			 ORDER BY spo.id DESC";
			 
	
	$resultado = mysql_query($sql3);
	
   	while($fila = mysql_fetch_array($resultado)){
	
		//echo $fila['numero'];
		
		$datoso0  = $fila["fechaob"];
		$datoso1  = $fila["observacion"];
		
		$cadena3 .= $datoso0."//////".$datoso1."------";
		
   	}
	
	echo trim(utf8_encode($cadena."******".$cadena2."******".$cadena3));

	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	