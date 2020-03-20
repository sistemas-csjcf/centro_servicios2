<?php
    $id_user = $_SESSION['idUsuario'];
    $modelo         = new Tutela();
    
    $datos_juzgado = $modelo->get_Juzgados_us($id_user);
    //get_codigo_Despacho
    while($r = $datos_juzgado->fetch()){
        $lista_juzgado[] = $r[0];
    }
    date_default_timezone_set('America/Bogota'); 
    $fecha  = date('Y-m-d');
    $flag=1;
    if($flag ==1){
        $texto =" Correcto Esteban. ";
        $tipo    = "success";
        $icono  = "address-book";
        //echo $mensaje_alerta   = $modelo->displayAlert($texto,$tipo,$icono);
    }
    
    if(isset($id_user)){
?>
    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                $("#content").fadeOut(1500); 
            },3000);
        });
    </script>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <strong><i class="fa fa-warning"></i> Atención!</strong> 
        <marquee><p style="font-family: Impact; font-size: 18pt">Alerta Tutela!</p></marquee>
    </div>
    <div id="tb_inicial">
        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #4682B4; color: white;">
                    <th title="Código Interno Tutela">ID</th>
                    <th>Radicado</th>
                    <th>Juzgado</th>
                    <th style="width:120px;">Fecha Registro</th>
                    <th>Fecha Vencimiento</th>
                    <th>Días</th>
                   
                    <th>Asignar Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($this->model->alerta_tutela() as $r): ?>
                    <tr>
                        <td><?php echo $r->tut_id; ?></td>
                        <td><?php echo $r->tut_radicado; ?></td>
                        <td><?php echo $r->tut_despacho; ?></td>
                        <td><?php echo $r->tut_fecha_reparto; ?></td>
                        <td class="alert alert-danger"><?php echo $r->tut_fecha_vencimiento; ?></td>
                        <td><?php echo $r->tut; ?> <i class="glyphicon glyphicon-warning-sign gly-spin"></i></td>
                        <th><a href="#" class="btn btn-primary" title="Asignar Fecha Fallo de tutela" id="modal_Fallo" data-toggle="modal" data-target="#Modal_FalloTutelaXXXXX" data-id_tutela="<?php echo $r->tut_id; ?>" ><i class="fa fa-calendar-times-o"></i></a></th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Modal EDITAR REFERENCIAS PERSONALES-->
    <div class="modal fade" id="Modal_FalloTutela" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Asignar Fecha Fallo Tutela <icon class="fa fa-calendar"></icon>
                    </h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form role="form" action="?c=tutela&a=registrar_fecha_fallo" method="post" >
                        <div class="form-group">
                            <input type="text" readonly="" class="form-control" name="id" id="id" placeholder="id tutela"/>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Fecha Fallo Tutela</label>
                            <input readonly="" type="text" name="fecha_fallo" value="" class="form-control datepicker" placeholder="Ingresar Fecha Fallo Tutela">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary"><span class="icon-floppy-disk"></span> Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#Modal_FalloTutela').on('show.bs.modal', function (event) {
            var button  = $(event.relatedTarget) 
            var id      = button.data('id_tutela')
            
            var modal = $(this)
            modal.find('.modal-body input[name="id"]').val(id)
        })
    </script>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>