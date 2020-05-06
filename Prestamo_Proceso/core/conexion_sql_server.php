<?php
    require_once "conexion.php";
    $link=conectarse();
    $sql="SELECT * FROM pa_base_datos WHERE id =3";
    $res=mysql_query($sql,$link);
    while($row=mysql_fetch_array($res)){ 
        $datosbd_1 = $row['ip'];
        $datosbd_2 = $row['bd'];
        $datosbd_3 = $row['usuario'];
        $datosbd_4 = $row['clave'];
    }
    function conectarse_sql(){
        $serverName = $datosbd_1; //serverName\instanceName
        $connectionInfo = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
  
        return $conn;
    }
?>