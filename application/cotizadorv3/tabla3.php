<?php
    include '../../resources/template/credentials.php';
?>
<style>
    #tableCotizaciones1_processing {
        background-color: #6b6b6b !important;
    }
</style>
<div class="col-12">
    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="tableCotizaciones1">
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>Cons.</th>
                    <th>Tipo de cotización</th>
                    <th>Creación</th>
                    <th>Cliente</th>
                    <th>Acción</th>
                </tr>
            </thead>

        </table>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            serverSideCotHis(<?php echo $_SESSION['id']; ?>);
        });
    </script>
</div>