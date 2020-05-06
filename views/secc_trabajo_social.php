<?php 
    session_start();
    $id_user        = $_SESSION['idUsuario'];
    $id_user_perfil = $_SESSION['idperfil'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo               = new trabajo_social_Model();
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '20';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
?>
<div id="contentSecc_trabajo_social">
    <ul id="menusec">
        <li><a href="index.php?controller=menu&amp;action=mod_trabajo_social">Home</a></li>
        <div id="sep">|</div>
        <?php if ( in_array($_SESSION['idUsuario'],$usuariosa) ) { ?>
            <li>
                <a href= "trabajo_social" target="_blank" >Visitas</a>
            </li>
        <?php }else if($id_user_perfil ==21){ ?>
            <li>
                <a href= "trabajo_social/?c=Visitas&a=Visitas_TS" target="_blank" >Visitas</a>
            </li>
		 <?php }else if($id_user_perfil ==22){ ?>
            <li>
                <a href= "trabajo_social/?c=Visitas&a=H_Visitas_Despacho" target="_blank" >Visitas</a>
            </li>
        <?php }else{ ?>
            <li>
                <a href= "trabajo_social/?c=Visitas&a=H_Visitas" target="_blank" >Visitas</a>
            </li>
        <?php } ?>
        <div id="sep">|</div>
		<li><a href= "trabajo_social/?c=Visitas&a=videoTutorial" target="_blank" >Video Tutorial</a></li>
    </ul>
</div>