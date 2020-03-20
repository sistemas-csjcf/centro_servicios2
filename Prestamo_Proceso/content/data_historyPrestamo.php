<?php
session_start();
//JUAN ESTEBAN MÙNERA BETANCUR
    $id         = $_REQUEST['id'];
    $fecha      = $_REQUEST['fecha'];
    $fecha1     = $_REQUEST['fecha1'];
    $fecha2     = $_REQUEST['fecha2'];
    $fecha3     = $_REQUEST['fecha3'];
    $fecha4     = $_REQUEST['fecha4'];
    $usuario    = $_REQUEST['user'];
    $usuario1   = $_REQUEST['user1'];
    $usuario2   = $_REQUEST['user2'];
    $usuario3   = $_REQUEST['user3'];
    $usuario4   = $_REQUEST['user4'];
    $observacion_fecha0 = $_REQUEST['observacion_f0'];
    //echo $fecha1;
?>
<h2>Historia del Prestamo Proceso</h2>
    <table id="example1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr style="background-color: #00B300; color: white;">
                <th>Descripción</th>
                <th style="width: 110px">Fecha</th>
                <th style="width: 200px">Usuario Registra</th>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>0. Fecha Entrega Centro de Servicios - Archivo Central</td>
                <?php
                if($fecha1 == "" || $fecha1 == "0000-00-00") // sin registro de fecha1
                {
                    $fuente = "style='font-size: 12px;'";
                    $btnEdit = '<a onclick="editar_fecha()" style="text-decoration: none;">
                                  <span class="icon-pencil" style="font-size: 16px;"></span>
                                </a>';
                }
                ?>
                <td <?php echo $fuente; ?> >
                    <input type="hidden" id="fecha0_hidden" value="<?php echo $fecha;?>" />
                    <strong>
                        <div id="edit_data_fecha"><?php echo $fecha . "&nbsp;" . $btnEdit; ?></div>
                    </strong>
                </td>
                <td><?php echo $usuario; ?></td>
                <td> 
                    <input type="hidden" id="observa_fecha0_hidden" value="<?php echo $observacion_fecha0;?>" />
                    <div id="observa_fecha0"> <?php echo $observacion_fecha0; ?> </div> 
                </td>
            </tr>
            <tr>
                <td>1. Fecha Entrega Archivo Central - Centro de Servicios</td>
                <td><strong><?php echo $fecha1; ?></strong></td>
                <td><?php echo $usuario1; ?></td>
                <td></td>
            </tr>
            <tr>
                <td>2. Fecha Entrega Centro de Servicios - Juzgado</td>
                <td><strong><?php echo $fecha2; ?></strong></td>
                <td><?php echo $usuario2; ?></td>
                <td></td>
            </tr>
            <tr>
                <td>3. Fecha Entrega Juzgado - Centro de Servicios</td>
                <td><strong><?php echo $fecha3; ?></strong></td>
                <td><?php echo $usuario3; ?></td>
                <td></td>
            </tr>
            <tr>
                <td>4. Fecha Entrega Centro de Servicios - Archivo Central</td>
                <td><strong><?php echo $fecha4; ?></strong></td>
                <td><?php echo $usuario4; ?></td>
                <td></td>
            </tr>
        </tbody>
    </table><br/>
