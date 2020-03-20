<?php

class repsModel extends modelBase

{

	

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
			
			print'<script languaje="Javascript">location.href="index.php?controller=reps&action=regIngresoSalida"</script>';
		}

	 }
	 
	 if($condicion == "2b"){

	 	$_SESSION['elemento'] = "Error al Realizar el registro";

	    $_SESSION['elem_error_transaccion'] = true;

	   	if($_SESSION['id']!=""){

			/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
			print'<script languaje="Javascript">location.href="index.php?controller=reps&action=regIngresoSalida"</script>';
	  
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
	 
	 
	    
 

  }	

  

  

  /***********************************************************************************/

  /*------------------------------ Listar Log ---------------------------------------*/

  /***********************************************************************************/

  public function listarLogArchivo(){

		$listar = $this->db->prepare("SELECT logusuario.fecha,logusuario.accion,logusuario.detalle,usuario.empleado,usuario.foto
									  FROM LOG AS logusuario
								      INNER JOIN pa_usuario AS usuario ON (logusuario.idusuario=usuario.id)
									  WHERE logusuario.idtipolog=3
									  ORDER BY logusuario.id DESC
									  LIMIT 15");
		$listar->execute();
	 	return $listar;
  }	

  


  /***********************************************************************************/

  /*---------------------------  Listar usuarios empleados del área archivo --------------------*/

  /***********************************************************************************/

  public function listarEmpleados()

  {

  

  $listar = $this->db->prepare("SELECT * FROM pa_usuario where idperfil=3 and idareaempleado=1 order by empleado ");

  $listar->execute();

  return $listar;

  

  }
  /***********************************************************************************/

  /*---------------------------  Listar usuarios empleados con el jef de área archivo --------------------*/

  /***********************************************************************************/

  public function listarEmpleadosJefe()

  {

  

  $listar = $this->db->prepare("SELECT * FROM pa_usuario where idareaempleado=1 order by empleado ");

  $listar->execute();

  return $listar;

  

  }



/***********************************************************************************/

  /*---------------------------  Listar Ubicación Expedientes --------------------*/

  /***********************************************************************************/

public function listarUbicacion()

  {  

  $listar = $this->db->prepare("SELECT ubi.id, ubi.idusuario, ubi.fecha, ubi.radicado, ubi.piso,  est.nombre as estado, juz.nombre as juzgado, ubi.fechasalida, juzdes.nombre as juzgadodestino, ubi.fechadevolucion, ubi.posicion, ubi.cedula_demandante, ubi.demandante, ubi.cedula_demandado, ubi.demandado FROM ubicacion_expediente ubi
  								INNER JOIN detalle_estado est ON (ubi.idestado = est.id)
								INNER JOIN pa_juzgado juz ON (ubi.idjuzgado = juz.id)
								LEFT JOIN  juzgado_destino juzdes ON (ubi.idjuzgadodestino = juzdes.id)
								ORDER BY ubi.fecha DESC LIMIT 30");

  $listar->execute();

  return $listar;
  }
  
 
  /***********************************************************************************/

  /*------------------------------  Filtro Ubicacion Expedientes  ---------------------------------*/

  /***********************************************************************************/

  public function FiltroIngresoSalida()

  {


$fechair				= $_GET['nombre16']; 
$fechafr				= $_GET['nombre17'];
$tipo					= $_GET['nombre11']; 
$usuario				= $_GET['nombre20'];


$f1=$f2=$f3="";



if($fechair!='')
{
$fechair = $fechair.' 00:00:00';
$fechafr = $fechafr.' 23:59:59';
$f1=" and (em.fecha >= '$fechair' and em.fecha<='$fechafr')";
}


if($tipo!=''){
 $f2=" AND em.tipo LIKE '%$tipo%'";
}

if($usuario!=''){
 $f3=" AND em.idusuario = '$usuario' ";
}

 $listar = $this->db->prepare("SELECT em.id AS idem, em.idusuario,  em.fecha,em.tipo, em.observaciones, usu.empleado as usuario
                               FROM empleado_control em
                               LEFT JOIN pa_usuario usu ON (em.idusuario = usu.id)
                               WHERE  em.tipo LIKE '%$tipo%' ".$f3.$f1."  ORDER BY em.fecha");
   	  $listar->execute();
	  
	  return $listar; 

  } 
 
   /***********************************************************************************/

  /*------------------------------ Registrar Ingreso Salida --------------------------------*/

  /***********************************************************************************/

  
  


  /***********************************************************************************/

  /*-----------------------  Consultar Empleados Ingreso Salidas  --------------------*/

  /***********************************************************************************/

  public function listarIngresoSalida()

  {

   $id=$_GET['nombre'];

  $listar = $this->db->prepare("SELECT em.idusuario, usu.empleado as usuario, em.fecha, em.observaciones, em.tipo
                                FROM empleado_control em
                                INNER JOIN pa_usuario usu ON (em.idusuario = usu.id)");

  $listar->execute();

  return $listar;

  

  } 
    /***********************************************************************************/

  /*---------------------------  Listar usuarios --------------------*/

  /***********************************************************************************/

  public function listarUsuarios()

  {
  
  $listar = $this->db->prepare("SELECT id,empleado FROM pa_usuario order by empleado asc ");

  $listar->execute();

  return $listar;

  

  }
  
  
  //------------------------------------------------------------------------------------------------------------------
	//CODIGO ADICIONADO POR JORGE ANDRES VALENCIA 20 DE ABRIL 2015, PROJECTO INTEGRACION APLICATIVOS CENTRO DE SERVICIOS
 //------------------------------------------------------------------------------------------------------------------
	
	public function get_fecha_actual(){
	
	
		//FORMA WIN 7 Y 8, YA QUE DE LA FORMA ANTERIOR TOMA EL AM O PM Y DA CONFLICTOS PARA 
		//GUARDAR EN LA BASE DE DATOS EN ESTE CASO LA TABLA detalle_correspondencia 
		//CAMPO fecha QUE ES DATETIME 
		date_default_timezone_set('America/Bogota'); 
		$fecharegistro=date('Y-m-d g:ia'); //FORMA PARA XP
		//$fecharegistro = date('Y-m-d g:i'); 
		
		return $fecharegistro; 
		
	
	}
	
	public function get_hora_actual(){
	
	
		//FORMA WIN 7 Y 8, YA QUE DE LA FORMA ANTERIOR TOMA EL AM O PM Y DA CONFLICTOS PARA 
		//GUARDAR EN LA BASE DE DATOS EN ESTE CASO LA TABLA detalle_correspondencia 
		//CAMPO fecha QUE ES DATETIME 
		date_default_timezone_set('America/Bogota'); 
		$hora_actual = date('H:i:s'); //FORMA PARA XP
		//$fecharegistro = date('Y-m-d g:i'); 
		
		return $hora_actual; 
		
	
	}
	
	//HORA MILITAR
	public function get_hora_actual_24horas(){
	
		date_default_timezone_set('America/Bogota'); 
		//$horaregistro=date('H:i:s'); 
		$horaregistro = date('H:i');
		
		/*$hora         = date('H');
		
		//REALIZO ESTA PREGUNTA PARA COGER EL RANGO DE HORA
		//DE 01:00 AM - 09:00 AM Y QUITARLES EL CERO INICIAL
		//YA QUE PARA GENERAR EL REPORTE EN VERIFICAR DOCUMENTOS ENTRANTES JUZGADOS
		//EN LA BASE DE DATOS REALIZA ESTE FILTRO SIN ESTE CERO INCIAL
		if($hora >= 1 && $hora <= 9){
			$horaregistro = substr($horaregistro, -4);    // Ej: 08:54 devuelve 8:54
		}*/
		
		return $horaregistro; 
	}
	
	public function get_datos_usuario_sistema(){
	
		$idusuario  = $_SESSION['idUsuario'];
		
		$listar     = $this->db->prepare("SELECT ingreso,foto,empleado FROM pa_usuario WHERE id = '$idusuario'");

  		$listar->execute();

  		return $listar;
	
	}
	
	public function registrarIngresoSalida(){

		//$error_transaccion = 0; //variable para detectar error de transaccion	
	
		//SE OBTIENEN LOS DATOS
		
		$modelo = new repsModel();
		
		$idusuario    = $_SESSION['idUsuario'];
		
		$fechaactual  = $modelo->get_fecha_actual();
		//$fechar       = explode(" ",trim($_POST['fechar']));
		$fechar       = explode(" ",trim($fechaactual));
		$fecha        = $fechar[0];
		//$hora         = $fechar[1];
		
		$hora         = $modelo->get_hora_actual_24horas();;
		
		$datosequipo  = explode("////",trim($_POST['datosequipo']));
		$ip           = $datosequipo[0];
		$nompc		  = $datosequipo[1];
		
		$tiporegistro = trim($_POST['tiporegistro']);
		
		if($tiporegistro == "ENTRADA"){
			$ingreso = 1;
		}
		if($tiporegistro == "SALIDA"){
			$ingreso = 0;
		}
		
		$observacion  = trim($_POST['observacion']);
		
		//DATOS PARA EL REGISTRO DEL LOG
		
		$accion  = "Se Registra una Nueva ".$tiporegistro." En el Sistema de Registro de Entrada y Salida de Personal";
      	$detalle = $_SESSION['nombre']." "."Registra una Nueva ".$tiporegistro." ".$fecha." "."a las: ".$hora;
		$tipolog = 3;
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   
				$this->db->exec("INSERT INTO empleado_control (idusuario,fecha,hora,observaciones,tipo,ipequipo,nombreequipo)
								 VALUES ('$idusuario','$fecha','$hora','$observacion','$tiporegistro','$ip','$nompc')");
								 
				$this->db->exec("UPDATE pa_usuario SET ingreso ='$ingreso' WHERE id = '$idusuario'");
				
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) 
				                 VALUES ('$fecha', '$accion','$detalle','$idusuario','$tipolog')");
				
			
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			
			print'<script languaje="Javascript">location.href="index.php?controller=reps&action=mensajes&nombre=2"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	echo "Fallo: " . $e->getMessage();
			/*print'<script languaje="Javascript">location.href="index.php?controller=reps&action=mensajes&nombre=2b"</script>';*/
		}
		
		
  	}
  
	public function get_entrada_salida_usuario($identrada){
	
	
		$idusuario  = $_SESSION['idUsuario'];
		
		if($identrada == 1){
			$listar     = $this->db->prepare("SELECT * FROM empleado_control WHERE idusuario = '$idusuario' ORDER BY id DESC LIMIT 10");
		}
		if($identrada == 2){
			
			//$datos_filtro = explode("//////////",trim($_GET['datos_filtro']));
		
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
		
			$listar    = $this->db->prepare("SELECT * FROM empleado_control
										     WHERE idusuario = '$idusuario' AND (fecha >= '$fechad' AND fecha <= '$fechah') 
										     ORDER BY id DESC");
		}

  		$listar->execute();

  		return $listar;
	
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
	
	public function registrarPermiso(){

		//$error_transaccion = 0; //variable para detectar error de transaccion	
	
		//SE OBTIENEN LOS DATOS
		
		$idusuario = $_SESSION['idUsuario'];
		
		$fechas    = trim($_POST['fechas']);
		$fechap    = trim($_POST['fechap']);
		
		$horai     = trim($_POST['horai']);
		$horaf     = trim($_POST['horaf']);
		
		$detalle2  = trim($_POST['detalle']);
		
		$estado    = 2;
		/************* AGREGADO POR JUAN ESTEBAN MÙNERA BETANCUR ************
        ************** MANIZALES 2018-04-04 2:41 PM *************************/
        $raiz = "REPS_Docs_Permisos";
        $nom  = $_SESSION['idUsuario'];
        //AQUI SE CREA EL DIRECTORIO
        if(is_dir($raiz.'/'.$nom)){
            $bandera=0;
        }else{
            mkdir($raiz.'/'.$nom, 0, true);
        }
        if( !empty( $_FILES['doc_adjunto']['name'] ) ){
            date_default_timezone_set('America/Bogota'); 
            $formato = date('Y-m-d_h_i_s') . '-' . strtolower($_FILES['doc_adjunto']['name']);
            move_uploaded_file ($_FILES['doc_adjunto']['tmp_name'], $raiz.'/'.$nom .'/'. $formato);
            $doc_adjunto = $formato;
            //echo "<script type='text/javascript'> alert('Documento Adjunto Subido correctamente')</script>";
        }//else{
           // $doc_adjunto = "Error al subir";
            //echo "<script type='text/javascript'> alert('Error al Adjuntar Documento, intente nuevamente')</script>";
        //}
        //***************************************************************************************************************
        

		/*$fechas       = explode(" ",trim($_POST['fechar']));
		$fecha        = $fechar[0];
		$hora         = $fechar[1];*/
		
		
		//DATOS PARA EL REGISTRO DEL LOG
		
		//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
		$modelo	= new repsModel();
		//OBTENEMOS LA FECHA ACTUAL
		$fechaactual  = $modelo->get_fecha_actual();
		$fechar       = explode(" ",trim($fechaactual));
		$fecha        = $fechar[0];
		$hora         = $fechar[1];
		
		$accion  = "Se Registra una Nueva Solicitud de Permiso";
      	$detalle = $_SESSION['nombre']." "."Registra una Nueva Solicitud de Permiso ".$fecha." "."a las: ".$hora;
		$tipolog = 3;
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   
				$this->db->exec("INSERT INTO empleado_permiso (idusuario,fecha_solicitud,fecha_permiso,hora_inicio,hora_final,detalle,doc_adjunto,estado)
								 VALUES ('$idusuario','$fechas','$fechap','$horai','$horaf','$detalle2', '$doc_adjunto','$estado')");
								 
				
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fecha', '$accion','$detalle','$idusuario','$tipolog')");
				
			
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			
			print'<script languaje="Javascript">location.href="index.php?controller=reps&action=mensajes&nombre=2"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	//echo "Fallo: " . $e->getMessage();
			print'<script languaje="Javascript">location.href="index.php?controller=reps&action=mensajes&nombre=2b"</script>';
		}
		
		
  	}
	
	public function get_permisos_usuario($identrada){
	
		//TIMEDIFF(ep.hora_final,ep.hora_inicio) AS duracion 
		//PARA CALCULAR EL TIEMPO ENTRE DOS HORAS
	
		$idusuario  = $_SESSION['idUsuario'];
		
		if($identrada == 1){
		
			/*$listar     = $this->db->prepare("SELECT pu.empleado,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle,ep.estado,
											  TIMEDIFF(ep.hora_final,ep.hora_inicio) AS duracion 
		                                      FROM (empleado_permiso ep INNER JOIN pa_usuario pu ON ep.idusuario = pu.id) 
										      WHERE ep.idusuario = '$idusuario' ORDER BY ep.id DESC LIMIT 5");*/
											  
			/*$listar     = $this->db->prepare("SELECT ep.id,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle,ep.estado,
											  TIMEDIFF(ep.hora_final,ep.hora_inicio) AS duracion 
		                                      FROM empleado_permiso ep  
										      WHERE ep.idusuario = '$idusuario' ORDER BY ep.id DESC LIMIT 5");*/
											  
											  
			
			$listar     = $this->db->prepare("SELECT ep.id,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle,ep.estado,

												CASE
												
												  WHEN
												
													  (ep.hora_inicio >= '07:00' AND ep.hora_inicio <= '12:00') AND (ep.hora_final >= '14:00' AND ep.hora_final <= '23:00')
												
													  THEN
												
														TIMEDIFF( TIMEDIFF(ep.hora_final,ep.hora_inicio),'2:00')
												
													  ELSE
												
														TIMEDIFF(ep.hora_final,ep.hora_inicio)
												
												
												END
												
												AS duracion
												
												FROM empleado_permiso ep 
												WHERE ep.idusuario = '$idusuario'
												ORDER BY ep.id DESC LIMIT 5");
		}
		if($identrada == 2){
			
			//$datos_filtro = explode("//////////",trim($_GET['datos_filtro']));
		
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
		
			/*$listar    = $this->db->prepare("SELECT pu.empleado,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle,ep.estado,
											 TIMEDIFF(ep.hora_final,ep.hora_inicio) AS duracion 
		                                     FROM (empleado_permiso ep INNER JOIN pa_usuario pu ON ep.idusuario = pu.id) 
										     WHERE ep.idusuario = '$idusuario' AND (ep.fecha_solicitud >= '$fechad' AND ep.fecha_solicitud <= '$fechah') 
											 ORDER BY ep.id");*/
											 
											 
			/*$listar    = $this->db->prepare("SELECT ep.id,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle,ep.estado,
											 TIMEDIFF(ep.hora_final,ep.hora_inicio) AS duracion 
		                                     FROM empleado_permiso ep  
										     WHERE ep.idusuario = '$idusuario' AND (ep.fecha_solicitud >= '$fechad' AND ep.fecha_solicitud <= '$fechah') 
											 ORDER BY ep.id DESC");*/
											 
			
			$listar     = $this->db->prepare("SELECT ep.id,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle,ep.estado,

												CASE
												
												  WHEN
												
													  (ep.hora_inicio >= '07:00' AND ep.hora_inicio <= '12:00') AND (ep.hora_final >= '14:00' AND ep.hora_final <= '23:00')
												
													  THEN
												
														TIMEDIFF( TIMEDIFF(ep.hora_final,ep.hora_inicio),'2:00')
												
													  ELSE
												
														TIMEDIFF(ep.hora_final,ep.hora_inicio)
												
												
												END
												
												AS duracion
												
												FROM empleado_permiso ep 
												WHERE ep.idusuario = '$idusuario' AND (ep.fecha_solicitud >= '$fechad' AND ep.fecha_solicitud <= '$fechah')
												ORDER BY ep.id DESC");
		}
		
		

  		$listar->execute();

  		return $listar;
	
  	}
	
	public function get_datos_usuarios(){
	
		$listar     = $this->db->prepare("SELECT * FROM pa_usuario ORDER BY empleado");

  		$listar->execute();

  		return $listar;
	
	}
	public function get_datos_usuariosJE(){
	
		$listar     = $this->db->prepare("SELECT * FROM pa_usuario WHERE idperfil!=22 AND idestadoempleado=1 ORDER BY empleado");

  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_lista_permisos($identrada){
	
		//TIMEDIFF(ep.hora_final,ep.hora_inicio) AS duracion 
		//PARA CALCULAR EL TIEMPO ENTRE DOS HORAS
	
		//$idusuario  = $_SESSION['idUsuario'];
		

		if($identrada == 1){
		
			/*$listar     = $this->db->prepare("SELECT ep.id,pu.empleado,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle,ep.estado,
											  TIMEDIFF(ep.hora_final,ep.hora_inicio) AS duracion 
		                                      FROM (empleado_permiso ep INNER JOIN pa_usuario pu ON ep.idusuario = pu.id) 
										      ORDER BY ep.id DESC LIMIT 10");*/
											  
			$listar     = $this->db->prepare("SELECT ep.id, ep.idusuario,pu.empleado,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle, ep.doc_adjunto,ep.estado,

											  CASE
												
												  WHEN
												
													  (ep.hora_inicio >= '07:00' AND ep.hora_inicio <= '12:00') AND (ep.hora_final >= '14:00' AND ep.hora_final <= '23:00')
												
													  THEN
												
														TIMEDIFF( TIMEDIFF(ep.hora_final,ep.hora_inicio),'2:00')
												
													  ELSE
												
														TIMEDIFF(ep.hora_final,ep.hora_inicio)
												
												
												END
												
												AS duracion
												
												FROM (empleado_permiso ep INNER JOIN pa_usuario pu ON ep.idusuario = pu.id)
												ORDER BY ep.id DESC LIMIT 10");
											  
		}
		if($identrada == 2){
		
			$filtrox;
			
			$filtro1;
			$filtro2;
			$filtro3;
			
			$usuario = trim($_GET['dato_1b']);
			$fechad  = trim($_GET['dato_2b']);
			$fechah  = trim($_GET['dato_3b']);
			$estado  = trim($_GET['dato_4b']);
			
			
			if ( !empty($usuario) ) {
			
				$filtro1 = " AND ep.idusuario = '$usuario' ";
			
			}
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtro2 = " AND (ep.fecha_solicitud >= '$fechad' AND ep.fecha_solicitud <= '$fechah') ";
				
			
			}
			//PREGUNTO $estado != '', YA QUE LA FUNCION empty SI EL VALOR ES CERO ASUME QUE ES UN VALOR VACIO
			//Y NO ENTRA AL IF, OCCASIONANDO ESTO NO ARMAR EL FILTRO $filtro3
			if ( $estado != '') {
			
				
				$filtro3 = " AND ep.estado = '$estado' ";
			
			}
			
		
			$filtrox = $filtro1." ".$filtro2." ".$filtro3;
			
			//echo $filtrox;
			
			
			
			//SE COLOCA ep.id >= '1' PARA QUE LOS FILTROS ANTERIORES EMPIEZEN CON EL (AND) Y NO SE TENGA QUE DEFINIR
			//CUAL DE LOS FILTROS VA PRIMERO SI NO SE DEFINE ALGUNO YA QUE QUEDARIA ALGO COMO WHERE AND FILTRO, 
			//Y YA QUE EL CAMPO ep.id ES UN VALOR AUTONUMERICO QUE EMPIEZA EN 1 LA PREGUNTA ep.id >= '1' 
			//SIEMPRE VA A CONCORDAR MAS EL FILTRO QUE SE ASIGNE.
			/*$listar    = $this->db->prepare("SELECT ep.id,pu.empleado,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle,ep.estado,
											 TIMEDIFF(ep.hora_final,ep.hora_inicio) AS duracion 
		                                     FROM (empleado_permiso ep INNER JOIN pa_usuario pu ON ep.idusuario = pu.id) 
										     WHERE ep.id >= '1'" .$filtrox. " ORDER BY ep.id DESC");*/
											 
											 
											 
			
			$listar    = $this->db->prepare("SELECT ep.id, ep.idusuario,pu.empleado,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle, ep.doc_adjunto,ep.estado,

											  CASE
												
												  WHEN
												
													  (ep.hora_inicio >= '07:00' AND ep.hora_inicio <= '12:00') AND (ep.hora_final >= '14:00' AND ep.hora_final <= '23:00')
												
													  THEN
												
														TIMEDIFF( TIMEDIFF(ep.hora_final,ep.hora_inicio),'2:00')
												
													  ELSE
												
														TIMEDIFF(ep.hora_final,ep.hora_inicio)
												
												
												END
												
												AS duracion
												
												FROM (empleado_permiso ep INNER JOIN pa_usuario pu ON ep.idusuario = pu.id) 
										        WHERE ep.id >= '1'" .$filtrox. " ORDER BY ep.id DESC");
		
			
			
			/*$sql= "SELECT pu.empleado,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle,ep.estado,
											 TIMEDIFF(ep.hora_final,ep.hora_inicio) AS duracion 
		                                     FROM (empleado_permiso ep INNER JOIN pa_usuario pu ON ep.idusuario = pu.id) 
										     WHERE ep.id >= '1'" .$filtrox. " 
											 ORDER BY ep.id DESC";
											 
			echo $sql;*/
											
			
		}
		
		

  		$listar->execute();

  		return $listar;
	
  	}
	
	public function Actualizar_RegistroPermiso(){

		//SE OBTIENEN LOS DATOS
		
		$idusuario = $_SESSION['idUsuario'];
		
		//$dato_p1 = trim($_GET['dato_p1']);
		$dato_p2 = trim($_GET['dato_p2']);
		$dato_p3 = trim($_GET['dato_p3']);
		
		if($dato_p3 == "APROBAR"){
		
			$sql = "UPDATE empleado_permiso SET estado = '1' WHERE  id = '$dato_p2'";
			
		}
		if($dato_p3 == "NOAPROBAR"){
		
			$sql = "UPDATE empleado_permiso SET estado = '0' WHERE  id = '$dato_p2'";
			
		}
		if($dato_p3 == "ENPROCESO"){
		
			$sql = "UPDATE empleado_permiso SET estado = '2' WHERE  id = '$dato_p2'";
			
		}

		//DATOS PARA EL REGISTRO DEL LOG
		
		//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
		$modelo	= new repsModel();
		//OBTENEMOS LA FECHA ACTUAL
		$fechaactual  = $modelo->get_fecha_actual();
		$fechar       = explode(" ",trim($fechaactual));
		$fecha        = $fechar[0];
		$hora         = $fechar[1];
		
		$accion  = "Se Actualiza de Estado a Solicitud de Permiso";
      	$detalle = $_SESSION['nombre']." "."Actualiza de Estado a una Solicitud de Permiso ".$fecha." "."a las: ".$hora." ACCION: ".$dato_p3;
		$tipolog = 3;
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
				
				$this->db->exec($sql);
			
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fecha', '$accion','$detalle','$idusuario','$tipolog')");
				
			
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			
			print'<script languaje="Javascript">location.href="index.php?controller=reps&action=mensajes&nombre=3b1"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	//echo "Fallo: " . $e->getMessage();
			print'<script languaje="Javascript">location.href="index.php?controller=reps&action=mensajes&nombre=3b2"</script>';
		}
		
		
  	}
	
	public function Actualizar_RegistroPermisoMasivos(){

		//SE OBTIENEN LOS DATOS
		
		$idusuario = $_SESSION['idUsuario'];
		
		//$dato_p1 = trim($_GET['dato_p1']);
		$dato_p2    = trim($_GET['dato_p2']);
		$idspermiso = explode("******",$dato_p2);
		$longid     = count($idspermiso);
		$i=1;
		
		$dato_p3     = trim($_GET['dato_p3']);
		
		//DATOS PARA EL REGISTRO DEL LOG
		
		//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
		$modelo	= new repsModel();
		//OBTENEMOS LA FECHA ACTUAL
		$fechaactual  = $modelo->get_fecha_actual();
		$fechar       = explode(" ",trim($fechaactual));
		$fecha        = $fechar[0];
		$hora         = $fechar[1];
		
		$accion  = "Se Actualiza Masivamente de Estados a Solicitud de Permisos";
      	$detalle = $_SESSION['nombre']." "."Actualiza Masivamente de Estados a Solicitud de Permisos ".$fecha." "."a las: ".$hora." ACCION: ".$dato_p3;
		$tipolog = 3;
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
				if($dato_p3 == "APROBARMASIVO"){
				
					while($i < $longid){
					
						$id = $idspermiso[$i];
						
						$sql = "UPDATE empleado_permiso SET estado = '1' WHERE  id = '$id'";
						
						$this->db->exec($sql);
							
						$i = $i + 1;
						
					
					}
		
				}
				
				if($dato_p3 == "NOAPROBARMASIVO"){
				
					while($i < $longid){
					
						$id = $idspermiso[$i];
						
						$sql = "UPDATE empleado_permiso SET estado = '0' WHERE  id = '$id'";
						
						$this->db->exec($sql);
							
						$i = $i + 1;
						
					
					}
		
				}
				
				if($dato_p3 == "ENPROCESOMASIVO"){
				
					while($i < $longid){
					
						$id = $idspermiso[$i];
						
						$sql = "UPDATE empleado_permiso SET estado = '2' WHERE  id = '$id'";
						
						$this->db->exec($sql);
							
						$i = $i + 1;
						
					
					}
		
				}
				
				
			
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fecha', '$accion','$detalle','$idusuario','$tipolog')");
				
			
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			
			print'<script languaje="Javascript">location.href="index.php?controller=reps&action=mensajes&nombre=3b1"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	//echo "Fallo: " . $e->getMessage();
			print'<script languaje="Javascript">location.href="index.php?controller=reps&action=mensajes&nombre=3b2"</script>';
		}
		
		
  	}
	
	//**************** FUNCIONES ESPECIALES **********************************************
	
	public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
	
		$listar     = $this->db->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
	
  		$listar->execute();

  		return $listar;
	
	}
	
	// ****************** JUAN ESTEBAN MÙNERA BETANCUR 08-06-2017 *******************************************
        // ****************** USUARIOS QUE PUEDEN LISTAR Y APROBAR PERMISOS DEL SISTEMA REPS ********************
	public function privilegio_listarPermisos(){
		$listar = $this->db->prepare("SELECT usuario FROM pa_usuario_acciones WHERE id = 4 ORDER BY id");
		$listar->execute();
		return $listar; 
	}
}

?>