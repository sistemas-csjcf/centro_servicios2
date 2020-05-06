<?php

include("/../libs/conexion2.php"); //Centro de Servicios
    require_once "../libs/conexion.php";
$radicado   = '1';
    $link=conectarse();
    $sql="SELECT * FROM pa_base_datos WHERE id=3"; //id=3 BD Justicia, id=8 es de pruebas
    $res=mysql_query($sql,$link);
    while($row=mysql_fetch_array($res)){
        $datosbd_1 = $row["ip"];
        $datosbd_2 = $row["bd"];
        $datosbd_3 = $row['usuario'];
        $datosbd_4 = $row['clave'];

        $serverName = $datosbd_1;
        $connectionInfo = array("Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
        $conn = sqlsrv_connect($serverName, $connectionInfo);
        if($conn === false) {
            //die( print_r( sqlsrv_errors(), true));
            echo 'Sin sistema en justicia';
        }
    }
    /*$serverName = "192.168.89.20";
    $datosbd_2 = "consejoPN";
    $datosbd_3 = "sa";
    $datosbd_4 = "M4nt3n1m13nt0";
    $conn = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
    $conn = sqlsrv_connect($serverName, $conn);*/
    $t103codipads='30010162';
    $sql = ("SELECT  a103llavproc,a103anotacts,a103fechdess,a103codipads FROM [$datosbd_2].[dbo].[T103DAINFOPROC] WHERE T103DAINFOPROC.[a103codipads]="."'$t103codipads'".";");
    $params  = array();
    $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $sql , $params);
    ?>
    <table border="1">
        <tr>
            <td>a103llavproc</td>
            <td>a103anotacts</td>
            <td>a103fechdess</td>
            <td>a103codipads</td>
        </tr>
        <?php
            while($row = sqlsrv_fetch_array($stmt)){
                $a103llavproc  = $row['a103llavproc'];
                $a103anotacts  = $row['a103anotacts'];
                $a103fechdess  = $row['a103fechdess'];
                $a103codipads  = $row['a103codipads'];
        ?>
        <tr>
            <td><?php echo $a103llavproc; ?></td>
            <td><?php echo $a103anotacts; ?></td>
            <td><?php // echo $a103fechdess->format('d/m/Y'); ?>
            <?php echo $a103fechdess; ?></td>
            <td><?php echo $a103codipads; ?></td>
        </tr>
        <?php
            }
        ?>
    </table>



    

