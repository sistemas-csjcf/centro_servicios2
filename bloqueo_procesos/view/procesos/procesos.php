<?php 
	session_start();
	$_SESSION['nombre'];
	$id_user = $_SESSION['idUsuario'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo         = new Proceso();
    $datosproceso   = $modelo->Listar_procesos_hoy();
    $datosproceso_2 = explode("//////",$datosproceso[0]);
    $cantr          = count($datosproceso_2);
    $datosproceso_3 = explode("---",$datosproceso[1]);
    //print_r($datosproceso_3);
    for($i=0; $i < $cantr - 1;$i++){
        $data[] =  "'".$datosproceso_2[$i]."'";
    }
    $data 				  = implode(",", $data);
    $us 				  = $_SESSION['idUsuario'];
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '19';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
    
    if(isset($id_user)){
?>
<input type="hidden" name="id_user" value="<?php echo $us ?>"id="id_user" />
<div class="well well-sm text-left">
    <div class="form-inline">
        <div class="form-group">
            <label for="fecha_fin">Radicado:</label>
            <input type="number" name="radicado" id="radicado" class="form-control"  placeholder="Ingrese Radicado" />
        </div>
        <div class="form-group">
            <label for="fInicial">Fecha Inicial:</label>
            <input readonly="" type="text" id="fecha" class="form-control datepicker" placeholder="Ingrese Fecha Inicial" />
        </div>&nbsp;
        <div class="form-group">
            <label for="fecha_fin">Fecha Final:</label>
            <input readonly="" type="text" name="fecha_fin" id="fecha_fin" class="form-control datepicker" placeholder="Ingrese Fecha Final" />
        </div>
        <a href="#" id="filtro" class="btn btn-primary glyphicon glyphicon-filter" onclick="filtro_proceso()">Filtrar</a>
        <a class="btn btn-default glyphicon glyphicon-repeat" onclick="location.reload();">Cancelar</a>
    </div>
</div>
<div id="load" align="center"></div>
<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Radicado</th>
            <th>
                <a href="?c=proceso&a=Bloquear_conjunto&arreglo_radicado=<?php echo $data ?>&dato_u=<?php echo $us; ?>" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-ban-circle icon-warning"></span> BLOQUEAR
                </a>
            </th>
            <?php if ( in_array($us,$usuariosa) ) { ?>
                <th>
                    <a href="?c=proceso&a=Desbloquear_conjunto&arreglo_radicado=<?php echo $data ?>&dato_u=<?php echo $us; ?>" class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-ok-circle icon-success"></span> DESBLOQUEAR
                    </a>
                </th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php $i= 0;  while($i < $cantr - 1){ ?>
            <tr>
                <td>
                    <?php 
                        echo $datosproceso_2[$i]; 
                        if ($datosproceso_3[$i]==1 ){
                            echo ' <i class="glyphicon glyphicon-flag" aria-hidden="true" style="color:red"></i>';
                        }
                    ?>
                </td>
                <input type="hidden" name="arreglo_radicado[]" value="<?php echo $datosproceso_2[$i]; ?>">
                <td>
                    <a href="?c=proceso&a=Ocultar&radicado=<?php echo $datosproceso_2[$i]; ?>&dato_u=<?php echo $us; ?>">
                       <?php if ($datosproceso_3[$i]==0 ){ ?>
                        Bloquear
                        <?php } ?>
                    </a>
                </td>
                <?php if ( in_array($us,$usuariosa) ) { ?>
                    <td><a href="?c=proceso&a=Ver&radicado=<?php echo $datosproceso_2[$i]; ?>&dato_u=<?php echo $us; ?>">
                    <?php if ($datosproceso_3[$i]==1 ){ ?>
                        Desbloquear
                    <?php } ?>
                    </a></td>
                <?php } ?>
            </tr>
        <?php $i= $i + 1; } ?>
    </tbody>
</table> 
<div id="filtro_consulta"></div>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>