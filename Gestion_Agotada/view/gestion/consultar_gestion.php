<?php 
    session_start();
    $id_user              = $_SESSION['idUsuario'];
    $nombreUS             = $_SESSION['nombre'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo               = new Gestion();
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '21';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
    date_default_timezone_set('America/Bogota'); 
    $fecha_actual = date('Y-m-d');
    $lista_lideresJuzgado = $modelo->lista_lideres();
    $lista_lideresJ       = $modelo->lista_lideres();
    while ($rs = $lista_lideresJ->fetch()){
        $array_lideres[] = $rs['id'];
    }
    if(isset($id_user)){
        if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
?>
        <h1 class="page-header">Consultar Gestión Agotada</h1>
        <div class="form-group row">
            <div class="col-xs-4">
                <label for="hora_inicio">Fecha Inicio</label>
                <input type="text" readonly="" name="fechaInicio" id="fechaI" class="form-control datepicker" value="<?php echo $fecha_actual; ?>" required="">
            </div>
            <div class="col-xs-4">
                <label for="hora_fin">Fecha Fin</label>
                <input type="text" readonly="" name="fechaFin" id="fechaF" class="form-control datepicker" value="<?php echo $fecha_actual; ?>"  required="">
            </div>
            <div class="col-xs-4">
                <label for="lider_juzgado">Líder notificaciones</label>
                <select name="lider_juzgado" id="lider_juzgado" class="form-control">
                    <?php if(in_array($id_user, $array_lideres)){ ?>
                        <option value="<?php echo $id_user ?>"><?php echo utf8_encode($nombreUS); ?></option>    
                    <?php }else{ ?>
                        <?php while ($row = $lista_lideresJuzgado->fetch()){ ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo ($row['lider']) ?></option>
                        <?php } ?>
                        <option value="all">Todos</option>  
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-info" onclick="consultar_rangoGestion()"><i class="fa fa-search" aria-hidden="true"></i> Consultar</button>
            <button class="btn btn-default" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Restablecer</button>
        </div>
        <hr />
        <div id="load" style="display: none">
            <div class="progress" >
                <div id="bar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                    <span class="sr-only">10% Complete</span>
                </div>
            </div>
        </div>
        <div id="reporte_gestionAgotada"></div>
    <?php }else{ ?><br/>
        <h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para acceder a esta opción</h4>
    <?php } ?>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>