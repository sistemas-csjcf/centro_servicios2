<?php
    session_start();
    $_SESSION['nombre'];
    $id_user = $_SESSION['idUsuario'];
    require_once "../../core/conexion.php";
    $link=conectarse();
    
    $inicio = $_GET['inicio'];
    $fin    = $_GET['fin'];
    
    $sql="SELECT count(*) AS cantidad,enc_calificacion
        FROM encuesta_satisfacion AS enc
        WHERE enc_fecha BETWEEN '$inicio' AND '$fin'
        GROUP BY  enc_calificacion";
    
    $res=mysql_query($sql,$link);
    $num_res = mysql_num_rows($res);
    if(isset($id_user)){
        if($num_res<1){
?>
            <div class="alert alert-danger" role="alert">Resultado Cantidad Registros: <?php echo $num_res; ?></div>
    <?php }else{ ?>    
        <table id="example" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #4682B4; color: white;">
                    <th>Calificación</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row=mysql_fetch_array($res)){ ?>
                    <tr>
                        <td><?php echo $row['enc_calificacion']; ?></td>
                        <td><?php echo $row['cantidad']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="form-group">
            <form action="view/estadistica/estadistica_graficarEncuestasCalif.php" method="POST">
                <input type="hidden" name="inicio" id="fInicio" value="<?php echo $inicio; ?>"/>
                <input type="hidden" name="fin" id="fFin" value="<?php echo $fin; ?>"/>
                <button class="btn btn-info" ><i class="fa fa-bar-chart" aria-hidden="true"></i> Graficar</button>
            </form><br>
            <a class="btn btn-success" href="?c=Encuesta&a=estadistica_Excel_EncuestaCalif&fechai=<?php echo $inicio; ?>&fechaf=<?php echo $fin; ?>" style="text-decoration: none" class=""><i class="fa fa-file-excel-o" aria-hidden="true"></i> Generar Excel</a>
        </div>
        <div id="grafica_estadistica"></div>
    <?php } }else{ ?>
    <script type="text/javascript">alert("ERROR, Autenticación obligatoria debes iniciar sesión para ingresar a este módulo");</script>
<?php header( "refresh:2; url=http://172.16.175.124/centro_servicios2" ); } ?>