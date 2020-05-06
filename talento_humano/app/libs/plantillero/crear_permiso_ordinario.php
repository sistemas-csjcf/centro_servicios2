<?php
    require_once "../../../core/conexion.php";
    require_once dirname(__FILE__).'/PHPWord-master/src/PhpWord/Autoloader.php';
    \PhpOffice\PhpWord\Autoloader::register();
    use PhpOffice\PhpWord\TemplateProcessor;
    $templateWord = new TemplateProcessor('plantilla_permiso_ordinario.docx');
    
    //Variables -->
    $id_doc    = $_REQUEST['id'];
    $per_mayor = $_REQUEST['per_mayor'];

    date_default_timezone_set('America/Bogota');
    //$fecha = date('Y-m-d');
    setlocale(LC_TIME, "Spanish");
    //$fecha = strftime('%d de %B de %Y', strtotime($fecha));
    //echo $fechaA = strftime('g:ia /o/n l jS F Y', strtotime($fecha));
    //echo $anno = date("Y", strtotime($fecha));
    $link = conectarse();

    if($per_mayor == "1")  // permiso mayor a un dia
    {
        $sql = "SELECT ep.id, us.nombre_usuario, us.empleado, ep.fecha_solicitud, ep.detalle, ep.num_resolucion, ep.fecha_aprobado    FROM (empleado_permiso_mayor ep 
                LEFT JOIN pa_usuario us 
                ON ep.idusuario = us.id) 
                WHERE ep.id = '$id_doc'";
    }
    else
    {
        $sql = "SELECT ep.id, ep.fecha_solicitud, ep.fecha_permiso, ep.hora_inicio, ep.hora_final, ep.detalle, ep.num_resolucion, pu.nombre_usuario, pu.empleado, ep.fecha_aprobado 
                FROM (empleado_permiso AS ep
                LEFT JOIN pa_usuario pu ON ep.idusuario = pu.id)
                WHERE ep.id = '$id_doc'";
    }
    $res = mysql_query($sql, $link);
    while($row = mysql_fetch_array($res))
    {
        $id_permiso      = $row['id'];
        $fecha_solicitud = $row['fecha_solicitud'];
        $fecha_permiso   = $row['fecha_permiso'];
        $fecha_aprobado  = $row['fecha_aprobado'];
        $empleado        = $row['empleado'];
        $num_res         = $row['num_resolucion'];
        $motivo          = $row['detalle'];
    }
    $fecha_larga = $fecha_aprobado;

    $fecha_aprobado = strftime('%d de %B de %Y', strtotime($fecha_aprobado));

    $dia_esc = strftime('%d', strtotime($fecha_solicitud));
    $mes_esc = strftime('%B', strtotime($fecha_solicitud));
    $anio_esc = strftime('%Y', strtotime($fecha_solicitud));
    $fecha_escrito = dia_en_letras($dia_esc) . " (" . $dia_esc . ") de " . $mes_esc . " de " . $anio_esc;

    //$fecha_permiso = "";
    if($per_mayor == "1")  // permiso mayor a un dia
    {
        $sql = "SELECT * FROM empleado_permiso_mayor_fecha WHERE id_permiso_mayor = '$id_permiso' ORDER BY fecha ASC;";
        $res = mysql_query($sql, $link);
        $cont = 0;
        while($row = mysql_fetch_array($res))
        {
            $fecha_perm_mayor[$cont] = $row['fecha'];
            $cont = $cont + 1;
        }
        if(count($fecha_perm_mayor) == 1)
        {
            $fecha_permiso = "el día " . strftime('%d de %B de %Y', strtotime($fecha_perm_mayor[0]));
        }
        else
        {
            for($i = 0; $i < count($fecha_perm_mayor); $i++)
            {
                if($i == (count($fecha_perm_mayor) - 1))
                {
                    $fecha_permiso .= strftime('%d', strtotime($fecha_perm_mayor[$i]));
                }
                else
                {
                    $fecha_permiso .= strftime('%d', strtotime($fecha_perm_mayor[$i])) . ", ";
                }
                //echo $fecha_permiso . "<br />";
            }
            $fecha_permiso = "los días " . $fecha_permiso . " de " . strftime('%B de %Y', strtotime($fecha_perm_mayor[0]));
        }
    }
    else
    {
        $fecha_permiso = "el día " . strftime('%d de %B de %Y', strtotime($fecha_permiso));
    }

    $dia_l = strftime('%d', strtotime($fecha_larga));
    $mes_l = strftime('%B', strtotime($fecha_larga));
    $anio_l = strftime('%Y', strtotime($fecha_larga));
    $fecha_larga = dia_en_letras($dia_l) . " (" . $dia_l . ") de " . $mes_l . " de " . anio_en_letras($anio_l) . " (" . $anio_l . ")";
    //echo ($fecha_escrito);
    //echo $fecha_permiso;
    
    // --- Asignamos valores
    //$templateWord->setValue('titulo', $titulo );
    $templateWord->setValue('num_resolucion', $num_res );
    $templateWord->setValue('fecha', $fecha_aprobado );
    $templateWord->setValue('fecha_escrito', $fecha_escrito );
    $templateWord->setValue('fecha_permiso', $fecha_permiso );
    $templateWord->setValue('nombre_servidor', $empleado );
    $templateWord->setValue('motivo', $motivo );
    $templateWord->setValue('fecha_larga', $fecha_larga );
   
    // --- Guardamos el documento

    $nombre_archivo = "R." . $num_res . " PERMISO " . $empleado . ".docx";

    $templateWord->saveAs($nombre_archivo);
    header("Content-Disposition: attachment; filename=" . $nombre_archivo . "; charset=iso-8859-1"); 
    echo file_get_contents($nombre_archivo);

    /*$templateWord->saveAs('permiso_ordinario.docx');
	header("Content-Disposition: attachment; filename=permiso_ordinario.docx; charset=iso-8859-1"); 
	echo file_get_contents('permiso_ordinario.docx');*/


    function dia_en_letras ($dia) 
    { 
        $dias = array  ('primero','dos','tres','cuatro','cinco','seis','siete','ocho','nueve','diez','once','doce','trece','catorce','quince','dieciséis','diecisiete','dieciocho','diecinueve','veinte','veintiuno','veintidós','veintitrés','veinticuatro','veinticinco','veintiséis','veintisiete','veintiocho','veintinueve','treinta','treinta uno');
        return utf8_decode($dias[$dia - 1]);
    }

    function anio_en_letras($anio)
    {
        $anios = array(2019 => 'dos mil diecinueve',
                       2020 => 'dos mil veinte',
                       2021 => 'dos mil veintiuno',
                       2022 => 'dos mil veintidós',
                       2023 => 'dos mil veintitrés',
                       2024 => 'dos mil veinticuatro',
                       2025 => 'dos mil veinticinco');
        return utf8_decode($anios[$anio]);
    }
?>