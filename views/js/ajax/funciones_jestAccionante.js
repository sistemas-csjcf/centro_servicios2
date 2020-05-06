//*************** Funciones creadas inicial 2019-12-09 Manizales ******************//
//************************** Paola Zapata Gonzalez *******************************//
function buscar_acci(){
    var txt_accionante = document.getElementById("txt_accionante").value;
    //alert(txt_accionante);
    var cant_radi = txt_accionante.length;
    if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            //document.getElementById("numerodoce").style.readonly = "false";
        }
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById("resultado1").innerHTML=xmlhttp.responseText;
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
        xmlhttp.open("POST","views/sidoju_consultar_accionante.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("acci="+txt_accionante);
};