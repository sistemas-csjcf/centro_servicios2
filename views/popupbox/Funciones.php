<?php
//session_start();
include_once('Conexionpopupbox.php');

class Funciones {
	
	//////////////////////////////////////////////////// 
	//Convierte fecha de mysql a normal 
	//////////////////////////////////////////////////// 
	function cambiaf_a_normal($fecha){ 
    	ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha); 
    	$lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
    	return $lafecha; 
	} 
	//////////////////////////////////////////////////// 
	//Convierte fecha de normal a mysql 
	//////////////////////////////////////////////////// 
	function cambiaf_a_mysql($fecha){ 
    	ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha); 
    	$lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1]; 
    	return $lafecha; 
	}
	//////////////////////////////////////////////////// 
	//RECIBE UNA HORA Y CREA UN VECTOR EN $hora_real A PARTIR DE LOS DOS : 
	// Y TOMA LA CERO(0) POSICION EN $he_user2 Y LE RESTA 1
	//Y EN $he_user_real CONCATENO EL RESULTADO EN $he_user2 Y LA PRIMERA(1) POSICION EN $hora_real
	//////////////////////////////////////////////////// 
	function hora_real_del_sistema($hora_real){
		$hora_real = split(":",$hora_real);
		$he_user2=((int)$hora_real[0])-1;
		$he_user_real=$he_user2.":".$hora_real[1];
		return $he_user_real;
	}
	////////////////////////////////////////////////////
	//ME PERMITE CARGAR UN COMBO CON LOS DATOS ESPECIFICOS
	//RECIBIDOS EN LA FUNCION 
	//////////////////////////////////////////////////// 
	function cargar_lista($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_a_ordenar){
	
		$link = db_connect($dbdefault_dbname);
		$query = "SELECT * FROM"." ".$nombre_tabla." "."ORDER BY"." ".$campo_a_ordenar;
		//$query = "SELECT * FROM"." ".$nombre_tabla." "."GROUP BY"." ".$campo_a_ordenar;
		$result= mysql_query($query);

		while($query_data = mysql_fetch_array($result)){

			echo "<option value=\"". $query_data[$campo_a_insertar] ."\">" . $query_data[$campo_a_mostrar] . "</option>";
		}
		mysql_free_result($result);
		mysql_close($link);
	}
	////////////////////////////////////////////////////
	//ME PERMITE CARGAR UN COMBO UTILIZANDO FILTRO 
	//CON LOS DATOS ESPECIFICOS RECIBIDOS EN LA FUNCION 
	//////////////////////////////////////////////////// 
	function cargar_lista_con_filtro($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar){

		$link = db_connect($dbdefault_dbname);
		$query = "SELECT * FROM ".$nombre_tabla." WHERE ".$campo_filtro. "= ".$valor_filtro." ORDER BY ".$campo_a_ordenar;
		
		$result= mysql_query($query);

		while($query_data = mysql_fetch_array($result)){

			echo "<option value=\"". $query_data[$campo_a_insertar] ."\">" . $query_data[$campo_a_mostrar] . "</option>";
		}
		mysql_free_result($result);
		mysql_close($link);
	}
	
	////////////////////////////////////////////////////
	//ME PERMITE CARGAR UN COMBO UTILIZANDO FILTRO 
	//CON LOS DATOS ESPECIFICOS RECIBIDOS EN LA FUNCION 
	//////////////////////////////////////////////////// 
	function cargar_lista_con_filtro_general($sql){

		$link = db_connect($dbdefault_dbname);
		$query = $sql;
		
		$result= mysql_query($query);

		while($query_data = mysql_fetch_array($result)){

			//echo "<option value=\"". $query_data[$campo_a_insertar] ."\">" . $query_data[$campo_a_mostrar] . "</option>";
			
			echo "<option value=\"". $query_data[id].", CEDULA: ".$query_data[cedula].", NOMBRE: ".$query_data[nombre] ."\">" . $query_data[nombre] . "</option>";
		}
		mysql_free_result($result);
		mysql_close($link);
	}
	
	function get_idradicado($id){
	
		
		$link = db_connect($dbdefault_dbname);
	
	
		$query = "SELECT pr.id,pr.radicado
				  FROM (documentos_internos di INNER JOIN signot_proceso pr ON di.idradicado = pr.id)
                  WHERE di.id = '$id'";
				  
		$sql = mysql_query($query);
		$row = mysql_fetch_array($sql);
		
		if(!$row){
			return;
		}
		else{
		
			$DATO = $row[id]."//////".$row[radicado];
			return $DATO;
		}
		mysql_close($link);
		
	}
	
	function get_idradicado_2($id){
	
		
		$link = db_connect($dbdefault_dbname);
	
	
		$query = "SELECT * FROM signot_proceso WHERE id = '$id'";
				  
		$sql = mysql_query($query);
		$row = mysql_fetch_array($sql);
		
		if(!$row){
			return;
		}
		else{
		
			$DATO = $row[id]."//////".$row[radicado];
			return $DATO;
		}
		mysql_close($link);
		
	}
	
	function get_datos_proceso_anotacion_2($id,$idnom){
	
	
		$link = db_connect($dbdefault_dbname);
	
	
		$query = "SELECT spa.id,spa.idradicado,pu.empleado,spa.fecha,spa.hora,spa.anotacion,ta.destipo
				  FROM ((signot_proceso_anotacion spa INNER JOIN pa_usuario pu ON spa.idusuario = pu.id)
				  LEFT JOIN signot_pa_tipo_anotacion ta ON ta.id = spa.idtipoanotacion)
				  WHERE spa.idradicado = '$id' AND spa.anotacion LIKE '%$idnom%' AND (spa.anotacion LIKE '%Devolucion%' OR ta.destipo LIKE '%Devolucion%')
				  ORDER BY spa.id DESC";
				  
		$sql = mysql_query($query);
		//$row = mysql_fetch_array($sql);

		while($row = mysql_fetch_array($sql)){

			$registros.= $row[id]."//////".$row[fecha]."//////".$row[hora]."//////".$row[empleado]."//////".$row[destipo]."//////".$row[anotacion]."******";
			
		}
		
		mysql_free_result($sql);
		mysql_close($link);
		
		return $registros;
	
	}
	
	function get_direcciones_parte($idprocesox,$idparte,$idsql){
	
		
		$link = db_connect($dbdefault_dbname);
	
		//$query = "SELECT * FROM radicador_correspondencia_v1 WHERE idradicado = '$idprocesox'";
		
		if($idsql == 1){
			
			$query = "SELECT t1.id,t1.idparte,t1.idproceso,t1.direccion,t2.descripcion AS departamento,t3.descripcion AS municipio,t1.estadodir
					  FROM ((signot_direccion t1 INNER JOIN signot_pa_departamento t2 ON t1.iddepartamento = t2.Cod_departamento)
                      INNER JOIN signot_pa_municipio t3 ON t1.idmunicipio = t3.Cod_Municipio)
                      WHERE idparte = '$idparte' AND idproceso = '$idprocesox'
                      ORDER BY t1.id DESC";
					  
		}
		
		
				  
		$sql = mysql_query($query);
		//$row = mysql_fetch_array($sql);
		
		while($fila = mysql_fetch_array($sql)){
		
			
			if($idsql == 1){
			
				$d0 = $fila[id];
				$d1 = $fila[idparte];
				$d2 = $fila[idproceso];
				$d3 = $fila[direccion];
				$d4 = $fila[departamento];
				$d5 = $fila[municipio];
				$d6 = $fila[estadodir];
				
			
				$DATOC .= $d0."------".$d1."------".$d2."------".$d3."------".$d4."------".$d5."------".$d6."*/-*/-";
				
			}
			

		}
		

		mysql_free_result($sql);
		mysql_close($link);
		
		return $DATOC;
		
	}

//-----------------------------------------------------------------------
}//FIN CLASE
?>
