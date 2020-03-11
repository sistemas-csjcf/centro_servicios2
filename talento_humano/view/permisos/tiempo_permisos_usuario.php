<?php
    require_once "../../core/conexion.php";
    $link = conectarse();
    $id_usuario = $_REQUEST['iduser'];
    $arr_fecha  = $_REQUEST['fecha'];
    $limite_tiempo = false;
    for($i = 0; $i < count($arr_fecha); $i++)
    {
        $fecha = new DateTime($arr_fecha[$i]);
        $fecha->modify('first day of this month');
        $fecha_ini = $fecha->format('Y-m-d');
        $fecha->modify('last day of this month');
        $fecha_fin = $fecha->format('Y-m-d');

        $sql = "SELECT SUM( 
                       CASE 
                         WHEN (per_fecha.hora_inicio >= '07:00' AND per_fecha.hora_inicio <= '12:00') AND 
                              (per_fecha.hora_final >= '14:00' AND per_fecha.hora_final <= '23:00') 
                         THEN TIMEDIFF( TIMEDIFF(per_fecha.hora_final, per_fecha.hora_inicio), '2:00' ) 
                         ELSE TIMEDIFF(per_fecha.hora_final, per_fecha.hora_inicio) 
                       END) AS duracion 
                FROM empleado_permiso_mayor emp_per 
                INNER JOIN empleado_permiso_mayor_fecha per_fecha 
                ON emp_per.id = per_fecha.id_permiso_mayor 
                WHERE emp_per.estado = 1 
                AND emp_per.idusuario = ". $id_usuario ."  
                AND per_fecha.fecha BETWEEN '". $fecha_ini ."' AND '". $fecha_fin ."';";
        $res = mysql_query($sql, $link);
        while($row = mysql_fetch_array($res))
        {
            $duracion = $row['duracion'];
        }
        $duracion_  = explode(".", $duracion);
        if($duracion_[0] > 240000)
        {
            $limite_tiempo = true;
        }
        if($limite_tiempo)
        {
            break;
        }
    }
    echo $limite_tiempo;
?>