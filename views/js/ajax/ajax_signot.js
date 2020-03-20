var datosacciones;
var arrayRapido;
var contador = 0;

$(function(){
	
	//PARA VALIDAR LOS CAMPOS DEL FORMULARIO
	/*var validator = $("#frm").validate({
		meta: "validate"
	});*/

	
	//--------------------------------------------PARA REGISTRAR PARTES AL PROCESO------------------------------------------------------------
	
	
	//ME PERMITE VALIDAR QUE SE ASIGNO ALGUNA PARTE AL PROCESO
	$(".btn_validar").click(function() {
		var cantidad_filas_2;
	    var TABLA_2      = document.getElementById('tmodi2');
		cantidad_filas_2 = TABLA_2.rows.length;
		//alert("Filas Tabla: "+cantidad_filas_2+"Datos Partes: "+datospartes);
		if(cantidad_filas_2 > 1){
			//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO
			var controlemcabezados = 0;
			var datospartes="";
			$('#tmodi2 tr').each(function () {
				var d0  = $(this).find("td").eq(0).html();
				var d1  = $(this).find("td").eq(1).html();
				var d2  = $(this).find("td").eq(2).html();
				var d3  = $(this).find("td").eq(3).html();
				var d4  = $(this).find("td").eq(4).html();
				var d5  = $(this).find("td").eq(5).html();
				var d6  = $(this).find("td").eq(6).html();
                var d7  = $(this).find("td").eq(7).html();
                var d8  = $(this).find("td").eq(8).html();
                var d9  = $(this).find("td").eq(9).html();
				//alert(d0+"//////"+d1+"//////"+d2+"//////"+d3+"//////"+d4+"//////"+d5+"//////"+d6;
				if(controlemcabezados == 0){
					controlemcabezados = controlemcabezados + 1;
				}
				else{
					//CONCATENO TODOS LOS REGISTROS DE LA TABLA
					datospartes = datospartes+"******"+d0+"//////"+d1+"//////"+d2+"//////"+d3+"//////"+d4+"//////"+d5+"//////"+d6+"//////"+d7+"//////"+d8+"//////"+d9;
					//ASIGNO AL CAMPO OCULTO datospartes LA INFORMACION DE LA TABLA
					$("#datospartes").val('');
					$("#datospartes").val(datospartes);
				}
			});
			//alert("Filas Tabla: "+cantidad_filas_2+"Datos Partes: "+datospartes);
		}
		/*else{
			alert("No es Posible Realizar el Registro, no se Cuenta con Informacion en la Tabla de las Partes del Proceso...");
			return false;
		}*/
	});
	$("#frm").validate({			   
        rules: {
			//ejemplo con campo cedula
			//cedula: { required: true, minlength: 2},
		   /*lastname: { required: true, minlength: 2},
            email: { required:true, email: true},
            phone: { minlength: 2, maxlength: 15},
            years: { required: true},
            message: { required:true, minlength: 2}*/
        },
        messages: {
		   //ejemplo con campo cedula
		   //cedula: "Defina Cedula",
		   /*lastname: "Debe introducir su apellido.",
            email : "Debe introducir un email válido.",
            phone : "El número de teléfono introducido no es correcto.",
            years : "Debe introducir solo números.",
            message : "El campo Mensaje es obligatorio.",*/
        },
        submitHandler: function(form){
			//MODIFICAR PROCESO, INGRESAR O REGISTRAR
			var dataString = 'radicadox='+$('#radicadox').val()+'&datospartes='+$('#datospartes').val()+'&juzgadoorigen='+$('#juzgadoorigen').val()+'&claseproceso='+$('#claseproceso').val()+'&claseproceso2='+$('#claseproceso2').val()+'&entidadcomisiona='+$('#entidadcomisiona').val()+'&asunto='+$('#asunto').val()+'&despacholibra='+$('#despacholibra').val();
			var url1       = "index.php?controller=signot&action=Registro_Proceso_Unico";
			//var dataString = 'radicadox='+radicadox+'&juzgadoorigen='+juzgadoorigen+'&idclasejuzgado='+idclasejuzgado+'&idclaseproceso='+idclaseproceso+'&iddepartamento='+iddepartamento+'&idmunicipio='+idmunicipio+'&datospartes='+$('#datospartes').val();
			//**********************************************************************************************************
			//alert(dataString);
            $.ajax({
                type: "POST",
                //url:"send.php",
				//url:"index.php?controller=signot&action=Registro_Proceso",
				url:url1,
                data: dataString,
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
	
	//----------------------------------------------------------------------------------------------------------------------------------------
	
	
	
	
	
	//--------------------------------------------PARA ADICIONAR PARTES AL PROCESO------------------------------------------------------------
	
	
	//ME PERMITE VALIDAR QUE SE ASIGNO ALGUNA PARTE AL PROCESO
	$(".btn_validarmodi").click(function() {
		
		var cantidad_filas_2;
	    var TABLA_2      = document.getElementById('tmodi');
		cantidad_filas_2 = TABLA_2.rows.length;
		
		//alert("Filas Tabla: "+cantidad_filas_2+"Datos Partes: "+datospartes);
		
		if(cantidad_filas_2 > 1){
			
			//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO
			var controlemcabezados = 0;
			
			var datospartes="";
		
			$('#tmodi tr').each(function () {
	
				var d0  = $(this).find("td").eq(0).html();
				var d1  = $(this).find("td").eq(1).html();
				var d2  = $(this).find("td").eq(2).html();
				var d3  = $(this).find("td").eq(3).html();
				var d4  = $(this).find("td").eq(4).html();
				var d5  = $(this).find("td").eq(5).html();
				var d6  = $(this).find("td").eq(6).html();
				var d7  = $(this).find("td").eq(7).html();
				var d8  = $(this).find("td").eq(8).html();
				var d9  = $(this).find("td").eq(9).html();
				alert(d0+"//////"+d1+"//////"+d2+"//////"+d3+"//////"+d4+"//////"+d5+"//////"+d6);
				
				if(controlemcabezados == 0){
					controlemcabezados = controlemcabezados + 1;
				}
				else{
					
					//CONCATENO TODOS LOS REGISTROS DE LA TABLA
					datospartes = datospartes+"******"+d0+"//////"+d1+"//////"+d2+"//////"+d3+"//////"+d4+"//////"+d5+"//////"+d6+"//////"+d7+"//////"+d8+"//////"+d9;
					
					//ASIGNO AL CAMPO OCULTO datospartes LA INFORMACION DE LA TABLA
					$("#datospartes").val('');
					$("#datospartes").val(datospartes);
					
	
				}
		
			});
				
			//alert("Filas Tabla: "+cantidad_filas_2+"Datos Partes: "+datospartes);
			
			
			
		}
		else{
			alert("No es Posible Realizar el Registro, no se Cuenta con Informacion en la Tabla de las Partes del Proceso...");
			return false;
		}
		
	});	
			
			
	$("#frmmodi").validate({
					   
        rules: {
            
			//ejemplo con campo cedula
			//cedula: { required: true, minlength: 2},
           
		   /*lastname: { required: true, minlength: 2},
            email: { required:true, email: true},
            phone: { minlength: 2, maxlength: 15},
            years: { required: true},
            message: { required:true, minlength: 2}*/
        },
        messages: {
           
		   //ejemplo con campo cedula
		   //cedula: "Defina Cedula",
           
		   /*lastname: "Debe introducir su apellido.",
            email : "Debe introducir un email válido.",
            phone : "El número de teléfono introducido no es correcto.",
            years : "Debe introducir solo números.",
            message : "El campo Mensaje es obligatorio.",*/
        },
        submitHandler: function(form){
			//MODIFICAR PROCESO
			
				
			var dataString = 'idradicado='+$('#idradicado').val()+'&datospartes='+$('#datospartes').val();
			var url1       = "index.php?controller=signot&action=Modificar_Proceso_Partes";
			
			
			//var dataString = 'radicadox='+radicadox+'&juzgadoorigen='+juzgadoorigen+'&idclasejuzgado='+idclasejuzgado+'&idclaseproceso='+idclaseproceso+'&iddepartamento='+iddepartamento+'&idmunicipio='+idmunicipio+'&datospartes='+$('#datospartes').val();
			
			//**********************************************************************************************************
			
			//alert(dataString);
			
            $.ajax({
                type: "POST",
                //url:"send.php",
				//url:"index.php?controller=signot&action=Registro_Proceso",
				url:url1,
                data: dataString,
                success: function(data){
					
					//NOTA: ES IMPORTANTE DEFINIR ESTE OK EN LA VISTA QUE SE ESTA VALIDANDO, YA QUE AL DAR REGISTRAR
					//EL SISTEMA REGISTRA PERO NO MUESTRA QUE LA TRANSACCION FUE BIEN O NO.
                    //$("#ok").html(data);
                    //$("#ok").show();
					
					
					
					Adicionar_Dato_Radicado( $('#radicadox2').val() );
					
					Eliminar_TablaMODI();
			
					Limpiar_CamposMODI();
					
					$("#filapartes").hide();
					$("#filapartes2").hide();
					
					alert("El registro ha sido ingresado correctamente");
					
					contador = 0;
					
                    //$("#frmmodi").hide();
                }
            });
		
			
        }
    });
	
	//----------------------------------------------------------------------------------------------------------------------------------------
	
	
	
	//--------------------------------------------PARA ADICIONAR ANOTACION AL PROCESO------------------------------------------------------------
	
	
	//ME PERMITE VALIDAR QUE SE ASIGNO ALGUNA PARTE AL PROCESO
	$(".btn_validaranotacion").click(function() {
		//alert("validar");
		d1A = $("#destipoanotacion").val();
		d1B = $("#parteproceso").val();
		d1C = $("#anotacion").val();
		if( (d1A == null || d1A.length == 0 || /^\s+$/.test(d1A)) || 
			(d1B == null || d1B.length == 0 || /^\s+$/.test(d1B)) || 
			(d1C == null || d1C.length == 0 || /^\s+$/.test(d1C))) {
			alert("Definir Tipo Anotacion, Parte del Proceso y Anotacion");	
		}
	});
	$("#frmanotacion").validate({	   
        rules: {
			//ejemplo con campo cedula
			//cedula: { required: true, minlength: 2},
           
		   /*lastname: { required: true, minlength: 2},
            email: { required:true, email: true},
            phone: { minlength: 2, maxlength: 15},
            years: { required: true},
            message: { required:true, minlength: 2}*/
        },
        messages: {
           
		   //ejemplo con campo cedula
		   //cedula: "Defina Cedula",
           
		   /*lastname: "Debe introducir su apellido.",
            email : "Debe introducir un email válido.",
            phone : "El número de teléfono introducido no es correcto.",
            years : "Debe introducir solo números.",
            message : "El campo Mensaje es obligatorio.",*/
        },
        submitHandler: function(form){
			var dataString = 'idproceso='+$('#idproceso').val()+'&destipoanotacion='+$('#destipoanotacion').val()+'&anotacion='+$('#anotacion').val()+'&parteproceso='+$('#parteproceso').val()+'&fecha_interrogatorio='+$('#fecha_interrogatorio').val();
			var url1       = "index.php?controller=signot&action=Editar_Proceso_Anotacion";
			//**********************************************************************************************************
			//alert(dataString);
            $.ajax({
                type: "POST",
				url:url1,
                data: dataString,
				//data: $(form).serialize(),
                //dataType : 'json',
                success: function(data){
					//longitudcadena = data.length;
					cadenadatos = data.split("**********");
					//alert(cadenadatos[1]);
					if (cadenadatos[1] == 'ANOTACION CORRECTA') {
            			alert("LA ANOTACION HA SIDO INGRESADA CORRECTAMENTE");
						location.href="index.php?controller=signot&action=Editar_Proceso_Anotacion&id="+$('#idproceso').val();                      
					} 
					if (cadenadatos[1] == 'ERROR ANOTACION') {
						alert("ERROR AL INGRESO DE LA ANOTACION");
						location.href="index.php?controller=signot&action=Editar_Proceso_Anotacion&id="+$('#idproceso').val();
					}
                }
            });
        }
    });
	
	//----------------------------------------------------------------------------------------------------------------------------------------
	

	//PARA LIMPIAR LOS CAMPOS DEL FORMULARIO
	$(".btn_limpiar").click(function() {
		validator.resetForm();
	});		
	
	//PARA LAS FECHASF
	$("#fechai").datepicker({ changeFirstDay: false	});
	$("#fechaf").datepicker({ changeFirstDay: false	});
	
	//----------------CONSTRUIR RADICADO--------------------------------------
	$("#juzgadoorigen").change(function(event){
			
			construir_radicado(1,1);
			
			var id    = $("#juzgadoorigen").find(':selected').val();
			var idjuz = id.split("-");
			
			//CARGAR LISTA DE PROCESOS
			$("#claseproceso").load('funciones/traer_datos_lista.php?id='+idjuz[0]+"&idsql="+1);
			
			//CARGAR LISTA DE AUTO A NOTIFICAR, EN LA PARTE CUANDO SE CREA UNA PARTE Y ES DEMANDADO
			//$("#autonotificar").load('funciones/traer_datos_lista.php?id='+id+"&idsql="+4);
			
    });
	
	$("#juzgadoorigenmodificar").change(function(event){
			
			construir_radicado(2,2);
			
			var id    = $("#juzgadoorigenmodificar").find(':selected').val();
			var idjuz = id.split("-");
			
			//CARGAR LISTA DE PROCESOS
			$("#claseproceso").load('funciones/traer_datos_lista.php?id='+idjuz[0]+"&idsql="+1);
			
			//CARGAR LISTA DE AUTO A NOTIFICAR, EN LA PARTE CUANDO SE CREA UNA PARTE Y ES DEMANDADO
			//$("#autonotificar").load('funciones/traer_datos_lista.php?id='+id+"&idsql="+4);
			
    });
	
	$("#claseproceso").change(function(event){
			
			
			var id    = $("#claseproceso").find(':selected').val();
			
			//CARGAR LISTA DE PROCESOS
			//$("#clasificacionparte").load('funciones/traer_datos_lista.php?id='+id+"&idsql="+7);
			
			//CARGAR LISTA DE AUTO A NOTIFICAR, EN LA PARTE CUANDO SE CREA UNA PARTE Y ES DEMANDADO
			$("#autonotificar").load('funciones/traer_datos_lista.php?id='+id+"&idsql="+4);
			
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
	
	//PARA OCULTAR FILA  filapartes
	$('#filapartes').hide();
	$('#filapartes2').hide();
	

	//PARA ACTIVAR Y DEACTIVAR filapartes
	//var contador = 0;
	$("#btpartes").click(function(evento){
      	
		evento.preventDefault();
		
		contador = contador + 1;
		
		if(contador == 1){
		
			$('#filapartes').show();
			$('#filapartes2').show();
			contador = contador + 1;
		}
		else{
			$('#filapartes').hide();
			$('#filapartes2').hide();
			contador = 0;
		}
   	});
	
	$("#departamento").change(function(event){
			
			var id    = $("#departamento").find(':selected').val();
			
			$("#municipio").load('funciones/traer_datos_lista.php?id='+id+"&idsql="+2);
			
    });
	
	
	$('#partesdemandado').hide();
	
	$("#fechaxad").datepicker({ changeFirstDay: false	});
	
	//***********************************************************************************************************************************************
	//CIERRO ESTAS DOS FUNCIONES POR QUE VOY A INDEPENDIZAR
	//EL PROCESO DE GENERAR UNA CITACION, COMO USO EL DE DOCUMENTOS 
	//EN EL SIEPRO
	
	/*$("#clasificacionparte").change(function(event){
											 
		var idclase = $("#clasificacionparte").find(':selected').val();
		
		//if(idclase == 2 || idclase == 11){
		if(Buscar_Vector(idclase) == true){
		
			$('#partesdemandado').show();
			
			//var id = $("#juzgadoorigen").find(':selected').val();
			
			//$("#autonotificar").load('funciones/traer_datos_lista.php?id='+id+"&idsql="+4);
		}
		else{
			$('#partesdemandado').hide();
		}
			
    });
	
	$("#clasificacionparte2").change(function(event){
											 
		var idclase = $("#clasificacionparte2").find(':selected').val();
		
		//if(idclase == 2 || idclase == 11){
		if(Buscar_Vector(idclase) == true){
			
			$('#partesdemandado').show();
			
			//$("#autonotificar").load('funciones/traer_datos_lista.php?id='+$("#juzgadox2").val()+"&idsql="+4);
		}
		else{
			$('#partesdemandado').hide();
		}
			
    });*/
	
	//***********************************************************************************************************************************************
	
	//ME PERMITE VALIDAR CUANDO SE MODIFICA UN PROCESO
	$(".btn_validar2").click(function() {
		//alert(1);
		//return false

		var vmp0 = $('#radicadox3').val();
		var vmp1 = $('#radicadox').val();
		var vmp2 = $('#juzgadoorigen').val();
		var vmp3 = $('#claseproceso').val();
		/*var vmp4 = $('#claseproceso2').val();
		var vmp5 = $('#entidadcomisiona').val();
		var vmp6 = $('#asunto').val();
		var vmp7 = $('#despacholibra').val();*/
		
		if( (vmp0 == null || vmp0.length == 0 || /^\s+$/.test(vmp0)) &&
			(vmp1 == null || vmp1.length == 0 || /^\s+$/.test(vmp1)) && 
			(vmp2 == null || vmp2.length == 0 || /^\s+$/.test(vmp2)) &&
			(vmp3 == null || vmp3.length == 0 || /^\s+$/.test(vmp3)) /*&&
			(vmp4 == null || vmp4.length == 0 || /^\s+$/.test(vmp4)) &&
			(vmp5 == null || vmp5.length == 0 || /^\s+$/.test(vmp5)) &&
			(vmp6 == null || vmp6.length == 0 || /^\s+$/.test(vmp6)) &&
			(vmp7 == null || vmp7.length == 0 || /^\s+$/.test(vmp7))*/) {
			
			alert('Se debe definir al menos un parametro a modificar como (Radicado a Modificar, Nuevo Radicado, Juzgado o Clase Proceso)');
			return false
		}
	});
	
	$("#frm1x").validate({
        rules: {
            
			//ejemplo con campo cedula
			//cedula: { required: true, minlength: 2},
           
		   /*lastname: { required: true, minlength: 2},
            email: { required:true, email: true},
            phone: { minlength: 2, maxlength: 15},
            years: { required: true},
            message: { required:true, minlength: 2}*/
        },
        messages: {
           
		   //ejemplo con campo cedula
		   //cedula: "Defina Cedula",
           
		   /*lastname: "Debe introducir su apellido.",
            email : "Debe introducir un email válido.",
            phone : "El número de teléfono introducido no es correcto.",
            years : "Debe introducir solo números.",
            message : "El campo Mensaje es obligatorio.",*/
        },
        submitHandler: function(form){
            
			//var dataString = 'name='+$('#name').val()+'&lastname='+$('#lastname').val()+'...';
			//var dataString = 'cedula='+$('#cedula').val();
			
			//var dataString = 'cedula='+$('#cedula').val()+'&datospartes='+datospartes;
			
			var radicadox3     = $('#radicadox3').val();
			
			var radicadox        = $('#radicadox').val();
			var juzgadoorigen    = $('#juzgadoorigenmodificar').val();
			var idclaseproceso   = $('#claseproceso').val();
			var claseproceso2    = $('#claseproceso2').val();
			var entidadcomisiona = $('#entidadcomisiona').val();
			var asunto           = $('#asunto').val();
			var despacholibra    = $('#despacholibra').val();

			
			var observacionx     = $('#observacionx').val();
		
			//OBTENEMOS DEL RADICADO 170014003 006 19931018000 
			//CLASE JUZGADO 4003, DEPARTAMENTO 17, MUNICIPIO 17001
			//var idclasejuzgado = radicadox.substring(5, 9);
			//var iddepartamento = radicadox.substring(0, 2);
			//var idmunicipio    = radicadox.substring(0, 5);
			
			//var dataString = 'cedula='+$('#cedula').val()+'&datospartes='+$('#datospartes').val();
			
			//**********************************************************************************************************
			//CAMPO OCULTO QUE ME DEFINE SI SE ESTA REGISTRANDO O MODIFICANDO UN PROCESO ---> $('#idradicado').val();
			
			//REGISTRAR PROCESO
			/*if( $('#idradicado').val() == null || $('#idradicado').val().length == 0 || /^\s+$/.test($('#idradicado').val()) ) {
  		
				//var dataString = 'radicadox='+radicadox+'&juzgadoorigen='+juzgadoorigen+'&idclasejuzgado='+idclasejuzgado+'&idclaseproceso='+idclaseproceso+'&iddepartamento='+iddepartamento+'&idmunicipio='+idmunicipio+'&datospartes='+$('#datospartes').val();
				//var url1       = "index.php?controller=signot&action=Registro_Proceso";
				
				return false;
			}
			//MODIFICAR PROCESO
			else{*/

				var dataString = 'idradicado='+$('#idradicado').val()+'&radicadox='+radicadox+'&juzgadoorigen='+juzgadoorigen+'&idclaseproceso='+idclaseproceso+'&radicadox3='+radicadox3+'&observacionx='+observacionx+'&claseproceso2='+claseproceso2+'&entidadcomisiona='+entidadcomisiona+'&asunto='+asunto+'&despacholibra='+despacholibra;
				var url1       = "index.php?controller=signot&action=Modificar_Proceso_2";
			//}
			
			//var dataString = 'radicadox='+radicadox+'&juzgadoorigen='+juzgadoorigen+'&idclasejuzgado='+idclasejuzgado+'&idclaseproceso='+idclaseproceso+'&iddepartamento='+iddepartamento+'&idmunicipio='+idmunicipio+'&datospartes='+$('#datospartes').val();
			
			//**********************************************************************************************************
			
			//alert(dataString);
			
            $.ajax({
                type: "POST",
                //url:"send.php",
				//url:"index.php?controller=signot&action=Registro_Proceso",
				url:url1,
                data: dataString,
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
	
	
	//ME PERMITE VALIDAR CUANDO SE MODIFICA UNA PARTE
	$("#frm2x").validate({
        rules: {
            
			//ejemplo con campo cedula
			//cedula: { required: true, minlength: 2},
           
		   /*lastname: { required: true, minlength: 2},
            email: { required:true, email: true},
            phone: { minlength: 2, maxlength: 15},
            years: { required: true},
            message: { required:true, minlength: 2}*/
        },
        messages: {
           
		   //ejemplo con campo cedula
		   //cedula: "Defina Cedula",
           
		   /*lastname: "Debe introducir su apellido.",
            email : "Debe introducir un email válido.",
            phone : "El número de teléfono introducido no es correcto.",
            years : "Debe introducir solo números.",
            message : "El campo Mensaje es obligatorio.",*/
        },
        submitHandler: function(form){
            
			//var dataString = 'name='+$('#name').val()+'&lastname='+$('#lastname').val()+'...';
			//var dataString = 'cedula='+$('#cedula').val();
			
			//var dataString = 'cedula='+$('#cedula').val()+'&datospartes='+datospartes;
			
			var radicadox3     = $('#radicadox3').val();
			
			var radicadox        = $('#radicadox').val();
			var juzgadoorigen    = $('#juzgadoorigen').val();
			var idclaseproceso   = $('#claseproceso').val();
			var claseproceso2    = $('#claseproceso2').val();
            var entidadcomisiona = $('#entidadcomisiona').val();
            var asunto           = $('#asunto').val();
            var despacholibra    = $('#despacholibra').val();
		
			//OBTENEMOS DEL RADICADO 170014003 006 19931018000 
			//CLASE JUZGADO 4003, DEPARTAMENTO 17, MUNICIPIO 17001
			//var idclasejuzgado = radicadox.substring(5, 9);
			//var iddepartamento = radicadox.substring(0, 2);
			//var idmunicipio    = radicadox.substring(0, 5);
			
			//var dataString = 'cedula='+$('#cedula').val()+'&datospartes='+$('#datospartes').val();
			
			//**********************************************************************************************************
			//CAMPO OCULTO QUE ME DEFINE SI SE ESTA REGISTRANDO O MODIFICANDO UN PROCESO ---> $('#idradicado').val();
			
			//REGISTRAR PROCESO
			/*if( $('#idradicado').val() == null || $('#idradicado').val().length == 0 || /^\s+$/.test($('#idradicado').val()) ) {
  		
				//var dataString = 'radicadox='+radicadox+'&juzgadoorigen='+juzgadoorigen+'&idclasejuzgado='+idclasejuzgado+'&idclaseproceso='+idclaseproceso+'&iddepartamento='+iddepartamento+'&idmunicipio='+idmunicipio+'&datospartes='+$('#datospartes').val();
				//var url1       = "index.php?controller=signot&action=Registro_Proceso";
				
				return false;
			}
			//MODIFICAR PROCESO
			else{*/
				
				var dataString = 'idradicado='+$('#idradicado').val()+'&radicadox='+radicadox+'&juzgadoorigen='+juzgadoorigen+'&idclaseproceso='+idclaseproceso+'&radicadox3='+radicadox3+'&claseproceso2='+claseproceso2+'&entidadcomisiona='+entidadcomisiona+'&asunto='+asunto+'&despacholibra='+despacholibra;
				//var url1       = "index.php?controller=signot&action=Modificar_Proceso_2";
			//}
			
			//var dataString = 'radicadox='+radicadox+'&juzgadoorigen='+juzgadoorigen+'&idclasejuzgado='+idclasejuzgado+'&idclaseproceso='+idclaseproceso+'&iddepartamento='+iddepartamento+'&idmunicipio='+idmunicipio+'&datospartes='+$('#datospartes').val();
			
			//**********************************************************************************************************
			
			//alert(dataString);
			
            $.ajax({
                type: "POST",
                //url:"send.php",
				//url:"index.php?controller=signot&action=Registro_Proceso",
				url:url1,
                data: dataString,
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
	
	//ME PERMITE VALIDAR CUANDO SE MODIFICA UNA DIRECCION
	$("#frm4x").validate({
        rules: {
			//ejemplo con campo cedula
			//cedula: { required: true, minlength: 2},
           
		   /*lastname: { required: true, minlength: 2},
            email: { required:true, email: true},
            phone: { minlength: 2, maxlength: 15},
            years: { required: true},
            message: { required:true, minlength: 2}*/
        },
        messages: {
		   //ejemplo con campo cedula
		   //cedula: "Defina Cedula",
           
		   /*lastname: "Debe introducir su apellido.",
            email : "Debe introducir un email válido.",
            phone : "El número de teléfono introducido no es correcto.",
            years : "Debe introducir solo números.",
            message : "El campo Mensaje es obligatorio.",*/
        },
        submitHandler: function(form){
			//var dataString = 'name='+$('#name').val()+'&lastname='+$('#lastname').val()+'...';
			//var dataString = 'cedula='+$('#cedula').val();
			
			//var dataString = 'cedula='+$('#cedula').val()+'&datospartes='+datospartes;
			
			var iddireccionx = $('#iddireccionx').val();
			var documentox   = $('#documentox').val();
			var nombrex      = $('#nombrex').val();
			var telefonox    = $('#telefonox').val();
			var direccionx   = $('#direccionx').val();
			var departamento = $('#departamento').val();
			var municipio    = $('#municipio').val();

			var dataString = 'iddireccionx='+iddireccionx+'&nombrex='+nombrex+'&telefonox='+telefonox+'&direccionx='+direccionx+'&departamento='+departamento+'&municipio='+municipio;
			var url1       = "index.php?controller=signot&action=Modificar_Direccion_2";
			
			
			//**********************************************************************************************************
			
			//alert(dataString);
			
            $.ajax({
                type: "POST",
                //url:"send.php",
				//url:"index.php?controller=signot&action=Registro_Proceso",
				url:url1,
                data: dataString,
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
	
	
	//ME PERMITE VALIDAR CUANDO SE CORREGI UNA CITACION
	$("#fechaxau1").datepicker({ changeFirstDay: false	});
	//$("#fechaxau2").datepicker({ changeFirstDay: false	});
	$("#fechaxau3").datepicker({ changeFirstDay: false	});
	
	$("#frm5x").validate({
        rules: {
            
			//ejemplo con campo cedula
			//cedula: { required: true, minlength: 2},
           
		   /*lastname: { required: true, minlength: 2},
            email: { required:true, email: true},
            phone: { minlength: 2, maxlength: 15},
            years: { required: true},
            message: { required:true, minlength: 2}*/
        },
        messages: {
           
		   //ejemplo con campo cedula
		   //cedula: "Defina Cedula",
           
		   /*lastname: "Debe introducir su apellido.",
            email : "Debe introducir un email válido.",
            phone : "El número de teléfono introducido no es correcto.",
            years : "Debe introducir solo números.",
            message : "El campo Mensaje es obligatorio.",*/
        },
        submitHandler: function(form){
            
			//var dataString = 'name='+$('#name').val()+'&lastname='+$('#lastname').val()+'...';
			//var dataString = 'cedula='+$('#cedula').val();
			
			//var dataString = 'cedula='+$('#cedula').val()+'&datospartes='+datospartes;
			
			var idautox      = $('#idautox').val();
			var documentox   = $('#documentox').val();
			var nombrex      = $('#nombrex').val();
			var radicadox    = $('#radicadox').val();
			var autox        = $('#autox').val();
			var fechaxau1    = $('#fechaxau1').val();
			var fechaxau2    = $('#fechaxau2').val();
			var fechaxau3    = $('#fechaxau3').val();
			var correccionx  = $('#correccionx').val();
			var correccion2x = $('#correccion2x').val();
			var idpartex     = $('#campoidparte').val(); 
		    var idprocesox   = $('#campoidproceso').val(); 
			var dirigidoax   = $('#dirigidoa').val();
			var direccionx   = $('#direccion').val();
			var ciudadx      = $('#ciudad').val();
			var ndocumentox  = $('#ndocumento').val();
			var asuntox		 = $('#asunto').val();
			var partesx		 = $('#partesx').val();

			var dataString = 'idautox='+idautox+'&autox='+autox+'&fechaxau1='+fechaxau1+'&fechaxau2='+fechaxau2+'&correccionx='+correccionx+'&idpartex='+idpartex+'&idprocesox='+idprocesox+'&correccion2x='+correccion2x+'&dirigidoax='+dirigidoax+'&direccionx='+direccionx+'&ciudadx='+ciudadx+'&ndocumentox='+ndocumentox+'&ndocumentox='+ndocumentox+'&asuntox='+asuntox+'&partesx='+partesx+'&nombrex='+nombrex+'&fechaxau3='+fechaxau3;
			var url1       = "index.php?controller=signot&action=Corregir_Notificacion_2";
			//**********************************************************************************************************
			//alert(dataString);
			
            $.ajax({
                type: "POST",
                //url:"send.php",
				//url:"index.php?controller=signot&action=Registro_Proceso",
				url:url1,
                data: dataString,
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

	$('.filtrarproceso').click(function(evento){

		//alert(1);
		
		
		if (document.getElementById('fechai').value.length         == 0 &&
			document.getElementById('fechaf').value.length         == 0 &&
			document.getElementById('radicadox').value.length      == 0){
			
			//ASIGNO VALOR DE 3 YA QUE EN LA VISTA sigdoc_listar_documentos_salientes.php
			//AL FINAL DE ESTA PREGUNTO POR if(!empty($opcion)), SI PONGO CERO (0) NO LO VALIDA
			//CON LA FUNCION empty()
			dato_0 = 3;
			
			location.href="index.php?controller=signot&action=RecargarTablaProcesos&dato_0="+dato_0;
       	
		}
		else{
		
			dato_0 = 1;
			dato_1 = document.getElementById('fechai').value;
			dato_2 = document.getElementById('fechaf').value;
			datox1 = document.getElementById('radicadox').value;
			
			location.href="index.php?controller=signot&action=FiltroTablaProcesos&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1;
	
		}
	
    });
	
	//ME PERMITE CARGAR LOS DATOS AL FORMULARIO, SEGUN EL ID ESPECIFICADO
	$(".anotacion").click(function(){
								

		//CAPTURO EL ID DEL DOCUMENTO EL CUAL QUIERO EDITAR
		var id = $(this).attr('data-id');
		
		//alert(id);
		//ASIGNO EL VALOR ID A UN INPUT OCULTO EN EL FORMULARIO,PARA PODER SER ACTUALIZADO EL DOCUMENTO EN LA BASE DE DATOS
		$("#idproceso").val(id);
		
		location.href="index.php?controller=signot&action=Editar_Proceso_Anotacion&id="+id;
		
	 

	});
	
	//ACTIVAR PARTE 
	$('.activarparte').click( function(){
							   
		//CAPTURO EL ID DEL DOCUMENTO EL CUAL QUIERO CORREGIR
		var id = $(this).attr('data-id');
		
		var datoradicado = $(this).attr('data-radicado');
		
		var idclaseparte = $(this).attr('data-idclaseparte');
		
		
		
		//alert(id);
		
		params={};
        params.id = id;
		params.datoradicado = datoradicado;
		params.idclaseparte = idclaseparte;

		 //alert(params.eveasunto);
		$('#popupbox').load('views/popupbox/activarparte.php',params,function(){
			//alert(2);
			$('#block').show();
			//alert(3);
			$('#popupbox').show();
			//alert(4);
		})
		 
		
    });
	
	//---------------------------------------------------------------------------
	
	$("#nombrex").change(function(event){
		
		var idvalor = $("#nombrex").val();
		
		
		$.get("funciones/traer_datos_parte_direcciones_nombre.php?idvalor="+idvalor, function(cadena){
	
			var datos = cadena.split("******");
		
			//alert(cadena);
			
			var vector_datos = datos[0].split("//////");
			
			//alert (vector_datos.length);
			//alert (datos[1]);
			if(vector_datos.length >= 11){
				
				
				//CAMPO OCULTO CON EL ID DE PARTE
				$("#idparteproceso").val(vector_datos[0]);
				
				$("#documentox").val(vector_datos[2]);
				$("#documento2x").val(vector_datos[2]);
				$("#nombrex").val(vector_datos[3]);
				$("#nombre2x").val(vector_datos[3]);
				$("#datosadicionales").val(vector_datos[11]);
				
				
				//alert(datos[1]);
				Adicionar_Parte_Tabla_Parte_Direcciones(cadena);
				
			}
			else{
				
				$("#idparteproceso").val('');
				
				$("#documento2x").val('');
				$("#nombrex").val('');
				
				Eliminar_Tabla();
			}
			
		});
		
		
	});
	
	
	
	//******************************PARA LA MIGRACION*************************************
	
	//ME PERMITE CARGAR LOS DATOS AL FORMULARIO, SEGUN EL ID ESPECIFICADO
	$("#migracion").click(function(){
								

		if( $('#radicadox2').val() == null || $('#radicadox2').val().length == 0 || /^\s+$/.test($('#radicadox2').val()) ) {
			
			alert("Definir Radicado");
			document.getElementById('radicadox2').style.borderColor = '#FF0000';
		}
		else{
			
			var radix = $('#radicadox2').val();
			
			location.href="index.php?controller=signot&action=Registro_Migracion&radix="+radix;
			
		}
		
	 

	});
	
	
	 $("#frmmigrar").validate({
        rules: {
            
			//ejemplo con campo cedula
			//cedula: { required: true, minlength: 2},
           
		   /*lastname: { required: true, minlength: 2},
            email: { required:true, email: true},
            phone: { minlength: 2, maxlength: 15},
            years: { required: true},
            message: { required:true, minlength: 2}*/
        },
        messages: {
           
		   //ejemplo con campo cedula
		   //cedula: "Defina Cedula",
           
		   /*lastname: "Debe introducir su apellido.",
            email : "Debe introducir un email válido.",
            phone : "El número de teléfono introducido no es correcto.",
            years : "Debe introducir solo números.",
            message : "El campo Mensaje es obligatorio.",*/
        },
        submitHandler: function(form){
            
			var dataString = "";
			var url1       = "index.php?controller=signot&action=Registro_Migracion";
			
			//**********************************************************************************************************
			
			//alert(dataString);
			
            $.ajax({
                type: "POST",
                //url:"send.php",
				//url:"index.php?controller=signot&action=Registro_Proceso",
				url:url1,
                data: dataString,
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
	 
	 $('#cancel').click( function(){
        $('#block').hide();
        $('#popupbox').hide();
		
    });
	 
	 $(".inactivardir").click(function(){
								
		var iddir       = $(this).attr('data-iddir');
		
		var idproc 		= $(this).attr('data-idproc');
		
		var desprocesox = $(this).attr('data-desproc');
		
		if (confirm ("Esta Seguro de Realizar el Proceso")) {
			
			location.href="index.php?controller=signot&action=Inactivar_Direccion_Parte&iddir="+iddir+"&desprocesox="+desprocesox+"&idproc="+idproc;
		}
		
	});
	
	$(".cambiarestado").click(function(){
								
		
		var iddir       = $(this).attr('data-iddir');
		
		var idproc 		= $(this).attr('data-idproc');
		
		var desprocesox = $(this).attr('data-desproc');
		
		if (confirm ("Esta Seguro de Realizar el Proceso")) {
			
			location.href="index.php?controller=signot&action=CambiaEstado_Direccion_Parte&iddir="+iddir+"&desprocesox="+desprocesox+"&idproc="+idproc;
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

function construir_radicado(idaccion,frmjuzgado){
	
	if(frmjuzgado == 1){
		var id = $("#juzgadoorigen").find(':selected').val();
		
		//alert(id);
		var area_vector    = id.split("-");
		var area_nueva     = area_vector[1];
		var numero_juzgado = area_vector[2];
	}
	if(frmjuzgado == 2){
		var id = $("#juzgadoorigenmodificar").find(':selected').val();
		
		//alert(id);
		var area_vector    = id.split("-");
		var area_nueva     = area_vector[1];
		var numero_juzgado = area_vector[2];
	}
			
	//alert(id);
  	/*var area_vector    = id.split("-");
	var area_nueva     = area_vector[1];
  	var numero_juzgado = area_vector[2];*/
			
	var year        = $("#year").val();
	var consecutivo = $("#consecutivo").val();
	var instancia   = $("#instancia").val();
			
			
	var relleno = "";
		  	
	if(numero_juzgado > 9){
		  		
		relleno = "0";
	}
	else{
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
	
	$("#radicadox").val(radicadocompleto);
	
	//VALIDO QUE EL RADICADO YA EXISTA O NO, PARA NO PERMITIR DE NUEVO SU REGISTRO
	Traer_Dato_Radicado(radicadocompleto,idaccion);
}

function validar_campos_parte(){
	
	
		if (document.form2.radicadox.value.length == 0){
       			alert("Definir Radicado");
				document.getElementById('radicadox').style.borderColor='#FF0000';
       			return false;
		}
		if (document.form2.destipoanotacion.value.length == 0){
       			alert("Definir Tipo Anotacion");
				document.getElementById('destipoanotacion').style.borderColor='#FF0000';
       			return false;
		}
		if (document.form2.parteproceso.value.length == 0){
       			alert("Definir Parte del Proceso");
				document.getElementById('parteproceso').style.borderColor='#FF0000';
       			return false;
		}
		if (document.form2.destipoanotacion.value.length == 0){
       			alert("Definir Tipo Anotacion");
				document.getElementById('destipoanotacion').style.borderColor='#FF0000';
       			return false;
		}
		if (document.form2.anotacion.value.length == 0){
       			alert("Definir Anotacion");
				document.getElementById('anotacion').style.borderColor='#FF0000';
       			return false;
		}
	    
		if (confirm ("Esta seguro de Realizar la Activacion")) {
		
        	return true;
			
			
    	} 
		else{return false;}
		
	
}

function validar_campos_direccion(){
	
	
		if (document.formdir.idpartex.value.length == 0){
			
       			alert("Definir Id Parte");
				document.getElementById('idpartex').style.borderColor='#FF0000';
       			return false;
		}
		
		if (document.formdir.idprocesox.value.length == 0){
			
       			alert("Definir Id Proceso");
				document.getElementById('idprocesox').style.borderColor='#FF0000';
       			return false;
		}
		
		if (document.formdir.direccion.value.length == 0){
			
       			alert("Definir Direccion");
				document.getElementById('direccion').style.borderColor='#FF0000';
       			return false;
		}
		
		if (document.formdir.telefono.value.length == 0){
			
       			alert("Definir Telefono");
				document.getElementById('telefono').style.borderColor='#FF0000';
       			return false;
		}
		
		if (document.formdir.departamento.value.length == 0){
			
       			alert("Definir Departamento");
				document.getElementById('departamento').style.borderColor='#FF0000';
       			return false;
		}
		
		if (document.formdir.municipio.value.length == 0){
			
       			alert("Definir Municipio");
				document.getElementById('municipio').style.borderColor='#FF0000';
       			return false;
		}
	    
		if (confirm ("Esta Seguro de Adicionar Direccion")) {
		
        	return true;
			
			
    	} 
		else{return false;}
		
	
}

function Adicionar_Dato_Radicado(dat_1){
	
	$("#radicadox2").val(dat_1);
	
	Traer_Datos_Proceso(dat_1);
	
}

function Cerrar_Ventanta(){
	
	$('#block').hide();
    $('#popupbox').hide();
	
}


function validar_campos_cp(){
	
	
		
		
		if (document.formcp.clasificacionpartex.value.length == 0){
			
       			alert("Definir Clasificacion Parte");
				document.getElementById('clasificacionpartex').style.borderColor='#FF0000';
       			return false;
		}
		
		
	    
		if (confirm ("Esta Seguro de Adicionar la Clasificacion de la Parte")) {
		
        	return true;
			
			
    	} 
		else{return false;}
		
	
}

function validar_campos_mcp(){
	
	
		
		
		if (document.formmcp.clasificacionpartex.value.length == 0){
			
       			alert("Definir Clasificacion Parte");
				document.getElementById('clasificacionpartex').style.borderColor='#FF0000';
       			return false;
		}
		
		
	    
		if (confirm ("Esta Seguro de Modificar la Clasificacion de la Parte")) {
		
        	return true;
			
			
    	} 
		else{return false;}
		
	
}


function Obtener_Municipio(){
	var id    = $("#departamento").find(':selected').val();	
	$("#municipio").load('funciones/traer_datos_lista.php?id='+id+"&idsql="+2);
}



var z=1;
var Filas = 0;

function Adicionar_Parte(idaccion){
	
	//NOTA: SE USA LA FUNCION tabla = reemplazarCadena("</table>", " ", tabla);
	//YA QUE COMO ESTABA tabla=tabla.substring(0,(tabla.length-8)); NO ME ELIMINABA 
	//LA PARTE </table> Y LAS FILAS QUEDAN POR FUERA DE LA TABLA GENERANDOSE UNA INCONSISTENCIA
	//EN OTRSO SISTEMAS COMO REPARTO MASICO DEL SIEPRO SI ME FUNCIONA tabla=tabla.substring(0,(tabla.length-8));
	
	//alert(z);
	//alert(Filas);
	
	//VALIDA SI UN RADICADO YA FUE ADICONADO A LA TABLA
	//var existeradicado = Validar_Radicado_Tabla();
	
	existeradicado = 0;
	
	if(existeradicado == 1){
		existeradicado = 1;
		alert("No es posible Adiconar el Radicado, Ya fue Cargado en la Tabla");
	}
	else{//1
		
	//RETORNA 1 SI NO ESTAN TODOS LOS DATOS COMPLETOS PARA ADICIONAR UN REGISTRO A LA TABLA
	var validarcampos = Validar_Campos_Agregar(idaccion);
	
	//validarcampos = 0;
	
	if(validarcampos == 1){
		
		validarcampos = 1;
	}
	else{//2
	
			//DATOS 
			
			var dato1 = document.getElementById('cedula').value;
			var dato2 = document.getElementById('nombre').value;
			var dato3 = document.getElementById('direccion').value;
			var dato4 = document.getElementById('telefono').value;
			
			if(idaccion == 1){
				
				var s0    = document.frm.clasificacionparte;
				var dato5 = document.getElementById('clasificacionparte').value+"-"+s0.options[s0.selectedIndex].text;
			}
			
			if(idaccion == 2){
				
				var s0    = document.frm.clasificacionparte2;
				var dato5 = document.getElementById('clasificacionparte2').value+"-"+s0.options[s0.selectedIndex].text;
			}
			
			var s1    = document.frm.departamento;
			var dato6 = document.getElementById('departamento').value+"-"+s1.options[s1.selectedIndex].text;
			
			var s2    = document.frm.municipio;
			var dato7 = document.getElementById('municipio').value+"-"+s2.options[s2.selectedIndex].text;
			
			//DATOS CUNDO SE ESCOGE DEMANDADO-----------------------------------------------------------------------
			//SE REALIZA LA COMPARACION DEL IF PARA QUE EN LA TABLA EN AUTO A NOTIFICAR NO QUEDE --> (- Seleccionar Auto a Notificar)
			var dato8  = document.getElementById('fechaxd').value;
			var dato9  = document.getElementById('fechaxad').value;
			var valorauto = document.getElementById('autonotificar').value;
			
			if( (valorauto == null || valorauto.length == 0 || /^\s+$/.test(valorauto)) ) {
				
				var dato8  = "";
				var dato9  = "";
				var dato10 = "";
			}
			else{
				
				var dato8  = document.getElementById('fechaxd').value;
				var dato9  = document.getElementById('fechaxad').value;
			
				var s3     = document.frm.autonotificar;
				var dato10 = document.getElementById('autonotificar').value+"-"+s3.options[s3.selectedIndex].text;
			}
			//-------------------------------------------------------------------------------------------------------
	
			//Filas = resultado.length;
			Filas = 1;
			var cantidad_filas;
			var TABLA      = document.getElementById('t');
			cantidad_filas = TABLA.rows.length;
	
			//alert(cantidad_filas);
			
			if(cantidad_filas>1){
						
				//alert('cantidad > 1');
					
				//Eliminar_Tabla();
				
				var tabla=document.getElementById('cont').innerHTML;
					
				//for (var id=0; id<Filas; id++){
				
					//tabla=tabla.substring(0,(tabla.length-8)); 
					
					tabla = reemplazarCadena("</table>", " ", tabla);
					
					tabla+='<tr>';
					
					
					tabla+='<td>'+dato1+'</td>';
					
					tabla+='<td>'+dato2+'</td>';
					
					tabla+='<td>'+dato3+'</td>';
					
					tabla+='<td>'+dato4+'</td>';
					
					tabla+='<td>'+dato5+'</td>';
					
					tabla+='<td>'+dato6+'</td>';
					
					tabla+='<td>'+dato7+'</td>';
					
					tabla+='<td>'+dato8+'</td>';
					
					tabla+='<td>'+dato9+'</td>';
					
					tabla+='<td>'+dato10+'</td>';
					
					//tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto title=Eliminar Reparto onClick="Eliminar_Reparto()"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar"/></button></td>';
					
					tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_Fila(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';
										
					tabla+='</tr></table>';
					
					document.getElementById('cont').innerHTML=tabla;
					
					z++;
					
					Limpiar_Campos();
				 //}
			}
						
			if(cantidad_filas==1){
						
				//alert('cantidad = 1');
				
				var tabla=document.getElementById('cont').innerHTML;
				
				//alert(tabla);
				
				//for (var id=0; id<Filas; id++){
					
					//var partefinal = tabla.length - 8
					//alert("Longitud Tabla: "+tabla.length);
					//alert("Parte Final: "+partefinal);
					
					//tabla=tabla.substring(0,(tabla.length-8));
					
					tabla = reemplazarCadena("</table>", " ", tabla);
					
					//tabla=tabla.substring(0,partefinal);
					
					
					//alert(tabla);
					
					tabla+='<tr>';
				
					tabla+='<td>'+dato1+'</td>';
					
					tabla+='<td>'+dato2+'</td>';
					
					tabla+='<td>'+dato3+'</td>';
					
					tabla+='<td>'+dato4+'</td>';
					
					tabla+='<td>'+dato5+'</td>';
					
					tabla+='<td>'+dato6+'</td>';
					
					tabla+='<td>'+dato7+'</td>';
					
					tabla+='<td>'+dato8+'</td>';
					
					tabla+='<td>'+dato9+'</td>';
					
					tabla+='<td>'+dato10+'</td>';
					
					//tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto title=Eliminar Reparto onClick="Eliminar_Reparto()"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar"/></button></td>';
					
					tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_Fila(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';
					
					tabla+='</tr></table>';
				
					//alert(tabla);
					document.getElementById('cont').innerHTML=tabla;
					
					z++;
					
					Limpiar_Campos();
				//}
			}
			
	}//2
	
	//Limpiar_Formulario();
	
	}//1
	
}


function Validar_Campos_Agregar(idaccion){
	
	var validar = 0;
	
	valor  = document.getElementById('cedula').value;
	valor2 = document.getElementById('nombre').value;
	valor3 = document.getElementById('direccion').value;
	valor4 = document.getElementById('telefono').value;
	
	if(idaccion == 1){
		valor5  = document.getElementById('clasificacionparte').value;
	}
	
	if(idaccion == 2){
		valor5  = document.getElementById('clasificacionparte2').value;
	}
	
	valor5a = document.getElementById('fechaxd').value;
	valor5b = document.getElementById('fechaxad').value;
	valor5c = document.getElementById('autonotificar').value;
	
	
	valor6 = document.getElementById('departamento').value;
	valor7 = document.getElementById('municipio').value;
	
	if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
  		
		alert("Defina Cedula");
		document.getElementById('cedula').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2) ) {
  		
		alert("Defina Nombre");
		document.getElementById('nombre').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor3 == null || valor3.length == 0 || /^\s+$/.test(valor3) ) {
  		
		alert("Defina Direccion");
		document.getElementById('direccion').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor4 == null || valor4.length == 0 || /^\s+$/.test(valor4) ) {
  		
		alert("Defina Telefono");
		document.getElementById('telefono').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	

	//SE REALIZA ESTA COMPARACION YA QUE CUANDO SE SELECCIONE CLASE PARTE COMO DEMANDADO
	//EL SISTEMA DEBE PEDIR LA FECHA DE REGISTRO, FECHA AUTO Y AUTO A NOTIFICAR 
	//PARA SER ASIGNADOS A LA TABLA
	if( valor5 == null || valor5.length == 0 || /^\s+$/.test(valor5) ) {
  		
		if(idaccion == 1){
			alert("Defina Clasificacion Parte");
			document.getElementById('clasificacionparte').style.borderColor = '#FF0000';
			validar = 1;
			return validar;
		}
		if(idaccion == 2){
			alert("Defina Clasificacion Parte");
			document.getElementById('clasificacionparte2').style.borderColor = '#FF0000';
			validar = 1;
			return validar;
		}
		
	}
	else{
		
		/*if(valor5 == 2){
			
			if( (valor5a == null || valor5a.length == 0 || /^\s+$/.test(valor5a)) ||  (valor5b == null || valor5b.length == 0 || /^\s+$/.test(valor5b)) ||
				(valor5c == null || valor5c.length == 0 || /^\s+$/.test(valor5c)) ) {
				
					alert("Se Asigno Clasificacion Parte como DEMANDADO, Defina Fecha Registro, Fecha Auto y Auto a Notificar");
					document.getElementById('fechaxd').style.borderColor = '#FF0000';
					document.getElementById('fechaxad').style.borderColor = '#FF0000';
					document.getElementById('autonotificar').style.borderColor = '#FF0000';
					validar = 1;
					return validar;
			}
		}*/
	}
	
	
	
	if( valor6 == null || valor6.length == 0 || /^\s+$/.test(valor6) ) {
  		
		alert("Defina Departamento");
		document.getElementById('departamento').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor7 == null || valor7.length == 0 || /^\s+$/.test(valor7) ) {
  		
		alert("Defina Municipio");
		document.getElementById('municipio').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	

}

//ELIMINA UN REGISTRO SELECCIONADO DE LA TABLA
function Eliminar_Fila(idfila){
	
	
	//alert(idfila);
	
	//document.getElementsByTagName("table")[0].setAttribute("id","t");
    //document.getElementById("t").deleteRow(idfila);
	
	var TABLA = document.getElementById('t');
	
	TABLA.deleteRow(idfila);
	
	//z = z+1;
	
	//alert("idfila: "+idfila+" Z: "+z);*/
	
	
}





//-------------------------------------PARA ADICIONAR PARTE AL PROCESO-------------------------------------------------

var z=1;
var Filas = 0;

function Adicionar_ParteREGI(idaccion){
	
	//NOTA: SE USA LA FUNCION tabla = reemplazarCadena("</table>", " ", tabla);
	//YA QUE COMO ESTABA tabla=tabla.substring(0,(tabla.length-8)); NO ME ELIMINABA 
	//LA PARTE </table> Y LAS FILAS QUEDAN POR FUERA DE LA TABLA GENERANDOSE UNA INCONSISTENCIA
	//EN OTRSO SISTEMAS COMO REPARTO MASICO DEL SIEPRO SI ME FUNCIONA tabla=tabla.substring(0,(tabla.length-8));
	
	//alert(z);
	//alert(Filas);
	
	//VALIDA SI UN RADICADO YA FUE ADICONADO A LA TABLA
	var existeitem   = Validar_Item_Tabla_Adicionar_2();
	
	//existeradicado = 0;
	

	if(existeitem == 1){
		
		existeitem = 1;
		
		alert("No es posible Adicionar Registro con esa Cedula, Ya fue Cargado en la Tabla");
	}
	else{//1
		
		//RETORNA 1 SI NO ESTAN TODOS LOS DATOS COMPLETOS PARA ADICIONAR UN REGISTRO A LA TABLA
		var validarcampos = Validar_Campos_AgregarMODI_2(idaccion);
		
		//validarcampos = 0;
		
		if(validarcampos == 1){
			
			validarcampos = 1;
		}
		else{//2
		
			//DATOS 
			
			//var dato0 = document.getElementById('idradicado').value;
			dato0 = "VACIO";
			var dato1 = document.getElementById('idpartey').value;
			
			
			
			if( dato1 == null || dato1.length == 0 || /^\s+$/.test(dato1) ) {
				dato1 = "VACIO";
			}
			
			var dato2 = document.getElementById('cedulareg').value;
			var dato3 = document.getElementById('nombrereg').value;
			var dato4 = document.getElementById('datosadicionalesreg').value;
			
			var s0    = document.frm.clasificacionparte;
			var dato5 = document.getElementById('clasificacionparte').value+"-"+s0.options[s0.selectedIndex].text;
			
			var dato6 = document.getElementById('direccionParte').value;
            var dato7 = document.getElementById('telefonoParte').value;
            var dato8 = document.getElementById('departamento').value;
            var dato9 = document.getElementById('municipio').value;
            //-------------------------------------------------------------------------------------------------------//
            //Filas = resultado.length;
            Filas = 1;
            var cantidad_filas;
            var TABLA      = document.getElementById('tmodi2');
            cantidad_filas = TABLA.rows.length;
            //alert(cantidad_filas);
            if(cantidad_filas>1){
                //alert('cantidad > 1');
                //Eliminar_Tabla();
                var tabla=document.getElementById('cont').innerHTML;
                //for (var id=0; id<Filas; id++){
                    //tabla=tabla.substring(0,(tabla.length-8)); 
                    tabla = reemplazarCadena("</table>", " ", tabla);
                    tabla+='<tr>';
                    tabla+='<td>'+dato0+'</td>';
                    tabla+='<td>'+dato1+'</td>';
                    tabla+='<td>'+dato2+'</td>';
                    tabla+='<td>'+dato3+'</td>';
                    tabla+='<td>'+dato5+'</td>';
                    tabla+='<td>'+dato4+'</td>';
                    tabla+='<td>'+dato6+'</td>';
                    tabla+='<td>'+dato7+'</td>';
                    tabla+='<td>'+dato8+'</td>';
                    tabla+='<td>'+dato9+'</td>';
                    //tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto title=Eliminar Reparto onClick="Eliminar_Reparto()"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar"/></button></td>';
                    tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_FilaMODI_2(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';
                    tabla+='</tr></table>';
                    document.getElementById('cont').innerHTML=tabla;
                    z++;
                    Limpiar_CamposMODI_2();
                //}
            }						
            if(cantidad_filas==1){						
                //alert('cantidad = 1');
                var tabla=document.getElementById('cont').innerHTML;
                //alert(tabla);
                //for (var id=0; id<Filas; id++){
                    //var partefinal = tabla.length - 8
                    //alert("Longitud Tabla: "+tabla.length);
                    //alert("Parte Final: "+partefinal);
                    //tabla=tabla.substring(0,(tabla.length-8));
                    tabla = reemplazarCadena("</table>", " ", tabla);
                    //tabla=tabla.substring(0,partefinal);
                    //alert(tabla);
                    tabla+='<tr>';
                    tabla+='<td>'+dato0+'</td>';
                    tabla+='<td>'+dato1+'</td>';
                    tabla+='<td>'+dato2+'</td>';
                    tabla+='<td>'+dato3+'</td>';
                    tabla+='<td>'+dato5+'</td>';
                    tabla+='<td>'+dato4+'</td>';
                    tabla+='<td>'+dato6+'</td>';
                    tabla+='<td>'+dato7+'</td>';
                    tabla+='<td>'+dato8+'</td>';
                    tabla+='<td>'+dato9+'</td>';
                    //tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto title=Eliminar Reparto onClick="Eliminar_Reparto()"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar"/></button></td>';
                    tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_FilaMODI_2(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';
                    tabla+='</tr></table>';
                    //alert(tabla);
                    document.getElementById('cont').innerHTML=tabla;
                    z++;
                    Limpiar_CamposMODI_2();
                //}
            }			
        }//2	
        //Limpiar_Formulario();
    }//1	
}

function Validar_Item_Tabla_Adicionar_2(){
	
		var validarradicado = 0;
	
		
		
		$('#tmodi2 tr').each(function () {

			
			//var d0  = parseInt( $(this).find("td").eq(0).html() );
			//var d0b = parseInt( document.getElementById('numerocb').value );
			
			var d0  = $(this).find("td").eq(2).html();
			var d0b = document.getElementById('cedulareg').value;
			
			//alert(d0+"  "+d0b);
			
			if( d0b == d0 ){
				validarradicado = 1;
				return false;//para el for each
				
			}
			else{
				validarradicado = 0;
			}
			
			
		});
		
		
	
		return validarradicado;
}


function Validar_Campos_AgregarMODI_2(idaccion){
	
	var validar = 0;
	
	valor  = document.getElementById('cedulareg').value;
	valor2 = document.getElementById('nombrereg').value;
	valor5 = document.getElementById('clasificacionparte').value;
	
	
	if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
  		
		alert("Defina Cedula");
		document.getElementById('cedulareg').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2) ) {
  		
		alert("Defina Nombre");
		document.getElementById('nombrereg').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor5 == null || valor5.length == 0 || /^\s+$/.test(valor5) ) {
  		
		alert("Defina Clasificacion Parte");
		document.getElementById('clasificacionparte').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
		
	}
	

}

//ELIMINA UN REGISTRO SELECCIONADO DE LA TABLA
function Eliminar_FilaMODI_2(idfila){
	
	
	//alert(idfila);
	
	//document.getElementsByTagName("table")[0].setAttribute("id","t");
    //document.getElementById("t").deleteRow(idfila);
	
	var TABLA = document.getElementById('tmodi2');
	
	TABLA.deleteRow(idfila);
	
	//z = z+1;
	
	//alert("idfila: "+idfila+" Z: "+z);*/
	
	
}

function Limpiar_CamposMODI_2(){
	
	document.getElementById('idpartey').value = "";
	
	document.getElementById('cedulareg').value = "";
	document.getElementById('cedulareg').style.borderColor='#E0E0E0';
	
	document.getElementById('nombrereg').value = "";
	document.getElementById('nombrereg').style.borderColor='#E0E0E0';
	
	
	document.getElementById('datosadicionalesreg').value = "";
	document.getElementById('datosadicionalesreg').style.borderColor='#E0E0E0';

	document.getElementById('direccionParte').value = "";
    document.getElementById('direccionParte').style.borderColor='#E0E0E0';
    document.getElementById('telefonoParte').value = "";
    document.getElementById('telefonoParte').style.borderColor='#E0E0E0';
    document.getElementById('departamento').value = "";
    document.getElementById('departamento').style.borderColor='#E0E0E0';
    document.getElementById('municipio').value = "";
    document.getElementById('municipio').style.borderColor='#E0E0E0';
	
}




//------------------------------------------------------------------------------------------------------------------------






//-------------------------------------PARA ADICIONAR PARTE AL PROCESO-------------------------------------------------

var z=1;
var Filas = 0;

function Adicionar_ParteMODI(idaccion){
	
	//NOTA: SE USA LA FUNCION tabla = reemplazarCadena("</table>", " ", tabla);
	//YA QUE COMO ESTABA tabla=tabla.substring(0,(tabla.length-8)); NO ME ELIMINABA 
	//LA PARTE </table> Y LAS FILAS QUEDAN POR FUERA DE LA TABLA GENERANDOSE UNA INCONSISTENCIA
	//EN OTRSO SISTEMAS COMO REPARTO MASICO DEL SIEPRO SI ME FUNCIONA tabla=tabla.substring(0,(tabla.length-8));
	
	//alert(z);
	//alert(Filas);
	
	//VALIDA SI UN RADICADO YA FUE ADICONADO A LA TABLA
	var existeitem   = Validar_Item_Tabla_Adicionar();
	
	var existeitem_2 = Validar_Item_Tabla_Partes();
	
	//existeradicado = 0;
	
	if(existeitem_2 == 1){
		
		existeitem_2 = 1;
		
		alert("No es posible Adiconar Registro con esa Cedula, Ya Existe como Parte del Proceso (TABLA --> PARTES DEL PROCESO)");
	}
	else{
	
	if(existeitem == 1){
		
		existeitem = 1;
		
		alert("No es posible Adiconar Registro con esa Cedula, Ya fue Cargado en la Tabla");
	}
	else{//1
		
		//RETORNA 1 SI NO ESTAN TODOS LOS DATOS COMPLETOS PARA ADICIONAR UN REGISTRO A LA TABLA
		var validarcampos = Validar_Campos_AgregarMODI(idaccion);
		
		//validarcampos = 0;
		
		if(validarcampos == 1){
			
			validarcampos = 1;
		}
		else{//2
		
				//DATOS 
				
				var dato0 = document.getElementById('idradicado').value;
				var dato1 = document.getElementById('idpartey').value;
				
				if( dato1 == null || dato1.length == 0 || /^\s+$/.test(dato1) ) {
					dato1 = "VACIO";
				}
				
				var dato2 = document.getElementById('cedula').value;
				var dato3 = document.getElementById('nombre').value;
				var dato4 = document.getElementById('datosadicionales').value;
				var dato6 = document.getElementById('direccion').value;
				var dato7 = document.getElementById('telefono').value;
				var dato8 = document.getElementById('departamento').value;
				var dato9 = document.getElementById('municipio').value;
				
				var s0    = document.frmmodi.clasificacionparte2;
				var dato5 = document.getElementById('clasificacionparte2').value+"-"+s0.options[s0.selectedIndex].text;
				
		
				//-------------------------------------------------------------------------------------------------------
		
				//Filas = resultado.length;
				Filas = 1;
				var cantidad_filas;
				var TABLA      = document.getElementById('tmodi');
				cantidad_filas = TABLA.rows.length;
		
				//alert(cantidad_filas);
				
				if(cantidad_filas>1){
							
					//alert('cantidad > 1');
						
					//Eliminar_Tabla();
					
					var tabla=document.getElementById('cont').innerHTML;
						
					//for (var id=0; id<Filas; id++){
					
						//tabla=tabla.substring(0,(tabla.length-8)); 
						
						tabla = reemplazarCadena("</table>", " ", tabla);
						
						tabla+='<tr>';
						
						tabla+='<td>'+dato0+'</td>';
						
						tabla+='<td>'+dato1+'</td>';
						
						tabla+='<td>'+dato2+'</td>';
						
						tabla+='<td>'+dato3+'</td>';
						
						tabla+='<td>'+dato5+'</td>';
						
						tabla+='<td>'+dato4+'</td>';

						tabla+='<td>'+dato6+'</td>';
						tabla+='<td>'+dato7+'</td>';
						tabla+='<td>'+dato8+'</td>';
						tabla+='<td>'+dato9+'</td>';
						
		
						//tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto title=Eliminar Reparto onClick="Eliminar_Reparto()"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar"/></button></td>';
						
						tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_FilaMODI(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';
											
						tabla+='</tr></table>';
						
						document.getElementById('cont').innerHTML=tabla;
						
						z++;
						
						Limpiar_CamposMODI();
					 //}
				}
							
				if(cantidad_filas==1){
							
					//alert('cantidad = 1');
					
					var tabla=document.getElementById('cont').innerHTML;
					
					//alert(tabla);
					
					//for (var id=0; id<Filas; id++){
						
						//var partefinal = tabla.length - 8
						//alert("Longitud Tabla: "+tabla.length);
						//alert("Parte Final: "+partefinal);
						
						//tabla=tabla.substring(0,(tabla.length-8));
						
						tabla = reemplazarCadena("</table>", " ", tabla);
						
						//tabla=tabla.substring(0,partefinal);
						
						
						//alert(tabla);
						
						tabla+='<tr>';
					
						tabla+='<td>'+dato0+'</td>';
						
						tabla+='<td>'+dato1+'</td>';
						
						tabla+='<td>'+dato2+'</td>';
						
						tabla+='<td>'+dato3+'</td>';
						
						tabla+='<td>'+dato5+'</td>';
						
						tabla+='<td>'+dato4+'</td>';
						tabla+='<td>'+dato6+'</td>';
						tabla+='<td>'+dato7+'</td>';
						tabla+='<td>'+dato8+'</td>';
						tabla+='<td>'+dato9+'</td>';
						//tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto title=Eliminar Reparto onClick="Eliminar_Reparto()"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar"/></button></td>';
						
						tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_FilaMODI(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';
						
						tabla+='</tr></table>';
					
						//alert(tabla);
						document.getElementById('cont').innerHTML=tabla;
						
						z++;
						
						Limpiar_CamposMODI();
					//}
				}
				
		}//2
		
		//Limpiar_Formulario();
	
	}//1
	
	}
	
	
	
}
function Adicionar_ParteMODIborrar(idaccion){
	
	//NOTA: SE USA LA FUNCION tabla = reemplazarCadena("</table>", " ", tabla);
	//YA QUE COMO ESTABA tabla=tabla.substring(0,(tabla.length-8)); NO ME ELIMINABA 
	//LA PARTE </table> Y LAS FILAS QUEDAN POR FUERA DE LA TABLA GENERANDOSE UNA INCONSISTENCIA
	//EN OTRSO SISTEMAS COMO REPARTO MASICO DEL SIEPRO SI ME FUNCIONA tabla=tabla.substring(0,(tabla.length-8));
	
	//alert(z);
	//alert(Filas);
	
	//VALIDA SI UN RADICADO YA FUE ADICONADO A LA TABLA
	var existeitem   = Validar_Item_Tabla_Adicionar();
	
	var existeitem_2 = Validar_Item_Tabla_Partes();
	
	//existeradicado = 0;
	
	if(existeitem_2 == 1){
		
		existeitem_2 = 1;
		
		alert("No es posible Adiconar Registro con esa Cedula, Ya Existe como Parte del Proceso (TABLA --> PARTES DEL PROCESO)");
	}
	else{
	
	if(existeitem == 1){
		
		existeitem = 1;
		
		alert("No es posible Adiconar Registro con esa Cedula, Ya fue Cargado en la Tabla");
	}
	else{//1
		
		//RETORNA 1 SI NO ESTAN TODOS LOS DATOS COMPLETOS PARA ADICIONAR UN REGISTRO A LA TABLA
		var validarcampos = Validar_Campos_AgregarMODI(idaccion);
		
		//validarcampos = 0;
		
		if(validarcampos == 1){
			
			validarcampos = 1;
		}
		else{//2
		
				//DATOS 
				
				var dato0 = document.getElementById('idradicado').value;
				var dato1 = document.getElementById('idpartey').value;
				
				if( dato1 == null || dato1.length == 0 || /^\s+$/.test(dato1) ) {
					dato1 = "VACIO";
				}
				
				var dato2 = document.getElementById('cedula').value;
				var dato3 = document.getElementById('nombre').value;
				var dato4 = document.getElementById('datosadicionales').value;
				
				var s0    = document.frmmodi.clasificacionparte2;
				var dato5 = document.getElementById('clasificacionparte2').value+"-"+s0.options[s0.selectedIndex].text;
				
		
				//-------------------------------------------------------------------------------------------------------
		
				//Filas = resultado.length;
				Filas = 1;
				var cantidad_filas;
				var TABLA      = document.getElementById('tmodi');
				cantidad_filas = TABLA.rows.length;
		
				//alert(cantidad_filas);
				
				if(cantidad_filas>1){
							
					//alert('cantidad > 1');
						
					//Eliminar_Tabla();
					
					var tabla=document.getElementById('cont').innerHTML;
						
					//for (var id=0; id<Filas; id++){
					
						//tabla=tabla.substring(0,(tabla.length-8)); 
						
						tabla = reemplazarCadena("</table>", " ", tabla);
						
						tabla+='<tr>';
						
						tabla+='<td>'+dato0+'</td>';
						
						tabla+='<td>'+dato1+'</td>';
						
						tabla+='<td>'+dato2+'</td>';
						
						tabla+='<td>'+dato3+'</td>';
						
						tabla+='<td>'+dato5+'</td>';
						
						tabla+='<td>'+dato4+'</td>';
						
		
						//tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto title=Eliminar Reparto onClick="Eliminar_Reparto()"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar"/></button></td>';
						
						tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_FilaMODI(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';
											
						tabla+='</tr></table>';
						
						document.getElementById('cont').innerHTML=tabla;
						
						z++;
						
						Limpiar_CamposMODI();
					 //}
				}
							
				if(cantidad_filas==1){
							
					//alert('cantidad = 1');
					
					var tabla=document.getElementById('cont').innerHTML;
					
					//alert(tabla);
					
					//for (var id=0; id<Filas; id++){
						
						//var partefinal = tabla.length - 8
						//alert("Longitud Tabla: "+tabla.length);
						//alert("Parte Final: "+partefinal);
						
						//tabla=tabla.substring(0,(tabla.length-8));
						
						tabla = reemplazarCadena("</table>", " ", tabla);
						
						//tabla=tabla.substring(0,partefinal);
						
						
						//alert(tabla);
						
						tabla+='<tr>';
					
						tabla+='<td>'+dato0+'</td>';
						
						tabla+='<td>'+dato1+'</td>';
						
						tabla+='<td>'+dato2+'</td>';
						
						tabla+='<td>'+dato3+'</td>';
						
						tabla+='<td>'+dato5+'</td>';
						
						tabla+='<td>'+dato4+'</td>';
						
						
						
						
						//tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto title=Eliminar Reparto onClick="Eliminar_Reparto()"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar"/></button></td>';
						
						tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_FilaMODI(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';
						
						tabla+='</tr></table>';
					
						//alert(tabla);
						document.getElementById('cont').innerHTML=tabla;
						
						z++;
						
						Limpiar_CamposMODI();
					//}
				}
				
		}//2
		
		//Limpiar_Formulario();
	
	}//1
	
	}
	
	
	
}

function Validar_Item_Tabla_Adicionar(){
	
		var validarradicado = 0;
	
		
		
		$('#tmodi tr').each(function () {

			
			//var d0  = parseInt( $(this).find("td").eq(0).html() );
			//var d0b = parseInt( document.getElementById('numerocb').value );
			
			var d0  = $(this).find("td").eq(2).html();
			var d0b = document.getElementById('cedula').value;
			
			//alert(d0+"  "+d0b);
			
			if( d0b == d0 ){
				validarradicado = 1;
				return false;//para el for each
				
			}
			else{
				validarradicado = 0;
			}
			
			
		});
		
		
	
		return validarradicado;
}

function Validar_Item_Tabla_Partes(){
	
		var validarradicado = 0;
	
		$('#t2 tr').each(function () {

			
			//var d0  = parseInt( $(this).find("td").eq(0).html() );
			//var d0b = parseInt( document.getElementById('numerocb').value );
			
			var d0  = $(this).find("td").eq(2).html();
			var d0b = document.getElementById('cedula').value;
			
			//alert(d0+"  "+d0b);
			
			if( d0b == d0 ){
				validarradicado = 1;
				return false;//para el for each
				
			}
			else{
				validarradicado = 0;
			}
			
			
		});
		
		
	
		return validarradicado;
}




function Validar_Campos_AgregarMODI(idaccion){
	
	var validar = 0;
	
	valor  = document.getElementById('cedula').value;
	valor2 = document.getElementById('nombre').value;
	valor5 = document.getElementById('clasificacionparte2').value;
	
	
	if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
  		
		alert("Defina Cedula");
		document.getElementById('cedula').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2) ) {
  		
		alert("Defina Nombre");
		document.getElementById('nombre').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor5 == null || valor5.length == 0 || /^\s+$/.test(valor5) ) {
  		
		alert("Defina Clasificacion Parte");
		document.getElementById('clasificacionparte2').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
		
	}
	

}

//ELIMINA UN REGISTRO SELECCIONADO DE LA TABLA
function Eliminar_FilaMODI(idfila){
	
	
	//alert(idfila);
	
	//document.getElementsByTagName("table")[0].setAttribute("id","t");
    //document.getElementById("t").deleteRow(idfila);
	
	var TABLA = document.getElementById('tmodi');
	
	TABLA.deleteRow(idfila);
	
	//z = z+1;
	
	//alert("idfila: "+idfila+" Z: "+z);*/
	
	
}

//PARA ELIMINARTODA LA TABLA, EN UN SOLO LLAMADO
function Eliminar_TablaMODI(){
	
	var r;
	var cantidad_filas;
	var TABLA = document.getElementById('tmodi');
			
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

function Limpiar_CamposMODI(){
	
	document.getElementById('idpartey').value = "";
	
	document.getElementById('cedula').value = "";
	document.getElementById('cedula').style.borderColor='#E0E0E0';
	
	document.getElementById('nombre').value = "";
	document.getElementById('nombre').style.borderColor='#E0E0E0';
	
	
	document.getElementById('datosadicionales').value = "";
	document.getElementById('datosadicionales').style.borderColor='#E0E0E0';
	
	document.getElementById('clasificacionparte2').selectedIndex = 0;
	document.getElementById('clasificacionparte2').style.borderColor='#E0E0E0';

	
	
}




//------------------------------------------------------------------------------------------------------------------------








// Reemplaza cadenaVieja por cadenaNueva en cadenaCompleta
function reemplazarCadena(cadenaVieja, cadenaNueva, cadenaCompleta) {


   for (var i = 0; i < cadenaCompleta.length; i++) {
      if (cadenaCompleta.substring(i, i + cadenaVieja.length) == cadenaVieja) {
         cadenaCompleta= cadenaCompleta.substring(0, i) + cadenaNueva + cadenaCompleta.substring(i + cadenaVieja.length, cadenaCompleta.length);
      }
   }
   return cadenaCompleta;
}

//SE USAN DOS FUNCIONES DE LIMPIAR CAMPOS,  Limpiar_Campos() Y Limpiar_Campos_2()
//YA QUE EN LA VISTA signot_registro_radicado.php Y signot_modificar_proceso.php
//EL CAMPO Clasificacion Parte REALIZA LA OPERACION DE LLENAR LISTA Auto a Notificar:
//CON EL ID DEL JUZGADO DE ORIGEN, PERO EN LA VISTA signot_registro_radicado.php ESTE ES UNA LISTA
//Y EN signot_modificar_proceso.ph ES UN CAMPO DE TEXTO
function Limpiar_Campos(){
	
	document.getElementById('cedula').value = "";
	document.getElementById('cedula').style.borderColor='#E0E0E0';
	
	document.getElementById('nombre').value = "";
	document.getElementById('nombre').style.borderColor='#E0E0E0';
	
	document.getElementById('direccion').value = "";
	document.getElementById('direccion').style.borderColor='#E0E0E0';
	
	document.getElementById('telefono').value = "";
	document.getElementById('telefono').style.borderColor='#E0E0E0';
	
	document.getElementById('datosadicionales').value = "";
	document.getElementById('datosadicionales').style.borderColor='#E0E0E0';

	document.getElementById('clasificacionparte').selectedIndex = 0;
	document.getElementById('clasificacionparte').style.borderColor='#E0E0E0';
	
	//document.getElementById('clasificacionparte2').selectedIndex = 0;
	//document.getElementById('clasificacionparte2').style.borderColor='#E0E0E0';
	
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

function Limpiar_Campos_2(){
	
	document.getElementById('cedula').value = "";
	document.getElementById('cedula').style.borderColor='#E0E0E0';
	
	document.getElementById('nombre').value = "";
	document.getElementById('nombre').style.borderColor='#E0E0E0';
	
	
	document.getElementById('clasificacionparte2').selectedIndex = 0;
	document.getElementById('clasificacionparte2').style.borderColor='#E0E0E0';
	
	
	
	$('#partesdemandado').hide();
	

}

function Traer_Dato_Radicado(idradicado,idaccion){
	
		oXML = AJAXCrearObjeto();
		oXML.open('GET', 'funciones/traer_datos_proceso.php?idradicado='+idradicado+"&idaccion="+idaccion);
		oXML.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		oXML.onreadystatechange = leerDato;
		oXML.send(' ');
	
}
function leerDato(idaccion){
			
	if (oXML.readyState  == 4) {
					
		
		//resultado = eval('(' + oXML.responseText + ')');
		
		resultado = oXML.responseText.split("//////");
		
		//alert (resultado);
		
		//alert (resultado);
		//alert (resultado.length);
			
		//if(resultado != 0){
		if(resultado[0] != 0){
			
			//alert(resultado[1]);
			
			if(resultado[1] == 1){
			
				alert("RADICADO YA EXISTE, NO ES POSIBLE SU REGISTRO");
				
				$("#radicadox").val('');
			}
			
			if(resultado[1] == 2){
				
				alert("RADICADO YA EXISTE, NO ES POSIBLE SU REGISTRO, SI LO QUE DESEA ES CAMBIAR LA CLASE DE PROCESO, SELECCIONE LA CLASE DE PROCESO, DIGITE LA OBSERVACION DEL CAMBIO Y REGISTRE");
			}
			
			//$("#radicadox").val('');
			
			//PARA ELIMINAR TODA LA TABLA, POR AHORA NO SE USA PARA QUE EL USUARIO NO TENGA QUE VOLVER
			//A METER TODAS LAS PARTES SI CONSTRUYE UN RADICADO QUE YA EXISTA
			//Eliminar_Tabla();
			
		}
		else{
			
			//alert("Radicado no existe");
			//$("#radicadox").val(resultado);
			//document.getElementById('radicadox').value = resultado;
			

		}
		
	}
}

/*cambio radicado manual*/
function Traer_Datos_Partes_Reg(idvalor){
	//alert(idvalor+"***"+datoradicado);
	//if( $('#idradicado').val() == null || $('#idradicado').val().length == 0 || /^\s+$/.test($('#idradicado').val()) ) {
	/*if( datoradicado == null || datoradicado.length == 0 || /^\s+$/.test(datoradicado) ) {
		alert("Definir Radicado para la Busquedad");
		$("#idpartey").val('');
		$("#cedula").val('');
		$("#nombre").val('');
		$("#datosadicionales").val('');
	else{*/
		//$.get("funciones/traer_datos_parte.php?idvalor="+idvalor+"&datoradicado="+datoradicado, function(cadena){													
		$.get("funciones/traer_datos_parte.php?idvalor="+idvalor, function(cadena){												   
			var vector_datos = cadena.split("//////");
			//alert(vector_datos.length);
			//alert(vector_datos);
			if(vector_datos.length == 4){
				$("#idpartey").val(vector_datos[0]);
				$("#nombrereg").val(vector_datos[2]);
				$("#datosadicionalesreg").val(vector_datos[3]);
				
				$("#nombrereg").attr('disabled',true);
				
			}
			else{
				
				$("#idpartey").val('');
				//$("#cedula").val('');
				$("#nombrereg").val('');
				$("#datosadicionalesreg").val('');
				
				$("#nombrereg").attr('disabled',false);
			}
		});
	}

function Traer_Datos_Partes(idvalor,datoradicado){
	
	
	//alert(idvalor+"***"+datoradicado);
	
	//if( $('#idradicado').val() == null || $('#idradicado').val().length == 0 || /^\s+$/.test($('#idradicado').val()) ) {
	if( datoradicado == null || datoradicado.length == 0 || /^\s+$/.test(datoradicado) ) {
		
		alert("Definir Radicado para la Busquedad");
		
		$("#idpartey").val('');
		$("#cedula").val('');
		$("#nombre").val('');
		$("#datosadicionales").val('');
		
	}
	else{
	
		$.get("funciones/traer_datos_parte.php?idvalor="+idvalor+"&datoradicado="+datoradicado, function(cadena){
																		   
			var vector_datos = cadena.split("//////");
			
			//alert(vector_datos.length);
			//alert(vector_datos);
			
			if(vector_datos.length == 4){
		
				$("#idpartey").val(vector_datos[0]);
				$("#nombre").val(vector_datos[2]);
				$("#datosadicionales").val(vector_datos[3]);
				
				$("#nombre").attr('disabled',true);
				
			}
			else{
				
				$("#idpartey").val('');
				//$("#cedula").val('');
				$("#nombre").val('');
				$("#datosadicionales").val('');
				
				$("#nombre").attr('disabled',false);
			
			}
			
		});
		
	}
	
}

function Borrar_Datos(){
	
	datonombre = $("#nombre").val();
	
	if( datonombre == null || datonombre.length == 0 || /^\s+$/.test(datonombre) ) {
		
	}
	else{
		alert("SE BORRAN LOS DATOS PARA EVITAR LA DUPLICIDAD DE CEDULAS, SI LA CEDULA INGRESADA Y EL NOMBRE CORRESPONDE A LA PARTE QUE SE DESEA ADICIONAR HAGA USO DE ESTA, DE LO CONTRARIO CONTINUE LA BUSQUEDAD Y SI EL SISTEMA NO CARGA NADA ES UNA CEDULA VALIDA PARA SER USADA.");
	
		$("#idpartey").val('');
		$("#cedula").val('');
		$("#nombre").val('');
		$("#datosadicionales").val('');
		
	}
}


/*function Traer_Datos_Partes(idvalor,datoradicado){
	
	
	//alert(idvalor+"***"+datoradicado);
	
	//if( $('#idradicado').val() == null || $('#idradicado').val().length == 0 || /^\s+$/.test($('#idradicado').val()) ) {
	if( datoradicado == null || datoradicado.length == 0 || /^\s+$/.test(datoradicado) ) {
		
		alert("Definir Radicado para la Busquedad");
		
		$("#cedula").val('');
		$("#nombre").val('');
		$("#telefono").val('');
		$("#direccion").val('');
				
		
	}
	else{
	
		$.get("funciones/traer_datos_parte.php?idvalor="+idvalor+"&datoradicado="+datoradicado, function(cadena){
																		   
			var vector_datos = cadena.split("//////");
			
			//alert(vector_datos.length);
			//alert(vector_datos);
				
			$("#nombre").val(vector_datos[1]);
			$("#telefono").val(vector_datos[2]);
			$("#direccion").val(vector_datos[3]);
				
			$("#departamento").val(vector_datos[4]);
			
			
			$("#datosadicionales").val(vector_datos[6]);
			
			//ENVIO EL id QUE SE TRAE DE traer_datos_parte.php Y ES ASIGNADO A vector_datos[0]
			//PARA SER ENVIADO A traer_datos_lista.php Y CAPTURAR idmunicipio Y QUE AL CARGAR LA LISTA
			//DE MUNICIPIOS EL SISTEMA IDENTIFIQUE CUAL MUNICIPIO ES EL QUE SE DEBE IDENTIFICAR EN LA LISTA.
			$("#municipio").load('funciones/traer_datos_lista.php?id='+vector_datos[4]+"&idsql="+3+"&idparte="+vector_datos[0]);
			
		 
		});
		
	}
	
}*/

/*adicionar cambio Radicado manual*/
function Traer_Datos_Proceso(idvalor){
	$.get("funciones/traer_datos_proceso_22.php?idvalor="+idvalor, function(cadena){
		var datos = cadena.split("******");
		var vector_datos = datos[0].split("//////");
		//alert (vector_datos.length);
		//alert (datos[1]);
		if(vector_datos.length == 13){
			//SE PREGUNTA SI UN PROCESO ESTA EN ESTA DE DEVOLUCION O NO
			//if(vector_datos[6] == 0){
				//CAMPO OCULTO CON EL ID DEL RADICADO
				$("#idradicado").val(vector_datos[0]);
				$("#radicadox2x").val(vector_datos[8]);
				$("#juzgadox").val(vector_datos[2]);
				$("#claseprocesox").val(vector_datos[3]);
				Adicionar_Parte_Tabla(datos[1]);
				//CARGAR ID JUZGADO PARA CARGAR LISTA DE AUTO A NOTIFICAR, EN LA PARTE CUANDO SE CREA UNA PARTE Y ES DEMANDADO
				$("#juzgadox2").val(vector_datos[4]);
				
				var claseproceso22=(vector_datos[9]);
				if (claseproceso22!='') {
					$("#claseproceso2").css('display','table-row').val(vector_datos[9]);
					$("#entidadcomisiona").css('display','table-row').val(vector_datos[10]);
					$("#asunto").css('display','table-row').val(vector_datos[11]);
					$("#despacholibra").css('display','table-row').val(vector_datos[12]);
					$("#juzgadox").css('display','none');
					$("#claseprocesox").css('display','none');
					$('#ocultarTR1').css('display','none');
					$('#ocultarTR2').css('display','none');
					$('#ocultarTR3').css('display','table-row');
					$('#ocultarTR4').css('display','table-row');
					$('#ocultarTR5').css('display','table-row');
					$('#ocultarTR6').css('display','table-row');
				} else {
					$("#claseproceso2").css('display','none');
					$("#entidadcomisiona").css('display','none');
					$("#asunto").css('display','none');
					$("#despacholibra").css('display','none');
					$("#juzgadox").css('display','table-row');
					$("#claseprocesox").css('display','table-row');
					$('#ocultarTR1').css('display','table-row');
					$('#ocultarTR2').css('display','table-row');
					$('#ocultarTR3').css('display','none');
					$('#ocultarTR4').css('display','none');
					$('#ocultarTR5').css('display','none');
					$('#ocultarTR6').css('display','none');
				}
		}
		/*else{
			$("#idradicado").val('');
			$("#juzgadox").val('');
			$("#claseprocesox").val('');
			$("#claseproceso2").val('');
			$("#radicadox2x").val('');
			Eliminar_Tabla();
			Limpiar_Campos_2();
			$('#partesdemandado').hide();
		}*/
	});
}
/*adicionar cambio Radicado manual*/
function Traer_Datos_Procesoborrar3(idvalor){
	
	//alert(idvalor);
	
	$.get("funciones/traer_datos_proceso_22.php?idvalor="+idvalor, function(cadena){
	
		var datos = cadena.split("******");
	
		//alert(cadena);

		//alert(datos);
		
		var vector_datos = datos[0].split("//////");
		
		//alert (vector_datos.length);
		//alert (datos[1]);
		
		if(vector_datos.length == 10){
			
			
			//SE PREGUNTA SI UN PROCESO ESTA EN ESTA DE DEVOLUCION O NO
			//if(vector_datos[6] == 0){
				
				//CAMPO OCULTO CON EL ID DEL RADICADO
				$("#idradicado").val(vector_datos[0]);
				
				$("#radicadox2x").val(vector_datos[8]);
				
				$("#juzgadox").val(vector_datos[2]);
				$("#claseprocesox").val(vector_datos[3]);
				$("#claseproceso2").val(vector_datos[9]);
				
				//alert(datos[1]);
				Adicionar_Parte_Tabla(datos[1]);
				
				//CARGAR ID JUZGADO PARA CARGAR LISTA DE AUTO A NOTIFICAR, EN LA PARTE CUANDO SE CREA UNA PARTE Y ES DEMANDADO
				$("#juzgadox2").val(vector_datos[4]);
				
				//CARGAR LISTA DE AUTO A NOTIFICAR, EN LA PARTE CUANDO SE CREA UNA PARTE Y ES DEMANDADO
				//$("#autonotificar").load('funciones/traer_datos_lista.php?id='+vector_datos[5]+"&idsql="+4);
			
			/*}
			else{
				
				alert("EL PROCESO SE ENCUENTRA EN ESTADO DE DEVOLUCION, NO ES POSIBLE SU MANEJO,"+" TIPO DE DEVOLUCION A JUZGADO: "+vector_datos[7]);
				
				$("#radicadox2").val('');
				$("#idradicado").val('');
				$("#juzgadox").val('');
				$("#claseprocesox").val('');
				$("#radicadox2x").val('');
				
				Eliminar_Tabla();
				
				Limpiar_Campos_2();
				
				$('#partesdemandado').hide();
			}*/
			
		}
		else{
			
			$("#idradicado").val('');
			$("#juzgadox").val('');
			$("#claseprocesox").val('');
			$("#claseproceso2").val('');
			$("#radicadox2x").val('');
			
			Eliminar_Tabla();
			
			Limpiar_Campos_2();
			
			$('#partesdemandado').hide();
			
		}
		
	});

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
					
					tabla+='<td>'+$("#idradicado").val()+'</td>';
					
					
					tabla+='<td>'+resultado2[0]+'</td>';
					
					tabla+='<td>'+resultado2[1]+'</td>';
				
					tabla+='<td>'+resultado2[2]+'</td>';
				
					tabla+='<td>'+resultado2[3]+'</td>';
					
					tabla+='<td>'+resultado2[4]+'</td>';
					
					tabla+='<td><button type=button name=adicicinardireccion id=adicicinardireccion onclick="Adicionar_Direccion(this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/direccion.png" width="30" height="30" title="ADICIONAR DIRECCION"/></button></td>';
					
					tabla+='<td><button type=button name=inactivardireccion id=inactivardireccion onclick="Inactivar_Direccion(this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/error.jpg" width="30" height="30" title="INACTIVAR DIRECCIONES"/></button></td>';
					
					tabla+='<td><button type=button name=adicicinarclasificacion id=adicicinarclasificacion onclick="Adicionar_Clasificacion(this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/consolidado2.png" width="30" height="30" title="ADICIONAR CLASIFICACION PARTE"/></button></td>';
					
					tabla+='<td><button type=button name=adicicinarclasificacion id=adicicinarclasificacion onclick="Modificar_Clasificacion(this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/np.png" width="30" height="30" title="MODIFICAR CLASIFICACION PARTE"/></button></td>';
		
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
			
					tabla+='<td>'+$("#idradicado").val()+'</td>';
			
					tabla+='<td>'+resultado2[0]+'</td>';
					
					tabla+='<td>'+resultado2[1]+'</td>';
				
					tabla+='<td>'+resultado2[2]+'</td>';
				
					tabla+='<td>'+resultado2[3]+'</td>';
					
					tabla+='<td>'+resultado2[4]+'</td>';
					
					tabla+='<td><button type=button name=cargardatosparte id=cargardatosparte onclick="Adicionar_Direccion(this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/direccion.png" width="30" height="30" title="ADICIONAR DIRECCION"/></button></td>';
					
					tabla+='<td><button type=button name=inactivardireccion id=inactivardireccion onclick="Inactivar_Direccion(this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/error.jpg" width="30" height="30" title="INACTIVAR DIRECCIONES"/></button></td>';
					
					tabla+='<td><button type=button name=adicicinarclasificacion id=adicicinarclasificacion onclick="Adicionar_Clasificacion(this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/consolidado2.png" width="30" height="30" title="ADICIONAR CLASIFICACION PARTE"/></button></td>';
					
					tabla+='<td><button type=button name=adicicinarclasificacion id=adicicinarclasificacion onclick="Modificar_Clasificacion(this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/np.png" width="30" height="30" title="MODIFICAR CLASIFICACION PARTE"/></button></td>';
					
					tabla+='</tr></table>';
				
					//alert(tabla);
					document.getElementById('cont2').innerHTML=tabla;
					
					
				}
				
			}
			
	
	
}




function Adicionar_Direccion(idfila){

	//alert(idfila);

	//SE OBTIENE EL VALOR DE CADA CELDA DE LA FILA ESPECIFICA
	var idprocesox = document.getElementById("t2").rows[idfila].cells[0].innerText;
	var idpartex   = document.getElementById("t2").rows[idfila].cells[1].innerText;
	

		params={};
        params.idprocesox = idprocesox;
		params.idpartex = idpartex;
		

		 //alert(params.eveasunto);
		$('#popupbox').load('views/popupbox/adicionardireccion.php',params,function(){
			//alert(2);
			$('#block').show();
			//alert(3);
			$('#popupbox').show();
			//alert(4);
		})
	
	//alert(dx0+"-----"+dx1);

	
}

function Inactivar_Direccion(idfila){
	
	//alert(idfila);
	
		//SE OBTIENE EL VALOR DE CADA CELDA DE LA FILA ESPECIFICA
		var idprocesox    = document.getElementById("t2").rows[idfila].cells[0].innerText;
		var desidprocesox = $("#radicadox2").val();
		
		var idpartex    = document.getElementById("t2").rows[idfila].cells[1].innerText;
		var desidpartex = document.getElementById("t2").rows[idfila].cells[3].innerText;
	

		params={};
        params.idprocesox    = idprocesox;
		params.desidprocesox = desidprocesox;
		params.idpartex      = idpartex;
		params.desidpartex   = desidpartex;
		

		 //alert(params.eveasunto);
		$('#popupbox').load('views/popupbox/inactivar_direccion.php',params,function(){
			//alert(2);
			$('#block').show();
			//alert(3);
			$('#popupbox').show();
			//alert(4);
		})

}

function Adicionar_Clasificacion(idfila){
	
	//alert(idfila);
	
	//SE OBTIENE EL VALOR DE CADA CELDA DE LA FILA ESPECIFICA
	var idprocesox = document.getElementById("t2").rows[idfila].cells[0].innerText;
	var idpartex   = document.getElementById("t2").rows[idfila].cells[1].innerText;
	

		params={};
        params.idprocesox = idprocesox;
		params.idpartex = idpartex;
		

		 //alert(params.eveasunto);
		$('#popupbox').load('views/popupbox/adicionarclasificacion.php',params,function(){
			//alert(2);
			$('#block').show();
			//alert(3);
			$('#popupbox').show();
			//alert(4);
		})
	
	//alert(dx0+"-----"+dx1);

	
}

function Modificar_Clasificacion(idfila){
	
	//alert(idfila);
	
	//SE OBTIENE EL VALOR DE CADA CELDA DE LA FILA ESPECIFICA
	var idprocesox    = document.getElementById("t2").rows[idfila].cells[0].innerText;
	var idpartex      = document.getElementById("t2").rows[idfila].cells[1].innerText;
	var idclasipartex = document.getElementById("t2").rows[idfila].cells[4].innerText;
	

		params={};
        params.idprocesox    = idprocesox;
		params.idpartex      = idpartex;
		params.idclasipartex = idclasipartex;
		

		 //alert(params.eveasunto);
		$('#popupbox').load('views/popupbox/adicionarclasificacion_2.php',params,function(){
			//alert(2);
			$('#block').show();
			//alert(3);
			$('#popupbox').show();
			//alert(4);
		})
	
	//alert(dx0+"-----"+dx1);

	
}




function Traer_Datos_Notificaciones(idvalor){
	
	$.get("funciones/traer_datos_notificaciones.php?idvalor="+idvalor, function(cadena){
	
		var datos = cadena.split("******");
		
		var vector_datos = datos[0].split("//////");
		
		//alert (vector_datos.length);
		//alert (datos[1]);
		
		if(vector_datos.length == 4){
			
			//CAMPO OCULTO CON EL ID DEL RADICADO
			$("#idradicado").val(vector_datos[0]);
			
			$("#juzgadox").val(vector_datos[2]);
			$("#claseprocesox").val(vector_datos[3]);
			
			//alert(datos[1]);
			Adicionar_Parte_Tabla_Notificaciones(datos[1]);
			
		}
		else{
			
			$("#idradicado").val('');
			$("#juzgadox").val('');
			$("#claseprocesox").val('');
			
			Eliminar_Tabla();
		}
		
	});

}

function Adicionar_Parte_Tabla_Notificaciones(datostabla){
	
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
					
					
					tabla+='<td>'+resultado2[0]+'</td>';
					
					tabla+='<td>'+resultado2[1]+'</td>';
					
					tabla+='<td>'+resultado2[2]+'</td>';
					
					tabla+='<td>'+resultado2[3]+'</td>';
					
					tabla+='<td>'+resultado2[4]+'</td>';
					
					tabla+='<td>'+resultado2[5]+'</td>';
					
					tabla+='<td>'+resultado2[6]+'</td>';
					
					tabla+='<td>'+resultado2[7]+'</td>';
					
					tabla+='<td>'+resultado2[8]+'</td>';
					
					tabla+='<td>'+resultado2[9]+'</td>';
					
					tabla+='<td>'+resultado2[10]+'</td>';
					
					tabla+='<td>'+resultado2[11]+'</td>';
					
					tabla+='<td>'+resultado2[12]+'</td>';
					
					tabla+='<td>'+resultado2[13]+'</td>';
		
					tabla+='<td><button type=button name=generarnotificacion id=generarnotificacion onclick="Generar_Notificacion(this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/icono_word.gif" width="30" height="30" title="GENERAR CITACION"/></button></td>';
					
					tabla+='<td><button type=button name=correccionnotificacion id=correccionnotificacion onclick="Corregir_Notificacion(this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/modficar.JPG" width="30" height="30" title="CORREGIR CITACION"/></button></td>';
					
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
			
					tabla+='<td>'+resultado2[0]+'</td>';
					
					tabla+='<td>'+resultado2[1]+'</td>';
					
					tabla+='<td>'+resultado2[2]+'</td>';
					
					tabla+='<td>'+resultado2[3]+'</td>';
					
					tabla+='<td>'+resultado2[4]+'</td>';
					
					tabla+='<td>'+resultado2[5]+'</td>';
					
					tabla+='<td>'+resultado2[6]+'</td>';
					
					tabla+='<td>'+resultado2[7]+'</td>';
					
					tabla+='<td>'+resultado2[8]+'</td>';
					
					tabla+='<td>'+resultado2[9]+'</td>';
					
					tabla+='<td>'+resultado2[10]+'</td>';
					
					tabla+='<td>'+resultado2[11]+'</td>';
					
					tabla+='<td>'+resultado2[12]+'</td>';
					
					tabla+='<td>'+resultado2[13]+'</td>';
					
					//tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto title=Eliminar Reparto onClick="Eliminar_Reparto()"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar"/></button></td>';
					
					
					
					tabla+='<td><button type=button name=generarnotificacion id=generarnotificacion onclick="Generar_Notificacion(this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/icono_word.gif" width="30" height="30" title="GENERAR CITACION"/></button></td>';
					
					tabla+='<td><button type=button name=correccionnotificacion id=correccionnotificacion onclick="Corregir_Notificacion(this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/modficar.JPG" width="30" height="30" title="CORREGIR CITACION"/></button></td>';
					
					tabla+='</tr></table>';
				
					//alert(tabla);
					document.getElementById('cont2').innerHTML=tabla;
					
					
				}
				
			}
			
	
	
}

function Generar_Notificacion(idfila){

	//alert(idfila);
	
	//SE OBTIENE EL VALOR DE CADA CELDA DE LA FILA ESPECIFICA
	var dx1  = document.getElementById("t2").rows[idfila].cells[0].innerText;
	var dx2  = document.getElementById("t2").rows[idfila].cells[1].innerText;
	var dx3  = document.getElementById("t2").rows[idfila].cells[2].innerText;
	var dx4  = document.getElementById("t2").rows[idfila].cells[3].innerText;
	var dx5  = document.getElementById("t2").rows[idfila].cells[4].innerText;
	var dx6  = document.getElementById("t2").rows[idfila].cells[5].innerText;
	var dx7  = document.getElementById("t2").rows[idfila].cells[6].innerText;
	var dx8  = document.getElementById("t2").rows[idfila].cells[7].innerText;
	
	//SE REALIZA ESTA OPERACION YA QUE SI SE ENVIA YA QUE EL CAMPO DIRECCION TRAE EL CARACTER #
	//AL GENERAR EL REPORTE EN WORD SE PRESENTA UNA INCOSISTENCIA
	//EJEMPLO CR 21 # 46 A 82 SALE CR 21 SOLAMENTE, AFECTANDO LOS DATOS QUE SIGUEN DESPUES DE ESTA CARGA. 
	var dx9  = document.getElementById("t2").rows[idfila].cells[8].innerText;
	dx9      = reemplazarCadena("#", "NUM", dx9);
	
	var dx10 = document.getElementById("t2").rows[idfila].cells[9].innerText;
	var dx11 = document.getElementById("t2").rows[idfila].cells[10].innerText;
	var dx12 = document.getElementById("t2").rows[idfila].cells[11].innerText;
	var dx13 = $("#claseprocesox").val();
	
	var datosx = dx1+"//////"+dx2+"//////"+dx3+"//////"+dx4+"//////"+dx5+"//////"+dx6+"//////"+dx7+"//////"+dx8+"//////"+dx9+"//////"+dx10+"//////"+dx11+"//////"+dx12+"//////"+dx13;
	
	//alert(datosx);
	
	location.href="index.php?controller=signot&action=GenerarNotificacionDemandado&opcion=1&datosx="+datosx;
	
}

function Corregir_Notificacion(idfila){
	
	//SE OBTIENE EL VALOR DE CADA CELDA DE LA FILA ESPECIFICA
	var dx1  = document.getElementById("t2").rows[idfila].cells[0].innerText;
	
	location.href="index.php?controller=signot&action=Corregir_Notificacion&dx1="+dx1;

}

function Traer_Datos_Proceso_2(idvalor){
	//alert(idvalor);
	$.get("funciones/traer_datos_proceso_2.php?idvalor="+idvalor, function(cadena){
		var datos = cadena.split("******");
		//alert(cadena);
		var vector_datos = datos[0].split("//////");
		//alert (vector_datos.length);
		var claseproceso2txt=(vector_datos[9]);

		if(vector_datos.length == 13){

			$("#idradicado").val(vector_datos[0]);
			$("#claseproceso2").val(vector_datos[9]);
			$("#entidadcomisiona").val(vector_datos[10]);
			$("#asunto").val(vector_datos[11]);
			$("#despacholibra").val(vector_datos[12]);
				
				//document.getElementById('year').selectedIndex = 0;
				$('#year').show();
				
				//OBTENEMOS DEL RADICADO 170014003006 2015 00 896 00
				//AÑO, CONSECUTIVO, INSTANCIA
				var valoryear = vector_datos[1].substring(12, 16);
				$("#year").val(valoryear);
				
				//$("#consecutivo").val('');
				$('#consecutivo').show();
				var valorconsecutivo = vector_datos[1].substring(18, 21);
				$("#consecutivo").val(valorconsecutivo);
		
			
				//document.getElementById('instancia').selectedIndex = 0;
				$('#instancia').show();
				var valorinstancia = vector_datos[1].substring(21, 23);
				$("#instancia").val(valorinstancia);
				
				//document.getElementById('juzgadoorigen').selectedIndex = 0;
				//alert(vector_datos[4]);
				//$('#juzgadoorigen').val(vector_datos[4]);
				$('#juzgadoorigenmodificar').show();
				$("#juzgadoorigenmodificar").load('funciones/traer_datos_lista.php?id='+vector_datos[4]+"&idsql="+5+"&idparte="+vector_datos[1]);
			
				
				$("#radicadox").val('');
				$('#radicadox').show();
				
				//document.getElementById('claseproceso').selectedIndex = 0;
				$('#claseproceso').show();
				$("#claseproceso").load('funciones/traer_datos_lista.php?id='+vector_datos[5]+"&idsql="+6+"&idparte="+vector_datos[1]);

				Adicionar_Parte_Tabla_Observaciones(datos[2]);
		if(claseproceso2txt!=''){
			$('#year').css('display','none').removeClass('required');
			$('#ocultarTR1').css('display','none');

			$('#consecutivo').css('display','none').removeClass('required').removeClass('number');
			$('#ocultarTR2').css('display','none');

			$('#instancia').css('display','none').removeClass('required');
			$('#ocultarTR3').css('display','none');

			$('#juzgadoorigenmodificar').css('display','none').removeClass('required');
			$('#ocultarTR4').css('display','none');

			$('#claseproceso').css('display','none').removeClass('required');
			$('#ocultarTR6').css('display','none');

			$('#claseproceso2').css('display','block').addClass('required');
			$('#ocultarTR8').css('display','table-row');

			$('#entidadcomisiona').css('display','block').addClass('required');
			$('#ocultarTR9').css('display','table-row');

			$('#asunto').css('display','block').addClass('required');
			$('#ocultarTR10').css('display','table-row');

			$('#despacholibra').css('display','block').addClass('required');
			$('#ocultarTR11').css('display','table-row');

			$('#radicadox').css('display','block').removeClass('number').removeAttr('readonly');
			$('#ocultarTRx5').css('display','table-row');

			$('#observacionx').css('display','block').addClass('required');
			$('#ocultarTR7').css('display','table-row');
	} else {
			$('#year').css('display','block').addClass('required');
			$('#ocultarTR1').css('display','table-row');

			$('#consecutivo').css('display','block').addClass('required').addClass('number');
			$('#ocultarTR2').css('display','table-row');

			$('#instancia').css('display','block').addClass('required');
			$('#ocultarTR3').css('display','table-row');

			$('#juzgadoorigenmodificar').css('display','block').addClass('required');
			$('#ocultarTR4').css('display','table-row');

			$('#claseproceso').css('display','block').addClass('required');
			$('#ocultarTR6').css('display','table-row');

			$('#claseproceso2').css('display','none').removeClass('required');
			$('#ocultarTR8').css('display','none');

			$('#entidadcomisiona').css('display','none').removeClass('required');
			$('#ocultarTR9').css('display','none');

			$('#asunto').css('display','none').removeClass('required');
			$('#ocultarTR10').css('display','none');

			$('#despacholibra').css('display','none').removeClass('required');
			$('#ocultarTR11').css('display','none');

			$('#observacionx').css('display','block').addClass('required');
			$('#ocultarTR7').css('display','table-row');

			$('#radicadox').css('display','block').addClass('number').attr('readonly');
			$('#ocultarTRx5').css('display','table-row');
			}
		} else {	
			//alert("no existe");	
			$("#idradicado").val('');
			/*$("#claseproceso2").val('');
			$("#entidadcomisiona").val('');
			$("#asunto").val('');
			$("#despacholibra").val('');*/

			document.getElementById('year').selectedIndex = 0;
			$('#year').hide();

			$("#consecutivo").val('');
			$('#consecutivo').hide();

			document.getElementById('instancia').selectedIndex = 0;
			$('#instancia').hide();

			//document.getElementById('juzgadoorigen').selectedIndex = 0;
			//$('#juzgadoorigen').hide();
			
			document.getElementById('juzgadoorigenmodificar').selectedIndex = 0;
			$('#juzgadoorigenmodificar').hide();

			$("#radicadox").val('');
			$('#radicadox').hide();

			document.getElementById('claseproceso').selectedIndex = 0;
			$('#claseproceso').hide();

			/*$('#claseproceso2').hide();
			$('#observacionx').hide();
			$('#radicadox').hide();
			$('#ocultarTR7').hide();
			$('#ocultarTR8').hide();
			$('#ocultarTR9').hide();
			$('#ocultarTR10').hide();
			$('#ocultarTR11').hide();*/

			Eliminar_Tabla();				
		}
	});
}

function Traer_Datos_Parte_Direcciones(idvalor){
	
	$.get("funciones/traer_datos_parte_direcciones.php?idvalor="+idvalor, function(cadena){
	
		var datos = cadena.split("******");
	
		//alert(cadena);
		
		var vector_datos = datos[0].split("//////");
		
		//alert (vector_datos.length);
		//alert (datos[1]);
		//alert(vector_datos[3]);
		if(vector_datos.length >= 11){
			
			
			//CAMPO OCULTO CON EL ID DE PARTE
			$("#idparteproceso").val(vector_datos[0]);
			
			$("#documentox").val(vector_datos[2]);
			$("#documento2x").val(vector_datos[2]);
			$("#nombrex").val(vector_datos[3]);
			$("#nombre2x").val(vector_datos[3]);
			$("#datosadicionales").val(vector_datos[11]);
			
			
			//alert(datos[1]);
			Adicionar_Parte_Tabla_Parte_Direcciones(cadena);
			
		}
		else{
			
			$("#idparteproceso").val('');
			
			$("#documento2x").val('');
			$("#nombrex").val('');
			
			Eliminar_Tabla();
		}
		
	});

}

function Adicionar_Parte_Tabla_Parte_Direcciones(datostabla,iddevoclucion,nombredevolucion){
	
	        var resultado = datostabla.split("******");
		
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
					
					
					tabla+='<td>'+resultado2[1]+'</td>';
					
					tabla+='<td>'+resultado2[8]+'</td>';
					
					tabla+='<td>'+resultado2[2]+'</td>';
					
					tabla+='<td>'+resultado2[3]+'</td>';
					
					tabla+='<td>'+resultado2[4]+'</td>';
					
					tabla+='<td>'+resultado2[5]+'</td>';
					
					tabla+='<td>'+resultado2[6]+'</td>';
					
					tabla+='<td>'+resultado2[7]+'</td>';
					
					tabla+='<td><button type=button name=btdireccion id=btdireccion onclick="Modificar_Direccion(this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/direccion.png" width="40" height="40" title="MODIFICAR DIRECCION"/></button></td>';
					
					/*if(resultado2[9] == 0){
						tabla+='<td><button type=button name=btdireccion id=btdireccion onclick="Modificar_Direccion(this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/direccion.png" width="40" height="40" title="MODIFICAR DIRECCION"/></button></td>';
					}
					else{
						tabla+='<td>'+resultado2[10]+'</td>';
					}*/
					
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
			
					tabla+='<td>'+resultado2[1]+'</td>';
					
					tabla+='<td>'+resultado2[8]+'</td>';
					
					tabla+='<td>'+resultado2[2]+'</td>';
					
					tabla+='<td>'+resultado2[3]+'</td>';
					
					tabla+='<td>'+resultado2[4]+'</td>';
					
					tabla+='<td>'+resultado2[5]+'</td>';
					
					tabla+='<td>'+resultado2[6]+'</td>';
					
					tabla+='<td>'+resultado2[7]+'</td>';
					
					tabla+='<td><button type=button name=btdireccion id=btdireccion onclick="Modificar_Direccion(this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/direccion.png" width="40" height="40" title="MODIFICAR DIRECCION"/></button></td>';
					
					/*if(resultado2[9] == 0){
						tabla+='<td><button type=button name=btdireccion id=btdireccion onclick="Modificar_Direccion(this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/direccion.png" width="40" height="40" title="MODIFICAR DIRECCION"/></button></td>';
					}
					else{
						tabla+='<td>'+resultado2[10]+'</td>';
					}*/
					
					tabla+='</tr></table>';
				
					//alert(tabla);
					document.getElementById('cont2').innerHTML=tabla;
					
					
				}
				
			}
			
	
	
}

function Adicionar_Parte_Tabla_Observaciones(datostabla){
	
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
					
					
					tabla+='<td>'+resultado2[0]+'</td>';
					
					tabla+='<td>'+resultado2[1]+'</td>';
					
		
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
			
					tabla+='<td>'+resultado2[0]+'</td>';
					
					tabla+='<td>'+resultado2[1]+'</td>';
					
		
					tabla+='</tr></table>';
				
					//alert(tabla);
					document.getElementById('cont2').innerHTML=tabla;
					
					
				}
				
			}
			
}

function Modificar_Direccion(idfila){

	//alert(idfila);
	
	var dx1  = document.getElementById("t2").rows[idfila].cells[0].innerText;
	
	//alert(dx1);
	
	location.href="index.php?controller=signot&action=Modificar_Direccion&dx1="+dx1;

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

function Cargar_Pa_Modulo_Acciones(){
	
	$.get("funciones/traer_datos_pa_modulos_acciones.php?idvalor="+1, function(cadena){
	
		datosacciones = cadena.split("////");
		var longitud  = datosacciones.length;
		
		//arrayRapido   = "["+datosacciones+"]";
		
		arrayRapido = new Array(); 
		
		for (i=0; i<longitud; i++){ 
		
   			arrayRapido[i] = datosacciones[i];
		}
	
	});
}

function Buscar_Vector(idclase){
	
	   //alert(arrayRapido);
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




//PROCESOS PARA NO RECARGAR PAGINA ESTILO JOOMLA EN PROCESO DE CONSTRUCCION

function Adicionar_Direccion_Parte(){
	
	//alert(1);
	
	if (document.formdir.idpartex.value.length     == 0 || 
		document.formdir.idpartex.value.length     == 0 ||
		document.formdir.direccion.value.length    == 0 ||
		document.formdir.telefono.value.length     == 0 ||
	    document.formdir.departamento.value.length == 0 ||
		document.formdir.municipio.value.length    == 0
		
	){
			
       			alert("Campos Sin Definir");
				//document.getElementById('idpartex').style.borderColor='#FF0000';
       			
	}
	else{
		
		if (confirm ("Esta Seguro de Adicionar Direccion")) {
		
		
		
			var dir1 = document.formdir.idprocesox.value;
			var dir2 = document.formdir.idpartex.value;
			var dir3 = document.formdir.direccion.value;
			var dir4 = document.formdir.telefono.value;
			var dir5 = document.formdir.departamento.value;
			var dir6 = document.formdir.municipio.value;  
			
			var datosdir = dir1+"////"+dir2+"////"+dir3+"////"+dir4+"////"+dir5+"////"+dir6;
			
			//alert(datosdir);
			
			
			Adicionar_Direccion_Parte_2(datosdir);
		
		} 
	
	}
	
		
}


function Adicionar_Direccion_Parte_2(datosdir){
		
		oXML = AJAXCrearObjeto();
		//oXML.open('GET', 'index.php?option=com_bmd&controller=Ajax&no_html=1&task=EliminarModulosUsuario&pos= '+moduloseliminar);
		
		oXML.open('GET', 'index.php?controller=signot&action=Adicionar_Direccion_2&datosdir= '+datosdir);
		oXML.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		oXML.onreadystatechange = Leer_Adicionar_Direccion_Parte_3;
		oXML.send(' ');
		
}


function Leer_Adicionar_Direccion_Parte_3(){
			
	if (oXML.readyState  == 4) {
					
		//alert (oXML.responseText);
		resultado = eval('(' + oXML.responseText + ')');
		
		//alert (resultado);
		
		if(resultado == 0){
			
			alert ("Direccion Adicionada");
			
		}
		else{
			alert ("Error al Adicionar Direccion...");
			
		}
		
	}
}


