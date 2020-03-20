<?php
    include ("../../core/conexion.php");
    $link = conectarse();
    $result1=mysql_query("SELECT COUNT(*) AS total FROM `visitas_programacion` WHERE `vis_pro_estado` = 'Pendiente' ",$link);
    while($row=mysql_fetch_array($result1)){
        $total=$row["total"];	
    }
    if($total >0){
?>
        <span class="badge" id="badgeVPendientes"><?php echo $total; ?></span>
    <?php } ?>