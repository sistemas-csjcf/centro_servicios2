<?php 
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	//TITULO FORMULARIO
	//$titulo     = "Modificar Documento";
	$subtitulo  = "ANOTACIONES";
	$subtitulo2  = "PARTES DEL PROCESO";
	
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo       = new signotModel();

	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual  = $modelo->get_fecha_actual_amd();
	
	//OBTENEMOS LISTADO SEGUN LA LISTA SOLICITADA
	$nombrelista  = "signot_pa_tipo_anotacion AS anota WHERE anota.show = '1'";
	$campoordenar = 'id';
	$formaordenar = '';
	$datostipoanotacion  = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);

	
	//SI $datosdocumento ES DIFERENTE DE VACIA QUIERE DECIR QUE SE DIO CLIC
	//EN LA VISTA sigdoc_listar_documentos_salientes.php EN EL BOTON EDITAR
	//Y SE CARGAN LOS DATOS EN EL FORMULARIO sigdoc_documentos_salientes.php SEGUN LOS DATOS
	//DEL DOCUMENTO ESPECIFICADO, ESTO SE MANEJA ASI PARA NO CREAR OTRA VISTA Y OPTIMIZAR ESTE PROCESO
	//DE CREAR UNA VISTA PARA ACTUALIOZAR UN DOCUMENTO,SI NO QUE SE HAGA EN EL MISMO FORMULARIO DE REGISTRO
	//VISTA sigdoc_documentos_salientes.php
	if(!empty($datosdocumento)){

		//$titulo  = "(SIGDOC) Modificar Documento Saliente";
		$vbton   = "Registrar";
		
		//print_r($datosdocumento);
		
		while($fila = $datosdocumento->fetch()){
			
			$d0  = $fila[id];
			
			$titulo  = "Registrar Anotacion, Id Proceso: ".$d0;
			
			$d1  = $fila[radicado];
			$d2  = $fila[radicadosignotanterior];
	
		
		}
		
		$datosantotaciones  = $modelo->get_datos_proceso_anotacion_2($d0);
		
		//FASE (1,2,3,4,5), PARA OBTENER ESTA INFORMACION SE DEBE SACAR UNA COPIA DE
		//SEGURIDAD DE LAS TABLAS fase1,fase2,fase3,fase4,fase5 
		//DE LA BASE DE DATOS NOTIFICACIONESS DEL SIGNOT ANTERIOR
		$datosfase1 = $modelo->get_datos_proceso_fase(1,$d1,$d2);
		$datosfase2 = $modelo->get_datos_proceso_fase(2,$d1,$d2);
		$datosfase3 = $modelo->get_datos_proceso_fase(3,$d1,$d2);
		$datosfase4 = $modelo->get_datos_proceso_fase(4,$d1,$d2);
		$datosfase5 = $modelo->get_datos_proceso_fase(5,$d1,$d2);
		
		// JUAN ESTEBAN MÙNERA BETANCUR
		// 2019-01-28
		$datosObservacion = $modelo->get_observacion_proceso($d0); 
		
		//PARTES DEL PROCESO
		$datosparteproceso = $modelo->get_partes_proceso($d1); 
		
		//PARTES DEL PROCESO EN LA LISTA <select name="parteproceso" id="parteproceso" class="required">
		$datosparteproceso_2 = $modelo->get_partes_proceso($d1); 
		
	}
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>  -->
<title><?php echo $titulo?></title>

