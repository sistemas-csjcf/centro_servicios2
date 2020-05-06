<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user              = $_SESSION['idUsuario'];
    // JUAN ESTEBAN MUNERA BETANCUR
    // ADMIN
    $modelo               = new HojaVida();
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '28';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);

    //PLANTA DE PERSONAL
    $idaccionPP             = '30';
    $datosusuarioaccionesPP = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccionPP,$campoordenar);
    $usuariosPP             = $datosusuarioaccionesPP->fetch();
    $usuariosaPP            = explode("////",$usuariosPP[usuario]);
    
    if(isset($id_user)){
        if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
?>
    <h1 class="page-header">Planta de Personal</h1>
    <table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr tyle="background-color: #4682B4; color: white;">
                <th colspan="4" style="text-align: center">PROPIEDAD </th>
                <th colspan="4" style="text-align: center; color: green;">PROVISIONALIDAD</th>
            </tr>
            <tr style="background-color: #4682B4; color: white;">
                <th title="Código Registro" style="width:12px;">ID</th>
                <th>Nombre Cargo</th>
                <th>Número Cédula</th>
                <th>Nombre Empleado</th>
                <th>Resolución</th>
                <th>Número Cédula</th>
                <th>Nombre Empleado</th>
                <th>Ubicación</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($this->model->Lista_Planta_Personal() as $r): ?>
                <tr>
                    <?php if($r->pla_id_clase_nombra == 1){ ?>
                        <td><?php echo $r->pla_id; ?></td>
                        <td><?php echo $r->car_titulo; ?></td>
                        <td><?php echo $r->cedula; ?></td>
                        <td><?php echo $r->empleado; ?></td>
                        <td><?php echo $r->pla_num_resolucion; ?></td>
                        <td><?php echo $r->cedulaR; ?></td>
                        <td><?php echo $r->empleadoR; ?></td>
                        <td><?php echo $r->ubi_titulo." - ".$r->are_titulo; ?></td>
                        
                        <!--<td><a href="?c=Hoja_vida&a=Ver_HV_US&id=<?php echo $r->id; ?>" class="btn btn-success" title="Agregar Información Hoja Vida" style="text-decoration: none;"><i class="glyphicon glyphicon-plus-sign"></i></a></td>-->
                        <?php if ( in_array($_SESSION['idUsuario'],$usuariosaPP) ){ ?>
    <!--                        <td><a href="?c=Hoja_vida&a=Crud_plantaPersonal&id=<?php echo $r->id; ?>" class="btn btn-info" title="Agregar Información Planta de Personal" style="text-decoration: none;"><i class="glyphicon glyphicon-plus-sign"></i></a></td>-->
                        <?php }else{ ?>
                            <!--<td><i class="icon-cancel-circle" style="color: red; font-size: 21px;" title="Sin Privilegios"></i></td>-->
                        <?php } ?>
                    <?php }else{ ?>
                        <td><?php echo $r->pla_id; ?></td>
                        <td><?php echo $r->car_titulo; ?></td>
                        <td>
                            <?php 
                                if($r->cedulaR !=''){
                                    echo $r->cedulaR; 
                                }else{
                                    echo "VACANTE DEFINITIVA";
                                }
                            ?>
                        </td>
                        <td><?php echo $r->empleadoR; ?></td>
                        <td><?php echo $r->pla_num_resolucion; ?></td>
                        <td><?php echo $r->cedula; ?></td>
                        <td><?php echo $r->empleado; ?></td>
                        <td><?php echo $r->ubi_titulo." - ".$r->are_titulo; ?></td>
                        <!--<th><a href="#" class="btn btn-primary" title="Ver Hoja Vida" id="modal_Ver" data-toggle="modal" data-target="#Modal_ver_HV" data-id_us="<?php echo $r->id; ?>"data-empleado="<?php echo $r->empleado; ?>" ><i class="glyphicon glyphicon-search"></i></a></th>-->
                        <!--<td><a href="?c=Hoja_vida&a=Ver_HV_US&id=<?php echo $r->id; ?>" class="btn btn-success" title="Agregar Información Hoja Vida" style="text-decoration: none;"><i class="glyphicon glyphicon-plus-sign"></i></a></td>-->
                         
                    <?php } ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Modal-->
    <div class="modal fade" id="Modal_ver_HV" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        <i class="glyphicon glyphicon-info-sign"></i> Hoja de Vida <label for="empleado" id="empleado"></label>
                    </h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <div id="dynamic-datosBasicos"></div>
                    <div id="dynamic-Formacion_Academica"></div>
                    <div id="dynamic-Experiencia_Laboral"></div>
                    <div id="dynamic-referencias"></div>
                    <div id="dynamic-pdf_HV"></div>
                    <hr />
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('click', '#modal_Ver', function(e){
                // Definimos las variables de javascrpt 
                var idUS = $(this).data('id_us');
                // Ejecutamos AJAX 
                $("#dynamic-datosBasicos").load("view/Hoja_vida/dynamic/datos_personal.php",{idUS}); 
                $("#dynamic-Formacion_Academica").load("view/Hoja_vida/dynamic/Formacion_Academica.php",{idUS}); 
                $("#dynamic-Experiencia_Laboral").load("view/Hoja_vida/dynamic/Experiencia_Laboral.php",{idUS}); 
                $("#dynamic-referencias").load("view/Hoja_vida/dynamic/Referencia_personal.php",{idUS}); 
                $("#dynamic-pdf_HV").load("view/Hoja_vida/dynamic/crear_PDF.php",{idUS}); 
            }); 
        }); 
        $('#Modal_ver_HV').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); 
            var id                  = button.data('id');
            var empleado            = button.data('empleado');
            $('#empleado').html(empleado);
            
            var idInfo              = button.data('id1');
            
//            var user                = button.data('user');
//            var ruta                = button.data('ruta');
//            if (ruta !=""){
//                var rutaFormato     = "uploads_informes/Informes_Seguimiento/"+user+"/"+ruta;
//            }else{
//                var rutaFormato     = "#";
//            }

            var modal = $(this);
            modal.find('.modal-body input[name="id"]').val(id); 
            modal.find('.modal-body label[id="empleado"]').val(empleado); 
            modal.find('.modal-body input[name="idInfo"]').val(idInfo);
            //modal.find(document.getElementById("ruta").setAttribute("href",rutaFormato));
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
            $('#example1').DataTable();
            $('#example2').DataTable();
            $('#example3').DataTable();
            $('#example4').DataTable();
            $('#example_historial').DataTable( {
                "order": [[ 0, "desc" ]]
            });
            $('#example_order').DataTable( {
                "order": [[ 2, "asc" ]]
            });
        } );
        $('.selectpicker').selectpicker({
            style: 'btn-info',
            size: 4
        });
        function Descargar_HV(id_empleado){
    alert("id "+id_empleado);
    //location.href="?c=hoja_vida&a=Generar_PDF_HV&id_empleado="+id_empleado;
    
    //window.open("view/Hoja_vida/Generar_PDF_hv.php?id_empleado="+id_empleado)
}
    </script>
<?php }}else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>