<?php
    require_once "../../../core/conexion.php";
    require_once dirname(__FILE__).'/PHPWord-master/src/PhpWord/Autoloader.php';
    \PhpOffice\PhpWord\Autoloader::register();
    use PhpOffice\PhpWord\TemplateProcessor;
    $templateWord = new TemplateProcessor('plantilla_permiso_estudio.docx');
    
    //Variables -->
    $id_doc    = $_REQUEST['id'];
    //$per_mayor = $_REQUEST['per_mayor'];

    date_default_timezone_set('America/Bogota'); 
    //$fecha = date('Y-m-d');
    setlocale(LC_TIME, "Spanish");
    //$fecha = strftime('%d de %B de %Y', strtotime($fecha));
    //echo $fechaA = strftime('g:ia /o/n l jS F Y', strtotime($fecha));
    //echo $anno = date("Y", strtotime($fecha));
    $link = conectarse();

    $sql = "SELECT
                per.per_est_id,
                per.per_est_num_resolucion,
                per.per_est_fecha_solicitud,
                per.per_est_fechaE,
                per.per_est_id_usuario,
                per.per_est_cedula,
                per.per_est_nombre,
                per.per_est_institucion,
                per.per_est_programa,
                per.per_est_fecha_inicio,
                per.per_est_fecha_final,
                per.per_est_estado, 
                per.per_est_periodo_academico
            FROM 
                th_permiso_estudio per 
            WHERE per.per_est_id = $id_doc;";
    $res = mysql_query($sql, $link);
    while($row = mysql_fetch_array($res))
    {
        $fecha_aprob = $row['per_est_fechaE'];
        $num_res     = $row['per_est_num_resolucion'];
        $cedula      = $row['per_est_cedula'];
        $empleado    = $row['per_est_nombre'];
        $institucion = $row['per_est_institucion'];
        $carrera     = $row['per_est_programa'];
        $per_academ  = $row['per_est_periodo_academico'];
        $fecha_ini   = $row['per_est_fecha_inicio'];
        $fecha_fin   = $row['per_est_fecha_final'];
    }
    $dia = strftime('%d', strtotime($fecha_aprob));
    $mes = strftime('%B', strtotime($fecha_aprob));
    $anio = strftime('%Y', strtotime($fecha_aprob));
    $fecha_larga = dia_en_letras($dia) . " (" . $dia . ") de " . $mes . " de " . anio_en_letras($anio) . " (" . $anio . ")";

    $fecha_aprob = strftime('%d de %B de %Y', strtotime($fecha_aprob));
    $cedula = number_format($cedula, 0, ',', '.,');

    $fecha_ini_ = strftime('%d de %B de %Y', strtotime($fecha_ini));
    $fecha_fin_ = strftime('%d de %B de %Y', strtotime($fecha_fin));
    $horario = $fecha_ini_ . " hasta el " . $fecha_fin_ . ", los días ";
    $sql = "SELECT
                th_permiso_horario.per_hor_id,
                th_permiso_horario.per_hor_id_permisoEstudio,
                th_permiso_horario.per_hor_cod_dia,
                th_permiso_horario.per_hor_dia,
                th_permiso_horario.per_hor_hora_inicio,
                th_permiso_horario.per_hor_hora_fin,
                th_permiso_horario.per_hor_flag,
                th_permiso_horario.per_hor_hora_inicio1,
                th_permiso_horario.per_hor_hora_fin1
            FROM th_permiso_horario 
            WHERE th_permiso_horario.per_hor_id_permisoEstudio = $id_doc  
            AND th_permiso_horario.per_hor_cod_dia != 0";
    $res_ = mysql_query($sql, $link);
    while($row = mysql_fetch_array($res_))
    {
        $horario .= $row['per_hor_dia'] . " de " . date("g:i a", strtotime($row['per_hor_hora_inicio'])) . " a " . date("g:i a", strtotime($row['per_hor_hora_fin']));
        if($row['per_hor_flag'] != 0)
        {
            $horario .= " y de " . date("g:i a", strtotime($row['per_hor_hora_inicio1'])) . " a " . date("g:i a", strtotime($row['per_hor_hora_fin1'])) . "";
        }
        else
        {
            $horario .= ", ";
        }
    }
    //echo utf8_decode ($horario);
    // --- Asignamos valores
    $templateWord->setValue('num_resolucion', $num_res );
    $templateWord->setValue('fecha', $fecha_aprob );
    $templateWord->setValue('cedula', $cedula );
    $templateWord->setValue('nombre_servidor', $empleado );
    $templateWord->setValue('institucion', $institucion );
    $templateWord->setValue('carrera', $carrera );
    $templateWord->setValue('periodo_academico', $per_academ );
    $templateWord->setValue('horario', $horario );
    $templateWord->setValue('fecha_larga', $fecha_larga );
   
    // --- Guardamos el documento

    $nombre_archivo = "R." . $num_res . " PERMISO DE ESTUDIO " . $empleado . ".docx";

    $templateWord->saveAs($nombre_archivo);
    header("Content-Disposition: attachment; filename=" . $nombre_archivo . "; charset=iso-8859-1"); 
    echo file_get_contents($nombre_archivo);

    /*$templateWord->saveAs('permiso_estudio.docx');
	header("Content-Disposition: attachment; filename=permiso_estudio.docx; charset=iso-8859-1"); 
	echo file_get_contents('permiso_estudio.docx');*/



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