<?php
class excelModel extends modelBase
{
	//---------------------------------------------------------------------------------------------		
	/*------------------------------DATOS EMPLEADO INGRESOS - SALIDAS---------------------------------------*/
	/*public function Datos_Empleado_Ingreso_Salida($fd,$fh){
		//ini_set('max_execution_time', 240); //240 segundos = 4 minutos
		$idusuario = $_SESSION['idUsuario'];
		if( empty($fd) && empty($fh) ){//GENERA EN EXCEL TODAS LOS REGISTROS 
			$listar = $this->db->prepare("SELECT usu.empleado as usuario, em.fecha, em.hora, em.tipo, em.observaciones 
										  FROM empleado_control em
										  INNER JOIN pa_usuario usu ON (em.idusuario = usu.id)
										  WHERE em.idusuario = '$idusuario'
										  ORDER BY em.id DESC");
		}
		else{
			//$fd = $fd.' 00:00:00';
			//$fh = $fh.' 23:59:59';
			$listar = $this->db->prepare("SELECT usu.empleado as usuario, em.fecha, em.hora, em.tipo, em.observaciones 
										  FROM empleado_control em
										  INNER JOIN pa_usuario usu ON (em.idusuario = usu.id)
									      WHERE em.idusuario = '$idusuario' AND (em.fecha >= '$fd' AND em.fecha <= '$fh')
										  ORDER BY em.id DESC"); 
		
		}
		$listar->execute(); 
		return $listar; 
   }  	
   public function Datos_Empleado_Ingreso_Salida_Completo($usuarioc,$fdc,$fhc){
			//ini_set('max_execution_time', 240); //240 segundos = 4 minutos
			$filtrox;
			$filtro1;
			$filtro2;	
			if ( !empty($usuarioc) ) {
				$filtro1 = " AND em.idusuario = '$usuarioc' ";
			}
			if ( !empty($fdc) && !empty($fhc) ) {
				$filtro2 = " AND (em.fecha >= '$fdc' AND em.fecha <= '$fhc') ";
			}
			$filtrox = $filtro1." ".$filtro2;
			//echo $filtrox;
			//SE COLOCA ep.id >= '1' PARA QUE LOS FILTROS ANTERIORES EMPIEZEN CON EL (AND) Y NO SE TENGA QUE DEFINIR
			//CUAL DE LOS FILTROS VA PRIMERO SI NO SE DEFINE ALGUNO YA QUE QUEDARIA ALGO COMO WHERE AND FILTRO, 
			//Y YA QUE EL CAMPO ep.id ES UN VALOR AUTONUMERICO QUE EMPIEZA EN 1 LA PREGUNTA ep.id >= '1' 
			//SIEMPRE VA A CONCORDAR MAS EL FILTRO QUE SE ASIGNE.
			$listar    = $this->db->prepare("SELECT usu.empleado as usuario, em.fecha, em.hora, em.tipo, em.ipequipo, em.nombreequipo,em.observaciones 
										     FROM empleado_control em
										     INNER JOIN pa_usuario usu ON (em.idusuario = usu.id)
										     WHERE em.id >= '1'" .$filtrox. " ORDER BY em.id DESC");
  			$listar->execute();
  			return $listar;
   }  	
   
   public function Datos_Empleado_Permisos($fd,$fh){
		
		$idusuario = $_SESSION['idUsuario'];
		if( empty($fd) && empty($fh) ){
			$listar    = $this->db->prepare("SELECT ep.id,usu.empleado,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle,ep.estado,
											  CASE
												  WHEN
													  (ep.hora_inicio >= '07:00' AND ep.hora_inicio <= '12:00') AND (ep.hora_final >= '14:00' AND ep.hora_final <= '23:00')
													  THEN
														TIMEDIFF( TIMEDIFF(ep.hora_final,ep.hora_inicio),'2:00')
													  ELSE
														TIMEDIFF(ep.hora_final,ep.hora_inicio)
												END
												AS duracion
												FROM (empleado_permiso ep INNER JOIN pa_usuario usu ON ep.idusuario = usu.id) 
										        WHERE ep.idusuario = '$idusuario'
										 	    ORDER BY ep.id DESC");
		}
		else{
			$listar    = $this->db->prepare("SELECT ep.id,usu.empleado,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle,ep.estado, CASE WHEN (ep.hora_inicio >= '07:00' AND ep.hora_inicio <= '12:00') AND (ep.hora_final >= '14:00' AND ep.hora_final <= '23:00') THEN TIMEDIFF( TIMEDIFF(ep.hora_final,ep.hora_inicio),'2:00') ELSE TIMEDIFF(ep.hora_final,ep.hora_inicio) END AS duracion FROM (empleado_permiso ep INNER JOIN pa_usuario usu ON ep.idusuario = usu.id)  WHERE ep.idusuario = '$idusuario' AND (ep.fecha_solicitud >= '$fd' AND ep.fecha_solicitud <= '$fh') ORDER BY ep.id DESC");
		}
		$listar->execute();
		return $listar; 
   }*/

   /*public function Datos_Permisos_AprobadosNoAprobadosEnProceso($usuariop,$fdp,$fhp,$estadop){
			$filtrox;
			$filtro1;
			$filtro2;
			$filtro3;
			if ( !empty($usuariop) ) {
				$filtro1 = " AND ep.idusuario = '$usuariop' ";
			}
			if ( !empty($fdp) && !empty($fhp) ) {
				$filtro2 = " AND (ep.fecha_solicitud >= '$fdp' AND ep.fecha_solicitud <= '$fhp') ";
			}
			
			if ( $estadop != '') {
				$filtro3 = " AND ep.estado = '$estadop' ";
			}
			$filtrox = $filtro1." ".$filtro2." ".$filtro3;
			
			$listar    = $this->db->prepare("SELECT ep.id,pu.empleado,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle,ep.estado, CASE WHEN (ep.hora_inicio >= '07:00' AND ep.hora_inicio <= '12:00') AND (ep.hora_final >= '14:00' AND ep.hora_final <= '23:00') THEN TIMEDIFF( TIMEDIFF(ep.hora_final,ep.hora_inicio),'2:00') ELSE TIMEDIFF(ep.hora_final,ep.hora_inicio) END AS duracion, TIMESTAMPDIFF(MINUTE , concat(ep.fecha_permiso,' ',ep.hora_inicio), concat(ep.fecha_permiso,' ',ep.hora_final) )/60 AS duracion_m FROM (empleado_permiso ep INNER JOIN pa_usuario pu ON ep.idusuario = pu.id) WHERE ep.id >= '1'" .$filtrox. " ORDER BY ep.id DESC");
  		$listar->execute();
  		return $listar;
   }  		*/	
  /* public function Datos_ConsolidadoPermisos($usuariop,$fdp,$fhp,$estadop){
			$filtrox;
			$filtro1;
			$filtro2;
			$filtro3;
			if ( !empty($usuariop) ) {
				$filtro1 = " AND ep.idusuario = '$usuariop'";
			}
			if ( !empty($fdp) && !empty($fhp) ) {
				$filtro2 = " AND (ep.fecha_solicitud >= '$fdp' AND ep.fecha_solicitud <= '$fhp') ";
			}
			if ( $estadop != '') {
				$filtro3 = " AND ep.estado = '$estadop' ";
			}
			$filtrox = $filtro1." ".$filtro2." ".$filtro3;						 
			$listar    = $this->db->prepare("SELECT ep.idusuario,pu.nombre_usuario,pu.empleado,COUNT(*) AS numeropermisos
											 FROM (empleado_permiso ep INNER JOIN pa_usuario pu ON ep.idusuario = pu.id)
											 WHERE ep.id >= '1'" .$filtrox. " AND ep.estado = '1'
											 GROUP BY ep.idusuario
											 HAVING COUNT(*) >= 1
											 ORDER BY pu.empleado");
  		$listar->execute();
  		return $listar;
   }  	*/
   
		
  /*------------------------------ Juzgados de acuerdo al área seleccionada ---------------------------------------*/
  /***********************************************************************************/
  /*public function listarAreasJuzgados()
  {
	  $area =  $_POST['juzgado'];
	  $area1 = explode('-',$area);
	  $area2 = $area1[0];
	  $i = 1;
	  $listar = $this->db->prepare("select * from pa_juzgado where idarea ='$area2' ");
	  $listar->execute();
	  while($idE = $listar->fetch())
		{
			$vector[$i]=$idE[nombre];
			$i= $i+1;
		}
	  return $vector;
  }	*/

/************************ Se obtiene un vector de oficios *************************************
************************************ en una fecha ************************************/
	
	public function obtenerOficios()
	{
		$fecha   = $_POST['fechai'];
		$fechaf   = $_POST['fechaf'];
		$juzgado = $_POST['todos'];
		$cont= $_POST['contador'];
		$c =$index=0;
		if(!isset($juzgado))
		{
		 while($c<$cont)
		 {
		  if(isset($_POST['juz'.$c]))
		  {
		   $campo_l= $_POST['juz'.$c];
		   
		   $lista_juzgados[$index]=$campo_l;
		   $index++;
		  }
		  $c++;
		 
		 }
		}
		//print_r($lista_juzgados);
		$cont_list = count($lista_juzgados);
		$r=0;
		$temp = $cont_list-1;
		while($r<$cont_list)
		{
		 if($r!=$temp)
		 {
		  $lista = $lista.$lista_juzgados[$r].",";
		 }
		 else
		 {
		  $lista = $lista.$lista_juzgados[$r];
		 }
		 $r++;
		}
		$lista = '('.$lista.')';
		
	if($juzgado=='Todos'){	
		$oficios = $this->db->prepare("select concat(correspondencia_otros.destinatario,' ',radicado,'/',correspondencia_otros.oficio_telegrama) as nomdestino,concat(pa_municipio.nombre,' - ',pa_departamento.nombre) as ciudad,correspondencia_otros.direccion as direccion,CONCAT( pa_juzgado.nombre,  '/', pa_juzgado.cod_usuario_juzgado ) AS observaciones from correspondencia_otros inner join pa_municipio  on (pa_municipio.id=correspondencia_otros.idmunicipio) inner join pa_departamento on (pa_departamento.id=pa_municipio.iddepartamento) inner join pa_juzgado on (pa_juzgado.id=correspondencia_otros.idjuzgado) where correspondencia_otros.esOficio_Telegrama='Oficio' and (correspondencia_otros.fecha   BETWEEN '$fecha' and '$fechaf' ) and correspondencia_otros.idmedionotificacion in (1,3,6) ORDER BY correspondencia_otros.oficio_telegrama");
       }
	   else
	    {
		 $oficios = $this->db->prepare("select concat(correspondencia_otros.destinatario,' ',radicado,'/',correspondencia_otros.oficio_telegrama) as nomdestino,concat(pa_municipio.nombre,' - ',pa_departamento.nombre) as ciudad,correspondencia_otros.direccion as direccion,CONCAT( pa_juzgado.nombre,  '/', pa_juzgado.cod_usuario_juzgado ) AS observaciones from correspondencia_otros inner join pa_municipio  on (pa_municipio.id=correspondencia_otros.idmunicipio) inner join pa_departamento on (pa_departamento.id=pa_municipio.iddepartamento) inner join pa_juzgado on (pa_juzgado.id=correspondencia_otros.idjuzgado) where correspondencia_otros.esOficio_Telegrama='Oficio' and (correspondencia_otros.fecha   BETWEEN '$fecha' and '$fechaf') and correspondencia_otros.idmedionotificacion in (1,3,6) and correspondencia_otros.idjuzgado in $lista ORDER BY correspondencia_otros.oficio_telegrama");		
		}
		$oficios->execute();
		$i=0;
		$j=0;
		while($idE = $oficios->fetch())
		{
			$vector[$i][nomdestino]=$idE[nomdestino];
			$vector[$i][ciudad]=$idE[ciudad];
			$vector[$i][direccion]=$idE[direccion];
			$vector[$i][observaciones]=$idE[observaciones];
			$i= $i+1;
		}
		//print_r($vector);
	if($juzgado=='Todos'){			
	$oficios1 = $this->db->prepare("select concat(acc.accionante_accionado_vinculado,' ',ct.radicado,'/',actuacion.oficio_telegrama) as nomdestino,concat(pa_municipio.nombre,' - ',pa_departamento.nombre) as ciudad,actuacion.direccion as direccion,CONCAT( pa_juzgado.nombre,  '/', pa_juzgado.cod_usuario_juzgado ) AS observaciones from actuacion_tutela as actuacion inner join accionante_accionado_vinculado as acc ON (actuacion.idaccionado_vinculado_accionante_tut=acc.id) inner join correspondencia_tutelas ct ON (ct.id=acc.idcorrespondencia_tutelas) inner join pa_municipio  on (pa_municipio.id=actuacion.idmunicipio) inner join pa_departamento on (pa_departamento.id=pa_municipio.iddepartamento) inner join pa_juzgado on (pa_juzgado.id=ct.idjuzgado) where actuacion.esOficio_Telegrama='Oficio' and (actuacion.fecha_envio BETWEEN '$fecha' and '$fechaf') and actuacion.idmedionotificacion in (1,3,6) ORDER BY actuacion.oficio_telegrama");
    }
	else
	{
	$oficios1 = $this->db->prepare("select concat(acc.accionante_accionado_vinculado,' ',ct.radicado,'/',actuacion.oficio_telegrama) as nomdestino,concat(pa_municipio.nombre,' - ',pa_departamento.nombre) as ciudad,actuacion.direccion as direccion,CONCAT( pa_juzgado.nombre,  '/', pa_juzgado.cod_usuario_juzgado ) AS observaciones from actuacion_tutela as actuacion inner join accionante_accionado_vinculado as acc ON (actuacion.idaccionado_vinculado_accionante_tut=acc.id) inner join correspondencia_tutelas ct ON (ct.id=acc.idcorrespondencia_tutelas) inner join pa_municipio  on (pa_municipio.id=actuacion.idmunicipio) inner join pa_departamento on (pa_departamento.id=pa_municipio.iddepartamento) inner join pa_juzgado on (pa_juzgado.id=ct.idjuzgado) where actuacion.esOficio_Telegrama='Oficio' and (actuacion.fecha_envio BETWEEN '$fecha' and '$fechaf') and actuacion.idmedionotificacion in (1,3,6) and ct.idjuzgado in  $lista  ORDER BY actuacion.oficio_telegrama");
	}
		$oficios1->execute();
		while($idE2 = $oficios1->fetch())
		{
			$vector[$i][nomdestino]=$idE2[nomdestino];
			$vector[$i][ciudad]=$idE2[ciudad];
			$vector[$i][direccion]=$idE2[direccion];
			$vector[$i][observaciones]=$idE2[observaciones];
			$i= $i+1;
		}
		//print_r($vector);	
		return $vector;
	}
/************************ Se obtiene un vector de telegramas *************************************
************************************ en una fecha ************************************/
	
