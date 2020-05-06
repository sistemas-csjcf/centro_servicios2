<?php 
    //session_start();
    $_SESSION['nombre'];
    $id_user              = $_SESSION['idUsuario'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo               = new HojaVida();
    $licencias            = $modelo->Listar_Licencia_No_Remunerada_user($id_user);
    //$datospermiso_user    = $modelo->get_lista_mis_permisos_mayor($id_user);
    if(isset($id_user)){    
?>
    <h1 class="page-header">Licencias no remuneradas</h1>
    <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $id_user ?>">

    <!-- <div class="form-group row">
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
                <li><a href="javascript:void(0);" onclick="Reporte_Excel(4)" title="REPORTE PERMISOS" style="text-decoration: none;"><span class="icon-file-excel" style="color: green; font-size: 30px;"></span></a></li>
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
    </div> -->
    <div id="reporte_filtro_permisos"></div>
    <div id="reporte_inicial">
        <table id="example_historial" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #4682B4; color: white;">
                    <th title="Código Solicitud Permiso" style="width:12px;">ID.</th>
                    <th style="width:12px;">Tipo</th>
                    <th style="width:12px;">Usuario</th>
                    <th style="width:6px;">Fecha Solicitud</th>
                    <th style="width:6px;">Fecha Inicio</th>
                    <th style="width:12px;">Fecha Fin</th>
                    <th style="width:12px;">Motivo</th>
                    <th style="width:10px; align-content: center;">Doc. Adjunto</th>
                    <th style="width:12px;">Estado</th>
                </tr>
            </thead>
            <tbody> 
                <?php while($r = $licencias->fetch()){ 
                    if($r['lic_no_rem_estado'] == 0){
                        $estado = "En Proceso";
                        $color ="sandybrown";
                    }
                    if($r['lic_no_rem_estado'] == 1){
                        $estado = "Aprobado";
                        $color ="green";
                    }
                    if($r['lic_no_rem_estado'] == 2){
                        $estado = "No Aprobado";
                        $color ="red";
                    }

                    if($r['lic_no_rem_id_tipo_resolucion'] == 5) // licencia por 3 meses
                    {
                        $tipo = "3 Meses";
                    }
                    else if ($r['lic_no_rem_id_tipo_resolucion'] == 6)
                    {
                        $tipo = "2 Años";
                    }
                ?>
                    <tr>
                        <td><?php echo $r['lic_no_rem_id']; ?> <span class="icon-flag" style="color: <?php echo $color; ?>"></span> </td>
                        <td> <?php echo $tipo; ?> </td>
                        <td><?php echo $r['lic_no_rem_nombre_servidor']; ?></td>
                        <td><?php echo $r['lic_no_rem_fecha_solicitud']; ?></td>
                        <td><?php echo $r['lic_no_rem_fecha_inicio']; ?></td>
                        <td><?php echo $r['lic_no_rem_fecha_fin']; ?></td>
                        <td><?php echo $r['lic_no_rem_motivo']; ?></td>

                        <td style="text-align: center;">
                            <?php if($r['lic_no_rem_ruta_doc_escrito'] != "") { ?>
                              <a href="#" class="btn btn-default" onclick="ver_pdf(8,'<?php echo $r['lic_no_rem_ruta_doc_escrito']; ?>');return false;" target="_blank"><span class="icon-file-pdf"></span></a>
                            <?php } else { ?>
                            <span class="icon-cross" style="color: red"></span>
                            <?php } ?>
                        </td>

                       <!-- <td style="text-align: center;">
                        <?php if($r['lic_no_rem_ruta_resolucion'] != "") { ?>
                              <a href="#" class="btn btn-default" onclick="ver_pdf(8,'<?php echo $r['lic_no_rem_ruta_resolucion']; ?>');return false;" target="_blank"><span class="icon-download3"></span></a>
                        <?php } else if ($r['lic_no_rem_estado'] == 1) { ?>
                            <a href="app/libs/plantillero/crear_licencia_no_remunerada.php?id=<?php echo $r['lic_no_rem_id']; ?>" style="text-decoration: none;"><span class="icon-file-word" style="font-size: 25px;"> </span></a>
                        <?php } else { ?>
                            <span class="icon-cross" style="color: red"></span>
                        <?php } ?>
                        </td> -->

                        <td>
                        <?php echo $estado; ?>
                        </td>             
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
    <script>
        $('#myModal_Estado').on('show.bs.modal', function (event) {
            var button      = $(event.relatedTarget) 
            var id          = button.data('id') 
            
            var modal  = $(this)
            modal.find('.modal-body input[name="id"]').val(id)
        })
    </script>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>