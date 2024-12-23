<?php
     if (isset($_SESSION['rol_inv']) && isset($_SESSION['lid']) && $_SESSION['rol_inv'] == 2 && $_SESSION['lid'] == 1) { 
        /* Consulta nombre y correo administrador */
        $sqlEmailAdmin = "SELECT * FROM inv_config WHERE id IN (?,?)";
        $queryEmailAdmin = $conexion -> prepare($sqlEmailAdmin);
        $queryEmailAdmin -> execute([1, 2]);

        $rowInfoEmailAdmin = $queryEmailAdmin->fetchAll(PDO::FETCH_ASSOC);

?>

        <div class="row g-0 mx-4">
            <div class="col-12 mt-4">
                <h3><i class="fa-solid fa-address-card me-3"></i>Credenciales del Administrador</h3>
                <hr>
                <p>*Estas credenciales son para el envío de correos electrónicos dirigidos al administrador o encargado del inventario de papelería.*</p>
            </div>
        </div>

        <div class="row g-0 mx-4">
            <div class="col-md-4 col-sm-12 me-4 mt-2">
                <label for="name_admin" class="form-label">Nombre Administrador</label>
                <input type="text" id="name_admin" class="form-control" value="<?php echo $rowInfoEmailAdmin[0]['valor']; ?>" readonly>
            </div>
            <div class="col-md-4 col-sm-12 mt-2">
                <label for="email_admin" class="form-label">Correo Administrador</label>
                <input type="email" id="email_admin" class="form-control" value="<?php echo $rowInfoEmailAdmin[1]['valor']; ?>" readonly>
            </div>
        </div>

        <div class="row g-0 mx-4 mt-2">
            <div class="col-12">
                <button type="button" class="btn btn-warning" id="btn_info_adm" onclick="change_info_adm(1);">Cambiar Correo</button>
                <button type="button" class="btn btn-success d-none" id="btn_upd_info">Guardar Cambios</button>
                <button type="button" class="btn btn-danger d-none" id="btn_cancelar" onclick="change_info_adm(2);">Cancelar</button>
            </div>
        </div>
<?php } else { ?>
        <div class="row g-0 mx-4">
            <div class="col-12 mt-4">
                <div class="alert alert-warning d-flex align-items-center fs-5" role="alert">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i>
                    <div>
                        <span class="fw-bold">Acceso denegado: </span> No tienes permisos para acceder a esta sección.
                    </div>
                </div>
            </div>
        </div>
       
    <?php } ?>