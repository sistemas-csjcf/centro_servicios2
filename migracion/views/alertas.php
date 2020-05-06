  <!-- ------------------------------- Invalidar Usuario ------------------------------- -->
  <div id="msg_error"></div>
 
 <!-- ------------------------------- Adicionar ------------------------------- -->
 <div id="msg_adicionar" style='display:none; padding-left:20px'>
 <br /><br /><span style="color:#CC0000; font-weight:bold; border-bottom: 1px solid #000000">Alerta:</span>
 <br /><br />
 <strong><?php echo $_SESSION['elemento']?></strong> Adicionado(a) con Exito.
 </div>
 
 <!-- ------------------------------- proyecto Cancelado ------------------------------- -->
 <div id="msg_cancelado" style='display:none; padding-left:20px'>
 <br /><br /><span style="color:#CC0000; font-weight:bold; border-bottom: 1px solid #000000">Alerta:</span>
 <br /><br />
 <strong><?php echo $_SESSION['elemento']?></strong> Cancelado Totalmente.
 </div>
 
 <!-- ------------------------------- no existe Contrato ------------------------------- -->
 <div id="msg_noexcontrato" style='display:none; padding-left:20px'>
 <br /><br /><span style="color:#CC0000; font-weight:bold; border-bottom: 1px solid #000000">Alerta:</span>
 <br /><br />
 <strong><?php echo $_SESSION['elemento']?></strong>.
 </div>
 
  <!-- ------------------------------- Modificar ------------------------------- -->
 <div id="msg_modificar" style='display:none'>
 <br /><br /><span style="color:#CC0000; font-weight:bold; border-bottom: 1px solid #000000">Alerta:</span>
 <br /><br />
 <strong><?php echo $_SESSION['elemento']?></strong> Modificado(a) con Exito.
 </div>
 
 <!-- ------------------------------- Eliminar ------------------------------- -->
 <div id="msg_eliminar" style='display:none'>
 <br /><br /><span style="color:#CC0000; font-weight:bold; border-bottom: 1px solid #000000">Alerta:</span>
 <br /><br />
 <strong><?php echo $_SESSION['elemento']?></strong> Eliminado(a) con Exito.
 </div>
  <!-- ------------------------------- Eliminar ------------------------------- -->
 <div id="msg_errores" style='display:none'>
 <br /><br /><span style="color:#CC0000; font-weight:bold; border-bottom: 1px solid #000000">Alerta:</span>
 <br /><br />
 <strong><?php echo $_SESSION['elemento']?></strong>.
 </div>
 
<!-- ------------------------------- Invalidar Usuario ------------------------------- --> 
<?php if($_SESSION['invalidate_user'] == true){ ?>
<script type="text/javascript">
$('#msg_error').modal({onOpen: statusOpen,onClose: statusClose});
	function statusOpen(dialog) {
		dialog.overlay.fadeIn('slow', function () {
		dialog.container.slideDown('fast', function () {
		dialog.data.fadeIn('slow');
	});
	});
	}
	
	function statusClose(dialog) {
		dialog.data.fadeOut('slow', function () {
		dialog.container.slideUp('fast', function () {});
		dialog.overlay.fadeOut('slow', function () {
		$.modal.close();
	});
	});
	}
</script>
<?php $_SESSION['invalidate_user'] = false; unset($_SESSION['invalidate_user']); } ?>


