<?php 
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	//TITULO FORMULARIO
	$titulo     = "GENERAR CITACION";
	$subtitulo  = "PARTES DEL PROCESO A CITAR";
	//$subtitulo2 = "Permisos Usuario";
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new signotModel();
	
	//OBTENEMOS LA FECHA ACTUAL
	//$fechaactual = $modelo->get_fecha_actual_amd();
	//OBTENEMOS LA HOAR ACTUAL
	//$horaactual        = $modelo->get_hora_actual_24horas();
	//SOLO PARA VISUALIZACION DEL USUARIO, REALMENTE EL QUE SE REGISTRA EN LA BASE DE DATOS ES $horaactual
	//$horaactualespejo  = $modelo->get_hora_actual_12horas();
	
	
	//OBTENEMOS LISTADO SEGUN LA LISTA SOLICITADA
	
	$nombrelista  = 'pa_year';
	$campoordenar = 'year';
	$formaordenar = 'DESC';
	$datosyear    = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	
	$nombrelista  = 'pa_juzgado';
	$campoordenar = 'id';
	$formaordenar = '';
	$datosjuzgado = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	
	/*$nombrelista  = 'signot_pa_clase_proceso';
	$campoordenar = 'nombre_proceso';
	$formaordenar = '';
	$datosclaseproceso = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);*/
	
	$nombrelista  = 'signot_clasificacion_parte';
	$campoordenar = 'descripcion';
	$formaordenar = '';
	$datosclasificacion = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	
	$nombrelista  = 'signot_pa_departamento';
	$campoordenar = 'descripcion';
	$formaordenar = '';
	$datosdepartamento = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	

	
	if(!empty($datosdocumento)){
	
		$vbton  = "Actualizar";
	
		while($fila = $datosdocumento->fetch()){
			
			$d0  = $fila[id];
			
			$titulo = "Modificar Documentos Entrantes Juzgados, Id: ".$d0;
			
			$d1  = $fila[fecha];
			$fechaactual = $d1;
			
			$d2  = $fila[hora];
			$horaactual = $d2;
			
			$d3  = $fila[remitente];
			$d4  = $fila[idtipodocumento];
			$d5  = $fila[numero];
			$d6  = $fila[nfc];
			$d7  = $fila[idjuzgadodestino];
			
			//envio el id del juzgado para saber cual es el funcionario asignado a el
			//y cargar el campo empleado
			$d8  = $modelo->get_nombre_usuario_juzgado($d7);
			$row = $d8->fetch();
			$d8b = $row[empleado];
			
		}
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/> 
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
	
	
	//PARA LAS FECHAS
	//$("#fechae").datepicker({ changeFirstDay: false	});
	
	
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
				<div id="contenido">
				
					<form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
			
						<!-- <input name="iddocumento" id="iddocumento" type="hidden" readonly="true"  value="<?php //echo $d0; ?>"> -->
						<!-- <input name="consecutivodocumento" id="consecutivodocumento" type="hidden" readonly="true"/> -->
						
						<input name="idradicado" id="idradicado" type="hidden" readonly="true" class="required"/>
						
					 	<div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>
						
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
						
							<tr>
								<td>
									<label style="width:151px; color:#666666">Radicado:</label>
								</td>
								<!-- USO maxlength="23" minlength="23" PARA QUE EL DATO DEL RADICADO ESTE CONFORMADO POR 23 CARACTERES
								Y SEA VALIDADO POR LA LIBRERIA jquery.validate-->
								<td>
									<input type="text" name="radicadox2" id="radicadox2" class="required" maxlength="23" minlength="23" onKeyUp="Traer_Datos_Notificaciones(this.value)"/>
								</td>
								
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Juzgado:</label>
								</td>
								
								<td>
									<input type="text" name="juzgadox" id="juzgadox" class="required" readonly="true"/>
								</td>
								
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Clase Proceso:</label>
								</td>
								
								<td>
									<input type="text" name="claseprocesox" id="claseprocesox" class="required" readonly="true"/>
								</td>
								
							</tr>
							
							<tr>
								<td colspan="2">
									<center><div id="titulo_frm"><?php echo strtoupper($subtitulo); ?></di></center>
								</td>
							</tr>
				
							<!-- <tr>
							
								<td colspan="2">
						
									<table border="0" align="center"  rules="rows">
									
										<tr>
												
											<td>
											
											
												<div id="cont2"> 
												
													<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="t2">
																				
														<thead> 
																	
															<tr> 
																					
																<th>Id</th>
																<th>Cedula</th>
																<th>Nombre</th>
																<th>Radicado</th>
																<th>Juzgado</th>
																<th>Auto</th>
																<th>Fecha Registro</th>
																<th>Fecha Auto</th>
																<th>Direccion</th>
																<th>Telefono</th>
																<th>Departamento</th>
																<th>Municipio</th>
																<th>-</th>
																					
															</tr> 
															
														</thead> 
														
													</table>
													
												</div>
											
		
											</td>
										
										</tr>
				
				
									</table>		
									
								</td>
							
							</tr>  -->
				
					
							<tr>
								<td colspan="2">
									<div id="ok"></div>
									<button style="border-style:none; background-color:#FFFFFF"></button>
								</td>
							</tr>
							<!-- -----------------------------BOTONES--------------------------------------------------------- -->
							<!-- <tr>
								
								<td colspan="2"> -->
									<!-- SE PREGUNTA SI LA VARIABLE $vbton NO ES VACIA, YA QUE ESTO NOS INDICA QUE VAMOS A ACTUALIZAR UN DOCUMENTO
									Y POR ENDE EL VALOR PASA A Actualizar-->
									<!-- <center>
										<input type="submit" name="Submit" value="<?php //if(empty($vbton)){ echo "Registrar";}else{echo "Actualizar";} ?>" id="btn_input" class="btn_validar"/>
										<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
									</center>
								</td> 
								
						  	</tr> -->
							
							<!-- ----------------------------------------------------------------------------------------------- -->
						
				
						</table>
						
						
					</form>
			
				</div>
				
			</td>
		</tr>
		
	</table>
	
	<br>
	
	<table border="0" align="center"  rules="rows">
									
		<tr>
												
			<td>
											
											
				<div id="cont2"> 
												
					<table cellpadding="0" cellspacing="0" rules="rows" border="5" class="display" id="t2">
																				
						<thead> 
																	
							<tr> 
																					
								<th>Id</th>
								<th>Cedula</th>
								<th>Nombre</th>
								<th>Radicado</th>
								<th>Juzgado</th>
								<th>Auto</th>
								<th>Fecha Registro</th>
								<th>Fecha Auto</th>
								<th>Direccion</th>
								<th>Telefono</th>
								<th>Departamento</th>
								<th>Municipio</th>
								<th>Correcion</th>
								<th>idCorrige</th>
								<th>-</th>
								<th>-</th>
																					
							</tr> 
															
						</thead> 
														
					</table>
													
				</div>
											
		
			</td>
										
		</tr>
				
				
	</table>		
	
								
								
									
								
<?php require 'alertas.php';?>
</body>
</html>


