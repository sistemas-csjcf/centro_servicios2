<?php

class documentosModel extends modelBase{

   /***********************************************************************************/

    /*----------------------------- Mensajes ---------------------------------------*/

    /***********************************************************************************/
	public function mensajes(){

		$condicion=$_GET['nombre'];
 	  
	 	if($condicion == 2){

	 		$_SESSION['elemento'] = "El registro ha sido ingresado correctamente";

	    	$_SESSION['elem_conscontrato'] = true;

	   		if($_SESSION['id']!=""){

	    		/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=documentos&action=Registro_Documentos"</script>';
			}
		}
		 
	 	if($condicion == "2b"){

	 		$_SESSION['elemento'] = "Error al Realizar el registro";

	    	$_SESSION['elem_error_transaccion'] = true;

	   		if($_SESSION['id']!=""){

				/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=documentos&action=Registro_Documentos"</script>';
	  
	   		}

	 	}
	 
	 	if($condicion == "3b1"){

	 		$_SESSION['elemento'] = "El registro ha sido Actualizado correctamente";

	    	$_SESSION['elem_conscontrato'] = true;

	   		if($_SESSION['id']!=""){

	    		/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=reps&action=repsListaPermisos"</script>';
			}

	 	}
	 
	 	if($condicion == "3b2"){

	 		$_SESSION['elemento'] = "Error al Realizar la Actualizacion del Registro";

	    	$_SESSION['elem_error_transaccion'] = true;

	   		if($_SESSION['id']!=""){

	    		/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=reps&action=repsListaPermisos"</script>';
			}

	 	}
		
		if($condicion == 4){

	 		$_SESSION['elemento'] = "El registro ha sido ingresado correctamente";

	    	$_SESSION['elem_conscontrato'] = true;

	   		if($_SESSION['id']!=""){

	    		/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=sigdoc&action=Registro_Documentos_Entrantes"</script>';
			}
		}
		 
	 	if($condicion == "4b"){

	 		$_SESSION['elemento'] = "Error al Realizar el registro";

	    	$_SESSION['elem_error_transaccion'] = true;

	   		if($_SESSION['id']!=""){

				/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=sigdoc&action=Registro_Documentos_Entrantes"</script>';
	  
	   		}

	 	}
		if($condicion == "5"){

	 		$_SESSION['elemento'] = "Numero de Documento ya Existe, No es Posible su Registro";

	    	$_SESSION['elem_error_numero'] = true;

	   		if($_SESSION['id']!=""){

				print'<script languaje="Javascript">location.href="index.php?controller=documentos&action=Registro_Documentos"</script>';
	  
	   		}

	 	}
		
		if($condicion == 6){

	 		$_SESSION['elemento'] = "El registro ha sido ingresado correctamente";

	    	$_SESSION['elem_conscontrato'] = true;

	   		if($_SESSION['id']!=""){

	    		/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=documentos&action=Listar_Documentos_Salientes"</script>';
			}
		}
		 
	 	if($condicion == "6b"){

	 		$_SESSION['elemento'] = "Error al Realizar el registro";

	    	$_SESSION['elem_error_transaccion'] = true;

	   		if($_SESSION['id']!=""){

				/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=documentos&action=Listar_Documentos_Salientes"</script>';
	  
	   		}

	 	}
		
		if($condicion == 7){

	 		$_SESSION['elemento'] = "El registro ha sido ingresado correctamente";

	    	$_SESSION['elem_conscontrato'] = true;

	   		if($_SESSION['id']!=""){

	    		/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Seguimiento_Proceso"</script>';
			}
		}
		 
	 	if($condicion == "7b"){

	 		$_SESSION['elemento'] = "Error al Realizar el registro";

	    	$_SESSION['elem_error_transaccion'] = true;

	   		if($_SESSION['id']!=""){

				/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Seguimiento_Proceso"</script>';
	  
	   		}
			
		}
	 
	 
	
	}	
	
	/***********************************************************************************/

  /*------------------------------ Listar Log ---------------------------------------*/

  /***********************************************************************************/

