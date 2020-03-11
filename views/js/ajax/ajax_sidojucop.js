$(function(){
	
	//PARA VALIDAR LOS CAMPOS DEL FORMULARIO
	var validator = $("#frm").validate({
		meta: "validate"
	});
	
	//PARA LIMPIAR LOS CAMPOS DEL FORMULARIO
	$(".btn_limpiar").click(function() {
		validator.resetForm();
	});
	

	
	//--------------------------------------------PARA REGISTRAR DOCUMENTOS ENTRANTES JUZGADOS------------------------------------------------------------
	
	/*
	//ME PERMITE VALIDAR 
	$('.btn_validardj').click(function() {
	
		ddjx   = $('#archivo').val();
		iduser = $('#iduser').val();
		
		
		if( ddjx != null || ddjx.length != 0 ) {
			
			nombre_a = nombre_archivo(ddjx);
			
			nombre_b = "ArchivosSidoju"+"/"+iduser+"/"+nombre_a;
			
			//alert(nombre_b);
			
			existe = existeUrl(nombre_b);
			
			if(existe == true){
				
				alert("YA EXISTE UN ARCHIVO CON ESE NOMBRE,POR FAVOR CAMBIAR EL NOMBRE");
				return false;
			}
			

		}
		
		
		
	});	
			
			
	$("#frm").validate({
					   
        rules: {
            
			//ejemplo con campo cedula
			//cedula: { required: true, minlength: 2},
           
		    //lastname: { required: true, minlength: 2},
            //email: { required:true, email: true},
            //phone: { minlength: 2, maxlength: 15},
            //years: { required: true},
            //message: { required:true, minlength: 2}
        },
        messages: {
           
		   //ejemplo con campo cedula
		   //cedula: "Defina Cedula",
           
		    //lastname: "Debe introducir su apellido.",
            //email : "Debe introducir un email válido.",
            //phone : "El número de teléfono introducido no es correcto.",
            //years : "Debe introducir solo números.",
            //message : "El campo Mensaje es obligatorio.",
        },
        submitHandler: function(form){
            
		
			//var dataString = 'fechae='+$('#fechae').val()+'&remitente='+$('#remitente').val()+'&tipodocumento='+$('#tipodocumento').val()+'&numerodoce='+$('#numerodoce').val()+'&nfc='+$('#nfc').val()+'&juzgadodestino='+$('#juzgadodestino').val()+'&archivo='+nombre_a;
			var url1       = "index.php?controller=sidoju&action=Registro_Documentos_Entrantes_Juzgados";
			//var dataString = 'radicadox='+radicadox+'&juzgadoorigen='+juzgadoorigen+'&idclasejuzgado='+idclasejuzgado+'&idclaseproceso='+idclaseproceso+'&iddepartamento='+iddepartamento+'&idmunicipio='+idmunicipio+'&datospartes='+$('#datospartes').val();
			
			//**********************************************************************************************************
			
			//alert(dataString);
			
			//DE ESTA FORMA CUANDO SE DESEA ENVIAR UN CAMPO FILE <input type="file" name="archivo" id="archivo" title="Archivo" size="19"/>
			var formData = new FormData(document.getElementById("frm"));
			
            $.ajax({
                type: "POST",
				dataType: "html",
                //url:"send.php",
				//url:"index.php?controller=signot&action=Registro_Proceso",
				url:url1,
				data: formData,
                //data: dataString,
                success: function(data){
					
					//NOTA: ES IMPORTANTE DEFINIR ESTE OK EN LA VISTA QUE SE ESTA VALIDANDO, YA QUE AL DAR REGISTRAR
					//EL SISTEMA REGISTRA PERO NO MUESTRA QUE LA TRANSACCION FUE BIEN O NO.
                    $("#ok").html(data);
                    $("#ok").show();
                   // $("#frm").hide();
                }
            });
		
			
        }
    });
	
	*/
	
	//----------------------------------------------------------------------------------------------------------------------------------------
	
	
	
	
	
	//PARA LAS FECHAS
	$("#fechai").datepicker({ changeFirstDay: false	});
	$("#fechaf").datepicker({ changeFirstDay: false	});
	
	//CARGAR LISTAS SEGUN UN DATO ESPECIFICADO EN OTRA LISTA
	$("#juzgadodestino").change(function(event){
            
			var id_a    = $("#juzgadodestino").find(':selected').val();
			
			//alert(id_a);
			
			var id_b = id_a.split("//////");

			var id = id_b[0];
			
			//alert(id);
			
			$.get("funciones/traer_dato_usuario_juzgado.php?id="+id, function(datousuariojuzgado){
				
					//alert(datoconsecutivo);
					$("#nombreusuariojuzgado").val(datousuariojuzgado);
					
					
			
			});
			
    });
	
	//FILTRAR TABLA VERIFICAR DOCUMENTOS ENTRANTES JUZGADOS
	$('.filtrare').click(function(evento){
	
		//alert(1);
		
		
		if (
			document.getElementById('fechai').value.length         == 0 &&
			document.getElementById('fechaf').value.length         == 0 &&
			document.getElementById('juzgadodestino').value.length == 0 
			//document.getElementById('horaji').value.length         == 0 &&
			//document.getElementById('horajf').value.length         == 0 
			){
			
	
			//ASIGNO VALOR DE 3 YA QUE EN LA VISTA sigdoc_listar_documentos_salientes.php
			//AL FINAL DE ESTA PREGUNTO POR if(!empty($opcion)), SI PONGO CERO (0) NO LO VALIDA
			//CON LA FUNCION empty()
			dato_0 = 3;
			
			location.href="index.php?controller=sidoju&action=RecargarTablaEntrantes&dato_0="+dato_0;
       	
		}
		else{
			
			dato_0 = 1;
			dato_1 = document.getElementById('fechai').value;
			dato_2 = document.getElementById('fechaf').value;
			
			datox1 = document.getElementById('juzgadodestino').value;
			/*dato_3 = document.getElementById('horaji').value;
			dato_4 = document.getElementById('horajf').value;
			
			//REALIZO ESTA PREGUNTA YA QUE SI NO SE DEFINE NINGUN RANGO DE HORA,SE ENVIA IGUAL
			//DATOS EN LAS VARABLES datox2, datox3 AFECTANDO EL FILTRO
			if (document.getElementById('horaji').value.length != 0 && document.getElementById('horajf').value.length  != 0 ){
				
				datox2 = Obtener_Formato_Hora(dato_3);
				datox3 = Obtener_Formato_Hora(dato_4);
				
			}
			else{
				datox2 = " ";
				datox3 = " ";
			}*/
			//alert(datox2+"---"+datox3);
	
	
			//location.href="index.php?controller=sidoju&action=FiltroTablaEntrantes&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3;
			
			location.href="index.php?controller=sidoju&action=FiltroTablaEntrantes&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1;
	
		}
	
    });
	
	//FUNCION QUE ME PERMITE MARCAR TODOS LOS ELEMENTOS TIPO checkbox
	//las funciones marcar y desmarcar tambien funcionan
	/*marcar = function(elemento){

		elemento = $(elemento);

		elemento.attr("checked", true);

	}*/
	$(".marcar").click(function(evento){
		$("input:checkbox").attr('checked', true);
								 
	});
	//FUNCION QUE ME PERMITE DESMARCAR TODOS LOS ELEMENTOS TIPO checkbox
	/*desmarcar = function(elemento){

		elemento = $(elemento);

		elemento.attr("checked", false);

	}*/
	$(".desmarcar").click(function(evento){
		$("input:checkbox").attr('checked', false);
								 
	});


	// PARA RECORRER LA TABLA FILA POR FILA
	$(".aprobar").click(function(evento){
										
		//alert(1);
		
		//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
		//REGISTRO controlemcabezados = 0 (TITULO DE LA TABLA) Y controlemcabezados = 1 (ENCABEZADOS)
		var controlemcabezados = 0;
		
		var idspermiso="";
		
		var f = 2;
		
		var d7;
	
		$('#frm_editar1 tr').each(function () {

			var d0  = $(this).find("td").eq(0).html();
			d7      = $(this).find("td").eq(7).html();
			
			//alert(d0);
			
			if(controlemcabezados == 0  || controlemcabezados == 1){
				controlemcabezados = controlemcabezados + 1;
			}
			else{
				
				if($("#chk"+f).is(':checked')) {  
				
					//CONCATENO TODOS LOS REGISTROS DE LA TABLA
					idspermiso = d0+"******"+idspermiso;
				}
				
				f = f + 1;

			}
	
	
		});
		
		//alert(idspermiso);
		
		/*if(idspermiso == ""){
			alert("No a Selecionado Ningun Registro de la Tabla");
		}
		else{
			//alert("APROBADO...");
			location.href="index.php?controller=sidoju&action=Registro_Vereficar_Documentos_Entrantes_Juzgados&idspermiso="+idspermiso;
		}*/
		
		if(document.getElementById('juzgadodestinover').value.length == 0){
			
			alert("Definir Juzgado Destino");
			
			document.getElementById('juzgadodestinover').style.borderColor='#FF0000';
			
		
		}
		else{
			
			if(idspermiso == ""){
				alert("No a Selecionado Ningun Registro de la Tabla");
			}
			else{
				//alert("APROBADO...");
				location.href="index.php?controller=sidoju&action=Registro_Vereficar_Documentos_Entrantes_Juzgados&idspermiso="+idspermiso+"&dj="+d7;
			}
		
		}
		
		
		
		
	});
	
	$("#juzgadodestinover").change(function(event){
            
			dato_0 = 1;
			dato_1 = document.getElementById('fechai').value;
			dato_2 = document.getElementById('fechaf').value;
			
			datox1 = document.getElementById('juzgadodestinover').value
			
			location.href="index.php?controller=sidoju&action=FiltroTablaEntrantes&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1;
			
    });
	
	// PARA IMPRIMIR REGISTROS APROBADOS
	$(".imprimir").click(function(evento){
		//alert("IMPRIMIENDO....");
		if (
			document.getElementById('fechai').value.length         == 0 ||
			document.getElementById('fechaf').value.length         == 0 ||
			document.getElementById('juzgadodestino').value.length == 0 ||
			document.getElementById('horaji').value.length == 0 ||
			document.getElementById('horajf').value.length == 0 
			){
			
	
			alert("Definir Campos para Realizar la Impresion");
			document.getElementById('fechai').style.borderColor='#FF0000';
			document.getElementById('fechaf').style.borderColor='#FF0000';
			document.getElementById('juzgadodestino').style.borderColor='#FF0000';
			document.getElementById('horaji').style.borderColor='#FF0000';
			document.getElementById('horajf').style.borderColor='#FF0000';
		}
		else{
			
			//var id	= $(this).attr('data-id');
		
			//alert(id);
		
			//location.href="index.php?controller=sigdoc&action=GenerarDocumentoSaliente&opcion=1&id="+id;
	
			//window.open("views/PHPPdf/Reporte_Aprobra_Documento_Entrantes_Juzgados?id="+id);
			
			dato_0 = document.getElementById('fechai').value;
			dato_1 = document.getElementById('fechaf').value;
			dato_2 = document.getElementById('juzgadodestino').value;
			dato_3 = document.getElementById('horaji').value;
			dato_4 = document.getElementById('horajf').value;
			
			//dato_3b = Obtener_Formato_Hora(dato_3);
			//dato_4b = Obtener_Formato_Hora(dato_4);
			
			dato_3b = Quitar_Cero_Hora(dato_3);
			dato_4b = Quitar_Cero_Hora(dato_4);
			
			//dato_3b = dato_3;
			//dato_4b = dato_4;
			
			//REALIZO ESTA PREGUNTA YA QUE SI NO SE DEFINE NINGUN RANGO DE HORA,SE ENVIA IGUAL
			//DATOS EN LAS VARABLES datox2, datox3 AFECTANDO EL FILTRO
			/*if (document.getElementById('horaji').value.length != 0 && document.getElementById('horajf').value.length  != 0 ){
				
				dato_3b = Obtener_Formato_Hora(dato_3);
				dato_4b = Obtener_Formato_Hora(dato_4);
				
			}
			else{
				dato_3b = " ";
				dato_4b = " ";
			}*/
			
			//var datos2 = dato_3b+"******"+dato_4b;
			//alert(datos2);
			
			var datos = dato_0+"******"+dato_1+"******"+dato_2+"******"+dato_3b+"******"+dato_4b;
			//alert(datos);
			window.open("views/PHPPdf/Reporte_Aprobra_Documento_Entrantes_Juzgados?datos="+datos);
			
		}
		
	});
	
	//FILTRAR TABLA LISTAR DOCUMENTOS ENTRANTES JUZGADOS
	$('.filtrare2').click(function(evento){
	
		//alert(1);
		
		
		if (
			document.getElementById('fechai').value.length         == 0 &&
			document.getElementById('fechaf').value.length         == 0 &&
			document.getElementById('horaji').value.length         == 0 &&
			document.getElementById('horajf').value.length         == 0 &&
			
			document.getElementById('remitente').value.length      == 0 &&
			document.getElementById('tipodocumento').value.length  == 0 &&
			document.getElementById('numerodoce').value.length     == 0 &&
			document.getElementById('nfc').value.length            == 0 &&
			
			document.getElementById('juzgadodestino').value.length == 0 &&
			document.getElementById('usuariox').value.length       == 0 &&
			document.getElementById('estadox').value.length        == 0 
			){
			
	
			//ASIGNO VALOR DE 3 YA QUE EN LA VISTA sigdoc_listar_documentos_salientes.php
			//AL FINAL DE ESTA PREGUNTO POR if(!empty($opcion)), SI PONGO CERO (0) NO LO VALIDA
			//CON LA FUNCION empty()
			dato_0 = 3;
			
			location.href="index.php?controller=sidoju&action=RecargarListarTablaEntrantes&dato_0="+dato_0;
       	
		}
		else{
			
			dato_0 = 1;
			dato_1 = document.getElementById('fechai').value;
			dato_2 = document.getElementById('fechaf').value;
			
			datox1 = document.getElementById('juzgadodestino').value;
			dato_3 = document.getElementById('horaji').value;
			dato_4 = document.getElementById('horajf').value;
			
			
			//REALIZO ESTA PREGUNTA YA QUE SI NO SE DEFINE NINGUN RANGO DE HORA,SE ENVIA IGUAL
			//DATOS EN LAS VARABLES datox2, datox3 AFECTANDO EL FILTRO
			if (document.getElementById('horaji').value.length != 0 && document.getElementById('horajf').value.length  != 0 ){
				
				//datox2 = Obtener_Formato_Hora(dato_3);
				//datox3 = Obtener_Formato_Hora(dato_4);
				
				datox2 = Quitar_Cero_Hora(dato_3);
				datox3 = Quitar_Cero_Hora(dato_4);
				
			}
			else{
				datox2 = " ";
				datox3 = " ";
			}
			
			//alert(datox2+"---"+datox3);
			
			datox4 = document.getElementById('remitente').value;
			datox5 = document.getElementById('tipodocumento').value;
			datox6 = document.getElementById('numerodoce').value;
			datox7 = document.getElementById('nfc').value;
			//datox8 = document.getElementById('nombreusuariojuzgado').value;
			datox9 = document.getElementById('usuariox').value
			datox10 = document.getElementById('estadox').value
	
	
			location.href="index.php?controller=sidoju&action=FiltroListarTablaEntrantes&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4+"&datox5="+datox5+"&datox6="+datox6+"&datox7="+datox7+"&datox9="+datox9+"&datox10="+datox10;
	
		}
	
    });
	
	//ME PERMITE CARGAR LOS DATOS AL FORMULARIO, SEGUN EL ID ESPECIFICADO
	$(".editare").click(function(){
								

		//CAPTURO EL ID DEL DOCUMENTO EL CUAL QUIERO EDITAR
		var id = $(this).attr('data-id');
		
		//alert(id);
		
		//ASIGNO EL VALOR ID A UN INPUT OCULTO EN EL FORMULARIO,PARA PODER SER ACTUALIZADO EL DOCUMENTO EN LA BASE DE DATOS
		$("#iddocumento").val(id);
		
		location.href="index.php?controller=sidoju&action=Editar_documento_Entrante_Juzgado&id="+id;
	
	
	});
	
	//FILTRAR TABLA IMPRIMIR DOCUMENTOS ENTRANTES JUZGADOS
	$('.filtrare3').click(function(evento){
	
		//alert(1);
		
		
		if (
			document.getElementById('fechai').value.length         == 0 &&
			document.getElementById('fechaf').value.length         == 0 &&
			document.getElementById('juzgadodestinoin').value.length == 0
			){
			
	
			//ASIGNO VALOR DE 3 YA QUE EN LA VISTA sigdoc_listar_documentos_salientes.php
			//AL FINAL DE ESTA PREGUNTO POR if(!empty($opcion)), SI PONGO CERO (0) NO LO VALIDA
			//CON LA FUNCION empty()
			dato_0 = 3;
			
			location.href="index.php?controller=sidoju&action=RecargarTablaImprimirDocumentos&dato_0="+dato_0;
       	
		}
		else{
			
			dato_0 = 1;
			dato_1 = document.getElementById('fechai').value;
			dato_2 = document.getElementById('fechaf').value;
			
			datox1 = document.getElementById('juzgadodestinoin').value;
			
			location.href="index.php?controller=sidoju&action=FiltroTablaImprimirDocumentos&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1;
	
		}
	
    });
	
	$(".marcar2").click(function(evento){
		$("input:checkbox").attr('checked', true);
								 
	});
	
	$(".desmarcar2").click(function(evento){
		$("input:checkbox").attr('checked', false);
								 
	});
	
	// PARA RECORRER LA TABLA FILA POR FILA, EH IMPRIOMIR LOS REGISTROS ESPECIFICADOS
	$(".imprimirregistros").click(function(evento){
										
		//alert(1);
		
		//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
		//REGISTRO controlemcabezados = 0 (TITULO DE LA TABLA) Y controlemcabezados = 1 (ENCABEZADOS)
		var controlemcabezados = 0;
		
		var idspermiso="";
		
		var f = 2;
	
		$('#frm_editar1 tr').each(function () {

			var d0  = $(this).find("td").eq(0).html();
			
			//alert(d0);
			
			if(controlemcabezados == 0  || controlemcabezados == 1){
				controlemcabezados = controlemcabezados + 1;
			}
			else{
				
				if($("#chkk"+f).is(':checked')) {  
				
					//CONCATENO TODOS LOS REGISTROS DE LA TABLA CON ,
					//PARA USAR LA FUNCION IN DE MYSQL IN(1,2,3)
					idspermiso = d0+","+idspermiso;
				}
				
				f = f + 1;

			}
	
	
		});
		
		//alert(idspermiso);
		
		if(document.getElementById('juzgadodestinoin').value.length == 0){
			
			alert("Definir Juzgado");
			
			document.getElementById('juzgadodestinoin').style.borderColor='#FF0000';
			
		
		}
		else{
			
			if(idspermiso == ""){
				alert("No a Selecionado Ningun Registro de la Tabla");
			}
			else{
				//alert("IMPRIMIENDO...");
				window.open("views/PHPPdf/Reporte_ADEJ.php?datos="+idspermiso);
			}
		
		}
	
		
	});
	
	$("#juzgadodestinoin").change(function(event){
            
			dato_0 = 1;
			dato_1 = document.getElementById('fechai').value;
			dato_2 = document.getElementById('fechaf').value;
			
			datox1 = document.getElementById('juzgadodestinoin').value;
			
			location.href="index.php?controller=sidoju&action=FiltroTablaImprimirDocumentos&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1;
			
			
			//PARA LLENAR UNA LISTA A PARTIR DE UN DATO DE OTRA
			/*var id    = $("#juzgadodestinoin").find(':selected').val();
			var idsql = 3;
			
			//alert(id);
			
            $("#listabloques").load('funciones/traer_datos_lista.php?id='+id+"&idsql="+idsql);*/
			
    });
	
	// PARA IMPRIMIR UN BLOQUE DE REGISTROS RELACIONADOS CON UN NOMBRE DE BLOQUE
	$(".imprimirbloque").click(function(evento){
										
		//alert(1);
		
		if(document.getElementById('juzgadodestinoin').value.length == 0 || document.getElementById('listabloques').value.length == 0){
		//if(document.getElementById('listabloques').value.length == 0){
			
			alert("Definir Juzgado Destino y Bloque");
			
			document.getElementById('juzgadodestinoin').style.borderColor='#FF0000';
			document.getElementById('listabloques').style.borderColor='#FF0000';
			
		
		}
		else{
			
			var nombrebloque = document.getElementById('listabloques').value; 
			
			//alert(nombrebloque);
			window.open("views/PHPPdf/Reporte_ADEJ_Bloque.php?datos="+nombrebloque);
		}
		

	});
	
	
});

