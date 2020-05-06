<?php
    class Segme_Model extends modelBase{
    /***********************************************************************************/
    /*----------------------------- Mensajes ---------------------------------------*/
    /***********************************************************************************/
	public function mensajes(){
            $condicion = $_GET['nombre'];
            $idmensaje = $_GET['idmensaje'];
            if($condicion == 2){
                $_SESSION['elemento'] = "El registro ha sido ingresado correctamente";
                $_SESSION['elem_conscontrato'] = true;
                if($_SESSION['id']!=""){
                    /*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
                    print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=Registro_Documentos_Entrantes_Juzgados"</script>';
                }
            }
            if($condicion == "2b"){
                $_SESSION['elemento'] = "Error al Realizar el registro";
	    	$_SESSION['elem_error_transaccion'] = true;
                if($_SESSION['id']!=""){
                    print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=Registro_Documentos_Entrantes_Juzgados"</script>';
                }
            }	
            if($condicion == "3b"){	
                if($idmensaje == 1){$_SESSION['elemento'] = "El Archivo no Cumple con las Caracteristicas Especificas, 
                    si es diferente de tipo (vnd.ms-excel,vnd.openxmlformats-officedocument.spreadsheetml.sheet,
                    vnd.openxmlformats-officedocument.wordprocessingml.document,pdf) y tama�o de archivo < 100000000";}		 
                if($idmensaje == 2){$_SESSION['elemento'] = "Ya Existe un Archivo con ese Nombre";}
                if($idmensaje == 3){$_SESSION['elemento'] = "Error al subir el fichero";}
	    	$_SESSION['elem_error_archivo'] = true;
                if($_SESSION['id']!=""){					
                    print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=Registro_Documentos_Entrantes_Juzgados"</script>';
                }
            }	
            if($condicion == 4){
                $_SESSION['elemento'] = "El registro ha sido ingresado correctamente";
	    	$_SESSION['elem_conscontrato'] = true;
                if($_SESSION['id']!=""){
                    print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=Verificar_Documentos_Entrantes_Juzgados"</script>';
                }
            }	 
            if($condicion == "4b"){
                $_SESSION['elemento'] = "Error al Realizar el registro";
	    	$_SESSION['elem_error_transaccion'] = true;
                if($_SESSION['id']!=""){
                    print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=Verificar_Documentos_Entrantes_Juzgados"</script>';
                }
            }
	}
	/***********************************************************************************/
        /*------------------------------ Listar Log ---------------------------------------*/
        /***********************************************************************************/
	public function listarLog_Segme(){
            $listar = $this->db->prepare("SELECT logusuario.fecha,logusuario.accion,logusuario.detalle,usuario.empleado,usuario.foto
                                            FROM LOG AS logusuario
                                            INNER JOIN pa_usuario AS usuario ON (logusuario.idusuario=usuario.id)
                                            WHERE logusuario.idtipolog=14
                                            ORDER BY logusuario.id DESC
                                            LIMIT 15");
            $listar->execute();
            return $listar;
  	}
        public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
            $listar     = $this->db->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
            $listar->execute();
            return $listar;
	}
        public function get_lista_usuario_accionesJE($idaccion){
            $listar = $this->db->prepare("SELECT * FROM pa_usuario_acciones WHERE id = ".$idaccion." ORDER BY id ");
            $listar->execute();
            return $listar;
	}
        
    }