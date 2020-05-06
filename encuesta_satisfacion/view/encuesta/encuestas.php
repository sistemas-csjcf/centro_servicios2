<?php
    $id_user = $_SESSION['idUsuario'];
    $modelo         = new Encuesta();
   
    $datosusuarioacciones = $modelo->get_lista_usuario_accionesJE(33);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);
    
    $datosUSacciones    = $modelo->get_lista_usuario_accionesJE(36);
    $usuarios_encu      = $datosUSacciones->fetch();
    $encuestadores      = explode("////",$usuarios_encu[usuario]);
    $id_encuestadores   = implode(",0", $encuestadores);
    //print_r($encuestadores);
    $datos_encu    = $modelo->get_lista_usuario_encuestadores($id_encuestadores);
    
    date_default_timezone_set('America/Bogota'); 
    $fecha  = date('Y-m-d');
    
    if(isset($id_user)){
        if ( in_array($_SESSION['idUsuario'],$usuariosa) ) {
?>
    <h1 class="page-header">Encuestas</h1>
    <a href="?c=encuesta&a=Excel_ALLencuestas" style="text-decoration: none" class=""><i class="fa fa-file-excel-o" aria-hidden="true"></i> Generar Excel</a>
    <div id="tb_inicial">
        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th style="width:18px;">ID</th>
                    <th style="width:18px;">Fecha</th>
                    <th>Empleado</th>
                    <th>Encuestado</th>
                    <th style="width:120px;">Calificaciòn</th>
                    <th style="width:120px;">Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($this->model->Listar() as $r): ?>
                    <tr>
                        <td><?php echo $r->enc_id; ?></td>
                        <td><?php echo $r->enc_fecha; ?></td>
                        <td><?php echo $r->empleado; ?></td>
                        <td><?php echo $r->encuestado; ?></td>
                        <td><?php echo $r->enc_calificacion; ?></td>
                        <td><?php echo $r->enc_observaciones; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php }else{ ?> 
        <h4 style="text-align: center; color: red"><img src="../views/images/close.jpg" width="40px" /> No tienes privilegios de usuario para acceder a esta opción</h4>
    <?php } ?> 
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>