<style>
    #tableCotizaciones_processing {
        background-color: #6b6b6b !important;
    }
</style>
<div class="table-responsive">
    <table class="table table-bordered" id="tableCotizaciones">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Consecutivo</th>
                <th>Contacto</th>
                <th>Fecha de creación</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        serverSideCotizacionesCRM(<?php $_GET['id']; ?>, <?php $_SESSION['id']; ?>);
    });
</script>