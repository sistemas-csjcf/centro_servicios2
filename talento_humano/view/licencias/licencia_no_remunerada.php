<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user    = $_SESSION['idUsuario'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo               = new HojaVida();
    $idaccion             = '4';
    $datos_us_accionReps  = $modelo->get_lista_usuario_accionesJE($idaccion);
    $us_privilegios       = $datos_us_accionReps->fetch();
    $usuarioPr            = explode("////",$us_privilegios[usuario]);
    if(isset($id_user)){
?>
    <h1 class="page-header">Licencia no remunerada.</h1>
    <ol class="breadcrumb">
        
        <li class="active">Nuevo Registro</li>
    </ol>
    <form id="frm-TH_Permisos" action="?c=Hoja_vida&a=Guardar_PermisoBasico" method="post" enctype="multipart/form-data">
        <input type="hidden" name="per_id" value="<?php echo $per->per_est_id; ?>" />
        <input type="hidden" name="idUser" value="<?php echo $id_user; ?>" />
        <div class="form-group row">
            <div class="col-xs-3">
                <i class="glyphicon glyphicon-calendar" aria-hidden="true"></i> <label>Fecha Permiso </label>
                <input type="date" name="fecha_permiso" id="fecha_permiso" value="<?php echo $vis->vis_pro_fecha_audiencia; ?>" class="form-control" placeholder="Ingrese fecha Permiso" data-validacion-tipo="requerido" />
            </div>
            <div class="col-xs-2">
                <i class="glyphicon glyphicon-time" aria-hidden="true"></i> <label>Hora Inicial </label>
                <input type="time" name="hora_inicio" id="titulo" value="<?php echo $per->per_apellidos; ?>" class="form-control" placeholder="Ingrese Hora Inicial" data-validacion-tipo="requerido" />     
            </div>
            <div class="col-xs-2">
                <i class="glyphicon glyphicon-time" aria-hidden="true"></i> <label>Hora Final </label>
                <input type="time" name="hora_fin" id="titulo" value="<?php echo $per->per_apellidos; ?>" class="form-control" placeholder="Ingrese Hora Final" data-validacion-tipo="requerido" />     
            </div>
            <div class="col-xs-2">
                <label>¿Fuera de la Ciudad? </label>
                <div class="form-check">
                    <label class="radio-inline"><input type="radio" name="per_out" value="1">Si</label>
                    <label class="radio-inline"><input type="radio" name="per_out" value="0" checked="">No</label>
                </div>
            </div>
            <div class="col-xs-3">
                <label>¿Compensatorio por Votación? </label>
                <div class="form-check">
                    <label class="radio-inline"><input type="radio" name="per_vot" value="1">Si</label>
                    <label class="radio-inline"><input type="radio" name="per_vot" value="0" checked="">No</label>
                </div>
            </div>
        </div><br>
        <div class="form-group">
            <label>Detalle </label>
            <textarea class="form-control" name="comentarios" id="comment" rows="5" placeholder="Ingrese Detalle Solicitud Permiso" data-validacion-tipo="requerido|min:15"><?php echo $vis->vis_pro_comentarios; ?></textarea>
        </div> 
        <div class="form-group row">
            <div class="col-xs-6">
                <i class="glyphicon glyphicon-paperclip" aria-hidden="true"></i> <label>Adjuntar</label>
                <input type="hidden" name="per_doc_adjunto" value="<?php echo $per->per_est_ruta_doc_horario; ?>" />
                <input id="file-1" name="per_ruta_doc_adjunto" type="file" placeholder="Ingrese Documento" class="file" value="<?php echo "ruta xxx"; ?>" data-preview-file-type="any">
            </div>
            <div class="col-xs-6">
                <?php if($per->per_est_ruta_doc_horario != ''): ?>
                    <div class="img-thumbnail " style="border: 0px;">
                        <a href="Documentos_TH/REPS_Docs_Permisos/<?php echo $per->per_est_ruta_doc_horario; ?>" target="_blank" style="text-decoration:none;"><i class="icon-download3"></i>Descargar</a>
                    </div>
                <?php endif; ?>            
            </div>
        </div>
        <hr />
        <div class="text-right">
            <button class="btn btn-success"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
        </div>
    </form>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#frm-TH_Permisos").submit(function(){
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
        };
    </script>
    <style type="text/css">
        .radio-green [type="radio"]:checked+label:after {
            border-color: #00C851;
            background-color: #00C851;
        }
        /*Gap*/
        .radio-green-gap [type="radio"].with-gap:checked+label:before {
            border-color: #00C851;
        }
        .radio-green-gap [type="radio"]:checked+label:after {
            border-color: #00C851;
            background-color: #00C851;
        } 
        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
        }
        .btn-circle.btn-lg {
            width: 50px;
            height: 50px;
            padding: 13px 13px;
            font-size: 18px;
            line-height: 1.33;
            border-radius: 25px;
        }
    </style>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.30/centro_servicios2" ); } ?>