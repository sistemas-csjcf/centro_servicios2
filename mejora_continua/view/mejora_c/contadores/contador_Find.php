<?php
    session_start();
    
    $id_user = $_SESSION['idUsuario'];
    include ("../../../core/conexion.php");
    $link = conectarse();
    $result1=mysql_query("SELECT *
        FROM `mc_hallazgos` AS ha
        WHERE  hal_estado =0 AND`hal_id_user_responsable` = '$id_user' ",$link);
    $numero_filas = mysql_num_rows($result1);
    if($numero_filas >0){
?>
        <span class="badge" id="badge_mis_hallazgos"><?php echo $numero_filas; ?></span>
    <?php } ?>