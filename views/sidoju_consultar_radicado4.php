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
        if( $conn === false ) { die( print_r( sqlsrv_errors(), true)); }
		/*$sql = "INSERT INTO [ConsejoPN].[dbo].[t110dractuproc] (a110llavproc,a110consactu,a110numeproc,a110consproc,a110codiactu,a110codipadr,a110descactu,a110legajudi,a110flagterm,a110tipoterm,a110numdterm,a110fechinic,a110fechfina,a110fechregi,a110foliproc,a110cuadproc,a110codiprov,a110numeprov,a110fechprov,a110anotactu,a110fechofic,a110numeofic,a110flagubic,a110tipoactu,a110fechdesa,a110borrterm,a110renuterm) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$params = array("9999","5","99","00","30023589","30010162","Recepcion Incidente de Desacato en Salud","N","NO","N","0","","","","","","","","","Se Registra el Documento, Incidente de Desacato en Salud","","","S","D","","NO","NO");*/

		$sql = "INSERT INTO [ConsejoPN].[dbo].[t110dractuproc] (a110llavproc,a110consactu,a110numeproc,a110consproc,a110codiactu,a110codipadr,a110descactu,a110legajudi,a110flagterm,a110tipoterm,a110numdterm,a110foliproc,a110cuadproc,a110codiprov,a110numeprov,a110anotactu,a110numeofic,a110flagubic,a110tipoactu,a110borrterm,a110renuterm) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$params = array("6666","0","66","00","30023589","30010162","Recepcion Incidente de Desacato en Salud","N","NO","N","0","","","","","Se Registra el Documento, Incidente de Desacato en Salud","","S","D","NO","NO");

		$stmt = sqlsrv_query( $conn, $sql, $params);

		/*include("/../libs/conexion2.php");
		$listar3 = mysql_query("SELECT nombre FROM pa_juzgado WHERE id=".$juzgadodestino." ");
			while ($fila3 = mysql_fetch_assoc($listar3)) {
				$juzgado= $fila3['nombre'];
		}*/

		$sql_actuacion = "UPDATE [ConsejoPN].[dbo].[T103DAINFOPROC] 
		SET a103codipads = ?,a103fechdess = ?,a103anotacts = ? WHERE a103llavproc = ?";
		$params2 = array("30010162","2019-12-02","Recepcion Incidente de Desacato en Salud","17001311000420040039900");
		$stmt2 = sqlsrv_query( $conn, $sql_actuacion, $params2);
		$rows_affected2 = sqlsrv_rows_affected($stmt2);
?>