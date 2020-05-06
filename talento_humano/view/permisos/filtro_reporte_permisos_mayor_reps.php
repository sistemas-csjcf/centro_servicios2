<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user = $_REQUEST['user'];
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
        $filtro1 = " AND ep.idusuario = '$id_user' ";
    }
    if ( !empty($fechaI) && !empty($fechaF) ) {		
        $filtro2 = " AND (ep.fecha_solicitud >= '$fechaI' AND ep.fecha_solicitud <= '$fechaF') ";
    }
    if ( $estado != '') {
        $filtro3 = " AND ep.estado = '$estado' ";
    }
    $filtrox = $filtro1." ".$filtro2." ".$filtro3;
    
    $user_se = $_SESSION['idUsuario'];
    require_once "../../core/conexion.php";
    $link = conectarse();
    $sql = ("SELECT ep.id, ep.idusuario, us.empleado, ep.idusuario_registra, ep.fecha_solicitud, ep.detalle, ep.doc_adjunto, 
              ep.flag_out, ep.num_resolucion, ep.observaciones, ep.estado 
           FROM empleado_permiso_mayor ep 
           INNER JOIN pa_usuario us 
           ON ep.idusuario = us.id
           WHERE ep.id >= '1' " .$filtrox. " ORDER BY ep.id DESC");
    $result = mysql_query($sql, $link);
    
    $num_filas = mysql_num_rows($result); 
    if(isset($user_se)){
?>
    <h1 class="page-header">Filtro Listado Permisos mayores a un día</h1>
    <table id="example" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #4682B4; color: white;">
                    <th title="Código Solicitud Permiso" style="width:12px;">ID.</th>
                    <th style="width:12px;">Usuario</th>
                    <th style="width:6px;">Fecha</th>
                    <th style="width:12px;">Detalle</th>
                    <th style="width:12px;">Tiempo</th>
                    <th style="width:10px;">Doc. Adjunto</th>
                    <th style="width:12px;">Estado</th>
                </tr>
            </thead>
            <tbody> 
                <?php while($r = mysql_fetch_array($result)){
                    if($r['estado'] == 2){
                        $estado = "En Proceso";
                        $color ="sandybrown";
                    }
                    if($r['estado'] == 1){
                        $estado = "Aprobado";
                        $color ="green";
                    }
                    if($r['estado'] == 0){
                        $estado = "No Aprobado";
                        $color ="red";
                    }
                ?>
                <tr>
                    <td><?php echo $r['id']; ?> <span class="icon-flag" style="color: <?php echo $color; ?>"></span> </td>
                    <td><?php echo $r['empleado']; ?></td>
                    <td><?php echo $r['fecha_solicitud']; ?></td>
                    <td><?php echo $r['detalle']; ?></td>

                    <td>
                        <button class="btn btn-default" data-toggle="modal" id="modal_Ver_Horario" data-target="#myModal_Horario" data-id="<?php echo $r['id'] ?>"><span class="icon-clock2" style="font-size: 20px;"> </span></button>
                    </td>

                    <?php if($r['doc_adjunto'] != ""){ ?>
                        <td><a href="#" class="btn btn-default" onclick="ver_pdf(6,'<?php echo $r['doc_adjunto']; ?>');return false;" target="_blank"><span class="icon-download3"></span></a>
                        </td>
                    <?php } else { ?>
                        <td><span class="icon-cross" style="color: red"></span></td>
                    <?php } ?>

                    <?php if($estado == "En Proceso" && in_array($_SESSION['idUsuario'], $usuarioPr) ) { ?>
                        <td><button class="btn btn-success" data-toggle="modal" data-target="#myModal_Estado" 
                            data-id="<?php echo $r['id'] ?>" 
                            data-estado="<?php echo $r["estado"]; ?>"
                            data-flag_out="<?php echo $r['flag_out']; ?>"><span class="icon-info"></span></button></td>
                    <?php } else { ?>
                        <td><?php echo $estado ?></td>
                    <?php } ?>

                    <!--<?php if (in_array($_SESSION['idUsuario'],$usuariosa) ) { ?> 
                        <?php if($estado == "En Proceso"){ ?>
                            <td><button class="btn btn-success" data-toggle="modal" data-target="#myModal_Estado" 
                                data-id="<?php echo $r['id']; ?>" 
                                data-flag_out="<?php echo $r['flag_out']; ?>" 
                                data-estado="<?php echo $r['estado']; ?>" ><span class="icon-info"></span></button>
                            </td>
                        <?php }else if($estado == "Aprobado"){ ?>
                            <td><?php echo $estado ?> <a href="app/libs/plantillero/crear_permiso_ordinario.php?id=<?php echo $r['id']; ?>" style="text-decoration: none;"><span class="icon-file-word" style="font-size: 25px;"> </span></a> </td>
                        <?php }else{ ?>
                            <td><?php echo $estado ?></td>
                        <?php } ?>
                    <?php } else { ?>
                        <td><span class="glyphicon glyphicon-refresh">Cancelar</span></td>
                    <?php } ?> -->
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