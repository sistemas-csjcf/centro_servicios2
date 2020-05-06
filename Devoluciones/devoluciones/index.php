<?php
    session_start();
    $id_user_perfil = $_SESSION['idperfil'];
    $us = $_SESSION['idUsuario'];
    // JUAN ESTEBAN MUNERA BETANCUR
    require_once '../model/devolucion_model.php';
    $modelo               = new Devolucion();
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '25';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
    
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '26';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usAdmin_devoluciones           = explode("////",$usuarios[usuario]);
    
    if ( in_array($us,$usAdmin_devoluciones) ) {
        $filtro_us =" ";
        $flag=1;
    }else{
        $filtro_us =" AND anot.idusuario = '$us' ";
        $flag=0;
    }
    //echo "flag ".$flag;
    $datos_devPendientes  = $modelo->get_devoluciones_pendientes($filtro_us);
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Calendario Devoluciones SIGNOT</title>
        <meta name="description" content="Calendario Devoluciones, SIGNOT V. 1.0 2018 Juan Esteban Múnera Betancur">
        <link rel="stylesheet" href="../assets/css/styleFonts.css"><!--iconos-->
        <link rel="shortcut icon" href="../assets/imagenes/logo.png" />
        <meta charset="UTF-8">
        <link rel="stylesheet" href="components/bootstrap2/css/bootstrap.css">
        <link rel="stylesheet" href="components/bootstrap2/css/bootstrap-responsive.css">
        <link rel="stylesheet" href="css/calendar.css">
    </head>
<!--    <body oncontextmenu="return false">-->
    <body>
        <div class="container">
            <?php if ( in_array($_SESSION['idUsuario'],$usuariosa) ) { ?>
                <div class="hero-unit">
                    <h1>Calendario Devoluciones <i class="icon-calendar"></i></h1>
                    <p>SIGNOT</p>	
                </div>
                <div class="page-header">
                    <div class="pull-right form-inline">
                        <div class="btn-group">
                            <button class="btn btn-primary" data-calendar-nav="prev"><i class="icon-backward2"></i> Anterior</button>
                            <button class="btn" data-calendar-nav="today">Hoy</button>
                            <button class="btn btn-primary" data-calendar-nav="next">Siguiente <i class="icon-forward3"></i></button>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-warning" data-calendar-view="year">Año</button>
                            <button class="btn btn-warning active" data-calendar-view="month">Mes</button>
                        </div>
                    </div>
                    <h3></h3>
                    <small>Calendario Devoluciones</small>
                </div>
                <div class="row">
                    <div class="span11">
                        <div id="calendar"></div>
                    </div>
                    <div class="span1">
                        <div class="row-fluid"></div>
                        <h4>Devoluciones Pendientes</h4>
                        
                        <?php while ($rs = $datos_devPendientes->fetch()){ ?>
                            <small>
                                <strong>ID:</strong><?php echo $rs['id']; ?><br>
                                <strong>Fecha Devolución</strong><p style="color: red;"><?php echo $rs['fecha_devolucion'] ?></p>
                                <strong>Radicado:</strong><?php echo $rs['radicado']; ?><br>
                                <strong>Juzgado:</strong><?php echo $rs['juzgado']; ?>
                                <strong>Parte:</strong><?php echo $rs['parte']; ?></small><br><p style="color: forestgreen;">*********************************</p>
                            
                        <?php } ?>
                    
                    </div>
                </div>
                <br><br>
                <div id="disqus_thread"></div>	
                <div class="modal hide fade" id="events-modal">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3>Event</h3>
                    </div>
                    <div class="modal-body" style="height: 400px"></div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn">Close</a>
                    </div>
                </div>
                <script type="text/javascript" src="components/jquery/jquery.min.js"></script>
                <script type="text/javascript" src="components/underscore/underscore-min.js"></script>
                <script type="text/javascript" src="components/bootstrap2/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="components/jstimezonedetect/jstz.min.js"></script>
                <script type="text/javascript" src="js/calendar.js"></script>
                <script type="text/javascript" src="js/app.js"></script>
            <?php }else{ ?> 
                <h4 style="text-align: center; color: red"><img src="../../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para acceder a esta opción</h4>
            <?php } ?>   
        </div>
        <footer class="text-center well">
            <p>CENTRO DE SERVICIOS CIVIL - FAMILIA</p>
            <p>CARRERA 23 # 21-48 OFICINA 108</p>
            <P>TELÈFONO 887 9620</p>
            <P>MANIZALES CALDAS</P>
            <strong><a data-toggle="popover" title="Juan Esteban Múnera B.">Juan Esteban Múnera Betancur </a></strong>
            <p>Version 2.0 &COPY; 2018</p>            
        </footer> 
    </body>
</html>