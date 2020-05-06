function myFunction(id) {
    if (id == "") {
        document.getElementById("listar_contenido").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("listar_contenido").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","views/sigdoc_listar_contenido_modal.php?id="+id,true);
        xmlhttp.send();
    }
};
function closeDialog() {
    var x = document.getElementById("ventana");
    x.close(); 
};
function closeModal() {
    document.getElementById("mis_tareas").style.display = "none";
    
    document.getElementById("fade").style.display = "none";
    
    var x = document.getElementById("ventana");
    x.close(); 
};
//****** 2017-07-27  ***************
function verContenido(id){
    if (id == "") {
        document.getElementById("consultar_contenido").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("consultar_contenido").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","views/documentos_ver_contenido_modal.php?id="+id,true);
        xmlhttp.send();
    }
}

function listar_consolidado(){
    var fechai 			= document.getElementById("fechai").value;
    var fechaf 			= document.getElementById("fechaf").value;
    var despacho 		= document.getElementById("despacho").value;
    var destinatario	= document.getElementById("destinatario").value;
	//alert(destinatario);
    //alert(despacho);
    var bandera =1;
    if (bandera == "") {
        document.getElementById("listado_consolidado_guia").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
                document.getElementById("listado_consolidado_guia").innerHTML = xmlhttp.responseText;
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
        xmlhttp.open("GET","views/correspondencia_filtro_orden_servicio.php?fechai="+fechai+"&fechaf="+fechaf+"&despacho="+despacho+"&destinatario="+destinatario,true);
        xmlhttp.send();
    }
};
// SIGNOT JUAN ESTEBAN MÚNERA BETANCUR 
// 2017-07-14
function funcionAnotacion(dato){
    if(dato == 14){
        document.getElementById("campo_interrogatorio").style.visibility = "visible";
        document.getElementById("fecha_interrogatorio").required=true;
        document.getElementById("field_horaDiligencia").style.visibility = "visible";
        document.getElementById("field_horaDiligencia").required=true;

        document.getElementById("anotacion").value="Fecha de la Diligencia Extraproceso para el ";
    }else if(dato == 9){
        document.getElementById("campo_interrogatorio").style.visibility = "visible";
        document.getElementById("fecha_interrogatorio").required=true;

        document.getElementById("field_horaDiligencia").style.visibility = "hidden";
        document.getElementById("field_horaDiligencia").required=false;
        document.getElementById("anotacion").value="";
    }else{
        document.getElementById("campo_interrogatorio").style.visibility = "hidden";;
        document.getElementById("fecha_interrogatorio").required=false;

        document.getElementById("field_horaDiligencia").style.visibility = "hidden";
        document.getElementById("field_horaDiligencia").required=false;
        document.getElementById("anotacion").value="";
    }
};

function interrogatorioHoy(us){
    var xmlhttp = null;
    var fecha = document.getElementById('fecha').value;
    if(us != 'undefined'){
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("fechaInterrogatorio").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","views/signot_FechaInterrogatorio.php?us="+us+"&fecha="+fecha,true);
        xmlhttp.send();
    }else{
        document.getElementById('fade').style.display = none;
        document.getElementById('light').style.display = none;
    }
};
function visto(id) {
    //var codigo = id;
    location.reload();
};


//---------------------------------- SIGNOT ********************************************
//---------------------- SEGUIMIENTO PROCESO PARA LOS JUZGADOS ------------------------
// JUAN ESTEBAN MUNERA BETANCUR 2017-08-02
function consultarSignotJ(){
    var fechaI      = document.getElementById('fechai').value;
    var fechaF      = document.getElementById('fechaf').value;
    var radicado    = document.getElementById('radicadox').value; 
    var usuarioJ    = document.getElementById('usuarioJuzgado').value;
    var idJ         = document.getElementById('idJ').value;
    if(fechaI != "" || fechaF !=""){
        document.getElementById("radicadox").value = "";
    }
    var radiC = radicado.substring("",12);
    if(radicado != ""){
        if(radiC != usuarioJ ){
            alert("El No. Radicado no corresponde con el despacho en sesi\u00F3n");
            return;
        }
    }
    
    if(fechaI != "" && fechaF=="" || fechaI=="" && fechaF!=""){
        alert("falta");
        document.getElementById("listar_contenidoFiltro").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("contenidoI").style.display = "none";
                document.getElementById("listar_contenidoFiltro").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","views/signotListarSeguimientoProcesoJ.php?fechaI="+fechaI+"&fechaF="+fechaF+"&radicado="+radicado+"&idJ="+idJ,true);
        xmlhttp.send();
    }
};

