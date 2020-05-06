<?php

class sidojuController extends controllerBase{
/*---------- Mensajes -------------*/

	public function mensajes(){

		if($_SESSION['id']!=""){

			require 'models/sidojuModel.php';

			$ls = new sidojuModel();

			$ls->mensajes();

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");

	  	}

	}
	
	public function listar_fecha_actual(){
	

		if($_SESSION['id']!=""){

			require 'models/sigdocModel.php';
			
			$lu = new sidojuModel();
			
			$rs1=$lu->fecha_actual();
			
			
			$data['dato_fecha_actual']=$rs1;
			
			$this->view->show("sigdoc_documentos_salientes.php", $data);

		}
		else{

			header("refresh: 0; URL=/centro_servicios2/");
		}



	}
	
	public function Verificar_Documentos_Entrantes_Juzgados(){

		if($_SESSION['id']!=""){

			require 'models/sidojuModel.php';
		
			$this->view->show("sidoju_verificar_documentos_entrantes_juzgados.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");
		}

	}
	
	public function Imprimir_Documentos_Entrantes_Juzgados(){

		if($_SESSION['id']!=""){

			require 'models/sidojuModel.php';
		
			$this->view->show("sidoju_imprimir_documentos_entrantes_juzgados.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");
		}

	}
	
	public function RecargarTablaEntrantes(){

		if($_SESSION['id']!=""){

			require 'models/sidojuModel.php';
		
			$model  = new sidojuModel();
		
			$filtro = $model->get_documentos_entrantes_usuario(1);
	
			$data['datosdocumentosentrantes'] = $filtro;
		
			$this->view->show("sidoju_verificar_documentos_entrantes_juzgados.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");
		}

	}
	public function RecargarTablaImprimirDocumentos(){

		if($_SESSION['id']!=""){

			require 'models/sidojuModel.php';
		
			$model  = new sidojuModel();
		
			$filtro = $model->get_documentos_imprimir_usuario(1);
	
			$data['datosdocumentosentrantes'] = $filtro;
		
			$this->view->show("sidoju_imprimir_documentos_entrantes_juzgados.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");
		}

	}
	
	public function RecargarListarTablaEntrantes(){

		if($_SESSION['id']!=""){

			require 'models/sidojuModel.php';
		
			$model  = new sidojuModel();
		
			$filtro = $model->get_listrar_documentos_entrantes_usuario(1);
	
			$data['datosdocumentosentrantes'] = $filtro;
		
			$this->view->show("sidoju_listar_documentos_entrantes_juzgados.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");
		}

	}
	
	public function FiltroTablaEntrantes(){

		if($_SESSION['id']!=""){

			require 'models/sidojuModel.php';
		
			$model  = new sidojuModel();
		
			$filtro = $model->get_documentos_entrantes_usuario(2);
	
			$data['datosdocumentosentrantes'] = $filtro;
		
			$this->view->show("sidoju_verificar_documentos_entrantes_juzgados.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");
		}

	}
	public function FiltroTablaImprimirDocumentos(){

		if($_SESSION['id']!=""){

			require 'models/sidojuModel.php';
		
			$model  = new sidojuModel();
		
			$filtro = $model->get_documentos_imprimir_usuario(2);
	
			$data['datosdocumentosentrantes'] = $filtro;
		
			$this->view->show("sidoju_imprimir_documentos_entrantes_juzgados.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");
		}

	}
	
	public function FiltroListarTablaEntrantes(){

		if($_SESSION['id']!=""){

			require 'models/sidojuModel.php';
		
			$model  = new sidojuModel();
		
			$filtro = $model->get_listrar_documentos_entrantes_usuario(2);
	
			$data['datosdocumentosentrantes'] = $filtro;
		
			$this->view->show("sidoju_listar_documentos_entrantes_juzgados.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");
		}

	}
	
	public function Listar_Documentos_Entrantes_Juzgados(){

		if($_SESSION['id']!=""){

			require 'models/sidojuModel.php';
		
			/*$model  = new sigdocModel();
		
			$filtro = $model->get_documentos_salientes_usuario(2);
	
			$data['datosdocumentossalientes'] = $filtro;*/
		
			$this->view->show("sidoju_listar_documentos_entrantes_juzgados.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");
		}

	}

