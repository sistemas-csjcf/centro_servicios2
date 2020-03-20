<?php 
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS

	//TITULO FORMULARIO
	$titulo     = "Registro de Documentos";
	$subtitulo  = "Partes Documento";
	$subtitulo2 = "PARTES DEL PROCESO";
	$subtitulo4 = "Documento";
	$subtitulo5 = "Lista de Procesos / Registros: ";
	$subtitulo6 = "Datos Proceso";

	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo       = new documentosModel();

	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual  = $modelo->get_fecha_actual_amd();

	//OBTENEMOS LISTADO SEGUN LA LISTA SOLICITADA

	/*$nombrelista  = 'pa_documento';
	$campoordenar = 'nombre_documento';
	$datosdocumentos = $modelo->get_lista($nombrelista,$campoordenar);*/

	//-------SE DETERMINA CUALES DOCUMENTOS SE VAN A REFLEJAR EN LA LISTA DOCUMENTOS-----------------------------
	//ESTO CON EL OBJETIVO DE PARAMETRIZAR DESDE LA BASE DE DATOS Y NO TOCAR EL CODIGO CUANDO SE NECESITE
	//EN LA LISTA OTRO DOCUMENTO
	$campos              = 'idtabla';
	$nombrelista         = 'pa_modulo_acciones';
	$idaccion			 = '5';
	$campoordenar        = 'id';
	$datosmodulos        = $modelo->get_lista_modulos_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$modulost1           = $datosmodulos->fetch();
	$modulost2			 = $modulost1[idtabla];

	//echo $modulost2;
	$nombrelista   = 'pa_documento';
	$campoordenar  = 'nombre_documento';
	$filtro        = $modulost2;
	$formaordenar  = 'ASC';
	$datosdocumentos = $modelo->get_lista_filtro($nombrelista,$campoordenar,$filtro,$formaordenar);

	//------------------------------------------------------------------------------------------------------------

	/*$nombrelista  = 'pa_tipodocumento';
	$campoordenar = 'nombre_tipo_documento';
	$datostipodocumento = $modelo->get_lista($nombrelista,$campoordenar);*/

	$nombrelista   = 'sigdoc_pa_dirigido';
	$campoordenar  = 'nombre_dirigido';
	$datosdirigido = $modelo->get_lista($nombrelista,$campoordenar);

	//SI $datosdocumento ES DIFERENTE DE VACIA QUIERE DECIR QUE SE DIO CLIC
	//EN LA VISTA sigdoc_listar_documentos_salientes.php EN EL BOTON EDITAR
	//Y SE CARGAN LOS DATOS EN EL FORMULARIO sigdoc_documentos_salientes.php SEGUN LOS DATOS
	//DEL DOCUMENTO ESPECIFICADO, ESTO SE MANEJA ASI PARA NO CREAR OTRA VISTA Y OPTIMIZAR ESTE PROCESO
	//DE CREAR UNA VISTA PARA ACTUALIOZAR UN DOCUMENTO,SI NO QUE SE HAGA EN EL MISMO FORMULARIO DE REGISTRO
	//VISTA sigdoc_documentos_salientes.php
	if(!empty($datosdocumento)){
		//$titulo  = "(SIGDOC) Modificar Documento Saliente";
		$vbton   = "Actualizar";
		while($fila = $datosdocumento->fetch()){
			$d0  = $fila[id];
			
			$titulo  = "Modificar Documento, Id: ".$d0;
			
			$d3  = $fila[idtipodocumento];
			$d4  = $fila[numero];
			$d5  = $fila[dirigidoa];
			$d6  = $fila[nombre];
			$d7  = $fila[cargo];
			$d8  = $fila[dependencia];
			
			$d9  = $fila[fechageneracion];
			$fechaactual = $d9;
			
			$d10 = $fila[asunto];
			$d11 = $fila[contenido];
			
			$d12 = $fila[idradicado];
			$d13 = $fila[partes];
		}
	}
	
	//ESTA VARIABLE ME PERMITE DETERMINAR SI SE LE ESTA DANDO RESPUESTA A UN DOCUMENTO ENTRANTE
	//ES CARGADA DESDE LA VISTA sigdoc_listar_documentos_entrantes.php AL DAR CLIC EN EL BOTON
	//DAR RESPUESTA DOCUMENTO
	if(!empty($idrespuesta)){
		$titulo = "(SIGDOC) Respuesta Documento Entrante, Id: ".$idrespuesta;
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
<!-- <script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> -->

<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
<script src="views/js/jquery.validate.js" type="text/javascript"></script>
<script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                    	
<link href="views/css/pepper-grinder/ui.all.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
<link href="views/css/main.css" rel="stylesheet" type="text/css">

<!-- -------------------------------------------------------------------- -->

<!-- USO DE ARCHVIO PARA VALIDACIONES DE CAMPOS Y APLICACION DE FUNCIONES -->
<script src="views/js/ajax/ajax_documentos.js" type="text/javascript" charset="utf-8"></script>

<!-- PARA MANEJAR LOS ESTILOS DEL FORMULARIO 
<link href="views/css/main.css" rel="stylesheet" type="text/css">-->

<!-- PARA EL FUNCIONAMIENTO DE LAS TABLAS EN SU FILTRO Y PAGINACION 
<script type="text/javascript" language="javascript" src="views/viewstablas/jquery.dataTables.js"></script> 
<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_page.css"/ >
<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_table.css"/ >-->

<!-- PARA LAS FECHAS -->
<script type="text/javascript" src="views/fechajquery/jquery.datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="views/fechajquery/jquery.datetimepicker.css"/ >

<!-- PARA LAS VENTANAS EMERGENTES POPUPBOX -->
<script src="views/js/ajax/ajax_popupbox_empleados_registro_entrada_salida.js" type="text/javascript" charset="utf-8"></script>
<link href="views/css/stylepopupbox.css" rel="stylesheet" type="text/css">

<!-- -------------------------------------------------------------------- -->

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

	//aqui puedo pegar el codigo del archivo ubicado en  views/js/ajax/ajax_sigdoc.js
	//y que esta entre $(function(){ });
		

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
				
					<form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
						
						<!-- RADICADO CONSULTADO, AL DAR CLIC ALGUNA FLECHA AZUL -->
						<input name="radicadoconsultado" id="radicadoconsultado" type="hidden" readonly="true">
						<!-- <input name="filaconsultada" id="filaconsultada" type="text" readonly="true"> -->
						
						<!-- PARA ACTUALIZAR UN DOCUMENTO -->
						<input name="iddocumento" id="iddocumento" type="hidden" readonly="true"  value="<?php echo $d0; ?>">
						<!-- PARA ACTUALIZAR EL CONSECUTIVO DE UN DOCUMENTO -->
						<input name="consecutivodocumento" id="consecutivodocumento" type="hidden" readonly="true"/>
						<!-- PARA SABER CUANTAS PARTES SE LE ASIGNARON MAS AL DOCUMENTO -->
						<input name="partesdoc" id="partesdoc" type="hidden" readonly="true"/>
						<!-- PARA SABER CUALES SON LAS SIGLAS DEL DOCUMENTO -->
						<!-- <input name="siglas" id="siglas" type="hidden" readonly="true"/> -->
						<!-- PARA DAR RESPUESTA A UN DOCUMENTO -->
						<input name="idrespuesta" id="idrespuesta" type="hidden" readonly="true" value="<?php echo $idrespuesta; ?>"/>
					 	<center><div id="titulo_frm"><?php echo strtoupper($titulo); ?></div></center>
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
							<tr>
								<td>
									<label style="width:151px; color:#666666">Radicado:</label><br>
									 <input type="text" name="radicado4" id="radicado4" class="required"/>
								</td>
								<td>
                                  <!-- <input type="text" name="radicado4" id="radicado4" class="required number" maxlength="23" minlength="23" value="<?php echo $d10; ?>"/> -->
								  <a id="buscar_proceso" href="javascript:void(0);"><img src="views/images/lupa.jpg" width="45" height="45" title="Buscar Proceso"/></a>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<center><div id="titulo_frm"><?php echo strtoupper($subtitulo5); ?> <input type="text" name="nunreg" id="nunreg" readonly="true" style="text-align:right; width:50px"/></div></center>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<table>
										<tr>
											<td>
												<div id="cont3"> 
													<table id="t3" border="1"> 
														<tr>			
															<td>
																<strong>Id</strong>
															</td>
															<td>
																<strong>Radicado</strong>
															</td>
															<td>
																<strong>Juzgado Origen</strong>
															</td>
															<td>
																<strong>Clase Proceso</strong>
															</td>
															<td>
																<strong>-</strong>
															</td>
														</tr> 
													</table>
												</div>
											</td>
										</tr>
									</table>				
								</td>			
							</tr>
							<tr>
								<td colspan="2">
									<center><div id="titulo_frm"><?php echo strtoupper($subtitulo6); ?></div></center>
								</td>
							</tr>
							<tr>
								<td colspan="2"> 
									<table border="0" align="center" width="800">
										<tr>
											<td colspan="2">
												<label style="width:151px; color:#666666">id</label><br><br>
												<input type="text" name="idr" id="idr" class="required" readonly="true"/>
											</td>
										</tr>
										<tr>
											<td>
												<label style="width:151px; color:#666666">Juzgado Origen</label><br><br>
												<input type="text" name="jo" id="jo" class="" readonly="true"/>
											</td>
											
											<td colspan="2">
												<label style="width:151px; color:#666666">Clase Proceso</label><br><br>
												<input type="text" name="claseproceso" id="claseproceso" class="" readonly="true"/>
											</td>
										</tr>
										<!-- <tr>
											<td>
												<label style="width:151px; color:#003300; font-size:16px">NOTA 1:</label>
											</td>
											<td style="color:#003300; font-size:16px">
												Si la columna (Direccion, Departamento, Municipio) de la tabla PARTES DEL PROCESO estan sin informacion, debe dirigirse a la opcion (Gestionar Proceso / Adicionar Partes al Proceso), definir el Radicado luego consultar y Asignar Direccion a la parte en cuestion, para poder realizar el registro de un (DOCUMENTO y TIPO DE DOCUMENTO).
											</td>
									
										</tr>
										
										<tr>
											<td>
												<label style="width:151px; color:#FF0000; font-size:16px">NOTA 2:</label>
											</td>
											<td style="color:#FF0000; font-size:16px">
												Si la columna (En Devolucion) de la tabla PARTES DEL PROCESO de alguna de las partes esta en estado (SI), debe dirigirse a la opcion (Seguimiento Proceso), definir el Radicado luego consultar y Activar la parte en cuestion, para poder realizar el registro de un (DOCUMENTO y TIPO DE DOCUMENTO).
											</td>
										</tr> -->
										<tr>
											<td colspan="2">
												<center><div id="titulo_frm"><?php echo strtoupper($subtitulo2); ?></div></center>
											</td>
										</tr>
										<tr>
											<td colspan="2">
												<table>
													<tr>
														<td>
															<div id="cont2"> 
																<table id="t2" border="1"> 
																	<tr>
																		<td>
																			<strong>Id Parte</strong>
																		</td>
																		<td>
																			<strong>Id Direccion</strong>
																		</td>
																		<td>
																			<strong>Cedula</strong>
																		</td>
																		<td>
																			<strong>Nombre</strong>
																		</td>
																		<td>
																			<strong>Direccion</strong>
																		</td>
																		<!--<td>
																			<strong>Telefono</strong>
																		</td> -->
																		<td>
																			<strong>Departamento</strong>
																		</td>
																		<td>
																			<strong>Municipio</strong>
																		</td> 
																		<td>
																			<strong>Id Clasificacion Parte</strong>
																		</td>
																		<td>
																			<strong>Clasificacion Parte</strong>
																		</td>
																		
																		<td>
																			<strong>En Devolucion</strong>
																		</td>
																		
																		<td>
																			<strong>ESTADO</strong>
																		</td>
																		
																		<td>
																			<strong>Activar Direccion</strong>
																		</td>
																	
																		<td>
																			<strong>Anotaciones</strong>
																		</td>
																		
																		<td>
																			<strong>Cargar Datos Parte</strong>
																		</td>
																	</tr> 
																</table>
															</div>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<center><div id="titulo_frm"><?php echo strtoupper($subtitulo4); ?></div></center>
								</td>
							</tr>
							<!-- <tr>
								<td colspan="2">
									<label style="width:151px; color:#FF0000">NOTA: SE PUEDE GENERAR UNA NOTIFICACION SIN HABERSE GENERADO UNA CITACION, 
									                                          ESTO SOLO APLICA EN EL CASO DE QUE UNA PERSONA VENGA A NOTIFICARSE SI LA CITACION 
																			  NO FUE GENERADA POR EL SISTEMA.</label>
								</td>
							</tr> -->
							<tr>
								<td>
									<label style="width:151px; color:#666666">Documento:</label>
								</td>
								<td>
									<select name="documento" id="documento" class="required">
										<option value="" selected="selected">Seleccionar Documento</option> 
										<?php
											while($row = $datosdocumentos->fetch()){
												echo "<option value=\"". $row[id] ."\">" . $row[nombre_documento] . "</option>";
											}
										?>
									</select>
									<!-- <label style="width:151px; color:#666666">Contador:</label>
									<label id="contadordoc" style="width:151px; color:#666666"></label>
									<a class="incrementarcontador" href="javascript:void(0);" data-id="<?php //echo $field['id'];?>" data-radicado="<?php //echo $field['radicado'];?>" data-juzgadodestino="<?php //echo $field['idjuzrep'];?>"><img src="views/images/mas.jpg" width="30" height="30" title="INCREMENTAR CONTADOR" style="float:right "/></a> -->
								</td>
							</tr>
							<tr>
								<td>
									<label style="width:151px; color:#666666">Tipo Documento:</label>
								</td>
								<td>
									<div class="ui-widget">
									<select name="tipodocumento" id="tipodocumento" class="required">
										<option value="" selected="selected">Seleccionar Tipo Documento</option> 
										<?php
											/*while($row = $datostipodocumento->fetch()){
												//if($row[id] == 1 || $row[id] == 2){
													//PREGUNTO QUE OPCION SE ENVIO PARA SER SELECCIONADA
													//DE LA VISTA sigdoc_listar_documentos_salientes.php
													if($row[id] == $d3){
														echo "<option value=\"". $row[id] ."\" selected='selected'>" . $row[nombre_tipo_documento] . "</option>";
													}
													else{
														echo "<option value=\"". $row[id] ."\">" . $row[nombre_tipo_documento] . "</option>";
													}
												//}
												
												
											}*/
										
										?>
									</select>
									
									</div>
									
								</td>
								
							</tr>
						
							<tr id="filand">
								<td>
									<label style="width:151px; color:#666666">Numero Documento:</label>
								</td>
								<td>
									<input type="text" name="ndocumento" id="ndocumento" class="required" readonly="true" value="<?php echo $d4; ?>"/>
								</td>
								
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Dirigido a:</label>
			
								</td>
								
								<td>
									
									<select name="dirigidoa" id="dirigidoa" class="required">
                 		
										<option value="" selected="selected">Seleccionar Dirigido a</option> 
						
										<?php
											while($row = $datosdirigido->fetch()){
												
												//PREGUNTO QUE OPCION SE ENVIO PARA SER SELECCIONADA
												//DE LA VISTA sigdoc_listar_documentos_salientes.php
												if($row[id] == $d5){
													echo "<option value=\"". $row[id] ."\" selected='selected'>" . $row[nombre_dirigido] . "</option>";
												}
												else{
													echo "<option value=\"". $row[id] ."\">" . $row[nombre_dirigido] . "</option>";
												}
												
											}
										?>
									</select>
								</td>
								
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Nombre:</label>
								</td>
								<td>
									<input type="text" name="nombre" id="nombre" class="required" readonly="true" maxlength="2000" value="<?php echo $d6; ?>"/>
								</td>
								
							</tr>
							
							<tr id="filaidparte">
								<td>
									<label style="width:151px; color:#666666">Id Parte Proceso:</label>
								</td>
								<td>
									<input type="text" name="idparte" id="idparte" readonly="true"/>
									<input type="text" name="iddir" id="iddir" readonly="true"/>
									<input type="text" name="idclaseparte" id="idclaseparte" readonly="true"/>
									
								</td>
								
							</tr>
							
							
							<tr id="filacargo">
								<td>
									<label style="width:151px; color:#666666">Direccion:</label>
								</td>
								<td>
									<input type="text" name="direccion" id="direccion" class="required" readonly="true" maxlength="2000" value="<?php echo $d7; ?>"/>
								</td>
								
							</tr>
							
							<tr id="filadependencia">
								<td>
									<label style="width:151px; color:#666666">Ciudad:</label>
								</td>
								<td>
									<input type="text" name="ciudad" id="ciudad" class="required" readonly="true" maxlength="2000" value="<?php echo $d8; ?>"/>
								</td>
								
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Fecha Generacion:</label>
								</td>
								<td>
									<input type="text" name="fechag" id="fechag" class="required" value="<?php echo $fechaactual; ?>" readonly="true">
								</td>
							
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Fecha Auto:</label>
								</td>
								<td>
									<input type="text" name="fechaauto" id="fechaauto" class="required" readonly="true">
								</td>
							
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Asunto:</label>
								</td>
								<td>
									<input type="text" name="asunto" id="asunto" class="required" readonly="true" value="<?php echo $d10; ?>"/>
								</td>
								
							</tr>
							
							<tr>
								<td bgcolor="#CDE3F9" colspan="16">
									<center><div id="titulo_frm"><?php echo strtoupper($subtitulo); ?></div></center>
								</td>
							</tr>
							
							<tr>
								<td colspan="2">
									<div id="campos"></div>
								</td>
							</tr>
							
							
							
							<!-- OCULTO ESTA FILA YA QUE EL PROGRAMA ARMARA AUTOMATICAMENTE EL CONTENIDO DEL DOCUMENTO -->
							<tr id="filacontenido">
								<td colspan="2"> 
								
									<table border="0">
									
										<tr>
											<td>
												<label style="width:151px; color:#666666">Contenido Documento</label><br><br>
												<textarea name="detalleds" id="detalleds" cols="100" rows="10" maxlength = "100000" class="required">X<?php echo $d11; ?></textarea>
											</td>
											
										</tr>
										
									</table>
									
								</td>
							</tr>
							
							<!-- -----------------------------BOTONES--------------------------------------------------------- -->
							<tr>
								
								<td colspan="2">
									<!-- SE PREGUNTA SI LA VARIABLE $vbton NO ES VACIA, YA QUE ESTO NOS INDICA QUE VAMOS A ACTUALIZAR UN DOCUMENTO
									Y POR ENDE EL VALOR PASA A Actualizar-->
									<center>
										<input type="submit" name="Submit" value="<?php if(empty($vbton)){ echo "Registrar";}else{echo "Actualizar";} ?>" id="btn_input">
										<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
									</center>
								</td> 
								
						  	</tr>
							
							<!-- ----------------------------------------------------------------------------------------------- -->
						
				
						</table>
					
					</form>
			
				<!-- </div> -->
				
			</td>
		</tr>
		
		
	</table>
	
	<?php require 'alertas.php';?>
	
	<?php 
		
		if(!empty($radicado_consultado)){
		
			
			echo '<script languaje="JavaScript"> 
			
					var dat_1 = "'.$radicado_consultado.'";
								
					Adicionar_Dato_Radicado(dat_1);
						
				</script>';
		
		}
			
	?>
	
</body>
</html>

	
