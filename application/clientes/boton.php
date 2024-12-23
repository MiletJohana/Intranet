<?php if ($_POST['resp'] == 1) { ?>
	<button id="btnAgregar" type="button" class="btn btn-danger" onclick="agregarCliente('clie');">Crear</button>
	<button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 2) { ?>
	<button id="btnAcatualizar" type="button" class="btn btn-danger" onclick="modificarCliente();">Actualizar</button>
	<button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 3) { ?> 
	<button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="btnEliminar" value="" onclick="confirmEliminar();">Eliminar</button>
	<button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else { ?>
	<button type="button" class="btn btn-secondary ms-1" onclick="refreshTable();" data-bs-dismiss="modal">Cerrar</button>
<?php } ?>