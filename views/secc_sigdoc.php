<div id="contentSecc_sigdoc">

	<ul id="menusec">

		  <li>
			
			<a href="index.php?controller=menu&amp;action=mod_sigdoc">Home</a>  
		  
		  </li>

		  <div id="sep">|</div>

		  <li>
		  
				<a href="#">Documentos Salientes</a>
				
				<ul class="submenu">
				
					<li>
						<a href= "index.php?controller=sigdoc&amp;action=Registro_Documentos_Salientes">Registrar Documentos Salientes</a>
					</li> 
					
					<li>
						<a href= "index.php?controller=sigdoc&amp;action=Listar_Documentos_Salientes">Listar Documentos Salientes</a>
					</li> 
					
					
				</ul>
				
		  </li>
		  
		  <div id="sep">|</div>

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
				
		  </li>


		  <?php //if( ($_SESSION['idUsuario'] == 8 || $_SESSION['idUsuario'] == 46 || $_SESSION['idUsuario'] == 55) ) {  ?>
		  
		  <!-- <div id="sep">|</div>
		  
		  <li>
		  
				<a href="#">Reportes</a>
				
				<ul class="submenu">
					
					<li>
						<a href= "index.php?controller=reps&amp;action=repsListaPermisos">Listar Permisos - Aprobar Permisos</a>
					</li>

				</ul>
				
		  </li> -->
		  
		  <?php //} ?>
		  
	</ul>

</div>