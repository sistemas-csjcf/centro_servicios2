<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user = $_SESSION['idUsuario']; 
    if(isset($id_user)){
?>
    <h1 class="page-header">Visitas Programadas</h1>
    <div class="well well-sm text-right">
    </div>
    <table id="example_historial" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th title="Código Visita"> ID</th>
                <th>Fecha Visita</th>
                <th>Radicado</th>
                <th>Solicitante</th>
                <th>Sub-Clase Proceso</th>
                <th>Partes Proceso</th>
                <th>Observaciones</th>
                <th>Fecha Audiencia</th>
                <th title="Finalizar Visita">Finalizar</th>           
            </tr>
        </thead>
        <tbody>        
            <?php foreach($this->model->Listar_Visitas_TS() as $r): ?>
                <tr>
                    <td><?php echo $r->vis_pro_id; ?></td>
                    <td><?php echo $r->vis_pro_fecha_visita; ?></td>
                    <td><?php echo $r->vis_pro_radicado; ?></td>
                    <td><?php echo $r->vis_pro_solicitante; ?></td>
                    <td><?php echo $r->vis_pro_subclase_proceso; ?></td>
                    <td><?php echo $r->vis_pro_datos_partes; ?></td>
                    <td><?php echo $r->vis_pro_comentarios; ?></td>
                    <td><?php echo $r->vis_pro_fecha_audiencia; ?></td>
                    <td><a onclick="javascript:return confirm('¿Seguro de finalizar la visita?');" href="?c=Visitas&a=Finalizar&data-id=<?php echo $r->vis_pro_id; ?>&data-us=<?php echo $id_user; ?>" title="Finalizar Solicitud Visita"><span class="glyphicon glyphicon-ok-sign"></span></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table> 
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.30/centro_servicios2" ); } ?>