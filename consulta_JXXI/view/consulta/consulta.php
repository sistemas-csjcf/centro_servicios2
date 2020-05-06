<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user = $_SESSION['idUsuario'];
    // JUAN ESTEBAN MUNERA BETANCUR
    $modelo         = new Consulta();
    
    
    $us                   = $_SESSION['idUsuario'];
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '38';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
    
if(isset($id_user)){
    if( in_array($_SESSION['idUsuario'], $usuariosa) ){
?>
    <input type="hidden" name="id_user" value="<?php echo $us ?>"id="id_user" />
    <div class="well well-sm text-left">
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="fecha_fin">Radicado:</label>
                <input type="number" name="radicado" id="radicado" class="form-control" placeholder="Ingrese Radicado" />
            </div>
            <div class="col-xs-6">
                <a href="#" id="filtro" class="btn btn-primary glyphicon glyphicon-search" onclick="buscar_proceso()"> Buscar Proceso</a>
                <a class="btn btn-default glyphicon glyphicon-repeat" onclick="location.reload();"> Refrescar</a>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="demandante">Demandante:</label>
                <input type="text" id="demandante" class="form-control" placeholder="Ingrese Nombre Demandante" />
            </div>
            <div class="col-xs-4">
                <label for="cedula">Cédula:</label>
                <input type="text" id="cedula1" class="form-control" placeholder="Ingrese Cédula Demandante" />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="demandado">Demandado:</label>
                <input type="text" id="demandado" class="form-control" placeholder="Ingrese Nombre Demandado" />
            </div>
            <div class="col-xs-4">
                <label for="fecha_fin">Cédula:</label>
                <input type="text" name="cedula2" id="cedula2" class="form-control" placeholder="Ingrese Cédula Demandado" />
            </div>
        </div>
    </div>
    <div id="load" align="center"></div>
    <script type="text/javascript">
            $(document).ready(function(){
                $(document).on('click', '#modal_Partes', function(e){
                    // Definimos las variables de javascrpt 
                    var radicado = $(this).data('radi');
                    // Ejecutamos AJAX 
                    $("#dynamic-datosPartes").load("view/consulta/dynamic/Modal_datos_Proceso.php",{radicado}); 
                }); 
            }); 
            $('#Modal_ver').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); 
                var rad = button.data('radi');
                var modal = $(this); 
                modal.find('.modal-body label[id="empleado"]').val(rad); 
            });
        </script>
    <div id="filtro_consulta"></div>
    <script>
        $(document).ready(function() {
            $('#example55').DataTable();
        } );
    </script> 
    <?php }else{ ?> 
        <h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para acceder a esta opción</h4>
    <?php } ?> 
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } 