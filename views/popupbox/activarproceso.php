<?php 
session_start(); 

if($_SESSION['id'] == ""){
	header("refresh: 0; URL=/centro_servicios/"); 
}
else{

$id = trim($_POST['id']);

//echo $id;
//require_once('/centro_servicios/models/documentosModel.php');

include_once('Funciones.php');
//instanciamos la clase Funciones.php con la variable $funcion
$funcion = new Funciones();

$radicado  = $funcion-> get_idradicado($id);
$radicado2 = explode("//////",$radicado);

//echo $radicado;

?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>

<script src="views/js/ajax/ajax_documentos.js" type="text/javascript"></script>

<form action="index.php?controller=documentos&action=Registro_Documentos_Especiales_4" method="post" name ="form2" id="form2" onsubmit="return validar_campos_proceso();"> 

	<div class="buttonsBar">
		<button id="cancel" type="button" name="boton_cancelar" title="Cerrar"><img src="images/imagenesbotones/cancel2.png" width="25" height="25"/></button>
		<button id="registrar" type="submit" name="boton_registrar" title="Registrar"><img src="images/imagenesbotones/save.png" width="25" height="25"/></button>
	</div>

	<table border="0" align="center">
	
		<tr>
			<td align="center" colspan="2" style="width:180px; height:23px; border-color:#000000; font-size:16px ">ACTIVAR PROCESO</td><br><br>
		</tr>
		<tr>
			<td>
				<label style="width:151px; color:#666666">Radicado:</label>
			</td>
			<td>
				<input type="hidden" name="id" id="id" readonly="true" value="<?php echo trim($id); ?>">
				<input type="text" name="radicadox" id="radicadox" readonly="true" value="<?php echo trim($radicado2[1]); ?>">
			</td>
				
		</tr>
							
							
		<tr>
			<td>
				<label style="width:151px; color:#666666">Tipo Anotacion:</label>
			</td>
											
			<td>
												
				<select name="destipoanotacion" id="destipoanotacion" class="required">
									
					<option value="" selected="selected">Seleccionar Tipo Anotacion</option> 
												
						<?php
							$campo_a_mostrar  ="destipo";
							$campo_a_insertar ="id"; 
							$nombre_tabla     ="signot_pa_tipo_anotacion";
							$campo_a_ordenar  ="destipo";
							$funcion->cargar_lista($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_a_ordenar);
						?>
				</select>
				
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
	
	</table>
	

</form>

<?php } ?>


