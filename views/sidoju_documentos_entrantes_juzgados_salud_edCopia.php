<?php
	$idusuario   = $_SESSION['idUsuario'];
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	$titulo     = "Registro Documentos Entrantes Juzgados";
	$subtitulo  = "REGISTROS DOCUMENTOS ENTRANTES JUZGADOS";
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new sidojuModel();
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	//OBTENEMOS LA HOAR ACTUAL
	$horaactual        = $modelo->get_hora_actual_24horas();
	//SOLO PARA VISUALIZACION DEL USUARIO, REALMENTE EL QUE SE REGISTRA EN LA BASE DE DATOS ES $horaactual
	$horaactualespejo  = $modelo->get_hora_actual_12horas();
	
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
			$titulo = "Modificar Documentos Entrantes Juzgados, Id: ".$d0;
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
		}
	}

	//ConsejoPN
	$serverName= "192.168.89.20";
        $datosbd_2 = "consejoPN";
        $datosbd_3 = "sa";
        $datosbd_4 = "M4nt3n1m13nt0";
	/*	$serverName = "DESKTOP-8FLD29P\SQLEXPRESS";
        $datosbd_2 = "ConsejoPN";
        $datosbd_3 = "sa";
        $datosbd_4 = "111";*/
        $conn = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
        $conn = sqlsrv_connect($serverName, $conn);

    $sql = ("SELECT a110llavproc FROM [$datosbd_2].[dbo].[t110dractuproc] WHERE t110dractuproc.[a110llavproc]="."'$d10'"." ORDER BY a110consactu;");
    //$params  = array();
    $stmt = sqlsrv_query($conn, $sql, $params);
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
	<!----------------------------------------------------------------------->
	<script src="views/js/jquery.js" type="text/javascript"></script>
	<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
	<script src="views/js/jquery.validate.js" type="text/javascript"></script>
	<script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                 	
	<link href="views/css/main.css" rel="stylesheet" type="text/css">
	<!-- USO DE ARCHVIO PARA VALIDACIONES DE CAMPOS Y APLICACION DE FUNCIONES -->
	<script src="views/js/ajax/ajax_sidoju.js" type="text/javascript" charset="utf-8"></script>
	<!-- PARA LAS VENTANAS EMERGENTES POPUPBOX -->
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
					<!-- NOTA: LOS ID DE LOS CAMPOS ME DAN LOS ESTILOS, UBICADOS EN centro_servicios\views\css\main.css
					TENIENDO EN CUENTA EL ID DE LA TABLA DONDE SE ENCUENTRAN LOS CAMPOS EN ESTE CASO frm_editar
					LA class="required" ME PERMITE VALIDAR UN CAMPO CON JQUERY
					EN action="" NO ENVIO NADA YA QUE ESTE LLAMADO SE REALIZA EN require 'secc_sigdoc.php';
					IGUAL FUNCIONA SI SE DEFINE ALGUNA ACCION-->
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
										<input type="text" name="fechae" id="fechae" class="required" value="<?php echo $fechaactual; ?>" readonly="true">
									</td>
								</tr>
								<tr>
									<td>
										<label style="width:151px; color:#666666">Hora:</label>
									</td>
									<td>
										<input type="hidden" name="horae" id="horae" class="required" value="<?php echo $horaactual; ?>" readonly="true">
										<input type="text" name="horaespejo" id="horaespejo" class="required" value="<?php echo $horaactualespejo; ?>" readonly="true">
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
									<td>
										<?php
										//if ($d0!='') { ?>
										<?php //} else { ?>
											 <select name="tipodocumento" id="tipodocumento" class="required">
												<option value="" selected="selected">Seleccionar Tipo Documento</option>
												<option value="7" disabled>Asunto de tutela</option>
												<option value="1" disabled>Circular</option>
												<option value="3" disabled>Despacho Comisorio</option>
												<option value="8" disabled>Expedientes</option>
												<option value="6" disabled>Extracto Bancario</option>
												<option value="5" disabled>Memorial</option>
												<option value="2" disabled>Oficio</option>
												<option value="4" disabled>Otro</option>
												<option value="9" disabled>Tutela Corte Constitucional</option>
												<option value="100" disabled>Incidente de Desacato en Salud</option>
											</select>
											<?php
												/*while($row = $datostipodocumento->fetch()){
													if($row[id] == $d4){
														echo "<option value=\"". $row[id] ."\" selected='selected'>" . $row[nombre_tipo_documento] . "</option>";
													} else {
														echo "<option value=\"". $row[id] ."\">" . $row[nombre_tipo_documento] . "</option>";
													}
												}*/
											?>
										</select>
										<?php //} ?>
									</td>
								</tr>
								<?php
									/*while($row = $datostipodocumento2->fetch()){
										echo .$row[id];
									}*/
								?>
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
								<tr>
									<td>
										<label style="width:151px; color:#666666">Juzgado Destino:</label>
									</td>
									<td>
										<select name="juzgadodestino" id="juzgadodestino" class="required">
											<option value="" selected="selected">Seleccionar Juzgado Destino</option> 
											<?php
												while($row = $datosjuzgadodestino->fetch()){
													if($row[id] == $d7){
														echo "<option value=\"". $row[id]."//////".$row[nombre] ."\" selected='selected' disabled>" . $row[nombre] . "</option>";
													}
													else{
														echo "<option value=\"". $row[id]."//////".$row[nombre] ."\" disabled>" . $row[nombre] . "</option>";
													}
												}
											?>
										</select>
									</td>
								</tr>
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
										<input type="file" name="archivo" id="archivo" title="Archivo" size="19" readonly/>
									</td>
								</tr>
						        <?php
						            while($rowCPN = sqlsrv_fetch_array($stmt)){
						                $a110llavproc  = $rowCPN['a110llavproc'];
						        ?>
						        <tr>
						            <td>
						                <label style="width:151px; color:#666666">Radicado:</label>
						            </td>
						            <td>
						                <input type="text" name="archivo" id="remitente" class="required" value="<?php echo $a110llavproc; ?>" maxlength="23" readonly="true"/>
						            </td>
						        </tr>
						        <?php
						            }
						        ?>
								<tr>
									<td>
										<div id="ok"></div>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<!-- SE PREGUNTA SI LA VARIABLE $vbton NO ES VACIA, YA QUE ESTO NOS INDICA QUE VAMOS A ACTUALIZAR UN DOCUMENTO
										Y POR ENDE EL VALOR PASA A Actualizar-->
										<center>
											<input type="submit" name="Submit" value="<?php if(empty($vbton)){ echo "Registrar";}else{echo "Actualizar";} ?>" id="btn_input"/>
											<!-- <input type="submit" name="Submit" value="<?php //if(empty($vbton)){ echo "Registrar";}else{echo "Actualizar";} ?>" id="btn_input" class="btn_validardj"/> -->
											<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
										</center>
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