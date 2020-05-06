$(function(){
	
	//PARA VALIDAR LOS CAMPOS DEL FORMULARIO
	var validator = $("#frm").validate({
		meta: "validate"
	});
	
	//PARA LIMPIAR LOS CAMPOS DEL FORMULARIO
	$(".btn_limpiar").click(function() {
		validator.resetForm();
	});		
	
	
	//PARA OCULTAR tablaconsulta
	//$('#tablaconsulta').hide();
	
	//PARA LAS FECHAS
	$("#fechag").datepicker({ changeFirstDay: false	});
	$("#fechai").datepicker({ changeFirstDay: false	});
	$("#fechaf").datepicker({ changeFirstDay: false	});
	//$("#fechae").datepicker({ changeFirstDay: false	});
	
	//CARGAR LISTAS SEGUN UN DATO ESPECIFICADO EN OTRA LISTA
	$("#tipodocumento").change(function(event){
            
			var id    = $("#tipodocumento").find(':selected').val();
			
			//alert(id);
			$.get("funciones/traer_datos_consecutivo.php?id="+id, function(datoconsecutivo){
				
					//alert(datoconsecutivo);
					$("#ndocumento").val(datoconsecutivo);
					
					//ASIGO EL VALOR DEL CONTADOR ACTUAL SEGUN EL TIPO DE DOCUMENTO Y
					//PODER ACTUALIZARLO EN LA TABLA sigdoc_pa_consecutivo
					var consecutivo = datoconsecutivo.split("-");
					consecutivo		= parseInt(consecutivo[1]);
					//alert(consecutivo);
																		 
					$("#consecutivodocumento").val(consecutivo);
			
			});
			
    });
	
	//FILTRAR TABLA REGISTRO DOCUMENTOS SALIENTES
	$('.filtrar').click(function(evento){
	
		//alert(1);
		
		
		if (document.getElementById('idds').value.length           == 0 &&
			document.getElementById('fechai').value.length         == 0 &&
			document.getElementById('fechaf').value.length         == 0 &&
			document.getElementById('tipodocumentos').value.length == 0 &&
			document.getElementById('ndocumento').value.length     == 0 &&
			document.getElementById('dirigidoa').value.length      == 0 &&
			document.getElementById('nombre').value.length         == 0 &&
			document.getElementById('cargo').value.length          == 0 &&
			document.getElementById('dependencia').value.length    == 0 &&
			document.getElementById('asunto').value.length         == 0 &&
			document.getElementById('usuariox').value.length       == 0){
			
			//************************************************************************************
			//CIERRO ESTA PARTE PERO TAMBIEN FUNCIONA, PERO EXIGE AL USUARIO
			//QUE DEFINA ALGUN FILTRO
			/*alert("Definir Algun Campo para Realizar la Consulta");
			document.getElementById('fechai').style.borderColor='#FF0000';
			document.getElementById('fechaf').style.borderColor='#FF0000';
			document.getElementById('tipodocumento').style.borderColor='#FF0000';
			document.getElementById('ndocumento').style.borderColor='#FF0000';
			document.getElementById('dirigidoa').style.borderColor='#FF0000';
			document.getElementById('nombre').style.borderColor='#FF0000';
			document.getElementById('cargo').style.borderColor='#FF0000';
			document.getElementById('dependencia').style.borderColor='#FF0000';
			document.getElementById('asunto').style.borderColor='#FF0000';*/
			//************************************************************************************
			
			//ASIGNO VALOR DE 3 YA QUE EN LA VISTA sigdoc_listar_documentos_salientes.php
			//AL FINAL DE ESTA PREGUNTO POR if(!empty($opcion)), SI PONGO CERO (0) NO LO VALIDA
			//CON LA FUNCION empty()
			dato_0 = 3;
			
			location.href="index.php?controller=sigdoc&action=RecargarTabla&dato_0="+dato_0;
       	
		}
		else{
		
			dato_0 = 1;
			dato_1 = document.getElementById('fechai').value;
			dato_2 = document.getElementById('fechaf').value;
			
			datox1 = document.getElementById('tipodocumentos').value;
			datox2 = document.getElementById('ndocumento').value;
			datox3 = document.getElementById('dirigidoa').value;
			datox4 = document.getElementById('nombre').value;
			datox5 = document.getElementById('cargo').value;
			datox6 = document.getElementById('dependencia').value;
			datox7 = document.getElementById('asunto').value;
			datox8 = document.getElementById('idds').value;
			
			datox9 = document.getElementById('usuariox').value
			
			//alert(datox1);
	
			//location.href="index.php?controller=sigdoc&action=FiltroTabla&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2;
			
			//$('#tablaconsulta').show();
			
			location.href="index.php?controller=sigdoc&action=FiltroTabla&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4+"&datox5="+datox5+"&datox6="+datox6+"&datox7="+datox7+"&datox8="+datox8+"&datox9="+datox9;
	
		}
	
    });
	
	//ME PERMITE CARGAR LOS DATOS AL FORMULARIO, SEGUN EL ID ESPECIFICADO
	$(".editar").click(function(){
								

		//CAPTURO EL ID DEL DOCUMENTO EL CUAL QUIERO EDITAR
		var id = $(this).attr('data-id');
		
		//ASIGNO EL VALOR ID A UN INPUT OCULTO EN EL FORMULARIO,PARA PODER SER ACTUALIZADO EL DOCUMENTO EN LA BASE DE DATOS
		$("#iddocumento").val(id);
		
		location.href="index.php?controller=sigdoc&action=Editar_documento_Saliente&id="+id;
		
	 
		//$.get("funciones/traer_datos_documento.php?id="+id, function(cadena){
																	 
		/*$.get("index.php?controller=sigdoc&action=traer_datos_documento&id="+id, function(cadena){
			
			//alert(cadena);
			
			//RECIBO LOS DATOS DE traer_datos_documento, SEGUN EL ID DEL DOCUMENTO EL CUAL QUIERO EDITAR
			//Y CARGO CADA CAMPO DEL FORMULARIO SEGUN SU DATO
			var datos_formulario = cadena.split("//////");
			
			//alert(datos_formulario[7]);
			
			$("#tipodocumento").val(parseInt(datos_formulario[3]));
			$("#tipodocumento").attr('disabled', 'disabled');
			
			$("#ndocumento").val(datos_formulario[4]);
			$("#dirigidoa").val(parseInt(datos_formulario[5]));
			$("#nombre").val(datos_formulario[6]);
			$("#cargo").val(datos_formulario[7]);
			$("#dependencia").val(datos_formulario[8]);
			
			$("#fechag").val(datos_formulario[9]);
			$("#fechag").attr('disabled', 'disabled');
			
			$("#asunto").val(datos_formulario[10]);
			$("#detalleds").val(datos_formulario[11]);
			
		
		});*/
		
	
	});
	
	//ME PERMITE GENERAR DOCUMENTO ESPECIFICADO EN WORD
	$(".generarword").click(function(){
	

		var id	= $(this).attr('data-id');
		
		//alert(id);
	
		location.href="index.php?controller=sigdoc&action=GenerarDocumentoSaliente&opcion=1&id="+id;

		//window.open("views/PHPPdf/Reporte_DocumentoSaliente.php?id="+id);
			
		
	});
	
	//*********************************************************************************************
	//PARA DOCUMENTOS ENTRANTES
	//*********************************************************************************************
	
	//FILTRAR TABLA REGISTRO DOCUMENTOS SALIENTES
	$('.filtrare').click(function(evento){
	
		//alert(1);
		
		
		if (document.getElementById('idde').value.length           == 0 &&
			document.getElementById('fechai').value.length         == 0 &&
			document.getElementById('fechaf').value.length         == 0 &&
			document.getElementById('tipodocumentoe').value.length == 0 &&
			document.getElementById('ndocumento').value.length     == 0 &&
			document.getElementById('remitente').value.length      == 0 &&
			document.getElementById('asunto').value.length         == 0 &&
			document.getElementById('usuariox').value.length       == 0){
			
	
			//ASIGNO VALOR DE 3 YA QUE EN LA VISTA sigdoc_listar_documentos_salientes.php
			//AL FINAL DE ESTA PREGUNTO POR if(!empty($opcion)), SI PONGO CERO (0) NO LO VALIDA
			//CON LA FUNCION empty()
			dato_0 = 3;
			
			location.href="index.php?controller=sigdoc&action=RecargarTablaEntrantes&dato_0="+dato_0;
       	
		}
		else{
		
			dato_0 = 1;
			dato_1 = document.getElementById('fechai').value;
			dato_2 = document.getElementById('fechaf').value;
			
			datox1 = document.getElementById('tipodocumentoe').value;
			datox2 = document.getElementById('ndocumento').value;
			datox3 = document.getElementById('remitente').value;
			datox4 = document.getElementById('asunto').value;
			datox5 = document.getElementById('idde').value;
			datox6 = document.getElementById('usuariox').value;
			
			//alert(datox1);
	
	
			location.href="index.php?controller=sigdoc&action=FiltroTablaEntrantes&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4+"&datox5="+datox5+"&datox6="+datox6;
	
		}
	
    });
	
	//ME PERMITE CARGAR LOS DATOS AL FORMULARIO, SEGUN EL ID ESPECIFICADO
	$(".editare").click(function(){
								

		//CAPTURO EL ID DEL DOCUMENTO EL CUAL QUIERO EDITAR
		var id = $(this).attr('data-id');
		
		//ASIGNO EL VALOR ID A UN INPUT OCULTO EN EL FORMULARIO,PARA PODER SER ACTUALIZADO EL DOCUMENTO EN LA BASE DE DATOS
		$("#iddocumento").val(id);
		
		location.href="index.php?controller=sigdoc&action=Editar_documento_Entrante&id="+id;
	
	
	});
	
	//ME PERMITE DAR RESPUESTA A UN DOCUMENTO DE ENTRADA
	$(".darrespuesta").click(function(){
	

		var idrespuesta	= $(this).attr('data-idrespuesta');
		
		var fecharespuesta	= $(this).attr('data-fecharespuesta');
		
		//alert(idrespuesta+"****"+fecharespuesta);
	
		if(fecharespuesta == "0000-00-00"){
			
			//alert("Se registra Respuesta");
			location.href="index.php?controller=sigdoc&action=Respuesta_documento_Entrante&idrespuesta="+idrespuesta;
		
		}
		else{
			alert("No es Posible Darle Respuesta al Documento, Ya Cuenta con una Fecha de Respuesta, el "+fecharespuesta);
		}
			
		
	});
	
	//ME PERMITE CARGAR UNA VENTANA Y MOSTRAR GRAFICA
	$(".grafica").click(function(){
	

		window.open("Graficas/Grafica_Balance.php","GRAFICA","width=600,height=400,scrollbars=YES");
			
		
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

function Obtener_Hora(hora,minuto,segundo){
	
	
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
	
}
function trim(cadena){
	
       cadena=cadena.replace(/^\s+/,'').replace(/\s+$/,'');
       return(cadena);
}

function valor(idvalor){
	
       alert(idvalor);
}


