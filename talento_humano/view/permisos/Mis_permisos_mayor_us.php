<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user              = $_SESSION['idUsuario'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo               = new HojaVida();
    $datospermiso_user    = $modelo->get_lista_mis_permisos_mayor($id_user);
    if(isset($id_user)){    
?>
    <h1 class="page-header">Mis Permisos mayores a un día</h1>
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
                    <th style="width:12px;">Usuario</th>
                    <th style="width:6px;">Fecha</th>
                    <th style="width:12px;">Detalle</th>
                    <th style="width:12px;">Tiempo</th>
                    <th style="width:10px;">Doc. Adjunto</th>
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
                        <td><?php echo $r['id']; ?> <span class="icon-flag" style="color: <?php echo $color; ?>"></span> </td>
                        <td><?php echo $r['empleado']; ?></td>
                        <td><?php echo $r['fecha_solicitud']; ?></td>
                        <td><?php echo $r['detalle']; ?></td>

                        <td>
                            <button class="btn btn-default" data-toggle="modal" id="modal_Ver_Horario" data-target="#myModal_Horario" data-id="<?php echo $r['id'] ?>"><span class="icon-clock2" style="font-size: 20px;"> </span></button>
                        </td>

                        <?php if($r['doc_adjunto'] != ""){ ?>
                            <td><a href="#" class="btn btn-default" onclick="ver_pdf(6,'<?php echo $r['doc_adjunto']; ?>');return false;" target="_blank"><span class="icon-download3"></span></a>
                            </td>
                        <?php } else { ?>
                            <td><span class="icon-cross" style="color: red"></span></td>
                        <?php } ?>

                        <td><?php echo $estado ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- Modal HORARIO-->
    <div class="modal fade" id="myModal_Horario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        HORARIO PERMISO 
                    </h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <div id="dynamic-Per_Estudio_Horario"></div>
                    
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(document).on('click', '#modal_Ver_Horario', function(e){
                // Definimos las variables de javascrpt 
                var id = $(this).data('id');
                // Ejecutamos AJAX 
                $("#dynamic-Per_Estudio_Horario").load("view/Hoja_vida/dynamic/ver_horario_permiso_mayor.php", { id }); 
            }); 
        }); 
        $('#myModal_Horario').on('show.bs.modal', function (event) {
            var button      = $(event.relatedTarget) 
            var id          = button.data('id') 
            
            var modal = $(this)
            modal.find('.modal-body input[name="id"]').val(id)
        })
    </script>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.30/centro_servicios2" ); } ?>