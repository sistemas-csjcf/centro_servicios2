<?php

class sigdocController extends controllerBase{
/*---------- Mensajes -------------*/

	public function mensajes(){

		if($_SESSION['id']!=""){

			require 'models/sigdocModel.php';

			$ls = new sigdocModel();

			$ls->mensajes();

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");

	  	}

	}
	
	public function listar_fecha_actual(){
	

		if($_SESSION['id']!=""){

			require 'models/sigdocModel.php';
			
			$lu = new sigdocModel();
			
			$rs1=$lu->fecha_actual();
			
			
			$data['dato_fecha_actual']=$rs1;
			
			$this->view->show("sigdoc_documentos_salientes.php", $data);

		}
		else{

			header("refresh: 0; URL=/centro_servicios2/");
		}



	}
	
	public function Listar_Documentos_Salientes(){

		if($_SESSION['id']!=""){

			require 'models/sigdocModel.php';
		
			/*$model  = new sigdocModel();
		
			$filtro = $model->get_documentos_salientes_usuario(2);
	
			$data['datosdocumentossalientes'] = $filtro;*/
		
			$this->view->show("sigdoc_listar_documentos_salientes.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");
		}

	}

	public function Registro_Documentos_Salientes(){
	
	
		if($_SESSION['id']!=""){
		
				$i = 0 ;
				$tienepermiso = 0;
				$nombremodulo = "sigdoc";
				
				require 'models/menuModel.php';
				
				$model        = new menuModel();
				$datosusuario = $model->get_permiso_usuario();
				$fielddatos   = $datosusuario->fetch();
				$nivel        = trim($fielddatos['idperfil']);
				$modulo       = trim($fielddatos['modulos']);
				
				//NUEVA FORMA DE PREGUNTAR SI UN USUARIO ES ADMINISTRADOR
				//SE REALIZA PARA QUE SE VISUALIZE EN LA VISTA m_admin.php
				//SU PERFIL, DE ESTA FORMA if($nivel == 1){ TAMBIEN FUNCIONA
				//PERO SIEMPRE SE VISUALIZA ADMINISTRDOR
				$usuarioaadministradores = $model->get_usuario_acciones();
				$fielddatos_2            = $usuarioaadministradores->fetch();
				$nivel_2                 = trim($fielddatos_2['usuario']);
				$modulost2			     = explode("////",$nivel_2);
				
				if ( in_array($_SESSION['idUsuario'],$modulost2) ){
				
				//Administrador
				//if($nivel == 1){
				
					require 'models/sigdocModel.php';

					$modelo = new sigdocModel();
					
					if($_POST){
					 
						$modelo->registrar_documentos_salientes();
		
					}
		
					$this->view->show("sigdoc_documentos_salientes.php", $data);
				}
				else{
					
					$modulos_usuario = explode("////",trim($modulo));
					
					$longitud_modulos = count($modulos_usuario);
					
					while($i < $longitud_modulos){
		
						if( $nombremodulo == $modulos_usuario[$i] ){
		
							$tienepermiso = 1;
							$i = $longitud_modulos;
						}
		
						$i = $i+1;
		
					}
					
					if($tienepermiso == 1){
		
						require 'models/sigdocModel.php';

						$modelo = new sigdocModel();
						
						if($_POST){
						 
							$modelo->registrar_documentos_salientes();
			
						}
			
						$this->view->show("sigdoc_documentos_salientes.php", $data);
					}
					else{
						print'<script languaje="Javascript">alert("¡Acceso denegado para este módulo, verifique la configuración de su perfil con el administrador del sistema...!"); location.href="index.php?controller=index&action=ruta_base"</script>';
						/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mensajes&idmensaje=1"</script>';*/
					}
					
					
				}
				
				
			}
			else{
				header("refresh: 0; URL=/centro_servicios2/");

			}	
		
		
		
		
		/*if($_SESSION['id']!=""){

	  

			require 'models/sigdocModel.php';

			$modelo = new sigdocModel();
			
			if($_POST){
			 
			 	$modelo->registrar_documentos_salientes();

			}

			$this->view->show("sigdoc_documentos_salientes.php", $data);

		}
	
		else{
	
			header("refresh: 0; URL=/centro_servicios2/");
	
		}*/

	}
	
	public function Traer_Consecutivo(){
	

		if($_SESSION['id']!=""){
		
			require 'models/sigdocModel.php';
			
			$modelo = new sigdocModel();
			
			$filtro = trim($_POST['filtro']);
			
			$datos  = $modelo->get_Consecutivo($filtro);
			
			echo $datos;
			
			
			//echo $consecutivo;
			
			//$data['consecutivo'] = $consecutivo;
			
			//$this->view->show("sigdoc_documentos_salientes.php", $data);

		}
		else{

			header("refresh: 0; URL=/centro_servicios2/");
		}



	}
	
	
	public function FiltroTabla(){

		if($_SESSION['id']!=""){

			require 'models/sigdocModel.php';
		
			$model  = new sigdocModel();
		
			$filtro = $model->get_documentos_salientes_usuario(2);
	
			$data['datosdocumentossalientes'] = $filtro;
		
			$this->view->show("sigdoc_listar_documentos_salientes.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");
		}

	}
	
