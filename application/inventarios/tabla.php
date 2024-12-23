<div class="col-12 mt-3 mb-4">
    <button type="button" onclick="inv_modal_adm_inv(1,'Administrar Productos','../inventarios/form.php', <?php echo $_POST['reg']; ?>);" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#mediumModal">
        <i class="fa-solid fa-boxes-stacked me-2"></i> Administrar Productos
    </button>
</div>

<div class="col-12">
    <div class="table-responsive">
        <table class="table table-hover table-bordered" style="width:100%" id="table_inventarios">
            <thead class="table-dark">
                <tr>
                    <th>Imagen</th>
                    <th>Productos</th>
                    <th>Cantidad Actual</th>
                    <th>Asignar</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        serverSideInventario(<?php echo $_POST['reg']; ?>);
    });
</script>

