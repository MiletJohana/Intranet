<?php if ($_POST['resp'] == 1) { ?>
	<div class="mr-auto">
		<button id="btnNuevoC" type="button" class="btn btn-primary btn-raised" onclick="newClie();">Nuevo Cliente</button>
	</div>
	<button id="btnAgregar" type="button" class="btn btn-danger btn-raised" onclick="agregarCita()" disabled>Crear</button>
	<button type="button" class="btn btn-default ml-1" data-dismiss="modal">Cerrar</button>
<?php } else if ($_POST['resp'] == 2) { ?>
	<button id="cancelarCita" type="button" class="btn btn-primary btn-raised mr-auto" onclick="cancelarCita();">Cancelar Cita</button>
	<button id="btnAcatualizar" type="button" class="btn btn-danger btn-raised" onclick="modificarCita();">Finalizar</button>
	<button type="button" class="btn btn-default ml-1" data-dismiss="modal">Cerrar</button>
<?php } else if ($_POST['resp'] == 6) { ?>
	<button type="button" class="btn btn-default ml-1" data-dismiss="modal">Cerrar</button>
<?php } else if ($_POST['resp'] == 4) { ?>
	<button id="btnConfAct" type="button" class="btn btn-default btn-raised" data-dismiss="modal" value="" onclick="confirmActualizacion();">Finalizar</button>
	<button type="button" class="btn btn-default ml-1" data-dismiss="modal">Cerrar</button>
<?php } else if ($_POST['resp'] == 5) { ?>
	<button id="btnConfCancelar" type="button" class="btn btn-danger btn-raised" onclick="confirmCancelar();">Confirmar</button>
	<button type="button" class="btn btn-default ml-1" onclick="cambiarCita();">Volver</button>
<?php } else if ($_POST['resp'] == 7) { ?>
	<button id="btnAgregar" type="button" class="btn btn-danger btn-raised" onclick="agregarCita();" disabled>Crear</button>
	<button type="button" class="btn btn-default ml-1" data-dismiss="modal">Cerrar</button>
<?php } else { ?>
	<button type="button" class="btn btn-default ml-1" onclick="cerrar();" data-dismiss="modal">Cerrar</button>
<?php } ?>