<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user    = $_SESSION['idUsuario'];
//    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo               = new HojaVida();
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '29';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
    date_default_timezone_set('America/Bogota'); 
    $fecha_actual = date('Y-m-d');
    $motivos_licencia = $modelo->get_motivos_licencia_no_remunerada();
    $municipios = $modelo->Listar_municipios_todos();
    if(isset($id_user)){
?>
    <h3 class="page-header">Licencia No Remunerada</h3>
    <!-- <ol class="breadcrumb">
        <li><a href="?c=hoja_vida">xxdxdPermisosxxdfxfdxhd</a></li>
        <li class="active">Nuevo Registro</li>
    </ol> -->
    <form id="frm-TH_licencia" action="?c=Hoja_vida&a=Guardar_Licencia_noRemunerada3" method="post" enctype="multipart/form-data">
        <input type="hidden" name="lic_id" value="<?php echo $per->per_est_id; ?>" />
        <input type="hidden" name="idUser" value="<?php echo $id_user; ?>" /> 
        
        <?php if ( in_array($_SESSION['idUsuario'], $usuariosa) ) { ?>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="check_other" onchange="Check_other()">
                <label class="form-check-label" for="exampleCheck1">Licencia Foráneo</label>
                <input type="hidden" id="flag_foraneo" value="0">
            </div><br>
            <div class="form-group row" id="datos_other" style="display: none;">
                <div class="col-xs-6">
                    <input type="hidden" name="id_servidor" id="id_servidor" readonly="true"/> <!--id_servidor que solicita la licencia. -->
                    <input type="hidden" id="cargo_servidor" name="cargo_servidor" readonly="true"><!--cargo del servidor que solicita la licencia. -->

                    <i class="fa fa-address-card-o" aria-hidden="true"></i> <label>Nº Cèdula </label>
                    <input type="text" id="other_cedula" name="cedula_other" class="form-control" onKeyUp="Traer_Datos_Partes_Reg(this.value)" placeholder="Ingrese N° Cédula">
                </div>
                <div class="col-xs-6">
                    <i class="fa fa-user"></i> <label>Nombre Completo </label>
                    <input type="text" id="other_nombre" name="nombre_other" class="form-control" placeholder="Nombre Completo" readonly="">
                </div>
            </div>
        <?php } ?>

        <div class="col-xs-0">
            
            <div class="form-check">
                <label class="radio-inline"><input type="radio" name="lic_id_tipo" value="5" checked="">3 Meses</label>
                <label class="radio-inline"><input type="radio" name="lic_id_tipo" value="6" >2 Años</label>
            </div>

        </div>
        <br />        
        <div class="form-group row">
             <!--<div class="col-xs-4">
                <i class="glyphicon glyphicon-calendar" aria-hidden="true"></i> <label for="Fecha Inicio">Fecha Escrito</label>
                <input type="date" name="fecha_escrito" class="form-control">
            </div> -->
            <div class="col-xs-6">
                <i class="glyphicon glyphicon-calendar" aria-hidden="true"></i> <label for="Fecha Inicio">Fecha Incio</label>
                <input type="date" name="fechaI" class="form-control" required="" >
            </div>
            <div class="col-xs-6">
                <i class="glyphicon glyphicon-calendar" aria-hidden="true"></i> <label for="Fecha Final">Fecha Final (Opcional)</label>
                <input type="date" name="fechaF" class="form-control">
            </div>
        </div>
        <br />
        <div class="form-group row">
            <div class="col-xs-6">
                <i class="glyphicon glyphicon-comment" aria-hidden="true"></i> <label>Motivo </label>

                <select name="motivo_licen" id="motivo_licen" class="form-control selectpicker" data-live-search="true">
                    <?php while ($row = $motivos_licencia->fetch()){ ?>
                        <option value="<?php echo $row['mot_titulo'] ?>"><?php echo $row['mot_titulo'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-xs-6">
                <i class="glyphicon glyphicon-globe" aria-hidden="true"></i> <label>Ciudad (Opcional)</label>
                <select name="ciudad_lice" id="ciudad_lice" class="form-control selectpicker" data-live-search="true">
                    <option value="">Seleccionar Ciudad</option>
                    <?php while ($row = $municipios->fetch()){ ?>
                        <option value="<?php echo $row['nombre'] ?>"><?php echo $row['nombre'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <br />
        <div class="form-group row">
            <div class="col-xs-6">
                <i class="glyphicon glyphicon-calendar" aria-hidden="true"></i> <label> Fecha del escrito </label>
                <input type="date" name="fechaEscrito" class="form-control" required="" >
            </div>
            <div class="col-xs-6">
                <i class="glyphicon glyphicon-paperclip" aria-hidden="true"></i> <label>Adjuntar</label>
                <input type="file" id="file-1" name="per_ruta_doc_adjunto" placeholder="Ingrese Documento" class="file" value="" data-preview-file-type="any" required="">
            </div>
        </div>



        <!-- <div class="form-group">
            <i class="glyphicon glyphicon-comment" aria-hidden="true"></i> <label>Motivo </label>

            <select name="motivo_licen" id="motivo_licen" class="form-control selectpicker" data-live-search="true">
                <?php while ($row = $motivos_licencia->fetch()){ ?>
                    <option value="<?php echo $row['mot_id'] ?>"><?php echo $row['mot_titulo'] ?></option>
                <?php } ?>
            </select>

            <select name="motivo_lice" id="motivo_lice" class="form-control selectpicker" data-live-search="true">
                <?php while ($row = $motivos_licencia->fetch()){ ?>
                    <option value="<?php echo $row['mot_id'] ?>"><?php echo $row['mot_titulo'] ?></option>
                <?php } ?>
            </select>

            -- <textarea class="form-control" name="comentarios" id="comment" rows="5" placeholder="Ingrese Motivo Solicitud Licencia" data-validacion-tipo="requerido|min:10">Con el fin de <?php echo $vis->vis_pro_comentarios; ?></textarea> 

        </div>  -->
        <hr />
        <div class="text-right">
            <button class="btn btn-success"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
        </div>
    </form>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#frm-TH_licencia").submit(function(){
                return $(this).validate();
            });
        });
        function validarSiNumero(numero){
            if (!/^([0-9])*$/.test(numero) ){
                alert("Por favor ingrese solo números");
                document.getElementById("btn_consultar").disabled=true;
            }else{
                document.getElementById("btn_consultar").disabled=false;
            }
        }
        function clic1(valor){
            //alert(valor);
        }
    </script>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.30/centro_servicios2" ); } ?>