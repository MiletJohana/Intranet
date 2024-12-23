<?php
include "../../conexion.php";
include '../../resources/template/credentials.php';
include "functions.php";

$sqlSelSeg = "SELECT * FROM ind_desc_x_seg WHERE id_desc = " . $_POST['id'] . " ORDER BY fec_mod DESC";
$querySelSeg = $conexion->query($sqlSelSeg);

$sqlDesc = "SELECT * FROM ind_desc WHERE id_desc = " . $_POST['id'];
$queryDesc = $conexion->query($sqlDesc);

?>
<style>
    th {
        text-align: center;
    }
</style>
<h3 align="center">Seguimiento N°<?php echo $_POST['id'] ?></h3>
<hr class="mx-auto" style="width:60%;">
<div class="col-12">
    <div class="table-responsive">
        <table class="table text-center bg-light rounded">
            <?php if ($queryDesc->rowCount() > 0) { ?>
                <br>
                <thead>
                    <tr>
                        <th colspan="7" style="font-size: 1.3em;">
                            Descuento
                        </th>
                    </tr>
                    <tr id="th">
                        <th>#</th>
                        <th>Solicitante</th>
                        <th>Valor del descuento</th>
                        <th>Cant. Cuotas</th>
                        <th>Entidad</th>
                        <th>Registrado por:</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $queryDesc->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $r['id_desc']; ?></td>
                            <td><?php echo usus(($r['id_usus']), $conexion); ?></td>
                            <td><?php echo '$ ' .  number_format($r['val_desc']); ?></td>
                            <td><?php echo $r['cuo_des']; ?></td>
                            <td><?php echo $r['conc_desc']; ?></td>
                            <td><?php echo usus(($r['id_usu']), $conexion); ?></td>
                            <td><?php echo esta(($r['id_estado']), $conexion); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            <?php } else { ?>
                <div class="alert alert-success alert-dismissible fade show mt-4 d-flex align-items-center" role="alert">
                    <i class="fa-solid fa-circle-check me-3 fa-xl"></i>
                            No hay resultados
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php } ?>
        </table>
    </div>
</div>

<div class="col-12" style="overflow-y: scroll; height: 220px; margin-bottom: 2.5em;">
    <div class="table-responsive" style="max-height:800px">
        <table class="table text-center" style="font-size: 90%; height: 200px;">
            <?php if ($querySelSeg->rowCount() > 0) { ?>
                <br>
                <thead>
                    <tr>
                        <th colspan="6" style="font-size: 1.3em;">
                            Seguimiento
                        </th>
                    </tr>
                    <tr>
                        <th>Ultima modificación:</th>
                        <th>Usuario que modifica:</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $querySelSeg->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $r['fec_mod']; ?></td>
                            <td><?php echo usus($r['id_usu'], $conexion); ?></td>
                            <td><?php echo esta($r['id_estado'], $conexion); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            <?php } else { ?>
                <div class="alert alert-success alert-dismissible fade show mt-4 d-flex align-items-center" role="alert">
                    <i class="fa-solid fa-circle-check me-3 fa-xl"></i>
                            No hay resultados
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
        </table>
    </div>
</div>