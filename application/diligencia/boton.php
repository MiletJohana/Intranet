<?php if ($_POST['resp'] == 1) { ?>
	<button id="btnAgregar" class="btn btn-danger" <?php if (!isset($_POST['id_cli'])){echo 'disabled';}?> onclick="agregarDil(<?php if (!isset($_POST['id_cli'])){ echo 1;} else { echo 2 . ', ' . $_POST['id_cli'];}  ?>);">Crear Diligencia</button>
	<button class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 2) { ?>
	<button id="btnAcatualiza" class="btn btn-danger" onclick="modificarDilig();">Actualizar</button>
	<button class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 3) { ?>
<?php } elseif ($_POST['resp'] == 4) { ?>
	<button class="btn btn-secondary" onclick="refreshTable();" data-bs-dismiss="modal">Cerrar</button>
<?php } else { ?>
	<div class="me-auto">
		<button id="btnAgregarCli" class="btn btn-secondary" onclick="newDiligencia();"><i class=" fa-solid fa-arrow-left me-2"></i> Volver</button>
	</div>
	<button id="btnAgregarCli" class="btn btn-danger" onclick="crearCliente(3);">Crear Cliente</button>
	<button class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } ?>