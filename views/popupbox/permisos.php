<?php 
	session_start(); 

	if($_SESSION['id'] == ""){
		header("refresh: 0; URL=/centro_servicios/"); 
	}else{

		//OBTENEMOS LA FECHA ACTUAL
		//FORMA WIN 7 Y 8, YA QUE DE LA FORMA ANTERIOR TOMA EL AM O PM Y DA CONFLICTOS PARA 
		//GUARDAR EN LA BASE DE DATOS EN ESTE CASO LA TABLA detalle_correspondencia 
		//CAMPO fecha QUE ES DATETIME 
		date_default_timezone_set('America/Bogota'); 
		$fecharegistro=date('Y-m-d'); //FORMA PARA XP
		//$fecharegistro = date('Y-m-d g:i'); 
		$fechaactual = $fecharegistro; ;
?>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<script type="text/javascript" src="views/fechajquery/jquery2.js"></script>
	<script src="views/js/ajax/ajax_empleados_registro_entrada_salida.js" type="text/javascript" charset="utf-8"></script>
	<script src="views/js/ajax/ajax_popupbox_empleados_registro_entrada_salida.js" type="text/javascript" charset="utf-8"></script>
	<!-- PARA LAS FECHAS -->
	<script type="text/javascript" src="views/fechajquery/jquery.datetimepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="views/fechajquery/jquery.datetimepicker.css"/ >
	<script type="text/javascript">
		$(document).ready(function() {
			//PARA LAS FECHAS
			//$('#fechas').datetimepicker();
			$('#fechap').datetimepicker();
		});
	</script>	
	<form action="index.php?controller=reps&action=regPermiso" method="post" name ="form2" id="form2" enctype="multipart/form-data" onsubmit="return validar_campos_permiso();"> 
		<div class="buttonsBar">
			<button id="cancel" type="button" name="boton_cancelar" title="Cerrar"><img src="images/imagenesbotones/cancel2.png" width="25" height="25"/></button>
			<button id="registrar" type="submit" name="boton_registrar" title="Registrar"><img src="images/imagenesbotones/save.png" width="25" height="25"/></button>
		</div>
		<table border="0" align="center">
			<tr>
				<td align="center" colspan="2" style="width:180px; height:23px; border-color:#000000; font-size:16px ">SOLICITUD DE PERMISOS</td>
			</tr>
			<tr>
				<td>
					<label style="width:180px; height:23px; border-color:#000000; font-size:16px ">Fecha Solicitud</label><br>
					<input name="fechas" id="fechas" type="text" readonly="true" size="12" title="Fecha Solicitud" value="<?php echo $fechaactual; ?>">
				</td>
				<td>
					<label style="width:180px; height:23px; border-color:#000000; font-size:16px ">Fecha Permiso</label><br>
					<input name="fechap" id="fechap" type="text" readonly="true" size="12" title="Fecha Permiso">
				</td>
			</tr>
			<tr>
				<td>
					<label style="width:180px; height:23px; border-color:#000000; font-size:16px ">Hora Inicial</label><br>
					<input type="time" id="horai" name="horai" title="Hora Inicial">
				</td>
				<td>
					<label style="width:180px; height:23px; border-color:#000000; font-size:16px ">Hora Final</label><br>
					<input type="time" id="horaf" name="horaf" title="Hora Final">
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<br><label style="width:180px; height:23px; border-color:#000000; font-size:16px ">Detalle</label><br><br>
					<textarea  name="detalle" id="detalle" title="Detalle" cols="50" rows="5" style="border-color:#000000; font-size:16px "></textarea><br><br><br>
				</td>
			</tr>
			<tr>
	            <td colspan="2">
	                <br><label style="width:180px; height:23px; border-color:#000000; font-size:16px">Documento Adjunto</label><br><br>
	                <input type="file" id="doc_adjunto" name="doc_adjunto" placeholder="Documento adjunto"><br><br>
	            </td>
	        </tr>
		</table>
	</form>
<?php } ?>