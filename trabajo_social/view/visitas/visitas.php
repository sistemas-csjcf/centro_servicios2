<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user              = $_SESSION['idUsuario'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo               = new Visita();
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '20';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
    $datosTSocial         = $modelo->get_lista_TSocial();
    
    if(isset($id_user)){
?>
    <h1 class="page-header">Visitas Programadas</h1>
    <div class="well well-sm text-right">
		<a class="btn btn-primary" href="?c=Visitas&a=Crud"><i class="glyphicon glyphicon-plus-sign"></i> Nuevo Registro</a>
    </div>

    <table id="example" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr style="background-color: #4682B4; color: white;">
                <th title="Código Solicitud Visita">ID</th>
                <th>Fecha Visita</th>
                <th title="Despacho Solicitante">Solicitante</th>
                <th>Radicado</th>
                <th>Sub-Clase Proceso</th>
                <th>Observaciones</th>
                <th>Fecha Audiencia</th>
                <?php if ( in_array($_SESSION['idUsuario'],$usuariosa) ) { ?>
                    <th>Trabajadora Social</th>
                    <th>Aprobar</th>
                    <th>Cancelar</th>
                    <th>Editar</th>
                <?php }else{ ?>
                    <th>Estado</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach($this->model->Listar() as $r): ?>
                <tr>
                    <td><?php echo $r->vis_pro_id; ?></td>
                    <td><?php echo $r->vis_pro_fecha_visita; ?></td>
                    <td><?php echo $r->vis_pro_solicitante; ?></td>
                    <td><?php echo $r->vis_pro_radicado; ?></td>
                    <td><?php echo $r->vis_pro_subclase_proceso; ?></td>
                    <td><?php echo $r->vis_pro_comentarios; ?></td>
                    <td><?php echo $r->vis_pro_fecha_audiencia; ?></td>
    <!--                <td><a href="?c=visitas&a=Crud&id=<?php// echo $r->vis_pro_id; ?>">Editar</a></td>-->
                    <?php if ( in_array($_SESSION['idUsuario'],$usuariosa) ) { ?>
                        <td><button class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModalChangeTSocial" data-id="<?php echo $r->vis_pro_id ?>" data-idtsocial="<?php echo $r->vis_pro_id_TSocial ?>" ><span class="icon-loop"> </span></button> <?php echo $r->vis_TSoci_nombre; ?></td>
                        <td><a onclick="javascript:return confirm('¿Seguro de Aprobar Visita?');" href="?c=Visitas&a=Aprobar&data-id=<?php echo $r->vis_pro_id; ?>&data-us=<?php echo $id_user; ?>"  title="Aprobar Solicitud Visita"><span class="glyphicon glyphicon-ok-sign"></span></a></td>
                        <td><button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModalNorm" data-id="<?php echo $r->vis_pro_id ?>"data-idtsocial="<?php echo $r->vis_pro_id_TSocial ?>" title="Cancelar Solicitud Visita"><span class="icon-cancel-circle"></span></button></td>
                        <td><a href="#" data-toggle="modal" data-target="#myModalEditar" data-id="<?php echo $r->vis_pro_id  ?>"data-comentarios="<?php echo $r->vis_pro_comentarios ?>" ><i class="glyphicon glyphicon-pencil"></i></a></td>
                    <?php }else{ ?>
                        <td><span class="glyphicon glyphicon-refresh"> Cancelar</span></td>
                    <?php } ?>
                </tr>
            <?php endforeach; ?>
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
                            <textarea class="form-control" name="motivo" placeholder="Motivo de Cancelación de la Visita" required=""></textarea>
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
            var id          = button.data('id') 
            var idtsocial   = button.data('idtsocial') 
            var modal = $(this)
            modal.find('.modal-body input[name="id"]').val(id)
            modal.find('.modal-body input[name="idtsocial"]').val(idtsocial)
        })
    </script>

    <!-- Modal change TSocial-->
    <div class="modal fade" id="myModalChangeTSocial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Cambiar Trabajador Social 
                    </h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form role="form" action="?c=Visitas&a=Cambiar_TSocialVisita" method="post" >
                        <div class="form-group">
                            <label for="id">ID Visita</label>
                            <input type="text" readonly="" class="form-control" name="id" id="id" placeholder="id"/>
                            <input type="hidden" class="form-control" name="txt_id_TSocial" id="id_TSocial" placeholder="id_TSocial" />
                        </div>
                        <div class="form-group">
                            <label for="motivo">Trabajadora Social</label>
                            <select name="id_TSocial" class="form-control">
                                <?php while($row = $datosTSocial->fetch()){ ?>
                                    <option value="<?php echo $row['vis_TSoci_id'] ?>"><?php echo $row['vis_TSoci_nombre'] ?></option>
                                <?php } ?>
                            </select>
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
        $('#myModalChangeTSocial').on('show.bs.modal', function (event) {
            var button      = $(event.relatedTarget) 
            var id          = button.data('id') 
            var id_TSocial  = button.data('idtsocial') 

            var modal = $(this)
            modal.find('.modal-body input[name="id"]').val(id), 
            modal.find('.modal-body input[name="txt_id_TSocial"]').val(id_TSocial)
        })
    </script>
    
    
    <!-- Modal EDITAR-->
    <div class="modal fade" id="myModalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Editar solicitud Visita <icon class="glyphicon glyphicon-pencil"></icon>
                    </h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form role="form" action="?c=Visitas&a=Actualizar_Visita" method="post" >
                        <div class="form-group">
                            <label for="id">ID Visita</label>
                            <input type="text" readonly="" class="form-control" name="id" id="id" placeholder="id"/>
                        </div>
                        <div class="form-group">
                            <label for="comentarios">Comentarios</label>
                            <textarea class="form-control" name="comentarios" placeholder="Observaciones de la Visita"><p ></p></textarea>
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
        $('#myModalEditar').on('show.bs.modal', function (event) {
            var button      = $(event.relatedTarget) 
            var id          = button.data('id') 
            var comentarios = button.data('comentarios') 

            var modal = $(this)
            modal.find('.modal-body input[name="id"]').val(id), 
            modal.find('.modal-body textarea[name="comentarios"]').val(comentarios)
        })
    </script>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.30/centro_servicios2" ); } ?>