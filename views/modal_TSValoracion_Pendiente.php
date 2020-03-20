<?php
    require_once "../conectar .php";
    $link=conectars e();
    mysql_set_charset('utf8');
    
    $id_user = ($_GET['us']);
    $result1=mysql_query("CALL Listar_Informe_Valoracion_SinEnviarD ('$id_user') ",$link);
    $numero_filas = mysql_num_rows($result1);
    if($numero_filas >0){
?>
    <dialog id="ventana" class="modal_valoracionP" open onmouseover="closeModal()">
        <h6 style="font-size: 18px; color: red">(Visita Social) Valoraciones Pendientes</h6>
        <br><strong style="color: white">Atención!!! tiene <?php echo $numero_filas; ?> Valoracion(es) por realizar</strong>
    </dialog>
<?php }else{ ?>
    <style type="text/css">
        /* base semi-transparente */
        .overlay{
            display: none;
        }
        .modal_valoracionP {
            display: none;
        }
    </style>
 <?php } ?>
    
 