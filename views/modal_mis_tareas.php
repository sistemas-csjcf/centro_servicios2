<?php
    require_once "../conectar.php";
    $link=conectarse();
    mysql_set_charset('utf8');
    
    $id_user = ($_GET['us']);
    $result1=mysql_query("SELECT *
                FROM `mc_tareas`
                WHERE `tar_id_user_responsable` = '$id_user' AND tar_estado=0; ",$link);
    $numero_filas = mysql_num_rows($result1);
    if($numero_filas >0){
?>
    <dialog id="ventana" class="modal_mis_tareas" open onmouseover="closeModal()">
        <h6 style="font-size: 18px; color: red">(SEGME) Tareas Pendientes</h6>
        <br><strong style="color: white">Atención!!! tiene <?php echo $numero_filas; ?> Tarea(s) por gestionar</strong>
    </dialog>
<?php }else{ ?>
    <style type="text/css">
        /* base semi-transparente */
        .overlay{
            display: none;
        }
        .modal1 {
            display: none;
        }
    </style>
 <?php } ?>
    
 