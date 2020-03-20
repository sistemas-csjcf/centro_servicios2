<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta content="text/html; charset=iso-8859-1" http-equiv=Content-Type>

<title><?php echo titulo?></title>

<script src="views/js/jquery.js" type="text/javascript"></script>

<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>

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
function vinculo(variable)
{
//alert(variable);
//location.href=variable;

 window.open(variable, "Evidencias", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=400, height=400")
//document.write(location.href) 

}
function vinculo_salir()
{
 
 location.href="index.php?controller=correspondencia&action=filtrar_otros";
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

<form id="frm" name="frm" method="post" action="">

<div id="titulo_frm">Consultar Correspondencia</div>

  <?php 

while($field = $datos_correspondencia->fetch()){

$idmedio= $field[idmedio];
?>

  <table border="0" align="center" cellpadding="0" cellspacing="0" id="frm_editar">

  <tr>

    <td width="150"><div id="txtnegro">Radicado:</div></td>

    <td width="272"><?php echo $field[radicado];?></td>

    <td width="150"><div id="txtnegro">Juzgado:</div></td>

    <td><?php echo $field[juzgado];?></td>
  </tr>

  <tr>
    <td><div id="txtnegro">Tipo Documento:</div></td>
    <td><?php echo $field[esOficio_Telegrama];?></td>
    <td><div id="txtnegro">N&uacute;mero:</div></td>
    <td><?php echo $field[numero];?></td>
  </tr>
  <tr>

    <td><div id="txtnegro">Destinatario:</div></td>

    <td><?php echo $field[destinatario];?></td>

    <td><div id="txtnegro">Direcci&oacute;n:</div></td>

    <td width="272"><?php echo $field[direccion];?></td>
    </tr>

  <tr>

    <td><div id="txtnegro">Departamento:</div></td>

    <td><?php echo $field[departamento];?></td>

    <td><div id="txtnegro">Municipio:</div></td>

    <td><?php echo $field[municipio];?></td>
    </tr>

  <tr>

    <td><div id="txtnegro">Notificado?:</div></td>

    <td><?php echo $field[notificado];?></td>

    <td><div id="txtnegro">Medio Notificaci&oacute;n:</div></td>

    <td><?php echo $field[medio];?></td>
  </tr>
  <tr>
    <td><div id="txtnegro">Fecha:</div></td>
    <td><?php echo $field[fecha];?></td>
    <td></td>
    <td>&nbsp;</td>
  </tr>
  </table>

  <?php }?>
  <table border="0" align="center" cellpadding="0" cellspacing="0" id="frm_editar">
<?php if(($idmedio==3) || ($idmedio==5) || ($idmedio==6)){


?>
  <tr>

    <td><div id="txtnegro">
      <div align="center"><strong>Evidencias</strong>:</div>
    </div>      <div id="txtnegro"></div></td>
    </tr>
<?php while($field2 = $datos_evidencia->fetch())
	{ ?>
  <tr>

<td style="cursor:pointer; text-decoration:underline" onclick="vinculo(<?php echo "'".$field2[evidenciaotros]."'"?>)"><?php echo $field2[evidenciaotros];?></td>
    </tr>
    <?php }}?>
  </table>

  <table border="0" align="center" cellpadding="0" cellspacing="0" id="frm_editar">
    <?php if(($idmedio==3) || ($idmedio==5) || ($idmedio==6)){


?>
    <tr>
      <td><div align="center">
        <input type="button" name="Submit" value="Cancelar" id="btn_input" onclick="vinculo_salir()" />
      </div></td>
    </tr>
    <?php while($field2 = $datos_evidencia->fetch())
	{ ?>
    <tr>
      <td style="cursor:pointer; text-decoration:underline" onclick="vinculo(<?php echo "'".$field2[evidenciaotros]."'"?>)">&nbsp;</td>
    </tr>
    <?php }}?>
  </table>
  <p>&nbsp;</p>
  <p>

  </p>
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

