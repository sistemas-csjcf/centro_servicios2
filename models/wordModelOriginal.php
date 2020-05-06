<?php
	class wordModel extends modelBase{
		/************************ Se obtiene los datos del documento *************************************/
		public function Obtener_Datos_Documento($iddoc){
			//ini_set('max_execution_time', 240); //240 segundos = 4 minutos
			$listar     = $this->db->prepare("SELECT rds.id,rds.identrada,td.nombre_tipo_documento,td.id AS iddocumento,rds.numero,d.nombre_dirigido,rds.nombre,rds.cargo,rds.dependencia,
										  rds.fechageneracion,rds.asunto,rds.contenido, rds.con_copia
				FROM ((sigdoc_documentos_internos rds LEFT JOIN sigdoc_pa_tipodocumento td ON rds.idtipodocumento = td	.id)
				LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
				WHERE rds.id = '$iddoc'");
		
		$listar->execute();
			  
		return $listar; 
   	}  	
   
   	function Validar_Campo($campo){
   
		if (!empty($campo) && $campo != "" && $campo != "No Aplica") {
			return 1;
		}else{
			return 0;
		}
	}

}/*Cierra Model*/

?>
<?php
	$opcion = $_GET['opcion'];
	$iddoc  = $_GET['id'];

	$datosx  = $_GET['datosx'];

	if($opcion == 1){

		require_once ('views/PHPWord_0.6.2_Beta/PHPWord.php');
	
		// New Word Document
		//INSTANCIAMOS LA LIBRERIA
		$PHPWord = new PHPWord();
		
		//CREAMOS EL OBJETO DATA PARA DAR USO DE LAS FUNCIONES DEL MODELO wordModel()
		$data         = new wordModel();
		$vector_datos = $data->Obtener_Datos_Documento($iddoc);
		
		//OBTENEMOS LOS DATOS DE LA CONSULTA ANTERIOR
		while( $field = $vector_datos->fetch() ){
			
			$datos0  = $field[nombre_tipo_documento];
			$datos0b = $field[iddocumento];
			
			$datos1  = $field[numero];
			$datos2  = $field[nombre_dirigido];
			$datos3  = $field[nombre];
			$datos4  = $field[cargo];
			$datos5  = $field[dependencia];
			$datos6  = $field[asunto];
			$datos7  = $field[contenido];
			$datos8  = $field[fechageneracion];
			//JUAN ESTEBAN MUNERA BETANCUR 2017-09-29
			$datos9  = $field[con_copia];

		}
	
		//EMPEZAMOS LA GENERACION DEL DOCUMENTO 
		$section = $PHPWord->createSection();
		
		//--------------------ESTILOS A USAR EN EL DOCUMENTO------------------------------------------------------------------------------------
		$fontStyle45 = array ('bold' => true,'size'=>11);
		$fontStyle46 = array ('size'=>11);
		$paraStyle45 = array ('align' => 'both');
		$paraStyle45b = array ('align' => 'center');
		
		$fontStylem = array ('size'=>11);
		$paraStylem = array ('align' => 'both');
		
		$fontStylejuz = array ('bold' => true,'size'=>11);
		$paraStylejuz = array ('align' => 'center');

		$fontStyleTC  = array ('bold' => true,'size'=>11);
		$paraStyleTC2 = array ('align' => 'both');
		
		$fontStyle1            = array('name'=>'Times New Roman','size'=>11,'color'=>'lightGray','bold'=>true,'italic'=>true,'align'=>'center');
		$fontStyle2            = array('name'=>'Arial','size'=>11,'align'=>'both','bold'=>false);
		$fontStyle3            = array('name'=>'Arial','size'=>11,'align'=>'both');
		$fontStyle4            = array('name'=>'Arial','size'=>11,'align'=>'center');
		$fontStyle4x           = array('name'=>'Arial','size'=>11,'align'=>'center','bold' => true);
		$fontStyleEM           = array('name'=>'Arial','size'=>9,'align'=>'center');

		$fontStylecuerpo       = array('name'=>'Arial','size'=>11);
		$paraStylemcuerpo      = array ('align' => 'both');
		
		$fontStyleelaboradopor = array('name'=>'Arial','size'=>8,'align'=>'both');
		//---------------------------------------------------------------------------------------------------------------------------------------
		
		//-----------------------------ENCABEZADO DEL DOCUMENTO-----------------------------------------------------------------
	//	$header = $section->createHeader();
	//	$table  = $header->addTable();
	//	$table->addRow();
	//	$table->addCell(2000)->addImage('views/images/encabezado.jpg', array('width'=>599, 'height'=>90, 'align'=>'center'));
		//$table->addCell(4500)->addText('Centro de Servicios Judiciales Manizales Civil - Familia',$fontStyle1, $fontStyle1);
		//----------------------------------------------------------------------------------------------------------------------
		
		
		//DOS ESPACIOS EN BLANCO ENTRE UN PARRAFO Y OTRO
		$section->addTextBreak(2);
		
		//----------------------DATOS CARGADOS DE LA CONSULTA Obtener_Datos_Documento UBICADOS DENTRO DEL DOCUMENTO--------------
		
		//SI ES TIPO OFICIO
		if($datos0b == 2){
			// JUAN ESTEBAN MUNERA BETANCUR 2018-08-22--------------------------------
			$header = $section->createHeader();
            $table  = $header->addTable();
            $table->addRow();
            $table->addCell(2000)->addImage('views/images/header_docs/enca_oficio.png', array('width'=>600, 'height'=>100, 'align'=>'center'));



			$section->addText($datos0." No.".$datos1,$fontStyle4x);
			
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%d de %B del %Y', strtotime($datos8));  
			$section->addText("Manizales, ".$fecha,$fontStyle4);
			
			$section->addTextBreak(1);
		
			$section->addText($datos2,$fontStyle4x);//tipo de dirigido a
			
			if($data->Validar_Campo($datos3) == 1){
			$section->addText($datos3,$fontStyle4x);//nombre
			}
			
			if($data->Validar_Campo($datos4) == 1){
			$section->addText($datos4,$fontStyle4x);//cargo
			}
			
			if($data->Validar_Campo($datos5) == 1){
			$section->addText($datos5,$fontStyle4x);//dependencia 
			}
			
			$section->addTextBreak(1);
			
			$section->addText("Asunto: ".$datos6,$fontStyle4);//Asunto
			
			$section->addTextBreak(1);
			
			$section->addText("Cordial saludo.",$fontStyle4);
			
			$section->addTextBreak(1);
			
			$section->addText($datos7,$fontStylecuerpo,$paraStylemcuerpo);//contenido del documento
			
			$section->addTextBreak(1);
			
			$section->addText('Atentamente,',$fontStyle4);
			$section->addTextBreak(4);
			$section->addText('                ',$fontStyle3);
			$section->addText('NATALIA QUINTERO HOYOS', $fontStyle45, $paraStyle45);
			$section->addText('Coordinadora.',$fontStyle46, $paraStyle45);
			// JUAN ESTEBAN MUNERA BETANCUR / 2017-09-28
	        $section->addText($datos9,$fontStyleEm); // DOCUMENTOS ADJUNTOS 
			
			$section->addTextBreak(1);
			
			/*if($data->Validar_Campo($datos7) == 1){
			$section->addText('Elaborado por: '.$datos7,$fontStyleelaboradopor);
			}
			
			$section->addText('Usuario que imprime: '.$_SESSION['nombre'],$fontStyleelaboradopor);*/
		
		}
	
		//SI ES TIPO CIRCULAR
		if($datos0b == 1){
			// JUAN ESTEBAN MUNERA BETANCUR 2018-08-22--------------------------------
			$header = $section->createHeader();
            $table  = $header->addTable();
            $table->addRow();
            $table->addCell(2000)->addImage('views/images/header_docs/enca_circular.png', array('width'=>600, 'height'=>100, 'align'=>'center'));
            


			$section->addText($datos1,$fontStyle45, $paraStyle45b);
			
			$section->addTextBreak(1);
			
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%d de %B del %Y', strtotime($datos8));  
			//$section->addText("FECHA: ".$fecha,$fontStyle4x);
			//if($data->Validar_Campo($datos3) == 1){
			//$section->addText("PARA: ".$datos3,$fontStyle4x);//nombre
			//}
			//$section->addText("ASUNTO: ".$datos6,$fontStyle4x);//Asunto
			
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
				
			while($conttabla < 3){
				
				if($conttabla == 0){$campofila = "FECHA: ";  $campofila2 = $fecha;}
				
				if($data->Validar_Campo($datos3) == 1){
					
					if($conttabla == 1){$campofila = "PARA: ";   $campofila2 = $datos3;}
				}
				
				if($conttabla == 2){$campofila = "ASUNTO: "; $campofila2 = $datos6;}
				
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
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleTC, $paraStyleTC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTC, $paraStyleTC2);
				
				$conttabla = $conttabla + 1;
			}		

			$section->addTextBreak(1);
			
			$section->addText("Cordial saludo.",$fontStyle4);
			
			$section->addTextBreak(1);
			
			$section->addText($datos7,$fontStylecuerpo,$paraStylemcuerpo);//contenido del documento
			
			$section->addTextBreak(1);
			
			$section->addText('Atentamente,',$fontStyle4);
			$section->addTextBreak(4);
			$section->addText('                ',$fontStyle3);
			$section->addText('NATALIA QUINTERO HOYOS', $fontStyle45, $paraStyle45);
			$section->addText('Coordinadora.',$fontStyle46, $paraStyle45);
			// JUAN ESTEBAN MUNERA BETANCUR / 2017-09-28
	        $section->addText($datos9,$fontStyleEm); // DOCUMENTOS ADJUNTOS 
		
		}
	
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
		$objWriter->save('views/word/'.$datos1.'.doc');
		$file      = 'views/word/'.$datos1.'.docx';
		$id        = $datos1.'.docx';
		
		$enlace = $file; 
		
		$enlace = 'views/word/'.$datos1.'.doc'; 
		header ("Content-Disposition: attachment; filename=".$id); 
		header ("Content-Type: application/octet-stream");
		header ("Content-Length: ".filesize($enlace));
		readfile($enlace);
	}
?>