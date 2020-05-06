<?php 
session_start(); 

if($_SESSION['id'] == ""){
	header("refresh: 0; URL=/centro_servicios2/"); 
}
else{

$id = trim($_POST['id']);
$datoradicado = trim($_POST['datoradicado']);
$idclaseparte = trim($_POST['idclaseparte']);

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

<form action="index.php?controller=signot&action=Activar_Parte" method="post" name ="form2" id="form2" onsubmit="return validar_campos_parte();"> 

	<div class="buttonsBar">
		<button id="cancel" type="button" name="boton_cancelar" title="Cerrar"><img src="images/imagenesbotones/cancel2.png" width="25" height="25"/></button>
		<button id="registrar" type="submit" name="boton_registrar" title="Registrar"><img src="images/imagenesbotones/save.png" width="25" height="25"/></button>
	</div>

	<table border="0" align="center">
	
		<tr>
			<td align="center" colspan="2" style="width:180px; height:23px; border-color:#000000; font-size:16px ">ACTIVAR PARTE</td><br><br>
		</tr>
		<tr>
			<td>
				<label style="width:151px; color:#666666">Radicado:</label>
			</td>
			<td>
				<input type="hidden" name="id" id="id" readonly="true" value="<?php echo trim($id); ?>">
				<input type="hidden" name="idclaseparte" id="idclaseparte" readonly="true" value="<?php echo trim($idclaseparte); ?>">
				<input type="text" name="radicadox" id="radicadox" readonly="true" value="<?php echo trim($datoradicado); ?>">
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
				<label style="width:151px; color:#666666">Parte del Proceso:</label>
			</td>
											
			<td>
												
				<select name="parteproceso" id="parteproceso" class="required">
									
					<option value="" selected="selected">Seleccionar Parte del Proceso</option> 
												
						<?php
							
							$sql = "    SELECT pa.id,pa.cedula,pa.nombre,cp.descripcion AS clasificacion, dir.direccion,
										dep.descripcion AS departamento, muni.descripcion AS municipio,pp.endevolucion,pp.idclaseparte
										FROM ((((((signot_proceso sp  LEFT JOIN signot_parteproceso pp ON sp.id = pp.idproceso)
										LEFT JOIN signot_parte pa ON pa.id = pp.idparte)
										LEFT JOIN signot_clasificacion_parte cp ON cp.id = pp.idclaseparte)
										LEFT JOIN signot_direccion dir ON dir.idproceso = pp.idproceso AND dir.idparte = pa.id)
										LEFT JOIN signot_pa_departamento dep ON dep.Cod_departamento = dir.iddepartamento)
										LEFT JOIN signot_pa_municipio muni ON muni.Cod_Municipio = dir.idmunicipio)
										WHERE sp.radicado = '$datoradicado'
										GROUP BY cp.descripcion,pa.cedula
										ORDER BY pa.nombre";
										
							$funcion->cargar_lista_con_filtro_general($sql);
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


