<?php
class estadisticaexcelModel extends modelBase{

	
	
	public function get_informacion_reporte($identrada,$tiporepor){
	
	
		$idusuario  = $_SESSION['idUsuario'];
		
		if($identrada == 1){
			
			//PROCESOS ACTIVOS
			if($tiporepor == 1){
				
				$sql = "SELECT * FROM signot_proceso WHERE iddevolucion = 0";
			}
			
			//PROCESOS DESACTIVADOS
			if($tiporepor == 2){
				
				$sql = "SELECT * FROM signot_proceso WHERE iddevolucion = 1";
			}
			
		  	
			
			$listar     = $this->db->prepare($sql);
											 
											 
			
		}
		if($identrada == 2){
			
			$filtrox;
			
			$filtrof;
			$filtro1;
			
			
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$datox1    = trim($_GET['datox1']);
			
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtrof = " AND (sp.fecharegistro >= '$fechad' AND sp.fecharegistro <= '$fechah') ";
				
			
			}
			if ( !empty($datox1) ) {
			
				//$filtro1 = " AND sp.radicado = '$datox1' ";
				$filtro1 = " AND sp.radicado LIKE '%$datox1%' ";
			
			}
			
			
	
			$filtrox = $filtro1." ".$filtrof;
			
			//echo $filtrox;
			  
		 	//PROCESOS DESACTIVOS
			if($tiporepor == 1){
				
	
				$sql = "SELECT * FROM signot_proceso sp
					    WHERE sp.id >= '1'" .$filtrox. " AND iddevolucion = 0
					    ORDER BY sp.radicado";
			}
			
			//PROCESOS DESACTIVADOS
			if($tiporepor == 2){
				
				$sql = "SELECT * FROM signot_proceso sp
					    WHERE sp.id >= '1'" .$filtrox. " AND iddevolucion = 1
					    ORDER BY sp.radicado";
			}
			
					
					
			$listar     = $this->db->prepare($sql);
					
		}

  		$listar->execute();

