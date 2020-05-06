<?php
    include ("../../core/conexion.php");
    $link = conectarse();
    $result1=mysql_query("SELECT * FROM th_permiso_ordinario WHERE estado =0; ",$link);
    $numero_filas = mysql_num_rows($result1);
    if($numero_filas >0){
?>
        <span class="badge" id="badge_permiso_mayor1"><?php echo $numero_filas; ?></span>
    <?php } ?>