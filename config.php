<?php
$config = Config::singleton();

$config->set('controllersFolder', 'controllers/');
$config->set('modelsFolder', 'models/');
$config->set('viewsFolder', 'views/');

$config->set('dbhost', 'localhost');
$config->set('dbname', 'centro_servicios2');
$config->set('dbuser', 'root');
$config->set('dbpass', 'servicios2017');

define('titulo',' - Centro de Servicios -');
define('rutabase','/centro_servicios2/');

/*$config->set('dbhost', 'hotelc.db.3308612.hostedresource.com');
$config->set('dbname', 'hotelc');
$config->set('dbuser', 'hotelc');
$config->set('dbpass', 'HC354CRm21');*/
?>
