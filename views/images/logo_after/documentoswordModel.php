<?php
class documentoswordModel extends modelBase
{


	/************************ Se obtiene los datos del documento *************************************/

	public function Obtener_Datos_Documento($iddoc){
	
		//ini_set('max_execution_time', 240); //240 segundos = 4 minutos
		
		$listar     = $this->db->prepare("SELECT rds.id,rds.idradicado,td.nombre_tipo_documento,td.id AS iddocumento,rds.numero,d.nombre_dirigido,
										  rds.nombre,rds.direccion,rds.ciudad,rds.fechageneracion,rds.fechaauto,rds.asunto,rds.contenido,rds.partes,
										  do.id AS iddoc,do.nombre_documento,rds.descorrecion,rds.fechaautocorrige,rds.idautonotifica
										  FROM (((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
										  LEFT JOIN pa_documento do ON td.iddocumento = do.id)
										  LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
										  WHERE rds.id = '$iddoc'");
										  
		
	
		$listar->execute();
			  
		return $listar; 
	
   }  	
   
   public function Obtener_Datos_Oficina(){
	
			  
		
		$listar     = $this->db->prepare("SELECT * FROM pa_datos_oficina");
		
		$listar->execute();
			  
		return $listar; 
	
   }  	
   
   public function Obtener_Datos_Radicado($iddoc){
   
   		
								  
		/*$listar     = $this->db->prepare("SELECT di.id,pro.radicado,jo.id AS idjuzgado,jo.nombre,cpro.nombre_proceso,
										  pr.nombre AS demandado,pr.cedula AS cedulademandado,pr2.nombre AS demandante,pr2.cedula AS cedulademandante
										  FROM ((((((documentos_internos di INNER JOIN signot_parte pr ON di.idparte = pr.id)
										  INNER JOIN signot_proceso pro ON pro.id = di.idradicado)
										  INNER JOIN pa_juzgado jo ON jo.id = pro.idjuzgadoorigen)
										  INNER JOIN signot_pa_clase_proceso cpro ON cpro.id = pro.idclaseproceso)
										  INNER JOIN signot_parteproceso pp ON pp.idproceso = di.idradicado AND pp.idclaseparte = 1)
										  INNER JOIN signot_parte pr2 ON pr2.id = pp.idparte)
										  WHERE di.id = '$iddoc'");*/
										  
										  
		$listar     = $this->db->prepare("SELECT di.id,pro.radicado,jo.id AS idjuzgado,jo.nombre,cpro.nombre_proceso,
										  pr.nombre AS demandado,pr.cedula AS cedulademandado,pr2.nombre AS demandante,pr2.cedula AS cedulademandante
										  FROM ((((((documentos_internos di LEFT JOIN signot_parte pr ON di.idparte = pr.id)
										  LEFT JOIN signot_proceso pro ON pro.id = di.idradicado)
										  LEFT JOIN pa_juzgado jo ON jo.id = pro.idjuzgadoorigen)
										  LEFT JOIN signot_pa_clase_proceso cpro ON cpro.id = pro.idclaseproceso)
										  LEFT JOIN signot_parteproceso pp ON pp.idproceso = di.idradicado AND pp.idclaseparte = 1)
										  LEFT JOIN signot_parte pr2 ON pr2.id = pp.idparte)
										  WHERE di.id = '$iddoc'");
		
		$listar->execute();
			  
		return $listar; 
   
   }
   
   //FUNCION USADA CUANDO EN LA TABLA documentos_internos EN LA COLUMNA idparte NO SE GRABA NADA, COMO ES EL CASO DE LAS DEVOLUCIONES
   public function Obtener_Datos_Radicado_2($iddoc){
   
   		
								  
		/*$listar     = $this->db->prepare("SELECT di.id,pro.radicado,jo.id AS idjuzgado,jo.nombre,cpro.nombre_proceso,
										  pr.nombre AS demandado,pr.cedula AS cedulademandado,pr2.nombre AS demandante,pr2.cedula AS cedulademandante
										  FROM (((((((documentos_internos di INNER JOIN signot_proceso pro ON pro.id = di.idradicado)
										  INNER JOIN pa_juzgado jo ON jo.id = pro.idjuzgadoorigen)
										  INNER JOIN signot_pa_clase_proceso cpro ON cpro.id = pro.idclaseproceso)
										  INNER JOIN signot_parteproceso pp ON pp.idproceso = di.idradicado AND pp.idclaseparte = 2)
										  INNER JOIN signot_parte pr ON pr.id = pp.idparte)
										  INNER JOIN signot_parteproceso pp2 ON pp2.idproceso = di.idradicado AND pp2.idclaseparte = 1)
										  INNER JOIN signot_parte pr2 ON pr2.id = pp2.idparte)
										  WHERE di.id = '$iddoc'
										  GROUP BY di.id");*/
										  
										  
		$listar     = $this->db->prepare("SELECT di.id,pro.radicado,jo.id AS idjuzgado,jo.nombre,cpro.nombre_proceso,
										  pr.nombre AS demandado,pr.cedula AS cedulademandado,pr2.nombre AS demandante,pr2.cedula AS cedulademandante
										  FROM (((((((documentos_internos di LEFT JOIN signot_proceso pro ON pro.id = di.idradicado)
										  LEFT JOIN pa_juzgado jo ON jo.id = pro.idjuzgadoorigen)
										  LEFT JOIN signot_pa_clase_proceso cpro ON cpro.id = pro.idclaseproceso)
										  LEFT JOIN signot_parteproceso pp ON pp.idproceso = di.idradicado AND pp.idclaseparte = 2)
										  LEFT JOIN signot_parte pr ON pr.id = pp.idparte)
										  LEFT JOIN signot_parteproceso pp2 ON pp2.idproceso = di.idradicado AND pp2.idclaseparte = 1)
										  LEFT JOIN signot_parte pr2 ON pr2.id = pp2.idparte)
										  WHERE di.id = '$iddoc'
										  GROUP BY di.id");
		
		$listar->execute();
			  
		return $listar; 
   
   }
   
   public function Obtener_Responsable($idres,$idcampo){
   
   		
		if($idcampo == 1){
								  
			$listar = $this->db->prepare("SELECT pu.empleado
										  FROM (pa_juzgado pj INNER JOIN pa_usuario pu ON pj.idusuariojuzgadocargo = pu.id)
										  WHERE pj.id = '$idres'");
		}
		
		if($idcampo == 2){
								  
			$listar = $this->db->prepare("SELECT pu.empleado
										  FROM (pa_juzgado pj INNER JOIN pa_usuario pu ON pj.idusuariojuzgado = pu.id)
										  WHERE pj.id = '$idres'");
		}
		
		
		$listar->execute();
			  
		return $listar; 
   
   }
   
   public function get_lista_modulos_acciones($campos,$nombrelista,$idaccion,$campoordenar){
	
		$listar     = $this->db->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
	
  		$listar->execute();

  		return $listar;
	
	}
   

}/*Cierra Model*/

?>

<?php

//CREAMOS EL OBJETO DATA PARA DAR USO DE LAS FUNCIONES DEL MODELO wordModel()
$data         = new documentoswordModel();

$opcion = $_GET['opcion'];
$iddoc  = $_GET['id'];
$idtd   = $_GET['idtd'];

//DATOS DOCUMENTO
$nombreddo = $_GET['nombreddo'];

//PARA LA CARATULA
$idradicadocaratula  = trim($_GET['idradicadocaratula']);
$idcaratulaplantilla = $_GET['idcaratula'];

//ME PERMITE IDENTIFICAR QUE TIPOS DE DOCUMENTOS SON DEVOLUCIONES PARA QUE AL GENERAR 
//LA PLANTILLA USE OTRA FUNCION EN EL MODELO documentoswordModel.php
$campos              = 'idtabla';
$nombrelista         = 'pa_modulo_acciones';

$idaccion			 = '7';
$campoordenar        = 'id';
$datosmodulos        = $data->get_lista_modulos_acciones($campos,$nombrelista,$idaccion,$campoordenar);
$modulost1           = $datosmodulos->fetch();
$modulost2			 = explode("////",$modulost1[idtabla]);


$idaccion			 = '8';
$campoordenar        = 'id';
$datosmodulos        = $data->get_lista_modulos_acciones($campos,$nombrelista,$idaccion,$campoordenar);
$modulost1           = $datosmodulos->fetch();
$modulost2b			 = explode("////",$modulost1[idtabla]);

if($opcion == 1){

	require_once ('views/PHPWord_0.6.2_Beta/PHPWord.php');
	
	// New Word Document
	//INSTANCIAMOS LA LIBRERIA
	$PHPWord = new PHPWord();
	
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
				
			$datos0   = $field[nombre_tipo_documento];
			$datos0b  = $field[iddoc];//ID DOCUMENTO
			$datos0b2 = $field[nombre_documento];//NOMBRE DOCUMENTO
			$datos0c  = $field[iddocumento];//ID TIPO DOCUMENTO
				
			$datos1  = $field[numero];
			$datos2  = $field[nombre_dirigido];
			$datos3  = $field[nombre];
			$datos4  = $field[direccion];
			$datos5  = $field[ciudad];
			$datos6  = $field[asunto];
			$datos7  = $field[contenido];
			$datos8  = $field[fechageneracion];
			$datos9  = $field[fechaauto];
			$datos10 = $field[descorrecion];
			$datos11 = $field[fechaautocorrige];
				
			$datosir = $field[idradicado];
				
			$datospartes = $field[partes];
			
			$datosidautonotifica = $field[idautonotifica];
	
	}	
	
	//----------------------------------------------------------------------------------------
	
	//NOTA: //CUANDO EN LA TABLA documentos_internos EN LA COLUMNA idparte NO SE GRABA NADA, COMO ES EL CASO DE LAS DEVOLUCIONES
	//ME PERMITE IDENTIFICAR QUE TIPOS DE DOCUMENTOS SON DEVOLUCIONES PARA QUE AL GENERAR LA PLANTILLA USE OTRA FUNCION 
	//EN EL MODELO documentoswordModel.php
	
	//OBTENEMOS LOS DATOS DEL RADICADO
	if ( in_array($idtd,$modulost2) ) {
	
		$datosradicado = $data->Obtener_Datos_Radicado_2($iddoc);
		
		while( $filar = $datosradicado->fetch() ){
		
		
				$dator1  = $filar[id];
				$dator2  = $filar[radicado];
				$dator3  = $filar[nombre];
				$dator4  = $filar[nombre_proceso];
				$dator5  = $filar[demandado];
				$dator6  = $filar[cedulademandado];
				$dator7  = $filar[demandante];
				$dator8  = $filar[cedulademandante];
				
				$dator9  = $filar[idjuzgado];
				
				
		}
	}
	else{
		
		$datosradicado = $data->Obtener_Datos_Radicado($iddoc);
		
		while( $filar = $datosradicado->fetch() ){
		
		
				$dator1  = $filar[id];
				$dator2  = $filar[radicado];
				$dator3  = $filar[nombre];
				$dator4  = $filar[nombre_proceso];
				$dator5  = $filar[demandado];
				$dator6  = $filar[cedulademandado];
				$dator7  = $filar[demandante];
				$dator8  = $filar[cedulademandante];
				
				$dator9  = $filar[idjuzgado];
				
		}
	}
	
	//ESTO ME PERMITE IDENTIFICAR QUE EL DOCUMENTO A PROCESAR ES UNA NOTIFICACION QUE FUE REGISTRADA
	//DESDE LA VISTA documentos_generar.php YA QUE ES POSIBLE QUE UNA PERSONA VENGA A NOTIFICARSE SIN 
	//TENER UNA CITACION REGISTRADA, ES DECIR UNA CITACION PARA ARMAR LA NOTIFICACION DESDE LA VISTA
	//documentos_listar.php, ESTO SE REALIZA PREGUNTANDO SI EL ID DEL DOCUMENTO ES UNA NOTIFICACION
	//Y SI EL CAMPO $datosidautonotifica = $field[idautonotifica]; EN LA TABLA documentos_internos
	//ES NULL
	if ( in_array($datos0c,$modulost2b) && is_null($datosidautonotifica) ) {
	//if ( in_array($datos0c,$modulost2b) && $datosidautonotifica = " " ) {
	
		//$datos6 = "(  POR FAVOR DEFINA EL TIPO DE AUTO )";
		
		//$datos6 = "(______________________)";
		
		$datos6 = "______________________";
	
		//echo '<font color="red">Esto es un texto en rojo.</font>';
	}
	
	//EMPLEADO RESPONSABLE DE UN JUZGADO EN LA CITACIONES
	$datosresponsable = $data->Obtener_Responsable($dator9,1);
	$filres           = $datosresponsable->fetch();
	$nombrelider      = $filres[empleado];
	//$nombrelider = "Jorge Andres Valencia Orozco";
	
	//EMPLEADO QUE ENTREGA A LOS JUZGADOS EN LAS DEVOLUCIONES
	$datosresponsable = $data->Obtener_Responsable($dator9,2);
	$filres           = $datosresponsable->fetch();
	$nombreentrega    = $filres[empleado];
	
	//ACUERDO
	$acuerdo = "Acuerdo 2255 de 2003 NP-01";

	
	//VALIDACIONES PARA CONOCER CUANTOS DIAS CUENTA EL AUTO
	//SI ES EN MANIZALES 5, POR FUERA DE MANIZALES 10 Y EL EXTERIOR 30 
	if( trim($datos5) == trim("Caldas - MANIZALES") ){
		
		$cantdias =  "CINCO (05) D�AS H�BILES";
	}
	if( trim($datos5) != trim("Caldas - MANIZALES") && trim($datos5) != trim("EXTERIOR - FUERA DE COLOMBIA") ){
		
		$cantdias =  "DIEZ (10) D�AS H�BILES";
	}
	if( trim($datos5) == trim("EXTERIOR - FUERA DE COLOMBIA") ){
		
		$cantdias =  "TREINTA (30) D�AS H�BILES";
	}
	

	//EMPEZAMOS LA GENERACION DEL DOCUMENTO 
	//ORIENTACION HORIZONTAL Y TAMA�O OFICIO
	//SI NO SE DEFINE pageSizeW - pageSizeH
	//TOMA EL VALOR DE CARTA A4  11906 - 16838
	$sectionStyle = array(
						'orientation' => 'portrait',
						'pageSizeW'   => '12241',
						//'pageSizeH'   => '20160', //----> OFICIO 216 X 356 mm
						'pageSizeH'   => '18720',  //----> OFICIO 216 X 330 mm
						
					);

	//$section = $PHPWord->createSection($sectionStyle);
	
	
	
	$sectionStyleCaratula = array(
									'orientation' => 'portrait',
									'pageSizeW'   => '12241',    //----> OFICIO 216 X 330 mm
									//'pageSizeH'   => '20160', //----> OFICIO 216 X 356 mm
									'pageSizeH'   => '18720',  //----> OFICIO 216 X 330 mm
									'borderColor' =>'#000000', 
									'borderSize'  =>2,
						
					);

	if($datos0c != 400 && $idcaratulaplantilla != 400){
	
		$section = $PHPWord->createSection($sectionStyle);
		
		$section2 = $PHPWord->createSection($sectionStyle);
	
	}
	else{
	
		$section = $PHPWord->createSection($sectionStyleCaratula);
	}
	
	//--------------------ESTILOS A USAR EN EL DOCUMENTO------------------------------------------------------------------------------------
	
	$fontStyleA  = array ('bold' => true,'size'=>11);
	$paraStyleA2 = array ('align' => 'center');
	
	$fontStyleB  = array ('size'=>10);
	$paraStyleB2 = array ('align' => 'both');//'align' => 'both' TEXTO JUSTIFICADO
	
	$fontStyleC  = array ('bold' => true,'size'=>8);
	$paraStyleC2 = array ('align' => 'left');
	
	$fontStyleD  = array ('bold' => true,'size'=>11);
	$paraStyleD2 = array ('align' => 'left');
	
	$fontStyleE  = array ('bold' => true,'size'=>6);
	$paraStyleE2 = array ('align' => 'center');
	
	$fontStyleF  = array ('size'=>6);
	$paraStyleF2 = array ('align' => 'both');
	
	$fontStyleG  = array ('size'=>9);
	$paraStyleG2 = array ('align' => 'both');//'align' => 'both' TEXTO JUSTIFICADO
	
	$fontStyleH  = array ('bold' => true,'size'=>9);
	$paraStyleH2 = array ('align' => 'left');
	
	$fontStyleI  = array ('bold' => true,'size'=>9);
	$paraStyleI2 = array ('align' => 'both');//'align' => 'both' TEXTO JUSTIFICADO
	
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
	
	
	//PARA NOTIFICACIONES CON TEXTO EXTENSO
	
	//TABLAS
	$fontStyleNO  = array ('bold' => true,'size'=>6);
	$paraStyleNO2 = array ('align' => 'left');
	
	//TEXTO
	$fontStyleNO3  = array ('size'=>8);
	$paraStyleNO4 = array ('align' => 'both');//'align' => 'both' TEXTO JUSTIFICADO
	
	
	//---------------------------------------------------------------------------
	
	//PARA LA CARATULA
	$fontStyleJUZ  = array ('bold' => true,'size'=>16);
	$paraStyleJUZ  = array ('align' => 'center');
	
	$fontStyleCRTULA  = array ('bold' => true,'size'=>24);
	$paraStyleCRTULA  = array ('align' => 'center');
	
	$fontStyleCRTULAB  = array ('bold' => false,'size'=>14);
	$paraStyleCRTULAB  = array ('align' => 'left');
	
	$fontStyleVAR  = array ('bold' => true,'size'=>16);
	$paraStyleVAR  = array ('align' => 'both');
	
	
	if($idcaratulaplantilla != 400){
	
	//-----------------------------ENCABEZADO DEL DOCUMENTO-----------------------------------------------------------------
	$header = $section->createHeader();
	$table  = $header->addTable();
	$table->addRow();
	$table->addCell(2000)->addImage('views/images/encabezado.jpg', array('width'=>599, 'height'=>95, 'align'=>'center'));
	//$table->addCell(4500)->addText('Centro de Servicios Judiciales Manizales Civil - Familia',$fontStyle1, $fontStyle1);
	//----------------------------------------------------------------------------------------------------------------------
	
	}
	

	//DOS ESPACIOS EN BLANCO ENTRE UN PARRAFO Y OTRO
	//$section->addTextBreak(2);
	
	//************************************************CITACIONES*********************************************************************
	
	//PLANTILLA APOYO CITACION
	if($datos0c == 67){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		/*$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = $datos2.": ";          $campofila2 = strtoupper($datos3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "DEMANDADO: ";         $campofila2 = strtoupper($parte2);}
			
				
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se "."______________"." en su contra ".$datos10.".",$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
			if($conttabla == 7){$campofila = "";                     $campofila2 = "Fecha:";}
			//if($conttabla == 8){$campofila = "Elaborado Por: ";      $campofila2 = $_SESSION['nombre'];}
			//if($conttabla == 9){$campofila = $acuerdo;               $campofila2 = "";}
			
				
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
			
	}
	
	//CITA AL ACREDEDOR PRENDARIO
	if($datos0c == 3){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 9){
			
			
			if($conttabla == 0){$campofila = /*$datos2.*/"SE�OR(A): ";          $campofila2 = strtoupper($parte3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "DEMANDADO: ";         $campofila2 = strtoupper($parte2);}
			if($conttabla == 8){$campofila = "CITADO: "; $campofila2 = strtoupper($parte3)."(EN SU CONDICON DE ACREDEDOR PRENDARIO)";}
			
				
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10.".",$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			
	}
	
	//CITA AL ACREEDEOR HIPOTECARIO
	if($datos0c == 4){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 9){
			
			
			if($conttabla == 0){$campofila = /*$datos2.*/"SE�OR(A): ";          $campofila2 = strtoupper($parte3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "DEMANDADO: ";         $campofila2 = strtoupper($parte2);}
			if($conttabla == 8){$campofila = "CITADO: "; $campofila2 = strtoupper($parte3)."(EN SU CONDICON DE ACREDEDOR HIPOTECARIO)";}
			
				
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10.".",$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			
	}
	
	//ORDENA INTEGRAR EL LITISCONSORTE NECESARIO
	if($datos0c == 7){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 9){
			
			
			if($conttabla == 0){$campofila = "SE�OR(A): ";          $campofila2 = strtoupper($parte3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "DEMANDADO: ";         $campofila2 = strtoupper($parte2);}
			if($conttabla == 8){$campofila = "CITADO: "; $campofila2 = strtoupper($parte3).("VINCULADO COMO LITIS CONSORCIO NECESARIO");}
			
				
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10.".",$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			
	}
	
	//ADMITE DEMANDA Y ORDENA INTEGRAR EL LITISCONSORTE NECESARIO
	if($datos0c == 46){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 9){
			
			
			if($conttabla == 0){$campofila = "SE�OR(A): ";          $campofila2 = strtoupper($parte3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "DEMANDADO: ";         $campofila2 = strtoupper($parte2);}
			if($conttabla == 8){$campofila = "CITADO: "; $campofila2 = strtoupper($parte3).("VINCULADO COMO LITIS CONSORCIO NECESARIO");}
			
				
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10.".",$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			
	}
	
	//ADMITIO LA DENUNCIA EN PLEITO
	if($datos0c == 17){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 9){
			
			
			if($conttabla == 0){$campofila = /*$datos2.*/"SE�OR(A): ";          $campofila2 = strtoupper($parte3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "DEMANDADO: ";         $campofila2 = strtoupper($parte2);}
			if($conttabla == 8){$campofila = "CITADO: "; $campofila2 = strtoupper($parte3)."(DENUNCIADO EN PLEITO)";}
			
				
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10.".",$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			
	}
	
	//ADMITIO DEMANDA
	if($datos0c == 9){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		/*$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = $datos2.": ";          $campofila2 = strtoupper($datos3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "DEMANDADO: ";         $campofila2 = strtoupper($parte2);}
			
				
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10,$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
			if($conttabla == 7){$campofila = "";                     $campofila2 = "Fecha:";}
			//if($conttabla == 8){$campofila = "Elaborado Por: ";      $campofila2 = $_SESSION['nombre'];}
			//if($conttabla == 9){$campofila = $acuerdo;               $campofila2 = "";}
			
				
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
			
	}
	
	//LIBRA MANDAMIENTO DE PAGO
	if($datos0c == 10){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		/*$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = $datos2.": ";          $campofila2 = strtoupper($datos3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "DEMANDADO: ";         $campofila2 = strtoupper($parte2);}
			
				
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10,$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			
	}
	
	//ADMITIO SOLICITUD
	if($datos0c == 25){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		/*$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = $datos2.": ";          $campofila2 = strtoupper($datos3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "SOLICITANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "SOLICITADO: ";         $campofila2 = strtoupper($parte2);}
			
				
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10,$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			
	}
	
	//ADMITE ACCION POPULAR
	if($datos0c == 27){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = $datos2.": ";          $campofila2 = strtoupper($parte2);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "ACCIONANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "ACCIONADO: ";         $campofila2 = strtoupper($parte2);}
			
	
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y mediante el cual ".$datos6." en su contra ".$datos10.".",$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			
	}
	
	
	
	//ADMITIO SOLICITUD DE LIQUIDACION DE LA SOCIEDAD CONYUGAL
	if($datos0c == 43){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		/*$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = $datos2.": ";          $campofila2 = strtoupper($datos3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "SOLICITANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "SOLICITADO: ";         $campofila2 = strtoupper($parte2);}
			
				
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10,$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			
	}
	
	//ADMITIO SOLICITUD DE LIQUIDACION DE LA SOCIEDAD PATRIMONIAL DE HECHO
	if($datos0c == 44){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		/*$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = $datos2.": ";          $campofila2 = strtoupper($datos3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "SOLICITANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "SOLICITADO: ";         $campofila2 = strtoupper($parte2);}
			
				
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10,$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			
	}
	
	
	//DEMANDA ACUMULADA
	if($datos0c == 47){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];
		$parte7       = $datospartesB[7];
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		$fechaauto2 = strftime('%B %d de %Y', strtotime($parte7));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = "SE�OR(A): ";          $campofila2 = strtoupper($datos3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "DEMANDADO: ";         $campofila2 = strtoupper($parte2);}
			
			
				
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
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 5){
			
			
			if($conttabla == 0){$campofila = "DEMANDA ACUMULADA:";  $campofila2 = " ";}
			if($conttabla == 1){$campofila = "PROCESO: ";           $campofila2 = strtoupper($parte3);}
			if($conttabla == 2){$campofila = "RADICADO: ";          $campofila2 = strtoupper($parte4);}
			if($conttabla == 3){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($parte5);}
			if($conttabla == 4){$campofila = "DEMANDADO: ";         $campofila2 = strtoupper($parte6);}
			
			
				
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y mediante el cual se LIBRA MANDAMIENTO DE PAGO EN SU CONTRA, ".$fechaauto2." por medio del cual se LIBRA MANDAMIENTO DE PAGO y DECRETA LA ACUMULACION DE LA DEMANDA".$datos10.".",$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			
	}
	
	//ORDENA CITARLO PARA QUE MANIFIESTE SI ACEPTA O REPUDIA LA HERENCIA
	if($datos0c == 48){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 9){
			
			
			if($conttabla == 0){$campofila = "SENOR(A): ";          $campofila2 = strtoupper($datos3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "SOLICITANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "CAUSANTE: ";           $campofila2 = strtoupper($parte2);}
			if($conttabla == 8){$campofila = "CITADO: ";             $campofila2 = strtoupper($parte3);}
			
				
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y mediante el cual se ordena citarlo para que manifieste si acepta o repudia la herencia dentro de la presente demanda.".$datos6." ".$datos10.".",$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			
	}
	
	
	//ABRIR TR�MITE INCIDENTAL EN CONTRA DEL SECUESTRE
	if($datos0c == 26){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		//$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = "SENOR(A): ";          $campofila2 = strtoupper($datos3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "ACCIONANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "INCIDENTADO: ";       $campofila2 = strtoupper($parte2);}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10,$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			$table1->addCell(6000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//ACEPTA LA CESION CREDITO
	if($datos0c == 19){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		//$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = "SENOR(A): ";          $campofila2 = strtoupper($datos3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "DEMANDADO: ";         $campofila2 = strtoupper($parte2);}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10,$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			$table1->addCell(6000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//CESION CONTRATO DE ARRENDAMIENTO
	if($datos0c == 22){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		//$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = "SENOR(A): ";          $campofila2 = strtoupper($datos3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "DEMANDADO: ";         $campofila2 = strtoupper($parte2);}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10,$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			$table1->addCell(6000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//EXISTENCIA DEL CREDITO
	if($datos0c == 1){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 9){
			
			
			if($conttabla == 0){$campofila = "SENOR(A): ";          $campofila2 = strtoupper($parte3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "DEMANDADO: ";         $campofila2 = strtoupper($parte2);}
			if($conttabla == 8){$campofila = "CITADO: ";            $campofila2 = strtoupper($parte3);}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10,$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			$table1->addCell(6000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//CESION CONTRATO DE ARRENDAMIENTO
	if($datos0c == 18){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		//$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = "SENOR(A): ";          $campofila2 = strtoupper($datos3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "SOLICITANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "REQUERIDO: ";         $campofila2 = strtoupper($parte2);}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10,$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			$table1->addCell(6000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//ORDENA CONTINUAR LA LIQUIDACI�N DE SOCIEDAD CONYUGAL
	if($datos0c == 20){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		//$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = "SENOR(A): ";          $campofila2 = strtoupper($datos3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "SOLICITANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "SOLCITADO: ";         $campofila2 = strtoupper($parte2);}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10,$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			$table1->addCell(6000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//ORDENA INTEGRAR EL CONTRADICTORIO
	if($datos0c == 8){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		//$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = "SENOR(A): ";          $campofila2 = strtoupper($datos3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "SOLICITANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "SOLCITADO: ";         $campofila2 = strtoupper($parte2);}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10,$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			$table1->addCell(6000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//ORDENA INTEGRAR EL CONTRADICTORIO
	if($datos0c == 5){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 9){
			
			
			if($conttabla == 0){$campofila = "SENOR(A): ";          $campofila2 = strtoupper($parte3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "SOLICITANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "SOLCITADO: ";         $campofila2 = strtoupper($parte2);}
			if($conttabla == 8){$campofila = "LLAMADO EN GARANTIA: "; $campofila2 = strtoupper($parte3);}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10,$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			$table1->addCell(6000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//QUE FIJA FECHA Y HORA PARA DILIGENCIA EXTRAPROCESO
	if($datos0c == 2){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		//$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = "SENOR(A): ";          $campofila2 = strtoupper($datos3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "DILIGENCIA EXTRAPROCESO: "; $campofila2 = strtoupper("INTERROGATORIO DE PARTE");}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "SOLICITANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "ABSOLVENTE: ";         $campofila2 = strtoupper($parte2);}
			
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10,$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			$table1->addCell(6000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//QUE FIJA FECHA Y HORA RECONOCIMIENTO FIRMA Y DOCUMENTOS
	if($datos0c == 21){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		//$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = "SENOR(A): ";          $campofila2 = strtoupper($datos3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "DILIGENCIA EXTRAPROCESO: "; $campofila2 = strtoupper("INTERROGATORIO DE PARTE");}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "SOLICITANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "ABSOLVENTE: ";         $campofila2 = strtoupper($parte2);}
			
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10,$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			$table1->addCell(6000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//CONSTITUCION EN MORA
	if($datos0c == 13){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		//$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = "SENOR(A): ";          $campofila2 = strtoupper($datos3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "CONSTITUCION EN MORA: "; $campofila2 = strtoupper("INTERROGATORIO DE PARTE");}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "SOLICITANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "ABSOLVENTE: ";         $campofila2 = strtoupper($parte2);}
			
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10,$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			$table1->addCell(6000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//QUE ORDENA NOTIFICAR LA EXISTENCIA DE TITULOS
	if($datos0c == 24){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 9){
			
			
			if($conttabla == 0){$campofila = "SENOR(A): ";          $campofila2 = strtoupper($parte3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "DEMANDADO: ";         $campofila2 = strtoupper($parte2);}
			if($conttabla == 8){$campofila = "CITADO: ";            $campofila2 = strtoupper($parte3);}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10,$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			$table1->addCell(6000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//ADMITIO DEMANDA Y  LIBRA MANDAMIENTO DE PAGO
	if($datos0c == 42){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		//$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = "SENOR(A): ";          $campofila2 = strtoupper($datos3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "DEMANDADO: ";         $campofila2 = strtoupper($parte2);}
			
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10,$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			$table1->addCell(6000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//ABRIR TRAMITE INCIDENTAL EN CONTRA DEL PAGADOR
	if($datos0c == 45){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 9){
			
			
			if($conttabla == 0){$campofila = "SENOR(A): ";          $campofila2 = strtoupper($parte3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "DEMANDADO: ";         $campofila2 = strtoupper($parte2);}
			if($conttabla == 8){$campofila = "INCIDENTADO: ";       $campofila2 = strtoupper($parte3);}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10,$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			$table1->addCell(6000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//QUE FIJA FECHA Y HORA RECONOCIMIENTO FIRMA Y DOCUMENTOS CON DEMANDANTE Y DEMANDADO
	if($datos0c == 49){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		//$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
		
		//OBTENEMOS SOLO LA PARTE QUE DICE "QUE FIJA FECHA Y HORA RECONOCIMIENTO FIRMA Y DOCUMENTOS"
		//YA QUE "CON DEMANDANTE Y DEMANDADO" ES SOLO PARA EU LA GENTE IDENTIFIQUE ESTE TIPO DE PLANTILLA
		//PERO QUE NO SALGA EN LA CITACION
		$datos6  = substr($datos6, 0, 55);
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = "SENOR(A): ";          $campofila2 = strtoupper($datos3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "DEMANDADO: ";         $campofila2 = strtoupper($parte2);}
			
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10,$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			$table1->addCell(6000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//ADMITIO LA REFORMA DE LA DEMANDA EN SU CONTRA
	if($datos0c == 58){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		/*$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CITACI�N PARA DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		
		/*if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = $datos2.": ";          $campofila2 = strtoupper($datos3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "DEMANDADO: ";         $campofila2 = strtoupper($parte2);}
			
				
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("S�rvase comparecer a este CENTRO DE SERVICIOS JUDICIALES a la direcci�n que aparece al pie de la presente p�gina, dentro de los ".$cantdias." siguientes a la entrega de esta comunicaci�n, de lunes a viernes de 8:00 a 12:00  y de 2:00 a 6:00 pm, con el fin de notificarle personalmente el auto de fecha: ".$fechaauto.", dictado dentro de la presente demanda y por el cual se ".$datos6." en su contra ".$datos10,$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "Firma";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 6){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
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
			
	}
	
	/******************************************************NOTIFICACIONES***********************************************************************/
	
	
	//PLANTILLA APOYO NOTIFICACION PERSONAL
	if($datos0c == 59){
		
		//$datospartesB = explode("//////",$datospartes);
		//$parte1       = $datospartesB[1];
		//$parte2       = $datospartesB[2];
		/*$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("NOTIFICACI�N PERSONAL"."            "."RADICADO: ".$dator2, $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%d de %B de %Y', strtotime($datos8));  
		//$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		if(is_null($datos11)){
			$fa = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fa = strftime('%d de %B de %Y', strtotime($datos11));
		}
		
		//PERSONAL
		$section->addText("ENCABEZADO CUANDO LA PERSONA SE ENCUENTRA EN VENTANILLA",$fontStyleP);
		$section->addText("Manizales, ".$fecha."; en la fecha comparece ante el CENTRO DE SERVICIOS JUDICIALES PARA LOS JUZGADOS CIVILES Y DE FAMILIA, la persona que a continuaci�n se identifica, con el fin de recibir NOTIFICACI�N PERSONAL del auto que ".$datos6." en su contra, dentro del proceso que seguidamente se menciona.",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		//APODERADO
		$section->addText("ENCABEZADO CUANDO LA PERSONA EN VENTANILLA ES EL APODERADO",$fontStyleP);
		$section->addText("Manizales, ".$fecha."; en la fecha comparece ante el CENTRO DE SERVICIOS JUDICIALES PARA LOS JUZGADOS CIVILES Y DE FAMILIA, "."_____________________________"." en calidad de apoderado de "."________________________".", con el fin de recibir NOTIFICACI�N PERSONAL del auto que ".$datos6." dentro del proceso que seguidamente se menciona.",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		//AUTORIZADO
		$section->addText("ENCABEZADO CUANDO AUTORIZAN A UN EMPLEADO DEL CENTRO DE SERVICIOS A NOTIFICAR",$fontStyleP);
		$section->addText("Manizales, ".$fecha."; en la fecha el se�or "."___________________________________"." con c.c. "."__________________".", adscrito a la planta de personal del CENTRO DE SERVICIOS JUDICIALES PARA LOS JUZGADOS CIVILES Y DE FAMILIA, debidamente autorizado por el Coordinador (a) ".strtoupper($datoofi6)." y a solicitud del ".strtoupper($dator3)." de Manizales, se traslada a "."_______________________"." para notificar personalmente el auto de fecha ".$fa.", mediante el cual se ".$datos6.", en contra de ".strtoupper($dator5).", dentro del proceso que seguidamente se menciona.",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 7){
			
			
			if($conttabla == 0){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 1){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 2){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($dator7);}
			if($conttabla == 3){$campofila = "DEMANDADO(A): ";      $campofila2 = strtoupper($dator5);}
			if($conttabla == 4){$campofila = "CEDULA: ";            $campofila2 = strtoupper($dator6);}
			if($conttabla == 5){$campofila = "FECHA AUTO: ";        $campofila2 = strtoupper($fa);}
			if($conttabla == 6){$campofila = "ANEXOS: ";            $campofila2 = strtoupper("COPIA DEL ESCRITO DE DEMANDA CON ANEXOS Y COPIA DEL AUTO QUE LIBRA MANDAMIENTO DE PAGO.");}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		//CONTENIDO 1
		$section->addText("CONTENIDO 1",$fontStyleP);
		$section->addText("Se le advierte que dispone del t�rmino  de CINCO (5) DIAS HABILES para pagar la obligaci�n adeudada y DIEZ (10) DIAS HABILES PARA CONTESTAR LA DEMANDA Y/O PROPONER LAS EXCEPCIONES QUE A BIEN TENGA PARA FORMULAR, LOS CUALES CORRERAN DE MANERA SIMULTANEA, A PARTIR DEL DIA SIGUIENTE A LA PRESENTE NOTIFICACI�N",$fontStyleB, $paraStyleB2);
		
		//CONTENIDO 2
		$section->addText("CONTENIDO 2",$fontStyleP);
		$section->addText("Se le advierte que dispone del t�rmino  de CINCO (5) DIAS HABILES para pagar Y/O PROPONER LAS EXCEPCIONES QUE A BIEN TENGA PARA FORMULAR, LOS CUALES CORRERAN A PARTIR DEL DIA SIGUIENTE A LA PRESENTE NOTIFICACI�N",$fontStyleB, $paraStyleB2);
		
		//CONTENIDO 3
		$section->addText("CONTENIDO 3",$fontStyleP);
		$section->addText("Se le INFORMA que el t�rmino de traslado de la demanda es de "."_______________"." DIAS HABILES, CONTADOS A PARTIR DEL D�A SIGUIENTE A LA PRESENTE NOTIFICACI�N, la que se surte con la entrega de la copia de la demanda y los anexos. Se deja Constancia que al notificado (a) se le ley� el auto que admiti� la demanda y se le hicieron las advertencias all� consignadas.",$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 3){
			
			if($conttabla == 0){$campofila = "NOTIFICADO(A): ";   $campofila2 = strtoupper($dator5)." ".$parte1;}
			if($conttabla == 1){$campofila = "QUIEN NOTIFICA: ";  $campofila2 = strtoupper($_SESSION['nombre']);}
			if($conttabla == 2){$campofila = "COORDINADOR(RA): "; $campofila2 = strtoupper($datoofi6);}
			
				
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
			
	}
	
	//NOTIFICACION PERSONAL EJECUTIVO SINGULAR Y MIXTO
	if($datos0c == 32){
	
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		/*$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("NOTIFICACI�N PERSONAL"."            "."RADICADO: ".$dator2, $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%d de %B de %Y', strtotime($datos8));  
		//$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		if(is_null($datos11)){
			$fa = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fa = strftime('%d de %B de %Y', strtotime($datos11));
		}
	
		$section->addText("Manizales, ".$fecha."; en la fecha comparece ante el CENTRO DE SERVICIOS JUDICIALES PARA LOS JUZGADOS CIVILES Y DE FAMILIA, la persona que a continuaci�n se identifica, con el fin de recibir NOTIFICACI�N PERSONAL del auto que ".$datos6." en su contra, dentro del proceso que seguidamente se menciona. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 7){
			
			
			if($conttabla == 0){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 1){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 2){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($dator7);}
			if($conttabla == 3){$campofila = "DEMANDADO(A): ";      $campofila2 = strtoupper($dator5);}
			if($conttabla == 4){$campofila = "CEDULA: ";            $campofila2 = strtoupper($dator6);}
			//if($conttabla == 5){$campofila = "FECHA AUTO: ";        $campofila2 = strtoupper($fa);}
			if($conttabla == 5){$campofila = "FECHA AUTO: ";        $campofila2 = strtoupper($fa." ".$datos10);}
			if($conttabla == 6){$campofila = "ANEXOS: ";            $campofila2 = strtoupper("COPIA DEL ESCRITO DE DEMANDA CON ANEXOS Y COPIA DEL AUTO QUE LIBRA MANDAMIENTO DE PAGO. ".$parte2);}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("Se le advierte que dispone del t�rmino  de CINCO (5) DIAS HABILES para pagar la obligaci�n adeudada y DIEZ (10) DIAS HABILES PARA CONTESTAR LA DEMANDA Y/O PROPONER LAS EXCEPCIONES QUE A BIEN TENGA PARA FORMULAR, LOS CUALES CORRERAN DE MANERA SIMULTANEA, A PARTIR DEL DIA SIGUIENTE A LA PRESENTE NOTIFICACI�N",$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 3){
			
			if($conttabla == 0){$campofila = "NOTIFICADO(A): ";  $campofila2 = strtoupper($dator5)." ".$parte1;}
			if($conttabla == 1){$campofila = "QUIEN NOTIFICA: "; $campofila2 = strtoupper($_SESSION['nombre']);}
			if($conttabla == 2){$campofila = "COORDINADOR(RA): ";   $campofila2 = strtoupper($datoofi6);}
			
				
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
			
	}
	
	//NOTIFICACION PERSONAL EJECUTIVO SINGULAR Y MIXTO AUTORIZADO
	if($datos0c == 35){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		/*$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("NOTIFICACI�N PERSONAL"."            "."RADICADO: ".$dator2, $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%d de %B de %Y', strtotime($datos8));  
		//$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		if(is_null($datos11)){
			$fa = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fa = strftime('%d de %B de %Y', strtotime($datos11));
		}
	
		$section->addText("Manizales, ".$fecha."; en la fecha el se�or ".strtoupper($parte1)." con c.c. ".$parte2.", adscrito a la planta de personal del CENTRO DE SERVICIOS JUDICIALES PARA LOS JUZGADOS CIVILES Y DE FAMILIA, debidamente autorizado por el Coordinador(ra) ".strtoupper($datoofi6)." y a solicitud del ".strtoupper($dator3)." de Manizales, se traslada a ".strtoupper($parte3)." para notificar personalmente el auto de fecha ".$fa.", mediante el cual se ".$datos6.", en contra de ".strtoupper($dator5).", dentro del proceso que seguidamente se menciona. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 7){
			
			
			if($conttabla == 0){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 1){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 2){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($dator7);}
			if($conttabla == 3){$campofila = "DEMANDADO(A): ";      $campofila2 = strtoupper($dator5);}
			if($conttabla == 4){$campofila = "CEDULA: ";            $campofila2 = strtoupper($dator6);}
			if($conttabla == 5){$campofila = "FECHA AUTO: ";        $campofila2 = strtoupper($fa." ".$datos10);}
			if($conttabla == 6){$campofila = "ANEXOS: ";            $campofila2 = strtoupper("COPIA DEL ESCRITO DE DEMANDA CON ANEXOS Y COPIA DEL AUTO QUE LIBRA MANDAMIENTO DE PAGO. ".$parte4);}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("Se le advierte que dispone del t�rmino  de CINCO (5) DIAS HABILES para pagar la obligaci�n adeudada y DIEZ (10) DIAS HABILES PARA CONTESTAR LA DEMANDA Y/O PROPONER LAS EXCEPCIONES QUE A BIEN TENGA PARA FORMULAR, LOS CUALES CORRERAN DE MANERA SIMULTANEA, A PARTIR DEL DIA SIGUIENTE A LA PRESENTE NOTIFICACI�N",$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 3){
			
			if($conttabla == 0){$campofila = "NOTIFICADO(A): ";   $campofila2 = strtoupper($dator5);}
			if($conttabla == 1){$campofila = "QUIEN NOTIFICA: ";  $campofila2 = strtoupper($parte1);}
			if($conttabla == 2){$campofila = "COORDINADOR(RA): "; $campofila2 = strtoupper($datoofi6);}
			
				
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
			
	}
	
	
	
	//NOTIFICACION PERSONAL EJECUTIVO HIPOTECARIO Y PRENDARIO
	if($datos0c == 50){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		/*$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("NOTIFICACI�N PERSONAL"."            "."RADICADO: ".$dator2, $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%d de %B de %Y', strtotime($datos8));  
		//$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		if(is_null($datos11)){
			$fa = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fa = strftime('%d de %B de %Y', strtotime($datos11));
		}
	
		$section->addText("Manizales, ".$fecha."; en la fecha comparece ante el CENTRO DE SERVICIOS JUDICIALES PARA LOS JUZGADOS CIVILES Y DE FAMILIA, la persona que a continuaci�n se identifica, con el fin de recibir NOTIFICACI�N PERSONAL del auto que ".$datos6." en su contra, dentro del proceso que seguidamente se menciona. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 7){
			
			
			if($conttabla == 0){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 1){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 2){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($dator7);}
			if($conttabla == 3){$campofila = "DEMANDADO(A): ";      $campofila2 = strtoupper($dator5);}
			if($conttabla == 4){$campofila = "CEDULA: ";            $campofila2 = strtoupper($dator6);}
			if($conttabla == 5){$campofila = "FECHA AUTO: ";        $campofila2 = strtoupper($fa." ".$datos10);}
			if($conttabla == 6){$campofila = "ANEXOS: ";            $campofila2 = strtoupper("COPIA DEL ESCRITO DE DEMANDA CON ANEXOS Y COPIA DEL AUTO QUE LIBRA MANDAMIENTO DE PAGO. ".$parte2);}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("Se le advierte que dispone del t�rmino  de CINCO (5) DIAS HABILES para pagar Y/O PROPONER LAS EXCEPCIONES QUE A BIEN TENGA PARA FORMULAR, LOS CUALES CORRERAN A PARTIR DEL DIA SIGUIENTE A LA PRESENTE NOTIFICACI�N",$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 3){
			
			if($conttabla == 0){$campofila = "NOTIFICADO(A): ";  $campofila2 = strtoupper($dator5)." ".$parte1;}
			if($conttabla == 1){$campofila = "QUIEN NOTIFICA: "; $campofila2 = strtoupper($_SESSION['nombre']);}
			if($conttabla == 2){$campofila = "COORDINADOR(RA): ";   $campofila2 = strtoupper($datoofi6);}
			
				
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
			
	}
	
	
	//NOTIFICACION PERSONAL EJECUTIVO SINGULAR Y MIXTO AUTORIZADO
	if($datos0c == 51){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		/*$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("NOTIFICACI�N PERSONAL"."            "."RADICADO: ".$dator2, $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%d de %B de %Y', strtotime($datos8));  
		//$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		if(is_null($datos11)){
			$fa = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fa = strftime('%d de %B de %Y', strtotime($datos11));
		}
	
		$section->addText("Manizales, ".$fecha."; en la fecha el se�or ".strtoupper($parte1)." con c.c. ".$parte2.", adscrito a la planta de personal del CENTRO DE SERVICIOS JUDICIALES PARA LOS JUZGADOS CIVILES Y DE FAMILIA, debidamente autorizado por el Coordinador(ra) ".strtoupper($datoofi6)." y a solicitud del ".strtoupper($dator3)." de Manizales, se traslada a ".strtoupper($parte3)." para notificar personalmente el auto de fecha ".$fa.", mediante el cual se ".$datos6.", en contra de ".strtoupper($dator5).", dentro del proceso que seguidamente se menciona. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 7){
			
			
			if($conttabla == 0){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 1){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 2){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($dator7);}
			if($conttabla == 3){$campofila = "DEMANDADO(A): ";      $campofila2 = strtoupper($dator5);}
			if($conttabla == 4){$campofila = "CEDULA: ";            $campofila2 = strtoupper($dator6);}
			if($conttabla == 5){$campofila = "FECHA AUTO: ";        $campofila2 = strtoupper($fa." ".$datos10);}
			if($conttabla == 6){$campofila = "ANEXOS: ";            $campofila2 = strtoupper("COPIA DEL ESCRITO DE DEMANDA CON ANEXOS Y COPIA DEL AUTO QUE LIBRA MANDAMIENTO DE PAGO. ".$parte4);}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("Se le advierte que dispone del t�rmino  de CINCO (5) DIAS HABILES para pagar Y/O PROPONER LAS EXCEPCIONES QUE A BIEN TENGA PARA FORMULAR, LOS CUALES CORRERAN A PARTIR DEL DIA SIGUIENTE A LA PRESENTE NOTIFICACI�N",$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 3){
			
			if($conttabla == 0){$campofila = "NOTIFICADO(A): ";   $campofila2 = strtoupper($dator5);}
			if($conttabla == 1){$campofila = "QUIEN NOTIFICA: ";  $campofila2 = strtoupper($parte1);}
			if($conttabla == 2){$campofila = "COORDINADOR(RA): "; $campofila2 = strtoupper($datoofi6);}
			
				
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
			
	}
	
	
	//NOTIFICACION PERSONAL VERBAL Y RESTITUCION
	if($datos0c == 52){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		//$parte4       = $datospartesB[4];
		/*$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("NOTIFICACI�N PERSONAL"."            "."RADICADO: ".$dator2, $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%d de %B de %Y', strtotime($datos8));  
		//$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		if(is_null($datos11)){
			$fa = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fa = strftime('%d de %B de %Y', strtotime($datos11));
		}
	
		$section->addText("Manizales, ".$fecha."; en la fecha comparece ante el CENTRO DE SERVICIOS JUDICIALES PARA LOS JUZGADOS CIVILES Y DE FAMILIA, la persona que a continuaci�n se identifica, con el fin de recibir NOTIFICACI�N PERSONAL del auto que ".$datos6." en su contra, dentro del proceso que seguidamente se menciona. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 7){
			
			
			if($conttabla == 0){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 1){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 2){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($dator7);}
			if($conttabla == 3){$campofila = "DEMANDADO(A): ";      $campofila2 = strtoupper($dator5);}
			if($conttabla == 4){$campofila = "CEDULA: ";            $campofila2 = strtoupper($dator6);}
			if($conttabla == 5){$campofila = "FECHA AUTO: ";        $campofila2 = strtoupper($fa." ".$datos10);}
			if($conttabla == 6){$campofila = "ANEXOS: ";            $campofila2 = strtoupper("COPIA DEL ESCRITO DE DEMANDA CON ANEXOS Y COPIA DEL AUTO QUE LIBRA MANDAMIENTO DE PAGO. ".$parte3);}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("Se le INFORMA que el t�rmino de traslado de la demanda es de ".$parte1." DIAS HABILES, CONTADOS A PARTIR DEL D�A SIGUIENTE A LA PRESENTE NOTIFICACI�N, la que se surte con la entrega de la copia de la demanda y los anexos. Se deja Constancia que al notificado (a) se le ley� el auto que admiti� la demanda y se le hicieron las advertencias all� consignadas.",$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 3){
			
			if($conttabla == 0){$campofila = "NOTIFICADO(A): ";   $campofila2 = strtoupper($dator5)." ".strtoupper($parte2);}
			if($conttabla == 1){$campofila = "QUIEN NOTIFICA: ";  $campofila2 = strtoupper($_SESSION['nombre']);}
			if($conttabla == 2){$campofila = "COORDINADOR(RA): "; $campofila2 = strtoupper($datoofi6);}
			
				
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
			
	}
	
	
	//NOTIFICACION PERSONAL ADMISORIO
	if($datos0c == 33){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		//$parte4       = $datospartesB[4];
		/*$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("NOTIFICACI�N PERSONAL"."            "."RADICADO: ".$dator2, $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%d de %B de %Y', strtotime($datos8));  
		//$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		if(is_null($datos11)){
			$fa = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fa = strftime('%d de %B de %Y', strtotime($datos11));
		}
	
		$section->addText("Manizales, ".$fecha."; en la fecha comparece ante el CENTRO DE SERVICIOS JUDICIALES PARA LOS JUZGADOS CIVILES Y DE FAMILIA, la persona que a continuaci�n se identifica, con el fin de recibir NOTIFICACI�N PERSONAL del auto que ".$datos6." en su contra, dentro del proceso que seguidamente se menciona. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 7){
			
			
			if($conttabla == 0){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 1){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 2){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($dator7);}
			if($conttabla == 3){$campofila = "DEMANDADO(A): ";      $campofila2 = strtoupper($dator5);}
			if($conttabla == 4){$campofila = "CEDULA: ";            $campofila2 = strtoupper($dator6);}
			if($conttabla == 5){$campofila = "FECHA AUTO: ";        $campofila2 = strtoupper($fa." ".$datos10);}
			if($conttabla == 6){$campofila = "ANEXOS: ";            $campofila2 = strtoupper("COPIA DEL ESCRITO DE DEMANDA CON ANEXOS Y COPIA DEL AUTO QUE LIBRA MANDAMIENTO DE PAGO. ".$parte3);}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("Se le INFORMA que el t�rmino de traslado de la demanda es de ".$parte1." DIAS HABILES, CONTADOS A PARTIR DEL D�A SIGUIENTE A LA PRESENTE NOTIFICACI�N, la que se surte con la entrega de la copia de la demanda y los anexos.",$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 3){
			
			if($conttabla == 0){$campofila = "NOTIFICADO(A): ";   $campofila2 = strtoupper($dator5)." ".strtoupper($parte2);}
			if($conttabla == 1){$campofila = "QUIEN NOTIFICA: ";  $campofila2 = strtoupper($_SESSION['nombre']);}
			if($conttabla == 2){$campofila = "COORDINADOR(RA): "; $campofila2 = strtoupper($datoofi6);}
			
				
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
			
	}
	
	//NOTIFICACION PERSONAL CON APODERADO
	if($datos0c == 34){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];
		$parte7       = $datospartesB[7];
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("NOTIFICACI�N PERSONAL"."            "."RADICADO: ".$dator2, $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%d de %B de %Y', strtotime($datos8));  
		//$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		if(is_null($datos11)){
			$fa = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fa = strftime('%d de %B de %Y', strtotime($datos11));
		}
	
		$section->addText("Manizales, ".$fecha."; en la fecha comparece ante el CENTRO DE SERVICIOS JUDICIALES PARA LOS JUZGADOS CIVILES Y DE FAMILIA, ".strtoupper($parte3)." en calidad de apoderado de ".strtoupper($dator5).", con el fin de recibir NOTIFICACI�N PERSONAL del auto que ".strtoupper($parte1)." dentro del proceso que seguidamente se menciona. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 9){
			
			
			if($conttabla == 0){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 1){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 2){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($dator7);}
			if($conttabla == 3){$campofila = "DEMANDADO(A): ";      $campofila2 = strtoupper($dator5);}
			
			if($conttabla == 4){$campofila = "NOTIFIFICADO: ";      $campofila2 = strtoupper($parte3);}
			if($conttabla == 5){$campofila = "CEDULA: ";            $campofila2 = strtoupper($parte4);}
			if($conttabla == 6){$campofila = "T.P. No: ";           $campofila2 = strtoupper($parte5);}
			
			if($conttabla == 7){$campofila = "FECHA AUTO: ";        $campofila2 = strtoupper($fa." ".$datos10);}
			if($conttabla == 8){$campofila = "ANEXOS: ";            $campofila2 = strtoupper("COPIA DEL ESCRITO DE DEMANDA CON ANEXOS Y COPIA DEL AUTO QUE LIBRA MANDAMIENTO DE PAGO. ".$parte7);}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("Se le INFORMA que el t�rmino de traslado de la demanda es de ".$parte2." DIAS HABILES, CONTADOS A PARTIR DEL D�A SIGUIENTE A LA PRESENTE NOTIFICACI�N, la que se surte con la entrega de la copia de la demanda y los anexos.",$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 3){
			
			if($conttabla == 0){$campofila = "NOTIFICADO(A): ";   $campofila2 = strtoupper($parte3)." ".strtoupper($parte6);}
			if($conttabla == 1){$campofila = "QUIEN NOTIFICA: ";  $campofila2 = strtoupper($_SESSION['nombre']);}
			if($conttabla == 2){$campofila = "COORDINADOR(RA): "; $campofila2 = strtoupper($datoofi6);}
			
				
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
			
	}
	
	//NOTIFICACION PERSONAL CON APODERADO LLAMAMIENTO EN GARANTIA
	if($datos0c == 54){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];
		$parte7       = $datospartesB[7];
		$parte8       = $datospartesB[8];
		$parte9       = $datospartesB[9];
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("NOTIFICACI�N PERSONAL"."            "."RADICADO: ".$dator2, $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%d de %B de %Y', strtotime($datos8));  
		//$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		if(is_null($datos11)){
			$fa = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fa = strftime('%d de %B de %Y', strtotime($datos11));
		}
	
		$section->addText("Manizales, ".$fecha."; en la fecha comparece ante el CENTRO DE SERVICIOS JUDICIALES PARA LOS JUZGADOS CIVILES Y DE FAMILIA, ".strtoupper($parte3)." en calidad de apoderado de ".strtoupper($parte9).", con el fin de recibir NOTIFICACI�N PERSONAL del auto que ".strtoupper($parte1)." dentro del proceso que seguidamente se menciona. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 10){
			
			
			if($conttabla == 0){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 1){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 2){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($dator7);}
			if($conttabla == 3){$campofila = "DEMANDADO(A): ";      $campofila2 = strtoupper($dator5);}
			
			if($conttabla == 4){$campofila = "LLAMADO EN GARANTIA: ";$campofila2 = strtoupper($parte8);}
			if($conttabla == 5){$campofila = "NOTIFIFICADO: ";      $campofila2 = strtoupper($parte3);}
			if($conttabla == 6){$campofila = "CEDULA: ";            $campofila2 = strtoupper($parte4);}
			if($conttabla == 7){$campofila = "T.P. No: ";           $campofila2 = strtoupper($parte5);}
			
			if($conttabla == 8){$campofila = "FECHA AUTO: ";        $campofila2 = strtoupper($fa." ".$datos10);}
			if($conttabla == 9){$campofila = "ANEXOS: ";            $campofila2 = strtoupper("COPIA DEL ESCRITO DE DEMANDA CON ANEXOS Y COPIA DEL AUTO QUE LIBRA MANDAMIENTO DE PAGO. ".$parte7);}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("Se le INFORMA que el t�rmino de traslado de la demanda es de ".$parte2." DIAS HABILES, CONTADOS A PARTIR DEL D�A SIGUIENTE A LA PRESENTE NOTIFICACI�N, la que se surte con la entrega de la copia de la demanda y los anexos.",$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 3){
			
			if($conttabla == 0){$campofila = "NOTIFICADO(A): ";   $campofila2 = strtoupper($parte3)." ".strtoupper($parte6);}
			if($conttabla == 1){$campofila = "QUIEN NOTIFICA: ";  $campofila2 = strtoupper($_SESSION['nombre']);}
			if($conttabla == 2){$campofila = "COORDINADOR(RA): "; $campofila2 = strtoupper($datoofi6);}
			
				
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
			
	}
	
	//NOTIFICACION PERSONAL ADMISORIO
	if($datos0c == 53){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		//$parte4       = $datospartesB[4];
		/*$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("NOTIFICACI�N PERSONAL"."            "."RADICADO: ".$dator2, $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%d de %B de %Y', strtotime($datos8));  
		//$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		if(is_null($datos11)){
			$fa = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fa = strftime('%d de %B de %Y', strtotime($datos11));
		}
	
		$section->addText("Manizales, ".$fecha."; en la fecha comparece ante el CENTRO DE SERVICIOS JUDICIALES PARA LOS JUZGADOS CIVILES Y DE FAMILIA, la persona que a continuaci�n se identifica, con el fin de recibir NOTIFICACI�N PERSONAL del auto que ".$datos6." en su contra, dentro del proceso que seguidamente se menciona. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 7){
			
			
			if($conttabla == 0){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 1){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 2){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($dator7);}
			if($conttabla == 3){$campofila = "DEMANDADO(A): ";      $campofila2 = strtoupper($dator5);}
			if($conttabla == 4){$campofila = "CEDULA: ";            $campofila2 = strtoupper($dator6);}
			if($conttabla == 5){$campofila = "FECHA AUTO: ";        $campofila2 = strtoupper($fa." ".$datos10);}
			if($conttabla == 6){$campofila = "ANEXOS: ";            $campofila2 = strtoupper("COPIA DEL ESCRITO DE DEMANDA CON ANEXOS Y COPIA DEL AUTO QUE LIBRA MANDAMIENTO DE PAGO. ".$parte3);}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("Se le INFORMA que el t�rmino de traslado de la demanda es de ".$parte1." DIAS HABILES, CONTADOS A PARTIR DEL D�A SIGUIENTE A LA PRESENTE NOTIFICACI�N, la que se surte con la entrega de la copia de la demanda y los anexos.",$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 3){
			
			if($conttabla == 0){$campofila = "NOTIFICADO(A): ";   $campofila2 = strtoupper($dator5)." ".strtoupper($parte2);}
			if($conttabla == 1){$campofila = "QUIEN NOTIFICA: ";  $campofila2 = strtoupper($_SESSION['nombre']);}
			if($conttabla == 2){$campofila = "COORDINADOR(RA): "; $campofila2 = strtoupper($datoofi6);}
			
				
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
			
	}
	
	//NOTIFICACION PERSONAL ACREEDOR HIPOTECARIO Y PRENDARIO
	if($datos0c == 55){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];
		$parte7       = $datospartesB[7];
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("NOTIFICACI�N PERSONAL"."            "."RADICADO: ".$dator2, $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%d de %B de %Y', strtotime($datos8));  
		//$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		if(is_null($datos11)){
			$fa = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fa = strftime('%d de %B de %Y', strtotime($datos11));
		}
	
		$section->addText("Manizales, ".$fecha."; en la fecha comparece ante el CENTRO DE SERVICIOS JUDICIALES PARA LOS JUZGADOS CIVILES Y DE FAMILIA, la persona que a continuaci�n se identifica, con el fin de recibir NOTIFICACI�N PERSONAL del auto que ".$parte1.", dentro del proceso que seguidamente se menciona. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 1){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 2){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($dator7);}
			if($conttabla == 3){$campofila = "DEMANDADO(A): ";      $campofila2 = strtoupper($dator5);}
			if($conttabla == 4){$campofila = "NOTIFICADO: ";        $campofila2 = strtoupper($parte2);}
			if($conttabla == 5){$campofila = "CEDULA: ";            $campofila2 = strtoupper($parte3);}
			if($conttabla == 6){$campofila = "FECHA AUTO: ";        $campofila2 = strtoupper($fa." ".$datos10);}
			if($conttabla == 7){$campofila = "ANEXOS: ";            $campofila2 = strtoupper("COPIA DEL ESCRITO DE DEMANDA CON ANEXOS Y COPIA DEL AUTO QUE LIBRA MANDAMIENTO DE PAGO. ".$parte5);}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("Se le INFORMA que el t�rmino de traslado de la demanda es de ".$parte6." DIAS HABILES, CONTADOS A PARTIR DEL D�A SIGUIENTE A LA PRESENTE NOTIFICACI�N, para que haga valer sus derechos bien sea en proceso ejecutivo separado con garant�a real o en el que se le cite en ejercicio de la acci�n mixta (de conformidad con el art. ".$parte7." del C.P.C modificado por el art. 62 de la ley 794 de 2003.",$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 3){
			
			if($conttabla == 0){$campofila = "CITADO(A): ";   $campofila2 = strtoupper($parte2)." ".strtoupper($parte4);}
			if($conttabla == 1){$campofila = "QUIEN NOTIFICA: ";  $campofila2 = strtoupper($_SESSION['nombre']);}
			if($conttabla == 2){$campofila = "COORDINADOR(RA): "; $campofila2 = strtoupper($datoofi6);}
			
				
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
			
	}
	
	//NOTIFICACION PERSONAL PERTENENCIA CON CODIGO GENERAL
	if($datos0c == 56){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		/*$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];
		$parte7       = $datospartesB[7];*/
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("DILIGENCIA DE NOTIFICACI�N PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%d de %B de %Y', strtotime($datos8));  
		//$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		if(is_null($datos11)){
			$fa = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fa = strftime('%d de %B de %Y', strtotime($datos11));
		}
	
		$section->addText("Manizales, ".$fecha,$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 9){
			
			
			if($conttabla == 0){$campofila = "SE�OR(RA): ";         $campofila2 = strtoupper($parte1);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($parte2);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($parte3);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($dator7);}
			if($conttabla == 7){$campofila = "DEMANDADO(A): ";      $campofila2 = strtoupper($dator5);}
			if($conttabla == 8){$campofila = "VINCULADO: ";         $campofila2 = strtoupper($parte1);}
			
			
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
			$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleNO, $paraStyleNO2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleNO, $paraStyleNO2);
				
			$conttabla = $conttabla + 1;
		}
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		//$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("Se le comunica la providencia emitida por el juzgado antes citado, dentro del proceso de la referencia, para que si a bien lo tiene intervenga en el tr�mite de este proceso, dentro de los DIEZ (10) D�AS siguientes al recibido de la presente comunicaci�n, conforme a los art�culos 610-612 del C�digo General del Proceso.",$fontStyleNO3, $paraStyleNO4);
			
		//$section->addTextBreak(1);
		
		$section->addText("Para tal efecto se le env�a los siguientes documentos: ".$parte4,$fontStyleNO3, $paraStyleNO4);
			
		//$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 6){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			//if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "Firma";}
			//if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "Fecha:";}
				
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
			$table1->addCell(6000, $styleCell)->addText($campofila,$fontStyleNO, $paraStyleNO2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleNO, $paraStyleNO2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//NOTIFICACION PERSONAL ACEPTA O REPUDIA HERENCIA
	if($datos0c == 57){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		/*$parte6       = $datospartesB[6];
		$parte7       = $datospartesB[7];*/
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("NOTIFICACI�N PERSONAL"."            "."RADICADO: ".$dator2, $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%d de %B de %Y', strtotime($datos8));  
		//$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		if(is_null($datos11)){
			$fa = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fa = strftime('%d de %B de %Y', strtotime($datos11));
		}
	
		$section->addText("Manizales, ".$fecha."; en la fecha comparece ante el CENTRO DE SERVICIOS JUDICIALES PARA LOS JUZGADOS CIVILES Y DE FAMILIA, la persona que a continuaci�n se identifica, con el fin de recibir NOTIFICACI�N PERSONAL del auto mediante el cual se declara abierto y radicado proceso sucesorio y en el que se le requiere para que manifieste SI ACEPTA O REPUDIA LA HERENCIA, dentro del tr�mite que seguidamente se menciona. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 7){
			
			
			if($conttabla == 0){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 1){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 2){$campofila = "SOLICITANTE(S): ";    $campofila2 = strtoupper($parte2);}
			if($conttabla == 3){$campofila = "CAUSANTE: ";          $campofila2 = strtoupper($parte3);}
			if($conttabla == 4){$campofila = "CITADOS: ";           $campofila2 = strtoupper($parte4);}
			if($conttabla == 5){$campofila = "FECHA AUTO: ";        $campofila2 = strtoupper($fa." ".$datos10);}
			if($conttabla == 6){$campofila = "ANEXOS: ";            $campofila2 = strtoupper("COPIA DEL ESCRITO DE DEMANDA CON ANEXOS Y COPIA DEL AUTO QUE LIBRA MANDAMIENTO DE PAGO. ".$parte5);}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("Se le INFORMA que el t�rmino para aceptar o repudiar la herencia es de ".$parte1." DIAS HABILES, CONTADOS A PARTIR DEL D�A SIGUIENTE A LA PRESENTE NOTIFICACI�N, ( Art�culos 591 del C.P.C y 1289 del C.C.).",$fontStyleB, $paraStyleB2);
			
		//$section->addTextBreak(1);
			
		
			
	}
	
	//NOTIFICACION PERSONAL CESION CONTRATO DE ARRENDAMINETO
	if($datos0c == 70){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("NOTIFICACI�N PERSONAL"."            "."RADICADO: ".$dator2, $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%d de %B de %Y', strtotime($datos8));  
		//$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		if(is_null($datos11)){
			$fa = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fa = strftime('%d de %B de %Y', strtotime($datos11));
		}
		
		$section->addText("Manizales, ".$fecha."; en la fecha comparece ante el CENTRO DE SERVICIOS JUDICIALES PARA LOS JUZGADOS CIVILES Y DE FAMILIA, la persona que a continuaci�n se identifica, con el fin de recibir NOTIFICACI�N PERSONAL del auto como DILIGENCIA PREVIA, DONDE SE ORDENA NOTIFICARLE LA ".$datos6." QUE HACE EL SE�OR (A) ".$parte1." A FAVOR DEL SE�OR (A) ".$dator7.", dentro del proceso que seguidamente se menciona. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 7){
			
			
			if($conttabla == 0){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 1){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 2){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($dator7);}
			if($conttabla == 3){$campofila = "DEMANDADO(A): ";      $campofila2 = strtoupper($dator5);}
			if($conttabla == 4){$campofila = "CEDULA: ";            $campofila2 = strtoupper($dator6);}
			if($conttabla == 5){$campofila = "FECHA AUTO: ";        $campofila2 = strtoupper($fa." ".$datos10);}
			if($conttabla == 6){$campofila = "ANEXOS: ";            $campofila2 = strtoupper("COPIA DEL AUTO A NOTIFICAR, COPIA DEL CONTRATO DE ARRENDAMIENTO. ".$parte2);}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 3){
			
			if($conttabla == 0){$campofila = "NOTIFICADO(A): ";   $campofila2 = strtoupper($dator5)." ".$parte3;}
			if($conttabla == 1){$campofila = "QUIEN NOTIFICA: ";  $campofila2 = strtoupper($_SESSION['nombre']);}
			if($conttabla == 2){$campofila = "COORDINADOR(RA): "; $campofila2 = strtoupper($datoofi6);}
			
				
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
			
	}
	
	//NOTIFICACION PERSONAL DILIGENCIA EXTRAPROCESO INTERROGATORIO DE PARTE
	if($datos0c == 71){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		//$parte6       = $datospartesB[6];*/
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("NOTIFICACI�N PERSONAL"."            "."RADICADO: ".$dator2, $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%d de %B de %Y', strtotime($datos8));  
		//$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		if(is_null($datos11)){
			$fa = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fa = strftime('%d de %B de %Y', strtotime($datos11));
		}
	
		//$section->addText("Manizales, ".$fecha."; en la fecha el se�or ".strtoupper($parte1)." con c.c. ".$parte2.", adscrito a la planta de personal del CENTRO DE SERVICIOS JUDICIALES PARA LOS JUZGADOS CIVILES Y DE FAMILIA, debidamente autorizado por el Coordinador(ra) ".strtoupper($datoofi6)." y a solicitud del ".strtoupper($dator3)." de Manizales, se traslada a ".strtoupper($parte3)." para notificar personalmente el auto de fecha ".$fa.", mediante el cual se ".$datos6.", en contra de ".strtoupper($dator5).", dentro del proceso que seguidamente se menciona.",$fontStyleB, $paraStyleB2);
		
		$section->addText("Manizales, ".$fecha."; en la fecha el se�or (a) ".strtoupper($parte1)." con c.c. ".$parte2.", adscrito a la planta de personal del CENTRO DE SERVICIOS JUDICIALES PARA LOS JUZGADOS CIVILES Y DE FAMILIA, debidamente autorizado por el Coordinador (a) ".strtoupper($datoofi6)." y a solicitud del ".strtoupper($dator3)." de Manizales, se traslada a ".strtoupper($parte3)." para notificar personalmente al se�or (a) ".strtoupper($dator5).", el auto que se�ala fecha y hora para la diligencia de interrogatorio de parte dentro de las diligencias que seguidamente se relaciona. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = "JUZGADO DE ORIGEN: ";       $campofila2 = strtoupper($dator3);}
			if($conttabla == 1){$campofila = "DILIGENCIA EXTRAPROCESO: "; $campofila2 = strtoupper($dator4);}
			if($conttabla == 2){$campofila = "SOLICITANTE: ";             $campofila2 = strtoupper($dator7);}
			if($conttabla == 3){$campofila = "ABSOLVENTE(A): ";           $campofila2 = strtoupper($dator5);}
			if($conttabla == 4){$campofila = "NOTIFICADO: ";              $campofila2 = strtoupper($dator5);}
			if($conttabla == 5){$campofila = "CEDULA: ";                  $campofila2 = strtoupper($dator6);}
			if($conttabla == 6){$campofila = "FECHA AUTO: ";              $campofila2 = strtoupper($fa." ".$datos10);}
			if($conttabla == 7){$campofila = "ANEXOS: ";                  $campofila2 = strtoupper("COPIA DEL AUTO QUE SE�ALA FECHA Y HORA PARA LA DILIGENCIA DE INTERROGATORIO DE PARTE. ".$parte4);}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		$section->addText("AL CITADO SE LE ADVIERTE que debe comparecer a ese Despacho Judicial el d�a ".$parte5.". con su documento de identidad, La no asistencia se le dar� aplicaci�n al art�culo 210 del C. de P. Civil.",$fontStyleB, $paraStyleB2);
			
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 3){
			
			if($conttabla == 0){$campofila = "NOTIFICADO(A): ";   $campofila2 = strtoupper($dator5);}
			if($conttabla == 1){$campofila = "QUIEN NOTIFICA: ";  $campofila2 = strtoupper($_SESSION['nombre']);}
			if($conttabla == 2){$campofila = "COORDINADOR(RA): "; $campofila2 = strtoupper($datoofi6);}
			
				
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
			
	}
	
	//NOTIFICACION PERSONAL LA EXISTENCIA DE TITULOS EJECUTIVOS
	if($datos0c == 72){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("NOTIFICACI�N PERSONAL"."            "."RADICADO: ".$dator2, $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%d de %B de %Y', strtotime($datos8));  
		//$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		if(is_null($datos11)){
			$fa = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fa = strftime('%d de %B de %Y', strtotime($datos11));
		}
		
		$section->addText("Manizales, ".$fecha."; en la fecha comparece ante el CENTRO DE SERVICIOS JUDICIALES PARA LOS JUZGADOS CIVILES Y DE FAMILIA, la persona que a continuaci�n se identifica, con el fin de recibir NOTIFICACI�N PERSONAL del auto QUE ORDENA NOTIFICARLE LA EXISTENCIA DE TITULOS EJECUTIVOS en su contra, dentro del proceso que seguidamente se menciona. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 7){
			
			
			if($conttabla == 0){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 1){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 2){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($dator7);}
			if($conttabla == 3){$campofila = "DEMANDADO(A): ";      $campofila2 = strtoupper($dator5);}
			if($conttabla == 4){$campofila = "CEDULA: ";            $campofila2 = strtoupper($dator6);}
			if($conttabla == 5){$campofila = "FECHA AUTO: ";        $campofila2 = strtoupper($fa." ".$datos10);}
			if($conttabla == 6){$campofila = "ANEXOS: ";            $campofila2 = strtoupper("COPIA DEL AUTO QUE ORDENA NOTIFICAR LA EXISTENCIA DE TITULOS EJECUTIVOS. ".$parte2);}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
		
		$section->addText("SE LE NOTIFICA LA EXISTENCIA DE LOS TITULOS EJECUTIVOS PRESENTADOS CON LA DEMANDA COMO HEREDERO DETERMINADO DE EL SE�OR (A): ".$parte1." ASI MISMO SE LE HACE SABER LA EXISTENCIA DE LA OBLIGACION. LO ANTERIOR DE CONFORMIDAD CON EL ARTICULO. 1434 DEL CODIGO CIVL.",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 3){

			
			if($conttabla == 0){$campofila = "NOTIFICADO(A): ";   $campofila2 = strtoupper($dator5)." ".$parte3;}
			if($conttabla == 1){$campofila = "QUIEN NOTIFICA: ";  $campofila2 = strtoupper($_SESSION['nombre']);}
			if($conttabla == 2){$campofila = "COORDINADOR(RA): "; $campofila2 = strtoupper($datoofi6);}
			
				
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
			
	}
	
	//NOTIFICACION PERSONAL DILIGENCIA DE RECONOCIMIENTO DE FIRMA Y DOCUMENTO
	if($datos0c == 73){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		//$parte6       = $datospartesB[6];*/
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("NOTIFICACI�N PERSONAL"."            "."RADICADO: ".$dator2, $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%d de %B de %Y', strtotime($datos8));  
		//$section->addText(ucwords("Manizales ".$fecha),$fontStyleB, $paraStyleB2);
		$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		if(is_null($datos11)){
			$fa = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fa = strftime('%d de %B de %Y', strtotime($datos11));
		}
		
		$section->addText("Manizales, ".$fecha."; en la fecha comparece ante el CENTRO DE SERVICIOS JUDICIALES PARA LOS JUZGADOS CIVILES Y DE FAMILIA, la persona que a continuaci�n se identifica, con el fin de recibir NOTIFICACI�N PERSONAL del auto que ".$datos6.", dentro del proceso que seguidamente se menciona. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 7){
			
			
			if($conttabla == 0){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 1){$campofila = "DILIGENCIA EXTRAPROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 2){$campofila = $parte4.":";        $campofila2 = strtoupper($dator7);}
			if($conttabla == 3){$campofila = $parte5.":";;      $campofila2 = strtoupper($dator5);}
			if($conttabla == 4){$campofila = "CEDULA: ";            $campofila2 = strtoupper($dator6);}
			if($conttabla == 5){$campofila = "FECHA AUTO: ";        $campofila2 = strtoupper($fa." ".$datos10);}
			if($conttabla == 6){$campofila = "ANEXOS: ";            $campofila2 = strtoupper("COPIA DEL AUTO QUE ORDENA NOTIFICAR LA EXISTENCIA DE TITULOS EJECUTIVOS. ".$parte2);}
			
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
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
		
		$section->addText("Se le advierte que debe comparecer a ese Despacho Judicial el d�a ".$parte1." con su documento de identidad. La no asistencia a la diligencia se tendr� por surtido el reconocimiento. (art. 274 de C.P.C.)",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 3){

			
			if($conttabla == 0){$campofila = "NOTIFICADO(A): ";   $campofila2 = strtoupper($dator5)." ".$parte3;}
			if($conttabla == 1){$campofila = "QUIEN NOTIFICA: ";  $campofila2 = strtoupper($_SESSION['nombre']);}
			if($conttabla == 2){$campofila = "COORDINADOR(RA): "; $campofila2 = strtoupper($datoofi6);}
			
				
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
			
	}
	
	
	//*******************************************************NOTIFICACION POR AVISO********************************************************************************
	
	//NOTIFICACION POR AVISO EJECUTIVO
	if($datos0c == 60){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("NOTIFICACION POR AVISO", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleNO3, $paraStyleNO4);
		$fechaauto  = strftime('%d %B de %Y', strtotime($datos9));
		
		
		if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}
			
		//$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = "SE�OR(A): ";          $campofila2 = strtoupper($parte2);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "DEMANDADO: ";         $campofila2 = strtoupper($parte2);}
			
				
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
			$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleNO, $paraStyleNO2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleNO, $paraStyleNO2);
				
			$conttabla = $conttabla + 1;
		}
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		//$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText("TEXTO EN ROJO", $fontStyleP);
		
		//----------------------------------------
		
		if( ($datos9 >= "1897-04-04" && $datos9 <= "2015-12-31") ){
		
		//$section->addText(" DE CONFORMIDAD CON EL ART. 320 MODIFICADO ART. 32 LEY 794 DE 2003, SE LE NOTIFICA LA PROVIDENCIA FECHADA DEL ".strtoupper($fechaauto).", POR MEDIO DEL CUAL ".$datos6." FORMULADO EN SU CONTRA DENTRO DEL PROCESO ANTES REFERENCIADO. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addText("DE CONFORMIDAD CON EL ART. 320 MODIFICADO ART. 32 LEY 794 DE 2003, SE LE NOTIFICA LA PROVIDENCIA FECHADA DEL ".strtoupper($fechaauto).", POR MEDIO DEL CUAL SE ".$datos6." FORMULADO EN SU CONTRA DENTRO DEL PROCESO ANTES REFERENCIADO. ".$datos10,$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		$section->addText("ADVERTENCIA: SE LE ADVIERTE QUE LA NOTIFICACI�N SE CONSIDERAR� SURTIDA AL FINALIZAR EL D�A SIGUIENTE AL DEL RECIBO DEL PRESENTE AVISO.",$fontStyleNO3, $paraStyleNO4);
			
		//$section->addTextBreak(1);
		
		$section->addText("RETIRO DE COPIAS: DISPONE DEL T�RMINO DE TRES (3) D�AS PARA RETIRAR DEL CENTRO DE SERVICIOS JUDICIALES DE LOS JUZGADOS CIVILES Y DE FAMILIA, UBICADO EN LA DIRECCI�N QUE APARECE AL PIE DE ESTA PAGINA, LAS COPIAS DE LOS ANEXOS DE LA DEMANDA, VENCIDOS LOS ANTERIORES, COMENZAR� A CORRERLE EL T�RMINO DEL TRASLADO DE LA MISMA.",$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		$section->addText("ANEXOS: COPIA INFORMAL DEL ESCRITO DE DEMANDA Y COPIA DEL AUTO QUE ".$datos6." DEL ".strtoupper($fechaauto).", ".$parte3." ".$datos10,$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		}
		
		if($datos9 >= "2016-01-01"){
		
		//$section->addText(" DE CONFORMIDAD CON EL ART. 320 MODIFICADO ART. 32 LEY 794 DE 2003, SE LE NOTIFICA LA PROVIDENCIA FECHADA DEL ".strtoupper($fechaauto).", POR MEDIO DEL CUAL ".$datos6." FORMULADO EN SU CONTRA DENTRO DEL PROCESO ANTES REFERENCIADO. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addText("DE CONFORMIDAD CON EL ART. 292 DEL C�DIGO GENERAL DEL PROCESO, SE LE NOTIFICA LA PROVIDENCIA FECHADA DEL ".strtoupper($fechaauto).", POR MEDIO DEL CUAL SE ".$datos6." EN SU CONTRA DENTRO DEL PROCESO ANTES REFERENCIADO. ".$datos10,$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		$section->addText("ADVERTENCIA: SE LE ADVIERTE QUE LA NOTIFICACI�N SE CONSIDERAR� SURTIDA AL FINALIZAR EL D�A SIGUIENTE AL DEL RECIBO DEL PRESENTE AVISO.",$fontStyleNO3, $paraStyleNO4);
			
		//$section->addTextBreak(1);
		
		$section->addText("LA COPIA DEL ESCRITO DE LA DEMANDA CON LOS ANEXOS QUEDAN A DISPOSICI�N DE LA PARTE INTERESADA PARA SER RETIRADOS.",$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		$section->addText("ANEXOS: COPIA DEL AUTO QUE  ".$datos6." DEL ".strtoupper($fechaauto).", ".$parte3." ".$datos10,$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		}
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 6){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			//if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "Firma";}
			//if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "Fecha:";}
				
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
			$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleNO, $paraStyleNO2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleNO, $paraStyleNO2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//NOTIFICACION POR AVISO DECLATATIVO
	if($datos0c == 61){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("NOTIFICACION POR AVISO", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleNO3, $paraStyleNO4);
		$fechaauto  = strftime('%d %B de %Y', strtotime($datos9));
		
		
		if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}
			
		//$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = "SE�OR(A): ";          $campofila2 = strtoupper($parte2);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "DEMANDADO: ";         $campofila2 = strtoupper($parte2);}
			
				
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
			$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleNO, $paraStyleNO2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleNO, $paraStyleNO2);
				
			$conttabla = $conttabla + 1;
		}
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		//$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		if( ($datos9 >= "1897-04-04" && $datos9 <= "2015-12-31") ){
		
		//$section->addText(" DE CONFORMIDAD CON EL ART. 320 MODIFICADO ART. 32 LEY 794 DE 2003, SE LE NOTIFICA LA PROVIDENCIA FECHADA DEL ".strtoupper($fechaauto).", POR MEDIO DEL CUAL ".$datos6." FORMULADO EN SU CONTRA DENTRO DEL PROCESO ANTES REFERENCIADO. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addText("DE CONFORMIDAD CON EL ART. 320 MODIFICADO ART. 32 LEY 794 DE 2003, SE LE NOTIFICA LA PROVIDENCIA FECHADA DEL ".strtoupper($fechaauto).", POR MEDIO DEL CUAL SE ".$datos6." FORMULADO EN SU CONTRA DENTRO DEL PROCESO ANTES REFERENCIADO. ".$datos10,$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		$section->addText("ADVERTENCIA: SE LE ADVIERTE QUE LA NOTIFICACI�N SE CONSIDERAR� SURTIDA AL FINALIZAR EL D�A SIGUIENTE AL DEL RECIBO DEL PRESENTE AVISO.",$fontStyleNO3, $paraStyleNO4);
			
		//$section->addTextBreak(1);
		
		$section->addText("RETIRO DE COPIAS: DISPONE DEL T�RMINO DE TRES (3) D�AS PARA RETIRAR DEL CENTRO DE SERVICIOS JUDICIALES DE LOS JUZGADOS CIVILES Y DE FAMILIA, UBICADO EN LA DIRECCI�N QUE APARECE AL PIE DE ESTA PAGINA, LAS COPIAS DE LOS ANEXOS DE LA DEMANDA, VENCIDOS LOS ANTERIORES, COMENZAR� A CORRERLE EL T�RMINO DEL TRASLADO DE LA MISMA.",$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		$section->addText("ANEXOS: COPIA INFORMAL DEL ESCRITO DE DEMANDA Y COPIA DEL AUTO QUE ".$datos6." DEL ".strtoupper($fechaauto).", ".$parte3." ".$datos10,$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		}
		
		if($datos9 >= "2016-01-01"){
		
		//$section->addText(" DE CONFORMIDAD CON EL ART. 320 MODIFICADO ART. 32 LEY 794 DE 2003, SE LE NOTIFICA LA PROVIDENCIA FECHADA DEL ".strtoupper($fechaauto).", POR MEDIO DEL CUAL ".$datos6." FORMULADO EN SU CONTRA DENTRO DEL PROCESO ANTES REFERENCIADO. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addText("DE CONFORMIDAD CON EL ART. 292 DEL C�DIGO GENERAL DEL PROCESO, SE LE NOTIFICA LA PROVIDENCIA FECHADA DEL ".strtoupper($fechaauto).", POR MEDIO DEL CUAL SE ".$datos6." EN SU CONTRA DENTRO DEL PROCESO ANTES REFERENCIADO. ".$datos10,$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		$section->addText("ADVERTENCIA: SE LE ADVIERTE QUE LA NOTIFICACI�N SE CONSIDERAR� SURTIDA AL FINALIZAR EL D�A SIGUIENTE AL DEL RECIBO DEL PRESENTE AVISO.",$fontStyleNO3, $paraStyleNO4);
			
		//$section->addTextBreak(1);
		
		$section->addText("LA COPIA DEL ESCRITO DE LA DEMANDA CON LOS ANEXOS QUEDAN A DISPOSICI�N DE LA PARTE INTERESADA PARA SER RETIRADOS.",$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		$section->addText("ANEXOS: COPIA DEL AUTO QUE  ".$datos6." DEL ".strtoupper($fechaauto).", ".$parte3." ".$datos10,$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		}
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 6){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			//if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "Firma";}
			//if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "Fecha:";}
				
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
			$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleNO, $paraStyleNO2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleNO, $paraStyleNO2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//NOTIFICACION POR AVISO VERBAL
	if($datos0c == 62){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("NOTIFICACION POR AVISO", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleNO3, $paraStyleNO4);
		$fechaauto  = strftime('%d %B de %Y', strtotime($datos9));
		
		
		if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}
			
		//$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = "SE�OR(A): ";          $campofila2 = strtoupper($parte2);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "DEMANDADO: ";         $campofila2 = strtoupper($parte2);}
			
				
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
			$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleNO, $paraStyleNO2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleNO, $paraStyleNO2);
				
			$conttabla = $conttabla + 1;
		}
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		//$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		if( ($datos9 >= "1897-04-04" && $datos9 <= "2015-12-31") ){
		
		//$section->addText(" DE CONFORMIDAD CON EL ART. 320 MODIFICADO ART. 32 LEY 794 DE 2003, SE LE NOTIFICA LA PROVIDENCIA FECHADA DEL ".strtoupper($fechaauto).", POR MEDIO DEL CUAL ".$datos6." FORMULADO EN SU CONTRA DENTRO DEL PROCESO ANTES REFERENCIADO. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addText("DE CONFORMIDAD CON EL ART. 320 MODIFICADO ART. 32 LEY 794 DE 2003, SE LE NOTIFICA LA PROVIDENCIA FECHADA DEL ".strtoupper($fechaauto).", POR MEDIO DEL CUAL SE ".$datos6." FORMULADO EN SU CONTRA DENTRO DEL PROCESO ANTES REFERENCIADO. ".$datos10,$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		$section->addText("ADVERTENCIA: SE LE ADVIERTE QUE LA NOTIFICACI�N SE CONSIDERAR� SURTIDA AL FINALIZAR EL D�A SIGUIENTE AL DEL RECIBO DEL PRESENTE AVISO.",$fontStyleNO3, $paraStyleNO4);
			
		//$section->addTextBreak(1);
		
		$section->addText("RETIRO DE COPIAS: DISPONE DEL T�RMINO DE TRES (3) D�AS PARA RETIRAR DEL CENTRO DE SERVICIOS JUDICIALES DE LOS JUZGADOS CIVILES Y DE FAMILIA, UBICADO EN LA DIRECCI�N QUE APARECE AL PIE DE ESTA PAGINA, LAS COPIAS DE LOS ANEXOS DE LA DEMANDA, VENCIDOS LOS ANTERIORES, COMENZAR� A CORRERLE EL T�RMINO DEL TRASLADO DE LA MISMA.",$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		$section->addText("ANEXOS: COPIA INFORMAL DEL ESCRITO DE DEMANDA Y COPIA DEL AUTO QUE ".$datos6." DEL ".strtoupper($fechaauto).", ".$parte3." ".$datos10,$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		}
		
		if($datos9 >= "2016-01-01"){
		
		//$section->addText(" DE CONFORMIDAD CON EL ART. 320 MODIFICADO ART. 32 LEY 794 DE 2003, SE LE NOTIFICA LA PROVIDENCIA FECHADA DEL ".strtoupper($fechaauto).", POR MEDIO DEL CUAL ".$datos6." FORMULADO EN SU CONTRA DENTRO DEL PROCESO ANTES REFERENCIADO. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addText("DE CONFORMIDAD CON EL ART. 292 DEL C�DIGO GENERAL DEL PROCESO, SE LE NOTIFICA LA PROVIDENCIA FECHADA DEL ".strtoupper($fechaauto).", POR MEDIO DEL CUAL SE ".$datos6." EN SU CONTRA DENTRO DEL PROCESO ANTES REFERENCIADO. ".$datos10,$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		$section->addText("ADVERTENCIA: SE LE ADVIERTE QUE LA NOTIFICACI�N SE CONSIDERAR� SURTIDA AL FINALIZAR EL D�A SIGUIENTE AL DEL RECIBO DEL PRESENTE AVISO.",$fontStyleNO3, $paraStyleNO4);
			
		//$section->addTextBreak(1);
		
		$section->addText("LA COPIA DEL ESCRITO DE LA DEMANDA CON LOS ANEXOS QUEDAN A DISPOSICI�N DE LA PARTE INTERESADA PARA SER RETIRADOS.",$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		$section->addText("ANEXOS: COPIA DEL AUTO QUE  ".$datos6." DEL ".strtoupper($fechaauto).", ".$parte3." ".$datos10,$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		}
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 6){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			//if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "Firma";}
			//if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "Fecha:";}
				
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
			$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleNO, $paraStyleNO2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleNO, $paraStyleN02);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//NOTIFICACION POR AVISO INTERROGATORIO
	if($datos0c == 63){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		/*$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("NOTIFICACION POR AVISO", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleNO3,$paraStyleNO4);
		$fechaauto  = strftime('%d %B de %Y', strtotime($datos9));
		
		
		if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}
			
		//$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = "SE�OR(A): ";          $campofila2 = strtoupper($parte2);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "DILIGENCIA EXTRAPROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "SOLICITANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "ABSOLVENTE: ";         $campofila2 = strtoupper($parte2);}
			
				
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
			$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleNO, $paraStyleNO2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleNO, $paraStyleNO2);
				
			$conttabla = $conttabla + 1;
		}
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		//$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		if( ($datos9 >= "1897-04-04" && $datos9 <= "2015-12-31") ){
		
		$section->addText("DE CONFORMIDAD CON EL ART. 320 MODIFICADO ART. 32 LEY 794 DE 2003, SE LE NOTIFICA LA PROVIDENCIA FECHADA DEL ".strtoupper($fechaauto).", POR MEDIO DEL CUAL SE ".$datos6." ".$datos10,$fontStyleNO3,$paraStyleNO4);
			
		//$section->addTextBreak(1);
		
		$section->addText("ADVERTENCIA: SE LE ADVIERTE QUE LA NOTIFICACI�N SE CONSIDERAR� SURTIDA AL FINALIZAR EL D�A SIGUIENTE AL DEL RECIBO DEL PRESENTE AVISO.",$fontStyleNO3,$paraStyleNO4);
			
		//$section->addTextBreak(1);
		
		$section->addText("QUE DEBE PRESENTARSE CON CEDULA DE CIUDADANIA AL ". $dator3 ." DE ESTA CIUDAD EL DIA ".$parte3.", A FIN DE LLEVAR A CABO DILIGENCIA DE INTERROGATORIO.",$fontStyleNO3,$paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		$section->addText("QUE LA NO COMPARECENCIA AL DESPACHO EN LA FECHA Y HORA ANTES SE�ALADOS PARA LA AUDIENCIA, HAR�  PRESUMIR CIERTOS LOS HECHOS SUSCEPTIBLES DE PRUEBA DE CONFESI�N. ADEMAS SE TOMAR�  COMO INDICIO GRAVE EN SU CONTRA, CONFORME LO ESTABLECIDO  EN EL ARTICULO 210 DEL C.DE P.CIVIL, MODIFICADO POR LA LEY  794 DE 2003.",$fontStyleNO3,$paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		$section->addText("ANEXOS: COPIA INFORMAL DEL ESCRITO DE DEMANDA Y COPIA DEL AUTO QUE ".$datos6." DEL ".strtoupper($fechaauto).", ".$parte4." ".$datos10,$fontStyleNO3,$paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		}
		
		if($datos9 >= "2016-01-01"){
		
		//$section->addText(" DE CONFORMIDAD CON EL ART. 320 MODIFICADO ART. 32 LEY 794 DE 2003, SE LE NOTIFICA LA PROVIDENCIA FECHADA DEL ".strtoupper($fechaauto).", POR MEDIO DEL CUAL ".$datos6." FORMULADO EN SU CONTRA DENTRO DEL PROCESO ANTES REFERENCIADO. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addText("DE CONFORMIDAD CON EL ART. 292 DEL C�DIGO GENERAL DEL PROCESO, SE LE NOTIFICA LA PROVIDENCIA FECHADA DEL ".strtoupper($fechaauto).", POR MEDIO DEL CUAL SE ".$datos6." EN SU CONTRA DENTRO DEL PROCESO ANTES REFERENCIADO. ".$datos10,$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		$section->addText("ADVERTENCIA: SE LE ADVIERTE QUE LA NOTIFICACI�N SE CONSIDERAR� SURTIDA AL FINALIZAR EL D�A SIGUIENTE AL DEL RECIBO DEL PRESENTE AVISO.",$fontStyleNO3, $paraStyleNO4);
			
		//$section->addTextBreak(1);
		
		$section->addText("LA COPIA DEL ESCRITO DE LA DEMANDA CON LOS ANEXOS QUEDAN A DISPOSICI�N DE LA PARTE INTERESADA PARA SER RETIRADOS.",$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		$section->addText("ANEXOS: COPIA DEL AUTO QUE  ".$datos6." DEL ".strtoupper($fechaauto).", ".$parte3." ".$datos10,$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		}
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 6){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			//if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "Firma";}
			//if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "Fecha:";}
				
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
			$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleNO, $paraStyleNO2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleNO, $paraStyleNO2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//NOTIFICACION POR AVISO EJECUTIVO HIPOTECARIO / ACREEDOR HIPOTECARIO
	if($datos0c == 64){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];
		$parte7       = $datospartesB[7];
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("NOTIFICACION POR AVISO", $fontStyleA, $paraStyleA2);
		
		//$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleNO3, $paraStyleNO4);
		$fechaauto  = strftime('%d %B de %Y', strtotime($datos9));
		
		
		if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}
			
		//$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 10){
			
			if($conttabla == 0){$campofila = "SE�OR(A): ";          $campofila2 = strtoupper($parte3);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($parte4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($parte5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($parte1);}
			if($conttabla == 7){$campofila = "DEMANDADO: ";         $campofila2 = strtoupper($parte2);}
			if($conttabla == 8){$campofila = "FECHA DEL AUTO: ";    $campofila2 = strtoupper($fechaauto);}
			if($conttabla == 9){$campofila = "CITADO: ";            $campofila2 = strtoupper($parte3);}
			
	
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
			$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleNO, $paraStyleNO2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleNO, $paraStyleNO2);
				
			$conttabla = $conttabla + 1;
		}
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		//$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		if( ($datos9 >= "1897-04-04" && $datos9 <= "2015-12-31") ){
		
		//$section->addText(" DE CONFORMIDAD CON EL ART. 320 MODIFICADO ART. 32 LEY 794 DE 2003, SE LE NOTIFICA LA PROVIDENCIA FECHADA DEL ".strtoupper($fechaauto).", POR MEDIO DEL CUAL ".$datos6." FORMULADO EN SU CONTRA DENTRO DEL PROCESO ANTES REFERENCIADO. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addText("DE CONFORMIDAD CON EL ART. 320 MODIFICADO ART. 32 LEY 794 DE 2003, SE LE NOTIFICA LA PROVIDENCIA FECHADA DEL ".strtoupper($fechaauto).", POR MEDIO DEL CUAL SE ".$datos6." FORMULADO EN SU CONTRA DENTRO DEL PROCESO ANTES REFERENCIADO. ".$datos10,$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		$section->addText("ADVERTENCIA: SE LE ADVIERTE QUE LA NOTIFICACI�N SE CONSIDERAR� SURTIDA AL FINALIZAR EL D�A SIGUIENTE AL DEL RECIBO DEL PRESENTE AVISO.",$fontStyleNO3, $paraStyleNO4);
			
		//$section->addTextBreak(1);
		
		$section->addText("RETIRO DE COPIAS: DISPONE DEL T�RMINO DE TRES (3) D�AS PARA RETIRAR DEL CENTRO DE SERVICIOS JUDICIALES DE LOS JUZGADOS CIVILES Y DE FAMILIA, UBICADO EN LA DIRECCI�N QUE APARECE AL PIE DE ESTA PAGINA, LAS COPIAS DE LOS ANEXOS DE LA DEMANDA, VENCIDOS LOS ANTERIORES, COMENZAR� A CORRERLE EL T�RMINO DEL TRASLADO DE LA MISMA.",$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		$section->addText("ANEXOS: COPIA INFORMAL DEL ESCRITO DE DEMANDA Y COPIA DEL AUTO QUE ".$datos6." DEL ".strtoupper($fechaauto).", ".$parte3." ".$datos10,$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		}
		
		if($datos9 >= "2016-01-01"){
		
		//$section->addText(" DE CONFORMIDAD CON EL ART. 320 MODIFICADO ART. 32 LEY 794 DE 2003, SE LE NOTIFICA LA PROVIDENCIA FECHADA DEL ".strtoupper($fechaauto).", POR MEDIO DEL CUAL ".$datos6." FORMULADO EN SU CONTRA DENTRO DEL PROCESO ANTES REFERENCIADO. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addText("DE CONFORMIDAD CON EL ART. 292 DEL C�DIGO GENERAL DEL PROCESO, SE LE NOTIFICA LA PROVIDENCIA FECHADA DEL ".strtoupper($fechaauto).", POR MEDIO DEL CUAL SE ".$datos6." EN SU CONTRA DENTRO DEL PROCESO ANTES REFERENCIADO. ".$datos10,$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		$section->addText("ADVERTENCIA: SE LE ADVIERTE QUE LA NOTIFICACI�N SE CONSIDERAR� SURTIDA AL FINALIZAR EL D�A SIGUIENTE AL DEL RECIBO DEL PRESENTE AVISO.",$fontStyleNO3, $paraStyleNO4);
			
		//$section->addTextBreak(1);
		
		$section->addText("LA COPIA DEL ESCRITO DE LA DEMANDA CON LOS ANEXOS QUEDAN A DISPOSICI�N DE LA PARTE INTERESADA PARA SER RETIRADOS.",$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		$section->addText("ANEXOS: COPIA DEL AUTO QUE  ".$datos6." DEL ".strtoupper($fechaauto).", ".$parte3." ".$datos10,$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		}
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 6){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			//if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "Firma";}
			//if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "Fecha:";}
				
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
			$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleNO, $paraStyleNO2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleNO, $paraStyleNO2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//PLANTILLA APOYO NOTIFICACION POR AVISO
	if($datos0c == 66){
		
		//$datospartesB = explode("//////",$datospartes);
		//$parte1       = $datospartesB[1];
		//$parte2       = $datospartesB[2];
		//$parte3       = $datospartesB[3];
		/*$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
			
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("NOTIFICACION POR AVISO", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleNO3,$paraStyleNO4);
		$fechaauto  = strftime('%d %B de %Y', strtotime($datos9));
		
		
		if(is_null($datos11)){
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fechaauto = strftime('%d de %B de %Y', strtotime($datos11));
		}
			
		//$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
			
			
			if($conttabla == 0){$campofila = "SE�OR(A): ";          $campofila2 = strtoupper($parte2);}
			if($conttabla == 1){$campofila = "DIRECCION: ";         $campofila2 = strtoupper($datos4);}
			if($conttabla == 2){$campofila = "CIUDAD: ";            $campofila2 = strtoupper($datos5);}
			if($conttabla == 3){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 4){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 5){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 6){$campofila = "DEMANDANTE: ";        $campofila2 = "";}
			if($conttabla == 7){$campofila = "DEMANDADO: ";         $campofila2 = "";}
			
				
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
			$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleNO, $paraStyleNO2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleNO, $paraStyleNO2);
				
			$conttabla = $conttabla + 1;
		}
			
			
		//----------------------------------------------------------------------------------------------------------------------
		
		//$section->addTextBreak(1);
			
		//SOLO PARA PRUEBA DE COLOR--------------
		//$section->addText($parte1, $fontStyleP);
		//----------------------------------------
		
		if( ($datos9 >= "1897-04-04" && $datos9 <= "2015-12-31") ){
		
		//$section->addText(" DE CONFORMIDAD CON EL ART. 320 MODIFICADO ART. 32 LEY 794 DE 2003, SE LE NOTIFICA LA PROVIDENCIA FECHADA DEL ".strtoupper($fechaauto).", POR MEDIO DEL CUAL ".$datos6." FORMULADO EN SU CONTRA DENTRO DEL PROCESO ANTES REFERENCIADO. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addText("DE CONFORMIDAD CON EL ART. 320 MODIFICADO ART. 32 LEY 794 DE 2003, SE LE NOTIFICA LA PROVIDENCIA FECHADA DEL ".strtoupper($fechaauto).", POR MEDIO DEL CUAL SE ".$datos6." FORMULADO EN SU CONTRA DENTRO DEL PROCESO ANTES REFERENCIADO. ".$datos10,$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		$section->addText("ADVERTENCIA: SE LE ADVIERTE QUE LA NOTIFICACI�N SE CONSIDERAR� SURTIDA AL FINALIZAR EL D�A SIGUIENTE AL DEL RECIBO DEL PRESENTE AVISO.",$fontStyleNO3, $paraStyleNO4);
			
		//$section->addTextBreak(1);
		
		$section->addText("RETIRO DE COPIAS: DISPONE DEL T�RMINO DE TRES (3) D�AS PARA RETIRAR DEL CENTRO DE SERVICIOS JUDICIALES DE LOS JUZGADOS CIVILES Y DE FAMILIA, UBICADO EN LA DIRECCI�N QUE APARECE AL PIE DE ESTA PAGINA, LAS COPIAS DE LOS ANEXOS DE LA DEMANDA, VENCIDOS LOS ANTERIORES, COMENZAR� A CORRERLE EL T�RMINO DEL TRASLADO DE LA MISMA.",$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		$section->addText("ANEXOS: COPIA INFORMAL DEL ESCRITO DE DEMANDA Y COPIA DEL AUTO QUE ".$datos6." DEL ".strtoupper($fechaauto).", ".$parte3." ".$datos10,$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		}
		
		if($datos9 >= "2016-01-01"){
		
		//$section->addText(" DE CONFORMIDAD CON EL ART. 320 MODIFICADO ART. 32 LEY 794 DE 2003, SE LE NOTIFICA LA PROVIDENCIA FECHADA DEL ".strtoupper($fechaauto).", POR MEDIO DEL CUAL ".$datos6." FORMULADO EN SU CONTRA DENTRO DEL PROCESO ANTES REFERENCIADO. ".$datos10,$fontStyleB, $paraStyleB2);
		
		$section->addText("DE CONFORMIDAD CON EL ART. 292 DEL C�DIGO GENERAL DEL PROCESO, SE LE NOTIFICA LA PROVIDENCIA FECHADA DEL ".strtoupper($fechaauto).", POR MEDIO DEL CUAL SE ".$datos6." EN SU CONTRA DENTRO DEL PROCESO ANTES REFERENCIADO. ".$datos10,$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		$section->addText("ADVERTENCIA: SE LE ADVIERTE QUE LA NOTIFICACI�N SE CONSIDERAR� SURTIDA AL FINALIZAR EL D�A SIGUIENTE AL DEL RECIBO DEL PRESENTE AVISO.",$fontStyleNO3, $paraStyleNO4);
			
		//$section->addTextBreak(1);
		
		$section->addText("LA COPIA DEL ESCRITO DE LA DEMANDA CON LOS ANEXOS QUEDAN A DISPOSICI�N DE LA PARTE INTERESADA PARA SER RETIRADOS.",$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		$section->addText("ANEXOS: COPIA DEL AUTO QUE  ".$datos6." DEL ".strtoupper($fechaauto).", ".$parte3." ".$datos10,$fontStyleNO3, $paraStyleNO4);
		
		//$section->addTextBreak(1);
		
		}
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 6){
			
			if($conttabla == 0){$campofila = "Empleado Responsable"; $campofila2 = "Parte interesada";}
			if($conttabla == 1){$campofila = $nombrelider;           $campofila2 = "";}
			if($conttabla == 2){$campofila = "Nombres y apellidos";  $campofila2 = "Nombres y Apellidos";}
			//if($conttabla == 3){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 3){$campofila = "";                     $campofila2 = "Firma";}
			//if($conttabla == 5){$campofila = "";                     $campofila2 = "";}
			if($conttabla == 4){$campofila = "";                     $campofila2 = "N�mero de c�dula";}
			if($conttabla == 5){$campofila = "";                     $campofila2 = "Fecha:";}
				
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
			$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleNO, $paraStyleNO2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleNO, $paraStyleNO2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	
	//*******************************************************DEVOLUCIONES********************************************************************************
	
	//DEVOLUCION GESTION AGOTADA
	if($datos0c == 36){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		//$parte4       = $datospartesB[4];
		/*$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("DEVOLUCI�N DOCUMENTOS GESTION AGOTADA", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%d de %B de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleG, $paraStyleG2);
		//$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		/*if(is_null($datos11)){
			$fa = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fa = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
		$section->addTextBreak(1);
		
		/*$dator1  = $filar[id];
		$dator2  = $filar[radicado];
		$dator3  = $filar[nombre];
		$dator4  = $filar[nombre_proceso];
		$dator5  = $filar[demandado];
		$dator6  = $filar[cedulademandado];
		$dator7  = $filar[demandante];
		$dator8  = $filar[cedulademandante];*/
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 5){
			
			
			if($conttabla == 0){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 1){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 2){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 3){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($dator7);}
			if($conttabla == 4){$campofila = "DEMANDADO(A): ";      $campofila2 = strtoupper($nombreddo);}
						
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
			$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleH, $paraStyleH2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleH, $paraStyleH2);
				
			$conttabla = $conttabla + 1;
		}
	
		$section->addTextBreak(1);
		
		$section->addText("DOCUMENTOS ANEXOS QUE SE DEVUELVEN",$fontStyleI, $paraStyleGI);
		
		$section->addTextBreak(1);
		
		$section->addText($parte1,$fontStyleG, $paraStyleG2);
		
		$section->addTextBreak(1);
		
		$section->addText("NOTA: ".$parte2,$fontStyleG, $paraStyleG2);
		
		$section->addTextBreak(1);
		
		$section->addText("MOTIVO DE LA DEVOLUCI�N ",$fontStyleI, $paraStyleI2);
			
		$section->addTextBreak(1);
		
		//$section->addText("SE DEVUELVEN LAS DILIGENCIAS POR CUANTO HA TRANSCURRIDO MAS DE ".$parte3." DIAS SIN QUE LA PARTE INTERESADA HAYA REALIZADO LAS GESTIONES PERTINENTES TENDIENTES A LOGRAR LA NOTIFICACION DE ".$parte4.".",$fontStyleG, $paraStyleG2);
		
		$section->addText("SE DEVUELVEN LAS DILIGENCIAS POR CUANTO HA TRANSCURRIDO MAS DE ".$parte3." DIAS SIN QUE LA PARTE INTERESADA HAYA REALIZADO LAS GESTIONES PERTINENTES TENDIENTES A LOGRAR LA NOTIFICACION DE EL O LOS DEMANDADO (S)",$fontStyleG, $paraStyleG2);
		
		
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 2){
			
			if($conttabla == 0){$campofila = "NOMBRE QUIEN RECIBE: ";  $campofila2 = " ";}
			if($conttabla == 1){$campofila = "NOMBRE QUIEN ENTREGA: "; $campofila2 = strtoupper($nombreentrega);}
			//if($conttabla == 2){$campofila = "COORDINADOR(RA): ";     $campofila2 = strtoupper($datoofi6);}
			//if($conttabla == 2){$campofila = "ELABORADO POR: ";        $campofila2 = strtoupper($_SESSION['nombre']);}
			
				
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
			$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleH, $paraStyleH2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleH, $paraStyleH2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//DEVOLUCION A SOLICITUD JUZGADO
	if($datos0c == 37){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		//$parte3       = $datospartesB[3];
		//$parte4       = $datospartesB[4];
		/*$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("DEVOLUCI�N DOCUMENTOS A SOLICITUD DEL JUZGADO", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%d de %B de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleG, $paraStyleG2);
		//$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		/*if(is_null($datos11)){
			$fa = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fa = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
		$section->addTextBreak(1);
		
		/*$dator1  = $filar[id];
		$dator2  = $filar[radicado];
		$dator3  = $filar[nombre];
		$dator4  = $filar[nombre_proceso];
		$dator5  = $filar[demandado];
		$dator6  = $filar[cedulademandado];
		$dator7  = $filar[demandante];
		$dator8  = $filar[cedulademandante];*/
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 5){
			
			
			if($conttabla == 0){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 1){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 2){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 3){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($dator7);}
			if($conttabla == 4){$campofila = "DEMANDADO(A): ";      $campofila2 = strtoupper($nombreddo);}
						
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
			$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleH, $paraStyleH2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleH, $paraStyleH2);
				
			$conttabla = $conttabla + 1;
		}
	
		$section->addTextBreak(1);
		
		$section->addText("DOCUMENTOS ANEXOS QUE SE DEVUELVEN",$fontStyleI, $paraStyleGI);
		
		$section->addTextBreak(1);
		
		$section->addText($parte1,$fontStyleG, $paraStyleG2);
		
		$section->addTextBreak(1);
		
		$section->addText("NOTA: ".$parte2,$fontStyleG, $paraStyleG2);
		
		$section->addTextBreak(1);
		
		$section->addText("MOTIVO DE LA DEVOLUCI�N ",$fontStyleI, $paraStyleI2);
			
		$section->addTextBreak(1);
		
		$section->addText("A SOLICITUD DEL JUZGADO SE DEVUELVEN LAS PRESENTES DILIGENCIAS.",$fontStyleG, $paraStyleG2);
		
		
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 2){
			
			if($conttabla == 0){$campofila = "NOMBRE QUIEN RECIBE: ";  $campofila2 = " ";}
			if($conttabla == 1){$campofila = "NOMBRE QUIEN ENTREGA: "; $campofila2 = strtoupper($nombreentrega);}
			//if($conttabla == 2){$campofila = "COORDINADOR(RA): ";     $campofila2 = strtoupper($datoofi6);}
			//if($conttabla == 2){$campofila = "ELABORADO POR: ";        $campofila2 = strtoupper($_SESSION['nombre']);}
			
				
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
			$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleH, $paraStyleH2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleH, $paraStyleH2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//DEVOLUCION NOTI PERSONAL
	if($datos0c == 38){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		//$parte4       = $datospartesB[4];
		/*$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("DEVOLUCI�N DOCUMENTOS NOTIFICACION PERSONAL", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%d de %B de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleG, $paraStyleG2);
		$fecha2  = strftime('%d %B de %Y', strtotime($parte3));
		
		/*if(is_null($datos11)){
			$fa = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fa = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
		$section->addTextBreak(1);
		
		/*$dator1  = $filar[id];
		$dator2  = $filar[radicado];
		$dator3  = $filar[nombre];
		$dator4  = $filar[nombre_proceso];
		$dator5  = $filar[demandado];
		$dator6  = $filar[cedulademandado];
		$dator7  = $filar[demandante];
		$dator8  = $filar[cedulademandante];*/
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 5){
			
			
			if($conttabla == 0){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 1){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 2){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 3){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($dator7);}
			if($conttabla == 4){$campofila = "DEMANDADO(A): ";      $campofila2 = strtoupper($nombreddo);}
						
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
			$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleH, $paraStyleH2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleH, $paraStyleH2);
				
			$conttabla = $conttabla + 1;
		}
	
		$section->addTextBreak(1);
		
		$section->addText("DOCUMENTOS ANEXOS QUE SE DEVUELVEN",$fontStyleI, $paraStyleGI);
		
		$section->addTextBreak(1);
		
		$section->addText($parte1,$fontStyleG, $paraStyleG2);
		
		$section->addTextBreak(1);
		
		$section->addText("NOTA: ".$parte2,$fontStyleG, $paraStyleG2);
		
		$section->addTextBreak(1);
		
		$section->addText("MOTIVO DE LA DEVOLUCI�N ",$fontStyleI, $paraStyleI2);
			
		$section->addTextBreak(1);
		
		$section->addText("SE DEVUELVEN LAS DILIGENCIAS AL JUZGADO POR CUANTO EL O LOS DEMANDADO(S) SE NOTIFIC� (ARON) PERSONALMENTE EN EL CSJCF EL ".strtoupper($fecha2),$fontStyleG, $paraStyleG2);
		
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 2){
			
			if($conttabla == 0){$campofila = "NOMBRE QUIEN RECIBE: ";  $campofila2 = " ";}
			if($conttabla == 1){$campofila = "NOMBRE QUIEN ENTREGA: "; $campofila2 = strtoupper($nombreentrega);}
			//if($conttabla == 2){$campofila = "COORDINADOR(RA): ";     $campofila2 = strtoupper($datoofi6);}
			//if($conttabla == 2){$campofila = "ELABORADO POR: ";        $campofila2 = strtoupper($_SESSION['nombre']);}
			
				
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
			$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleH, $paraStyleH2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleH, $paraStyleH2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//DEVOLUCION NOTI  X AVISO
	if($datos0c == 39){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		//$parte3       = $datospartesB[3];
		//$parte4       = $datospartesB[4];
		/*$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("DEVOLUCI�N DOCUMENTOS NOTIFICACION POR AVISO", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%d de %B de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleG, $paraStyleG2);
		//$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		/*if(is_null($datos11)){
			$fa = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fa = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
		$section->addTextBreak(1);
		
		/*$dator1  = $filar[id];
		$dator2  = $filar[radicado];
		$dator3  = $filar[nombre];
		$dator4  = $filar[nombre_proceso];
		$dator5  = $filar[demandado];
		$dator6  = $filar[cedulademandado];
		$dator7  = $filar[demandante];
		$dator8  = $filar[cedulademandante];*/
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 5){
			
			
			if($conttabla == 0){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 1){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 2){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 3){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($dator7);}
			if($conttabla == 4){$campofila = "DEMANDADO(A): ";      $campofila2 = strtoupper($nombreddo);}
						
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
			$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleH, $paraStyleH2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleH, $paraStyleH2);
				
			$conttabla = $conttabla + 1;
		}
	
		$section->addTextBreak(1);
		
		$section->addText("DOCUMENTOS ANEXOS QUE SE DEVUELVEN",$fontStyleI, $paraStyleGI);
		
		$section->addTextBreak(1);
		
		$section->addText($parte1,$fontStyleG, $paraStyleG2);
		
		$section->addTextBreak(1);
		
		$section->addText("NOTA: ".$parte2,$fontStyleG, $paraStyleG2);
		
		$section->addTextBreak(1);
		
		$section->addText("MOTIVO DE LA DEVOLUCI�N ",$fontStyleI, $paraStyleI2);
			
		$section->addTextBreak(1);
		
		$section->addText("SE DEVUELVEN LAS DILIGENCIAS AL JUZGADO POR CUANTO SE ENCUENTRA VENCIDO EL TERMINO CON EL QUE CUENTA LA ENTIDAD INCIDENTADA PARA RETIRAR LOS ANEXOS DE LA DEMANDA.",$fontStyleG, $paraStyleG2);
		
		
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 2){
			
			if($conttabla == 0){$campofila = "NOMBRE QUIEN RECIBE: ";  $campofila2 = " ";}
			if($conttabla == 1){$campofila = "NOMBRE QUIEN ENTREGA: "; $campofila2 = strtoupper($nombreentrega);}
			//if($conttabla == 2){$campofila = "COORDINADOR(RA): ";     $campofila2 = strtoupper($datoofi6);}
			//if($conttabla == 2){$campofila = "ELABORADO POR: ";        $campofila2 = strtoupper($_SESSION['nombre']);}
			
				
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
			$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleH, $paraStyleH2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleH, $paraStyleH2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//DEVOLUCION POR CORREO
	if($datos0c == 40){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		//$parte4       = $datospartesB[4];
		/*$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];*/
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("DEVOLUCI�N DOCUMENTOS DEVOLUCION CORREO", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%d de %B de %Y', strtotime($datos8));  
		$section->addText(ucwords("Manizales ".$fecha),$fontStyleG, $paraStyleG2);
		//$fechaauto  = strftime('%B %d de %Y', strtotime($datos9));
		
		/*if(is_null($datos11)){
			$fa = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fa = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
		$section->addTextBreak(1);
		
		/*$dator1  = $filar[id];
		$dator2  = $filar[radicado];
		$dator3  = $filar[nombre];
		$dator4  = $filar[nombre_proceso];
		$dator5  = $filar[demandado];
		$dator6  = $filar[cedulademandado];
		$dator7  = $filar[demandante];
		$dator8  = $filar[cedulademandante];*/
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 5){
			
			
			if($conttabla == 0){$campofila = "JUZGADO DE ORIGEN: "; $campofila2 = strtoupper($dator3);}
			if($conttabla == 1){$campofila = "PROCESO: ";           $campofila2 = strtoupper($dator4);}
			if($conttabla == 2){$campofila = "RADICADO: ";          $campofila2 = strtoupper($dator2);}
			if($conttabla == 3){$campofila = "DEMANDANTE: ";        $campofila2 = strtoupper($dator7);}
			if($conttabla == 4){$campofila = "DEMANDADO(A): ";      $campofila2 = strtoupper($nombreddo);}
						
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
			$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleH, $paraStyleH2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleH, $paraStyleH2);
				
			$conttabla = $conttabla + 1;
		}
	
		$section->addTextBreak(1);
		
		$section->addText("DOCUMENTOS ANEXOS QUE SE DEVUELVEN",$fontStyleI, $paraStyleGI);
		
		$section->addTextBreak(1);
		
		$section->addText($parte1,$fontStyleG, $paraStyleG2);
		
		$section->addTextBreak(1);
		
		$section->addText("NOTA: ".$parte2,$fontStyleG, $paraStyleG2);
		
		$section->addTextBreak(1);
		
		$section->addText("MOTIVO DE LA DEVOLUCI�N ",$fontStyleI, $paraStyleI2);
			
		$section->addTextBreak(1);
		
		$section->addText("SE DEVUELVEN LAS DILIGENCIAS AL JUZGADO POR CUANTO EL CORREO CERTIFICADO DEVUELVE LA CITACION PARA NOTIFICACION PERSONAL POR MOTIVO: ".$parte3,$fontStyleG, $paraStyleG2);
		
		
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 2){
			
			if($conttabla == 0){$campofila = "NOMBRE QUIEN RECIBE: ";  $campofila2 = " ";}
			if($conttabla == 1){$campofila = "NOMBRE QUIEN ENTREGA: "; $campofila2 = strtoupper($nombreentrega);}
			//if($conttabla == 2){$campofila = "COORDINADOR(RA): ";     $campofila2 = strtoupper($datoofi6);}
			//if($conttabla == 2){$campofila = "ELABORADO POR: ";        $campofila2 = strtoupper($_SESSION['nombre']);}
			
				
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
			$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleH, $paraStyleH2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleH, $paraStyleH2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//*******************************************************CONSTANCIA DE ENTREGA DE ANEXOS DE LA DEMANDA********************************************************************************
	
	//CONSTANCIA DE ENTREGA DE ANEXOS DE LA DEMANDA
	/*if($datos0c == 68){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];
		$parte7       = $datospartesB[7];
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CONSTANCIA DE ENTREGA DE ANEXOS DE LA DEMANDA. (RAD. ".$parte1." )", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%d de %B de %Y', strtotime($datos8));  
		//$section->addText(ucwords("Manizales ".$fecha),$fontStyleG, $paraStyleG2);
		$fechaauto  = strftime('%d %B de %Y', strtotime($parte7));
		
		/*if(is_null($datos11)){
			$fa = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fa = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
	
		//$section->addTextBreak(1);
		
		/*$section->addText("Manizales, ".$fecha.",  presente ante este Centro de Servicios el ".$parte2." identificado con C.C. ".$parte3.", en calidad de demandado  dentro del proceso ".$parte4.", promovido por el ".$parte5.", que se tramita en el ".$parte6." de esta Ciudad.",$fontStyleG, $paraStyleG2);
		
		$section->addTextBreak(1);
		
		$section->addText("El demandado exhibe la notificaci�n por aviso y manifiesta haberla recibido el d�a de hoy, ".$fechaauto,$fontStyleG, $paraStyleG2);
	
		$section->addTextBreak(1);
		
		//----------------------------------------------------------------------------------------------------------------------
		
		$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 2){
			
			if($conttabla == 0){$campofila = "QUIEN RECIBE: ";  $campofila2 = strtoupper($parte2);}
			if($conttabla == 1){$campofila = "QUIEN ENTREGA: "; $campofila2 = strtoupper($_SESSION['nombre']);}
			//if($conttabla == 2){$campofila = "COORDINADOR(RA): ";     $campofila2 = strtoupper($datoofi6);}
			//if($conttabla == 2){$campofila = "ELABORADO POR: ";        $campofila2 = strtoupper($_SESSION['nombre']);}
			
				
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
			$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleH, $paraStyleH2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleH, $paraStyleH2);
				
			$conttabla = $conttabla + 1;
		}
			
	}*/
	
	
	//CONSTANCIA DE ENTREGA DE ANEXOS DE LA DEMANDA
	if($datos0c == 68){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		/*$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];
		$parte7       = $datospartesB[7];*/
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CONSTANCIA DE ENTREGA DE ANEXOS DE LA DEMANDA. (RAD. ".$dator2.")", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%d de %B de %Y', strtotime($datos8));  
		//$section->addText(ucwords("Manizales ".$fecha),$fontStyleG, $paraStyleG2);
		$fechaauto  = strftime('%d %B de %Y', strtotime($parte2));
		
		/*if(is_null($datos11)){
			$fa = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fa = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
	
		//$section->addTextBreak(1);
		
		$section->addText("Manizales, ".$fecha.",  presente ante este Centro de Servicios el Se�or (a) ".$dator5." identificado con C.C. ".$dator6.", en calidad de demandado  dentro del proceso ".$dator4.", promovido por el Se�or (a) ".$parte1.", que se tramita en el ".$dator3." de esta Ciudad.",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText("El demandado exhibe la notificaci�n por aviso y manifiesta haberla recibido el d�a de hoy, ".$fechaauto,$fontStyleB, $paraStyleB2);
	
		$section->addTextBreak(1);
		
		//----------------------------------------------------------------------------------------------------------------------
		
		//$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 2){
			
			if($conttabla == 0){$campofila = "QUIEN RECIBE: ";  $campofila2 = strtoupper($dator5);}
			if($conttabla == 1){$campofila = "QUIEN ENTREGA: "; $campofila2 = strtoupper($_SESSION['nombre']);}
			//if($conttabla == 2){$campofila = "COORDINADOR(RA): ";     $campofila2 = strtoupper($datoofi6);}
			//if($conttabla == 2){$campofila = "ELABORADO POR: ";        $campofila2 = strtoupper($_SESSION['nombre']);}
			
				
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
			$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleH, $paraStyleH2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleH, $paraStyleH2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//CONSTANCIA DE ENTREGA DE ANEXOS DE LA DEMANDA APODERADO
	if($datos0c == 69){
		
		$datospartesB = explode("//////",$datospartes);
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		/*$parte6       = $datospartesB[6];
		$parte7       = $datospartesB[7];*/
		
		//$section->addText("OFICIO No. ".$datos1." pos: ".$pos, $fontStyleB, $paraStyleB2);
		
		$section->addText("CONSTANCIA DE ENTREGA DE ANEXOS DE LA DEMANDA. (RAD. ".$dator2.")", $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%d de %B de %Y', strtotime($datos8));  
		//$section->addText(ucwords("Manizales ".$fecha),$fontStyleG, $paraStyleG2);
		$fechaauto  = strftime('%d %B de %Y', strtotime($parte5));
		
		/*if(is_null($datos11)){
			$fa = strftime('%d de %B de %Y', strtotime($datos9));
		}
		else{
			$fa = strftime('%d de %B de %Y', strtotime($datos11));
		}*/
	
		//$section->addTextBreak(1);
		
		$section->addText("Manizales, ".$fecha.", presente ante este Centro de Servicios el Dr (a). ".$parte1." identificado con C.C. No. ".$parte2." y T.P. No. ".$parte3." en calidad de apoderado de la Se�or (a) ".$dator5." CITADA dentro del proceso  ".$dator4.", promovido por el Se�or (a) ".$parte4.", que se tramita en el ".$dator3." de esta Ciudad.",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText("El apoderado manifiesta haber recibido la notificaci�n por aviso y manifiesta haberla recibido el d�a de hoy, ".$fechaauto,$fontStyleB, $paraStyleB2);
	
		$section->addTextBreak(1);
		
		//----------------------------------------------------------------------------------------------------------------------
		
		//$section->addTextBreak(1);
			
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 2){
			
			if($conttabla == 0){$campofila = "QUIEN RECIBE: ";  $campofila2 = strtoupper($parte1);}
			if($conttabla == 1){$campofila = "QUIEN ENTREGA: "; $campofila2 = strtoupper($_SESSION['nombre']);}
			//if($conttabla == 2){$campofila = "COORDINADOR(RA): ";     $campofila2 = strtoupper($datoofi6);}
			//if($conttabla == 2){$campofila = "ELABORADO POR: ";        $campofila2 = strtoupper($_SESSION['nombre']);}
			
				
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
			$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleH, $paraStyleH2);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleH, $paraStyleH2);
				
			$conttabla = $conttabla + 1;
		}
			
	}
	
	//CARATULA
	if($idcaratulaplantilla == 400){
	
		$datos0c = $idcaratulaplantilla;
		
		//$idradicadocaratula
	
		$serverName = "192.168.89.20"; //serverName\instanceName
		$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"sa", "PWD"=>"3j3cut1V416");
		
		//CONEXION PARA LA SALA DISCIPLINARIA
		/*$serverName = "192.168.89.22"; //serverName\instanceName
		$connectionInfo = array( "Database"=>"S_Discipl", "UID"=>"sa", "PWD"=>"3j3cut1V416");*/
		
		$conn = sqlsrv_connect( $serverName, $connectionInfo);
		 
		 if( $conn ) { 
			//echo "Conectado a la Base de Datoss.<br />"; 
		 }
		 else{ 
			echo "NO se puede conectar a la Base de Datoss.<br />";
			die( print_r( sqlsrv_errors(), true)); 
		 }
		
		
		//CONVERT(nvarchar(20),t103.A103FECHPROC) AS A103FECHPROC	
		/*$sql = ("SELECT t103.A103LLAVPROC,CONVERT(VARCHAR(10), t103.A103FECHPROC, 103) AS A103FECHPROC,t103.A103NOMBPONE,t053.A053DESCCLAS,t500.A500NOMBBCO,
				 t112.A112CODISUJE,t112.A112NUMESUJE,t112.A112NOMBSUJE,t112.A112IDENREPR,t112.A112NOMBREPR 
				 FROM (((T103DAINFOPROC t103 LEFT JOIN T053BACLASGENE t053 ON t103.A103CODICLAS = t053.A053CODICLAS)
				 LEFT JOIN T500JUZGADOS t500 ON t500.A500NUMEBCO = t103.A103CODINUMO AND t500.A500CIUDBCO = 17001)
				 LEFT JOIN T112DRSUJEPROC t112 ON t112.A112LLAVPROC = t103.A103LLAVPROC)
				 WHERE A103LLAVPROC ='$idradicadocaratula'");*/
		
		//SE CAMBIA AESTA SQL YA QUE LA TABLA T051BAENTIGENE ME DA UNA MEJOR REFENECIA
		//PARA IMPRIMIR EN LA PLANTILLA QUE TIPO DE DESPACHO O JUZGADO, ESTE DATO ES EL REFERENTE
		//A $D4 Y SE CONCATENA CON $D10 PARA TENER EL NUMERO DE ESE DESPACHO O JUZGADO
		
		$sql = ("SELECT t103.A103LLAVPROC,CONVERT(VARCHAR(10), t103.A103FECHPROC, 103) AS A103FECHPROC,t103.A103NOMBPONE,t103.A103CODINUMO,
		         t053.A053DESCCLAS,
		         t51.A051DESCENTI,
				 t62.A062DESCESPE,
	             t112.A112CODISUJE,t112.A112NUMESUJE,t112.A112NOMBSUJE,t112.A112IDENREPR,t112.A112NOMBREPR 
				 FROM ((((T103DAINFOPROC t103 LEFT JOIN T053BACLASGENE t053 ON t103.A103CODICLAS = t053.A053CODICLAS)
				 LEFT JOIN T051BAENTIGENE t51 ON t51.A051CODIENTI = t103.A103ENTIRADI)
				 LEFT JOIN T062BAESPEGENE t62 ON t62.A062CODIESPE = t103.A103ESPERADI)
				 LEFT JOIN T112DRSUJEPROC t112 ON t112.A112LLAVPROC = t103.A103LLAVPROC)
				 WHERE A103LLAVPROC ='$idradicadocaratula'");
				 
				 
		//SQL PARA LA SALA DISCIPLINARIA 
		/*$sql = ("SELECT t103.A103LLAVPROC,CONVERT(VARCHAR(10), t103.A103FECHPROC, 103) AS A103FECHPROC,t103.A103NOMBPONE,t103.A103CODINUMO,
		         t053.A053DESCCLAS,
		         t51.A051DESCENTI,
				 t62.A062DESCESPE,
	             t112.A112CODISUJE,t112.A112NUMESUJE,t112.A112NOMBSUJE,t112.A112IDENREPR,t112.A112NOMBREPR 
				 FROM ((((T103DAINFOPROC t103 LEFT JOIN T053BACLASGENE t053 ON t103.A103CODICLAS = t053.A053CODICLAS)
				 LEFT JOIN T051BAENTIGENE t51 ON t51.A051CODIENTI = t103.A103ENTIRADI)
				 LEFT JOIN T062BAESPEGENE t62 ON t62.A062CODIESPE = t103.A103ESPERADI)
				 LEFT JOIN T112DRSUJEPROC t112 ON t112.A112LLAVPROC = t103.A103LLAVPROC)
				 WHERE A103LLAVPROC ='$idradicadocaratula'");*/
				 
		 /*LEFT JOIN T500JUZGADOS t500 ON t500.A500NUMEBCO = t103.A103CODINUMO AND t500.A500ESPEBCO = 2041 AND t500.A500CIUDBCO = 17001)*/
						
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_query( $conn, $sql , $params, $options );
		
		$row_count = sqlsrv_num_rows( $stmt );
	
		if ($row_count === false){
			echo "Error in retrieveing row count. En Consulta";
		}
		else{

			while( $row = sqlsrv_fetch_array( $stmt)){
			
				$D1  = trim($row['A103LLAVPROC']);
				
				$D2  = trim($row['A103FECHPROC']);
				$D9  = trim($row['A103NOMBPONE']);
				
				$D3  = trim($row['A053DESCCLAS']);
				
				//$D4  = trim($row['A500NOMBBCO']);
				//DESCRIPCION JUZGADO
				$D4  = trim($row['A051DESCENTI']);
				
				//EJEMPLO:
				//JUZGADO  001 LABORAL MUNICIPAL DE PEQUE�AS CAUSAS LABORAL
				
				//$D4B = JUZGADO
				//$D10 = 001
				//$D11 = LABORAL
				//$D4C = MUNICIPAL DE PEQUE�AS CAUSAS LABORAL
				
				
				$longitud = strlen($D4);
				
				for ($i=0; $i<=$longitud ;$i++){
					
					//SE PREGUNTA SI ES ESPACIO EN BLANCO
					if( ord($D4[$i]) == 32 ){
					
						//OBTENEMOS LA CADENA HASTA DONDE ENCUENTRE EL PRIMER ESPACIO
						$D4B = substr($D4, 0, $i + 1);
						
						//OBTENEMOS LA CADENA DESPUES DEL PRIMER ESPACIO HASTA EL FINAL DE LA CADENA
						$D4C = substr($D4, $i + 1, strlen($D4));
						
						$i   = $longitud;
					}
					
				}
				
				//CODIGO JUZGADO
				$D10 = trim($row['A103CODINUMO']);
				
				//DESCRIPCION ESPECIALIDAD
				$D11 = trim($row['A062DESCESPE']);
				
				//NOMBRE COMPLETO JUZGADO
				$D4  = " ";
				$D4  = strtoupper($D4B." ".$D10." ".$D11." ".$D4C);
				
				//DEMANDANTE
				if(trim($row['A112CODISUJE'] == '0001')){
				
					//$D5  = number_format(trim($row['A112NUMESUJE']), 0, ' ', '.');
					$D5  = trim($row['A112NUMESUJE']);
					$D6  = trim($row['A112NOMBSUJE']);
					
					$datosdemandantec .= $D5.", ";
					$datosdemandanten .= $D6.", ";
					
					if(trim($row['A112NOMBREPR']) == "SIN APODERADO"){
				    	$D5B = " ";
						$D6B = " ";
					}
					else{
						//APODERADO
						$D5B = number_format(trim($row['A112IDENREPR']), 0, ' ', '.');
				    	$D6B = trim($row['A112NOMBREPR']);
					}
				}
				
				//DEMANDADO
				if(trim($row['A112CODISUJE'] == '0002')){
				
					//$D7  = number_format(trim($row['A112NUMESUJE']), 0, ' ', '.');
					$D7  = trim($row['A112NUMESUJE']);
					$D8  = trim($row['A112NOMBSUJE']);
					
					$datosdemandadoc .= $D7.", ";
					$datosdemandadon .= $D8.", ";
					
					if(trim($row['A112NOMBREPR']) == "SIN APODERADO"){
				    	
						$D7B = " ";
						$D8B = " ";
					}
					else{
						//APODERADO
						$D7B = number_format(trim($row['A112IDENREPR']), 0, ' ', '.');
						$D8B = trim($row['A112NOMBREPR']);
					}
				}
				
				
			}
				
		}
		
		//SE REALIZA ESTA COMPARACION PARA QUE EN LA CARATULA GENERADA NO SE REPITA
		//EL APODERADO, ES DECIR EL MISMO APODERADO PARA DEMANDANTE Y DEMANDADO
		//ESTA INCOSISTENCIA SE PRESENTA AL MOMENTO DE DAR INGRESO AL PROCESO EN JUSTICIA SIGLO XXI
		//YA QUE LOS USUARIOS DEL SISTEMA DEJAN EL MISMO APODERADO PARA EL DEMANDADO
		if($D5B == $D7B){
			
			$D7B = " ";
			$D8B = " ";
		}
		
		//OBTENEMOS RADICADO 17001400300619931018000  para armarlo asi 17001-40-03-006-1993-10180-00 
		//LA PARTE QUE ES EL NUMERO DEL JUZGADO 006
		$D1A = substr($D1,0,5);
		$D1B = substr($D1,5,2);
		$D1C = substr($D1,7,2);
		$D1D = substr($D1,9,3);
		$D1E = substr($D1,12,4);
		$D1F = substr($D1,16,5);
		$D1G = substr($D1,21,2);
		
		$D1= "";
		$D1 = $D1A."-".$D1B."-".$D1C."-".$D1D."-".$D1E."-".$D1F."-".$D1G;
		
		$section->addText("Caja: _____"."   "."No orden: _____"."   "."A�o de archivo: _____",$fontStyleVAR, $paraStyleVAR);
		
		//PARA PROBRAR SI TRAE INFORMACION CON EL RADICADO, YA QUE  EN LA VISTA
		//PARA GENERAR LAS CARATULAS EN LA TABLA DINAMICA SE LE DABA CLIC EN EL PRIMER REGISTRO
		//NUM ---> 1 Y NO CARGABA INFORMACION, Y $row_count = sqlsrv_num_rows( $stmt ); ERA IGUAL A CERO
		//ESTO SE CORRIGE USANDO TRIM A LA VARIABLE
		//$idradicadocaratula  = trim($_GET['idradicadocaratula']);
		
		//$section->addText($idradicadocaratula."******".$row_count,$fontStyleVAR, $paraStyleVAR);
		
		$section->addImage('views/images/logo_consejo.png', array('width'=>72, 'height'=>93, 'align'=>'center'));
		//$section->addText('RAMA JUDICIAL DEL PODER P�BLICO	      CONSEJO SUPERIOR DE LA JUDICATURA	       DIRECCI�N EJECUTIVA ADMINISTRACI�N JUDICIAL        SECCIONAL MANIZALES',$fontStyleJUZ, $paraStyleJUZ);	    
		$section->addText('RAMA JUDICIAL DEL PODER P�BLICO',$fontStyleJUZ, $paraStyleJUZ);	    
		$section->addText('CONSEJO SUPERIOR DE LA JUDICATURA',$fontStyleJUZ, $paraStyleJUZ);	    
		$section->addText('DIRECCI�N EJECUTIVA ADMINISTRACI�N JUDICIAL',$fontStyleJUZ, $paraStyleJUZ);	    
		$section->addText('SECCIONAL MANIZALES',$fontStyleJUZ, $paraStyleJUZ);	    
		
		$section->addTextBreak(1);
		
		$section->addText($D4,$fontStyleJUZ, $paraStyleJUZ);
		
		//LINEA PARA SABER QUE SE TRAE DE LA BASE DE DATOS
		//$section->addText("A500NOMBBCO: ".$D4."A103NOMBPONE: ".$D9,$fontStyleJUZ, $paraStyleJUZ);
		
		/*if( empty($D4) ){
			
			//A103NOMBPONE TABLA T103DAINFOPROC SIGLO XXI
			$section->addText($D9,$fontStyleJUZ, $paraStyleJUZ);
			
		
		}
		else{

			//A500NOMBBCO T500JUZGADOS SIGLO XX1
			$section->addText($D4,$fontStyleJUZ, $paraStyleJUZ);
		}*/
		
		$section->addTextBreak(1);
				
				
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
				
		while($conttabla < 11){
				
			if($conttabla == 0){$campofila = "No. RADICACI�N: ";       $campofila2 =$D1;}
			if($conttabla == 1){$campofila = "PROCESO: ";              $campofila2 =$D3;}
			if($conttabla == 2){$campofila = "DEMANDANTE: ";           $campofila2 =$datosdemandanten;}
			if($conttabla == 3){$campofila = "IDENTIFICACI�N: ";       $campofila2 =$datosdemandantec;}
			if($conttabla == 4){$campofila = "APODERADO: ";            $campofila2 =$D6B;}
			if($conttabla == 5){$campofila = "IDENTIFICACI�N /T.P.: "; $campofila2 =$D5B;}
			if($conttabla == 6){$campofila = "DEMANDADO: ";            $campofila2 =$datosdemandadon;}
			if($conttabla == 7){$campofila = "NIT/IDENTIFICACI�N: ";   $campofila2 =$datosdemandadoc;}
			if($conttabla == 8){$campofila = "APODERADO: ";            $campofila2 =$D8B;}
			if($conttabla == 9){$campofila = "IDENTIFICACI�N /T.P.: "; $campofila2 =$D7B;}
			if($conttabla == 10){$campofila = "RADICACI�N: ";          $campofila2 =$D2;}
			
		
					
			//PARAMETROS PARA LA TABLA
			$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table1 = $section->addTable('myOwnTableStyle');
			$table1->addRow(500);
					
			$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleCRTULAB, $paraStyleCRTULAB);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleCRTULAB, $paraStyleCRTULAB);
					
			$conttabla = $conttabla + 1;
		}
	
	     $section->addTextBreak(1);
		 
		 $section->addText($D1,$fontStyleCRTULA, $paraStyleCRTULA);
		 
		 $section->addTextBreak(1);
				 
		 $section->addText("TOMO: _____"."   "."FOLIO: _____"."   "."CUADERNO: _____",$fontStyleVAR, $paraStyleVAR);
		 
		 $section->addTextBreak(1);
				 
		 $section->addText("OBSERVACIONES:",$fontStyleVAR, $paraStyleVAR);
         $section->addText("_______________________________________________________________________",$fontStyleB, $paraStyleB2);
		 $section->addText("_______________________________________________________________________",$fontStyleB, $paraStyleB2);
		 $section->addText("_______________________________________________________________________",$fontStyleB, $paraStyleB2);
				
		//ADICIONA UNA NUEVA PAGINA
		//$section->addPageBreak();
			
			
	}
	
	
	
	//------------------------------------------------------------------------------------------------------------------------------
	
	if($datos0c != 400){
	
	
	//AYUDA A IDENTIFICAR EL ID DEL AUTO, PARA CUALQUIER CASO DE CORRECCION O INCONSISTENCIA
	//Y PERMITE SABER QUIEN ELABORO EL DOCUMENTO Y EL ACUERDO ESPECIFICO
	$section->addTextBreak(1);
	
	//$section->addText($iddoc,$fontStyleIDDOC, $paraStyleIDDOC2);
	//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
	$conttabla = 0;
			
	while($conttabla < 2){
			
			if($conttabla == 0){$campofila = "(".$iddoc.") Elaborado Por: ";      $campofila2 = $_SESSION['nombre'];}
			if($conttabla == 1){$campofila = $acuerdo;               $campofila2 = "";}
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
			$table1->addCell(1200, $styleCell)->addText($campofila,$fontStyleIDDOC, $fontStyleIDDOC2);
			$table1->addCell(1800, $styleCell)->addText($campofila2,$fontStyleIDDOC, $fontStyleIDDOC2);
				
			$conttabla = $conttabla + 1;
	}
	
	//pie de p�gina
	$footer = $section->createFooter();
	$table  = $footer->addTable();
	$table->addRow();
	//$table->addCell(2000)->addImage('views/images/piepagina2.jpg', array('width'=>488, 'height'=>79, 'align'=>'right'));
	$table->addCell(2000)->addImage('views/images/piepagina2.jpg', array('width'=>599, 'height'=>79, 'align'=>'right'));
	//$footer->addPreserveText('Carrera 23 N� 21-48- Palacio de Justicia "Fanny Gonz�lez Franco" Oficina 108 - Tel�fono 8879665 Manizales, Caldas',$fontStyle1, $fontStyle1);	
	
	}
	else{
		$datos1 = "CARATULA";
	}
	
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