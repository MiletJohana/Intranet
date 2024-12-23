<?php
include '../../resources/template/credentials.php';

?>

<style>
    #tableProductosPrecios_processing {
        background-color: #6b6b6b !important;
    }
</style>
<div class="col-12">
    <div class="table-responsive-sm">
        <table class="table table-bordered table-sm" id="tableProductosPrecios">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Código stock</th>
                    <th>Nombre</th>
                    <th>Empaque</th>
                    <th>Familia</th>
                </tr>
            </thead>
        </table>
        <script type="text/javascript">
            $(document).ready(function() {
                serverSideProductosPrecios();
            });
        </script>
    </div>
</div>