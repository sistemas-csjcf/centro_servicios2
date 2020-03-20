<?php
    //JUAN ESTEBAN MÙNERA BETANCUR
    require_once('../core/conexion.php');
    $link=conectarse();
    $id = $_GET['nivel'];
    $sql = "SELECT * FROM `th_nivel_educacion` ";
    $res = mysql_query($sql,$link);
?>
<select name="id_nivel" class="form-control " data-validacion-tipo="requerido">
    <?php while($fila = mysql_fetch_array($res) ){ ?>
        <?php if($id == $fila['niv_id']){ ?>
            <option selected value="<?php echo $fila['niv_id']; ?>" ><?php echo $fila['niv_titulo']; ?></option>;
        <?php }else{ ?>
            <option value="<?php echo $fila['niv_id']; ?>" ><?php echo $fila['niv_titulo']; ?> </option>;
        <?php } ?>
    <?php } ?>
</select>
