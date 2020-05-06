<?php

class sidojuModel extends modelBase{

   /***********************************************************************************/

    /*----------------------------- Mensajes ---------------------------------------*/

    /**********************************chk*************************************************/
	public function mensajes(){
		$condicion = $_GET['nombre'];
		$idmensaje = $_GET['idmensaje'];
	 	if($condicion == 2){
	 		$_SESSION['elemento'] = "El registro ha sido ingresado correctamente";
	    	$_SESSION['elem_conscontrato'] = true;
	   		if($_SESSION['id']!=""){
	    		/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
				print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=Registro_Documentos_Entrantes_Juzgados"</script>';
			}
		}
	 	if($condicion == "2b"){
	 		$_SESSION['elemento'] = "Error al Realizar el registro";
	    	$_SESSION['elem_error_transaccion'] = true;
	   		if($_SESSION['id']!=""){
				/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
				print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=Registro_Documentos_Entrantes_Juzgados"</script>';
	   		}
	 	}
		if($condicion == "3b"){
			if($idmensaje == 1){$_SESSION['elemento'] = "El Archivo no Cumple con las Caracteristicas Especificas, si es diferente de tipo (vnd.ms-excel,vnd.openxmlformats-officedocument.spreadsheetml.sheet, vnd.openxmlformats-officedocument.wordprocessingml.document,pdf) y tamaño de archivo < 100000000";}
			if($idmensaje == 2){$_SESSION['elemento'] = "Ya Existe un Archivo con ese Nombre";}
			if($idmensaje == 3){$_SESSION['elemento'] = "Error al subir el fichero";}
	    	$_SESSION['elem_error_archivo'] = true;
	   		if($_SESSION['id']!=""){
				print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=Registro_Documentos_Entrantes_Juzgados"</script>';
	   		}
	 	}
		if($condicion == 4){
	 		$_SESSION['elemento'] = "El registro ha sido ingresado correctamente";
	    	$_SESSION['elem_conscontrato'] = true;
	   		if($_SESSION['id']!=""){
				print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=Verificar_Documentos_Entrantes_Juzgados"</script>';
			}
		}
	 	if($condicion == "4b"){
	 		$_SESSION['elemento'] = "Error al Realizar el registro";
	    	$_SESSION['elem_error_transaccion'] = true;
	   		if($_SESSION['id']!=""){
				print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=Verificar_Documentos_Entrantes_Juzgados"</script>';
	   		}
	 	}
	 	if($condicion == "4E"){
            $_SESSION['elemento'] = "Error al Eliminar el registro";
	    	$_SESSION['elem_error_transaccion'] = true;
            if($_SESSION['id']!=""){
                print'<script languaje="Javascript">location.href="centro_servicios2/views/popupbox/popup_sidojuEliminar_Registro.php"</script>';
            }
        }
        if($condicion == "4E1"){
            $_SESSION['elemento'] = "El registro ha sido Eliminado correctamente";
	    	$_SESSION['elem_conscontrato'] = true;
            if($_SESSION['id']!=""){
                print'<script languaje="Javascript">location.href="centro_servicios2/views/popupbox/popup_sidojuEliminar_Registro.php"</script>';
            }
        }
	}	
	
	/***********************************************************************************/

  /*------------------------------ Listar Log ---------------------------------------*/

  /***********************************************************************************/

