<?php
    require '../../conectar.php';
    $link=conectarse();
    session_start();
    $us = $_SESSION['idUsuario'];
    
    $datosusuarioaccionesAdminDev=mysql_query("SELECT * FROM pa_usuario_acciones WHERE id = 26 ",$link);
    while($rs = mysql_fetch_array($datosusuarioaccionesAdminDev)){
        $usAdmin_devoluciones  =  ($rs['usuario']);    
    }
    $usAdmin_devoluciones  = explode("////",$usAdmin_devoluciones);
    if ( in_array($us,$usAdmin_devoluciones) ) {
        $filtro_us =" ";
        $flag=1;
    }else{
        $filtro_us =" AND anot.idusuario = '$us' ";
        $flag=0;
    }
    $eventos=mysql_query("SELECT anot.id AS id , pro.radicado AS radicado, juz.nombre AS juzgado, anot.fecha_devolucion AS fecha_devolucion, 
                            anot.idusuario, par.nombre AS parte, flag_devolucion, us.empleado
                        FROM signot_proceso_anotacion AS anot
                        INNER JOIN signot_proceso AS pro ON anot.idradicado = pro.id
                        INNER JOIN pa_juzgado AS juz ON pro.idjuzgadoorigen = juz.id
                        INNER JOIN signot_parte AS par ON par.id = anot.id_parte
                        INNER JOIN pa_usuario AS us ON us.id = anot.idusuario
                        WHERE idtipoanotacion = 9 AND flag_devolucion =1".$filtro_us."GROUP BY anot.id; ",$link);
    date_default_timezone_set ("America/Bogota");
    while($all = mysql_fetch_assoc($eventos)){
        if($flag ==1){
            $fields = "ID: ".$all["id"].", Radicado: ".$all["radicado"].", Juzgado: ".$all["juzgado"]." ,Parte: ".$all['parte'].", usuario:".$all['empleado'];
        }else{
            $fields = "ID: ".$all["id"].", Radicado: ".$all["radicado"].", Juzgado: ".$all["juzgado"]." ,Parte: ".$all['parte'];
        }
        $var = strtotime($all["fecha_devolucion"])*1000;
        $e = array();
        $e['id'] = $all["id"];
        $e['start'] = $var;
        $e['title'] = $fields;
        $e['class'] = "event-warning";
        $result[] = $e;
    }
    echo json_encode(array('success' => 1, 'result' => $result));
