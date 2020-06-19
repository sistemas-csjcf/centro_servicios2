
//---------------------------------------
// Titulo: FUNCIONES DEL SISTEMA        |
// Autor:  Sebastián Martínez Valencia  |
// Fecha:  Julio del 2018               |
//---------------------------------------


// Función creación categorías
function Categ() {
	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}

	var categ   = encodeURIComponent(document.getElementById("categ").value);

	if (categ == ""){
		$('#resultctg').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultctg').html("Por favor ingrese un grupo.");
	}

	else{
		var objeto = {
			"categ":categ,
		}
		var obj = JSON.stringify(objeto);
		// Preparar la funcion de respuesta
		conexion.onreadystatechange = respuesta;

		// Realizar peticion HTTP
		conexion.open('POST', 'http://localhost/inventario/proc_categ.php');
		conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		conexion.send("objeto="+obj);
	}

	function respuesta() {
		if(conexion.readyState == 4) {
			if(conexion.status == 200) {
				if (conexion.responseText == true){
					document.getElementById("categ").value="";
					$('#resultctg').css({'border':'1px solid #d6e9c6','background-color':'#dff0d8','color':'#3c763d','padding':'5px'});
					$('#resultctg').html("Se ha registrado con éxito el grupo.");
					setTimeout ('reload()', 1000);
				}
				else{
					$('#resultctg').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
					$('#resultctg').html("Ocurrió un error, contacte al administrador.");
				}
			}
		}
	}
}

// Función creación proveedores
function Provee() {
	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}

	var nombrep   = encodeURIComponent(document.getElementById("nombrep").value);
	var nombrec = encodeURIComponent(document.getElementById("nombrec").value);
	var telefono = encodeURIComponent(document.getElementById("telefono").value);
	var celular = encodeURIComponent(document.getElementById("celular").value);
	var correo = decodeURIComponent(document.getElementById("correo").value);
	var direccion = encodeURIComponent(document.getElementById("direccion").value);
	var check_mail = true;

	function validar_email( email ) {
		var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email) ? true : false;
	}

	if (nombrep == "" || nombrec == "" || celular == ""){
		$('#resultprvr').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultprvr').html("Por favor complete los campos marcados como obligatorios.");
		check_mail = false;
	}

	else if(correo != ""){
		if (validar_email(correo)){
			check_mail = true;
		} else{
			$('#resultprvr').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
			$('#resultprvr').html("Intruduzca un formato de correo adecuado Ej: correo@dominio.com");
			check_mail = false;
		}
	}

	if (check_mail) {
		var objeto = {
			"nombrep":nombrep,
			"nombrec":nombrec,
			"telefono":telefono,
			"celular":celular,
			"correo":correo,
			"direccion":direccion
		}
		var obj = JSON.stringify(objeto);
		// Preparar la funcion de respuesta
		conexion.onreadystatechange = respuesta;

		// Realizar peticion HTTP
		conexion.open('POST', 'http://localhost/inventario/proc_prov.php');
		conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		conexion.send("objeto="+obj);

		function respuesta() {
			if(conexion.readyState == 4) {
				if(conexion.status == 200) {
					if (conexion.responseText == true){
						document.getElementById("nombrep").value="";
						document.getElementById("nombrec").value="";
						document.getElementById("telefono").value="";
						document.getElementById("celular").value="";
						document.getElementById("correo").value="";
						document.getElementById("direccion").value="";
						$('#resultprvr').css({'border':'1px solid #d6e9c6','background-color':'#dff0d8','color':'#3c763d','padding':'5px'});
						$('#resultprvr').html("Se ha registrado con éxito el proveedor.");
					}
					else{
						$('#resultprvr').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
						$('#resultprvr').html("Ocurrió un error, contacte al administrador.");
					}
				}
			}
		}
	}
}

//Función verificar exitencia de referencia.
function ref(){

	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}

	var referencia = encodeURIComponent(document.getElementById("cod_ref").value);

	var objeto = {
		"referencia":referencia,
	}

	var obj = JSON.stringify(objeto);

	// Preparar la funcion de respuesta
	conexion.onreadystatechange = respuesta;

	// Realizar peticion HTTP
	conexion.open('POST', 'http://localhost/inventario/proc_ref.php');
	conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	conexion.send("objeto="+obj);

	function respuesta() {
		if(conexion.readyState == 4) {
			if(conexion.status == 200) {
				if (conexion.responseText == 1){
					$('#resultref').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
					$('#resultref').html("Ya existe una referencia idéntica registrada.");
					document.getElementById("referencia").value = 0;
				}
				else if (conexion.responseText == 0){
					$('#resultref').css({'border':'0px','background-color':'transparent','color':'transparent','padding':'0px'});
					$('#resultref').html("");
					document.getElementById("referencia").value = 1;
				}
				else if (conexion.responseText == false){
					$('#resultref').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
					$('#resultref').html("Ocurrió un error, contacte al administrador.");
				}
			}
		}
	}

}

//Función verificar exitencia de cliente.
function ced(){

	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}

	var referencia = encodeURIComponent(document.getElementById("cedulaM").value);

	var objeto = {
		"referencia":referencia,
	}

	var obj = JSON.stringify(objeto);

	// Preparar la funcion de respuesta
	conexion.onreadystatechange = respuesta;

	// Realizar peticion HTTP
	conexion.open('POST', 'http://localhost/inventario/proc_ced.php');
	conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	conexion.send("objeto="+obj);

	function respuesta() {
		if(conexion.readyState == 4) {
			if(conexion.status == 200) {
				if (conexion.responseText == 1){
					$('#resultced').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
					$('#resultced').html("Éste número de cédula ya se encuentra registrado.");
					document.getElementById("referenciaCliente").value = 0;
				}
				else if (conexion.responseText == 0){
					$('#resultced').css({'border':'0px','background-color':'transparent','color':'transparent','padding':'0px'});
					$('#resultced').html("");
					document.getElementById("referenciaCliente").value = 1;
				}
				else if (conexion.responseText == false){
					$('#resultced').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
					$('#resultced').html("Ocurrió un error, contacte al administrador.");
				}
			}
		}
	}

}

// Función creación producto
function Product(formV) {

	var referencia   = encodeURIComponent(document.getElementById("referencia").value);
	var proveedor   = encodeURIComponent(document.getElementById("proveedor").value);
	var tipo   = encodeURIComponent(document.getElementById("tipo").value);
	var nombre = encodeURIComponent(document.getElementById("nombre").value);
	var cantidad = encodeURIComponent(document.getElementById("cantidad").value);
	var valorI = encodeURIComponent(document.getElementById("valorI").value);
	var iva = encodeURIComponent(document.getElementById("ivas").value);
	var porcen = encodeURIComponent(document.getElementById("porcen").value);
	var imagen = document.getElementById("imagen").value;
	var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
	var form = 1;

	if (referencia == 0){
		form = 0;
	}

	else if (proveedor == "Seleccione"){
		document.location.href="#top";
		$('#resultprdct').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultprdct').html("Debe seleccionar un proveedor.");
		form = 0;
	}

	else if (tipo == "Seleccione"){
		document.location.href="#top";
		$('#resultprdct').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultprdct').html("Debe seleccionar un grupo para el producto.");
		form = 0;
	}

	else if (cantidad == ""){
		document.location.href="#top";
		$('#resultprdct').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultprdct').html("La cantidad que recibe de un producto, no puede ir vacía.");
		form = 0;
	}

	else if (cantidad < 0){
		document.location.href="#top";
		$('#resultprdct').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultprdct').html("No puede introducir cantidades negativas.");
		form = 0;
	}

	else if (isNaN(cantidad) == true){
		document.location.href="#top";
		$('#resultprdct').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultprdct').html("No puede introducir caracteres en la cantidad del producto.");
		form = 0;
	}

	else if(nombre == "" || valorI == ""){
		document.location.href="#top";
		$('#resultprdct').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultprdct').html("Por favor complete los campos marcados como obligatorios.");
		form = 0;
	}

	else if (iva == "Seleccione"){
		document.location.href="#top";
		$('#resultprdct').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultprdct').html("Por favor seleccione una opción en el Iva.");
		form = 0;
	}

	else if (isNaN(valorI) == true){
		document.location.href="#top";
		$('#resultprdct').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultprdct').html("Debe ingresar un valor numérico en el valor de inversión.");
		form = 0;
	}

	else if (parseInt(valorI) < 1){
		document.location.href="#top";
		$('#resultprdct').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultprdct').html("Debe ingresar un valor numérico positivo en el valor de inversión.");
		form = 0;
	}

	else if (isNaN(porcen) == true || porcen == ""){
		document.location.href="#top";
		$('#resultprdct').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultprdct').html("El porcentaje de descuento debe ser un valor numérico o 0 si no aplica.");
		form = 0;
	}

	else if(imagen != "" && !allowedExtensions.exec(imagen)){
		$('#resultprdct').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultprdct').html("La extención de la imagen debe ser;  .jpg, .jpeg, .png o .gif.");
		form = 0;
	}

	else if(form == 1){
		if(formV == 'product'){
			document.getElementById("form_prod").submit();
		}else if(formV == 'uproduct'){
			document.getElementById("form_uprod").submit();
		}
	}

}

