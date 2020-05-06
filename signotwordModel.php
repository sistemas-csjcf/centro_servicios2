<?php
class signotwordModel extends modelBase
{


	/************************ Se obtiene los datos del documento *************************************/

	public function Obtener_Datos_Documento($iddoc){
	
		//ini_set('max_execution_time', 240); //240 segundos = 4 minutos
		
		$listar     = $this->db->prepare("	SELECT ap.id,sp.cedula,sp.nombre,p.radicado,pj.nombre AS juzgado,
											spa.nombre_tipo_etapa_proceso AS auto,ap.fecharegistroauto,ap.fechaauto,
											d.direccion,d.telefono,dep.Cod_departamento,dep.descripcion AS departamento,m.descripcion AS municipio,
											ap.descorrecion
											FROM ((((((((signot_auto_parte ap INNER JOIN signot_proceso p ON ap.idproceso = p.id)
											INNER JOIN signot_parte sp ON ap.idparte = sp.id)
											INNER JOIN pa_juzgado pj ON pj.id = p.idjuzgadoorigen)
											INNER JOIN pa_area pa ON pj.idarea = pa.id)
											INNER JOIN signot_pa_etapa_procesal spa ON spa.id = ap.idauto)
											INNER JOIN signot_direccion d ON d.idparte = ap.idparte)
											INNER JOIN signot_pa_departamento dep ON dep.Cod_departamento = d.iddepartamento)
											INNER JOIN signot_pa_municipio m ON m.Cod_Municipio = d.idmunicipio)
											WHERE ap.id = '$iddoc'
											ORDER BY ap.id ");
										  
		
	
		$listar->execute();
			  
		return $listar; 
	
   }
   
   public function Obtener_Demandante_Demandado($idsql,$idrad){
	
	
		//DEMANDANTES
		if($idsql == 1){
			
			$listar     = $this->db->prepare("	SELECT sp.nombre
												FROM ((signot_proceso p INNER JOIN signot_parteproceso pp ON p.id = pp.idproceso)
												INNER JOIN signot_parte sp ON pp.idparte = sp.id)
												WHERE p.radicado = '$idrad' AND pp.idclaseparte = 1 ");
		}
		
		//DEMANDADOS
		if($idsql == 2){
			
			$listar     = $this->db->prepare("	SELECT sp.nombre
												FROM ((signot_proceso p INNER JOIN signot_parteproceso pp ON p.id = pp.idproceso)
												INNER JOIN signot_parte sp ON pp.idparte = sp.id)
												WHERE p.radicado = '$idrad' AND pp.idclaseparte = 2 ");
		}
										  
		
	
		$listar->execute();
			  
		return $listar; 
	
   }  	
   
   public function Obtener_Datos_Oficina(){
	
			  
		
		$listar     = $this->db->prepare("SELECT * FROM pa_datos_oficina");
		
		$listar->execute();
			  
		return $listar; 
	
   }  	
   
  
}/*Cierra Model*/

?>

<?php

$opcion = $_GET['opcion'];
$iddoc  = $_GET['id'];

$datosx = trim($_GET['datosx']);

$datosnotificacion = explode("//////",$datosx);

$iddoc     = $datosnotificacion[0];
$nombredoc = $datosnotificacion[1];
$idrad	   = $datosnotificacion[3];


/*if(($id_despacho=="1" and $id_area=="1") or ($id_despacho=="2" and $id_area=="1") or ($id_despacho=="10" and $id_area=="1") or ($id_despacho=="12" and $id_area=="1") )
{Nelcy Castaño Salgado} 
elseif (($id_despacho=="5" and $id_area=="1")or($id_despacho=="8" and $id_area=="1")or($id_despacho=="9" and $id_area=="1")or($id_despacho=="11" and $id_area=="1")) 
{ Diana Marcela Ospina Henao.}  
elseif (($id_despacho=="3" and $id_area=="1")or($id_despacho=="4" and $id_area=="1")or($id_despacho=="6" and $id_area=="1")or($id_despacho=="7" and $id_area=="1")) 
{ Juan Sebastián Lopez Galvez.} */


if($opcion == 1){

	require_once ('views/PHPWord_0.6.2_Beta/PHPWord.php');
	
	// New Word Document
	//INSTANCIAMOS LA LIBRERIA
	$PHPWord = new PHPWord();
	
	//CREAMOS EL OBJETO DATA PARA DAR USO DE LAS FUNCIONES DEL MODELO wordModel()
	$data         = new signotwordModel();
	
	$datosoficina = $data->Obtener_Datos_Oficina();
	
	//OBTENEMOS LOS DATOS DE LA OFICINA, PARA SER UTILIZADOS EN EL DOCUMENTO
	//COMO NOMBRE DE LA OFICINA, SECRETARIO ETC...
	while( $filao = $datosoficina->fetch() ){
	
			$datoofi1  = $filao[nombre];
			$datoofi2  = $filao[sigla];
			$datoofi3  = $filao[direccion];
			$datoofi4  = $filao[telefono];
			$datoofi5  = $filao[secretario];
			$datoofi6  = $filao[coordinadora];
	}
	
	
	
	
	$vector_datos = $data->Obtener_Datos_Documento($iddoc);
	
	//OBTENEMOS LOS DATOS DE LA CONSULTA ANTERIOR
	while( $field = $vector_datos->fetch() ){
	
	
			$datos0  = $field[nombre];
			$datos1  = $field[direccion];
			$datos2  = $field[departamento];
			$datos3  = $field[municipio];
			$datos4  = $field[juzgado];
			$datos5  = $field[descorrecion];
			$datos6  = $field[Cod_departamento];
			
			/*$datos7  = $field[contenido];
			$datos8  = $field[fechageneracion];
			
			$datosir = $field[idradicado];
			
			$datospartes = $field[partes];*/

	}
	
	$Lista_Clase_Parte = $data->Obtener_Demandante_Demandado(1,$idrad);
	
	//OBTENEMOS LOS DATOS DE LA CONSULTA ANTERIOR
	while( $field = $Lista_Clase_Parte->fetch() ){
	
		//NO SE USA EL CONCATENADO YA QUE SOLO SE PIDE QUE SALGA UNO DE LOS DEMANDADOS
		//$datopartedmdte = $field[nombre]." , ".$datopartedmdte;
		
		$datopartedmdte = $field[nombre];
		
	}
	
	$Lista_Clase_Parte = $data->Obtener_Demandante_Demandado(2,$idrad);
	
	//OBTENEMOS LOS DATOS DE LA CONSULTA ANTERIOR
	while( $field = $Lista_Clase_Parte->fetch() ){
	
		$datopartedmddo = $field[nombre]." , ".$datopartedmddo;
		
	}
	
	 
	//VALIDACIONES PARA CONOCER CUANTOS DIAS CUENTA EL AUTO
	//SI ES EN MANIZALES 5, POR FUERA DE MANIZALES 10 Y EL EXTERIOR 30 
	if( trim($datosnotificacion[10]) == trim("Caldas") ){
		
		$cantdias =  "CINCO (05) DÍAS HÁBILES";
	}
	if( trim($datosnotificacion[10]) != trim("Caldas") && trim($datosnotificacion[10]) != trim("EXTERIOR") ){
		
		$cantdias =  "DIEZ (10) DÍAS HÁBILES";
	}
	if( trim($datosnotificacion[10]) == trim("EXTERIOR") ){
		
		$cantdias =  "TREINTA (30) DÍAS HÁBILES";
	}
	//-----------------------------------------------------------------------
	
	//EMPEZAMOS LA GENERACION DEL DOCUMENTO 
	//ORIENTACION HORIZONTAL Y TAMAÑO OFICIO
	//SI NO SE DEFINE pageSizeW - pageSizeH
	//TOMA EL VALOR DE CARTA A4  11906 - 16838
	$sectionStyle = array(
						'orientation' => 'portrait',
						'pageSizeW'   => '12241',
						'pageSizeH'   => '20160',
					);

	$section = $PHPWord->createSection($sectionStyle);
	
	//--------------------ESTILOS A USAR EN EL DOCUMENTO------------------------------------------------------------------------------------
	
	$fontStyleA  = array ('bold' => true,'size'=>11);
	$paraStyleA2 = array ('align' => 'center');
	
	$fontStyleB  = array ('size'=>11);
	$paraStyleB2 = array ('align' => 'both');//'align' => 'both' TEXTO JUSTIFICADO
	
	$fontStyleC  = array ('bold' => true,'size'=>11);
	$paraStyleC2 = array ('align' => 'left');
	
	$fontStyleD  = array ('bold' => true,'size'=>11);
	$paraStyleD2 = array ('align' => 'left');
	
	$fontStyleE  = array ('bold' => true,'size'=>6);
	$paraStyleE2 = array ('align' => 'center');
	
	$fontStyleF  = array ('size'=>6);
	$paraStyleF2 = array ('align' => 'both');
	
	//PARA PONER COLOR A UNA SECCION
    $fontStyleP = array('size' => 11, 'color' => 'EC1A12', 'bold' => true);
	
	//PARA LAS TABLAS
	$fontStyleT  = array ('bold' => true,'size'=>9);
	$paraStyleT2 = array ('align' => 'center');
	
	$fontStyleTB   = array ('bold' => false,'size'=>6);
	$paraStyleTB2  = array ('align' => 'left');
	$paraStyleTB2B = array ('align' => 'both');
	
	$fontStyleTC  = array ('bold' => true,'size'=>8);
	$paraStyleTC2 = array ('align' => 'center');
	
	$fontStyleIDDOC  = array ('bold' => true,'size'=>5);
	$paraStyleIDDOC2 = array ('align' => 'left');
	
	// Define cell style arrays
	$styleCell   = array('valign'=>'center');
	$styleCellCombinadas  = array('gridSpan' => 2,'valign'=>'center','borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
	$styleCellCombinadas2 = array('gridSpan' => 2,'valign'=>'center','borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
	$styleCellCombinadas3 = array('gridSpan' => 2,'valign'=>'center','borderSize'=>5, 'borderBottomColor'=>'000000', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
	
	//-----------------------------ENCABEZADO DEL DOCUMENTO-----------------------------------------------------------------
	$header = $section->createHeader();
	$table  = $header->addTable();
	$table->addRow();
	$table->addCell(2000)->addImage('views/images/encabezado.jpg', array('width'=>599, 'height'=>126, 'align'=>'center'));
	//$table->addCell(4500)->addText('Centro de Servicios Judiciales Manizales Civil - Familia',$fontStyle1, $fontStyle1);
	//----------------------------------------------------------------------------------------------------------------------
	

	//DOS ESPACIOS EN BLANCO ENTRE UN PARRAFO Y OTRO
	//$section->addTextBreak(2);
	
	//************************************************FIN OFICIOS*********************************************************************
	
			
			$section->addText("CITACIÓN PARA DILIGENCIA DE NOTIFICACIÓN PERSONAL", $fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//fecha, FUNCION -->ucwords — Convierte a mayúsculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fechaactual =date('Y-m-d');
			//$fecha = strftime('%B %d de %Y', strtotime($fechaactual));  
			//SE REALIZA ESTE CAMBIO YA QUE NO ES LA FECHA ACTUAL, SI NO LA FECHA DE REGISTRO
			$fecha = strftime('%B %d de %Y', strtotime($datosnotificacion[6]));
			$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($datosnotificacion[7]));
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			
			if( trim($datosnotificacion[10]) != trim("EXTERIOR") ){
			
				$conttabla = 0;
				
				while($conttabla < 8){
				
					if($conttabla == 0){$campofila = "SEÑO(A):";          $campofila2 = strtoupper($datosnotificacion[2]);}
					if($conttabla == 1){$campofila = "DIRECCION:";         $campofila2 = strtoupper($datosnotificacion[8]);}
					if($conttabla == 2){$campofila = "CIUDAD:";            $campofila2 = strtoupper($datosnotificacion[11])." - ".strtoupper($datosnotificacion[10]);}
					if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN:"; $campofila2 = strtoupper($datosnotificacion[4]);}
					if($conttabla == 4){$campofila = "PROCESO:";           $campofila2 = strtoupper($datosnotificacion[12]);}
					if($conttabla == 5){$campofila = "RADICADO:";          $campofila2 = strtoupper($datosnotificacion[3]);}
					if($conttabla == 6){$campofila = "DEMANDANTE:";        $campofila2 = strtoupper($datopartedmdte);}
					if($conttabla == 7){$campofila = "DEMANDADO:";         $campofila2 = strtoupper($datosnotificacion[2]);}
					
					
					//PARAMETROS PARA LA TABLA
					$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					//PARAMETROS DE LA FILA
					$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					
					//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
					$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
					//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
					$table1 = $section->addTable('myOwnTableStyle');
					$table1->addRow(500);
					//ADICIONE EL TEXTO A LAS CELDAS
					$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
					$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
					
					$conttabla = $conttabla + 1;
				}
			
			}
			else{
			
				$conttabla = 0;
				
				while($conttabla < 7){
				
					if($conttabla == 0){$campofila = "Señor(a):";           $campofila2 = $datosnotificacion[2];}
					if($conttabla == 1){$campofila = "Ciudad / Dirección:"; $campofila2 = $datosnotificacion[8];}
					if($conttabla == 2){$campofila = "JUZGADO DE ORIGEN:";  $campofila2 = $datosnotificacion[4];}
					if($conttabla == 3){$campofila = "PROCESO:";            $campofila2 = $datosnotificacion[12];}
					if($conttabla == 4){$campofila = "RADICADO:";           $campofila2 = $datosnotificacion[3];}
					if($conttabla == 5){$campofila = "DEMANDANTE(S):";      $campofila2 = $datopartedmdte;}
					if($conttabla == 6){$campofila = "DEMANDADO(S):";       $campofila2 = $datosnotificacion[2];}
					
					
					//PARAMETROS PARA LA TABLA
					$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					//PARAMETROS DE LA FILA
					$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					
					//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
					$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
					//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
					$table1 = $section->addTable('myOwnTableStyle');
					$table1->addRow(500);
					//ADICIONE EL TEXTO A LAS CELDAS
					$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
					$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
					
					$conttabla = $conttabla + 1;
				}

			
			
			}
			
			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
			
			$section->addText("Sírvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la dirección que aparece al pie de la presente página, dentro de los ".$cantdias." siguientes a la entrega de esta comunicación, de lunes a viernes de 8:00 a 12:30 y de 1:30 a 5:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y mediante el cual se da ".$datosnotificacion[5]." ".$datos5.".",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 8){
			
				if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
				if($conttabla == 1){$campofila = "";                     $campofila2 = "";}
				if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
				if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
				if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
				if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
				if($conttabla == 6){$campofila = "";                     $campofila2 = "Número de cédula";}
				if($conttabla == 7){$campofila = "";                     $campofila2 = "Fecha:";}
				
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow(500);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			//AYUDA A IDENTIFICAR EL ID DEL AUTO, PARA CUALQUIER CASO DE CORRECCION O INCONSISTENCIA
			$section->addTextBreak(6);
			$section->addText($iddoc,$fontStyleIDDOC, $paraStyleIDDOC2);
			//----------------------------------------------------------------------------------------------------------------------
			
			/*$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi6,$fontStyleB, $paraStyleB2);
			$section->addText("Secretaria",$fontStyleB, $paraStyleB2);*/
			
	//------------------------------------------------------------------------------------------------------------------------------
	
	//pie de página
	$footer = $section->createFooter();
	$table  = $footer->addTable();
	$table->addRow();
	//$table->addCell(2000)->addImage('views/images/piepagina2.jpg', array('width'=>488, 'height'=>79, 'align'=>'right'));
	$table->addCell(2000)->addImage('views/images/piepagina2.jpg', array('width'=>599, 'height'=>79, 'align'=>'right'));
	//$footer->addPreserveText('Carrera 23 N° 21-48- Palacio de Justicia "Fanny González Franco" Oficina 108 - Teléfono 8879665 Manizales, Caldas',$fontStyle1, $fontStyle1);
	

	// Save File
	$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
	$objWriter->save('views/word/'.$nombredoc.'.doc');
	$file      = 'views/word/'.$nombredoc.'.docx';
	$id        = $nombredoc.'.docx';
	
	//$datos1 = "xxxxx";
	//$objWriter->save('views/word/'.$datos1.'.doc');
	//$file      = 'views/word/'.$datos1.'.docx';
	//$id        = $datos1.'.docx';
	
	$enlace = $file; 
	
	$enlace = 'views/word/'.$nombredoc.'.doc'; 
	header ("Content-Disposition: attachment; filename=".$id); 
	header ("Content-Type: application/octet-stream");
	header ("Content-Length: ".filesize($enlace));
	readfile($enlace);
	
}

?>