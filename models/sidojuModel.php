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
		return $fecharegistro; 
	}
	
	public function get_fecha_actual_amd(){
		//FORMA WIN 7 Y 8, YA QUE DE LA FORMA ANTERIOR TOMA EL AM O PM Y DA CONFLICTOS PARA 
		//GUARDAR EN LA BASE DE DATOS EN ESTE CASO LA TABLA detalle_correspondencia 
		//CAMPO fecha QUE ES DATETIME 
		date_default_timezone_set('America/Bogota'); 
		$fecharegistro=date('Y-m-d'); //FORMA PARA XP
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
		$listar     = $this->db->prepare("SELECT pu.empleado FROM (pa_juzgado pj INNER JOIN pa_usuario pu ON pj.idusuariojuzgado = pu.id) WHERE pj.id = '$idjuzgado'");
  		$listar->execute();
  		return $listar;
	}
	

	public function get_documentos_entrantes_usuario($identrada){
		$model       = new sidojuModel();
		$fechaactual = $model->get_fecha_actual_amd();
		$idusuario   = $_SESSION['idUsuario'];
		if($identrada == 1){
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
		//Si no escoge un filtro de busqueda
		if($identrada == 1){
			$listar    = $this->db->prepare("SELECT de.id,de.fecha,de.hora,pu.empleado,de.remitente,td.nombre_tipo_documento,de.numero,de.nfc,pj.nombre,de.rutaarchivo,de.chk,de.sal_id_externo_fk,de.sal_id_estado
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
			
		
			$listar    = $this->db->prepare("SELECT de.id,de.fecha,de.hora,pu.empleado,de.remitente,td.nombre_tipo_documento,de.numero,de.nfc,pj.nombre,de.rutaarchivo,de.chk,de.sal_id_externo_fk,de.sal_id_estado
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
			$listar    = $this->db->prepare("SELECT COUNT(de.id) AS cantidad FROM sidoju_documentos_entrantes_juzgados de WHERE de.id >= '1'" .$filtrox. " ORDER BY de.id DESC");		
		}
  		$listar->execute();
  		return $listar;
  	}

	//PARA USUARIO DE LOS 25 JUZGADOS
	public function get_listrar_documentos_entrantes_usuario_2($identrada,$idsesionjuzgado){
		$model       = new sidojuModel();
		if($identrada == 1){
			$listar    = $this->db->prepare("SELECT de.id,de.fecha,de.hora,pu.empleado,de.remitente,td.nombre_tipo_documento,de.numero,de.nfc,pj.nombre,de.rutaarchivo,de.chk,de.sal_id_externo_fk,de.sal_id_estado FROM (((sidoju_documentos_entrantes_juzgados de INNER JOIN pa_usuario pu ON de.idusuario = pu.id) INNER JOIN sigdoc_pa_tipodocumento td ON de.idtipodocumento = td.id) INNER JOIN pa_juzgado pj ON de.idjuzgadodestino = pj.id) WHERE de.idjuzgadodestino = '$idsesionjuzgado' ORDER BY de.id DESC LIMIT 10");
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
			$datox10   = trim($_GET['datox10']);
			if ( !empty($fechad) && !empty($fechah) ) {
				$filtrof = " AND (de.fecha >= '$fechad' AND de.fecha <= '$fechah') ";
			}
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
			
		  
			$listar    = $this->db->prepare("SELECT de.id,de.fecha,de.hora,pu.empleado,de.remitente,td.nombre_tipo_documento,de.numero,de.nfc,pj.nombre,de.rutaarchivo,de.chk,de.sal_id_externo_fk,de.sal_id_estado FROM (((sidoju_documentos_entrantes_juzgados de INNER JOIN pa_usuario pu ON de.idusuario = pu.id) INNER JOIN sigdoc_pa_tipodocumento td ON de.idtipodocumento = td.id) INNER JOIN pa_juzgado pj ON de.idjuzgadodestino = pj.id) WHERE de.id >= '1'" .$filtrox. " AND de.idjuzgadodestino = '$idsesionjuzgado' ORDER BY de.id DESC");			
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
			$listar    = $this->db->prepare("SELECT COUNT(de.id) AS cantidad
											 FROM sidoju_documentos_entrantes_juzgados de
											 WHERE de.id >= '1'" .$filtrox. " AND de.idjuzgadodestino = '$idsesionjuzgado'");
											
		}
  		$listar->execute();
  		return $listar;
  	}
	

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
		$idusuario   = $_SESSION['idUsuario'];
		if($identrada == 1){
			$listar    = $this->db->prepare("SELECT de.id,de.fecha,de.hora,pu.empleado,de.remitente,td.nombre_tipo_documento,de.numero,de.nfc,pj.nombre,de.rutaarchivo FROM (((sidoju_documentos_entrantes_juzgados de INNER JOIN pa_usuario pu ON de.idusuario = pu.id) INNER JOIN sigdoc_pa_tipodocumento td ON de.idtipodocumento = td.id) INNER JOIN pa_juzgado pj ON de.idjuzgadodestino = pj.id) WHERE de.chk = 1 AND de.idjuzgadodestino IN(SELECT id FROM pa_juzgado WHERE idusuariojuzgado = '$idusuario') ORDER BY de.id DESC LIMIT 5");
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
			if ( !empty($datox1) ) {
				$filtro1 = " AND de.idjuzgadodestino = '$datox1' ";
			}
			$filtrox = $filtro1." ".$filtrof;
			//echo $filtrox;	
			$listar    = $this->db->prepare("SELECT de.id,de.fecha,de.hora,pu.empleado,de.remitente,td.nombre_tipo_documento,de.numero,de.nfc,pj.nombre,de.rutaarchivo FROM (((sidoju_documentos_entrantes_juzgados de INNER JOIN pa_usuario pu ON de.idusuario = pu.id) INNER JOIN sigdoc_pa_tipodocumento td ON de.idtipodocumento = td.id) INNER JOIN pa_juzgado pj ON de.idjuzgadodestino = pj.id) WHERE de.chk = 1 AND de.idjuzgadodestino IN(SELECT id FROM pa_juzgado WHERE idusuariojuzgado = '$idusuario') " .$filtrox. " ORDER BY de.id DESC");
		}
  		$listar->execute();
  		return $listar;
  	}

	//INFORMACION DE LA BASE DE DATOS, PARA SU CONEXION
	public function get_datos_basededatos($idbd){
  
  		$listar     = $this->db->prepare("SELECT * FROM pa_base_datos WHERE id = ".$idbd);
	
  		$listar->execute();

  		return $listar;
		
	} 
	
	
	public function registrar_documentos_entrantes_juzgados(){
	
		$modelo     = new sidojuModel();
		
		require_once('ftp/ftp_class.php');
		
		//VARIABLE QUE MANEJA EL INSERT O UPDATE DE UN NUEVO DOCUMENTO ENTRANTE
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
		
		
		//PARA INCIDENTE DESACATO EN SALUD
		//ADICIONADO POR INGENIERO JORGE ANDRES VALENCIA 4 DE FEBRERO 2020
		$id_clasesalud    = $_POST['clase_solicitud_salud'];
		$id_subclasesalud = $_POST['subclase_solicitud_salud'];
		$id_eps           = $_POST['eps_salud'];
		//FIN PARA INCIDENTE DESACATO EN SALUD
		
		
		//ESTO SE REALIZA PARA PODER TOMAR EL NOMBRE DEL JUZGADO QUE SE LE ESTA SCANIANDO
		//UN DOCUMENTO Y NO COMO ESTABA ANTES QUE ERA EL USUARIO QUE SCANEBA EL DOCUMENTO
		//CAMBIO REALIZADO EL 10 DE MAYO 2016
		$juzgadodestino_a     = explode("//////",trim($_POST['juzgadodestino']));
		$juzgadodestino       = $juzgadodestino_a[0];
		$juzgadodestinonombre = $juzgadodestino_a[1];
		//---------------------------------------------------------------------------------
		
		
		//DATOS PARA EL REGISTRO DEL LOG
		
		//$modelo     = new sidojuModel();
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
		
		
		$tiporegistro = "Entrada de Documento";
		
		if( empty($iddocumento) ){
			$accion  = "Registra una Nueva ".$tiporegistro." En el Sistema (SIDOJU) REGISTRO DOCUMENTOS ENTRANTES JUZGADOS";
		}
		else{
			$accion  = "Modifica una ".$tiporegistro." En el Sistema (SIDOJU) REGISTRO DOCUMENTOS ENTRANTES JUZGADOS, ID DOCUMENTO: ".$iddocumento;
		}
      	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog = 5;
		
		
		
		$error_transaccion = 0; //variable para detectar error
		$msgError          = "";
		
		
		//SI ES INCIDENTE SALUD
		//AGREGADO POR JORGE ANDRES VALENCIA OROZCO 12 DICIEMBRE DE 2019
		if($tipodocumento == 10){
		
			
			$idubicacionexpediente = trim($_POST['idradisalud']);
			$radicado              = trim($_POST['radisalud']);	
			
			$fecha_entrega         = $modelo->get_fecha_actual_amd();
			$hora_militar          = $modelo->get_hora_actual_24horas();
			
		
			//CONEXION BASE DE DATOS JUSTICIA XXI, SE CAMBIA 8 POR 7 PARA CONEXIO REAL
			$datosbd   = $modelo->get_datos_basededatos(7);
			$datosbd_b = $datosbd->fetch();
			$datosbd_1 = $datosbd_b[ip];
			$datosbd_2 = $datosbd_b[bd];
			$datosbd_3 = $datosbd_b[usuario];
			$datosbd_4 = $datosbd_b[clave];
			
			
			//--------------------------SUBIDA DEL ARCHIVO ESCANEADO DE INCIDENTE EN SALUD------------------------------------
			//$server  = '172.16.172.90';//IP EQUIPO AL LADO DEL SERVIDOR OFICINA OECM
			//$server  = "C07003-OF13316";//NOMBRE EQUIPO AL LADO DEL SERVIDOR OFICINA OECM
			
			//$server     = "172.16.177.42";//SERVIDOR JUANCHO INGENIERO OFICINA JUDICIAL
			
			$server  = '192.168.89.28';//SERVIDOR REAL PARA EL APLICATIVO INCIDENTE DESACATO EN SALUD
			
			
			$usuario = 'anonymous';
			$pass    = '';
			$ftp     = new FTPClient();
			$ftp->connect($server,$usuario,$pass);
			$arrayMensajes = $ftp->getMessages();
			
			if($arrayMensajes[0] == trim('FALLO CONEXION')){
				
				$error_transaccion = 1;
				
				$ENTRE = "FALLO CONEXION FTP";
			}
			if($arrayMensajes[0] == trim('CONEXION OK')){
			
				$error_transaccion = 0;
				
				//CREAR DIRECTORIO
				//$dir = '3'.'/'.$juzgadodestinonombre;//PARA PRUEBAS CENTRO DE SERVICIOS CIVIL FAMILIA  
				$dir = '3';//PARA PRUEBAS CENTRO DE SERVICIOS CIVIL FAMILIA    
				$ftp->makeDir($dir); 
				
				//$raiz_ftp = "D:/SALUD";//PARA PRUEBAS
				$raiz_ftp = "file_Incidentes_Salud";//PARA SERVIDOR REAL PARA EL APLICATIVO INCIDENTE DESACATO EN SALUD
				
				
			}
			
			/*foreach($arrayMensajes as $mensajes){
				
				//echo $mensajes.' ';
				
				echo '<script languaje="JavaScript"> 
						
									
						var conexion            = "'.$mensajes.'";
						var error_transaccion_1 = "'.$error_transaccion.'";
									
						alert("CONEXION :"+ conexion+", error_transaccion: "+error_transaccion_1);
									
									
											
					</script>';
			}*/
			
			//--------------------------FIN SUBIDA DEL ARCHIVO ESCANEADO DE INCIDENTE EN SALUD------------------------------------
			
			
		
		
			//CONEXION BASE DE DATOS LOCAL
			$datosbd     = $modelo->get_datos_basededatos(10);//SERVIDOR LOCAL PARA PRUEBAS, SE CAMBIA 9 POR 10 PARA CONEXIO REAL
			
			
			$datosbd_b   = $datosbd->fetch();
			$bd_host     = $datosbd_b[ip];
			$bd_base     = $datosbd_b[bd];
			$bd_usuario  = $datosbd_b[usuario];
			$bd_password = $datosbd_b[clave];
			
			$conexion    = mysql_connect($bd_host, $bd_usuario, $bd_password); 
			mysql_select_db($bd_base, $conexion); 
			
			
			/*echo '<script languaje="JavaScript"> 
					
								
					var conexion = "'.$conexion.'";
								
					alert("CONEXION :"+ conexion);
								
								
										
				</script>';*/
			
			
			if($conexion > 0){
			
				//***********************************PARA EL ARCHIVO***************************************
				
				
				
				
				//CREO EL DIRECTORIO DEL USUARIO QUE NO ES MAS QUE EL ID DEL USUARIO DE LA TABLA pa_usuario 
				/*$raiz = "ArchivosSidoju";
				//ID DEL USUARIO DE LA TABLA pa_usuario
				$nom_u = trim($_SESSION['idUsuario']);
				//ASINO A LA VARIABLE $nom EL NOMBRE DEL JUZGADO SELECCIONADO
				$nom   = $juzgadodestinonombre;
				
				//AQUI SE CREA EL DIRECTORIO
				if(is_dir($raiz.'/'.$nom)){$bandera=0;}
				else{mkdir($raiz.'/'.$nom, 0, true);}*/
				
				
				
	
				//CREO EL DIRECTORIO DEL USUARIO QUE NO ES MAS QUE EL ID DEL USUARIO DE LA TABLA pa_usuario 
				$raiz = "INCIDENTESALUD";
				//ID DEL USUARIO DE LA TABLA pa_usuario
				//$nom_uid = trim($_SESSION['idUsuario']);
				//SIGLA QUE IDENTIFICA DE QUE TABLA Y LUGAR SE INSERTA EL REGISTRO
				//$nom = trim("T1");
				//$nom = trim("8");//DATO PROPORCIONADO POR EL INGENIERO JUANCHO INGENIERO OFICINA JUDICIAL PARA PRUEBAS
				
				//$nom = trim("4");//DATO PROPORCIONADO POR EL INGENIERO JUANCHO INGENIERO OFICINA JUDICIAL,SERVIDOR REAL PARA EL APLICATIVO INCIDENTE DESACATO EN SALUD
				
				//DATO PROPORCIONADO POR EL INGENIERO JUANCHO INGENIERO OFICINA JUDICIAL,SERVIDOR REAL PARA EL APLICATIVO INCIDENTE DESACATO EN SALUD,CENTRO DE SERVICIOS CIVIL FAMILIA
				//$nom = trim("3");
				$nom   = $juzgadodestinonombre;
				
				//AQUI SE CREA EL DIRECTORIO
				if(is_dir($raiz.'/'.$nom)){$bandera=0;}
				else{mkdir($raiz.'/'.$nom, 0, true);}
				
				//datos del arhivo 
				$nombre_archivo = $_FILES['archivo_ids']['name']; 
				//echo $nombre_archivo;
				$tipo_archivo   = $_FILES['archivo_ids']['type'];
				//echo $tipo_archivo;
				$tamano_archivo = $_FILES['archivo_ids']['size']; 
				//echo $tamano_archivo;
				
				
				if ($nombre_archivo != "") {//IF QUE ME IDENTIFICA QUE SE SELECCIONO UN ARCHIVO
				
				
				
				
				
							if (! ( strpos($tipo_archivo, "vnd.ms-excel") //csv
								 || strpos($tipo_archivo, "vnd.openxmlformats-officedocument.spreadsheetml.sheet") //xlsx
								 || strpos($tipo_archivo, "vnd.openxmlformats-officedocument.wordprocessingml.document")//docx
							     || strpos($tipo_archivo, "pdf") //pdf
							)    && ($tamano_archivo < 100000000) )  { 
							
								
								
								/*print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=3b&idmensaje=1"</script>';*/
								
								/*location.href="index.php?controller=archivo&action=adicionar_memorial&nombre="+id_radi;*/
								
								echo '<script languaje="JavaScript"> 
							
										
										var id_radi = "'.$idubicacionexpediente.'";
										
										var dat_1 = "'.$tipo_archivo.'";
							
										alert("LA EXTENSION O LA LONGITUD DEL ARCHIVO NO ES CORRECTA: "+dat_1);
										
										location.href="index.php?controller=sidoju&action=Registro_Documentos_Entrantes_Juzgados";
										
										
												
									</script>';
								
								
							}
							else{//1 
							
								
									if ( file_exists($raiz.'/'.$nom.'/'.$nombre_archivo) ) {
										//echo "2 YA EXISTE UN ARCHIVO CON ESE NOMBRE";
										
										/*print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=3b&idmensaje=2"</script>';*/
										
										//OBTENGO UN ID PARA IDENTIFICAR UN ARCHIVO CON EL MISMO NOMBRE
										//PARA AGREGARLE EL ID A ESE NOMBRE Y QUE EL SISTEMA CONTINUE SIN AVISO DE YA EXISTE UN ARCHIVO CON ESE NOMBRE
										$idunico = time();
										
										$nombre_archivo = $idunico."_".$nombre_archivo;
										
										
									}
								
								
									if ( move_uploaded_file($_FILES['archivo_ids']['tmp_name'], $raiz.'/'.$nom.'/'.$nombre_archivo) ){//3
										 //echo "EL ARCHIVO HA SUBIDO AL SERVIDOR CORRECTAMENTE."."\n"; 
										 
										 
										 $rutaarchivo = $raiz.'/'.$nom.'/'.$nombre_archivo;
										 
										 
										//------------------SUBIR ARCHIVO VIA FTP------------------
										$fileFrom      = $rutaarchivo;
										$fileTo        = $dir . '/' . $nombre_archivo;
									
										//SE CAMBIA DE ESTA FORMA 
										//D:/SALUD/8/ESTADO_186_JUZGADO_2_5_NOVIEMBRE_2019.pdf (A) ESTADO_186_JUZGADO_2_5_NOVIEMBRE_2019.pdf
										//YA QUE DESDE EL MODULO DEL INGENIERO JUAN ESTEBAN SE CONCATENA CON EL RESTO DE LA RUTA
										//$rutaarchivo_2 = $raiz_ftp.'/'.$fileTo;
										$rutaarchivo_2  = $nombre_archivo;
							
										$ftp->uploadFile($fileFrom, $fileTo);
										
										//------------------FIN SUBIR ARCHIVO VIA FTP----------------
										 
										 //RUTAS ARCHIVO
										 $ruta_local  =  $rutaarchivo;
										 $ruta_remota = $raiz_ftp.'/'.$fileTo;;
										 
										 //-------------------------SE REGISTRAN LOS DATOS EN LA TABLA-----------------------------------------
										 //-------------------------CUANDO SE DEFINE UN ARCHIVO------------------------------------------------
										 try {  
										 
										 	$ENTRE = 0;
						
											$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
											//EMPIEZA LA TRANSACCION
											$this->db->beginTransaction();
											
											
											mysql_query("START TRANSACTION",$conexion);
											
											
											//*********************************NUEVA CONEXON**************************************************
						
											$serverName     = $datosbd_1; //serverName\instanceName
											$connectionInfo = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
											$conn           = sqlsrv_connect( $serverName, $connectionInfo);
													
													
											if( $conn === false ) {
														
													$error_transaccion = 1;
													
													$ENTRE = 1;
													
													if( ($errors = sqlsrv_errors() ) != null) {
														
														foreach( $errors as $error ) {
															
															$msgError .= "ERROR EN REGISTRO: "." SQLSTATE: ".$error[ 'SQLSTATE'].", CODE: ".$error[ 'code'].", MENSAJE: ".$error[ 'message'];
														}
													}
														
													//echo "ENTRE 1";
														
											}
													
											//Iniciar la transacción.
											if ( sqlsrv_begin_transaction( $conn ) === false ) {
														 
													$error_transaccion = 1;
													
													$ENTRE = 2;
													
													if( ($errors = sqlsrv_errors() ) != null) {
														
														foreach( $errors as $error ) {
															
															$msgError .= "ERROR EN REGISTRO: "." SQLSTATE: ".$error[ 'SQLSTATE'].", CODE: ".$error[ 'code'].", MENSAJE: ".$error[ 'message'];
														}
													}
														 
													//echo "ENTRE 2";
														 
											}
											
											
											
											if($existe==true){
												
												$existes =  "no";
											}
											else{
											
												$existes = "si";
												
											}	
											
											
														  
			
											/*$this->db->exec("INSERT INTO sidoju_documentos_entrantes_juzgados (idusuario,idusuarioedita,idusuarioverifica,fecha,
														     fechaedita,fechaverifica,hora,remitente,idtipodocumento,numero,nfc,idjuzgadodestino,
															 rutaarchivo,ruta_remota,nombrebloque,chk,id_usuario_del,motivo_del,sal_id_estado,idradicado)
														     VALUES ('$idusuario',0,0,'$fechae','0000-00-00','0000-00-00','$horae','$remitente','$tipodocumento','$numerodoce','$nfc',
														     '$juzgadodestino','$rutaarchivo','$ruta_remota','',0,0,'',1,'$idubicacionexpediente')");*/
															 
											$this->db->exec("INSERT INTO sidoju_documentos_entrantes_juzgados (idusuario,idusuarioedita,idusuarioverifica,fecha,
														     fechaedita,fechaverifica,hora,remitente,idtipodocumento,numero,nfc,idjuzgadodestino,
															 rutaarchivo,ruta_remota,nombrebloque,chk,id_usuario_del,motivo_del,sal_id_estado,idradicado,
															 id_clasesalud,id_subclasesalud,id_eps)
														     VALUES ('$idusuario',0,0,'$fechae','0000-00-00','0000-00-00','$horae','$remitente','$tipodocumento','$numerodoce','$nfc',
														     '$juzgadodestino','$rutaarchivo','$ruta_remota','',0,0,'',1,'$idubicacionexpediente',
															 '$id_clasesalud','$id_subclasesalud','$id_eps')");
															 
											
											
											
											
											//OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA siepro_audiencia_juzgado
											$last_id = $this->db->lastInsertId();		
											
											
											/*$resultado = mysql_query($query) or die(mysql_error());
											
											//OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA correspondencia
											$last_id  = mysql_insert_id();
												
											if (!$resultado) {
																
												$error_transaccion = 1;
												
												$ENTRE = 3;
																								
											}*/
											
												
											/*$query_2   = "INSERT INTO oficina_judicial(idmemorial,idtabla,ruta_archvio) 
														  VALUES('$last_id','T1','$rutaarchivo')";*/		
											
											
											//IDENTIFICO QUE LOS IDS DE ESTOS JUZGADOS EN MI BASE DE DATOS LOCAL SON DIFERENTES EN LA 
											//BASE DE DATOS DE LA OFICINA JUDICIAL Y
											//SON LOS ASIGNADOS POR ELLOS
											//BASE DE DATOS LOCAL (CENTRO_SERVICIOS2)
											//UBICADOS EN LA TABLA pa_juzgado
							
											if($juzgadodestino == 1){$juzgadodestino_2 = 13;}
											if($juzgadodestino == 2){$juzgadodestino_2 = 14;}
											if($juzgadodestino == 3){$juzgadodestino_2 = 15;}
											if($juzgadodestino == 4){$juzgadodestino_2 = 16;}
											if($juzgadodestino == 5){$juzgadodestino_2 = 17;}
											if($juzgadodestino == 6){$juzgadodestino_2 = 18;}
											if($juzgadodestino == 7){$juzgadodestino_2 = 19;}
											if($juzgadodestino == 8){$juzgadodestino_2 = 20;}
											if($juzgadodestino == 9){$juzgadodestino_2 = 21;}
											
											if($juzgadodestino == 10){$juzgadodestino_2 = 22;}
											if($juzgadodestino == 11){$juzgadodestino_2 = 23;}
											if($juzgadodestino == 12){$juzgadodestino_2 = 24;}
											if($juzgadodestino == 13){$juzgadodestino_2 = 25;}
											if($juzgadodestino == 14){$juzgadodestino_2 = 26;}
											if($juzgadodestino == 15){$juzgadodestino_2 = 27;}
											if($juzgadodestino == 16){$juzgadodestino_2 = 28;}
											if($juzgadodestino == 17){$juzgadodestino_2 = 29;}
											if($juzgadodestino == 18){$juzgadodestino_2 = 30;}
											if($juzgadodestino == 19){$juzgadodestino_2 = 31;}
											if($juzgadodestino == 20){$juzgadodestino_2 = 32;}
											if($juzgadodestino == 21){$juzgadodestino_2 = 33;}
											if($juzgadodestino == 22){$juzgadodestino_2 = 34;}
											if($juzgadodestino == 23){$juzgadodestino_2 = 35;}
											if($juzgadodestino == 24){$juzgadodestino_2 = 36;}
											if($juzgadodestino == 25){$juzgadodestino_2 = 37;}
											if($juzgadodestino == 26){$juzgadodestino_2 = 38;}
														  
												
												
												$query_2   = "INSERT INTO  salud_documento_entrante (
																  sal_id_externo,
																  sal_id_usuario,
																  sal_id_juzgado_int,
																  sal_fecha,
																  sal_hora,
																  sal_radicado, 
																  sal_remitente,
																  sal_id_tipo_documento,
																  sal_numero,
																  sal_nfc,
																  sal_id_juzgado_destino,
																  sal_ruta_documento,
																  sal_id_estado,
																  sal_id_bd_externa,
																  sal_id_clase,
																  sal_id_subClase,
																  sal_id_eps
															  ) 
															  VALUES(
																  '$last_id',
																  '$idusuario',
																  '$juzgadodestino_2',
																  '$fecha_entrega',
																  '$hora_militar',
																  '$radicado',
																  '$remitente',
																  1,
																  '$numerodoce',
																  '$nfc',
																  '$juzgadodestino',
																  '$rutaarchivo_2',
																  1,
																  3,
																  '$id_clasesalud',
																  '$id_subclasesalud',
																  '$id_eps'
															   )";
												
															 
											$resultado_2 = mysql_query($query_2);
												
											if (!$resultado_2) {
																
												$error_transaccion = 1;
												
												$ENTRE = 4;
																								
											}
											
											
											//REGISTRAR ACTUACION EN JUSTICIA XXI
										
											$sininstancia = $radicado;
											$sin          = substr($sininstancia, 0, 21);
											
											
												
											/*$sql = ("	
						
														declare @cad integer 
			
														UPDATE t103dainfoproc SET a103descacts='Recepción Incidente de Desacato en Salud', a103codiacts='30023589', a103codipads='30010162', 
														a103fechdess = GETDATE(), a103anotacts = '$actu'
														WHERE a103llavproc='$radicado';
														
														SELECT @cad =MAX(A110CONSACTU)+1 FROM T110DRACTUPROC where a110Llavproc='$radicado' 
														
														INSERT INTO T110DRACTUPROC(A110LLAVPROC,A110CONSACTU,A110NUMEPROC,A110CONSPROC,A110CODIACTU,A110CODIPADR,A110DESCACTU,A110LEGAJUDI,A110FLAGTERM,A110TIPOTERM,A110NUMDTERM,A110FECHINIC,
														A110FECHFINA,A110FECHREGI,A110FOLIPROC,A110CUADPROC,A110CODIPROV,A110NUMEPROV,A110FECHPROV,A110ANOTACTU,A110FECHOFIC,A110NUMEOFIC,A110FLAGUBIC,A110TIPOACTU,A110FECHDESA,A110BORRTERM,
														A110RENUTERM) values('$radicado',@cad,'$sin','00','30023589','30010162','Recepción Incidente de Desacato en Salud','N','NO','N',0,NULL,NULL,GETDATE(),NULL,NULL,NULL,NULL,NULL,
														'$actu',NULL,NULL,'S','D',GETDATE(),'NO','NO')	
														
														
													
														
												");*/
												
												
											$sql = ("	
						
														
														UPDATE t103dainfoproc SET a103descacts='Recepción Incidente de Desacato en Salud', a103codiacts='30023589', a103codipads='30010162', 
														a103fechdess = GETDATE(), a103anotacts = '$actu'
														WHERE a103llavproc='$radicado';
														
														
														
												");
												
												
												
				
											$params  = array();
											$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
											$stmt    = sqlsrv_query( $conn, $sql , $params, $options );
													
													
											if( $stmt === false ) {
													
												$error_transaccion = 1;
												
												$ENTRE = 5;
													
												if( ($errors = sqlsrv_errors() ) != null) {
														
													foreach( $errors as $error ) {
															
														$msgError .= "ERROR EN REGISTRO: "." SQLSTATE: ".$error[ 'SQLSTATE'].", CODE: ".$error[ 'code'].", MENSAJE: ".$error[ 'message'];
													}
												}
												
											}	
										
											sqlsrv_free_stmt( $stmt);
											
											
											
											$sql_2 = ("	
						
														declare @cad integer 
			
														
														SELECT @cad =MAX(A110CONSACTU)+1 FROM T110DRACTUPROC where a110Llavproc='$radicado' 
														
														INSERT INTO T110DRACTUPROC(A110LLAVPROC,A110CONSACTU,A110NUMEPROC,A110CONSPROC,A110CODIACTU,A110CODIPADR,A110DESCACTU,A110LEGAJUDI,A110FLAGTERM,A110TIPOTERM,A110NUMDTERM,A110FECHINIC,
														A110FECHFINA,A110FECHREGI,A110FOLIPROC,A110CUADPROC,A110CODIPROV,A110NUMEPROV,A110FECHPROV,A110ANOTACTU,A110FECHOFIC,A110NUMEOFIC,A110FLAGUBIC,A110TIPOACTU,A110FECHDESA,A110BORRTERM,
														A110RENUTERM) values('$radicado',@cad,'$sin','00','30023589','30010162','Recepción Incidente de Desacato en Salud','N','NO','N',0,NULL,NULL,GETDATE(),NULL,NULL,NULL,NULL,NULL,
														'$actu',NULL,NULL,'S','D',GETDATE(),'NO','NO')	
														
														
													
														
												");
												
												
												
				
											$params_2  = array();
											$options_2 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
											$stmt_2    = sqlsrv_query( $conn, $sql_2 , $params_2, $options_2 );
													
													
											if( $stmt_2 === false ) {
													
												$error_transaccion = 1;
												
												$ENTRE = 6;
													
												if( ($errors = sqlsrv_errors() ) != null) {
														
													foreach( $errors as $error ) {
															
														$msgError .= "ERROR EN REGISTRO: "." SQLSTATE: ".$error[ 'SQLSTATE'].", CODE: ".$error[ 'code'].", MENSAJE: ".$error[ 'message'];
													}
												}
												
											}	
										
											sqlsrv_free_stmt( $stmt_2);
											
											
											
											if($error_transaccion) {
							
			
												echo "ERROR EN LA OPERACION MYSQL ".mysql_errno($conexion). ": " . mysql_error($conexion)."<br>"."<br>".",ERROR JUSTICIA XXI: ".$msgError." ,ENTRE: ".$ENTRE;
												
											
												//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
											    $this->db->rollBack();
												
											
												//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
												mysql_query("ROLLBACK",$conexion);
												
												
												//NO TERMINA LA TRANSACCION ERROR AL INGRESAR LOS DEATOS A SIGLO XXI
												sqlsrv_rollback( $conn );
											
												// Cerrar la conexión.
												sqlsrv_close( $conn );
												
												
												//SE ELIMINA EL Archivo Escaneado, POR QUE SE PRESENTO ALGUN ERROR
												//EN EL REGISTRO DE LA INFORMACION
												unlink($rutaarchivo);
												
												//SE ELIMINA EL Archivo Escaneado, VIA FTP
												$ftp->delete_file($fileTo);
												
												
										
											} //FIN if($error_transaccion) 
											else {
												
												//SE TERMINA LA TRANSACCION  
		  										$this->db->commit();		
												
												//SE TERMINA LA TRANSACCION 
												mysql_query("COMMIT",$conexion);
												
												
												//SE TERMINA LA TRANSACCION EN JUSTICIA XXI  
												sqlsrv_commit( $conn );	
												
												
												echo '<script languaje="JavaScript"> 
							
															var id_radi = "'.$idubicacionexpediente.'";
												
															alert("PROCESO SE REALIZA CORRECTAMENTE");
															
															location.href="index.php?controller=sidoju&action=Registro_Documentos_Entrantes_Juzgados";
																	
													  </script>';
												
												
												
									
												
											}
												
									
						
										
										}//FIN TRY
										catch (Exception $e) {
										
											//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
											$this->db->rollBack();

											
											//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
											mysql_query("ROLLBACK",$conexion);
											
											echo "Fallo: " . $e->getMessage();
											
											//NO TERMINA LA TRANSACCION ERROR AL INGRESAR LOS DEATOS A SIGLO XXI
											sqlsrv_rollback( $conn );
											
											// Cerrar la conexión.
											sqlsrv_close( $conn );
											
											
											//SE ELIMINA EL Archivo Escaneado, POR QUE SE PRESENTO ALGUN ERROR
											//EN EL REGISTRO DE LA INFORMACION
											unlink($rutaarchivo);
											
											//SE ELIMINA EL Archivo Escaneado, VIA FTP
											$ftp->delete_file($fileTo);
												
											//location.href="index.php?controller=archivo&action=adicionar_memorial&nombre="+id_radi;
										}
										
										
										
										
									}//3
									else{ 
										 //echo "Error al subir el fichero."; 
										 /*print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=3b&idmensaje=3"</script>';*/
										 
										 
										 echo '<script languaje="JavaScript"> 
							
													var id_radi = "'.$idubicacionexpediente.'";
										
													alert("Error al subir el fichero.");
													
													location.href="index.php?controller=sidoju&action=Registro_Documentos_Entrantes_Juzgados";
															
												</script>';
									} 
								
								
								
							}//1
							
							
							
							
						
			
				}
				else{
				
					echo '<script languaje="JavaScript"> 
					
								
								var id_radi = "'.$idubicacionexpediente.'";
								
								alert("SELECCIONO INCIDENTE EN SALUD, Y NO ANEXO ARCHIVO ESCANEADO");
								
								location.href="index.php?controller=sidoju&action=Registro_Documentos_Entrantes_Juzgados";
										
							</script>';
				
				
				}
				
				
			
			}//FIN if($conexion > 0){
			else{

					//echo $conexion; 
					//echo "Fallo en la Conexión";
					
					
					echo '<script languaje="JavaScript"> 
				
							
							var id_radi = "'.$idubicacionexpediente.'";
							
							alert("Fallo en la Conexión");
							
							location.href="index.php?controller=sidoju&action=Registro_Documentos_Entrantes_Juzgados";
									
						</script>';
					
					
			}	
			
		
		
		}//FIN if($solicitud == 10){
		else{//INICIO ELSE CUANDO NO ES UN INCIDENTE DE DESACATO EN SALUD
		

	
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
				) && ($tamano_archivo < 100000000) )  { 
				
					//echo "1 EL ARCHIVO NO CUMPLE CON LAS CARACTERISTICAS ESPECIFICAS";
					
					//echo "El Archivo no Cumple con las Caracteristicas Especificas, si es diferente de tipo (vnd.ms-excel,vnd.openxmlformats-officedocument.spreadsheetml.sheet, vnd.openxmlformats-officedocument.wordprocessingml.document,pdf) y tamaño de archivo < 100000000.";
					
					print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=3b&idmensaje=1"</script>';
					
					/*print'<script languaje="Javascript">alert("El Archivo no Cumple con las Caracteristicas Especificas, si es diferente de tipo (vnd.ms-excel,vnd.openxmlformats-officedocument.spreadsheetml.sheet, vnd.openxmlformats-officedocument.wordprocessingml.document,pdf) y tamaño de archivo < 100000000.")</script>';*/
					
					
					
					//ESTA PARTE SE USA PARA SEBER EL TIPO DEL ARCHIVO Y PONERLO EN EL IF
					/*echo '<script languaje="JavaScript"> var dat_1 = "'.$tipo_archivo.'";alert(dat_1);</script>';*/
				}
				else{//1 
					
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
							}
							else{
											
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
		
		
		}//FIN ELSE CUANDO NO ES UN INCIDENTE DE DESACATO EN SALUD
	
	
	}//FIN FUNCION
	
	
	
	
	public function registrar_documentos_entrantes_juzgados_ANTERIOR_20200117(){
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
		//---------------------------------------------------------------------------------
		
		
		//DATOS PARA EL REGISTRO DEL LOG
		
		//$modelo     = new sidojuModel();
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
		
		
		$tiporegistro = "Entrada de Documento";
		
		if( empty($iddocumento) ){
			$accion  = "Registra una Nueva ".$tiporegistro." En el Sistema (SIDOJU) REGISTRO DOCUMENTOS ENTRANTES JUZGADOS";
		}
		else{
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
			}
			else{//1 
				
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
								} else {
									//EN ESTA SQL NO SE ACTUALIZA EL JUZGADO		 
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
						}
						else{
										
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
	

	
	public function get_lista_incidentes($identrada){
	
		$idusuario  = $_SESSION['idUsuario'];
		
		$modelo     = new sidojuModel();
		
		//SE REALIZA ESTA CONSULTA PARA DETERMINAR SI EL USUARIO EN SESION
		//TIENE ASIGNADO idjuzgadousuario, SI NO TIENE ASIGNADO
		//MUESTRA TODOS LOS INCIDENTES, Y SI TIENE ASIGNADO
		//SOLO LOS DE ESE JUZGADO
		$juzgado_usuario = $modelo->get_juzgado_usuario($idusuario);
		$nj_usuario_1    = $juzgado_usuario->fetch();
		$nj_usuario_2    = $nj_usuario_1['idjuzgadousuario'];
		
		
		if($identrada == 1){
		
			if( is_null($nj_usuario_2) ){
			
				$sql = "SELECT t1.id,t1.fecha,t1.hora,t6.radicado,t3.nombre,t1.remitente,
						t2.est_titulo,t1.sal_observaciones,t1.rutaarchivo,
						t7.des AS clase,t8.des AS subclase,t9.des AS eps
						
						FROM ((((((((sidoju_documentos_entrantes_juzgados t1
						
						INNER JOIN salud_estados t2 ON t1.sal_id_estado = t2.est_id)
						INNER JOIN pa_juzgado t3 ON t1.idjuzgadodestino = t3.id)
						INNER JOIN sigdoc_pa_tipodocumento t4 ON t1.idtipodocumento = t4.id)
						INNER JOIN pa_usuario t5 ON t1.idusuario = t5.id)
						
						LEFT JOIN pa_clase_solicitud t7 ON t1.id_clasesalud = t7.id)
						LEFT JOIN pa_subclase_solicitud t8 ON t1.id_subclasesalud = t8.id)
						LEFT JOIN pa_eps_salud t9 ON t1.id_eps = t9.id)
						
						
						INNER JOIN correspondencia_tutelas t6 ON t1.idradicado = t6.id)
						WHERE idtipodocumento = 10
						ORDER BY id DESC";
			
			}
			else{
			
				$sql = "SELECT t1.id,t1.fecha,t1.hora,t6.radicado,t3.nombre,t1.remitente,
						t2.est_titulo,t1.sal_observaciones,t1.rutaarchivo,
						t7.des AS clase,t8.des AS subclase,t9.des AS eps
						
						FROM ((((((((sidoju_documentos_entrantes_juzgados t1
						
						INNER JOIN salud_estados t2 ON t1.sal_id_estado = t2.est_id)
						INNER JOIN pa_juzgado t3 ON t1.idjuzgadodestino = t3.id)
						INNER JOIN sigdoc_pa_tipodocumento t4 ON t1.idtipodocumento = t4.id)
						INNER JOIN pa_usuario t5 ON t1.idusuario = t5.id)
						
						LEFT JOIN pa_clase_solicitud t7 ON t1.id_clasesalud = t7.id)
						LEFT JOIN pa_subclase_solicitud t8 ON t1.id_subclasesalud = t8.id)
						LEFT JOIN pa_eps_salud t9 ON t1.id_eps = t9.id)
						
						
						INNER JOIN correspondencia_tutelas t6 ON t1.idradicado = t6.id)
						WHERE idtipodocumento = 10
						AND t1.idjuzgadodestino = (SELECT idjuzgadousuario FROM pa_usuario WHERE id = '$idusuario')
						ORDER BY id DESC";
					
			}
			
			
			
			
											  
			$listar     = $this->db->prepare($sql);
											 
			
		}
		
		

  		$listar->execute();

  		return $listar;
	
  	}
	
	
	public function get_juzgado_usuario($idusuario){
  
  		$listar  = $this->db->prepare("SELECT * FROM pa_usuario WHERE id = ".$idusuario);
	
  		$listar->execute();

  		return $listar;
		
	}
	
	
	//BD externa ConcejoPN, Oficina Judicial
	//Incidente de Desacato en Salud
	public function registrar_documentos_entrantes_juzgados_salud(){
		$modelo      = new sidojuModel();
		$fechaactual = $modelo->get_fecha_actual_amd();
		$horaactual  = $modelo->get_hora_actual_24horas();
		//Variable que maneja el update o insert
		$consactu = trim($_POST['txt_consactu']);
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
	try {
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
	    /*$cs = mysql_connect("localhost", "root", "admin");
	    mysql_select_db("bd_oficina_judicial", $cs);*/
	    /*$cs = mysql_connect("192.168.89.28", "cscf_salud", "Servicios25%") or die(mysql_error());
	    mysql_select_db("bd_oficina_judicial", $cs);*/
	    
	    include("/../libs/conexion4.php"); //Oficina Judicial
	    $salud = "INSERT INTO salud_documento_entrante (sal_id_usuario, sal_id_juzgado_int, sal_fecha, sal_hora, sal_radicado, sal_remitente, sal_id_tipo_documento, sal_numero, sal_nfc, sal_id_juzgado_destino,sal_ruta_documento,sal_id_estado,sal_id_bd_externa) ";
	    $salud.= "VALUES ($idusuario,$juzgadodestino,'".$_POST['fechae']."','$horaactual','$radicado','".$_POST['remitente']."',1,'$numerodoce','".$_POST['nfc']."',$juzgadodestino2,'$rutaarchivo',1,3) ";

	    $res1 = mysql_query($salud, $cs) or die(mysql_error());
		$id_sal = mysql_insert_id();
		$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
		$this->db->exec("INSERT INTO sidoju_documentos_entrantes_juzgados (idusuario,idusuarioedita,idusuarioverifica,fecha,fechaedita,fechaverifica,hora,remitente,idtipodocumento,numero,nfc,idjuzgadodestino,rutaarchivo,nombrebloque,chk,sal_id_externo_fk,sal_radicado,sal_id_estado)
		VALUES ('$idusuario',0,0,'".$_POST['fechae']."','0000-00-00','0000-00-00','$horaactual','".$_POST['remitente']."','100','".$_POST['numerodoce']."','".$_POST['nfc']."','$juzgadodestino','$rutaarchivo','',0,'$id_sal',$radicado,1)");

		$serverName = "DESKTOP-8FLD29P\SQLEXPRESS";
        $datosbd_2 = "ConsejoPN";
        $datosbd_3 = "sa";
        $datosbd_4 = "111";
        /*$serverName = "192.168.89.20";
        $datosbd_2 = "consejoPN";
        $datosbd_3 = "sa";
        $datosbd_4 = "M4nt3n1m13nt0";*/
        $conn = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
        $conn = sqlsrv_connect($serverName, $conn);
        //include("/../libs/conexion3.php");

		$sql = "INSERT INTO [consejoPN].[dbo].[t110dractuproc] (a110llavproc,a110consactu,a110numeproc,a110consproc,a110codiactu,a110codipadr,a110descactu,a110legajudi,a110flagterm,a110tipoterm,a110numdterm,a110fechinic,a110fechfina,a110fechregi,a110foliproc,a110cuadproc,a110codiprov,a110numeprov,a110fechprov,a110anotactu,a110fechofic,a110numeofic,a110flagubic,a110tipoactu,a110fechdesa,a110borrterm,a110renuterm) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$params = array($radicado,$consactu,$radicado2,"00","30023589","30010162","Recepcion Incidente de Desacato en Salud","N","NO","N","0","","","","","","","","","Se Registra el Documento, Incidente de Desacato en Salud","","","S","D","","NO","NO");
		$stmt = sqlsrv_query($conn, $sql, $params);

		$sql_actuacion = "UPDATE [consejoPN].[dbo].[T103DAINFOPROC] 
		SET a103codipads = ?,a103fechdess = ?,a103anotacts = ? WHERE a103llavproc = ?";
		$params2 = array("30010162",$fechaactual,"Recepcion Incidente de Desacato en Salud",$radicado);
		$stmt2 = sqlsrv_query( $conn, $sql_actuacion, $params2);
		$rows_affected2 = sqlsrv_rows_affected($stmt2);
		}
		}
		$this->db->commit();
		}
		catch (Exception $e) {
			$this->db->rollBack();
			print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=4b"</script>';
		}
		if ($tipo_archivo!="application/pdf") {
			print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=3b&idmensaje=1"</script>';
			//diferente de pdf
		} else
		//Ok
		print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=2"</script>';
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
            /*print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=4E"</script>'*/;
        }   
    }
	
	
	
	//MIGRAR TUTELA
	//PARA INCIDENTE DESACATO EN SALUD
	//ADICIONADO POR INGENIERO JORGE ANDRES VALENCIA 22 DE ENERO 2020
	public function migrar_tutela_NV(){
	
		
		$modelo = new sidojuModel();
	
		
		//SE OBTIENEN LOS DATOS
		$idusuario = $_SESSION['idUsuario'];
		
		$valorradicado   = trim($_GET['valorradicado']);
		$valorradicado_2 = substr($valorradicado, 0, 21);
		$valorradicado_3 = substr($valorradicado, 12, 4);
		$valorradicado_4 = substr($valorradicado, 16, 5);
		$valorradicado_5 = substr($valorradicado, 5, 2);
		$valorradicado_6 = substr($valorradicado, 7, 2);
		$valorradicado_7 = substr($valorradicado, 9, 3);
		
		
		//OBTENEMOS DEL RADICADO 17001610679920081111100
		//LA PARTE QUE ES EL NUMERO DEL JUZGADO 006
		$departamento  = substr($valorradicado, 0, 2);
		$municipio     = substr($valorradicado, 0, 5);
		
	
		$datospartes   = trim($_GET['datospartesXX']);
		
		
		$horaregistro  = $modelo->get_hora_actual_24horas();
		
		
		
		//DATOS PARA EL REGISTRO DEL LOG
	
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
		

		$accion  = "Se realiza Migracion de Tutela: ".$valorradicado;
		
      	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog = 1;
		

		$error_transaccion   = 0; //variable para detectar error
		
		//PROCESO YA EXISTE, NO ES POSIBLE SU MIGRACION
		$datos_PARTEX_PROCESO = $modelo->get_datos_PROCESO_MIGRAR($valorradicado);
									
		if($datos_PARTEX_PROCESO == 0){	
		
			
			//CAPTURAR EL ID DE LA TABLA pa_juzgado, 
			//PARA SER INSERTADO EN LA TABLA correspondencia_tutelas
			$despacho_tutela = substr($valorradicado, 0,12);
			$juzgados_1      = $modelo->listarJuzgados($despacho_tutela);
            $juzgados_2      = $juzgados_1->fetch();
            $idjuzgado       = $juzgados_2[id];
			
			
			try {
			  
						
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
				//EMPIEZA LA TRANSACCION
				$this->db->beginTransaction();
							
							
				$this->db->exec("INSERT INTO log (fecha,accion,detalle,idusuario,idtipolog) 
								 VALUES ('$fechalog','$accion','$detalle','$idusuario','$tipolog')");
												 
				
				
				$this->db->exec("INSERT INTO correspondencia_tutelas (id_usuario,radicado,idjuzgado,fecha,Tutela_Incidente) 
								 VALUES ('$idusuario','$valorradicado','$idjuzgado','$fechalog','Tutela')");					
								 
				
				//OBTENGO EL ULTIMO ID DEL ISNERT ANTERIOR
				$lastIdRadicado  = $this->db->lastInsertId(); 
					
				//PARTES
						 
							
				//1 EXPLODE
									
				$datospartes_1A = explode("******",$datospartes); 
				$longitud_1     = count($datospartes_1A);
				$i              = 0;
									
				while($i < $longitud_1 - 1){
										
					//2 EXPLODE
					$datospartes_1B = explode("//////",$datospartes_1A[$i]);
					
					$tipo         = trim($datospartes_1B[0]);			
					$docidentidad = utf8_decode( trim($datospartes_1B[1]) );
					$nombreparte  = utf8_decode( trim(strtoupper($datospartes_1B[2])) );
					
									
					//DEMANDANTE - ACCIONANTE
					if($tipo == '0001'){
					
						//$docdemandante .= $docidentidad."/";
						//$nomdemandante .= $nombreparte."/";
						
						$tipo_parte = "Accionante";
					
					}
					//DEMANDADO - ACCIONADO
					if($tipo == '0002'){
					
						//$docdemandado .= $docidentidad."/";
						//$nomdemandado .= $nombreparte."/";
						
						$tipo_parte = "Accionado";
					
					}
					
	
					
					$this->db->exec("INSERT INTO accionante_accionado_vinculado (idcorrespondencia_tutelas,accionante_accionado_vinculado,esaccionante_accionado_vinculado) 
									 VALUES ('$lastIdRadicado','$nombreparte','$tipo_parte')");				 
									 
						
											
					$i = $i + 1;
									
				}
				
				
				//SE TERMINA LA TRANSACCION  
				$this->db->commit();
								
		
				echo '<script languaje="JavaScript"> 
							
							alert("PROCESO SE REALIZA CORRECTAMENTE");
										
					</script>';									 
									
				
							
						  
			} 
			catch (Exception $e) {
						
				//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
				$this->db->rollBack();
							
						
				echo '<script languaje="JavaScript"> 
									
							var ERROR = "'.$e->getMessage().'";
										
							alert("ERROR AL REALIZAR EL PROCESO: "+ERROR);
									
					</script>';
							
					//echo $i." Fallo: " . $e->getMessage();
							
			}
			
		}
		else{
		
			echo '<script languaje="JavaScript"> 
									
							
					alert("PROCESO YA EXISTE, NO ES POSIBLE SU MIGRACION");
									
				</script>';
		
		}
				
				
		
		
		
  	}
	
	public function get_datos_PROCESO_MIGRAR($valorradicado){
	
		
		$listar = $this->db->prepare("SELECT * FROM correspondencia_tutelas
                                      WHERE radicado = '$valorradicado'");
								
					
		$listar->execute();
									
		$resultado = $listar->rowCount();
					
		if(!$resultado){
						
			return 0;
										 
		}
		else{
			
			return 1;
		}
		
	}
	
	
	//CAPTURAR EL ID DE LA TABLA pa_juzgado, 
	//PARA SER INSERTADO EN LA TABLA correspondencia_tutelas
	public function listarJuzgados($despacho_tutela){
		
    	 $listar = $this->db->prepare("SELECT * FROM pa_juzgado 
			                           WHERE cod_juzgado = '$despacho_tutela'");
										
								
         $listar->execute();
         return $listar;
		
	}
	
	
	
	
	
	
}//FIN CLASE

?>