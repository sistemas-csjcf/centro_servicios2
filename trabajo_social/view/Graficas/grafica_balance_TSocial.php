<?php // content="text/plain; charset=utf-8"
    require_once ('../../app/libs/jpgraph4/src/jpgraph.php');
    require_once ('../../app/libs/jpgraph4/src/jpgraph_pie.php');
    
    require_once "../../core/conexion.php";
    $sql=mysql_query("SELECT `vis_TSoci_nombre`,`vis_TSoci_contador` FROM `visitas_trabajador_social` ");
    
    while($row=mysql_fetch_array($sql)){
        $ts   = $row[0];
        $cont = $row[1];			
        
    //}
   // echo $ts    = implode(",", $ts);
   // echo $cont  = implode(",", $cont);
    $datos = array($cont);
    $leyenda = array($ts);
    }
    //Se define el grafico
    $grafico = new PieGraph(450,300);

    //Definimos el titulo
    $grafico->title->Set("Cuenta Documento");
    $grafico->title->SetFont(FF_FONT1,FS_BOLD);

    //Añadimos el titulo y la leyenda
    $p1 = new PiePlot($datos);
    $p1->SetLegends($leyenda);
    $p1->SetCenter(0.4);

    //Se muestra el grafico
    $grafico->Add($p1);
    $grafico->Stroke();
 
?>
