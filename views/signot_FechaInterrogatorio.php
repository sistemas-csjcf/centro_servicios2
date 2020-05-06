<?php
    require_once "../conectar.php";
    $link=conectarse();
    mysql_set_charset('utf8');

    $fecha  = ($_GET['fecha']);
    $user   = ($_GET['us']);

    $nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
    $fecha2 = date ( 'Y-m-j' , $nuevafecha );

    $sql=("SELECT anota.fecha_interrogatorio AS fecha, anota.id AS idAnotacion, pro.id AS id, pro.radicado AS radicado, us.empleado, juz.nombre AS juzgado
                    FROM signot_proceso_anotacion AS anota
                    INNER JOIN signot_proceso AS pro ON anota.idradicado = pro.id
                    INNER JOIN pa_juzgado AS juz ON pro.idjuzgadoorigen = juz.id
                    INNER JOIN pa_usuario AS us ON juz.idusuariojuzgadocargo = us.id
                    WHERE anota.fecha_interrogatorio BETWEEN '$fecha' AND '$fecha2' AND alerta_interrogatorio = '1'
                    AND us.id = '$user'");
    $rs=mysql_query($sql,$link);
    $num_res = mysql_num_rows($rs);
    while($row = mysql_fetch_array($rs)){
        $id = $row ['idAnotacion'];
?>
    <dialog id="light" class="modal" open><br><h3 style="font-size: 30px; color: red">Atención</h3><br><strong>Fecha de la diligencia Extraproceso</strong> <?php echo " ".$row['fecha']; ?><br><br><p style="font-size: 14px;"><?php echo "Radicado: ".$row['radicado'].", ".$row['juzgado']; ?></p><br><br><br><img src="views/images/fine.jpg" onclick="visto(<?php echo $row['idAnotacion'] ?>)" width="30" height="30" style="float: left; text-decoration:underline;cursor:pointer;" alt="Cerrar" title="Visto"/></dialog>

<?php  } 
    $query=("UPDATE signot_proceso_anotacion
        SET alerta_interrogatorio = '0'
        WHERE id = '$id'");
    mysql_query($query,$link);
    if ($num_res < 1){ 
 ?>
        <style type="text/css">
            /* base semi-transparente */
            .overlay{
                display: none;
            }
            .modal {
                display: none;
            }
        </style>
   
 <?php } ?>