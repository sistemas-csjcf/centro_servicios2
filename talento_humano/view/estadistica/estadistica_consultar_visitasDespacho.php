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
    <h1 class="page-header">Cantidad de Solicitud de Visitas por Despachos</h1>
        <div class="form-group row">
            <div class="col-xs-5">
                <label for="hora_inicio">Fecha Inicio</label>
                <input type="text" readonly="" name="fechaInicio" id="fechaI" class="form-control datepicker" value="<?php echo $fecha_actual; ?>" required="">
            </div>
            <div class="col-xs-5">
                <label for="hora_fin">Fecha Fin</label>
                <input type="text" readonly="" name="fechaFin"  id="fechaF" class="form-control datepicker" value="<?php echo $fecha_actual; ?>"  required="">
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-info" onclick="consultar_estadisticaVisitasDespacho()"><i class="fa fa-search" aria-hidden="true"></i> Consultar</button>
            <button class="btn btn-default" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Restablecer</button>
        </div>
        <hr />
    
    <div id="load"></div>
    <div id="reporte_estadistica"></div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#frm-tSocial").submit(function(){
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