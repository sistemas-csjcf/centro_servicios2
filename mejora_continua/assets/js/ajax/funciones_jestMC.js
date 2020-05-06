//**************** Funciones creadas inicial 2018-06-18 Manizales ***********************//
//************************** JUAN ESTEBAN MÙNERA BETANCUR *******************************//
function search_tareas(){
    var id      = document.getElementById("id").value;
    var inicio  = document.getElementById("fechaInicio").value;
    var fin     = document.getElementById("fechaFin").value;
    var id_user = document.getElementById("id_user").value;
    var estado  = document.getElementById("flag_estado").value;
    //alert(inicio); alert(fin);
    if(id_user != ""){
        document.getElementById("tb_inicial").style.visibility = "hidden";
        document.getElementById("tb_inicial").style.display ="none";
        document.getElementById("resultado").style.visibility = "visible";
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
                var progreso = 0;
                var idIterval = setInterval(function(){
                    progreso +=10;
                    $('#bar').css('width', progreso + '%');
                    if(progreso == 100){
                        clearInterval(idIterval);
                    }
                },1000);
            }
        }
        xmlhttp.open("POST","view/mejora_c/filtros/filtro_tareas_despacho.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("inicio="+inicio+"&fin="+fin+"&id_user="+id_user+"&id="+id+"&estado="+estado);
    }
}
function ver_doc_adjunto(id, ruta){
    //alert(id+" "+ruta);
    if(id==1 && ruta !=''){
        window.open("upload_tareas/"+ruta)
    }else if(id == 2 && ruta !=''){
        window.open("upload_gestion/"+ruta)
    }else if(id == 3 && ruta !=''){
        window.open("upload_Hallazgos/"+ruta)
    }else if(id == 4 && ruta !=''){
        window.open("upload_Gestion_Hallazgos/"+ruta)
    }else{
        alert("Error al abrir archivo");
    }
}
function search_solicitudes_admin(){
    var id              = document.getElementById("id").value;
    var inicio          = document.getElementById("fechaInicio").value;
    var fin             = document.getElementById("fechaFin").value;
    var id_user         = document.getElementById("id_user").value;
    var id_solicitante  = document.getElementById("id_despacho").value;
    //alert(inicio); alert(fin);
    if(id_user != ""){
        document.getElementById("tb_inicial").style.visibility = "hidden";
        document.getElementById("tb_inicial").style.display ="none";
        document.getElementById("resultado").style.visibility = "visible";
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
                var progreso = 0;
                var idIterval = setInterval(function(){
                    progreso +=10;
                    $('#bar').css('width', progreso + '%');
                    if(progreso == 100){
                        clearInterval(idIterval);
                    }
                },1000);
            }
        }
        xmlhttp.open("POST","view/mejora_c/filtro_mis_tareas_admin.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("inicio="+inicio+"&fin="+fin+"&id_user="+id_user+"&id="+id+"&id_despacho="+id_solicitante);
    }
}
function search_Historial_mis_tareasUS(){
    var id              = document.getElementById("id").value;
    var inicio          = document.getElementById("fechaInicio").value;
    var fin             = document.getElementById("fechaFin").value;
    var id_responsable  = document.getElementById("id_responsable").value;
    var flag = 1;
    if(flag >0){
        document.getElementById("tb_inicial").style.visibility = "hidden";
        document.getElementById("tb_inicial").style.display ="none";
        document.getElementById("resultado").style.visibility = "visible";
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
                var progreso = 0;
                var idIterval = setInterval(function(){
                    progreso +=10;
                    $('#bar').css('width', progreso + '%');
                    if(progreso == 100){
                        clearInterval(idIterval);
                    }
                },1000);
            }
        }
        xmlhttp.open("POST","view/mejora_c/filtro_historial_mis_tareas_us.php",true)
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("inicio="+inicio+"&fin="+fin+"&id="+id+"&id_responsable="+id_responsable);
    }
}
function search_mis_tareas(){
    var id              = document.getElementById("id").value;
    var inicio          = document.getElementById("fechaInicio").value;
    var fin             = document.getElementById("fechaFin").value;
    var id_user         = document.getElementById("id_user").value;
    //alert(inicio); alert(fin);
    if(id_user != ""){
        document.getElementById("tb_inicial").style.visibility = "hidden";
        document.getElementById("tb_inicial").style.display ="none";
        document.getElementById("resultado").style.visibility = "visible";
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
                var progreso = 0;
                var idIterval = setInterval(function(){
                    progreso +=10;
                    $('#bar').css('width', progreso + '%');
                    if(progreso == 100){
                        clearInterval(idIterval);
                    }
                },1000);
            }
        }
        xmlhttp.open("POST","view/mejora_c/filtro_mis_tareas.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("inicio="+inicio+"&fin="+fin+"&id_user="+id_user+"&id="+id);
    }
};
function all_task_admin(bandera){
    var id              = document.getElementById("id").value;
    var inicio          = document.getElementById("fechaInicio").value;
    var fin             = document.getElementById("fechaFin").value;
    var id_solicitante  = document.getElementById("id_solicitante").value;
    var id_responsable  = document.getElementById("id_responsable").value;
    var id_clase        = document.getElementById("id_clase").value;
    var id_norma        = document.getElementById("id_norma").value;
    var id_metodologia  = document.getElementById("id_metodologia").value;
    var id_generadax    = document.getElementById("id_generado").value;
    var estado          = document.getElementById("estado").value;

    
    if(bandera > 0){
        document.getElementById("tb_inicial").style.visibility = "hidden";
        document.getElementById("tb_inicial").style.display ="none";
        document.getElementById("resultado").style.visibility = "visible";
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
                var progreso = 0;
                var idIterval = setInterval(function(){
                    progreso +=10;
                    $('#bar').css('width', progreso + '%');
                    if(progreso == 100){
                        clearInterval(idIterval);
                    }
                },1000);
            }
        }
        xmlhttp.open("POST","view/mejora_c/filtro_ALL_tareasAD.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("inicio="+inicio+"&fin="+fin+"&id_solicitante="+id_solicitante+"&id="+id+"&id_responsable="+id_responsable+"&id_clase="+id_clase+"&id_norma="+id_norma+"&id_metodologia="+id_metodologia+"&id_generado="+id_generadax+"&estado="+estado);
    }
};
function all_find_admin(bandera){
    var id              = document.getElementById("id").value;
    var inicio          = document.getElementById("fechaInicio").value;
    var fin             = document.getElementById("fechaFin").value;
    var id_responsable  = document.getElementById("id_responsable").value;
    var estado          = document.getElementById("estado").value;
    if(bandera > 0){
        document.getElementById("tb_inicial").style.visibility = "hidden";
        document.getElementById("tb_inicial").style.display ="none";
        document.getElementById("resultado").style.visibility = "visible";
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
                var progreso = 0;
                var idIterval = setInterval(function(){
                    progreso +=10;
                    $('#bar').css('width', progreso + '%');
                    if(progreso == 100){
                        clearInterval(idIterval);
                    }
                },1000);
            }
        }
        xmlhttp.open("POST","view/Hallazgos/filtro_ALL_Find_AD.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("inicio="+inicio+"&fin="+fin+"&id="+id+"&id_responsable="+id_responsable+"&estado="+estado);
    }
};
function search_mis_hallazgos(){
    var id      = document.getElementById("id").value;
    var inicio  = document.getElementById("fechaInicio").value;
    var fin     = document.getElementById("fechaFin").value;
    var id_user = document.getElementById("id_user").value;
    //var estado  = document.getElementById("id_solicitante").value;
    
    if(id_user != ""){
        document.getElementById("tb_inicial").style.visibility = "hidden";
        document.getElementById("tb_inicial").style.display ="none";
        document.getElementById("resultado").style.visibility = "visible";
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
                var progreso = 0;
                var idIterval = setInterval(function(){
                    progreso +=10;
                    $('#bar').css('width', progreso + '%');
                    if(progreso == 100){
                        clearInterval(idIterval);
                    }
                },1000);
            }
        }
        xmlhttp.open("POST","view/Hallazgos/filtro_mis_HallazgosP.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("inicio="+inicio+"&fin="+fin+"&id_user="+id_user+"&id="+id);
    }
};
function search_Historial_mis_HallazgosUS(){
    var id              = document.getElementById("id").value;
    var inicio          = document.getElementById("fechaInicio").value;
    var fin             = document.getElementById("fechaFin").value;
    var id_responsable  = document.getElementById("id_responsable").value;
    var flag = 1;
    if(flag >0){
        document.getElementById("tb_inicial").style.visibility = "hidden";
        document.getElementById("tb_inicial").style.display ="none";
        document.getElementById("resultado").style.visibility = "visible";
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
                var progreso = 0;
                var idIterval = setInterval(function(){
                    progreso +=10;
                    $('#bar').css('width', progreso + '%');
                    if(progreso == 100){
                        clearInterval(idIterval);
                    }
                },1000);
            }
        }
        xmlhttp.open("POST","view/Hallazgos/filtro_historial_mis_Hallazgos_us.php",true)
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("inicio="+inicio+"&fin="+fin+"&id="+id+"&id_responsable="+id_responsable);
    }
}

function getTimeMis_tareas_admin() {
    var time = $.ajax({
        url: 'view/mejora_c/contadores/contador_task_admin.php',
            dataType: 'text',
            async: false     //ponemos el parámetro asyn a falso
    }).responseText;
    //actualizamos el contenedor que nos mostrará 
    document.getElementById("badge_mis_tareas_admin").innerHTML = time;
}
setInterval(getTimeMis_tareas_admin,1000);

function getTimeMisTareas() {
    var time = $.ajax({
        url: 'view/mejora_c/contadores/contador_task_us.php',
            dataType: 'text',
            async: false     //ponemos el parámetro asyn a falso
    }).responseText;
    //actualizamos el contenedor que nos mostrará 
    document.getElementById("badge_mis_tareas").innerHTML = time;
}
setInterval(getTimeMisTareas,1000);

function getTimeMisHallazgos() {
    var time = $.ajax({
        url: 'view/mejora_c/contadores/contador_Find.php',
            dataType: 'text',
            async: false     //ponemos el parámetro asyn a falso
    }).responseText;
    //actualizamos el contenedor que nos mostrará 
    document.getElementById("badge_mis_hallazgos").innerHTML = time;
}
setInterval(getTimeMisHallazgos,1000);