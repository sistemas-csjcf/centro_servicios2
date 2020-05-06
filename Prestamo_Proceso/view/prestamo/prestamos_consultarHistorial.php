<?php
    session_start();
    $_SESSION['nombre'];
    $id_user                = $_SESSION['idUsuario'];
    $modelo                 = new Prestamo();
//    $campos                 = 'usuario';
//    $nombrelista            = 'pa_usuario_acciones';
//    $idaccion               = '42';
//    $campoordenar           = 'id';
//    $datosusuarioacciones   = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
//    $usuarios               = $datosusuarioacciones->fetch();
//    $usuariosa              = explode("////",$usuarios[usuario]);
    
    $datosJuzgado = $modelo->get_Juzgado();
    if(isset($id_user)){
?>
    <h1 class="page-header">Consultar Documentos</h1>
    <div class="form-group row">
        <div class="col-xs-4">
            <label>Código Solicitud </label>
            <input type="text" name="id" id="id"  class="form-control" placeholder="Ingrese ID Solicitud" />
        </div>
        <div class="col-xs-4">
            <label for="fecha_inicio">Fecha Inicial</label>
            <input name="fechaI" class="form-control" id="fechaInicio" type="date">
        </div>
        <div class="col-xs-4">
            <label for="fehca_fin">Fecha Final</label>
            <input name="fechaF" class="form-control" id="fechaFin" type="date" max="<?php echo $fecha_actual; ?>">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-4">
            <label>Radicado </label>
            <input type="number" name="radicado" id="radicado" class="form-control" placeholder="Ingrese N° Radicado" />
        </div>
        <div class="col-xs-4">
            <label>Demandante</label>
            <input type="text" name="demandante" id="demandante" class="form-control" placeholder="Ingrese Demandante" />
        </div>
        <div class="col-xs-4">
            <label>Demandado</label>
            <input type="text" name="demandado" id="demandado" class="form-control" placeholder="Ingrese Demandado" />
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-4">
            <label>Juzgado</label>
            <select name="juzgado" id="juzgado" class="form-control">
                <option value="">Seleccione Juzgado</option>
                <?php while($row = $datosJuzgado->fetch()){ ?>
                    <option value="<?php echo $row['cod_juzgado']; ?>"><?php echo $row['nombre']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-xs-4">
            
        </div>
        <div class="col-xs-4">
            
        </div>
    </div>
    <hr />
    <div class="text-center">
        <button class="btn btn-info" id="btn_guardar" onclick="consultar_prestamo();"><span class="glyphicon glyphicon-search"></span> Consultar</button>
        <button class="btn btn-default" onclick="location.reload();" ><i class="fa fa-eraser" aria-hidden="true"></i>Restablecer</button>
    </div><br>
    <div id="load" style="display: none">
        <div class="progress" >
            <div id="bar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                <span class="sr-only">10% Complete</span>
            </div>
        </div>
    </div>
    <div id="resultado"></div>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>