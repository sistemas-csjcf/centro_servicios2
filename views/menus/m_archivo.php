<?php  $imagen=$foto;?>
<style type="text/css">
<!--
#apDiv1 {
	position:absolute;
	width:200px;
	height:20px;
	z-index:1;
	left: 385px;
	top: 220px;
}
#apDiv2 {
	position:absolute;
	width:200px;
	height:20px;
	z-index:1;
	left: 286px;
	top: 222px;
}
#apDiv3 {
	position:absolute;
	width:200px;
	height:20px;
	z-index:1;
	left: 776px;
	top: 220px;
}
-->
</style>
<img src="views/images/menu_archivo.png" width="900" height="310" border="0" usemap="#Map" />

<div id="apDiv2"><?php echo $_SESSION['rol'];?></div>
<div id="apDiv3"><?php echo $_SESSION['nombre'];?></div>
<div style="margin:-232px 50px 0px 720px"><img src="<?php echo $_SESSION['foto'];?>" width="110" height="125"/></div>

<map name="Map" id="Map">
  <area shape="rect" coords="684,186,878,296" href="index.php?controller=menu&amp;action=mod_configuracion" title="Configuraci&oacute;n" />

  <area shape="rect" coords="6,16,162,145" href="index.php?controller=menu&amp;action=mod_archivo" title="Archivo" />

</map>
