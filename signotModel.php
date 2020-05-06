<?php
    class signotModel extends modelBase{
        /***********************************************************************************/
        /*----------------------------- Mensajes ---------------------------------------*/
        /***********************************************************************************/
        public function mensajes(){
            $condicion=$_GET['nombre'];
            if($condicion == 2){
                $_SESSION['elemento'] = "El registro ha sido ingresado correctamente";
                $_SESSION['elem_conscontrato'] = true;
                if($_SESSION['id']!=""){
                    /*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
                    print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Registro_Proceso"</script>';
                }
            }
            if($condicion == "2b"){
                $_SESSION['elemento'] = "Error al Realizar el registro";
            $_SESSION['elem_error_transaccion'] = true;
                if($_SESSION['id']!=""){
                    /*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
                    print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Registro_Proceso"</script>';
                }
            }
            if($condicion == "3b1"){
                $_SESSION['elemento'] = "El registro ha sido Actualizado correctamente";
            $_SESSION['elem_conscontrato'] = true;
                if($_SESSION['id']!=""){
                    /*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
                    print'<script languaje="Javascript">location.href="index.php?controller=reps&action=repsListaPermisos"</script>';
                }
            }
            if($condicion == "3b2"){
                $_SESSION['elemento'] = "Error al Realizar la Actualizacion del Registro";
            $_SESSION['elem_error_transaccion'] = true;
                if($_SESSION['id']!=""){
                    /*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
                    print'<script languaje="Javascript">location.href="index.php?controller=reps&action=repsListaPermisos"</script>';
                }
            }
            if($condicion == 4){
                $_SESSION['elemento'] = "El registro ha sido ingresado correctamente";
            $_SESSION['elem_conscontrato'] = true;
                if($_SESSION['id']!=""){
                    /*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
                    print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Registro_Proceso_Unico"</script>';
                }
            }
            if($condicion == "4b"){
                $_SESSION['elemento'] = "Error al Realizar el registro";
            $_SESSION['elem_error_transaccion'] = true;
                if($_SESSION['id']!=""){
                    /*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
                    print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Registro_Proceso"</script>';
                }
            }
            if($condicion == 5){
                $_SESSION['elemento'] = "El registro ha sido ingresado correctamente";
            $_SESSION['elem_conscontrato'] = true;
                if($_SESSION['id']!=""){
                    /*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
                    print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Modificar_Proceso_2"</script>';
                }
            }
            if($condicion == "5b"){
                $_SESSION['elemento'] = "Error al Realizar el registro";
            $_SESSION['elem_error_transaccion'] = true;
                if($_SESSION['id']!=""){
                    /*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
                    print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Modificar_Proceso_2"</script>';
                }
            }
            if($condicion == 6){
                $_SESSION['elemento'] = "El registro ha sido ingresado correctamente";
            $_SESSION['elem_conscontrato'] = true;
                if($_SESSION['id']!=""){
                    /*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
                    print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Modificar_Proceso"</script>';
                }
            }
            if($condicion == "6b"){
                $_SESSION['elemento'] = "Error al Realizar el registro";
                $_SESSION['elem_error_transaccion'] = true;
                if($_SESSION['id']!=""){
                    /*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
                    print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Modificar_Proceso"</script>';
                }
            }
            if($condicion == "6c"){
                $_SESSION['elemento'] = "El Proceso no Cuenta con Partes, No es Posible La MIGRACION";
                $_SESSION['elem_conscontrato'] = true;
                if($_SESSION['id']!=""){
                    /*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
                    print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Modificar_Proceso"</script>';
                }
            }
            if($condicion == "6d"){
                $_SESSION['elemento'] = "No es Posible La MIGRACION, ya fue Realizada...";
            $_SESSION['elem_conscontrato'] = true;
                if($_SESSION['id']!=""){
                    /*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
                    print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Modificar_Proceso"</script>';
                }
            }
            if($condicion == 7){
                $_SESSION['elemento'] = "El registro ha sido ingresado correctamente";
                $_SESSION['elem_conscontrato'] = true;
                if($_SESSION['id']!=""){
                    /*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
                    print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Modificar_Parte"</script>';
                }
            }
            if($condicion == "7b"){
                $_SESSION['elemento'] = "Error al Realizar el registro";
                $_SESSION['elem_error_transaccion'] = true;
                if($_SESSION['id']!=""){
                    /*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
                    print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Modificar_Parte"</script>';
                }
            }
            if($condicion == 8){
                $_SESSION['elemento'] = "El registro ha sido ingresado correctamente";
                $_SESSION['elem_conscontrato'] = true;
                if($_SESSION['id']!=""){
                    /*print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Generar_Notificacion"</script>';*/
                    print'<script languaje="Javascript">location.href="index.php?controller=documentos&action=Listar_Documentos_Salientes"</script>';
                }
            }
            if($condicion == "8b"){
                $_SESSION['elemento'] = "Error al Realizar el registro";
                $_SESSION['elem_error_transaccion'] = true;
                if($_SESSION['id']!=""){
                    /*print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Generar_Notificacion"</script>';*/
                    print'<script languaje="Javascript">location.href="index.php?controller=documentos&action=Listar_Documentos_Salientes"</script>';
                }
            }
            if($condicion == 9){
                $_SESSION['elemento'] = "El registro ha sido ingresado correctamente";
                $_SESSION['elem_conscontrato'] = true;
                if($_SESSION['id']!=""){
                    /*print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Generar_Notificacion"</script>';*/
                    print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Seguimiento_Proceso"</script>';
                }
            }
            if($condicion == "9b"){
                $_SESSION['elemento'] = "Error al Realizar el registro";
                $_SESSION['elem_error_transaccion'] = true;
                if($_SESSION['id']!=""){
                    /*print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Generar_Notificacion"</script>';*/
                    print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Seguimiento_Proceso"</script>';
                }
            }
            if($condicion == 10){
                $_SESSION['elemento'] = "El registro ha sido ingresado correctamente";
                $_SESSION['elem_conscontrato'] = true;
                if($_SESSION['id']!=""){
                    /*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
                    print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Registro_Migracion"</script>';
                }
            }
    }
    /***********************************************************************************/
        /*------------------------------ Listar Log ---------------------------------------*/
        /***********************************************************************************/
    public function listarLogSignot(){
            $listar = $this->db->prepare("SELECT logusuario.fecha,logusuario.accion,logusuario.detalle,usuario.empleado,usuario.foto
                                            FROM LOG AS logusuario
                                            INNER JOIN pa_usuario AS usuario ON (logusuario.idusuario=usuario.id)
                                            WHERE logusuario.idtipolog=6
                                            ORDER BY logusuario.id DESC
                                            LIMIT 15");
            $listar->execute();
            return $listar;
    }

    public function get_fecha_actual(){
            //FORMA WIN 7 Y 8, YA QUE DE LA FORMA ANTERIOR TOMA EL AM O PM Y DA CONFLICTOS PARA
            //GUARDAR EN LA BASE DE DATOS EN ESTE CASO LA TABLA detalle_correspondencia
            //CAMPO fecha QUE ES DATETIME
            date_default_timezone_set('America/Bogota');
            $fecharegistro=date('Y-m-d g:ia'); //FORMA PARA XP
            //$fecharegistro = date('Y-m-d g:i');
            return $fecharegistro;
    }

    public function get_fecha_actual_amd(){
            //FORMA WIN 7 Y 8, YA QUE DE LA FORMA ANTERIOR TOMA EL AM O PM Y DA CONFLICTOS PARA
            //GUARDAR EN LA BASE DE DATOS EN ESTE CASO LA TABLA detalle_correspondencia
            //CAMPO fecha QUE ES DATETIME
            date_default_timezone_set('America/Bogota');
            $fecharegistro=date('Y-m-d'); //FORMA PARA XP
            //$fecharegistro = date('Y-m-d g:i');
            return $fecharegistro;
    }

    public function get_ano(){
            date_default_timezone_set('America/Bogota');
            $fecharegistro=date('y');
            return $fecharegistro;
    }

    public function get_hora_actual(){
            date_default_timezone_set('America/Bogota');
            //$horaregistro=date('H:i:s');
            $horaregistro=date('g:i:s A');
            return $horaregistro;
    }

    public function get_datos_usuario_sistema(){
            $idusuario  = $_SESSION['idUsuario'];
            $listar     = $this->db->prepare("SELECT ingreso,foto,empleado FROM pa_usuario WHERE id = '$idusuario'");
            $listar->execute();
            return $listar;
    }

    public function get_datos_usuarios(){
            $listar     = $this->db->prepare("SELECT * FROM pa_usuario ORDER BY empleado");
            $listar->execute();
            return $listar;
    }

    public function get_datos_usuario_recibe(){
            $listar     = $this->db->prepare("SELECT * FROM sigdoc_recibe ORDER BY nombre_recibe");
            $listar->execute();
            return $listar;
    }

    public function get_lista($nombrelista,$campoordenar,$formaordenar){
            $listar     = $this->db->prepare("SELECT * FROM ".$nombrelista." ORDER BY ".$campoordenar." ".$formaordenar);
            $listar->execute();
            return $listar;
    }

    public function get_lista_filtro($nombrelista,$campoordenar,$filtro,$formaordenar){
            $listar     = $this->db->prepare("SELECT * FROM ".$nombrelista." ".$filtro." ORDER BY ".$campoordenar." ".$formaordenar);
            $listar->execute();
            return $listar;
    }
    public function get_direcciones($iddireccion){
            $listar     = $this->db->prepare("SELECT sp.id AS idparte,sd.id,sp.cedula,sp.nombre,sd.telefono,sd.direccion,sd.iddepartamento,sd.idmunicipio
                                            FROM (signot_parte sp INNER JOIN signot_direccion sd ON sp.id = sd.idparte)
                                            WHERE sd.id = '$iddireccion'");
            $listar->execute();
            return $listar;
    }

    public function get_auto_correccion($idauto){
            //SE REALIZA ESTE CAMBIO DE SQL YA QUE LOS AUTOS DE LAS PARTES SE VA A MANEJAR EN LA TABLA documentos_internos
            /*$listar     = $this->db->prepare("SELECT sap.id,sp.cedula,sp.nombre,spr.radicado,sap.idauto,sap.fecharegistroauto,sap.fechaauto,sap.descorrecion,
                                                    sap.idparte,sap.idproceso
                                                FROM ((signot_auto_parte sap INNER JOIN signot_parte sp ON sap.idparte = sp.id)
                                                INNER JOIN signot_proceso spr ON spr.id = sap.idproceso)
                                                WHERE sap.id = '$idauto'");*/

            $listar     = $this->db->prepare("SELECT sap.id,sp.cedula,sp.nombre,spr.radicado,sap.idtipodocumento,sap.numero,sap.dirigidoa,
                                                sap.direccion,sap.ciudad,sap.fechageneracion,sap.fechaauto,sap.asunto,
                                                sap.descorrecion,sap.idparte,sap.idradicado,sap.partes,sap.fechaautocorrige
                                            FROM ((documentos_internos sap INNER JOIN signot_parte sp ON sap.idparte = sp.id)
                                            INNER JOIN signot_proceso spr ON spr.id = sap.idradicado)
                                            WHERE sap.id = $idauto");
            $listar->execute();
            return $listar;
    }

    public function get_Consecutivo($filtro){
            //$filtro     = $_GET['filtro'];
            $listar     = $this->db->prepare("SELECT * FROM sigdoc_area WHERE id = '$filtro'");
            $resultado  = $listar->execute();
            $fila       = $resultado->fetch();
            $sigla      = $fila[sigla];
            $contador   = $fila[contador];
            $cadenadatos = $sigla."//////".$contador;
            return $cadenadatos;
            //return $listar;
    }

    public function get_documentos_salientes_usuario($identrada){
            $idusuario  = $_SESSION['idUsuario'];
            if($identrada == 1){
                /*$listar     = $this->db->prepare("SELECT rds.id,rds.identrada,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.cargo,rds.dependencia,
                                                        rds.fechageneracion,rds.asunto,rds.contenido
                                                    FROM ((sigdoc_documentos_internos rds LEFT JOIN sigdoc_pa_tipodocumento td ON rds.idtipodocumento = td.id)
                                                    LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
                                                    ORDER BY rds.id DESC");*/
                                                    //ORDER BY rds.id DESC LIMIT 5");
                $listar     = $this->db->prepare("SELECT rds.id,rds.identrada,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.cargo,rds.dependencia,
                                                    rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita
                                                FROM ((((sigdoc_documentos_internos rds LEFT JOIN sigdoc_pa_tipodocumento td ON rds.idtipodocumento = td.id)
                                                LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
                                                LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
                                                LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
                                                ORDER BY rds.id DESC");
            }
            if($identrada == 2){
                $filtrox;

                $filtrof;
                $filtro1;
                $filtro2;
                $filtro3;
                $filtro4;
                $filtro5;
                $filtro6;
                $filtro7;
                $filtro8;

                $fechad    = trim($_GET['dato_1']);
                $fechah    = trim($_GET['dato_2']);

                $datox1    = trim($_GET['datox1']);
                $datox2    = trim($_GET['datox2']);
                $datox3    = trim($_GET['datox3']);
                $datox4    = trim($_GET['datox4']);
                $datox5    = trim($_GET['datox5']);
                $datox6    = trim($_GET['datox6']);
                $datox7    = trim($_GET['datox7']);
                $datox8    = trim($_GET['datox8']);

                if ( !empty($fechad) && !empty($fechah) ) {
                    $filtrof = " AND (rds.fechageneracion >= '$fechad' AND rds.fechageneracion <= '$fechah') ";
                }
                if ( !empty($datox1) ) {
                    $filtro1 = " AND rds.idtipodocumento = '$datox1' ";
                }
                if ( !empty($datox2) ) {
                    $filtro2 = " AND rds.numero = '$datox2' ";
                }
                if ( !empty($datox3) ) {
                    $filtro3 = " AND rds.dirigidoa = '$datox3' ";
                }
                if ( !empty($datox4) ) {
                    //$filtro4 = " AND rds.nombre = '$datox4' ";
                    $filtro4 = " AND rds.nombre LIKE '%$datox4%' ";
                }
                if ( !empty($datox5) ) {
                    $filtro5 = " AND rds.cargo LIKE '%$datox5%' ";
                }
                if ( !empty($datox6) ) {
                    $filtro6 = " AND rds.dependencia LIKE '%$datox6%' ";
                }
                if ( !empty($datox7) ) {
                    //$filtro8 = " AND rds.asunto = '$datox8' ";
                    $filtro7 = " AND rds.asunto LIKE '%$datox7%' ";
                }
                if ( !empty($datox8) ) {
                    $filtro8 = " AND rds.id = '$datox8' ";
                }
                $filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtrof;
                //echo $filtrox;
                /*$listar    = $this->db->prepare("SELECT rds.id,rds.identrada,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.cargo,rds.dependencia,
                                                                                 rds.fechageneracion,rds.asunto,rds.contenido
                                                                                 FROM ((sigdoc_documentos_internos rds LEFT JOIN sigdoc_pa_tipodocumento td ON rds.idtipodocumento = td.id)
                                                                                 LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
                                                                                 WHERE rds.id >= '1'" .$filtrox. "
                                                                                 ORDER BY rds.id DESC");*/
                $listar    = $this->db->prepare("SELECT rds.id,rds.identrada,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.cargo,rds.dependencia,
                                                    rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita
                                                FROM ((((sigdoc_documentos_internos rds LEFT JOIN sigdoc_pa_tipodocumento td ON rds.idtipodocumento = td.id)
                                                LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
                                                LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
                                                LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
                                                WHERE rds.id >= '1'" .$filtrox. "
                                                ORDER BY rds.id DESC");
            }
            $listar->execute();
            return $listar;
        }
    public function get_datos_proceso($identrada){
            //$idusuario  = $_SESSION['idUsuario'];
            if($identrada == 1){
                /*$listar     = $this->db->prepare("SELECT * FROM signot_proceso
                                                  ORDER BY id DESC LIMIT 10");*/
                $listar     = $this->db->prepare("SELECT pro.id,pro.radicado,pro.iddevolucion,td.nombre_tipo_documento
                                                    FROM (signot_proceso pro LEFT JOIN pa_tipodocumento td ON pro.iddevolucion = td.id)
                                                    ORDER BY pro.id DESC LIMIT 10");
            }
            if($identrada == 2){
                $filtrox;
                $filtrof;
                $filtro1;
                $fechad    = trim($_GET['dato_1']);
                $fechah    = trim($_GET['dato_2']);
                $datox1    = trim($_GET['datox1']);
                if ( !empty($fechad) && !empty($fechah) ) {
                    $filtrof = " AND (rds.fecharegistro >= '$fechad' AND rds.fecharegistro <= '$fechah') ";
                }
                if ( !empty($datox1) ) {
                    $filtro1 = " AND rds.radicado LIKE '%$datox1%' ";
                }
                $filtrox = $filtro1." ".$filtrof;
                /*$listar    = $this->db->prepare("SELECT rds.id,rds.radicado
                                                FROM signot_proceso rds
                                                WHERE rds.id >= '1'" .$filtrox. "
                                                ORDER BY rds.id");*/
                $listar     = $this->db->prepare("SELECT rds.id,rds.radicado,rds.iddevolucion,td.nombre_tipo_documento
                                                FROM (signot_proceso rds LEFT JOIN pa_tipodocumento td ON rds.iddevolucion = td.id)
                                                WHERE rds.id >= '1'" .$filtrox. "
                                                ORDER BY rds.id");
            }
            $listar->execute();
            return $listar;
    }
    // JUAN ESTEBAN MUNERA BETANCUR 2019-01-28
        public function get_observacion_proceso($dato){
            $listar = $this->db->prepare("SELECT * FROM signot_proceso_observacion AS obs
                                        WHERE obs.idradicado = '$dato'" );
            $listar->execute();
            return $listar;
        }


        public function get_partes_proceso($d1){
            $listar = $this->db->prepare("SELECT pa.id,pa.cedula,pa.nombre,cp.descripcion AS clasificacion, dir.direccion,
                                            dep.descripcion AS departamento, muni.descripcion AS municipio,pp.endevolucion,pp.idclaseparte
                                        FROM ((((((signot_proceso sp  LEFT JOIN signot_parteproceso pp ON sp.id = pp.idproceso)
                                        LEFT JOIN signot_parte pa ON pa.id = pp.idparte)
                                        LEFT JOIN signot_clasificacion_parte cp ON cp.id = pp.idclaseparte)
                                        LEFT JOIN signot_direccion dir ON dir.idproceso = pp.idproceso AND dir.idparte = pa.id)
                                        LEFT JOIN signot_pa_departamento dep ON dep.Cod_departamento = dir.iddepartamento)
                                        LEFT JOIN signot_pa_municipio muni ON muni.Cod_Municipio = dir.idmunicipio)
                                        WHERE sp.radicado = '$d1'
                                        GROUP BY cp.descripcion,pa.cedula
                                        ORDER BY pa.nombre" );
            $listar->execute();
            return $listar;
    }
    public function get_datos_proceso_anotacion(){
            $id     = trim($_GET['id']);
            //$listar = $this->db->prepare("SELECT * FROM documentos_internos WHERE id = '$id'");
            $listar = $this->db->prepare("SELECT sp.id,sp.radicado,sp.radicadosignotanterior FROM signot_proceso sp
                                  WHERE sp.id = '$id'");
            $listar->execute();
            return $listar;

    }
    public function get_datos_proceso_anotacion_2($id){
            $listar = $this->db->prepare("SELECT spa.id,spa.idradicado,pu.empleado,spa.fecha,spa.hora,spa.anotacion,ta.destipo
                                            FROM ((signot_proceso_anotacion spa INNER JOIN pa_usuario pu ON spa.idusuario = pu.id)
                                            LEFT JOIN signot_pa_tipo_anotacion ta ON ta.id = spa.idtipoanotacion)
                                            WHERE spa.idradicado = '$id' ORDER BY spa.id DESC");
            $listar->execute();
            return $listar;
    }
    //FASE (1,2,3,4,5), PARA OBTENER ESTA INFORMACION SE DEBE SACAR UNA COPIA DE
    //SEGURIDAD DE LAS TABLAS fase1,fase2,fase3,fase4,fase5
    //DE LA BASE DE DATOS NOTIFICACIONESS DEL SIGNOT ANTERIOR
    public function get_datos_proceso_fase($idfase,$id_proceso,$id_procesosignotanterior){
            if($idfase == 1){

                $listar = $this->db->prepare("SELECT r.id_proceso,
                                                CONCAT('Cedula Parte: ',f1.cedula,'*** Observacion: ',f1.observa,
                                                '*** fecha retiro citacion: ',f1.fecha_retiro_citacion,
                                                '*** fecha envio cotejo citacion: ',f1.fecha_envio_cotejo_citacion,
                                                '*** fecha recepcion cotejo citacion: ',f1.fecha_recepcion_cotejo_citacion,
                                                '*** fecha acuse citacion: ',f1.fecha_acuse_citacion,
                                                '*** fecha recepcion acuse citacion: ',f1.fecha_recepcion_acuse_citacion) AS FASE1
                                            FROM (radicacion r LEFT JOIN fase1 f1 ON r.id_proceso = f1.id_proceso)
                                            WHERE (r.id_proceso = '$id_proceso' OR r.id_proceso = '$id_proceso')
                                            GROUP BY FASE1");

            }
            if($idfase == 2){
                $listar = $this->db->prepare("SELECT r.id_proceso,
                                                CONCAT(
                                                'Cedula Parte: ',f2.cedula,'*** Observacion Notificacion: ',f2.observaciones_notificacion,
                                                '*** Quien Recibe En Juzgado y/u observaciones: ',f2.nombre_observaciones,
                                                '*** fecha_notificacion_personal: ',f2.fecha_notificacion_personal,
                                                '*** fecha_recibido_notificacion: ',f2.fecha_recibido_notificacion) AS FASE2
                                            FROM (radicacion r LEFT JOIN fase2 f2 ON r.id_proceso = f2.id_proceso)
                                            WHERE (r.id_proceso = '$id_proceso' OR r.id_proceso = '$id_proceso')
                                            GROUP BY FASE2");
            }
            if($idfase == 3){
                $listar = $this->db->prepare("SELECT r.id_proceso,
                                                CONCAT('Cedula Parte: ',f3.cedula,'*** Quien Retira y/u Observaciones: ',f3.nombre_observaciones_retira,
                                                '*** Quien Recibe En Juzgado y/u observaciones: ',f3.nombre_observaciones_recibe,
                                                '*** fecha_elaboracion_aviso: ',f3.fecha_elaboracion_aviso,
                                                '*** fecha_retiro_aviso: ',f3.fecha_retiro_aviso,
                                                '*** fecha_envio_cotejo_aviso: ',f3.fecha_envio_cotejo_aviso,
                                                '*** fecha_recepcion_cotejo_aviso: ',f3.fecha_recepcion_cotejo_aviso,
                                                '*** ffecha_acuse_aviso: ',f3.fecha_acuse_aviso,
                                                '*** fecha_recepcion_acuse_aviso: ',f3.fecha_recepcion_acuse_aviso,
                                                '*** fecha_retiro_anexos: ',f3.fecha_retiro_anexos,
                                                '*** fecha_recepcion_termino: ',f3.fecha_recepcion_termino) AS FASE3
                                            FROM (radicacion r LEFT JOIN fase3 f3 ON r.id_proceso = f3.id_proceso)
                                            WHERE (r.id_proceso = '$id_proceso' OR r.id_proceso = '$id_proceso')
                                            GROUP BY FASE3");
            }
            if($idfase == 4){
                $listar = $this->db->prepare("  SELECT r.id_proceso,
                                                CONCAT('Motivo: ',f4.motivo,'*** Documento Anexo:',f4.documento_anexo,'*** Recibe: ',f4.nombre_recibe,
                                                '*** fecha_devolucion_correo_cpersonal: ',f4.fecha_devolucion_correo_cpersonal,
                                                '*** fecha_recibido_juzgado: ',f4.fecha_recibido_juzgado) AS FASE4
                                                FROM (radicacion r LEFT JOIN fase4 f4 ON r.id_proceso = f4.id_proceso)
                                                WHERE (r.id_proceso = '$id_proceso' OR r.id_proceso = '$id_proceso')
                                                GROUP BY FASE4");
            }
            if($idfase == 5){
                $listar = $this->db->prepare("SELECT r.id_proceso,
                                                CONCAT('Cedula Parte: ',f5.cedula,'*** Nombre Con Quien Se Hablo Y Fecha De Gestion De Llamada y Comentario: ',f5.detalles_llamada,
                                                '*** Alerta: ',f5.alerta) AS FASE5
                                            FROM (radicacion r LEFT JOIN fase5 f5 ON r.id_proceso = f5.id_proceso)
                                            WHERE (r.id_proceso = '$id_proceso' OR r.id_proceso = '$id_procesosignotanterior')
                                            GROUP BY FASE5");
            }
            $listar->execute();
            return $listar;
    }
    public function registrar_documentos_salientes(){
            //SE OBTIENEN LOS DATOS
            $idusuario     = $_SESSION['idUsuario'];
            $consecutivodocumento = trim($_POST['consecutivodocumento']);
            //VARIABLE QUE MANEJA EL INSERT O UPDATE DE UN NUEVO DOCUMENTO
            $iddocumento   = trim($_POST['iddocumento']);

            $tipodocumento = trim($_POST['tipodocumento']);
            $ndocumento    = trim($_POST['ndocumento']);
            $dirigidoa     = trim($_POST['dirigidoa']);
            $nombre        = trim($_POST['nombre']);
            $cargo         = trim($_POST['cargo']);
            $dependencia   = trim($_POST['dependencia']);
            $fechag        = trim($_POST['fechag']);
            $asunto        = utf8_encode(trim($_POST['asunto']));
            $detalleds     = utf8_encode(trim($_POST['detalleds']));
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new sigdocModel();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            $tiporegistro = "Salida de Documento";

            if( empty($iddocumento) ){
                $accion  = "Registra una Nueva ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS SALIENTES";
            }
            else{
                $accion  = "Modifica una ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS SALIENTES, ID DOCUMENTO: ".$iddocumento;
            }
            $detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog = 4;
            try {
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //EMPIEZA LA TRANSACCION
                $this->db->beginTransaction();
                //CAPTURO EL MAXIMO DEL CAMPO numero PARA DETERMINAR QUE CONSECUTIVO DEBE ARMARSE
                //PARA EL SIGUIENTE TIPO DE DOCUMENTO, YA QUE SI EL CONTADOR DE LA TABLA sigdoc_pa_consecutivo
                //VA EN 5 Y SI DOS USUARIOS ENRAN AL MISMO TIEMPO Y ESCOGEN TIPO DOCUMENTO OFICIO
                //SALE EN Numero Documento: CSJCF15-005 PARA AMBOS Y AL REGISTRAR CADA UNO
                //QUEDA EN LA TABLA sigdoc_documentos_internos DOS DOCUMENTOS CON EL MISMO NUMERO
                //PARA SE RECONSTRUYO EL CONSECUTIVO CON LO MENCIONADO ANTERIORMENTE, ACTUALIZANDO LA VARIABLE $ndocumento
                //QUE ES LA QUE RECIBE EL CONSECUTIVO INICIAL DE LA VISTA sigdoc_documentos_salientes.php
                //Y ACTUALIZAMOS DE LA TABLA sigdoc_pa_consecutivo LA COLUMNA contador, ESTE DATO TAMBIEN DEBE RECOSTRUIRSE
                //PASA DE $consecutivodocumento A $consecutivo
                //SE CAMBIA LA SQL YA QUE SE NECESITABA LAS SIGLAS
                /*$listar = $this->db->prepare("SELECT MAX(id) AS idmaximo,numero
                                                FROM sigdoc_documentos_internos
                                                WHERE id IN(SELECT MAX(id) AS idmaximo FROM sigdoc_documentos_internos WHERE idtipodocumento = '$tipodocumento' )
                                                AND idtipodocumento = '$tipodocumento'");*/
                $listar = $this->db->prepare("SELECT MAX(di.id) AS idmaximo,di.numero,dc.sigla
                                                FROM (sigdoc_documentos_internos di INNER JOIN sigdoc_pa_consecutivo dc ON di.idtipodocumento = dc.idtipodocumento)
                                                WHERE di.id IN(
                                                    SELECT MAX(di.id) AS idmaximo
                                                    FROM (sigdoc_documentos_internos di INNER JOIN sigdoc_pa_consecutivo dc ON di.idtipodocumento = dc.idtipodocumento)
                                                    WHERE di.idtipodocumento = '$tipodocumento'
                                                )
                                                AND di.idtipodocumento = '$tipodocumento'");
                $listar->execute();
                /*$field = $listar->fetch();
                $numeroconsecutivo = explode("-",$field[numero]);
                $consecutivo       = $numeroconsecutivo[1] + 1;
                if($consecutivo >= 0 && $consecutivo <= 9) {$consecutivo = "00".$consecutivo;}
                if($consecutivo >  9 && $consecutivo <= 99){$consecutivo = "0".$consecutivo;}
                $ndocumento        = $numeroconsecutivo[0]."-".$consecutivo;*/
                $resultado = $listar->rowCount();
                if(!$resultado){//existe registros

                    $field = $listar->fetch();

                    $numeroconsecutivo = explode("-",$field[numero]);
                    $consecutivo       = $numeroconsecutivo[1] + 1;

                    if($consecutivo >= 0 && $consecutivo <= 9) {$consecutivo = "00".$consecutivo;}
                    if($consecutivo >  9 && $consecutivo <= 99){$consecutivo = "0".$consecutivo;}
                    $ndocumento        = $numeroconsecutivo[0]."-".$consecutivo;
                }else{
                    ////no existe registro, Y SE DEBE CONSTRUIR EL CONSECUTIVO CON LAS SIGLAS Y EL A�O YA QUE LOS DATOS EN LA TABLA
                    //documentos_internos SON NULL Y EL NUEMRO QUEDARIA DE ESTA FORMA -001,-002
                    $field = $listar->fetch();
                    $year  = $modelo->get_ano();
                    $numeroconsecutivo = explode("-",$field[numero]);
                    $consecutivo       = $numeroconsecutivo[1] + 1;
                    if($consecutivo >= 0 && $consecutivo <= 9) {$consecutivo = "00".$consecutivo;}
                    if($consecutivo >  9 && $consecutivo <= 99){$consecutivo = "0".$consecutivo;}
                    $ndocumento        = $field[sigla]."".$year."-".$consecutivo;
                }
                //---------------------------------------------------------------------------------------------------------------------------------------------------
                if( empty($iddocumento) ){
                    $this->db->exec("INSERT INTO sigdoc_documentos_internos (idusuario,idusuarioedita,identrada,idtipodocumento,numero,dirigidoa,nombre,cargo,dependencia,
                                        fechageneracion,fechaedita,asunto,contenido)
                                    VALUES ('$idusuario',0,0,'$tipodocumento','$ndocumento','$dirigidoa','$nombre','$cargo','$dependencia','$fechag','0000-00-00',
                                        '$asunto','$detalleds')");
                    //$this->db->exec("UPDATE sigdoc_pa_consecutivo SET contador = '$consecutivodocumento' WHERE idtipodocumento = '$tipodocumento'");
                    $this->db->exec("UPDATE sigdoc_pa_consecutivo SET contador = '$consecutivo' WHERE idtipodocumento = '$tipodocumento'");
                }else{
                    $this->db->exec("UPDATE sigdoc_documentos_internos
                                    SET dirigidoa = '$dirigidoa',nombre = '$nombre',cargo = '$cargo',
                                        dependencia = '$dependencia',asunto = '$asunto',contenido = '$detalleds',
                                        idusuarioedita = '$idusuario',fechaedita = '$fechalog'
                                    WHERE id = '$iddocumento'");
                }
                //$this->db->exec("UPDATE sigdoc_pa_consecutivo SET contador = '$consecutivodocumento' WHERE idtipodocumento = '$tipodocumento'");
                $this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
                //SE TERMINA LA TRANSACCION
                $this->db->commit();
                print'<script languaje="Javascript">location.href="index.php?controller=sigdoc&action=mensajes&nombre=2"</script>';
            } catch (Exception $e) {
                //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
                $this->db->rollBack();
                //echo "Fallo: " . $e->getMessage();
                print'<script languaje="Javascript">location.href="index.php?controller=sigdoc&action=mensajes&nombre=2b"</script>';
            }
    }

    public function registrar_respuesta_documento(){
            //SE OBTIENEN LOS DATOS
            $idusuario     = $_SESSION['idUsuario'];
            $consecutivodocumento = trim($_POST['consecutivodocumento']);

            //VARIABLE QUE MANEJA EL INSERT O UPDATE DE UN NUEVO DOCUMENTO
            //$iddocumento   = trim($_POST['iddocumento']);

            //VARIABLE QUE MANEJA CUANDO SE LE DA RESPUESTA A UN DOCUMENTO
            $idrespuesta   = trim($_POST['idrespuesta']);

            $tipodocumento = trim($_POST['tipodocumento']);
            $ndocumento    = trim($_POST['ndocumento']);
            $dirigidoa     = trim($_POST['dirigidoa']);
            $nombre        = trim($_POST['nombre']);
            $cargo         = trim($_POST['cargo']);
            $dependencia   = trim($_POST['dependencia']);
            $fechag        = trim($_POST['fechag']);
            $asunto        = utf8_encode(trim($_POST['asunto']));
            $detalleds     = utf8_encode(trim($_POST['detalleds']));

            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new sigdocModel();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];

            $tiporegistro = "Respuesta de Documento";

            $accion  = "Registra una ".$tiporegistro." En el Sistema (SIGDOC), ID DOCUMENTO: ".$idrespuesta;

            $detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog = 4;
            try {
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //EMPIEZA LA TRANSACCION
                $this->db->beginTransaction();
                $this->db->exec("INSERT INTO sigdoc_documentos_internos (idusuario,idusuarioedita,identrada,idtipodocumento,numero,dirigidoa,nombre,cargo,dependencia,
                                    fechageneracion,fechaedita,asunto,contenido)
                                    VALUES ('$idusuario',0,'$idrespuesta','$tipodocumento','$ndocumento','$dirigidoa','$nombre','$cargo','$dependencia','$fechag','0000-00-00',
                                    '$asunto','$detalleds')");

                $this->db->exec("UPDATE sigdoc_pa_consecutivo SET contador = '$consecutivodocumento' WHERE idtipodocumento = '$tipodocumento'");
                $this->db->exec("UPDATE sigdoc_documentos_entrantes SET fecharespuesta = '$fechalog',idusuarioedita = '$idusuario',fechaedita = '$fechalog'
                                WHERE id = '$idrespuesta'");
                $this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
                //SE TERMINA LA TRANSACCION
                $this->db->commit();
                print'<script languaje="Javascript">location.href="index.php?controller=sigdoc&action=mensajes&nombre=2"</script>';
            } catch (Exception $e) {
                //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
                $this->db->rollBack();
                //echo "Fallo: " . $e->getMessage();
                print'<script languaje="Javascript">location.href="index.php?controller=sigdoc&action=mensajes&nombre=2b"</script>';
            }
    }
    public function get_datos_documentos(){

            $id     = trim($_GET['id']);
            $listar = $this->db->prepare("SELECT * FROM sigdoc_documentos_internos WHERE id = '$id'");
            $listar->execute();
            return $listar;
    }
    public function get_datos_idradicado($rad){
            //$rad     = trim($_GET['id']);
            $listar = $this->db->prepare("SELECT * FROM signot_proceso WHERE radicado = '$rad '");
            $listar->execute();
            return $listar;
    }
    //*******************************************************************************************************************************************************
    //PARA DOCUMENTOS ENTRANTES
    public function get_documentos_entrantes_usuario($identrada){
            $idusuario  = $_SESSION['idUsuario'];
            if($identrada == 1){
                /*$listar    = $this->db->prepare("SELECT rds.id,rds.fecha,rds.fecharespuesta,rds.hora,rds.remitente,td.nombre_tipo_documento,rds.numero,rds.asunto
                                                    FROM (sigdoc_documentos_entrantes rds LEFT JOIN sigdoc_pa_tipodocumento td ON rds.idtipodocumento = td.id)
                                                    ORDER BY rds.id DESC");*/
                $listar    = $this->db->prepare("SELECT rds.id,rds.fecha,rds.fecharespuesta,rds.hora,rds.remitente,td.nombre_tipo_documento,rds.numero,rds.asunto,
                                                    pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita
                                                    FROM (((sigdoc_documentos_entrantes rds LEFT JOIN sigdoc_pa_tipodocumento td ON rds.idtipodocumento = td.id)
                                                    LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
                                                    LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
                                                    ORDER BY rds.id DESC");
            }
            if($identrada == 2){
                $filtrox;

                $filtrof;
                $filtro1;
                $filtro2;
                $filtro3;
                $filtro4;
                $filtro5;

                $fechad    = trim($_GET['dato_1']);
                $fechah    = trim($_GET['dato_2']);

                $datox1    = trim($_GET['datox1']);
                $datox2    = trim($_GET['datox2']);
                $datox3    = trim($_GET['datox3']);
                $datox4    = trim($_GET['datox4']);
                $datox5    = trim($_GET['datox5']);
                if ( !empty($fechad) && !empty($fechah) ) {
                    $filtrof = " AND (rds.fecha >= '$fechad' AND rds.fecha <= '$fechah') ";
                }
                if ( !empty($datox1) ) {
                    $filtro1 = " AND rds.idtipodocumento = '$datox1' ";
                }
                if ( !empty($datox2) ) {
                    $filtro2 = " AND rds.numero = '$datox2' ";
                }
                if ( !empty($datox3) ) {
                    $filtro3 = " AND rds.remitente LIKE '%$datox3%' ";
                }
                if ( !empty($datox4) ) {
                    $filtro4 = " AND rds.asunto LIKE '%$datox4%' ";
                }
                if ( !empty($datox5) ) {
                    $filtro5 = " AND rds.id = '$datox5' ";
                }
                $filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtrof;
                //echo $filtrox;
                /*$listar    = $this->db->prepare("SELECT rds.id,rds.fecha,rds.fecharespuesta,rds.hora,rds.remitente,td.nombre_tipo_documento,rds.numero,rds.asunto
                                                    FROM (sigdoc_documentos_entrantes rds LEFT JOIN sigdoc_pa_tipodocumento td ON rds.idtipodocumento = td.id)
                                                    WHERE rds.id >= '1'" .$filtrox. "
                                                    ORDER BY rds.id DESC");*/

                $listar    = $this->db->prepare("SELECT rds.id,rds.fecha,rds.fecharespuesta,rds.hora,rds.remitente,td.nombre_tipo_documento,rds.numero,rds.asunto,
                                                    pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita
                                                    FROM (((sigdoc_documentos_entrantes rds LEFT JOIN sigdoc_pa_tipodocumento td ON rds.idtipodocumento = td.id)
                                                    LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
                                                    LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
                                                    WHERE rds.id >= '1'" .$filtrox. "
                                                    ORDER BY rds.id DESC");
            }
            $listar->execute();
            return $listar;
    }
    public function registrar_documentos_entrantes(){
            //VARIABLE QUE MANEJA EL INSERT O UPDATE DE UN NUEVO DOCUMENTO ENTRANTE
            $iddocumento   = trim($_POST['iddocumento']);
            //SE OBTIENEN LOS DATOS
            $idusuario     = $_SESSION['idUsuario'];
            $fechae        = trim($_POST['fechae']);
            $horae         = trim($_POST['horae']);
            $remitente     = utf8_encode(trim($_POST['remitente']));
            $tipodocumento = trim($_POST['tipodocumento']);
            $numerodoce    = trim($_POST['numerodoce']);
            $asunto        = utf8_encode(trim($_POST['asunto']));
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new sigdocModel();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];

            $tiporegistro = "Entrada de Documento";
            if( empty($iddocumento) ){
                $accion  = "Registra una Nueva ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS ENTRANTES";
            }else{
                $accion  = "Modifica una ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS ENTRANTES, ID DOCUMENTO: ".$iddocumento;
            }
            $detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog = 4;
            try {
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //EMPIEZA LA TRANSACCION
                $this->db->beginTransaction();
                if( empty($iddocumento) ){
                    $this->db->exec("INSERT INTO sigdoc_documentos_entrantes (idusuario,idusuarioedita,fecha,fecharespuesta,fechaedita,hora,remitente,idtipodocumento,
                                        numero,asunto)
                                    VALUES ('$idusuario',0,'$fechae','0000-00-00','0000-00-00','$horae','$remitente','$tipodocumento','$numerodoce','$asunto')");
                }else{
                    $this->db->exec("UPDATE sigdoc_documentos_entrantes SET remitente = '$remitente',numero = '$numerodoce',asunto = '$asunto',
                                        idusuarioedita = '$idusuario',fechaedita = '$fechalog'
                                    WHERE id = '$iddocumento'");

                }
                $this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
                //SE TERMINA LA TRANSACCION
                $this->db->commit();
                print'<script languaje="Javascript">location.href="index.php?controller=sigdoc&action=mensajes&nombre=4"</script>';
            } catch (Exception $e) {
                //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
                $this->db->rollBack();
                //echo "Fallo: " . $e->getMessage();
                print'<script languaje="Javascript">location.href="index.php?controller=sigdoc&action=mensajes&nombre=4b"</script>';
            }
    }

    public function get_datos_documentos_entrantes(){
            $id     = trim($_GET['id']);
            $listar = $this->db->prepare("SELECT * FROM sigdoc_documentos_entrantes WHERE id = '$id'");
            $listar->execute();
            return $listar;
    }
    //**************** FUNCIONES ESPECIALES **********************************************
    //-------------------------------------------------------------------------------
    //PARA CALCULAR LOS DIAS DE RESPUESTA DE UN DOCUMENTO
    public function Dias_Respuesta($fecharegistro,$fecharespuesta){
            require_once('funciones/Festivos.php');
            $dias_diferencia = 0;
            if($fecharespuesta != "0000-00-00"){
                //FECHA INCIAL
                $inicio    = new DateTime($fecharegistro);
                //Un d�a es P1D,Dos d�as es P2D,
                //es decir que si la fecha inicial es 2015-05-19 y la final es 2015-05-27
                //el intervalos iria de 2015-05-19 2015-05-20 2015-05-21 2015-05-22 2015-05-23 2015-05-24 2015-05-25 2015-05-26
                $intervalo = new DateInterval('P1D');
                //FECHA FINAL
                $fin       = new DateTime($fecharespuesta);
                //CREO EL PERIODO SEGUN LOS DATOS ANTERIORES
                $periodo   = new DatePeriod($inicio,$intervalo,$fin);
                foreach ($periodo as $fecha) {
                    //echo $fecha->format('Y-m-d')."\n";
                    //$dias_diferencia = $dias_diferencia." ".$fecha->format('Y-m-d')."\n";

                    //OBTENGO FECHA A FECHA, DESDE LA INCIAL A LA FINAL Y CAPTURO SU A�O,MES,DIA
                    $fechaperiodo = explode("-",$fecha->format('Y-m-d'));
                    $y            = trim($fechaperiodo[0]);
                    $m            = trim($fechaperiodo[1]);
                    $d            = trim($fechaperiodo[2]);
                    //OBTENGO EL DIA SEGUN LA FECHA PASADA A $fechaperiodo CON SUS PARTES A�O,MES,DIA
                    $date         = date('D', mktime(0,0,0,$m,$d,$y));
                    //PARA DIAS FESTIVOS, SE INSTANCIA LA CLASE Y SE LLAMA LA FUNCION PARA SABER SI UN DIA ES FESTIVO
                    $dias_festivos = new festivos($y);
                    $esfestivo     = $dias_festivos->esFestivo($d,$m);
                    //SE REALIZA LA PREGUNTA SI ES SABADO, DOMINGO O FESTIVO
                    //PARA NO INCREMENTAR $dias_diferencia
                    if($date == 'Sat' or $date == 'Sun' or $esfestivo == 1){
                        $bandera = 0;
                    }else{
                        $dias_diferencia = $dias_diferencia + 1;
                    }
                    //$dias_diferencia = $dias_diferencia." ".$date."\n";
                }
            }else{
                $dias_diferencia = "-";
            }
            return $dias_diferencia;
    }
    public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
            $listar     = $this->db->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
            $listar->execute();
            return $listar;
    }
    public function registrar_proceso(){
            //SE OBTIENEN LOS DATOS
            $idusuario       = $_SESSION['idUsuario'];
            $radicadox       = trim($_POST['radicadox']);

            $juzgadoorigen   = explode("-",trim($_POST['juzgadoorigen']));
            $idjuzgadoorigen = $juzgadoorigen[0];

            $idclasejuzgado   = trim($_POST['idclasejuzgado']);
            $idclaseproceso   = trim($_POST['idclaseproceso']);
            $iddepartamento   = trim($_POST['iddepartamento']);
            $idmunicipio      = trim($_POST['idmunicipio']);
            $claseproceso2    = trim($_POST["claseproceso2"]);
            $entidadcomisiona = trim($_POST["entidadcomisiona"]);
            $asunto           = trim($_POST["asunto"]);
            $despacholibra    = trim($_POST["despacholibra"]);

            //OBTENEMOS DEL RADICADO 170014003 006 19931018000
            //CLASE JUZGADO 4003, DEPARTAMENTO 17, MUNICIPIO 17001
            /*$idclasejuzgado = substr($radicadox, 5, 4);
            $iddepartamento = substr($radicadox, 1, 2);
            $idmunicipio    = substr($radicadox, 1, 5);*/
            $datospartes      = trim($_POST['datospartes']);
            $datosadicionales = trim($_POST['datosadicionales']);
            $modelo     = new signotModel();
            //PARA DETERMINAR SI UN CLASE PARTE ESTA EN EL VECTOR DONDE SE LE GENERA UNA CITACION
            //SE USA LA MISMA FUNCION DE get_lista_usuario_acciones, PARA NO CREAR OTRA FUNCION
            $campos               = 'idtabla';
            $nombrelista          = 'pa_modulo_acciones';
            $idaccion             = '1';
            $campoordenar         = 'id';
            $datosmoduloacciones  = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
            $idacciones           = $datosmoduloacciones->fetch();
            $modulosacciones      = explode("////",$idacciones[idtabla]);
            //DATOS PARA EL REGISTRO DEL LOG
            //$modelo     = new signotModel();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            $tiporegistro = "Proceso";
            if( empty($iddocumento) ){
                $accion  = "Registra un Nuevo ".$tiporegistro." En el Sistema (SIGNOT), PROCESO: ".$radicadox;
            }else{
                //$accion  = "Modifica una ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS ENTRANTES, ID PROCESO: ".$iddocumento;
            }
            $detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog = 6;
            try {
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //EMPIEZA LA TRANSACCION
                $this->db->beginTransaction();
                /*$this->db->exec("INSERT INTO signot_prueba (cedula,datos)
                                    VALUES ('$cedula','$datospartes')");*/
                $this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");

                $this->db->exec("INSERT INTO signot_proceso (radicado,fecharegistro,idjuzgadoorigen,idclasejuzgado,idclaseproceso,iddepartamento,idmunicipio,idusuarioregistra,idusuarioedita,iddevolucion,claseproceso2,entidadcomisiona,asunto,despacholibra)
                                    VALUES ('$radicadox','$fechalog','$idjuzgadoorigen','$idclasejuzgado','$idclaseproceso','$iddepartamento','$idmunicipio','$idusuario',0,0,'$claseproceso2','$entidadcomisiona','$asunto','$despacholibra')");
                //OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA signot_proceso
                $lastIdProceso  = $this->db->lastInsertId();
                //******75088165//////Jorge Andres Valencia//////Cr 21 # 46 A 82//////8855934//////1-DEMANDANTE//////17-Caldas//////17001-MANIZALES******
                //75095585//////Andres Grajales//////Cr 213 # 748 B 434//////8875632//////1-DEMANDANTE//////13-Bolivar//////13001-CARTAGENA
                //1 EXPLODE
                $datospartes_1 = explode("******",$datospartes);
                $longitud_1    = count($datospartes_1);
                $i             = 1;
                $longpartes = $longitud_1 - 1;
                $anotacion = "SE REALIZA EL REGISTRO DEL PROCESO EN EL SISTEMA, FECHA: ".$fechalog." "."a las: ".$horalog.
                             " CON NUMERO DE PARTES: ".$longpartes.", ID DEL PROCESO: ".$lastIdProceso;

                $this->db->exec("INSERT INTO signot_proceso_anotacion (idradicado,idusuario,fecha,hora,anotacion)
                                    VALUES ('$lastIdProceso','$idusuario','$fechalog','$horalog','$anotacion')");
                while($i < $longitud_1){
                    //2 EXPLODE
                    $datospartes_2 = explode("//////",$datospartes_1[$i]);

                    $cedulaparte  = $datospartes_2[0];
                    $nombreparte  = $datospartes_2[1];

                    $direccion    = $datospartes_2[2];
                    $telefono     = $datospartes_2[3];

                    $idclaseparte   = explode("-",$datospartes_2[4]);
                    $idclaseparte_2 = $idclaseparte[0];
                    //SE PREGUNTA SI LA CLASE PARTE ESTA DENTRO DEL VECTOR DE PARTES PARA GENERAR CITACION Y ASIGNAR
                    //LA FECHA REGISTRO, FECHA AUTO Y AUTO ANOTIFICAR
                    //PARA CREAR UN REGISTRO EN LA TABLA signot_auto_parte
                    //if($idclaseparte_2 == 2){
                    /*if ( in_array($idclaseparte_2,$modulosacciones) ) {
                        $fecharegistroclase = $datospartes_2[7];
                        $fechaautoclase     = $datospartes_2[8];

                        $idauto             = explode("-",$datospartes_2[9]);
                        $idauto_2           = $idauto[0];
                    }*/
                    $iddepartamento   = explode("-",$datospartes_2[5]);
                    $iddepartamento_2 = $iddepartamento[0];

                    $idmunicipio      = explode("-",$datospartes_2[6]);
                    $idmunicipio_2    = $idmunicipio[0];

                    //IDENTIFICAMOS QUE UNA PARTE YA EXISTA EN LA TABLA signot_parte
                    //PARA NO VOLVER A REGISTRAR, SI NO ACTUALIZAR SUS DATOS
                    $listar = $this->db->prepare("SELECT * FROM signot_parte WHERE cedula = '$cedulaparte' AND nombre = '$nombreparte'");
                    $listar->execute();
                    $resultado = $listar->rowCount();
                    if(!$resultado){//NO EXISTE PARTE
                        //$iddocumento = 0;
                        $this->db->exec("INSERT INTO signot_parte (cedula,nombre,datosadicionales,idusuarioregistra,idusuarioedita)
                                        VALUES ('$cedulaparte','$nombreparte','$datosadicionales','$idusuario',0)");
                        //OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA signot_proceso
                        $lastIdParte  = $this->db->lastInsertId();
                        //IDENTIFICAMOS QUE UNA PARTE YA EXISTA EN LA TABLA signot_parteproceso
                        //EN EL MISMO PROCESO CON IGUAL CLASE DE PARTE (DEMANDANTE, DEMANDADO ETC....)
                        //YA QUE SI EXISTE NO SE ACTUALIZA, SOLO SE REGISTRA SI NO EXISTE
                        $listar = $this->db->prepare("SELECT * FROM signot_parteproceso
                                                      WHERE idproceso = '$lastIdProceso' AND idparte = '$lastIdParte' AND idclaseparte = '$idclaseparte_2'");
                        $listar->execute();
                        $resultado = $listar->rowCount();
                        if(!$resultado){//NO EXISTE REGISTRO
                            $this->db->exec("INSERT INTO signot_parteproceso (idproceso,idparte,idclaseparte,idusuarioregistra)
                                            VALUES ('$lastIdProceso','$lastIdParte','$idclaseparte_2','$idusuario')");
                        }
                        //IDENTIFICAMOS QUE UNA DIRECCION YA EXISTA EN LA TABLA signot_direccion
                        //PARA NO REGISTRARLA NUEVAMENTE
                        $listar = $this->db->prepare("SELECT * FROM signot_direccion
                                                    WHERE idparte = '$lastIdParte' AND idproceso = '$lastIdProceso'
                                                    AND telefono = '$telefono' AND direccion = '$direccion'
                                                    AND iddepartamento = '$iddepartamento_2' AND idmunicipio = '$idmunicipio_2'");
                        $listar->execute();
                        $resultado = $listar->rowCount();
                        if(!$resultado){//NO EXISTE REGISTRO
                            $this->db->exec("INSERT INTO signot_direccion (idparte,idproceso,telefono,direccion,iddepartamento,idmunicipio,idusuarioregistra,idusuarioedita)
                                            VALUES ('$lastIdParte','$lastIdProceso','$telefono','$direccion','$iddepartamento_2','$idmunicipio_2','$idusuario',0)");
                        }
                        ////SE PREGUNTA SI LA CLASE PARTE ESTA DENTRO DEL VECTOR DE PARTES PARA GENERAR CITACION Y ASIGNAR
                        //LA FECHA REGISTRO, FECHA AUTO Y AUTO ANOTIFICAR
                        //PARA CREAR UN REGISTRO EN LA TABLA signot_auto_parte PARA CREAR UN AUTO, SI YA TIENE UN AUTO REGISTRADO
                        //CON EL PROCESO NO SE CREA OTRO
                        //NOTA: PARA NO AMARRAR QUE UNA PARTE TENGA UN SOLO TIPO DE AUTO EN UN PROCESO
                        //SIMPLEMENTE SE APLICA EL INSERT SIN EL SELECT
                        //if($idclaseparte_2 == 2){
                        /*if ( in_array($idclaseparte_2,$modulosacciones) ) {
                            $listar = $this->db->prepare("SELECT * FROM signot_auto_parte
                                                      WHERE idparte = '$lastIdParte' AND idproceso = '$lastIdProceso'");
                            $listar->execute();
                            $resultado = $listar->rowCount();
                            if(!$resultado){//NO EXISTE REGISTRO
                                $this->db->exec("INSERT INTO signot_auto_parte (idparte,idproceso,idauto,fecharegistroauto,fechaauto,idusuarioregistra,idusuarioedita,descorrecion)
                                                VALUES ('$lastIdParte','$lastIdProceso','$idauto_2','$fecharegistroclase','$fechaautoclase','$idusuario',0,'')");
                            }
                        }*/
                    }else{//EXISTE PARTE
                        $iddocumento = 1;
                        $fila        = $listar->fetch();
                        $idparte     = $fila[id];

                        $this->db->exec("UPDATE signot_parte SET nombre = '$nombreparte',datosadicionales = '$datosadicionales',idusuarioedita = '$idusuario' WHERE cedula = '$cedulaparte'");
                        //IDENTIFICAMOS QUE UNA PARTE YA EXISTA EN LA TABLA signot_parteproceso
                        //EN EL MISMO PROCESO CON IGUAL CLASE DE PARTE (DEMANDANTE, DEMANDADO ETC....)
                        //YA QUE SI EXISTE NO SE ACTUALIZA, SOLO SE REGISTRA SI NO EXISTE
                        $listar = $this->db->prepare("SELECT * FROM signot_parteproceso
                                                      WHERE idproceso = '$lastIdProceso' AND idparte = '$idparte' AND idclaseparte = '$idclaseparte_2'");
                        $listar->execute();
                        $resultado = $listar->rowCount();
                        if(!$resultado){//NO EXISTE REGISTRO
                            $this->db->exec("INSERT INTO signot_parteproceso (idproceso,idparte,idclaseparte,idusuarioregistra)
                                            VALUES ('$lastIdProceso','$idparte','$idclaseparte_2','$idusuario')");
                        }
                        //IDENTIFICAMOS QUE UNA DIRECCION YA EXISTA EN LA TABLA signot_direccion
                        //PARA NO REGISTRARLA NUEVAMENTE
                        $listar = $this->db->prepare("SELECT * FROM signot_direccion
                                                      WHERE idparte = '$idparte' AND idproceso = '$lastIdProceso'
                                                        AND telefono = '$telefono' AND direccion = '$direccion'
                                                        AND iddepartamento = '$iddepartamento_2' AND idmunicipio = '$idmunicipio_2'");

                        $listar->execute();
                        $resultado = $listar->rowCount();
                        if(!$resultado){//NO EXISTE REGISTRO
                            $this->db->exec("INSERT INTO signot_direccion (idparte,idproceso,telefono,direccion,iddepartamento,idmunicipio,idusuarioregistra,idusuarioedita)
                                            VALUES ('$idparte','$lastIdProceso','$telefono','$direccion','$iddepartamento_2','$idmunicipio_2','$idusuario',0)");
                        }
                        ////SE PREGUNTA SI LA CLASE PARTE ESTA DENTRO DEL VECTOR DE PARTES PARA GENERAR CITACION Y ASIGNAR
                        //LA FECHA REGISTRO, FECHA AUTO Y AUTO ANOTIFICAR
                        //PARA CREAR UN REGISTRO EN LA TABLA signot_auto_parte PARA CREAR UN AUTO, SI YA TIENE UN AUTO REGISTRADO
                        //CON EL PROCESO NO SE CREA OTRO
                        //NOTA: PARA NO AMARRAR QUE UNA PARTE TENGA UN SOLO TIPO DE AUTO EN UN PROCESO
                        //SIMPLEMENTE SE APLICA EL INSERT SIN EL SELECT
                        //if($idclaseparte_2 == 2){
                        /*if ( in_array($idclaseparte_2,$modulosacciones) ) {
                            $listar = $this->db->prepare("SELECT * FROM signot_auto_parte
                                                      WHERE idparte = '$idparte' AND idproceso = '$lastIdProceso'");
                            $listar->execute();
                            $resultado = $listar->rowCount();
                            if(!$resultado){//NO EXISTE REGISTRO
                                $this->db->exec("INSERT INTO signot_auto_parte (idparte,idproceso,idauto,fecharegistroauto,fechaauto,idusuarioregistra,idusuarioedita,descorrecion)
                                                VALUES ('$idparte','$lastIdProceso','$idauto_2','$fecharegistroclase','$fechaautoclase','$idusuario',0,'')");
                            }
                        }*/
                    }
                    $i = $i + 1;
                }
                //SE TERMINA LA TRANSACCION
                $this->db->commit();
                print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=4"</script>';

            } catch (Exception $e) {
                //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
                $this->db->rollBack();
                /*echo "iddocumento:".$iddocumento." id parte:".$idparte." Fallo: " . $e->getMessage();*/
                print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=4b"</script>';
            }
    }


    public function modificar_proceso(){
            //SE OBTIENEN LOS DATOS
            $idusuario       = $_SESSION['idUsuario'];
            $valoridradicado = trim($_POST['idradicado']);
            $datospartes     = trim($_POST['datospartes']);
            $modelo          = new signotModel();
            //PARA DETERMINAR SI UN CLASE PARTE ESTA EN EL VECTOR DONDE SE LE GENERA UNA CITACION
            //SE USA LA MISMA FUNCION DE get_lista_usuario_acciones, PARA NO CREAR OTRA FUNCION
            $campos               = 'idtabla';
            $nombrelista          = 'pa_modulo_acciones';
            $idaccion         = '1';
            $campoordenar         = 'id';
            $datosmoduloacciones  = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
            $idacciones           = $datosmoduloacciones->fetch();
            $modulosacciones      = explode("////",$idacciones[idtabla]);

            $datosadicionales = trim($_POST['datosadicionales']);
            //DATOS PARA EL REGISTRO DEL LOG
            //$modelo     = new signotModel();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            $tiporegistro = "Proceso";
            if( empty($iddocumento) ){
                $accion  = "Modifica un ".$tiporegistro." En el Sistema (SIGNOT), ID PROCESO: ".$valoridradicado;
            }else{
                //$accion  = "Modifica una ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS ENTRANTES, ID DOCUMENTO: ".$iddocumento;
            }
            $detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog = 6;
            try {
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //EMPIEZA LA TRANSACCION
                $this->db->beginTransaction();
                /*$this->db->exec("INSERT INTO signot_prueba (cedula,datos)
                                    VALUES ('$cedula','$datospartes')");*/
                $this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");

                /*$this->db->exec("INSERT INTO signot_proceso (radicado,idjuzgadoorigen,idclasejuzgado,idclaseproceso,iddepartamento,idmunicipio)
                                    VALUES ('$radicadox','$idjuzgadoorigen','$idclasejuzgado','$idclaseproceso','$iddepartamento','$idmunicipio')");*/

                //OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA signot_proceso
                //$lastIdProceso  = $this->db->lastInsertId();
                //******75088165//////Jorge Andres Valencia//////Cr 21 # 46 A 82//////8855934//////1-DEMANDANTE//////17-Caldas//////17001-MANIZALES******
                //75095585//////Andres Grajales//////Cr 213 # 748 B 434//////8875632//////1-DEMANDANTE//////13-Bolivar//////13001-CARTAGENA
                //1 EXPLODE
                $datospartes_1 = explode("******",$datospartes);
                $longitud_1    = count($datospartes_1);
                $i             = 1;
                $longpartes = $longitud_1 - 1;
                $anotacion = "SE REALIZA LA MODIFICACION DEL PROCESO EN EL SISTEMA, FECHA: ".$fechalog." "."a las: ".$horalog.
                             " CON NUMERO DE PARTES: ".$longpartes.", ID DEL PROCESO: ".$valoridradicado;

                $this->db->exec("INSERT INTO signot_proceso_anotacion (idradicado,idusuario,fecha,hora,anotacion)
                                VALUES ('$valoridradicado','$idusuario','$fechalog','$horalog','$anotacion')");
                while($i < $longitud_1){
                    //2 EXPLODE
                    $datospartes_2 = explode("//////",$datospartes_1[$i]);

                    $cedulaparte  = $datospartes_2[0];
                    $nombreparte  = $datospartes_2[1];

                    $direccion    = $datospartes_2[2];
                    $telefono     = $datospartes_2[3];

                    $idclaseparte   = explode("-",$datospartes_2[4]);
                    $idclaseparte_2 = $idclaseparte[0];

                    //SE PREGUNTA SI LA CLASE PARTE ESTA DENTRO DEL VECTOR DE PARTES PARA GENERAR CITACION Y ASIGNAR
                    //LA FECHA REGISTRO, FECHA AUTO Y AUTO ANOTIFICAR
                    //PARA CREAR UN REGISTRO EN LA TABLA signot_auto_parte
                    //if($idclaseparte_2 == 2){
                    /*if ( in_array($idclaseparte_2,$modulosacciones) ) {
                        $fecharegistroclase = $datospartes_2[7];
                        $fechaautoclase     = $datospartes_2[8];

                        $idauto             = explode("-",$datospartes_2[9]);
                        $idauto_2           = $idauto[0];
                    }*/
                    $iddepartamento   = explode("-",$datospartes_2[5]);
                    $iddepartamento_2 = $iddepartamento[0];

                    $idmunicipio      = explode("-",$datospartes_2[6]);
                    $idmunicipio_2    = $idmunicipio[0];

                    //IDENTIFICAMOS QUE UNA PARTE YA EXISTA EN LA TABLA signot_parte
                    //PARA NO VOLVER A REGISTRAR, SI NO ACTUALIZAR SUS DATOS
                    $listar = $this->db->prepare("SELECT * FROM signot_parte WHERE cedula = '$cedulaparte' AND nombre = '$nombreparte'");
                    $listar->execute();
                    $resultado = $listar->rowCount();
                    if(!$resultado){//NO EXISTE PARTE
                        //$iddocumento = 0;
                        $this->db->exec("INSERT INTO signot_parte (cedula,nombre,datosadicionales,idusuarioregistra,idusuarioedita)
                                        VALUES ('$cedulaparte','$nombreparte','$datosadicionales','$idusuario',0)");

                        //OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA signot_proceso
                        $lastIdParte  = $this->db->lastInsertId();
                        //IDENTIFICAMOS QUE UNA PARTE YA EXISTA EN LA TABLA signot_parteproceso
                        //EN EL MISMO PROCESO CON IGUAL CLASE DE PARTE (DEMANDANTE, DEMANDADO ETC....)
                        //YA QUE SI EXISTE NO SE ACTUALIZA, SOLO SE REGISTRA SI NO EXISTE
                        $listar = $this->db->prepare("SELECT * FROM signot_parteproceso
                                                      WHERE idproceso = '$valoridradicado'
                                                    AND idparte = '$lastIdParte' AND idclaseparte = '$idclaseparte_2'");
                        $listar->execute();
                        $resultado = $listar->rowCount();
                        if(!$resultado){//NO EXISTE REGISTRO
                            $this->db->exec("INSERT INTO signot_parteproceso (idproceso,idparte,idclaseparte,idusuarioregistra)
                                            VALUES ('$valoridradicado','$lastIdParte','$idclaseparte_2','$idusuario')");
                        }
                        //IDENTIFICAMOS QUE UNA DIRECCION YA EXISTA EN LA TABLA signot_direccion, CON EL PROCESO ACTUAL
                        //PARA NO REGISTRARLA NUEVAMENTE
                        $listar = $this->db->prepare("SELECT * FROM signot_direccion
                                                      WHERE idparte = '$lastIdParte' AND idproceso = '$valoridradicado'
                                                    AND telefono = '$telefono' AND direccion = '$direccion'
                                                    AND iddepartamento = '$iddepartamento_2' AND idmunicipio = '$idmunicipio_2'");
                        $listar->execute();
                        $resultado = $listar->rowCount();
                        if(!$resultado){//NO EXISTE REGISTRO
                            $this->db->exec("INSERT INTO
                                                signot_direccion (idparte,idproceso,telefono,direccion,iddepartamento,idmunicipio,
                                                                idusuarioregistra,idusuarioedita)
                                            VALUES ('$lastIdParte','$valoridradicado','$telefono','$direccion','$iddepartamento_2',
                                                '$idmunicipio_2','$idusuario',0)");
                        }
                        ////SE PREGUNTA SI LA CLASE PARTE ESTA DENTRO DEL VECTOR DE PARTES PARA GENERAR CITACION Y ASIGNAR
                        //LA FECHA REGISTRO, FECHA AUTO Y AUTO ANOTIFICAR
                        //PARA CREAR UN REGISTRO EN LA TABLA signot_auto_parte PARA CREAR UN AUTO, SI YA TIENE UN AUTO REGISTRADO
                        //CON EL PROCESO NO SE CREA OTRO
                        //NOTA: PARA NO AMARRAR QUE UNA PARTE TENGA UN SOLO TIPO DE AUTO EN UN PROCESO
                        //SIMPLEMENTE SE APLICA EL INSERT SIN EL SELECT
                        //if($idclaseparte_2 == 2){
                        /*if ( in_array($idclaseparte_2,$modulosacciones) ) {
                            $listar = $this->db->prepare("SELECT * FROM signot_auto_parte
                                                            WHERE idparte = '$lastIdParte' AND idproceso = '$valoridradicado'");
                            $listar->execute();
                            $resultado = $listar->rowCount();
                            if(!$resultado){//NO EXISTE REGISTRO
                                $this->db->exec("INSERT INTO signot_auto_parte (idparte,idproceso,idauto,fecharegistroauto,fechaauto,idusuarioregistra,idusuarioedita,descorrecion)
                                                VALUES ('$lastIdParte','$valoridradicado','$idauto_2','$fecharegistroclase','$fechaautoclase','$idusuario',0,'')");
                            }
                        }*/
                    }else{//EXISTE PARTE
                        //$iddocumento = 1;
                        $fila        = $listar->fetch();
                        $idparte     = $fila[id];

                        $this->db->exec("UPDATE signot_parte
                                         SET nombre = '$nombreparte',datosadicionales = '$datosadicionales',
                                            idusuarioedita = '$idusuario' WHERE cedula = '$cedulaparte'");
                        //IDENTIFICAMOS QUE UNA PARTE YA EXISTA EN LA TABLA signot_parteproceso
                        //EN EL MISMO PROCESO CON IGUAL CLASE DE PARTE (DEMANDANTE, DEMANDADO ETC....)
                        //YA QUE SI EXISTE NO SE ACTUALIZA, SOLO SE REGISTRA SI NO EXISTE
                        $listar = $this->db->prepare("SELECT * FROM signot_parteproceso
                                                      WHERE idproceso = '$valoridradicado'
                                                                                  AND idparte = '$idparte' AND idclaseparte = '$idclaseparte_2'");

                        $listar->execute();

                        $resultado = $listar->rowCount();

                        if(!$resultado){//NO EXISTE REGISTRO

                            $this->db->exec("INSERT INTO signot_parteproceso (idproceso,idparte,idclaseparte,idusuarioregistra)
                                             VALUES ('$valoridradicado','$idparte','$idclaseparte_2','$idusuario')");
                        }



                        //IDENTIFICAMOS QUE UNA DIRECCION YA EXISTA EN LA TABLA signot_direccion
                        //PARA NO REGISTRARLA NUEVAMENTE
                        $listar = $this->db->prepare("SELECT * FROM signot_direccion
                                                      WHERE idparte = '$idparte' AND idproceso = '$valoridradicado'
                                                      AND telefono = '$telefono' AND direccion = '$direccion'
                                                      AND iddepartamento = '$iddepartamento_2' AND idmunicipio = '$idmunicipio_2'");

                        $listar->execute();

                        $resultado = $listar->rowCount();

                        if(!$resultado){//NO EXISTE REGISTRO

                            $this->db->exec("INSERT INTO signot_direccion (idparte,idproceso,telefono,direccion,iddepartamento,
                                             idmunicipio,idusuarioregistra,idusuarioedita)
                                             VALUES ('$idparte','$valoridradicado','$telefono','$direccion','$iddepartamento_2',
                                             '$idmunicipio_2','$idusuario',0)");
                        }


                        ////SE PREGUNTA SI LA CLASE PARTE ESTA DENTRO DEL VECTOR DE PARTES PARA GENERAR CITACION Y ASIGNAR
                        //LA FECHA REGISTRO, FECHA AUTO Y AUTO ANOTIFICAR
                        //PARA CREAR UN REGISTRO EN LA TABLA signot_auto_parte PARA CREAR UN AUTO, SI YA TIENE UN AUTO REGISTRADO
                        //CON EL PROCESO NO SE CREA OTRO
                        //NOTA: PARA NO AMARRAR QUE UNA PARTE TENGA UN SOLO TIPO DE AUTO EN UN PROCESO
                        //SIMPLEMENTE SE APLICA EL INSERT SIN EL SELECT
                        //if($idclaseparte_2 == 2){
                        /*if ( in_array($idclaseparte_2,$modulosacciones) ) {


                            $listar = $this->db->prepare("SELECT * FROM signot_auto_parte
                                                          WHERE idparte = '$idparte' AND idproceso = '$valoridradicado'");

                            $listar->execute();

                            $resultado = $listar->rowCount();

                            if(!$resultado){//NO EXISTE REGISTRO

                                $this->db->exec("INSERT INTO signot_auto_parte (idparte,idproceso,idauto,fecharegistroauto,fechaauto,idusuarioregistra,idusuarioedita,descorrecion)
                                                 VALUES ('$idparte','$valoridradicado','$idauto_2','$fecharegistroclase','$fechaautoclase','$idusuario',0,'')");

                            }

                        }*/




                    }


                    $i = $i + 1;

                }



            //SE TERMINA LA TRANSACCION
            $this->db->commit();

            print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=6"</script>';

        }
        catch (Exception $e) {

            //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
            $this->db->rollBack();
            //echo $idusuario."-".$valoridradicado." Fallo: " . $e->getMessage();
            print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=6b"</script>';
        }


    }

    /*Adicionar Radicado Manual*/
    public function modificar_proceso_2(){
        //SE OBTIENEN LOS DATOS
        $idusuario       = $_SESSION['idUsuario'];
        //VALOR DEL ID PROCESO A MODIFICAR
        $valoridradicado = trim($_POST['idradicado']);
        $radicadox3       = trim($_POST['radicadox3']);
        //NUEVO RADICADO SI SE CUENTA CON LOS 23 CARACTERES
        //QUE DEBE CONTENER, ES DECIR SE ESTA ACTUALIZANDO EL RADICADO
        $radicadox       = trim($_POST['radicadox']);
        $juzgadoorigen   = explode("-",trim($_POST['juzgadoorigen']));
        $idjuzgadoorigen = $juzgadoorigen[0];
        $idclaseproceso  = trim($_POST['idclaseproceso']);
        $claseproceso2   = trim($_POST['claseproceso2']);
        $entidadcomisiona   = trim($_POST['entidadcomisiona']);
        $asunto             = trim($_POST['asunto']);
        $despacholibra      = trim($_POST['despacholibra']);

        $observacionx    = utf8_decode( trim($_POST['observacionx']) );
        $desobservacionx = "Radicado que se Reemplaza: ".$radicadox3. " Por: ".$radicadox." y se le Aplica la Siguiente Observacion: ".$observacionx;
        /*$idclasejuzgado = trim($_POST['idclasejuzgado']);
        $iddepartamento = trim($_POST['iddepartamento']);
        $idmunicipio    = trim($_POST['idmunicipio']);*/

        //SE REALIZA ESTA PREGUNTA YA QUE SI LA LONGITUD ES 23, SE INDENTIFICA QUE SE ESTA CAMBIANDO EL NUMERO DE RADICADO
        if(strlen($radicadox) == 23){

            //OBTENEMOS DEL RADICADO 170014003 006 19931018000
            //CLASE JUZGADO 4003, DEPARTAMENTO 17, MUNICIPIO 17001
            $idclasejuzgado = substr($radicadox, 5, 4);
            $iddepartamento = substr($radicadox, 0, 2);
            $idmunicipio    = substr($radicadox, 0, 5);
            //SE REALIZA ESTA PREGUNTA YA QUE PUEDE QUE SE ENVIE CLASE DE PROCESO O NO
            if ( !empty($idclaseproceso) ) {
                $filtro1 = "idclaseproceso = '$idclaseproceso',";
            }
        }
        else{

            //CIERRO ESTO YA QUE SIMEPRE VA HACER EL RADICADO DE 23 POR QUE EN LA VISTA SIGNOT_MODIFICAR2_PROCESO.PHP
            //PIDO QUE SE DEFINA EL NUEVO RADICADO

            /*$idclasejuzgado = substr($radicadox3, 5, 4);
            $iddepartamento = substr($radicadox3, 0, 2);
            $idmunicipio    = substr($radicadox3, 0, 5);

            //SE REALIZA ESTA PREGUNTA YA QUE PUEDE QUE SE ENVIE CLASE DE PROCESO O NO
            if ( !empty($idclaseproceso) ) {

                $filtro1 = "idclaseproceso = '$idclaseproceso',";

            }*/
        }
        //DATOS PARA EL REGISTRO DEL LOG
        $modelo     = new signotModel();
        $fechahora  = $modelo->get_fecha_actual();
        $datosfecha = explode(" ",$fechahora);
        $fechalog   = $datosfecha[0];
        $horalog    = $datosfecha[1];
        $tiporegistro = "Proceso";
        if( empty($iddocumento) ){
            //SE REALIZA ESTA PREGUNTA YA QUE SI LA LONGITUD ES 23, SE INDENTIFICA QUE SE ESTA CAMBIANDO EL NUMERO DE RADICADO
            if(strlen($radicadox) == 23){
                $accion  = "Modifica ".$tiporegistro." En el Sistema (SIGNOT), ID PROCESO: ".$valoridradicado." PROCESO: ".$radicadox3." POR ".$radicadox;
            }
            else{
                //CIERRO ESTO YA QUE SIMEPRE VA HACER EL RADICADO DE 23 POR QUE EN LA VISTA SIGNOT_MODIFICAR2_PROCESO.PHP
                //PIDO QUE SE DEFINA EL NUEVO RADICADO

                //$accion  = "Modifica ".$tiporegistro." En el Sistema (SIGNOT), ID PROCESO: ".$valoridradicado." PROCESO: ".$radicadox3;
            }
        }
        else{
            //$accion  = "Modifica una ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS ENTRANTES, ID PROCESO: ".$iddocumento;
        }
        $detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
        $tipolog = 6;
        try {
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //EMPIEZA LA TRANSACCION
            $this->db->beginTransaction();
                /*$this->db->exec("INSERT INTO signot_prueba (cedula,datos)
                                 VALUES ('$cedula','$datospartes')");*/
                $this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
                //SE REALIZA ESTA PREGUNTA YA QUE SI LA LONGITUD ES 23, SE INDENTIFICA QUE SE ESTA CAMBIANDO EL NUMERO DE RADICADO
                if(strlen($radicadox) == 23){
                    $this->db->exec("UPDATE signot_proceso SET
                                     radicado = '$radicadox',radicadosignotanterior = '$radicadox3',
                                     idjuzgadoorigen = '$idjuzgadoorigen',
                                     idclasejuzgado = '$idclasejuzgado', ".$filtro1 . "
                                     iddepartamento = '$iddepartamento',idmunicipio = '$idmunicipio',
                                     idusuarioedita = '$idusuario',claseproceso2 = '$claseproceso2',
                                     entidadcomisiona = '$entidadcomisiona',asunto = '$asunto',
                                     despacholibra = '$despacholibra'
                                     WHERE id = '$valoridradicado'");
                }
                else{
                    //CIERRO ESTO YA QUE SIMEPRE VA HACER EL RADICADO DE 23 POR QUE EN LA VISTA SIGNOT_MODIFICAR2_PROCESO.PHP
                    //PIDO QUE SE DEFINA EL NUEVO RADICADO

                    /*$this->db->exec("UPDATE signot_proceso SET ".
                                     $filtro1.
                                     " iddepartamento = '$iddepartamento',idmunicipio = '$idmunicipio',
                                     idusuarioedita = '$idusuario'
                                     WHERE id = '$valoridradicado'");*/
                }
                $this->db->exec("INSERT INTO signot_proceso_observacion (idradicado,exradicado,observacion,fechaob,idusuarioregistra)
                                 VALUES ('$valoridradicado','$radicadox3','$desobservacionx','$fechalog','$idusuario')");
            //SE TERMINA LA TRANSACCION
            $this->db->commit();
            print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=5"</script>';
        }
        catch (Exception $e) {
            //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
            $this->db->rollBack();
            //echo "Fallo: " . $e->getMessage();
            print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=5b"</script>';
        }
    }

    public function modificar_parte(){


        //SE OBTIENEN LOS DATOS
        $idusuario       = $_SESSION['idUsuario'];

        //VALOR DEL ID PROCESO A MODIFICAR
        $idparteproceso   = trim($_POST['idparteproceso']);
        $documentox       = trim($_POST['documento2x']);

        $nombrex          = trim($_POST['nombrex']);
        $nombre2x         = trim($_POST['nombre2x']);

        $datosadicionales = trim($_POST['datosadicionales']);

        //DATOS PARA EL REGISTRO DEL LOG

        $modelo     = new signotModel();
        $fechahora  = $modelo->get_fecha_actual();
        $datosfecha = explode(" ",$fechahora);
        $fechalog   = $datosfecha[0];
        $horalog    = $datosfecha[1];


        $tiporegistro = "Parte";

        if( empty($iddocumento) ){

            if($documentox == trim($_POST['documentox'])){

                $accion  = "Modifica ".$tiporegistro." En el Sistema (SIGNOT), ID PARTE: ".$idparteproceso." CEDULA: ".$documentox." - NOMBRE PARTE: ".$nombrex;
            }
            else{

                $accion  = "Modifica ".$tiporegistro." En el Sistema (SIGNOT), ID PARTE: ".$idparteproceso." CEDULA: ".trim($_POST['documentox'])." POR ".$documentox." - NOMBRE PARTE: ".$nombrex;
            }

        }
        else{
            //$accion  = "Modifica una ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS ENTRANTES, ID PROCESO: ".$iddocumento;
        }

        $detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
        $tipolog = 6;


        try {

            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //EMPIEZA LA TRANSACCION
            $this->db->beginTransaction();


                /*$this->db->exec("INSERT INTO signot_prueba (cedula,datos)
                                 VALUES ('$cedula','$datospartes')");*/

                $this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");


                $this->db->exec("UPDATE signot_parte SET
                                 cedula = '$documentox', nombre = '$nombre2x',datosadicionales = '$datosadicionales',
                                 idusuarioedita = '$idusuario'
                                 WHERE id = '$idparteproceso'");




            //SE TERMINA LA TRANSACCION
            $this->db->commit();

            print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=7"</script>';

        }
        catch (Exception $e) {

            //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
            $this->db->rollBack();
            //echo "Fallo: " . $e->getMessage();
            print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=7b"</script>';
        }


    }

    public function modificar_direccion(){


        //SE OBTIENEN LOS DATOS
        $idusuario       = $_SESSION['idUsuario'];

        //VALOR DEL ID PROCESO A MODIFICAR
        $iddireccionx = trim($_POST['iddireccionx']);

        $documentox   = trim($_POST['documentox']);
        $nombrex      = trim($_POST['nombrex']);
        $telefonox    = utf8_decode( trim($_POST['telefonox']) );
        $direccionx   = utf8_decode( trim($_POST['direccionx']) );
        $departamento = trim($_POST['departamento']);
        $municipio    = trim($_POST['municipio']);

        //DATOS PARA EL REGISTRO DEL LOG

        $modelo     = new signotModel();
        $fechahora  = $modelo->get_fecha_actual();
        $datosfecha = explode(" ",$fechahora);
        $fechalog   = $datosfecha[0];
        $horalog    = $datosfecha[1];


        $tiporegistro = "Direccion";

        if( empty($iddocumento) ){

            $accion  = "Modifica ".$tiporegistro." En el Sistema (SIGNOT), ID DIRECCION: ".$iddireccionx;

        }
        else{
            //$accion  = "Modifica una ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS ENTRANTES, ID PROCESO: ".$iddocumento;
        }

        $detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
        $tipolog = 6;


        try {

            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //EMPIEZA LA TRANSACCION
            $this->db->beginTransaction();


                /*$this->db->exec("INSERT INTO signot_prueba (cedula,datos)
                                 VALUES ('$cedula','$datospartes')");*/

                $this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");


                $this->db->exec("UPDATE signot_direccion SET
                                 telefono = '$telefonox',direccion = '$direccionx',
                                 iddepartamento = '$departamento',idmunicipio = '$municipio',
                                 idusuarioedita = '$idusuario'
                                 WHERE id = '$iddireccionx'");




            //SE TERMINA LA TRANSACCION
            $this->db->commit();

            print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=7"</script>';

        }
        catch (Exception $e) {

            //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
            $this->db->rollBack();
            //echo "Fallo: " . $e->getMessage();
            print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=7b"</script>';
        }


    }

    public function get_ano_completo(){

        date_default_timezone_set('America/Bogota');
        $fecharegistro=date('Y');

        return $fecharegistro;

    }

    public function corregir_notificacion(){

        $modelo     = new signotModel();

        $yearcompleto = $modelo->get_ano_completo();

        //SE OBTIENEN LOS DATOS
        $idusuario   = $_SESSION['idUsuario'];

        //VALOR DEL ID PROCESO A MODIFICAR
        $idautox     = trim($_POST['idautox']);

        $autox       = trim($_POST['autox']);

        $nombrelista        = 'pa_tipodocumento';
        $campoordenar       = 'nombre_tipo_documento';
        $filtro             = "WHERE id IN(".$autox.")";
        $formaordenar       = 'ASC';
        $datostipodocumento = $modelo->get_lista_filtro($nombrelista,$campoordenar,$filtro,$formaordenar);
        $row                = $datostipodocumento->fetch();
        $anotacion          = "SE CORRIGE TIPO DOCUMENTO: ".$row[nombre_tipo_documento];


        $fechaxau1   = trim($_POST['fechaxau1']);
        $fechaxau2   = trim($_POST['fechaxau2']);
        $fechaxau3   = trim($_POST['fechaxau3']);
        $correccionx = utf8_decode(trim($_POST['correccion2x'])." ".trim($_POST['correccionx']));

        $idparte     = trim($_POST['idpartex']);
        $idproceso   = trim($_POST['idprocesox']);

        $nombrex     = utf8_decode(trim($_POST['nombrex']));

        $dirigidoax  = trim($_POST['dirigidoax']);
        $direccionx  = utf8_decode(trim($_POST['direccionx']));
        $ciudadx     = utf8_decode(trim($_POST['ciudadx']));
        $ndocumentox = trim($_POST['ndocumentox']);
        $asuntox     = utf8_decode(trim($_POST['asuntox']));
        $partesx     = utf8_decode(trim($_POST['partesx']));

        //DATOS PARA EL REGISTRO DEL LOG

        //$modelo     = new signotModel();
        $fechahora  = $modelo->get_fecha_actual();
        $datosfecha = explode(" ",$fechahora);
        $fechalog   = $datosfecha[0];
        $horalog    = $datosfecha[1];


        $tiporegistro = "Auto";

        if( empty($iddocumento) ){

            $accion  = "Modifica ".$tiporegistro." En el Sistema (SIGNOT), ID AUTO: ".$idautox;

        }
        else{
            //$accion  = "Modifica una ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS ENTRANTES, ID PROCESO: ".$iddocumento;
        }

        $detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
        $tipolog = 6;


        try {

            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //EMPIEZA LA TRANSACCION
            $this->db->beginTransaction();



                $this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");


                $this->db->exec("INSERT INTO documentos_internos (idparte,idradicado,idusuario,idusuarioedita,idtipodocumento,numero,dirigidoa,
                                 nombre,direccion,ciudad,
                                 fechageneracion,fechaauto,fechaedita,asunto,contenido,partes,fechaautocorrige,descorrecion,idautocorrige,aniodoc)
                                 VALUES ('$idparte','$idproceso','$idusuario',0,'$autox','$ndocumentox','$dirigidoax','$nombrex','$direccionx',
                                 '$ciudadx','$fechaxau1','$fechaxau2','0000-00-00',
                                 '$asuntox','X','$partesx','$fechaxau3','$correccionx','$idautox','$yearcompleto')");

                //OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA documentos_internos
                $lastId    = $this->db->lastInsertId();
                $anotacion = $anotacion.", ID DOCUMENTO NUEVO: ".$lastId.", CORRIGE ID DOCUMENTO: ".$idautox;

                $this->db->exec("INSERT INTO signot_proceso_anotacion (idradicado,idusuario,fecha,hora,anotacion)
                                 VALUES ('$idproceso','$idusuario','$fechalog','$horalog','$anotacion')");

                //$this->db->exec("UPDATE pa_documento SET contador = '$consecutivo' WHERE id = '$documento'");

            //SE TERMINA LA TRANSACCION
            $this->db->commit();

            print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=8"</script>';

        }
        catch (Exception $e) {

            //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
            $this->db->rollBack();
            //echo $idparte."*****"."Fallo: " . $e->getMessage();
            print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=8b"</script>';
        }


    }
        // JUAN ESTEBAN MUNERA BETANCUR 30/06/2017
    public function registrar_anotacion(){
            session_start();
            //---- JUAN ESTEBAN MUNERA B 2017-10-06 ----
            //SE OBTIENEN LOS DATOS
            $idusuario              = $_SESSION['idUsuario'];
            $idproceso              = trim($_POST['idproceso']);
            $idtipoanotacion        = trim($_POST['destipoanotacion']);
            $anotacion              = utf8_decode( trim($_POST['anotacion']).", PARTE DEL PROCESO: ".trim($_POST['parteproceso']) );
            $fechaInterrogatorio    = trim($_POST['fecha_interrogatorio']);
            $fecha_inicial          = trim($_POST['fecha_interrogatorio']);

            //BANDERA PARA OCULTAR ALERTA PARA TODAS LAS ANOTACIONES DONDE FLAG_DEVOLUCION = 1 DEL RADICADO 'X'
            $flag_All_devoluciones  = 0;
            $parte = trim($_POST['parteproceso']);
            $idP = explode(",", $parte);
            $id_parteP = $idP[0];
            //DATOS PARA EL REGISTRO DEL LOG
            $modelo     = new signotModel();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            $tiporegistro = "ANOTACION";

            if( empty($iddocumento) ){
                $accion  = "Registra Una Nueva ".$tiporegistro." En el Sistema (SIGNOT), ID PROCESO: ".$idproceso;
            }else{
                //$accion  = "Modifica una ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS ENTRANTES, ID PROCESO: ".$iddocumento;
            }
            $detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog = 6;

            // JUAN ESTEBAN MUNERA BETANCUR 07 2017
            //************* 2018-02-14 *************************************** //
            if($idtipoanotacion == 11 || $idtipoanotacion == 14){
                $fecha_gstionAgotada='0000-00-00';
                $show=0;
                $flag_devolucion = 0;
                $fecha_devolucion='0000-00-00';
                $fecha_recepcion='0000-00-00';
                if ($idtipoanotacion ==11){
                    $flag_All_devoluciones = 1;
                }
                if($fechaInterrogatorio != ""){
                    $alertaInterrogatorio = 1;
                }else{
                    $alertaInterrogatorio = 0;
                }
            }else {
                $flag_devolucion = 0;
                $fechaInterrogatorio ="";
                $fecha_devolucion='0000-00-00';
                $flag_All_devoluciones = 0;
                $arreglo_habiles = (($modelo->calcularFechasHabiles(29, $fechalog)));
                $fin = ($modelo->calcularFechasHabiles($arreglo_habiles[1],$arreglo_habiles[3]));
                $vuelta1 = ($modelo->calcularFechasHabiles($fin[1],$fin[3]));
                $vuelta2 = ($modelo->calcularFechasHabiles($vuelta1[1],$vuelta1[3]));
                $vuelta3 = ($modelo->calcularFechasHabiles($vuelta2[1],$vuelta2[3]));
                $vuelta4 = ($modelo->calcularFechasHabiles($vuelta3[1],$vuelta3[3]));
                //****************************************************************
                $cant1      = count($arreglo_habiles[0]);
                $cant2      = count($fin[0]);
                $cant3      = count($vuelta1[0]);
                $cant4      = count($vuelta2[0]);
                $cant5      = count($vuelta3[0]);
                $cant6      = count($vuelta4[0]);
                $bandera    = 0;
                if($cant1 > 0){
                    if($arreglo_habiles[1]==0){
                        $dato = $arreglo_habiles[0][28];
                        $bandera=1;
                    }
                }
                if($cant2 > 0){
                    if($fin[1]==0){
                        $dato = $fin[0];
                        $dato = array_pop($dato);
                        $bandera=1;
                    }
                }
                if($cant3 >0){
                    if($vuelta1[1]==0){
                        $dato = $vuelta1[0];
                        $dato = array_pop($dato);
                        $bandera=1;
                    }
                }
                if($cant4 >0){
                    if($vuelta2[1]==0){
                        $dato = $vuelta2[0];
                        $dato = array_pop($dato);
                        $bandera=1;
                    }
                }
                if($cant5 >0){
                    if($vuelta3[1]==0){
                        $dato = $vuelta3[0];
                        $dato = array_pop($dato);
                        $bandera=1;
                    }
                }
                if($cant6 >0){
                    if($vuelta4[1]==0){
                        $dato = $vuelta4[0];
                        $dato = array_pop($dato);
                        $bandera=1;
                    }
                }
                //********* RESULTADO *************
                if($bandera==1){
                    $fecha_gstionAgotada = $dato;
                }
                $show = 1;
                //**********************************
                //---------------------------------------------------------------------------------------
                // JUAN ESTEBAN MUNERA BETANCUR 2018-02-09
                if($idtipoanotacion == 9){
                    $flag_devolucion = 1;
                    $arreglo_habiles = (($modelo->calcular_fecha_habil(5, $fecha_inicial)));
                    $fin = ($modelo->calcular_fecha_habil($arreglo_habiles[1],$arreglo_habiles[3]));
                    $vuelta1 = ($modelo->calcular_fecha_habil($fin[1],$fin[3]));
                    $vuelta2 = ($modelo->calcular_fecha_habil($vuelta1[1],$vuelta1[3]));
                    $vuelta3 = ($modelo->calcular_fecha_habil($vuelta2[1],$vuelta2[3]));
                    $vuelta4 = ($modelo->calcular_fecha_habil($vuelta3[1],$vuelta3[3]));
                    $vuelta5 = ($modelo->calcular_fecha_habil($vuelta4[1],$vuelta4[3]));
                    $vuelta6 = ($modelo->calcular_fecha_habil($vuelta5[1],$vuelta5[3]));
                    $vuelta7 = ($modelo->calcular_fecha_habil($vuelta6[1],$vuelta6[3]));
                    $vuelta8 = ($modelo->calcular_fecha_habil($vuelta7[1],$vuelta7[3]));
                    $vuelta9 = ($modelo->calcular_fecha_habil($vuelta8[1],$vuelta8[3]));
                    $vuelta10 = ($modelo->calcular_fecha_habil($vuelta9[1],$vuelta9[3]));
                    $vuelta11 = ($modelo->calcular_fecha_habil($vuelta10[1],$vuelta10[3]));
                    $vuelta12 = ($modelo->calcular_fecha_habil($vuelta11[1],$vuelta11[3]));
                    $vuelta13 = ($modelo->calcular_fecha_habil($vuelta12[1],$vuelta12[3]));
                    $vuelta14 = ($modelo->calcular_fecha_habil($vuelta13[1],$vuelta13[3]));
                    $vuelta15 = ($modelo->calcular_fecha_habil($vuelta14[1],$vuelta14[3]));
                    $vuelta16 = ($modelo->calcular_fecha_habil($vuelta15[1],$vuelta15[3]));
                    $vuelta17 = ($modelo->calcular_fecha_habil($vuelta16[1],$vuelta16[3]));
                    $vuelta18 = ($modelo->calcular_fecha_habil($vuelta17[1],$vuelta17[3]));
                    $vuelta19 = ($modelo->calcular_fecha_habil($vuelta18[1],$vuelta18[3]));
                    $vuelta20 = ($modelo->calcular_fecha_habil($vuelta19[1],$vuelta19[3]));
                    //print_r($vuelta15[0]);
                    //****************************************************************
                    $cant1      = count($arreglo_habiles[0]);
                    $cant2      = count($fin[0]);
                    $cant3      = count($vuelta1[0]);
                    $cant4      = count($vuelta2[0]);
                    $cant5      = count($vuelta3[0]);
                    $cant6      = count($vuelta4[0]);
                    $cant7      = count($vuelta5[0]);
                    $cant8      = count($vuelta6[0]);
                    $cant9      = count($vuelta7[0]);
                    $cant10     = count($vuelta8[0]);
                    $cant11     = count($vuelta9[0]);
                    $cant12     = count($vuelta10[0]);
                    $cant13     = count($vuelta11[0]);
                    $cant14     = count($vuelta12[0]);
                    $cant15     = count($vuelta13[0]);
                    $cant16     = count($vuelta14[0]);
                    $cant17     = count($vuelta15[0]);
                    $cant18     = count($vuelta16[0]);
                    $cant19     = count($vuelta17[0]);
                    $cant20     = count($vuelta18[0]);
                    $cant21     = count($vuelta19[0]);
                    $cant22     = count($vuelta20[0]);
                    $bandera    = 0;
                    if($cant1 > 0){
                        if($arreglo_habiles[1]==0){
                            $dato = $arreglo_habiles[0][4];
                            $bandera=1;
                            //echo "can1";
                        }
                    }
                    if($cant2 > 0){
                        if($fin[1]==0){
                            $dato = $fin[0];
                            $dato = array_pop($dato);
                            $bandera=1;
                            //echo "can2";
                        }
                    }
                    if($cant3 >0){
                        if($vuelta1[1]==0){
                            $dato = $vuelta1[0];
                            $dato = array_pop($dato);
                            $bandera=1;
                            //echo "can3";
                        }
                    }
                    if($cant4 >0){
                        if($vuelta2[1]==0){
                            $dato = $vuelta2[0];
                            $dato = array_pop($dato);
                            $bandera=1;
                            //echo "can4";
                        }
                    }
                    if($cant5 >0){
                        if($vuelta3[1]==0){
                            $dato = $vuelta3[0];
                            $dato = array_pop($dato);
                            $bandera=1;
                            //echo "can5";
                        }
                    }
                    if($cant6 >0){
                        if($vuelta4[1]==0){
                            $dato = $vuelta4[0];
                            $dato = array_pop($dato);
                            $bandera=1;
                            //echo "can6";
                        }
                    }
                    if($cant7 >0){
                        if($vuelta5[1]==0){
                            $dato = $vuelta5[0];
                            $dato = array_pop($dato);
                            $bandera=1;
                            //echo "can7";
                        }
                    }
                    if($cant8 >0){
                        if($vuelta6[1]==0){
                            $dato = $vuelta6[0];
                            $dato = array_pop($dato);
                            $bandera=1;
                            //echo "can8";
                        }
                    }
                    if($cant9 >0){
                        if($vuelta7[1]==0){
                            $dato = $vuelta7[0];
                            $dato = array_pop($dato);
                            $bandera=1;
                            //echo "can9";
                        }
                    }
                    if($cant10 >0){
                        if($vuelta8[1]==0){
                            $dato = $vuelta8[0];
                            $dato = array_pop($dato);
                            $bandera=1;
                            //echo "can10";
                        }
                    }
                    if($cant11 >0){
                        if($vuelta9[1]==0){
                            $dato = $vuelta9[0];
                            $dato = array_pop($dato);
                            $bandera=1;
                            //echo "can11";
                        }
                    }
                    if($cant12 >0){
                        if($vuelta10[1]==0){
                            $dato = $vuelta10[0];
                            $dato = array_pop($dato);
                            $bandera=1;
                            //echo "can12";
                        }
                    }
                    if($cant13 >0){
                        if($vuelta11[1]==0){
                            $dato = $vuelta11[0];
                            $dato = array_pop($dato);
                            $bandera=1;
                            //echo "can13";
                        }
                    }
                    if($cant14 >0){
                        if($vuelta12[1]==0){
                            $dato = $vuelta12[0];
                            $dato = array_pop($dato);
                            $bandera=1;
                            //echo "can14";
                        }
                    }
                    if($cant15 >0){
                        if($vuelta13[1]==0){
                            $dato = $vuelta13[0];
                            $dato = array_pop($dato);
                            $bandera=1;
                            //echo "can15";
                        }
                    }
                    if($cant16 >0){
                        if($vuelta14[1]==0){
                            $dato = $vuelta14[0];
                            $dato = array_pop($dato);
                            $bandera=1;
                            //echo "can16";
                        }
                    }
                    if($cant17 >0){
                        if($vuelta15[1]==0){
                            $dato = $vuelta15[0];
                            $dato = array_pop($dato);
                            $bandera=1;
                            //echo "can17";
                        }
                    }
                    if($cant18 >0){
                        if($vuelta16[1]==0){
                            $dato = $vuelta16[0];
                            $dato = array_pop($dato);
                            $bandera=1;
                            //echo "can18";
                        }
                    }
                    if($cant19 >0){
                        if($vuelta17[1]==0){
                            $dato = $vuelta17[0];
                            $dato = array_pop($dato);
                            $bandera=1;
                            //echo "can19";
                        }
                    }
                    if($cant20 >0){
                        if($vuelta18[1]==0){
                            $dato = $vuelta18[0];
                            $dato = array_pop($dato);
                            $bandera=1;
                            //echo "can20";
                        }
                    }
                    if($cant21 >0){
                        if($vuelta19[1]==0){
                            $dato = $vuelta19[0];
                            $dato = array_pop($dato);
                            $bandera=1;
                            //echo "can20";
                        }
                    }
                    if($cant22 >0){
                        if($vuelta20[1]==0){
                            $dato = $vuelta20[0];
                            $dato = array_pop($dato);
                            $bandera=1;
                            //echo "can20";
                        }
                    }
                    //********* RESULTADO *************
                    if($bandera==1){
                        $fecha_devolucion = $dato;
                        $fecha_recepcion  = trim($_POST['fecha_interrogatorio']);
                    }else{
                        //echo "error";
                    }
                }
                if($idtipoanotacion ==10){
                    $flag_All_devoluciones = 1;
                }
                //  JUAN ESTEBAN MUNERA BETANCUR 2018-02-13 ***************************
                // NOTA: REVISAR NO APARECE EN LA REAL //******************************
                //if($idtipoanotacion == 5){
                  //  $arreglo_datos = ((Direccion_Anotacion($id_parte, $idproceso)));
                //}
                //**********************************************************************
            }

            try {
                // ACÁ EMPIEZA COMENTARIO************************************************************
                // JEST 2017-10-06
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //EMPIEZA LA TRANSACCION
                $this->db->beginTransaction();
                $this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
                $this->db->exec("UPDATE signot_proceso_anotacion SET mostrar_alerta = '0' WHERE idradicado = '$idproceso'");
                $this->db->exec("INSERT INTO signot_proceso_anotacion (idradicado,idusuario,fecha,hora,idtipoanotacion,anotacion, id_parte, fecha_gestionAgotada, mostrar_alerta, fecha_interrogatorio, alerta_interrogatorio, fecha_recepcion, fecha_devolucion, flag_devolucion)
                                VALUES ('$idproceso','$idusuario','$fechalog','$horalog','$idtipoanotacion','$anotacion', '$id_parteP', '$fecha_gstionAgotada','$show', '$fechaInterrogatorio', '$alertaInterrogatorio', '$fecha_recepcion','$fecha_devolucion','$flag_devolucion')");
//********                $this->db->exec("UPDATE pa_documento SET contador = '$consecutivo' WHERE id = '$documento'");
                if($flag_All_devoluciones == 1){
                    $this->db->exec("UPDATE signot_proceso_anotacion SET flag_devolucion = 0 WHERE idradicado = '$idproceso' AND id_parte = '$id_parteP'");
                }
                //SE TERMINA LA TRANSACCION
                $this->db->commit();

                // ****** ACÀ FIN COMENTARIO*************************************************
                echo "**********ANOTACION CORRECTA";
                //header('refresh: 0; URL=/centro_servicios2/index.php?controller=signot&action=Editar_Proceso_Anotacion&id = '.$idproceso.' ');
                /*print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=9"</script>';*/
            } catch (Exception $e) {
                //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
                $this->db->rollBack();
                //echo $idparte."*****"."Fallo: " . $e->getMessage();
                //echo $e->getMessage();
                echo "**********ERROR ANOTACION";
                /*print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=9b"</script>';*/
            }
    }

    public function get_siglas($tipodocumento){
            $listar  = $this->db->prepare("SELECT d.sigla AS siglas,d.nombre_documento
                                        FROM (pa_tipodocumento td INNER JOIN pa_documento d ON td.iddocumento = d.id)
                                        WHERE td.id = '$tipodocumento'");
            $listar->execute();
            return $listar;
    }


    //FUNCION PARA CORTAR UNA CADENA Y ESPECIFICAR CON PUNTOS QUE TIENE MAS TEXTO
    //SE CARTASEGUN EL VALOR  $length ASIGNADO
    public function getSubString($string, $length=NULL){

        //Si no se especifica la longitud por defecto es 50
        if ($length == NULL)
            $length = 50;
        //Primero eliminamos las etiquetas html y luego cortamos el string
        $stringDisplay = substr(strip_tags($string), 0, $length);
        //Si el texto es mayor que la longitud se agrega puntos suspensivos
        if (strlen(strip_tags($string)) > $length)
            $stringDisplay .= ' ...';


        return $stringDisplay;
    }


    //*********************************************************************************************************************************************
                                                            //FUNCIONES PARA LA MIGRACION
    //*********************************************************************************************************************************************

    public function registrar_migracion(){

        $modelo = new signotModel();

        $idusuario = $_SESSION['idUsuario'];

        $radix     = trim($_GET['radix']);

        $listaprocesos = $modelo->get_datos_proceso_migracion($radix);

        //DATOS PARA EL REGISTRO DEL LOG
        $fechahora  = $modelo->get_fecha_actual();
        $datosfecha = explode(" ",$fechahora);
        $fechalog   = $datosfecha[0];
        $horalog    = $datosfecha[1];

        $tiporegistro = "REALIZA MIGRACION DE INFORMACION";

        if( empty($iddocumento) ){

            $accion  = $tiporegistro." En el Sistema (SIGNOT), PROCESO: ".$radix;

        }
        else{
            //$accion  = "Modifica una ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS ENTRANTES, ID PROCESO: ".$iddocumento;
        }

        $detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
        $tipolog = 6;

        $anotacion = "SE REALIZA MIGRACION DE INFORMACION";

        $contadorloganotacion = 0;

        while($fila = $listaprocesos->fetch()){//WHILE 1

            $idradicadox = trim($fila[id]);
            $radicadox   = trim($fila[radicado]);
            $radicadoxsignotanterior = trim($fila[radicadosignotanterior]);

            $listapartesprocesos = $modelo->get_datos_parteproceso_migracion($radicadox,$radicadoxsignotanterior);
            //$fila_2 = $listapartesprocesos->fetch();
            $resultadolista      = $listapartesprocesos->rowCount();

            //SE PREGUNTA SI EL PROCESO CUENTA CON PARTES, SI NO, NO EJECUTA LA MIGRACION
            if(!$resultadolista){

                print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=6c"</script>';
            }

            $listapartesprocesosM = $modelo->get_datos_realizada_migracion($idradicadox);
            $resultadolistaM      = $listapartesprocesosM->rowCount();

            //SE PREGUNTA SI YA SE REALIZO LA MIGRACION
            if($resultadolistaM){

                print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=6d"</script>';
            }

            while($fila_2 = $listapartesprocesos->fetch()){//WHILE 2

                //PARTES PROCESO
                $cedulax       = trim($fila_2[cedula]);
                $nombrex       = trim($fila_2[nombre_sujeto]);
                $direccionx    = trim($fila_2[direccion]);
                $telefonox     = trim($fila_2[telefono]);
                $clasepartex   = trim($fila_2[id_tipo_sujeto]);
                $departamentox = trim($fila_2[id_departamento]);
                $municipiox    = trim($fila_2[id_ciudad]);

                $datospartes .= "******".$cedulax."//////".$nombrex."//////".$direccionx."//////".$telefonox."//////".$clasepartex."//////".$departamentox."//////".$municipiox;


                try {

                    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    //EMPIEZA LA TRANSACCION
                    $this->db->beginTransaction();


                        //$this->db->exec("INSERT INTO signot_proceso (radicado,fecharegistro,idjuzgadoorigen,idclasejuzgado,idclaseproceso,iddepartamento,idmunicipio,idusuarioregistra,idusuarioedita,iddevolucion)
                                         //VALUES ('$radicadox','$fechalog','$idjuzgadoorigen','$idclasejuzgado','$idclaseproceso','$iddepartamento','$idmunicipio','$idusuario',0,0)");



                        //OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA signot_proceso
                        //$lastIdProceso  = $this->db->lastInsertId();


                        //******75088165//////Jorge Andres Valencia//////Cr 21 # 46 A 82//////8855934//////1-DEMANDANTE//////17-Caldas//////17001-MANIZALES******
                        //75095585//////Andres Grajales//////Cr 213 # 748 B 434//////8875632//////1-DEMANDANTE//////13-Bolivar//////13001-CARTAGENA

                        //1 EXPLODE
                        $datospartes_1 = explode("******",$datospartes);
                        $longitud_1    = count($datospartes_1);
                        $i             = 1;

                        while($i < $longitud_1){

                            //2 EXPLODE
                            $datospartes_2 = explode("//////",$datospartes_1[$i]);


                            $cedulaparte  = $datospartes_2[0];
                            $nombreparte  = $datospartes_2[1];

                            $direccion    = $datospartes_2[2];
                            $telefono     = $datospartes_2[3];

                            //$idclaseparte   = explode("-",$datospartes_2[4]);
                            //$idclaseparte_2 = $idclaseparte[0];
                            $idclaseparte_2 = $datospartes_2[4];
                            //$idclaseparte_2 = 1;

                            //if($idclaseparte_2 == " "){
                                //$idclaseparte_2 = 17;
                            //}

                            //$iddepartamento   = explode("-",$datospartes_2[5]);
                            //$iddepartamento_2 = $iddepartamento[0];
                            $iddepartamento_2 = $datospartes_2[5];

                            //$idmunicipio      = explode("-",$datospartes_2[6]);
                            //$idmunicipio_2    = $idmunicipio[0];
                            $idmunicipio_2    = $datospartes_2[6];

                            //IDENTIFICAMOS QUE UNA PARTE YA EXISTA EN LA TABLA signot_parte
                            //PARA NO VOLVER A REGISTRAR, SI NO ACTUALIZAR SUS DATOS
                            //SE COMPARA TANTO LA CEDULA COMO EL NOMBRE YA QUE EN EL SIGNOT ANTERIOR
                            //MUCHAS PARTES CONTBAN CON EL DATO CEDULA 1 o 2 o 3 ETC
                            //ENTONCES SI SOLO SE PREGUNTA CON LA CEDULA MIGRARIA PARTES A PROCESOS
                            //QUE NO CORRESPONDE ESA PARTE
                            $listar = $this->db->prepare("SELECT * FROM signot_parte WHERE cedula = '$cedulaparte'
                                                          AND nombre = '$nombreparte'");
                            //$listar = $this->db->prepare("SELECT * FROM signot_parte WHERE nombre = '$nombreparte'");

                            $listar->execute();

                            $resultado = $listar->rowCount();

                            if(!$resultado){//NO EXISTE PARTE

                                //$iddocumento = 0;

                                $this->db->exec("INSERT INTO signot_parte (cedula,nombre,datosadicionales,idusuarioregistra,
                                                 idusuarioedita)
                                                 VALUES ('$cedulaparte','$nombreparte','$datosadicionales','$idusuario',0)");

                                //OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA signot_proceso
                                $lastIdParte  = $this->db->lastInsertId();


                                //IDENTIFICAMOS QUE UNA PARTE YA EXISTA EN LA TABLA signot_parteproceso
                                //EN EL MISMO PROCESO CON IGUAL CLASE DE PARTE (DEMANDANTE, DEMANDADO ETC....)
                                //YA QUE SI EXISTE NO SE ACTUALIZA, SOLO SE REGISTRA SI NO EXISTE
                                $listar = $this->db->prepare("SELECT * FROM signot_parteproceso
                                                              WHERE idproceso = '$idradicadox' AND idparte = '$lastIdParte'
                                                              AND idclaseparte = '$idclaseparte_2'");

                                $listar->execute();

                                $resultado = $listar->rowCount();

                                if(!$resultado){//NO EXISTE REGISTRO

                                    $this->db->exec("INSERT INTO signot_parteproceso (idproceso,idparte,idclaseparte,idusuarioregistra)
                                                     VALUES ('$idradicadox','$lastIdParte','$idclaseparte_2','$idusuario')");
                                }


                                //IDENTIFICAMOS QUE UNA DIRECCION YA EXISTA EN LA TABLA signot_direccion
                                //PARA NO REGISTRARLA NUEVAMENTE
                                $listar = $this->db->prepare("SELECT * FROM signot_direccion
                                                              WHERE idparte = '$lastIdParte' AND idproceso = '$idradicadox'
                                                              AND telefono = '$telefono' AND direccion = '$direccion'
                                                              AND iddepartamento = '$iddepartamento_2'
                                                              AND idmunicipio = '$idmunicipio_2'");

                                $listar->execute();

                                $resultado = $listar->rowCount();

                                if(!$resultado){//NO EXISTE REGISTRO

                                    $this->db->exec("INSERT INTO signot_direccion (idparte,idproceso,telefono,direccion,iddepartamento,
                                                    idmunicipio,idusuarioregistra,idusuarioedita)
                                                     VALUES ('$lastIdParte','$idradicadox','$telefono','$direccion','$iddepartamento_2',
                                                     '$idmunicipio_2','$idusuario',0)");
                                }


                            }
                            else{//EXISTE PARTE

                                $iddocumento = 1;
                                $fila_3      = $listar->fetch();
                                $idparte     = $fila_3[id];


                                //$this->db->exec("UPDATE signot_parte SET nombre = '$nombreparte',datosadicionales = '$datosadicionales',idusuarioedita = '$idusuario' WHERE cedula = '$cedulaparte'");

                                //$this->db->exec("UPDATE signot_parte SET nombre = '$nombreparte',datosadicionales = '$datosadicionales',idusuarioedita = '$idusuario' WHERE nombre = '$nombreparte'");


                                //IDENTIFICAMOS QUE UNA PARTE YA EXISTA EN LA TABLA signot_parteproceso
                                //EN EL MISMO PROCESO CON IGUAL CLASE DE PARTE (DEMANDANTE, DEMANDADO ETC....)
                                //YA QUE SI EXISTE NO SE ACTUALIZA, SOLO SE REGISTRA SI NO EXISTE
                                $listar = $this->db->prepare("SELECT * FROM signot_parteproceso
                                                              WHERE idproceso = '$idradicadox' AND idparte = '$idparte'
                                                              AND idclaseparte = '$idclaseparte_2'");

                                $listar->execute();

                                $resultado = $listar->rowCount();

                                if(!$resultado){//NO EXISTE REGISTRO

                                    $this->db->exec("INSERT INTO signot_parteproceso (idproceso,idparte,idclaseparte,idusuarioregistra)
                                                     VALUES ('$idradicadox','$idparte','$idclaseparte_2','$idusuario')");
                                }



                                //IDENTIFICAMOS QUE UNA DIRECCION YA EXISTA EN LA TABLA signot_direccion
                                //PARA NO REGISTRARLA NUEVAMENTE
                                $listar = $this->db->prepare("SELECT * FROM signot_direccion
                                                              WHERE idparte = '$idparte' AND idproceso = '$idradicadox'
                                                              AND telefono = '$telefono' AND direccion = '$direccion'
                                                              AND iddepartamento = '$iddepartamento_2' AND idmunicipio = '$idmunicipio_2'");

                                $listar->execute();

                                $resultado = $listar->rowCount();

                                if(!$resultado){//NO EXISTE REGISTRO

                                    $this->db->exec("INSERT INTO signot_direccion (idparte,idproceso,telefono,direccion,iddepartamento,
                                                     idmunicipio,idusuarioregistra,idusuarioedita)
                                                     VALUES ('$idparte','$idradicadox','$telefono','$direccion','$iddepartamento_2',
                                                     '$idmunicipio_2','$idusuario',0)");
                                }



                            }


                            $i = $i + 1;

                        }

                        //SE REALIZA ESTA PREGUNTA PARA QUE EL SISTEMA SOLO EN LA TABLA signot_proceso_anotacion Y LOG
                        //SOLO CREE UN REGISTRO EN CADA UNA, YA QUE SI NO SE HACE ESTA PREGUNTA DEPENDIENTO DE LAS PARTES QUE SE MIGREN
                        //AL PROCESO SE GENERAN MAS REGISTROS Y SOLO SE NECESITA SABER CON UNO LA ACCION REALIZA.
                        if($contadorloganotacion == 0){

                            //ANOTACION (PARA EL SEGUIMIENTO DEL PROCESO)
                            $this->db->exec("INSERT INTO signot_proceso_anotacion (idradicado,idusuario,fecha,hora,anotacion)
                                             VALUES ('$idradicadox','$idusuario','$fechalog','$horalog','$anotacion')");

                            //LOG
                            $this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog)
                                             VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");

                            $contadorloganotacion = $contadorloganotacion + 1;
                        }

                    //SE TERMINA LA TRANSACCION
                    $this->db->commit();

                    print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=6"</script>';

                }
                catch (Exception $e) {

                    //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
                    $this->db->rollBack();
                    echo "Fallo: " . $e->getMessage();
                    /*print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=4b"</script>';*/
                }


            }//FIN WHILE 2

        }//FIN WHILE 1

        //echo $datospartes;
    }

    public function get_datos_proceso_migracion($radix){



        $listar = $this->db->prepare("SELECT * FROM signot_proceso
                                      WHERE radicado = '$radix'
                                      ORDER BY id");

        //$listar = $this->db->prepare("SELECT * FROM signot_proceso ORDER BY id");

        $listar->execute();

        $resultado = $listar->rowCount();

        //NO EXISTE REGISTRO ENTONCES BUSCAMOS CON radicadosignotanterior YA PUDO PASAR QUE CORRIGIERON EL RADICADO
        //CAMPO radicado TABLA signot_proceso Y ENTONCES SE PREGUNTA CON EL radicadosignotanterior
        //QUE ES EL RADICADO CON QUE SE REALIZO LA CARGA AL MOMENTO DE MIGRAR
        if(!$resultado){

            $listar = $this->db->prepare("SELECT * FROM signot_proceso
                                          WHERE radicadosignotanterior = '$radix'
                                          ORDER BY id");

            $listar->execute();
        }

        return $listar;

    }

    //FUNCION QUE RECIBE AMBOS RADICADOS, PARA DETECTAR PARTES DE UN PROCESO YA QUE PUDO PASAR QUE CORRIGIERON EL RADICADO
    //CAMPO radicado TABLA signot_proceso Y ENTONCES SE PREGUNTA CON EL radicadosignotanterior
    //QUE ES EL RADICADO CON QUE SE REALIZO LA CARGA AL MOMENTO DE MIGRAR
    public function get_datos_parteproceso_migracion($radicadox,$radicadoxsignotanterior){

        $listar = $this->db->prepare("SELECT * FROM parte WHERE (id_proceso = '$radicadox' OR id_proceso = '$radicadoxsignotanterior')
                                      ORDER BY nombre_sujeto");

                                      /*GROUP BY nombre_sujeto*/

        $listar->execute();

        return $listar;

    }

    //ME PERMITE CONOCER SI YA SE MIGRO INFORMACION DE UN PROCESO
    public function get_datos_realizada_migracion($idradicadox){

        $listar = $this->db->prepare("SELECT * FROM signot_proceso_anotacion WHERE idradicado = '$idradicadox'
                                      AND anotacion = 'SE REALIZA MIGRACION DE INFORMACION'");



        $listar->execute();

        return $listar;

    }

    //*********************************************************************************************************************************************
                                                            //FUNCIONES PARA PROCESOS MASIVOS
    //*********************************************************************************************************************************************

    public function asignar_id_parte(){


        $modelo = new signotModel();

        $idusuario = $_SESSION['idUsuario'];

        $contadorlog = 0;


        //DATOS PARA EL REGISTRO DEL LOG
        $fechahora  = $modelo->get_fecha_actual();
        $datosfecha = explode(" ",$fechahora);
        $fechalog   = $datosfecha[0];
        $horalog    = $datosfecha[1];

        $tiporegistro = "REALIZA PROCESO MASIVO";

        if( empty($iddocumento) ){

            $accion  = $tiporegistro." En el Sistema (SIGNOT), PROCESO: ASIGNAR ID PARTE";

        }

        $detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
        $tipolog = 6;


        $listaprocesos = $modelo->get_datos_id_parte();

        while($fila = $listaprocesos->fetch()){//WHILE 1

            $id     = trim($fila[id]);
            $nombre = trim($fila[nombre]);


            if($nombre != "-"){

                try {

                        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        //EMPIEZA LA TRANSACCION
                        $this->db->beginTransaction();


                        $listar = $this->db->prepare("SELECT * FROM signot_parte WHERE nombre = '$nombre' ");


                        $listar->execute();

                        $resultado = $listar->rowCount();

                        $fila_3  = $listar->fetch();
                        $idparte = $fila_3[id];

                        //if(empty($idparte)){

                        if($resultado){

                        $this->db->exec("UPDATE documentos_internos SET idparte = '$idparte'
                                         WHERE id = '$id'");

                        }


                        //SE REALIZA ESTA PREGUNTA PARA QUE EL SISTEMA SOLO EN LA TABLA LOG
                        //SOLO CREE UN REGISTRO.
                        if($contadorlog == 0){


                            //LOG
                            $this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog)
                                             VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");

                            $contadorlog = $contadorlog + 1;
                        }




                        //SE TERMINA LA TRANSACCION
                        $this->db->commit();

                        print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=6"</script>';

                    }
                    catch (Exception $e) {

                        //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
                        $this->db->rollBack();
                        echo "Fallo: " . $e->getMessage();
                        /*print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=4b"</script>';*/
                    }


            }


        }//FIN WHILE 1


    }

    public function get_datos_id_parte(){

        $listar = $this->db->prepare("SELECT di.id,di.idparte,di.idradicado,di.numero,di.nombre
                                      FROM documentos_internos di
                                      WHERE di.idparte = 0
                                      ORDER BY di.id");


        $listar->execute();

        return $listar;

    }

    //*********************************************************************************************************************************************
                                                            //FUNCIONES PARA ACTIVAR PARTES EN UN PROCESO
    //*********************************************************************************************************************************************

    public function activar_parte(){

            $modelo     = new signotModel();

            //SE OBTIENEN LOS DATOS
            $idusuario     = $_SESSION['idUsuario'];

            //VARIABLE QUE MANEJA EL INSERT O UPDATE DE UN NUEVO DOCUMENTO
            $iddocumento   = trim($_POST['iddocumento']);

            $idparte = trim($_POST['id']);

            $datosdocumento = $modelo->get_datos_idradicado( trim($_POST['radicadox']) );
            $row            = $datosdocumento->fetch();

            $idr            = $row[id];

            $idclaseparte   = trim($_POST['idclaseparte']);;


            $idtipoanotacion = trim($_POST['destipoanotacion']);

            //$anotacion      = "SE ACTIVA NUEVAMENTE EL PROCESO PARA SU MANEJO";
            $anotacion       = trim($_POST['anotacion']).", PARTE DEL PROCESO: ".trim($_POST['parteproceso']);

            //DATOS PARA EL REGISTRO DEL LOG

            //$modelo     = new documentosModel();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];


            //$tiporegistro = "Genera un Nuevo Documento";

            if( empty($iddocumento) ){

                $accion  = "Activa Parte, Sistema SIGNOT, ID PROCESO: ".$idr.", ID PARTE: ".$idparte;
            }
            else{

                $accion  = "Activa Parte, Sistema SIGNOT, ID PROCESO: ".$idr.", ID PARTE: ".$idparte;
            }
            $detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog = 6;

            try {

                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //EMPIEZA LA TRANSACCION
                $this->db->beginTransaction();


                    $this->db->exec("UPDATE signot_parteproceso SET endevolucion = 'NO'
                                     WHERE idproceso = '$idr' AND idparte = '$idparte' AND idclaseparte = '$idclaseparte'");


                    $this->db->exec("INSERT INTO signot_proceso_anotacion (idradicado,idusuario,fecha,hora,idtipoanotacion,anotacion)
                                     VALUES ('$idr','$idusuario','$fechalog','$horalog','$idtipoanotacion','$anotacion')");


                    $this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");


                //SE TERMINA LA TRANSACCION
                $this->db->commit();

                //echo "DATO: ".$tipodocumento;
                print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=9"</script>';

            }
            catch (Exception $e) {

                //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
                $this->db->rollBack();
                echo "Fallo: " . $e->getMessage();
                /*print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=9b"</script>';*/
            }

    }

    //*********************************************************************************************************************************************
                                                            //FUNCIONES PARA REGISTRAR PROCESO UNICO
    //*********************************************************************************************************************************************

    /*Adicionar Radicado Manual*/
    public function registrar_proceso_unico(){
            //SE OBTIENEN LOS DATOS idjuzgadoorigen
            $idusuario       = $_SESSION['idUsuario'];
            $radicadox       = trim($_POST['radicadox']);
            $juzgadoorigen   = explode("-",trim($_POST['juzgadoorigen']));
            $idjuzgadoorigen = trim($juzgadoorigen[0]);
            $idclaseproceso  = trim($_POST['claseproceso']);
            $claseproceso2   = trim($_POST["claseproceso2"]);
            $entidadcomisiona = trim($_POST["entidadcomisiona"]);
            $asunto           = trim($_POST["asunto"]);
            $despacholibra    = trim($_POST["despacholibra"]);
            $datospartes     = trim($_POST['datospartes']);
            //OBTENEMOS DEL RADICADO 170014003 006 19931018000
            //CLASE JUZGADO 4003, DEPARTAMENTO 17, MUNICIPIO 17001
            $idclasejuzgado = substr($radicadox, 5, 4);
            $iddepartamento = substr($radicadox, 0, 2);
            $idmunicipio    = substr($radicadox, 0, 5);
            $modelo         = new signotModel();
            //DATOS PARA EL REGISTRO DEL LOG
            //$modelo     = new signotModel();
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            $tiporegistro = "Proceso";
            $accion  = "Registra un Nuevo ".$tiporegistro." En el Sistema (SIGNOT), PROCESO: ".$radicadox;
            $detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog = 6;
            $anotacion = "SE REALIZA EL REGISTRO DEL PROCESO EN EL SISTEMA, FECHA: ".$fechalog." "."a las: ".$horalog;
            try {
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //EMPIEZA LA TRANSACCION
                $this->db->beginTransaction();

                $this->db->exec("
                  INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog)
                  VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')
                ");

                $this->db->exec("
                  INSERT INTO signot_proceso (radicado,fecharegistro,idjuzgadoorigen,idclasejuzgado,idclaseproceso,iddepartamento,idmunicipio,
                  idusuarioregistra,idusuarioedita,iddevolucion,claseproceso2,entidadcomisiona,asunto,despacholibra)
                  VALUES ('$radicadox','$fechalog','$idjuzgadoorigen','$idclasejuzgado','$idclaseproceso','$iddepartamento','$idmunicipio','$idusuario',0,0,'$claseproceso2','$entidadcomisiona','$asunto','$despacholibra')
                ");

                //OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA signot_proceso (Se omite la función lastId debido a que por simultaneidad en transacciones se están trocando procesos y partes)
                $lastIdProceso = "";
                $lastIdP = $this->db->prepare("
                  SELECT id
                  FROM signot_proceso
                  WHERE radicado = '$radicadox'
                  AND fecharegistro LIKE '$fechalog'
                  AND idusuarioregistra = '$idusuario'
                ");
                $lastIdP->execute();

                while($field = $lastIdP->fetch()) {
                  $lastIdProceso = $field['id'];
                }

                $this->db->exec("
                  INSERT INTO signot_proceso_anotacion (idradicado,idusuario,fecha,hora,anotacion)
                  VALUES ('$lastIdProceso','$idusuario','$fechalog','$horalog','$anotacion')
                ");
                //PARTES
                //******75088165//////Jorge Andres Valencia//////Cr 21 # 46 A 82//////8855934//////1-DEMANDANTE//////17-Caldas//////17001-MANIZALES******
                //75095585//////Andres Grajales//////Cr 213 # 748 B 434//////8875632//////1-DEMANDANTE//////13-Bolivar//////13001-CARTAGENA
                //1 EXPLODE
                $datospartes_1 = explode("******",$datospartes);
                $longitud_1    = count($datospartes_1);
                $i             = 1;
                $longpartes = $longitud_1 - 1;
                while($i < $longitud_1){
                    //2 EXPLODE
                    $datospartes_2 = explode("//////",$datospartes_1[$i]);
                    $idprocesox         = trim($datospartes_2[0]);
                    $idpartex           = trim($datospartes_2[1]);
                    $cedulaparte        = utf8_decode( trim($datospartes_2[2]) );
                    $nombreparte        = utf8_decode( trim($datospartes_2[3]) );
                    $idclaseparte       = explode("-",$datospartes_2[4]);
                    $idclaseparte_2     = trim($idclaseparte[0]);
                    $datosadicionales   = utf8_decode( trim($datospartes_2[5]) );
                    //JUAN ESTEBAN MUNERA 2017-08-10
                    $direccion          = utf8_decode( trim($datospartes_2[6]) );
                    $telefono           = utf8_decode( trim($datospartes_2[7]) );
                    $idDepartamento_2   = utf8_decode( trim($datospartes_2[8]) );
                    $idMunicipio_2      = utf8_decode( trim($datospartes_2[9]) );
                    //SI EL PROCESO NO ES VACIO Y LA PARTE SI
                     //if(is_numeric($idprocesox) && $idpartex == "VACIO") {
                     if($idpartex == "VACIO") {
                        $this->db->exec("
                          INSERT INTO signot_parte (cedula,nombre,datosadicionales,idusuarioregistra,idusuarioedita)
                          VALUES ('$cedulaparte','$nombreparte','$datosadicionales','$idusuario',0)
                        ");
                        //OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA signot_parte (Se omite la función lastId debido a que por simultaneidad en transacciones se están trocando procesos y partes)
                        $lastIdParte = "";
                        $lastIdPart = $this->db->prepare("
                          SELECT id
                          FROM signot_parte
                          WHERE cedula = '$cedulaparte'
                          AND idusuarioregistra = '$idusuario'
                        ");
                        $lastIdPart->execute();

                        while($field = $lastIdPart->fetch()) {
                          $lastIdParte = $field['id'];
                        }

                        $this->db->exec("
                          INSERT INTO signot_parteproceso (idproceso,idparte,idclaseparte,idusuarioregistra)
                          VALUES ('$lastIdProceso','$lastIdParte','$idclaseparte_2','$idusuario')
                        ");

                        $this->db->exec("
                          INSERT INTO signot_direccion (idparte,idproceso,telefono,direccion,iddepartamento,idmunicipio,idusuarioregistra,idusuarioedita)
                          VALUES ('$lastIdParte','$lastIdProceso','$telefono','$direccion','$idDepartamento_2','$idMunicipio_2','$idusuario',0)
                        ");
                    }
                    //SI NI EL PROCESO Y LA PARTE SON VACIAS
                    if($idpartex != "VACIO") {
                        $this->db->exec("
                          INSERT INTO signot_parteproceso (idproceso,idparte,idclaseparte,idusuarioregistra)
                          VALUES ('$lastIdProceso','$idpartex','$idclaseparte_2','$idusuario')
                        ");

                        $this->db->exec("
                          INSERT INTO signot_direccion (idparte,idproceso,telefono,direccion,iddepartamento,idmunicipio,idusuarioregistra,idusuarioedita)
                          VALUES ('$idpartex','$lastIdProceso','$telefono','$direccion','$idDepartamento_2','$idMunicipio_2','$idusuario',0)
                        ");
                    }
                    $i = $i + 1;
                }
                //SE TERMINA LA TRANSACCION
                $this->db->commit();
                print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=4"</script>';
            } catch (Exception $e) {
                //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
                $this->db->rollBack();
                print_r( $juzgadoorigen);
                echo " Fallo: " . $e->getMessage();
                /*print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=4b"</script>';*/
                echo '<script>alert("RADICADO YA EXISTE, NO ES POSIBLE SU REGISTRO.");</script>';
                echo '<script>location.reload();</script>';
            }
    }

    //*********************************************************************************************************************************************
                                                            //FUNCIONES PARA MODIFICAR PROCESO PARTE
    //*********************************************************************************************************************************************
        public function modificar_proceso_parte(){
        //SE OBTIENEN LOS DATOS
        $idusuario       = $_SESSION['idUsuario'];
        $valoridradicado = trim($_POST['idradicado']);
        $datospartes     = trim($_POST['datospartes']);
        $modelo     = new signotModel();
        //DATOS PARA EL REGISTRO DEL LOG
        $fechahora  = $modelo->get_fecha_actual();
        $datosfecha = explode(" ",$fechahora);
        $fechalog   = $datosfecha[0];
        $horalog    = $datosfecha[1];
        $tiporegistro = "Proceso";
        if( empty($iddocumento) ){
            $accion  = "Modifica un ".$tiporegistro." En el Sistema (SIGNOT), ID PROCESO: ".$valoridradicado;
        }        $detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
        $tipolog = 6;
        try {
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //EMPIEZA LA TRANSACCION
            $this->db->beginTransaction();
                $this->db->exec("
                  INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog)
                  VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')
                ");
                //******75088165//////Jorge Andres Valencia//////Cr 21 # 46 A 82//////8855934//////1-DEMANDANTE//////17-Caldas//////17001-MANIZALES******
                //75095585//////Andres Grajales//////Cr 213 # 748 B 434//////8875632//////1-DEMANDANTE//////13-Bolivar//////13001-CARTAGENA
                //1 EXPLODE
                $datospartes_1 = explode("******",$datospartes);
                $longitud_1    = count($datospartes_1);
                $i             = 1;
                $longpartes = $longitud_1 - 1;
                $anotacion  = "SE REALIZA LA MODIFICACION DEL PROCESO EN EL SISTEMA, FECHA: ".$fechalog." "."a las: ".$horalog. " CON NUMERO DE PARTES: ".$longpartes.", ID DEL PROCESO: ".$valoridradicado;
                $this->db->exec("
                  INSERT INTO signot_proceso_anotacion (idradicado,idusuario,fecha,hora,anotacion)
                  VALUES ('$valoridradicado','$idusuario','$fechalog','$horalog','$anotacion')
                ");
                while($i < $longitud_1){
                    //2 EXPLODE
                    $datospartes_2 = explode("//////",$datospartes_1[$i]);
                    $idprocesox     = trim($datospartes_2[0]);
                    $idpartex       = trim($datospartes_2[1]);
                    $cedulaparte    = utf8_decode( trim($datospartes_2[2]) );
                    $nombreparte    = utf8_decode( trim($datospartes_2[3]) );
                    $idclaseparte   = explode("-",$datospartes_2[4]);
                    $idclaseparte_2 = trim($idclaseparte[0]);
                    $datosadicionales = utf8_decode( trim($datospartes_2[5]) );
                    $telefono           = utf8_decode( trim($datospartes_2[6]) );
                    $direccion          = utf8_decode( trim($datospartes_2[7]) );
                    $departamento       = utf8_decode( trim($datospartes_2[8]) );
                    $municipio          = utf8_decode( trim($datospartes_2[9]) );
                    //SI EL PROCESO NO ES VACIO Y LA PARTE SI
                     if(is_numeric($idprocesox) && $idpartex == "VACIO") {
                        $this->db->exec("
                          INSERT INTO signot_parte (cedula,nombre,datosadicionales,idusuarioregistra,idusuarioedita)
                          VALUES ('$cedulaparte','$nombreparte','$datosadicionales','$idusuario',0)
                        ");
                        //OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA signot_parte (Se omite la función lastId debido a que por simultaneidad en transacciones se están trocando procesos y partes)
                        $lastIdParte = "";
                        $lastIdPart2 = $this->db->prepare("
                          SELECT id
                          FROM signot_parte
                          WHERE cedula = '$cedulaparte'
                          AND idusuarioregistra = '$idusuario'
                        ");
                        $lastIdPart2->execute();

                        while($field = $lastIdPart2->fetch()) {
                          $lastIdParte = $field['id'];
                        }
                        $this->db->exec("
                          INSERT INTO signot_parteproceso (idproceso,idparte,idclaseparte,idusuarioregistra)
                          VALUES ('$valoridradicado','$lastIdParte','$idclaseparte_2','$idusuario')
                        ");
                        $this->db->exec("
                          INSERT INTO signot_direccion (idparte,idproceso,telefono,direccion,iddepartamento,idmunicipio,idusuarioregistra,idusuarioedita)
                          VALUES ('$lastIdParte','$valoridradicado','$direccion','$telefono','$departamento','$municipio','$idusuario',0)
                        ");
                    }
                    //SI NI EL PROCESO Y LA PARTE SON VACIAS
                     if(is_numeric($idprocesox) && $idpartex != "VACIO") {
                        $this->db->exec("
                          INSERT INTO signot_parteproceso (idproceso,idparte,idclaseparte,idusuarioregistra)
                          VALUES ('$valoridradicado','$idpartex','$idclaseparte_2','$idusuario')
                        ");
                        $this->db->exec("
                          INSERT INTO signot_direccion (idparte,idproceso,telefono,direccion,iddepartamento,idmunicipio,idusuarioregistra,idusuarioedita)
                          VALUES ('$idpartex','$valoridradicado','$direccion','$telefono','$departamento','$municipio','$idusuario',0)
                        ");
                    }
                    $i = $i + 1;
                }
            //SE TERMINA LA TRANSACCION
            $this->db->commit();
        }
        catch (Exception $e) {
            //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
            $this->db->rollBack();
            echo $i." Fallo: " . $e->getMessage();
        }
    }



    //*********************************************************************************************************************************************
                                    //FUNCIONES PARA ACTIVAR PARTES EN UN PROCESO
    //*********************************************************************************************************************************************

    public function adicionar_direccion(){
            $modelo     = new signotModel();
            //SE OBTIENEN LOS DATOS
            $idusuario        = $_SESSION['idUsuario'];

            $idpartex         = trim($_POST['idpartex']);
            $idprocesox       = trim($_POST['idprocesox']);

            $direccion        = trim($_POST['direccion']);
            $telefono         = trim($_POST['telefono']);
            $iddepartamento_2 = trim($_POST['departamento']);
            $idmunicipio_2    = trim($_POST['municipio']);
            //DATOS PARA EL REGISTRO DEL LOG
            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];
            $accion     = "Adicionar Direccion Parte, Sistema SIGNOT, ID PROCESO: ".$idprocesox.", ID PARTE: ".$idpartex;
            $detalle    = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog    = 6;
            try {
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //EMPIEZA LA TRANSACCION
                $this->db->beginTransaction();
                $this->db->exec("INSERT INTO signot_direccion (idparte,idproceso,telefono,direccion,iddepartamento,
                                idmunicipio,idusuarioregistra,idusuarioedita)
                                VALUES ('$idpartex','$idprocesox','$telefono','$direccion','$iddepartamento_2',
                                        '$idmunicipio_2','$idusuario',0)");
                $this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
                //SE TERMINA LA TRANSACCION
                $this->db->commit();
                //echo "DATO: ".$tipodocumento;
                /*print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=6"</script>';*/
            } catch (Exception $e) {
                //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
                $this->db->rollBack();
                echo "Fallo: " . $e->getMessage();
                /*print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=6b"</script>';*/
            }
    }

    public function get_radicado($idradicado){
            $listar = $this->db->prepare("SELECT radicado FROM signot_proceso
                                        WHERE id = '$idradicado'");
            $listar->execute();
            return $listar;
    }

    //FORMA JOOMLA
    public function adicionar_direccion_2($datosdir){
        alert("x");

            $modelo     = new signotModel();

            //SE OBTIENEN LOS DATOS
            $idusuario     = $_SESSION['idUsuario'];

            $datosdir_2 = explode("////",datosdir);

            $idpartex         = trim($datosdir_2[0]);
            $idprocesox       = trim($datosdir_2[1]);

            $direccion        = trim($datosdir_2[2]);
            $telefono         = trim($datosdir_2[3]);
            $iddepartamento_2 = trim($datosdir_2[4]);
            $idmunicipio_2    = trim($datosdir_2[5]);

            //DATOS PARA EL REGISTRO DEL LOG

            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];


            $accion  = "Adicionar Direccion Parte, Sistema SIGNOT, ID PROCESO: ".$idprocesox.", ID PARTE: ".$idpartex;

            $detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog = 6;

            try {

                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //EMPIEZA LA TRANSACCION
                $this->db->beginTransaction();


                    $this->db->exec("INSERT INTO signot_direccion (idparte,idproceso,telefono,direccion,iddepartamento,
                                     idmunicipio,idusuarioregistra,idusuarioedita)
                                     VALUES ('$idpartex','$idprocesox','$telefono','$direccion','$iddepartamento_2',
                                     '$idmunicipio_2','$idusuario',0)");


                    $this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");


                //SE TERMINA LA TRANSACCION
                $this->db->commit();

                //echo "DATO: ".$tipodocumento;
                /*print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=6"</script>';*/

                return 0;

            }
            catch (Exception $e) {

                //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
                $this->db->rollBack();
                //echo "Fallo: " . $e->getMessage();
                /*print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=6b"</script>';*/

                return 1;
            }

    }
    //*********************************************************************************************************************************************
                                                             //FUNCIONES PARA CLASIFICACION DE LA PARTE
    //*********************************************************************************************************************************************

    public function adicionar_cp(){

            $modelo     = new signotModel();

            //SE OBTIENEN LOS DATOS
            $idusuario     = $_SESSION['idUsuario'];


            $idpartex         = trim($_POST['idpartex']);
            $idprocesox       = trim($_POST['idprocesox']);


            $clasificacionpartex = trim($_POST['clasificacionpartex']);


            //DATOS PARA EL REGISTRO DEL LOG

            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];


            $accion  = "Adicionar Clasificacion Parte, Sistema SIGNOT, ID PROCESO: ".$idprocesox.", ID PARTE: ".$idpartex;

            $detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog = 6;

            try {

                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //EMPIEZA LA TRANSACCION
                $this->db->beginTransaction();


                    $this->db->exec("INSERT INTO signot_parteproceso (idproceso,idparte,idclaseparte,idusuarioregistra)
                                     VALUES ('$idprocesox','$idpartex','$clasificacionpartex','$idusuario')");



                    $this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");


                //SE TERMINA LA TRANSACCION
                $this->db->commit();

                //echo "DATO: ".$tipodocumento;
                /*print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=6"</script>';*/

            }
            catch (Exception $e) {

                //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
                $this->db->rollBack();
                echo "Fallo: " . $e->getMessage();
                /*print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=6b"</script>';*/
            }

    }

    public function modificar_cp(){

            $modelo     = new signotModel();

            //SE OBTIENEN LOS DATOS
            $idusuario     = $_SESSION['idUsuario'];


            $idpartex      = trim($_POST['idpartex']);
            $idprocesox    = trim($_POST['idprocesox']);
            $idclasipartex = trim($_POST['idclasipartex']);


            $clasificacionpartex = trim($_POST['clasificacionpartex']);


            //DATOS PARA EL REGISTRO DEL LOG

            $fechahora  = $modelo->get_fecha_actual();
            $datosfecha = explode(" ",$fechahora);
            $fechalog   = $datosfecha[0];
            $horalog    = $datosfecha[1];


            $accion  = "Modificar Clasificacion Parte, Sistema SIGNOT, ID PROCESO: ".$idprocesox.", ID PARTE: ".$idpartex;

            $detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
            $tipolog = 6;

            try {

                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //EMPIEZA LA TRANSACCION
                $this->db->beginTransaction();


                    /*$this->db->exec("INSERT INTO signot_parteproceso (idproceso,idparte,idclaseparte,idusuarioregistra)
                                     VALUES ('$idprocesox','$idpartex','$clasificacionpartex','$idusuario')");*/



                    $this->db->exec("UPDATE signot_parteproceso SET idclaseparte  = '$clasificacionpartex'
                                     WHERE idproceso = '$idprocesox' AND idparte = '$idpartex' AND idclaseparte = '$idclasipartex'");



                    $this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");


                //SE TERMINA LA TRANSACCION
                $this->db->commit();

                //echo "DATO: ".$tipodocumento;
                /*print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=6"</script>';*/

            }
            catch (Exception $e) {

                //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
                $this->db->rollBack();
                echo "Fallo: " . $e->getMessage();
                /*print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=6b"</script>';*/
            }

    }

    public function inactivar_direccion_parte(){

        $modelo     = new signotModel();

        //SE OBTIENEN LOS DATOS
        $idusuario       = $_SESSION['idUsuario'];

        //ID
        $iddir       = trim($_GET['iddir']);

        //RADICADO
        $idproc      = trim($_GET['idproc']);
        $desprocesox = trim($_GET['desprocesox']);


        //DATOS PARA EL REGISTRO DEL LOG
        $fechahora  = $modelo->get_fecha_actual();
        $datosfecha = explode(" ",$fechahora);
        $fechalog   = $datosfecha[0];
        $horalog    = $datosfecha[1];



        $accion  = "INACTIVA DIRECCION En el Sistema (SIGNOT), ID DIRECCION: ".$iddir.",ID RADICADO: ,".$idproc.", RADICADO:".$desprocesox;



        $detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
        $tipolog = 6;


        try {

            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //EMPIEZA LA TRANSACCION
            $this->db->beginTransaction();


                $this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog)
                                 VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");



                $this->db->exec("UPDATE signot_direccion SET idusuarioedita = '$idusuario',estadodir = 'INACTIVA'
                                 WHERE id = '$iddir'");





            //SE TERMINA LA TRANSACCION
            $this->db->commit();

            echo '<script languaje="JavaScript">

                    alert("PROCESO SE REALIZA CORRECTAMENTE");

                </script>';

        }
        catch (Exception $e) {

            //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
            $this->db->rollBack();

            echo '<script languaje="JavaScript">

                    alert("ERROR AL REALIZAR EL PROCESO");

                </script>';

                echo " Fallo: " . $e->getMessage();
        }


    }

    public function cambiaestado_direccion_parte(){

        $modelo     = new signotModel();

        //SE OBTIENEN LOS DATOS
        $idusuario       = $_SESSION['idUsuario'];

        //ID
        $iddir       = trim($_GET['iddir']);

        //RADICADO
        $idproc      = trim($_GET['idproc']);
        $desprocesox = trim($_GET['desprocesox']);


        //DATOS PARA EL REGISTRO DEL LOG
        $fechahora  = $modelo->get_fecha_actual();
        $datosfecha = explode(" ",$fechahora);
        $fechalog   = $datosfecha[0];
        $horalog    = $datosfecha[1];



        $accion  = "CAMBIA ESTADO DIRECCION En el Sistema (SIGNOT), ID DIRECCION: ".$iddir.",ID RADICADO: ,".$idproc.", RADICADO:".$desprocesox;



        $detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
        $tipolog = 6;


        try {

            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //EMPIEZA LA TRANSACCION
            $this->db->beginTransaction();


                $this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog)
                                 VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");



                $this->db->exec("UPDATE signot_direccion SET idusuarioedita = '$idusuario',estadodir = ''
                                 WHERE id = '$iddir'");





            //SE TERMINA LA TRANSACCION
            $this->db->commit();

            echo '<script languaje="JavaScript">

                    alert("PROCESO SE REALIZA CORRECTAMENTE");

                </script>';

        }
        catch (Exception $e) {

            //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
            $this->db->rollBack();

            echo '<script languaje="JavaScript">

                    alert("ERROR AL REALIZAR EL PROCESO");

                </script>';

                echo " Fallo: " . $e->getMessage();
        }


    }
        // JUAN ESTEBAN MUNERA BETANCUR 30/06/2017
        //*************************************************************************************************************************
        // 2017-07-07 *************************************************************************************************************
        public function datos_proceso($id){
            $listar = $this->db->prepare("SELECT * FROM signot_proceso where id = '$id'" );
            $listar->execute();
            return $listar;
        }
        //***************************************************************************** //
        // --------------- DÍAS FESTIVOS  --------------------------------------------- //
        // ******************************* ---------------- *************************** //
        public function calendario_festivos(){
            date_default_timezone_set('America/Bogota');
            $año = date('Y');
            try{
                $listar = $this->db->prepare("SELECT * FROM `calendario_festivos`");
                $listar->execute();
                return $listar;
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
    function calcularFechasHabiles($num_dias, $fechaInicial){
//      function weekend($num_dias, $fechaInicial){
            $modelo     = new signotModel();
            $festivos  = $modelo->calendario_festivos();

            for ($i=0; $i<$num_dias; $i++){
                $Segundos = $Segundos + 86400;
                $caduca = date("D",strtotime($fechaInicial)+$Segundos);
                if ($caduca == "Sat"){
                    $i--;
                    $FechaSab = date("Y-m-d",strtotime($fechaInicial)+$Segundos);
                }else if ($caduca == "Sun") {
                    $i--;
                    $FechaDom = date("Y-m-d",strtotime($fechaInicial)+$Segundos);
                }else{
                    $FechaFinal = date("Y-m-d",strtotime($fechaInicial)+$Segundos);
                    $fechas_totales_habiles[] = $FechaFinal;
                }
            }
            while($row = $festivos->fetch()){
                $array_festivos[] = $row['fes_fecha'];
            }
            foreach($fechas_totales_habiles as $valor){
                if(array_search($valor, $array_festivos) !== false){
                    $holiday [] = $valor;
                }else {
                    $arraglo_after_holiday_0 []= $valor;
                }
                $ultimaFecha = $valor;
            }
            $cantidad_festivos = count($holiday);
            $total = 29 - count($arraglo_after_holiday_0);
            return array($arraglo_after_holiday_0, $cantidad_festivos,$total, $ultimaFecha);
        }
        //JUAN ESTEBAN MUNERA BETANCUR
        //2018-02-09
        function calcular_fecha_habil($num_dias, $fechaInicial){
            $modelo     = new signotModel();
            $festivos  = $modelo->calendario_festivos();

            for ($i=0; $i<$num_dias; $i++){
                $Segundos = $Segundos + 86400;
                $caduca = date("D",strtotime($fechaInicial)+$Segundos);
                if ($caduca == "Sat"){
                    $i--;
                    $FechaSab = date("Y-m-d",strtotime($fechaInicial)+$Segundos);
                }else if ($caduca == "Sun") {
                    $i--;
                    $FechaDom = date("Y-m-d",strtotime($fechaInicial)+$Segundos);
                }else{
                    $FechaFinal = date("Y-m-d",strtotime($fechaInicial)+$Segundos);
                    $fechas_totales_habiles[] = $FechaFinal;
                }
            }
            while($row = $festivos->fetch()){
                $array_festivos[] = $row['fes_fecha'];
            }
            foreach($fechas_totales_habiles as $valor){
                if(array_search($valor, $array_festivos) !== false){
                    $holiday [] = $valor;
                }else {
                    $arraglo_after_holiday_0 [] = $valor;
                }
                $ultimaFecha = $valor;
            }
            $cantidad_festivos = count($holiday);
            $total = $num_dias - count($arraglo_after_holiday_0);
            return array($arraglo_after_holiday_0, $cantidad_festivos,$total, $ultimaFecha);
        }
        public function get_Lideres_correspondencia($id){
            $listar = $this->db->prepare("SELECT us.empleado AS nombre, us.id AS id
                FROM pa_juzgado AS juz
                INNER JOIN pa_usuario AS us ON juz.idusuariojuzgadocargo = us.id
                GROUP BY id" );
            $listar->execute();
            return $listar;
        }
        //************************* JUAN ESTEBAN MUNERA BETANCUR 30/06/2017 *****************************************************
        // -------------------------------- SIGNOT - SEGUIMIENTO PROCESO PARA LOS JUZGADOS --------------------------------------
        public function JuzgadoUsuario($id){
            $listar = $this->db->prepare("
                SELECT us.id AS id, juz.id AS idJ,juz.nombre AS nombre, juz.radicadojuzgado AS codJ, juz.numero_juzgado AS numJ
                FROM pa_usuario AS us
                INNER JOIN pa_juzgado AS juz ON us.id = juz.cod_usuario_juzgado
                WHERE us.id = '$id'
            ");
            $listar->execute();
            return $listar;
    }

        public function get_datos_procesoJ($idJ){
            $listar = $this->db->prepare("
                SELECT pro.id,pro.radicado,pro.iddevolucion
                FROM signot_proceso pro
                WHERE pro.idjuzgadoorigen = '$idJ'
                ORDER BY pro.id DESC LIMIT 10
            ");
            $listar->execute();
            return $listar;
        }

        public function get_datos_ClaseParte(){
            $listar = $this->db->prepare("
                SELECT *
                FROM signot_clasificacion_parte pro
                ORDER BY descripcion ASC
            ");
            $listar->execute();
            return $listar;
        }
        //************************* JUAN ESTEBAN MUNERA BETANCUR 06/10/2017 *****************************************************
        // -------------------------------- SIGNOT - VER IDMUNICIPIO - DEPARTAMENTO --------------------------------------
        public function Direccion_Anotacion($idParte, $idProceso){
            $listar = $this->db->prepare("
                SELECT iddepartamento, idmunicipio
                FROM signot_direccion
                WHERE idparte= '$idParte' and idproceso ='$idProceso'
                    AND endevolucion is null AND estadodir is null;
            ");
            $listar->execute();
            return $listar;
    }
    }//FIN CLASE

?>
