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
                    <th title="Código Encuesta">ID</th>
                    <th>Fecha</th>
                    <th title="empleado">Empleado</th>
                    <th>Encuestado</th>
                    <th>Calificación</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <?php foreach($this->model->Listar_Historial_Encuestas() as $r): ?>
                <tr>
                    <td><?php echo $r->enc_id; ?> <i class="fa fa-flag" aria-hidden="true" style="color: green"></i> </td>
                    <td><?php echo $r->enc_fecha; ?></td>
                    <td><?php echo $r->empleado; ?></td>
                    <td><?php echo $r->nombre; ?></td>
                    <td><?php echo $r->enc_calificacion; ?></td>
                    <td><?php echo $r->enc_observaciones; ?></td>
                </tr>
            <?php endforeach; ?>
        </table> 
    </body>
</html>