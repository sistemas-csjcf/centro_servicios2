//**************** Funciones creadas inicial 2018-05-15 Manizales ***********************//
//************************** JUAN ESTEBAN MÙNERA BETANCUR *******************************//
function consultar_Tutelas(){
    var inicio      = document.getElementById("fechaInicio").value;
    var fin         = document.getElementById("fechaFin").value;
    //alert(inicio); alert(fin);
    //alert(radicado);
    if(inicio != ""){
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
        xmlhttp.open("POST","view/Lista_tutela/filtros/filtro_tutela.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("inicio="+inicio+"&fin="+fin);
    }
};
function migrar_tutela(radicado){
    var radicado1 = toString(radicado);
    alert(radicado1);
}
function consultar_Tutelas_migrar(){
    var inicio      = document.getElementById("fechaInicio").value;
    var fin         = document.getElementById("fechaFin").value;
    //alert(inicio); alert(fin);
    //alert(radicado);
    if(inicio != ""){
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
        xmlhttp.open("POST","view/Lista_tutela/filtros/filtro_tutela_migrar.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("inicio="+inicio+"&fin="+fin);
    }
};
function consultar_Tutelas_migrar_despacho(){
    var inicio      = document.getElementById("fechaInicio").value;
    var fin         = document.getElementById("fechaFin").value;
    //alert(inicio); alert(fin);
    //alert(radicado);
    if(inicio != ""){
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
        xmlhttp.open("POST","view/Lista_tutela/filtros/filtro_tutela_migrar_despacho.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("inicio="+inicio+"&fin="+fin);
    }
};
function search_local_Tutelas_despacho(flag_consulta){
    //alert(flag_consulta);
    var inicio          = document.getElementById("fechaInicio").value;
    var fin             = document.getElementById("fechaFin").value;
    var id              = document.getElementById("id").value;
    var radicado        = document.getElementById("radicado").value;
    var fecha_fallo     = document.getElementById("fecha_fallo").value;
    var cod_despacho    = document.getElementById("cod_despacho").value;
    var flag_fallo      = document.getElementById("flag_fallo").value;
    
    if(flag_consulta >0){
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
        xmlhttp.open("POST","view/alerta_tutela/filtros_alertaT/filtro_alerta_tutela.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("inicio="+inicio+"&fin="+fin+"&id="+id+"&radicado="+radicado+"&fecha_fallo="+fecha_fallo+"&cod_despacho="+cod_despacho+"&flag_fallo="+flag_fallo);
    }
}