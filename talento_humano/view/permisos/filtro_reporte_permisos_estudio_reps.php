<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user = $_REQUEST['user'];  // se usa la cedula del usuario
    $fechaI = $_REQUEST['inicio'];
    $fechaF = $_REQUEST['fin'];
    $estado = $_REQUEST['estado'];
    require_once "../../model/hojaVida_model.php";
    $modelo               = new HojaVida();
    $idaccion             = '4';
    $datos_us_accionReps  = $modelo->get_lista_usuario_accionesJE($idaccion);
    $us_privilegios       = $datos_us_accionReps->fetch();
    $usuarioPr            = explode("////",$us_privilegios['usuario']);
    
    if ( !empty($id_user) ) {	
        $filtro1 = " AND per_est_cedula = '$id_user' ";
    }
    if ( !empty($fechaI) && !empty($fechaF) ) {		
        $filtro2 = " AND (per_est_fecha_solicitud >= '$fechaI' AND per_est_fecha_solicitud <= '$fechaF') ";
    }
    if ( $estado != '') {
        $filtro3 = " AND per_est_estado = '$estado' ";
    }
    $filtrox = $filtro1." ".$filtro2." ".$filtro3;
    
    $user_se = $_SESSION['idUsuario'];
    require_once "../../core/conexion.php";
    $link = conectarse();
    $sql = ("SELECT `per_est_id`, `per_est_num_resolucion`, `per_est_fecha_solicitud`, `per_est_cedula`, 
                    `per_est_nombre`, `per_est_id_usuario`, `per_est_id_usuarioE`, `per_est_fechaE`, `per_est_institucion`, `per_est_programa`, 
                    `per_est_fecha_inicio`, `per_est_fecha_final`, `per_est_ruta_doc_horario`, `per_est_ruta_doc_matricula`, `per_est_estado` 
             FROM th_permiso_estudio
             WHERE per_est_id >= '1' " .$filtrox. " ORDER BY per_est_id DESC");
    $result = mysql_query($sql, $link);
    
    $num_filas = mysql_num_rows($result); 
    if(isset($user_se)){
?>
    <h1 class="page-header">Filtro Listado Permisos de Estudio</h1>
    <table id="example" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #4682B4; color: white;">
                    <th title="Código Solicitud Permiso" style="width:12px;">ID</th>
                    <th style="width:12px;">Fecha Solicitud</th>
                    <th style="width:12px;">Usuario</th>
                    <th title="Institución" style="width:12px;">Institución</th>
                    <th style="width:12px;">Programa</th>
                    <th style="width:12px;">Ver Horario</th>
                    <th title="Constancia Horario" style="width:12px;">Ccia. Horario</th>
                    <th title="Constancia Matricula" style="width:12px;">Ccia. Matricula</th>
                    <th style="width:12px;">Estado</th>
                </tr>
            </thead>
            <tbody> 
                <?php
                    while($per = mysql_fetch_array($result)){
                        $id_est = $per['per_est_id'];
                ?>
                    <tr>
                        <td>
                            <?php 
                                if($per['per_est_estado'] == 0)
                                {
                                    $estado_color ="goldenrod";
                                    $estado = "Pendiente";
                                }
                                else if($per['per_est_estado'] == 1)
                                {
                                    $estado_color ="green";
                                    $estado = "Aprobado";
                                }
                                else
                                {
                                    $estado_color ="red";
                                    $estado = "No Aprobado";
                                }
                            ?>
                            <span class="glyphicon glyphicon-flag" style="color: <?php echo $estado_color; ?>"></span>
                            <?php echo $per['per_est_id']; ?>
                        </td>
                        <td><?php echo $per['per_est_fecha_solicitud']; ?></td>
                        <td><?php echo $per['per_est_nombre']; ?></td>
                        <td><?php echo $per['per_est_institucion']; ?></td>
                        <td><?php echo $per['per_est_programa']; ?></td>

                        <td><button class="btn btn-default" data-toggle="modal" id="modal_Ver_Horario" data-target="#myModal_Horario" data-id="<?php echo $per['per_est_id'] ?>"data-inicio="<?php echo $per['per_est_fecha_inicio']; ?>"data-final="<?php echo $per['per_est_fecha_final']; ?>" ><span class="icon-clock2" style="font-size: 20px;"> </span></button></td>

                        <td><a href="#" class="btn btn-default" onclick="ver_pdf(4,'<?php echo $per['per_est_ruta_doc_horario']; ?>');return false;" target="_blank"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a></td>
                        <td><a href="#" class="btn btn-default" onclick="ver_pdf(5,'<?php echo $per['per_est_ruta_doc_matricula']; ?>');return false;" target="_blank"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a></td>

                        <?php if ( in_array($_SESSION['idUsuario'], $usuariosa) ) { ?>  
                        <?php if($estado == "Pendiente") { ?>

                        <td><button class="btn btn-success" data-toggle="modal" data-target="#myModal_Estado" data-id="<?php echo $r->per_est_id ?>" data-estado="<?php echo $per['per_est_estado'] ?>" >
                            <span class="icon-info"></span></button>
                        </td>
                        <?php } else if ($estado == "Aprobado") { ?>
                        <td> <?php echo $estado ?> <a href="app/libs/plantillero/crear_permiso_estudio.php?id=<?php echo $per['per_est_id']; ?>" style="text-decoration: none;"><span class="icon-file-word" style="font-size: 25px;"> </span></a> 
                        </td>
                        <?php } else { echo "<td>$estado</td>"; }?>

                        <?php } else { ?>
                            <td> <?php echo $estado; ?> </td>
                        <?php } ?>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <script>
        $(document).ready(function() {
            $('#example4').DataTable();
            $('#example_historial').DataTable( {
                "order": [[ 0, "desc" ]]
            });
        } );
        $('.selectpicker').selectpicker({
            style: 'btn-info',
            size: 4
        });
    </script> 
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>