	public function obtenerTelegramas()
	{	
		$fecha   = $_POST['fechai'];
		$fechaf   = $_POST['fechaf'];
		$juzgado = $_POST['todos'];
		$cont= $_POST['contador'];
		$c =$index=0;
		if(!isset($juzgado))
		{
		 while($c<$cont)
		 {  
		  if(isset($_POST['juz'.$c]))
		  {
		   $campo_l= $_POST['juz'.$c]; 
		   $lista_juzgados[$index]=$campo_l;
		   $index++;
		  }
		  $c++;
		 }
		}
		//print_r($lista_juzgados);
		$cont_list = count($lista_juzgados);
		$r=0;
		$temp = $cont_list-1;
		while($r<$cont_list)
		{
		 if($r!=$temp)
		 {
		  $lista = $lista.$lista_juzgados[$r].",";
		 }
		 else
		 {
		  $lista = $lista.$lista_juzgados[$r];
		 }
		 $r++;
		}
		$lista = '('.$lista.')';
		
		if($juzgado=='Todos'){			
		$telegramas = $this->db->prepare("select concat(correspondencia_otros.destinatario,' ',radicado,'/',correspondencia_otros.oficio_telegrama) as nomdestino,concat(pa_municipio.nombre,' - ',pa_departamento.nombre) as ciudad,correspondencia_otros.direccion as direccion,pa_juzgado.nombre as observaciones from correspondencia_otros inner join pa_municipio  on (pa_municipio.id=correspondencia_otros.idmunicipio) inner join pa_departamento on (pa_departamento.id=pa_municipio.iddepartamento)inner join pa_juzgado on (pa_juzgado.id=correspondencia_otros.idjuzgado) where correspondencia_otros.esOficio_Telegrama='Telegrama' and (correspondencia_otros.fecha  BETWEEN '$fecha' and '$fechaf') and correspondencia_otros.idmedionotificacion in (1,3,6) ORDER BY correspondencia_otros.oficio_telegrama");
      }
  else
  {
  $telegramas = $this->db->prepare("select concat(correspondencia_otros.destinatario,' ',radicado,'/',correspondencia_otros.oficio_telegrama) as nomdestino,concat(pa_municipio.nombre,' - ',pa_departamento.nombre) as ciudad,correspondencia_otros.direccion as direccion,pa_juzgado.nombre as observaciones from correspondencia_otros inner join pa_municipio on (pa_municipio.id=correspondencia_otros.idmunicipio) inner join pa_departamento on (pa_departamento.id=pa_municipio.iddepartamento) inner join pa_juzgado on (pa_juzgado.id=correspondencia_otros.idjuzgado) where correspondencia_otros.esOficio_Telegrama='Telegrama' and (correspondencia_otros.fecha  BETWEEN '$fecha' and '$fechaf') and correspondencia_otros.idmedionotificacion in (1,3,6) and correspondencia_otros.idjuzgado in $lista  ORDER BY correspondencia_otros.oficio_telegrama");
  }
		$telegramas->execute();
		$i=0;
		$j=0;
		while($idE = $telegramas->fetch())
		{
			$vector[$i][nomdestino]=$idE[nomdestino];
			$vector[$i][ciudad]=$idE[ciudad];
			$vector[$i][direccion]=$idE[direccion];
			$vector[$i][observaciones]=$idE[observaciones];
			$i= $i+1;
		}	
	if($juzgado=='Todos'){			
		$telegramas1 = $this->db->prepare("select concat(acc.accionante_accionado_vinculado,' ',ct.radicado,'/',actuacion.oficio_telegrama) as nomdestino,concat(pa_municipio.nombre,' - ',pa_departamento.nombre) as ciudad,actuacion.direccion as direccion,pa_juzgado.nombre as observaciones from actuacion_tutela as actuacion inner join accionante_accionado_vinculado as acc ON (actuacion.idaccionado_vinculado_accionante_tut=acc.id) inner join correspondencia_tutelas ct ON (ct.id=acc.idcorrespondencia_tutelas)
inner join pa_municipio  on (pa_municipio.id=actuacion.idmunicipio) inner join pa_departamento on (pa_departamento.id=pa_municipio.iddepartamento) inner join pa_juzgado on (pa_juzgado.id=ct.idjuzgado) where actuacion.esOficio_Telegrama='Telegrama' and (actuacion.fecha_envio  BETWEEN '$fecha' and '$fechaf') and actuacion.idmedionotificacion in (1,3,6) ORDER BY correspondencia_otros.oficio_telegrama");
}
else
{
$telegramas1 = $this->db->prepare("select concat(acc.accionante_accionado_vinculado,' ',ct.radicado,'/',actuacion.oficio_telegrama) as nomdestino,concat(pa_municipio.nombre,' - ',pa_departamento.nombre) as ciudad,actuacion.direccion as direccion,pa_juzgado.nombre as observaciones from actuacion_tutela as actuacion inner join accionante_accionado_vinculado as acc ON (actuacion.idaccionado_vinculado_accionante_tut=acc.id) inner join correspondencia_tutelas ct ON (ct.id=acc.idcorrespondencia_tutelas)
inner join pa_municipio  on (pa_municipio.id=actuacion.idmunicipio) inner join pa_departamento on (pa_departamento.id=pa_municipio.iddepartamento) inner join pa_juzgado on (pa_juzgado.id=ct.idjuzgado) where actuacion.esOficio_Telegrama='Telegrama' and (actuacion.fecha_envio  BETWEEN '$fecha' and '$fechaf') and actuacion.idmedionotificacion in (1,3,6) and ct.idjuzgado in $lista ORDER BY correspondencia_otros.oficio_telegrama");
}
		$telegramas1->execute();		
		while($idE2 = $telegramas1->fetch())
		{
			$vector[$i][nomdestino]=$idE2[nomdestino];
			$vector[$i][ciudad]=$idE2[ciudad];
			$vector[$i][direccion]=$idE2[direccion];
			$vector[$i][observaciones]=$idE2[observaciones];
			$i= $i+1;
		}
		//print_r $vector;			
		return $vector;
	}
  /*------------------------------ obtener tutelas radicadas rango fecha ---------------------------------------*/
  /***********************************************************************************/
  /*public function listarradicadosTutelas()
  {
  $fechai   = $_POST['fechai'];
  $fechaf  =  $_POST['fechaf'];
  $i=0;
	  $listar = $this->db->prepare("select juz.id as idjuzgado,juz.idarea,juz.nombre as juznombre,are.nombre as nomarea,count(juz.id) as cantidad_tutelas from correspondencia_tutelas ct inner join pa_juzgado juz on (juz.id=ct.idjuzgado) inner join pa_area are on (juz.idarea=are.id) where ct.Tutela_Incidente='Tutela' and  ct.fecha BETWEEN '$fechai' and '$fechaf' group by juz.id order by juz.idarea,juz.id");
	  $listar->execute();
	  while($idE = $listar->fetch())
		{
			$i=$idE[idjuzgado];
			$vector[$i][idjuzgado]=$i;
			$vector[$i][idarea]=$idE[idarea];
			$vector[$i][nomarea]=$idE[nomarea];
			$vector[$i][juznombre]=$idE[juznombre];
			$vector[$i][cantidad_tutelas]=$idE[cantidad_tutelas];	
		}
  $listar1 = $this->db->prepare("select DISTINCT ct.radicado,ct.Tutela_Incidente,actu.tipo_actuacion, juz.id as idjuzgado ,juz.idarea,juz.nombre as juznombre, count(ct.radicado) as cantidad_tutelas from correspondencia_tutelas ct  inner join accionante_accionado_vinculado acc on (acc.idcorrespondencia_tutelas=ct.id) inner join actuacion_tutela actu on (actu.idaccionado_vinculado_accionante_tut=acc.id) inner join pa_juzgado juz on (juz.id=ct.idjuzgado) where ct.Tutela_Incidente='Incidente' and actu.tipo_actuacion='Tutela' and actu.fecha_envio BETWEEN '$fechai' and '$fechaf' group by juz.id order by juz.idarea, juz.id");
	  $listar1->execute();
	  while($idE1 = $listar1->fetch())
		{
			$i=$idE1[idjuzgado];
			$vector[$i][cantidad_tutelas];
			$vector[$i][cantidad_tutelas]=$vector[$i][cantidad_tutelas]+$idE1[cantidad_tutelas];	
		}
$listar2 = $this->db->prepare("select  actu.tipo_actuacion, juz.id as idjuzgado ,juz.idarea,juz.nombre as juznombre,  count(actu.idmedionotificacion) as cantidad_tutelas, medio.nombre as medio from correspondencia_tutelas ct  inner join accionante_accionado_vinculado acc on (acc.idcorrespondencia_tutelas=ct.id) inner join actuacion_tutela actu on (actu.idaccionado_vinculado_accionante_tut=acc.id) inner join pa_juzgado juz on (juz.id=ct.idjuzgado) inner join pa_medionotificacion medio ON (actu.idmedionotificacion=medio.id) where actu.tipo_actuacion='Tutela' and  actu.fecha_envio BETWEEN '$fechai' and '$fechaf'
group by juz.id,medio.id order by juz.idarea, juz.id;");
	  $listar2->execute();
	  	  while($idE2 = $listar2->fetch())
		{
			$i=$idE2[idjuzgado];
			$nombre=$idE2[medio];
		    if($nombre=='Correo Electronico')
			  $nombre='correo_electronico';
			  if($nombre=='Fax - Correo')
			  $nombre='fax_correo';
			    if($nombre==' Fax-Correo-Correo Electronico')
			  $nombre='fax_correo_correoelectronico';
			$vector[$i][$nombre]=$idE2[cantidad_tutelas];	
		}
return $vector; 
  }*/
  /*------------------------------ obtener incidentes radicadas rango fecha ---------------------------------------*/
  /***********************************************************************************/
 /* public function listarradicadosIncidentes()
  {
  $fechai   = $_POST['fechai'];
  $fechaf  =  $_POST['fechaf'];
  $i=0;  
	  $listar = $this->db->prepare("select juz.id as idjuzgado,juz.idarea,juz.nombre as juznombre,are.nombre as nomarea,count(juz.id) as cantidad_tutelas from correspondencia_tutelas ct inner join pa_juzgado juz on (juz.id=ct.idjuzgado) inner join pa_area are on (juz.idarea=are.id) where ct.Tutela_Incidente='Incidente' and  ct.fecha BETWEEN '$fechai' and '$fechaf' group by juz.id order by juz.idarea,juz.id");
	  $listar->execute();
	  while($idE = $listar->fetch())
		{
			$i=$idE[idjuzgado];
			$vector[$i][idjuzgado]=$i;
			$vector[$i][idarea]=$idE[idarea];
			$vector[$i][nomarea]=$idE[nomarea];
			$vector[$i][juznombre]=$idE[juznombre];
			$vector[$i][cantidad_incidentes]=$idE[cantidad_tutelas];	
		}
  $listar1 = $this->db->prepare("select DISTINCT ct.radicado,ct.Tutela_Incidente,actu.tipo_actuacion, juz.id as idjuzgado ,juz.idarea,juz.nombre as juznombre, count(ct.radicado) as cantidad_tutelas from correspondencia_tutelas ct  inner join accionante_accionado_vinculado acc on (acc.idcorrespondencia_tutelas=ct.id) inner join actuacion_tutela actu on (actu.idaccionado_vinculado_accionante_tut=acc.id) inner join pa_juzgado juz on (juz.id=ct.idjuzgado) where ct.Tutela_Incidente='Tutela' and actu.tipo_actuacion='Incidente' and actu.fecha_envio BETWEEN '$fechai' and '$fechaf' group by juz.id order by juz.idarea, juz.id");
	  $listar1->execute();
	  while($idE1 = $listar1->fetch())
		{
			$i=$idE1[idjuzgado];
			$vector[$i][cantidad_incidentes]=$vector[$i][cantidad_incidentes]+$idE1[cantidad_tutelas];	
		}
		$listar2 = $this->db->prepare("select  actu.tipo_actuacion, juz.id as idjuzgado ,juz.idarea,juz.nombre as juznombre,count(actu.idmedionotificacion) as cantidad_tutelas, medio.nombre as medio from correspondencia_tutelas ct  inner join accionante_accionado_vinculado acc on (acc.idcorrespondencia_tutelas=ct.id) inner join actuacion_tutela actu on (actu.idaccionado_vinculado_accionante_tut=acc.id) inner join pa_juzgado juz on (juz.id=ct.idjuzgado) inner join pa_medionotificacion medio ON (actu.idmedionotificacion=medio.id) where actu.tipo_actuacion='Incidente' and  actu.fecha_envio BETWEEN '$fechai' and '$fechaf' group by juz.id,medio.id order by juz.idarea, juz.id;");
	  $listar2->execute();
	  	  while($idE2 = $listar2->fetch())
		{
			$i=$idE2[idjuzgado];
			$nombre=$idE2[medio];
			if($nombre=='Correo Electronico')
			  $nombre='correo_electronico';
			  if($nombre=='Fax - Correo')
			  $nombre='fax_correo';
			    if($nombre==' Fax-Correo-Correo Electronico')
			  $nombre='fax_correo_correoelectronico';			 
			$vector[$i][$nombre]=$idE2[cantidad_tutelas];	
		}
return $vector; 
  }*/
 }
require ('views/PHPExcel-develop/Classes/PHPExcel.php');
//PARA EMPLEADOS INGRESOS Y SALIDAS COMPLETO
/*$datos_reportecompletosalidaentrada = explode("//////////",trim($_GET['datos_reportecompletosalidaentrada']));
$id_reportec = $datos_reportecompletosalidaentrada[0];
$usuarioc    = $datos_reportecompletosalidaentrada[1];
$fdc         = $datos_reportecompletosalidaentrada[2];  
$fhc         = $datos_reportecompletosalidaentrada[3];*/
//PARA EMPLEADOS INGRESOS Y SALIDAS
/*$datos_reporte = explode("//////////",trim($_GET['datos_reporte']));
$id_reporte = $datos_reporte[0];
$fd         = $datos_reporte[1];  
$fh         = $datos_reporte[2];*/
//PARA PERMISOS DE USUARIO
/*$datos_reportepermiso = explode("//////////",trim($_GET['datos_reportepermiso']));
$id_reportep = $datos_reportepermiso[0];
$usuariop    = $datos_reportepermiso[1];
$fdp         = $datos_reportepermiso[2];  
$fhp         = $datos_reportepermiso[3];
$estadop     = $datos_reportepermiso[4];*/

$t_reporte =$_GET['nombre']; 
//REPORTE 4-72
if($t_reporte==1)
{
$cacheSettings = array( 'memoryCacheSize' => '8MB');
$data= new excelModel();
$data1= new excelModel();
$vector_datos= $data->obtenerOficios();
$cont = count($vector_datos);
$vector_datos_telegramas= $data1->obtenerTelegramas();
$cont_tele = count($vector_datos_telegramas);

//print_r($vector_datos);
$objPHPExcel = new PHPExcel();
// Establecer propiedades
$objPHPExcel->getProperties()
->setCreator("Centro de Servicios")
->setLastModifiedBy("Centro de Servicios")
->setTitle("Documento Excel")
->setSubject("Documento Excel")
->setDescription("Documento Excel")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Documento Excel");

$styleArray = array(
'font' => array(
'bold' => true
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
// Agregar Informacion
$sheet1=$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'Nombre destinatario')
->setCellValue('B1', 'Ciudad')
->setCellValue('C1', utf8_encode('Dirección'))
->setCellValue('D1', utf8_encode('Teléfono'))
->setCellValue('E1', 'Peso')
->setCellValue('F1', 'Contenido')
->setCellValue('G1', 'Observaciones');
//->setCellValue('C2', '=sum(A2:B2)');
$sheet1->getStyle('A1')->applyFromArray($styleArray);
$sheet1->getStyle('B1')->applyFromArray($styleArray);
$sheet1->getStyle('C1')->applyFromArray($styleArray);
$sheet1->getStyle('D1')->applyFromArray($styleArray);
$sheet1->getStyle('E1')->applyFromArray($styleArray);
$sheet1->getStyle('F1')->applyFromArray($styleArray);
$sheet1->getStyle('G1')->applyFromArray($styleArray);
$sheet1->getStyle('A1:G1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'FFFF00'),
            'endcolor' => array('rgb' => 'FFFF00')
            )
    );
$j=0;
$i=2;
while($j<$cont)
{
$sheet1->setCellValue('A'.$i, utf8_encode($vector_datos[$j][nomdestino]));
$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('B'.$i, utf8_encode($vector_datos[$j][ciudad]));
$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('C'.$i, utf8_encode($vector_datos[$j][direccion]));
$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('D'.$i, '');
$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('E'.$i, '200');
$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('F'.$i, '');
$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('G'.$i, utf8_encode($vector_datos[$j][observaciones]));
$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);

$j = $j+1;
$i=$i+1;
}

$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize('true');

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('OFICIOS');

$sheet2 = $objPHPExcel->createSheet();
$sheet2->setTitle('TELEGRAMAS');
$sheet2->SetCellValue('A1', 'Nombre destinatario');
$sheet2->setCellValue('B1', 'Ciudad');
$sheet2->setCellValue('C1', utf8_encode('Dirección'));
$sheet2->setCellValue('D1', utf8_encode('Teléfono'));
$sheet2->setCellValue('E1', 'Peso');
$sheet2->setCellValue('F1', 'Contenido');
$sheet2->setCellValue('G1', 'Observaciones');
//->setCellValue('C2', '=sum(A2:B2)');

$sheet2->getStyle('A1')->applyFromArray($styleArray);
$sheet2->getStyle('B1')->applyFromArray($styleArray);
$sheet2->getStyle('C1')->applyFromArray($styleArray);
$sheet2->getStyle('D1')->applyFromArray($styleArray);
$sheet2->getStyle('E1')->applyFromArray($styleArray);
$sheet2->getStyle('F1')->applyFromArray($styleArray);
$sheet2->getStyle('G1')->applyFromArray($styleArray);

$sheet2->getStyle('A1:G1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'FFFF00'),
            'endcolor' => array('rgb' => 'FFFF00')

            )
    );

$j=0;
$i=2;

$sheet2->getStyle('A1:G1')->applyFromArray($borders);
$sheet2->getColumnDimension('A')->setAutoSize('true');
$sheet2->getColumnDimension('B')->setAutoSize('true');
$sheet2->getColumnDimension('C')->setAutoSize('true');
$sheet2->getColumnDimension('D')->setAutoSize('true');
$sheet2->getColumnDimension('E')->setAutoSize('true');
$sheet2->getColumnDimension('F')->setAutoSize('true');
$sheet2->getColumnDimension('G')->setAutoSize('true');

while($j<$cont_tele)
{
$sheet2->setCellValue('A'.$i, utf8_encode($vector_datos_telegramas[$j][nomdestino]));
$sheet2->getStyle('A'.$i)->applyFromArray($borders_nobold);
$sheet2->setCellValue('B'.$i, utf8_encode($vector_datos_telegramas[$j][ciudad]));
$sheet2->getStyle('B'.$i)->applyFromArray($borders_nobold);
$sheet2->setCellValue('C'.$i, utf8_encode($vector_datos_telegramas[$j][direccion]));
$sheet2->getStyle('C'.$i)->applyFromArray($borders_nobold);
$sheet2->setCellValue('D'.$i, '');
$sheet2->getStyle('D'.$i)->applyFromArray($borders_nobold);
$sheet2->setCellValue('E'.$i, '20');
$sheet2->getStyle('E'.$i)->applyFromArray($borders_nobold);
$sheet2->setCellValue('F'.$i, '');
$sheet2->getStyle('F'.$i)->applyFromArray($borders_nobold);
$sheet2->setCellValue('G'.$i, utf8_encode($vector_datos_telegramas[$j][observaciones]));
$sheet2->getStyle('G'.$i)->applyFromArray($borders_nobold);

$j = $j+1;
$i=$i+1;
}

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Planilla_2.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
}
if($t_reporte==2)
{

$data= new excelModel();
$data1= new excelModel();
$fechai = $_POST['fechai'];
$fechaf = $_POST['fechaf'];

$vector_radicados_tutelas= $data->listarradicadosTutelas();
$vector_radicados_incidentes= $data1->listarradicadosIncidentes();
/*
print_r($vector_radicados_tutelas);
echo "<br>";
print_r($vector_radicados_incidentes);*/

$data= new excelModel();
$data1= new excelModel();

$area =  $_POST['juzgado'];
$area1 = explode('-',$area);
$area2 = $area1[1];
$fechai = $_POST['fechai'];
$fechaf = $_POST['fechaf'];
$ind=0;

$orden = array( 0 => 8, 1 => 9,  2 => 10, 3 => 11,  4 => 12,  5 => 13,	6 => 1,  7 => 2,  8 => 3,  9 => 4,  10 => 5,
   11 => 6,  12 => 7,  13 => 14,  14 => 15,  15 => 16,  16 => 17,  17 => 18, 18 => 19,  19 => 20, 20 => 21, 21 => 22,
   22 => 23,  23 => 24,  24 => 25,
    );

//print_r($orden);

$indice =$orden[$ind];
$area= $vector_radicados_tutelas[$indice][nomarea];
$ca1= $vector_radicados_tutelas[8][cantidad_tutelas];
$ca2= $vector_radicados_tutelas[9][cantidad_tutelas];
$ca3= $vector_radicados_tutelas[10][cantidad_tutelas];
$ca4= $vector_radicados_tutelas[11][cantidad_tutelas];
$ca5= $vector_radicados_tutelas[12][cantidad_tutelas];
$ca6= $vector_radicados_tutelas[13][cantidad_tutelas];

$caf1= $vector_radicados_tutelas[1][cantidad_tutelas];
$caf2= $vector_radicados_tutelas[2][cantidad_tutelas];
$caf3= $vector_radicados_tutelas[3][cantidad_tutelas];
$caf4= $vector_radicados_tutelas[4][cantidad_tutelas];
$caf5= $vector_radicados_tutelas[5][cantidad_tutelas];
$caf6= $vector_radicados_tutelas[6][cantidad_tutelas];
$caf7= $vector_radicados_tutelas[7][cantidad_tutelas];

$cam1= $vector_radicados_tutelas[14][cantidad_tutelas];
$cam2= $vector_radicados_tutelas[15][cantidad_tutelas];
$cam3= $vector_radicados_tutelas[16][cantidad_tutelas];
$cam4= $vector_radicados_tutelas[17][cantidad_tutelas];
$cam5= $vector_radicados_tutelas[18][cantidad_tutelas];
$cam6= $vector_radicados_tutelas[19][cantidad_tutelas];
$cam7= $vector_radicados_tutelas[20][cantidad_tutelas];
$cam8= $vector_radicados_tutelas[21][cantidad_tutelas];
$cam9= $vector_radicados_tutelas[22][cantidad_tutelas];
$cam10= $vector_radicados_tutelas[23][cantidad_tutelas];
$cam11= $vector_radicados_tutelas[24][cantidad_tutelas];
$cam12= $vector_radicados_tutelas[25][cantidad_tutelas];

$ci1= $vector_radicados_incidentes[8][cantidad_incidentes];
$ci2= $vector_radicados_incidentes[9][cantidad_incidentes];
$ci3= $vector_radicados_incidentes[10][cantidad_incidentes];
$ci4= $vector_radicados_incidentes[11][cantidad_incidentes];
$ci5= $vector_radicados_incidentes[12][cantidad_incidentes];
$ci6= $vector_radicados_incidentes[13][cantidad_incidentes];

$cif1= $vector_radicados_incidentes[1][cantidad_incidentes];
$cif2= $vector_radicados_incidentes[2][cantidad_incidentes];
$cif3= $vector_radicados_incidentes[3][cantidad_incidentes];
$cif4= $vector_radicados_incidentes[4][cantidad_incidentes];
$cif5= $vector_radicados_incidentes[5][cantidad_incidentes];
$cif6= $vector_radicados_incidentes[6][cantidad_incidentes];
$cif7= $vector_radicados_incidentes[7][cantidad_incidentes];

$cim1= $vector_radicados_incidentes[14][cantidad_incidentes];
$cim2= $vector_radicados_incidentes[15][cantidad_incidentes];
$cim3= $vector_radicados_incidentes[16][cantidad_incidentes];
$cim4= $vector_radicados_incidentes[17][cantidad_incidentes];
$cim5= $vector_radicados_incidentes[18][cantidad_incidentes];
$cim6= $vector_radicados_incidentes[19][cantidad_incidentes];
$cim7= $vector_radicados_incidentes[20][cantidad_incidentes];
$cim8= $vector_radicados_incidentes[21][cantidad_incidentes];
$cim9= $vector_radicados_incidentes[22][cantidad_incidentes];
$cim10= $vector_radicados_incidentes[23][cantidad_incidentes];
$cim11= $vector_radicados_incidentes[24][cantidad_incidentes];
$cim12= $vector_radicados_incidentes[25][cantidad_incidentes];

$correo = array( 0 => $vector_radicados_tutelas[8][Correo]+$vector_radicados_incidentes[8][Correo], 1 => $vector_radicados_tutelas[9][Correo]+$vector_radicados_incidentes[9][Correo],  2 =>$vector_radicados_tutelas[10][Correo]+$vector_radicados_incidentes[10][Correo], 3 => $vector_radicados_tutelas[11][Correo]+$vector_radicados_incidentes[11][Correo],  4 => $vector_radicados_tutelas[12][Correo]+$vector_radicados_incidentes[12][Correo],  5 => $vector_radicados_tutelas[13][Correo]+$vector_radicados_incidentes[13][Correo],  6 => $vector_radicados_tutelas[1][Correo]+$vector_radicados_incidentes[1][Correo],  7 => $vector_radicados_tutelas[2][Correo]+$vector_radicados_incidentes[2][Correo],  8 => $vector_radicados_tutelas[3][Correo]+$vector_radicados_incidentes[3][Correo],  9 => $vector_radicados_tutelas[4][Correo]+$vector_radicados_incidentes[4][Correo],  10 => $vector_radicados_tutelas[5][Correo]+$vector_radicados_incidentes[5][Correo],  11 => $vector_radicados_tutelas[6][Correo]+$vector_radicados_incidentes[6][Correo],  12 => $vector_radicados_tutelas[7][Correo]+$vector_radicados_incidentes[7][Correo],  13 => $vector_radicados_tutelas[14][Correo]+$vector_radicados_incidentes[14][Correo],  14 => $vector_radicados_tutelas[15][Correo]+$vector_radicados_incidentes[15][Correo],  15 => $vector_radicados_tutelas[16][Correo]+$vector_radicados_incidentes[16][Correo],  16 => $vector_radicados_tutelas[17][Correo]+$vector_radicados_incidentes[17][Correo],  17 => $vector_radicados_tutelas[18][Correo]+$vector_radicados_incidentes[18][Correo],  18 => $vector_radicados_tutelas[19][Correo]+$vector_radicados_incidentes[19][Correo],  19 => $vector_radicados_tutelas[20][Correo]+$vector_radicados_incidentes[20][Correo],  20 => $vector_radicados_tutelas[21][Correo]+$vector_radicados_incidentes[21][Correo],  21 => $vector_radicados_tutelas[22][Correo]+$vector_radicados_incidentes[22][Correo],  22 => $vector_radicados_tutelas[23][Correo]+$vector_radicados_incidentes[23][Correo],  23 => $vector_radicados_tutelas[24][Correo]+$vector_radicados_incidentes[24][Correo],  24 => $vector_radicados_tutelas[25][Correo]+$vector_radicados_incidentes[25][Correo]
    );
	
$correo_e = array( 0 => $vector_radicados_tutelas[8][correo_electronico]+$vector_radicados_incidentes[8][correo_electronico], 1 => $vector_radicados_tutelas[9][correo_electronico]+$vector_radicados_incidentes[9][correo_electronico],  2 =>$vector_radicados_tutelas[10][correo_electronico]+$vector_radicados_incidentes[10][correo_electronico], 3 => $vector_radicados_tutelas[11][correo_electronico]+$vector_radicados_incidentes[11][correo_electronico],  4 => $vector_radicados_tutelas[12][correo_electronico]+$vector_radicados_incidentes[12][correo_electronico],  5 => $vector_radicados_tutelas[13][correo_electronico]+$vector_radicados_incidentes[13][correo_electronico],  6 => $vector_radicados_tutelas[1][correo_electronico]+$vector_radicados_incidentes[1][correo_electronico],  7 => $vector_radicados_tutelas[2][correo_electronico]+$vector_radicados_incidentes[2][correo_electronico],  8 => $vector_radicados_tutelas[3][correo_electronico]+$vector_radicados_incidentes[3][correo_electronico],  9 => $vector_radicados_tutelas[4][correo_electronico]+$vector_radicados_incidentes[4][correo_electronico],  10 => $vector_radicados_tutelas[5][correo_electronico]+$vector_radicados_incidentes[5][correo_electronico],  11 => $vector_radicados_tutelas[6][correo_electronico]+$vector_radicados_incidentes[6][correo_electronico],  12 => $vector_radicados_tutelas[7][correo_electronico]+$vector_radicados_incidentes[7][correo_electronico],  13 => $vector_radicados_tutelas[14][correo_electronico]+$vector_radicados_incidentes[14][correo_electronico],  14 => $vector_radicados_tutelas[15][correo_electronico]+$vector_radicados_incidentes[15][correo_electronico],  15 => $vector_radicados_tutelas[16][correo_electronico]+$vector_radicados_incidentes[16][correo_electronico],  16 => $vector_radicados_tutelas[17][correo_electronico]+$vector_radicados_incidentes[17][correo_electronico],  17 => $vector_radicados_tutelas[18][correo_electronico]+$vector_radicados_incidentes[18][correo_electronico],  18 => $vector_radicados_tutelas[19][correo_electronico]+$vector_radicados_incidentes[19][correo_electronico],  19 => $vector_radicados_tutelas[20][correo_electronico]+$vector_radicados_incidentes[20][correo_electronico],  20 => $vector_radicados_tutelas[21][correo_electronico]+$vector_radicados_incidentes[21][correo_electronico],  21 => $vector_radicados_tutelas[22][correo_electronico]+$vector_radicados_incidentes[22][correo_electronico],  22 => $vector_radicados_tutelas[23][correo_electronico]+$vector_radicados_incidentes[23][correo_electronico],  23 => $vector_radicados_tutelas[24][correo_electronico]+$vector_radicados_incidentes[24][correo_electronico],  24 => $vector_radicados_tutelas[25][correo_electronico]+$vector_radicados_incidentes[25][correo_electronico] 
    );	
$fax = array( 0 => $vector_radicados_tutelas[8][Fax]+$vector_radicados_incidentes[8][Fax], 
			  1 => $vector_radicados_tutelas[9][Fax]+$vector_radicados_incidentes[9][Fax],  
			  2 => $vector_radicados_tutelas[10][Fax]+$vector_radicados_incidentes[10][Fax], 
			  3 => $vector_radicados_tutelas[11][Fax]+$vector_radicados_incidentes[11][Fax],  
			  4 => $vector_radicados_tutelas[12][Fax]+$vector_radicados_incidentes[12][Fax],  
			  5 => $vector_radicados_tutelas[13][Fax]+$vector_radicados_incidentes[13][Fax], 
			  6 => $vector_radicados_tutelas[1][Fax]+$vector_radicados_incidentes[1][Fax], 
			  7 => $vector_radicados_tutelas[2][Fax]+$vector_radicados_incidentes[2][Fax],  
			  8 => $vector_radicados_tutelas[3][Fax]+$vector_radicados_incidentes[3][Fax], 
			  9 => $vector_radicados_tutelas[4][Fax]+$vector_radicados_incidentes[4][Fax],  
			  10 => $vector_radicados_tutelas[5][Fax]+$vector_radicados_incidentes[5][Fax],  
			  11 => $vector_radicados_tutelas[6][Fax]+$vector_radicados_incidentes[6][Fax],  
			  12 => $vector_radicados_tutelas[7][Fax]+$vector_radicados_incidentes[7][Fax],
			  13 => $vector_radicados_tutelas[14][Fax]+$vector_radicados_incidentes[14][Fax],
			  14 => $vector_radicados_tutelas[15][Fax]+$vector_radicados_incidentes[15][Fax],
			  15 => $vector_radicados_tutelas[16][Fax]+$vector_radicados_incidentes[16][Fax],
			  16 => $vector_radicados_tutelas[17][Fax]+$vector_radicados_incidentes[17][Fax],
			  17 => $vector_radicados_tutelas[18][Fax]+$vector_radicados_incidentes[18][Fax],
			  18 => $vector_radicados_tutelas[19][Fax]+$vector_radicados_incidentes[19][Fax],
			  19 => $vector_radicados_tutelas[20][Fax]+$vector_radicados_incidentes[20][Fax],
			  20 => $vector_radicados_tutelas[21][Fax]+$vector_radicados_incidentes[21][Fax],
			  21 => $vector_radicados_tutelas[22][Fax]+$vector_radicados_incidentes[22][Fax],
			  22 => $vector_radicados_tutelas[23][Fax]+$vector_radicados_incidentes[23][Fax],
			  23 => $vector_radicados_tutelas[24][Fax]+$vector_radicados_incidentes[24][Fax],
			  24 => $vector_radicados_tutelas[25][Fax]+$vector_radicados_incidentes[25][Fax]			  
    );	

$fax_c = array( 0 => $vector_radicados_tutelas[8][fax_correo]+$vector_radicados_incidentes[8][fax_correo], 
				1 => $vector_radicados_tutelas[9][fax_correo]+$vector_radicados_incidentes[9][fax_correo],  
				2 => $vector_radicados_tutelas[10][fax_correo]+$vector_radicados_incidentes[10][fax_correo], 
				3 => $vector_radicados_tutelas[11][fax_correo]+$vector_radicados_incidentes[11][fax_correo],  
				4 => $vector_radicados_tutelas[12][fax_correo]+$vector_radicados_incidentes[12][fax_correo],  
				5 => $vector_radicados_tutelas[13][fax_correo]+$vector_radicados_incidentes[13][fax_correo], 
				6 => $vector_radicados_tutelas[1][fax_correo]+$vector_radicados_incidentes[1][fax_correo],  
				7 => $vector_radicados_tutelas[2][fax_correo]+$vector_radicados_incidentes[2][fax_correo],  
				8 => $vector_radicados_tutelas[3][fax_correo]+$vector_radicados_incidentes[3][fax_correo],  
				9 => $vector_radicados_tutelas[4][fax_correo]+$vector_radicados_incidentes[4][fax_correo],  
			   10 => $vector_radicados_tutelas[5][fax_correo]+$vector_radicados_incidentes[5][fax_correo],  
			   11 => $vector_radicados_tutelas[6][fax_correo]+$vector_radicados_incidentes[6][fax_correo],  
			   12 => $vector_radicados_tutelas[7][fax_correo]+$vector_radicados_incidentes[7][fax_correo],
			   13 => $vector_radicados_tutelas[14][fax_correo]+$vector_radicados_incidentes[14][fax_correo],
			   14 => $vector_radicados_tutelas[15][fax_correo]+$vector_radicados_incidentes[15][fax_correo],
			   15 => $vector_radicados_tutelas[16][fax_correo]+$vector_radicados_incidentes[16][fax_correo],
			   16 => $vector_radicados_tutelas[17][fax_correo]+$vector_radicados_incidentes[17][fax_correo],
			   17 => $vector_radicados_tutelas[18][fax_correo]+$vector_radicados_incidentes[18][fax_correo],
			   18 => $vector_radicados_tutelas[19][fax_correo]+$vector_radicados_incidentes[19][fax_correo],
			   19 => $vector_radicados_tutelas[20][fax_correo]+$vector_radicados_incidentes[20][fax_correo],
			   20 => $vector_radicados_tutelas[21][fax_correo]+$vector_radicados_incidentes[21][fax_correo],
			   21 => $vector_radicados_tutelas[22][fax_correo]+$vector_radicados_incidentes[22][fax_correo],
			   22 => $vector_radicados_tutelas[23][fax_correo]+$vector_radicados_incidentes[23][fax_correo],
			   23 => $vector_radicados_tutelas[24][fax_correo]+$vector_radicados_incidentes[24][fax_correo],
			   24 => $vector_radicados_tutelas[25][fax_correo]+$vector_radicados_incidentes[25][fax_correo]
			   
    );	

$fax_c_c = array( 0 => $vector_radicados_tutelas[8][fax_correo_correoelectronico]+$vector_radicados_incidentes[8][fax_correo_correoelectronico], 1 => $vector_radicados_tutelas[9][fax_correo_correoelectronico]+$vector_radicados_incidentes[9][fax_correo_correoelectronico], 2 =>$vector_radicados_tutelas[10][fax_correo_correoelectronico]+$vector_radicados_incidentes[10][fax_correo_correoelectronico], 3 => $vector_radicados_tutelas[11][fax_correo_correoelectronico]+$vector_radicados_incidentes[11][fax_correo_correoelectronico], 4 => $vector_radicados_tutelas[12][fax_correo_correoelectronico]+$vector_radicados_incidentes[12][fax_correo_correoelectronico], 5 => $vector_radicados_tutelas[13][fax_correo_correoelectronico]+$vector_radicados_incidentes[13][fax_correo_correoelectronico], 6 => $vector_radicados_tutelas[1][fax_correo_correoelectronico]+$vector_radicados_incidentes[1][fax_correo_correoelectronico], 7 => $vector_radicados_tutelas[2][fax_correo_correoelectronico]+$vector_radicados_incidentes[2][fax_correo_correoelectronico], 8 => $vector_radicados_tutelas[3][fax_correo_correoelectronico]+$vector_radicados_incidentes[3][fax_correo_correoelectronico], 9 => $vector_radicados_tutelas[4][fax_correo_correoelectronico]+$vector_radicados_incidentes[4][fax_correo_correoelectronico], 10 => $vector_radicados_tutelas[5][fax_correo_correoelectronico]+$vector_radicados_incidentes[5][fax_correo_correoelectronico], 11 => $vector_radicados_tutelas[6][fax_correo_correoelectronico]+$vector_radicados_incidentes[6][fax_correo_correoelectronico], 12 => $vector_radicados_tutelas[7][fax_correo_correoelectronico]+$vector_radicados_incidentes[7][fax_correo_correoelectronico], 13 => $vector_radicados_tutelas[14][fax_correo_correoelectronico]+$vector_radicados_incidentes[14][fax_correo_correoelectronico], 14 => $vector_radicados_tutelas[15][fax_correo_correoelectronico]+$vector_radicados_incidentes[15][fax_correo_correoelectronico], 15 => $vector_radicados_tutelas[16][fax_correo_correoelectronico]+$vector_radicados_incidentes[16][fax_correo_correoelectronico], 16 => $vector_radicados_tutelas[17][fax_correo_correoelectronico]+$vector_radicados_incidentes[17][fax_correo_correoelectronico], 17 => $vector_radicados_tutelas[18][fax_correo_correoelectronico]+$vector_radicados_incidentes[18][fax_correo_correoelectronico], 18 => $vector_radicados_tutelas[19][fax_correo_correoelectronico]+$vector_radicados_incidentes[19][fax_correo_correoelectronico], 19 => $vector_radicados_tutelas[20][fax_correo_correoelectronico]+$vector_radicados_incidentes[20][fax_correo_correoelectronico], 20 => $vector_radicados_tutelas[21][fax_correo_correoelectronico]+$vector_radicados_incidentes[21][fax_correo_correoelectronico], 21 => $vector_radicados_tutelas[22][fax_correo_correoelectronico]+$vector_radicados_incidentes[22][fax_correo_correoelectronico], 22 => $vector_radicados_tutelas[23][fax_correo_correoelectronico]+$vector_radicados_incidentes[23][fax_correo_correoelectronico], 23 => $vector_radicados_tutelas[24][fax_correo_correoelectronico]+$vector_radicados_incidentes[24][fax_correo_correoelectronico], 24 => $vector_radicados_tutelas[25][fax_correo_correoelectronico]+$vector_radicados_incidentes[25][fax_correo_correoelectronico]
    );	

$personal = array( 0 => $vector_radicados_tutelas[8][Personal]+$vector_radicados_incidentes[8][Personal], 
				   1 => $vector_radicados_tutelas[9][Personal]+$vector_radicados_incidentes[9][Personal],  
				   2 =>$vector_radicados_tutelas[10][Personal]+$vector_radicados_incidentes[10][Personal], 
				   3 => $vector_radicados_tutelas[11][Personal]+$vector_radicados_incidentes[11][Personal],  
				   4 => $vector_radicados_tutelas[12][Personal]+$vector_radicados_incidentes[12][Personal], 
				   5 => $vector_radicados_tutelas[13][Personal]+$vector_radicados_incidentes[13][Personal],  
				   6 => $vector_radicados_tutelas[1][Personal]+$vector_radicados_incidentes[1][Personal], 
				   7 => $vector_radicados_tutelas[2][Personal]+$vector_radicados_incidentes[2][Personal],  
				   8 => $vector_radicados_tutelas[3][Personal]+$vector_radicados_incidentes[3][Personal],  
				   9 => $vector_radicados_tutelas[4][Personal]+$vector_radicados_incidentes[4][Personal],  
				   10 => $vector_radicados_tutelas[5][Personal]+$vector_radicados_incidentes[5][Personal],  
				   11 => $vector_radicados_tutelas[6][Personal]+$vector_radicados_incidentes[6][Personal],  
				   12 => $vector_radicados_tutelas[7][Personal]+$vector_radicados_incidentes[7][Personal],
				   13 => $vector_radicados_tutelas[14][Personal]+$vector_radicados_incidentes[14][Personal],
				   14 => $vector_radicados_tutelas[15][Personal]+$vector_radicados_incidentes[15][Personal],
				   15 => $vector_radicados_tutelas[16][Personal]+$vector_radicados_incidentes[16][Personal],
				   16 => $vector_radicados_tutelas[17][Personal]+$vector_radicados_incidentes[17][Personal],
				   17 => $vector_radicados_tutelas[18][Personal]+$vector_radicados_incidentes[18][Personal],
				   18 => $vector_radicados_tutelas[19][Personal]+$vector_radicados_incidentes[19][Personal],
				   19 => $vector_radicados_tutelas[20][Personal]+$vector_radicados_incidentes[20][Personal],
				   20 => $vector_radicados_tutelas[21][Personal]+$vector_radicados_incidentes[21][Personal],
				   21 => $vector_radicados_tutelas[22][Personal]+$vector_radicados_incidentes[22][Personal],
				   22 => $vector_radicados_tutelas[23][Personal]+$vector_radicados_incidentes[23][Personal],
				   23 => $vector_radicados_tutelas[24][Personal]+$vector_radicados_incidentes[24][Personal],
				   24 => $vector_radicados_tutelas[25][Personal]+$vector_radicados_incidentes[25][Personal]					
    );

$total = array($correo[0]+$correo_e[0]+$fax[0]+$fax_c[0]+$fax_c_c[0]+$personal[0],
			   $correo[1]+$correo_e[1]+$fax[1]+$fax_c[1]+$fax_c_c[1]+$personal[1],
			   $correo[2]+$correo_e[2]+$fax[2]+$fax_c[2]+$fax_c_c[2]+$personal[2],
			   $correo[3]+$correo_e[3]+$fax[3]+$fax_c[3]+$fax_c_c[3]+$personal[3],
			   $correo[4]+$correo_e[4]+$fax[4]+$fax_c[4]+$fax_c_c[4]+$personal[4],
			   $correo[5]+$correo_e[5]+$fax[5]+$fax_c[5]+$fax_c_c[5]+$personal[5],
			   $correo[6]+$correo_e[6]+$fax[6]+$fax_c[6]+$fax_c_c[6]+$personal[6],
			   $correo[7]+$correo_e[7]+$fax[7]+$fax_c[7]+$fax_c_c[7]+$personal[7],
			   $correo[8]+$correo_e[8]+$fax[8]+$fax_c[8]+$fax_c_c[8]+$personal[8],
			   $correo[9]+$correo_e[9]+$fax[9]+$fax_c[9]+$fax_c_c[9]+$personal[9],
			   $correo[10]+$correo_e[10]+$fax[10]+$fax_c[10]+$fax_c_c[10]+$personal[10],
			   $correo[11]+$correo_e[11]+$fax[11]+$fax_c[11]+$fax_c_c[11]+$personal[11],
			   $correo[12]+$correo_e[12]+$fax[12]+$fax_c[12]+$fax_c_c[12]+$personal[12],
			   $correo[13]+$correo_e[13]+$fax[13]+$fax_c[13]+$fax_c_c[13]+$personal[13],
			   $correo[14]+$correo_e[14]+$fax[14]+$fax_c[14]+$fax_c_c[14]+$personal[14],
			   $correo[15]+$correo_e[15]+$fax[15]+$fax_c[15]+$fax_c_c[15]+$personal[15],
			   $correo[16]+$correo_e[16]+$fax[16]+$fax_c[16]+$fax_c_c[16]+$personal[16],
			   $correo[17]+$correo_e[17]+$fax[17]+$fax_c[17]+$fax_c_c[17]+$personal[17],
			   $correo[18]+$correo_e[18]+$fax[18]+$fax_c[18]+$fax_c_c[18]+$personal[18],
			   $correo[19]+$correo_e[19]+$fax[19]+$fax_c[19]+$fax_c_c[19]+$personal[19],
			   $correo[20]+$correo_e[20]+$fax[20]+$fax_c[20]+$fax_c_c[20]+$personal[20],
			   $correo[21]+$correo_e[21]+$fax[21]+$fax_c[21]+$fax_c_c[21]+$personal[21],
			   $correo[22]+$correo_e[22]+$fax[22]+$fax_c[22]+$fax_c_c[22]+$personal[22],
			   $correo[23]+$correo_e[23]+$fax[23]+$fax_c[23]+$fax_c_c[23]+$personal[23],
			   $correo[24]+$correo_e[24]+$fax[24]+$fax_c[24]+$fax_c_c[24]+$personal[24]
			   );

$pe1=$vector_radicados_tutelas[8][Fax]+$vector_radicados_tutelas[8][Correo]+$vector_radicados_tutelas[8][Personal]+$vector_radicados_tutelas[8][correo_electronico]+$vector_radicados_tutelas[8][fax_correo]+$vector_radicados_tutelas[8][fax_correo_correoelectronico];
$pe2=$vector_radicados_tutelas[9][Fax]+$vector_radicados_tutelas[9][Correo]+$vector_radicados_tutelas[9][Personal]+$vector_radicados_tutelas[9][correo_electronico]+$vector_radicados_tutelas[9][fax_correo]+$vector_radicados_tutelas[9][fax_correo_correoelectronico];
$pe3=$vector_radicados_tutelas[10][Fax]+$vector_radicados_tutelas[10][Correo]+$vector_radicados_tutelas[10][Personal]+$vector_radicados_tutelas[10][correo_electronico]+$vector_radicados_tutelas[10][fax_correo]+$vector_radicados_tutelas[10][fax_correo_correoelectronico];
$pe4=$vector_radicados_tutelas[11][Fax]+$vector_radicados_tutelas[11][Correo]+$vector_radicados_tutelas[11][Personal]+$vector_radicados_tutelas[11][correo_electronico]+$vector_radicados_tutelas[11][fax_correo]+$vector_radicados_tutelas[11][fax_correo_correoelectronico];
$pe5=$vector_radicados_tutelas[12][Fax]+$vector_radicados_tutelas[12][Correo]+$vector_radicados_tutelas[12][Personal]+$vector_radicados_tutelas[12][correo_electronico]+$vector_radicados_tutelas[12][fax_correo]+$vector_radicados_tutelas[12][fax_correo_correoelectronico];
$pe6=$vector_radicados_tutelas[13][Fax]+$vector_radicados_tutelas[13][Correo]+$vector_radicados_tutelas[13][Personal]+$vector_radicados_tutelas[13][correo_electronico]+$vector_radicados_tutelas[13][fax_correo]+$vector_radicados_tutelas[13][fax_correo_correoelectronico];
$pef1=$vector_radicados_tutelas[1][Fax]+$vector_radicados_tutelas[1][Correo]+$vector_radicados_tutelas[1][Personal]+$vector_radicados_tutelas[1][correo_electronico]+$vector_radicados_tutelas[1][fax_correo]+$vector_radicados_tutelas[1][fax_correo_correoelectronico];
$pef2=$vector_radicados_tutelas[2][Fax]+$vector_radicados_tutelas[2][Correo]+$vector_radicados_tutelas[2][Personal]+$vector_radicados_tutelas[2][correo_electronico]+$vector_radicados_tutelas[2][fax_correo]+$vector_radicados_tutelas[2][fax_correo_correoelectronico];
$pef3=$vector_radicados_tutelas[3][Fax]+$vector_radicados_tutelas[3][Correo]+$vector_radicados_tutelas[3][Personal]+$vector_radicados_tutelas[3][correo_electronico]+$vector_radicados_tutelas[3][fax_correo]+$vector_radicados_tutelas[3][fax_correo_correoelectronico];
$pef4=$vector_radicados_tutelas[4][Fax]+$vector_radicados_tutelas[4][Correo]+$vector_radicados_tutelas[4][Personal]+$vector_radicados_tutelas[4][correo_electronico]+$vector_radicados_tutelas[4][fax_correo]+$vector_radicados_tutelas[4][fax_correo_correoelectronico];
$pef5=$vector_radicados_tutelas[5][Fax]+$vector_radicados_tutelas[5][Correo]+$vector_radicados_tutelas[5][Personal]+$vector_radicados_tutelas[5][correo_electronico]+$vector_radicados_tutelas[5][fax_correo]+$vector_radicados_tutelas[5][fax_correo_correoelectronico];
$pef6=$vector_radicados_tutelas[6][Fax]+$vector_radicados_tutelas[6][Correo]+$vector_radicados_tutelas[6][Personal]+$vector_radicados_tutelas[6][correo_electronico]+$vector_radicados_tutelas[6][fax_correo]+$vector_radicados_tutelas[6][fax_correo_correoelectronico];
$pef7=$vector_radicados_tutelas[7][Fax]+$vector_radicados_tutelas[7][Correo]+$vector_radicados_tutelas[7][Personal]+$vector_radicados_tutelas[7][correo_electronico]+$vector_radicados_tutelas[7][fax_correo]+$vector_radicados_tutelas[7][fax_correo_correoelectronico];
$pem1=$vector_radicados_tutelas[14][Fax]+$vector_radicados_tutelas[14][Correo]+$vector_radicados_tutelas[14][Personal]+$vector_radicados_tutelas[14][correo_electronico]+$vector_radicados_tutelas[14][fax_correo]+$vector_radicados_tutelas[14][fax_correo_correoelectronico];
$pem2=$vector_radicados_tutelas[15][Fax]+$vector_radicados_tutelas[15][Correo]+$vector_radicados_tutelas[15][Personal]+$vector_radicados_tutelas[15][correo_electronico]+$vector_radicados_tutelas[15][fax_correo]+$vector_radicados_tutelas[15][fax_correo_correoelectronico];
$pem3=$vector_radicados_tutelas[16][Fax]+$vector_radicados_tutelas[16][Correo]+$vector_radicados_tutelas[16][Personal]+$vector_radicados_tutelas[16][correo_electronico]+$vector_radicados_tutelas[16][fax_correo]+$vector_radicados_tutelas[16][fax_correo_correoelectronico];
$pem4=$vector_radicados_tutelas[17][Fax]+$vector_radicados_tutelas[17][Correo]+$vector_radicados_tutelas[17][Personal]+$vector_radicados_tutelas[17][correo_electronico]+$vector_radicados_tutelas[17][fax_correo]+$vector_radicados_tutelas[17][fax_correo_correoelectronico];
$pem5=$vector_radicados_tutelas[18][Fax]+$vector_radicados_tutelas[18][Correo]+$vector_radicados_tutelas[18][Personal]+$vector_radicados_tutelas[18][correo_electronico]+$vector_radicados_tutelas[18][fax_correo]+$vector_radicados_tutelas[18][fax_correo_correoelectronico];
$pem6=$vector_radicados_tutelas[19][Fax]+$vector_radicados_tutelas[19][Correo]+$vector_radicados_tutelas[19][Personal]+$vector_radicados_tutelas[19][correo_electronico]+$vector_radicados_tutelas[19][fax_correo]+$vector_radicados_tutelas[19][fax_correo_correoelectronico];
$pem7=$vector_radicados_tutelas[20][Fax]+$vector_radicados_tutelas[20][Correo]+$vector_radicados_tutelas[20][Personal]+$vector_radicados_tutelas[20][correo_electronico]+$vector_radicados_tutelas[20][fax_correo]+$vector_radicados_tutelas[20][fax_correo_correoelectronico];
$pem8=$vector_radicados_tutelas[21][Fax]+$vector_radicados_tutelas[21][Correo]+$vector_radicados_tutelas[21][Personal]+$vector_radicados_tutelas[21][correo_electronico]+$vector_radicados_tutelas[21][fax_correo]+$vector_radicados_tutelas[21][fax_correo_correoelectronico];
$pem9=$vector_radicados_tutelas[22][Fax]+$vector_radicados_tutelas[22][Correo]+$vector_radicados_tutelas[22][Personal]+$vector_radicados_tutelas[22][correo_electronico]+$vector_radicados_tutelas[22][fax_correo]+$vector_radicados_tutelas[22][fax_correo_correoelectronico];
$pem10=$vector_radicados_tutelas[23][Fax]+$vector_radicados_tutelas[23][Correo]+$vector_radicados_tutelas[23][Personal]+$vector_radicados_tutelas[23][correo_electronico]+$vector_radicados_tutelas[23][fax_correo]+$vector_radicados_tutelas[23][fax_correo_correoelectronico];
$pem11=$vector_radicados_tutelas[24][Fax]+$vector_radicados_tutelas[24][Correo]+$vector_radicados_tutelas[24][Personal]+$vector_radicados_tutelas[24][correo_electronico]+$vector_radicados_tutelas[24][fax_correo]+$vector_radicados_tutelas[24][fax_correo_correoelectronico];
$pem12=$vector_radicados_tutelas[25][Fax]+$vector_radicados_tutelas[25][Correo]+$vector_radicados_tutelas[25][Personal]+$vector_radicados_tutelas[25][correo_electronico]+$vector_radicados_tutelas[25][fax_correo]+$vector_radicados_tutelas[25][fax_correo_correoelectronico];
$pei1=$vector_radicados_incidentes[8][Fax]+$vector_radicados_incidentes[8][Correo]+$vector_radicados_incidentes[8][Personal]+$vector_radicados_incidentes[8][correo_electronico]+$vector_radicados_incidentes[8][fax_correo]+$vector_radicados_incidentes[8][fax_correo_correoelectronico];
$pei2=$vector_radicados_incidentes[9][Fax]+$vector_radicados_incidentes[9][Correo]+$vector_radicados_incidentes[9][Personal]+$vector_radicados_incidentes[9][correo_electronico]+$vector_radicados_incidentes[9][fax_correo]+$vector_radicados_incidentes[9][fax_correo_correoelectronico];
$pei3=$vector_radicados_incidentes[10][Fax]+$vector_radicados_incidentes[10][Correo]+$vector_radicados_incidentes[10][Personal]+$vector_radicados_incidentes[10][correo_electronico]+$vector_radicados_incidentes[10][fax_correo]+$vector_radicados_incidentes[10][fax_correo_correoelectronico];
$pei4=$vector_radicados_incidentes[11][Fax]+$vector_radicados_incidentes[11][Correo]+$vector_radicados_incidentes[11][Personal]+$vector_radicados_incidentes[11][correo_electronico]+$vector_radicados_incidentes[11][fax_correo]+$vector_radicados_incidentes[11][fax_correo_correoelectronico];
$pei5=$vector_radicados_incidentes[12][Fax]+$vector_radicados_incidentes[12][Correo]+$vector_radicados_incidentes[12][Personal]+$vector_radicados_incidentes[12][correo_electronico]+$vector_radicados_incidentes[12][fax_correo]+$vector_radicados_incidentes[12][fax_correo_correoelectronico];
$pei6=$vector_radicados_incidentes[13][Fax]+$vector_radicados_incidentes[13][Correo]+$vector_radicados_incidentes[13][Personal]+$vector_radicados_incidentes[13][correo_electronico]+$vector_radicados_incidentes[13][fax_correo]+$vector_radicados_incidentes[13][fax_correo_correoelectronico];
$peif1=$vector_radicados_incidentes[1][Fax]+$vector_radicados_incidentes[1][Correo]+$vector_radicados_incidentes[1][Personal]+$vector_radicados_incidentes[1][correo_electronico]+$vector_radicados_incidentes[1][fax_correo]+$vector_radicados_incidentes[1][fax_correo_correoelectronico];
$peif2=$vector_radicados_incidentes[2][Fax]+$vector_radicados_incidentes[2][Correo]+$vector_radicados_incidentes[2][Personal]+$vector_radicados_incidentes[2][correo_electronico]+$vector_radicados_incidentes[2][fax_correo]+$vector_radicados_incidentes[2][fax_correo_correoelectronico];
$peif3=$vector_radicados_incidentes[3][Fax]+$vector_radicados_incidentes[3][Correo]+$vector_radicados_incidentes[3][Personal]+$vector_radicados_incidentes[3][correo_electronico]+$vector_radicados_incidentes[3][fax_correo]+$vector_radicados_incidentes[3][fax_correo_correoelectronico];
$peif4=$vector_radicados_incidentes[4][Fax]+$vector_radicados_incidentes[4][Correo]+$vector_radicados_incidentes[4][Personal]+$vector_radicados_incidentes[4][correo_electronico]+$vector_radicados_incidentes[4][fax_correo]+$vector_radicados_incidentes[4][fax_correo_correoelectronico];
$peif5=$vector_radicados_incidentes[5][Fax]+$vector_radicados_incidentes[5][Correo]+$vector_radicados_incidentes[5][Personal]+$vector_radicados_incidentes[5][correo_electronico]+$vector_radicados_incidentes[5][fax_correo]+$vector_radicados_incidentes[5][fax_correo_correoelectronico];
$peif6=$vector_radicados_incidentes[6][Fax]+$vector_radicados_incidentes[6][Correo]+$vector_radicados_incidentes[6][Personal]+$vector_radicados_incidentes[6][correo_electronico]+$vector_radicados_incidentes[6][fax_correo]+$vector_radicados_incidentes[6][fax_correo_correoelectronico];
$peif7=$vector_radicados_incidentes[7][Fax]+$vector_radicados_incidentes[7][Correo]+$vector_radicados_incidentes[7][Personal]+$vector_radicados_incidentes[7][correo_electronico]+$vector_radicados_incidentes[7][fax_correo]+$vector_radicados_incidentes[7][fax_correo_correoelectronico];
$peim1=$vector_radicados_incidentes[14][Fax]+$vector_radicados_incidentes[14][Correo]+$vector_radicados_incidentes[14][Personal]+$vector_radicados_incidentes[14][correo_electronico]+$vector_radicados_incidentes[14][fax_correo]+$vector_radicados_incidentes[14][fax_correo_correoelectronico];
$peim2=$vector_radicados_incidentes[15][Fax]+$vector_radicados_incidentes[15][Correo]+$vector_radicados_incidentes[15][Personal]+$vector_radicados_incidentes[15][correo_electronico]+$vector_radicados_incidentes[15][fax_correo]+$vector_radicados_incidentes[15][fax_correo_correoelectronico];
$peim3=$vector_radicados_incidentes[16][Fax]+$vector_radicados_incidentes[16][Correo]+$vector_radicados_incidentes[16][Personal]+$vector_radicados_incidentes[16][correo_electronico]+$vector_radicados_incidentes[16][fax_correo]+$vector_radicados_incidentes[16][fax_correo_correoelectronico];
$peim4=$vector_radicados_incidentes[17][Fax]+$vector_radicados_incidentes[17][Correo]+$vector_radicados_incidentes[17][Personal]+$vector_radicados_incidentes[17][correo_electronico]+$vector_radicados_incidentes[17][fax_correo]+$vector_radicados_incidentes[17][fax_correo_correoelectronico];
$peim5=$vector_radicados_incidentes[18][Fax]+$vector_radicados_incidentes[18][Correo]+$vector_radicados_incidentes[18][Personal]+$vector_radicados_incidentes[18][correo_electronico]+$vector_radicados_incidentes[18][fax_correo]+$vector_radicados_incidentes[18][fax_correo_correoelectronico];
$peim6=$vector_radicados_incidentes[19][Fax]+$vector_radicados_incidentes[19][Correo]+$vector_radicados_incidentes[19][Personal]+$vector_radicados_incidentes[19][correo_electronico]+$vector_radicados_incidentes[19][fax_correo]+$vector_radicados_incidentes[19][fax_correo_correoelectronico];
$peim7=$vector_radicados_incidentes[20][Fax]+$vector_radicados_incidentes[20][Correo]+$vector_radicados_incidentes[20][Personal]+$vector_radicados_incidentes[20][correo_electronico]+$vector_radicados_incidentes[20][fax_correo]+$vector_radicados_incidentes[20][fax_correo_correoelectronico];
$peim8=$vector_radicados_incidentes[21][Fax]+$vector_radicados_incidentes[21][Correo]+$vector_radicados_incidentes[21][Personal]+$vector_radicados_incidentes[21][correo_electronico]+$vector_radicados_incidentes[21][fax_correo]+$vector_radicados_incidentes[21][fax_correo_correoelectronico];
$peim9=$vector_radicados_incidentes[22][Fax]+$vector_radicados_incidentes[22][Correo]+$vector_radicados_incidentes[22][Personal]+$vector_radicados_incidentes[22][correo_electronico]+$vector_radicados_incidentes[22][fax_correo]+$vector_radicados_incidentes[22][fax_correo_correoelectronico];
$peim10=$vector_radicados_incidentes[23][Fax]+$vector_radicados_incidentes[23][Correo]+$vector_radicados_incidentes[23][Personal]+$vector_radicados_incidentes[23][correo_electronico]+$vector_radicados_incidentes[23][fax_correo]+$vector_radicados_incidentes[23][fax_correo_correoelectronico];
$peim11=$vector_radicados_incidentes[24][Fax]+$vector_radicados_incidentes[24][Correo]+$vector_radicados_incidentes[24][Personal]+$vector_radicados_incidentes[24][correo_electronico]+$vector_radicados_incidentes[24][fax_correo]+$vector_radicados_incidentes[24][fax_correo_correoelectronico];
$peim12=$vector_radicados_incidentes[25][Fax]+$vector_radicados_incidentes[25][Correo]+$vector_radicados_incidentes[25][Personal]+$vector_radicados_incidentes[25][correo_electronico]+$vector_radicados_incidentes[25][fax_correo]+$vector_radicados_incidentes[25][fax_correo_correoelectronico];

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

      date_default_timezone_set('America/Bogota'); 

$objPHPExcel = new PHPExcel();
$objWorksheet = $objPHPExcel->getActiveSheet();

$objPHPExcel->getActiveSheet()->mergeCells('A1:L1');
$objPHPExcel->getActiveSheet()->mergeCells('A14:L14');
$objPHPExcel->getActiveSheet()->mergeCells('A28:L28');

$objPHPExcel->getActiveSheet()->mergeCells('F2:L2');
$objPHPExcel->getActiveSheet()->mergeCells('F15:L15');
$objPHPExcel->getActiveSheet()->mergeCells('F29:L29');

$objPHPExcel->getActiveSheet()->mergeCells('A2:A3');
$objPHPExcel->getActiveSheet()->mergeCells('A15:A16');
$objPHPExcel->getActiveSheet()->mergeCells('A29:A30');

$objPHPExcel->getActiveSheet()->mergeCells('B2:B3');
$objPHPExcel->getActiveSheet()->mergeCells('B15:B16');
$objPHPExcel->getActiveSheet()->mergeCells('B29:B30');

$objPHPExcel->getActiveSheet()->mergeCells('C2:C3');
$objPHPExcel->getActiveSheet()->mergeCells('C15:C16');
$objPHPExcel->getActiveSheet()->mergeCells('C29:C30');

$objPHPExcel->getActiveSheet()->mergeCells('D2:D3');
$objPHPExcel->getActiveSheet()->mergeCells('D15:D16');
$objPHPExcel->getActiveSheet()->mergeCells('D29:D30');

$objPHPExcel->getActiveSheet()->mergeCells('E2:E3');
$objPHPExcel->getActiveSheet()->mergeCells('E15:E16');
$objPHPExcel->getActiveSheet()->mergeCells('E29:E30');

$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12); 
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12); 
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(22); 
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(19); 
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(29); 

