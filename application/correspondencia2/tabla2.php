<?php
include '../../resources/template/credentials.php';
include "../../conexion.php";

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");
$hora = date("H:i:s");
$mes = date('Y-m');

/*$sqlAcep = "SELECT * FROM seg_ingre_x_movi 
WHERE id_usu='" . $_SESSION['id'] . "' 
AND id_seg='" . $r['id_seg'] . "' 
AND id_estSeg=3";
$queryAcep = $conexion->query($sqlAcep);*/

$sql1 = "SELECT corr.id_seg , corr.id_estSeg, us.nom_usu, 
nom.nom_doc, corr.fech_cre, corr.fech_ini, 
ar.nom_are, corr.per_encarga, es.nom_estS, 
corr.id_nom, corr.id_prove, corr.fec_ven,
cli.nom_cli, corr.num_facR, cli.id_cli
FROM correspondencias AS corr
INNER JOIN mq_usu AS us
ON corr.id_usu = us.id_usu
INNER JOIN seg_nomdoc AS nom
ON corr.id_nom = nom.id_nom
INNER JOIN mq_are AS ar
ON corr.area_remit = ar.id_are
INNER JOIN seg_estado AS es
ON corr.id_estSeg = es.id_estSeg
INNER JOIN seg_ingre_x_movi AS inse
ON corr.id_seg = inse.id_seg
INNER JOIN mq_reg AS reg
ON corr.id_reg = reg.id_reg
INNER JOIN mq_clientes AS cli
ON corr.id_prove = cli.id_cli
WHERE corr.id_prove != ''";

if (isset($_SESSION['rol']) && $_SESSION['rol'] != 400) {
    $sql1 .= " AND corr.per_encarga=" . $_SESSION['id'];
}
if (isset($_POST['para'])) {
    $para = $_POST['para'];
   
    $sql1 .= " AND corr.id_estSeg IN ($para[0]) 
                       AND corr.fech_cre  LIKE '$para[1]%'";
} else {
    $sql1 .= "  AND corr.id_estSeg = 1 ";
    $sql1 .= "  AND corr.fech_cre  LIKE '$mes%'";
}
$sql1 .= " GROUP BY corr.id_seg";
$query = $conexion->query($sql1);
//echo $sql1;
?>
<div class="col-12 mt-4">
    <?php if ($query->rowCount() > 0 && !isset($_POST['misC'])) { ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="tableCorrespondencia2">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre del Creador</th>
                        <th>Nombre del Documento </th>
                        <th>Proveedor</th>
                        <th>Fecha De Creación</th>
                        <th>N-Fact </th>
                        <th>Remitido A </th>
                        <th>Estado</th>
                        <th>Recibir</th>
                        <?php if ($_SESSION['are'] == 5 || $_SESSION['lid'] == 2 || $_SESSION['lid'] == 1) { ?>
                            <th>Finalizado</th>
                        <?php } ?>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
                        $sqlU = "SELECT us.nom_usu FROM mq_usu us WHERE id_usu=" . $r['per_encarga'];
                        $queryU = $conexion->query($sqlU);
                        $r2 = $queryU->fetch(PDO::FETCH_ASSOC);

                        $sqlfin = "SELECT * FROM `seg_ingre_x_movi` WHERE id_usu='" . $_SESSION['id'] . "' and id_seg='" . $r['id_seg'] . "' and id_estSeg=6";
                        $queryfin = $conexion->query($sqlfin);
                        $r5 = $queryfin->fetch(PDO::FETCH_ASSOC); ?>
                        <tr>
                            <td class="table-td-sm center-text">
                                <?php echo $r["id_seg"]; ?>
                            </td>
                            <td><?php echo $r["nom_usu"]; ?></td>
                            <td><?php echo $r["nom_doc"]; ?></td>
                            <td>
                                <?php if ($r["nom_cli"] != '') { ?>
                                    <a href="../clientes2/index.php?id=<?php echo $r["id_cli"]; ?>" target="_blank"><?php echo $r["nom_cli"]; ?></a>
                                <?php } else {
                                    echo '--';
                                } ?>
                            </td>
                            <td><?php echo ($r["fech_ini"]); ?></td>
                            <td><?php if ($r["num_facR"] != '') {
                                    echo $r["num_facR"];
                                } else {
                                    echo '--';
                                } ?></td>
                            <td><?php echo $r2['nom_usu']; ?></td>
                            <td><?php echo $r["nom_estS"]; ?></td>
                            <td>
                                <label>
                                    <input type="checkbox" value="3" name="estReci<?php echo $r['id_seg']; ?>" id="estReci<?php echo $r['id_seg']; ?>" checked disabled>
                                </label>
                            </td>
                            <?php if ($_SESSION['are'] == 5 || $_SESSION['lid'] == 2 || $_SESSION['lid'] == 1) { ?>
                                <td>
                                    <label>
                                        <input type="checkbox" value="6" name="estFin<?php echo $r['id_seg']; ?>" id="estFin<?php echo $r['id_seg']; ?>" onclick="finalizado(<?php echo $r['id_seg'] . ',' . $r['id_nom'] . ',' . $r['id_prove'] ?>);" <?php if ($queryfin->rowCount() > 0) {
                                                                                                                                                                                                                                    echo 'checked disabled';
                                                                                                                                                                                                                                } ?>>
                                    </label>
                                </td>
                            <?php } ?>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">
                                        <?php if ($r['id_nom'] == 1 || $r['id_nom'] == 2 || $r['id_nom'] == 3 || $r['id_nom'] == 4 || $r['id_nom'] == 5 || $r['id_nom'] == 6 || $r['id_nom'] == 10) { ?>
                                            <a onclick="mostrarCorr(<?php echo $r['id_seg'] . ',' . $r['id_estSeg'] . ',' . $r['id_nom'] . ',' . $r['id_prove']; ?>);" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-share me-1"></i> Seguimiento</a>
                                        <?php }
                                        if (!isset($_POST['misC'])) { ?>
                                            <a onclick="entregarCorr(<?php echo $r['id_seg'] . ',' . $r['id_estSeg'] . ',' . $r['id_nom'] . ',' . $r['id_prove']; ?>);" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-address-card me-1"></i> Remitir</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <script>
            $(document).ready(function() {
                $('#tableCorrespondencia2').DataTable({
                    "ordering": true,
                    "order": [
                        [0, "desc"]
                    ]
                });
                $('.dataTables_length').addClass('bs-select');
            });
        </script>
    <?php } else { ?>
        <div class="alert alert-success alert-dismissible fade show mt-4 d-flex align-items-center" role="alert">
            <i class="fa-solid fa-circle-check me-3 fa-xl"></i>
            No hay resultados
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
</div>