<?php $imagen=$foto; ?>
<style type="text/css">
    #apDiv1 {
        position:absolute;
        width:200px;
        height:20px;
        z-index:1;
        left: 420px;
        top: 220px;
        text-align: center;
    }
    #apDiv2 {
        position:absolute;
        width:210px;
        height:18px;
        z-index:1;
        left: 55px;
        top: 220px;
        margin-left:300px;
        text-align:rigth;
    }
    #apDiv3 {
        position:absolute;
        width:220px;
        height:19px;
        z-index:1;
        left: 765px;
        top: 220px;
        text-align:right;
    }
    .alertify-notifier .ajs-message.ajs-success {
        background: #418eb4 !important;
        border-radius: 5px;
        }
    .ajs-header {
        color: white !important;
        padding: 9px 24px !important;
    }
    ul {
        margin-left:14px;
    }
</style>
<!--<link rel="stylesheet" href="../../centro_servicios2/mejora_continua/assets/css/bootstrap.min.css" />-->
<script src="../../centro_servicios2/mejora_continua/assets/js/app/jquery-1.11.2.min.js"></script>
<script src="../../centro_servicios2/assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
    function validacion(){
        alert("Acceso denegado para este módulo, verifique la configuración de su perfil con el administrador del sistema");
    }
</script>
<link href="../../centro_servicios2/assets/css/alertify.min.css" rel="stylesheet"/>
<script src="../../centro_servicios2/assets/js/alertify.min.js"></script>
<script type="text/javascript">
    /*alertify.confirm("<center><strong>FELICES FIESTAS A TOD@S</strong></center><BR><BR>Después de un gran año de esfuerzo y de sacrificio ha llegado el momento de nuestra recompensa; la Navidad se presenta como un momento de relajación, de alegría, un momento para pasarlo en familia y para concentrarnos en lo más importante: la unión con los que más amamos.<br><br>Una gran felicidad nos invade a tod@s en el mes de diciembre, ya que este es un mes donde celebramos la Navidad y el año nuevo. Estas son fechas donde se percibe mayor calor humano, donde el cariño de la gente se encuentra en su mayor expresión. Se suelen hacer celebraciones, reuniones, cenas en familia y entregarse distintos tipos de obsequios. <br><br>Hasta un expectante, productivo y feliz año 2020.",  function() {
    alertify.success('visto');
  },
  function() {
    alertify.error('no');
  }
);*/
</script>
<img src="views/images/menu_admin.png" width="990" height="436" border="0" usemap="#Map">
<div id="apDiv2">
    <div align="right"><?php echo $rol = $_SESSION['id']; //echo $rol= $_SESSION['rol'];?></div>
</div>
<div id="apDiv3" style="width:400px; text-align:center"><?php echo utf8_encode($_SESSION['nombre']);?></div>
<div style="margin:-282px 50px 0px 760px"><img src="<?php echo $_SESSION['foto'];?>" width="110" height="125"/></div>
<?php header('Content-Type: text/html; charset=UTF-8'); ?>
<map name="Map">
    <!--    1ra linea-->
    <area shape="rect" coords="20,106,159,245" href="index.php?controller=reps&amp;action=regIngresoSalida" title="Sistema de Gestión de Recursos"/>
    <area shape="rect" coords="170,106,300,245" href="index.php?controller=menu&amp;action=mod_archivo" title="Archivo"/>
    <area shape="rect" coords="310,106,448,245" href="index.php?controller=menu&amp;action=mod_correspondencia" title="Correspondencia" />
    <area shape="rect" coords="455,106,590,245" href="index.php?controller=menu&action=mod_sidoju" title="Documentos Juzgados"/>
    <area shape="rect" coords="600,106,740,245" href="index.php?controller=menu&action=mod_signot" title="Notificaciones"/>
    <!--    2da linea-->
    <area shape="rect" coords="20,265,160,410" href="index.php?controller=menu&action=mod_caratula" title="Reparto"/>
    <area shape="rect" coords="170,265,300,410" href="index.php?controller=sigdoc&action=Registro_Documentos_Salientes" title="Documentos Entrantes y Salientes"/>
    <area shape="rect" coords="310,265,450,410" href="index.php?controller=menu&amp;action=mod_trabajo_social" title="Trabajo Social"/>
    <area shape="rect" coords="740,265,600,410" href="index.php?controller=menu&amp;action=mod_Segme" title="Seguimiento y Mejora"/>
    <!--  CONFIGURACIÒN-->
    <area shape="rect" coords="765,300,970,420" href="index.php?controller=menu&amp;action=mod_configuracion" title="Configuración"/>
    
    <area shape="rect" coords="840,720,990,420" href="index.php?controller=menu&amp;action=mod_audiencias" title="Audiencias"/>
</map>
<!--
<div class="alert alert-warning alert-dismissible" style="top: 180px;position: relative;text-align: left;width: 97%;left: 16px;border-radius: 9px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong><center>FELICES FIESTAS A TOD@S</center></strong>
    Después de un gran año de esfuerzo y de sacrificio ha llegado el momento de nuestra recompensa; la Navidad se presenta como un momento de relajación, de alegría, un momento para pasarlo en familia y para concentrarnos en lo más importante: la unión con los que más amamos.
	<br>
	Una gran felicidad nos invade a tod@s en el mes de diciembre, ya que este es un mes donde celebramos la Navidad y el año nuevo. Estas son fechas donde se percibe mayor calor humano, donde el cariño de la gente se encuentra en su mayor expresión. Se suelen hacer celebraciones, reuniones, cenas en familia y entregarse distintos tipos de obsequios. 
	<br>
	Hasta un expectante, productivo y feliz año 2020.
</div>
-->