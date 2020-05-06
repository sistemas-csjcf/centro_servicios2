<?php
    require_once "../../../core/conexion.php";
    require_once dirname(__FILE__).'/PHPWord-master/src/PhpWord/Autoloader.php';
    \PhpOffice\PhpWord\Autoloader::register();
    use PhpOffice\PhpWord\TemplateProcessor;
    //$templateWord_servidor = new TemplateProcessor('plantilla_licencia_no_remunerada.docx');
    //$templateWord = new TemplateProcessor('plantilla_licencia_no_remunerada.docx');
    
    //Variables -->
    $id_lice    = $_REQUEST['id'];
    //$per_mayor = $_REQUEST['per_mayor'];

    date_default_timezone_set('America/Bogota'); 
    $fecha = date('Y-m-d');
    setlocale(LC_TIME, "Spanish");
    $fecha = strftime('%d de %B de %Y', strtotime($fecha));
    //echo $fechaA = strftime('g:ia /o/n l jS F Y', strtotime($fecha));
    //echo $anno = date("Y", strtotime($fecha));
    $link = conectarse();

    $sql = "SELECT * FROM th_licencias_no_remunerada WHERE lic_no_rem_id = '$id_lice'";

    $res = mysql_query($sql, $link);
    while($row = mysql_fetch_array($res))
    {
        $id_tipo_res    = $row['lic_no_rem_id_tipo_resolucion'];
        $num_res        = $row['lic_no_rem_num_resolucion'];
        $fecha_escrito  = $row['lic_no_rem_fecha_escrito'];
        $ced_servidor   = $row['lic_no_rem_cedula_servidor'];
        $nom_servidor   = $row['lic_no_rem_nombre_servidor'];
        $fecha_inicio   = $row['lic_no_rem_fecha_inicio'];
        $fecha_fin      = $row['lic_no_rem_fecha_fin'];
        $motivo         = $row['lic_no_rem_motivo'];
        $cargo_servidor = $row['lic_no_rem_cargo_cs'];

        $fecha_sistema  = $row['lic_no_rem_fecha_sistema']; // fecha de emision de la resolución. 
    }
    $ced_servidor = number_format($ced_servidor, 0, ',', '.,');

    $dia_i = strftime('%d', strtotime($fecha_inicio));
    $mes_i = strftime('%B', strtotime($fecha_inicio));
    $anio_i = strftime('%Y', strtotime($fecha_inicio));
    $fecha_inicio_larga = dia_en_letras($dia_i) . " (" . $dia_i . ") de " . $mes_i . " de " . $anio_i;

    $dia = strftime('%d', strtotime($fecha_sistema));
    $mes = strftime('%B', strtotime($fecha_sistema));
    $anio = strftime('%Y', strtotime($fecha_sistema));
    $fecha_sistema_larga = dia_en_letras($dia) . " (" . $dia . ") de " . $mes . " de " . anio_en_letras($anio) . " (" . $anio . ")";
    
    $dia_esc = strftime('%d', strtotime($fecha_escrito));
    $mes_esc = strftime('%B', strtotime($fecha_escrito));
    $anio_esc = strftime('%Y', strtotime($fecha_escrito));
    $fecha_escrito = dia_en_letras($dia_esc) . " (" . $dia_esc . ") de " . $mes_esc . " de " . $anio_esc;

    $fecha_sistema = strftime('%d de %B de %Y', strtotime($fecha_sistema));

    $dia_f = strftime('%d', strtotime($fecha_fin));
    $mes_f = strftime('%B', strtotime($fecha_fin));
    if(strftime('%B', strtotime($fecha_inicio)) == strftime('%B', strtotime($fecha_fin))) // valido si el mes es el mismo.
    {
        $fecha_rango = $dia_i . " al " . $dia_f . " de " . $mes_i . " de " . $anio;
    }
    else
    { 
        $fecha_rango = $dia_i . " de " . $mes_i . " al " . $dia_f . " de " . $mes_f . " de " . $anio;
    }
    //echo $fecha_rango;
    
    // --- Asignamos valores
    //$templateWord->setValue('titulo', $titulo );
    /*$templateWord_servidor->setValue('fecha', $fecha_sistema );
    $templateWord_servidor->setValue('num_resolucion', $num_res );
    $templateWord_servidor->setValue('fecha_escrito', $fecha_escrito );
    $templateWord_servidor->setValue('ced_servidor', $ced_servidor );
    $templateWord_servidor->setValue('nom_servidor', $nom_servidor );
    $templateWord_servidor->setValue('fecha_inicio', $fecha_inicio );
    $templateWord_servidor->setValue('motivo', $motivo );*/

    if($id_tipo_res == 5)  // licencia no remunerada por 3 meses
    {
        $templateWord = new TemplateProcessor('plantilla_licencia_no_remunerada_3_meses.docx');
    }
    else if ($id_tipo_res == 6)  // licencia no remunerada hasta por 2 años
    {
        $templateWord = new TemplateProcessor('plantilla_licencia_no_remunerada.docx');
    }

    $templateWord->setValue('fecha', $fecha_sistema );
    $templateWord->setValue('fecha_mas_larga', $fecha_sistema_larga );
    $templateWord->setValue('num_resolucion', $num_res );
    $templateWord->setValue('fecha_escrito', $fecha_escrito );
    $templateWord->setValue('ced_servidor', $ced_servidor );
    $templateWord->setValue('nom_servidor', $nom_servidor );
    $templateWord->setValue('fecha_inicio_larga', $fecha_inicio_larga );
    $templateWord->setValue('motivo', $motivo );
    $templateWord->setValue('cargo', $cargo_servidor );

    $templateWord->setValue('fecha_rango', $fecha_rango );

    $nombre_archivo = "R." . $num_res . " LICENCIA " . $nom_servidor . ".docx";
   
    // --- Guardamos el documento
    //$templateWord_servidor->saveAs('../../../Docs_Resoluciones/licencias/' . $nombre_archivo);

    $templateWord->saveAs($nombre_archivo);
	header("Content-Disposition: attachment; filename=" . $nombre_archivo . "; charset=iso-8859-1"); 
	echo file_get_contents($nombre_archivo);

    // Actualizamos la ruta del archivo de resolucion
    //$sql = "UPDATE th_licencias_no_remunerada SET lic_no_rem_ruta_resolucion = '$nombre_archivo' WHERE lic_no_rem_id = '$id_lice';";
    //mysql_query($sql, $link);

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