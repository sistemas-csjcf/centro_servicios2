<?php 
    //INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
    $modelo = new repsModel();
    //**************************************************************************************************************************
    //EN ESTA PARTE DEFINO QUE USUARIOS PUEDO PONER A QUE EJECUTEN CIERTAS ACCIONES,COMO REGISTRAR,EDITAR, GENERAR UN REPORTE
    //SEGUN EN EL FORMULARIO QUE ME ENCUENTRE
    //$campos                         --> columna que contiene los codigos de los usuarios, los cuales van a ejecutar una accion especifica
    //$nombrelista                    --> tabla que contiene los registros de las acciones
    //$idaccion                       --> id de la accion a consultar en este caso (Editar, vista sigdoc_documentos_salientes.php)
    //$campoordenar                   --> campo por el que se ordena la consulta a la tabla pa_usuario_acciones
    //$datosusuarioacciones,$usuarios --> variables donde obtengo los valores de los usuarios concatenados de esta forma 46////55////45 
    //$usuariosa                      --> vector donde se cargan los codigos de los usuarios, y donde se comparara con 
    //	                                  if ( in_array($_SESSION['idUsuario'],$usuariosa) )
    //                                    segun el usuario logeado en el sistema y si dicho usuario puede ejecutar una accion especifica
    //**************************************************************************************************************************
    $campos               = 'usuario';
    $nombrelista          = 'pa_usuario_acciones';
    $idaccion		  = '4';
    $campoordenar         = 'id';
    $datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuarios             = $datosusuarioacciones->fetch();
    $usuariosa		  = explode("////",$usuarios[usuario]);
    
    $idaccion             = '28';
    $campoordenar         = 'id';
    $datosUser_acciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
    $usuariosHV             = $datosUser_acciones->fetch();
    $usuarioHV            = explode("////",$usuariosHV['usuario']);
    //print_r($datosusuarioacciones->fetch());
    //echo $usuarios[usuario];	
?>
<div id="contentSecc_empleados">
    <ul id="menusec">
<!--        <li><a href="index.php?controller=menu&amp;action=mod_reps">Home</a></li>-->
        <li><a href="index.php?controller=reps&amp;action=regIngresoSalida">Home</a></li>
        
<!--        <li>	  
            <a href="#">Registro Empleados</a>
            <ul class="submenu">
                <li>
                    <a href="index.php?controller=reps&amp;action=regIngresoSalida">Registrar Ingreso - Salida</a>
                </li>
                 <li>
                    <a href= "index.php?controller=empleados&amp;action=listarIngresoSalida">Listar Ingreso - Salida</a>
                </li> 
            </ul>
        </li>-->
        <?php if ( in_array($_SESSION['idUsuario'],$usuariosa) ) { ?>	  
            <div id="sep">|</div>	  
            <li>	  
                <a href="#">Reportes</a>
                <ul class="submenu">
                    <li><a href= "index.php?controller=reps&amp;action=repsListaPermisos">Listar Permisos - Aprobar Permisos</a></li>
                </ul>
            </li>
            <div id="sep">|</div>
            <li><a href= "Calendario_Permisos/calendario_permisos" target="_blank">Calendario Permisos</a></li>
        <?php } ?>	  
        <?php if ( in_array($_SESSION['idUsuario'],$usuariosa) ) { ?>
            <div id="sep">|</div>
            <li><a href="talento_humano" target="_blank">Talento Humano</a></li>
            <div id="sep">|</div>
        <?php }else if($_SESSION['idperfil'] !=22){ ?> 
            <li><a href="talento_humano?c=hoja_vida&a=Personal" target="_blank">Talento Humano</a></li>
            <div id="sep">|</div>
        <?php }else{ ?>
            
        <?php } ?>    
    </ul>
</div>