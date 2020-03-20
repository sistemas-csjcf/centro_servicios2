<?php 
session_start(); 
set_time_limit (240000000);
require('fpdf.php');
require('conexion.php');

class PDF extends FPDF
{
	var $widths;
	var $aligns;
	
	function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths=$w;
	}
	
	function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns=$a;
	}
	
	function Row($data)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=5*$nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			
			//CIERRO ESTA LINEA PARA QUE NO SAQUE BORDES EN LA TABLA
			$this->Rect($x,$y,$w,$h);
	
			$this->MultiCell($w,5,$data[$i],0,$a,'true');
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}
	
	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}
	
	function NbLines($w,$txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}
	
	function Header()
	{
	
		$this->Ln(20);
		$this->Image('encabezado2.jpg' , 20 ,20,180,20,'JPG', '');

	}
	
	function Footer()
	{
		//$this->SetY(-15);
		//$this->Image('piepagina2.jpg' , 45 ,245, 0 , 0,'JPG', '');
		
	
	}
	
}

//GENERAR PDF	
$con = new DB;

$idusuario = $_SESSION['idUsuario'];
	
$datos     = trim($_GET['datos']);

// devuelve los ID a imprimir quitando la ultima coma 1,2,3, --> 1,2,3
//para poder hacer la consulta en la base de datos
$registros = substr($datos, 0, -1);  

//-----------------------------------DATOS GENERALES---------------------------------------
//ME PERMITE CARGAR DATOS COMO MENSAJES

$canalsql = $con->conectar();	

				
$strConsulta = "SELECT de.id,de.fecha,de.hora,pu.empleado,de.remitente,td.nombre_tipo_documento,de.numero,de.nfc,pj.nombre,de.rutaarchivo
				FROM (((sidoju_documentos_entrantes_juzgados de INNER JOIN pa_usuario pu ON de.idusuario = pu.id)
				INNER JOIN sigdoc_pa_tipodocumento td ON de.idtipodocumento = td.id)
				INNER JOIN pa_juzgado pj ON de.idjuzgadodestino = pj.id)
				WHERE de.id IN($registros) 
				ORDER BY de.id DESC";		
		

$canalsql = mysql_query($strConsulta);
$numfilas = mysql_num_rows($canalsql);
$fila     = mysql_fetch_array($canalsql);
$especialidadjuzgado = $fila['nombre'];

//-----------------------------------------------------------------------------------------

$pdf=new PDF('P','mm','letter');
$pdf->Open();
$pdf->AddPage();
$pdf->SetMargins(20,30,20);
$pdf->Ln(10);

//TAMAÑO DE LA LETRA
$tamletra = 8;

//PARA SABER QUE DATOS TRAIGO PARA GENERAR EL REPORTE
//SOLO SE ACTIVA PARA PRUBAS
/*$pdf->Ln(5);

$pdf->SetFont('Arial','',$tamletra);
$pdf->Cell(0,6,$datos."   ".$idusuario,0,1);*/


//FECHA
date_default_timezone_set('America/Bogota'); 
$fechaactual=date('Y-m-d');
setlocale(LC_TIME, "Spanish");
$fecha = strftime('%d de %B del %Y', strtotime($fechaactual));  
$pdf->SetFont('Arial','',$tamletra);
$pdf->Cell(0,6,'Manizales, '.$fecha,0,1);
//$pdf->Ln(5);

//RANGO FECHA
/*$pdf->SetFont('Arial','',10);
$pdf->Cell(0,6,'Fecha: '.$fechai." - ".$fechaf,0,1);

//RANGO HORA
if ( !empty($horai) && !empty($horaf) ) {
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,6,'Hora:   '.$horai." - ".$horaf,0,1);
$pdf->Ln(5);
}*/


$pdf->SetFont('Arial','B',$tamletra);
$pdf->Cell(0,6,'RELACION DE DOCUMENTOS PARA ENTREGAR EN '.$especialidadjuzgado,0,1);
//$pdf->Ln(5);

