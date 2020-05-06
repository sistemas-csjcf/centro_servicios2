<?php
    class Tutela{
        private $pdo;
        public $id;
        public $tut_radicado;
        public $Apellido;
        public $Sexo;
        public $FechaRegistro;
        public $FechaNacimiento;
        public $Foto;
        public $Correo;
	
        public function __CONSTRUCT(){
            try{
                $this->pdo = Database::Conectar();     
            }catch(Exception $e){
                die($e->getMessage());
            }
	}
	public function Listar(){
            try{
                date_default_timezone_set('America/Bogota'); 
                $fecha  = date('Y-m-d');
                //FECHAS PARA PRUEBAS
				//$fecha  = "2010-01-26";
				//$fecha  = "2018-05-18";
				//$fecha  = "2019-12-13";
				//$fecha  = "2019-12-16";
				//$fecha  = "2020-01-13";
				
                //$hoy    = $fecha." 00:00:00.000";
                $modelo = new Tutela();
                //JUSTICIA REAL
				$datosbd   = $modelo->get_datos_basededatos(7);//PARA CENTRO SERVICIOS CIVIL FAMILIA
				//$datosbd   = $modelo->get_datos_basededatos(8);//PARA OFICINA DE EJECUCION CIVIL MUNICIPAL
                $datosbd_b = $datosbd->fetch();
                $datosbd_1 = $datosbd_b[ip];
                $datosbd_2 = $datosbd_b[bd];
                $datosbd_3 = $datosbd_b[usuario];
                $datosbd_4 = $datosbd_b[clave];

                $serverName = $datosbd_1; //serverName\instanceName
                $connectionInfo = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
                $conn = sqlsrv_connect( $serverName, $connectionInfo);

                if( $conn === false ){
                    $error_transaccion = 1;
                    if( ($errors = sqlsrv_errors() ) != null){
                        foreach( $errors as $error ) {
                            echo "ERROR EN REGISTRO "."<br />";	
                            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                            echo "code: ".$error[ 'code']."<br />";
                            echo "message: ".$error[ 'message']."<br />";
                        }
                    }
                    echo "ENTRE 1";	
                }	
                //Iniciar la transacciòn.
                if ( sqlsrv_begin_transaction( $conn ) === false ) {
                    $error_transaccion = 1;
                    if( ($errors = sqlsrv_errors() ) != null) {
                        foreach( $errors as $error ){
                            echo "ERROR EN REGISTRO "."<br />";	
                            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                            echo "code: ".$error[ 'code']."<br />";
                            echo "message: ".$error[ 'message']."<br />";
                        }
                    }
                    echo "ENTRE 2";
                }
                //SQL ORIGINAL
				/*$sql = ("SELECT [A103LLAVPROC],[A103ANOTACTS],[A103FECHREPA],[A103CIUDRADI],[A103ENTIRADI],[A103ESPERADI],[A103NUENRADI],[A103CODIPROC],
                            [A103CODICLAS],[A103CODIPONE],[A103NOMBPONE] ,[A103HORAREPA]
                        FROM [$datosbd_2].[dbo].[T103DAINFOPROC]
                        WHERE [A103FECHREPA] =  convert(datetime, '$fecha', 121) 
                        AND [A103CODIPROC]= '3009' AND [A103CODICLAS]='0007'
                        AND [A103ENTIRADI] IN ('40','31') AND [A103ESPERADI] IN('03','10');");*/
				
				//SQL DE PRUEBA PARA TRAER REGISTROS DE TUTELAS PARA MIGRAR
				//POR ESO SE USAN LOS DOS FILTROS DE RANGO FECHAS Y RADICADO
				//PARA QUE SALGA INFORMACION Y PODER HACER PRUBEAS
				//SE QUITAN LOS FILTROS DE LA SQL YA QUE DE ESA FORMA QUEDARIA PARA 
				//LA PARTE DE PRODUCCION DEL MODULO
				//RANGO AND ([A103FECHREPA] >= '2014-01-01 00:00:00.000' AND [A103FECHREPA] <= '2014-12-01 00:00:00.000')		
				//[A103LLAVPROC] LIKE '%170013103%'
				$sql = ("SELECT 
				
				        [A103LLAVPROC],[A103ANOTACTS],[A103FECHREPA],[A103CIUDRADI],
						[A103ENTIRADI],[A103ESPERADI],[A103NUENRADI],[A103CODIPROC],
                        [A103CODICLAS],[A103CODIPONE],[A103NOMBPONE] ,[A103HORAREPA]
						
                        FROM [$datosbd_2].[dbo].[T103DAINFOPROC]
						
                        WHERE ([A103FECHREPA] >= convert(datetime, '$fecha', 121) AND [A103FECHREPA] <= convert(datetime, '$fecha', 121)) 
                        AND [A103CODIPROC]= '3009' AND [A103CODICLAS]='0007'
                        AND [A103ENTIRADI] IN ('40','31') AND [A103ESPERADI] IN('03','10');");
								
                $params     = array();
                $options    =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                $stmt       = sqlsrv_query( $conn, $sql , $params, $options );
                $row_count  = sqlsrv_num_rows( $stmt );
                while( $row = sqlsrv_fetch_array($stmt)){
                    $radi       = $row['A103LLAVPROC'];
                    $fecha      = date_format($row['A103FECHREPA'],'Y-m-d');
                    $hora       = $row['A103HORAREPA'];
                    $ponente    = $row['A103NOMBPONE'];
                    $despacho   = $row['A103CIUDRADI'].$row['A103ENTIRADI'].$row['A103ESPERADI'].$row['A103NUENRADI'];
                    
                    $cadenaR.= $radi."//////";
                    $cadenaF.= $fecha."---";
                    $cadenaH.= $hora."***";
                    $cadenaP.= $ponente."+++";
                    $cadenaD.= $despacho."****";
                }
                //echo $cadenaF;
                //echo $cadenaR;
                //return $cadenap;
                return array($cadenaR, $cadenaF, $cadenaH, $cadenaP,$cadenaD);
            }catch(Exception $e){
                die($e->getMessage());
            }
	}
        public function get_datos_filtro_tutela($fechad, $fechah){
            try{
                
                $modelo = new Tutela();
                //JUSTICIA REAL
                $datosbd   = $modelo->get_datos_basededatos(3);
                $datosbd_b = $datosbd->fetch();
                $datosbd_1 = $datosbd_b[ip];
                $datosbd_2 = $datosbd_b[bd];
                $datosbd_3 = $datosbd_b[usuario];
                $datosbd_4 = $datosbd_b[clave];

                $serverName = $datosbd_1; //serverName\instanceName
                $connectionInfo = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
                //$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"sa", "PWD"=>"M4nt3n1m13nt0");
                $conn = sqlsrv_connect( $serverName, $connectionInfo);

                if( $conn === false ){
                    $error_transaccion = 1;
                    if( ($errors = sqlsrv_errors() ) != null){
                        foreach( $errors as $error ) {
                            echo "ERROR EN REGISTRO "."<br />";	
                            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                            echo "code: ".$error[ 'code']."<br />";
                            echo "message: ".$error[ 'message']."<br />";
                        }
                    }
                    echo "ENTRE 1";	
                }
                if ( sqlsrv_begin_transaction( $conn ) === false ) {
                    $error_transaccion = 1;
                    if( ($errors = sqlsrv_errors() ) != null) {
                        foreach( $errors as $error ){
                            echo "ERROR EN REGISTRO "."<br />";	
                            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                            echo "code: ".$error[ 'code']."<br />";
                            echo "message: ".$error[ 'message']."<br />";
                        }
                    }
                    echo "ENTRE 2";
                }
                $sql = ("SELECT [A103LLAVPROC],[A103ANOTACTS],[A103FECHREPA],[A103CIUDRADI],[A103ENTIRADI],[A103ESPERADI],[A103NUENRADI],[A103CODIPROC],
                            [A103CODICLAS],[A103CODIPONE],[A103NOMBPONE] ,[A103HORAREPA]
                        FROM [$datosbd_2].[dbo].[T103DAINFOPROC]
                        WHERE ( [A103FECHREPA] >= convert(datetime, '$fechad' , 121) AND [A103FECHREPA] <= convert(datetime, '$fechah' , 121) )
                        AND [A103CODIPROC]= '3009' AND [A103CODICLAS]='0007'
                        AND [A103ENTIRADI] IN ('40','31') AND [A103ESPERADI] IN('03','10');");
                $params     = array();
                $options    =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                $stmt       = sqlsrv_query( $conn, $sql , $params, $options );
                $row_count  = sqlsrv_num_rows( $stmt );
                while( $row = sqlsrv_fetch_array($stmt)){
                    $radi       = $row['A103LLAVPROC'];
                    $fecha      = date_format($row['A103FECHREPA'],'Y-m-d');
                    $hora       = $row['A103HORAREPA'];
                    $ponente    = $row['A103NOMBPONE'];
                    $despacho   = $row['A103CIUDRADI'].$row['A103ENTIRADI'].$row['A103ESPERADI'].$row['A103NUENRADI'];
                    
                    $cadenaR.= $radi."//////";
                    $cadenaF.= $fecha."---";
                    $cadenaH.= $hora."***";
                    $cadenaP.= $ponente."+++";
                    $cadenaD.= $despacho."****";
                }
                return array($cadenaR, $cadenaF, $cadenaH, $cadenaP,$cadenaD);
            }catch(Exception $e){
                die($e->getMessage());
            }
	}
        //INFORMACION DE LA BASE DE DATOS, PARA SU CONEXION
	public function get_datos_basededatos($idbd){
            $listar     = $this->pdo->prepare("SELECT * FROM pa_base_datos WHERE id = ".$idbd);
            $listar->execute();
            return $listar;
  	}
        public function get_Juzgados_us($id){
            $listar     = $this->pdo->prepare("SELECT cod_juzgado FROM pa_juzgado WHERE idusuariojuzgado = ".$id);
            $listar->execute();
            return $listar;
  	}
	
        public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
            $listar = $this->pdo->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
            $listar->execute();
            return $listar;
	}
        public function get_lista_usuario_accionesJE($idaccion){
            $listar = $this->pdo->prepare("SELECT * FROM pa_usuario_acciones WHERE id = ".$idaccion." ORDER BY id ");
            $listar->execute();
            return $listar;
	}
        public function Migrar_tutela($radi,$flag_rtn){
            session_start();
            $idusuario  = $_SESSION['idUsuario'];
            $modelo = new Tutela();
            try {
                date_default_timezone_set('America/Bogota'); 
                $fecha  = date('Y-m-d');
                //$fecha = '2018-12-07';
                $num_diasT = 9;
                $arreglo_habiles = (($modelo->calcularFechasHabiles($num_diasT, $fecha))); 
                $fin = ($modelo->calcular_fecha_habil($arreglo_habiles[1],$arreglo_habiles[3]));                 
                $vuelta1 = ($modelo->calcular_fecha_habil($fin[1],$fin[3]));
                $vuelta2 = ($modelo->calcular_fecha_habil($vuelta1[1],$vuelta1[3]));
                $vuelta3 = ($modelo->calcular_fecha_habil($vuelta2[1],$vuelta2[3]));
                $vuelta4 = ($modelo->calcular_fecha_habil($vuelta3[1],$vuelta3[3]));
                $vuelta5 = ($modelo->calcular_fecha_habil($vuelta4[1],$vuelta4[3]));
                $vuelta6 = ($modelo->calcular_fecha_habil($vuelta5[1],$vuelta5[3]));
                $vuelta7 = ($modelo->calcular_fecha_habil($vuelta6[1],$vuelta6[3]));
                $vuelta8 = ($modelo->calcular_fecha_habil($vuelta7[1],$vuelta7[3]));
                $vuelta9 = ($modelo->calcular_fecha_habil($vuelta8[1],$vuelta8[3]));
                $vuelta10 = ($modelo->calcular_fecha_habil($vuelta9[1],$vuelta9[3]));
                $vuelta11 = ($modelo->calcular_fecha_habil($vuelta10[1],$vuelta10[3]));
                $vuelta12 = ($modelo->calcular_fecha_habil($vuelta11[1],$vuelta11[3]));
                $vuelta13 = ($modelo->calcular_fecha_habil($vuelta12[1],$vuelta12[3]));
                $vuelta14 = ($modelo->calcular_fecha_habil($vuelta13[1],$vuelta13[3]));
                $vuelta15 = ($modelo->calcular_fecha_habil($vuelta14[1],$vuelta14[3]));
                $vuelta16 = ($modelo->calcular_fecha_habil($vuelta15[1],$vuelta15[3]));
                $vuelta17 = ($modelo->calcular_fecha_habil($vuelta16[1],$vuelta16[3]));
                $vuelta18 = ($modelo->calcular_fecha_habil($vuelta17[1],$vuelta17[3]));
                
                $cant1      = count($arreglo_habiles[0]);
                $cant2      = count($fin[0]);
                $cant3      = count($vuelta1[0]);
                $cant4      = count($vuelta2[0]);
                $cant5      = count($vuelta3[0]);
                $cant6      = count($vuelta4[0]);
                $cant7      = count($vuelta5[0]);
                $cant8      = count($vuelta6[0]);
                $cant9      = count($vuelta7[0]);
                $cant10     = count($vuelta8[0]);
                $cant11     = count($vuelta9[0]);
                $cant12     = count($vuelta10[0]);
                $cant13     = count($vuelta11[0]);
                $cant14     = count($vuelta12[0]);
                $cant15     = count($vuelta13[0]);
                $cant16     = count($vuelta14[0]);
                $cant17     = count($vuelta15[0]);
                $cant18     = count($vuelta16[0]);
                $cant19     = count($vuelta17[0]);
                $cant20     = count($vuelta18[0]);
                $bandera    = 0;
                if($cant1 > 0){
                    if($arreglo_habiles[1]==0){
                        $dato = $arreglo_habiles[0];
                        $dato = array_pop($dato);
                        $bandera=1;
                        //echo "can1";
                    }
                }
                if($cant2 > 0){
                    if($fin[1]==0){
                        $dato = $fin[0];
                        $dato = array_pop($dato);
                        $bandera=1;
                        //echo "can2";
                    }
                }  
                if($cant3 >0){
                    if($vuelta1[1]==0){
                        $dato = $vuelta1[0];
                        $dato = array_pop($dato);
                        $bandera=1;
                        //echo "can3";
                    }
                }
                if($cant4 >0){
                    if($vuelta2[1]==0){
                        $dato = $vuelta2[0];
                        $dato = array_pop($dato);
                        $bandera=1;
                        //echo "can4";
                    }
                }
                if($cant5 >0){
                    if($vuelta3[1]==0){
                        $dato = $vuelta3[0];
                        $dato = array_pop($dato);
                        $bandera=1;
                        //echo "can5";
                    }
                }
                if($cant6 >0){
                    if($vuelta4[1]==0){
                        $dato = $vuelta4[0];
                        $dato = array_pop($dato);
                        $bandera=1;
                        //echo "can6";
                    }
                }
                if($cant7 >0){
                    if($vuelta5[1]==0){
                        $dato = $vuelta5[0];
                        $dato = array_pop($dato);
                        $bandera=1;
                        //echo "can7";
                    }
                }
                if($cant8 >0){
                    if($vuelta6[1]==0){
                        $dato = $vuelta6[0];
                        $dato = array_pop($dato);
                        $bandera=1;
                        //echo "can8";
                    }
                }
                if($cant9 >0){
                    if($vuelta7[1]==0){
                        $dato = $vuelta7[0];
                        $dato = array_pop($dato);
                        $bandera=1;
                        //echo "can9";
                    }
                }
                if($cant10 >0){
                    if($vuelta8[1]==0){
                        $dato = $vuelta8[0];
                        $dato = array_pop($dato);
                        $bandera=1;
                        //echo "can10";
                    }
                }
                if($cant11 >0){
                    if($vuelta9[1]==0){
                        $dato = $vuelta9[0];
                        $dato = array_pop($dato);
                        $bandera=1;
                        //echo "can11";
                    }
                }
                if($cant12 >0){
                    if($vuelta10[1]==0){
                        $dato = $vuelta10[0];
                        $dato = array_pop($dato);
                        $bandera=1;
                        //echo "can12";
                    }
                }
                if($cant13 >0){
                    if($vuelta11[1]==0){
                        $dato = $vuelta11[0];
                        $dato = array_pop($dato);
                        $bandera=1;
                        //echo "can13";
                    }
                }
                if($cant14 >0){
                    if($vuelta12[1]==0){
                        $dato = $vuelta12[0];
                        $dato = array_pop($dato);
                        $bandera=1;
                        //echo "can14";
                    }
                }
                if($cant15 >0){
                    if($vuelta13[1]==0){
                        $dato = $vuelta13[0];
                        $dato = array_pop($dato);
                        $bandera=1;
                        //echo "can15";
                    }
                }
                if($cant16 >0){
                    if($vuelta14[1]==0){
                        $dato = $vuelta14[0];
                        $dato = array_pop($dato);
                        $bandera=1;
                        //echo "can16";
                    }
                }
                if($cant17 >0){
                    if($vuelta15[1]==0){
                        $dato = $vuelta15[0];
                        $dato = array_pop($dato);
                        $bandera=1;
                        //echo "can17";
                    }
                }
                if($cant18 >0){
                    if($vuelta16[1]==0){
                        $dato = $vuelta16[0];
                        $dato = array_pop($dato);
                        $bandera=1;
                        //echo "can18";
                    }
                }
                if($cant19 >0){
                    if($vuelta17[1]==0){
                        $dato = $vuelta17[0];
                        $dato = array_pop($dato);
                        $bandera=1;
                        //echo "can19";
                    }
                }
                if($cant20 >0){
                    if($vuelta18[1]==0){
                        $dato = $vuelta18[0];
                        $dato = array_pop($dato);
                        $bandera=1;
                        //echo "can20";
                    }
                }
                //********* RESULTADO *************
                if($bandera==1){
                    $fecha_alerta = $dato;
                }else{
                    //echo "error";
                }
                //print_r($vuelta9);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();
                
                //JUSTICIA REAL
                $datosbd   = $modelo->get_datos_basededatos(7);
                $datosbd_b = $datosbd->fetch();
                $datosbd_1 = $datosbd_b[ip];
                $datosbd_2 = $datosbd_b[bd];
                $datosbd_3 = $datosbd_b[usuario];
                $datosbd_4 = $datosbd_b[clave];

                $serverName = $datosbd_1; //serverName\instanceName
                $connectionInfo = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
                //$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"sa", "PWD"=>"M4nt3n1m13nt0");
                $conn = sqlsrv_connect( $serverName, $connectionInfo);
 
                $sql = ("SELECT 
                        info_pro.[A103LLAVPROC]
                       ,info_pro.[A103CODIPONE]
                       ,info_pro.[A103NOMBPONE]
                       ,pro_clas.[A053DESCCLAS]
                       ,sub_clas.[A071DESCSUBC]
                       ,info_pro.[A103CIUDRADI]
                       ,info_pro.[A103ENTIRADI]
                       ,info_pro.[A103ESPERADI]
                       ,info_pro.[A103NUENRADI]
                       ,info_pro.[A103FECHREPA]
                       ,info_pro.[A103HORAREPA]
                    FROM [$datosbd_2].[dbo].[T103DAINFOPROC] AS info_pro
                    INNER JOIN [$datosbd_2].[dbo].[T053BACLASGENE] AS pro_clas
                    ON info_pro.[A103CODICLAS] = pro_clas.[A053CODICLAS]
                    INNER JOIN [$datosbd_2].[dbo].[T071BASUBCGENE] AS sub_clas
                    ON info_pro.[A103CODISUBC] = sub_clas.[A071CODISUBC]
                    WHERE info_pro.[A103LLAVPROC] = "."'$radi'".";");
                $params  = array();
                $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                while( $row = sqlsrv_fetch_array( $stmt)){
                    $codi_ponente       = $row['A103CODIPONE'];
                    $ponente            = htmlentities($row['A103NOMBPONE']);
                    $clase_proceso      = htmlentities($row['A053DESCCLAS']);
                    $subclase_proceso   = htmlentities($row['A071DESCSUBC']);
                    $fecha_reparto      = date_format($row['A103FECHREPA'],'Y-m-d');
                    $hora_reparto       = $row['A103HORAREPA'];
                    $despacho_tutela    = $row['A103CIUDRADI'].$row['A103ENTIRADI'].$row['A103ESPERADI'].$row['A103NUENRADI'];
                }
                $sql_partes = ("SELECT 
                                info_suje.[A112LLAVPROC]
                                ,info_suje.[A112CODISUJE]
                                ,info_suje.[A112NUMESUJE]
                                ,info_suje.[A112NOMBSUJE]
                                ,tipo_suje.[A057CODISUJE]
                                ,tipo_suje.[A057DESCSUJE]
                            FROM [$datosbd_2].[dbo].[T112DRSUJEPROC] AS info_suje
                            INNER JOIN [$datosbd_2].[dbo].[T057BASUJEGENE] AS tipo_suje
                                ON info_suje.[A112CODISUJE] = tipo_suje.A057CODISUJE
                            WHERE info_suje.[A112LLAVPROC] = "."'$radi'".";");
    
                $stmt1 = sqlsrv_query( $conn, $sql_partes , $params, $options ); 
				
				
				//ADICIONADO POR INGENIERO JORGE ANDRES VALENCIA OROZCO, 16 DE DICIEMBRE 2019
				//INCIDENTES EN DESACATO EN SALUD
					
				//CAPTURAR EL ID DE LA TABLA pa_juzgado, 
				//PARA SER INSERTADO EN LA TABLA correspondencia_tutelas
				$juzgados_1 = $modelo->listarJuzgados($despacho_tutela);
                $juzgados_2 = $juzgados_1->fetch();
                $idjuzgado  = $juzgados_2[id];
				
				//ADICIONADO POR INGENIERO JORGE ANDRES VALENCIA OROZCO, 14 DE ENERO 2020
				//SI YA FUE MIGRADO EL PROCESO
				$proc_1  = $modelo->get_proceso($radi);
                $proc_2  = $proc_1->fetch();
                $id_proc = $proc_2[id];
				
				if($id_proc >= 1){
				
					$flag = "3";
					$rTn  = "Lista_Migrar";
					
					
				}
				else{
				
					$this->pdo->exec("INSERT INTO correspondencia_tutelas (id_usuario,radicado,idjuzgado,fecha,Tutela_Incidente) 
									  VALUES ('$idusuario','$radi','$idjuzgado','$fecha','Tutela')");
					
					
					//OBTENGO EL ULTIMO ID DEL ISNERT ANTERIOR
					$lastIdRadicado  = $this->pdo->lastInsertId(); 
					
						
					//FIN INCIDENTES EN DESACATO EN SALUD
						
					while( $row = sqlsrv_fetch_array( $stmt1)){
					
					
						$parte_proceso[] = $row['A112NUMESUJE']."-".htmlentities($row['A112NOMBSUJE']).", ".htmlentities($row['A057DESCSUJE']."*");
						
						
						//ADICIONADO POR INGENIERO JORGE ANDRES VALENCIA OROZCO, 19 DE DICIEMBRE 2019
						//INCIDENTES EN DESACATO EN SALUD
						$nombreparte  = utf8_decode( trim(strtoupper($row['A112NOMBSUJE'])) );
						
						//ESTA PARTE ES PARA IDENTIFICAR EL TIPO DE LA PARTE
						//SE CIERRA $docdemandante,$nomdemandante,$docdemandado Y $nomdemandado
						//YA QUE DE ESA FORMA SE USA EN LA OFICINA DE EJECUCION CIVIL MUNICIPAL
						//PARA GRABAR LAS PARTES EN LA TABLA ubicacion_expediente
						//COLUMNAS demandante,cedula_demandante,demandado,cedula_demandado
						
						//DEMANDANTE - ACCIONANTE
						if($row['A112CODISUJE'] == '0001'){
						
							
							//$docdemandante .= $row['A112NUMESUJE']."/";
							//$nomdemandante .= htmlentities($row['A112NOMBSUJE'])."/";
							
							
							$tipo_parte = "Accionante";
						
						}
						//DEMANDADO - ACCIONADO
						if($row['A112CODISUJE'] == '0002'){
						
							
							//$docdemandado .= $row['A112NUMESUJE']."/";
							//$nomdemandado .= htmlentities($row['A112NOMBSUJE'])."/";
							
							
							$tipo_parte = "Accionado";
						
						}
						
		
						
						$this->pdo->exec("INSERT INTO accionante_accionado_vinculado (idcorrespondencia_tutelas,accionante_accionado_vinculado,esaccionante_accionado_vinculado) 
										  VALUES ('$lastIdRadicado','$nombreparte','$tipo_parte')");	
						
						
						//FIN INCIDENTES EN DESACATO EN SALUD				  
						
					}
					
					$datos_partes = implode("",$parte_proceso);
					//print_r ($parte_proceso);
					$this->pdo->exec("INSERT INTO `reparto_tutelas`(`tut_id_usuario`, `tut_id_despacho`, `tut_fecha`, `tut_radicado`, `tut_despacho`, 
										`tut_codi_ponente`, `tut_codi_despacho`, `tut_clase`, `tut_subclase`, `tut_partes`, `tut_fecha_reparto`, 
										`tut_hora_reparto`, `tut_fecha_vencimiento`, `tut_flag_vencimiento`) 
									VALUES  ('$idusuario',0,'$fecha','$radi','$ponente','$codi_ponente','$despacho_tutela','$clase_proceso','$subclase_proceso','$datos_partes','$fecha_reparto','$hora_reparto','$fecha_alerta',1)");
	
					//DATOS PARA EL REGISTRO DEL LOG
					$fechahora  = $modelo->get_fecha_actual();
					$datosfecha = explode(" ",$fechahora);
					$fechalog   = $datosfecha[0];
					$horalog    = $datosfecha[1];
					$tiporegistro = "MIGRACION TUTELA";
					$accion  = "Registra Una Nueva ".$tiporegistro." En el Sistema (REPARTO)";
					$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
					$tipolog = 13;
					$this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");			                        
					//SE TERMINA LA TRANSACCION  
					$this->pdo->commit();
					$flag="1";
					if($flag_rtn ==22){
						$rTn="Lista_MigrarD";
					}else{
						$rTn="Lista_Migrar";
					}
					
				
				}
				
				
            }catch(Exception $e){
                
				//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
                $this->pdo->rollBack();
                $flag = "2";
				$rTn  = "Lista_Migrar";
				
				
            }
			
			
					
            header('Location: ?c=Tutela&a='.$rTn.'&msg_di_tr='.$flag);
        }
		
		
		//ADICIONADO POR INGENIERO JORGE ANDRES VALENCIA OROZCO, 16 DE DICIEMBRE 2019
		//INCIDENTES EN DESACATO EN SALUD
		
		//CAPTURAR EL ID DE LA TABLA pa_juzgado, 
		//PARA SER INSERTADO EN LA TABLA correspondencia_tutelas
		public function listarJuzgados($despacho_tutela){
		
            $listar = $this->pdo->prepare("SELECT * FROM pa_juzgado 
			                               WHERE cod_juzgado = '$despacho_tutela'");
            $listar->execute();
            return $listar;
		
        }	
		
		//ADICIONADO POR INGENIERO JORGE ANDRES VALENCIA OROZCO, 14 DE ENERO 2020
		//CAPTURAR EL ID DE LA TABLA correspondencia_tutelas, DE RADICADO EN CUESTION 
		//PARA SABER SI EXISTE EL PROCESO
		public function get_proceso($radi){
		
            $listar = $this->pdo->prepare("SELECT * FROM correspondencia_tutelas 
			                               WHERE radicado = '$radi'");
            $listar->execute();
            return $listar;
		
        }					
					
		//FIN INCIDENTES EN DESACATO EN SALUD
		
		
		
		
        public function calendario_festivos(){
            date_default_timezone_set('America/Bogota'); 
            $año = date('Y');
            try{
                $listar = $this->pdo->prepare("SELECT * FROM `calendario_festivos`");
                $listar->execute();
                return $listar;
            } catch (Exception $e) {
                die($e->getMessage());
            } 
        }
        function calcularFechasHabiles($num_dias, $fechaInicial){
            $modelo     = new Tutela();
            $festivos  = $modelo->calendario_festivos();
            
            for ($i=0; $i<$num_dias; $i++){ 
                $Segundos = $Segundos + 86400;   
                $caduca = date("D",strtotime($fechaInicial)+$Segundos);
                if ($caduca == "Sat"){  
                    $i--;  
                    $FechaSab = date("Y-m-d",strtotime($fechaInicial)+$Segundos);
                }else if ($caduca == "Sun") {
                    $i--; 
                    $FechaDom = date("Y-m-d",strtotime($fechaInicial)+$Segundos);   
                }else{  
                    $FechaFinal = date("Y-m-d",strtotime($fechaInicial)+$Segundos);  
                    $fechas_totales_habiles[] = $FechaFinal;
                }
            }
            while($row = $festivos->fetch()){
                $array_festivos[] = $row['fes_fecha'];
            }
            foreach($fechas_totales_habiles as $valor){ 
                if(array_search($valor, $array_festivos) !== false){
                    $holiday [] = $valor;
                }else {
                    $arraglo_after_holiday_0 []= $valor; 
                } 
                $ultimaFecha = $valor;
            }
            $cantidad_festivos = count($holiday);
            $total = 9 - count($arraglo_after_holiday_0);
            return array($arraglo_after_holiday_0, $cantidad_festivos,$total, $ultimaFecha);
        }
        //JUAN ESTEBAN MUNERA BETANCUR
        //2018-02-09
        function calcular_fecha_habil($num_dias, $fechaInicial){
            $modelo    = new Tutela();
            $festivos  = $modelo->calendario_festivos();
            
            for ($i=0; $i<$num_dias; $i++){ 
                $Segundos = $Segundos + 86400;   
                $caduca = date("D",strtotime($fechaInicial)+$Segundos);
                if ($caduca == "Sat"){  
                    $i--;  
                    $FechaSab = date("Y-m-d",strtotime($fechaInicial)+$Segundos);
                }else if ($caduca == "Sun") {  
                    $i--; 
                    $FechaDom = date("Y-m-d",strtotime($fechaInicial)+$Segundos);   
                }else{  
                    $FechaFinal = date("Y-m-d",strtotime($fechaInicial)+$Segundos);  
                    $fechas_totales_habiles[] = $FechaFinal;
                }
            }
            while($row = $festivos->fetch()){
                $array_festivos[] = $row['fes_fecha'];
            }
            foreach($fechas_totales_habiles as $valor){
                if(array_search($valor, $array_festivos) !== false){
                    $holiday [] = $valor;
                }else {
                    $arraglo_after_holiday_0 []= $valor; 
                } 
                $ultimaFecha = $valor;
            }
            $cantidad_festivos = count($holiday);
            $total = $num_dias - count($arraglo_after_holiday_0);
            return array($arraglo_after_holiday_0, $cantidad_festivos,$total, $ultimaFecha);
        }
        public function get_fecha_actual(){
            date_default_timezone_set('America/Bogota'); 
            $fecharegistro=date('Y-m-d g:ia'); //FORMA PARA XP

            return $fecharegistro; 
	}
        public function displayAlert($text, $type, $icon) {
            echo "<div id='content' class='alert alert-$type'>
                <a href='#' class='close' data-dismiss='alert'>&times;</a>
                <strong>Nota Importante!</strong> $text
                <i class='icon-$icon'></i>
            </div>";

        }
        public function get_cod_Juzgados($id){
            $listar     = $this->pdo->prepare("SELECT cod_usuario_juzgado FROM pa_juzgado WHERE cod_juzgado = ".$id);
            $listar->execute();
            return $listar;
  	}
        public function get_lista_reparto_tutela($cod_juzgado){
            $listar = $this->pdo->prepare("SELECT tut_radicado FROM reparto_tutelas WHERE tut_codi_despacho = ".$cod_juzgado);
            $listar->execute();
            return $listar;
	}
        public function get_lista_reparto_tutelaCS(){
            $listar = $this->pdo->prepare("SELECT tut_radicado FROM reparto_tutelas ");
            $listar->execute();
            return $listar;
	}
        public function Listar_T_Despacho($entidad, $especialidad, $num_D){
            try{
                date_default_timezone_set('America/Bogota'); 
                $fecha  = date('Y-m-d');
                //$fecha  = "2018-05-18";
                $modelo = new Tutela();
                //JUSTICIA REAL
                //$datosbd   = $modelo->get_datos_basededatos(7);//PARA CENTRO SERVICIOS CIVIL FAMILIA
				$datosbd   = $modelo->get_datos_basededatos(8);//PARA OFICINA DE EJECUCION CIVIL MUNICIPAL
                $datosbd_b = $datosbd->fetch();
                $datosbd_1 = $datosbd_b[ip];
                $datosbd_2 = $datosbd_b[bd];
                $datosbd_3 = $datosbd_b[usuario];
                $datosbd_4 = $datosbd_b[clave];

                $serverName = $datosbd_1; //serverName\instanceName
                $connectionInfo = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
                $conn = sqlsrv_connect( $serverName, $connectionInfo);

                if( $conn === false ){
                    $error_transaccion = 1;
                    if( ($errors = sqlsrv_errors() ) != null){
                        foreach( $errors as $error ) {
                            echo "ERROR EN REGISTRO "."<br />";	
                            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                            echo "code: ".$error[ 'code']."<br />";
                            echo "message: ".$error[ 'message']."<br />";
                        }
                    }
                    echo "ENTRE 1";	
                }	
                //Iniciar la transacciòn.
                if ( sqlsrv_begin_transaction( $conn ) === false ) {
                    $error_transaccion = 1;
                    if( ($errors = sqlsrv_errors() ) != null) {
                        foreach( $errors as $error ){
                            echo "ERROR EN REGISTRO "."<br />";	
                            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                            echo "code: ".$error[ 'code']."<br />";
                            echo "message: ".$error[ 'message']."<br />";
                        }
                    }
                    echo "ENTRE 2";
                }
                $sql = ("SELECT [A103LLAVPROC],[A103ANOTACTS],[A103FECHREPA],[A103CIUDRADI],[A103ENTIRADI],[A103ESPERADI],[A103NUENRADI],[A103CODIPROC],
                            [A103CODICLAS],[A103CODIPONE],[A103NOMBPONE] ,[A103HORAREPA]
                        FROM [$datosbd_2].[dbo].[T103DAINFOPROC]
                        WHERE [A103FECHREPA] =  convert(datetime, '$fecha', 121) 
                        AND [A103CODIPROC]= '3009' AND [A103CODICLAS]='0007'
                        AND [A103CIUDRADI]= '17001'
                        AND [A103ENTIRADI]= '$entidad' AND [A103ESPERADI]= '$especialidad' 
                        AND [A103NUENRADI]= '$num_D';");
                $params     = array();
                $options    =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                $stmt       = sqlsrv_query( $conn, $sql , $params, $options );
                $row_count  = sqlsrv_num_rows( $stmt );
                while( $row = sqlsrv_fetch_array($stmt)){
                    $radi       = $row['A103LLAVPROC'];
                    $fecha      = date_format($row['A103FECHREPA'],'Y-m-d');
                    $hora       = $row['A103HORAREPA'];
                    $ponente    = $row['A103NOMBPONE'];
                    $despacho   = $row['A103CIUDRADI'].$row['A103ENTIRADI'].$row['A103ESPERADI'].$row['A103NUENRADI'];
                    
                    $cadenaR.= $radi."//////";
                    $cadenaF.= $fecha."---";
                    $cadenaH.= $hora."***";
                    $cadenaP.= $ponente."+++";
                    $cadenaD.= $despacho."****";
                }
                //echo $cadenaF;
                //echo $cadenaR;
                //return $cadenap;
                return array($cadenaR, $cadenaF, $cadenaH, $cadenaP,$cadenaD);
            }catch(Exception $e){
                die($e->getMessage());
            }
	}
        public function get_codigo_Despacho($id){
            $listar = $this->pdo->prepare("SELECT cod_juzgado FROM pa_juzgado WHERE cod_usuario_juzgado = ".$id);
            $listar->execute();
            return $listar;
  	}
        public function get_lista_Despacho(){
            $listar = $this->pdo->prepare("SELECT cod_juzgado,nombre FROM pa_juzgado");
            $listar->execute();
            return $listar;
        }
        //ALERTA TUTELAS
        public function alerta_tutela(){
            try{
                $stm = $this->pdo->prepare("SELECT * FROM reparto_tutelas WHERE tut_flag_vencimiento=1");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }catch(Exception $e){
                die($e->getMessage());
            }
        }
        public function alerta_tutelaD($cod_despacho){
            try{
                $stm = $this->pdo->prepare("SELECT * FROM reparto_tutelas WHERE tut_flag_vencimiento=1 AND tut_codi_despacho = '$cod_despacho'");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }catch(Exception $e){
                die($e->getMessage());
            }
        }
        public function alerta_tutelaD_limit($cod_despacho){
            try{
                $stm = $this->pdo->prepare("SELECT * FROM reparto_tutelas WHERE tut_codi_despacho = '$cod_despacho' ORDER BY tut_id DESC LIMIT 10");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }catch(Exception $e){
                die($e->getMessage());
            }
        }
        public function alerta_tutela_limit(){
            try{
                $stm = $this->pdo->prepare("SELECT * FROM reparto_tutelas ORDER BY tut_id DESC LIMIT 15");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function Registrar_Fallo($data){
            //session_start();
            $id_usuario = $_SESSION['idUsuario'];
            $modelo = new Tutela();
            //DATOS PARA EL REGISTRO DEL LOG
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            $tiporegistro = "Fecha Fallo Tutela";
            $accion  = "Registra Una Nueva ".$tiporegistro." En el Sistema (REPARTO - TUTELA)";
            $detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog = 13;
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();
                
                $sql = "UPDATE reparto_tutelas SET 
                    tut_flag_vencimiento = ?, 
                    tut_fecha_fallo = ?,
                    tut_id_usuario_falloE = ?,
                    tut_fechaE = ?
                    WHERE tut_id = ?";

                $this->pdo->prepare($sql)
                ->execute(
                    array( 
                        $data->flag_tutela,
                        $data->fecha_fallo,
                        $id_usuario,
                        $fechalog,
                        $data->id
                    )
                );
                $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$id_usuario','$tipolog')");			                        
                //SE TERMINA LA TRANSACCION  
                $this->pdo->commit();
            } catch (Exception $e) {
                die($e->getMessage());
                $this->pdo->rollBack();
            }
        }
    }