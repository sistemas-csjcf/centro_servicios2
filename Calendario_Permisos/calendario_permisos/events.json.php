<?php
    require '../../conectar.php';
    $link=conectarse();
   
    $eventos=mysql_query("SELECT  per.id AS id, per.idusuario, fecha_permiso AS fecha, hora_inicio, hora_final, detalle, us.empleado AS usuario, estado
            FROM empleado_permiso AS per
            INNER JOIN pa_usuario AS us ON us.id = per.idusuario
            WHERE estado ='1'; ",$link);
    date_default_timezone_set ("America/Bogota");
    while($all = mysql_fetch_assoc($eventos)){
        $var = strtotime($all["fecha"])*1000;
        $e = array();
        $e['id'] = $all["id"];
        $e['start'] = $var;
        $e['title'] = "ID: ".$all["id"].", Empleado: ".$all["usuario"].", Detalle: ".$all["detalle"].", DESDE: ".$all["hora_inicio"]." HASTA ".$all["hora_final"];
        $e['class'] = "event-info";
        $result[] = $e;
    }
    echo json_encode(array('success' => 1, 'result' => $result));
?>