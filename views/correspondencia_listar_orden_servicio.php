<?php
    require_once 'models/correspondenciaModel.php';
    $modelo = new correspondenciaModel();
    $id_user = $_SESSION['idUsuario'];

    $lista_despachos  = $modelo->listar_despachos();
    
    $campos                 = 'usuario';
    $nombrelista            = 'pa_usuario_acciones';
    $idaccion               = '17';
    $campoordenar           = 'id';
    $jdatosusuarioacciones  = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $jusuarios              = $jdatosusuarioacciones->fetch();
    $usuariosAD             = explode("////",$jusuarios[usuario]);

    $idaccionUSCS       = '37';
    $datosUSacciones    = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccionUSCS,$campoordenar);
    $usCS               = $datosUSacciones->fetch();
    $usuariosCS         = explode("////",$usCS[usuario]);
    
    if ( in_array($_SESSION['idUsuario'],$usuariosCS) ) {
        $lista_despachos_USCS    = $modelo->listarJuzgadosUSCS($id_user);
    }
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
        <link rel="shortcut icon" href="views/images/logo_sscf.png" />
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
        <!---->
        <?php require 'header.php'; ?>
        <!---->
        <?php require 'secc_correspondencia.php'; ?>
        <!---->
        <table border="0" cellspacing="0" cellpadding="0" align="center">
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <div id="contenido">
                        <form  method="post" enctype="multipart/form-data" name="frm" id="frm">
                            <div id="titulo_frm">Listar Consolidado Plantilla 4-72</div>
                            <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
                                 <tr>
                                    <td><label style="width:151px; color:#666666">Fecha Inicial:</label></td>
                                    <td><input type="date" name="fechai" id="fechai" /></td>
                                    <td><label style="width:151px; color:#666666">Fecha Final:</label></td>
                                    <td><input type="date" name="fechaf" id="fechaf" /></td>				
                                </tr>
                                <tr>
                                    <td><label style="width:151px; color:#666666">Destinatario:</label></td>
                                    <td><input type="text" name="destinatario" id="destinatario" placeholder="Destinatario/Nº Oficio/Radicado" /></td>
                                
                                    <?php if ( in_array($_SESSION['idUsuario'],$usuariosAD) ) { ?>
                                
                                        <td><label style="width:151px; color:#666666">Despacho:</label></td>
                                        <td>
                                            <select name="despacho" id="despacho">
                                                <option value="0" selected="selected">Seleccione Despacho</option>
                                                <?php while($row = $lista_despachos->fetch()){ ?>
                                                    <option value="<?php echo utf8_encode($row['cod_usuario_juzgado']); ?>"><?php echo utf8_encode($row['nombre']); ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    <?php } else if($id_user>94 && $id_user<101){ ?>		
                                
                                        <td><label style="width:151px; color:#666666">Despacho:</label></td>
                                        <td>
                                            <select name="despacho" id="despacho">
                                                <option value="0" selected="selected">Seleccione Despacho</option>
                                                <?php while($row = $lista_despachos->fetch()){ ?>
                                                    <?php if($row['cod_usuario_juzgado'] == $id_user){ ?>
                                                    <option value="<?php echo utf8_encode($row['cod_usuario_juzgado']); ?>" selected><?php echo utf8_encode($row['nombre']); ?></option>
                                                <?php } ?>
                                                    <option value="<?php echo utf8_encode($row['cod_usuario_juzgado']); ?>" ><?php echo utf8_encode($row['nombre']); ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    <?php } else if ( in_array($_SESSION['idUsuario'],$usuariosCS) ) { ?>
                                        <td><label style="width:151px; color:#666666">Despacho:</label></td>
                                        <td>
                                            <select name="despacho" id="despacho">
                                                <?php while($row = $lista_despachos_USCS->fetch()){ ?>
                                                    <option value="<?php echo utf8_encode($row['cod_usuario_juzgado']); ?>"><?php echo utf8_encode($row['nombre']); ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>

                                    <?php }else{ ?>	
                                        <input type="hidden" name="despacho" id="despacho" value="<?php echo $_SESSION['idUsuario']; ?>" />
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><a id="btn_input" onclick="listar_consolidado()">Consultar </a></td>
                                    <td><input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar" /></td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table><br/>		
                        </form>
						<div id="load" style="display: none"></div>
                        <div class="filtro" id="listado_consolidado_guia"></div>   
                    </div>		
		</td>
            </tr>
            <tr><td>&nbsp;</td></tr>
        </table>
        <?php require 'alertas.php';?>
    </body>
</html>