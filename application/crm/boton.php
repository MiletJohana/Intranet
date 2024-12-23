<?php
include "../../resources/template/credentials.php";
//Botones de transacciones
if ($_POST['resp'] == 0) { ?>
    <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else if ($_POST['resp'] == 1) { ?>
    <?php if ($_POST['param'] == 1) { ?>
        <button type="submit" id="crear" class="btn btn-danger" onclick="crearNegocio(<?php echo $_POST['param'] ?>, <?php echo $_POST['id_cli'] ?>);" disabled>Crear</button>
    <?php } else if ($_POST['param'] == 2) { ?>
        <button type="submit" id="crear" class="btn btn-danger" onclick="crearNegocio(<?php echo $_POST['param'] ?>, <?php echo $_POST['id_cli'] ?>);">Crear</button>
    <?php } ?>
    <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } else if ($_POST['resp'] == 2) { ?>
    <?php if ($_POST['param'] == 2) { ?>
        <button type="submit" id="editar" class="btn btn-danger" onclick="editarNegocio(<?php echo $_POST['param'] ?>, <?php echo $_POST['id_cli'] ?>);">Editar</button>
    <?php } else { ?>
        <button type="submit" id="editar" class="btn btn-danger" onclick="editarNegocio(<?php echo $_POST['param'] ?>, <?php echo $_POST['id_neg'] ?>);">Editar</button>
    <?php } ?>
    <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } else if ($_POST['resp'] == 10) { ?>
    <?php if ($_POST['param'] == 1) { ?>
        <button type="submit" id="crear" class="btn btn-danger" onclick="crearTransaccion(<?php echo $_POST['param'] ?>, <?php echo $_POST['id_cli'] ?>);" disabled>Crear</button>
    <?php } else if ($_POST['param'] == 2) { ?>
        <button type="submit" id="crear" class="btn btn-danger" onclick="crearTransaccion(<?php echo $_POST['param'] ?>, <?php echo $_POST['id_neg'] ?>);" disabled>Crear</button>
    <?php } ?>
    <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } else if ($_POST['resp'] == 11) { ?>
    <button type="submit" id="editar" class="btn btn-danger" onclick="crearTransaccion(<?php echo $_POST['param'] ?>, <?php echo $_POST['id_tran'] ?>);" disabled>Editar</button>
    <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } else if ($_POST['resp'] == 12) { ?>
    <button type="submit" id="editar" class="btn btn-danger" onclick="eliminarTransaccion(<?php echo $_POST['param'] ?>, <?php echo $_POST['id_tran'] ?>);">Eliminar</button>
    <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } ?>