// Función capturar datos para edición de categorías
function capdataupdcateg(idp){

	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var tabla = "categoria";
	var id= idp;
	var objeto = {
		"id":id,
		"tabla":tabla
	}
	var obj = JSON.stringify(objeto);
	// Preparar la funcion de respuesta
	conexion.onreadystatechange = respuesta;

	// Realizar peticion HTTP
	conexion.open('POST', 'http://localhost/inventario/proc_select.php');
	conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	conexion.send("objeto="+obj);

	function respuesta() {
		if(conexion.readyState == 4) {
			if(conexion.status == 200) {
				if (conexion.responseText == false){
					alert("Ocurrió un error, contacte al administrador.");
				}
				else{
					var ArrayObject = JSON.parse(conexion.responseText );
					document.getElementById("idc").value= ArrayObject.id ;
					document.getElementById("catego").value= ArrayObject.categoria ;
				}
			}
		}
	}
}

// Función capturar datos para edición
function capdataupd(idp){

	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var tabla = "producto";
	var id = idp;
	if(idp <= 9){
		id = "00"+idp;
	}
	else if(idp > 9 && idp <= 99){
		id = "0"+idp;
	}

	var objeto = {
		"id":id,
		"tabla":tabla
	}
	var obj = JSON.stringify(objeto);
	// Preparar la funcion de respuesta
	conexion.onreadystatechange = respuesta;

	// Realizar peticion HTTP
	conexion.open('POST', 'http://localhost/inventario/proc_select.php');
	conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	conexion.send("objeto="+obj);

	function respuesta() {
		if(conexion.readyState == 4) {
			if(conexion.status == 200) {
				if (conexion.responseText == false){
					alert("Ocurrió un error, contacte al administrador.");
				}
				else{
					var ArrayObject = JSON.parse(conexion.responseText );
					document.getElementById("idp").value= ArrayObject.id ;
					document.getElementById("proveedor").value= ArrayObject.proveedor ;
					document.getElementById("tipo").value= ArrayObject.tipo ;
					document.getElementById("cod_ref").value= ArrayObject.cod_ref ;
					document.getElementById("nombre").value= ArrayObject.nombre ;
					document.getElementById("cantidad").value= ArrayObject.cantidad ;
					document.getElementById("iconForm").setAttribute("src", "http://localhost/inventario/images/"+ArrayObject.imagen);
					//$("iconForm").attr("src","http://localhost/inventario/images/"+ArrayObject.imagen);
					document.getElementById("valorI").value= ArrayObject.valor_inversion;
					document.getElementById("ivas").value= ArrayObject.iva;
					document.getElementById("porcen").value= ArrayObject.por_dcto;
					document.getElementById("descripcion").value= ArrayObject.descripcion;
				}
			}
		}
	}
}

// Función capturar datos para edición de cliente
function capdataucl(idp){

	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var tabla = "cliente";
	var id = idp;
	if(idp <= 9){
		id = "00"+idp;
	}
	else if(idp > 9 && idp <= 99){
		id = "0"+idp;
	}

	var objeto = {
		"id":id,
		"tabla":tabla
	}
	var obj = JSON.stringify(objeto);
	// Preparar la funcion de respuesta
	conexion.onreadystatechange = respuesta;

	// Realizar peticion HTTP
	conexion.open('POST', 'http://localhost/inventario/proc_select.php');
	conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	conexion.send("objeto="+obj);

	function respuesta() {
		if(conexion.readyState == 4) {
			if(conexion.status == 200) {
				if (conexion.responseText == false){
					alert("Ocurrió un error, contacte al administrador.");
				}
				else{
					var ArrayObject = JSON.parse(conexion.responseText );
					document.getElementById("idcl").value= ArrayObject.id ;
					document.getElementById("nombre").value= ArrayObject.nombre ;
					document.getElementById("apellidos").value= ArrayObject.apellidos ;
					document.getElementById("cedulaM").value= ArrayObject.cedula ;
					document.getElementById("celular").value= ArrayObject.celular ;
					document.getElementById("correo").value= ArrayObject.correo;
				}
			}
		}
	}
}

// Función capturar datos para proveedor
function capdataupdprov(id){

	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var tabla = "proveedor";

	var objeto = {
		"id":id,
		"tabla":tabla
	}
	var obj = JSON.stringify(objeto);
	// Preparar la funcion de respuesta
	conexion.onreadystatechange = respuesta;

	// Realizar peticion HTTP
	conexion.open('POST', 'http://localhost/inventario/proc_select.php');
	conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	conexion.send("objeto="+obj);

	function respuesta() {
		if(conexion.readyState == 4) {
			if(conexion.status == 200) {
				if (conexion.responseText == false){
					alert("Ocurrió un error, contacte al administrador.");
				}
				else{
					var ArrayObject = JSON.parse(conexion.responseText );
					document.getElementById("id").value= ArrayObject.id ;
					document.getElementById("nombrep").value= ArrayObject.nombre_proveedor ;
					document.getElementById("nombrec").value= ArrayObject.nombre_contacto ;
					document.getElementById("telefono").value= ArrayObject.telefono;
					document.getElementById("celular").value= ArrayObject.celular;
					document.getElementById("correo").value= ArrayObject.correo;
					document.getElementById("direccion").value= ArrayObject.direccion;
				}
			}
		}
	}
}

// Función ediciòn categoria
function UpdateCateg() {
	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var id = encodeURIComponent(document.getElementById("idc").value);
	var categ = encodeURIComponent(document.getElementById("catego").value);

	if (categ == ""){
		$('#result2').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#result2').html("Por favor complete la información marcada como obligatoria.");
	}

	else{
		var objeto = {
			"id":id,
			"categ":categ,
		}
		var obj = JSON.stringify(objeto);
		// Preparar la funcion de respuesta
		conexion.onreadystatechange = respuesta;

		// Realizar peticion HTTP
		conexion.open('POST', 'http://localhost/inventario/proc_updcateg.php');
		conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		conexion.send("objeto="+obj);
	}

	function respuesta() {
		if(conexion.readyState == 4) {
			if(conexion.status == 200) {
				if (conexion.responseText == true){
					document.getElementById("catego").disabled = true;
					var boton = document.getElementById('updpr');
					boton.disabled = true;
					$('#result2').css({'border':'1px solid #d6e9c6','background-color':'#dff0d8','color':'#3c763d','padding':'5px'});
					$('#result2').html("Se ha actualizado con éxito el nombre del grupo.");
				}
				else{
					if(conexion.responseText == false){
						$('#result2').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
						$('#result2').html("Ocurrió un error, contacte al administrador.");
					}
					else{
						$('#result2').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
						$('#result2').html("Debe realizar un cambio para actualizar el grupo seleccionado.");
					}
				}
			}
		}
	}
}

// Función ediciòn proveedor
function UpdateProv() {
	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var id = document.getElementById("id").value;
	var nombrep = document.getElementById("nombrep").value;
	var nombrec = document.getElementById("nombrec").value;
	var telefono = document.getElementById("telefono").value;
	var celular = document.getElementById("celular").value;
	var correo = document.getElementById("correo").value;
	var direccion = document.getElementById("direccion").value;
	var check_mail = true;

	function validar_email( email ) {
		var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email) ? true : false;
	}


	if (nombrep == "" || nombrec == "" || celular == ""){
		$('#resultupdtprv').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultupdtprv').html("Por favor complete los campos marcados como obligatorios.");
	}

	else if(correo != ""){
		if (validar_email(correo)){
			check_mail = true;
		} else{
			$('#resultupdtprv').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
			$('#resultupdtprv').html("Intruduzca un formato de correo adecuado Ej: correo@dominio.com");
			check_mail = false;
		}
	}

	if (check_mail) {
		var objeto = {
			"id":id,
			"nombrep":nombrep,
			"nombrec":nombrec,
			"telefono":telefono,
			"celular":celular,
			"correo":correo,
			"direccion":direccion
		}
		var obj = JSON.stringify(objeto);
		// Preparar la funcion de respuesta
		conexion.onreadystatechange = respuesta;

		// Realizar peticion HTTP
		conexion.open('POST', 'http://localhost/inventario/proc_upd_prov.php');
		conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		conexion.send("objeto="+obj);

		function respuesta() {
			if(conexion.readyState == 4) {
				if(conexion.status == 200) {
					if (conexion.responseText == true){
						document.getElementById("nombrep").disabled = true;
						document.getElementById("nombrec").disabled = true;
						document.getElementById("telefono").disabled = true;
						document.getElementById("celular").disabled = true;
						document.getElementById("correo").disabled = true;
						document.getElementById("direccion").disabled = true;
						var boton = document.getElementById('updpr');
						boton.disabled = true;
						$('#resultupdtprv').css({'border':'1px solid #d6e9c6','background-color':'#dff0d8','color':'#3c763d','padding':'5px'});
						$('#resultupdtprv').html("Se ha actualizado con éxito el proveedor.");
					}
					else{
						if(conexion.responseText == false){
							$('#resultupdtprv').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
							$('#resultupdtprv').html("Ocurrió un error, contacte al administrador.");
						}
						else{
							$('#resultupdtprv').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
							$('#resultupdtprv').html("Debe realizar un cambio para actualizar el proveedor.");
						}
					}
				}
			}
		}
	}
}

