<?php

    include '../../conexion.php';
    include '../../resources/template/credentials.php';
    date_default_timezone_set("America/Bogota");

    $sqlReg="SELECT * FROM mq_reg WHERE id_reg = ".$_POST['id_reg'].";";
    $queryReg = $conexion ->query($sqlReg);
    $rowInfoReg = $queryReg->fetch(PDO::FETCH_ASSOC);

    $sqlTotal="SELECT * FROM inv_inventario WHERE id_reg = ".$_POST['id_reg'].";";
    $queryTotal = $conexion ->query($sqlTotal);
    $rowInfoTotal = $queryTotal->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="row mb-3">
    <div class="col-12 text-center">
        <h3><i class="fa-solid fa-boxes-stacked"></i></h3>
        <h3>Administrar Inventario</h3>
        <p>Regional: <?php echo $rowInfoReg['nom_reg']; ?></p>
        <p>Productos Asignados: <?php echo count($rowInfoTotal); ?></p>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12 text-center">
        <button type="button" class="btn btn-info" onclick="selectAllProd();">Seleccionar Todos</button>
        <button type="button" class="btn btn-warning" onclick="desmarcarAllProd();">Desmarcar Todos</button>
    </div>
</div>

<div class="row mb-3">
    <div class="col-12 text-center">
        <div class="table-responsive">
            <table class="table table-hover table-bordered" style="width:100%" id="tableInventarioProd">
                <thead class="table-danger">
                    <tr>
                        <th>Producto</th>
                        <th>Activo</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        serverSideInventarioProd(<?php echo json_encode($rowInfoTotal); ?>);
    });
</script>
    </div>
</div>