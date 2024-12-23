<?php
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");
$hora = date("H:i:s");
$sql = "SELECT corr.id_seg, corr.id_estSeg, us.nom_usu, 
nom.nom_doc, corr.fech_ini, ar.nom_are, 
corr.per_encarga, es.nom_estS, corr.id_nom, 
corr.id_prove, corr.fec_ven, cli.nom_cli, cli.id_cli,
corr.num_facR, corr.id_reg 
FROM correspondencias AS corr
INNER JOIN mq_usu AS us
ON corr.id_usu = us.id_usu 
LEFT JOIN seg_nomdoc AS nom
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
WHERE corr.id_estSeg != 3
AND corr.id_reg != 1 
AND corr.area_remit=9
GROUP BY corr.id_seg";
$query = $conexion->query($sql);

echo $sql;
?>
<div class="col-12">
    <div class="p-3">
        <h5>Correspondencia de Regionales</h5>
    </div>
    <?php if ($query->rowCount() > 0) { ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="tableCorrespondencia3">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre del Creador</th>
                        <th>Nombre del Documento </th>
                        <th>Proveedor</th>
                        <th>Fecha</th>
                        <th>N-Fact </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rTa = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $rTa["id_seg"]; ?></td>
                            <td><?php echo $rTa["nom_usu"]; ?></td>
                            <td><?php echo $rTa["nom_doc"]; ?></td>
                            <td>
                                <?php if ($rTa["nom_cli"] != '') { ?>
                                    <a href="../clientes2/index.php?id=<?php echo $rTa["id_cli"]; ?>" target="_blank"><?php echo $rTa["nom_cli"]; ?></a>
                                <?php } else {
                                    echo '--';
                                } ?>
                            </td>
                            <td><?php echo ($rTa["fech_ini"]); ?></td>
                            <td><?php if ($rTa["num_facR"] != '') {
                                    echo $rTa['num_facR'];
                                } else {
                                    echo '--';
                                } ?></td>
                            <td class="table-td-sm">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">
                                        <?php if ($rTa['id_nom'] == 1 || $rTa['id_nom'] == 2 || $rTa['id_nom'] == 3 || $rTa['id_nom'] == 4 || $rTa['id_nom'] == 5 || $rTa['id_nom'] == 6 || $rTa['id_nom'] == 10) { ?>
                                            <a onclick="mostrarCorr(<?php echo $rTa['id_seg'] . ',' . $rTa['id_estSeg'] . ',' . $rTa['id_nom'] . ',' . $rTa['id_prove']; ?>);" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-share me-1"></i> Seguimiento</a>
                                        <?php }
                                        if ($rTa['id_nom'] == 7 || $rTa['id_nom'] == 8 || $rTa['id_nom'] == 9) { ?>
                                            <a onclick="verCorr(<?php echo $rTa['id_seg'] . ',' . $rTa['id_estSeg'] . ',' . $rTa['id_nom'] . ',' . $rTa['id_prove']; ?>);" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-eye me-1"></i> Ver</a>
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
                $('#tableCorrespondencia3').DataTable({
                    "ordering": true,
                    "order": [
                        [1, "asc"]
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