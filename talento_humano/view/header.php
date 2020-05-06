<?php
    session_start();
    $id_user_perfil = $_SESSION['idperfil'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo               = new HojaVida();
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '28';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
    
    $idaccion             = '4';
    $datos_us_accionReps  = $modelo->get_lista_usuario_accionesJE($idaccion);
    $us_privilegios       = $datos_us_accionReps->fetch();
    $usuarioPr            = explode("////",$us_privilegios[usuario]);
    // PERMISOS FORANEOS
    $camposF               = 'usuario';
    $nombrelistaF          = 'pa_usuario_acciones';
    $idaccionF             = '29';
    $campoordenarF         = 'id';
    $datosusuarioaccionesF = $modelo->get_lista_usuario_acciones($camposF,$nombrelistaF,$idaccionF,$campoordenarF);
    $usuariosF             = $datosusuarioaccionesF->fetch();
    $usuariosaF            = explode("////",$usuariosF[usuario]);
    //PLANTA DE PERSONAL
    $idaccionPP             = '30';
    $datosusuarioaccionesPP = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccionPP,$campoordenar);
    $usuariosPP             = $datosusuarioaccionesPP->fetch();
    $usuariosaPP            = explode("////",$usuariosPP[usuario]);
    
    date_default_timezone_set('America/Bogota'); 
    $fecharegistro=date('Y-m-d'); 
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Talento Humano</title>
        <meta charset="utf-8" />
        <link rel="shortcut icon" href="assets/imagenes/logo.png" />
        <!--   **********     Diseño plantilla  ***********  -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.js" />
<!--        <script src="assets/js/jquery-ui/jquery-ui.js"></script>-->
        <!--        funciones creadas mvc Juan Esteban Múnera Betancur -->
        <script language="JavaScript" type="text/javascript" src="assets/js/ajax/funciones_jestHV.js"></script>
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
                $('#example').DataTable( {
                    "order": [[ 0,"desc" ]]
                });
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
                $("#fechaI,#fechaF,#fecha_nacimiento").datepicker({
                    changeMonth: true,
                    changeYear: true
                });
                $(function() {
                    $("#fecha").datepicker();
                    $("#fecha_fin").datepicker();
                });
            } );
        </script>
        <script>
            $(function () {
                $('#date_range').daterangepicker({
                    "locale": {
                        "format": "YYYY-MM-DD",
                        "separator": " - ",
                        "applyLabel": "Guardar",
                        "cancelLabel": "Cancelar",
                        "fromLabel": "Desde",
                        "toLabel": "Hasta",
                        "customRangeLabel": "Personalizar",
                        "daysOfWeek": [
                            "Do",
                            "Lu",
                            "Ma",
                            "Mi",
                            "Ju",
                            "Vi",
                            "Sa"
                        ],
                        "monthNames": [
                            "Enero",
                            "Febrero",
                            "Marzo",
                            "Abril",
                            "Mayo",
                            "Junio",
                            "Julio",
                            "Agosto",
                            "Setiembre",
                            "Octubre",
                            "Noviembre",
                            "Diciembre"
                        ],
                        "firstDay": 1
                    },
                    "startDate": "<?php echo $fecharegistro; ?> ",
                    "endDate": "<?php echo $fecharegistro; ?> ",
                    "opens": "center"
                });
            });
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
        <script language="JavaScript">
            $(document).ready(function()
            {
                $("#add").click(function()
                {
                    var cont = document.getElementById('h_numero_fecha').value;
                    cont = parseInt(cont) + 1;
                    //alert(cont);
                    var bloque = 
                    "<tr><td><input type='date' id='fecha" + cont + "' name='fecha[]' required='' class='form-control' /></td>" +
                    
                    "<td><input type='time' id='horai" + cont + "' name='horai[]' required='' class='form-control' min='08:00' ></td>" +
                    "<td><input type='time' id='horaf" + cont + "' name='horaf[]' required='' class='form-control' max='18:00' ></td>" +
                    "<td style='text-align: center'><input type='checkbox' id='check" + cont + "' name='seleccion[]' value='" + cont + "' onchange='check_fecha(this)'></td></tr>";
                    $("#example").append(bloque);
                    document.getElementById('h_numero_fecha').value = cont;
                    //alert(bloque);

                });
                $("#del").click(function()
                {
                    var cont = document.getElementById('h_numero_fecha').value;
                    cont = parseInt(cont) - 1;
                    var trs = $("#example tr").length;
                    if(trs > 2)
                    {
                        $("#example tr:last").remove();
                        document.getElementById('h_numero_fecha').value = cont;
                    }
                    //alert(trs);
                });
            });
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
                        <a class="navbar-brand" href=""><i class="fa fa-address-card" aria-hidden="true"></i> Talento Humano</a>
                    </div>
                    <div class="collapse navbar-collapse" id="miMenu">
                        <ul class="nav navbar-nav">
                            <?php if ( in_array($_SESSION['idUsuario'],$usuariosa) ) { ?>
                                <li><a href="?c=Hoja_vida"><i class="icon-home2"></i> Inicio</a></li>
                            <?php } ?>
                            <li><a href="?c=Hoja_vida&a=Personal"><i class="icon-profile"></i> Hoja Vida</a></li>
                            <?php if ( in_array($_SESSION['idUsuario'],$usuariosaPP) ){ ?>
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#" ><i class="glyphicon glyphicon-pencil"></i> Registrar<span class="caret"></span></a>
                                <ul class="dropdown-menu multi-level">
                                    
                                    <li class="dropdown-submenu">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Otras Resoluciones</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="?c=Hoja_vida&a=Crud_Res_Nombramiento"><span class="glyphicon glyphicon-file"></span> Nombramiento</a></li>
                                            
                                        </ul>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="?c=Hoja_vida&a=Crud_Certi_Laboral">Certificado Laboral</a></li>
                                    <li class="divider"></li>
                                </ul>
                            </li>
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#" ><i class="icon-search"></i> Consultar<span class="caret"></span></a>
                                <ul class="dropdown-menu multi-level">
                                    
                                    <li class="dropdown-submenu">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Otras Resoluciones</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="?c=Hoja_vida&a=Ver_listado_Nombramientos"><span class="glyphicon glyphicon-file"></span> Nombramiento</a></li>
                                            
                                        </ul>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a hhref="?c=Hoja_vida&a=Crud_Certi_Laboral">Certificado Laboral</a></li>
                                    <li class="divider"></li>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if ( in_array($_SESSION['idUsuario'],$usuariosaF) ) { ?>
                            <li><a href="?c=hoja_vida&a=Crud&band=44"><i class="glyphicon glyphicon-plus-sign"></i> Nuevo Registro</a></li>
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
                    <div class="col-xs-6 col-md-8">
                        <h1 class="page-header">Talento Humano</h1>
                    </div>
                </div>
            </div>
