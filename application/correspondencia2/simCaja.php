<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';

if ($_POST['resp'] == 6) {
    $sql = "SELECT * FROM seg_caja WHERE id_seg=\"$_POST[id_seg]\"";
    $query = $conexion->query($sql);

    $sql2 = "SELECT * FROM seg_caja WHERE id_seg=\"$_POST[id_seg]\"";
    $query2 = $conexion->query($sql2);
    while ($r2 = $query2->fetch(PDO::FETCH_OBJ)) {
        $caj = $r2;
        break;
    }
}
?>
<div class="row">
    <div class="col-12 text-center">
        <h3>Datos de <?php if (($_POST['value'] == 7) || (isset($r['id_nom']) && $r['id_nom'] == 7)) {
                            echo 'Caja Menor';
                        } elseif (($_POST['value'] == 8) || (isset($r['id_nom']) && $r['id_nom'] == 8)) {
                            echo 'Anticipo';
                        } elseif (($_POST['value'] == 9) || (isset($r['id_nom']) && $r['id_nom'] == 9)) {
                            echo 'Legalización';
                        } ?></h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-4">
        <label for="search" id="busa" name="busa" class="form-label"><i class="fa-solid fa-magnifying-glass-plus"></i> Buscador</label>
        <input type="text" class="form-control" id="search" name="search" onkeyup="auto2(1);">
    </div>
</div>
<div class="table-responsive">
    <table class="table" id="tabla">
        <thead>
            <tr>
                <th>NIT Del Proveedor</th>
                <th>Nombre Del Proveedor</th>
                <th>Número De La Factura</th>
                <th>Valor Total</th>
                <th>Justificación</th>
                <th>Soporte</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($_POST['resp'] == 6) {
                $i = 100;
                while ($rC = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr id="<?php $rC["id_prove"] . $i; ?>">
                        <td><input type="number" class="form-control" name="id_provedor[]" readonly value="<?php echo $rC["id_prove"]; ?>"></td>
                        <td><input type="text" class="form-control" name="nom_provedor[]" readonly value="<?php echo $rC["nom_pro"]; ?>"></td>
                        <td><input type="text" class="form-control" name="num_faR[]" value="<?php echo $rC["num_facR"]; ?>"></td>
                        <td><input type="text" class="form-control" name="val[]" value="<?php echo $rC["valor_tota"]; ?>"></td>
                        <td><input type="text" class="form-control" name="jus[]" value="<?php echo $rC["justifica"]; ?>"></td>
                        <td>
                            <div class="fileUpload btn btn-primary btn-sm">
                                <span id="fac<?php $i ?>"> Modificar</span>
                                <input type="file" name="doc_caj[]" id="doc_caj<?php $i ?>" onchange="doc(<?php $i ?>);" class="upload" accept="application/pdf" value="<?php echo ($rC["docu_caj"]) ?>">
                                <input type="hidden" name="doc_ocu[]" id="doc_ocu<?php $i ?>" value="<?php echo ($rC["docu_caj"]); ?>">
                            </div>
                        <td><a class="btn btn-danger" href="../../documentos/correspondencia/docum/<?php echo $rC["docu_caj"]; ?>" target="blank"> <i class="fa-solid fa-file-pdf"></i></a>
                        <td><a id="but_x" name="but_x" class="btn btn-danger btn-sm mb-3" required onclick="eliminarFac(<?php $rC['id_prove'] . '' . $i; ?>)"><i class="fa-solid fa-xmark" style="color: #ffffff;"></i></a><input type="hidden" class="form-control" readonly name="d_v[]" value="<?php echo ($rC["dig_ver"]) ?>"></td>
                    </tr>
            <?php $i++;
                }
            } ?>
        </tbody>
    </table>
</div>