<form id="frm-registro" action="?c=Prestamo&a=Actualizar_Prestamo" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
    <input type="hidden" name="user" value="<?php echo $_SESSION['idUsuario']; ?>">
    <h3>Registrar Fecha</h3><br/>
    <?php if($fecha1 =="" || $fecha1 =="0000-00-00"){ ?>
        <div class="form-group row">
            <div class="col-xs-6">
                <label>1. Fecha Entrega Archivo Central - Centro de Servicios</label>
            </div>
            <div class="col-xs-4">
                <input type="hidden" name="user1" value="<?php echo $_SESSION['idUsuario']; ?>">
                <input type="date" class="form-control" name="fecha1" id="fecha1" value="<?php echo $fecha1; ?>" placeholder="Fecha" min="<?php echo $fecha; ?>" required=""/>
            </div>
            <div class="col-xs-2"></div>
    <?php }else if($fecha2 =="" || $fecha2 =="0000-00-00"){ ?>
        <div class="form-group row">
            <div class="col-xs-6">
                <label>2. Fecha Entrega Centro de Servicios - Juzgado</label>
            </div>
            <div class="col-xs-4">
                <input type="hidden" name="user1" value="<?php echo $_REQUEST['id_usF1']; ?>">
                <input type="hidden" name="user2" value="<?php echo $_SESSION['idUsuario']; ?>">
                <input type="hidden" readonly="" class="form-control" name="fecha1" id="fecha1" value="<?php echo $fecha1; ?>" placeholder="Fecha"/>
                <input type="date" <?php echo $readonly2; ?> class="form-control datepicker" name="fecha2" id="fecha2" value="<?php echo $fecha2; ?>" placeholder="Fecha" min="<?php echo $fecha1; ?>" required=""/>
            </div>
            <div class="col-xs-2"></div>
        </div>
    <?php }else if($fecha3 =="" || $fecha3 =="0000-00-00"){ ?>
        <div class="form-group row">
            <div class="col-xs-6">
                <label>3. Fecha Entrega Juzgado - Centro de Servicios</label>
            </div>
            <div class="col-xs-4">
                <input type="hidden" name="user1" value="<?php echo $_REQUEST['id_usF1']; ?>">
                <input type="hidden" name="user2" value="<?php echo $_REQUEST['id_usF2'];; ?>">
                <input type="hidden" name="user3" value="<?php echo $_SESSION['idUsuario']; ?>">
                <input type="hidden" name="fecha1" id="fecha1" value="<?php echo $fecha1; ?>" placeholder="Fecha"/>
                <input type="hidden" name="fecha2" id="fecha2" value="<?php echo $fecha2; ?>" placeholder="Fecha"/>
                <input type="date" class="form-control" name="fecha3" id="fecha3" value="<?php echo $fecha3; ?>" placeholder="Fecha" min="<?php echo $fecha2; ?>" required=""/>
            </div>
            <div class="col-xs-2"></div>
        </div>
    <?php }else if($fecha4 =="" || $fecha4 =="0000-00-00"){ ?>
        <div class="form-group row">
            <div class="col-xs-6">
                <label>4. Fecha Entrega Centro de Servicios - Archivo Central</label>
            </div>
            <div class="col-xs-4">
                <input type="hidden" name="user1" value="<?php echo $_REQUEST['id_usF1']; ?>">
                <input type="hidden" name="user2" value="<?php echo $_REQUEST['id_usF2'];; ?>">
                <input type="hidden" name="user3" value="<?php echo $_REQUEST['id_usF3'];; ?>">
                <input type="hidden" name="user4" value="<?php echo $_SESSION['idUsuario']; ?>">
                <input type="hidden" name="fecha1" value="<?php echo $fecha1; ?>" placeholder="Fecha"/>
                <input type="hidden" name="fecha2" value="<?php echo $fecha2; ?>" placeholder="Fecha"/>
                <input type="hidden" name="fecha3" value="<?php echo $fecha3; ?>" placeholder="Fecha"/>
                <input type="date"   name="fecha4" class="form-control" id="fecha4" value="<?php echo $fecha4; ?>" placeholder="Fecha" min="<?php echo $fecha3; ?>" required=""/>
            </div>
            <div class="col-xs-2"></div>
        </div>
    <?php }else{ ?>
        <h3>Solicitud Prestamos de Proceso Finalizada </h3>

        <input type="hidden" name="user4" value="<?php echo $usuario4; ?>">
    <?php } ?> 
    <hr />
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="subir"><span class="icon-floppy-disk"></span> Actualizar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    </div>
</form>
<script>
    $(document).ready(function(){
        $("#frm-registro").submit(function(){
            return $(this).validate();
        });
    })
</script>