<?php
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS

	//TITULO FORMULARIO
	$titulo     = "Imprimir Documentos Entrantes Juzgados (Aprobados)";
	$subtitulo  = "Lista Imprimir Documentos Entrantes Juzgados (Aprobados)";
	//$subtitulo2 = "Permisos Usuario";

	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo       = new sidojuModel();

	//OBTENEMOS LISTADO DE JUZGADOS SEGUN LOS ASIGNADOS AL USUARIO QUE INICIA SESION
	$datosjuzgadodestino = $modelo->get_lista_juzgados_usuario();

	//OBTENEMOS LISTADO DE LOS NOMBRES DE LOS BLOQUES, PARA IDENTIFICAR UN CONJUNTO
	//DE REGISTROS
	$datosnombrebloques = $modelo->get_lista_nombre_bloque();

	//OBTENEMOS EL REGISTRO DE ENTRADAS Y SALIDAS DEL USUARIO
	//AL CARGAR EL SCRIPT $opcion ES DIFERENTE DE 1, PERO
	//AL DAR CLIC EN EL ICONO DE FILTRO ES SE LE ASIGA 1
	//HACIEDO PÃ“SIBLE EL FILTRO EN LA TABLA SEGUN LAS FECHAS

	$opcion = trim($_GET['dato_0']);

	if($opcion != 1){
		$datosdocumentosentrantes = $modelo->get_documentos_imprimir_usuario(1);
	}
	else{
		$datosdocumentosentrantes = $modelo->get_documentos_imprimir_usuario(2);
		$datosnombrebloques       = $modelo->get_lista_nombre_bloque(trim($_GET['datox1']));
	}

	//**************************************************************************************************************************
	//EN ESTA PARTE DEFINO QUE USUARIOS PUEDO PONER A QUE EJECUTEN CIERTAS ACCIONES,COMO REGISTRAR,EDITAR, GENERAR UN REPORTE
	//SEGUN EN EL FORMULARIO QUE ME ENCUENTRE

	//$campos                         --> columna que contiene los codigos de los usuarios, los cuales van a ejecutar una accion especifica
	//$nombrelista                    --> tabla que contiene los registros de las acciones
	//$idaccion                       --> id de la accion a consultar en este caso (Editar, vista sigdoc_documentos_salientes.php)
	//$campoordenar                   --> campo por el que se ordena la consulta a la tabla pa_usuario_acciones
	//$datosusuarioacciones,$usuarios --> variables donde obtengo los valores de los usuarios concatenados de esta forma 46////55////45
	//$usuariosa                      --> vector donde se cargan los codigos de los usuarios, y donde se comparara con
    //	                                  if ( in_array($_SESSION['idUsuario'],$usuariosa) )
	//                                    segun el usuario logeado en el sistema y si dicho usuario puede ejecutar una accion especifica
	//**************************************************************************************************************************

	/*$campos               = 'usuario';
	$nombrelista          = 'pa_usuario_acciones';
	$idaccion			  = '3';
	$campoordenar         = 'id';
	$datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuarios             = $datosusuarioacciones->fetch();
	$usuariosa			  = explode("////",$usuarios[usuario]);

	//print_r($datosusuarioacciones->fetch());
	//echo $usuarios[usuario];*/
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

<!------------------------------------------------------------------------>
<script src="views/js/jquery.js" type="text/javascript"></script>
<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
<script src="views/js/jquery.validate.js" type="text/javascript"></script>
<script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>
<link href="views/css/pepper-grinder/ui.all.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
<link href="views/css/main.css" rel="stylesheet" type="text/css">

<!-- -------------------------------------------------------------------- -->

<!-- USO DE ARCHVIO PARA VALIDACIONES DE CAMPOS Y APLICACION DE FUNCIONES -->
<script src="views/js/ajax/ajax_sidoju.js" type="text/javascript" charset="utf-8"></script>

