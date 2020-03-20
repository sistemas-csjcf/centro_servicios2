<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user              = $_SESSION['idUsuario'];
    //------------ JUAN ESTEBAN MUNERA BETANCUR -----------------------------------------------------------------//
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
    <h1 class="page-header">
        <?php echo $vis->fes_id != null ? $vis->fes_fecha : 'Nuevo Registro'; ?>
    </h1>

    <ol class="breadcrumb">
      <li><a href="?c=Visitas&a=dia_noHabil">Días Festivos</a></li>
      <li class="active"><?php echo $vis->fes_id != null ? $vis->fes_fecha : 'Nuevo Registro'; ?></li>
    </ol>

    <form id="frm-Festivos" action="?c=Visitas&a=Guardar_dia_noHabil" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $vis->fes_id; ?>" />
        <div class="form-group">
            <label>Fecha </label>
            <input type="text" readonly="" name="fechaFestivo" id="fechaFestivo" value="<?php echo $vis->fes_fecha; ?>" class="form-control datepicker" placeholder="Ingrese Fecha Festivo" data-validacion-tipo="requerido" />    
        </div>
        <div class="form-group">
            <label>Descripción </label>
            <textarea class="form-control" name="descripcionF" id="descripcionF" rows="2" placeholder="Ingrese Descripción del Día Festivo" data-validacion-tipo="requerido|min:4"><?php echo $vis->fes_descripcion; ?></textarea>
        </div>
        <hr />
        <div class="text-right">
            <button class="btn btn-success">Guardar</button>
        </div>
    </form>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#frm-Festivos").submit(function(){
                return $(this).validate();
            });
        });
    </script>
    <?php }else{ ?><br/>
        <h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para acceder a esta opción</h4>
    <?php } ?>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.30/centro_servicios2" ); } ?>