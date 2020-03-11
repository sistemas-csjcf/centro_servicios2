<?php 
    $_REQUEST['dx']; 
    $modelo = new Visita();
    $datos = $modelo->Obtener_datos_visita($_REQUEST['dx'] );
?>
<html>
    <head>
        <meta charset="utf-8" />
         <title>Trabajo Social</title>
    </head>
    <body>
        <table border="0">
            <tr>
                <td rowspan="4" width="60%" colspan="2">
                    <img src="http://172.16.175.30/centro_servicios2/views/images/site_logo.png" alt="Rama Judicial"  height="80" width="180">
                </td>
                <td rowspan="4" width="5%"></td>
                <td rowspan="4" width="35%">
                    <img src="http://172.16.175.30/centro_servicios2/views/images/LOGOTIPO 1.png" alt="Logo CSCF" width="80" height="80">
                </td>
            </tr>
        </table>
        <table border="0" style="width: 50%">
            <tr>
                <td colspan="4" align="center"><h3>Formato de entrega - Solicitud Visita Domiciliaria</h3></td>
            </tr>
            <tr><td colspan="4"></td></tr>
            <?php while($r = $datos->fetch()){ ?>
                <tr>
                    <td><p>Fecha de Solicitud: </p></td>
                    <td style="mso-number-format:'@'"><p><?php echo $r['vis_pro_fecha_visita']; ?></p></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><p>Señora: </p></td>
                    <td><p><b><?php echo $r['vis_TSoci_nombre']; ?></b></p></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <p>Mediante la presente me permito informarle que ha sido asignada para realizar la visita domiciliaria que se 
                        relaciona a continuación:</p>
                    </td>
                </tr>
                <tr>
                    <td><p>Radicado:</p></td>
                    <td style="mso-number-format:'@'"><p><?php echo $r['vis_pro_radicado']; ?></p></td>
                    <td><p></p></td>
                    <td></td>
                </tr>
                <tr>
                    <td><p>Solicitante:</p></td>
                    <td><p><?php echo $r['vis_pro_solicitante']; ?></p></td>
                    <td><p></p></td>
                    <td></td>
                </tr>
                <tr>
                    <td><p>Tipo Proceso:</p></td>
                    <td><p><?php echo $r['vis_pro_subclase_proceso']; ?></p></td>
                    <td><p></p></td>
                    <td></td>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>