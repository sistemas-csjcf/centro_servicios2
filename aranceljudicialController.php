<?php

class aranceljudicialController extends controllerBase{
/*---------- Mensajes -------------*/

	public function mensajes(){

		if($_SESSION['id']!=""){

			require 'models/aranceljudicialModel.php';

			$ls = new aranceljudicialModel();

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
	
	public function Imprimir_Arancel(){
	
	
			if($_SESSION['id']!=""){
		
				require 'models/aranceljudicialModel.php';

				$this->view->show("aranceljudicial_imprimir_arancel.php", $data);
				
				
			}
			else{
				header("refresh: 0; URL=/centro_servicios2/");

			}	
		
	
	}
	
	public function RecargarTablaImprimirLiquidaciones(){

		if($_SESSION['id']!=""){

			require 'models/aranceljudicialModel.php';
		
			$model  = new aranceljudicialModel();
			
			
			
			//SE REALIZA ESTA OPERACION PARA QUE EL SISTEMA IDENTIFIQUE USUARIOS
			//QUE PUEDEN VER LIQUIDACIONES DE LA FECHA ACTUAL Y NO LAS QUE HAGA ESE USUARIO ESPECIFICO
			//Y PARA ESTO SE TOMA LA INFOMACION DE LA FUNCION get_liquidaciones_imprimir_usuario_actual
			$campos               = 'usuario';
			$nombrelista          = 'pa_usuario_acciones';
			$idaccion			  = '9';
			$campoordenar         = 'id';
			$datosusuarioacciones = $model->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
			$usuarios             = $datosusuarioacciones->fetch();
			$usuariosad			  = explode("////",$usuarios[usuario]);
			
			if ( in_array($_SESSION['idUsuario'],$usuariosad) ) {
			
				$filtro = $model->get_liquidaciones_imprimir_usuario_actual(1);
			}
			else{
				$filtro = $model->get_liquidaciones_imprimir_usuario(1);
			}
			
			
			
			//$filtro = $model->get_liquidaciones_imprimir_usuario(1);
	
			$data['datosliquidaciones'] = $filtro;
		
			$this->view->show("aranceljudicial_imprimir_arancel.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");
		}

	}
	
	public function FiltroTablaImprimirLiquidaciones(){

		if($_SESSION['id']!=""){

			require 'models/aranceljudicialModel.php';
		
			$model  = new aranceljudicialModel();
			
			
			//SE REALIZA ESTA OPERACION PARA QUE EL SISTEMA IDENTIFIQUE USUARIOS
			//QUE PUEDEN VER LIQUIDACIONES DE LA FECHA ACTUAL Y NO LAS QUE HAGA ESE USUARIO ESPECIFICO
			//Y PARA ESTO SE TOMA LA INFOMACION DE LA FUNCION get_liquidaciones_imprimir_usuario_actual
			$campos               = 'usuario';
			$nombrelista          = 'pa_usuario_acciones';
			$idaccion			  = '9';
			$campoordenar         = 'id';
			$datosusuarioacciones = $model->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
			$usuarios             = $datosusuarioacciones->fetch();
			$usuariosad			  = explode("////",$usuarios[usuario]);
			
			if ( in_array($_SESSION['idUsuario'],$usuariosad) ) {
			
				$filtro = $model->get_liquidaciones_imprimir_usuario_actual(2);
			}
			else{
				$filtro = $model->get_liquidaciones_imprimir_usuario(2);
			}
		
		
		
			//$filtro = $model->get_liquidaciones_imprimir_usuario(2);
	
			$data['datosliquidaciones'] = $filtro;
		
			$this->view->show("aranceljudicial_imprimir_arancel.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/centro_servicios2/");
		}

	}
	
	public function Registro_Arancel(){
	
	
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
				
				//Administrador
				if($nivel == 1){
				
					require 'models/aranceljudicialModel.php';

					$modelo = new aranceljudicialModel();
					
					if($_POST){
					 
						$modelo->registrar_arancel();
		
					}
		
					$this->view->show("aranceljudicial_registro_arancel.php", $data);
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
		
						require 'models/aranceljudicialModel.php';

						$modelo = new aranceljudicialModel();
						
						if($_POST){
						 
							$modelo->registrar_arancel();
			
						}
			
						$this->view->show("aranceljudicial_registro_arancel.php", $data);
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
		
	public function AprobarLiquidacion(){
	
	
		if($_SESSION['id']!=""){
				
						
			require 'models/aranceljudicialModel.php';
		
			$modelo = new aranceljudicialModel();
							
			if($_GET){
							 
				$modelo->aprobar_liquidacion();
				
			}
				
			$this->view->show("aranceljudicial_imprimir_arancel.php", $data);
						
						
		}
		else{
			header("refresh: 0; URL=/centro_servicios2/");
		
		}	
		
	
	}
	
	public function AnularLiquidacion(){
	
	
		if($_SESSION['id']!=""){
				
						
			require 'models/aranceljudicialModel.php';
		
			$modelo = new aranceljudicialModel();
							
			if($_GET){
							 
				$modelo->anular_liquidacion();
				
			}
				
			$this->view->show("aranceljudicial_imprimir_arancel.php", $data);
						
						
		}
		else{
			header("refresh: 0; URL=/centro_servicios2/");
		
		}	
		
	
	}
	
	//--------------------------------------------------------------------------------------------------------
	
	
	
}//FIN CLASE

?>