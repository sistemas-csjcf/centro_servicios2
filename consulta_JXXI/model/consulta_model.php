<?php
    // JUAN ESTEBAN MUNERA BETANCUR
    require_once 'database.php';
    class Consulta{
        private $pdo;
        public $id;

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
        public function get_fecha_actual(){
            date_default_timezone_set('America/Bogota'); 
            $fecharegistro=date('Y-m-d g:ia');
            return $fecharegistro; 	
        }
        //***********************************************************************************************************************************//        
        public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
            $listar     = $this->pdo->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
            $listar->execute();
            return $listar;
	    }	
    }
// JUAN ESTEBAN MUNERA BETANCUR