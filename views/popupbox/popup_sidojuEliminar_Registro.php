<?php
    session_start();
    $_SESSION['nombre'];
    $id_user    = $_SESSION['idUsuario'];
    require_once '../../assets/core/conexion.php';
    $link=conectarse();
    date_default_timezone_set('America/Bogota'); 
    $fecha_actual=date('Y-m-d');
	$fecha2 = date("y-m-d",strtotime($fecha_actual."- 1 days"));

	if($_SESSION['idperfil'] ==1){
         $sql = "SELECT de.id AS id,de.fecha AS fecha,de.hora AS hora,pu.empleado AS recibe,de.remitente AS remite,td.nombre_tipo_documento AS tipo_doc,
                de.numero as num_doc,de.nfc AS nfc,pj.nombre AS juzgado,de.rutaarchivo AS ruta, de.chk AS estado
            FROM (((sidoju_documentos_entrantes_juzgados de INNER JOIN pa_usuario pu ON de.idusuario = pu.id)
            INNER JOIN sigdoc_pa_tipodocumento td ON de.idtipodocumento = td.id)
            INNER JOIN pa_juzgado pj ON de.idjuzgadodestino = pj.id)
            ORDER BY de.id DESC LIMIT 1000";
        $res = mysql_query($sql,$link);
    }else{
		$sql = "SELECT de.id AS id,de.fecha AS fecha,de.hora AS hora,pu.empleado AS recibe,de.remitente AS remite,td.nombre_tipo_documento AS tipo_doc,
					de.numero as num_doc,de.nfc AS nfc,pj.nombre AS juzgado,de.rutaarchivo AS ruta, de.chk AS estado
				FROM (((sidoju_documentos_entrantes_juzgados de INNER JOIN pa_usuario pu ON de.idusuario = pu.id)
				INNER JOIN sigdoc_pa_tipodocumento td ON de.idtipodocumento = td.id)
				INNER JOIN pa_juzgado pj ON de.idjuzgadodestino = pj.id)
				WHERE pj.id_usuario_memorial='$id_user' AND fecha BETWEEN '$fecha2' AND '$fecha_actual' AND chk !=1 ORDER BY de.id ";
		$res = mysql_query($sql,$link);
    }
    $sql1 = "SELECT * 
        FROM `sigdoc_pa_tipodocumento` 
        ORDER BY nombre_tipo_documento ASC";
    $res1 = mysql_query($sql1,$link);
    
    $sql2 = "SELECT * 
        FROM `pa_juzgado` 
        WHERE id_usuario_memorial = '$id_user'
        ORDER BY nombre ASC";
    $res2 = mysql_query($sql2,$link);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Eliminar Registro SIDOJU</title>
        <meta charset="utf-8">
        <meta name="author" content="Juan Esteban Múnera Betancur" />
        <link rel="shortcut icon" href="../../assets/imagenes/logo.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--        funciones creadas Juan Esteban Múnera Betancur -->
        <script language="JavaScript" type="text/javascript" src="../../assets/js/funciones_jest.js"></script>
        <!--Librerias Datatables-->
        <script src="//code.jquery.com/jquery-1.12.3.min.js"></script>
        <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../../assets/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="../../assets/js/jquery-ui/jquery-ui.min.css" />
        <link rel="stylesheet" href="../../assets/js/jquery-ui/jquery-ui.js" />
        <!--  LIBRERIA datatable personalizada -->
        <script src="../../assets/js/app/1.10.12_js-jquery.dataTables.min.js"></script>
        <script src="../../assets/js/app/dataTables.bootstrap.min.js"></script>
        <script src="../../assets/js/app/dataTables.responsive.min.js"></script>
        <script src="../../assets/js/app/responsive.bootstrap.min.js"></script>
        <!--Libs CSS Datatables-->
        <link rel="stylesheet" href="../../assets/js/app/dataTables.bootstrap.min.css"/>
        <link rel="stylesheet" href="../../assets/js/app/responsive.bootstrap.min.css"/> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
                $('#example_historial').DataTable( {
                    "order": [[ 0, "desc" ]]
                });
            } );
        </script> 
    </head>
    <body>
        <div class="container">
            <h1 class="page-header">Eliminar Documentos Entrantes SIDOJU</h1>
            <div id="tb_inicial">
                <table id="example_historial" class="table table-striped table-hover table-condensed dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr style="background-color: #2F4F4F; color: white;">
                            <th id="Código Interno">ID</th>
                            <th>Consecutivo</th>
                            <th>Tipo Documento</th>
                            <th title="Nombre/Folios/Cuadernos">N/F/C</th>
                            <th>Fecha</th>
                            <th>Recibe</th>
                            <th>Remite</th>
                            <th>Juzgado</th>
                            <th>Ruta</th>
                            <th>Estado</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($fila = mysql_fetch_array($res)){ ?>
                            <tr>
                                <td><?php echo trim($fila['id']); ?></td>
                                <td><?php echo trim($fila['num_doc']); ?></td>
                                <td><?php echo trim($fila['tipo_doc']); ?></td>
                                <td><?php echo trim($fila['nfc']); ?></td>
                                <td><?php echo trim($fila['fecha']." - ".$fila['hora']); ?></td>
                                <td><?php echo trim($fila['recibe']); ?></td>
                                <td><?php echo trim($fila['remite']); ?></td>
                                <td><?php echo trim($fila['juzgado']); ?></td>
                                <td><?php echo trim($fila['ruta']); ?></td>
                                <td>
                                    <?php
                                        if(trim($fila['estado']==0)){
                                            $estado="No Aprobado";
                                        }else if(trim($fila['estado']==1)){
                                            $estado="Aprobado";
                                        }else{
                                            $estado="-";
                                        }
                                        echo $estado; 
                                    ?>
                                </td>                                                                               
                                <td><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#Modal_Eliminar" data-id="<?php echo $fila['id']; ?>" style="text-decoration: none;" ><span class="glyphicon glyphicon-remove-sign"></span></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- Modal EDITAR REFERENCIAS PERSONALES-->
            <div class="modal fade" id="Modal_Eliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">
                               Eliminar Registro Documento <icon class="fa fa-file-alt"></icon>
                            </h4>
                        </div>
                        <!-- Modal Body -->
                        <div class="modal-body">
                            <form role="form" action="../../index.php?controller=sidoju&action=Eliminar_Registro_Sidoju" method="post" >
                                <div class="form-group">
                                    <input type="text" readonly="" class="form-control" name="id" id="id" placeholder="id"/>
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Observaciones Eliminar</label>
                                    <textarea name="comentario_elimina" placeholder="Comentarios Eliminar Registro" class="form-control" id="comentario" required=""></textarea>
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary"><span class="icon-floppy-disk"></span> Eliminar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script>
              
                $('#Modal_Eliminar').on('show.bs.modal', function (event) {
                    var button  = $(event.relatedTarget) 
                    var id   = button.data('id') 
                    

                    var modal = $(this)
                    
                    modal.find('.modal-body input[name="id"]').val(id)
                })
            </script>
            <div class="row">
                <div class="row">
                <div class="col-xs-12">
                    <hr />
                    <footer class="text-center well">
                        <p>CENTRO DE SERVICIOS CIVIL - FAMILIA</p>
                        <p>CARRERA 23 # 21-48 OFICINA 108</p>
                        <P>TELÈFONO 887 9620</p>
                        <P>MANIZALES CALDAS</P>
                        <strong><a data-toggle="popover" title="Juan Esteban Múnera B.">Juan Esteban Múnera Betancur </a></strong>
                        <p>&COPY; 2018</p>
                    </footer>               
                </div>    
            </div>  
            </div>
        </div>
        <script src="../../assets/js/bootstrap.min.js"></script>
        <script src="../../assets/js/jquery-ui/jquery-ui.min.js"></script>
        <script src="../../assets/js/ini.js"></script>
        <script src="../../assets/js/jquery.jest-validator.js"></script>
    </body>
</html>