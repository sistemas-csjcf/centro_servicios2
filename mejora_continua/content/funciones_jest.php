<?php
    //JUAN ESTEBAN MÙNERA BETANCUR
    require_once('../core/conexion.php');
    $link=conectarse();
    $id		= trim($_GET['id']);
    $flag	= trim($_GET['flag']);
    //echo $id;
    if($flag == 1){		
        $sql = "SELECT * FROM `pa_municipio` WHERE `iddepartamento` = '$id' ORDER BY nombre";
        $res = mysql_query($sql,$link);
        echo '<option value="">Seleccione Municipio</option>';
        while($fila = mysql_fetch_array($res)){
            if($flag == 1){		
                echo ('<option value="'.trim($fila['id']).'">'.$fila['nombre'].'</option>');
            }	
        }
    }
    mysql_close($link);
?>