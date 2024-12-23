<?php
    include "../../resources/template/credentials.php";
    
    if ($_POST['resp'] == 1 || $_POST['resp'] == 1.1) { ?>
        <button id="adm_inv" type="button" class="btn btn-danger" onclick="verResumenInv(2);" disabled><i class="fa-solid fa-clipboard-check me-2"></i> Confirmar Solicitud</button>
        <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="limpiarArrayProd();">Cerrar</button>
<?php } else if ($_POST['resp'] == 2) { ?>
        <div class="w-100 d-flex justify-content-between">
             <div> 
                <button id="agregar_prod" type="button" class="btn btn-info" onclick="regresarSolInv(1);"><i class="fa-solid fa-arrow-left me-2"></i> Regresar</button>
             </div>
             <div>
                <button id="agregar_prod" type="button" class="btn btn-danger" onclick="inv_create_sol('table_inv_solicitud');"><i class="fa-solid fa-truck-fast me-2"></i> Solicitar</button>
                <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="limpiarArrayProd();">Cerrar</button>
             </div>
        </div>
<?php } else if ($_POST['resp'] == 3) { ?>
        <button id="delete_sol" type="button" class="btn btn-danger" onclick="deleteSolInv();"><i class="fa-solid fa-trash-arrow-up me-2"></i> Si, eliminar</button>
        <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">No, cancelar</button>
<?php } else if ($_POST['resp'] == 4 || $_POST['resp'] == 4.1) { ?>
        <div class="w-100 d-flex justify-content-between">
             <div> 
                <button id="agregar_prod" type="button" class="btn btn-success" onclick="confirm_entrega(5);"><i class="fa-solid fa-circle-check me-2"></i> Entregar</button>
                <?php if($_POST['resp'] != 4.1){ ?>
                        <button id="agregar_prod" type="button" class="btn btn-danger" onclick="confirm_rechazo_sol(6);"><i class="fa-solid fa-ban me-2"></i> Rechazar</button>
                <?php } ?>
             </div>
             <div>
                <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="limpiarArrayProd();">Cerrar</button>
             </div>
        </div>
<?php } else if ($_POST['resp'] == 5) { ?>
        <div class="w-100 d-flex justify-content-between">
             <div> 
                <button id="agregar_prod" type="button" class="btn btn-warning" onclick="validar_cant_prod();"><i class="fa-solid fa-clipboard-check me-2"></i> Validar y Establecer Cantidades</button>
             </div>
             <div>
                <button id="btn_confirm_entrega" type="button" class="btn btn-success" onclick="entregar_sol();" disabled><i class="fa-solid fa-circle-check me-2"></i> Confirmar Entrega</button>
                <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="limpiarArrayProd();">Cerrar</button>
             </div>
        </div>
<?php } else if ($_POST['resp'] == 6) { ?>
        <button id="btn_rechazar_sol" type="button" class="btn btn-danger" onclick="rechazar_sol();"><i class="fa-solid fa-clipboard-check me-2"></i> Si, rechazar</button>
        <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="limpiarArrayProd();">Cancelar</button>
<?php } else if ($_POST['resp'] == 7) { ?>
        <div class="w-100 d-flex justify-content-between">
             <div> 
                <button id="btn_aprob_prod" type="button" class="btn btn-success" onclick="aprobar_prod('table_inv_solicitud');" disabled><i class="fa-solid fa-clipboard-check me-2"></i> Aprobar</button>
                <button id="btn_rechazar_prod" type="button" class="btn btn-danger" onclick="rechazar_sol('table_inv_solicitud');" disabled><i class="fa-solid fa-circle-check me-2"></i> Rechazar</button>
             </div>
             <div>
                <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="limpiarArrayProd();">Cerrar</button>
             </div>
        </div>
<?php } else if ($_POST['resp'] == 9) { ?>
        <button id="delete_prod_x_are" type="button" class="btn btn-danger" onclick="delete_prod_x_area();"><i class="fa-solid fa-trash-arrow-up me-2"></i> Si, quitar</button>
        <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">No, cancelar</button>
<?php } else { ?>
        <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php }