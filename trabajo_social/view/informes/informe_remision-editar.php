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
    if(isset($id_user)){
?>
    <h3 class="page-header ">
        <?php echo $vis->vis_pro_id != null ? $vis->vis_pro_radicado : 'Nuevo Registro'; ?>
    </h3>
    <?php 
        function fechaCastellano ($fecha) {
            $fecha = substr($fecha, 0, 10);
            $numeroDia = date('d', strtotime($fecha));
            $dia = date('l', strtotime($fecha));
            $mes = date('F', strtotime($fecha));
            $anio = date('Y', strtotime($fecha));
            $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
            $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
            $nombredia = str_replace($dias_EN, $dias_ES, $dia);
            $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
            $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
            $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
            return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
        }
    ?>
    <ol class="breadcrumb">
        <li><a href="?c=Visitas&a=Listado_InformesRemision" style="text-decoration:none;">Informe Visitas</a></li>
        <li class="active"><?php echo $vis->vis_pro_id != null ? $vis->vis_pro_radicado : 'Nuevo Registro'; ?></li>
    </ol>
    <table id="example" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr style="background-color: #2E8B57; color: white;">
                <th title="Código Seguimiento Informe">Id Seguimiento</th>
                <th title="Código Solicitud Visita">Id Visita</th>
                <th>Fecha Visita</th>
                <th>Fecha Presentación</th>
                <th>Asistente Social</th>
                <th>Radicado</th>
                <th>Sub-Clase Proceso</th>
                <th>Despacho Solicitante</th>
                <th>Municipio</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $vis->vis_inf_id; ?></td>
                <td><?php echo $vis->vis_inf_id_visProgramacion; ?></td>
                <td><?php echo $vis->vis_pro_fecha_visita; ?></td>
                <td><?php echo $vis->inf_rem_fecha_presentacion; ?></td>
                <td><?php echo $vis->vis_TSoci_nombre; ?></td>
                <td><?php echo $vis->vis_pro_radicado; ?></td>
                <td><?php echo $vis->vis_pro_subclase_proceso; ?></td>
                <td><?php echo $vis->vis_pro_solicitante; ?></td>
                <td><?php echo $vis->nombre_municipio; ?></td>
            </tr>
        </tbody>
    </table>
    <form id="frm-informe_remision" action="?c=Visitas&a=Guardar_Informe_Remision" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $vis->inf_rem_id; ?>" />
        <input type="hidden" name="fecha_presentacion" id="fecha_presentacion" value="<?php echo $vis->inf_rem_fecha_presentacion ?>">
        <input type="hidden" name="num_oficio" id="num_oficio" value="<?php echo $vis->inf_rem_num_oficio ?>">
        <input type="hidden" name="juzgadoSolicitante" id="juzgadoSolicitante" value="<?php echo $vis->vis_pro_solicitante ?>">
        <div class="form-group">
            <label>Nº Folios</label>
            <input type="number" name="num_folios" id="num_folios" value="<?php echo $vis->inf_rem_num_folios; ?>" class="form-control" placeholder="Ingrese número folios" data-validacion-tipo="requerido" min="1" />
        </div>   
        <div class="form-group">
            <label>Observaciones</label>
            <textarea class="form-control" name="comentarios" id="comment" rows="5" placeholder="Observaciones del informe seguimiento"><?php echo $vis->inf_rem_observaciones; ?></textarea>
        </div> 

        <div class="form-group row">
            <div class="col-xs-6">
                <?php if($vis->vis_inf_ruta_formato != ''): ?>
                    <div class="img-thumbnail " style="border: 0px;">
                        <img src="uploads_informes/Informes_Seguimiento/<?php echo $vis->vis_inf_id_usuario.'/'.$vis->vis_inf_ruta_formato; ?>" style="width:40%; " />
                        <a href="uploads_informes/Informes_Seguimiento/<?php echo $vis->vis_inf_id_usuario.'/'.$vis->vis_inf_ruta_formato; ?>" target="_blank" style="text-decoration:none;" title="Descargar Formato"><i class="icon-download3"></i>Descargar</a>
                    </div>
                <?php endif; ?>            
            </div>
        </div>
        <div class="form-group" style="display: none">
            <label>Contenido</label>
            <textarea class="form-control" name="contenido" id="contenido" rows="5" placeholder="Contenido del Documento">De acuerdo con la solicitud de visita de código <?php echo $vis->inf_rem_id ?> del <?php echo $vis->vis_pro_fecha_visita; ?>, donde solicitan la realización de Visita Social, para proceso de <?php echo $vis->vis_pro_subclase_proceso; ?>, radicado <?php echo $vis->vis_pro_radicado; ?>, el mismo fue entregado en el Área de Trabajo Social el <?php echo fechaCastellano($vis->vis_pro_fechaEstado) ?>, correspondiéndole por reparto, cumplir con lo dispuesto a la Trabajadora Social <?php echo $vis->vis_TSoci_nombre; ?>, quien ya efectuó el correspondiente Informe el cual se anexa.</textarea>
        </div> 
        <hr />
        <div class="text-right">
            <button class="btn btn-success" id="btn_guardar"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
        </div>
    </form>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#frm-informe_remision").submit(function(){
                return $(this).validate();
            });
        });

        function validarSiNumero(numero){
            if (!/^([0-9])*$/.test(numero) ){
                alert("Por favor ingrese solo números");
                document.getElementById("btn_guardar").disabled=true;
            }else{
                document.getElementById("btn_guardar").disabled=false;
            }
        }
    </script>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>