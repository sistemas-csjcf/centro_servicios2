<?php
    require_once "../conectar.php";
    $link=conectarse();
    mysql_set_charset('utf8');

    $inicio         = ($_GET['fechai']);
    $fin            = ($_GET['fechaf']);
    
    if ( !empty($inicio) && !empty($fin) ) {
        $filtrof = " AND (fecha_admision BETWEEN '$inicio' AND '$fin') ";
    }
    $filtrox = $filtrof;
    
    //query
    $sql = mysql_query("SELECT observaciones, COUNT(*) AS cantidad
        FROM consolidado_472
        WHERE  id>0 $filtrox  
        GROUP BY observaciones    ");

    $sql_total = mysql_query("SELECT COUNT(*)
        FROM consolidado_472
        WHERE  id>0 $filtrox ");
   
    while($row1=mysql_fetch_array($sql_total)){ 
        $cantidad = $row1[0];
    }
?>
    <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_editar1">								
        <thead> 
            <tr>
                <th bgcolor="#CDE3F9" colspan="5">
                    <center><div id="titulo_frm">LISTA CONSOLIDADO </div></center>
                    <p style="text-align: right;">Total Envios <?php echo $cantidad; ?></p>
                    <a href="?controller=correspondencia&action=Generar_Excel_Total_Envios&fechai=<?php echo $inicio; ?>&fechaf=<?php echo $fin; ?>" style="text-decoration: none;"><span class="icon icon-file-excel" style="font-size: 25px; color: green"></span></a>
                </th>
            </tr>
            <tr> 
                <th>DESPACHO</th>
                <th>CANTIDAD</th>
            </tr> 
        </thead> 
        <tbody>
            <?php while($row=mysql_fetch_array($sql)){ ?>
                <tr>   
                    <td>
                        <?php 
                            $direccion = explode('"', $row['observaciones']);
                            echo implode("",$direccion);
                        ?>
                    </td>
                    <td>
                        <?php
                            $ciudad = explode('"', $row['cantidad']);
                            echo implode("",$ciudad);
                        ?>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td><strong>TOTAL</strong></td>
                <td><strong style="color: red;"><?php echo $cantidad; ?></strong></td>
            </tr>
        </tbody>
    </table>