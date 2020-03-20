<?php

session_start(); 

if($_SESSION['id']!=""){

	require_once('../libs/Conexion_Funciones.php');

	$id		 = trim($_GET['id']);
	$idsql	 = trim($_GET['idsql']);
	
	$conexion = db_connect();
	
	if($idsql == 1){
		
		
		$sql = "SELECT td.id,td.nombre_tipo_documento
				FROM (pa_tipodocumento td INNER JOIN pa_documento pd ON td.iddocumento = pd.id)
				WHERE pd.id = '$id'
				ORDER BY td.nombre_tipo_documento";
				
		echo '<option value="">Seleccionar Tipo Documento</option>';
	
	}
	
	$resultado = mysql_query($sql);
	
   	while($fila = mysql_fetch_array($resultado)){
	
		if($idsql == 1){
			
			echo '<option value="'.trim($fila['id']).'">'.$fila['nombre_tipo_documento'].'</option>';
		}
		
		
		
		
   	}
	
	mysql_close($conexion);

}
	
?>
   

	

	
	