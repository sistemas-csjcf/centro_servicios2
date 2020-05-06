<?php
    require_once "../../../core/conexion.php";
    $link=conectarse();
    $id = $_REQUEST['id'];
    
    //echo "dsada  ".$id;
    $rs="SELECT * FROM th_permiso_horario WHERE per_hor_id_permisoEstudio = '$id'";
    $res1=mysql_query($rs,$link);
?>

<div class="panel panel-info">
    <h4><?php echo " Fechas permiso desde: ".$fechaF = $_REQUEST['fechaI']." - ".$_REQUEST['fechaF']; ?></h4>
    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr style="background-color: #4682B4; color: white;">
                <th>DÍA</th>
                <th>HORA INICIO</th>
                <th>HORA FIN</th>
                <th>HORA INICIO</th>
                <th>HORA FIN</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysql_fetch_array($res1)){ ?>
                <tr>
                    <td><?php echo $row['per_hor_dia']; ?></td>
                    <td><?php echo $row['per_hor_hora_inicio']; ?></td>
                    <td><?php echo $row['per_hor_hora_fin']; ?></td>
                    <td><?php echo $row['per_hor_hora_inicio1']; ?></td>
                    <td><?php echo $row['per_hor_hora_fin1']; ?></td>
                </tr>
            <?php } ?>  
        </tbody>
    </table>
</div><br/>
<script>
    $(document).ready(function() {
        $('#example5').DataTable();
        $('#example_historial').DataTable( {
            "order": [[ 0, "desc" ]]
        });
    } );
    $('.selectpicker').selectpicker({
        style: 'btn-info',
        size: 4
    });
</script> 