<!-- ------------------------------- Adicionar ------------------------------- -->
<?php if($_SESSION['elem_adicionar'] == true){ ?>
<script type="text/javascript">


$('#msg_adicionar').modal({onOpen: statusOpen,onClose: statusClose});

function statusOpen(dialog) {
	dialog.overlay.fadeIn('slow', function () {
	dialog.container.show();
	dialog.data.show();
});
}

function statusClose(dialog) {
	dialog.data.hide();
	dialog.container.hide();
	dialog.overlay.fadeOut('slow', function () {
	$.modal.close();
});
}
</script>
<?php $_SESSION['elem_adicionar'] = false; 
   unset($_SESSION['elem_adicionar']);
   unset($_SESSION['elemento']);
} 
?>
<!-- ------------------------------- Cancelado ------------------------------- -->
<?php if($_SESSION['elem_cancelado'] == true){ ?>
<script type="text/javascript">


$('#msg_cancelado').modal({onOpen: statusOpen,onClose: statusClose});

function statusOpen(dialog) {
	dialog.overlay.fadeIn('slow', function () {
	dialog.container.show();
	dialog.data.show();
});
}

function statusClose(dialog) {
	dialog.data.hide();
	dialog.container.hide();
	dialog.overlay.fadeOut('slow', function () {
	$.modal.close();
});
}
</script>
<?php $_SESSION['elem_cancelado'] = false; 
   unset($_SESSION['elem_cancelado']);
   unset($_SESSION['elemento']);
} 
?>
<!-- -------------------------------No existe Contrato ------------------------------- -->
<?php if($_SESSION['elem_conscontrato'] == true){ ?>
<script type="text/javascript">


$('#msg_noexcontrato').modal({onOpen: statusOpen,onClose: statusClose});

function statusOpen(dialog) {
	dialog.overlay.fadeIn('slow', function () {
	dialog.container.show();
	dialog.data.show();
});
}

function statusClose(dialog) {
	dialog.data.hide();
	dialog.container.hide();
	dialog.overlay.fadeOut('slow', function () {
	$.modal.close();
});
}
</script>
<?php $_SESSION['elem_conscontrato'] = false; 
   unset($_SESSION['elem_conscontrato']);
   unset($_SESSION['elemento']);
} 
?>
<!-- -------------------------------Mensajes de Error ------------------------------- -->
<?php if($_SESSION['elem_errores'] == true){ ?>
<script type="text/javascript">


$('#msg_noexerror').modal({onOpen: statusOpen,onClose: statusClose});

function statusOpen(dialog) {
	dialog.overlay.fadeIn('slow', function () {
	dialog.container.show();
	dialog.data.show();
});
}

function statusClose(dialog) {
	dialog.data.hide();
	dialog.container.hide();
	dialog.overlay.fadeOut('slow', function () {
	$.modal.close();
});
}
</script>
<?php $_SESSION['elem_errores'] = false; 
   unset($_SESSION['elem_errores']);
   unset($_SESSION['elemento']);
} 
?>

<!-- ------------------------------- Modificar ------------------------------- -->
<?php if($_SESSION['elem_modificar'] == true){ ?>
<script type="text/javascript">
$('#msg_modificar').modal({onOpen: statusOpen,onClose: statusClose});

function statusOpen(dialog) {
	dialog.overlay.fadeIn('slow', function () {
	dialog.container.show();
	dialog.data.show();
});
}

function statusClose(dialog) {
	dialog.data.hide();
	dialog.container.hide();
	dialog.overlay.fadeOut('slow', function () {
	$.modal.close();
});
}
</script>
<?php $_SESSION['elem_modificar'] = false; unset($_SESSION['elem_modificar']);  unset($_SESSION['elemento']); } ?>


<!-- ------------------------------- Eliminar ------------------------------- -->
<?php if($_SESSION['elem_eliminar'] == true){ ?>
<script type="text/javascript">
$('#msg_eliminar').modal({onOpen: statusOpen,onClose: statusClose});

function statusOpen(dialog) {
	dialog.overlay.fadeIn('slow', function () {
	dialog.container.show();
	dialog.data.show();
});
}

function statusClose(dialog) {
	dialog.data.hide();
	dialog.container.hide();
	dialog.overlay.fadeOut('slow', function () {
	$.modal.close();
});
}
</script>
<?php $_SESSION['elem_eliminar'] = false; unset($_SESSION['elem_eliminar']);  unset($_SESSION['elemento']); } ?>