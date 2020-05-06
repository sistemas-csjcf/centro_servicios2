<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user              = $_SESSION['idUsuario'];
    // JUAN ESTEBAN MUNERA BETANCUR
    // ADMIN
    $modelo               = new HojaVida();
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '28';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);

    //PLANTA DE PERSONAL
    $idaccionPP             = '30';
    $datosusuarioaccionesPP = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccionPP,$campoordenar);
    $usuariosPP             = $datosusuarioaccionesPP->fetch();
    $usuariosaPP            = explode("////",$usuariosPP[usuario]);
    
    if(isset($id_user)){
        if ( in_array($_SESSION['idUsuario'],$usuariosaPP) ) {
?>
    <h1 class="page-header">Alerta Licencias Planta de Personal</h1>
    <table id="example_order" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr style="background-color: #4682B4; color: white;">
                <th title="Código Registro" style="width:12px;">ID</th>
                <th title="Fecha Vencimiento">Fecha</th>
                <th>Nombre Cargo</th>
                <th title="Propiedad">Número Cédula</th>
                <th title="Propiedad">Nombre Empleado</th>
                <th>Número Cédula</th>
                <th>Nombre Empleado</th>
                <th>Ubicación</th>
                <th>Alerta</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($this->model->Lista_Licencias_Planta_Personal() as $r): ?>
                <tr>
                    <td>
                        <?php echo $r->pla_id; ?>
                        <?php if($r->dias < 8){ ?>
                            <i class="icon-flag" aria-hidden="true" style="color: red" title="Alerta Licencia faltan <?php echo $r->dias ?> día(s)"></i>
                        <?php }else if($r->dias > 8 && $r->dias < 15){ ?>
                            <i class="icon-flag" aria-hidden="true" style="color: goldenrod" title="Alerta Licencia faltan <?php echo $r->dias ?> día(s)"></i>
                        <?php }else if($r->dias > 15){ ?>
                            <i class="icon-flag" aria-hidden="true" style="color: green" title="Alerta Licencia faltan <?php echo $r->dias ?> día(s)"></i>
                        <?php }else{ ?>
                            <i class="icon-flag" aria-hidden="true"  title="Alerta Licencia faltan <?php echo $r->dias ?> día(s)"></i>
                        <?php } ?>
                    </td>
                    <td><?php echo $r->pla_fecha_fin; ?></td>
                    <td><?php echo $r->car_titulo; ?></td>
                    <td><?php echo $r->cedula; ?></td>
                    <td><?php echo $r->empleado; ?></td>
                    <td><?php echo $r->cedulaR; ?></td>
                    <td><?php echo $r->empleadoR; ?></td>
                    <td><?php echo $r->ubi_titulo." - ".$r->are_titulo; ?></td>
                    <th><a onclick="javascript:return confirm('¿Seguro de Apagar Alerta?');" href="?c=Hoja_vida&a=Apagar_AlertaVencimiento&data-id= <?php echo $r->pla_id; ?>&data-us=<?php echo $id_user; ?>" ><i class="glyphicon glyphicon-off" style="font-size: 20; color: red;"></i></a></th>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
            $('#example1').DataTable();
            $('#example2').DataTable();
            $('#example3').DataTable();
            $('#example4').DataTable();
            $('#example_historial').DataTable( {
                "order": [[ 0, "desc" ]]
            });
            $('#example_order').DataTable( {
                "order": [[ 2, "asc" ]]
            });
        } );
        $('.selectpicker').selectpicker({
            style: 'btn-info',
            size: 4
        });
    </script>
<?php }}else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>