<?php

class sigdocModel extends modelBase{

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
			
				print'<script languaje="Javascript">location.href="index.php?controller=sigdoc&action=Registro_Documentos_Salientes"</script>';
			}
		}
		 
	 	if($condicion == "2b"){

	 		$_SESSION['elemento'] = "Error al Realizar el registro";

	    	$_SESSION['elem_error_transaccion'] = true;

	   		if($_SESSION['id']!=""){

				/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=sigdoc&action=Registro_Documentos_Salientes"</script>';
	  
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
	
	public function get_datos_usuario_recibe(){
	
		$listar     = $this->db->prepare("SELECT * FROM sigdoc_recibe ORDER BY nombre_recibe");

  		$listar->execute();

  		return $listar;
	
	}
  	
	public function get_lista($nombrelista,$campoordenar){
	
		$listar     = $this->db->prepare("SELECT * FROM ".$nombrelista." ORDER BY ".$campoordenar);
	
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
	
	public function get_documentos_salientes_usuario($identrada){
	
	
		$idusuario  = $_SESSION['idUsuario'];
		
		if($identrada == 1){
		
			
			/*$listar     = $this->db->prepare("SELECT rds.id,rds.identrada,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.cargo,rds.dependencia,
											  rds.fechageneracion,rds.asunto,rds.contenido
											  FROM ((sigdoc_documentos_internos rds LEFT JOIN sigdoc_pa_tipodocumento td ON rds.idtipodocumento = td.id)
											  LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
											  ORDER BY rds.id DESC");*/
											  //ORDER BY rds.id DESC LIMIT 5");
											  
			$listar     = $this->db->prepare("SELECT rds.id,rds.identrada,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.cargo,rds.dependencia,
											  rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita, rds.con_copia
											  FROM ((((sigdoc_documentos_internos rds LEFT JOIN sigdoc_pa_tipodocumento td ON rds.idtipodocumento = td.id)
											  LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
											  LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
											  LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
											  ORDER BY rds.id DESC
											  LIMIT 30");
											 
			
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
			
				$filtro9 = " AND rds.idusuario = '$datox9' ";
			
			}
			
	
			$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtrof;
			
			//echo $filtrox;
			  
			/*$listar    = $this->db->prepare("SELECT rds.id,rds.identrada,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.cargo,rds.dependencia,
											 rds.fechageneracion,rds.asunto,rds.contenido
											 FROM ((sigdoc_documentos_internos rds LEFT JOIN sigdoc_pa_tipodocumento td ON rds.idtipodocumento = td.id)
											 LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
											 WHERE rds.id >= '1'" .$filtrox. " 
											 ORDER BY rds.id DESC");*/
											 
			$listar    = $this->db->prepare("SELECT rds.id,rds.identrada,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.cargo,rds.dependencia,
											 rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita, rds.con_copia
											 FROM ((((sigdoc_documentos_internos rds LEFT JOIN sigdoc_pa_tipodocumento td ON rds.idtipodocumento = td.id)
											 LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
											 LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
											 LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
											 WHERE rds.id >= '1'" .$filtrox. " 
											 ORDER BY rds.id DESC");
		}

  		$listar->execute();

  		return $listar;
	
  	}
	
	public function registrar_documentos_salientes(){

		
		//SE OBTIENEN LOS DATOS
		
		$idusuario     = $_SESSION['idUsuario'];
		$consecutivodocumento = trim($_POST['consecutivodocumento']);
		
		//VARIABLE QUE MANEJA EL INSERT O UPDATE DE UN NUEVO DOCUMENTO
		$iddocumento   = trim($_POST['iddocumento']);
		
		$tipodocumento = trim($_POST['tipodocumento']);
		$ndocumento    = trim($_POST['ndocumento']);
		$dirigidoa     = trim($_POST['dirigidoa']);
		$nombre        = trim($_POST['nombre']);
		$cargo         = trim($_POST['cargo']);
		$dependencia   = trim($_POST['dependencia']);
		$fechag        = trim($_POST['fechag']);
		$asunto        = trim($_POST['asunto']);
		$detalleds     = trim($_POST['detalleds']);
		// JUAN ESTEBAN MUNERA BETANCUR 
        // 2017-09-29
        $con_copia  = trim($_POST['copia']);
		
			
		//DATOS PARA EL REGISTRO DEL LOG
		
		$modelo     = new sigdocModel();
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
		
		
		$tiporegistro = "Salida de Documento";
		
		if( empty($iddocumento) ){
	
			$accion  = "Registra una Nueva ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS SALIENTES";
		}
		else{
			$accion  = "Modifica una ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS SALIENTES, ID DOCUMENTO: ".$iddocumento;
		}
      	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog = 4;
		
		
		//AÑO COMPLETO
		$yearcompleto =  $modelo->get_ano_completo();
		
		
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
				//Y ACTUALIZAMOS DE LA TABLA sigdoc_pa_consecutivo LA COLUMNA contador, ESTE DATO TAMBIEN DEBE RECOSTRUIRSE
				//PASA DE $consecutivodocumento A $consecutivo
				
				  
				/*$listar = $this->db->prepare("SELECT MAX(di.id) AS idmaximo,di.numero,dc.sigla
											  FROM (sigdoc_documentos_internos di INNER JOIN sigdoc_pa_consecutivo dc ON di.idtipodocumento = dc.idtipodocumento)
											  WHERE di.id IN(
												  SELECT MAX(di.id) AS idmaximo
												  FROM (sigdoc_documentos_internos di INNER JOIN sigdoc_pa_consecutivo dc ON di.idtipodocumento = dc.idtipodocumento) 
												  WHERE di.idtipodocumento = '$tipodocumento' AND di.aniodoc = '$yearcompleto'
											
											  )
											  AND di.idtipodocumento = '$tipodocumento' AND di.aniodoc = '$yearcompleto'");

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
					 //documentos_internos SON NULL Y EL NUEMRO QUEDARIA DE ESTA FORMA -001,-002 
					
						$field = $listar->fetch();
						
						$year  = $modelo->get_ano();
						
						$numeroconsecutivo = explode("-",$field[numero]);
						$consecutivo       = $numeroconsecutivo[1] + 1; 
						
						if($consecutivo >= 0 && $consecutivo <= 9) {$consecutivo = "00".$consecutivo;}
						if($consecutivo >  9 && $consecutivo <= 99){$consecutivo = "0".$consecutivo;}
						
						//SE REALIZA ESTA PREGUNTA YA QUE LA TABLA sigdoc_documentos_internos, SI NO TIENE NINGUN REGISTRO
						//NO CARA EL CAMPO SIGLAS Y EL NUMERO DEL DOCUMENTO QUEDARIA DE ESTA FORMA 15-001, SIENDO LA FORMA 
						//CORRECTA ESTA CSJCF15-001
						if( empty($field[sigla]) ){
						
							$listar_2 = $this->db->prepare("SELECT sigla FROM sigdoc_pa_consecutivo WHERE idtipodocumento = '$tipodocumento'");
	
							$listar_2->execute();
							
							$field_2x = $listar_2->fetch();
							
							$sigladocumento = trim($field_2x[sigla]);
							
							$ndocumento = $sigladocumento."".$year."-".$consecutivo;
						
						}
						else{
							$ndocumento = $field[sigla]."".$year."-".$consecutivo;
						}
						
			
				}*/
				
				
				
				//SE CAMBIA A ESTE CODIGO POR EFECTOS DE VELOCIDAD EN LA CONSULTA DE CONSECUTIVO
				//YA QUE UNA VEZ AUMENTE LA CANTIDAD DE REGISTROS EN sigdoc_documentos_internos
				//EL SISTEMA AL REGISTRAR UN DOCUMENTO VA INCREMENTANDO SU TIEMPO DE REGISTRO
				//DE ESTA FORMA ES MAS RAPIDO YA QUE SOLO CONSULTA A sigdoc_pa_consecutivo
				$listar = $this->db->prepare("SELECT MAX(di.id) AS idmaximo,di.sigla,di.contador
											  FROM sigdoc_pa_consecutivo di
											  WHERE di.idtipodocumento = '$tipodocumento'");

  				$listar->execute();
				
				$field = $listar->fetch();
						
				$year  = $modelo->get_ano();
						
				$numeroconsecutivo = $field[contador];
				$consecutivo       = $numeroconsecutivo + 1; 
						
				if($consecutivo >= 0 && $consecutivo <= 9) {$consecutivo = "00".$consecutivo;}
				if($consecutivo >  9 && $consecutivo <= 99){$consecutivo = "0".$consecutivo;}
				
				$ndocumento = $field[sigla]."".$year."-".$consecutivo;
				
				
				//---------------------------------------------------------------------------------------------------------------------------------------------------
		   		
				if( empty($iddocumento) ){
					
					$this->db->exec("INSERT INTO sigdoc_documentos_internos (idusuario,idusuarioedita,identrada,idtipodocumento,numero,dirigidoa,nombre,cargo,dependencia,
									 fechageneracion,fechaedita,asunto,contenido,aniodoc,con_copia)
									 VALUES ('$idusuario',0,0,'$tipodocumento','$ndocumento','$dirigidoa','$nombre','$cargo','$dependencia','$fechag','0000-00-00',
									 '$asunto','$detalleds','$yearcompleto', '$con_copia')");
					
					//$this->db->exec("UPDATE sigdoc_pa_consecutivo SET contador = '$consecutivodocumento' WHERE idtipodocumento = '$tipodocumento'");
					
					$this->db->exec("UPDATE sigdoc_pa_consecutivo SET contador = '$consecutivo' WHERE idtipodocumento = '$tipodocumento'");
				}
				else{
					
					$this->db->exec("UPDATE sigdoc_documentos_internos SET dirigidoa = '$dirigidoa',nombre = '$nombre',cargo = '$cargo',
					 				 dependencia = '$dependencia',asunto = '$asunto',contenido = '$detalleds',
									 idusuarioedita = '$idusuario',fechaedita = '$fechalog', con_copia = '$con_copia'
									 WHERE id = '$iddocumento'");
								 
				}
				
				//$this->db->exec("UPDATE sigdoc_pa_consecutivo SET contador = '$consecutivodocumento' WHERE idtipodocumento = '$tipodocumento'");
								 

				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
				
			
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			
			print'<script languaje="Javascript">location.href="index.php?controller=sigdoc&action=mensajes&nombre=2"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	//echo "Fallo: " . $e->getMessage();
			print'<script languaje="Javascript">location.href="index.php?controller=sigdoc&action=mensajes&nombre=2b"</script>';
		}
		
		
  	}
	
	public function registrar_respuesta_documento(){

		
		//SE OBTIENEN LOS DATOS
		
		$idusuario     = $_SESSION['idUsuario'];
		$consecutivodocumento = trim($_POST['consecutivodocumento']);
		
		//VARIABLE QUE MANEJA EL INSERT O UPDATE DE UN NUEVO DOCUMENTO
		//$iddocumento   = trim($_POST['iddocumento']);
		
		//VARIABLE QUE MANEJA CUANDO SE LE DA RESPUESTA A UN DOCUMENTO
		$idrespuesta   = trim($_POST['idrespuesta']);
		
		$tipodocumento = trim($_POST['tipodocumento']);
		$ndocumento    = trim($_POST['ndocumento']);
		$dirigidoa     = trim($_POST['dirigidoa']);
		$nombre        = trim($_POST['nombre']);
		$cargo         = trim($_POST['cargo']);
		$dependencia   = trim($_POST['dependencia']);
		$fechag        = trim($_POST['fechag']);
		$asunto        = trim($_POST['asunto']);
		$detalleds     = trim($_POST['detalleds']);
		//JUAN ESTEBAN MUNERA BETANCUR 2017-09-29
        $con_copia     = trim($_POST['copia']);	
		//DATOS PARA EL REGISTRO DEL LOG
		$modelo     = new sigdocModel();
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
		
		
		$tiporegistro = "Respuesta de Documento";
		
		$accion  = "Registra una ".$tiporegistro." En el Sistema (SIGDOC), ID DOCUMENTO: ".$idrespuesta;
		
      	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog = 4;
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
				//SE CAMBIA A ESTE CODIGO POR EFECTOS DE VELOCIDAD EN LA CONSULTA DE CONSECUTIVO
				//YA QUE UNA VEZ AUMENTE LA CANTIDAD DE REGISTROS EN sigdoc_documentos_internos
				//EL SISTEMA AL REGISTRAR UN DOCUMENTO VA INCREMENTANDO SU TIEMPO DE REGISTRO
				//DE ESTA FORMA ES MAS RAPIDO YA QUE SOLO CONSULTA A sigdoc_pa_consecutivo
				$listar = $this->db->prepare("SELECT MAX(di.id) AS idmaximo,di.sigla,di.contador
											  FROM sigdoc_pa_consecutivo di
											  WHERE di.idtipodocumento = '$tipodocumento'");

  				$listar->execute();
				
				$field = $listar->fetch();
						
				$year  = $modelo->get_ano();
						
				$numeroconsecutivo = $field[contador];
				$consecutivo       = $numeroconsecutivo + 1; 
						
				if($consecutivo >= 0 && $consecutivo <= 9) {$consecutivo = "00".$consecutivo;}
				if($consecutivo >  9 && $consecutivo <= 99){$consecutivo = "0".$consecutivo;}
				
				$ndocumento = $field[sigla]."".$year."-".$consecutivo;
				
				
				//---------------------------------------------------------------------------------------------------------------------------------------------------
			
	 
				$this->db->exec("INSERT INTO sigdoc_documentos_internos (idusuario,idusuarioedita,identrada,idtipodocumento,numero,dirigidoa,nombre,cargo,dependencia,
								 fechageneracion,fechaedita,asunto,contenido, con_copia)
								 VALUES ('$idusuario',0,'$idrespuesta','$tipodocumento','$ndocumento','$dirigidoa','$nombre','$cargo','$dependencia','$fechag','0000-00-00',
								 '$asunto','$detalleds', '$con_copia')");
					
				$this->db->exec("UPDATE sigdoc_pa_consecutivo SET contador = '$consecutivodocumento' WHERE idtipodocumento = '$tipodocumento'");
				
				
				$this->db->exec("UPDATE sigdoc_documentos_entrantes SET fecharespuesta = '$fechalog',idusuarioedita = '$idusuario',fechaedita = '$fechalog'
								 WHERE id = '$idrespuesta'");
								 
				
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
				
			
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			
			print'<script languaje="Javascript">location.href="index.php?controller=sigdoc&action=mensajes&nombre=2"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	//echo "Fallo: " . $e->getMessage();
			print'<script languaje="Javascript">location.href="index.php?controller=sigdoc&action=mensajes&nombre=2b"</script>';
		}
		
		
  	}
	
	public function get_datos_documentos(){
	
		$id     = trim($_GET['id']);
	
		$listar = $this->db->prepare("SELECT * FROM sigdoc_documentos_internos WHERE id = '$id'");

  		$listar->execute();

  		return $listar;
	
	}
	
	//*******************************************************************************************************************************************************
	//PARA DOCUMENTOS ENTRANTES
	
	public function get_documentos_entrantes_usuario($identrada){
	
	
		$idusuario  = $_SESSION['idUsuario'];
		
		if($identrada == 1){
		
			  
			/*$listar    = $this->db->prepare("SELECT rds.id,rds.fecha,rds.fecharespuesta,rds.hora,rds.remitente,td.nombre_tipo_documento,rds.numero,rds.asunto
											 FROM (sigdoc_documentos_entrantes rds LEFT JOIN sigdoc_pa_tipodocumento td ON rds.idtipodocumento = td.id)
											 ORDER BY rds.id DESC");*/
											 
			$listar    = $this->db->prepare("SELECT rds.id,rds.fecha,rds.fecharespuesta,rds.hora,rds.remitente,td.nombre_tipo_documento,rds.numero,rds.asunto,
											 pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita
											 FROM (((sigdoc_documentos_entrantes rds LEFT JOIN sigdoc_pa_tipodocumento td ON rds.idtipodocumento = td.id)
											 LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
											 LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
											 ORDER BY rds.id DESC
											 LIMIT 30");
											 
			
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
			
			
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$datox1    = trim($_GET['datox1']);
			$datox2    = trim($_GET['datox2']);
			$datox3    = trim($_GET['datox3']);
			$datox4    = trim($_GET['datox4']);
			$datox5    = trim($_GET['datox5']);
			$datox6    = trim($_GET['datox6']);
			
	
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtrof = " AND (rds.fecha >= '$fechad' AND rds.fecha <= '$fechah') ";
				
			
			}
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND rds.idtipodocumento = '$datox1' ";
			
			}
			if ( !empty($datox2) ) {
		
				$filtro2 = " AND rds.numero = '$datox2' ";
			
			}
			if ( !empty($datox3) ) {
			
				$filtro3 = " AND rds.remitente LIKE '%$datox3%' ";
			
			}
			if ( !empty($datox4) ) {
			
				$filtro4 = " AND rds.asunto LIKE '%$datox4%' ";
			
			}
			if ( !empty($datox5) ) {
			
				$filtro5 = " AND rds.id = '$datox5' ";
			
			}
			if ( !empty($datox6) ) {
			
				$filtro6 = " AND rds.idusuario = '$datox6' ";
			
			}
			
		
			$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtrof;
			
			//echo $filtrox;
			
		  
			/*$listar    = $this->db->prepare("SELECT rds.id,rds.fecha,rds.fecharespuesta,rds.hora,rds.remitente,td.nombre_tipo_documento,rds.numero,rds.asunto
											 FROM (sigdoc_documentos_entrantes rds LEFT JOIN sigdoc_pa_tipodocumento td ON rds.idtipodocumento = td.id)
											 WHERE rds.id >= '1'" .$filtrox. " 
											 ORDER BY rds.id DESC");*/
											 
											 
			$listar    = $this->db->prepare("SELECT rds.id,rds.fecha,rds.fecharespuesta,rds.hora,rds.remitente,td.nombre_tipo_documento,rds.numero,rds.asunto,
											 pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita
											 FROM (((sigdoc_documentos_entrantes rds LEFT JOIN sigdoc_pa_tipodocumento td ON rds.idtipodocumento = td.id)
											 LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
											 LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
											 WHERE rds.id >= '1'" .$filtrox. " 
											 ORDER BY rds.id DESC");
		}

  		$listar->execute();

  		return $listar;
	
  	}
	
	public function registrar_documentos_entrantes(){
	
		$modelo     = new sigdocModel();
		
		//VARIABLE QUE MANEJA EL INSERT O UPDATE DE UN NUEVO DOCUMENTO ENTRANTE
		$iddocumento   = trim($_POST['iddocumento']);

		
		//SE OBTIENEN LOS DATOS
		$idusuario     = $_SESSION['idUsuario'];
		
		$fechae        = trim($_POST['fechae']);
		
		//SE REALIZA ESTE CAMBIO PARA PODER TOMAR LA HORA REAL EN QUE SE HACE EL REGISTRO Y NO AL MOMENTO DE ESTAR LLENANDO LA INFORMACION
		//EN EL FORMÇÇULARIO, ES DECIR ENTRO AL FORMULARIO Y SON LAS 11:37 Y MIENTRAS LO LLENO ME DAN LAS 11:38 LA HORA REAL A REGISTRAR ES
		//11:38

		//$horae         = trim($_POST['horae']);
		$horae         = $modelo->get_hora_actual();
		
		$remitente     = trim($_POST['remitente']);
		$tipodocumento = trim($_POST['tipodocumento']);
		$numerodoce    = trim($_POST['numerodoce']);
		$asunto        = trim($_POST['asunto']);
		
		
		//DATOS PARA EL REGISTRO DEL LOG
		
		//$modelo     = new sigdocModel();
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
		
		
		$tiporegistro = "Entrada de Documento";
		
		if( empty($iddocumento) ){
			$accion  = "Registra una Nueva ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS ENTRANTES";
		}
		else{
			$accion  = "Modifica una ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS ENTRANTES, ID DOCUMENTO: ".$iddocumento;
		}
      	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog = 4;
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   		
				if( empty($iddocumento) ){
				
					$this->db->exec("INSERT INTO sigdoc_documentos_entrantes (idusuario,idusuarioedita,fecha,fecharespuesta,fechaedita,hora,remitente,idtipodocumento,
									 numero,asunto)
									 VALUES ('$idusuario',0,'$fechae','0000-00-00','0000-00-00','$horae','$remitente','$tipodocumento','$numerodoce','$asunto')");
				}
				else{
					
					$this->db->exec("UPDATE sigdoc_documentos_entrantes SET remitente = '$remitente',numero = '$numerodoce',asunto = '$asunto',
									 idusuarioedita = '$idusuario',fechaedita = '$fechalog'
									 WHERE id = '$iddocumento'");
								 
				}
				
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
				
			
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			
			print'<script languaje="Javascript">location.href="index.php?controller=sigdoc&action=mensajes&nombre=4"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	//echo "Fallo: " . $e->getMessage();
			print'<script languaje="Javascript">location.href="index.php?controller=sigdoc&action=mensajes&nombre=4b"</script>';
		}
		
		
  	}
	
	public function get_datos_documentos_entrantes(){
	
		$id     = trim($_GET['id']);
	
		$listar = $this->db->prepare("SELECT * FROM sigdoc_documentos_entrantes WHERE id = '$id'");

  		$listar->execute();

  		return $listar;
	
	}
	
	
	//**************** FUNCIONES ESPECIALES **********************************************
	
	//-------------------------------------------------------------------------------
	//PARA CALCULAR LOS DIAS DE RESPUESTA DE UN DOCUMENTO
	
	public function Dias_Respuesta($fecharegistro,$fecharespuesta){
	
				
		require_once('funciones/Festivos.php');
		
		$dias_diferencia = 0;
		
		if($fecharespuesta != "0000-00-00"){
		
			
			//FECHA INCIAL
			$inicio    = new DateTime($fecharegistro);
			//Un día es P1D,Dos días es P2D, 
			//es decir que si la fecha inicial es 2015-05-19 y la final es 2015-05-27
			//el intervalos iria de 2015-05-19 2015-05-20 2015-05-21 2015-05-22 2015-05-23 2015-05-24 2015-05-25 2015-05-26
			$intervalo = new DateInterval('P1D');
			//FECHA FINAL
            $fin       = new DateTime($fecharespuesta);
			//CREO EL PERIODO SEGUN LOS DATOS ANTERIORES
			$periodo   = new DatePeriod($inicio,$intervalo,$fin);
			
			foreach ($periodo as $fecha) {
			
    			//echo $fecha->format('Y-m-d')."\n";
				//$dias_diferencia = $dias_diferencia." ".$fecha->format('Y-m-d')."\n";
				
				//OBTENGO FECHA A FECHA, DESDE LA INCIAL A LA FINAL Y CAPTURO SU AÑO,MES,DIA
				$fechaperiodo = explode("-",$fecha->format('Y-m-d'));
				$y            = trim($fechaperiodo[0]);
			    $m            = trim($fechaperiodo[1]);
			    $d            = trim($fechaperiodo[2]);
				//OBTENGO EL DIA SEGUN LA FECHA PASADA A $fechaperiodo CON SUS PARTES AÑO,MES,DIA
				$date         = date('D', mktime(0,0,0,$m,$d,$y));
				
				//PARA DIAS FESTIVOS, SE INSTANCIA LA CLASE Y SE LLAMA LA FUNCION PARA SABER SI UN DIA ES FESTIVO
				$dias_festivos = new festivos($y);
				$esfestivo     = $dias_festivos->esFestivo($d,$m);
				
				//SE REALIZA LA PREGUNTA SI ES SABADO, DOMINGO O FESTIVO
				//PARA NO INCREMENTAR $dias_diferencia
				if($date == 'Sat' or $date == 'Sun' or $esfestivo == 1){
			
					$bandera = 0;
				}
				else{
				
					$dias_diferencia = $dias_diferencia + 1;
				}
				
				//$dias_diferencia = $dias_diferencia." ".$date."\n";
			}
	
		}
		else{
			
			$dias_diferencia = "-";
			
		}
		
		return $dias_diferencia;
	
	}
	
	public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
	
		$listar     = $this->db->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
	
  		$listar->execute();

  		return $listar;
	
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
	
}//FIN CLASE

?>