<!-- SE DEFINEN LAS LIBRERIAS DE ESTA FORMA PARA EVITAR CONFLICTOS COMO EL DESPLIEGUE DE MENUS,
QUE AL REALIZAR UN REGISTRO SALGA EL MENSAJE DE CONFIRMACION, SEGUIDO DE LAS LIBRERIAS
FUNCIONES JAVASCRIPT COMO mainmenu() Y $(document).ready(function() , YA QUE SI SE DEFINEN
MAS ARRIBA AL NO ENCONTRAR LAS LIBRERIAS TAMBIEN PUEDE PRESENTAR INCONSISTENCIAS.
PARA EL MANEJO DE LAS FECHAS, SI SE USA DIRECTAMENTE POR EJEMPLO EN ESTE FORMULARIO SE DEFINE 
ALGO COMO

<input name="fechair" id="fechair" type="text" readonly="true" size="10">

Y SE DEFINE EN $(document).ready(function() 

$("#fechair").datepicker({ changeFirstDay: false	}); 

SI SE DESEA MANEJAR FECHAS EN UN POPUPBOX, SE PUEDE USAR LAS LIBRERIAS DE views\fechajquery
EJENPLODE ESTO LO VEMOS EN EL FORMULARIO permisos.php UBICADO EN views\popupbox
-->

<!-- -------------------------------------------------------------------- -->
<script src="views/js/jquery.js" type="text/javascript"></script>
<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
<script src="views/js/jquery.validate.js" type="text/javascript"></script>
<script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                    	
<link href="views/css/pepper-grinder/ui.all.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
<link href="views/css/main.css" rel="stylesheet" type="text/css">

<!-- -------------------------------------------------------------------- -->

<!-- USO DE ARCHVIO PARA VALIDACIONES DE CAMPOS Y APLICACION DE FUNCIONES -->
<script src="views/js/ajax/ajax_documentos.js" type="text/javascript" charset="utf-8"></script> 

<script src="views/js/ajax/ajax_signot.js" type="text/javascript" charset="utf-8"></script> 

<!-- PARA MANEJAR LOS ESTILOS DEL FORMULARIO -->
<link href="views/css/main.css" rel="stylesheet" type="text/css">

<!-- PARA EL FUNCIONAMIENTO DE LAS TABLAS EN SU FILTRO Y PAGINACION -->
<script type="text/javascript" language="javascript" src="views/viewstablas/jquery.dataTables.js"></script> 
<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_page.css"/ >
<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_table.css"/ >

<!-- PARA LAS FECHAS -->
<script type="text/javascript" src="views/fechajquery/jquery.datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="views/fechajquery/jquery.datetimepicker.css"/ >

<!-- PARA LAS VENTANAS EMERGENTES POPUPBOX -->
<script src="views/js/ajax/ajax_popupbox_empleados_registro_entrada_salida.js" type="text/javascript" charset="utf-8"></script>
<link href="views/css/stylepopupbox.css" rel="stylesheet" type="text/css">

<!-- -------------------------------------------------------------------- -->
<!--        JUAN ESTEBAN MÚNERA BETANCUR-->
        <script language="JavaScript" type="text/javascript" src="assets/js/funciones_jest.js"></script>
<!-- PARA EL DESPLIEGUE DE MENUS -->
<script type="text/javascript">

	function mainmenu(){
	
		$(" #menusec ul ").css({display: "none"});
		$(" #menusec li").hover(function(){
			$(this).find('ul:first:hidden').css({visibility: "visible",display: "none"}).slideDown(400);
			},function(){
				$(this).find('ul:first').slideUp(400);
			});
	}
	
	$(document).ready(function(){
		mainmenu();
	});


</script>


<script type="text/javascript">

$(document).ready(function() {

	<!-- TABLA id:frm_editar2-->
	$('#frm_anotaciones').dataTable( { 
		'sPaginationType': 'full_numbers',
		
		 //ORDENAR POR LA COLUMNA ID, Y OCULTARLA
		 //POR AHORA NO SE USA EL OCULTAR, ESTA COMENTADO
		'aaSorting': [[ 0, 'desc' ]],     
		//'aoColumns': [{ "bSearchable": false,"bVisible":    false },null,null,null,null,null,null,null]
		'aoColumns': [null,null,null,null,null,null]
		
	} );
	
	//TABLAS DINAMICAS PARA LAS FASES
	$('#frm_fase1').dataTable( { 
		'sPaginationType': 'full_numbers',
		
		 //ORDENAR POR LA COLUMNA ID, Y OCULTARLA
		 //POR AHORA NO SE USA EL OCULTAR, ESTA COMENTADO
		'aaSorting': [[ 0, 'desc' ]],     
		//'aoColumns': [{ "bSearchable": false,"bVisible":    false },null,null,null,null,null,null,null]
		'aoColumns': [null,null]
		
	} );
	
	$('#frm_fase2').dataTable( { 
		'sPaginationType': 'full_numbers',
		
		 //ORDENAR POR LA COLUMNA ID, Y OCULTARLA
		 //POR AHORA NO SE USA EL OCULTAR, ESTA COMENTADO
		'aaSorting': [[ 0, 'desc' ]],     
		//'aoColumns': [{ "bSearchable": false,"bVisible":    false },null,null,null,null,null,null,null]
		'aoColumns': [null,null]
		
	} );
	
	$('#frm_fase3').dataTable( { 
		'sPaginationType': 'full_numbers',
		
		 //ORDENAR POR LA COLUMNA ID, Y OCULTARLA
		 //POR AHORA NO SE USA EL OCULTAR, ESTA COMENTADO
		'aaSorting': [[ 0, 'desc' ]],     
		//'aoColumns': [{ "bSearchable": false,"bVisible":    false },null,null,null,null,null,null,null]
		'aoColumns': [null,null]
		
	} );
	
	$('#frm_fase4').dataTable( { 
		'sPaginationType': 'full_numbers',
		
		 //ORDENAR POR LA COLUMNA ID, Y OCULTARLA
		 //POR AHORA NO SE USA EL OCULTAR, ESTA COMENTADO
		'aaSorting': [[ 0, 'desc' ]],     
		//'aoColumns': [{ "bSearchable": false,"bVisible":    false },null,null,null,null,null,null,null]
		'aoColumns': [null,null]
		
	} );
	
	$('#frm_fase5').dataTable( { 
		'sPaginationType': 'full_numbers',
		
		 //ORDENAR POR LA COLUMNA ID, Y OCULTARLA
		 //POR AHORA NO SE USA EL OCULTAR, ESTA COMENTADO
		'aaSorting': [[ 0, 'desc' ]],     
		//'aoColumns': [{ "bSearchable": false,"bVisible":    false },null,null,null,null,null,null,null]
		'aoColumns': [null,null]
		
	} );

});

</script>	
 
</head>

<body>

	<?php 
		//imagen principal TEMIS, y iconos volver al menu principal y cerrar sesion 
		require 'header.php';
		//menus, con imagen del modulo
		require 'secc_signot.php';
		
	?>			
	
	<!-- PARA QUE CARGUE LA VENTANA DEL POPUPBOX Y BLOQUIE EL FONDO -->
	<div id ="block"></div>
	<div id="popupbox"></div>
	
	<table border="0" cellspacing="0" cellpadding="0" align="center">
  		
		<tr>
    		<td></td>
  		</tr>
		
		 <tr>
    		<td>
				<!-- NOTA: LOS ID DE LOS CAMPOS ME DAN LOS ESTILOS, UBICADOS EN centro_servicios\views\css\main.css
				TENIENDO EN CUENTA EL ID DE LA TABLA DONDE SE ENCUENTRAN LOS CAMPOS EN ESTE CASO frm_editar
				LA class="required" ME PERMITE VALIDAR UN CAMPO CON JQUERY
				EN action="" NO ENVIO NADA YA QUE ESTE LLAMADO SE REALIZA EN require 'secc_sigdoc.php';
				IGUAL FUNCIONA SI SE DEFINE ALGUNA ACCION-->
				<!-- <div id="contenido"> -->
				
					<form id="frmanotacion" name="frmanotacion" method="post" enctype="multipart/form-data" action="">
						
						<!-- PARA ACTUALIZAR UN DOCUMENTO -->
						<input name="idproceso" id="idproceso" type="hidden" readonly="true"  value="<?php echo $d0; ?>">
						
					 	<center><div id="titulo_frm"><?php echo strtoupper($titulo); ?></div></center>
						
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
						
					
							<tr>
								<td>
									<label style="width:151px; color:#666666">Radicado:</label>
								</td>
								<td>
									<input type="text" name="radicadox" id="radicadox" readonly="true" value="<?php echo trim($d1); ?>">
								</td>
				
							</tr>
							
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Tipo Anotacion:</label>
						
								</td>
											
								<td>
									<select name="destipoanotacion" id="destipoanotacion" class="required" onchange="funcionAnotacion(this.value)" >
									<option value="" selected="selected">Seleccionar Tipo Anotacion</option> 
												
										<?php
											while($row = $datostipoanotacion->fetch()){
															
												echo "<option value=\"". $row[id] ."\">" . $row[destipo] . "</option>";
															
												/*if($row[id] == $d4){
													echo "<option value=\"". $row[id] ."\" selected='selected'>" . $row[nombre_proceso] . "</option>";
												}
												else{
													echo "<option value=\"". $row[id] ."\">" . $row[nombre_proceso] . "</option>";
												}*/
														
											}
										?>
									</select>
								</td>
											
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Parte del Proceso:</label>
						
								</td>
											
								<td>
												
									<select name="parteproceso" id="parteproceso" class="required">
									
									<option value="" selected="selected">Seleccionar Parte del Proceso</option> 
												
										<?php
											while($row = $datosparteproceso_2->fetch()){
															
												//echo "<option value=\"". $row[id] ."\">" . $row[nombre] . "</option>";
												
												echo "<option value=\"". $row[id].", CEDULA: ".$row[cedula].", NOMBRE: ".$row[nombre] ."\">" . $row[nombre] . "</option>";
															
												
														
											}
										?>
									
									<option value="NINGUNA">NINGUNA</option> 
									
									</select>
								</td>
											
							</tr>
							
							
							<tr>
								<td>
									<label style="width:151px; color:#FF0000; font-size:16px">NOTA:</label>
								</td>
								<td style="color:#FF0000; font-size:16px">
									En el campo Anotacion ser lo mas explicito posible, con respecto a la fecha o fechas especificas de diligencia de la parte del proceso.
								</td>
							
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Anotacion:</label>
								</td>
								<td>
									<textarea name="anotacion" id="anotacion" cols="50" rows="5" maxlength = "10000" class="required"></textarea>
								</td>
				
							</tr>
						 	<tr id="campo_interrogatorio" style="visibility: hidden">
                                <td><label style="width:151px; color:#666666">Fecha:</label></td>
                                <td><input type="date" id="fecha_interrogatorio" name="fecha_interrogatorio"  placeholder="Fecha Interrogatorio" /></td>
                            </tr>
                            <tr id="field_horaDiligencia" style="visibility: hidden">
                                <td><label style="width:151px; color:#666666">Hora:</label></td>
                                <td><input type="time" id="hora_interrogatorio" onchange="date_diligencia()" name="hora_interrogatorio" placeholder="Hora Interrogatorio" /></td>
                            </tr>

							<tr>
                                <td colspan="2">
                                    <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_partesproceso">
                                        <thead> 
                                            <tr>
                                                <th bgcolor="#CDE3F9" colspan="1">
                                                    <center><div id="titulo_frm"><p style="color:green; font-size:16px;">Observaciones</p></div></center>
                                                </th>
                                            </tr>
                                            <tr><th></th></tr> 
                                        </thead> 
                                        <tbody>
											<?php while($row = $datosObservacion->fetch()){ ?>
												<tr><td><?php echo $row['observacion']; ?> </td></tr>
											<?php } ?> 
                                        </tbody> 
                                    </table>
                                </td>
                            </tr>
							<tr>
					
								<td colspan="2">
								
									<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_partesproceso">
													
												<thead> 
													<tr>
														<th bgcolor="#CDE3F9" colspan="4">
															<center><div id="titulo_frm"><?php echo strtoupper($subtitulo2); ?></div></center>
														</th>
													</tr>
													<tr> 
														<th>Id</th>
														<th>Cedula</th>
														<th>Nombre</th>
														<th>Clasificacion Parte</th>
														<!-- <th>En Devolucion</th>
														<th>-</th> -->
														
													</tr> 
												</thead> 
																
												<tbody> 
																
													<?php while($row = $datosparteproceso->fetch()){ ?>
											
														<tr>
															<td><?php echo $row[id];?></td>
															<td><?php echo $row[cedula];?></td>
															<td><?php echo $row[nombre];?></td>
															<td><?php echo $row[clasificacion];?></td>
															<!-- <td><?php //echo $row[endevolucion];?></td> -->
															
															<?php /*if ( $row[endevolucion] == "SI" ) { ?>
																	<td><a class="activarparte" href="javascript:void(0);" data-id="<?php echo trim($row['id']) ;?>" data-radicado="<?php echo trim($d1);?>" data-idclaseparte="<?php echo trim($row['idclaseparte']) ;?>"><img src="views/images/a3.png" width="35" height="35" title="ACTIVAR PARTE"/></a></td>
															<?php } else{?>
																	<td>-</td>
															<?php }*/ ?>
															
															
														</tr>
												
													<?php } ?>
																
												</tbody>
												
										</table>
									
									</td>
									
								</tr>
							
							
							
							
							
							
							<!-- -----------------------------BOTONES--------------------------------------------------------- -->
							<tr>
								
								<td colspan="2">
									<!-- SE PREGUNTA SI LA VARIABLE $vbton NO ES VACIA, YA QUE ESTO NOS INDICA QUE VAMOS A ACTUALIZAR UN DOCUMENTO
									Y POR ENDE EL VALOR PASA A Actualizar-->
									<center>
										<!-- <input type="submit" name="Submit" value="<?php //echo $vbton; ?>" id="btn_input"> -->
										<input type="submit" name="Submit" value="<?php echo $vbton; ?>" id="btn_input" class="btn_validaranotacion">
										<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
									</center>
								</td> 
								
						  	</tr>
							
							<!-- ----------------------------------------------------------------------------------------------- -->
							
							
							
							<tr>
					
								<td colspan="2">
								
									<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_anotaciones">
													
												<thead> 
													<tr>
														<th bgcolor="#CDE3F9" colspan="6">
															<center><div id="titulo_frm"><?php echo strtoupper($subtitulo)." (BUSCAR POR NOMBRE)"; ?></div></center>
														</th>
													</tr>
													<tr> 
														<th>ID</th>
														<th>FECHA</th>
														<th>HORA</th>
														<th>REGISTRA</th>
														<th>TIPO</th>
														<th>ANOTACION</th>
													</tr> 
												</thead> 
																
												<tbody> 
																
													<?php while($row = $datosantotaciones->fetch()){ ?>
											
														<tr>
															<td><?php echo $row[id];?></td>
															<td><?php echo $row[fecha];?></td>
															<td><?php echo $row[hora];?></td>
															<td><?php echo $row[empleado];?></td>
															<td><?php echo $row[destipo];?></td>
															<td><?php echo $row[anotacion];?></td>
															
														</tr>
												
													<?php } ?>
																
												</tbody>
												
										</table>
									
									</td>
									
								</tr>
								
								
								
								
								
								<tr>
					
									<td colspan="2">
								
										<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_fase1">
													
												<thead> 
												
													<tr>
														<th bgcolor="#CDE3F9" colspan="2">
															<center><div id="titulo_frm"><?php echo strtoupper("ANOTACIONES SIGNOT ANTERIOR (FASES)")." (BUSCAR POR CEDULA)"; ?></div></center>
														</th>
													</tr>
													<tr>
														<th bgcolor="#CDE3F9" colspan="2">
															<center><div id="titulo_frm"><?php echo strtoupper("fase 1 / CITACION"); ?></div></center>
														</th>
													</tr>
													<tr> 
														<th>ID</th>
														<th>ANOTACION</th>
													</tr> 
												</thead> 
																
												<tbody> 
																
													<?php $nunregistro = 1; while($row = $datosfase1->fetch()){ ?>
											
														<tr>
															<td><?php echo $nunregistro;?></td>
															<td style="font-size:16px;"><?php echo $row[FASE1];?></td>
														</tr>
												
													<?php $nunregistro = $nunregistro + 1;} ?>
																
												</tbody>
												
										</table>
									
									</td>
									
								</tr>
								
								
								<tr>
					
									<td colspan="2">
								
										<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_fase2">
													
												<thead> 
												
													
													<tr>
														<th bgcolor="#CDE3F9" colspan="2">
															<center><div id="titulo_frm"><?php echo strtoupper("fase 2 / NOTIFICACION PERSONAL"); ?></div></center>
														</th>
													</tr>
													<tr> 
														<th>ID</th>
														<th>ANOTACION</th>
													</tr> 
												</thead> 
																
												<tbody> 
																
													<?php $nunregistro = 1; while($row = $datosfase2->fetch()){ ?>
											
														<tr>
															<td><?php echo $nunregistro;?></td>
															<td style="font-size:16px;"><?php echo $row[FASE2];?></td>
														</tr>
												
													<?php $nunregistro = $nunregistro + 1;} ?>
																
												</tbody>
												
										</table>
									
									</td>
									
								</tr>
								
								<tr>
					
									<td colspan="2">
								
										<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_fase3">
													
												<thead> 
												
													
													<tr>
														<th bgcolor="#CDE3F9" colspan="2">
															<center><div id="titulo_frm"><?php echo strtoupper("fase 3 / NOTIFICACION POR AVISO"); ?></div></center>
														</th>
													</tr>
													<tr> 
														<th>ID</th>
														<th>ANOTACION</th>
													</tr> 
												</thead> 
																
												<tbody> 
																
													<?php $nunregistro = 1; while($row = $datosfase3->fetch()){ ?>
											
														<tr>
															<td><?php echo $nunregistro;?></td>
															<td style="font-size:16px;"><?php echo $row[FASE3];?></td>
														</tr>
												
													<?php $nunregistro = $nunregistro + 1;} ?>
																
												</tbody>
												
										</table>
									
									</td>
									
								</tr>
								
								<tr>
					
									<td colspan="2">
								
										<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_fase4">
													
												<thead> 
												
													
													<tr>
														<th bgcolor="#CDE3F9" colspan="2">
															<center><div id="titulo_frm"><?php echo strtoupper("fase 4 / DEVOLUCION"); ?></div></center>
														</th>
													</tr>
													<tr> 
														<th>ID</th>
														<th>ANOTACION</th>
													</tr> 
												</thead> 
																
												<tbody> 
																
													<?php $nunregistro = 1; while($row = $datosfase4->fetch()){ ?>
											
														<tr>
															<td><?php echo $nunregistro;?></td>
															<td style="font-size:16px;"><?php echo $row[FASE4];?></td>
														</tr>
												
													<?php $nunregistro = $nunregistro + 1;} ?>
																
												</tbody>
												
										</table>
									
									</td>
									
								</tr>
							
								
								<tr>
					
									<td colspan="2">
								
										<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_fase5">
													
												<thead> 
												
													
													<tr>
														<th bgcolor="#CDE3F9" colspan="2">
															<center><div id="titulo_frm"><?php echo strtoupper("fase 5"); ?></div></center>
														</th>
													</tr>
													<tr> 
														<th>ID</th>
														<th>ANOTACION</th>
													</tr> 
												</thead> 
																
												<tbody> 
																
													<?php $nunregistro = 1; while($row = $datosfase5->fetch()){ ?>
											
														<tr>
															<td><?php echo $nunregistro;?></td>
															<td style="font-size:16px;"><?php echo $row[FASE5];?></td>
														</tr>
												
													<?php $nunregistro = $nunregistro + 1;} ?>
																
												</tbody>
												
										</table>
									
									</td>
									
								</tr>
		
							
						
				
						</table>
					
					</form>
			
				<!-- </div> -->
				
			</td>
		</tr>
		
		
	</table>
	
	
<?php 
	require 'alertas.php';

?>
</body>
</html>


	
