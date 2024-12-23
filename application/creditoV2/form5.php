<form role="form" id="form-teso">
<div class="row">
    <div class="col-md-12 text-center">
        <h3>Aprobación de cupo de crédito</h3>
    </div>
</div>
<hr class="mx-auto" style="width:60%;">
<div class="row">
    <div class="col-md-6">
        <label for="cupcli_sol">Cupo Solicitado por el Cliente</label>
        <input type="number" class="form-control" id="cupcli_sol" name="cupcli_sol" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) {
                                                                                                echo $sol->cupo_sol . '" readonly="';
                                                                                            } ?>">
    </div>
    <div class="col-md-6">
        <label for="terpag_sol">Termino de Pago Solicitado</label>
        <input type="number" class="form-control" id="terpag_sol" name="terpag_sol" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) {
                                                                                                echo $sol->term_pag . '" readonly="';
                                                                                            } ?>">
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="cupSug_atc">Cupo de Credito Sugerido por ATC</label>
        <input type="number" class="form-control" id="cupSug_atc" name="cupSug_atc" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) {
                                                                                                echo $sol->cupoSugA . '" readonly="';
                                                                                            } ?>">
    </div>
    <div class="col-md-6">
        <label for="plaz_atc">Plazo de pago Sugerido por ATC</label>
        <input type="number" class="form-control" id="plaz_atc" name="plaz_atc" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) {
                                                                                            echo $sol->plaSugeA . '" readonly="';
                                                                                        } ?>">
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="conas_atc">Concepto General del Asesor comercial</label>
        <select id="conas_atc" name="conas_atc" class="form-control">
            <?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) { ?>
                <option value="<?php $sol->reg_clie; ?>"><?php $sol->congen_ase; ?></option>
            <?php } else { ?>
                <option value="">Seleccionar</option>
                <option value="Excelente">Excelente</option>
                <option value="Bueno">Bueno</option>
                <option value="Regular">Regular</option>
                <option value="Malo">Malo</option>
            <?php } ?>
        </select>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-12">
        <div class="card bg-info">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="cred_aut">Cupo de Credito Autorizado:</label>
                        <input type="number" class="form-control" id="cred_aut" name="cred_aut" value="<?php if ($_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) {
                                                                                                            echo $sol->cup_aut . '" readonly="';
                                                                                                        } ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="numero_letras">Número en Letras:</label>
                        <input type="text" class="form-control" id="numero_letras" name="numero_letras" value="<?php if ($_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) {
                                                                                                                    echo $sol->cup_aut . '" readonly="';
                                                                                                                } ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="termpa_aut">Termino de Pago Autorizado</label>
                        <input type="number" class="form-control" id="termpa_aut" name="termpa_aut" value="<?php if ($_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) {
                                                                                                                echo $sol->term_auto . '" readonly="';
                                                                                                            } ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-12">
        <label for="obs_aprob">Observaciones sobre la asignación de cupo.</label>
        <textarea class="form-control" id="obs_aprob" name="obs_aprob" rows="4" placeholder="LLena este espacio con  todo lo necesario para hacer la solicitud de credito" <?php if ($_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) {
                                                                                                                                                                                echo 'readonly';
                                                                                                                                                                            } ?>><?php if ($_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) {
                                                                                                                                                                                        echo ($sol->ob_cupasig);
                                                                                                                                                                                    } ?></textarea>
    </div>
</div>
<?php if ($_POST['resp'] == 3) { ?>
    <div class="row mt-2">
        <div class="col-md-12">
            <button type="button" class="btn btn-danger" id="rechazar" onclick="rechazarCrm(<?php $sol->id_sol; ?>);"> Rechazar</button>
            <br>
            <label>Causa de Rechazo</label>
            <br>
            <label class="btn btn-default">
                <input type="checkbox" id="caurec" name="caurec" value="Capacidad Financiera y/o nivel de endeudamiento" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) && $sol->cau_rec == "Capacidad Financiera y/o nivel de endeudamiento") {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>
                Capacidad Financiera
            </label>
            <label class="btn btn-default">
                <input type="checkbox" id="caurep" name="caurep" value="Reporte de centrales de riesgo" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) && $sol->cau_rec == "Reporte de centrales de riesgo") {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                Reporte de centrales de riesgo
            </label>
            <label class="btn btn-default">
                <input type="checkbox" id="caumon" name="caumon" value="Monto minimo mensual de compra" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) && $sol->cau_rec == "Monto minimo mensual de compra") {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                Monto mínimo mensual de compra
            </label>
        </div>
    </div>
<?php } ?>
</form>