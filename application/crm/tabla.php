<?php

include "../../resources/template/credentials.php";
include "../../conexion.php";

?>
<style>
    #tableNegocios_processing {
        background-color: #6b6b6b !important;
    }
</style>
<div class="col-12 mt-3">
    <div class="table-responsive-sm">
        <table class="table table-bordered" id="tableNegocios">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Valor</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            serverSideNegocios(0);
        });
    </script>
</div>