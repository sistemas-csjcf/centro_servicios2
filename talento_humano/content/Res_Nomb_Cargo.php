<?php
    //JUAN ESTEBAN MÙNERA BETANCUR
    require_once('../core/conexion.php');
    $link=conectarse();
    $id = $_GET['id_cargo'];
    $sql = "SELECT * FROM th_cargos WHERE car_flag=1 ORDER BY car_titulo ";
    $res = mysql_query($sql,$link);
?>
<select name="id_cargo" class="form-control " data-validacion-tipo="requerido" >
    <?php while($fila = mysql_fetch_array($res) ){ ?>
        <?php if($id == $fila['car_id']){ ?>
            <option selected value="<?php echo $fila['car_id']; ?>" ><?php echo $fila['car_titulo']; ?></option>;
        <?php }else{ ?>
            <option value="<?php echo $fila['car_id']; ?>" ><?php echo $fila['car_titulo']; ?> </option>;
        <?php } ?>
    <?php } ?>
</select>