<!-- PARA LAS FECHAS -->
<!--<script type="text/javascript" src="views/fechajquery/jquery.datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="views/fechajquery/jquery.datetimepicker.css"/ >-->

<!-- PARA LAS VENTANAS EMERGENTES POPUPBOX -->
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

	//aqui puedo pegar el codigo del archivo ubicado en  views/js/ajax/ajax_sigdoc.js
	//y que esta entre $(function(){ });


});

</script>

</head>

<body>

	<?php
		//imagen principal TEMIS, y iconos volver al menu principal y cerrar sesion
		require 'header.php';
		//menus, con imagen del modulo
		require 'secc_sidoju.php';

	?>

	<table border="0" cellspacing="0" cellpadding="0" align="center">

		<tr>
    		<td></td>
  		</tr>

		 <tr>
    		<td>
				<!-- NOTA: LOS ID DE LOS CAMPOS ME DAN LOS ESTILOS, UBICADOS EN centro_servicios\views\css\main.css
				TENIENDO EN CUENTA EL ID DE LA TABLA DONDE SE ENCUENTRAN LOS CAMPOS EN ESTE CASO frm_editar
				LA class="required" ME PERMITE VALIDAR UN CAMPO CON JQUERY-->
				<div id="contenido">

					<form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">


					 	<div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>

						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">


							<tr>
								<td>
									<label style="width:151px; color:#666666">Fecha Inicial:</label>
								</td>
								<td>
									<input type="text" name="fechai" id="fechai" class="required" readonly="true" value="<?php echo trim($_GET['dato_1']); ?>">
								</td>
								<td>
									<label style="width:151px; color:#666666">Fecha Final:</label>
								</td>
								<td>
									<input type="text" name="fechaf" id="fechaf" class="required" readonly="true" value="<?php echo trim($_GET['dato_2']); ?>">
								</td>

							</tr>

							<tr>
								<td>
									<label style="width:151px; color:#666666">Juzgado Destino:</label>

								</td>

								<td colspan="4">

									<select name="juzgadodestinoin" id="juzgadodestinoin" class="required">

										<option value="" selected="selected">Seleccionar Juzgado Destino</option>

										<?php
											while($row = $datosjuzgadodestino->fetch()){


												//echo "<option value=\"". $row[id] ."\">" . $row[nombre] . "</option>";

												if($row[id] == trim($_GET['datox1'])){
													echo "<option value=\"". $row[id] ."\" selected='selected'>" . $row[nombre] . "</option>";
												}
												else{
													echo "<option value=\"". $row[id] ."\">" . $row[nombre] . "</option>";
												}

											}
										?>
									</select>



								</td>



							</tr>

							<tr>

								<td>
									<label style="width:151px; color:#666666">Bloque:</label>

								</td>

								<td>

									<select name="listabloques" id="listabloques" class="required">

										<option value="" selected="selected">Seleccionar Bloque</option>

										<?php
											while($row = $datosnombrebloques->fetch()){


												echo "<option value=\"". $row[nombrebloque] ."\">" . $row[nombrebloque] . "</option>";

												/*if($row[id] == trim($_GET['datox1'])){
													echo "<option value=\"". $row[id] ."\" selected='selected'>" . $row[nombre] . "</option>";
												}
												else{
													echo "<option value=\"". $row[id] ."\">" . $row[nombre] . "</option>";
												}*/

											}
										?>
									</select>

								</td>

								<td colspan="2">
									<a class="imprimirbloque" href="javascript:void(0);" title="Imprimir"><img src="views/images/imprimir2.jpg" width="45" height="45" title="Imprimir"/>Imprimir Bloque</a>
								</td>

							</tr>


							<!-- -----------------------------BOTONES--------------------------------------------------------- -->
							<tr>

								<td colspan="4">
									<center>
										<input type="button" name="consultar" value="Consultar" id="btn_input" class="filtrare3">
										<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
									</center>
								</td>

						  	</tr>

							<!-- ----------------------------------------------------------------------------------------------- -->


						</table>

					</form>
					<div id="loadContent" class="loadContent2">
						<div id="load" class="load"></div>
						<b>Cargando...</b>
					</div>
				</div>

			</td>
		</tr>


	</table>

	<?php
	//PREGUNTO SI SE A ENVIADO ALGUN FILTRO PARA QUE LA TABLA SEA VISIBLE.
	//if(!empty($opcion)){
	?>
	<table border="0" align="center"  rules="rows" id="tablaconsulta">


				<tr>

					<td>

						<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_editar1">

							<thead>

										<tr>
											<th bgcolor="#CDE3F9" colspan="16">
												<center><div id="titulo_frm"><?php echo strtoupper($subtitulo); ?></div></center>
											</th>
										</tr>

										<tr>
											<th>NUMERO</th>
											<th>CONSECUTIVO</th>
											<th>TIPO</th>
											<th>NOMBRE/FOLIOS/CARPETAS</th>
											<th>FECHA</th>
											<th>HORA</th>
											<th>RECIBE</th>
											<!-- <th>REMITENTE</th> -->
											<th>JUZGADO</th>
											<!-- <th>RUTA ARCHIVO</th> -->
											<th>
												<!-- <input type="button" onclick="marcar(':checkbox')" value="Marcar todos"> -->
												<a class="marcar" href="javascript:void(0);" title="Marcar todos"><img src="views/images/OK1.jpg" width="20" height="20" title="Marcar todos"/></a>
											</th>
											<!-- <img src="views/images/respuesta.gif" width="35" height="35" title="DAR RESPUESTA DOCUMENTO"/> -->
											<th>
												<!-- <input type="button" onclick="desmarcar(':checkbox')" value="Desmarcar"> -->
												<a class="desmarcar" href="javascript:void(0);" title="Desmarcar todos"><img src="views/images/pendiente.jpg" width="20" height="20" title="Desmarcar todos"/></a>
											</th>
											<th>|</th>

											<th>
												<a class="imprimirregistros" href="javascript:void(0);" title="Imprimir"><img src="views/images/imprimir.jpg" width="45" height="45" title="Imprimir"/></a>
											</th>
										</tr>
									</thead>

									<tbody>


										<?php $i=2; while($row = $datosdocumentosentrantes->fetch()){ ?>

											<tr>
												<td><?php echo $row[id];?></td>
												<td><?php echo $row[numero];?></td>
												<td><?php echo $row[nombre_tipo_documento];?></td>
												<td><?php $newtext = wordwrap($row[nfc], 20, "\n", true); echo $newtext;?></td>
												<td><?php echo $row[fecha];?></td>
												<td><?php echo $row[hora];?></td>
												<td><?php echo $row[empleado];?></td>
												<!-- <td><?php //echo $row[remitente];?></td> -->
												<td><?php echo $row[nombre];?></td>
												<!-- <td><?php //echo $row[rutaarchivo];?></td> -->


												<td><input type="checkbox" name="<?php echo "chkk".$i;?>" id="<?php echo "chkk".$i;?>" value="<?php echo "chkk".$i;?>"/></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>


												<!--<td><a class="editare" href="javascript:void(0);" data-id="<?php //echo $row['id'];?>"><img src="views/images/modficar.jpg" width="35" height="35" title="EDITAR DOCUMENTO"/></a></td>

												<td><a class="darrespuesta" href="javascript:void(0);" data-idrespuesta="<?php //echo $row['id'];?>" data-fecharespuesta="<?php //echo $row['fecharespuesta'];?>"><img src="views/images/respuesta.gif" width="35" height="35" title="DAR RESPUESTA DOCUMENTO"/></a></td> -->




											</tr>

										<?php $i=$i+1; } ?>

									</tbody>
							</table>

						</td>
					</tr>


			</table>

			<?php
			//}
			?>




<?php require 'alertas.php';?>
</body>
</html>