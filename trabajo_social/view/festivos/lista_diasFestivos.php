<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user              = $_SESSION['idUsuario'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo               = new Visita();
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '20';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
    date_default_timezone_set('America/Bogota'); 
    $fecha_actual = date('Y-m-d');
    if(isset($id_user)){
        if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
?>
    <h1 class="page-header">Días Festivos</h1>

    <div class="well well-sm text-right">
        <a class="btn btn-primary" href="?c=Visitas&a=Crud_Festivo"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> Nuevo Registro</a>
    </div>

    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Descripción</th>
                <th style="width: 10px">Editar</th>
<!--                <th style="width: 10px">Eliminar</th>-->
            </tr>
        </thead>
        <tbody>
            <?php foreach($this->model->calendario_festivos() as $r): ?>
                <tr>
                    <?php if($r->fes_fecha > $fecha_actual){ ?>
                        <td class="alert-success"><?php echo $r->fes_fecha; ?></td>
                    <?php }else if ($r->fes_fecha < $fecha_actual){ ?>
                        <td><?php echo $r->fes_fecha; ?></td>
                    <?php }else{ ?>
                        <td class="alert-info"><?php echo $r->fes_fecha; ?></td>
                    <?php } ?>
                    <td><?php echo $r->fes_descripcion; ?></td>
                    <td title="Editar día festivo"><a href="?c=visitas&a=Crud_Festivo&id=<?php echo $r->fes_id; ?>"><i class="glyphicon glyphicon-pencil"></i></a></td>
<!--                    <td title="Eliminar día festivo"><a onclick="javascript:return confirm('¿Seguro de Eliminar este Registro?');" href="?c=visitas&a=Delete_Festivo&id=<?php echo $r->fes_id; ?>"><i class="fa fa-calendar-times-o alert-danger" aria-hidden="true"></i></a></td>-->
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table> 
    <?php }else{ ?><br/>
        <h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para acceder a esta opción</h4>
    <?php } ?>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.30/centro_servicios2" ); } ?>