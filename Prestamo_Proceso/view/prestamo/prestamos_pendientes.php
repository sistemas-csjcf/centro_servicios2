<?php   
    
    $id_user = $_SESSION['idUsuario'];
    $modelo         = new Prestamo();
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '27';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
    if(isset($id_user)){
        if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
?>
<h1 class="page-header">Solicitudes Prestamos Pendientes</h1>

<div class="well well-sm text-right">
    <a class="btn btn-primary" href="?c=Prestamo&a=Crud">Nueva Solicitud</a>
</div>

<table id="example_historial" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
        <tr style="background-color: #A82E14; color: white;">
            <th title="Código Solicitud Prestamo">ID</th>
            <th title="Historia Solicitud Prestamo">Historia</th>
            <th>Fecha</th>
            <th>Despacho</th>
            <th style="width:120px;">Información Archivo</th>
            <th>Radicado</th>
            <th style="width:120px;">Proceso</th>
            <th style="width:120px;">Demandante</th>
            <th style="width:120px;">Demandado</th>
            <th>Observaciones</th>
            <!--<th style="width:60px;">Editar</th>-->
            <th style="width:60px;">Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($this->model->ListarPendientes() as $r): ?>
            <tr>
                <td><?php echo $r->pre_id; ?></td>
                <td><a href="#" class="btn btn-success" id="verPendiente" data-toggle="modal" data-target="#Modal_verPendiente" 
                    data-id="<?php echo $r->pre_id; ?>"
                    data-radicado="<?php echo $r->pre_radicado; ?>"
                    data-juzgado="<?php echo $r->pre_juzgado; ?>"
                    data-fecha="<?php echo $r->pre_fecha; ?>"
                    data-fecha1="<?php echo $r->fecha1; ?>"
                    data-fecha2="<?php echo $r->fecha2; ?>"
                    data-fecha3="<?php echo $r->fecha3; ?>"
                    data-fecha4="<?php echo $r->fecha4; ?>"
                    data-usuario="<?php echo utf8_encode($r->usuario); ?>"
                    data-usuario1="<?php echo $r->usuario1; ?>"
                    data-usuario2="<?php echo $r->usuario2; ?>"
                    data-usuario3="<?php echo $r->usuario3; ?>"
                    data-usuario4="<?php echo $r->usuario4; ?>"
                    data-us_f1="<?php echo $r->pre_id_user_fecha1; ?>"
                    data-us_f2="<?php echo $r->pre_id_user_fecha2; ?>"
                    data-us_f3="<?php echo $r->pre_id_user_fecha3; ?>"
                    data-us_f4="<?php echo $r->pre_id_user_fecha4; ?>" 
                    data-observacion_fecha0='<?php echo $r->pre_observacion_fecha0; ?>' >
                    <i class="icon icon-info" style="font-size: 20px;" title="Ver Historia Prestamo Proceso"> </i></a></td>
                <td><?php echo $r->pre_fecha; ?></td>
                <td><?php echo $r->pre_juzgado; ?></td>
                <td><?php echo $r->pre_info_archivo; ?></td>
                <td><?php echo $r->pre_radicado; ?></td>
                <td><?php echo $r->pre_subclase_proceso; ?></td>
                <td><?php echo $r->pre_demandante; ?></td>
                <td><?php echo $r->pre_demandado; ?></td>
                <td><?php echo $r->pre_observaciones; ?></td>
    <!--            <td>
                    <a href="?c=Prestamo&a=Crud&id=<?php echo $r->pre_id; ?>">Editar</a>
                </td>-->
                <td>
                    <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=Prestamo&a=Eliminar&id=<?php echo $r->pre_id; ?>&radicado=<?php echo $r->pre_radicado; ?>" style="text-decoration: none;"><span class="icon-cancel-circle" style="font-size: 20px;"></span></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table> 
    <!-- Modal-->
    <div class="modal fade" id="Modal_verPendiente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        <i class="glyphicon glyphicon-info-sign"></i> Historia Prestamos Proceso <label for="empleado" id="empleado"></label>
                    </h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id">ID Solicitud</label>
                        <input type="text" readonly="" class="form-control" name="id" id="id" placeholder="id"/>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="id">Radicado</label>
                            <input type="text" readonly="" class="form-control" name="radicado" id="Radicado" placeholder="Radicado"/>
                        </div>
                        <div class="col-md-6">
                            <label for="id">Juzgado</label>
                            <input type="text" readonly="" class="form-control" name="juzgado" id="Juzgado" placeholder="Juzgado"/>
                        </div>
                    </div><br/>
                    <div id="data_History"></div>
                    
<!--                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('click', '#verPendiente', function(e){
                var id      = $(this).data('id');
                var fecha   = $(this).data('fecha');
                var fecha1  = $(this).data('fecha1');
                var fecha2  = $(this).data('fecha2');
                var fecha3  = $(this).data('fecha3');
                var fecha4  = $(this).data('fecha4');
                var user    = $(this).data('usuario');
                var user1   = $(this).data('usuario1');
                var user2   = $(this).data('usuario2');
                var user3   = $(this).data('usuario3');
                var user4   = $(this).data('usuario4');
                var id_usF1 = $(this).data('us_f1');
                var id_usF2 = $(this).data('us_f2');
                var id_usF3 = $(this).data('us_f3');
                var id_usF4 = $(this).data('us_f4');
                var observacion_fecha0 = $(this).data('observacion_fecha0');
                //alert(id_usF2);
                //*********************************** ***************************************************
                params={};
                
                params.id       = id; 
                params.fecha    = fecha;
                params.fecha1   = fecha1;
                params.fecha2   = fecha2;
                params.fecha3   = fecha3;
                params.fecha4   = fecha4;
                params.user     = user;
                params.user1    = user1;
                params.user2    = user2;
                params.user3    = user3;
                params.user4    = user4;
                params.id_usF1  = id_usF1;
                params.id_usF2  = id_usF2;
                params.id_usF3  = id_usF3;
                params.id_usF4  = id_usF4;
                params.observacion_f0 = observacion_fecha0;
                // Ejecutamos AJAX
                $('#data_History').load('content/data_historyPrestamo.php',params,function(){})
            }); 
        }); 
        $('#Modal_verPendiente').on('show.bs.modal', function (event){
            var button = $(event.relatedTarget); 
            var id = button.data('id');
            var radi = button.data('radicado');
            var juzgado = button.data('juzgado');
            
            var modal = $(this); 
            modal.find('.modal-body input[name="id"]').val(id),
            modal.find('.modal-body input[name="radicado"]').val(radi),
            modal.find('.modal-body input[name="juzgado"]').val(juzgado)
            
        });
    </script>
    
    
<?php }else{ ?> 
        <h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para acceder a esta opción</h4>
    <?php } ?> 
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>