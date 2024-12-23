<?php if ($_POST['resp'] == 1) { ?>
	<button id="btnAgregar" type="button" class="btn btn-danger" onclick="agregarEscalaProduct();">Agregar</button>
	<button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 2) { ?>
	<button id="btnActualizar" type="button" class="btn btn-danger" onclick="editarEscalaProduct();">Actualizar</button>
	<button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else { ?>
	<button type="button" class="btn btn-secondary ms-1" onclick="refreshTableUsu();" data-bs-dismiss="modal">Cerrar</button>
<?php } ?>