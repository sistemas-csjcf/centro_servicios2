<?php 
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	//TITULO FORMULARIO
	$titulo     = "MODIFICAR DIRECCI&#211;N";
	$subtitulo  = "DIRECCIONES PARTE";
	//$subtitulo2 = "Permisos Usuario";
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new signotModel();
	
	//OBTENEMOS LA FECHA ACTUAL
	//$fechaactual = $modelo->get_fecha_actual_amd();
	//OBTENEMOS LA HOAR ACTUAL
	//$horaactual        = $modelo->get_hora_actual_24horas();
	//SOLO PARA VISUALIZACION DEL USUARIO, REALMENTE EL QUE SE REGISTRA EN LA BASE DE DATOS ES $horaactual
	//$horaactualespejo  = $modelo->get_hora_actual_12horas();
	
	
	//OBTENEMOS LISTADO SEGUN LA LISTA SOLICITADA
	$nombrelista  = 'signot_pa_departamento';
	$campoordenar = 'descripcion';
	$formaordenar = '';
	$datosdepartamento = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);

	$dx1 = trim($_GET['dx1']);
	
	if(!empty($dx1)){
	
		//$vbton  = "Actualizar";
		 
		 //sp.id AS idparte,sd.id,sp.cedula,sp.nombre,sd.telefono,sd.direccion,sd.iddepartamento,sd.idmunicipio
		 
		$datosdireccion = $modelo->get_direcciones($dx1);
	
		while($fila = $datosdireccion->fetch()){
			
			$d0  = $fila[cedula];
			
			//$titulo = "Modificar Documentos Entrantes Juzgados, Id: ".$d0;
			
			$d1  = $fila[nombre];
			$d2  = $fila[telefono];
			$d3  = $fila[direccion];
			$d4  = $fila[iddepartamento];
			$d5  = $fila[idmunicipio];
			
			
			$nombrelista  = 'signot_pa_municipio';
			$campoordenar = 'descripcion';
			$filtro       = 'WHERE Cod_Departamento_Municipio = '.$d4;
			$formaordenar = '';
			$datosmunicipio = $modelo->get_lista_filtro($nombrelista,$campoordenar,$filtro,$formaordenar);

			
			
			//envio el id del juzgado para saber cual es el funcionario asignado a el
			//y cargar el campo empleado
			//$d8  = $modelo->get_nombre_usuario_juzgado($d7);
			//$row = $d8->fetch();
			//$d8b = $row[empleado];
			
		}
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/> 
<!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>  -->
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

<!-- -------------------------------------------------------------------- -->
<script src="views/js/jquery.js" type="text/javascript"></script>
<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
<script src="views/js/jquery.validate.js" type="text/javascript"></script>
<script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                    	
<link href="views/css/pepper-grinder/ui.all.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
<link href="views/css/main.css" rel="stylesheet" type="text/css">

<!-- -------------------------------------------------------------------- -->

<!-- USO DE ARCHVIO PARA VALIDACIONES DE CAMPOS Y APLICACION DE FUNCIONES -->
<script src="views/js/ajax/ajax_signot.js" type="text/javascript" charset="utf-8"></script>

<!-- PARA MANEJAR LOS ESTILOS DEL FORMULARIO 
<link href="views/css/main.css" rel="stylesheet" type="text/css">-->

<!-- PARA EL FUNCIONAMIENTO DE LAS TABLAS EN SU FILTRO Y PAGINACION
<script type="text/javascript" language="javascript" src="views/viewstablas/jquery.dataTables.js"></script> 
<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_page.css"/ >
<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_table.css"/ > -->

<!-- PARA LAS FECHAS -->
<script type="text/javascript" src="views/fechajquery/jquery.datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="views/fechajquery/jquery.datetimepicker.css"/ >

<!-- PARA LAS VENTANAS EMERGENTES POPUPBOX 
<script src="views/js/ajax/ajax_popupbox_empleados_registro_entrada_salida.js" type="text/javascript" charset="utf-8"></script>-->
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
	
	
	//PARA LAS FECHAS
	//$("#fechae").datepicker({ changeFirstDay: false	});
	
	
});

</script>	

 
</head>

