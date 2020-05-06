<?php
    require 'bloqueo_procesos/model/proceso_model.php';
    $modelo               = new Proceso();
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '18';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
    // privilegios Tutela
    $idaccion       = '31';
    $datosus_tutela = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $us_tutela      = $datosus_tutela->fetch();
    $us_tutelaa     = explode("////",$us_tutela[usuario]);
    //$user                 = $_SESSION['idUsuario'];
    //echo $_SESSION['idperfil'];
    $idaccionENC              = '36';
    $datosusuarioaccionesEncu = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccionENC,$campoordenar);
    $usuarios_encu            = $datosusuarioaccionesEncu->fetch();
    $usuariosEncu             = explode("////",$usuarios_encu[usuario]);

     //NEW SEARCH
    $idaccionSearch             = '38';
    $datosusuarioaccionesSearch = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccionSearch,$campoordenar);
    $usuarios_search            = $datosusuarioaccionesSearch->fetch();
    $usuariosNew_Search         = explode("////",$usuarios_search[usuario]);
?>
<div id="contentSecc_caratula">
    <ul id="menusec">
        <li><a href="index.php?controller=menu&amp;action=mod_caratula">Home</a></li>
        <div id="sep">|</div>
        <li>
            <a href="#">Caratulas</a>
            <ul class="submenu">
                <li><a href= "index.php?controller=caratula&amp;action=Caratula">Generar Caratula</a></li>
                <li><a href= "index.php?controller=caratula&amp;action=Caratula_tribunal">Generar Caratula Tribunal</a></li>
            </ul>
        </li>
        <div id="sep">|</div>
        <li>
            <a href="#">Procesos</a>
            <ul class="submenu">
                <?php if ( in_array($_SESSION['idUsuario'],$usuariosNew_Search) ) { ?>
                    <li><a href= "#" onclick="Abrir_ventana(1)" >Nueva Consulta</a></li>
                <?php } ?>
                <?php if ( in_array($_SESSION['idUsuario'],$usuariosa) ) { ?>
                    <li><a href= "#" onclick="abreelventanuco()" id="pasar_user">Ocultar Procesos</a></li>
                <?php } ?>
            </ul>
        </li>
        <div id="sep">|</div>
        <!--  privilegios tutela-->
        <?php if ( in_array($_SESSION['idUsuario'],$us_tutelaa) ) { ?>
            <?php 
                if($_SESSION['idperfil'] == 22){
                    $ruta="tutelas/?c=Tutela&a=Lista_MigrarD";
                }else if($_SESSION['idperfil'] == 1){
                    $ruta="tutelas/?c=Tutela&a=Lista_Migrar";
                }else{
                    $ruta="tutelas";
                }
            ?>
            <li><a href="<?php echo $ruta; ?>" target="_blank">Tutelas</a></li>
            <div id="sep">|</div>
        <?php } ?>
        <?php if ( in_array($_SESSION['idUsuario'],$usuariosEncu) ) { ?>
            <li><a href="encuesta_satisfacion?c=encuesta&a=Crud_encuesta" target="_blank">Encuesta Satisfaci&oacute;n</a></li>
            <div id="sep">|</div>
        <?php } ?>
    </ul>
</div>
<!--<a href="index.php?controller=index&amp;action=close_session" onclick="chapaelventanuco();"><input type="button" onclick="chapaelventanuco();">
    <img src="views/images/crm_exit.png" alt="Cerrar Sesion" title="Cerrar Sesion"/>
</a>-->
<script>
    var ventanuco = null;
    function abreelventanuco (){
        ventanuco = window.open ("bloqueo_procesos","about:blank");
    }
    function chapaelventanuco (){
        if (ventanuco != null && !ventanuco.isclosed){
            ventanuco.close();
            ventanuco = null;
        }
    };
    function Abrir_ventana(cod){
        if(cod == 1){
            window.open ("consulta_JXXI","about:blank");
        }
    };
</script>