// Función ediciòn cliente
function UpdPerson() {
	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var id = encodeURIComponent(document.getElementById("idcl").value);
	var nombre = encodeURIComponent(document.getElementById("nombre").value);
	var apellidos = encodeURIComponent(document.getElementById("apellidos").value);
	var cedula = encodeURIComponent(document.getElementById("cedulaM").value);
	var celular = encodeURIComponent(document.getElementById("celular").value);
	var correo = document.getElementById("correo").value;

	function validar_email( email ) {
		var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email) ? true : false;
	}

	if (nombre == "" || apellidos == "" || cedula == ""){
		$('#resultnvclnt').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultnvclnt').html("Por favor complete los campos marcados como obligatorios.");
	}

	else if (isNaN(cedula) == true){
		$('#resultnvclnt').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultnvclnt').html("El campo (cédula) solo puede contener números.");
	}

	else if (!validar_email(correo)){
		$('#resultnvclnt').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultnvclnt').html("Intruduzca un formato de correo adecuado Ej: correo@dominio.com");
	}

	else {
		var objeto = {
			"id":id,
			"nombre":nombre,
			"apellidos":apellidos,
			"cedula":cedula,
			"celular":celular,
			"correo":correo
		}
		var obj = JSON.stringify(objeto);
		// Preparar la funcion de respuesta
		conexion.onreadystatechange = respuesta;

		// Realizar peticion HTTP
		conexion.open('POST', 'http://localhost/inventario/proc_updCustomer.php');
		conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		conexion.send("objeto="+obj);
	}

	function respuesta() {
		if(conexion.readyState == 4) {
			if(conexion.status == 200) {
				if (conexion.responseText == true){
					document.getElementById("idcl").disabled = true;
					document.getElementById("nombre").disabled = true;
					document.getElementById("apellidos").disabled = true;
					document.getElementById("cedulaM").disabled = true;
					document.getElementById("celular").disabled = true;
					document.getElementById("correo").disabled = true;
					document.getElementById('updcl');
					var boton = document.getElementById('updcl');
					boton.disabled = true;
					$('#resultnvclnt').css({'border':'1px solid #d6e9c6','background-color':'#dff0d8','color':'#3c763d','padding':'5px'});
					$('#resultnvclnt').html("Se ha actualizado con éxito la información del cliente.");
				}
				else{
					if(conexion.responseText == false){
						$('#resultnvclnt').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
						$('#resultnvclnt').html("Ocurrió un error, contacte al administrador.");
					}
					else{
						$('#resultnvclnt').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
						$('#resultnvclnt').html("Debe realizar un cambio para actualizar la información del cliente.");
					}
				}
			}
		}
	}
}

//Funciòn eliminar
function Delete(idp, table){
	var stat = confirm("¿Está seguro de eliminar el registro?");
	if (stat == false){

	}
	else{
		// Obtener la instancia del objeto XMLHttpRequest
		if(window.XMLHttpRequest) {
			conexion = new XMLHttpRequest();
		}
		else if(window.ActiveXObject) {
			conexion = new ActiveXObject("Microsoft.XMLHTTP");
		}
		var tabla = table;
		var id = idp;
		if(idp <= 9){
			id = "00"+idp;
		}
		else if(idp > 9 && idp <= 99){
			id = "0"+idp;
		}

		var objeto = {
			"id":id,
			"tabla":tabla
		}
		var obj = JSON.stringify(objeto);
		// Preparar la funcion de respuesta
		conexion.onreadystatechange = respuesta;

		// Realizar peticion HTTP
		conexion.open('POST', 'http://localhost/inventario/proc_delete.php');
		conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		conexion.send("objeto="+obj);

		function respuesta() {
			if(conexion.readyState == 4) {
				if(conexion.status == 200) {
					if (conexion.responseText == true){
						if(tabla == "tmp_sale"){
							$('#'+idp).remove();
							if ($(".rmv").length == 0){
								$('#tmp_saleF').remove();
								document.getElementById("FdP").disabled = false;
							}
						} else if(tabla == "tmp_tras"){
							$('#'+idp).remove();
							if ($(".rmv").length == 0){
								$('#tmp_trasF').remove();
								document.getElementById("traslado").disabled = false;
							}
						} else if(tabla == "tmp_garantia"){
							$('#'+idp).remove();
							if ($(".rmv").length == 0){
								$('#tmp_gar').remove();
								document.getElementById("cliente").disabled = false;
								document.getElementById("cliente").value = "";
								document.getElementById("clienteA").disabled = false;
								document.getElementById("cedula").disabled = false;
								document.getElementById("cedula").value = "";
								document.getElementById("producto").value = "Seleccione";
								document.getElementById("marca").value = "";
								document.getElementById("unidades").value = "1";
								document.getElementById("repair").value = "Seleccione";
							}
						} else if(tabla == "tmp_prest"){
							$('#'+idp).remove();
							if ($(".rmv").length == 0){
								$('#tmp_pres').remove();
								document.getElementById("quien").disabled = false;
								document.getElementById("quien").value = "";
								document.getElementById("producto").value = "Seleccione";
								document.getElementById("PdP").value = "Seleccione";
								document.getElementById("unidades").value = "1";
								document.getElementById("precio").value = "";
							}
						}
						else{
							reload();
						}
					}
					else{
						alert("Ocurrió un error, contacte al administrador.");
					}
				}
			}
		}

	}
}

//Funciòn que bloque el formulario de almacen si no existen productos.
function block(){
	document.getElementById("id_producto").disabled = true;
	document.getElementById("cantidad").disabled = true;
	var boton = document.getElementById('almacbut');
	boton.disabled = true;
}

//Funciòn almacenar producto en almacen
function Almac(){
	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var idp = encodeURIComponent(document.getElementById("id_producto").value);
	var cantidad = encodeURIComponent(document.getElementById("cantidad").value);

	if(idp == "Seleccione" || cantidad == ""){
		$('#result').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#result').html("Por favor complete los campos marcados como obligatorios.");
	}

	else{
		var id = idp;
		if(idp <= 9){
			id = "00"+idp;
		}
		else if(idp > 9 && idp <= 99){
			id = "0"+idp;
		}
		else if(idp > 99){
			id = idp;
		}
		var objeto = {
			"id_producto":id,
			"cantidad":cantidad
		}
		var obj = JSON.stringify(objeto);
		// Preparar la funcion de respuesta
		conexion.onreadystatechange = respuesta;

		// Realizar peticion HTTP
		conexion.open('POST', 'http://localhost/inventario/proc_almac.php');
		conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		conexion.send("objeto="+obj);
	}

	function respuesta() {
		if(conexion.readyState == 4) {
			if(conexion.status == 200) {
				if (conexion.responseText == true){
					document.getElementById("id_producto").disabled = true;
					document.getElementById("id_producto").value = "Seleccione";
					document.getElementById("cantidad").value = "";
					$('#result').css({'border':'1px solid #d6e9c6','background-color':'#dff0d8','color':'#3c763d','padding':'5px'});
					$('#result').html("Se ha almacenado con éxito el producto.");
					setTimeout ('reload()', 1700);
				}
				else{
					$('#result').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
					$('#result').html("Ocurrió un error, contacte al administrador.");
				}
			}
		}
	}
}

//funcion validar buscador productos
function searc(tipo){
	var tipoB = tipo;
	var search = encodeURIComponent(document.getElementById("search").value);
	if(search == ""){
		searching("", tipoB);
	}
	else{
		searching(search, tipoB);
	}
}

//Función buscar en datagrid productos
function searching(search, tipoB){
	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}
	// Obtener la instancia del objeto XMLHttpRequest

	var objeto = {
		"search":search,
		"tipo":tipoB
	}
	var obj = JSON.stringify(objeto);
	// Preparar la funcion de respuesta
	conexion.onreadystatechange = respuesta;

	// Realizar peticion HTTP
	conexion.open('POST', 'http://localhost/inventario/search.php');
	conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	conexion.send("objeto="+obj);


	function respuesta() {
		if(conexion.readyState == 4) {
			if(conexion.status == 200) {
				if (conexion.responseText != 0){
					var result = JSON.parse(conexion.responseText);
					$('#printTable').html(result);
				}
				else{
					$('#resultS').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
					$('#resultS').html("Ninguna coincidencia.");
					window.setTimeout(limpiarS, 2500);
				}
			}
			else{
				$('#resultS').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
				$('#resultS').html("Ocurrió un error, contacte al administrador.");
			}
		}
	}
}

//funcion validar buscador clientes
function searcCl(){
	var search = encodeURIComponent(document.getElementById("search").value);
	if(search == ""){
		searchingCl("");
	}
	else{
		searchingCl(search);
	}
}

