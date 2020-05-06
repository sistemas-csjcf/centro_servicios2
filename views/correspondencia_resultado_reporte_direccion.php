<?php
    require_once "../conectar.php";
    $link=conectarse();
    mysql_set_charset('utf8');

    $inicio         = ($_GET['fechai']);
    $fin            = ($_GET['fechaf']);
    $despacho       = ($_GET['despacho']);
    $tipo_envio     = $_GET['tipo_envio'];
    if($tipo_envio == 0){
        $filtro_tipo_envio =" AND `id_tipo_envio` > 0";
    }else{
        $filtro_tipo_envio = " AND id_tipo_envio = '$tipo_envio'";
    }
    
    if($despacho == 0){
        $filtro_despacho = " ";
    }else{
        $filtro_despacho =" AND observaciones LIKE '%$despacho%' ";
    }
    //query
    $sql_con = mysql_query("SELECT cobertura, id_tipo_envio, COUNT(*) AS total
        FROM consolidado_472 
        WHERE  fecha_admision BETWEEN  '".$inicio."' AND '".$fin."' $filtro_despacho $filtro_tipo_envio
        GROUP BY id_tipo_envio, cobertura");
    
    
    while($row=mysql_fetch_array($sql_con)){
        if($row[0]== '"NACIONAL"' && $row[1] == 1){
            $ofi_nac = $row[2];
        }else if($row[0]== '"NACIONAL"' && $row[1] == 2){
            $paq_nac = $row[2];
        }else if($row[0]== '"NACIONAL"' && $row[1] == 3){
            $int_nac = $row[2];
        }else if($row[0]== '"NACIONAL"' && $row[1] == 4){
            $exp_nac = $row[2];
        }else if($row[0]== '"NACIONAL"' && $row[1] == 5){
            $enc_nac = $row[2];
        }else if($row[0]== '"URBANA"' && $row[1] == 1){
            $ofi_urb = $row[2];
        }else if($row[0]== '"URBANA"' && $row[1] == 2){
            $paq_urb = $row[2];
        }else if($row[0]== '"URBANA"' && $row[1] == 3){
            $int_urb = $row[2];
        }else if($row[0]== '"URBANA"' && $row[1] == 4){
            $exp_urb = $row[2];
        }else if($row[0]== '"URBANA"' && $row[1] == 5){
            $enc_urb = $row[2];
        }else if($row[0]== '"REGIONAL"' && $row[1] == 1){
            $ofi_reg = $row[2];
        }else if($row[0]== '"REGIONAL"' && $row[1] == 2){
            $paq_reg = $row[2];
        }else if($row[0]== '"REGIONAL"' && $row[1] == 3){
            $int_reg = $row[2];
        }else if($row[0]== '"REGIONAL"' && $row[1] == 4){
            $exp_reg = $row[2];
        }else if($row[0]== '"REGIONAL"' && $row[1] == 5){
            $enc_reg = $row[2];
        }else if($row[0]== '"TRAYECTO ESPECIAL"' && $row[1] == 1){
            $ofi_esp = $row[2];
        }else if($row[0]== '"TRAYECTO ESPECIAL"' && $row[1] == 2){
            $paq_esp = $row[2];
        }else if($row[0]== '"TRAYECTO ESPECIAL"' && $row[1] == 3){
            $int_esp = $row[2];
        }else if($row[0]== '"TRAYECTO ESPECIAL"' && $row[1] == 4){
            $exp_esp = $row[2];
        }else if($row[0]== '"TRAYECTO ESPECIAL"' && $row[1] == 5){
            $enc_esp = $row[2];
        }else if($row[0]== '"NACIONAL A"' && $row[1] == 1){
            $ofi_nacA = $row[2];
        }else if($row[0]== '"NACIONAL A"' && $row[1] == 2){
            $paq_nacA = $row[2];
        }else if($row[0]== '"NACIONAL A"' && $row[1] == 3){
            $int_nacA = $row[2];
        }else if($row[0]== '"NACIONAL A"' && $row[1] == 4){
            $exp_nacA = $row[2];
        }else if($row[0]== '"NACIONAL A"' && $row[1] == 5){
            $enc_nacA = $row[2];
        }
        else{
            $error = $row[2];
        }
    }
    $total_oficios      = $ofi_nac+$ofi_urb+$ofi_reg+$ofi_esp+$ofi_nacA;
    $total_paqueteria   = $paq_nac+$paq_urb+$paq_reg+$paq_esp+$paq_nacA;   
    $total_express      = $exp_nac+$exp_urb+$exp_reg+$exp_esp+$exp_nacA;
    $total_encomienda   = $enc_nac+$enc_urb+$enc_reg+$enc_esp+$enc_nacA;
    $total_interna      = $int_nac+$int_urb+$int_reg+$int_esp+$int_nacA;

    // VALIDAR CAMPOS VACIOS
    if($ofi_nacA >0){
        $ofi_nac+=$ofi_nacA;
    }
    if($exp_nacA >0){
        $exp_nac+=$exp_nacA;
    }
    if($enc_nacA >0){
        $enc_nac+=$enc_nacA;
    }
    if($paq_nacA>0){
        $paq_nac+=$paq_nacA;
    }
       
?>
    <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_editar1">								
        <thead> 
            <tr>
                <th bgcolor="#CDE3F9" colspan="6">
                    <center><div id="titulo_frm">REPORTE </div></center>
<!--                    <p style="text-align: right;">Total Envios <?php // echo $cantidad; ?></p>-->
                </th>
            </tr>
            <tr> 
                <th>COBERTURA</th>
                <th>Cuenta de OFICIOS</th>
                <th>Cuenta de PAQUETERIA</th> 
                <th>Cuenta de POSTEXPRESS</th>
                <th>Cuenta de ENCOMIENDA NACIONAL</th>
                <th>Cuenta de INTERNACIONAL</th>
            </tr> 
        </thead> 
        <tbody>
            <tr>
                <td>NACIONAL</td>
                <td><?php echo $ofi_nac; ?></td>
                <td><?php echo $paq_nac; ?></td>
                <td><?php echo $exp_nac; ?></td>
                <td><?php echo $enc_nac; ?></td>
                <td><?php echo $int_nac; ?></td>
            </tr>
            <tr>
                <td>REGIONAL</td>
                <td><?php echo $ofi_reg; ?></td>
                <td><?php echo $paq_reg; ?></td>
                <td><?php echo $exp_reg; ?></td>
                <td><?php echo $enc_reg; ?></td>
                <td><?php echo $int_reg; ?></td>
            </tr>
            
            <tr>
                <td>URBANA</td>
                <td><?php echo $ofi_urb; ?></td>
                <td><?php echo $paq_urb; ?></td>
                <td><?php echo $exp_urb; ?></td>
                <td><?php echo $enc_urb; ?></td>
                <td><?php echo $int_urb; ?></td>
            </tr>  
            <tr>
                <td>TRAYECTO ESPECIAL</td>
                <td><?php echo $ofi_esp; ?></td>
                <td><?php echo $paq_esp; ?></td>
                <td><?php echo $exp_esp; ?></td>
                <td><?php echo $enc_esp; ?></td>
                <td><?php echo $int_esp; ?></td>
            </tr>
            <tr>
                <td><strong>TOTAL GENERAL</strong></td>
                <td><strong><?php echo $total_oficios; ?></strong></td>
                <td><strong><?php echo $total_paqueteria; ?></strong></td>
                <td><strong><?php echo $total_express; ?></strong></td>
                <td><strong><?php echo $total_encomienda; ?></strong></td>
                <td><strong><?php echo $total_interna; ?></strong></td>
            </tr>
        </tbody>
    </table>
    <br><a href="?controller=correspondencia&action=Generar_Excel_Reporte_direccion&fechai=<?php echo $inicio; ?>&fechaf=<?php echo $fin; ?>&despacho=<?php echo $despacho; ?>&tipo_envio=<?php echo $tipo_envio; ?>" style="text-decoration: none;"><span class="icon icon-file-excel" style="font-size: 40px;"></span></a>