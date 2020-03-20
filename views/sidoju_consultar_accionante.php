<?php
//consejoPN-Justicia
//include("/../libs/conexion3.php");
$serverName = "192.168.89.20";
$datosbd_2 = "consejoPN";
$datosbd_3 = "sa";
$datosbd_4 = "M4nt3n1m13nt0";
//MAX a110consactu
$conn = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
$conn = sqlsrv_connect($serverName, $conn);
    $accionante = $_POST['acci'];
    if($conn === false) { echo 'Sin sistema en justicia'; }
    $sql = ("SELECT info_pro.[A103LLAVPROC],info_pro.[A103CODIAREA],info_pro.[A103CODIPROC],info_pro.[A103CODICLAS],info_pro.[A103CODISUBC],info_pro.[A103CODIESPO],info_pro.[A103CODIPONE],info_pro.[A103NOMBPONE],archi.[A103CODIDECI],archi.[A103OBSEFINA],archi.[A103PROVFINA],archi.[A103FEPROVFI],archi.[A103ARCHIVAD],pro_clas.[A053CODICLAS],pro_clas.[A053DESCCLAS],sub_clas.[A071CODISUBC],sub_clas.[A071DESCSUBC],pro_tipo.[A052DESCPROC]
        FROM [dbo].[T103DAINFOPROC] AS info_pro
        INNER JOIN [dbo].[T103DAFINAPROC] AS archi ON info_pro.[A103LLAVPROC] = archi.[A103LLAVPROC]
        INNER JOIN [dbo].[T053BACLASGENE] AS pro_clas ON info_pro.[A103CODICLAS] = pro_clas.[A053CODICLAS]
        INNER JOIN [dbo].[T071BASUBCGENE] AS sub_clas ON info_pro.[A103CODISUBC] = sub_clas.[A071CODISUBC]
        INNER JOIN [dbo].[T052BAPROCGENE] AS pro_tipo ON info_pro.[A103CODIPROC] = pro_tipo.[A052CODIPROC]
        WHERE info_pro.[A103LLAVPROC] = "."'$accionante'".";");
    $params  = array();
    $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $sql , $params, $options );
    
    while( $row = sqlsrv_fetch_array($stmt)){
        $ponente            = htmlentities($row['A103NOMBPONE']);
        $tipo_proceso       = htmlentities($row['A052DESCPROC']);
        $clase_proceso      = htmlentities($row['A053DESCCLAS']);
        $subclase_proceso   = htmlentities($row['A071DESCSUBC']);
    }
    $num_filas = sqlsrv_num_rows($stmt);
    $sql_partes = ("
        SELECT info_suje.[A112LLAVPROC],info_suje.[A112CODISUJE],info_suje.[A112NUMESUJE],info_suje.[A112NOMBSUJE],tipo_suje.[A057CODISUJE],tipo_suje.[A057DESCSUJE]
        FROM [dbo].[T112DRSUJEPROC] AS info_suje
        INNER JOIN [dbo].[T057BASUJEGENE] AS tipo_suje ON info_suje.[A112CODISUJE] = tipo_suje.[A057CODISUJE]
        WHERE info_suje.[A112NUMESUJE] = "."'$accionante'".";");

    $stmt1 = sqlsrv_query($conn, $sql_partes, $params, $options);  
    $num_filas_p = sqlsrv_num_rows($stmt1);
?>
<?php if($num_filas > 0) { ?>
    <br>
    <table border="1">
        <?php while($row = sqlsrv_fetch_array( $stmt1)){ ?>
        <tr>
            <?php if ($row['A057DESCSUJE']=='Demandante') {
                $tipoparte='Accionante';
            } else {
                $tipoparte='Accionado';
            }
            ?>
            <td><?php echo htmlentities($tipoparte); ?></td>
            <td><?php echo htmlentities($row['A112LLAVPROC'].'-' .$row['A112NUMESUJE']); ?></td>
        </tr>
        <?php
            } 
        ?>
    </table>
    <br>
    <table>
        <tr>
            <td>
                <label style="width:151px; color:#666666">Remitente:</label>
            </td>
            <td>
                <input type="text" name="remitente" id="remitente" class="required" value="<?php echo $d3; ?>" maxlength="155"/>
            </td>
        </tr>
        <tr>
            <td>
                <label style="width:151px; color:#666666">N&#250;mero Documento:</label>
            </td>
            <td>
                <input type="text" name="numerodoce" id="numerodoce" class="" value="<?php echo $d5; ?>" class="required"/>
            </td>
        </tr>
        <tr>
            <td>
                <label style="width:151px; color:#666666">Nombre/Folios/Cuadernos:</label>
            </td>
            <td>
                <input type="text" name="nfc" id="nfc" value="<?php echo $d6; ?>" class="required"/>
            </td>
        </tr>
        <tr>
            <td>
                <label style="width:151px; color:#666666">Archivo</label>
            </td>
            <td>
                <input type="file" name="archivo" id="archivo" title="Archivo" class="required"/>
            </td>
        </tr>
        <tr>
            <td>
                <div id="ok"></div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <!-- SE PREGUNTA SI LA VARIABLE $vbton NO ES VACIA, YA QUE ESTO NOS INDICA QUE VAMOS A ACTUALIZAR UN DOCUMENTO-->
                <center>
                    <input type="submit" name="Submit" value="<?php if(empty($vbton)){ echo "Registrar";}else{echo "Actualizar";} ?>" id="btn_input"/>
                    <input type="hidden" name="action" value="adicionar" />
                    <!-- <input type="submit" name="Submit" value="<?php //if(empty($vbton)){ echo "Registrar";}else{echo "Actualizar";} ?>" id="btn_input" class="btn_validardj"/> -->
                    <input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
                </center>
            </td>
        </tr>
    </table>
<?php } else { ?>
    No existe accionante
<?php
    }
?>