$objWorksheet->fromArray(
	array(
		array('CONSOLIDADO GENERAL NOTIFICACIONES DE TUTELAS JUZGADOS CIVILES CIRCUITO'),
		array('JUZGADOS','RADICADOS TUTELAS','Personas o entidades notificadas en tutelas','RADICADOS DE INCIDENTES','Personas o entidades notificadas en incidentes',utf8_encode('MEDIO NOTIFICACIÓN')),
		array('JUZGADOS','RADICADOS TUTELAS','Personas o entidades notificadas en tutelas','RADICADOS DE INCIDENTES','Personas o entidades notificadas en incidentes','Correo',utf8_encode('Correo-Electrónico'),'Fax','Fax-Correo','Fax-Correo-Correo Electronico','Personal','Total general'),
		array('JUZGADO 1',	$ca1,	$pe1,	$ci1, $pei1,$correo[0],$correo_e[0],$fax[0],$fax_c[0],$fax_c_c[0],$personal[0],$total[0]),
		array('JUZGADO 2',  $ca2,   $pe2,	$ci2, $pei2,$correo[1],$correo_e[1],$fax[1],$fax_c[1],$fax_c_c[1],$personal[1],$total[1]),
		array('JUZGADO 3',  $ca3,   $pe3,	$ci3, $pei3,$correo[2],$correo_e[2],$fax[2],$fax_c[2],$fax_c_c[2],$personal[2],$total[2]),
		array('JUZGADO 4',  $ca4,   $pe4,	$ci4, $pei4,$correo[3],$correo_e[3],$fax[3],$fax_c[3],$fax_c_c[3],$personal[3],$total[3]),
		array('JUZGADO 5',  $ca5,   $pe5,	$ci5, $pei5,$correo[4],$correo_e[4],$fax[4],$fax_c[4],$fax_c_c[4],$personal[4],$total[4]),
		array('JUZGADO 6',  $ca6,   $pe6,	$ci6, $pei6,$correo[5],$correo_e[5],$fax[5],$fax_c[5],$fax_c_c[5],$personal[5],$total[5]),
		array(''),
		array(''),
		array(''),
		array(''),
		array('NOTIFICACIONES DE TUTELAS JUZGADOS FAMILIA'),
		array('JUZGADOS','RADICADOS TUTELAS','Personas o entidades notificadas en tutelas','RADICADOS DE INCIDENTES','Personas o entidades notificadas en incidentes',utf8_encode('MEDIO NOTIFICACIÓN')),
		array('JUZGADOS','RADICADOS TUTELAS','Personas o entidades notificadas en tutelas','RADICADOS DE INCIDENTES','Personas o entidades notificadas en incidentes','Correo',utf8_encode('Correo-Electrónico'),'Fax','Fax-Correo','Fax-Correo-Correo Electronico','Personal','Total general'),
		array('JUZGADO 1',	$caf1,	$pef1,	$cif1, $peif1,$correo[6],$correo_e[6],$fax[6],$fax_c[6],$fax_c_c[6],$personal[6],$total[6]),
		array('JUZGADO 2',  $caf2,   $pef2,	$cif2, $peif2,$correo[7],$correo_e[7],$fax[7],$fax_c[7],$fax_c_c[7],$personal[7],$total[7]),
		array('JUZGADO 3',  $caf3,   $pef3,	$cif3, $peif3,$correo[8],$correo_e[8],$fax[8],$fax_c[8],$fax_c_c[8],$personal[8],$total[8]),
		array('JUZGADO 4',  $caf4,   $pef4,	$cif4, $peif4,$correo[9],$correo_e[9],$fax[9],$fax_c[9],$fax_c_c[9],$personal[9],$total[9]),
		array('JUZGADO 5',  $caf5,   $pef5,	$cif5, $peif5,$correo[10],$correo_e[10],$fax[10],$fax_c[10],$fax_c_c[10],$personal[10],$total[10]),
		array('JUZGADO 6',  $caf6,   $pef6,	$cif6, $peif6,$correo[11],$correo_e[11],$fax[11],$fax_c[11],$fax_c_c[11],$personal[11],$total[11]),
		array('JUZGADO 7',  $caf7,   $pef7,	$cif7, $peif7,$correo[12],$correo_e[12],$fax[12],$fax_c[12],$fax_c_c[12],$personal[12],$total[12]),
		array(''),
		array(''),
		array(''),
		array(''),
		array('NOTIFICACIONES DE TUTELAS JUZGADOS CIVIL MUNICIPAL'),
		array('JUZGADOS','RADICADOS TUTELAS','Personas o entidades notificadas en tutelas','RADICADOS DE INCIDENTES','Personas o entidades notificadas en incidentes',utf8_encode('MEDIO NOTIFICACIÓN')),
		array('JUZGADOS','RADICADOS TUTELAS','Personas o entidades notificadas en tutelas','RADICADOS DE INCIDENTES','Personas o entidades notificadas en incidentes','Correo',utf8_encode('Correo-Electrónico'),'Fax','Fax-Correo','Fax-Correo-Correo Electronico','Personal','Total general'),
		array('JUZGADO 1',	$cam1,	$pem1,	$cim1, $peim1,$correo[13],$correo_e[13],$fax[13],$fax_c[13],$fax_c_c[13],$personal[13],$total[13]),
		array('JUZGADO 2',  $cam2,   $pem2,	$cim2, $peim2,$correo[14],$correo_e[14],$fax[14],$fax_c[14],$fax_c_c[14],$personal[14],$total[14]),
		array('JUZGADO 3',  $cam3,   $pem3,	$cim3, $peim3,$correo[15],$correo_e[15],$fax[15],$fax_c[15],$fax_c_c[15],$personal[15],$total[15]),
		array('JUZGADO 4',  $cam4,   $pem4,	$cim4, $peim4,$correo[16],$correo_e[16],$fax[16],$fax_c[16],$fax_c_c[16],$personal[16],$total[16]),
		array('JUZGADO 5',  $cam5,   $pem5,	$cim5, $peim5,$correo[17],$correo_e[17],$fax[17],$fax_c[17],$fax_c_c[17],$personal[17],$total[17]),
		array('JUZGADO 6',  $cam6,   $pem6,	$cim6, $peim6,$correo[18],$correo_e[18],$fax[18],$fax_c[18],$fax_c_c[18],$personal[18],$total[18]),
		array('JUZGADO 7',  $cam7,   $pem7,	$cim7, $peim7,$correo[19],$correo_e[19],$fax[19],$fax_c[19],$fax_c_c[19],$personal[19],$total[19]),
		array('JUZGADO 8',  $cam8,   $pem8,	$cim8, $peim8,$correo[20],$correo_e[20],$fax[20],$fax_c[20],$fax_c_c[20],$personal[20],$total[20]),
		array('JUZGADO 9',  $cam9,   $pem9,	$cim9, $peim9,$correo[21],$correo_e[21],$fax[21],$fax_c[21],$fax_c_c[21],$personal[21],$total[21]),
		array('JUZGADO 10', $cam10, $pem10,	$cim10,$peim10,$correo[22],$correo_e[22],$fax[22],$fax_c[22],$fax_c_c[22],$personal[22],$total[22]),
		array('JUZGADO 11', $cam11, $pem11,	$cim11,$peim11,$correo[23],$correo_e[23],$fax[23],$fax_c[23],$fax_c_c[23],$personal[23],$total[23]),
		array('JUZGADO 12', $cam12, $pem12,	$cim12,$peim12,$correo[24],$correo_e[24],$fax[24],$fax_c[24],$fax_c_c[24],$personal[24],$total[24]),
	)
);

