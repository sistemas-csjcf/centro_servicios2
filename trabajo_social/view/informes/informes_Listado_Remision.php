<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user = $_SESSION['idUsuario'];
    $ListarPermisos         = $modelo->privilegio_listarPermisos();
    $usuarios               = $ListarPermisos->fetch();
    $accion_listarPermisos  = explode("////",$usuarios[usuario]);
    if(isset($id_user)){
        if ( in_array($_SESSION['idUsuario'],$accion_listarPermisos) ){
?>
        <h1 class="page-header col-md-12">Remisión Informe Visita Domiciliaria</h1>
        <div class="well well-sm text-right">
        </div>
        <table id="example_historial" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th title="Código Remisión Informe Visita">ID</th>
                    <th title="Código Seguimiento Informe Visita">Id Seguimiento</th>
                    <th title="Código Solicitud Visita">Id Visita</th>
                    <th>Fecha Visita</th>
                    <th>Fecha Presentación</th>
                    <th>Asistente Social</th>
                    <th>N° Oficio Remisorio</th>
                    <th>N° Folios</th>
                    <th>Radicado</th>
                    <th>Solicitante</th>
                    <th>Sub-Clase Proceso</th>
                    <th>Comentarios</th>
                    <th>Nª Personas Entrevistadas</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Duraciòn Visita</th>
                    <th>Días Transcurridos</th>
                    <th>Formato</th>
                    <th>Registrar Informe</th>
                    <th title="Enviar Remisión Informe Visita">Enviar Informe</th>
                </tr>
            </thead>
            <tbody>        
                <?php foreach($this->model->Listar_Informe_Remision() as $r): ?>
                    <tr>
                        <td><?php echo $r->inf_rem_id; ?></td>
                        <td><?php echo $r->vis_inf_id; ?></td>
                        <td><?php echo $r->vis_pro_id; ?></td>
                        <td><?php echo $r->vis_pro_fecha_visita; ?></td>
                        <td><?php echo $r->inf_rem_fecha_presentacion; ?></td>
                        <td><?php echo $r->vis_TSoci_nombre; ?></td>
                        <td><?php echo $r->inf_rem_num_oficio; ?></td>
                        <td><?php echo $r->inf_rem_num_folios; ?></td>
                        <td><?php echo $r->vis_pro_radicado; ?></td>
                        <td><?php echo $r->vis_pro_solicitante; ?></td>
                        <td><?php echo $r->vis_pro_subclase_proceso; ?></td>
                        <td><?php echo $r->inf_rem_observaciones; ?></td>
                        <td><?php echo $r->vis_inf_num_personas; ?></td>
                        <td><?php echo $r->vis_inf_hora_inicio; ?></td>
                        <td><?php echo $r->vis_inf_hora_fin; ?></td>
                        <td><?php echo $r->vis_inf_duracion." minuto(s)"; ?></td>
                        <td><?php echo $r->vis_inf_dif_dias; ?></td>
                        <?php if($r->vis_inf_ruta_formato !=""){ ?>
                            <td><a href="<?php echo "uploads_informes/Informes_Seguimiento/".$r->vis_inf_id_usuario."/".$r->vis_inf_ruta_formato; ?>" target="_blank" title="Descargar Formato Informe Seguimiento" style="text-decoration:none;" ><i class="icon-download3 fa-2x" aria-hidden="true"></i></a></td>
                        <?php }else{ ?>
                            <td><i class="glyphicon glyphicon-floppy-remove fa-2x alert-danger" aria-hidden="true" style="color: red;"></i></td>
                        <?php } ?>
                        <td><a href="?c=Visitas&a=Registrar_Informe_Remision&id=<?php echo $r->inf_rem_id; ?>&data-us=<?php echo $id_user; ?>" title="Registrar Remisión Informe Visita"> <span class="fa fa-pencil-square-o fa-2x"></span></a></td>
                        <?php if($r->inf_rem_num_folios < 1 ){ ?>
                            <td><a onclick="javascript:return alert('El informe a ser enviado no registra información.');" href="#" ><i class="fa fa-envelope-o fa-2x alert-danger" aria-hidden="true"></i></a></td>
                        <?php }else{ ?>
                            <td><a onclick="javascript:return confirm('¿Seguro de enviar este informe?');" href="?c=Visitas&a=Enviar_Informe_Remision&id=<?php echo $r->inf_rem_id; ?>&fecha_presentacion=<?php echo $r->inf_rem_fecha_presentacion; ?>" ><i class="fa fa-envelope-o fa-2x " aria-hidden="true"></i></a></td>
                        <?php } ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table> 
    <?php }else{ ?><br/>
        <h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para consultar el Informe de Remisión Visita Domiciliaria</h4>
    <?php } ?>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>