<?php
require_once 'model/encuesta_model.php';

class EncuestaController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Encuesta();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/encuesta/encuestas.php';
        require_once 'view/footer.php';
    }
    
    public function Crud_encuesta(){
        $enc = new Encuesta();
        
        if(isset($_REQUEST['id'])){
            $enc = $this->model->Obtener($_REQUEST['id']);
        }
        
        require_once 'view/header.php';
        require_once 'view/encuesta/encuesta-editar.php';
        require_once 'view/footer.php';
    }
    
    public function Guardar_Encuesta(){
        $enc = new Encuesta();
        
        $enc->id = $_REQUEST['id'];
        $enc->id_usuarioR = $_REQUEST['id_usuarioR'];
        $enc->bandera = $_REQUEST['bandera'];
        $enc->id_encuestado = $_REQUEST['id_encuestado'];
        $enc->cedula = $_REQUEST['cedula'];
        $enc->nombre = $_REQUEST['nombre'];
        $enc->calificacion1 = $_REQUEST['calificacion1'];
		$enc->calificacion2 = $_REQUEST['calificacion2'];
		$enc->calificacion3 = $_REQUEST['calificacion3'];
        $enc->observaciones = $_REQUEST['observaciones'];

        $enc->id > 0 
            ? $this->model->Actualizar($enc)
            : $this->model->Registrar($enc);
        
        header('Location: index.php?c=encuesta&a=Crud_encuesta');
    }
    // Generar archivo excel todas las encuestas.
    //JUAN ESTEBAN MUNERA BETANCUR 2018-07-13
    public function Excel_ALLencuestas(){
        session_start();
        if($_SESSION['idUsuario'] !=""){
            date_default_timezone_set('America/Bogota');
            $fecha_doc=date('Y-m-d');
            header("Content-type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=Reporte_Historial_encuestas_".$fecha_doc.".xls");
            header("Pragma: no-cache");
            header("Expires: 0");    
            require_once 'view/encuesta/excel/estadistica-excel_Historial_ALL_encuestas.php';
        }else{
            header("refresh: 0; URL=/centro_servicios2/");
        }
    }
    public function Estadistica_encuestaXempleado() {
        require_once 'view/header.php';
        require_once 'view/estadistica/estadistica_encuesta_empleado.php';
        require_once 'view/footer.php';
    }
    
    public function estadistica_Excel_EncuestaUS(){
        session_start();
        if($_SESSION['idUsuario'] !=""){
            date_default_timezone_set('America/Bogota');
            $fecha_doc=date('Y-m-d');
            header("Content-type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=Reporte_encuestasEmpleado_".$fecha_doc.".xls");
            header("Pragma: no-cache");
            header("Expires: 0");    
            require_once 'view/encuesta/excel/estadistica-excel_encuestasUS.php';
        }else{
            header("refresh: 0; URL=/centro_servicios2/");
        }
    }
    public function Estadistica_encuestaXcalificacion() {
        require_once 'view/header.php';
        require_once 'view/estadistica/estadistica_encuesta_calificacion.php';
        require_once 'view/footer.php';
    }
    public function estadistica_Excel_EncuestaCalif(){
        session_start();
        if($_SESSION['idUsuario'] !=""){
            date_default_timezone_set('America/Bogota');
            $fecha_doc=date('Y-m-d');
            header("Content-type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=Reporte_encuestasCalificacion_".$fecha_doc.".xls");
            header("Pragma: no-cache");
            header("Expires: 0");    
            require_once 'view/encuesta/excel/estadistica-excel_encuestasCalif.php';
        }else{
            header("refresh: 0; URL=/centro_servicios2/");
        }
    }
}