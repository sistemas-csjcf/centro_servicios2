//**************** Funciones creadas inicial 2017-04-19 Manizales ***********************//
//************************** JUAN ESTEBAN MÙNERA BETANCUR *******************************//
function buscar_radi(){
    var radicado = document.getElementById("radicado").value;
    //alert(radicado);
    var cant_radi = radicado.length;
    if(cant_radi >0 && cant_radi < 23){
        alert("radicado incompleto, debe contener 23 digitos y actualmente contiene: "+cant_radi);
        document.getElementById("resultado").innerHTML="";
        document.getElementById("radicado").style.border ="solid #A52A2A 1px";
    }else if(cant_radi<1){
        alert("el campo RADICADO se encuentra vacio");
        document.getElementById("radicado").style.border ="solid #A52A2A 1px";
        document.getElementById("resultado").innerHTML="";
    }else if (cant_radi>23){
        alert("Campo RADICADO debe contener 23 digitos y actualmente contiene: "+cant_radi);
        document.getElementById("radicado").style.border ="solid #A52A2A 1px";
        document.getElementById("resultado").innerHTML="";
    }else{
        document.getElementById("radicado").style.border ="solid #32CD32 1px";
        if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById("resultado").innerHTML=xmlhttp.responseText;
                document.getElementById("load").style.display = "none";
            }else{
                document.getElementById("load").style.display = "block";
                var x = document.createElement("IMG");
                x.setAttribute("src", "assets/imagenes/load1.gif");
                x.setAttribute("width", "90");
                x.setAttribute("alt", "Cargando Datos...");
                document.getElementById("load").appendChild(x);
            }
        }
        xmlhttp.open("POST","view/visitas/visitas-info_proceso.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("radi="+radicado);
    }
};
// ********************************* Grafica TSocial/Solicitudes Visitas *****************************
function abrirVentana(){
    //alert(ventana);
     window.open("view/Graficas/grafica_balance_TSocial.php","GRAFICA","width=600,height=400,scrollbars=YES");
};
function buscar_user(){
    var cedula       = document.getElementById("cedulaTS").value;
    var cantidad_num = cedula.length;
    if(cantidad_num <1){
        alert("el campo Cédula se encuentra vacio");
        document.getElementById("cedulaTS").style.border ="solid #A52A2A 1px";
        document.getElementById("resultado").innerHTML="";
    }else{
        document.getElementById("cedulaTS").style.border ="solid #32CD32 1px";
        if (window.XMLHttpRequest){
            xmlhttp=new XMLHttpRequest();
        }else{
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById("resultado").innerHTML=xmlhttp.responseText;
                document.getElementById("load").style.display = "none";
            }else{
                document.getElementById("load").style.display = "block";
                var x = document.createElement("IMG");
                x.setAttribute("src", "assets/imagenes/load1.gif");
                x.setAttribute("width", "90");
                x.setAttribute("width", "90");
                x.setAttribute("alt", "Cargando Datos...");
                document.getElementById("load").appendChild(x);
            }
        }
        xmlhttp.open("POST","view/TSocial/TSocial-info_usuario.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("cedu="+cedula);
    }
};

