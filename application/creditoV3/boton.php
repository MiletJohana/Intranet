<?php
include '../../resources/template/credentials.php';
if ($_POST['resp'] == 1) { ?>
	<button id="btnAgregar" class=" btn btn-danger" onclick="agregarCrm();">Agregar</button>
	<button class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 2) { ?>
	<button id="btnpermiti1" class="btn btn-primary me-auto" onclick="permisoEditar();">Permitir Edición</button>
	<?php if ($_SESSION['rol'] != 400) { ?>
		<button id="btnAcatualizar" class="btn btn-danger ms-1" onclick="modificarCrm();">Agregar</button>
	<?php } ?>
	<button class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else if ($_POST['resp'] == 3) {
	if ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 200 || $_SESSION['rol'] == 300 || $_SESSION['rol'] == 400) { ?>
		<button id="btnpermi" class="btn btn-primary me-auto" onclick="permisoEditar();">Permitir Edición</button>
	<?php } ?>
	<button class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 4) { ?>
	<button class="btn btn-danger" data-bs-dismiss="modal" id="btnEliminarcrm" value="" onclick="confirmEliminarcrm(id_sol);">Eliminar</button>
	<button class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 5 && $_POST['id_est'] == 1 && ($_SESSION['rol'] == 300 || $_SESSION['rol'] == 400)) { ?>
	<button id="btnpermi2" class="btn btn-primary" onclick="permisoEditar();">Permitir Edición</button>
	<button class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 6) { ?>
	<button id="btnConfirRechazar" class="btn btn-danger" onclick="confirmRechazarcrm();">Rechazar</button>
	<button class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 8) { ?>
	<button id="btnhabcon" class="btn btn-danger" onclick="confirmPerc();">Habilitar Cont</button>
	<button id="btnpermiti2" class="btn btn-primary ms-1" onclick="confirmPerc();">Habilitar SAC/ATC</button>
<?php } elseif ($_POST['resp'] == 7) { ?>
	<button id="btnpermiti3" class="btn btn-primary" onclick="confirmPerc();">Habilitar SAC/ATC</button>
	<button class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 9) { ?>
	<button id="btnActual" class=" btn btn-danger" onclick="actuCrm();">Actualizar</button>
	<button class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 10) { ?>
	<button id="btnActual1" class=" btn btn-danger" onclick="actu1Crm();">Actualizar</button>
	<button class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 20) { ?> <!--Botones nuevos -->
	<div class="me-auto">
		<button id="btnAgregarCli" class="btn btn-secondary" onclick="crearCrm();"><i class=" fa-solid fa-arrow-left me-2"></i> Volver</button>
	</div>
	<button id="btnAgregarCli" class="btn btn-danger" onclick="crearCliente(5);">Crear Cliente</button>
	<button class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else if ($_POST['resp'] == 21) { ?>
	<?php if ($_POST['param'] == 5) { ?>
		<div class="me-auto">
			<button id="btnAgregarCli" class="btn btn-secondary" onclick="crearCrm();"><i class=" fa-solid fa-arrow-left me-2"></i> Volver</button>
		</div>
        <button type="submit" id="crear" class="btn btn-danger" onclick="crearContaCredito(<?php echo $_POST['param']; ?>, <?php echo $_POST['id_cli']; ?>, '', '');">Crear</button>
    <?php } else if ($_POST['param'] == 6) { ?>
		<div class="me-auto">
			<button id="btnAgregarCli" class="btn btn-secondary" onclick="editarInfoCredito(<?php echo $_POST['id_sol'] . ',' . $_POST['id_cli'] . ',' . $_POST['id_est']; ?>);"><i class=" fa-solid fa-arrow-left me-2"></i> Volver</button>
		</div>
        <button type="submit" id="crear" class="btn btn-danger" onclick="crearContaCredito(<?php echo $_POST['param']; ?>, <?php echo $_POST['id_cli']; ?>, <?php echo $_POST['id_sol']; ?>, <?php echo $_POST['id_est']; ?>);">Crear</button>
    <?php } ?>
    <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } else if ($_POST['resp'] == 23) { ?>
	<button id="btnrechazar" class="btn btn-danger" onclick="confirmRechazarCrm();">Rechazar</button>
    <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } else if ($_POST['resp'] == 24) { ?>
	<button id="btnAprobar" class="btn btn-danger" onclick="actualizarSol();">Si, aprobar</button>
    <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } else if ($_POST['resp'] == 25) { ?>
	<button id="btnEnviarCorreo" class="btn btn-danger" onclick="enviarCorreo();">Si, enviar</button>
    <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">No, cancelar</button>
<?php } else { ?>
	<a class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</a>
<?php } ?>
