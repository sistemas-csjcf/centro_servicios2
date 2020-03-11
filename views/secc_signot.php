<?php

	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	//$modelo       = new signotModel();
	//**************************************************************************************************************************
	//EN ESTA PARTE DEFINO QUE USUARIOS PUEDO PONER A QUE EJECUTEN CIERTAS ACCIONES,COMO REGISTRAR,EDITAR, GENERAR UN REPORTE
	//SEGUN EN EL FORMULARIO QUE ME ENCUENTRE
	
	//$campos                         --> columna que contiene los codigos de los usuarios, los cuales van a ejecutar una accion especifica
	//$nombrelista                    --> tabla que contiene los registros de las acciones
	//$idaccion                       --> id de la accion a consultar en este caso (Editar, vista sigdoc_documentos_salientes.php)
	//$campoordenar                   --> campo por el que se ordena la consulta a la tabla pa_usuario_acciones
	//$datosusuarioacciones,$usuarios --> variables donde obtengo los valores de los usuarios concatenados de esta forma 46////55////45 
	//$usuariosa                      --> vector donde se cargan los codigos de los usuarios, y donde se comparara con 
    //	                                  if ( in_array($_SESSION['idUsuario'],$usuariosa) )
	//                                    segun el usuario logeado en el sistema y si dicho usuario puede ejecutar una accion especifica
	//**************************************************************************************************************************

	$campos                 = 'usuario';
    $nombrelista            = 'pa_usuario_acciones';
    $campoordenar           = 'id';
//    $idaccion               = '15';
//    $datosusuarioacciones   = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
//    $usuarios               = $datosusuarioacciones->fetch();
//    $usuariosa              = explode("////",$usuarios[usuario]);
    //GESTIÓN AGOTADA
    $idaccionGA             = '21';
    $datosusuarioaccionesGA = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccionGA,$campoordenar);
    $usuariosGA             = $datosusuarioaccionesGA->fetch();
    $usuariosaGA            = explode("////",$usuariosGA[usuario]);

    $idaccionENC              = '36';
    $datosusuarioaccionesEncu = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccionENC,$campoordenar);
    $usuarios_encu            = $datosusuarioaccionesEncu->fetch();
    $usuariosEncu             = explode("////",$usuarios_encu[usuario]);
?>

