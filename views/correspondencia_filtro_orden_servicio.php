<?php
    require_once "../conectar.php";
    $link=conectarse();
    mysql_set_charset('utf8');

    $inicio     	= ($_GET['fechai']);
    //$inicio     	= $inicio." 00:00:00";
    $fin        	= ($_GET['fechaf']);
    //$fin 			= $fin." 23:59:59";
    $despacho   	= ($_GET['despacho']);
	$destinatario	= $_GET['destinatario'];
	//echo $destinatario;
	 if ( !empty($inicio) && !empty($fin) ) {
        $filtrof = " AND (fecha_admision BETWEEN '$inicio' AND '$fin') ";
    }
    if(!empty($destinatario)){
        $filtro_destino = " AND nombre_destinatario LIKE '%$destinatario%'";
    }
    $filtrox = $filtro_destino." ".$filtrof;
    //query
    if($despacho == 0){
        //echo "todos ";
        $sql = mysql_query("SELECT id, guia, nombre_destinatario, direccion, ciudad, observaciones
            FROM consolidado_472
            WHERE  id>0 $filtrox ");
        
        $sql_total = mysql_query("SELECT COUNT(*)
            FROM consolidado_472
            WHERE  id>0 $filtrox ");
    }else{
        $sql = mysql_query("SELECT id, guia, nombre_destinatario, direccion, ciudad, observaciones
            FROM consolidado_472
            WHERE id>0 $filtrox AND observaciones LIKE '%$despacho%' ");
        
        $sql_total = mysql_query("SELECT COUNT(*)
            FROM consolidado_472
            WHERE  id>0 $filtrox AND observaciones LIKE '%$despacho%' ");
    }
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
                </th>
            </tr>
            <tr> 
                <th>ID</th>
                <th>GUÌA</th>
                <th>NOMBRE DESTINATARIO</th> 
                <th>DIRECCIÒN</th>
                <th>CIUDAD</th>
            </tr> 
        </thead> 
        <tbody>
            <?php while($row=mysql_fetch_array($sql)){ ?>
            <tr>
                <td>
                    <?php 
                        $id = explode('"', $row['id']);
                        echo implode("",$id);
                    ?>
                </td>
                <td>
                    <?php $guia = explode('"', $row['guia']); ?>
					<a href="http://svc1.sipost.co/trazawebsip2/frmReportTrace.aspx?ShippingCode=<?php echo implode("",$guia); ?>" target="_blank"><?php echo implode("",$guia); ?></a>
                </td>
                <td>
                    <?php
                        $destinatario = explode('"', $row['nombre_destinatario']);
                        echo implode("",$destinatario);
                        //echo $row['nombre_destinatario']; 
                    ?>
                </td>
                <td>
                    <?php 
                        $direccion = explode('"', $row['direccion']);
                        echo implode("",$direccion);
                    ?>
                </td>
                <td>
                    <?php
                        $ciudad = explode('"', $row['ciudad']);
                        echo implode("",$ciudad);
                    ?>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td><strong>TOTAL</strong></td>
                <td><p style="color: red; text-align: center;">------</p></td>
                <td><p style="color: red; text-align: center;">------------------</p></td>
                <td><p style="color: red; text-align: center;">-----</p></td>
                <td><strong style="color: red;"><?php echo $cantidad; ?></strong></td>
            </tr>
        </tbody>
    </table>