//**************** Funciones creadas inicial 2018-06-07 Manizales ***********************//
//************************** JUAN ESTEBAN MÙNERA BETANCUR *******************************//  
function buscar_us(us){
//    var id          = document.getElementById("id").value;
//    var fechaI      = document.getElementById("fechaInicio").value;
//    var fechaF      = document.getElementById("fechaFin").value;
//    var radicado    = document.getElementById("radicado").value;
//    var demandante  = document.getElementById("demandante").value;
//    var demandado   = document.getElementById("demandado").value;
//    var juzgado     = document.getElementById("juzgado").value;
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
    xmlhttp.open("POST","view/encuesta/encuesta_info_us.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("us="+us);
};

function consultar_estadisticaCantidadEncuestasUs(){
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
        
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById("reporte_estadistica").innerHTML=xmlhttp.responseText;
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
        xmlhttp.open("GET","view/estadistica/estadistica_ContadorEncuestasUS.php?inicio="+inicio+"&fin="+fin,true);
        xmlhttp.send();
    }
};
function consultar_estadisticaCantidadEncuestasCalif (){
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
        
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById("reporte_estadistica").innerHTML=xmlhttp.responseText;
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
        xmlhttp.open("GET","view/estadistica/estadistica_ContadorEncuestasCalif.php?inicio="+inicio+"&fin="+fin,true);
        xmlhttp.send();
    }
}