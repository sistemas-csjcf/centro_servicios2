<?php
    include ("../../core/conexion.php");
    $link = conectarse();
    $result1=mysql_query("SELECT * FROM empleado_permiso WHERE estado =2; ",$link);
    $numero_filas = mysql_num_rows($result1);
    if($numero_filas >0){
?>
        <span class="badge" id="badge_permiso_menor1"><?php echo $numero_filas; ?></span>
    <?php } ?>