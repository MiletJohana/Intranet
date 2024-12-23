<?php
include "../../resources/template/credentials.php";
include '../../conexion.php';
?>

<div class="d-flex">
    <h3>Actividad Cliente</h3>
    <?php if ($param == 1) {
        $id_cli = $_GET['id']; ?>
        <button type="button" onclick="modalTransaccion(10, 0, <?php echo $_GET['id']; ?>, 0, 1);" class="btn btn-danger btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#largeModal">
            <i class="fa-solid fa-plus" style="font-size: initial;"></i>
        </button>
    <?php } else if ($param == 2) {
        $id_neg = $_GET['id']; ?>
        <button type="button" onclick="modalTransaccion(10, <?php echo $_GET['id']; ?>, 0, 0, 2);" class="btn btn-danger btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#largeModal">
            <i class="fa-solid fa-plus" style="font-size: initial;"></i>
        </button>
    <?php } ?>
    <button type="button" id="hide-transacciones" onclick="ocultar('transacciones', 0)" class="btn btn-warning ms-2 btn-sm">
        <i class="fa-solid fa-eye-slash" id="icon-hide-transacciones" style="font-size: initial;"></i>
    </button>
</div>
<div id="transacciones">
    <style>
        #tableTransacciones_processing {
            background-color: #6b6b6b !important;
        }
    </style>
    <div class="row mt-3">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableTransacciones">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Tipo</th>
                            <th>Usuario</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                    serverSideTransacciones(<?php $_GET['id']; ?>, <?php $param ?>);
                });
            </script>
        </div>
    </div>
</div>