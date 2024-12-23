<?php if ($_POST['resp'] == 1) { ?>
    <button id="btnAgregar" type="button" class="btn btn-danger" onclick="crearCotizacionAca();">Crear Cotización</button>
    <button id="cerrar1" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="refreshTable(<?php $_POST['cerrar'] ?>)">Cerrar</button>
<?php } else if ($_POST['resp'] == 2) { ?>
    <button id="btnCliente" type="button" class="btn btn-danger" onclick="crearCliente();" disabled>Crear Cliente</button>
    <button id="cerrar2" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="refreshTable(<?php $_POST['cerrar'] ?>)">Cerrar</button>
<?php } else if ($_POST['resp'] == 3) { ?>
    <button id="btnContacto" type="button" class="btn btn-danger" onclick="crearContacto();" disabled>Crear Contacto</button>
    <button id="cerrar3" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="refreshTable(<?php $_POST['cerrar'] ?>)">Cerrar</button>
<?php } else if ($_POST['resp'] == 4) { ?>
    <button id="btnProducto" type="button" class="btn btn-danger" onclick="crearProducto();" disabled>Crear Producto</button>
    <button id="cerrar4" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="refreshTable(<?php $_POST['cerrar'] ?>)">Cerrar</button>
<?php } else if ($_POST['resp'] == 5) { ?>
    <button id="btnDatos" type="button" class="btn btn-danger" onclick="actualizarDatos(<?php $_POST['id_usu'] ?>);">Actualizar Datos</button>
    <button id="cerrar5" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="refreshTable(<?php $_POST['cerrar'] ?>)">Cerrar</button>



<?php } else if ($_POST['resp'] == 7) { ?>
    <button id="btnCliente" type="button" class="btn btn-danger" onclick="actualizarClie();">Actualizar Cliente</button>
    <button id="cerrar7" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="refreshTable(<?php $_POST['cerrar'] ?>)">Cerrar</button>
<?php } else if ($_POST['resp'] == 8) { ?>
    <button id="btnContacto" type="button" class="btn btn-danger" onclick="actualizarCont();">Actualizar Contacto</button>
    <button id="cerrar8" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="refreshTable(<?php $_POST['cerrar'] ?>)">Cerrar</button>
<?php } else if ($_POST['resp'] == 9) { ?>
    <button id="btnProducto" type="button" class="btn btn-danger" onclick="actualizarProd();">Actualizar Producto</button>
    <button id="cerrar9" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="refreshTable(<?php $_POST['cerrar'] ?>)">Cerrar</button>
<?php } else { ?>
    <button id="elim" type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } ?>