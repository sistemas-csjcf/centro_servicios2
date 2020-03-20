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
        <h1 class="page-header">Historial Valoración Visita</h1>
        <table id="example_historial" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #4682B4; color: white;">
                    <th title="Código Valoración">ID</th>
                    <th title="Código  Solicitud Visita">ID Visita</th>
                    <th>Fecha Visita</th>
                    <th>Radicado</th>
                    <th>Despacho Solicitante</th>
                    <th>Asistente Social</th>
                    <th title="Ver màs Información">Ver más</th>
                </tr>
            </thead>
            <tbody>        
                <?php foreach($this->model->Listar_Historial_Valoracion_Visitas() as $r): ?>
                    <tr>
                        <?php if($r->inf_val_enviado ==0){ ?>
                            <td><?php echo $r->inf_val_id; ?> <i class="fa fa-flag" aria-hidden="true" style="color: red"></i></td>
                        <?php }else{ ?>
                            <td><?php echo $r->inf_val_id; ?> <i class="fa fa-flag" aria-hidden="true" style="color: green"></i></td>
                        <?php } ?>
                        <?php if($r->inf_val_enviado ==0){ ?>
                            <td><?php echo $r->vis_pro_id; ?> <p style="color: white; font-size: 1px">Pendiente</p></td>
                        <?php }else{ ?>   
                            <td><?php echo $r->vis_pro_id; ?> <p style="color: white; font-size: 1px">Realizada</p></td>
                        <?php } ?>
                        <td><?php echo $r->vis_pro_fecha_visita; ?></td>
                        <td><?php echo $r->vis_pro_radicado; ?></td>
                        <td><?php echo $r->vis_pro_solicitante; ?></td>
                        <td><?php echo $r->vis_TSoci_nombre; ?></td>  
                        <td><a href="#" data-toggle="modal" data-target="#myModalNorm" data-id="<?php echo $r->vis_pro_id ?>"data-id2="<?php echo $r->inf_val_id ?>"data-asistente="<?php echo $r->vis_TSoci_nombre ?>"data-fecha1="<?php echo $r->inf_val_fechaRecepcion ?>"data-fecha2="<?php echo $r->inf_val_fechaPresentacion ?>" data-solicitante="<?php echo $r->vis_pro_solicitante ?>"data-radicado="<?php echo $r->vis_pro_radicado ?>"data-observaciones="<?php echo $r->inf_val_observaciones ?>"data-subclase="<?php echo $r->vis_pro_subclase_proceso ?>"data-diferencia="<?php echo $r->inf_val_dif_dias ?>"data-resp1="<?php echo $r->inf_val_cumpleObjetivo ?>"data-obj1="<?php echo $r->inf_val_cumpleObjetivoRespuesta ?>"data-oportunamente="<?php echo $r->inf_val_oportunamente ?>"data-res_oportuna2="<?php echo $r->inf_val_oportunamenteRespuesta ?>"data-val_despacho="<?php echo $r->inf_val_valoracionDespacho ?>"data-name_valora1="<?php echo $r->inf_val_nombreValoracion ?>"data-inf_enviado="<?php echo $r->inf_val_enviado ?>" ><i class="fa fa-eye fa-2x"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table> 
        <a href="?c=Visitas&a=estadistica_Excel_Visitas_Valoracion" style="text-decoration: none" class=""><i class="fa fa-file-excel-o" aria-hidden="true"></i> Generar Excel</a>
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
                            Valoración Informe Visita Domiciliaria
                        </h4>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="id">ID Visita</label>
                                <input type="text" readonly="" class="form-control" name="id" id="id" placeholder="id"/>
                            </div>
                            <div class="col-md-6">
                                <label for="idInfo">ID Valoración Informe</label>
                                <input type="text" readonly="" class="form-control" name="idseguimiento" id="idValoracion" placeholder="id valoración"/>
                            </div>
                        </div><br/>
                        <div class="form-group">
                            <label for="id">Asistente social responsable</label>
                            <input type="text" readonly="" class="form-control" name="nombreTScoial" id="nombreTScoial" placeholder="Asistente social"/>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="id">Fecha recepción del informe</label>
                                <input type="text" readonly="" class="form-control" name="fechaPresentacion" id="horaI" placeholder="Fecha de recepción del informe"/>
                            </div>
                            <div class="col-md-4 ">
                                <label for="id">Fecha presentación Valoración</label>
                                <input type="text" readonly="" class="form-control" name="fechaRemision" id="horaF" placeholder="Fecha de presentación de la valoración"/>
                            </div>
                            <div class="col-md-2 ">
                                <label for="id">Días transcurridos </label>
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
                        <div class="form-group">
                            <label for="id">Considera usted que se cumplió el objetivo planteado  para la visita?</label>
                            <input type="text" readonly="" class="form-control" name="resp1" id="resp1" placeholder="Considera usted que se cumplió el objetivo planteado  para la visita?"/>
                        </div>
                        <div class="form-group" id="res_objetivo">
                            <textarea class="form-control" name="res_objetivo" id="txtArea_res_objetivo" rows="4" placeholder="En caso de ser negativa su respuesta indique por qué?" disabled=""><?php echo $vis->inf_val_cumpleObjetivoRespuesta; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="id">Considera usted que la visita se realizó oportunamente?</label>
                            <input type="text" readonly="" class="form-control" name="oportunamente" id="cumpleObjetivo" placeholder="Considera usted que la visita se realizó oportunamente?"/>
                        </div>
                        <div class="form-group" id="res_oportunamente">
                            <textarea class="form-control" name="resOportuna" id="resOportuna" rows="5" placeholder="En caso de ser negativa su respuesta indique por qué?" disabled=""><?php echo $vis->inf_val_oportunamenteRespuesta; ?></textarea>
                        </div> 
                        <div class="form-group">
                            <label for="id">Calificación dada por el despacho</label>
                            <input type="text" readonly="" class="form-control" name="valDespacho" id="valDespacho" placeholder="Calificación dada por el despacho"/>
                        </div>
                        <div class="form-group">
                            <label for="id">Nombre de quien realiza valoración del informe en el despacho</label>
                            <input type="text" readonly="" class="form-control" name="nombreValorador" id="nombreValorador" placeholder="Nombre de quien realiza valoración del informe en el despacho"/>
                        </div>
                        <div class="form-group">
                            <label for="observaciones">Observaciones</label>
                            <textarea class="form-control" readonly="" name="observaciones" placeholder="Observaciones"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="id">Valoración informe enviado?</label>
                            <input type="text" readonly="" class="form-control" name="valEnviado" id="valEnviado" placeholder="Valoraci{on informe de visita enviado?"/>
                        </div>
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
                var idValoracion        = button.data('id2');
                var nombreTScoial       = button.data('asistente');
                var solicitante         = button.data('solicitante');
                var radicado            = button.data('radicado');
                var observaciones       = button.data('observaciones');
                var subclase            = button.data('subclase');
                var fechaRemision       = button.data('fecha2');
                var fechaPresentacion   = button.data('fecha1');
                var diferencia          = button.data('diferencia');
                var resp1               = button.data('resp1');
                var objRespuesta        = button.data('obj1');
                var oportunamente       = button.data('oportunamente');
                var resOportuna         = button.data('res_oportuna2');
                var valDespacho         = button.data('val_despacho');
                var nombreValoracion    = button.data('name_valora1');
                var inf_enviado         = button.data('inf_enviado');
                
                if(valDespacho === "E"){
                    valDespacho = "Excelente";
                }else if(valDespacho === "B"){
                    valDespacho = "Bueno";
                }else if (valDespacho === "R"){
                    valDespacho = "Regular";
                }else if (valDespacho === "M"){
                    valDespacho = "Malo";
                }else{
                    valDespacho = valDespacho;
                }
                
                if(inf_enviado == "1"){
                    inf_enviado = "Si";
                }else if(inf_enviado == "0"){
                    inf_enviado = "No";
                }
                else{
                    inf_enviado = inf_enviado;
                }
                
                var modal = $(this);
                modal.find('.modal-body input[name="id"]').val(id); 
                modal.find('.modal-body input[name="idseguimiento"]').val(idValoracion);
                
                modal.find('.modal-body input[name="nombreTScoial"]').val(nombreTScoial);
                modal.find('.modal-body input[name="solicitante"]').val(solicitante);
                modal.find('.modal-body input[name="radicado"]').val(radicado);
                modal.find('.modal-body textarea[name="observaciones"]').val(observaciones);
                modal.find('.modal-body input[name="subclase"]').val(subclase);
                modal.find('.modal-body input[name="fechaPresentacion"]').val(fechaPresentacion);
                modal.find('.modal-body input[name="dif_dias"]').val(diferencia);
                modal.find('.modal-body input[name="fechaRemision"]').val(fechaRemision);
                modal.find('.modal-body input[name="resp1"]').val(resp1);
                modal.find('.modal-body textarea[name="res_objetivo"]').val(objRespuesta);
                modal.find('.modal-body input[name="oportunamente"]').val(oportunamente);
                modal.find('.modal-body textarea[name="resOportuna"]').val(resOportuna);
                modal.find('.modal-body input[name="valDespacho"]').val(valDespacho);
                modal.find('.modal-body input[name="nombreValorador"]').val(nombreValoracion); 
                modal.find('.modal-body input[name="valEnviado"]').val(inf_enviado);
            });
        </script>
    <?php }else{ ?><br/>
        <h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para consultar el historial de Valoración Informe Visita Domiciliaria</h4>
    <?php } ?>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>