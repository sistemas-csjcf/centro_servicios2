<?php
    class Encuesta{
	private $pdo;
        public $id_encuestado;
        public $calificacion;
        public $observaciones;
        
	public function __CONSTRUCT(){
            try{
                $this->pdo = Database::Conectar();     
            }catch(Exception $e){
                die($e->getMessage());
            }
	}
	public function Listar(){
            try{
                $stm = $this->pdo->prepare("SELECT * FROM encuesta_historial_ad ");
                $stm->execute();

                return $stm->fetchAll(PDO::FETCH_OBJ);
            }catch(Exception $e){
                die($e->getMessage());
            }
	}
	
	public function Registrar(Encuesta $data){
            try {
                $modelo     = new Encuesta();
                $fechahora  = $modelo->get_fecha_actual();
                $datosfecha = explode(" ",$fechahora);
                $fechalog   = $datosfecha[0];
                $horalog    = $datosfecha[1];

                $tiporegistro   = "Encuesta de Satisfacion";
                $accion         = "Registra una Nueva ".$tiporegistro." En el Sistema (SIGNOT/REPARTO) Encuesta Satisfacion";
                $detalle        = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
                $tipolog        = 6;
                $idusuario      = $_POST['id_usuarioR'];
                
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();
                
                if($data->bandera == 1){
                    $sql = "INSERT INTO `encuesta_satisfacion`(`enc_id_user`,`enc_id_user_encuestado`, `enc_fecha`, `enc_calificacion1`, `enc_calificacion2` , `enc_calificacion3`, `enc_observaciones`) 
		        VALUES (?, ?, ?, ? , ? , ?, ?)";
                    $this->pdo->prepare($sql)
                        ->execute(
                            array(
                                $data->id_usuarioR,
                                $data->id_encuestado, 
                                $fechalog, 
                                $data->calificacion1,
								$data->calificacion2,
								$data->calificacion3,
                                utf8_decode($data->observaciones)
                            )
                        );
                }else{
                    $sql_encuestado = "INSERT INTO `encuestado_datos`(`cedula`, `nombre`) 
		        VALUES (?, ?)";
                    $this->pdo->prepare($sql_encuestado)
                        ->execute(
                            array(
                                $data->cedula,
                                utf8_decode($data->nombre)
                            )
                        );
                    $listar = $this->pdo->prepare("SELECT max(id) FROM encuestado_datos");
                    $listar->execute();
                    while($field = $listar->fetch()){
                        $max_id = $field[0];
                    }
                    $sql = "INSERT INTO `encuesta_satisfacion`(`enc_id_user`, `enc_id_user_encuestado`, `enc_fecha`, `enc_calificacion1` , `enc_calificacion2`, `enc_calificacion3`,`enc_observaciones`) 
		        VALUES (?, ?, ?, ? , ? , ?, ?)";
                    $this->pdo->prepare($sql)
                        ->execute(
                            array(
                                $data->id_usuarioR,
                                $max_id, 
                                $fechalog, 
                                $data->calificacion1,
								$data->calificacion2,
								$data->calificacion3,
                                utf8_decode($data->observaciones)
                            )
                        );
                }
                $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
                //SE TERMINA LA TRANSACCION  
                $this->pdo->commit();
            } catch (Exception $e) {
                $this->pdo->rollBack();
                die($e->getMessage());
            }
	    }
        public function get_fecha_actual(){	
            date_default_timezone_set('America/Bogota'); 
            $fecharegistro=date('Y-m-d g:ia'); 
            return $fecharegistro; 
        }
        public function get_lista_usuario_accionesJE($idaccion){
            $listar = $this->pdo->prepare("SELECT * FROM pa_usuario_acciones WHERE id = '.$idaccion.' ORDER BY id ");
            $listar->execute();
            return $listar;
	    }
        public function get_lista_usuario_encuestadores($idaccion){
            $listar = $this->pdo->prepare("SELECT * FROM pa_usuario WHERE id IN ('.$idaccion.') ORDER BY id ");
            $listar->execute();
            return $listar;
        }
        public function Listar_Historial_Encuestas(){
            try{
                $stm = $this->pdo->prepare("SELECT en.enc_id, en.enc_fecha,empleado AS empleado,cli.nombre AS nombre,enc_calificacion,en.enc_observaciones
                                            FROM encuesta_satisfacion AS en
                                            INNER JOIN pa_usuario AS us ON us.id=en.enc_id_user
                                            INNER JOIN encuestado_datos AS cli ON cli.id = en.enc_id_user_encuestado ");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            } 
        }
        public function encuestasXempleado($inicio, $fin){
            try{
                $stm = $this->pdo->prepare("SELECT count(*) AS cantidad,empleado
                    FROM encuesta_satisfacion AS enc
                    INNER JOIN pa_usuario AS us ON us.id = enc.enc_id_user
                    WHERE enc_fecha BETWEEN '$inicio' AND '$fin'
                    GROUP BY  enc_id_user ");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            } 
        }
        public function encuestasXcalificaion($inicio, $fin){
            try{
                $stm = $this->pdo->prepare("SELECT count(*) AS cantidad,enc_calificacion
                    FROM encuesta_satisfacion AS enc
                    WHERE enc_fecha BETWEEN '$inicio' AND '$fin'
                    GROUP BY enc_calificacion");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            } 
        } 
    }