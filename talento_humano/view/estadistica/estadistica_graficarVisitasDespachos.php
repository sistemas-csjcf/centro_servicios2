<?php  
    include ("../../app/libs/jpgraph/jpgraph.php"); 
    require_once '../../app/libs/jpgraph/jpgraph_bar.php';
    require_once "../../core/conexion.php";
    $link=conectarse();
    $inicio = $_POST['inicio'];
    $fin    = $_POST['fin'];
    $sql="SELECT COUNT(*) AS cantidad, empleado AS Juzgado
            FROM visitas_programacion AS vp
            INNER JOIN pa_usuario AS us ON vp.vis_pro_id_usuario = us.id
        AND vis_pro_fecha_visita BETWEEN '$inicio' AND '$fin'
        GROUP BY us.id ";
    $res=mysql_query($sql,$link);
    $Nombre=array();
    $cantidad=array();
    while($row = mysql_fetch_array($res)){
       $cantidad[]=$row[0];
       $Nombre[]=$row[1];
    }   
    //Creamos el grafico
    $grafico = new Graph(1400, 700, 'auto');
    $grafico->SetScale("textint");
    $grafico->title->Set("CANTIDAD DE SOLICITUD VISITA DESPACHO");
    $grafico->title->SetFont(FF_ARIAL,FS_BOLD,19);
    $grafico->xaxis->title->Set("DESPACHO JUDICIAL");
    $grafico->xaxis->title->SetMargin(3);
    $grafico->xaxis->SetColor('darkslategray');
    $grafico->xaxis->SetFont(FF_ARIAL , FS_NORMAL,9);
    $grafico->xaxis->SetLabelAngle(0);
    $grafico->xaxis->SetLabelAlign('center');
    $grafico->xaxis->SetTickLabels($Nombre);
    $grafico->yaxis->title->Set("Cantidad Solicitudes Visitas");
    $grafico->yaxis->title->SetMargin(1);
    $barplot1 =new BarPlot($cantidad);
    // Un gradiente Horizontal de morados
    $barplot1->SetFillGradient("green", "#4169E1", GRAD_HOR);
    $barplot1->SetWidth(70);
    $grafico->Add($barplot1);
    $barplot1->value->Show();
    $grafico->Stroke();
?>