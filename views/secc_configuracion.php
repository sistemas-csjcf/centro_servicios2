<?php
	//require 'models/userModel.php';
	$modelo = new userModel();

	$campos               = 'usuario';
	$nombrelista          = 'pa_usuario_acciones';
	$idaccion			  = '14';
	$campoordenar         = 'id';
	$datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuarios             = $datosusuarioacciones->fetch();
	$usuariosa			  = explode("////",$usuarios[usuario]);
?>
<div id="contentSecc_conf">
    <div id="menusec">
        <li><a href="index.php?controller=user&amp;action=update_user">Modificar Datos</a></li>
            <div id="sep">|</div>
        <li><a href="index.php?controller=user&amp;action=passwr_user">Cambio de Contrase&ntilde;a</a></li>
            <div id="sep">|</div>
        <li><a href="index.php?controller=user&amp;action=photou_user">Cambio de Foto</a></li>
            <div id="sep">|</div>
		<?php if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {//if ($_SESSION['tipo_perfil']=='admin'){?>
			<li><a href="index.php?controller=user&amp;action=gestionar">Gestionar Sistema</a></li>
		<?php }?>
		<?php if($_SESSION['idperfil'] == 22){ ?>
			<li><a href="assets/media/Manual usuario Despacho.pdf" target="_blank">Descargar Manual</a></li>
		<?php } ?>
  </div>
</div>