<?php
    // JUAN ESTEBAN MUNERA BETANCUR
    require_once 'database.php';
    class TSocial{
	private $pdo;
    
        public $id;
        public $nombre;
        public $estado;
        
	public function __CONSTRUCT(){
            try{
                $this->pdo = Database::StartUp();     
            }catch(Exception $e){
                die($e->getMessage());
            }
	}
       
        public function Listar(){
            try{
                $stm= $this->pdo->prepare("SELECT * FROM visitas_programacion WHERE vis_pro_estado='Pendiente'");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        public function Obtener($id){
            try{
                $stm = $this->pdo
                        ->prepare("SELECT * FROM visitas_programacion WHERE vis_pro_id = ?");
                $stm->execute(array($id));
                    return $stm->fetch(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        
        public function Actualizar($data){
            try {
                $sql = "UPDATE visitas_programacion SET 
                    vis_pro_radicado = ?, 
                    vis_pro_fecha_visita = ?,
                    vis_pro_comentarios = ?,
                    
                    WHERE vis_pro_id = ?";

                $this->pdo->prepare($sql)
                ->execute(
                    array(  
                        $data->radicado,
                        $data->fecha_visita,
                        $data->comentarios,
                        
                        $data->id
                    )
                );
            } catch (Exception $e) {
                die($e->getMessage());
            }
	}  
        public function Registrar(Visita $data){
            try {
                $sql = "INSERT INTO visitas_programacion 
                    (vis_pro_radicado,vis_pro_solicitante,vis_pro_fecha_visita,vis_pro_comentarios,vis_pro_clase_proceso,vis_pro_datos_partes,vis_pro_id_TSocial,vis_pro_id_usuario,vis_pro_estado) 
                    VALUES (?,?,?,?,?,?,?,?,?)";
                $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->radicado,
                        $data->solicitante,
                        $data->fecha_visita,
                        $data->comentarios,
                        $data->clase_proceso,
                        $data->datos_partes,
                        $data->id_TSocial,
                        $data->id_usuario,
                        $data->estado
                    )
                );
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }    
        public function Eliminar($id){
            try{
                $stm = $this->pdo
	        ->prepare("DELETE FROM visitas_programacion WHERE vis_pro_id = ?");

                $stm->execute(array($id));
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        public function Aprobar($id,$us){
            try{
               $stm = $this->pdo
                ->prepare("UPDATE visitas_programacion 
                            SET vis_pro_estado = 'Aprobada',
                             vis_pro_id_usuarioE = ?
                            WHERE vis_pro_id = ?");
               $stm->execute(array($us,$id));
            }  catch (Exception $e){
                die($e->getMessage());
            }
        }
        public function Listar_Historial(){
            try{
                $id_usuario           = $_SESSION['idUsuario'];
                $modelo               = new Visita();
                $campos               = 'usuario';
                $nombrelista          = 'pa_usuario_acciones';
                $idaccion             = '20';
                $campoordenar         = 'id';
                $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
                $usuarios             = $datosusuarioacciones->fetch();
                $usuariosa            = explode("////",$usuarios[usuario]);
                
                if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
                    $stm= $this->pdo->prepare("SELECT * FROM visitas_programacion ");
                }else{
                    $stm= $this->pdo->prepare("SELECT * FROM visitas_programacion WHERE vis_pro_id_usuario='$id_usuario' ");
                }
                
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        
        

        //INFORMACION DE LA BASE DE DATOS, PARA SU CONEXION
	public function get_datos_basededatos($idbd){
            $listar     = $this->pdo->prepare("SELECT * FROM pa_base_datos WHERE id = ".$idbd);
            $listar->execute();
            return $listar;
  	}
        
        public function get_dato_usuario($id_us){
            $listar     = $this->pdo->prepare("SELECT * FROM pa_usuario WHERE id = ".$id_us);
            $listar->execute();
            return $listar;
  	}
    }
// JUAN ESTEBAN MUNERA BETANCUR