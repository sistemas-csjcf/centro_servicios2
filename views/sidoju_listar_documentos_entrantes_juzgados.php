<?php
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	//TITULO FORMULARIO
	$titulo     = "Listar Documentos Entrantes Juzgados";
	$subtitulo  = "Lista Documentos Entrantes Juzgados";
	//$subtitulo2 = "Permisos Usuario";
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo       = new sidojuModel();
	//OBTENEMOS LISTADO DE JUZGADOS SEGUN LOS ASIGNADOS AL USUARIO QUE INICIA SESION
	//$datosjuzgadodestino = $modelo->get_lista_juzgados_usuario();
	//OBTENEMOS LISTADO SEGUN LA LISTA SOLICITADA

	$nombrelista  = 'sigdoc_pa_tipodocumento';
	$campoordenar = 'nombre_tipo_documento';
	$datostipodocumento = $modelo->get_lista($nombrelista,$campoordenar);

	$nombrelista   = 'pa_usuario';
	$campoordenar  = 'empleado';
	$datosuser     = $modelo->get_lista($nombrelista,$campoordenar);
	/*$nombrelista  = 'pa_juzgado';
	$campoordenar = 'id';
	$datosjuzgadodestino = $modelo->get_lista($nombrelista,$campoordenar);*/

	$campos               = 'usuario';
	$nombrelista          = 'pa_usuario_acciones';
	$idaccion			  = '13';
	$campoordenar         = 'id';
	$datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuarios             = $datosusuarioacciones->fetch();
	$usuariosa			  = explode("////",$usuarios[usuario]);
	//OBTENEMOS EL REGISTRO DE ENTRADAS Y SALIDAS DEL USUARIO
	//AL CARGAR EL SCRIPT $opcion ES DIFERENTE DE 1, PERO
	//AL DAR CLIC EN EL ICONO DE FILTRO ES SE LE ASIGA 1
	//HACIEDO PÃƒâ€œSIBLE EL FILTRO EN LA TABLA SEGUN LAS FECHAS
	$opcion = trim($_GET['dato_0']);
	if($opcion != 1){
		//PREGUNTAMOS SI EL USUARIO EN SESION ES UNO DE LOS 25 JUZGADOS
		//PARA QUE SOLO LISTE LO DE ESE JUZGADO, SEA CON FILTRO O SIN FILTRO
		//CON LA FUNCION get_listrar_documentos_entrantes_usuario_2
		//SI NO ES NINGUN USUARIO DE JUZGADO FILTRA DE TODOS LOS JUZGADOS
		//CON LA FUNCION get_listrar_documentos_entrantes_usuario
		if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
			$nombrelista  = 'pa_usuario';
			$campoordenar = 'id';
			$filtro       = 'WHERE id = '.$_SESSION['idUsuario'];
			$formaordenar = '';
			$datosuser    = $modelo->get_lista_filtro($nombrelista,$campoordenar,$filtro,$formaordenar);
			$filauser     = $datosuser->fetch();
			$datosuser2   = $filauser[idjuzgadousuario];
			$datosdocumentosentrantes = $modelo->get_listrar_documentos_entrantes_usuario_2(1,$datosuser2);
		} else {
			$datosdocumentosentrantes = $modelo->get_listrar_documentos_entrantes_usuario(1);
		}
	} else {
		if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
			$nombrelista  = 'pa_usuario';
			$campoordenar = 'id';
			$filtro       = 'WHERE id = '.$_SESSION['idUsuario'];
			$formaordenar = '';
			$datosuser    = $modelo->get_lista_filtro($nombrelista,$campoordenar,$filtro,$formaordenar);
			$filauser     = $datosuser->fetch();
			$datosuser2   = $filauser[idjuzgadousuario];

			$datosdocumentosentrantes = $modelo->get_listrar_documentos_entrantes_usuario_2(2,$datosuser2);

			//CANTIDAD DE REGISTROS
			$datosdocumentosentrantes_b = $modelo->get_listrar_documentos_entrantes_usuario_cantidad_2(2,$datosuser2);
			$filax                      = $datosdocumentosentrantes_b->fetch();
			$cantregistros              = $filax[cantidad];
		} else {
			$datosdocumentosentrantes   = $modelo->get_listrar_documentos_entrantes_usuario(2);
			//CANTIDAD DE REGISTROS
			$datosdocumentosentrantes_b = $modelo->get_listrar_documentos_entrantes_usuario_cantidad(2);
			$filax                      = $datosdocumentosentrantes_b->fetch();
			$cantregistros              = $filax[cantidad];
		}
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
	$idaccion			  = '13';
	$campoordenar         = 'id';
	$datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuarios             = $datosusuarioacciones->fetch();
	$usuariosa			  = explode("////",$usuarios[usuario]);*/

	//print_r($datosusuarioacciones->fetch());
	//echo $usuarios[usuario];*/

	//SE COMPRUEBA QUE EL USUARIO EN SESION SEA UNO DE LOS 25 JUZGADOS
	//SI ES EL CASO LA LISTA Juzgado Destino: SOLO CARGA CON EL JUZGADO EN SESION
	//SI NO CARGA TODOS LOS JUZGADOS, PARAESTO SE TIENE EN CUENTA LA ACCION 13 DEFINIDA EN
	//LA TABLA pa_usuario_acciones LA CUAL CONTIENE LOS ID DE LOS USUARIOS DE LOS 25 JUZGADOS
	if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {

		$nombrelista  = 'pa_usuario';
		$campoordenar = 'id';
		$filtro       = 'WHERE id = '.$_SESSION['idUsuario'];
		$formaordenar = '';
		$datosuser    = $modelo->get_lista_filtro($nombrelista,$campoordenar,$filtro,$formaordenar);
		$filauser     = $datosuser->fetch();
		$datosuser2   = $filauser[idjuzgadousuario];

		$nombrelista  = 'pa_juzgado';
		$campoordenar = 'id';
		$filtro       = 'WHERE id = '.$datosuser2;
		$formaordenar = '';
		$datosjuzgadodestino = $modelo->get_lista_filtro($nombrelista,$campoordenar,$filtro,$formaordenar);
	}
	else{
		$nombrelista  = 'pa_juzgado';
		$campoordenar = 'id';
		$datosjuzgadodestino = $modelo->get_lista($nombrelista,$campoordenar);
	}

		//Busqueda de incidentes en salud en la BD externa
		$fechad = trim($_GET['dato_1']);
		$fechah = trim($_GET['dato_2']);
		if (!empty($fechad) && !empty($fechah) ) {
			$fecha = " AND (sal_fecha >= '$fechad' AND sal_fecha <= '$fechah') ";
		}

		$horai = trim($_GET['datox2']);
		$horaf = trim($_GET['datox3']);
		if (!empty($horai) && !empty($horaf) ) {
			$hora = " AND (sal_hora >= '$horai' AND sal_hora <= '$horaf') ";
		}

		$remitente = trim($_GET['datox4']);
		if (!empty($remitente) ) {
			$remitente1 = " AND sal_remitente LIKE '%$remitente%' ";
		}

		$nfc = trim($_GET['datox7']);
		if (!empty($nfc) ) {
			$nfc1 = " AND sal_nfc LIKE '%$nfc%' ";
		}

		$juzgado = $_GET['datox1'];
		if (!empty($juzgado) ) {
			$juzgado1 = " AND sal_id_juzgado_int = '$juzgado' ";
		}

		$usuario = $_GET['datox9'];
		if (!empty($usuario) ) {
			$usuario1 = " AND sal_id_usuario = '$usuario' ";
		}

		$chk = $_GET['datox10'];
		if ($chk == "1") {
			$chk1 = " AND chk = '$chk' ";
		} if ($chk != "1") {
			$chk2 = " AND chk = '$chk' ";
		}

		$filtrox = $juzgado1." ".$fecha." ".$hora." ".$remitente1." ".$nfc1." ".$usuario1." ".$chk1." ".$chk2;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
