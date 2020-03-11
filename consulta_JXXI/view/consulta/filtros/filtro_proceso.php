<?php
    session_start();
    $_SESSION['nombre'];
    $id_user = $_SESSION['idUsuario'];
    require_once "../../../core/conexion.php";
    require_once "../../../model/consulta_model.php";
    $link       = conectarse();
    $user       = $_POST['user'];
    //-------- CAPTURA DATOS  ---*--------------------------------//
    $radicado       = $_POST['radicado'];
    $demandante     = $_POST['demandante'];
    $cedula1        = $_POST['cedula1'];
    $demandado      = $_POST['demandado'];
    $cedula2        = $_POST['cedula2'];
    // ---------------------------------------------------------- //
    $modelo               = new Consulta();
    $us                   = $_SESSION['idUsuario'];
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion             = '38';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa            = explode("////",$usuarios[usuario]);    
    
    // CONSULTA SQL LOCAL
    $datosbd   = $modelo->get_datos_basededatos(7);

    $datosbd_b = $datosbd->fetch();
    $datosbd_1 = $datosbd_b[ip];
    $datosbd_2 = $datosbd_b[bd];
    $datosbd_3 = $datosbd_b[usuario];
    $datosbd_4 = $datosbd_b[clave];
    
    // ---------------------- VALIDACIÓN DE CAMPOS PARA CONSULTA --------------------
    if(!empty($radicado) && empty($demandante) && empty($cedula1) && empty($demandado) && empty($cedula2)){
        
        $sql = ("SELECT 
                 info_pro.[A103LLAVPROC]
                ,info_pro.[A103CODIAREA]
                ,info_pro.[A103CODIPROC]
                ,info_pro.[A103CODICLAS]
                ,info_pro.[A103CODISUBC]
                ,info_pro.[A103CODIESPO]
                ,info_pro.[A103CODIPONE]
                ,info_pro.[A103NOMBPONE]
                ,pro_clas.[A053CODICLAS]
                ,pro_clas.[A053DESCCLAS]
                ,sub_clas.[A071CODISUBC]
                ,sub_clas.[A071DESCSUBC]
                ,pro_tipo.[A052DESCPROC]
            
            FROM [$datosbd_2].[dbo].[T103DAINFOPROC] AS info_pro
            INNER JOIN [$datosbd_2].[dbo].[T053BACLASGENE] AS pro_clas ON info_pro.[A103CODICLAS] = pro_clas.[A053CODICLAS]
            INNER JOIN [$datosbd_2].[dbo].[T052BAPROCGENE] AS pro_tipo ON info_pro.[A103CODIPROC] = pro_tipo.[A052CODIPROC]
            INNER JOIN [$datosbd_2].[dbo].[T071BASUBCGENE] AS sub_clas ON info_pro.[A103CODISUBC] = sub_clas.[A071CODISUBC]  
            WHERE info_pro.[A103LLAVPROC] LIKE  "." '%$radicado%'"." ;");
    }else{
        if(!empty($radicado)){
            $f_radicado = " AND info_pro.[A103LLAVPROC] LIKE "." '%$radicado%'" ;
        }
        if(!empty($demandante)){
            $f_demandante = " AND info_suje.[A112NOMBSUJE] LIKE '%$demandante%' AND [A112CODISUJE] = '0001' " ;
        }
        if(!empty($cedula1)){
            $f_cedula1 = " AND info_suje.[A112NUMESUJE] = '$cedula1' AND [A112CODISUJE] = '0001' " ;
        }
        if(!empty($demandado)){
            $f_demandado = " AND info_suje.[A112NOMBSUJE] LIKE "." '%$demandado%' AND [A112CODISUJE] = '0002' " ;
        }
        if(!empty($cedula2)){
            $f_cedula2 = " AND info_suje.[A112NUMESUJE] = '$cedula2' AND [A112CODISUJE] = '0002' " ;
        }
        
        $Filtrox =  $f_radicado." ".$f_demandante." ".$f_cedula1." ".$f_demandado." ".$f_cedula2;
        
        $sql = ("SELECT 
             info_pro.[A103LLAVPROC]
            ,info_pro.[A103CODIAREA]
            ,info_pro.[A103CODIPROC]
            ,info_pro.[A103CODICLAS]
            ,info_pro.[A103CODISUBC]
            ,info_pro.[A103CODIESPO]
            ,info_pro.[A103CODIPONE]
            ,info_pro.[A103NOMBPONE]
            ,pro_clas.[A053CODICLAS]
            ,pro_clas.[A053DESCCLAS]
            ,sub_clas.[A071CODISUBC]
            ,sub_clas.[A071DESCSUBC]
            ,info_suje.[A112LLAVPROC]
            ,info_suje.[A112CODISUJE]
            ,info_suje.[A112NUMESUJE]
            ,info_suje.[A112NOMBSUJE]
            ,tipo_suje.[A057CODISUJE]
            ,tipo_suje.[A057DESCSUJE]
            ,pro_tipo.[A052DESCPROC]
            
        FROM [$datosbd_2].[dbo].[T103DAINFOPROC] AS info_pro
        INNER JOIN [$datosbd_2].[dbo].[T053BACLASGENE] AS pro_clas ON info_pro.[A103CODICLAS] = pro_clas.[A053CODICLAS]
        INNER JOIN [$datosbd_2].[dbo].[T071BASUBCGENE] AS sub_clas ON info_pro.[A103CODISUBC] = sub_clas.[A071CODISUBC]  
        INNER JOIN [$datosbd_2].[dbo].[T112DRSUJEPROC] AS info_suje ON info_suje.[A112LLAVPROC] = info_pro.[A103LLAVPROC]
        INNER JOIN [$datosbd_2].[dbo].[T057BASUJEGENE] AS tipo_suje ON info_suje.[A112CODISUJE] = tipo_suje.A057CODISUJE
        INNER JOIN [$datosbd_2].[dbo].[T052BAPROCGENE] AS pro_tipo ON info_pro.[A103CODIPROC] = pro_tipo.[A052CODIPROC]
        WHERE info_pro.[A103CODIPONE] != 'NULL' $Filtrox ");
        
    }
    //*******************************************************************--
    $serverName = $datosbd_1; //serverName\instanceName
    $connectionInfo = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    $params  = array();
    $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $sql , $params, $options );
    //$stmt4 = sqlsrv_query( $conn, $sql , $params, $options );
   
    $num_filas = sqlsrv_num_rows( $stmt );

    if($num_filas>0){
        $alerta = "success";
        $bandera = '1';
    }else{
        $alerta = "danger";
        $bandera = '0';
    }  
    if(isset($id_user)){
?>
        <div class="alert alert-<?php echo $alerta; ?>" role="alert">Resultado Registros: <?php echo $num_filas; ?></div>
        <table id="example55" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Radicado</th>
                    <th>Despacho</th>
                    <th>Tipo Proceso</th>
                    <th>Clase Proceso</th>
                    <th>Sub Clase</th>
                    <th>Historia</th>
                </tr>
            </thead>
            <tbody>
                <?php while( $row = sqlsrv_fetch_array( $stmt)){ ?>
                    <tr>
                        <td>
                            <?php echo $row['A103LLAVPROC']; ?>
                            <input type="hidden" id="radix" value="<?php echo $row['A103LLAVPROC']; ?>">
                        </td>
                        <td><?php echo htmlentities($row['A103NOMBPONE']); ?></td>
                        <td><?php echo htmlentities($row['A052DESCPROC']); ?></td>
                        <td><?php echo htmlentities($row['A053DESCCLAS']); ?></td>
                        <td><?php echo htmlentities($row['A071DESCSUBC']); ?></td>
                        <td><a href="#" class="btn btn-primary" id="modal_Partes" data-toggle="modal" data-target="#Modal_ver" data-radi="<?php echo $row['A103LLAVPROC']; ?>" ><i class="icon-address-book"></i></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    <!-- Modal-->
    <div class="modal fade" id="Modal_ver" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        <i class="glyphicon glyphicon-info-sign"></i> Nueva Consulta <label for="empleado" id="empleado"></label>
                    </h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <div id="dynamic-datosPartes"></div>
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
            $(document).on('click', '#modal_Partes', function(e){
                var radicado = $(this).data('radi');
                $("#dynamic-datosPartes").load("view/consulta/dynamic/Modal_datos_Proceso.php",{radicado}); 
            }); 
        }); 
        $('#Modal_ver').on('show.bs.modal', function (event){
            var button = $(event.relatedTarget); 
            var rad = button.data('radi');
            var modal = $(this); 
            modal.find('.modal-body label[id="empleado"]').val(rad); 
        });
    </script>
<?php }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>
