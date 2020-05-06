<?php
    // JUAN ESTEBAN MUNERA BETANCUR
    require_once 'database.php';
    class Gestion{
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
    }
// JUAN ESTEBAN MUNERA BETANCUR