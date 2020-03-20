<?php
    class documentoswordModel extends modelBase{
	/************************ Se obtiene los datos del documento *************************************/
	public function Obtener_Datos_Documento($iddoc){
            //ini_set('max_execution_time', 240); //240 segundos = 4 minutos

            /*$listar     = $this->db->prepare("SELECT rds.id,rds.idradicado,td.nombre_tipo_documento,td.id AS iddocumento,rds.numero,d.nombre_dirigido,
                                            rds.nombre,rds.direccion,rds.ciudad,rds.fechageneracion,rds.fechaauto,rds.asunto,rds.contenido,rds.partes,
                                            do.id AS iddoc,do.nombre_documento,rds.descorrecion,rds.fechaautocorrige,rds.idautonotifica
                                            FROM (((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
                                            LEFT JOIN pa_documento do ON td.iddocumento = do.id)
                                            LEFT JOIN pa_dirigido d ON rds.dirigidoa = d.id)
                                            WHERE rds.id = '$iddoc'");*/
										  
            //EN ESTA SQL SE AGREGA EL LEFT JOIN radicador_direccion PARA NO PEDIR ESE CAMPO DINAMICO EN EL DOCUMENTO
            $listar     = $this->db->prepare("  SELECT rds.id,rds.idradicado,td.nombre_tipo_documento,td.id AS iddocumento,rds.numero,d.nombre_dirigido,
                                            rds.nombre,rds.direccion,rds.ciudad,rds.fechageneracion,rds.fechaauto,rds.asunto,rds.contenido,rds.partes,
                                            do.id AS iddoc,do.nombre_documento,rds.descorrecion,rds.fechaautocorrige,rds.idautonotifica,
                                            dir.telefono,dir.direccion AS direc2,user.empleado,user_2.empleado AS elaboro,rds.horageneracion,
                                            t2.des AS des_tipo_parte,rds.fechaaudiencia,rds.horaaudencia,rds.idaudencia
                                            FROM ((((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
                                            LEFT JOIN pa_documento do ON td.iddocumento = do.id)
                                            LEFT JOIN pa_dirigido d ON rds.dirigidoa = d.id)
                                            LEFT JOIN radicador_direccion dir ON rds.iddireccion = dir.id)
                                            LEFT JOIN pa_usuario user ON rds.idcitador = user.id)
                                            LEFT JOIN pa_usuario user_2 ON rds.idusuario = user_2.id)
                                            LEFT JOIN radicador_partes t1 ON (rds.idparte = t1.id AND rds.idradicado = t1.id_radicado) )
                                            LEFT JOIN radicador_pa_tipoparte t2 ON t1.id_tipo = t2.idjxxi)
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
                FROM ((((((documentos_internos di LEFT JOIN signot_parte pr ON di.idparte = pr.id)
                LEFT JOIN signot_proceso pro ON pro.id = di.idradicado)
                LEFT JOIN pa_juzgado jo ON jo.id = pro.idjuzgadoorigen)
                LEFT JOIN signot_pa_clase_proceso cpro ON cpro.id = pro.idclaseproceso)
                LEFT JOIN signot_parteproceso pp ON pp.idproceso = di.idradicado AND pp.idclaseparte = 1)
                LEFT JOIN signot_parte pr2 ON pr2.id = pp.idparte)
                WHERE di.id = '$iddoc'");*/
										  
            $listar     = $this->db->prepare("SELECT rds.id,rds.idtipodocumento,td.nombre_tipo_documento,rds.numero,
                                            d.nombre_dirigido,part.doc_identidad,rds.nombre,rds.direccion,rds.ciudad,
                                            rds.fechageneracion,rds.fechaauto,rds.asunto,rds.contenido,pu.empleado AS registra,
                                            pub.empleado AS modifica,rds.fechaedita,do.nombre_documento AS documento,ubi.radicado,
                                            rds.fechaautocorrige,rds.descorrecion,rds.idautocorrige,rds.idautonotifica,rds.idtipodocumento,
                                            copu.des AS conductapunible,rds.fechaaudiencia,rds.horaaudencia,rds.idaudencia

                                            FROM ((((((((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
                                            LEFT JOIN pa_documento do ON td.iddocumento = do.id)
                                            LEFT JOIN pa_dirigido d ON rds.dirigidoa = d.id)
                                            LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
                                            LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
                                            LEFT JOIN radicador_proceso ubi ON rds.idradicado = ubi.id)
                                            LEFT JOIN radicador_partes part ON part.id = rds.idparte)
                                            LEFT JOIN radicador_pa_conductapunible copu ON copu.idjxxi = ubi.id_conducta_punible)
                                            WHERE rds.id = '$iddoc'");
            $listar->execute();	  
            return $listar; 
        }
   
        //FUNCION USADA CUANDO EN LA TABLA documentos_internos EN LA COLUMNA idparte NO SE GRABA NADA, COMO ES EL CASO DE LAS DEVOLUCIONES
        public function Obtener_Datos_Radicado_2($iddoc){								  
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
	
	public function get_fecha_actual_amd(){
	
            //FORMA WIN 7 Y 8, YA QUE DE LA FORMA ANTERIOR TOMA EL AM O PM Y DA CONFLICTOS PARA 
            //GUARDAR EN LA BASE DE DATOS EN ESTE CASO LA TABLA detalle_correspondencia 
            //CAMPO fecha QUE ES DATETIME 
            date_default_timezone_set('America/Bogota'); 
            $fecharegistro=date('Y-m-d'); //FORMA PARA XP
            //$fecharegistro = date('Y-m-d g:i'); 
            return $fecharegistro; 
	}
	//INFORMACION DE LA BASE DE DATOS, PARA SU CONEXION
	public function get_datos_basededatos($idbd){
            $listar     = $this->db->prepare("SELECT * FROM pa_base_datos WHERE id = ".$idbd);
            $listar->execute();
            return $listar;
  	}
    }/*Cierra Model*/
?>

<?php
    //CREAMOS EL OBJETO DATA PARA DAR USO DE LAS FUNCIONES DEL MODELO wordModel()
    $data   = new documentoswordModel();

    $opcion = $_GET['opcion'];
    $iddoc  = $_GET['id'];
    $idtd   = $_GET['idtd'];

    //DATOS DOCUMENTO
    $nombreddo = $_GET['nombreddo'];

    //PARA LA CARATULA
    $idradicadocaratula  = trim($_GET['idradicadocaratula']);
//    JUAN ESTEBAN MUNERA BETANCUR 09-03-2017
    $ciudad = substr($idradicadocaratula, 0,5);
    $entidad =substr($idradicadocaratula, 5,2);
    $especialidad =substr($idradicadocaratula, 7,2);
    $num_despacho =substr($idradicadocaratula, 9,3);
    
    $idcaratulaplantilla = $_GET['idcaratula'];

    //ME PERMITE IDENTIFICAR QUE TIPOS DE DOCUMENTOS SON DEVOLUCIONES PARA QUE AL GENERAR 
    //LA PLANTILLA USE OTRA FUNCION EN EL MODELO documentoswordModel.php
    $campos              = 'idtabla';
    $nombrelista         = 'pa_modulo_acciones';

    $idaccion            = '7';
    $campoordenar        = 'id';
    $datosmodulos        = $data->get_lista_modulos_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $modulost1           = $datosmodulos->fetch();
    $modulost2		 = explode("////",$modulost1[idtabla]);

    $idaccion            = '8';
    $campoordenar        = 'id';
    $datosmodulos        = $data->get_lista_modulos_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $modulost1           = $datosmodulos->fetch();
    $modulost2b		 = explode("////",$modulost1[idtabla]);

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
            $datoofi7  = $filao[juezcoordinador];
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

            //DIRECCION Y TELEFONO SE TRAE DIRECTAMENTE DE LA TABLA radicador_direccion
            //$datos4  = $field[direccion];
            $datos4  = $field[direc2];
            $datos4B = $field[telefono];

            $datos5  = $field[ciudad];
            $datos6  = $field[asunto];
            $datos7  = $field[contenido];

            $datos8  = $field[fechageneracion];
            $datos8B = $field[empleado];
            $datos8C = $field[elaboro];
            $datos8D = $field[horageneracion];

            $datos9  = $field[fechaauto];
            $datos10 = $field[descorrecion];
            $datos11 = $field[fechaautocorrige];

            $datosir = $field[idradicado];

            $datospartes = $field[partes];

            $datosidautonotifica = $field[idautonotifica];

            $des_tipo_parte = $field[des_tipo_parte];

            $datos12 = $field[fechaaudiencia];
            $datos13 = $field[horaaudencia];
            $datos14 = $field[idaudencia];
	}
	//OBTENEMOS LOS DATOS DEL RADICADO
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
            $dator10 = $filar[conductapunible];	
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
            $cantdias =  utf8_decode ("CINCO (05) DÌAS HÀBILES");
	}
	if( trim($datos5) != trim("Caldas - MANIZALES") && trim($datos5) != trim("EXTERIOR - FUERA DE COLOMBIA") ){	
            $cantdias =  utf8_decode ("DIEZ (10) DÌAS HÀBILES");
	}
	if( trim($datos5) == trim("EXTERIOR - FUERA DE COLOMBIA") ){
            $cantdias =  utf8_decode ("TREINTA (30) DÌAS HÀBILES");
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
	
	$fontStyleB3  = array ('size'=>10);
	$paraStyleB3 = array ('align' => 'center');//'align' => 'both' TEXTO JUSTIFICADO
	
	$fontStyleB4  = array ('bold' => true,'size'=>10);
	$paraStyleB4  = array ('align' => 'both');
	

	$fontStyleC  = array ('bold' => true,'size'=>10);
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
	
	$fontStyleJ  = array ('bold' => true,'size'=>11);
	$paraStyleJ2 = array ('align' => 'right');
	
	$fontStyleK  = array ('size'=>10);
	$paraStyleK2 = array ('align' => 'left');
	
	$fontStyleL  = array ('size'=>11);
	$paraStyleL2 = array ('align' => 'center');
	
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
	
	$fontStyleIDDOC  = array ('bold' => true,'size'=>7);
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
	/*$fontStyleJUZ  = array ('bold' => true,'size'=>16);
	$paraStyleJUZ  = array ('align' => 'center');
	
	$fontStyleCRTULA  = array ('bold' => true,'size'=>24);
	$paraStyleCRTULA  = array ('align' => 'center');
	
	$fontStyleCRTULAB  = array ('bold' => false,'size'=>14);
	$paraStyleCRTULAB  = array ('align' => 'left');
	
	$fontStyleVAR  = array ('bold' => true,'size'=>16);
	$paraStyleVAR  = array ('align' => 'both');
	
	$fontStyleJUZ_2  = array ('bold' => true,'size'=>14);
	$paraStyleJUZ_2  = array ('align' => 'right');
*/

    //PARA LA CARATULA
    $fontStyleJUZ  = array ('bold' => true,'size'=>13);
    $paraStyleJUZ  = array ('align' => 'center');
    
    $fontStyleCRTULA  = array ('bold' => true,'size'=>18);
    $paraStyleCRTULA  = array ('align' => 'center');
    
    $fontStyleCRTULAB  = array ('bold' => false,'size'=>11);
    $paraStyleCRTULAB  = array ('align' => 'left');
    
    $fontStyleVAR  = array ('bold' => true,'size'=>11);
    $paraStyleVAR  = array ('align' => 'both');
    
    $fontStyleJUZ_2  = array ('bold' => true,'size'=>11);
    $paraStyleJUZ_2  = array ('align' => 'right');
	
	if($idcaratulaplantilla != 400){
            //-----------------------------ENCABEZADO DEL DOCUMENTO-----------------------------------------------------------------
            $header = $section->createHeader();
            $table  = $header->addTable();
            $table->addRow();
            $table->addCell(2000)->addImage('views/images/encabezado.png', array('width'=>599, 'height'=>95, 'align'=>'center'));
            //$table->addCell(4500)->addText('Centro de Servicios Judiciales Manizales Civil - Familia',$fontStyle1, $fontStyle1);
            //----------------------------------------------------------------------------------------------------------------------
	}
	//DOS ESPACIOS EN BLANCO ENTRE UN PARRAFO Y OTRO
	//$section->addTextBreak(2);
	
	//************************************************CITACIONES*********************************************************************
	//Citacion a Indiciado
	if($datos0c == 1){
            $datospartesB = explode("//////",$datospartes);

            $parte0       = $datospartesB[0];

            //FECHA
            //$parte1       = $datospartesB[1];
            //HORA
            //$parte2       = $datospartesB[2];

            $parte1       = $datos12;
            $date         = date_create($datos13);
            $parte2       = date_format($date, 'g:i A');

            $parte3       = $datospartesB[3];
            $parte4       = $datospartesB[4];
            $parte5       = $datospartesB[5];
            //$parte6       = $datospartesB[6];
            //$parte7       = $datospartesB[7];

            //fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
            setlocale(LC_TIME, "Spanish");
            //OBTENEMOS LA FECHA ACTUAL
            $fechaactual  = $data->get_fecha_actual_amd();

            $fecha = strftime('%d de %B %Y', strtotime($fechaactual));  
            $section->addText(ucwords("Manizales, ".$fecha),$fontStyleB, $paraStyleB2);

            $fecha_2 = strftime('%d de %B %Y', strtotime($parte1));  
            //$section->addText(ucwords("Manizales, ".$fecha_2),$fontStyleB, $paraStyleB2);

            $section->addTextBreak(1);

            $section->addText($datos2,$fontStyleB, $paraStyleB2);
            $section->addText($parte3." (Indiciado)",$fontStyleB4, $paraStyleB4);
            $section->addText($datos4,$fontStyleB, $paraStyleB2);
            $section->addText("CELULAR-TELEFONO. ".$datos4B,$fontStyleB, $paraStyleB2);
            $section->addText($datos5,$fontStyleB, $paraStyleB2);


            $section->addText(utf8_decode ("CITACIÒN JUDICIAL: ").$datos1, $fontStyleA, $paraStyleA2);
            $section->addText("REF.: Proceso: ".$dator2." seguido en su contra, por el delito de, ".$dator10.".",$fontStyleB, $paraStyleB2);

            $section->addTextBreak(1);
		
            $section->addText(utf8_decode ("De manera respetuosa me permito solicitarle, se digne hacer presentaciòn personal ante este ").$datoofi3.utf8_decode (" Telèfono ").$datoofi4.utf8_decode (", el dìa ").$fecha_2." a las ".$parte2.", con el fin de asistir a la audiencia de ".$parte4." solicitada por ".$parte5.", y programada por este Centro de Servicios Judiciales dentro del proceso de referencia.",$fontStyleB, $paraStyleB2);

            $section->addTextBreak(1);

            $section->addText(utf8_decode ("Deberà informar de manera inmediata a esta Dependencia si serà representado por un Defensor de Confianza, de lo contrario se le designarà uno Pùblico. Se solicita asistir treinta (30) minutos antes de la hora fijada. Su no comparecencia le acarrearà las sanciones de ley."),$fontStyleB4, $paraStyleB4);


            $section->addTextBreak(1);

            $section->addText("Cordialmente,",$fontStyleB4, $paraStyleB4);

            $section->addTextBreak(2);

            $section->addText("COORDINADOR (E)",$fontStyleB4, $paraStyleB4);
            $section->addText(strtoupper($datoofi6),$fontStyleB4, $paraStyleB4);
            $section->addText("C.Ss.J. - Manizales",$fontStyleB4, $paraStyleB4);

            //rayas
            $section->addImage('views/images/rayas.jpg', array('width'=>699, 'height'=>29, 'align'=>'center'));

            $section->addText("En la fecha ___ del mes de __________ ".date('Y').utf8_decode (", se notificò personalmente, enterado(a)"),$fontStyleB4, $paraStyleB4);

            $section->addTextBreak(1);
		
            //-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
            $conttabla = 0;

            while($conttabla < 5){

                if($conttabla == 0){$campofila = "Firma: ";                $campofila2 = "___________________________________";}
                if($conttabla == 1){$campofila = "Nombre: ";               $campofila2 = "___________________________________";}
                if($conttabla == 2){$campofila = utf8_decode ("Telèfono, Parentesco: "); $campofila2 = "___________________________________ ___________________________________";}
                if($conttabla == 3){$campofila = " "; $campofila2 = " ";}
                if($conttabla == 4){$campofila = "Citador: "; $campofila2 = $datos8B;}


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
	
	//Citacion a Victima
	//FECHA://////HORA://////INDICIADO://////CON EL FIN DE ASISITIR A LA AUDIENCIA://////FISCALIA://////VICTIMA:
	if($datos0c == 2){
	
		$datospartesB = explode("//////",$datospartes);
		
		//FECHA
		//$parte1       = $datospartesB[1];
		//HORA
		//$parte2       = $datospartesB[2];
		
		$parte1       = $datos12;
		$date         = date_create($datos13);
		$parte2       = date_format($date, 'g:i A');
		
		$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];
		
		
		//$parte9       = $datospartesB[9];
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		//OBTENEMOS LA FECHA ACTUAL
		$fechaactual  = $data->get_fecha_actual_amd();
		
		$fecha = strftime('%d de %B %Y', strtotime($fechaactual));  
		$section->addText(ucwords("Manizales, ".$fecha),$fontStyleB, $paraStyleB2);
		
		$fecha_2 = strftime('%d de %B %Y', strtotime($parte1));  
		//$section->addText(ucwords("Manizales, ".$fecha_2),$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText($datos2,$fontStyleB, $paraStyleB2);
		
		$section->addText($parte6." (Victima)",$fontStyleB4, $paraStyleB4);
		
		$section->addText($datos4,$fontStyleB, $paraStyleB2);
		$section->addText("CELULAR-TELEFONO. ".$datos4B,$fontStyleB, $paraStyleB2);
		$section->addText($datos5,$fontStyleB, $paraStyleB2);
		
	
		$section->addText(utf8_decode ("CITACIÒN JUDICIAL: ").$datos1, $fontStyleA, $paraStyleA2);
		$section->addText("REF.: Proceso: ".$dator2." seguido en contra de ".$parte3.", por el delito de, ".$dator10.".",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText(utf8_decode ("De manera respetuosa me permito solicitarle, se digne hacer presentaciòn personal ante este ".$datoofi3." Telèfono ".$datoofi4.", el dìa ".$fecha_2." a las ".$parte2.", con el fin de asistir a la audiencia de ".$parte4." solicitada por ".$parte5.", y programada por este Centro de Servicios Judiciales dentro del proceso de referencia. Se solicita asistir treinta (30) minutos antes de la hora fijada."),$fontStyleB, $paraStyleB2);
		
		//$section->addTextBreak(1);
		
		$section->addText(utf8_decode ("IMPORTANTE: Tiene derecho a nombrar un APODERADO que lo(a) asista, ò en su defecto podrà solicitarle a la Fiscalìa la designaciòn de un Profesional del Derecho o estudiante de Consultorio Jurìdico."),$fontStyleB4, $paraStyleB4);
		
		
		$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleB4, $paraStyleB4);
		
		$section->addTextBreak(1);
		
		$section->addText("COORDINADOR (E)",$fontStyleB4, $paraStyleB4);
		$section->addText(strtoupper($datoofi6),$fontStyleB4, $paraStyleB4);
		$section->addText("C.Ss.J. - Manizales",$fontStyleB4, $paraStyleB4);
		
		//rayas
		$section->addImage('views/images/rayas.jpg', array('width'=>699, 'height'=>29, 'align'=>'center'));
		
		$section->addText(utf8_decode ("En la fecha ___ del mes de __________ ").date('Y').", se notificò personalmente, enterado(a)",$fontStyleB4, $paraStyleB4);
		
		$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 5){
			

			if($conttabla == 0){$campofila = "Firma: ";                $campofila2 = "___________________________________";}
			if($conttabla == 1){$campofila = "Nombre: ";               $campofila2 = "___________________________________";}
			if($conttabla == 2){$campofila = utf8_decode ("Telèfono, Parentesco: "); $campofila2 = "___________________________________ ___________________________________";}
			if($conttabla == 3){$campofila = " "; $campofila2 = " ";}
			if($conttabla == 4){$campofila = "Citador: "; $campofila2 = $datos8B;}
			
	
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
	
	//Citacion a Defensor
	//FECHA://////HORA://////INDICIADO://////CON EL FIN DE ASISITIR A LA AUDIENCIA://////FISCALIA://////DEFENSOR://////DIRECCION://////TELEFONO://////CIUDAD:
	if($datos0c == 6){
	 
		$datospartesB = explode("//////",$datospartes);
		
		//FECHA
		//$parte1       = $datospartesB[1];
		//HORA
		//$parte2       = $datospartesB[2];
		
		$parte1       = $datos12;
		$date         = date_create($datos13);
		$parte2       = date_format($date, 'g:i A');
		
		$parte3 = $datospartesB[3];
		$parte4 = $datospartesB[4];
		$parte5 = $datospartesB[5];
		$parte6 = $datospartesB[6];
		$parte7 = $datospartesB[7];
		$parte8 = $datospartesB[8];
		$parte9 = $datospartesB[9];
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		//OBTENEMOS LA FECHA ACTUAL
		$fechaactual  = $data->get_fecha_actual_amd();
		
		$fecha = strftime('%d de %B %Y', strtotime($fechaactual));  
		$section->addText(ucwords("Manizales, ".$fecha),$fontStyleB, $paraStyleB2);
		
		$fecha_2 = strftime('%d de %B %Y', strtotime($parte1));  
		//$section->addText(ucwords("Manizales, ".$fecha_2),$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText($datos2,$fontStyleB, $paraStyleB2);
		
		$section->addText(trim($parte6,",")." (Defensor)",$fontStyleB4, $paraStyleB4);
		
		$section->addText($parte7,$fontStyleB, $paraStyleB2);
		$section->addText("CELULAR-TELEFONO. ".$parte8,$fontStyleB, $paraStyleB2);
		$section->addText($parte9,$fontStyleB, $paraStyleB2);
		
	
		$section->addText(utf8_decode ("CITACIÒN JUDICIAL: ").$datos1, $fontStyleA, $paraStyleA2);
		$section->addText("REF.: Proceso: ".$dator2." seguido en contra de ".$parte3.", por el delito de, ".$dator10.".",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText(utf8_decode ("De manera respetuosa me permito solicitarle, se digne hacer presentaciòn personal ante este ").$datoofi3.utf8_decode (" Telèfono ").$datoofi4.utf8_decode (", el dìa ").$fecha_2." a las ".$parte2.", con el fin de asistir a la audiencia de ".$parte4." solicitada por ".$parte5.", y programada por este Centro de Servicios Judiciales dentro del proceso de referencia. Se solicita asistir treinta (30) minutos antes de la hora fijada.",$fontStyleB, $paraStyleB2);
		
		//$section->addTextBreak(1);
		
		$section->addText(utf8_decode ("IMPORTANTE: Tiene derecho a nombrar un APODERADO que lo(a) asista, ò en su defecto podrà solicitarle a la Fiscalìa la designaciòn de un Profesional del Derecho o estudiante de Consultorio Jurìdico."),$fontStyleB4, $paraStyleB4);
		
		
		$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleB4, $paraStyleB4);
		
		$section->addTextBreak(1);
		
		$section->addText("COORDINADOR (E)",$fontStyleB4, $paraStyleB4);
		$section->addText(strtoupper($datoofi6),$fontStyleB4, $paraStyleB4);
		$section->addText("C.Ss.J. - Manizales",$fontStyleB4, $paraStyleB4);
		
		//rayas
		$section->addImage('views/images/rayas.jpg', array('width'=>699, 'height'=>29, 'align'=>'center'));
		
		$section->addText("En la fecha ___ del mes de __________ ".date('Y').utf8_decode (", se notificò personalmente, enterado(a)"),$fontStyleB4, $paraStyleB4);
		
		$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 5){
			
			if($conttabla == 0){$campofila = "Firma: ";                $campofila2 = "___________________________________";}
			if($conttabla == 1){$campofila = "Nombre: ";               $campofila2 = "___________________________________";}
			if($conttabla == 2){$campofila = utf8_decode ("Telèfono, Parentesco: "); $campofila2 = "___________________________________ ___________________________________";}
			if($conttabla == 3){$campofila = " "; $campofila2 = " ";}
			if($conttabla == 4){$campofila = "Citador: "; $campofila2 = $datos8B;}
			
	
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
	
	//Citacion a Ministerio Publico
	//FECHA://////HORA://////INDICIADO://////CON EL FIN DE ASISITIR A LA AUDIENCIA://////FISCALIA://////DEFENSOR://////DIRECCION://////TELEFONO://////CIUDAD:
	if($datos0c == 7){
	    
		$datospartesB = explode("//////",$datospartes);
		
		//FECHA
		//$parte1       = $datospartesB[1];
		//HORA
		//$parte2       = $datospartesB[2];
		
		$parte1       = $datos12;
		$date         = date_create($datos13);
		$parte2       = date_format($date, 'g:i A');
		
		$parte3 = $datospartesB[3];
		$parte4 = $datospartesB[4];
		$parte5 = $datospartesB[5];
		$parte6 = $datospartesB[6];
		$parte7 = $datospartesB[7];
		$parte8 = $datospartesB[8];
		$parte9 = $datospartesB[9];
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		//OBTENEMOS LA FECHA ACTUAL
		$fechaactual  = $data->get_fecha_actual_amd();
		
		$fecha = strftime('%d de %B %Y', strtotime($fechaactual));  
		$section->addText(ucwords("Manizales, ".$fecha),$fontStyleB, $paraStyleB2);
		
		$fecha_2 = strftime('%d de %B %Y', strtotime($parte1));  
		//$section->addText(ucwords("Manizales, ".$fecha_2),$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText($datos2,$fontStyleB, $paraStyleB2);
		
		$section->addText(trim($parte6,",").utf8_decode (" (Ministerio Pùblico)"),$fontStyleB4, $paraStyleB4);
		
		$section->addText($parte7,$fontStyleB, $paraStyleB2);
		$section->addText("CELULAR-TELEFONO. ".$parte8,$fontStyleB, $paraStyleB2);
		$section->addText($parte9,$fontStyleB, $paraStyleB2);
		
	
		$section->addText(utf8_decode ("CITACIÒN JUDICIAL: ").$datos1, $fontStyleA, $paraStyleA2);
		$section->addText("REF.: Proceso: ".$dator2." seguido en contra de ".$parte3.", por el delito de, ".$dator10.".",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText(utf8_decode ("De manera respetuosa me permito solicitarle, se digne hacer presentaciòn personal ante este ").$datoofi3.utf8_decode (" Telèfono ").$datoofi4.utf8_decode (", el dìa ").$fecha_2." a las ".$parte2.", con el fin de asistir a la audiencia de ".$parte4." solicitada por ".$parte5.", y programada por este Centro de Servicios Judiciales dentro del proceso de referencia. Se solicita asistir treinta (30) minutos antes de la hora fijada.",$fontStyleB, $paraStyleB2);
		
		//$section->addTextBreak(1);
		
		$section->addText(utf8_decode ("IMPORTANTE: Tiene derecho a nombrar un APODERADO que lo(a) asista, o en su defecto podrà solicitarle a la Fiscalìa la designaciòn de un Profesional del Derecho o estudiante de Consultorio Jurìdico."),$fontStyleB4, $paraStyleB4);
		
		
		$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleB4, $paraStyleB4);
		
		$section->addTextBreak(1);
		
		$section->addText("COORDINADOR (E)",$fontStyleB4, $paraStyleB4);
		$section->addText(strtoupper($datoofi6),$fontStyleB4, $paraStyleB4);
		$section->addText("C.Ss.J. - Manizales",$fontStyleB4, $paraStyleB4);
		
		//rayas
		$section->addImage('views/images/rayas.jpg', array('width'=>699, 'height'=>29, 'align'=>'center'));
		
		$section->addText("En la fecha ___ del mes de __________ ".date('Y').utf8_decode (", se notificò personalmente, enterado(a)"),$fontStyleB4, $paraStyleB4);
		
		$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 5){
			
                    if($conttabla == 0){$campofila = "Firma: ";                $campofila2 = "___________________________________";}
                    if($conttabla == 1){$campofila = "Nombre: ";               $campofila2 = "___________________________________";}
                    if($conttabla == 2){$campofila = utf8_decode ("Telèfono, Parentesco: "); $campofila2 = "___________________________________ ___________________________________";}
                    if($conttabla == 3){$campofila = " "; $campofila2 = " ";}
                    if($conttabla == 4){$campofila = "Citador: "; $campofila2 = $datos8B;}

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
	
	//Informe de Citaduria
	if($datos0c == 5){
	
	    
		$datospartesB = explode("//////",$datospartes);
		$parte0       = $datospartesB[0];
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];
		$parte7       = $datospartesB[7];
		$parte8       = $datospartesB[8];
		$parte9       = $datospartesB[9];
		
		
		$section->addText("INFORME DE NOTIFICACION", $fontStyleA, $paraStyleA2);
		$section->addText("Informe Nro. : ".$datos1, $fontStyleJ, $paraStyleJ2);
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		//OBTENEMOS LA FECHA ACTUAL
		$fechaactual  = $data->get_fecha_actual_amd();
		
		$fecha = strftime('%d de %B %Y', strtotime($fechaactual));  
		$section->addText(ucwords("Manizales, ".$fecha),$fontStyleB, $paraStyleB2);
		
		$fecha_2 = strftime('%d de %B %Y', strtotime($parte1));  
		//$section->addText(ucwords("Manizales, ".$fecha_2),$fontStyleB, $paraStyleB2);
		
		$fecha_2b = strftime('%d de %B %Y', strtotime($parte6));  
		
		$section->addTextBreak(1);
		
		$section->addText(utf8_decode ("El dìa ").$fecha_2b.utf8_decode (", en virtud de mi funciòn de notificador me traslade a la direcciòn ").$datos4.", con el fin de realizar la diligencia de notificar al ".$datos2." ".$datos3." (".$des_tipo_parte.utf8_decode (") con telèfono Nro. ").$datos4B." el siguiente documento:",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText("TIPO Y NUMERO DE DOCUMENTO",$fontStyleB4, $paraStyleB4);
		
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;

		while($conttabla < 5){
                    if($conttabla == 0){$campofila = "Documento: ";                        $campofila2 = $parte8;}
                    if($conttabla == 1){$campofila = "Tipo de Documento: ";                $campofila2 = $parte9;}
                    if($conttabla == 2){$campofila = "Nro. de Referencia del Documento: "; $campofila2 = $parte7;}
                    if($conttabla == 3){$campofila = "Radicado del Proceso: ";             $campofila2 = $dator2;}
                    if($conttabla == 4){$campofila = "Fecha / Hora de Audiencia: ";        $campofila2 = $parte1." / ".$parte2;}

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
                    $table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleK, $paraStyleK2);
                    $table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleK, $paraStyleK2);

                    $conttabla = $conttabla + 1;
		}
		
		$section->addTextBreak(1);

		$section->addText("MOTIVO DE DEVOLUCION",$fontStyleB4, $paraStyleB4);
		
		$section->addText($datos6,$fontStyleB, $paraStyleB2);
		
		$section->addText(utf8_decode ("ASUNTO: (Sìrvase hacer un relato detallado del motivo por el cual no pudo efectuar la notificaciòn, para verificar dicha informaciòn):"),$fontStyleB4, $paraStyleB4);
		
		$section->addText($datos7,$fontStyleB, $paraStyleB2);
		
		$section->addText("El anterior informe lo realizo bajo gravedad del juramento.",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText(strtoupper($datos8B),$fontStyleB4, $paraStyleB4);
		$section->addText("Notificador",$fontStyleB4, $paraStyleB4);
		$section->addText("C.Ss.J. - Manizales",$fontStyleB4, $paraStyleB4);
		
		//rayas
		$section->addImage('views/images/rayas.jpg', array('width'=>699, 'height'=>29, 'align'=>'center'));
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;			
		while($conttabla < 4){

                    if($conttabla == 0){$campofila = "Firma: ";                $campofila2 = "___________________________________";}
                    if($conttabla == 1){$campofila = "Nombre de quien recibe y verifica: ";               $campofila2 = "___________________________________";}
                    if($conttabla == 2){$campofila = "Despacho Judicial: "; $campofila2 = "___________________________________ ___________________________________";}
                    if($conttabla == 3){$campofila = "Fecha Y Hora:"; $campofila2 = "___________________________________";}

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
	
	//************************************************EXHORTO*********************************************************************
	
	//Exhorto Indiciado
	if($datos0c == 3){
	
	    
		$datospartesB = explode("//////",$datospartes);
		$parte0       = $datospartesB[0];
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];
		//$parte7       = $datospartesB[7];
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		//OBTENEMOS LA FECHA ACTUAL
		$fechaactual  = $data->get_fecha_actual_amd();
		
		$fecha = strftime('%d de %B %Y', strtotime($fechaactual));  
		//$section->addText(ucwords("Manizales, ".$fecha),$fontStyleB, $paraStyleB2);
		
		$fecha_2 = strftime('%d de %B %Y', strtotime($parte1));  
		//$section->addText(ucwords("Manizales, ".$fecha_2),$fontStyleB, $paraStyleB2);
		

		$section->addText("EXHORTO PENAL No. ".$datos1, $fontStyleA, $paraStyleA2);
		$section->addText("EL SUSCRITO COORDINADOR DEL CENTRO DE SERVICIOS JUDICIALES DE MANIZALES, CALDAS:",$fontStyleB3, $paraStyleB3);
		$section->addText("ATENTAMENTE EXHORTA AL:",$fontStyleB3, $paraStyleB3);
		$section->addText($parte6,$fontStyleB3, $paraStyleB3);
		$section->addText(utf8_decode ("Para que se digne ordenar a quien corresponda, hacer comparecer ante su despacho a la persona que a continuaciòn relaciono:"),$fontStyleB3, $paraStyleB3);
		
		$section->addTextBreak(1);
		
		$section->addText($datos2,$fontStyleB, $paraStyleB2);
		$section->addText($parte3." (Indiciado)",$fontStyleB4, $paraStyleB4);
		$section->addText($datos4,$fontStyleB, $paraStyleB2);
		$section->addText("CELULAR-TELEFONO. ".$datos4B,$fontStyleB, $paraStyleB2);
		$section->addText($datos5,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText(utf8_decode ("Con el fin de notificarle presentaciòn personal ante el ").$datoofi3.utf8_decode (" Telèfono ").$datoofi4.utf8_decode (", el dìa ").$fecha_2." a las ".$parte2.", que asista a la audiencia de ".$parte4.", en el proceso que se sigue en su contra por el delito ".$dator10.", radicado bajo el Nro.".$dator2.", solicitada por ".$parte5.utf8_decode (". Se le informarà que debe de comparecer con abogado defensor, de lo contrario èste Centro le designarà uno."),$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText(utf8_decode ("Se solicita comedidamente, que una vez cumplida la comisiòn, se confirme la notificaciòn del exhorto vìa fax a los nùmeros 8848427 - 8820333 o vìa telefònica al nùmero 8848426 e informe resultados obtenidos."),$fontStyleB4, $paraStyleB4);
		
		$section->addTextBreak(1);
		
		$section->addText(utf8_decode ("Para su pronto auxilio y devoluciòn, se libra el presente exhorto en la ciudad de Manizales, ").$fecha,$fontStyleB4, $paraStyleB4);
		
		
		/*$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleB4, $paraStyleB4);
		*/
		$section->addTextBreak(2);
		

		$section->addText(strtoupper($datoofi6), $fontStyleA, $paraStyleA2);
		$section->addText("COORDINADOR (E)",$fontStyleB3, $paraStyleB3);
		//$section->addText("C.Ss.J. - Manizales",$fontStyleB4, $paraStyleB4);
		
	
			
	}
	
	//Exhorto Victima, Defensor
	if($datos0c == 4){
	
	    
		$datospartesB = explode("//////",$datospartes);
		$parte0       = $datospartesB[0];
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];
		
		$parte7       = $datospartesB[7];
		$parte8       = $datospartesB[8];
		
		//$parte9       = $datospartesB[9];
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		//OBTENEMOS LA FECHA ACTUAL
		$fechaactual  = $data->get_fecha_actual_amd();
		
		$fecha = strftime('%d de %B %Y', strtotime($fechaactual));  
		//$section->addText(ucwords("Manizales, ".$fecha),$fontStyleB, $paraStyleB2);
		
		$fecha_2 = strftime('%d de %B %Y', strtotime($parte1));  
		//$section->addText(ucwords("Manizales, ".$fecha_2),$fontStyleB, $paraStyleB2);
		

		$section->addText("EXHORTO PENAL No. ".$datos1, $fontStyleA, $paraStyleA2);
		$section->addText("EL SUSCRITO COORDINADOR DEL CENTRO DE SERVICIOS JUDICIALES DE MANIZALES, CALDAS:",$fontStyleB3, $paraStyleB3);
		$section->addText("ATENTAMENTE EXHORTA AL:",$fontStyleB3, $paraStyleB3);
		$section->addText($parte6,$fontStyleB3, $paraStyleB3);
		$section->addText(utf8_decode ("Para que se digne ordenar a quien corresponda, hacer comparecer ante su despacho a la persona que a continuaciòn relaciono:"),$fontStyleB3, $paraStyleB3);
		
		$section->addTextBreak(1);
		
		$section->addText($datos2,$fontStyleB, $paraStyleB2);
		$section->addText($parte8." (".$parte7.")",$fontStyleB4, $paraStyleB4);
		$section->addText($datos4,$fontStyleB, $paraStyleB2);
		$section->addText("CELULAR-TELEFONO. ".$datos4B,$fontStyleB, $paraStyleB2);
		$section->addText($datos5,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText(utf8_decode ("Con el fin de notificarle presentaciòn personal ante el ").$datoofi3.utf8_decode (" Telèfono ").$datoofi4.utf8_decode (", el dìa ").$fecha_2." a las ".$parte2.", que asista a la audiencia de ".$parte4.", en el proceso que se sigue en contra de ".$parte3.", por el delito de ".$dator10.", radicado bajo el Nro.".$dator2." y solicitada por ".$parte5.".",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText(utf8_decode ("Se solicita comedidamente, que una vez cumplida la comisiòn, se confirme la notificaciòn del exhorto vìa fax a los nùmeros 8848427 - 8820333 o vìa telefònica al nùmero 8848426 e informe resultados obtenidos."),$fontStyleB4, $paraStyleB4);
		
		$section->addTextBreak(1);
		
		$section->addText(utf8_decode ("Para su pronto auxilio y devoluciòn, se libra el presente exhorto en la ciudad de Manizales, ").$fecha,$fontStyleB4, $paraStyleB4);
		
		
		/*$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleB4, $paraStyleB4);
		*/
		$section->addTextBreak(2);
		

		$section->addText(strtoupper($datoofi6), $fontStyleA, $paraStyleA2);
		$section->addText("COORDINADOR (E)",$fontStyleB3, $paraStyleB3);
		//$section->addText("C.Ss.J. - Manizales",$fontStyleB4, $paraStyleB4);
			
	}
	
	//************************************************FIN EXHORTO*********************************************************************
	
	//************************************************SOLICITUDES*********************************************************************
	
	//Solicitud de remision
	if($datos0c == 8){
	
	    
		$datospartesB = explode("//////",$datospartes);
		
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];
		$parte7       = $datospartesB[7];
		$parte8       = $datospartesB[8];
		
		$section->addText("BOLETA DE REMISION No. ".$datos1, $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		$section->addText("AUTORIDAD JUDICIAL: ".$datoofi1." (AREA PENAL)", $fontStyleL, $paraStyleL2);
		$section->addText(strtoupper($datoofi3), $fontStyleL, $paraStyleL2);
		$section->addText("TELEFONOS: ".strtoupper($datoofi4), $fontStyleL, $paraStyleL2);
		

		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		//OBTENEMOS LA FECHA ACTUAL
		$fechaactual  = $data->get_fecha_actual_amd();
		
		$fecha = strftime('%d de %B %Y', strtotime($fechaactual));  
		$section->addText(strtoupper("Manizales, ".$fecha),$fontStyleL, $paraStyleL2);
		
		$section->addTextBreak(1);
		
		$section->addText(utf8_decode ("SEÑOR(A) DIRECTOR(A) CARCEL: ").$parte1, $fontStyleL, $paraStyleL2);
		$section->addText(utf8_decode ("SIRVASE USTED REMITIR AL SEÑOR(A):"), $fontStyleL, $paraStyleL2);
		$section->addText($parte2, $fontStyleA, $paraStyleA2);
		$section->addText("C.C. ".$parte3, $fontStyleA, $paraStyleA2);
		$section->addText("RADICADO No.: ".$dator2, $fontStyleA, $paraStyleA2);
		$section->addText("CONDENADO(A) Y/O SINDICADO(A) POR LOS DELITOS DE: ", $fontStyleL, $paraStyleL2);
		$section->addText($dator10, $fontStyleA, $paraStyleA2);
		$section->addText("CON DESTINO: ", $fontStyleL, $paraStyleL2);
		$section->addText($parte4, $fontStyleA, $paraStyleA2);
		$section->addText("A FIN DE ATENDER DILIGENCIA DE: ", $fontStyleA, $paraStyleA2);
		$section->addText($parte5, $fontStyleA, $paraStyleA2);
		$section->addText("PROGRAMADA PARA EL DIA: ", $fontStyleL, $paraStyleL2);
		$section->addText($parte6, $fontStyleA, $paraStyleA2);
		$section->addText("SOLICITUD PRESENTADA POR: ", $fontStyleL, $paraStyleL2);
		$section->addText($parte7, $fontStyleA, $paraStyleA2);
		$section->addTextBreak(1);
		$section->addText(utf8_decode ("LA REMISIÒN DEBERÀ EFECTUARSE MANTENIENDO LAS MEDIDAS DE SEGURIDAD NECESARIAS Y EL INTERNO(A) REGRESARÀ AL ESTABLECIMIENTO PENITENCIARIO Y CARCELARIO UNA VEZ TERMINADA LA DILIGENCIA."), $fontStyleL, $paraStyleL2);
		$section->addTextBreak(1);
		$section->addText($datoofi7, $fontStyleA, $paraStyleA2);
		$section->addText("Juez Coordinador(a)", $fontStyleL, $paraStyleL2);
	
			
	}
	
	//Solicitud de remision con Visto Bueno
	if($datos0c == 9){
	
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
		$parte10      = $datospartesB[10];
		
		$section->addText("BOLETA DE REMISION No. ".$datos1, $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		$section->addText("AUTORIDAD JUDICIAL: ".$datoofi1." (AREA PENAL)", $fontStyleL, $paraStyleL2);
		$section->addText(strtoupper($datoofi3), $fontStyleL, $paraStyleL2);
		$section->addText("TELEFONOS: ".strtoupper($datoofi4), $fontStyleL, $paraStyleL2);
		

		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		//OBTENEMOS LA FECHA ACTUAL
		$fechaactual  = $data->get_fecha_actual_amd();
		
		$fecha = strftime('%d de %B %Y', strtotime($fechaactual));  
		$section->addText(strtoupper("Manizales, ".$fecha),$fontStyleL, $paraStyleL2);
		
		$section->addTextBreak(1);
		
		$section->addText(utf8_decode ("SEÑOR(A) DIRECTOR(A) CARCEL: ").$parte1, $fontStyleL, $paraStyleL2);
		$section->addText(utf8_decode ("SIRVASE USTED REMITIR AL SEÑOR(A):"), $fontStyleL, $paraStyleL2);
		$section->addText($parte2, $fontStyleA, $paraStyleA2);
		$section->addText("C.C. ".$parte3, $fontStyleA, $paraStyleA2);
		$section->addText("RADICADO No: ".$dator2, $fontStyleA, $paraStyleA2);
		$section->addText("CONDENADO(A) Y/O SINDICADO(A) POR LOS DELITOS DE: ", $fontStyleL, $paraStyleL2);
		$section->addText($dator10, $fontStyleA, $paraStyleA2);
		$section->addText("CON DESTINO: ", $fontStyleL, $paraStyleL2);
		$section->addText(strtoupper($datoofi3), $fontStyleL, $paraStyleL2);
		$section->addText("A FIN DE ATENDER DILIGENCIA DE: ", $fontStyleA, $paraStyleA2);
		$section->addText($parte5, $fontStyleA, $paraStyleA2);
		$section->addText("PROGRAMADA PARA EL DIA: ", $fontStyleL, $paraStyleL2);
		$section->addText($parte6, $fontStyleA, $paraStyleA2);
		$section->addText("SOLICITUD PRESENTADA POR: ", $fontStyleL, $paraStyleL2);
		$section->addText($parte7, $fontStyleA, $paraStyleA2);
		$section->addText(utf8_decode ("LA REMISIÒN DEBERÀ EFECTUARSE MANTENIENDO LAS MEDIDAS DE SEGURIDAD NECESARIAS Y EL INTERNO(A) REGRESARÀ AL ESTABLECIMIENTO PENITENCIARIO Y CARCELARIO UNA VEZ TERMINADA LA DILIGENCIA."), $fontStyleL, $paraStyleL2);
		$section->addTextBreak(1);
		$section->addText($datoofi7, $fontStyleA, $paraStyleA2);
		$section->addText("Juez Coordinador(a)", $fontStyleL, $paraStyleL2);
		$section->addTextBreak(1);
		$section->addText($parte8, $fontStyleA, $paraStyleA2);
		$section->addText($parte9, $fontStyleL, $paraStyleL2);
	
			
	}
	
	//************************************************ FIN SOLICITUD*********************************************************************
	
	//************************************************ AUXILIA COMISION*********************************************************************
	
	//Auxilia Comision
	if($datos0c == 10){
	
		$datospartesB = explode("//////",$datospartes);
		
		$parte1       = $datospartesB[1];
		$parte2       = $datospartesB[2];
		$parte3       = $datospartesB[3];
		$parte4       = $datospartesB[4];
		$parte5       = $datospartesB[5];
		$parte6       = $datospartesB[6];
		
		$parte7       = $datospartesB[7];
		$parte8       = $datospartesB[8];
		
		//$parte9       = $datospartesB[9];
		
		//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
		setlocale(LC_TIME, "Spanish");
		//OBTENEMOS LA FECHA ACTUAL
		$fechaactual  = $data->get_fecha_actual_amd();
		
		$fecha = strftime('%d de %B %Y', strtotime($fechaactual));  
		//$section->addText(ucwords("Manizales, ".$fecha),$fontStyleB, $paraStyleB2);
		
		$fecha_1 = strftime('%d de %B %Y', strtotime($parte2));  
		$fecha_2 = strftime('%d de %B %Y', strtotime($parte4));  
		//$section->addText(ucwords("Manizales, ".$fecha_2),$fontStyleB, $paraStyleB2);
		

		$section->addText("CONSTANCIA DE RECIBIDO NRO. ".$datos1, $fontStyleA, $paraStyleA2);
		
		$section->addText("La presente SOLICITUD DE CITACION OFICIO ".$parte1." de fecha ".$fecha_1.", procedente del ".$parte3.utf8_decode (", fue recibido en èste ").$datoofi1." el ".$fecha_2." a las ".$parte5.".",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText("Pasa a despacho para resolver.",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText(ucwords("Manizales, ".$fecha_2),$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText(strtoupper($datos8C),$fontStyleD, $paraStyleD2);
		$tipo_perfil = $_SESSION['tipo_perfil'];
		$section->addText($tipo_perfil,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText($datoofi1." DE LOS JUZGADOS PENALES", $fontStyleA, $paraStyleA2);
		$section->addText(ucwords("Manizales, ".$fecha_2),$fontStyleL, $paraStyleL2);
		
		$section->addTextBreak(1);
		
		$section->addText(utf8_decode ("AUXÌLIESE Y DEVUÉLVASE"), $fontStyleA, $paraStyleA2);
		
		$section->addTextBreak(1);
		
		$section->addText($parte6, $fontStyleA, $paraStyleA2);
		$section->addText($parte7, $fontStyleL, $paraStyleL2);
		
		$section->addTextBreak(1);
		
		$section->addText("SOLICITUD DE CITACION OFICIO ".$parte1." del ".$parte3,$fontStyleD, $paraStyleD2);
		
		$section->addTextBreak(1);
		
		$section->addText("NOTIFICACION PERSONAL:",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText("En la fecha notifico personalmente a:",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText("___________________________________",$fontStyleB4, $paraStyleB4);
		$section->addText($datos3,$fontStyleB4, $paraStyleB4);
		$section->addText($datos4,$fontStyleB, $paraStyleB2);
		$section->addText("CELULAR-TELEFONO. ".$datos4B,$fontStyleB, $paraStyleB2);
		$section->addText($datos5,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText("OBSERVACIONES: ".$parte8,$fontStyleB, $paraStyleB2);
		
		
	}
	
	//************************************************FIN AUXILIA COMISION*********************************************************************
	// ------------- JUAN ESTEBAN MUNERA BETANCUR --------------------------------------
	//CARATULA
	if($idcaratulaplantilla == 400){
            $datos0c = $idcaratulaplantilla;
		
            $error_transaccion   = 0; //variable para detectar error
            $error_transaccion_2 = 0; //variable para detectar error

            $datosbd   = $data->get_datos_basededatos(7);
            $datosbd_b = $datosbd->fetch();
            $datosbd_1 = $datosbd_b[ip];
            $datosbd_2 = $datosbd_b[bd];
            $datosbd_3 = $datosbd_b[usuario];
            $datosbd_4 = $datosbd_b[clave];

            $serverName = $datosbd_1; //serverName\instanceName
            $connectionInfo = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
            $conn = sqlsrv_connect( $serverName, $connectionInfo);

            if( $conn ) { 
                //echo "Conectado a la Base de Datoss.<br />"; 
            }
            else{ 
                echo "NO se puede conectar a la Base de Datoss.<br />";
                die( print_r( sqlsrv_errors(), true)); 
            }
	    // *************** CONSULTAS PARA LA PROCEDENCIA **********************
            // JUAN ESTEBAN MUNERA BETANCUR ---------------------------------------
            $sql_ciudad = (" SELECT [A065CODICIUD]
                                    ,[A065DESCCIUD]
                              FROM [ConsejoPN].[dbo].[T065BACIUDGENE]
                              WHERE [A065CODICIUD] = '$ciudad'"
                           );
           $sql_enti = (" SELECT [A051CODIENTI]
                                ,[A051DESCENTI]
                          FROM [ConsejoPN].[dbo].[T051BAENTIGENE]
                          WHERE [A051CODIENTI] = '$entidad'"
                        );
            $sql_espe = (" SELECT [A062CODIESPE]
                            ,[A062DESCESPE]
                           FROM [ConsejoPN].[dbo].[T062BAESPEGENE]
                           WHERE [A062CODIESPE] = '$especialidad'"
                        );
            
            $sql = ("SELECT t103.A103LLAVPROC,CONVERT(VARCHAR(10), t103.A103FECHPROC, 103) AS A103FECHPROC,t103.A103NOMBPONE,t103.A103CODINUMO,
                        t053.A053DESCCLAS,
                        t51.A051DESCENTI,
                        t62.A062DESCESPE,
                        t112.A112CODISUJE,t112.A112NUMESUJE,t112.A112NOMBSUJE,t112.A112IDENREPR,t112.A112NOMBREPR,
                        t056.A056DESCRECU,
                        t102.A102DIR1SUJE ,t102.A102DIR2SUJE 
                    FROM ((((((T103DAINFOPROC t103 LEFT JOIN T053BACLASGENE t053 ON t103.A103CODICLAS = t053.A053CODICLAS)
                    LEFT JOIN T051BAENTIGENE t51 ON t51.A051CODIENTI = t103.A103ENTIRADI)
                    LEFT JOIN T062BAESPEGENE t62 ON t62.A062CODIESPE = t103.A103ESPERADI)
                    LEFT JOIN T112DRSUJEPROC t112 ON t112.A112LLAVPROC = t103.A103LLAVPROC)
                    LEFT JOIN T056BARECUGENE t056 ON t056.A056CODIRECU = t103.A103CODIRECU)
                    LEFT JOIN T102DAINFOSUJE t102 ON t102.A102NUMESUJE = t112.A112NUMESUJE) 
                    WHERE A103LLAVPROC ='$idradicadocaratula'");
						
            $params = array();
            $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
            $stmt = sqlsrv_query( $conn, $sql , $params, $options );
            $stmt1 = sqlsrv_query( $conn, $sql_ciudad , $params, $options );
            $stmt2 = sqlsrv_query( $conn, $sql_enti , $params, $options );
            $stmt3 = sqlsrv_query( $conn, $sql_espe , $params, $options );
            
            $row_count = sqlsrv_num_rows( $stmt );
            if ($row_count === false){
                echo "Error in retrieveing row count. En Consulta";
            }else{
                while( $rs = sqlsrv_fetch_array( $stmt1)){
                    //$ciu_codi    = trim($rs['A065CODICIUD']);
                    $ciu_descri  = trim($rs['A065DESCCIUD']);
                }
                while( $rs = sqlsrv_fetch_array( $stmt2) ){
                    $enti_codigo   = trim($rs['A051CODIENTI']);
                    $enti_descri   = trim($rs['A051DESCENTI']);
                }
                while( $rs = sqlsrv_fetch_array( $stmt3) ){
                    $espe_descri   = trim($rs['A062DESCESPE']);
                }
                while( $row = sqlsrv_fetch_array( $stmt)){
                    $D1  = trim($row['A103LLAVPROC']);
                    $D2  = trim($row['A103FECHPROC']);
                    $D9  = trim($row['A103NOMBPONE']);
                    $D3  = trim($row['A053DESCCLAS']);
                    //$D4  = trim($row['A500NOMBBCO']);
                    //DESCRIPCION JUZGADO
                    //$D4  = trim($row['A051DESCENTI']);
                    $D4  = trim($row['A103NOMBPONE']);
                    //EJEMPLO:
                    //JUZGADO  001 LABORAL MUNICIPAL DE PEQUE�AS CAUSAS LABORAL
                    //$D4B = JUZGADO
                    //$D10 = 001
                    //$D11 = LABORAL
                    //$D4C = MUNICIPAL DE PEQUE�AS CAUSAS LABORAL
                    /*$longitud = strlen($D4);
                    for ($i=0; $i<=$longitud ;$i++){
                        //SE PREGUNTA SI ES ESPACIO EN BLANCO
                        if( ord($D4[$i]) == 32 ){
                            //OBTENEMOS LA CADENA HASTA DONDE ENCUENTRE EL PRIMER ESPACIO
                            $D4B = substr($D4, 0, $i + 1);
                            //OBTENEMOS LA CADENA DESPUES DEL PRIMER ESPACIO HASTA EL FINAL DE LA CADENA
                            $D4C = substr($D4, $i + 1, strlen($D4));
                            $i   = $longitud;
                        }
                    }*/
                    //CODIGO JUZGADO
                    $D10 = trim($row['A103CODINUMO']);
                    //DESCRIPCION ESPECIALIDAD
                    $D11 = trim($row['A062DESCESPE']);
                    //TIPO RECURSO
                    $D12 = trim($row['A056DESCRECU']); 
                    //NOMBRE COMPLETO JUZGADO
                    /*$D4  = " ";
                    $D4  = strtoupper($D4B." ".$D10." ".$D11." ".$D4C);*/
                    //DEMANDANTE
                    if(trim($row['A112CODISUJE'] == '0001')){	
                        //$D5  = number_format(trim($row['A112NUMESUJE']), 0, ' ', '.');
                        $D5  = trim($row['A112NUMESUJE']);
                        $D6  = trim($row['A112NOMBSUJE']);

                        $datosdemandantec .= $D5.", ";
                        $datosdemandanten .= $D6.", ";
                        //DIRECCIONES PARTE DEMANDATE
                        $datosdemandanteDIR_1 = trim($row['A102DIR1SUJE']).",".trim($row['A102DIR1SUJE']);
                        if(trim($row['A112NOMBREPR']) == "SIN APODERADO"){
                            $D5B = " ";
                            $D6B = " ";
                        }else{
                            //APODERADO
                            $D5B = number_format(trim($row['A112IDENREPR']), 0, ' ', '.');
                            $D6B = trim($row['A112NOMBREPR']);

                            //DIRECCIONES APODERADO DEMANDATE
                            $datosdemandanteDIR_3 = trim($row['A102DIR1SUJE']).",".trim($row['A102DIR1SUJE']);
                        }
                    }
                    //DEMANDADO
                    if(trim($row['A112CODISUJE'] == '0002')){
                        //$D7  = number_format(trim($row['A112NUMESUJE']), 0, ' ', '.');
                        $D7  = trim($row['A112NUMESUJE']);
                        $D8  = trim($row['A112NOMBSUJE']);

                        $datosdemandadoc .= $D7.", ";
                        $datosdemandadon .= $D8.", ";
                        //DIRECCIONES PARTE DEMANDADO
                        $datosdemandanteDIR_2 = trim($row['A102DIR1SUJE']).",".trim($row['A102DIR1SUJE']);
                        if(trim($row['A112NOMBREPR']) == "SIN APODERADO"){
                            $D7B = " ";
                            $D8B = " ";
                        }
                        else{
                            //APODERADO
                            $D7B = number_format(trim($row['A112IDENREPR']), 0, ' ', '.');
                            $D8B = trim($row['A112NOMBREPR']);

                            //DIRECCIONES APODERADO DEMANDADO
                            $datosdemandanteDIR_4 = trim($row['A102DIR1SUJE']).",".trim($row['A102DIR1SUJE']);
                        }
                    }		
                }//FIN WHILE		
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

            if($D1G == "00"){	
                $D13 = "PRIMERA INSTANCIA";
            }else{
                $D13 = "SEGUNDA INSTANCIA";
            }

            // JUAN ESTEBAN MUNERA BETANCUR 2018-08-21
            $header = $section->createHeader();
            $table  = $header->addTable();
            $table->addRow();
            $table->addCell(2000)->addImage('views/images/header_docs/hader_caratula_tribu.png', array('width'=>629, 'height'=>100, 'align'=>'center'));
		
            $section->addImage('views/images/logo_tribunalsuperior.jpg', array('width'=>600, 'height'=>63, 'align'=>'center'));

            //PARA PROBRAR SI TRAE INFORMACION CON EL RADICADO, YA QUE  EN LA VISTA
            //PARA GENERAR LAS CARATULAS EN LA TABLA DINAMICA SE LE DABA CLIC EN EL PRIMER REGISTRO
            //NUM ---> 1 Y NO CARGABA INFORMACION, Y $row_count = sqlsrv_num_rows( $stmt ); ERA IGUAL A CERO
            //ESTO SE CORRIGE USANDO TRIM A LA VARIABLE
            //$idradicadocaratula  = trim($_GET['idradicadocaratula']);

            //$section->addText($idradicadocaratula."******".$row_count,$fontStyleVAR, $paraStyleVAR);

            //$section->addImage('views/images/logo_consejo.png', array('width'=>72, 'height'=>93, 'align'=>'center'));
            //$section->addText('RAMA JUDICIAL DEL PODER P�BLICO	      CONSEJO SUPERIOR DE LA JUDICATURA	       DIRECCI�N EJECUTIVA ADMINISTRACI�N JUDICIAL        SECCIONAL MANIZALES',$fontStyleJUZ, $paraStyleJUZ);	    
            $section->addText(utf8_decode ('RAMA JUDICIAL DEL PODER PÚBLICO'),$fontStyleJUZ, $paraStyleJUZ);	    
            //$section->addText('TRIBUNAL SUPERIOR DEL DISTRITO JUDICIAL',$fontStyleJUZ, $paraStyleJUZ);	    
            $section->addText('SALA CIVIL FAMILIA',$fontStyleJUZ, $paraStyleJUZ);	    
            $section->addText('MANIZALES - CALDAS',$fontStyleJUZ, $paraStyleJUZ);	    

            $section->addText($D1,$fontStyleCRTULA, $paraStyleCRTULA);

            //$section->addTextBreak(1);
            $section->addText("MAGISTRADO (A) PONENTE:",$fontStyleJUZ, $paraStyleJUZ);
            $section->addText("CDNO:",$fontStyleJUZ_2, $paraStyleJUZ_2);
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
            //
            // ********************* JUAN ESTEBAN MUNERA BETANCUR **********************************
            // ------------------ # DESPACHO # ----------------
            if($num_despacho =='000'){
                $num_despacho="";
            }else{
                $num_despacho = $num_despacho;
            }
            // -----------------------------------------------//
            // ----------------------------------------------- PROCEDENCIA --------------------------------------------------------- //
            if($enti_codigo == 22){
                $procedencia = " ";
            }else if($enti_codigo == 31 || $enti_codigo == 32 || $enti_codigo == 33 || $enti_codigo ==40 || $enti_codigo ==41 || $enti_codigo ==43){
                $enti_descri = substr($enti_descri, 8,100);
                $procedencia = "Juzgado ".$num_despacho." ".$espe_descri." ".$enti_descri." de ".$ciu_descri;
            }else{
                $procedencia = $enti_descri." ".$num_despacho." ".$espe_descri." de ".$ciu_descri;
            }
            // ---------------------------------------------------------------------------------------------------------------------- //
            
            //-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
            $conttabla = 0;
            if($D13 == "SEGUNDA INSTANCIA"){
                while($conttabla < 18){
                    /*if($conttabla == 0){$campofila = "No. RADICACI�N: ";       $campofila2 =$D1;}*/
                    if($conttabla == 0){$campofila = "PROCEDENCIA: ";           $campofila2 =$procedencia;}
                    if($conttabla == 1){$campofila = "PROCESO: ";               $campofila2 =$D3;}
                    if($conttabla == 2){$campofila = "DEMANDANTE: ";            $campofila2 =$datosdemandanten;}
                    if($conttabla == 3){$campofila = utf8_decode("IDENTIFICACIÓN: ");        $campofila2 =$datosdemandantec;}
                    if($conttabla == 4){$campofila = utf8_decode("DIRECCIÓN: ");             $campofila2 =$datosdemandanteDIR_1;}
                    if($conttabla == 5){$campofila = "APODERADO: ";             $campofila2 =$D6B;}
                    if($conttabla == 6){$campofila = utf8_decode ("IDENTIFICACIÓN /T.P.: "); $campofila2 =$D5B;}
                    if($conttabla == 7){$campofila = utf8_decode("DIRECCIÒN: ");             $campofila2 =$datosdemandanteDIR_2;}
                    if($conttabla == 8){$campofila = "DEMANDADO: ";             $campofila2 =$datosdemandadon;}
                    if($conttabla == 9){$campofila = utf8_decode("NIT/IDENTIFICACIÓN: ");    $campofila2 =$datosdemandadoc;}
                    if($conttabla == 10){$campofila = utf8_decode("DIRECCIÓN: ");            $campofila2 =$datosdemandanteDIR_3;}
                    if($conttabla == 11){$campofila = "APODERADO: ";            $campofila2 =$D8B;}
                    if($conttabla == 12){$campofila = utf8_decode("IDENTIFICACIÓN /T.P.: "); $campofila2 =$D7B;}
                    if($conttabla == 13){$campofila = utf8_decode("DIRECCIÒN: ");            $campofila2 =$datosdemandanteDIR_4;}
                    if($conttabla == 14){$campofila = utf8_decode("FECHA RADICACIÓN: ");     $campofila2 =$D2;}
                    if($conttabla == 15){$campofila = "TIPO RECURSO: ";         $campofila2 =$D12;}
                    if($conttabla == 16){$campofila = "INSTANCIA: ";            $campofila2 =$D13;}
                    if($conttabla == 17){$campofila = "FECHA 1 INST: ";         $campofila2 =" ";}

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
            }else{
                while($conttabla < 17){			
                    /*if($conttabla == 0){$campofila = "No. RADICACI�N: ";       $campofila2 =$D1;}*/
                    //if($conttabla == 0){$campofila = "PROCEDENCIA: ";           $campofila2 =$enti_descri." ".$num_despacho." ".$espe_descri." de ".$ciu_descri;}
                    if($conttabla == 0){$campofila = "PROCEDENCIA: ";           $campofila2 =$procedencia;}
                    if($conttabla == 1){$campofila = "PROCESO: ";               $campofila2 =$D3;}
                    if($conttabla == 2){$campofila = "DEMANDANTE: ";            $campofila2 =$datosdemandanten;}
                    if($conttabla == 3){$campofila = utf8_decode("IDENTIFICACIÓN: ");        $campofila2 =$datosdemandantec;}
                    if($conttabla == 4){$campofila = utf8_decode("DIRECCIÓN: ");             $campofila2 =$datosdemandanteDIR_1;}
                    if($conttabla == 5){$campofila = "APODERADO: ";             $campofila2 =$D6B;}
                    if($conttabla == 6){$campofila = utf8_decode("IDENTIFICACIÓN /T.P.: ");  $campofila2 =$D5B;}
                    if($conttabla == 7){$campofila = utf8_decode("DIRECCIÒN: ");             $campofila2 =$datosdemandanteDIR_2;}
                    if($conttabla == 8){$campofila = "DEMANDADO: ";             $campofila2 =$datosdemandadon;}
                    if($conttabla == 9){$campofila = utf8_decode("NIT/IDENTIFICACIÓN: ");    $campofila2 =$datosdemandadoc;}
                    if($conttabla == 10){$campofila = utf8_decode("DIRECCIÓN: ");            $campofila2 =$datosdemandanteDIR_3;}
                    if($conttabla == 11){$campofila = "APODERADO: ";            $campofila2 =$D8B;}
                    if($conttabla == 12){$campofila = utf8_decode("IDENTIFICACIÓN /T.P.: "); $campofila2 =$D7B;}
                    if($conttabla == 13){$campofila = utf8_decode("DIRECCIÓN: ");            $campofila2 =$datosdemandanteDIR_4;}
                    if($conttabla == 14){$campofila = utf8_decode("FECHA RADICACIÓN: ");     $campofila2 =$D2;}
                    if($conttabla == 15){$campofila = "TIPO RECURSO: ";         $campofila2 =$D12;}
                    if($conttabla == 16){$campofila = "INSTANCIA: ";            $campofila2 =$D13;}
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
            }
            $section->addTextBreak(1); 
            $section->addText("Caja: _____"."   "."No orden: _____"."   ".utf8_decode("Año de archivo: _____"),$fontStyleVAR, $paraStyleVAR);

            /*$section->addText("TOMO: _____"."   "."FOLIO: _____"."   "."CUADERNO: _____",$fontStyleVAR, $paraStyleVAR);
            $section->addTextBreak(1);*/
            $section->addText("OBSERVACIONES:",$fontStyleVAR, $paraStyleVAR);
            $section->addText("___________________________________________________________________________",$fontStyleB, $paraStyleB2);
            $section->addText("___________________________________________________________________________",$fontStyleB, $paraStyleB2);
            //$section->addText("_______________________________________________________________________",$fontStyleB, $paraStyleB2);


            //ADICIONA UNA NUEVA PAGINA
            //$section->addPageBreak();		
            //pie de pàgina
            $footer = $section->createFooter();
            $table  = $footer->addTable();
            $table->addRow();
            //$table->addCell(2000)->addImage('views/images/piepagina2.jpg', array('width'=>488, 'height'=>79, 'align'=>'right'));
            $table->addCell(2000)->addImage('views/images/header_docs/footer_caratula_tribu.png', array('width'=>620, 'height'=>70, 'align'=>'center'));	
	}
	//------------------------------------------------------------------------------------------------------------------------------
	if($datos0c != 400){
            //AYUDA A IDENTIFICAR EL ID DEL AUTO, PARA CUALQUIER CASO DE CORRECCION O INCONSISTENCIA
            //Y PERMITE SABER QUIEN ELABORO EL DOCUMENTO Y EL ACUERDO ESPECIFICO
            $section->addTextBreak(1);
            //$section->addText($iddoc,$fontStyleIDDOC, $paraStyleIDDOC2);
            //-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
            $conttabla = 0;
            while($conttabla < 1){
                if($conttabla == 0){$campofila = "(".$iddoc.utf8_decode(") Elaborò: ");      $campofila2 = $datos8C." ".$datos8." ".$datos8D;}
                //if($conttabla == 1){$campofila = $acuerdo;               $campofila2 = "";}
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
            $table->addCell(2000)->addImage('views/images/piepagina2.jpg', array('width'=>699, 'height'=>29, 'align'=>'right'));
            //$footer->addPreserveText('Carrera 23 N� 21-48- Palacio de Justicia "Fanny Gonz�lez Franco" Oficina 108 - Tel�fono 8879665 Manizales, Caldas',$fontStyle1, $fontStyle1);	
	}else{
            $datos1 = "CARATULA";
	}
	date_default_timezone_set('America/Bogota'); 
        $fecha_doc=date('Y-m-d');
	// Save File
	$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
	$objWriter->save('views/word/'.$datos1.'.doc');
	$file      = 'views/word/'.$datos1.'.docx';
	$id        = $datos1."_".$fecha_doc.'.docx';
	
	$enlace = $file; 
	$enlace = 'views/word/'.$datos1.'.doc'; 
	header ("Content-Disposition: attachment; filename=".$id); 
	header ("Content-Type: application/octet-stream");
	header ("Content-Length: ".filesize($enlace));
	readfile($enlace);	
    }
?>