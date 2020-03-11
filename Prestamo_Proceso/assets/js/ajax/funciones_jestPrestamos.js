//**************** Funciones creadas inicial 2017-11-10 Manizales ***********************//
//************************** JUAN ESTEBAN MÙNERA BETANCUR *******************************//
function buscar_radi(){
    var radicado = document.getElementById("radicado").value;
    //alert(radicado);
    var cant_radi = radicado.length;
    if(cant_radi >0 && cant_radi < 23){
        alert("radicado incompleto, debe contener 23 digitos y actualmente contiene: "+cant_radi);
        document.getElementById("resultado").innerHTML="";
        document.getElementById("radicado").style.border ="solid #A52A2A 1px";
    }else if(cant_radi<1){
        alert("el campo RADICADO se encuentra vacio");
        document.getElementById("radicado").style.border ="solid #A52A2A 1px";
        document.getElementById("resultado").innerHTML="";
    }else if (cant_radi>23){
        alert("Campo RADICADO debe contener 23 digitos y actualmente contiene: "+cant_radi);
        document.getElementById("radicado").style.border ="solid #A52A2A 1px";
        document.getElementById("resultado").innerHTML="";
    }else{
        document.getElementById("radicado").style.border ="solid #32CD32 1px";
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
        xmlhttp.open("POST","view/prestamo/prestamos-info_proceso.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("radi="+radicado);
    }
};
function consultar_prestamo(){
    var id          = document.getElementById("id").value;
    var fechaI      = document.getElementById("fechaInicio").value;
    var fechaF      = document.getElementById("fechaFin").value;
    var radicado    = document.getElementById("radicado").value;
    var demandante  = document.getElementById("demandante").value;
    var demandado   = document.getElementById("demandado").value;
    var juzgado     = document.getElementById("juzgado").value;
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
    xmlhttp.open("POST","view/prestamo/pretamos_Filtro_consulta.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("id="+id+"&fechaI="+fechaI+"&fechaF="+fechaF+"&radicado="+radicado+"&demandante="+demandante+"&demandado="+demandado+"&juzgado="+juzgado);
};

function consultar_doc_entranteEstadistica(){
    var fechaI      = document.getElementById("fechaInicio").value;
    var fechaF      = document.getElementById("fechaFin").value;
    var tipoDoc     = document.getElementById("tipo_doc").value;
    var archivado   = document.getElementById("archivado").value;
    var medio       = document.getElementById("medio").value;
    var usuario     = document.getElementById("id_usuario").value;
    var usuarioEnc  = document.getElementById("usuarioEnc").value;
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
    xmlhttp.open("POST","view/doc_entrantes/docEntrante_Filtro_Estadistica.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("&fechaI="+fechaI+"&fechaF="+fechaF+"&tipoDoc="+tipoDoc+"&archivado="+archivado+"&medio="+medio+"&usuario="+usuario+"&usuarioEnc="+usuarioEnc);
};

function editar_fecha()
{
    var fecha0 = document.getElementById("fecha0_hidden").value;
    
    document.getElementById("edit_data_fecha").innerHTML = 
    '<input type="date" name="fechaEdit" class="form-control" id="fechaEdit" placeholder="Fecha" value="'+fecha0+'" required />';
    
    document.getElementById("observa_fecha0").innerHTML = 
    '<input type="text" name="txt_observa_f0" id="txt_observa_f0" class="form-control" onfocus="on_focus()" required /> ' + 
    '<a onclick="guardar_edicion_fecha0()" style="text-decoration: none;"><span class="icon-floppy-disk" style="font-size: 14px;"></span></a> ' + 
    '<a onclick="cancelar_editar_fecha()" style="text-decoration: none;"><span class="icon-cancel-circle" style="font-size: 14px;"></span></a> ';
    
    //alert(fecha0);
}

function on_focus()
{
    document.getElementById("txt_observa_f0").style.borderColor = "white";
}

function cancelar_editar_fecha()
{
    var fecha0 = document.getElementById("fecha0_hidden").value;
    var observa_fecha0 = document.getElementById("observa_fecha0_hidden").value;
    
    document.getElementById("edit_data_fecha").innerHTML = 
    fecha0 + '&nbsp;<a onclick="editar_fecha()" style="text-decoration: none;"> ' +
    '<span class="icon-pencil" style="font-size: 16px;"></span></a> ';
    
    document.getElementById("observa_fecha0").innerHTML = observa_fecha0;
}

function guardar_edicion_fecha0()
{
    var id = document.getElementById("id");
    var fecha0 = document.getElementById("fechaEdit");
    var observa = document.getElementById("txt_observa_f0");

    if(observa.value != "")
    {
        //alert("edit_fecha0=" + fecha0.value + "&observa_fecha0=" + observa.value);
        $.ajax
        ({
            type: "POST",
            url : '?c=Prestamo&a=Editar_Fecha_Cero',
            data: "id=" + id.value + "&edit_fecha=" + fecha0.value + "&observa_fecha=" + observa.value,
            success: function()
            {
                location.href = "?c=Prestamo&a=Procesos_Pendientes";
            }
        });
    }
    else
    {
        observa.style.borderColor = "red";
    }
}