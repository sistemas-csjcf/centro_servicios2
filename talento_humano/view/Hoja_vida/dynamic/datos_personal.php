<?php
    require_once "../../../core/conexion.php";
    require_once '../../../model/hojaVida_model.php';;
    $modelo = new HojaVida();
    $link=conectarse();
    $id = $_REQUEST['idUS'];
    //echo "dsada  ".$id;
    /*$rs="SELECT `per_id`, `per_id_usuario`, `per_cedula`, `per_nombres`, `per_apellidos`, `per_fecha_nacimiento`, 
                `per_id_dep_nacimiento`, `per_id_ciu_nacimiento`, `per_direccion`, `per_telefono`, `per_celular`, `per_email`, `per_ruta_foto`, 
                dep.nombre AS departamento, mun.nombre AS municipio
                FROM `th_personas` AS per
                INNER JOIN pa_departamento AS dep ON per.per_id_dep_nacimiento = dep.id
                INNER JOIN pa_municipio AS mun ON per.per_id_ciu_nacimiento = mun.id
                WHERE `per_id_usuario` = '$id'";*/
				
	
	//SE CAMBIO POR LEFT JOIN , YA QUE SI NO EXISTE DATO EN per_id_dep_nacimiento Y per_id_ciu_nacimiento
	//NO MUESTRA INFORMACION
	//CAMBIO REALIZADO POR INGENIERO JORGE ANDRES VALENCIA 10 DE FEBRERO 2020
	$rs="SELECT `per_id`, `per_id_usuario`, `per_cedula`, `per_nombres`, `per_apellidos`, `per_fecha_nacimiento`, 
                `per_id_dep_nacimiento`, `per_id_ciu_nacimiento`, `per_direccion`, `per_telefono`, `per_celular`, `per_email`, `per_ruta_foto`, 
                dep.nombre AS departamento, mun.nombre AS municipio
                FROM `th_personas` AS per
                LEFT JOIN pa_departamento AS dep ON per.per_id_dep_nacimiento = dep.id
                LEFT JOIN pa_municipio AS mun ON per.per_id_ciu_nacimiento = mun.id
                WHERE `per_id_usuario` = '$id'";
				
    $res1=mysql_query($rs,$link);
    
?>

<div class="panel panel-info">
    <div class="panel-heading">Datos Personales</div>
    <div class="panel-body"><p></p></div>
    <table id="example4" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Fecha Nacimiento</th>
                <th title="Lugar Nacimiento">Lugar Nacimiento</th>
                <th title="Dirección Residencia">Dirección</th>
                <th>Teléfono</th>
                <th>Correo Electrónico</th>
            </tr>
        </thead>
        <tbody>
            <?php while($r = mysql_fetch_array($res1)){ ?>
                <tr>
                    <td><?php echo $r['per_cedula']; ?></td>
                    <td><?php echo $r['per_nombres']." ".$r['per_apellidos']; ?></td>
                    <td><?php echo $r['per_fecha_nacimiento']; ?></td>
                    <td><?php echo $r['departamento'].", ".$r['municipio']; ?></td>
                    <td><?php echo $r['per_direccion']; ?></td>
                    <td><?php echo $r['per_telefono']." - ".$r['per_celular']; ?></td>
                    <td><?php echo $r['per_email']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div><br/>
<script>
    $(document).ready(function() {
        $('#example4').DataTable();
        $('#example_historial').DataTable( {
            "order": [[ 0, "desc" ]]
        });
    } );
    $('.selectpicker').selectpicker({
        style: 'btn-info',
        size: 4
    });
</script> 