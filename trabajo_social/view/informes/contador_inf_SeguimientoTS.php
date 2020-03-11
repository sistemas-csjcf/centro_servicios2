<?php
    session_start();
    $id_usuario = $_SESSION['idUsuario'];
    include ("../../core/conexion.php");
    $link = conectarse();
    $result1=mysql_query("CALL Listar_Informe_Seguimiento_SinEnviar('$id_usuario') ",$link);
    $numero_filas = mysql_num_rows($result1);
    if($numero_filas >0){
?>
    <span class="badge" id="badgeInfSeguimientoTS"><?php echo $numero_filas; ?></span>
    <?php } ?>