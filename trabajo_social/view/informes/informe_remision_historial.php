<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user = $_SESSION['idUsuario'];
    
    $ListarPermisos         = $modelo->privilegio_listarPermisos();
    $usuarios              = $ListarPermisos->fetch();
    $accion_listarPermisos  = explode("////",$usuarios[usuario]);
    
    if(isset($id_user)){
        if ( in_array($_SESSION['idUsuario'],$accion_listarPermisos) ){ 
?>
        <h1 class="page-header">Historial Informe Remisión</h1>
        <table id="example_historial" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #4682B4; color: white;">
                    <th title="Código visita">ID</th>
                    <th title="Código Informe Remisión">ID Inf.</th>
                    <th>Fecha Visita</th>
                    <th>Radicado</th>
                    <th>Despacho Solicitante</th>
                    <th>Asistente Social</th>
                    <th title="Ver màs Información">Ver más</th>
                </tr>
            </thead>
            <tbody>        
                <?php foreach($this->model->Listar_Historial_Informe_Remision() as $r): ?>
                    <tr>
                        <td><?php echo $r->vis_pro_id; ?></td>
                        <td><?php echo $r->inf_rem_id; ?></td>
                        <td><?php echo $r->vis_pro_fecha_visita; ?></td>
                        <td><?php echo $r->vis_pro_radicado; ?></td>
                        <td><?php echo $r->vis_pro_solicitante; ?></td>
                        <td><?php echo $r->vis_TSoci_nombre; ?></td>  
                        <td><a href="#" data-toggle="modal" data-target="#myModalNorm" data-id="<?php echo $r->vis_pro_id ?>"data-idseguimiento="<?php echo $r->vis_inf_id ?>"data-id1="<?php echo $r->inf_rem_id ?>"data-asistente="<?php echo $r->vis_TSoci_nombre ?>"data-fecha1="<?php echo $r->inf_rem_fecha_presentacion ?>"data-fecha2="<?php echo $r->inf_rem_fecha_remision ?>" data-solicitante="<?php echo $r->vis_pro_solicitante ?>"data-radicado="<?php echo $r->vis_pro_radicado ?>"data-observaciones="<?php echo $r->inf_rem_observaciones ?>"data-subclase="<?php echo $r->vis_pro_subclase_proceso ?>"data-numpers="<?php echo $r->vis_inf_num_personas ?>"data-diferencia="<?php echo $r->inf_rem_num_dif_dias ?>"data-num_oficio="<?php echo $r->inf_rem_num_oficio ?>"data-num_folios="<?php echo $r->inf_rem_num_folios ?>"data-user="<?php echo $r->vis_inf_id_usuario ?>"data-ruta="<?php echo $r->vis_inf_ruta_formato ?>" ><i class="fa fa-eye fa-2x"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table> 
        <!-- Modal-->
        <div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">
                            Remisión Informe Visita Domiciliaria
                        </h4>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="id">ID Visita</label>
                                <input type="text" readonly="" class="form-control" name="id" id="id" placeholder="id"/>
                            </div>
                            <div class="col-md-4">
                                <label for="idInfo">ID Informe Seguimiento</label>
                                <input type="text" readonly="" class="form-control" name="idseguimiento" id="idseguimiento" placeholder="id informe"/>
                            </div>
                            <div class="col-md-4">
                                <label for="idInfo">ID Informe Remisión</label>
                                <input type="text" readonly="" class="form-control" name="idInfo" id="idInfo" placeholder="id informe"/>
                            </div>
                        </div><br/>
                        <div class="form-group">
                            <label for="id">Asistente social responsable</label>
                            <input type="text" readonly="" class="form-control" name="nombreTScoial" id="nombreTScoial" placeholder="Asistente social"/>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="id">Fecha Presentación</label>
                                <input type="text" readonly="" class="form-control" name="fechaPresentacion" id="horaI" placeholder="Fecha presentación informe Seguimiento"/>
                            </div>
                            <div class="col-md-4 ">
                                <label for="id">Fecha Remisión</label>
                                <input type="text" readonly="" class="form-control" name="fechaRemision" id="horaF" placeholder="Fecha remisión informe al despacho"/>
                            </div>
                            <div class="col-md-4 ">
                                <label for="id">Diferencia Días</label>
                                <input type="text" readonly="" class="form-control" name="dif_dias" id="dif_dias" placeholder="Diferencia Días"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="radicado">Radicado:</label>
                            <input type="text" readonly="" class="form-control" name="radicado" id="radicado" placeholder="Radicado"/>
                        </div>
                        <div class="form-group">
                            <label for="radicado">SubClase Proceso:</label>
                            <input type="text" readonly="" class="form-control" name="subclase" id="subclase" placeholder="SubClase Proceso"/>
                        </div>
                        <div class="form-group">
                            <label for="id">Despacho Solicitante</label>
                            <input type="text" readonly="" class="form-control" name="solicitante" id="solicitante" placeholder="Despacho Solicitante"/>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="id">Nº Oficio Remisorio</label>
                                <input type="text" readonly="" class="form-control" name="num_oficio" id="num_oficio" placeholder="Nº Oficio"/>
                            </div>
                            <div class="col-md-6 ">
                                <label for="id">Nº Folios</label>
                                <input type="text" readonly="" class="form-control" name="num_folios" id="num_folios" placeholder="Nº Folios"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="observaciones">Observaciones</label>
                            <textarea class="form-control" readonly="" name="observaciones" placeholder="Observaciones"></textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                               <label for="id">Descargar Informe</label>
                               <a id="ruta" class="form-control" href="#" target="_blank" style="text-decoration:none;"><i class="icon-download3"></i>Descargar</a>
                            </div>
                        </div>
                        <hr />
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $('#myModalNorm').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); 
                var id                  = button.data('id');
                var idseguimiento       = button.data('idseguimiento');
                var idInfo              = button.data('id1');
                var nombreTScoial       = button.data('asistente');
                var solicitante         = button.data('solicitante');
                var radicado            = button.data('radicado');
                var observaciones       = button.data('observaciones');
                var subclase            = button.data('subclase');
                var fechaRemision       = button.data('fecha2');
                var fechaPresentacion   = button.data('fecha1');
                var diferencia          = button.data('diferencia');
                var num_oficio          = button.data('num_oficio');
                var num_folios          = button.data('num_folios');
                var user                = button.data('user');
                var ruta                = button.data('ruta');
                if(ruta != ""){
                    var rutaFormato     = "uploads_informes/Informes_Seguimiento/"+user+"/"+ruta;
                }else{
                    var rutaFormato     = "#";
                }
                
                var modal = $(this);
                modal.find('.modal-body input[name="id"]').val(id); 
                modal.find('.modal-body input[name="idseguimiento"]').val(idseguimiento);
                modal.find('.modal-body input[name="idInfo"]').val(idInfo);
                modal.find('.modal-body input[name="nombreTScoial"]').val(nombreTScoial);
                modal.find('.modal-body input[name="solicitante"]').val(solicitante);
                modal.find('.modal-body input[name="radicado"]').val(radicado);
                modal.find('.modal-body textarea[name="observaciones"]').val(observaciones);
                modal.find('.modal-body input[name="subclase"]').val(subclase);
                modal.find('.modal-body input[name="fechaPresentacion"]').val(fechaPresentacion);
                modal.find('.modal-body input[name="dif_dias"]').val(diferencia);
                modal.find('.modal-body input[name="fechaRemision"]').val(fechaRemision);
                modal.find('.modal-body input[name="num_oficio"]').val(num_oficio);
                modal.find('.modal-body input[name="num_folios"]').val(num_folios);
                modal.find(document.getElementById("ruta").setAttribute("href",rutaFormato));
            });
        </script>
    <?php }else{ ?><br/>
        <h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para consultar el historial de informes seguimiento</h4>
    <?php } ?>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>