<?php
if(!isset($_GET['uid']))
{
	header("refresh: 0; URL=/centro_servicios2/");
	exit;
}
else
{
	date_default_timezone_set('America/Bogota');
	include('head.php');
	include('nav.php');
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
							<th scope="col">JUZGADO</th>
							<th scope="col">AÑO</th>
							<th scope="col">CONSECUTIVO</th>
							<th scope="col">FOLIOS</th>
							<th scope="col">NOMBRE DE QUIEN SUSCRIBE</th>
							<th scope="col">CORREO</th>
							<th scope="col">ARCHIVOS</th>
							<th scope="col">REGISTRAR | SIDOJU</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$user_id = $_GET['uid'];
						$and = "";

						if ($user_id == 132){
							$and = "and j.id between 20 and 22";
						} else if($user_id == 145){
							$and = "and j.id between 5 and 7";
						} else if($user_id == 82){
							$and = "and j.id between 14 and 16";
						} else if($user_id == 24){
							$and = "and j.id between 1 and 4";
						} else if($user_id == 73){
							$and = "and j.id between 23 and 25";
						} else if($user_id == 29){
							$and = "and j.id between 17 and 19";
						} else if($user_id == 69){
							$and = "and j.id between 8 and 10";
						} else if($user_id == 118){
							$and = "and j.id between 11 and 12";
						}

						$consulta = "
						select j.nombre as juzgado, e.ano as ano, e.consecutivo as consecutivo, e.folios as folios, e.nombre_persona as persona,
						e.correo_persona as correo, e.id as id, e.fecha_registro as fecha, e.acuse as acuse
						from pa_juzgado j
						join ext_memoriales e on
						j.id = e.id_juzgado
						".$and."
						and e.revisado = 0
						";
						include("conect_and_data.php");
						$resultado = mysql_query($consulta);
						$object = json_encode($resultado);
						if(mysql_num_rows($resultado) == 0){
							echo "<tr><td><p align='center'>Sin datos...</p></td><td><p align='center'>Sin datos...</p></td><td><p align='center'>Sin datos...</p></td><td><p align='center'>Sin datos...</p></td><td><p align='center'>Sin datos...</p></td><td><p align='center'>Sin datos...</p></td><td><p align='center'>Sin datos...</p></td><td><p align='center'>Sin datos...</p></td></tr>";
						}
						else{
							while ($columna = mysql_fetch_array($resultado)){
								$fechaR = explode(" ", $columna['fecha']);
								echo"
								<tr>
								<th scope='row'>".$columna['juzgado']."</th>
								<td>".$columna['ano']."</td>
								<td>".$columna['consecutivo']."</td>
								<td>".$columna['folios']."</td>
								<td>".$columna['persona']."</td>
								<td>".$columna['correo']."</td>
								<td><a href='#' data-toggle='modal' data-target='#ModalDocs' onClick='ModalDocs(".$columna['id'].");'><img src='img/pdf.png' style='width: 40px;'></a></td>
								<td><a href='#' data-toggle='modal' data-target='#ModalSidoju'
								onClick='FormSIDOJU(".chr(34).$columna['id'].chr(34).",".chr(34).$columna['persona'].chr(34).", ".chr(34).$columna['folios'].chr(34).", ".chr(34).$columna['juzgado'].chr(34).",
								".chr(34).$_GET['uid'].chr(34).", ".chr(34).$fechaR[0].chr(34).", ".chr(34).$fechaR[1].chr(34).", ".chr(34).$columna['acuse'].chr(34).");'><img src='img/sidoju.png' style='width: 47px;'></a></td>
								</tr>
								";
							}
						}
						mysqli_close($conexion);
						?>
					</tbody>
				</table>

				<div id="ModalDocs" class="modal fade" role="dialog">
					<div class="modal-dialog modal-md">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header" style="padding: 0.5rem !important; margin-bottom: 15px; background-color: #17a2b8;">
								<label style="color: #FFF;">Revizar Documentación</label>
								<button type="button" class="close" data-dismiss="modal" style="color: #FFF;">&times;</button>
							</div>
							<div class="modal-body" id="putContent">

							</div>
						</div>
					</div>
					<!-- /Formulario de edición -->
				</div>

				<div id="ModalSidoju" class="modal fade" role="dialog">
					<div class="modal-dialog modal-md" style="max-width: 550px !important;">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header" style="padding: 0.5rem !important; margin-bottom: 15px; background-color: #17a2b8;">
								<label style="color: #FFF;">Registrar en SIDOJU</label>
								<button type="button" class="close" data-dismiss="modal" style="color: #FFF;">&times;</button>
							</div>
							<div class="modal-body">

								<form id="formSIDOJU" action="regSidoju.php" method="POST" style="text-align: left !important;" enctype="multipart/form-data">

									<div class="card-body">
										<input type="hidden" id="idm" name="idm" readonly>
										<input type="hidden" id="acuse" name="acuse" readonly>
										<div class="form-group form-inline">
											<label style="width: 220px; justify-content: left;" for="fecha">Fecha</label>
											<input style="width: 250px;" type="text" class="form-control" id="fecha" name="fecha" readonly>
										</div>
										<div class="form-group form-inline">
											<label style="width: 220px; justify-content: left;" for="hora">Hora</label>
											<input style="width: 250px;" type="text" class="form-control" id="hora" name="hora" readonly>
										</div>
										<div class="form-group form-inline">
											<label style="width: 220px; justify-content: left;" for="remitente">Remitente</label>
											<input style="width: 250px;" type="text" class="form-control" id="remitente" name="remitente" readonly>
										</div>
										<div class="form-group form-inline">
											<label style="width: 220px; justify-content: left;" for="juzgado">Tipo de documento</label>
											<select class="form-control" id="tipdoc" name="tipdoc" style="width: 251px;">
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
											</select>
										</div>
										<div class="form-group form-inline">
											<label style="width: 220px; justify-content: left;" for="numdoc">Número Documento</label>
											<input style="width: 250px;" type="text" class="form-control" id="numdoc" name="numdoc">
										</div>
										<div class="form-group form-inline">
											<label style="width: 220px; justify-content: left;" for="folios">Nombre/Folios/Cuadernos</label>
											<input style="width: 250px;" type="text" class="form-control" id="folios" name="folios">
										</div>
										<div class="form-group form-inline">
											<label style="width: 220px; justify-content: left;" for="juzgado">Juzgado Destino</label>
											<input style="width: 250px;" type="text" class="form-control" id="juzgado" name="juzgado" readonly>
										</div>
										<div class="form-group form-inline">
											<label style="width: 220px; justify-content: left;" for="empleado">Empleado</label>
											<input style="width: 250px;" type="text" class="form-control" id="empleado" name="empleado" readonly>
										</div>
										<div class="form-group form-inline">
											<label style="width: 220px; justify-content: left;" for="archivo">Archivo</label>
											<input style="width: 250px;" type="file" class="form-control" id="archivo" name="archivo">
										</div>
									</div>
									<!-- /.card-body -->

									<div id="resultfrm"></div>

									<div class="card-footer">
										<div id="env" class="btn btn-info float-right" onClick="envForm();">Guardar | SIDOJU</div>
									</div>
									<div id="resultfrm"></div>
								</form>

							</div>
							<div class="modal-footer">
								<img src="img/alert.png" style="width: 68px; margin-left: 3%; margin-bottom: 13px;"><br>
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
