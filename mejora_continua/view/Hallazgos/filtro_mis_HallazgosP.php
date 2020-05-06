<?php
    session_start();
    $_SESSION['nombre'];
    $id_user = $_SESSION['idUsuario'];
    require_once "../../core/conexion.php";
    require_once "../../model/mejora_continua_model.php";
    $modelo  = new mejora_c();
    
    $link   = conectarse();
    $id     = $_POST['id'];
    $fechaI = $_POST['inicio'];
    $fechaF = $_POST['fin'];
    
    if ( !empty($id_user) ) {	
        $filtro1 = " AND hal_id_user_responsable = '$id_user' ";
    }
    if ( !empty($fechaI) && !empty($fechaF) ) {		
        $filtro2 = " AND (hal_fecha BETWEEN '$fechaI' AND '$fechaF') ";
    }
    if ( !empty($id) ) {	
        $filtro4 = " AND hal_id = '$id' ";
    }
    $filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4;
   
    $sql=("SELECT DATEDIFF(hal_fecha_limite, NOW())AS diferencia, `hal_id`, `hal_fecha`,`hal_id_user`, `hal_id_user_responsable`, 
                    `hal_descripcion`, `hal_ruta_doc`, `hal_fecha_gestion`,`hal_estado`, `hal_fecha_limite`, us.empleado, hal_id_userE 
            FROM `mc_hallazgos` AS ha
            INNER JOIN pa_usuario AS us ON ha.hal_id_user = us.id
        WHERE hal_id > '0' AND hal_estado =0 " .$filtrox. " ORDER BY hal_id DESC");
    $result=mysql_query($sql,$link);
    
    $num_filas = mysql_num_rows($result); 
    if($num_filas>0){
        $alerta  = "success";
        $mensaje = "";
    }else{
        $alerta  = "danger";
        $mensaje = "No existen datos registrados";
    }
    if(isset($id_user)){
?>
        <div class="alert alert-<?php echo $alerta; ?>" role="alert">Total Registros: <strong><?php echo $num_filas;?> <?php echo $mensaje; ?></strong></div>
        <table id="example4" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #B71F56; color: white;">
                    <th title="Código Interno Hallazgo" style="width:12px;">ID</th>
                    <th style="width:10px;">Fecha Solicitud</th>
                    <th style="width:10px;">Fecha Limite</th>
                    <th title="Solicitante" style="width:12px;">Solicitante</th>
                    <th title="Descripción del Hallazgo" style="width:120px;">Descripción</th>
                    <th style="width:12px;">Documento</th>
                    <th title="Gestionar Hallazgo" style="width:12px;">Gestionar</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=0; $i <$num_filas; $i++){ ?>
                   <?php while ($r = mysql_fetch_array($result)){ ?>
                        <tr>
                            <td>
                                <?php
                                    echo $r['hal_id']; 
                                    if($r['diferencia'] > 2){ 
                                        $flag="green";
                                    }else if($r['diferencia'] < 0){
                                        $flag="red";
                                    }else if($r['diferencia'] >=0 && $r['diferencia'] <3){
                                        $flag="goldenrod";
                                    }
                                ?>
                                <i class="fa fa-flag" aria-hidden="true" style="font-size: 20px; color: <?php echo $flag; ?>" title="Tarea En Tramite"></i>
                            </td>
                            <td><?php echo $r['hal_fecha'] ?></td>
                            <td><?php echo $r['hal_fecha_limite'] ?></td>
                            <td>
                                <?php 
                                    if($r['hal_id_userE'] >0){
                                        $datos_user = $modelo->get_dato_Usuario1($r['hal_id_userE']);
                                        $get_user   = $datos_user->fetch();
                                        echo $get_user['empleado']; 
                                    }else{
                                        echo $r['empleado']; 
                                    }
                                ?>
                            </td>
                            <td><button class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal_Ver_M" data-descripcion="<?php echo $r['hal_descripcion'] ?>" ><i class="icon-zoom-in" style="font-size: 20px;" title="Ver Descripción"> </i></button></td>
                            <td>
                                <?php if($r['hal_ruta_doc'] !=""){ ?>
                                    <a href="void()" class="btn btn-default" onclick="ver_doc_adjunto(3,'<?php echo $r['hal_ruta_doc']; ?>');return false;" target="_blank" title="Descargar Documento Adjunto"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a>
                                <?php }else{ ?>
                                    <span class="icon-blocked" style="color: red; font-size: 18px;" title="Sin Documento Adjunto"></span>
                                <?php } ?>
                            </td>
                            <td><button class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModalGestionarFind" data-id="<?php echo $r['hal_id']; ?>" data-fecha_limite="<?php echo $r['hal_fecha_limite']; ?>" data-descripcion="<?php echo $r['hal_descripcion']; ?>"data-solicitante="<?php echo $r['empleado'] ?>" ><i class="glyphicon glyphicon-folder-open" style="font-size: 20px; color: darkkhaki" title="Gestionar Tarea"></i></button></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
        
        <!-- Modal Asignar Responsable-->
        <div class="modal fade" id="myModalAsignarUS" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Cerrar</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">
                            Asignar Responsable Tarea 
                        </h4>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form role="form" action="?c=Mejora_C&a=Reasignar_Task" method="post" id="frm-Asignartarea" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="id">ID Solicitud</label>
                                <input type="text" readonly="" class="form-control" name="id" id="id" placeholder="id"/>
                            </div>
                            <div class="form-group">
                                <i class="icon-user-check"ria-hidden="true"></i> <label for="motivo"> Asignar Responsable </label>
                                <select name="id_user_responsable" id="id_user_responsable" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="requerido" >
                                    <option value="">Seleccione una opción</option>
                                    <?php while($row = $lista_us_all->fetch()){ ?>
                                        <option value="<?php echo $row['id'] ?>" ><?php echo $row['empleado']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <i class="glyphicon glyphicon-calendar" aria-hidden="true"></i> <label> Fecha Límite </label>
                                <input readonly type="text" name="fecha_limite" class="form-control datepicker" placeholder="Ingrese Límite tarea" id="fecha_limite" data-validacion-tipo="requerido" />
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
            $('#myModalAsignarUS').on('show.bs.modal', function (event) {
                var button          = $(event.relatedTarget) 
                var id              = button.data('id')

                var modal = $(this)
                modal.find('.modal-body input[name="id"]').val(id)
            })
            $(document).ready(function(){
                $("#frm-Asignartarea").submit(function(){
                    return $(this).validate();
                });
            })
        </script>
        <!-- Modal Ver Más-->
        <div class="modal fade" id="myModal_Ver_M" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Descripción del Hallazgo </h4>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label> Descripción </label>
                            <textarea class="form-control" readonly="" name="comentarios" id="comment" rows="5" placeholder="Descripción Hallazgo" data-validacion-tipo="requerido|min:5" ></textarea>
                        </div> 
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#myModal_Ver_M').on('show.bs.modal', function (event) {
                var button          = $(event.relatedTarget) 
                var descripcion = button.data('descripcion') 

                var modal = $(this)
                modal.find('.modal-body textarea[name="comentarios"]').val(descripcion)
            })
        </script>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.30/centro_servicios2" ); } ?>