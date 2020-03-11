<?php
	$idusuario   = $_SESSION['idUsuario'];
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	$titulo     = "Incidente de Desacato en Salud - Documentos Entrantes Juzgados";
	$subtitulo  = "VER DOCUMENTOS ENTRANTES JUZGADOS";
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new sidojuModel();

	//OBTENEMOS LISTADO SEGUN LA LISTA SOLICITADA
	$nombrelista  = 'sigdoc_pa_tipodocumento';
	$campoordenar = 'nombre_tipo_documento';
	$datostipodocumento = $modelo->get_lista($nombrelista,$campoordenar);
	$datostipodocumento2 = $modelo->get_lista($nombrelista,$campoordenar);
	$nombrelista  = 'pa_juzgado';
	$campoordenar = 'id';
	$datosjuzgadodestino = $modelo->get_lista($nombrelista,$campoordenar);

	if(!empty($datosdocumento)){
		$vbton  = "Actualizar";
		while($fila = $datosdocumento->fetch()){
			$d0  = $fila[id];
			$titulo = "INCIDENTE DE DESACATO EN SALUD, Id: ".$d0;
			$d1  = $fila[fecha];
			$fechaactual = $d1;
			$d2  = $fila[hora];
			$horaactual = $d2;
			$d3  = $fila[remitente];
			$d4  = $fila[idtipodocumento];
			$d5  = $fila[numero];
			$d6  = $fila[nfc];
			$d7  = $fila[idjuzgadodestino];
			//envio el id del juzgado para saber cual es el funcionario asignado a el
			//y cargar el campo empleado
			$d8  = $modelo->get_nombre_usuario_juzgado($d7);
			$row = $d8->fetch();
			$d8b = utf8_decode($row[empleado]);
			//$d9  = $fila[sal_id_externo_fk];
			$d10 = $fila['sal_radicado'];
			$d11  = $fila[rutaarchivo];
			$d12  = $fila[sal_observaciones];
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/> 
	<!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> --> 
	<title><?php echo $titulo?></title>
	<script src="views/js/jquery.js" type="text/javascript"></script>
	<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
	<script src="views/js/jquery.validate.js" type="text/javascript"></script>
	<script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                 	
	<link href="views/css/main.css" rel="stylesheet" type="text/css">
	<script src="views/js/ajax/ajax_sidoju.js" type="text/javascript" charset="utf-8"></script>
	<link href="views/css/stylepopupbox.css" rel="stylesheet" type="text/css">
	<script type="text/javascript">
		$(document).ready(function(){
			$("#tipodocumento").change(function(){
				if ( $("#tipodocumento option:selected").val() == '100'){
					window.location = '/centro_servicios2/index.php?controller=sidoju&action=Registro_Documentos_Entrantes_Juzgados_Salud';
				}
			});
		});
	</script>
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
	</head>
	<body>
		<?php 
			require 'header.php';
			require 'secc_sidoju.php';
		?>			
		<table border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
	    		<td>
					<div id="contenido">
						<form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
							<input name="iddocumento" id="iddocumento" type="hidden" readonly="true"  value="<?php echo $d0; ?>">
							<!-- <input name="consecutivodocumento" id="consecutivodocumento" type="hidden" readonly="true"/> -->
							<input name="iduser" id="iduser" type="hidden" readonly="true"  value="<?php echo $idusuario; ?>">
						 	<div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>
							<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
								<tr>
									<td>
										<label style="width:151px; color:#666666">Fecha:</label>
									</td>
									<td>
										<input type="text" name="fechae" id="fechae" class="required" value="<?php echo $d1; ?>" readonly="true">
									</td>
								</tr>
								<tr>
									<td>
										<label style="width:151px; color:#666666">Hora:</label>
									</td>
									<td>
										<input type="hidden" name="horae" id="horae" class="required" value="<?php echo $horaactual; ?>" readonly="true">
										<input type="text" name="horaespejo" id="horaespejo" class="required" value="<?php echo $d2; ?>" readonly="true">
									</td>
								</tr>
								<tr>
						            <td>
						                <label style="width:151px; color:#666666">Remitente:</label>
						            </td>
						            <td>
						                <input type="text" name="txt_remitente" id="remitente" class="required" value="<?php echo $d3; ?>" maxlength="155" readonly="true"/>
						            </td>
						        </tr>
								<tr>
									<td>
										<label style="width:151px; color:#666666">Tipo Documento:</label>
									</td>
									<td><input type="text" id="remitente" value="Incidente de Desacato en Salud" readonly></td>
								</tr>
								<tr>
									<td>
										<label style="width:151px; color:#666666">N&#250;mero Documento:</label>
									</td>
									<td>
										<input type="text" name="numerodoce" id="numerodoce" class="required" value="<?php echo $d5; ?>" readonly/>
									</td>
								</tr>
								<tr>
									<td>
										<label style="width:151px; color:#666666">Nombre/Folios/Cuadernos:</label>
									</td>
									<td>
										<input type="text" name="nfc" id="nfc" class="required" value="<?php echo $d6; ?>" readonly/>
									</td>
								</tr>
								<!--<tr>
									<td>
										<label style="width:151px; color:#666666">Juzgado Destino:</label>
									</td>
									<td>
										<select name="juzgadodestino" id="juzgadodestino" class="required">
											<option value="" selected="selected">Seleccionar Juzgado Destino</option> 
											<?php
												/*while($row = $datosjuzgadodestino->fetch()){
													if($row[id] == $d7){
														echo "<option value=\"". $row[id]."//////".$row[nombre] ."\" selected='selected' disabled>" . $row[nombre] . "</option>";
													}
													else{
														echo "<option value=\"". $row[id]."//////".$row[nombre] ."\" disabled>" . $row[nombre] . "</option>";
													}
												}*/
											?>
										</select>
									</td>
								</tr>-->
								<tr>
									<td>
										<label style="width:151px; color:#666666">Empleado:</label>
									</td>
									<td>
										<input name="nombreusuariojuzgado" id="nombreusuariojuzgado" type="text"  class="required" readonly="true" value="<?php echo utf8_decode($d8b); ?>">
									</td>
								</tr>
								<tr>
									<td>
										<label style="width:151px; color:#666666">Archivo</label>
									</td>
									<td>
										<a href="ftp://192.168.89.28/<?php echo $d11;?>" title="Desacargar Archivo" style="color:#0000FF">
											<?php $newtext = wordwrap($d11, 20, "\n", true); echo $newtext;?></a>
									</td>
								</tr>
								<tr>
									<td>
										<label style="width:151px; color:#666666">Observaciones</label>
									</td>
									<td>
										<textarea cols="34" readonly><?php echo $d12; ?></textarea>
									</td>
								</tr>
							</table>
						</form>
					</div>
				</td>
			</tr>
		</table>	
	<?php require 'alertas.php';?>
	</body>
</html>