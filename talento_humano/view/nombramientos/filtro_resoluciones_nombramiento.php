<?php 
    session_start();
    $_SESSION['nombre'];
    $id_user        = $_REQUEST['id_us'];
    $id_claseNombra = $_REQUEST['tipoNom'];
  
    require_once "../../model/hojaVida_model.php";
    $modelo               = new HojaVida();
    $idaccion             = '4';
    $datos_us_accionReps  = $modelo->get_lista_usuario_accionesJE($idaccion);
    $us_privilegios       = $datos_us_accionReps->fetch();
    $usuarioPr            = explode("////",$us_privilegios[usuario]);
    
    if ( !empty($id_user) ) {	
        $filtro1 = " AND rn.res_nom_id_usuario = '$id_user' ";
    }
    
    if ( $id_claseNombra != '') {
        $filtro2 = " AND rn.res_nom_id_clase_nombra = '$id_claseNombra' ";
    }
    $filtrox = $filtro1." ".$filtro2;
    
    $user_se = $_SESSION['idUsuario'];
    require_once "../../core/conexion.php";
    $link=conectarse();
    $sql=("SELECT `res_nom_id`, `res_nom_id_clase_nombra`, `res_nom_id_usuario`, `res_nom_fecha`, 
                `res_nom_id_cargo`, `res_nom_consecutivo`, `res_nom_id_user_reemplaza`, `res_nom_fecha_inicio`, `res_nom_flag_abierto`,
                `res_nom_fecha_fin`, `res_nom_cdp`, `res_nom_oficio`, `res_nom_acuerdo`, `res_nom_ruta_contraloria`, 
                `res_nom_ruta_procuraduria`, `res_nom_ruta_antecedentes`, `res_nom_ruta_medidas`, `res_nom_ruta_inhabilidades`, 
                `res_nom_userR`, `res_nom_userE`, `res_nom_fechaE`, clas_id,clas_titulo, us.empleado AS empleado, us1.empleado AS reemplaza, car.car_titulo AS cargo
            FROM `th_resoluciones_nombra` AS rn 
            INNER JOIN th_clase_nombramiento AS cla ON rn.`res_nom_id_clase_nombra` = cla.clas_id
            INNER JOIN th_cargos as car ON rn.`res_nom_id_cargo` = car.car_id
            INNER JOIN pa_usuario AS us ON rn.`res_nom_id_usuario`= us.id
            LEFT JOIN pa_usuario AS us1 ON rn.`res_nom_id_user_reemplaza` = us1.id
            WHERE rn.res_nom_id >= '1'" .$filtrox. " ORDER BY res_nom_id DESC");
    $result=mysql_query($sql,$link);
    
    $num_filas = mysql_num_rows($result); 
    if(isset($user_se)){
?>
    <h1 class="page-header">Filtro Listado Permisos</h1>
    <table id="example4" class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr style="background-color: #4682B4; color: white;">
                <th title="Código Interno Resoluciòn Nombramiento" style="width:12px;">ID</th>
                <th style="width:12px;">Clase Nombramiento</th>
                <th title="Empleado" style="width:12px;">Nombre Empleado</th>
                <th style="width:12px;">Cargo</th>
                <th style="width:12px;"># Resoluciòn</th>
                <th style="width:12px;">Fecha Inicio</th>
                <th style="width:12px;">Fecha Fin</th>
                <th title="Documentaciòn Relacionada" style="width:12px;">Documentaciòn Anexada</th>
                <th title="Generar Resoluciòn/Acta" style="width:12px;">Generar Documento</th>
                <th style="width:12px;">Editar</th>
            </tr>
        </thead>
        <tbody> 
            <?php while ($r = mysql_fetch_array($result)) {
                if($r['res_nom_fecha_inicio'] == '0000-00-00'){
                    $estado = "En Proceso";
                    $color ="sandybrown";
                    $icon = "warning";
                }else{
                    $estado = "Aprobado";
                    $color ="green";
                    $icon = "flag";
                }
                
            ?>
                <tr>
                    <td><?php echo $r['res_nom_id']; ?> <span class="icon-<?php echo $icon; ?>" style="color: <?php echo $color; ?>"></span></td>
                    <td><?php echo $r['clas_titulo']; ?></td>
                    <td><?php echo $r['empleado']; ?></td>
                    <td><?php echo $r['cargo']; ?></td>
                    <td><?php echo $r['res_nom_consecutivo']; ?></td>
                    <td><?php echo $r['res_nom_fecha_inicio']; ?></td>
                    <td><?php echo $r['res_nom_fecha_fin']; ?></td>
                    <td>
                        <a href="#" class="btn btn-default" title="Certificado Responsabilidad Social - CONTRALORIA" onclick="ver_pdf(9,'<?php echo $r['res_nom_ruta_contraloria']; ?>');return false;" target="_blank">
                            
                            <span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span><p style="font-size: 8px;">Contraloria</p>
                        </a>
                        <a href="#" class="btn btn-default" title="Certificado Antecedentes - PROCURADURIA" onclick="ver_pdf(9,'<?php echo $r['res_nom_ruta_procuraduria']; ?>');return false;" target="_blank">
                            <span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span><p style="font-size: 8px;">Procuraduria</p>
                        </a>
                        <a href="#" class="btn btn-default" title="Certificado Medidas Correctivas" onclick="ver_pdf(9,'<?php echo $r['res_nom_ruta_medidas']; ?>');return false;" target="_blank">
                            <span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span><p style="font-size: 8px;">Medidas</p>
                        </a>
                        <a href="#" class="btn btn-default" title="Certificado Antecedentes Judiciales" onclick="ver_pdf(9,'<?php echo $r['res_nom_ruta_antecedentes']; ?>');return false;" target="_blank">
                            <span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span><p style="font-size: 8px;">Antecedentes</p>
                        </a>
                        <a href="#" class="btn btn-default" title="Declaración Juramentada de Inhabilidades" onclick="ver_pdf(9,'<?php echo $r['res_nom_ruta_inhabilidades']; ?>');return false;" target="_blank">
                            <span class="icon icon-file-pdf" style="font-size: 18px; color: red;"></span><p style="font-size: 8px;">Inhabilidades</p>
                        </a>
                    </td>
                    <td>
                        <?php 
                            if($r['clas_id'] == 1){
                                $ruta_doc = "crear_resolucion_nombramiento_propiedad.php";
                            }else if($r['clas_id'] == 2){
                                $ruta_doc = "crear_resolucion_nombramiento_provisionalidad.php";
                            }else if($r['clas_id'] == 3){
                                $ruta_doc = "crear_resolucion_nombramiento_encargo.php";
                            }else{
                                $ruta_doc = "#";
                            }
                        ?>
                        <a href="app/libs/plantillero/<?php echo $ruta_doc; ?>?id=<?php echo $r['res_nom_id']; ?>" style="text-decoration: none;" title="Resolución Nombramiento">
                            <span class="icon-file-word" style="font-size: 25px;"> </span>
                        </a>
                        <?php if($r['res_nom_fecha_inicio'] != '0000-00-00'){ ?>
                            <a href="app/libs/plantillero/crear_acta_nombramiento.php?id=<?php echo $r['res_nom_id']; ?>" style="text-decoration: none;" title="Acta de Posesión">
                                <i class="fa fa-file-word-o" aria-hidden="true" style="font-size: 25px;"></i>
                            </a>
                        <?php }else{ ?>
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-id="<?php echo $r['res_nom_id']; ?>" data-target="#Modal_Acta" data-return_flag="1" ><i class="fa fa-plus" aria-hidden="true"></i> Adicionar</a>
                        <?php } ?>
                    </td>
                    <td>
                        <a href="#" class="btn btn-default" id="editarR" data-toggle="modal" data-id="<?php echo $r['res_nom_id']; ?>"data-id_usuario="<?php echo $r['res_nom_id_usuario'] ?>" data-fecha_inicio="<?php echo $r['res_nom_fecha_inicio'] ?>"data-num_cdp="<?php echo $r['res_nom_cdp']; ?>"data-id_cargo="<?php echo $r['res_nom_id_cargo']; ?>" data-target="#Modal_Editar" data-return_flag="1" >
                            <span class="icon icon-pencil" style="font-size: 18px; color: goldenrod;"></span> 
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <script>
        $(document).ready(function() {
            $('#example4').DataTable();
            $('#example_historial').DataTable( {
                "order": [[ 0, "desc" ]]
            });
        } );
        $('.selectpicker').selectpicker({
            style: 'btn-info',
            size: 4
        });
    </script> 
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.30/centro_servicios2" ); } ?>