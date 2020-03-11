<?php
ECHO $us =$_REQUEST['id_empleado'];
// Include the main TCPDF library (search for installation path).
//require_once('../../../assets/librerias/tcpdf/tcpdf.php');
//require_once('/app/libs/tcpdf/tcpdf.php');
//// create new PDF document
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//
//// set document information
//$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Esteban Múnera');
//$pdf->SetTitle('Hoja de Vida');
//$pdf->SetSubject('TCPDF');
//$pdf->SetKeywords('pdf, Hoja Vida, Talento humano, Juan Esteban Munera Betancur');
//
//// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'Hoja de Vida' .$_REQUEST['id_empleado'], PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
//$pdf->setFooterData(array(0,64,0), array(0,64,128));
//
//// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//
//// set default monospaced font
//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//
//// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//
//// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//
//// set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//
//// set some language-dependent strings (optional)
//if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
//    require_once(dirname(__FILE__).'/lang/eng.php');
//    $pdf->setLanguageArray($l);
//}
//
//// ---------------------------------------------------------
//
//// set default font subsetting mode
//$pdf->setFontSubsetting(true);
//
//// Set font
//// dejavusans is a UTF-8 Unicode font, if you only need to
//// print standard ASCII chars, you can use core fonts like
//// helvetica or times to reduce file size.
//$pdf->SetFont('dejavusans', '', 14, '', true);
//
//// Add a page
//// This method has several options, check the source code documentation for more information.
//$pdf->AddPage();
//
//// set text shadow effect
//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
//
//// Set some content to print
//$html = <<<EOD
//<h1>Hoja de Vida <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
//<i>This is the first example of TCPDF library.</i>
//<p>Datos Personales</p>
//<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
//<p>Please check the source code documentation and other examples for further information.</p>
//<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
//EOD;
//
//// Print text using writeHTMLCell()
//$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
//
//// ---------------------------------------------------------
//
//// Close and output PDF document
//// This method has several options, check the source code documentation for more information.
//ob_clean();
//$pdf->Output('example_001.pdf', 'I');
////============================================================+
//// END OF FILE
////============================================================+
//



require_once('core/conexion.php');
require_once 'model/hojaVida_model.php';;

$us =$_REQUEST['id_empleado'];
    $modelo = new HojaVida();
    $link=conectarse();
    
    
    $id = $_REQUEST['idUS'];
    //echo "dsada  ".$id;
    $rs="SELECT `per_id`, `per_id_usuario`, `per_cedula`, `per_nombres`, `per_apellidos`, `per_fecha_nacimiento`, 
            `per_id_dep_nacimiento`, `per_id_ciu_nacimiento`, `per_direccion`, `per_telefono`, `per_celular`, `per_email`, `per_ruta_foto`, 
            dep.nombre AS departamento, mun.nombre AS municipio
        FROM `th_personas` AS per
        INNER JOIN pa_departamento AS dep ON per.per_id_dep_nacimiento = dep.id
        INNER JOIN pa_municipio AS mun ON per.per_id_ciu_nacimiento = mun.id
        WHERE `per_id_usuario` = '$us'";
    $res1=mysql_query($rs,$link);
    while ($row=mysql_fetch_array($res1)) { 
        $id_persona         = $row['per_id'];
        $num_cedula         = $row['per_cedula'];
        $nombres            = $row['per_nombres']." ".$row['per_apellidos'];
        $lugar_nacimiento   = $row['per_fecha_nacimiento'].", ".$row['municipio'].", ".$row['departamento'];
        $direccion          = $row['per_direccion'];
        $telefono           = $row['per_telefono'].", ".$row['per_celular'];
        $email              = $row['per_email'];
        $foto               = $row['per_ruta_foto'];
    }
    
    $usuariohv = "SELECT * FROM th_hoja_vida where hv_id_persona = '".$id_persona."'";
    $hv=mysql_query($usuariohv,$link);
    while ($fila = mysql_fetch_array($hv)){ 
        $hv_id = $fila['hv_id'];
    }
   
    
   