function AJAXCrearObjeto(){
	
		var obj=false;
		
		try {
			obj = new ActiveXObject("Msxml2.XMLHTTP");
		} 
		catch (e) {
			try {
		   		obj = new ActiveXObject("Microsoft.XMLHTTP");
			} 
			catch (E) {
				obj = false;
  			}
		}

		if (!obj && typeof XMLHttpRequest!='undefined') {
			obj = new XMLHttpRequest();
		}
		return obj;
}

function existeUrl(url) {
	
   var http = new XMLHttpRequest();
   http.open('HEAD', url, false);
   http.send();
   return http.status!=404;
}

function MostrarEstadoDeArchivo(especificaciondearchivo)
{
   var fso, s = especificaciondearchivo;
   //fso = new AJAXCrearObjeto("Scripting.FileSystemObject");
   fso = AJAXCrearObjeto("Scripting.FileSystemObject");
   if (fso.FileExists(especificaciondearchivo))
      s += " existe.";
   else
   s += " no existe.";
   return(s);
}

function nombre_archivo(url){
	
	//var path = 'uploads/356a192b7913b04c54574d18c28d46e6395428ab/gallery/43c97a4f81f7faff78ba90d4d239a5550fbf099b/compramos-empresa-de-cualquier-tipo.jpg';
	
	var path = url;

	var result = path.match(/[-_\w]+[.][\w]+$/i)[0];
	
	//console.log(result); //compramos-empresa-de-cualquier-tipo.jpg
	
	return(result);
}

