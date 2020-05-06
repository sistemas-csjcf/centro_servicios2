$(function(){
	
	//PARA VALIDAR LOS CAMPOS DEL FORMULARIO
	var validator = $("#frm").validate({
		meta: "validate"
	});
	
	//ME PERMITE VALIDAR QUE SE A ESCOGIDO ALGUN ARANCEL DE LA TABLA PARA SU LIQUIDACION
	$(".btn_validar").click(function() {
		
		//alert(1);
		ta = $("#totalaranceles").val();
				
		if(ta == 0 || ta == "NaN"){
			alert("No es Posible Realizar el Registro, El Total de los Aranceles no Puede ser Cero (0)");
			$("#radicado").val('');
			
			return false;
		}
			
	});		
		
	//PARA LIMPIAR LOS CAMPOS DEL FORMULARIO
	$(".btn_limpiar").click(function() {
		validator.resetForm();
	});	
	
	//PARA LAS FECHAS
	//$("#fechal").datepicker({ changeFirstDay: false	});
	$("#fechai").datepicker({ changeFirstDay: false	});
	$("#fechaf").datepicker({ changeFirstDay: false	});
	
	
	//CUANDO SE DIGITA UN RADICADO
	$("#radicado").change(function(event){
		
		var idradicado = $("#radicado2").val()+""+$("#radicado").val();
		
		//alert(idradicado);
		
		
		$.get("funciones/traer_datos_radicado.php?idradicado="+idradicado, function(datosradicado){
				
					//alert(datosradicado);
					
					datosid = datosradicado.split("//////");
					//$("#idr").val(datosid[0]);
					$("#cedula_demandante").val(datosid[1]);
					$("#demandante").val(datosid[2]);
					$("#cedula_demandado").val(datosid[3]);
					$("#demandado").val(datosid[4]);
					//$("#claseproceso").val(datosid[5]);
					//$("#jo").val(datosid[6]);
					//$("#jd").val(datosid[7]);
					
					//ASIGO EL VALOR DEL CONTADOR ACTUAL SEGUN EL TIPO DE DOCUMENTO Y
					//PODER ACTUALIZARLO EN LA TABLA sigdoc_pa_consecutivo
					/*var consecutivo = datoconsecutivo.split("-");
					consecutivo		= parseInt(consecutivo[1]);
					//alert(consecutivo);
																		 
					$("#consecutivodocumento").val(consecutivo);*/
			
		});
	 
	});
	
	
	/*$("#chkk2").click(function(evento){
		alert(1);
	});*/
	
	$(".calcular").click(function(){
								

		//CAPTURO EL ID DEL DOCUMENTO EL CUAL QUIERO EDITAR
		var id      = $(this).attr('data-id');
		var valor   = $(this).attr('data-valor');
		
		//SE OBTIENE EL NOMBRE DEL CAMPO PAGINA Y MAS ABAJO EL VALOR ESCRITO EN ESE CAMPO
		var paginas = $(this).attr('data-paginas');
		//SE DEJA EL CAMPO PAGINAS READONLY EN CIERTOS INTERVALOS PARA SU VALIDACION AL REGISTRAR LA LIQUIDACION
		$("#"+paginas).attr('readonly', true);
		
		var subt    = $(this).attr('data-subtotal');
		var chk     = $(this).attr('data-chk');
		
		var subtotal = 0;
		var subtotaldesglose = 0;
		//var total    = 0;
		
		
		//alert(id+"---------"+valor+"---------"+paginas+"---------"+chk);
		
		if($("#"+chk).is(':checked')) {
			
			if($("#"+paginas).val() != ''){
				
				if(id != 8){//SE PREGUNTA QUE NO SE DIO CLIC EN EL ITEM DESGLOSE
					
					paginas  = $("#"+paginas).val()
					subtotal = parseInt(valor) * parseInt(paginas);
				
					$("#"+subt).val(subtotal);
					
					//-----SE CALCULA EL SUBTOTAL DEL DESGLOSE-----
					subtotaldesglose = calcular_desglose();
					$("#subtotal9").val(subtotaldesglose);
					//---------------------------------------------
				
				}
				else{//SI SE SELECCIONA EL ITEM DESGLOSE, SE SUMAN LAS (CERTIFICACIONES + COPIAS SIMPLES + AUTENTICACIONES)
					
					subtotaldesglose = calcular_desglose();
					$("#"+subt).val(subtotaldesglose);
				}
				
				
				//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
				//REGISTRO controlemcabezados = 0 (TITULO DE LA TABLA) Y controlemcabezados = 1 (ENCABEZADOS)
				var controlemcabezados = 0;
				
				//SUMAR SUBTOTALES
				var f = 2;
		
				var c4 = 0;
				var total    = 0;
			
				$('#frm_editar1 tr').each(function () {
		
					//var d0  = $(this).find("td").eq(0).html();
					c4 = $("#subtotal"+f).val();
					
					//alert(c4);
					
					if(controlemcabezados == 0  || controlemcabezados == 1){
						controlemcabezados = controlemcabezados + 1;
					}
					else{
						
						controlemcabezados = controlemcabezados + 1;
						
						//CONTROLA PARA QUE NO TOME LA ULTIMA FILA DE LA TABLA DONDE ESTA EL TOTAL
						//Y NO ME DE UN RESULTADO NAN ---> NULL
						if(controlemcabezados != 15){
							
							//if($("#chk"+f).is(':checked')) {  
							
								//CALCULAMOS TODOS LOS REGISTROS DE LA COLUMNA SUBTOTAL DE LA TABLA
								//alert(total+"-----"+c4);
								total    = parseInt(total) + parseInt(c4);
								//alert(total);
							//}
							
							f = f + 1;
						
						}
						
						
					}
			
			
				});
				
				//alert(total);
				$("#totalaranceles").val(total);
				
	
			}
			else{
				alert("Definir Paginas");
				document.getElementById(paginas).style.borderColor='#FF0000';
					
				$("#"+chk).attr('checked', false);
				$("#"+paginas).attr('readonly', false);
			}
					  
		}
		else{
			
			$("#"+paginas).attr('readonly', false);
			$("#"+paginas).val('');
			$("#"+subt).val('0');
			document.getElementById(paginas).style.borderColor='#000000';
			
			//SE DETERMINA QUE VALORES SON ESTATICOS EN LOS ITEM DE LOS ARANCELES
			//EN ESTE CASO LAS PAGINAS DE EL ITEM DESGLOSES
			Valores_Estaticos();
			

			//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO controlemcabezados = 0 (TITULO DE LA TABLA) Y controlemcabezados = 1 (ENCABEZADOS)
			var controlemcabezados = 0;
				
			//SUMAR SUBTOTALES
			var f = 2;
		
			var c4    = 0;
			var total = 0;
			
			
			//-----SE CALCULA EL SUBTOTAL DEL DESGLOSE-----
			subtotaldesglose = calcular_desglose();
			$("#subtotal9").val(subtotaldesglose);
			//---------------------------------------------

			$('#frm_editar1 tr').each(function () {
		
				//var d0  = $(this).find("td").eq(0).html();
				c4 = $("#subtotal"+f).val();
					
				//alert(c4);
					
				if(controlemcabezados == 0  || controlemcabezados == 1){
					controlemcabezados = controlemcabezados + 1;
				}
				else{
						
					controlemcabezados = controlemcabezados + 1;
						
					if(controlemcabezados != 15){
					//if($("#chk"+f).is(':checked')) {  
						
						//CALCULAMOS TODOS LOS REGISTROS DE LA COLUMNA SUBTOTAL DE LA TABLA
						//alert(total+"-----"+c4);
						total    = parseInt(total) + parseInt(c4);
						//alert(total);
					//}
						
					f = f + 1;
						
					}
						
						
				}
			
			
			});
			
			
			
			//alert(total);
			$("#totalaranceles").val(total);
	
		}
		
		
	});
	
	
	
	//FILTRAR TABLA IMPRIMIR LIQUIDACIONES
	$('.filtrare3').click(function(evento){
	
		//alert(1);
		
		
		if (
			document.getElementById('radicado3').value.length      == 0 &&
			document.getElementById('fechai').value.length        == 0 &&
			document.getElementById('fechaf').value.length        == 0 &&
			document.getElementById('juzgadoorigen').value.length == 0
			){
			
	
			//ASIGNO VALOR DE 3 YA QUE EN LA VISTA sigdoc_listar_documentos_salientes.php
			//AL FINAL DE ESTA PREGUNTO POR if(!empty($opcion)), SI PONGO CERO (0) NO LO VALIDA
			//CON LA FUNCION empty()
			dato_0 = 3;
			
			location.href="index.php?controller=aranceljudicial&action=RecargarTablaImprimirLiquidaciones&dato_0="+dato_0;
       	
		}
		else{
			
			dato_0 = 1;
			dato_1 = document.getElementById('fechai').value;
			dato_2 = document.getElementById('fechaf').value;
			
			datox1 = document.getElementById('juzgadoorigen').value;
			datox2 = document.getElementById('radicado3').value;
			
			location.href="index.php?controller=aranceljudicial&action=FiltroTablaImprimirLiquidaciones&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2;
	
		}
	
    });
	
	// PARA IMPRIMIR UN BLOQUE DE REGISTROS RELACIONADOS CON UN NOMBRE DE BLOQUE
	$(".imprimirliquidacion").click(function(evento){
		
		var idl  = $(this).attr('data-id');
		var numl = $(this).attr('data-numl');
		
		//alert("Imprimiendo... "+idl+"------"+numl);
		
		
		var datos = idl+"******"+numl; 
			
		window.open("views/PHPPdf/Reporte_Liquidacion_Arancel?datos="+datos);
		

	});
	
	// PARA APROBAR UNA LIQUIDACION
	$(".aprobarliquidacion").click(function(evento){
		
		var idl  = $(this).attr('data-id');
		//var numl = $(this).attr('data-numl');
		
		//alert("Aprobando... "+idl+"------"+numl);
	
		//var datos = idl+"******"+numl; 
		
		location.href="index.php?controller=aranceljudicial&action=AprobarLiquidacion&idl="+idl;
			
		

	});
	
	// PARA ANULAR UNA LIQUIDACION
	$(".anularliquidacion").click(function(evento){
		
		var idl  = $(this).attr('data-id');
		
		if (confirm ("Esta Seguro de ANULAR LA LIQUIDACION")) {
		
        	location.href="index.php?controller=aranceljudicial&action=AnularLiquidacion&idl="+idl;
    	} 
		else{return false;}					
		
		
			
		

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


function calcular_desglose(){
	
	var subtotalD = 0;
	
	if($("#chkk9").is(':checked')) {
		
		if( $("#subtotal2").val() == 0 && $("#subtotal7").val() == 0 && $("#subtotal8").val() == 0 ){
			
			alert("Para realizar el Calculo del Desglose debe estar Definido Por lo menos uno de los Items Siguientes (Certificaciones, Copias Simples y Autenticacion de las Copias)");
			document.getElementById("pagina2").style.borderColor='#FF0000';
			document.getElementById("pagina7").style.borderColor='#FF0000';
			document.getElementById("pagina8").style.borderColor='#FF0000';
			
			$("#chkk9").attr('checked', false);
			
			$("#pagina9").val(1);
		}
		else{
		
			subtotalD = parseInt( $("#subtotal2").val() ) +  parseInt( $("#subtotal7").val() ) +  parseInt( $("#subtotal8").val() );	
		}
	}
	else{
		subtotalD = 0;
	}
	
	
	return(subtotalD);
}

function Valores_Estaticos(){
	
	$("#pagina9").attr('readonly', true);
	$("#pagina9").val(1);
}

function Solo_Numeros(e){
	
	var key = window.Event ? e.which : e.keyCode
	return (key >= 48 && key <= 57)
}
function trim(cadena){
	
       cadena=cadena.replace(/^\s+/,'').replace(/\s+$/,'');
       return(cadena);
}

function valor(idvalor){
	
       alert(idvalor);
}

/*7.3.1. Validar un campo de texto obligatorio
Se trata de forzar al usuario a introducir un valor en un cuadro de texto o textarea en los que sea obligatorio. La condición en JavaScript se puede indicar como:

valor = document.getElementById("campo").value;
if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
  return false;
}
Para que se de por completado un campo de texto obligatorio, se comprueba que el valor introducido sea válido, que el número de caracteres introducido sea mayor que cero y que no se hayan introducido sólo espacios en blanco.

La palabra reservada null es un valor especial que se utiliza para indicar "ningún valor". Si el valor de una variable es null, la variable no contiene ningún valor de tipo objeto, array, numérico, cadena de texto o booleano.

La segunda parte de la condición obliga a que el texto introducido tenga una longitud superior a cero caracteres, esto es, que no sea un texto vacío.

Por último, la tercera parte de la condición (/^\s+$/.test(valor)) obliga a que el valor introducido por el usuario no sólo esté formado por espacios en blanco. Esta comprobación se basa en el uso de "expresiones regulares", un recurso habitual en cualquier lenguaje de programación pero que por su gran complejidad no se van a estudiar. Por lo tanto, sólo es necesario copiar literalmente esta condición, poniendo especial cuidado en no modificar ningún carácter de la expresión.*/