	public function Registro_Documentos_Entrantes_Juzgados(){
	
	
		if($_SESSION['id']!=""){
		
				$i = 0 ;
				$tienepermiso = 0;
				$nombremodulo = "sidoju";
				
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
				
					require 'models/sidojuModel.php';

					$modelo = new sidojuModel();
					
					if($_POST){
					 
						$modelo->registrar_documentos_entrantes_juzgados();
		
					}
		
					$this->view->show("sidoju_documentos_entrantes_juzgados.php", $data);
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
		
						require 'models/sidojuModel.php';

						$modelo = new sidojuModel();
						
						if($_POST){
						 
							$modelo->registrar_documentos_entrantes_juzgados();
			
						}
			
						$this->view->show("sidoju_documentos_entrantes_juzgados.php", $data);
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

	}

	public function Registro_Documentos_Entrantes_Juzgados_Salud(){
		if($_SESSION['id']!="") {
			$i = 0 ;
			$tienepermiso = 0;
			$nombremodulo = "sidoju";
			require 'models/menuModel.php';
			$model        = new menuModel();
			$datosusuario = $model->get_permiso_usuario();
			$fielddatos   = $datosusuario->fetch();
			$nivel        = trim($fielddatos['idperfil']);
			$modulo       = trim($fielddatos['modulos']);
			$usuarioaadministradores = $model->get_usuario_acciones();
			$fielddatos_2            = $usuarioaadministradores->fetch();
			$nivel_2                 = trim($fielddatos_2['usuario']);
			$modulost2			     = explode("////",$nivel_2);
			if ( in_array($_SESSION['idUsuario'],$modulost2) ){
				require 'models/sidojuModel.php';
				$modelo = new sidojuModel();
				if($_POST){
					$modelo->registrar_documentos_entrantes_juzgados_salud();
				}
				$this->view->show("sidoju_documentos_entrantes_juzgados_salud.php", $data);
			} else {
				$modulos_usuario = explode("////",trim($modulo));
				$longitud_modulos = count($modulos_usuario);
				while($i < $longitud_modulos){
					if( $nombremodulo == $modulos_usuario[$i] ){
						$tienepermiso = 1;
						$i = $longitud_modulos;
					}
					$i = $i+1;
				} if($tienepermiso == 1){
					require 'models/sidojuModel.php';
					$modelo = new sidojuModel();
					if($_POST){
						$modelo->registrar_documentos_entrantes_juzgados_salud();
					}
					$this->view->show("sidoju_documentos_entrantes_juzgados_salud.php", $data);
				} else {
					print'<script languaje="Javascript">alert("¡Acceso denegado para este módulo, verifique la configuración de su perfil con el administrador del sistema...!"); location.href="index.php?controller=index&action=ruta_base"</script>';
				}	
			}
		} else {
		header("refresh: 0; URL=/centro_servicios2/");
		}
	}
	
	
	public function Registro_Vereficar_Documentos_Entrantes_Juzgados(){
	
	
			if($_SESSION['id']!=""){
		
				require 'models/sidojuModel.php';

				$modelo = new sidojuModel();
					
				if($_GET){
					 
					$modelo->registrar_vereficar_documentos_entrantes_juzgados();
		
				}
		
				$this->view->show("sidoju_verificar_documentos_entrantes_juzgados.php", $data);
				
				
			}
			else{
				header("refresh: 0; URL=/centro_servicios2/");

			}	
		
	
	}
	
	public function Editar_documento_Entrante_Juzgado(){
		if($_SESSION['id']!=""){
			require 'models/sidojuModel.php';
			$modelo  = new sidojuModel();
			if($_GET){
				$filtro = $modelo->get_datos_documentos_entrantes_juzgados();
				$data['datosdocumento'] = $filtro;
			}
			if($_POST){
				$modelo->registrar_documentos_entrantes_juzgados();
			}
			$this->view->show("sidoju_documentos_entrantes_juzgados.php", $data);
	  	} else{
			header("refresh: 0; URL=/centro_servicios2/");
		}
	}

	public function Editar_documento_Entrante_Juzgado_Salud(){
		if($_SESSION['id']!=""){
			require 'models/sidojuModel.php';
			$modelo  = new sidojuModel();
			if($_GET){
				$filtro = $modelo->get_datos_documentos_entrantes_juzgados();
				$data['datosdocumento'] = $filtro;
			}
			if($_POST){
				$modelo->registrar_documentos_entrantes_juzgados();
			}
			$this->view->show("sidoju_documentos_entrantes_juzgados_salud_ed.php", $data);
	  	} else{
			header("refresh: 0; URL=/centro_servicios2/");
		}
	}


	
	public function Listar_Archivos(){
	
		if($_SESSION['id']!=""){

			require 'models/sidojuModel.php';
		
			/*$model  = new sigdocModel();
		
			$filtro = $model->get_documentos_salientes_usuario(2);
	
			$data['datosdocumentossalientes'] = $filtro;*/
		
			$this->view->show("sidoju_listar_archivos.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");
		}
	
	}
	public function Eliminar_Registro_Sidoju(){
        if($_SESSION['id']!=""){
            require 'models/sidojuModel.php';
            $modelo = new sidojuModel();
            if($_POST){
                $modelo->eliminar_documentos_entrantes_juzgados();
            }	
            header("refresh: 0; URL=/centro_servicios2/views/popupbox/popup_sidojuEliminar_Registro.php?c=sidoju&a=Eliminar_Registro_Sidoju");
            
        }else{
            header("refresh: 0; URL=/centro_servicios2/");
        }
    }
	
	//--------------------------------------------------------------------------------------------------------
	
	
	
}//FIN CLASE

?>