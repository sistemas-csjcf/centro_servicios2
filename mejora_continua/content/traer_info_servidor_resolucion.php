<?php
    //JUAN ESTEBAN MÙNERA BETANCUR
    require_once('../core/conexion.php');
    $link=conectarse();
    $id	 = trim($_GET['idvalor']);
    echo $id;
    $sql = "SELECT * FROM `th_servidores_resolucion` WHERE `ser_cedula` = '$id' AND ser_flag=1 ORDER BY ser_nombres";
    $res = mysql_query($sql,$link);
    while($fila = mysql_fetch_array($res)){
        $datos0  = $fila["ser_id"];
        $datos1  = $fila["ser_cedula"];
        $datos2  = $fila["ser_nombres"];
        
        $cadena .= $datos0."//////".$datos1."//////".$datos2;
    }
    echo trim(($cadena));
    mysql_close($link);
?>