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
	//Conexion Oficina Judicial
	include("/../libs/conexion3.php");
        $sql_a110consactu = ("SELECT MAX(a110consactu) AS consactu FROM [consejoPN].[dbo].[t110dractuproc];");
    	$stmt_actualizacion = sqlsrv_query($conn, $sql_a110consactu);
    	while($row = sqlsrv_fetch_array($stmt_actualizacion)){
            $consactu  = $row['consactu']+1;
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
	<script language="JavaScript" type="text/javascript" src="views/js/ajax/funciones_jestRadicado.js"></script>  <script language="JavaScript" type="text/javascript" src="views/js/ajax/funciones_jestAccionante.js"></script>               	
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
			require 'header.php';
			require 'secc_sidoju.php';
		?>
		<table border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
	    		<td>
					<div id="contenido">
						<form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
							<input name="iddocumento" id="iddocumento" type="hidden" readonly="true"  value="<?php echo $d0; ?>">
							<input name="txt_consactu" type="hidden" readonly="true" value="<?php echo $consactu; ?>">
							<input name="iduser" id="iduser" type="hidden" readonly="true"  value="<?php echo $idusuario; ?>">
						 	<div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>
							<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
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
									<input type="text" name="consecutivo" id="consecutivo" size="8" maxlength="3" minlength="3" class="number" value="<?php echo $d3; ?>"/>
								</td>
							</tr>
							<tr>
								<td>
									<label style="width:151px; color:#666666">Instancia:</label>
								</td>
								<td><label>
								  <select name="instancia" id="instancia">
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
									<select id="juzgadodestino" name="juzgadodestino" onchange='autocompletar(this.value);'>
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
