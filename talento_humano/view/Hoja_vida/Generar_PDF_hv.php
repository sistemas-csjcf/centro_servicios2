<?php
    require_once("app/libs/dompdf/dompdf_config.inc.php");
    $dompdf = new DOMPDF();
    //$dompdf->load_html( file_get_contents( 'http://localhost/centro_servicios2/trabajo_social/view/visitas/Descargar_ComprobanteVisita.php?id='.$_GET['id'] ) );
    $dompdf->load_html(utf8_decode(file_get_contents( 'http://localhost/centro_servicios2/talento_humano/view/Hoja_vida/Descargar_HV.php?id_empleado='.$_GET['id_empleado'] )));
    $dompdf->render();
    $dompdf->stream("Formato_HV".$_GET['id_empleado'].".pdf");
