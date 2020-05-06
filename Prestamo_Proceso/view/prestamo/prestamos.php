
<h1 class="page-header">Solicitudes Prestamos</h1>

<div class="well well-sm text-right">
    <a class="btn btn-primary" href="?c=Prestamo&a=Crud">Nueva Solicitud</a>
</div>

<table id="example_historial" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
        <tr style="background-color: #A82E14; color: white;">
            <th title="Código Solicitud Prestamo">ID</th>
            <th>Fecha</th>
            <th>Despacho</th>
            <th style="width:120px;">Información Archivo</th>
            <th>Radicado</th>
            <th style="width:120px;">Proceso</th>
            <th style="width:120px;">Demandante</th>
            <th style="width:120px;">Demandado</th>
            <th>Observaciones</th>
            <!--<th style="width:60px;">Editar</th>-->
            <th style="width:60px;">Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($this->model->Listar() as $r): ?>
            <tr>
                <td><?php echo $r->pre_id; ?></td>
                <td><?php echo $r->pre_fecha; ?></td>
                <td><?php echo $r->pre_juzgado; ?></td>
                <td><?php echo $r->pre_info_archivo; ?></td>
                <td><?php echo $r->pre_radicado; ?></td>
                <td><?php echo $r->pre_subclase_proceso; ?></td>
                <td><?php echo $r->pre_demandante; ?></td>
                <td><?php echo $r->pre_demandado; ?></td>
                <td><?php echo $r->pre_observaciones; ?></td>
    <!--            <td>
                    <a href="?c=Prestamo&a=Crud&id=<?php echo $r->pre_id; ?>">Editar</a>
                </td>-->
                <td>
                    <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=Prestamo&a=Eliminar&id=<?php echo $r->pre_id; ?>&radicado=<?php echo $r->pre_radicado; ?>" style="text-decoration: none;"><span class="icon-cancel-circle" style="font-size: 20px;"></span></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table> 