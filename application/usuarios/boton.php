<?php if ($_POST['resp'] == 1) { ?>
	<button id="btnAgregar" type="button" class="btn btn-danger" onclick="agregarUsuario();">Agregar</button>
	<button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 2) { ?>
	<button id="btnAcatualizar" type="button" class="btn btn-danger" onclick="modificarUsuario();">Actualizar</button>
	<button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 3) { ?>
	<button type="button" class="btn btn-danger" data-bd-dismiss="modal" id="btnEliminar" value="" onclick="confirmEliminar();">Eliminar</button>
	<button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 6) { ?>
	<button type="button" class="btn btn-danger" data-bd-dismiss="modal" id="btnEliminar" value="" onclick="agregarPermiso();">Agregar</button>
	<button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else { ?>
	<button type="button" class="btn btn-secondary ms-1" onclick="refreshTableUsu();" data-bs-dismiss="modal">Cerrar</button>
<?php } ?>