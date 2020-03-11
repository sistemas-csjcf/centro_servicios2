<?php

	require_once('../libs/Conexion_Funciones.php');

	$cadena   = "";
	
	$id		= trim($_GET['idvalor']);
	
	$conexion = db_connect();
	
	/*$sql = "SELECT sp.id AS idparte,sd.id,sp.cedula,sp.nombre,sd.telefono,sd.direccion,spd.descripcion AS departamento,spm.descripcion AS municipio
			FROM (((signot_parte sp INNER JOIN signot_direccion sd ON sp.id = sd.idparte)
			INNER JOIN signot_pa_departamento spd ON spd.Cod_departamento = sd.iddepartamento)
			INNER JOIN signot_pa_municipio spm ON spm.Cod_Municipio = sd.idmunicipio)
			WHERE sp.cedula = '$id'";*/
			
	
	$sql = "SELECT sp.id AS idparte,sd.id,pro.radicado,sp.cedula,sp.nombre,sd.telefono,sd.direccion,spd.descripcion AS departamento,
			spm.descripcion AS municipio,pro.iddevolucion,td.nombre_tipo_documento,sp.datosadicionales
			FROM (((((signot_parte sp LEFT JOIN signot_direccion sd ON sp.id = sd.idparte)
			LEFT JOIN signot_proceso pro ON sd.idproceso = pro.id)
			LEFT JOIN signot_pa_departamento spd ON spd.Cod_departamento = sd.iddepartamento)
			LEFT JOIN signot_pa_municipio spm ON spm.Cod_Municipio = sd.idmunicipio)
			LEFT JOIN pa_tipodocumento td ON pro.iddevolucion = td.id)
			WHERE sp.cedula = '$id'";

	
	$resultado = mysql_query($sql);
	
   	while($fila = mysql_fetch_array($resultado)){
	
		//echo $fila['numero'];
		
		$datos0  = $fila["idparte"];
		$datos1  = $fila["id"];
		$datos2  = $fila["cedula"];
		$datos3  = $fila["nombre"];
		$datos4  = $fila["telefono"];
		$datos5  = $fila["direccion"];
		$datos6  = $fila["departamento"];
		$datos7  = $fila["municipio"];
		$datos8  = $fila["radicado"];
		$datos9  = $fila["iddevolucion"];
		$datos10 = $fila["nombre_tipo_documento"];
		$datos11 = $fila["datosadicionales"];
		
		
		$cadena .= $datos0."//////".$datos1."//////".$datos2."//////".$datos3."//////".$datos4."//////".$datos5."//////".$datos6."//////".$datos7."//////".$datos8."//////".$datos9."//////".$datos10."//////".$datos11."******";
		
   	}
	
	echo trim(utf8_encode($cadena));

	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	