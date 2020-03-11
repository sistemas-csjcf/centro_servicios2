<?php

class archivoController extends controllerBase

{



/*---------- Mensajes -------------*/

	

	public function mensajes()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';

		$ls = new archivoModel();

		$ls->mensajes();

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }

	}


/*------------- Registrar Seguimiento -------------------*/

	public function regseguimiento()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';



			$lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$ls = new archivoModel();

	 	 			
			$rs1=$ld->listarEmpleados();
			$rs2=$ln->listarJuzgados();
			$rs3=$ls->listardias_nohabiles();
			
			$data['datos_empleados']=$rs1;
			$data['datos_juzgados']=$rs2;
			$data['datos_dias'] = $rs3;

						

			if($_POST)

			{

			 $lu->registrarSeguimiento();

			}

			

			$this->view->show("archivo_registrar_seguimiento.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}

	

	
	/*---------------------- Listar todos los seguimientos -------------------*/

	public function listarSeguimientos()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';

		

		$ls = new archivoModel();

       // $rs1 = $ls->listarSeguimientos();

		

		

		//$data['datos_seguimientos'] = $rs1;

		

		$this->view->show("index_listaSeguimiento.php", $data);

      }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}

	

		/*------------- Consultar Seguimiento -----------------------------*/

	public function show_seguimiento()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';



			$ls = new archivoModel();

			

			$rs1=$ls->listarSeguimiento();

			$data['datos_seguimientos'] = $rs1;

			

					

			$this->view->show("archivo_consultar.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}

	

	 /*------------- Editar Seguimiento -------------------------*/

	public function edit_seguimiento()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';

		

		$ls = new archivoModel();
		$ld = new archivoModel();
		$ln = new archivoModel();

		$rs1=$ls->listarSeguimiento();
		$rs=$ld->listarEmpleados();
		$rs2=$ln->listarJuzgados();
			
			$data['datos_empleados']=$rs;
			$data['datos_juzgados']=$rs2;
			$data['datos_seguimientos'] = $rs1;	

				

		if($_POST)

		{

			$ls->updateSeguimiento();	

			

		}

		

		$this->view->show("archivo_modificar.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }

	}


 /*------------- Editar Inventario Entrante -------------------------*/

	public function edit_acta_entrante(){
  		if($_SESSION['id']!=""){
			require 'models/archivoModel.php';

		    $lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$lf = new archivoModel();
			$ls = new archivoModel();
			$lg = new archivoModel();
			$lc = new archivoModel();
			
			$rs1=$ld->listarEmpleadosJefe();
			$rs2=$ln->listarJuzgados();
			$rs3=$lf->listarJuzgados();
			$rs4=$lu->listarInventarioEspecifico();
			$rs5=$lg->listardias_nohabiles();
			$rs6=$lc->listarConsecutivo();
			
			$data['datos_empleados']=$rs1;
			$data['datos_juzgados']=$rs2;
			$data['datos_juzgadosdestino']=$rs3;
			$data['datos_inventario']=$rs4;
			$data['datos_dias']=$rs5;
			$data['datos_consecutivo']=$rs6;

			if($_POST){
				$ls->updateInventarioEntrante();	
			}
			$this->view->show("archivo_modificar_inventario_entrante.php", $data);
  		}else{
			header("refresh: 0; URL=/centro_servicios2/");
	  	}
	}

/*------------- Editar Inventario Saliente -------------------------*/

	public function edit_acta_saliente()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';

		

		    $lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$lf = new archivoModel();
			$ls = new archivoModel();
			$lc = new archivoModel();
			$lg = new archivoModel();

			
			$rs1=$ld->listarEmpleadosJefe();
			$rs2=$ln->listarJuzgados();
			$rs3=$lf->listarJuzgados();
			$rs4=$lu->listarInventarioEspecifico();
			$rs5=$lg->listardias_nohabiles();
			$rs6=$lc->listarConsecutivo_entrega();
			
			$data['datos_empleados']=$rs1;
			$data['datos_juzgados']=$rs2;
			$data['datos_juzgadosdestino']=$rs3;
			$data['datos_inventario']=$rs4;
			$data['datos_dias']=$rs5;
			$data['datos_consecutivo']=$rs6;

				

		if($_POST)

		{

			$ls->updateInventarioSaliente();	

			

		}

		

		$this->view->show("archivo_modificar_inventario_saliente.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }

	}


	 /*------------- Eliminar Seguimiento -------------------------*/

	public function elim_seguimiento()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';

		

			$ls = new archivoModel();

			$ls->eliminarSeguimiento();	

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }

	    	

	}

	/*------------- Eliminar Inventario Entrante -------------------------*/

	public function elim_inventarioEntrante()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';

		

			$ls = new archivoModel();

			$ls->eliminarInventarioEntrante();	

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }

	    	

	}

	/*------------- Eliminar Inventario Saliente -------------------------*/

	public function elim_inventarioSaliente()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';

		

			$ls = new archivoModel();

			$ls->eliminarInventarioSaliente();	

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }

	    	

	}

	

	/*------------- Entregar Documento -------------------------*/

	public function entrega_documento()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';

		

			$ls = new archivoModel();

			$ls->entregaDocumento();	

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }

	    	

	}

	

	/*---------------------- Subir Documento -------------------*/

	public function subir_documento()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';



			$ls = new archivoModel();

			

			if($_POST)

			{

			 $ls->subirDocumento();

			} 

			

			$this->view->show("archivo_subirInforme.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }

	}

	

	/*---------------------- Listar Documentos -------------------*/

	public function listar_documentos()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';



			$ls = new archivoModel();

			$rs1 = $ls->listarDocumentosInformes();

			$data['datos_documentos'] = $rs1;

						

			$this->view->show("archivo_listarInformes.php", $data);

	  }

	  

	  

	}

	/*------------- Registrar Recibido Inventario -------------------*/

	public function regRecibidoInventario()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';



			$lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$lf = new archivoModel();
			$lg = new archivoModel();
			$lc = new archivoModel();
			
			$rs1=$ld->listarEmpleadosJefe();
			$rs2=$ln->listarJuzgados();
			$rs3=$lf->listarJuzgados();
			$rs4=$lg->listardias_nohabiles();
			$rs5=$lc->listarConsecutivo();
			
			$data['datos_empleados']=$rs1;
			$data['datos_juzgados']=$rs2;
			$data['datos_juzgadosdestino']=$rs3;
			$data['datos_dias']=$rs4;
			$data['datos_consecutivo']=$rs5;

						

			if($_POST)

			{

			 $lu->registrarInventarioEntrante();

			}

			

			$this->view->show("archivo_registrar_inventario_entrante.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}

	
/*------------- Registrar Salida Inventario -------------------*/

	public function regSalidaInventario()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';



			$lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$lf = new archivoModel();
			
			$rs1=$ld->listarEmpleadosJefe();
			$rs2=$ln->listarJuzgados();
			$rs3=$lf->listarJuzgados();
			
			$data['datos_empleados']=$rs1;
			$data['datos_juzgados']=$rs2;
			$data['datos_juzgadosdestino']=$rs3;

						

			if($_POST)

			{

			 $lu->registrarInventarioSaliente();

			}

			

			$this->view->show("archivo_registrar_inventario_saliente.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}

	/*---------------------- Listar actas de recibidos -------------------*/

	public function listRecibidoInventario()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';

		

		$ls = new archivoModel();

        $rs1 = $ls->listarRecibidos();
		

		$data['datos_recibidos'] = $rs1;		

		$this->view->show("index_listaRecibidoInventario.php", $data);

      }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}

