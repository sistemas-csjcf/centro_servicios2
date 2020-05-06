<?php
    session_start();
    $id_user_perfil = $_SESSION['idperfil'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo               = new Tutela();
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '32';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
    
    
//    FILTRO CONSULTA DE TUTELAS -- DESPACHOS ASIGNADOS
//    $campos               = 'usuario';
//    $nombrelista          = 'pa_usuario_acciones';
//    $idaccion             = '32';
//    $campoordenar         = 'id';
//    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
//    $usuarios             = $datosusuarioacciones->fetch();
//    $usuariosa            = explode("////",$usuarios[usuario]);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Tutelas Centro Servicios</title>
        <meta charset="utf-8" />
        <link rel="shortcut icon" href="assets/imagenes/logo.png" />
        <!--   **********     Diseño plantilla  ***********  -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.js" />
<!--        <script src="assets/js/jquery-ui/jquery-ui.js"></script>-->
        <!--        funciones creadas mvc Juan Esteban Múnera Betancur -->
        <script language="JavaScript" type="text/javascript" src="assets/js/ajax/funciones_jest_Tutela.js"></script>
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
            .gly-spin {
                -webkit-animation: spin 2s infinite linear;
                -moz-animation: spin 2s infinite linear;
                -o-animation: spin 2s infinite linear;
                animation: spin 2s infinite linear;
            }
            @-moz-keyframes spin {
                0% {
                    -moz-transform: rotate(0deg);
                }
                100% {
                    -moz-transform: rotate(359deg);
                }
            }
            @-webkit-keyframes spin {
                0% {
                    -webkit-transform: rotate(0deg);
                }
                100% {
                    -webkit-transform: rotate(359deg);
                }
              }
              @-o-keyframes spin {
                0% {
                    -o-transform: rotate(0deg);
                }
                100% {
                    -o-transform: rotate(359deg);
                }
            }
            @keyframes spin {
                0% {
                    -webkit-transform: rotate(0deg);
                    transform: rotate(0deg);
                }
                100% {
                    -webkit-transform: rotate(359deg);
                    transform: rotate(359deg);
                }
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
    <!--<body oncontextmenu="return false"> -->
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#miMenu" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href=""><i class="icon-stack"></i> Tutelas</a>
                </div>
                <div class="collapse navbar-collapse" id="miMenu">
                    <input type="hidden" id="badgeVPendientesTS">
                    <input type="hidden" id="badgeInfSeguimientoTS" />
                    <ul class="nav navbar-nav">
                        <li><a href="?c=tutela"><i class="icon-search"></i> Tutelas Reparto<span class="badge" id="badgeVPendientes"></span></a></li>
                        <?php if ( in_array($_SESSION['idUsuario'],$usuariosa) ) { ?>
                            <!--  ROL ADMIN-->
                            <?php if($id_user_perfil == 1){ ?>
                                <li><a href="?c=tutela&a=Index_Alerta"><i class="icon-alarm"></i> Alerta Tutela <span class="badge" id="badgeVPendientes"></span></a></li>
                                <li role="presentation" class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#" ><i class="icon-search"></i> Consultar<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="?c=Tutela&a=Lista_Migrar"><span class="icon-download2"></span> Migrar Tutelas</a></li>
                                        <li><a href="?c=Tutela&a=Consultar_tutelas"><i class="glyphicon glyphicon-folder-open"></i> Historial Tutelas Migradas</a></li>
                                    </ul>
                                </li>
                            <!--  ROL DESPACHO-->
                            <?php }else if($id_user_perfil == 22){ ?>
                                <li><a href="?c=tutela&a=Index_AlertaD"><i class="icon-alarm"></i> Alerta Tutela <span class="badge" id="badgeVPendientes"></span></a></li>
                                <li role="presentation" class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#" ><i class="icon-search"></i> Consultar<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="?c=Tutela&a=Lista_MigrarD"><span class="icon-download2"></span> Migrar Tutelas</a></li>
                                        <li><a href="?c=Tutela&a=Consultar_tutelasD"><i class="glyphicon glyphicon-folder-open"></i> Historial Tutelas Migradas</a></li>
                                    </ul>
                                </li>       
                            <?php }else{ ?>
                                <li><a href="#"><span class="icon-alarm"></span> Alerta Tutela</a></li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php echo $_SESSION['nombre']; ?>
                    </ul>
                </div>
            </nav>
            <div class="jumbotron">
                <div class="row">
                    <div class="col-xs-6 col-md-4">
                        <img src="assets/imagenes/logo.png" class="img-responsive" alt="Centro Servicios Civil - Familia" style="width: 130px;">    
                    </div>
                    <div class="col-xs-6 col-md-8">
                        <h1 class="page-header">Tutelas</h1>
                    </div>
                </div>
            </div>