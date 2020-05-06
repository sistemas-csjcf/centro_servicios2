<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user              = $_SESSION['idUsuario'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo               = new HojaVida();
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '30';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
    $datospermiso         = $modelo->get_lista_mis_permisos_mayor();
    if(isset($id_user)){
?>
    <h1 class="page-header">Permisos mayores a un día...</h1>
    <!-- <div class="form-group row">
        <div class="col-xs-4">
            <label for="fecha_inicio">Fecha Inicial</label>
            <input readonly="" name="fechaI" id="fechaInicio" type="date" value="<?php echo $fecha; ?>" class="form-control datepicker">
        </div>
        <div class="col-xs-4">
            <label for="fecha_fin">Fecha Final</label>
            <input readonly="" name="fechaF" id="fechaFin" type="date" value="<?php echo $fecha; ?>" class="form-control datepicker">
        </div>
    </div><hr />
    <div>
        <button class="btn btn-info" id="btn_guardar" onclick="consultar_Tutelas();"><span class="glyphicon glyphicon-search"></span> Consultar</button>
        <button class="btn btn-default" onclick="location.reload();" ><i class="fa fa-eraser" aria-hidden="true"></i>Restablecer</button>
    </div>
    <h1 class="page-header">Tutelas</h1>
    <div id="load" style="display: none">
        <div class="progress" >
            <div id="bar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                <span class="sr-only">10% Complete</span>
            </div>
        </div>
    </div>  -->
    <div id="resultado"></div>
    <div id="tb_inicial">
        <table id="example" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
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
                <?php while($r = $datospermiso->fetch()){ 
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

               <!-- <?php if ( in_array($_SESSION['idUsuario'], $usuariosa) ) { 
                    $method = "get_lista_permisos_mayor";
                    }else{
                        $method = "";
                    }    
                    foreach($this->model->$method() as $r): 
                        $id_est = $per->per_est_id;
                ?>
                    <tr>
                        <td><?php echo $r->per_est_id; ?></td>
                        <td><?php echo $r->per_est_nombre; ?></td>
                        <td><?php echo $r->per_est_institucion; ?></td>
                        <td><?php echo $r->per_est_programa; ?></td>

                        <td><button class="btn btn-default" data-toggle="modal" id="modal_Ver_Horario" data-target="#myModal_Horario" data-id="<?php echo $r->per_est_id ?>"data-inicio="<?php echo $r->per_est_fecha_inicio; ?>"data-final="<?php echo $r->per_est_fecha_final; ?>" ><span class="icon-clock2" style="font-size: 20px;"> </span></button></td>

                        <td><a href="#" class="btn btn-default" onclick="ver_pdf(4,'<?php echo $r->per_est_ruta_doc_horario; ?>');return false;" target="_blank"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a></td>
                        <td><a href="#" class="btn btn-default" onclick="ver_pdf(5,'<?php echo $r->per_est_ruta_doc_matricula; ?>');return false;" target="_blank"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a></td>
                        <?php if ( in_array($_SESSION['idUsuario'],$usuariosa) ) { ?>                        
                            <td><button class="btn btn-success" data-toggle="modal" data-target="#myModal_Estado" data-id="<?php echo $r->per_est_id ?>" data-estado="<?php echo $r->per_est_estado ?>" ><span class="icon-info"></span></button></td>
                        <?php }else{ ?>
                            <td><span class="glyphicon glyphicon-refresh"> Cancelar</span></td>
                        <?php } ?>
                    </tr>
                <?php endforeach; ?> -->
            </tbody>
        </table>
    </div>
    <a href="#" onclick="notifyMe()">link</a>
        <script>
            function  notifyMe()  {  
                if  (!("Notification"  in  window))  {   
                    alert("Este navegador no soporta notificaciones de escritorio");  
                }  
                else  if  (Notification.permission  ===  "granted")  {
                    var  options  =   {
                        body:   "Descripción o cuerpo de la notificación",
                        icon:   "url_del_icono.jpg",
                        dir :   "ltr"
                    };
                    var  notification  =  new  Notification("Hola :D", options);
                }  
                else  if  (Notification.permission  !==  'denied')  {
                    Notification.requestPermission(function (permission)  {
                        if  (!('permission'  in  Notification))  {
                            Notification.permission  =  permission;
                        }
                        if  (permission  ===  "granted")  {
                            var  options  =   {
                                body:   "Descripción o cuerpo de la notificación",
                                icon:   "url_del_icono.jpg",
                                dir :   "ltr"
                            };     
                            var  notification  =  new  Notification("Hola :)", options);
                        }   
                    });  
                }
            }
        </script>
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
                    <form role="form" action="?c=Hoja_vida&a=ActualizarEstadoPermisoMayor" method="post" >
                        <div class="form-group">
                            <label for="id">ID Solicitud</label>
                            <input type="text" readonly="" class="form-control" name="id" id="id" placeholder="id"/>
                            <input type="hidden" readonly="" class="form-control" name="flag_out" id="flag_out" placeholder="flag_out"/>
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
                            <textarea class="form-control" name="observaciones" placeholder="Observaciones"></textarea>
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
            var button = $(event.relatedTarget) 
            var id     = button.data('id') 
            
            var modal  = $(this)
            modal.find('.modal-body input[name="id"]').val(id)
            
        })
    </script>

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