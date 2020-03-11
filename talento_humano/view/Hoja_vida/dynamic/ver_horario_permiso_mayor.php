<?php
    require_once "../../../core/conexion.php";
    $link=conectarse();
    $id = $_REQUEST['id'];
    
    //echo "dsada  ".$id;
    $rs = "SELECT id, id_permiso_mayor, fecha, hora_inicio, hora_final, 
            CASE 
                WHEN (hora_inicio >= '07:00' AND hora_inicio <= '12:00') AND (hora_final >= '14:00' AND hora_final <= '23:00') 
                    THEN TIMEDIFF( TIMEDIFF(hora_final, hora_inicio), '2:00')
                    ELSE TIMEDIFF(hora_final, hora_inicio) 
                END AS duracion 
            FROM empleado_permiso_mayor_fecha WHERE id_permiso_mayor = '$id'";
    $res1 = mysql_query($rs, $link);
?>

<div class="panel panel-info">
    <!-- <h4><?php echo " Fechas permiso desde: ".$fechaF = $_REQUEST['fechaI']." - ".$_REQUEST['fechaF']; ?></h4> -->
    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr style="background-color: #4682B4; color: white;">
                <th>FECHA</th>
                <th>HORA INICIO</th>
                <th>HORA FIN</th>
                <th>DURACIÓN</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysql_fetch_array($res1)){ ?>
                <tr>
                    <td><?php echo $row['fecha']; ?></td>
                    <td><?php echo $row['hora_inicio']; ?></td>
                    <td><?php echo $row['hora_final']; ?></td>
                    <td><?php echo $row['duracion']; ?></td>
                </tr>
            <?php } ?>  
        </tbody>
    </table>
</div><br/>
<script>
    $(document).ready(function() {
        $('#example5').DataTable();
        //$('#example_historial').DataTable( {
            "order": [[ 0, "desc" ]]
        //});
    } );
    $('.selectpicker').selectpicker({
        style: 'btn-info',
        size: 4
    });
</script> 