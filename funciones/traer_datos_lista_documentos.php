<?php
	session_start(); 
	if($_SESSION['id']!=""){
		require_once('../libs/Conexion_Funciones.php');
		$id		= trim($_GET['id']);
		$idsql	= trim($_GET['idsql']);
		
		$idusuario  = $_SESSION['idUsuario'];
		
		$conexion = db_connect();
		if($idsql == 1){
			$sql = "SELECT * FROM pa_tipodocumento WHERE iddocumento = '$id' AND flag=1 ORDER BY nombre_tipo_documento";
			echo '<option value="">Seleccionar Tipo Documento</option>';
		}
		$resultado = mysql_query($sql);
	   	while($fila = mysql_fetch_array($resultado)){
			if($idsql == 1){
				echo utf8_encode('<option value="'.trim($fila['id']).'">'.$fila['nombre_tipo_documento'].'</option>');
			}
	   	}
		mysql_close($conexion);
	}
?>