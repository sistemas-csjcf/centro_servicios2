<?php
    session_start();
    $id_user_perfil = $_SESSION['idperfil'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo               = new mejora_c();
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '13';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuario_despacho     = explode("////",$usuarios[usuario]);
    //if(isset($id_user)){
        if ( in_array($_SESSION['idUsuario'],$usuario_despacho) ) {
?>
    <h1 class="page-header">Solicitudes</h1>
    <div class="well well-sm text-right">
        <a class="btn btn-primary" href="?c=Mejora_C&a=Crud_tarea">Nueva Tarea</a>
    </div>

    <table id="example" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #3498DB; color: white;">
                    <th style="width:12px;" title="Còdigo Tarea">ID</th>
                    <th style="width:180px;" title="Fecha Solicitud">Fecha Solicitud</th>
                    <th>Descripciòn</th>
                    <th>Adjunto</th>
                    <th>Estado</th>
                    <th style="width:60px;">Gestión</th>
                    <th style="width:60px;" title="Documento Adjunto Gestión">Adjunto</th>
                </tr>
            </thead>
        </thead>
        <tbody>
        <?php foreach($this->model->Listar_Solicitud_tarea_Despacho($_SESSION['idUsuario']) as $r): ?>
            <tr>
                <td><?php echo $r->tar_id; ?></td>
                <td><?php echo $r->tar_fecha; ?></td>
                <td><?php echo $r->tar_descripcion; ?></td>
                <td><a href="void()" class="btn btn-default" onclick="ver_doc_adjunto(1,'<?php echo $r->tar_ruta_doc; ?>');return false;" target="_blank" title="Descargar Documento Adjunto"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a></td>
                <?php 
                    if($r->tar_estado == 0 ){
                        $alerta= "alert-warning";
                        $mensaje ="Pendiente";
                        $show = 0;
                    }else if($r->tar_estado == 1){
                        $alerta  = "alert-success";
                        $mensaje = "Gestinada";
                        $show = 1;
                    }else{
                        $alerta  = "alert-danger";
                        $mensaje ="-";
                        $show = 0;
                    }
                ?>
                <td class="alert <?php echo $alerta; ?>"><?php echo $mensaje; ?></td>
                <?php if($show == 0){ ?>
                    <td><span class="icon-hour-glass" title="Pendiente" style="font-size: 18px;"></span></td>
                    <td><span class="icon-blocked" style="color: red; font-size: 18px;" title="Sin Documento Adjunto"> </span></td>
                <?php }else{  ?>
                    
                <?php } ?>
                
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table> 
<?php }else{ ?>
    <h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para acceder a esta opción</h4>
<?php }//}else{ ?>
    <!--<script type="text/javascript">alert("ERROR, autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>-->
<?php //header( "refresh:2; url=http://172.16.175.30/centro_servicios2" ); } ?>