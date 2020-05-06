<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <table border="0">
            <tr>
                <td rowspan="4" width="70%" colspan="4">
                    <img src="http://172.16.175.124/centro_servicios2/views/images/site_logo.png" alt="Rama Judicial"  height="80" width="380">
                </td>
                <td rowspan="4" width="5%"></td>
                <td rowspan="4" width="35%">
                    <img src="http://172.16.175.124/centro_servicios2/views/images/LOGOTIPO 1.png" alt="Logo CSCF" width="80" height="80">
                </td>
            </tr>
        </table>
        <table border="1">
            <thead>
                <tr style="background-color: #4682B4; color: white;">
                    <th title="Código valoración">ID</th>
                    <th title="Código Solicitud Visita">ID Visita</th>
                    <th>Fecha Visita</th>
                    <th>Radicado</th>
                    <th>Despacho Solicitante</th>
                    <th>Asistente Social</th>
                    <th>Calificación</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <?php foreach($this->model->Listar_Historial_Valoracion_Visitas() as $r): ?>
                <tr>
                    <td><?php echo $r->inf_val_id; ?> <i class="fa fa-flag" aria-hidden="true" style="color: green"></i> </td>
                    <td><?php echo $r->vis_pro_id; ?></td>
                    <td><?php echo $r->vis_pro_fecha_visita; ?></td>
                    <td style="mso-number-format:'@' "><?php echo $r->vis_pro_radicado; ?></td>
                    <td><?php echo $r->vis_pro_solicitante; ?></td>
                    <td><?php echo $r->vis_TSoci_nombre; ?></td>
                    <td><?php echo $r->inf_val_valoracionDespacho; ?></td>
                    <td><?php echo $r->inf_val_observaciones; ?></td>
                </tr>
            <?php endforeach; ?>
        </table> 
    </body>
</html>