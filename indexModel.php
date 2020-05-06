<?php

class indexModel extends modelBase

{

    /***********************************************************************************/

    /*----------------------- validar el inicio de sesion -----------------------------*/

    /***********************************************************************************/	
	
	//22 MAYO 2015 NOTA: SI EN LA TABLA pa_usuario, SE LE DEFINE A UN USUARIO EL CAMPO idperfil CON 
	//3 (Empleado Archivo),5 (Empleado Correspondencia),6 (Empleado sin perfil)
	//AL LOGEARSE EN EL SISTEMA NO TENDRA ACCESO YA QUE ESTOS PERFILES NO SE HAN DEFINIDO
	//CON CODIGO EN "PARTE PERFILES" DE LA FUNCION validate_user()
	
	public function validate_user(){
		// JUAN ESTEBAN MÚNERA BETANCUR 2018-07-04
			$band = 0;
	
			$user = $_POST['user'];
			$pass = md5 ($_POST['pass']); 

					

			$select = $this->db->prepare('SELECT  usuario.id,usuario.nombre_usuario,usuario.idperfil,usuario.empleado, usuario.contrasena,perfil.nombre,usuario.foto, usuario.id_proceso_cs, usuario.tipo_perfil,perfil.id AS idperfil, usuario.id_area_cs, especialidad, server_name
			  	FROM pa_usuario as usuario
										  inner join pa_perfil as perfil ON (usuario.idperfil = perfil.id)
										  WHERE usuario.nombre_usuario = :user AND  usuario.contrasena = :pass AND idestadoempleado=1');
										 
	
			$select->bindParam(':user', $user);
	
			$select->bindParam(':pass', $pass);
	
			$select->execute();
			
			while($field = $select->fetch())
			{
			 
			
				$usua_perfil   	= $field['nombre'];
				$usua_empleado 	= $field['empleado'];
				$usua_nom      	= $field['nombre_usuario'];
				$usua_idperfil 	= $field['idperfil'];
				$usua_id       	= $field['id'];
				$foto          	= $field['foto'];
				$tipo_perfil   	= $field['tipo_perfil'];
				$idperfil      	= $field['idperfil'];
				$idAreaCS      	= $field['id_area_cs'];
				$id_proceso_cs  = $field['id_proceso_cs'];
				$empleado		= $field['empleado'];
				$band          	= 1;
				// JUAN ESTEBAN MUNERA BETANCUR 2017-09-13
				$especialidad	= $field['especialidad'];
				$bd				= $field['bd'];
				$server_name	= $field['server_name'];
			}

		
			$_SESSION['id']          	= $usua_perfil;
			$_SESSION['nombre']      	= $usua_empleado;
			$_SESSION['idUsuario']   	= $usua_id;
			$_SESSION['nomusu']      	= $usua_nom; 
			$_SESSION['foto']        	= $foto; 
			$_SESSION['tipo_perfil'] 	= $tipo_perfil; 
			$_SESSION['idperfil']    	= $idperfil;
			$_SESSION['id_area_cs']    	= $idAreaCS;
			$_SESSION['id_proceso_cs']  = $id_proceso_cs;
			$_SESSION['nombre_empleado']= $empleado;
			
			// JUAN ESTEBAN MUNERA BETANCUR 2017-09-14
			$_SESSION['especialidad']   = $especialidad;
			$_SESSION['bd']    			= $bd;
			$_SESSION['server_name']    = $server_name;
			
			//NOTA: CAMBIO REALIZADO EL 29 DE SEPTIEMBRE DEL 2015, PARA DEFINIR PERFILES EN LA TABLA pa_perfil
			//Y QUE EL USUARIO CUANDO HAGA SU INGRESO SE VISUALIZE SU PERFIL, Y SOLO MANEJAR UN MENU LA VISTA
			//m_admin.php
			if ($idperfil >= 1){
		
				$_SESSION['rol'] = 'Administrador';	
				header("refresh: 0; URL=/centro_servicios2/");
				die();		

			}
			
			//ASI ESTABA ANTES
			//PARTE PERFILES
			/*if ($usua_perfil == "Administrador"){
		
	
				$_SESSION['rol'] = 'Administrador';	
				header("refresh: 0; URL=/centro_servicios/");
				die();		

			}

			else if ($usua_perfil == "Archivo"){
			
		

				//$_SESSION['rol'] = 'Archivo';
				$_SESSION['rol'] = 'Administrador';	
				header("refresh: 0; URL=/centro_servicios/");
				die();

			}
			else if ($usua_perfil == "Correspondencia"){
			
				//echo "entre_model";
	
				//$_SESSION['rol'] = 'Correspondencia';
				$_SESSION['rol'] = 'Administrador';	
				header("refresh: 0; URL=/centro_servicios/");
				die();

			}
			
			else if ($usua_perfil == "LIDER NOTIFICACIONES CIVIL MUNICIPAL"){
			
				//echo "entre_model";
	
				//$_SESSION['rol'] = 'Correspondencia';
				$_SESSION['rol'] = 'Administrador';	
				header("refresh: 0; URL=/centro_servicios/");
				die();

			}*/
			

			if ($band==0)
	
			{
	
			
				$_SESSION['invalidate_user'] = true;
	
			}
			
	}
	

}		 



?>