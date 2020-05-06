<?php 
    $id         = $_GET['id'];
    $subtitulo  = "ANOTACIONES";
    $subtitulo2 = "PARTES DEL PROCESO";
    //INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
    $modelo     = new signotModel();
    $datosdocumento = $modelo->datos_proceso($id);
    while($fila = $datosdocumento->fetch()){		
        $d0     = $fila['id'];	
        $titulo = "Registrar Anotacion, Id Proceso: ".$d0;	
        $d1     = $fila[radicado];
    }
    $datosantotaciones  = $modelo->get_datos_proceso_anotacion_2($id);
//	JUAN ESTEBAN MUNERA BETANCUR 30/06/2017		
    $filtro = $modelo->get_datos_proceso_anotacion($id);
    while($fila = $filtro->fetch()){		
        $radicado  = $fila['radicado'];
    }
    $datosparteproceso = $modelo->get_partes_proceso($radicado); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title><?php echo $titulo?></title>
        <script src="views/js/jquery.js" type="text/javascript"></script>
        <script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
        <script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
        <script src="views/js/jquery.validate.js" type="text/javascript"></script>
        <script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                    	
        <link href="views/css/pepper-grinder/ui.all.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8" />
        <link href="views/css/main.css" rel="stylesheet" type="text/css" />
        <!-- USO DE ARCHVIO PARA VALIDACIONES DE CAMPOS Y APLICACION DE FUNCIONES -->
        <script src="views/js/ajax/ajax_documentos.js" type="text/javascript" charset="utf-8"></script> 
        <script src="views/js/ajax/ajax_signot.js" type="text/javascript" charset="utf-8"></script> 
        <!-- PARA MANEJAR LOS ESTILOS DEL FORMULARIO -->
        <link href="views/css/main.css" rel="stylesheet" type="text/css" />
        <!-- PARA EL FUNCIONAMIENTO DE LAS TABLAS EN SU FILTRO Y PAGINACION -->
        <script type="text/javascript" language="javascript" src="views/viewstablas/jquery.dataTables.js"></script> 
        <link rel="stylesheet" type="text/css" href="views/viewstablas/demo_page.css"/>
        <link rel="stylesheet" type="text/css" href="views/viewstablas/demo_table.css" />
        <!-- PARA LAS FECHAS -->
        <script type="text/javascript" src="views/fechajquery/jquery.datetimepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="views/fechajquery/jquery.datetimepicker.css" />
        <!-- PARA LAS VENTANAS EMERGENTES POPUPBOX -->
        <script src="views/js/ajax/ajax_popupbox_empleados_registro_entrada_salida.js" type="text/javascript" charset="utf-8"></script>
        <link href="views/css/stylepopupbox.css" rel="stylesheet" type="text/css" />
        <!--        JUAN ESTEBAN MÚNERA BETANCUR-->
        <script language="JavaScript" type="text/javascript" src="assets/js/funciones_jest.js"></script>
        <!-- PARA EL DESPLIEGUE DE MENUS -->
        <script type="text/javascript">
            function mainmenu(){
                $(" #menusec ul ").css({display: "none"});
                $(" #menusec li").hover(function(){
                    $(this).find('ul:first:hidden').css({visibility: "visible",display: "none"}).slideDown(400);
                },function(){
                    $(this).find('ul:first').slideUp(400);
                });
            }
            $(document).ready(function(){
                mainmenu();
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#frm_anotaciones').dataTable( { 
                    'sPaginationType': 'full_numbers',
                    'aaSorting': [[ 0, 'desc' ]],     
                    'aoColumns': [null,null,null,null,null,null]
                } );
            });
        </script>	
    </head>
    <body>
        <?php 
            //imagen principal TEMIS, y iconos volver al menu principal y cerrar sesion 
            require 'header.php';
            //menus, con imagen del modulo
            require 'secc_signot.php';
        ?>	
        <table border="0" cellspacing="0" cellpadding="0" align="center">
            <tr><td></td></tr>	
            <tr>
                <td>
                    <center><div id="titulo_frm">Radicado: <?php echo $radicado." - "; ?><?php echo strtoupper($titulo); ?></div></center>
                    <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
                        <tr>
                            <td colspan="2">
                                <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_partesproceso">
                                    <thead> 
                                        <tr>
                                            <th bgcolor="#CDE3F9" colspan="4">
                                                <center><div id="titulo_frm"><?php echo strtoupper($subtitulo2); ?></div></center>
                                            </th>
                                        </tr>
                                        <tr> 
                                            <th>Id</th>
                                            <th>Cedula</th>
                                            <th>Nombre</th>
                                            <th>Clasificacion Parte</th>
                                        </tr> 
                                    </thead> 
                                    <tbody> 
                                        <?php while($row = $datosparteproceso->fetch()){ ?>
                                            <tr>
                                                <td><?php echo $row[id];?></td>
                                                <td><?php echo $row[cedula];?></td>
                                                <td><?php echo $row[nombre];?></td>
                                                <td><?php echo $row[clasificacion];?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>								
                                </table>
                            </td>
                        </tr>										
                        <tr>	
                            <td colspan="2">
                                <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_anotaciones">
                                    <thead> 
                                        <tr>
                                            <th bgcolor="#CDE3F9" colspan="6">
                                                <center><div id="titulo_frm"><?php echo strtoupper($subtitulo)." (BUSCAR POR NOMBRE)"; ?></div></center>
                                            </th>
                                        </tr>
                                        <tr> 
                                            <th>ID</th>
                                            <th>FECHA</th>
                                            <th>HORA</th>
                                            <th>REGISTRA</th>
                                            <th>TIPO</th>
                                            <th>ANOTACION</th>
                                        </tr> 
                                    </thead> 
                                    <tbody> 
                                        <?php while($row = $datosantotaciones->fetch()){ ?>
                                            <tr>
                                                <td><?php echo $row[id];?></td>
                                                <td><?php echo $row[fecha];?></td>
                                                <td><?php echo $row[hora];?></td>
                                                <td><?php echo $row[empleado];?></td>
                                                <td><?php echo $row[destipo];?></td>
                                                <td><?php echo $row[anotacion];?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>								
                                </table>					
                            </td>
                        </tr>	
                    </table>	
                </td>
            </tr>	
        </table>	
        <?php require 'alertas.php'; ?>
    </body>
</html>