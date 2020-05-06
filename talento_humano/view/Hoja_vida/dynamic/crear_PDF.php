<?php
    
    $id = $_REQUEST['idUS'];
    //echo "dsada  ".$id;
   
?>
<label for="id">Descargar Hoja Vida</label>
<button type="button" class="btn btn-default">
    <a id="download_HV" href="?c=hoja_vida&a=Generar_PDF_HV&id_empleado=<?php echo $id; ?>" target="_blank" style="text-decoration:none;"><i class="icon-download3"></i>Descargar</a>
</button>
