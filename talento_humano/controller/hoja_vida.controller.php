<?php
    require_once 'model/hojaVida_model.php';
    class hoja_vidaController{
        private $model;
        public function __CONSTRUCT(){
            $this->model = new HojaVida();
        }
        public function Index(){            
            require_once 'view/header.php';
            require_once 'view/Hoja_vida/Listado_hojasVida.php';
            require_once 'view/footer.php';
        }
        public function Personal(){            
            require_once 'view/header.php';
            require_once 'view/Hoja_vida/datosPersonales.php';
            require_once 'view/footer.php';
        }
        public function Ver_HV_US(){
            require_once 'view/header.php';
            require_once 'view/Hoja_vida/HV_datosPersonales_US.php';
            require_once 'view/footer.php';
        }
        public function Crud(){
            $hv = new HojaVida();
            if(isset($_REQUEST['id'])){
                $hv = $this->model->Obtener($_REQUEST['id']);
            }
            require_once 'view/header.php';
            require_once 'view/Hoja_vida/HV_datosPersonales-editar.php';
            require_once 'view/footer.php';
        }
        public function Guardar_datosPersonales(){
            session_start();
            $_SESSION['nombre'];
            $hv = new HojaVida();

            //header('Location: index.php');
            //header('Location: index.php?c=Hoja_vida&a=Personal');

            //print'<script type="text/javascript">alert("!Acceso denegado para este módulo, verifique la configuración de su perfil con el administrador del sistema...!"); location.href="index.php" </script>';



//            $campos               = 'usuario';
//            $nombrelista          = 'pa_usuario_acciones';
//            $idaccion             = '20';
//            $campoordenar         = 'id';
//            $datosusuarioacciones = $hv->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
//            $usuarios             = $datosusuarioacciones->fetch();
//            $usuariosa            = explode("////",$usuarios[usuario]);
            //$hv->id_usuario = 
            
            $hv->id                     = $_POST['id'];
            $hv->per_cedula             = $_POST['per_cedula'];
            $hv->per_nombres            = $_POST['per_nombres'];
            $hv->per_apellidos          = $_POST['per_apellidos'];
            $hv->per_fecha_nacimiento   = $_POST['per_fecha_nacimiento'];
            $hv->per_id_departamento    = $_POST['per_id_departamento'];
            $hv->per_id_municipio       = $_POST['per_id_municipio'];
            $hv->per_direccion          = $_POST['per_direccion'];
            $hv->per_telefono           = $_POST['per_telefono'];
            $hv->per_celular            = $_POST['per_celular'];
            $hv->per_email              = $_POST['per_email'];
            $hv->return_flag            = $_POST['return_flag'];
            $hv->band                   = $_POST['band'];
            
            $get_Usuario = $hv->get_dato_Usuario($_POST['per_cedula']);
            $datos_User  = $get_Usuario->fetch();
            $id_us       = $datos_User['id'];
            $hv->id_usuario             = $id_us;

            
            $raiz = "documentos_HV";
            //$nom  = $_SESSION['idUsuario'];
            //AQUI SE CREA EL DIRECTORIO
            if(is_dir($raiz.'/fotos/')){
                $bandera=0;
            }else{
                mkdir($raiz.'/fotos/', 0, true);
            }
            if( !empty( $_FILES['per_ruta_foto']['name'] ) ){
                date_default_timezone_set('America/Bogota'); 
                $formato = date('Ymd_hi') . '-' . strtolower(utf8_decode($_FILES['per_ruta_foto']['name']));
                move_uploaded_file ($_FILES['per_ruta_foto']['tmp_name'], 'documentos_HV/fotos/'. $formato);
                $hv->per_ruta_foto = $formato;
            }else{
                $hv->per_ruta_foto = $_POST['per_foto'];
            }
            if($hv->band ==44){
                //echo "hola";
                $this->model->RegistrarDatosPersonalesForaneo($hv);
            }else{   
                $hv->id > 0 
                    ? $this->model->ActualizarDatosPersonales($hv)
                    : $this->model->RegistrarDatosPersonales($hv);
            }
            if($_SESSION['idUsuario'] !=""){
                if($hv->return_flag ==1){
                    header('Location: index.php?c=Hoja_vida&a=Personal');
                }else if($hv->return_flag == 2){
                    header("Location: index.php?c=Hoja_vida&a=Ver_HV_US&id=". $id_us ."&return_flag=2");
                }else{
                    header("Location: index.php?c=Hoja_vida");
                }
            }else{
                header('Location: index.php');
            }
        }

        public function Registrar_Estudios(){
            session_start();
            $_SESSION['nombre'];
            $hv = new HojaVida();
            
            $hv->id                     = $_POST['id'];
            $hv->for_pro_id_nivel       = $_POST['for_pro_id_nivel'];
            $hv->for_pro_institucion    = $_POST['for_pro_institucion'];
            $hv->for_pro_titulo         = $_POST['for_pro_titulo'];
            $hv->for_pro_fecha_inicio   = $_POST['for_pro_fecha_inicio'];
            $hv->for_pro_fecha_fin      = $_POST['for_pro_fecha_fin'];
            $hv->return_flag            = $_POST['return_flag'];
            $hv->usuario                = $_POST['usuario'];
            $raiz = "documentos_HV";
            //AQUI SE CREA EL DIRECTORIO
            if(is_dir($raiz.'/Certificados_Estudios/')){
                $bandera=0;
            }else{
                mkdir($raiz.'/Certificados_Estudios/', 0, true);
            }
            if( !empty( $_FILES['for_pro_ruta_certificado']['name'] ) ){
                date_default_timezone_set('America/Bogota'); 
                $formato = date('Ymd_hi') . '-' . strtolower(utf8_decode($_FILES['for_pro_ruta_certificado']['name']));
                move_uploaded_file ($_FILES['for_pro_ruta_certificado']['tmp_name'], 'documentos_HV/Certificados_Estudios/'. $formato);
                $hv->for_pro_ruta_certificado = utf8_encode($formato);
            }
            $this->model->Registrar_FormacionProfesional($hv);
            if($_SESSION['idUsuario'] !=""){
                if($hv->return_flag ==1){
                    header('Location: index.php?c=Hoja_vida&a=Personal');
                }else if($hv->return_flag == 2){ 
                    header("Location: index.php?c=Hoja_vida&a=Ver_HV_US&id=$hv->usuario&return_flag=2");
                }
            }else{
                header('Location: index.php');
            }
        }
        public function Crud_FormacionProfesional(){
            $hv = new HojaVida();
            if(isset($_REQUEST['id'])){
                $hv = $this->model->Obtener($_REQUEST['id']);
            }
            require_once 'view/header.php';
            require_once 'view/Hoja_vida/HV_datosFormacionProfesional-editar.php';
            require_once 'view/footer.php';
        }
        
        public function Actualizar_Estudios(){
            session_start();
            $_SESSION['nombre'];
            $hv = new HojaVida();
            $hv->id                     = $_POST['id'];
            $hv->id_hv                  = $_POST['id_hv']; 
            $hv->id_user                = $_POST['id_user'];
            $hv->id_nivel               = $_POST['id_nivel']; 
            $hv->for_pro_institucion    = $_POST['for_pro_institucion'];
            $hv->for_pro_titulo         = $_POST['for_pro_titulo'];
            $hv->for_pro_fecha_inicio   = $_POST['for_pro_fecha_inicio'];
            $hv->for_pro_fecha_fin      = $_POST['for_pro_fecha_fin'];
            $hv->return_flag            = $_POST['return_flag'];
            $hv->usuario                = $_POST['usuario'];
            $raiz = "documentos_HV";
            //AQUI SE CREA EL DIRECTORIO
            if(is_dir($raiz.'/Certificados_Estudios/')){
                $bandera=0;
            }else{
                mkdir($raiz.'/Certificados_Estudios/', 0, true);
            }
            if( !empty( $_FILES['for_pro_ruta_certificado']['name'] ) ){
                date_default_timezone_set('America/Bogota'); 
                $formato = date('Ymd_hi') . '-' . strtolower(utf8_decode($_FILES['for_pro_ruta_certificado']['name']));
                move_uploaded_file ($_FILES['for_pro_ruta_certificado']['tmp_name'], 'documentos_HV/Certificados_Estudios/'. $formato);
                $hv->for_pro_ruta_certificado = utf8_encode($formato);
            }else{
                $hv->for_pro_ruta_certificado = $_POST['ruta_recu'];
            }
            $this->model->Actualizar_FormacionProfesional($hv);
            if($_SESSION['idUsuario'] !=""){
                if($hv->return_flag ==1){
                    header('Location: index.php?c=Hoja_vida&a=Personal');
                }else if($hv->return_flag == 2){
                    header("Location: index.php?c=Hoja_vida&a=Ver_HV_US&id=$hv->usuario&return_flag=2");
                }
            }else{
                header('Location: index.php');
            }
        }

        public function Registrar_Ref_Personal() {
            session_start();
            $_SESSION['nombre'];
            $hv = new HojaVida();
            
            $hv->id                     = $_POST['id'];
            $hv->ref_per_nombre         = $_POST['ref_per_nombre'];
            $hv->ref_per_cargo          = $_POST['ref_per_cargo'];
            $hv->ref_per_empresa        = $_POST['ref_per_empresa'];
            $hv->ref_per_telefono       = $_POST['ref_per_telefono'];
            $hv->return_flag            = $_POST['return_flag'];
            $hv->usuario                = $_POST['usuario'];
            $this->model->Registrar_Ref_Personal($hv);
            if($_SESSION['idUsuario'] !=""){
                header('Location:index.php?c=Hoja_vida&a=Personal');
                if($hv->return_flag ==1){
                    header('Location: index.php?c=Hoja_vida&a=Personal');
                }else if($hv->return_flag == 2){ 
                    header("Location: index.php?c=Hoja_vida&a=Ver_HV_US&id=$hv->usuario&return_flag=2");
                }
            }else{
                header('Location: index.php');
            }
        }
        public function Actualizar_Ref_Personal() {
            session_start();
            $_SESSION['nombre'];
            $hv = new HojaVida();
            
            $hv->id                 = $_POST['id'];
            $hv->id_hv              = $_POST['id_hv'];
            $hv->ref_per_nombre     = $_POST['ref_per_nombre'];
            $hv->ref_per_cargo      = $_POST['ref_per_cargo'];
            $hv->ref_per_empresa    = $_POST['ref_per_empresa'];
            $hv->ref_per_telefono   = $_POST['ref_per_telefono'];
            $hv->return_flag        = $_POST['return_flag'];
            $hv->usuario            = $_POST['usuario'];
            $this->model->Editar_Ref_Personal($hv);
            if($_SESSION['idUsuario'] !=""){
                if($hv->return_flag ==1){
                    header('Location: index.php?c=Hoja_vida&a=Personal');
                }else if($hv->return_flag == 2){ 
                    header("Location: index.php?c=Hoja_vida&a=Ver_HV_US&id=$hv->usuario&return_flag=2");
                }
            }else{
                header('Location: index.php');
            }
        }
        public function Registrar_Exp_laboral() {
            session_start();
            $_SESSION['nombre'];
            $hv = new HojaVida();

            //header('Location: index.php?c=Hoja_vida&a=Personal&exp_id=' . $_POST['exp_id_area']);
            
            $hv->id                     = $_POST['id'];
            $hv->exp_empresa            = $_POST['exp_empresa'];
            $hv->exp_cargo              = $_POST['exp_cargo'];
            $hv->exp_id_departamento    = $_POST['exp_id_departamento'];
            $hv->exp_id_municipio       = $_POST['exp_id_municipio'];
            $hv->exp_fecha_inicio       = $_POST['exp_fecha_inicio'];
            $hv->exp_fecha_actualmente  = $_POST['exp_fecha_actualmente'];
            $hv->exp_rama               = $_POST['exp_rama'];
            $hv->exp_CS                 = $_POST['exp_CS'];
            $hv->exp_id_areaCS          = $_POST['exp_id_area'];
            $hv->usuario                = $_POST['usuario'];
            if($_POST['exp_fecha_fin'] !=""){
                $hv->exp_fecha_fin      = $_POST['exp_fecha_fin'];
            }else{
                $hv->exp_fecha_fin      = '0000-00-00';
            }
            
            $hv->return_flag            = $_POST['return_flag'];
            $raiz = "documentos_HV";
            //AQUI SE CREA EL DIRECTORIO
            if(is_dir($raiz.'/Certificados_Laborales/')){
                $bandera=0;
            }else{
                mkdir($raiz.'/Certificados_Laborales/', 0, true);
            }
            if( !empty( $_FILES['exp_ruta_certificado']['name'] ) ){
                date_default_timezone_set('America/Bogota'); 
                $formato = date('Ymd_hi') . '-' . strtolower(utf8_decode($_FILES['exp_ruta_certificado']['name']));
                move_uploaded_file ($_FILES['exp_ruta_certificado']['tmp_name'], 'documentos_HV/Certificados_Laborales/'. $formato);
                $hv->exp_ruta_certificado = utf8_encode($formato);
            }
            $this->model->Registrar_Exp_Laboral($hv);
            if($_SESSION['idUsuario'] !=""){
                if($hv->return_flag ==1){
                    header('Location: index.php?c=Hoja_vida&a=Personal');
                }else if($hv->return_flag == 2){
                    header("Location: index.php?c=Hoja_vida&a=Ver_HV_US&id=$hv->usuario&return_flag=2");
                }
            }else{
                header('Location: index.php');
            }
        }
        public function Editar_Exp_laboral() {
            session_start();
            $_SESSION['nombre'];
            $hv = new HojaVida();
            
            $hv->id                     = $_POST['id'];
            $hv->id_hv                  = $_POST['id_hv'];
            $hv->exp_empresa            = $_POST['exp_empresa'];
            $hv->exp_cargo              = $_POST['exp_cargo'];
            $hv->exp_CS_flag            = $_POST['exp_CS'];
            $hv->exp_id_area            = $_POST['exp_CS'];
            $hv->exp_id_departamento    = $_POST['exp_id_departamento'];
            $hv->exp_id_municipio       = $_POST['exp_id_municipio'];
            $hv->exp_fecha_inicio       = $_POST['exp_fecha_inicio'];
            $hv->exp_fecha_actualmente  = $_POST['exp_fecha_actualmente'];
            $hv->exp_rama               = $_POST['exp_rama'];
            $hv->usuario                = $_POST['usuario'];
            if($_POST['exp_fecha_fin'] !=""){
                $hv->exp_fecha_fin      = $_POST['exp_fecha_fin'];
            }else{
                $hv->exp_fecha_fin      = '0000-00-00';
            }
            $hv->return_flag            = $_POST['return_flag'];
            $raiz = "documentos_HV";
            //AQUI SE CREA EL DIRECTORIO
            if(is_dir($raiz.'/Certificados_Laborales/')){
                $bandera=0;
            }else{
                mkdir($raiz.'/Certificados_Laborales/', 0, true);
            }
            if(empty($hv->exp_id_area)){
                $hv->exp_id_area = 0;
            }
            if( !empty( $_FILES['exp_ruta_certificado']['name'] ) ){
                date_default_timezone_set('America/Bogota'); 
                $formato = date('Ymd_hi') . '-' . strtolower(utf8_decode($_FILES['exp_ruta_certificado']['name']));
                move_uploaded_file ($_FILES['exp_ruta_certificado']['tmp_name'], 'documentos_HV/Certificados_Laborales/'. $formato);
                $hv->exp_ruta_certificado = utf8_encode($formato);
            }else{
                $hv->exp_ruta_certificado = $_POST['ruta_recu'];
            }
            $this->model->Actualizar_Exp_Laboral($hv);
            if($_SESSION['idUsuario'] !=""){
                if($hv->return_flag ==1){
                    header('Location: index.php?c=Hoja_vida&a=Personal');
                }else if($hv->return_flag == 2){ 
                    header("Location: index.php?c=Hoja_vida&a=Ver_HV_US&id=$hv->usuario&return_flag=2");
                }
            }else{
                header('Location: index.php');
            }
        }
		public function Eliminar_Exp_laboral() {
            session_start();
            $_SESSION['nombre'];
            $hv = new HojaVida();
            $hv->id                     = $_POST['id'];
            $hv->usuario                = $_POST['usuario'];
            $hv->return_flag            = $_POST['return_flag'];
            $this->model->Eliminar_Exp_Laboral($hv);
            if($_SESSION['idUsuario'] !=""){
                if($hv->return_flag ==1){
                    header('Location: index.php?c=Hoja_vida&a=Personal');
                }else if($hv->return_flag == 2){ 
                    header("Location: index.php?c=Hoja_vida&a=Ver_HV_US&id=$hv->usuario&return_flag=2");
                }
            }else{
                header('Location: index.php');
            }
        }
        public function Generar_PDF_HV($id_empleado) {
            require_once 'view/Hoja_vida/pdf.php';
        }
//        public function Generar_PDF_HV($id_empleado) {
//            require_once 'view/Hoja_vida/Generar_PDF_hv.php';
//        }
//************************************************************************************ FIN TALENTO HUMANO *******************
        
//**************INICIO PERMISOS -************************************************************************ *******************        
//        SOLICITUD PERMISOS **********************
        public function Ver_lista_Permisos(){            
            require_once 'view/header.php';
            require_once 'view/permisos/permisos.php';
            require_once 'view/footer.php';
        }
        public function Crud_Permisos(){
            $per = new HojaVida(); 
            if(isset($_REQUEST['id'])){
                $per = $this->model->ObtenerPermiso($_REQUEST['id']);
            }
            require_once 'view/header.php';
            require_once 'view/permisos/permisos-editar.php';
            require_once 'view/footer.php';
        }
        public function Guardar_Permiso_Estudio(){
            session_start();
            $_SESSION['nombre'];
            $per = new HojaVida();
            $campos               = 'usuario';
            $nombrelista          = 'pa_usuario_acciones';
            $idaccion             = '29';
            $campoordenar         = 'id';
            $datosusuarioacciones = $per->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
            $usuarios             = $datosusuarioacciones->fetch();
            $usuariosa            = explode("////",$usuarios[usuario]);
            
            $per->per_est_id    = $_POST['per_est_id'];
            $per->cedula        = $_POST['cedula_other'];
            $per->nombres       = $_POST['nombre_other'];
            $per->institucion   = $_POST['institucion'];
            $per->programa      = $_POST['programa'];
            $per->periodo_acad  = $_POST['per_academico'];
            $per->fechaI        = $_POST['fechaI'];
            $per->fechaF        = $_POST['fechaF'];

            $raiz = "Documentos_TH";
            //AQUI SE CREA EL DIRECTORIO
            if(is_dir($raiz.'/Constancias_Horarios/')){
                $bandera=0;
            }else{
                mkdir($raiz.'/Constancias_Horarios/', 0, true);
            }
            if(is_dir($raiz.'/Comprobantes_Matriculas/')){
                $bandera=0;
            }else{
                mkdir($raiz.'/Comprobantes_Matriculas/', 0, true);
            }
            // DOCUMENTO CONSTANCIA ESTUDIOS
            if( !empty( $_FILES['per_est_ruta_doc_horario']['name'] ) ){
                date_default_timezone_set('America/Bogota'); 
                $formato = date('Ymd_hi') . '-' . strtolower(utf8_decode($_FILES['per_est_ruta_doc_horario']['name']));
                move_uploaded_file ($_FILES['per_est_ruta_doc_horario']['tmp_name'], 'Documentos_TH/Constancias_Horarios/'. $formato);
                $per->per_est_ruta_doc_horario = $formato;
            }else{
                $per->per_est_ruta_doc_horario = $_POST['per_doc_horario'];
            }
            // DOCUMENTO COMPROBANTE MATRICULA
            if( !empty( $_FILES['per_est_ruta_doc_matricula']['name'] ) ){
                date_default_timezone_set('America/Bogota'); 
                $formato = date('Ymd_hi') . '-' . strtolower(utf8_decode($_FILES['per_est_ruta_doc_matricula']['name']));
                move_uploaded_file ($_FILES['per_est_ruta_doc_matricula']['tmp_name'], 'Documentos_TH/Comprobantes_Matriculas/'. $formato);
                $per->per_est_ruta_doc_matricula = $formato;
            }else{
                $per->per_est_ruta_doc_matricula = $_POST['per_doc_maticula'];
            }
            
            $per->per_est_id > 0 
                ? $this->model->ActualizarPermiso($per)
                : $this->model->Registrar_Permiso_Estudio($per);
            if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
                header('Location: index.php?c=Hoja_vida&a=Ver_lista_Permisos');
            }else{
                header('Location: index.php?c=Hoja_vida&a=Ver_mis_permisos_estudio_us');
            }
        }
        public function Ver_mis_permisos_estudio_us(){            
            require_once 'view/header.php';
            require_once 'view/permisos/Mis_permisos_estudio_us.php';
            require_once 'view/footer.php';
        }
        public function change_Estado(){
            session_start();
            $_SESSION['nombre'];
            $hv = new HojaVida();
            
            $hv->id             = $_POST['id'];
            $hv->estado         = $_POST['id_estado']; 
            $hv->observaciones  = $_POST['observaciones'];
            $hv->usuario        = $_POST['usuario'];
            $this->model->Cambiar_Estado_permiso($hv);
            if($_SESSION['idUsuario'] !=""){
                header("Location: index.php?c=Hoja_vida&a=Ver_lista_Permisos");
            }else{
                header('Location: index.php');
            }
        }
        //**************************************************************************************
        // PERMISO INFERIOR 1 DÌA - BÁSICO
        public function Crud_Permiso_Basico(){
            $per = new HojaVida(); 
            if(isset($_REQUEST['id'])){
                $per = $this->model->ObtenerPermisoBasico($_REQUEST['id']);
            }
            require_once 'view/header.php';
            require_once 'view/permisos/permisos_Basico-editar.php';
            require_once 'view/footer.php';
        }
        public function Guardar_PermisoBasico(){
            session_start();
            $per = new HojaVida();
            $campos               = 'usuario';
            $nombrelista          = 'pa_usuario_acciones';
            $idaccion             = '4';
            $campoordenar         = 'id';
            $datosusuarioacciones = $per->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
            $usuarios             = $datosusuarioacciones->fetch();
            $usuariosa            = explode("////",$usuarios[usuario]);
            
            $per->id             = $_POST['id'];
            $per->fecha_permiso  = $_POST['fecha_permiso'];
            $per->hora_inicio    = $_POST['hora_inicio'];
            $per->hora_fin       = $_POST['hora_fin'];
            $per->comentarios    = $_POST['comentarios'];
            $per->per_out        = $_POST['per_out'];
            $per->per_vot        = $_POST['per_vot'];
            
            $raiz = "Documentos_TH";
            if(is_dir($raiz.'/REPS_Docs_Permisos/')){
                $bandera=0;
            }else{
                mkdir($raiz.'/REPS_Docs_Permisos/', 0, true);
            }
            // DOCUMENTO ADJUNTO
            if( !empty( $_FILES['per_ruta_doc_adjunto']['name'] ) ){
                date_default_timezone_set('America/Bogota'); 
                $formato = date('Ymd_hi') . '-' . strtolower(utf8_decode($_FILES['per_ruta_doc_adjunto']['name']));
                move_uploaded_file ($_FILES['per_ruta_doc_adjunto']['tmp_name'], 'Documentos_TH/REPS_Docs_Permisos/'. $formato);
                $per->per_ruta_doc_adjunto = $formato;
            }else{
                $per->per_ruta_doc_adjunto = $_POST['per_doc_adjunto'];
            }
            
            $per->per_est_id > 0 
                ? $this->model->ActualizarPermiso_Basico($per)
                : $this->model->Registrar_Permiso_Basico($per);
            if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
                header('Location: index.php?c=Hoja_vida&a=Ver_lista_Permiso_Basico');
            }else{
                header('Location: index.php?c=Hoja_vida&a=Ver_lista_Mis_Permiso_Basico');
            }
        }

        public function Guardar_Permiso_Mayor()
        {
            session_start();
            $per = new HojaVida();
            $campos               = 'usuario';
            $nombrelista          = 'pa_usuario_acciones';
            $idaccion             = '4';
            $campoordenar         = 'id';
            $datosusuarioacciones = $per->get_lista_usuario_acciones($campos, $nombrelista, $idaccion, $campoordenar);
            $usuarios             = $datosusuarioacciones->fetch();
            $usuariosa            = explode("////",$usuarios['usuario']);

            //$data->per_id_usuario,  // usuario que necesita el permiso.
            //$idusuario,             // usuario que registra el permiso.

           // $per->id             = $_POST['id'];
            $per->comentarios    = $_POST['comentarios'];
            $per->per_out        = $_POST['per_out'];

            $raiz = "Documentos_TH";
            if(is_dir($raiz.'/REPS_Docs_Permisos/'))
            {
                $bandera = 0;
            }
            else
            {
                mkdir($raiz.'/REPS_Docs_Permisos/', 0, true);
            }
            // DOCUMENTO ADJUNTO
            if( !empty( $_FILES['per_mayor_ruta_doc']['name'] ) )
            {
                date_default_timezone_set('America/Bogota'); 
                $formato = date('Ymd_hi') . '-' . strtolower(utf8_decode($_FILES['per_mayor_ruta_doc']['name']));
                move_uploaded_file ($_FILES['per_mayor_ruta_doc']['tmp_name'], 'Documentos_TH/REPS_Docs_Permisos/'. $formato);
                $per->per_ruta_doc_adjunto = $formato;
            }
            else
            {
                $per->per_ruta_doc_adjunto = $_POST['per_mayor_doc'];
            }
            //$per->per_est_id > 0 
                //? $this->model->ActualizarPermiso_Basico($per)
                //: $this->model->Registrar_Permiso_Basico($per);

            $this->model->Registrar_Permiso_Mayor($per); // this

            if ( in_array($_SESSION['idUsuario'], $usuariosa) ) 
            {
                header('Location: index.php?c=Hoja_vida&a=Ver_lista_Permiso_Mayores');
            }
            else
            {
                header('Location: index.php?c=Hoja_vida&a=Ver_lista_Mis_Permiso_Mayores_us');
            }

        	/*$mi_fecha;
        	foreach ($_POST["fechai"] as $fecha)
        	{
        		print'<script type="text/javascript"> alert("'. $fecha .'"); </script>';
        	}
        	print'<script type="text/javascript"> alert("'. $_POST["h_numero_fecha"] .'"); </script>';*/

            /*$arrFechai = $_POST["fechai"];
            $arrFechaf = $_POST["fechaf"];
            $arrHorai = $_POST["horai"];
            $arrHoraf = $_POST["horaf"];

            for($i = 0; $i < $_POST['h_numero_fecha']; $i++)
            {
                print'<script type="text/javascript"> alert("'. $arrFechai[$i] .'\n'. $arrHorai[$i] .'\n'. $arrFechaf[$i] . '\n'.$arrHoraf[$i].'"); </script>';
            }*/


        	//print'<script type="text/javascript"> alert("'. $mi_fecha .'"); </script>';
        }

        public function ActualizarEstadoPermisoMayor(){
            session_start();
            $_SESSION['nombre'];
            $hv = new HojaVida();

            //print'<script type="text/javascript">alert("' . $_POST['id_estado'] . '");" </script>';
            
            $hv->id             = $_POST['id'];
            $hv->estado         = $_POST['id_estado']; 
            $hv->flag_out       = $_POST['flag_out'];
            //$hv->flag_votacion  = $_POST['flag_votacion'];
            $hv->observaciones  = $_POST['observaciones'];
            $hv->fecha_aprobado = date('Y-m-d');
            $this->model->Actualizar_Estado_Permiso_Mayor($hv);
            if($_SESSION['idUsuario'] !=""){
                header("Location: index.php?c=Hoja_vida&a=Ver_lista_Permiso_Mayores");
            }else{
                header('Location: index.php');
            }
        }

        /*public function Crud_licencia_noRemunerada3(){
            require_once 'view/header.php';
            require_once 'view/permisos/permisos_basicos.php';
            require_once 'view/footer.php';
        }*/










        public function Crud_Certi_Laboral(){
            $per = new HojaVida(); 
            if(isset($_REQUEST['id'])){
                $per = $this->model->ObtenerCertiLaboral($_REQUEST['id']);
            }
            require_once 'view/header.php';
            require_once 'view/certificados/certificado_laboral-editar.php';
            require_once 'view/footer.php';
        }
        public function Ver_lista_Permiso_Basico(){
            require_once 'view/header.php';
            require_once 'view/permisos/permisos_basicos.php';
            require_once 'view/footer.php';
        }
        public function ActualizarRegistroPermiso(){ // cambia de estado el permiso menor a un dia
            session_start();
            $_SESSION['nombre'];
            $hv = new HojaVida();
            
            $hv->id             = $_POST['id'];
            $hv->estado         = $_POST['id_estado']; 
            $hv->flag_out       = $_POST['flag_out'];
            $hv->flag_votacion  = $_POST['flag_votacion'];
            $hv->observaciones  = $_POST['observaciones'];
            $hv->fecha_aprobado = date('Y-m-d');
            $this->model->Actualizar_RegistroPermiso($hv);
            if($_SESSION['idUsuario'] !=""){
                header("Location: index.php?c=Hoja_vida&a=Ver_lista_Permiso_Basico");
            }else{
                header('Location: index.php');
            }
        }
        // vER PERMISOS DE USUARIO
        public function Ver_lista_Mis_Permiso_Basico(){            
            require_once 'view/header.php';
            require_once 'view/permisos/Mis_permisos_basicos.php';
            require_once 'view/footer.php';
        }

        public function Ver_lista_Permiso_Mayores(){            // usuario admin
            require_once 'view/header.php';
            require_once 'view/permisos/permisos_mayor.php';
            require_once 'view/footer.php';
        }

        public function Ver_lista_Mis_Permiso_Mayores_us(){     // usuario comun         
            require_once 'view/header.php';
            require_once 'view/permisos/Mis_permisos_mayor_us.php';
            require_once 'view/footer.php';
        }

        public function permiso_editar_mayor1(){
            $per = new HojaVida(); 
            if(isset($_REQUEST['id'])){
                $per = $this->model->ObtenerPermiso_mayor1($_REQUEST['id']);
            }
            require_once 'view/header.php';
            require_once 'view/permisos/permiso_editar_mayor1.php';
            require_once 'view/footer.php';
        }
        //**************INICIO LICENCIAS -************************************************************************ *******************        
        // *********** SOLICITUD LICENCIA **********************
        public function Crud_licencia_noRemunerada3(){
            $per = new HojaVida(); 
            if(isset($_REQUEST['id'])){
                $per = $this->model->ObtenerLicencia_NoRemunerada3($_REQUEST['id']);
            }
            require_once 'view/header.php';
            require_once 'view/licencias/licencia_noRemunerada3.php';
            require_once 'view/footer.php';
        }

        public function Guardar_Licencia_noRemunerada3() {
            session_start();
            $lic = new HojaVida();
            
            $lic->id            = $_POST['lic_id'];
            $lic->lic_id_tipo   = $_POST['lic_id_tipo'];
            //$lic->cedula        = $_POST['cedula_other'];
            //$lic->nombres       = $_POST['nombre_other'];
            $lic->fecha_escrito = $_POST['fechaEscrito'];
            $lic->fechaInicio   = $_POST['fechaI'];
            //echo $_POST['id_servidor'] ." " . $lic->cedula . " " . utf8_decode($lic->nombres);
            //echo "post: " . $_POST['fechaF'];
            if ( $_POST['fechaF'] == "" )
            {
                $fecha_f = new DateTime($_POST['fechaI']);
                if($lic->lic_id_tipo == 5) // 3 meses
                {
                    $fecha_f->add(new DateInterval('P3M'));
                }
                else   //  2 años
                {
                    $fecha_f->add(new DateInterval('P2Y'));
                }
                $lic->fechaFin = $fecha_f->format('Y-m-d');
            }
            else
            {
                $lic->fechaFin = $_POST['fechaF'];
            }
            //echo "<br /> this: ". $lic->fechaFin;
            $lic->comentario    = $_POST['motivo_licen'];
            if(isset($_POST['ciudad_lice']))
            {
                $lic->comentario .= " " . $_POST['ciudad_lice'];
            }

            // Documento Adjunto
            $raiz = "Documentos_TH";
            if(is_dir($raiz.'/REPS_Docs_Licencia/'))
            {
                $bandera = 0;
            }
            else
            {
                mkdir($raiz.'/REPS_Docs_Licencia/', 0, true);
            }
            // DOCUMENTO ADJUNTO
            if( !empty( $_FILES['per_ruta_doc_adjunto']['name'] ) )
            {
                date_default_timezone_set('America/Bogota'); 
                $formato = date('Ymd_hi') . '-' . strtolower(utf8_decode($_FILES['per_ruta_doc_adjunto']['name']));
                move_uploaded_file ($_FILES['per_ruta_doc_adjunto']['tmp_name'], 'Documentos_TH/REPS_Docs_Licencia/'. $formato);
                $lic->ruta_doc_adjunto = $formato;
            }
            else
            {
                $lic->ruta_doc_adjunto = $_POST['per_ruta_doc_adjunto'];
            }
            
            $this->model->Registrar_Licencia_noRemunerada3($lic);

            if ( !empty($_SESSION['idUsuario']))
            {
                $modelo               = new HojaVida();
                $campos               = 'usuario';
                $nombrelista          = 'pa_usuario_acciones';
                $idaccion             = '28';
                $campoordenar         = 'id';
                $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
                $usuarios             = $datosusuarioacciones->fetch();
                $usuariosa            = explode("////",$usuarios['usuario']);
                
                if( in_array($_SESSION['idUsuario'], $usuariosa) )
                {
                    header("Location: index.php?c=Hoja_vida&a=Consultar_licencia_noRemunerada3");
                }
                else
                {
                    header("Location: index.php?c=Hoja_vida&a=Consultar_licencia_noRemunerada3_user");
                }
            }
            else
            {
                header('refresh:2; url=http://172.16.175.124/centro_servicios2');
            }
        }

        public function Consultar_licencia_noRemunerada3(){
            require_once 'view/header.php';
            require_once 'view/licencias/consulta_licencia_no_remunerada.php';
            require_once 'view/footer.php';
        }

        public function Consultar_licencia_noRemunerada3_user(){
            require_once 'view/header.php';
            require_once 'view/licencias/consulta_licencia_no_remunerada_user.php';
            require_once 'view/footer.php';
        }

        public function Actualizar_Estado_Licencia_No_Remunerada(){
            session_start();
            //$_SESSION['nombre'];
            $hv = new HojaVida();
            
            $hv->id             = $_POST['id'];
            $hv->estado         = $_POST['id_estado'];
            $this->model->Actualizar_Estado_Licencia_No_Remunerada($hv);
            if($_SESSION['idUsuario'] != "")
            {
                header("Location: index.php?c=Hoja_vida&a=Consultar_licencia_noRemunerada3");
            }
            else{
                header('Location: index.php');
            }
        }
        public function Crud_Res_Nombramiento(){
            require_once 'view/header.php';
            require_once 'view/nombramientos/nombramiento.php';
            require_once 'view/footer.php';
        }

        
        //******************************* CALENDARIO FESTIVOS *****************************//
        public function dia_noHabil(){
            require_once 'view/header.php';
            require_once 'view/festivos/lista_diasFestivos.php';
            require_once 'view/footer.php';
        }
        public function Crud_Festivo(){
            $vis = new Visita();
            if(isset($_REQUEST['id'])){
                $vis = $this->model->Obtener_Festivo($_REQUEST['id']);
            }
            require_once 'view/header.php';
            require_once 'view/festivos/festivo-editar.php';
            require_once 'view/footer.php';
        }
        public function Guardar_dia_noHabil(){
            $vis = new Visita();
            $vis->id                = $_POST['id'];
            $vis->fecha_Festivo     = $_POST['fechaFestivo'];
            $vis->descripcionF      = $_POST['descripcionF'];
            
            $vis->id > 0 
                ? $this->model->Actualizar_DiaFestivo($vis)
                : $this->model->Registrar_DiaFestivo($vis);

            header('Location: ?c=Visitas&a=dia_noHabil');
        }
        public function Delete_Festivo(){
            $this->model->Eliminar_Festivo($_REQUEST['id']);
            header('Location: ?c=Visitas&a=dia_noHabil');
        }
        
        public function Crud_plantaPersonal(){
            require_once 'view/header.php';
            require_once 'view/planta_personal/planta_personal-editar.php';
            require_once 'view/footer.php';
        }
        public function Guardar_PlantaPersonal(){
            session_start();
            $_SESSION['nombre'];
            $hv = new HojaVida(); 
            
            $hv->id                     = $_POST['id'];
            $hv->id_usuario             = $_POST['pla_user_select'];
            $hv->id_cargo               = $_POST['pla_id_cargo'];
            $hv->pla_id_clase_nombra    = $_POST['pla_id_clase'];
            $hv->pla_flag_licencia      = $_POST['optpropiedad'];
            // VARIABLE PARA NÙMERO DE RESOLUCION 
            if($_POST['pla_num_res_nomb_Pro'] !=""){
                $hv->num_resolucion_nombramiento = $_POST['pla_num_res_nomb_Pro'];
            }else if($_POST['pla_num_res_nomb_Prov'] !=""){
                $hv->num_resolucion_nombramiento = $_POST['pla_num_res_nomb_Prov'];
            }else if($_POST['pla_num_res_nomb_Enc'] !=""){
                $hv->num_resolucion_nombramiento = $_POST['pla_num_res_nomb_Enc'];
            }else{
                $hv->num_resolucion_nombramiento = "";
            }
            // VARIABLE PARA FECHA INICIO
            if($_POST['pla_fecha_inicio_Pro'] != ""){
                $hv->fecha_inicio = $_POST['pla_fecha_inicio_Pro'];
            }else if($_POST['pla_fecha_inicio_Prov'] !=""){
                $hv->fecha_inicio = $_POST['pla_fecha_inicio_Prov'];
            }else if($_POST['pla_fecha_inicio_Enc'] !=""){
                $hv->fecha_inicio = $_POST['pla_fecha_inicio_Enc'];
            }else{
                $hv->fecha_inicio ="0000-00-00";
            }
            // VARIABLE PARA FECHA FIN
            if($_POST['pla_fecha_fin_Pro'] >0){
                $hv->fecha_fin = $_POST['pla_fecha_fin_Pro'];
                $hv->flag_alerta = 1;
            }else if($_POST['pla_fecha_fin_Prov'] !=""){
                $hv->fecha_fin = $_POST['pla_fecha_fin_Prov'];
                $hv->flag_alerta = 1;
            }else if($_POST['pla_fecha_fin_Enc'] !=""){
                $hv->fecha_fin = $_POST['pla_fecha_fin_Enc'];
                $hv->flag_alerta = 1;
            }else{
                $hv->fecha_fin ="0000-00-00";
                $hv->flag_alerta = 0;
            }
            // VARIABLE PARA UBICACIÓN
            if($_POST['pla_id_ubicacion_Pro'] >0){
                $hv->id_ubicacion = $_POST['pla_id_ubicacion_Pro'];
                //echo 1;
            }else if($_POST['pla_id_ubicacion_Prov'] >0){
                $hv->id_ubicacion = $_POST['pla_id_ubicacion_Prov'];
                //echo 2;
            }else if($_POST['pla_id_ubicacion_Enc'] !=""){
                $hv->id_ubicacion = $_POST['pla_id_ubicacion_Enc'];
                //echo 3;
            }else{
                $hv->id_ubicacion="0";
                //echo 4;
            }
            // VARIABLE PARA ÁREA
            if($_POST['pla_id_are_Pro'] >0){
                $hv->id_area = $_POST['pla_id_are_Pro'];
            }else if($_POST['pla_id_are_Prov'] >0){
                $hv->id_area = $_POST['pla_id_are_Prov'];
            }else if($_POST['pla_id_are_Enc'] >0){
                $hv->id_area = $_POST['pla_id_are_Enc'];
            }else{
                $hv->id_area = 0;
            }
            // VARIABLE PARA NÙMERO DE RESOLUCION 
            if($_POST['pla_resol_traslado_Prov'] !=""){
                $hv->num_resolucion_traslado = $_POST['pla_resol_traslado_Prov'];
            }else if($_POST['pla_resol_traslado_Enc'] !=""){
                $hv->num_resolucion_traslado = $_POST['pla_resol_traslado_Enc'];
            }else{
                $hv->num_resolucion_traslado = "";
            }
            if($_POST['pla_id_user_Reemplaza_Prov'] >0){
                $hv->id_user_reemplaza       = $_POST['pla_id_user_Reemplaza_Prov'];
                //echo 1;
            }else if($_POST['pla_id_user_Reemplaza_Prov1'] >0){
                $hv->id_user_reemplaza       = $_POST['pla_id_user_Reemplaza_Prov1'];
                //echo 2;
            }else if($_POST['pla_id_user_Reemplaza_Enc'] >0){
                $hv->id_user_reemplaza       = $_POST['pla_id_user_Reemplaza_Enc'];
                //echo 3;
            }else{
                $hv->id_user_reemplaza       = 0;
                //echo 4;
            }
            $hv->id > 0 
                ? $this->model->ActualizarDatosPlantaPersonal($hv)
                : $this->model->RegistrarDatosPlantaPersonal($hv);
            
            if($_SESSION['idUsuario'] !=""){
                header("Location: index.php?c=Hoja_vida");
            }else{
                header('Location: index.php');
            }
        }
        public function Listado_PlantaPersonal(){
            require_once 'view/header.php';
            require_once 'view/planta_personal/Listado_plantaPersonal.php';
            require_once 'view/footer.php';
        }
        public function Listado_Vencimiento_Licencias(){
            require_once 'view/header.php';
            require_once 'view/planta_personal/Listado_Vencimiento_Licencias.php';
            require_once 'view/footer.php';
        }
        public function Apagar_AlertaVencimiento(){
            if(isset($_REQUEST['data-id'])){
                $this->model->Apagar_AlertaVencimiento($_REQUEST['data-id'], $_REQUEST['data-us']);
                header('Location: index.php');
            }
        }
        public function Registrar_usuario(){
            session_start();
            $_SESSION['nombre'];
            $hv = new HojaVida(); 
            $nombre = strtolower(utf8_decode($_POST['usu_nombre']));
            $hv->cedula = $_POST['usu_cedula'];
            $hv->nombres = ucwords(utf8_encode($nombre)); 
            $this->model->Registrar_usuario($hv);
            header("Location: index.php?c=Hoja_vida&a=Crud_Res_Nombramiento");
            
        }
        public function Guardar_ResolucionNombramiento(){
            session_start();
            $_SESSION['nombre'];
            $hv = new HojaVida(); 
            
            $hv->id                 = $_POST['id'];
            $hv->id_usuario         = $_POST['res_id_usuario'];
            $hv->id_clase_nombra    = $_POST['res_id_clase'];
            $hv->id_cargo           = $_POST['res_id_cargo'];
            $hv->id_cargoActual     = $_POST['pla_id_cargo'];
            $hv->flag_abierto       = $_POST['optAbierto'];
            $hv->flag_first_time    = $_POST['flag_first_vez'];
            $hv->num_pazSalvo       = $_POST['num_pazSalvo'];
            
            //----------PROPIEDAD---------------
            $hv->oficio = $_POST['res_oficio'];
            $hv->acuerdo = $_POST['res_acuerdo']; 
            // VARIABLE CDP - CERTIFICADO DISPONIBILIDAD PRESUPUESTA
            if($_POST['cdp_Pro'] !=""){
                $hv->cdp = $_POST['cdp_Pro'];
            }else if($_POST['cdp_ProVi'] !=""){
                $hv->cdp = $_POST['cdp_ProVi'];
            }else if($_POST['cdp_Enc'] !=""){
                $hv->cdp = $_POST['cdp_Enc'];
            }else{
                $hv->cdp = "";
            }
            // VARIABLE PARA FECHA INICIO 
            if($_POST['res_fecha_inicio_Prov'] != ""){
                $hv->fecha_inicio = $_POST['res_fecha_inicio_Prov'];
            }else if($_POST['res_fecha_inicio_Enc'] !=""){
                $hv->fecha_inicio = $_POST['res_fecha_inicio_Enc'];
            }else{
                $hv->fecha_inicio ="0000-00-00"; 
            }
            // VARIABLE PARA FECHA FIN
            if($_POST['res_fecha_fin_Prov'] >0){
                $hv->fecha_fin = $_POST['res_fecha_fin_Prov'];
            }else{
                $hv->fecha_fin ="0000-00-00";
            }
            // VARIABLE PARA UBICACIÓN
            if($_POST['id_ubicacionPro'] >0){
                $hv->id_ubicacion = $_POST['id_ubicacionPro'];
                //echo 1;
            }else if($_POST['id_ubicacionProv'] >0){
                $hv->id_ubicacion = $_POST['id_ubicacionProv'];
                //echo 2;
            }else if($_POST['id_ubicacionEnc'] !=""){
                $hv->id_ubicacion = $_POST['id_ubicacionEnc'];
                //echo 3;
            }else{
                $hv->id_ubicacion="0";
                //echo 4;
            }
            // VARIABLE PARA ÁREA
            if($_POST['id_arePro'] >0){
                $hv->id_area = $_POST['id_arePro'];
            }else if($_POST['id_areProv'] >0){
                $hv->id_area = $_POST['id_areProv'];
            }else if($_POST['id_areEnc'] >0){
                $hv->id_area = $_POST['id_areEnc'];
            }else{
                $hv->id_area = 0;
            }
            
            if($_POST['res_id_user_Reemplaza_Pro'] >0){
                $hv->id_user_reemplaza  = $_POST['res_id_user_Reemplaza_Pro'];
                //echo 1;
            }else if($_POST['res_id_user_Reemplaza_ProV'] >0){
                $hv->id_user_reemplaza  = $_POST['res_id_user_Reemplaza_ProV'];
                //echo 2;
            }else{
                $hv->id_user_reemplaza  = 0;
                //echo 3;
            }
            $raiz = "documentos_TH";
            //$nom  = $_SESSION['idUsuario'];
            //AQUI SE CREA EL DIRECTORIO
            if(is_dir($raiz.'/Doc_Resoluciones_Nombramiento/')){
                $bandera=0;
            }else{
                mkdir($raiz.'/Doc_Resoluciones_Nombramiento/', 0, true);
            }
            //DOC CONTRALORIA
            if( !empty( $_FILES['res_ruta_contraloria']['name'] ) ){
                date_default_timezone_set('America/Bogota'); 
                $formato = date('Ymd_hi') . '-C-' . strtolower(utf8_decode($_FILES['res_ruta_contraloria']['name']));
                move_uploaded_file ($_FILES['res_ruta_contraloria']['tmp_name'], 'documentos_TH/Doc_Resoluciones_Nombramiento/'. $formato);
                $hv->res_ruta_contraloria = utf8_encode($formato);
            }else{
                $hv->res_ruta_contraloria = $_POST['res_contraloria'];
            }
            //echo "contra ".$hv->res_ruta_contraloria;
            //DOC PROCURADURIA
            if( !empty( $_FILES['res_ruta_procuraduria']['name'] ) ){
                date_default_timezone_set('America/Bogota'); 
                $formato = date('Ymd_hi') . '-P-' . strtolower(utf8_decode($_FILES['res_ruta_procuraduria']['name']));
                move_uploaded_file ($_FILES['res_ruta_procuraduria']['tmp_name'], 'documentos_TH/Doc_Resoluciones_Nombramiento/'. $formato);
                $hv->res_ruta_procuraduria = utf8_encode($formato);
            }else{
                $hv->res_ruta_procuraduria = $_POST['res_procuraduria'];
            }
            //echo " procu ".$hv->res_ruta_procuraduria;
            //DOC MEDIDAS CORRECTIVAS
            if( !empty( $_FILES['res_ruta_medidas']['name'] ) ){
                date_default_timezone_set('America/Bogota'); 
                $formato = date('Ymd_hi') . '-M-' . strtolower(utf8_decode($_FILES['res_ruta_medidas']['name']));
                move_uploaded_file ($_FILES['res_ruta_medidas']['tmp_name'], 'documentos_TH/Doc_Resoluciones_Nombramiento/'. $formato);
                $hv->res_ruta_medidas = utf8_encode($formato);
            }else{
                $hv->res_ruta_medidas = $_POST['res_medidas'];
            }
            //echo " medi ".$hv->res_ruta_medidas;
            //DOC ANTECEDENTES JUDICIALES
            if( !empty( $_FILES['res_ruta_antecedentes']['name'] ) ){
                date_default_timezone_set('America/Bogota'); 
                $formato = date('Ymd_hi') . '-A-' . strtolower(utf8_decode($_FILES['res_ruta_antecedentes']['name']));
                move_uploaded_file ($_FILES['res_ruta_antecedentes']['tmp_name'], 'documentos_TH/Doc_Resoluciones_Nombramiento/'. $formato);
                $hv->res_ruta_antecedentes = utf8_encode($formato);
            }else{
                $hv->res_ruta_antecedentes = $_POST['res_antecedentes'];
            }
            //echo " antec ".$hv->res_ruta_antecedentes;
            //DOC DECLARACIÒN DE INHABILIDADES
            if( !empty( $_FILES['res_ruta_inhabilidades']['name'] ) ){
                date_default_timezone_set('America/Bogota'); 
                $formato = date('Ymd_hi') . '-I-' . strtolower(utf8_decode($_FILES['res_ruta_inhabilidades']['name']));
                move_uploaded_file ($_FILES['res_ruta_inhabilidades']['tmp_name'], 'documentos_TH/Doc_Resoluciones_Nombramiento/'. $formato);
                $hv->res_ruta_inhabilidades = utf8_encode($formato);
            }else{
                $hv->res_ruta_inhabilidades = $_POST['res_inhabilidades'];
            }
            //echo " inha ".$hv->res_ruta_inhabilidades;
            $hv->id > 0
                ? $this->model->ActualizarDatosPlantaPersonal($hv)
                : $this->model->Registrar_Res_Nombramiento($hv);
            
            if($_SESSION['idUsuario'] !=""){
                header("Location: index.php?c=Hoja_vida&a=Ver_listado_Nombramientos");
            }else{
                header('Location: index.php');
            }
        }
        public function Ver_listado_Nombramientos(){
            require_once 'view/header.php';
            require_once 'view/nombramientos/lista_nombramientos.php';
            require_once 'view/footer.php';
        }
        public function change_data_actaNombramiento(){
            session_start();
            $_SESSION['nombre'];
            $hv = new HojaVida();
            
            $hv->id                 = $_POST['id'];
            $hv->res_fecha_inicio   = $_POST['res_fecha_inicio'];
            $hv->id_usuarioE        = $_SESSION['idUsuario'];
            $this->model->Editar_Fecha_ActaNombramiento($hv);
            if($_SESSION['idUsuario'] !=""){
                header('Location: index.php?c=Hoja_vida&a=Ver_listado_Nombramientos');
            }else{
                header('Location: index.php');
            }
        }
        public function Editar_data_Nombramiento(){
            session_start();
            $_SESSION['nombre'];
            $hv = new HojaVida();
            
            $hv->id             = $_POST['id'];
            $hv->fecha_inicio   = $_POST['res_fecha_inicio'];
            $hv->res_cdp        = $_POST['res_cdp'];
            $hv->usuario        = $_POST['id_usuario'];
            
            $this->model->Editar_Res_Nombramiento($hv);
            if($_SESSION['idUsuario'] !=""){
                header('Location: index.php?c=Hoja_vida&a=Ver_listado_Nombramientos');
            }else{
                header('Location: index.php');
            }
        }
    }