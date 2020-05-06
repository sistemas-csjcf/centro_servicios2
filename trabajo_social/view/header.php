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
        <!--        funciones creadas mvc Juan Esteban Múnera Betancur -->
        <script language="JavaScript" type="text/javascript" src="assets/js/ajax/funciones_jest.js"></script>
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
	<!--<body> -->
    <body oncontextmenu="return false"> 
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#miMenu" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href=""><i class="icon-profile"></i> Trabajo Social</a>
                </div>
                <div class="collapse navbar-collapse" id="miMenu">
<!--                    USUARIO ADMINISTRADOR-->
                    <?php if ( in_array($_SESSION['idUsuario'],$usuariosa) ) { ?>
                        <input type="hidden" id="badgeVPendientesTS">
                        <input type="hidden" id="badgeInfSeguimientoTS" />
                        <input type="hidden" id="badgeValoracionD" />
                        <ul class="nav navbar-nav">
                            <li><a href="?c=visitas"><i class="icon-home2"></i> Inicio <span class="badge" id="badgeVPendientes"></span></a></li>
                            <li>
                                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#"><span class="icon-clipboard"></span> Registrar<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="?c=Visitas&a=Crud"><i class="icon-address-book"></i> Visita</a></li>
                                    <li><a href="?c=Visitas&a=Crud_com"><i class="icon-files-empty"></i> Despacho Comisorio</a></li>
                                    <li><a href="?c=Visitas&a=TSocial"><i class="icon-user"></i> Asistente Social</a></li>
                                    <li><a href="?c=Visitas&a=dia_noHabil"><i class="icon-calendar"></i> Día Festivo</a></li>
                                </ul>
                            </li>
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#" ><i class="icon-search"></i> Consultar<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="?c=Visitas&a=H_Visitas"><span class="icon-history"></span> Historial Visitas</a></li>
                                    <li><a href="?c=Visitas&a=Historial_Informe_SeguimientoAll"><i class="glyphicon glyphicon-folder-open"></i> Historial Informe Seguimiento Visitas</a></li>
                                    <li><a href="?c=Visitas&a=Historial_Informe_RemisionAll"><i class="glyphicon glyphicon-folder-open alert-info" ></i> Historial Informe Remisión Visitas</a></li>
                                    <li><a href="?c=Visitas&a=Historial_Valoracion_VisitaAll"><i class="fa fa-address-card-o "></i> Historial Valoración Visitas <span class="badge" id="badge"></span></a></li>
                                </ul>
                            </li>
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#"><i class="fa fa-file-text-o"></i> Informes<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="?c=Visitas&a=Listado_InformesRemision"><i class="fa fa-file-text-o"></i> Remisión Visita Domiciliaria <span class="badge" id="badgeInfRemision"></span></a></li>
									<!--<li><a href="?c=Visitas&a=Listado_InformesValoracion"><i class="fa fa-address-card-o"></i> Valoración Informe Visita <span class="badge" id="badgeValoracionCS"></span></a></li>-->
                                </ul>
                            </li>
                            <li>
                                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#"><i class="icon-pie-chart"></i> Estadistica<span class="caret"></span></a>
                                <ul class="dropdown-menu">
<!--                                    <li><a class="grafica" href="javascript:void(0);" onClick="abrirVentana();"><i class="icon-stats-dots"></i> Estadistica1</a></li>-->
                                    <li><a class="grafica" href="?c=Visitas&a=estadistica_Contador_VisitasTS" ><i class="fa fa-line-chart" aria-hidden="true"></i> Visitas Trabajadora Social</a></li>
                                    <li><a class="grafica" href="?c=Visitas&a=estadistica_Contador_VisitasDespacho" ><i class="fa fa-bar-chart" aria-hidden="true"></i> Cantidad Visitas Juzgado</a></li>
                                    <li><a class="grafica" href="?c=Visitas&a=Visitas_Pendientes_allTS" ><i class="icon-file-excel aria-hidden="true"></i> Excel Visitas Pendientes</a></li>



                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php echo htmlentities($_SESSION['nombre']); ?>
                        </ul>
<!--                        USUARIO ASISTENTE SOCIAL-->
                    <?php }else if($id_user_perfil == 21){ ?>
                        <input type="hidden" id="badgeInfRemision">
                        <input type="hidden" id="badgeVPendientes">
                        <input type="hidden" id="badgeValoracionD" />
                        <input type="hidden" id="badge">
                        <ul class="nav navbar-nav">
                            <li><a href="?c=Visitas&a=Visitas_TS"><i class="icon-home2"></i> Inicio <span class="badge" id="badgeVPendientesTS"></span></a></li>
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#"><span class="icon-search"></span> Consultar<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                     <li><a href="?c=Visitas&a=H_Visitas_TS"><span class="icon-history"></span> Historial Visitas</a></li>
                                     <li><a href="?c=Visitas&a=Historial_Informe_Seguimiento"><i class="glyphicon glyphicon-folder-open"></i> Historial Informe Seguimiento Visitas</a></li>
                                </ul>
                            </li>
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#"><span class="fa fa-file-text"></span> Informes<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="?c=Visitas&a=IndexVisitasTS"><span class="fa fa-file-text-o"></span> Seguimiento Visita Domiciliaria <span class="badge" id="badgeInfSeguimientoTS"></span></a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php echo htmlentities($_SESSION['nombre']); ?>
                        </ul>
<!--                        USUARIO DESPACHO-->
                     <?php }else if($id_user_perfil == 22){ ?>
                        <input type="hidden" id="badgeVPendientesTS">
                        <input type="hidden" id="badgeInfSeguimientoTS" />
                        <input type="hidden" id="badgeInfRemision">
                        <input type="hidden" id="badgeVPendientes">
                        <input type="hidden" id="badge">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="?c=Visitas&a=H_Visitas_Despacho"><span class="icon-home2"></span> Inicio</a></li>
                            <li>
                                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#"><span class="icon-clipboard"></span> Registrar<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="?c=Visitas&a=Crud"><span class="icon-address-book"></span> Visita</a></li>
                                    <li><a href="?c=Visitas&a=Listado_InformesValoracion"><i class="fa fa-address-card-o"></i> Valoración Informe Visita <span class="badge" id="badgeValoracionD"></span></a></li>
                                </ul>
                            </li>
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#"><span class="icon-search"></span> Consultar<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                     <li><a href="?c=Visitas&a=H_Visitas_Despacho"><span class="icon-history"></span> Historial Visitas</a></li>
                                     
                                     <li><a href="?c=Visitas&a=Historial_Informe_RemisionD"><i class="glyphicon glyphicon-folder-open " ></i> Historial Informe Remisión Visitas</a></li>
                                     <li><a href="?c=Visitas&a=Historial_Informe_ValoracionD"><i class="fa fa-address-card-o"></i> Historial Valoración Informe Visitas</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php echo $_SESSION['nombre']; ?>
                        </ul>
                     <?php }else{ ?> 
                        <h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para acceder a esta opción</h4>
                     <?php } ?>   
                </div>
            </nav>
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