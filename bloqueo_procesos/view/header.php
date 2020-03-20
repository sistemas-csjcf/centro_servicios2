<!DOCTYPE html>
<html lang="es">
    <head>
<!--        JUAN ESTEBAN MUNERA BETANCUR-->
        <title>Bloqueo Procesos</title>
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
        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
        <!--  LIBRERIA datatable personalizada -->
        <script src="assets/js/app/1.10.12_js-jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.1.0/js/responsive.bootstrap.min.js"></script>
        <!--Libs CSS Datatables-->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css"/> 
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
                $('#example1').DataTable();
                $('#example2').DataTable();
            } );
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
                $("#fecha,#fecha_fin").datepicker({
                    changeMonth: true,
                    changeYear: true
                });
                $(function () {
                    $("#fecha").datepicker();
                    $("#fecha_fin").datepicker();
                });
            } );
        </script>
    </head>
    <body>
        <div class="container">
            <div class="jumbotron">
                <div class="row">
                    <div class="col-xs-6 col-md-3">
                        <img src="assets/imagenes/logo.png" alt="Centro Servicios Civil - Familia" style="width: 130px;">
                    </div>
                </div>
                <h1 class="page-header">Sistema Bloqueo de Procesos</h1>
            </div>