$pdf->SetFont('Arial','',$tamletra);
$pdf->Cell(0,6,'Total Registros: '.$numfilas,0,1);
//$pdf->Ln(5);

$pdf->SetWidths(array(12, 35, 15, 35, 21, 20, 45, 45));
$pdf->SetFont('Arial','B',$tamletra);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0);

for($i=0;$i<1;$i++){
	
	//$pdf->Row(array('NUMERO', 'CONSECUTIVO', 'TIPO','NOMBRE/FOLIOS/CARPETAS','FECHA','HORA','RECIBE','JUZGADO'));
	$pdf->Row(array('N°', 'CONSECUTIVO', 'TIPO','NOMBRE/FOLIOS/CARPETAS','FECHA','HORA','RECIBE'));
}

$canalsql = $con->conectar();	
				
$strConsulta = "SELECT de.id,de.fecha,de.hora,pu.empleado,de.remitente,td.nombre_tipo_documento,de.numero,de.nfc,pj.nombre,de.rutaarchivo
				FROM (((sidoju_documentos_entrantes_juzgados de INNER JOIN pa_usuario pu ON de.idusuario = pu.id)
				INNER JOIN sigdoc_pa_tipodocumento td ON de.idtipodocumento = td.id)
				INNER JOIN pa_juzgado pj ON de.idjuzgadodestino = pj.id)
				WHERE de.id IN($registros) 
				ORDER BY de.id DESC";		
				
					
$canalsql = mysql_query($strConsulta);
$numfilas = mysql_num_rows($canalsql);
	
for ($i=0; $i<$numfilas; $i++){
	
	$pdf->SetWidths(array(12, 35, 15, 35, 21, 20, 45, 45));
	
	$fila = mysql_fetch_array($canalsql);
	$pdf->SetFont('Arial','',$tamletra);

	$pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
	
	//$pdf->Row(array($fila['id'], $fila['numero'], $fila['nombre_tipo_documento'], $fila['nfc'], $fila['fecha'], $fila['hora'], $fila['empleado'],$fila['nombre']));	
	$pdf->Row(array($fila['id'], $fila['numero'], $fila['nombre_tipo_documento'], $fila['nfc'], $fila['fecha'], $fila['hora'], $fila['empleado']));	
	
	
}

$pdf->Ln(1);

for ($i=0; $i<1; $i++){
	
	$pdf->SetWidths(array(100, 84, 15));
	$pdf->SetFont('Arial','',$tamletra);
	
	$pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
	
	$pdf->Row(array($_SESSION['nombre'],''));	

}

$pdf->SetWidths(array(100, 84, 15));
$pdf->SetFont('Arial','B',$tamletra);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0);

for($i=0;$i<1;$i++){
	
	$pdf->Row(array('Nombre Empleado que Entrega del CCSSJJC-F', 'Nombre Empleado Juzgado que Recibe'));
}

//PARA CONOCER COMO SE CONSTITUYE LA SQL
//SOLO SE ACTIVA PARA PRUEBAS

/*$sql = "SELECT de.id,de.fecha,de.hora,pu.empleado,de.remitente,td.nombre_tipo_documento,de.numero,de.nfc,pj.nombre,de.rutaarchivo
				FROM (((sidoju_documentos_entrantes_juzgados de INNER JOIN pa_usuario pu ON de.idusuario = pu.id)
				INNER JOIN sigdoc_pa_tipodocumento td ON de.idtipodocumento = td.id)
				INNER JOIN pa_juzgado pj ON de.idjuzgadodestino = pj.id)
				WHERE de.id IN($registros) 
				ORDER BY de.id DESC";		
for ($i=0; $i<1; $i++){
	
	$pdf->SetWidths(array(90,90));
	
	$pdf->SetFont('Arial','',$tamletra);

	$pdf->SetFillColor(200,202,205);
    $pdf->SetTextColor(0);
	
	$pdf->Row(array($sql));	
	
	
}*/



$pdf->Output();

?>




