<?php
    // JUAN ESTEBAN MUNERA BETANCUR
    require_once 'database.php';
    class HojaVida{
	private $pdo;
    
        public $id;
        public $per_id_usuario;
        public $per_cedula;
        public $per_nombres;
        public $per_apellidos;
        public $per_fecha_nacimiento;
        public $per_id_departamento;
        public $per_id_municipio;
        public $per_direccion;
        public $per_telefono;
        public $per_celular;
        public $per_email;
        public $per_ruta_foto;
        //VAR FORMACION PROFESIONAL
        public $for_pro_id_nivel;
        public $for_pro_institucion;
        public $for_pro_titulo;
        public $for_pro_fecha_inicio;
        public $for_pro_fecha_fin;
        public $usuario;
        //VAR EXPERIENCIA LABORAL
        public $exp_empresa;
        public $exp_cargo;
        public $exp_id_departamento;
        public $exp_id_municipio;
        public $exp_fecha_inicio;
        public $exp_fecha_actualmente;
        public $exp_rama;
        public $exp_fecha_fin;
        public $exp_ruta_certificado;
        //VAR REFERENCIAS PERSONALES
        public $ref_per_nombre;
        public $ref_per_cargo;
        public $ref_per_empresa;
        public $ref_per_telefono; 
        //VAR PERMISOS ESTUDIO
        public $per_est_num_resolucion;
        public $per_est_cedula;
        public $per_est_nombre;
        public $institucion;
        public $programa;
        public $per_est_ruta_doc_horario;
        public $per_est_ruta_doc_matricula;
        
        
        public function __CONSTRUCT(){
            try{
                $this->pdo = Database::StartUp();     
            }catch(Exception $e){
                die($e->getMessage());
            }
	}
        public function ListarUsuariosHV(){
            $listar = $this->pdo->prepare("SELECT `id`, `nombre_usuario` AS cedula, `empleado`
                FROM pa_usuario
                WHERE `bandera_hv` = 1");
            $listar->execute();
            return $listar->fetchAll(PDO::FETCH_OBJ);
        }
        public function ListarUs_VAcanteDef(){
            $listar = $this->pdo->prepare("SELECT `id`, `nombre_usuario` AS cedula, `empleado`
                FROM pa_usuario AS us
                INNER JOIN th_planta_personal AS pp ON us.id = pp.pla_id_usuario
                WHERE `bandera_hv` = 1 AND pp.pla_id_clase_nombra = 2 AND pla_id_usuario_reemplaza = 0 AND pla_estado=1;");
            $listar->execute();
            return $listar->fetchAll(PDO::FETCH_OBJ);
        }

        public function Listar_DatosPersona($user){
            $listar = $this->pdo->prepare("SELECT `per_id`, `per_id_usuario`, `per_cedula`, `per_nombres`, `per_apellidos`, `per_fecha_nacimiento`, 
                `per_id_dep_nacimiento`, `per_id_ciu_nacimiento`, `per_direccion`, `per_telefono`, `per_celular`, `per_email`, `per_ruta_foto`, 
                dep.nombre AS departamento, mun.nombre AS municipio
                FROM `th_personas` AS per
                INNER JOIN pa_departamento AS dep ON per.per_id_dep_nacimiento = dep.id
                INNER JOIN pa_municipio AS mun ON per.per_id_ciu_nacimiento = mun.id
                WHERE `per_id_usuario` = '$user'");
            $listar->execute();
            return $listar->fetchAll(PDO::FETCH_OBJ);
        }
        public function Obtener($id){
            try{
                $stm = $this->pdo
                        ->prepare("SELECT * FROM th_personas WHERE per_id = ?");
                $stm->execute(array($id));
                    return $stm->fetch(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
         public function get_usuario(){
            $listar = $this->pdo->prepare("SELECT * FROM th_personas");
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
        public function RegistrarDatosPersonales(HojaVida $data){
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new HojaVida();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            
            $tiporegistro   = "Info. Datos Personales";
            $accion         = "Registra una Nueva ".$tiporegistro." En el Sistema (HOJA VIDA) TALENTO HUMANO";
            $detalle        = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 15;
            $idusuario      = $_POST['id_usuarioR'];
            $idusuarioR     = $_SESSION['idUsuario'];
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();

                $sql = "INSERT INTO `th_personas`(`per_id_usuario`, `per_cedula`, `per_nombres`, `per_apellidos`, `per_fecha_nacimiento`,
                    `per_id_dep_nacimiento`, `per_id_ciu_nacimiento`, `per_direccion`, `per_telefono`, `per_celular`, `per_email`, `per_ruta_foto`, 
                    `per_id_usuarioR`) 
                            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->id_usuario,
                        $data->per_cedula,
                        $data->per_nombres,
                        $data->per_apellidos,
                        $data->per_fecha_nacimiento,
                        $data->per_id_departamento,
                        $data->per_id_municipio,
                        $data->per_direccion,
                        $data->per_telefono,
                        $data->per_celular,
                        $data->per_email,
                        $data->per_ruta_foto,
                        $idusuarioR
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
        public function ActualizarDatosPersonales($data){
            try{
                $sql = "UPDATE th_personas SET 
                        per_cedula = ?,
                        per_nombres = ?, 
                        per_apellidos = ?,
                        per_fecha_nacimiento = ?,
                        per_id_dep_nacimiento = ?,
                        per_id_ciu_nacimiento = ?,
                        per_direccion = ?,
                        per_telefono = ?,
                        per_celular = ?,
                        per_email = ?,
                        per_ruta_foto = ?
                    WHERE per_id = ?";

                $this->pdo->prepare($sql)
                ->execute(
                    array(  
                        $data->per_cedula,
                        $data->per_nombres,
                        $data->per_apellidos,
                        $data->per_fecha_nacimiento,
                        $data->per_id_departamento,
                        $data->per_id_municipio,
                        $data->per_direccion,
                        $data->per_telefono,
                        $data->per_celular,
                        $data->per_email,
                        $data->per_ruta_foto,
                        $data->id
                    )
                ); 
            } catch (Exception $ex) {
                die($ex->getMessage());
            }
        }
                // JUAN ESTEBAN MÙNERA BETANCUR 2019-02-01
        public function RegistrarDatosPersonalesForaneo(HojaVida $data){
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new HojaVida();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            
            $tiporegistro   = "Info. Datos Personales (FORANEO)";
            $accion         = "Registra una Nueva ".$tiporegistro." En el Sistema (HOJA VIDA) TALENTO HUMANO";
            $detalle        = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 15;
            $idusuario      = $_POST['id_usuarioR'];
            $idusuarioR     = $_SESSION['idUsuario'];
            
            $nombre_completo = $data->per_nombres." ".$data->per_apellidos;
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();
                
                $this->pdo->exec("INSERT INTO pa_usuario (`nombre_usuario`, `idperfil`, `tipo_perfil`, `empleado`, `contrasena`, `id_area_cs`,
                         `id_proceso_cs`, `bandera_hv`, `idareaempleado`, `idestadoempleado`, `ingreso`, `especialidad`, `bd`, `server_name`) 
                         VALUES ('$data->per_cedula', '23','empleado','$nombre_completo','xxxxx','15','12','1','7','0','0','especialidad','BD','XXX.XXX.XX.XX')");
                
                $listar = $this->pdo->prepare("SELECT MAX(us.id) AS idmaximo
                                            FROM pa_usuario AS us");
                $listar->execute();
                $dato = $listar->fetch();
                $contadorU = $dato[idmaximo];
                //echo "contador max: ".$contadorU;
                $sql = "INSERT INTO `th_personas`(`per_id_usuario`, `per_cedula`, `per_nombres`, `per_apellidos`, `per_fecha_nacimiento`,
                    `per_id_dep_nacimiento`, `per_id_ciu_nacimiento`, `per_direccion`, `per_telefono`, `per_celular`, `per_email`, `per_ruta_foto`, 
                    `per_id_usuarioR`) 
                            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $contadorU,
                        $data->per_cedula,
                        $data->per_nombres,
                        $data->per_apellidos,
                        $data->per_fecha_nacimiento,
                        $data->per_id_departamento,
                        $data->per_id_municipio,
                        $data->per_direccion,
                        $data->per_telefono,
                        $data->per_celular,
                        $data->per_email,
                        $data->per_ruta_foto,
                        $idusuarioR
                    )
                ); 
                //$this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
                
                //SE TERMINA LA TRANSACCION  
                $this->pdo->commit();
            } catch (Exception $e) {
                $this->pdo->rollBack();
                die($e->getMessage());
            }
        }

        public function Registrar_FormacionProfesional(HojaVida $data){
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new HojaVida();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            
            $tiporegistro   = "Formación Profesional";
            $accion         = "Registra una Nueva ".$tiporegistro." En el Sistema (Hoja vida) TALENTO HUMANO";
            $detalle        = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 15;
            $idusuario      = $_SESSION['idUsuario'];
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();

                $sql = "INSERT INTO `th_formacion_profesional`(`for_pro_id_HV`, `for_pro_id_user`, `for_pro_id_userR`, `for_pro_id_nivel_educacion`, 
                    `for_pro_titulo`,`for_pro_institucion`, `for_pro_fecha_inicio`, `for_pro_fecha_fin`, `for_pro_ruta_certificado`) 
                        VALUES (?,?,?,?,?,?,?,?,?)";
                $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->id,
                        $data->usuario,
                        $idusuario,
                        $data->for_pro_id_nivel,
                        $data->for_pro_titulo,
                        $data->for_pro_institucion,
                        $data->for_pro_fecha_inicio,
                        $data->for_pro_fecha_fin,
                        $data->for_pro_ruta_certificado
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
        public function Actualizar_FormacionProfesional($data) {
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new HojaVida();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            
            $tiporegistro   = "Formación Profesional";
            $accion         = "Actualiza una Nueva ".$tiporegistro." En el Sistema (Hoja vida) TALENTO HUMANO";
            $detalle        = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 15;
            $idusuario      = $_SESSION['idUsuario'];
            try{
                $sql = "UPDATE th_formacion_profesional SET 
                        for_pro_id_userE = ?,
                        for_pro_id_nivel_educacion = ?, 
                        for_pro_titulo = ?,
                        for_pro_institucion = ?,
                        for_pro_fecha_inicio = ?,
                        for_pro_fecha_fin = ?,
                        for_pro_ruta_certificado = ?
                    WHERE for_pro_id = ?";

                $this->pdo->prepare($sql)
                ->execute(
                    array(  
                        $idusuario,
                        $data->id_nivel,
                        $data->for_pro_titulo,
                        $data->for_pro_institucion,
                        $data->for_pro_fecha_inicio,
                        $data->for_pro_fecha_fin,
                        $data->for_pro_ruta_certificado,
                        $data->id
                    )
                ); 
                $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
            } catch (Exception $ex) {
                die($ex->getMessage());
            }
        }
        public function Registrar_Exp_Laboral(HojaVida $data){
            session_start();
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new HojaVida();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            
            $tiporegistro   = "Experiencia Laboral";
            $accion         = "Registra una Nueva ".$tiporegistro." En el Sistema (Hoja vida) TALENTO HUMANO";
            $detalle        = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 15;
            $idusuario      = $_SESSION['idUsuario'];
            //$idusuario      = $_POST['id_user'];;
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();

                $sql = "INSERT INTO `th_experiencia_laboral`(`exp_id_hv`, `exp_id_usuario`,`exp_id_usuarioR`, `exp_id_departamento`, `exp_id_municipio`, 
                            `exp_rama_flag`, `exp_empresa`, `exp_cargo`, `exp_CS_flag`, `exp_id_area_CS`, `exp_fecha_inicio`, `exp_fecha_actualmente`, 
                            `exp_fecha_fin`,`exp_ruta_certificado`)
                        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->id,
                        $data->usuario,
                        $idusuario,
                        $data->exp_id_departamento,
                        $data->exp_id_municipio,
                        $data->exp_rama,
                        $data->exp_empresa,
                        $data->exp_cargo,
                        $data->exp_CS,
                        $data->exp_id_areaCS,
                        $data->exp_fecha_inicio,
                        $data->exp_fecha_actualmente,
                        $data->exp_fecha_fin,
                        $data->exp_ruta_certificado
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

        public function Actualizar_Exp_Laboral($data){
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new HojaVida();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            
            $tiporegistro   = "Experiencia Laboral";
            $accion         = "Actualiza una Nueva ".$tiporegistro." En el Sistema (Hoja vida) TALENTO HUMANO";
            $detalle        = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 15;
            $idusuario      = $_SESSION['idUsuario'];
            //$idusuario      = $_POST['id_user'];;
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();
                 $sql = "UPDATE th_experiencia_laboral SET 
                        exp_id_departamento = ?,
                        exp_id_municipio = ?, 
                        exp_rama_flag = ?,
                        exp_empresa = ?,
                        exp_cargo = ?,
                        exp_CS_flag = ?,
                        exp_id_area_CS = ?,
                        exp_fecha_inicio = ?,
                        exp_fecha_actualmente = ?,
                        exp_fecha_fin = ?,
                        exp_ruta_certificado = ?,
                        exp_id_usuarioE = ?
                    WHERE exp_id = ?";

                $this->pdo->prepare($sql)
                ->execute(
                    array(  
                        $data->exp_id_departamento,
                        $data->exp_id_municipio,
                        $data->exp_rama,
                        $data->exp_empresa,
                        $data->exp_cargo,
                        $data->exp_CS_flag,
                        $data->exp_id_area,
                        $data->exp_fecha_inicio,
                        $data->exp_fecha_actualmente,
                        $data->exp_fecha_fin,
                        $data->exp_ruta_certificado,
                        $idusuario,
                        $data->id
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
		
		public function Eliminar_Exp_Laboral($data){
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new HojaVida();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            $tiporegistro   = "Experiencia Laboral";
            $accion         = "Elimina una Nueva ".$tiporegistro." de el Sistema (Hoja vida) TALENTO HUMANO";
            $detalle        = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 15;
            $idusuario      = $_SESSION['idUsuario'];
            //$idusuario      = $_POST['id_user'];;
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();
                 $sql = "DELETE FROM th_experiencia_laboral WHERE exp_id = ?";

                $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->id
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
        
        public function Registrar_Ref_Personal(HojaVida $data){
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new HojaVida();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            
            $tiporegistro   = "Referencia Personal";
            $accion         = "Registra una Nueva ".$tiporegistro." En el Sistema (Hoja vida) TALENTO HUMANO";
            $detalle        = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 15;
            $idusuario      = $_SESSION['idUsuario'];
            
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();

                $sql = "INSERT INTO `th_referencias_personales`(`ref_id_hv`, `ref_id_usuario`, `ref_id_usuarioR`, `ref_nombre`, `ref_cargo`, `ref_empresa`, `ref_telefono`) 
                            VALUES (?,?,?,?,?,?,?)";
                $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->id,
                        $data->usuario,
                        $idusuario,
                        $data->ref_per_nombre,
                        $data->ref_per_cargo,
                        $data->ref_per_empresa,
                        $data->ref_per_telefono
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
        public function Editar_Ref_Personal($data) {
            try{
                $idusuario  = $_SESSION['idUsuario'];
                $sql = "UPDATE th_referencias_personales SET 
                        ref_nombre = ?,
                        ref_cargo = ?, 
                        ref_empresa = ?,
                        ref_telefono = ?,
                        ref_id_usuarioE = ?
                    WHERE ref_id = ?";

                $this->pdo->prepare($sql)
                ->execute(
                    array(  
                        $data->ref_per_nombre,
                        $data->ref_per_cargo,
                        $data->ref_per_empresa,
                        $data->ref_per_telefono,
                        $idusuario,
                        $data->id
                    )
                ); 
            } catch (Exception $ex) {
                die($ex->getMessage());
            }
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
        public function get_Datos_HV($person){
            $listar = $this->pdo->prepare("SELECT `hv_id`, `hv_id_persona` FROM th_hoja_vida WHERE `hv_id_persona` = '$person'");
            $listar->execute();
            return $listar;
        }
        public function Listar_FormacionProfesional($id_hv){
            try{
                $listar = $this->pdo->prepare("CALL `HV_Listar_Estudios` ('$id_hv') ");
                $listar->execute();
                return $listar->fetchAll(PDO::FETCH_OBJ);
            }catch (Exception $ex) {
                die($ex->getMessage());
            }
        }
        public function Listar_Exp_Laboral($id_hv){
            $listar = $this->pdo->prepare("SELECT `for_pro_id`,`for_pro_id_HV`, `for_pro_id_user`, `for_pro_id_nivel_educacion`, `for_pro_titulo`,
 `for_pro_institucion`, `for_pro_fecha_inicio`, `for_pro_fecha_fin`, `for_pro_ruta_certificado`,
niv_titulo FROM th_formacion_profesional AS est
INNER JOIN th_nivel_educacion AS niv ON est.for_pro_id_nivel_educacion = niv.niv_id
WHERE est.for_pro_id_HV=$id_hv");
            $listar->execute();
            return $listar->fetchAll(PDO::FETCH_OBJ);
        }
        public function Listar_Ref_Personal($id_hv){
            $listar = $this->pdo->prepare("CALL `HV_Listar_Ref_Personal` ('$id_hv' ) ");
            $listar->execute();
            return $listar->fetchAll(PDO::FETCH_OBJ);
        }
        public function get_nivelEducacion(){
            $listar = $this->pdo->prepare("SELECT * FROM th_nivel_educacion ");
            $listar->execute();
            return $listar;
        }
        public function get_dato_Usuario($cedula){
            $listar = $this->pdo->prepare("SELECT * FROM pa_usuario WHERE `nombre_usuario` = '$cedula'");  
            $listar->execute();
            return $listar;
        }
        public function get_fecha_actual(){	
            date_default_timezone_set('America/Bogota'); 
            $fecharegistro=date('Y-m-d g:ia'); 
            return $fecharegistro; 
	   }
       // JUAN ESTEBAN 2019-02-01
        public function get_Datos_User($id_us){
            $listar = $this->pdo->prepare("SELECT * FROM pa_usuario WHERE `id` = '$id_us'");  
            $listar->execute();
            return $listar;
        }

        //*********************************************************************************************************************
        
        // ********************** SOLICITUD PERMISOS ESTUDIO *****************************************************************
        public function Registrar_Permiso_Estudio(HojaVida $data){
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new HojaVida();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            
            $tiporegistro   = "Solicitud Permiso para Estudio";
            $accion         = "Registra una Nueva ".$tiporegistro." En el Sistema TALENTO HUMANO";
            $detalle        = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 15;
            $idusuario     = $_SESSION['idUsuario'];
            
            
            $per_est_id = $_POST['per_est_id'];
            $per_DI_other = $_POST['cedula_other'];
            $per_name_other = $_POST['nombre_other'];
            if($per_DI_other !="" && $per_name_other !=""){
                $cedula_solicitante = $_POST['cedula_other'];
                $nombre_solicitante = $_POST['nombre_other'];
            }else{
                $cedula_solicitante = $_SESSION['nomusu'];
                $nombre_solicitante = $_SESSION['nombre'];
            }
            $arreglo_H =  $_POST['m_lunes']; //4
            $arreglo_M =  $_POST['m_martes'];
            $arreglo_I =  $_POST['m_miercoles'];
            $arreglo_J =  $_POST['m_jueves'];
            $arreglo_V =  $_POST['m_viernes'];
            
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();

                if( empty($per_est_id) ){
                    $sql = "INSERT INTO `th_permiso_estudio`(
                            `per_est_fecha_solicitud`, 
                            `per_est_cedula`, 
                            `per_est_nombre`,
                            `per_est_id_usuario`, 
                            `per_est_institucion`, 
                            `per_est_programa`,  
                            `per_est_fecha_inicio`,  
                            `per_est_fecha_final`, 
                            `per_est_ruta_doc_horario`, 
                            `per_est_ruta_doc_matricula`,
                            `per_est_estado`, 
                            `per_est_periodo_academico`) 
                            VALUES  (?,?,?,?,?,?,?,?,?,?,?,?)";
                    $this->pdo->prepare($sql)
                    ->execute(
                        array(
                            $fechalog,
                            $cedula_solicitante,
                            $nombre_solicitante,
                            $idusuario,
                            $data->institucion,
                            $data->programa,
                            $data->fechaI,
                            $data->fechaF,
                            $data->per_est_ruta_doc_horario,
                            $data->per_est_ruta_doc_matricula,
                            0, 
                            $data->periodo_acad 
                        )
                    ); 
                    $listar = $this->pdo->prepare("SELECT MAX(cons.per_est_id) AS idmaximo
                                            FROM th_permiso_estudio AS cons");
                    $listar->execute();
                    $dato = $listar->fetch();
                    $contadorM = $dato[idmaximo];
                    $this->pdo->exec("INSERT INTO `th_permiso_horario`(`per_hor_id_permisoEstudio`, `per_hor_cod_dia`, `per_hor_dia`, `per_hor_hora_inicio`, `per_hor_hora_fin`, `per_hor_flag`, `per_hor_hora_inicio1`, `per_hor_hora_fin1`) 
                            VALUES ('$contadorM', '$arreglo_H[0]','$arreglo_H[1]','$arreglo_H[2]','$arreglo_H[3]','$arreglo_H[4]','$arreglo_H[5]','$arreglo_H[6]' )");
                
                    $this->pdo->exec("INSERT INTO `th_permiso_horario`
                        (`per_hor_id_permisoEstudio`, 
                         `per_hor_cod_dia`, 
                         `per_hor_dia`, 
                         `per_hor_hora_inicio`, 
                         `per_hor_hora_fin`, 
                         `per_hor_flag`, 
                         `per_hor_hora_inicio1`, 
                         `per_hor_hora_fin1`)  
                        VALUES 
                        ('$contadorM', 
                         '$arreglo_M[0]',
                         '$arreglo_M[1]',
                         '$arreglo_M[2]',
                         '$arreglo_M[3]',
                         '$arreglo_M[4]', /*Error*/
                         '$arreglo_M[5]',
                         '$arreglo_M[6]' )");

                    $this->pdo->exec("INSERT INTO `th_permiso_horario`(`per_hor_id_permisoEstudio`, `per_hor_cod_dia`, `per_hor_dia`, `per_hor_hora_inicio`, `per_hor_hora_fin`, `per_hor_flag`, `per_hor_hora_inicio1`, `per_hor_hora_fin1`) 
                            VALUES ('$contadorM', '$arreglo_I[0]','$arreglo_I[1]','$arreglo_I[2]','$arreglo_I[3]','$arreglo_I[4]','$arreglo_I[5]','$arreglo_I[6]' )");

                    $this->pdo->exec("INSERT INTO `th_permiso_horario`(`per_hor_id_permisoEstudio`, `per_hor_cod_dia`, `per_hor_dia`, `per_hor_hora_inicio`, `per_hor_hora_fin`, `per_hor_flag`, `per_hor_hora_inicio1`, `per_hor_hora_fin1`) 
                            VALUES ('$contadorM', '$arreglo_J[0]','$arreglo_J[1]','$arreglo_J[2]','$arreglo_J[3]','$arreglo_J[4]','$arreglo_J[5]','$arreglo_J[6]' )");

                    $this->pdo->exec("INSERT INTO `th_permiso_horario`(`per_hor_id_permisoEstudio`, `per_hor_cod_dia`, `per_hor_dia`, `per_hor_hora_inicio`, `per_hor_hora_fin`, `per_hor_flag`, `per_hor_hora_inicio1`, `per_hor_hora_fin1`) 
                            VALUES ('$contadorM', '$arreglo_V[0]','$arreglo_V[1]','$arreglo_V[2]','$arreglo_V[3]','$arreglo_V[4]','$arreglo_V[5]','$arreglo_V[6]' )");


//                    $this->pdo->exec("UPDATE sigdoc_pa_consecutivo SET contador = '$consecutivo' WHERE id = 3");
                    $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
                }else{
                    
                }
                //SE TERMINA LA TRANSACCION  
                $this->pdo->commit();
            } catch (Exception $e) {
                $this->pdo->rollBack();
                die($e->getMessage());
            }
        }
        public function Lista_Permisos_EstudioAdmin(){
            try{
                $stm = $this->pdo->prepare("SELECT `per_est_id`, `per_est_num_resolucion`, `per_est_fecha_solicitud`, `per_est_cedula`, 
                    `per_est_nombre`, `per_est_id_usuario`, `per_est_id_usuarioE`, `per_est_fechaE`, `per_est_institucion`, `per_est_programa`, 
                    `per_est_fecha_inicio`, `per_est_fecha_final`, `per_est_ruta_doc_horario`, `per_est_ruta_doc_matricula`, `per_est_estado`
                    FROM th_permiso_estudio AS per 
                    ORDER BY per.per_est_fecha_solicitud DESC, per.per_est_id DESC");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch(Exception $e){
                die($e->getMessage());
            }
        }
        public function Lista_Permisos_Estudio_for_US($id_user){
            try{
                $stm = $this->pdo->prepare("SELECT `per_est_id`, `per_est_num_resolucion`, `per_est_fecha_solicitud`, `per_est_cedula`,
                    `per_est_nombre`, `per_est_id_usuario`, `per_est_id_usuarioE`, `per_est_fechaE`, `per_est_institucion`, `per_est_programa`,
                    `per_est_fecha_inicio`, `per_est_fecha_final`, `per_est_ruta_doc_horario`, `per_est_ruta_doc_matricula`, `per_est_estado`
                    FROM th_permiso_estudio AS per
                    WHERE per.per_est_id_usuario = $id_user
                    ORDER BY per.per_est_fecha_solicitud DESC");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }catch(Exception $e){
                die($e->getMessage());
            }
        }
        
        public function Cambiar_Estado_permiso($data){ // cambia de estado el permiso de estudio.
            date_default_timezone_set('America/Bogota'); 
            $fecha_actual = date('Y-m-d');
            try{
                $idusuario  = $_SESSION['idUsuario'];
                $modelo     = new HojaVida();
                
                $fechahora  = $modelo->get_fecha_actual();
                $datosfecha = explode(" ",$fechahora);
                $fechalog   = $datosfecha[0];
                $horalog    = $datosfecha[1];

                $accion  = "Se Actualiza de Estado la Solicitud de Permiso de Estudio ";
                $detalle = utf8_encode($_SESSION['nombre'])." "."Se actualiza una Solicitud de Permiso ".$fechalog." "."a las: ".$horalog;
                $tipolog = 15;
                
                $idusuario = $_SESSION['idUsuario'];
                $dato_sec  = $modelo->get_max_cons_resolucion();
                while($row = $dato_sec->fetch()){
                    $contador = $row['con_consecutivo']+1;
                }
                $max = $contador;
                if($contador >= 0 && $contador <= 9){$contador = "00".$contador;}
                if($contador >  9 && $contador <= 99){$contador = "0".$contador;}

                if( $data->estado == 1){
                    $valor = "Se Aprueba ";
                }else if ($data->estado == 2){
                    $valor = "No Se Aprueba ";
                }else{
                    $valor = " ";
                }
                if($data->estado == 1)
                {
                    $this->pdo->exec("UPDATE th_contador_resoluciones SET con_consecutivo ='$max'");
                    $sql = "UPDATE th_permiso_estudio SET 
                            per_est_num_resolucion = ?, 
                            per_est_id_usuarioE = ?,
                            per_est_fechaE = ?,
                            per_est_estado = ?,
                            per_est_observaciones = ?
                        WHERE per_est_id = ?";

                    $this->pdo->prepare($sql)
                    ->execute(
                        array(  
                            $contador, 
                            $idusuario,
                            $fecha_actual,
                            $data->estado,
                            $data->observaciones,
                            $data->id
                        )
                    ); 
                }
                else if ($data->estado == 2)
                {
                    $sql = "UPDATE th_permiso_estudio SET 
                            per_est_id_usuarioE = ?,
                            per_est_fechaE = ?,
                            per_est_estado = ?,
                            per_est_observaciones = ?
                        WHERE per_est_id = ?";

                    $this->pdo->prepare($sql)
                    ->execute(
                        array( 
                            $idusuario,
                            $fecha_actual,
                            $data->estado,
                            $data->observaciones,
                            $data->id
                        )
                    ); 
                }
                $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");

                /*$bandera=1;
                if ($bandera == 1){ 
                    echo 'son las variables iguales';
                    echo '<script language="javascript">notifyMe();</script> ';
                } else {echo "No son iguales!";}*/
            } 
            catch (Exception $ex) 
            {
                die($ex->getMessage());
            }
        }

        public function Registrar_Permiso_Basico(HojaVida $data){
            session_start();
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new HojaVida();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            
            $accion  = "Se Registra una Nueva Solicitud de Permiso";
            $detalle = utf8_encode($_SESSION['nombre'])." "."Registra una Nueva Solicitud de Permiso ".$fechalog." "."a las: ".$horalog;
            $tipolog = 15;
            $idusuario = $_SESSION['idUsuario'];
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();
                
                $sql = "INSERT INTO empleado_permiso (idusuario,fecha_solicitud,fecha_permiso,hora_inicio,hora_final,detalle, doc_adjunto, flag_out,flag_votacion,estado)
                        VALUES  (?,?,?,?,?,?,?,?,?,?)";
                $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $idusuario,
                        $fechalog,
                        $data->fecha_permiso,
                        $data->hora_inicio,
                        $data->hora_fin,
                        $data->comentarios,
                        $data->per_ruta_doc_adjunto,
                        $data->per_out,
                        $data->per_vot,
                        2
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


        public function Registrar_Permiso_Mayor(HojaVida $data)
        {
            session_start();
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new HojaVida();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            
            $accion  = "Se Registra una Nueva Solicitud de Permiso";
            $detalle = utf8_encode($_SESSION['nombre'])." "."Registra una Nueva Solicitud de Permiso ".$fechalog." "."a las: ".$horalog;
            $tipolog = 15;
            $idusuario = $_SESSION['idUsuario'];

            try
            {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo->beginTransaction();

                $sql = "INSERT INTO empleado_permiso_mayor (idusuario, idusuario_registra, fecha_solicitud, detalle, doc_adjunto, flag_out, estado)
                        VALUES (?, ?, ?, ?, ?, ?, ?);";
                $this->pdo->prepare($sql)->execute(array(
                    $idusuario,  //$data->per_id_usuario,  // usuario que necesita el permiso.
                    $idusuario,             // usuario que registra el permiso.
                    $fechalog,  
                    $data->comentarios, 
                    $data->per_ruta_doc_adjunto, 
                    $data->per_out,
                    2
                ));
                $query = $this->pdo->prepare("SELECT MAX(id) AS idmaximo FROM empleado_permiso_mayor;");
                $query->execute();
                $query_fetch = $query->fetch();
                $idmaximo = $query_fetch[idmaximo];

                //$arrFechai = $_POST["fechai"];
                $arrFecha = $_POST["fecha"];
                $arrHorai = $_POST["horai"];
                $arrHoraf = $_POST["horaf"];

                for($i = 0; $i < $_POST['h_numero_fecha']; $i++)
                {
                    $this->pdo->exec("INSERT INTO empleado_permiso_mayor_fecha (id_permiso_mayor, fecha, hora_inicio, hora_final) VALUES ('$idmaximo', '$arrFecha[$i]', '$arrHorai[$i]', '$arrHoraf[$i]');");
                }
                $this->pdo->exec("INSERT INTO log (fecha, accion, detalle, idusuario, idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");

                $this->pdo->commit();
            }
            catch (Exception $e) 
            {
                $this->pdo->rollBack();
                die($e->getMessage());
            }
        }

        public function Actualizar_Estado_Permiso_Mayor($data)
        {
            session_start();
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new HojaVida();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            $bandera_out = $data->flag_out;
            date_default_timezone_set('America/Bogota'); 
            $dato_sec  = $modelo->get_max_cons_resolucion();
            while($row = $dato_sec->fetch()){
                $contador = $row['con_consecutivo'] + 1;
            }
            $max = $contador;
            if($contador >= 0 && $contador <= 9){$contador = "00".$contador;}
            if($contador >  9 && $contador <= 99){$contador = "0".$contador;}
            
            if( $data->estado == 1){
                $valor = "Se Aprueba ";
            }else if ($data->estado == 0){
                $valor = "No Se Aprueba ";
            }else{
                $valor = " ";
            }
            $accion  = "Se Actualiza de Estado a Solicitud de Permiso mayor a un día";
            $detalle = utf8_encode($_SESSION['nombre'])." "."Actualiza de Estado a una Solicitud de Permiso mayor a un día ".$fechalog." "."a las: ".$horalog." ACCION: ".$valor;
            $tipolog = 15;
            $idusuario  = $_SESSION['idUsuario'];
            try{
                if($data->estado == 1){
                    $num_resolucion = $contador;
                    $this->pdo->exec("UPDATE th_contador_resoluciones SET con_consecutivo ='$max'");
                    /*if($bandera_out >0){
                        $num_resolucion = $contador;
                        $this->pdo->exec("UPDATE th_contador_resoluciones SET con_consecutivo ='$max'");
                    }else{
                        $num_resolucion ="";
                    }*/
                    $sql = "UPDATE empleado_permiso_mayor SET estado = ?, num_resolucion = ?, observaciones= ?, fecha_aprobado = ? WHERE id = ?";
                    $this->pdo->prepare($sql)
                    ->execute(
                        array(
                            $data->estado,
                            $num_resolucion,
                            $data->observaciones,
                            $data->fecha_aprobado, 
                            $data->id
                        )
                    );
                }
                else if ($data->estado == 0)
                {
                    $sql = "UPDATE empleado_permiso_mayor SET estado = ?, observaciones= ? WHERE id = ?";
                    $this->pdo->prepare($sql)
                    ->execute(
                        array(
                            $data->estado,
                            $data->observaciones,
                            $data->id
                        )
                    );
                }
                $this->pdo->exec("INSERT INTO log (fecha, accion, detalle, idusuario, idtipolog) VALUES ('$fechalog', '$accion','$detalle', '$idusuario', '$tipolog')");
            } 
            catch (Exception $ex) 
            {
                die($ex->getMessage());
            }
        }






        public function get_datos_usuariosJE(){
            $listar     = $this->pdo->prepare("SELECT * FROM pa_usuario WHERE idperfil!=22 AND idestadoempleado=1 ORDER BY empleado");
            $listar->execute();
            return $listar;
        }
        public function get_lista_permisos($identrada){
            if($identrada == 1){
                $listar = $this->pdo->prepare("SELECT ep.id, ep.idusuario,pu.empleado,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle, ep.doc_adjunto,ep.flag_out, ep.flag_votacion, ep.num_resolucion,ep.estado,
                                                CASE
                                                    WHEN
                                                        (ep.hora_inicio >= '07:00' AND ep.hora_inicio <= '12:00') AND (ep.hora_final >= '14:00' AND ep.hora_final <= '23:00')
                                                        THEN
                                                            TIMEDIFF( TIMEDIFF(ep.hora_final,ep.hora_inicio),'2:00')
                                                        ELSE
                                                            TIMEDIFF(ep.hora_final,ep.hora_inicio)
                                                    END
                                                        AS duracion
                                                FROM (empleado_permiso ep INNER JOIN pa_usuario pu ON ep.idusuario = pu.id)
                                                ORDER BY ep.id DESC LIMIT 10");
            }
            if($identrada == 2){
                $filtrox;
                $filtro1;
                $filtro2;
                $filtro3;
                $usuario = trim($_GET['dato_1b']);
                $fechad  = trim($_GET['dato_2b']);
                $fechah  = trim($_GET['dato_3b']);
                $estado  = trim($_GET['dato_4b']);			
                if ( !empty($usuario) ) {	
                    $filtro1 = " AND ep.idusuario = '$usuario' ";
                }
                if ( !empty($fechad) && !empty($fechah) ) {		
                    $filtro2 = " AND (ep.fecha_solicitud >= '$fechad' AND ep.fecha_solicitud <= '$fechah') ";
                }
                if ( $estado != '') {
                    $filtro3 = " AND ep.estado = '$estado' ";
                }
                $filtrox = $filtro1." ".$filtro2." ".$filtro3;	
                $listar    = $this->pdo->prepare("SELECT ep.id, ep.idusuario,pu.empleado,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle, ep.doc_adjunto, ep.flag_out, ep.num_resolucion,ep.estado,
                                                CASE						
                                                    WHEN
                                                        (ep.hora_inicio >= '07:00' AND ep.hora_inicio <= '12:00') AND (ep.hora_final >= '14:00' AND ep.hora_final <= '23:00')
                                                    THEN
                                                        TIMEDIFF( TIMEDIFF(ep.hora_final,ep.hora_inicio),'2:00')
                                                    ELSE
                                                        TIMEDIFF(ep.hora_final,ep.hora_inicio)
                                                    END
                                                        AS duracion
                                                FROM (empleado_permiso ep INNER JOIN pa_usuario pu ON ep.idusuario = pu.id) 
                                                WHERE ep.id >= '1'" .$filtrox. " ORDER BY ep.id DESC");
            }
            $listar->execute();
            return $listar;
        }
        public function get_lista_Mis_permisos() {
            session_start();
            $idusuario = $_SESSION['idUsuario'];
            $listar = $this->pdo->prepare("SELECT ep.id, ep.idusuario,pu.empleado,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle, ep.doc_adjunto,ep.estado, 
                                            CASE						
                                                WHEN
                                                    (ep.hora_inicio >= '07:00' AND ep.hora_inicio <= '12:00') AND (ep.hora_final >= '14:00' AND ep.hora_final <= '23:00')
                                                THEN
                                                    TIMEDIFF( TIMEDIFF(ep.hora_final,ep.hora_inicio),'2:00')
                                                ELSE
                                                    TIMEDIFF(ep.hora_final,ep.hora_inicio)
                                                END
                                                    AS duracion
                                            FROM (empleado_permiso ep INNER JOIN pa_usuario pu ON ep.idusuario = pu.id) 
                                            WHERE ep.id >= '1' AND ep.idusuario = '$idusuario' ORDER BY ep.id DESC LIMIT 10");
            $listar->execute();
            return $listar;
        }


        public function get_lista_permisos_mayor()
        {
            $listar = $this->pdo->prepare("SELECT ep.id, ep.idusuario, us.empleado, ep.idusuario_registra, ep.fecha_solicitud, ep.detalle, ep.doc_adjunto, ep.flag_out, ep.num_resolucion, ep.observaciones, ep.estado FROM empleado_permiso_mayor ep INNER JOIN pa_usuario us ON ep.idusuario = us.id ORDER BY ep.id DESC");
            $listar->execute();
            return $listar;
        }

        public function get_lista_mis_permisos_mayor($idUser)
        {
            /*session_start();
            $idusuario = $_SESSION['idUsuario'];*/
            $listar = $this->pdo->prepare("SELECT ep.id, ep.idusuario, us.empleado, ep.idusuario_registra, ep.fecha_solicitud, ep.detalle, ep.doc_adjunto, ep.flag_out, ep.num_resolucion, ep.observaciones, ep.estado FROM empleado_permiso_mayor ep INNER JOIN pa_usuario us ON ep.idusuario = us.id WHERE ep.id > 0 AND ep.idUsuario = '".$idUser."' ORDER BY ep.id DESC");
            $listar->execute();
            return $listar;
        }



        public function Actualizar_RegistroPermiso($data){
            session_start();
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new HojaVida();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            $bandera_out = $data->flag_out;
            date_default_timezone_set('America/Bogota'); 
            $dato_sec  = $modelo->get_max_cons_resolucion();
            while($row = $dato_sec->fetch()){
                $contador = $row['con_consecutivo']+1;
            }
            $max = $contador;
            if($contador >= 0 && $contador <= 9){$contador = "00".$contador;}
            if($contador >  9 && $contador <= 99){$contador = "0".$contador;}
            
            if( $data->estado == 1){
                $valor = "Se Aprueba ";
            }else if ($data->estado == 0){
                $valor = "No Se Aprueba ";
            }else{
                $valor = " ";
            }
            $accion  = "Se Actualiza de Estado a Solicitud de Permiso";
            $detalle = utf8_encode($_SESSION['nombre'])." "."Actualiza de Estado a una Solicitud de Permiso ".$fechalog." "."a las: ".$horalog." ACCION: ".$valor;
            $tipolog = 15;
            try{
                $idusuario  = $_SESSION['idUsuario'];
                if($data->estado == 1){
                    if($bandera_out > 0){  // indica que el permiso es fuera de la ciudad
                        $num_resolucion = $contador;
                        $this->pdo->exec("UPDATE th_contador_resoluciones SET con_consecutivo ='$max'");
                    }else{
                        $num_resolucion ="";
                    }
                    $sql = "UPDATE empleado_permiso SET estado = ?, num_resolucion = ?, observaciones = ?, fecha_aprobado = ? WHERE id = ?";
                    $this->pdo->prepare($sql)
                    ->execute(
                        array(
                            $data->estado,
                            $num_resolucion,
                            $data->observaciones,
                            $data->fecha_aprobado,
                            $data->id
                        )
                    );
                }
                else if ($data->estado == 0)
                {
                    $sql = "UPDATE empleado_permiso SET estado = ?, observaciones= ? WHERE id = ?";
                    $this->pdo->prepare($sql)
                    ->execute(
                        array(
                            $data->estado,
                            $data->observaciones,
                            $data->id
                        )
                    );
                }
                $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
            } catch (Exception $ex) {
                die($ex->getMessage());
            }
        }
        public function get_max_cons_resolucion(){
            $listar = $this->pdo->prepare("SELECT con_consecutivo FROM th_contador_resoluciones");  
            $listar->execute();
            return $listar;
        }


        public function get_motivos_licencia_no_remunerada()
        {
            $listar = $this->pdo->prepare("SELECT * FROM th_motivo_licencia");  
            $listar->execute();
            return $listar;
        }
        public function get_max_ResNombramiento(){
            $listar = $this->pdo->prepare("SELECT MAX(res_nom_id) AS cont FROM th_resoluciones_nombra");  
            $listar->execute();
            return $listar;
        }

        public function Listar_Licencia_No_Remunerada()
        {
            try
            {
                // 5, 6 licencias de 3 meses y 2 años respectivamente.
                $query = $this->pdo->prepare("
                    SELECT t.lic_no_rem_id, 
                           t.lic_no_rem_id_tipo_resolucion, 
                           t.lic_no_rem_nombre_servidor, 
                           t.lic_no_rem_fecha_solicitud, 
                           t.lic_no_rem_fecha_inicio, 
                           t.lic_no_rem_fecha_fin, 
                           t.lic_no_rem_motivo, 
                           t.lic_no_rem_estado, 
                           t.lic_no_rem_ruta_resolucion, 
                           t.lic_no_rem_ruta_doc_escrito, 
                           t.lic_no_rem_cargo_cs  
                    FROM th_licencias_no_remunerada t 
                    WHERE t.lic_no_rem_id_tipo_resolucion = 5 || t.lic_no_rem_id_tipo_resolucion = 6;");
                $query->execute();
                return $query;
            }
            catch(Exception $e)
            {
                die($e->getMessage());
            }
        }

        public function Listar_Licencia_No_Remunerada_user($id_usuario)
        {
            try
            {
                // 5, 6 licencias de 3 meses y 2 años respectivamente.
                $query = $this->pdo->prepare("
                    SELECT t.lic_no_rem_id, 
                           t.lic_no_rem_id_tipo_resolucion, 
                           t.lic_no_rem_nombre_servidor, 
                           t.lic_no_rem_fecha_solicitud, 
                           t.lic_no_rem_fecha_inicio, 
                           t.lic_no_rem_fecha_fin, 
                           t.lic_no_rem_motivo, 
                           t.lic_no_rem_estado, 
                           t.lic_no_rem_ruta_resolucion, 
                           t.lic_no_rem_ruta_doc_escrito, 
                           t.lic_no_rem_cargo_cs  
                    FROM th_licencias_no_remunerada t 
                    WHERE (t.lic_no_rem_id_tipo_resolucion = 5 || t.lic_no_rem_id_tipo_resolucion = 6)  
                    AND   t.lic_no_rem_id_user = " . $id_usuario);
                $query->execute();
                return $query;
            }
            catch(Exception $e)
            {
                die($e->getMessage());
            }
        }

        public function Registrar_Licencia_noRemunerada3(HojaVida $data) {
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new HojaVida();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            
            if($data->lic_id_tipo == 5) 
            { // Licencia 3 meses
                $tiporegistro   = "Solicitud Licencia no Remunerada (3 Meses)";
            }
            else
            {
                $tiporegistro   = "Solicitud Licencia no Remunerada hasta por 2 años";
            }

            $accion         = "Registra una Nueva ".$tiporegistro." En el Sistema TALENTO HUMANO";
            $detalle        = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 15;
            $idusuario      = $_SESSION['idUsuario'];  // idusuario que registra la solicitud de licencia
            
            $per_DI_other   = $_POST['cedula_other'];
            $per_name_other = $_POST['nombre_other'];
            if($per_DI_other != "" && $per_name_other != "")
            {
                $id_usuario_soli    = $_POST['id_servidor'];  // id del usuario que solicita la licencia
                $cedula_solicitante = $_POST['cedula_other'];
                $nombre_solicitante = $_POST['nombre_other'];
                $cargo_solicitante  = $_POST['cargo_servidor'];
            }
            else
            {
                $id_usuario_soli    = $_SESSION['idUsuario'];  // id del usuario que solicita la licencia
                $cedula_solicitante = $_SESSION['nomusu'];
                $nombre_solicitante = $_SESSION['nombre'];
                $cargo_solicitante  = $_SESSION['cargo'];
            }
            try {

                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();
                
                $sql = "INSERT INTO `th_licencias_no_remunerada`(
                `lic_no_rem_id_tipo_resolucion`, 
                `lic_no_rem_fecha_solicitud`, 
                `lic_no_rem_fecha_escrito`, 
                `lic_no_rem_cedula_servidor`, 
                `lic_no_rem_nombre_servidor`, 
                `lic_no_rem_fecha_inicio`, 
                `lic_no_rem_fecha_fin`, 
                `lic_no_rem_motivo`, 
                `lic_no_rem_id_user`, 
                `lic_no_rem_estado`,
                `lic_no_rem_ruta_doc_escrito`, 
                `lic_no_rem_id_user_registra`, 
                `lic_no_rem_cargo_cs`) 
                    VALUES  (?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->lic_id_tipo,
                        $fechalog,
                        $data->fecha_escrito,
                        $cedula_solicitante,
                        $nombre_solicitante,
                        $data->fechaInicio,
                        $data->fechaFin,
                        $data->comentario,
                        $id_usuario_soli,
                        0,
                        $data->ruta_doc_adjunto, 
                        $idusuario, 
                        $cargo_solicitante
                    )
                );
                $this->pdo->exec("INSERT INTO log (fecha, accion, detalle, idusuario, idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");

                //SE TERMINA LA TRANSACCION  
                $this->pdo->commit();
            } catch (Exception $e) {
                $this->pdo->rollBack();
                die($e->getMessage());
            }
        }

        public function Actualizar_Estado_Licencia_No_Remunerada($data)
        {
            session_start();
            //DATOS PARA EL REGISTRO DEL LOG
            date_default_timezone_set('America/Bogota'); 
            $fecha_actual = date('Y-m-d'); 

            $modelo     = new HojaVida();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            $dato_sec  = $modelo->get_max_cons_resolucion();
            while($row = $dato_sec->fetch()){
                $contador = $row['con_consecutivo'] + 1;
            }
            $max = $contador;
            if($contador >= 0 && $contador <= 9){ $contador = "00".$contador; }
            if($contador >  9 && $contador <= 99){ $contador = "0".$contador; }
            if( $data->estado == 1) {
                $valor = "Se Aprueba ";
            }
            else if ($data->estado == 2) {
                $valor = "No Se Aprueba ";
            }
            else {
                $valor = " ";
            }
            $accion  = "Se Actualiza de Estado una solicitud de Licencia no Remunerada";
            $detalle = utf8_encode($_SESSION['nombre'])." "."Actualiza de Estado una Solicitud Licencia no Remunerada ".$fechalog." "."a las: ".$horalog." ACCION: ".$valor;
            $tipolog = 3;
            $idusuario  = $_SESSION['idUsuario'];

            try{
                if($data->estado == 1){
                    $num_resolucion = $contador;
                    $this->pdo->exec("UPDATE th_contador_resoluciones SET con_consecutivo ='$max'");

                    $sql = "UPDATE th_licencias_no_remunerada SET lic_no_rem_estado = ?, lic_no_rem_num_resolucion = ?, lic_no_rem_id_userE = ?, lic_no_rem_fechaE = ? WHERE lic_no_rem_id = ?";
                    $this->pdo->prepare($sql)
                    ->execute(
                        array(
                            $data->estado, 
                            $num_resolucion, 
                            $idusuario, 
                            $fecha_actual, 
                            $data->id 
                        )
                    );
                }
                else if ($data->estado == 2)
                {
                    $sql = "UPDATE th_licencias_no_remunerada SET lic_no_rem_estado = ?, lic_no_rem_id_userE = ?, lic_no_rem_fechaE = ? WHERE lic_no_rem_id = ?";
                    $this->pdo->prepare($sql)
                    ->execute(
                        array(
                            $data->estado,
                            $idusuario, 
                            $fecha_actual, 
                            $data->id
                        )
                    );
                }
                $this->pdo->exec("INSERT INTO log (fecha, accion, detalle, idusuario, idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
            } 
            catch (Exception $ex) 
            {
                die($ex->getMessage());
            }
        }

        // ***********************************************************************************************************************************************************************
        //  --------------- PLANTA DE PERSONAL ----------------------------------
        // JUAN ESTEBAN MUNERA BETANCUR 2019-02-05
        
        public function get_Cargos(){
            $listar     = $this->pdo->prepare("SELECT * FROM th_cargos WHERE car_flag =1 ORDER BY car_titulo ASC");
            $listar->execute();
            return $listar;
        }
        public function get_ClaseNombramiento(){
            $listar     = $this->pdo->prepare("SELECT * FROM th_clase_nombramiento WHERE clas_flag =1 ORDER BY clas_titulo ASC");
            $listar->execute();
            return $listar;
        }
        public function get_Ubicacion(){
            $listar     = $this->pdo->prepare("SELECT * FROM th_ubicacion WHERE ubi_flag =1 ORDER BY ubi_titulo ASC");
            $listar->execute();
            return $listar;
        }
        public function get_AreasCS(){
            $listar     = $this->pdo->prepare("SELECT * FROM mc_procesos_cs WHERE proc_flag =1 ORDER BY proc_titulo ASC");
            $listar->execute();
            return $listar;
        }
        public function RegistrarDatosPlantaPersonal(HojaVida $data){
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new HojaVida();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            
            $tiporegistro   = "Planta de Personal";
            $accion         = "Registro en ".$tiporegistro." En el Sistema (Planta de Personal) TALENTO HUMANO";
            $detalle        = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 15;
            $idusuario      = $_POST['id_usuarioR'];
            $idusuarioR     = $_SESSION['idUsuario'];
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();

                $sql = "INSERT INTO `th_planta_personal`(`pla_id_usuario`, `pla_fecha`, `pla_id_cargo`, `pla_id_clase_nombra`, 
                            `pla_flag_licencia`, `pla_num_resolucion`,`pla_id_res_nombramiento`, `pla_fecha_inicio`, `pla_fecha_fin`, 
                            `pla_id_ubicacion`, `pla_id_area_cs`, `pla_num_resolu_tras`, `pla_id_usuario_reemplaza`, `pla_id_userR`, 
                            `pla_flag_alerta`,`pla_estado`) 
                        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->id_usuario,
                        $fechalog,
                        $data->id_cargo,
                        $data->pla_id_clase_nombra,
                        $data->pla_flag_licencia,
                        $data->num_resolucion_nombramiento,
                        0,
                        $data->fecha_inicio,
                        $data->fecha_fin,
                        $data->id_ubicacion,
                        $data->id_area,
                        $data->num_resolucion_traslado,
                        $data->id_user_reemplaza,
                        $idusuarioR,
                        $data->flag_alerta,
                        1
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
        public function Lista_Planta_Personal(){
            $listar = $this->pdo->prepare("SELECT * FROM  `lista_planta_personal`");
            $listar->execute();
            return $listar->fetchAll(PDO::FETCH_OBJ);
        }
        public function Lista_Licencias_Planta_Personal(){
            $listar = $this->pdo->prepare("SELECT * FROM `lista_planta_personal` WHERE pla_flag_alerta = 1 AND pla_estado = 1");
            $listar->execute();
            return $listar->fetchAll(PDO::FETCH_OBJ);
        }

        public function Apagar_AlertaVencimiento($id, $us){
            try{
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();
                
                $this->pdo
                ->exec("UPDATE th_planta_personal SET 
                            pla_id_userE = '$us',
                            pla_fechaE = NOW(),
                            pla_flag_alerta = 0
                        WHERE pla_id = '$id'");
                
                $this->pdo->commit();
            } catch (Exception $ex) {
                $this->pdo->rollback();
                die($ex->getMessage());
            }
        }
        public function Registrar_usuario(HojaVida $data){ 
           try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();

                $sql = "INSERT INTO `pa_usuario`(`nombre_usuario`, `idperfil`, `tipo_perfil`, `empleado`, `contrasena`, `foto`,`id_area_cs` ,`id_proceso_cs`, `bandera_hv`, `idareaempleado`, `idestadoempleado`, `ingreso`)
                        VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
                $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->cedula,
                        20,
                        'empleado',
                        $data->nombres,
                        md5("cs2016"),
                        'views/fotos/u3.png',
                        0,
                        0,
                        1,
                        0,
                        0,
                        0
                    )
                ); 
                //SE TERMINA LA TRANSACCION  
                $this->pdo->commit();
            } catch (Exception $e) {
                $this->pdo->rollBack();
                die($e->getMessage());
            }
        }
        // REGISTRAR RESOLUCIÓN DE NOMBRAMIENTO
        public function Registrar_Res_Nombramiento(HojaVida $data){
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new HojaVida();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            
            $tiporegistro   = "Resolución Nombramiento";
            $accion         = "Registro en ".$tiporegistro." En el Sistema (Planta de Personal) TALENTO HUMANO";
            $detalle        = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog        = 15;
            $idusuario      = $_POST['id_usuarioR'];
            $idusuarioR     = $_SESSION['idUsuario'];
            try {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
                //EMPIEZA LA TRANSACCION
                $this->pdo->beginTransaction();
                
                $dato_sec  = $modelo->get_max_cons_resolucion();
                while($row = $dato_sec->fetch()){
                    $contador = $row['con_consecutivo']+1;
                }
                $max = $contador;
                if($contador >= 0 && $contador <= 9){$contador = "00".$contador;}
                if($contador >  9 && $contador <= 99){$contador = "0".$contador;}
                $fechaI = $data->fecha_inicio;
                if($data->id_clase_nombra ==3){
                    $nuevafecha = strtotime ( '+29 day' , strtotime ( $fechaI ) ) ;
                    $fechaFinal = date ( 'Y-m-j' , $nuevafecha );
                }else{
                    $fechaFinal = $data->fecha_fin;
                }
                if($fechaFinal !="0000-00-00"){
                    $alerta = 1;
                }else{
                    $alerta = 0;
                }
                
                $sql = "INSERT INTO `th_resoluciones_nombra`(`res_nom_id_clase_nombra`, `res_nom_id_usuario`, `res_nom_fecha`, 
                            `res_nom_id_cargo`, `res_nom_consecutivo`, `res_nom_id_user_reemplaza`, `res_nom_fecha_inicio`, 
                            `res_nom_flag_abierto`, `res_nom_fecha_fin`, `res_nom_cdp`,`res_nom_oficio`, `res_nom_acuerdo`, `res_nom_flag_first_vez`,
                            res_nom_numPazSalvo,res_nom_id_cargoAct,`res_nom_ruta_contraloria`, `res_nom_ruta_procuraduria`, 
                            `res_nom_ruta_antecedentes`, `res_nom_ruta_medidas`,`res_nom_ruta_inhabilidades`, `res_nom_userR`) 
                        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"; 
                $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->id_clase_nombra,
                        $data->id_usuario,
                        $fechalog,
                        $data->id_cargo,
                        $contador,
                        $data->id_user_reemplaza,
                        $data->fecha_inicio,
                        $data->flag_abierto,
                        $fechaFinal,
                        $data->cdp,
                        $data->oficio,
                        $data->acuerdo,
                        $data->flag_first_time,
                        $data->num_pazSalvo,
                        $data->id_cargoActual,
                        $data->res_ruta_contraloria,
                        $data->res_ruta_procuraduria,
                        $data->res_ruta_medidas,
                        $data->res_ruta_antecedentes,
                        $data->res_ruta_inhabilidades,
                        $idusuarioR
                    )
                ); 
                $this->pdo->exec("UPDATE th_contador_resoluciones SET con_consecutivo ='$max'");
                
                $maxResNombra  = $modelo->get_max_ResNombramiento();
                while($row = $maxResNombra->fetch()){
                    $cont_max = $row['cont'];
                }
                //echo $contad;
                $this->pdo->exec("UPDATE th_planta_personal SET pla_estado = 0 WHERE pla_id_usuario= '$data->id_usuario'");
                
                $sql_TH = "INSERT INTO `th_planta_personal`(`pla_id_usuario`, `pla_fecha`, `pla_id_cargo`, `pla_id_clase_nombra`, 
                            `pla_num_resolucion`, `pla_id_res_nombramiento`, `pla_fecha_inicio`, `pla_fecha_fin`, `pla_id_ubicacion`, 
                            `pla_id_area_cs`, `pla_id_usuario_reemplaza`, `pla_id_userR`, `pla_flag_alerta`,`pla_estado`) 
                        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $this->pdo->prepare($sql_TH) 
                ->execute(
                    array(
                        $data->id_usuario,
                        $fechalog,
                        $data->id_cargo,
                        $data->id_clase_nombra,
                        $contador." ".$fechalog,
                        $cont_max,
                        $data->fecha_inicio,
                        $data->fecha_fin,
                        $data->id_ubicacion,
                        $data->id_area,
                        $data->id_user_reemplaza,
                        $idusuarioR,
                        $alerta,
                        1
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
        public function Lista_Resoluciones_Nombramiento(){
            try{
                $stm = $this->pdo->prepare("SELECT `res_nom_id`, `res_nom_id_clase_nombra`, `res_nom_id_usuario`, `res_nom_fecha`, 
                        `res_nom_id_cargo`, `res_nom_consecutivo`, `res_nom_id_user_reemplaza`, `res_nom_fecha_inicio`, `res_nom_flag_abierto`,
                        `res_nom_fecha_fin`, `res_nom_cdp`, `res_nom_oficio`, `res_nom_acuerdo`,`res_nom_flag_first_vez`, `res_nom_numPazSalvo`, 
                        `res_nom_ruta_contraloria`, `res_nom_ruta_procuraduria`, `res_nom_ruta_antecedentes`, `res_nom_ruta_medidas`, 
                        `res_nom_ruta_inhabilidades`, `res_nom_userR`, `res_nom_userE`, `res_nom_fechaE`, clas_id,clas_titulo,
                        us.empleado AS empleado, us1.empleado AS reemplaza, car.car_titulo AS cargo
                    FROM `th_resoluciones_nombra` AS rn 
                    INNER JOIN th_clase_nombramiento AS cla ON rn.`res_nom_id_clase_nombra` = cla.clas_id
                    INNER JOIN th_cargos as car ON rn.`res_nom_id_cargo` = car.car_id
                    INNER JOIN pa_usuario AS us ON rn.`res_nom_id_usuario`= us.id
                    LEFT JOIN pa_usuario AS us1 ON rn.`res_nom_id_user_reemplaza` = us1.id
                    ORDER BY res_nom_id DESC");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch(Exception $e){
                die($e->getMessage());
            }
        }
        public function Editar_Fecha_ActaNombramiento($data){
            date_default_timezone_set('America/Bogota'); 
            $fecha_actual = date('Y-m-d');
            try{
                $sql = "UPDATE th_resoluciones_nombra SET 
                        res_nom_fecha_inicio = ?,
                        res_nom_userE = ?, 
                        res_nom_fechaE = ?
                    WHERE res_nom_id = ?";

                $this->pdo->prepare($sql)
                ->execute(
                    array(  
                        $data->res_fecha_inicio,
                        $data->id_usuarioE,
                        $fecha_actual,
                        $data->id
                    )
                ); 
                $this->pdo->exec("UPDATE th_planta_personal SET 
                        pla_fecha_inicio = '$data->res_fecha_inicio', 
                        pla_id_userE= '$data->id_usuarioE', 
                        pla_fechaE='$fecha_actual' 
                    WHERE pla_id_res_nombramiento= '$data->id'");
            } catch (Exception $ex) {
                die($ex->getMessage());
            }
        }
        public function get_datos_usuariosTH(){
            $listar     = $this->pdo->prepare("SELECT * FROM pa_usuario WHERE bandera_hv=1 ORDER BY empleado");
            $listar->execute();
            return $listar;
        }
        public function Editar_Res_Nombramiento($data){
            session_start();
            date_default_timezone_set('America/Bogota'); 
            $fecha_actual = date('Y-m-d');
            $idusuarioR     = $_SESSION['idUsuario'];
            //echo $data->fecha_inicio;
            try{
                $sql = "UPDATE th_resoluciones_nombra SET 
                        res_nom_fecha_inicio = ?,
                        res_nom_cdp = ?,
                        res_nom_userE = ?, 
                        res_nom_fechaE = ?
                    WHERE res_nom_id = ?";

                $this->pdo->prepare($sql)
                ->execute(
                    array(  
                        $data->fecha_inicio,
                        $data->res_cdp,
                        $idusuarioR,
                        $fecha_actual,
                        $data->id
                    )
                ); 
                $this->pdo->exec("UPDATE th_planta_personal SET 
                        pla_fecha_inicio = '$data->fecha_inicio', 
                        pla_id_userE= '$idusuarioR', 
                        pla_fechaE='$fecha_actual' 
                    WHERE pla_id_res_nombramiento= '$data->id'");
            } catch (Exception $ex) {
                die($ex->getMessage());
            }
        }
        
        
        
        
        
        
        
     
        //INFORMACION DE LA BASE DE DATOS, PARA SU CONEXION
	public function get_datos_basededatos($idbd){
            $listar     = $this->pdo->prepare("SELECT * FROM pa_base_datos WHERE id = ".$idbd);
            $listar->execute();
            return $listar;
  	}
        
        
        
        

        //***************************************************************************** //
        
        public function Listar_municipios_todos(){
            try{
                $listar = $this->pdo->prepare("SELECT * FROM pa_municipio;");
                $listar->execute();
        return $listar;
            } catch (Exception $e) {
                die($e->getMessage());
            }   
        }

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
        
       
    }
// JUAN ESTEBAN MUNERA BETANCUR
    
    ?>
<script>
    function  notifyMe()  {  
    if  (!("Notification"  in  window))  {   
        alert("Este navegador no soporta notificaciones de escritorio");  
    }else  if  (Notification.permission  ===  "granted")  {
        var  options  = {
            body:   "Descripción o cuerpo de la notificación",
            icon:   "url_del_icono.jpg",
            dir :   "ltr"
        };
        var  notification  =  new  Notification("Hola :D", options);
    }else  if  (Notification.permission  !==  'denied')  {
        Notification.requestPermission(function (permission)  {
            if  (!('permission'  in  Notification))  {
                Notification.permission  =  permission;
            }
            if  (permission  ===  "granted")  {
                var  options  =   {
                    body:   "Descripción o cuerpo de la notificación",
                    icon:   "url_del_icono.jpg",
                    dir :   "ltr"
                };     
                var  notification  =  new  Notification("Hola :)", options);
            }   
        });  
    }
};
</script>