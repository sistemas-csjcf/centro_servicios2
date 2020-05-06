<?php
    include ("../../core/conexion.php");
    $link = conectarse();
    $result1=mysql_query("SELECT * FROM th_permiso_estudio WHERE per_est_estado =0; ",$link);
    $numero_filas = mysql_num_rows($result1);
    if($numero_filas >0){
?>
        <span class="badge" id="badge_permiso_estudio"><?php echo $numero_filas; ?></span>
    <?php } ?>