function borrarCampo(campo){
    if(campo != ""){
        document.getElementById("radicadox").value = "";
    }
};
function reiniciar (){
    location.reload();
};
function verINFO_seguimientoProcesoJ(id){
    window.open("?controller=signot&action=ConsultarSeguimientoProcesoJ&id="+id)
};

// SIGCOM JUAN ESTEBAN MÚNERA BETANCUR 
// 2017-09-22
function listar_reporteDireccion(){
    var fechai          = document.getElementById("fechai").value;
    var fechaf          = document.getElementById("fechaf").value;
    var despacho        = document.getElementById("despacho").value;
    var tipo_envio      = document.getElementById("tipo_envio").value;
    //alert(despacho);
    if (fechai == "") {
        document.getElementById("resultado_reporte_direccion").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("resultado_reporte_direccion").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","views/correspondencia_resultado_reporte_direccion.php?fechai="+fechai+"&fechaf="+fechaf+"&despacho="+despacho+"&tipo_envio="+tipo_envio,true);
        xmlhttp.send();
    }
};
// SIGDOC -- DOCUMENTOS -- DOCS JUAN ESTEBAN MÚNERA BETANCUR
// 2017-09-29
function con_copia(dato){
    //alert(dato);
    if(dato === 0){
        document.getElementById('cc').style.display = "none";
    }else{
        document.getElementById('cc').style.display = "block";
    }
}
function bloqueado_window(){
    alert("Error, no tiene permiso para ingresar.");
}

// -------- JUAN ESTEBAN MÙNERA BETANCUR -------------
// ------------ 2018-07-19 ---------------------------
function listar_total_envios472(){
    var fechai          = document.getElementById("fechai").value;
    var fechaf          = document.getElementById("fechaf").value;
    var bandera =1;
    if (bandera == "") {
        document.getElementById("listado_total_envios").innerHTML = "";
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
                document.getElementById("listado_total_envios").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
                document.getElementById("listado_total_envios").innerHTML = xmlhttp.responseText;
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
        xmlhttp.open("GET","views/correspondencia_filtro_total_envios472.php?fechai="+fechai+"&fechaf="+fechaf,true);
        xmlhttp.send();
    }
}

// JUAN ESTEBAN MUNERA
// 2018-07-23
function mis_tareas(us){
    var xmlhttp = null;
    if(us != 'undefined'){
        if (window.XMLHttpRequest) {
            // código para IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("mis_tareas").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","views/modal_mis_tareas.php?us="+us,true);
        xmlhttp.send();
    }else{
        document.getElementById('fade').style.display = none;
        document.getElementById('light').style.display = none;
    }
};
function TSvaloraciones_pendientes(us){
    var xmlhttp = null;
    if(us != 'undefined'){
        if (window.XMLHttpRequest) {
            // código para IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("valoracionPendiente_Despacho").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","views/modal_TSValoracion_Pendiente.php?us="+us,true);
        xmlhttp.send();
    }else{
        document.getElementById('fade').style.display = none;
        document.getElementById('light').style.display = none;
    }
};

function Alerta_Licencias(data){
    //alert(data);
    var fecha = document.getElementById('fecha').value;
    if(fecha !== 'undefined'){
        if (window.XMLHttpRequest){
            // código para IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }else{
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function(){
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("Alerta_LicenciasTH").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","views/modal_Alerta_LicenciasTH.php?us="+data,true);
        xmlhttp.send();
    }else{
        document.getElementById('fade').style.display = none;
        document.getElementById('light').style.display = none;
    }
};
function date_diligencia(){
    var fecha = document.getElementById('fecha_interrogatorio').value;
    var hora = document.getElementById('hora_interrogatorio').value;
    var anotacion = document.getElementById('anotacion').value;
    
    document.getElementById("anotacion").value=anotacion+fecha+" a las "+hora;
}