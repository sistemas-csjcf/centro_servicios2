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
    //$sql="CALL `HV_Listar_Estudios` ('$hv_id')";
	
	//SE CAMBIA POR LA SENTECIA SQL COMPLETA, YA QUE NO ENCUENTRA LA VISTA HV_Listar_Estudios
	//CAMBIO REALIZADO POR INGENIERO JORGE ANDRES VALENCIA 10 DE FEBRERO 2020
	$sql="SELECT * FROM th_formacion_profesional WHERE for_pro_id_HV ='$hv_id'";
    $res=mysql_query($sql,$link);
?>
<div class="panel panel-info">
    <div class="panel-heading">Formación Académica</div>
    <div class="panel-body"><p></p></div>
    <table id="example2" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th title="Código Identificación">ID</th>
                <th>Nivel Educación</th>
                <th>Institución</th>
                <th>Título</th>
                <th>Fecha</th>
                <th>Certificado</th>
            </tr>
        </thead>
        <tbody>
            <?php while($fila = mysql_fetch_array($res)){ ?>
                <tr>
                    <td><?php echo $fila ['for_pro_id']; ?></td>
                    <td><?php echo $fila ['niv_titulo']; ?></td>
                    <td><?php echo $fila ['for_pro_institucion']; ?></td>
                    <td><?php echo $fila ['for_pro_titulo']; ?></td>
                    <td><?php echo $fila ['for_pro_fecha_inicio']." - ".$fila['for_pro_fecha_fin']; ?></td>
                    <td><a href="#" class="btn btn-default" onclick="ver_pdf(2,'<?php echo $fila['for_pro_ruta_certificado']; ?>');return false;" target="_blank"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div><br/>
<script>
    $(document).ready(function() {
        $('#example2').DataTable();
        $('#example_historial').DataTable( {
            "order": [[ 0, "desc" ]]
        });
    } );
    $('.selectpicker').selectpicker({
        style: 'btn-info',
        size: 4
    });
</script>