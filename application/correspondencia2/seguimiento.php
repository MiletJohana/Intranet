<?php
include '../../conexion.php';
$sql1 = "SELECT seg.id_seg, seg.id_usu, seg.fecha_hora, are.nom_are, seg.per_encarga, est.nom_estS, reg.nom_reg 
FROM seg_ingre_x_movi AS seg 
INNER JOIN seg_estado AS est
ON seg.id_estSeg = est.id_estSeg 
INNER JOIN mq_are AS are
ON seg.id_are = are.id_are 
INNER JOIN mq_reg AS reg 
ON seg.id_reg = reg.id_reg
WHERE id_seg = " . $_POST['id_seg'];
$sql1 .= " ORDER BY fech_cre";
$query = $conexion->query($sql1);
$sql2 = "SELECT * FROM mq_are ";
$query2 = $conexion->query($sql2);

$sqlSeg = "SELECT corr.id_seg, corr.id_nom, doc.nom_doc,
corr.id_prove, ar.nom_are, us.nom_usu, 
corr.fech_ini, corr.my_process, seg.nom_estS, corr.conse_fac, 
corr.sub_tota, corr.iva, corr.sop_factura, corr.num_facR, 
bod.nom_bodega, corr.fec_ven, corr.concept_justifi, cli.nom_cli
FROM correspondencias AS corr
INNER JOIN seg_nomdoc AS doc
ON corr.id_nom = doc.id_nom
INNER JOIN mq_clientes AS cli 
ON corr.id_prove = cli.id_cli
INNER JOIN mq_are AS ar
ON corr.area_remit = ar.id_are
INNER JOIN seg_estado AS seg
ON corr.id_estSeg = seg.id_estSeg
INNER JOIN mq_usu AS us
ON corr.id_usu = us.id_usu
LEFT JOIN seg_bodeg AS bod 
ON corr.id_bodeg = bod.id_bodeg
WHERE corr.id_seg = " . $_POST['id_seg'] . "
GROUP BY corr.id_seg";
//echo $sqlSeg;
$querySeg = $conexion->query($sqlSeg);
while ($r = $querySeg->fetch(PDO::FETCH_OBJ)) {
    $seg = $r;
    break;
}
?>
<?php if ($query->rowCount() > 0) { ?>
    <div class="row">
        <div class="col-12 text-center">
            <h3>Correspondencia Nº <?php echo $_POST['id_seg'] ?></h3>
            <hr class="mx-auto" style="width: 60%;">
        </div>
    </div>
    <div class="row">
        <div class="col-12 bg-light" style="font-size: 80%">
            <table class="table table-sm " >
                <thead>
                    <tr>
                        <th>NIT del Proveedor: </th>
                        <th>Nombre del Proveedor: </th>
                        <th>N° de Factura: </th>
                        <th>N°Factura Odoo: </th>
                        <th>Fecha de Vencimiento: </th>
                        <th>IVA:</th>
                        <th>Subtotal: </th>
                        <th>Concepto De Justificación: </th>
                        <th class="table table-sm "></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $seg->id_prove ?></td>
                        <td><?php echo $seg->nom_cli ?></td>
                        <td><?php if ($seg->num_facR != '') {
                                echo $seg->num_facR;
                            } else {
                                echo '-';
                            } ?></td>
                        <td><?php if ($seg->conse_fac != '') {
                                echo $seg->conse_fac;
                            } else {
                                echo '-';
                            } ?></td>
                        <td><?php if ($seg->fec_ven != '') {
                                echo $seg->fec_ven;
                            } else {
                                echo '-';
                            } ?></td>
                        <td><?php if ($seg->iva != '') {
                                echo $seg->iva;
                            } else {
                                echo '-';
                            } ?></td>
                        <td><?php if ($seg->sub_tota != '') {
                                echo $seg->sub_tota;
                            } else {
                                echo '-';
                            } ?></td>
                        <td><?php if ($seg->concept_justifi != '') {
                                echo $seg->concept_justifi;
                            } else {
                                echo '-';
                            } ?></td>
                        <td><a class="btn btn-danger btn-raised btn-sm" href="../../documentos/correspondencia/docum/<?php echo $seg->sop_factura; ?>" target="_blank"><i class="fa-solid fa-file-pdf"></i></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row pt-3">
        <div class="col-12" style="overflow-y: scroll; height:220px; font-size: 90%;">
            <table class="table table-striped table-sm" id="tablaCorrespondencia">
                <thead>
                    <tr>
                        <th>Nombre del Documento:</th>
                        <th>Usuario Que Modifica:</th>
                        <th>Ultimas actualizaciones :</th>
                        <th>Area Remitida:</th>
                        <th>Remitido A :</th>
                        <th>Regional:</th>
                        <th>Estado:</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
                        $sqlUsu = "SELECT us.nom_usu FROM mq_usu us WHERE id_usu=" . $r['per_encarga'];
                        $queryUsu = $conexion->query($sqlUsu);
                        $sqlUsu2 = "SELECT us.nom_usu FROM mq_usu us WHERE id_usu=" . $r['id_usu'];
                        $queryUsu2 = $conexion->query($sqlUsu2);
                        $rU2 = $queryUsu2->fetch(PDO::FETCH_ASSOC);
                        $rU = $queryUsu->fetch(PDO::FETCH_ASSOC);
                        $sqlFac = "SELECT nom_doc FROM correspondencias AS ing,seg_nomdoc AS doc  WHERE ing.id_nom=doc.id_nom AND id_seg=" . $r['id_seg'];
                        $queryFac = $conexion->query($sqlFac);
                        $rF = $queryFac->fetch(PDO::FETCH_ASSOC);
                    ?>
                        <tr>
                            <td><?php echo $rF["nom_doc"]; ?></td>
                            <td><?php echo $rU2["nom_usu"]; ?></td>
                            <td><?php echo $r["fecha_hora"]; ?></td>
                            <td><?php echo $r["nom_are"]; ?></td>
                            <td><?php echo $rU["nom_usu"]; ?></td>
                            <td><?php echo $r["nom_reg"]; ?></td>
                            <td><?php echo $r["nom_estS"]; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <input type="hidden" id="id_seg" name="id_seg" value="<?php if ($_POST['resp'] == 4) {
                                                                echo $_POST['id_seg'];
                                                            } ?>">

<?php } ?>