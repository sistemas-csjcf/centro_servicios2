<?php
date_default_timezone_set('America/Bogota');
// Recopilación de Datos
$idm            = trim($_POST['idm']);
$acuse          = trim($_POST['acuse']);
$fechae         = trim($_POST['fecha']);
$horae          = trim($_POST['hora']);
$remitente      = trim($_POST['remitente']);
$tipodocumento  = trim($_POST['tipdoc']);
$numerodoce     = trim($_POST['numdoc']);
$nfc            = trim($_POST['folios']);
$nom_u          = trim($_POST['juzgado']);
$nom            = trim($_POST['empleado']);


//DATOS PARA EL REGISTRO DEL LOG
$fechalog     = date("Y-m-d");
$horalog      = date("H:i:s");
$tiporegistro = "Entrada de Documento";
$accion       = "Registra una Nueva ".$tiporegistro." En el Sistema (SIDOJU) REGISTRO DOCUMENTOS ENTRANTES JUZGADOS";
$detalle      = "El usuario con ID ".$nom." a través del sistema de recepción de memoriales, ".$accion." ".$fechalog." "."a las: ".$horalog;
$tipolog      = 5;

$raiz = "../ArchivosSidoju";

//AQUI SE CREA EL DIRECTORIO
if (file_exists($raiz.'/'.$nom) == false){
  mkdir($raiz.'/'.$nom, 0777, true);
}

//datos del arhivo
$archivoOriginal = $_FILES['archivo']['name'];
$nombre_archivo  = date("YmdHis").$_FILES['archivo']['name'];
$tipo_archivo    = $_FILES['archivo']['type'];
$rutaarchivo     = $raiz.'/'.$nom.'/'.$nombre_archivo;

if ($archivoOriginal != "") {
  $moved = move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaarchivo);
  if($moved) {

    require_once("conect_and_data.php");
    $doc = "
    INSERT INTO sidoju_documentos_entrantes_juzgados (idusuario,idusuarioedita,idusuarioverifica,fecha,
    fechaedita,fechaverifica,hora,remitente,idtipodocumento,numero,nfc,idjuzgadodestino,rutaarchivo,acuse,nombrebloque,chk)
    VALUES (".$nom.",0,0,'".$fechae."','0000-00-00','0000-00-00','".$horae."','".$remitente."',".$tipodocumento.",'".$numerodoce."','".$nfc."',
    (SELECT id FROM pa_juzgado WHERE nombre LIKE '".$nom_u."'),'ArchivosSidoju/".$nom.'/'.$nombre_archivo."','".$acuse."','',0);
    ";

    if ( mysql_query($doc) or die ( mysql_error($conexion) ) ) {
    $log = "
    INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('".$fechalog."', '".$accion."','".$detalle."','".$nom."','".$tipolog."');
    ";
    if ( mysql_query($log) ){
      $rev = "
      UPDATE ext_memoriales set revisado = 1 WHERE id = ".$idm."
      ";
      if ( mysql_query($rev) ){
        echo "<a href='index.php?uid=".$nom."'><img src='img/success.png' style='margin-left: calc((100% - 1400px) /2); margin-top: 2%;'></a>";
      } else {
        echo "<a href='index.php?uid=".$nom."'><img src='img/fail.png' style='margin-left: calc((100% - 1400px) /2); margin-top: 2%;'></a>";
      }

  } else {
  echo "<a href='index.php?uid=".$nom."'><img src='img/fail.png' style='margin-left: calc((100% - 1400px) /2); margin-top: 2%;'></a>";
  }
  } else {
  echo "<a href='index.php?uid=".$nom."'><img src='img/fail.png' style='margin-left: calc((100% - 1400px) /2); margin-top: 2%;'></a>";
  }

  } else {
    echo "<a href='index.php?uid=".$nom."'><img src='img/fail.png' style='margin-left: calc((100% - 1400px) /2); margin-top: 2%;'></a>";
  }

}

/*
else{//NO SE DEFINE UN ARCHIVO

//-------------------------SE REGISTRAN LOS DATOS EN LA TABLA-----------------------------------------
//-------------------------CUANDO NO SE DEFINE UN ARCHIVO------------------------------------------------
try {

$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//EMPIEZA LA TRANSACCION
$this->db->beginTransaction();

$this->db->exec("INSERT INTO sidoju_documentos_entrantes_juzgados (idusuario,idusuarioedita,idusuarioverifica,fecha,
fechaedita,fechaverifica,hora,remitente,idtipodocumento,numero,nfc,idjuzgadodestino,rutaarchivo,nombrebloque,chk)
VALUES ('$nom',0,0,'$fechae','0000-00-00','0000-00-00','$horae','$remitente','$tipodocumento','$numerodoce','$nfc',
'$juzgadodestino','$rutaarchivo','',0)");

$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$nom','$tipolog')");

//SE TERMINA LA TRANSACCION
$this->db->commit();

//echo $nombre_archivo;
print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=2"</script>';

}
catch (Exception $e) {
//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
$this->db->rollBack();
//echo "Fallo: " . $e->getMessage();
print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=2b"</script>';
}
//---------------------------------------------------------------------------------------------------------------------------------------




}//FIN ELSE NO SE DEFINE UN ARCHIVO
*/
?>
