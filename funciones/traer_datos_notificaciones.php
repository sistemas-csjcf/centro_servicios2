<?php

	require_once('../libs/Conexion_Funciones.php');

	$cadena   = "";
	$cadena2  = "";
	
	$id		= trim($_GET['idvalor']);
	
	$conexion = db_connect();
	
	$sql = "SELECT sp.id,sp.radicado,pj.nombre AS nombrejuzgado,pc.nombre_proceso AS nombreproceso 
	        FROM ((signot_proceso sp INNER JOIN pa_juzgado pj ON sp.idjuzgadoorigen = pj.id)
            INNER JOIN signot_pa_clase_proceso pc ON sp.idclaseproceso = pc.id)
            WHERE sp.radicado = '$id'";

	
	$resultado = mysql_query($sql);
	
   	while($fila = mysql_fetch_array($resultado)){
	
		//echo $fila['numero'];
		
		$datos0  = $fila["id"];
		$datos1  = $fila["radicado"];
		$datos2  = $fila["nombrejuzgado"];
		$datos3  = $fila["nombreproceso"];
		
		$cadena .= $datos0."//////".$datos1."//////".$datos2."//////".$datos3;
		
   	}
	
	/*$sql_2 = "SELECT pa.cedula,pa.nombre,sd.direccion,sd.telefono,cp.descripcion AS clasificacion,d.descripcion AS departamento,m.descripcion AS municipio
			  FROM ((((((signot_proceso sp INNER JOIN signot_parteproceso pp ON sp.id = pp.idproceso)
			  INNER JOIN signot_parte pa ON pa.id = pp.idparte)
			  INNER JOIN signot_direccion sd ON sd.idparte = pa.id)
			  INNER JOIN signot_clasificacion_parte cp ON cp.id = pp.idclaseparte)
			  INNER JOIN signot_pa_departamento d ON d.Cod_departamento = sd.iddepartamento)
			  INNER JOIN signot_pa_municipio m ON m.Cod_Municipio = sd.idmunicipio)
			  WHERE sp.radicado = '$id' AND pp.idclaseparte = 2
			  ORDER BY pa.nombre";*/
				//AND pp.idclaseparte = 2
				
	$sql_2 = "SELECT ap.id,sp.cedula,sp.nombre,p.radicado,pj.nombre AS juzgado,
			  spa.nombre_tipo_etapa_proceso AS auto,ap.fecharegistroauto,ap.fechaauto,
			  d.direccion,d.telefono,dep.descripcion AS departamento,m.descripcion AS municipio,ap.descorrecion,
			  ap.idautocorrige
			  FROM ((((((((signot_auto_parte ap INNER JOIN signot_proceso p ON ap.idproceso = p.id)
			  INNER JOIN signot_parte sp ON ap.idparte = sp.id)
			  INNER JOIN pa_juzgado pj ON pj.id = p.idjuzgadoorigen)
			  INNER JOIN pa_area pa ON pj.idarea = pa.id)
			  INNER JOIN signot_pa_etapa_procesal spa ON spa.id = ap.idauto)
			  INNER JOIN signot_direccion d ON d.idparte = ap.idparte AND d.idproceso = p.id)
			  INNER JOIN signot_pa_departamento dep ON dep.Cod_departamento = d.iddepartamento)
			  INNER JOIN signot_pa_municipio m ON m.Cod_Municipio = d.idmunicipio)
			  WHERE p.radicado = '$id' 
			  ORDER BY ap.id DESC";
	
	$resultado = mysql_query($sql_2);
	
   	while($fila = mysql_fetch_array($resultado)){
	
		//echo $fila['numero'];
		
		/*$datost0  = $fila["cedula"];
		$datost1  = $fila["nombre"];
		$datost2  = $fila["direccion"];
		$datost3  = $fila["telefono"];
		$datost4  = $fila["clasificacion"];
		$datost5  = $fila["departamento"];
		$datost6  = $fila["municipio"];*/
		
	  
		$datost0   = $fila["id"];
		$datost1   = $fila["cedula"];
		$datost2   = $fila["nombre"];
		$datost3   = $fila["radicado"];
		$datost4   = $fila["juzgado"];
		$datost5   = $fila["auto"];
		$datost6   = $fila["fecharegistroauto"];
		$datost7   = $fila["fechaauto"];
		
		$datost8   = $fila["direccion"];
		$datost9   = $fila["telefono"];
		$datost10  = $fila["departamento"];
		$datost11  = $fila["municipio"];
		
		$datost12  = $fila["descorrecion"];
		
		$datost13  = $fila["idautocorrige"];
		

		$cadena2 .= $datost0."//////".$datost1."//////".$datost2."//////".$datost3."//////".$datost4."//////".$datost5."//////".$datost6."//////".$datost7."//////".$datost8."//////".$datost9."//////".$datost10."//////".$datost11."//////".$datost12."//////".$datost13."------";
		
   	}
	
	echo trim($cadena."******".$cadena2);

	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	