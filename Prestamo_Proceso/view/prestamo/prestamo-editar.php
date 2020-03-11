<h1 class="page-header">
    <?php echo $pre->id != null ? $pre->pre_id : 'Nuevo Registro'; ?>
</h1>
<ol class="breadcrumb">
    <li><a href="?c=Prestamo">Prestamos</a></li>
    <li class="active"><?php echo $pre->id != null ? $aud->Nombre : 'Nuevo Registro'; ?></li>
</ol>
<form id="frm-prestamos" action="?c=Prestamo&a=Guardar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $pre->id; ?>" />
    <div class="form-group">
        <label>Radicado </label>
        <input type="number" name="radicado" id="radicado" onkeyup="validarSiNumero(this.value)" value="<?php echo $pre->pre_radicado; ?>" class="form-control" maxlength="23" placeholder="Ingrese radicado completo (23 digitos)" data-validacion-tipo="requerido|min:23" />
        <br><button type="button" class="btn btn-info" id="btn_consultar" onclick="buscar_radi()">Consultar</button>
    </div>
    <div id="load" style="display: none">
        <div class="progress" >
            <div id="bar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                <span class="sr-only">10% Complete</span>
            </div>
        </div>
    </div>
    <div id="resultado"></div> 
    <div class="form-group">
        <label>Observaciones</label>
        <textarea class="form-control" name="observaciones" id="comment" rows="5" placeholder="Observaciones"><?php echo $pre->pre_info_archivo; ?></textarea>
    </div>
    <hr />
    <div class="text-right">
        <button class="btn btn-success" id="btn_guardar" ><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
    </div>
</form>
<script>
    $(document).ready(function(){
        $("#frm-prestamos").submit(function(){
            return $(this).validate();
        });
    });
    function validarSiNumero(radicado){
        //alert(radicado);
        radicado = (radicado) ? radicado : window.event
        var charCode = (radicado.which) ? radicado.which : radicado.keyCode
        if (!/^([0-9])*$/.test(radicado) ){
            alert("Por favor ingrese solo números.");
            document.getElementById("btn_consultar").disabled=true;
        }else{
            document.getElementById("btn_consultar").disabled=false;
        }
    };
</script>