function Quitar_Cero_Hora(hora){
	
	datohora = hora.split(":");
	
	horareal = 0;
	
	//REALIZO ESTA PREGUNTA PARA COGER EL RANGO DE HORA
	//DE 01:00 AM - 09:00 AM Y QUITARLES EL CERO INICIAL
	//YA QUE PARA GENERAR EL REPORTE EN VERIFICAR DOCUMENTOS ENTRANTES JUZGADOS
	//EN LA BASE DE DATOS REALIZA ESTE FILTRO SIN ESTE CERO INCIAL
	if(datohora[0] >= 1 && datohora[0] <= 9){
		
		//caracter-s que deseamos eliminar
		var patron="0";
		//var cadena="2,222.10";
		//indicamos que queremos sustituir el patron por una cadena vacia
		horareal = datohora[0].replace(patron,'');
		
		horareal = trim(horareal);
		
		horareal = trim(horareal+":"+datohora[1]);
	}
	else{
		horareal = trim(datohora[0]+":"+datohora[1]);
	}
	
	return horareal;
	
	

}

function Obtener_Formato_Hora(hora){
	
	datohora = hora.split(":");
	
	horareal = 0;
	
	tipohora = "AM";
	
	//alert(datohora[0])
	
	//DOCE DEL MEDIO DIA
	if(datohora[0] == 12){
		
		horareal =  12;
		tipohora = "PM";
		horareal = horareal+":"+datohora[1]+":"+"00"+" "+tipohora;
		
	}
	//HORA MILITAR
	if(datohora[0] >= 13 && datohora[0] <= 23){
		
		horareal = parseInt(datohora[0]) - 12;//FORMULA QUE ME PERMITE OBTENER DE HORA MILITAR A HORA NORNAL EJ: 13 --> 13 - 12 = 1
		tipohora = "PM";
		horareal = horareal+":"+datohora[1]+":"+"00"+" "+tipohora;
	}
	//HORA DESDE LA 1 AM - 11 AM
	else{
		horareal = parseInt(datohora[0]);
		horareal = horareal+":"+datohora[1]+":"+"00"+" "+tipohora;
	}
	
	//alert(horareal);
	
	return horareal;
	
}



