<?php
    require_once 'model/visita_model.php';
    header('Content-Type: text/html; charset=UTF-8'); 
    class VisitasController{
        private $model;
        public function __CONSTRUCT(){
            $this->model = new Visita();
        }
        public function Index(){
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
                require_once 'view/header.php';
                require_once 'view/visitas/visitas.php';
                require_once 'view/footer.php';
            }else{
                require_once 'view/header.php';
                require_once 'view/footer.php';
            }    
        }
        public function Crud(){
//            session_start();
            $vis = new Visita();
//            $idPerfil   = $_SESSION['idperfil'];
//            if($idPerfil ==22){
                if(isset($_REQUEST['id'])){
                    $vis = $this->model->Obtener($_REQUEST['id']);
                }
                require_once 'view/header.php';
                require_once 'view/visitas/visitas-editar.php';
                require_once 'view/footer.php';
//            }else{
//                print'<script languaje="Javascript">alert("!Acceso denegado para este módulo, verifique la configuración de su perfil con el administrador del sistema...!"); location.href="index.php"</script>';
//            }
        }
        public function Crud_com(){
            $vis = new Visita();
            if(isset($_REQUEST['id'])){
                $vis = $this->model->Obtener($_REQUEST['id']);
            }
            require_once 'view/header.php';
            require_once 'view/visitas/visita_Comisoria-editar.php';
            require_once 'view/footer.php';
        }
        public function Guardar(){
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
            
            $vis->id                = $_POST['id'];
            $vis->radicado          = $_POST['radicado'];
            $vis->comentarios       = $_POST['comentarios'];
            $vis->fecha_visita      = $_POST['fecha_visita'];
            $vis->fecha_audiencia   = $_POST['fecha_audiencia'];
            $vis->comentarios       = $_POST['comentarios'];
            $vis->solicitante       = $_POST['solicitante'];
            $vis->clase_proceso     = $_POST['clase_proceso'];
            $vis->sub_clase         = $_POST['sub_clase'];
            $vis->datos_partes      = $_POST['datos_partes'];
            $vis->id_TSocial        = $_POST['idTsocial'];
            $vis->contadorTS        = $_POST['contador_TS'];
            $vis->id_usuario        = $_POST['id_usuarioR'];
            $vis->estado            = "Pendiente";
            $vis->finalizada        = '0';
            $vis->bandera           = $_POST['bandera'];

            if($vis->bandera > 0){
                $vis->id > 0 
                    ? $this->model->Actualizar($vis)
                    : $this->model->Registrar($vis);
                if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
                    header('Location: index.php');
                }else{
                    header('Location: index.php?c=Visitas&a=H_Visitas');
                }
            }else{
                if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
                    print'<script languaje="Javascript">alert("Error, la Solicitud de Visita no pudo ser registrada, por favor intente nuevamente"); location.href="index.php"</script>';
                }else {
                    print'<script languaje="Javascript">alert("Error, la Solicitud de Visita no pudo ser registrada, por favor intente nuevamente"); location.href="index.php?c=Visitas&a=H_Visitas"</script>';
                }
            }
        }

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
        public function Impreso(){
            if(isset($_REQUEST['data-id'])){
                $this->model->Informe_Impreso($_REQUEST['data-id'], $_REQUEST['data-us']) ;
                header('Location: index.php?c=Visitas&a=Historial_Informe_RemisionD');
            }
        }
		public function H_Visitas_Despacho(){
            require_once 'view/header.php';
            require_once 'view/visitas/visitas_historial.php';
            require_once 'view/footer.php';
        }
        public function H_Visitas(){
            require_once 'view/header.php';
            require_once 'view/visitas/visitas_historialCS.php';
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
            $vis->num_visitas   = $_POST['num_visitasRealizadas'];
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
                $formato = date('Ymdhis') . '-' .strtolower(utf8_decode($_FILES['vis_inf_ruta_formato']['name']));
				//$formato = date('Y-m-d h:i s') . '-' . substr( strtolower( str_replace(' ','_' , $_FILES['vis_inf_ruta_formato']['name'] ) ),0 , 8);
                move_uploaded_file ($_FILES['vis_inf_ruta_formato']['tmp_name'], 'uploads_informes/Informes_Seguimiento/'.$nom .'/'. $formato);
                $vis->vis_inf_ruta_formato = utf8_encode($formato);
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
        //Generar archivo excel del historial de valoración de visitas.
        // JUAN ESTEBAN MÚNERA BETANCUR 2018-01-24
        public function estadistica_Excel_Visitas_Valoracion(){
            session_start();
            if($_SESSION['idUsuario'] !=""){
                date_default_timezone_set('America/Bogota');
                $fecha_doc=date('Y-m-d');
                header("Content-type: application/vnd.ms-excel");
                header("Content-Disposition: attachment; filename=Reporte_Historial_valoracion_Visitas_".$fecha_doc.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");
                require_once 'view/estadistica/estadistica-excel_Historial_Visitas_Valoracion.php';
            }else{
                header("refresh: 0; URL=/centro_servicios2/");
            }
        }
		public function videoTutorial(){
			require_once 'view/ayuda/video_tutorial.php';
			require_once 'view/footer.php';
		}
		public function Generar_Comprobante(){
			require_once 'view/visitas/visitas_comprobante.php';
		}
		public function natalia(){
             session_start();
            if($_SESSION['idUsuario'] !=""){
                date_default_timezone_set('America/Bogota');
                $fecha_doc=date('Y-m-d');
                header("Content-type: application/vnd.ms-excel");
                header("Content-Disposition: attachment; filename=Reporte_Historial_Valoracion_Visitas_".$fecha_doc.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");    
                require_once 'view/estadistica/estadistica-excel_Historial_Visitas_ValoracionCompleta.php';
            }else{
                header("refresh: 0; URL=/centro_servicios2/");
            }
        }
        public function Visitas_Pendientes_allTS(){
             session_start();
            if($_SESSION['idUsuario'] !=""){
                date_default_timezone_set('America/Bogota');
                $fecha_doc=date('Y-m-d');
                header("Content-type: application/vnd.ms-excel");
                header("Content-Disposition: attachment; filename=Reporte_Visitas_PendientesTS_".$fecha_doc.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");    
                require_once 'view/estadistica/estadistica-excel_visitasPendientesTS.php';
            }else{
                header("refresh: 0; URL=/centro_servicios2/");
            }
        }
        public function excel_all_solicitudes_visitas(){
             session_start();
            if($_SESSION['idUsuario'] !=""){
                date_default_timezone_set('America/Bogota');
                $fecha_doc=date('Y-m-d');
                header("Content-type: application/vnd.ms-excel");
                header("Content-Disposition: attachment; filename=Reporte_Total_Visitas_".$fecha_doc.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");    
                require_once 'view/estadistica/estadistica-excel_all_solicitud_VisitasCompleta.php';
            }else{
                header("refresh: 0; URL=/centro_servicios2/");
            }
        }
    }