<script src="views/js/jquery.js" type="text/javascript"></script>
<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
<script src="views/js/jquery.validate.js" type="text/javascript"></script>
<script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>
<link href="views/css/pepper-grinder/ui.all.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
<link href="views/css/main.css" rel="stylesheet" type="text/css">
<!-- USO DE ARCHVIO PARA VALIDACIONES DE CAMPOS Y APLICACION DE FUNCIONES -->
<script src="views/js/ajax/ajax_sidoju.js" type="text/javascript" charset="utf-8"></script>
<!-- PARA LAS FECHAS -->
<script type="text/javascript" src="views/fechajquery/jquery.datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="views/fechajquery/jquery.datetimepicker.css"/ >
<!-- PARA LAS VENTANAS EMERGENTES POPUPBOX -->
<script src="views/js/ajax/ajax_popupbox_empleados_registro_entrada_salida.js" type="text/javascript" charset="utf-8"></script>
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
								<td>
									<label style="width:151px; color:#666666">Hora Inicial:</label>
								</td>
								<td>
									<input type="time" id="horaji" name="horai" title="Hora Inicial" value="<?php echo trim($_GET['datox2']); ?>">
								</td>
								<td>
									<label style="width:151px; color:#666666">Hora Final:</labe>
								</td>
								<td>
									<input type="time" id="horajf" name="horaf" title="Hora Final" value="<?php echo trim($_GET['datox3']); ?>">
								</td>
							</tr>
							<tr>
								<td>
									<label style="width:151px; color:#666666">Remitente:</label>
								</td>
								<td>
									<input type="text" name="remitente" id="remitente" class="required" value="<?php echo trim($_GET['datox4']); ?>"/>
								</td>
								<td>
									<label style="width:151px; color:#666666">Tipo Documento:</label>
								</td>
								<td>
									<select name="tipodocumento" id="tipodocumento" class="required">
										<option value="" selected="selected">Seleccionar Tipo Documento</option>
										<?php
											while($row = $datostipodocumento->fetch()){

												if($row[id] == trim($_GET['datox5'])){
													echo "<option value=\"". $row[id] ."\" selected='selected'>" . $row[nombre_tipo_documento] . "</option>";
												}
												else{
													echo "<option value=\"". $row[id] ."\">" . $row[nombre_tipo_documento] . "</option>";
												}
											}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label style="width:151px; color:#666666">Numero Documento:</label>
								</td>
								<td>
									<input type="text" name="numerodoce" id="numerodoce" class="required" value="<?php echo trim($_GET['datox6']); ?>"/>
								</td>
								<td>
									<label style="width:151px; color:#666666">Nombre/Folios/Cuadernos:</label>
								</td>
								<td>
									<input type="text" name="nfc" id="nfc" class="required" value="<?php echo trim($_GET['datox7']); ?>"/>
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
								<td>
									<label style="width:151px; color:#666666">Usuario:</label>
								</td>
								<td colspan="3">
									<select name="usuariox" id="usuariox">
										<option value="" selected="selected">Seleccionar Usuario</option>
										<?php
											while($row = $datosuser->fetch()){
												//PREGUNTO QUE OPCION SE ENVIO PARA SER SELECCIONADA
												//DE LA VISTA sigdoc_listar_documentos_salientes.php
												//AL DAR CLIC EN CONSULTAR
												if($row[id] == trim($_GET['datox9'])){
													echo "<option value=\"". $row[id] ."\" selected='selected'>" . $row[empleado] . "</option>";
												}
												else{
													echo "<option value=\"". $row[id] ."\">" . $row[empleado] . "</option>";
												}
											}
										?>
									</select>
								</td>
								<!-- <td>
									<label style="width:151px; color:#666666">Empleado:</label>
								</td>
								<td>
									<input name="nombreusuariojuzgado" id="nombreusuariojuzgado" type="text"  class="required" readonly="true">
								</td> -->
							</tr>
							<tr>
								<td>
									<label style="width:151px; color:#666666">Estado:</label>
								</td>
								<td colspan="3">
									<select name="estadox" id="estadox" class="required">
										<option value="" selected="selected">Seleccionar Estado</option>
												<?php if( trim($_GET['datox10']) == "1" ){ ?>
													<option value="1" selected="selected">Aprobado</option>
													<option value="0" >No Aprobado</option>
												<?php }
												elseif( trim($_GET['datox10']) == "0" ){ ?>
													<option value="1">Aprobado</option>
													<option value="0" selected="selected">No Aprobado</option>
												<?php } else{?>
													<option value="1">Aprobado</option>
													<option value="0">No Aprobado</option>
												<?php } ?>
											</select>
										</td>
									</tr>
									<tr>
										<td colspan="4">
											<center>
												<input type="button" name="consultar" value="Consultar" id="btn_input" class="filtrare2">
												<input type="hidden" name="action" value="adicionar" />
												<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
											</center>
										</td>
								  	</tr>
								</table>
							</form>
							<div id="msgT"></div>
						</div>
					</td>
				</tr>
			</table>
			<div id="loadContent" class="loadContent2">
				<div id="load" class="load"></div>
				<b id="crgnd">Cargando...</b>
			</div>
			<?php
			//PREGUNTO SI SE A ENVIADO ALGUN FILTRO PARA QUE LA TABLA SEA VISIBLE.
			if(!empty($opcion)){
			?>
			<table border="0" align="center"  rules="rows" id="tablaconsulta">
				<tr>
					<td>
						<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_editar1" style="box-shadow: 1px 0px 0px grey !important;">
							<thead>
								<tr>
									<th bgcolor="#CDE3F9" colspan="16">
										<div id="titulo_frm"><?php echo "TOTAL REGISTROS: ".$cantregistros; ?></div>
									</th>
								</tr>
								<tr>
									<th bgcolor="#CDE3F9" colspan="16">
										<center><div id="titulo_frm"><?php echo strtoupper($subtitulo); ?></div></center>
									</th>
								</tr>
								<tr>
									<th>NUMERO</th>
									<th>INCIDENTE</th>
									<th>TIPO</th>
									<th>NOMBRE/FOLIOS/CARPETAS</th>
									<th>FECHA</th>
									<th>HORA</th>
									<th>RECIBE</th>
									<th>REMITENTE</th>
									<th>JUZGADO</th>
									<th>RUTA ARCHIVO</th>
									<th>ESTADO</th>
									<th>-</th>
								</tr>
							</thead>
							<tbody>
								<tr>
								<?php $i=2; while($row = $datosdocumentosentrantes->fetch()){ ?>
								<td width="115 !important"><?php echo $row[numero];?></td>
								<td width="77 !important">
									<?php if ($row[sal_id_estado] == 1) {
										$estado='Registrado';
									} if ($row[sal_id_estado] == 2) {
										$estado='En tramite OGS';
									} if ($row[sal_id_estado] == 3) {
										$estado='Resuelto';
									} if ($row[sal_id_estado] == 4) {
										$estado='Cancelado';
									}
									if ($row[sal_id_estado] >= 1) {
									?>
										<a class="editare" href="/centro_servicios2/index.php?controller=sidoju&action=Documento_Entrante_Juzgado_Salud_Ver&id=<?php echo $row['id'];?>"><?php echo $estado; ?></a>
									<?php } else { ?>
										-
									<?php } ?>
								</td>
								<td width="76 !important"><?php echo $row[nombre_tipo_documento];?></td>
								<td><?php $newtext = wordwrap($row[nfc], 20, "\n", true); echo $newtext;?></td>
								<td><?php echo $row[fecha];?></td>
								<td><?php echo $row[hora];?></td>
								<td><?php echo $row[empleado];?></td>
								<td><?php echo $row[remitente];?></td>
								<td><?php echo $row[nombre];?></td>
								<td width="85 !important">
								<?php if($row[sal_id_externo_fk] ==null) { ?>
									<a href="javascript:void(0);" title="Desacargar Archivo" data-ruta="<?php echo $row['rutaarchivo'];?>" style="color:#0000FF" onclick="document.location='<?php echo $row['rutaarchivo'];?>'"><?php $newtext = wordwrap($row[rutaarchivo], 20, "\n", true); echo $newtext;?></a>
									<?php } if($row[sal_id_externo_fk] >=1) {  ?>
										<a href="ftp://192.168.89.28/<?php echo $row['rutaarchivo'];?>" title="Desacargar Archivo" style="color:#0000FF">
											<?php $newtext = wordwrap($row[rutaarchivo], 20, "\n", true); echo $newtext;?></a>
								<?php } ?>
								</td>
									<?php
										if ($row[chk] == 0) {
											echo "<td bgcolor='#CDE3F9'><b>"."No Aprobado"."</b>";
										} else if ($row[chk] == 1){
											if ($row[fecha] < '2020-07-01'){
												echo "<td bgcolor='#d4edda'><b>"."Aprobado"."</b>";
											} else{
												echo "<td bgcolor='#fff3cd'><b>"."Pendiente"."</b>";
											}
										} else if ($row[chk] == 2){
											echo "<td bgcolor='#d4edda'><b>"."Aprobado"."</b>";
										}
									?>
								</td>
								<td>
									<?php if (in_array($_SESSION['idUsuario'],$usuariosa)) { ?>
									-
									<?php } else { ?>

										<?php if($row[chk] == 0 AND $row[sal_id_externo_fk] ==null) { ?>
												<a class="editare" href="javascript:void(0);" data-id="<?php echo $row['id'];?>"><img src="views/images/modficar.jpg" width="35" height="35" title="EDITAR DOCUMENTO"/></a>

										<?php } if($row[chk] == 0 AND $row[sal_id_externo_fk] >=1) {  ?>

											<a class="editare" href="/centro_servicios2/index.php?controller=sidoju&action=Editar_documento_Entrante_Juzgado_Salud&id=<?php echo $row['id'];?>"><img src="views/images/modficar.jpg" width="35" height="35" title="EDITAR DOCUMENTO"/></a>

										<?php } ?>
									<?php } ?>
								</td>
							</tr>
						<?php  $i=$i+1; } ?>
					</tbody>
				</table>
			</td>
		</tr>
	</table>
	<?php
	}
	?>
	<?php require 'alertas.php';?>
</body>
</html>
