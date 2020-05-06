<?php
    require_once 'model/prestamoModel.php';
    class PrestamoController{
        private $model;

        public function __CONSTRUCT(){
            $this->model = new Prestamo();
        }
        public function Index(){
            require_once 'view/header.php';
            require_once 'view/prestamo/prestamos.php';
            require_once 'view/footer.php';
        }
        public function Crud(){
            $pre = new Prestamo();

            if(isset($_REQUEST['id'])){
                $pre = $this->model->Obtener($_REQUEST['id']);
            }
            require_once 'view/header.php';
            require_once 'view/prestamo/prestamo-editar.php';
            require_once 'view/footer.php';
        }
		
		public function Crud2(){
            $pre = new Prestamo();

            if(isset($_REQUEST['id'])){
                $pre = $this->model->Obtener($_REQUEST['id']);
            }
            require_once 'view/header.php';
            require_once 'view/prestamo/prestamo-editar2.php';
            require_once 'view/footer.php';
        }
        public function Guardar(){
            session_start();
            $pre = new Prestamo();
            
            $campos               = 'usuario';
            $nombrelista          = 'pa_usuario_acciones';
            $idaccion             = '27';
            $campoordenar         = 'id';
            $datosusuarioacciones = $pre->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
            $usuarios             = $datosusuarioacciones->fetch();
            $usuariosa            = explode("////",$usuarios[usuario]);
            
            $pre->id            = $_POST['id'];
            $pre->radicado      = $_POST['radicado'];
            $pre->id_usuario    = $_POST['id_usuarioR'];
            $pre->ponente       = $_POST['ponente'];
            $pre->tipo_proceso  = $_POST['tipo_proceso'];
            $pre->clase_proceso = $_POST['clase_proceso'];
            $pre->sub_clase     = $_POST['sub_clase'];
            $pre->obs_archivo   = $_POST['obs_archivo'];
            $pre->observaciones = $_POST['observaciones'];
            $pre->demandante    = $_POST['parte_demandante'];
            $pre->demandado     = $_POST['parte_demandado'];
            $pre->bandera       = $_POST['bandera'];
            //if($pre->bandera > 0){
                $pre->id > 0 
                    ? $this->model->Actualizar($pre)
                    : $this->model->Registrar($pre);
                
                header('Location: index.php');
            //}else{
                if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
                    print'<script languaje="Javascript">alert("Error, la Solicitud de Visita no pudo ser registrada, por favor intente nuevamente"); location.href="index.php"</script>';
                }else {
                    print'<script languaje="Javascript">alert("Error, la Solicitud de Visita no pudo ser registrada, por favor intente nuevamente"); location.href="index.php?c=Visitas&a=H_Visitas"</script>';
                }
            //}
        }
        public function Eliminar(){
            $this->model->Eliminar($_REQUEST['id'], $_REQUEST['radicado']);
            header('Location: index.php');
        }
        public function Historial_Prestamos(){
            require_once 'view/header.php';
            require_once 'view/prestamo/prestamos_consultarHistorial.php';
            require_once 'view/footer.php';
        }
        public function Procesos_Pendientes(){
            require_once 'view/header.php';
            require_once 'view/prestamo/prestamos_pendientes.php';
            require_once 'view/footer.php';
        }
        public function Actualizar_Prestamo(){
            session_start();
            $pre = new Prestamo();
            
            $campos               = 'usuario';
            $nombrelista          = 'pa_usuario_acciones';
            $idaccion             = '27';
            $campoordenar         = 'id';
            $datosusuarioacciones = $pre->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
            $usuarios             = $datosusuarioacciones->fetch();
            $usuariosa            = explode("////",$usuarios[usuario]);
            if($_POST['fecha1'] !="" && $_POST['fecha2'] !="" && $_POST['fecha3'] !="" && $_POST['fecha4'] !="" ){
                $flag = 1;
            }else{
                $flag=0;
            }
            if ( in_array($_SESSION['idUsuario'],$usuariosa) ){
                $pre->id            = $_POST['id'];
                $pre->id_usuario    = $_POST['user'];
                $pre->fecha1        = $_POST['fecha1'];
                $pre->fecha2        = $_POST['fecha2'];
                $pre->fecha3        = $_POST['fecha3'];
                $pre->fecha4        = $_POST['fecha4'];
                $pre->user1         = $_POST['user1'];
                $pre->user2         = $_POST['user2'];
                $pre->user3         = $_POST['user3'];
                $pre->user4         = $_POST['user4'];
                $pre->flag          = $flag;
                $this->model->Actualizar($pre);
            }
            if(isset($_SESSION['idUsuario'])){
                header('Location: ?c=Prestamo&a=Procesos_Pendientes');
            }else{
                header( "refresh:2; url=http://172.16.175.30/centro_servicios2" );
            }
        }

        public function Editar_Fecha_Cero()
        {
            session_start();
            $miPrestamo = new Prestamo();

            $campos               = 'usuario';
            $nombrelista          = 'pa_usuario_acciones';
            $idaccion             = '27';
            $campoordenar         = 'id';
            $datosusuarioacciones = $miPrestamo->get_lista_usuario_acciones($campos, $nombrelista, $idaccion, $campoordenar);
            $usuarios             = $datosusuarioacciones->fetch();
            $usuariosa            = explode("////",$usuarios[usuario]);

            if ( in_array($_SESSION['idUsuario'], $usuariosa) )
            {
                $dataUsuario = $miPrestamo->get_dato_usuario($_SESSION['idUsuario']);
                $usuario = $dataUsuario->fetch();

                $miPrestamo->id          = $_POST['id'];
                $miPrestamo->id_usuario  = $_SESSION['idUsuario'];   // tomado de la sesion del usuario.
                $miPrestamo->fecha       = $_POST['edit_fecha'];
                $miPrestamo->observacion = $_POST['observa_fecha'] . " Editado por: " . $usuario[empleado];
                $miPrestamo->Editar_Fecha_Cero($miPrestamo);
            }
            if(isset($_SESSION['idUsuario']))
            {
                header('Location: ?c=Prestamo&a=Procesos_Pendientes');
            }
            else
            {
                header( "refresh:2; url=http://172.16.175.30/centro_servicios2" );
            }
        }

        public function ver()
        {
            require_once 'view/header.php';
            require_once 'view/prestamo/ver.php';
            require_once 'view/footer.php';
        }
    }