//Función buscar en datagrid clientes
function searchingCl(search){
	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}
	// Obtener la instancia del objeto XMLHttpRequest

	var objeto = {
		"search":search
	}
	var obj = JSON.stringify(objeto);
	// Preparar la funcion de respuesta
	conexion.onreadystatechange = respuesta;

	// Realizar peticion HTTP
	conexion.open('POST', 'http://localhost/inventario/searchCl.php');
	conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	conexion.send("objeto="+obj);


	function respuesta() {
		if(conexion.readyState == 4) {
			if(conexion.status == 200) {
				if (conexion.responseText != 0){
					var result = JSON.parse(conexion.responseText);
					$('#printTable').html(result);
				}
				else{
					$('#resultS').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
					$('#resultS').html("Ninguna coincidencia.");
					window.setTimeout(limpiarS, 2500);
				}
			}
			else{
				$('#resultS').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
				$('#resultS').html("Ocurrió un error, contacte al administrador.");
			}
		}
	}
}

//funcion validar buscador ventas
function searcSale(){
	var fecha = decodeURIComponent(document.getElementById("fecha").value);
	if(fecha == ""){
		window.setTimeout(limpiarRem, 0000);
		searchingSale("");
	}
	else{
		searchingSale(fecha);
	}
}

//Función buscar en datagrid ventas
function searchingSale(fecha){
	if(fecha != ""){
		// Obtener la instancia del objeto XMLHttpRequest
		if(window.XMLHttpRequest) {
			conexion = new XMLHttpRequest();
		}
		else if(window.ActiveXObject) {
			conexion = new ActiveXObject("Microsoft.XMLHTTP");
		}
		// Obtener la instancia del objeto XMLHttpRequest

		var objeto = {
			"fecha":fecha
		}
		var obj = JSON.stringify(objeto);
		// Preparar la funcion de respuesta
		conexion.onreadystatechange = respuesta;

		// Realizar peticion HTTP
		conexion.open('POST', 'http://localhost/inventario/search-sale.php');
		conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		conexion.send("objeto="+obj);


		function respuesta() {
			if(conexion.readyState == 4) {
				if(conexion.status == 200) {
					if (conexion.responseText != 0){
						var result = JSON.parse(conexion.responseText);
						$('#printSale').css({'width':'233px', 'height':'50px','margin-left':'10px','margin-bottom':'2px','border':'0px none','background-color':'f2dede','padding':'5px','overflow-y':'scroll'});
						$('#printSale').html(result);
					}
					else{
						$('#resultSale').css({'display':'block','border':'1px solid #ebccd1','background-color':'rgb(242, 222, 222)','color':'rgb(169, 68, 66)'});
						$('#resultSale').html("Ninguna coincidencia.");
						window.setTimeout(limpiarRem, 3500);
					}
				}
				else{
					$('#resultSale').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
					$('#resultSale').html("Ocurrió un error, contacte al administrador.");
				}
			}
		}

	}else{
		window.setTimeout(limpiarRem, 0000);
	}
}

//funcion validar buscador traslados
function searcTransfer(){
	var fecha = decodeURIComponent(document.getElementById("fechaT").value);
	if(fecha == ""){
		window.setTimeout(limpiarTras, 0000);
		searchingTransfer("");
	}
	else{
		searchingTransfer(fecha);
	}
}

//Función buscar en datagrid traslados
function searchingTransfer(fecha){
	if(fecha != ""){
		// Obtener la instancia del objeto XMLHttpRequest
		if(window.XMLHttpRequest) {
			conexion = new XMLHttpRequest();
		}
		else if(window.ActiveXObject) {
			conexion = new ActiveXObject("Microsoft.XMLHTTP");
		}
		// Obtener la instancia del objeto XMLHttpRequest

		var objeto = {
			"fecha":fecha
		}
		var obj = JSON.stringify(objeto);
		// Preparar la funcion de respuesta
		conexion.onreadystatechange = respuesta;

		// Realizar peticion HTTP
		conexion.open('POST', 'http://localhost/inventario/search-transfer.php');
		conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		conexion.send("objeto="+obj);


		function respuesta() {
			if(conexion.readyState == 4) {
				if(conexion.status == 200) {
					if (conexion.responseText != 0){
						var result = JSON.parse(conexion.responseText);
						$('#printTrans').css({'width':'233px', 'height':'50px','margin-left':'10px','margin-bottom':'2px','border':'0px none','background-color':'f2dede','padding':'5px','overflow-y':'scroll'});
						$('#printTrans').html(result);
					}
					else{
						$('#resultTrans').css({'display':'block','border':'1px solid #ebccd1','background-color':'rgb(242, 222, 222)','color':'rgb(169, 68, 66)'});
						$('#resultTrans').html("Ninguna coincidencia.");
						window.setTimeout(limpiarTras, 3500);
					}
				}
				else{
					$('#resultTrans').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
					$('#resultTrans').html("Ocurrió un error, contacte al administrador.");
				}
			}
		}

	}else{
		window.setTimeout(limpiarTras, 0000);
	}
}

//funcion validar buscador clientes
function searcPerson(){
	var search = decodeURIComponent(document.getElementById("cliente").value);
	if(search == ""){
		window.setTimeout(limpiarC, 0000);
		searchingPerson("");
	}
	else{
		searchingPerson(search);
	}
}

//Función buscar en datagrid clientes
function searchingPerson(search){
	if(search != ""){
		// Obtener la instancia del objeto XMLHttpRequest
		if(window.XMLHttpRequest) {
			conexion = new XMLHttpRequest();
		}
		else if(window.ActiveXObject) {
			conexion = new ActiveXObject("Microsoft.XMLHTTP");
		}
		// Obtener la instancia del objeto XMLHttpRequest

		var objeto = {
			"search":search
		}
		var obj = JSON.stringify(objeto);
		// Preparar la funcion de respuesta
		conexion.onreadystatechange = respuesta;

		// Realizar peticion HTTP
		conexion.open('POST', 'http://localhost/inventario/search-client.php');
		conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		conexion.send("objeto="+obj);


		function respuesta() {
			if(conexion.readyState == 4) {
				if(conexion.status == 200) {
					if (conexion.responseText != 0){
						var result = JSON.parse(conexion.responseText);
						$('#printClient').css({'display':'block', 'position':'absolute', 'width':'233px', 'height':'100px', 'border':'1px solid #ebccd1','background-color':'#FFF','color':'#000', 'overflow-y':'scroll'});
						$('#printClient').html(result);
					}
					else{
						window.setTimeout(limpiarC, 0000);
						$('#resultS').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
						$('#resultS').html("Ninguna coincidencia.");
						window.setTimeout(limpiarS, 2500);
					}
				}
				else{
					$('#resultS').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
					$('#resultS').html("Ocurrió un error, contacte al administrador.");
				}
			}
		}

	}
}

//funcion validar buscador clientes
function searcCedul(){
	var search = decodeURIComponent(document.getElementById("cedula").value);
	if(search == ""){
		window.setTimeout(limpiarCed, 0000);
		searcCedula("");
	}
	else{
		searcCedula(search);
	}
}

//Función buscar en datagrid clientes
function searcCedula(search){
	if(search != ""){
		// Obtener la instancia del objeto XMLHttpRequest
		if(window.XMLHttpRequest) {
			conexion = new XMLHttpRequest();
		}
		else if(window.ActiveXObject) {
			conexion = new ActiveXObject("Microsoft.XMLHTTP");
		}
		// Obtener la instancia del objeto XMLHttpRequest

		var objeto = {
			"search":search
		}
		var obj = JSON.stringify(objeto);
		// Preparar la funcion de respuesta
		conexion.onreadystatechange = respuesta;

		// Realizar peticion HTTP
		conexion.open('POST', 'http://localhost/inventario/search-cedul.php');
		conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		conexion.send("objeto="+obj);


		function respuesta() {
			if(conexion.readyState == 4) {
				if(conexion.status == 200) {
					if (conexion.responseText != 0){
						var result = JSON.parse(conexion.responseText);
						$('#printC').css({'display':'block', 'position':'absolute', 'width':'233px', 'height':'100px', 'border':'1px solid #ebccd1','background-color':'#FFF','color':'#000', 'overflow-y':'scroll'});
						$('#printC').html(result);
					}
					else{
						limpiarCoin();
						$('#resultCed').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px' ,'display':'block'});
						$('#resultCed').html("Ninguna coincidencia.");
						window.setTimeout(limpiarCed, 2500);
					}
				}
				else{
					$('#resultCed').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
					$('#resultCed').html("Ocurrió un error, contacte al administrador.");
				}
			}
		}

	}
}

