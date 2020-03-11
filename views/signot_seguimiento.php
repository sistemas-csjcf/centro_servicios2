<?php 
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	$idusuario  = $_SESSION['idUsuario'];
	
	//TITULO FORMULARIO
	$titulo     = "Filtrar Proceso";
	$subtitulo  = "Procesos";
	
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo       = new signotModel();

	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual  = $modelo->get_fecha_actual_amd();
	

	$opcion = trim($_GET['dato_0']);
	
	if($opcion != 1){
	
		$datosproceso = $modelo->get_datos_proceso(1);
	}
	else{
		$datosproceso = $modelo->get_datos_proceso(2);
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
<script src="views/js/ajax/ajax_signot.js" type="text/javascript" charset="utf-8"></script>

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
	
	<table border="0" cellspacing="0" cellpadding="0" align="center">
  		
		<tr>
    		<td></td>
  		</tr>
		
		 <tr>
    		<td>
				<!-- NOTA: LOS ID DE LOS CAMPOS ME DAN LOS ESTILOS, UBICADOS EN centro_servicios\views\css\main.css
				TENIENDO EN CUENTA EL ID DE LA TABLA DONDE SE ENCUENTRAN LOS CAMPOS EN ESTE CASO frm_editar
				LA class="required" ME PERMITE VALIDAR UN CAMPO CON JQUERY-->
				<div id="contenido">
				
					<form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
					
						<input name="consecutivodocumento" id="consecutivodocumento" type="hidden" readonly="true"/>
						
						<!-- PARA ACTUALIZAR UN DOCUMENTO -->
						<input name="iddocumento" id="iddocumento" type="hidden" readonly="true"  value="<?php echo $d0; ?>">
						<!-- PARA SABER CUANTAS PARTES SE LE ASIGNARON MAS AL DOCUMENTO -->
						<input name="partesdoc" id="partesdoc" type="hidden" readonly="true"/>
						
					 	<div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>
						
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
						
							
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Fecha Inicial:</label>
								</td>
								<td>
									<input type="text" name="fechai" id="fechai" class="required" readonly="true" value="<?php echo trim($_GET['dato_1']); ?>">
								</td>
								<td>
									<label style="width:151px; color:#666666">Fecha Final:</label>
								</td>
								<td>
									<input type="text" name="fechaf" id="fechaf" class="required" readonly="true" value="<?php echo trim($_GET['dato_2']); ?>">
								</td>
							
							</tr>
							
						
							<tr>
								<td>
									<label style="width:151px; color:#666666">Radicado:</label>
								</td>
								<td colspan="3">
									<input type="text" name="radicadox" id="radicadox" class="required number" value="<?php echo trim($_GET['datox1']); ?>">
								</td>
				
							</tr>
							
							
							<!-- -----------------------------BOTONES--------------------------------------------------------- -->
							<tr>
								
								<td colspan="4">
									<center>
										<input type="button" name="consultar" value="Consultar" id="btn_input" class="filtrarproceso">
										<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
									</center>
								</td> 
								
						  	</tr>
							
							<!-- ----------------------------------------------------------------------------------------------- -->
						
			
						</table>
					
					</form>
			
				</div>
				
			</td>
		</tr>
		
		
	</table>
	
	<?php
	//PREGUNTO SI SE A ENVIADO ALGUN FILTRO PARA QUE LA TABLA SEA VISIBLE.
	//if(!empty($opcion)){ 
	?>
	
	<!-- NOTA: SE CIERRA LAS COLUMNAS Y CAMPOS, YA QUE NO SON NECESARIOS SU VISIVILIDAD, SI SE NECESITAN SIMPLEMENTE SE DESCOMENTAN -->
	<table border="0" align="center"  rules="rows" id="tablaconsulta">
		
			
				<tr>
					
					<td>
					
						<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_editar1">
										
							<thead> 
										<tr>
											<th bgcolor="#CDE3F9" colspan="4">
												<center><div id="titulo_frm"><?php echo strtoupper($subtitulo); ?></div></center>
											</th>
										</tr>
										<tr> 
											<th>ID</th>
											<th>RADICADO</th>
											<th>-</th>
											<th>-</th>
										</tr> 
									</thead> 
													
									<tbody> 
													
										<?php while($row = $datosproceso->fetch()){ ?>
											
											
											<tr>
												<td><?php echo $row[id];?></td>
												<td><?php echo $row[radicado];?></td>
												<!-- <td><?php //$newtext = wordwrap($row[asunto], 20, "\n", true); echo $newtext;?></td> -->
												<!-- wordwrap me permite cortar las lineas del texto cuando cuente 20 caracteres y baja el siguiente a otra linea 
												esto con el objeto que se refleje todo el texto en la tabla html y no se alargue dicha tabla-->
												<!-- <td><?php //$newtext = wordwrap($row[contenido],20, "\n", true); echo $newtext;?></td> -->
												
												<?php if ( $row[iddevolucion] == 0 ) { ?>
												
													<?php //if ( in_array($_SESSION['idUsuario'],$usuariosa) ) { ?>
														
													<td></td>	
													<td><a class="anotacion" href="javascript:void(0);" data-id="<?php echo $row['id'];?>"><img src="views/images/modficar.jpg" width="35" height="35" title="REGISTRAR ANOTACION"/></a></td>
															
													<?php //} ?>
													
												<?php } else{?>
													  
													  <td><?php //echo $row[nombre_tipo_documento];?></td>
													  <td><a class="anotacion" href="javascript:void(0);" data-id="<?php echo $row['id'];?>"><img src="views/images/modficar.jpg" width="35" height="35" title="REGISTRAR ANOTACION"/></a></td>
												<?php } ?>
													
											
											</tr>
									
										<?php } ?>
													
									</tbody>
							</table>
						
						</td>
					</tr>
			
			
			</table>		
			
			<?php
			//} 
			?>

		
<?php require 'alertas.php';?>
</body>
</html>


	
