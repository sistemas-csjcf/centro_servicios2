<?php
require_once 'model/mejora_continua_model.php';
header('Content-Type: text/html; charset=UTF-8'); 
class Mejora_cController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Mejora_C();
    }
    public function Mis_tareas_us(){
        require_once 'view/header.php';
        require_once 'view/mejora_c/mis_tareas_us.php';
        require_once 'view/footer.php';
    }
    public function Crud_tarea(){
        $mc = new Mejora_C();
        
        if(isset($_REQUEST['id'])){
            $mc = $this->model->Obtener($_REQUEST['id']);
        }
        require_once 'view/header.php';
        require_once 'view/mejora_c/mejora_continua-editar.php';
        require_once 'view/footer.php';
    }
    public function Guardar_Tarea(){
        session_start();
        $mc = new Mejora_C();
        
        $idaccion           = '33';
        $datos_us_accion    = $mc->get_lista_usuario_accionesJE($idaccion);
        $us_privilegios     = $datos_us_accion->fetch();
        $usuarioAD          = explode("////",$us_privilegios[usuario]);

        $idaccion           = '34';
        $datos_us_accion    = $mc->get_lista_usuario_accionesJE($idaccion);
        $us_lider_MC        = $datos_us_accion->fetch();
        $usuario_lider_mc   = explode("////",$us_lider_MC[usuario]);
        
        $idaccion           = '13';
        $datos_us_accion    = $mc->get_lista_usuario_accionesJE($idaccion);
        $us_despacho        = $datos_us_accion->fetch();
        $usuario_despacho   = explode("////",$us_despacho[usuario]);
        
        $mc->id                     = $_REQUEST['id'];
        $mc->id_user                = $_REQUEST['id_user'];
        $mc->id_user_responsable    = $_REQUEST['tar_id_user_responsable'];
        $mc->fecha_limite           = $_REQUEST['fecha_limite'];
        $mc->tar_descripcion        = $_REQUEST['comentarios'];
        
        $mc->id_clase               = $_REQUEST['id_clase'];
        $mc->id_norma               = $_REQUEST['id_norma'];
        $mc->causas                 = $_REQUEST['causas'];
        $mc->id_procesoImp          = $_REQUEST['id_procesoImp'];
        $mc->id_metodologia         = $_REQUEST['id_metodologia'];
        $mc->id_generado            = $_REQUEST['id_generado']; 
        $mc->tipo_us                = $_REQUEST['tipo_us'];
        $raiz = "upload_tareas";
        
        //AQUI SE CREA EL DIRECTORIO
        if(is_dir($raiz)){
            $bandera=0;
        }else{
            mkdir($raiz, 0, true);
        }
        if( !empty( $_FILES['tar_ruta_doc_adjunto']['name'] ) ){
            date_default_timezone_set('America/Bogota'); 
            $formato = date('Ymd_hi') . '-' . strtolower(utf8_decode($_FILES['tar_ruta_doc_adjunto']['name']));
            move_uploaded_file ($_FILES['tar_ruta_doc_adjunto']['tmp_name'], 'upload_tareas/'. $formato);
            $mc->tar_ruta_doc = utf8_encode($formato);
        }else{
            $mc->tar_ruta_doc = $_POST['tar_doc_adjunto'];
        }
        $mc->tar_ruta_doc;
        $mc->id > 0 
            ? $this->model->Actualizar_Tarea($mc)
            : $this->model->Registrar_Tarea($mc);
        if(isset($_SESSION['idUsuario'])){
            // ---------------- ADMINISTRADOR --------------------------------
            if ( in_array($_SESSION['idUsuario'],$usuarioAD) ) {
                header('Location: ?c=Mejora_C&a=Mis_tareasAD');
            }else if( in_array($_SESSION['idUsuario'],$usuario_despacho) ){
                // ---------- DESPACHO ------------------------------------
                header('Location: ?c=Mejora_C&a=consultar_lista_tareas_despacho');
            }else{
                // ------------- OTHER USER -----------------------------------
                header('Location: ?c=Mejora_C&a=Mis_tareas_us');
            }
        }else{
            header( "refresh:2; url=http://172.16.175.30/centro_servicios2" );
        }
    }
    public function Crud_tarea_despacho() {
        $mc = new Mejora_C();
        if(isset($_REQUEST['id'])){
            $mc = $this->model->Obtener($_REQUEST['id']);
        }
        require_once 'view/header.php';
        require_once 'view/mejora_c/mejora_continua_despacho-editar.php';
        require_once 'view/footer.php';
    }
    public function consultar_lista_tareas_despacho() {
        require_once 'view/header.php';
        require_once 'view/mejora_c/filtros/lista_tareas_despacho.php';
        require_once 'view/footer.php';
    }
    public function Mis_tareasAD(){
        require_once 'view/header.php';
        require_once 'view/mejora_c/mis_tareas_admin.php';
        require_once 'view/footer.php';
    }
    public function Reasignar_Task(){
        session_start();
        $mc = new Mejora_C();
        
        $mc->id                     = $_REQUEST['id'];
        $mc->id_user_responsable    = $_REQUEST['id_user_responsable'];
        $mc->fecha_limite           = $_REQUEST['fecha_limite'];
        
        $mc->id_clase               = $_REQUEST['id_clase'];
        $mc->id_norma               = $_REQUEST['id_norma'];
        $mc->id_procesoImp          = $_REQUEST['id_procesoImp'];
        $mc->causas                 = $_REQUEST['causas'];
        $mc->id_metodologia         = $_REQUEST['id_metodologia'];
        $mc->id_generado            = $_REQUEST['id_generado'];

        $this->model->Reasignar_Tarea($mc);  
        if(isset($_SESSION['idUsuario'])){
            header('Location: ?c=Mejora_C&a=Mis_tareasAD');
        }else{
            header( "refresh:2; url=http://172.16.175.30/centro_servicios2" );
        }
    }
    public function Gestionar_Task(){
        $mc = new Mejora_C();
        
        $idaccion       = '33';
        $datos_us_admin = $mc->get_lista_usuario_accionesJE($idaccion);
        $us_admin       = $datos_us_admin->fetch();
        $usuario_admin  = explode("////",$us_admin[usuario]);

        $mc->id                     = $_REQUEST['id'];
        $mc->fecha_limite           = $_REQUEST['fecha_limite'];
        $mc->descripcion_Gestion    = $_REQUEST['descripcion_gestion'];
        $mc->id_clase               = $_REQUEST['id_clase'];
        $mc->id_norma               = $_REQUEST['id_norma'];
        $mc->id_user_responsable    = $_REQUEST['id_user_responsable'];
        $mc->id_procesoImp          = $_REQUEST['id_procesoImp'];
        $mc->causas                 = $_REQUEST['causas'];
        $mc->id_metodologia         = $_REQUEST['id_metodologia'];
        $mc->id_generado            = $_REQUEST['id_generado'];
        $mc->flag_model             = 1;
        
        /*$raiz = "upload_gestion";
        //AQUI SE CREA EL DIRECTORIO
        if(is_dir($raiz)){
            $bandera=0;
        }else{
            mkdir($raiz, 0, true);
        }
        if( !empty( $_FILES['tar_ruta_doc_adjunto_gestion']['name'] ) ){
            date_default_timezone_set('America/Bogota'); 
            $formato = date('Ymd_hi') . '-' . strtolower(utf8_decode($_FILES['tar_ruta_doc_adjunto_gestion']['name']));
            move_uploaded_file ($_FILES['tar_ruta_doc_adjunto_gestion']['tmp_name'], 'upload_gestion/'. $formato);
            $mc->ruta_doc_gestion = utf8_encode($formato);
        }
        echo $mc->ruta_doc_gestion ;*/
        $this->model->Gestionar_Tarea($mc);
        
        if ( in_array($_SESSION['idUsuario'],$usuario_admin) ) {
            header('Location: ?c=Mejora_C&a=Mis_tareasAD');
        }else{
            header('Location: ?c=Mejora_C&a=Mis_tareas_us');
        }
    }
    public function Gestionar_TaskUS(){
        $mc = new Mejora_C();
        
        $idaccion       = '33';
        $datos_us_admin = $mc->get_lista_usuario_accionesJE($idaccion);
        $us_admin       = $datos_us_admin->fetch();
        $usuario_admin  = explode("////",$us_admin[usuario]);

        $mc->id                     = $_REQUEST['id'];
        $mc->fecha_limite           = $_REQUEST['fecha_limite'];
        $mc->descripcion_Gestion    = $_REQUEST['descripcion_gestion'];
        $mc->flag_model             = 2;
        
        $raiz = "upload_gestion";
        //AQUI SE CREA EL DIRECTORIO
        if(is_dir($raiz)){
            $bandera=0;
        }else{
            mkdir($raiz, 0, true);
        }
        if( !empty( $_FILES['tar_ruta_doc_adjunto_gestion']['name'] ) ){
            date_default_timezone_set('America/Bogota'); 
            $formato = date('Ymd_hi') . '-' . strtolower(utf8_decode($_FILES['tar_ruta_doc_adjunto_gestion']['name']));
            move_uploaded_file ($_FILES['tar_ruta_doc_adjunto_gestion']['tmp_name'], 'upload_gestion/'. $formato);
            $mc->ruta_doc_gestion = utf8_encode($formato);
        }
        echo $mc->ruta_doc_gestion ;
        $this->model->Gestionar_Tarea($mc);
        
        if ( in_array($_SESSION['idUsuario'],$usuario_admin) ) {
            header('Location: ?c=Mejora_C&a=Mis_tareasAD');
        }else{
            header('Location: ?c=Mejora_C&a=Mis_tareas_us');
        }
    }
    /*public function Completar_AG(){
        $mc = new Mejora_C();
        
        $mc->id             = $_REQUEST['id'];
        $mc->id_clase       = $_REQUEST['id_clase'];
        $mc->id_norma       = $_REQUEST['id_norma'];
        $mc->id_procesoImp  = $_REQUEST['id_procesoImp'];
        $mc->causas         = $_REQUEST['causas'];
        $mc->id_metodologia = $_REQUEST['id_metodologia'];
        $mc->id_generado    = $_REQUEST['id_generado'];
       
        $this->model->Completar_AG($mc);
        header('Location: ?c=Mejora_C&a=Historial_Tareas_AD');
    }*/

    public function Completar_AG(){

        
        $mc = new Mejora_C();
        if(isset($_REQUEST['id'])){
            $mc = $this->model->Obtener($_REQUEST['id']);
        }
        
        $mc->det_tar_id        = $_REQUEST['det_tar_id'];
        $mc->det_fecha_inicial = $_REQUEST['det_fecha_inicial'];
        $mc->det_fecha_final   = $_REQUEST['det_fecha_final'];
        $mc->det_descripcion   = $_REQUEST['det_descripcion'];
        $mc->det_responsable   = $_REQUEST['det_responsable'];

        $raiz = "upload_tareas";
        
        //AQUI SE CREA EL DIRECTORIO
        if(is_dir($raiz)){
            $bandera=0;
        }else{
            mkdir($raiz, 0, true);
        }
        if( !empty( $_FILES['tar_ruta_doc_adjunto']['name'] ) ){
            date_default_timezone_set('America/Bogota'); 
            $formato = date('Ymd_hi') . '-' . strtolower(utf8_decode($_FILES['tar_ruta_doc_adjunto']['name']));
            move_uploaded_file ($_FILES['tar_ruta_doc_adjunto']['tmp_name'], 'upload_tareas/'. $formato);
            $mc->tar_ruta_doc = utf8_encode($formato);
        }else{
            $mc->tar_ruta_doc = $_POST['tar_doc_adjunto'];
        }
        $mc->tar_ruta_doc;
       
        $this->model->Completar_AG($mc);
        header('Location: ?c=Mejora_C&a=Historial_Tareas_AD');
    }


    public function Historial_Tareas_AD() {
        require_once 'view/header.php';
        require_once 'view/mejora_c/historial_ALL_tareas_admin.php';
        require_once 'view/footer.php';
    }
    public function Historial_Mis_Tareas() {
        require_once 'view/header.php';
        require_once 'view/mejora_c/historial_mis_tareas.php';
        require_once 'view/footer.php';
    }
    public function Historial_HallazgoAD() {
        require_once 'view/header.php';
        require_once 'view/Hallazgos/historial_hallazgosAD.php';
        require_once 'view/footer.php';
    }
    //**********************************************************************
    public function Crud_Hallazgo(){
        $mc = new Mejora_C();
        
        if(isset($_REQUEST['id'])){
            $mc = $this->model->Obtener($_REQUEST['id']);
        }
        require_once 'view/header.php';
        require_once 'view/Hallazgos/crear_hallazgo.php';
        require_once 'view/footer.php';
    }
    public function Guardar_Hallazgo(){
        session_start();
        $mc = new Mejora_C();
        
        $idaccion           = '35';
        $datos_us_accion    = $mc->get_lista_usuario_accionesJE($idaccion);
        $us_privilegios     = $datos_us_accion->fetch();
        $usuarioAD          = explode("////",$us_privilegios[usuario]);   
        
        $mc->id                     = $_REQUEST['id'];
        $mc->id_user                = $_REQUEST['id_user'];
        $mc->id_user_responsable    = $_REQUEST['id_user_responsable'];
        $mc->fecha_limite           = $_REQUEST['fecha_limite'];
        $mc->descripcion        = $_REQUEST['comentarios'];
        
        $raiz = "upload_Hallazgos";
        $nom  = $_SESSION['idUsuario'];
        //AQUI SE CREA EL DIRECTORIO
        if(is_dir($raiz)){
            $bandera=0;
        }else{
            mkdir($raiz, 0, true);
        }
        if( !empty( $_FILES['hal_ruta_doc_adjunto']['name'] ) ){
            date_default_timezone_set('America/Bogota'); 
            $formato = date('Ymd_hi') . '-' . strtolower(utf8_decode($_FILES['hal_ruta_doc_adjunto']['name']));
            move_uploaded_file ($_FILES['hal_ruta_doc_adjunto']['tmp_name'], 'upload_Hallazgos/'. $formato);
            $mc->hal_ruta_doc = utf8_encode($formato);
        }else{
            $mc->hal_ruta_doc = $_POST['hal_doc_adjunto'];
        }
        echo $mc->hal_ruta_doc;
        $mc->id > 0 
            ? $this->model->Actualizar_Hallazgo($mc)
            : $this->model->Registrar_Hallazgo($mc);
        if(isset($_SESSION['idUsuario'])){
            if ( in_array($_SESSION['idUsuario'],$usuarioAD) ) {
                header('Location: ?c=Mejora_C&a=Mis_Hallazgos');
            }
        }else{
            header( "refresh:2; url=http://172.16.175.30/centro_servicios2" );
        }
    }
    // ********* bANDEJA PRINCIPAL MIS HALLAZGOS PENDIENTES ****************
    public function Mis_Hallazgos(){
        require_once 'view/header.php';
        require_once 'view/Hallazgos/mis_hallazgosPendientes.php';
        require_once 'view/footer.php';
    }
    // *********  HALLAZGOS PERSONALES --> US *******************************
    public function Historial_Mis_Hallazgos(){
        require_once 'view/header.php';
        require_once 'view/Hallazgos/historial_mis_hallazgos.php';
        require_once 'view/footer.php';
    }
    // ********** TODOS LOS HALLAZGOS --> ADMINISTRADOR *********************
    public function Historial_Hallazgos(){
        require_once 'view/header.php';
        require_once 'view/Hallazgos/historial_hallazgosAD.php';
        require_once 'view/footer.php';
    }
    public function Gestionar_Find(){
        $mc = new Mejora_C();
        
        $idaccion       = '33';
        $datos_us_admin = $mc->get_lista_usuario_accionesJE($idaccion);
        $us_admin       = $datos_us_admin->fetch();
        $usuario_admin  = explode("////",$us_admin[usuario]);

        $mc->id                     = $_REQUEST['id'];
        $mc->descripcion_Gestion    = $_REQUEST['descripcion_gestion'];
        $raiz = "upload_Gestion_Hallazgos";
        //AQUI SE CREA EL DIRECTORIO
        if(is_dir($raiz)){
            $bandera=0;
        }else{
            mkdir($raiz, 0, true);
        }
        if( !empty( $_FILES['hal_ruta_doc_adjunto_gestion']['name'] ) ){
            date_default_timezone_set('America/Bogota'); 
            $formato = date('Ymd_hi') . '-' . strtolower(utf8_decode($_FILES['hal_ruta_doc_adjunto_gestion']['name']));
            move_uploaded_file ($_FILES['hal_ruta_doc_adjunto_gestion']['tmp_name'], 'upload_Gestion_Hallazgos/'. $formato);
            $mc->ruta_doc_gestion = utf8_encode($formato);
        }
        echo $mc->ruta_doc_gestion ;
        $this->model->Gestionar_Find($mc);
        
        header('Location: ?c=Mejora_C&a=Mis_Hallazgos');
        
    }
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php');
    }
}