  		return $listar;
	
  	}
	
	
	//-------------------------------------------------------------------------------------------------------------
	
	public function get_documentos_2($identrada,$idsql){
	
	
		$idusuario  = $_SESSION['idUsuario'];
		
		if($identrada == 1){
		
			//LISTA TODOS LOS DOCUMENTOS (SI ESTE USUARIO TIENE PERMISO EN LA TABLA pa_usuario_acciones)  
			if ($idsql == 1){
			
				$sql = "SELECT rds.id,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.direccion,rds.ciudad,
						rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
						ubi.idjuzgado,jo.nombre AS juzorigen,do.nombre_documento AS documento, ubi.radicado
						FROM (((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
						LEFT JOIN pa_documento do ON td.iddocumento = do.id)
						LEFT JOIN pa_dirigido d ON rds.dirigidoa = d.id)
						LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
						LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
						LEFT JOIN ubicacion_expediente ubi ON rds.idradicado = ubi.id)
						LEFT JOIN pa_juzgado jo ON ubi.idjuzgado = jo.id)
						ORDER BY rds.numero";
			
			}
			
			//LISTA SOLO LOS DOCUMENTOS DEL USUARIO EN SESION
			if ($idsql == 0){
			
				$sql = "SELECT rds.id,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.direccion,rds.ciudad,
						rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
						ubi.idjuzgado,jo.nombre AS juzorigen,do.nombre_documento AS documento, ubi.radicado
						FROM (((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
						LEFT JOIN pa_documento do ON td.iddocumento = do.id)
						LEFT JOIN pa_dirigido d ON rds.dirigidoa = d.id)
						LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
						LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
						LEFT JOIN ubicacion_expediente ubi ON rds.idradicado = ubi.id)
						LEFT JOIN pa_juzgado jo ON ubi.idjuzgado = jo.id)
						WHERE rds.idusuario = '$idusuario'
						ORDER BY rds.numero";
			
			}
		  	
			
			$listar     = $this->db->prepare($sql);
											 
											 
			
		}
		if($identrada == 2){
			
			$filtrox;
			
			$filtrof;
			$filtro1;
			$filtro2;
			$filtro3;
			$filtro4;
			$filtro5;
			$filtro6;
			$filtro7;
			$filtro8;
			$filtro9;
			$filtro10;
			
			
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$datox1    = trim($_GET['datox1']);
			$datox2    = trim($_GET['datox2']);
			$datox3    = trim($_GET['datox3']);
			$datox4    = trim($_GET['datox4']);
			$datox5    = trim($_GET['datox5']);
			$datox6    = trim($_GET['datox6']);
			$datox7    = trim($_GET['datox7']);
			$datox8    = trim($_GET['datox8']);
			$datox9    = trim($_GET['datox9']);
			$datox10   = trim($_GET['datox10']);
			
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtrof = " AND (rds.fechageneracion >= '$fechad' AND rds.fechageneracion <= '$fechah') ";
				
			
			}
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND rds.idtipodocumento = '$datox1' ";
			
			}
			if ( !empty($datox2) ) {
			
				$filtro2 = " AND rds.numero = '$datox2' ";
			
			}
			if ( !empty($datox3) ) {
			
				$filtro3 = " AND rds.dirigidoa = '$datox3' ";
			
			}
			if ( !empty($datox4) ) {
			
				//$filtro4 = " AND rds.nombre = '$datox4' ";
				$filtro4 = " AND rds.nombre LIKE '%$datox4%' ";
			
			}
			if ( !empty($datox5) ) {
			
				$filtro5 = " AND rds.cargo LIKE '%$datox5%' ";
			
			}
			if ( !empty($datox6) ) {
			
				$filtro6 = " AND rds.dependencia LIKE '%$datox6%' ";
			
			}
			if ( !empty($datox7) ) {
			
				//$filtro8 = " AND rds.asunto = '$datox8' ";
				$filtro7 = " AND rds.asunto LIKE '%$datox7%' ";
			
			}
			if ( !empty($datox8) ) {
			
				$filtro8 = " AND rds.id = '$datox8' ";
			
			}
			if ( !empty($datox9) ) {
			
				$filtro9 = " AND ubi.radicado LIKE '%$datox9%' ";
			
			}
			
	
			//$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtrof;
			
			//echo $filtrox;
			  
		 	
			//LISTA TODOS LOS DOCUMENTOS (SI ESTE USUARIO TIENE PERMISO EN LA TABLA pa_usuario_acciones)  
			if ($idsql == 1){
			
			
				//SI EL USUARIO QUE PUEDE VER TODOS LOS REGISTROS FILTRA POR UN USUARIO ESPECIFICO
			 	if ( !empty($datox10) ) {
			
					$filtro10 = " AND rds.idusuario = '$datox10' ";
					
					$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtro10." ".$filtrof;
			
				}
				else{
					
					$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtrof;
				}
			
				$sql = "SELECT rds.id,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.direccion,rds.ciudad,
						rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
						ubi.idjuzgado,jo.nombre AS juzorigen,do.nombre_documento AS documento, ubi.radicado
						FROM (((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
						LEFT JOIN pa_documento do ON td.iddocumento = do.id)
						LEFT JOIN pa_dirigido d ON rds.dirigidoa = d.id)
						LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
						LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
						LEFT JOIN ubicacion_expediente ubi ON rds.idradicado = ubi.id)
						LEFT JOIN pa_juzgado jo ON ubi.idjuzgado = jo.id)
						WHERE rds.id >= '1'" .$filtrox. " 
						ORDER BY rds.numero";
			
			}
			
			//LISTA SOLO LOS DOCUMENTOS DEL USUARIO EN SESION
			if ($idsql == 0){
			
				$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtrof;
			
				$sql = "SELECT rds.id,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.direccion,rds.ciudad,
						rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
						ubi.idjuzgado,jo.nombre AS juzorigen,do.nombre_documento AS documento, ubi.radicado
						FROM (((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
						LEFT JOIN pa_documento do ON td.iddocumento = do.id)
						LEFT JOIN pa_dirigido d ON rds.dirigidoa = d.id)
						LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
						LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
						LEFT JOIN ubicacion_expediente ubi ON rds.idradicado = ubi.id)
						LEFT JOIN pa_juzgado jo ON ubi.idjuzgado = jo.id)
						WHERE rds.id >= '1'" .$filtrox. " AND rds.idusuario = '$idusuario'
						ORDER BY rds.numero";
			
			}
			
			$listar    = $this->db->prepare($sql);
											
		}

  		$listar->execute();

  		return $listar;
	
  	}
	
	public function get_cantidad_documentos($identrada,$idsql){
	
		$idusuario  = $_SESSION['idUsuario'];
	
		if($identrada == 1){
	
			
			//LISTA TODOS LOS DOCUMENTOS (SI ESTE USUARIO TIENE PERMISO EN LA TABLA pa_usuario_acciones)  
			if ($idsql == 1){
			
				$sql = "SELECT doc.nombre_documento AS documento,COUNT(*) AS cantidad,
										  rds.id,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.direccion,rds.ciudad,
										  rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
										  ubi.idjuzgado,jo.nombre AS juzorigen, ubi.radicado
										  FROM (((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
										  LEFT JOIN pa_documento doc ON td.iddocumento = doc.id)
										  LEFT JOIN pa_dirigido d ON rds.dirigidoa = d.id)
										  LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
										  LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
										  LEFT JOIN ubicacion_expediente ubi ON rds.idradicado = ubi.id)
										  LEFT JOIN pa_juzgado jo ON ubi.idjuzgado = jo.id)
										  GROUP BY doc.id
										  HAVING COUNT(*) >= 1
										  ORDER BY doc.nombre_documento";
			}
	
			//LISTA SOLO LOS DOCUMENTOS DEL USUARIO EN SESION
			if ($idsql == 0){
			
				$sql = "SELECT doc.nombre_documento AS documento,COUNT(*) AS cantidad,
										  rds.id,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.direccion,rds.ciudad,
										  rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
										  ubi.idjuzgado,jo.nombre AS juzorigen, ubi.radicado
										  FROM (((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
										  LEFT JOIN pa_documento doc ON td.iddocumento = doc.id)
										  LEFT JOIN pa_dirigido d ON rds.dirigidoa = d.id)
										  LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
										  LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
										  LEFT JOIN ubicacion_expediente ubi ON rds.idradicado = ubi.id)
										  LEFT JOIN pa_juzgado jo ON ubi.idjuzgado = jo.id)
										  WHERE rds.idusuario = '$idusuario'
										  GROUP BY doc.id
										  HAVING COUNT(*) >= 1
										  ORDER BY doc.nombre_documento";
			}
										  
			$listar = $this->db->prepare($sql);
									  
		}
		
		if($identrada == 2){
			
			$filtrox;
			
			$filtrof;
			$filtro1;
			$filtro2;
			$filtro3;
			$filtro4;
			$filtro5;
			$filtro6;
			$filtro7;
			$filtro8;
			$filtro9;
			$filtro10;
			
			
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$datox1    = trim($_GET['datox1']);
			$datox2    = trim($_GET['datox2']);
			$datox3    = trim($_GET['datox3']);
			$datox4    = trim($_GET['datox4']);
			$datox5    = trim($_GET['datox5']);
			$datox6    = trim($_GET['datox6']);
			$datox7    = trim($_GET['datox7']);
			$datox8    = trim($_GET['datox8']);
			$datox9    = trim($_GET['datox9']);
			$datox10   = trim($_GET['datox10']);
			
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtrof = " AND (rds.fechageneracion >= '$fechad' AND rds.fechageneracion <= '$fechah') ";
				
			
			}
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND rds.idtipodocumento = '$datox1' ";
			
			}
			if ( !empty($datox2) ) {
			
				$filtro2 = " AND rds.numero = '$datox2' ";
			
			}
			if ( !empty($datox3) ) {
			
				$filtro3 = " AND rds.dirigidoa = '$datox3' ";
			
			}
			if ( !empty($datox4) ) {
			
				//$filtro4 = " AND rds.nombre = '$datox4' ";
				$filtro4 = " AND rds.nombre LIKE '%$datox4%' ";
			
			}
			if ( !empty($datox5) ) {
			
				$filtro5 = " AND rds.cargo LIKE '%$datox5%' ";
			
			}
			if ( !empty($datox6) ) {
			
				$filtro6 = " AND rds.dependencia LIKE '%$datox6%' ";
			
			}
			if ( !empty($datox7) ) {
			
				//$filtro8 = " AND rds.asunto = '$datox8' ";
				$filtro7 = " AND rds.asunto LIKE '%$datox7%' ";
			
			}
			if ( !empty($datox8) ) {
			
				$filtro8 = " AND rds.id = '$datox8' ";
			
			}
			if ( !empty($datox9) ) {
			
				$filtro9 = " AND ubi.radicado LIKE '%$datox9%' ";
			
			}
			
	
			
			
			//$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtrof;
			
			//echo $filtrox;
			
			//LISTA TODOS LOS DOCUMENTOS (SI ESTE USUARIO TIENE PERMISO EN LA TABLA pa_usuario_acciones)  
			if ($idsql == 1){
			
				//SI EL USUARIO QUE PUEDE VER TODOS LOS REGISTROS FILTRA POR UN USUARIO ESPECIFICO
			 	if ( !empty($datox10) ) {
			
					$filtro10 = " AND rds.idusuario = '$datox10' ";
					
					$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtro10." ".$filtrof;
			
				}
				else{
					
					$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtrof;
				}
			
				$sql = "SELECT doc.nombre_documento AS documento,COUNT(*) AS cantidad,
										  rds.id,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.direccion,rds.ciudad,
										  rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
										  ubi.idjuzgado,jo.nombre AS juzorigen, ubi.radicado
										  FROM (((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
										  LEFT JOIN pa_documento doc ON td.iddocumento = doc.id)
										  LEFT JOIN pa_dirigido d ON rds.dirigidoa = d.id)
										  LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
										  LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
										  LEFT JOIN ubicacion_expediente ubi ON rds.idradicado = ubi.id)
										  LEFT JOIN pa_juzgado jo ON ubi.idjuzgado = jo.id)
										  WHERE rds.id >= '1'" .$filtrox. " 
										  GROUP BY doc.id
										  HAVING COUNT(*) >= 1
										  ORDER BY doc.nombre_documento";
			}
	
			//LISTA SOLO LOS DOCUMENTOS DEL USUARIO EN SESION
			if ($idsql == 0){
			
				$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtrof;
			
				$sql = "SELECT doc.nombre_documento AS documento,COUNT(*) AS cantidad,
										  rds.id,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.direccion,rds.ciudad,
										  rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
										  ubi.idjuzgado,jo.nombre AS juzorigen, ubi.radicado
										  FROM (((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
										  LEFT JOIN pa_documento doc ON td.iddocumento = doc.id)
										  LEFT JOIN pa_dirigido d ON rds.dirigidoa = d.id)
										  LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
										  LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
										  LEFT JOIN ubicacion_expediente ubi ON rds.idradicado = ubi.id)
										  LEFT JOIN pa_juzgado jo ON ubi.idjuzgado = jo.id)
										  WHERE rds.id >= '1'" .$filtrox. " AND rds.idusuario = '$idusuario'
										  GROUP BY doc.id
										  HAVING COUNT(*) >= 1
										  ORDER BY doc.nombre_documento";
			}


			  
		  
			$listar = $this->db->prepare($sql);
		}
	
		$listar->execute();

  		return $listar;
		
	}
	
	public function get_cantidad_documentos_especificos($identrada,$idsql){
	
		$idusuario  = $_SESSION['idUsuario'];
	
		if($identrada == 1){
	
			
			//LISTA TODOS LOS DOCUMENTOS (SI ESTE USUARIO TIENE PERMISO EN LA TABLA pa_usuario_acciones)  
			if ($idsql == 1){
			
				$sql = "SELECT td.nombre_tipo_documento AS tipodocumento,COUNT(*) AS cantidad,
										  rds.id,rds.numero,d.nombre_dirigido,rds.nombre,rds.direccion,rds.ciudad,
										  rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
										  ubi.idjuzgado,jo.nombre AS juzorigen, ubi.radicado
										  FROM (((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
										  LEFT JOIN pa_documento doc ON td.iddocumento = doc.id)
										  LEFT JOIN pa_dirigido d ON rds.dirigidoa = d.id)
										  LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
										  LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
										  LEFT JOIN ubicacion_expediente ubi ON rds.idradicado = ubi.id)
										  LEFT JOIN pa_juzgado jo ON ubi.idjuzgado = jo.id)
										  GROUP BY rds.idtipodocumento
										  HAVING COUNT(*) >= 1
										  ORDER BY td.nombre_tipo_documento";
			}
	
			//LISTA SOLO LOS DOCUMENTOS DEL USUARIO EN SESION
			if ($idsql == 0){
			
				$sql = "SELECT td.nombre_tipo_documento AS tipodocumento,COUNT(*) AS cantidad,
										  rds.id,rds.numero,d.nombre_dirigido,rds.nombre,rds.direccion,rds.ciudad,
										  rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
										  ubi.idjuzgado,jo.nombre AS juzorigen, ubi.radicado
										  FROM (((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
										  LEFT JOIN pa_documento doc ON td.iddocumento = doc.id)
										  LEFT JOIN pa_dirigido d ON rds.dirigidoa = d.id)
										  LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
										  LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
										  LEFT JOIN ubicacion_expediente ubi ON rds.idradicado = ubi.id)
										  LEFT JOIN pa_juzgado jo ON ubi.idjuzgado = jo.id)
										  WHERE rds.idusuario = '$idusuario'
										  GROUP BY rds.idtipodocumento
										  HAVING COUNT(*) >= 1
										  ORDER BY td.nombre_tipo_documento";
			}


										  
			$listar = $this->db->prepare($sql);
		
		}
		
		if($identrada == 2){
			
			$filtrox;
			
			$filtrof;
			$filtro1;
			$filtro2;
			$filtro3;
			$filtro4;
			$filtro5;
			$filtro6;
			$filtro7;
			$filtro8;
			$filtro9;
			$filtro10;
			
			
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$datox1    = trim($_GET['datox1']);
			$datox2    = trim($_GET['datox2']);
			$datox3    = trim($_GET['datox3']);
			$datox4    = trim($_GET['datox4']);
			$datox5    = trim($_GET['datox5']);
			$datox6    = trim($_GET['datox6']);
			$datox7    = trim($_GET['datox7']);
			$datox8    = trim($_GET['datox8']);
			$datox9    = trim($_GET['datox9']);
			$datox10   = trim($_GET['datox10']);
			
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtrof = " AND (rds.fechageneracion >= '$fechad' AND rds.fechageneracion <= '$fechah') ";
				
			
			}
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND rds.idtipodocumento = '$datox1' ";
			
			}
			if ( !empty($datox2) ) {
			
				$filtro2 = " AND rds.numero = '$datox2' ";
			
			}
			if ( !empty($datox3) ) {
			
				$filtro3 = " AND rds.dirigidoa = '$datox3' ";
			
			}
			if ( !empty($datox4) ) {
			
				//$filtro4 = " AND rds.nombre = '$datox4' ";
				$filtro4 = " AND rds.nombre LIKE '%$datox4%' ";
			
			}
			if ( !empty($datox5) ) {
			
				$filtro5 = " AND rds.cargo LIKE '%$datox5%' ";
			
			}
			if ( !empty($datox6) ) {
			
				$filtro6 = " AND rds.dependencia LIKE '%$datox6%' ";
			
			}
			if ( !empty($datox7) ) {
			
				//$filtro8 = " AND rds.asunto = '$datox8' ";
				$filtro7 = " AND rds.asunto LIKE '%$datox7%' ";
			
			}
			if ( !empty($datox8) ) {
			
				$filtro8 = " AND rds.id = '$datox8' ";
			
			}
			if ( !empty($datox9) ) {
			
				$filtro9 = " AND ubi.radicado LIKE '%$datox9%' ";
			
			}
			
	
			//$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtrof;
			
			//echo $filtrox;
			
			//LISTA TODOS LOS DOCUMENTOS (SI ESTE USUARIO TIENE PERMISO EN LA TABLA pa_usuario_acciones)  
			if ($idsql == 1){
			
				//SI EL USUARIO QUE PUEDE VER TODOS LOS REGISTROS FILTRA POR UN USUARIO ESPECIFICO
			 	if ( !empty($datox10) ) {
			
					$filtro10 = " AND rds.idusuario = '$datox10' ";
					
					$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtro10." ".$filtrof;
			
				}
				else{
					
					$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtrof;
				}
			
				$sql = "SELECT td.nombre_tipo_documento AS tipodocumento,COUNT(*) AS cantidad,
										  rds.id,rds.numero,d.nombre_dirigido,rds.nombre,rds.direccion,rds.ciudad,
										  rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
										  ubi.idjuzgado,jo.nombre AS juzorigen, ubi.radicado
										  FROM (((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
										  LEFT JOIN pa_documento doc ON td.iddocumento = doc.id)
										  LEFT JOIN pa_dirigido d ON rds.dirigidoa = d.id)
										  LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
										  LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
										  LEFT JOIN ubicacion_expediente ubi ON rds.idradicado = ubi.id)
										  LEFT JOIN pa_juzgado jo ON ubi.idjuzgado = jo.id)
										  WHERE rds.id >= '1'" .$filtrox. " 
										  GROUP BY rds.idtipodocumento
										  HAVING COUNT(*) >= 1
										  ORDER BY td.nombre_tipo_documento";
			}
	
			//LISTA SOLO LOS DOCUMENTOS DEL USUARIO EN SESION
			if ($idsql == 0){
			
				$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtrof;
				
				$sql = "SELECT td.nombre_tipo_documento AS tipodocumento,COUNT(*) AS cantidad,
										  rds.id,rds.numero,d.nombre_dirigido,rds.nombre,rds.direccion,rds.ciudad,
										  rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
										  ubi.idjuzgado,jo.nombre AS juzorigen, ubi.radicado
										  FROM (((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
										  LEFT JOIN pa_documento doc ON td.iddocumento = doc.id)
										  LEFT JOIN pa_dirigido d ON rds.dirigidoa = d.id)
										  LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
										  LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
										  LEFT JOIN ubicacion_expediente ubi ON rds.idradicado = ubi.id)
										  LEFT JOIN pa_juzgado jo ON ubi.idjuzgado = jo.id)
										  WHERE rds.id >= '1'" .$filtrox. " AND rds.idusuario = '$idusuario'
										  GROUP BY rds.idtipodocumento
										  HAVING COUNT(*) >= 1
										  ORDER BY td.nombre_tipo_documento";
			}


			
			$listar = $this->db->prepare($sql);
										  
			
			  
		  
		}
	
		$listar->execute();

  		return $listar;
		
	}
	
	public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
	
		$listar     = $this->db->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
	
  		$listar->execute();

  		return $listar;
	
	}



}