<div id="contentSecc_signot">

	<ul id="menusec">
		<?php if($_SESSION['idperfil'] == 22 ){ ?>
			<li><a href="index.php?controller=menu&amp;action=mod_signot">Seguimiento Proceso</a></li>
		<?php }else{?>
			<li>
				<a href="index.php?controller=menu&amp;action=mod_signot">Home</a>  
			</li>
			<div id="sep">|</div>
			<li>
				<a href="#">Gestionar Proceso</a>
				
				<ul class="submenu">
				
					<li>
						<a href= "index.php?controller=signot&amp;action=Registro_Proceso_Unico">Registrar Proceso</a>
					</li> 
					
					<li>
						<a href= "index.php?controller=signot&amp;action=Modificar_Proceso_2">Modificar Proceso</a>
					</li>
					
					<li>
						<a href= "index.php?controller=signot&amp;action=Modificar_Proceso_Partes">Adicionar Partes al Proceso</a>
					</li>
					
					<li>
						<a href= "index.php?controller=signot&amp;action=Modificar_Parte">Modificar Parte</a>
					</li>
						
					<!-- <li> -->
						<!-- <a href= "index.php?controller=signot&amp;action=Generar_Notificacion">Generar Citacion</a> -->
						
						<!-- <a href= "index.php?controller=signot&amp;action=Seguimiento_Proceso">Seguimiento Proceso</a> -->
					<!-- </li> -->
					<!-- <li>
						<a href= "index.php?controller=sidoju&amp;action=Listar_Documentos_Entrantes_Juzgados">Listar Documentos Entrantes Juzgados</a>
						
					</li> 
					
					<li>
						<a href= "index.php?controller=sidoju&amp;action=Verificar_Documentos_Entrantes_Juzgados">Verificar Documentos Entrantes Juzgados</a>
						
					</li> 
					<li>
						<a href= "index.php?controller=sidoju&amp;action=Imprimir_Documentos_Entrantes_Juzgados">Imprimir Documentos Entrantes Juzgados</a>
						
					</li>  -->		
				</ul>
			</li>  
			<div id="sep">|</div>
			<?php if ( in_array($_SESSION['idUsuario'],$usuariosEncu) ) { ?>
                <li>	  
                    <a href="#">Seguimiento Proceso</a>
                    <ul class="submenu">
                        <li><a href="index.php?controller=signot&amp;action=Seguimiento_Proceso">Seguimiento Proceso</a></li>
                        <li><a href="encuesta_satisfacion?c=encuesta&a=Crud_encuesta" target="_blank">Encuesta Satisfaci&oacute;n</a></li>
                        <!--<li><a href="#" onclick="aplicar_encuesta(<?php echo $_SESSION['idUsuario']; ?>)">Encuesta Satisfaci&oacute;n</a></li>-->
                    </ul>			
                </li>    
            <?php }else{ ?>
                <li><a href="index.php?controller=signot&amp;action=Seguimiento_Proceso">Seguimiento Proceso</a></li>
            <?php } ?>
            <div id="sep">|</div>
			<li>
				<a href="#">Documentos</a>
				<ul class="submenu">							  
					<li>
						<a href="index.php?controller=documentos&amp;action=Registro_Documentos">Registrar Documento</a>
					</li>
					<li>
						<a href= "index.php?controller=documentos&amp;action=Listar_Documentos_Salientes">Listar Documentos</a>
					</li> 
				</ul>
			</li>
			<?php if ( in_array($_SESSION['idUsuario'],$usuariosaGA) ) { ?>
				<div id="sep">|</div>
				<li>
					<a href="#">Devoluciones</a>		  
					<ul class="submenu">					  
						<!--<li><a href="#" >Consultar Fechas</a></li>
						<li><a href= "#">Ver Calendario</a></li>
						-->
						<li><a href="Gestion_Agotada" target="_blank">Consultar Fechas Gesti&oacute;n Agotada</a></li>
						<li><a href= "Gestion_Agotada/calendario_signot" target="_blank">Ver Calendario Gesti&oacute;n Agotada</a></li>
						<li><a href="Devoluciones/devoluciones" target="_blank">Calendario Devoluciones</a></li>
					</ul>
				</li>
			<?php } ?>
			<div id="sep">|</div>
			<?php // if ( in_array($_SESSION['idUsuario'],$usuariosa) ) { ?>	
				<!--<div id="sep">|</div>
					<li>
						<a href="#">Procesos Masivos</a>
						<ul class="submenu">
							<li>
								<a href= "index.php?controller=signot&amp;action=Asignar_Id_Parte">Asignar Id Parte</a>
							</li> 
						</ul>
					</li>
				-->  
			<?php  // }?>

			<?php //if ( $_SESSION['idUsuario'] == 55 || $_SESSION['idUsuario'] == 113){?>
				 
			<!--  <div id="sep">|</div>
			 
			 
				  <li><a href="#">Migrar Informacion</a>
					  
							  <ul class="submenu">
									  
									 <li>
										<a href="index.php?controller=signot&amp;action=Registro_Migracion">Migrar</a>
									</li>
								
								</ul>
					 </li> -->
					 
			 <?php //}?>
			  
			   <!--<div id="sep">|</div>

			  <li>
			  
					<a href="#">Documentos Entrantes</a>
					
					<ul class="submenu">
					
						
						<li>
							<a href="index.php?controller=sigdoc&amp;action=Registro_Documentos_Entrantes">Registrar Documentos Entrantes</a>
						</li> 
						
						<li>
							<a href="index.php?controller=sigdoc&amp;action=Listar_Documentos_Entrantes">Listar Documentos Entrantes</a>
						</li> 

					</ul>
					
			  </li>
			  
			  <div id="sep">|</div>

			  <li>
			  
					<a href="#">Reportes</a>
					
					<ul class="submenu">
					
						
						<li>
							<a class="grafica" href="javascript:void(0);">Grafica Documentos</a>
						</li> 
						
					</ul>
					
			  </li> -->


			 
		<?php } ?>	  
	</ul>

</div>