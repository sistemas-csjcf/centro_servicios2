<?php
    include ("../../core/conexion.php");
    $link = conectarse();
    $result1=mysql_query("SELECT count(*) as total FROM `visitas_informe_valoracion` WHERE `inf_val_visto` = '0' ",$link);
    while($row=mysql_fetch_array($result1)){
        $total=$row["total"];	
    }
    if($total >0){
?>
        <span class="badge" id="badge"><?php echo $total; ?></span>
    <?php } ?>
