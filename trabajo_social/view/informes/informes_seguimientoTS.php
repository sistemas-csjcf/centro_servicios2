<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user = $_SESSION['idUsuario']; 
    if(isset($id_user)){
?>
    <h1 class="page-header">Informe Seguimiento Visita Domiciliaria</h1>
    <div class="well well-sm text-right">
    </div>
    <table id="example_historial" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th title="Código Visita"> ID</th>
                <th>Fecha Visita</th>
                <th>Radicado</th>
                <th>Solicitante</th>
                <th>Sub-Clase Proceso</th>
                <th>Observaciones</th>
                <th title="Registrar información del informe">Registrar Informe</th>
                <th title="Enviar informe seguimiento">Enviar Informe</th>
            </tr>
        </thead>
        <tbody>        
            <?php foreach($this->model->Listar_Visitas_TS_Informe() as $r): ?>
                <tr>
                    <td><?php echo $r->vis_pro_id; ?></td>
                    <td><?php echo $r->vis_pro_fecha_visita; ?></td>
                    <td><?php echo $r->vis_pro_radicado; ?></td>
                    <td><?php echo $r->vis_pro_solicitante; ?></td>
                    <td><?php echo $r->vis_pro_subclase_proceso; ?></td>
                    <td><?php echo $r->vis_pro_comentarios; ?></td>
                    <td><a href="?c=Visitas&a=Registrar_Informe_Seguimiento&id=<?php echo $r->vis_inf_id; ?>&data-us=<?php echo $id_user; ?>" title="Registrar Informe Seguimiento"> <span class="fa fa-pencil-square-o fa-2x"></span></a></td>
                    <?php if($r->vis_inf_hora_fin == "" || $r->vis_inf_hora_inicio =="" || $r->vis_inf_ruta_formato ==""){ ?>
                        <td><a onclick="javascript:return alert('El informe a ser enviado no registra información.');" href="#" ><i class="fa fa-envelope-o fa-2x alert-danger" aria-hidden="true"></i></a></td>
                    <?php }else{ ?>
                        <td><a onclick="javascript:return confirm('¿Seguro de enviar informe?');" href="?c=Visitas&a=Enviar_Informe&id=<?php echo $r->vis_inf_id; ?>&fecha_visita=<?php echo $r->vis_pro_fecha_visita; ?>" ><i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i></a></td>
                    <?php } ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table> 
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>