$borders = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('argb' => 'FF000000'),
        )
      ),
    );
	$style_num = array('font' =>
                                array('color' =>
                                array('rgb' => '000000'),
                                      'bold' => false,
                                    ),
                                      'alignment' => array(
                                      'wrap'       => true,
                                      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                                        ),
                                      'borders' => array(
                                      'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('argb' => 'FF000000'),
        )
     ),				
   );
$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A14:L14')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A28:L28')->applyFromArray($style_num);

$objPHPExcel->getActiveSheet()->getStyle('A2:L2')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A3:L3')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A4:L4')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A5:L5')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A6:L6')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A7:L7')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A8:L8')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A9:L9')->applyFromArray($style_num);

$objPHPExcel->getActiveSheet()->getStyle('A15:L15')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A16:L16')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A17:L17')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A18:L18')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A19:L19')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A20:L20')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A21:L21')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A22:L22')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A23:L23')->applyFromArray($style_num);

$objPHPExcel->getActiveSheet()->getStyle('A29:L29')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A30:L30')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A31:L31')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A32:L32')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A33:L33')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A34:L34')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A35:L35')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A36:L36')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A37:L37')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A38:L38')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A39:L39')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A40:L40')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A41:L41')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A42:L42')->applyFromArray($style_num);

/*
//	Set the Labels for each data series we want to plot
//		Datatype
//		Cell reference for data
//		Format Code
//		Number of datapoints in series
//		Data values
//		Data Marker
$dataseriesLabels = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$F$3', NULL, 1),	
	new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$G$3', NULL, 1),	
	new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$H$3', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$I$3', NULL, 1),	
	new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$J$3', NULL, 1),	
	new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$K$3', NULL, 1),	
);
//	Set the X-Axis Labels
//		Datatype
//		Cell reference for data
//		Format Code
//		Number of datapoints in series
//		Data values
//		Data Marker
$xAxisTickValues = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$4:$A$9', NULL, 6),	//	Q1 to Q4
);
//	Set the Data values for each data series we want to plot
//		Datatype
//		Cell reference for data
//		Format Code
//		Number of datapoints in series
//		Data values
//		Data Marker
$dataSeriesValues = array(
	new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$F$4:$F$9', NULL, 6),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$G$4:$G$9', NULL, 6),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$H$4:$H$9', NULL, 6),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$I$4:$I$9', NULL, 6),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$J$4:$J$9', NULL, 6),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$K$4:$K$9', NULL, 6),
);

//	Build the dataseries
$series = new PHPExcel_Chart_DataSeries(
	PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
	PHPExcel_Chart_DataSeries::GROUPING_STANDARD,	// plotGrouping
	range(0, count($dataSeriesValues)-1),			// plotOrder
	$dataseriesLabels,								// plotLabel
	$xAxisTickValues,								// plotCategory
	$dataSeriesValues								// plotValues
);
//	Set additional dataseries parameters
//		Make it a vertical column rather than a horizontal bar graph
$series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);

//	Set the series in the plot area
$plotarea = new PHPExcel_Chart_PlotArea(NULL, array($series));
//	Set the chart legend
$legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

$title = new PHPExcel_Chart_Title('CONSOLIDADO GENERAL NOTIFICACIONES DE TUTELAS JUZGADOS CIVILES CIRCUITO');
$yAxisLabel = new PHPExcel_Chart_Title('Cantidad');


//	Create the chart
$chart = new PHPExcel_Chart(
	'chart1',		// name
	$title,			// title
	$legend,		// legend
	$plotarea,		// plotArea
	true,			// plotVisibleOnly
	0,				// displayBlanksAs
	NULL,			// xAxisLabel
	$yAxisLabel		// yAxisLabel
);

//	Set the position where the chart should appear in the worksheet
$chart->setTopLeftPosition('A70');
$chart->setBottomRightPosition('H90');
//	Add the chart to the worksheet
$objWorksheet->addChart($chart);*/
// Save Excel 2007 file

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->setIncludeCharts(TRUE);
$objWriter->save('views/excel/Informe de Notificacion de Tutelas e Incidentes '.$fechai.' al '.$fechaf.'.xlsx');
$id= 'Informe de Notificacion de Tutelas e Incidentes '.$fechai.' al '.$fechaf.'.xlsx';
$enlace = 'views/excel/'.$id; 

