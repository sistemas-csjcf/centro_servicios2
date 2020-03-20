<?php
    require_once 'model/permisos_model.php';
    class permisosController{
        private $model;
        public function __CONSTRUCT(){
            $this->model = new Permisos();
        }
        public function Index(){            
            require_once 'view/header.php';
            require_once 'view/permisos/permisos.php';
            require_once 'view/footer.php';
        }
        public function Crud(){
            $per = new Permisos();
            if(isset($_REQUEST['id'])){
                $per = $this->model->ObtenerPermiso($_REQUEST['id']);
            }
            require_once 'view/header.php';
            require_once 'view/permisos/permisos-editar.php';
            require_once 'view/footer.php';
        }
        public function Guardar_Permiso(){
            session_start();
            $_SESSION['nombre'];
            $per = new Permisos();
            $campos               = 'usuario';
            $nombrelista          = 'pa_usuario_acciones';
            $idaccion             = '20';
            $campoordenar         = 'id';
            $datosusuarioacciones = $per->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
            $usuarios             = $datosusuarioacciones->fetch();
            $usuariosa            = explode("////",$usuarios[usuario]);
            
            $per->per_est_id             = $_POST['per_est_id'];
            $per->per_cedula             = $_POST['per_cedula'];
            $per->per_nombres            = $_POST['per_nombres'];
            $per->per_apellidos          = $_POST['per_apellidos'];
            $per->per_fecha_nacimiento   = $_POST['per_fecha_nacimiento'];
            $per->per_id_departamento    = $_POST['per_id_departamento'];
            $per->per_id_municipio       = $_POST['per_id_municipio'];
            $per->per_direccion          = $_POST['per_direccion'];
            $per->per_telefono           = $_POST['per_telefono'];
            $per->per_celular            = $_POST['per_celular'];
            $per->per_email              = $_POST['per_email'];
            $per->id_usuario             = $_POST['id_usuarioR'];
            
            $raiz = "documentos";
            $nom  = $_SESSION['idUsuario'];
            //AQUI SE CREA EL DIRECTORIO
            if(is_dir($raiz.'/comprobantes_matriculas/'.$nom)){
                $bandera=0;
            }else{
                mkdir($raiz.'/comprobantes_matriculas/'.$nom, 0, true);
            }
            if( !empty( $_FILES['per_ruta_comprobante']['name'] ) ){
                date_default_timezone_set('America/Bogota'); 
                $formato = date('Y-m-d_h:i:s') . '-' . strtolower($_FILES['per_ruta_comprobante']['name']);
                move_uploaded_file ($_FILES['per_ruta_comprobante']['tmp_name'], 'documentos/comprobantes_matriculas/'.$nom .'/'. $formato);
                $per->per_ruta_comprobante = $formato;
            }else{
                $per->per_ruta_comprobante = $_POST['per_comprobante'];
            }
            
            $per->id > 0 
                ? $this->model->ActualizarPermiso($per)
                : $this->model->RegistrarPermiso($per);
            if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
                header('Location: index.php');
            }else{
                header('Location: index.php?c=talento_humano&a=Index');
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






//************************************************************************************ FIN TALENTO HUMANO
        public function Eliminar(){
            $this->model->Eliminar($_REQUEST['id']);
            header('Location: index.php');
        }
        public function Aprobar(){
            if(isset($_REQUEST['data-id'])){
                $this->model->Aprobar($_REQUEST['data-id'], $_REQUEST['data-us']) ;
                header('Location: index.php');
            }
        }
        public function H_Visitas(){
            require_once 'view/header.php';
            require_once 'view/visitas/visitas_historial.php';
            require_once 'view/footer.php';
        }
        /*/ Mostrar visitas relacionadas con el ID de la sesion del trabajador social y que NO esten Aprobadas y Finalizadas /*/
        public function Visitas_TS(){
            require_once 'view/header.php';
            require_once 'view/visitas/visitas_TS.php';
            require_once 'view/footer.php';
        }
        public function Finalizar(){
            if(isset($_REQUEST['data-id'])){
                $this->model->Finalizar($_REQUEST['data-id'], $_REQUEST['data-us']) ;
                header('Location: index.php?c=Visitas&a=Visitas_TS');
            }
        } 
        public function Cancelar_Visita(){
            session_start();
            $_SESSION['nombre'];
            $id_user = $_SESSION['idUsuario'];
            $vis = new Visita();
   
            $campos               = 'usuario';
            $nombrelista          = 'pa_usuario_acciones';
            $idaccion             = '20';
            $campoordenar         = 'id';
            $datosusuarioacciones = $vis->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
            $usuarios             = $datosusuarioacciones->fetch();
            $usuariosa            = explode("////",$usuarios[usuario]);
            
            if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
                if(isset($_REQUEST['id'])){
                    $this->model->Cancelar_visita($_REQUEST['motivo'], $_REQUEST['id'],$id_user, $_REQUEST['idtsocial']);
                    header('Location: index.php');
                }
            }else{
                if(isset($_REQUEST['id'])){
                    $this->model->Cancelar_visita($_REQUEST['motivo'], $_REQUEST['id'],$id_user, $_REQUEST['idtsocial']);
                    header('Location: index.php?c=Visitas&a=H_Visitas');
                }
            }
        }
        public function Cambiar_TSocialVisita(){
            if(isset($_REQUEST['id'])){
                $this->model->CambiarTSocialVisita($_REQUEST['id'], $_REQUEST['txt_id_TSocial'],$_REQUEST['id_TSocial']) ;
                header('Location: index.php');
            }
        }
        public function H_Visitas_TS(){
            require_once 'view/header.php';
            require_once 'view/visitas/visitas_historial_TS.php';
            require_once 'view/footer.php';
        }
        // --------------------------- Descargar documento excel formato Visita ----------------------
        public function Generar_Formato(){
            date_default_timezone_set('America/Bogota'); 	
            $fecharegistro = date('Y-m-d g:i'); 
            header("Content-type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=Formato_visita-$fecharegistro.xls");
            header("Pragma: no-cache");
            header("Expires: 0");
            require_once 'view/visitas/visitas-excel.php';
        }
        public function Actualizar_Visita(){
            $vis = new Visita();

            if(isset($_REQUEST['id'])){
                $vis = $this->model->Actualizar_Visita($_REQUEST['id'], $_REQUEST['comentarios']);
            }
            require_once 'view/header.php';
            require_once 'view/visitas/visitas.php';
            require_once 'view/footer.php';
        }
        
        //***************************************************************************** //
        // --------------- INFORMES VISITAS ------------------------------------------- //
        // ******************************* ---------------- *************************** //
        
        // --------------- INFORME SEGUIMIENTO ---------------------------------------- //
        // ******************************* ---------------- *************************** //
        public function IndexVisitasTS(){
            require_once 'view/header.php';
            require_once 'view/informes/informes_seguimientoTS.php';
            require_once 'view/footer.php';
        }
        public function Registrar_Informe_Seguimiento(){
            session_start();
            $idperfil = $_SESSION['idperfil'];
            if($idperfil ==21){
                $vis = new Visita();

                if(isset($_REQUEST['id'])){
                    $vis = $this->model->Obtener_datos_informe_visita($_REQUEST['id']);
                }
                require_once 'view/header.php';
                require_once 'view/informes/informe_seguimiento-editar.php';
                require_once 'view/footer.php';
            }else{
                print'<script type="text/javascript">alert("!Acceso denegado para este módulo, verifique la configuración de su perfil con el administrador del sistema...!"); location.href="index.php" </script>';
            }
        }
        public function Guardar_Informe_Seguimiento(){
            session_start();
            $_SESSION['nombre'];
            $vis = new Visita();

            $campos               = 'usuario';
            $nombrelista          = 'pa_usuario_acciones';
            $idaccion             = '20';
            $campoordenar         = 'id';
            $datosusuarioacciones = $vis->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
            $usuarios             = $datosusuarioacciones->fetch();
            $usuariosa            = explode("////",$usuarios[usuario]);
            
            $vis->id            = $_POST['id'];
            $vis->fecha_visita  = $_POST['fecha_visita'];
            $vis->hora_inicio   = $_POST['hora_inicio'];
            $vis->hora_fin      = $_POST['hora_fin'];
            $vis->municipio     = $_POST['municipio'];
            $vis->direccion     = $_POST['direccion'];
            $vis->num_personas  = $_POST['num_personas'];
            $vis->comentarios   = $_POST['comentarios'];
            $vis->duracion      = $_POST['duracion'];
            $vis->bool_log      = $_POST['bool_log'];
            
            $raiz = "uploads_informes";
            $nom  = $_SESSION['idUsuario'];
            //AQUI SE CREA EL DIRECTORIO
            if(is_dir($raiz.'/Informes_Seguimiento/'.$nom)){
                $bandera=0;
            }else{
                mkdir($raiz.'/Informes_Seguimiento/'.$nom, 0, true);
            }
            if( !empty( $_FILES['vis_inf_ruta_formato']['name'] ) ){
                date_default_timezone_set('America/Bogota'); 
                $formato = date('Ymdhis') . '-' . strtolower($_FILES['vis_inf_ruta_formato']['name']);
                move_uploaded_file ($_FILES['vis_inf_ruta_formato']['tmp_name'], 'uploads_informes/Informes_Seguimiento/'.$nom .'/'. $formato);
                 $vis->vis_inf_ruta_formato = $formato;
            }else{
                $vis->vis_inf_ruta_formato = $_POST['vis_inf_formato'];
            }
            
            $this->model->Guardar_Informe_Seguimiento($vis);
            if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
                header('Location: index.php');
            }else{
                header('Location: index.php?c=Visitas&a=IndexVisitasTS');
            }
        }
        public function Enviar_Informe(){
            $vis = new Visita();

            if(isset($_REQUEST['id'])){
                $vis = $this->model->Enviar_Informe($_REQUEST['id'],$_REQUEST['fecha_visita']);
            }
            header('Location: index.php?c=Visitas&a=IndexVisitasTS');
        }
        // HISTORIAL INF. SEGUIMIENTO X ASISTENTE SOCIAL
        public function Historial_Informe_Seguimiento(){
            require_once 'view/header.php';
            require_once 'view/informes/informe_seguimiento_historialTS.php';
            require_once 'view/footer.php';
        }
        // HISTORIAL INF. SEGUIMIENTO ADMIN
        public function Historial_Informe_SeguimientoAll(){
            require_once 'view/header.php';
            require_once 'view/informes/informe_seguimiento_historial.php';
            require_once 'view/footer.php';
        }
        // HISTORIAL INF. SEGUIMIENTO X DESPACHO
        public function Historial_Informe_SeguimientoD(){
            require_once 'view/header.php';
            require_once 'view/informes/informe_seguimiento_historialDespacho.php';
            require_once 'view/footer.php';
        }
        
        //***************************************************************************//
        // --------------- INFORME REMISIÓN ---------------------------------------- //
        //***************************************************************************//
        public function Listado_InformesRemision(){
            require_once 'view/header.php';
            require_once 'view/informes/informes_Listado_Remision.php';
            require_once 'view/footer.php';
        }
        public function Registrar_Informe_Remision(){
            session_start();
            $modelo               = new Visita();
            $campos               = 'usuario';
            $nombrelista          = 'pa_usuario_acciones';
            $idaccion             = '20';
            $campoordenar         = 'id';
            $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
            $usuarios             = $datosusuarioacciones->fetch();
            $usuariosa            = explode("////",$usuarios[usuario]);
            if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
                $vis = new Visita();
                if(isset($_REQUEST['id'])){
                    $vis = $this->model->Obtener_datos_informe_Remision_visita($_REQUEST['id']);
                }
                require_once 'view/header.php';
                require_once 'view/informes/informe_remision-editar.php';
                require_once 'view/footer.php';
            }else{
                print'<script type="text/javascript">alert("!Acceso denegado para este módulo, verifique la configuración de su perfil con el administrador del sistema...!");location.href="index.php" </script>';
            }
        }
        public function Guardar_Informe_Remision(){
            session_start();
            $_SESSION['nombre'];
            $vis = new Visita();

            $campos               = 'usuario';
            $nombrelista          = 'pa_usuario_acciones';
            $idaccion             = '20';
            $campoordenar         = 'id';
            $datosusuarioacciones = $vis->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
            $usuarios             = $datosusuarioacciones->fetch();
            $usuariosa            = explode("////",$usuarios[usuario]);
            
            $vis->id                    = $_POST['id'];
            $vis->fecha_presentacion    = $_POST['fecha_presentacion'];
            $vis->num_oficio            = $_POST['num_oficio'];
            $vis->num_folios            = $_POST['num_folios'];
            $vis->comentarios           = $_POST['comentarios'];
            $vis->juzgadoSolicitante    = $_POST['juzgadoSolicitante'];
            $vis->contenidoDoc          = $_POST['contenido'];
            
            $this->model->Guardar_Informe_Remision($vis);
            if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
                header('Location: ?c=Visitas&a=Listado_InformesRemision');
            }else{
                header('Location: index.php?c=Visitas&a=IndexVisitasTS');
            }
        }
        public function Enviar_Informe_Remision(){
            $vis = new Visita();

            if(isset($_REQUEST['id'])){
                $vis = $this->model->Enviar_Informe_Remision($_REQUEST['id'],$_REQUEST['fecha_presentacion']);
            }
            header('Location: ?c=Visitas&a=Listado_InformesRemision');
        }
        // HISTORIAL INF. SEGUIMIENTO ADMIN
        public function Historial_Informe_RemisionAll(){
            require_once 'view/header.php';
            require_once 'view/informes/informe_remision_historial.php';
            require_once 'view/footer.php';
        }
        // HISTORIAL INF. REMISIÓN X DESPACHO
        public function Historial_Informe_RemisionD(){
            require_once 'view/header.php';
            require_once 'view/informes/informe_remision_historialDespacho.php';
            require_once 'view/footer.php';
        }
        
        //***************************************************************************//
        // --------------- INFORME VALORACIÓN ---------------------------------------- //
        //***************************************************************************//
        public function Listado_InformesValoracion(){
            require_once 'view/header.php';
            require_once 'view/informes/informes_Listado_Valoracion.php';
            require_once 'view/footer.php';
        }
        public function Registrar_Valoracion(){
            session_start();
            $idperfil = $_SESSION['idperfil'];
            if($idperfil ==22){
                $vis = new Visita();

                if(isset($_REQUEST['id'])){
                    $vis = $this->model->Obtener_datos_Valoracion_visita($_REQUEST['id']);
                }
                require_once 'view/header.php';
                require_once 'view/informes/valoracion-editar.php';
                require_once 'view/footer.php';
            }else{
                print'<script type="text/javascript">alert("!Acceso denegado para este módulo, verifique la configuración de su perfil con el administrador del sistema...!"); location.href="index.php" </script>';
            }
        }
        public function Guardar_valoracion_visita(){
            session_start();
            $_SESSION['nombre'];
            $vis = new Visita();
    
            $vis->id                = $_POST['id'];
            $vis->nombreValoracion  = $_POST['nombreValoracion'];
            $vis->objetivo          = $_POST['objetivo'];
            $vis->res_objetivo      = $_POST['res_objetivo'];
            $vis->oportunamente     = $_POST['oportunamente'];
            $vis->res_oportunamente = $_POST['res_oportunamente'];
            $vis->valoracion        = $_POST['valoracion'];
            $vis->comentarios       = $_POST['comentarios'];
            $vis->bandera           = $_POST['bool_log'];

            if(isset($_REQUEST['id'])){
                $this->model->Guardar_valoracion_visita($vis);
            }
            header('Location: ?c=Visitas&a=Listado_InformesValoracion');
        }
        public function Enviar_Valoracion_Visita(){
            $vis = new Visita();
            if(isset($_REQUEST['id'])){
                $vis = $this->model->Enviar_Informe_Valoracion($_REQUEST['id'],$_REQUEST['fecha_recepcion']);
            }
            header('Location: ?c=Visitas&a=Listado_InformesValoracion');
        }
        public function Historial_Valoracion_VisitaAll(){
            session_start();
            $_SESSION['nombre'];
            $vis = new Visita();
   
            $campos               = 'usuario';
            $nombrelista          = 'pa_usuario_acciones';
            $idaccion             = '20';
            $campoordenar         = 'id';
            $datosusuarioacciones = $vis->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
            $usuarios             = $datosusuarioacciones->fetch();
            $usuariosa            = explode("////",$usuarios[usuario]);
            
            if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
                $vis = $this->model->Valoracion_visita_Vista();
            }
            require_once 'view/header.php';
            require_once 'view/informes/valoracion_visita_historial.php';
            require_once 'view/footer.php';
        }
        public function Historial_Informe_ValoracionD(){
            require_once 'view/header.php';
            require_once 'view/informes/valoracion_visita_historialDespacho.php';
            require_once 'view/footer.php';
        }

        //***************************************************************************** //
        // --------------- TRABAJO SOCIAL --------------------------------------------- //
        // ******************************* ---------------- *************************** //
        public function TSocial(){
            require_once 'view/header.php';
            require_once 'view/TSocial/Tsocial.php';
            require_once 'view/footer.php';
        }
        public function Crud_TSocial(){
            $vis = new Visita();
            if(isset($_REQUEST['id'])){
                $vis = $this->model->Obtener_TSocial($_REQUEST['id']);
            }
            require_once 'view/header.php';
            require_once 'view/TSocial/Tsocial-editar.php';
            require_once 'view/footer.php';
        }
        public function Guardar_TSocial(){
            $vis = new Visita();
            $vis->id            = $_POST['id'];
            $vis->id_userTS     = $_POST['id_userTS'];
            $vis->nombreTS      = $_POST['nombreTS'];
            $vis->contadorTS    = $_POST['contadorTS'];
            $vis->estadoTS      = $_POST['estadoTS'];

            $vis->id > 0 
                ? $this->model->Actualizar_TSocial($vis)
                : $this->model->Registrar_TSocial($vis);

            header('Location: ?c=Visitas&a=TSocial');
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
        //*****************************************************************************//
        public function estadistica_Contador_VisitasTS(){
            require_once 'view/header.php';
            require_once 'view/estadistica/estadistica_consultar_visitasTS.php';
            require_once 'view/footer.php';
            
        }
//        public function estadisticaGraficaVisitasTS(){
//            require_once 'view/header.php';
//            require_once 'view/estadistica/estadistica_graficarVisitasTS.php';
//            require_once 'view/footer.php';
//        }
        public function estadistica_Excel_ContadorVisitasTS(){
            session_start();
            if($_SESSION['idUsuario'] !=""){
                date_default_timezone_set('America/Bogota');
                $fecha_doc=date('Y-m-d');
                header("Content-type: application/vnd.ms-excel");
                header("Content-Disposition: attachment; filename=Reporte_Cantidadvisitas_".$fecha_doc.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");    
                require_once 'view/estadistica/estadistica-excel_ContadorVisitasTS.php';
            }else{
                header("refresh: 0; URL=/centro_servicios2/");
            }
        }
        
        public function estadistica_Contador_VisitasDespacho(){
            require_once 'view/header.php';
            require_once 'view/estadistica/estadistica_consultar_visitasDespacho.php';
            require_once 'view/footer.php';
        }
        public function estadistica_Excel_ContadorVisitasDespacho(){
            session_start();
            if($_SESSION['idUsuario'] !=""){
                date_default_timezone_set('America/Bogota');
                $fecha_doc=date('Y-m-d');
                header("Content-type: application/vnd.ms-excel");
                header("Content-Disposition: attachment; filename=Reporte_Cantidadvisitas_Despachos_".$fecha_doc.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");    
                require_once 'view/estadistica/estadistica-excel_ContadorVisitasDespachos.php';
            }else{
                header("refresh: 0; URL=/centro_servicios2/");
            }
        }
        public function videoTutorial(){
            require_once 'view/ayuda/video_tutorial.php';
            require_once 'view/footer.php';
        }
    }