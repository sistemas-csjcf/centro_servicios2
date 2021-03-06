<?php
    session_start();
    $id_user_perfil = $_SESSION['idperfil'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo               = new mejora_c();
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '33';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);

    date_default_timezone_set('America/Bogota'); 
    $fecharegistro=date('Y-m-d'); 
    
    $idaccion           = '34';
    $datos_us_accion    = $modelo->get_lista_usuario_accionesJE($idaccion);
    $us_lider_MC        = $datos_us_accion->fetch();
    $usuario_lider_mc   = explode("////",$us_lider_MC[usuario]);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Mejora Continua</title>
        <meta charset="utf-8" />
        <link rel="shortcut icon" href="assets/imagenes/logo.png" />
        <!--   **********     Diseño plantilla  ***********  -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.js" />
<!--        <script src="assets/js/jquery-ui/jquery-ui.js"></script>-->
        <!--        funciones creadas mvc Juan Esteban Múnera Betancur -->
        <script language="JavaScript" type="text/javascript" src="assets/js/ajax/funciones_jestMC.js"></script>
        <link rel="stylesheet" href="assets/css/styleFonts.css"><!--iconos-->
        <script src="assets/js/app/jquery-1.11.2.min.js"></script>
        <!--  LIBRERIA datatable personalizada -->
        <script src="assets/js/app/1.10.12_js-jquery.dataTables.min.js"></script>
        <script src="assets/js/app/dataTables.bootstrap.min.js"></script>
        <script src="assets/js/app/dataTables.responsive.min.js"></script>
        <script src="assets/js/app/responsive.bootstrap.min.js"></script>
        
        <!--Libs CSS Datatables-->
        <link rel="stylesheet" href="assets/js/app/dataTables.bootstrap.min.css"/>
        <link rel="stylesheet" href="assets/js/app/responsive.bootstrap.min.css"/> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <!--        libreria para input-file-->
        <link rel="stylesheet" href="assets/css/fileinput.css" />
        <script src="assets/js/fileinput/fileinput.min.js"></script>
        <!-- LIBRERIA PARA SELECT LIVE -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
        <!-- (Optional) Latest compiled and minified JavaScript translation files -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-*.min.js"></script>
        
<!--        CON ESTAS EL DATERANGEPICKER NO ME FUNCIONO-->
        <!--  LIBRERIA DATEPICKER-RANGE -->
        <!--<script src="assets/js/daterange/daterangepicker.js"></script>-->
        <!--   LIBRERIA DATEPICKER-RANGE CSS-->
        <!--<link rel="stylesheet" type="text/css" href="assets/css/daterange/daterangepicker.css" />-->
        <!--*******************************************************************************************************-->
