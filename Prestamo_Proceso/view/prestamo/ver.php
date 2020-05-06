
<?php
$modelo = new Prestamo();

$obsv = $modelo->ListarPendientes2();
while ($datos = $obsv->fetch())
{
	echo utf8_encode($datos[usuario]) . "<br />";
}
echo utf8_encode("García");

/*foreach($this->model->ListarPendientes() as $r):
	echo $r->pre_observacion_fecha0 . " - " . $r->usuario_edit_fecha0 . "<br />";
endforeach;
$apellido = "García";
echo $apellido;*/
?>