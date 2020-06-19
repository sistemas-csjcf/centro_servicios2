<?php 
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	//TITULO FORMULARIO
	$titulo     = "NOTIFICACIONES - Radicacion";
	$subtitulo  = "NOTIFICACIONES - Radicacion";
	//$subtitulo2 = "Permisos Usuario";
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new signotModel();
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	//OBTENEMOS LA HOAR ACTUAL
	//$horaactual        = $modelo->get_hora_actual_24horas();
	//SOLO PARA VISUALIZACION DEL USUARIO, REALMENTE EL QUE SE REGISTRA EN LA BASE DE DATOS ES $horaactual
	//$horaactualespejo  = $modelo->get_hora_actual_12horas();
	
	
	//OBTENEMOS LISTADO SEGUN LA LISTA SOLICITADA
	
	$nombrelista  = 'pa_year';
	$campoordenar = 'year';
	$formaordenar = 'DESC';
	$datosyear    = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	$datosyear2   = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	
	$nombrelista  = 'pa_juzgado';
	$campoordenar = 'id';
	$formaordenar = '';
	$datosjuzgado = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	$datosjuzgado2= $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	
	/*$nombrelista  = 'signot_pa_clase_proceso';
	$campoordenar = 'nombre_proceso';
	$formaordenar = '';
	$datosclaseproceso = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);*/
	
	$nombrelista  = 'signot_clasificacion_parte';
	$campoordenar = 'descripcion';
	$formaordenar = '';
	$datosclasificacion = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	$datosclasificacion2= $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	
	$nombrelista  = 'signot_pa_departamento';
	$campoordenar = 'descripcion';
	$formaordenar = '';
	$datosdepartamento = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	$datosdepartamento2= $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	

	
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
			$d33 = $fila[remitente];
			$d4  = $fila[idtipodocumento];
			$d44 = $fila[idtipodocumento];
			$d5  = $fila[numero];
			$d55 = $fila[numero];
			$d6  = $fila[nfc];
			$d66 = $fila[nfc];
			$d7  = $fila[idjuzgadodestino];
			$d77 = $fila[idjuzgadodestino];
			
			//envio el id del juzgado para saber cual es el funcionario asignado a el
			//y cargar el campo empleado
			$d8  = $modelo->get_nombre_usuario_juzgado($d77);
			$row = $d8->fetch();
			$d8b = $row[empleado];

			$d88  = $modelo->get_nombre_usuario_juzgado($d77);
			$row2 = $d8->fetch();
			$d88b = $row[empleado];
			
		}
	}
	require_once "/conectar.php";
    $link=conectarse();
    mysql_set_charset('utf8');
    $sql = "SELECT * FROM signot_pa_departamento ORDER BY descripcion ASC";
    $res=mysql_query($sql,$link);
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
    <script type="text/javascript">
        function tipoDeRadicado(sel) {
      if (sel.value=="manual"){
           divC = document.getElementById("nManual");
           divC.style.display = "";
           divT = document.getElementById("nAutomatico");
           divT.style.display = "none";
      }else{
           divC = document.getElementById("nManual");
           divC.style.display="none";
           divT = document.getElementById("nAutomatico");
           divT.style.display = "";
      }
}
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
				<div>
		           <select NAME="pago" onChange="tipoDeRadicado(this)">
		              <option VALUE="manual">Manual</option>
		              <option VALUE="automatico">Autom&aacute;tico</option> 
		           </select>
				</div>
  			</td>
  		</tr>
		<tr>
    		<td>
				<!-- NOTA: LOS ID DE LOS CAMPOS ME DAN LOS ESTILOS, UBICADOS EN centro_servicios\views\css\main.css
				TENIENDO EN CUENTA EL ID DE LA TABLA DONDE SE ENCUENTRAN LOS CAMPOS EN ESTE CASO frm_editar
				LA class="required" ME PERMITE VALIDAR UN CAMPO CON JQUERY
				EN action="" NO ENVIO NADA YA QUE ESTE LLAMADO SE REALIZA EN require 'secc_sigdoc.php';
				IGUAL FUNCIONA SI SE DEFINE ALGUNA ACCION-->
				<div id="contenido2">
				<div id="nManual" style="display:none;">
					<form id="frm2" name="frm2" method="post" enctype="multipart/form-data" action="">	
						<!-- <input name="iddocumento" id="iddocumento" type="hidden" readonly="true"  value="<?php echo $d0; ?>"> -->
						<!-- <input name="consecutivodocumento" id="consecutivodocumento" type="hidden" readonly="true"/> -->
						
					 	<div id="titulo_frm">NOTIFICACIONES - RADICACION MANUAL2</div>
						
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
							<tr>
								<td>
									<label style="width:151px; color:#666666">A�o2:</label>
								</td>
								<td>
									<select name="year" id="year" class="required">
										<option value="" selected="selected">Seleccionar A�o.</option> 
									
										<?php
											while($row2 = $datosyear2->fetch()){
											
												if($row2[year] == $d44){
													echo "<option value=\"". $row2[year] ."\" selected='selected'>" . $row2[year] . "</option>";
												}
												else{
													echo "<option value=\"". $row2[year] ."\">" . $row2[year] . "</option>";
												}
											
											}
										?>
									</select>
								</td>
								
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Consecutivo (tres car&aacute;cteres)2:</label>
								</td>
								<td>
									<input type="text" name="consecutivo" id="consecutivo" size="8" maxlength="3" minlength="3" class="required number" value="<?php echo $d33; ?>"/>
								</td>
								
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Instancia2:</label>
								</td>
								<td><label>
								  <select name="instancia" id="instancia" class="required">
									<option option value="">Seleccionar Instancia</option>
									<option value="00">00</option>
								  </select>
								</label></td>
						 	 </tr>
							 
							 <tr>
								<td>
									<label style="width:151px; color:#666666">Juzgado2:</label>
								</td>
								<td>
									<select name="juzgadoorigen" id="juzgadoorigen" class="required">
										<option value="" selected="selected">Seleccionar Juzgado</option> 
										<?php
											while($row2 = $datosjuzgado2->fetch()){
												echo "<option value=\"". $row2[id]."-".$row2[idarea]."-".$row2[numero_juzgado]."\">" . $row2[nombre] . "</option>";
											}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label style="width:151px; color:#666666">Radicado2:</label>
								</td>
								<!-- USO maxlength="23" minlength="23" PARA QUE EL DATO DEL RADICADO ESTE CONFORMADO POR 23 CARACTERES
								Y SEA VALIDADO POR LA LIBRERIA jquery.validate-->
								<td>
									<input type="text" name="radicadox" id="radicadox" class="required" maxlength="23" minlength="23" readonly="true" value="<?php echo $d33; ?>"/>
								</td>
								
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Clase Proceso2:</label>
			
								</td>
								
								<td>
									
									<select name="claseproceso" id="claseproceso" class="required">
                 		
										<option value="" selected="selected">Seleccionar Clase Proceso2</option> 
									
										<?php
											/*while($row = $datosclaseproceso->fetch()){
											
												if($row[id] == $d4){
													echo "<option value=\"". $row[id] ."\" selected='selected'>" . $row[nombre_proceso] . "</option>";
												}
												else{
													echo "<option value=\"". $row[id] ."\">" . $row[nombre_proceso] . "</option>";
												}
											
											}*/
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<a id="btpartes" href="javascript:void(0);"><img src="views/images/partes.png" width="45" height="45" title="ADICIONAR PARTES AL PROCESO"/>ADICIONAR PARTES AL PROCESO2</a>
									<!-- ASIGNO AL CAMPO OCULTO datospartes LA INFORMACION DE LA TABLA -->
									<input type="hidden" name="datospartes" id="datospartes"/>
								</td>
							</tr>
							<tr id="filapartes">
								<td colspan="2">
									<table border="5" cellspacing="0" cellpadding="0" rules="rows" id="frm_partes">
										<tr>
											<td colspan="4">
												<!-- <a id="new" href="javascript:void(0);"><img src="views/images/new2.jpg" width="30" height="30" title="Adiconar Parte"/></a> -->
												<button type="button" name="boton_adicionar" id="boton_adicionar" title="Adicionar Parte" onClick="Adicionar_ParteREGI2(1)"><img src="views/images/new2.jpg" width="30" height="30"/></button>
											</td>
										</tr>
										<tr>
											<td>
												<label style="width:151px; color:#666666">Cedula2:</label>
											</td>
											<td>
												<input name="idpartey" id="idpartey2" type="hidden" readonly="true"/>
												<input type="text" name="cedulareg" id="cedulareg2" maxlength="25" onKeyUp="Traer_Datos_Partes_Reg2(this.value)"/>
											</td>
											<td>
												<label style="width:151px; color:#666666">Nombre2:</label>
											</td>
											<td>
												<input type="text" name="nombrereg" id="nombrereg" maxlength="2000"/>
											</td>
										</tr>
										<tr>
											<td>
												<label style="width:151px; color:#666666">Clasificacion Parte2:</label>
											</td>
											<td>
												<select name="clasificacionparte" id="clasificacionparte">
													<option value="" selected="selected">Seleccionar Clasificacion Parte2</option> 
													<?php
														while($row = $datosclasificacion2->fetch()){
															echo "<option value=\"". $row2[id] ."\">" . $row2[descripcion] . "</option>";
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
											<td>
												<label style="width:151px; color:#666666">Datos Adicionales2:</label>
											</td>
											<td>
												<input type="text" name="datosadicionalesreg" id="datosadicionalesreg" />
											</td>
											<tr>
                                                <td><label style="width:151px; color:#666666">Direcci�n2:</label></td>
                                                <td><input type="text" name="direccionParte" id="direccionParte" placeholder="Direcci�n" /></td>
                                                <td><label style="width:151px; color:#666666">Tel�fono:</label></td>
                                                <td><input type="text" name="telefonoParte" id="telefonoParte" placeholder="Tel�fono" /></td>
                                            </tr>
											<tr>
                                                <td><label style="width:151px; color:#666666">Departamento2:</label></td>
                                                <td>											
                                                    <select name="departamento" id="departamento" onChange="Obtener_Municipio()">
                                                        <option value="" selected="selected">Seleccionar Departamento2</option> 
                                                        <?php  while($row2 = mysql_fetch_array($res)){ ?> 
                                                            <option value="<?php echo $row2['Cod_departamento'] ?>"><?php echo utf8_decode($row['descripcion']); ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td><label style="width:151px; color:#666666">Municipio2:</label></td>	
                                                <td>
                                                    <select name="municipio" id="municipio" >							
                                                        <option value="" selected="selected">Seleccionar Municipio2</option>	
                                                    </select>
                                                </td>
                                            </tr>
										</tr>
									</table>
								</td>
							</tr>
							<tr id="filapartes2">
								<td colspan="2">
									<table>
										<tr>
											<td>
												<div id="cont"> 
													<table id="tmodi2" border="1"> 
														<tr>
															<td><strong>Id Proceso</strong></td> 
															<td><strong>Id Parte</strong></td> 
															<td><strong>Cedula</strong></td>
															<td><strong>Nombre</strong></td>
															<td><strong>Clasificacion Parte</strong></td>
															<td><strong>Datos Adicionales</strong></td>
															<td><strong>Direcci�n</strong></td>
															<td><strong>Tel�fono</strong></td>
															<td><strong>Departamento</strong></td>
															<td><strong>Municipio</strong></td>
														</tr> 
													</table>
												</div>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<div id="ok"></div>
								</td>
							</tr>
							<!-- -----------------------------BOTONES--------------------------------------------------------- -->
							<tr>
								<td colspan="2">
									<!-- SE PREGUNTA SI LA VARIABLE $vbton NO ES VACIA, YA QUE ESTO NOS INDICA QUE VAMOS A ACTUALIZAR UN DOCUMENTO
									Y POR ENDE EL VALOR PASA A Actualizar-->
									<center>
										<input type="submit" name="Submit" value="<?php if(empty($vbton)){ echo "Registrar";}else{echo "Actualizar";} ?>" id="btn_input" class="btn_validar"/>
										<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
									</center>
								</td> 
						  	</tr>
							<!-- ----------------------------------------------------------------------------------------------- -->
						</table>
					</form>
				</div>
			</div>


			<div id="contenido">
				<div id="nAutomatico" style="display:;">
					<form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
						<!-- <input name="iddocumento" id="iddocumento" type="hidden" readonly="true"  value="<?php echo $d0; ?>"> -->
						<!-- <input name="consecutivodocumento" id="consecutivodocumento" type="hidden" readonly="true"/> -->
					 	<div id="titulo_frm">NOTIFICACIONES - RADICACION AUTOMATICO</div>
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
							<tr>
								<td>
									<label style="width:151px; color:#666666">A�o:</label>
								</td>
								<td>
									<select name="year" id="year" class="required">
										<option value="" selected="selected">Seleccionar A�o</option> 
										<?php
											while($row = $datosyear->fetch()){
											
												if($row[year] == $d4){
													echo "<option value=\"". $row[year] ."\" selected='selected'>" . $row[year] . "</option>";
												}
												else{
													echo "<option value=\"". $row[year] ."\">" . $row[year] . "</option>";
												}
											}
										?>
									</select>
								</td>
								
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Consecutivo (tres car&aacute;cteres):</label>
								</td>
								<td>
									<input type="text" name="consecutivo" id="consecutivo" size="8" maxlength="3" minlength="3" class="required number" value="<?php echo $d3; ?>"/>
								</td>
							</tr>
							<tr>
								<td>
									<label style="width:151px; color:#666666">Instancia:</label>
								</td>
								<td><label>
								  <select name="instancia" id="instancia" class="required">
									<option option value="">Seleccionar Instancia</option>
									<option value="00">00</option>
								  </select>
								</label></td>
						 	 </tr>			 
							 <tr>
								<td>
									<label style="width:151px; color:#666666">Juzgado:</label>
								</td>
								<td>
									<select name="juzgadoorigen" id="juzgadoorigen" class="required">
										<option value="" selected="selected">Seleccionar Juzgado</option> 
										<?php
											while($row = $datosjuzgado->fetch()){
											
												echo "<option value=\"". $row[id]."-".$row[idarea]."-".$row[numero_juzgado]."\">" . $row[nombre] . "</option>";	
											}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label style="width:151px; color:#666666">Radicado:</label>
								</td>
								<!-- USO maxlength="23" minlength="23" PARA QUE EL DATO DEL RADICADO ESTE CONFORMADO POR 23 CARACTERES
								Y SEA VALIDADO POR LA LIBRERIA jquery.validate-->
								<td>
									<input type="text" name="radicadox" id="radicadox" class="required" maxlength="23" minlength="23" readonly="true" value="<?php echo $d3; ?>"/>
								</td>
							</tr>
							<tr>
								<td>
									<label style="width:151px; color:#666666">Clase Proceso:</label>
								</td>
								<td>
									<select name="claseproceso" id="claseproceso" class="required">
										<option value="" selected="selected">Seleccionar Clase Proceso</option> 
										<?php
											/*while($row = $datosclaseproceso->fetch()){
											
												if($row[id] == $d4){
													echo "<option value=\"". $row[id] ."\" selected='selected'>" . $row[nombre_proceso] . "</option>";
												}
												else{
													echo "<option value=\"". $row[id] ."\">" . $row[nombre_proceso] . "</option>";
												}
											}*/
										?>
									</select>
								</td>
							</tr>		
							<tr>
	
								<td colspan="2">
									<a id="btpartes" href="javascript:void(0);"><img src="views/images/partes.png" width="45" height="45" title="ADICIONAR PARTES AL PROCESO"/>ADICIONAR PARTES AL PROCESO</a>
									<!-- ASIGNO AL CAMPO OCULTO datospartes LA INFORMACION DE LA TABLA -->
									<input type="text" name="datospartes" id="datospartes"/>
								</td>
								
							</tr>
							
							<tr id="filapartes">
							
								<td colspan="2">
									
									<table border="5" cellspacing="0" cellpadding="0" rules="rows" id="frm_partes">
		  	
										<tr>
											<td colspan="4">
												<!-- <a id="new" href="javascript:void(0);"><img src="views/images/new2.jpg" width="30" height="30" title="Adiconar Parte"/></a> -->
												
												<button type="button" name="boton_adicionar" id="boton_adicionar" title="Adicionar Parte" onClick="Adicionar_ParteREGI(1)"><img src="views/images/new2.jpg" width="30" height="30"/></button>
												
												
											
											</td>
										</tr>
										
										<tr>
											<td>
												<label style="width:151px; color:#666666">Cedula:</label>
											</td>
											<td>
												<input name="idpartey" id="idpartey" type="hidden" readonly="true"/>
												<input type="text" name="cedulareg" id="cedulareg" maxlength="25" onKeyUp="Traer_Datos_Partes_Reg(this.value)"/>
											</td>
											<td>
												<label style="width:151px; color:#666666">Nombre:</label>
											</td>
											<td>
												<input type="text" name="nombrereg" id="nombrereg" maxlength="2000"/>
											</td>
										</tr>
										
										
										
										<tr>
											
											<td>
												<label style="width:151px; color:#666666">Clasificacion Parte:</label>
						
											</td>
											
											<td>
												
												<select name="clasificacionparte" id="clasificacionparte">
									
													<option value="" selected="selected">Seleccionar Clasificacion Parte</option> 
												
													<?php
														while($row = $datosclasificacion->fetch()){
															
															echo "<option value=\"". $row[id] ."\">" . $row[descripcion] . "</option>";
															
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
											
											<td>
												<label style="width:151px; color:#666666">Datos Adicionales:</label>
											</td>
											<td>
												<input type="text" name="datosadicionalesreg" id="datosadicionalesreg" />
											</td>
											
											<tr>
                                                <td><label style="width:151px; color:#666666">Direcci�n:</label></td>
                                                <td><input type="text" name="direccionParte" id="direccionParte" placeholder="Direcci�n" /></td>
                                                <td><label style="width:151px; color:#666666">Tel�fono:</label></td>
                                                <td><input type="text" name="telefonoParte" id="telefonoParte" placeholder="Tel�fono" /></td>
                                            </tr>
											<tr>
                                                <td><label style="width:151px; color:#666666">Departamento:</label></td>
                                                <td>											
                                                    <select name="departamento" id="departamento" onChange="Obtener_Municipio()">
                                                        <option value="" selected="selected">Seleccionar Departamento</option> 
                                                        <?php  while($row = mysql_fetch_array($res)){ ?> 
                                                            <option value="<?php echo $row['Cod_departamento'] ?>"><?php echo utf8_decode($row['descripcion']); ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td><label style="width:151px; color:#666666">Municipio:</label></td>	
                                                <td>
                                                    <select name="municipio" id="municipio" >							
                                                        <option value="" selected="selected">Seleccionar Municipio</option> 										
                                                    </select>
                                                </td>
                                            </tr>
										</tr>
									
									</table>
								
								</td>
								
							</tr>
							
							<tr id="filapartes2">
							
								<td colspan="2">
						
									<table>
	
										<tr>
											<td>
												<div id="cont"> 
													<table id="tmodi2" border="1"> 
														<tr>
															<td><strong>Id Proceso</strong></td> 
															<td><strong>Id Parte</strong></td> 
															<td><strong>Cedula</strong></td>
															<td><strong>Nombre</strong></td>
															<td><strong>Clasificacion Parte</strong></td>
															<td><strong>Datos Adicionales</strong></td>
															<td><strong>Direcci�n</strong></td>
															<td><strong>Tel�fono</strong></td>
															<td><strong>Departamento</strong></td>
															<td><strong>Municipio</strong></td>
														</tr> 
													</table>
												</div>
											</td>
											
										</tr>
										
										
									</table>
						
								</td>
							
							</tr>
							
							<tr>
								<td>
									<div id="ok"></div>
								</td>
							</tr>
							<!-- -----------------------------BOTONES--------------------------------------------------------- -->
							<tr>
								
								<td colspan="2">
									<!-- SE PREGUNTA SI LA VARIABLE $vbton NO ES VACIA, YA QUE ESTO NOS INDICA QUE VAMOS A ACTUALIZAR UN DOCUMENTO
									Y POR ENDE EL VALOR PASA A Actualizar-->
									<center>
										<input type="submit" name="Submit" value="<?php if(empty($vbton)){ echo "Registrar";}else{echo "Actualizar";} ?>" id="btn_input" class="btn_validar"/>
										<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
									</center>
								</td> 
								
						  	</tr>
							
							<!-- ----------------------------------------------------------------------------------------------- -->
						
				
						</table>
						
					
					</form>
				</div>
			
				</div>
				
			</td>
		</tr>
		
	</table>
	
	
	
	
									
<?php require 'alertas.php';?>


<?php 

	//REALIZO EL LLAMADO DE ESTA FUNCION PARA DETERMITAR,
	//QUE CLASIFICACION PARTE NECESITA QUE SE LE GENERE UN AUTO
	//FUNCIONA SIMILAR AL LLAMADO DE LA TABLA pa_usuario_acciones
	//PERO ESTA FUNCION TRAER INFORMACION DE LA TABLA pa_modulo_acciones
	//INDICANDOME CUALE SON LOS ID DE CLASIFICACION PARTE QUE DEBEN
	//APLICARSELES LA ACCION DEL DETALLE DE LA TABLA pa_modulo_acciones
	echo '<script languaje="JavaScript"> 
								
				Cargar_Pa_Modulo_Acciones();
						
		</script>';
			
?>


</body>
</html>

