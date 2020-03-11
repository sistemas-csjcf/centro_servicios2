<?php
    /*$serverName = "DESKTOP-8FLD29P\SQLEXPRESS";
    $datosbd_2 = "ConsejoPN";
    $datosbd_3 = "sa";
    $datosbd_4 = "111";*/

    $serverName = "192.168.89.20";
    $datosbd_2 = "consejoPN";
    $datosbd_3 = "sa";
    $datosbd_4 = "M4nt3n1m13nt0";

    $conn = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
    $conn = sqlsrv_connect($serverName, $conn);

    $radicado   = '1';
    $codiactu='30023589';
    $sql = ("SELECT a110llavproc,a110consactu,a110numeproc,a110consproc,a110codiactu,a110codipadr,a110descactu,a110legajudi,a110flagterm,a110tipoterm,a110numdterm,a110fechinic,a110fechfina,a110fechregi,a110foliproc,a110cuadproc,a110codiprov,a110numeprov,a110fechprov,a110anotactu,a110fechofic,a110numeofic,a110flagubic,a110tipoactu,a110fechdesa,a110borrterm,a110renuterm FROM [$datosbd_2].[dbo].[t110dractuproc] WHERE t110dractuproc.[a110codiactu]="."'$codiactu'"." ORDER BY a110consactu;");

    $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $sql);
    ?>
    <table border="1">
        <tr>
            <td>a110llavproc</td>
            <td>a110consactu</td>
            <td>a110numeproc</td>
            <td>a110consproc</td>
            <td>a110codiactu</td>
            <td>a110codipadr</td>
            <td>a110descactu</td>
            <td>a110legajudi</td>
            <td>a110flagterm</td>
            <td>a110tipoterm</td>
            <td>a110numdterm</td>
            <td>a110fechinic</td>
            <td>a110fechfina</td>
            <td>a110foliproc</td>
            <td>a110cuadproc</td>
            <td>a110codiprov</td>
            <td>a110numeprov</td>
            <td>a110fechprov</td>
            <td>a110anotactu</td>
            <td>a110fechofic</td>
            <td>a110numeofic</td>
            <td>a110flagubic</td>
            <td>a110tipoactu</td>
            <td>a110fechdesa</td>
            <td>a110borrterm</td>
            <td>a110renuterm</td>
        </tr>
        <?php
            while($row = sqlsrv_fetch_array($stmt)){
                $a110llavproc  = $row['a110llavproc'];
                $a110consactu  = $row['a110consactu'];
                $a110numeproc  = $row['a110numeproc'];
                $a110consproc  = $row['a110consproc'];
                $a110codiactu  = $row['a110codiactu'];
                $a110codipadr  = $row['a110codipadr'];
                $a110descactu  = $row['a110descactu'];
                $a110legajudi  = $row['a110legajudi'];
                $a110flagterm  = $row['a110flagterm'];
                $a110tipoterm  = $row['a110tipoterm'];
                $a110numdterm  = $row['a110numdterm'];
                $a110fechinic  = $row['a110fechinic'];
                $a110fechfina  = $row['a110fechfina'];
                $a110foliproc  = $row['a110foliproc'];
                $a110cuadproc  = $row['a110cuadproc'];
                $a110codiprov  = $row['a110codiprov'];
                $a110numeprov  = $row['a110numeprov'];
                $a110fechprov  = $row['a110fechprov'];
                $a110anotactu  = $row['a110anotactu'];
                $a110fechofic  = $row['a110fechofic'];
                $a110numeofic  = $row['a110numeofic'];
                $a110flagubic  = $row['a110flagubic'];
                $a110tipoactu  = $row['a110tipoactu'];
                $a110fechdesa  = $row['a110fechdesa'];
                $a110borrterm  = $row['a110borrterm'];
                $a110renuterm  = $row['a110renuterm'];
        ?>
        <tr>
            <td><?php echo $a110llavproc; ?></td>
            <td><?php echo $a110consactu; ?></td>
            <td><?php echo $a110numeproc; ?></td>
            <td><?php echo $a110consproc; ?></td>
            <td><?php echo $a110codiactu; ?></td>
            <td><?php echo $a110codipadr; ?></td>
            <td><?php echo $a110descactu; ?></td>
            <td><?php echo $a110legajudi; ?></td>
            <td><?php echo $a110flagterm; ?></td>
            <td><?php echo $a110tipoterm; ?></td>
            <td><?php echo $a110numdterm; ?></td>
            <td><?php //echo $a110fechinic; ?></td>
            <td><?php //echo $a110fechfina; ?></td>
            <td><?php echo $a110foliproc; ?></td>
            <td><?php echo $a110cuadproc; ?></td>
            <td><?php echo $a110codiprov; ?></td>
            <td><?php echo $a110numeprov; ?></td>
            <td><?php //echo $a110fechprov; ?></td>
            <td><?php echo $a110anotactu; ?></td>
            <td><?php //echo $a110fechofic; ?></td>
            <td><?php echo $a110numeofic; ?></td>
            <td><?php echo $a110flagubic; ?></td>
            <td><?php echo $a110tipoactu; ?></td>
            <td><?php //echo $a110fechdesa; ?></td>
            <td><?php echo $a110borrterm; ?></td>
            <td><?php echo $a110renuterm; ?></td>
        </tr>
        <?php
            }
        ?>
    </table>