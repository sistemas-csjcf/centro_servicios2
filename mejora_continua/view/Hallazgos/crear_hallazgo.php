<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user    = $_SESSION['idUsuario'];
    //echo $_SESSION['id_proceso_cs'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo             = new mejora_c();
    $lista_us_all       = $modelo->get_Responsable();
    $lista_us_lider     = $modelo->get_Responsable_lider($_SESSION['id_proceso_cs']);
    
    $idaccion           = '35';
    $datos_us_accion    = $modelo->get_lista_usuario_accionesJE($idaccion);
    $us_privilegios     = $datos_us_accion->fetch();
    $usuarioAD          = explode("////",$us_privilegios[usuario]);

    
    if(isset($id_user)){
        If ( in_array($_SESSION['idUsuario'],$usuarioAD) ) {
?>
    <h1 class="page-header">
        <?php echo $mc->tar_id != null ? 'Actualizar Registro' : 'Nuevo Registro'; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="?c=Mejora_C&a=Mis_Hallazgos">Hallazgos</a></li>
        <li class="active"><?php echo $mc->tar_id != null ? $mc->tar_id : 'Nuevo Registro'; ?></li>
    </ol>
    <form id="frm-tarea" action="?c=mejora_c&a=Guardar_Hallazgo" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $mc->tar_id; ?>" />
        <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" />
        <div class="form-group row">
            <div class="col-xs-6">
                <i class="fa fa-user-circle-o" aria-hidden="true"></i> <label for="responsable">Responsable </label>
                <select name="id_user_responsable" id="id_user_responsable" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="requerido">
                    <option>Seleccione Responsable</option>
                    <?php while($row = $lista_us_all->fetch()){ ?>
                        <?php if($mc->hal_id_user_responsable == $row['id']){ ?>
                            <option value="<?php echo $row['id']; ?>" selected=""><?php echo $row['empleado']; ?></option>
                        <?php }else{ ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['empleado']; ?></option>
                        <?php }} ?>
                </select>
            </div>
            <div class="col-xs-6">
                <i class="glyphicon glyphicon-calendar" aria-hidden="true"></i> <label> Fecha Límite </label>
                <input readonly type="text" name="fecha_limite" value="<?php echo $mc->hal_fecha_limite; ?>" class="form-control datepicker" id="fecha_limite" placeholder="Ingrese Límite tarea" data-validacion-tipo="requerido" />
            </div>
        </div> 
        <div class="form-group">
            <label> Descripción </label>
            <textarea class="form-control" name="comentarios" id="comment" rows="6" placeholder="Ingrese Descripción Hallazgo" data-validacion-tipo="requerido|min:15"><?php echo $mc->hal_descripcion; ?></textarea>
        </div> 
        <div class="form-group row">
            <div class="col-xs-6">
                <i class="glyphicon glyphicon-paperclip" aria-hidden="true"></i> <label>Adjuntar</label>
                <input type="hidden" name="hal_doc_adjunto" value="<?php echo $mc->hal_ruta_doc; ?>" />
                <input id="file-1" name="hal_ruta_doc_adjunto" type="file" placeholder="Ingrese Documento" class="file" value="<?php echo "ruta xxx"; ?>" data-preview-file-type="any">
            </div>
            <div class="col-xs-6">
                <?php if($mc->tar_ruta_doc_adjunto != ''): ?>
                    <div class="img-thumbnail " style="border: 0px;">
                        <a href="upload_Hallazgos/<?php echo $mc->hal_ruta_doc_adjunto; ?>" target="_blank" style="text-decoration:none;"><i class="icon-download3"></i>Descargar</a>
                    </div>
                <?php endif; ?>            
            </div>
        </div>
        <hr />
        <div class="text-right">
            <button class="btn btn-success" ><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
        </div>
    </form>
    <script>
        $(document).ready(function(){
            $("#frm-tarea").submit(function(){
                return $(this).validate();
            });
        })
    </script>
    <?php }else{ ?> 
        <h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para acceder a esta opción</h4>
    <?php } ?> 
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.30/centro_servicios2" ); } ?>