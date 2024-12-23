<?php
include '../../conexion.php';

    $sql1 = "SELECT * FROM mq_enrt,mq_reg WHERE mq_enrt.id_reg = mq_reg.id_reg AND num_enr!=9999";
    if (isset($_POST['reg'])) {
        $sql1 .= " AND mq_enrt.id_reg = " . $_POST['reg'];
    } else {
        $sql1 .= " AND mq_enrt.id_reg = '$sesion_reg'";
    }
    

?>
<div class="col-12">
    <button type="button" onclick="crearEnrutamiento();" class="btn btn-danger mb-4" data-bs-toggle="modal" data-bs-target="#largeModal">
        Crear ruta
    </button>
        <div class="table-responsive">
            <table class="table table-bordered" id="tableEnrutamientos">
                <thead class="table-dark">
                    <tr>
                        <th>Numero Ruta</th>
                        <th>Fecha creación</th>
                        <th>Usuario que actualizo</th>
                        <th>Fecha actualización</th>
                        <th>Estado Ruta</th>
                        <th>Regional</th>
                        <th>Acción</th>
                    </tr>
                </thead>
            </table>
        </div>
</div>
<script>
    $(document).ready(function() {
        serverSideEnrutamientos();
    });
</script>

    
