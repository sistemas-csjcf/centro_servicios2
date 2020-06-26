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
							<th scope="col">NOMBRE</th>
							<th scope="col">N. DOCUMENTO</th>
							<th scope="col">CORREO</th>
							<th scope="col">CONTRASEÑA</th>
							<th scope="col">TIPO DE USUARIO</th>
							<th scope="col">FECHA DE REGISTRO</th>
              <th scope="col">APROBAR</th>
						</tr>
					</thead>
					<tbody>
            <?php
						$consulta = "
						SELECT * FROM solic_usu_ext
            WHERE chk = 0;
						";
						include("conect_and_data.php");
						$resultado = mysql_query($consulta);
            if(mysql_num_rows($resultado) == 0){
							echo "<tr><td><p align='center'>Sin datos...</p></td><td><p align='center'>Sin datos...</p></td><td><p align='center'>Sin datos...</p></td><td><p align='center'>Sin datos...</p></td><td><p align='center'>Sin datos...</p></td><td><p align='center'>Sin datos...</p></td><td><p align='center'>Sin datos...</p></td></tr>";
						}
						else{
							while ($columna = mysql_fetch_array($resultado)){
								echo"
								<tr>
								<th scope='row'>".$columna['nombre_usuario']."</th>
								<td>".$columna['n_documento']."</td>
								<td>".$columna['correo']."</td>
								<td>".$columna['contrasena']."</td>
                ";
								if ($columna['es_abogado'] == 1){
                  $columna['es_abogado'] = "ABOGADO";
                  echo "<td>".$columna['es_abogado']."</td>";
                } else {
                  $columna['es_abogado'] = "PERSONA NATURAL";
                  echo "<td>".$columna['es_abogado']."</td>";
                }
                echo"
								<td>".$columna['fecha_registro']."</td>
								<td><a href='#' data-toggle='modal' data-target='#ModalAprobUsu' onClick='UserRG(".chr(34).$_GET['uid'].chr(34).",".chr(34).$columna['nombre_usuario'].chr(34).",
                ".chr(34).$columna['n_documento'].chr(34).", ".chr(34).$columna['correo'].chr(34).", ".chr(34).$columna['contrasena'].chr(34).", ".chr(34).$columna['es_abogado'].chr(34).");'><img src='img/uok.png' style='width: 40px;'></a></td></tr>";
							}
						}
						mysqli_close($conexion);
						?>
					</tbody>
				</table>

				<div id="ModalAprobUsu" class="modal fade" role="dialog">
					<div class="modal-dialog modal-md" style="max-width: 550px !important;">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header" style="padding: 0.5rem !important; margin-bottom: 15px; background-color: #17a2b8;">
								<label style="color: #FFF;">APROBACIÓN DE USUARIOS</label>
								<button type="button" class="close" data-dismiss="modal" style="color: #FFF;">&times;</button>
							</div>
							<div class="modal-body">

								<form id="formUserExt" action="regUserExt.php" method="POST" style="text-align: left !important;">

									<div class="card-body">
										<input type="hidden" id="uid" name="uid" readonly>
										<div class="form-group form-inline">
											<label style="width: 220px; justify-content: left;" for="nombre">Nombre completo</label>
											<input style="width: 250px;" type="text" class="form-control" id="nombre" name="nombre" readonly>
										</div>
										<div class="form-group form-inline">
											<label style="width: 220px; justify-content: left;" for="documento">N. de Documento</label>
											<input style="width: 250px;" type="text" class="form-control" id="documento" name="documento" readonly>
										</div>
										<div class="form-group form-inline">
											<label style="width: 220px; justify-content: left;" for="correo">Correo electrónico</label>
											<input style="width: 250px;" type="text" class="form-control" id="correo" name="correo" readonly>
										</div>
                    <div class="form-group form-inline">
											<label style="width: 220px; justify-content: left;" for="contrasena">Contraseña</label>
											<input style="width: 250px;" type="text" class="form-control" id="contrasena" name="contrasena" readonly>
										</div>
                    <div class="form-group form-inline">
											<label style="width: 220px; justify-content: left;" for="es_abogado">Tipo de usuario</label>
											<input style="width: 250px;" type="text" class="form-control" id="es_abogado" name="es_abogado" readonly>
										</div>
									</div>
									<!-- /.card-body -->

									<div id="resultfrmUser"></div>

									<div class="card-footer">
										<div id="env" class="btn btn-info float-right" onClick="envFormUser();">Guardar usuario</div>
									</div>
									<div id="resultfrm"></div>
								</form>

							</div>
							<div class="modal-footer">
								<img src="img/alert.png" style="width: 68px; margin-left: 3%; margin-bottom: 13px;"><br>
								<p align="left">Cerciorese de verificar la existencia en la URNA del correo de los usuarios que son abogados. (Aparecerán en verde).</p>
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
