<?php  
    include ("../../app/libs/jpgraph/jpgraph.php"); 
    require_once '../../app/libs/jpgraph/jpgraph_bar.php';
    require_once "../../core/conexion.php";
    $link=conectarse();
    $inicio = $_POST['inicio'];
    $fin    = $_POST['fin'];
    $sql="SELECT count(*) AS cantidad,empleado
        FROM encuesta_satisfacion AS enc
        INNER JOIN pa_usuario AS us ON us.id = enc.enc_id_user
        WHERE enc_fecha BETWEEN '$inicio' AND '$fin'
        GROUP BY  enc_id_user ";
    $res=mysql_query($sql,$link);
    $tsNombre=array();
    $cantidad=array();
    while($row = mysql_fetch_array($res)){
       $cantidad[]=$row[0];
       $empleado[]=$row[1];
    }
    //Creamos el grafico
    $grafico = new Graph(1400, 700, 'auto');
    $grafico->SetScale("textint");
    $grafico->title->Set("CANTIDAD DE ENCUESTAS");
    $grafico->title->SetFont(FF_ARIAL,FS_BOLD,19);
    $grafico->xaxis->title->Set("EMPLEADO(S)");
    $grafico->xaxis->title->SetMargin(3);
    $grafico->xaxis->SetColor('darkslategray');
    $grafico->xaxis->SetFont(FF_ARIAL , FS_NORMAL,9);
    $grafico->xaxis->SetLabelAngle(0);
    $grafico->xaxis->SetLabelAlign('center');
    $grafico->xaxis->SetTickLabels($empleado);
    $grafico->yaxis->title->Set("Cantidad Encuestas");
    $grafico->yaxis->title->SetMargin(1);
    $barplot1 =new BarPlot($cantidad);
    // Un gradiente Horizontal de morados
    $barplot1->SetFillGradient("#4682B4", "#4169E1", GRAD_HOR);
    $barplot1->SetWidth(70);
    $grafico->Add($barplot1);
    $barplot1->value->Show();
    $grafico->Stroke();
?>