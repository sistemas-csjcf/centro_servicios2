<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title><?php echo titulo ?></title>
<script src="views/js/jquery.js" type="text/javascript"></script>
<script src="views/js/jquery.validate.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
<script src="views/js/jquery.index.js" type="text/javascript"></script>
<link href="views/css/index.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
</head>
<body>
<div id="ppal">
<form id="frmLogin" name="frmLogin" action="" method="post">
<div id="logo">
</div>
<div id="formulario">
	<div id="bglogin">	
	  <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	  <label for="user"><span class="Estilo1">Nombre Usuario</span></label>
      <input name="user" type="text" class="required" id="campotext" size="30">
	  
	  <label for="pass"><span class="Estilo1">Contrase�a</span></label>
	  <input name="pass" type="password" id="campotext" class="required" size="30">
	  <input name="ingresar" type="submit" id="botonenviar" value="Iniciar Sesi�n">
	<br/><br/><br/>
	<br />
	<br />
	</div>

    	
	
</div>
</form>
<?php require 'alertas.php'; echo $_SESSION['idperfil']; ?>
</div>
</body>
</html>