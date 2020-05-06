<?php
    session_start();
    $id_usuario = $_SESSION['idUsuario'];
    include ("../../core/conexion.php");
    $link = conectarse();
    $result1=mysql_query("CALL Listar_Informe_Valoracion_SinEnviarD($id_usuario) ",$link);
    $numRow = mysql_num_rows($result1);
    if($numRow >0){
?>
        <span class="badge" id="badgeValoracionD"><?php echo $numRow; ?></span>
    <?php  } ?>