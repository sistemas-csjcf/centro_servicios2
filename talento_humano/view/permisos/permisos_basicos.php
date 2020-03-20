<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user              = $_SESSION['idUsuario'];
   // JUAN ESTEBAN MUNERA BETANCUR
    $modelo               = new HojaVida();
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '4';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos, $nombrelista, $idaccion, $campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
    $lista_usuario        = $modelo->get_datos_usuariosJE();
    $datospermiso_user    = $modelo->get_lista_permisos(1);
    //if(isset($id_user)){
        if ( in_array($_SESSION['idUsuario'],$usuariosa) ) { 
?>

    <h1 class="page-header">Listar Permisos - Aprobar Permisos</h1>
    <div class="form-group row">
        <div class="col-xs-4">
            <label for="usuario">Usuario</label>
            <select name="id_usuario" id="id_usuario" class="form-control selectpicker" data-live-search="true">
                <option value="">Seleccionar Usuario</option>
                <?php while ($row = $lista_usuario->fetch()){ ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['empleado'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-xs-2">
            <label for="hora_inicio">Fecha Inicio</label>
            <input type="text" readonly="" name="fechaInicio" id="fechaI" class="form-control datepicker" placeholder="Fecha Inicial" required="">
        </div>
        <div class="col-xs-2">
            <label for="hora_fin">Fecha Fin</label>
            <input type="text" readonly="" name="fechaFin" id="fechaF" class="form-control datepicker" placeholder="Fecha Final" required="">
        </div>
        
        <div class="col-xs-4">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-control">
                <option value="">Seleccionar Estado</option>
                <option value="2">En Proceso</option>
                <option value="1">Aprobado</option>
                <option value="0">No Aprobado</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-3">
            <ol class="breadcrumb">
                <button class="btn btn-info" onclick="consultar_permisos()"><i class="fa fa-search" aria-hidden="true"></i> Consultar</button>
                <button class="btn btn-default" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Restablecer</button>
            </ol>
        </div>
        <div class="col-xs-9">
            <ol class="breadcrumb">
                <li><a href="javascript:void(0);" onclick="Reporte_Excel(1)" title="REPORTE PERMISOS" style="text-decoration: none;"><span class="icon-file-excel" style="color: green; font-size: 30px;"></span></a></li>
                <li><a href="javascript:void(0);" onclick="Reporte_Excel(2)" title="CONSOLIDADO DE PERMISOS" style="text-decoration: none;"><span class="icon-stackoverflow" style="color: skyblue; font-size: 30px;"></span></a></li>
                <li><a href="javascript:void(0);" onclick="Reporte_Excel(3)" title="REPORTE ENTRADA Y SALIDA DE USUARIOS" style="text-decoration: none;"><span class="icon-clock" style="font-size: 30px;"></span></a></li>
            </ol>
        </div>
    </div>
    <hr />
    <div id="load" style="display: none">
        <div class="progress" >
            <div id="bar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                <span class="sr-only">10% Complete</span>
            </div>
        </div>
    </div>
    <div id="reporte_filtro_permisos"></div>
    <div id="reporte_inicial">
        <table id="example_historial" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #4682B4; color: white;">
                    <th title="Código Solicitud Permiso" style="width:12px;">ID</th>
                    <th style="width:12px;">Usuario</th>
                    <th style="width:12px;">Fecha Solicitud</th>
                    <th style="width:12px;">Fecha Permiso</th>
                    <th style="width:12px;">Hora Inicial</th>
                    <th style="width:12px;">Hora Final</th>
                    <th style="width:12px;">Duración</th>
                    <th style="width:12px;">Detalle</th>
                    <th style="width:12px;">Doc. Adjunto</th>
                    <th style="width:12px;">Estado</th>
                </tr>
            </thead>
            <tbody> 
                <?php while($r = $datospermiso_user->fetch()){ 
                    if($r[estado] == 2){
                        $estado = "En Proceso";
                        $color ="sandybrown";
                    }
                    if($r[estado] == 1){
                        $estado = "Aprobado";
                        $color ="green";
                    }
                    if($r[estado] == 0){
                        $estado = "No Aprobado";
                        $color ="red";
                    }
                ?>
                    <tr>
                        <td><?php echo $r['id']; ?> <span class="icon-flag" style="color: <?php echo $color; ?>"></span></td>
                        <td><?php echo $r['empleado']; ?></td>
                        <td><?php echo $r['fecha_solicitud']; ?></td>
                        <td><?php echo $r['fecha_permiso']; ?></td>
                        <td><?php echo $r['hora_inicio']; ?></td>
                        <td><?php echo $r['hora_final']; ?></td>
                        <td><?php echo $r['duracion']; ?></td>
                        <td><button class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal_Ver_Detalle" data-detalle="<?php echo $r['detalle'] ?>" ><i class="icon-zoom-in" style="font-size: 20px;" title="Ver Detalle Permiso"> </i></button></td>
                        <?php if($r['doc_adjunto'] !=""){ ?>
                            <td><a href="#" class="btn btn-default" onclick="ver_pdf(6,'<?php echo $r['doc_adjunto']; ?>');return false;" target="_blank"><span class="icon-download3"></span></a></td>
                        <?php }else{ ?>
                            <td><span class="icon-cross" style="color: red"></span></td>
                        <?php } ?>  
                        <?php if($estado == "En Proceso"){ ?>
                            <td><button class="btn btn-success" data-toggle="modal" data-target="#myModal_Estado" 
                                data-id="<?php echo $r['id'] ?>" 
                                data-flag_out="<?php echo $r['flag_out']; ?>" 
                                data-estado="<?php echo $r["estado"]; ?>" 
                                data-flag_vota="<?php echo $r['flag_votacion']; ?>" ><span class="icon-info"></span></button></td>
                        <?php }else if($estado == "Aprobado"){ ?>
                            <td><?php echo $estado; 
                                      if($r['flag_out'] == 1) {
                                ?> 
                                <a href="app/libs/plantillero/crear_permiso_ordinario.php?id=<?php echo $r['id']; ?>" style="text-decoration: none;"><span class="icon-file-word" style="font-size: 25px;"> </span></a>
                                <?php } ?>
                            </td>
                        <?php }else{ ?>
                            <td><?php echo $estado ?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- Modal-->
    <div class="modal fade" id="myModal_Estado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Solicitud Permiso</h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form role="form" action="?c=Hoja_vida&a=ActualizarRegistroPermiso" method="post" >
                        <div class="form-group">
                            <label for="id">ID Solicitud</label>
                            <input type="text" readonly="" class="form-control" name="id" id="id" placeholder="id"/>
                            <input type="hidden" readonly="" class="form-control" name="flag_out" id="flag_out" placeholder="flag_out"/>
                            <input type="hidden" readonly="" class="form-control" name="flag_votacion" id="flag_votacion" placeholder="flag_votacion"/>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select name="id_estado" class="form-control">
                                <option value="1">Aprobar</option>
                                <option value="0">No Aprobar</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="motivo">Observaciones</label>
                            <textarea class="form-control" name="observaciones" placeholder="Observaciones" maxlength="500"></textarea>
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
        $('#myModal_Estado').on('show.bs.modal', function (event) {
            var button      = $(event.relatedTarget) 
            var id          = button.data('id') 
            var flag_out    = button.data('flag_out')
            var flag_vota   = button.data('flag_vota');
            
            var modal  = $(this)
            modal.find('.modal-body input[name="id"]').val(id),
            modal.find('.modal-body input[name="flag_out"]').val(flag_out)
            modal.find('.modal-body input[name="flag_votacion"]').val(flag_vota)
            
        })
    </script>
    <!-- Modal Ver Más-->
    <div class="modal fade" id="myModal_Ver_Detalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Detalle del Permiso</h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label> Detalle </label>
                        <textarea class="form-control" readonly="" name="detalle" id="comment" rows="5" placeholder="Detalle Permiso" data-validacion-tipo="requerido|min:5" ></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#myModal_Ver_Detalle').on('show.bs.modal', function (event) {
            var button  = $(event.relatedTarget) 
            var detalle = button.data('detalle') 
            //alert(detalle);
            var modal = $(this)
            modal.find('.modal-body textarea[name="detalle"]').val(detalle)
        });
    </script>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.30/centro_servicios2" ); } ?>