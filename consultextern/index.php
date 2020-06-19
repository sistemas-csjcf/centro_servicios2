<?php
if(!isset($_GET['uid']))
{
	header("refresh: 0; URL=/centro_servicios2/");
	exit;
}
else
{
	include('head.php');
	?>
	<!-- Header -->

	<!-- Page Content -->
	<div class="containeramt_full">
		<div class="row">
			<div class="col-lg-12 text-left">
			</div>
			<div class="col-lg-12 text-center">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th scope="col">Juzgado</th>
							<th scope="col">Año</th>
							<th scope="col">Consecutivo</th>
							<th scope="col">Folios</th>
							<th scope="col">Nombre de quien suscribe</th>
							<th scope="col">Correo</th>
							<th scope="col">Archivo</th>
							<th scope="col">Registrar | SIDOJU</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$and = "";
						$consulta = "
						select j.nombre as juzgado, e.ano as ano, e.consecutivo as consecutivo, e.folios as folios, e.nombre_persona as persona,
						e.correo_persona as correo, e.ruta_memorial as archivo
						from pa_juzgado j
						join ext_memoriales e on
						j.id = e.id_juzgado
						".$and."
						";
						include("conect_and_data.php");
						$resultado = mysql_query($consulta);
						if(mysql_num_rows($resultado) == 0){
							echo "<tr><td><p align='center'>Sin datos...</p></td><td><p align='center'>Sin datos...</p></td><td><p align='center'>Sin datos...</p></td><td><p align='center'>Sin datos...</p></td><td><p align='center'>Sin datos...</p></td><td><p align='center'>Sin datos...</p></td><td><p align='center'>Sin datos...</p></td><td><p align='center'>Sin datos...</p></td></tr>";
						}
						else{
							while ($columna = mysql_fetch_array($resultado)){
								echo"
								<tr>
								<th scope='row'>".$columna['juzgado']."</th>
								<td>".$columna['ano']."</td>
								<td>".$columna['consecutivo']."</td>
								<td>".$columna['folios']."</td>
								<td>".$columna['persona']."</td>
								<td>".$columna['correo']."</td>
								<td><a href='http://localhost/recepcionmemoriales/memoriales/RIF-".$columna['archivo']."' target='_blank'><img src='img/pdf.png'></a></td>
								<td><a href='#' data-toggle='modal' data-target='#ModalSidoju'><img src='img/sidoju.png' style='width: 76px;'></a></td>
								</tr>
								";
							}
						}
						mysqli_close($conexion);
						?>
					</tbody>
				</table>

				<div id="ModalSidoju" class="modal fade" role="dialog">
					<div class="modal-dialog modal-md">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header" style="padding: 0.5rem !important; margin-bottom: 15px; background-color: #17a2b8;">
								<label style="color: #FFF;">Registrar en SIDOJU</label>
								<button type="button" class="close" data-dismiss="modal" onclick="reload();" style="color: #FFF;">&times;</button>
							</div>
							<div class="modal-body">

								<form action="regSidoju.php" method="POST" style="text-align: left !important;">

									<div class="card-body">
										<div class="form-group">
											<label for="juzgado">Seleccione el tipo de documento</label>
											<select class="form-control" id="tipdoc" name="tipdoc">
												<option value="" selected>Seleccione</option>
												<option value="1">Circular</option>
												<option value="2">Oficio</option>
												<option value="3">Despacho Comisorio</option>
												<option value="4">Otro</option>
												<option value="5">Memorial</option>
												<option value="6">Extracto Bancario</option>
												<option value="7">Asunto de tutela</option>
												<option value="8">Expedientes</option>
												<option value="9">Tutela Corte Constitucional</option>
												<option value="10">INCIDENTE DESACATO EN SALUD</option>
											</select>
										</div>
										<div class="form-group">
											<label for="ano">Asunto</label>
											<input type="text" class="form-control" id="asunto" name="asunto">
										</div>
										<div class="form-group">
											<label for="ano">Nombre/Cuadernos</label>
											<input type="text" class="form-control" id="nomcuad" name="nomcuad">
										</div>
									</div>
									<!-- /.card-body -->

									<div id="resultfrm"></div>

									<div class="card-footer">
										<button id="env" class="btn btn-info">Guardar | SIDOJU</button>
									</div>

								</form>

							</div>
							<div class="modal-footer">
								<p align="left">Cerciorese de la información que suministra en el formulario antes de registrar el documento en SIDOJU.</p>
							</div>
						</div>
					</div>
					<!-- /Formulario de edición -->
				</div>

			</div>
		</div>
		<!-- /Formulario de edición -->

	</div>
	<!-- /Page Content -->

	<!-- Footer -->
	<?php
	include('footer.php');
	?>
	<!-- /Footer -->
	<?php
}
?>
