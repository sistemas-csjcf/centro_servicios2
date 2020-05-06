<?php  
    include ("../../app/libs/jpgraph/jpgraph.php"); 
    require_once '../../app/libs/jpgraph/jpgraph_bar.php';
    require_once "../../core/conexion.php";
    $link=conectarse();
    $inicio = $_POST['inicio'];
    $fin    = $_POST['fin'];
    $sql="SELECT count(*) AS cantidad, vis_TSoci_nombre,vis_TSoci_id
        FROM visitas_programacion AS pro
        INNER JOIN visitas_trabajador_social AS ts ON ts.vis_TSoci_id = pro.vis_pro_id_TSocial
        WHERE vis_TSoci_estado ='1'
        AND vis_pro_fecha_visita BETWEEN '$inicio' AND '$fin'
        AND vis_pro_estado != 'Cancelada'
        GROUP BY vis_TSoci_id ";
    $res=mysql_query($sql,$link);
    $tsNombre=array();
    $cantidad=array();
    while($row = mysql_fetch_array($res)){
       $cantidad[]=$row[0];
       $tsNombre[]=$row[1];
    }
    //Creamos el grafico
    $grafico = new Graph(1400, 700, 'auto');
    $grafico->SetScale("textint");
    $grafico->title->Set("CANTIDAD DE VISITAS PROGRAMADAS");
    $grafico->title->SetFont(FF_ARIAL,FS_BOLD,19);
    $grafico->xaxis->title->Set("Trabajadora Social");
    $grafico->xaxis->title->SetMargin(3);
    $grafico->xaxis->SetColor('darkslategray');
    $grafico->xaxis->SetFont(FF_ARIAL , FS_NORMAL,9);
    $grafico->xaxis->SetLabelAngle(0);
    $grafico->xaxis->SetLabelAlign('center');
    $grafico->xaxis->SetTickLabels($tsNombre);
    $grafico->yaxis->title->Set("Cantidad Visitas");
    $grafico->yaxis->title->SetMargin(1);
    $barplot1 =new BarPlot($cantidad);
    // Un gradiente Horizontal de morados
    $barplot1->SetFillGradient("#4682B4", "#4169E1", GRAD_HOR);
    $barplot1->SetWidth(70);
    $grafico->Add($barplot1);
    $barplot1->value->Show();
    $grafico->Stroke();
?>