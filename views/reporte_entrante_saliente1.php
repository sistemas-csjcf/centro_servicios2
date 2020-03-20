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
variable1=frm.fechai.value;
variable2=frm.fechaf.value;
variable=frm.juzgado.value;

//alert(variable);

location.href="index.php?controller=archivo&action=ReporteEntrantesSalientes1&nombre="+variable+"&nombre1="+variable1+"&nombre2="+variable2;
//document.write(location.href) 

}
</script>
</head>
<body>
<!---->
<?php require 'header.php'; ?>
<!---->
<?php require 'secc_archivo.php'; ?>
<!---->
    <table border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td></td>
      </tr>
      <tr>
        <td>
<div id="contenido">
<form action="" method="post" enctype="multipart/form-data" name="frm" id="frm">

<div id="titulo_frm">Reporte Entrantes vs Salientes Juzgado:    <?php
 while($fieldi = $nombre_juzgado->fetch()){
 echo $fieldi[nombre];
 }
  
 ?></div>
<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
    <tr>
      <td>&nbsp;</td>
      <?php
 while($fielde = $datos_entrantes->fetch()){
       $cajase=$fielde[cajasentrantes];
	   $expee=$fielde[expentrantes];
 }
  while($fields = $datos_salientes->fetch()){
        $cajass=$fields[cajassalientes];
	    $expes=$fields[expsalientes];
 }
  $pendiente_caja= $cajase-$cajass;
  $pendiente_expe= $expee-$expes;
  
 ?>
      <td><strong> Entrantes</strong></td>
      <td><strong>Salientes</strong></td>
      <td><strong>Pendientes</strong></td>
    </tr>
      <tr>
      <td><strong>Cajas:</strong></td>
      <td><?php echo  $cajase; ?>	</td>
      <td><?php echo  $cajass; ?></td>
      <td><?php echo  $pendiente_caja; ?></td>
      </tr>
      <tr>
        <td><strong>Expedientes:</strong></td>
        <td><?php echo  $expee; ?></td>
        <td><?php echo  $expes; ?></td>
        <td><?php echo  $pendiente_expe; ?></td>
      </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
</table>
</form>
</div>		
		</td>
      </tr>
      <tr>
        <td></td>
      </tr>
    </table>
    <?php require 'alertas.php';?>
</body>
</html>
