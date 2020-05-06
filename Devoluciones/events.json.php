<?php
    require '../../conectar.php';
    $link=conectarse();
   
    $eventos=mysql_query("SELECT count(*) AS cantidad, pro.radicado AS radicado ,pro.idjuzgadoorigen AS IDjuzgado, juz.nombre AS juzgado, 
        pa.fecha_gestionAgotada as fecha, pro.id AS id, us.empleado AS nombreLider
        FROM signot_proceso AS pro
        INNER JOIN signot_proceso_anotacion AS pa ON pro.id = pa.idradicado
        INNER JOIN pa_juzgado AS juz ON pro.idjuzgadoorigen = juz.id
        INNER JOIN pa_usuario AS us ON us.id = juz.idusuariojuzgadocargo
        WHERE pa.mostrar_alerta ='1'
        GROUP BY pro.id; ",$link);
    date_default_timezone_set ("America/Bogota");
    while($all = mysql_fetch_assoc($eventos)){
        $var = strtotime($all["fecha"])*1000;
        $e = array();
        $e['id'] = $all["id"];
        $e['start'] = $var;
        $e['title'] = "ID: ".$all["id"].", Radicado: ".$all["radicado"].", Juzgado: ".$all["juzgado"].", Líder notificaciones: ".$all['nombreLider'];
        $e['class'] = $all["event-important"];
        $result[] = $e;
    }
    echo json_encode(array('success' => 1, 'result' => $result));
?>