	public function RecargarTabla(){

		if($_SESSION['id']!=""){

			require 'models/sigdocModel.php';
		
			$model  = new sigdocModel();
		
			$filtro = $model->get_documentos_salientes_usuario(1);
	
			$data['datosdocumentossalientes'] = $filtro;
		
			//$this->view->show("sigdoc_documentos_salientes.php", $data);
			
			$this->view->show("sigdoc_listar_documentos_salientes.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");
		}

	}
	
	public function GenerarDocumentoSaliente(){
	

		if($_SESSION['id']!=""){
		
			
			require 'models/wordModel.php';
		
		}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");

	  	}

	}
	
	public function Editar_documento_Saliente(){
	
		//NOTA:ESTO SE MANEJA ASI PARA NO CREAR OTRA VISTA Y OPTIMIZAR ESTE PROCESO
		//DE CREAR UNA VISTA PARA ACTUALIZAR UN DOCUMENTO, SI NO QUE SE HAGA EN EL MISMO FORMULARIO DE REGISTRO
		//VISTA sigdoc_documentos_salientes.php
	
		if($_SESSION['id']!=""){

			require 'models/sigdocModel.php';
		
			$modelo  = new sigdocModel();
			
			//RECIBE DATOS FORMA $_GET CUANDO SE DA CLIC EN EL BOTON EDITAR DOCUMENTO DE LA VISTA
			//sigdoc_listar_documentos_salientes.php
			if($_GET){
			
				$filtro = $modelo->get_datos_documentos();
				$data['datosdocumento'] = $filtro;
			}
			//RECIBE DATOS FORMA $_POST CUANDO SE DA CLIC EN EL BOTON ACTUALIZAR DE LA VISTA
			//sigdoc_documentos_salientes.php
			if($_POST){
			
				$modelo->registrar_documentos_salientes();
			}
			
		
			//$data['datosdocumento'] = $filtro;
		
			$this->view->show("sigdoc_documentos_salientes.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");
		}
	
	}
	
	//***************************************************************************************************************
	//PARA DOCUMENTOS ENTRANTES
	
	public function Listar_Documentos_Entrantes(){

		if($_SESSION['id']!=""){

			require 'models/sigdocModel.php';
		
			/*$model  = new sigdocModel();
		
			$filtro = $model->get_documentos_salientes_usuario(2);
	
			$data['datosdocumentossalientes'] = $filtro;*/
		
			$this->view->show("sigdoc_listar_documentos_entrantes.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");
		}

	}
	
	public function FiltroTablaEntrantes(){

		if($_SESSION['id']!=""){

			require 'models/sigdocModel.php';
		
			$model  = new sigdocModel();
		
			$filtro = $model->get_documentos_entrantes_usuario(2);
	
			$data['datosdocumentosentrantes'] = $filtro;
		
			$this->view->show("sigdoc_listar_documentos_entrantes.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");
		}

	}
	
	public function RecargarTablaEntrantes(){

		if($_SESSION['id']!=""){

			require 'models/sigdocModel.php';
		
			$model  = new sigdocModel();
		
			$filtro = $model->get_documentos_entrantes_usuario(1);
	
			$data['datosdocumentosentrantes'] = $filtro;
		
			$this->view->show("sigdoc_listar_documentos_entrantes.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");
		}

	}
	
	public function Registro_Documentos_Entrantes(){
	
	
		if($_SESSION['id']!=""){
		
			require 'models/sigdocModel.php';

			$modelo = new sigdocModel();
					
			if($_POST){
					 
				$modelo->registrar_documentos_entrantes();
		
			}
		
			$this->view->show("sigdoc_documentos_entrantes.php", $data);
				
				
		}
		else{
			header("refresh: 0; URL=/centro_servicios2/");

		}	
	

	}
	public function Editar_documento_Entrante(){
	
		
	
		if($_SESSION['id']!=""){

			require 'models/sigdocModel.php';
		
			$modelo  = new sigdocModel();
			
			
			if($_GET){
			
				$filtro = $modelo->get_datos_documentos_entrantes();
				$data['datosdocumento'] = $filtro;
			}
			
			if($_POST){
			
				$modelo->registrar_documentos_entrantes();
			}
			
		
			//$data['datosdocumento'] = $filtro;
		
			$this->view->show("sigdoc_documentos_entrantes.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");
		}
	
	}
	
	public function Respuesta_documento_Entrante(){
	
		
		if($_SESSION['id']!=""){

			require 'models/sigdocModel.php';
		
			$modelo  = new sigdocModel();
			
			
			if($_GET){
			
				$datoid = trim($_GET[idrespuesta]);
				$data['idrespuesta'] = $datoid;
			}
			
			if($_POST){
			
				$modelo->registrar_respuesta_documento();
			}
			
		
			//$data['datosdocumento'] = $filtro;
		
			$this->view->show("sigdoc_documentos_salientes.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");
		}
	
	}
	//--------------------------------------------------------------------------------------------------------
	
	
	
}//FIN CLASE

?>