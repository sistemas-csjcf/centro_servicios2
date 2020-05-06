<?php 
session_start(); 

if($_SESSION['id'] == ""){
	header("refresh: 0; URL=/centro_servicios2/"); 
}
else{

$idpartex      = trim($_POST['idpartex']);
$idprocesox    = trim($_POST['idprocesox']);
$idclasipartex = trim($_POST['idclasipartex']);

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

<form action="index.php?controller=signot&action=Modificar_CP" method="post" name ="formmcp" id="formmcp" onsubmit="return validar_campos_mcp();"> 

	<div class="buttonsBar">
		<button id="cancel" type="button" name="boton_cancelar" title="Cerrar"><img src="images/imagenesbotones/cancel2.png" width="25" height="25"/></button>
		<button id="registrar" type="submit" name="boton_registrar" title="Registrar"><img src="images/imagenesbotones/save.png" width="25" height="25"/></button>
	</div>

	<table border="0" align="center">
	
		<tr>
			<td align="center" colspan="2" style="width:180px; height:23px; border-color:#000000; font-size:16px ">MODIFICAR CLASIFICACION PARTE</td><br><br>
		</tr>
		<tr>
			
			<td>
				<input type="hidden" name="idpartex" id="idpartex" readonly="true" value="<?php echo trim($idpartex); ?>">
				<input type="hidden" name="idprocesox" id="idprocesox" readonly="true" value="<?php echo trim($idprocesox); ?>">
				<input type="hidden" name="idclasipartex" id="idclasipartex" readonly="true" value="<?php echo trim($idclasipartex); ?>">
			</td>
				
		</tr>
							
		<tr>
			<td>
				<label style="width:151px; color:#666666">Clasificacion Parte:</label>
						
			</td>
											
			<td>
												
				<select name="clasificacionpartex" id="clasificacionpartex">
										
					<option value="" selected="selected">Seleccionar Clasificacion Parte</option> 
													
						<?php
								$campo_a_mostrar  ="descripcion";
								$campo_a_insertar ="id"; 
								$nombre_tabla     ="signot_clasificacion_parte";
								$campo_a_ordenar  ="descripcion";
								
								$funcion->cargar_lista($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_a_ordenar);
							?>
				</select>
				
			</td>
			
			<tr>
			
	
		</tr>
							
						
	</table>
	

</form>

<?php } ?>


