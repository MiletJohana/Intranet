<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
$fecha = date('Y-m-d');
if ($_POST['resp'] == 19) {
    $sqlErr = "SELECT * FROM ind_errores WHERE id_error=" . $_POST['edit'];
    $queryErr = $conexion->query($sqlErr);
    $r = $queryErr->fetch(PDO::FETCH_ASSOC);
    //echo $sqlErr;
    $pago = $r['id_pag'];
    $sqlP = "SELECT * FROM ind_nompag WHERE id_pag=$pago";
    $queryP = $conexion->query($sqlP);
    $sqlPP = "SELECT * FROM ind_nompag WHERE id_pag!=$pago";
    $queryPP = $conexion->query($sqlPP);
    $esta = $r['id_estaErr'];
    $sqlE = "SELECT * FROM ind_estad_error WHERE id_estaErr=$esta";
    $queryE = $conexion->query($sqlE);
    $sqlEE = "SELECT * FROM ind_estad_error WHERE id_estaErr!=$esta";
    $queryEE = $conexion->query($sqlEE);
} else {
    $sqlP = "SELECT * FROM ind_nompag";
    $queryP = $conexion->query($sqlP);
    $sqlE = "SELECT * FROM ind_estad_error";
    $queryE = $conexion->query($sqlE);
}
?>

<div class="row">
    <div class="col-12 text-center">
        <h3>Errores De Nomina</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<form role="form" id="form-error">
    <input type="hidden" id="id_error" name="id_error" value="<?php echo $_POST['edit'] ?>">
    <input type="hidden" id="accion_form" name="action" value="<?php if ($_POST['resp'] == 18) {
                                                                    echo "errNom";
                                                                } else {
                                                                    echo "updaError";
                                                                } ?>">
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <label for="fec_err" class="form-label">Fecha </label>
            <input type="date" class="form-control" id="fec_err" name="fec_err" min="<?php $fecha ?>" value="<?php if (isset($_POST['edit'])) {
                                                                                                                echo $r['fech_error'];
                                                                                                            } ?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <label for="cola_erro" class="form-label">Colaborador</label>
            <input type="text" class="form-control" id="cola_erro" name="cola_erro" value="<?php if (isset($_POST['edit'])) {
                                                                                                echo $r['col_error'];
                                                                                            } ?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <label for="nom_var" class="form-label">Tipo De Pago</label>
            <select class="form-select" id="nom_var" name="nom_var" value="" required>
                <?php if ($_POST['resp'] == 18) { ?>
                    <option value="">Seleccionar</option>
                <?php }
                while ($rP = $queryP->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $rP['id_pag']; ?>"><?php echo $rP['nom_pag']; ?> </option>
                    <?php }
                if ($_POST['resp'] == 19) {
                    while ($rPP = $queryPP-> fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rPP['id_pag']; ?>"><?php echo $rPP['nom_pag']; ?></option>
                <?php }
                } ?>
            </select>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <label for="est_err" class="form-label">Estado</label>
            <select class="form-select" id="est_err" name="est_err" value="" required>
                <?php if ($_POST['resp'] == 18) { ?>
                    <option value="">Seleccionar</option>
                <?php }
                while ($rE = $queryE->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $rE['id_estaErr']; ?>"><?php echo $rE['nom_estaErro']; ?> </option>
                    <?php }
                if ($_POST['resp'] == 19) {
                    while ($rEE = $queryEE->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rEE['id_estaErr']; ?>"><?php echo $rEE['nom_estaErro']; ?></option>
                <?php }
                } ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <p class="form-label">Error</p>
            
            <label class="btn form-check-label"><input class="form-check-input" type="radio"  name="ses" value="Si" <?php if (isset($_POST['edit'])) {
                                                                                            if ($r['error_per'] == 'Si') {
                                                                                                echo 'checked';
                                                                                            }
                                                                                        } ?>>Si</label>
            <label class="btn form-check-label"><input class="form-check-input" type="radio" name="ses" value="No" <?php if (isset($_POST['edit'])) {
                                                                                            if ($r['error_per'] == 'No') {
                                                                                                echo 'checked';
                                                                                            }
                                                                                        } ?>>No</label>
        </div>
        <div class="col-md-9 col-sm-12 mb-3">
            <label class="form-label" for="obs_err">Observacion Del Error</label>
            <textarea class="form-control" id="obs_err" name="obs_err" required><?php if (isset($_POST['edit'])) {
                                                                                    echo $r['erro_obser'];
                                                                                } ?></textarea>
        </div>
    </div>
</form>
</div>