/*function Obtener_Hora(hora,minuto,segundo){
	
	
	if(minuto >= 0 && minuto <= 9){minuto = "0"+minuto; }
	if(segundo >= 0 && segundo <= 9){segundo = "0"+segundo; }
	
	//VALIDAR QUE LA HORA ESTA DESDE LA 1 DE LA MAÑANA A LAS 12 DEL MEDIO DIA Y AGREGAR AM
	if(hora >= 1 && hora <= 11){segundo = segundo+" "+"AM";}
	if(hora == 12){segundo = segundo+" "+"PM";}
	
	//CONVERTIR HORA MILITAR DESDE LA 1 DE LA TARDE HASTA LAS 12 DE LA NOCHE Y AGREGAR PM
	if(hora == 13 ){hora = 1; segundo = segundo+" "+"PM";}
	if(hora == 14 ){hora = 2; segundo = segundo+" "+"PM";}
	if(hora == 15 ){hora = 3; segundo = segundo+" "+"PM";}
	if(hora == 16 ){hora = 4; segundo = segundo+" "+"PM";}
	if(hora == 17 ){hora = 5; segundo = segundo+" "+"PM";}
	if(hora == 18 ){hora = 6; segundo = segundo+" "+"PM";}
	if(hora == 19 ){hora = 7; segundo = segundo+" "+"PM";}
	if(hora == 20 ){hora = 8; segundo = segundo+" "+"PM";}
	if(hora == 21 ){hora = 9; segundo = segundo+" "+"PM";}
	if(hora == 22 ){hora = 10; segundo = segundo+" "+"PM";}
	if(hora == 23 ){hora = 11; segundo = segundo+" "+"PM";}
	if(hora == 24 ){hora = 12; segundo = segundo+" "+"AM";}
	
	var horaactual = hora+":"+minuto+":"+segundo;
	
	return horaactual;
	
}*/
function trim(cadena){
	
       cadena=cadena.replace(/^\s+/,'').replace(/\s+$/,'');
       return(cadena);
}

function valor(idvalor){
	
       alert(idvalor);
}


