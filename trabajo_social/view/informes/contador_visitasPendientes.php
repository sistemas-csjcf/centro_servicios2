<?php
    include ("../../core/conexion.php");
    $link = conectarse();
    //$result1=mysql_query("SELECT COUNT(*) AS total FROM `visitas_programacion` WHERE `vis_pro_estado` = 'Pendiente' ",$link);
    // Se corrige la consulta y se realiza conforme se encuentra la premisa de búsqueda para listar las visitas pendientes.
    $result1=mysql_query("
    select count(*) AS total from (`visitas_programacion` `prog_vis` join `visitas_trabajador_social` `tsoc` on(`prog_vis`.`vis_pro_id_TSocial` = `tsoc`.`vis_TSoci_id`))
    where `prog_vis`.`vis_pro_estado` = 'Pendiente'
    ",$link);
    while($row=mysql_fetch_array($result1)){
        $total=$row["total"];
    }
    if($total >0){
?>
        <span class="badge" id="badgeVPendientes"><?php echo $total; ?></span>
    <?php } ?>
