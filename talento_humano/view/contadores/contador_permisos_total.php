<?php
    include ("../../core/conexion.php");
    $link = conectarse();
    $result1=mysql_query("SELECT * FROM th_permiso_estudio WHERE per_est_estado = 0; ",$link);
    $result2=mysql_query("SELECT * FROM th_permiso_ordinario WHERE estado =0; ",$link);
    $result3=mysql_query("SELECT * FROM empleado_permiso WHERE estado =2; ",$link);
    
    $numero_filas1 = mysql_num_rows($result1);
    $numero_filas2 = mysql_num_rows($result2);
    $numero_filas3 = mysql_num_rows($result3);
    //mysql_fetch_array
    $numero_filas = $numero_filas1+$numero_filas2+$numero_filas3;
    if($numero_filas >0 ){
?>
        <span class="badge" id="badge_permiso_estudio"><?php echo $numero_filas; ?></span>
    <?php } ?>