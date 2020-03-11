<?php
//include("/../libs/conexion2.php"); //Centro de Servicios
    $radicado   = $_POST['radi'];

    /*$serverName = "DESKTOP-8FLD29P\SQLEXPRESS";
    $datosbd_2 = "ConsejoPN";
    $datosbd_3 = "sa";
    $datosbd_4 = "111";*/
    $serverName = "192.168.89.20";
    $datosbd_2 = "consejoPN";
    $datosbd_3 = "sa";
    $datosbd_4 = "M4nt3n1m13nt0";
    $conn = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
    $conn = sqlsrv_connect($serverName, $conn);

    if($conn === false) {
        //die( print_r( sqlsrv_errors(), true));
        echo 'Sin sistema en justicia';
    }
    $sql = ("SELECT info_pro.[A103LLAVPROC],info_pro.[A103CODIAREA],info_pro.[A103CODIPROC],info_pro.[A103CODICLAS],info_pro.[A103CODISUBC],info_pro.[A103CODIESPO],info_pro.[A103CODIPONE],info_pro.[A103NOMBPONE],archi.[A103CODIDECI],archi.[A103OBSEFINA],archi.[A103PROVFINA],archi.[A103FEPROVFI],archi.[A103ARCHIVAD],pro_clas.[A053CODICLAS],pro_clas.[A053DESCCLAS],sub_clas.[A071CODISUBC],sub_clas.[A071DESCSUBC],pro_tipo.[A052DESCPROC]
            FROM [$datosbd_2].[dbo].[T103DAINFOPROC] AS info_pro
            INNER JOIN [$datosbd_2].[dbo].[T103DAFINAPROC] AS archi ON info_pro.[A103LLAVPROC] = archi.[A103LLAVPROC]
            INNER JOIN [$datosbd_2].[dbo].[T053BACLASGENE] AS pro_clas ON info_pro.[A103CODICLAS] = pro_clas.[A053CODICLAS]
            INNER JOIN [$datosbd_2].[dbo].[T071BASUBCGENE] AS sub_clas ON info_pro.[A103CODISUBC] = sub_clas.[A071CODISUBC]
            INNER JOIN [$datosbd_2].[dbo].[T052BAPROCGENE] AS pro_tipo ON info_pro.[A103CODIPROC] = pro_tipo.[A052CODIPROC]
            WHERE info_pro.[A103LLAVPROC] = "."'$radicado'".";");
    $params  = array();
    $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $sql , $params, $options );
    
    while( $row = sqlsrv_fetch_array($stmt)){
        $codipone           = $row['A103CODIPONE'];
        $ponente            = htmlentities($row['A103NOMBPONE']);
        $tipo_proceso       = htmlentities($row['A052DESCPROC']);
        $clase_proceso      = htmlentities($row['A053DESCCLAS']);
        $subclase_proceso   = htmlentities($row['A071DESCSUBC']);
        $observaciones_arch = htmlentities($row['A103OBSEFINA']);
    }
    /*$consulta="SELECT * FROM pa_usuario WHERE nombre_usuario ='$codipone'";
    $result=mysql_query($consulta);
    while($fila=mysql_fetch_array($result)){ 
        $id_userPone = $fila['id'];
    }*/
    $num_filas = sqlsrv_num_rows( $stmt );
    $sql_partes = ("
            SELECT 
                info_suje.[A112LLAVPROC]
                ,info_suje.[A112CODISUJE]
                ,info_suje.[A112NUMESUJE]
                ,info_suje.[A112NOMBSUJE]
                ,tipo_suje.[A057CODISUJE]
                ,tipo_suje.[A057DESCSUJE]
                FROM [$datosbd_2].[dbo].[T112DRSUJEPROC] AS info_suje
                INNER JOIN [$datosbd_2].[dbo].[T057BASUJEGENE] AS tipo_suje
                ON info_suje.[A112CODISUJE] = tipo_suje.A057CODISUJE
                WHERE info_suje.[A112LLAVPROC] = "."'$radicado'".";");
    
    $stmt1 = sqlsrv_query($conn, $sql_partes, $params, $options);  
    $num_filas_p = sqlsrv_num_rows( $stmt1 );
    if($num_filas>0){ 
        $alerta = "success";
        $mensaje = "PARTES DEL PROCESO";
        $bandera = '1';
    }else{
        $alerta = "danger";
        $mensaje = "Resultado";
        $bandera = '0';
    }  
    
    if($num_filas_p>0){ 
        $alerta_p = "info";
    } else {
        $alerta_p = "danger";
    }
    
    /*$query="SELECT count(*) AS cantidad_registros, pre_fecha FROM archivo_prestamo_proceso WHERE prE_radicado = '$radicado' AND pre_flag=0"; 
    $rs=mysql_query($query);
    while($fila=mysql_fetch_array($rs)){ 
        $num_reg   = $fila['cantidad_registros'];
        $pre_fecha = $fila['pre_fecha'];
    }*/
?>
<?php if($num_filas > 0) { ?>
    <br>
    <table border="1">
        <tr>
            <td colspan="2" style="text-align: center;">Radicado existente</td>
        </tr>
        <tr>
            <td>Juzgado</td>
            <td><?php echo $ponente; ?></td>
        </tr>
        <tr>
            <td>Tipo de Proceso</td>
            <td><?php echo $tipo_proceso; ?></td>
        </tr>
        <tr>
            <td>Clase de Proceso</td>
            <td><?php echo $clase_proceso; ?></td>
        </tr>
        <tr>
            <td>Sub Clase</td>
            <td><?php echo $subclase_proceso; ?></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">Partes</td>
        </tr>
        <tr>
            <td>Tipo Parte</td>
            <td>Nombre - Documento</td>
        </tr>
        <?php while( $row = sqlsrv_fetch_array( $stmt1)){ ?>
        <tr>
            <td><?php echo htmlentities($row['A057DESCSUJE']); ?></td>
            <td><?php echo htmlentities($row['A112NOMBSUJE'].'-' .$row['A112NUMESUJE']); ?></td>
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

        <!--<tr>
            <td>
                <label style="width:151px; color:#666666">Juzgado Destino:</label>
            </td>
            <td>
    <?php
        $res = "SELECT pa_juzgado.id, pa_juzgado.nombre, pa_usuario.empleado FROM pa_juzgado INNER JOIN pa_usuario ON pa_juzgado.idusuariojuzgado=pa_usuario.id";
        $res = mysql_query($res);
    ?>

        <select id="juzgadodestino" name="juzgadodestino" onchange='autocompletar(this.value);' class="required">
            <option value="" selected="selected">Seleccionar Juzgado Destino</option> 
            <?php
                while($fila=mysql_fetch_array($res)){
            ?>
                <option value="<?php echo $fila[id].'-'.$fila[empleado]; ?>"><?php echo $fila[nombre]; ?></option>
            <?php
                }
            ?>
            </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label style="width:151px; color:#666666">Empleado:</label>
                    </td>
                    <td>
                        <input type="hidden" id="id">
                        <input type="text" id="nombreusuariojuzgado">
                    </td>
                </tr>-->
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
    No existe radicado
<?php
    }
?>