require ('views/PHPExcel-develop/Classes/PHPExcel.php');

//---------------------LINEA AGREGADA POR JORGE ANDRES VALENCIA OROZCO----------------------------------

//OPCION REPORTE
$opcion    = trim($_GET['opcion']);
$tfiltro   = trim($_GET['tfiltro']);
$tiporepor = trim($_GET['tiporepor']);

//------------------------------------------------------------------------------------------------------


if($opcion == 1){

	$data                 = new estadisticaexcelModel();
	
	/*$campos               = 'usuario';
	$nombrelista          = 'pa_usuario_acciones';
	$idaccion			  = '1';
	$campoordenar         = 'id';
	$datosusuarioacciones = $data->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuarios             = $datosusuarioacciones->fetch();
	$usuariosa			  = explode("////",$usuarios[usuario]);
	
		
	if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
			
		//LISTA TODOS LOS DOCUMENTOS (SI ESTE USUARIO TIENE PERMISO EN LA TABLA pa_usuario_acciones)
		//$datosdocumentossalientes = $modelo->get_documentos_salientes_usuario(1,1);
		
		$vector_datos                    = $data->get_documentos($tfiltro,1);
		$cantidad_documentos             = $data->get_cantidad_documentos($tfiltro,1);
		$cantidad_documentos_especificos = $data->get_cantidad_documentos_especificos($tfiltro,1);
	}
	else{
		//LISTA SOLO LOS DOCUMENTOS DEL USUARIO EN SESION
		//$datosdocumentossalientes = $modelo->get_documentos_salientes_usuario(1,0);
		
		$vector_datos                    = $data->get_documentos($tfiltro,0);
		$cantidad_documentos             = $data->get_cantidad_documentos($tfiltro,0);
		$cantidad_documentos_especificos = $data->get_cantidad_documentos_especificos($tfiltro,0);
	}*/
		
	$vector_datos                    = $data->get_informacion_reporte($tfiltro,$tiporepor);
	$cantidad_documentos             = $data->get_cantidad_documentos($tfiltro);
	$cantidad_documentos_especificos = $data->get_cantidad_documentos_especificos($tfiltro);
	
	
	$objPHPExcel  = new PHPExcel();
	
	$styleArray = array(
	'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
	'size'   =>  12 
	)
	);
	
	$borders = array(
		  'borders' => array(
			'allborders' => array(
			  'style' => PHPExcel_Style_Border::BORDER_THICK,
			  'color' => array('argb' => 'FF000000'),
			)
		  ),
		);
		
	$borders_nobold = array(
		  'borders' => array(
			'allborders' => array(
			  'style' => PHPExcel_Style_Border::BORDER_THIN,
			  'color' => array('argb' => 'FF000000'),
			)
		  ),
		);	
	// Agregar Informacion Encabezados Excel
	
	$sheet1=$objPHPExcel->setActiveSheetIndex(0)
	
	->setCellValue('A1', 'ID')
	->setCellValue('B1', 'RADICADO');
	
	
	//->setCellValue('C1',  utf8_encode('Cédula Demandante')) //PARA LAS TILDES
	
	$sheet1->getStyle('A1')->applyFromArray($styleArray);
	$sheet1->getStyle('B1')->applyFromArray($styleArray);
	

	$sheet1->getStyle('A1:B1')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
	
	
	$i=2;
	while($field = $vector_datos->fetch() )
	{
	
		$sheet1->setCellValue('A'.$i, $field[id]);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->getCell('B' . $i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
		
		//$sheet1->setCellValue('G'.$i, utf8_encode($field[nombre_tipo_documento]));
		//$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
		
		$i++;
		
	}
	
	//--------------------------------------------------------------------
	/*$i = $i + 2;
	
	$sheet1->setCellValue('A'.$i, 'TOTALES');
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
	$sheet1->mergeCells('A'.$i.':'.'B'.$i);
	
	$sheet1->getStyle('A'.$i.':'.'B'.$i)->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
	);
	
	$sheet1->getStyle('A'.$i.':'.'B'.$i)->applyFromArray($styleArray);
	$sheet1->getStyle('A'.$i.':'.'B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//--------------------------------------------------------------------
	
	//--------------------------------------------------------------------
	$i = $i + 1;
	
	$sheet1->setCellValue('A'.$i, 'DOCUMENTO');
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('B'.$i, 'CANTIDAD');
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->getStyle('A'.$i.':'.'B'.$i)->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
	);
	
	$sheet1->getStyle('A'.$i.':'.'B'.$i)->applyFromArray($styleArray);
	$sheet1->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	//--------------------------------------------------------------------
	//--------------------------------------------------------------------
		
	$i = $i + 1;
	while($field = $cantidad_documentos->fetch() )
	{
	
		$sheet1->setCellValue('A'.$i, $field[documento]);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	
		$sheet1->setCellValue('B'.$i, utf8_encode($field[cantidad]));
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
		
		$i++;
		
	}

	
	//--------------------------------------------------------------------
	$i = $i + 2;
	
	$sheet1->setCellValue('A'.$i, 'TOTALES ESPECIFICOS');
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
	$sheet1->mergeCells('A'.$i.':'.'B'.$i);
	
	$sheet1->getStyle('A'.$i.':'.'B'.$i)->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
	);
	
	$sheet1->getStyle('A'.$i.':'.'B'.$i)->applyFromArray($styleArray);
	$sheet1->getStyle('A'.$i.':'.'B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//--------------------------------------------------------------------
	
	//--------------------------------------------------------------------
	$i = $i + 1;
	
	$sheet1->setCellValue('A'.$i, 'TIPO DOCUMENTO');
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('B'.$i, 'CANTIDAD');
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->getStyle('A'.$i.':'.'B'.$i)->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
	);
	
	$sheet1->getStyle('A'.$i.':'.'B'.$i)->applyFromArray($styleArray);
	$sheet1->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	//--------------------------------------------------------------------
		
	$i = $i + 1;
	while($field = $cantidad_documentos_especificos->fetch() )
	{
	
		$sheet1->setCellValue('A'.$i, $field[tipodocumento]);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	
		$sheet1->setCellValue('B'.$i, utf8_encode($field[cantidad]));
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
		
		$i++;
		
	}*/
	
	   
	$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($borders);
	
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
	
	// Renombrar Hoja
	$objPHPExcel->getActiveSheet()->setTitle('estadisticasignot');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="estadisticasignot.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;

}





