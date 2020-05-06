<?php
    require_once 'model/devolucion_model.php';
    header('Content-Type: text/html; charset=UTF-8'); 
    class DevolucionController{
        private $model;
        public function __CONSTRUCT(){
            $this->model = new Devolucion();
        }
        public function Index(){
            session_start();
            $modelo               = new Devolucion();
            $campos               = 'usuario';
            $nombrelista          = 'pa_usuario_acciones';
            $idaccion             = '26';
            $campoordenar         = 'id';
            $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
            $usuarios             = $datosusuarioacciones->fetch();
            $usuariosa            = explode("////",$usuarios[usuario]);
            if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
                require_once 'view/header.php';
                //require_once 'view/gestion/consultar_gestion.php';
                require_once 'view/footer.php';
            } else{
                header("refresh: 0; URL=/centro_servicios2/");
            }
              
        }
    }