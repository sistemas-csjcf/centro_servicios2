//**************** Funciones creadas inicial 2017-10-03 Manizales ***********************//
//************************** JUAN ESTEBAN MÙNERA BETANCUR *******************************//

function buscar_us(){
    var cedula       = document.getElementById("cedulaUs").value;
    var cantidad_num = cedula.length;
    if(cantidad_num <1){
        alert("el campo Cédula se encuentra vacio");
        document.getElementById("cedulaUs").style.border ="solid #A52A2A 1px";
        document.getElementById("resultado").innerHTML="";
    }else{
        document.getElementById("cedulaUs").style.border ="solid #32CD32 1px";
        if (window.XMLHttpRequest){
            xmlhttp=new XMLHttpRequest();
        }else{
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
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
        xmlhttp.open("POST","view/permisos/permisos-info_usuario.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("cedu="+cedula);
    }
};
function ver_pdf(id, ruta){
    //alert(id+" "+ruta);
    if(id==1 && ruta !=''){
        window.open("?documentos_HV/fotos/="+ruta)
    }else if(id == 2 && ruta !=''){
        window.open("documentos_HV/Certificados_Estudios/"+ruta)
    }else if(id == 3 && ruta !=''){
        window.open("documentos_HV/Certificados_Laborales/"+ruta)
    }else if(id == 4 && ruta !=''){
        window.open("Documentos_TH/Constancias_Horarios/"+ruta)
    }else if(id == 5 && ruta !=''){
        window.open("Documentos_TH/Comprobantes_Matriculas/"+ruta)
    }else if(id == 6 && ruta !=''){
        window.open("Documentos_TH/REPS_Docs_Permisos/"+ruta)
    } else if(id == 7 && ruta !='') {
        window.open("Docs_Resoluciones/permisos/" + ruta)
    } else if(id == 8 && ruta !='') {
        window.open("Documentos_TH/REPS_Docs_Licencia/" + ruta)
    } else {
        alert("Error al abrir archivo");
    }

    //Docs_Resoluciones\licencias
}

function Descargar_HV(id_empleado){
    alert(id_empleado);
    //location.href="?c=hoja_vida&a=Generar_PDF_HV&id_empleado="+id_empleado;
    
    //window.open("view/Hoja_vida/Generar_PDF_hv.php?id_empleado="+id_empleado)
};

function mi_validacion_mayor(formulario)
{
    var id_usuario = document.getElementById('idUser').value;
    //alert(id_usuario);

    var mis_fechas = [];
    var mi_horai   = [];
    var mi_horaf   = [];
    var meses      = [];
    var fechas = document.frm_permisos.elements["fecha[]"];
    var horai  = document.frm_permisos.elements["horai[]"];
    var horaf  = document.frm_permisos.elements["horaf[]"];
    var url_ = "";
    if(fechas.length == undefined)
    {
        mis_fechas[0] = document.getElementById('fecha1').value;
        mi_horai[0] = document.getElementById('horai1').value;
        mi_horaf[0] = document.getElementById('horaf1').value;
        //alert("entro: " + document.getElementById('fecha1').value);
    }
    else
    {
        for(i = 0; i < fechas.length; i++)
        {
            mis_fechas[i] = fechas[i].value;
            mi_horai[i] = horai[i].value;
            mi_horaf[i] = horaf[i].value;
            //mis_fechas[i] = fechas[i].value;
            //alert(fechas[i]);
            /* this let date_ = new Date(fechas[i].value);
            //alert(date_);
            var mes = date_.getMonth() + 1;
            //alert(mes);
            if(!(meses.includes(mes)))
            {
                meses[i] = mes;
                mis_fechas[i] = fechas[i].value;
                mi_horai[i] = horai[i].value;
                mi_horaf[i] = horaf[i].value;
            } this */

            /*if( !(mis_fechas.includes(fechas[i].value) ))
            {
                mis_fechas[i] = fechas[i].value;
            }*/
        }
    }

    for(i = 0; i < mis_fechas.length; i++)
    {
        url_ += "fecha[]=" + mis_fechas[i] + "&horai[]=" + mi_horai[i] + "&horaf[]=" + mi_horaf[i];
        //alert("Fecha: " + mis_fechas[i]);
    }
    url_ = "iduser=" + id_usuario + "&" + url_;


    if (window.XMLHttpRequest) {
        // código para IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var resultado_ = "";
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            resultado_ = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", "view/permisos/validar_permisos.php?" + url_, true);
    xmlhttp.send();

    //alert(resultado_);


    /*alert(mis_fechas[0]);
    let date_ = new Date(mis_fechas[0]);
    var mes = date_.getMonth() + 1;
    alert("mes: " + mes);*/
    /*for(i = 0; i < fechas.length; i++)
    {
        alert(fechas[i].value);
    }*/

    
    //alert(url_);


    //for(i = 0; i < fechas.length; i++)
    //{
        /*if( !(mis_fechas.include(fechas[i].value) ) )
        {
            mis_fechas[i] = fechas[i].value;
        }*/
      //  alert(fechas[i].value);
        //alert(mis_fechas[i]);
   // }
    // para validar el tiempo usado en permiso, de las fechas del grid
    
    //valida = formulario.comentarios.value != "";
    //if (!valida) alert("debe rellenar el campo de texto");
    //return valida;
    //alert("si");

};

function check_fecha(obj)
{
    //alert('check' + obj.value);
    if (document.getElementById('check' + obj.value).checked)
    {
        document.getElementById('horai' + obj.value).value = "08:00:00";
        document.getElementById('horaf' + obj.value).value = "18:00:00";
    }
    else
    {
        document.getElementById('horai' + obj.value).value = 0;
        document.getElementById('horaf' + obj.value).value = 0;
    }
};


function check_Lunes(){
    var lunes = document.getElementById('lunes');
    
    if (document.getElementById('check_LN').checked){
        document.getElementById('lunes').disabled = false;
        document.getElementById('lunes1').disabled = false;
        document.getElementById('cod_lunes').value = 1;
    }else{
        document.getElementById('lunes').disabled = true;
        document.getElementById('lunes1').disabled = true;
        document.getElementById('cod_lunes').value = 0;
    }
}
function check_Lunes1(){
    var lunes2 = document.getElementById('lunes2');

    if (document.getElementById('check_LN1').checked){
        document.getElementById('lunes2').disabled = false;
        document.getElementById('lunes3').disabled = false;
        document.getElementById('flag_lunes').value = 1;
    }else{
        document.getElementById('lunes2').disabled = true;
        document.getElementById('lunes3').disabled = true;
        document.getElementById('flag_lunes').value = 0;
    }
}
function check_Lunes_all(){
    if (document.getElementById('check_LN').checked){
        if (document.getElementById('check_LN1').checked){
            document.getElementById('lunes').value = "08:00:00";
            document.getElementById('lunes1').value = "18:00:00";
        }else{
            document.getElementById('lunes').value = 0;
            document.getElementById('lunes1').value = 0;
        }
    }else{
        alert("por favor activar primero el dìa");
        //document.getElementById('check_LN1').checked = "false";
        $("#check_LN1").prop('checked', false);
    }
};
function check_Martes(){
    if (document.getElementById('check_MT').checked){
        document.getElementById('martes').disabled = false;
        document.getElementById('martes1').disabled = false;
        document.getElementById('cod_martes').value = 2;
    }else{
        document.getElementById('martes').disabled = true;
        document.getElementById('martes1').disabled = true;
        document.getElementById('cod_martes').value = 0;
    }
}
function check_Martes1(){
    if (document.getElementById('check_MT1').checked){
        document.getElementById('martes2').disabled = false;
        document.getElementById('martes3').disabled = false;
        document.getElementById('flag_martes').value = 1;
    }else{
        document.getElementById('martes2').disabled = true;
        document.getElementById('martes3').disabled = true;
        document.getElementById('flag_martes').value = 0;
    }
}
function check_Martes_all(){
    if (document.getElementById('check_MT1').checked){
        document.getElementById('martes').value = "08:00:00";
        document.getElementById('martes1').value = "18:00:00";
    }else{
        document.getElementById('martes').value = 0;
        document.getElementById('martes1').value = 0;
    }
};
function check_Miercoles(){
    if (document.getElementById('check_MI').checked){
        document.getElementById('miercoles').disabled = false;
        document.getElementById('miercoles1').disabled = false;
        document.getElementById('cod_miercoles').value = 3;
    }else{
        document.getElementById('miercoles').disabled = true;
        document.getElementById('miercoles1').disabled = true;
        document.getElementById('cod_miercoles').value = 0;
    }
}
function check_Miercoles1(){
    if (document.getElementById('check_MI1').checked){
        document.getElementById('miercoles2').disabled = false;
        document.getElementById('miercoles3').disabled = false;
        document.getElementById('flag_miercoles').value = 1;
    }else{
        document.getElementById('miercoles2').disabled = true;
        document.getElementById('miercoles3').disabled = true;
        document.getElementById('flag_miercoles').value = 0;
    }
}
function check_Jueves(){
    if (document.getElementById('check_JU').checked){
        document.getElementById('jueves').disabled = false;
        document.getElementById('jueves1').disabled = false;
        document.getElementById('cod_jueves').value = 4;
    }else{
        document.getElementById('jueves').disabled = true;
        document.getElementById('jueves1').disabled = true;
        document.getElementById('cod_jueves').value = 0;
    }
}
function check_Jueves1(){
    if (document.getElementById('check_JU1').checked){
        document.getElementById('jueves2').disabled = false;
        document.getElementById('jueves3').disabled = false;
        document.getElementById('flag_jueves').value = 1;
    }else{
        document.getElementById('jueves2').disabled = true;
        document.getElementById('jueves3').disabled = true;
        document.getElementById('flag_jueves').value = 0;
    }
}
function check_Viernes(){
    if (document.getElementById('check_VR').checked){
        document.getElementById('viernes').disabled = false;
        document.getElementById('viernes1').disabled = false;
        document.getElementById('cod_viernes').value = 5;
    }else{
        document.getElementById('viernes').disabled = true;
        document.getElementById('viernes1').disabled = true;
        document.getElementById('cod_viernes').value = 0;
    }
};
function check_Viernes1(){
    if (document.getElementById('check_VR1').checked){
        document.getElementById('viernes2').disabled = false;
        document.getElementById('viernes3').disabled = false;
        document.getElementById('flag_viernes').value = 1;
    }else{
        document.getElementById('viernes2').disabled = true;
        document.getElementById('viernes3').disabled = true;
        document.getElementById('flag_viernes').value = 0;
    }
};
function check_Viernes_all(){
    if (document.getElementById('check_VR1').checked){
        document.getElementById('viernes2').disabled = false;
        document.getElementById('viernes3').disabled = false;
        document.getElementById('flag_viernes').value = 1;
    }else{
        document.getElementById('viernes2').disabled = true;
        document.getElementById('viernes3').disabled = true;
        document.getElementById('flag_viernes').value = 0;
    }
};
function Check_other(){
    if (document.getElementById('check_other').checked){
        document.getElementById('datos_other').style.display = "block";
        document.getElementById("other_cedula").required=true;
        document.getElementById("other_nombre").required=true;
    }else{
        document.getElementById('datos_other').style.display = "none";
        document.getElementById('other_cedula').value="";
        document.getElementById('other_nombre').value="";
        document.getElementById("other_cedula").required=false;
        document.getElementById("other_nombre").required=false;
    }
};

function Reporte_Excel(idreporte){
    //alert(idreporte);
    var user    = document.getElementById("id_usuario").value;
    var fechaI  = document.getElementById("fechaI").value;
    var fechaF  = document.getElementById("fechaF").value;
    var estado  = document.getElementById("estado").value;
    if(idreporte == 1){
        if (user == 0 && fechaI == 0 && fechaF == 0 && estado == 0){
            alert("Definir Algun Campo para Realizar el Filtro");
            document.getElementById('id_usuario').style.borderColor='#FF0000';
            document.getElementById('fechaI').style.borderColor='#FF0000';
            document.getElementById('fechaF').style.borderColor='#FF0000';
            document.getElementById('estado').style.borderColor='#FF0000';
        }else{
            dato_0 = 3000;
            dato_1 = user;
            dato_2 = fechaI;
            dato_3 = fechaF;
            dato_4 = estado;
            datos_reportepermiso = dato_0+"//////////"+dato_1+"//////////"+dato_2+"//////////"+dato_3+"//////////"+dato_4;
            //alert (datos_reporte_3);
            //alert(user+" fi "+fechaI+" ff "+fechaF+" estado "+estado);
            location.href="/centro_servicios2/index.php?controller=reps&action=ReporteExcel&datos_reportepermiso="+datos_reportepermiso;
        }
    }
    if(idreporte == 2){		
        if (fechaI == 0 && fechaF == 0){
            alert("Definir Rango de Fechas para Generar el Consolidado");
            document.getElementById('fechaI').style.borderColor='#FF0000';
            document.getElementById('fechaF').style.borderColor='#FF0000';
            //document.getElementById('estado').style.borderColor='#FF0000';
        }else{	
            dato_0 = 4000;
            dato_1 = user;
            dato_2 = fechaI;
            dato_3 = fechaF;
            dato_4 = estado;
            datos_reportepermiso = dato_0+"//////////"+dato_1+"//////////"+dato_2+"//////////"+dato_3+"//////////"+dato_4;
            //alert (datos_reporte_3);
            location.href="/centro_servicios2/index.php?controller=reps&action=ReporteExcel&datos_reportepermiso="+datos_reportepermiso;
        }
    }
    if(idreporte == 3){
        //alert('EN DESARROLLO...');
        dato_0 = 5000;
        dato_1 = user;
        dato_2 = fechaI;
        dato_3 = fechaF;
        datos_reportecompletosalidaentrada = dato_0+"//////////"+dato_1+"//////////"+dato_2+"//////////"+dato_3;
        location.href="/centro_servicios2/index.php?controller=reps&action=ReporteExcel&datos_reportecompletosalidaentrada="+datos_reportecompletosalidaentrada;
    }
    if(idreporte == 4){
        dato_1 = 2000;
        dato_2 = fechaI;
        dato_3 = fechaF;
        datos_reporte = dato_1+"//////////"+dato_2+"//////////"+dato_3;
        //alert (datos_reporte_3);
        location.href="/centro_servicios2/index.php?controller=reps&action=ReporteExcel&datos_reporte="+datos_reporte;
    }
};
function consultar_permisos(){
    var user    = document.getElementById("id_usuario").value;
    var fechaI  = document.getElementById("fechaI").value;
    var fechaF  = document.getElementById("fechaF").value;
    var estado  = document.getElementById("estado").value;
    if (user == 0 && fechaI == 0 && fechaF == 0 && estado == 0){
        alert("Definir Algun Campo para Realizar el Filtro");
        document.getElementById('id_usuario').style.borderColor='#FF0000';
        document.getElementById('fechaI').style.borderColor='#FF0000';
        document.getElementById('fechaF').style.borderColor='#FF0000';
        document.getElementById('estado').style.borderColor='#FF0000';
        document.getElementById("reporte_filtro_permisos").innerHTML = "";
        //return;
    }else{
        document.getElementById("reporte_inicial").innerHTML = "";
        
        if (window.XMLHttpRequest) {
            // código para IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("reporte_filtro_permisos").innerHTML = xmlhttp.responseText;
                document.getElementById("load").style.display = "none";
            }else{
                document.getElementById("load").style.display = "block";
                var progreso = 0;
                var idIterval = setInterval(function(){
                    progreso +=10;
                    $('#bar').css('width', progreso + '%');
                    if(progreso == 100){
                        clearInterval(idIterval);
                    }
                },1000);
            }
        };
        xmlhttp.open("GET","view/permisos/filtro_reporte_permisos_reps.php?user="+user+"&inicio="+fechaI+"&fin="+fechaF+"&estado="+estado,true);
        xmlhttp.send();
    }
};

function consultar_permisos_mayores(){
    var user    = document.getElementById("id_usuario").value;
    var fechaI  = document.getElementById("fechaI").value;
    var fechaF  = document.getElementById("fechaF").value;
    var estado  = document.getElementById("estado").value;
    if (user == 0 && fechaI == 0 && fechaF == 0 && estado == 0){
        alert("Definir Algun Campo para Realizar el Filtro");
        document.getElementById('id_usuario').style.borderColor='#FF0000';
        document.getElementById('fechaI').style.borderColor='#FF0000';
        document.getElementById('fechaF').style.borderColor='#FF0000';
        document.getElementById('estado').style.borderColor='#FF0000';
        document.getElementById("reporte_filtro_permisos").innerHTML = "";
        //return;
    }else{
        document.getElementById("reporte_inicial").innerHTML = "";
        
        if (window.XMLHttpRequest) {
            // código para IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("reporte_filtro_permisos").innerHTML = xmlhttp.responseText;
                document.getElementById("load").style.display = "none";
            }else{
                document.getElementById("load").style.display = "block";
                var progreso = 0;
                var idIterval = setInterval(function(){
                    progreso +=10;
                    $('#bar').css('width', progreso + '%');
                    if(progreso == 100){
                        clearInterval(idIterval);
                    }
                },1000);
            }
        };
        xmlhttp.open("GET","view/permisos/filtro_reporte_permisos_mayor_reps.php?user="+user+"&inicio="+fechaI+"&fin="+fechaF+"&estado="+estado,true);
        xmlhttp.send();
    }
};


function consultar_permisos_estudio()
{
    var user    = document.getElementById("id_usuario").value;
    var fechaI  = document.getElementById("fechaI").value;
    var fechaF  = document.getElementById("fechaF").value;
    var estado  = document.getElementById("estado").value;
    if (user == 0 && fechaI == 0 && fechaF == 0 && estado == 0){
        alert("Definir Algun Campo para Realizar el Filtro");
        document.getElementById('id_usuario').style.borderColor='#FF0000';
        document.getElementById('fechaI').style.borderColor='#FF0000';
        document.getElementById('fechaF').style.borderColor='#FF0000';
        document.getElementById('estado').style.borderColor='#FF0000';
        document.getElementById("resultado").innerHTML = "";
        //return;
    }else{
        document.getElementById("tb_inicial").innerHTML = "";
        
        if (window.XMLHttpRequest) {
            // código para IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("resultado").innerHTML = xmlhttp.responseText;
                document.getElementById("load").style.display = "none";
            }else{
                document.getElementById("load").style.display = "block";
                var progreso = 0;
                var idIterval = setInterval(function(){
                    progreso +=10;
                    $('#bar').css('width', progreso + '%');
                    if(progreso == 100){
                        clearInterval(idIterval);
                    }
                },1000);
            }
        };
        xmlhttp.open("GET","view/permisos/filtro_reporte_permisos_estudio_reps.php?user="+user+"&inicio="+fechaI+"&fin="+fechaF+"&estado="+estado,true);
        xmlhttp.send();
    }
};


