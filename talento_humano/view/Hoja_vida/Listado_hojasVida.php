<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user              = $_SESSION['idUsuario'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo               = new HojaVida();
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '28';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
    
    $camposF               = 'usuario';
    $nombrelistaF          = 'pa_usuario_acciones';
    $idaccionF             = '29';
    $campoordenarF         = 'id';
    $datosusuarioaccionesF = $modelo->get_lista_usuario_acciones($camposF,$nombrelistaF,$idaccionF,$campoordenarF);
    $usuariosF             = $datosusuarioaccionesF->fetch();
    $usuariosaF            = explode("////",$usuariosF[usuario]);
    //PLANTA DE PERSONAL
    $idaccionPP             = '30';
    $datosusuarioaccionesPP = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccionPP,$campoordenar);
    $usuariosPP             = $datosusuarioaccionesPP->fetch();
    $usuariosaPP            = explode("////",$usuariosPP[usuario]);

    if(isset($id_user)){
        if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
?>
    <h1 class="page-header">Hojas de Vida</h1>
    <div class="form-group row">
        <div class="col-xs-9">
            <ol class="breadcrumb">
                <li><a href="?c=hoja_vida&a=Listado_PlantaPersonal" style="text-decoration: none;"><span class="fa fa-users" title="REPORTE PLANTA DE PERSONAL" style="color: green; font-size: 30px;"></span></a></li>
                <li><a href="javascript:void(0);" onclick="Reporte_Excel(2)" title="CONSOLIDADO DE PERMISOS" style="text-decoration: none;"><span class="icon-stackoverflow" style="color: skyblue; font-size: 30px;"></span></a></li>
                <li><a href="?c=hoja_vida&a=Listado_Vencimiento_Licencias" title="REPORTE VENCIMIENTO DE LICENCIAS" style="text-decoration: none;"><span class="icon-clock" style="font-size: 30px; color: red;"></span></a></li>
            </ol>
        </div>
        <?php if ( in_array($_SESSION['idUsuario'],$usuariosaF) ){ ?>
            <div class="col-xs-3">
                <ol class="breadcrumb">
                    <li><a class="btn btn-primary" href="?c=hoja_vida&a=Crud&band=44"><i class="glyphicon glyphicon-plus-sign"></i> Nuevo Registro</a></li>
                </ol>
            </div>
        <?php } ?>
    </div>
    <table id="example_order" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr style="background-color: #4682B4; color: white;">
                <th title="Código Usuario" style="width:12px;">ID</th>
                <th>Número Cédula</th>
                <th>Empleado</th>
                <th title="Ver Hoja Vida">Ver</th>
                <th title="Agregar Información Hoja Vida">Agregar</th>
                <th title="Ver Hoja Vida">Planta de Personal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($this->model->ListarUsuariosHV() as $r): ?>
                <?php $id_empleado = $r->id; ?>
                <tr>
                    <td><?php echo $r->id; ?></td>
                    <td><?php echo $r->cedula; ?></td>
                    <td><?php echo $r->empleado; ?></td>
                    <th><a href="#" class="btn btn-primary" id="modal_Ver" data-toggle="modal" data-target="#Modal_ver_HV" data-id_us="<?php echo $r->id; ?>"data-empleado="<?php echo $r->empleado; ?>" ><i class="glyphicon glyphicon-search"></i></a></th>
                    <td><a href="?c=Hoja_vida&a=Ver_HV_US&id=<?php echo $r->id; ?>" class="btn btn-success" style="text-decoration: none;"><i class="glyphicon glyphicon-plus-sign"></i></a></td>
                    <?php if ( in_array($_SESSION['idUsuario'],$usuariosaPP) ){ ?>
                        <td><a href="?c=Hoja_vida&a=Crud_plantaPersonal&id=<?php echo $r->id; ?>" class="btn btn-info" title="Agregar Información Planta de Personal" style="text-decoration: none;"><i class="glyphicon glyphicon-plus-sign"></i></a></td>
                    <?php }else{ ?>
                        <td><i class="icon-cancel-circle" style="color: red; font-size: 21px;" title="Sin Privilegios"></i></td>
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
                    <!--<div id="dynamic-referencias"></div>-->
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
                //$("#dynamic-referencias").load("view/Hoja_vida/dynamic/Referencia_personal.php",{idUS}); 
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