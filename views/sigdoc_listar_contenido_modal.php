<?php 
    require_once "../conectar.php";
    $link=conectarse();
    $dato_id = $_GET['id'];
    //echo "dato: ".$dato_id;
    mysql_set_charset('utf8');
    $sql="SELECT * FROM sigdoc_documentos_internos WHERE id = '$dato_id' ";
    $res=mysql_query($sql,$link);
    
    while($row = mysql_fetch_array($res)){
        $contenido     = $row["contenido"];   
    }
?>
<dialog id="ventana" open><img src="views/images/close.jpg" onclick="closeDialog()" width="30" height="30" style="float: right; text-decoration:underline;cursor:pointer;" alt="Cerrar" title="Cerrar"/><br><br><?php echo (nl2br($contenido)); ?></dialog>