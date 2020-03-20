<?php
    $id_user = $_SESSION['idUsuario'];
    $modelo         = new Tutela();
   
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '32';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
    
    $datos_cod_juzgado = $modelo->get_codigo_Despacho($id_user);
    while($r = $datos_cod_juzgado->fetch()){
        $cod_juzgado = $r[0];
    }
    //echo " ".substr($cod_juzgado, 9);
    $entidad        = substr($cod_juzgado, 5,2);
    $especialidad   = substr($cod_juzgado, 7,2);
    $num_juzgado    = substr($cod_juzgado, 9);
    
    
    $datos_tutelas_migradas = $modelo->get_lista_reparto_tutela($cod_juzgado);
    while($r = $datos_tutelas_migradas->fetch()){
        $tutelas_migradas_despacho[] = $r[0];
    }
    //print_r($tutelas_migradas);
    date_default_timezone_set('America/Bogota'); 
    $fecha  = date('Y-m-d');
    if(isset($id_user)){
        if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
?>
    <div class="form-group row">
        <div class="col-xs-3">
            <label for="fecha_inicio">ID</label>
            <input type="number" name="id" id="id" placeholder="Ingrese ID" class="form-control">
            <input type="hidden" name="cod_despacho" id="cod_despacho" value="<?php echo $cod_juzgado; ?>" placeholder="Ingrese ID" class="form-control">
        </div>
        <div class="col-xs-3">
            <label for="fecha_inicio">Radicado</label>
            <input type="number" name="radicado" id="radicado" placeholder="Ingrese Radicado" class="form-control">
        </div>
        <div class="col-xs-3">
            <label for="fecha_inicio">Fecha Inicial</label>
            <input readonly="" name="fechaI" id="fechaInicio" type="date" class="form-control datepicker">
        </div>
        <div class="col-xs-3">
            <label for="fecha_fin">Fecha Final</label>
            <input readonly="" name="fechaF" id="fechaFin" type="date"    class="form-control datepicker">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-3">
            <label for="fecha_inicio">Fecha Fallo</label>
            <input readonly="" name="fecha_fallo" id="fecha_fallo" type="date" class="form-control datepicker">
        </div>
        <div class="col-xs-3">
            <label for="fecha_inicio">Fallo</label>
            <select name="flag_fallo" id="flag_fallo" class="form-control">
                <option value="">Seleccione una opción</option>
                <option value="si">Si</option>
                <option value="no">No</option>
            </select>
        </div>
    </div>
    <hr />
    <div>
        <button class="btn btn-info" id="btn_guardar" onclick="search_local_Tutelas_despacho(11);"><span class="glyphicon glyphicon-search"></span> Consultar</button>
        <button class="btn btn-default" onclick="location.reload();" ><i class="fa fa-eraser" aria-hidden="true"></i> Restablecer</button>
    </div>
    <h1 class="page-header">Tutelas</h1>
    <div id="load" style="display: none">
        <div class="progress" >
            <div id="bar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                <span class="sr-only">10% Complete</span>
            </div>
        </div>
    </div>
    <div id="resultado"></div>
    <div id="tb_inicial">
        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #4682B4; color: white;">
                    <th title="Código Interno Tutela">ID</th>
                    <th>Radicado</th>
                    <th style="width:120px;">Fecha Registro</th>
                    <th>Fecha Vencimiento</th>
<!--                    <th>Fallo</th>-->
                    <th>Fecha Fallo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($this->model->alerta_tutelaD_limit($cod_juzgado) as $r): ?>
                    <tr>
                        <td><?php echo $r->tut_id; ?></td>
                        <td><?php echo $r->tut_radicado; ?></td>
                        <td><?php echo $r->tut_fecha; ?></td>
                        <td><?php echo $r->tut_fecha_vencimiento; ?></td>
<!--                        <td>
                            <?php 
                               /* if($r->tut_flag_vencimiento ==0){
                                    echo "Si";
                                }else{
                                    echo "No";
                                }
                                
                                */
                             ?>
                        </td>-->
                        <?php
                            if($r->tut_fecha_fallo <= $r->tut_fecha_vencimiento && $r->tut_fecha_fallo !=""){
                                $alerta= "alert-success";
                            }else if($r->tut_fecha_fallo > $r->tut_fecha_vencimiento){
                                $alerta= "alert-danger";
                            }else{
                                $alerta= "alert-default";
                            }
                        ?>
                        <td class="alert <?php echo $alerta; ?>"><?php echo $r->tut_fecha_fallo; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php }else{ ?> 
        <h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para acceder a esta opción</h4>
    <?php } ?> 
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>