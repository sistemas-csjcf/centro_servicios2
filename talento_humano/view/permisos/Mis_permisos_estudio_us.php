<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user              = $_SESSION['idUsuario'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo               = new HojaVida();
    
    if(isset($id_user)){
?>
    <h1 class="page-header">Permisos Estudio</h1>
    
    <table id="example" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr style="background-color: #4682B4; color: white;">
                <th title="Código Solicitud Permiso" style="width:12px;">ID</th>
                <th style="width:12px;">Fecha Solicitud</th>
                <th style="width:12px;">Usuario</th>
                <th title="Institución" style="width:12px;">Institución</th>
                <th style="width:12px;">Programa</th>
                <th style="width:12px;">Ver Horario</th>
                <th title="Constancia Horario" style="width:12px;">Ccia. Horario</th>
                <th title="Constancia Matricula" style="width:12px;">Ccia. Matricula</th>
                <th style="width:12px;">Estado</th>
            </tr>
        </thead>
        <tbody> 
            <?php 
                foreach($this->model->Lista_Permisos_Estudio_for_US($id_user) as $r): 
                    $id_est = $per->per_est_id;
            ?>
                <tr>
                    <td>
                        <?php 
                            if($r->per_est_estado == 0){
                                $estado = "goldenrod";
                            }else if($r->per_est_estado == 1){
                                $estado = "green";
                            }else{
                                $estado = "red";
                            }
                        ?>
                        <span class="glyphicon glyphicon-flag" style="color: <?php echo $estado; ?>"></span> <?php echo $r->per_est_id; ?>
                    </td>
                    <td><?php echo $r->per_est_fecha_solicitud; ?></td>
                    <td><?php echo $r->per_est_nombre; ?></td>
                    <td><?php echo $r->per_est_institucion; ?></td>
                    <td><?php echo $r->per_est_programa; ?></td>
                    <td><button class="btn btn-default" data-toggle="modal" id="modal_Ver_Horario" data-target="#myModal_Horario" data-id="<?php echo $r->per_est_id ?>"data-inicio="<?php echo $r->per_est_fecha_inicio; ?>"data-final="<?php echo $r->per_est_fecha_final; ?>" ><span class="icon-clock2" style="font-size: 20px;"> </span></button></td>
                    
                    <td><a href="#" class="btn btn-default" onclick="ver_pdf(4,'<?php echo $r->per_est_ruta_doc_horario; ?>');return false;" target="_blank"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a></td>
                    <td><a href="#" class="btn btn-default" onclick="ver_pdf(5,'<?php echo $r->per_est_ruta_doc_matricula; ?>');return false;" target="_blank"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a></td>
                    <?php if ( in_array($_SESSION['idUsuario'], $usuariosa) ) { ?>                        
                        <td><button class="btn btn-success" data-toggle="modal" data-target="#myModal_Estado" data-id="<?php echo $r->per_est_id ?>" data-estado="<?php echo $r->per_est_estado ?>" ><span class="icon-info"></span></button></td>
                    <?php } else { ?>
                        <td>
                            <span class="glyphicon glyphicon-info-sign " style="color: cornflowerblue;">
                                <?php 
                                    if($r->per_est_estado == 0)
                                    {
                                        $estado = "Pendiente";
                                    } 
                                    else if ($r->per_est_estado == 1)
                                    {
                                        $estado = "Aprobado";
                                    } 
                                    else 
                                    {
                                        $estado = "No Aprobado";
                                    }
                                    echo $estado;
                                ?>
                            </span>
                        </td>
                    <?php } ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- <a href="#" onclick="notifyMe()">link</a> -->
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
                    <form role="form" action="?c=Hoja_vida&a=change_Estado" method="post" >
                        <div class="form-group">
                            <label for="id">ID Solicitud</label>
                            <input type="text" readonly="" class="form-control" name="id" id="id" placeholder="id"/>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select name="id_estado" class="form-control">
                                <option value="0">Pendiente</option>
                                <option value="1">Aprobar</option>
                                <option value="2">No Aprobar</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="motivo">Observaciones</label>
                            <textarea class="form-control" name="observaciones" placeholder="Observaciones" required=""></textarea>
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
                var fechaI = $(this).data('inicio');
                var fechaF = $(this).data('final');
                // Ejecutamos AJAX 
                $("#dynamic-Per_Estudio_Horario").load("view/Hoja_vida/dynamic/Ver_Horario_PER_EStudio.php",{id,fechaI, fechaF}); 
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