<?php
    class migracionModel extends modelBase{
        /***********************************************************************************/
        /*----------------------------- Mensajes ---------------------------------------*/
        /***********************************************************************************/
        public function mensajes(){
            $condicion=$_GET['nombre'];
            if($condicion==1){
                $_SESSION['elemento'] = "La correspondencia ha sido registrada correctamente";
                $_SESSION['elem_conscontrato'] = true;
                if($_SESSION['id']!=""){
                    print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_correspondencia"</script>';
                }
            }
            if($condicion==2){
                $_SESSION['elemento'] = "El registro ha sido actualizado correctamente";
                $_SESSION['elem_conscontrato'] = true;
                if($_SESSION['id']!=""){
                    print'<script languaje="Javascript">location.href="index.php?controller=migracion&action=migracion_inc"</script>';
                }
            }
            if($condicion==3){
                $_SESSION['elemento'] = "El registro ha sido actualizado correctamente";
                $_SESSION['elem_conscontrato'] = true;
                if($_SESSION['id']!=""){
                    print'<script languaje="Javascript">location.href="index.php?controller=migracion&action=migracion"</script>';	  
                }
            }
            if($condicion==4){
                $_SESSION['elemento'] = "El acta de entrega ha sido registrada correctamente";
                $_SESSION['elem_conscontrato'] = true;
                if($_SESSION['id']!=""){
                    print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
                }
            }
            if($condicion==5){
                $_SESSION['elemento'] = "El acta ha sido modificada correctamente";
                $_SESSION['elem_conscontrato'] = true;
                if($_SESSION['id']!=""){
                    print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
                }
            }
            if($condicion==6){
                $_SESSION['elemento'] = "El informe ha sido registrado correctamente";
                $_SESSION['elem_conscontrato'] = true;
                if($_SESSION['id']!=""){
                    print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
                }
            }
            if($condicion==7){
                $_SESSION['elemento'] = "El informe ha sido actualizado correctamente";
                $_SESSION['elem_conscontrato'] = true;
                if($_SESSION['id']!=""){
                    print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
                }
            }
            if($condicion==8){
                $_SESSION['elemento'] = "La correspondencia no se registro, No Oficio/Telegrama
		ya existe para el juzgado";
                $_SESSION['elem_conscontrato'] = true;
                if($_SESSION['id']!=""){
                    print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_correspondencia"</script>';
                }
            }
            if($condicion==99){
                $_SESSION['elemento'] = "Error al Migrar Informacion - SAIDOJ";
                $_SESSION['elem_conscontrato'] = true;
                if($_SESSION['id']!=""){
                    print'<script languaje="Javascript">location.href="index.php?controller=migracion&action=migracion"</script>';	  
                }
            }
        }	
        /***********************************************************************************/
        public function listarJuzgado(){
            $listar = $this->db->prepare("select * from pa_juzgado");
            $listar->execute();
            return $listar;
        }  
        /***********************************************************************************/
        /*------------------------------ Consultar SAIDOJ  ---------------------------------------*/
        /***********************************************************************************/
        public function consultarsaidoj(){
            $serverName = '192.168.89.23';  
            $bd='saidoj';
            $connectionInfo = array( "Database"=>$bd, "UID"=>"sa", "PWD"=>"3j3cut1V416");
            $conn = sqlsrv_connect( $serverName, $connectionInfo);
            if( $conn ) { 
                //echo "Conectado a la Base de Datos.<br />"; 
            }else{ 
                //echo "NO se puede conectar a la Base de Datos.<br />"; 
                die( print_r( sqlsrv_errors(), true)); 
            }
            $sql = "SELECT TOP 10 id_tipo_inc, id_juzgado,descripcion,fecha_demanda  from EXPEDIENTE";
            $params = array();
            $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
            $stmt = sqlsrv_query( $conn, $sql , $params, $options );
            $row_count = sqlsrv_num_rows( $stmt );
            /*if ($row_count === false)
               echo "Error in retrieveing row count.";
            else
               echo $row_count;*/
            $i=0;
            while( $row = sqlsrv_fetch_array( $stmt) ) {
                $date   = $row['fecha_demanda'];
                $fecha1 = date_format($date, 'Y-m-d');
                $vector[$i][id_tipo_inc]    = $row['id_tipo_inc'];
                $vector[$i][id_juzgado]     = $row['id_juzgado'];
                $vector[$i][fecha_demanda]  = $fecha1;
                $i++; 	  
            }
            //print_r($vector);
            return $vector; 
        }  
        /***********************************************************************************/
        /*------------------------------ Consultar Justicia  ---------------------------------------*/
        /***********************************************************************************/
        public function consultarjusticia(){
            //*************** CONEXIÓN LOCAL **********************//
            //$serverName = 'USER01238\SQLEXPRESS';
            //$bd='ConsejoPN';
            $connectionInfo = array( "Database"=>$bd);
            //*****************************************************//
            
            
            //*************** CONEXIÓN REAL **********************// JEST
            $serverName = $_SESSION['server_name'];  
            $bd=$_SESSION['bd'];
            $actu=$_SESSION['cod_actuacion'];
            $actu2=$_SESSION['cod_actuacion2'];
            $user = 'sa';
            
            //JUAN ESTEBAN MUNERA 21-07-2017
            if($_SESSION['especialidad']=='CIVIL FAMILIA'){
                $actu   = '30000067';
                $actu2  = '30023363';
            }
                 
            if($actu2!=''){
                $cod_actu2 =" OR (dbo.T110DRACTUPROC.A110CODIACTU = '$actu2') ";
            }

            if($band1==0){
                $pwd='3j3cut1V416';
            }
            /* ---------------------------CONEXIÓN LOCAL -------------------------------------------------*/	
//            $serverName_saidoj = 'USER01238\SQLEXPRESS';  
//            $bd_saidoj='saidoj_local';
//            $connectionInfo_saidoj = array( "Database"=>$bd_saidoj);
//            $conn_saidoj = sqlsrv_connect( $serverName_saidoj, $connectionInfo_saidoj);
            //**********************************************************************************************
            
            // CONEXIÓN REAL ******************************************************************************// JEST
            /*Anexar validaci�n si el proceso ya esta migrado*/	
            $serverName_saidoj = '192.168.89.23';  
            $bd_saidoj='saidoj';
            $connectionInfo_saidoj = array( "Database"=>$bd_saidoj, "UID"=>"sa", "PWD"=>"3j3cut1V416");
            $conn_saidoj = sqlsrv_connect( $serverName_saidoj, $connectionInfo_saidoj);
            //**********************************************************************************************
            
            /*consulto procesos migrados en saidoj*/
            $idjuz = $_SESSION['id_juzgado'];
//            if($_SESSION['especialidad']=='EJECUCION'){
//                $juz= $_GET['nombre3'];
//                $vect_juz = explode("-",$juz);
//                $idjuz = '170014303'.$vect_juz[0];
//            }
//            
            if($_SESSION['especialidad']=='CIVIL FAMILIA'){
                $juz= $_GET['nombre3'];
                $vect_juz = explode("-",$juz);
                $idjuz = '17001'.$vect_juz[2].$vect_juz[1].$vect_juz[0];
            }
            //  echo $idjuz;
            $sql_saidoj = "select codigo_unico from PROCESO where id_funcionario = '$idjuz' and codigo_unico is not null;";
            $params_saidoj = array();
            $options_saidoj =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
            $stmt1_saidoj = sqlsrv_query( $conn_saidoj, $sql_saidoj , $params_saidoj, $options_saidoj );
            $s=0;
            $listado ="";
            while($row_saidoj = sqlsrv_fetch_array($stmt1_saidoj) ) {
                if($s==0){
                    $listado = "'".$row_saidoj['codigo_unico']."'";
                }else{
                    $listado = $listado.","."'".$row_saidoj['codigo_unico']."'";
                }
                $s++;
            }
            sqlsrv_close( $conn_saidoj );
            //echo $listado;
            if($listado!=""){
                $consulta_rad = " AND dbo.T103DAINFOPROC.A103LLAVPROC not in ($listado)  ";
            }else{
                $consulta_rad = "";
            }
            $cadena = $consulta_rad;
            // 21 de abril quitar un momento 
            $consulta_rad = "";
            
             //--------------------------- CONEXIÓN LOCAL ---------------------------------- // 
//            $connectionInfo = array( "Database"=>$bd);
//            $conn = sqlsrv_connect( $serverName, $connectionInfo);
            //*******************************************************************************/*///
            
            //--------------------------- CONEXIÓN REAL ---------------------------------- // JEST
            $connectionInfo = array( "Database"=>$bd, "UID"=>$user, "PWD"=>$pwd);
            $conn = sqlsrv_connect( $serverName, $connectionInfo);
            //****************************************************************************//
            $i=0;
            if( $conn ) { 
                //echo "Conectado a la Base de Datos.<br />"; 
            }else{ 
                echo "NO se puede conectar a la Base de Datos.<br />"; 
                die( print_r( sqlsrv_errors(), true)); 
            }
            $fechai= $_GET['nombre1'];
            $fechaf= $_GET['nombre2'];
            $juzgado= $_GET['nombre3'];
            $vect = explode("-",$juzgado);
            $num = $vect[0];
            $esp = $vect[1];
            $corp = $vect[2];
            //print_r( $vect);
            ini_set('max_execution_time', 50000); //240 segundos = 4 minutos
            $sql = "
                SELECT    
                      DISTINCT  dbo.T103DAINFOPROC.A103LLAVPROC AS [NO. PROCESO], dbo.T103DAINFOPROC.A103FECHPROC, 
                      dbo.T112DRSUJEPROC.A112NUMESUJE AS [ID DTE], dbo.T112DRSUJEPROC.A112NOMBSUJE AS [NOM DTE], T112DRSUJEPROC_1.A112NUMESUJE AS [ID DDO], 
                      T112DRSUJEPROC_1.A112NOMBSUJE AS [NOM DDO], dbo.T103DAFINAPROC.A103OBSEFINA AS OBSERVACION, 
                      dbo.T103DAFINAPROC.A103FECHFINA AS [FECHA ARCHIVO], dbo.T103DAFINAPROC.A103ARCHIVAD, dbo.T103DAINFOPROC.A103CIUDRADI, 
                      dbo.T103DAINFOPROC.A103ENTIRADI, dbo.T051BAENTIGENE.A051DESCENTI, dbo.T103DAINFOPROC.A103ESPERADI, dbo.T062BAESPEGENE.A062DESCESPE, 
                      dbo.T103DAINFOPROC.A103NUENRADI, dbo.T052BAPROCGENE.A052CODIPROC, dbo.T052BAPROCGENE.A052DESCPROC AS [Tipo Proceso], 
                      dbo.T053BACLASGENE.A053CODICLAS, dbo.T053BACLASGENE.A053DESCCLAS AS [Clase Proceso], dbo.T110DRACTUPROC.A110CODIACTU, 
                      dbo.T110DRACTUPROC.A110DESCACTU, dbo.T110DRACTUPROC.A110CUADPROC, dbo.T110DRACTUPROC.A110FOLIPROC, 
                      dbo.T110DRACTUPROC.A110FECHREGI
                FROM         dbo.T103DAINFOPROC INNER JOIN
                      dbo.T103DAFINAPROC ON dbo.T103DAINFOPROC.A103LLAVPROC = dbo.T103DAFINAPROC.A103LLAVPROC INNER JOIN
                      dbo.T052BAPROCGENE ON dbo.T103DAINFOPROC.A103CODIPROC = dbo.T052BAPROCGENE.A052CODIPROC INNER JOIN
                      dbo.T053BACLASGENE ON dbo.T103DAINFOPROC.A103CODICLAS = dbo.T053BACLASGENE.A053CODICLAS INNER JOIN
                      dbo.T071BASUBCGENE ON dbo.T103DAINFOPROC.A103CODISUBC = dbo.T071BASUBCGENE.A071CODISUBC INNER JOIN
                      dbo.T112DRSUJEPROC AS T112DRSUJEPROC_1 ON dbo.T103DAINFOPROC.A103LLAVPROC = T112DRSUJEPROC_1.A112LLAVPROC INNER JOIN
                      dbo.T112DRSUJEPROC ON dbo.T103DAINFOPROC.A103LLAVPROC = dbo.T112DRSUJEPROC.A112LLAVPROC INNER JOIN
                      dbo.T110DRACTUPROC ON dbo.T103DAINFOPROC.A103LLAVPROC = dbo.T110DRACTUPROC.A110LLAVPROC INNER JOIN
                      dbo.T051BAENTIGENE ON dbo.T103DAINFOPROC.A103ENTIRADI = dbo.T051BAENTIGENE.A051CODIENTI INNER JOIN
                      dbo.T062BAESPEGENE ON dbo.T103DAINFOPROC.A103ESPERADI = dbo.T062BAESPEGENE.A062CODIESPE
                WHERE     (dbo.T112DRSUJEPROC.A112CODISUJE = '0001') AND (dbo.T103DAFINAPROC.A103ARCHIVAD = 'si') AND (dbo.T103DAINFOPROC.A103ENTIRADI = '$corp') AND 
                      (dbo.T103DAINFOPROC.A103ESPERADI = '$esp') AND (dbo.T103DAINFOPROC.A103NUENRADI = '$num') AND (T112DRSUJEPROC_1.A112CODISUJE = '0002') AND 
                      ((dbo.T110DRACTUPROC.A110CODIACTU = '$actu')".$cod_actu2." OR (dbo.T110DRACTUPROC.A110CODIACTU = '30023138')) AND (dbo.T110DRACTUPROC.A110CUADPROC IS NOT NULL) AND  dbo.T103DAFINAPROC.A103OBSEFINA IS NOT NULL AND 
                      (dbo.T110DRACTUPROC.A110FOLIPROC IS NOT NULL) AND (dbo.T110DRACTUPROC.A110FECHREGI >= CONVERT(DATETIME, '$fechai', 102) AND 
                      dbo.T110DRACTUPROC.A110FECHREGI <= CONVERT(DATETIME, '$fechaf', 102)) ".$consulta_rad." ORDER BY [NO. PROCESO]
            ";
            $params = array();
            $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
            $stmt = sqlsrv_query( $conn, $sql , $params, $options );
            $row_count = sqlsrv_num_rows($stmt);
            //echo "cant ".$row_count;
            if ($row_count === false){
                echo "Error in retrieveing row count.";
            }
            while($row = sqlsrv_fetch_array($stmt) ) {
                $band=0;
                $observ = $row['OBSERVACION'];
                $buscar = $row['NO. PROCESO'];
                $resultado = strpos($listado, $buscar);
                if($resultado === false){
                    //echo "entre";
                    // echo "<br>";
                    $tano   = substr($observ, 0,3);
                    $ano    = substr($observ, 4,4); 
                    $caja   = substr($observ, 9,4);
                    $ncaja  = substr($observ, 14,4);
                    $num    = substr($observ, 19,1);
                    $consec = substr($observ, 21,4);
                    $anioL = utf8_decode("AÑO");
                    if($tano!= $anioL){
                        $band =1;
                    }
                    if(!is_numeric($ano)){
                        $band =1;
                    }
                    if($caja!="CAJA"){
                        $band =1;
                    }
                    if(!is_numeric($ncaja)){
                       $band =1;
                    }
                    if($num!="N"){	 	
                        $band =1;
                    }
                    if(!is_numeric($consec)){
                        $band =1;
                    }
                    if($band==0){
                        $vector[$i][num]                = $row['NO. PROCESO'];
                        $vector[$i][demandado]          = $row['NOM DDO'];
                        $vector[$i][demandante]         = $row['NOM DTE'];
                        $vector[$i][tipo]               = $row['Tipo Proceso'];
                        $vector[$i][clase]              = $row['Clase Proceso'];
                        $vector[$i][observaciones]      = $row['OBSERVACION'];
                        $vector[$i][fecha_demanda]      = $row['A103FECHPROC'];
                        $vector[$i][documento_dte]      = $row['ID DTE'];
                        $vector[$i][documento_ddo]      = $row['ID DDO'];
                        //$vector[$i][observaciones]    = $row['FECHA ARCHIVO'];
                        //$vector[$i][observaciones]    = $row['A103ARCHIVAD'];
                        $vector[$i][ciudad]             = $row['A103CIUDRADI'];
                        $vector[$i][entidad]            = $row['A103ENTIRADI'];
                        $vector[$i][nom_entidad]        = $row['A051DESCENTI'];
                        $vector[$i][especialidad]       = $row['A103ESPERADI'];
                        $vector[$i][nom_especialidad]   = $row['A062DESCESPE'];	
                        $vector[$i][num_juzgado]        = $row['A103NUENRADI'];
                        $vector[$i][id_tipo_proc]       = $row['A052CODIPROC'];
                        $vector[$i][id_codiclas]        = $row['A053CODICLAS'];
                        //$vector[$i][observaciones]    = $row['A110DESCACTU'];
                        $vector[$i][cuadernos]          = $row['A110CUADPROC'];
                        $vector[$i][folios]             = $row['A110FOLIPROC'];
                        //$vector[$i][observaciones]    = $row['A110FECHREGI'];
                        $i++;  
                    }  	
                }
            }
            return $vector; 
        } 
        /***********************************************************************************/
        /*------------------------------ Consultar Justicia inconsistencias  ---------------------------------------*/
        /***********************************************************************************/
        public function consultarjusticia_inconsistencias(){
            /*$serverName = "192.168.89.20"; //serverName\instanceName
            $connectionInfo = array( "Database"=>"consejoPN", "UID"=>"sa", "PWD"=>"SA23palacio");
            $conn = sqlsrv_connect( $serverName, $connectionInfo);
            */
            
            //****************** CONEXIÓN LOCAL ***************************************************** 
//            $serverName = 'USER01238\SQLEXPRESS';  
//            $bd         = 'ConsejoPN';
            
            //*************************************************************************************
            
            //****************** CONEXIÓN REAL ***************************************************** JEST
            $serverName = $_SESSION['server_name'];  
            $bd=$_SESSION['bd'];
            //*************************************************************************************
            $actu="30000067";
            $actu2="30023363";
            $band1=0;
   
            //$connectionInfo = array( "Database"=>$bd);
            $connectionInfo = array( "Database"=>$bd, "UID"=>"sa", "PWD"=>"3j3cut1V416");
            $conn = sqlsrv_connect( $serverName, $connectionInfo);
            
            $i=0;
            if( $conn ) { 
                //echo "Conectado a la Base de Datos.<br />"; 
            }else{ 
                echo "NO se puede conectar a la Base de Datos INC.<br />"; 
                die( print_r( sqlsrv_errors(), true)); 
            }
            $fechai= $_GET['nombre1'];
            $fechaf= $_GET['nombre2'];
            $juzgado= $_GET['nombre3'];
            $vect = explode("-",$juzgado);
            $num = $vect[0];
            $esp = $vect[1];
            $corp = $vect[2];
            ini_set('max_execution_time', 700); //240 segundos = 4 minutos
            $sql = "SELECT    DISTINCT  dbo.T103DAINFOPROC.A103LLAVPROC AS [NO. PROCESO], dbo.T103DAINFOPROC.A103FECHPROC, 
                        dbo.T112DRSUJEPROC.A112NUMESUJE AS [ID DTE], dbo.T112DRSUJEPROC.A112NOMBSUJE AS [NOM DTE], T112DRSUJEPROC_1.A112NUMESUJE AS [ID DDO], 
                        T112DRSUJEPROC_1.A112NOMBSUJE AS [NOM DDO], dbo.T103DAFINAPROC.A103OBSEFINA AS OBSERVACION, 
                        dbo.T103DAFINAPROC.A103FECHFINA AS [FECHA ARCHIVO], dbo.T103DAFINAPROC.A103ARCHIVAD, dbo.T103DAINFOPROC.A103CIUDRADI, 
                        dbo.T103DAINFOPROC.A103ENTIRADI, dbo.T051BAENTIGENE.A051DESCENTI, dbo.T103DAINFOPROC.A103ESPERADI, dbo.T062BAESPEGENE.A062DESCESPE, 
                        dbo.T103DAINFOPROC.A103NUENRADI, dbo.T052BAPROCGENE.A052CODIPROC, dbo.T052BAPROCGENE.A052DESCPROC AS [Tipo Proceso], 
                        dbo.T053BACLASGENE.A053CODICLAS, dbo.T053BACLASGENE.A053DESCCLAS AS [Clase Proceso], dbo.T110DRACTUPROC.A110CODIACTU, 
                        dbo.T110DRACTUPROC.A110DESCACTU, dbo.T110DRACTUPROC.A110CUADPROC, dbo.T110DRACTUPROC.A110FOLIPROC, 
                        dbo.T110DRACTUPROC.A110FECHREGI
                    FROM         dbo.T103DAINFOPROC INNER JOIN
                        dbo.T103DAFINAPROC ON dbo.T103DAINFOPROC.A103LLAVPROC = dbo.T103DAFINAPROC.A103LLAVPROC INNER JOIN
                        dbo.T052BAPROCGENE ON dbo.T103DAINFOPROC.A103CODIPROC = dbo.T052BAPROCGENE.A052CODIPROC INNER JOIN
                        dbo.T053BACLASGENE ON dbo.T103DAINFOPROC.A103CODICLAS = dbo.T053BACLASGENE.A053CODICLAS INNER JOIN
                        dbo.T071BASUBCGENE ON dbo.T103DAINFOPROC.A103CODISUBC = dbo.T071BASUBCGENE.A071CODISUBC INNER JOIN
                        dbo.T112DRSUJEPROC AS T112DRSUJEPROC_1 ON dbo.T103DAINFOPROC.A103LLAVPROC = T112DRSUJEPROC_1.A112LLAVPROC INNER JOIN
                        dbo.T112DRSUJEPROC ON dbo.T103DAINFOPROC.A103LLAVPROC = dbo.T112DRSUJEPROC.A112LLAVPROC INNER JOIN
                        dbo.T110DRACTUPROC ON dbo.T103DAINFOPROC.A103LLAVPROC = dbo.T110DRACTUPROC.A110LLAVPROC INNER JOIN
                        dbo.T051BAENTIGENE ON dbo.T103DAINFOPROC.A103ENTIRADI = dbo.T051BAENTIGENE.A051CODIENTI INNER JOIN
                        dbo.T062BAESPEGENE ON dbo.T103DAINFOPROC.A103ESPERADI = dbo.T062BAESPEGENE.A062CODIESPE
                    WHERE     (dbo.T112DRSUJEPROC.A112CODISUJE = '0001') AND (dbo.T103DAFINAPROC.A103ARCHIVAD = 'si') AND (dbo.T103DAINFOPROC.A103ENTIRADI = '$corp') AND 
                        (dbo.T103DAINFOPROC.A103ESPERADI = '$esp') AND (dbo.T103DAINFOPROC.A103NUENRADI = '$num') AND (T112DRSUJEPROC_1.A112CODISUJE = '0002') AND 
                        (dbo.T110DRACTUPROC.A110CODIACTU = '$actu' OR dbo.T110DRACTUPROC.A110CODIACTU = '$actu2' OR (dbo.T110DRACTUPROC.A110CODIACTU = '30023138')) AND (dbo.T110DRACTUPROC.A110CUADPROC IS NOT NULL) AND 
                        (dbo.T110DRACTUPROC.A110FOLIPROC IS NOT NULL) AND (dbo.T110DRACTUPROC.A110FECHREGI >= CONVERT(DATETIME, '$fechai', 102) AND 
                        dbo.T110DRACTUPROC.A110FECHREGI <= CONVERT(DATETIME, '$fechaf', 102))
                    ORDER BY [NO. PROCESO]";
            //$sql = "SELECT TOP 10 A128NUMEBENE, A128ESTADOTJ  from CAMBIOPARTES";
            $params = array();
            $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
            $stmt = sqlsrv_query( $conn, $sql , $params, $options );
            $row_count = sqlsrv_num_rows( $stmt );
            if ($row_count === false)
                echo "Error in retrieveing row count.";
              
                while( $row = sqlsrv_fetch_array( $stmt) ) {
                    $band =0;
                    $observ = $row['OBSERVACION'];
                    $tano   = substr($observ, 0,3);
                    $ano    = substr($observ, 4,4); 
                    $caja   = substr($observ, 9,4);
                    $ncaja  = substr($observ, 14,4);
                    $num    = substr($observ, 19,1);
                    $consec = substr($observ, 21,4);
                    
                     $anioL = utf8_decode("AÑO");
                    if($tano!= $anioL){
                        $band =1;
                    }
                    if(!is_numeric($ano)){
                        $band =1;
                    }
                    if($caja!="CAJA"){
                        $band =1;
                    }
                    if(!is_numeric($ncaja)){
                        $band =1;
                        
                    }
                    if($num!="N"){	 	
                        $band =1;
                        
                    }
                    if(!is_numeric($consec)){
                        $band =1;
                        
                    }
                    if($band==1){
                        $vector[$i][num]            = $row['NO. PROCESO'];
                        $vector[$i][demandado]      = $row['NOM DDO'];
                        $vector[$i][demandante]     = $row['NOM DTE'];
                        $vector[$i][tipo]           = $row['Tipo Proceso'];
                        $vector[$i][clase]          = $row['Clase Proceso'];
                        $vector[$i][observaciones]  = $row['OBSERVACION'];
                        $i++; 
                    }  	  
                }
                return $vector; 
        }
        /***********************************************************************************/
        /*------------------------------ Actualizar Justicia observaciones  ---------------------------------------*/
        /***********************************************************************************/
        public function actualizarJusticia(){ 
            //session_start(); 
            $cont = $_POST["contador"];
            $i    = 0;
            $_POST["anio1"];
            
            //****************** CONEXIÓN LOCAL ***************************************************** 
//            $serverName = 'USER01238\SQLEXPRESS';  
//            $bd         = 'ConsejoPN';
            
            //*************************************************************************************
            //
            //****************** CONEXIÓN REAL ***************************************************** JEST
            
            $serverName = $_SESSION['server_name'];  
            $bd=$_SESSION['bd'];
            
            //****************************************************************************************
            $band =0;
            if($band==0){
                $pwd    = '3j3cut1V416';
                $actu   = '30023260';
            }
            // ****************** CONEXIÓN LOCAL ***************************************** JEST
//            $connectionInfo = array("Database"=>$bd);
            //***************************************************************************
            //DATOS LOG MIGRACIÓN ------------------------------------------------------------------------------------**
            date_default_timezone_set('America/Bogota'); 
            $fecha_log      = date('Y-m-d H:i:s',time());
            $user_nombre    = $_SESSION['nombre_empleado'];
            $user_id        = $_SESSION['idUsuario'];
            $descri_log     = utf8_decode(" Registra Modificación Procesos con Inconsistencias, en el sistema (MIGRACIÓN). $fecha_log");
            //********************************************************************************************************//
            
            // ************************* CONEXIÓN REAL *************************************
            $connectionInfo = array( "Database"=>$bd, "UID"=>"sa", "PWD"=>$pwd);
            //******************************************************************************
            $conn = sqlsrv_connect( $serverName, $connectionInfo);
            while ($i<$cont){
                if(isset($_POST["anio".$i])){	    
                    $llave = $_POST["llave".$i];
                    $observacion = utf8_decode("AÑO ".$_POST["anio".$i]." CAJA ".$_POST["ncaja".$i]." N ".$_POST["cons".$i]);
                    echo "\n";
                    $sql = "UPDATE T103DAFINAPROC SET A103OBSEFINA='$observacion' WHERE A103LLAVPROC='$llave'";
                    $params = array();
                    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                    $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                    $modificar   = $this->db->prepare("
                        INSERT INTO `log_migracion`(`mig_log_detalle`, `mig_log_radicado`, `mig_log_idUsuario`, `mig_log_id_tipoLog`)
                        VALUES ('$user_nombre $descri_log','$llave', '$user_id','11') ");
                    $modificar->execute(); 
                }
                $i++;
            }
            print'<script languaje="Javascript">location.href="index.php?controller=migracion&action=mensajes&nombre=2"</script>';  
        } 
        /***********************************************************************************/
        /*------------------------------ Migrar a SAIDOJ ---------------------------------------*/
        /***********************************************************************************/
        public function migrarSaidoj(){
            //******************** CONEXIÓN LOCAL ****************************//
//            $serverName = 'USER01238\SQLEXPRESS'; 
//            $bd         = 'saidoj_local';
//            $connectionInfo = array( "Database"=>$bd);
            //***************************************************************//
            // CONEXIÓN SAIDOJ***************************** REAL JEST
            $serverName = '192.168.89.23';  
            $bd='saidoj';
            $connectionInfo = array( "Database"=>$bd, "UID"=>"sa", "PWD"=>"3j3cut1V416");
            $conn = sqlsrv_connect( $serverName, $connectionInfo);
            
            // ----------------- CONEXIÓN LOCAL ********************************
//            $serverName = "USER01238\SQLEXPRESS";  
//            $bd         = "ConsejoPN";
            //*********************************************************************//
            //
            // ---------------- CONEXIÓN JUSTICIA XXI --------------------------- REAL JEST**
            $serverName = $_SESSION['server_name'];  
            $bd         = $_SESSION['bd'];
            //********************************************************************************
            $band=0;
            $user='sa';
            
            if($band==0){
                $pwd='SA23palacio';
                $actu = '30023260';
            }
            // CONEXIÓN LOCAL *********************************
//            $connectionInfo = array( "Database"=>$bd);
            // ************************************************
            // 
            //************ CONEXIÍON REAL ********************************************** JEST
            $connectionInfo = array( "Database"=>$bd, "UID"=>$user, "PWD"=>$pwd);
            // *************************************************************************//
            
            $conn_jus   = sqlsrv_connect( $serverName, $connectionInfo);
            $cantidad   = $_POST['contador'];
            $i          = 0;
            date_default_timezone_set('America/Bogota'); 
            $fecha_reg      = date('Y-m-d h:i:s');
            $fecha_log      = date('Y-m-d');
            $usuario_log    = "admin_cscf";

            $juz_ar     = $_POST['juzgado'];
            $vect_juz   = explode("-",$juz_ar);
            //print_r($vect_juz);
            $juz_1 = "17001".$vect_juz[2].$vect_juz[1].$vect_juz[0];
            while($i<$cantidad){
                $proceso            = $_POST['proceso'.$i];
                $nom_demandado      = $_POST['nom_demandado'.$i];
                $nom_demandante     = $_POST['nom_demandante'.$i];
                $tipo_proceso       = $_POST['tipo_proceso'.$i];
                $clase_proceso      = $_POST['clase_proceso'.$i];
                $observaciones      = $_POST['observaciones'.$i];
                $fecha_demanda      = $_POST['fecha_demanda'.$i];
                $doc_demandado      = $_POST['doc_demandado'.$i];
                $doc_demandante     = $_POST['doc_demandante'.$i];
                $ciudad             = $_POST['ciudad'.$i];
                $entidad            = $_POST['entidad'.$i];
                $nom_entidad        = $_POST['nom_entidad'.$i];
                $especialidad       = $_POST['especialidad'.$i];
                $nom_especialidad   = $_POST['nom_especialidad'.$i];
                $num_juzgado        = $_POST['num_juzgado'.$i];
                $id_tipo_proc       = $_POST['id_tipo_proc'.$i]; 
                $id_codiclas        = $_POST['codi_clas'.$i];  
                $cuadernos          = $_POST['cuadernos'.$i];  
                $folios             = $_POST['folios'.$i];  
                $ano_rad_gestion    = substr($proceso, 12,4);   
                //$juzgado	=substr($proceso, 0,12); 
                echo $proceso;
            
                $juzgado            = $juz_1;  
                $id_funcio_saidoj   = $juzgado;
                $fecha_demanda      = $fecha_demanda." 00:00:00.00";
                 //DATOS LOG MIGRACIÓN ------------------------------------------------------------------------------------**
                date_default_timezone_set('America/Bogota'); 
                $fecha_log      = date('Y-m-d H:i:s',time());
                $user_nombre    = $_SESSION['nombre_empleado'];
                $user_id        = $_SESSION['idUsuario'];
                $descri_log     = utf8_decode(" Registra migración de procesos, en el sistema (MIGRACIÓN). $fecha_log");
                //********************************************************************************************************//
                try {
                    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);			
                    //EMPIEZA LA TRANSACCION
                    $this->db->beginTransaction();
                    $sql1="select count(*) as codigo_proceso from PROCESO p where p.codigo_unico='$proceso'";
                    $params = array();
                    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                    $stmt = sqlsrv_query( $conn, $sql1 , $params, $options );
                    while( $row = sqlsrv_fetch_array( $stmt) ) {
                        $cont = $row['codigo_proceso'];
                    }
                    if($cont==0){
                        $sql_id="select top(1) id+1 as sig from PROCESO order by sig desc";
                        $params1 = array();
                        $options1 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt1 = sqlsrv_query($conn, $sql_id , $params1, $options1 );
                        while($row = sqlsrv_fetch_array($stmt1) ) {
                            $sig = $row['sig'];
                        }
                        if( $conn === false ) {						
                            $error_transaccion = 1;							
                            echo "ENTRE 1";					
                        }
                        //Iniciar la transacción.
                        if ( sqlsrv_begin_transaction( $conn ) === false ) {						 
                            $error_transaccion = 1;											 
                            echo "ENTRE 2";						
                        }
                        $sql = "INSERT INTO PROCESO (id,codigo_unico, codigo_antiguo, sufijo, id_tipo_proc, id_clase_proc, id_funcionario)  VALUES ($sig,'$proceso',NULL,NULL,'$id_tipo_proc','$id_codiclas','$id_funcio_saidoj');";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt1 = sqlsrv_query( $conn, $sql , $params, $options );
                        if( $stmt1 === false ) {
                            $error_transaccion = 1;						
                            if( ($errors = sqlsrv_errors() ) != null) {							
                            }							
                            echo "ENTRE 3";													
                        }
                        echo "<br />";
                        $sql3 = "INSERT INTO EXPEDIENTE (id,fecha_demanda, no_cuad_reg, no_folios_reg, descripcion, observaciones, fecha_reg, no_rad_gestion, ano_rad_gestion, id_tipo_inc, id_grupo, id_area, id_proceso, id_juzgado)  VALUES ('$sig',{ts '$fecha_demanda'},'$cuadernos','$folios','$observaciones','$observaciones',{ts '$fecha_reg'},'$sig','$ano_rad_gestion','2','1','1','$sig','$juzgado');";
                        $params1 = array();
                        $options1 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt2 = sqlsrv_query( $conn, $sql3 , $params1, $options1);
                        if( $stmt2 === false ) {
                            $error_transaccion = 1;												
                            echo "ENTRE 4";							
                        }
                        $sql4 = "UPDATE CODIGO SET proceso_expediente = '$sig'";
                        $params4 = array();
                        $options4 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt4 = sqlsrv_query( $conn, $sql4 , $params4, $options4);
                        if( $stmt4 === false ) {
                            $error_transaccion = 1;												
                            echo "ENTRE 5";						
                        }
                        $sql_jus = "INSERT INTO T900MIGRASAIDOJ (T900LLAVPROC, T900FECHAMIGRA, T900USUARIOMIGRA) VALUES ('$proceso', '$fecha_log', '$usuario_log')";
                        $params_jus = array();
                        $options_jus =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt_jus = sqlsrv_query( $conn_jus, $sql_jus , $params_jus, $options_jus );
                        if( $stmt_jus === false ) {
                            $error_transaccion = 1;												
                            echo "ENTRE 6";						
                        }
                    }
                    $id =  $sig;
                    $sql1="select count(*) as contador from DEMANDADO d where d.id_proceso='$id' and d.documento='$doc_demandado'";
                    $params = array();
                    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                    $stmt5 = sqlsrv_query( $conn, $sql1 , $params, $options );
                    if( $stmt5 === false ) {
                        $error_transaccion = 1;												
                        echo "ENTRE 7";												
                    }
                    while( $row = sqlsrv_fetch_array( $stmt5) ) {
                        $cont_ddo = $row['contador'];
                    }
                    if($cont_ddo==0){
                        $sql4 = "INSERT INTO DEMANDADO (id_proceso, nombre, documento)  VALUES ('$id','$nom_demandado','$doc_demandado');";
                        $params1 = array();
                        $options1 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt6 = sqlsrv_query( $conn, $sql4 , $params1, $options1);
                        if( $stmt6 === false ) {
                            $error_transaccion = 1;												
                            echo "ENTRE 8";						
                        }
                    }
                    $sql1="select count(*) as contador from DEMANDANTE d where d.id_proceso='$id' and d.documento='$doc_demandante' ";
                    $params = array();
                    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                    $stmt7 = sqlsrv_query( $conn, $sql1 , $params, $options );
                    if( $stmt7 === false ) {
                        $error_transaccion = 1;												
                        echo "ENTRE 8";						
                    }
                    while( $row = sqlsrv_fetch_array( $stmt7) ) {
                        $cont_ddte = $row['contador'];
                    }
                    if($cont_ddte==0){
                        $sql5 = "INSERT INTO DEMANDANTE (id_proceso, nombre, documento)  VALUES ('$id','$nom_demandante','$doc_demandante');";
                        $params1 = array();
                        $options1 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt8 = sqlsrv_query( $conn, $sql5 , $params1, $options1);
                        if( $stmt8 === false ) {
                            $error_transaccion = 1;												
                            echo "ENTRE 9";						
                        }
                    }
                    $this->db->exec("
                        INSERT INTO `log_migracion`(`mig_log_detalle`, `mig_log_radicado`, `mig_log_idUsuario`, `mig_log_id_tipoLog`)
                        VALUES ('$user_nombre $descri_log','$proceso', '$user_id','11') "
                    ); 
                    
                    $i++;
                    if($error_transaccion) {
                        //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
                        $this->db->rollBack();
                        //NO TERMINA LA TRANSACCION ERROR AL INGRESAR LOS DATOS A JUSTICIA XXI
                        sqlsrv_rollback( $conn );
                        // Cerrar la conexión.
                        sqlsrv_close( $conn );									
                        print'<script languaje="Javascript">location.href="index.php?controller=migracion&action=mensajes&nombre=99"</script>'; 
                    }else{
                        //SE TERMINA LA TRANSACCION  
                        $this->db->commit();
                        //SE TERMINA LA TRANSACCION JUSTICIA XXI
                        sqlsrv_commit( $conn );						
                        echo "CORRECTO**********";
                        print'<script languaje="Javascript">location.href="index.php?controller=migracion&action=mensajes&nombre=3"</script>'; 
                    }
                } catch (Exception $e) {
                    //NO TERMINA LA TRANSACCION ERROR AL INGRESAR LOS DATOS A JUSTICIA XXI
                    sqlsrv_rollback( $conn );								
                    // Cerrar la conexión.
                    sqlsrv_close( $conn );
                    print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=2b"</script>'; 
                }
            }
        } 
        /***********************************************************************************/
        /*------------------------------ Consultar Despachos ---------------------------------------*/
        /***********************************************************************************/
        public function consultar_despachos_todos(){
            $bd_c = "consejoPN";
            $serverName = "192.168.89.20";
            $sql_enti = " AND ((A101CODIENTI='43' AND A101CODIESPE='03') OR (A101CODIENTI='40' AND A101CODIESPE='03') OR (A101CODIENTI='31' AND A101CODIESPE='03')OR (A101CODIENTI='31' AND A101CODIESPE='10')OR (A101CODIENTI='31' AND A101CODIESPE='05')OR (A101CODIENTI='41' AND A101CODIESPE='05'))"; 
            $connectionInfo = array( "Database"=>$bd_c, "UID"=>"sa", "PWD"=>"3j3cut1V416");
            //$connectionInfo = array( "Database"=>$bd_c, "UID"=>"sa", "PWD"=>"SA23palacio");
            $conn = sqlsrv_connect( $serverName, $connectionInfo);
            if( $conn ) { 
                //echo "Conectado a la Base de Datos.<br />"; 
            }else{ 
                echo "1NO se puede conectar a la Base de Datos desp.<br />"; 
                die( print_r( sqlsrv_errors(), true)); 
            }
            $sql = "SELECT     A101CODIPONE, A101NOMBPONE, A101CODIENTI, A101CODIESPE, A101CODINUME
                FROM         dbo.T101DAINFOPONE
                WHERE     (A101SECRDESP = 'd') AND (A101FLAGHABI = 'SI')".$sql_enti." ORDER BY A101CODIENTI, A101CODIESPE, A101CODINUME, A101NOMBPONE";
            $params = array();
            $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
            $stmt = sqlsrv_query( $conn, $sql , $params, $options );
            $row_count = sqlsrv_num_rows( $stmt );
            if ($row_count === false)
                echo "Error in retrieveing row count.";
            else
                $i=0;
                while( $row = sqlsrv_fetch_array( $stmt) ) {
                    $vector[$i][codi_pone] = $row['A101CODIPONE'];
                    $vector[$i][nom_pone]  = $row['A101NOMBPONE'];
                    $vector[$i][codi_enti] = $row['A101CODIENTI'];
                    $vector[$i][codi_espe] = $row['A101CODIESPE'];
                    $vector[$i][codi_nume] = $row['A101CODINUME'];
                    $i++; 	  
                }
                // print_r($vector);
                return $vector; 
        } 
        
        // JUAN ESTEBAN MUNERA BETANCUR 19-07-2017
        public function consultar_despachos_CSCF(){
            $bd_c = "consejoPN";
            $serverName = "192.168.89.20";
            $sql_enti = " AND ( (A101CODIENTI='40' AND A101CODIESPE='03') OR (A101CODIENTI='31' AND A101CODIESPE='03') OR (A101CODIENTI='31' AND A101CODIESPE='10') )
                    AND ( (A101NOMBPONE NOT LIKE '%DESCONGESTION%') AND (A101NOMBPONE NOT LIKE '%unicauca%')  )"; 
            $connectionInfo = array( "Database"=>$bd_c, "UID"=>"sa", "PWD"=>"3j3cut1V416");
            //$connectionInfo = array( "Database"=>$bd_c, "UID"=>"sa", "PWD"=>"SA23palacio");
            $conn = sqlsrv_connect( $serverName, $connectionInfo);
            if( $conn ) { 
                //echo "Conectado a la Base de Datos.<br />"; 
            }else{ 
                echo "1NO se puede conectar a la Base de Datos desp.<br />"; 
                die( print_r( sqlsrv_errors(), true)); 
            }
            $sql = "SELECT     A101CODIPONE, A101NOMBPONE, A101CODIENTI, A101CODIESPE, A101CODINUME
                FROM         dbo.T101DAINFOPONE
                WHERE     (A101SECRDESP = 'd') AND (A101FLAGHABI = 'SI')".$sql_enti." ORDER BY A101CODIENTI, A101CODIESPE, A101CODINUME, A101NOMBPONE";
            $params = array();
            $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
            $stmt = sqlsrv_query( $conn, $sql , $params, $options );
            $row_count = sqlsrv_num_rows( $stmt );
            if ($row_count === false)
                echo "Error in retrieveing row count.";
            else
                $i=0;
                while( $row = sqlsrv_fetch_array( $stmt) ) {
                    $vector[$i][codi_pone] = $row['A101CODIPONE'];
                    $vector[$i][nom_pone]  = $row['A101NOMBPONE'];
                    $vector[$i][codi_enti] = $row['A101CODIENTI'];
                    $vector[$i][codi_espe] = $row['A101CODIESPE'];
                    $vector[$i][codi_nume] = $row['A101CODINUME'];
                    $i++; 	  
                }
                // print_r($vector);
                return $vector; 
        }
        public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
            $listar = $this->db->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
            $listar->execute();
            return $listar;
	}
    }
?>