<?php

	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo       = new sidojuModel();

	$campos                = 'usuario';
	$nombrelista           = 'pa_usuario_acciones';
	$idaccion			         = '13';
	$campoordenar          = 'id';
	$jdatosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$jusuarios             = $jdatosusuarioacciones->fetch();
	$jusuariosa			  		 = explode("////",$jusuarios[usuario]);
	$usaprobext						 = array('87', '45', '145', '132', '185', '82', '24', '73', '29', '69', '118');

?>
<div id="contentSecc_sidoju">

	<ul id="menusec">

		  <li>

			<a href="index.php?controller=menu&amp;action=mod_sidoju">Home</a>

		  </li>

		  <div id="sep">|</div>

		  <li>

				<a href="#">Documentos Entrantes Juzgados</a>

				<?php if ( in_array($_SESSION['idUsuario'],$jusuariosa) ) { ?>

				<ul class="submenu">

					<li>
						<a href= "index.php?controller=sidoju&amp;action=Listar_Documentos_Entrantes_Juzgados">Listar Documentos Entrantes Juzgados</a>
						<a href= "index.php?controller=sidoju&amp;action=Aprobar_Documentos_Entrantes_Juzgados">Aprobar Documentos Entrantes Juzgados</a>

					</li>

					<li>

						<a href="index.php?controller=sidoju&amp;action=Listar_Archivos_Escaneados_2">Estado Incidentes</a>

					</li>

				</ul>

				<?php } else{?>

				<ul class="submenu">
						<?php if ( in_array($_SESSION['idUsuario'], $usaprobext) ) {
							echo "
									<li>
										<a href= 'consultextern/index.php?uid=".$_SESSION['idUsuario']."'>Memoriales | Portal Web</a>
									</li>
								";
					 		}
						?>
					<li>
						<a href= "index.php?controller=sidoju&amp;action=Registro_Documentos_Entrantes_Juzgados">Registro Documentos Entrantes Juzgados</a>
					</li>
					<li>
						<a href= "/centro_servicios2/consulta_JXXI" target="_blank">Consultar Procesos</a>
					</li>
					<li>
						<a href= "index.php?controller=sidoju&amp;action=Listar_Documentos_Entrantes_Juzgados">Listar Documentos Entrantes Juzgados</a>

					</li>

					<li>
						<a href= "index.php?controller=sidoju&amp;action=Verificar_Documentos_Entrantes_Juzgados">Verificar Documentos Entrantes Juzgados</a>

					</li>
					<li>
						<a href= "index.php?controller=sidoju&amp;action=Imprimir_Documentos_Entrantes_Juzgados">Imprimir Documentos Entrantes Juzgados</a>

					</li>
					<li><a href= "#" onclick="ventana_EliminarSidoju()">Eliminar Documentos Entrantes Juzgados</a></li>


					<li>

						<a href="index.php?controller=sidoju&amp;action=Listar_Archivos_Escaneados_2">Estado Incidentes</a>

					</li>


				</ul>

				<?php } ?>

		  </li>

		  <div id="sep">|</div>

		  <li>

			<a href="index.php?controller=sidoju&amp;action=Listar_Archivos">Listar Archivos Escaneados</a>

		  </li>

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




	</ul>

</div>

<script type="text/javascript">
    function ventana_EliminarSidoju(){
        var ventana;
        ventana = window.open("views/popupbox/popup_sidojuEliminar_Registro.php","");
    }
</script>
