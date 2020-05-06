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
    if(isset($id_user)){
?>
    <h1 class="page-header">Permiso de Estudio</h1>
    <ol class="breadcrumb">
        <li><a href="?c=hoja_vida">Permisos</a></li>
        <li class="active">Nuevo Registro</li>
    </ol>
    <form id="frm-TH_Permisos" action="?c=Hoja_vida&a=Guardar_Permiso_Estudio" method="post" enctype="multipart/form-data">
        <input type="hidden" name="per_est_id" value="<?php echo $per->per_est_id; ?>" />
        <input type="hidden" name="idUser" value="<?php echo $id_user; ?>" />
        <?php if ( in_array($_SESSION['idUsuario'],$usuariosa) ) { ?>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="check_other" onchange="Check_other()">
                <label class="form-check-label" for="exampleCheck1">Permiso Foráneo</label>
                <input type="hidden" id="flag_foraneo" value="0">
            </div><br>
            <div class="form-group row" id="datos_other" style="display: none;">
                <div class="col-xs-6">
                    <i class="fa fa-address-card-o" aria-hidden="true"></i> <label>Nº Cèdula </label>
                    <input type="text" id="other_cedula" name="cedula_other" class="form-control" onKeyUp="Traer_Datos_Partes_Reg(this.value)" placeholder="Ingrese N° Cédula">
                </div>
                <div class="col-xs-6">
                    <i class="fa fa-user"></i> <label>Nombre Completo </label>
                    <input type="text" id="other_nombre" name="nombre_other" class="form-control" placeholder="Nombre Completo" readonly="">
                </div>
            </div><br />
        <?php } ?>
        <div class="form-group row">
            <div class="col-xs-6">
                <i class="fa fa-university" aria-hidden="true"></i> <label>Institución </label>
                <input type="text" name="institucion" id="instirucion" value="<?php echo $per->per_nombres; ?>" class="form-control" placeholder="Ingrese Nombre Institución Académica" data-validacion-tipo="requerido|min:5" /> 
            </div>
            <div class="col-xs-6">
                <i class="fa fa-graduation-cap" aria-hidden="true"></i> <label>Título Programa</label>
                <input type="text" name="programa" id="titulo" value="<?php echo $per->per_apellidos; ?>" class="form-control" placeholder="Ingrese Título del Programa" data-validacion-tipo="requerido|min:5" />     
            </div>
        </div><br>
        <div class="form-group row">
            <div class="col-xs-6">
                <i class="glyphicon glyphicon-calendar" aria-hidden="true"></i> <label for="Fecha Inicio">Fecha Incio</label>
                <input type="date" name="fechaI" required="" class="form-control">
            </div>
            <div class="col-xs-6">
                <i class="glyphicon glyphicon-calendar" aria-hidden="true"></i> <label for="Fecha Final">Fecha Final</label>
                <input type="date" name="fechaF" class="form-control">
            </div>
        </div><br>
        <div class="form-group row">
            <div class="col-xs-6">
                <i class="glyphicon glyphicon-comment" aria-hidden="true"></i> <label> Período Académico  </label>
                <input type="text" name="per_academico" id="per_academico" value="" class="form-control" placeholder="Ingrese Período Académico" data-validacion-tipo="requerido|min:5" /> 
            </div>
        </div><br />

        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #4682B4; color: white;">
                    <th title="Código Usuario" style="width:12px;">ACTIVAR</th>
                    <th>DÍA</th>
                    <th>HORA INICIO</th>
                    <th>HORA FIN</th>
                    <th title="Código Usuario" style="width:12px;">ACTIVAR</th>
                    <th>HORA INICIO</th>
                    <th>HORA FIN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center">
                        <input type="checkbox" id="check_LN" onchange="check_Lunes()">
                        <input type="hidden" value="0" id="cod_lunes" name="m_lunes[]">
                    </td>
                    <td><input type="hidden" value="LUNES" name="m_lunes[]">LUNES</td>
                    <td><input type="time" id="lunes"  class="form-control" name="m_lunes[]" onblur="clic1(this.value)"  disabled="" min="08:00" value="null"></td>
                    <td><input type="time" id="lunes1" class="form-control" name="m_lunes[]"     disabled="" max="18:00" value="null"></td>
                    <td style="text-align: center">

                        <input type="checkbox" id="check_LN1" onchange="check_Lunes1()">
                        <input type="hidden" value="0" id="flag_lunes" name="m_lunes[]">
                    </td>
                    <td><input type="time" id="lunes2" class="form-control" name="m_lunes[]" disabled="" min="08:00" value="null"></td>
                    <td><input type="time" id="lunes3" class="form-control" name="m_lunes[]"    disabled="" max="18:00" value="null"></td>
                </tr>
                <tr>
                    <td style="text-align: center">
                        <input type="checkbox" id="check_MT" onchange="check_Martes()">
                        <input type="hidden" value="0" id="cod_martes" name="m_martes[]">
                    </td>
                    <td><input type="hidden" value="MARTES" name="m_martes[]">MARTES</td>
                    <td><input type="time" id="martes"  class="form-control" name="m_martes[]"  disabled="" min="08:00" ></td>
                    <td><input type="time" id="martes1" class="form-control" name="m_martes[]"     disabled="" max="18:00" ></td>
                    <td style="text-align: center">
                        <input type="checkbox" id="check_MT1" onchange="check_Martes1()">
                        <input type="hidden" value="0" id="flag_martes" name="m_martes[]">
                    </td>
                    <td><input type="time" id="martes2" class="form-control" name="m_martes[]" disabled="" min="08:00" value="<?php echo $per->sol_per_hora_inicio; ?>"></td>
                    <td><input type="time" id="martes3" class="form-control" name="m_martes[]"    disabled="" max="18:00" value="<?php echo $per->sol_per_hora_inicio; ?>"></td>
                </tr>
                <tr>
                    <td style="text-align: center">
                        <input type="checkbox" id="check_MI" onchange="check_Miercoles()">
                        <input type="hidden" value="0" id="cod_miercoles" name="m_miercoles[]">
                    </td>
                    <td><input type="hidden" value="MIERCOLES" name="m_miercoles[]">MIERCOLES</td>
                    <td><input type="time" id="miercoles"  class="form-control" name="m_miercoles[]"  disabled="" min="08:00" value="<?php echo $per->sol_per_hora_inicio; ?>"></td>
                    <td><input type="time" id="miercoles1" class="form-control" name="m_miercoles[]"     disabled="" max="18:00" value="<?php echo $per->sol_per_hora_inicio; ?>"></td>
                    <td style="text-align: center">
                        <input type="checkbox" id="check_MI1" onchange="check_Miercoles1()">
                        <input type="hidden" value="0" id="flag_miercoles" name="m_miercoles[]">
                    </td>
                    <td><input type="time" id="miercoles2" class="form-control" name="m_miercoles[]" disabled="" min="08:00" value="<?php echo $per->sol_per_hora_inicio; ?>"></td>
                    <td><input type="time" id="miercoles3" class="form-control" name="m_miercoles[]"    disabled="" max="18:00" value="<?php echo $per->sol_per_hora_inicio; ?>"></td>
                </tr>
                <tr>
                    <td style="text-align: center">
                        <input type="checkbox" id="check_JU" onchange="check_Jueves()">
                        <input type="hidden" value="0" id="cod_jueves" name="m_jueves[]">
                    </td>
                    <td><input type="hidden" value="JUEVES" name="m_jueves[]">JUEVES</td>
                    <td><input type="time" id="jueves"  class="form-control" name="m_jueves[]"  disabled="" min="08:00" value="<?php echo $per->sol_per_hora_inicio; ?>"></td>
                    <td><input type="time" id="jueves1" class="form-control" name="m_jueves[]"     disabled="" max="18:00" value="<?php echo $per->sol_per_hora_inicio; ?>"></td>
                    <td style="text-align: center">
                        <input type="checkbox" id="check_JU1" onchange="check_Jueves1()">
                        <input type="hidden" value="0" id="flag_jueves" name="m_jueves[]">
                    </td>
                    <td><input type="time" id="jueves2" class="form-control" name="m_jueves[]" disabled="" min="08:00" value="<?php echo $per->sol_per_hora_inicio; ?>"></td>
                    <td><input type="time" id="jueves3" class="form-control" name="m_jueves[]"    disabled="" max="18:00" value="<?php echo $per->sol_per_hora_inicio; ?>"></td>
                </tr>
                <tr>
                    <td style="text-align: center">
                        <input type="checkbox" id="check_VR" onchange="check_Viernes()">
                        <input type="hidden" value="0" id="cod_viernes" name="m_viernes[]">
                    </td>
                    <td><input type="hidden" value="VIERNES" name="m_viernes[]">VIERNES</td>
                    <td><input type="time" id="viernes"  class="form-control" name="m_viernes[]"  disabled="" min="08:00" value="<?php echo $per->sol_per_hora_inicio; ?>"></td>
                    <td><input type="time" id="viernes1" class="form-control" name="m_viernes[]"     disabled="" max="18:00" value="<?php echo $per->sol_per_hora_inicio; ?>"></td>
                    <td style="text-align: center">
                        <input type="checkbox" id="check_VR1" onchange="check_Viernes1()">
                        <input type="hidden" value="0" id="flag_viernes" name="m_viernes[]">
                    </td>
                    <td><input type="time" id="viernes2" class="form-control" name="m_viernes[]" disabled="" min="08:00" value="<?php echo $per->sol_per_hora_inicio; ?>"></td>
                    <td><input type="time" id="viernes3" class="form-control" name="m_viernes[]"    disabled="" max="18:00" value="<?php echo $per->sol_per_hora_inicio; ?>"></td>
                </tr>
            </tbody>
        </table>
        <div class="form-group row">
            <div class="col-xs-6">
                <i class="fa fa-file-text-o" aria-hidden="true"></i> <label>Constancia Horario</label>
                <input type="hidden" name="per_doc_horario" value="<?php echo $per->per_est_ruta_doc_horario; ?>" />
                <?php if ($per->per_est_ruta_doc_horario == ''){ ?>
                    <input id="file-1" name="per_est_ruta_doc_horario" type="file" placeholder="Ingrese Documento" class="file" required="" data-preview-file-type="any">
                <?php }else{ ?>
                    <input id="file-1" name="per_est_ruta_doc_horario" type="file" placeholder="Ingrese Documento" class="file" value="<?php echo "ruta xxx"; ?>" data-preview-file-type="any">
                <?php } ?>
            </div>
            <div class="col-xs-6">
                <i class="fa fa-file-text-o" aria-hidden="true"></i> <label>Constancia Matricula</label>
                <input type="hidden" name="per_doc_matricula" value="<?php echo $per->per_est_ruta_doc_constancia; ?>" />
                <?php if ($per->per_est_ruta_doc_constancia == ''){ ?>
                    <input id="file-1" name="per_est_ruta_doc_matricula" type="file" placeholder="Ingrese Documento" class="file" required="" data-preview-file-type="any">
                <?php }else{ ?>
                    <input id="file-1" name="per_est_ruta_doc_matricula" type="file" placeholder="Ingrese Documento" class="file" value="<?php echo "ruta xxx"; ?>" data-preview-file-type="any">
                <?php } ?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <?php if($per->per_est_ruta_doc_horario != ''): ?>
                    <div class="img-thumbnail " style="border: 0px;">
                        <a href="Documentos_TH/Constancias_Horarios/<?php echo $per->per_est_ruta_doc_horario; ?>" target="_blank" style="text-decoration:none;"><i class="icon-download3"></i>Descargar</a>
                    </div>
                <?php endif; ?>            
            </div>
            <div class="col-xs-6">
                <?php if($per->per_est_ruta_doc_constancia != ''): ?>
                    <div class="img-thumbnail " style="border: 0px;">
                        <a href="uploads_informes/Comprobantes_Matriculas/<?php echo $per->per_est_ruta_doc_matricula; ?>" target="_blank" style="text-decoration:none;"><i class="icon-download3"></i>Descargar</a>
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
        }
        function clic1(valor){
            //alert(valor);
        }
    </script>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.30/centro_servicios2" ); } ?>