//Funciòn calcular precio en facturación
function calc_purchase(){
	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var id_producto = encodeURIComponent(document.getElementById("producto").value);
	var descuento = encodeURIComponent(document.getElementById("descuento").value);
	var unidades = encodeURIComponent(document.getElementById("unidades").value);
	var precio = encodeURIComponent(document.getElementById("precio").value);
	var error = 0;


	if(id_producto == "Seleccione" || descuento == ""){
		document.getElementById("precio").value = "";
		document.getElementById("unidades").value = "";
		document.getElementById("descuento").value = "";
	}

	else {
		if(id_producto != "Seleccione" && descuento == ""){
			document.location.href="#top";
			$('#resultP').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
			$('#resultP').html("No se permite un % de precio vacío.");
			window.setTimeout(limpiarP, 4000);
			error = 1;
		}
		else if(descuento != "" && descuento < 10){
			document.location.href="#top";
			$('#resultP').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
			$('#resultP').html("No se permite un % de precio inferior al 10%.");
			window.setTimeout(limpiarP, 4000);
			error = 1;
		}
		else if(descuento != "" && descuento < 0){
			document.location.href="#top";
			$('#resultP').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
			$('#resultP').html("No puede introducir un número negativo en el campo % Precio.");
			window.setTimeout(limpiarP, 4000);
			error = 1;
		}
		else if (isNaN(descuento) == true){
			document.location.href="#top";
			$('#resultP').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
			$('#resultP').html("No puede introducir caracteres en el campo % Precio, debe ser un valor numérico entero.");
			window.setTimeout(limpiarP, 4000);
			error = 1;
		}
		//fin descueno
		if(unidades == ""){
			unidades = 1;
		}
		else if(unidades != "" && unidades < 0){
			document.location.href="#top";
			$('#resultP').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
			$('#resultP').html("No puede introducir un número negativo en el campo unidades.");
			window.setTimeout(limpiarP, 4000);
			error = 1;
		}
		else if (isNaN(unidades) == true){
			document.location.href="#top";
			$('#resultP').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
			$('#resultP').html("No puede introducir caracteres en el campo unidades, debe ser un valor numérico entero.");
			window.setTimeout(limpiarP, 4000);
			error = 1;
		}

		if (error == 0){

			var objeto = {
				"id_producto":id_producto,
				"descuento":descuento,
				"unidades":unidades,
				"precio":precio
			}

			var obj = JSON.stringify(objeto);
			// Preparar la funcion de respuesta
			conexion.onreadystatechange = respuesta;

			// Realizar peticion HTTP
			conexion.open('POST', 'http://localhost/inventario/calc_purchase.php');
			conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			conexion.send("objeto="+obj);
		}
	}
	function respuesta() {
		if(conexion.readyState == 4) {
			if(conexion.status == 200) {
				if (conexion.responseText){
					document.getElementById("precio").value = JSON.parse(conexion.responseText);
				}
				else{
					$('#resultP').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
					$('#resultP').html("Ocurrió un error, contacte al administrador.");
				}
			}
		}
	}
}

//Funciòn calcular precio en prestamo
function loan(){
	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var producto = encodeURIComponent(document.getElementById("producto").value);
	var unidades = encodeURIComponent(document.getElementById("unidades").value);
	var porcentajeP = encodeURIComponent(document.getElementById("PdP").value);
	var precio = encodeURIComponent(document.getElementById("precio").value);
	var quien = encodeURIComponent(document.getElementById("quien").value);
	var error = 0;


	if(producto == "Seleccione"){
		document.getElementById("precio").value = "";
		document.getElementById("unidades").value = "1";
	}
	else {
		if(unidades == ""){
			unidades = 1;
		}
		else if(producto != "Seleccione" && porcentajeP == "Seleccione"){
			document.location.href="#top";
			$('#resultPr').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
			$('#resultPr').html("Por favor seleccione una opción de % Precio.");
			window.setTimeout(limpiarPr, 4000);
			error = 1;
		}
		else if(unidades != "" && unidades < 0){
			document.location.href="#top";
			$('#resultPr').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
			$('#resultPr').html("No puede introducir un número negativo en el campo unidades.");
			window.setTimeout(limpiarPr, 4000);
			error = 1;
		}
		else if (isNaN(unidades) == true){
			document.location.href="#top";
			$('#resultPr').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
			$('#resultPr').html("No puede introducir caracteres en el campo unidades, debe ser un valor numérico entero.");
			window.setTimeout(limpiarPr, 4000);
			error = 1;
		}

		if (error == 0){

			var objeto = {
				"producto":producto,
				"unidades":unidades,
				"descuento":porcentajeP,
				"quien":quien,
				"precio":precio
			}

			var obj = JSON.stringify(objeto);
			// Preparar la funcion de respuesta
			conexion.onreadystatechange = respuesta;

			// Realizar peticion HTTP
			conexion.open('POST', 'http://localhost/inventario/calc_loan.php');
			conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			conexion.send("objeto="+obj);
		}
	}
	function respuesta() {
		if(conexion.readyState == 4) {
			if(conexion.status == 200) {
				if (conexion.responseText){
					document.getElementById("precio").value = JSON.parse(conexion.responseText);
				}
				else{
					$('#resultP').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
					$('#resultP').html("Ocurrió un error, contacte al administrador.");
				}
			}
		}
	}
}

//Función crear cliente
function SavePerson() {
	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}

	var referencia   = encodeURIComponent(document.getElementById("referenciaCliente").value);
	var nombre     = decodeURIComponent(document.getElementById("nombre").value);
	var apellidos  = decodeURIComponent(document.getElementById("apellidos").value);
	var cedula     = encodeURIComponent(document.getElementById("cedulaM").value);
	var celular    = encodeURIComponent(document.getElementById("celular").value);
	var correo     = decodeURIComponent(document.getElementById("correo").value);
	var pf = 0;


	if (referencia == 1){

		if (document.getElementById("PF").value == "A"){
			var pf = 1;
		}

		function validar_email( email ) {
			var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			return regex.test(email) ? true : false;
		}

		if (nombre == "" || apellidos == "" || cedula == ""){
			$('#resultnvclnt').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
			$('#resultnvclnt').html("Por favor complete los campos marcados como obligatorios.");
		}

		else if (isNaN(cedula) == true){
			$('#resultnvclnt').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
			$('#resultnvclnt').html("El campo (cédula) solo puede contener números.");
		}

		else if (validar_email(correo)){
			var objeto = {
				"nombre":nombre,
				"apellidos":apellidos,
				"cedula":cedula,
				"celular":celular,
				"correo":correo
			}
			var obj = JSON.stringify(objeto);
			// Preparar la funcion de respuesta
			conexion.onreadystatechange = respuesta;

			// Realizar peticion HTTP
			conexion.open('POST', 'http://localhost/inventario/proc_person.php');
			conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			conexion.send("objeto="+obj);
		}
		else{
			$('#resultnvclnt').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
			$('#resultnvclnt').html("Intruduzca un formato de correo adecuado Ej: correo@dominio.com");
		}
		function respuesta() {
			if(conexion.readyState == 4) {
				if(conexion.status == 200) {
					if (conexion.responseText == true){
						document.getElementById("nombre").value="";
						document.getElementById("apellidos").value="";
						document.getElementById("cedulaM").value="";
						document.getElementById("celular").value="";
						document.getElementById("correo").value="";
						$('#resultnvclnt').css({'border':'1px solid #d6e9c6','background-color':'#dff0d8','color':'#3c763d','padding':'5px'});
						$('#resultnvclnt').html("Se ha registrado el cliente con éxito.");
						if(pf != 1){
							var nombreCompleto = nombre+" "+apellidos
							document.getElementById("cliente").value= nombreCompleto;
							document.getElementById("cedula").value= cedula;
							window.setTimeout("$('#Person').modal('hide');", 2000);
						}
					}
					else{
						$('#resultnvclnt').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
						$('#resultnvclnt').html("Ocurrió un error, contacte al administrador.");
					}
				}
			}
		}
	}
}

//Función agregar productos a la creación de factura.
function NewFact(){
	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}

	var producto    = encodeURIComponent(document.getElementById("producto").value);
	var descuento   = encodeURIComponent(document.getElementById("descuento").value);
	var formaP   = encodeURIComponent(document.getElementById("FdP").value);
	var unidades    = document.getElementById("unidades").value;
	var precio      = decodeURIComponent(document.getElementById("precio").value);
	var ubicacion      = decodeURIComponent(document.getElementById("ubic").value);
	var fecha = new Date();
	var id_transact = document.getElementById("idTransact").value;
	var check = 0;

	if(id_transact == 0){
		id_transact = fecha.getDate()+"-"+(fecha.getMonth()+1)+"-"+fecha.getFullYear()+"-"+fecha.getHours()+"-"+fecha.getMinutes()+"-"+fecha.getSeconds()+"-"+fecha.getMilliseconds();
		document.getElementById("idTransact").value = id_transact;
	}

	if(descuento == "" ){
		$('#resultP').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultP').html("Debe ingresar un % Precio.");
		window.setTimeout(limpiarP, 4000);
		check = 1;
	}

	if(descuento < 10 ){
		$('#resultP').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultP').html("No se permite un % Precio inferior al 10%.");
		window.setTimeout(limpiarP, 4000);
		check = 1;
	}

	if(producto == "Seleccione"){
		$('#resultP').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultP').html("Debe seleccionar un producto.");
		window.setTimeout(limpiarP, 4000);
		check = 1;
	}

	if(unidades == 0){
		$('#resultP').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultP').html("No se pueden agregar 0 unidades de un producto.");
		window.setTimeout(limpiarP, 4000);
		check = 1;
	}

	if(formaP == "Seleccione"){
		$('#resultP').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultP').html("Debe seleccionar una forma de pago.");
		window.setTimeout(limpiarP, 4000);
		check = 1;
	}

	if(check == 0){
		limpiarP();
		var objeto = {
			"id_transact":id_transact,
			"producto":producto,
			"unidades":unidades,
			"formaPago":formaP,
			"precio":precio,
			"ubicacion":ubicacion
		}

		var obj = JSON.stringify(objeto);
		// Preparar la funcion de respuesta
		conexion.onreadystatechange = respuesta;

		// Realizar peticion HTTP
		conexion.open('POST', 'http://localhost/inventario/tmp_sale.php');
		conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		conexion.send("objeto="+obj);

		function respuesta() {
			if(conexion.readyState == 4) {
				if(conexion.status == 200) {
					if (conexion.responseText != false){
						if(conexion.responseText != "1053"){
							document.getElementById("descuento").value = 15;
							document.getElementById("unidades").value = 1;
							document.getElementById("FdP").disabled = true;
							$('#tmp_sale').html(conexion.responseText);
						}
						else{
							$('#resultP').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
							$('#resultP').html("La cantidad ingresada del producto seleccionado, excede las existencias del mismo.");
							window.setTimeout(limpiarP, 4000);
						}
					}
					else{
						$('#resultP').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
						$('#resultP').html("Ocurrió un error, contacte al administrador.");
					}
				}
			}
		}
	}
}

