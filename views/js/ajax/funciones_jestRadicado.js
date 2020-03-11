//*************** Funciones creadas inicial 2019-11-08 Manizales ******************//
//************************** Paola Zapata Gonzalez *******************************//
function buscar_radi(){
    var txt_radicado = document.getElementById("txt_radicado").value;
    //alert(txt_radicado);
    var cant_radi = txt_radicado.length;
    if(cant_radi >0 && cant_radi < 23){
        alert("radicado incompleto, debe contener 23 digitos y actualmente contiene: "+cant_radi);
        document.getElementById("resultado").innerHTML="";
        document.getElementById("txt_radicado").style.border ="solid #A52A2A 1px";
    }else if(cant_radi<1){
        alert("el campo RADICADO se encuentra vacio");
        document.getElementById("txt_radicado").style.border ="solid red 1px";
        document.getElementById("resultado").innerHTML="";
    }else if (cant_radi>23){
        alert("Campo RADICADO debe contener 23 digitos y actualmente contiene: "+cant_radi);
        document.getElementById("txt_radicado").style.border ="solid red 1px";
        document.getElementById("resultado").innerHTML="";
    }else{
        document.getElementById("txt_radicado").style.border ="solid #32CD32 1px";
        if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            //document.getElementById("numerodoce").style.readonly = "false";
        }
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById("resultado").innerHTML=xmlhttp.responseText;
                document.getElementById("load").style.display = "none";
                //alert("5");
            }else{
                document.getElementById("load").style.display = "block";
                //alert("6");
                var progreso = 0;
                var idIterval = setInterval(function(){
                    progreso +=10;
                    //$('#bar').css('width', progreso + '%');
                    if(progreso == 100){
                        clearInterval(idIterval);
                    }
                },100);
            } 
        }
         
        xmlhttp.open("POST","views/sidoju_consultar_radicado.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("radi="+txt_radicado);
    }
};