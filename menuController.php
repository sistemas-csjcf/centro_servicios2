<?php
class menuController extends controllerBase
{

	/*---------- Mensajes -------------*/
	/*public function mensajes(){

		if($_SESSION['id']!=""){

			require 'models/menuModel.php';

			$ls = new menuModel();

			$ls->mensajes();
		}
		else{

			header("refresh: 0; URL=/centro_servicios2/");

	  	}

	}*/
	/***********************************************************************************/
	/*---------------------------------  Menu Usuarios --------------------------------*/
	/***********************************************************************************/
	public function menu_user()
	{
		if($_SESSION['id']!=""){
		require 'models/menuModel.php';
		require 'models/userModel.php';
		$ls = new userModel();
		$rs2=  $ls->obtFoto();
		$data['foto'] = $rs2;
		
		$this->view->show("menuppal.php",$data);
	}
		else
		{
		header("refresh: 0; URL=/centro_servicios2/");

		}		
	}
	
	
	/***********************************************************************************/
	/*---------------------------------  Modulo archivo ------------------------------*/
	/***********************************************************************************/	
	public function mod_archivo(){
	
			if($_SESSION['id']!=""){
		
				$i = 0 ;
				$tienepermiso = 0;
				$nombremodulo = "archivo";
				
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
				
					require 'models/archivoModel.php';
				
					$model = new archivoModel();
					$rs1   = $model->listarLogArchivo();
					
					$data['datos_log'] = $rs1;
					
					$this->view->show("mod_archivo.php",$data);
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
		
						require 'models/archivoModel.php';
				
						$model = new archivoModel();
						$rs1   = $model->listarLogArchivo();
						
						$data['datos_log'] = $rs1;
						
						$this->view->show("mod_archivo.php",$data);
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
		
		
				require 'models/archivoModel.php';
				
				$ls = new archivoModel();
				$rs1 = $ls->listarLogArchivo();
				
				$data['datos_log'] = $rs1;
				
				$this->view->show("mod_archivo.php",$data);
			}
			else{
				header("refresh: 0; URL=/centro_servicios2/");

			}	*/
	}
	
	
	/***********************************************************************************/
	/*---------------------------------  Modulo Correspondencia ------------------------------*/
	/***********************************************************************************/	
	public function mod_correspondencia()
	{
		
		
		if($_SESSION['id']!=""){
		
				$i = 0 ;
				$tienepermiso = 0;
				$nombremodulo = "correspondencia";
				
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
				
					require 'models/correspondenciaModel.php';
		
					$ls = new correspondenciaModel();
					$rs1 = $ls->listarLogCorrespondencia();
					
					$data['datos_log'] = $rs1;
					
					$this->view->show("mod_correspondencia.php",$data);
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
		
						require 'models/correspondenciaModel.php';
		
						$ls = new correspondenciaModel();
						$rs1 = $ls->listarLogCorrespondencia();
						
						$data['datos_log'] = $rs1;
						
						$this->view->show("mod_correspondencia.php",$data);
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
		require 'models/correspondenciaModel.php';
		
		$ls = new correspondenciaModel();
		$rs1 = $ls->listarLogCorrespondencia();
		
		$data['datos_log'] = $rs1;
		
		$this->view->show("mod_correspondencia.php",$data);
		}
		else
		{
		header("refresh: 0; URL=/centro_servicios2/");

		}*/	
	}
	
	
	
	/***********************************************************************************/
	/*------------------------------  Modulo Configuracion ----------------------------*/
	/***********************************************************************************/	
	public function mod_configuracion()
	{
	
		
		if($_SESSION['id']!=""){
		
				$i = 0 ;
				$tienepermiso = 0;
				$nombremodulo = "configuracion";
				
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
				
					require 'models/userModel.php';
		
					$ls = new userModel();
					$rs1 = $ls->listUser();
					//$rs2=  $ls->obtFoto();
					//$rs3 = $ls->tipoUser();
								
					$data['listdata'] = $rs1;
					$data['foto'] = $rs2;
					//$data['tipousuario'] = $rs3;
					
					$this->view->show("mod_configuracion.php", $data);
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
		
						require 'models/userModel.php';
		
						$ls = new userModel();
						$rs1 = $ls->listUser();
						//$rs2=  $ls->obtFoto();
						//$rs3 = $ls->tipoUser();
									
						$data['listdata'] = $rs1;
						$data['foto'] = $rs2;
						//$data['tipousuario'] = $rs3;
						
						$this->view->show("mod_configuracion.php", $data);
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
		require 'models/userModel.php';
		
		$ls = new userModel();
		$rs1 = $ls->listUser();
		//$rs2=  $ls->obtFoto();
		//$rs3 = $ls->tipoUser();
					
		$data['listdata'] = $rs1;
		$data['foto'] = $rs2;
		//$data['tipousuario'] = $rs3;
		
		$this->view->show("mod_configuracion.php", $data);
		}
		else
		{
		header("refresh: 0; URL=/centro_servicios2/");

		}*/		

	}
	