if($opcion == 2){

	$data                 = new estadisticaexcelModel();
	
	$campos               = 'usuario';
	$nombrelista          = 'pa_usuario_acciones';
	$idaccion			  = '1';
	$campoordenar         = 'id';
	$datosusuarioacciones = $data->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuarios             = $datosusuarioacciones->fetch();
	$usuariosa			  = explode("////",$usuarios[usuario]);
	
		
	if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
			
		//LISTA TODOS LOS DOCUMENTOS (SI ESTE USUARIO TIENE PERMISO EN LA TABLA pa_usuario_acciones)
		//$datosdocumentossalientes = $modelo->get_documentos_salientes_usuario(1,1);
		
		$vector_datos                    = $data->get_documentos($tfiltro,1);
		$cantidad_documentos             = $data->get_cantidad_documentos($tfiltro,1);
		$cantidad_documentos_especificos = $data->get_cantidad_documentos_especificos($tfiltro,1);
	}
	else{
		//LISTA SOLO LOS DOCUMENTOS DEL USUARIO EN SESION
		//$datosdocumentossalientes = $modelo->get_documentos_salientes_usuario(1,0);
		
		$vector_datos                    = $data->get_documentos($tfiltro,0);
		$cantidad_documentos             = $data->get_cantidad_documentos($tfiltro,0);
		$cantidad_documentos_especificos = $data->get_cantidad_documentos_especificos($tfiltro,0);
	}
		
	/*$vector_datos                    = $data->get_documentos($tfiltro);
	$cantidad_documentos             = $data->get_cantidad_documentos($tfiltro);
	$cantidad_documentos_especificos = $data->get_cantidad_documentos_especificos($tfiltro);*/
	
	
	$objPHPExcel  = new PHPExcel();
	
	$styleArray = array(
	'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
	'size'   =>  12 
	)
	);
	
	$borders = array(
		  'borders' => array(
			'allborders' => array(
			  'style' => PHPExcel_Style_Border::BORDER_THICK,
			  'color' => array('argb' => 'FF000000'),
			)
		  ),
		);
		
	$borders_nobold = array(
		  'borders' => array(
			'allborders' => array(
			  'style' => PHPExcel_Style_Border::BORDER_THIN,
			  'color' => array('argb' => 'FF000000'),
			)
		  ),
		);	
	// Agregar Informacion Encabezados Excel
	
	$sheet1=$objPHPExcel->setActiveSheetIndex(0)
	
	->setCellValue('A1', 'DOCUMENTO')
	->setCellValue('B1', 'TIPO DOCUMENTO')
	->setCellValue('C1', 'NUMERO')
	->setCellValue('D1', 'DESTINATARIO')
	->setCellValue('E1', 'ENTIDAD')
	->setCellValue('F1', 'FECHA')
	->setCellValue('G1', 'ASUNTO')
	->setCellValue('H1', 'RADICADO')
	->setCellValue('I1', 'PROYECTO');
	
	
	//->setCellValue('C1',  utf8_encode('Cédula Demandante')) //PARA LAS TILDES
	
	$sheet1->getStyle('A1')->applyFromArray($styleArray);
	$sheet1->getStyle('B1')->applyFromArray($styleArray);
	$sheet1->getStyle('C1')->applyFromArray($styleArray);
	$sheet1->getStyle('D1')->applyFromArray($styleArray);
	$sheet1->getStyle('E1')->applyFromArray($styleArray);
	$sheet1->getStyle('F1')->applyFromArray($styleArray);
	$sheet1->getStyle('G1')->applyFromArray($styleArray);
	$sheet1->getStyle('H1')->applyFromArray($styleArray);
	$sheet1->getStyle('I1')->applyFromArray($styleArray);
	
	
	$sheet1->getStyle('A1:I1')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
	
	
	//SELECT rds.id,rds.identrada,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.cargo,rds.dependencia,
	//rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita
	
	$i=2;
	while($field = $vector_datos->fetch() )
	{
	
		$sheet1->setCellValue('A'.$i, $field[documento]);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('B'.$i, $field[nombre_tipo_documento]);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('C'.$i, $field[numero]);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
	
		$sheet1->setCellValue('D'.$i, utf8_encode($field[juzorigen]));
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('E'.$i, utf8_encode($field[nombre]));
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('F'.$i,$field[fechageneracion]);
		$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('G'.$i, utf8_encode($field[nombre_tipo_documento]));
		$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->getCell('H' . $i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('I'.$i, utf8_encode($field[registra]));
		//$sheet1->setCellValue('F'.$i, $field[registra]);
		$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
		
		$i++;
		
	}
	
	//--------------------------------------------------------------------
	$i = $i + 2;
	
	$sheet1->setCellValue('A'.$i, 'TOTALES');
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
	$sheet1->mergeCells('A'.$i.':'.'B'.$i);
	
	$sheet1->getStyle('A'.$i.':'.'B'.$i)->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
	);
	
	$sheet1->getStyle('A'.$i.':'.'B'.$i)->applyFromArray($styleArray);
	$sheet1->getStyle('A'.$i.':'.'B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//--------------------------------------------------------------------
	
	//--------------------------------------------------------------------
	$i = $i + 1;
	
	$sheet1->setCellValue('A'.$i, 'DOCUMENTO');
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('B'.$i, 'CANTIDAD');
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->getStyle('A'.$i.':'.'B'.$i)->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
	);
	
	$sheet1->getStyle('A'.$i.':'.'B'.$i)->applyFromArray($styleArray);
	$sheet1->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	//--------------------------------------------------------------------
	//--------------------------------------------------------------------
		
	$i = $i + 1;
	while($field = $cantidad_documentos->fetch() )
	{
	
		$sheet1->setCellValue('A'.$i, $field[documento]);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	
		$sheet1->setCellValue('B'.$i, utf8_encode($field[cantidad]));
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
		
		$i++;
		
	}

	
	//--------------------------------------------------------------------
	$i = $i + 2;
	
	$sheet1->setCellValue('A'.$i, 'TOTALES ESPECIFICOS');
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
	$sheet1->mergeCells('A'.$i.':'.'B'.$i);
	
	$sheet1->getStyle('A'.$i.':'.'B'.$i)->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
	);
	
	$sheet1->getStyle('A'.$i.':'.'B'.$i)->applyFromArray($styleArray);
	$sheet1->getStyle('A'.$i.':'.'B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//--------------------------------------------------------------------
	
	//--------------------------------------------------------------------
	$i = $i + 1;
	
	$sheet1->setCellValue('A'.$i, 'TIPO DOCUMENTO');
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('B'.$i, 'CANTIDAD');
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->getStyle('A'.$i.':'.'B'.$i)->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
	);
	
	$sheet1->getStyle('A'.$i.':'.'B'.$i)->applyFromArray($styleArray);
	$sheet1->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	//--------------------------------------------------------------------
		
	$i = $i + 1;
	while($field = $cantidad_documentos_especificos->fetch() )
	{
	
		$sheet1->setCellValue('A'.$i, $field[tipodocumento]);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	
		$sheet1->setCellValue('B'.$i, utf8_encode($field[cantidad]));
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
		
		$i++;
		
	}
	
	   
	$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($borders);
	
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize('true');
	
	// Renombrar Hoja
	$objPHPExcel->getActiveSheet()->setTitle('estadisticadoc');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="estadisticadoc.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;

}


?>