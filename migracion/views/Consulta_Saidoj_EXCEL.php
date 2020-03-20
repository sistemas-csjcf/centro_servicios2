<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
        <title><?php echo titulo?></title>
        <script src="views/js/jquery.js" type="text/javascript"></script>
        <script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
        <script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
        <script src="views/js/jquery.validate.js" type="text/javascript"></script>
        <script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                    	
        <link href="views/css/pepper-grinder/ui.all.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8" />
        <link href="views/css/main.css" rel="stylesheet" type="text/css" />
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
            function limpiar(frm){
                frm.radicado.value ="";
                frm.fechai.value ="";
                frm.fechaf.value ="";
                frm.esoficio_telegrama.value ="";
                frm.oficio_telegrama.value ="";
                frm.parte.value ="";
                frm.direccion.value ="";
            }
            function consultar(frm){
                variable=1;
                variable1=frm.anio.value;
                variable2=frm.juzgado.value;
                if(variable1 != "" || variable2 != ""){
                    location.href="index.php?controller=migracion&action=excel_consulta&nombre="+variable+"&nombre1="+variable1+"&nombre2="+variable2;
                }else{
                    alert("Por favor ingrese al menos un valor en los campos del formulario");
                    document.getElementById("txt_input").style.border = "1px solid #7FFFD4"; 
                    document.getElementById("txt_inputJ").style.border = "1px solid #7FFFD4";
                }
            }
            function llenar(frm,op){
                if(op==1){
                   for (i=0;i<document.frm.elements.length;i++) 
                      if(document.frm.elements[i].type == "checkbox")	
                         document.frm.elements[i].checked=1 
                }
                if(op==2){
                   for (i=0;i<document.frm.elements.length;i++) 
                      if(document.frm.elements[i].type == "checkbox")	
                         document.frm.elements[i].checked=0 
                }
            }
            function activar_acc(frm,i){
                x= document.getElementById("op"+i).checked;
                if(x==true){
                    document.getElementById("anio"+i).disabled=false;
                    document.getElementById("ncaja"+i).disabled=false;
                    document.getElementById("cons"+i).disabled=false;
                 }else{
                    document.getElementById("anio"+i).value="";
                    document.getElementById("ncaja"+i).value="";
                    document.getElementById("cons"+i).value="";
                    document.getElementById("anio"+i).disabled=true;
                    document.getElementById("ncaja"+i).disabled=true;
                    document.getElementById("cons"+i).disabled=true;
                 }
            } 
        </script>
    </head>
    <body>
        <!---->
        <?php require 'header.php'; ?>
        <!---->
        <?php require 'secc_migracion.php'; ?>
        <!---->
        <?php
            /*SERV-JUSTICIA2
            local
            consejoPN
            T103DAINFOPROC
            A103LLAVPROC
            */
        ?>
        <table border="0" cellspacing="0" cellpadding="0" align="center">
            <tr><td><img src="views/images/crm_fondo_top.png" width="954" height="40" /></td></tr>
            <tr>
                <td style="background:url(views/images/crm_fondo_body.png) repeat-y;">
                    <div id="contenido">
                        <form action="" method="post" enctype="multipart/form-data" name="frm" id="frm">
                            <div id="titulo_frm">Consulta SAIDOJ EXCEL</div>
                            <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
                                <tr>
                                    <td width="157">A&ntilde;o:</td>
                                    <td width="346">
                                        <script type="text/javascript" charset="utf-8">
                                            jQuery(document).ready(function(){
                                                jQuery(".tinicio").datepicker({ changeFirstDay: false });
                                            });
                                        </script>	
                                        <label>
                                            <input type="text" name="anio" id="txt_input" class="required number" size="4" maxlength="4" minlength="4" />
                                        </label>
                                    </td>
                                    <td width="107">Juzgado:</td>
                                    <td width="148">
                                        <input type="text" name="juzgado" id="txt_inputJ"  class="required number" maxlength="12" value="17001" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>
                                        <input name="opcion" type="hidden" value="" />
                                        <input type="button" name="Submit" value="Consultar" id="btn_input" onclick="consultar(frm)" />
                                        <input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </form>
                    </div>		
                </td>
            </tr>
            <tr><td><img src="views/images/crm_fondo_foot.png" width="954" height="40" /></td></tr>
        </table>
        <?php require 'alertas.php';?>
    </body>
</html>