<?php 
session_start(); 

if($_SESSION['id'] == ""){
	header("refresh: 0; URL=/centro_servicios2/"); 
}
else{

$idpartex   = trim($_POST['idpartex']);
$idprocesox = trim($_POST['idprocesox']);

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

<!-- <script src="views/js/jquery.js" type="text/javascript"></script> -->

<script src="views/js/ajax/ajax_documentos.js" type="text/javascript"></script>

<script src="views/js/ajax/ajax_signot.js" type="text/javascript"></script>

<form action="index.php?controller=signot&action=Adicionar_Direccion" method="post" name ="formdir" id="formdir" onsubmit="return validar_campos_direccion();"> 

	<div class="buttonsBar">
		<button id="cancel" type="button" name="boton_cancelar" title="Cerrar"><img src="images/imagenesbotones/cancel2.png" width="25" height="25"/></button>
		<button id="registrar" type="submit" name="boton_registrar" title="Registrar"><img src="images/imagenesbotones/save.png" width="25" height="25"/></button>
	</div>

	<table border="0" align="center">
	
		<tr>
			<td align="center" colspan="2" style="width:180px; height:23px; border-color:#000000; font-size:16px ">ADICIONAR DIRECCION</td><br><br>
		</tr>
		<tr>
			
			<td>
				<input type="hidden" name="idpartex" id="idpartex" readonly="true" value="<?php echo trim($idpartex); ?>">
				<input type="hidden" name="idprocesox" id="idprocesox" readonly="true" value="<?php echo trim($idprocesox); ?>">
			</td>
				
		</tr>
		
		<tr>
			<td>
				<label style="width:151px; color:#666666">Direccion:</label>
			</td>
			<td>
				<input type="text" name="direccion" id="direccion" maxlength="2000" />
			</td>
			
		</tr>
		
		<tr>
			
			<td>
				<label style="width:151px; color:#666666">Telefono:</label>
			</td>
			<td>
				<input type="text" name="telefono" id="telefono" maxlength="2000" />
			</td>
		</tr>
							
							
		<tr>
			<td>
				<label style="width:151px; color:#666666">Departamento:</label>
						
			</td>
											
			<td>
												
				<select name="departamento" id="departamento" onChange="Obtener_Municipio()">
									
						<option value="" selected="selected">Seleccionar Departamento</option> 
												
						<?php
							$campo_a_mostrar  ="descripcion";
							$campo_a_insertar ="Cod_departamento"; 
							$nombre_tabla     ="signot_pa_departamento";
							$campo_a_ordenar  ="descripcion";
							
							$funcion->cargar_lista($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_a_ordenar);
						?>
				</select>
				
			</td>
			
			<tr>
			<td>
				<label style="width:151px; color:#666666">Municipio:</label>
			</td>
											
			<td>
												
				<select name="municipio" id="municipio" >
									
					<option value="" selected="selected">Seleccionar Municipio</option> 
												
													
													
					</select>
			</td>
			
	
		</tr>
							
						
	</table>
	

</form>

<?php } ?>


