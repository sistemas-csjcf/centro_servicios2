<?php
    // JUAN ESTEBAN MUNERA BETANCUR
    require_once 'database.php';
    class Mejora_C{
	private $pdo;
        public $id;
        public $per_id_usuario;
        public $per_cedula;
        
        public function __CONSTRUCT(){
            try{
                $this->pdo = Database::StartUp();     
            }catch(Exception $e){
                die($e->getMessage());
            }
	}
        public function Listar_Solicitud_tarea_Despacho($user){
            $listar = $this->pdo->prepare("SELECT `tar_id`, `tar_fecha`, `tar_id_user`, `tar_id_user_responsable`, 
                `tar_descripcion`, `tar_ruta_doc`, `tar_id_userE`, `tar_fechaE`, `tar_fecha_limite`, `tar_estado`, us.empleado 
                FROM `mc_tareas`  AS ta
                INNER JOIN pa_usuario AS us ON ta.tar_id_user_responsable = us.id
                WHERE tar_estado=0 AND tar_id_user= '$user'");
            $listar->execute();
            return $listar->fetchAll(PDO::FETCH_OBJ);
        }
        public function Obtener($id){
            try{
                $stm = $this->pdo
                        ->prepare("SELECT * FROM mc_tareas WHERE tar_id = ?");
                $stm->execute(array($id));
                    return $stm->fetch(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        public function Get_Detalles($id){
            try{
                $stm = $this->pdo
                        ->prepare("SELECT * FROM mc_tareas_detalles WHERE det_tar_id = ?");
             $stm->execute(array($id));
                    return $stm->fetch(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }
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
    public function get_Responsables(){
            $listar = $this->pdo->prepare("SELECT id, empleado FROM pa_usuario WHERE idestadoempleado>0 ORDER BY empleado ");
            $listar->execute();
            return $listar;
        }
        public function get_Responsable(){
            $listar = $this->pdo->prepare("SELECT * FROM pa_usuario WHERE idestadoempleado>0 AND (id_proceso_cs != '' || id_proceso_cs>0)  ORDER BY empleado ");
            $listar->execute();
            return $listar;
        }
        public function get_All_users(){
            $listar = $this->pdo->prepare("SELECT * FROM pa_usuario WHERE id_proceso_cs != '' || id_proceso_cs>=0 AND idestadoempleado=1  ORDER BY empleado ");
            $listar->execute();
            return $listar;
        }
        public function get_solicitanteAdmin(){
            $listar = $this->pdo->prepare("SELECT * FROM pa_usuario WHERE idperfil =22 || id=46 ORDER BY id ");
            $listar->execute();
            return $listar;
        }
        public function get_Responsable_lider($id_proceso) {
            $listar = $this->pdo->prepare("SELECT * FROM pa_usuario WHERE id_proceso_cs = ".$id_proceso." AND idestadoempleado = 1 ORDER BY empleado ");
            $listar->execute();
            return $listar;
        }
        public function get_fecha_actual(){	
            date_default_timezone_set('America/Bogota'); 
            $fecharegistro=date('Y-m-d g:ia'); 
            return $fecharegistro; 
	}
        public function Registrar_Tarea(Mejora_C $data){
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new Mejora_C();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            
            $tiporegistro   = "Acción de Gestión";
            $accion         = "Registra una Nueva ".$tiporegistro." En el Sistema (SEGME) SEGUIMIENTO Y MEJORA";
            $detalle        = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 14;
            $idusuarioR     = $_SESSION['idUsuario'];
            
            $responsable =(explode("//", $data->id_user_responsable));
            $proc_impactados = implode(",", $data->id_procesoImp);
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();
                // REGISTRO USUARIO ADMIN/LIDER ----------------------------------------------------------------
                if($data->tipo_us ==1){
                    $sql = "INSERT INTO `mc_tareas`(`tar_fecha`,`tar_fecha_limite`, `tar_id_user`, `tar_id_user_responsable`, `tar_id_clase`, 
                                `tar_id_numeral`, `tar_descripcion`,`tar_id_proceso_responsable`, `tar_id_proceso_afectado`, `tar_causa`, 
                                `tar_id_metodologia`, `tar_id_generada`, `tar_ruta_doc`, `tar_estado`) 
                        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                    $this->pdo->prepare($sql)
                    ->execute(
                        array(
                            $fechalog,
                            $data->fecha_limite,
                            $data->id_user,
                            $responsable[0],
                            $data->id_clase,
                            $data->id_norma,
                            $data->tar_descripcion,
                            $responsable[1],
                            $proc_impactados,
                            $data->causas,
                            $data->id_metodologia,
                            $data->id_generado,
                            $data->tar_ruta_doc,
                            0
                        )
                    ); 
                }else{
                    // REGISTRO USUARIO DESPACHO ----------------------------------------------------------------
                    $sql = "INSERT INTO `mc_tareas`(`tar_fecha`,`tar_fecha_limite`, `tar_id_user`, `tar_id_user_responsable`, `tar_descripcion`,
                        `tar_id_proceso_responsable`, `tar_ruta_doc`, `tar_estado`) 
                        VALUES (?,?,?,?,?,?,?,?)";
                    $this->pdo->prepare($sql)
                    ->execute(
                        array(
                            $fechalog,
                            $data->fecha_limite,
                            $data->id_user,
                            $responsable[0],
                            $data->tar_descripcion,
                            $responsable[1],
                            $data->tar_ruta_doc,
                            0
                        )
                    ); 
                }
                $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuarioR','$tipolog')");
                
                //SE TERMINA LA TRANSACCION  
                $this->pdo->commit();
            } catch (Exception $e) {
                $this->pdo->rollBack();
                die($e->getMessage());
            }
        }
        public function solicitudes_despacho($id_user){
            $listar = $this->pdo->prepare("SELECT * 
                FROM mc_tareas
                WHERE `tar_id_user` = '$id_user' LIMIT 20");
            $listar->execute();
            return $listar->fetchAll(PDO::FETCH_OBJ);
        }
        public function solicitudes_pendientes_admin($id_user){
            $listar = $this->pdo->prepare("SELECT DATEDIFF(tar_fecha_limite, NOW())AS diferencia,`tar_id`, `tar_fecha`,`tar_id_user`, `tar_id_user_responsable`, 
                `tar_descripcion`, `tar_ruta_doc`, `tar_fecha_gestion`,`tar_estado`, `tar_fecha_limite`, us.empleado 
                FROM `mc_tareas` AS ta
                INNER JOIN pa_usuario AS us ON ta.tar_id_user = us.id
                WHERE `tar_id_user_responsable` = '$id_user' AND tar_estado=0 AND tar_id NOT IN (14,100)");
            $listar->execute();
            return $listar->fetchAll(PDO::FETCH_OBJ);
        }
        public function mis_tareas_pendientes($id_user){
            $listar = $this->pdo->prepare("SELECT DATEDIFF(tar_fecha_limite, NOW())AS diferencia, `tar_id`, `tar_fecha`,`tar_id_user`, `tar_id_user_responsable`, 
                    `tar_descripcion`, `tar_ruta_doc`, `tar_fecha_gestion`,`tar_estado`, `tar_fecha_limite`, us.empleado, tar_id_userE
                FROM `mc_tareas` AS ta
                INNER JOIN pa_usuario AS us ON ta.tar_id_user = us.id
                WHERE `tar_id_user_responsable` = '$id_user' AND tar_estado=0 ");
            $listar->execute();
            return $listar->fetchAll(PDO::FETCH_OBJ);
        }
        
        public function get_Departamento(){
            $listar     = $this->pdo->prepare("SELECT * FROM pa_departamento WHERE id !=0 ORDER BY nombre ASC");
            $listar->execute();
            return $listar;
        }
        public function get_Areas_cs(){
            $listar = $this->pdo->prepare("SELECT * FROM area_cs WHERE are_flag =1 ORDER BY are_titulo ASC");
            $listar->execute();
            return $listar;
        }
        public function Get_Municipio_Asociado($id_departamento){
            $listar     = $this->pdo->prepare("SELECT * FROM pa_municipio WHERE id !=0 AND iddepartamento = '$id_departamento' ORDER BY nombre ASC");
            $listar->execute();
            return $listar;
        }
        public function Get_Juzgados(){
            $listar = $this->pdo->prepare("SELECT * FROM pa_juzgado ORDER BY id ASC");
            $listar->execute();
            return $listar;
        }
        public function Reasignar_Tarea($data){
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new Mejora_C();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            
            $tiporegistro   = "Acción de Gestión ID: ".$data->id;
            $accion         = "Reasigna ".$tiporegistro." En el Sistema (SEGME) SEGUIMIENTO Y MEJORA";
            $detalle        = ($_SESSION['nombre'])." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 14;
            $idusuarioR     = $_SESSION['idUsuario'];

            $responsable =(explode("//", $data->id_user_responsable));
            $proc_impactados = implode(",", $data->id_procesoImp);
            try{
               $sql = "UPDATE mc_tareas SET 
                        tar_fecha_limite = ?,
                        tar_id_user_responsable = ?, 
                        tar_id_clase = ?,
                        tar_id_numeral = ?,
                        tar_id_proceso_responsable = ?,
                        tar_id_proceso_afectado = ?,
                        tar_causa = ?,
                        tar_id_metodologia = ?,
                        tar_id_generada = ?,
                        tar_id_userE = ?,
                        tar_fechaE = ?
                    WHERE tar_id = ?";

                $this->pdo->prepare($sql)
                ->execute(
                    array(  
                        $data->fecha_limite,
                        $responsable[0],
                        $data->id_clase,
                        $data->id_norma,
                        $responsable[1],
                        $proc_impactados,
                        $data->causas,
                        $data->id_metodologia,
                        $data->id_generado,
                        $idusuarioR,
                        $fechalog,
                        $data->id
                    )
                ); 
                $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuarioR','$tipolog')");
            } catch (Exception $ex) {
                die($ex->getMessage());
            }
        }
        public function historial_mis_tareas($id_user){
            try{
                $listar = $this->pdo->prepare("CALL `MC_Historial_Mis_Tareas` ('$id_user') ");
                $listar->execute();
                return $listar->fetchAll(PDO::FETCH_OBJ);
            }catch (Exception $ex) {
                die($ex->getMessage());
            }
        }
        public function historial_mis_tareasAD(){
            try{
                $listar = $this->pdo->prepare("CALL `MC_Historial_Tareas_Admin`");
                $listar->execute();
                return $listar->fetchAll(PDO::FETCH_OBJ);
            }catch (Exception $ex) {
                die($ex->getMessage());
            }
        }
        
        public function Vista_historial_tareasAD(){
            try{
                $listar = $this->pdo->prepare("SELECT * FROM `mc_historial_tareas_admin`WHERE tar_id NOT IN (14,100) ");
                $listar->execute();
                return $listar->fetchAll(PDO::FETCH_OBJ);
            }catch (Exception $ex) {
                die($ex->getMessage());
            }
        }
        public function Vista_Detalles(){
            try{
                $listar = $this->pdo->prepare("SELECT * FROM `mc_tareas_detalles`WHERE det_tar_id NOT IN (14,100) ");
                $listar->execute();
                return $listar->fetchAll(PDO::FETCH_OBJ);
            }catch (Exception $ex) {
                die($ex->getMessage());
            }
        }
        public function Gestionar_Tarea($data) {
            session_start();
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new Mejora_C();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            
            $tiporegistro   = "Acción de Gestión ID: ".$data->id;
            $accion         = "Realiza la Gestión de la ".$tiporegistro." En el Sistema (SEGME) SEGUIMIENTO Y MEJORA";
            $detalle        = ($_SESSION['nombre'])." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 14;
            $idusuarioR     = $_SESSION['idUsuario'];

            $proc_impactados = implode(",", $data->id_procesoImp);
            try{
                if($data->flag_model ==1 ){
                    $sql = "UPDATE mc_tareas SET 
                        tar_fecha_limite = ?,
                        tar_id_clase = ?,
                        tar_id_numeral = ?,
                        tar_id_proceso_afectado = ?,
                        tar_causa = ?,
                        tar_id_metodologia = ?,
                        tar_id_generada = ?,
                        tar_id_user_gestion = ?, 
                        tar_fecha_gestion = ?,
                        tar_descripcion_gestion = ?,
                        tar_ruta_doc_gestion = ?,
                        tar_estado = ?
                    WHERE tar_id = ?";
                    
                    $this->pdo->prepare($sql)
                    ->execute(
                        array(
                            $data->fecha_limite,
                            $data->id_clase,
                            $data->id_norma,
                            $proc_impactados,
                            $data->causas,
                            $data->id_metodologia,
                            $data->id_generado,
                            $idusuarioR,
                            $fechalog,
                            $data->descripcion_Gestion,
                            $data->ruta_doc_gestion,
                            1,
                            $data->id
                        )
                    ); 
                }else{
                    $sql = "UPDATE mc_tareas SET 
                        tar_fecha_limite = ?,
                        tar_id_user_gestion = ?, 
                        tar_fecha_gestion = ?,
                        tar_descripcion_gestion = ?,
                        tar_ruta_doc_gestion = ?,
                        tar_estado = ?
                    WHERE tar_id = ?";
                    
                    $this->pdo->prepare($sql)
                    ->execute(
                        array(  
                            $data->fecha_limite,
                            $idusuarioR,
                            $fechalog,
                            $data->descripcion_Gestion,
                            $data->ruta_doc_gestion,
                            1,
                            $data->id
                        )
                    ); 
                }
                $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuarioR','$tipolog')");
            } catch (Exception $ex) {
                die($ex->getMessage());
            }
        }
        /*public function Completar_AG($data){
            try{
                $proc_impactados = implode(",", $data->id_procesoImp);
                $sql = "UPDATE mc_tareas SET 
                    tar_id_clase = ?,
                    tar_id_numeral = ?,
                    tar_id_proceso_afectado = ?,
                    tar_causa = ?,
                    tar_id_metodologia = ?,
                    tar_id_generada = ?
                WHERE tar_id = ?";

                $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->id_clase,
                        $data->id_norma,
                        $proc_impactados,
                        $data->causas,
                        $data->id_metodologia,
                        $data->id_generado,
                        $data->id
                    )
                ); 

            } catch (Exception $ex) {
                die($ex->getMessage());
            }
        }*/
        public function Completar_AG($data){
            try{
                //$proc_impactados = implode(",", $data->id_procesoImp);
                $sql = "INSERT INTO `mc_tareas_detalles`(`det_tar_id`,`det_fecha_inicial`, `det_fecha_final`, `det_descripcion`, `det_responsable`) VALUES (?,?,?,?,?)";

                $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->det_tar_id,
                        $data->det_fecha_inicial,
                        $data->det_fecha_final,
                        $data->det_descripcion,
                        $data->det_responsable
                    )
                ); 

            } catch (Exception $ex) {
                die($ex->getMessage());
            }
        }

        public function get_dato_Usuario($cedula){
            $listar = $this->pdo->prepare("SELECT * FROM pa_usuario WHERE `nombre_usuario` = '$cedula'");  
            $listar->execute();
            return $listar;
        }
        public function get_dato_Usuario1($id){
            $listar = $this->pdo->prepare("SELECT * FROM pa_usuario WHERE `id` = '$id'");  
            $listar->execute();
            return $listar;
        }
        public function Get_us_Audi($id){
            $listar = $this->pdo->prepare("SELECT * FROM pa_usuario_acciones WHERE `id` = '$id'");  
            $listar->execute();
            return $listar;
        }
        public function Get_Procesos(){
            $listar = $this->pdo->prepare("SELECT * FROM mc_procesos_cs WHERE proc_flag =1 ORDER BY proc_titulo ASC");
            $listar->execute();
            return $listar;
        }
        public function Get_Clases(){
            $listar = $this->pdo->prepare("SELECT * FROM mc_clase WHERE clas_flag =1 ORDER BY clas_titulo ASC");
            $listar->execute();
            return $listar;
        }
        public function Get_Normas(){
            $listar = $this->pdo->prepare("SELECT * FROM mc_normas WHERE nor_flag =1 ORDER BY nor_titulo ASC");
            $listar->execute();
            return $listar;
        }
        public function Get_Metodologia(){
            $listar = $this->pdo->prepare("SELECT * FROM mc_metodologias WHERE met_flag = 1 ORDER BY met_titulo ASC");
            $listar->execute();
            return $listar;
        }
        public function Get_Generada(){
            $listar = $this->pdo->prepare("SELECT * FROM mc_generada WHERE gen_flag = 1 ORDER BY gen_id ASC");
            $listar->execute();
            return $listar;
        }
        //*********************************************************************************************************************
        public function get_datos_usuariosJE(){
            $listar     = $this->pdo->prepare("SELECT * FROM pa_usuario WHERE idperfil!=22 AND idestadoempleado=1 ORDER BY empleado");
            $listar->execute();
            return $listar;
        }
        public function Registrar_Hallazgo(Mejora_C $data){
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new Mejora_C();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            
            $tiporegistro   = "Hallazgo";
            $accion         = "Registra un Nuevo ".$tiporegistro." En el Sistema (SEGME) SEGUIMIENTO Y MEJORA";
            $detalle        = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 14;
            $idusuarioR     = $_SESSION['idUsuario'];
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();

                $sql = "INSERT INTO `mc_hallazgos`(`hal_fecha`, `hal_id_user`, `hal_id_user_responsable`, 
                            `hal_descripcion`, `hal_ruta_doc`, `hal_estado`, `hal_fecha_limite`) 
                    VALUES (?,?,?,?,?,?,?)";
                $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $fechalog,
                        $data->id_user,
                        $data->id_user_responsable,
                        $data->descripcion,
                        $data->hal_ruta_doc,
                        0,
                        $data->fecha_limite
                    )
                ); 
                $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuarioR','$tipolog')");
                
                //SE TERMINA LA TRANSACCION  
                $this->pdo->commit();
            } catch (Exception $e) {
                $this->pdo->rollBack();
                die($e->getMessage());
            }
        }
        public function Procedure_Mis_hallazgos_pendientes($id_user){
            try{
                $listar = $this->pdo->prepare("CALL `MC_mis_hallazgos_Pendientes` ('$id_user')");
                $listar->execute();
                return $listar->fetchAll(PDO::FETCH_OBJ);
            }catch (Exception $ex) {
                die($ex->getMessage());
            }
        }
        public function Procedure_Mis_hallazgos_Historial($id_user){
            try{
                $listar = $this->pdo->prepare("CALL `MC_mis_hallazgos_historial_us` ('$id_user')");
                $listar->execute();
                return $listar->fetchAll(PDO::FETCH_OBJ);
            }catch (Exception $ex) {
                die($ex->getMessage());
            }
        }
        public function Vista_historial_Hallazgos_Admin(){
            try{
                $listar = $this->pdo->prepare("SELECT * FROM `mc_historial_Hallazgos`");
                $listar->execute();
                return $listar->fetchAll(PDO::FETCH_OBJ);
            }catch (Exception $ex) {
                die($ex->getMessage());
            }
        }
        public function Gestionar_Find($data) {
            session_start();
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new Mejora_C();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            
            $tiporegistro   = "Hallazgo - ID: ".$data->id;
            $accion         = "Realiza la Gestión del ".$tiporegistro." En el Sistema (SEGME) SEGUIMIENTO Y MEJORA";
            $detalle        = ($_SESSION['nombre'])." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 14;
            $idusuarioR     = $_SESSION['idUsuario'];
            try{
               $sql = "UPDATE mc_hallazgos SET 
                        hal_id_user_gestion = ?, 
                        hal_fecha_gestion = ?,
                        hal_descripcion_gestion = ?,
                        hal_ruta_doc_gestion = ?,
                        hal_estado = ?
                    WHERE hal_id = ?";

                $this->pdo->prepare($sql)
                ->execute(
                    array(  
                        $idusuarioR,
                        $fechalog,
                        $data->descripcion_Gestion,
                        $data->ruta_doc_gestion,
                        1,
                        $data->id
                    )
                ); 
                $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuarioR','$tipolog')");
            } catch (Exception $ex) {
                die($ex->getMessage());
            }
        }
       
        
        
    }
    // JUAN ESTEBAN MUNERA BETANCUR
?>