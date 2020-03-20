<?php
    require_once "../../../core/conexion.php";
    require_once dirname(__FILE__).'/PHPWord-master/src/PhpWord/Autoloader.php';
    \PhpOffice\PhpWord\Autoloader::register();
    use PhpOffice\PhpWord\TemplateProcessor;
    
    $templateWord = new TemplateProcessor('plantilla_nombramiento_encargo.docx');
    //Variables -->
    $id    = $_REQUEST['id'];
    date_default_timezone_set('America/Bogota'); 
    $fecha = date('Y-m-d');
    setlocale(LC_TIME, "Spanish");
    $fecha = strftime('%d de %B de %Y', strtotime($fecha));
    
    $link = conectarse();
    $sql = "SELECT `res_nom_id`, `res_nom_id_clase_nombra`, `res_nom_id_usuario`, `res_nom_fecha`, `res_nom_id_cargo`, `res_nom_consecutivo`, 
                `res_nom_id_user_reemplaza`, `res_nom_fecha_inicio`, `res_nom_flag_abierto`,`res_nom_fecha_fin`, `res_nom_cdp`, `res_nom_oficio`, 
                `res_nom_acuerdo`, `res_nom_ruta_contraloria`, `res_nom_ruta_procuraduria`, `res_nom_ruta_antecedentes`, `res_nom_ruta_medidas`,
                `res_nom_ruta_inhabilidades`, `res_nom_userR`, `res_nom_userE`, `res_nom_fechaE`, clas_id,clas_titulo, us.empleado AS empleado,
                us.nombre_usuario AS ced_empleado, car.car_titulo AS cargo, car2.car_titulo AS cargo2
            FROM `th_resoluciones_nombra` AS rn 
            INNER JOIN th_clase_nombramiento AS cla ON rn.`res_nom_id_clase_nombra` = cla.clas_id
            INNER JOIN th_cargos as car ON rn.`res_nom_id_cargo` = car.car_id
            INNER JOIN th_cargos as car2 ON rn.`res_nom_id_cargoAct` = car2.car_id
            INNER JOIN pa_usuario AS us ON rn.`res_nom_id_usuario`= us.id
            WHERE res_nom_id = '$id'";

    $res = mysql_query($sql, $link);
    while($row = mysql_fetch_array($res)){
        $num_res            = $row['res_nom_consecutivo'];
        $fecha_resolucion   = $row['res_nom_fecha'];
        $ced_servidor       = $row['ced_empleado'];
        $nom_servidor       = $row['empleado'];
        
        $fecha_inicio       = $row['res_nom_fecha_inicio'];
        $fecha_fin          = $row['res_nom_fecha_fin'];
        $oficio             = $row['res_nom_oficio'];
        $acuerdo            = $row['res_nom_acuerdo'];
        $cdp                = $row['res_nom_cdp'];
        $cargo_servidor     = $row['cargo'];
        $cargo_actual       = $row['cargo2'];
    }
    $dia = strftime('%d', strtotime($fecha_resolucion));
    $mes = strftime('%B', strtotime($fecha_resolucion));
    $anio = strftime('%Y', strtotime($fecha_resolucion));
    $fecha_resolucion_larga = dia_en_letras($dia) . " (" . $dia . ") de " . $mes . " de " . anio_en_letras($anio) . " (" . $anio . ")";
    $fecha_resolucionLetras = $fecha_inicio;
    $fecha_resolucion = strftime('%d de %B de %Y', strtotime($fecha_resolucion)); 
    $ced_servidor = number_format($ced_servidor, 0, ',', '.,');

    $fecha_resolucion_letras = strftime('%d de %B de %Y', strtotime($fecha_inicio)); 
   
    // --- Asignamos valores 
    $templateWord->setValue('fecha', $fecha_resolucion );
    $templateWord->setValue('num_resolucion', $num_res );
    $templateWord->setValue('cedula', $ced_servidor );
    $templateWord->setValue('nombre_empleado', strtoupper($nom_servidor) );
    $templateWord->setValue('fecha_resolucion', $fecha_resolucion_letras );
    $templateWord->setValue('fecha_larga_letras', $fecha_resolucion_larga );
    $templateWord->setValue('cargo', $cargo_servidor );
    $templateWord->setValue('cargo_propiedad', $cargo_actual );
    $templateWord->setValue('cdp', $cdp );
    
    // ---- Reemplazamos el nombre del documeto generado ---- 
    $nombre_archivo = "R." . $num_res . " Nombramiento " . $nom_servidor . ".docx";
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