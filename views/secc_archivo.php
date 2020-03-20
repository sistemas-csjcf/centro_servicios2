<?php
    session_start();
    $id_usuario = $_SESSION['idUsuario'];
    require_once 'models/signotModel.php';
    $modelo       = new signotModel();
    
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '27';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
?>
<div id="contentSecc_archivo">
	<ul id="menusec">
		<li><a href="index.php?controller=menu&amp;action=mod_archivo">Home</a></li>
		<div id="sep">|</div>
		<li>
			<a href="#">Seguimiento</a>
			<ul class="submenu">
				<li><a href="index.php?controller=archivo&amp;action=regseguimiento">Registrar Seguimiento</a></li>
				<li><a href="index.php?controller=archivo&amp;action=listarSeguimientos">Listar Seguimientos</a></li>
				<li><a href="index.php?controller=archivo&amp;action=regGestion">Registrar Informe gesti&oacute;n</a></li>
				<li><a href="index.php?controller=archivo&amp;action=consultarGestion">Consultar Informe gesti&oacute;n</a></li>
				<li><a href="index.php?controller=archivo&amp;action=modificarGestion">Modificar Informe gesti&oacute;n</a></li>
			</ul>
		</li>
		<div id="sep">|</div>
		<li><a href="#">Inventario</a>
			<ul class="submenu">
				<li><a href="index.php?controller=archivo&amp;action=regRecibidoInventario">Registrar Acta Recibido</a></li>
				<li><a href="index.php?controller=archivo&amp;action=listRecibidoInventario">Listar Acta Recibido</a></li>
				<li><a href="index.php?controller=archivo&amp;action=listEntregaInventario">Listar Acta Entrega</a></li>
			</ul>
		</li>
		<div id="sep">|</div>
		<li>
			<a href="#">Reportes</a>
			<ul class="submenu">
				<li><a href="index.php?controller=archivo&amp;action=ReporteProduccionDiaria">Producci&oacute;n Diaria</a></li>
				<li><a href="index.php?controller=archivo&amp;action=ReporteProduccionRango">Producci&oacute;n Rango de Fechas</a></li>
				<li><a href="index.php?controller=archivo&amp;action=ReporteProduccionJuzgado&nombre=1">Producci&oacute;n Juzgados</a></li>
				<li><a href="index.php?controller=archivo&amp;action=ReporteEntrantesSalientes&nombre=1">Entrantes vs Salientes</a></li>
				<li><a href="index.php?controller=archivo&amp;action=ReporteEntrantesSalientesTodos">Entrantes vs Salientes Todos</a></li>
			</ul>
		</li>
		<div id="sep"></div>
		<div id="sep">|</div>
			<li><a href="migracion">Migraci&oacute;n</a></li>
		<div id="sep">|</div>
		
		<?php if ( in_array($_SESSION['idUsuario'],$usuariosa) ) { ?>
            <li><a href="Prestamo_Proceso" target="_blank">Prestamo Proceso</a></li>
        <?php }else { ?>
            <li><a href="#" onclick="bloqueado_window()">Prestamo Proceso</a></li>
        <?php } ?>
	</ul>
</div>