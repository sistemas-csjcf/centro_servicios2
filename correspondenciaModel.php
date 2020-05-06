<?php
class correspondenciaModel extends modelBase
{
   /***********************************************************************************/
    /*----------------------------- Mensajes ---------------------------------------*/
    /***********************************************************************************/

      public function mensajes()
  {
      $condicion=$_GET['nombre'];
	  if($condicion==1)
	  {
	    $_SESSION['elemento'] = "La correspondencia ha sido registrada correctamente";
	    $_SESSION['elem_conscontrato'] = true;
	     if($_SESSION['id']!="")
		 {
	      print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_correspondencia"</script>';
	     }
	   }
	 if($condicion==2)
	  {
	    $_SESSION['elemento'] = "El registro ha sido actualizado correctamente";
	    $_SESSION['elem_conscontrato'] = true;
	   if($_SESSION['id']!="")
	   {
	    print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_correspondencia"</script>';
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
	    $_SESSION['elemento'] = "La correspondencia no se registro, No Oficio/Telegrama
		ya existe para el juzgado";
	    $_SESSION['elem_conscontrato'] = true;
	     if($_SESSION['id']!="")
		 {
	      print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_correspondencia"</script>';
	     }
	   }
  }

  /***********************************************************************************/
  /*------------------------------ Listar Log ---------------------------------------*/
  /***********************************************************************************/

  public function listarLogCorrespondencia()
  {
	  $listar = $this->db->prepare("SELECT logusuario.fecha,logusuario.accion,logusuario.detalle,usuario.empleado,usuario.foto
FROM LOG AS logusuario
INNER JOIN pa_usuario AS usuario ON (logusuario.idusuario=usuario.id)
WHERE logusuario.idtipolog=2
ORDER BY logusuario.id DESC
LIMIT 15");
	  $listar->execute();
	  return $listar;
  }
  /***********************************************************************************/
  /*------------------------------ Listar Ciudades ---------------------------------------*/
  /***********************************************************************************/

  public function listarCiudadDepartamento()
  {
      $iddepartamento= $_GET['depto'];
	  $listar = $this->db->prepare("SELECT * from pa_ciudad where iddepartamento='iddepartamento'");
	  $listar->execute();
	  return $listar;
  }
   /***********************************************************************************/
  /*------------------------------ Listar Ciudades ---------------------------------------*/
  /***********************************************************************************/

  public function listarCiudad()
  {
	  $listar = $this->db->prepare("SELECT * from pa_municipio order by nombre");
	  $listar->execute();
	  return $listar;
  }

  /***********************************************************************************/
  /*------------------------------ Listar Departamentos  ---------------------------------------*/
  /***********************************************************************************/
  public function listarDepartamentos()
  {
	  $listar = $this->db->prepare("SELECT * from pa_departamento order by nombre");
	  $listar->execute();
	  return $listar;
  }
  /***********************************************************************************/
  /*----------------------- Listar Medios Notificaci�n  ----------------------s---------*/
  /***********************************************************************************/

  public function listarMedio()
  {
	  $listar = $this->db->prepare("SELECT * from pa_medionotificacion order by nombre");
	  $listar->execute();
	  return $listar;
  }

    /***********************************************************************************/
  /*----------------------- Listar Actuaci�n  ----------------------s---------*/
  /***********************************************************************************/

  public function listarActuacion()
  {
	  $listar = $this->db->prepare("SELECT * from pa_actuacion order by nombre");
	  $listar->execute();
	  return $listar;
  }

/***********************************************************************************/
  /*----------------------- Registrar Correspondencia Otro-------------------------------*/
  /***********************************************************************************/
  public function registrarCorrespondenciaOtro()
  {
  $i= 1;
  $dir="views/evidencias/";
  $numero2 = count($_POST);
  $tags2 = array_keys($_POST); // obtiene los nombres de las varibles
  $valores2 = array_values($_POST);// obtiene los valores de las varibles
  // crea las variables y les asigna el valor
	for($i=0;$i<$numero2;$i++){
	$$tags2[$i]=$valores2[$i];
	}
	$j=0;
	while ($j < $numero2)
    {
     $tags2[$j]. " ";
     $j = $j+1;
     }
     // JUAN ESTEBAN MUNERA BETANCUR
     // MANIZALES 2018-01-22
     $id_usuario 				= $_SESSION['idUsuario'];
//$radicado  		   	   			= $radicado;
$idjuzgado 		   	   			= $juzgado;
//$oficio_telegrama  	   			= $oficio_telegrama ;
//$destinatario      	  			= $destinatario ;
//$direccion 		   	   			= $direccion;
$idmunicipio	       			= $estados;
$idmedionotificacion   			= $medio_notificacion;
$notificado		   	   			= "Si";
//$fecha  		   	   			= $fecha;
$cantidad_evidencias   			= $cantidad1;
//$esOficio_Telegrama			    = $esOficio_Telegrama;

 /*if ($notificado =='Si')
 {
  $notificado ='Si';
 }
 else
 {
  $notificado ='No';
 }*/

 $registrar = $this->db->prepare("INSERT INTO correspondencia_otros (id_usuario,radicado,idjuzgado,esOficio_Telegrama,oficio_telegrama,destinatario,direccion,idmunicipio,idmedionotificacion,notificado,fecha)
values ('$id_usuario','$radicado','$idjuzgado','$esOficio_Telegrama','$oficio_telegrama','$destinatario', '$direccion', '$idmunicipio', '$idmedionotificacion', '$notificado', '$fecha')");

	  $registrar->execute();
      $resultado = $registrar->rowCount();

$consultar = $this->db->prepare("SELECT MAX(id) as id FROM correspondencia_otros");
$consultar->execute();

	while($field = $consultar->fetch())
        {
		  $id=$field['id'];
         }
$i=1;
/*
if ((($idmedionotificacion==3)|| ($idmedionotificacion==5)||($idmedionotificacion==6)) && ($notificado=="Si"))
{
	$dir="views/evidencias/";
	$nombre = "evidencia_".$radicado;
	$ext = explode(".",$_FILES['evidencia']['name']);
	$ext = $ext[1];
	$archivo_evidencia= $dir.$nombre.".".$ext;
   if(move_uploaded_file($_FILES['evidencia']['tmp_name'], $archivo_evidencia))
    {
 	  $registrar1 = $this->db->prepare("INSERT INTO evidencia_otros (idcorrespondenciaotros,evidenciaotros) values ('$id','$archivo_evidencia')");
	  $registrar1->execute();

    }
    else
    {
    echo "no";
    }


   while ($i<=$cantidad_evidencias)
   {
	   $nombre = "evidencia_".$radicado."_".$i;
	   $ext = explode(".",$_FILES['evidencia'.$i]['name']);
	   $ext = $ext[1];
	   $archivo_evidencia= $dir.$nombre.".".$ext;
	   if(move_uploaded_file($_FILES['evidencia'.$i]['tmp_name'], $archivo_evidencia))
   		{
		  $registrar1 = $this->db->prepare("INSERT INTO evidencia_otros (idcorrespondenciaotros,evidenciaotros) values ('$id','$archivo_evidencia')");
		  $registrar1->execute();

   		}
	   else
   		{

   		}
   		$i= $i+1;
  }
}
else
{

}
 */
      date_default_timezone_set('America/Bogota');
      $fechaa=date('Y-m-d g:ia');
      $horaa=explode(' ',$fechaa);
      $fechal=$horaa[0];
	  $hora=$horaa[1];
	  $accion='Resgistr&oacute; Documento';
	  $idres = $_SESSION['idUsuario'];
      $detalle=$_SESSION['nombre']." "."Registro un nuevo Documento ".$fechal." "."a las: ".$hora;
	   //es de tipo 1 porque va asociado al m�dulo de archivo
	  $tipolog=2;
      $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");
      $insertarlog->execute();
 $resultado = $registrar->rowCount();
 if( $resultado)
 {
   print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=1"</script>';
  }
  else
  {
   print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=8"</script>';
  }
 }
/***********************************************************************************/
  /*----------------------- Registrar Correspondencia -------------------------------*/
  /***********************************************************************************/
  public function registrarCorrespondencia()
  {
  $i= 1;
  $dir="views/evidencias/";
  $numero2 = count($_POST);
  $tags2 = array_keys($_POST); // obtiene los nombres de las varibles
  $valores2 = array_values($_POST);// obtiene los valores de las varibles
  // crea las variables y les asigna el valor
	for($i=0;$i<$numero2;$i++){
	$$tags2[$i]=$valores2[$i];
	}
	$j=0;
	while ($j < $numero2)
    {
     $tags2[$j]. " ";
     $j = $j+1;
     }
//$radicado  		   	   			= $radicado;
$idjuzgado 		   	   			= $juzgado;
//$oficio_telegrama  	   			= $oficio_telegrama ;
//$destinatario      	  			= $destinatario ;
//$direccion 		   	   			= $direccion;
$idmunicipio	       			= $estados;
$idmedionotificacion   			= $medio_notificacion;
//$notificado		   	   			= $notificado;
//$fecha  		   	   			= $fecha;
$idclaseproceso	   	   			= $clase_proceso;
$idactuacion	   	   			= $actuacion;
//$accionante   		   			= $accionante;
$cantidad_evidencias   			= $cantidad1;
$cantidad_accionado_vinculado   = $cantidad;

 if ($notificado ==1)
 {
  $notificado ='S';
 }
 else
 {
  $notificado ='N';
 }
 $registrar = $this->db->prepare("INSERT INTO correspondencia (radicado,idjuzgado,oficio_telegrama,destinatario,direccion,idmunicipio,idmedionotificacion,notificado,fecha,
idclaseproceso,idactuacion,accionante)
values ('$radicado','$idjuzgado','$oficio_telegrama','$destinatario', '$direccion', '$idmunicipio', '$idmedionotificacion', '$notificado', '$fecha', '$idclaseproceso', '$idactuacion', '$accionante')");
	  $registrar->execute();
      $resultado = $registrar->rowCount();
$consultar = $this->db->prepare("SELECT MAX(id) as id FROM correspondencia");
$consultar->execute();
	while($field = $consultar->fetch())
        {
		  $id=$field['id'];
         }
$i=1;

if ((($idmedionotificacion==3)|| ($idmedionotificacion==5)) && ($notificado==1))
{
	$dir="views/evidencias/";
	$nombre = "evidencia_".$radicado;
	$ext = explode(".",$_FILES['evidencia']['name']);
	$ext = $ext[1];
	$archivo_evidencia= $dir.$nombre.".".$ext;
   if(move_uploaded_file($_FILES['evidencia']['tmp_name'], $archivo_evidencia))
    {
 	  $registrar1 = $this->db->prepare("INSERT INTO evidencia (idcorrespondencia,evidencia) values ('$id','$archivo_evidencia')");
	  $registrar1->execute();
    }
    else
    {
    }
   while ($i<=$cantidad_evidencias)
   {
	   $nombre = "evidencia_".$radicado."_".$i;
	   $ext = explode(".",$_FILES['evidencia'.$i]['name']);
	   $ext = $ext[1];
	   $archivo_evidencia= $dir.$nombre.".".$ext;
	   if(move_uploaded_file($_FILES['evidencia'.$i]['tmp_name'], $archivo_evidencia))
   		{
		  $registrar1 = $this->db->prepare("INSERT INTO evidencia (idcorrespondencia,evidencia) values ('$id','$archivo_evidencia')");
		  $registrar1->execute();
   		}
	   else
   		{
   		}
   		$i= $i+1;

  }
}

if($idclaseproceso!=3)
{
 $j=1;
 if($esAccionado==1) {  $esAccionado='S'; }
 else  {  $esAccionado='N'; }

 $registrar2 = $this->db->prepare("INSERT INTO accionado_vinculado (idcorrespondencia,accionado_vinculado,esaccionado) values ('$id','$accionado','$esAccionado')");
 $registrar2->execute();



 while ($j<=$cantidad_accionado_vinculado)
  	{
      if($_POST['accionado'.$j]!="")
	  {
 		$accionado   = $_POST['accionado'.$j];
		$esAccionado = $_POST['esAccionado'.$j];
		 if($esAccionado==1) {  $esAccionado='S'; }
 else  {  $esAccionado='N'; }


		$registrar3 = $this->db->prepare("INSERT INTO accionado_vinculado (idcorrespondencia,accionado_vinculado,esaccionado) values 			('$id','$accionado','$esAccionado')");
		$registrar3->execute();
	  }
	  $j = $j+1;
    }


   print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=1"</script>';





  }
 }



/***********************************************************************************/
  /*----------------------- Registrar Correspondencia Tutela -------------------------------*/
  /***********************************************************************************/
  public function registrarCorrespondenciaTutela()
  {
  $dir="views/evidencias/";
  	// JUAN ESTEBAN MUNERA BETANCUR
  	// MANIZALES CALDAS 2018-01-22
$id_usuario                     = $_SESSION['idUsuario'];
$radicado  		   	   			      = $_POST['radicado'];
$idjuzgado 		   	   			      = $_POST['juzgado'];
$fecha  		   	   			        = $_POST['fecha'];
$cantidad_evidencias   			    = $_POST['cantidad_evidencias'];
$cantidad_accionado_vinculado   = $_POST['cantidad_detalles'];
$proceso					              = $_POST['proceso'];
$accionante						          = $_POST['accionante'];
$cantidad_accionados			      = $_POST['cantidad_accionados'];
$cantidad_vinculados		      	= $_POST['cantidad_vinculados'];
$tiene_accionado				        = $_POST['tiene_accionado'];
$tiene_vinculado				        = $_POST['tiene_vinculado'];
date_default_timezone_set('America/Bogota');
$insert_time                    = date("Y-m-d H:i:s");

$registrar = $this->db->prepare("
   INSERT INTO correspondencia_tutelas (id_usuario,radicado,idjuzgado,fecha,Tutela_Incidente, insert_time)
   values ('$id_usuario','$radicado','$idjuzgado','$fecha', '$proceso', '$insert_time')
   ");

$registrar->execute();
$resultado = $registrar->rowCount();
$fechaa=date('Y-m-d g:ia');
$horaa=explode(' ',$fechaa);
$fechal=$horaa[0];
$hora=$horaa[1];
$accion='Resgistr&oacute; Tutela';
$idres = $_SESSION['idUsuario'];
$detalle=$_SESSION['nombre']." "."Registro una nueva Tutela ".$fechal." "."a las: ".$hora;

//es de tipo 1 porque va asociado al m�dulo de archivo
$tipolog=2;

$insertarlog = $this->db->prepare("
INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog)
VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');
");

$insertarlog->execute();

$consultar = $this->db->prepare("
SELECT id
FROM correspondencia_tutelas
WHERE radicado LIKE '$radicado'
AND id_usuario = '$id_usuario'
AND idjuzgado = '$idjuzgado'
AND insert_time = '$insert_time'
");
$consultar->execute();
	while($field = $consultar->fetch())
        {
		  $id=$field['id'];
         }
$i=$j=1;
$insert_time = date("Y-m-d H:i:s");
$registrar_accionante = $this->db->prepare("
INSERT INTO accionante_accionado_vinculado (idcorrespondencia_tutelas, accionante_accionado_vinculado, esaccionante_accionado_vinculado, insert_time)
values ('$id','$accionante','Accionante', '$insert_time')
");
 $registrar_accionante->execute();
 $consultar_accionante = $this->db->prepare("
 SELECT id FROM accionante_accionado_vinculado
 WHERE idcorrespondencia_tutelas = '$id'
 AND accionante_accionado_vinculado = '$accionante'
 AND insert_time LIKE '$insert_time'
 ");
 $consultar_accionante->execute();
	while($field = $consultar_accionante->fetch())
        {
		  $id_accionante=$field['id'];
         }
$i_accionados = 0;
$i_accionados1 = 1;
 if ($tiene_accionado=='on')
 {
 $vector_accionados[$i_accionados][nombre] = $_POST['accionado'];
 $i_accionados = $i_accionados+1;
 if ($cantidad_accionados>0)
 {
  while($i_accionados<=$cantidad_accionados){
  if($_POST['accionado'.$i_accionados])
   {
	$vector_accionados[$i_accionados1][nombre] = $_POST['accionado'.$i_accionados];
	$i_accionados1 = $i_accionados1+1;
   }
   $i_accionados = $i_accionados+1;
  }
 }
	$ins = 0;
	//print_r($vector_accionados);
	$cant_insert_accionados = count($vector_accionados);
	while($ins < $cant_insert_accionados)
	{
	  $accionado_temp = $vector_accionados[$ins][nombre];
    $insert_time = date("Y-m-d H:i:s");
		$registrar_accionados = $this->db->prepare("
    INSERT INTO accionante_accionado_vinculado (idcorrespondencia_tutelas, accionante_accionado_vinculado, esaccionante_accionado_vinculado, insert_time)
    values ('$id', '$accionado_temp', 'Accionado', '$insert_time')
    ");
		 $registrar_accionados->execute();
		 $consultar = $this->db->prepare("
     SELECT id FROM accionante_accionado_vinculado
     WHERE idcorrespondencia_tutelas = '$id'
     AND accionante_accionado_vinculado = '$accionado_temp'
     AND insert_time LIKE '$insert_time'
     ");
$consultar->execute();
	while($field = $consultar->fetch())
        {
		  $id_accionado=$field['id'];
         }
		 $vector_accionados[$ins][idbd]=$id_accionado;
		 $ins = $ins+1;
	}
//print_r($vector_accionados);
 }
 else
 {
 //echo "no tiene accionado";
 }
$i_vinculados = 0;
$i_vinculados1 = 1;

 if ($tiene_vinculado=='on')
 {
 $vector_vinculados[$i_vinculados][nombre] = $_POST['vinculado'];
 $i_vinculados = $i_vinculados+1;
 if ($cantidad_vinculados>0)
 {
  while($i_vinculados<=$cantidad_vinculados){
  if($_POST['vinculado'.$i_vinculados])
   {
	$vector_vinculados[$i_vinculados1][nombre] = $_POST['vinculado'.$i_vinculados];
	$i_vinculados1 = $i_vinculados1+1;
   }
   $i_vinculados = $i_vinculados+1;
  }
 }
$insv = 0;
//print_r($vector_vinculados);
$cant_insert_vinculados = count($vector_vinculados);
	while($insv < $cant_insert_vinculados)
	{
	  $vinculado_temp = $vector_vinculados[$insv][nombre];
    $insert_time = date("Y-m-d H:i:s");
		$registrar_vinculados = $this->db->prepare("
    INSERT INTO accionante_accionado_vinculado (idcorrespondencia_tutelas, accionante_accionado_vinculado, esaccionante_accionado_vinculado, insert_time)
    values ('$id','$vinculado_temp','Vinculado', '$insert_time')
    ");
		 $registrar_vinculados->execute();
		 $consultar = $this->db->prepare("
     SELECT id FROM accionante_accionado_vinculado
     WHERE idcorrespondencia_tutelas = '$id'
     AND accionante_accionado_vinculado = '$vinculado_temp'
     AND insert_time LIKE '$insert_time'
     ");
		 $consultar->execute();
	while($field = $consultar->fetch())
        {
		  $id_vinculado=$field['id'];
         }
		 $vector_vinculados[$insv][idbd]=$id_vinculado;
		 $insv = $insv+1;
   }
//print_r($vector_vinculados);
 }
 else
 {
// echo "no tiene vinculados";
 }
 while ($j<=$cantidad_accionado_vinculado)
  	{
      if($_POST['oficio_telegrama_numero'.$j]!="")
	  {
		 $tipo_actuacion					  = $_POST['tipo_actuacion'.$j];
		 $idactuacion						  = $_POST['idactuacion'.$j];
		 $esoficio_telegrama                  = $_POST['esOficio_Telegrama'.$j];
		 $oficio_telegrama			          = $_POST['oficio_telegrama_numero'.$j];
		 $direccion							  = $_POST['direccion'.$j];
		 $idmunicipio						  = $_POST['ciudad'.$j];
		 $idmedionotificacion				  = $_POST['medio'.$j];
		 $fecha_envio						  = $_POST['fecha_envio'.$j];
		 $esaccionante_accionado_vinculado    = $_POST['accionante_accionado_vinculado'.$j];
	     $notificado						  = "Si";
		 if($esaccionante_accionado_vinculado=='Accionante')
		 {
		   $idaccionado_vinculado_accionante_tut = $id_accionante;
		 }
		 if($esaccionante_accionado_vinculado=='Accionado')
		 {
		   $accionado_nombre = $_POST['accionados_sl'.$j];
		   $cont_vect = count($vector_accionados);
		   $jj= 0;
			while($jj<$cont_vect)
			{
			 if($vector_accionados[$jj][nombre]==$accionado_nombre)
			 {
			  $index = $jj;
			  $jj= $cont_vect;
			 }
			 $jj++;
			}
			$idaccionado_vinculado_accionante_tut =   $vector_accionados[$index][idbd];
		 }
		 if($esaccionante_accionado_vinculado=='Vinculado')
		 {
		   $vinculado_nombre = $_POST['vinculados_sl'.$j];
		   $cont_vect_v = count($vector_vinculados);
		   $v= 0;
			while($v<$cont_vect_v)
			{
			 if($vector_vinculados[$v][nombre]== $vinculado_nombre)
			 {
			  $index_v = $v;
			  $v= $cont_vect_v;
			 }
			 $v++;
			}
			$idaccionado_vinculado_accionante_tut =   $vector_vinculados[$index_v][idbd];
		 }
		  if($esaccionante_accionado_vinculado=='Otro')
		 {
		  $otro_texto = $_POST['texto_otro'.$j];
      $insert_time = date("Y-m-d H:i:s");
		  $registrar_otro = $this->db->prepare("
      INSERT INTO accionante_accionado_vinculado (idcorrespondencia_tutelas, accionante_accionado_vinculado, esaccionante_accionado_vinculado, insert_time)
      values ('$id', '$otro_texto', 'Otro', '$insert_time')
      ");
		 $registrar_otro->execute();
		 $consultar_otro = $this->db->prepare("
     SELECT id FROM accionante_accionado_vinculado
     WHERE idcorrespondencia_tutelas = '$id'
     AND accionante_accionado_vinculado = '$otro_texto'
     AND insert_time LIKE '$insert_time'
     ");
		 $consultar_otro->execute();
		while($field = $consultar_otro->fetch())
       	 {
		  $id_otro=$field['id'];
         }
		   $idaccionado_vinculado_accionante_tut = $id_otro;
		 }
    $insert_time = date("Y-m-d H:i:s");

    // Evitar regitros duplicados en actuaciones
    $status = true;
    $validarDup = $this->db->prepare("
    SELECT * FROM actuacion_tutela ORDER BY id DESC LIMIT 1;
    ");
		$validarDup->execute();
    while($fieldDup = $validarDup->fetch()) {
		  if ($id_usuario == $fieldDup['id_usuario'] && $idaccionado_vinculado_accionante_tut == $fieldDup['idaccionado_vinculado_accionante_tut'] && $direccion == $fieldDup['direccion'] && $insert_time == $fieldDup['insert_time']){
        $status = false;
      }
    }
    // Fin registros duplicados
      if ($status){
  		    $registrar4 = $this->db->prepare("
            INSERT INTO actuacion_tutela (id_usuario,idaccionado_vinculado_accionante_tut,esoficio_telegrama,oficio_telegrama,direccion,idmunicipio,idmedionotificacion,notificado,fecha_envio,idactuacion,tipo_actuacion,insert_time)
            values ('$id_usuario','$idaccionado_vinculado_accionante_tut','$esoficio_telegrama','$oficio_telegrama','$direccion','$idmunicipio','$idmedionotificacion','$notificado','$fecha_envio','$idactuacion','$tipo_actuacion','$insert_time')
          ");
  		    $registrar4->execute();
      }
	  }
	  $j = $j+1;
    }
  print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=1"</script>';
  }

 /***********************************************************************************/
  /*----------------------- Modificar Correspondencia Tutela -------------------------------*/
  /***********************************************************************************/
  public function modificarCorrespondenciaTutela()
  {
	 date_default_timezone_set('America/Bogota');
      $fechaa=date('Y-m-d g:ia');
      $horaa=explode(' ',$fechaa);
      $fechal=$horaa[0];
	  $hora=$horaa[1];
	  $accion='Modifc&oacute; Tutela';
	  $idres = $_SESSION['idUsuario'];
      $detalle=$_SESSION['nombre']." "."Modifico una Tutela ".$fechal." "."a las: ".$hora;
	   //es de tipo 2 porque va asociado al m�dulo de correspondencia
	  $tipolog=2;
      $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");
      $insertarlog->execute();
		// JUAN ESTEBAN MUNERA BEANCUR 2018-01-22
		$id_usuario = $_SESSION['idUsuario'];
$cantidad_accionado_vinculado   = $_POST['cantidad_detalles'];
$idtutela=$_GET['nombre'];
$i=$j=1;
 while ($j<=$cantidad_accionado_vinculado)
  	{
      if($_POST['parte_id'.$j]=="no_parte")
	  {
		 $esaccionante_accionado_vinculado    = $_POST['accionante_accionado_vinculado'.$j];
	     $accionante_accionado_vinculado      = $_POST['accionante_accionado_vinculado_texto'.$j];
		 $esoficio_telegrama                  = $_POST['esOficio_Telegrama'.$j];
		 $oficio_telegrama			          = $_POST['oficio_telegrama_numero'.$j];
		 $direccion							  = $_POST['direccion'.$j];
     	 $idmunicipio						  = $_POST['ciudad'.$j];
		 $idmedionotificacion				  = $_POST['medio'.$j];
		 $notificado						  = "Si";
		 $fecha_envio						  = $_POST['fecha_envio'.$j];
		 $idactuacion						  = $_POST['idactuacion'.$j];
		 $tipo_actuacion					  = $_POST['tipo_actuacion'.$j];
		$registrar3 = $this->db->prepare("INSERT INTO accionante_accionado_vinculado (idcorrespondencia_tutelas,accionante_accionado_vinculado,esaccionante_accionado_vinculado) values ('$idtutela','$accionante_accionado_vinculado','$esaccionante_accionado_vinculado')");
		$registrar3->execute();
		$consultar3 = $this->db->prepare("SELECT MAX(id) as id FROM accionante_accionado_vinculado");
	    $consultar3->execute();
	while($field = $consultar3->fetch())
        {
		   $idaccionado_vinculado_accionante_tut=$field['id'];
         }
			$registrar4 = $this->db->prepare("INSERT INTO actuacion_tutela (id_usuario,idaccionado_vinculado_accionante_tut,esoficio_telegrama,oficio_telegrama,direccion,idmunicipio,idmedionotificacion,notificado,fecha_envio,idactuacion,tipo_actuacion) values ('$id_usuario','$idaccionado_vinculado_accionante_tut','$esoficio_telegrama','$oficio_telegrama','$direccion','$idmunicipio','$idmedionotificacion','$notificado','$fecha_envio','$idactuacion','$tipo_actuacion')");
		$registrar4->execute();
		 $j = $j+1;
	  }
	  else
	  {
		 $parte_id 							  = $_POST['parte_id'.$j];
		 $esoficio_telegrama                  = $_POST['esOficio_Telegrama'.$j];
		 $oficio_telegrama			          = $_POST['oficio_telegrama_numero'.$j];
		 $direccion							  = $_POST['direccion'.$j];
     	 $idmunicipio						  = $_POST['ciudad'.$j];
		 $idmedionotificacion				  = $_POST['medio'.$j];
		 $notificado						  = "Si";
		 $fecha_envio						  = $_POST['fecha_envio'.$j];
		 $idactuacion						  = $_POST['idactuacion'.$j];
		 $tipo_actuacion					  = $_POST['tipo_actuacion'.$j];
	  $registrar4 = $this->db->prepare("INSERT INTO actuacion_tutela (id_usuario,idaccionado_vinculado_accionante_tut,esoficio_telegrama,oficio_telegrama,direccion,idmunicipio,idmedionotificacion,notificado,fecha_envio,idactuacion,tipo_actuacion) values ('$id_usuario','$parte_id','$esoficio_telegrama','$oficio_telegrama','$direccion','$idmunicipio','$idmedionotificacion','$notificado','$fecha_envio','$idactuacion','$tipo_actuacion')");
		$registrar4->execute();
	  $j = $j+1;
	  }
    }
  print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=2"</script>';
  }
/***********************************************************************************/
  /*--------------- Registrar Correspondencia Incidente -------------------------------*/
  /***********************************************************************************/
  public function registrarCorrespondenciaIncidente()
  {
$radicado                                = $_POST['radicado'];
echo $idjuzgado                          = $_POST['juzgado'];
$fecha                                   = $_POST['fecha'];
$cantidad_accionado_vinculado_formulario = $_POST['contador_partes'];
$cantidad_accionado_vinculado_creados    = $_POST['cantidad_detalles'];
$consultar = $this->db->prepare("SELECT id FROM correspondencia_tutelas where radicado ='$radicado'");
$consultar->execute();
while($field = $consultar->fetch())
        {
		 $idtutela=$field['id'];
        }
  }

/***********************************************************************************/
  /*------------------------------  Listar Todas las Tutelas  --------------------*/
  /***********************************************************************************/
  public function listarCorrespondenciasTutelas()
  {
  $listar = $this->db->prepare("select tutelas.id as idt,tutelas.radicado as radicado,area.nombre as area,juzgado.nombre as juzgado ,tutelas.fecha as fecha, tutelas.idjuzgado as idjuz
from  correspondencia_tutelas tutelas inner join pa_juzgado juzgado on tutelas.idjuzgado=juzgado.id
inner join pa_area area on (area.id=juzgado.idarea)
");
  $listar->execute();
  return $listar;
  }
  /***********************************************************************************/
  public function listarJuzgadoIncidente()
  {
  $idjuz = $_GET['nombre2'];
  $listar = $this->db->prepare("select * from pa_juzgado where id='$idjuz'");
  $listar->execute();
  return $listar;
  }
    /***********************************************************************************/
  public function listarJuzgado()
  {
  $listar = $this->db->prepare("select * from pa_juzgado");
  $listar->execute();
  return $listar;
  }
/***********************************************************************************/
  /*------------------------------  Listar Todas las correspondencias  --------------------*/
  /***********************************************************************************/
  public function listarCorrespondencias()
  {
  $listar = $this->db->prepare("select correspondencia.id as idd,correspondencia.radicado,pa_juzgado.nombre as juzgado,correspondencia.oficio_telegrama as telegrama,
correspondencia.destinatario,correspondencia.direccion,pa_municipio.nombre as municipio,pa_medionotificacion.nombre as medio,
correspondencia.notificado,correspondencia.fecha, pa_claseproceso.nombre as clase, pa_actuacion.nombre as actuacion,
correspondencia.accionante,pa_departamento.nombre as departamento
from correspondencia
inner join pa_juzgado on (correspondencia.idjuzgado = pa_juzgado.id)
inner join pa_municipio on (correspondencia.idmunicipio = pa_municipio.id)
inner join pa_departamento on (pa_municipio.iddepartamento = pa_departamento.id)
inner join pa_claseproceso on (correspondencia.idclaseproceso = pa_claseproceso.id)
left join  pa_actuacion on (correspondencia.idactuacion = pa_actuacion.id)
inner join pa_medionotificacion on (correspondencia.idmedionotificacion = pa_medionotificacion.id)");
  $listar->execute();
  return $listar;
  }
 /***********************************************************************************/
  /*------------------------------  Listar correspondencias otros  --------------------*/
  /***********************************************************************************/
  public function listarCorrespondenciasOtros()
  {
  $listar = $this->db->prepare("select correspondencia.id as corresid,correspondencia.radicado,juzgado.nombre as juzgadonom,correspondencia.esOficio_Telegrama,correspondencia.oficio_telegrama,
correspondencia.destinatario, medio.nombre as medionot,correspondencia.notificado,correspondencia.direccion
from correspondencia_otros as correspondencia
inner join pa_juzgado as juzgado on (juzgado.id=correspondencia.idjuzgado)
inner join pa_medionotificacion as medio on (medio.id=correspondencia.idmedionotificacion)");
  $listar->execute();
  return $listar;
  }
/***********************************************************************************/
  /*-----------------------  Consultar Correspondencia especifica  --------------------*/
  /***********************************************************************************/
  public function listarCorrespondencia()
  {
   $id=$_GET['nombre'];
  $listar = $this->db->prepare("select correspondencia.radicado,pa_juzgado.nombre as juzgado,correspondencia.oficio_telegrama as telegrama,
correspondencia.destinatario,correspondencia.direccion,pa_municipio.nombre as municipio,pa_municipio.id as idmunicipio,
pa_medionotificacion.nombre as medio,pa_medionotificacion.id as idmedio,
correspondencia.notificado,correspondencia.fecha, pa_claseproceso.nombre as clase, pa_actuacion.nombre as actuacion,
correspondencia.accionante,pa_departamento.nombre as departamento,pa_departamento.id as iddepartamento,pa_medionotificacion.id as idmedio, pa_juzgado.id as idjuzgado
from correspondencia
inner join pa_juzgado on (correspondencia.idjuzgado = pa_juzgado.id)
inner join pa_municipio on (correspondencia.idmunicipio = pa_municipio.id)
inner join pa_departamento on (pa_municipio.iddepartamento = pa_departamento.id)
inner join pa_claseproceso on (correspondencia.idclaseproceso = pa_claseproceso.id)
left join pa_actuacion on (correspondencia.idactuacion = pa_actuacion.id)
inner join pa_medionotificacion on (correspondencia.idmedionotificacion = pa_medionotificacion.id)
where correspondencia.id='$id'");
  $listar->execute();
  return $listar;
  }
/***********************************************************************************/
  /*-----------------------  Consultar Correspondencia Otro especifica  --------------------*/
  /***********************************************************************************/
  public function listarCorrespondenciaOtro()
  {
   $id=$_GET['nombre'];
  $listar = $this->db->prepare("select correspondencia_otros.radicado,pa_juzgado.nombre as juzgado,correspondencia_otros.esOficio_Telegrama,correspondencia_otros.oficio_telegrama,
correspondencia_otros.destinatario,correspondencia_otros.direccion,pa_municipio.nombre as municipio, pa_medionotificacion.nombre as medio,
correspondencia_otros.notificado,correspondencia_otros.fecha ,correspondencia_otros.idjuzgado,correspondencia_otros.idmunicipio,correspondencia_otros.idmedionotificacion,pa_departamento.nombre as departamento, pa_departamento.id as iddepa
from correspondencia_otros
inner join pa_juzgado on (correspondencia_otros.idjuzgado=pa_juzgado.id)
inner join pa_municipio on (correspondencia_otros.idmunicipio=pa_municipio.id)
inner join pa_departamento on (pa_municipio.iddepartamento=pa_departamento.id)
inner join pa_medionotificacion on (correspondencia_otros.idmedionotificacion=pa_medionotificacion.id)
where correspondencia_otros.id='$id'");
  $listar->execute();
  return $listar;
  }
/***********************************************************************************/
  /*------------------ Listar ciudades para modificar correspondencia otro  --------------------*/
  /***********************************************************************************/
  public function listarCiudadOtro()
  {
    $id=$_GET['nombre'];
  $listar = $this->db->prepare("select de.id as iddepa from correspondencia_otros co
inner join pa_municipio mu on (mu.id=co.idmunicipio)
inner join pa_departamento de on (de.id=mu.iddepartamento)
where co.id='$id'");
 $listar->execute();
 while($field = $listar->fetch())
        {
		   $ide=$field['iddepa'];
         }
  $listar1 = $this->db->prepare("select * from pa_municipio where iddepartamento='$ide'");
 $listar1->execute();
  return $listar1;
  }
/***********************************************************************************/
  /*-----------------------  Consultar Accionado Vinculado -------------------------*/
  /***********************************************************************************/
  public function listarAccionadosVinculados()
  {
   $id=$_GET['nombre'];
  $listar = $this->db->prepare("select * from accionado_vinculado where idcorrespondencia='$id'");
  $listar->execute();
  return $listar;
  }
  /***********************************************************************************/
  /*-----------------------  Listar �reas Empleados -------------------------*/
  /***********************************************************************************/
  public function listarAreasEmpleados()
  {
  $listar = $this->db->prepare("select * from pa_areaempleado");
  $listar->execute();
  return $listar;
  }
 /***********************************************************************************/
  /*----------------------------  Consultar Evidencias    -------------------------*/
  /***********************************************************************************/
  public function listarEvidencias()
  {
   $id=$_GET['nombre'];
  $listar = $this->db->prepare("select * from evidencia where idcorrespondencia='$id'");
  $listar->execute();
  return $listar;
  }
   /***********************************************************************************/
  /*----------------------------  Consultar Evidencias Otros   -------------------------*/
  /***********************************************************************************/
  public function listarEvidenciasOtros()
  {
  $id=$_GET['nombre'];
  $listar = $this->db->prepare("select * from evidencia_otros where idcorrespondenciaotros='$id'");
  $listar->execute();

  return $listar;



  }

  /***********************************************************************************/

  /*------------------------  Listar Radicados de Tutelas    -------------------------*/

  /***********************************************************************************/

  public function listarRadicadosTutelas()

  {



  $listar = $this->db->prepare("select tutelas.id as idtutelas,tutelas.radicado as radicado,juzgado.nombre as juzgado
from correspondencia_tutelas as tutelas inner join pa_juzgado juzgado
ON (tutelas.idjuzgado=juzgado.id)
");

  $listar->execute();

  return $listar;



  }

    /***********************************************************************************/

  /*------------------------  Listar Radicados de Tutelas Disponibilidad   -------------------------*/

  /***********************************************************************************/

  public function listarRadicadosTutelasExistentes()

  {



  $listar = $this->db->prepare("select radicado from correspondencia_tutelas");

  $listar->execute();

  return $listar;



  }
      /***********************************************************************************/

  /*------------------------  Listar Radicados de Tutelas Disponibilidad Modificar -------------------------*/

  /***********************************************************************************/

  public function listarRadicadosTutelasExistentesModificar()

  {


  $id=$_GET['nombre'];
  $listar = $this->db->prepare("select radicado from correspondencia_tutelas where id not in ('$id')");

  $listar->execute();

  return $listar;



  }

   /***********************************************************************************/

  /*------------------------  Listar Accionados Accionantes Vinculados    -------------------------*/

  /***********************************************************************************/

  public function listarAccionadosVinculadosAccionantes()

  {


  $rad=$_GET['nombre'];
  $consultar = $this->db->prepare("SELECT id FROM correspondencia_tutelas where radicado ='$rad'");
  $consultar->execute();

	while($field = $consultar->fetch())
        {


		  $id=$field['id'];

         }
  //echo $id;
  $listar = $this->db->prepare("select accionante_accionado_vinculado.idcorrespondencia_tutelas as idcorres, accionante_accionado_vinculado.accionante_accionado_vinculado as nombre,accionante_accionado_vinculado.esaccionante_accionado_vinculado as tipoacc  from accionante_accionado_vinculado
  where idcorrespondencia_tutelas= '$id' order by ");

  $listar->execute();

  return $listar;



  }
  /*******************************  Listar Tutela ***************************************************/

  public function listarCorrespondenciaTutela()

  {


  $id = $_GET['nombre'];

  $listar = $this->db->prepare("select correspondencia_tutelas.radicado, pa_juzgado.nombre as juzgado,correspondencia_tutelas.fecha, correspondencia_tutelas.Tutela_Incidente
from correspondencia_tutelas
inner join pa_juzgado on (correspondencia_tutelas.idjuzgado=pa_juzgado.id) where correspondencia_tutelas.id='$id'
");

  $listar->execute();

  return $listar;



  }

/*******************************  Listar Partes Tutela ***************************************************/

  public function listarPartesTutela()

  {


  $id = $_GET['nombre'];

  $listar = $this->db->prepare("select * from accionante_accionado_vinculado where accionante_accionado_vinculado.idcorrespondencia_tutelas='$id' order by id
");

  $listar->execute();

  return $listar;



  }


/*******************************  Listar Actuaciones Tutela ***************************************************/

  public function listarActuacionesTutela()

  {


   $id = $_GET['nombre'];

  $listar = $this->db->prepare("select actuacion_tutela.idaccionado_vinculado_accionante_tut as idparte,actuacion_tutela.esoficio_telegrama, actuacion_tutela.oficio_telegrama,
actuacion_tutela.direccion,pa_municipio.nombre as municipio,pa_municipio.id as idmunicipio, pa_medionotificacion.nombre as medio, actuacion_tutela.notificado,
actuacion_tutela.fecha_envio, pa_actuacion.nombre as actuacion,pa_departamento.id as iddepartamento,pa_departamento.nombre as departamento,actuacion_tutela.tipo_actuacion
from actuacion_tutela
inner join pa_municipio on (actuacion_tutela.idmunicipio=pa_municipio.id)
inner join pa_departamento on (pa_departamento.id = pa_municipio.iddepartamento)
inner join pa_medionotificacion on (actuacion_tutela.idmedionotificacion=pa_medionotificacion.id)
inner join pa_actuacion on (actuacion_tutela.idactuacion=pa_actuacion.id)
where actuacion_tutela.idaccionado_vinculado_accionante_tut in
(select id from accionante_accionado_vinculado where accionante_accionado_vinculado.idcorrespondencia_tutelas='$id')
order by actuacion_tutela.idaccionado_vinculado_accionante_tut,actuacion_tutela.id
");

  $listar->execute();

  return $listar;



  }

/*******************************  Listar Actuaciones Tutela ***************************************************/

  public function consultarOtros()

  {

  $id = $_GET['nombre'];

  $listar = $this->db->prepare("SELECT corres.radicado,pa_juzgado.nombre as juzgado, corres.esOficio_Telegrama,corres.oficio_telegrama as numero,
corres.destinatario,corres.direccion,pa_departamento.nombre as departamento,pa_municipio.nombre as municipio,
corres.notificado,pa_medionotificacion.nombre as medio, corres.fecha,corres.idmedionotificacion as idmedio
FROM correspondencia_otros as corres
INNER JOIN pa_municipio ON (pa_municipio.id=corres.idmunicipio)
INNER JOIN pa_departamento ON (pa_departamento.id=pa_municipio.iddepartamento)
INNER JOIN pa_medionotificacion ON (pa_medionotificacion.id=corres.idmedionotificacion)
INNER JOIN pa_juzgado ON (pa_juzgado.id=corres.idjuzgado)
where corres.id='$id'
");

  $listar->execute();

  return $listar;



  }
/*******************************  Listar Todos los empleados ***************************************************/

  public function listarEmpleadosTodos()

  {



  $listar = $this->db->prepare("Select pa_usuario.id as idusuario,pa_usuario.empleado,pa_areaempleado.nombre as area from pa_usuario
inner join pa_areaempleado on (pa_usuario.idareaempleado=pa_areaempleado.id)
where pa_usuario.id!=8
order by empleado");

  $listar->execute();

  return $listar;



  }
 /**************************  Listar Todos los procesos personal*************************************************/
  public function listarProcesosPersonal()

  {


$procesos = $this->db->prepare("select otros.id as idotros, concat(otros.esOficio_Telegrama,' - ',otros.oficio_telegrama) as proceso,
otros.fecha as fecha, j.nombre as juzgado, otros.direccion, otros.radicado
from correspondencia_otros as otros
inner join pa_juzgado j on (j.id=otros.idjuzgado)
where otros.idmedionotificacion=6 and otros.id not in (select turno.idproceso from turno where turno.tipo_proceso='Otro' ) order by otros.fecha desc");
$procesos->execute();

		$i=0;

		while($idE = $procesos->fetch())
		{

			$vector[$i][id]=$idE[idotros];
			$vector[$i][proceso]=$idE[proceso];
			$vector[$i][tipo]= "Otro";
			$vector[$i][fecha]=$idE[fecha];
			$vector[$i][juzgado]= $idE[juzgado];
			$vector[$i][direccion]= $idE[direccion];
			if($idE[radicado]=='')
			{
			$vector[$i][radicado]= "SIN";
			}
			else{
			$vector[$i][radicado]= $idE[radicado];
			}
			$i= $i+1;
		}
$procesos1 = $this->db->prepare("select act.id as idtutinc, concat(act.esOficio_Telegrama,' - ',act.oficio_telegrama) as proceso,
act.tipo_actuacion as tipo, act.fecha_envio as fecha, j.nombre as juzgado,act.direccion,ct.radicado
from actuacion_tutela as act
inner join accionante_accionado_vinculado acc on (acc.id=act.idaccionado_vinculado_accionante_tut)
inner join correspondencia_tutelas ct on (ct.id=acc.idcorrespondencia_tutelas)
inner join pa_juzgado j on (j.id=ct.idjuzgado)
where act.idmedionotificacion=6  and act.id not in (select turno.idproceso from turno where turno.tipo_proceso='Tutela' or turno.tipo_proceso='Incidente' ) order by act.fecha_envio desc");
$procesos1->execute();

while($idE2 = $procesos1->fetch())
		{

			$vector[$i][id]=$idE2[idtutinc];
			$vector[$i][proceso]=$idE2[proceso];
			$vector[$i][tipo]= $idE2[tipo];
			$vector[$i][fecha]= $idE2[fecha];
			$vector[$i][juzgado]= $idE2[juzgado];
			$vector[$i][direccion]= $idE2[direccion];
			$vector[$i][radicado]= $idE2[radicado];
			$i= $i+1;
		}


  return $vector;
  }


 /*******************************  Listar Tutela ***************************************************/

  public function registrarTurno()

  {


  $responsable_completo = $_POST['responsable'];
  $responsable_vector = explode("-",$responsable_completo);
  $responsable = $responsable_vector[0];
  $proceso_vector = explode(";",$_POST['proceso']);
  print_r($proceso_vector);
  $contador = count($proceso_vector)-1;
  $idproceso = $proceso_vector[0];
  $tipo = $proceso_vector[$contador];
  $hora = $_POST["hora"].":".$_POST["hora2"]." ".$_POST["hora3"];

  $registrar3 = $this->db->prepare("INSERT INTO turno  (idusuario,idproceso,hora,tipo_proceso) values ('$responsable','$idproceso','$hora','$tipo')");
  $registrar3->execute();

date_default_timezone_set('America/Bogota');
$fechaa=date('Y-m-d g:ia');

$horaa=explode(' ',$fechaa);

$fechal=$horaa[0];

$hora=$horaa[1];

$accion='Resgistr&oacute; Turno';
$idres = $_SESSION['idUsuario'];

$detalle=$_SESSION['nombre']." "."Registro un nuevo Turno ".$fechal." "."a las: ".$hora;

 //es de tipo 1 porque va asociado al m�dulo de archivo
$tipolog=2;

$insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

$insertarlog->execute();



  print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=2"</script>';






  }

  /**************************  Listar Todos los turnos *************************************************/
  public function listarTurnos()

  {



	$procesos = $this->db->prepare("(select pa_usuario.empleado, pa_areaempleado.nombre as areaempleado,pa_juzgado.nombre as juzgado,turno.tipo_proceso,correspondencia_otros.direccion,correspondencia_otros.radicado,
correspondencia_otros.esOficio_Telegrama,correspondencia_otros.oficio_telegrama,correspondencia_otros.fecha,turno.hora
from turno
inner join pa_usuario on (turno.idusuario=pa_usuario.id)
inner join pa_areaempleado on (pa_areaempleado.id=pa_usuario.idareaempleado)
inner join correspondencia_otros on (correspondencia_otros.id=turno.idproceso)
inner join pa_juzgado on (pa_juzgado.id=correspondencia_otros.idjuzgado)
where turno.idproceso =correspondencia_otros.id and turno.tipo_proceso='Otro')
union
(select pa_usuario.empleado, pa_areaempleado.nombre as areaempleado,pa_juzgado.nombre as juzgado,turno.tipo_proceso,actuacion_tutela.direccion,correspondencia_tutelas.radicado,
actuacion_tutela.esOficio_Telegrama,actuacion_tutela.oficio_telegrama,actuacion_tutela.fecha_envio as fecha,turno.hora
from turno
inner join pa_usuario on (turno.idusuario=pa_usuario.id)
inner join pa_areaempleado on (pa_areaempleado.id=pa_usuario.idareaempleado)
inner join actuacion_tutela on (actuacion_tutela.id=turno.idproceso)
inner join accionante_accionado_vinculado on (accionante_accionado_vinculado.id=actuacion_tutela.idaccionado_vinculado_accionante_tut)
inner join correspondencia_tutelas on (correspondencia_tutelas.id=accionante_accionado_vinculado.idcorrespondencia_tutelas)
inner join pa_juzgado on (pa_juzgado.id=correspondencia_tutelas.idjuzgado)
where actuacion_tutela.id= turno.idproceso and (turno.tipo_proceso='Tutela' or turno.tipo_proceso='Incidente'))
order by empleado ");
	$procesos->execute();

	return $procesos;


 }

/*******************************  Listar Accionados ***************************************************/

  public function listar_accionados()

  {


   $id = $_GET['nombre'];

  $listar = $this->db->prepare("select av.accionante_accionado_vinculado as nombre,av.id  from accionante_accionado_vinculado av
  where av.esaccionante_accionado_vinculado='Accionado' and av.idcorrespondencia_tutelas = $id order by nombre");
  $listar->execute();

   $i = 0;
   while($idE = $listar->fetch())
		{

		$vector_accionados[$i][nombre_accionado] = $idE[nombre];
		$vector_accionados[$i][id] = $idE[id];
		$i++;

		}

  return $vector_accionados;



  }

/*******************************  Listar Vinculados ***************************************************/

  public function listar_vinculados()

  {


   $id = $_GET['nombre'];

  $listar = $this->db->prepare("select av.accionante_accionado_vinculado as nombre, av.id   from accionante_accionado_vinculado av
  where av.esaccionante_accionado_vinculado='Vinculado' and av.idcorrespondencia_tutelas = $id order by nombre");
  $listar->execute();

   $i = 0;
   while($idE = $listar->fetch())
		{

		$vector_vinculados[$i][nombre_vinculado] = $idE[nombre];
		$vector_vinculados[$i][id] = $idE[id];
		$i++;

		}

  return $vector_vinculados;



  }

/*******************************  Listar Accionante ***************************************************/

  public function listar_accionante()

  {


  $id = $_GET['nombre'];

  $listar = $this->db->prepare("select av.accionante_accionado_vinculado as nombre, av.id from accionante_accionado_vinculado av
  where av.esaccionante_accionado_vinculado='Accionante' and av.idcorrespondencia_tutelas = $id");

  $listar->execute();


  return $listar;


  }

 /*******************************  Listar detalles de actuaciones ***************************************************/

  public function listarPartesTutela_nv()

  {


  $id = $_GET['nombre'];

  $listar = $this->db->prepare("SELECT acc.accionante_accionado_vinculado, acc.esaccionante_accionado_vinculado,a.nombre as actuacion,m.nombre as medio,act.esoficio_telegrama,act.oficio_telegrama,
act.direccion,mu.nombre as municipio,act.notificado,act.fecha_envio,act.tipo_actuacion,
act.nunguia,a.id AS idactuacionT
FROM correspondencia_tutelas ct
INNER JOIN accionante_accionado_vinculado acc ON (ct.id=acc.idcorrespondencia_tutelas)
INNER JOIN actuacion_tutela act ON (act.idaccionado_vinculado_accionante_tut=acc.id)
INNER JOIN  pa_actuacion a ON (a.id=act.idactuacion)
INNER JOIN pa_medionotificacion m ON (m.id=act.idmedionotificacion)
INNER JOIN pa_municipio mu ON (mu.id=act.idmunicipio)
WHERE ct.id=$id order by act.fecha_envio,acc.accionante_accionado_vinculado");

  $listar->execute();


  return $listar;


  }

/**********************************************************************************************************/
  /*----------------------- Modificar Correspondencia Tutela Nueva Versi�n -------------------------------*/
  /*******************************************************************************************************/
  public function modificarCorrespondenciaTutela_nv()
  {

	$cantidad_accionado_vinculado   = $_POST['cantidad_detalles'];
	$cantidad_accionados			= $_POST['cantidad_accionados'];
	$cantidad_vinculados			= $_POST['cantidad_vinculados'];
	$tiene_accionado				= $_POST['tiene_accionado'];
	$tiene_vinculado				= $_POST['tiene_vinculado'];
	$id=$_GET['nombre'];



	// JUAN ESTEBAN MUNERA BETANCUR 2018-01-22
	$id_usuario = $_SESSION['idUsuario'];


	  date_default_timezone_set('America/Bogota');
      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fechal=$horaa[0];

	  $hora=$horaa[1];

	  $accion='Modific&oacute; Tutela';
	  $idres = $_SESSION['idUsuario'];

      $detalle=$_SESSION['nombre']." "."Modifico una Tutela ".$fechal." "."a las: ".$hora;

	   //es de tipo 2 porque va asociado al m�dulo de correspondencia
	  $tipolog=2;

      $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

      $insertarlog->execute();





	$i_accionados = 0;
	$i_accionados1 = 1;

 	if ($tiene_accionado=='on')
 	{
 	 $vector_accionados[$i_accionados][nombre] = $_POST['accionado'];
 	 $i_accionados = $i_accionados+1;

	  if ($cantidad_accionados>0)
 	 {
  	  while($i_accionados<=$cantidad_accionados)
	  {
  		if($_POST['accionado'.$i_accionados])
   		{
		 $vector_accionados[$i_accionados1][nombre] = $_POST['accionado'.$i_accionados];
		 $i_accionados1 = $i_accionados1+1;

   		}
   		$i_accionados = $i_accionados+1;
      }
    }
	$ins = 0;
	//print_r($vector_accionados);
	$cant_insert_accionados = count($vector_accionados);
	while($ins < $cant_insert_accionados)
	{

	    $accionado_temp = $vector_accionados[$ins][nombre];
		$registrar_accionados = $this->db->prepare("INSERT INTO accionante_accionado_vinculado (idcorrespondencia_tutelas,accionante_accionado_vinculado,esaccionante_accionado_vinculado) values ('$id','$accionado_temp','Accionado')");
		 $registrar_accionados->execute();

		 $consultar = $this->db->prepare("SELECT MAX(id) as id FROM accionante_accionado_vinculado");
$consultar->execute();

	while($field = $consultar->fetch())
        {


		  $id_accionado=$field['id'];

         }
		 $vector_accionados[$ins][idbd]=$id_accionado;


		 $ins = $ins+1;

	}
//print_r($vector_accionados);

 }
 else
 {
 //echo "no tiene accionado";
 }


$i_vinculados = 0;
$i_vinculados1 = 1;

 if ($tiene_vinculado=='on')
 {

 $vector_vinculados[$i_vinculados][nombre] = $_POST['vinculado'];
 $i_vinculados = $i_vinculados+1;
 if ($cantidad_vinculados>0)
 {
  while($i_vinculados<=$cantidad_vinculados){
  if($_POST['vinculado'.$i_vinculados])
   {
	$vector_vinculados[$i_vinculados1][nombre] = $_POST['vinculado'.$i_vinculados];
	$i_vinculados1 = $i_vinculados1+1;

   }
   $i_vinculados = $i_vinculados+1;

  }

 }
$insv = 0;
//print_r($vector_vinculados);
$cant_insert_vinculados = count($vector_vinculados);
	while($insv < $cant_insert_vinculados)
	{

	    $vinculado_temp = $vector_vinculados[$insv][nombre];
		$registrar_vinculados = $this->db->prepare("INSERT INTO accionante_accionado_vinculado (idcorrespondencia_tutelas,accionante_accionado_vinculado,esaccionante_accionado_vinculado) values ('$id','$vinculado_temp','Vinculado')");
		 $registrar_vinculados->execute();

		 $consultar = $this->db->prepare("SELECT MAX(id) as id FROM accionante_accionado_vinculado");
		 $consultar->execute();

	while($field = $consultar->fetch())
        {


		  $id_vinculado=$field['id'];

         }
		 $vector_vinculados[$insv][idbd]=$id_vinculado;
		 $insv = $insv+1;


   }

//print_r($vector_vinculados);

 }
 else
 {
// echo "no tiene vinculados";
 }

$i=$j=1;



 while ($j<=$cantidad_accionado_vinculado)

  	{
      if($_POST['oficio_telegrama_numero'.$j]!="")
	  {

		 $tipo_actuacion					  = $_POST['tipo_actuacion'.$j];
		 $idactuacion						  = $_POST['idactuacion'.$j];
		 $esoficio_telegrama                  = $_POST['esOficio_Telegrama'.$j];
		 $oficio_telegrama			          = $_POST['oficio_telegrama_numero'.$j];
		 $direccion							  = $_POST['direccion'.$j];
		 $idmunicipio						  = $_POST['ciudad'.$j];
		 $idmedionotificacion				  = $_POST['medio'.$j];
		 $fecha_envio						  = $_POST['fecha_envio'.$j];
		 $esaccionante_accionado_vinculado    = $_POST['accionante_accionado_vinculado'.$j];
	     $notificado						  = "Si";

		 if($esaccionante_accionado_vinculado=='Accionante')
		 {
		   $idaccionado_vinculado_accionante_tut = $_POST['idaccionante_bd'];
		 }

		 if($esaccionante_accionado_vinculado=='Accionado')
		 {

		   $accionado_nombre = $_POST['accionados_sl'.$j];
		   $cont_vect = count($vector_accionados);
		   $jj= 0;
		   //echo $m = $accionado_nombre*2;

		   if(ctype_digit($accionado_nombre))
		   {

			$idaccionado_vinculado_accionante_tut =   $accionado_nombre;

		   }
		   else {

			while($jj<$cont_vect)
			{
			 if($vector_accionados[$jj][nombre]==$accionado_nombre)
			 {
			  $index = $jj;
			  $jj= $cont_vect;
			 }
			 $jj++;
			}
			$idaccionado_vinculado_accionante_tut =   $vector_accionados[$index][idbd];
		 }
		}


		 if($esaccionante_accionado_vinculado=='Vinculado')
		 {

		   $vinculado_nombre = $_POST['vinculados_sl'.$j];
		   $cont_vect_v = count($vector_vinculados);
		   $v= 0;

		   if(ctype_digit($vinculado_nombre))
		   {
		    $idaccionado_vinculado_accionante_tut =   $vinculado_nombre;

		   }
		   else {

			while($v<$cont_vect_v)
			{
			 if($vector_vinculados[$v][nombre]== $vinculado_nombre)
			 {
			  $index_v = $v;
			  $v= $cont_vect_v;
			 }
			 $v++;
			}
			$idaccionado_vinculado_accionante_tut =   $vector_vinculados[$index_v][idbd];
		 }
		}

		  if($esaccionante_accionado_vinculado=='Otro')
		 {


		  $otro_texto = $_POST['texto_otro'.$j];
		  $registrar_otro = $this->db->prepare("INSERT INTO accionante_accionado_vinculado (idcorrespondencia_tutelas,accionante_accionado_vinculado,esaccionante_accionado_vinculado) values ('$id','$otro_texto','Otro')");
		 $registrar_otro->execute();

		 $consultar_otro = $this->db->prepare("SELECT MAX(id) as id FROM accionante_accionado_vinculado");
		 $consultar_otro->execute();

		while($field = $consultar_otro->fetch())
       	 {
		  $id_otro=$field['id'];
         }


		   $idaccionado_vinculado_accionante_tut = $id_otro;
		 }



		$registrar4 = $this->db->prepare("INSERT INTO actuacion_tutela (id_usuario,idaccionado_vinculado_accionante_tut,esoficio_telegrama,oficio_telegrama,direccion,idmunicipio,idmedionotificacion,notificado,fecha_envio,idactuacion,tipo_actuacion) values ('$id_usuario','$idaccionado_vinculado_accionante_tut','$esoficio_telegrama','$oficio_telegrama','$direccion','$idmunicipio','$idmedionotificacion','$notificado','$fecha_envio','$idactuacion','$tipo_actuacion')");
		$registrar4->execute();

	  }
	  $j = $j+1;
    }


  print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=2"</script>';



  }

/*******************************  Listar Todos las actuaciones ***************************************************/

  public function listarActuaciones()

  {



  $listar = $this->db->prepare("SELECT ct.radicado, act.esoficio_telegrama,act.oficio_telegrama,act.direccion,av.accionante_accionado_vinculado as nombre, act.id
FROM correspondencia_tutelas ct
INNER JOIN accionante_accionado_vinculado av ON (ct.id=av.idcorrespondencia_tutelas)
INNER JOIN actuacion_tutela act ON (act.idaccionado_vinculado_accionante_tut=av.id)
order by ct.radicado,av.accionante_accionado_vinculado
");

  $listar->execute();
  $i=0;

 while($field = $listar->fetch())
  {
   $vector[id][$i] = $field['radicado'];
   $i++;
  }


  return $vector;



  }

/*******************************  Listar actuaci�n especifica ***************************************************/

  public function listarActuacion_Especifica()

  {

  $id = $_GET['nombre'];

  $listar = $this->db->prepare("SELECT ct.radicado,act.esoficio_telegrama,act.oficio_telegrama,act.direccion,act.idmunicipio,act.idmedionotificacion,act.idactuacion,act.tipo_actuacion,mu.nombre as municipio,
me.nombre as medio, actu.nombre as actuacion, de.id as iddepa, de.nombre as nombredepa
FROM correspondencia_tutelas ct
INNER JOIN accionante_accionado_vinculado av ON (ct.id=av.idcorrespondencia_tutelas)
INNER JOIN actuacion_tutela act ON (act.idaccionado_vinculado_accionante_tut=av.id)
INNER JOIN pa_municipio mu ON (mu.id=act.idmunicipio)
INNER JOIN pa_medionotificacion me ON (me.id=act.idmedionotificacion)
INNER JOIN pa_actuacion actu ON (actu.id=act.idactuacion)
INNER JOIN pa_departamento de ON (de.id=mu.iddepartamento)
where act.id= $id");

  $listar->execute();

  return $listar;



  }


/**********************************************************************************************************/
  /*----------------------- Modificar Actuaciones -------------------------------*/
  /*******************************************************************************************************/
  public function modificarActuacion()
  {

	$esoficio_telegrama   			= $_POST['esoficio_telegrama'];
	$oficio_telegrama				= $_POST['oficio_telegrama'];
	$direccion						= $_POST['direccion'];
	$idmunicipio					= $_POST['ciudad'];
	$idmedionotificacion			= $_POST['medio_notificacion'];
	$tipo_actuacion					= $_POST['tipo_actuacion'];
	$idactuacion					= $_POST['idactuacion'];
	$id								= $_POST['id'];


	  date_default_timezone_set('America/Bogota');
      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fechal=$horaa[0];

	  $hora=$horaa[1];

	  $accion='Modific&oacute; Datos Actuaci�n';
	  $idres = $_SESSION['idUsuario'];

      $detalle=$_SESSION['nombre']." "."Modifico Datos Actuaci&oacute;n ".$fechal." "."a las: ".$hora;

	   //es de tipo 2 porque va asociado al m�dulo de correspondencia
	  $tipolog=2;

      $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

      $insertarlog->execute();

	   $modificar = $this->db->prepare("update actuacion_tutela set esoficio_telegrama='$esoficio_telegrama', oficio_telegrama='$oficio_telegrama', direccion='$direccion',idmunicipio='$idmunicipio', idmedionotificacion='$idmedionotificacion', tipo_actuacion='$tipo_actuacion', idactuacion = '$idactuacion' where id='$id';");

      $modificar->execute();


	  print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=2"</script>';


}

 /***********************************************************************************/

	/*------------------------------ Eliminar  Actuaci�n ---------------------------------*/

	/***********************************************************************************/

	public function eliminarActuacion()

	{

		$id=$_GET['nombre'];
	    date_default_timezone_set('America/Bogota');
        $fechaa=date('Y-m-d g:ia');
        $horaa=explode(' ',$fechaa);
        $fechal=$horaa[0];
        $hora=$horaa[1];

	    $accion='Elimin&oacute; Actuaci&oacute;n';
	    $idres = $_SESSION['idUsuario'];
        $detalle=$_SESSION['nombre']." "."Elimino una Actuaci&oacute;n ".$fechal." "."a las: ".$hora;


	    $tipolog=2;

        $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

        $insertarlog->execute();





	if($_SESSION['id']!="")
   {

   		$consulta = $this->db->prepare("DELETE FROM actuacion_tutela WHERE id='$id'");

		$consulta->execute();

		$resultado = $consulta->rowCount();



		 if ($resultado)

        {

			  $_SESSION['elemento'] = "Actuaci�n eliminada exitosamente";

	          $_SESSION['elem_conscontrato'] = true;

		}

		echo '<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=filtrar_actuaciones"</script>';



	}


}
/***********************************************************************************/

	/*------------------------------ Eliminar  Otro ---------------------------------*/

	/***********************************************************************************/

	public function eliminarOtro()

	{

		$id=$_GET['nombre'];
	    date_default_timezone_set('America/Bogota');
        $fechaa=date('Y-m-d g:ia');
        $horaa=explode(' ',$fechaa);
        $fechal=$horaa[0];
        $hora=$horaa[1];

	    $accion='Elimin&oacute; Correspondencia Otro';
	    $idres = $_SESSION['idUsuario'];
        $detalle=$_SESSION['nombre']." "."Elimin&oacute; Correspondencia Otro ".$fechal." "."a las: ".$hora;


	    $tipolog=2;

        $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

        $insertarlog->execute();





	if($_SESSION['id']!="")
   {

   		$consulta = $this->db->prepare("DELETE FROM correspondencia_otros WHERE id='$id'");

		$consulta->execute();

		$resultado = $consulta->rowCount();



		 if ($resultado)

        {

			  $_SESSION['elemento'] = "Correspondencia eliminada exitosamente";

	          $_SESSION['elem_conscontrato'] = true;

		}

		echo '<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=filtrar_otros"</script>';



	}


}
  /***********************************************************************************/

  /*------------------------------ Listar Tutelas a Editar  ---------------------------------------*/

  /***********************************************************************************/

  public function listarTutelasEditar()

  {

      $id=$_GET['nombre'];

	  $listar = $this->db->prepare("select ct.id,ct.radicado,j.nombre,ct.Tutela_Incidente,ct.fecha,concat(ct.idjuzgado,'-',j.idarea,'-',j.numero_juzgado)as juzgado from correspondencia_tutelas ct
inner join pa_juzgado j on (ct.idjuzgado=j.id)
where ct.id='$id'");

	  $listar->execute();

	  return $listar;



  }


  /***********************************************************************************/

  /*------------------------------ Listar Datos Radicado  ---------------------------------------*/

  /***********************************************************************************/

  public function listarDatosRadicado()

  {

      $id=$_GET['nombre'];

	  $listar = $this->db->prepare("select ct.radicado from correspondencia_tutelas ct where ct.id='$id'");

	  $listar->execute();

	  while($field = $listar->fetch())
       	 {
		  $radicado=$field['radicado'];
		  }

	  $ano= substr($radicado, 12, 4);
	  $consecutivo=substr($radicado, 18, 3);
	  $instancia=substr($radicado, 21, 2);

	  $vector[0][ano]=$ano;
	  $vector[0][consecutivo]=$consecutivo;
	  $vector[0][instancia]=$instancia;



	  return $vector;



  }
/***********************************************************************************/

	/*------------------------------ Modificar datos basicos Tutela ---------------------------------*/

	/***********************************************************************************/

	public function modificarTutela_basico()

	{

	$Tutela_Incidente = $_POST['proceso'];
	$juzgado          = $_POST['juzgado'];
	$temp = explode('-',$juzgado);
	$idjuzgado = $temp[0];
	$radicado = $_POST['radicado'];
	$id=$_POST['id'];

	 date_default_timezone_set('America/Bogota');
        $fechaa=date('Y-m-d g:ia');
        $horaa=explode(' ',$fechaa);
        $fechal=$horaa[0];
        $hora=$horaa[1];

	    $accion='Modic&oacute; Datos B&aacute;sicos Tutela/Incidente';
	    $idres = $_SESSION['idUsuario'];
        $detalle=$_SESSION['nombre']." "."Modic&oacute; Datos B&aacute;sicos Tutela/Incidente ".$fechal." "."a las: ".$hora;


	    $tipolog=2;

        $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

        $insertarlog->execute();

		$modificar = $this->db->prepare("update correspondencia_tutelas set Tutela_Incidente='$Tutela_Incidente',idjuzgado='$idjuzgado',radicado='$radicado' where id='$id';");

      $modificar->execute();


	  print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=2"</script>';


	}

/**********************************************************************************************************/
  /*----------------------- Modificar Correspondencia Otros -------------------------------*/
  /*******************************************************************************************************/
  public function modificarCorrespondencia_Otro()
  {

	$radicado   			= $_POST['radicado'];
	$juzgado				= $_POST['juzgado'];
	$esOficio_Telegrama		= $_POST['esOficio_Telegrama'];
	$oficio_telegrama       = $_POST['oficio_telegrama'];
	$destinatario			= $_POST['destinatario'];
	$direccion			    = $_POST['direccion'];
	$ciudad					= $_POST['estados'];
	$medio_notificacion     = $_POST['medio_notificacion'];
	$id    					= $_GET['nombre'];


	  date_default_timezone_set('America/Bogota');
      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fechal=$horaa[0];

	  $hora=$horaa[1];

	  $accion='Modific&oacute; Correpondencia';
	  $idres = $_SESSION['idUsuario'];

      $detalle=$_SESSION['nombre']." "."Modifico Correspondencia ".$fechal." "."a las: ".$hora;

	   //es de tipo 2 porque va asociado al m�dulo de correspondencia
	  $tipolog=2;

      $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

      $insertarlog->execute();


	  $modificar = $this->db->prepare("UPDATE correspondencia_otros SET idmedionotificacion='$medio_notificacion',radicado='$radicado',idjuzgado='$juzgado',esOficio_Telegrama='$esOficio_Telegrama',oficio_telegrama='$oficio_telegrama',destinatario='$destinatario',direccion='$direccion',idmunicipio='$ciudad'  where id='$id'");
	  $modificar->execute();




	  print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=2"</script>';


}

/*******************************  Consultar Filtro Actuaciones ***************************************************/

  public function consultar_filtro_actuacion()

  {

 $radicado 				= $_GET['nombre2'];
 $fechai   				= $_GET['nombre3'];
 $fechaf   				= $_GET['nombre4'];
 $esoficio_telegrama    = $_GET['nombre5'];
 $oficio_telegrama   	= $_GET['nombre6'];
 $parte   				= $_GET['nombre7'];
 $direccion  			= $_GET['nombre8'];


 if(($fechai !='') and ($fechaf !=''))
 {


  $listar = $this->db->prepare("select actu.id as idactu,ct.radicado,actu.esoficio_telegrama,actu.oficio_telegrama,actu.direccion,av.accionante_accionado_vinculado from correspondencia_tutelas ct inner join accionante_accionado_vinculado av ON (ct.id=av.idcorrespondencia_tutelas)
inner join actuacion_tutela actu on (actu.idaccionado_vinculado_accionante_tut=av.id)
where ct.radicado like '%$radicado%' and actu.esoficio_telegrama like '%$esoficio_telegrama%' and actu.oficio_telegrama like '%$oficio_telegrama%' and av.accionante_accionado_vinculado like '%$parte%' and actu.direccion like '%$direccion%' and actu.fecha_envio BETWEEN '$fechai' and '$fechaf'");

  $listar->execute();

 }

else
{




  $listar = $this->db->prepare("select actu.id as idactu,ct.radicado,actu.esoficio_telegrama,actu.oficio_telegrama,actu.direccion,av.accionante_accionado_vinculado from correspondencia_tutelas ct inner join accionante_accionado_vinculado av ON (ct.id=av.idcorrespondencia_tutelas)
inner join actuacion_tutela actu on (actu.idaccionado_vinculado_accionante_tut=av.id)
where ct.radicado like '%$radicado%' and actu.esoficio_telegrama like '%$esoficio_telegrama%' and actu.oficio_telegrama like '%$oficio_telegrama%' and av.accionante_accionado_vinculado like '%$parte%' and actu.direccion like '%$direccion%'");

  $listar->execute();

}


  return $listar;


  }


/*******************************  Consultar Filtro Radicados ***************************************************/

  public function consultar_filtro_radicado()

  {

 $radicado 				= $_GET['nombre2'];
 $fechai   				= $_GET['nombre3'];
 $fechaf   				= $_GET['nombre4'];
 $idjuzgado			    = $_GET['nombre5'];



 if(($fechai !='') and ($fechaf !='') and ($idjuzgado!=''))
 {


  $listar = $this->db->prepare("SELECT co.id as idtut, co.radicado,co.idjuzgado,juz.nombre as juzgado,ar.nombre as area, co.fecha
FROM  correspondencia_tutelas co INNER JOIN pa_juzgado juz  ON (co.idjuzgado=juz.id)
inner join pa_area ar on (ar.id=juz.idarea)
WHERE co.radicado LIKE '%$radicado%' AND co.idjuzgado='$idjuzgado' AND co.fecha BETWEEN '$fechai' AND '$fechaf'");

  $listar->execute();

 }

else if (($fechai !='') and ($fechaf !='') and ($idjuzgado==''))
{




  $listar = $this->db->prepare("SELECT co.id as idtut, co.radicado,co.idjuzgado,juz.nombre as juzgado,ar.nombre as area, co.fecha
FROM  correspondencia_tutelas co INNER JOIN pa_juzgado juz  ON (co.idjuzgado=juz.id)
inner join pa_area ar on (ar.id=juz.idarea)
WHERE co.radicado LIKE '%$radicado%' AND co.fecha BETWEEN '$fechai' AND '$fechaf'");

  $listar->execute();

}

else if   (($fechai =='') and ($fechaf =='') and ($idjuzgado==''))
{

  $listar = $this->db->prepare("SELECT co.id as idtut, co.radicado,co.idjuzgado,juz.nombre as juzgado,ar.nombre as area, co.fecha
FROM  correspondencia_tutelas co INNER JOIN pa_juzgado juz  ON (co.idjuzgado=juz.id)
inner join pa_area ar on (ar.id=juz.idarea)
WHERE co.radicado LIKE '%$radicado%'");

  $listar->execute();

}
else if   (($fechai =='') and ($fechaf =='') and ($idjuzgado!=''))
{



  $listar = $this->db->prepare("SELECT co.id as idtut, co.radicado,co.idjuzgado,juz.nombre as juzgado,ar.nombre as area, co.fecha
FROM  correspondencia_tutelas co INNER JOIN pa_juzgado juz  ON (co.idjuzgado=juz.id)
inner join pa_area ar on (ar.id=juz.idarea)
WHERE co.radicado LIKE '%$radicado%' AND co.idjuzgado='$idjuzgado'");

  $listar->execute();

}

  return $listar;


  }

 /*******************************  Consultar Filtro Otro ***************************************************/

  public function consultar_filtro_otro()

  {

 $radicado 				= $_GET['nombre2'];
 $fechai   				= $_GET['nombre3'];
 $fechaf   				= $_GET['nombre4'];
 $esoficio_telegrama    = $_GET['nombre5'];
 $oficio_telegrama   	= $_GET['nombre6'];
 $destinatario   		= $_GET['nombre7'];
 $direccion  			= $_GET['nombre8'];
 $idjuzgado  			= $_GET['nombre9'];
 $idmedionotificacion   = $_GET['nombre10'];







if(($fechai !='') and ($fechaf !=''))
 {


  $listar = $this->db->prepare("SELECT co.id as idotro, co.radicado,co.esOficio_Telegrama,co.oficio_telegrama,co.direccion,co.destinatario,juz.nombre as juzgadonom, me.nombre as medionot, mu.nombre as municipio
FROM correspondencia_otros co
inner join pa_medionotificacion me ON (me.id=co.idmedionotificacion)
inner join pa_municipio mu ON (mu.id=co.idmunicipio)
inner join pa_juzgado juz ON (juz.id=co.idjuzgado)
WHERE co.esOficio_Telegrama LIKE '%$esoficio_telegrama%' AND co.oficio_telegrama LIKE '%$oficio_telegrama%' AND co.destinatario LIKE '%$destinatario%' and co.radicado like '%$radicado%'
and co.direccion like '%$direccion%' and co.idmedionotificacion like '%$idmedionotificacion%' and co.idjuzgado like '%$idjuzgado%' and co.fecha BETWEEN '$fechai' and '$fechaf'");

  $listar->execute();

 }

else
{



  $listar = $this->db->prepare("SELECT co.id as idotro, co.radicado,co.esOficio_Telegrama,co.oficio_telegrama,co.direccion,co.destinatario,juz.nombre as juzgadonom, me.nombre as medionot, mu.nombre as municipio
FROM correspondencia_otros co
inner join pa_medionotificacion me ON (me.id=co.idmedionotificacion)
inner join pa_municipio mu ON (mu.id=co.idmunicipio)
inner join pa_juzgado juz ON (juz.id=co.idjuzgado)
WHERE co.esOficio_Telegrama LIKE '%$esoficio_telegrama%' AND co.oficio_telegrama LIKE '%$oficio_telegrama%' AND co.destinatario LIKE '%$destinatario%' and co.radicado like '%$radicado%'
and co.direccion like '%$direccion%' and co.idmedionotificacion like '%$idmedionotificacion%' and co.idjuzgado like '%$idjuzgado%'");

  $listar->execute();

}

  return $listar;


  }


  /*******************************  Consultar Filtro Turno ***************************************************/

  public function consultar_filtro_turno()

  {

 $radicado 				= $_GET['nombre2'];
 $fechai   				= $_GET['nombre3'];
 $fechaf   				= $_GET['nombre4'];
 $esoficio_telegrama    = $_GET['nombre5'];
 $oficio_telegrama   	= $_GET['nombre6'];
 $empleado		   		= $_GET['nombre7'];
 $area		  			= $_GET['nombre8'];
 $idjuzgado  			= $_GET['nombre9'];
 $direccion				= $_GET['nombre10'];
 $tipo					= $_GET['nombre11'];


if(($fechai !='') and ($fechaf !=''))
 {

  if ($tipo == 'Otro')
 {
  $listar = $this->db->prepare("
SELECT usu.empleado,ar.nombre AS areaempleado, juz.nombre AS juzgado,otro.esOficio_Telegrama,otro.oficio_telegrama,tu.tipo_proceso,otro.radicado,otro.direccion,otro.fecha,tu.hora
FROM turno tu
INNER JOIN pa_usuario usu ON (tu.idusuario=usu.id)
INNER JOIN correspondencia_otros otro ON (otro.id=tu.idproceso)
INNER JOIN pa_juzgado juz ON (juz.id=otro.idjuzgado)
INNER JOIN pa_areaempleado ar ON (usu.idareaempleado=ar.id)
WHERE tu.tipo_proceso ='Otro' AND otro.esOficio_Telegrama LIKE '%$esoficio_telegrama%' AND otro.oficio_telegrama LIKE '%$oficio_telegrama%' AND otro.radicado LIKE '%$radicado%' AND usu.empleado LIKE '%$empleado%' AND usu.idareaempleado LIKE '%$area%' AND otro.idjuzgado LIKE '%$idjuzgado%' AND otro.direccion LIKE '%$direccion%' AND otro.fecha BETWEEN '$fechai' and '$fechaf'
");
}
else
{
$listar = $this->db->prepare("
SELECT usu.empleado,ar.nombre AS areaempleado, juz.nombre AS juzgado,act.esOficio_Telegrama,act.oficio_telegrama,tu.tipo_proceso,co.radicado,act.direccion,act.fecha_envio as fecha,tu.hora
FROM turno tu
INNER JOIN pa_usuario usu ON (tu.idusuario=usu.id)
INNER JOIN actuacion_tutela act ON (act.id=tu.idproceso)
INNER JOIN accionante_accionado_vinculado acc ON (acc.id=act.idaccionado_vinculado_accionante_tut)
INNER JOIN correspondencia_tutelas co ON (co.id=acc.idcorrespondencia_tutelas)
INNER JOIN pa_juzgado juz ON (juz.id=co.idjuzgado)
INNER JOIN pa_areaempleado ar ON (usu.idareaempleado=ar.id)
WHERE tu.tipo_proceso !='Otro' AND act.esOficio_Telegrama LIKE '%$esoficio_telegrama%' AND act.oficio_telegrama LIKE '%$oficio_telegrama%' AND co.radicado LIKE '%$radicado%' AND usu.empleado LIKE '%$empleado%' AND usu.idareaempleado LIKE '%$area%' AND co.idjuzgado LIKE '%$idjuzgado%' AND act.direccion LIKE '%$direccion%' AND act.fecha_envio BETWEEN '$fechai' and '$fechaf'
");
}
  $listar->execute();

 }

else {

	if ($tipo == 'Otro') {
	 $listar = $this->db->prepare("
    SELECT usu.empleado,ar.nombre AS areaempleado, juz.nombre AS juzgado,otro.esOficio_Telegrama,otro.oficio_telegrama,tu.tipo_proceso,otro.radicado,otro.direccion,otro.fecha,tu.hora
    FROM turno tu
    INNER JOIN pa_usuario usu ON (tu.idusuario=usu.id)
    INNER JOIN correspondencia_otros otro ON (otro.id=tu.idproceso)
    INNER JOIN pa_juzgado juz ON (juz.id=otro.idjuzgado)
    INNER JOIN pa_areaempleado ar ON (usu.idareaempleado=ar.id)
    WHERE tu.tipo_proceso ='Otro' AND otro.esOficio_Telegrama LIKE '%$esoficio_telegrama%' AND otro.oficio_telegrama LIKE '%$oficio_telegrama%' AND otro.radicado LIKE '%$radicado%' AND usu.empleado LIKE '%$empleado%' AND usu.idareaempleado LIKE '%$area%' AND otro.idjuzgado LIKE '%$idjuzgado%' AND otro.direccion LIKE '%$direccion%'
    ");
	}
	else{
	$listar = $this->db->prepare("
  SELECT usu.empleado,ar.nombre AS areaempleado, juz.nombre AS juzgado,act.esOficio_Telegrama,act.oficio_telegrama,tu.tipo_proceso,co.radicado,act.direccion,act.fecha_envio as fecha,tu.hora
  FROM turno tu
  INNER JOIN pa_usuario usu ON (tu.idusuario=usu.id)
  INNER JOIN actuacion_tutela act ON (act.id=tu.idproceso)
  INNER JOIN accionante_accionado_vinculado acc ON (acc.id=act.idaccionado_vinculado_accionante_tut)
  INNER JOIN correspondencia_tutelas co ON (co.id=acc.idcorrespondencia_tutelas)
  INNER JOIN pa_juzgado juz ON (juz.id=co.idjuzgado)
  INNER JOIN pa_areaempleado ar ON (usu.idareaempleado=ar.id)
  WHERE tu.tipo_proceso !='Otro' AND act.esOficio_Telegrama LIKE '%$esoficio_telegrama%' AND act.oficio_telegrama LIKE '%$oficio_telegrama%' AND co.radicado LIKE '%$radicado%' AND usu.empleado LIKE '%$empleado%' AND usu.idareaempleado LIKE '%$area%' AND co.idjuzgado LIKE '%$idjuzgado%' AND act.direccion LIKE '%$direccion%'
  ");

	}

  $listar->execute();

}
 return $listar;

}

 /*******************************  Consultar Filtro Otro ***************************************************/

  public function consultar_filtro_partes()
  {

 $radicado 				= $_GET['nombre1'];
 $tipo_parte   			= $_GET['nombre2'];
 $juzgado   			= $_GET['nombre3'];
 $parte    				= $_GET['nombre4'];



  $listar = $this->db->prepare("select ct.radicado,juz.nombre as juzgado, acc.accionante_accionado_vinculado,acc.esaccionante_accionado_vinculado,acc.id  as idacc
from accionante_accionado_vinculado acc
INNER JOIN correspondencia_tutelas ct ON (ct.id=acc.idcorrespondencia_tutelas)
INNER JOIN pa_juzgado juz ON (juz.id=ct.idjuzgado)
WHERE ct.radicado like '%$radicado%' AND acc.esaccionante_accionado_vinculado like '%$tipo_parte%'
AND ct.idjuzgado like '%$juzgado%' AND acc.accionante_accionado_vinculado like '%$parte%';");

  $listar->execute();


  return $listar;

}
 /*******************************  Consultar Filtro Especifica ***************************************************/

  public function consultar_filtro_parte_especifica()

  {


 $id = $_GET['nombre'];


  $listar = $this->db->prepare("select ct.radicado,juz.nombre as juzgado, acc.accionante_accionado_vinculado,acc.esaccionante_accionado_vinculado,acc.id  as idacc
from accionante_accionado_vinculado acc
INNER JOIN correspondencia_tutelas ct ON (ct.id=acc.idcorrespondencia_tutelas)
INNER JOIN pa_juzgado juz ON (juz.id=ct.idjuzgado)
WHERE acc.id ='$id';");

  $listar->execute();


  return $listar;

}


   /***********************************************************************************/

  /*------------------------------ Consultar SAIDOJ  ---------------------------------------*/

  /***********************************************************************************/

  public function consultarsaidoj()
  {
/*
SERV-JUSTICIA2
local
consejoPN

T103DAINFOPROC
A103LLAVPROC*/




$serverName = "SAD_AUX9\SQLEXPRESS";

$connectionInfo = array( "Database"=>"saidoj");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Conectado a la Base de Datos.<br />";
}else{
     echo "NO se puede conectar a la Base de Datos.<br />";
     die( print_r( sqlsrv_errors(), true));
}

$sql = "SELECT TOP 10 id_tipo_inc, id_juzgado,descripcion,fecha_demanda  from EXPEDIENTE";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $stmt );

/*if ($row_count === false)
   echo "Error in retrieveing row count.";
else
   echo $row_count;*/
$i=0;
while( $row = sqlsrv_fetch_array( $stmt) ) {

	    $date= $row['fecha_demanda'];
	  $fecha1= date_format($date, 'Y-m-d');
	  $vector[$i][id_tipo_inc] = $row['id_tipo_inc'];
	  $vector[$i][id_juzgado] = $row['id_juzgado'];
	  $vector[$i][fecha_demanda] =  $fecha1;
	$i++;
}

	  //print_r($vector);

	  return $vector;



  }

 /**********************************************************************************************************/
  /*------------------------------------------------ Modificar Parte -------------------------------------*/
  /*******************************************************************************************************/
  // JUAN ESTEBAN MUNERA BETANCUR 2019-03-29
	public function modificar_parte(){
		$id   					= $_GET['nombre'];
		$parte					= $_POST['parte'];
		$tipo_parte				= $_POST['tipo_parte'];

		date_default_timezone_set('America/Bogota');
		$fechaa=date('Y-m-d g:ia');
		$horaa=explode(' ',$fechaa);
		$fechal=$horaa[0];
		$hora=$horaa[1];

		$accion='Modific&oacute; Parte';
		$idres = $_SESSION['idUsuario'];

		$detalle=$_SESSION['nombre']." "."Modifico Parte ".$fechal." "."a las: ".$hora;
		//es de tipo 2 porque va asociado al m�dulo de correspondencia
		$tipolog=2;
		$insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

		$insertarlog->execute();
		if($tipo_parte!='Accionante'){
	  		$modificar = $this->db->prepare("UPDATE accionante_accionado_vinculado SET accionante_accionado_vinculado='$parte',esaccionante_accionado_vinculado='$tipo_parte'  where id='$id'");
		}else{
	 		$modificar = $this->db->prepare("UPDATE accionante_accionado_vinculado SET accionante_accionado_vinculado='$parte' where id='$id'");
		}

	  	$modificar->execute();

	  	print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=2"</script>';
	}


//-----------------------------------------------------------------------------------------------//
// ************************************ JUAN ESTEBAN MUNERA BETANCUR ****************************//
// ------------------------------------------- 10-03-2017 ---------------------------------------//

		public function get_fecha_actual(){
			date_default_timezone_set('America/Bogota');
			$fecharegistro=date('Y-m-d g:ia'); //FORMA PARA XP
			return $fecharegistro;
		}


    public function subir_consolidado(){
      try{
        //DATOS PARA EL REGISTRO DEL LOG
				$modelo     = new correspondenciaModel();
				$fechahora  = $modelo->get_fecha_actual();
				$datosfecha = explode(" ",$fechahora);
				$fechalog   = $datosfecha[0];
				$horalog    = $datosfecha[1];
				$idusuario  = $_SESSION['idUsuario'];
				$fecha_admision = $_POST['fecha_admision'];
				$tipo_envio     = $_POST['tipo_envio'];

        //OBTENEMOS EL ARCHIVO (.csv)
        $tipo = $_FILES['archivo']['type'];
        $tamanio = $_FILES['archivo']['size'];
        $archivotmp = $_FILES['archivo']['tmp_name'];
        //cargamos el archivo
        $lineas = file($archivotmp);
        //inicializamos variable a 0, esto nos ayudará a indicarle que no lea la primera l�nea
        $i=0;

        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //EMPIEZA LA TRANSACCION
        $this->db->beginTransaction();

				// CALCULA EL TAMAÑO DEL ARRAY, PARA EVITAR QUE EL BUCLE SE QUEDE FIRU77
				$tama=count($lineas);
        $save = 0;
        //Recorremos el bucle para leer linea por linea
        foreach ($lineas as $linea_num => $linea){
          if($i != 0){
						// GARANTIZA LA SALIDA DEL BUCLE FIRU77
						if($i == $tama){
							break;
						}

            $datos = explode(";",$linea);
            //Almacenamos los datos que vamos leyendo en una variable
            $guia_master        = trim($datos[0]);
						$guia               = trim($datos[1]);
            $nombre             = utf8_decode(trim($datos[2]));
            $direccion          = utf8_decode(trim($datos[3]));
            $ciudad             = utf8_decode(trim($datos[4]));
            $pais_origen        = trim($datos[5]);
            $valor_declarado    = trim($datos[6]);
            $valor_recaudar     = trim($datos[7]);
            $peso_fisico        = trim($datos[8]);
            $largo              = trim($datos[9]);
            $ancho              = trim($datos[10]);
            $alto               = trim($datos[11]);
            $peso_vol           = trim($datos[12]);
            $peso_tari          = trim($datos[13]);
            $tasa_manejo        = trim($datos[14]);
            $costo_manejo       = trim($datos[15]);
            $valor_total        = trim($datos[16]);
            $descuento_adi      = trim($datos[17]);
            $descuento_servi    = trim($datos[18]);
            $contenido          = trim($datos[19]);
            $referencia         = trim($datos[20]);
            $observaciones      = utf8_decode(trim($datos[21]));
            $locker             = trim($datos[22]);
            $casillero_des      = trim($datos[23]);
            $tamano             = trim($datos[24]);
            $telefono           = trim($datos[25]);
            $email              = trim($datos[26]);
            $cod_postal         = trim($datos[27]);
            $cod_operativo      = trim($datos[28]);
            $cobertura          = utf8_decode(trim($datos[29]));
            $causa_rechazo      = trim($datos[30]);

            $verif = $this->db->prepare("
            SELECT COUNT(*) AS cantidad FROM consolidado_472 WHERE guia LIKE '%$guia%'
            ");
            $verif->execute();
            $verif = $verif->fetch(PDO::FETCH_ASSOC);

            if ($verif["cantidad"] == 0){

              $this->db->exec("
              INSERT INTO `consolidado_472`
              (`guias_master`,`guia`, `nombre_destinatario`, `direccion`, `ciudad`, `pais_origen`, `valor_declarado`, `valor_recaudar`,
              `peso_fisico`, `largo`, `ancho`, `alto`, `peso_volumetrico`, `peso_tarificado`, `Tasa_manejo`,
              `Costo_manejo`, `valor_total`, `descuento_adicional`, `descuento_por_servicio`, `contenido`, `referencia`,
              `observaciones`, `locker`, `casillero_de_destino`, `tamanio`, `telefono`, `email`, `codigo_postal`,
              `codigo_operativo`, `cobertura`, `causa_rechazo`, fecha_admision, id_tipo_envio)
              VALUES('$guia_master','$guia','$nombre','$direccion','$ciudad','$pais_origen','$valor_declarado','$valor_recaudar',
              '$peso_fisico','$largo','$ancho','$alto','$peso_vol','$peso_tari','$tasa_manejo',
              '$costo_manejo','$valor_total','$descuento_adi','$descuento_servi','$contenido','$referencia',
              '$observaciones','$locker','$casillero_des','$tamano','$telefono','$email','$cod_postal',
              '$cod_operativo','$cobertura','$causa_rechazo', '$fecha_admision', '$tipo_envio')
              ");
              $save++;

            }
						//PARTE PARA ASIGNAR NUMERO DE GUIA, EN LA TABLA actuacion_tutela
						//CODIGO ADICICONADO POR JORGE ANDRES VALENCIA 17 DE JUNIO 2019
						//SE CIERRA EL CODIGO PARA REALIZAR UNOS AJUSTES 18 DE JUNIO 2019
						/*$nombre_1              = str_replace ( '"' , ' ' , $nombre);
						$nombre_2              = trim($nombre_1);
						$nombre_destinatario_1 = explode("/",$nombre_2);
						$oficio_telegrama      = end($nombre_destinatario_1);

						$this->db->exec("UPDATE actuacion_tutela SET nunguia = '$guia'
					 WHERE oficio_telegrama = '$oficio_telegrama'");*/

          }
          $i++;
        }

        if ($save > 0){
          $tiporegistro = "IMPORTACION plantilla 472 con guia";
          $accion  = "Registra una Nueva ".$tiporegistro." En el Sistema (CORRESPONDENCIA) REGISTRO DE PLANTILLA 472";
          $detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
  				$tipolog = 2;

          $this->db->exec("
          INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')
          ");
        }

        //SE TERMINA LA TRANSACCION
        $this->db->commit();
				print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=2"</script>';
        }
        catch (Exception $e){
                $this->db->rollback();
                die($e->getMessage());
        }

      }


        public function listar_despachos(){
            $stm = $this->db
                ->prepare(
                    "SELECT * FROM pa_juzgado");
            $stm->execute();
            return $stm;
        }


        public function listar_orden_servicio(){
            $stm = $this->db
                ->prepare(
                    "SELECT * FROM consolidado_472");
            $stm->execute();
            return $stm;
        }


        public function permisos_item_usuario(){
            $listar = $this->db->prepare("SELECT usuario FROM pa_usuario_acciones WHERE id = 16 ORDER BY id");
            $listar->execute();
            return $listar;
		    }


        public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
            $listar     = $this->db->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
            $listar->execute();
            return $listar;

		    }

		public function permisos_subir_doc_472(){
			$listar = $this->db->prepare("SELECT usuario FROM pa_usuario_acciones WHERE id = 17 ORDER BY id");
            $listar->execute();
            return $listar;
		}
		public function listarJuzgados(){
            $listar = $this->db->prepare("SELECT * FROM pa_juzgado");
            $listar->execute();
            return $listar;
        }
        // LISTA JUZGADO USUARIOS CENTRO SERVICIOS //
        public function listarJuzgadosUSCS($id_us){
            $listar = $this->db->prepare("SELECT * FROM pa_juzgado WHERE idusuariojuzgado = '$id_us'");
            $listar->execute();
            return $listar;
        }
        // --------------------  22-09-2017 ----------------------------------------------- //
		public function listar_tipo_envio(){
            $stm = $this->db
                ->prepare("SELECT * FROM correspondencia_tipo_envio");
            $stm->execute();
            return $stm;
        }



		//-------NUEVO PARA ASIGNAR NUMERO DE GUIA, ADICIONADO 6 DE JUNIO 2019, JORGE ANDRES VALENCIA-------
public function asignar_numero_guia_NG(){


		set_time_limit (240000000);

		$modelo     = new correspondenciaModel();

		$idusuario  = $_SESSION['idUsuario'];

		$carpeta    = "CARGAMASIVA";

		//$fechacarga = trim($_POST['fechae_2']);

		//FECHA DE CARGA AL SISTEMA DEL PROCESO
      	//$fechacarga_2 = date("Y-m-d");

		//setlocale(LC_TIME, "Spanish");
		//$fechavisual = strtoupper( strftime('%d %B de %Y', strtotime($fechacarga)) );

		//--------------------------PARA LA TABLA LOG------------------------------------------------

		/*$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];


		$tiporegistro = "PROCESOS DE ".$fechavisual." MASIVO";
		$accion       = "Registra ".$tiporegistro." En el Sistema (SIEPRO)";
		$detalle      = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog      = 1;*/

		//--------------------------------------------------------------------------------------------

		//$tipoarchivo = trim($_POST['tipoarchivo']);

		//CREO EL DIRECTORIO DEL USUARIO QUE NO ES MAS QUE ES CON EL QUE SE LOGEA EL USUARIO
		//$nom = "jvalenciao";
		$nom = trim($_SESSION['idUsuario']);


		//AQUI SE CREA EL DIRECTORIO
		if(is_dir($carpeta."/".$nom)){$bandera=0;}
		else{mkdir($carpeta."/".$nom, 0, true);}

		//datos del arhivo
		$nombre_archivo = $_FILES['archivo']['name'];
		$tipo_archivo   = $_FILES['archivo']['type'];
		//echo $tipo_archivo;
		$tamano_archivo = $_FILES['archivo']['size'];


		if (! (strpos($tipo_archivo, "vnd.ms-excel")) && ($tamano_archivo < 100000000) )  {

			//echo "EXTENSION"."**********";

			echo '<script languaje="JavaScript">


				alert("LA EXTENSION O LA LONGITUD DEL ARCHIVO NO ES CORRECTA");

				location.href="index.php?controller=correspondencia&action=Asignar_Numero_Guia";

			</script>';


		}
		else{//1



			if ( file_exists($carpeta."/".$nom.'/'.$nombre_archivo) ) {


				$idunico = time();

				$nombre_archivo = $idunico."_".$nombre_archivo;


			}


			if ( move_uploaded_file($_FILES['archivo']['tmp_name'], $carpeta."/".$nom.'/'.$nombre_archivo) ){

				$lineas = file( $carpeta."/".$nom.'/'.$nombre_archivo,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
				$long   = count($lineas);


				//OBETNER SEPARAR DE LOS REGISTROS YA QUE EN UNOS EQUIPOS DE COMPUTO ES ---> COMA(,)
				//Y EN OTROS ---> PUNTO Y COMA (;)
				//$separador = $modelo->Obtener_Separador( trim($lineas[1]) );



				try {

						$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

						//EMPIEZA LA TRANSACCION
						$this->db->beginTransaction();


								/*$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog)
												 VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");*/


								//ASI CUANDO EL ARCHIVO NO TIENE ENCABEZADOS
								$i=1;//PARA NO TOMAR LOS ENCABEZADOS
								$bandera_guia = 0;

								while($i < $long){

									//echo $lineas[$i]."\n";

									//ASI CUANDO EL ARCHIVO ESTA SEPARADO POR COMAS
									//$fila = explode(",",$lineas[$i]);

									//ASI CUANDO EL ARCHIVO ESTA SEPARADO POR PUNTO Y COMA
									$fila = explode(";",$lineas[$i]);

									//$fila = explode($separador,$lineas[$i]);


									$nunguia             = trim($fila[1]);
									//$nombre_destinatario = utf8_encode(trim($fila[2]));
									$nombre_destinatario = trim($fila[2]);


									/*$cadena_de_texto       = $nombre_destinatario;
									$cadena_buscada        = 'CORTE CONSTITUCIONAL';
									$posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada);

									//se puede hacer la comparacion con 'false' o 'true' y los comparadores '===' o '!=='
									if ($posicion_coincidencia === false) {
										//echo "NO se ha encontrado la palabra deseada!!!!";
										$bandera_guia = 1;
									}
									else {*/

										//echo "�xito!!! Se ha encontrado la palabra buscada en la posici�n: ".$posicion_coincidencia;
										$nombre_destinatario_1 = explode("/",$nombre_destinatario);
										$oficio_telegrama      = end($nombre_destinatario_1);


										$this->db->exec("UPDATE actuacion_tutela SET nunguia = '$nunguia'
														 WHERE oficio_telegrama = '$oficio_telegrama'");




									//}





									$i= $i + 1;

								}//FIN WHILE while($i < $long){


							//SE TERMINA LA TRANSACCION
							$this->db->commit();


							echo '<script languaje="JavaScript">


									alert("PROCESO SE REALIZA CORRECTAMENTE");

									location.href="index.php?controller=correspondencia&action=Asignar_Numero_Guia";

								</script>';



				}
				catch (Exception $e) {

					//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
					$this->db->rollBack();

					//echo "Fallo: " . $e->getMessage();


					echo '<script languaje="JavaScript">


							var ERROR = "'.$e->getMessage()." REGISTROS ARCHIVO: ".$long.'";

							alert("ERROR 2: "+ERROR);

							location.href="index.php?controller=correspondencia&action=Asignar_Numero_Guia";

						</script>';


				}




			}




		}//FIN ELSE 1



}//FIN FUNCION

public function get_fecha_actual_amd(){


		//FORMA WIN 7 Y 8, YA QUE DE LA FORMA ANTERIOR TOMA EL AM O PM Y DA CONFLICTOS PARA
		//GUARDAR EN LA BASE DE DATOS EN ESTE CASO LA TABLA detalle_correspondencia
		//CAMPO fecha QUE ES DATETIME
		date_default_timezone_set('America/Bogota');
		$fecharegistro=date('Y-m-d'); //FORMA PARA XP
		//$fecharegistro = date('Y-m-d g:i');

		return $fecharegistro;


}

//-------FIN NUEVO PARA ASIGNAR NUMERO DE GUIA, ADICIONADO 6 DE JUNIO 2019, JORGE ANDRES VALENCIA-------


}
?>
