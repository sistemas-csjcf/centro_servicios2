<html>
    <head>
        <meta charset="utf-8" />
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
        <table border="1">
            <thead>
                <tr style="background-color: #4682B4; color: white;">
                    <th colspan="3">Despacho</th>
                    <th colspan="2">Cantidad</th>
                </tr>
            </thead>
            <?php foreach($this->model->GraficarVisitasDespachos($_REQUEST['fechai'], $_REQUEST['fechaf']) as $r): ?>
                <tr>
                    <td colspan="3"><?php echo $r->Juzgado; ?></td>
                    <td colspan="2"><?php echo $r->cantidad; ?></td>
                </tr>
            <?php endforeach; ?>
        </table> 
    </body>
</html>