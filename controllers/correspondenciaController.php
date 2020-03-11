<?php
class correspondenciaController extends controllerBase
{
/*---------- Mensajes -------------*/
	public function mensajes()
	{
	  if($_SESSION['id']!=""){
		require 'models/correspondenciaModel.php';

		$ls = new correspondenciaModel();

		$ls->mensajes();

	  }
	  else{
		header("refresh: 0; URL=/centro_servicios2/");
	  }
	}
/*------------- Registrar Correspondencia -------------------*/
	public function regcorrespondencia()
	{
	  if($_SESSION['id']!=""){
		require 'models/correspondenciaModel.php';
		require 'models/archivoModel.php';
			$lu = new correspondenciaModel();
			$ld = new correspondenciaModel();
			$ls = new correspondenciaModel();
			$lt = new correspondenciaModel();
			$ln = new archivoModel();
			$rs3=$lu->listarDepartamentos();
			$rs2=$ln->listarJuzgados();
			$rs1=$ls->listarMedio();
			$rs4=$lt->listarActuacion();
			$data['datos_juzgados']=$rs2;
			$data['datos_medio']=$rs1;
			$data['datos_departamentos']=$rs3;
			$data['datos_actuacion']=$rs4;

			if($_POST)
			{
			 $lu->registrarCorrespondencia();

			}

			

			$this->view->show("correspondencia_registrar.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}
/*------------- Registrar Correspondencia Tutela-------------------*/

	public function regcorrespondenciatutela()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';
		require 'models/archivoModel.php';



			$lu = new correspondenciaModel();
			$lr = new correspondenciaModel();			
			$ln = new archivoModel();
			
			
			$rs1=$lr->listarRadicadosTutelasExistentes();
			$rs2=$ln->listarJuzgados();
			
			
			
			$data['datos_juzgados']=$rs2;
			$data['datos_radicados']=$rs1;
	
						

			if($_POST)

			{

			 $lu->registrarCorrespondenciaTutela();

			}

			

			$this->view->show("correspondencia_registrarTutela.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}
	
/*------------- Registrar Correspondencia Otro -------------------*/

	public function regcorrespondenciaotro()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';
		require 'models/archivoModel.php';



			$lu = new correspondenciaModel();
			$ln = new archivoModel();
			$ls = new correspondenciaModel();
			
			
			
			$rs1=$ls->listarMedio();
			$rs2=$ln->listarJuzgados();
			$rs3=$lu->listarDepartamentos();
			
					
			
			$data['datos_medio']=$rs1;
			$data['datos_juzgados']=$rs2;
			$data['datos_departamentos']=$rs3;
			
		
						

			if($_POST)

			{

			 $lu->registrarCorrespondenciaOtro();

			}

			

			$this->view->show("correspondencia_registrar_otro.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}


/*------------- Registrar Correspondencia Incidente -------------------*/

	public function regcorrespondenciaincidente()
	{
	  if($_SESSION['id']!=""){
		require 'models/correspondenciaModel.php';
		require 'models/archivoModel.php';
			$lv = new correspondenciaModel();
			$lt = new correspondenciaModel();
			$ld = new correspondenciaModel();
			$ls = new correspondenciaModel();
			$lu = new correspondenciaModel();
			$ln = new archivoModel();
			$li = new correspondenciaModel();
			$rs1=$ld->listarDepartamentos();
			$rs2=$lv->listarAccionadosVinculadosAccionantes();
			$rs3=$lt->listarActuacion();
			$rs4=$ls->listarMedio();
			$rs5=$ln->listarJuzgados();
			$rs6=$li->listarJuzgadoIncidente();
			
			$data['datos_departamentos']=$rs1;
			$data['datos_nombres']=$rs2;
			$data['datos_actuacion']=$rs3;
			$data['datos_medio']=$rs4;
			$data['datos_juzgados']=$rs5;
			$data['datos_juzgado']=$rs6;
			if($_POST)
			{
			$lu->registrarCorrespondenciaIncidente();
			}
			$this->view->show("correspondencia_registrarIncidente.php", $data);
	  }
	  else{
		header("refresh: 0; URL=/centro_servicios2/");
	  }
	}

	
/*---------------------- Listar todas las correspondencias -------------------*/

	public function listarCorrespondencias()
	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';

		

		$ls = new correspondenciaModel();

        //$rs1 = $ls->listarCorrespondenciasOtros();

		

		

		//$data['datos_correspondencias'] = $rs1;

		

		$this->view->show("index_listaOtror.php", $data);

      }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}

/*---------------------- Listar todas las tutelas -------------------*/

	public function listarCorrespondenciasTutelas()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';

		

		$ls = new correspondenciaModel();

        //$rs1 = $ls->listarCorrespondenciasTutelas();

		

		

		//$data['datos_correspondencias'] = $rs1;

		

		$this->view->show("index_listar_tutela.php", $data);

      }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}




	/*------------- Consultar Correspondencia -----------------------------*/

	public function show_correspondencia(){

		if($_SESSION['id']!=""){
			require 'models/correspondenciaModel.php';
			require 'models/archivoModel.php';

			$lu = new correspondenciaModel();
			$ld = new correspondenciaModel();
			$ls = new correspondenciaModel();
			$lt = new correspondenciaModel();
			$lc = new correspondenciaModel();
			$le = new correspondenciaModel();
			$lp = new correspondenciaModel();
			$la = new correspondenciaModel();
			$lv = new correspondenciaModel();
			$ln = new archivoModel();
			
			$rs1=$ln->listarJuzgados();
			$rs2=$lc->listarCorrespondenciaTutela();
			$rs3=$ld->listarPartesTutela_nv();
			$rs4=$ls->listarActuacionesTutela();			
			$rs6=$le->listarEvidencias();
			$rs7=$lp->listar_accionados();
			$rs8=$la->listar_accionante();
			$rs9=$lv->listar_vinculados();
			
			$data['datos_juzgados']=$rs1;
			$data['datos_correspondencia']=$rs2;
			$data['datos_partes']=$rs3;
			$data['datos_actuaciones']=$rs4;
			$data['datos_evidencia']=$rs6;
			$data['datos_nombres_accionados']=$rs7;
			$data['datos_accionante']=$rs8;
			$data['datos_vinculado']=$rs9;	

			$this->view->show("correspondencia_consultarTutelaIncidente.php", $data);
		}else{
			header("refresh: 0; URL=/centro_servicios2/");
		}
	}
	/*------------- Consultar Correspondencia Otro -----------------------------*/

	public function show_correspondenciaOtro()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';



			$ls = new correspondenciaModel();
			$la = new correspondenciaModel();
			$le = new correspondenciaModel();

			

			$rs1=$ls->consultarOtros();
			$rs3=$le->listarEvidenciasOtros();

			$data['datos_correspondencia'] = $rs1;
			$data['datos_evidencia'] = $rs3;

			

					

			$this->view->show("correspondencia_consultar.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}

		
/*------------- Modificar Correspondencia -------------------*/

	public function edit_correspondencia()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';
		require 'models/archivoModel.php';



			$lu = new correspondenciaModel();
			$ld = new correspondenciaModel();
			$ls = new correspondenciaModel();
			$lt = new correspondenciaModel();
			$lc = new correspondenciaModel();
			$le = new correspondenciaModel();
			$ln = new archivoModel();
			
			
			$rs3=$lu->listarDepartamentos();
			$rs2=$ln->listarJuzgados();
			$rs1=$ls->listarMedio();
			$rs4=$lt->listarActuacion();
			$rs5=$lc->listarCorrespondencia();
			$rs6=$le->listarEvidencias();
			
			
			$data['datos_juzgados']=$rs2;
			$data['datos_medio']=$rs1;
			$data['datos_departamentos']=$rs3;
			$data['datos_actuacion']=$rs4;
			$data['datos_correspondencia']=$rs5;
			$data['datos_evidencia']=$rs6;

						

			if($_POST)

			{

			 //$lu->registrarCorrespondencia();

			}

			

			$this->view->show("correspondencia_modificar.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}

/*------------- Modificar Correspondencia Tutela -------------------*/

	public function edit_correspondenciaTutela()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';
		require 'models/archivoModel.php';



			$lu = new correspondenciaModel();
			$ld = new correspondenciaModel();
			$ls = new correspondenciaModel();
			$lt = new correspondenciaModel();
			$lc = new correspondenciaModel();
			$le = new correspondenciaModel();
			$lp = new correspondenciaModel();
			$la = new correspondenciaModel();
			$lv = new correspondenciaModel();
			$ln = new archivoModel();
			
			
			$rs1=$ln->listarJuzgados();
			$rs2=$lc->listarCorrespondenciaTutela();
			//$rs3=$ld->listarPartesTutela();
			$rs3=$ld->listarPartesTutela_nv();
			$rs4=$ls->listarActuacionesTutela();			
			$rs6=$le->listarEvidencias();
			$rs7=$lp->listar_accionados();
			$rs8=$la->listar_accionante();
			$rs9=$lv->listar_vinculados();
			
			
			
			$data['datos_juzgados']=$rs1;
			$data['datos_correspondencia']=$rs2;
			$data['datos_partes']=$rs3;
			$data['datos_actuaciones']=$rs4;
			$data['datos_evidencia']=$rs6;
			$data['datos_nombres_accionados']=$rs7;
			$data['datos_accionante']=$rs8;
			$data['datos_vinculado']=$rs9;

						

			if($_POST)

			{

			 $lu->modificarCorrespondenciaTutela_nv();

			}

			

			//$this->view->show("correspondencia_modificarTutela.php", $data);
			$this->view->show("correspondencia_modificarTutelaIncidente_nv.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}



/*------------- Modificar Correspondencia Otro -------------------*/

	public function edit_correspondenciaOtro()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';
		require 'models/archivoModel.php';



			$lu = new correspondenciaModel();
			$ld = new correspondenciaModel();
			$ls = new correspondenciaModel();
			$lt = new correspondenciaModel();
			$lc = new correspondenciaModel();
			$le = new correspondenciaModel();
			$lp = new correspondenciaModel();
			$ln = new archivoModel();
			
			
			$rs3=$lu->listarDepartamentos();
			$rs2=$ln->listarJuzgados();
			$rs1=$ls->listarMedio();
			$rs5=$lc->listarCorrespondenciaOtro();
			$rs6=$lp->listarCiudadOtro();
		
			
			
			$data['datos_juzgados']=$rs2;
			$data['datos_medio']=$rs1;
			$data['datos_departamentos']=$rs3;
			$data['datos_correspondencia']=$rs5;
			$data['datos_ciudad']=$rs6;

						

			if($_POST)

			{

			 $lu->modificarCorrespondencia_Otro();

			}

			

			$this->view->show("correspondencia_modificarOtro.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}

/*------------- Reporte de Excel para Correo, Fax - Correo, Fax-Correo-Correo Electronico -------------------*/
	public function excel_472()
	{
	  if($_SESSION['id']!=""){
	  require 'models/archivoModel.php';		
			$ln = new archivoModel();
			$rs1=$ln->listarJuzgados();
			$data['datos_juzgados']=$rs1;
			if($_POST)
			{
			require 'models/excelModel.php';
			}
			$this->view->show("correspondencia_generar472.php", $data);
	  }
	  else{
		header("refresh: 0; URL=/centro_servicios2/");
	  }
	}

	/*------------- Reporte de Excel para Correo Electronico, Fax y Personal -------------------*/
	public function excel_472_2()
	{
	  if($_SESSION['id']!=""){
	  require 'models/archivoModel.php';		
			$ln = new archivoModel();
			$rs1=$ln->listarJuzgados();
			$data['datos_juzgados']=$rs1;
			if($_POST)
			{
			require 'models/excelModel_2.php';
			}
			$this->view->show("correspondencia_generar472_2.php", $data);
	  }
	  else{
		header("refresh: 0; URL=/centro_servicios2/");
	  }
	}

/*------------- Registrar Turno -------------------*/

	public function regTurno()

	{
	  if($_SESSION['id']!=""){

		require 'models/correspondenciaModel.php';
		require 'models/archivoModel.php';
			$lu = new correspondenciaModel();
			$lt = new correspondenciaModel();
			$lr = new correspondenciaModel();			
			$ln = new archivoModel();
			$rs1=$lr->listarEmpleadosTodos();
			$rs2=$ln->listarJuzgados();
			$rs3=$lt->listarProcesosPersonal();
			$data['datos_juzgados']=$rs2;
			$data['datos_empleados']=$rs1;
			$data['datos_procesos']=$rs3;
			if($_POST)
			{
			$lu->registrarTurno();
			}
			$this->view->show("correspondencia_registrarTurno.php", $data);
	  }
	  else{
		header("refresh: 0; URL=/centro_servicios2/");
	  }
	}
/*---------------------- Listar todas los turnos -------------------*/

	public function listarTurnos()
	{
	  if($_SESSION['id']!=""){
		require 'models/correspondenciaModel.php';
		$ls = new correspondenciaModel();
        $rs1 = $ls->listarTurnos();
		$data['datos_turnos'] = $rs1;
		$this->view->show("index_listar_turno.php", $data);
      }
	  else{
		header("refresh: 0; URL=/centro_servicios2/");
	  }
	}
	
/*------------- Informe Dirección Word -------------------*/

	public function informeDireccion()
	{
	  if($_SESSION['id']!=""){
	  require 'models/archivoModel.php';		
			$ln = new archivoModel();
			if($_POST)
			{
			require 'models/wordModel2.php';
		   }
		$this->view->show("correspondencia_reporte_direccion_rango.php", $data);
	  }
	  else{
		header("refresh: 0; URL=/centro_servicios2/");
	  }
	}
/*------------- Reportte Notificaión Incidentes -------------------*/

	public function ReporteNotificacionIncidentes()
	{
	  if($_SESSION['id']!=""){
	  require 'models/archivoModel.php';		
			if($_POST)
			{
			require 'models/excelModel.php';
			}
			$this->view->show("correspondencia_reporte_tutelasIncidentes.php", $data);
	  }
	  else{
		header("refresh: 0; URL=/centro_servicios2/");
	  }
	}

/*---------------------- Listar todas las actuaciones -------------------*/

	public function listarActuaciones()
	{
	  if($_SESSION['id']!=""){
	/*	require 'models/correspondenciaModel.php';
		$ls = new correspondenciaModel();
        $rs1 = $ls->listarActuaciones();
		$data['datos_actuaciones'] = $rs1;*/
		$this->view->show("index_listar_actuacion.php", $data);
      }
	  else{
		header("refresh: 0; URL=/centro_servicios2/");
	  }
	}

/*---------------------- Modificar Actuación -------------------*/

	public function editarActuaciones()
	{
	  if($_SESSION['id']!=""){
		require 'models/correspondenciaModel.php';
		$ls = new correspondenciaModel();
		$ld = new correspondenciaModel();
		$lc = new correspondenciaModel();
		$lm = new correspondenciaModel();	
		$la = new correspondenciaModel();	
		$lu = new correspondenciaModel();
		$lp = new correspondenciaModel();			

        $rs1 = $ls->listarActuacion_Especifica();
		$rs2 = $ld->listarDepartamentos();
		$rs3 = $lc->listarCiudad();
		$rs4 = $lm->listarMedio();
		$rs5 = $la->listarActuacion();

		$data['datos_actuacion'] = $rs1;
		$data['datos_departamentos'] = $rs2;
		$data['datos_ciudades'] = $rs3;
		$data['datos_medio'] = $rs4;
		$data['datos_actuaciones'] = $rs5;
		if($_POST)
			{
			$lu->modificarActuación();
		   }
		$this->view->show("correspondencia_modificar_actuacion.php", $data);
      }
	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}


	 /*------------- Eliminar Actuación -------------------------*/

	public function elim_actuacion()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';

		

			$ls = new correspondenciaModel();

			$ls->eliminarActuacion();	

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }

	    	

	}
	 /*------------- Eliminar Otro -------------------------*/

	public function elim_otro()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';

		

			$ls = new correspondenciaModel();

			$ls->eliminarOtro();	

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }

	    	

	}

/*---------------------- Modificar Datos Tutela -------------------*/

	public function edit_datosTutela()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';
		require 'models/archivoModel.php';



			$lu = new correspondenciaModel();
			$lr = new correspondenciaModel();		
			$lt = new correspondenciaModel();
			$lra = new correspondenciaModel();						
			$ln = new archivoModel();
			
			
			$rs1=$lr->listarRadicadosTutelasExistentesModificar();
			$rs3=$lt->listarTutelasEditar();
			$rs2=$ln->listarJuzgados();
			$rs4=$lra->listarDatosRadicado();
			
			
			
			$data['datos_juzgados']=$rs2;
			$data['datos_radicados']=$rs1;
			$data['datos_tutela']=$rs3;
			$data['datos_radica']=$rs4;
		
		if($_POST)

			{

			$lu->modificarTutela_basico();
		   }

		

		$this->view->show("correspondencia_editarDatosTutela.php", $data);

      }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}

			
