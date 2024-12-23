<?php
include "../../resources/template/credentials.php";
include '../../conexion.php';
$sqlNeg = "SELECT * FROM negocios WHERE id_neg = " . $_POST['id_neg'];
$queryNeg = $conexion->query($sqlNeg);
$rN = $queryNeg->fetch_array();

$sqlTip = "SELECT * FROM crm_tipo_tran";
$queryTip = $conexion->query($sqlTip);

?>
<div class="row">
    <div class="col-12 text-center">
        <h3>Actividad Cliente</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<form role="form" id="form-tran">
    <input type="hidden" id="action" name="action" value="addTransaccion">
    <input type="hidden" id="id_neg" name="id_neg" value="<?php echo $_POST['id_neg']; ?>">
    <?php if ($_POST['id_neg'] == 0) { ?>
        <input type="hidden" id="id_cli" name="id_cli" value="<?php echo $_POST['id_cli']; ?>">
    <?php } else { ?>
        <input type="hidden" id="id_cli" name="id_cli" value="<?php echo $rN['id_cli']; ?>">
    <?php } ?>
    <div class="row">
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="tip_tran" class="form-label">Tipo de transacción </label>
            <select class="form-select" id="tip_tran" name="tip_tran" onchange="tipoTra(this.value);" required>
                <?php if ($_POST['resp'] == 10) { ?>
                    <option value="0" selected>Seleccionar</option>
                <?php }
                while ($rTip = $queryTip->fetch_array()) { ?>
                    <option value="<?php echo $rTip['id_tipo']; ?>"><?php echo utf8_encode($rTip['tipo']); ?> </option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div id="transacc" class="mt-4">
        <div class="row">
            <div class="col-12 mb-3">
                <div class="alert alert-warning alert-dismissible fade show mt-4 d-flex align-items-center" role="alert">
                    <i class="fa-solid fa-triangle-exclamation me-3 fa-xl"></i>
                    Debes seleccionar un tipo de transacción para continuar
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
</form>