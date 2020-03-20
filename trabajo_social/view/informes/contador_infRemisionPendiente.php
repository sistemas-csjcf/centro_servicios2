<?php
    include ("../../core/conexion.php");
    $link = conectarse();
    $result1=mysql_query("SELECT * FROM lista_informe_remision; ",$link);
    $numero_filas = mysql_num_rows($result1);
    if($numero_filas >0){
?>
        <span class="badge" id="badgeInfRemision"><?php echo $numero_filas; ?></span>
    <?php } ?>