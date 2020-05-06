<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <table border="1">
            <thead>
                <tr style="background-color: #4682B4; color: white;">
                    <th title="empleado">EMPLEADO</th>
                    <th>CANTIDAD</th>
                </tr>
            </thead>
            <?php foreach($this->model->encuestasXcalificaion($_REQUEST['fechai'], $_REQUEST['fechaf']) as $r): ?>
                <tr>
                    <td><?php echo $r->enc_calificacion; ?></td>
                    <td><?php echo $r->cantidad; ?></td>
                </tr>
            <?php endforeach; ?>
        </table> 
    </body>
</html>