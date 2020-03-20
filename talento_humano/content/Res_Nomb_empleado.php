<?php
    //JUAN ESTEBAN MÙNERA BETANCUR
    require_once('../core/conexion.php');
    $link=conectarse();
    $id = $_GET['id_empleado'];
    $sql = "SELECT * FROM pa_usuario WHERE bandera_hv=1 ORDER BY empleado ";
    $res = mysql_query($sql,$link);
?>
<select name="id_usuario" class="form-control " data-validacion-tipo="requerido" disabled="">
    <?php while($fila = mysql_fetch_array($res) ){ ?>
        <?php if($id == $fila['id']){ ?>
            <option selected value="<?php echo $fila['id']; ?>" ><?php echo $fila['empleado']; ?></option>;
        <?php }else{ ?>
            <option value="<?php echo $fila['id']; ?>" ><?php echo $fila['empleado']; ?> </option>;
        <?php } ?>
    <?php } ?>
</select>
