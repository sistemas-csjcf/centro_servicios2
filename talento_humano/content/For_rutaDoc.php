<?php
    //JUAN ESTEBAN MÙNERA BETANCUR
    $ruta = $_GET['ruta'];
?>
<script>alert(<?php// echo $ruta; ?>) 
    function ver_pdf(id, ruta){
    alert(id+" "+ruta);
    if(id==1 && ruta !=''){
        window.open("?documentos_HV/fotos/="+ruta)
    }else if(id == 2 && ruta !=''){
        window.open("documentos_HV/Certificados_Estudios/"+ruta)
    }else if(id == 3 && ruta !=''){
        window.open("documentos_HV/Certificados_Laborales/"+ruta)
    }else{
        alert("Error al abrir archivo");
    }
}

</script>
<!--<label for="id">Descargar Documento</label>
<a id="ruta" class="btn btn-default" href="#" onclick="ver_pdf(3,'<?php echo $ruta ?>');return false;" target="_blank" style="text-decoration:none;"><i class="icon-download3"></i>Descargar</a>-->