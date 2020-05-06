<?php
    require_once "../../../core/conexion.php";
    require_once dirname(__FILE__).'/PHPWord-master/src/PhpWord/Autoloader.php';
    \PhpOffice\PhpWord\Autoloader::register();
    use PhpOffice\PhpWord\TemplateProcessor;
    $templateWord_servidor = new TemplateProcessor('plantilla_permiso_ordinario.docx');
    $templateWord = new TemplateProcessor('plantilla_permiso_ordinario.docx');
    
    //Variables -->
    $id_doc    = $_REQUEST['id'];
    $per_mayor = $_REQUEST['per_mayor'];

    date_default_timezone_set('America/Bogota'); 
    $fecha = date('Y-m-d');
    setlocale(LC_TIME, "Spanish");
    $fecha = strftime('%d de %B de %Y', strtotime($fecha));
    //echo $fechaA = strftime('g:ia /o/n l jS F Y', strtotime($fecha));
    //echo $anno = date("Y", strtotime($fecha));
    $link = conectarse();

    if($per_mayor == "1")  // permiso mayor a un dia
    {
        $sql = "SELECT ep.id, us.nombre_usuario, us.empleado, ep.fecha_solicitud AS fecha_permiso, ep.detalle, ep.num_resolucion  
                FROM (empleado_permiso_mayor ep 
                LEFT JOIN pa_usuario us 
                ON ep.idusuario = us.id) 
                WHERE ep.id = '$id_doc'";
    }
    else
    {
        $sql = "SELECT ep.id,ep.fecha_permiso,ep.hora_inicio, ep.hora_final, ep.detalle, ep.num_resolucion, pu.nombre_usuario, pu.empleado
                FROM (empleado_permiso AS ep
                LEFT JOIN pa_usuario pu ON ep.idusuario = pu.id)
                WHERE ep.id = '$id_doc'";
    }
    $res = mysql_query($sql,$link);
    while($row = mysql_fetch_array($res)){
        $fecha_permiso  = $row['fecha_permiso'];
        $empleado       = $row['empleado'];
        $num_res        = $row['num_resolucion'];
        $motivo         = $row['detalle'];
        //$radicado   = $row['radicado'];
    }
    $fecha_permiso = strftime('%d de %B de %Y', strtotime($fecha_permiso));
    // --- Asignamos valores
    //$templateWord->setValue('titulo', $titulo );
    $templateWord_servidor->setValue('num_resolucion', $num_res );
    $templateWord_servidor->setValue('fecha', $fecha );
    $templateWord_servidor->setValue('fecha_permiso', $fecha_permiso );
    $templateWord_servidor->setValue('nombre_servidor', $empleado );
    $templateWord_servidor->setValue('motivo', $motivo );

    $templateWord->setValue('num_resolucion', $num_res );
    $templateWord->setValue('fecha', $fecha );
    $templateWord->setValue('fecha_permiso', $fecha_permiso );
    $templateWord->setValue('nombre_servidor', $empleado );
    $templateWord->setValue('motivo', $motivo );
   
    // --- Guardamos el documento
    $templateWord_servidor->saveAs('../../../Docs_Resoluciones/licencias/licencia.docx');

    $templateWord->saveAs('licencia.docx');
    header("Content-Disposition: attachment; filename=licencia.docx; charset=iso-8859-1"); 
    echo file_get_contents('licencia.docx');

    /*$templateWord->saveAs('../../../Docs_Resoluciones/permisos/permiso_ordinari.docx');
	header("Content-Disposition: attachment; filename=permiso_ordinari.docx; charset=iso-8859-1"); 
	echo file_get_contents('permiso_ordinari.docx');*/
?>