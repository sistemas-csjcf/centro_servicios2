<?php 
    require '../../model/hojaVida_model.php';
    require_once "core/conexion.php";
    $link=conectarse();
    $sql="SELECT * FROM th_personas WHERE per_id_usuario = '$id_user'";
    $res=mysql_query($sql,$link);
    while ($row = mysql_fetch_array($res)) {
        $user = $row[0];
    }
    $Listar_HV    = $modelo->get_Datos_HV($user);
    while($r = $Listar_HV->fetch()){
        $id_hv = $r[0];
    }
    $_REQUEST['id']; 
    $modelo = new HojaVida();
    $datos = $modelo->Obtener_datos_visita($_REQUEST['id'] );
    //echo dirname(__FILE__);
    	
    //echo $_SERVER["DOCUMENT_ROOT"];
    date_default_timezone_set('America/Bogota');
    echo $fecha_doc=date('Y-m-d g:ia');
    $anio_doc = date('Y');
?>
<!--<img src="<?php dirname(__FILE__) ?>/logo.png">-->
<!--<img src="../../assets/imagenes/logo.png"> -->
<!--<h1>Mi primer reporte</h1>-->

<h1>Solicitud Visita Domiciliaria Nº <?php echo $_GET['id_persona'] ?></h1><br><br>
<table>
    <thead>
        <tr>
            <th style="text-align:left; color: white; background-color: teal;">Fecha</th>
            <th style="text-align:left; color: white; background-color: teal;">Solicitante</th>
            <th style="text-align:left; color: white; background-color: teal;">Radicado</th>
            <th style="text-align:left; color: white; background-color: teal;">Asistente Social</th>
            <th style="text-align:left; color: white; background-color: teal;">Estado</th>
        </tr>
    </thead>
    <?php while($r = $datos->fetch()){ ?>
        <tbody>
            <tr>
                <td style="background-color: lightgrey;"><?php echo $r['vis_pro_fecha_visita']; ?></td>
                <td style="background-color: lightgrey;"><?php echo $r['vis_pro_solicitante']; ?></td>
                <td style="background-color: lightgrey;"><?php echo $r['vis_pro_radicado']; ?></td>
                <?php if( $r['vis_pro_estado'] =='Pendiente'){ ?>
                    <td style="background-color: lightgrey;">PENDIENTE</td>
                <?php }else if($r['vis_pro_estado'] == 'Cancelada'){ ?>
                    <td style="background-color: lightgrey;">CANCELADA</td>
                <?php }else{ ?>    
                    <td style="background-color: lightgrey;"><?php echo $r['vis_TSoci_nombre']; ?></td>
                <?php } ?>
                <td style="background-color: lightgrey;"><?php echo $r['vis_pro_estado']; ?></td>
            </tr>
        </tbody>
    <?php } ?>
</table>
<div style="text-align: center; font-size: 10px; margin-top: 50px; line-height:1%">
    <p>CENTRO DE SERVICIOS CIVIL - FAMILIA</p>
    <p>CARRERA 23 # 21-48 OFICINA 108</p>
    <P>TELÈFONO 887 9620</p>
    <P>MANIZALES CALDAS</P>
    <p><?php echo $anio_doc ?></p>
</div>