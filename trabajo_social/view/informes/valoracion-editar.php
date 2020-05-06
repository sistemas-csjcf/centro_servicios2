<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user = $_SESSION['idUsuario'];
    // JUAN ESTEBAN MUNERA BETANCUR 
    if(isset($id_user)){
?>
    <h1 class="page-header">
        <?php echo $vis->vis_pro_id != null ? $vis->vis_pro_radicado : 'Nuevo Registro'; ?>
    </h1>
    
    <ol class="breadcrumb">
        <li><a href="?c=Visitas&a=Listado_InformesValoracion" style="text-decoration:none;">Valoración Visitas</a></li>
        <li class="active"><?php echo $vis->vis_pro_id != null ? $vis->inf_val_id : 'Nuevo Registro'; ?></li>
    </ol>
    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr style="background-color: #2E8B57; color: white;">
                <th title="Código Valoración Visita">Id</th>
                <th title="Código Visita">Id Visita</th>
                <th>Fecha Recepcion</th>
                <th>Asistente Social</th>
                <th>Radicado</th>
                <th>Sub-Clase Proceso</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $vis->inf_val_id; ?></td>
                <td><?php echo $vis->vis_pro_id; ?></td>
                <td><?php echo $vis->inf_val_fechaRecepcion; ?></td>
                <td><?php echo $vis->vis_TSoci_nombre; ?></td>
                <td><?php echo $vis->vis_pro_radicado; ?></td>
                <td><?php echo $vis->vis_pro_subclase_proceso; ?></td>
            </tr>
        </tbody>
    </table><br/>
    <form id="frm-valoracion" action="?c=Visitas&a=Guardar_valoracion_visita" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $vis->inf_val_id; ?>" />
        <input type="hidden" name="bool_log" value="<?php echo $vis->inf_val_bool_log ?>" />
        <div class="form-group">
            <label>Nombre de quien realiza valoración del informe </label>
            <input type="text" name="nombreValoracion" id="nombreValoracion" class="form-control" value="<?php echo $vis->inf_val_nombreValoracion; ?>" placeholder="Nombre de quien realiza valoración del informe en el despacho" data-validacion-tipo="requerido|min:7">
        </div><br/>
        <fieldset class="form-group">
            <legend>Considera usted que se cumplió el objetivo planteado  para la visita?</legend>
                <?php if($vis->inf_val_cumpleObjetivo == "Si"){ ?>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="objetivo" id="optionsRadios1" value="Si" onchange="validarObjetivo(this.value)" checked>Si        
                        </label>
                    </div>
                 <?php }else if ($vis->inf_val_cumpleObjetivo==""){ ?>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="objetivo" id="optionsRadios1" value="Si" onchange="validarObjetivo(this.value)" checked>Si
                        </label>
                    </div>
                <?php }else{ ?>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="objetivo" id="optionsRadios1" value="Si" onchange="validarObjetivo(this.value)">Si        
                        </label>
                    </div>
                <?php } ?>
                <?php if($vis->inf_val_cumpleObjetivo == "No"){ $display ="block"; ?>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="objetivo" id="optionsRadios2" value="No" onchange="validarObjetivo(this.value)" checked="">No
                        </label>
                    </div>
                <?php }else{ $display ="none"; ?>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="objetivo" id="optionsRadios2" value="No" onchange="validarObjetivo(this.value)">No
                        </label>
                    </div>
                <?php } ?>
            <br><span class="help-block">*En caso de ser negativa su respuesta indique por qué?</span>
            <div class="form-group" id="res_objetivo" style="display: <?php echo $display; ?>">
                <textarea class="form-control" name="res_objetivo" id="txtArea_res_objetivo" rows="5" placeholder="indique por qué?" disabled="" required=""><?php echo $vis->inf_val_cumpleObjetivoRespuesta; ?></textarea>
            </div> 
        </fieldset>
        <fieldset class="form-group">
            <legend>Considera usted que la visita se realizó oportunamente?</legend>
            <?php if($vis->inf_val_oportunamente == "Si"){ ?>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="oportunamente" id="optionsRadios1" value="Si" onchange="validarOportunamente(this.value)" checked>Si
                    </label>
                </div>
             <?php }else if ($vis->inf_val_oportunamente==""){ ?>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="oportunamente" id="optionsRadios1" value="Si" onchange="validarOportunamente(this.value)" checked>Si
                    </label>
                </div>
            <?php }else{ ?>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="oportunamente" id="optionsRadios1" value="Si" onchange="validarOportunamente(this.value)">Si
                    </label>
                </div>
            <?php } ?>
            <?php if($vis->inf_val_oportunamente == "No"){ $display1 ="block"; ?>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="oportunamente" id="optionsRadios1" value="No" onchange="validarOportunamente(this.value)" checked>No
                    </label>
                </div>
            <?php }else{ $display1 ="none";  ?>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="oportunamente" id="optionsRadios1" value="No" onchange="validarOportunamente(this.value)" >No
                    </label>
                </div>
            <?php } ?>
            <br><span class="help-block">*En caso de ser negativa su respuesta indique por qué?</span>
            <div class="form-group" id="res_oportunamente" style="display: <?php echo $display1; ?>">
                <textarea class="form-control" name="res_oportunamente" id="comment_oportunamente" rows="5" placeholder="indique por qué?" disabled="" required=""><?php echo $vis->inf_val_oportunamenteRespuesta; ?></textarea>
            </div> 
        </fieldset>
        <fieldset class="form-group">
            <legend>Valoración del Despacho que ordena la visita</legend>
            <?php if($vis->inf_val_valoracionDespacho == "E"){ ?>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="valoracion" id="optionsRadios1" value="E" checked>Excelente
                    </label>
                </div>
            <?php }else if ($vis->inf_val_valoracionDespacho==""){ ?>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="valoracion" id="optionsRadios1" value="E" checked>Excelente
                    </label>
                </div>
            <?php }else{ ?>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="valoracion" id="optionsRadios1" value="E" >Excelente
                    </label>
                </div>
            <?php } ?>
            <?php if($vis->inf_val_valoracionDespacho == "B"){ ?> 
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="valoracion" id="optionsRadios2" value="B" checked="">Bueno
                    </label>
                </div>
            <?php }else{ ?>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="valoracion" id="optionsRadios2" value="B">Bueno
                    </label>
                </div>
            <?php } ?>
            <?php if($vis->inf_val_valoracionDespacho == "R"){ ?> 
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="valoracion" id="optionsRadios3" value="R" checked="">Regular
                    </label>
                </div>
            <?php }else{ ?>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="valoracion" id="optionsRadios3" value="R" >Regular
                    </label>
                </div>
            <?php } ?>
            <?php if($vis->inf_val_valoracionDespacho == "M"){ ?> 
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="valoracion" id="optionsRadios4" value="M" checked="">Malo
                    </label>
                </div>
            <?php }else{ ?>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="valoracion" id="optionsRadios4" value="M">Malo
                    </label>
                </div>
            <?php } ?>
        </fieldset>
        <div class="form-group">
            <label>Observaciones</label>
            <textarea class="form-control" name="comentarios" id="comment" rows="5" placeholder="Observaciones Valoración Visita"><?php echo $vis->inf_val_observaciones; ?></textarea>
        </div> 
        <hr />
        <div class="text-right">
            <button class="btn btn-success" id="btn_guardar"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
        </div>
    </form>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#frm-valoracion").submit(function(){
                return $(this).validate();
            });
        });
    </script>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>