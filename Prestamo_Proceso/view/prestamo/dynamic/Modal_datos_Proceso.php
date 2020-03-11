<?php
//JUAN ESTEBAN MÙNERA BETANCUR
    require_once('../core/conexion.php');
    require_once '../model/mejora_continua_model.php';
    $link=conectarse();
    $id = $_REQUEST['id'];
    $modelo      = New Mejora_C();
    $listado = $modelo->Listar_proceso($id);
    while($row = $listado->fetch()){
        $fecha  = $row['pre_fecha'];
        $user   = $row['usuario'];
        $fecha1 = $row['pre_fecha1_ac_cs'];
        $user1   = $row['usuario1'];
        $fecha2 = $row['pre_fecha2_cs_juz'];
        $user2   = $row['usuario2'];
        $fecha3 = $row['pre_fecha3_juz_cs'];
        $user3   = $row['usuario3'];
        $fecha4 = $row['pre_fecha4_cs_ac'];
        $user4   = $row['usuario4'];
    }
?>
<div class="form-group">
    Fecha Entrega Archivo Central - Centro de Servicios <input type="text" readonly="" class="form-control" name="fecha2" id="fecha2" value="<?php echo $fecha1; ?>" placeholder="Fecha"/>
</div>