header ("Content-Disposition: attachment; filename=".$id." "); 
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);
}

//------------------------------------------------------------------------------------------------------------------
	//CODIGO ADICIONADO POR JORGE ANDRES VALENCIA 20 DE ABRIL 2015, PROJECTO INTEGRACION APLICATIVOS CENTRO DE SERVICIOS
//------------------------------------------------------------------------------------------------------------------
if($id_reporte == 1000)
{

$data= new excelModel();
$vector_datos= $data->Datos_Empleado_Ingreso_Salida($fd,$fh);
$objPHPExcel = new PHPExcel();
$styleArray = array(
'font' => array(
'bold' => true
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

->setCellValue('A1', 'FECHA')
->setCellValue('B1', 'HORA')
->setCellValue('C1', 'USUARIO')
->setCellValue('D1', 'TIPO')
->setCellValue('E1', 'OBSERVACION');

$sheet1->getStyle('A1')->applyFromArray($styleArray);
$sheet1->getStyle('B1')->applyFromArray($styleArray);
$sheet1->getStyle('C1')->applyFromArray($styleArray);
$sheet1->getStyle('D1')->applyFromArray($styleArray);
$sheet1->getStyle('E1')->applyFromArray($styleArray);

$sheet1->getStyle('A1:E1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'CDE3F6'),
            'endcolor' => array('rgb' => 'CDE3F6')

            )
    );

$i=2;
while($field = $vector_datos->fetch() )
{

	/*$cadenaFecha  =  explode (" ",$field[fecha]);
	$cadenaHora   =  $cadenaFecha[1];
	$cadenaHorab  =  explode (":",$cadenaHora);
	if($cadenaHorab[0] >= 7 && $cadenaHorab[0] <= 12){
		$fechacompleta = $field[fecha]." AM"; 
	}
	else{
		$fechacompleta = $field[fecha]." PM"; 
	}*/
	
	$sheet1->setCellValue('A'.$i, $field[fecha]);
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('B'.$i, $field[hora]);
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);

	$sheet1->setCellValue('C'.$i, utf8_encode($field[usuario]));
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('D'.$i, $field[tipo]);
	$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('E'.$i, utf8_encode($field[observaciones]));
	$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
	$i++;
}
   
$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Ingresos-Salidas');
// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Ingresos-Salidas.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
}				

