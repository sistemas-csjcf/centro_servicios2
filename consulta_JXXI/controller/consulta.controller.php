<?php
    require_once 'model/consulta_model.php';

    class ConsultaController{
        private $model;
        public function __CONSTRUCT(){
            $this->model = new Consulta();
        }
        public function Index(){
            require_once 'view/header.php';
            require_once 'view/consulta/consulta.php';
            require_once 'view/footer.php';
        }
        public function Listar_procesos_filtro(){
             $proc = new Proceso();
             $proc = $this->model->Listar_procesos_filtro($_REQUEST['inicio'], $_REQUEST['fin']);
        }
        public function Ocultar(){
            $proc = new Proceso();
            $proc = $this->model->Ocultar_proceso($_REQUEST['radicado'], $_REQUEST['dato_u']);
        }
        public function Ver(){
            $proc = new Proceso();
            $proc = $this->model->Ver_proceso($_REQUEST['radicado'], $_REQUEST['dato_u']);
        }
        public function Bloquear_conjunto(){
            $proc = new Proceso();
            $proc = $this->model->Ocultar_Conjunto($_REQUEST['arreglo_radicado'], $_REQUEST['dato_u']);
        }
        public function Desbloquear_conjunto(){
            $proc = new Proceso();
            $proc = $this->model->Ver_Conjunto($_REQUEST['arreglo_radicado'], $_REQUEST['dato_u']);
        }
    }