/*
function getTimePermiso_menor1() {
    var time = $.ajax({
        url: 'view/contadores/contador_permiso_menor1.php',
            dataType: 'text',
            async: false     //ponemos el parámetro asyn a falso
    }).responseText;
    //actualizamos el contenedor que nos mostrará 
    document.getElementById("badge_permiso_menor1").innerHTML = time;
}
setInterval(getTimePermiso_menor1,1000);

function getTimePermiso_mayor1() {
    var time = $.ajax({
        url: 'view/contadores/contador_permiso_mayor1.php',
            dataType: 'text',
            async: false     //ponemos el parámetro asyn a falso
    }).responseText;
    //actualizamos el contenedor que nos mostrará 
    document.getElementById("badge_permiso_mayor1").innerHTML = time;
}
setInterval(getTimePermiso_mayor1,1000);

function getTimePermiso_estudio() {
    var time = $.ajax({
        url: 'view/contadores/contador_permiso_estudio.php',
            dataType: 'text',
            async: false     //ponemos el parámetro asyn a falso
    }).responseText;
    //actualizamos el contenedor que nos mostrará 
    document.getElementById("badge_permiso_estudio").innerHTML = time;
}
setInterval(getTimePermiso_estudio,1000);

function getTimePermisos_total() {
    var time = $.ajax({
        url: 'view/contadores/contador_permisos_total.php',
            dataType: 'text',
            async: false     //ponemos el parámetro asyn a falso
    }).responseText;
    //actualizamos el contenedor que nos mostrará 
    document.getElementById("badge_permisos_total").innerHTML = time;
}
setInterval(getTimePermisos_total,1000);

*/

