<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <table border="1">
            <thead>
                <tr style="background-color: #4682B4; color: white;">
                    <th title="Código Solicitud Visita">ID Visita</th>
                    <th>Radicado</th>
                    <th>Despacho Solicitante</th>
                    <th>Asistente Social</th>
                    <th>Fecha Visita</th>
                    <th>Realizada</th>
                </tr>
            </thead>
            <?php foreach($this->model->Listar_All_Solicitudes_Visitas() as $r): ?>
                <tr>
                    <td><?php echo $r->vis_pro_id; ?></td>
                    <td style="mso-number-format:'@' "><?php echo $r->vis_pro_radicado; ?></td>
                    <td><?php echo $r->vis_pro_solicitante; ?></td>
                    <td><?php echo $r->vis_TSoci_nombre; ?></td>
                    <td><?php echo $r->vis_pro_fecha_visita; ?></td>
                    <td style="mso-number-format:'@' "><?php echo $r->vis_pro_finalizada; ?></td>
                </tr>
            <?php endforeach; ?>
        </table> 
    </body>
</html>