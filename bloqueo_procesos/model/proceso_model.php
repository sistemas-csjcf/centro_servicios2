<?php
    // JUAN ESTEBAN MUNERA BETANCUR
    require_once 'database.php';
    class Proceso{
	private $pdo;
    
        public $id;
        public $Nombre;
        public $Apellido;
        public $Sexo;
        public $FechaRegistro;
        public $FechaNacimiento;
        public $Foto;
        public $Correo;

	public function __CONSTRUCT(){
            try{
                $this->pdo = Database::StartUp();     
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
        
        public function get_dato_usuario($id_us){
            $listar     = $this->pdo->prepare("SELECT * FROM pa_usuario WHERE id = ".$id_us);
            $listar->execute();
            return $listar;
  	}
        
	public function Listar(){
            try{
                $stm = $this->pdo->prepare("SELECT * FROM alumnos");
                $stm->execute();

                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch(Exception $e){
                die($e->getMessage());
            }
        }
        public function Listar_procesos_hoy(){
            date_default_timezone_set('America/Bogota'); 
            $fecha  = date('Y-m-d');
            $hoy    = $fecha." 00:00:00.000";
            $modelo    = new Proceso();
            //JUSTICIA REAL
            $datosbd   = $modelo->get_datos_basededatos(3);
            // SERVER LOCAL
            //$datosbd   = $modelo->get_datos_basededatos(6);

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
            //----------- CONSULTA SQL SERVER REAL ----------
            $sql = ("SELECT * FROM [$datosbd_2].[dbo].[T103DAINFOPROC] 
                    WHERE [A103CODICLAS] IN (0000, 0005, 0013,0014, 0517, 2005, 3001, 3002,3003,3004,3005,3006,3007,3008,3009,3010,3011, 3015,3016, 3051, 3052,3053,3054,3055,3056,3057,3058,3063,3064,3065,3066,3067,3068,3988,3999,5007, 6001,6002,6003,6004,6005,6006,6008,6014,6015,6016,6018,6019,6020,6021,6022,8023,9013,9910,9911,9912,9913,9914,9915) 
                    AND [A103FECHPROC] = '$hoy' 
					AND [A103CODIESPO] IN (03,10)
					ORDER BY [A103HORAPROC] DESC;");
            // CONSULTA SQL SERVER LOCAL 
            //$sql = ("SELECT TOP 10 * FROM [$datosbd_2].[dbo].[T103DAINFOPROC] WHERE [A103CODICLAS] IN (0000, 0005, 0013,0014, 0517, 2005, 3001, 3002,3003,3004,3005,3006,3007,3008,3009,3010,3011, 3015,3016, 3051, 3052,3053,3054,3055,3056,3057,3058,3063,3064,3065,3066,3067,3068,3988,3999,5007, 6001,6002,6003,6004,6005,6006,6008,6014,6015,6016,6018,6019,6020,6021,6022,8023,9013,9910,9911,9912,9913,9914,9915) ;");
            // CONSULTA SQL PRUEBA
            //$sql = ("SELECT * FROM [$datosbd_2].[dbo].[T103DAINFOPROC] WHERE A103LLAVPROC = '17001311000720130009800';");
            $params     = array();
            $options    =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
            $stmt       = sqlsrv_query( $conn, $sql , $params, $options );
            $row_count  = sqlsrv_num_rows( $stmt );
	
            while( $row = sqlsrv_fetch_array($stmt)){
                $radi        = $row['A103LLAVPROC'];
                $fecha       = $row['A103FECHPROC'];
                $bandera     = $row['A103FLAGPROC'];
                $radicados[] = $radi;
                $cadenap.= $radi."//////";
                $cadenaF.= $bandera."---";
            }
            //return $cadenap;
            return array($cadenap, $cadenaF);
        }
        public function get_fecha_actual(){
            date_default_timezone_set('America/Bogota'); 
            $fecharegistro=date('Y-m-d g:ia');
            return $fecharegistro; 	
	}
        
        public function Listar_procesos_filtro(){
            $modelo    = new Proceso();
             //JUSTICIA REAL
            $datosbd   = $modelo->get_datos_basededatos(3);
            // SERVER LOCAL
            //$datosbd   = $modelo->get_datos_basededatos(6);
            $datosbd_b = $datosbd->fetch();
            $datosbd_1 = $datosbd_b[ip];
            $datosbd_2 = $datosbd_b[bd];
            $datosbd_3 = $datosbd_b[usuario];
            $datosbd_4 = $datosbd_b[clave];
	
            $serverName     = $datosbd_1; //serverName\instanceName
            $connectionInfo = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
            $conn           = sqlsrv_connect( $serverName, $connectionInfo);
            
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
            $sql = ("SELECT TOP 5 * FROM [$datosbd_2].[dbo].[T103DAINFOPROC]  WHERE [A103CODICLAS] IN (0000, 0005, 0013,0014, 0517, 2005, 3001, 3002,3003,3004,3005,3006,3007,3008,3009,3010,3011, 3015,3016, 3051, 3052,3053,3054,3055,3056,3057,3058,3063,3064,3065,3066,3067,3068,3988,3999,5007, 6001,6002,6003,6004,6005,6006,6008,6014,6015,6016,6018,6019,6020,6021,6022,8023,9013,9910,9911,9912,9913,9914,9915)  
					AND [A103CODIESPO] IN (03,10)
					ORDER BY [A103FECHPROC] DESC ;");
            $params = array();
            $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
            $stmt = sqlsrv_query( $conn, $sql , $params, $options );
	
            while( $row = sqlsrv_fetch_array( $stmt)){
                $radi       = $row['A103LLAVPROC'];
                $fecha      = $row['A103FECHPROC'];
                $bandera    = $row['A103FLAGPROC'];
                $cadenap.= $radi."//////";   
            }
            return $cadenap;
        }
        public function Ocultar_proceso($radi, $id_usuario){
            $modelo    = new Proceso();
             //JUSTICIA REAL
            $datosbd   = $modelo->get_datos_basededatos(3);
            // SERVER LOCAL
            //$datosbd   = $modelo->get_datos_basededatos(6);
            $datosbd_b = $datosbd->fetch();
            $datosbd_1 = $datosbd_b[ip];
            $datosbd_2 = $datosbd_b[bd];
            $datosbd_3 = $datosbd_b[usuario];
            $datosbd_4 = $datosbd_b[clave];
	
            //DATOS PARA EL REGISTRO DEL LOG
            $fechahora      = $modelo->get_fecha_actual();
            $datosfecha     = explode(" ",$fechahora);
            $fechalog       = $datosfecha[0];
            $horalog        = $datosfecha[1];
            
            $data_usuario   = $modelo->get_dato_usuario($id_usuario);
            $datos_user     = $data_usuario->fetch();
            $nombre_us      = $datos_user['empleado'];
            
            $tiporegistro   = "No Ver Proceso";
            $accion         = "Nuevo Registro ".$tiporegistro." En el Sistema (BLOQUEO PROCESOS) para el RADICADO: ".$radi;
            $detalle        = $nombre_us." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 9;
            try{
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();	
                $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$id_usuario','$tipolog')");	

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
                            echo "message: ".$error['message']."<br />";
                        }
                    }
                    echo "ENTRE 2";
                    $msg_error = "ERROR EN REGISTRO "."SQLSTATE: ".$error[ 'SQLSTATE']."code: ".$error[ 'code']."message: ".$error[ 'message'];
                }
                $sql = ("UPDATE [T103DAINFOPROC] SET A103FLAGPROC = '1'
                    WHERE A103LLAVPROC ='$radi';");
                $params  = array();
                $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                if( $stmt === false ) {
                    $error_transaccion = 1;						
                    if( ($errors = sqlsrv_errors() ) != null) {							
                        foreach( $errors as $error ) {							
                            echo "ERROR EN REGISTRO "."<br />";
                            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                            echo "code: ".$error[ 'code']."<br />";
                            echo "message: ".$error[ 'message']."<br />";
                        }
                    }							
                    echo "ENTRE 3";						
                    $msg_error = "ERROR EN REGISTRO "."SQLSTATE: ".$error[ 'SQLSTATE']."code: ".$error[ 'code']."message: ".$error[ 'message'];							
                }
                if($error_transaccion) {			
                    //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
                    $this->pdo->rollBack();
                    //NO TERMINA LA TRANSACCION ERROR AL INGRESAR LOS DATOS A JUSTICIA XXI
                    sqlsrv_rollback( $conn );
                    // Cerrar la conexión.
                    sqlsrv_close( $conn );
                    echo"<script>alert('Error al intentar BLOQUEAR EL PROCESO')</script>";
                }else{						
                    //SE TERMINA LA TRANSACCION  
                    $this->pdo->commit();			
                    //SE TERMINA LA TRANSACCION JUSTICIA XXI
                    sqlsrv_commit( $conn );						
                    //echo "CORRECTO**********";
                    echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('PROCESO OCULTO CORRECTAMENTE')
                    window.location.href='?c=proceso';
                    </SCRIPT>");
                }
            } catch (Exception $e) {
                //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
                $this->pdo->rollBack();
                //echo "Fallo: " . $e->getMessage();
                //NO TERMINA LA TRANSACCION ERROR AL INGRESAR LOS DATOS A JUSTICIA XXI
                sqlsrv_rollback( $conn );								
                // Cerrar la conexión.
                sqlsrv_close( $conn );
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                        window.alert('Error al intentar BLOQUEAR EL PROCESO')
                        window.location.href='?c=proceso';
                    </SCRIPT>");
            }
        }
        
        public function Ver_proceso($radi, $id_usuario){
            $modelo    = new Proceso();
            //JUSTICIA REAL
            $datosbd   = $modelo->get_datos_basededatos(3);
            // SERVER LOCAL
            //$datosbd   = $modelo->get_datos_basededatos(6);
            $datosbd_b = $datosbd->fetch();
            $datosbd_1 = $datosbd_b[ip];
            $datosbd_2 = $datosbd_b[bd];
            $datosbd_3 = $datosbd_b[usuario];
            $datosbd_4 = $datosbd_b[clave];
            
            //DATOS PARA EL REGISTRO DEL LOG
            $fechahora      = $modelo->get_fecha_actual();
            $datosfecha     = explode(" ",$fechahora);
            $fechalog       = $datosfecha[0];
            $horalog        = $datosfecha[1];
            
            $data_usuario   = $modelo->get_dato_usuario($id_usuario);
            $datos_user     = $data_usuario->fetch();
            $nombre_us      = $datos_user['empleado'];
            
            $tiporegistro   = "Ver Proceso";
            $accion         = "Nuevo Registro ".$tiporegistro." En el Sistema (BLOQUEO PROCESOS) para el RADICADO: ".$radi;
            $detalle        = $nombre_us." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 9;
            try{
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);			
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();	
                $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$id_usuario','$tipolog')");	

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
                            echo "message: ".$error['message']."<br />";
                        }
                    }
                    echo "ENTRE 2";
                    $msg_error = "ERROR EN REGISTRO "."SQLSTATE: ".$error[ 'SQLSTATE']."code: ".$error[ 'code']."message: ".$error[ 'message'];						 
                }
                $sql = ("UPDATE T103DAINFOPROC SET A103FLAGPROC = '0'
                    WHERE A103LLAVPROC ='$radi';");
                $params  = array();
                $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                if( $stmt === false ) {
                    $error_transaccion = 1;						
                    if( ($errors = sqlsrv_errors() ) != null) {							
                        foreach( $errors as $error ) {							
                            echo "ERROR EN REGISTRO "."<br />";
                            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                            echo "code: ".$error[ 'code']."<br />";
                            echo "message: ".$error[ 'message']."<br />";
                        }
                    }							
                    echo "ENTRE 3";						
                    $msg_error = "ERROR EN REGISTRO "."SQLSTATE: ".$error[ 'SQLSTATE']."code: ".$error[ 'code']."message: ".$error[ 'message'];							
                }
                if($error_transaccion) {			
                    //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
                    $this->pdo->rollBack();
                    //NO TERMINA LA TRANSACCION ERROR AL INGRESAR LOS DATOS A JUSTICIA XXI
                    sqlsrv_rollback( $conn );
                    // Cerrar la conexión.
                    sqlsrv_close( $conn );
                    echo"<script>alert('Error al intentar DESBLOQUEAR EL PROCESO')</script>";
                }else{						
                    //SE TERMINA LA TRANSACCION  
                    $this->pdo->commit();			
                    //SE TERMINA LA TRANSACCION JUSTICIA XXI
                    sqlsrv_commit( $conn );						
                    //echo "CORRECTO**********";
                    echo ("<SCRIPT LANGUAGE='JavaScript'>
                        window.alert('PROCESO DESBLOQUEADO CORRECTAMENTE')
                        window.location.href='?c=proceso';
                    </SCRIPT>");
                }
            } catch (Exception $e) {
                //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
                $this->pdo->rollBack();
                //echo "Fallo: " . $e->getMessage();
                //NO TERMINA LA TRANSACCION ERROR AL INGRESAR LOS DATOS A JUSTICIA XXI
                sqlsrv_rollback( $conn );								
                // Cerrar la conexión.
                sqlsrv_close( $conn );
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                        window.alert('Error al intentar DESBLOQUEAR EL PROCESO')
                        window.location.href='?c=proceso';
                    </SCRIPT>");
            }
        }
        
        public function Ocultar_Conjunto($arreglo, $id_usuario){ 
            $modelo    = new Proceso();
            //JUSTICIA REAL
            $datosbd   = $modelo->get_datos_basededatos(3);
            // SERVER LOCAL
            //$datosbd   = $modelo->get_datos_basededatos(6);
            $datosbd_b = $datosbd->fetch();
            $datosbd_1 = $datosbd_b[ip];
            $datosbd_2 = $datosbd_b[bd];
            $datosbd_3 = $datosbd_b[usuario];
            $datosbd_4 = $datosbd_b[clave];

            //DATOS PARA EL REGISTRO DEL LOG
            $fechahora      = $modelo->get_fecha_actual();
            $datosfecha     = explode(" ",$fechahora);
            $fechalog       = $datosfecha[0];
            $horalog        = $datosfecha[1];
           
            $data_usuario   = $modelo->get_dato_usuario($id_usuario);
            $datos_user     = $data_usuario->fetch();
            $nombre_us      = $datos_user['empleado'];
            
            $tiporegistro   = "No Ver Conjunto Procesos";
            $accion         = "Nuevo Registro ".$tiporegistro." En el Sistema (BLOQUEO PROCESOS) log_conjunto_radicados: ";
            $detalle        = $nombre_us." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 9;
            $arr = explode ("'", $arreglo);
            $arr = explode(",", $arreglo);
            $arr_radi = implode("", $arr);
            try{   
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);			
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();	
                
                $this->pdo->exec("INSERT INTO log_conjunto_radicados (conra_radicados,conra_estado, conra_id_usuario) VALUES ($arr_radi,'Bloqueados', '$id_usuario')");
                $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$id_usuario','$tipolog')");
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
                            echo "message: ".$error['message']."<br />";
                        }
                    }
                    echo "ENTRE 2";
                    $msg_error = "ERROR EN REGISTRO "."SQLSTATE: ".$error[ 'SQLSTATE']."code: ".$error[ 'code']."message: ".$error[ 'message'];
                }
                $sql = ("UPDATE [T103DAINFOPROC] 
                        SET A103FLAGPROC = '1'
                        WHERE A103LLAVPROC IN ($arreglo);");
                $params  = array();
                $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                if( $stmt === false ) {
                    $error_transaccion = 1;						
                    if( ($errors = sqlsrv_errors() ) != null) {							
                        foreach( $errors as $error ) {							
                            echo "ERROR EN REGISTRO "."<br />";
                            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                            echo "code: ".$error[ 'code']."<br />";
                            echo "message: ".$error[ 'message']."<br />";
                        }
                    }							
                    echo "ENTRE 3";						
                    $msg_error = "ERROR EN REGISTRO "."SQLSTATE: ".$error[ 'SQLSTATE']."code: ".$error[ 'code']."message: ".$error[ 'message'];							
                }
                if($error_transaccion) {			
                    //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
                    $this->pdo->rollBack();
                    //NO TERMINA LA TRANSACCION ERROR AL INGRESAR LOS DATOS A JUSTICIA XXI
                    sqlsrv_rollback( $conn );
                    // Cerrar la conexión.
                    sqlsrv_close( $conn );
                    echo"<script>alert('Error(1) al intentar BLOQUEAR EL CONJUNTO DE PROCESOS')</script>";
                }else{						
                    //SE TERMINA LA TRANSACCION  
                    $this->pdo->commit();			
                    //SE TERMINA LA TRANSACCION JUSTICIA XXI
                    sqlsrv_commit( $conn );						
                    //echo "CORRECTO**********";
                    echo ("<SCRIPT LANGUAGE='JavaScript'>
                        window.alert('PROCESOS OCULTOS CORRECTAMENTE')
                        window.location.href='?c=proceso';
                    </SCRIPT>");
                }
            }catch(Exception $e){
                //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
                $this->pdo->rollBack();
                //NO TERMINA LA TRANSACCION ERROR AL INGRESAR LOS DATOS A JUSTICIA XXI
                sqlsrv_rollback( $conn );								
                // Cerrar la conexión.
                sqlsrv_close( $conn );
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Error al intentar BLOQUEAR LOS PROCESOS')
                    window.location.href='?c=proceso';
                </SCRIPT>");
            }
            
        }
        
        public function Ver_Conjunto($arreglo, $id_usuario){ 
            $modelo    = new Proceso();
            //JUSTICIA REAL
            $datosbd   = $modelo->get_datos_basededatos(3);
            // SERVER LOCAL
            //$datosbd   = $modelo->get_datos_basededatos(6);
            $datosbd_b = $datosbd->fetch();
            $datosbd_1 = $datosbd_b[ip];
            $datosbd_2 = $datosbd_b[bd];
            $datosbd_3 = $datosbd_b[usuario];
            $datosbd_4 = $datosbd_b[clave];

            //DATOS PARA EL REGISTRO DEL LOG
            $fechahora      = $modelo->get_fecha_actual();
            $datosfecha     = explode(" ",$fechahora);
            $fechalog       = $datosfecha[0];
            $horalog        = $datosfecha[1];
           
            $data_usuario   = $modelo->get_dato_usuario($id_usuario);
            $datos_user     = $data_usuario->fetch();
            $nombre_us      = $datos_user['empleado'];
            
            $tiporegistro   = "Ver Conjunto Procesos";
            $accion         = "Nuevo Registro ".$tiporegistro." En el Sistema (BLOQUEO PROCESOS) log_conjunto_radicados: ";
            $detalle        = $nombre_us." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 9;
            $arr = explode ("'", $arreglo);
            $arr = explode(",", $arreglo);
            $arr_radi = implode("", $arr);
            try{   
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);			
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();	
                
                $this->pdo->exec("INSERT INTO log_conjunto_radicados (conra_radicados,conra_estado,conra_id_usuario) VALUES ($arr_radi,'Desbloqueados','$id_usuario')");
                $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$id_usuario','$tipolog')");
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
                            echo "message: ".$error['message']."<br />";
                        }
                    }
                    echo "ENTRE 2";
                    $msg_error = "ERROR EN REGISTRO "."SQLSTATE: ".$error[ 'SQLSTATE']."code: ".$error[ 'code']."message: ".$error[ 'message'];
                }
                $sql = ("UPDATE [T103DAINFOPROC] 
                        SET A103FLAGPROC = '0'
                        WHERE A103LLAVPROC IN ($arreglo);");
                $params  = array();
                $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                if( $stmt === false ) {
                    $error_transaccion = 1;						
                    if( ($errors = sqlsrv_errors() ) != null) {							
                        foreach( $errors as $error ) {							
                            echo "ERROR EN REGISTRO "."<br />";
                            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                            echo "code: ".$error[ 'code']."<br />";
                            echo "message: ".$error[ 'message']."<br />";
                        }
                    }							
                    echo "ENTRE 3";						
                    $msg_error = "ERROR EN REGISTRO "."SQLSTATE: ".$error[ 'SQLSTATE']."code: ".$error[ 'code']."message: ".$error[ 'message'];							
                }
                if($error_transaccion) {			
                    //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
                    $this->pdo->rollBack();
                    //NO TERMINA LA TRANSACCION ERROR AL INGRESAR LOS DATOS A JUSTICIA XXI
                    sqlsrv_rollback( $conn );
                    // Cerrar la conexión.
                    sqlsrv_close( $conn );
                    echo"<script>alert('Error(1) al intentar DESBLOQUEAR EL CONJUNTO DE PROCESOS')</script>";
                }else{						
                    //SE TERMINA LA TRANSACCION  
                    $this->pdo->commit();			
                    //SE TERMINA LA TRANSACCION JUSTICIA XXI
                    sqlsrv_commit( $conn );						
                    //echo "CORRECTO**********";
                    echo ("<SCRIPT LANGUAGE='JavaScript'>
                        window.alert('PROCESOS DESBLOQUEADOS CORRECTAMENTE')
                        window.location.href='?c=proceso';
                    </SCRIPT>");
                }
            }catch(Exception $e){
                //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
                $this->pdo->rollBack();
                //NO TERMINA LA TRANSACCION ERROR AL INGRESAR LOS DATOS A JUSTICIA XXI
                sqlsrv_rollback( $conn );								
                // Cerrar la conexión.
                sqlsrv_close( $conn );
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Error al intentar DESBLOQUEAR LOS PROCESOS')
                    window.location.href='?c=proceso';
                </SCRIPT>");
            } 
        }
        //***********************************************************************************************************************************//        
        public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
            $listar     = $this->pdo->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
            $listar->execute();
            return $listar;
	}	
    }
// JUAN ESTEBAN MUNERA BETANCUR