<body>

	
	
	<?php 
		//imagen principal TEMIS, y iconos volver al menu principal y cerrar sesion 
		require 'header.php';
		//menus, con imagen del modulo
		require 'secc_signot.php';
		
	?>			
	
	<table border="0" cellspacing="0" cellpadding="0" align="center">
  		
		<tr>
    		<td></td>
  		</tr>
		
		<tr>
    		<td>
				<!-- NOTA: LOS ID DE LOS CAMPOS ME DAN LOS ESTILOS, UBICADOS EN centro_servicios\views\css\main.css
				TENIENDO EN CUENTA EL ID DE LA TABLA DONDE SE ENCUENTRAN LOS CAMPOS EN ESTE CASO frm_editar
				LA class="required" ME PERMITE VALIDAR UN CAMPO CON JQUERY
				EN action="" NO ENVIO NADA YA QUE ESTE LLAMADO SE REALIZA EN require 'secc_sigdoc.php';
				IGUAL FUNCIONA SI SE DEFINE ALGUNA ACCION-->
				<div id="contenido">
				
					<form id="frm4x" name="frm4x" method="post" enctype="multipart/form-data" action="">
			
						
					 	<div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>
						
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
						
							<tr>
								<td>
									<label style="width:151px; color:#666666">Id Direcci&#243;n:</label>
								</td>
								
								<td>
									<input type="text" name="iddireccionx" id="iddireccionx" class="required" size="3" readonly="true" style="text-align:right" value="<?php echo trim($_GET['dx1']); ?>"/>
								</td>
								
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Documento:</label>
								</td>
								
								<td>
									<input type="text" name="documentox" id="documentox" class="required" readonly="true" value="<?php echo trim($d0); ?>"/>
								</td>
								
							</tr>
							
						
							<tr>
								<td>
									<label style="width:151px; color:#666666">Nombre:</label>
								</td>
								
								<td>
									<input type="text" name="nombrex" id="nombrex" class="required" readonly="true" value="<?php echo trim($d1); ?>"/>
								</td>
								
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Tel&#233;fono:</label>
								</td>
								<td>
									<input type="text" name="telefonox" id="telefonox" class="required" value="<?php echo trim($d2); ?>"/>
								</td>
							</tr>
							<tr>
								<td>
									<label style="width:151px; color:#666666">Direcci&#243;n:</label>
								</td>
								<td>
									<input type="text" name="direccionx" id="direccionx" class="required" value="<?php echo trim($d3); ?>"/>
								</td>
							</tr>
							<tr>
								<td>
									<label style="width:151px; color:#666666">Departamento:</label>
								</td>		
								<td>
									<select name="departamento" id="departamento" class="required">
										<option value="" selected="selected">Seleccionar Departamento</option> 
										<?php
											while($row = $datosdepartamento->fetch()){
												//echo "<option value=\"". $row[Cod_departamento] ."\">" . $row[descripcion] . "</option>";	
												if($row[Cod_departamento] == $d4){
													echo "<option value=\"". $row[Cod_departamento] ."\" selected='selected'>" . $row[descripcion] . "</option>";
												}
												else{
													echo "<option value=\"". $row[Cod_departamento] ."\">" . $row[descripcion] . "</option>";
												}				
											}
										?>
									</select>
								</td>			
							</tr>
							<tr>
								<td>
									<label style="width:151px; color:#666666">Municipio:</label>
								</td>		
								<td>
									<select name="municipio" id="municipio" class="required">
										<option value="" selected="selected">Seleccionar Municipio</option> 
										<?php
											while($row = $datosmunicipio->fetch()){
												//echo "<option value=\"". $row[cod_departamento] ."\">" . $row[descripcion] . "</option>";			
												if($row[Cod_Municipio] == $d5){
													echo "<option value=\"". $row[Cod_Municipio] ."\" selected='selected'>" . $row[descripcion] . "</option>";
												}
												else{
													echo "<option value=\"". $row[Cod_Municipio] ."\">" . $row[descripcion] . "</option>";
												}	
											}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div id="ok"></div>
								</td>
							</tr>
							<!-- -----------------------------BOTONES--------------------------------------------------------- -->
							<tr>
								<td colspan="2"> 
									<!-- SE PREGUNTA SI LA VARIABLE $vbton NO ES VACIA, YA QUE ESTO NOS INDICA QUE VAMOS A ACTUALIZAR UN DOCUMENTO
									Y POR ENDE EL VALOR PASA A Actualizar-->
									<center>
										<input type="submit" name="Submit" value="<?php if(empty($vbton)){ echo "Registrar";}else{echo "Actualizar";} ?>" id="btn_input" class="btn_validar4"/>
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