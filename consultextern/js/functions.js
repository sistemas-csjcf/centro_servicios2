
function ModalDocs(identif)
{
	var id = identif;
	if(window.XMLHttpRequest) {
		conexion = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		conexion = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var objeto = {
		"id":id
	}
	var obj = JSON.stringify(objeto);
	conexion.onreadystatechange = respuesta;
	conexion.open('POST', 'http://localhost/centro_servicios2/consultextern/docs.php');
	conexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	conexion.send("objeto="+obj);
	function respuesta() {
		if(conexion.readyState == 4) {
			if(conexion.status == 200) {
				if (conexion.responseText != false){
					var response = conexion.responseText;
					var arrayObject = response.split('|');
					var content = "<table class='table table-striped table-bordered'><thead><tr><th scope='col'>Memorial</th><th scope='col'>Documento</th></tr></thead><tbody>";
					for (var i = 1 ; i <= (arrayObject.length -1) ; i++) {
						content = content+"<tr><td>"+arrayObject[i]+"</td><td><a href='http://localhost/recepcionmemoriales/memoriales/"+arrayObject[i]+"' target='_blank'><img src='img/pdf.png' style='width: 40px;'></a></td></tr>";
					}
					content = content+"</tbody></table>";
					document.getElementById("putContent").innerHTML = content;
				}
			}
		}
	}
}

function FormSIDOJU(idm, persona, folios, juzgado, empleado, fecha, hora, acuse)
{
	document.getElementById("idm").value = idm;
	document.getElementById("acuse").value = acuse;
	document.getElementById("fecha").value = fecha;
	document.getElementById("hora").value = hora;
	document.getElementById("remitente").value = persona;
	document.getElementById("tipdoc").value = "";
	document.getElementById("numdoc").value = "";
	document.getElementById("folios").value = folios+" Folios";
	document.getElementById("juzgado").value = juzgado;
	document.getElementById("empleado").value = empleado;
}

function envForm()
{
	var tipoDoc = document.getElementById("tipdoc").value;
	var numDoc  = document.getElementById("numdoc").value;
	var folios  = document.getElementById("folios").value;
	var archivo = document.getElementById("archivo");

	if (tipoDoc == "" || numDoc == "" || folios == "" || archivo.files.length == 0){
		$('#resultfrm').css({'border':'1px solid #ebccd1','background-color':'#f2dede','color':'#a94442','padding':'5px','display':'block','width':'96%','margin-left':'2%','margin-bottom':'1%'});
		$('#resultfrm').html("Todos los campos son obligatorios");
	} else {
		$('#resultfrm').css({'display':'none'});
		$( "#formSIDOJU" ).submit();
	}

}