function time(){
    var inicio  = document.getElementById("hora_inicio").value;
    var fin     = document.getElementById("hora_fin").value;

    var inicioMinutos = parseInt(inicio.substr(3,2));
    var inicioHoras = parseInt(inicio.substr(0,2));
    var finMinutos = parseInt(fin.substr(3,2));
    var finHoras = parseInt(fin.substr(0,2));
    var transcurridoMinutos = finMinutos - inicioMinutos;
    var transcurridoHoras = finHoras - inicioHoras;

    if (transcurridoMinutos < 0) {
      transcurridoHoras--;
      transcurridoMinutos = 60 + transcurridoMinutos;
    }

    horas = transcurridoHoras.toString();
    minutos = transcurridoMinutos.toString();

    if (horas.length < 2) {
      horas = "0"+horas;
    }

    if (horas.length < 2) {
      horas = "0"+horas;
    }
    document.getElementById("duracion").value = horas+":"+minutos; 
};
function validarObjetivo(respuesta){
    if(respuesta === "No"){
        document.getElementById("res_objetivo").style.display="block";
        document.getElementById("txtArea_res_objetivo").disabled=false;
    }else{
        document.getElementById("res_objetivo").style.display="none";
        document.getElementById("txtArea_res_objetivo").disabled=true;
    }
};
function validarOportunamente(respuesta){
    if(respuesta === "No"){
        document.getElementById("res_oportunamente").style.display="block";
        document.getElementById("comment_oportunamente").disabled=false;
    }else{
        document.getElementById("res_oportunamente").style.display="none";
        document.getElementById("comment_oportunamente").disabled=true;
    }
};
// *************************** USUARIO ADMINISTRADOR ***********************************************************
//CONTADOR REAL-TIME HISTORIAL VALORACIÒN VISITAS *ADMIN*
function getTimeAJAX() {
    //GUARDAMOS EN UNA VARIABLE EL RESULTADO DE LA CONSULTA AJAX    
    var contador = $.ajax({
        url: 'view/informes/contador_historial_valoracion_visita.php', //indicamos la ruta donde se genera 
            dataType: 'text',//indicamos que es de tipo texto plano
            async: false     //ponemos el parámetro asyn a falso
    }).responseText;
    //actualizamos el contenedor que nos mostrará  
    document.getElementById("badge").innerHTML =contador;
}
//con esta funcion llamamos a la función getTimeAJAX cada segundo para actualizar 
setInterval(getTimeAJAX,1000);
//**********************************************************************************************************
//CONTADOR REAL-TIME VISITAS PENDIENTES ->INFORME REMISIÓN (PENDIENTES) *ADMIN*
function geTimeVpendientes() {
    //GUARDAMOS EN UNA VARIABLE EL RESULTADO DE LA CONSULTA AJAX    
    var cont = $.ajax({
        url: 'view/informes/contador_visitasPendientes.php', //indicamos la ruta donde se genera 
            dataType: 'text',//indicamos que es de tipo texto plano
            async: false     //ponemos el parámetro asyn a falso
    }).responseText;
    //actualizamos el contenedor que nos mostrará 
    document.getElementById("badgeVPendientes").innerHTML =cont;
}
//con esta funcion llamamos a la función getTimeAJAX cada segundo para actualizar 
setInterval(geTimeVpendientes,1000);
//*************************************************************************************************************
//CONTADOR REAL-TIME VISITAS PENDIENTES ->INFORME REMISIÓN (PENDIENTES) *ADMIN*

function getTimeRemisionPendientes() {
    //GUARDAMOS EN UNA VARIABLE EL RESULTADO DE LA CONSULTA AJAX    
    var time = $.ajax({
        url: 'view/informes/contador_infRemisionPendiente.php', //indicamos la ruta donde se genera 
            dataType: 'text',//indicamos que es de tipo texto plano
            async: false     //ponemos el parámetro asyn a falso
    }).responseText;
    //actualizamos el contenedor que nos mostrará 
    document.getElementById("badgeInfRemision").innerHTML = time;
}
//con esta funcion llamamos a la función getTimeAJAX cada segundo para actualizar 
setInterval(getTimeRemisionPendientes,1000);
// ********************************************** FIN ADMIN ********************************************************//
//******************************************************************************************************************
//
// *************************** USUARIO ASISTENTE SOCIAL ****************************************************************
//CONTADOR REAL-TIME VISITAS PENDIENTES TS -> *ASISTENTE SOCIAL*
function geTimeVpendientesTS() {
    //GUARDAMOS EN UNA VARIABLE EL RESULTADO DE LA CONSULTA AJAX    
    var conP = $.ajax({
        url: 'view/informes/contador_visitasPendientesTS.php', //indicamos la ruta donde se genera 
            dataType: 'text',//indicamos que es de tipo texto plano
            async: false     //ponemos el parámetro asyn a falso
    }).responseText;
    //actualizamos el contenedor que nos mostrará 
    document.getElementById("badgeVPendientesTS").innerHTML = conP;
}
//con esta funcion llamamos a la función getTimeAJAX cada segundo para actualizar 
setInterval(geTimeVpendientesTS,1000);
//*************************************************************************************************************
//CONTADOR REAL-TIME INFORME SEGUIMIENTO TS ->INFORME SEGUIMIENTO (PENDIENTES) *ASISTENTE SOCIAL*
function badgeInfSeguimientoTS() {
    //GUARDAMOS EN UNA VARIABLE EL RESULTADO DE LA CONSULTA AJAX    
    var conP = $.ajax({
        url: 'view/informes/contador_inf_SeguimientoTS.php', //indicamos la ruta donde se genera 
            dataType: 'text',//indicamos que es de tipo texto plano
            async: false     //ponemos el parámetro asyn a falso
    }).responseText;
    //actualizamos el contenedor que nos mostrará 
    document.getElementById("badgeInfSeguimientoTS").innerHTML = conP;
}
//con esta funcion llamamos a la función getTimeAJAX cada segundo para actualizar 
setInterval(badgeInfSeguimientoTS,1000);

