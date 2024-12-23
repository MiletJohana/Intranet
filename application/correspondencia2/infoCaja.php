<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
$sql1 = "SELECT * FROM seg_caja WHERE id_seg = " . $_POST['id_seg'];
$query = $conexion->query($sql1);

$sqlCaj = "SELECT se.id_seg,se.id_nom, doc.nom_doc,se.nom_pro, se.id_prove, se.dig_ver, ar.nom_are, us.nom_usu, se.fech_ini, se.my_process,seg.nom_estS, se.conse_fac, se.sub_tota, se.iva, se.sop_factura, se.num_facR, bod.nom_bodega, se.fec_ven, se.concept_justifi
FROM seg_ingreso se,seg_nomdoc doc,mq_prove pro, mq_are ar, seg_estado seg, mq_usu us , seg_bodeg bod
WHERE se.id_nom=doc.id_nom
AND se.id_prove=pro.id_prove
AND se.area_remit=ar.id_are
AND se.id_usu=us.id_usu 
AND se.id_seg='" . $_POST['id_seg'] . "'
GROUP BY se.id_seg";
$queryCaj = $conexion->query($sqlCaj);
while ($r = $queryCaj->fetch(PDO::FETCH_OBJ)) {
    $caj = $r;
    break;
}
?>
<div class="container-fluid">
    <?php if ($query->rowCount() > 0) { ?>
        <div class="row">
            <div class="col-12 text-center">
                <h3>Correspondencia Nº<?php echo $_POST['id_seg'] ?></h3>
                <hr class="mx-auto" style="width: 60%;">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table bg-light">
                    <thead>
                        <tr>
                            <th>Nombre del documento:</th>
                            <th>Usuario que modifica:</th>
                            <th>Area remitida:</th>
                            <th>Estado:</th>
                            <th>Concepto de justificación:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $caj->nom_doc ?></td>
                            <td><?php echo $caj->nom_usu ?></td>
                            <td><?php echo $caj->nom_are ?></td>
                            <td><?php echo $caj->nom_estS ?></td>
                            <td><?php if ($caj->concept_justifi != '') {
                                    echo $caj->concept_justifi;
                                } else {
                                    echo '-';
                                } ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div style="overflow-y: scroll; height:220px;">
                    <table class="table" id="tablaCaja" style="font-size: 90%; height: 200px;">
                        <thead>
                            <tr>
                                <th># Seguimiento:</th>
                                <th>Nit del proveedor:</th>
                                <th>Nombre del proveedor:</th>
                                <th>Numero de la factura:</th>
                                <th>Valor total:</th>
                                <th>Justificación:</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($r2 = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                                <tr>
                                    <td><?php echo $r2["id_seg"]; ?></td>
                                    <td><?php echo $r2["id_prove"]; ?></td>
                                    <td><?php echo $r2["nom_pro"]; ?></td>
                                    <td><?php echo $r2["num_facR"]; ?></td>
                                    <td><?php echo $r2["valor_tota"]; ?></td>
                                    <td><?php echo $r2["justifica"]; ?></td>
                                    <td><a class="btn btn-danger" href="../../documentos/correspondencia/docum/<?php echo $r2["docu_caj"]; ?>" target="blank"><i class="fa-solid fa-file-pdf" style="font-size: 23px;"></i></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="alert alert-success alert-dismissible fade show mt-4 d-flex align-items-center" role="alert">
            <i class="fa-solid fa-circle-check me-3 fa-xl"></i>
            No hay resultados
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
</div>