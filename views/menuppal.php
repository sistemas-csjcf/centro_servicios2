<?php
    session_start();
    //JUAN ESTEBAN MUNERA BETANCUR 13/07/2017
    require_once 'models/signotModel.php';
    $modelo       	= new signotModel();
    //$datos_lideres  = $modelo->get_Lideres_correspondencia();
    date_default_timezone_set('America/Bogota'); 
    $fecha_actual 	= date('Y-m-d');
    /*while ($row = $datos_lideres->fetch()) {
        $array_lider[]= $row['id'];
    }
    if ( in_array($_SESSION['idUsuario'],$array_lider) ) {
        $user = $_SESSION['idUsuario'];
    }else{
        $user = "";
    }
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title><?php echo titulo?></title>
		<script src="views/js/jquery.js" type="text/javascript"></script>
		<link href="views/css/mppal.css" rel="stylesheet" type="text/css">
		<!--        JUAN ESTEBAN MUNERA BETANCUR-->
        <script language="JavaScript" type="text/javascript" src="assets/js/funciones_jest.js"></script>
        <style type="text/css">
            /* base semi-transparente */
            .overlay{
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: #FAFAFA;
                z-index:1001;
                opacity:.75;
                -moz-opacity: 0.75;
                filter: alpha(opacity=75);
            }
           .modal {
                position: absolute;
                top: 25%;
                left: 0%;
                width: 30%;
                height: 30%;
                padding: 16px;
                background: aliceblue;
                color: #333;
                z-index:1002;
                overflow: auto;
           }
           .modal_mis_tareas {
                position: absolute;
                top: 80%;
                left: 70%;
                width: 18%;
                height: 9%;
                padding: 16px;
                background: #526a7f;
                color: #FFFFFF;
                z-index:1002;
                overflow: auto;
            }
            .modal_valoracionP {
                position: absolute;
                top: 80%;
                left: 70%;
                width: 22%;
                height: 12%;
                padding: 16px;
                background: #526a7f;
                color: #FFFFFF;
                z-index:1002;
                overflow: auto;
            }
            .modal_alertaLicenciasTH {
                position: absolute;
                top: 80%;
                left: 70%;
                width: 22%;
                height: 12%;
                padding: 16px;
                background: #526a7f;
                color: #FFFFFF;
                z-index:1002;
                overflow: auto;
            }
        </style>
    </head>
    <body onload=" mis_tareas(<?php echo $_SESSION['idUsuario']; ?>); Alerta_Licencias(<?php echo $_SESSION['idUsuario']; ?>)" >
		<div id="fade" class="overlay" ></div>
		<input type="hidden" name="fecha" id="fecha" value="<?php echo $fecha_actual; ?>" />
		<div id="ppal">
			<div id="top"></div>
			<div id="bar">
				<div id="cerrar" style=" margin-left:900px;">
                    <a href="index.php?controller=index&amp;action=close_session" onclick="chapaelventanuco();">
                        <img src="views/images/crm_exit.png" alt="Cerrar Sesion"  title="Cerrar Sesion"/>
                    </a>
                </div>
			</div>
			<div id="fechaInterrogatorio"></div>
            <div id="mis_ tareas"></div>
            <div id="Alerta_LicenciasTH"></div>
			<div id="content">
				<script>
					ventanuco = "ventana";
					//ventanuco = window.open ("bloqueo_procesos","about:blank");
					function chapaelventanuco (){
						if (ventanuco != null && !ventanuco.isclosed){
							ventanuco.close();
							ventanuco = null;
						}
					}
				</script>
				<?php 
					//echo $_SESSION['rol'];
					switch ($_SESSION['rol']) {
						/*----------------- Menu Administrador ----------------------*/
						case 'Administrador':
							include 'views/menus/m_admin.php';
						break;	
						case 'Archivo':
							include 'views/menus/m_archivo.php';
						break;	
						case 'Correspondencia':
							include 'views/menus/m_correspondencia.php';
						break;		
					}
				?>
			</div>
		</div>
	</body>
</html>

