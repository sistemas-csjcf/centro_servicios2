<?php
    require_once "../../../core/conexion.php";
    require_once dirname(__FILE__).'/PHPWord-master/src/PhpWord/Autoloader.php';
    \PhpOffice\PhpWord\Autoloader::register();
    use PhpOffice\PhpWord\TemplateProcessor;
    
    
    //Variables -->
    $id    = $_REQUEST['id'];
    date_default_timezone_set('America/Bogota'); 
    $fecha = date('Y-m-d');
    setlocale(LC_TIME, "Spanish");
    $fecha = strftime('%d de %B de %Y', strtotime($fecha));
    
    $link = conectarse();
    $sql = "SELECT `res_nom_id`, `res_nom_id_clase_nombra`, `res_nom_id_usuario`, `res_nom_fecha`, `res_nom_id_cargo`, `res_nom_consecutivo`, 
                `res_nom_id_user_reemplaza`, `res_nom_fecha_inicio`, `res_nom_flag_abierto`,`res_nom_fecha_fin`, `res_nom_cdp`, `res_nom_oficio`, 
                `res_nom_acuerdo`,`res_nom_flag_first_vez`, `res_nom_ruta_contraloria`, `res_nom_ruta_procuraduria`, `res_nom_ruta_antecedentes`, 
                `res_nom_ruta_medidas`,`res_nom_ruta_inhabilidades`, `res_nom_userR`, `res_nom_userE`, `res_nom_fechaE`,  res_nom_flag_first_vez,
                res_nom_numPazSalvo, clas_id,clas_titulo, us.empleado AS empleado,us.nombre_usuario AS ced_empleado, car.car_titulo AS cargo
            FROM `th_resoluciones_nombra` AS rn 
            INNER JOIN th_clase_nombramiento AS cla ON rn.`res_nom_id_clase_nombra` = cla.clas_id
            INNER JOIN th_cargos as car ON rn.`res_nom_id_cargo` = car.car_id
            INNER JOIN pa_usuario AS us ON rn.`res_nom_id_usuario`= us.id
            WHERE res_nom_id = '$id'";

    $res = mysql_query($sql, $link);
    while($row = mysql_fetch_array($res)){
        $num_res            = $row['res_nom_consecutivo'];
        $fecha_resolucion   = $row['res_nom_fecha'];
        $ced_servidor       = $row['ced_empleado'];
        $nom_servidor       = $row['empleado'];
        $clase              = $row['clas_titulo'];
        $fecha_inicio       = $row['res_nom_fecha_inicio'];
        $oficio             = $row['res_nom_oficio'];
        $cargo_servidor     = $row['cargo'];
        $banderaFirts       = $row['res_nom_flag_first_vez'];
        $paz_salvo          = $row['res_nom_numPazSalvo'];
    }
    $ced_servidor = number_format($ced_servidor, 0, ',', '.,');
    $fecha_resolucionLetras = $fecha_inicio;
    $fecha_resolucion = strftime('%d de %B de %Y', strtotime($fecha_resolucion)); 
    $resolucion = $num_res." ".$fecha_resolucion;
    
    $dia = strftime('%d', strtotime($fecha_resolucionLetras));
    $mes = strftime('%B', strtotime($fecha_resolucionLetras));
    $anio = strftime('%Y', strtotime($fecha_resolucionLetras));
    $fecha_larga = dia_en_letras($dia) . " (" . $dia . ") de " . $mes . " de " . anio_en_letras($anio) . " (" . $anio . ")";
    
    if($banderaFirts == 1){
        $templateWord = new TemplateProcessor('plantilla_acta_posesionFIRTS.docx');
    }else{
        $templateWord = new TemplateProcessor('plantilla_acta_posesion.docx');
    }
    
    // --- Asignamos valores
    $templateWord->setValue('resolucion', $resolucion );
    $templateWord->setValue('cargo', $cargo_servidor );
    $templateWord->setValue('calidad', $clase );
    $templateWord->setValue('cedula', $ced_servidor );
    //$templateWord->setValue('nombre_empleado', ($nom_servidor) );
    $templateWord->setValue('empleado', strtoupper($nom_servidor) );
    $templateWord->setValue('fecha_larga_letras', $fecha_larga );  
    $templateWord->setValue('paz_salvo', $paz_salvo );
    
    // ---- Reemplazamos el nombre del documeto generado ---- 
    $nombre_archivo = "ACTA POSESION." . $num_res . " - " . $nom_servidor . ".docx";
    // --- Guardamos el documento
    $templateWord->saveAs($nombre_archivo);
	header("Content-Disposition: attachment; filename=" . $nombre_archivo . "; charset=iso-8859-1"); 
	echo file_get_contents($nombre_archivo);

    function dia_en_letras ($dia) { 
        $dias = array  ('primero','dos','tres','cuatro','cinco','seis','siete','ocho','nueve','diez','once','doce','trece','catorce','quince','dieciséis','diecisiete','dieciocho','diecinueve','veinte','veintiuno','veintidós','veintitrés','veinticuatro','veinticinco','veintiséis','veintisiete','veintiocho','veintinueve','treinta','treinta uno');
        return utf8_decode($dias[$dia - 1]);
    }
    function anio_en_letras($anio){
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