<!--        LIBRERIAS DATERANGEPICKER-->  
<!--FALTA TERMINAR DE REALIZAR PRUEBAS CON ESTAS 3 LIBREIRAS-->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
                $('#example1').DataTable();
                $('#example2').DataTable();
                $('#example3').DataTable();
                $('#example4').DataTable();
                $('#example_historial').DataTable( {
                    "order": [[ 0, "desc" ]]
                });
                $('#example_historial_lab').DataTable( {
                    "order": [[ 3, "desc" ]]
                });
            } );
            $('.selectpicker').selectpicker({
                style: 'btn-info',
                size: 4
            });
        </script> 
        <style>
            /*La cabecera*/
            .ui-datepicker .ui-datepicker-header{
                color: black;
                background: dodgerblue;
            }
        </style>
        <script>
            $(document).ready(function() {
                $.datepicker.regional['es'] = {
                    closeText: 'Cerrar',
                    prevText: '< Ant',
                    nextText: 'Sig >',
                    currentText: 'Hoy',
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                    dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
                    weekHeader: 'Sm',
                    dateFormat: 'yy-mm-dd',
                    yearRange: "c-60:c+1",
                    firstDay: 1,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: ''
                };
                $.datepicker.setDefaults($.datepicker.regional['es']);
                $("#fechaI,#fechaF,#fecha_limite,#fecha_limiteG, #fecha_limiteJ").datepicker({
                    changeMonth: true,
                    changeYear: true
                });
                $(function() {
                    $("#fecha").datepicker();
                    $("#fecha_limite").datepicker();
                    $("#fecha_limiteG").datepicker();
                    $("#fecha_fin").datepicker();
                });
            } );
            
        </script>
        
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
        <style>
           .dropdown-submenu {
                position: relative;
            }

            .dropdown-submenu>.dropdown-menu {
                top: 0;
                left: 100%;
                margin-top: -6px;
                margin-left: -1px;
                -webkit-border-radius: 0 6px 6px 6px;
                -moz-border-radius: 0 6px 6px;
                border-radius: 0 6px 6px 6px;
            }

            .dropdown-submenu:hover>.dropdown-menu {
                display: block;
            }

            .dropdown-submenu>a:after {
                display: block;
                content: " ";
                float: right;
                width: 0;
                height: 0;
                border-color: transparent;
                border-style: solid;
                border-width: 5px 0 5px 5px;
                border-left-color: #ccc;
                margin-top: 5px;
                margin-right: -10px;
            }

            .dropdown-submenu:hover>a:after {
                border-left-color: #fff;
            }

            .dropdown-submenu.pull-left {
                float: none;
            }

            .dropdown-submenu.pull-left>.dropdown-menu {
                left: -100%;
                margin-left: 10px;
                -webkit-border-radius: 6px 0 6px 6px;
                -moz-border-radius: 6px 0 6px 6px;
                border-radius: 6px 0 6px 6px;
            }
        </style>
    </head>
    <body>
    <!--<body ncontextmenu="return false"> -->
        <div class="container">
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#miMenu" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href=""><i class="icon-meter" aria-hidden="true"></i> Mejora Continua</a>
                    </div>
                    <div class="collapse navbar-collapse" id="miMenu">
                        <ul class="nav navbar-nav">
