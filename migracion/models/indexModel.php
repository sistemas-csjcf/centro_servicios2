<?php
    class indexModel extends modelBase{
        /***********************************************************************************/
        /*----------------------- validar el inicio de sesion -----------------------------*/
        /***********************************************************************************/	
	public function validate_user(){
            $band=0;
            $user = $_POST['user'];
            $pass = md5 ($_POST['pass']); 
            $select = $this->db->prepare("SELECT * FROM usuario  WHERE nombre_usuario = '$user' AND  contrasena = '$pass'");
            $select->execute();
            while($field = $select->fetch()){
                $usua_perfil    = $field['perfil'];
                $nombre_usuario = $field['nombre_usuario'];
                $id_juzgado     = $field['id_juzgado'];
                $especialidad   = $field['especialidad'];
                $juz_num        = $field['juz_num'];
                $juz_esp        = $field['juz_esp'];
                $juz_enti       = $field['juz_enti'];
                $bd             = $field['bd'];
                $server_name    = $field['server_name'];
                $cod_actuacion  = $field['cod_actuacion'];
                $cod_actuacion2 = $field['cod_actuacion2'];
                $pswd           = $field['pswd'];
                $band           = 1;
            }	
            $_SESSION['id'] = $usua_perfil;
            $_SESSION['nombre_usuario'] = $nombre_usuario;
            $_SESSION['id_juzgado'] = $id_juzgado;
            $_SESSION['especialidad'] = $especialidad;
            $_SESSION['juz_num'] = $juz_num;
            $_SESSION['juz_esp'] = $juz_esp;
            $_SESSION['juz_enti'] = $juz_enti;
            $_SESSION['bd'] = $bd;
            $_SESSION['server_name'] = $server_name;
            $_SESSION['cod_actuacion'] = $cod_actuacion;
            $_SESSION['cod_actuacion2'] = $cod_actuacion2;
            $_SESSION['pswd'] = $pswd;
            if ($usua_perfil == "Administrador"){
                $_SESSION['rol'] = 'Administrador';	
                header("refresh: 0; URL=/centro_servicios2/");
                die();		
            }else if ($usua_perfil == "Consulta"){
                $_SESSION['rol'] = 'Consulta';
                header("refresh: 0; URL=/centro_servicios2/");
                die();
            }
            if ($band==0){
                $_SESSION['invalidate_user'] = true;
            }
	}
    }
?>