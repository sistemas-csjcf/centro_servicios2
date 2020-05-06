<?php
    session_start();
    $id_usuario = $_SESSION['idUsuario'];
    include ("../../core/conexion.php");
    $link = conectarse();
    $result1=mysql_query("CALL Listar_VisitasTS_Aprobadas('$id_usuario') ",$link);
    $numero_filas = mysql_num_rows($result1);
    if ($numero_filas > 0) {
?>
    <span class="badge" id="badgeVPendientesTS"><?php echo $numero_filas; ?></span>
    <?php } ?>