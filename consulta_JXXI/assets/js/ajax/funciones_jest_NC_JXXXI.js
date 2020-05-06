//**************** Funciones creadas inicial 2017-03-27 Manizales ***********************//
//************************** JUAN ESTEBAN MÙNERA BETANCUR *******************************//
function buscar_proceso(){
    //var inicio      = document.getElementById("fecha").value;
    //var fin         = document.getElementById("fecha_fin").value;
    var user        = document.getElementById("id_user").value;
    var radicado    = document.getElementById("radicado").value;    
    var demandante  = document.getElementById("demandante").value;  
    var cedula1     = document.getElementById("cedula1").value;
    var demandado   = document.getElementById("demandado").value;
    var cedula2     = document.getElementById("cedula2").value;
    //alert(inicio); alert(fin);
    //alert(radicado);
    if(radicado == "" && demandante == "" && cedula1== "" && demandado== "" && cedula2== "" ){
        alert("Por Favor ingrese al menos un dato para realizar la consulta.");
    }else{
        if(user != ""){
            document.getElementById("filtro_consulta").style.visibility = "visible";
            if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }
            else{// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    document.getElementById("filtro_consulta").innerHTML = xmlhttp.responseText;
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
            xmlhttp.open("POST","view/consulta/filtros/filtro_proceso.php",true);
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlhttp.send("user="+user+"&radicado="+radicado+"&demandante="+demandante+"&cedula1="+cedula1+"&demandado="+demandado+"&cedula2="+cedula2);
        }
    }
};
function info_proceso(radi){
    //var radi = radi.toString();
    //alert("Esteban "+radi);
    var radix = document.getElementById("radix").value;
    if(radix !== 'undefined'){
        if (window.XMLHttpRequest) {
            // código para IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function(){
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("info_procesoModal").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","view/consulta/filtros/modal_info_proceso.php?us="+radi,true);
        xmlhttp.send();
    }else{
        document.getElementById('fade').style.display = none;
        document.getElementById('light').style.display = none;
    }
};
function closeModal() { 
    var x = document.getElementById("ventana");
    x.close(); 
};

function info_actuaciones(radi){
    //var radi = radi.toString();
    //alert("Esteban "+radi);
    var radix = document.getElementById("radix").value;
    
    if(radix !== 'undefined'){
        if (window.XMLHttpRequest) {
            // código para IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function(){
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("Actu_procesoModal").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","view/consulta/filtros/modal_info_historia.php?radicado="+radi,true);
        xmlhttp.send();
    }else{
        document.getElementById('fade').style.display = none;
        document.getElementById('light').style.display = none;
    }
};