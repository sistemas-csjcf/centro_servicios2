<?php 
    require_once "../conectar.php";
    $link=conectarse();
    $dato_id = $_GET['id'];
    //echo "dato: ".$dato_id;
    mysql_set_charset('utf8');
    $sql="SELECT * FROM documentos_internos WHERE id = '$dato_id' ";
    $res=mysql_query($sql,$link);
    
    while($row = mysql_fetch_array($res)){
        $nombre     = $row["nombre"];   
        $direccion  = $row["direccion"];
        $ciudad     = $row["ciudad"];
        $partes     = $row["partes"];
    }
    $contenido = explode("//////", $partes);
    
?>
<dialog id="ventana" open><img src="views/images/close.jpg" onclick="closeDialog()" width="20" height="20" style="float: right; text-decoration:underline;cursor:pointer;" alt="Cerrar" title="Cerrar"/><br><br><strong>Nombre: </strong><?php echo $nombre; ?>, <strong>Dirección:</strong> <?php echo $direccion." ".$ciudad; ?><br><br><strong>Contenido</strong><br><br><?php print_r($contenido[1]); ?><br><br><?php print_r($contenido[2]) ?></dialog>