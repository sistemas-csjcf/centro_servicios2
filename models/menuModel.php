<?php
class menuModel extends modelBase
{
	public function info_user()
	{
		$id = $_SESSION['id'];
		
		$select = $this->db->prepare('SELECT * FROM ejecutivoapoyo WHERE Email = :id');
		$select->bindParam(':id', $id);
		$select->execute();
		
		while($row = $select->fetch())
		{				
			$_SESSION['cargo'] = $row['Cargo'];
			$_SESSION['email'] = $row['Email'];		
			$_SESSION['estado'] = $row['estado'];	
		}
				
	}
	
	//------------------------------------------------------------------------------------------------------------------
		//CODIGO ADICIONADO POR JORGE ANDRES VALENCIA 21 DE ABRIL 2015, PROJECTO INTEGRACION APLICATIVOS CENTRO DE SERVICIOS
 	//------------------------------------------------------------------------------------------------------------------
	
	/*public function mensajes(){

		$condicion = $_GET['idmensaje'];
 	  
	  	if($condicion == 1){

	    	$_SESSION['elemento'] = "¡Usuario no Cuenta con Permisos para Acceder esta Zona...!";

	    	$_SESSION['elem_permiso'] = true;

	     	if($_SESSION['id']!=""){

	      		print'<script languaje="Javascript">location.href="index.php?controller=index&action=ruta_base"</script>';
				
	     	}
  
	   }
	   
	}*/
	
	public function get_permiso_usuario(){
	
		$idusuario  = $_SESSION['idUsuario'];
		
		$listar     = $this->db->prepare("SELECT idperfil,modulos FROM pa_usuario WHERE id = '$idusuario'");
		
		$listar->execute();

  		return $listar;
	}
	
	public function get_usuario_acciones(){
	
		//$idusuario  = $_SESSION['idUsuario'];
		
		$listar     = $this->db->prepare("SELECT * FROM pa_usuario_acciones WHERE id = 12");
		
		$listar->execute();

  		return $listar;
	}
	
	public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
	
		$listar     = $this->db->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
	
  		$listar->execute();

  		return $listar;
	
	}
	
	
}
?>