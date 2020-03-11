<?php
    class Prestamo{
	private $pdo;
    
        public $id;
        public $fecha;
        public $radicado;
        public $id_usuario;
        public $ponente;
        public $clase_proceso;
        public $sub_clase;
        public $obs_archivo;
        public $observaciones;
        public $bandera;
        public $demandante;
        public $demandado;

	public function __CONSTRUCT(){
            try{
                $this->pdo = Database::Conectar();     
            }catch(Exception $e){
                die($e->getMessage());
            }
	}
	public function Listar(){
            try{
                $stm = $this->pdo->prepare("SELECT * FROM archivo_prestamo_Proceso");
                $stm->execute();

                return $stm->fetchAll(PDO::FETCH_OBJ);
            }catch(Exception $e){
                die($e->getMessage());
            }
	}
        public function ListarPendientes(){
            try{
                $stm = $this->pdo->prepare("SELECT `pre_id`, `pre_id_usuario`, `pre_fecha`, `pre_id_juzgado`, `pre_juzgado`, `pre_radicado`, `pre_tipo_proceso`, 
                        `pre_clase_proceso`, `pre_subclase_proceso`, `pre_demandante`, `pre_demandado`, `pre_info_archivo`, `pre_fecha1_ac_cs` AS fecha1,
                        `pre_id_user_fecha1`, `pre_fecha2_cs_juz` AS fecha2, `pre_id_user_fecha2`, `pre_fecha3_juz_cs` AS fecha3, `pre_id_user_fecha3`, 
                        `pre_fecha4_cs_ac` AS fecha4, `pre_id_user_fecha4`, `pre_id_usuarioE`, `pre_fechaE`, `pre_observaciones`, `pre_flag`,
                        us.id, us.empleado AS usuario, us1.empleado AS usuario1, us2.empleado AS usuario2, us3.empleado AS usuario3,
                        us4.empleado AS usuario4, us5.empleado AS usuario_edit_fecha0, pre_id_user_edit_fecha0, pre_observacion_fecha0 
                    FROM archivo_prestamo_Proceso AS pres
                    INNER JOIN pa_usuario AS us ON pres.pre_id_usuario = us.id
                    LEFT JOIN pa_usuario AS us1 ON pres.pre_id_user_fecha1 = us1.id
                    LEFT JOIN pa_usuario AS us2 ON pres.pre_id_user_fecha2 = us2.id
                    LEFT JOIN pa_usuario AS us3 ON pres.pre_id_user_fecha3 = us3.id
                    LEFT JOIN pa_usuario AS us4 ON pres.pre_id_user_fecha4 = us4.id  
                    LEFT JOIN pa_usuario AS us5 ON pres.pre_id_user_edit_fecha0 = us5.id 
                    WHERE pre_flag < 1");
                $stm->execute();

                return $stm->fetchAll(PDO::FETCH_OBJ);
            }catch(Exception $e){
                die($e->getMessage());
            }
	}
        public function Listar_proceso($id){
            try{
                $stm = $this->pdo->prepare("                
                    SELECT `pre_id`, `pre_id_usuario`, `pre_fecha`, `pre_id_juzgado`, `pre_juzgado`, `pre_radicado`, `pre_tipo_proceso`, 
                        `pre_clase_proceso`, `pre_subclase_proceso`, `pre_demandante`, `pre_demandado`, `pre_info_archivo`, `pre_fecha1_ac_cs`,
                        `pre_id_user_fecha1`, `pre_fecha2_cs_juz`, `pre_id_user_fecha2`, `pre_fecha3_juz_cs`, `pre_id_user_fecha3`, 
                        `pre_fecha4_cs_ac`, `pre_id_user_fecha4`, `pre_id_usuarioE`, `pre_fechaE`, `pre_observaciones`, `pre_flag`,
                        us.id, us.empleado AS usuario, us1.empleado AS usuario1, us2.empleado AS usuario2, us3.empleado AS usuario3,
                        us4.empleado AS usuario4
                    FROM archivo_prestamo_Proceso AS pres
                    INNER JOIN pa_usuario AS us ON pres.pre_id_usuario = us.id
                    LEFT JOIN pa_usuario AS us1 ON pres.pre_id_user_fecha1 = us1.id
                    LEFT JOIN pa_usuario AS us2 ON pres.pre_id_user_fecha2 = us2.id
                    LEFT JOIN pa_usuario AS us3 ON pres.pre_id_user_fecha3 = us3.id
                    LEFT JOIN pa_usuario AS us4 ON pres.pre_id_user_fecha4 = us4.id 
                    WHERE pre_id='$id' AND pre_flag <1");
                $stm->execute();

                return $stm->fetchAll(PDO::FETCH_OBJ);
            }catch(Exception $e){
                die($e->getMessage());
            }
	}
        public function Registrar(Prestamo $data){
            $modelo         = new Prestamo();
            //DATOS PARA EL REGISTRO DEL LOG
            $fechahora      = $modelo->get_fecha_actual();
            $datosfecha     = explode(" ",$fechahora);
            $fechalog       = $datosfecha[0];
            $horalog        = $datosfecha[1];
            
            $data_usuario   = $modelo->get_dato_usuario($data->id_usuario);
            $datos_user     = $data_usuario->fetch();
            $nombre_us      = $datos_user['empleado'];
            
            $tiporegistro   = "Solicitud Prestamo Proceso";
            $accion         = "Nuevo Registro ".$tiporegistro." En el Sistema (ARCHIVO) ";
            $detalle        = $nombre_us." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 1;
            try {
                $sql = "INSERT INTO `archivo_prestamo_proceso`(`pre_id_usuario`, `pre_fecha`, `pre_id_juzgado`, `pre_juzgado`, `pre_radicado`,
                            `pre_tipo_proceso`,`pre_clase_proceso`, `pre_subclase_proceso`, `pre_demandante`, `pre_demandado`, 
                            `pre_info_archivo`, `pre_observaciones`,pre_flag) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                $this->pdo->prepare($sql)
                    ->execute(
                    array(
                        $data->id_usuario,
                        date('Y-m-d'), 
                        0,
                        $data->ponente,
                        $data->radicado, 
                        $data->tipo_proceso,
                        $data->clase_proceso,
                        $data->sub_clase,
                        $data->demandante,
                        $data->demandado,
                        $data->obs_archivo,
                        $data->observaciones,
                        0
                    )
                );
                $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$data->id_usuario','$tipolog')");	
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
	public function Obtener($id){
            try {
                $stm = $this->pdo
                    ->prepare("SELECT * FROM archivo_prestamo_proceso WHERE pre_id = ?");
                $stm->execute(array($id));
                return $stm->fetch(PDO::FETCH_OBJ);
            } catch (Exception $e){
                die($e->getMessage());
            }
	}
	public function Eliminar($id,$radicado){
            session_start();
            $id_user = $_SESSION['idUsuario'];
            $modelo         = new Prestamo();
            //DATOS PARA EL REGISTRO DEL LOG
            $fechahora      = $modelo->get_fecha_actual();
            $datosfecha     = explode(" ",$fechahora);
            $fechalog       = $datosfecha[0];
            $horalog        = $datosfecha[1];
            
            $data_usuario   = $modelo->get_dato_usuario($id_user);
            $datos_user     = $data_usuario->fetch();
            $nombre_us      = $datos_user['empleado'];
            
            $tiporegistro   = "Solicitud Prestamo Proceso";
            $accion         = "Elimina Registro ".$tiporegistro." En el Sistema (ARCHIVO) para el ID: ".$id." ,radicado: ".$radicado;
            $detalle        = $nombre_us." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 1;
            try {
                
                $stm = $this->pdo
                        ->prepare("DELETE FROM archivo_prestamo_proceso WHERE pre_id = ?");			          
                $stm->execute(array($id));
                $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$id_user','$tipolog')");	
            } catch (Exception $e) {
                die($e->getMessage());
            }
	}
	public function Actualizar($data){
            $modelo         = new Prestamo();
            //DATOS PARA EL REGISTRO DEL LOG
            $fechahora      = $modelo->get_fecha_actual();
            $datosfecha     = explode(" ",$fechahora);
            $fechalog       = $datosfecha[0];
            $horalog        = $datosfecha[1];
            
            $data_usuario   = $modelo->get_dato_usuario($data->id_usuario);
            $datos_user     = $data_usuario->fetch();
            $nombre_us      = $datos_user['empleado'];
            
            $tiporegistro   = "Fecha Prestamo Proceso";
            $accion         = "Nueva Actualiación ".$tiporegistro." En el Sistema (ARCHIVO) ";
            $detalle        = $nombre_us." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 1;
            try {
                $sql = "UPDATE archivo_prestamo_proceso SET 
                            `pre_fecha1_ac_cs`      = ?,
                            `pre_id_user_fecha1`    = ?,
                            `pre_fecha2_cs_juz`     = ?,
                            `pre_id_user_fecha2`    = ?,
                            `pre_fecha3_juz_cs`     = ?,
                            `pre_id_user_fecha3`    = ?,
                            `pre_fecha4_cs_ac`      = ?,
                            `pre_id_user_fecha4`    = ?,
                            `pre_id_usuarioE`       = ?,
                            `pre_fechaE`            = ?,
                            `pre_flag`              = ?
                        WHERE pre_id = ?";
                $this->pdo->prepare($sql)
                    ->execute(
                        array(
                            $data->fecha1, 
                            $data->user1,
                            $data->fecha2,
                            $data->user2,
                            $data->fecha3,
                            $data->user3,
                            $data->fecha4,
                            $data->user4,
                            $data->id_usuario,
                            $fechalog,
                            $data->flag,
                            $data->id
                        )
                    );
                $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$data->id_usuario','$tipolog')");	
            } catch (Exception $e) {
                die($e->getMessage());
            }
	}
        public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
            $listar = $this->pdo->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
            $listar->execute();
            return $listar;
	}
        public function get_fecha_actual(){
            date_default_timezone_set('America/Bogota'); 
            $fecharegistro=date('Y-m-d g:ia');
            return $fecharegistro; 	
	}
        public function get_dato_usuario($id_us){
            $listar     = $this->pdo->prepare("SELECT * FROM pa_usuario WHERE id = ".$id_us);
            $listar->execute();
            return $listar;
  	}
        public function get_Juzgado(){
            $listar     = $this->pdo->prepare("SELECT * FROM pa_juzgado; ");
            $listar->execute();
            return $listar;
        }

        public function Editar_Fecha_Cero($miPrestamo)
        {
            try
            {
                $sql = "UPDATE archivo_prestamo_proceso SET 
                          pre_fecha               = ?, 
                          pre_id_user_edit_fecha0 = ?, 
                          pre_observacion_fecha0  = ? 
                        WHERE pre_id              = ?;";
                $this->pdo->prepare($sql)->execute(array(
                       $miPrestamo->fecha, 
                       $miPrestamo->id_usuario,
                       $miPrestamo->observacion,
                       $miPrestamo->id));
            }
            catch(Exception $e)
            {
                die($e->getMessage());
            }
        }

        public function ListarPendientes2()
        {
            try
            {
                $stm = $this->pdo->prepare("SELECT `pre_id`, `pre_id_usuario`, `pre_fecha`, `pre_id_juzgado`, `pre_juzgado`, `pre_radicado`, `pre_tipo_proceso`, 
                        `pre_clase_proceso`, `pre_subclase_proceso`, `pre_demandante`, `pre_demandado`, `pre_info_archivo`, `pre_fecha1_ac_cs` AS fecha1,
                        `pre_id_user_fecha1`, `pre_fecha2_cs_juz` AS fecha2, `pre_id_user_fecha2`, `pre_fecha3_juz_cs` AS fecha3, `pre_id_user_fecha3`, 
                        `pre_fecha4_cs_ac` AS fecha4, `pre_id_user_fecha4`, `pre_id_usuarioE`, `pre_fechaE`, `pre_observaciones`, `pre_flag`,
                        us.id, us.empleado AS usuario, us1.empleado AS usuario1, us2.empleado AS usuario2, us3.empleado AS usuario3,
                        us4.empleado AS usuario4, us5.empleado AS usuario_edit_fecha0, pre_id_user_edit_fecha0, pre_observacion_fecha0 
                    FROM archivo_prestamo_Proceso AS pres
                    INNER JOIN pa_usuario AS us ON pres.pre_id_usuario = us.id
                    LEFT JOIN pa_usuario AS us1 ON pres.pre_id_user_fecha1 = us1.id
                    LEFT JOIN pa_usuario AS us2 ON pres.pre_id_user_fecha2 = us2.id
                    LEFT JOIN pa_usuario AS us3 ON pres.pre_id_user_fecha3 = us3.id
                    LEFT JOIN pa_usuario AS us4 ON pres.pre_id_user_fecha4 = us4.id  
                    LEFT JOIN pa_usuario AS us5 ON pres.pre_id_user_edit_fecha0 = us5.id 
                    WHERE pre_flag < 1");
                $stm->execute();

                return $stm;
            }
            catch(Exception $e)
            {
                die($e->getMessage());
            }
        }
    }