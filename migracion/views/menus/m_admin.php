<?php  $imagen=$foto;?>
<style type="text/css">
    <!--
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
        width:385px;
        height:20px;
        z-index:1;
        left: -120px;
        top: 220px;
        text-align: center;
        margin-left:300px;
        text-align:rigth;
    }
    #apDiv3 {
        position:absolute;
        width:200px;
        height:20px;
        z-index:1;
        left: 670px;
        top: 220px; text-align:right;
    }
    -->
</style>
<img src="views/images/menu_admin1.png" width="900" height="310" border="0" usemap="#Map">
<div id="apDiv2"><?php echo $_SESSION['rol'];?></div>
<div id="apDiv1"><?php echo $_SESSION['cargo'];?></div>
<div id="apDiv3"><?php echo $_SESSION['nomusu'];?></div>
<div style="margin:-232px 50px 0px 720px"><img src="<?php echo $imagen;?>" width="110" height="125"/></div>
<map name="Map">
    <area shape="rect" coords="12,171,205,230" href="index.php?controller=menu&amp;action=mod_rrhh" title="Recurso Humano" />
    <area shape="rect" coords="241,171,436,230" href="index.php?controller=menu&amp;action=mod_qrs" title="Botones" />
    <area shape="rect" coords="470,170,663,229" href="index.php?controller=menu&amp;action=mod_reportes" title="Alimentos Y Bebidas" />
    <area shape="rect" coords="470,50,663,105" href="index.php?controller=menu&amp;action=mod_clientes" title="Clientes" />
    <area shape="rect" coords="241,48,435,103" href="index.php?controller=menu&amp;action=mod_ventas" title="Ventas" />
    <area shape="rect" coords="684,217,879,296" href="index.php?controller=menu&amp;action=mod_configuracion" title="Configuraci&oacute;n">
    <area shape="rect" coords="471,112,662,165" href="index.php?controller=menu&amp;action=mod_archivo" title="Archivo">
    <area shape="rect" coords="12,48,205,103" href="index.php?controller=menu&amp;action=mod_recepcion" title="Recepci&oacute;n">
    <area shape="rect" coords="243,114,435,167" href="index.php?controller=menu&amp;action=mod_eventos" title="Eventos">
    <area shape="rect" coords="12,111,206,163" href="index.php?controller=menu&amp;action=mod_mercadeo" title="Mercadeo">
    <area shape="rect" coords="12,235,205,291" href="index.php?controller=menu&amp;action=mod_controlInterno" title="Control Interno"/>
    <area shape="rect" coords="241,236,437,293" href="index.php?controller=menu&amp;action=mod_habitaciones" title="Habitaciones"/>
    <area shape="rect" coords="469,235,664,293" href="index.php?controller=menu&amp;action=mod_almacen" title="Almacen"/>
</map>