<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user    = $_SESSION['idUsuario'];
    //echo $_SESSION['id_proceso_cs'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo             = new mejora_c();
    $lista_us_all       = $modelo->get_Responsable();
    $lista_us_lider     = $modelo->get_Responsable_lider($_SESSION['id_proceso_cs']);
    
    $idaccion           = '33';
    $datos_us_accion    = $modelo->get_lista_usuario_accionesJE($idaccion);
    $us_privilegios     = $datos_us_accion->fetch();
    $usuarioAD          = explode("////",$us_privilegios[usuario]);
    
    $idaccion           = '34';
    $datos_us_accion    = $modelo->get_lista_usuario_accionesJE($idaccion);
    $us_lider_MC        = $datos_us_accion->fetch();
    $usuario_lider_mc   = explode("////",$us_lider_MC[usuario]);
    
    $lista_clase        = $modelo->Get_Clases();
    $lista_norma        = $modelo->Get_Normas();
    $lista_metodologia  = $modelo->Get_Metodologia();
    $lista_generada     = $modelo->Get_Generada();
    $lista_proceso1     = $modelo->Get_Procesos();
    
    if(isset($id_user)){
        if($_SESSION['idperfil'] !=22){
?>
    <h1 class="page-header">
        <?php echo $mc->tar_id != null ? 'Actualizar Registro' : 'Nuevo Registro'; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#" style="text-decoration: none;">Acciones de Gestión</a></li>
        <li class="active"><?php echo $mc->tar_id != null ? $mc->tar_id : 'Nuevo Registro'; ?></li>
    </ol>
    <form id="frm-tarea" action="?c=Mejora_C&a=Guardar_Tarea" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $mc->tar_id; ?>" />
        <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" />
        <input type="hidden" name="tipo_us" value="1" >
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="flag_estado">Clase </label>
                <select name="id_clase" id="id_clase" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="requerido" >
                    <option value="">Seleccione clase</option>
                    <?php while($row = $lista_clase->fetch()){ ?>
                        <option value="<?php echo $row['clas_id'] ?>" ><?php echo $row['clas_titulo']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-xs-6">
                <label for="flag_estado">Numeral Norma </label>
                <select name="id_norma" id="id_norma" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="requerido" >
                    <option value="">Seleccione Numeral Norma</option>
                    <?php while($row = $lista_norma->fetch()){ ?>
                        <option value="<?php echo $row['nor_id'] ?>" ><?php echo $row['nor_titulo']; ?></option>
                    <?php } ?>
                </select>
            </div> 
        </div>
        <!-- <div class="form-group row">
           <?php if ( in_array($_SESSION['idUsuario'],$usuarioAD) ) { ?>
                <div class="col-xs-6">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i> <label for="responsable">Responsable</label>
                    <select name="tar_id_user_responsable" id="tar_id_user_responsable" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="">
                        <option>Seleccione Responsable</option>

                        <?php while($row = $lista_us_all->fetch()){ ?>
                            <?php if($mc->tar_id_user_responsable == $row['id']){ ?>
                                <option value="<?php echo $row['id']."// ".$row['id_proceso_cs']; ?>" selected=""><?php echo $row['empleado']; ?></option>
                            <?php }else{ ?>
                                <option value="<?php echo $row['id']."// ".$row['id_proceso_cs'] ?>"><?php echo $row['empleado']; ?></option>
                            <?php }} ?>
                    </select>
                </div>
            <?php }else if ( in_array($_SESSION['idUsuario'],$usuario_lider_mc) ){ ?>   
                <div class="col-xs-6">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i> <label for="responsable">Responsable Acción de Gestión</label>
                    <select name="tar_id_user_responsable" id="tar_id_user_responsable" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="">
                        <option>Seleccione Responsable</option>
                        <option value="46//7">Natalia Quintero Hoyos</option>
                        <?php while($row = $lista_us_lider->fetch()){ ?>
                            <?php if($mc->tar_id_user_responsable == $row['id']){ ?>
                                <option value="<?php echo $row['id']."// ".$row['id_proceso_cs']; ?>" selected=""><?php echo $row['empleado']; ?></option>
                            <?php }else{ ?>
                                <option value="<?php echo $row['id']."// ".$row['id_proceso_cs'] ?>"><?php echo $row['empleado']; ?></option>
                        <?php }} ?>
                    </select>
                </div>
            <?php }else{ ?>
            <div class="col-xs-6"></div>
            <?php } ?>
            <div class="col-xs-6">
                <i class="glyphicon glyphicon-calendar" aria-hidden="true"></i> <label> Fecha Límite </label>
                <input readonly type="text" name="fecha_limite" value="<?php echo $mc->tar_fecha_limite; ?>" class="form-control datepicker" id="fecha_limite" placeholder="Ingrese Límite tarea" data-validacion-tipo="requerido" />
            </div>
        </div> -->
        <div class="form-group">
            <label> Descripción </label>
            <textarea class="form-control" name="comentarios" id="comment" rows="5" placeholder="Ingrese Descripción Acción Gestión" data-validacion-tipo="requerido|min:15"><?php echo $mc->tar_descripcion; ?></textarea>
        </div> 
        <!--<div class="form-group row">
            <div class="col-xs-6">
                <i class="glyphicon glyphicon-paperclip" aria-hidden="true"></i> <label>Adjuntar</label>
                <input id="file-1" name="tar_ruta_doc_adjunto" type="file" placeholder="Ingrese Documento" class="file" data-preview-file-type="any">
            </div>
            <div class="col-xs-6">
                <?php if($mc->tar_ruta_doc_adjunto != ''): ?>
                    <div class="img-thumbnail " style="border: 0px;">
                        <a href="upload_tareas/<?php echo $mc->tar_ruta_doc_adjunto; ?>" target="_blank" style="text-decoration:none;"><i class="icon-download3"></i>Descargar</a>
                    </div>
                <?php endif; ?>            
            </div>
        </div>-->
        <div class="form-group">
            <label> Análisis de Causas </label>
            <textarea class="form-control" name="causas" id="comment" rows="5" placeholder="Ingrese Análisis de Causas" data-validacion-tipo="requerido|min:5" ></textarea>
        </div>
        <div class="form-group row">
            <div class="col-xs-4">
                <label for="flag_estado">Proceso Afectado o Impactado </label>
                <select name="id_procesoImp" id="id_procesoImp" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="requerido" >
                    <option value="">Seleccione una Opción</option>
                    <?php while($row = $lista_proceso1->fetch()){ ?>
                        <option value="<?php echo $row['proc_id'] ?>" ><?php echo $row['proc_titulo']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-xs-4">
                <label for="flag_estado">Metodología</label>
                <select name="id_metodologia" id="id_metodologia" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="requerido" >
                    <option value="">Seleccione Metodología</option>
                    <?php while($row = $lista_metodologia->fetch()){ ?>
                        <option value="<?php echo $row['met_id'] ?>" ><?php echo $row['met_titulo']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-xs-4">
                <label for="flag_estado">Generada por </label>
                <select name="id_generado" id="id_generado" class="form-control selectpicker" data-live-search="true" data-validacion-tipo="requerido" >
                    <option value="">Seleccione una Opción</option>
                    <?php while($row = $lista_generada->fetch()){ ?>
                        <option value="<?php echo $row['gen_id'] ?>" ><?php echo $row['gen_titulo']; ?></option>
                    <?php } ?>
                </select>
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
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>