/*---------------------- Listar actas de entregas -------------------*/

	public function listEntregaInventario()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';

		

		$ls = new archivoModel();

        $rs1 = $ls->listarEntregados();
		

		$data['datos_entregados'] = $rs1;		

		$this->view->show("archivo_listar_entregados.php", $data);

      }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}


/*------------- Consultar Inventario -----------------------------*/

	public function show_inventario()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';



			$ls = new archivoModel();

			

			$rs1=$ls->listarInventarioEspecifico();

			$data['datos_inventario'] = $rs1;

			

					

			$this->view->show("archivo_consultar_acta_recibido.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}

/*------------- Consultar Inventario Saliente -----------------------------*/

	public function show_inventariosaliente()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';



			$ls = new archivoModel();

			

			$rs1=$ls->listarInventarioEspecificoSaliente();

			$data['datos_inventario'] = $rs1;

			

					

			$this->view->show("archivo_consultar_acta_saliente.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}
	
/*------------- Registrar Informe Gestión -----------------------------*/

	public function regGestion()

	{

	  if($_SESSION['id']!=""){

	  require 'models/archivoModel.php';
      
	  $ls = new archivoModel();
	  $lu = new archivoModel();
	  $ld = new archivoModel();

	  $rs1=$ls->listarAno();
	  $rs2=$ld->listardias_nohabiles();
	  $data['datos_anos'] = $rs1;
	
			
			if($_POST)
            {
			$lu->registrarInformeGestion();
			}
 		$this->view->show("archivo_registrar_gestion.php", $data);

	   }
	  else{
    	header("refresh: 0; URL=/centro_servicios2/");
		  }

	}
	
	/*------------- Consultar Informe Gestión -----------------------------*/

	public function consultarGestion()

	{

	  if($_SESSION['id']!=""){

	  require 'models/archivoModel.php';
      
	  $ls = new archivoModel();
	  $lu = new archivoModel();

	  $rs1=$ls->listarAno();
	  $data['datos_anos'] = $rs1;
			
		$this->view->show("archivo_consultar_gestion.php", $data);

	   }
	  else{
    	header("refresh: 0; URL=/centro_servicios2/");
		  }

	}
	
	
	
	/*------------- Consultar Informe Gestión -----------------------------*/

	public function consultarGestion1()

	{

	  if($_SESSION['id']!=""){

	  require 'models/archivoModel.php';
      
	  $ls = new archivoModel();
	  $lu = new archivoModel();

	  $rs1=$ls->consultarInformeGestion();
	  $data['datos_gestion'] = $rs1;
			
		$this->view->show("archivo_consultar_gestion1.php", $data);

	   }
	  else{
    	header("refresh: 0; URL=/centro_servicios2/");
		  }

	}
	
	
	/*------------- Modificar Informe Gestión -----------------------------*/

	public function modificarGestion()

	{

	  if($_SESSION['id']!=""){

	  require 'models/archivoModel.php';
      
	  $ls = new archivoModel();
	  $lu = new archivoModel();

	  $rs1=$ls->listarAno();
	  $data['datos_anos'] = $rs1;
			
		$this->view->show("archivo_modificar_gestion.php", $data);

	   }
	  else{
    	header("refresh: 0; URL=/centro_servicios2/");
		  }

	}
	
	/*------------- Modificar Informe Gestión -----------------------------*/

	public function modificarGestion1()

	{

	  if($_SESSION['id']!=""){

	  require 'models/archivoModel.php';
      
	  $ls = new archivoModel();
	  $lu = new archivoModel();

	  $rs1=$ls->consultarInformeGestion();
	  $data['datos_gestion'] = $rs1;
	  
	  if($_POST)
            {
			$lu->modificarInformeGestion();
			}
	  
	  
			
		$this->view->show("archivo_modificar_gestion1.php", $data);

	   }
	  else{
    	header("refresh: 0; URL=/centro_servicios2/");
		  }

	}
	
/*------------- Modificar Informe Gestión -----------------------------*/

	/*public function editGestion()

	{

	  if($_SESSION['id']!=""){

	  require 'models/archivoModel.php';
      
	  $ls = new archivoModel();
	  $lu = new archivoModel();

	  $rs1=$ls->listarAno();
	  $data['datos_anos'] = $rs1;
			
			if($_POST)
            {
			$lu->modificarInformeGestion();
			}
 		$this->view->show("archivo_modificar_gestion1.php", $data);

	   }
	  else{
    	header("refresh: 0; URL=/centro_servicios2/");
		  }

	}
	
	*/

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	
	
/*******************************************************************************************************************/	
/************************************************ REPORTES POR MÓDULO **********************************************/
/*******************************************************************************************************************/
	
/******************************************* Reporte Producción Diaria *********************************************/	
	
		public function ReporteProduccionDiaria()
	{
	  if($_SESSION['id']!=""){
	  
		  require 'models/archivoModel.php';
		  $this->view->show("reporte_produccion_diaria.php");
	  }
	  
	  else{
		header("refresh: 0; URL=/centro_servicios2/");
	  }	
	}

/****************** Redirecciona a la generación del gráfico del reporte Producción Diaria *************************/	
public function  ReporteProduccionDiaria1()
	{
	  if($_SESSION['id']!=""){
	  
		require 'models/archivoModel.php';
	    require 'models/barrasModel.php';
			
		
		$this->view->show("reporte_produccion_diaria1.php");
      }
	  
	  else{
		header("refresh: 0; URL=/centro_servicios2/");
	  }	
	}	
	

/**************************************** Reporte Producción Rango de Fechas ********************************************/	
	
		public function ReporteProduccionRango()
	{
	  if($_SESSION['id']!=""){
	  
		  require 'models/archivoModel.php';
		  $this->view->show("reporte_produccion_rango.php");
	  }
	  
	  else{
		header("refresh: 0; URL=/centro_servicios2/");
	  }	
	}

/************** Redirecciona a la generación del gráfico del reporte Producción Rango de Fechas ***********************/	
public function  ReporteProduccionRango1()
	{
	  if($_SESSION['id']!=""){
	  
		require 'models/archivoModel.php';
	    require 'models/barrasModel.php';
			
		$this->view->show("reporte_produccion_rango1.php");
      }
	  
	  else{
		header("refresh: 0; URL=/centro_servicios2/");
	  }	
	}	
	
	
/**************************************** Reporte Producción Juzgado ********************************************/	
	
		public function ReporteProduccionJuzgado()
	{
	  if($_SESSION['id']!=""){
	  
		   require 'models/pieModel.php';
		    $lu = new pieModel();
			$rs1=$lu->obtenerJuzgadosProcesosCajas();
			
			
			$cantidad= count($rs1);
	    	$i=0;
	    	while ($i<$cantidad)
	   		{
	   		$vector_juz[$i]=$rs1[$i][nombre_juz];
			$vector_caj[$i]=$rs1[$i][caja];
			$vector_pros[$i]=$rs1[$i][proces];
	   		
	 		$i = $i+1; 
	   		}
			
			//print_r($vector_juz);
			$data['datos_despachos']=$vector_juz;
			$data['datos_cajas']=$vector_caj;
			$data['datos_procesos']=$vector_pros;
				
			   
		   
		  $this->view->show("reporte_produccion_juzgado.php",$data);
	  }
	  
	  else{
		header("refresh: 0; URL=/centro_servicios2/");
	  }	
	}
	
/**************************************** Reporte Entrantes vs Salientes ********************************************/	
	
		public function ReporteEntrantesSalientes()
	{
	   if($_SESSION['id']!=""){
	   
	   
		  require 'models/archivoModel.php';

			$ln = new archivoModel();
			
			$rs2=$ln->listarJuzgados();
			
			$data['datos_juzgados']=$rs2;
			
		  $this->view->show("reporte_entrante_saliente.php",$data);
	  }
	  
	  else{
		header("refresh: 0; URL=/centro_servicios2/");
	  }	
	}
	
/**************************************** Reporte Entrantes vs Salientes ********************************************/	
	
		public function ReporteEntrantesSalientes1()
		
		{
	   if($_SESSION['id']!=""){
	   
	   
		  require 'models/archivoModel.php';

			$ln = new archivoModel();
			$lr = new archivoModel();
			$ls = new archivoModel();
			
			$rs1=$ln->listarEntrantesReporte1();
			$rs2=$lr->listarSalientesReporte1();
			$rs3=$ls->nombreJuzgado();
			
			$data['datos_entrantes']=$rs1;
			$data['datos_salientes']=$rs2;
			$data['nombre_juzgado']=$rs3;
			
		  $this->view->show("reporte_entrante_saliente2.php",$data);
	  }
	  
	  else{
		header("refresh: 0; URL=/centro_servicios2/");
	  }	
	}
		
	/*{
	   if($_SESSION['id']!=""){
	   
	   
		  require 'models/archivoModel.php';

			$ln = new archivoModel();
			$lr = new archivoModel();
			$ls = new archivoModel();
			
			$rs1=$ln->listarEntrantesReporte();
			$rs2=$lr->listarSalientesReporte();
			$rs3=$ls->nombreJuzgado();
			
			$data['datos_entrantes']=$rs1;
			$data['datos_salientes']=$rs2;
			$data['nombre_juzgado']=$rs3;
			
		  $this->view->show("reporte_entrante_saliente1.php",$data);
	  }
	  
	  else{
		header("refresh: 0; URL=/centro_servicios2/");
	  }	
	}*/
	
	
	
	
	
	
	
	/**************************************** Reporte Entrantes vs Salientes Todos ********************************************/	
	
		public function ReporteEntrantesSalientesTodos()
	{
	   if($_SESSION['id']!=""){
	   
	   
		  require 'models/archivoModel.php';

			$ln = new archivoModel();
			
		
			
		  $this->view->show("reporte_entrante_saliente_todos.php",$data);
	  }
	  
	  else{
		header("refresh: 0; URL=/centro_servicios2/");
	  }	
	}
	
	
/**************************************** Reporte Entrantes vs Salientes Todos ********************************************/	
	
		public function ReporteEntrantesSalientes_todos1()
	{
	   if($_SESSION['id']!=""){
	   
	   
		  require 'models/archivoModel.php';

			$ln = new archivoModel();
			$lr = new archivoModel();
			$ls = new archivoModel();
			
			$rs1=$ln->listarEntrantesReporteTODOS1();
			$rs2=$lr->listarSalientesReporteTODOS1();
			
			
			$data['datos_entrantes']=$rs1;
			$data['datos_salientes']=$rs2;
			
			
		  $this->view->show("reporte_entrante_saliente_Todos1.php",$data);
	  }
	  
	  else{
		header("refresh: 0; URL=/centro_servicios2/");
	  }	
	}	
	
	
	
	

	
 /*------------- Entregar Inventario Entrante -------------------------*/
 // ------------- JUAN ESTEBAN MUNERA BETANCUR 2019-03-12 ------------- //
	public function entregar_acta_entrante(){
  		if($_SESSION['id']!=""){
			require 'models/archivoModel.php';

		    $lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$lf = new archivoModel();
			$ls = new archivoModel();
			$lg = new archivoModel();
			$lc = new archivoModel();
			
			$rs1=$ld->listarEmpleadosJefe();
			$rs2=$ln->listarJuzgados();
			$rs3=$lf->listarJuzgados();
			$rs4=$lu->listarInventarioEspecifico();
			$rs5=$lg->listardias_nohabiles();
			$rs6=$lc->listarConsecutivo_entrega();
			
			$data['datos_empleados']=$rs1;
			$data['datos_juzgados']=$rs2;
			$data['datos_juzgadosdestino']=$rs3;
			$data['datos_inventario']=$rs4;
			$data['datos_dias']=$rs5;
			$data['datos_consecutivo']=$rs6;				

			if($_POST){
				$ls->entregarInventarioEntrante();	
			}
			$this->view->show("archivo_entregar_inventario_entrante.php", $data);

	  	}else{
			header("refresh: 0; URL=/centro_servicios2/");

	  	}
	}	

/*------------- Generar Acta Word -------------------*/

	public function generarActarecibido()

	{

	  if($_SESSION['id']!=""){
		

			require 'models/archivoModel.php';
			$ld = new archivoModel();
			
			
			$rs1 = $ld->generarActarecibido();
			
			
			//require 'models/wordModel.php';
		    

			

			  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}

}

?>