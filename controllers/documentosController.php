<?php

class documentosController extends controllerBase{
/*---------- Mensajes -------------*/

	public function mensajes(){

		if($_SESSION['id']!=""){

			require 'models/documentosModel.php';

			$ls = new documentosModel();

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

			require 'models/documentosModel.php';
		
			$this->view->show("documentos_listar.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");
		}

	}
	
	public function RecargarTabla(){

		if($_SESSION['id']!=""){

			require 'models/documentosModel.php';
		
			$model  = new documentosModel();
			
			$campos               = 'usuario';
			$nombrelista          = 'pa_usuario_acciones';
			$idaccion			  = '10';
			$campoordenar         = 'id';
			$datosusuarioacciones = $model->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
			$usuarios             = $datosusuarioacciones->fetch();
			$usuariosa			  = explode("////",$usuarios[usuario]);
		
			
			if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
				
				//LISTA TODOS LOS DOCUMENTOS (SI ESTE USUARIO TIENE PERMISO EN LA TABLA pa_usuario_acciones)
				$filtro = $model->get_documentos_salientes_usuario(1,1);
			}
			else{
				//LISTA SOLO LOS DOCUMENTOS DEL USUARIO EN SESION
				$filtro = $model->get_documentos_salientes_usuario(1,0);
			}
		
			//$filtro = $model->get_documentos_salientes_usuario(1);
	
			$data['datosdocumentossalientes'] = $filtro;
		
			//$this->view->show("sigdoc_documentos_salientes.php", $data);
			
			$this->view->show("documentos_listar.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");
		}

	}
	
	public function FiltroTabla(){

		if($_SESSION['id']!=""){

			require 'models/documentosModel.php';
		
			$model  = new documentosModel();
			
			
			$campos               = 'usuario';
			$nombrelista          = 'pa_usuario_acciones';
			$idaccion			  = '10';
			$campoordenar         = 'id';
			$datosusuarioacciones = $model->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
			$usuarios             = $datosusuarioacciones->fetch();
			$usuariosa			  = explode("////",$usuarios[usuario]);
		
			
			if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
				
				//LISTA TODOS LOS DOCUMENTOS (SI ESTE USUARIO TIENE PERMISO EN LA TABLA pa_usuario_acciones)
				$filtro = $model->get_documentos_salientes_usuario(2,1);
			}
			else{
				//LISTA SOLO LOS DOCUMENTOS DEL USUARIO EN SESION
				$filtro = $model->get_documentos_salientes_usuario(2,0);
			}
		
			//$filtro = $model->get_documentos_salientes_usuario(2);
	
			$data['datosdocumentossalientes'] = $filtro;
		
			$this->view->show("documentos_listar.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");
		}

	}
	
	public function GenerarDocumentoSaliente(){
	

		if($_SESSION['id']!=""){
		
			
			require 'models/documentoswordModel.php';
		
		}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");

	  	}

	}
	public function GenerarDocumentoEstadistica(){
	
		if($_SESSION['id']!=""){
		
			
			require 'models/documentosexcelModel.php';
		
		}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");

	  	}

	}
	//Juan Esteban Múnera Betancur
	public function Registro_Documentos(){
	
	
			if($_SESSION['id']!=""){
		
					require 'models/documentosModel.php';

					$modelo = new documentosModel();
					
					$radicado_consultado         = trim($_POST['radicadoconsultado']);
					$data['radicado_consultado'] = $radicado_consultado;
					
					if($_POST){
					 
						$modelo->registrar_documentos();
		
					}
		
					$this->view->show("documentos_generar.php", $data);
				
				
			}
			else{
				header("refresh: 0; URL=/centro_servicios2/");

			}	
		
	}
	
	public function Registro_Documentos_Especiales(){
	
	
			if($_SESSION['id']!=""){
		
					require 'models/documentosModel.php';

					$modelo = new documentosModel();
					
					if($_GET){
					 
						$modelo->registrar_documentos_especiales();
		
					}
		
					$this->view->show("documentos_listar.php", $data);
				
				
			}
			else{
				header("refresh: 0; URL=/centro_servicios2/");

			}	
		
	}
	
	public function Registro_Documentos_Especiales_2(){
	
	
			if($_SESSION['id']!=""){
		
					require 'models/documentosModel.php';

					$modelo = new documentosModel();
					
					if($_GET){
					 
						$modelo->registrar_documentos_especiales_2();
		
					}
		
					$this->view->show("documentos_listar.php", $data);
				
				
			}
			else{
				header("refresh: 0; URL=/centro_servicios2/");

			}	
		
	}
	
	public function Registro_Documentos_Especiales_3(){
	
	
			if($_SESSION['id']!=""){
		
					require 'models/documentosModel.php';

					$modelo = new documentosModel();
					
					if($_GET){
					 
						$modelo->registrar_documentos_especiales_3();
		
					}
		
					$this->view->show("documentos_listar.php", $data);
				
				
			}
			else{
				header("refresh: 0; URL=/centro_servicios2/");

			}	
		
	}
	
	public function Registro_Documentos_Especiales_4(){
	
		if($_SESSION['id']!=""){
		
			require 'models/documentosModel.php';

			$modelo = new documentosModel();
					
			if($_POST){
					 
				$modelo->registrar_documentos_especiales_4();
		
			}
		
			$this->view->show("documentos_listar.php", $data);
				
				
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

			require 'models/documentosModel.php';
		
			$modelo  = new documentosModel();
			
			//RECIBE DATOS FORMA $_GET CUANDO SE DA CLIC EN EL BOTON EDITAR DOCUMENTO DE LA VISTA
			//documentos_modificar.php
			if($_GET){
			
				$filtro = $modelo->get_datos_documentos();
				$data['datosdocumento'] = $filtro;
			}
			
			//RECIBE DATOS FORMA $_POST CUANDO SE DA CLIC EN EL BOTON ACTUALIZAR DE LA VISTA
			//documentos_modificar.php
			if($_POST){
			
				$modelo->modificar_documentos();
			}
			
		
			//$data['datosdocumento'] = $filtro;
		
			$this->view->show("documentos_modificar.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");
		}
	
	}

	//*********************************************************************************************************************************************
					                                        //FUNCIONES PARA ACTIVAR DIRECCIONES DE PARTES EN UN PROCESO
	//*********************************************************************************************************************************************
	
	public function Activar_Direcion_Parte(){
	
		if($_SESSION['id']!=""){
		
			require 'models/documentosModel.php';
		
			$modelo  = new documentosModel();
			
			$radicado_consultado         = trim($_POST['radicadod']);
			$data['radicado_consultado'] = $radicado_consultado;
					
			if($_POST){
					 
				$modelo->activar_direcion_parte();
		
			}
		
			$this->view->show("documentos_generar.php", $data);
				
				
		}
		else{
			header("refresh: 0; URL=/centro_servicios2/");

		}	
	
	}
	
	//--------------------------------------------------------------------------------------------------------
	
	
	
}//FIN CLASE

?>