<?php
    class migracionController extends controllerBase{
        /*---------- Mensajes -------------*/
        public function mensajes(){
            if($_SESSION['id']!=""){
                require 'models/migracionModel.php';
		$ls = new migracionModel();
		$ls->mensajes();
            }else{
                header("refresh: 0; URL=/centro_servicios2/");
            }
	}
        /*------------- Migración -------------------*/
	public function migracion(){
            session_start();
            if($_SESSION['id']!=""){
                require 'models/migracionModel.php';		
                $modelo               = new migracionModel();
                $campos               = 'usuario';
                $nombrelista          = 'pa_usuario_acciones';
                $idaccion             = '22';
                $campoordenar         = 'id';
                $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
                $usuarios             = $datosusuarioacciones->fetch();
                $usuariosa            = explode("////",$usuarios[usuario]);
                if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
                    $ln = new migracionModel();
                    $lj = new migracionModel();
                    $lm = new migracionModel();

                    //JUAN ESTEBAN MÙNERA BETANCUR
                    if($_SESSION['especialidad'] == 'CIVIL FAMILIA'){
                        $rs3 = $lj->consultar_despachos_CSCF();
                    }
                    $data['datos_despachos'] = $rs3;
                    $this->view->show("migracion.php", $data);
                }else{
                    print'<script languaje="Javascript">alert("Acceso denegado para este m\xf3dulo, verifique la configuraci\xf3n de su perfil con el administrador del sistema...!"); location.href="/centro_servicios2/"</script>';
                }
            }else{
                header("refresh: 0; URL=/centro_servicios2/");
            }
	}
        /*------------- Migración -------------------*/
	public function migracion1(){
            if($_SESSION['id']!=""){
                require 'models/migracionModel.php';		
                $ln = new migracionModel();
                $lj = new migracionModel();
                $lm = new migracionModel();
                $lc = new migracionModel();
               
                //JUAN ESTEBAN MÙNERA BETANCUR
                if($_SESSION['especialidad'] == 'CIVIL FAMILIA'){
                    $rs3 = $lj->consultar_despachos_CSCF();
                }		
                $rs4= $lm->consultarjusticia();
                $data['datos_despachos']=$rs3;	
                if($_POST){
                    $lc->migrarSaidoj();
                }
                $data['datos_justicia']=$rs4;
		$this->view->show("migracion.php", $data);
            }else{
                header("refresh: 0; URL=/centro_servicios2/");
            }
        }		
        /*------------- Migración -------------------*/
	public function migracion_inc(){
            session_start();
            if($_SESSION['id']!=""){
                require 'models/migracionModel.php';		
                $modelo               = new migracionModel();
                $campos               = 'usuario';
                $nombrelista          = 'pa_usuario_acciones';
                $idaccion             = '22';
                $campoordenar         = 'id';
                $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
                $usuarios             = $datosusuarioacciones->fetch();
                $usuariosa            = explode("////",$usuarios[usuario]);
                if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {		
                    $lj = new migracionModel();

                    //JUAN ESTEBAN MÙNERA BETANCUR
                    if($_SESSION['especialidad'] == 'CIVIL FAMILIA'){
                        $rs3 = $lj->consultar_despachos_CSCF();
                    }
                    $data['datos_despachos']=$rs3;
                    $this->view->show("inconsistencias.php", $data);
                }else{
                    print'<script languaje="Javascript">alert("Acceso denegado para este m\xf3dulo, verifique la configuraci\xf3n de su perfil con el administrador del sistema...!"); location.href="/centro_servicios2/"</script>';
                }
            }else{
                header("refresh: 0; URL=/centro_servicios2/");
            }
        }
        /*------------- Migración -------------------*/
	public function migracion_inc1(){
            if($_SESSION['id']!=""){
                require 'models/migracionModel.php';		
                $ln = new migracionModel();
                $lj = new migracionModel();
                $lm = new migracionModel();
                $lc = new migracionModel();
                //JUAN ESTEBAN MÙNERA BETANCUR
                if($_SESSION['especialidad'] == 'CIVIL FAMILIA'){
                    $rs3= $lj->consultar_despachos_CSCF();
                }
                $data['datos_despachos']=$rs3;
                $rs4= $lm->consultarjusticia_inconsistencias();	
                if($_POST){
                    $lc->actualizarJusticia();
                }
                //$data['datos_saidoj']=$rs1;
                $data['datos_justicia']=$rs4;
		$this->view->show("inconsistencias.php", $data);
            }else{
                header("refresh: 0; URL=/centro_servicios2/");
            }
        }
        /*------------- Migración -------------------*/
        public function excel_consulta(){
            session_start();
            if($_SESSION['id']!=""){
                require 'models/migracionModel.php';		
                $modelo               = new migracionModel();
                $campos               = 'usuario';
                $nombrelista          = 'pa_usuario_acciones';
                $idaccion             = '22';
                $campoordenar         = 'id';
                $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
                $usuarios             = $datosusuarioacciones->fetch();
                $usuariosa            = explode("////",$usuarios[usuario]);
                if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {	
                    $lj = new migracionModel();	
                    if($_GET){
                        require 'models/excelModel.php';
                    }
                    $this->view->show("Consulta_Saidoj_EXCEL.php", $data);
                }else{
                    print'<script languaje="Javascript">alert("Acceso denegado para este m\xf3dulo, verifique la configuraci\xf3n de su perfil con el administrador del sistema...!"); location.href="/centro_servicios2/"</script>';
                }
            }else{
                header("refresh: 0; URL=/centro_servicios2/");
            }
	    }
    }
?>