//Función agregar productos a la creación de prestamo.
function NewPr(ubic){
	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}

	var idTransact = encodeURIComponent(document.getElementById("idTransact").value);
	var producto  = encodeURIComponent(document.getElementById("producto").value);
	var quien = encodeURIComponent(document.getElementById("quien").value);
	var pdP    = encodeURIComponent(document.getElementById("PdP").value);
	var unidades  = document.getElementById("unidades").value;
	var precio    = decodeURIComponent(document.getElementById("precio").value);
	var ubicacion = ubic;

	var fecha = new Date();
	var id_transact = document.getElementById("idTransact").value;
	var check = 0;

	if(id_transact == 0){
		id_transact = fecha.getDate()+"-"+(fecha.getMonth()+1)+"-"+fecha.getFullYear()+"-"+fecha.getHours()+"-"+fecha.getMinutes()+"-"+fecha.getSeconds()+"-"+fecha.getMilliseconds();
		document.getElementById("idTransact").value = id_transact;
	}

	if(pdP == "Seleccione" ){
		$('#resultPr').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultPr').html("Debe seleccionar un % Precio.");
		window.setTimeout(limpiarPr, 4000);
		check = 1;
	}

	if(producto == "Seleccione"){
		$('#resultPr').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultPr').html("Debe seleccionar un producto.");
		window.setTimeout(limpiarPr, 4000);
		check = 1;
	}

	if(unidades == 0){
		$('#resultPr').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultPr').html("No se pueden agregar 0 unidades de un producto ni poner carateres distintos a números en el campo.");
		window.setTimeout(limpiarPr, 4000);
		check = 1;
	}

	if(quien == ""){
		$('#resultPr').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultPr').html("Debe especificar a quien se realizará el prestamo.");
		window.setTimeout(limpiarPr, 4000);
		check = 1;
	}

	if(check == 0){
		limpiarPr();
		var objeto = {
			"id_transact":id_transact,
			"producto":producto,
			"quien":quien,
			"pdP":pdP,
			"unidades":unidades,
			"precio":precio,
			"ubicacion":ubicacion
		}

		var obj = JSON.stringify(objeto);
		// Preparar la funcion de respuesta
		conexion.onreadystatechange = respuesta;

		// Realizar peticion HTTP
		conexion.open('POST', 'http://localhost/inventario/tmp_loan.php');
		conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		conexion.send("objeto="+obj);

		function respuesta() {
			if(conexion.readyState == 4) {
				if(conexion.status == 200) {
					if (conexion.responseText != false){
						if(conexion.responseText != "1053"){
							document.getElementById("producto").value = "Seleccione";
							document.getElementById("unidades").value = 1;
							document.getElementById("quien").disabled = true;
							$('#tmp_pres').html(conexion.responseText);
						}
						else{
							$('#resultPr').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
							$('#resultPr').html("La cantidad ingresada del producto seleccionado, excede las existencias del mismo.");
							window.setTimeout(limpiarPr, 4000);
						}
					}
					else{
						$('#resultPr').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
						$('#resultPr').html("Ocurrió un error, contacte al administrador.");
					}
				}
			}
		}
	}
}

//Función agregar productos a la creación de garantía.
function NewGaran(ubicac){
	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}

	var cliente  = encodeURIComponent(document.getElementById("cliente").value);
	var cedula   = encodeURIComponent(document.getElementById("cedula").value);
	var producto = encodeURIComponent(document.getElementById("producto").value);
	var marca    = encodeURIComponent(document.getElementById("marca").value);
	var ubicacion = ubicac;
	var unidades = document.getElementById("unidades").value;
	var repair   = document.getElementById("repair").value;

	var fecha = new Date();
	var id_transact = document.getElementById("idTransact").value;
	var check = 0;

	if(id_transact == 0){
		id_transact = fecha.getDate()+"-"+(fecha.getMonth()+1)+"-"+fecha.getFullYear()+"-"+fecha.getHours()+"-"+fecha.getMinutes()+"-"+fecha.getSeconds()+"-"+fecha.getMilliseconds();
		document.getElementById("idTransact").value = id_transact;
	}

	if(cliente == "" || cedula == "") {
		$('#resultGr').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultGr').html("Debe ingresar la información del cliente.");
		window.setTimeout(limpiarGar, 4000);
		check = 1;
	}

	if(producto == "Seleccione"){
		$('#resultGr').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultGr').html("Debe seleccionar un producto.");
		window.setTimeout(limpiarGar, 4000);
		check = 1;
	}

	if(unidades == 0){
		$('#resultGr').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultGr').html("No se pueden agregar 0 unidades de un producto o caracteres en el campo de texto.");
		window.setTimeout(limpiarGar, 4000);
		check = 1;
	}

	if(repair == "Seleccione"){
		$('#resultGr').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultGr').html("Por favor indique si el producto se va a reparar o se va a reemplazar.");
		window.setTimeout(limpiarGar, 4000);
		check = 1;
	}

	if(check == 0){
		limpiarGar();
		var objeto = {
			"id_transact":id_transact,
			"producto":producto,
			"unidades":unidades,
			"cliente":cliente,
			"cedula":cedula,
			"marca":marca,
			"ubicacion":ubicacion,
			"repair":repair
		}

		var obj = JSON.stringify(objeto);
		// Preparar la funcion de respuesta
		conexion.onreadystatechange = respuesta;

		// Realizar peticion HTTP
		conexion.open('POST', 'http://localhost/inventario/tmp_garantia.php');
		conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		conexion.send("objeto="+obj);

		function respuesta() {
			if(conexion.readyState == 4) {
				if(conexion.status == 200) {
					if(conexion.responseText != false) {
						document.getElementById("cliente").disabled = true;
						document.getElementById("clienteA").disabled = true;
						document.getElementById("cedula").disabled = true;
						document.getElementById("producto").value = "Seleccione";
						document.getElementById("unidades").value = 1;
						document.getElementById("marca").value = "";
						$('#tmp_gar').html(conexion.responseText);
					}
					else{
						$('#resultGr').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
						$('#resultGr').html("Error cargando la pasarela, contácte al administrador del sistema.");
						window.setTimeout(limpiarGar, 4000);
					}
				}
			}
		}
	}
}

//Función agregar productos a la creación de traslado.

function NewTras(){
	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}

	var producto    = encodeURIComponent(document.getElementById("producto").value);
	var unidades    = document.getElementById("unidades").value;
	var traslado    = document.getElementById("traslado").value;
	var fecha = new Date();
	var check = 0;

	var id_transact = document.getElementById("idTransact").value;

	if(id_transact == 0){
		id_transact = fecha.getDate()+"-"+(fecha.getMonth()+1)+"-"+fecha.getFullYear()+"-"+fecha.getHours()+"-"+fecha.getMinutes()+"-"+fecha.getSeconds()+"-"+fecha.getMilliseconds();
		document.getElementById("idTransact").value = id_transact;
	}

	if(producto == "Seleccione"){
		$('#resultP').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultP').html("Debe seleccionar un producto.");
		window.setTimeout(limpiarP, 4000);
		check = 1;
	}

	if(unidades == 0){
		$('#resultP').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultP').html("No se pueden agregar 0 unidades de un producto.");
		window.setTimeout(limpiarP, 4000);
		check = 1;
	}

	if (isNaN(unidades) == true){
		$('#resultP').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultP').html("Debe ingresar un valor numérico en el campo unidades.");
		window.setTimeout(limpiarP, 4000);
		check = 1;
	}

	if(traslado == "Seleccione"){
		$('#resultP').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultP').html("Debe seleccionar un almacen para realizar el traslado.");
		window.setTimeout(limpiarP, 4000);
		check = 1;
	}

	if(check == 0){
		limpiarP();
		var objeto = {
			"id_transact":id_transact,
			"producto":producto,
			"unidades":unidades,
			"traslado":traslado
		}

		var obj = JSON.stringify(objeto);
		// Preparar la funcion de respuesta
		conexion.onreadystatechange = respuesta;

		// Realizar peticion HTTP
		conexion.open('POST', 'http://localhost/inventario/tmp_tras.php');
		conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		conexion.send("objeto="+obj);

		function respuesta() {
			if(conexion.readyState == 4) {
				if(conexion.status == 200) {
					if (conexion.responseText != false){
						if(conexion.responseText != "1053"){
							document.getElementById("unidades").value = 1;
							document.getElementById("traslado").disabled = true;
							$('#tmp_sale').html(conexion.responseText);
						}
						else{
							$('#resultP').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
							$('#resultP').html("La cantidad ingresada del producto seleccionado, excede las existencias del mismo.");
							window.setTimeout(limpiarP, 4000);
						}
					}
					else{
						$('#resultP').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
						$('#resultP').html("Ocurrió un error, contacte al administrador.");
					}
				}
			}
		}
	}
}