	//------------------------------------------------------------------------------------------------------------------
	//CODIGO ADICIONADO POR JORGE ANDRES VALENCIA 20 DE ABRIL 2015, PROJECTO INTEGRACION APLICATIVOS CENTRO DE SERVICIOS
	//------------------------------------------------------------------------------------------------------------------
	
	/***********************************************************************************/
	/*---------------------------------  Modulo Documentos ------------------------------*/
	/***********************************************************************************/	
	public function mod_sigdoc()
	{
	

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
					$rs1    = $modelo->listarLogSigdoc();
					
					$data['datos_log'] = $rs1;
					
					$this->view->show("mod_sigdoc.php",$data);
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
						$rs1    = $modelo->listarLogSigdoc();
						
						$data['datos_log'] = $rs1;
						
						$this->view->show("mod_sigdoc.php",$data);
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
	
	/***********************************************************************************/
	/*---------------------------------  Modulo Sidoju (Documentos Juzgados) ------------------------------*/
	/***********************************************************************************/	
	public function mod_sidoju()
	{
	

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
					$rs1    = $modelo->listarLogSidoju();
					
					$data['datos_log'] = $rs1;
					
					$this->view->show("mod_sidoju.php",$data);
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
						$rs1    = $modelo->listarLogSidoju();
						
						$data['datos_log'] = $rs1;
						
						$this->view->show("mod_sidoju.php",$data);
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
	
	/***********************************************************************************/
	/*---------------------------------  Modulo Signot (Notificaciones) ------------------------------*/
	/***********************************************************************************/	
	public function mod_signot()
	{
	

		if($_SESSION['id']!=""){
		
				$i = 0 ;
				$tienepermiso = 0;
				$nombremodulo = "signot";
				
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
				
					require 'models/signotModel.php';
					
					$modelo = new signotModel();
					$rs1    = $modelo->listarLogSignot();
					
					$data['datos_log'] = $rs1;
					
					$this->view->show("mod_signot.php",$data);
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
					
					if($tienepermiso == 1 && $_SESSION['tipo_perfil'] == "Despacho Judicial"){
                        require 'models/signotModel.php';
                        $modelo = new signotModel();
                        $this->view->show("signot_seguimiento_Juzgado.php");
                    }		
                    else if($tienepermiso == 1){
                        require 'models/signotModel.php';
                        $modelo = new signotModel();
                        $rs1    = $modelo->listarLogSignot();
                        $data['datos_log'] = $rs1;
                        $this->view->show("mod_signot.php",$data);
                    }else{
						print'<script languaje="Javascript">alert("¡Acceso denegado para este módulo, verifique la configuración de su perfil con el administrador del sistema...!"); location.href="index.php?controller=index&action=ruta_base"</script>';
						/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mensajes&idmensaje=1"</script>';*/
					}
					
					
				}
				
				
			}
			else{
				header("refresh: 0; URL=/centro_servicios2/");

			}	
			
	}
	
	
	
	/***********************************************************************************/
	/*---------------------------------  Modulo Signot (Notificaciones) ------------------------------*/
	/***********************************************************************************/	
	public function mod_estadistica()
	{
	

		if($_SESSION['id']!=""){
		
				$i = 0 ;
				$tienepermiso = 0;
				$nombremodulo = "estadistica";
				
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
				
					require 'models/estadisticaModel.php';
					
					$modelo = new estadisticaModel();
					$rs1    = $modelo->listarLogSignot();
					
					$data['datos_log'] = $rs1;
					
					$this->view->show("mod_estadistica.php",$data);
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
		
						require 'models/estadisticaModel.php';
					
						$modelo = new estadisticaModel();
						$rs1    = $modelo->listarLogSignot();
						
						$data['datos_log'] = $rs1;
						
						$this->view->show("mod_estadistica.php",$data);
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
	
	
	/***********************************************************************************/
	/*---------------------------------  Modulo Arancel Judicial ------------------------------*/
	/***********************************************************************************/	
	public function mod_arancel()
	{
	

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
					$rs1    = $modelo->listarLogArancel();
					
					$data['datos_log'] = $rs1;
					
					$this->view->show("mod_arancel.php",$data);
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
						$rs1    = $modelo->listarLogArancel();
						
						$data['datos_log'] = $rs1;
						
						$this->view->show("mod_arancel.php",$data);
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
	
	/***********************************************************************************/
	/*---------------------------------  Modulo REPS ------------------------------*/
	/***********************************************************************************/	
	public function mod_reps()
	{
		if($_SESSION['id']!=""){
		
			require 'models/repsModel.php';
			
			$ls  = new repsModel();
			$rs1 = $ls->listarLogArchivo();
			
			$data['datos_log'] = $rs1;
			
			$this->view->show("mod_reps.php",$data);
		}
		else{
			header("refresh: 0; URL=/centro_servicios2/");

		}	
	}
	
	
	public function mod_caratula()
	{
		if($_SESSION['id']!=""){
		
			require 'models/caratulaModel.php';
			
			$ls  = new caratulaModel();
			$rs1 = $ls->listarLogcaratula();
			
			$data['datos_log'] = $rs1;
			
			$this->view->show("mod_caratula.php",$data);
		}
		else{
			header("refresh: 0; URL=/centro_servicios2/");

		}	
	}
	/***********************************************************************************/
	/*---------------------------------  Modulo TRABAJO SOCIAL ------------------------------*/
	/***********************************************************************************/	
	public function mod_trabajo_social(){
		if($_SESSION['id']!=""){
			$i = 0 ;
			$tienepermiso = 0;
			$nombremodulo = "TSocial";
			require 'models/menuModel.php';
			$model        = new menuModel();
			$datosusuario = $model->get_permiso_usuario();
			$fielddatos   = $datosusuario->fetch();
			$nivel        = trim($fielddatos['idperfil']);
			$modulo       = trim($fielddatos['modulos']);
			$usuarioaadministradores = $model->get_usuario_acciones();
			$fielddatos_2            = $usuarioaadministradores->fetch();
			$nivel_2                 = trim($fielddatos_2['usuario']);
			$modulost2               = explode("////",$nivel_2);
			if ( in_array($_SESSION['idUsuario'],$modulost2) ){
				require 'models/trabajo_social_Model.php';
				$modelo = new trabajo_social_Model();
				$rs1    = $modelo->listarLogTrabajoSocial();
				$data['datos_log'] = $rs1;
				$this->view->show("mod_trabajo_social.php",$data);
			}else{
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
					require 'models/trabajo_social_Model.php';
					$modelo = new trabajo_social_Model();
					$rs1    = $modelo->listarLogTrabajoSocial();
					$data['datos_log'] = $rs1;
					$this->view->show("mod_trabajo_social.php",$data);
				}else{
					print'<script languaje="Javascript">alert("Acceso denegado para este m\xf3dulo, verifique la configuraci\xf3n de su perfil con el administrador del sistema...!"); location.href="index.php?controller=index&action=ruta_base"</script>';
				}					
			}   
		}else{
			header("refresh: 0; URL=/centro_servicios2/");
		}
	}
  	//JUAN ESTEBAN MÚNERA BETANCUR 2018-07-04
    /***********************************************************************************/
	/*---------------------------  Modulo SEGME ------------------------------*/
	/***********************************************************************************/	
	public function mod_Segme(){
        if($_SESSION['id']!=""){
            $i = 0 ;
            $tienepermiso = 0;
            $nombremodulo = "segme";
            require 'models/menuModel.php';
            $model        = new menuModel();
            
            if ($_SESSION['idperfil'] !=0){
                require 'models/segme_Model.php';
                $modelo = new Segme_Model();
                $rs1    = $modelo->listarLog_Segme();
                $data['datos_log'] = $rs1;
                $this->view->show("mod_segme.php",$data);
            }else{
                print'<script languaje="Javascript">alert("Acceso denegado para este m\xf3dulo, verifique la configuraci\xf3n de su perfil con el administrador del sistema...!"); location.href="index.php?controller=index&action=ruta_base"</script>';
            }
        }else{
            header("refresh: 0; URL=/centro_servicios2/");
        }
	}
}
?>