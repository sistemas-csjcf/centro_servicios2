<?php
    session_start();
    $_SESSION['nombre'];
    $id_user = $_SESSION['idUsuario'];
    require_once "../../core/conexion.php";
    $link=conectarse();
    
    $inicio = $_GET['inicio'];
    $fin    = $_GET['fin'];
    $lider  = $_GET['lider'];
    
    if($lider == "all"){
        $filtroLider = "";
    }else{
        $filtroLider = "AND juz.idusuariojuzgadocargo = '$lider'";
    }
    $sql="SELECT count(*) AS cantidad, pro.radicado AS radicado ,pro.idjuzgadoorigen AS IDjuzgado, juz.nombre AS juzgado, 
        pa.fecha_gestionAgotada AS fecha, pro.id AS id, juz.idusuariojuzgadocargo AS lider
        FROM signot_proceso AS pro
        INNER JOIN signot_proceso_anotacion AS pa ON pro.id = pa.idradicado
        INNER JOIN pa_juzgado AS juz ON pro.idjuzgadoorigen = juz.id
        WHERE pa.fecha_gestionAgotada BETWEEN '$inicio' AND '$fin'
        AND pa.mostrar_alerta ='1'".$filtroLider."
        GROUP BY pro.id ";
    
    $res=mysql_query($sql,$link);
    $num_res = mysql_num_rows($res);
    if(isset($id_user)){
        if($num_res<1){
?>
            <div class="alert alert-danger" role="alert">Resultado Cantidad Registros: <?php echo $num_res; ?></div>
        <?php }else{ ?>
            <div class="alert alert-info" role="alert">Resultado Cantidad Registros: <?php echo $num_res; ?></div>
        <table id="example" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #4682B4; color: white;">
                    <th title="Código Proceso">ID</th>
                    <th>Radicado</th>
                    <th>Juzgado</th>
                    <th>Fecha Gestión Agotada</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row=mysql_fetch_array($res)){ ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['radicado']; ?></td>
                        <td><?php echo $row['juzgado']; ?></td>
                        <td><?php echo $row['fecha']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>