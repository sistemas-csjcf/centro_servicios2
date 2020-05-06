<?php

		//require_once('../libs/Conexion_Funciones.php');
		
		$cadena   = "";
		
		$datosdemandantec = "";
		$datosdemandanten = "";
		
		$datosdemandadoc  = "";
		$datosdemandadon  = "";
	
		$idradicado		= trim($_GET['idradicado']);

		$serverName = "192.168.89.20"; //serverName\instanceName
		$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"sa", "PWD"=>"SA23palacio");
		$conn = sqlsrv_connect( $serverName, $connectionInfo);
		 
		 if( $conn ) { 
			// echo "Conectado a la Base de Datoss.<br />"; 
		 }
		 else{ 
			echo "NO se puede conectar a la Base de Datoss.<br />"; 
			die( print_r( sqlsrv_errors(), true)); 
		 }
	
		  
		 $sql = ("SELECT t112.A112LLAVPROC,t112.A112CODISUJE,t112.A112NUMESUJE,t112.A112NOMBSUJE
     	 		  FROM dbo.T112DRSUJEPROC t112
  		          WHERE t112.A112LLAVPROC IN('$idradicado')");
					
		 $params = array();
		 $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		 $stmt = sqlsrv_query( $conn, $sql , $params, $options );
	
		 $row_count = sqlsrv_num_rows( $stmt );
	
		 if ($row_count === false){
			 echo "Error in retrieveing row count. en Cargar Datos";
		 }
		 else{
	 
			 while( $row = sqlsrv_fetch_array( $stmt)){
			 
			 	 $radi = $row['A112LLAVPROC'];
		 
		 		 $codigoparte = trim($row['A112CODISUJE']);
				 
				 if($codigoparte == '0001'){
				 	
					$cd = $row['A112NUMESUJE'];
				 	$nd = $row['A112NOMBSUJE'];
					
					$datosdemandantec .= $cd.",";
					$datosdemandanten .= $nd.",";
		
					
					
				 }
				 if($codigoparte == '0002'){
				 	
					$cdo = $row['A112NUMESUJE'];
				 	$ndo = $row['A112NOMBSUJE'];
	
					$datosdemandadoc .= $cdo.",";
					$datosdemandadon .= $ndo.",";
					
					
				 }
				 
				  //$cadena .= $radi."//////".$cd."//////".$nd."//////".$cdo."//////".$ndo;
		 		
				 //$cd   = $row['A112NUMESUJE'];
				 //$nd   = $row['A112NOMBSUJE'];
				 //$cdo  = $row['A112NUMESUJE'];
				 //$ndo  = $row['A112NOMBSUJE'];
				 
				 //$cadena .= $radi."//////".$cd."//////".$nd."//////".$cdo."//////".$ndo;
				 
				 
				 /*$cp   = $row['A103CODICLAS'];	
				
				
				 $datoprocesosxxi = $this->db->prepare("select id from pa_clase_proceso where idsigloxxi = '$cp'");

				 $datoprocesosxxi->execute();
				  
				 while($fila = $datoprocesosxxi->fetch()){
					  $idcodproceso = $fila['id'];
				 }
				
				 $modificar = $this->db->prepare("UPDATE ubicacion_expediente SET idclase_proceso ='$idcodproceso' WHERE radicado='$radi'");
	  			 $modificar->execute();*/
				
			}
			
			$cadena .= $radi."//////".$datosdemandantec."//////".$datosdemandanten."//////".$datosdemandadoc."//////".$datosdemandadon;
			
			echo trim($cadena);
	 
		}
  
  		/*print'<script languaje="Javascript">location.href="index.php?controller=archivo&action=mensajes&nombre=2"</script>';*/
	
?>
   

	

	
	