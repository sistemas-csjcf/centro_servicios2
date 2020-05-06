<?php
    // JUAN ESTEBAN MUNERA BETANCUR
    require_once 'database.php';
    class Permisos{
	private $pdo;
    
        public $id;
        public $institucion;
        public $titulo;
        public $per_fecha_inicio;
        public $per_fecha_fin;
        public $per_hora_inicio;
        public $per_hora_fin;
        public $per_ruta_comprobante;
        public $estado;
        public $id_usuario;
        

        public function __CONSTRUCT(){
            try{
                $this->pdo = Database::StartUp();     
            }catch(Exception $e){
                die($e->getMessage());
            }
	}
        public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
            $listar = $this->pdo->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
            $listar->execute();
            return $listar;
	}
        public function ListarPermisos(){
            try{
                $stm = $this->pdo->prepare("SELECT * FROM th_solicitudes_permisos");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        public function Obtener($id){
            try{
                $stm = $this->pdo
                        ->prepare("SELECT * FROM th_solicitudes_permisos WHERE sol_per_id = ?");
                $stm->execute(array($id));
                    return $stm->fetch(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        public function Obtener_datos_visita($id){
            $listar = $this->pdo->prepare("SELECT *
                                            FROM visitas_programacion AS prog
                                            INNER JOIN visitas_trabajador_social AS ts
                                            ON prog.`vis_pro_id_TSocial` = ts.vis_TSoci_id 
                                        WHERE prog.vis_pro_id = '$id'");
            $listar->execute();
            return $listar;
	}
        public function Actualizar($data){
            try {
                $sql = "UPDATE visitas_programacion SET 
                    vis_pro_radicado = ?, 
                    vis_pro_fecha_visita = ?,
                    vis_pro_comentarios = ?,
                    
                    WHERE vis_pro_id = ?";

                $this->pdo->prepare($sql)
                ->execute(
                    array(  
                        $data->radicado,
                        $data->fecha_visita,
                        $data->comentarios,
                        
                        $data->id
                    )
                );
            } catch (Exception $e) {
                die($e->getMessage());
            }
	} 
        
        public function Registrar(Visita $data){
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new Visita();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            
            $tiporegistro   = "Solicitud Visita T. Social";
            $accion         = "Registra una Nueva ".$tiporegistro." En el Sistema (T. Social) TRABAJO SOCIAL";
            $detalle        = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 10;
            $idusuario      = $_POST['id_usuarioR'];
            
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();

                $sql = "INSERT INTO visitas_programacion 
                    (vis_pro_radicado,vis_pro_solicitante,vis_pro_fecha_visita,vis_pro_comentarios,vis_pro_clase_proceso,vis_pro_subclase_proceso,vis_pro_datos_partes,vis_pro_id_TSocial,vis_pro_id_usuario,vis_pro_estado,vis_pro_finalizada) 
                    VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->radicado,
                        $data->solicitante,
                        $data->fecha_visita,
                        $data->comentarios,
                        $data->clase_proceso,
                        $data->sub_clase,
                        $data->datos_partes,
                        $data->id_TSocial,
                        $data->id_usuario,
                        $data->estado,
                        $data->finalizada
                    )
                ); 
                $query="UPDATE visitas_trabajador_social 
                    SET vis_TSoci_contador = ?
                    WHERE vis_TSoci_id = ?";
                $this->pdo->prepare($query)
                ->execute(
                    array(  
                        $data->contadorTS+1,
                        $data->id_TSocial
                    )
                );
                $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
                
                //SE TERMINA LA TRANSACCION  
                $this->pdo->commit();
            } catch (Exception $e) {
                $this->pdo->rollBack();
                die($e->getMessage());
            }
        }    
        public function Eliminar($id){
            try{
                $stm = $this->pdo
	        ->prepare("DELETE FROM visitas_programacion WHERE vis_pro_id = ?");

                $stm->execute(array($id));
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        public function Aprobar($id,$us){
            //DATOS PARA EL REGISTRO DEL LOG
            session_start();
            $modelo     = new Visita();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            $data_usuario   = $modelo->get_dato_usuario($_SESSION['idUsuario']);
            $datos_user     = $data_usuario->fetch();
            $nombre_us      = $datos_user['empleado'];
            $tiporegistro   = "Aprobación de Solicitud Visita T. Social";
            $accion         = "Registra una Nueva ".$tiporegistro." En el Sistema (T. Social) TRABAJO SOCIAL";
            $detalle        = $nombre_us." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 10;
            $idusuario      = $us;
            $fechaEstado    = date('Y-m-d');
            
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();
                $stm = $this->pdo
                ->prepare("UPDATE visitas_programacion 
                            SET vis_pro_estado = 'Aprobada',
                            vis_pro_fechaEstado = '$fechaEstado',
                             vis_pro_id_usuarioE = ?
                            WHERE vis_pro_id = ?");
                $stm->execute(array($us,$id));
                $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
                //SE TERMINA LA TRANSACCION  
                $this->pdo->commit();
            }  catch (Exception $e){
                $this->pdo->rollBack();
                die($e->getMessage());
            }
        }
        
        public function Cancelar_visita($motivo,$id,$id_user, $idTSocial){
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new Visita();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            $data_usuario   = $modelo->get_dato_usuario($_SESSION['idUsuario']);
            $datos_user     = $data_usuario->fetch();
            $nombre_us      = $datos_user['empleado'];
            $tiporegistro   = "Cancelaciòn de Solicitud Visita T. Social";
            $accion         = "Registra una Nueva ".$tiporegistro." En el Sistema (T. Social) TRABAJO SOCIAL";
            $detalle        = $nombre_us." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 10;
            $idusuario      = $id_user;
            $fechaEstado    = date('Y-m-d');
            //echo "mot ".$motivo." idus ".$id_user." id ".$id." idts ".$idTSocial;
            try{
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();
                $this->pdo->exec("UPDATE visitas_programacion 
                            SET vis_pro_estado = 'Cancelada',
                                vis_pro_motivo = '$motivo',
                                vis_pro_fechaEstado = '$fechaEstado',
                                vis_pro_id_usuarioE = '$id_user'
                            WHERE vis_pro_id = '$id'");
                
                $this->pdo->exec("UPDATE visitas_trabajador_social SET vis_TSoci_contador = vis_TSoci_contador-1
                          WHERE vis_TSoci_id = '$idTSocial'");
                
                $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
                //SE TERMINA LA TRANSACCION 
                $this->pdo->commit();
            }catch (Exception $e){
                $this->pdo->rollBack();
                die($e->getMessage());
            }
        }
        public function CambiarTSocialVisita($id, $idTSocial, $idtsocialNew){
            //DATOS PARA EL REGISTRO DEL LOG
            session_start();
            $id_usuario     = $_SESSION['idUsuario'];
            $modelo         = new Visita();
            $fechahora      = $modelo->get_fecha_actual();
            $datosfecha     = explode(" ",$fechahora);
            $fechalog       = $datosfecha[0];
            $horalog        = $datosfecha[1];
            $data_usuario   = $modelo->get_dato_usuario($_SESSION['idUsuario']);
            $datos_user     = $data_usuario->fetch();
            $nombre_us      = $datos_user['empleado'];
            $tiporegistro   = "Cambio de Asistente Social";
            $accion         = "Registra un Nuevo ".$tiporegistro." En el Sistema (T. Social) TRABAJO SOCIAL";
            $detalle        = $nombre_us." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 10;
            $idusuario      = $id_usuario;
            //echo "datos id ".$id." ts ant ".$idTSocial." idN ".$idtsocialNew;
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();
                $this->pdo->exec("UPDATE visitas_programacion 
                            SET vis_pro_id_TSocial = '$idtsocialNew',
                                vis_pro_id_usuarioE = '$id_usuario'
                            WHERE vis_pro_id = '$id'");
                
                $this->pdo->exec("UPDATE visitas_trabajador_social SET vis_TSoci_contador = vis_TSoci_contador+1
                          WHERE vis_TSoci_id = '$idtsocialNew'");
                
                $this->pdo->exec("UPDATE visitas_trabajador_social SET vis_TSoci_contador = vis_TSoci_contador-1
                          WHERE vis_TSoci_id = '$idTSocial'");
                
                $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
                //SE TERMINA LA TRANSACCION 
                $this->pdo->commit();
            } catch (Exception $e){
                $this->pdo->rollBack();
                die($e->getMessage());
            }
            
        }
        public function Listar_Historial(){
            try{
                $id_usuario           = $_SESSION['idUsuario'];
                $modelo               = new Visita();
                $campos               = 'usuario';
                $nombrelista          = 'pa_usuario_acciones';
                $idaccion             = '20';
                $campoordenar         = 'id';
                $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
                $usuarios             = $datosusuarioacciones->fetch();
                $usuariosa            = explode("////",$usuarios[usuario]);
                
                if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
                    $stm = $this->pdo->prepare("SELECT * FROM visitas_historial_admin");
                }else{
                    $stm = $this->pdo->prepare("CALL Listar_Historial_Visitas('$id_usuario')");
                }
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        public function Listar_Visitas_TS(){ 
            try{
                $id_usuario = $_SESSION['idUsuario'];
                $stm = $this->pdo->prepare("CALL Listar_VisitasTS_Aprobadas('$id_usuario')");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }    
        }
        public function Finalizar($id,$us){
            //DATOS PARA EL REGISTRO DEL LOG
            session_start();
            $modelo     = new Visita();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            $data_usuario   = $modelo->get_dato_usuario($_SESSION['idUsuario']);
            $datos_user     = $data_usuario->fetch();
            $nombre_us      = $datos_user['empleado'];
            
            $tiporegistro   = "Finalización de Solicitud Visita T. Social";
            $accion         = "Registra una Nueva ".$tiporegistro." En el Sistema (T. Social) TRABAJO SOCIAL";
            $detalle        = $nombre_us." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 10;
            $idusuario      = $us;
            
            $_SESSION['nombre'];
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();
                $stm = $this->pdo
                ->prepare("UPDATE visitas_programacion 
                            SET vis_pro_finalizada = '1',
                             vis_pro_id_usuarioE = ?
                            WHERE vis_pro_id = ?");
               $stm->execute(array($us,$id));
               // REGISTRO INFORME SEGUIMIENTO
               $this->pdo->exec("INSERT INTO visitas_informe_seguimiento (vis_inf_id_visProgramacion, vis_inf_log, vis_inf_enviado) VALUES ('$id', '0','0')");
               // REGISTRO LOG
               $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
               //SE TERMINA LA TRANSACCION  
                $this->pdo->commit();
            }  catch (Exception $e){
                $this->pdo->rollBack();
                die($e->getMessage());
            }
        }
        public function Listar_Historial_TS(){ 
            $id_usuario = $_SESSION['idUsuario'];
                $stm = $this->pdo->prepare("CALL Listar_Historial_Visitas_TS('$id_usuario')");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        public function get_lista_TSocial(){
            $listar     = $this->pdo->prepare("SELECT * FROM visitas_trabajador_social WHERE vis_TSoci_estado = '1' ORDER BY vis_TSoci_contador DESC");
            $listar->execute();
            return $listar;
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
        public function get_fecha_actual(){	
            date_default_timezone_set('America/Bogota'); 
            $fecharegistro=date('Y-m-d g:ia'); 
            return $fecharegistro; 
	}
        public function Actualizar_Visita($id, $comentario){
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();
                $this->pdo->exec("UPDATE visitas_programacion 
                               SET vis_pro_comentarios = '$comentario'
                            WHERE vis_pro_id = '$id'");
                //SE TERMINA LA TRANSACCION 
                $this->pdo->commit();
            } catch (Exception $e){
                $this->pdo->rollBack();
                die($e->getMessage());
            }
        }

        //***************************************************************************** //
        // --------------- TRABAJO SOCIAL --------------------------------------------- //
        // ******************************* ---------------- *************************** //
        public function Registrar_TSocial(Visita $data){
            try {
                $sql = "INSERT INTO visitas_trabajador_social
                        (vis_TSoci_id_usuario,vis_TSoci_nombre,vis_TSoci_contador,vis_TSoci_estado) 
                        VALUES (?,?,?,?)";
                $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->id_userTS,
                        $data->nombreTS,
                        $data->contadorTS,
                        $data->estadoTS
                    )
                );
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        public function Listar_TSocial(){
            try{
                $stm= $this->pdo->prepare("SELECT * FROM visitas_trabajador_social");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        public function Obtener_TSocial($id){
            try{
                $stm = $this->pdo
                            ->prepare("SELECT * FROM visitas_trabajador_social WHERE vis_TSoci_id = ?");
                $stm->execute(array($id));
                return $stm->fetch(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        public function Actualizar_TSocial($data){
//           echo "nombre ".$data->nombreTS;
//           echo " cont ".$data->contadorTS;
//           echo " esta ".$data->estadoTS;
//           echo " id ".$data->id;
            try {
                $sql = "UPDATE visitas_trabajador_social SET 
                    vis_TSoci_nombre = ?,
                    vis_TSoci_contador = ?,
                    vis_TSoci_estado = ?
                    WHERE vis_TSoci_id = ?";

                $this->pdo->prepare($sql)
                ->execute(
                    array(  
                        $data->nombreTS,
                        $data->contadorTS,
                        $data->estadoTS,
                        $data->id
                    )
                );
            } catch (Exception $e) {
                die($e->getMessage());
            }
	}
        //***************************************************************************** //
        
        public function Listar_municipios(){
            try{
                $listar = $this->pdo->prepare("SELECT * FROM pa_municipio WHERE iddepartamento = 1");
                $listar->execute();
  		return $listar;
            } catch (Exception $e) {
                die($e->getMessage());
            }   
        }
        //***************************************************************************** //
        // --------------- INFORME SEGUIMIENTO ---------------------------------------- //
        // ******************************* ---------------- *************************** //
        public function Listar_Visitas_TS_Informe(){ 
            try{
                $id_usuario = $_SESSION['idUsuario'];
                $stm = $this->pdo->prepare("CALL Listar_Informe_Seguimiento_SinEnviar('$id_usuario')");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }    
        }
        public function Registrar_Informe_Seguimiento($id){
            $listar = $this->pdo->prepare("SELECT *
                        FROM visitas_programacion AS prog
                        INNER JOIN visitas_trabajador_social AS ts
                        ON prog.`vis_pro_id_TSocial` = ts.vis_TSoci_id 
                        INNER JOIN visitas_informe_seguimiento AS seg ON prog.vis_pro_id = seg.vis_inf_id_visProgramacion
                        WHERE prog.vis_pro_id = '$id'");
            $listar->execute();
            return $listar;
        }
        public function Obtener_datos_informe_visita($id){
            try{
                $stm = $this->pdo
                        ->prepare("CALL Obtener_datos_informe_Seguimiento ($id)");
                $stm->execute();
                return $stm->fetch(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        public function Guardar_Informe_Seguimiento($data){
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new Visita();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            $data_usuario   = $modelo->get_dato_usuario($_SESSION['idUsuario']);
            $datos_user     = $data_usuario->fetch();
            $nombre_us      = $datos_user['empleado'];
            
            $tiporegistro   = "Seguimiento Informe Visita T. Social";
            $accion         = "Registra un Nuevo ".$tiporegistro." En el Sistema (T. Social) TRABAJO SOCIAL";
            $detalle        = $nombre_us." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 10;
            $idusuario      = $_SESSION['idUsuario'];
            date_default_timezone_set('America/Bogota'); 
            $fecha_presentacion = date('Y-m-d');
            
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();
                if($data->bool_log =="0"){
                    $sql = "UPDATE visitas_informe_seguimiento 
                        SET vis_inf_fecha_visita = ?,
                        vis_inf_fecha_presentacion = ?,
                        vis_inf_id_usuario = ?,
                        vis_inf_hora_inicio = ?,
                        vis_inf_hora_fin = ?,
                        vis_inf_municipio = ?,
                        vis_inf_direccion = ?,
                        vis_inf_observaciones = ?,
                        vis_inf_num_personas = ?,
                        vis_inf_duracion = ?,
                        vis_inf_ruta_formato = ?,
                        vis_inf_log = ?,
                        vis_inf_enviado  = ?
                        WHERE vis_inf_id = ?";

                    $this->pdo->prepare($sql)
                    ->execute(
                        array(  
                            $data->fecha_visita,
                            $fecha_presentacion,
                            $idusuario,
                            $data->hora_inicio,
                            $data->hora_fin,
                            $data->municipio,
                            $data->direccion,
                            $data->comentarios,
                            $data->num_personas,
                            $data->duracion,
                            $data->vis_inf_ruta_formato,
                            1,
                            0,
                            $data->id
                        )
                    );
                    $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
                }else{
                    $sql = "UPDATE visitas_informe_seguimiento 
                        SET vis_inf_fecha_visita = ?,
                        vis_inf_fecha_presentacion = ?,
                        vis_inf_id_usuario = ?,
                        vis_inf_hora_inicio = ?,
                        vis_inf_hora_fin = ?,
                        vis_inf_municipio = ?,
                        vis_inf_direccion = ?,
                        vis_inf_observaciones = ?,
                        vis_inf_num_personas = ?,
                        vis_inf_duracion = ?,
                        vis_inf_ruta_formato = ?,
                        vis_inf_enviado  = ?
                        WHERE vis_inf_id = ?";

                    $this->pdo->prepare($sql)
                    ->execute(
                        array(  
                            $data->fecha_visita,
                            $fecha_presentacion,
                            $idusuario,
                            $data->hora_inicio,
                            $data->hora_fin,
                            $data->municipio,
                            $data->direccion,
                            $data->comentarios,
                            $data->num_personas,
                            $data->duracion,
                            $data->vis_inf_ruta_formato,
                            0,
                            $data->id
                        )
                    );
                }
                //SE TERMINA LA TRANSACCION  
                $this->pdo->commit();
            } catch (Exception $e) {
                $this->pdo->rollBack();
                die($e->getMessage());
            }
        }
        // ENVIAR INFORME SEGUIMIENTO
        public function Enviar_Informe($id, $fechaVisita){
            session_start();
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new Visita();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            $data_usuario   = $modelo->get_dato_usuario($_SESSION['idUsuario']);
            $datos_user     = $data_usuario->fetch();
            $nombre_us      = $datos_user['empleado'];
            
            $tiporegistro   = "Seguimiento Informe Visita T. Social";
            $accion         = ("Envía un Nuevo ".$tiporegistro." En el Sistema (T. Social) TRABAJO SOCIAL");
            $detalle        = $nombre_us." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 10;
            $idusuario      = $_SESSION['idUsuario'];
            
            date_default_timezone_set('America/Bogota'); 
            $fecha2 = date('Y-m-d');
            $fecha_presentacion = $fecha2;
            $fecha1 = $fechaVisita;
//            $fecha1 = "2017-06-01"; //            $fecha2 = "2017-06-06";
            $fecha1 = strtotime($fecha1); 
            $fecha2 = strtotime($fecha2); 
            $bandera = 0;
            for($fecha1;$fecha1<=$fecha2;$fecha1=strtotime('+1 day ' . date('Y-m-d',$fecha1))){ 
                if((strcmp(date('D',$fecha1),'Sun')!=0) && (strcmp(date('D',$fecha1),'Sat')!=0)){
                    $fechas = date('Y-m-d D',$fecha1) . '<br />'; 
                    $fechas_totales_habiles[] = date('Y-m-d',$fecha1); 
                    //$fechas_totales_habiles[] = $fechas;
                    $bandera++;
                }
            }
            //echo "bandera ".$bandera;
            $listar = $this->pdo->prepare("SELECT * FROM calendario_festivos");
            $listar->execute();
            while($field = $listar->fetch()){
                $array_festivos[] = $field['fes_fecha'];
            }
            //print_r($array_festivos);   
            //print_r($fechas_totales_habiles);
            foreach($fechas_totales_habiles as $valor){ 
                if(in_array($valor, $array_festivos) !== false){
                    $holiday [] = $valor;
                }else {
                    $arraglo_after_holiday_0 []= $valor; 
                }  
            }
            //print_r($holiday);
            //print_r($arraglo_after_holiday_0);
            $num_dias   = count($arraglo_after_holiday_0);
            $num_dias;
            if($num_dias == 0){
                $num_dias+=1;
            }
            $idUsuario  = $_SESSION['idUsuario'];
            $enviado    = "1";
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();
                $this->pdo->exec("UPDATE visitas_informe_seguimiento 
                               SET vis_inf_fecha_presentacion = '$fecha_presentacion',
                                   vis_inf_dif_dias = '$num_dias',
                                   vis_inf_enviado = '$enviado'
                            WHERE vis_inf_id = '$id'");
                $this->pdo->exec("INSERT INTO visitas_informe_remision 
                    (inf_rem_id_infSeguimiento, inf_rem_id_usuario, inf_rem_fecha_presentacion, inf_rem_enviado) 
                    VALUES ('$id', '$idUsuario', '$fecha_presentacion','0')");
                $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
                //SE TERMINA LA TRANSACCION 
                $this->pdo->commit();
            } catch (Exception $e){
                $this->pdo->rollBack();
                die($e->getMessage());
            }
        }
        // HISTORIAL INFORME SEGUIMIENTO USUARIO T Social
        public function Listar_Historial_Informe_SeguimientoTS(){
            try{
                $id_usuario = $_SESSION['idUsuario'];
                $stm = $this->pdo->prepare("CALL Listar_Historial_Informe_Seguimiento_TS('$id_usuario')");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }   
        }
        public function Listar_Historial_Informe_Seguimiento(){
            try{
                $id_usuario = $_SESSION['idUsuario'];
                $stm = $this->pdo->prepare("SELECT * FROM `vista_listar_historial_informe_seguimiento`");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }   
        }
        public function Listar_Historial_Informe_SeguimientoD(){
            try{
                $id_usuario = $_SESSION['idUsuario'];
                $stm = $this->pdo->prepare("CALL Listar_Historial_Informe_Seguimiento_Despacho('$id_usuario')");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }   
        }
        //***************************************************************************** //
        // --------------- INFORME REMISIÒN ------------------------------------------- //
        // ******************************* ---------------- *************************** //
        public function Listar_Informe_Remision(){
            try{
                $stm = $this->pdo->prepare("SELECT * FROM lista_informe_remision ");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }    
        }
        public function Obtener_datos_informe_Remision_visita($id){
            try{
                $stm = $this->pdo
                        ->prepare("CALL Obtener_datos_informe_Remision_visita('$id')");
                $stm->execute(array($id));
                return $stm->fetch(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        public function Guardar_Informe_Remision($data){
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new Visita();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            $data_usuario   = $modelo->get_dato_usuario($_SESSION['idUsuario']);
            $datos_user     = $data_usuario->fetch();
            $nombre_us      = $datos_user['empleado'];
            
            $tiporegistro   = ("Documento Remisión Informe Visita Domiciliaria");
            $accion         = "Registra un Nuevo ".$tiporegistro." En el Sistema (T. Social) TRABAJO SOCIAL";
            $detalle        = $nombre_us." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 10;
            $idusuario      = $_SESSION['idUsuario'];
            
            date_default_timezone_set('America/Bogota'); 
            $fecha_remision = date('Y-m-d');
            $anio = date('Y');
            $year=date('y'); 
            // DATOS LOG PARA SIGDOC
            $tiporegistroD   = "Salida de Documento";
            $accionD         = "Registra una Nueva ".$tiporegistroD." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS SALIENTES";
            $detalleD        = $nombre_us." ".$accionD." ".$fechalog." "."a las: ".$horalog;
            $tipologD        = 4;
            $tipodocumento   = 2;
            
            //ECHO "TIPO REg. ts ".$tiporegistro." detalle: ".$detalle;
            //echo "<br> tipo reg Doc: ".$tiporegistroD." detalle: ".$detalleD;
            $asunto = "REMISION INFORME SOCIAL";
            
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();
                
                 $listar = $this->pdo->prepare("SELECT MAX(di.id) AS idmaximo,di.sigla,di.contador
                                        FROM sigdoc_pa_consecutivo AS di
                                        WHERE di.idtipodocumento = '$tipodocumento'");
                $listar->execute();
                $field = $listar->fetch();
               
                $numeroconsecutivo = $field['contador'];
                $consecutivo       = $numeroconsecutivo + 1; 

                if($consecutivo >= 0 && $consecutivo <= 9) {$consecutivo = "00".$consecutivo;}
                if($consecutivo >  9 && $consecutivo <= 99){$consecutivo = "0".$consecutivo;}

                echo $ndocumento = $field['sigla']."".$year."-".$consecutivo;
                if($data->num_oficio ==""){
                    $sql = "UPDATE visitas_informe_remision 
                    SET inf_rem_id_usuarioReg = ?,
                    inf_rem_fecha_remision = ?,
                    inf_rem_num_oficio = ?,
                    inf_rem_num_folios = ?,
                    inf_rem_observaciones = ?,
                    inf_rem_enviado  = ?
                    WHERE inf_rem_id = ?";

                    $this->pdo->prepare($sql)
                    ->execute(
                        array(  
                            $idusuario,
                            $fecha_remision,
                            $ndocumento,
                            $data->num_folios,
                            $data->comentarios,
                            0,
                            $data->id
                        )
                    );
                    $this->pdo->exec("UPDATE sigdoc_pa_consecutivo SET contador = '$consecutivo' WHERE idtipodocumento = '$tipodocumento'");
                    $this->pdo->exec("INSERT INTO sigdoc_documentos_internos (idusuario,idusuarioedita,identrada,idtipodocumento,numero,
                                    dirigidoa, cargo, dependencia, fechageneracion,fechaedita,asunto,contenido,aniodoc)
                                    VALUES (
                                        '$idusuario',0,0,'$tipodocumento','$ndocumento','7','JUEZ','$data->juzgadoSolicitante','$fecha_remision','0000-00-00',
                                        '$asunto','$data->contenidoDoc','$anio'
                                    )");
                    $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
                    $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accionD','$detalleD','$idusuario','$tipologD')");
                }else{
                    $sql = "UPDATE visitas_informe_remision 
                        SET inf_rem_id_usuarioReg = ?,
                        inf_rem_fecha_remision = ?,
                        inf_rem_num_folios = ?,
                        inf_rem_observaciones = ?,
                        inf_rem_enviado  = ?
                        WHERE inf_rem_id = ?";

                    $this->pdo->prepare($sql)
                    ->execute(
                        array(  
                            $idusuario,
                            $fecha_remision,
                            $data->num_folios,
                            $data->comentarios,
                            0,
                            $data->id
                        )
                    );
                }
                //SE TERMINA LA TRANSACCION  
                $this->pdo->commit();
            } catch (Exception $e) {
                $this->pdo->rollBack();
                die($e->getMessage());
            }
        }
        public function Enviar_Informe_Remision($id, $fecha_presentacion){
            session_start();
            date_default_timezone_set('America/Bogota'); 
            $fecha2 = date('Y-m-d');
            $fecha_remision = $fecha2;
            $fecha1 = $fecha_presentacion;
            //echo $fecha1 = "2017-06-02"; 
            //echo $fecha2 = "2017-06-08";
            $fecha1 = strtotime($fecha1); 
            $fecha2 = strtotime($fecha2); 
            $bandera = 0;
            for($fecha1;$fecha1<=$fecha2;$fecha1=strtotime('+1 day ' . date('Y-m-d',$fecha1))){ 
                if((strcmp(date('D',$fecha1),'Sun')!=0) && (strcmp(date('D',$fecha1),'Sat')!=0)){
                    $fechas = date('Y-m-d D',$fecha1) . '<br />'; 
                    $fechas_totales_habiles[] = date('Y-m-d',$fecha1); 
                    //$fechas_totales_habiles[] = $fechas;
                    $bandera++;
                }
            }
            //echo "bandera ".$bandera;
            $listar = $this->pdo->prepare("SELECT * FROM calendario_festivos");
            $listar->execute();
            while($field = $listar->fetch()){
                $array_festivos[] = $field['fes_fecha'];
            }
            //print_r($array_festivos);   
            //print_r($fechas_totales_habiles);
            foreach($fechas_totales_habiles as $valor){ 
                if(in_array($valor, $array_festivos) !== false){
                    $holiday [] = $valor;
                }else {
                    $arraglo_after_holiday_0 []= $valor; 
                }  
            }
            //print_r($holiday);
            //print_r($arraglo_after_holiday_0);
            $num_dias   = count($arraglo_after_holiday_0);
            if($num_dias == 0){
                $num_dias   += 1;
            }
            $num_dias;
            $idUsuario  = $_SESSION['idUsuario'];
            $enviado    = "1";
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();
                
                $this->pdo->exec("UPDATE visitas_informe_remision 
                               SET inf_rem_fecha_remision = '$fecha_remision',
                                   inf_rem_num_dif_dias = '$num_dias',
                                   inf_rem_enviado = '$enviado'
                            WHERE inf_rem_id = '$id'");
                
                $this->pdo->exec("INSERT INTO visitas_informe_valoracion 
                    (inf_val_id_infRemision, inf_val_id_usuario, inf_val_fechaRecepcion, inf_val_enviado) 
                    VALUES ('$id', '$idUsuario', '$fecha_remision','0')");
                
                //SE TERMINA LA TRANSACCION 
                $this->pdo->commit();
            } catch (Exception $e){
                $this->pdo->rollBack();
                die($e->getMessage());
            }
        }
        public function Listar_Historial_Informe_Remision(){
            try{
                $id_usuario = $_SESSION['idUsuario'];
                $stm = $this->pdo->prepare("SELECT * FROM `vista_listar_historial_informe_remision` ");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }   
        }
        public function Listar_Historial_Informe_RemisionDespacho(){
            try{
                $id_usuario = $_SESSION['idUsuario'];
                $stm = $this->pdo->prepare("CALL Listar_Historial_Informe_RemisionDespacho('$id_usuario')");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }   
        }
        
        //***************************************************************************** //
        // --------------- VALORACIÒN VISITAS ----------------------------------------- //
        // ******************************* ---------------- *************************** //
        public function lista_valoracion_visitas_sin_enviar(){
            try{
                $stm = $this->pdo->prepare("SELECT * FROM lista_valoracion_visitas_sin_enviar ");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }    
        }
        public function Listar_Informe_Valoracion_SinEnviarD($idUserD){
           try{
                $stm = $this->pdo
                        ->prepare("CALL Listar_Informe_Valoracion_SinEnviarD('$idUserD')");
                $stm->execute(array($idUserD));
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            } 
        }

        public function Obtener_datos_valoracion_visita($id){
            try{
                $stm = $this->pdo
                        ->prepare("CALL Obtener_datos_valoracion_visita('$id')");
                $stm->execute(array($id));
                return $stm->fetch(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        public function Guardar_valoracion_visita($data){
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new Visita();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];

            $tiporegistro   = "Valoracion de Visita T. Social";
            $accion         = "Registra una Nueva ".$tiporegistro." En el Sistema (T. Social) TRABAJO SOCIAL";
            $detalle        = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 10;
            $idusuario      = $_SESSION['idUsuario'];
           
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();
                if($data->bandera == "0"){
                    $sql = "UPDATE visitas_informe_valoracion 
                        SET inf_val_id_usuarioR = ?,
                        inf_val_nombreValoracion = ?,
                        inf_val_cumpleObjetivo = ?,
                        inf_val_cumpleObjetivoRespuesta = ?,
                        inf_val_oportunamente = ?,
                        inf_val_oportunamenteRespuesta  = ?,
                        inf_val_valoracionDespacho  = ?,
                        inf_val_observaciones  = ?,
                        inf_val_bool_log = ?
                        WHERE inf_val_id = ?";

                    $this->pdo->prepare($sql)
                    ->execute(
                        array(  
                            $idusuario,
                            $data->nombreValoracion,
                            $data->objetivo,
                            $data->res_objetivo,
                            $data->oportunamente,
                            $data->res_oportunamente,
                            $data->valoracion,
                            $data->comentarios,
                            1,
                            $data->id
                        )
                    );
                    $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
                }else{
                    $sql = "UPDATE visitas_informe_valoracion 
                        SET inf_val_id_usuarioR = ?,
                        inf_val_nombreValoracion = ?,
                        inf_val_cumpleObjetivo = ?,
                        inf_val_cumpleObjetivoRespuesta = ?,
                        inf_val_oportunamente = ?,
                        inf_val_oportunamenteRespuesta  = ?,
                        inf_val_valoracionDespacho  = ?,
                        inf_val_observaciones  = ?
                        WHERE inf_val_id = ?";

                    $this->pdo->prepare($sql)
                    ->execute(
                        array(  
                            $idusuario,
                            $data->nombreValoracion,
                            $data->objetivo,
                            $data->res_objetivo,
                            $data->oportunamente,
                            $data->res_oportunamente,
                            $data->valoracion,
                            $data->comentarios,
                            $data->id
                        )
                    );
                }  
                //SE TERMINA LA TRANSACCION  
                $this->pdo->commit();
            } catch (Exception $e) {
                $this->pdo->rollBack();
                die($e->getMessage());
            }
        }
        public function Enviar_Informe_Valoracion($id, $fecha_recepcion){
            session_start();
            //DATOS PARA EL REGISTRO DEL LOG *******************************************************************
            $modelo     = new Visita();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];

            $tiporegistro   = "Valoracion de Visita T. Social";
            $accion         = "Envía una Nueva ".$tiporegistro." En el Sistema (T. Social) TRABAJO SOCIAL";
            $detalle        = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 10;
            $idusuario      = $_SESSION['idUsuario'];
            //***************************************************************************************************
            date_default_timezone_set('America/Bogota'); 
            $fecha2 = date('Y-m-d');
            $fecha_presentacion = $fecha2;
            $fecha_cs = date('Y-m-d g:ia');
            $fecha1 = $fecha_recepcion;
            //echo $fecha1 = "2017-06-02"; 
            //echo $fecha2 = "2017-06-08";
            $fecha1 = strtotime($fecha1); 
            $fecha2 = strtotime($fecha2); 
            $bandera = 0;
            for($fecha1;$fecha1<=$fecha2;$fecha1=strtotime('+1 day ' . date('Y-m-d',$fecha1))){ 
                if((strcmp(date('D',$fecha1),'Sun')!=0) && (strcmp(date('D',$fecha1),'Sat')!=0)){
                    $fechas = date('Y-m-d D',$fecha1) . '<br />'; 
                    $fechas_totales_habiles[] = date('Y-m-d',$fecha1); 
                    //$fechas_totales_habiles[] = $fechas;
                    $bandera++;
                }
            }
            //echo "bandera ".$bandera;
            $listar = $this->pdo->prepare("SELECT * FROM calendario_festivos");
            $listar->execute();
            while($field = $listar->fetch()){
                $array_festivos[] = $field['fes_fecha'];
            }
            //print_r($array_festivos);   
            //print_r($fechas_totales_habiles);
            foreach($fechas_totales_habiles as $valor){ 
                if(in_array($valor, $array_festivos) !== false){
                    $holiday [] = $valor;
                }else {
                    $arraglo_after_holiday_0 []= $valor; 
                }  
            }
            //print_r($holiday);
            //print_r($arraglo_after_holiday_0);
            $num_dias   = count($arraglo_after_holiday_0);
            if($num_dias == 0){
                $num_dias += 1;
            }
            $num_dias;
            $idUsuario  = $_SESSION['idUsuario'];
            $enviado    = "1";
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();
                $this->pdo->exec("UPDATE visitas_informe_valoracion 
                               SET inf_val_fechaPresentacion = '$fecha_presentacion',
                                   inf_val_dif_dias = '$num_dias',
                                   inf_val_fechaRecepcionCS = '$fecha_cs',
                                   inf_val_enviado = '$enviado',
                                   inf_val_visto = '0'    
                            WHERE inf_val_id = '$id'");
               $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
               //SE TERMINA LA TRANSACCION 
               $this->pdo->commit();
            } catch (Exception $e){
                $this->pdo->rollBack();
                die($e->getMessage());
            } 
        }
        public function Listar_Historial_Valoracion_Visitas(){
            try{
                $id_usuario = $_SESSION['idUsuario'];
                $stm = $this->pdo->prepare("SELECT * FROM `Listar_Historial_Valoracion_Visitas` ");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            } 
        }
        public function Listar_Historial_valoracion_visitaDespacho(){
            try{
                $id_usuario = $_SESSION['idUsuario'];
                $stm = $this->pdo->prepare("CALL Listar_Historial_valoracion_visitaxDespacho('$id_usuario')");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            } 
        }
        
        //***************************************************************************** //
        // --------------- DÍAS FESTIVOS  --------------------------------------------- //
        // ******************************* ---------------- *************************** //
        public function calendario_festivos(){
            date_default_timezone_set('America/Bogota'); 
            $año = date('Y');
            try{
                $stm= $this->pdo->prepare("SELECT * FROM `calendario_festivos` WHERE `fes_fecha` LIKE  '$año%'");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            } 
        }
        public function Obtener_Festivo($id){
            try{
                $stm = $this->pdo->prepare("SELECT * FROM `calendario_festivos` WHERE `fes_id` = ?");
                $stm->execute(array($id));
                return $stm->fetch(PDO::FETCH_OBJ);
            } catch (Exception $e){
                die($e->getMessage());
            } 
        }
        public function Registrar_DiaFestivo(Visita $data){
            try {
                $sql = "INSERT INTO calendario_festivos 
                        (fes_fecha,fes_descripcion) 
                        VALUES (?,?)";
                $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->fecha_Festivo,
                        $data->descripcionF
                    )
                );
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        public function Actualizar_DiaFestivo($data){
            try {
                $sql = "UPDATE calendario_festivos SET 
                    fes_fecha = ?,
                    fes_descripcion = ?
                    WHERE fes_id = ?";
                $this->pdo->prepare($sql)
                ->execute(
                    array(  
                        $data->fecha_Festivo,
                        $data->descripcionF,
                        $data->id
                    )
                );
            } catch (Exception $e) {
                die($e->getMessage());
            }
	}
        public function Eliminar_Festivo($id){
            try {
                $stm = $this->pdo
                            ->prepare("DELETE FROM calendario_festivos WHERE fes_id = ?");			          
                $stm->execute(array($id));
            } catch (Exception $e) {
                die($e->getMessage());
            }
	}
        //*****************************************************************************************************//
        
        // ****************** JUAN ESTEBAN MÙNERA BETANCUR 08-06-2017 *******************************************
        // ****************** SUPER USUARIOS QUE PUEDEN INGRESAR A TODOS LOS MÓDULOS ****************************
        public function privilegio_listarPermisos(){
            $listar = $this->pdo->prepare("SELECT usuario FROM pa_usuario_acciones WHERE id = 20 ORDER BY id");
            $listar->execute();
            return $listar;
	}
        
        public function Valoracion_visita_Vista(){
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();

                $this->pdo->exec("UPDATE visitas_informe_valoracion SET inf_val_visto = '1' ");
                //$this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
                //SE TERMINA LA TRANSACCION 
                $this->pdo->commit();
            } catch (Exception $e){
                $this->pdo->rollBack();
                die($e->getMessage());
            } 
        }
        //***************************************************************************** //
        // --------------- ESTADISTICA  ----------------------------------------------- //
        // ******************************* ---------------- *************************** //
        public function GraficarVisitasTS($inicio, $fin){
            try{
                $stm = $this->pdo->prepare("SELECT count(*) AS cantidad, vis_TSoci_nombre,vis_TSoci_id
                                            FROM visitas_programacion AS pro
                                            INNER JOIN visitas_trabajador_social AS ts ON ts.vis_TSoci_id = pro.vis_pro_id_TSocial
                                            WHERE vis_TSoci_estado ='1'
                                            AND vis_pro_fecha_visita BETWEEN '$inicio' AND '$fin'
                                            AND vis_pro_estado != 'Cancelada'
                                            GROUP BY vis_TSoci_id");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        public function GraficarVisitasDespachos($inicio, $fin){
            try{
                $stm = $this->pdo->prepare("SELECT COUNT(*) AS cantidad, empleado as Juzgado
                                            FROM visitas_programacion AS vp
                                            INNER JOIN pa_usuario AS us ON vp.vis_pro_id_usuario = us.id
                                            AND vis_pro_fecha_visita BETWEEN '$inicio' AND '$fin'
                                            GROUP BY us.id");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
    }
// JUAN ESTEBAN MUNERA BETANCUR