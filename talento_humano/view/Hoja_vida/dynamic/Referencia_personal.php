<?php
    require_once "../../../core/conexion.php";
    $link=conectarse();
    $id = $_REQUEST['idUS'];
    //echo "dsada  ".$id;
    $rs="SELECT * FROM th_personas WHERE per_id_usuario = '$id'";
    $res1=mysql_query($rs,$link);
    while ($row = mysql_fetch_array($res1)) {
        $user = $row[0];
    }
    //echo " us  ".$user;
    $consulta=("SELECT `hv_id`, `hv_id_persona`FROM th_hoja_vida WHERE `hv_id_persona` = '$user'");
    $resulta1=mysql_query($consulta,$link);
    while ($row = mysql_fetch_array($resulta1)) {
        $hv_id = $row[0];
    }
    //echo " hvid  ".$hv_id;
    $sql="SELECT * FROM th_referencias_personales WHERE ref_id_hv = '$hv_id'";
    $res=mysql_query($sql,$link);
?>

<div class="panel panel-info">
    <div class="panel-heading">Referencias</div>
    <div class="panel-body"><p></p></div>
    <table id="example4" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th title="Código Referencia">ID</th>
                <th>Nombre</th>
                <th>Cargo</th>
                <th>Empresa</th>
                <th>Teléfono</th>
            </tr>
        </thead>
        <tbody>
            <?php while($fila = mysql_fetch_array($res)){ ?>
                <tr>
                    <td id="exp_empresa"><?php echo $fila['ref_id']; ?></td>
                    <td><?php echo $fila ['ref_nombre']; ?></td>
                    <td><?php echo $fila['ref_cargo']; ?></td>
                    <td><?php echo $fila['ref_empresa']; ?></td>
                    <td><?php echo $fila['ref_telefono']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div><br/>
<script>
    $(document).ready(function() {
        $('#example4').DataTable();
        $('#example_historial').DataTable( {
            "order": [[ 0, "desc" ]]
        });
    } );
    $('.selectpicker').selectpicker({
        style: 'btn-info',
        size: 4
    });
</script> 