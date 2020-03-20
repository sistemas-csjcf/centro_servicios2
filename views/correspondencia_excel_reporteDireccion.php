<?php 
    require_once "conectar.php";
    $link=conectarse();
    mysql_set_charset('utf8');

    $inicio         = ($_REQUEST['fechai']);
    $fin            = ($_REQUEST['fechaf']);
    $despacho       = ($_REQUEST['despacho']);
    $tipo_envio     = ($_REQUEST['tipo_envio']);
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
    setlocale(LC_TIME, "Spanish");
    $yearI = strftime('%Y', strtotime($inicio));
    $mesI = strftime('%B', strtotime($inicio));
    $mesF = strftime('%B', strtotime($fin));
    $yearF = strftime('%Y', strtotime($fin));
    //----año------
    if($yearI == $yearF){
        $anio = $yearI;
    }else{
        $anio = $yearI.", ".$yearF;
    }
    //----- mes
    if($mesI == $mesF){
        $mes = $mesI;
    }else{
        $mes = $mesI." - ".$mesF;
    }
    //query
    $sql_con = mysql_query("SELECT cobertura, id_tipo_envio, COUNT(*) AS total
        FROM consolidado_472 
        WHERE  fecha_admision BETWEEN  '".$inicio."' AND '".$fin."' $filtro_despacho $filtro_tipo_envio
        GROUP BY id_tipo_envio, cobertura");
    
     while($row=mysql_fetch_array($sql_con)){
        if($row[1] == 1){
            //-------OFICIO
            $franquisia_postal += $row[2];
        }else if($row[0]== '"NACIONAL A"' && $row[1] == 1){
            $ofi_nacA = $row[2];
        }
        
        // ---------- POST-EXPRESS ---------
        if($row[0]== '"NACIONAL"' && $row[1] == 4){
            $exp_nac = $row[2];
        }else if($row[0]== '"URBANA"' && $row[1] == 4){
            $exp_urb = $row[2];
        }else if($row[0]== '"REGIONAL"' && $row[1] == 4){
            $exp_reg = $row[2];
        }else if($row[0]== '"TRAYECTO ESPECIAL"' && $row[1] == 4){
            $exp_esp = $row[2];
        }else if($row[0]== '"NACIONAL A"' && $row[1] == 4){
            $exp_nacA = $row[2];
        }
        // ----------- ENCOMIENDA NACIONAL
        else if($row[0]== '"NACIONAL"' && $row[1] == 5){
            $enc_nac = $row[2];
        }else if($row[0]== '"URBANA"' && $row[1] == 5){
            $enc_urb = $row[2];
        }else if($row[0]== '"REGIONAL"' && $row[1] == 5){
            $enc_reg = $row[2];
        }else if($row[0]== '"TRAYECTO ESPECIAL"' && $row[1] == 5){
            $enc_esp = $row[2];
        }else if($row[0]== '"NACIONAL A"' && $row[1] == 5){
            $enc_nacA = $row[2];
        }
        // ------------ PAQUETERIA
        else if($row[0]== '"NACIONAL"' && $row[1] == 2){
            $paq_nac = $row[2];
        }else if($row[0]== '"URBANA"' && $row[1] == 2){
            $paq_urb = $row[2];
        }else if($row[0]== '"REGIONAL"' && $row[1] == 2){
            $paq_reg = $row[2];
        }else if($row[0]== '"TRAYECTO ESPECIAL"' && $row[1] == 2){
            $paq_esp = $row[2];
        }else if($row[0]== '"NACIONAL A"' && $row[1] == 2){
            $paq_nacA = $row[2];
        }
    }
    // VALIDAR CAMPOS VACIOS
    if($ofi_nacA >0){
        $franquisia_postal+=$ofi_nacA;
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
    
    $sql_data_of = mysql_query("SELECT * FROM pa_datos_oficina");
    while ($rs = mysql_fetch_array($sql_data_of)) {
        $nombre_coordinadora = $rs['coordinadora'];
    }
?>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <table border="0" style="width: 57%">
            <tr>
                <td colspan="4" align="center"><strong>Rama Judicial del Poder Publico</strong></td>
            </tr>
            <tr>
                <td colspan="4" align="center"><strong>Consejo Superior de la Judicatura</strong></td>
            </tr>
            <tr>
                <td colspan="4" align="center"><strong>Dirección Ejecutiva de Administración Judicial</strong></td>
            </tr>
            <tr>
                <td colspan="4" align="center"><strong>Seccional Caldas</strong></td>
            </tr>
            <tr>
                <td colspan="4" align="center"><strong>REPORTE MENSUAL 4-72</strong></td>
            </tr>
        </table>
        <p><strong>MES REPORTADO: </strong><a style="color: red; text-decoration: none"><?php echo strtoupper($mes); ?></a><strong style="padding: 50px"></strong> <strong> AÑO:</strong> <a style="color: red; text-decoration: none"><?php echo $anio; ?></a></p>
        <strong>MUNICIPIO:</strong> <a style="color: red; text-decoration: none">MANIZALES</a>
        <p><strong>DESPACHO JUDICIAL:</strong> <a style="color: red; text-decoration: none">CENTRO DE SERVICIOS JUDICIALES CIVIL- FAMILIA, ENCARGADO DE LA CORRESPONDENCIA DE:</a></p>
        <a style="color: red; text-decoration: none"><p>JUZGADOS 1 , 2, 3, 4, 5 Y 6 CIVILES CIRCUITO</p>
        <p>JUZGADOS 1, 2, 3, 4, 5, 6 Y 7 DE FAMILIA</p>
        <p>JUZGADOS 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 Y 12 CIVILES MUNICIPALES</p></a>
        <strong>NOMBRE DEL RESPONSABLE DEL DESPACHO:</strong> <a style="color: red; text-decoration: none"><?php echo $nombre_coordinadora; ?></a>
        <p><strong>CARGO DEL RESPONSABLE DEL DESPACHO:</strong> <a style="color: red; text-decoration: none">COORDINADORA</a></p>
        <table border="1">
            <thead>
                <tr style="background-color: darkgray; color: white;">
                    <th colspan="3">SERVICIO</th>
                    <th>NUMERO TOTAL DE ENVIOS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="2" colspan="2"><p style="text-align: center"><strong>FRANQUICIA</strong></p></td>
                    <td>FRANQUICIA POSTAL</td>
                    <td><p style="color: red;"><?php echo $franquisia_postal; ?></p></td>
                </tr>
                <tr>
                    <td>FRANQUICIA TELEGRAFICA</td>
                    <td> </td>
                </tr>
                <!------------------------------------------------------------------------------------------------ -->
                <tr>
                    <td rowspan="28" ><p style="transform: rotate(-90deg); -moz-transform: rotate(-90deg);"><strong>LICENCIA DE CREDITO</strong></p></td>
                    <td rowspan="4"><p style="text-align: center"><strong>CORREO NORMAL</strong></p></td>
                    <td>URBANO</td>
                    <td> </td>
                </tr>
                <tr>
                    <td>REGIONAL</td>
                    <td> </td>
                </tr>
                <tr>
                    <td>NACIONAL</td>
                    <td> </td>
                </tr>
                <tr>    
                    <td>TRAYECTO ESPECIAL</td>
                    <td> </td>
                </tr>
                <!------------------------------------------------------------------------------------------------ -->
                <tr>
                    <td rowspan="4"><p style="text-align: center"><strong>CORREO CERTIFICADO</strong></p></td>
                    <td>URBANO</td>
                    <td> </td>
                </tr>
                <tr>
                    <td>REGIONAL</td>
                    <td> </td>
                </tr>
                <tr>
                    <td>NACIONAL</td>
                    <td> </td>
                </tr>
                <tr>    
                    <td>TRAYECTO ESPECIAL</td>
                    <td> </td>
                </tr>
                <!------------------------------------------------------------------------------------------------ -->
                <tr>
                    <td rowspan="4"><p style="text-align: center"><strong>POST-EXPRESS</strong></p></td>
                    <td>URBANO</td>
                    <td><p style="color: red;"><?php echo $exp_urb; ?></p></td>
                </tr>
                <tr>
                    <td>REGIONAL</td>
                    <td><p style="color: red;"><?php echo $exp_reg; ?> </p></td>
                </tr>
                <tr>
                    <td>NACIONAL</td>
                    <td><p style="color: red;"><?php echo $exp_nac; ?></p></td>
                </tr>
                <tr>    
                    <td>TRAYECTO ESPECIAL</td>
                    <td><p style="color: red;"><?php echo $exp_esp; ?></p></td>
                </tr>
                <!------------------------------------------------------------------------------------------------ -->
                <tr>
                    <td rowspan="4"><p style="text-align: center"><strong>ENCOMIENDAS</strong></p></td>
                    <td>URBANO</td>
                    <td><p style="color: red;"><?php echo $enc_urb; ?></p></td>
                </tr>
                <tr>
                    <td>REGIONAL</td>
                    <td><p style="color: red;"><?php echo $enc_reg; ?></p></td>
                </tr>
                <tr>
                    <td>NACIONAL</td>
                    <td><p style="color: red;"><?php echo $enc_nac; ?></p></td>
                </tr>
                <tr>    
                    <td>TRAYECTO ESPECIAL</td>
                    <td><p style="color: red;"><?php echo $enc_esp; ?></p></td>
                </tr>
                <!------------------------------------------------------------------------------------------------ -->
                <tr>
                    <td rowspan="4"><p style="text-align: center;"><strong>PAQUETERIA</strong></p></td>
                    <td>URBANO</td>
                    <td><p style="color: red;"><?php echo $paq_urb; ?></p></td>
                </tr>
                <tr>
                    <td>REGIONAL</td>
                    <td><p style="color: red;"><?php echo $paq_reg; ?></p></td>
                </tr>
                <tr>
                    <td>NACIONAL</td>
                    <td><p style="color: red;"><?php echo $paq_nac; ?></p></td>
                </tr>
                <tr>    
                    <td>TRAYECTO ESPECIAL</td>
                    <td><p style="color: red;"><?php echo $paq_esp; ?></p></td>
                </tr>
                <!------------------------------------------------------------------------------------------------ -->
                <tr>
                    <td rowspan="4"><p style="text-align: center"><strong>HOY MISMO</strong></p></td>
                    <td>URBANO</td>
                    <td> </td>
                </tr>
                <tr>
                    <td>REGIONAL</td>
                    <td> </td>
                </tr>
                <tr>
                    <td>NACIONAL</td>
                    <td> </td>
                </tr>
                <tr>    
                    <td>TRAYECTO ESPECIAL</td>
                    <td> </td>
                </tr>
                <!------------------------------------------------------------------------------------------------ -->
                <tr>
                    <td rowspan="4"><p style="text-align: center"><strong>OTROS</strong></p></td>
                    <td>URBANO</td>
                    <td> </td>
                </tr>
                <tr>
                    <td>REGIONAL</td>
                    <td> </td>
                </tr>
                <tr>
                    <td>NACIONAL</td>
                    <td> </td>
                </tr>
                <tr>    
                    <td>TRAYECTO ESPECIAL</td>
                    <td> </td>
                </tr>
            </tbody>
        </table> 
        <p>________________________________________</p>
        FIRMA DEL RESPONSABLE DEL DESPACHO
    </body>
</html>
