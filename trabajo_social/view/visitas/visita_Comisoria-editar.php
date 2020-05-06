<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user    = $_SESSION['idUsuario'];
    $idPerfil   = $_SESSION['idperfil'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo               = new Visita();
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '20';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
    
    $fecha  = $modelo->get_fecha_actual();
    $fecha  = date('Y-m-d');
    $datos_Tsocial        = $modelo->get_lista_TSocial();
    while($row = $datos_Tsocial->fetch()){
        $idTSocial = $row['vis_TSoci_id'];
        $contador  = $row['vis_TSoci_contador'];
    }
    if(isset($id_user)){
?>
    <h1 class="page-header">
        <?php echo $vis->vis_pro_id != null ? $vis->Nombre : 'Nuevo Registro'; ?>
    </h1>
    <?php if ( in_array($_SESSION['idUsuario'],$usuariosa) ) { ?>
        <ol class="breadcrumb">
            <li><a href="?c=Visitas">Visitas</a></li>
            <li class="active"><?php echo $vis->id != null ? $vis->vis_pro_radicado : 'Nuevo Registro'; ?></li>
        </ol>
    <?php }else{ ?>
        <ol class="breadcrumb">
            <li><a href="?c=Visitas&a=H_Visitas">Visitas</a></li>
            <li class="active"><?php echo $vis->id != null ? $vis->vis_pro_radicado : 'Nuevo Registro'; ?></li>
        </ol>
    <?php } ?>
    <?php// if($idPerfil ==22){ ?>
        <form id="frm-visita_Com" action="?c=Visitas&a=Guardar" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $vis->id; ?>" />
            <input type="hidden" name="idTsocial" id="idTsocial" value="<?php echo $idTSocial ?>">
            <input type="hidden" name="contador_TS" id="contadorTS" value="<?php echo $contador ?>" > 
            <input type="hidden" name="bandera" value="1" />
            <input type="hidden" name="solicitante" value="Despacho Comisorio" />
            <input type="hidden" name="id_usuarioR" value="<?php echo $id_user; ?>">
            <input type="hidden" name="clase_proceso" value="NULL" />
            <input type="hidden" name="sub_clase" value="NULL" />
            <input type="hidden" name="datos_partes" value="NULL" />
            <div class="form-group">
                <label>Radicado </label>
                <input type="number" name="radicado" id="radicado" onkeyup="validarSiNumero(this.value);" value="<?php echo $vis->vis_pro_radicado; ?>" class="form-control" maxlength="23" placeholder="Ingrese radicado completo (23 digitos)" data-validacion-tipo="requerido|min:23" />
            </div>
            <div class="form-group">
                <label>Observaciones</label>
                <textarea class="form-control" name="comentarios" id="comment" rows="5" placeholder="Observaciones de la visita"><?php echo $vis->vis_pro_comentarios; ?></textarea>
            </div> 
            <div class="form-group">
                <?php if($vis->vis_pro_fecha_visita==""){ ?>
                    <input readonly type="hidden" name="fecha_visita" value="<?php echo $fecha; ?>" class="form-control" placeholder="Ingrese fecha visita" data-validacion-tipo="requerido" />
                <?php }else{ ?>
                    <input readonly type="hidden" name="fecha_visita" value="<?php echo $vis->vis_pro_fecha_visita; ?>" class="form-control" placeholder="Ingrese fecha visita" data-validacion-tipo="requerido" />
                <?php } ?>
            </div>
            <div class="form-group">
                <label>Fecha Audiencia </label>
                <input readonly type="text" name="fecha_audiencia" id="fecha_audiencia" value="<?php echo $vis->vis_pro_fecha_audiencia; ?>" class="form-control datepicker" placeholder="Ingrese fecha audiencia" />
            </div>
            <hr />
            <div class="text-right">
                <button class="btn btn-success" id="btn_guardar" onmouseover="buscar_radi()"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
            </div>
        </form>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#frm-visita_Com").submit(function(){
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
    <?php// }else{ ?>
        <!--<h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para acceder a esta opción</h4>-->
    <?php  }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.30/centro_servicios2" ); } ?>