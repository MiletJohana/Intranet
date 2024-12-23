<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");
$hora = date("H:i:s");
$mes = date('Y-m');

/*use masterqu_intranet;
create VIEW correspondencia_view1
AS SELECT cor.id_seg, cor.id_estSeg, us.nom_usu, nom.nom_doc, cor.fech_ini, ar.nom_are, 
cor.per_encarga, es.nom_estS, cor.id_nom, cli.id_cli, cor.fec_ven, cor.num_facR, cli.nom_cli, cor.id_prove
FROM correspondencias AS cor
LEFT JOIN mq_usu AS us
ON cor.id_usu = us.id_usu
LEFT JOIN seg_nomdoc AS nom
ON cor.id_nom = nom.id_nom
LEFT JOIN mq_are AS ar
ON cor.area_remit = ar.id_are
LEFT JOIN seg_estado AS es
ON cor.id_estSeg = es.id_estSeg
LEFT JOIN mq_reg AS reg
ON cor.id_reg = reg.id_reg
LEFT JOIN mq_clientes AS cli
ON cor.id_prove = cli.id_cli
GROUP BY cor.id_seg */
$sql1 = "SELECT cor.id_seg, cor.id_estSeg, us.nom_usu, nom.nom_doc, cor.fech_ini, ar.nom_are, 
cor.per_encarga, es.nom_estS, cor.id_nom, cli.id_cli, cor.fec_ven, cor.num_facR, cli.nom_cli, cor.id_prove
FROM correspondencias AS cor
LEFT JOIN mq_usu AS us
ON cor.id_usu = us.id_usu
LEFT JOIN seg_nomdoc AS nom
ON cor.id_nom = nom.id_nom
LEFT JOIN mq_are AS ar
ON cor.area_remit = ar.id_are
LEFT JOIN seg_estado AS es
ON cor.id_estSeg = es.id_estSeg
LEFT JOIN mq_reg AS reg
ON cor.id_reg = reg.id_reg
LEFT JOIN mq_clientes AS cli
ON cor.id_prove = cli.id_cli
WHERE cor.id_seg != ''";

if (isset($_SESSION['rol']) && $_SESSION['rol'] != 400) {
    if (isset($_POST['misC']) && $_POST['misC'] != '') {
        $sql1 .= " AND (cor.id_usu='" . $_SESSION['id'] . "' or cor.per_encarga='" . $_SESSION['id'] . "')";
    } else {
        $sql1 .= " AND cor.per_encarga=" . $_SESSION['id'];
    }
}
if (isset($_POST['para'])) {
    $para = $_POST['para'];
    $sql1 .= " AND cor.id_estSeg IN ($para[0]) 
                       AND cor.fech_cre  LIKE '$para[1]%'";
} else {
    $sql1 .= "  AND cor.id_estSeg = 1 ";
    $sql1 .= "  AND cor.fech_cre  LIKE '$mes%'";
}
$sql1 .= " GROUP BY cor.id_seg";
$query = $conexion->query($sql1);
//echo $sql1;
?>
 
<div class="col-12 mt-3">  
        <div class="table-responsive">
            <table class="table table-bordered" id="tableCorrespondencia">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre del Creador</th>
                        <th>Nombre del Documento </th>
                        <th>Proveedor</th>
                        <th>Fecha</th>
                        <th>N-Fact </th>
                        <th>Remitido A </th>
                        <th>Estado</th>
                        <?php if (!isset($_POST['misC'])) { ?>
                            <th>Recibir</th>
                        <?php } ?>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $segui = null;
                    while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
                        $segui .= $r['id_seg'] . ',';
                        $sqlU = "SELECT us.nom_usu FROM mq_usu us WHERE id_usu=" . $r['per_encarga'];
                        $queryU = $conexion->query($sqlU);
                        $r2 = $queryU->fetch(PDO::FETCH_ASSOC);
                        //echo $sqlU;
                        $sqlVerU = "SELECT * FROM correspondencias WHERE id_seg='" . $r['id_seg'] . "' AND id_usu=" . $_SESSION['id'];
                        $queryVerU = $conexion->query($sqlVerU);
                       // echo $sqlVerU;
                        $sqlAcep = "SELECT * FROM `seg_ingre_x_movi` WHERE id_usu='" . $_SESSION['id'] . "' and id_seg='" . $r['id_seg'] . "' and id_estSeg=3";
                        $queryAcep = $conexion->query($sqlAcep);
                        $r5 = $queryAcep->fetch(PDO::FETCH_ASSOC);
                        // echo $sqlAcep;
                        if ($queryAcep->rowCount() > 0) {
                        } else {
                            $but = 1; ?>
                            <tr>
                                <td><?php echo $r["id_seg"]; ?></td>
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
                                <td>
                                    <?php if (is_null($r["num_facR"])) {
                                        echo '--';
                                    } else {
                                        echo $r["num_facR"];
                                    } ?>
                                </td>
                                <td><?php echo $r2['nom_usu']; ?></td>
                                <td><?php echo $r["nom_estS"]; ?></td>
                                <td>
                                    <label>
                                        <input type="checkbox" value="3" name="estReci<?php echo $r['id_seg']; ?>" id="estReci<?php echo $r['id_seg']; ?>" onclick="aceptado(<?php echo $r['id_seg'] . ',' . $r['id_nom'] . ',' . $r['id_cli'] . ',' . $r['id_estSeg']; ?>);" <?php if ($queryAcep->rowCount() > 0) {
                                                                                                                                                                                                                                                                                        echo 'checked disabled';
                                                                                                                                                                                                                                                                                    } ?>>
                                    </label>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">
                                            <a onclick="mostrarCorr(<?php echo $r['id_seg'] . ',' . $r['id_estSeg']; ?>);" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-share me-1"></i> Seguimiento</a>
                                            <a onclick="entregarCorr(<?php echo $r['id_seg'] . ',' . $r['id_estSeg'] . ',' . $r['id_nom'] . ',' . $r['id_prove']; ?>);" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-address-card me-1"></i> Remitir</a>
                                            <?php if ($_SESSION['lid'] == 1 || ($_SESSION['lid'] == 2 && $_SESSION['are'] == 13)) { ?>
                                                <a onclick="confirmarEliminarCorr(<?php echo $r['id_seg']; ?>);" class="btn btn-link dropdown-item"><i class="fa-solid fa-trash me-1"></i> Eliminar</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
        <script>
            $(document).ready(function() {
                $('#tableCorrespondencia').DataTable({
                    "ordering": true,
                    "order": [
                        [0, "desc"]
                    ]
                });
                $('.dataTables_length').addClass('bs-select');
            });
        </script>

</div>