<?php
    class excelModel extends modelBase{
        /************************ Se obtiene un vector de telegramas *************************************
        ************************************ en una fecha ************************************/
	public function excel_saidoj(){	
            $anio   = $_GET['nombre1'];
            $juzgado = $_GET['nombre2'];
//LOCAL***********************************************
            $serverName = 'USER01238\SQLEXPRESS';  
            $bd='saidoj_local';
// REAL *********************************************            
           // $serverName = '192.168.89.23';
          //  $bd='saidoj';
            //$connectionInfo = array( "Database"=>$bd, "UID"=>"sa", "PWD"=>"3j3cut1V416");
            $connectionInfo = array( "Database"=>$bd);
            $conn = sqlsrv_connect( $serverName, $connectionInfo);
            $sql = "SELECT ex.id_juzgado AS codjuzgado,ex.descripcion AS observaciones,
                pr.codigo_antiguo ,pr.codigo_unico,cp.nombre AS proceso, ddo.documento AS doc_ddo,
                ddo.nombre AS nom_ddo,dte.documento AS doc_dte,dte.nombre AS nom_dte
                FROM EXPEDIENTE ex inner join PROCESO pr on (ex.id=pr.id)
                inner join CLASE_PROCESO cp on (cp.id=pr.id_clase_proc)
                inner join DEMANDADO ddo on (ddo.id_proceso=pr.id)
                inner join DEMANDANTE dte on (dte.id_proceso=pr.id)
                where  ex.id_juzgado='$juzgado' AND ex.observaciones like '%$anio%' ";

            $params = array();
            $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
            $stmt = sqlsrv_query( $conn, $sql , $params, $options );

            $row_count = sqlsrv_num_rows($stmt);
            $i=0;
            while( $row = sqlsrv_fetch_array( $stmt) ) {
                $vector[$i][codjuzgado] = $row['codjuzgado'];
                $vector[$i][observaciones] = $row['observaciones'];
                $vector[$i][codigo_antiguo] = $row['codigo_antiguo'];
                $vector[$i][codigo_unico] = $row['codigo_unico'];
                $vector[$i][clase] = $row['proceso'];
                $vector[$i][doc_ddo] = $row['doc_ddo'];
                $vector[$i][nom_ddo] = $row['nom_ddo'];
                $vector[$i][doc_dte] = $row['doc_dte'];
                $vector[$i][nom_dte] = $row['nom_dte'];	  
                $i++; 	  
            }
            //print_r($vector);
            return $vector; 	
	}
    }
    require ('views/PHPExcel-develop/Classes/PHPExcel.php');
    $t_reporte =$_GET['nombre']; 
    if($t_reporte==1){
        $data= new excelModel();
        $vector_datos= $data->excel_saidoj();
        //print_r($vector_datos);
        $objPHPExcel = new PHPExcel();
        $styleArray = array(
            'font' => array(
                'bold' => true
            )
        );
        $borders = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK,
                    'color' => array('argb' => 'FF000000'),
                )
            ),
        );
        $borders_nobold = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FF000000'),
                )
            ),
        );	
        expediente;

        $objPHPExcel->getActiveSheet()->mergeCells('A1:D1');
        $sheet1=$objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1',  utf8_encode('LISTA DE PROCESOS ARCHIVADOS EN EL APLICATIVO SAIDOJ CON DEMANDADO Y DEMANDANTE'))
        ->setCellValue('A5',  $_GET['nombre1'])
        ->setCellValue('A4',  ('AÑO'))
        ->setCellValue('B4',  ('CÓDIGO DEL JUZGADO'))
        ->setCellValue('A8',  ('Código Juzgado'))
        ->setCellValue('B8', 'Observaciones')
        ->setCellValue('C8', ('Código Antiguo'))
        ->setCellValue('D8', ('Código Unico'))
        ->setCellValue('E8', 'Proceso')
        ->setCellValue('F8', utf8_encode('Doc Demandado'))
        ->setCellValue('G8', utf8_encode('Nom Demandado'))
        ->setCellValue('H8', utf8_encode('Doc Demandante'))
        ->setCellValue('I8', utf8_encode('Nom Demandante'));

        $sheet1->getStyle('A1')->applyFromArray($styleArray);
        $sheet1->getStyle('A4')->applyFromArray($styleArray);
        $sheet1->getStyle('A5')->applyFromArray($styleArray);
        $sheet1->getStyle('B4')->applyFromArray($styleArray);
        $sheet1->getStyle('B5')->applyFromArray($styleArray);
        $sheet1->getStyle('A8')->applyFromArray($styleArray);
        $sheet1->getStyle('B8')->applyFromArray($styleArray);
        $sheet1->getStyle('C8')->applyFromArray($styleArray);
        $sheet1->getStyle('D8')->applyFromArray($styleArray);
        $sheet1->getStyle('E8')->applyFromArray($styleArray);
        $sheet1->getStyle('F8')->applyFromArray($styleArray);
        $sheet1->getStyle('G8')->applyFromArray($styleArray);
        $sheet1->getStyle('H8')->applyFromArray($styleArray);
        $sheet1->getStyle('I8')->applyFromArray($styleArray);

        $sheet1->getCell('B5')->setValueExplicit($_GET['nombre2'],PHPExcel_Cell_DataType::TYPE_STRING);
        $sheet1->getStyle('B5')->applyFromArray($styleArray);

        $sheet1->getStyle('A8:I8')->getFill()->applyFromArray(
            array(
                'type'       => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array('rgb' => '5A96C8'),
                'endcolor' => array('rgb' => 'white')
            )
        );
        $objPHPExcel->getActiveSheet()
        ->getStyle('A1:B4')
        ->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()
        ->getStyle('A2:B5')
        ->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $i=2;
        $cont = count($vector_datos);
        $j=0;
        $k=9;
        while($j < $cont){
            $sheet1->getCell('A'.$k)->setValueExplicit($vector_datos[$j][codjuzgado],PHPExcel_Cell_DataType::TYPE_STRING);
            $sheet1->getStyle('A'.$k)->applyFromArray($borders_nobold);

            $sheet1->setCellValue('B'.$k, utf8_encode($vector_datos[$j][observaciones]));
            $sheet1->getStyle('B'.$k)->applyFromArray($borders_nobold);

            $sheet1->getCell('C'.$k)->setValueExplicit($vector_datos[$j][codigo_antiguo],PHPExcel_Cell_DataType::TYPE_STRING);
            $sheet1->getStyle('C'.$k)->applyFromArray($borders_nobold);

            $sheet1->getCell('D'.$k)->setValueExplicit($vector_datos[$j][codigo_unico],PHPExcel_Cell_DataType::TYPE_STRING);
            $sheet1->getStyle('D'.$k)->applyFromArray($borders_nobold);

            $sheet1->setCellValue('E'.$k, utf8_encode($vector_datos[$j][clase]));
            $sheet1->getStyle('E'.$k)->applyFromArray($borders_nobold);

            $sheet1->setCellValue('F'.$k, utf8_encode($vector_datos[$j][doc_ddo]));
            $sheet1->getStyle('F'.$k)->applyFromArray($borders_nobold);

            $sheet1->setCellValue('G'.$k, utf8_encode($vector_datos[$j][nom_ddo]));
            $sheet1->getStyle('G'.$k)->applyFromArray($borders_nobold);

            $sheet1->setCellValue('H'.$k, utf8_encode($vector_datos[$j][doc_dte]));
            $sheet1->getStyle('H'.$k)->applyFromArray($borders_nobold);

            $sheet1->setCellValue('I'.$k, utf8_encode($vector_datos[$j][nom_dte]));
            $sheet1->getStyle('I'.$k)->applyFromArray($borders_nobold);
            $j++;
            $k++;
        }

        $objPHPExcel->getActiveSheet()->getStyle('A8:I8')->applyFromArray($borders);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize('true');
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize('true');
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize('true');

        $objPHPExcel->getActiveSheet()->setTitle('SAIDOJ');
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Saidoj.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }	   
?>