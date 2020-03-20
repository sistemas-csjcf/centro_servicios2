<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=titulo?></title>
<script src="views/js/jquery.js" type="text/javascript"></script>
<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.validate.js" type="text/javascript"></script>
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
</head>
<body>
<!---->
<?php require 'header.php';/*if($_SESSION['rol']=='Administrador'){require 'header.php';}else{require 'headerproduccion.php';}*/  ?>
<!---->
<?php require 'secc_configuracion.php'; ?>
<!---->
    <table border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>
<div id="contenido">
<div id="titulo_frm">Cambiar Foto Personal</div>
<form action="" method="post" enctype="multipart/form-data" name="frm" id="frm">
<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
  <tr>
    <td width="250">Cargar Foto:</td>
    <td width="550"><input type="file" name="documento" id="txt_input" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Cambiar" id="btn_input">
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
</body>
</html>
