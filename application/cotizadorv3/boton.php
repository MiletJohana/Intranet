<?php if ($_POST['resp'] == 1) { ?>
    <button id="btnAgregar" class="btn btn-danger" onclick="crearCotizacion(1);">Crear Cotización</button>
    <button id="cerrar1" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="refreshTable(<?php echo $_POST['cerrar']; ?>)">Cerrar</button>
<?php } else if ($_POST['resp'] == 2) { ?>
    <button id="btnCliente" class="btn btn-danger" onclick="crearClientec();" disabled>Crear Cliente</button>
    <button id="cerrar2" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="refreshTable(<?php echo $_POST['cerrar']; ?>)">Cerrar</button>
<?php } else if ($_POST['resp'] == 3) { ?>
    <button id="btnContacto" class="btn btn-danger" onclick="crearContacto();" disabled>Crear Contacto</button>
    <button id="cerrar3" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="refreshTable(<?php echo $_POST['cerrar']; ?>)">Cerrar</button>
<?php } else if ($_POST['resp'] == 4) { ?>
    <button id="btnProducto" class="btn btn-danger" onclick="crearProducto();" disabled>Crear Producto</button>
    <button id="cerrar4" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="refreshTable(<?php echo $_POST['cerrar']; ?>)">Cerrar</button>
<?php } else if ($_POST['resp'] == 5) { ?>
    <button id="btnDatos" class="btn btn-danger" onclick="actualizarDatos(<?php $_POST['id_usu'] ?>);">Actualizar Datos</button>
    <button id="cerrar5" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="refreshTable(<?php echo $_POST['cerrar']; ?>)">Cerrar</button>
<?php } else if ($_POST['resp'] == 6) { ?>
    <button id="btnCliente" class="btn btn-danger" onclick="actualizarCotizacion();">Actualizar Cotización</button>
    <button id="cerrar7" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="refreshTable(<?php echo $_POST['cerrar']; ?>)">Cerrar</button>
<?php } else if ($_POST['resp'] == 7) { ?>
    <button id="btnCliente" class="btn btn-danger" onclick="actualizarClie();">Actualizar Cliente</button>
    <button id="cerrar7" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="refreshTable(<?php echo $_POST['cerrar']; ?>)">Cerrar</button>
<?php } else if ($_POST['resp'] == 8) { ?>
    <button id="btnContacto" class="btn btn-danger" onclick="actualizarCont();">Actualizar Contacto</button>
    <button id="cerrar8" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="refreshTable(<?php echo $_POST['cerrar']; ?>)">Cerrar</button>
<?php } else if ($_POST['resp'] == 9 || $_POST['resp'] == 19) { ?>
    <button id="btnProducto" class="btn btn-danger" onclick="actualizarProd(<?php if ($_POST['resp'] == 9) { echo 1;} else { echo 2; }?>);">Actualizar Producto</button>
    <button id="cerrar9" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="refreshTable(<?php echo $_POST['cerrar']; ?>)">Cerrar</button>
<?php } elseif ($_POST['resp'] == 10) { ?>
    <button id="emailMas" class="btn btn-danger" onclick="crearContaEma( );">Enviar Email</button>
    <button id="" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else if ($_POST['resp'] == 11) { ?>
    <button id="btnAgregar" class="btn btn-primary" style="background-color:#363a40" onclick="crearCotizacion(1);"><i class="fa-solid fa-clone"></i> Duplicar Cotización</button>
    <button id="cerrar7" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="refreshTable(<?php echo $_POST['cerrar']; ?>)">Cerrar</button>
<?php } else if ($_POST['resp'] == 12) { ?>
    <button id="btnClienteElim" class="btn btn-danger" onclick="eliminar(12,<?php echo $_POST['elim']; ?>,'elimClie',2);">Eliminar</button>
    <button id="" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else if ($_POST['resp'] == 13) { ?>
    <button id="btnClienteElim" class="btn btn-danger" onclick="eliminar(13,<?php echo $_POST['elim']; ?>,'elimCont',2);">Eliminar</button>
    <button id="" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else if ($_POST['resp'] == 14) { ?>
    <button id="btnClienteElim" class="btn btn-danger" onclick="eliminar(14,<?php echo $_POST['elim']; ?>,'elimProd',2);">Eliminar</button>
    <button id="" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else if ($_POST['resp'] == 15) { ?>
    <button id="btnDatos" class="btn btn-danger" onclick="subirCoti(<?php echo $_POST['id_usu']; ?>);">Subir Cotización</button>
    <button id="cerrar5" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="refreshTable(<?php echo $_POST['cerrar']; ?>)">Cerrar</button>
<?php } else if ($_POST['resp'] == 16) { ?>
    <button id="btnDatos" class="btn btn-danger" onclick="actualizarCoti();">Actualizar Cotización</button>
    <button id="cerrar5" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="refreshTable(<?php echo $_POST['cerrar']; ?>)">Cerrar</button>
<?php } else if ($_POST['resp'] == 17) { ?>
    <button id="editar" class="btn btn-danger" onclick="modCoti();">Enviar Pedido </button>
    <button id="cerrar5" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else if ($_POST['resp'] == 18) { ?>
    <button id="btnAgregar" class="btn btn-danger" onclick="crearCotizacion(2);">Crear Cotización</button>
    <button id="cerrar1" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else { ?>
    <button id="elim" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } ?>