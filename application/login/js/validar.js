function validarCampo(campo) {
	var text = document.getElementById(campo);
	if (!text.checkValidity()) {
		$("#" + campo).formError("El campo no puede estar vacio");
		return 1;
	} else {
		$("#" + campo).formError({
			remove: true,
			successImage: { enabled: false }
		});
		return 0;
	}
}

function validarCampos(formulario) {
	var campo = 0;
	$('#' + formulario + ' :input').each(
		function (index) {
			var input = $(this);
			if (val = input.attr('required')) {
				campo = campo + validarCampo(input.attr('id'));
			}
		}
	);
	return campo;
}
