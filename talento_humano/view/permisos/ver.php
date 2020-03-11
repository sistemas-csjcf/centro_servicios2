public function Actualizar_Estado_Permiso_Mayor($data)
        {
            session_start();
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new HojaVida();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            $bandera_out = $data->flag_out;
            date_default_timezone_set('America/Bogota'); 
            $dato_sec  = $modelo->get_max_cons_resolucion();
            while($row = $dato_sec->fetch()){
                $contador = $row['con_consecutivo'] + 1;
            }
            $max = $contador;
            if($contador >= 0 && $contador <= 9){$contador = "00".$contador;}
            if($contador >  9 && $contador <= 99){$contador = "0".$contador;}
            
            if( $data->estado == 1){
                $valor = "Se Aprueba ";
            }else if ($data->estado == 0){
                $valor = "No Se Aprueba ";
            }else{
                $valor = " ";
            }
            $accion  = "Se Actualiza de Estado a Solicitud de Permiso mayor a un día";
            $detalle = utf8_encode($_SESSION['nombre'])." "."Actualiza de Estado a una Solicitud de Permiso mayor a un día ".$fechalog." "."a las: ".$horalog." ACCION: ".$valor;
            $tipolog = 3;
            $idusuario  = $_SESSION['idUsuario'];
            try{
                if($data->estado == 1){
                    $num_resolucion = $contador;
                    $this->pdo->exec("UPDATE th_contador_resoluciones SET con_consecutivo ='$max'");
                    /*if($bandera_out >0){
                        $num_resolucion = $contador;
                        $this->pdo->exec("UPDATE th_contador_resoluciones SET con_consecutivo ='$max'");
                    }else{
                        $num_resolucion ="";
                    }*/
                    $sql = "UPDATE empleado_permiso_mayor SET estado = ?, num_resolucion = ?, observaciones= ? WHERE id = ?";
                    $this->pdo->prepare($sql)
                    ->execute(
                        array(
                            $data->estado,
                            $num_resolucion,
                            $data->observaciones,
                            $data->id
                        )
                    );
                }
                else if ($data->estado == 0)
                {
                    $sql = "UPDATE empleado_permiso_mayor SET estado = ?, observaciones= ? WHERE id = ?";
                    $this->pdo->prepare($sql)
                    ->execute(
                        array(
                            $data->estado,
                            $data->observaciones,
                            $data->id
                        )
                    );
                }
                $this->pdo->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
            } 
            catch (Exception $ex) 
            {
                die($ex->getMessage());
            }
        }
		
	
function consultar_permisos_estudio()
{
    var user    = document.getElementById("id_usuario").value;
    var fechaI  = document.getElementById("fechaI").value;
    var fechaF  = document.getElementById("fechaF").value;
    var estado  = document.getElementById("estado").value;
    if (user == 0 && fechaI == 0 && fechaF == 0 && estado == 0){
        alert("Definir Algun Campo para Realizar el Filtro");
        document.getElementById('id_usuario').style.borderColor='#FF0000';
        document.getElementById('fechaI').style.borderColor='#FF0000';
        document.getElementById('fechaF').style.borderColor='#FF0000';
        document.getElementById('estado').style.borderColor='#FF0000';
        document.getElementById("resultado").innerHTML = "";
        //return;
    }else{
        document.getElementById("tb_inicial").innerHTML = "";
        
        if (window.XMLHttpRequest) {
            // código para IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("resultado").innerHTML = xmlhttp.responseText;
                document.getElementById("load").style.display = "none";
            }else{
                document.getElementById("load").style.display = "block";
                var progreso = 0;
                var idIterval = setInterval(function(){
                    progreso +=10;
                    $('#bar').css('width', progreso + '%');
                    if(progreso == 100){
                        clearInterval(idIterval);
                    }
                },1000);
            }
        };
        xmlhttp.open("GET","view/permisos/filtro_reporte_permisos_estudio_reps.php?user="+user+"&inicio="+fechaI+"&fin="+fechaF+"&estado="+estado,true);
        xmlhttp.send();
    }
};