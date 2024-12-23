<?php include "../../resources/template/credentials.php"; ?>
<div class="col-12 mt-3 mb-4">
    <?php if (isset($_SESSION['rol_inv']) && isset($_SESSION['lid']) && $_SESSION['rol_inv'] == 2 && $_SESSION['lid'] == 1) { ?>
        <button type="button" onclick="inv_modal_create(7,'Agregar Área','../administrarInven/form3.php' );" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#mediumModal">
            <i class="fa-solid fa-sliders me-2"></i> Administrar Áreas
        </button>
    <?php } ?>
    <button type="button" onclick="asig_x_prod(10,'Asignar Producto','../administrarInven/form4.php' );" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#mediumModal">
        <i class="fa-solid fa-file-excel me-2"></i> Asignar Productos
    </button>
</div>

<div class="col-12">
    <div class="table-responsive">
        <table class="table" style="width:100%" id="tableInvAreaXProd">
            <thead class="table-dark">
                <tr>
                    <th></th>
                    <th>Áreas</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        serverSideInvAreaXProd();
    });
</script>