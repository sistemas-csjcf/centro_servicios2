<?php

class archivoModel extends modelBase

{

	

   /***********************************************************************************/

    /*----------------------------- Mensajes ---------------------------------------*/

    /***********************************************************************************/

      public function mensajes()

  {

      $condicion=$_GET['nombre'];
 	  
	  if($condicion==1)

	  {

	    $_SESSION['elemento'] = "El seguimiento ha sido registrado correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=archivo&action=regseguimiento"</script>';
	     }
  
	   }

	 if($condicion==2)

	  {

	    $_SESSION['elemento'] = "El seguimiento ha sido actualizado correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	   if($_SESSION['id']!="")
	   {

	    print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
	  
	   }

	 }
	
     if($condicion==3)

	  {

	    $_SESSION['elemento'] = "El acta de recibido ha sido registrada correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
	     }
  
	   }
	    
	       if($condicion==4)

	  {

	    $_SESSION['elemento'] = "El acta de entrega ha sido registrada correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
	     }
  
	   }
	   
	   
	       if($condicion==5)

	  {

	    $_SESSION['elemento'] = "El acta ha sido modificada correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
	     }
  
	   }
	   
	      if($condicion==6)

	  {

	    $_SESSION['elemento'] = "El informe ha sido registrado correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
	     }
  
	   }
	    if($condicion==7)

	  {

	    $_SESSION['elemento'] = "El informe ha sido actualizado correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
	     }
  
	   }
	        if($condicion==8)

	  {

	    $_SESSION['elemento'] = "El acta ha sido entregada correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
	     }
  
	   }  
 

  }	

  

  

  /***********************************************************************************/

  /*------------------------------ Listar Log ---------------------------------------*/

  /***********************************************************************************/

  public function listarLogArchivo()

  {

  

	  $listar = $this->db->prepare("SELECT logusuario.fecha,logusuario.accion,logusuario.detalle,usuario.empleado,usuario.foto
FROM LOG AS logusuario
INNER JOIN pa_usuario AS usuario ON (logusuario.idusuario=usuario.id)
WHERE logusuario.idtipolog=1
ORDER BY logusuario.id DESC
LIMIT 15");

	  $listar->execute();
	 return $listar;


   

  }	

  
   /***********************************************************************************/

  /*------------------------------ Registrar Seguimiento --------------------------------*/

  /***********************************************************************************/

  public function registrarSeguimiento()

  {

	 
	  $idusuario = $_POST['responsable'];

	  $fecha = $_POST['fecha'];

	  $idjuzgado = $_POST['juzgado'];

	  $desde = $_POST['desde'];

	  $hasta = $_POST['hasta'];
	  
	  $procesos = $_POST['procesos'];
	  
	  $consecutivo = $_POST['consecutivo'];
	  
	  $r_gancho = $_POST['r_gancho'];
	  
	  $r_coser = $_POST['r_coser'];
	  
	  $r_foliar = $_POST['r_foliar'];
	  
	  $r_siglo = $_POST['r_siglo'];
	  
	  $r_saidoj = $_POST['r_saidoj'];
	  
	  if($r_gancho=='on')
	  {
	   $r_gancho =1;
	  }
	  else
	  {
	   $r_gancho =0;
	  }
	  if($r_coser=='on')
	  {
	   $r_coser =1;
	  }
	  else
	  {
	   $r_coser =0;
	  }
	  if($r_foliar=='on')
	  {
	   $r_foliar =1;
	  }
	  else
	  {
	   $r_foliar =0;
	  }
	  if($r_siglo=='on')
	  {
	   $r_siglo =1;
	  }
	  else
	  {
	   $r_siglo =0;
	  }
	  if($r_saidoj=='on')
	  {
	   $r_saidoj =1;
	  }
	  else
	  {
	   $r_saidoj =0;
	  }
	  
	  $procesos_faltantes = $_POST['procesos_faltantes'];
	  
	  $causales_incumplimiento = $_POST['causales_incumplimiento'];
	  
	  $tiempo_incumplimiento = $_POST['tiempo_incumplimiento'];
	  
	  $observaciones = $_POST['observaciones'];

      $observaciones_revisor = $_POST['observaciones_revisor'];
	  
	  date_default_timezone_set('America/Bogota'); 

      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fechal=$horaa[0];
      
	  $hora=$horaa[1]; 
	  
	  $accion='Resgistr&oacute; Seguimiento';
	  $idres = $_SESSION['idUsuario'];

      $detalle=$_SESSION['nombre']." "."Registro un nuevo seguimiento ".$fechal." "."a las: ".$hora;
	  
	   //es de tipo 1 porque va asociado al módulo de archivo 
	  $tipolog=1;

      $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

      $insertarlog->execute();
	  
	  $registrar = $this->db->prepare("INSERT INTO seguimiento (idusuario,fecha,idjuzgado,desde,hasta,procesos,consecutivo,r_gancho,r_coser,r_foliar,
r_siglo,r_saidoj,procesos_faltantes,causales_incumplimiento,tiempo_incumplimiento,observaciones,observaciones_revisor)
values ('$idusuario','$fecha','$idjuzgado','$desde', '$hasta', '$procesos', '$consecutivo', '$r_gancho', '$r_coser', '$r_foliar', '$r_siglo', '$r_saidoj', '$procesos_faltantes', '$causales_incumplimiento', '$tiempo_incumplimiento', '$observaciones','$observaciones_revisor')");

	  $registrar->execute(); 
	  $resultado = $registrar->rowCount();

	  
      if ($resultado)

      {			

       print'<script languaje="Javascript">location.href="index.php?controller=archivo&action=mensajes&nombre=1"</script>';

      }

	  
	  

  }

 /***********************************************************************************/

  /*------------------------------ Registrar Informe Gestión --------------------------------*/

  /***********************************************************************************/

  public function registrarInformeGestion()

  {

	 
	  $ano = $_POST['ano'];
	  
	  //toma los valores de los juzgados de familia
	  $j1f_enero        = $_POST['j1f_enero'];
	  $j1f_febrero      = $_POST['j1f_febrero'];
	  $j1f_marzo        = $_POST['j1f_marzo'];
	  $j1f_abril        = $_POST['j1f_abril'];
	  $j1f_mayo         = $_POST['j1f_mayo'];
	  $j1f_junio        = $_POST['j1f_junio'];
	  $j1f_julio        = $_POST['j1f_julio'];
	  $j1f_agosto       = $_POST['j1f_agosto'];
	  $j1f_septiembre   = $_POST['j1f_septiembre'];
	  $j1f_octubre   	= $_POST['j1f_octubre'];
	  $j1f_noviembre    = $_POST['j1f_noviembre'];
	  $j1f_diciembre	= $_POST['j1f_diciembre'];
	  //juzgado 1 de familia id:1
	  $idjuzgado        = 1;
	  
	  
	  $registrar = $this->db->prepare("INSERT INTO informe_gestion 		(ano,idjuzgado,enero,febrero,marzo,abril,mayo,junio,julio,
agosto,septiembre,octubre,noviembre,diciembre)
values ('$ano','$idjuzgado','$j1f_enero','$j1f_febrero','$j1f_marzo', '$j1f_abril', '$j1f_mayo', '$j1f_junio', '$j1f_julio', '$j1f_agosto', '$j1f_septiembre', '$j1f_octubre', '$j1f_noviembre', '$j1f_diciembre')");
	  		$registrar->execute(); 

	  
	  
	  
	  $j2f_enero        = $_POST['j2f_enero'];
	  $j2f_febrero      = $_POST['j2f_febrero'];
	  $j2f_marzo        = $_POST['j2f_marzo'];
	  $j2f_abril        = $_POST['j2f_abril'];
	  $j2f_mayo         = $_POST['j2f_mayo'];
	  $j2f_junio        = $_POST['j2f_junio'];
	  $j2f_julio        = $_POST['j2f_julio'];
	  $j2f_agosto       = $_POST['j2f_agosto'];
	  $j2f_septiembre   = $_POST['j2f_septiembre'];
	  $j2f_octubre   	= $_POST['j2f_octubre'];
	  $j2f_noviembre    = $_POST['j2f_noviembre'];
	  $j2f_diciembre	= $_POST['j2f_diciembre'];
	  //juzgado 2 de familia id:2
	  $idjuzgado        = 2;
	  
	  
	  $registrar = $this->db->prepare("INSERT INTO informe_gestion 		(ano,idjuzgado,enero,febrero,marzo,abril,mayo,junio,julio,
agosto,septiembre,octubre,noviembre,diciembre)
values ('$ano','$idjuzgado','$j2f_enero','$j2f_febrero','$j2f_marzo', '$j2f_abril', '$j2f_mayo', '$j2f_junio', '$j2f_julio', '$j2f_agosto', '$j2f_septiembre', '$j2f_octubre', '$j2f_noviembre', '$j2f_diciembre')");
	  		$registrar->execute(); 

	  
	  $j3f_enero        = $_POST['j3f_enero'];
	  $j3f_febrero      = $_POST['j3f_febrero'];
	  $j3f_marzo        = $_POST['j3f_marzo'];
	  $j3f_abril        = $_POST['j3f_abril'];
	  $j3f_mayo         = $_POST['j3f_mayo'];
	  $j3f_junio        = $_POST['j3f_junio'];
	  $j3f_julio        = $_POST['j3f_julio'];
	  $j3f_agosto       = $_POST['j3f_agosto'];
	  $j3f_septiembre   = $_POST['j3f_septiembre'];
	  $j3f_octubre   	= $_POST['j3f_octubre'];
	  $j3f_noviembre    = $_POST['j3f_noviembre'];
	  $j3f_diciembre	= $_POST['j3f_diciembre'];
	  //juzgado 3 de familia id:3
	  $idjuzgado        = 3;
	  
	  
	  $registrar = $this->db->prepare("INSERT INTO informe_gestion 		(ano,idjuzgado,enero,febrero,marzo,abril,mayo,junio,julio,
agosto,septiembre,octubre,noviembre,diciembre)
values ('$ano','$idjuzgado','$j3f_enero','$j3f_febrero','$j3f_marzo', '$j3f_abril', '$j3f_mayo', '$j3f_junio', '$j3f_julio', '$j3f_agosto', '$j3f_septiembre', '$j3f_octubre', '$j3f_noviembre', '$j3f_diciembre')");
	  		$registrar->execute(); 
	  
	  $j4f_enero        = $_POST['j4f_enero'];
	  $j4f_febrero      = $_POST['j4f_febrero'];
	  $j4f_marzo        = $_POST['j4f_marzo'];
	  $j4f_abril        = $_POST['j4f_abril'];
	  $j4f_mayo         = $_POST['j4f_mayo'];
	  $j4f_junio        = $_POST['j4f_junio'];
	  $j4f_julio        = $_POST['j4f_julio'];
	  $j4f_agosto       = $_POST['j4f_agosto'];
	  $j4f_septiembre   = $_POST['j4f_septiembre'];
	  $j4f_octubre 		= $_POST['j4f_octubre'];
	  $j4f_noviembre    = $_POST['j4f_noviembre'];
	  $j4f_diciembre	= $_POST['j4f_diciembre'];
	   //juzgado 4 de familia id:4
	  $idjuzgado        = 4;
	  
	  
	  $registrar = $this->db->prepare("INSERT INTO informe_gestion 		(ano,idjuzgado,enero,febrero,marzo,abril,mayo,junio,julio,
agosto,septiembre,octubre,noviembre,diciembre)
values ('$ano','$idjuzgado','$j4f_enero','$j4f_febrero','$j4f_marzo', '$j4f_abril', '$j4f_mayo', '$j4f_junio', '$j4f_julio', '$j4f_agosto', '$j4f_septiembre', '$j4f_octubre', '$j4f_noviembre', '$j4f_diciembre')");
	  		$registrar->execute(); 
	  
	  
	  $j5f_enero        = $_POST['j5f_enero'];
	  $j5f_febrero      = $_POST['j5f_febrero'];
	  $j5f_marzo        = $_POST['j5f_marzo'];
	  $j5f_abril        = $_POST['j5f_abril'];
	  $j5f_mayo         = $_POST['j5f_mayo'];
	  $j5f_junio        = $_POST['j5f_junio'];
	  $j5f_julio        = $_POST['j5f_julio'];
	  $j5f_agosto       = $_POST['j5f_agosto'];
	  $j5f_septiembre   = $_POST['j5f_septiembre'];
	  $j5f_octubre   	= $_POST['j5f_octubre'];
	  $j5f_noviembre    = $_POST['j5f_noviembre'];
	  $j5f_diciembre	= $_POST['j5f_diciembre'];
	  //juzgado 5 de familia id:5
	  $idjuzgado        = 5;
	  
	  
	  $registrar = $this->db->prepare("INSERT INTO informe_gestion 		(ano,idjuzgado,enero,febrero,marzo,abril,mayo,junio,julio,
agosto,septiembre,octubre,noviembre,diciembre)
values ('$ano','$idjuzgado','$j5f_enero','$j5f_febrero','$j5f_marzo', '$j5f_abril', '$j5f_mayo', '$j5f_junio', '$j5f_julio', '$j5f_agosto', '$j5f_septiembre', '$j5f_octubre', '$j5f_noviembre', '$j5f_diciembre')");
	  		$registrar->execute(); 
	  
	  $j6f_enero        = $_POST['j6f_enero'];
	  $j6f_febrero      = $_POST['j6f_febrero'];
	  $j6f_marzo        = $_POST['j6f_marzo'];
	  $j6f_abril        = $_POST['j6f_abril'];
	  $j6f_mayo         = $_POST['j6f_mayo'];
	  $j6f_junio        = $_POST['j6f_junio'];
	  $j6f_julio        = $_POST['j6f_julio'];
	  $j6f_agosto       = $_POST['j6f_agosto'];
	  $j6f_septiembre   = $_POST['j6f_septiembre'];
	  $j6f_octubre	    = $_POST['j6f_octubre'];
	  $j6f_noviembre    = $_POST['j6f_noviembre'];
	  $j6f_diciembre	= $_POST['j6f_diciembre'];
	  //juzgado 6 de familia id:6
	  $idjuzgado        = 6;
	  
	  
	  $registrar = $this->db->prepare("INSERT INTO informe_gestion 		(ano,idjuzgado,enero,febrero,marzo,abril,mayo,junio,julio,
agosto,septiembre,octubre,noviembre,diciembre)
values ('$ano','$idjuzgado','$j6f_enero','$j6f_febrero','$j6f_marzo', '$j6f_abril', '$j6f_mayo', '$j6f_junio', '$j6f_julio', '$j6f_agosto', '$j6f_septiembre', '$j6f_octubre', '$j6f_noviembre', '$j6f_diciembre')");
	  		$registrar->execute(); 
			
	
	  $j7f_enero        = $_POST['j7f_enero'];
	  $j7f_febrero      = $_POST['j7f_febrero'];
	  $j7f_marzo        = $_POST['j7f_marzo'];
	  $j7f_abril        = $_POST['j7f_abril'];
	  $j7f_mayo         = $_POST['j7f_mayo'];
	  $j7f_junio        = $_POST['j7f_junio'];
	  $j7f_julio        = $_POST['j7f_julio'];
	  $j7f_agosto       = $_POST['j7f_agosto'];
	  $j7f_septiembre   = $_POST['j7f_septiembre'];
	  $j7f_octubre	    = $_POST['j7f_octubre'];
	  $j7f_noviembre    = $_POST['j7f_noviembre'];
	  $j7f_diciembre	= $_POST['j7f_diciembre'];
	  //juzgado 7 de familia id:7
	  $idjuzgado        = 7;
	  
	  
	  $registrar = $this->db->prepare("INSERT INTO informe_gestion 		(ano,idjuzgado,enero,febrero,marzo,abril,mayo,junio,julio,
agosto,septiembre,octubre,noviembre,diciembre)
values ('$ano','$idjuzgado','$j7f_enero','$j7f_febrero','$j7f_marzo', '$j7f_abril', '$j7f_mayo', '$j7f_junio', '$j7f_julio', '$j7f_agosto', '$j7f_septiembre', '$j7f_octubre', '$j7f_noviembre', '$j7f_diciembre')");
	  		$registrar->execute(); 	
	 
	  
	  //tomar los valores de los juzgados civiles de circuito
	  
	  $j1c_enero        = $_POST['j1c_enero'];
	  $j1c_febrero      = $_POST['j1c_febrero'];
	  $j1c_marzo        = $_POST['j1c_marzo'];
	  $j1c_abril        = $_POST['j1c_abril'];
	  $j1c_mayo         = $_POST['j1c_mayo'];
	  $j1c_junio        = $_POST['j1c_junio'];
	  $j1c_julio        = $_POST['j1c_julio'];
	  $j1c_agosto       = $_POST['j1c_agosto'];
	  $j1c_septiembre   = $_POST['j1c_septiembre'];
	  $j1c_octubre	    = $_POST['j1c_octubre'];
	  $j1c_noviembre    = $_POST['j1c_noviembre'];
	  $j1c_diciembre	= $_POST['j1c_diciembre'];
	   //juzgado 1 de civil circuito id:8
	  $idjuzgado        = 8;
	  
	  
	  $registrar = $this->db->prepare("INSERT INTO informe_gestion 		(ano,idjuzgado,enero,febrero,marzo,abril,mayo,junio,julio,
agosto,septiembre,octubre,noviembre,diciembre)
values ('$ano','$idjuzgado','$j1c_enero','$j1c_febrero','$j1c_marzo', '$j1c_abril', '$j1c_mayo', '$j1c_junio', '$j1c_julio', '$j1c_agosto', '$j1c_septiembre', '$j1c_octubre', '$j1c_noviembre', '$j1c_diciembre')");
	  		$registrar->execute(); 	
	  
	  
	  $j2c_enero        = $_POST['j2c_enero'];
	  $j2c_febrero      = $_POST['j2c_febrero'];
	  $j2c_marzo        = $_POST['j2c_marzo'];
	  $j2c_abril        = $_POST['j2c_abril'];
	  $j2c_mayo         = $_POST['j2c_mayo'];
	  $j2c_junio        = $_POST['j2c_junio'];
	  $j2c_julio        = $_POST['j2c_julio'];
	  $j2c_agosto       = $_POST['j2c_agosto'];
	  $j2c_septiembre   = $_POST['j2c_septiembre'];
	  $j2c_octubre	    = $_POST['j2c_octubre'];
	  $j2c_noviembre    = $_POST['j2c_noviembre'];
	  $j2c_diciembre	= $_POST['j2c_diciembre'];
	   //juzgado 2 de civil circuito id:9
	  $idjuzgado        = 9;
	  
	  
	  $registrar = $this->db->prepare("INSERT INTO informe_gestion 		(ano,idjuzgado,enero,febrero,marzo,abril,mayo,junio,julio,
agosto,septiembre,octubre,noviembre,diciembre)
values ('$ano','$idjuzgado','$j2c_enero','$j2c_febrero','$j2c_marzo', '$j1c_abril', '$j2c_mayo', '$j2c_junio', '$j2c_julio', '$j2c_agosto', '$j2c_septiembre', '$j2c_octubre', '$j2c_noviembre', '$j2c_diciembre')");
	  		$registrar->execute(); 	
	  
	  $j3c_enero        = $_POST['j3c_enero'];
	  $j3c_febrero      = $_POST['j3c_febrero'];
	  $j3c_marzo        = $_POST['j3c_marzo'];
	  $j3c_abril        = $_POST['j3c_abril'];
	  $j3c_mayo         = $_POST['j3c_mayo'];
	  $j3c_junio        = $_POST['j3c_junio'];
	  $j3c_julio        = $_POST['j3c_julio'];
	  $j3c_agosto       = $_POST['j3c_agosto'];
	  $j3c_septiembre   = $_POST['j3c_septiembre'];
	  $j3c_octubre		= $_POST['j3c_octubre'];
	  $j3c_noviembre    = $_POST['j3c_noviembre'];
	  $j3c_diciembre	= $_POST['j3c_diciembre'];
	  //juzgado 3 de civil circuito id:10
	  $idjuzgado        = 10;
	  
	  
	  $registrar = $this->db->prepare("INSERT INTO informe_gestion 		(ano,idjuzgado,enero,febrero,marzo,abril,mayo,junio,julio,
agosto,septiembre,octubre,noviembre,diciembre)
values ('$ano','$idjuzgado','$j3c_enero','$j3c_febrero','$j3c_marzo', '$j3c_abril', '$j3c_mayo', '$j3c_junio', '$j3c_julio', '$j3c_agosto', '$j3c_septiembre', '$j3c_octubre', '$j3c_noviembre', '$j3c_diciembre')");
	  		$registrar->execute(); 	  
	  
	  
	  $j4c_enero        = $_POST['j4c_enero'];
	  $j4c_febrero      = $_POST['j4c_febrero'];
	  $j4c_marzo        = $_POST['j4c_marzo'];
	  $j4c_abril        = $_POST['j4c_abril'];
	  $j4c_mayo         = $_POST['j4c_mayo'];
	  $j4c_junio        = $_POST['j4c_junio'];
	  $j4c_julio        = $_POST['j4c_julio'];
	  $j4c_agosto       = $_POST['j4c_agosto'];
	  $j4c_septiembre   = $_POST['j4c_septiembre'];
	  $j4c_octubre      = $_POST['j4c_octubre'];
	  $j4c_noviembre    = $_POST['j4c_noviembre'];
	  $j4c_diciembre	= $_POST['j4c_diciembre'];
	  //juzgado 4 de civil circuito id:11
	  $idjuzgado        = 11;
	  
	  
	  $registrar = $this->db->prepare("INSERT INTO informe_gestion 		(ano,idjuzgado,enero,febrero,marzo,abril,mayo,junio,julio,
agosto,septiembre,octubre,noviembre,diciembre)
values ('$ano','$idjuzgado','$j4c_enero','$j4c_febrero','$j4c_marzo', '$j4c_abril', '$j4c_mayo', '$j4c_junio', '$j4c_julio', '$j4c_agosto', '$j4c_septiembre', '$j4c_octubre', '$j4c_noviembre', '$j4c_diciembre')");
	  		$registrar->execute(); 
	  
	  
	  $j5c_enero        = $_POST['j5c_enero'];
	  $j5c_febrero      = $_POST['j5c_febrero'];
	  $j5c_marzo        = $_POST['j5c_marzo'];
	  $j5c_abril        = $_POST['j5c_abril'];
	  $j5c_mayo         = $_POST['j5c_mayo'];
	  $j5c_junio        = $_POST['j5c_junio'];
	  $j5c_julio        = $_POST['j5c_julio'];
	  $j5c_agosto       = $_POST['j5c_agosto'];
	  $j5c_septiembre   = $_POST['j5c_septiembre'];
	  $j5c_octubre	    = $_POST['j5c_octubre'];
	  $j5c_noviembre    = $_POST['j5c_noviembre'];
	  $j5c_diciembre	= $_POST['j5c_diciembre'];
	  //juzgado 5 de civil circuito id:12
	  $idjuzgado        = 12;
	  
	  
	  $registrar = $this->db->prepare("INSERT INTO informe_gestion 		(ano,idjuzgado,enero,febrero,marzo,abril,mayo,junio,julio,
agosto,septiembre,octubre,noviembre,diciembre)
values ('$ano','$idjuzgado','$j5c_enero','$j5c_febrero','$j5c_marzo', '$j4c_abril', '$j5c_mayo', '$j5c_junio', '$j5c_julio', '$j5c_agosto', '$j5c_septiembre', '$j5c_octubre', '$j5c_noviembre', '$j5c_diciembre')");
	  		$registrar->execute();
	  
	  $j6c_enero        = $_POST['j6c_enero'];
	  $j6c_febrero      = $_POST['j6c_febrero'];
	  $j6c_marzo        = $_POST['j6c_marzo'];
	  $j6c_abril        = $_POST['j6c_abril'];
	  $j6c_mayo         = $_POST['j6c_mayo'];
	  $j6c_junio        = $_POST['j6c_junio'];
	  $j6c_julio        = $_POST['j6c_julio'];
	  $j6c_agosto       = $_POST['j6c_agosto'];
	  $j6c_septiembre   = $_POST['j6c_septiembre'];
	  $j6c_octubre	    = $_POST['j6c_octubre'];
	  $j6c_noviembre    = $_POST['j6c_noviembre'];
	  $j6c_diciembre	= $_POST['j6c_diciembre'];
	  //juzgado 6 de civil circuito id:13
	  $idjuzgado        = 13;
	  
	  
	  $registrar = $this->db->prepare("INSERT INTO informe_gestion 		(ano,idjuzgado,enero,febrero,marzo,abril,mayo,junio,julio,
agosto,septiembre,octubre,noviembre,diciembre)
values ('$ano','$idjuzgado','$j6c_enero','$j6c_febrero','$j6c_marzo', '$j6c_abril', '$j6c_mayo', '$j6c_junio', '$j6c_julio', '$j6c_agosto', '$j6c_septiembre', '$j6c_octubre', '$j6c_noviembre', '$j6c_diciembre')");
	  		$registrar->execute();
	  
	  
	  //tomar los valores de los juzgados civiles de circuito municipal
	  
	  $j1cm_enero        = $_POST['j1cm_enero'];
	  $j1cm_febrero      = $_POST['j1cm_febrero'];
	  $j1cm_marzo        = $_POST['j1cm_marzo'];
	  $j1cm_abril        = $_POST['j1cm_abril'];
	  $j1cm_mayo         = $_POST['j1cm_mayo'];
	  $j1cm_junio        = $_POST['j1cm_junio'];
	  $j1cm_julio        = $_POST['j1cm_julio'];
	  $j1cm_agosto       = $_POST['j1cm_agosto'];
	  $j1cm_septiembre   = $_POST['j1cm_septiembre'];
	  $j1cm_octubre	     = $_POST['j1cm_octubre'];
	  $j1cm_noviembre    = $_POST['j1cm_noviembre'];
	  $j1cm_diciembre	 = $_POST['j1cm_diciembre'];
	  //juzgado 1 de civil circuito municipal id:14
	  $idjuzgado        = 14;
	  
	  
	  $registrar = $this->db->prepare("INSERT INTO informe_gestion 		(ano,idjuzgado,enero,febrero,marzo,abril,mayo,junio,julio,
agosto,septiembre,octubre,noviembre,diciembre)
values ('$ano','$idjuzgado','$j1cm_enero','$j1cm_febrero','$j1cm_marzo', '$j1cm_abril', '$j1cm_mayo', '$j1cm_junio', '$j1cm_julio', '$j1cm_agosto', '$j1cm_septiembre', '$j1cm_octubre', '$j1cm_noviembre', '$j1cm_diciembre')");
	  		$registrar->execute();
	  
	  
	  
	  $j2cm_enero        = $_POST['j2cm_enero'];
	  $j2cm_febrero      = $_POST['j2cm_febrero'];
	  $j2cm_marzo        = $_POST['j2cm_marzo'];
	  $j2cm_abril        = $_POST['j2cm_abril'];
	  $j2cm_mayo         = $_POST['j2cm_mayo'];
	  $j2cm_junio        = $_POST['j2cm_junio'];
	  $j2cm_julio        = $_POST['j2cm_julio'];
	  $j2cm_agosto       = $_POST['j2cm_agosto'];
	  $j2cm_septiembre   = $_POST['j2cm_septiembre'];
	  $j2cm_octubre		 = $_POST['j2cm_octubre'];
	  $j2cm_noviembre    = $_POST['j2cm_noviembre'];
	  $j2cm_diciembre	 = $_POST['j2cm_diciembre'];
	  //juzgado 2 de civil circuito municipal id:15
	  $idjuzgado        = 15;
	  
	  
	 $registrar = $this->db->prepare("INSERT INTO informe_gestion 		(ano,idjuzgado,enero,febrero,marzo,abril,mayo,junio,julio,
agosto,septiembre,octubre,noviembre,diciembre)
values ('$ano','$idjuzgado','$j2cm_enero','$j2cm_febrero','$j2cm_marzo', '$j2cm_abril', '$j2cm_mayo', '$j2cm_junio', '$j2cm_julio', '$j2cm_agosto', '$j2cm_septiembre', '$j2cm_octubre', '$j2cm_noviembre', '$j2cm_diciembre')");
	  		$registrar->execute();
	  
	  $j3cm_enero        = $_POST['j3cm_enero'];
	  $j3cm_febrero      = $_POST['j3cm_febrero'];
	  $j3cm_marzo        = $_POST['j3cm_marzo'];
	  $j3cm_abril        = $_POST['j3cm_abril'];
	  $j3cm_mayo         = $_POST['j3cm_mayo'];
	  $j3cm_junio        = $_POST['j3cm_junio'];
	  $j3cm_julio        = $_POST['j3cm_julio'];
	  $j3cm_agosto       = $_POST['j3cm_agosto'];
	  $j3cm_septiembre   = $_POST['j3cm_septiembre'];
	  $j3cm_octubre	     = $_POST['j3cm_octubre'];
	  $j3cm_noviembre    = $_POST['j3cm_noviembre'];
	  $j3cm_diciembre	 = $_POST['j3cm_diciembre'];
	   //juzgado 3 de civil circuito municipal id:16
	  $idjuzgado        = 16;
	  
	  
	 $registrar = $this->db->prepare("INSERT INTO informe_gestion 		(ano,idjuzgado,enero,febrero,marzo,abril,mayo,junio,julio,
agosto,septiembre,octubre,noviembre,diciembre)
values ('$ano','$idjuzgado','$j3cm_enero','$j3cm_febrero','$j3cm_marzo', '$j3cm_abril', '$j3cm_mayo', '$j3cm_junio', '$j3cm_julio', '$j3cm_agosto', '$j3cm_septiembre', '$j3cm_octubre', '$j3cm_noviembre', '$j3cm_diciembre')");
	  		$registrar->execute();
	  
	  
	  $j4cm_enero        = $_POST['j4cm_enero'];
	  $j4cm_febrero      = $_POST['j4cm_febrero'];
	  $j4cm_marzo        = $_POST['j4cm_marzo'];
	  $j4cm_abril        = $_POST['j4cm_abril'];
	  $j4cm_mayo         = $_POST['j4cm_mayo'];
	  $j4cm_junio        = $_POST['j4cm_junio'];
	  $j4cm_julio        = $_POST['j4cm_julio'];
	  $j4cm_agosto       = $_POST['j4cm_agosto'];
	  $j4cm_septiembre   = $_POST['j4cm_septiembre'];
	  $j4cm_octubre	     = $_POST['j4cm_octubre'];
	  $j4cm_noviembre    = $_POST['j4cm_noviembre'];
	  $j4cm_diciembre	= $_POST['j4cm_diciembre'];
	  //juzgado 4 de civil circuito municipal id:17
	  $idjuzgado        = 17;
	  
	  
	 $registrar = $this->db->prepare("INSERT INTO informe_gestion 		(ano,idjuzgado,enero,febrero,marzo,abril,mayo,junio,julio,
agosto,septiembre,octubre,noviembre,diciembre)
values ('$ano','$idjuzgado','$j4cm_enero','$j4cm_febrero','$j4cm_marzo', '$j4cm_abril', '$j4cm_mayo', '$j4cm_junio', '$j4cm_julio', '$j4cm_agosto', '$j4cm_septiembre', '$j4cm_octubre', '$j4cm_noviembre', '$j4cm_diciembre')");
	  		$registrar->execute();
	  
	  $j5cm_enero        = $_POST['j5cm_enero'];
	  $j5cm_febrero      = $_POST['j5cm_febrero'];
	  $j5cm_marzo        = $_POST['j5cm_marzo'];
	  $j5cm_abril        = $_POST['j5cm_abril'];
	  $j5cm_mayo         = $_POST['j5cm_mayo'];
	  $j5cm_junio        = $_POST['j5cm_junio'];
	  $j5cm_julio        = $_POST['j5cm_julio'];
	  $j5cm_agosto       = $_POST['j5cm_agosto'];
	  $j5cm_septiembre   = $_POST['j5cm_septiembre'];
	  $j5cm_octubre	     = $_POST['j5cm_octubre'];
	  $j5cm_noviembre    = $_POST['j5cm_noviembre'];
	  $j5cm_diciembre	 = $_POST['j5cm_diciembre'];
	  //juzgado 5 de civil circuito municipal id:18
	  $idjuzgado        = 18;
	  
	  
	 $registrar = $this->db->prepare("INSERT INTO informe_gestion 		(ano,idjuzgado,enero,febrero,marzo,abril,mayo,junio,julio,
agosto,septiembre,octubre,noviembre,diciembre)
values ('$ano','$idjuzgado','$j5cm_enero','$j5cm_febrero','$j5cm_marzo', '$j5cm_abril', '$j5cm_mayo', '$j5cm_junio', '$j5cm_julio', '$j5cm_agosto', '$j5cm_septiembre', '$j5cm_octubre', '$j5cm_noviembre', '$j5cm_diciembre')");
	  		$registrar->execute();
	  
	  
	  $j6cm_enero        = $_POST['j6cm_enero'];
	  $j6cm_febrero      = $_POST['j6cm_febrero'];
	  $j6cm_marzo        = $_POST['j6cm_marzo'];
	  $j6cm_abril        = $_POST['j6cm_abril'];
	  $j6cm_mayo         = $_POST['j6cm_mayo'];
	  $j6cm_junio        = $_POST['j6cm_junio'];
	  $j6cm_julio        = $_POST['j6cm_julio'];
	  $j6cm_agosto       = $_POST['j6cm_agosto'];
	  $j6cm_septiembre   = $_POST['j6cm_septiembre'];
	  $j6cm_octubre	     = $_POST['j6cm_octubre'];
	  $j6cm_noviembre    = $_POST['j6cm_noviembre'];
	  $j6cm_diciembre	 = $_POST['j6cm_diciembre'];
	  //juzgado 6 de civil circuito municipal id:19
	  $idjuzgado        = 19;
	  
	  
	 $registrar = $this->db->prepare("INSERT INTO informe_gestion 		(ano,idjuzgado,enero,febrero,marzo,abril,mayo,junio,julio,
agosto,septiembre,octubre,noviembre,diciembre)
values ('$ano','$idjuzgado','$j6cm_enero','$j6cm_febrero','$j6cm_marzo', '$j6cm_abril', '$j6cm_mayo', '$j6cm_junio', '$j6cm_julio', '$j6cm_agosto', '$j6cm_septiembre', '$j6cm_octubre', '$j6cm_noviembre', '$j6cm_diciembre')");
	  		$registrar->execute();
	  
	  
	  $j7cm_enero        = $_POST['j7cm_enero'];
	  $j7cm_febrero      = $_POST['j7cm_febrero'];
	  $j7cm_marzo        = $_POST['j7cm_marzo'];
	  $j7cm_abril        = $_POST['j7cm_abril'];
	  $j7cm_mayo         = $_POST['j7cm_mayo'];
	  $j7cm_junio        = $_POST['j7cm_junio'];
	  $j7cm_julio        = $_POST['j7cm_julio'];
	  $j7cm_agosto       = $_POST['j7cm_agosto'];
	  $j7cm_septiembre   = $_POST['j7cm_septiembre'];
	  $j7cm_octubre	     = $_POST['j7cm_octubre'];
	  $j7cm_noviembre    = $_POST['j7cm_noviembre'];
	  $j7cm_diciembre	 = $_POST['j7cm_diciembre'];
	   //juzgado 7 de civil circuito municipal id:20
	  $idjuzgado        = 20;
	  
	  
	 $registrar = $this->db->prepare("INSERT INTO informe_gestion 		(ano,idjuzgado,enero,febrero,marzo,abril,mayo,junio,julio,
agosto,septiembre,octubre,noviembre,diciembre)
values ('$ano','$idjuzgado','$j7cm_enero','$j7cm_febrero','$j7cm_marzo', '$j7cm_abril', '$j7cm_mayo', '$j7cm_junio', '$j7cm_julio', '$j7cm_agosto', '$j7cm_septiembre', '$j7cm_octubre', '$j7cm_noviembre', '$j7cm_diciembre')");
	  		$registrar->execute();
	  
	  $j8cm_enero        = $_POST['j8cm_enero'];
	  $j8cm_febrero      = $_POST['j8cm_febrero'];
	  $j8cm_marzo        = $_POST['j8cm_marzo'];
	  $j8cm_abril        = $_POST['j8cm_abril'];
	  $j8cm_mayo         = $_POST['j8cm_mayo'];
	  $j8cm_junio        = $_POST['j8cm_junio'];
	  $j8cm_julio        = $_POST['j8cm_julio'];
	  $j8cm_agosto       = $_POST['j8cm_agosto'];
	  $j8cm_septiembre   = $_POST['j8cm_septiembre'];
	  $j8cm_octubre	     = $_POST['j8cm_octubre'];
	  $j8cm_noviembre    = $_POST['j8cm_noviembre'];
	  $j8cm_diciembre	 = $_POST['j8cm_diciembre'];
	  //juzgado 8 de civil circuito municipal id:21
	  $idjuzgado        = 21;
	  
	  
	 $registrar = $this->db->prepare("INSERT INTO informe_gestion 		(ano,idjuzgado,enero,febrero,marzo,abril,mayo,junio,julio,
agosto,septiembre,octubre,noviembre,diciembre)
values ('$ano','$idjuzgado','$j8cm_enero','$j8cm_febrero','$j8cm_marzo', '$j8cm_abril', '$j8cm_mayo', '$j8cm_junio', '$j8cm_julio', '$j8cm_agosto', '$j8cm_septiembre', '$j8cm_octubre', '$j8cm_noviembre', '$j8cm_diciembre')");
	  		$registrar->execute();
	  
	  $j9cm_enero        = $_POST['j9cm_enero'];
	  $j9cm_febrero      = $_POST['j9cm_febrero'];
	  $j9cm_marzo        = $_POST['j9cm_marzo'];
	  $j9cm_abril        = $_POST['j9cm_abril'];
	  $j9cm_mayo         = $_POST['j9cm_mayo'];
	  $j9cm_junio        = $_POST['j9cm_junio'];
	  $j9cm_julio        = $_POST['j9cm_julio'];
	  $j9cm_agosto       = $_POST['j9cm_agosto'];
	  $j9cm_septiembre   = $_POST['j9cm_septiembre'];
	  $j9cm_octubre	     = $_POST['j9cm_octubre'];
	  $j9cm_noviembre    = $_POST['j9cm_noviembre'];
	  $j9cm_diciembre	 = $_POST['j9cm_diciembre'];
	  //juzgado 9 de civil circuito municipal id:22
	  $idjuzgado        = 22;
	  
	  
	 $registrar = $this->db->prepare("INSERT INTO informe_gestion 		(ano,idjuzgado,enero,febrero,marzo,abril,mayo,junio,julio,
agosto,septiembre,octubre,noviembre,diciembre)
values ('$ano','$idjuzgado','$j9cm_enero','$j9cm_febrero','$j9cm_marzo', '$j9cm_abril', '$j9cm_mayo', '$j9cm_junio', '$j9cm_julio', '$j9cm_agosto', '$j9cm_septiembre', '$j9cm_octubre', '$j9cm_noviembre', '$j9cm_diciembre')");
	  		$registrar->execute();
	  
	  $j10cm_enero        = $_POST['j10cm_enero'];
	  $j10cm_febrero      = $_POST['j10cm_febrero'];
	  $j10cm_marzo        = $_POST['j10cm_marzo'];
	  $j10cm_abril        = $_POST['j10cm_abril'];
	  $j10cm_mayo         = $_POST['j10cm_mayo'];
	  $j10cm_junio        = $_POST['j10cm_junio'];
	  $j10cm_julio        = $_POST['j10cm_julio'];
	  $j10cm_agosto       = $_POST['j10cm_agosto'];
	  $j10cm_septiembre   = $_POST['j10cm_septiembre'];
	  $j10cm_octubre	  = $_POST['j10cm_octubre'];
	  $j10cm_noviembre    = $_POST['j10cm_noviembre'];
	  $j10cm_diciembre    = $_POST['j10cm_diciembre'];
	  //juzgado 10 de civil circuito municipal id:23
	  $idjuzgado        = 23;
	  
	  
	 $registrar = $this->db->prepare("INSERT INTO informe_gestion 		(ano,idjuzgado,enero,febrero,marzo,abril,mayo,junio,julio,
agosto,septiembre,octubre,noviembre,diciembre)
values ('$ano','$idjuzgado','$j10cm_enero','$j10cm_febrero','$j10cm_marzo', '$j10cm_abril', '$j10cm_mayo', '$j10cm_junio', '$j10cm_julio', '$j10cm_agosto', '$j10cm_septiembre', '$j10cm_octubre', '$j10cm_noviembre', '$j10cm_diciembre')");
	  		$registrar->execute();
	  
	  $j11cm_enero        = $_POST['j11cm_enero'];
	  $j11cm_febrero      = $_POST['j11cm_febrero'];
	  $j11cm_marzo        = $_POST['j11cm_marzo'];
	  $j11cm_abril        = $_POST['j11cm_abril'];
	  $j11cm_mayo         = $_POST['j11cm_mayo'];
	  $j11cm_junio        = $_POST['j11cm_junio'];
	  $j11cm_julio        = $_POST['j11cm_julio'];
	  $j11cm_agosto       = $_POST['j11cm_agosto'];
	  $j11cm_septiembre   = $_POST['j11cm_septiembre'];
	  $j11cm_octubre	  = $_POST['j11cm_octubre'];	  
	  $j11cm_noviembre    = $_POST['j11cm_noviembre'];
	  $j11cm_diciembre    = $_POST['j11cm_diciembre'];
	  //juzgado 11 de civil circuito municipal id:24
	  $idjuzgado        = 24;
	  
	  
	 $registrar = $this->db->prepare("INSERT INTO informe_gestion 		(ano,idjuzgado,enero,febrero,marzo,abril,mayo,junio,julio,
agosto,septiembre,octubre,noviembre,diciembre)
values ('$ano','$idjuzgado','$j11cm_enero','$j11cm_febrero','$j11cm_marzo', '$j11cm_abril', '$j11cm_mayo', '$j11cm_junio', '$j11cm_julio', '$j11cm_agosto', '$j11cm_septiembre', '$j11cm_octubre', '$j11cm_noviembre', '$j11cm_diciembre')");
	  		$registrar->execute();
	  
	  $j12cm_enero        = $_POST['j12cm_enero'];
	  $j12cm_febrero      = $_POST['j12cm_febrero'];
	  $j12cm_marzo        = $_POST['j12cm_marzo'];
	  $j12cm_abril        = $_POST['j12cm_abril'];
	  $j12cm_mayo         = $_POST['j12cm_mayo'];
	  $j12cm_junio        = $_POST['j12cm_junio'];
	  $j12cm_julio        = $_POST['j12cm_julio'];
	  $j12cm_agosto       = $_POST['j12cm_agosto'];
	  $j12cm_septiembre   = $_POST['j12cm_septiembre'];
	  $j12cm_octubre      = $_POST['j12cm_octubre'];
	  $j12cm_noviembre    = $_POST['j12cm_noviembre'];
	  $j12cm_diciembre    = $_POST['j12cm_diciembre'];
	   //juzgado 12 de civil circuito municipal id:25
	  $idjuzgado        = 25;
	  
	  
	 $registrar = $this->db->prepare("INSERT INTO informe_gestion 		(ano,idjuzgado,enero,febrero,marzo,abril,mayo,junio,julio,
agosto,septiembre,octubre,noviembre,diciembre)
values ('$ano','$idjuzgado','$j12cm_enero','$j12cm_febrero','$j12cm_marzo', '$j12cm_abril', '$j12cm_mayo', '$j12cm_junio', '$j12cm_julio', '$j12cm_agosto', '$j12cm_septiembre', '$j12cm_octubre', '$j12cm_noviembre', '$j12cm_diciembre')");
	  		$registrar->execute();
	  
	  
	  
	  date_default_timezone_set('America/Bogota'); 

      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fechal=$horaa[0];
      
	  $hora=$horaa[1]; 
	  
	  $accion='Resgistr&oacute; informe de gesti&oacute;n';
	  $idres = $_SESSION['idUsuario'];

      $detalle=$_SESSION['nombre']." "."Resgistr&oacute; informe de gesti&oacute;n ".$fechal." "."a las: ".$hora;
	  
	   //es de tipo 1 porque va asociado al módulo de archivo 
	  $tipolog=1;

      $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

      $insertarlog->execute();
	  
	  		  		

       print'<script languaje="Javascript">location.href="index.php?controller=archivo&action=mensajes&nombre=6"</script>';

     
  }




 /***********************************************************************************/

  /*------------------------------ Consultar Informe Gestión --------------------------------*/

  /***********************************************************************************/

  public function consultarInformeGestion()

  {
  
   $ano=$_GET['nombre'];    

    $listar = $this->db->prepare("select ig.id,ig.ano,juz.nombre as juzgado,are.nombre as area,ig.ano,ig.enero,ig.febrero,ig.marzo,ig.abril,ig.mayo,ig.junio,ig.julio,
ig.agosto,ig.septiembre,ig.octubre,ig.noviembre,ig.diciembre, ig.idjuzgado as idjuz
from informe_gestion ig
inner join pa_juzgado juz on (ig.idjuzgado=juz.id)
inner join pa_area are on (are.id=juz.idarea)
where ig.ano='$ano'
order by ig.id;");

  $listar->execute();

  return $listar;

  

  
  }








 /***********************************************************************************/

  /*------------------------------ Modificar Informe Gestión --------------------------------*/

  /***********************************************************************************/

  public function modificarInformeGestion()

  {

	 
	  	   $ano = $_GET['nombre'];
	       $cantidad_juzgados= 25;
		   $i=1;
		   
		   
		   while ($i<=$cantidad_juzgados)
		   {
		    
			$enero 		= $_POST['enero'.$i];
			$febrero 	= $_POST['febrero'.$i];
			$marzo 		= $_POST['marzo'.$i];
			$abril 		= $_POST['abril'.$i];
			$mayo 		= $_POST['mayo'.$i];
			$junio 		= $_POST['junio'.$i];
			$julio 		= $_POST['julio'.$i];
			$agosto 	= $_POST['agosto'.$i];
			$septiembre = $_POST['septiembre'.$i];
			$octubre 	= $_POST['octubre'.$i];
			$noviembre 	= $_POST['noviembre'.$i];
			$diciembre 	= $_POST['diciembre'.$i];
			
			$actualizar = $this->db->prepare("UPDATE informe_gestion SET enero='$enero',febrero='$febrero',marzo='$marzo',abril='$abril',mayo='$mayo',junio='$junio',julio='$julio',agosto='$agosto',septiembre='$septiembre',octubre='$octubre',noviembre='$noviembre',diciembre='$diciembre' WHERE idjuzgado='$i' AND ano='$ano'");
	  		$actualizar->execute(); 
	
			$i=$i+1;
			unset($enero,$febrero,$marzo,$abril,$mayo,$junio,$julio,$agosto,$septiembre,$octubre,$noviembre,$diciembre);
		   
		   }
		   
	  
	  
	  date_default_timezone_set('America/Bogota'); 

      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fechal=$horaa[0];
      
	  $hora=$horaa[1]; 
	  
	  $accion='Actualiz&oacute; informe de gesti&oacute;n';
	  $idres = $_SESSION['idUsuario'];

      $detalle=$_SESSION['nombre']." "."Actualiz&oacute; informe de gesti&oacute;n ".$fechal." "."a las: ".$hora;
	  
	   //es de tipo 1 porque va asociado al módulo de archivo 
	  $tipolog=1;

      $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

      $insertarlog->execute();
	  
	  		  		

       print'<script languaje="Javascript">location.href="index.php?controller=archivo&action=mensajes&nombre=7"</script>';

     

	  
	  

  }













  /***********************************************************************************/

  /*------------------------------  Listar Todos los seguimientos  --------------------*/

  /***********************************************************************************/

  public function listarSeguimientos()

  {

  

  $listar = $this->db->prepare("select segui.id,usuarios.empleado as responsable, segui.fecha,juzgado.nombre,segui.desde,segui.hasta,segui.procesos,segui.consecutivo,
segui.procesos_faltantes,segui.tiempo_incumplimiento
from seguimiento as segui
inner join pa_usuario as usuarios on (usuarios.id=segui.idusuario)
inner join pa_juzgado as juzgado  on (juzgado.id=segui.idjuzgado) ");

  $listar->execute();

  return $listar;

  

  }

  /***********************************************************************************/

  /*---------------------------  Listar usuarios empleados del área archivo --------------------*/

  /***********************************************************************************/

  public function listarEmpleados(){
  	$listar = $this->db->prepare("SELECT * FROM pa_usuario where id_proceso_cs=4 and idestadoempleado=1 order by empleado ");

  $listar->execute();

  return $listar;

  

  }
		/***********************************************************************************/
		/*---------------------------  Listar usuarios empleados con el jef de área archivo --------------------*/
		/***********************************************************************************/
		//JUAN ESTEBAN MUNERA BETANCUR 2118-09-19
		public function listarEmpleadosJefe(){
			$listar = $this->db->prepare("SELECT * FROM pa_usuario where id_proceso_cs=4 AND idestadoempleado=1 order by empleado ");
			$listar->execute();
			return $listar;
		}
  
    /***********************************************************************************/

  /*------------------------------  Listar juzgados  ---------------------------------*/

  /***********************************************************************************/

  public function listarJuzgados()

  {

  

  $listar = $this->db->prepare("SELECT * FROM pa_juzgado");

  $listar->execute();

  return $listar;

  

  }
  
/***********************************************************************************/

  /*------------------------------  Listar Años Seguimiento -------------------------*/

  /***********************************************************************************/

  public function listarAno(){

  

  $listar = $this->db->prepare("SELECT DISTINCT ano from informe_gestion");

  $listar->execute();

  return $listar;

  

  }
  

 	

	/***********************************************************************************/

	/*----------------------------  Actualizar Datos Seguimiento ------------------------*/

	/***********************************************************************************/

	public function updateSeguimiento()

	{

	   $id = $_POST['id'];
	  
	  $idusuario = $_POST['responsable'];

	   $fecha = $_POST['fecha'];

	  $idjuzgado = $_POST['juzgado'];

	  $desde = $_POST['desde'];

	  $hasta = $_POST['hasta'];
	  
	  $procesos = $_POST['procesos'];
	   	  
	  $consecutivo = $_POST['consecutivo'];
	  
	  $r_gancho = $_POST['r_gancho'];
	  
	  $r_coser = $_POST['r_coser'];
	  
	  $r_foliar = $_POST['r_foliar'];
	  
	  $r_siglo = $_POST['r_siglo'];
	  
	  $r_saidoj = $_POST['r_saidoj'];
	  
	  if($r_gancho=='on')
	  {
	   $r_gancho =1;
	  }
	  else
	  {
	   $r_gancho =0;
	  }
	  if($r_coser=='on')
	  {
	   $r_coser =1;
	  }
	  else
	  {
	   $r_coser =0;
	  }
	  if($r_foliar=='on')
	  {
	   $r_foliar =1;
	  }
	  else
	  {
	   $r_foliar =0;
	  }
	  if($r_siglo=='on')
	  {
	   $r_siglo =1;
	  }
	  else
	  {
	   $r_siglo =0;
	  }
	  if($r_saidoj=='on')
	  {
	   $r_saidoj =1;
	  }
	  else
	  {
	   $r_saidoj =0;
	  }
	  
	  $procesos_faltantes = $_POST['procesos_faltantes'];
	  
	  $causales_incumplimiento = $_POST['causales_incumplimiento'];
	  
	  $tiempo_incumplimiento = $_POST['tiempo_incumplimiento'];
	  
	  $observaciones = $_POST['observaciones'];

      $observaciones_revisor = $_POST['observaciones_revisor'];
	  
	    
	  date_default_timezone_set('America/Bogota'); 

      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fechal=$horaa[0];
      
	  $hora=$horaa[1]; 
	  
	  $accion='Modific&oacute; Seguimiento';
	  $idres = $_SESSION['idUsuario'];

      $detalle=$_SESSION['nombre']." "."Modifico un nuevo seguimiento ".$fechal." "."a las: ".$hora;
	  
	   //es de tipo 1 porque va asociado al módulo de archivo 
	 $tipolog=1;

      $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

      $insertarlog->execute();
	

	 $modificare = $this->db->prepare("UPDATE seguimiento SET  idusuario = '$idusuario', fecha = '$fecha', idjuzgado = '$idjuzgado', desde = '$desde', hasta = '$hasta', procesos = '$procesos', consecutivo = '$consecutivo', r_gancho = '$r_gancho', r_coser = '$r_coser', r_foliar = '$r_foliar', r_siglo = '$r_siglo', r_saidoj = '$r_saidoj' , procesos_faltantes = '$procesos_faltantes', causales_incumplimiento = '$causales_incumplimiento', tiempo_incumplimiento = '$tiempo_incumplimiento', observaciones = '$observaciones', observaciones_revisor = '$observaciones_revisor' WHERE id = '$id'");  

  $modificare->execute();

  	

	$resultado = $modificare->rowCount();

      if ($resultado)

      {			

       print'<script languaje="Javascript">location.href="index.php?controller=archivo&action=mensajes&nombre=2"</script>';

	   

      }

     
   } 

   /***********************************************************************************/

	/*------------------------------ Eliminar  Seguimiento ---------------------------------*/

	/***********************************************************************************/	

	public function eliminarSeguimiento()

	{

		$id=$_GET['nombre'];
	    date_default_timezone_set('America/Bogota'); 
        $fechaa=date('Y-m-d g:ia');
        $horaa=explode(' ',$fechaa);
        $fechal=$horaa[0];
        $hora=$horaa[1]; 
		
	    $accion='Elimin&oacute; Seguimiento';
	    $idres = $_SESSION['idUsuario'];
        $detalle=$_SESSION['nombre']." "."Elimino un seguimiento ".$fechal." "."a las: ".$hora;
	 
	   //es de tipo 1 porque va asociado al módulo de archivo 
	    $tipolog=1;

        $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

        $insertarlog->execute();
	


		

	if($_SESSION['id']!="")
   {

   		$consulta = $this->db->prepare("DELETE FROM seguimiento WHERE id='$id'");

		$consulta->execute();

		$resultado = $consulta->rowCount();

		

		 if ($resultado)

        {

			  $_SESSION['elemento'] = "Seguimiento eliminado exitosamente";

	          $_SESSION['elem_conscontrato'] = true;  

		}	

		echo '<script languaje="Javascript">location.href="index.php?controller=archivo&action=listarSeguimientos"</script>';

		

	}

	
}

   /***********************************************************************************/

	/*--------------------------- Eliminar  Inventario Entrante ---------------------------------*/

	/***********************************************************************************/	

	public function eliminarInventarioEntrante()

	{

		$id=$_GET['nombre'];
	    date_default_timezone_set('America/Bogota'); 
        $fechaa=date('Y-m-d g:ia');
        $horaa=explode(' ',$fechaa);
        $fechal=$horaa[0];
        $hora=$horaa[1]; 
		
	    $accion='Elimin&oacute; Acta de recibido';
	    $idres = $_SESSION['idUsuario'];
        $detalle=$_SESSION['nombre']." "."Elimino Acta de recibido ".$fechal." "."a las: ".$hora;
	 
	   //es de tipo 1 porque va asociado al módulo de archivo 
	    $tipolog=1;

        $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

        $insertarlog->execute();
	


		

	if($_SESSION['id']!="")
   {

   		$consulta = $this->db->prepare("DELETE FROM inventario WHERE id='$id'");

		$consulta->execute();

		$resultado = $consulta->rowCount();

		

		 if ($resultado)

        {

			  $_SESSION['elemento'] = "Acta de recibido eliminada exitosamente";

	          $_SESSION['elem_conscontrato'] = true;  

		}	

		echo '<script languaje="Javascript">location.href="index.php?controller=archivo&action=listRecibidoInventario"</script>';

		

	}

	
}



/***********************************************************************************/

	/*--------------------------- Eliminar  Inventario Saliente ---------------------------------*/

	/***********************************************************************************/	

	public function eliminarInventarioSaliente()

	{

		$id=$_GET['nombre'];
	    date_default_timezone_set('America/Bogota'); 
        $fechaa=date('Y-m-d g:ia');
        $horaa=explode(' ',$fechaa);
        $fechal=$horaa[0];
        $hora=$horaa[1]; 
		
	    $accion='Elimin&oacute; Acta de entrega';
	    $idres = $_SESSION['idUsuario'];
        $detalle=$_SESSION['nombre']." "."Elimino Acta de entrega ".$fechal." "."a las: ".$hora;
	 
	   //es de tipo 1 porque va asociado al módulo de archivo 
	    $tipolog=1;

        $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

        $insertarlog->execute();
	


		

	if($_SESSION['id']!="")
   {

   		$consulta = $this->db->prepare("DELETE FROM inventario WHERE id='$id'");

		$consulta->execute();

		$resultado = $consulta->rowCount();

		

		 if ($resultado)

        {

			  $_SESSION['elemento'] = "Acta de entrega eliminada exitosamente";

	          $_SESSION['elem_conscontrato'] = true;  

		}	

		echo '<script languaje="Javascript">location.href="index.php?controller=archivo&action=listEntregaInventario"</script>';

		

	}

	
}



/***********************************************************************************/

  /*------------------------------ Listar  Seguimiento Especifico ---------------------*/

  /***********************************************************************************/	

 public function listarSeguimiento()

	{

		 $id=$_GET['nombre'];

		$consulta = $this->db->prepare("select segui.id,segui.idjuzgado,usuarios.empleado, segui.fecha,juzgado.nombre as juzgadonom,segui.desde,segui.hasta,segui.procesos,segui.consecutivo,
segui.r_gancho,segui.r_coser,segui.r_foliar,segui.r_siglo,segui.r_saidoj,segui.procesos_faltantes,segui.causales_incumplimiento,segui.tiempo_incumplimiento,
segui.observaciones,segui.observaciones_revisor,segui.causales_incumplimiento as causales
from seguimiento as segui
inner join pa_usuario as usuarios on (usuarios.id=segui.idusuario)
inner join pa_juzgado as juzgado  on (juzgado.id=segui.idjuzgado)  WHERE segui.id='$id'");

		$consulta->execute();

		return $consulta;

	}  




 /***********************************************************************************/

  /*------------------------- Registrar Inventario Entrante ----------------------------*/

  /***********************************************************************************/

  public function registrarInventarioEntrante()

  {

	 
	  $idtipoinventario = $_POST['tipo_inventario'];
	  
	  $consecutivo_acta = $_POST['consecutivo_acta'];

	  $fecha_acta = $_POST['fecha_acta'];
	  
	  $idjuzgado = $_POST['idjuzgado'];
	  
	  $responsable = $_POST['responsable'];
	  
	  $observaciones = $_POST['observaciones'];	
	  
	  $cantidad_prestamo = $_POST['cantidad_prestamo'];	
	  
	  $nombre_prestamo = $_POST['nombre_prestamo'];	
	  
	  $observaciones_prestamo = $_POST['observaciones_prestamo'];	  
	  
	   //$mes = $_POST['mes'];
	  $j=$i=0;
	  $enero=$febrero=$marzo=$abril=$mayo=$junio=$julio=$agosto=$septiembre=$octubre=$noviembre=$diciembre=0;
	   
      foreach ($_POST['mes'] as $indice => $valor){ 
       	if($valor==1){
		   $enero=1;
		   }
	  	else if($valor==2){
		   $febrero=1;
		   }
		else if($valor==3){
		   $marzo=1;
		   }
		 else if($valor==4){
		   $abril=1;
		   }
		 else if($valor==5){
		   $mayo=1;
		   }
		 else if($valor==6){
		   $junio=1;
		   }
		  else if($valor==7){
		   $julio=1;
		   }
		  else if($valor==8){
		   $agosto=1;
		   }
		  else if($valor==9){
		   $septiembre=1;
		   }
		  else if($valor==10){
		   $octubre=1;
		   }
		  else if($valor==11){
		   $noviembre=1;
		   }
		  else if($valor==12){
		   $diciembre=1;
		   }    
	   }
	  
	  foreach ($_POST['ano'] as $indice1 => $valor1){ 
      $vano[$j] = $valor1;
      $j = $j+1;
      } 
	  $i=0;
	  $cont_ano= count($vano);
	  $ano= "";
	  
	  while($i<$cont_ano)
	  {
	   if($i!=0)
	   {
	    $ano = $ano.",";
	   }
	   $ano = $ano.$vano[$i];
	   $i= $i+1;
	  
	  }
	  
	 
	 $desde_caja = $_POST['desde_caja'];
	 
	 if (isset($_POST['desde_caja']))
	 {
	  echo "si";
	 }
	 else
	 echo "mn";

	  $hasta_caja = $_POST['hasta_caja'];
	  
	  $cantidad_cajas = $_POST['cantidad_cajas'];
	  
	  $desde_expediente = $_POST['desde_expediente'];
	  
	  $hasta_expediente = $_POST['hasta_expediente'];
	  
	  $cantidad_expedientes = $_POST['cantidad_expedientes'];
	  
	  $nombre_entrega = $_POST['nombre_entrega'];
	  
	  $nombre_recibe = $_POST['nombre_recibe'];
	  
	  
	 
	  date_default_timezone_set('America/Bogota'); 

      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fechal=$horaa[0];
      
	  $hora=$horaa[1]; 
	  
	  $accion='Resgistr&oacute; Acta Recibido';
	  $idres = $_SESSION['idUsuario'];

      $detalle=$_SESSION['nombre']." "."Registro acta de recibido ".$fechal." "."a las: ".$hora;
	  
	   //es de tipo 1 porque va asociado al módulo de archivo 
	  $tipolog=1;

      $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

      $insertarlog->execute();
	  
	  $registrar = $this->db->prepare("INSERT INTO inventario (idtipoinventario,consecutivo_acta,fecha_acta,idjuzgado,responsable,enero,febrero,marzo,abril,
mayo,junio,julio,agosto,septiembre,octubre,noviembre,diciembre,ano_archivar,desde_caja,hasta_caja,desde_expediente,
hasta_expediente,cantidad_expedientes,cantidad_cajas,nombre_entrega,nombre_recibe,observaciones,cantidad_expedientes_prestados,persona_presto,observaciones_prestamo,idestado_acta)
values('$idtipoinventario','$consecutivo_acta','$fecha_acta','$idjuzgado','$responsable','$enero','$febrero','$marzo',
'$abril','$mayo','$junio','$julio','$agosto','$septiembre','$octubre','$noviembre','$diciembre','$ano','$desde_caja',
'$hasta_caja','$desde_expediente','$hasta_expediente','$cantidad_expedientes','$cantidad_cajas','$nombre_entrega','$nombre_recibe','$observaciones','$cantidad_prestamo','$nombre_prestamo','$observaciones_prestamo',1)");
	  $registrar->execute(); 
	  $resultado = $registrar->rowCount();

	  $tipo_consecutivo = $_POST['tipo_consecutivo'];
	  
	  if($tipo_consecutivo==1)
	  {
	    $actualizar = $this->db->prepare("UPDATE consecutivo set consecutivo_civil=consecutivo_civil+1 where tipo='Recibido'");
        $actualizar->execute(); 
		
	  }
	  
	  if($tipo_consecutivo==2)
	  {
	    $actualizar = $this->db->prepare("UPDATE consecutivo set consecutivo_familia=consecutivo_familia+1 where tipo='Recibido'");
        $actualizar->execute(); 
		
	  }
	  
	  if($tipo_consecutivo==3)
	  {
	    $actualizar = $this->db->prepare("UPDATE consecutivo set consecutivo_municipal=consecutivo_municipal+1 where tipo='Recibido'");
        $actualizar->execute(); 
		
	  }	
	  
      if ($resultado)

      {			

    print'<script languaje="Javascript">location.href="index.php?controller=archivo&action=mensajes&nombre=3 "</script>';

      }

	  
	  

  }
  
  /***********************************************************************************/

  /*------------------------- Modificar Inventario Entrante ----------------------------*/

  /***********************************************************************************/

  public function updateInventarioEntrante()

  {

	 
	  $id = $_POST['id'];
	  
	  $consecutivo_acta = $_POST['consecutivo_acta'];

	  $fecha_acta = $_POST['fecha_acta'];
	  
	  $idjuzgado = $_POST['idjuzgado'];
	  
	  $responsable = $_POST['responsable'];
	  
	  $observaciones = $_POST['observaciones'];	  
	  
	   //$mes = $_POST['mes'];
	  $j=$i=0;
	  $enero=$febrero=$marzo=$abril=$mayo=$junio=$julio=$agosto=$septiembre=$octubre=$noviembre=$diciembre=0;
	   
      foreach ($_POST['mes'] as $indice => $valor){ 
       	if($valor==1){
		   $enero=1;
		   }
	  	else if($valor==2){
		   $febrero=1;
		   }
		else if($valor==3){
		   $marzo=1;
		   }
		 else if($valor==4){
		   $abril=1;
		   }
		 else if($valor==5){
		   $mayo=1;
		   }
		 else if($valor==6){
		   $junio=1;
		   }
		  else if($valor==7){
		   $julio=1;
		   }
		  else if($valor==8){
		   $agosto=1;
		   }
		  else if($valor==9){
		   $septiembre=1;
		   }
		  else if($valor==10){
		   $octubre=1;
		   }
		  else if($valor==11){
		   $noviembre=1;
		   }
		  else if($valor==12){
		   $diciembre=1;
		   }    
	   }
	  
	  foreach ($_POST['ano'] as $indice1 => $valor1){ 
      $vano[$j] = $valor1;
      $j = $j+1;
      } 
	  $i=0;
	  $cont_ano= count($vano);
	  $ano= "";
	  
	  while($i<$cont_ano)
	  {
	   if($i!=0)
	   {
	    $ano = $ano.",";
	   }
	   $ano = $ano.$vano[$i];
	   $i= $i+1;
	  
	  }
	  
	 
	  $desde_caja 			= $_POST['desde_caja'];

	  $hasta_caja 			= $_POST['hasta_caja'];
	  
	  $cantidad_cajas 		= $_POST['cantidad_cajas'];
	  
	  $desde_expediente 	= $_POST['desde_expediente'];
	  
	  $hasta_expediente 	= $_POST['hasta_expediente'];
	  
	  $cantidad_expedientes = $_POST['cantidad_expedientes'];
	  
	  $nombre_entrega 		= $_POST['nombre_entrega'];
	  
	  $nombre_recibe 		= $_POST['nombre_recibe'];
	  
	  $prestados			= $_POST['prestados'];
	  
	  if($prestados==1)
	  {
	   
	   $cantidad_prestamo = $_POST['cantidad_prestamo'];
	   $nombre_prestamo   = $_POST['nombre_prestamo'];
	   $observaciones_prestamo = $_POST['observaciones_prestamo'];
	  }
	  
	  
	  
	  
	 
	  date_default_timezone_set('America/Bogota'); 

      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fechal=$horaa[0];
      
	  $hora=$horaa[1]; 
	  
	  $accion='Modific&oacute; Acta Recibido';
	  $idres = $_SESSION['idUsuario'];

      $detalle=$_SESSION['nombre']." "."Modifico acta de recibido ".$fechal." "."a las: ".$hora;
	  
	   //es de tipo 1 porque va asociado al módulo de archivo 
	  $tipolog=1;

      $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

      $insertarlog->execute();
	  
	  
	  if($prestados==1)
	  {
	  
	  $registrar = $this->db->prepare("UPDATE inventario SET consecutivo_acta='$consecutivo_acta',fecha_acta='$fecha_acta',idjuzgado='$idjuzgado',responsable='$responsable',enero='$enero',febrero='$febrero',marzo='$marzo',abril='$abril',mayo='$mayo',junio='$junio',julio='$julio',agosto='$agosto',septiembre='$septiembre',octubre='$octubre',noviembre='$noviembre',diciembre='$diciembre',ano_archivar='$ano',desde_caja='$desde_caja',hasta_caja='$hasta_caja',desde_expediente='$desde_expediente',hasta_expediente='$hasta_expediente',cantidad_expedientes='$cantidad_expedientes',cantidad_cajas='$cantidad_cajas',nombre_entrega='$nombre_entrega',nombre_recibe='$nombre_recibe', observaciones='$observaciones', cantidad_expedientes_prestados='$cantidad_prestamo', persona_presto='$nombre_prestamo', observaciones_prestamo='$observaciones_prestamo'  WHERE id='$id'");

	 }
	 else
	 {
	  $registrar = $this->db->prepare("UPDATE inventario SET consecutivo_acta='$consecutivo_acta',fecha_acta='$fecha_acta',idjuzgado='$idjuzgado',responsable='$responsable',enero='$enero',febrero='$febrero',marzo='$marzo',abril='$abril',mayo='$mayo',junio='$junio',julio='$julio',agosto='$agosto',septiembre='$septiembre',octubre='$octubre',noviembre='$noviembre',diciembre='$diciembre',ano_archivar='$ano',desde_caja='$desde_caja',hasta_caja='$hasta_caja',desde_expediente='$desde_expediente',hasta_expediente='$hasta_expediente',cantidad_expedientes='$cantidad_expedientes',cantidad_cajas='$cantidad_cajas',nombre_entrega='$nombre_entrega',nombre_recibe='$nombre_recibe', observaciones='$observaciones' WHERE id='$id'");
	 
	 } 
	  
	  
	  $registrar->execute(); 
	  $resultado = $registrar->rowCount();

		

       print'<script languaje="Javascript">location.href="index.php?controller=archivo&action=mensajes&nombre=5"</script>';

  

	  
	  

  }

  
  
  
  
  /***********************************************************************************/

  /*------------------------- Registrar Inventario Saliente ----------------------------*/

  /***********************************************************************************/

  public function registrarInventarioSaliente()

  {

	 
	  $idtipoinventario = $_POST['tipo_inventario'];
	  
	  $consecutivo_acta = $_POST['consecutivo_acta'];

	  $fecha_acta = $_POST['fecha_acta'];
	  
	  $idjuzgado = $_POST['idjuzgado'];
	  
	  $iddestinojuzgado = $_POST['iddestinojuzgado'];
	  
	  $responsable = $_POST['responsable'];	  
	  
	   //$mes = $_POST['mes'];
	  $j=$i=0;
	  $enero=$febrero=$marzo=$abril=$mayo=$junio=$julio=$agosto=$septiembre=$octubre=$noviembre=$diciembre=0;
	   
      foreach ($_POST['mes'] as $indice => $valor){ 
       	if($valor==1){
		   $enero=1;
		   }
	  	else if($valor==2){
		   $febrero=1;
		   }
		else if($valor==3){
		   $marzo=1;
		   }
		 else if($valor==4){
		   $abril=1;
		   }
		 else if($valor==5){
		   $mayo=1;
		   }
		 else if($valor==6){
		   $junio=1;
		   }
		  else if($valor==7){
		   $julio=1;
		   }
		  else if($valor==8){
		   $agosto=1;
		   }
		  else if($valor==9){
		   $septiembre=1;
		   }
		  else if($valor==10){
		   $octubre=1;
		   }
		  else if($valor==11){
		   $noviembre=1;
		   }
		  else if($valor==12){
		   $diciembre=1;
		   }    
	   }
	  
	  foreach ($_POST['ano'] as $indice1 => $valor1){ 
      $vano[$j] = $valor1;
      $j = $j+1;
      } 
	  $i=0;
	  $cont_ano= count($vano);
	  $ano= "";
	  
	  while($i<$cont_ano)
	  {
	   if($i!=0)
	   {
	    $ano = $ano.",";
	   }
	   $ano = $ano.$vano[$i];
	   $i= $i+1;
	  
	  }
	  
	 
	  $desde_caja = $_POST['desde_caja'];

	  $hasta_caja = $_POST['hasta_caja'];
	  
	  $cantidad_cajas = $_POST['cantidad_cajas'];
	  
	  $desde_expediente = $_POST['desde_expediente'];
	  
	  $hasta_expediente = $_POST['hasta_expediente'];
	  
	  $cantidad_expedientes = $_POST['cantidad_expedientes'];
	  
	  $nombre_entrega = $_POST['nombre_entrega'];
	  
	  $nombre_recibe = $_POST['nombre_recibe'];
	  
	  
	 
	  date_default_timezone_set('America/Bogota'); 

      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fechal=$horaa[0];
      
	  $hora=$horaa[1]; 
	  
	  $accion='Resgistr&oacute; Acta Entrega';
	  $idres = $_SESSION['idUsuario'];

      $detalle=$_SESSION['nombre']." "."Registro acta de entrega ".$fechal." "."a las: ".$hora;
	  
	   //es de tipo 1 porque va asociado al módulo de archivo 
	  $tipolog=1;

      $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

      $insertarlog->execute();
	  
	  $registrar = $this->db->prepare("INSERT INTO inventario (idtipoinventario,consecutivo_acta,fecha_acta,idjuzgado,responsable,enero,febrero,marzo,abril,
mayo,junio,julio,agosto,septiembre,octubre,noviembre,diciembre,ano_archivar,desde_caja,hasta_caja,desde_expediente,
hasta_expediente,cantidad_expedientes,cantidad_cajas,nombre_entrega,nombre_recibe,iddestinojuzgado)
values('$idtipoinventario','$consecutivo_acta','$fecha_acta','$idjuzgado','$responsable','$enero','$febrero','$marzo',
'$abril','$mayo','$junio','$julio','$agosto','$septiembre','$octubre','$noviembre','$diciembre','$ano','$desde_caja',
'$hasta_caja','$desde_expediente','$hasta_expediente','$cantidad_expedientes','$cantidad_cajas','$nombre_entrega','$nombre_recibe','$iddestinojuzgado')");

	  $registrar->execute(); 
	  $resultado = $registrar->rowCount();

	  
      if ($resultado)

      {			

       print'<script languaje="Javascript">location.href="index.php?controller=archivo&action=mensajes&nombre=4"</script>';

      }

	  
	  

  }
  
  
  /***********************************************************************************/

  /*------------------------- Modificar Inventario Saliente ----------------------------*/

  /***********************************************************************************/

  public function updateInventarioSaliente()

  {

	 
	  	  
	  $id = $_POST['id'];
	  
	  $fecha_entrega = $_POST['fecha_entrega'];

	  $nombre_entrega_acta = $_POST['nombre_entrega_acta'];
	  
	  $nombre_recibe_acta = $_POST['nombre_recibe_acta'];
	  
	  $observaciones = $_POST['observaciones'];
	  
	  
	  
	 
	  date_default_timezone_set('America/Bogota'); 

      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fechal=$horaa[0];
      
	  $hora=$horaa[1]; 
	  
	  $accion='Modific&oacute; Acta Entrega';
	  $idres = $_SESSION['idUsuario'];

      $detalle=$_SESSION['nombre']." "."Modifico acta de entrega ".$fechal." "."a las: ".$hora;
	  
	   //es de tipo 1 porque va asociado al módulo de archivo 
	  $tipolog=1;

      $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

      $insertarlog->execute();
	  
	  $registrar = $this->db->prepare("UPDATE inventario SET fecha_entrega='$fecha_entrega',nombre_entrega_acta='$nombre_entrega_acta',nombre_recibe_acta='$nombre_recibe_acta',observaciones='$observaciones' WHERE id='$id'");

	  $registrar->execute(); 
	  $resultado = $registrar->rowCount();

	  
      if ($resultado)

      {			

       print'<script languaje="Javascript">location.href="index.php?controller=archivo&action=mensajes&nombre=5"</script>';

      }

	  
	  

  }

  
  
  
  
  
  
  
  /***********************************************************************************/

  /*------------------------------  Listar Actas Recibidas  --------------------*/

  /***********************************************************************************/

  public function listarRecibidos()

  {

  

  $listar = $this->db->prepare("select inventario.id,inventario.consecutivo_acta,inventario.fecha_acta,pa_juzgado.nombre,inventario.responsable,inventario.enero,
inventario.febrero,inventario.marzo,inventario.abril,inventario.mayo,inventario.junio,inventario.julio,inventario.agosto,
inventario.septiembre,inventario.octubre,inventario.noviembre,inventario.diciembre, inventario.ano_archivar, inventario.cantidad_expedientes, inventario.cantidad_cajas,inventario.nombre_entrega,inventario.nombre_recibe, inventario.idestado_acta
from inventario 
inner join pa_juzgado ON (inventario.idjuzgado=pa_juzgado.id)
Where inventario.idtipoinventario=1");

  $listar->execute();

  return $listar;

  

  }
/***********************************************************************************/

  /*------------------------------  Listar Actas Entregadas  --------------------*/

  /***********************************************************************************/

  public function listarEntregados()

  {

  
  $listar = $this->db->prepare("select inventario.id,inventario.consecutivo_acta_entrega,inventario.fecha_entrega,juz.nombre,inventario.responsable,inventario.enero,
inventario.febrero,inventario.marzo,inventario.abril,inventario.mayo,inventario.junio,inventario.julio,inventario.agosto,
inventario.septiembre,inventario.octubre,inventario.noviembre,inventario.diciembre, inventario.ano_archivar, inventario.cantidad_expedientes, inventario.cantidad_cajas,inventario.nombre_entrega,inventario.nombre_recibe, inventario.nombre_recibe_acta, inventario.nombre_entrega_acta
from inventario 
inner join pa_juzgado juz ON (inventario.idjuzgado=juz.id)
Where inventario.idestado_acta=2");

  $listar->execute();

  return $listar;

  

  }


/***********************************************************************************/

  /*------------------------- Listar  Acta Entrante Especifica ---------------------*/

  /***********************************************************************************/	

 public function listarInventarioEspecifico()

	{

		 $id=$_GET['nombre'];

		$consulta = $this->db->prepare("select  inventario.consecutivo_acta,inventario.fecha_acta,inventario.idjuzgado,inventario.id,pa_juzgado.nombre,inventario.responsable,inventario.enero,
inventario.febrero,inventario.marzo,inventario.abril,inventario.mayo,inventario.junio,inventario.julio,inventario.agosto,
inventario.septiembre,inventario.octubre,inventario.noviembre,inventario.diciembre, inventario.ano_archivar, 
inventario.desde_caja,inventario.hasta_caja,inventario.desde_expediente,inventario.hasta_expediente,
inventario.cantidad_expedientes, inventario.cantidad_cajas,inventario.nombre_entrega,inventario.nombre_recibe, inventario.observaciones,inventario.cantidad_expedientes_prestados,inventario.persona_presto,inventario.observaciones_prestamo,pa_juzgado.idarea,
inventario.fecha_entrega,inventario.nombre_entrega_acta, inventario.nombre_recibe_acta,inventario.consecutivo_acta_entrega
from inventario 
inner join pa_juzgado ON (inventario.idjuzgado=pa_juzgado.id)
Where inventario.id='$id'");

		$consulta->execute();

		return $consulta;

	}  







/***********************************************************************************/

  /*------------------------- Listar  Acta Saliente Especifica ---------------------*/

  /***********************************************************************************/	

 public function listarInventarioEspecificoSaliente()

	{

		 $id=$_GET['nombre'];

		$consulta = $this->db->prepare("select inventario.consecutivo_acta,inventario.fecha_acta,inventario.idjuzgado,inventario.id,juzd.nombre as destino,inventario.iddestinojuzgado,juz.nombre,inventario.idjuzgado,inventario.responsable,inventario.enero,
inventario.febrero,inventario.marzo,inventario.abril,inventario.mayo,inventario.junio,inventario.julio,inventario.agosto,
inventario.septiembre,inventario.octubre,inventario.noviembre,inventario.diciembre, inventario.ano_archivar, 
inventario.desde_caja,inventario.hasta_caja,inventario.desde_expediente,inventario.hasta_expediente,
inventario.cantidad_expedientes, inventario.cantidad_cajas,inventario.nombre_entrega,inventario.nombre_recibe, inventario.consecutivo_acta_entrega,inventario.fecha_entrega,inventario.nombre_entrega_acta,inventario.nombre_recibe_acta
from inventario
inner join pa_juzgado juz ON (inventario.idjuzgado=juz.id)
inner join pa_juzgado juzd ON (inventario.idjuzgado=juzd.id)
Where inventario.id='$id'");

		$consulta->execute();

		return $consulta;

	}  


/***********************************************************************************/

  /*------------------------------  Listar Actas Entrantes Reporte --------------------*/

  /***********************************************************************************/

  public function listarEntrantesReporte()

  {

  $fechai=$_GET['nombre1'];
  $fechaf=$_GET['nombre2'];
  $idjuzgado=$_GET['nombre'];

  $listar = $this->db->prepare("select sum(cantidad_expedientes) as expentrantes, sum(cantidad_cajas) as cajasentrantes from inventario where idjuzgado='$idjuzgado' and idtipoinventario=1 and fecha_acta BETWEEN '$fechai' and '$fechaf'");

  $listar->execute();

  return $listar;

  

  }
 /***********************************************************************************/

  /*------------------------------  Listar Actas Entrantes Reporte --------------------*/

  /***********************************************************************************/

  public function listarEntrantesReporte1()

  {

  $fechai=$_GET['nombre1'];
  $fechaf=$_GET['nombre2'];
  $idjuzgado=$_GET['nombre'];

  $listar = $this->db->prepare("select juz.nombre as juzgado, sum(iv.cantidad_cajas) as cajasentrantes,sum(iv.cantidad_expedientes) as expedientesentrantes,sum(iv.cantidad_expedientes_prestados) as prestados  
from inventario iv inner join pa_juzgado juz ON (juz.id=iv.idjuzgado) where iv.fecha_acta BETWEEN '$fechai' and '$fechaf'
and iv.idjuzgado='$idjuzgado'    
group by iv.idjuzgado
order by juzgado");

  $listar->execute();

  return $listar;

  

  } 
  
   /***********************************************************************************/

  /*------------------------------  Listar Actas Salientes Reporte --------------------*/

  /***********************************************************************************/

  public function listarSalientesReporte1()

  {

  $fechai=$_GET['nombre1'];
  $fechaf=$_GET['nombre2'];
  $idjuzgado=$_GET['nombre'];

  $listar = $this->db->prepare("select juz.id,juz.nombre as juzgado, sum(iv.cantidad_cajas) as cajassalientes,sum(iv.cantidad_expedientes) as expedientessalientes,sum(iv.cantidad_expedientes_prestados) as prestados1  
from inventario  iv inner join pa_juzgado juz ON(juz.id=iv.idjuzgado) where iv.idestado_acta=2 and iv.fecha_acta BETWEEN '$fechai' and '$fechaf'    
and iv.idjuzgado='$idjuzgado'
group by iv.idjuzgado
order by juzgado");

  $listar->execute();

  return $listar;

  

  } 
  
   /***********************************************************************************/

  /*------------------------------  Listar Actas Entrantes Reporte TODOS--------------------*/

  /***********************************************************************************/

  public function listarEntrantesReporteTODOS1()

  {

  $fechai=$_GET['nombre1'];
  $fechaf=$_GET['nombre2'];

  $listar = $this->db->prepare("select juz.id as idjuz,juz.nombre as juzgado, sum(iv.cantidad_cajas) as cajase,sum(iv.cantidad_expedientes) as expee,sum(iv.cantidad_expedientes_prestados) as prestados  
from inventario iv inner join pa_juzgado juz ON (juz.id=iv.idjuzgado) 
inner join pa_area ar ON (ar.id=juz.idarea)
where iv.fecha_entrega BETWEEN '$fechai' and '$fechaf'
group by iv.idjuzgado
order by ar.nombre,juz.nombre");

  $listar->execute();

  return $listar;

  

  } 
  
   /***********************************************************************************/

  /*------------------------------  Listar Actas Salientes Reporte TODOS --------------------*/

  /***********************************************************************************/

  public function listarSalientesReporteTODOS1()

  {

  $fechai=$_GET['nombre1'];
  $fechaf=$_GET['nombre2'];

  $listar = $this->db->prepare("select juz.id as idjuz,juz.nombre as juzgado, sum(iv.cantidad_cajas) as cajassalientes,sum(iv.cantidad_expedientes) as expedientessalientes,sum(iv.cantidad_expedientes_prestados) as prestados1  
from inventario  iv inner join pa_juzgado juz ON(juz.id=iv.idjuzgado) 
inner join pa_area ar ON (ar.id=juz.idarea)
where iv.idestado_acta=2 and iv.fecha_entrega BETWEEN '$fechai' and '$fechaf'    
group by iv.idjuzgado
order by ar.nombre,juz.nombre");

  $listar->execute();

  return $listar;

  

  } 
  
  
  
  /***********************************************************************************/

  /*------------------------------  Listar Dias no habiles --------------------*/

  /***********************************************************************************/

  public function listardias_nohabiles()

  {

 
  $listar = $this->db->prepare("select * from dias_no_habiles");

  $listar->execute();
  
  $cont = $listar->rowcount();
  $cont = $cont-1;
  $i=0;
  $cadena ='';
  
  while ($field = $listar->fetch())
  {
   
   if($cont == $i)
   {
    $cadena = $cadena.$field[fecha];
   }
   else
   {
    $cadena = $cadena.$field[fecha].",";
   }
   
   $i++;
  }


  return $cadena;

  

  }
  
  /***********************************************************************************/

  /*------------------------------  Listar Actas Entrantes Reporte Todos --------------------*/

  /***********************************************************************************/

  public function listarEntrantesReporteTodos()

  {

  $fechai=$_GET['nombre1'];
  $fechaf=$_GET['nombre2'];
  $idjuzgado=$_GET['nombre'];

  $listar = $this->db->prepare("select sum(cantidad_expedientes) as expentrantes, sum(cantidad_cajas) as cajasentrantes from inventario where idjuzgado='$idjuzgado' and idtipoinventario=1 and fecha_acta BETWEEN '$fechai' and '$fechaf'");

  $listar->execute();

  return $listar;

  

  }
  
  
  

/***********************************************************************************/

  /*------------------------------  Listar Actas Salientes Reporte --------------------*/

  /***********************************************************************************/

  public function listarSalientesReporte()

  {

  $fechai=$_GET['nombre1'];
  $fechaf=$_GET['nombre2'];
  $idjuzgado=$_GET['nombre'];

  $listar = $this->db->prepare("select sum(cantidad_expedientes) as expsalientes, sum(cantidad_cajas) as cajassalientes from inventario where idjuzgado='$idjuzgado' and idtipoinventario=2 and fecha_acta BETWEEN '$fechai' and '$fechaf'");

  $listar->execute();

  return $listar;

  

  }
  
  /***********************************************************************************/

  /*------------------------------  Nombre Juzgado --------------------*/

  /***********************************************************************************/

  public function nombreJuzgado()

  {

 
  $idjuzgado=$_GET['nombre'];

  $listar = $this->db->prepare("select nombre from pa_juzgado where id='$idjuzgado'");

  $listar->execute();

  return $listar;

  

  }
  
 
   /***********************************************************************************/

  /*------------------------------  Consultar Consecutivo Recibido --------------------*/

  /***********************************************************************************/

  public function listarConsecutivo()

  {

 
   $listar = $this->db->prepare("select * from consecutivo where tipo='Recibido'");

  $listar->execute();
   
  return $listar;
  
  

  

  } 

   /***********************************************************************************/

  /*------------------------------  Consultar Consecutivo Entrega --------------------*/

  /***********************************************************************************/

  public function listarConsecutivo_entrega()

  {

 
  $id=$_GET['nombre'];
  $consec = ""; 
   
  $listar_acta = $this->db->prepare("SELECT inv.idjuzgado,ar.id AS idarea,ar.nombre AS areanombre
FROM inventario inv
INNER JOIN pa_juzgado juz ON(inv.idjuzgado=juz.id)
INNER JOIN pa_area ar ON (ar.id=juz.idarea)
WHERE inv.id='$id'");

  $listar_acta->execute();
  
  while ($row = $listar_acta->fetch())
  {
  	 $idjuzgado = $row[idjuzgado];
	 $idarea = $row[idarea];
	 $areanombre = $row[areanombre];
	
  }
   date_default_timezone_set('America/Bogota'); 
    $ano=date('y');
 
  $listar_consecutivo = $this->db->prepare("select * from consecutivo where tipo='Entrega'");
  $listar_consecutivo->execute();
  
 while ($row1 = $listar_consecutivo->fetch())
  {
  	$familia = $row1[consecutivo_familia];
	$civil = $row1[consecutivo_civil];
	$municipal = $row1[consecutivo_municipal];
	
  }
  
  if($familia < 10)
  {
   $f = "00".$familia;
  }
  else if ($familia < 100)
  {
   $f = "0".$familia;
  }
  else if ($familia >= 100)
  {
   $f = $familia;
  }
  
  if($civil < 10)
  {
    $c = "00".$civil;
  }
  else if ($civil < 100)
  {
   $c = "0".$civil;
  }
  else if ($civil >= 100)
  {
   $c = $civil;
  }  
  if($municipal < 10)
  {
    $m = "00".$municipal;
  }
  else if ($municipal < 100)
  {
   $m = "0".$municipal;
  }
  else if ($municipal >= 100)
  {
   $m = $municipal;
  } 
    
   
  if($idarea==1)
  {
   $consec = "AEC".$ano."-".$c;
  }
  if($idarea==2)
  {
   $consec = "AEF".$ano."-".$f;
  } 
  if($idarea==3)
  {
   $consec = "AEM".$ano."-".$m;
  } 
   
 // echo $consec;
   
   
  return $consec;
  
  

  

  }
  
  /***********************************************************************************/

  /*------------------------- Entregar Inventario Entrante ----------------------------*/

  /***********************************************************************************/

  public function entregarInventarioEntrante()

  {

	 
	  $fecha_entrega = $_POST['fecha_entrega'];
	  
	  $consecutivo_entrega = $_POST['consecutivo_entrega'];

	  $nombre_entrega_acta = $_POST['nombre_entrega_acta'];
	  
	  $nombre_recibe_acta = $_POST['nombre_recibe_acta'];
	  
	  $observaciones = $_POST['observaciones'];
	  
	  $id= $_GET['nombre'];
	 
	  date_default_timezone_set('America/Bogota'); 

      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fechal=$horaa[0];
      
	  $hora=$horaa[1]; 
	  
	  $accion='Entreg&oacute; Acta Recibida';
	  $idres = $_SESSION['idUsuario'];

      $detalle=$_SESSION['nombre']." "."Entreg&oacute; Acta Recibida ".$fechal." "."a las: ".$hora;
	  
	   //es de tipo 1 porque va asociado al módulo de archivo 
	  $tipolog=1;

      $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

      $insertarlog->execute();
	  
	  $registrar = $this->db->prepare("UPDATE inventario SET fecha_entrega='$fecha_entrega',consecutivo_acta_entrega='$consecutivo_entrega',nombre_entrega_acta='$nombre_entrega_acta',nombre_recibe_acta='$nombre_recibe_acta',observaciones='$observaciones', idestado_acta='2' where id='$id' ");
	  $registrar->execute(); 
	  $resultado = $registrar->rowCount();

	  $tipo_consecutivo = $_POST['tipo_consecutivo'];
	  
	  if($tipo_consecutivo=='C')
	  {
	    $actualizar = $this->db->prepare("UPDATE consecutivo set consecutivo_civil=consecutivo_civil+1 where tipo='Entrega'");
        $actualizar->execute(); 
		
	  }
	  
	  if($tipo_consecutivo=='F')
	  {
	    $actualizar = $this->db->prepare("UPDATE consecutivo set consecutivo_familia=consecutivo_familia+1 where tipo='Entrega'");
        $actualizar->execute(); 
		
	  }
	  
	  if($tipo_consecutivo=='M')
	  {
	    $actualizar = $this->db->prepare("UPDATE consecutivo set consecutivo_municipal=consecutivo_municipal+1 where tipo='Entrega'");
        $actualizar->execute(); 
		
	  }	
	  
      if ($resultado)

      {			

       print'<script languaje="Javascript">location.href="index.php?controller=archivo&action=mensajes&nombre=8 "</script>';

      }

	  
	  

  } 
  
 	/***********************************************************************************/
  	/*------------------------- Entregar Inventario Entrante ----------------------------*/
  	/***********************************************************************************/
  	public function generarActarecibido(){
  	
		//echo $_GET['nombre'];
		//echo $_GET['nombre1'];
		require 'models/wordModel2.php';
  	}
  	public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
    	$listar     = $this->db->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
        $listar->execute();
        return $listar;
    }
 

}

?>