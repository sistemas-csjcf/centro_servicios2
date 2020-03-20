<?php 
    require_once "../conectar.php";
    $link=conectarse();
    $fechaI = $_GET['fechaI'];
    $fechaF = $_GET['fechaF'];
    $radica = $_GET['radicado'];
    $idj    = $_GET['idJ'];
    //echo $fechaI." ff ".$fechaF." radi ".$radica;
    if($radica != ""){
        $filtro_radicado = " AND radicado LIKE '%$radica%'";
    }
    if($fechaI != "" && $fechaF!=""){
        $filtro_Fecha = " AND fecharegistro BETWEEN '$fechaI' AND '$fechaF'";
    }
    mysql_set_charset('utf8');
    $sql="SELECT * FROM signot_proceso
        WHERE idjuzgadoorigen = '$idj' $filtro_radicado  $filtro_Fecha
        ORDER BY id DESC";
    $res=mysql_query($sql,$link);
?>
<table border="0" align="center"  rules="rows" id="tablaconsulta">		
    <tr>
        <td>
            <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_editar1">
                <thead> 
                    <tr>
                        <th bgcolor="#CDE3F9" colspan="4"><center><div id="titulo_frm"><?php echo strtoupper("PROCESOS"); ?></div></center></th>
                    </tr>
                    <tr> 
                        <th>ID</th>
                        <th>RADICADO</th>
                        <th>VER</th>
                    </tr> 
                </thead> 
                <tbody> 									
                    <?php while($row = mysql_fetch_array($res)){ ?>
                        <tr>
                            <td><?php echo $row['id'];?></td>
                            <td><?php echo $row['radicado'];?></td>
                            <td><a href="javascript:void(0);" onclick="verINFO_seguimientoProcesoJ(<?php echo $row['id'];?>)"><img src="views/images/buscar.png" width="35" height="35" title="VER CONTENIDO"/></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>				
        </td>
    </tr>		
</table>