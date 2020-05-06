<?php
    session_start();
    $_SESSION['nombre'];
    $id_user = $_SESSION['idUsuario'];
    $radi       = $_REQUEST['radicado'];
    require_once "../../../core/conexion.php";
    require_once "../../../model/consulta_model.php";
    $link       = conectarse();
    mysql_set_charset('utf8');    
    
    $modelo     = new Consulta();
    $datosbd    = $modelo->get_datos_basededatos(7);
    $datosbd_b  = $datosbd->fetch();
    $datosbd_1  = $datosbd_b[ip];
    $datosbd_2  = $datosbd_b[bd];
    $datosbd_3  = $datosbd_b[usuario];
    $datosbd_4  = $datosbd_b[clave];

    $serverName = $datosbd_1; //serverName\instanceName
    $connectionInfo = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    $sql_partes = ("
        SELECT 
            info_suje.[A112LLAVPROC]
            ,info_suje.[A112CODISUJE]
            ,info_suje.[A112NUMESUJE]
            ,info_suje.[A112NOMBSUJE]
            ,tipo_suje.[A057CODISUJE]
            ,tipo_suje.[A057DESCSUJE]
        FROM [$datosbd_2].[dbo].[T112DRSUJEPROC] AS info_suje
        INNER JOIN [$datosbd_2].[dbo].[T057BASUJEGENE] AS tipo_suje ON info_suje.[A112CODISUJE] = tipo_suje.A057CODISUJE
        WHERE info_suje.[A112LLAVPROC] = "."'$radi'".";");
    $params  = array();
    $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt1 = sqlsrv_query( $conn, $sql_partes , $params, $options );

    $query_Actu = ("SELECT 
                 [A110LLAVPROC]
                ,[A110CONSACTU]
                ,[A110NUMEPROC]
                ,[A110CONSPROC]
                ,[A110CODIACTU]
                ,[A110CODIPADR]
                ,[A110DESCACTU]
                ,[A110FECHINIC]
                ,[A110FECHFINA]
                ,[A110FECHREGI]
                ,[A110FOLIPROC]
                ,[A110FECHPROV]
                ,[A110ANOTACTU]
                ,[A110FECHDESA]
            FROM [$datosbd_2].[dbo].[T110DRACTUPROC] AS actu
            WHERE actu.[A110LLAVPROC] =  "."'$radi'"." ORDER BY actu.[A110CONSACTU] DESC;");
    $paramsQ  = array();
    $optionsQ = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $query_Actu , $paramsQ, $optionsQ );
?>

<div class="panel panel-info">
    <div class="panel-heading">Datos Partes</div>
    <div class="panel-body"><p></p></div>
    <table id="example4" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Cédula</th>
                <th>Tipo Parte</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php while( $row = sqlsrv_fetch_array( $stmt1)){ ?>
                <tr>
                    <td><?php echo $row['A112NUMESUJE']; ?></td>
                    <td><?php echo htmlentities($row['A057DESCSUJE']); ?></td>
                    <td><?php echo htmlentities($row['A112NOMBSUJE']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="panel-heading">Historia Proceso</div>
    <div class="panel-body"><p></p></div>
    <table id="example_historial" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Actuaciòn</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php while( $row = sqlsrv_fetch_array( $stmt)){ ?>
                <tr>
                    <td><?php echo htmlentities($row['A110DESCACTU']); ?></td>
                    <td><?php echo $row['A110FECHREGI']->format('Y-m-d'); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div><br/>
<script>
    $(document).ready(function() {
        $('#example4').DataTable();
        $('#example_historial').DataTable( {
            "order": [[ 1, "desc" ]]
        });
    } );
</script> 