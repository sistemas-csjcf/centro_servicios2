<?php
    require_once "../../core/conexion.php";
    $link = conectarse();

    //$f = "2018-12-18";
    //$f_ = explode('-', $f);
    //echo $f_[1] . "<br />";

    $id_usuario = $_REQUEST['iduser'];
    $arr_fecha  = $_REQUEST['fecha'];
    $arr_horai  = $_REQUEST['horai'];
    $arr_horaf  = $_REQUEST['horaf'];
    //echo $arr_horai;
    //echo Diferencia_Horas($arr_horai, $arr_horaf);

    $meses;
    $fechas;
    $horas;
    $limite_tiempo = "no";

    for($i = 0; $i < count($arr_fecha); $i++)
    {
        $mes_ = explode('-', $arr_fecha[$i]);
        if(!(in_array($mes_[1], $meses)))
        {
            $meses[$i]  = $mes_[1];
            $fechas[$i] = $arr_fecha[$i];
            $duration   = explode(".", Diferencia_Horas($arr_horai[$i], $arr_horaf[$i]));
            $horas[$i]  = $duration[0];
            //$horas[$i]  = Diferencia_Horas($arr_horai, $arr_horaf);
        }
        else
        {
            $duration   = explode(".", Diferencia_Horas($arr_horai[$i], $arr_horaf[$i]));
            $horas[$i - 1] = $horas[$i - 1] + $duration[0];
        }
    }

    /*for($i = 0; $i < count($fechas); $i++)
    {
        echo $fechas[$i] . " " . $horas[$i] . "<br />";
    }*/

    for($i = 0; $i < count($fechas); $i++)
    {
        $fecha = new DateTime($fechas[$i]);
        $fecha->modify('first day of this month');
        $fecha_ini = $fecha->format('Y-m-d');
        $fecha->modify('last day of this month');
        $fecha_fin = $fecha->format('Y-m-d');

        // Consulta de tiempo de permisos basico.
        $sql = "SELECT SUM( 
                       CASE 
                         WHEN (per.hora_inicio >= '07:00' AND per.hora_inicio <= '12:00') AND 
                              (per.hora_final >= '14:00' AND per.hora_final <= '23:00') 
                         THEN TIMEDIFF( TIMEDIFF(per.hora_final, per.hora_inicio), '2:00' ) 
                         ELSE TIMEDIFF(per.hora_final, per.hora_inicio) 
                       END) AS duracion 
                FROM empleado_permiso per 
                WHERE per.estado = 1 
                AND per.idusuario = ". $id_usuario ."  
                AND per.fecha_permiso BETWEEN '". $fecha_ini ."' AND '". $fecha_fin ."';";
        $res = mysql_query($sql, $link);
        while($row = mysql_fetch_array($res))
        {
            $duracion = $row['duracion'];
        }
        $duracion_basico  = explode(".", $duracion);
        //echo $duracion_basico[0] . "<br />";

        // Consulta de tiempo de permisos mayores a 1 dia.
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
        //echo $duracion[0] . "<br />" . $horas[$i] . "<br />" . ($duracion_basico[0] + $duracion_[0] + $horas[$i]);

        if(($duracion_basico[0] + $duracion_[0] + $horas[$i]) > 240000)
        {
            $limite_tiempo = "si";
        }
        if($limite_tiempo == "si")
        {
            break;
        }
    }
    
    echo $limite_tiempo;  // si = llego al limite de permisos por mes (3 dìas de permisos por mes)

    function Diferencia_Horas($horai, $horaf)
    {
        $link = conectarse();
        $sql = "SELECT 
                SUM(CASE 
                WHEN
                    ('$horai' >= '07:00' AND '$horai' <= '12:00') AND 
                      ('$horaf' >= '14:00' AND '$horaf' <= '23:00')
                    THEN
                        TIMEDIFF( TIMEDIFF('$horaf', '$horai'),'2:00')
                    ELSE
                        TIMEDIFF('$horaf', '$horai')
                END) AS duracion;";
        //echo $sql;
        $res = mysql_query($sql, $link);
        while($row = mysql_fetch_array($res))
        {
            $duracion = $row['duracion'];
        }
        return $duracion;
    }
?>