if($id_reporte == 2000)
{

$data= new excelModel();

$vector_datos= $data->Datos_Empleado_Permisos($fd,$fh);

$objPHPExcel = new PHPExcel();

$styleArray = array(
'font' => array(
'bold' => true
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

->setCellValue('A1', 'USUARIO')
->setCellValue('B1', 'FECHA SOLICITUD')
->setCellValue('C1', 'FECHA PERMISO')
->setCellValue('D1', 'HORA INICAL')
->setCellValue('E1', 'HORA FINAL')
->setCellValue('F1', 'DURACION')
->setCellValue('G1', 'DETALLE')
->setCellValue('H1', 'ESTADO');

$sheet1->getStyle('A1')->applyFromArray($styleArray);
$sheet1->getStyle('B1')->applyFromArray($styleArray);
$sheet1->getStyle('C1')->applyFromArray($styleArray);
$sheet1->getStyle('D1')->applyFromArray($styleArray);
$sheet1->getStyle('E1')->applyFromArray($styleArray);
$sheet1->getStyle('F1')->applyFromArray($styleArray);
$sheet1->getStyle('G1')->applyFromArray($styleArray);
$sheet1->getStyle('H1')->applyFromArray($styleArray);

$sheet1->getStyle('A1:H1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'CDE3F6'),
            'endcolor' => array('rgb' => 'CDE3F6')
            )
    );


$i=2;
while($field = $vector_datos->fetch() )
{

	if($field[estado] == 2){
		$estado = "En Proceso";
	}
	if($field[estado] == 1){
		$estado = "Aprobado";
	}
	if($field[estado] == 0){
		$estado = "No Aprobado";
	}
	
	$sheet1->setCellValue('A'.$i, utf8_encode($field[usuario]));
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('B'.$i, $field[fecha_solicitud]);
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);

	$sheet1->setCellValue('C'.$i, $field[fecha_permiso]);
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('D'.$i, $field[hora_inicio]);
	$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('E'.$i, $field[hora_final]);
	$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('F'.$i, $field[duracion]);
	$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('G'.$i, utf8_encode($field[detalle]));
	$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('H'.$i, $estado);
	$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
	
	$i++;
}
   
$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize('true');

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Permisos-Usuario');

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Permisos-Usuario.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
}				
if($id_reportep == 3000)
{
$data= new excelModel();
$vector_datos= $data->Datos_Permisos_AprobadosNoAprobadosEnProceso($usuariop,$fdp,$fhp,$estadop);
$objPHPExcel = new PHPExcel();
$styleArray = array(
'font' => array(
'bold' => true
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
->setCellValue('B1', 'USUARIO')
->setCellValue('C1', 'FECHA SOLICITUD')
->setCellValue('D1', 'FECHA PERMISO')
->setCellValue('E1', 'HORA INICAL')
->setCellValue('F1', 'HORA FINAL')
->setCellValue('G1', 'DURACION')
->setCellValue('H1', 'DURACION HORAS')
->setCellValue('I1', 'DETALLE')
->setCellValue('J1', 'ESTADO');

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

$sheet1->getStyle('A1:I1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'CDE3F6'),
            'endcolor' => array('rgb' => 'CDE3F6')
            )
    );
$i=2;
while($field = $vector_datos->fetch() )
{

	if($field[estado] == 2){
		$estado = "En Proceso";
	}
	if($field[estado] == 1){
		$estado = "Aprobado";
	}
	if($field[estado] == 0){
		$estado = "No Aprobado";
	}
	
	$sheet1->setCellValue('A'.$i, $field[id]);
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('B'.$i, utf8_encode($field[empleado]));
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('C'.$i, $field[fecha_solicitud]);
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);

	$sheet1->setCellValue('D'.$i, $field[fecha_permiso]);
	$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('E'.$i, $field[hora_inicio]);
	$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('F'.$i, $field[hora_final]);
	$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('G'.$i, $field[duracion]);
	$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('H'.$i, $field[duracion_m]);
	$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('I'.$i, utf8_encode($field[detalle]));
	$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('J'.$i, $estado);
	$sheet1->getStyle('J'.$i)->applyFromArray($borders_nobold);
	
	$i++;
	
}
   
$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($borders);
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

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Permisos-Usuario2');


// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Permisos-Usuario2.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;

}				

