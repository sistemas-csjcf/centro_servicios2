<?php
    session_start();
    
    $id_user = $_SESSION['idUsuario'];
    include ("../../../core/conexion.php");
    $link = conectarse();
    $result1=mysql_query("SELECT *
                FROM `mc_tareas`
                WHERE `tar_id_user_responsable` = '$id_user' AND tar_estado=0; ",$link);
    $numero_filas = mysql_num_rows($result1);
    if($numero_filas >0){
?>
        <span class="badge" id="badge_mis_tareas_admin"><?php echo $numero_filas; ?></span>
    <?php } ?>