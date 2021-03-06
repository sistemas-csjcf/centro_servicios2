<?php

	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS

	//TITULO FORMULARIO
	$titulo     = "Aprobar Documentos Entrantes Juzgados";
	$subtitulo  = "Lista Aprobar Documentos Entrantes Juzgados";
	//$subtitulo2 = "Permisos Usuario";

	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo       = new sidojuModel();
	$fechaactual = $modelo->get_fecha_actual_amd();
	$idusuario   = $_SESSION['idUsuario'];
	$opcion = trim($_GET['dato_0']);

	if($opcion != 1){
		$datosdocumentosentrantes = $modelo->get_documentos_entrantes_juzgado(1);
	}
	else{
		$datosdocumentosentrantes = $modelo->get_documentos_entrantes_juzgado(2);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?php echo $titulo?></title>
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
<script type="text/javascript" src="views/fechajquery/jquery.datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="views/fechajquery/jquery.datetimepicker.css"/ >

<!-- PARA LAS VENTANAS EMERGENTES POPUPBOX
<script src="views/js/ajax/ajax_popupbox_empleados_registro_entrada_salida.js" type="text/javascript" charset="utf-8"></script>-->
<link href="views/css/stylepopupbox.css" rel="stylesheet" type="text/css">
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
 <style>
	.alternar:hover{ background-color:#dddddd;color:#000 !important;}
	.tabla2{padding: 4px 7px !important;color: #666;text-align: left;}
	#frm_editar1 td {padding: 4px 10px !important }
</style>
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
								<td colspan="4">
									<center>
										<input type="button" name="consultar" value="Consultar" id="btn_input" class="filtrareD">
										<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
									</center>
								</td>
						  	</tr>
					</table>
					<div id="msgT"></div>
					<div id="loadContent" class="loadContent2">
						<div id="load" class="load"></div>
						<b>Cargando...</b>
					</div>
					</form>
				</div>
			</td>
		</tr>
	</table>
	<table border="0" align="center"  rules="rows" id="tablaconsulta" class="non">
		<tr>
			<td>
				<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_editar1" style="box-shadow: 1px 15px 0px white !important;border-color: #96898973 !important;">
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
						<th>ARCHIVO<th>
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
							<a class="aprobar2" href="javascript:void(0);" title="APROBAR"><img src="views/images/OK3.png" width="45" height="45" title="APROBAR"/></a>
						</th>
							<!-- <th>
								<a class="imprimir" href="javascript:void(0);" title="Imprimir"><img src="views/images/imprimir.jpg" width="45" height="45" title="Imprimir"/></a>
							</th> -->
						</tr>
					</thead>

					<tbody>
					<?php
					$i=2;
					if (!empty($datosdocumentosentrantes)){
					while($row = $datosdocumentosentrantes->fetch()){ ?>
					<tr>
						<td><?php echo $row[id];?></td>
						<td><?php echo $row[numero];?></td>
						<td><?php echo $row[nombre_tipo_documento];?></td>
						<td><?php $newtext = wordwrap($row[nfc], 20, "\n", true); echo $newtext;?></td>
						<td><?php echo $row[fecha];?></td>
						<td><?php echo $row[hora];?></td>
						<td><?php echo $row[empleado];?></td>
						<td><?php echo $row[nombre];?></td>
						<?php
							echo "<td><a href='".$row[rutaarchivo]."' target='_blank'><img src='/centro_servicios2/consultextern/img/pdf.png' width='40'></a></td>";;
						?>
						<td><input type="checkbox" name="<?php echo "chk".$i;?>" id="<?php echo "chk".$i;?>" value="<?php echo "chk".$i;?>"/></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<!--<td><a class="editare" href="javascript:void(0);" data-id="<?php //echo $row['id'];?>"><img src="views/images/modficar.jpg" width="35" height="35" title="EDITAR DOCUMENTO"/></a></td>

						<td><a class="darrespuesta" href="javascript:void(0);" data-idrespuesta="<?php //echo $row['id'];?>" data-fecharespuesta="<?php //echo $row['fecharespuesta'];?>"><img src="views/images/respuesta.gif" width="35" height="35" title="DAR RESPUESTA DOCUMENTO"/></a></td> -->
					</tr>

					<!--<tr>
						<td><?php echo $row[id];?></td>
						<td><?php echo $row[numero];?></td>
						<td><?php echo $row[nombre_tipo_documento];?></td>
						<td><?php $newtext = wordwrap($row[nfc], 20, "\n", true); echo $newtext;?></td>
						<td><?php echo $row[fecha];?></td>
						<td><?php echo $row[hora];?></td>
						<td><?php echo $row[empleado];?></td>
						<td><?php echo $row[nombre];?></td>
						<?php if ($row[idtipodocumento]==100) {
							$idmodificar=$row['sal_id_externo_fk'];
						} else  {
							$idmodificar=$row['id'];
						}
						?>
						<td><input type="checkbox" name="casilla[]" value="<?php echo $idmodificar; ?>"></td>
					</tr>-->
					<?php $i=$i+1; }
					}
					?>
				</tbody>
			</table>
		</form>
		<?php require 'alertas.php';?>
	</body>
</html>
