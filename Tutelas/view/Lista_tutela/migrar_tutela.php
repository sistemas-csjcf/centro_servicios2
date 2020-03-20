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
    
    $datosproceso= $modelo->Listar();
    $datos_radi  = explode("//////",$datosproceso[0]);
    $datos_fecha = explode("---",$datosproceso[1]);
    $datos_hora  = explode("***",$datosproceso[2]);
    $datos_pone  = explode("+++",$datosproceso[3]);
    $datos_juzg  = explode("****",$datosproceso[4]);
    //print_r($datos_juzg);
    $arreglo_filtro = array_filter($datos_radi);
    $cantidad_r  =  count($arreglo_filtro);
    //print_r($datos_radi);
    $matriz =  array ($datos_radi, $datos_pone, $datos_fecha, $datos_hora);
    //print_r($matriz);
	$indice= $matriz[0][0]." ";
    //print_r($arreglo_filtro);
    $datos_tutelas_migradas = $modelo->get_lista_reparto_tutelaCS();
    while($r = $datos_tutelas_migradas->fetch()){
        $tutelas_migradas[] = $r[0];
    }
    //print_r($tutelas_migradas);
    date_default_timezone_set('America/Bogota'); 
    $fecha  = date('Y-m-d');
    if(isset($id_user)){
        if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
            if($_REQUEST['msg_di_tr'] ==1){
                $texto  =" Correcto. ";
                $tipo   = "success";
                $icono  = "checkmark";
            }else if($_REQUEST['msg_di_tr'] ==2){
                $texto  =" Error. ";
                $tipo   = "danger";
                $icono  = "cross";
            }
			else if($_REQUEST['msg_di_tr'] ==3){
                $texto  =" PROCESO YA FUE MIGRADO. ";
                $tipo   = "success";
                $icono  = "checkmark";	
            }
			else if($_REQUEST['msg_di_tr'] == 99){
                $texto  =" prueba. ";
                $tipo   = "warning";
                $icono  = "warning";
            }else{
                $texto  = "";
                $tipo   = "";
                $icono  = "";
            }
            if($_SESSION['idperfil'] ==22){
?>
                <div class="alert alert-danger"><h4 style="text-align: center; color: red"><i class="icon icon-warning" width="40px"></i><strong> Importante! </strong> No tienes privilegios de usuario para acceder a esta opción <i class="icon icon-cross" width="40px"></i></h4><code>Juan Esteban Mùnera Betancur</code></div>
            <?php }else{ ?>
    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                $("#content").fadeOut(1500); 
            },3000);
        });
    </script>
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
        <button class="btn btn-info" id="btn_guardar" onclick="consultar_Tutelas_migrar();"><span class="glyphicon glyphicon-search"></span> Consultar</button>
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
        <?php 	
			if($_REQUEST['msg_di_tr'] !=""){ //esteban M.
				echo $mensaje_alerta = $modelo->displayAlert($texto,$tipo,$icono); 
			}
		?>
        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #4682B4; color: white;">
                    <th>Radicado</th>
                    <th>Juzgado</th>
                    <th style="width:20px;">Fecha</th>
                    <th style="width:20px;">Hora</th>
                    <th>Migrar</th>
                </tr>
            </thead>
            <tbody>
				<?php if(in_array($indice,$tutelas_migradas)){ }else{ ?>
					<tr>
						<td><?php echo $matriz[0][0]; ?></td>
						<td><?php echo $matriz[1][0]; ?></td>
						<td><?php echo $matriz[2][0]; ?></td>
						<td><?php echo $matriz[3][0]; ?></td>
						<td><a href="?c=tutela&a=Migrar&id_Rd=<?php echo $matriz[0][0]; ?>" style="text-decoration: none;" title="Migrar Tutela"><i class="icon-download" style="font-size: 20px; color: #00cd66"></i></a></td>    
					</tr>
				<?php } ?>
                <?php for($i=0;$i<$cantidad_r;$i++){ ?>
                    <?php if(in_array($matriz[0][$i],$tutelas_migradas)){ }else{ ?>
                        <tr>
                            <td><?php echo $matriz[0][$i]; ?></td>
                            <td><?php echo $matriz[1][$i]; ?></td>
                            <td><?php echo $matriz[2][$i]; ?></td>
                            <td><?php echo $matriz[3][$i]; ?></td>
                            <td><a href="?c=tutela&a=Migrar&id_Rd=<?php echo $matriz[0][$i]; ?>" style="text-decoration: none;" title="Migrar Tutela"><i class="icon-download" style="font-size: 20px; color: #00cd66"></i></a></td>    
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php } }else{ ?> 
        <div class="alert alert-danger"><h4 style="text-align: center; color: red"><i class="icon icon-warning" width="40px"></i><strong> Importante! </strong> No tienes privilegios de usuario para acceder a esta opción <i class="icon icon-cross" width="40px"></i></h4><code>Juan Esteban Mùnera Betancur</code></div>
    <?php } ?> 
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>