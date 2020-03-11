//**************** Funciones creadas inicial 2017-03-27 Manizales ***********************//
//************************** JUAN ESTEBAN MÙNERA BETANCUR *******************************//

function filtro_proceso(){
    var inicio      = document.getElementById("fecha").value;
    var fin         = document.getElementById("fecha_fin").value;
    var user        = document.getElementById("id_user").value;
    var radicado    = document.getElementById("radicado").value;    
    //alert(inicio); alert(fin);
    //alert(radicado);
    if(user != ""){
        document.getElementById("example").style.visibility = "hidden";
        document.getElementById("example").style.display ="none";
        document.getElementById("filtro_consulta").style.visibility = "visible";
        if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById("filtro_consulta").innerHTML=xmlhttp.responseText;
                document.getElementById("load").style.display ="none";
            }else{
                document.getElementById("load").style.display ="block";
                var x = document.createElement("IMG");
                x.setAttribute("src", "assets/imagenes/load1.gif");
                x.setAttribute("width", "90");
                x.setAttribute("width", "90");
                x.setAttribute("alt", "Cargando Datos...");
                document.getElementById("load").appendChild(x);
            }
        }
        xmlhttp.open("POST","view/procesos/filtros/filtro_proceso.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("inicio="+inicio+"&fin="+fin+"&user="+user+"&radicado="+radicado);
    }
}