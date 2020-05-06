var datosacciones;
var arrayRapido;

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
	
	//OCULTO ESTA FILA YA QUE EL PROGRAMA ARMARA AUTOMATICAMENTE EL CONTENIDO DEL DOCUMENTO
	$('#filacontenido').hide();
	$('#filaidparte').hide();
	//OCULTO ESTAS FILAS YA QUE NO SON NECESARIAS QUE SEAN VISIBLES POR EL USUARIO
	//$('#filacargo').hide();
	//$('#filadependencia').hide();
	//$('#filand').hide();
	
	//PARA LAS FECHAS
	$("#fechag").datepicker({ changeFirstDay: false	});
	$("#fechai").datepicker({ changeFirstDay: false	});
	$("#fechaf").datepicker({ changeFirstDay: false	});
	$("#fechaauto").datepicker({ changeFirstDay: false	});
	
	
	
	//CARGAR LISTAS SEGUN UN DATO ESPECIFICADO EN OTRA LISTA
	$("#documento").change(function(event){
            
			var id    = $("#documento").find(':selected').val();
			
			//SI NO SE SELECCIONA NINGUN DOCUMENTO, QUE BORRE EL CAMPO ASUNTO
			var datodoc  = document.frm.documento;
			var datodoc2 = datodoc.options[datodoc.selectedIndex].text;
			
			if(datodoc2 == "Seleccionar Documento"){
				$("#asunto").val('');
			}
			//****************************************************************************
			
			$("#tipodocumento").load('funciones/traer_datos_lista_documentos.php?id='+id+"&idsql="+1);
			
			$("#ndocumento").val('');
			
			//$("#contadordoc").load('funciones/traer_consecutivo.php?id='+id);
			
			//SE UBICA EN ESTA PARTE POR QUE GENER UNA INCOSISTENCIA, SI SE PONE ANTES LAS FUNCIONES ANTERIORES NO FUNCIONAN
			AgregarCampos(0,0);
		
    });
	
	$("#documentos").change(function(event){
            
			var id    = $("#documentos").find(':selected').val();
			
			$("#tipodocumentos").load('funciones/traer_datos_lista_documentos.php?id='+id+"&idsql="+1);
			
    });
	
	//CUANDO SE CAMBIA EL TIPO DE DOCUMENTO
	$("#tipodocumento").change(function(event){
            
			var id    = $("#tipodocumento").find(':selected').val();
			
			var partes;
			var iddocumento;
			
			//SI NO SE SELECCIONA NINGUN TIPO DE DOCUMENTO, QUE BORRE EL CAMPO ASUNTO
			var datoasunto  = document.frm.tipodocumento;
			var datoasunto2 = datoasunto.options[datoasunto.selectedIndex].text;
			
			if(datoasunto2 == "Seleccionar Tipo Documento"){
				$("#asunto").val('');
			}
			else{
				$("#asunto").val(datoasunto2);
			}
			//****************************************************************************
			
			//alert(id);
			$.get("funciones/traer_datos_consecutivo_documentos.php?id="+id, function(datoconsecutivo){
				
					//alert(datoconsecutivo);
					
					var dc = datoconsecutivo.split("******");
					
					//$("#ndocumento").val(datoconsecutivo);
					$("#ndocumento").val(dc[0]);
					
					//ASIGO EL VALOR DEL CONTADOR ACTUAL SEGUN EL TIPO DE DOCUMENTO Y
					//PODER ACTUALIZARLO EN LA TABLA sigdoc_pa_consecutivo
					//var consecutivo = datoconsecutivo.split("-");
					var consecutivo = dc[0].split("-");
					consecutivo		= parseInt(consecutivo[1]);
					//alert(consecutivo);
					$("#consecutivodocumento").val(consecutivo);
					
					//******************************************************************************************************************
					//NOTA: DONDE SE CAPTURA EL consecutivo, YA NO SERIA NECESARIO POR QUE ESTO YA LO ARMO 
					//EN LA FUNCION DEL MODELO documentosMode.php, FUNCION traer_datos_consecutivo, SE DEJA 
					//PRA QUE EL SISTEMA NO PRESENTE NINGUNA FALLA.
					
					//CAPTURO LOS DATOS DE LA SIGLA Y EL AÑO ACTUAL
					//Y SE ASIGNA AL CAMPO siglas DE LA VISTA documentos_generar.php
					//ESTO CON EL OBJETO DE COSNTRUIR UN NUMERO UNICO DE DOCUMENTO
					//EN LA TABLA documentos_internos CAMPO numero, BASADO EN EL CAMPO id
					//DE ESE DOCUMENTO, YA QUE SIN ESTA VALIDACION NO SE REALIZA, AL ESCOGER CUALQUIER TIPO DE DOCUMENTO
					//EL SISTEMA AUTOMATICAMENTE ASIGNA Numero Documento: XXXX DEPENDIENDO DE DONDE ESTE PARADO EL CONTADOR
					//DE CADA DOCUMENTO DE LA TABLA pa_tipodocumento, Y SE PRESENTA QUE SI DE UN PC SE ESCOGE UN OFICIO
					//Y SU CONTADOR ESTA EN 3 PASARIA A LA SIGUIENTE FORMA Numero Documento: OECMO15-004, Y SI AUN NO SE A DADO
					//CLIC EN REGISTRAR Y DESDE OTRO PC SE ESCOGE TAMBIEN TIPO DE DOCUMENTO OFICIO EL SISTEMA ARMA
					//EL Numero Documento: OECMO15-004 IGUAL Y AL DARSE CLIC EN REGISTRAR EN EAMBOS PC, OBTENDREMOS UN DOCUMENTO
					//CON IGUAL Numero Documento
					
					/*var siglas = dc[0].split("-");
					siglas	   = siglas[0];
					$("#siglas").val(siglas);*/
					
					//******************************************************************************************************************
					
					partes      = dc[1];
					iddocumento = dc[2];
					
					AgregarCampos(partes,iddocumento);
			
			});
			
			
			
    });
	
	//FILTRAR TABLA REGISTRO DOCUMENTOS SALIENTES
	$('.filtrar').click(function(evento){
	
		//alert(1);
		
		
		if (document.getElementById('idds').value.length           == 0 &&
			document.getElementById('fechai').value.length         == 0 &&
			document.getElementById('fechaf').value.length         == 0 &&
			document.getElementById('documentos').value.length     == 0 &&
			document.getElementById('tipodocumentos').value.length == 0 &&
			document.getElementById('ndocumento').value.length     == 0 &&
			document.getElementById('dirigidoa').value.length      == 0 &&
			document.getElementById('nombre').value.length         == 0 &&
			document.getElementById('direccion').value.length      == 0 &&
			document.getElementById('ciudad').value.length         == 0 &&
			document.getElementById('asunto').value.length         == 0 &&
			document.getElementById('radicadox').value.length      == 0 &&
			document.getElementById('usuariox').value.length       == 0 &&
			document.getElementById('docidentidad').value.length   == 0 &&
			document.getElementById('nombreparte').value.length    == 0){
			
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
			
			location.href="index.php?controller=documentos&action=RecargarTabla&dato_0="+dato_0;
       	
		}
		else{
		
			dato_0 = 1;
			dato_1 = document.getElementById('fechai').value;
			dato_2 = document.getElementById('fechaf').value;
		
			datox1 = document.getElementById('tipodocumentos').value;
			datox2 = document.getElementById('ndocumento').value;
			datox3 = document.getElementById('dirigidoa').value;
			datox4 = document.getElementById('nombre').value;
			datox5 = document.getElementById('direccion').value;
			datox6 = document.getElementById('ciudad').value;
			datox7 = document.getElementById('asunto').value;
			datox8 = document.getElementById('idds').value;
			datox9 = document.getElementById('documentos').value;
			datox10 = document.getElementById('radicadox').value;
			datox11 = document.getElementById('usuariox').value;
			datox12 = document.getElementById('docidentidad').value;
			datox13 = document.getElementById('nombreparte').value;
			
			//alert(datox9);
	
			//location.href="index.php?controller=sigdoc&action=FiltroTabla&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2;
			
			//$('#tablaconsulta').show();
			
			location.href="index.php?controller=documentos&action=FiltroTabla&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4+"&datox5="+datox5+"&datox6="+datox6+"&datox7="+datox7+"&datox8="+datox8+"&datox9="+datox9+"&datox10="+datox10+"&datox11="+datox11+"&datox12="+datox12+"&datox13="+datox13;
	
		}
	
    });
	
	//ME PERMITE CARGAR LOS DATOS AL FORMULARIO, SEGUN EL ID ESPECIFICADO
	$(".editar").click(function(){
								

		//CAPTURO EL ID DEL DOCUMENTO EL CUAL QUIERO EDITAR
		var id = $(this).attr('data-id');
		
		//alert(id);
		//ASIGNO EL VALOR ID A UN INPUT OCULTO EN EL FORMULARIO,PARA PODER SER ACTUALIZADO EL DOCUMENTO EN LA BASE DE DATOS
		$("#iddocumento").val(id);
		
		location.href="index.php?controller=documentos&action=Editar_documento_Saliente&id="+id;
		
	 
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
	
	$("#radicado4").change(function(event){
		
		var idradicado = $("#radicado4").val();
		
		//alert(idradicado);
		
		
		/*$.get("funciones/traer_datos_radicado_documentos.php?idradicado="+idradicado, function(datosradicado){
				
					//alert(datosradicado);
					
					datosid = datosradicado.split("//////");
					$("#idr").val(datosid[0]);
					$("#cedula_demandante").val(datosid[1]);
					$("#demandante").val(datosid[2]);
					$("#cedula_demandado").val(datosid[3]);
					$("#demandado").val(datosid[4]);
					$("#claseproceso").val(datosid[5]);
					$("#jo").val(datosid[6]);
					$("#jd").val(datosid[7]);
					
					//ASIGO EL VALOR DEL CONTADOR ACTUAL SEGUN EL TIPO DE DOCUMENTO Y
					//PODER ACTUALIZARLO EN LA TABLA sigdoc_pa_consecutivo
					/*var consecutivo = datoconsecutivo.split("-");
					consecutivo		= parseInt(consecutivo[1]);
					//alert(consecutivo);
																		 
					$("#consecutivodocumento").val(consecutivo);*/
			
		//});
		
		
		
		$.get("funciones/traer_datos_proceso_3.php?idvalor="+idradicado, function(cadena){
	
			var datos = cadena.split("******");
		
			//alert(cadena);
			
			var vector_datos = datos[0].split("//////");
			
			//alert (vector_datos.length);
			//alert (datos[1]);
			
			if(vector_datos.length == 8){
				
				//SE PREGUNTA SI UN PROCESO ESTA EN ESTA DE DEVOLUCION O NO
				if(vector_datos[6] == 0){
				
					//CAMPO OCULTO CON EL ID DEL RADICADO
					$("#idr").val(vector_datos[0]);
					
					$("#jo").val(vector_datos[2]);
					$("#claseproceso").val(vector_datos[3]);
					
					//alert(datos[1]);
					Adicionar_Parte_Tabla(datos[1]);
					
					//CARGAR ID JUZGADO PARA CARGAR LISTA DE AUTO A NOTIFICAR, EN LA PARTE CUANDO SE CREA UNA PARTE Y ES DEMANDADO
					//$("#juzgadox2").val(vector_datos[4]);
					
					//CARGAR LISTA DE AUTO A NOTIFICAR, EN LA PARTE CUANDO SE CREA UNA PARTE Y ES DEMANDADO
					//$("#autonotificar").load('funciones/traer_datos_lista.php?id='+vector_datos[5]+"&idsql="+4);
				}
				else{
				
					alert("EL PROCESO SE ENCUENTRA EN ESTADO DE DEVOLUCION, NO ES POSIBLE SU MANEJO,"+" TIPO DE DEVOLUCION A JUZGADO: "+vector_datos[7]);
					
					$("#idr").val('');
					$("#jo").val('');
					$("#claseproceso").val('');
					
					Eliminar_Tabla();
					
					//Limpiar_Campos_2();
					
					$('#partesdemandado').hide();
				}
				
			}
			else{
				
				$("#idr").val('');
				$("#jo").val('');
				$("#claseproceso").val('');
				
				Eliminar_Tabla();
				
				//Limpiar_Campos_2();
				
				$('#partesdemandado').hide();
				
			}
			
		});
		
		
		
	 
	});
	
	//ME PERMITE GENERAR DOCUMENTO ESPECIFICADO EN WORD
	$(".generarword").click(function(){
	

		var id	= $(this).attr('data-id');
		
		var idtd = $(this).attr('data-idtipodocumento');
		
		//alert(idtd);
	
		location.href="index.php?controller=documentos&action=GenerarDocumentoSaliente&opcion=1&id="+id+"&idtd="+idtd;

		//window.open("views/PHPPdf/Reporte_DocumentoSaliente.php?id="+id);
			
		
	});
	
	//FILTRAR TABLA REGISTRO DOCUMENTOS SALIENTES
	$('.estadistica').click(function(evento){
	
		//alert(1);
		
		
		if (document.getElementById('idds').value.length           == 0 &&
			document.getElementById('fechai').value.length         == 0 &&
			document.getElementById('fechaf').value.length         == 0 &&
			document.getElementById('tipodocumentos').value.length == 0 &&
			document.getElementById('ndocumento').value.length     == 0 &&
			document.getElementById('dirigidoa').value.length      == 0 &&
			document.getElementById('nombre').value.length         == 0 &&
			document.getElementById('direccion').value.length      == 0 &&
			document.getElementById('ciudad').value.length         == 0 &&
			document.getElementById('asunto').value.length         == 0 &&
			document.getElementById('usuariox').value.length       == 0 &&
		    document.getElementById('radicadox').value.length      == 0){
			
			dato_0  = 1;//para saber que es el reporte 1
			tfiltro = 1;//sin filtro
			
			location.href="index.php?controller=documentos&action=GenerarDocumentoEstadistica&opcion="+dato_0+"&tfiltro="+tfiltro;
       	
		}
		else{
		
			dato_0  = 1;//para saber que es el reporte 1
			tfiltro = 2;//con filtro
			
			dato_1 = document.getElementById('fechai').value;
			dato_2 = document.getElementById('fechaf').value;
			
			datox1 = document.getElementById('tipodocumentos').value;
			datox2 = document.getElementById('ndocumento').value;
			datox3 = document.getElementById('dirigidoa').value;
			datox4 = document.getElementById('nombre').value;
			datox5 = document.getElementById('direccion').value;
			datox6 = document.getElementById('ciudad').value;
			datox7 = document.getElementById('asunto').value;
			datox8 = document.getElementById('idds').value;
			datox9 = document.getElementById('radicadox').value;
			datox10 = document.getElementById('usuariox').value;
			
			//location.href="index.php?controller=documentos&action=GenerarDocumentoEstadistica&opcion=2";
			
			location.href="index.php?controller=documentos&action=GenerarDocumentoEstadistica&opcion="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4+"&datox5="+datox5+"&datox6="+datox6+"&datox7="+datox7+"&datox8="+datox8+"&tfiltro="+tfiltro+"&datox9="+datox9+"&datox10="+datox10;
	
		}
	
    });
	
	$(".corregir").click(function(){
								

		//CAPTURO EL ID DEL DOCUMENTO EL CUAL QUIERO CORREGIR
		var id = $(this).attr('data-id');
		
		location.href="index.php?controller=signot&action=Corregir_Notificacion&dx1="+id;
		
	});
	
	
	//------------------COMO CARGAR UNA LISTA DESDE UN ARCHIVO-----------------------------------------------------
	/*$(".notificacionpersonal").click(function(){
	
		$("#tipodocumento").load('funciones/traer_datos_lista_especificas.php?id='+2+"&idsql="+1);
	
	});*/
	
	/*$(".devolucion").click(function(){
	
		$("#tipodocumento").load('funciones/traer_datos_lista_especificas.php?id='+3+"&idsql="+1);
	
	});*/
	//-------------------------------------------------------------------------------------------------------------
	
	//SE USA ESTA FORMA YA QUE VALIDA QUE UN DOCUMENTO TENGA PARTES O NO, Y QUE SEA UNA NOTIFICACION
	$(".notificacionpersonal").click(function(){
								

		//CAPTURO EL ID DEL DOCUMENTO EL CUAL QUIERO CORREGIR
		var id = $(this).attr('data-id');
		
		//alert(id);
		
		var vcampos = $("#partesdoc").val();
		
		//alert(vcampos);
		
		var cadenapartes;
		var cadenapartes_2;
		var v;
		var i = 0;
		var bandera = 0;
		
		
		
		//CARLO LISTA TIPO DOCUMENTOS CON EL LISTADO DE LAS NOTIFICACIONES
		//$("#tipodocumento").load('funciones/traer_datos_lista_especificas.php?id='+2+"&idsql="+1);
		
		var vtd = $("#tipodocumento").find(':selected').val();
		
		//SE VERIFICA QUE EXISTAN PARTES DEL DOCUMENTO, SI NO HAY SIMPLEMENTE
		//SE VALIDA EL TIPO DE DOCUMENTO
		if( vcampos == null || vcampos.length == 0 || /^\s+$/.test(vcampos) ) {
			
			
			if( vtd == null || vtd.length == 0 || /^\s+$/.test(vtd) ) {
			
				alert("Defina Tipo Documento");
				
				document.getElementById('tipodocumento').style.borderColor = '#FF0000';
				//validar = 1;
				return false;
			}
			else{
				
				var datodoc  = document.frm.tipodocumento;
				var datodoc2 = datodoc.options[datodoc.selectedIndex].text;
				
				//SE CIERRA ESTA LINEA YA QUE NO SE PREGUNTARA SI valordoc CONTIENE LA PALBRA NOTIFICACION
				//POR ENDE EL if(valordoc >= 0){ TAMBIEN SE CIERRA
				var valordoc = datodoc2.indexOf('NOTIFICACION');
				
				//CONSULTO QUE SEA UNA NOTIFICACION LA QUE SE ESTA SELECCIONANDO DE LA LISTA TIPO DOCUMENTO
				//EN LA TABLA pa_modulo_acciones EL 3 ES NOTIFICACIONES ESPECIFICADOS EN LA COLUMNA idtabla
				//Cargar_Pa_Modulo_Acciones(3);
				//alert(vtd);
				//if(Buscar_Vector(vtd) == true){
				
				if(valordoc >= 0){
				
					if (confirm ("Esta Seguro de Generar La Notificacion")) {
			
						location.href="index.php?controller=documentos&action=Registro_Documentos_Especiales&id="+id+"&documento="+2+"&idtipodocumento="+vtd;
				
				
					}
					
				}
				else{
						alert("SE ESTA REALIZANDO UNA NOTIFICACION Y EL TIPO DE DOCUMENTO SELECCIONADO ES DIFERENTE A ESTA OPERACION ---> "+" TIPO DOCUMENTO : "+"'"+datodoc2+"'");
						return false;
				}
			}
			
		}
		//EL DOCUMENTO SE COMPONE DE PARTES Y SON VALIDADAS
		else{
			
			
			if(vcampos > 0){
			
				while (i < vcampos) { 
			
					cadenapartes = cadenapartes+"//////"+$("#parte"+i).val();
					i=i+1; 
				}
			}
			
			//alert(cadenapartes);
			
			if( cadenapartes == null || cadenapartes.length == 0 || /^\s+$/.test(cadenapartes) ) {
				
				bandera = 0;
			}
			else{
				cadenapartes_2 = cadenapartes.split("//////");
			}
			
			//alert(cadenapartes_2[1]);
			
			//CARLO LISTA TIPO DOCUMENTOS CON EL LISTADO DE LAS NOTIFICACIONES
			//$("#tipodocumento").load('funciones/traer_datos_lista_especificas.php?id='+2+"&idsql="+1);
		
			//var vtd = $("#tipodocumento").find(':selected').val();
			//var v0 = $("#parte0").val();
			
			if( vtd == null || vtd.length == 0 || /^\s+$/.test(vtd) ) {
			
				alert("Defina Tipo Documento");
				
				document.getElementById('tipodocumento').style.borderColor = '#FF0000';
				//validar = 1;
				return false;
			}
			else{
				
				
				for (i = 1; i < cadenapartes_2.length; i++) {
				  
					 if( cadenapartes_2[i] == null || cadenapartes_2[i].length == 0 || /^\s+$/.test(cadenapartes_2[i]) ) {
						 
						 bandera = 1;
						 //alert("Definar Partes");
						 //return false;
					  }
					  
				}
				
				
			}
			
			if(bandera == 0){
				
				var datodoc  = document.frm.tipodocumento;
				var datodoc2 = datodoc.options[datodoc.selectedIndex].text;
				
				//SE CIERRA ESTA LINEA YA QUE NO SE PREGUNTARA SI valordoc CONTIENE LA PALBRA NOTIFICACION
				//POR ENDE EL if(valordoc >= 0){ TAMBIEN SE CIERRA
				var valordoc = datodoc2.indexOf('NOTIFICACION');
				
				//CONSULTO QUE SEA UNA NOTIFICACION LA QUE SE ESTA SELECCIONANDO DE LA LISTA TIPO DOCUMENTO
				//EN LA TABLA pa_modulo_acciones EL 3 ES NOTIFICACIONES ESPECIFICADOS EN LA COLUMNA idtabla
				//Cargar_Pa_Modulo_Acciones(3);
				//alert(vtd);
				//if(Buscar_Vector(vtd) == true){
				
				if(valordoc >= 0){
				
					if (confirm ("Esta Seguro de Generar La Notificacion")) {
			
						location.href="index.php?controller=documentos&action=Registro_Documentos_Especiales&id="+id+"&documento="+2+"&idtipodocumento="+vtd+"&partesdoc="+cadenapartes;
				
				
					}
					
				}
				else{
					alert("SE ESTA REALIZANDO UNA NOTIFICACION Y EL TIPO DE DOCUMENTO SELECCIONADO ES DIFERENTE A ESTA OPERACION ---> "+" TIPO DOCUMENTO : "+"'"+datodoc2+"'");
					return false;
				}
				
				
				
			}
			else{
				
				alert("Definar Partes");
				return false;
			}
		
		}
		
		
	});
	
	//SE USA ESTA FORMA YA QUE VALIDA QUE UN DOCUMENTO TENGA PARTES O NO, Y QUE SEA UNA DEVOLUCION
	$(".devolucion").click(function(){
								

		//CAPTURO EL ID DEL DOCUMENTO EL CUAL QUIERO CORREGIR
		var id   = $(this).attr('data-id');
		
		//alert(id+"----"+idtd);
		
		var vcampos = $("#partesdoc").val();
		
		//alert(vcampos);
		
		var cadenapartes;
		var cadenapartes_2;
		var v;
		var i = 0;
		var bandera = 0;
		
		
		var vtd = $("#tipodocumento").find(':selected').val();
		
		//SE VERIFICA QUE EXISTAN PARTES DEL DOCUMENTO, SI NO HAY SIMPLEMENTE
		//SE VALIDA EL TIPO DE DOCUMENTO
		if( vcampos == null || vcampos.length == 0 || /^\s+$/.test(vcampos) ) {
			
		
			if( vtd == null || vtd.length == 0 || /^\s+$/.test(vtd) ) {
			
				alert("Defina Tipo Documento");
				
				document.getElementById('tipodocumento').style.borderColor = '#FF0000';
				//validar = 1;
				return false;
			}
			else{
				
				var datodoc  = document.frm.tipodocumento;
				var datodoc2 = datodoc.options[datodoc.selectedIndex].text;
				
				//SE CIERRA ESTA LINEA YA QUE NO SE PREGUNTARA SI valordoc CONTIENE LA PALBRA NOTIFICACION
				//POR ENDE EL if(valordoc >= 0){ TAMBIEN SE CIERRA
				var valordoc = datodoc2.indexOf('DEVOLUCION');
				
				//CONSULTO QUE SEA UNA NOTIFICACION LA QUE SE ESTA SELECCIONANDO DE LA LISTA TIPO DOCUMENTO
				//EN LA TABLA pa_modulo_acciones EL 4 ES DEVOLUCIONES ESPECIFICADOS EN LA COLUMNA idtabla
				//Cargar_Pa_Modulo_Acciones(4);
				//alert(vtd);
				//if(Buscar_Vector(vtd) == true){
				
				if(valordoc >= 0){
				
					if (confirm ("Esta Seguro de Realizar la Devolucion del Proceso")) {
			
						location.href="index.php?controller=documentos&action=Registro_Documentos_Especiales_2&id="+id+"&documento="+3+"&idtipodocumento="+vtd3;
				
				
					}
					
				}
				else{
					alert("SE ESTA REALIZANDO UNA DEVOLUCION Y EL TIPO DE DOCUMENTO SELECCIONADO ES DIFERENTE A ESTA OPERACION ---> "+" TIPO DOCUMENTO : "+"'"+datodoc2+"'");
					return false;
				}
			}
			
		}
		//EL DOCUMENTO SE COMPONE DE PARTES Y SON VALIDADAS
		else{
			
			
			if(vcampos > 0){
			
				while (i < vcampos) { 
			
					cadenapartes = cadenapartes+"//////"+$("#parte"+i).val();
					i=i+1; 
				}
			}
			
			//alert(cadenapartes);
			
			if( cadenapartes == null || cadenapartes.length == 0 || /^\s+$/.test(cadenapartes) ) {
				
				bandera = 0;
			}
			else{
				cadenapartes_2 = cadenapartes.split("//////");
			}
			
			//alert(cadenapartes_2[1]);
			
			//var vtd = $("#tipodocumento").find(':selected').val();
			//var v0 = $("#parte0").val();
			
			if( vtd == null || vtd.length == 0 || /^\s+$/.test(vtd) ) {
			
				alert("Defina Tipo Documento");
				
				document.getElementById('tipodocumento').style.borderColor = '#FF0000';
				//validar = 1;
				return false;
			}
			else{
				
				
				for (i = 1; i < cadenapartes_2.length; i++) {
				  
					 if( cadenapartes_2[i] == null || cadenapartes_2[i].length == 0 || /^\s+$/.test(cadenapartes_2[i]) ) {
						 
						 bandera = 1;
						 //alert("Definar Partes");
						 //return false;
					  }
					  
				}
				
				
			}
			
			if(bandera == 0){
				
				var datodoc  = document.frm.tipodocumento;
				var datodoc2 = datodoc.options[datodoc.selectedIndex].text;
				
				//SE CIERRA ESTA LINEA YA QUE NO SE PREGUNTARA SI valordoc CONTIENE LA PALBRA NOTIFICACION
				//POR ENDE EL if(valordoc >= 0){ TAMBIEN SE CIERRA
				var valordoc = datodoc2.indexOf('DEVOLUCION');
				
				//CONSULTO QUE SEA UNA NOTIFICACION LA QUE SE ESTA SELECCIONANDO DE LA LISTA TIPO DOCUMENTO
				//EN LA TABLA pa_modulo_acciones EL 4 ES DEVOLUCIONES ESPECIFICADOS EN LA COLUMNA idtabla
				//Cargar_Pa_Modulo_Acciones(4);
				//alert(vtd);
				//if(Buscar_Vector(vtd) == true){
				
				if(valordoc >= 0){
				
					if (confirm ("Esta Seguro de Realizar la Devolucion del Proceso")) {
			
						location.href="index.php?controller=documentos&action=Registro_Documentos_Especiales_2&id="+id+"&documento="+3+"&idtipodocumento="+vtd+"&partesdoc="+cadenapartes;
				
				
					}
					
				}
				else{
					alert("SE ESTA REALIZANDO UNA DEVOLUCION Y EL TIPO DE DOCUMENTO SELECCIONADO ES DIFERENTE A ESTA OPERACION ---> "+" TIPO DOCUMENTO : "+"'"+datodoc2+"'");
					return false;
				}
				
				
				
			}
			else{
				
				alert("Definar Partes");
				return false;
			}
		
		}
		
		
	});
	
	//SE USA ESTA FORMA YA QUE VALIDA QUE UN DOCUMENTO TENGA PARTES O NO, Y QUE SEA UNA NOTIFICACION
	$(".activarproceso").click(function(){
								
		//CAPTURO EL ID DEL DOCUMENTO EL CUAL QUIERO CORREGIR
		var id = $(this).attr('data-id');
		
		//alert(id);
		
		if (confirm ("Esta Seguro de Activar el Proceso, una vez realizada la activacion, ubicar el proceso indicado y realizar la antonacion de activacion especifica.")) {
			
			location.href="index.php?controller=documentos&action=Registro_Documentos_Especiales_3&id="+id;
				
		}
		
	});
	
	//--------------------------------------------------MODULO ESTADISTICA--------------------------------------------------
	//ESTADISTICA SIGNOT
	$('.estadistica_signot').click(function(evento){
	
		//alert(1);
		
		var tiporepor = $("#tiporeporte").find(':selected').val();
		
		//SE VERIFICA QUE EXISTAN PARTES DEL DOCUMENTO, SI NO HAY SIMPLEMENTE
		//SE VALIDA EL TIPO DE DOCUMENTO
		if( tiporepor == null || tiporepor.length == 0 || /^\s+$/.test(tiporepor) ) {
			
			alert("Defina Tipo Reporte");
			document.getElementById('tiporeporte').style.borderColor = '#FF0000';
		}
		
		else{
			
			if (document.getElementById('fechai').value.length     == 0 &&
			    document.getElementById('fechaf').value.length     == 0 &&
			    document.getElementById('radicadox').value.length  == 0){
			
				dato_0  = 1;//para saber que es el reporte 1
				tfiltro = 1;//sin filtro
				
				//location.href="index.php?controller=signot&action=RecargarTablaProcesos&dato_0="+dato_0;
				
				location.href="index.php?controller=estadistica&action=GenerarEstadistica_Signot&opcion="+dato_0+"&tfiltro="+tfiltro+"&tiporepor="+tiporepor;
       	
			}
			else{
			
				dato_0  = 1;//para saber que es el reporte 1
				tfiltro = 2;//con filtro
			
				dato_1 = document.getElementById('fechai').value;
				dato_2 = document.getElementById('fechaf').value;
				datox1 = document.getElementById('radicadox').value;
				
				//location.href="index.php?controller=signot&action=FiltroTablaProcesos&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1;
				
				location.href="index.php?controller=estadistica&action=GenerarEstadistica_Signot&opcion="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&tfiltro="+tfiltro+"&tiporepor="+tiporepor;
		
			}
		
		}
	
    });
	
	//ESTADISTICA SIGDOC
	$('.estadistica_sigdoc').click(function(evento){
	
		alert("Generando Reporte...");
		
		/*var tiporepor = $("#tiporeporte").find(':selected').val();
		
		//SE VERIFICA QUE EXISTAN PARTES DEL DOCUMENTO, SI NO HAY SIMPLEMENTE
		//SE VALIDA EL TIPO DE DOCUMENTO
		if( tiporepor == null || tiporepor.length == 0 || /^\s+$/.test(tiporepor) ) {
			
			alert("Defina Tipo Reporte");
			document.getElementById('tiporeporte').style.borderColor = '#FF0000';
		}
		
		else{
			
			if (document.getElementById('fechai').value.length     == 0 &&
			    document.getElementById('fechaf').value.length     == 0 &&
			    document.getElementById('radicadox').value.length  == 0){
			
				dato_0  = 1;//para saber que es el reporte 1
				tfiltro = 1;//sin filtro
				
				//location.href="index.php?controller=signot&action=RecargarTablaProcesos&dato_0="+dato_0;
				
				location.href="index.php?controller=estadistica&action=GenerarEstadistica_Signot&opcion="+dato_0+"&tfiltro="+tfiltro+"&tiporepor="+tiporepor;
       	
			}
			else{
			
				dato_0  = 1;//para saber que es el reporte 1
				tfiltro = 2;//con filtro
			
				dato_1 = document.getElementById('fechai').value;
				dato_2 = document.getElementById('fechaf').value;
				datox1 = document.getElementById('radicadox').value;
				
				//location.href="index.php?controller=signot&action=FiltroTablaProcesos&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1;
				
				location.href="index.php?controller=estadistica&action=GenerarEstadistica_Signot&opcion="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&tfiltro="+tfiltro+"&tiporepor="+tiporepor;
		
			}
		
		}*/
	
    });
	
	//ESTADISTICA SIDOJU
	$('.estadistica_sidoju').click(function(evento){
	
		alert("Generando Reporte...");
		
		/*var tiporepor = $("#tiporeporte").find(':selected').val();
		
		//SE VERIFICA QUE EXISTAN PARTES DEL DOCUMENTO, SI NO HAY SIMPLEMENTE
		//SE VALIDA EL TIPO DE DOCUMENTO
		if( tiporepor == null || tiporepor.length == 0 || /^\s+$/.test(tiporepor) ) {
			
			alert("Defina Tipo Reporte");
			document.getElementById('tiporeporte').style.borderColor = '#FF0000';
		}
		
		else{
			
			if (document.getElementById('fechai').value.length     == 0 &&
			    document.getElementById('fechaf').value.length     == 0 &&
			    document.getElementById('radicadox').value.length  == 0){
			
				dato_0  = 1;//para saber que es el reporte 1
				tfiltro = 1;//sin filtro
				
				//location.href="index.php?controller=signot&action=RecargarTablaProcesos&dato_0="+dato_0;
				
				location.href="index.php?controller=estadistica&action=GenerarEstadistica_Signot&opcion="+dato_0+"&tfiltro="+tfiltro+"&tiporepor="+tiporepor;
       	
			}
			else{
			
				dato_0  = 1;//para saber que es el reporte 1
				tfiltro = 2;//con filtro
			
				dato_1 = document.getElementById('fechai').value;
				dato_2 = document.getElementById('fechaf').value;
				datox1 = document.getElementById('radicadox').value;
				
				//location.href="index.php?controller=signot&action=FiltroTablaProcesos&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1;
				
				location.href="index.php?controller=estadistica&action=GenerarEstadistica_Signot&opcion="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&tfiltro="+tfiltro+"&tiporepor="+tiporepor;
		
			}
		
		}*/
	
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

var nextinput = 0;
var elitinput = 0;

function AgregarCampos(nunpartes,iddocumento){
	
	//alert(nunpartes);
	//ELIMINO LA LISTA DONDE ESTA UBICADO EL CAMPO (input)
	//PARA QUE REFRESQUE LOS CAMPOS NECESARIOS, SEGUN NTIPO DE DOCUMENTO SELECCIONADO
	while (elitinput < 20) {
	
		//alert($("#parte" + elitinput).val());
		$("#rut" + elitinput).remove();
    	elitinput++;
		
	}
	
	var partesdoc = nunpartes.split("//////");
	var longitud  = partesdoc.length;
	
	
	//EL IF PARA CONTROLAR LOS OFICIOS QUE NO TENGAN PARTES, PARTES CERO (0)
	if(partesdoc[0] != 0){
		
		//AGREGO NUMERO DE CAMPOS (input), SEGUN EL TIPO DE DOCUMENTO
		while (nextinput < longitud) {
			
			//PARA IDENTIFCAR QUE UN CAMPO ES FECHA, SIMPLEMENTE PREGUNTANDO
			//CON LA FUNCION indexOf QUE LA CADENA QUE VIENE EN partesdoc[nextinput]
			//CONTIENE LA PALABRA FECHA DE ALGUNA FORMA, Y QUE SU VALOR DE RETORNO ES 
			// >= 0 SI SU RETORNO ES -1 QUIERE DECIR QUE EL CAMPO NO ES FECHA
			//ES IMPORTANTE RECALCAR QUE PARA ESTO SE DEBE DEFINIR EN LA TABLA pa_tipodocumento
			//COLUMNA PARTESDOCUMENTO, CUAL DE LAS PARTE SERA FECHA SIMPLEMENTE
			//COLOCANDO LA PALABRA (FECHA,Fecha,fecha), LA CUAL PUEDE IR ACOMPAÑADA DE OTRAS PALABRAS
			var identificadorcampo1 = partesdoc[nextinput].indexOf('FECHA');
			var identificadorcampo2 = partesdoc[nextinput].indexOf('Fecha');
			var identificadorcampo3 = partesdoc[nextinput].indexOf('fecha');
			
			if(identificadorcampo1 >= 0 || identificadorcampo2 >= 0 || identificadorcampo3 >= 0){
			
				campo = '<li id="rut'+nextinput+'">'+partesdoc[nextinput]+'<input type="text" size="50" id="parte' + nextinput + '"&nbsp; name="parte' + nextinput + '"&nbsp; title="parte' + nextinput + '"&nbsp; class="required" readonly="true"/></li>';
				$("#campos").append(campo);
				$("#parte"+nextinput).datepicker({ changeFirstDay: false	});
			}
			else{
					
				campo = '<li id="rut'+nextinput+'">'+partesdoc[nextinput]+'<input type="text" size="50" id="parte' + nextinput + '"&nbsp; name="parte' + nextinput + '"&nbsp; title="parte' + nextinput + '"&nbsp; class="required"/></li>';
				$("#campos").append(campo);
				
			}
			
			
			/*if(nextinput == 0){
			
				//SE FILTRA POR 2 YA QUE LOS COMISORIOS NO LLEVAN FECHA AUTO
				if(iddocumento != 2){
					
					
					//ASI ESTABA CUANDO NO SE TENIA EL DEOficio Arancel Judicial
					campo = '<li id="rut'+nextinput+'">'+partesdoc[nextinput]+'<input type="text" size="50" id="parte' + nextinput + '"&nbsp; name="parte' + nextinput + '"&nbsp; title="parte' + nextinput + '"&nbsp; class="required" readonly="true"/></li>';
					$("#campos").append(campo);
					$("#parte0").datepicker({ changeFirstDay: false	});
					
				
				}
				else{
					
					campo = '<li id="rut'+nextinput+'">'+partesdoc[nextinput]+'<input type="text" size="50" id="parte' + nextinput + '"&nbsp; name="parte' + nextinput + '"&nbsp; title="parte' + nextinput + '"&nbsp; class="required"/></li>';
					$("#campos").append(campo);
				
				}
				
			}
			else{
				
				campo = '<li id="rut'+nextinput+'">'+partesdoc[nextinput]+'<input type="text" size="50" id="parte' + nextinput + '"&nbsp; name="parte' + nextinput + '"&nbsp; title="parte' + nextinput + '"&nbsp; class="required"/></li>';
				$("#campos").append(campo);
			}*/
			
			nextinput++;
			
		}
		
		//ASIGNO CUANTAS PARTES SE LE AGREGARON AL DOCUMENTO, PARA SER ENCIADAS Y GRABADAS EN LA BASE DE DATOS
		//$("#partesdoc").val(nunpartes);
		$("#partesdoc").val(longitud);
	
	}//FIN if(partesdoc[0] != 0){
		
	//INICIALIZO LAS VARIABLES QUE ME INDICAN HASTA DONDE AGREGAR O ELIMINAR CAMPOS
	nextinput = 0;
	elitinput = 0;
	longitud  = 0;
	partesdoc.length = 0;
	
}

//FUNCION USADA CUANDO SE VA A EDITAR UN DOCUMENTO
function AgregarCampos_Con_Contenido(nunpartes,iddocumento,contenidopartes){
	
	//ELIMINO LA LISTA DONDE ESTA UBICADO EL CAMPO (input)
	//PARA QUE REFRESQUE LOS CAMPOS NECESARIOS, SEGUN NTIPO DE DOCUMENTO SELECCIONADO
	while (elitinput < 20) {
	
		//alert($("#parte" + elitinput).val());
		$("#rut" + elitinput).remove();
    	elitinput++;
		
	}
	
	var partesdoc = nunpartes.split("//////");
	var longitud  = partesdoc.length;
	
	//alert(contenidopartes);
	var contenidopartes_2 = contenidopartes.split("//////");
	
	//alert(contenidopartes_2[1]);
	
	
	//EL IF PARA CONTROLAR LOS OFICIOS QUE NO TENGAN PARTES, PARTES CERO (0)
	if(partesdoc[0] != 0){
		
		//AGREGO NUMERO DE CAMPOS (input), SEGUN EL TIPO DE DOCUMENTO
		while (nextinput < longitud) {
			
			
			//PARA IDENTIFCAR QUE UN CAMPO ES FECHA, SIMPLEMENTE PREGUNTANDO
			//CON LA FUNCION indexOf QUE LA CADENA QUE VIENE EN partesdoc[nextinput]
			//CONTIENE LA PALABRA FECHA DE ALGUNA FORMA, Y QUE SU VALOR DE RETORNO ES 
			// >= 0 SI SU RETORNO ES -1 QUIERE DECIR QUE EL CAMPO NO ES FECHA
			//ES IMPORTANTE RECALCAR QUE PARA ESTO SE DEBE DEFINIR EN LA TABLA pa_tipodocumento
			//COLUMNA PARTESDOCUMENTO, CUAL DE LAS PARTE SERA FECHA SIMPLEMENTE
			//COLOCANDO LA PALABRA (FECHA,Fecha,fecha), LA CUAL PUEDE IR ACOMPAÑADA DE OTRAS PALABRAS
			var identificadorcampo1 = partesdoc[nextinput].indexOf('FECHA');
			var identificadorcampo2 = partesdoc[nextinput].indexOf('Fecha');
			var identificadorcampo3 = partesdoc[nextinput].indexOf('fecha');
			
			if(identificadorcampo1 >= 0 || identificadorcampo2 >= 0 || identificadorcampo3 >= 0){
			
				campo = '<li id="rut'+nextinput+'">'+partesdoc[nextinput]+'<input type="text" size="50" id="parte' + nextinput + '"&nbsp; name="parte' + nextinput + '"&nbsp; title="parte' + nextinput + '"&nbsp; value="' + contenidopartes_2[nextinput + 1] + '" class="required" readonly="true"/></li>';
				$("#campos").append(campo);
				$("#parte"+nextinput).datepicker({ changeFirstDay: false	});
			}
			else{
					
				campo = '<li id="rut'+nextinput+'">'+partesdoc[nextinput]+'<input type="text" size="50" id="parte' + nextinput + '"&nbsp; name="parte' + nextinput + '"&nbsp; title="parte' + nextinput + '"&nbsp; value="' + contenidopartes_2[nextinput + 1] + '" class="required"/></li>';
				$("#campos").append(campo);
				
			}
			
			
			/*if(nextinput == 0){
				
				//SE FILTRA POR 2 YA QUE LOS COMISORIOS NO LLEVAN FECHA AUTO
				if(iddocumento != 2){
					
					
						//ASI ESTABA CUANDO NO SE TENIA EL DEOficio Arancel Judicial
						campo = '<li id="rut'+nextinput+'">'+partesdoc[nextinput]+'<input type="text" size="50" id="parte' + nextinput + '"&nbsp; name="parte' + nextinput + '"&nbsp; title="parte' + nextinput + '"&nbsp; value="' + contenidopartes_2[nextinput + 1] + '" class="required" readonly="true"/></li>';
						$("#campos").append(campo);
						$("#parte0").datepicker({ changeFirstDay: false	});
						
					
					
				
				}
				else{
					
					campo = '<li id="rut'+nextinput+'">'+partesdoc[nextinput]+'<input type="text" size="50" id="parte' + nextinput + '"&nbsp; name="parte' + nextinput + '"&nbsp; title="parte' + nextinput + '"&nbsp; value="' + contenidopartes_2[nextinput + 1] + '" class="required"/></li>';
					$("#campos").append(campo);
				
				}
				
			}
			else{
				
				campo = '<li id="rut'+nextinput+'">'+partesdoc[nextinput]+'<input type="text" size="50" id="parte' + nextinput + '"&nbsp; name="parte' + nextinput + '"&nbsp; title="parte' + nextinput + '"&nbsp; value="' + contenidopartes_2[nextinput + 1] + '" class="required"/></li>';
				$("#campos").append(campo);
			}*/
			
			nextinput++;
			
		}
		
		//ASIGNO CUANTAS PARTES SE LE AGREGARON AL DOCUMENTO, PARA SER ENCIADAS Y GRABADAS EN LA BASE DE DATOS
		//$("#partesdoc").val(nunpartes);
		$("#partesdoc").val(longitud);
	
	}//FIN if(partesdoc[0] != 0){
		
	//INICIALIZO LAS VARIABLES QUE ME INDICAN HASTA DONDE AGREGAR O ELIMINAR CAMPOS
	nextinput = 0;
	elitinput = 0;
	longitud  = 0;
	partesdoc.length = 0;
	
}

function Adicionar_Parte_Tabla(datostabla){
	
	        var resultado = datostabla.split("------");
		
			//alert(datostabla);
			
			Filas = resultado.length;
			//alert(Filas);
			
			var cantidad_filas;
			var TABLA      = document.getElementById('t2');
			cantidad_filas = TABLA.rows.length;
	
			//alert(cantidad_filas);
			
			if(cantidad_filas>1){
						
				//alert('cantidad > 1');
					
				Eliminar_Tabla();
				
				var tabla = document.getElementById('cont2').innerHTML;
					
				for (var id=0; id < Filas-1; id++){
				
					//tabla=tabla.substring(0,(tabla.length-8)); 
					
					resultado2 = resultado[id].split("//////");
					
					tabla = reemplazarCadena("</table>", " ", tabla);
					
					tabla+='<tr>';
					
					tabla+='<td>'+resultado2[7]+'</td>';
					
					tabla+='<td>'+resultado2[0]+'</td>';
					
					tabla+='<td>'+resultado2[1]+'</td>';
					
					tabla+='<td>'+resultado2[2]+'</td>';
					
					//tabla+='<td>'+resultado2[3]+'</td>';
					
					tabla+='<td>'+resultado2[5]+'</td>';
					
					tabla+='<td>'+resultado2[6]+'</td>';
					
					tabla+='<td>'+resultado2[4]+'</td>';
					
					
					tabla+='<td><button type=button name=cargardatosparte id=cargardatosparte onclick="Cargar_Datos_Parte(this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/partes2.jpg" width="30" height="30" title="CARGAR DATOS PARTE"/></button></td>';
					
					tabla+='</tr></table>';
					
					document.getElementById('cont2').innerHTML=tabla;
					
				
				 }
			}
						
			if(cantidad_filas == 1){
						
				
				var tabla = document.getElementById('cont2').innerHTML;
				
		
				for (var id=0; id < Filas-1; id++){
					
					resultado2 = resultado[id].split("//////");
					
					tabla = reemplazarCadena("</table>", " ", tabla);
					
					tabla+='<tr>';
			
					tabla+='<td>'+resultado2[7]+'</td>';
					
					tabla+='<td>'+resultado2[0]+'</td>';
					
					tabla+='<td>'+resultado2[1]+'</td>';
					
					tabla+='<td>'+resultado2[2]+'</td>';
					
					//tabla+='<td>'+resultado2[3]+'</td>';
					
					tabla+='<td>'+resultado2[5]+'</td>';
					
					tabla+='<td>'+resultado2[6]+'</td>';
					
					tabla+='<td>'+resultado2[4]+'</td>';
					
				
					tabla+='<td><button type=button name=cargardatosparte id=cargardatosparte onclick="Cargar_Datos_Parte(this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/partes2.jpg" width="30" height="30" title="CARGAR DATOS PARTE"/></button></td>';
					
					tabla+='</tr></table>';
				
					//alert(tabla);
					document.getElementById('cont2').innerHTML=tabla;
					
					
				}
				
			}
			
	
	
}

function Cargar_Datos_Parte(idfila){
	
	//LIMPIAR CAMPOS
	$("#nombre").val('');
	$("#idparte").val('');
	$("#direccion").val('');
	$("#ciudad").val('');
	
	$("#parte0").val('');
	
	
	//SE OBTIENE EL VALOR DE CADA CELDA DE LA FILA ESPECIFICA
	var dx0  = document.getElementById("t2").rows[idfila].cells[0].innerText;
	var dx1  = document.getElementById("t2").rows[idfila].cells[1].innerText;
	var dx2  = document.getElementById("t2").rows[idfila].cells[2].innerText;
	var dx3  = document.getElementById("t2").rows[idfila].cells[3].innerText;
	var dx4  = document.getElementById("t2").rows[idfila].cells[4].innerText;
	var dx5  = document.getElementById("t2").rows[idfila].cells[5].innerText;
	var dx6  = document.getElementById("t2").rows[idfila].cells[6].innerText;
	
	//ASIGNAR VALORES
	$("#nombre").val(dx2);
	$("#idparte").val(dx0);
	$("#direccion").val(dx3);
	$("#ciudad").val(dx4+" - "+dx5);
	
	/*var dx7  = $("#jo").val();
	var dx8  = $("#claseproceso").val();
	var dx9  = $("#radicado4").val();
	
							 
	$("#parte0").val(dx7);
	$("#parte1").val(dx8);
	$("#parte2").val(dx9);
	$("#parte4").val(dx2);*/
	
	//alert(dx1);
	
	//location.href="index.php?controller=signot&action=Corregir_Notificacion&dx1="+dx1;

}

function Limpiar_Campos_2(){
	
	document.getElementById('cedula').value = "";
	document.getElementById('cedula').style.borderColor='#E0E0E0';
	
	document.getElementById('nombre').value = "";
	document.getElementById('nombre').style.borderColor='#E0E0E0';
	
	document.getElementById('direccion').value = "";
	document.getElementById('direccion').style.borderColor='#E0E0E0';
	
	document.getElementById('telefono').value = "";
	document.getElementById('telefono').style.borderColor='#E0E0E0';

	document.getElementById('clasificacionparte2').selectedIndex = 0;
	document.getElementById('clasificacionparte2').style.borderColor='#E0E0E0';
	
	document.getElementById('departamento').selectedIndex = 0;
	document.getElementById('departamento').style.borderColor='#E0E0E0';
	
	document.getElementById('municipio').selectedIndex = 0;
	document.getElementById('municipio').style.borderColor='#E0E0E0';
	document.getElementById('municipio').length = 0;
	o       = document.createElement("OPTION");
	o.value = "";
	o.text  = "Seleccionar Municipio";
	document.getElementById('municipio').options.add (o);
	
	document.getElementById('fechaxad').value = "";
	document.getElementById('fechaxad').style.borderColor='#E0E0E0';

	document.getElementById('autonotificar').selectedIndex = 0;
	document.getElementById('autonotificar').style.borderColor='#E0E0E0';
	
	$('#partesdemandado').hide();
	

}

//PARA ELIMINARTODA LA TABLA, EN UN SOLO LLAMADO
function Eliminar_Tabla(){
	
	var r;
	var cantidad_filas;
	var TABLA = document.getElementById('t2');
			
	cantidad_filas = TABLA.rows.length;
				
	for (r=1; r<cantidad_filas; r++){
		
		TABLA.deleteRow(r);
		cantidad_filas=TABLA.rows.length;
		r=1
	}
	
	if(cantidad_filas>1){
		TABLA.deleteRow(1);
	}
	
}


//FUNCION ORIGINAL, SOLO RECIBE UN PARAMETRO nunpartes
/*var nextinput = 0;
var elitinput = 0;

function AgregarCampos(nunpartes){
	
	
	//alert(nunpartes+"---"+nextinput+"---"+elitinput);
	
	/*nextinput++;
	campo = '<li id="rut'+nextinput+'">Campo:<input type="text" size="20" id="campo' + nextinput + '"&nbsp; name="campo' + nextinput + '"&nbsp; /></li>';
	$("#campos").append(campo);*/
	
	//$("#rut1").remove();
	
	//ELIMINO LA LISTA DONDE ESTA UBICADO EL CAMPO (input)
	//PARA QUE REFRESQUE LOS CAMPOS NECESARIOS, SEGUN NTIPO DE DOCUMENTO SELECCIONADO
	/*while (elitinput < 20) {
	
		//alert($("#parte" + elitinput).val());
		
		$("#rut" + elitinput).remove();
    	elitinput++;
		
	}
	//AGREGO NUMERO DE CAMPOS (input), SEGUN EL TIPO DE DOCUMENTO
	while (nextinput < nunpartes) {
		
    	campo = '<li id="rut'+nextinput+'">Parte:<input type="text" size="50" id="parte' + nextinput + '"&nbsp; name="parte' + nextinput + '"&nbsp; title="parte' + nextinput + '"&nbsp; class="required"/></li>';
		$("#campos").append(campo);
    	nextinput++;
		
	}
	
	//ASIGNO CUANTAS PARTES SE LE AGREGARON AL DOCUMENTO, PARA SER ENCIADAS Y GRABADAS EN LA BASE DE DATOS
	$("#partesdoc").val(nunpartes);
	
	//INICIALIZO LAS VARIABLES QUE ME INDICAN HASTA DONDE AGREGAR O ELIMINAR CAMPOS
	nextinput = 0;
	elitinput = 0;
	
}*/

// Reemplaza cadenaVieja por cadenaNueva en cadenaCompleta
function reemplazarCadena(cadenaVieja, cadenaNueva, cadenaCompleta) {


   for (var i = 0; i < cadenaCompleta.length; i++) {
      if (cadenaCompleta.substring(i, i + cadenaVieja.length) == cadenaVieja) {
         cadenaCompleta= cadenaCompleta.substring(0, i) + cadenaNueva + cadenaCompleta.substring(i + cadenaVieja.length, cadenaCompleta.length);
      }
   }
   return cadenaCompleta;
}

function Cargar_Pa_Modulo_Acciones(idaccion){
	
	//alert("A1 "+idaccion);
	
	$("#nunacciones").val('');
	$("#nunacciones").load('funciones/traer_datos_pa_modulos_acciones.php?idvalor='+idaccion);
	
	cadena = $("#nunacciones").val();
	
	//alert("CADENA: "+cadena);
	
	datosacciones = cadena.split("////");
	var longitud  = datosacciones.length;
		
	//arrayRapido   = "["+datosacciones+"]";
		
	arrayRapido = new Array(); 
		
	for (i=0; i<longitud; i++){ 
		
   		arrayRapido[i] = datosacciones[i];
	}
	
}

function Buscar_Vector(idclase){
	
	   //alert("A3 "+arrayRapido);
	   //alert(idclase)
	   
       var longitud  = arrayRapido.length;
	   var encontro	 = false;
	   
	   for (i=0; i<longitud; i++){ 
		
   			if(parseInt(arrayRapido[i]) == parseInt(idclase)){
				
				//alert("entre");
				encontro = true;
				i        = longitud;
			}
	   }
	   
	   //alert(encontro);
	   return encontro;
}

function trim(cadena){
	
       cadena=cadena.replace(/^\s+/,'').replace(/\s+$/,'');
       return(cadena);
}

function valor(idvalor){
	
       alert(idvalor);
}


