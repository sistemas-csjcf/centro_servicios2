<?php 
session_start(); 

if($_SESSION['id']!=""){

$id_vista	   = trim($_POST['id_vista']);
$idprocesox    = trim($_POST['idprocesox']);
$desidprocesox = trim($_POST['desidprocesox']);
$idpartex      = trim($_POST['idpartex']);
$desidpartex   = trim($_POST['desidpartex']);

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

<script src="views/js/ajax/ajax_signot.js" type="text/javascript"></script>


	<form name ="formcorres_1" id="formcorres_1"> 
	
		<div class="buttonsBar">
		
			<button id="cancel" type="button" name="boton_cancelar" title="Cerrar"><img src="images/imagenesbotones/cancel2.png" width="25" height="25"/></button>
			<!-- <button id="registrar" type="submit" name="boton_registrar" title="Registrar"><img src="images/imagenesbotones/save.png" width="25" height="25"/></button> -->
			
		</div>
	
		<table border="0" align="center">
		
			<tr>
				<td align="center" colspan="2" style="width:180px; height:23px; border-color:#000000; font-size:16px ">DIRECCIONES PARTE</td><br><br>
			</tr>
			
			<tr>
				
				<td>
					<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">RADICADO:</label><br>
					<input type="text" name="idprocesox" id="idprocesox" readonly="true" value="<?php echo trim($desidprocesox); ?>" style="width:300px; height:23px; border-color:#000000; font-size:18px; color:#0066CC; text-align:right ">
					
				</td>
					
			</tr>
			
			
			<tr>
				
				<td>
					
					<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">PARTE:</label><br>
					<input type="text" name="valorradicado" id="valorradicado" readonly="true" value="<?php echo trim($desidpartex); ?>" style="width:300px; height:23px; border-color:#000000; font-size:18px; color:#0066CC; text-align:right ">
				</td>
					
			</tr>
			
								
			<tr>
				
												
				<td>
													
													
							<?php
							
								$idsql = 1;
								
								$registros = $funcion->get_direcciones_parte($idprocesox,$idpartex,$idsql);
								
								/*echo '<script languaje="JavaScript"> 
					
										var dat_1 = "'.$registros.'";
						
										alert(dat_1);
								
									</script>';*/
								
								
							?>
							
							
							
							
					<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="tcorres_1">
																		
						<thead> 
																		
							<tr> 
																			
								<th>ID</th>
								<th>ID PARTE</th>
								<th>ID PROCESO</th>
								<th>DIRECCION</th>
								<th>DEPARTAMENTO</th>
								<th>MUNICIPIO</th>
								<th>ESTADO</th>
								
								<th>
									<strong style="width:151px; color:#FF0000; font-size:12px">INACTIVAR</strong>
								</th>
								<th>
									<strong style="width:151px; color:#FF0000; font-size:12px">CAMBIAR ESTADO</strong>
								</th>
																			
							</tr> 
							
						</thead> 
																					
						<tbody> 
																					
							<?php 
																		
								$datosX  = explode("*/-*/-",$registros); 
								$longitud = count($datosX);
								$i          = 0;
								//echo $longitud_1;
																		
								while($i < $longitud - 1){ 
																		
									$datosX_2 = explode("------",$datosX[$i]);
																		
								?>
																
								<tr>
									
									<td>
										<?php 
																						  
											echo $datosX_2[0];  
										?>
									</td>
									
									<td>
										<?php 
																						  
											echo $datosX_2[1];  
										?>
									</td>
									
									<td>
										
										<?php 
																						  
											echo $datosX_2[2];  
										?>
										
									</td>
									
									<td>
										<?php 
																						  
											echo $datosX_2[3];  
										?>
									</td>
									
									<td>
										<?php 
																						  
											echo $datosX_2[4];  
										?>
									</td>
									
									<td>
										<?php 
																						  
											echo $datosX_2[5];  
										?>
									</td>
									
									<td>
										<?php 
																						  
											echo $datosX_2[6];  
										?>
									</td>
									
									
									<td>
										<a class="inactivardir" href="javascript:void(0);" title="INACTIVAR" data-iddir="<?php echo trim($datosX_2[0]);?>" data-idproc="<?php echo trim($idprocesox);?>" data-desproc="<?php echo trim($desidprocesox);?>"><img src="views/images/pendiente.jpg" width="20" height="20" title="INACTIVAR"/></a>
									</td>
																				
									<td>
										<a class="cambiarestado" href="javascript:void(0);" title="CAMBIARESTADO" data-iddir="<?php echo trim($datosX_2[0]);?>" data-idproc="<?php echo trim($idprocesox);?>" data-desproc="<?php echo trim($desidprocesox);?>"><img src="views/images/corregir2.pNg" width="30" height="30" title="CAMBIAR ESTADO"/></a>
									</td>
																				
								</tr>
																		
																					
								<?php $i = $i + 1;  } ?>
																					
							</tbody>
							
						</table>
					
					
				</td>
				
				
			</tr>
								
							
		</table>
		
	
	</form>

<?php } ?>


