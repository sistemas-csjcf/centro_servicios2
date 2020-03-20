<?php 
    require_once "conectar.php";
    $link=conectarse();
    mysql_set_charset('utf8');

    $inicio         = ($_REQUEST['fechai']);
    $fin            = ($_REQUEST['fechaf']);
 
    //query
    $sql = mysql_query("SELECT observaciones, COUNT(*) AS cantidad
        FROM consolidado_472 
        WHERE  fecha_admision BETWEEN  '".$inicio."' AND '".$fin."'
        GROUP BY observaciones");
?>
<html>
    <head><meta charset="utf-8" /></head>
    <body>
        <table border="0" style="width: 57%">
            <tr><td colspan="4" align="center"><strong>Rama Judicial del Poder Publico</strong></td></tr>
            <tr><td colspan="4" align="center"><strong>REPORTE TOTAL ENVIOS 4-72</strong></td></tr>
        </table>
        <table border="1">
            <thead>
                <tr style="background-color: darkgray; color: white;">
                    <th colspan="3">DESPACHO</th>
                    <th>NUMERO DE ENVIOS</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row=mysql_fetch_array($sql)){ ?>
                    <tr>   
                        <td>
                            <?php 
                                $OBS= explode('"', $row['observaciones']);
                                echo implode("",$OBS);
                            ?>
                        </td>
                        <td>
                            <?php
                                $cant= explode('"', $row['cantidad']);
                                echo implode("",$cant);
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table> 
    </body>
</html>