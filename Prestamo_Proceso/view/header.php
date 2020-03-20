<?php
//header('Content-Type: text/html; charset=ISO-8859-1');
    session_start();
    $id_user_perfil = $_SESSION['idperfil'];
    // JUAN ESTEBAN MUNERA BETANCUR
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Solicitud Prestamo Proceso</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <!--  charset=ISO-8859-1  utf-8  -->
        <link rel="shortcut icon" href="assets/imagenes/logo.png" />
        <!--   **********     Diseño plantilla  ***********  -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.js" />
<!--        <script src="assets/js/jquery-ui/jquery-ui.js"></script>-->
        <!--        funciones creadas mvc Juan Esteban Múnera Betancur -->
        <script language="JavaScript" type="text/javascript" src="assets/js/ajax/funciones_jestPrestamos.js"></script>
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
        
        <!--        libreria para input-file
        <link rel="stylesheet" href="assets/css/fileinput.css" />
        <script src="assets/js/fileinput/fileinput.min.js"></script>-->
        <!-- LIBRERIA PARA SELECT LIVE -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
        <!-- (Optional) Latest compiled and minified JavaScript translation files 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-*.min.js"></script>-->
        <!--        LIBRERIAS DATERANGEPICKER-->  
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
                $('#example1').DataTable();
                $('#example2').DataTable();
                $('#example_historial').DataTable( {
                    "order": [[ 0, "desc" ]]
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
                    yearRange: "c-15:c+2",
                    firstDay: 1,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: ''
                };
                $.datepicker.setDefaults($.datepicker.regional['es']);
                $("#fechaI,#fechaF, #fecha_audiencia").datepicker({
                    changeMonth: true,
                    changeYear: true
                });
                $(function() {
                    $("#fecha").datepicker();
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
    </head>
    <body>
    <!--<body ncontextmenu="return false"> -->
        <div class="container">
            <nav class="navbar navbar-default">
                <!-- Brand/logo -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#example-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <img src="assets/imagenes/logo.png" class="img-responsive" alt="Centro Servicios Civil - Familia" style="width: 50px;">
                </div>
                <!-- Collapsible Navbar -->
                <div class="collapse navbar-collapse" id="example-1">
                    <ul class="nav navbar-nav">
                        <li><a href="?c=Prestamo"><i class="icon-home2"></i> Inicio</a></li>
                        <li><a href="?c=Prestamo&a=Procesos_Pendientes"><i class="icon-stack"></i> Procesos Pendientes</a></li>
                        <li>
                            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#"><span class="icon-clipboard"></span> Registrar<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="?c=Prestamo&a=Crud"><i class="icon-file-text"></i> Solicitud Prestamo Proceso</a></li>
                            </ul>
                        </li>
                        <li role="presentation" class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#" ><i class="icon-search"></i> Consultar<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="?c=Prestamo&a=Historial_Prestamos"><span class="icon-history"></span> Historial Prestamos</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#"><i class="icon-pie-chart"></i> Estadistica<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a class="grafica" href="#" ><i class="fa fa-bar-chart" aria-hidden="true"></i> Cantidad Solicitudes Juzgado</a></li>
<!--                                <li><a class="grafica" href="?c=Visitas&a=estadistica_Contador_VisitasTS" ><i class="fa fa-line-chart" aria-hidden="true"></i> Visitas Trabajadora Social</a></li>
                                <li><a class="grafica" href="?c=Visitas&a=estadistica_Contador_VisitasDespacho" ><i class="fa fa-bar-chart" aria-hidden="true"></i> Cantidad Visitas Juzgado</a></li>-->
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php $a_tilde = "&Aacute;"; echo utf8_encode($_SESSION['nombre']) ;  ?>
                    </ul>
                </div>
            </nav>
            <div class="jumbotron">
                <div class="row">
                    <div class="col-xs-6 col-md-12">
                        <h1 class="page-header">Prestamos Procesos</h1>
                    </div>
                </div>
            </div>