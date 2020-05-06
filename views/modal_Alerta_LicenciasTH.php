<?php
    require_once "../conectar.php";
    $link=conectarse();
    mysql_set_charset('utf8');
    date_default_timezone_set('America/Bogota'); 
    $fecha=date('Y-m-d'); 
    $nuevafecha = strtotime ( '+8 day' , strtotime ( $fecha ) ) ;
    $fecha2 = date ( 'Y-m-j' , $nuevafecha );
    $id_user =  ($_GET['us']);
    $result1=mysql_query("select * from th_planta_personal WHERE pla_flag_alerta = 1 AND pla_fecha_fin BETWEEN '$fecha' AND '$fecha2' AND pla_estado = 1 ",$link);
    $numero_filas = mysql_num_rows($result1);
    if($numero_filas >0){
        if($id_user == 87){
?>
    <dialog id="ventana" class="modal_alertaLicenciasTH" open onmouseover="closeModal()">
        <h6 style="font-size: 18px; color: red">(Talento Humano) ALERTA VENCIMIENTO LICENCIAS</h6>
        <br><strong style="color: white">Atenciòn!!! tiene <?php echo $numero_filas; ?> pendiente(s) por Vencerse</strong>
    </dialog>
<?php }}else{ ?>
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