/*if($id_reportep == 4000)
{

$data = new excelModel();

$vector_datos  = $data->Datos_ConsolidadoPermisos($usuariop,$fdp,$fhp,$estadop);

$objPHPExcel = new PHPExcel();

$styleArray = array(
'font' => array(
'bold' => true
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

->setCellValue('A1', 'DISTRITO JUDICIAL')
->setCellValue('B1', 'DESPACHO')
->setCellValue('C1', 'NOMBRE DEL SOLICITANTE')
->setCellValue('D1', 'CARGO')
->setCellValue('E1', 'TIEMPO EN HORAS DEDICADO A DOCENCIA')
->setCellValue('F1', 'TIEMPO EN HORAS DEDICADO A ESTUDIOS')
->setCellValue('G1', 'NUN PERMISOS ORDINARIOS')
->setCellValue('H1', 'TIEMPO HORAS PERMISOS ORDINARIOS');


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
            'startcolor' => array('rgb' => 'CDE3F6'),
            'endcolor' => array('rgb' => 'CDE3F6')

            )
    );


$i=2;
while($field = $vector_datos->fetch() )
{

	$cantidad_horas      = $data->Cantidad_Horas_Permisos($field[idusuario]);
	$fieldcantidad_horas = $cantidad_horas->fetch();
	
	 
	$sheet1->setCellValue('A'.$i, "MANIZALES");
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('B'.$i, "CENTRO DE SERVICIOS JUDICIALES CIVIL - FAMILIA");
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('C'.$i, utf8_encode($field[empleado]));
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('D'.$i, utf8_encode(" "));
	$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);

	$sheet1->setCellValue('E'.$i, " ");
	$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('F'.$i, " ");
	$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('G'.$i, $field[numeropermisos]);
	$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('H'.$i, $fieldcantidad_horas[cantidadhoras]);
	$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
	

	$i++;
	
}
   
$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize('true');

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Consolidado_Permisos');


// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Consolidado_Permisos.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;

}*/				

