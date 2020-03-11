<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user = $_SESSION['idUsuario'];
    
    if(isset($id_user)){
?>
    <h1 class="page-header">Historial Visitas Programadas</h1>

    <div class="well well-sm text-right">
        <!--<a class="btn btn-primary" href="?c=Visitas&a=Crud">Nuevo Registro</a> -->
    </div>
    <table id="example_historial" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr style="background-color: #4682B4; color: white;">
                <th> ID</th>
                <th>Fecha Visita</th>
                <th>Radicado</th>
                <th>Solicitante</th>
                <th>Sub-Clase Proceso</th>
                <th>Observaciones</th>
                <th>Fecha Audiencia</th>
                <th>Estado</th>      
            </tr>
        </thead>
        <tbody>        
            <?php foreach($this->model->Listar_Historial_TS() as $r): ?>
                <tr>
                    <td><?php echo $r->vis_pro_id; ?></td>
                    <td><?php echo $r->vis_pro_fecha_visita; ?></td>
                    <td><?php echo $r->vis_pro_radicado; ?></td>
                    <td><?php echo $r->vis_pro_solicitante; ?></td>
                    <td><?php echo $r->vis_pro_subclase_proceso; ?></td>
                    <td><?php echo $r->vis_pro_comentarios; ?></td>
                    <td><?php echo $r->vis_pro_fecha_audiencia; ?></td>
                    <?php if( $r->vis_pro_estado =='Pendiente'){ ?>
                        <td><button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModalNorm" data-id="<?php echo $r->vis_pro_id  ?>"data-idtsocial="<?php echo $r->vis_pro_id_TSocial ?>" ><span class="icon-cancel-circle"><?php echo  $r->vis_pro_estado; ?></span></button></td>
                    <?php }else if( $r->vis_pro_estado =='Aprobada' && $r->vis_pro_finalizada==0){ ?>
                        <td>
                            <?php echo $r->vis_pro_estado; ?><span class="glyphicon glyphicon-ok-sign" style="color: #008000;"></span>
                            <span class="glyphicon glyphicon-ok-sign" style="color: #A9A9A9;"></span>
                        </td>
                    <?php }else if( $r->vis_pro_estado =='Aprobada' && $r->vis_pro_finalizada == 1){ ?>
                        <td>
                            <?php echo $r->vis_pro_estado; ?><span class="glyphicon glyphicon-ok-sign" style="color: #008000;"></span>
                            <?php if( $r->vis_pro_finalizada ==1){ ?>
                                <span class="glyphicon glyphicon-ok-sign" style="color: #008000;"></span>
                            <?php }else { ?>
                                <span class="glyphicon glyphicon-ok-sign" style="color: #008000;"></span>
                            <?php } ?> 
                        </td>     
                    <?php }else{ ?>
                        <td><span class="glyphicon glyphicon-remove-sign" style="color: #FF0000;"><?php echo $r->vis_pro_estado; ?></span></td>
                    <?php } ?>    
                </tr>
            <?php  endforeach; ?>
        </tbody>
    </table> 
    <!-- Modal-->
    <div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Cancelar solicitud Visita
                    </h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form role="form" action="?c=Visitas&a=Cancelar_Visita" method="post" >
                        <div class="form-group">
                            <label for="id">ID Visita</label>
                            <input type="text" readonly="" class="form-control" name="id" id="id" placeholder="id"/>
                            <input type="hidden" class="form-control" name="idtsocial" id="idtsocial" placeholder="idtsocial"/>
                        </div>
                        <div class="form-group">
                            <label for="motivo">Motivo</label>
                            <textarea class="form-control" name="motivo" placeholder="Motivo de Cancelación de la Visita"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary"><span class="icon-floppy-disk"></span> Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#myModalNorm').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var id = button.data('id') 
            var idtsocial   = button.data('idtsocial') 
            var modal = $(this)
            modal.find('.modal-body input[name="id"]').val(id)
            modal.find('.modal-body input[name="idtsocial"]').val(idtsocial)
        })
    </script>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.30/centro_servicios2" ); } ?>