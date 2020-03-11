<?php 
session_start(); 

if($_SESSION['id'] == ""){
	header("refresh: 0; URL=/centro_servicios2/"); 
}
else{

/*$id           = trim($_POST['id']);
$datoradicado = trim($_POST['datoradicado']);
$idclaseparte = trim($_POST['idclaseparte']);*/

$idparted   = trim($_POST['idparted']);

$iddird     = trim($_POST['iddird']);
$iddird_b   = trim($_POST['iddird_b']);
$iddird_c   = trim($_POST['iddird_c']);
$iddird_d   = trim($_POST['iddird_d']);

$idprocesod = trim($_POST['idprocesod']);
$radicadod  = trim($_POST['radicadod']);

//echo $id;
//require_once('/centro_servicios/models/documentosModel.php');

include_once('Funciones.php');
//instanciamos la clase Funciones.php con la variable $funcion
$funcion = new Funciones();

//$radicado  = $funcion-> get_idradicado_2($id);
//$radicado2 = explode("//////",$radicado);

//echo $radicado;

?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/> 

<script src="views/js/ajax/ajax_documentos.js" type="text/javascript"></script>

<form action="index.php?controller=documentos&action=Activar_Direcion_Parte" method="post" name ="form2" id="form2" onsubmit="return validar_campos_parte();"> 

	<div class="buttonsBar">
		<button id="cancel" type="button" name="boton_cancelar" title="Cerrar"><img src="images/imagenesbotones/cancel2.png" width="25" height="25"/></button>
		<button id="registrar" type="submit" name="boton_registrar" title="Registrar"><img src="images/imagenesbotones/save.png" width="25" height="25"/></button>
	</div>

	<table border="0" align="center">
	
		<tr>
			<td align="center" colspan="2" style="width:180px; height:23px; border-color:#000000; font-size:16px ">ACTIVAR DIRECCION PARTE</td><br><br>
		</tr>
		<!-- <tr>
			
			
			
			<td colspan="2">
			
				<input type="text" name="idparted" id="idparted" readonly="true" value="<?php //echo trim($idparted); ?>">
				
				<input type="text" name="iddird" id="iddird" readonly="true" value="<?php //echo trim($iddird); ?>">
				<input type="text" name="iddird_b" id="iddird_b" readonly="true" value="<?php //echo trim($iddird_b); ?>">
				<input type="text" name="iddird_c" id="iddird_c" readonly="true" value="<?php //echo trim($iddird_c); ?>">
				<input type="text" name="iddird_d" id="iddird_d" readonly="true" value="<?php //echo trim($iddird_d); ?>">
				
				<input type="text" name="idprocesod" id="idprocesod" readonly="true" value="<?php //echo trim($idprocesod); ?>">
				<input type="text" name="radicadod" id="radicadod" readonly="true" value="<?php //echo trim($radicadod); ?>">
				
				
			</td>
				 -->
		</tr>
		
		<!-- ********************************************************************************************************************* -->
		<tr>
			<td>
				<label style="width:151px; color:#666666">Id Parte:</label>
			</td>
			<td>
				<input type="text" name="idparted" id="idparted" readonly="true" value="<?php echo trim($idparted); ?>">
			</td>
				
		</tr>
		
		<tr>
			<td>
				<label style="width:151px; color:#666666">Id Direccion:</label>
			</td>
			<td>
				<input type="text" name="iddird" id="iddird" readonly="true" value="<?php echo trim($iddird); ?>">
			</td>
				
		</tr>
		
		<tr>
			<td>
				<label style="width:151px; color:#666666">Cedula:</label>
			</td>
			<td>
				<input type="text" name="iddird_b" id="iddird_b" readonly="true" value="<?php echo trim($iddird_b); ?>">
			</td>
				
		</tr>
		
		<tr>
			<td>
				<label style="width:151px; color:#666666">Nombre:</label>
			</td>
			<td>
				<input type="text" name="iddird_c" id="iddird_c" readonly="true" value="<?php echo trim($iddird_c); ?>">
			</td>
				
		</tr>
		
		<tr>
			<td>
				<label style="width:151px; color:#666666">Direccion:</label>
			</td>
			<td>
				<input type="text" name="iddird_d" id="iddird_d" readonly="true" value="<?php echo trim($iddird_d); ?>">
			</td>
				
		</tr>
		
		<tr>
			<td>
				<label style="width:151px; color:#666666">Id Proceso:</label>
			</td>
			<td>
				<input type="text" name="idprocesod" id="idprocesod" readonly="true" value="<?php echo trim($idprocesod); ?>">
			</td>
				
		</tr>
		
		<tr>
			<td>
				<label style="width:151px; color:#666666">Radicado:</label>
			</td>
			<td>
				<input type="text" name="radicadod" id="radicadod" readonly="true" value="<?php echo trim($radicadod); ?>">
			</td>
				
		</tr>
		
		
		<!-- **************************************************************************************************************************** -->
							
							
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
							$campo_a_ordenar  ="id";
							$campo_filtro     = "id";
							$valor_filtro     = 13;
							//$funcion->cargar_lista($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_a_ordenar);
							
							$funcion->cargar_lista_con_filtro($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
						?>
				</select>
				
			</td>
			
		
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


