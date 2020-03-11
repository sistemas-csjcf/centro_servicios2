<?php
    class menuController extends controllerBase{
        /***********************************************************************************/
	/*---------------------------------  Menu Usuarios --------------------------------*/
	/***********************************************************************************/
	public function menu_user(){
            if($_SESSION['id']!=""){
		require 'models/menuModel.php';
		require 'models/userModel.php';
		$ls = new userModel();
		$rs2=  $ls->obtFoto();
		$data['foto'] = $rs2;
		
		$this->view->show("menuppal.php",$data);
            }else{
		header("refresh: 0; URL=/centro_servicios2/");
            }		
	}
	/***********************************************************************************/
	/*---------------------------------  Modulo archivo ------------------------------*/
	/***********************************************************************************/	
	public function mod_archivo(){
            if($_SESSION['id']!=""){
		require 'models/archivoModel.php';	
		$ls = new archivoModel();
		$rs1 = $ls->listarLogArchivo();
		$data['datos_log'] = $rs1;
		$this->view->show("mod_archivo.php",$data);
            }else{
		header("refresh: 0; URL=/centro_servicios2/");
            }	
	}
	/***********************************************************************************/
	/*---------------------------------  Modulo Correspondencia ------------------------------*/
	/***********************************************************************************/	
	public function mod_correspondencia(){
            if($_SESSION['id']!=""){
		require 'models/correspondenciaModel.php';	
		$ls = new correspondenciaModel();
		$rs1 = $ls->listarLogCorrespondencia();
		$data['datos_log'] = $rs1;
		$this->view->show("mod_correspondencia.php",$data);
            }else{
		header("refresh: 0; URL=/centro_servicios2/");
            }	
	}
	/***********************************************************************************/
	/*------------------------------  Modulo Configuracion ----------------------------*/
	/***********************************************************************************/	
	public function mod_configuracion(){
            if($_SESSION['id']!=""){
		require 'models/userModel.php';
		$ls = new userModel();
		$rs1 = $ls->listUser();
		//$rs2=  $ls->obtFoto();
		//$rs3 = $ls->tipoUser();
		$data['listdata'] = $rs1;
		$data['foto'] = $rs2;
		//$data['tipousuario'] = $rs3;
		$this->view->show("mod_configuracion.php", $data);
            }else{
		header("refresh: 0; URL=/centro_servicios2/");
            }
	}
	/***********************************************************************************/
	/*---------------------------------  Modulo calendario ------------------------------*/
	/***********************************************************************************/	
	public function mod_calendarioeventos(){
            if($_SESSION['id']!=""){
		require 'models/calendarioModel.php';	
		$ls = new calendarioModel();
		$this->view->show("mod_calendarioeventos.php",$data);
            }else{
		header("refresh: 0; URL=/centro_servicios2/");
            }	
	}
    }
?>