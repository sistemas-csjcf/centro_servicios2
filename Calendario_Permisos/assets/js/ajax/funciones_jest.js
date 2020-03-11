//**************** Funciones creadas inicial 2017-07-04 Manizales ***********************//
//************************** JUAN ESTEBAN MÙNERA BETANCUR *******************************//
function consultar_rangoGestion(){
    var inicio  = document.getElementById("fechaI").value;
    var fin     = document.getElementById("fechaF").value;
    var lider   = document.getElementById("lider_juzgado").value;
    if (fin == "") {
        document.getElementById("reporte_gestionAgotada").innerHTML = "";
        return;
    } else { 
        document.getElementById("radicado_gestionAgotada").innerHTML = "";
        document.getElementById("radicado").value = "";
        if (window.XMLHttpRequest) {
            // código para IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("reporte_gestionAgotada").innerHTML = xmlhttp.responseText;
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
        xmlhttp.open("GET","view/gestion/listado_gestionAgotada.php?inicio="+inicio+"&fin="+fin+"&lider="+lider,true);
        xmlhttp.send();
    }
};
function buscar_GestionRadicado(radicado){
    //alert(radicado);
    if (radicado == "") {
        document.getElementById("radicado_gestionAgotada").innerHTML = "";
        return;
    } else { 
        document.getElementById("reporte_gestionAgotada").innerHTML = "";
        document.getElementById("fechaI").value = "";
        document.getElementById("fechaF").value = "";
        if (window.XMLHttpRequest) {
            // código para IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("radicado_gestionAgotada").innerHTML = xmlhttp.responseText;
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
        xmlhttp.open("GET","view/gestion/Radicado_gestionAgotada.php?radicado="+radicado,true);
        xmlhttp.send();
    }
};