	public function listarLogSigdoc(){

		$listar = $this->db->prepare("SELECT logusuario.fecha,logusuario.accion,logusuario.detalle,usuario.empleado,usuario.foto
									  FROM LOG AS logusuario
								      INNER JOIN pa_usuario AS usuario ON (logusuario.idusuario=usuario.id)
									  WHERE logusuario.idtipolog=4
									  ORDER BY logusuario.id DESC
									  LIMIT 15");
		$listar->execute();
	 	return $listar;
  	}	
	
	public function get_fecha_actual(){
	
	
		//FORMA WIN 7 Y 8, YA QUE DE LA FORMA ANTERIOR TOMA EL AM O PM Y DA CONFLICTOS PARA 
		//GUARDAR EN LA BASE DE DATOS EN ESTE CASO LA TABLA detalle_correspondencia 
		//CAMPO fecha QUE ES DATETIME 
		date_default_timezone_set('America/Bogota'); 
		$fecharegistro=date('Y-m-d g:ia'); //FORMA PARA XP
		//$fecharegistro = date('Y-m-d g:i'); 
		
		return $fecharegistro; 
		
	
	}
	
	public function get_fecha_actual_amd(){
	
	
		//FORMA WIN 7 Y 8, YA QUE DE LA FORMA ANTERIOR TOMA EL AM O PM Y DA CONFLICTOS PARA 
		//GUARDAR EN LA BASE DE DATOS EN ESTE CASO LA TABLA detalle_correspondencia 
		//CAMPO fecha QUE ES DATETIME 
		date_default_timezone_set('America/Bogota'); 
		$fecharegistro=date('Y-m-d'); //FORMA PARA XP
		//$fecharegistro = date('Y-m-d g:i'); 
		
		return $fecharegistro; 
		
	
	}
	
	public function get_ano(){
	
		date_default_timezone_set('America/Bogota'); 
		$fecharegistro=date('y'); 
		
		return $fecharegistro; 

	}
	
	public function get_ano_completo(){
	
		date_default_timezone_set('America/Bogota'); 
		$fecharegistro=date('Y'); 
		
		return $fecharegistro; 

	}
	
	public function get_hora_actual(){
	
		date_default_timezone_set('America/Bogota'); 
		//$horaregistro=date('H:i:s'); 
		$horaregistro=date('g:i:s A');
		return $horaregistro; 
	}
	
	public function get_datos_usuario_sistema(){
	
		$idusuario  = $_SESSION['idUsuario'];
		
		$listar     = $this->db->prepare("SELECT ingreso,foto,empleado FROM pa_usuario WHERE id = '$idusuario'");

  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_datos_usuarios(){
	
		$listar     = $this->db->prepare("SELECT * FROM pa_usuario ORDER BY empleado");

  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
	
		$listar     = $this->db->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
	
  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_lista_modulos_acciones($campos,$nombrelista,$idaccion,$campoordenar){
	
		$listar     = $this->db->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
	
  		$listar->execute();

  		return $listar;
	
	}
	

	public function get_lista($nombrelista,$campoordenar){
	
		$listar     = $this->db->prepare("SELECT * FROM ".$nombrelista." ORDER BY ".$campoordenar);
	
  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_lista_filtro($nombrelista,$campoordenar,$filtro,$formaordenar){
	
		//$sql= "SELECT * FROM ".$nombrelista." ".$filtro." ORDER BY ".$campoordenar." ".$formaordenar;
		//echo $sql;
		
		$listar     = $this->db->prepare("SELECT * FROM ".$nombrelista." ".$filtro." ORDER BY ".$campoordenar." ".$formaordenar);
	
  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_Consecutivo($filtro){
	
		//$filtro     = $_GET['filtro'];
	
		$listar     = $this->db->prepare("SELECT * FROM sigdoc_area WHERE id = '$filtro'");
		
		$resultado  = $listar->execute();

		$fila       = $resultado->fetch();
		$sigla      = $fila[sigla];
		$contador   = $fila[contador];
		
		$cadenadatos = $sigla."//////".$contador;

		return $cadenadatos;
		
  		//return $listar;
	
	}
	
	public function get_datos_documentos(){
		$id     = trim($_GET['id']);
		//$listar = $this->db->prepare("SELECT * FROM documentos_internos WHERE id = '$id'");
		$listar = $this->db->prepare("SELECT di.id,di.numero,ptd.id AS idtipodoc,ptd.nombre_tipo_documento,ptd.partesdocumento,
		                              di.dirigidoa,di.nombre,di.direccion,di.ciudad,di.fechageneracion,di.asunto,di.partes,
									  doc.id AS iddoc,di.idtipodocumento, di.fechaauto
									  FROM ((documentos_internos di INNER JOIN pa_tipodocumento ptd ON di.idtipodocumento = ptd.id) 
									  INNER JOIN pa_documento doc ON ptd.iddocumento = doc.id)
								      WHERE di.id = '$id'");
  		$listar->execute();
  		return $listar;
	}
	
	public function get_datos_documentos_popupbox($id){
	
		//$id     = trim($_GET['id']);
	
		//$listar = $this->db->prepare("SELECT * FROM documentos_internos WHERE id = '$id'");
		
		$listar = $this->db->prepare("SELECT di.id,di.numero,ptd.id AS idtipodoc,ptd.nombre_tipo_documento,ptd.partesdocumento,
		                              di.dirigidoa,di.nombre,di.direccion,di.ciudad,di.fechageneracion,di.asunto,di.partes,
									  doc.id AS iddoc,di.idtipodocumento
									  FROM ((documentos_internos di INNER JOIN pa_tipodocumento ptd ON di.idtipodocumento = ptd.id) 
									  INNER JOIN pa_documento doc ON ptd.iddocumento = doc.id)
								      WHERE di.id = '$id'");
		
  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_documentos_salientes_usuario($identrada,$idsql){
	
		$idusuario  = $_SESSION['idUsuario'];
		
		if($identrada == 1){
		
			//NOTA: SE CAMBIA LA SQL PARA PODER OBSERVAR Y FILTRAR POR LA CEDULA DE UNA PARTE
			
			//LISTA TODOS LOS DOCUMENTOS (SI ESTE USUARIO TIENE PERMISO EN LA TABLA pa_usuario_acciones)  
			if ($idsql == 1){
				
				/*$sql = "SELECT rds.id,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.direccion,rds.ciudad,
						rds.fechageneracion,rds.fechaauto,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
						do.nombre_documento AS documento,ubi.radicado,rds.descorrecion,rds.idautocorrige
						FROM ((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
						LEFT JOIN pa_documento do ON td.iddocumento = do.id)
						LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
						LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
					    LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
						LEFT JOIN signot_proceso ubi ON rds.idradicado = ubi.id)
						ORDER BY rds.id DESC
						LIMIT 10";*/
						
						
				/*$sql = "SELECT rds.id,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,part.cedula,rds.nombre,rds.direccion,rds.ciudad,
						rds.fechageneracion,rds.fechaauto,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
						do.nombre_documento AS documento,ubi.radicado,rds.fechaautocorrige,rds.descorrecion,rds.idautocorrige,rds.idautonotifica,
						rds.idtipodocumento,ubi.iddevolucion
						FROM (((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
						LEFT JOIN pa_documento do ON td.iddocumento = do.id)
						LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
						LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
						LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
						LEFT JOIN signot_proceso ubi ON rds.idradicado = ubi.id)
						LEFT JOIN signot_parte part ON part.id = rds.idparte)
						ORDER BY rds.id DESC
						LIMIT 10";*/
						
				//NOTA: EN ESTA NUEVA SQL SE AGRAGA EL JUZGADO Y CLASE DE PROCESO
				$sql = "SELECT rds.id,rds.idtipodocumento,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,part.cedula,rds.nombre,rds.direccion,rds.ciudad,
						rds.fechageneracion,rds.fechaauto,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
						do.nombre_documento AS documento,ubi.radicado,rds.fechaautocorrige,rds.descorrecion,rds.idautocorrige,rds.idautonotifica,
						rds.idtipodocumento,ubi.iddevolucion,pjuz.nombre AS jo,pcla.nombre_proceso
						FROM (((((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
						LEFT JOIN pa_documento do ON td.iddocumento = do.id)
						LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
						LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
						LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
						LEFT JOIN signot_proceso ubi ON rds.idradicado = ubi.id)
						LEFT JOIN signot_parte part ON part.id = rds.idparte)
						LEFT JOIN pa_juzgado pjuz ON pjuz.id = ubi.idjuzgadoorigen)
						LEFT JOIN signot_pa_clase_proceso pcla ON pcla.id = ubi.idclaseproceso)
						ORDER BY rds.id DESC
						LIMIT 10";
						
						
			}
			//LISTA SOLO LOS DOCUMENTOS DEL USUARIO EN SESION
			if ($idsql == 0){
				
				$sql = "SELECT rds.id,rds.idtipodocumento,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,part.cedula,rds.nombre,rds.direccion,rds.ciudad,
						rds.fechageneracion,rds.fechaauto,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
						do.nombre_documento AS documento,ubi.radicado,rds.fechaautocorrige,rds.descorrecion,rds.idautocorrige,rds.idautonotifica,
						rds.idtipodocumento,ubi.iddevolucion,pjuz.nombre AS jo,pcla.nombre_proceso
						FROM (((((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
						LEFT JOIN pa_documento do ON td.iddocumento = do.id)
						LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
						LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
						LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
						LEFT JOIN signot_proceso ubi ON rds.idradicado = ubi.id)
						LEFT JOIN signot_parte part ON part.id = rds.idparte)
						LEFT JOIN pa_juzgado pjuz ON pjuz.id = ubi.idjuzgadoorigen)
						LEFT JOIN signot_pa_clase_proceso pcla ON pcla.id = ubi.idclaseproceso)
						WHERE rds.idusuario = '$idusuario'
						ORDER BY rds.id DESC
						LIMIT 10";
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
			$filtro13;
			$filtro14;
			
			
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
			$datox13   = trim($_GET['datox13']);
			$datox14   = trim($_GET['datox14']);
			
			
			
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
			
				$filtro5 = " AND rds.direccion LIKE '%$datox5%' ";
			
			}
			if ( !empty($datox6) ) {
			
				$filtro6 = " AND rds.ciudad LIKE '%$datox6%' ";
			
			}
			if ( !empty($datox7) ) {
			
				//$filtro8 = " AND rds.asunto = '$datox8' ";
				$filtro7 = " AND rds.asunto LIKE '%$datox7%' ";
			
			}
			if ( !empty($datox8) ) {
			
				$filtro8 = " AND rds.id = '$datox8' ";
			
			}
			if ( !empty($datox9) ) {
			
				$filtro9 = " AND do.id = '$datox9' ";
			
			}
			
			if ( !empty($datox10) ) {
			
				
				$filtro10 = " AND ubi.radicado LIKE '%$datox10%' ";
			
			}
			
			if ( !empty($datox12) ) {
			
				
				$filtro12 = " AND part.cedula LIKE '%$datox12%' ";
			
			}
			
			if ( !empty($datox13) ) {
			
				
				$filtro13 = " AND part.nombre LIKE '%$datox13%' ";
			
			}
			
			if ( !empty($datox14) ) {
			
				
				$filtro14 = " AND ubi.idjuzgadoorigen = '$datox14' ";
			
			}
			
	
			//$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtro10." ".$filtro11." ".$filtrof;*/
			
			//echo $filtrox;
			 
			 //LISTA TODOS LOS DOCUMENTOS (SI ESTE USUARIO TIENE PERMISO EN LA TABLA pa_usuario_acciones)  
			 if ($idsql == 1){
			 
			 	
				//SI EL USUARIO QUE PUEDE VER TODOS LOS REGISTROS FILTRA POR UN USUARIO ESPECIFICO
			 	if ( !empty($datox11) ) {
			
					$filtro11 = " AND rds.idusuario = '$datox11' ";
				
					$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtro10." ".$filtro11." ".$filtro12." ".$filtro13." ".$filtro14." ".$filtrof;
			
				}
				else{
					
					$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtro10." ".$filtro12." ".$filtro13." ".$filtro14." ".$filtrof;
				}
				
				
			 
				$sql = "SELECT rds.id,rds.idtipodocumento,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,part.cedula,rds.nombre,rds.direccion,rds.ciudad,
						rds.fechageneracion,rds.fechaauto,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
						do.id AS iddoc,do.nombre_documento AS documento,ubi.radicado,rds.fechaautocorrige,rds.descorrecion,
						rds.idautocorrige,rds.idautonotifica,rds.idtipodocumento,ubi.iddevolucion,pjuz.nombre AS jo,pcla.nombre_proceso
						FROM (((((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
						LEFT JOIN pa_documento do ON td.iddocumento = do.id)
						LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
						LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
						LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
						LEFT JOIN signot_proceso ubi ON rds.idradicado = ubi.id)
						LEFT JOIN signot_parte part ON part.id = rds.idparte)
						LEFT JOIN pa_juzgado pjuz ON pjuz.id = ubi.idjuzgadoorigen)
						LEFT JOIN signot_pa_clase_proceso pcla ON pcla.id = ubi.idclaseproceso)
						WHERE rds.id >= '1'" .$filtrox. " 
						ORDER BY rds.id DESC";
						
				//echo $sql;
			 }
			 
			 //LISTA SOLO LOS DOCUMENTOS DEL USUARIO EN SESION
			 //else{
			 if ($idsql == 0){
			 
			 	$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtro10." ".$filtro12." ".$filtro13." ".$filtro14." ".$filtrof;
			
			 	$sql = "SELECT rds.id,rds.idtipodocumento,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,part.cedula,rds.nombre,rds.direccion,rds.ciudad,
						rds.fechageneracion,rds.fechaauto,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita,
						do.id AS iddoc,do.nombre_documento AS documento,ubi.radicado,rds.fechaautocorrige,rds.descorrecion,
						rds.idautocorrige,rds.idautonotifica,rds.idtipodocumento,ubi.iddevolucion,pjuz.nombre AS jo,pcla.nombre_proceso
						FROM (((((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
						LEFT JOIN pa_documento do ON td.iddocumento = do.id)
						LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
						LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
						LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
						LEFT JOIN signot_proceso ubi ON rds.idradicado = ubi.id)
						LEFT JOIN signot_parte part ON part.id = rds.idparte)
						LEFT JOIN pa_juzgado pjuz ON pjuz.id = ubi.idjuzgadoorigen)
						LEFT JOIN signot_pa_clase_proceso pcla ON pcla.id = ubi.idclaseproceso)
						WHERE rds.id >= '1'" .$filtrox. " AND rds.idusuario = '$idusuario'
						ORDER BY rds.id DESC";
			 }
			
			//echo $identrada."**************".$idsql."**************".$sql;
			
			$listar    = $this->db->prepare($sql);
		}

  		$listar->execute();

  		return $listar;
	
  	}
	
	public function get_siglas($tipodocumento){
	
		$listar  = $this->db->prepare("SELECT d.sigla AS siglas,d.nombre_documento
									   FROM (pa_tipodocumento td INNER JOIN pa_documento d ON td.iddocumento = d.id)
									   WHERE td.id = '$tipodocumento'");

  		$listar->execute();

  		return $listar;

	}
	
	public function registrar_documentos(){

		$modelo       = new documentosModel();
		$numdocumento = $modelo->validar_numero(trim($_POST['ndocumento']));
		
		$yearcompleto = $modelo->get_ano_completo();
		
		//SE VALIDA QUE EL NUMERO DE DOCUMENTO NO EXISTA EN EL SISTEMA Y PUEDA SER REGISTRADO
		//if($numdocumento == 0){
		
		
			//SE OBTIENEN LOS DATOS
			
			$idusuario     = $_SESSION['idUsuario'];
			$consecutivodocumento = trim($_POST['consecutivodocumento']);
			
			//VARIABLE QUE MANEJA EL INSERT O UPDATE DE UN NUEVO DOCUMENTO
			$iddocumento   = trim($_POST['iddocumento']);
			
			$idparte       = trim($_POST['idparte']);
			$iddir         = trim($_POST['iddir']);
			$idclaseparte  = trim($_POST['idclaseparte']);
			
			//SE REALIZA ESTA PREGUNTA YA QUE PUEDE QUE EL USUARIO NO VISUALICE UNA PARTE DEL PROCESO
			//EN LA VISTA documentos_generar.php AL MOMENTO DE DIGITAR EL RADICADO DAR CLIC AFUERA
			//Y CARGAR LA INFORMACION COMO JUZGADO ORIGEN, CLASE DE PROCESO Y SUS PARTES
			//PERO PUEDE GENERAR EL DOCUMENTO, BASICAMENTE PARA QUE EL SISTEMA NO GENERE UNA INCOSISTENCIA
			//if($idparte == ""){
			if (empty($idparte)) {
				$idparte   = 0;
			}
			
			$idr 		   = trim($_POST['idr']);
			
			$documento     = trim($_POST['documento']);
			$tipodocumento = trim($_POST['tipodocumento']);
			
			
			$nombrelista        = 'pa_tipodocumento';
			$campoordenar       = 'nombre_tipo_documento';
			$filtro             = "WHERE id IN(".$tipodocumento.")";
			$formaordenar       = 'ASC';
			$datostipodocumento = $modelo->get_lista_filtro($nombrelista,$campoordenar,$filtro,$formaordenar);
			$row                = $datostipodocumento->fetch();
			
			$nomdoc     = $modelo->get_siglas($tipodocumento);
			$row2       = $nomdoc->fetch();
			$nomdoc     = $row2[nombre_documento];
			
		
			$ndocumento    = trim($_POST['ndocumento']);
			//$siglas        = trim($_POST['siglas']);
			
			$dirigidoa     = trim($_POST['dirigidoa']);
			$nombre        = trim($_POST['nombre']);
			$direccion     = trim($_POST['direccion']);
			$ciudad        = trim($_POST['ciudad']);
			$fechag        = trim($_POST['fechag']);
			$fechaauto     = trim($_POST['fechaauto']);
			$asunto        = trim($_POST['asunto']);
			$detalleds     = utf8_encode(trim($_POST['detalleds']));
			
			//SE PREGUNTA SI ES UNA DEVOLUCINO X CORREO
			//PARA CONCATENAR A LA ANOTACION EL MOTIVO POR EL CUAL SE
			//REALIZA LA DEVOLUCION.
			if($tipodocumento == 40){
			
				$motivodevolucion = trim($_POST['parte3']);
				
				$anotacion        = "SE REGISTRA DOCUMENTO: ".$nomdoc." TIPO DOCUMENTO: ".$row[nombre_tipo_documento].
			                        ", PARTE DEL PROCESO: ".$nombre.", FECHA REGISTRO: ".$fechag.", FECHA AUTO: ".$fechaauto.
								    ", MOTIVO DEVOLUCION: ".$motivodevolucion;
			}
			else{
			
				$anotacion          = "SE REGISTRA DOCUMENTO: ".$nomdoc." TIPO DOCUMENTO: ".$row[nombre_tipo_documento].
			                          ", PARTE DEL PROCESO: ".$nombre.", FECHA REGISTRO: ".$fechag.", FECHA AUTO: ".$fechaauto;
								      
									  
		   }
								  
								  
			//----------------------------IDENTIFICAR QUE EL DOCUEMNTO ES UNA DEVOLUCION----------------------------
			$campos              = 'idtabla';
			$nombrelista         = 'pa_modulo_acciones';
			$idaccion			 = '7';
			$campoordenar        = 'id';
			$datosmodulos        = $modelo->get_lista_modulos_acciones($campos,$nombrelista,$idaccion,$campoordenar);
			$modulost1           = $datosmodulos->fetch();
			$modulost2			 = explode("////",$modulost1[idtabla]);
			//------------------------------------------------------------------------------------------------------
			
			//OBTENGO CUANTAS PARTES MAS SE LE AGREGO AL DOCUMENTO CON INPUT TEXT
			//Y TOMO SU VALOR LOS CONCATENO Y LOS PASO A LA VARIABLE $partesdocumento
			//PARA SER REGISTRADOS A LA BASE DE DATOS
			$partesdoc     = trim($_POST['partesdoc']);
			$i = 0;
			while($i <= $partesdoc){
			
				$partesdocumento = $partesdocumento."//////".trim($_POST['parte'.$i]);
				
				$i = $i + 1;
			
			}
			
			//DATOS PARA EL REGISTRO DEL LOG
			
			$modelo     = new documentosModel();
			$fechahora  = $modelo->get_fecha_actual();
			$datosfecha = explode(" ",$fechahora);
			$fechalog   = $datosfecha[0];
			$horalog    = $datosfecha[1];
			
			
			//$tiporegistro = "Genera un Nuevo Documento";
			
			if( empty($iddocumento) ){
		
				$accion  = "Genera un Nuevo Documento En la Opcion de Documentos/Generar Documento, Sistema SIGNOT";
			}
			else{
			
				$accion  = "Modifica Documento En la Opcion de Documentos/Generar Documento, Sistema SIGNOT, ID DOCUMENTO: ".$iddocumento;
			}
			$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
			$tipolog = 6;
			
			try {  
			
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
					//EMPIEZA LA TRANSACCION
					$this->db->beginTransaction();
					
					
												 
					//NOTA: SE CIERRA LA SQL ANTERIOR Y SU TOMA ESTA, YA QUE ESTE SISTEMA EN LA TABLA documentos_internos
					//SI PUEDE EXISTIR DOCUMENTOS CON IGUAL numero, POR QUE EL USUARIO PUEDE CORREGIR UN DOCUMENTO
					//Y ESTE PROCESO CREA UN NUEVO REGISTRO EN documentos_internos PERO NO INCREMENTA EL CONTADOR DE DICHO
					//DCOUMENTO DE LA TABLA pa_documento PARA GENERAR UN NUEVO numero
					//ES DECIR NO ES EL MISMO FUNCIONAMIENTO QUE EL SISTEMA DE OFICIOS DEL SIEPRO
					//EL CUAL USA LA SQL CERRADA Y COMENTADA ANTERIORMENTE Y EL IF Y ELSE CERRADOS MAS ABAJO
					/*$listar = $this->db->prepare("SELECT MAX(di.numero) AS idmaximo,d.sigla AS siglas
												  FROM ((documentos_internos di
												  INNER JOIN pa_tipodocumento td ON di.idtipodocumento = td.id)
												  INNER JOIN pa_documento d ON td.iddocumento = d.id)
												  WHERE d.id = '$documento' AND di.aniodoc = '$yearcompleto'");
												  
												  //NOTA: SE USA MEJOR EL FILTRO CON  WHERE d.id = '$documento' YA QUE
												  //CON EL QUE SE CIERRA NO SE INCREMENTA EL CONTADOR DEL DOCUMENTO
												  //GENERANDO INCONSISTENCIA DE DOCUEMENTOS CON MISMO NUMERO EN LA 
												  //TABLA documentos_internos, SOLO TIENEN MISMO NUMERO LAS CITACIONES QUE SE
												  //LE REALIZA UNA CORRECION
												   
												  //WHERE di.idtipodocumento = '$tipodocumento'");
												  
												  //SE AGREGA LO DEL AÑO YA QUE CADA AÑO LOS CONSECUTIVOS DE LOS DOCUMENTOS SE DEBEN INICIALIZAR A CERO (0)
												  //CAMBIO DADO EL 13 DE ENERO 2016
	
					$listar->execute();
					
					$resultado = $listar->rowCount();
					
					
					if(!$resultado){//existe registros
	
						$field = $listar->fetch();
					
						$numeroconsecutivo = explode("-",$field[idmaximo]);
						$consecutivo       = $numeroconsecutivo[1] + 1; 
						
						if($consecutivo >= 0 && $consecutivo <= 9) {$consecutivo = "00".$consecutivo;}
						if($consecutivo >  9 && $consecutivo <= 99){$consecutivo = "0".$consecutivo;}
						
						$ndocumento        = $numeroconsecutivo[0]."-".$consecutivo;
					
					}
					else{//no existe registro, Y SE DEBE CONSTRUIR EL CONSECUTIVO CON LAS SIGLAS Y EL AÑO YA QUE LOS DATOS EN LA TABLA
						 //documentos_internos SON NULL Y EL NUMERO QUEDARIA DE ESTA FORMA -001,-002 
					
						$field = $listar->fetch();
						
						//$datosiglas = $field[siglas];
						
						$year  = $modelo->get_ano();
						
						$numeroconsecutivo = explode("-",$field[idmaximo]);
						$consecutivo       = $numeroconsecutivo[1] + 1; 
						
						if($consecutivo >= 0 && $consecutivo <= 9) {$consecutivo = "00".$consecutivo;}
						if($consecutivo >  9 && $consecutivo <= 99){$consecutivo = "0".$consecutivo;}
						
						
						//NOTA: SE REALIZA ESTA FUNCION PARA OBTENER LAS SIGLAS DEL TIPO DE DOCUMENTO
						$datosiglas = $modelo->get_siglas($tipodocumento);
						$row        = $datosiglas->fetch();
						$siglasdoc  = $row[siglas];
						
						$ndocumento = $siglasdoc."".$year."-".$consecutivo;
					
			
					}*/

					/*SE REALIZA ESTE CAMBIO PARA REDUCIR LOS TIEMPOS EN LA GENERACION DE UN DOCUMENTO YA
					QUE LA CONSULTA ANTERIOR SE DEMORA MAS QUE REALIZAR UNA SOLA CONSULTA A UNA TABLA EN ESTE CASO A pa_documento,
					Y AL IR INCREMENTANDOSE LA CANTIDAD DE REGISTROS DE UN TIPO DE DOCUMENTO ESPECIFICO EN documentos_internos
					EL TIEMPO AUMENTA EN LA GENRACION DE UN NUEVO DOCUMENTO, YA QUE SE TOMA MAYOR CANTIDAD DE TIEMPO
					AL CONSULTAR EL MAXIMO DE ESE DOCUMENTO PARA PODER CONSTRUIR EL VALOR EN $ndocumento*/
					$listar = $this->db->prepare("SELECT MAX(d.id) AS idmaximo,d.sigla,d.contador
												  FROM pa_documento d
												  WHERE d.id = $documento");
												  
					$listar->execute();
					
					$resultado = $listar->rowCount();
					
					$field = $listar->fetch();
						
					$year  = $modelo->get_ano();
						
					$numeroconsecutivo = $field[contador];
					$consecutivo       = $numeroconsecutivo + 1; 
						
					if($consecutivo >= 0 && $consecutivo <= 9) {$consecutivo = "00".$consecutivo;}
					if($consecutivo >  9 && $consecutivo <= 99){$consecutivo = "0".$consecutivo;}
						
					$ndocumento        = $field[sigla]."".$year."-".$consecutivo;
					
					//---------------------------------------------------------------------------------------------------------------------------------------------------
				
					
					if( empty($iddocumento) ){
					
						
						$this->db->exec("INSERT INTO documentos_internos (idparte,idradicado,idusuario,idusuarioedita,idtipodocumento,numero,dirigidoa,nombre,direccion,ciudad,
										 fechageneracion,fechaauto,fechaedita,asunto,contenido,partes,descorrecion,idautocorrige,aniodoc)
										 VALUES ('$idparte','$idr','$idusuario',0,'$tipodocumento','$ndocumento','$dirigidoa','$nombre','$direccion','$ciudad','$fechag','$fechaauto','0000-00-00',
										 '$asunto','$detalleds','$partesdocumento','',0,'$yearcompleto')");
						
						//OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA documentos_internos
						$lastId    = $this->db->lastInsertId();
						$anotacion = $anotacion.", ID DOCUMENTO: ".$lastId; 
						
						//*******************************************************************************************************************************
						//CAPTURO LOS DATOS DE LA SIGLA, EL AÑO ACTUAL Y ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA documentos_internos
						//RECIBIDOS DEL CAMPO siglas DE LA VISTA documentos_generar.php
						//ESTO CON EL OBJETO DE COSNTRUIR UN NUMERO UNICO DE DOCUMENTO
						//EN LA TABLA documentos_internos CAMPO numero, BASADO EN EL CAMPO id
						//DE ESE DOCUMENTO, YA QUE SIN ESTA VALIDACION NO SE REALIZA, AL ESCOGER CUALQUIER TIPO DE DOCUMENTO
						//EL SISTEMA AUTOMATICAMENTE ASIGNA Numero Documento: XXXX DEPENDIENDO DE DONDE ESTE PARADO EL CONTADOR
						//DE CADA DOCUMENTO DE LA TABLA pa_tipodocumento, Y SE PRESENTA QUE SI DE UN PC SE ESCOGE UN OFICIO
						//Y SU CONTADOR ESTA EN 3 PASARIA A LA SIGUIENTE FORMA Numero Documento: OECMO15-004, Y SI AUN NO SE A DADO
						//CLIC EN REGISTRAR Y DESDE OTRO PC SE ESCOGE TAMBIEN TIPO DE DOCUMENTO OFICIO EL SISTEMA ARMA
						//EL Numero Documento: OECMO15-004 IGUAL Y AL DARSE CLIC EN REGISTRAR EN AMBOS PC, OBTENDREMOS UN DOCUMENTO
						//CON IGUAL Numero Documento
						
						//OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA documentos_internos
						/*$lastId     = $this->db->lastInsertId();
						
						//ESTA FUNCION ME PERMITE ARMAR EL Numero Documento BASADO PERO EN EL 
						//ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA documentos_internos
						$modelo     = new documentosModel();
						$ndocumento = $modelo->traer_datos_consecutivo($siglas,$lastId);
						
						$this->db->exec("UPDATE documentos_internos SET numero = '$ndocumento' WHERE id = '$lastId'");*/
						
						//*******************************************************************************************************************************
						
						//$this->db->exec("UPDATE pa_documento SET contador = '$consecutivodocumento' WHERE id = '$documento'");
						
						$this->db->exec("UPDATE pa_documento SET contador = '$consecutivo' WHERE id = '$documento'");
						
						$this->db->exec("INSERT INTO signot_proceso_anotacion (idradicado,idusuario,fecha,hora,anotacion)
							             VALUES ('$idr','$idusuario','$fechalog','$horalog','$anotacion')");
						
						//PARA ACTUALIZAR UNA PARTE EN UN PROCESO Y SABER QUE ESTA EN ESTADO DE DEVOLUCION 
						//PERO DE ESA DIRECCION, YA QUE ANTES SE ACTUALIZABA TODA LA PARTE Y 
						//QUEDABAN EN DEVOLUCION TODAS SUS DIRECCIONES 
						if ( in_array($tipodocumento,$modulost2,true) ) { 
						
							/*$this->db->exec("UPDATE signot_parteproceso SET endevolucion = 'SI'
									         WHERE idproceso = '$idr' AND idparte = '$idparte' AND idclaseparte = '$idclaseparte'");*/
											 
							$this->db->exec("UPDATE signot_direccion SET endevolucion = 'SI'
									         WHERE id = '$iddir' AND idproceso = '$idr' AND idparte = '$idparte'");
						}
						
						
					}
					else{
						
						$this->db->exec("UPDATE documentos_internos SET dirigidoa = '$dirigidoa',nombre = '$nombre',direccion = '$direccion',
										 ciudad = '$ciudad',asunto = '$asunto',contenido = '$detalleds',
										 idusuarioedita = '$idusuario',fechaedita = '$fechalog'
										 WHERE id = '$iddocumento'");
									 
					}
					
					//$this->db->exec("UPDATE sigdoc_pa_consecutivo SET contador = '$consecutivodocumento' WHERE idtipodocumento = '$tipodocumento'");
								
					$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
					
				
				//SE TERMINA LA TRANSACCION  
				$this->db->commit();
				
				//echo "DATO: ".$tipodocumento;
				/*print'<script languaje="Javascript">location.href="index.php?controller=documentos&action=mensajes&nombre=2"</script>';*/
			  
			} 
			catch (Exception $e) {
			
				//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
				$this->db->rollBack();
				echo "Fallo: " . $e->getMessage();
				/*print'<script languaje="Javascript">location.href="index.php?controller=documentos&action=mensajes&nombre=2b"</script>';*/
			}
		
		/*}
		else{
			//echo "Numero de Documento ya Existe....";
			print'<script languaje="Javascript">location.href="index.php?controller=documentos&action=mensajes&nombre=5"</script>';
		}*/
		
		
  	}
	
	public function modificar_documentos(){

		//$modelo       = new documentosModel();
		//$numdocumento = $modelo->validar_numero(trim($_POST['ndocumento']));
		
		//SE VALIDA QUE EL NUMERO DE DOCUMENTO NO EXISTA EN EL SISTEMA Y PUEDA SER REGISTRADO
		//if($numdocumento == 0){
		
		
			//SE OBTIENEN LOS DATOS
			
			$idusuario     = $_SESSION['idUsuario'];
			//$consecutivodocumento = trim($_POST['consecutivodocumento']);
			
			//VARIABLE QUE MANEJA EL INSERT O UPDATE DE UN NUEVO DOCUMENTO
			$iddocumento   = trim($_POST['iddocumento']);
			
			//$idr 		   = trim($_POST['idr']);
			
			//$documento     = trim($_POST['documento']);
			//$tipodocumento = trim($_POST['tipodocumento']);
			
			$ndocumento    = trim($_POST['ndocumento']);
			//$siglas        = trim($_POST['siglas']);
			
			$dirigidoa     = trim($_POST['dirigidoa']);
			$nombre        = trim($_POST['nombre']);
			$direccion     = trim($_POST['direccion']);
			$ciudad        = trim($_POST['ciudad']);
			$fechag        = trim($_POST['fechag']);
			$asunto        = trim($_POST['asunto']);
			// Juan Esteban Munera Betancur Julio 2017
			$fecha_auto	   = trim($_POST['fecha_auto']);
			$tipodocumento = trim($_POST['iddocumentox']);
			//$detalleds     = utf8_encode(trim($_POST['detalleds']));
			
			//OBTENGO CUANTAS PARTES MAS SE LE AGREGO AL DOCUMENTO CON INPUT TEXT
			//Y TOMO SU VALOR LOS CONCATENO Y LOS PASO A LA VARIABLE $partesdocumento
			//PARA SER REGISTRADOS A LA BASE DE DATOS
			$partesdoc     = trim($_POST['partesdoc']);
			$i = 0;
			while($i <= $partesdoc){
			
				$partesdocumento = $partesdocumento."//////".trim($_POST['parte'.$i]);
				
				$i = $i + 1;
			
			}
				
			//DATOS PARA EL REGISTRO DEL LOG
			
			$modelo     = new documentosModel();
			$fechahora  = $modelo->get_fecha_actual();
			$datosfecha = explode(" ",$fechahora);
			$fechalog   = $datosfecha[0];
			$horalog    = $datosfecha[1];
			
			
			//$tiporegistro = "Genera un Nuevo Documento";
			
			if( empty($iddocumento) ){
		
				$accion  = "Genera un Nuevo Documento En la Opcion de Documentos/Generar Documento, Sistema SIGNOT";
			}
			else{
			
				$accion  = "Modifica Documento, Sistema SIGNOT, ID DOCUMENTO: ".$iddocumento." Numero: ".$ndocumento;
			}
			$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
			$tipolog = 6;
			
			try {  
			
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
					//EMPIEZA LA TRANSACCION
					$this->db->beginTransaction();
					
					/*$this->db->exec("UPDATE documentos_internos SET dirigidoa = '$dirigidoa',nombre = '$nombre',direccion = '$direccion',
									 ciudad = '$ciudad',fechageneracion = '$fechag',asunto = '$asunto',
									 idusuarioedita = '$idusuario',fechaedita = '$fechalog',
									 partes = '$partesdocumento'
									 WHERE id = '$iddocumento'");*/
									 
					 
					
					//NO SE MODIFICA LA fechageneracion = '$fechag', YA QUE ESTA GUARDA LA FECHA DE CREACION DEL DOCUMENTO
					//POR ESO SE CIERRA LA SQL ANTERIOR
					$this->db->exec("UPDATE documentos_internos SET dirigidoa = '$dirigidoa',nombre = '$nombre',direccion = '$direccion',
									 ciudad = '$ciudad',fechaauto = '$fecha_auto',asunto = '$asunto',
									 idusuarioedita = '$idusuario',fechaedita = '$fechalog',
									 partes = '$partesdocumento'
									 WHERE id = '$iddocumento'");
					
			
					$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
					
				
				//SE TERMINA LA TRANSACCION  
				$this->db->commit();
				
				print'<script languaje="Javascript">location.href="index.php?controller=documentos&action=mensajes&nombre=6"</script>';
			  
			} 
			catch (Exception $e) {
			
				//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
				$this->db->rollBack();
				//echo "Fallo: " . $e->getMessage();
				print'<script languaje="Javascript">location.href="index.php?controller=documentos&action=mensajes&nombre=6b"</script>';
			}
		
		/*}
		else{
			//echo "Numero de Documento ya Existe....";
			print'<script languaje="Javascript">location.href="index.php?controller=documentos&action=mensajes&nombre=5"</script>';
		}*/
		
		
  	}
	
	public function get_datos_documento($id_documento){
	
		$listar  = $this->db->prepare("SELECT * FROM documentos_internos WHERE id = '$id_documento'");

  		$listar->execute();

  		return $listar;

	}
	
	public function registrar_documentos_especiales(){

			$modelo     = new documentosModel();
			
			$yearcompleto = $modelo->get_ano_completo();
			
			//SE OBTIENEN LOS DATOS
			$idusuario     = $_SESSION['idUsuario'];
			
			//VARIABLE QUE MANEJA EL INSERT O UPDATE DE UN NUEVO DOCUMENTO
			$iddocumento   = trim($_POST['iddocumento']);
			
			$idautonotifica = trim($_GET['id']);
			$datosdocumento = $modelo->get_datos_documento( trim($_GET['id']) );
			$row            = $datosdocumento->fetch();
			
			$idparte        = $row[idparte];
			$idr 		    = $row[idradicado];
		
			$documento      = trim($_GET['documento']);
			$tipodocumento  = trim($_GET['idtipodocumento']);
			//$tipodocumento  = $row[idtipodocumento];
			
			$nombrelista        = 'pa_tipodocumento';
			$campoordenar       = 'nombre_tipo_documento';
			$filtro             = "WHERE id IN(".$tipodocumento.")";
			$formaordenar       = 'ASC';
			$datostipodocumento = $modelo->get_lista_filtro($nombrelista,$campoordenar,$filtro,$formaordenar);
			$row2                = $datostipodocumento->fetch();
			
			$nomdoc     = $modelo->get_siglas($tipodocumento);
			$row3       = $nomdoc->fetch();
			$nomdoc     = $row3[nombre_documento];
			
			//$anotacion          = "SE REGISTRA DOCUMENTO: ".$nomdoc." TIPO DOCUMENTO: ".$row2[nombre_tipo_documento];
			
			$ndocumento    = $row[numero];
			
			$dirigidoa     = $row[dirigidoa];
			$nombre        = $row[nombre];
			$direccion     = $row[direccion];
			$ciudad        = $row[ciudad];
			$fechag        = $row[fechageneracion];
			$fechaauto     = $row[fechaauto];
			$asunto        = $row[asunto];
			//$detalleds     = utf8_encode(trim($_POST['detalleds']));
			$detalleds     = "X";
			
			$fechaautocorrige = $row[fechaautocorrige];
			
			//NUEVO SE ASIGA EL 13 DE ABRIL 2016, YA QUE SE INCLUYE EN LA ANOTACION A QUIEN SE LE REALIZA EL DOCUMENTO
			if(is_null($fechaautocorrige)){
		
				$anotacion = "SE REGISTRA DOCUMENTO: ".$nomdoc." TIPO DOCUMENTO: ".$row2[nombre_tipo_documento].
			                 ", PARTE DEL PROCESO: ".$nombre.", FECHA REGISTRO: ".$fechag.", FECHA AUTO: ".$fechaauto;
			}
			else{
			
				$anotacion = "SE REGISTRA DOCUMENTO: ".$nomdoc." TIPO DOCUMENTO: ".$row2[nombre_tipo_documento].
			                 ", PARTE DEL PROCESO: ".$nombre.", FECHA REGISTRO: ".$fechag.", FECHA AUTO: ".$fechaauto.", FECHA AUTO QUE CORRIGE: ".$fechaautocorrige;
			}
			
			
			
			//SE REALIZA ESTA VALIDACION YA QUE EL SISTEMA AL GRABAR ME GENERA UNA INCONSISTENCIA
			//POR EL VALOR DE LA FECHA QUE ES NULL
			//Fallo: SQLSTATE[22007]: Invalid datetime format: 1292 Incorrect date value: '' for column 'fechaautocorrige'
			/*if(is_null($fechaautocorrige)){
				
				$fechaautocorrige = NULL;
				
			}
			else{
				$fechaautocorrige = $row[fechaautocorrige];
			}*/
			
			$descorrecion     = $row[descorrecion];
			
			//$partesdoc     = trim($row[partes]);
	
			$partesdocumento = trim($_GET['partesdoc']);
			//OBTENGO CUANTAS PARTES MAS SE LE AGREGO AL DOCUMENTO CON INPUT TEXT
			//Y TOMO SU VALOR LOS CONCATENO Y LOS PASO A LA VARIABLE $partesdocumento
			//PARA SER REGISTRADOS A LA BASE DE DATOS
			/*$partesdoc = trim($_GET['partesdoc']);
			$i = 0;
			while($i <= $partesdoc){
			
				$partesdocumento = $partesdocumento."//////".trim($_POST['parte'.$i]);
				
				$i = $i + 1;
			
			}*/
			
			
			//DATOS PARA EL REGISTRO DEL LOG
			
			//$modelo     = new documentosModel();
			$fechahora  = $modelo->get_fecha_actual();
			$datosfecha = explode(" ",$fechahora);
			$fechalog   = $datosfecha[0];
			$horalog    = $datosfecha[1];
			
			
			//$tiporegistro = "Genera un Nuevo Documento";
			
			if( empty($iddocumento) ){
		
				$accion  = "Genera un Nuevo Documento En la Opcion de Documentos/Generar Documento, Sistema SIGNOT";
			}
			else{
			
				$accion  = "Modifica Documento En la Opcion de Documentos/Generar Documento, Sistema SIGNOT, ID DOCUMENTO: ".$iddocumento;
			}
			$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
			$tipolog = 6;
			
			try {  
			
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
					//EMPIEZA LA TRANSACCION
					$this->db->beginTransaction();
					
					//CAPTURO EL MAXIMO DEL CAMPO numero PARA DETERMINAR QUE CONSECUTIVO DEBE ARMARSE
					//PARA EL SIGUIENTE TIPO DE DOCUMENTO, YA QUE SI EL CONTADOR DE LA TABLA sigdoc_pa_consecutivo
					//VA EN 5 Y SI DOS USUARIOS ENRAN AL MISMO TIEMPO Y ESCOGEN TIPO DOCUMENTO OFICIO
					//SALE EN Numero Documento: CSJCF15-005 PARA AMBOS Y AL REGISTRAR CADA UNO
					//QUEDA EN LA TABLA sigdoc_documentos_internos DOS DOCUMENTOS CON EL MISMO NUMERO
					//PARA SE RECONSTRUYO EL CONSECUTIVO CON LO MENCIONADO ANTERIORMENTE, ACTUALIZANDO LA VARIABLE $ndocumento
					//QUE ES LA QUE RECIBE EL CONSECUTIVO INICIAL DE LA VISTA sigdoc_documentos_salientes.php	
					//Y ACTUALIZAMOS DE LA TABLA pa_documento LA COLUMNA contador, ESTE DATO TAMBIENDEBE RECOSTRUIRSE
					//PASA DE $consecutivodocumento A $consecutivo
					/*$listar = $this->db->prepare("SELECT MAX(di.id) AS idmaximo,di.numero,d.sigla
												  FROM ((documentos_internos di INNER JOIN pa_tipodocumento td ON di.idtipodocumento = td.id)
												  INNER JOIN pa_documento d ON td.iddocumento = d.id)
												  WHERE di.id IN(
													  SELECT MAX(di.id) AS idmaximo
													  FROM ((documentos_internos di INNER JOIN pa_tipodocumento td ON di.idtipodocumento = td.id)
													  INNER JOIN pa_documento d ON td.iddocumento = d.id) WHERE d.id = '$documento'
												  )
												  AND d.id = '$documento'");
												  
					
					$listar->execute();
					
					$resultado = $listar->rowCount();

					if(!$resultado){//existe registros
	
						$field = $listar->fetch();
					
						$numeroconsecutivo = explode("-",$field[numero]);
						$consecutivo       = $numeroconsecutivo[1] + 1; 
						
						if($consecutivo >= 0 && $consecutivo <= 9) {$consecutivo = "00".$consecutivo;}
						if($consecutivo >  9 && $consecutivo <= 99){$consecutivo = "0".$consecutivo;}
						
						$ndocumento        = $numeroconsecutivo[0]."-".$consecutivo;
					}
					else{//no existe registro, Y SE DEBE CONSTRUIR EL CONSECUTIVO CON LAS SIGLAS Y EL AÑO YA QUE LOS DATOS EN LA TABLA
						 //documentos_internos SON NULL Y EL NUMERO QUEDARIA DE ESTA FORMA -001,-002 
					
						$field = $listar->fetch();
						
						$year  = $modelo->get_ano();
						
						$numeroconsecutivo = explode("-",$field[numero]);
						$consecutivo       = $numeroconsecutivo[1] + 1; 
						
						if($consecutivo >= 0 && $consecutivo <= 9) {$consecutivo = "00".$consecutivo;}
						if($consecutivo >  9 && $consecutivo <= 99){$consecutivo = "0".$consecutivo;}
						
						$ndocumento        = $field[sigla]."".$year."-".$consecutivo;
			
					}*/
					
					/*SE REALIZA ESTE CAMBIO PARA REDUCIR LOS TIEMPOS EN LA GENERACION DE UN DOCUMENTO YA
					QUE LA CONSULTA ANTERIOR SE DEMORA MAS QUE REALIZAR UNA SOLA CONSULTA A UNA TABLA EN ESTE CASO A pa_documento,
					Y AL IR INCREMENTANDOSE LA CANTIDAD DE REGISTROS DE UN TIPO DE DOCUMENTO ESPECIFICO EN documentos_internos
					EL TIEMPO AUMENTA EN LA GENRACION DE UN NUEVO DOCUMENTO, YA QUE SE TOMA MAYOR CANTIDAD DE TIEMPO
					AL CONSULTAR EL MAXIMO DE ESE DOCUMENTO PARA PODER CONSTRUIR EL VALOR EN $ndocumento*/
					$listar = $this->db->prepare("SELECT MAX(d.id) AS idmaximo,d.sigla,d.contador
												  FROM pa_documento d
												  WHERE d.id = $documento");
												  
					$listar->execute();
					
					$resultado = $listar->rowCount();
					
					$field = $listar->fetch();
						
					$year  = $modelo->get_ano();
						
					$numeroconsecutivo = $field[contador];
					$consecutivo       = $numeroconsecutivo + 1; 
						
					if($consecutivo >= 0 && $consecutivo <= 9) {$consecutivo = "00".$consecutivo;}
					if($consecutivo >  9 && $consecutivo <= 99){$consecutivo = "0".$consecutivo;}
						
					$ndocumento        = $field[sigla]."".$year."-".$consecutivo;
					
					//---------------------------------------------------------------------------------------------------------------------------------------------------
				
					
					if( empty($iddocumento) ){
					
						 //SE REALIZA ESTA VALIDACION YA QUE EL SISTEMA AL GRABAR ME GENERA UNA INCONSISTENCIA
			            //POR EL VALOR DE LA FECHA QUE ES NULL
			            //Fallo: SQLSTATE[22007]: Invalid date
						if(is_null($fechaautocorrige)){
						
							$this->db->exec("INSERT INTO documentos_internos (idparte,idradicado,idusuario,idusuarioedita,idtipodocumento,numero,
											 dirigidoa,nombre,direccion,ciudad,fechageneracion,fechaauto,fechaedita,asunto,contenido,partes,
											 descorrecion,idautocorrige,idautonotifica,aniodoc)
											 VALUES ('$idparte','$idr','$idusuario',0,'$tipodocumento','$ndocumento','$dirigidoa','$nombre','$direccion',
											 '$ciudad','$fechalog','$fechaauto','0000-00-00','$asunto','$detalleds','$partesdocumento',
											 '$descorrecion',0,'$idautonotifica','$yearcompleto')");
										 
						}
						else{
						
							$this->db->exec("INSERT INTO documentos_internos (idparte,idradicado,idusuario,idusuarioedita,idtipodocumento,numero,
											 dirigidoa,nombre,direccion,ciudad,fechageneracion,fechaauto,fechaedita,asunto,contenido,partes,
											 fechaautocorrige,descorrecion,idautocorrige,idautonotifica,aniodoc)
											 VALUES ('$idparte','$idr','$idusuario',0,'$tipodocumento','$ndocumento','$dirigidoa','$nombre','$direccion',
											 '$ciudad','$fechalog','$fechaauto','0000-00-00','$asunto','$detalleds','$partesdocumento',
											 '$fechaautocorrige','$descorrecion',0,'$idautonotifica','$yearcompleto')");
						}
						
						
						//*******************************************************************************************************************************
						//CAPTURO LOS DATOS DE LA SIGLA, EL AÑO ACTUAL Y ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA documentos_internos
						//RECIBIDOS DEL CAMPO siglas DE LA VISTA documentos_generar.php
						//ESTO CON EL OBJETO DE COSNTRUIR UN NUMERO UNICO DE DOCUMENTO
						//EN LA TABLA documentos_internos CAMPO numero, BASADO EN EL CAMPO id
						//DE ESE DOCUMENTO, YA QUE SIN ESTA VALIDACION NO SE REALIZA, AL ESCOGER CUALQUIER TIPO DE DOCUMENTO
						//EL SISTEMA AUTOMATICAMENTE ASIGNA Numero Documento: XXXX DEPENDIENDO DE DONDE ESTE PARADO EL CONTADOR
						//DE CADA DOCUMENTO DE LA TABLA pa_tipodocumento, Y SE PRESENTA QUE SI DE UN PC SE ESCOGE UN OFICIO
						//Y SU CONTADOR ESTA EN 3 PASARIA A LA SIGUIENTE FORMA Numero Documento: OECMO15-004, Y SI AUN NO SE A DADO
						//CLIC EN REGISTRAR Y DESDE OTRO PC SE ESCOGE TAMBIEN TIPO DE DOCUMENTO OFICIO EL SISTEMA ARMA
						//EL Numero Documento: OECMO15-004 IGUAL Y AL DARSE CLIC EN REGISTRAR EN AMBOS PC, OBTENDREMOS UN DOCUMENTO
						//CON IGUAL Numero Documento
						
						//OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA documentos_internos
						/*$lastId     = $this->db->lastInsertId();
						
						//ESTA FUNCION ME PERMITE ARMAR EL Numero Documento BASADO PERO EN EL 
						//ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA documentos_internos
						$modelo     = new documentosModel();
						$ndocumento = $modelo->traer_datos_consecutivo($siglas,$lastId);
						
						$this->db->exec("UPDATE documentos_internos SET numero = '$ndocumento' WHERE id = '$lastId'");*/
						
						//*******************************************************************************************************************************
						
						//$this->db->exec("UPDATE pa_documento SET contador = '$consecutivodocumento' WHERE id = '$documento'");
						
						//OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA documentos_internos
						$lastId    = $this->db->lastInsertId();
						$anotacion = $anotacion.", ID DOCUMENTO: ".$lastId; 

						$this->db->exec("INSERT INTO signot_proceso_anotacion (idradicado,idusuario,fecha,hora,anotacion)
							             VALUES ('$idr','$idusuario','$fechalog','$horalog','$anotacion')");
						
						$this->db->exec("UPDATE pa_documento SET contador = '$consecutivo' WHERE id = '$documento'");
					}
					else{
						
						$this->db->exec("UPDATE documentos_internos SET dirigidoa = '$dirigidoa',nombre = '$nombre',direccion = '$direccion',
										 ciudad = '$ciudad',asunto = '$asunto',contenido = '$detalleds',
										 idusuarioedita = '$idusuario',fechaedita = '$fechalog'
										 WHERE id = '$iddocumento'");
									 
					}
					
					//$this->db->exec("UPDATE sigdoc_pa_consecutivo SET contador = '$consecutivodocumento' WHERE idtipodocumento = '$tipodocumento'");
								
					$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
					
				
				//SE TERMINA LA TRANSACCION  
				$this->db->commit();
				
				//echo "DATO: ".$tipodocumento;
				print'<script languaje="Javascript">location.href="index.php?controller=documentos&action=mensajes&nombre=6"</script>';
			  
			} 
			catch (Exception $e) {
			
				//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
				$this->db->rollBack();
				echo "Fallo: " . $e->getMessage();
				/*print'<script languaje="Javascript">location.href="index.php?controller=documentos&action=mensajes&nombre=6b"</script>';*/
			}
		
  	}
	
	//DEVOLUCION
	public function registrar_documentos_especiales_2(){

			$modelo     = new documentosModel();
			
			$yearcompleto = $modelo->get_ano_completo();
			
			//SE OBTIENEN LOS DATOS
			$idusuario     = $_SESSION['idUsuario'];
			
			//VARIABLE QUE MANEJA EL INSERT O UPDATE DE UN NUEVO DOCUMENTO
			$iddocumento   = trim($_POST['iddocumento']);
			
			//$idautonotifica = trim($_GET['id']);
			$idautonotifica = 0;
			
			$datosdocumento = $modelo->get_datos_documento( trim($_GET['id']) );
			$row            = $datosdocumento->fetch();
			
			//$idparte        = $row[idparte];
			$idparte        = 0;
			$idr 		    = $row[idradicado];
		
			$documento      = trim($_GET['documento']);
			$tipodocumento  = trim($_GET['idtipodocumento']);
			//$tipodocumento  = $row[idtipodocumento];
			
			$nombrelista        = 'pa_tipodocumento';
			$campoordenar       = 'nombre_tipo_documento';
			$filtro             = "WHERE id IN(".$tipodocumento.")";
			$formaordenar       = 'ASC';
			$datostipodocumento = $modelo->get_lista_filtro($nombrelista,$campoordenar,$filtro,$formaordenar);
			$row2                = $datostipodocumento->fetch();
			
			$nomdoc     = $modelo->get_siglas($tipodocumento);
			$row3       = $nomdoc->fetch();
			$nomdoc     = $row3[nombre_documento];
			
			$anotacion          = "SE REGISTRA DOCUMENTO: ".$nomdoc." TIPO DOCUMENTO: ".$row2[nombre_tipo_documento];
			
			/*$ndocumento    = $row[numero];
			
			$dirigidoa     = $row[dirigidoa];
			$nombre        = $row[nombre];
			$direccion     = $row[direccion];
			$ciudad        = $row[ciudad];
			$fechag        = $row[fechageneracion];
			$fechaauto     = $row[fechaauto];
			$asunto        = $row[asunto];*/
			
			
			$ndocumento    = "-";
			
			$dirigidoa     = "-";
			$nombre        = "-";
			$direccion     = "-";
			$ciudad        = "-";
			$fechag        = "0000-00-00";
			$fechaauto     = "0000-00-00";
			$asunto        = "-";
			
			
			//$detalleds     = utf8_encode(trim($_POST['detalleds']));
			$detalleds     = "X";
			
			//$partesdoc     = trim($row[partes]);
	
			$partesdocumento = trim($_GET['partesdoc']);
			
			//$partesdocumento = "-";
			//OBTENGO CUANTAS PARTES MAS SE LE AGREGO AL DOCUMENTO CON INPUT TEXT
			//Y TOMO SU VALOR LOS CONCATENO Y LOS PASO A LA VARIABLE $partesdocumento
			//PARA SER REGISTRADOS A LA BASE DE DATOS
			/*$partesdoc = trim($_GET['partesdoc']);
			$i = 0;
			while($i <= $partesdoc){
			
				$partesdocumento = $partesdocumento."//////".trim($_POST['parte'.$i]);
				
				$i = $i + 1;
			
			}*/
			
			
			//DATOS PARA EL REGISTRO DEL LOG
			
			//$modelo     = new documentosModel();
			$fechahora  = $modelo->get_fecha_actual();
			$datosfecha = explode(" ",$fechahora);
			$fechalog   = $datosfecha[0];
			$horalog    = $datosfecha[1];
			
			
			//$tiporegistro = "Genera un Nuevo Documento";
			
			if( empty($iddocumento) ){
		
				$accion  = "Genera un Nuevo Documento En la Opcion de Documentos/Generar Documento, Sistema SIGNOT";
			}
			else{
			
				$accion  = "Modifica Documento En la Opcion de Documentos/Generar Documento, Sistema SIGNOT, ID DOCUMENTO: ".$iddocumento;
			}
			$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
			$tipolog = 6;
			
			try {  
			
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
					//EMPIEZA LA TRANSACCION
					$this->db->beginTransaction();
					
					//CAPTURO EL MAXIMO DEL CAMPO numero PARA DETERMINAR QUE CONSECUTIVO DEBE ARMARSE
					//PARA EL SIGUIENTE TIPO DE DOCUMENTO, YA QUE SI EL CONTADOR DE LA TABLA sigdoc_pa_consecutivo
					//VA EN 5 Y SI DOS USUARIOS ENRAN AL MISMO TIEMPO Y ESCOGEN TIPO DOCUMENTO OFICIO
					//SALE EN Numero Documento: CSJCF15-005 PARA AMBOS Y AL REGISTRAR CADA UNO
					//QUEDA EN LA TABLA sigdoc_documentos_internos DOS DOCUMENTOS CON EL MISMO NUMERO
					//PARA SE RECONSTRUYO EL CONSECUTIVO CON LO MENCIONADO ANTERIORMENTE, ACTUALIZANDO LA VARIABLE $ndocumento
					//QUE ES LA QUE RECIBE EL CONSECUTIVO INICIAL DE LA VISTA sigdoc_documentos_salientes.php	
					//Y ACTUALIZAMOS DE LA TABLA pa_documento LA COLUMNA contador, ESTE DATO TAMBIENDEBE RECOSTRUIRSE
					//PASA DE $consecutivodocumento A $consecutivo
					/*$listar = $this->db->prepare("SELECT MAX(di.id) AS idmaximo,di.numero,d.sigla
												  FROM ((documentos_internos di INNER JOIN pa_tipodocumento td ON di.idtipodocumento = td.id)
												  INNER JOIN pa_documento d ON td.iddocumento = d.id)
												  WHERE di.id IN(
													  SELECT MAX(di.id) AS idmaximo
													  FROM ((documentos_internos di INNER JOIN pa_tipodocumento td ON di.idtipodocumento = td.id)
													  INNER JOIN pa_documento d ON td.iddocumento = d.id) WHERE d.id = '$documento'
												  )
												  AND d.id = '$documento'");
												  
					
					$listar->execute();
					
					$resultado = $listar->rowCount();

					if(!$resultado){//existe registros
	
						$field = $listar->fetch();
					
						$numeroconsecutivo = explode("-",$field[numero]);
						$consecutivo       = $numeroconsecutivo[1] + 1; 
						
						if($consecutivo >= 0 && $consecutivo <= 9) {$consecutivo = "00".$consecutivo;}
						if($consecutivo >  9 && $consecutivo <= 99){$consecutivo = "0".$consecutivo;}
						
						$ndocumento        = $numeroconsecutivo[0]."-".$consecutivo;
					}
					else{//no existe registro, Y SE DEBE CONSTRUIR EL CONSECUTIVO CON LAS SIGLAS Y EL AÑO YA QUE LOS DATOS EN LA TABLA
						 //documentos_internos SON NULL Y EL NUMERO QUEDARIA DE ESTA FORMA -001,-002 
					
						$field = $listar->fetch();
						
						$year  = $modelo->get_ano();
						
						$numeroconsecutivo = explode("-",$field[numero]);
						$consecutivo       = $numeroconsecutivo[1] + 1; 
						
						if($consecutivo >= 0 && $consecutivo <= 9) {$consecutivo = "00".$consecutivo;}
						if($consecutivo >  9 && $consecutivo <= 99){$consecutivo = "0".$consecutivo;}
						
						$ndocumento        = $field[sigla]."".$year."-".$consecutivo;
			
					}*/
					
					
					
					
					/*SE REALIZA ESTE CAMBIO PARA REDUCIR LOS TIEMPOS EN LA GENERACION DE UN DOCUMENTO YA
					QUE LA CONSULTA ANTERIOR SE DEMORA MAS QUE REALIZAR UNA SOLA CONSULTA A UNA TABLA EN ESTE CASO A pa_documento,
					Y AL IR INCREMENTANDOSE LA CANTIDAD DE REGISTROS DE UN TIPO DE DOCUMENTO ESPECIFICO EN documentos_internos
					EL TIEMPO AUMENTA EN LA GENRACION DE UN NUEVO DOCUMENTO, YA QUE SE TOMA MAYOR CANTIDAD DE TIEMPO
					AL CONSULTAR EL MAXIMO DE ESE DOCUMENTO PARA PODER CONSTRUIR EL VALOR EN $ndocumento*/
					$listar = $this->db->prepare("SELECT MAX(d.id) AS idmaximo,d.sigla,d.contador
												  FROM pa_documento d
												  WHERE d.id = $documento");
												  
					$listar->execute();
					
					$resultado = $listar->rowCount();
					
					$field = $listar->fetch();
						
					$year  = $modelo->get_ano();
						
					$numeroconsecutivo = $field[contador];
					$consecutivo       = $numeroconsecutivo + 1; 
						
					if($consecutivo >= 0 && $consecutivo <= 9) {$consecutivo = "00".$consecutivo;}
					if($consecutivo >  9 && $consecutivo <= 99){$consecutivo = "0".$consecutivo;}
						
					$ndocumento        = $field[sigla]."".$year."-".$consecutivo;
					
					
					
					//---------------------------------------------------------------------------------------------------------------------------------------------------
				
					
					if( empty($iddocumento) ){
					
						
						$this->db->exec("INSERT INTO documentos_internos (idparte,idradicado,idusuario,idusuarioedita,idtipodocumento,numero,
										 dirigidoa,nombre,direccion,ciudad,fechageneracion,fechaauto,fechaedita,asunto,contenido,partes,
										 descorrecion,idautocorrige,idautonotifica,aniodoc)
										 VALUES ('$idparte','$idr','$idusuario',0,'$tipodocumento','$ndocumento','$dirigidoa','$nombre','$direccion',
										 '$ciudad','$fechalog','$fechaauto','0000-00-00','$asunto','$detalleds','$partesdocumento','',0,'$idautonotifica','$yearcompleto')");
										 
						//OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA documentos_internos
						$lastId    = $this->db->lastInsertId();
						$anotacion = $anotacion.", ID DOCUMENTO: ".$lastId; 

						$this->db->exec("INSERT INTO signot_proceso_anotacion (idradicado,idusuario,fecha,hora,anotacion)
							             VALUES ('$idr','$idusuario','$fechalog','$horalog','$anotacion')");
						
						
						$this->db->exec("UPDATE pa_documento SET contador = '$consecutivo' WHERE id = '$documento'");
						
						$this->db->exec("UPDATE signot_proceso SET iddevolucion = '$tipodocumento' WHERE id = '$idr'");
					}
					else{
						
						$this->db->exec("UPDATE documentos_internos SET dirigidoa = '$dirigidoa',nombre = '$nombre',direccion = '$direccion',
										 ciudad = '$ciudad',asunto = '$asunto',contenido = '$detalleds',
										 idusuarioedita = '$idusuario',fechaedita = '$fechalog'
										 WHERE id = '$iddocumento'");
									 
					}
					
					//$this->db->exec("UPDATE sigdoc_pa_consecutivo SET contador = '$consecutivodocumento' WHERE idtipodocumento = '$tipodocumento'");
								
					$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
					
				
				//SE TERMINA LA TRANSACCION  
				$this->db->commit();
				
				//echo "DATO: ".$tipodocumento;
				print'<script languaje="Javascript">location.href="index.php?controller=documentos&action=mensajes&nombre=6"</script>';
			  
			} 
			catch (Exception $e) {
			
				//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
				$this->db->rollBack();
				echo "Fallo: " . $e->getMessage();
				/*print'<script languaje="Javascript">location.href="index.php?controller=documentos&action=mensajes&nombre=6b"</script>';*/
			}
		
  	}
	
	//ACTIVAR PROCESO, ESTA FUNCION TAMBIEN SE PUEDE USAR PERO SE REEMPLAZA POR registrar_documentos_especiales_4
	//YA QUE AL DAR CLIC EN EL BOTON ACTIVAR UN PROCESO DE LA VISTA documentos_listar.php ESTE ABRE UN FORMULARIO
	//QUE VA DIRECCIONADO A LA FUNCION registrar_documentos_especiales_4
	//PARA USAR ESTA FUNCION SE DEBE DESCOMENTAR DE LA VISTA documentos_listar.php
	/*<td><a class="activarproceso2" href="javascript:void(0);" data-id="<?php //echo $row['id'];?>"><img src="views/images/a3.png" width="35" height="35" title="ACTIVAR PROCESO"/></a></td>*/
	//Y COMENTAR 
	/*<td><a class="activarproceso" href="javascript:void(0);" data-id="<?php //echo $row['id'];?>"><img src="views/images/a3.png" width="35" height="35" title="ACTIVAR PROCESO"/></a></td>*/
	//PERO DE ESTA FORMA NO CARGA UN FORMULARIO EN LA MISMA VISTA PARA REALIZAR LA ANOTACION DE LA ACTIVACION
	//YA QUE EL SISTEMA LO ENVIA A LA VISTA signot_seguimiento.php PARA QUE SELECCIONE EL PROCESO Y REALICE SU ANOTACION DE ACTIVACION
	public function registrar_documentos_especiales_3(){

			$modelo     = new documentosModel();
			
			//SE OBTIENEN LOS DATOS
			$idusuario     = $_SESSION['idUsuario'];
			
			//VARIABLE QUE MANEJA EL INSERT O UPDATE DE UN NUEVO DOCUMENTO
			$iddocumento   = trim($_POST['iddocumento']);
			
			$idautonotifica = trim($_GET['id']);
			$datosdocumento = $modelo->get_datos_documento( trim($_GET['id']) );
			$row            = $datosdocumento->fetch();
			
			$idr 		    = $row[idradicado];
			
			
			//$idtipoanotacion = trim($_GET['destipoanotacion']);
			
			$anotacion      = "SE ACTIVA NUEVAMENTE EL PROCESO PARA SU MANEJO";
			//$anotacion      = trim($_GET['anotacion']);
		
			//DATOS PARA EL REGISTRO DEL LOG
			
			//$modelo     = new documentosModel();
			$fechahora  = $modelo->get_fecha_actual();
			$datosfecha = explode(" ",$fechahora);
			$fechalog   = $datosfecha[0];
			$horalog    = $datosfecha[1];
			
			
			//$tiporegistro = "Genera un Nuevo Documento";
			
			if( empty($iddocumento) ){
		
				$accion  = "Activa Proceso, Sistema SIGNOT, ID PROCESO: ".$idr;
			}
			else{
			
				$accion  = "Activa Proceso, Sistema SIGNOT, ID PROCESO: ".$idr;
			}
			$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
			$tipolog = 6;
			
			try {  
			
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				//EMPIEZA LA TRANSACCION
				$this->db->beginTransaction();
					
					
					$this->db->exec("UPDATE signot_proceso SET iddevolucion = 0,idusuarioedita = '$idusuario'
									 WHERE id = '$idr'");
									 
					
					$this->db->exec("INSERT INTO signot_proceso_anotacion (idradicado,idusuario,fecha,hora,anotacion)
							         VALUES ('$idr','$idusuario','$fechalog','$horalog','$anotacion')");
									
				
					$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
					
				
				//SE TERMINA LA TRANSACCION  
				$this->db->commit();
				
				//echo "DATO: ".$tipodocumento;
				print'<script languaje="Javascript">location.href="index.php?controller=documentos&action=mensajes&nombre=7"</script>';
			  
			} 
			catch (Exception $e) {
			
				//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
				$this->db->rollBack();
				//echo "Fallo: " . $e->getMessage();
				print'<script languaje="Javascript">location.href="index.php?controller=documentos&action=mensajes&nombre=7b"</script>';
			}
		
  	}
	
	public function registrar_documentos_especiales_4(){

			$modelo     = new documentosModel();
			
			//SE OBTIENEN LOS DATOS
			$idusuario     = $_SESSION['idUsuario'];
			
			//VARIABLE QUE MANEJA EL INSERT O UPDATE DE UN NUEVO DOCUMENTO
			$iddocumento   = trim($_POST['iddocumento']);
			
			$idautonotifica = trim($_POST['id']);
			$datosdocumento = $modelo->get_datos_documento( trim($_POST['id']) );
			$row            = $datosdocumento->fetch();
			
			$idr 		    = $row[idradicado];
			
			
			$idtipoanotacion = trim($_POST['destipoanotacion']);
			
			//$anotacion      = "SE ACTIVA NUEVAMENTE EL PROCESO PARA SU MANEJO";
			$anotacion      = trim($_POST['anotacion']);
		
			//DATOS PARA EL REGISTRO DEL LOG
			
			//$modelo     = new documentosModel();
			$fechahora  = $modelo->get_fecha_actual();
			$datosfecha = explode(" ",$fechahora);
			$fechalog   = $datosfecha[0];
			$horalog    = $datosfecha[1];
			
			
			//$tiporegistro = "Genera un Nuevo Documento";
			
			if( empty($iddocumento) ){
		
				$accion  = "Activa Proceso, Sistema SIGNOT, ID PROCESO: ".$idr;
			}
			else{
			
				$accion  = "Activa Proceso, Sistema SIGNOT, ID PROCESO: ".$idr;
			}
			$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
			$tipolog = 6;
			
			try {  
			
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				//EMPIEZA LA TRANSACCION
				$this->db->beginTransaction();
					
					
					$this->db->exec("UPDATE signot_proceso SET iddevolucion = 0,idusuarioedita = '$idusuario'
									 WHERE id = '$idr'");
									 
					
					$this->db->exec("INSERT INTO signot_proceso_anotacion (idradicado,idusuario,fecha,hora,idtipoanotacion,anotacion)
							         VALUES ('$idr','$idusuario','$fechalog','$horalog','$idtipoanotacion','$anotacion')");
									
				
					$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
					
				
				//SE TERMINA LA TRANSACCION  
				$this->db->commit();
				
				//echo "DATO: ".$tipodocumento;
				print'<script languaje="Javascript">location.href="index.php?controller=documentos&action=mensajes&nombre=6"</script>';
			  
			} 
			catch (Exception $e) {
			
				//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
				$this->db->rollBack();
				//echo "Fallo: " . $e->getMessage();
				print'<script languaje="Javascript">location.href="index.php?controller=documentos&action=mensajes&nombre=6b"</script>';
			}
		
  	}
	
	//----------------------FUNCIONES ESPECIALES--------------------------------------------------------
	
	public function validar_numero($numero){
  
		
		$listar = $this->db->prepare("SELECT numero FROM documentos_internos WHERE numero = '$numero'");
	
	  	$listar->execute();
		
	    $resultado = $listar->rowCount();

		if(!$resultado){
	
			return 0;
		}
		else{
			return 1;
		}
		
  	}  
	public function traer_datos_consecutivo($siglas,$contador){
	
		$cadena = "";
		
		if($contador >= 0 && $contador <= 9){$contador = "00".$contador;}
		if($contador >  9 && $contador <= 99){$contador = "0".$contador;}
	
		//$cadena = $siglas."".$ano."-".$contador;
		
		$cadena = $siglas."-".$contador;

  		return $cadena;
	
	}
	
	//FUNCION PARA CORTAR UNA CADENA Y ESPECIFICAR CON PUNTOS QUE TIENE MAS TEXTO
	//SE CARTASEGUN EL VALOR  $length ASIGNADO
	public function getSubString($string, $length=NULL){
		
		//Si no se especifica la longitud por defecto es 50
		if ($length == NULL)
			$length = 50;
		//Primero eliminamos las etiquetas html y luego cortamos el string
		$stringDisplay = substr(strip_tags($string), 0, $length);
		//Si el texto es mayor que la longitud se agrega puntos suspensivos
		if (strlen(strip_tags($string)) > $length)
			$stringDisplay .= ' ...';
			
			
		return $stringDisplay;
  	}
	
	
	//*********************************************************************************************************************************************
					                                        //FUNCIONES PARA ACTIVAR DIRECCIONES PARTES EN UN PROCESO
	//*********************************************************************************************************************************************
	
	public function activar_direcion_parte(){

			$modelo  = new documentosModel();
			
			//SE OBTIENEN LOS DATOS
			$idusuario     = $_SESSION['idUsuario'];
			
			//VARIABLE QUE MANEJA EL INSERT O UPDATE DE UN NUEVO DOCUMENTO
			$iddocumento   = trim($_POST['iddocumento']);
			
			/*$idparte = trim($_POST['id']);
			
			$datosdocumento = $modelo->get_datos_idradicado( trim($_POST['radicadox']) );
			$row            = $datosdocumento->fetch();
			
			$idr 		    = $row[id];
			
			$idclaseparte   = trim($_POST['idclaseparte']);;*/
			
			$idparted   = trim($_POST['idparted']);

			$iddird     = trim($_POST['iddird']);
			$iddird_b   = trim($_POST['iddird_b']);
			$iddird_c   = trim($_POST['iddird_c']);
			$iddird_d   = trim($_POST['iddird_d']);
			
			$idprocesod = trim($_POST['idprocesod']);
			//$radicadod	= trim($_POST['radicadod']);
			
			
			$idtipoanotacion = trim($_POST['destipoanotacion']);
			
			//$anotacion      = "SE ACTIVA NUEVAMENTE EL PROCESO PARA SU MANEJO";
			$anotacion       = trim($_POST['anotacion']).", PARTE DEL PROCESO: ".trim($_POST['idparted']).
			                   ", CEDULA: ".trim($_POST['iddird_b']).", NOMBRE: ".trim($_POST['iddird_c']).
							   ", ID DIRECCION: ".trim($_POST['iddird']).", DIRECCION: ".trim($_POST['iddird_d']);
		
			//DATOS PARA EL REGISTRO DEL LOG
			
			//$modelo     = new documentosModel();
			$fechahora  = $modelo->get_fecha_actual();
			$datosfecha = explode(" ",$fechahora);
			$fechalog   = $datosfecha[0];
			$horalog    = $datosfecha[1];
			
			
			//$tiporegistro = "Genera un Nuevo Documento";
			
			if( empty($iddocumento) ){
		
				$accion  = "Activa Direccion Parte, Sistema SIGNOT, ID PROCESO: ".$idprocesod.", ID PARTE: ".$idparted.", ID DIRECCION: ".$iddird;
			}
			else{
			
				$accion  = "Activa Direccion Parte, Sistema SIGNOT, ID PROCESO: ".$idprocesod.", ID PARTE: ".$idparted.", ID DIRECCION: ".$iddird;
			}
			
			$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
			$tipolog = 6;
			
			try {  
			
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				//EMPIEZA LA TRANSACCION
				$this->db->beginTransaction();
					
					
					$this->db->exec("UPDATE signot_direccion SET endevolucion = 'NO'
									 WHERE id = '$iddird' AND idproceso = '$idprocesod' AND idparte = '$idparted'");
									  
					
					$this->db->exec("INSERT INTO signot_proceso_anotacion (idradicado,idusuario,fecha,hora,idtipoanotacion,anotacion)
							         VALUES ('$idprocesod','$idusuario','$fechalog','$horalog','$idtipoanotacion','$anotacion')");
									
				
					$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
					
				
				//SE TERMINA LA TRANSACCION  
				$this->db->commit();
				
				//echo "DATO: ".$tipodocumento;
				/*print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=9"</script>';*/
			  
			} 
			catch (Exception $e) {
			
				//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
				$this->db->rollBack();
				echo "Fallo: " . $e->getMessage();
				/*print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=9b"</script>';*/
			}
		
  	}
	
}//FIN CLASE

?>