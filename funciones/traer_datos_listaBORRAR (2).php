<?php

session_start(); 

if($_SESSION['id']!=""){

	require_once('../libs/Conexion_Funciones.php');

	$id		 = trim($_GET['id']);
	$idsql	 = trim($_GET['idsql']);
	$idparte = trim($_GET['idparte']);
	
	$idusuario  = $_SESSION['idUsuario'];
	
	$conexion = db_connect();
	
	if($idsql == 1){
		
		/*$sql = "SELECT spa.id,spa.nombre_proceso
				FROM ((pa_juzgado pj INNER JOIN pa_area pa ON pj.idarea = pa.id)
				INNER JOIN signot_pa_clase_proceso spa ON spa.id_area = pa.id)
				WHERE pj.id = '$id'
				ORDER BY spa.nombre_proceso";*/

		$sql = "SELECT spa.id,spa.nombre_proceso
				FROM ((pa_juzgado pj
				INNER JOIN signot_pa_juzgado_clase_proceso pajc ON pj.id = pajc.idjuzgado)
				INNER JOIN signot_pa_clase_proceso spa ON spa.id = pajc.idclaseproceso)
				WHERE pj.id = '$id'
				ORDER BY spa.nombre_proceso";
				
		echo '<option value="">Seleccionar Clase Proceso</option>';
	}
	
	if($idsql == 2){
		
		$sql = "SELECT * FROM signot_pa_municipio
				WHERE Cod_Departamento_Municipio = '$id'
				ORDER BY descripcion";
				
		echo '<option value="">Seleccionar Municipio</option>';
	}
	
	if($idsql == 3){
	
		$parametro = "idmunicipio";
		
		$sql_1 = "SELECT td.id,td.cedula,td.nombre,MAX(di.id) AS idmaximo,di.telefono,di.direccion,di.iddepartamento,di.idmunicipio
				  FROM (signot_direccion di INNER JOIN signot_parte td ON di.idparte = td.id)
				  WHERE di.id IN(
								 SELECT MAX(di.id) AS idmaximo
								 FROM (signot_direccion di INNER JOIN signot_parte td ON di.idparte = td.id)
								 WHERE td.id = '$idparte'
							   )
				  AND td.id = '$idparte'";
	
		
		
		$sql = "SELECT * FROM signot_pa_municipio
				WHERE Cod_Departamento_Municipio = '$id'
				ORDER BY descripcion";
				
		echo '<option value="">Seleccionar Municipio</option>';
	}
	
	if($idsql == 4){
		
		/*$sql = "SELECT spa.id,spa.nombre_tipo_etapa_proceso
				FROM ((pa_juzgado pj INNER JOIN pa_area pa ON pj.idarea = pa.id)
				INNER JOIN signot_pa_etapa_procesal spa ON spa.id_area = pa.id)
				WHERE pj.id = '$id'
				ORDER BY spa.nombre_tipo_etapa_proceso";*/
				
		$sql = "SELECT spa.id,spa.nombre_tipo_etapa_proceso
				FROM ((signot_pa_clase_proceso cp INNER JOIN signot_pa_clase_proceso_auto cpa ON cp.id = cpa.idproceso)
				INNER JOIN signot_pa_etapa_procesal spa ON spa.id = cpa.idauto)
				WHERE cp.id = '$id'
				ORDER BY spa.nombre_tipo_etapa_proceso";
				
		echo '<option value="">Seleccionar Auto a Notificar</option>';
	}
	
	if($idsql == 5){
	
		
		$parametro = "idjuzgado";
		
		$sql_1 = "SELECT sp.id,sp.radicado,pj.nombre AS nombrejuzgado,pj.id AS idjuzgado,pc.nombre_proceso AS nombreproceso,pc.id AS idclaseproceso
				  FROM ((signot_proceso sp INNER JOIN pa_juzgado pj ON sp.idjuzgadoorigen = pj.id)
				  INNER JOIN signot_pa_clase_proceso pc ON sp.idclaseproceso = pc.id)
				  WHERE sp.radicado = '$idparte'";
	
		
		
		$sql = "SELECT * FROM pa_juzgado ORDER BY id";
				
		echo '<option value="">Seleccionar Juzgado</option>';
	}
	
	if($idsql == 6){
	
		
		$parametro = "idclaseproceso";
		
		$sql_1 = "SELECT sp.id,sp.radicado,pj.nombre AS nombrejuzgado,pj.id AS idjuzgado,pc.nombre_proceso AS nombreproceso,pc.id AS idclaseproceso
				  FROM ((signot_proceso sp INNER JOIN pa_juzgado pj ON sp.idjuzgadoorigen = pj.id)
				  INNER JOIN signot_pa_clase_proceso pc ON sp.idclaseproceso = pc.id)
				  WHERE sp.radicado = '$idparte'";
	
		
		
		$sql = "SELECT * FROM signot_pa_clase_proceso ORDER BY nombre_proceso";
				
		echo '<option value="">Seleccionar Clase Proceso</option>';
	}
	
	if($idsql == 7){
		
		
		$sql = "SELECT * FROM signot_clasificacion_parte WHERE idclaseproceso = $id	";
				
		echo '<option value="">Seleccionar Clasificacion Parte</option>';
	}
	
	
	$resultado = mysql_query($sql);
	
	//CAPTURO EL ID DEL $parametro
	//PARA SELECCIONARLO EN LA LISTA
	$resultado_1 = mysql_query($sql_1);
	while($fila_1 = mysql_fetch_array($resultado_1)){
		
		$datos5  = $fila_1[$parametro];
		
	}
	

   	while($fila = mysql_fetch_array($resultado)){
	
		if($idsql == 1){
			
			echo '<option value="'.trim($fila['id']).'">'.$fila['nombre_proceso'].'</option>';
		}
		
		if($idsql == 2){
			
			echo '<option value="'.trim($fila['Cod_Municipio']).'">'.$fila['descripcion'].'</option>';
		}
		
		if($idsql == 3){
		
		
			if(trim($fila['Cod_Municipio']) == $datos5){
				
				
				echo '<option value="'.trim($fila['Cod_Municipio']).'" selected="selected">'.$fila['descripcion'].'</option>';
				
			}
			else{
				
				echo '<option value="'.trim($fila['Cod_Municipio']).'">'.$fila['descripcion'].'</option>';
			}
			
			
		}
		
		if($idsql == 4){
			
			echo '<option value="'.trim($fila['id']).'">'.$fila['nombre_tipo_etapa_proceso'].'</option>';
		}
		
		if($idsql == 5){
		
		
			if(trim($fila['id']) == $datos5){
				
				
				echo '<option value="'.trim($fila['id'])."-".$fila['idarea']."-".$fila['numero_juzgado'].'" selected="selected">'.$fila['nombre'].'</option>';
				
			}
			else{
				
				echo '<option value="'.trim($fila['id'])."-".$fila['idarea']."-".$fila['numero_juzgado'].'">'.$fila['nombre'].'</option>';
			}
			
			
			
			
		}
		
		if($idsql == 6){
		
		
			if(trim($fila['id']) == $datos5){
				
				
				echo '<option value="'.trim($fila['id']).'" selected="selected">'.$fila['nombre_proceso'].'</option>';
				
			}
			else{
				
				echo '<option value="'.trim($fila['id']).'">'.$fila['nombre_proceso'].'</option>';
			}
			
			
		}
		
		if($idsql == 7){
			
			echo '<option value="'.trim($fila['id']).'">'.$fila['descripcion'].'</option>';
		}
		
   	}
	
	mysql_close($conexion);

}
	
?>
   

	

	
	