<?php
    include "../../resources/template/credentials.php";
    
    if ($_POST['resp'] == 1) { ?>
        <button id="adm_inv" type="button" class="btn btn-danger" onclick="adm_inventario();"><i class="fa-solid fa-floppy-disk me-2"></i> Aplicar Cambios</button>
        <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } else if ($_POST['resp'] == 4) { ?>
        <button id="agregar_prod" type="button" class="btn btn-danger" onclick="inv_crud('form-productos-inv','tableInvProducts');"><i class="fa-solid fa-floppy-disk me-2"></i> Crear Producto</button>
        <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } else if ($_POST['resp'] == 5) { ?>
        <button id="editar_prod" type="button" class="btn btn-danger" onclick="inv_crud('form-productos-inv','tableInvProducts');"><i class="fa-solid fa-pen-to-square me-2"></i> Editar Producto</button>
        <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } else if ($_POST['resp'] == 6) { ?>
        <button id="delete_prod" type="button" class="btn btn-danger" onclick="deleteProduct();"><i class="fa-solid fa-trash-arrow-up me-2"></i> Si, eliminar</button>
        <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">No, cancelar</button>
<?php } else if ($_POST['resp'] == 7) { ?>
        <button id="agregar_are" type="button" class="btn btn-danger" onclick="inv_crud('form-areas-inv','tableInvAreaXProd');"><i class="fa-solid fa-floppy-disk me-2"></i> Crear</button>
        <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } else if ($_POST['resp'] == 8) { ?>
        <button id="editar_prod" type="button" class="btn btn-danger" onclick="inv_crud('form-areas-inv','tableInvAreaXProd');"><i class="fa-solid fa-pen-to-square me-2"></i> Editar</button>
        <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } else if ($_POST['resp'] == 9) { ?>
        <button id="delete_prod_x_are" type="button" class="btn btn-danger" onclick="delete_prod_x_area();"><i class="fa-solid fa-trash-arrow-up me-2"></i> Si, quitar</button>
        <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">No, cancelar</button>
<?php } else if ($_POST['resp'] == 10){ ?>
        <button id="add_pro_x_area" type="button" class="btn btn-danger" onclick="asig_prod_x_are('tableInvAreaXProd');" disabled>Asignar Producto</button>
        <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="limpiarArrayProd()">Cerrar</button>
<?php } else { ?>
        <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php }
