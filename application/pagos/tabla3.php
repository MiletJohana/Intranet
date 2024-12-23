<?php
include '../../../resources/template/credentials.php';
?>
<?php echo $sesion_are; ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="tablePagos3">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Mes</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Colaborador</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
            </table>
        </div>
    <script type="text/javascript">
        $(document).ready(function() {
            serverSideErrorNomina();
        });
    </script>
</div>