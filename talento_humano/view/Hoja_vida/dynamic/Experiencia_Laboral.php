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
    //$sql="CALL `HV_Listar_Exp_Laboral` ('$hv_id')";
	
	//SE CAMBIA POR LA SENTECIA SQL COMPLETA, YA QUE NO ENCUENTRA LA VISTA HV_Listar_Exp_Laboral
	//CAMBIO REALIZADO POR INGENIERO JORGE ANDRES VALENCIA 10 DE FEBRERO 2020
	$sql="SELECT * FROM th_experiencia_laboral WHERE exp_id_hv = '$hv_id'";
    $res=mysql_query($sql,$link);
?>

<div class="panel panel-info">
    <div class="panel-heading">Experiencia Laboral</div>
    <div class="panel-body"><p></p></div>
    <table id="example5" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Empresa</th>
                <th>Cargo</th>
                <th>Ciudad</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Total Experiencia</th>
                <th title="Descargar Certificado/Constancia Laboral">Certificado</th>
            </tr>
        </thead>
        <tbody>
            <?php while($fila = mysql_fetch_array($res)){ ?>
                <tr>
                    <td><?php echo $fila['exp_empresa']; ?></td>
                    <td><?php echo $fila ['exp_cargo']; ?></td>
                    <td><?php echo $fila['municipio'].", ".$fila['departamento']; ?></td>
                    <td><?php echo $fila['exp_fecha_inicio']; ?></td>
                    <?php if($fila['exp_fecha_actualmente'] ==0 ){ ?>
                        <td><?php echo $fila['exp_fecha_fin']; ?></td>
                    <?php }else{ ?>
                        <td>Actualmente</td>
                    <?php } ?>
                    <td>
                        <?php
                            if($fila['anios'] >0){
                                echo $fila['anios']." año(s) "; 
                            }
                            if($fila['dias']<30){
                                $total_d = $fila['dias']+1;
                                if($total_d == 30 || $total_d ==31){
                                    echo " 1 mes";
                                }else{
                                    echo $total_d." día(s) ";
                                }
                            }
                            if($fila['dias']>30){
                                $dias_dif=$fila['dias']/365;
                                $meses_dif =$dias_dif-$fila['anios'];
                                $total_M = ((int)($meses_dif*12));
                                if($total_M>0){
                                    echo $total_M." mes(es)";
                                }
//                                $total_D=$fila['anios']*365;
//                                $dias_d = $fila['dias']-$total_D;
//                                while($dias_d>30){
//                                    $dias_d=$dias_d-30;
//                                    $cont++;
//                                }
//                                $cant_dias=$dias_d+1;
//                                echo $cont." mes(es) ".$cant_dias." día(s)";
                            }                            
                        ?>
                    </td>
                    <td><a href="#" class="btn btn-default" onclick="ver_pdf(3,'<?php echo $fila['exp_ruta_certificado']; ?>');return false;" target="_blank"><span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span></a></td>    
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