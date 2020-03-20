<?php
    // JUAN ESTEBAN MUNERA BETANCUR
    require_once 'database.php';
    class Devolucion{
	private $pdo;

	public function __CONSTRUCT(){
            try{
                $this->pdo = Database::StartUp();     
            }catch(Exception $e){
                die($e->getMessage());
            }
	}
        public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
            $listar     = $this->pdo->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
            $listar->execute();
            return $listar;
	}
        public function lista_lideres(){
            $listar     = $this->pdo->prepare("SELECT empleado AS lider, juz.idusuariojuzgadocargo AS id
                FROM pa_juzgado AS juz
                INNER JOIN pa_usuario AS us ON us.id = juz.idusuariojuzgadocargo
                GROUP BY empleado;");
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
        public function get_devoluciones_pendientes($filtro_us){
            date_default_timezone_set('America/Bogota'); 
            $fecha=date('Y-m-d'); //FORMA PARA XP
            $listar     = $this->pdo->prepare("SELECT anot.id AS id, pro.radicado AS radicado, juz.nombre AS juzgado, anot.fecha_devolucion AS fecha_devolucion, 
                            anot.idusuario, par.nombre AS parte, flag_devolucion, us.empleado
                        FROM signot_proceso_anotacion AS anot
                        INNER JOIN signot_proceso AS pro ON anot.idradicado = pro.id
                        INNER JOIN pa_juzgado AS juz ON pro.idjuzgadoorigen = juz.id
                        INNER JOIN signot_parte AS par ON par.id = anot.id_parte
                        INNER JOIN pa_usuario AS us ON us.id = anot.idusuario
                        WHERE idtipoanotacion = 9 AND fecha_devolucion < '$fecha' AND flag_devolucion =1".$filtro_us." ORDER BY anot.fecha_devolucion ASC; ");
            $listar->execute();
            return $listar;
  	}
    }
// JUAN ESTEBAN MUNERA BETANCUR