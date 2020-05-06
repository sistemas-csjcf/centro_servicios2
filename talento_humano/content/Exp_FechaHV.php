<?php
    //JUAN ESTEBAN MÙNERA BETANCUR
    $fecha_ini  = $_REQUEST['fecha_ini'];
    $fecha_act  = $_REQUEST['fecha_act'];
    $fecha_fin  = $_REQUEST['fecha_fin'];
    if($fecha_act == 1){
        $checked = "checked='true'";
        $disabled='readonly=""';
        $value =1;
    }else{
        $checked = " ";
        $disabled=" value='$fecha_fin' ";
        $value=0;
    }
?>
<script type="text/javascript">
    function clic2(){
        if (document.getElementById('exp_actualmente_flag1').checked){
            //alert("Juan Esteban");
            document.getElementById("exp_fecha_fin1").required = false;
            document.getElementById("exp_fecha_fin1").readOnly = true;
            document.getElementById("exp_fecha_actualmente1").value=1;
        } else{
            //alert("ome");
            document.getElementById("exp_fecha_fin1").required = true;
            document.getElementById("exp_fecha_fin1").readOnly = false;
            document.getElementById("exp_fecha_actualmente1").value=0;
        }
    };

</script>
<div class="form-group row">
    <div class="col-xs-5">
        <label for="fecha_inicio">Fecha Inicio</label>
        <input type="date" class="form-control" id="exp_fecha_inicio" name="exp_fecha_inicio" value="<?php echo $fecha_ini; ?>" required="">
    </div>
    <div class="col-xs-1">
        <label for="fecha_actualmente">Actualmente</label>
        <input type="checkbox" id="exp_actualmente_flag1" name="exp_actualmente_flag" onchange="clic2()" <?php echo $checked; ?> class="form-control">
        <input type="hidden" id="exp_fecha_actualmente1" name="exp_fecha_actualmente" class="form-control" value="<?php echo $value ?>">
    </div>
    <div class="col-xs-1"></div>
    <div class="col-xs-5">
        <label for="fecha_fin">Fecha Fin</label>
        <input type="date" class="form-control" id="exp_fecha_fin1" <?php echo $disabled; ?> name="exp_fecha_fin" >
    </div>
</div>