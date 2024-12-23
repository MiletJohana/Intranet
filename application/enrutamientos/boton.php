<?php if ($_POST['resp'] == 1) { ?>
    <button id="btnAgregar" class="btn btn-danger" onclick="agregarEnrutamiento();">Crear</button>
    <button class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 2) { ?>
    <a href="" target="_blank" id="btnImprimir" class="btn btn-primary me-auto" onclick="">Imprimir</a>
    <button id="btnAcatualizar" class="btn btn-danger" onclick="modificarEnrutamiento();">Actualizar</button>
    <button class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 3) { ?>
    <button class="btn btn-danger" data-bs-dismiss="modal" id="btnEliminar" value="" onclick="confirmEliminar();">Eliminar</button>
    <button class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 4) { ?>
    <button class="btn btn-danger" id="btnIprimir" value="" onclick="confirmImprimir(<?php echo $_POST['num_enr']; ?>);">Confirmar</button>
    <button class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 5) { ?>
    <a href="" target="_blank" id="btnImprimir" class="btn btn-primary" onclick="">Imprimir</a>
    <button class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else { ?>
    <button class="btn btn-secondary ms-1" onclick="refreshTable();" data-bs-dismiss="modal">Cerrar</button>
<?php } ?>