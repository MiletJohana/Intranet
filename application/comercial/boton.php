<?php if ($_POST['resp'] == 1) { ?>
	<div class="me-auto">
		<button id="btnNuevoC" type="button" class="btn btn-primary" onclick="newClie('comercial',4);">Nuevo Cliente</button>
	</div>
	<button id="btnAgregar" type="button" class="btn btn-danger" onclick="agregarCita()" disabled>Crear</button>
	<button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else if ($_POST['resp'] == 2) { ?>
	<button id="cancelarCita" type="button" class="btn btn-primary me-auto" onclick="cancelarCita();">Cancelar Cita</button>
	<button id="btnAcatualizar" type="button" class="btn btn-danger" onclick="modificarCita();">Finalizar</button>
	<button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else if ($_POST['resp'] == 6) { ?>
	<button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else if ($_POST['resp'] == 4) { ?>
	<button id="btnConfAct" type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="" onclick="confirmActualizacion();">Finalizar</button>
	<button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else if ($_POST['resp'] == 5) { ?>
	<button id="btnConfCancelar" type="button" class="btn btn-danger" onclick="confirmCancelar();">Confirmar</button>
	<button type="button" class="btn btn-secondary ms-1" onclick="cambiarCita();">Volver</button>
<?php } else if ($_POST['resp'] == 7) { ?>
	<button id="btnAgregar" type="button" class="btn btn-danger" onclick="agregarCita();" disabled>Crear</button>
	<button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else if ($_POST['resp'] == 8){ ?>
	<div class="me-auto">
		<button id="btnAgregarCli" class="btn btn-secondary" onclick="crearCita();"><i class=" fa-solid fa-arrow-left"></i> Volver</button>
	</div>
	<button id="btnAgregarCli" class="btn btn-danger" onclick="crearCliente(4);">Crear Cita</button>
	<button class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else { ?>
	<button class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } ?>