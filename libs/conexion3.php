<!--Conexion ConsejoPN-->
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
?>