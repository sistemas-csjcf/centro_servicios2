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
        <h1 class="page-header">Historial Informe Seguimiento</h1>
        <table id="example_historial" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #4682B4; color: white;">
                    <th title="Código visita">ID</th>
                    <th title="Código Informe Seguimiento">ID Inf.</th>
                    <th>Fecha Visita</th>
                    <th>Radicado</th>
                    <th>Despacho Solicitante</th>
                    <th>Asistente Social</th>
                    <th title="Ver màs Información">Ver más</th>
                </tr>
            </thead>
            <tbody>        
                <?php foreach($this->model->Listar_Historial_Informe_Seguimiento() as $r): ?>
                    <tr>
                        <td><?php echo $r->vis_pro_id; ?></td>
                        <td><?php echo $r->vis_inf_id; ?></td>
                        <td><?php echo $r->vis_pro_fecha_visita; ?></td>
                        <td><?php echo $r->vis_pro_radicado; ?></td>
                        <td><?php echo $r->vis_pro_solicitante; ?></td>
                        <td><?php echo $r->vis_TSoci_nombre; ?></td>  
                        <td><a href="#" data-toggle="modal" data-target="#myModalNorm" data-id="<?php echo $r->vis_pro_id ?>"data-id1="<?php echo $r->vis_inf_id ?>"data-asistente="<?php echo $r->vis_TSoci_nombre ?>"data-fecha2="<?php echo $r->vis_pro_fecha_visita ?>" data-hora1="<?php echo $r->vis_inf_hora_inicio ?>"data-hora2="<?php echo $r->vis_inf_hora_fin ?>"data-solicitante="<?php echo $r->vis_pro_solicitante ?>"data-radicado="<?php echo $r->vis_pro_radicado ?>"data-direccion="<?php echo $r->vis_inf_direccion ?>"data-observaciones="<?php echo $r->vis_inf_observaciones ?>"data-subclase="<?php echo $r->vis_pro_subclase_proceso ?>"data-fecha1="<?php echo $r->vis_inf_fecha_presentacion ?>"data-numpers="<?php echo $r->vis_inf_num_personas ?>"data-num_visitas="<?php echo $r->vis_inf_num_visitas_realizadas ?>"data-municipio="<?php echo $r->municipio ?>"data-duracion="<?php echo $r->vis_inf_duracion ?>"data-diferencia="<?php echo $r->vis_inf_dif_dias ?>"data-user="<?php echo $r->vis_inf_id_usuario ?>"data-ruta="<?php echo $r->vis_inf_ruta_formato ?>" ><i class="fa fa-eye fa-2x"></i></a></td>
                    </tr>
                <?php  endforeach; ?>
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
                            Seguimiento Visita Domiciliaria
                        </h4>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="id">ID Visita</label>
                                <input type="text" readonly="" class="form-control" name="id" id="id" placeholder="id"/>
                            </div>
                            <div class="col-md-4 col-md-offset-4">
                                <label for="idInfo">ID InForme</label>
                                <input type="text" readonly="" class="form-control" name="idInfo" id="idInfo" placeholder="id informe"/>
                            </div>
                        </div><br/>
                        <div class="form-group">
                            <label for="id">Asistente social responsable</label>
                            <input type="text" readonly="" class="form-control" name="nombreTScoial" id="nombreTScoial" placeholder="Asistente social"/>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="id">Hora Inicio</label>
                                <input type="text" readonly="" class="form-control" name="horaI" id="horaI" placeholder="Hora Inicial"/>
                            </div>
                            <div class="col-md-6 ">
                                <label for="id">Hora Final</label>
                                <input type="text" readonly="" class="form-control" name="horaF" id="horaF" placeholder="Hora Final"/>
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
                                <label for="id">Dirección Visita</label>
                                <input type="text" readonly="" class="form-control" name="direccion" id="direccion" placeholder="Dirección"/>
                            </div>
                            <div class="col-md-6 ">
                                <label for="id">Municipio</label>
                                <input type="text" readonly="" class="form-control" name="municipio" id="municipio" placeholder="Municipio"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="observaciones">Observaciones</label>
                            <textarea class="form-control" readonly="" name="observaciones" placeholder="Observaciones"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="numPersonas">Nº Personas Entrevistadas</label>
                                <input type="text" readonly="" class="form-control" name="numPersonas" id="numPersonas" placeholder="Número de personas entrevistadas"/>
                            </div>
                            <div class="col-md-6">
                                <label for="numPersonas">Nº Visitas Realizadas</label>
                                <input type="text" readonly="" class="form-control" name="numVisitas" id="numVisitas" placeholder="Número de visitas realizadas"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fechaRecepcion">Fecha Visita</label>
                            <input type="text" readonly="" class="form-control" name="fechaVisita" id="fechaVisita" placeholder="Fecha visita"/>
                        </div>
                        <div class="form-group">
                            <label for="fechaRecepcion">Fecha de presentación del informe</label>
                            <input type="text" readonly="" class="form-control" name="fechaPresentacion" id="fechaPresentacion" placeholder="Fecha presentación informe"/>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="id">Duración Visita</label>
                                <input type="text" readonly="" class="form-control" name="duracion" id="duracion" placeholder="Duración de la Visita"/>
                            </div>
                            <div class="col-md-6 ">
                                <label for="id">Días Transcurridos</label>
                                <input type="text" readonly="" class="form-control" name="dif_dias" id="dif_dias" placeholder="Diferencia Días"/>
                            </div>
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
                var idInfo              = button.data('id1');
                var nombreTScoial       = button.data('asistente');
                var horaI               = button.data('hora1');
                var horaF               = button.data('hora2');
                var solicitante         = button.data('solicitante');
                var radicado            = button.data('radicado');
                var direccion           = button.data('direccion');
                var observaciones       = button.data('observaciones');
                var subclase            = button.data('subclase');
                var fechaPresentacion   = button.data('fecha1');
                var numPersonas         = button.data('numpers');
                var numVisitas          = button.data('num_visitas');
                var municipio           = button.data('municipio');
                var duracion            = button.data('duracion');
                var diferencia          = button.data('diferencia');
                var fechaVisita         = button.data('fecha2');
                var user                = button.data('user');
                var ruta                = button.data('ruta');
                if(ruta != ""){
                    var rutaFormato     = "uploads_informes/Informes_Seguimiento/"+user+"/"+ruta;
                }else{
                    var rutaFormato     = "#";
                }
                
                
                var modal = $(this);
                modal.find('.modal-body input[name="id"]').val(id);
                modal.find('.modal-body input[name="idInfo"]').val(idInfo);
                modal.find('.modal-body input[name="nombreTScoial"]').val(nombreTScoial);
                modal.find('.modal-body input[name="horaI"]').val(horaI);
                modal.find('.modal-body input[name="horaF"]').val(horaF);
                modal.find('.modal-body input[name="solicitante"]').val(solicitante);
                modal.find('.modal-body input[name="radicado"]').val(radicado);
                modal.find('.modal-body input[name="direccion"]').val(direccion);
                modal.find('.modal-body textarea[name="observaciones"]').val(observaciones);
                modal.find('.modal-body input[name="subclase"]').val(subclase);
                modal.find('.modal-body input[name="fechaPresentacion"]').val(fechaPresentacion);
                modal.find('.modal-body input[name="numPersonas"]').val(numPersonas);
                modal.find('.modal-body input[name="numVisitas"]').val(numVisitas);
                modal.find('.modal-body input[name="municipio"]').val(municipio);
                modal.find('.modal-body input[name="duracion"]').val(duracion);
                modal.find('.modal-body input[name="dif_dias"]').val(diferencia);
                modal.find('.modal-body input[name="fechaVisita"]').val(fechaVisita);
                modal.find(document.getElementById("ruta").setAttribute("href",rutaFormato));
            });
        </script>
    <?php }else{ ?><br/>
        <h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para consultar el historial de informes seguimiento</h4>
    <?php } ?>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>