function Traer_Datos_Partes_Reg(idvalor){
    //alert(idvalor);
    $.get("content/traer_info_servidor_resolucion.php?idvalor="+idvalor, function(cadena){
        var vector_datos = cadena.split("//////");
        //alert(vector_datos.length);
        if(vector_datos.length == 4){
            $("#id_servidor").val(vector_datos[0]);
            $("#other_nombre").val(vector_datos[2]);
            $("#cargo_servidor").val(vector_datos[3]);
            //$("#other_nombre").attr('disabled',true);
        }else{
            $("#id_servidor").val('');
            $("#other_nombre").val('');
            $("#cargo_servidor").val('');
            //$("#other_nombre").attr('disabled',false);
        }
    });
}


// 2019-02-05 JEST
function clase_nombramiento(id){
    //alert(id);
    if(id == 1){ // PROPIEDAD
        document.getElementById("licencia").style.display = "block";
        document.getElementById("ubicacion_provi").style.display = "none";
        document.getElementById("ext_field_encargo").style.display = "none";
        
        document.getElementById("ext_field_licencia").style.display = "none";
        document.getElementById("ext_field_propiedad").style.display = "none";
        document.getElementById("resolTras_provi").style.display = "none";
        document.getElementById("ext_field_provisionalidad").style.display = "none";
        document.getElementById("ext_field_provisionalidad1").style.display = "none";
        document.getElementById("resolTras_provi").style.display = "none";
        document.getElementById("txt_reemplaza").style.display = "none";
        document.getElementById("ext_ubicacion_Enc").style.display = "none";
    }else if(id == 2){ // PROVISIONALIDAD
        document.getElementById("licencia").style.display = "none";
        document.getElementById("ubicacion_provi").style.display = "block";
        document.getElementById("ext_field_encargo").style.display = "none";
        
        document.getElementById("ext_field_licencia").style.display = "none";
        document.getElementById("ext_field_propiedad").style.display = "none";
        document.getElementById("resolTras_provi").style.display = "none";
        document.getElementById("ext_field_provisionalidad").style.display = "none";
        document.getElementById("ext_field_provisionalidad1").style.display = "none";
        document.getElementById("resolTras_provi").style.display = "none";
        document.getElementById("txt_reemplaza").style.display = "none";
        document.getElementById("ext_ubicacion_Enc").style.display = "none";
    }else if (id == 3){ // ENCARGO
        
        document.getElementById("licencia").style.display = "none";
        document.getElementById("ubicacion_provi").style.display = "none";
        document.getElementById("ext_field_encargo").style.display = "block";
        document.getElementById("txt_reemplaza").style.display = "block";
        document.getElementById("ext_ubicacion_Enc").style.display = "block";
        
        document.getElementById("ext_field_licencia").style.display = "none";
        document.getElementById("ext_field_propiedad").style.display = "none";
        document.getElementById("resolTras_provi").style.display = "none";
        document.getElementById("ext_field_provisionalidad").style.display = "none";
        document.getElementById("ext_field_provisionalidad1").style.display = "none";
        document.getElementById("resolTras_provi").style.display = "none";
        
    }else{
        document.getElementById("licencia").style.display = "none";
        document.getElementById("ubicacion_provi").style.display = "none";
        document.getElementById("ext_field_encargo").style.display = "none";
        
        document.getElementById("ext_field_licencia").style.display = "none";
        document.getElementById("ext_field_propiedad").style.display = "none";
        document.getElementById("resolTras_provi").style.display = "none";
        document.getElementById("ext_field_provisionalidad").style.display = "none";
        document.getElementById("ext_field_provisionalidad1").style.display = "none";
        document.getElementById("resolTras_provi").style.display = "none";
        document.getElementById("txt_reemplaza").style.display = "none";
        document.getElementById("ext_ubicacion_Enc").style.display = "none";
    }
}
function licencia(id){
    if(id == 1){
        document.getElementById("ext_field_propiedad").style.display = "block";
        document.getElementById("ext_field_licencia").style.display = "none";
        
       // document.getElementById("pla_fecha_finProv").required = false;
    }else{
        document.getElementById("ext_field_licencia").style.display = "block";
        document.getElementById("ext_field_propiedad").style.display = "none";
    }
}
function ubicacion_Prov(id){
    if(id == 2){ // Centro Servicios
        document.getElementById("ext_field_provisionalidad").style.display = "block";
        document.getElementById("ext_field_provisionalidad1").style.display = "block";
        document.getElementById("resolTras_provi").style.display = "none";
    }else{ // Other
        document.getElementById("ext_field_provisionalidad").style.display = "none";
        document.getElementById("ext_field_provisionalidad1").style.display = "none";
        document.getElementById("resolTras_provi").style.display = "block";
    }
};
function Provisionalidad_Abierto(dato){
    if(dato == 1){
        document.getElementById("pla_fecha_finProv").disabled = true;
        document.getElementById("pla_fecha_finProv").required = false;
    }else{
        document.getElementById("pla_fecha_finProv").disabled = false;
        document.getElementById("pla_fecha_finProv").required = true;
    }
}
function ubicacion_encargo(data){
    //alert (data);
    if(data == 2){ // Centro Servicios
        document.getElementById("area_enc").style.display = "block";
        document.getElementById("resolucion_encargo").style.display = "none";
    }else{ // Other
        document.getElementById("area_enc").style.display = "none";
        document.getElementById("resolucion_encargo").style.display = "block";
    }
}
function ubicacion_propiedad(data){
    if(data == 2){ // Centro Servicios
        document.getElementById("area_pro").style.display = "block";
    }else{ // Other
        document.getElementById("area_pro").style.display = "none";
    }
}
function Res_Clase_nombramiento(dato){
    //alert(dato);
    if (dato == 1){
        document.getElementById("adicional_propiedad").style.display = "block";
        document.getElementById("adicional_propiedad1").style.display = "block";
        
        document.getElementById("adicional_provisionalidad").style.display = "none";
        document.getElementById("adicional_provisionalidad1").style.display = "none";
        document.getElementById("adicional_encargo").style.display = "none";
        document.getElementById("adicional_encargo1").style.display = "none";
    }else if( dato == 2){
        document.getElementById("adicional_provisionalidad").style.display = "block";
        document.getElementById("adicional_provisionalidad1").style.display = "block";
        
        document.getElementById("adicional_propiedad").style.display = "none";
        document.getElementById("adicional_propiedad1").style.display = "none";
        document.getElementById("adicional_encargo").style.display = "none";
        document.getElementById("adicional_encargo1").style.display = "none";
        
    }else if( dato == 3){
        document.getElementById("adicional_encargo").style.display = "block";
        document.getElementById("adicional_encargo1").style.display = "block";
        
        document.getElementById("adicional_propiedad").style.display = "none";
        document.getElementById("adicional_propiedad1").style.display = "none";
        document.getElementById("adicional_provisionalidad").style.display = "none";
        document.getElementById("adicional_provisionalidad1").style.display = "none";
    }else{
        document.getElementById("adicional_propiedad").style.display = "none";
        document.getElementById("adicional_propiedad1").style.display = "none";
        document.getElementById("adicional_provisionalidad").style.display = "none";
        document.getElementById("adicional_provisionalidad1").style.display = "none";
        document.getElementById("adicional_encargo").style.display = "none";
        document.getElementById("adicional_encargo1").style.display = "none";
    }
}
function ubicacion_ResProp(data){
    if(data == 2){ // Centro Servicios
        document.getElementById("area_cs").style.visibility = "visible";
    }else{ // Other
        document.getElementById("area_cs").style.visibility = "hidden";
    }
}
function ubicacion_ResProv(data){
    if(data == 2){ // Centro Servicios
        document.getElementById("area_csProv").style.visibility = "visible";
    }else{ // Other
        document.getElementById("area_csProv").style.visibility = "hidden";
    }
}
function ubicacion_ResEnc(data){
    if(data == 2){ // Centro Servicios
        document.getElementById("area_csEnc").style.visibility = "visible";
    }else{ // Other
        document.getElementById("area_csEnc").style.visibility = "hidden";
    }
}
function filtro_resoluciones_nombramiento(){
    var tipoN = document.getElementById("tipo_nombramiento").value;
    var id_us = document.getElementById("id_usuario").value;
    
    if (window.XMLHttpRequest){
        xmlhttp=new XMLHttpRequest();
    }else{
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("resultado").innerHTML = xmlhttp.responseText;
            document.getElementById("load").style.display = "none";
            document.getElementById("tb_inicial").style.display = "none";
        }else{
            document.getElementById("load").style.display = "block";
            var progreso = 0;
            var idIterval = setInterval(function(){
                progreso +=10;
                $('#bar').css('width', progreso + '%');
                if(progreso == 100){
                    clearInterval(idIterval);
                }
            },1000);
        }
    };

    xmlhttp.open("POST","view/nombramientos/filtro_resoluciones_nombramiento.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("id_us="+id_us+"&tipoNom="+tipoN);
    
}
function first_timeFlag(){
    if (document.getElementById('flag_first_vez').checked){
        document.getElementById("num_pazSalvo").readOnly = false;
    }else{
        document.getElementById("num_pazSalvo").readOnly = true;
    }
}