	public function listarLogSidoju(){

		$listar = $this->db->prepare("SELECT logusuario.fecha,logusuario.accion,logusuario.detalle,usuario.empleado,usuario.foto
									  FROM LOG AS logusuario
								      INNER JOIN pa_usuario AS usuario ON (logusuario.idusuario=usuario.id)
									  WHERE logusuario.idtipolog=5
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
	//HORA MILITAR
	public function get_hora_actual_24horas(){
	
		date_default_timezone_set('America/Bogota'); 
		//$horaregistro=date('H:i:s'); 
		$horaregistro = date('H:i');
		$hora         = date('H');
		
		//REALIZO ESTA PREGUNTA PARA COGER EL RANGO DE HORA
		//DE 01:00 AM - 09:00 AM Y QUITARLES EL CERO INICIAL
		//YA QUE PARA GENERAR EL REPORTE EN VERIFICAR DOCUMENTOS ENTRANTES JUZGADOS
		//EN LA BASE DE DATOS REALIZA ESTE FILTRO SIN ESTE CERO INCIAL
		if($hora >= 1 && $hora <= 9){
			$horaregistro = substr($horaregistro, -4);    // Ej: 08:54 devuelve 8:54
		}
		
		return $horaregistro; 
	}
	//HORA NORMAL(FUNCION USADA, SOLO PARA VISUALIZACION DEL USUARIO, YA QUE EN LA BASE DE DATOS SE TRABAJA CON HORA MILITAR)
	public function get_hora_actual_12horas(){
	
		date_default_timezone_set('America/Bogota'); 
		//$horaregistro=date('H:i:s'); 
		$horaregistro=date('g:i:s A');
		return $horaregistro;
 	}
	
	public function get_lista($nombrelista,$campoordenar){
	
		$listar     = $this->db->prepare("SELECT * FROM ".$nombrelista." ORDER BY ".$campoordenar);
	
  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_lista_filtro($nombrelista,$campoordenar,$filtro,$formaordenar){
	
		$listar     = $this->db->prepare("SELECT * FROM ".$nombrelista." ".$filtro." ORDER BY ".$campoordenar." ".$formaordenar);
	
  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
	
		$listar     = $this->db->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
	
  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_usuario_acciones(){
	
		//$idusuario  = $_SESSION['idUsuario'];
		
		$listar     = $this->db->prepare("SELECT * FROM pa_usuario_acciones WHERE id = 12");
		
		$listar->execute();

  		return $listar;
	}
	
	public function get_nombre_usuario($idnombreusuario){
	
		$listar     = $this->db->prepare("SELECT empleado,descarpeta FROM pa_usuario WHERE id = '$idnombreusuario'");
	
  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_lista_archivos($idusuario,$ruta){
	
		$modelo = new sidojuModel();
		
		$listar = null;
		
		//$directorio = opendir("C:\wamp\www\centro_servicios\ArchivosSidoju");
		$directorio = opendir($ruta);
		
		while($elemento = readdir($directorio))
		{
			
			//OBTENGO EL NOMBRE DEL USUARIO PARA CONCATENARLO CON LA CARPETA ESPECIFICA CON SU CODIGO Y NOMBRE
			//EL CUAL EL CODIGO ES LA VARIABLE $elemento
			$nombreusuario = $modelo->get_nombre_usuario($elemento);
			$n_usuario_1   = $nombreusuario->fetch();
			$n_usuario_2   = $n_usuario_1['empleado'];
			$n_usuario_3   = $n_usuario_1['descarpeta'];
			
			if($elemento != '.' && $elemento != '..' /*&& $elemento == $idusuario*/)
			{
			
				//if (is_dir("archivos/".$elemento))
				if (is_dir("ArchivosSidoju/".$elemento))
				{
					//$listar .= "<li><a href='archivos/$elemento' target='_blank'>$elemento/</a></li>";
					
					
					
					$listar .= "<li><a title = 'Archivos Escaneados Servidor Judicial: ".$n_usuario_2."' href='ArchivosSidoju/$elemento' target='_blank'>$elemento / ".$n_usuario_2." --> ".$n_usuario_3."</a></li>";
					
					
					
					/*print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=Registro_Documentos_Entrantes_Juzgados"</script>';*/
					
					
				}
				else
				{
					//$listar .= "<li><a href='archivos/$elemento' target='_blank'>$elemento</a></li>";
					
					
					
					$listar .= "<li><a title = 'Archivos Escaneados Servidor Judicial: ".$n_usuario_2."' href='ArchivosSidoju/$elemento' target='_blank'>$elemento / ".$n_usuario_2." --> ".$n_usuario_3."</a></li>";
					
					
					
				}
			}
		}
		
		return $listar;
	
	}
	
	//ESTA FUNCION REEMPLAZA LA FUNCION get_lista_archivos YA QUE ESTQA CONCATENA EL LISTADO DE LA LISTA DE CARPETAS CON //////
	//PARA LUEGO RECIBIR ESA INFORMACION EN LA VISTA sidoju_listar_archivos.php Y CON LA FUNCION EXPLORER CREAR UN VECTOR
	//PARA SER RECORRIDO CON UN WHILE Y PODER APLICAR LAS FUNCIONES DE LA LIBRERIA JQUERYdataTable
	//NOTA: PERO LA FUNCION  get_lista_archivos TAMBIEN FUNCIONA CON LA LA BLE COMENTADA EN LA VISTA sidoju_listar_archivos.php
	public function get_lista_archivos_2($idusuario,$ruta){
	
		$modelo = new sidojuModel();
		
		$listar = null;
		
		//$directorio = opendir("C:\wamp\www\centro_servicios\ArchivosSidoju");
		$directorio = opendir($ruta);
		
		while($elemento = readdir($directorio))
		{
			
			//OBTENGO EL NOMBRE DEL USUARIO PARA CONCATENARLO CON LA CARPETA ESPECIFICA CON SU CODIGO Y NOMBRE
			//EL CUAL EL CODIGO ES LA VARIABLE $elemento
			$nombreusuario = $modelo->get_nombre_usuario($elemento);
			$n_usuario_1   = $nombreusuario->fetch();
			$n_usuario_2   = $n_usuario_1['empleado'];
			$n_usuario_3   = $n_usuario_1['descarpeta'];
			
			if($elemento != '.' && $elemento != '..' /*&& $elemento == $idusuario*/)
			{
			
				//if (is_dir("archivos/".$elemento))
				if (is_dir("ArchivosSidoju/".$elemento))
				{
					
					$listar .= "<li><a title = 'Archivos Escaneados Servidor Judicial: ".$n_usuario_2."' href='ArchivosSidoju/$elemento' target='_blank'>$elemento / ".$n_usuario_2." --> ".$n_usuario_3."</a></li>"."//////";
										
					
				}
				else
				{
					
					$listar .= "<li><a title = 'Archivos Escaneados Servidor Judicial: ".$n_usuario_2."' href='ArchivosSidoju/$elemento' target='_blank'>$elemento / ".$n_usuario_2." --> ".$n_usuario_3."</a></li>"."//////";
					
					
				}
			}
		}
		
		return $listar;
	
	}
	
	public function get_lista_juzgados_usuario(){
		$idusuario  = $_SESSION['idUsuario'];
		//
		$listar     = $this->db->prepare("SELECT * FROM pa_juzgado WHERE idusuariojuzgado = '$idusuario' ORDER BY id");
	
  		$listar->execute();

  		

  		return $listar;
	
	}
	public function get_lista_nombre_bloque($idjuzgado){
	
		$idusuario  = $_SESSION['idUsuario'];
	
	
		$listar     = $this->db->prepare("SELECT de.nombrebloque FROM sidoju_documentos_entrantes_juzgados de
										  WHERE de.chk = 1
										  AND de.idjuzgadodestino IN(SELECT id FROM pa_juzgado WHERE idusuariojuzgado = '$idusuario')
										  AND de.idjuzgadodestino = '$idjuzgado'
										  GROUP BY de.nombrebloque
										  ORDER BY de.id DESC;");
										  
	
  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_nombre_usuario_juzgado($idjuzgado){
	
		//$idusuario  = $_SESSION['idUsuario'];
	
		$listar     = $this->db->prepare("SELECT pu.empleado FROM (pa_juzgado pj INNER JOIN pa_usuario pu ON pj.idusuariojuzgado = pu.id)
								          WHERE pj.id = '$idjuzgado'");
	
  		$listar->execute();

  		return $listar;
	
	}
	
	//Adicionar
	public function get_documentos_entrantes_usuario($identrada){
		$model       = new sidojuModel();
		$fechaactual = $model->get_fecha_actual_amd();
		$idusuario   = $_SESSION['idUsuario'];
		if($identrada == 1){
			//CIERRO ESTA LINEA PARA QUE ME TRAIGA TODO LO QUE NO SE HA APROBADO
			//POR PARTE DEL FUNCIONARIO ASIGNADO AL JUZGADO, NO SOLO LO DE LA FECHA ACTUAL 
			/*$listar    = $this->db->prepare("SELECT de.id,de.fecha,de.hora,pu.empleado,de.remitente,td.nombre_tipo_documento,de.numero,de.nfc,pj.nombre,de.rutaarchivo
											 FROM (((sidoju_documentos_entrantes_juzgados de INNER JOIN pa_usuario pu ON de.idusuario = pu.id)
											 INNER JOIN sigdoc_pa_tipodocumento td ON de.idtipodocumento = td.id)
											 INNER JOIN pa_juzgado pj ON de.idjuzgadodestino = pj.id)
											 WHERE (de.fecha >= '$fechaactual' AND de.fecha <= '$fechaactual') 
											 AND de.chk = 0 AND de.idjuzgadodestino IN(SELECT id FROM pa_juzgado WHERE idusuariojuzgado = '$idusuario')
											 ORDER BY de.id DESC");*/

			$listar = $this->db->prepare("SELECT de.id,de.fecha,de.hora,pu.empleado,de.remitente,td.nombre_tipo_documento,de.numero,de.nfc,pj.nombre,de.rutaarchivo,de.sal_id_externo_fk,de.idtipodocumento
				FROM (((sidoju_documentos_entrantes_juzgados de INNER JOIN pa_usuario pu ON de.idusuario = pu.id)
				INNER JOIN sigdoc_pa_tipodocumento td ON de.idtipodocumento = td.id)
				INNER JOIN pa_juzgado pj ON de.idjuzgadodestino = pj.id)
				WHERE de.chk = 0 AND de.idjuzgadodestino IN(SELECT id FROM pa_juzgado WHERE idusuariojuzgado = '$idusuario')
				ORDER BY de.id DESC");
											 
			
		}
		if($identrada == 2){
			
			$filtrox;
			
			$filtrof;
			$filtro1;
			//$filtroh;
			
			
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			$datox1    = trim($_GET['datox1']);
			//$horai     = trim($_GET['datox2']);
			//$horaf     = trim($_GET['datox3']);

			if ( !empty($fechad) && !empty($fechah) ) {
				$filtrof = " AND (de.fecha >= '$fechad' AND de.fecha <= '$fechah') ";
			}
			//CIERRO ESTA LINEA PARA QUE ME TRAIGA TODO LO QUE NO SE HA APROBADO
			//POR PARTE DEL FUNCIONARIO ASIGNADO AL JUZGADO, NO SOLO LO DE LA FECHA ACTUAL 
			/*else{
				$filtrof = " AND (de.fecha >= '$fechaactual' AND de.fecha <= '$fechaactual') ";
			}*/
			if ( !empty($datox1) ) {
				$filtro1 = " AND de.idjuzgadodestino = '$datox1' ";
			}
			/*if ( !empty($horai) && !empty($horaf) ) {
				$filtroh = " AND (de.hora >= '$horai' AND de.hora <= '$horaf') ";
			}*/
			$filtrox = $filtro1." ".$filtrof;
			//echo $filtrox;
			$listar    = $this->db->prepare("SELECT de.id,de.fecha,de.hora,pu.empleado,de.remitente,td.nombre_tipo_documento,de.numero,de.nfc,pj.nombre,de.rutaarchivo,de.sal_id_externo_fk,de.idtipodocumento
				FROM (((sidoju_documentos_entrantes_juzgados de INNER JOIN pa_usuario pu ON de.idusuario = pu.id)
				INNER JOIN sigdoc_pa_tipodocumento td ON de.idtipodocumento = td.id)
				INNER JOIN pa_juzgado pj ON de.idjuzgadodestino = pj.id)
				WHERE de.chk = 0 AND de.idjuzgadodestino IN(SELECT id FROM pa_juzgado WHERE idusuariojuzgado = '$idusuario') " .$filtrox. " ORDER BY de.id DESC");							
		}
  		$listar->execute();
  		return $listar;
  	}
	
	//Listar docuemntos entrantes y modificarlos
	//adicionar
	public function get_listrar_documentos_entrantes_usuario($identrada){
	
		
		$model       = new sidojuModel();
		
		//$fechaactual = $model->get_fecha_actual_amd();
		//$idusuario   = $_SESSION['idUsuario'];

		//Si no escoge un filtro de busqueda
		if($identrada == 1){
		
			  
			$listar    = $this->db->prepare("SELECT de.id,de.fecha,de.hora,pu.empleado,de.remitente,td.nombre_tipo_documento,de.numero,de.nfc,pj.nombre,de.rutaarchivo,de.chk,de.sal_id_externo_fk
				FROM (((sidoju_documentos_entrantes_juzgados de INNER JOIN pa_usuario pu ON de.idusuario = pu.id)
				INNER JOIN sigdoc_pa_tipodocumento td ON de.idtipodocumento = td.id)
				INNER JOIN pa_juzgado pj ON de.idjuzgadodestino = pj.id)
				ORDER BY de.id DESC");
		}
		if($identrada == 2){
			
			$filtrox;
			
			$filtrof;
			$filtroh;
			$filtro1;
			$filtro4;
			$filtro5;
			$filtro6;
			$filtro7;
			$filtro9;
			$filtro10;
			
	
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$datox1    = trim($_GET['datox1']);
			$horai     = trim($_GET['datox2']);
			$horaf     = trim($_GET['datox3']);
			
			$datox4    = trim($_GET['datox4']);
			$datox5    = trim($_GET['datox5']);
			$datox6    = trim($_GET['datox6']);
			$datox7    = trim($_GET['datox7']);
			//$datox8    = trim($_GET['datox8']);
			$datox9    = trim($_GET['datox9']);
			$datox10   = trim($_GET['datox10']);
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
		
				$filtrof = " AND (de.fecha >= '$fechad' AND de.fecha <= '$fechah') ";
			
			}
			/*else{

				$filtrof = " AND (de.fecha >= '$fechaactual' AND de.fecha <= '$fechaactual') ";
			}*/
			
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND de.idjuzgadodestino = '$datox1' ";
			
			}
			if ( !empty($horai) && !empty($horaf) ) {
		
				$filtroh = " AND (de.hora >= '$horai' AND de.hora <= '$horaf') ";
			
			}
			if ( !empty($datox4) ) {
			
				$filtro4 = " AND de.remitente LIKE '%$datox4%' ";
			
			}
			if ( !empty($datox5) ) {
			
				$filtro5 = " AND de.idtipodocumento = '$datox5' ";
			
			}
			if ( !empty($datox6) ) {
			
				$filtro6 = " AND de.numero = '$datox6' ";
			
			}
			if ( !empty($datox7) ) {
			
				$filtro7 = " AND de.nfc LIKE '%$datox7%' ";
			
			}
			if ( !empty($datox9) ) {
			
				$filtro9 = " AND de.idusuario = '$datox9' ";
			
			}
			if ( !empty($datox10) || $datox10 == "0") {
			
				$filtro10 = " AND de.chk = '$datox10' ";
			
			}
			
	
			$filtrox = $filtro1." ".$filtrof." ".$filtroh." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro9." ".$filtro10;
			
			//echo $filtrox;
			
		
			$listar    = $this->db->prepare("SELECT de.id,de.fecha,de.hora,pu.empleado,de.remitente,td.nombre_tipo_documento,de.numero,de.nfc,pj.nombre,de.rutaarchivo,de.chk,de.sal_id_externo_fk
											 FROM (((sidoju_documentos_entrantes_juzgados de INNER JOIN pa_usuario pu ON de.idusuario = pu.id)
											 INNER JOIN sigdoc_pa_tipodocumento td ON de.idtipodocumento = td.id)
											 INNER JOIN pa_juzgado pj ON de.idjuzgadodestino = pj.id)
											 WHERE de.id >= '1'" .$filtrox. "
											 ORDER BY de.id DESC");
											
		}

  		$listar->execute();

  		return $listar;
	
  	}
	
	public function get_listrar_documentos_entrantes_usuario_cantidad($identrada){
	
		
		$model       = new sidojuModel();
		
		//$fechaactual = $model->get_fecha_actual_amd();
	
		//$idusuario   = $_SESSION['idUsuario'];
		
		if($identrada == 1){
		
			  
			$listar    = $this->db->prepare("SELECT COUNT(de.id) AS cantidad
											 FROM sidoju_documentos_entrantes_juzgados de");
											 
			
		}
		if($identrada == 2){
			
			$filtrox;
			
			$filtrof;
			$filtroh;
			$filtro1;
			$filtro4;
			$filtro5;
			$filtro6;
			$filtro7;
			$filtro9;
			$filtro10;
			
	
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$datox1    = trim($_GET['datox1']);
			$horai     = trim($_GET['datox2']);
			$horaf     = trim($_GET['datox3']);
			
			$datox4    = trim($_GET['datox4']);
			$datox5    = trim($_GET['datox5']);
			$datox6    = trim($_GET['datox6']);
			$datox7    = trim($_GET['datox7']);
			//$datox8    = trim($_GET['datox8']);
			$datox9    = trim($_GET['datox9']);
			$datox10   = trim($_GET['datox10']);
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
		
				$filtrof = " AND (de.fecha >= '$fechad' AND de.fecha <= '$fechah') ";
			
			}
			/*else{

				$filtrof = " AND (de.fecha >= '$fechaactual' AND de.fecha <= '$fechaactual') ";
			}*/
			
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND de.idjuzgadodestino = '$datox1' ";
			
			}
			if ( !empty($horai) && !empty($horaf) ) {
		
				$filtroh = " AND (de.hora >= '$horai' AND de.hora <= '$horaf') ";
			
			}
			if ( !empty($datox4) ) {
			
				$filtro4 = " AND de.remitente LIKE '%$datox4%' ";
			
			}
			if ( !empty($datox5) ) {
			
				$filtro5 = " AND de.idtipodocumento = '$datox5' ";
			
			}
			if ( !empty($datox6) ) {
			
				$filtro6 = " AND de.numero = '$datox6' ";
			
			}
			if ( !empty($datox7) ) {
			
				$filtro7 = " AND de.nfc LIKE '%$datox7%' ";
			
			}
			if ( !empty($datox9) ) {
			
				$filtro9 = " AND de.idusuario = '$datox9' ";
			
			}
			if ( !empty($datox10) || $datox10 == "0") {
			
				$filtro10 = " AND de.chk = '$datox10' ";
			
			}
			
	
			$filtrox = $filtro1." ".$filtrof." ".$filtroh." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro9." ".$filtro10;
			
			//echo $filtrox;
			
		  
			$listar    = $this->db->prepare("SELECT COUNT(de.id) AS cantidad
											 FROM sidoju_documentos_entrantes_juzgados de
											 WHERE de.id >= '1'" .$filtrox. " 
											 ORDER BY de.id DESC");
											
		}

  		$listar->execute();
		
		//$cantidadreg = $listar->rowCount();

  		return $listar;
	
  	}
	
	//------------------------------------------------------------------------------------------------------------------
	
	//PARA USUARIO DE LOS 25 JUZGADOS
	
	public function get_listrar_documentos_entrantes_usuario_2($identrada,$idsesionjuzgado){
	
		
		$model       = new sidojuModel();
		
		//$fechaactual = $model->get_fecha_actual_amd();
	
		//$idusuario   = $_SESSION['idUsuario'];
		
		if($identrada == 1){
		
			  
			$listar    = $this->db->prepare("SELECT de.id,de.fecha,de.hora,pu.empleado,de.remitente,td.nombre_tipo_documento,de.numero,de.nfc,pj.nombre,
											 de.rutaarchivo,de.chk
											 FROM (((sidoju_documentos_entrantes_juzgados de INNER JOIN pa_usuario pu ON de.idusuario = pu.id)
											 INNER JOIN sigdoc_pa_tipodocumento td ON de.idtipodocumento = td.id)
											 INNER JOIN pa_juzgado pj ON de.idjuzgadodestino = pj.id)
											 WHERE de.idjuzgadodestino = '$idsesionjuzgado'
											 ORDER BY de.id DESC
											 LIMIT 10");
											 
			
									 
			
		}
		if($identrada == 2){
			
			$filtrox;
			
			$filtrof;
			$filtroh;
			$filtro1;
			$filtro4;
			$filtro5;
			$filtro6;
			$filtro7;
			$filtro10;
			
	
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$datox1    = trim($_GET['datox1']);
			$horai     = trim($_GET['datox2']);
			$horaf     = trim($_GET['datox3']);
			
			$datox4    = trim($_GET['datox4']);
			$datox5    = trim($_GET['datox5']);
			$datox6    = trim($_GET['datox6']);
			$datox7    = trim($_GET['datox7']);
			//$datox8    = trim($_GET['datox8']);
			
			$datox10   = trim($_GET['datox10']);
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
		
				$filtrof = " AND (de.fecha >= '$fechad' AND de.fecha <= '$fechah') ";
			
			}
			/*else{

				$filtrof = " AND (de.fecha >= '$fechaactual' AND de.fecha <= '$fechaactual') ";
			}*/
			
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND de.idjuzgadodestino = '$datox1' ";
			
			}
			if ( !empty($horai) && !empty($horaf) ) {
		
				$filtroh = " AND (de.hora >= '$horai' AND de.hora <= '$horaf') ";
			
			}
			if ( !empty($datox4) ) {
			
				$filtro4 = " AND de.remitente LIKE '%$datox4%' ";
			
			}
			if ( !empty($datox5) ) {
			
				$filtro5 = " AND de.idtipodocumento = '$datox5' ";
			
			}
			if ( !empty($datox6) ) {
			
				$filtro6 = " AND de.numero = '$datox6' ";
			
			}
			if ( !empty($datox7) ) {
			
				$filtro7 = " AND de.nfc LIKE '%$datox7%' ";
			
			}
			
			if ( !empty($datox10) || $datox10 == "0") {
			
				$filtro10 = " AND de.chk = '$datox10' ";
			
			}
			
			
	
			$filtrox = $filtro1." ".$filtrof." ".$filtroh." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro10;
			
			//echo $filtrox;
			
		  
			$listar    = $this->db->prepare("SELECT de.id,de.fecha,de.hora,pu.empleado,de.remitente,td.nombre_tipo_documento,de.numero,de.nfc,pj.nombre,
											 de.rutaarchivo,de.chk
											 FROM (((sidoju_documentos_entrantes_juzgados de INNER JOIN pa_usuario pu ON de.idusuario = pu.id)
											 INNER JOIN sigdoc_pa_tipodocumento td ON de.idtipodocumento = td.id)
											 INNER JOIN pa_juzgado pj ON de.idjuzgadodestino = pj.id)
											 WHERE de.id >= '1'" .$filtrox. " AND de.idjuzgadodestino = '$idsesionjuzgado'
											 ORDER BY de.id DESC");
											
		}

  		$listar->execute();

  		return $listar;
	
  	}
	
	public function get_listrar_documentos_entrantes_usuario_cantidad_2($identrada,$idsesionjuzgado){
	
		
		$model       = new sidojuModel();
		
		//$fechaactual = $model->get_fecha_actual_amd();
	
		//$idusuario   = $_SESSION['idUsuario'];
		
		if($identrada == 1){
		
			  
			$listar    = $this->db->prepare("SELECT COUNT(de.id) AS cantidad
											 FROM sidoju_documentos_entrantes_juzgados de");
											 
			
									 
			
		}
		if($identrada == 2){
			
			$filtrox;
			
			$filtrof;
			$filtroh;
			$filtro1;
			$filtro4;
			$filtro5;
			$filtro6;
			$filtro7;
			$filtro10;
			
	
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$datox1    = trim($_GET['datox1']);
			$horai     = trim($_GET['datox2']);
			$horaf     = trim($_GET['datox3']);
			
			$datox4    = trim($_GET['datox4']);
			$datox5    = trim($_GET['datox5']);
			$datox6    = trim($_GET['datox6']);
			$datox7    = trim($_GET['datox7']);
			//$datox8    = trim($_GET['datox8']);
			$datox10   = trim($_GET['datox10']);
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
		
				$filtrof = " AND (de.fecha >= '$fechad' AND de.fecha <= '$fechah') ";
			
			}
			/*else{

				$filtrof = " AND (de.fecha >= '$fechaactual' AND de.fecha <= '$fechaactual') ";
			}*/
			
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND de.idjuzgadodestino = '$datox1' ";
			
			}
			if ( !empty($horai) && !empty($horaf) ) {
		
				$filtroh = " AND (de.hora >= '$horai' AND de.hora <= '$horaf') ";
			
			}
			if ( !empty($datox4) ) {
			
				$filtro4 = " AND de.remitente LIKE '%$datox4%' ";
			
			}
			if ( !empty($datox5) ) {
			
				$filtro5 = " AND de.idtipodocumento = '$datox5' ";
			
			}
			if ( !empty($datox6) ) {
			
				$filtro6 = " AND de.numero = '$datox6' ";
			
			}
			if ( !empty($datox7) ) {
			
				$filtro7 = " AND de.nfc LIKE '%$datox7%' ";
			
			}
			
			if ( !empty($datox10) || $datox10 == "0") {
			
				$filtro10 = " AND de.chk = '$datox10' ";
			
			}
			
			
	
			$filtrox = $filtro1." ".$filtrof." ".$filtroh." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro10;
			
			//echo $filtrox;
			
		  
			$listar    = $this->db->prepare("SELECT COUNT(de.id) AS cantidad
											 FROM sidoju_documentos_entrantes_juzgados de
											 WHERE de.id >= '1'" .$filtrox. " AND de.idjuzgadodestino = '$idsesionjuzgado'");
											
		}

  		$listar->execute();

  		return $listar;
	
  	}
	
	//---------------------------------------------------------------------------------------------------------------------------------------------------------------
	
	
	
	public function get_datos_documentos_entrantes_juzgados(){
		$id     = trim($_GET['id']);
		$listar = $this->db->prepare("SELECT * FROM sidoju_documentos_entrantes_juzgados WHERE id = '$id'");
  		$listar->execute();
  		return $listar;
	}

	//Obtener datos de 
	public function get_datos_documentos_entrantes_juzgados_salud(){
		$id     = trim($_GET['id']);
		$listar = $this->db->prepare("SELECT * FROM sidoju_documentos_entrantes_juzgados WHERE id = '11'");
  		$listar->execute();
  		return $listar;
	}
	
	public function get_documentos_imprimir_usuario($identrada){
	
		
		$model       = new sidojuModel();
		
		//VARIABLE QUE ME PERMITE LIMITAR LA CARGA DE REGISTROS EN LA TABLA PARA IMPRIMIR
		//Y NO TRAER TODOS LOS REGISTROS QUE A APROBADO EL USUARIO
		//$fechaactual = $model->get_fecha_actual_amd();
	
		$idusuario   = $_SESSION['idUsuario'];
		
		if($identrada == 1){
		
			   
			$listar    = $this->db->prepare("SELECT de.id,de.fecha,de.hora,pu.empleado,de.remitente,td.nombre_tipo_documento,de.numero,de.nfc,pj.nombre,de.rutaarchivo
											 FROM (((sidoju_documentos_entrantes_juzgados de INNER JOIN pa_usuario pu ON de.idusuario = pu.id)
											 INNER JOIN sigdoc_pa_tipodocumento td ON de.idtipodocumento = td.id)
											 INNER JOIN pa_juzgado pj ON de.idjuzgadodestino = pj.id)
											 WHERE de.chk = 1 AND de.idjuzgadodestino IN(SELECT id FROM pa_juzgado WHERE idusuariojuzgado = '$idusuario')
											 ORDER BY de.id DESC
											 LIMIT 5");
											 
											  //AND (de.fecha >= '$fechaactual' AND de.fecha <= '$fechaactual')
											 
			
		}
		if($identrada == 2){
			
			$filtrox;
			
			$filtrof;
			$filtro1;
			
	
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$datox1    = trim($_GET['datox1']);
			
		
			if ( !empty($fechad) && !empty($fechah) ) {
		
				$filtrof = " AND (de.fecha >= '$fechad' AND de.fecha <= '$fechah') ";
			
			}
			//SI NO DEFINO FECHA TOMA LA FECHA ACTUAL PARA EL FILTRO
			/*else{

				$filtrof = " AND (de.fecha >= '$fechaactual' AND de.fecha <= '$fechaactual') ";
			}*/
			
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND de.idjuzgadodestino = '$datox1' ";
			
			}
			
		
			$filtrox = $filtro1." ".$filtrof;
			
			//echo $filtrox;
			
		  
			$listar    = $this->db->prepare("SELECT de.id,de.fecha,de.hora,pu.empleado,de.remitente,td.nombre_tipo_documento,de.numero,de.nfc,pj.nombre,de.rutaarchivo
											 FROM (((sidoju_documentos_entrantes_juzgados de INNER JOIN pa_usuario pu ON de.idusuario = pu.id)
											 INNER JOIN sigdoc_pa_tipodocumento td ON de.idtipodocumento = td.id)
											 INNER JOIN pa_juzgado pj ON de.idjuzgadodestino = pj.id)
											 WHERE de.chk = 1 
											 AND de.idjuzgadodestino IN(SELECT id FROM pa_juzgado WHERE idusuariojuzgado = '$idusuario') " .$filtrox. "
											 ORDER BY de.id DESC");
											
		}

  		$listar->execute();

  		return $listar;
	
  	}
	
	public function registrar_documentos_entrantes_juzgados(){
		$modelo     = new sidojuModel();
		//Variable que maneja el update o insert
		$iddocumento   = trim($_POST['iddocumento']);
		//SE OBTIENEN LOS DATOS
		$idusuario      = $_SESSION['idUsuario'];
		$fechae         = trim($_POST['fechae']);
		
		//SE REALIZA ESTE CAMBIO PARA PODER TOMAR LA HORA REAL EN QUE SE HACE EL REGISTRO Y NO AL MOMENTO DE ESTAR LLENANDO LA INFORMACION
		//EN EL FORMÇÇULARIO, ES DECIR ENTRO AL FORMULARIO Y SON LAS 11:37 Y MIENTRAS LO LLENO ME DAN LAS 11:38 LA HORA REAL A REGISTRAR ES
		//11:38
		//$horae          = trim($_POST['horae']);
		$horae          = $modelo->get_hora_actual_24horas();
		$remitente      = trim($_POST['remitente']);
		$tipodocumento  = trim($_POST['tipodocumento']);
		$numerodoce     = trim($_POST['numerodoce']);
		$nfc            = trim($_POST['nfc']);
		
		//ESTO SE REALIZA PARA PODER TOMAR EL NOMBRE DEL JUZGADO QUE SE LE ESTA SCANIANDO
		//UN DOCUMENTO Y NO COMO ESTABA ANTES QUE ERA EL USUARIO QUE SCANEBA EL DOCUMENTO
		//CAMBIO REALIZADO EL 10 DE MAYO 2016
		$juzgadodestino_a     = explode("//////",trim($_POST['juzgadodestino']));
		$juzgadodestino       = $juzgadodestino_a[0];
		$juzgadodestinonombre = $juzgadodestino_a[1];

		//DATOS PARA EL REGISTRO DEL LOG
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];

		$tiporegistro = "Entrada de Documento";
		
		if( empty($iddocumento) ){
			$accion  = "Registra una Nueva ".$tiporegistro." En el Sistema (SIDOJU) REGISTRO DOCUMENTOS ENTRANTES JUZGADOS";
		} else{
			$accion  = "Modifica una ".$tiporegistro." En el Sistema (SIDOJU) REGISTRO DOCUMENTOS ENTRANTES JUZGADOS, ID DOCUMENTO: ".$iddocumento;
		}
      	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog = 5;
	
	
		//***********************************PARA EL ARCHIVO***************************************

		//CREO EL DIRECTORIO DEL USUARIO QUE NO ES MAS QUE EL ID DEL USUARIO DE LA TABLA pa_usuario 
		$raiz = "ArchivosSidoju";
		//ID DEL USUARIO DE LA TABLA pa_usuario
		$nom_u = trim($_SESSION['idUsuario']);
		//ASINO A LA VARIABLE $nom EL NOMBRE DEL JUZGADO SELECCIONADO
		$nom   = $juzgadodestinonombre;
		
		//AQUI SE CREA EL DIRECTORIO
		if(is_dir($raiz.'/'.$nom)){$bandera=0;}
		else{mkdir($raiz.'/'.$nom, 0, true);}
		
		//datos del arhivo 
		$nombre_archivo = $nom_u."_".$_FILES['archivo']['name']; 
		//echo $nombre_archivo;
		$tipo_archivo   = $_FILES['archivo']['type'];
		//echo $tipo_archivo;
		$tamano_archivo = $_FILES['archivo']['size']; 
		//echo $tamano_archivo;
		
		//SE REALIZA LA PREGUNTA AGREGANDOLE $nombre_archivo != $nom_u."_"
		//YA QUE LA VARIABLE $nombre_archivo NUNCA VA HACER VACIA POR QUE SE CONCATENA CON EL USUARIO QUE ESTA EN SESION
		//ASI EL USUARIO EN SESION NO ADJUNTE ALGUN ARCHIVO, ESTO CON EL OBJETO DE EVITAR 
		//INCONSISTENCIA AL REALIZAR UN REGISTRO EN EL CUAL NO SE SELECCIONE NINGUN ARCHIVO
		if ($nombre_archivo != "" && $nombre_archivo != $nom_u."_") {//IF QUE ME IDENTIFICA QUE SE SELECCIONO UN ARCHIVO
		
			if (! ( strpos($tipo_archivo, "vnd.ms-excel") //csv
			|| strpos($tipo_archivo, "vnd.openxmlformats-officedocument.spreadsheetml.sheet") //xlsx
			|| strpos($tipo_archivo, "vnd.openxmlformats-officedocument.wordprocessingml.document")//docx
			|| strpos($tipo_archivo, "pdf") //pdf
			) && ($tamano_archivo < 800000000) )  {
			/*Adicional a esta comparacion, se debe configurar en php.ini (y reiniciar):
			**upload_max_filesize = 80M
			**post_max_size = 70M*/
			
				//echo "1 EL ARCHIVO NO CUMPLE CON LAS CARACTERISTICAS ESPECIFICAS";
				
				//echo "El Archivo no Cumple con las Caracteristicas Especificas, si es diferente de tipo (vnd.ms-excel,vnd.openxmlformats-officedocument.spreadsheetml.sheet, vnd.openxmlformats-officedocument.wordprocessingml.document,pdf) y tamaño de archivo < 100000000.";
				
				//print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=3b&idmensaje=1"</script>';
				
				print'<script languaje="Javascript">alert("El Archivo no Cumple con las Caracteristicas Especificas, si es diferente de tipo (pdf) o tamaño de archivo < 70MB.")</script>';
				
				
				//ESTA PARTE SE USA PARA SEBER EL TIPO DEL ARCHIVO Y PONERLO EN EL IF
				/*echo '<script languaje="JavaScript"> var dat_1 = "'.$tipo_archivo.'";alert(dat_1);</script>';*/
			} else{//1 
				
				if ( file_exists($raiz.'/'.$nom.'/'.$nombre_archivo) ) {
					//echo "2 YA EXISTE UN ARCHIVO CON ESE NOMBRE";
					
					/*print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=3b&idmensaje=2"</script>';*/
					
					//OBTENGO UN ID PARA IDENTIFICAR UN ARCHIVO CON EL MISMO NOMBRE
					//PARA AGREGARLE EL ID A ESE NOMBRE Y QUE EL SISTEMA CONTINUE SIN AVISO DE YA EXISTE UN ARCHIVO CON ESE NOMBRE
					$idunico = time();
					
					$nombre_archivo = $idunico."_".$nombre_archivo;
					
					
				}
				//else{//2
				
					if ( move_uploaded_file($_FILES['archivo']['tmp_name'], $raiz.'/'.$nom.'/'.$nombre_archivo) ){//3
						 //echo "EL ARCHIVO HA SUBIDO AL SERVIDOR CORRECTAMENTE."."\n"; 
						 
						 
						 $rutaarchivo = $raiz.'/'.$nom.'/'.$nombre_archivo;
						 
						 
						 //-------------------------SE REGISTRAN LOS DATOS EN LA TABLA-----------------------------------------
						 //-------------------------CUANDO SE DEFINE UN ARCHIVO------------------------------------------------
						 try {  
		
							$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
							//EMPIEZA LA TRANSACCION
							$this->db->beginTransaction();
							
								
								if( empty($iddocumento) ){
								
									$this->db->exec("INSERT INTO sidoju_documentos_entrantes_juzgados (idusuario,idusuarioedita,idusuarioverifica,fecha,
													 fechaedita,fechaverifica,hora,remitente,idtipodocumento,numero,nfc,idjuzgadodestino,rutaarchivo,nombrebloque,chk)
													 VALUES ('$idusuario',0,0,'$fechae','0000-00-00','0000-00-00','$horae','$remitente','$tipodocumento','$numerodoce','$nfc',
													 '$juzgadodestino','$rutaarchivo','',0)");
								}
								else{
									
									//EN ESTA SQL NO SE ACTUALIZA EL JUZGADO
									/*$this->db->exec("UPDATE sidoju_documentos_entrantes_juzgados SET remitente = '$remitente',idtipodocumento = '$tipodocumento',
													 numero = '$numerodoce',nfc = '$nfc',rutaarchivo = '$rutaarchivo',
													 idusuarioedita = '$idusuario',fechaedita = '$fechalog'
													 WHERE id = '$iddocumento'");*/
													 
													 
									$this->db->exec("UPDATE sidoju_documentos_entrantes_juzgados SET remitente = '$remitente',idtipodocumento = '$tipodocumento',
													 numero = '$numerodoce',nfc = '$nfc',idjuzgadodestino = '$juzgadodestino' ,rutaarchivo = '$rutaarchivo',
													 idusuarioedita = '$idusuario',fechaedita = '$fechalog'
													 WHERE id = '$iddocumento'");
													
												 
								}
								
								$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
								
							
							//SE TERMINA LA TRANSACCION  
							$this->db->commit();
							
							//echo $nombre_archivo;
							print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=2"</script>';
						  
						} 
						catch (Exception $e) {
						
							//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
							$this->db->rollBack();
							//echo "Fallo: " . $e->getMessage();
							print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=2b"</script>'; 
						}
						//---------------------------------------------------------------------------------------------------------------------------------------
						
					}//3
					else{ 
						 //echo "Error al subir el fichero."; 
						 print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=3b&idmensaje=3"</script>';
					} 
				
				//}//2
				
			}//1
			
		}//FIN IF QUE ME IDENTIFICA QUE SE SELECCIONO UN ARCHIVO
		else{//NO SE DEFINE UN ARCHIVO
		
			//-------------------------SE REGISTRAN LOS DATOS EN LA TABLA-----------------------------------------
			//-------------------------CUANDO NO SE DEFINE UN ARCHIVO------------------------------------------------
			try {  
					$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
					//EMPIEZA LA TRANSACCION
					$this->db->beginTransaction();	
						if( empty($iddocumento) ){
							$this->db->exec("INSERT INTO sidoju_documentos_entrantes_juzgados (idusuario,idusuarioedita,idusuarioverifica,fecha,
											 fechaedita,fechaverifica,hora,remitente,idtipodocumento,numero,nfc,idjuzgadodestino,rutaarchivo,nombrebloque,chk)
											 VALUES ('$idusuario',0,0,'$fechae','0000-00-00','0000-00-00','$horae','$remitente','$tipodocumento','$numerodoce','$nfc',
											 '$juzgadodestino','$rutaarchivo','',0)");
						} else{		
							$this->db->exec("UPDATE sidoju_documentos_entrantes_juzgados SET remitente = '$remitente',idtipodocumento = '$tipodocumento',
											numero = '$numerodoce',nfc = '$nfc',idjuzgadodestino = '$juzgadodestino',
											idusuarioedita = '$idusuario',fechaedita = '$fechalog'
											WHERE id = '$iddocumento'");
													 
						}			
						$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
					//SE TERMINA LA TRANSACCION  
					$this->db->commit();
					
					//echo $nombre_archivo;
					print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=2"</script>';
						  
			} 
			catch (Exception $e) {
						
				//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
				$this->db->rollBack();
				//echo "Fallo: " . $e->getMessage();
				print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=2b"</script>'; 
			}
			//---------------------------------------------------------------------------------------------------------------------------------------
		}//FIN ELSE NO SE DEFINE UN ARCHIVO
	}//FIN FUNCION
	
	
	//BD externa ConcejoPN, Oficina Judicial
	//Incidente de Desacato en Salud
	public function registrar_documentos_entrantes_juzgados_salud(){
		$modelo      = new sidojuModel();
		$fechaactual = $modelo->get_fecha_actual_amd();
		$horaactual  = $modelo->get_hora_actual_24horas();
		//Variable que maneja el update o insert
		$iddocumento = trim($_POST['iddocumento']);
		$radicado = trim($_POST['txt_radicado']);
		$radicado2 = substr("$radicado", 0, -2);
		$numerodoce = trim($_POST['numerodoce']);
		$nfc = trim($_POST['nfc']);
		$idusuario   = $_SESSION['idUsuario'];
		$fechahora   = $modelo->get_fecha_actual();

	$cid = ftp_connect("192.168.89.28");
	//$cid = ftp_connect("172.16.172.90");
	$resultado = ftp_login($cid, "anonymous","");
	// Cambiamos a modo pasivo, esto es importante porque, de esta manera le decimos al 
	//servidor que seremos nosotros quienes comenzaremos la transmisión de datos.
	ftp_pasv ($cid, true) ;
	//Cambio a modo pasivo
	// Nos cambiamos al directorio, donde queremos subir los archivos, si se van a subir a la raíz
	// esta por demás decir que este paso no es necesario. En mi caso uso un directorio llamado boca
	ftp_chdir($cid, "");
	//Cambiado al directorio necesario   
	// Tomamos el nombre del archivo a transmitir, pero en lugar de usar $_POST, usamos $_FILES que le indica a PHP
	// Que estamos transmitiendo un archivo, esto es en realidad un matriz, el segundo argumento de la matriz, indica
	// el nombre del archivo
	$raiz = "file_Incidentes_Salud";
	$nom   = 3;
	$idunico = time();
	$nombre_archivo = $idusuario."_".$idunico."_".$_FILES['archivo']['name'];
	// Este es el nombre temporal del archivo mientras dura la transmisión
	$remoto = $_FILES["archivo"]["tmp_name"];
	// El tamaño del archivo
	$tama = $_FILES["archivo"]["size"];
	//echo "subiendo el archivo...<br />";
	// Juntamos la ruta del servidor con el nombre real del archivo
	$ruta = "ftp://192.168.89.28/" . $nombre_archivo;
	$tipo_archivo = $_FILES['archivo']['type'];
	$rutaarchivo = $raiz.'/'.$nom.'/'.$nombre_archivo;
	$juzgadodestino_a = explode("-",trim($_POST['juzgadodestino']));
	$juzgadodestino   = $juzgadodestino_a[0];
	$juzgadodestino2  = $juzgadodestino_a[0]+12;
	$datosfecha = explode(" ",$fechaactual);
	$fechalog   = $datosfecha[0];
	$horalog    = $datosfecha[1];
	// Verificamos si ya se subio el archivo temporal y si es PDF
	if (is_uploaded_file($remoto)) {
		if ($tipo_archivo=="application/pdf") {
		// copiamos el archivo temporal, del directorio de temporales de nuestro servidor a la ruta que creamos
		//copy($remoto, $ruta);
	//ftp_close($cid);
		if(empty($iddocumento) ){
			$accion  = "Registra una Nueva Entrada de Documento En el Sistema (SIDOJU) REGISTRO DOCUMENTOS ENTRANTES JUZGADOS";
		} else {
			$accion  = "Modifica una Entrada de Documento En el Sistema (SIDOJU) REGISTRO DOCUMENTOS ENTRANTES JUZGADOS, ID DOCUMENTO: ".$iddocumento;
		}
      	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horaactual;
		$tipolog = 5;
	    /*$connJudicial = mysql_connect("localhost", "root", "admin");
	    mysql_select_db("bd_oficina_judicial", $connJudicial);*/
	    $connJudicial = mysql_connect("192.168.89.28", "cscf_salud", "Servicios25%") or die(mysql_error());
	    mysql_select_db("bd_oficina_judicial", $connJudicial);
	    //try {
	    $salud = "INSERT INTO salud_documento_entrante (sal_id_usuario, sal_id_juzgado_int, sal_fecha, sal_hora, sal_radicado, sal_remitente, sal_id_tipo_documento, sal_numero, sal_nfc, sal_id_juzgado_destino,sal_ruta_documento,sal_id_estado,sal_id_bd_externa) ";
	    $salud.= "VALUES ($idusuario,$juzgadodestino,'".$_POST['fechae']."','$horaactual','$radicado','".$_POST['remitente']."',1,'$numerodoce','".$_POST['nfc']."',$juzgadodestino2,'$rutaarchivo',1,3) ";
	    echo "<br>";
	    echo $idusuario;
	    echo "<br>";
	    echo $juzgadodestino;
	    echo "<br>";
	    $res1 = mysql_query($salud, $connJudicial) or die(mysql_error());
	    ftp_close($cid);
		$id_sal = mysql_insert_id();
		$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
		$this->db->exec("INSERT INTO sidoju_documentos_entrantes_juzgados (idusuario,idusuarioedita,idusuarioverifica,fecha,fechaedita,fechaverifica,hora,remitente,idtipodocumento,numero,nfc,idjuzgadodestino,rutaarchivo,nombrebloque,chk,sal_id_externo_fk,sal_radicado)
		VALUES ('$idusuario',0,0,'".$_POST['fechae']."','0000-00-00','0000-00-00','$horaactual','".$_POST['remitente']."','100','".$_POST['numerodoce']."','".$_POST['nfc']."','$juzgadodestino','$rutaarchivo','',0,'$id_sal',$radicado)");

		/*$serverName = "DESKTOP-8FLD29P\SQLEXPRESS";
        $datosbd_2 = "ConsejoPN";
        $datosbd_3 = "sa";
        $datosbd_4 = "111";*/
        $serverName = "192.168.89.20";
        $datosbd_2 = "consejoPN";
        $datosbd_3 = "sa";
        $datosbd_4 = "M4nt3n1m13nt0";
        //MAX a110consactu
        $conn = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
        $conn = sqlsrv_connect($serverName, $conn);
        /*if( $conn === false ) { die( print_r( sqlsrv_errors(), true)); }*/
		$sql = "INSERT INTO [ConsejoPN].[dbo].[t110dractuproc] (a110llavproc,a110consactu,a110numeproc,a110consproc,a110codiactu,a110codipadr,a110descactu,a110legajudi,a110flagterm,a110tipoterm,a110numdterm,a110fechinic,a110fechfina,a110fechregi,a110foliproc,a110cuadproc,a110codiprov,a110numeprov,a110fechprov,a110anotactu,a110fechofic,a110numeofic,a110flagubic,a110tipoactu,a110fechdesa,a110borrterm,a110renuterm) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$params = array($radicado,$id_sal,$radicado2,"00","30023589","30010162","Recepcion Incidente de Desacato en Salud","N","NO","N","0","","","","","","","","","Se Registra el Documento, Incidente de Desacato en Salud","","","S","D","","NO","NO");
		$stmt = sqlsrv_query( $conn, $sql, $params);

		$sql_actuacion = "UPDATE [ConsejoPN].[dbo].[T103DAINFOPROC] 
		SET a103codipads = ?,a103fechdess = ?,a103anotacts = ? WHERE a103llavproc = ?";
		$params2 = array("30010162",$fechaactual,"Recepcion Incidente de Desacato en Salud",$radicado);
		$stmt2 = sqlsrv_query( $conn, $sql_actuacion, $params2);
		$rows_affected2 = sqlsrv_rows_affected($stmt2);
		}
		}

		if ($tipo_archivo!="application/pdf") {
			print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=3b&idmensaje=1"</script>';
			//diferente de pdf
		} else
		//Ok
		print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=2"</script>';
		/*$this->db->commit();
		}
		catch (Exception $e) {
			$this->db->rollBack();
			print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=4b"</script>';
		}*/
	}


	public function registrar_vereficar_documentos_entrantes_juzgados(){
	
	
		//SE OBTIENEN LOS DATOS
		$idusuario  = $_SESSION['idUsuario'];
		
		//NOMBRE DEL JUZGADO
		$dj         = trim($_GET['dj']);
		$idspermiso = trim($_GET['idspermiso']);
		
		$ides       = explode("******",$idspermiso);
		$longid     = count($ides);
		$i=0;
		
	
		//DATOS PARA EL REGISTRO DEL LOG
		
		$modelo     = new sidojuModel();
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
		
		
		$tiporegistro = "Verificacion de Documentos";
		
		$accion  = "Registra una Nueva ".$tiporegistro." En el Sistema (SIDOJU) VERIFICAR DOCUMENTOS ENTRANTES JUZGADOS";
		
      	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog = 5;
		
		//--------------------------------------------------------------------------------------------------------------------
		
		//NOMBRE DEL BLOQUE, QUE IDENTIFICA UN CONJUNTO DE REGISTROS
		$nombrebloque = $dj."".$fechahora;
		
		try {
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   		
				while($i < $longid){
					
					$id = $ides[$i];
						
					$sql = "UPDATE sidoju_documentos_entrantes_juzgados SET chk = '1',idusuarioverifica = '$idusuario',fechaverifica = '$fechalog',
							nombrebloque = '$nombrebloque'
					        WHERE  id = '$id'";
						
					$this->db->exec($sql);
							
					$i = $i + 1;
					
					//CARGO LOS IDES DE LOS REGISTROS PARA GENERAR EL REPORTE, QUE ACABAN DE SER APROBADOS
					$idimprimir = $id.",".$idimprimir;
					//CARGO LA VARIABLE SIN EL PRIMER CARACTER QUE ES UNA COMA (,) --> ,9,8,7,6,5,4,3,2,1, --> 9,8,7,6,5,4,3,2,1,
					$registros  = substr($idimprimir,1);
					
				}
				
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
				
			
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			
			//GENERO EL REPORTE PERO SE VERIFICA ANTES QUE LA TRANSACCION ES CORRECTA
			echo '<script languaje="JavaScript"> 
									
						var datos = "'.$registros.'";
	
						window.open("views/PHPPdf/Reporte_ADEJ.php?datos="+datos);
								
											
				 </script>';
			
			print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=4"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	//echo "Fallo: " . $e->getMessage();
			print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=4b"</script>';
		}
		
		
  	}
	
	public function eliminar_documentos_entrantes_juzgados(){ 
        $idusuario  = $_SESSION['idUsuario'];
        $id         = $_POST['id'];
        $comentario = $_POST['comentario_elimina'];
        //DATOS PARA EL REGISTRO DEL LOG
        $modelo     = new sidojuModel();
        $fechahora  = $modelo->get_fecha_actual();
        $datosfecha = explode(" ",$fechahora);
        $fechalog   = $datosfecha[0];
        $horalog    = $datosfecha[1];
        $tiporegistro = "Registro de Documentos.";
        $accion  = "Elimina ".$tiporegistro." En el Sistema (SIDOJU) DOCUMENTOS ENTRANTES JUZGADOS";
        $detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
        $tipolog = 5;
        try {	
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //EMPIEZA LA TRANSACCION
            $this->db->beginTransaction();
            $sql = "UPDATE sidoju_documentos_entrantes_juzgados 
                        SET id_usuario_del = '$idusuario',
                            motivo_del = '$comentario'
                        WHERE  id = '$id' ";
            $this->db->exec($sql);
            $sql_del = "DELETE FROM sidoju_documentos_entrantes_juzgados 
                        WHERE  id = '$id' ";
            $this->db->exec($sql_del);
            $this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
            //SE TERMINA LA TRANSACCION  
            $this->db->commit();
            print'<script languaje="Javascript">alert("Registro Eliminado correctamente.")</script>';
        } catch (Exception $e) {
            //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
            $this->db->rollBack();
            //echo "Fallo: " . $e->getMessage();
            print'<script languaje="Javascript">alert("Error al Eliminar Registro.")</script>';
            //print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=4E"</script>';
        }   
    }
	
}//FIN CLASE

?>