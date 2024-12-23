<?php
include "../../resources/template/credentials.php";
if ($_POST['resp'] == 1) { ?>
    <button type="button" id="buttonagregar" class="btn btn-danger" onclick="crear('form-llam','llamadas','tabla.php');" disabled>Crear Llamada </button>
    <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } else if ($_POST['resp'] == 0) { ?>
    <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } ?>