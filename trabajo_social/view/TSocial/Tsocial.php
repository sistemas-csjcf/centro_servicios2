<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user = $_SESSION['idUsuario'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo               = new Visita();
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '20';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
    
    if(isset($id_user)){
        if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
?>
    <h1 class="page-header">Asistente Social</h1>

    <div class="well well-sm text-right">
        <a class="btn btn-primary" href="?c=Visitas&a=Crud_TSocial"><span class="icon-user-plus"> </span> Nuevo Registro</a>
    </div>

    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Contador</th>
                <th>Estado</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($this->model->Listar_TSocial() as $r): ?>
                <tr>
                    <td><?php echo $r->vis_TSoci_nombre; ?></td>
                    <td><?php echo $r->vis_TSoci_contador; ?></td>
                    <?php if($r->vis_TSoci_estado == '1'){ ?>
                        <td class="alert-success">Activo</td>
                    <?php }else{ ?>
                        <td class="alert-danger">Inactivo</td>
                    <?php } ?>
                    <td><a href="?c=visitas&a=Crud_TSocial&id=<?php echo $r->vis_TSoci_id; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table> 
    <?php }else{ ?><br/>
        <h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para acceder a esta opción</h4>
    <?php } ?>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.30/centro_servicios2" ); } ?>