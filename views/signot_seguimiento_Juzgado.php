<?php 
// JUAN ESTEBAN MÙNERA BETANCUR 01-08-2017 2.31 PM
    $idusuario  = $_SESSION['idUsuario'];
    //TITULO FORMULARIO
    $titulo     = "Filtrar Proceso";
    $subtitulo  = "Procesos";
    //INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
    $modelo       = new signotModel();
    $juzgado     = $modelo->JuzgadoUsuario($idusuario);
    while($row = $juzgado->fetch()){
        $idJ    = $row['idJ'];
        $codJ   = $row['codJ'];
        $numJ   = $row['numJ'];
    }
    if(strlen($numJ)<2){
        $numJ = "00".$numJ;
    }else{
        $numJ = "0".$numJ;
    }
    $datosProceso = $modelo->get_datos_procesoJ($idJ);
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
        <!-- USO DE ARCHVIO PARA VALIDACIONES DE CAMPOS Y APLICACION DE FUNCIONES -->
        <script src="views/js/ajax/ajax_signot.js" type="text/javascript" charset="utf-8"></script>
        <!-- PARA MANEJAR LOS ESTILOS DEL FORMULARIO -->
        <link href="views/css/main.css" rel="stylesheet" type="text/css" />
        <!-- PARA EL FUNCIONAMIENTO DE LAS TABLAS EN SU FILTRO Y PAGINACION -->
        <script type="text/javascript" language="javascript" src="views/viewstablas/jquery.dataTables.js"></script> 
        <link rel="stylesheet" type="text/css" href="views/viewstablas/demo_page.css" />
        <link rel="stylesheet" type="text/css" href="views/viewstablas/demo_table.css" />
        <!-- PARA LAS FECHAS -->
        <script type="text/javascript" src="views/fechajquery/jquery.datetimepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="views/fechajquery/jquery.datetimepicker.css" />
        <!-- PARA LAS VENTANAS EMERGENTES POPUPBOX -->
        <script src="views/js/ajax/ajax_popupbox_empleados_registro_entrada_salida.js" type="text/javascript" charset="utf-8"></script>
        <link href="views/css/stylepopupbox.css" rel="stylesheet" type="text/css" />
        <!--        FUNCIONES JUAN ESTEBAN MUNERA 01/08/2017 -->
        <script src="assets/js/funciones_jest.js"></script>
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
                    <div id="contenido">	
                        <form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
                            <input type="hidden" id="idJ" name="idJ" value="<?php echo $idJ; ?>" />
                            <div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>
                            <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
                                <tr>
                                    <td><label style="width:151px; color:#666666">Fecha Inicial:</label></td>
                                    <td>
                                        <input type="text" name="fechai" id="fechai" class="required" readonly="true" placeholder="Fecha Inicial" value="<?php echo trim($_GET['dato_1']); ?>" onchange="borrarCampo(this.value)" />
                                    </td>
                                    <td><label style="width:151px; color:#666666">Fecha Final:</label></td>
                                    <td>
                                        <input type="text" name="fechaf" id="fechaf" class="required" readonly="true" placeholder="Fecha Final" value="<?php echo trim($_GET['dato_2']); ?>" onchange="borrarCampo(this.value)" />
                                    </td>
                                </tr>		
                                <tr>
                                    <td><label style="width:151px; color:#666666">Radicado:</label></td>
                                    <td colspan="3">
                                        <input type="text" name="radicadox" id="radicadox" class="required number" placeholder="Ingrese No. Radicado" value="<?php echo $codJ."".$numJ; ?>"  />
                                        <input type="hidden" name="radicadox" id="usuarioJuzgado" value="<?php echo $codJ."".$numJ; ?>"  />
                                    </td>
                                </tr>		
                                <!-- -----------------------------BOTONES--------------------------------------------------------- -->
                                <tr>
                                    <td colspan="4">
                                        <center>
                                            <input type="button" name="consultar" value="Consultar" id="btn_input" onclick="consultarSignotJ()" />
                                            <input type="reset" name="Submit2" value="Restablecer" id="btn_input" onclick="reiniciar()" />
                                        </center>
                                    </td> 
                                </tr>
                                <!-- ----------------------------------------------------------------------------------------------- -->
                            </table>		
                        </form>
                    </div>
                </td>
            </tr>	
	</table>
        <div id="contenidoI">
            <table border="0" align="center"  rules="rows" id="tablaconsulta">		
                <tr>
                    <td>
                        <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_editar1">
                            <thead> 
                                <tr>
                                    <th bgcolor="#CDE3F9" colspan="4"><center><div id="titulo_frm"><?php echo strtoupper($subtitulo); ?></div></center></th>
                                </tr>
                                <tr> 
                                    <th>ID</th>
                                    <th>RADICADO</th>
                                    <th>VER</th>
                                </tr> 
                            </thead> 
                            <tbody> 									
                                <?php while($row = $datosProceso->fetch()){ ?>
                                    <tr>
                                        <td><?php echo $row['id'];?></td>
                                        <td><?php echo $row['radicado'];?></td>
                                        <td><a href="javascript:void(0);" onclick="verINFO_seguimientoProcesoJ(<?php echo $row['id'];?>)"><img src="views/images/buscar.png" width="35" height="35" title="VER CONTENIDO"/></a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>				
                    </td>
                </tr>		
            </table>
        </div>
        <div id="listar_contenidoFiltro"></div>
        <?php require 'alertas.php';?>
    </body>
</html>