// *************************** USUARIO DESPACHOS ****************************************************************
//CONTADOR REAL-TIME VALORACIÓN VISITAS SIN ENVIAR -> *DESPACHOS*
function geTimeValSinEnviar() {
    //GUARDAMOS EN UNA VARIABLE EL RESULTADO DE LA CONSULTA AJAX    
    var conP = $.ajax({
        url: 'view/informes/contador_valoracion_despacho.php', //indicamos la ruta donde se genera 
            dataType: 'text',//indicamos que es de tipo texto plano
            async: false     //ponemos el parámetro asyn a falso
    }).responseText;
    //actualizamos el contenedor que nos mostrará 
    document.getElementById("badgeValoracionD").innerHTML = conP;
}
//con esta funcion llamamos a la función getTimeAJAX cada segundo para actualizar 
setInterval(geTimeValSinEnviar,1000);

//*************************************************************************************************************
// *************************** USUARIO ADMIN CS ****************************************************************
//CONTADOR REAL-TIME VALORACIÓN VISITAS SIN ENVIAR -> *Admin CS*
function geTimeValSinEnviarCS() {
    //GUARDAMOS EN UNA VARIABLE EL RESULTADO DE LA CONSULTA AJAX    
    var conP = $.ajax({
        url: 'view/informes/contador_valoracion_CS.php', //indicamos la ruta donde se genera 
            dataType: 'text',//indicamos que es de tipo texto plano
            async: false     //ponemos el parámetro asyn a falso
    }).responseText;
    //actualizamos el contenedor que nos mostrará 
    document.getElementById("badgeValoracionCS").innerHTML = conP;
}
//con esta funcion llamamos a la función getTimeAJAX cada segundo para actualizar 
setInterval(geTimeValSinEnviarCS,1000);
//*************************************************************************************************************

function consultar_estadisticaVisitasTS(){
    var inicio  = document.getElementById("fechaI").value;
    var fin     = document.getElementById("fechaF").value;
	
    if (fin == "") {
        document.getElementById("reporte_estadistica").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // código para IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("reporte_estadistica").innerHTML = xmlhttp.responseText;
                document.getElementById("load").style.display = "none";
            }else{
                document.getElementById("load").style.display = "block";
                var x = document.createElement("IMG");
                x.setAttribute("src", "assets/imagenes/load1.gif");
                x.setAttribute("width", "90");
                x.setAttribute("alt", "Cargando Datos...");
                document.getElementById("load").appendChild(x);
            }
        };
        xmlhttp.open("GET","view/estadistica/estadistica_ContadorVisitasTS.php?inicio="+inicio+"&fin="+fin,true);
        xmlhttp.send();
    }
}; 
function consultar_estadisticaVisitasDespacho(){
    var inicio  = document.getElementById("fechaI").value;
    var fin     = document.getElementById("fechaF").value;
	
    if (fin == "") {
        document.getElementById("reporte_estadistica").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // código para IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("reporte_estadistica").innerHTML = xmlhttp.responseText;
                document.getElementById("load").style.display = "none";
            }else{
                document.getElementById("load").style.display = "block";
                var x = document.createElement("IMG");
                x.setAttribute("src", "assets/imagenes/load1.gif");
                x.setAttribute("width", "90");
                x.setAttribute("alt", "Cargando Datos...");
                document.getElementById("load").appendChild(x);
            }
        };
        xmlhttp.open("GET","view/estadistica/estadistica_ContadorVisitasDespacho.php?inicio="+inicio+"&fin="+fin,true);
        xmlhttp.send();
    }
};
