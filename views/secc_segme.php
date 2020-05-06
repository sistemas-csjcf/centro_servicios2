<?php 
    session_start();
    $id_user        = $_SESSION['idUsuario'];
    $id_user_perfil = $_SESSION['idperfil'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo               = new Segme_Model();
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '28';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios['usuario']);
    
    
    $idaccion           = '33';
    $datos_us_accion    = $modelo->get_lista_usuario_accionesJE($idaccion);
    $us_privilegios     = $datos_us_accion->fetch();
    $usuarioAD          = explode("////",$us_privilegios[usuario]);

    $idaccion           = '34';
    $datos_us_accion    = $modelo->get_lista_usuario_accionesJE($idaccion);
    $us_lider_MC        = $datos_us_accion->fetch();
    $usuario_lider_mc   = explode("////",$us_lider_MC[usuario]);

    $idaccion           = '13';
    $datos_us_accion    = $modelo->get_lista_usuario_accionesJE($idaccion);
    $us_despacho        = $datos_us_accion->fetch();
    $usuario_despacho   = explode("////",$us_despacho[usuario]);
?>
<div id="contentSecc_segme">
    <ul id="menusec">
        <?php if ( in_array($_SESSION['idUsuario'],$usuariosa) ) { ?>
        <li><a href="#">Home</a></li>
        <div id="sep">|</div>
        <?php }else if($_SESSION['idperfil'] !=22){ ?> 
            
            
        <?php } ?>
        <?php 
            if($_SESSION['idperfil'] == 22){
                // ------ DESPACHO MC ------
                $ref="mejora_continua?c=Mejora_C&a=consultar_lista_tareas_despacho";
            }else if( in_array($_SESSION['idUsuario'],$usuarioAD) ){
                // ------- ADMIN MC --------
                $ref="mejora_continua?c=Mejora_C&a=Mis_tareasAD";
            }else{
                $ref="mejora_continua?c=Mejora_C&a=Mis_tareas_us";
            }
        ?>
        <li><a href="<?php echo $ref; ?>" target="_blank">Mejora Continua</a></li>
		<div id="sep">|</div> 
		<li><a href="http://172.16.175.124/incidentes/" target="_blank">Reporte de Incidentes</a></li>
        <div id="sep">|</div> 
    </ul>
</div>



<!--
<div id="contentSecc_segme">
    <ul id="menusec">
        <?php if ( in_array($_SESSION['idUsuario'],$usuariosa) ) { ?>
        <li><a href="index.php?controller=menu&amp;action=mod_sigdoc">Home</a></li>
        <div id="sep">|</div>
            <li><a href="talento_humano" target="_blank">Talento Humano</a></li>
            <div id="sep">|</div>
        <?php }else if($_SESSION['idperfil'] !=22){ ?> 
            <li><a href="talento_humano?c=hoja_vida&a=Personal" target="_blank">Talento Humano</a></li>
            <div id="sep">|</div>
        <?php } ?>
        <?php 
            if($_SESSION['idperfil'] == 22){
                // ------ DESPACHO MC ------
                $ref="mejora_continua?c=Mejora_C&a=consultar_lista_tareas_despacho";
            }else if( in_array($_SESSION['idUsuario'],$usuarioAD) ){
                // ------- ADMIN MC --------
                $ref="mejora_continua?c=Mejora_C&a=Mis_tareasAD";
            }else{
                $ref="mejora_continua?c=Mejora_C&a=Mis_tareas_us";
            }
        ?>
        <li><a href="<?php echo $ref; ?>" target="_blank">Mejora Continua</a></li>
        <div id="sep">|</div> 
    </ul>
</div>