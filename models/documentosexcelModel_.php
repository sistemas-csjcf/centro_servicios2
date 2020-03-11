<?php
class documentosexcelModel_ extends modelBase{

	public function get_documentos($identrada,$idsql){
	
	
		$idusuario  = $_SESSION['idUsuario'];
		
		if($identrada == 1){
		
			//LISTA TODOS LOS DOCUMENTOS (SI ESTE USUARIO TIENE PERMISO EN LA TABLA pa_usuario_acciones)  
			if ($idsql == 1){
			
				$sql = "SELECT rds.id,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.direccion,rds.ciudad,
						rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
						ubi.idjuzgadoorigen,jo.nombre AS juzorigen,do.nombre_documento AS documento, ubi.radicado
						FROM (((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
						LEFT JOIN pa_documento do ON td.iddocumento = do.id)
						LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
						LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
						LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
						LEFT JOIN signot_proceso ubi ON rds.idradicado = ubi.id)
						LEFT JOIN pa_juzgado jo ON ubi.idjuzgadoorigen = jo.id)
						ORDER BY rds.numero";
			
			}
			
			//LISTA SOLO LOS DOCUMENTOS DEL USUARIO EN SESION
			if ($idsql == 0){
			
				$sql = "SELECT rds.id,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.direccion,rds.ciudad,
						rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
						ubi.idjuzgadoorigen,jo.nombre AS juzorigen,do.nombre_documento AS documento, ubi.radicado
						FROM (((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
						LEFT JOIN pa_documento do ON td.iddocumento = do.id)
						LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
						LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
						LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
						LEFT JOIN signot_proceso ubi ON rds.idradicado = ubi.id)
						LEFT JOIN pa_juzgado jo ON ubi.idjuzgadoorigen = jo.id)
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
			$filtro11;
			$filtro12;
			
			
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
			$datox11   = trim($_GET['datox11']);
			$datox12   = trim($_GET['datox12']);
			
			
			
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
			
			if ( !empty($datox11) ) {
			
				$filtro11 = " AND do.id = '$datox11' ";
			
			}
			
			if ( !empty($datox12) ) {
			
				
				$filtro12 = " AND ubi.idjuzgadoorigen = '$datox12' ";
			
			}
			
	
			//$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtrof;
			
			//echo $filtrox;
			  
		 	
			//LISTA TODOS LOS DOCUMENTOS (SI ESTE USUARIO TIENE PERMISO EN LA TABLA pa_usuario_acciones)  
			if ($idsql == 1){
			
			
				//SI EL USUARIO QUE PUEDE VER TODOS LOS REGISTROS FILTRA POR UN USUARIO ESPECIFICO
			 	if ( !empty($datox10) ) {
			
					$filtro10 = " AND rds.idusuario = '$datox10' ";
					
					$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtro10." ".$filtro11." ".$filtro12." ".$filtrof;
			
				}
				else{
					
					$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtro11." ".$filtro12." ".$filtrof;
				}
			
				$sql = "SELECT rds.id,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.direccion,rds.ciudad,
						rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
						ubi.idjuzgadoorigen,jo.nombre AS juzorigen,do.nombre_documento AS documento, ubi.radicado
						FROM (((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
						LEFT JOIN pa_documento do ON td.iddocumento = do.id)
						LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
						LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
						LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
						LEFT JOIN signot_proceso ubi ON rds.idradicado = ubi.id)
						LEFT JOIN pa_juzgado jo ON ubi.idjuzgadoorigen = jo.id)
						WHERE rds.id >= '1'" .$filtrox. " 
						ORDER BY rds.numero";
			
			}
			
			//LISTA SOLO LOS DOCUMENTOS DEL USUARIO EN SESION
			if ($idsql == 0){
			
				$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtro11." ".$filtro12." ".$filtrof;
			
				$sql = "SELECT rds.id,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.direccion,rds.ciudad,
						rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
						ubi.idjuzgadoorigen,jo.nombre AS juzorigen,do.nombre_documento AS documento, ubi.radicado
						FROM (((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
						LEFT JOIN pa_documento do ON td.iddocumento = do.id)
						LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
						LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
						LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
						LEFT JOIN signot_proceso ubi ON rds.idradicado = ubi.id)
						LEFT JOIN pa_juzgado jo ON ubi.idjuzgadoorigen = jo.id)
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
										  ubi.idjuzgadoorigen,jo.nombre AS juzorigen, ubi.radicado
										  FROM (((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
										  LEFT JOIN pa_documento doc ON td.iddocumento = doc.id)
										  LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
										  LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
										  LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
										  LEFT JOIN signot_proceso ubi ON rds.idradicado = ubi.id)
										  LEFT JOIN pa_juzgado jo ON ubi.idjuzgadoorigen = jo.id)
										  GROUP BY doc.id
										  HAVING COUNT(*) >= 1
										  ORDER BY doc.nombre_documento";
			}
	
			//LISTA SOLO LOS DOCUMENTOS DEL USUARIO EN SESION
			if ($idsql == 0){
			
				$sql = "SELECT doc.nombre_documento AS documento,COUNT(*) AS cantidad,
										  rds.id,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.direccion,rds.ciudad,
										  rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
										  ubi.idjuzgadoorigen,jo.nombre AS juzorigen, ubi.radicado
										  FROM (((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
										  LEFT JOIN pa_documento doc ON td.iddocumento = doc.id)
										  LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
										  LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
										  LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
										  LEFT JOIN signot_proceso ubi ON rds.idradicado = ubi.id)
										  LEFT JOIN pa_juzgado jo ON ubi.idjuzgadoorigen = jo.id)
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
			$filtro11;
			$filtro12;
			
			
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
			$datox11   = trim($_GET['datox11']);
			$datox12   = trim($_GET['datox12']);
			
			
			
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
			
			if ( !empty($datox11) ) {
			
				$filtro11 = " AND doc.id = '$datox11' ";
			
			}
			
			if ( !empty($datox12) ) {
			
				
				$filtro12 = " AND ubi.idjuzgadoorigen = '$datox12' ";
			
			}
			
			
			//$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtrof;
			
			//echo $filtrox;
			
			//LISTA TODOS LOS DOCUMENTOS (SI ESTE USUARIO TIENE PERMISO EN LA TABLA pa_usuario_acciones)  
			if ($idsql == 1){
			
				//SI EL USUARIO QUE PUEDE VER TODOS LOS REGISTROS FILTRA POR UN USUARIO ESPECIFICO
			 	if ( !empty($datox10) ) {
			
					$filtro10 = " AND rds.idusuario = '$datox10' ";
					
					$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtro10." ".$filtro11." ".$filtro12." ".$filtrof;
			
				}
				else{
					
					$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtro11." ".$filtro12." ".$filtrof;
				}
			
				$sql = "SELECT doc.nombre_documento AS documento,COUNT(*) AS cantidad,
										  rds.id,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.direccion,rds.ciudad,
										  rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
										  ubi.idjuzgadoorigen,jo.nombre AS juzorigen, ubi.radicado
										  FROM (((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
										  LEFT JOIN pa_documento doc ON td.iddocumento = doc.id)
										  LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
										  LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
										  LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
										  LEFT JOIN signot_proceso ubi ON rds.idradicado = ubi.id)
										  LEFT JOIN pa_juzgado jo ON ubi.idjuzgadoorigen = jo.id)
										  WHERE rds.id >= '1'" .$filtrox. " 
										  GROUP BY doc.id
										  HAVING COUNT(*) >= 1
										  ORDER BY doc.nombre_documento";
			}
	
			//LISTA SOLO LOS DOCUMENTOS DEL USUARIO EN SESION
			if ($idsql == 0){
			
				$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtro11." ".$filtro12." ".$filtrof;
			
				$sql = "SELECT doc.nombre_documento AS documento,COUNT(*) AS cantidad,
										  rds.id,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.direccion,rds.ciudad,
										  rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
										  ubi.idjuzgadoorigen,jo.nombre AS juzorigen, ubi.radicado
										  FROM (((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
										  LEFT JOIN pa_documento doc ON td.iddocumento = doc.id)
										  LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
										  LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
										  LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
										  LEFT JOIN signot_proceso ubi ON rds.idradicado = ubi.id)
										  LEFT JOIN pa_juzgado jo ON ubi.idjuzgadoorigen = jo.id)
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
										  ubi.idjuzgadoorigen,jo.nombre AS juzorigen, ubi.radicado
										  FROM (((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
										  LEFT JOIN pa_documento doc ON td.iddocumento = doc.id)
										  LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
										  LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
										  LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
										  LEFT JOIN signot_proceso ubi ON rds.idradicado = ubi.id)
										  LEFT JOIN pa_juzgado jo ON ubi.idjuzgadoorigen = jo.id)
										  GROUP BY rds.idtipodocumento
										  HAVING COUNT(*) >= 1
										  ORDER BY td.nombre_tipo_documento";
			}
	
			//LISTA SOLO LOS DOCUMENTOS DEL USUARIO EN SESION
			if ($idsql == 0){
			
				$sql = "SELECT td.nombre_tipo_documento AS tipodocumento,COUNT(*) AS cantidad,
										  rds.id,rds.numero,d.nombre_dirigido,rds.nombre,rds.direccion,rds.ciudad,
										  rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
										  ubi.idjuzgadoorigen,jo.nombre AS juzorigen, ubi.radicado
										  FROM (((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
										  LEFT JOIN pa_documento doc ON td.iddocumento = doc.id)
										  LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
										  LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
										  LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
										  LEFT JOIN signot_proceso ubi ON rds.idradicado = ubi.id)
										  LEFT JOIN pa_juzgado jo ON ubi.idjuzgadoorigen = jo.id)
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
			$filtro11;
			$filtro12;
			
			
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
			$datox11   = trim($_GET['datox11']);
			$datox12   = trim($_GET['datox12']);
			
			
			
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
			
			if ( !empty($datox11) ) {
			
				$filtro11 = " AND doc.id = '$datox11' ";
			
			}
			
			if ( !empty($datox12) ) {
			
				
				$filtro12 = " AND ubi.idjuzgadoorigen = '$datox12' ";
			
			}
			
	
			//$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtrof;
			
			//echo $filtrox;
			
			//LISTA TODOS LOS DOCUMENTOS (SI ESTE USUARIO TIENE PERMISO EN LA TABLA pa_usuario_acciones)  
			if ($idsql == 1){
			
				//SI EL USUARIO QUE PUEDE VER TODOS LOS REGISTROS FILTRA POR UN USUARIO ESPECIFICO
			 	if ( !empty($datox10) ) {
			
					$filtro10 = " AND rds.idusuario = '$datox10' ";
					
					$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtro10." ".$filtro11." ".$filtro12." ".$filtrof;
			
				}
				else{
					
					$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtro11." ".$filtro12." ".$filtrof;
				}
			
				$sql = "SELECT td.nombre_tipo_documento AS tipodocumento,COUNT(*) AS cantidad,
										  rds.id,rds.numero,d.nombre_dirigido,rds.nombre,rds.direccion,rds.ciudad,
										  rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
										  ubi.idjuzgadoorigen,jo.nombre AS juzorigen, ubi.radicado
										  FROM (((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
										  LEFT JOIN pa_documento doc ON td.iddocumento = doc.id)
										  LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
										  LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
										  LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
										  LEFT JOIN signot_proceso ubi ON rds.idradicado = ubi.id)
										  LEFT JOIN pa_juzgado jo ON ubi.idjuzgadoorigen = jo.id)
										  WHERE rds.id >= '1'" .$filtrox. " 
										  GROUP BY rds.idtipodocumento
										  HAVING COUNT(*) >= 1
										  ORDER BY td.nombre_tipo_documento";
			}
	
			//LISTA SOLO LOS DOCUMENTOS DEL USUARIO EN SESION
			if ($idsql == 0){
			
				$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtro11." ".$filtro12." ".$filtrof;
				
				$sql = "SELECT td.nombre_tipo_documento AS tipodocumento,COUNT(*) AS cantidad,
										  rds.id,rds.numero,d.nombre_dirigido,rds.nombre,rds.direccion,rds.ciudad,
										  rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
										  ubi.idjuzgadoorigen,jo.nombre AS juzorigen, ubi.radicado
										  FROM (((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
										  LEFT JOIN pa_documento doc ON td.iddocumento = doc.id)
										  LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
										  LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
										  LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
										  LEFT JOIN signot_proceso ubi ON rds.idradicado = ubi.id)
										  LEFT JOIN pa_juzgado jo ON ubi.idjuzgadoorigen = jo.id)
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
	
	public function get_datos_1(){
	
		$listar = $this->db->prepare("SELECT idparte FROM documentos_internos
									  WHERE idparte != 0
									  GROUP BY idparte
									  ORDER BY idparte");
									  
		/*$listar = $this->db->prepare("SELECT idparte FROM documentos_internos
									  WHERE idparte != 0 AND idparte = 6
									  GROUP BY idparte
									  ORDER BY idparte");*/
									 
									  
  		$listar->execute();
		
		return $listar;
	
	}
	
	public function get_datos_2($idparte){
	
		$listar = $this->db->prepare("SELECT idradicado FROM documentos_internos
									  WHERE idparte = '$idparte'
									  GROUP BY idradicado
									  ORDER BY idradicado");
									  
		
		/*$listar = $this->db->prepare("SELECT idradicado FROM documentos_internos
									  WHERE idparte = 6
									  GROUP BY idradicado
									  ORDER BY idradicado");*/
									 
									  
  		$listar->execute();
		
		return $listar;
	
	}
	
	public function get_datos_3($idparte,$idradicado){
	
		$listar = $this->db->prepare("SELECT id AS idregistro,idtipodocumento FROM documentos_internos
												WHERE idparte = '$idparte' AND idradicado = '$idradicado'
												AND id = (
												SELECT MAX( id )  FROM documentos_internos WHERE idparte = '$idparte' 
												AND idradicado = '$idradicado')");
												
												
		/*$listar = $this->db->prepare("SELECT id AS idregistro,idtipodocumento FROM documentos_internos
												WHERE idparte = '6' AND idradicado = '$idradicado'
												AND id = (
												SELECT MAX( id )  FROM documentos_internos WHERE idparte = 6
												AND idradicado = '$idradicado')");*/
									 
									  
  		$listar->execute();
		
		return $listar;
	
	}
	
	public function get_registros_estadistica(){
	
		  
		$listar = $this->db->prepare("SELECT idparte FROM documentos_internos
									  WHERE idparte != 0 AND idparte = 6
									  GROUP BY idparte
									  ORDER BY idparte");
									 
									  
  		$listar->execute();
		
		return $listar;
	
	}
	
	public function get_documentos_estadistica(){
		//JUAN ESTEBAN MÚNERA BETANCUR
		
		$modelo = new documentosexcelModel();
	
		
		/*1 OBTENGO ID PARTES*/
		
		$resultado = $modelo->get_datos_1();
		
		//1
		while($fila = $resultado->fetch()){
		
		
			$idparte = $fila[idparte];
			
			
			/*2 OBTENGO LOS RADICADOS ASIGNADOS A CADA PARTE*/
		
			$resultado_2 = $modelo->get_datos_2($idparte);
			
			//2
			while($fila_2 = $resultado_2->fetch()){
			
				
				$idradicado = $fila_2[idradicado];
				
				
				/*3 OBTENGO EL ID DEL ULTIMO DOCUMENTO GENERADOA ESA PARTE POR PROCESO*/
				
				$resultado_3 = $modelo->get_datos_3($idparte,$idradicado);
				
				//3
				while($fila_3 = $resultado_3->fetch()){
				
					
					$idregistro      = $fila_3[idregistro];
					
					$idtipodocumento = $fila_3[idtipodocumento];
					
					
					//BUSCAR DOCUMENTO, SI ES CITACION,NOTIFICACION,DEVOLUCION O ANEXO
	
					$i = 1;
				
					while($i < 6){
					
					
						$listar_4A = $this->db->prepare("SELECT * FROM pa_tipodocumento WHERE iddocumento = '$i' 
														 AND id = '$idtipodocumento'");
	
						$listar_4A->execute();
						
						$resultado_4A = $listar_4A->rowCount();
	
						//if(!$resultado_4A){//existe registros
						if($resultado_4A == 1){//existe registros
			
								
							$vector_registro[] = $idregistro;
								
								
						}
						
						$i = $i + 1;
						
				
					}
					
					
				
				}//fin 3
				
				
			
			
			}//fin 2
			
			
			
						
		}//fin 1
		
		
		$cadenaregistros = "";
		
		for($i = 0; $i < count($vector_registro); $i++){
			
			$cadenaregistros.= $vector_registro[$i].",";
		}
		
		//echo $vector_registro[2];
		
		//print_r($vector_registro);
		
		$cadenaregistros = "t1.id IN (".trim($cadenaregistros,",").")";
		
		//echo $cadenaregistros;
		
		
		/*$listar_X = "SELECT t1.id,t1.fechageneracion,t2.radicado,t1.idtipodocumento,
										t1.numero,t1.asunto,t1.nombre,t1.direccion,t1.ciudad
										FROM (documentos_internos t1 INNER JOIN signot_proceso t2 ON t1.idradicado = t2.id)
										WHERE ".$cadenaregistros. "
										ORDER BY t1.idparte";
		
		
		echo $listar_X;*/
				
		$listar_X = $this->db->prepare("SELECT t1.id,t1.fechageneracion,t2.radicado,t3.nombre AS juzgado,t1.idtipodocumento,
										t1.numero,t1.asunto,t1.nombre,t1.direccion,t1.ciudad
										FROM ((documentos_internos t1 INNER JOIN signot_proceso t2 ON t1.idradicado = t2.id)
										INNER JOIN pa_juzgado t3 ON t2.idjuzgadoorigen = t3.id)
										WHERE ".$cadenaregistros. "
										ORDER BY t1.idparte");
									 
									  
  		$listar_X->execute();
		
		
		return $listar_X;


	}
	
	public function get_estado($idtipodocumento){
	
		  
		$n = 1;
				
		while($n < 6){
					
			/*CITACIONES*/
			if($n == 1){
				
				$listar_4A = $this->db->prepare("SELECT * FROM pa_tipodocumento WHERE iddocumento = 1
												 AND id = '$idtipodocumento'");
			}
			
			/*NOTIFICACIONES*/
			if($n == 2){
				
				$listar_4A = $this->db->prepare("SELECT * FROM pa_tipodocumento WHERE iddocumento = 2
												 AND nombre_tipo_documento LIKE '%NOTIFICACION PERSONAL%' 
												 AND id = '$idtipodocumento'");
			}
			
			/*NOTIFICACIONES*/
			if($n == 3){
				
				$listar_4A = $this->db->prepare("SELECT * FROM pa_tipodocumento WHERE iddocumento = 2 
				                                 AND nombre_tipo_documento LIKE '%NOTIFICACION POR AVISO%'
												 AND id = '$idtipodocumento'");
			}
			/*DEVOLUCIONES*/
			if($n == 4){
				
				$listar_4A = $this->db->prepare("SELECT * FROM pa_tipodocumento WHERE iddocumento = 3
												 AND id = '$idtipodocumento'");
			}
			
			/*CONSTANCIA ENTRGA ANEXOS*/
			if($n == 5){
				
				$listar_4A = $this->db->prepare("SELECT * FROM pa_tipodocumento WHERE iddocumento = 4
												 AND id = '$idtipodocumento'");
			}
	
			$listar_4A->execute();
						
			$resultado_4A = $listar_4A->rowCount();
	
			
			if($resultado_4A == 1){//existe registros
			
								
				if($n == 1){$estado = "ACTIVO"; $n = 6;}
				
				if($n == 2){$estado = "INACTIVO"; $n = 6;}
				
				if($n == 3){$estado = "ACTIVO"; $n = 6;}
				
				if($n == 4){$estado = "INACTIVO"; $n = 6;}
				
				if($n == 5){$estado = "INACTIVO"; $n = 6;}
								
								
			}
						
			$n = $n + 1;
						
				
		}
		
		return $estado;
	
	}
}

require ('views/PHPExcel-develop/Classes/PHPExcel.php');

//---------------------LINEA AGREGADA POR JORGE ANDRES VALENCIA OROZCO----------------------------------

//OPCION REPORTE
//$opcion  = trim($_GET['opcion']);
//$tfiltro = trim($_GET['tfiltro']);

//------------------------------------------------------------------------------------------------------

//if($opcion == 2){

	$data = new documentosexcelModel_();
	
	$vector_datos = $data->get_documentos_estadistica();
	
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
	->setCellValue('B1', 'FECHA')
	->setCellValue('C1', 'RADICADO')
	->setCellValue('D1', 'JUZGADO')
	->setCellValue('E1', 'ID_TIPODOC')
	->setCellValue('F1', 'NUMERO')
	->setCellValue('G1', 'TIPO DOCUMENTO')
	->setCellValue('H1', 'NOMBRE')
	->setCellValue('I1', 'DIRECCION')
	->setCellValue('J1', 'CIUDAD')
	->setCellValue('K1', 'ESTADO');
	
	$sheet1->getStyle('A1')->applyFromArray($styleArray);
	$sheet1->getStyle('B1')->applyFromArray($styleArray);
	$sheet1->getStyle('C1')->applyFromArray($styleArray);
	$sheet1->getStyle('D1')->applyFromArray($styleArray);
	$sheet1->getStyle('E1')->applyFromArray($styleArray);
	$sheet1->getStyle('F1')->applyFromArray($styleArray);
	$sheet1->getStyle('G1')->applyFromArray($styleArray);
	$sheet1->getStyle('H1')->applyFromArray($styleArray);
	$sheet1->getStyle('I1')->applyFromArray($styleArray);
	$sheet1->getStyle('J1')->applyFromArray($styleArray);
	$sheet1->getStyle('K1')->applyFromArray($styleArray);
	
	
	$sheet1->getStyle('A1:K1')->getFill()->applyFromArray(
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
		
		$sheet1->setCellValue('B'.$i, $field[fechageneracion]);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->getCell('C' . $i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('D'.$i, utf8_encode($field[juzgado]));
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('E'.$i,$field[idtipodocumento]);
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('F'.$i,$field[numero]);
		$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
	
		$sheet1->setCellValue('G'.$i, utf8_encode($field[asunto]));
		$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('H'.$i, utf8_encode($field[nombre]));
		$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('I'.$i, utf8_encode($field[direccion]));
		$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('J'.$i, utf8_encode($field[ciudad]));
		$sheet1->getStyle('J'.$i)->applyFromArray($borders_nobold);
		
		
		$estado = $data->get_estado($field[idtipodocumento]);
		
		$sheet1->setCellValue('K'.$i, utf8_encode($estado));
		$sheet1->getStyle('K'.$i)->applyFromArray($borders_nobold);
		
		
		$i++;
		
	}
	
	$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($borders);
	
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize('true');
	
	// Renombrar Hoja
	$objPHPExcel->getActiveSheet()->setTitle('estadisticadoc2');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="estadisticadoc2.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;

//}






?>