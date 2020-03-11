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
                var a=document.frm['despacho[]'];
                    
                var values = [];
                //alert("Tamaño del array"+a.length);
                var p=0;
                for(i=0;i<a.length;i++){
                    if(a[i].checked){
                        alert(a[i].value);
                        values.push(a[i].value);
                        p=1;
                    }
                }
                var cadena = values.join(',');
                //alert(cadena);
                if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                }
                else{// code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                        document.getElementById("arreglo_despachos").innerHTML=xmlhttp.responseText;
                    }
                }
            };
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
                        <form action="?controller=correspondencia&action=subir_consolidado" method="post" enctype="multipart/form-data" name="frm" id="frm">
                            <div id="titulo_frm">Generar Consolidado Plantilla 4-72</div>
                            <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
                                <tr>
                                    <td>Documento</td>
                                    <td><input id="archivo" accept=".csv" name="archivo" type="file" /> </td>
                                        <input name="MAX_FILE_SIZE" type="hidden" value="20000" /> 
                                </tr>
                                <tr>
                                    <td>Fecha Admisión 4-72</td>
                                    <td><input type="date" name="fecha_admision" id="fecha_admision" required=""></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>
                                        <input type="submit" name="Submit" value="Generar" id="btn_input" onclick="vinculo(frm)" />
                                        <input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tipo Envío</td>
                                    <td>
                                        <select name="tipo_envio" id="tipo_envio">
                                            <?php while($row = $lista_tipo_envio->fetch()){ ?>
                                                <option value="<?php echo utf8_encode($row['tipo_envio_id']); ?>"><?php echo utf8_encode($row['tipo_envio_nombre']); ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>		
		        </td>
            </tr>
            <tr><td>&nbsp;</td></tr>
        </table>
        <?php require 'alertas.php';?>
    </body>
</html>