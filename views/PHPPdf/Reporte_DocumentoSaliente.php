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
			//$this->Rect($x,$y,$w,$h);
	
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
	
		
		//$this->SetFont('Arial','',10);
		//$this->Text(110,14,'REPÚBLICA DE COLOMBIA',0,'C', 0);
		$this->Ln(50);
		$this->Image('encabezado.jpg' , 20 ,20,0,0,'JPG', '');
		//$this->Text(110,24,'OFICINA DE EJECUCIÓN CIVIL MUNICIPAL',0,'C', 0);
		//$this->Text(120,54,'MANIZALES - CALDAS',0,'C', 0);
	}
	
	function Footer()
	{
		$this->SetY(-15);
		//$this->SetFont('Arial','B',8);
		//$this->Cell(100,10,'TRASLADO ART. 108',0,0,'L');
		$this->Image('piepagina2.jpg' , 45 ,245, 0 , 0,'JPG', '');
	
	}
	
	function Validar_Campo($campo)
	{
		if (!empty($campo) && $campo != "" && $campo != "No Aplica") {
			return 1;
		}
		else{
			return 0;
		}
	
	}

}

//GENERAR PDF	
$con = new DB;
	
$id = trim($_GET['id']);
	
$pdf=new PDF('P','mm','letter');
$pdf->Open();
$pdf->AddPage();
$pdf->SetMargins(20,20,20);
$pdf->Ln(10);

$canalsql = $con->conectar();	
				
$strConsulta = "SELECT rds.id,sa.nombre_area,rds.numero,td.nombre_tipo_documento,ax.nombre_area_ex,c.nombre_cargo,
				rds.fecha,rds.asunto,e.nombre_empleado,rds.cuerpo,d.nombre_dirigido,l.nombre_lugar,rds.nombre
				FROM (((((((sigdoc_registro_ds rds INNER JOIN sigdoc_area sa ON rds.area_destino = sa.id)
				LEFT JOIN sigdoc_tipodocumento td ON rds.id_tipo_documento = td.id)
				LEFT JOIN sigdoc_area_externa ax ON rds.id_area_ex = ax.id)
				LEFT JOIN sigdoc_cargo c ON rds.id_cargo = c.id)
				LEFT JOIN sigdoc_empleado e ON rds.id_empleado = e.id)
				LEFT JOIN sigdoc_dirigido d ON rds.id_dirigido = d.id)
				LEFT JOIN sigdoc_lugar l ON rds.id_lugar = l.id) 
				WHERE rds.id = '$id'";				
	
$canalsql = mysql_query($strConsulta);
$numfilas = mysql_num_rows($canalsql);
	
for ($i=0; $i<$numfilas; $i++){
	
	//$pdf->SetWidths(array(17, 35, 15, 35, 16, 20, 16, 21, 21, 20, 20, 10));
	$pdf->SetWidths(array(60, 70, 15, 35, 16, 20, 16, 21, 21, 20, 20, 10));
	
	$fila = mysql_fetch_array($canalsql);
	$pdf->SetFont('Arial','',10);
	
	$pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
	
	$pdf->Cell(0,6,$fila['nombre_tipo_documento']." No.".$fila['numero'],0,1,'L');
	
	setlocale(LC_TIME, "Spanish");
	$fecha = strftime('%d de %B del %Y', strtotime($fila['fecha']));  
	//$section->addText("Manizales, ".$fecha,$fontStyle4);
	$pdf->Cell(0,6,"Manizales, ".$fecha,0,1,'L');
	
	$pdf->Ln(5);
	$pdf->Cell(0,6,'Área que Envía: '.$fila['nombre_area'],0,1,'L');
	
	$pdf->Ln(5);
	$pdf->Cell(0,6,'Dirigido a: ',0,1,'L');
	$pdf->Cell(0,6,$fila['nombre_dirigido'],0,1,'L');
	
	if($pdf->Validar_Campo($fila['nombre']) == 1){
	//if (!empty($fila['nombre']) && $fila['nombre'] != "" && $fila['nombre'] != "No Aplica") {
	$pdf->Cell(0,6,$fila['nombre'],0,1,'L');
	}
	if($pdf->Validar_Campo($fila['nombre_cargo']) == 1){
	//if (!empty($fila['nombre_cargo']) && $fila['nombre_cargo'] != "" && $fila['nombre_cargo'] != "No Aplica") {
	$pdf->Cell(0,6,$fila['nombre_cargo'],0,1,'L');
	}
	if($pdf->Validar_Campo($fila['nombre_area_ex']) == 1){
	//if (!empty($fila['nombre_area_ex']) && $fila['nombre_area_ex'] != "" && $fila['nombre_area_ex'] != "No Aplica") {
	$pdf->Cell(0,6,$fila['nombre_area_ex'],0,1,'L');
	}
	if($pdf->Validar_Campo($fila['nombre_lugar']) == 1){
	//if (!empty($fila['nombre_lugar']) && $fila['nombre_lugar'] != "" && $fila['nombre_lugar'] != "No Aplica") {
	$pdf->Cell(0,6,$fila['nombre_lugar'],0,1,'L');
	}

	$pdf->Ln(5);
	$pdf->Cell(0,6,'Asunto: '.$fila['asunto'],0,1,'L');
	$pdf->Ln(2);
	
	$pdf->MultiCell(0,6,$fila['cuerpo'],0,1,'J');
	
	$pdf->Ln(20);
	$pdf->Cell(0,6,'Atentamente,',0,1,'L');
	$pdf->Ln(2);
	$pdf->Cell(0,6,'NATALIA QUINTERO HOYOS',0,1,'C');
	$pdf->Cell(0,6,'Coordinadora.',0,1,'C');
	
	$pdf->SetFont('Arial','B',6);
	if($pdf->Validar_Campo($fila['nombre_empleado']) == 1){
	//if (!empty($fila['nombre_empleado']) && $fila['nombre_empleado'] != "" && $fila['nombre_empleado'] != "No Aplica") {
	$pdf->Cell(0,6,'Elaborado Por: '.$fila['nombre_empleado'],0,1,'L');
	}
	
	$pdf->Cell(0,6,'Usuario que imprime: '.$_SESSION['nombre'],0,1,'L');
	

}

$pdf->Output();

?>




