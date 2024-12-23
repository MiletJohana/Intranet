
<div class="col-12 mt-3 mb-4">
    <button type="button" onclick="newSolicitudInventario(1,'Mi Solicitud','../solicitudInven/form.php');" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#largeModal">
        Crear mi Solicitud
    </button>
    <?php if (isset($_SESSION['rol_inv']) && $_SESSION['rol_inv'] == 2) { ?>
        <button type="button" onclick="newSolicitudInventario(1.1,'Solicitar Productos','../solicitudInven/form.php');" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#largeModal">
            Crear Solicitud para Personal
        </button> 
    <?php } ?>
</div>

<div class="col-12">
    <div class="table-responsive">
        <table class="table table-hover table-bordered" style="width:100%" id="table_inv_solicitud">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th></th>
                    <th>Productos - Cantidad</th>
                    <th>Estado</th>
                    <th>Fecha de Solicitud</th>
                    <th></th>
                </tr>
            </thead>
           
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        serverSideInvSolicitud(1, <?php echo (isset($sesion_id)) ? $sesion_id : ''; ?>, <?php echo (isset($_SESSION['rol_inv'])) ? $_SESSION['rol_inv'] : ''; ?>);
    });
</script>