if(isset($us)){
    //require_once('tcpdf/tcpdf.php');
    require_once('/app/libs/tcpdf/tcpdf.php');
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Juan Esteban Múnera Betancur');
    $pdf->SetTitle('Hoja Vida');
    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'Hoja de Vida ' .$_REQUEST['id_empleado'].', '.$nombres, PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    //$pdf->setPrintHeader(false); 
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(20, 20, 20, false); 
    $pdf->SetAutoPageBreak(true, 20); 
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->addPage();
    //$pdf->Image('assets/imagenes/logo.png', 15,  15, 40, 40, 'png', '', '', true);
    //$pdf->Image('assets/imagenes/logo.png',  155,  15, 40, 40, 'png', '', '', true);
    $pdf->Image('documentos_HV/fotos/'.$foto, 90,  15, 40, 40, 'jpg', '', '', true);
    $content = '';
	$content .= '<br><br><br><br><br><br><br><br><br><br>
            <table border="2">
                <td><tr>Datos Personales</tr></td>
            </table><br><br>
            <table border="0">
                <tr>
                    <th>Nombre Completo</th>
                    <th>'.$nombres.' </th>
                </tr>
                <tr>
                    <th>Identificación</th>
                    <th>'.$num_cedula.'</th>
                </tr>
                <tr>
                    <th>Lugar y Fecha de Nacimiento</th>
                    <th>'.$lugar_nacimiento.'</th>
                </tr>
                <tr>
                    <th>Domicilio</th>
                    <th>'.$direccion.'</th>
                </tr>
                <tr>
                    <th>Celular</th>
                    <th>'.$telefono.'</th>
                </tr>
                <tr>
                    <th>Correo Electrónico</th>
                    <th>'.$email.'</th>
                </tr>
            </table><br><br><br>
            <table border="2">
                <td><tr>Formación Profesional</tr></td>
            </table><br><br>
            <table border="1">
                <thead>
                    <tr bgcolor="#BDC3C7">
                        <th>Nivel Educación</th>
                        <th>Institución</th>
                        <th>Título</th>
                        <th>Fecha</th> 
                    </tr>
                </thead>
        
        ';
        foreach($this->model->Listar_FormacionProfesional($hv_id) as $r):
            $content .= '
                <tbody>
                    <tr>
                        <td>'.$r->niv_titulo.'</td>
                        <td>'.$r->for_pro_institucion.'</td>
                        <td>'.$r->for_pro_titulo.'</td>
                        <td>'.$r->for_pro_fecha_inicio." - ".$r->for_pro_fecha_fin.'</td>
                    </tr>
                </tbody>
            ';
        endforeach;

	$content .= '</table> <br><br><br>
            <table border="2">
                <td><tr>Experiencia Laboral</tr></td>
            </table><br><br>
            <table border="1">
                <thead>
                    <tr bgcolor="#BDC3C7">
                        <th>Empresa</th>
                        <th>Cargo</th>
                        <th>Ciudad</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
        ';
        foreach($this->model->Listar_Exp_Laboral($hv_id) as $st):
            $content .= '
                <tbody>
                    <tr>
                        <td>'.$st->exp_empresa.'</td>
                        <td>'.$st->exp_cargo.'</td>
                        <td>'.$st->municipio.", ".$st->departamento.'</td>
                        <td>'.$st->exp_fecha_inicio." - ".$st->exp_fecha_fin.'</td>
                    </tr>
                </tbody>
            ';
	endforeach; 
        
        $content .= '</table> <br><br><br>
            <table border="2">
                <td><tr>Experiencia Laboral</tr></td>
            </table><br><br>
            <table border="1">
                <thead>
                    <tr bgcolor="#BDC3C7">
                        <th>Nombre</th>
                        <th>Cargo</th>
                        <th>Empresa</th>
                        <th>Telèfono</th>
                    </tr>
                </thead>
        ';
        foreach($this->model->Listar_Ref_Personal($hv_id) as $st):
            $content .= '
                <tbody>
                    <tr>
                        <td>'.$st->ref_nombre.'</td>
                        <td>'.$st->ref_cargo.'</td>
                        <td>'.$st->ref_empresa.'</td>
                        <td>'.$st->ref_telefono.'</td>
                    </tr>
                </tbody>
            ';
        endforeach;
        $content .= '</table>';
	$content .= '
            <div class="row padding">
        	<div class="col-md-12" style="text-align:center;">
                    <span>Pdf Creado </span><a href="http://www.redecodifica.com">por Juan Esteban Múnera Betancur</a>
                </div>
            </div>
	';

	$pdf->writeHTML($content, true, 0, true, 0);

	$pdf->lastPage();
        ob_clean();
	$pdf->output('Hoja_Vida_'.$nombres.'.pdf', 'I');
}