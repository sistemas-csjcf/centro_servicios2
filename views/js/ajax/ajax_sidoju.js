$(function(){
	//PARA GENERAR EL RADICADO
	$("#juzgadodestino").change(function(event){
		construir_radicado(1,1);
		var id    = $("#juzgadodestino").find(':selected').val();
		var idjuz = id.split("-");
		$("#claseproceso").load('funciones/traer_datos_lista.php?id='+idjuz[0]+"&idsql="+1);
    });
	$("#year").change(function(event){
			construir_radicado(0,0);
    });
	$("#consecutivo").change(function(event){
		construir_radicado(0,0);
    });
	$("#instancia").change(function(event){
			construir_radicado(0,0);
    });

	//PARA VALIDAR LOS CAMPOS DEL FORMULARIO
	var validator = $("#frm").validate({
		meta: "validate"
	});

	//PARA LIMPIAR LOS CAMPOS DEL FORMULARIO
	$(".btn_limpiar").click(function() {
		validator.resetForm();
	});

	//PARA LAS FECHAS
	$("#fechai").datepicker({ changeFirstDay: false	});
	$("#fechaf").datepicker({ changeFirstDay: false	});

	//CARGAR LISTAS SEGUN UN DATO ESPECIFICADO EN OTRA LISTA
	$("#juzgadodestino").change(function(event){
			var id_a    = $("#juzgadodestino").find(':selected').val();
			var id_b = id_a.split("//////");
			var id = id_b[0];
			$.get("funciones/traer_dato_usuario_juzgado.php?id="+id, function(datousuariojuzgado){
					//alert(datoconsecutivo);
					$("#nombreusuariojuzgado").val(datousuariojuzgado);
			});
    });

	//FILTRAR TABLA VERIFICAR DOCUMENTOS ENTRANTES JUZGADOS
	$('.filtrare').click(function(evento){
		if (document.getElementById('fechai').value.length         == 0 &&
			document.getElementById('fechaf').value.length         == 0 &&
			document.getElementById('juzgadodestino').value.length == 0){
			//ASIGNO VALOR DE 3 YA QUE EN LA VISTA sigdoc_listar_documentos_salientes.php
			//AL FINAL DE ESTA PREGUNTO POR if(!empty($opcion)), SI PONGO CERO (0) NO LO VALIDA
			//CON LA FUNCION empty()
			dato_0 = 3;
			location.href="index.php?controller=sidoju&action=RecargarTablaEntrantes&dato_0="+dato_0;
		} else {
			dato_0 = 1;
			dato_1 = document.getElementById('fechai').value;
			dato_2 = document.getElementById('fechaf').value;
			datox1 = document.getElementById('juzgadodestino').value;
			location.href="index.php?controller=sidoju&action=FiltroTablaEntrantes&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1;
		}

    });

	//FUNCION QUE ME PERMITE MARCAR TODOS LOS ELEMENTOS TIPO checkbox
	//las funciones marcar y desmarcar tambien funcionan
	$(".marcar").click(function(evento){
		$("input:checkbox").attr('checked', true);
	});
	$(".desmarcar").click(function(evento){
		$("input:checkbox").attr('checked', false);
	});

	// PARA RECORRER LA TABLA FILA POR FILA
	$(".aprobar").click(function(evento){
		//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
		//REGISTRO controlemcabezados = 0 (TITULO DE LA TABLA) Y controlemcabezados = 1 (ENCABEZADOS)
		var controlemcabezados = 0;
		var idspermiso="";
		var f = 2;
		var d7;

		$('#frm_editar1 tr').each(function () {
			var d0  = $(this).find("td").eq(0).html();
			d7      = $(this).find("td").eq(7).html();
			if(controlemcabezados == 0  || controlemcabezados == 1){
				controlemcabezados = controlemcabezados + 1;
			} else {
				if($("#chk"+f).is(':checked')) {
					//CONCATENO TODOS LOS REGISTROS DE LA TABLA
					idspermiso = d0+"******"+idspermiso;
				}
				f = f + 1;
			}
		});

		if(document.getElementById('juzgadodestinover').value.length == 0){
			alert("Definir Juzgado Destino");
			document.getElementById('juzgadodestinover').style.borderColor='#FF0000';
		} else {
				location.href="index.php?controller=sidoju&action=Registro_Vereficar_Documentos_Entrantes_Juzgados&idspermiso="+idspermiso+"&dj="+d7;
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
		if (document.getElementById('fechai').value.length         == 0 ||
			document.getElementById('fechaf').value.length         == 0 ||
			document.getElementById('juzgadodestino').value.length == 0 ||
			document.getElementById('horaji').value.length == 0 ||
			document.getElementById('horajf').value.length == 0) {
			alert("Definir Campos para Realizar la Impresion");
			document.getElementById('fechai').style.borderColor='#FF0000';
			document.getElementById('fechaf').style.borderColor='#FF0000';
			document.getElementById('juzgadodestino').style.borderColor='#FF0000';
			document.getElementById('horaji').style.borderColor='#FF0000';
			document.getElementById('horajf').style.borderColor='#FF0000';
		} else {
			dato_0 = document.getElementById('fechai').value;
			dato_1 = document.getElementById('fechaf').value;
			dato_2 = document.getElementById('juzgadodestino').value;
			dato_3 = document.getElementById('horaji').value;
			dato_4 = document.getElementById('horajf').value;
			dato_3b = Quitar_Cero_Hora(dato_3);
			dato_4b = Quitar_Cero_Hora(dato_4);

			//REALIZO ESTA PREGUNTA YA QUE SI NO SE DEFINE NINGUN RANGO DE HORA,SE ENVIA IGUAL
			//DATOS EN LAS VARABLES datox2, datox3 AFECTANDO EL FILTRO
			var datos = dato_0+"******"+dato_1+"******"+dato_2+"******"+dato_3b+"******"+dato_4b;
			//alert(datos);
			window.open("views/PHPPdf/Reporte_Aprobra_Documento_Entrantes_Juzgados?datos="+datos);
		}
	});

	//FILTRAR TABLA LISTAR DOCUMENTOS ENTRANTES JUZGADOS
	$('.filtrare2').click(function(evento){

		if (document.getElementById('fechai').value.length         == 0 &&
			document.getElementById('fechaf').value.length         == 0 &&
			document.getElementById('horaji').value.length         == 0 &&
			document.getElementById('horajf').value.length         == 0 &&
			document.getElementById('remitente').value.length      == 0 &&
			document.getElementById('tipodocumento').value.length  == 0 &&
			document.getElementById('numerodoce').value.length     == 0 &&
			document.getElementById('nfc').value.length            == 0 &&
			document.getElementById('juzgadodestino').value.length == 0 &&
			document.getElementById('usuariox').value.length       == 0 &&
			document.getElementById('estadox').value.length        == 0) {
			//ASIGNO VALOR DE 3 YA QUE EN LA VISTA sigdoc_listar_documentos_salientes.php AL FINAL DE ESTA PREGUNTO POR if(!empty($opcion)), SI PONGO CERO (0) NO LO VALIDA CON LA FUNCION empty()
			dato_0 = 3;
			location.href="index.php?controller=sidoju&action=RecargarListarTablaEntrantes&dato_0="+dato_0;
		} else {

			//Carga de loading
			if (document.getElementById("frm_editar1")){
					document.getElementById("frm_editar1").style.display = "none";
			}
			document.getElementById("loadContent").style.display = "block";
			$(".load").css("background-image", 'url(../centro_servicios2/assets/imagenes/loading.gif)');
			//Fin carga de loading

			dato_0 = 1;
			dato_1 = document.getElementById('fechai').value;
			dato_2 = document.getElementById('fechaf').value;
			datox1 = document.getElementById('juzgadodestino').value;
			dato_3 = document.getElementById('horaji').value;
			dato_4 = document.getElementById('horajf').value;
			//REALIZO ESTA PREGUNTA YA QUE SI NO SE DEFINE NINGUN RANGO DE HORA,SE ENVIA IGUAL
			//DATOS EN LAS VARABLES datox2, datox3 AFECTANDO EL FILTRO
			if (document.getElementById('horaji').value.length != 0 && document.getElementById('horajf').value.length  != 0 ){
				datox2 = Quitar_Cero_Hora(dato_3);
				datox3 = Quitar_Cero_Hora(dato_4);
			} else {
				datox2 = " ";
				datox3 = " ";
			}
			datox4 = document.getElementById('remitente').value;
			datox5 = document.getElementById('tipodocumento').value;
			datox6 = document.getElementById('numerodoce').value;
			datox7 = document.getElementById('nfc').value;
			datox9 = document.getElementById('usuariox').value
			datox10 = document.getElementById('estadox').value
			location.href="index.php?controller=sidoju&action=FiltroListarTablaEntrantes&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4+"&datox5="+datox5+"&datox6="+datox6+"&datox7="+datox7+"&datox9="+datox9+"&datox10="+datox10;
		}
    });

	//ME PERMITE CARGAR LOS DATOS AL FORMULARIO, SEGUN EL ID ESPECIFICADO
	$(".editare").click(function(){
		//CAPTURO EL ID DEL DOCUMENTO EL CUAL QUIERO EDITAR
		var id = $(this).attr('data-id');
		//ASIGNO EL VALOR ID A UN INPUT OCULTO EN EL FORMULARIO,PARA PODER SER ACTUALIZADO EL DOCUMENTO EN LA BASE DE DATOS
		$("#iddocumento").val(id);
		location.href="index.php?controller=sidoju&action=Editar_documento_Entrante_Juzgado&id="+id;
	});

	//FILTRAR TABLA IMPRIMIR DOCUMENTOS ENTRANTES JUZGADOS
	$('.filtrare3').click(function(evento){

		//Carga de LOAD
		if (document.getElementById("frm_editar1")){
			$("#frm_editar1").css({display: "none"});
		}
		document.getElementById("loadContent").style.display = "block";
		$(".load").css("background-image", 'url(../centro_servicios2/assets/imagenes/loading.gif)');

		if (document.getElementById('fechai').value.length         == 0 &&
			document.getElementById('fechaf').value.length         == 0 &&
			document.getElementById('juzgadodestinoin').value.length == 0
			) {
			//ASIGNO VALOR DE 3 YA QUE EN LA VISTA sigdoc_listar_documentos_salientes.php
			//AL FINAL DE ESTA PREGUNTO POR if(!empty($opcion)), SI PONGO CERO (0) NO LO VALIDA
			//CON LA FUNCION empty()
			dato_0 = 3;
			location.href="index.php?controller=sidoju&action=RecargarTablaImprimirDocumentos&dato_0="+dato_0;
		} else {
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
		//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
		//REGISTRO controlemcabezados = 0 (TITULO DE LA TABLA) Y controlemcabezados = 1 (ENCABEZADOS)
		var controlemcabezados = 0;
		var idspermiso="";
		var f = 2;
		$('#frm_editar1 tr').each(function () {
			var d0  = $(this).find("td").eq(0).html();
			if(controlemcabezados == 0  || controlemcabezados == 1){
				controlemcabezados = controlemcabezados + 1;
			} else {
				if($("#chkk"+f).is(':checked')) {
					//CONCATENO TODOS LOS REGISTROS DE LA TABLA CON ,
					//PARA USAR LA FUNCION IN DE MYSQL IN(1,2,3)
					idspermiso = d0+","+idspermiso;
				}
				f = f + 1;
			}
		});

		if(document.getElementById('juzgadodestinoin').value.length == 0){
			alert("Definir Juzgado");
			document.getElementById('juzgadodestinoin').style.borderColor='#FF0000';
		} else {
			if(idspermiso == ""){
				alert("No a Selecionado Ningun Registro de la Tabla1");
			} else {
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
    });

	// PARA IMPRIMIR UN BLOQUE DE REGISTROS RELACIONADOS CON UN NOMBRE DE BLOQUE
	$(".imprimirbloque").click(function(evento){
		if(document.getElementById('juzgadodestinoin').value.length == 0 || document.getElementById('listabloques').value.length == 0){
			alert("Definir Juzgado Destino y Bloque");
			document.getElementById('juzgadodestinoin').style.borderColor='#FF0000';
			document.getElementById('listabloques').style.borderColor='#FF0000';
		} else {
			var nombrebloque = document.getElementById('listabloques').value;
			window.open("views/PHPPdf/Reporte_ADEJ_Bloque?datos="+nombrebloque);
		}
	});



	//PARA INCIDENTE DESACATO EN SALUD
	//ADICIONADO POR INGENIERO JORGE ANDRES VALENCIA 22 DE ENERO 2020
	$(".migrar_tutela").click(function(){

		//var idradicado = $(this).attr('data-idtutela');

		var idradicado = $("#radisalud").val();

		$.get("funciones/traer_datos_radicado_IDS_2.php?idradicado="+idradicado, function(cadena){


				//alert(cadena);

				var datos = cadena.split("//////");

				if(cadena == 0){


					alert("NO EXISTEN DATOS EN JUSTICIA XXI, NO ES POSIBLE MIGRAR TUTELA");

				}
				if(cadena == 1){

					alert("NO SE PUEDE CONECTAR A LA BASE DE DATOS DE JUSTICIA XXI");

					//location.href="index.php?controller=sidoju&action=Registro_Documentos_Entrantes_Juzgados";

				}

				if(cadena == 2){

					alert("ERROR EN CARGA DE DATOS, REVISAR CONSULTA $SQL");

					//location.href="index.php?controller=sidoju&action=Registro_Documentos_Entrantes_Juzgados";

				}

				//SE REALIZA OPERACION DE MIGRACION
				if(cadena != 0 && cadena != 1 && cadena != 2){

					//alert(cadena);

					location.href="index.php?controller=sidoju&action=Migrar_Tutela&datospartesXX="+cadena+"&valorradicado="+idradicado;

				}


		} );



	} );



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
	var path = url;
	var result = path.match(/[-_\w]+[.][\w]+$/i)[0];
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
	} else {
		horareal = trim(datohora[0]+":"+datohora[1]);
	}
	return horareal;
}

function Obtener_Formato_Hora(hora) {
	datohora = hora.split(":");
	horareal = 0;
	tipohora = "AM";
	//DOCE DEL MEDIO DIA
	if(datohora[0] == 12){
		horareal =  12;
		tipohora = "PM";
		horareal = horareal+":"+datohora[1]+":"+"00"+" "+tipohora;
	}
	//HORA MILITAR
	if(datohora[0] >= 13 && datohora[0] <= 23) {
		horareal = parseInt(datohora[0]) - 12;//FORMULA QUE ME PERMITE OBTENER DE HORA MILITAR A HORA NORNAL EJ: 13 --> 13 - 12 = 1
		tipohora = "PM";
		horareal = horareal+":"+datohora[1]+":"+"00"+" "+tipohora;
	} //HORA DESDE LA 1 AM - 11 AM
	else {
		horareal = parseInt(datohora[0]);
		horareal = horareal+":"+datohora[1]+":"+"00"+" "+tipohora;
	}
	return horareal;
}

function trim(cadena){
    cadena=cadena.replace(/^\s+/,'').replace(/\s+$/,'');
    return(cadena);
}

function valor(idvalor){
    alert(idvalor);
}


/*Construir radicado en registro de incidente*/
function construir_radicado(idaccion,frmjuzgado){
	if(frmjuzgado == 1){
		var id = $("#juzgadodestino").find(':selected').val();
		var area_vector    = id.split("-");
		var area_nueva     = area_vector[1];
		var numero_juzgado = area_vector[2];
	}
	/*if(frmjuzgado == 2){
		var id = $("#juzgadoorigenmodificar").find(':selected').val();
		var area_vector    = id.split("-");
		var area_nueva     = area_vector[1];
		var numero_juzgado = area_vector[2];
	}*/
	var year        = $("#year").val();
	var consecutivo = $("#consecutivo").val();
	var instancia   = $("#instancia").val();
	var relleno = "";
	if(numero_juzgado > 9){
		relleno = "0";
	} else {
		relleno = "00";
	}
	//CIRCUITO 3103
	if(area_nueva == 1){
		var area = "170013103";
	}
	//FAMILIA 3110
	if(area_nueva == 2){
		var area = "170013110";
	}
	//MUNICIPAL 4003
	if(area_nueva == 3){
		var area = "170014003";
	}
	var radicadocompleto = "";
	radicadocompleto     = area+relleno+numero_juzgado+year+"00"+consecutivo+instancia;
	$("#txt_radicado").val(radicadocompleto);
	//VALIDO QUE EL RADICADO YA EXISTA O NO, PARA NO PERMITIR DE NUEVO SU REGISTRO
	//Traer_Dato_Radicado(radicadocompleto,idaccion);
}


function Existe_Radicado(valorradi){



		$.get("funciones/traer_datos_radicado_IDS.php?valorradi="+valorradi, function(cadena){

			//alert(cadena);

			var vector_datos_C = cadena.split("*****");

			var vector_datos = vector_datos_C[0].split("//////");

			//alert(vector_datos.length);
			//alert(vector_datos);

			if(vector_datos.length == 6){

				$("#idradisalud").val('');
				$("#idradisalud").val(vector_datos[0]);
				//$("#nombrereg").attr('disabled',true);

				document.getElementById('idradisalud').style.borderColor = '#000000';

				$('#fila_botones').show();


					//TABLA PARTES
					//var vector_estudios = vector_datos_total[1].split("*/-*/-");

					var longi           = vector_datos_C.length - 1;

					Eliminar_Tabla_Partes();

					for (i = 0; i < longi; i++) {

					  	vector_estudios_2 = vector_datos_C[i].split("//////");

						dato2_es = vector_estudios_2[2];
						dato3_es = vector_estudios_2[3];
						dato4_es = vector_estudios_2[4];
						dato5_es = vector_estudios_2[5];

					 	var tabla=document.getElementById('cont_es').innerHTML;

						tabla = reemplazarCadena("</table>", " ", tabla);

						tabla+='<tr>';

						tabla+='<td>'+dato2_es+'</td>';

						tabla+='<td>'+dato3_es+'</td>';

						tabla+='<td>'+dato4_es+'</td>';

						tabla+='<td>'+dato5_es+'</td>';


						tabla+='</tr></table>';

						document.getElementById('cont_es').innerHTML=tabla;


					}



			}
			else{

				if(cadena == 0){

					//alert('RADICADO NO EXISTE, EN BASE DE DATOS LOCAL, NI EN JUSTICIA XXI');

					$("#idradisalud").val('RADICADO NO EXISTE, EN BASE DE DATOS LOCAL, NI EN JUSTICIA XXI');

					//$("#idradisalud").val('RADICADO NO EXISTE');
					//$("#radisalud").val('17001');
					//$("#nombrereg").attr('disabled',false);

					document.getElementById('idradisalud').style.borderColor = '#FF0000';

					$('#fila_botones').hide();

					$('#fila_archivo_2').hide();

					Eliminar_Tabla_Partes();

				}
				if(cadena == 1){

					//alert('NO se puede conectar a la Base de Datos JUSTICIA XXI');

					$("#idradisalud").val('NO se puede conectar a la Base de Datos JUSTICIA XXI');

					document.getElementById('idradisalud').style.borderColor = '#FF0000';

					$('#fila_botones').hide();

					$('#fila_archivo_2').hide();

					Eliminar_Tabla_Partes();

				}
				//RADICADO EXISTE EN JUSTICIA XXI
				if(cadena != 0 && cadena != 1){

					//alert('RADICADO EXISTE EN JUSTICIA XXI, DESEA MIGRAR LA INFORMACION');

					$("#idradisalud").val('RADICADO EXISTE EN JUSTICIA XXI');

					$('#fila_archivo_2').show();

					document.getElementById('idradisalud').style.borderColor = '#000000';

				}


				/*$("#idradisalud").val('RADICADO NO EXISTE');
				//$("#radisalud").val('17001');
				//$("#nombrereg").attr('disabled',false);

				document.getElementById('idradisalud').style.borderColor = '#FF0000';

				$('#fila_botones').hide();

				Eliminar_Tabla_Partes();*/



			}


		});



}

function Eliminar_Tabla_Partes(){

	var r;
	var cantidad_filas;
	var TABLA = document.getElementById('t_es');

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

// Reemplaza cadenaVieja por cadenaNueva en cadenaCompleta
function reemplazarCadena(cadenaVieja, cadenaNueva, cadenaCompleta) {


   for (var i = 0; i < cadenaCompleta.length; i++) {
      if (cadenaCompleta.substring(i, i + cadenaVieja.length) == cadenaVieja) {
         cadenaCompleta= cadenaCompleta.substring(0, i) + cadenaNueva + cadenaCompleta.substring(i + cadenaVieja.length, cadenaCompleta.length);
      }
   }
   return cadenaCompleta;
}
