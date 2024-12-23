<?php
include "../../resources/template/credentials.php";
if ($_POST['resp'] == 1) { ?>
    <?php if ($_POST['param'] == 1) { ?>
        <button type="submit" id="crear" class="btn btn-danger" onclick="crearContacto(<?php echo $_POST['param']; ?>, 0);" disabled>Crear </button>
    <?php } else if ($_POST['param'] == 2) { ?>
        <button type="submit" id="crear" class="btn btn-danger" onclick="crearContacto(<?php echo $_POST['param']; ?>, <?php echo $_POST['id_cli']; ?>);">Crear</button>
    <?php } else if ($_POST['param'] == 3) { ?>
        <button type="submit" id="crear" class="btn btn-danger" onclick="crearContacto(<?php echo $_POST['param']; ?>, 0);" disabled> Crear Contacto</button>
    <?php } ?>
    <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
    <? } else if ($_POST['resp'] == 2) { ?>
    <?php if ($_POST['param'] == 1) { ?>
        <button type="submit" id="editar" class="btn btn-danger" onclick="editarContacto(<?php echo $_POST['param']; ?>, 0);">Editar</button>
    <?php } else if ($_POST['param'] == 2) { ?>
        <button type="submit" id="editar" class="btn btn-danger" onclick="editarContacto(<?php echo $_POST['param']; ?>, <?php echo $_POST['id_cli']; ?>);">Editar</button>
    <?php } else if ($_POST['param'] == 3) { ?>
        <button type="submit" id="editar" class="btn btn-danger" onclick="editarContacto(<?php echo $_POST['param']; ?>, 0);" disabled>Editar</button>
    <?php } ?>
    <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } else if ($_POST['resp'] == 0) { ?>
    <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } ?>