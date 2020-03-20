<?php
    $id_user = $_SESSION['idUsuario'];
    $modelo         = new Tutela();
    $datosproceso   = $modelo->Listar();
    
    $datos_radi  = explode("//////",$datosproceso[0]);
    $datos_fecha = explode("---",$datosproceso[1]);
    $datos_hora  = explode("***",$datosproceso[2]);
    $datos_pone  = explode("+++",$datosproceso[3]);
    $datos_juzg  = explode("****",$datosproceso[4]);
    //print_r($datos_juzg);
    $cantr          = count($datos_radi);
    $matriz =  array ($datos_radi, $datos_pone, $datos_fecha, $datos_hora);
    //print_r($matriz);
    
    $datos_juzgado = $modelo->get_Juzgados_us($id_user);
    
    while($r = $datos_juzgado->fetch()){
        $lista_juzgado[] = $r[0];
    }
    date_default_timezone_set('America/Bogota'); 
    $fecha  = date('Y-m-d');
    if(isset($id_user)){
?>
    <div class="form-group row">
        <div class="col-xs-4">
            <label for="fecha_inicio">Fecha Inicial</label>
            <input readonly="" name="fechaI" id="fechaInicio" type="date" value="<?php echo $fecha; ?>" class="form-control datepicker">
        </div>
        <div class="col-xs-4">
            <label for="fecha_fin">Fecha Final</label>
            <input readonly="" name="fechaF" id="fechaFin" type="date" value="<?php echo $fecha; ?>" class="form-control datepicker">
        </div>
    </div><hr />
    <div>
        <button class="btn btn-info" id="btn_guardar" onclick="consultar_Tutelas();"><span class="glyphicon glyphicon-search"></span> Consultar</button>
        <button class="btn btn-default" onclick="location.reload();" ><i class="fa fa-eraser" aria-hidden="true"></i>Restablecer</button>
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
                    <th>Radicado</th>
                    <th>Juzgado</th>
                    <th>Fecha</th>
                    <th style="width:120px;">Hora</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach ($datos_juzg as $key => $valor){
                       if(in_array($valor, $lista_juzgado)){
                ?>
                    <tr>
                        <td><?php echo $matriz[0][$key]; ?></td>
                        <td><?php echo $matriz[1][$key]; ?></td>
                        <td><?php echo $matriz[2][$key]; ?></td>
                        <td><?php echo $matriz[3][$key]; ?></td>
                    </tr>
                <?php }} ?>
            </tbody>
        </table>
    </div>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>