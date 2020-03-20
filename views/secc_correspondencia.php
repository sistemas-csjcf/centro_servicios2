<?php 
	// --------------- JUAN ESTEBAN MUNERA BETANCUR  ------------------------------
    //INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
    
	require_once 'models/correspondenciaModel.php';
    $modelo       = new correspondenciaModel();
    
    $jdatosusuarioacciones  = $modelo->permisos_item_usuario();
    $jusuarios              = $jdatosusuarioacciones->fetch();
    $jusuariosa             = explode("////",$jusuarios[usuario]);
	
	$subir_doc 				= $modelo->permisos_subir_doc_472();
    $jusuarios              = $subir_doc->fetch();
    $accion_subir_doc       = explode("////",$jusuarios[usuario]);

    $campos             = 'usuario';
    $nombrelista        = 'pa_usuario_acciones';
    $campoordenar       = 'id';
    $idaccionUSCS       = '37';
    $datosUSacciones    = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccionUSCS,$campoordenar);
    $usCS               = $datosUSacciones->fetch();
    $usuariosCS         = explode("////",$usCS[usuario]);
	
?>
<div id="contentSecc_correspondencia">
	<ul id="menusec">
		<li><a href="index.php?controller=menu&amp;action=mod_correspondencia">Home</a>  </li>
		<div id="sep">|</div>
		<?php  if ( in_array($_SESSION['idUsuario'],$jusuariosa) ){ ?>		
			<li><a href="index.php?controller=correspondencia&amp;action=listar_orden_servicio">Listar Orden Servicio</a></li>
		<?php }else{ ?>
		<li>
			<a href="#">Tutelas</a>
			<ul class="submenu">
				<li><a href="index.php?controller=correspondencia&amp;action=regcorrespondenciatutela">Registrar Tutela</a></li>
				<!--         <li><a href="index.php?controller=correspondencia&amp;action=listarCorrespondenciasTutelas">Listar Radicados Tutelas-Incidentes</a></li>
				<li><a href="index.php?controller=correspondencia&amp;action=listarActuaciones&nombre=1">Listar Actuaciones</a></li>-->
				<li><a href="index.php?controller=correspondencia&amp;action=filtrar_radicados">Listar Radicados Tutelas-Incidentes</a></li>
				<li><a href="index.php?controller=correspondencia&amp;action=filtrar_actuaciones">Listar Actuaciones</a></li>
				<li><a href="index.php?controller=correspondencia&amp;action=filtrar_partes">Listar Partes Tutelas</a></li>
				<li><a href="index.php?controller=correspondencia&amp;action=Asignar_Numero_Guia">Asignar Numero Guia</a></li>
			</ul>
		</li>
		<div id="sep">|</div>
		<li>
			<a href="#">Correspondencia</a>
			<ul class="submenu">
				<li><a href="index.php?controller=correspondencia&amp;action=regcorrespondenciaotro">Registrar Correspondencia Otro</a></li>
				<!--<li><a href="index.php?controller=correspondencia&amp;action=listarCorrespondencias">Listar Correspondencia Otros</a></li>-->
				<li><a href="index.php?controller=correspondencia&amp;action=filtrar_otros">Listar Correspondencia Otros</a></li>
			</ul>
		</li>
		<div id="sep">|</div>
		<li><a href="#">Turnos</a>
			<ul class="submenu">
				<li><a href="index.php?controller=correspondencia&amp;action=regTurno">Registrar Turno</a></li>
				<li><a href="index.php?controller=correspondencia&amp;action=filtrar_turnos">Listar Turnos</a></li>
			</ul>
		</li>
		<div id="sep">|</div>
        <li>
            <a href="#">Consolidado</a>
            <ul class="submenu">
                <?php if ( in_array($_SESSION['idUsuario'],$accion_subir_doc) ){ ?>
                    <li><a href="index.php?controller=correspondencia&amp;action=crear_consolidado&nombre=1">Subir Archivo</a></li>
                    <li><a href="index.php?controller=correspondencia&amp;action=listar_orden_servicio">Listar Orden Servicio</a></li>
                <?php } ?>
                <?php if ( in_array($_SESSION['idUsuario'],$usuariosCS) ) { ?>    
                    <li><a href="index.php?controller=correspondencia&amp;action=listar_orden_servicio">Listar Orden Servicio</a></li>
                <?php } ?> 
            </ul>
        </li>
		<div id="sep">|</div>
		<li>
			<a href="#">Reportes</a>
			<ul class="submenu">
				<li><a href="index.php?controller=correspondencia&amp;action=excel_472&nombre=1">Generar Plantilla 472</a></li>
				<li><a href="index.php?controller=correspondencia&amp;action=excel_472_2&nombre=1">FAX, Personal, Correo Electr&oacute;nico</a></li>
				<!--<li><a href="index.php?controller=correspondencia&amp;action=informeDireccion&nombre=1">Generar Informe Direcci&oacute;n</a></li>
					-->
				<li><a href="index.php?controller=correspondencia&amp;action=ReporteNotificacionIncidentes&nombre=2">Informe Notificaci&oacute;n e Incidentes</a></li>
			
				<?php  if ( in_array($_SESSION['idUsuario'],$accion_subir_doc) ){ ?>
					<li><a href="index.php?controller=correspondencia&amp;action=Consultar_reporte_direccion">Generar Informe Dirección</a></li>
					<li><a href="index.php?controller=correspondencia&amp;action=Consultar_estadistica_envios">Estadìstica Envios</a></li>
				<?php } ?>
			
				<!-- <li><a href="#">Generar Informe Dirección</a></li> -->

			</ul>
		</li>
		<?php } ?>
		<div id="sep"></div>
		<div id="sep">|</div>
	</ul>
</div>