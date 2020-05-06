<?php
    //JUAN ESTEBAN MÙNERA BETANCUR
    require_once('../core/conexion.php');
    $link=conectarse();
    $id	 = trim($_GET['idvalor']);
    //echo $id;
    //$sql = "SELECT * FROM `th_servidores_resolucion` WHERE `ser_cedula` = '$id' AND ser_flag=1 ORDER BY ser_nombres";
    $sql = "SELECT t.`ser_id`, t.`ser_cedula`, t.`ser_nombres`, t.`ser_flag`, p.`id` AS iduser, p.`usuario_cargo_cs` AS cargo FROM th_servidores_resolucion t INNER JOIN pa_usuario p ON t.`ser_cedula` = p.`nombre_usuario` WHERE `ser_cedula` = '$id' AND ser_flag = 1 ORDER BY ser_nombres;";
    $res = mysql_query($sql,$link);
    while($fila = mysql_fetch_array($res)){
        $datos0  = $fila["iduser"];
        $datos1  = $fila["ser_cedula"];
        $datos2  = $fila["ser_nombres"];
        $datos3  = $fila["cargo"];
        
        $cadena .= $datos0."//////".$datos1."//////".$datos2."//////".$datos3;
    }
    echo trim(($cadena));
    mysql_close($link);
?>