// Función para verificar si la factura fue almacenada y creada correctamente.
function succesON (){
	$('#tmp_saleF').submit();
	//Mensaje de venta!
	window.setTimeout( function(){
		$('#tmp_sale').css({'border':'1px solid #d6e9c6','background-color':'#dff0d8','color':'#3c763d','padding':'5px'});
		$('#tmp_sale').html("Venta realizada con éxito.");
	}, 1000 );
	document.getElementById("idTransact").value = "";
	window.setTimeout( function(){
		location.reload();
	}, 6000 );
}

// Función para verificar si el traslado fue almacenado y creado correctamente.
function succesOnTraslado (){
	$('#tmp_trasF').submit();
	//Mensaje de venta!
	window.setTimeout( function(){
		$('#tmp_sale').css({'border':'1px solid #d6e9c6','background-color':'#dff0d8','color':'#3c763d','padding':'5px'});
		$('#tmp_sale').html("Traslado realizado con éxito.");
	}, 1000 );
	document.getElementById("idTransact").value = "";
	window.setTimeout( function(){
		location.reload();
	}, 6000 );
}

// Función para verificar si la garantía fue almacenada y creada correctamente.
function succesGr (){
	$('#tmp_garanF').submit();
	//Mensaje de venta!
	window.setTimeout( function(){
		$('#tmp_gar').css({'border':'1px solid #d6e9c6','background-color':'#dff0d8','color':'#3c763d','padding':'5px'});
		$('#tmp_gar').html("Garantía realizada con éxito.");
	}, 1000 );
	document.getElementById("idTransact").value = "";
	window.setTimeout( function(){
		location.reload();
	}, 6000 );
}

// Función para verificar si el prestamos se generó correctamente.
function succesPr (){
	$('#tmp_PR').submit();
	//Mensaje de venta!
	window.setTimeout( function(){
		$('#tmp_pres').css({'border':'1px solid #d6e9c6','background-color':'#dff0d8','color':'#3c763d','padding':'5px'});
		$('#tmp_pres').html("Préstamo realizado con éxito.");
	}, 1000 );
	document.getElementById("idTransact").value = "";
	window.setTimeout( function(){
		location.reload();
	}, 6000 );
}

//Función para pasar los datos del click de la busqueda
function pass(cedula, nombre){
	document.getElementById("cliente").value = nombre;
	document.getElementById("cedula").value = cedula;
	limpiarCoin();
	limpiarC();
}

//Input type filetype
function filetype(){
	var logo = document.getElementById("log").value;
	if(logo != ""){
		$('#log').css({'color':'#000'});
	}else{
		$('#log').css({'color':'#FFF'});
	}
}
//Función abrir modal de registro de datos si no hay datos de Empresa
function op(){
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}

	var objeto = {
		"tabla": "empresa",
		"status":1
	}
	var obj = JSON.stringify(objeto);

	conexion.onreadystatechange = respuesta;

	conexion.open('POST', 'http://localhost/inventario/proc_select.php');
	conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	conexion.send("objeto="+obj);

	function respuesta() {
		if(conexion.readyState == 4) {
			if(conexion.status == 200) {
				if (conexion.responseText == false){
					$("#form_buss").attr("action","http://localhost/inventario/proc_bussines.php");
					$('#Admin').modal();
					$('#resultbussin').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
					$('#resultbussin').html("<strong>Importante!</strong><br><p align='justify' style='font-size: 12px;'><strong>Como primer paso, </strong>es necesario ingresar la información de la empresa para efectos de facturación y documentación. Como mínimo debe registrar el nombre, el teléfono y una dirección.<br><br>¡Podrá actualizar más adelante la información de esta sección!</p>");
				} else{
					$("#form_buss").attr("action","http://localhost/inventario/proc_ubussines.php");
					var ArrayObject = JSON.parse(conexion.responseText );
					document.getElementById("id").value = ArrayObject.id;
					document.getElementById("nempr").value = ArrayObject.empresa;
					document.getElementById("nit").value = ArrayObject.nit;
					document.getElementById("drccn").value = ArrayObject.direccion;
					document.getElementById("tlfn").value = ArrayObject.telefono;
					document.getElementById("iva").value = ArrayObject.iva;
					document.getElementById("iconFormE").setAttribute("src", "http://localhost/inventario/images/"+ArrayObject.logo);
					document.getElementById("pdftr").value = ArrayObject.pieFactura;
					document.getElementById("confct").value = ArrayObject.consecutivoFactura;
					$('#updbss').html("Actualizar");
				}
			}
		}
	}
}

//Función para almacenar información de empresa
function SaveAdmon (){

	var empresa = decodeURIComponent(document.getElementById("nempr").value);
	var nit = decodeURIComponent(document.getElementById("nit").value);
	var logo = encodeURIComponent(document.getElementById("log").value);
	var direccion = encodeURIComponent(document.getElementById("drccn").value);
	var telefono = document.getElementById("tlfn").value;
	var iva = decodeURIComponent(document.getElementById("iva").value);
	var pieFactura = decodeURIComponent(document.getElementById("pdftr").value);
	var consecutivoFactura = decodeURIComponent(document.getElementById("confct").value);
	var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
	var form = 1;

	if(empresa == ""){
		$('#resultbussin').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultbussin').html("Debe ingresar el nombre de la empresa.");
		form = 0;
	}
	else if(logo != "" && !allowedExtensions.exec(logo)){
		$('#resultprdct').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultprdct').html("La extención de la imagen debe ser;  .jpg, .jpeg, .png o .gif.");
		form = 0;
	}
	else if(direccion == ""){
		$('#resultbussin').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultbussin').html("Debe ingresar una dirección.");
		form = 0;
	}
	else if(telefono == ""){
		$('#resultbussin').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultbussin').html("Debe ingresar un teléfono.");
		form = 0;
	}
	else if(consecutivoFactura.length > 8){
		$('#resultbussin').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultbussin').html("EL consecutivo de factura no puede superar 8 cifras.");
		form = 0;
	}
	else if(form == 1){
		document.getElementById("form_buss").submit();
	}

}

// Función creación usuarios
function Usu() {
	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}

	var nombre   = encodeURIComponent(document.getElementById("nombre").value);
	var usuario   = encodeURIComponent(document.getElementById("usuario").value);
	var contra   = encodeURIComponent(document.getElementById("contra").value);
	var tipo   = encodeURIComponent(document.getElementById("tipoU").value);

	if (nombre == "" || usuario == "" || contra == ""){
		$('#resultctg').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#resultctg').html("Por favor complete la información en todos los campos.");
	}

	else{
		var objeto = {
			"nombre":nombre,
			"usuario":usuario,
			"contra":contra,
			"tipo":tipo
		}
		var obj = JSON.stringify(objeto);
		// Preparar la funcion de respuesta
		conexion.onreadystatechange = respuesta;

		// Realizar peticion HTTP
		conexion.open('POST', 'http://localhost/inventario/proc_usu.php');
		conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		conexion.send("objeto="+obj);
	}

	function respuesta() {
		if(conexion.readyState == 4) {
			if(conexion.status == 200) {
				if (conexion.responseText == true){
					document.getElementById("nombre").value="";
					document.getElementById("usuario").value="";
					document.getElementById("contra").value="";
					$('#resultctg').css({'border':'1px solid #d6e9c6','background-color':'#dff0d8','color':'#3c763d','padding':'5px'});
					$('#resultctg').html("Se ha registrado con éxito el usuario.");
					setTimeout ('reload()', 1000);
				}
				else{
					$('#resultctg').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
					$('#resultctg').html("Ocurrió un error, contacte al administrador.");
				}
			}
		}
	}
}

// Función capturar datos para edición de usuarios
function capdataupdusu(idp){

	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var tabla = "usuario";
	var id= idp;
	var objeto = {
		"id":id,
		"tabla":tabla
	}
	var obj = JSON.stringify(objeto);
	// Preparar la funcion de respuesta
	conexion.onreadystatechange = respuesta;

	// Realizar peticion HTTP
	conexion.open('POST', 'http://localhost/inventario/proc_select.php');
	conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	conexion.send("objeto="+obj);

	function respuesta() {
		if(conexion.readyState == 4) {
			if(conexion.status == 200) {
				if (conexion.responseText == false){
					alert("Ocurrió un error, contacte al administrador.");
				}
				else{
					var ArrayObject = JSON.parse(conexion.responseText );
					document.getElementById("ids").value= ArrayObject.id;
					document.getElementById("usuarioE").value= ArrayObject.usuario;
					document.getElementById("contraE").value= ArrayObject.contrasena;
					document.getElementById("tipoUE").value= ArrayObject.tipo;
					document.getElementById("nombreE").value= ArrayObject.nombre_completo;
				}
			}
		}
	}
}

