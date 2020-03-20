<?php
    //JUAN ESTEBAN MÙNERA BETANCUR
    require_once '../model/hojaVida_model.php';
    $modelo         = New HojaVida();
    $lista_areas_cs = $modelo->get_Areas_cs();

    $rama_flag  = $_REQUEST['rama_flag'];
    $empresa    = $_REQUEST['empresa'];
    $cs_flag    = $_REQUEST['cs_flag'];
    $id_areaCS  = $_REQUEST['id_areaCS'];
    
    if($rama_flag == 1){
        $checked = "checked='true'";
        $disabled='readonly=""';
        $value =1;
    }else{
        $checked = " ";
        $disabled=" ";
        $value=0;
    }
    if($cs_flag == 1){
        $check_cs = "checked='true'";
        $required_cs="required='true'";
        $disabled_cs=" ";
        $valor_cs =1;
    }else{
        $check_cs = " ";
        $required_cs=" ";
        $disabled_cs="disabled='true'";
        $valor_cs=0;
    }
?>
<script type="text/javascript">
    function clicRama2(){
        if (document.getElementById('exp_rama_flag1').checked){
            //alert("Juan Esteban");
            document.getElementById("empresa").value = "Rama Judicial";
            document.getElementById("empresa").readOnly = true;
            document.getElementById("exp_rama1").value=1;
        } else{
            //alert("ome");
            document.getElementById("empresa").value = "";
            document.getElementById("empresa").readOnly = false;
            document.getElementById("exp_rama1").value=0;
        }
    };
    function clic_CS2(){
        if (document.getElementById('exp_CS_flag1').checked){
           // document.getElementById("list_area_cs").style.display = "block";
            document.getElementById("exp_id_area1").required = true;
            document.getElementById("exp_id_area1").disabled = false;
            document.getElementById("exp_CS1").value=1;
        }else{
            //document.getElementById("list_area_cs").style.display = "none";
            document.getElementById("exp_id_area1").required = false;
            document.getElementById("exp_id_area1").disabled = true;
            document.getElementById("exp_CS1").value=0;
        }  
    };
</script>
<div class="form-group row">
    <div class="col-xs-4">
        <div class="form-check">
            <label class="form-check-label" for="exampleCheck1">¿Experiencia Rama Judicial?</label>
            <input type="checkbox" class="form-check-input" id="exp_rama_flag1" name="exp_rama_flag" onchange="clicRama2()" <?php echo $checked; ?> >
            <input type="hidden" id="exp_rama1" name="exp_rama" class="form-control" value="<?php echo $value; ?>">
        </div>
    </div>
    <div class="col-xs-3">
        <div class="form-check">
            <label class="form-check-label" for="exampleCheck1">¿Centro Servicios?</label>
            <input type="checkbox" class="form-check-input" id="exp_CS_flag1" name="exp_CS_flag" onchange="clic_CS2()" <?php echo $check_cs; ?> >
            <input type="hidden" id="exp_CS1" name="exp_CS" class="form-control" value="<?php echo $valor_cs; ?>">
        </div>
    </div>
    <div class="col-xs-5" >
        <label for="area">Área</label>
        <select name="exp_id_area" id="exp_id_area1" class="form-control" <?php echo $required_cs; echo " ".$disabled_cs; ?> >
            <option >Seleccione Área</option>
            <?php while($row = $lista_areas_cs->fetch()){ ?>
                <?php if($id_areaCS == $row['are_id']){ ?>
                    <option selected value="<?php echo $row['are_id']; ?>"><?php echo $row['are_titulo']; ?></option>
                <?php }else{ ?>
                    <option value="<?php echo $row['are_id']; ?>"><?php echo $row['are_titulo']; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="empresa">Empresa</label>
    <input type="text" class="form-control" <?php echo $disabled; ?> id="empresa" name="exp_empresa" value="<?php echo $empresa; ?>" placeholder="Empresa" required="">
</div>