<?php 	
    $idusuario  = $_SESSION['idUsuario'];
    $titulo     = "Filtrar Proceso Para Generar Caratula";
    $subtitulo  = "Tabla Procesos";
    $modelo       = new caratula_Tribunal_Model();
    $fechaactual  = $modelo->get_fecha_actual_amd();
    $opcion = trim($_GET['dato_0']);
    if($opcion != 1){
        $datosproceso = $modelo->get_datos_proceso_x(1);
        $datosproceso_2 = explode("//////",$datosproceso);
        $cantr          = count($datosproceso_2);
    }else{
        $datosproceso = $modelo->get_datos_proceso_x(2);
        $datosproceso_2 = explode("//////",$datosproceso);
        $cantr          = count($datosproceso_2);
    }	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>  -->
        <title><?php echo $titulo?></title>
        <!-- -------------------------------------------------------------------- -->
        <script src="views/js/jquery.js" type="text/javascript"></script>
        <script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
        <script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
        <script src="views/js/jquery.validate.js" type="text/javascript"></script>
        <script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                    	
        <link href="views/css/pepper-grinder/ui.all.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8" />
        <link href="views/css/main.css" rel="stylesheet" type="text/css" />
        <!-- -------------------------------------------------------------------- -->
        <script src="views/js/ajax/ajax_caratula.js" type="text/javascript" charset="utf-8"></script>
        <!-- PARA MANEJAR LOS ESTILOS DEL FORMULARIO -->
        <link href="views/css/main.css" rel="stylesheet" type="text/css" />
        <!-- PARA EL FUNCIONAMIENTO DE LAS TABLAS EN SU FILTRO Y PAGINACION -->
        <script type="text/javascript" language="javascript" src="views/viewstablas/jquery.dataTables.js"></script> 
        <link rel="stylesheet" type="text/css" href="views/viewstablas/demo_page.css" />
        <link rel="stylesheet" type="text/css" href="views/viewstablas/demo_table.css" />
        <!-- PARA LAS FECHAS -->
        <script type="text/javascript" src="views/fechajquery/jquery.datetimepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="views/fechajquery/jquery.datetimepicker.css" />
        <script src="views/js/ajax/ajax_popupbox_empleados_registro_entrada_salida.js" type="text/javascript" charset="utf-8"></script>
        <link href="views/css/stylepopupbox.css" rel="stylesheet" type="text/css" />
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
                <!-- TABLA id:frm_editar2-->
                $('#frm_editar1').dataTable({ 
                    'sPaginationType': 'full_numbers',
                    'aaSorting': [[ 0, 'desc' ]],     
                    'aoColumns': [null,null]
                } );
            });
        </script>	
    </head>
    <body>
	<?php 
            //imagen principal TEMIS, y iconos volver al menu principal y cerrar sesion 
            require 'header.php';
            //menus, con imagen del modulo
            require 'secc_caratula.php';	
	?>			
	<table border="0" cellspacing="0" cellpadding="0" align="center">
            <tr><td></td></tr>
            <tr>
				<td>
                    <div id="contenido">
                        <form id="frmcaratula" name="frmcaratula" method="post" enctype="multipart/form-data" action="">		
                            <input name="consecutivodocumento" id="consecutivodocumento" type="hidden" readonly="true"/>			
                            <input name="iddocumento" id="iddocumento" type="hidden" readonly="true"  value="<?php echo $d0; ?>" />
                            <input name="partesdoc" id="partesdoc" type="hidden" readonly="true"/>
                            <div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>
                            <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
                                <tr>
                                    <td><label style="width:151px; color:#666666">Fecha Inicial:</label></td>
                                    <td>
                                        <input type="text" name="fechai" id="fechai" class="required" readonly="true" value="<?php echo trim($_GET['dato_1']); ?>"/>
                                    </td>
                                    <td><label style="width:151px; color:#666666">Fecha Final:</label></td>
                                    <td>
                                        <input type="text" name="fechaf" id="fechaf" class="required" readonly="true" value="<?php echo trim($_GET['dato_2']); ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label style="width:151px; color:#666666">Radicado:</label></td>
                                    <td>
                                        <input type="text" name="radicadox" id="radicadox" class="required number" value="<?php echo trim($_GET['datox1']); ?>"/>
                                    </td>
                                    <td colspan="2">
                                        <a class="generarcaratula_2_Tribunal" href="javascript:void(0);"><img src="views/images/caratula6.jpg" width="40" height="40" title="GENERAR CARATULA"/>OPCION QUE PERMITE GENERAR LA CARATULA CUANDO EL RADICADO NO SE ENCUENTRA EN LA TABLA PROCESOS</a>
                                    </td>
                                </tr>			
                                <!-- -----------------------------BOTONES--------------------------------------------------------- -->
                                <tr>
                                    <td colspan="4">
                                        <center>
                                            <input type="button" name="consultar" value="Consultar" id="btn_input" class="filtrarproceso_tribunal"/>
                                            <input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
                                        </center>
                                    </td> 
                                </tr>
                            </table>		
                        </form>
                    </div>		
                </td>
            </tr>	
		</table>
		<br/>
		<table border="0" align="center"  rules="rows" id="tablaconsulta">
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_editar1">
                        <thead> 
                            <tr>
                                <th bgcolor="#CDE3F9" colspan="4">
                                    <center><div id="titulo_frm"><?php echo strtoupper($subtitulo); ?></div></center>
                                </th>
                            </tr>
                            <tr> 
                                <th>NUM </th>
                                <th>RADICADO</th>
                                <th>-</th>
                                <th>-</th>
                            </tr> 
                        </thead> 										
                        <tbody> 
                            <?php $i= 0; $registro = 1; while($i < $cantr - 1) /*while($row = $datosproceso->fetch())*/{ ?>
                                <tr>
                                    <td><?php echo $registro/*$row[id]*/;?></td>
                                    <td><?php echo $datosproceso_2[$i]/*$row[radicado]*/;?></td>
                                    <td></td>	
                                    <td>
                                        <a class="generarcaratula_tribunal" href="javascript:void(0);" data-id="<?php echo $datosproceso_2[$i]/*$row['radicado']*/;?>">
                                            <img src="views/images/caratula.png" width="35" height="35" title="GENERAR CARATULA"/>
                                        </a>
                                    </td>
                                </tr>
                            <?php $i= $i + 1; $registro = $registro + 1;} ?>											
                        </tbody>
                    </table>				
                </td>
            </tr>			
        </table>				
        <?php require 'alertas.php';?>
    </body>
</html>