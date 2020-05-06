<?php
    require_once 'model/tutela_model.php';
    header('Content-Type: text/html; charset=UTF-8'); 
    class TutelaController{
        private $model;    
        public function __CONSTRUCT(){
            $this->model = new tutela();
        }
        // listado tutelas actuales
        public function Index(){
            require_once 'view/header.php';
            require_once 'view/Lista_tutela/tutela.php';
            require_once 'view/footer.php';
        }
        // migrar JXXI --> local
        public function Migrar(){
            $tute = new Tutela();
            $tute->id_Rd    = $_REQUEST['id_Rd'];
            $tute->flag_rtn = $_REQUEST['flag_rtn'];
            if(isset($_REQUEST['id_Rd'])){
                $tute = $this->model->Migrar_tutela($_REQUEST['id_Rd'], $_REQUEST['flag_rtn']);
            }
            //header('Location: ?c=Tutela&a=Lista_Migrar');
    //        require_once 'view/header.php';
    //        require_once 'view/Lista_tutela/migrar_tutela.php';
    //        require_once 'view/footer.php';
        }
        // listado tutelas para migrar al sistema local
        public function Lista_Migrar(){
            require_once 'view/header.php';
            require_once 'view/Lista_tutela/migrar_tutela.php';
            require_once 'view/footer.php';
        }
        // MIGRAR tutela -->us DESPACHO
        public function Lista_MigrarD(){
            require_once 'view/header.php';
            require_once 'view/Lista_tutela/migrar_tutela_despacho.php';
            require_once 'view/footer.php';
        }
        //ALERTA TUTELA
        public function Index_Alerta(){
            require_once 'view/header.php';
            require_once 'view/alerta_tutela/alerta_tutela.php';
            require_once 'view/footer.php';
        }
        //ALERTA TUTELA D.
        public function Index_AlertaD(){
            require_once 'view/header.php';
            require_once 'view/alerta_tutela/alerta_tutela_D.php';
            require_once 'view/footer.php';
        }
        public function Registrar_Fecha_Fallo(){
            $tute = new Tutela();
            
            $tute->id           = $_POST['id'];
            $tute->flag_tutela  = '0';
            $tute->fecha_fallo  = $_POST['fecha_fallo'];
            if(isset($tute->id)){
                $this->model->Registrar_Fallo($tute);
            }
            header('Location: index.php?c=Tutela&a=Index_Alerta');
        }
        public function Consultar_tutelas(){
            require_once 'view/header.php';
            require_once 'view/alerta_tutela/consultar_alerta_tutela.php';
            require_once 'view/footer.php';
        }
        public function Consultar_tutelasD() {
            require_once 'view/header.php';
            require_once 'view/alerta_tutela/consultar_alerta_tutelaD.php';
            require_once 'view/footer.php';
        }
    }