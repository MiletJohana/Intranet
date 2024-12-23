<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
$fecha = date('Y-m-d');
$sql2 = "SELECT * FROM mq_are ";
$query2 = $conexion->query($sql2);


$sqlInfo = "SELECT corr.id_seg, corr.id_nom, doc.nom_doc, corr.id_prove, 
ar.nom_are, us.nom_usu, corr.fech_ini, 
corr.my_process, seg.nom_estS, corr.conse_fac, corr.sub_tota, 
corr.iva, corr.sop_factura, corr.num_facR, bod.nom_bodega, 
corr.fec_ven, corr.concept_justifi, cli.nom_cli
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
$queryInfo = $conexion->query($sqlInfo);
while ($r = $queryInfo->fetch(PDO::FETCH_OBJ)) {
      $info = $r;
      break;
}

?>
<div class="container">
      <div class="col-12 text-center">
            <h3>Correspondencia Nº <?php echo $_POST['id_seg'] ?></h3>
            <hr class="mx-auto" style="width: 60%;">
      </div>
      <div class="row">
            <div class="col-12">
                  <ul class="list-group text-center me-0 px-md-5">
                        <li class="list-group-item d-flex justify-content-between">Nombre del Documento: <span class="badge bg-secondary rounded-pill"><?php echo $info->nom_doc; ?></span></li>
                        <li class="list-group-item d-flex justify-content-between">Nombre Del Proveedor: <span class="badge bg-secondary rounded-pill"><?php echo $info->nom_cli; ?></span></li>
                        <li class="list-group-item d-flex justify-content-between">NIT del Proveedor: <span class="badge bg-secondary rounded-pill"><?php echo $info->id_prove; ?></span></li>
                        <li class="list-group-item d-flex justify-content-between">Área a la que Remite: <span class="badge bg-secondary rounded-pill"><?php echo $info->nom_are; ?></span></li>
                        <li class="list-group-item d-flex justify-content-between">Persona Encargada: <span class="badge bg-secondary rounded-pill"><?php echo $info->nom_usu; ?></span></li>
                        <li class="list-group-item d-flex justify-content-between">Fecha de recibido: <span class="badge bg-secondary rounded-pill"><?php echo $info->fech_ini; ?></span></li>
                        <?php if (isset($info->my_process) && $info->my_process != '') { ?>
                              <li class="list-group-item d-flex justify-content-between">Registrada en Odoo: <span class="badge bg-secondary rounded-pill"><?php echo $info->my_process; ?></span></li>
                        <?php }
                        if (isset($info->conse_fac) && $info->conse_fac != '') { ?>
                              <li class="list-group-item d-flex justify-content-between">Consecutivo factura en Odoo: <span class="badge bg-secondary rounded-pill"><?php echo $info->conse_fac; ?></span></li>
                        <?php }
                        if (isset($info->num_facR) && $info->num_facR != '') { ?>
                              <li class="list-group-item d-flex justify-content-between">Número De la Factura: <span class="badge bg-secondary rounded-pill"><?php echo $info->num_facR; ?></span></li>
                        <?php }
                        if (isset($info->nom_bodega) && $info->nom_bodega != '') { ?>
                              <li class="list-group-item d-flex justify-content-between">Bodega: <span class="badge bg-secondary rounded-pill"><?php echo $info->nom_bodega; ?></span></li>
                        <?php }
                        if (isset($info->fec_ven) && $info->fec_ven != '') { ?>
                              <li class="list-group-item d-flex justify-content-between">Fecha de Vencimiento: <span class="badge bg-secondary rounded-pill"><?php echo $info->fec_ven; ?></span></li>
                        <?php }
                        if (isset($info->sub_tota) && $info->sub_tota != '') { ?>
                              <li class="list-group-item d-flex justify-content-between">Subtotal: <span class="badge bg-secondary rounded-pill"><?php echo $info->sub_tota; ?></span></li>
                        <?php }
                        if (isset($info->iva) && $info->iva != '') { ?>
                              <li class="list-group-item d-flex justify-content-between">Iva: <span class="badge bg-secondary rounded-pill"><?php echo $info->iva; ?></span></li>
                        <?php } ?>
                  </ul>
            </div>
      </div>
      <div class="col-12 text-center mt-md-5">
            <h4>Remitir</h4>
      </div>
      <form role="form" id="form-remit">
            <div class="row">
                  <div class="col-md-6 col-sm-12 mb-3">
                        <label for="fe_rec" class="form-label">Fecha de Recibido</label>
                        <input type="date" class="form-control" id="fec_rec" max="<?php $fecha ?>" name="fec_rec" value="<?php if ($_POST['resp'] == 6) {
                                                                                                                              echo $r['fech_ini'];
                                                                                                                        } ?>" required>
                  </div>
                  <div class="col-md-6 col-sm-12 mb-3">
                        <label for="area_n" class="form-label">Área a la que Remite</label>
                        <select class="form-select" id="area_n" name="area_n" onchange="usuarios(this.value);" required>
                              <option value="">Seleccionar</option>
                              <?php while ($r2 = $query2->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <option value="<?php echo $r2['id_are']; ?>"><?php echo $r2['nom_are']; ?> </option>

                                    <?php }
                              if ($_POST['resp'] == 2) {
                                    while ($r22 = $query22->fetch(PDO::FETCH_ASSOC)) { ?>
                                          <option value="<?php echo $r22['id_are']; ?>"><?php echo $r22['nom_are']; ?></option>
                              <?php }
                              } ?>
                        </select>
                  </div>
            </div>
            <div class="row">
                  <div class="col-md-6 col-sm-12 mb-3">
                        <label for="per_enc" class="form-label">Persona Encargada</label>
                        <select class="form-select" id="per_enc" name="per_enc" value="" required>
                              <option value="">Seleccione el área</option>
                        </select>
                  </div>
                  <div class="col-md-6 col-sm-12 mb-3">
                        <br>
                        <a class="btn btn-danger" href="../../documentos/correspondencia/docum/<?php echo $info->sop_factura; ?>" target="blank">
                              Ver documento <i class="fa-solid fa-file-pdf ms-2"></i>
                        </a>
                  </div>
            </div>
            <input type="hidden" id="accion_form" name="action" value="<?php if ($_POST['resp'] == 5) {
                                                                              echo "updateRemit";
                                                                        } ?>">
            <input type="hidden" id="id_seg" name="id_seg" value="<?php echo $_POST['id_seg']; ?>">
            <input type="hidden" id="id_prove" name="id_prove" value="<?php echo $info->id_prove; ?>">
            <input type="hidden" id="id_nom" name="id_nom" value="<?php echo $info->id_nom; ?>">
      </form>
</div>