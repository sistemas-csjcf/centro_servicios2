<?php
    session_start();
    $id_user_perfil = $_SESSION['idperfil'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo               = new Visita();
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '20';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Trabajo Social</title>
        <meta charset="utf-8" />
        <link rel="shortcut icon" href="assets/imagenes/logo.png" />
        <!--   **********     Diseño plantilla  ***********  -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.js" />
<!--        <script src="assets/js/jquery-ui/jquery-ui.js"></script>-->
        <!--        funciones creadas Juan Esteban Múnera Betancur -->
        <link rel="stylesheet" href="assets/css/styleFonts.css"><!--iconos-->
        <script src="assets/js/app/jquery-1.11.2.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script language="JavaScript">
            //////////F12 inhabilitado////////////////////////
            document.onkeypress = function (event) {
                event = (event || window.event);
                if (event.keyCode == 123) {
                    //alert('No F-12');
                    return false;
                }
            }
            document.onmousedown = function (event) {
                event = (event || window.event);
                if (event.keyCode == 123) {
                    //alert('No F-keys');
                    return false;
                }
            }
            document.onkeydown = function (event) {
                event = (event || window.event);
                if (event.keyCode == 123) {
                    //alert('No F-keys');
                    return false;
                }
            }
        </script>
    </head>
    <body>
    <!--<body ncontextmenu="return false"> -->
        <div class="container">
            <div class="jumbotron">
                <div class="row">
                    <div class="col-xs-6 col-md-4">
                        <img src="assets/imagenes/logo.png" class="img-responsive" alt="Centro Servicios Civil - Familia" style="width: 130px;">    
                    </div>
                    <div class="col-xs-6 col-md-8">
                        <h1 class="page-header">Visitas Trabajo Social</h1>
                    </div>
                </div>
            </div>
            <video  height="600" autoplay id="video" title="Video Tutorial ">
                <source src="assets/media/video/tutorial.mp4" type="video/mp4">
            </video>
            <center>
                <button id="rew" onclick="skip(-10)" class="btn-lg btn-default"><i class="fa fa-backward fa-2x" aria-hidden="true"></i></button>
                <button onclick="Stop();" class="btn-lg btn-default"><i class="fa fa-stop fa-2x"></i></button>
                <button onclick="playPause();" class="btn-lg btn-default"><i class="fa fa-play fa-2x"></i></button>
                <button onclick="Pause();" class="btn-lg btn-default"><i class="fa fa-pause fa-2x"></i></button>
                <button id="fastFwd" onclick="skip(10)" class="btn-lg btn-default"><i class="fa fa-forward fa-2x" aria-hidden="true"></i></button>
            </center>
            <script>
                var myVideo = document.getElementById("video");
                function playPause() { 
                    myVideo.play(); 
                };
                function Pause(){
                    myVideo.pause(); 
                };
                function skip(value) {
                    var video = document.getElementById("video");
                    video.currentTime += value;
                };
                function Stop(){
                    var video = document.getElementById("video");
                    video.currentTime = 0;
                    video.pause();
                };
            </script>