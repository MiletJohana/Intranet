<?php
include "../../conexion.php";
include '../../resources/template/credentials.php';
include "functions.php";

$sqlCuo = "SELECT * FROM ind_des_cuo WHERE id_desc = " . $_POST['id'];
$queryCuo = $conexion->query($sqlCuo);

$sqlDesc = "SELECT * FROM ind_desc WHERE id_desc = " . $_POST['id'];
$queryDesc = $conexion->query($sqlDesc);

$hoy = date("Y-m-d");

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
        <table class="table text-center bg-light">
            <?php if ($queryDesc->rowCount() > 0) { ?>
                <br>
                <thead>
                    <tr>
                        <th colspan="6" style="font-size: 1.3em;">
                            Descuento
                        </th>
                    </tr>
                    <tr id="th">
                        <th>#</th>
                        <th>Solicitante</th>
                        <th>Valor del descuento</th>
                        <th>Cant. Cuotas</th>
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
<div class="col-12">
    <div class="table-responsive">
        <table class="table text-center bg-light">
            <?php if ($queryCuo->rowCount() > 0) { ?>
                <br>
                <thead>
                    <tr>
                        <th colspan="6" style="font-size: 1.3em;">
                            Cuotas
                        </th>
                    </tr>
                    <tr>
                        <th>Descuento:</th>
                        <th>Fecha de descuento:</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $queryCuo->fetch(PDO::FETCH_ASSOC)) {
                        if (strtotime($r['fec_desc']) < strtotime($hoy)) { ?>
                            <tr class="bg-danger">
                                <td><?php echo '$ ' . number_format($r['cuot_desc']); ?></td>
                                <td><?php echo ($r['fec_desc']); ?></td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td><?php echo '$ ' . number_format($r['cuot_desc']); ?></td>
                                <td><?php echo ($r['fec_desc']); ?></td>
                            </tr>
                        <?php } ?>
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