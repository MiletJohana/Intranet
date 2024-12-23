<?php
include '../../resources/template/credentials.php';
if ($_POST['resp'] == 1) { ?>
	<button id="btnAgregar" class=" btn btn-danger" onclick="agregarCrm();">Crear</button>
	<button class="btn btn-default ml-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 2) { ?>
	<button id="btnAgregar" class=" btn btn-danger" onclick="agregarCrm();">Crear Informacion.F</button>
	<button class="btn btn-default ml-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else if ($_POST['resp'] == 3){
		if ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 200 || $_SESSION['rol'] == 300 || $_SESSION['rol'] == 400) { ?>
			<button id="btnpermi" class="btn btn-primary mr-auto" onclick="confirmPerc();">Permitir Edición</button>
		<?php } ?>
	<button id="btnModificar" class="btn btn-danger ml-1" onclick="actualizarSol();">Aprobar</button>
	<button class="btn btn-default ml-1" data-bs-dismiss="modal">Cerrar</button> 
<?php } else if ($_POST['resp'] == 4) {?>
	<button id="btnactuSol" class=" btn btn-danger" onclick="">Actualizar Solicitud</button>
	<button class="btn btn-default ml-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else if ($_POST['resp'] == 5) {?>
	<button id="btnactuSol" class=" btn btn-danger" onclick="">Actualizar </button>
	<button class="btn btn-default ml-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else if ($_POST['resp'] == 6) {?>
	<button id="btnactuSol" class=" btn btn-danger" onclick="">Actualizar Solicitud</button>
	<button class="btn btn-default ml-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else { ?>
	<div class="mr-auto">
		<button id="btnAgregarCli" class="btn btn-default" onclick="newSolici(1,'CSolicitud De Crédito', '../creditoV2/tabsForm.php');"><i class=" fa-solid fa-arrow-left"></i> Volver</button>
	</div>
	<button id="btnAgregarCli" class="btn btn-danger" onclick="crearCliente(3);">Crear Cliente</button>
	<button class="btn btn-default ml-1" data-bs-dismiss="modal">Cerrar</button>
<?php } ?>
	
