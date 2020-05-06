<?php

	require_once('../libs/Conexion_Funciones.php');
	
	include_once('Funciones.php');
	//instanciamos la clase Funciones.php con la variable $funcion
	$funcion = new Funciones();

	$cadena    = "";
	
	$valorradi = trim($_GET['valorradi']);
	
	$bandera   = 0;
	$retorno   = 0;
	
	$conexion  = db_connect();
	
	
	//SE REALIZA EL CAMBIO DE LA SQL, YA QUE LAS TUTELAS QUEDAN EN 
	//correspondencia_tutelas
	//ADICIONADO POR INGENIERO JORGE ANDRES VALENCIA OROZCO, 19 DE DICIEMBRE 2019
	//INCIDENTES EN DESACATO EN SALUD
	
	
	/*$sql = "SELECT * FROM correspondencia_tutelas
			WHERE radicado = '$valorradi'";*/
			
	
	//SE CAMBIA LA SQL PARA TRAER Y VISUALIZAR LAS PARTES DEL PROCESO
	////ADICIONADO POR INGENIERO JORGE ANDRES VALENCIA OROZCO, 21 DE ENERO 2020		
	$sql = "SELECT t1.id,t1.radicado,t2.id AS idparte,t2.accionante_accionado_vinculado,
			t2.esaccionante_accionado_vinculado,t3.nombre
			FROM ((correspondencia_tutelas t1
			INNER JOIN accionante_accionado_vinculado t2 ON t1.id = t2.idcorrespondencia_tutelas)
			INNER JOIN pa_juzgado t3 ON t1.idjuzgado = t3.id)
			WHERE t1.radicado = '$valorradi'";		

	
	$resultado = mysql_query($sql);
	
   	while($fila = mysql_fetch_array($resultado)){
	
		//echo $fila['numero'];
		
		$datos0  = $fila["id"];
		$datos1  = $fila["radicado"];
		$datos2  = $fila["idparte"];
		$datos3  = $fila["accionante_accionado_vinculado"];
		$datos4  = $fila["esaccionante_accionado_vinculado"];
		$datos5  = $fila["nombre"];
		
		$cadena .= $datos0."//////".$datos1."//////".$datos2."//////".$datos3."//////".$datos4."//////".$datos5."******";

		$bandera = 1;
   	}
	
	//echo trim($cadena."//////".$idaccion);
	
	//SE ENCUENTRA INFORMACION EN BASE DE DATOS LOCAL
	//YA FUE MIGRADA DESDE EL MODULO REPARTO, OPCION TUTELAS
	if($bandera == 1){
	
		echo trim(utf8_encode($cadena));
	}
	//BUSCA EN JUSTICIA XXI PARA MIGRAR LA INFORMACION
	else{
	
	
		 $datosbd   = $funcion->get_datos_basededatos(7);//CONEXION REAL A BD SQLSERVER CONSEJOPN 
		 //$datosbd_b = $datosbd->fetch();
		 $datosbd_b = explode("//////",$datosbd);
		 
		 $datosbd_1 = $datosbd_b[0];
		 $datosbd_2 = $datosbd_b[1];
		 $datosbd_3 = $datosbd_b[2];
		 $datosbd_4 = $datosbd_b[3];
		 
		 $serverName = $datosbd_1; //serverName\instanceName
		 $connectionInfo = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
		 $conn = sqlsrv_connect( $serverName, $connectionInfo);
		
		
		 //SI LA CONEXION ES CORRECTA	 
	     if( $conn ) { 
		 
				// echo "Conectado a la Base de Datoss.<br />"; 
				
		
				//EN ESTA SQL USO LA VARIABLE $datosbd_2 QUE ES LA QUE TOMA EL VALOR DE LA BASE DE DATOS
				//DE LA FUNCION get_datos_basededatos()
				$sql = (" SELECT t103.A103CODICLAS,t053.A053DESCCLAS,t103.A103CODISUBC,t071.A071DESCSUBC,
						  t112.A112LLAVPROC,t112.A112CODISUJE,t112.A112NUMESUJE,t112.A112NOMBSUJE,t112.A112FLAGDETE,
						  t057.A057DESCSUJE,t103.A103ENTIRADI,t051.A051DESCENTI,t103.A103ESPERADI,t062.A062DESCESPE,
						  t103.A103CODIPROC,t052.A052DESCPROC,A103CODIPONE,A103NOMBPONE
						  FROM ((((((([$datosbd_2].[dbo].[T103DAINFOPROC] t103 
						  LEFT JOIN [$datosbd_2].[dbo].[T112DRSUJEPROC] t112 ON t103.A103LLAVPROC = t112.A112LLAVPROC) 
						  LEFT JOIN [$datosbd_2].[dbo].[T057BASUJEGENE] t057 ON t112.A112CODISUJE = t057.A057CODISUJE)
						  LEFT JOIN [$datosbd_2].[dbo].[T053BACLASGENE] t053 ON t103.A103CODICLAS = t053.A053CODICLAS)
						  LEFT JOIN [$datosbd_2].[dbo].[T071BASUBCGENE] t071 ON t103.A103CODISUBC = t071.A071CODISUBC)
						  LEFT JOIN [$datosbd_2].[dbo].[T051BAENTIGENE] t051 ON t103.A103ENTIRADI = t051.A051CODIENTI)
						  LEFT JOIN [$datosbd_2].[dbo].[T062BAESPEGENE] t062 ON t103.A103ESPERADI = t062.A062CODIESPE)
						  LEFT JOIN [$datosbd_2].[dbo].[T052BAPROCGENE] t052 ON t103.A103CODIPROC = t052.A052CODIPROC)
						  WHERE t103.A103LLAVPROC IN('$valorradi') ");
				
							
				 $params = array();
				 $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
				 $stmt = sqlsrv_query( $conn, $sql , $params, $options );
			
				 $row_count = sqlsrv_num_rows( $stmt );
			
				 //ERROR EN CARGA DE DATOS, REVISAS CONSULTA $SQL
				 if ($row_count === false){
				 
					 //echo "Error in retrieveing row count. en Cargar Datos";
					 
					 //$retorno  = 2;
					 
					 $cadena = 2;
					 echo trim($cadena);
					 
				 }
				 //NO EXISTE ERROR EN CARGA DE DATOS Y SI $cadena = 0
				 //NO EXISTEN DATOS EN JUSTICIA XXI, PROCEDA A CREAR EL RADICADO
				 else{
			 
					 while( $row = sqlsrv_fetch_array( $stmt)){
					 
						 $radi        = $row['A112LLAVPROC'];
				 
						 $codigoparte = $row['A112CODISUJE'];
						 
						 $cd          = $row['A112NUMESUJE'];
						 $nd          = $row['A112NOMBSUJE'];
						 
						 $estado      = $row['A112FLAGDETE'];
						 
						 $tipo        = $row['A057DESCSUJE'];
						 
						 $codclase    = $row['A103CODICLAS'];
						 $nomclase 	  = $row['A053DESCCLAS'];
						 
						 $codsubclase = $row['A103CODISUBC'];
						 $nomsubclase = $row['A071DESCSUBC'];
						 
						 $codcorpo    = $row['A103ENTIRADI'];
						 $corpo       = $row['A051DESCENTI'];
						 
						 $codespe     = $row['A103ESPERADI'];
						 $espe        = $row['A062DESCESPE'];
						 
						 $coddelit    = $row['A103CODIPROC'];
						 $delit       = $row['A052DESCPROC'];
						 
					 
						 $A103CODIPONE = $row['A103CODIPONE'];
						 $A103NOMBPONE = $row['A103NOMBPONE'];
						 
						 
						 
						//$cadena .= $codigoparte."//////".$cd."//////".$nd."//////".$tipo."******";
						
						$cadena .= $codigoparte."//////".$cd."//////".$nd."//////".$tipo."//////".$codclase."//////".$nomclase."//////".$codsubclase."//////".$nomsubclase
						."//////".$estado."//////".$codcorpo."//////".$corpo."//////".$codespe."//////".$espe."//////".$coddelit."//////".$delit
						."//////".$A103CODIPONE."//////".$A103NOMBPONE."//////".$bandera."******";
						
						$retorno  = 3;
						
						 
					}
					
					if($retorno == 3){
					
						echo trim(utf8_encode($cadena));
					
					}
					else{
					
						$cadena = 0;
						echo trim($cadena);
					
					}
					
					

				}

		
				
		 }
		 else{ 
		 
			//echo "NO se puede conectar a la Base de Datos.<br />"."DATOS ".$datosbd." IP ".$datosbd_1." BD ".$datosbd_2." USUARIO ".$datosbd_3." CLAVE ".$datosbd_4; 
			//die( print_r( sqlsrv_errors(), true)); 
			
			//$retorno  = 1;
			
			$cadena = 1;
			echo trim($cadena);
			
			
			
		  } 
	
	


	}
	

	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	