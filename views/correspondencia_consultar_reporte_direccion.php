<?php
    require_once 'models/correspondenciaModel.php';
    $modelo = new correspondenciaModel();
    $lista_despachos  = $modelo->listar_despachos();
    $lista_tipo_envio       = $modelo->listar_tipo_envio();
    
    $campos                 = 'usuario';
    $nombrelista            = 'pa_usuario_acciones';
    $idaccion               = '16';
    $campoordenar           = 'id';
    $jdatosusuarioacciones  = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $jusuarios              = $jdatosusuarioacciones->fetch();
    $jusuariosa             = explode("////",$jusuarios[usuario]);
    //FECHA ACTUAL
    date_default_timezone_set('America/Bogota'); 
    $fecha=date('Y-m-d');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo titulo?></title>
        <script src="views/js/jquery.js" type="text/javascript"></script>
        <script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
        <script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
        <script src="views/js/jquery.validate.js" type="text/javascript"></script>
        <script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                    	
        <link href="views/css/pepper-grinder/ui.all.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8" />
        <link href="views/css/main.css" rel="stylesheet" type="text/css" />
<!--        FUNCIONES JUAN ESTEBAN MÙNERA -->
        <script src="assets/js/funciones_jest.js"></script>
        <link rel="stylesheet" href="assets/css/styleFonts.css"><!--iconos-->
        <script type="text/javascript">
            $(document).ready(function() {
                $(".topMenuAction").click( function() {
                    if ($("#openCloseIdentifier").is(":hidden")) {
                        $("#sliderm").animate({ 
                            marginTop: "-238px"
                        }, 500 );
                        $("#topMenuImage").html('<img src="views/images/open.png" alt="open" />');
                        $("#openCloseIdentifier").show();
                    } else {
                        $("#sliderm").animate({ 
                            marginTop: "0px"
                        }, 500 );
                        $("#topMenuImage").html('<img src="views/images/close.png" alt="close" />');
                        $("#openCloseIdentifier").hide();
                    }
                });  

                $("#sliderop").easySlider({});	
                $("#frm").validate();

                var validator = $("#frm").validate({
                    meta: "validate"
                });

                $(".btn_limpiar").click(function() {
                    validator.resetForm();
                });			
            });
        </script>	
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
        <?php require 'header.php'; ?>
        <?php require 'secc_correspondencia.php'; ?>
        <table border="0" cellspacing="0" cellpadding="0" align="center">
            <tr><td>&nbsp;</td></tr>
            <tr>
                <td>
                    <div id="contenido">
                        <form  method="post" enctype="multipart/form-data" name="frm" id="frm">
                            <div id="titulo_frm">Consultar Reporte Dirección Ejecutiva</div>
                            <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
                                 <tr>
                                    <td><label style="width:151px; color:#666666">Fecha Inicial:</label></td>
                                    <td><input type="date" name="fechai" id="fechai" value="<?php echo $fecha; ?>" /></td>
                                    <td><label style="width:151px; color:#666666">Fecha Final:</label></td>
                                    <td><input type="date" name="fechaf" id="fechaf" value="<?php echo $fecha; ?>" /></td>				
                                </tr>
                                <?php if ( in_array($_SESSION['idUsuario'],$jusuariosa) ) { ?>
                                    <input type="hidden" name="despacho" id="despacho" value="<?php echo $_SESSION['idUsuario']; ?>" />
                                <?php } else{ ?>		
                                    <tr>
                                        <td><label style="width:151px; color:#666666">Despacho:</label></td>
                                        <td>
                                            <select name="despacho" id="despacho">
                                                <option value="0" selected="selected">Seleccione Despacho</option>
                                                <?php while($row = $lista_despachos->fetch()){ ?>
                                                    <option value="<?php echo utf8_encode($row['cod_usuario_juzgado']); ?>"><?php echo utf8_encode($row['nombre']); ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td>Tipo Envío</td>
                                        <td>
                                            <select name="tipo_envio" id="tipo_envio">
                                                <option value="0" selected="selected">Todo Tipo Envío</option>
                                                <?php while($row = $lista_tipo_envio->fetch()){ ?>
                                                    <option value="<?php echo utf8_encode($row['tipo_envio_id']); ?>"><?php echo utf8_encode($row['tipo_envio_nombre']); ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                <?php } ?>	
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><a id="btn_input" onclick="listar_reporteDireccion()">Consultar </a></td>
                                    <td><input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar" /></td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table><br/>		
                        </form>
                        <div class="filtro" id="resultado_reporte_direccion"></div>   
                    </div>		
		</td>
            </tr>
            <tr><td>&nbsp;</td></tr>
        </table>
        <?php require 'alertas.php';?>
    </body>
</html>