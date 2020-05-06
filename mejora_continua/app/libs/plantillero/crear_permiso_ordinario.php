<?php
    require_once "../../../core/conexion.php";
    require_once dirname(__FILE__).'/PHPWord-master/src/PhpWord/Autoloader.php';
    \PhpOffice\PhpWord\Autoloader::register();
    use PhpOffice\PhpWord\TemplateProcessor;
    $templateWord = new TemplateProcessor('plantilla_permiso_ordinario.docx');
    
    //Variables -->
    $id_doc = $_REQUEST['id'];
    date_default_timezone_set('America/Bogota'); 
    $fecha = date('Y-m-d');
    setlocale(LC_TIME, "Spanish");
    $fecha = strftime('%d de %B de %Y', strtotime($fecha));
    //echo $fechaA = strftime('g:ia /o/n l jS F Y', strtotime($fecha));
    //echo $anno = date("Y", strtotime($fecha));
    $link=conectarse();
    $sql = "SELECT ep.id,ep.fecha_permiso,ep.hora_inicio, ep.hora_final, ep.detalle, ep.num_resolucion, pu.nombre_usuario, pu.empleado
            FROM (empleado_permiso AS ep
            LEFT JOIN pa_usuario pu ON ep.idusuario = pu.id)
            WHERE ep.id = '$id_doc'";
    $res = mysql_query($sql,$link);
    while($row = mysql_fetch_array($res)){
        $fecha_permiso  = $row['fecha_permiso'];
        $empleado       = $row['empleado'];
        $num_res        = $row['num_resolucion'];
        //$radicado   = $row['radicado'];
    }
    $fecha_permiso = strftime('%d de %B de %Y', strtotime($fecha_permiso));
    // --- Asignamos valores
    //$templateWord->setValue('titulo', $titulo );
    $templateWord->setValue('num_resolucion', $num_res );
    $templateWord->setValue('fecha', $fecha );
    $templateWord->setValue('fecha_permiso', $fecha_permiso );
    $templateWord->setValue('nombre_servidor', $empleado );
   
    // --- Guardamos el documento
    $templateWord->saveAs('permiso_ordinario.docx');
	header("Content-Disposition: attachment; filename=permiso_ordinario.docx; charset=iso-8859-1"); 
	echo file_get_contents('permiso_ordinario.docx');
?>