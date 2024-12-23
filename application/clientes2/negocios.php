<style>
    #tableNegocios_processing {
        background-color: #6b6b6b !important;
    }
</style>
<div class="table-responsive mt-4">
    <table class="table table-bordered" id="tableNegocios">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Valor</th>
                <th>Acción</th>
            </tr>
        </thead>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        serverSideNegocios(<?php $_GET['id']; ?>);
    });
</script>