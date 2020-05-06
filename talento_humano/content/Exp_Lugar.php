<?php
    //JUAN ESTEBAN MÙNERA BETANCUR
    require_once('../core/conexion.php');
    require_once '../model/hojaVida_model.php';
    $id_departamento = $_REQUEST['departamento'];
    $id_municipio = $_REQUEST['municipio'];
    $link=conectarse();
    $modelo             = New HojaVida();
    $lista_departamento = $modelo->get_Departamento();
    $lista_municipio    = $modelo->Get_Municipio_Asociado($id_departamento);
?>
<div class="form-group row">
    <div class="col-xs-6">
        <label for="cargo">Departamento</label>
        <select name="exp_id_departamento" id="exp_id_departamento1" class="form-control " data-validacion-tipo="requerido">
            <?php while($row = $lista_departamento->fetch()){ ?>
                <?php if($id_departamento == $row['id']){ ?>
                    <option value="<?php echo $row['id']; ?>" selected=""><?php echo $row['nombre']; ?></option>
                <?php }else{ ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
    <div class="col-xs-6">
        <label for="cargo">Municipio</label>
        <select name="exp_id_municipio" id="exp_id_municipio1" class="form-control" data-validacion-tipo="requerido">
            <?php while($row = $lista_municipio->fetch()){ ?>
                <?php if($id_municipio == $row['id']){ ?>
                    <option value="<?php echo $row['id']; ?>" selected=""><?php echo $row['nombre']; ?></option>
                <?php }else{ ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
            $("#exp_id_departamento1").change(function(event){        
                var id    = $("#exp_id_departamento1").find(':selected').val();
                //alert(id);
                $("#exp_id_municipio1").load('content/funciones_jest.php?id='+id+"&flag="+1);		
            });
        });
</script>