<!--  **************************************     USUARIO ADMIN ***** -->
                            <?php if ( in_array($_SESSION['idUsuario'],$usuariosa) ) { ?>
                                <input type="hidden" id="badge_mis_tareas">
                                <input type="hidden" id="badge_mis_hallazgos">
                                <li><a href="?c=Mejora_C&a=Mis_tareasAD" ><i class="icon-file-text2"></i> Mis Acciones Gestión <span class="badge" id="badge_mis_tareas_admin"></span></a></li>
                                <!--<li><a href="?c=Mejora_C&a=Mis_Hallazgos" ><i class="icon-newspaper"></i> Mis Hallazgos <span class="badge" id="badge_mis_hallazgos"></span></a></li>-->
                                <li role="presentation" class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#" ><i class="glyphicon glyphicon-pencil"></i> Registrar<span class="caret"></span></a>
                                    <ul class="dropdown-menu multi-level">
                                        <li><a href="?c=Mejora_C&a=Crud_tarea">Acción Gestión</a></li>
                                        <!--<li><a href="?c=Mejora_C&a=Crud_hallazgo">Hallazgo</a></li>-->
                                    </ul>
                                </li>
                                <li role="presentation" class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#" ><i class="icon-search"></i> Consultar<span class="caret"></span></a>
                                    <ul class="dropdown-menu multi-level">
                                        
                                        <li><a href="?c=Mejora_C&a=Historial_Tareas_AD"><span class="icon-history" alert alert-danger></span> Historial Acción Gestión</a></li>
<!--                                        <li><a href="?c=Mejora_C&a=Historial_HallazgoAD"><span class="icon-history"></span> Historial Hallazgos</a></li>-->
                                        <li class="divider"></li>
                                    </ul>
                                </li>
<!--                                <li role="presentation" class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#"><i class="fa fa-file-text-o"></i> Informes<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="?c=Mejora_C&a=Listado_InformesRemision"><i class="fa fa-file-text-o"></i> doc <span class="badge" id="badgeInfRemision"></span></a></li>
                                    </ul>
                                </li>-->
<!--      ***************************************  USUARIO DESPACHO-->
                            <?php }else if($_SESSION['idperfil'] ==22){ ?>
                                <input type="hidden" id="badge_mis_tareas_admin">
                                <input type="hidden" id="badge_mis_tareas">
                                <input type="hidden" id="badge_mis_hallazgos">
                                <li><a href="?c=Mejora_C&a=consultar_lista_tareas_despacho"><i class="icon-pushpin"></i> Estado Solicitud</a></li>
                                <li><a href="?c=Mejora_C&a=Crud_tarea_despacho"><i class="icon-file-text2"></i> Crear Acción de Gestión</a></li>
<!--      ***************************************  USUARIO LIDER-->                                
                            <?php }else if(in_array($_SESSION['idUsuario'],$usuario_lider_mc)){ ?>
                                <input type="hidden" id="badge_mis_tareas_admin">
                                <li><a href="?c=Mejora_C&a=Mis_tareas_us"><i class="icon-file-text2"></i> Mis Acciones de Gestión <span class="badge" id="badge_mis_tareas"></span></a></li>
                                <!--<li><a href="?c=Mejora_C&a=Mis_Hallazgos"><i class="icon-newspaper"></i> Mis Hallazgos <span class="badge" id="badge_mis_hallazgos"></span></a></li>
                                -->
                                <li role="presentation" class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#" ><i class="glyphicon glyphicon-pencil"></i> Registrar<span class="caret"></span></a>
                                    <ul class="dropdown-menu multi-level">
                                        <li><a href="?c=Mejora_C&a=Crud_tarea">Acción de Gestión</a></li>
                                        <!--<li><a href="?c=Mejora_C&a=Crud_hallazgo">Hallazgo</a></li> -->
                                    </ul>
                                </li>
                                <li role="presentation" class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#" ><i class="glyphicon glyphicon-search"></i> Consultar<span class="caret"></span></a>
                                    <ul class="dropdown-menu multi-level">
                                        <li><a href="?c=Mejora_C&a=Historial_Mis_Tareas">Historial Acción de Gestión</a></li>
                                        <!--<li><a href="?c=Mejora_C&a=Historial_Mis_Hallazgos">Historial Hallazgo</a></li> -->
                                    </ul>
                                </li>
<!--      ***************************************  USUARIO OTRO -->                                
                            <?php }else{ ?>
                                <input type="hidden" id="badge_mis_tareas_admin">
                                <li><a href="?c=Mejora_C&a=Mis_tareas_us"><i class="icon-file-text2"></i> Mis Acciones Gestión <span class="badge" id="badge_mis_tareas"></span></a></li>
                                <!-- <li><a href="?c=Mejora_C&a=Mis_Hallazgos"><i class="icon-newspaper"></i> Mis Hallazgos <span class="badge" id="badge_mis_hallazgos"></span></a></li> -->
                                <li role="presentation" class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#" ><i class="glyphicon glyphicon-search"></i> Consultar<span class="caret"></span></a>
                                    <ul class="dropdown-menu multi-level">
                                        <li><a href="?c=Mejora_C&a=Historial_Mis_Tareas">Historial Acciones Gestión</a></li>
                                        <!--<li><a href="?c=Mejora_C&a=Historial_Mis_Hallazgos">Historial Hallazgo</a></li> -->
                                    </ul>
                                </li>
                            <?php } ?>    
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php echo utf8_encode($_SESSION['nombre']); ?>
                        </ul> 
                    </div>
                </div>
            </nav>
            
            <script>
                $(document).ready(function(){
                    $('.dropdown-submenu a.test').on("click", function(e){
                        $(this).next('ul').toggle();
                        e.stopPropagation();
                        e.preventDefault();
                    });
                });
            </script>
            <div class="jumbotron">
                <div class="row">
                    <div class="col-xs-6 col-md-4">
                        <img src="assets/imagenes/logo.png" class="img-responsive" alt="Centro Servicios Civil - Familia" style="width: 130px;">    
                    </div>
                    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
                    <div class="w3-container">
                        <h1 class="w3-center w3-animate-top">Mejora Continua</h1>
                    </div>
                </div>
                
            </div>
