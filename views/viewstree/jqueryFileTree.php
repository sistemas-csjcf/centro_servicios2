<?php
//
// jQuery File Tree PHP Connector
//
// Version 1.01
//
// Cory S.N. LaViska
// A Beautiful Site (http://abeautifulsite.net/)
// 24 March 2008
//
// History:
//
// 1.01 - updated to work with foreign characters in directory/file names (12 April 2008)
// 1.00 - released (24 March 2008)
//
// Output a list of files for jQuery File Tree
//

//CODIGO ADICIONADO A LA CLASE
/*require('conexion.php');

$con = new DB;

$canalsql = $con->conectar();*/	

// ************JUAN ESTEBAN MÙNERA BETANCUR *********************
// ************** 2017-08-03 -------------------------------------
    session_start();
    $empleado   = $_SESSION['nombre_empleado'];
    //echo $_POST['dir'];
    //echo $empleado;
    $_POST['dir'] = urldecode($_POST['dir']);
    if( file_exists($root . $_POST['dir']) ) {
        $files = scandir($root . $_POST['dir']);
        //print_r($files);
        natcasesort($files);
        if( count($files) > 2 ) { /* The 2 accounts for . and .. */
            echo "<ul class=\"jqueryFileTree\" style=\"display: none;\">";
            // All dirs (DIRECTORIOS)
            foreach( $files as $file ) {
                if( file_exists($root . $_POST['dir'] . $file) && $file != '.' && $file != '..' && is_dir($root . $_POST['dir'] . $file) ) {
                    if($file == $empleado){
                        //echo $file;
                        echo utf8_encode("<li class=\"directory collapsed\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] ).$empleado . "/\">" . htmlentities($file) . "</a></li>");
                    }
                    if($_SESSION['idperfil'] != "22"){
                        echo utf8_encode("<li class=\"directory collapsed\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] ).$file . "/\">" . htmlentities($file) . "</a></li>");
                    }
                    /*$strConsulta = "SELECT empleado,descarpeta FROM pa_usuario WHERE id = '$file'";
                    $canalsql    = mysql_query($strConsulta);
                    $numfilas    = mysql_num_rows($canalsql);
                    $fila        = mysql_fetch_array($canalsql);
                    $empleado    = $fila['empleado'];
                    $descarpeta  = $fila['descarpeta'];	*/	
                    //echo utf8_encode("<li class=\"directory collapsed\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] . $file) . "/\">" . htmlentities($file) ."-".$empleado." --> ".$descarpeta. "</a></li>");
                    //echo utf8_encode("<li class=\"directory collapsed\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] . $file) . "/\">" . htmlentities($file) ."-".$empleado. "</a></li>");
                    
                    //echo utf8_encode("<li class=\"directory collapsed\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] . $file) . "/\">" . htmlentities($file) . "</a></li>");
                }
            }	
            // All files (ARCHIVOS)
            foreach( $files as $file ) {
                if( file_exists($root . $_POST['dir'] . $file) && $file != '.' && $file != '..' && !is_dir($root . $_POST['dir'] . $file) ) {
                    $ext = preg_replace('/^.*\./', '', $file);
                    echo utf8_encode("<li class=\"file ext_$ext\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] . $file) . "\">" . htmlentities($file) . "</a></li>");
                }
            }
            echo "</ul>";	
        }
    }
?>