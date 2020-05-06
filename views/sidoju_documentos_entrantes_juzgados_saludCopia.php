<?php
include("/../libs/conexion2.php"); //Centro de Servicios
	$idusuario   = $_SESSION['idUsuario'];
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	$titulo     = "Incidente de Desacato en Salud - Registro Documentos Entrantes Juzgados";
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
	
	$nombrelista  = 'pa_juzgado';
	$campoordenar = 'id';
	$datosjuzgadodestino = $modelo->get_lista($nombrelista,$campoordenar);

	$nombrelista  = 'pa_year';
	$campoordenar = 'year';
	$formaordenar = 'DESC';
	$datosyear    = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	
	if(!empty($datosdocumento)) {
		$vbton  = "Actualizar";
		while($fila = $datosdocumento->fetch()) {
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
		}
	}
	/*if ($_POST['action'] == "adicionar") {
    } */
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
	<script language="JavaScript" type="text/javascript" src="views/js/ajax/funciones_jestRadicado.js"></script>                 	
	<link href="views/css/main.css" rel="stylesheet" type="text/css">
	<script src="views/js/ajax/ajax_sidoju.js" type="text/javascript" charset="utf-8"></script>
	
	<!-- PARA LAS VENTANAS EMERGENTES POPUPBOX -->
	<link href="views/css/stylepopupbox.css" rel="stylesheet" type="text/css">
	<script type="text/javascript">
		$(document).ready(function(){
			$("#tipodocumento").change(function(){
				if ( $("#tipodocumento option:selected").val() != '1'){
					window.location = '/centro_servicios2/index.php?controller=sidoju&action=Registro_Documentos_Entrantes_Juzgados';
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
			//imagen principal TEMIS, y iconos volver al menu principal y cerrar sesion 
			require 'header.php';
			//menus, con imagen del modulo
			require 'secc_sidoju.php';
		?>
		<table border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
	    		<td>
					<!-- NOTA: LOS ID DE LOS CAMPOS ME DAN LOS ESTILOS, UBICADOS EN centro_servicios\views\css\main.css
					TENIENDO EN CUENTA EL ID DE LA TABLA DONDE SE ENCUENTRAN LOS CAMPOS EN ESTE CASO frm_editar
					LA class="" ME PERMITE VALIDAR UN CAMPO CON JQUERY
					EN action="" NO ENVIO NADA YA QUE ESTE LLAMADO SE REALIZA EN require 'secc_sigdoc.php';
					IGUAL FUNCIONA SI SE DEFINE ALGUNA ACCION-->
					<div id="contenido">
						<form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
							<input name="iddocumento" id="iddocumento" type="hidden" readonly="true"  value="<?php echo $d0; ?>">
							<!-- <input name="consecutivodocumento" id="consecutivodocumento" type="hidden" readonly="true"/> -->
							<input name="iduser" id="iduser" type="hidden" readonly="true"  value="<?php echo $idusuario; ?>">
						 	<div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>
							<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
								<?php
									/*while($row = $datostipodocumento->fetch()){
										echo $row[id];
									}*/
								?>
								<tr>
									<td>
										<label style="width:151px; color:#666666">Fecha:</label>
									</td>
									<td>
										<input type="text" name="fechae" id="fechae" value="<?php echo $fechaactual; ?>" readonly="true">
									</td>
								</tr>
								<tr>
									<td>
										<label style="width:151px; color:#666666">Hora:</label>
									</td>
									<td>
										<input type="hidden" name="horae" id="horae" value="<?php echo $horaactual; ?>" readonly="true">
										<input type="text" name="horaespejo" id="horaespejo" value="<?php echo $horaactualespejo; ?>" readonly="true">
									</td>
								</tr>
								<tr>
									<td>
										<label style="width:151px; color:#666666">Tipo Documento:</label>
									</td>
									<td>
										<select name="tipodocumento" id="tipodocumento" class="required">
											<option value="" selected="selected">Seleccionar Tipo Documento</option>
											<option value="7">Asunto de tutela</option>
											<option value="100">Circular</option>
											<option value="3">Despacho Comisorio</option>
											<option value="8">Expedientes</option>
											<option value="6">Extracto Bancario</option>
											<option value="5">Memorial</option>
											<option value="2">Oficio</option>
											<option value="4">Otro</option>
											<option value="9">Tutela Corte Constitucional</option>
											<option value="1" selected="true">Incidente de Desacato en Salud</option>
										</select>
									</td>
								</tr>
								<tr>
								<td>
									<label style="width:151px; color:#666666">A&#241;o:</label>
								</td>
								<td>
									<select name="year" id="year" class="required">
										<option value="" selected="selected">Seleccionar A&#241;o</option> 
										<?php
											while($row = $datosyear->fetch()){
											
												if($row[year] == $d4){
													echo "<option value=\"". $row[year] ."\" selected='selected'>" . $row[year] . "</option>";
												}
												else{
													echo "<option value=\"". $row[year] ."\">" . $row[year] . "</option>";
												}
											}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label style="width:151px; color:#666666">Consecutivo (tres car&aacute;cteres):</label>
								</td>
								<td>
									<input type="text" name="consecutivo" id="consecutivo" size="8" maxlength="3" minlength="3" class="required number" value="<?php echo $d3; ?>"/>
								</td>
							</tr>
							<tr>
								<td>
									<label style="width:151px; color:#666666">Instancia:</label>
								</td>
								<td><label>
								  <select name="instancia" id="instancia" class="required">
									<option option value="">Seleccionar Instancia</option>
									<option value="00">00</option>
								  </select>
								</label></td>
						 	</tr>
							<tr>
								<td>
									<label style="width:151px; color:#666666">Juzgado:</label>
								</td>
								<td>
									<?php
								        $res = "SELECT pa_juzgado.id, pa_juzgado.idarea, pa_juzgado.numero_juzgado,pa_juzgado.nombre, pa_usuario.empleado FROM pa_juzgado INNER JOIN pa_usuario ON pa_juzgado.idusuariojuzgado=pa_usuario.id";
								        $res = mysql_query($res);
								    ?>
									<select id="juzgadodestino" name="juzgadodestino" onchange='autocompletar(this.value);' class="required">
							            <option value="" selected="selected">Seleccionar Juzgado Destino</option> 
							            <?php
							                while($fila=mysql_fetch_array($res)){
							            ?>
							                <option value="<?php echo $fila[id].'-'.$fila[idarea].'-'.$fila[numero_juzgado].'-'.$fila[empleado]; ?>"><?php echo $fila[nombre]; ?></option>
							            <?php
							                }
							            ?>
							        </select>
							        <tr>
					                    <td>
					                        <label style="width:151px; color:#666666">Empleado:</label>
					                    </td>
					                    <td>
					                        <input type="text" id="nombreusuariojuzgado" readonly>
					                    </td>
					                </tr>
								</td>
							</tr>
							<!-- <tr>
								<td>
									<label style="width:151px; color:#666666">Radicado2:</label>
								</td>
								USO maxlength="23" minlength="23" PARA QUE EL DATO DEL RADICADO ESTE CONFORMADO POR 23 CARACTERES
								Y SEA VALIDADO POR LA LIBRERIA jquery.validate
								<td>
									<input type="text" name="radicadox" id="radicadox" class="required" maxlength="23" minlength="23" readonly="true" value="<?php //echo $d3; ?>"/>
								</td>
							</tr>-->
								<tr>
									<td valign="top">
										<label style="width:151px; color:#666666">Radicado:</label>
									</td>
									<td>
										<input type="text" name="txt_radicado" id="txt_radicado" onkeyup="validarSiNumero(this.value)" value="" placeholder="Ingrese radicado completo (23 digitos)" class="required"  minlength="23" maxlength="23"/>
											<form method="post" action="<?=$_SERVER['PHP_SELF']?>">
												<button type="button" class="btn btn-info" id="btn_consultar" onclick="buscar_radi()"  name="escuchar" value="Escuchar">Consultar</button>
									    	</form>
									    <div id="load" style="display: none">
									        <div class="progress" >
									            <div id="bar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
									                <span class="sr-only">10% Complete</span>
									            </div>
									        </div>
									    </div>
									    <div id="resultado"></div>
									    <div id="sinresultado"></div>
									</td>
								</tr>
								<!--<tr>
									<td>
										<label style="width:151px; color:#666666">Remitente:</label>
									</td>
									<td>
										<input type="text" name="remitente" id="remitente" class="required" value="<?php echo $d3; ?>" maxlength="155"/>
									</td>
								</tr>
								<tr>
									<td>
										<label style="width:151px; color:#666666">N&#250;mero Documento:</label>
									</td>
									<td>
										<input type="text" name="numerodoce" id="numerodoce" class="" value="<?php echo $d5; ?>" class="required"/>
									</td>
								</tr>
								<tr>
									<td>
										<label style="width:151px; color:#666666">Nombre/Folios/Cuadernos:</label>
									</td>
									<td>
										<input type="text" name="nfc" id="nfc" value="<?php echo $d6; ?>" class="required"/>
									</td>
								</tr>
								<tr>
									<td>
										<label style="width:151px; color:#666666">Juzgado Destino:</label>
									</td>
									<td>
										<select name="juzgadodestino" id="juzgadodestino"  class="required">
											<option value="" selected="selected">Seleccionar Juzgado Destino</option> 
											<?php
												while($row = $datosjuzgadodestino->fetch()){
													if($row[id] == $d7){
														echo "<option value=\"". $row[id]."-".$row[nombre] ."\" selected='selected'>" . $row[nombre] . "</option>";
													}
													else{
														echo "<option value=\"". $row[id]."-".$row[nombre] ."\">" . $row[nombre] . "</option>";
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
										<input name="nombreusuariojuzgado" id="nombreusuariojuzgado" type="text"  class="" readonly="true" value="<?php echo utf8_decode($d8b); ?>">
									</td>
								</tr>
								<tr>
									<td>
										<label style="width:151px; color:#666666">Archivo</label>
									</td>
									<td>
										<input type="file" name="archivo" id="archivo" title="Archivo" class="required"/>
									</td>
								</tr>
								<tr>
									<td>
										<div id="ok"></div>
									</td>
								</tr>
								<tr>
									<td colspan="2">-->
										<!-- SE PREGUNTA SI LA VARIABLE $vbton NO ES VACIA, YA QUE ESTO NOS INDICA QUE VAMOS A ACTUALIZAR UN DOCUMENTO
										Y POR ENDE EL VALOR PASA A Actualizar-->
										<!--<center>
											<input type="submit" name="Submit" value="<?php //if(empty($vbton)){ echo "Registrar";}else{echo "Actualizar";} ?>" id="btn_input"/>
											<input type="hidden" name="action" value="adicionar" />-->
											<!-- <input type="submit" name="Submit" value="<?php //if(empty($vbton)){ echo "Registrar";}else{echo "Actualizar";} ?>" id="btn_input" class="btn_validardj"/> -->
											<!--<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>-->
										<!--</center>
									</td>
							  	</tr>-->
							</table>
						</form>
						<script type="text/javascript">
			            $(document).ready(function(){
			                $("#frm").submit(function(){
			                    return $(this).validate();
			                });
			            });

			            function validarSiNumero(radicado){
			                radicado = (radicado) ? radicado : window.event
			                var charCode = (radicado.which) ? radicado.which : radicado.keyCode
			                if (!/^([0-9])*$/.test(radicado) ){
			                    alert("Por favor ingrese solo números");
			                    document.getElementById("btn_consultar").disabled=true;
			                }else{
			                    document.getElementById("btn_consultar").disabled=false;
			                }
			            }
			        </script>
					</div>
				</td>
			</tr>
		</table>

		<script type="text/javascript">
		   function autocompletar(inputSelect) {
		      var valor    = inputSelect.split("-");
		      var idj   = valor[0];
		      var usuario = valor[3];
		         /* Para obtener la lista de valores */
		         var lista = document.getElementById("juzgadodestino").value;
		         /* Para obtener los texto(s) */
		         var combo = document.getElementById("juzgadodestino");
		         var selected = combo.options[combo.selectedIndex].text;
		         with (document.forms["frm"]) {
		            id.value   = idj;
		            nombreusuariojuzgado.value = usuario;
		         }
		   }
		</script>
	<?php require 'alertas.php';?>
	</body>
</html>