// Función ediciòn usuario
function UpdateUsuario() {
	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var id = encodeURIComponent(document.getElementById("ids").value);
	var nombre   = encodeURIComponent(document.getElementById("nombreE").value);
	var usuario   = encodeURIComponent(document.getElementById("usuarioE").value);
	var contra   = encodeURIComponent(document.getElementById("contraE").value);
	var tipo   = encodeURIComponent(document.getElementById("tipoUE").value);

	if (nombre == "" || usuario == "" || contra == ""){
		$('#result2').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
		$('#result2').html("Por favor complete la información en todos los campos.");
	}

	else{
		var objeto = {
			"id":id,
			"usuario":usuario,
			"contra":contra,
			"nombre":nombre,
			"tipo":tipo
		}
		var obj = JSON.stringify(objeto);
		// Preparar la funcion de respuesta
		conexion.onreadystatechange = respuesta;

		// Realizar peticion HTTP
		conexion.open('POST', 'http://localhost/inventario/proc_updusu.php');
		conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		conexion.send("objeto="+obj);
	}

	function respuesta() {
		if(conexion.readyState == 4) {
			if(conexion.status == 200) {
				if (conexion.responseText == true){
					document.getElementById("nombreE").disabled = true;
					document.getElementById("usuarioE").disabled = true;
					document.getElementById("contraE").disabled = true;
					var boton = document.getElementById('updus');
					boton.disabled = true;
					$('#result2').css({'border':'1px solid #d6e9c6','background-color':'#dff0d8','color':'#3c763d','padding':'5px'});
					$('#result2').html("Se ha actualizado el usuario con éxito.");
				}
				else{
					if(conexion.responseText == false){
						$('#result2').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
						$('#result2').html("Ocurrió un error, contacte al administrador.");
					}
					else{
						$('#result2').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
						$('#result2').html("Debe realizar un cambio para actualizar el usuario seleccionado.");
					}
				}
			}
		}
	}
}

// Función filtro de marca
function marca() {

	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}

	var producto  = encodeURIComponent(document.getElementById("producto").value);

	var objeto = {
		"producto":producto
	}

	var obj = JSON.stringify(objeto);
	// Preparar la funcion de respuesta
	conexion.onreadystatechange = respuesta;

	// Realizar peticion HTTP
	conexion.open('POST', 'http://localhost/inventario/proc_marca.php');
	conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	conexion.send("objeto="+obj);

	function respuesta() {
		if(conexion.readyState == 4) {
			if(conexion.status == 200) {
				if (conexion.responseText != false){
					var marca = JSON.parse(conexion.responseText);
					document.getElementById("marca").value = marca;
				}
			}
		}
	}

}

// Función filtro de almacen
function Remi() {

	var ubicacion  = encodeURIComponent(document.getElementById("ubi").value);
	window.location.href = "Nueva_Remision.php?ubic="+ubicacion;


}

// Función filtro de almacen para historial de remisiones
function HRemi() {

	var ubicacion  = encodeURIComponent(document.getElementById("Hubi").value);

	if (ubicacion == "Almacen-1"){
		window.location.href = "Historial_Ventas.php";
	} else{
		window.location.href = "Historial_Ventas2.php";
	}
}

// Función filtro de almacen
function Gara() {

	var ubicacion  = encodeURIComponent(document.getElementById("Gubi").value);
	window.location.href = "Nueva_Garantia.php?ubic="+ubicacion;


}

// Función filtro de almacen para historial de remisiones
function HGara() {

	var ubicacion  = encodeURIComponent(document.getElementById("HGubi").value);

	if (ubicacion == "Almacen-1"){
		window.location.href = "Historial_de_Garantia.php";
	} else if (ubicacion == "Almacen-2"){
		window.location.href = "Historial_de_Garantia2.php";
	} else{
		window.location.href = "Historial_de_Garantia_Bodega.php";
	}
}

// Función cargar id de finaliza trámite de garantía
function capdataupdGara (id) {
	document.getElementById("idG").value = id;
}

// Función cerrar garantía definitavamente
function Fgara (){
	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}

	var id = document.getElementById("idG").value;

	var objeto = {
		"id":id
	}

	var obj = JSON.stringify(objeto);
	// Preparar la funcion de respuesta
	conexion.onreadystatechange = respuesta;

	// Realizar peticion HTTP
	conexion.open('POST', 'http://localhost/inventario/proc_Fgara.php');
	conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	conexion.send("objeto="+obj);

	function respuesta() {
		if(conexion.readyState == 4) {
			if(conexion.status == 200) {
				if (conexion.responseText != false){
					$('#resultFgara').css({'border':'1px solid #d6e9c6','background-color':'#dff0d8','color':'#3c763d','padding':'5px','margin-top':'10px'});
					$('#resultFgara').html("Garantía cerrada correctamente.");
				}
			}
		}
	}
}

// Función cargar id de finaliza trámite de garantía
function capdataupdPres (id, idp) {
	document.getElementById("idP").value = id;
	document.getElementById("idPr").value = idp;
}

// Función cerrar préstamo definitavamente
function fpr (){
	// Obtener la instancia del objeto XMLHttpRequest
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}

	var id = document.getElementById("idP").value;
	var idpr = document.getElementById("idPr").value;
	var fcp = document.getElementById("FCP").value;

	var objeto = {
		"id":id,
		"idpr":idpr,
		"fcp":fcp
	}

	var obj = JSON.stringify(objeto);
	// Preparar la funcion de respuesta
	conexion.onreadystatechange = respuesta;

	// Realizar peticion HTTP
	conexion.open('POST', 'http://localhost/inventario/proc_Fpres.php');
	conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	conexion.send("objeto="+obj);

	function respuesta() {
		if(conexion.readyState == 4) {
			if(conexion.status == 200) {
				if (conexion.responseText != false){
					$('#resultFpres').css({'border':'1px solid #d6e9c6','background-color':'#dff0d8','color':'#3c763d','padding':'5px','margin-top':'10px'});
					$('#resultFpres').html("Prestamo cerrado correctamente.");
				} else{
					$('#resultFpres').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px'});
					$('#resultFpres').html("Ocurrió un error, contacte al administrador.");
				}
			}
		}
	}
}

// Función limpiar resultado
function limpiar(){
	var d = document.getElementById("result");
	while (d.hasChildNodes())
	d.removeChild(d.firstChild);
}

// Función limpiar resultado de busqueda
function limpiarS(){
	var d = document.getElementById("resultS");
	while (d.hasChildNodes())
	d.removeChild(d.firstChild);
	$('#resultS').css({'border':'0px','background-color':'transparent','color':'#a94442','padding':'5px'});
}

// Función limpiar resultado de busqueda cedula
function limpiarCed(){
	var d = document.getElementById("resultCed");
	while (d.hasChildNodes())
	d.removeChild(d.firstChild);
	$('#resultCed').css({'border':'0px','background-color':'transparent','color':'#a94442','padding':'5px'});
	$('#resultCed').css({'display':'none'});
}

// Función limpiar resultado de busqueda remision
function limpiarRem(){
	var d = document.getElementById("resultSale");
	while (d.hasChildNodes())
	d.removeChild(d.firstChild);
	$('#resultSale').css({'border':'0px','background-color':'transparent','color':'#a94442','padding':'5px'});
	$('#resultSale').css({'display':'none'});
}

// Función limpiar resultado de busqueda traslado
function limpiarTras(){
	var d = document.getElementById("resultTrans");
	while (d.hasChildNodes())
	d.removeChild(d.firstChild);
	$('#resultCed').css({'border':'0px','background-color':'transparent','color':'#a94442','padding':'5px'});
	$('#resultCed').css({'display':'none'});
}

// Función limpiar resultado de busqueda cedula
function limpiarCoin(){
	var d = document.getElementById("printC");
	while (d.hasChildNodes())
	d.removeChild(d.firstChild);
	$('#printC').css({'border':'0px','background-color':'transparent','color':'#a94442','padding':'0px'});
	$('#printC').css({'display':'none'});
}

// Función limpiar resultado de clientes
function limpiarC(){
	var d = document.getElementById("printClient");
	while (d.hasChildNodes())
	d.removeChild(d.firstChild);
	$('#printClient').css({'border':'0px','background-color':'transparent','color':'#a94442','padding':'0px'});
	$('#printClient').css({'display':'none'});
}

// Función limpiar resultado de busqueda
function limpiarP(){
	var d = document.getElementById("resultP");
	while (d.hasChildNodes())
	d.removeChild(d.firstChild);
	$('#resultP').css({'border':'0px','background-color':'transparent','color':'#a94442','padding':'0px'});
}

// Función limpiar resultado de prestamo
function limpiarPr(){
	var d = document.getElementById("resultPr");
	while (d.hasChildNodes())
	d.removeChild(d.firstChild);
	$('#resultPr').css({'border':'0px','background-color':'transparent','color':'#a94442','padding':'0px'});
}

// Función limpiar resultado de garantía
function limpiarGar(){
	var d = document.getElementById("resultGr");
	while (d.hasChildNodes())
	d.removeChild(d.firstChild);
	$('#resultGr').css({'border':'0px','background-color':'transparent','color':'#a94442','padding':'5px'});
}

function reload(){
	location.reload();
}
