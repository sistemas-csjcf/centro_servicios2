<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo titulo?></title>
<script src="views/js/jquery.js" type="text/javascript"></script>
<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
<script src="views/js/jquery.validate.js" type="text/javascript"></script>
<script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                    	
<link href="views/css/pepper-grinder/ui.all.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
<link href="views/css/main.css" rel="stylesheet" type="text/css">
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
function vinculo(frm)
{
variable=2;
variable1=frm.fechai.value;
variable2=frm.fechaf.value;
//alert(variable);

location.href="index.php?controller=archivo&action=ReporteProduccionRango1&nombre="+variable+"&nombre1="+variable1+"&nombre2="+variable2;
//document.write(location.href) 

}
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
<form action="" method="post" enctype="multipart/form-data" name="frm" id="frm">
<div id="titulo_frm">Reporte Dirección Rango Fechas</div>
<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
    <tr>
      <td>Seleccione la fecha Inicial:</td>
      <td><input name="fechai" type="text" class="required tinicio" id="txt_input" readonly="readonly"/>
	<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function()
			{
			  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
			});
	</script>	</td>
    </tr>
      <tr>
      <td>Seleccione la fecha Final:</td>
      <td><input name="fechaf" type="text" class="required tinicio" id="txt_input" readonly="readonly"/>
	<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function()
			{
			  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
			});
	</script>	<input name="tipo_reporte" type="hidden" id="tipo_reporte" value="direccion" /></td>
    </tr>
      <tr>
        <td>Ingrese el Consecutivo:</td>
        <td><input type="text" name="consecutivo" id="txt_input" class="required" /></td>
      </tr>
   <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Consultar" id="btn_input" >
      <input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/></td>
  </tr>
</table>
</form>
</div>		
		</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
    <?php require 'alertas.php';?>
</body>
</html>
