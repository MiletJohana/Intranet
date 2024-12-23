function cambiarPassword(){
	$('#modal-title-md').html("Cambio Contraseña");
	$.ajax({

		url:'../plantilla/formulario.php',
		type:'POST',
		data: {resp:1},
		success: function(resp){
			$('#modal-body-md').html(resp);
		}		
	});

	$.ajax({
		url:'../plantilla/boton.php',
		type:'POST',
		data: {resp:1},
		success: function(resp){
			$('#btn-md').html(resp);
		}
	});
}

function updatePassword(){
	if (validarCampos('form-contrasena')==0) {
    var formulario = new FormData($("#form-contrasena")[0]);
     $.ajax({
        url:'../usuarios/usuarios.controller.php',
        data:formulario,
        type:'POST',
	      contentType: false,
	      processData: false,
	        success: function(resp){
	            $('#modal-medium').modal('hide');
	            $('#modal-title-sm').html('Cambio Contraseña');
	            $('#modal-body-sm').html(resp);
	            $('#modal-small').modal('show');
	        }
    	}); 
  }
}