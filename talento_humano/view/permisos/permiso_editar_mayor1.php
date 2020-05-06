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
    <h1 class="page-header">Registrar permiso mayor a un día</h1>
    <ol class="breadcrumb">
        <li><a href="?c=hoja_vida">Permisos</a></li>
        <li class="active">Nuevo Registro</li>
    </ol>
   <!-- <form id="frm-TH_Permisos" action="?c=Hoja_vida&a=Guardar_Permiso_Estudio" method="post" enctype="multipart/form-data"> -->
        <form onsubmit="return mi_validacion_mayor(this)" id="frm-TH_Permisos" name="frm_permisos" action="?c=Hoja_vida&a=Guardar_Permiso_Mayor" method="post" enctype="multipart/form-data">
        <input type="hidden" name="per_est_id" value="<?php echo $per->per_est_id; ?>" />
        <input type="hidden" id="idUser" name="idUser" value="<?php echo $id_user; ?>" />
        
        <div >
            <label>¿Fuera de la Ciudad? </label>
            <label class="radio-inline"><input type="radio" name="per_out" value="1">Si</label>
            <label class="radio-inline"><input type="radio" name="per_out" value="0" checked="">No</label>
        </div>
        <br />
        
        <?php if ( in_array($_SESSION['idUsuario'], $usuariosa) ) { ?>
            <!--  Para habilitar permiso foraneo, aun sin definir.
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="check_other" onchange="Check_other()">
                <label class="form-check-label" for="exampleCheck1">Permiso Foráneo</label>
                <input type="hidden" id="flag_foraneo" value="0">
            </div>  
            <br> -->
            <div class="form-group row" id="datos_other" style="display: none;">
                <div class="col-xs-6">
                    <i class="fa fa-address-card-o" aria-hidden="true"></i> <label>Nº Cèdula </label>
                    <input type="text" id="other_cedula" name="cedula_other" class="form-control" onkeyup="validarSiNumero(this.value);" placeholder="Ingrese N° Cédula">
                </div>
                <div class="col-xs-6">
                    <i class="fa fa-user"></i> <label>Nombre Completo </label>
                    <input type="text" id="other_nombre" name="nombre_other" class="form-control" placeholder="Nombre Completo">
                </div>
            </div>

        <?php } ?>

        <div class="form-group">
            <label>Detalle</label>
            <textarea class="form-control" name="comentarios" id="comment" rows="5" placeholder="Ingrese Detalle Solicitud Permiso" ></textarea>
        </div>
        <br />

        <div>
            <table>
            <tr>
                <!-- <td><label style="font-size: 16px">Fechas del permiso&nbsp;&nbsp;</label></td> -->
                <td><button class="btn btn-info btn-flat" type="button" name="add" id="add" >Agregar fecha</button></td>
                <td><button class="btn btn-info btn-flat" type="button" name="del" id="del" >Quitar fecha</button></td>
            </tr>
            </table>
        </div>
        <br>
        <input type="hidden" id="h_numero_fecha" name="h_numero_fecha" value="1" />
        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #4682B4; color: white;">
                    <th >FECHA</th>
                    <th>HORA INICIO</th>
                    <th>HORA FIN</th>
                    <th title="Código Usuario" style="width:12px;">TODO EL DÍA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="date" id="fecha1" name="fecha[]" required="" class="form-control" />
                    </td>
                    <td>
                        <input type="time" id="horai1" name="horai[]"  class="form-control" min="08:00" >
                    </td>
                    <td>
                        <input type="time" id="horaf1" name="horaf[]"  class="form-control" max="18:00" >
                    </td>
                    <td style="text-align: center">
                        <input type="checkbox" id="check1" name="seleccion[]" value="1" onchange="check_fecha(this)">
                    </td>
                </tr>
            </tbody>
        </table>
        <br />
        <div class="form-group row">
            <div class="col-xs-6">
                <i class="fa fa-file-text-o" aria-hidden="true"></i> <label>Documento adjunto</label>
                <input type="hidden" name="per_mayor_doc" value="<?php echo $per->per_mayor_ruta_doc; ?>" />
                <?php if ($per->per_mayor_ruta_doc == '') { ?>
                    <input id="file-1" name="per_mayor_ruta_doc" type="file" placeholder="Ingrese Documento" class="file"  data-preview-file-type="any" required="">
                <?php } else { ?>
                    <input id="file-1" name="per_mayor_ruta_doc" type="file" placeholder="Ingrese Documento" class="file" value="<?php echo "ruta xxx"; ?>" data-preview-file-type="any">
                <?php } ?>
            </div>
        </div>    
        <div class="form-group row">
            <div class="col-xs-6">
                <?php if($per->per_mayor_ruta_doc != ''): ?>
                    <div class="img-thumbnail " style="border: 0px;">
                        <a href="Documentos_TH/Constancias_Horarios/<?php echo $per->per_mayor_ruta_doc; ?>" target="_blank" style="text-decoration:none;"><i class="icon-download3"></i>Descargar</a>
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