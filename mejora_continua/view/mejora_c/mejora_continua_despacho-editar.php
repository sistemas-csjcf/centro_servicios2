<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user    = $_SESSION['idUsuario'];
    //echo $_SESSION['id_proceso_cs'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo             = new mejora_c();
    $lista_us_all       = $modelo->get_Responsable();
    $lista_us_lider     = $modelo->get_Responsable_lider($_SESSION['id_proceso_cs']);
    
    $idaccion           = '13';
    $datos_us_accion    = $modelo->get_lista_usuario_accionesJE($idaccion);
    $us_privilegios     = $datos_us_accion->fetch();
    $usuario_despacho   = explode("////",$us_privilegios[usuario]);

    
    if(isset($id_user)){
        if ( in_array($_SESSION['idUsuario'],$usuario_despacho) ) {
?>
    <h1 class="page-header">
        <?php echo $mc->tar_id != null ? 'Actualizar Registro' : 'Nuevo Registro'; ?>
    </h1>

    <ol class="breadcrumb">
        <li><a href="?c=Mejora_C&a=consultar_lista_tareas_despacho">Solicitudes</a></li>
        <li class="active"><?php echo $mc->tar_id != null ? $mc->tar_id : 'Nuevo Registro'; ?></li>
    </ol>
    <form id="frm-tarea" action="?c=mejora_c&a=Guardar_Tarea" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $mc->tar_id; ?>" />
        <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" />
        <input type="hidden" name="tar_id_user_responsable" value="46//7" />
        <input type="hidden" name="tipo_us" value="22" >
        <input type="hidden" name="fecha_limite" value="0000-00-00" />
        <div class="form-group">
            <label> Descripción </label>
            <textarea class="form-control" name="comentarios" id="comment" rows="5" placeholder="Ingrese Descripción Acción de Gestión" data-validacion-tipo="requerido|min:5"><?php echo $mc->tar_descripcion; ?></textarea>
        </div> 
        <div class="form-group row">
            <div class="col-xs-6">
                <i class="glyphicon glyphicon-paperclip" aria-hidden="true"></i> <label>Adjuntar</label>
                <input type="hidden" name="tar_doc_adjunto" value="<?php echo $mc->tar_ruta_doc; ?>" />
                <input id="file-1" name="tar_ruta_doc_adjunto" type="file" placeholder="Ingrese Documento" class="file" value="<?php echo "ruta xxx"; ?>" data-preview-file-type="any">
            </div>
            <div class="col-xs-6">
                <?php if($mc->tar_ruta_doc_adjunto != ''): ?>
                    <div class="img-thumbnail " style="border: 0px;">
                        <a href="upload_tareas/<?php echo $mc->tar_ruta_doc_adjunto; ?>" target="_blank" style="text-decoration:none;"><i class="icon-download3"></i>Descargar</a>
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
<?php }}else{ ?>
    <script type="text/javascript">alert("ERROR, autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>