<?PHP
    $modelo                 = new correspondenciaModel();
    $subir_doc              = $modelo->permisos_subir_doc_472();
    $jusuarios              = $subir_doc->fetch();
    $accion_subir_doc       = explode("////",$jusuarios[usuario]);
    $lista_tipo_envio       = $modelo->listar_tipo_envio();
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
        <link href="views/css/pepper-grinder/ui.all.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
        <link href="views/css/main.css" rel="stylesheet" type="text/css" />
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
        <script>
            function vinculo(){

                var documento = document.getElementById('archivo').value;
                var fecha = document.getElementById('fecha_admision').value;
                var tipo = document.getElementById('tipo_envio').value;
                var status = 1;

                if (documento == ""){
                  document.getElementById('archivo').style.color = "solid 1px #ff0b0b";
                  $('#msgT').css({'width':'788px','margin':'0px auto 0px auto','border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px','display':'block'});
        					$('#msgT').html("No ha seleccionado ningun archivo.");
                  status = 0;
                } else if (fecha == ""){
                  document.getElementById('fecha_admision').style.color = "solid 0px #ff0b0b";
                  $('#msgT').css({'width':'788px','margin':'0px auto 0px auto','border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px','display':'block'});
        					$('#msgT').html("Debe ingresar la fecha de admisión de 4-72.");
                  status = 0;
                } else if (tipo == ""){
                  document.getElementById('tipo_envio').style.color = "solid 0px #ff0b0b";
                  $('#msgT').css({'width':'788px','margin':'0px auto 0px auto','border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px','display':'block'});
        					$('#msgT').html("Debe seleccionar un tipo de envío.");
                  status = 0;
                }

                if (status == 1){
                  $("#msgT").css({display: "none"});
                  $(".non").css({display: "none"});
                  document.getElementById("loadContent").style.display = "block";
                  $(".load").css("background-image", 'url(../centro_servicios2/assets/imagenes/loading.gif)');
                  setTimeout(function(){ $("#frm").submit(); }, 1000);
                }
            }

            function check() {
                if(document.getElementById('todos').checked){
                    //alert("si");
                    for(var i = 0; i<document.frm.elements.length; i++ )
                        if(document.frm.elements[i].type == "checkbox")
                            document.frm.elements[i].checked=1
                }else{
                    //alert("no");
                    for (i=0;i<document.frm.elements.length;i++)
                        if(document.frm.elements[i].type == "checkbox")
                            document.frm.elements[i].checked=0
                }

            }
        </script>
    </head>
    <body>
        <!---->
        <?php require 'header.php'; ?>
        <!---->
        <?php
            require 'secc_correspondencia.php';
            //FECHA ACTUAL
            date_default_timezone_set('America/Bogota');
            $fecha=date('Y-m-d');
        ?>
        <!---->
        <table border="0" cellspacing="0" cellpadding="0" align="center">
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <div id="contenido">
                        <form class="non" action="?controller=correspondencia&action=subir_consolidado" method="post" enctype="multipart/form-data" name="frm" id="frm">
                            <div id="titulo_frm">Generar Consolidado Plantilla 4-72</div>
                            <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
                                <tr>
                                    <td>Documento</td>
                                    <td><input id="archivo" accept=".csv" name="archivo" type="file" /> </td>
                                        <input name="MAX_FILE_SIZE" type="hidden" value="20000" />
                                </tr>
                                <tr>
                                    <td>Fecha Admisión 4-72</td>
                                    <td><input type="date" name="fecha_admision" id="fecha_admision"></td>
                                </tr>
                                <tr>
                                    <td>Tipo Envío</td>
                                    <td>
                                        <select name="tipo_envio" id="tipo_envio">
                                          <option value="">SELECCIONE</option>
                                            <?php while($row = $lista_tipo_envio->fetch()){ ?>
                                                <option value="<?php echo utf8_encode($row['tipo_envio_id']); ?>"><?php echo utf8_encode($row['tipo_envio_nombre']); ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>
                                        <input name="Submit" value="Generar" id="btn_input" onclick="vinculo(frm)" />
                                        <input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <div id="msgT"></div>
                        <div id="loadContent" class="loadContent">
      										<div id="load" class="load"></div>
      										<b>Cargando...</b>
      									</div>
                    </div>
		        </td>
            </tr>
            <tr><td>&nbsp;</td></tr>
        </table>
        <?php require 'alertas.php';?>
    </body>
</html>