if($id_reportep == 4000)
{

$data = new excelModel();

$vector_datos  = $data->Datos_ConsolidadoPermisos($usuariop,$fdp,$fhp,$estadop);

$objPHPExcel = new PHPExcel();

$styleArray = array(
'font' => array(
'bold' => true,
'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
'size'   =>  12 
)
);

$styleArray2 = array ( 
    	'font'   => array ( 
        'bold'   =>  true , 
        'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
        'size'   =>  15 
));

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

//ENCABEZADO FORMATO PARA EL CONSOLIDADO DE PERMISOS
->setCellValue('A1', 'FORMATO PARA EL CONSOLIDADO DE PERMISOS')
->mergeCells('A1:H1')


//ENCABEZADO FORMATO PARA EL RANGO DE FECHAS SEMESTRE
->setCellValue('A2', 'SEMESTRE '.$fdp.' - '.$fhp)
->mergeCells('A2:H2')

//ENCABEZADO PARA LAS COLUMNAS
->setCellValue('A3', 'DISTRITO JUDICIAL')
->setCellValue('B3', 'DESPACHO')
->setCellValue('C3', 'NOMBRE DEL SOLICITANTE')
->setCellValue('D3', 'CARGO')
->setCellValue('E3', 'TIEMPO EN HORAS DEDICADO A DOCENCIA')
->setCellValue('F3', 'TIEMPO EN HORAS DEDICADO A ESTUDIOS')
->setCellValue('G3', 'NUN PERMISOS ORDINARIOS')
->setCellValue('H3', 'TIEMPO HORAS PERMISOS ORDINARIOS');

$sheet1->getStyle('A3')->applyFromArray($styleArray);
$sheet1->getStyle('B3')->applyFromArray($styleArray);
$sheet1->getStyle('C3')->applyFromArray($styleArray);
$sheet1->getStyle('D3')->applyFromArray($styleArray);
$sheet1->getStyle('E3')->applyFromArray($styleArray);
$sheet1->getStyle('F3')->applyFromArray($styleArray);
$sheet1->getStyle('G3')->applyFromArray($styleArray);
$sheet1->getStyle('H3')->applyFromArray($styleArray);

$sheet1->getStyle('A1:H1')->applyFromArray($styleArray2);
$sheet1->getStyle('A1:H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
$sheet1->getStyle('A1:H1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => '2F709F'),
            'endcolor' => array('rgb' => '2F709F')
            )
    );
$sheet1->getStyle('A2:H2')->applyFromArray($styleArray2);
$sheet1->getStyle('A2:H2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
$sheet1->getStyle('A2:H2')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => '2F709F'),
            'endcolor' => array('rgb' => '2F709F')
            )
    );
	
$sheet1->getStyle('A3:H3')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => '2F709F'),//CDE3F6
            'endcolor' => array('rgb' => '2F709F')
            )
    );

//$i=2;
$i=4;
while($field = $vector_datos->fetch() )
{

	$cantidad_horas      = $data->Cantidad_Horas_Permisos_2($field[idusuario],$fdp,$fhp);
	$fieldcantidad_horas = $cantidad_horas->fetch();
	$sheet1->setCellValue('A'.$i, "MANIZALES");
	//$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	$sheet1->getStyle('A'.$i)->getFill()->applyFromArray(array('type'       => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'CDE3F6'),'endcolor' => array('rgb' => 'CDE3F6')));
	$sheet1->setCellValue('B'.$i, "CENTRO DE SERVICIOS JUDICIALES CIVIL - FAMILIA");
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
	$sheet1->setCellValue('C'.$i, utf8_encode($field[empleado]));
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
	$sheet1->setCellValue('D'.$i, utf8_encode(" "));
	$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
	$sheet1->setCellValue('E'.$i, " ");
	$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
	$sheet1->setCellValue('F'.$i, " ");
	$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
	$sheet1->setCellValue('G'.$i, $field[numeropermisos]);
	$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
	$sheet1->setCellValue('H'.$i, $fieldcantidad_horas[cantidadhoras]);
	$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
	$i++;
}

$objPHPExcel->getActiveSheet()->getStyle('A3:H3')->applyFromArray($borders);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize('true');

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Consolidado_Permisos');

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Consolidado_Permisos.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
}				
if($id_reportec == 5000)
{
$data= new excelModel();
$vector_datos= $data->Datos_Empleado_Ingreso_Salida_Completo($usuarioc,$fdc,$fhc);
$objPHPExcel = new PHPExcel();
$styleArray = array(
'font' => array(
'bold' => true
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

->setCellValue('A1', 'FECHA')
->setCellValue('B1', 'HORA')
->setCellValue('C1', 'USUARIO')
->setCellValue('D1', 'TIPO')
->setCellValue('E1', 'IP EQUIPO')
->setCellValue('F1', 'NOMBRE EQUIPO')
->setCellValue('G1', 'OBSERVACION');

$sheet1->getStyle('A1')->applyFromArray($styleArray);
$sheet1->getStyle('B1')->applyFromArray($styleArray);
$sheet1->getStyle('C1')->applyFromArray($styleArray);
$sheet1->getStyle('D1')->applyFromArray($styleArray);
$sheet1->getStyle('E1')->applyFromArray($styleArray);
$sheet1->getStyle('F1')->applyFromArray($styleArray);
$sheet1->getStyle('G1')->applyFromArray($styleArray);

$sheet1->getStyle('A1:G1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'CDE3F6'),
            'endcolor' => array('rgb' => 'CDE3F6')
            )
    );
$i=2;
while($field = $vector_datos->fetch() )
{
	/*$cadenaFecha  =  explode (" ",$field[fecha]);
	$cadenaHora   =  $cadenaFecha[1];
	$cadenaHorab  =  explode (":",$cadenaHora);
	
	if($cadenaHorab[0] >= 7 && $cadenaHorab[0] <= 12){
		$fechacompleta = $field[fecha]." AM"; 
	}
	else{
		$fechacompleta = $field[fecha]." PM"; 
	}*/
	
	$sheet1->setCellValue('A'.$i, $field[fecha]);
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('B'.$i, $field[hora]);
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);

	$sheet1->setCellValue('C'.$i, utf8_encode($field[usuario]));
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('D'.$i, $field[tipo]);
	$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('E'.$i, $field[ipequipo]);
	$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('F'.$i, $field[nombreequipo]);
	$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('G'.$i, utf8_encode($field[observaciones]));
	$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
	
	$i++;
}
   
$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize('true');

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Ingresos-Salidas-Completo');


// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Ingresos-Salidas-Completo.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
}
?>