/*------------- Filtro de Actuaciones -------------------*/

	public function filtrar_actuaciones()

	{

	  if($_SESSION['id']!=""){

	  require 'models/correspondenciaModel.php';		

			$ln = new correspondenciaModel();
			

		$this->view->show("correspondencia_filtrar_actuacion.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}
	
/*------------- Filtro de Actuaciones1 -------------------*/

	public function filtrar_actuaciones1()

	{



	  if($_SESSION['id']!=""){

	  require 'models/correspondenciaModel.php';		

		 $ln = new correspondenciaModel();
		
		
			$rs1= $ln->consultar_filtro_actuacion();
			$data['datos_actuaciones']=$rs1;
			$this->view->show("correspondencia_filtrar_actuacion.php", $data);


	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}


/*------------- Filtro de Radicados -------------------*/

	public function filtrar_radicados()

	{

	  if($_SESSION['id']!=""){

	  require 'models/correspondenciaModel.php';		

			$ln = new correspondenciaModel();
	 		$lj = new correspondenciaModel();
		
		
			
			$rs2= $lj->listarJuzgado();
		
			$data['datos_juzgados']=$rs2;
			

		$this->view->show("correspondencia_filtrar_radicados.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}

/*------------- Filtro de Radicados 1 -------------------*/

	public function filtrar_radicados1()

	{



	  if($_SESSION['id']!=""){

	  require 'models/correspondenciaModel.php';		

		 $ln = new correspondenciaModel();
		 $lj = new correspondenciaModel();
		
		
			$rs1= $ln->consultar_filtro_radicado();
			$rs2= $lj->listarJuzgado();
			$data['datos_radicados']=$rs1;
			$data['datos_juzgados']=$rs2;
			$this->view->show("correspondencia_filtrar_radicados.php", $data);
			 
		    

			

		//$this->view->show("correspondencia_filtrar_actuacion.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}

/*------------- Filtro de Otros -------------------*/

	public function filtrar_otros()

	{

	  if($_SESSION['id']!=""){

	  require 'models/correspondenciaModel.php';		

			$ln = new correspondenciaModel();
	 		$lj = new correspondenciaModel();
			$lm = new correspondenciaModel();
		
		
			$rs1= $lm->listarMedio();
			$rs2= $lj->listarJuzgado();
		
			$data['datos_medios']=$rs1;
			$data['datos_juzgados']=$rs2;
			

		$this->view->show("correspondencia_filtrar_otros.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}

/*------------- Filtro de Otros 1 -------------------*/

	public function filtrar_otros1()

	{



	  if($_SESSION['id']!=""){

	  require 'models/correspondenciaModel.php';		

		 $ln = new correspondenciaModel();
		 $lj = new correspondenciaModel();
		 $lm = new correspondenciaModel();
		
		
			$rs1= $ln->consultar_filtro_otro();
			$rs2= $lj->listarJuzgado();
			$rs3= $lm->listarMedio();
	
		
			$data['datos_medios']=$rs3;
			$data['datos_otros']=$rs1;
			$data['datos_juzgados']=$rs2;
			$this->view->show("correspondencia_filtrar_otros.php", $data);
			 
		    

			

		//$this->view->show("correspondencia_filtrar_actuacion.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}
	
	
	/*------------- Filtro de Turnos -------------------*/

	public function filtrar_turnos()

	{

	  if($_SESSION['id']!=""){

	  require 'models/correspondenciaModel.php';		

			$ln = new correspondenciaModel();
	 		$lj = new correspondenciaModel();
			$lm = new correspondenciaModel();
		
		
			$rs1= $ln->listarAreasEmpleados();
			$rs2= $lj->listarJuzgado();
			
			
			
		
			$data['datos_areas']=$rs1;
			$data['datos_juzgados']=$rs2;
			

		$this->view->show("correspondencia_filtrar_turnos.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}

/*------------- Filtro de Turnos 1 -------------------*/

	public function filtrar_turnos1()

	{



	  if($_SESSION['id']!=""){

	  require 'models/correspondenciaModel.php';		

			$ln = new correspondenciaModel();
	 		$lj = new correspondenciaModel();
			$lm = new correspondenciaModel();
		
		
			$rs1= $ln->listarAreasEmpleados();
			$rs2= $lj->listarJuzgado();
			$rs3= $lm->consultar_filtro_turno();
			
			
			
		
			$data['datos_areas']=$rs1;
			$data['datos_juzgados']=$rs2;
			$data['datos_turnos']=$rs3;
			
			$this->view->show("correspondencia_filtrar_turnos.php", $data);
			 
		    

			

		//$this->view->show("correspondencia_filtrar_actuacion.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}
/*------------- Filtro de Turnos -------------------*/

	public function migracion()

	{

	  if($_SESSION['id']!=""){

	  require 'models/correspondenciaModel.php';		

			$ln = new correspondenciaModel();
	 		$lj = new correspondenciaModel();
			$lm = new correspondenciaModel();
		
		
			$rs1= $ln->consultarsaidoj();
			$rs2= $lj->listarJuzgado();
			
			
			
		
			$data['datos_saidoj']=$rs1;
			$data['datos_juzgados']=$rs2;
			

		$this->view->show("correspondencia_migracion.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}
/*------------- Filtro de Turnos -------------------*/

	public function migracion1()

	{

	  if($_SESSION['id']!=""){

	  require 'models/correspondenciaModel.php';		

			$ln = new correspondenciaModel();
	 		$lj = new correspondenciaModel();
			$lm = new correspondenciaModel();
		
		
			$rs1= $ln->consultarsaidoj();
			$rs2= $lj->listarJuzgado();
			
			
			
		
			//$data['datos_saidoj']=$rs1;
			$data['datos_juzgados']=$rs2;
			

		$this->view->show("correspondencia_migracion.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}
	
	
/*------------- Filtro de Partes -------------------*/

	public function filtrar_partes()

	{

	  if($_SESSION['id']!=""){

	  require 'models/correspondenciaModel.php';
	
	  $lj = new correspondenciaModel();
	  
	  
	  $rs2= $lj->listarJuzgado();
	 
	  $data['datos_juzgados']=$rs2;		

			

		$this->view->show("correspondencia_filtrar_partes.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}
	
/*------------- Filtro de Partes1 -------------------*/

	public function filtrar_partes1()

	{



	  if($_SESSION['id']!=""){

	  require 'models/correspondenciaModel.php';		

		 $lj = new correspondenciaModel();
	  	 $ln = new correspondenciaModel();
		 
		 $rs2= $lj->listarJuzgado();
		 $rs1= $ln->consultar_filtro_partes();
		 
		 $data['datos_partes']=$rs1;
		 $data['datos_juzgados']=$rs2;
		
		 $this->view->show("correspondencia_filtrar_partes.php", $data);


	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios2/");

	  }



	}

/*------------- Modificar Parte -------------------*/
	// JUAN ESTEBAN MUNERA BETANCUR 2019-03-29
	public function edit_parte(){
		if($_SESSION['id']!=""){
			require 'models/correspondenciaModel.php';
			$lu = new correspondenciaModel();
			$rs1=$lu->consultar_filtro_parte_especifica();
			$data['datos_parte']=$rs1;
			if($_POST){
			 	$lu->modificar_parte();
			}
			$this->view->show("correspondencia_editarParte.php", $data);

		}
		else{
			header("refresh: 0; URL=/centro_servicios2/");
		}
	}
	// ************************* JUAN ESTEBAN MUNERA BETANCUR *****************************//
	// -------------------------     10-03-2017      --------------------------------------//
	//-------------------------------------------------------------------------------------//
	
	public function crear_consolidado(){
		if($_SESSION['id']!=""){    
			require 'models/correspondenciaModel.php';		
			$ln = new correspondenciaModel();
			$this->view->show("correspondencia_importar_consolidado.php");
		}else{
			header("refresh: 0; URL=/centro_servicios2/");
		}
	}
	public function subir_consolidado(){
		if($_SESSION['id']!=""){    
			require 'models/correspondenciaModel.php';		
			$modelo = new correspondenciaModel();
			$modelo->subir_consolidado();
			
			$this->view->show("correspondencia_importar_consolidado.php");
		}else{
			header("refresh: 0; URL=/centro_servicios2/");
		}
	}
	public function listar_orden_servicio(){
		if($_SESSION['id']!=""){   
			$this->view->show("correspondencia_listar_orden_servicio.php");
		}else{
			header("refresh: 0; URL=/centro_servicios2/");
		}
	}
	
	// --------------------  22-09-2017 ----------------------------------------------- //
    public function Consultar_reporte_direccion(){
		if($_SESSION['id']!=""){   
			$this->view->show("correspondencia_consultar_reporte_direccion.php");
        }else{
			header("refresh: 0; URL=/centro_servicios2/");
        }
    }
    // --------------------  22-09-2017 ----------------------------------------------- //
    public function Generar_Excel_Reporte_direccion(){
        session_start();
        if($_SESSION['idUsuario'] !=""){
            date_default_timezone_set('America/Bogota');
            $fecha_doc=date('Y-m-d');
            header("Content-type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=Reporte_Direccion_".$fecha_doc.".xls");
            header("Pragma: no-cache");
            header("Expires: 0");    
            require_once 'views/correspondencia_excel_reporteDireccion.php';
        }else{
            header("refresh: 0; URL=/centro_servicios2/");
        }
    }
    // JUAN ESTEBAN MUNERA BETANCUR 2018-07-19
    public function Consultar_estadistica_envios(){
        if($_SESSION['id']!=""){   
            $this->view->show("correspondencia_listar_estadistica_envio472.php");
        }else{
	header("refresh: 0; URL=/centro_servicios2/");
        }
    }
    public function Generar_Excel_Total_Envios(){
        session_start();
        if($_SESSION['idUsuario'] !=""){
            date_default_timezone_set('America/Bogota');
            $fecha_doc=date('Y-m-d');
            header("Content-type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=Reporte_Cantidad_Envios_".$fecha_doc.".xls");
            header("Pragma: no-cache");
            header("Expires: 0");    
            require_once 'views/correspondencia_excel_reporteCantidadEnvios.php';
        }else{
            header("refresh: 0; URL=/centro_servicios2/");
        }
    }
	
	
	
	//-------NUEVO PARA ASIGNAR NUMERO DE GUIA, ADICIONADO 6 DE JUNIO 2019, JORGE ANDRES VALENCIA-------
	
	public function Asignar_Numero_Guia(){
	
		if($_SESSION['id']!=""){
	
			require 'models/correspondenciaModel.php';
			
			$modelo = new correspondenciaModel();
			
			//$modelo->RegistrarADespacho_Masivo();
		
			if($_POST){
	
				
				$modelo->asignar_numero_guia_NG();
	
			}
	
			$this->view->show("simeco_asignar_numeroguia.php", $data);
	
		}
		else{
		  
			header("refresh: 0; URL=/ejecucion/");
		}
	
	}
	
	//-------FIN NUEVO PARA ASIGNAR NUMERO DE GUIA, ADICIONADO 6 DE JUNIO 2019, JORGE ANDRES VALENCIA-------
	
	
	
	

}

?>