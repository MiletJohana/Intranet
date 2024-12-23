<div class="col-12 mt-3 mb-5">
    <button type="button" onclick="inv_modal_create(4,'Nuevo Producto','../administrarInven/form2.php' );" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#mediumModal">
        <i class="fa-solid fa-plus me-2"></i> Agregar Producto
    </button>
    <!-- <button type="button" onclick="inv_modal_create(4,'Crear Solicitud','../administrarInven/form2.php' );" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#largeModal">
        <i class="fa-solid fa-file-excel me-2"></i> Cargue Masivo
    </button> -->
</div>

<div class="col-12">
        <div class="table-responsive">
            <table class="table table-hover table-bordered" style="width:100%" id="tableInvProducts">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Requiere Aprobación</th>
                        <th>Acción</th>
                    </tr>
                </thead>
            </table>
        </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        serverSideInvProducts();
    });
</script>
