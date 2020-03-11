<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user = $_SESSION['idUsuario']; 
    if(isset($id_user)){
?>
    <h1 class="page-header">Valoración Informe Visita Domiciliaria</h1>
    <div class="well well-sm text-right">
    </div>
    <table id="example_historial" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th title="Código Valoración Visita">ID</th>
                <th title="Código Visita">Id Visita</th>
                <th>Fecha Visita</th>
                <th>Fecha Recepción Informe</th>
                <th>Asistente Social</th>
                <th>Radicado</th>
                <th>Solicitante</th>
                <th>Sub-Clase Proceso</th>
                <th>Formato</th>
                <th>Registrar Valoraciòn</th>
                <th>Enviar Valoración</th>
            </tr>
        </thead>
        <tbody>        
            <?php foreach($this->model->Listar_Informe_Valoracion_SinEnviarD($id_user) as $r): ?>
                <tr>
                    <td><?php echo $r->inf_val_id; ?></td>
                    <td><?php echo $r->vis_pro_id; ?></td>
                    <td><?php echo $r->vis_pro_fecha_visita; ?></td>
                    <td><?php echo $r->inf_val_fechaRecepcion; ?></td>
                    <td><?php echo $r->vis_TSoci_nombre; ?></td>
                    <td><?php echo $r->vis_pro_radicado; ?></td>
                    <td><?php echo $r->vis_pro_solicitante; ?></td>
                    <td><?php echo $r->vis_pro_subclase_proceso; ?></td>
                    <td><a href="uploads_informes/Informes_Seguimiento/<?php echo $r->vis_inf_id_usuario.'/'.$r->vis_inf_ruta_formato; ?>" target="_blank" style="text-decoration:none;"><i class="icon-download3"></i>Descargar</a></td>
                    <td><a href="?c=Visitas&a=Registrar_Valoracion&id=<?php echo $r->inf_val_id; ?>&data-us=<?php echo $id_user; ?>" title="Registrar Valoración Visita"> <span class="fa fa-pencil-square-o fa-2x"></span></a></td>
                    <?php if($r->inf_val_nombreValoracion=="" ){ ?>
                        <td><a onclick="javascript:return alert('La valoración de la visita a ser enviada no registra información.');" href="#" title="Enviar Valoración Visita"><i class="fa fa-envelope-o fa-2x alert-danger" aria-hidden="true"></i></a></td>
                    <?php }else{ ?>
                        <td><a onclick="javascript:return confirm('¿Seguro de enviar valoración visita?');" href="?c=Visitas&a=Enviar_Valoracion_Visita&id=<?php echo $r->inf_val_id; ?>&fecha_recepcion=<?php echo $r->inf_val_fechaRecepcion; ?>" title="Enviar Valoración Visita" ><i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i></a></td>
                    <?php } ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table> 
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>