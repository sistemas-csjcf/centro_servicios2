<?php 
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	//TITULO FORMULARIO
	$titulo     = "(SIGDOC) Registro de Documentos Salientes";
	$subtitulo  = "Registros de Documentos Salientes";
	//$subtitulo2 = "Permisos Usuario";
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo       = new sigdocModel();

	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual  = $modelo->get_fecha_actual_amd();

	//OBTENEMOS LISTADO SEGUN LA LISTA SOLICITADA
	
	$nombrelista  = 'sigdoc_pa_tipodocumento';
	$campoordenar = 'nombre_tipo_documento';
	$datostipodocumento = $modelo->get_lista($nombrelista,$campoordenar);
	
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
			
			$titulo  = "(SIGDOC) Modificar Documento Saliente, Id: ".$d0;
			
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
			//JUAN ESTEBAN MUNERA 2017-09-29
			$d12 = $fila[con_copia];
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> -->
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
<script src="views/js/ajax/ajax_sigdoc.js" type="text/javascript" charset="utf-8"></script>

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
<!-- JUAN ESTEBAN MÚNERA BETANCUR 29-09-2017 -->
    <script src="assets/js/funciones_jest.js"></script>
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
		require 'secc_sigdoc.php';
		
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
						
						<!-- PARA ACTUALIZAR UN DOCUMENTO -->
						<input name="iddocumento" id="iddocumento" type="hidden" readonly="true"  value="<?php echo $d0; ?>">
						<!-- PARA ACTUALIZAR EL CONSECUTIVO DE UN DOCUMENTO -->
						<input name="consecutivodocumento" id="consecutivodocumento" type="hidden" readonly="true"/>
						<!-- PARA DAR RESPUESTA A UN DOCUMENTO -->
						<input name="idrespuesta" id="idrespuesta" type="hidden" readonly="true" value="<?php echo $idrespuesta; ?>"/>
						
					 	<div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>
						
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
						
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Tipo Documento:</label>
			
								</td>
								
								<td>
									
									<select name="tipodocumento" id="tipodocumento" class="required">
                 		
										<option value="" selected="selected">Seleccionar Tipo Documento</option> 
									
										<?php
											while($row = $datostipodocumento->fetch()){
												
												if($row[id] == 1 || $row[id] == 2){
												
													//PREGUNTO QUE OPCION SE ENVIO PARA SER SELECCIONADA
													//DE LA VISTA sigdoc_listar_documentos_salientes.php
													if($row[id] == $d3){
														echo "<option value=\"". $row[id] ."\" selected='selected'>" . $row[nombre_tipo_documento] . "</option>";
													}
													else{
														echo "<option value=\"". $row[id] ."\">" . $row[nombre_tipo_documento] . "</option>";
													}
												}
												
												
											}
										
										?>
									</select>
								</td>
								
							</tr>
						
							<tr>
								<td>
									<label style="width:151px; color:#666666">Numero Documento:</label>
								</td>
								<td>
									<input type="text" name="ndocumento" id="ndocumento" class="required" readonly="true" value="<?php echo $d4; ?>"/>
								</td>
								
							</tr>
							
							<tr>
								<td><label style="width:151px; color:#666666">Dirigido a:</label></td>
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
									<input type="text" name="nombre" id="nombre" class="required" value="<?php echo $d6; ?>"/>
								</td>
								
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Cargo:</label>
								</td>
								<td>
									<input type="text" name="cargo" id="cargo" class="required" value="<?php echo $d7; ?>"/>
								</td>
								
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Dependencia:</label>
								</td>
								<td>
									<input type="text" name="dependencia" id="dependencia" class="required" value="<?php echo $d8; ?>"/>
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
									<label style="width:151px; color:#666666">Asunto:</label>
								</td>
								<td>
									<input type="text" name="asunto" id="asunto" class="required" value="<?php echo $d10; ?>"/>
								</td>
								
							</tr>
							
							<tr>
								<td colspan="2"> 
								
									<table border="0">
									
										<tr>
											<td>
												<label style="width:151px; color:#666666">Contenido Documento</label><br><br>
												<textarea name="detalleds" id="detalleds" cols="100" rows="10" maxlength = "100000" class="required"><?php echo $d11; ?></textarea>
											</td>
											
										</tr>
										
									</table>
									
								</td>
							</tr>
							<tr>
                                <td><label style="width:151px; color:#666666">Con Copia</label></td>
                                <td>
                                    <?php if($d12 !=""){ ?>
                                        <input type="radio" name="copia" value="0" onchange="con_copia(0)" />No
                                        <input type="radio" name="copia" value="1" onchange="con_copia(1)" checked />Si<br/><br/>
                                    <?php }else{ ?>
                                        <input type="radio" name="copia" value="0" onchange="con_copia(0)"  checked/>No
                                        <input type="radio" name="copia" value="1" onchange="con_copia(1)"  />Si<br/><br/>
                                    <?php } ?>
                                </td>
                            </tr>
								<?php 
                                    if($d12 !=""){ 
                                        $ver ="block";
                                    }else{
                                        $ver = "none";
                                    }
                                ?>
                                <tr>
                                    <td colspan="2">
                                        <div id="cc" style="display: <?php echo $ver; ?>">
                                            <table border="0">
                                                <tr>
                                                    <td>
                                                        <textarea name="copia" id="copia" cols="100" rows="5" maxlength = "800" placeholder="Con Copia:"><?php echo $d12; ?></textarea><br/>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
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
			
				</div>
				
			</td>
		</tr>
		
		
	</table>
		
				
<?php require 'alertas.php';?>
</body>
</html>


	
