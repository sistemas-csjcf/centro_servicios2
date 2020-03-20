<?php

	require_once('../libs/Conexion_Funciones.php');

	$cadena   = "";
	
	$id		      = trim($_GET['idvalor']);
	$datoradicado = trim($_GET['datoradicado']);
	
	$conexion = db_connect();
	
	/*$sql = "SELECT td.id,td.cedula,td.nombre,MAX(di.id) AS idmaximo,di.telefono,di.direccion,di.iddepartamento,di.idmunicipio,td.datosadicionales
			FROM (signot_direccion di INNER JOIN signot_parte td ON di.idparte = td.id)
			WHERE di.id IN(
							 SELECT MAX(di.id) AS idmaximo
							 FROM (signot_direccion di INNER JOIN signot_parte td ON di.idparte = td.id)
							 WHERE td.cedula = '$id'
						   )
			AND td.cedula = '$id'";*/
			
	
	/*$sql = "SELECT sp.id AS idparte,sd.id,pro.radicado,sp.cedula,sp.nombre,sp.datosadicionales,
	        sd.telefono,sd.direccion,sd.iddepartamento,spd.descripcion AS departamento,
			sd.idmunicipio,spm.descripcion AS municipio,pro.iddevolucion,td.nombre_tipo_documento
			FROM (((((signot_parte sp LEFT JOIN signot_direccion sd ON sp.id = sd.idparte)
			LEFT JOIN signot_proceso pro ON sd.idproceso = pro.id)
			LEFT JOIN signot_pa_departamento spd ON spd.Cod_departamento = sd.iddepartamento)
			LEFT JOIN signot_pa_municipio spm ON spm.Cod_Municipio = sd.idmunicipio)
			LEFT JOIN pa_tipodocumento td ON pro.iddevolucion = td.id)
			WHERE sp.cedula = '$id' AND pro.radicado = '$datoradicado' ORDER BY sd.id DESC";*/

	
	$sql = "SELECT * FROM signot_parte WHERE cedula = '$id' GROUP BY cedula";
	
	$resultado = mysql_query($sql);
	
   	while($fila = mysql_fetch_array($resultado)){
	
		//echo $fila['numero'];
		
		/*$datos0  = $fila["id"];
		$datos1  = $fila["nombre"];
		$datos2  = $fila["telefono"];
		$datos3  = $fila["direccion"];
		$datos4  = $fila["iddepartamento"];
		$datos5  = $fila["idmunicipio"];
		$datos6  = $fila["datosadicionales"];*/
		
		/*$datos0  = $fila["idparte"];
		$datos1  = $fila["nombre"];
		$datos2  = $fila["telefono"];
		$datos3  = $fila["direccion"];
		$datos4  = $fila["iddepartamento"];
		$datos5  = $fila["idmunicipio"];
		$datos6  = $fila["datosadicionales"];*/
		
		
		//$cadena .= $datos0."//////".$datos1."//////".$datos2."//////".$datos3."//////".$datos4."//////".$datos5."//////".$datos6;
		
		
		$datos0  = $fila["id"];
		$datos1  = $fila["cedula"];
		$datos2  = $fila["nombre"];
		$datos3  = $fila["datosadicionales"];
		
		$cadena .= $datos0."//////".$datos1."//////".$datos2."//////".$datos3;
		
   	}
	
	echo trim(utf8_encode($cadena));

	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	