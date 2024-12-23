<?php
include "../../conexion.php";
include "../../plantilla/credentials.php";
include "functions.php";
$mes = $_POST['mes'];
$param = $_POST['param'];

$sqlRotPer = rotaPer(1, $param, 0, $mes, $conexion);
$querySqlRot = $conexion->query($sqlRotPer);

function cargos($id, $conexion){
    $sqlCarg = "SELECT * FROM ind_cargos WHERE id_carg = " . $id;
    $queryCarg = $conexion->query($sqlCarg);
    $rCarg = $queryCarg-> fetch(PDO::FETCH_ASSOC);
    return $rCarg['nom_carg'];
}
?>
<style>
    th {
        text-align: center;
    }
</style>
<h3 align="center">Mes: <?php echo convertMonth($mes, 0); ?></h3>
<div class="col-12">
    <div class="table-responsive" style="max-height:350px">
        <table class="table text-center" style="font-size: 90%; overflow-y: scroll;">
            <?php if ($querySqlRot->rowCount() > 0) { ?>
                <br>
                <thead>
                    <tr id="th">
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Cargo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $querySqlRot-> fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $r['id_usu']; ?></td>
                            <td><?php echo $r['nom_usu']; ?></td>
                            <td><?php echo cargos($r['id_carg'], $conexion); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            <?php } else { ?>
                <p class="alert alert-warning" style="margin-top: 60px;">No hay resultados</p>
            <?php } ?>
        </table>
    </div>
</div>