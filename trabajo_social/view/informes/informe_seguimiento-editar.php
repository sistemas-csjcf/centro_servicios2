<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user = $_SESSION['idUsuario'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo               = new Visita();
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '20';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
    $listado_municipios   = $modelo->Listar_municipios();
    if(isset($id_user)){
?>
    <h4 class="page-header">
        <?php echo $vis->vis_pro_id != null ? $vis->vis_pro_radicado : 'Nuevo Registro'; ?>
    </h4>
    
    <ol class="breadcrumb">
        <li><a href="?c=Visitas&a=IndexVisitasTS" style="text-decoration:none;">Informe Visitas</a></li>
        <li class="active"><?php echo $vis->vis_pro_id != null ? $vis->vis_pro_radicado : 'Nuevo Registro'; ?></li>
    </ol>
    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr style="background-color: #2E8B57; color: white;">
                <th title="Código Seguimiento Informe Visita">ID</th>
                <th title="Código Visita">Id Visita</th>
                <th>Fecha Visita</th>
                <th>Radicado</th>
                <th>Sub-Clase Proceso</th>
                <th>Despacho Solicitante</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $vis->vis_inf_id; ?></td>
                <td><?php echo $vis->vis_inf_id_visProgramacion; ?></td>
                <td><?php echo $vis->vis_pro_fecha_visita; ?></td>
                <td><?php echo $vis->vis_pro_radicado; ?></td>
                <td><?php echo $vis->vis_pro_subclase_proceso; ?></td>
                <td><?php echo $vis->vis_pro_solicitante; ?></td>
            </tr>
        </tbody>
    </table>
    <form id="frm-informe_seguimiento" action="?c=Visitas&a=Guardar_Informe_Seguimiento" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $vis->vis_inf_id; ?>" />
        <input type="hidden" name="fecha_visita" id="fecha_visita" value="<?php echo $vis->vis_pro_fecha_visita ?>">
        <input type="hidden" name="bool_log" value="<?php echo $vis->vis_inf_log; ?>" />
        <div class="form-group row">
            <div class="col-xs-3">
                <label for="hora_inicio">Hora Inicio</label>
                <input name="hora_inicio" class="form-control" id="hora_inicio" onchange="time()" type="time" value="<?php echo $vis->vis_inf_hora_inicio; ?>" required="">
            </div>
            <div class="col-xs-3">
                <label for="hora_fin">Hora Fin</label>
                <input name="hora_fin" class="form-control" id="hora_fin" onchange="time()" type="time" value="<?php echo $vis->vis_inf_hora_fin; ?>"  required="">
            </div>
            <div class="col-xs-6">
                <label>Dirección Visita </label>
                <input type="text" name="direccion" id="direccion" value="<?php echo $vis->vis_inf_direccion; ?>" class="form-control" placeholder="Ingrese dirección visita" data-validacion-tipo="requerido" />
            </div>
        </div>
        <input type="hidden" id="duracion" name="duracion" value="<?php echo $vis->vis_inf_duracion; ?>">
        <div class="form-group row">
            <div class="col-xs-4">
                <label>Municipio </label>
                <select name="municipio" class="form-control selectpicker" data-live-search="true"  data-validacion-tipo="requerido">
                    <option value="">Seleccione Municipio</option>
                    <?php while($row = $listado_municipios->fetch()){ ?>
                        <?php if($vis->vis_inf_municipio == $row['id']){ ?>
                            <option value="<?php echo $row['id']; ?>" selected=""><?php echo $row['nombre']; ?></option>
                        <?php }else{ ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                    <?php }} ?>
                </select>
            </div>
            <div class="col-xs-4">
                <label>Número Personas Entrevistadas </label>
                <input type="number" name="num_personas" id="num_personas" onkeyup="validarSiNumero(this.value)" value="<?php echo $vis->vis_inf_num_personas; ?>" class="form-control" min="1" placeholder="Ingrese número de personas entrevistadas" data-validacion-tipo="requerido|min:0" />
            </div>
            <div class="col-xs-4">
                <label>Cantidad Visitas Realizadas </label> <a href="#" data-toggle="tooltipEsteban" title="Información! en este campo solo se debe registrar el número de las visitas efectuadas satisfactoriamente dentro de la solicitud"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                <input type="number" name="num_visitasRealizadas" id="num_visitasRealizadas" onkeyup="validarSiNumero(this.value)" value="<?php echo $vis->vis_inf_num_visitas_realizadas; ?>" class="form-control" min="0" placeholder="Ingrese número de visitas realizadas" data-validacion-tipo="requerido|min:1" />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label>Formato</label>
                <input type="hidden" name="vis_inf_formato" value="<?php echo $vis->vis_inf_ruta_formato; ?>" />
                <?php if ($vis->vis_inf_ruta_formato == ''){ ?>
                    <input id="file-1" name="vis_inf_ruta_formato" type="file" placeholder="Ingrese Documento" class="file" required="" data-preview-file-type="any">
                <?php }else{ ?>
                    <input id="file-1" name="vis_inf_ruta_formato" type="file" placeholder="Ingrese Documento" class="file"  data-preview-file-type="any">
                <?php } ?>
            </div>
            <div class="col-xs-6">
                <?php if($vis->vis_inf_ruta_formato != ''): ?>
                    <label>Descargar Informe</label><br>
                    <div class="img-thumbnail " style="border: 0px;">
                        <img src="uploads_informes/Informes_Seguimiento/<?php echo $_SESSION['idUsuario'].'/'.$vis->vis_inf_ruta_formato; ?>" style="width:40%; " />
                        <a href="uploads_informes/Informes_Seguimiento/<?php echo $_SESSION['idUsuario'].'/'.$vis->vis_inf_ruta_formato; ?>" target="_blank" style="text-decoration:none;"><i class="icon-download3"></i>Descargar</a>
                    </div>
                <?php endif; ?>            
            </div>
        </div>
        <div class="form-group">
            <label>Observaciones</label>
            <textarea class="form-control" name="comentarios" id="comment" rows="5" placeholder="Observaciones del informe seguimiento"><?php echo $vis->vis_inf_observaciones; ?></textarea>
        </div> 
       
        <hr />
        <div class="text-right">
            <button class="btn btn-success" id="btn_guardar"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
        </div>
    </form>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#frm-informe_seguimiento").submit(function(){
                return $(this).validate();
            });
        });
         $(document).ready(function(){
            $('[data-toggle="tooltipEsteban"]').tooltip();   
        });

        function validarSiNumero(numero){
            if (!/^([0-9])*$/.test(numero) ){
                alert("Por favor ingrese solo números");
                document.getElementById("btn_guardar").disabled=true;
            }else{
                document.getElementById("btn_guardar").disabled=false;
            }
        };
    </script>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>