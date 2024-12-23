<div class="row">
    <div class="col-md-12 text-center">
        <h3>Aprobación de cupo de crédito</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="cupcli_sol" class="form-label">Cupo Solicitado por el Cliente</label>
        <input type="number" class="form-control" id="cupcli_sol" name="cupcli_sol" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) {
                                                                                                echo $sol->cupo_sol . '" readonly="';
                                                                                            } ?>">
    </div>
    <div class="col-md-6 mb-3">
        <label for="terpag_sol" class="form-label">Termino de Pago Solicitado</label>
        <input type="number" class="form-control" id="terpag_sol" name="terpag_sol" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) {
                                                                                                echo $sol->term_pag . '" readonly="';
                                                                                            } ?>">
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="cupSug_atc" class="form-label">Cupo de Credito Sugerido por ATC</label>
        <input type="number" class="form-control" id="cupSug_atc" name="cupSug_atc" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) {
                                                                                                echo $sol->cupoSugA . '" readonly="';
                                                                                            } ?>">
    </div>
    <div class="col-md-6 mb-3">
        <label for="plaz_atc" class="form-label">Plazo de pago Sugerido por ATC</label>
        <input type="number" class="form-control" id="plaz_atc" name="plaz_atc" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) {
                                                                                            echo $sol->plaSugeA . '" readonly="';
                                                                                        } ?>">
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="conas_atc" class="form-label">Concepto General del Asesor comercial</label>
        <select id="conas_atc" name="conas_atc" class="form-select" disabled>
            <?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) { ?>
                <option value="<?php echo $conceptoATC->id_conAt; ?>"><?php echo $conceptoATC->nom_conAt; ?></option>
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
<div class="row mb-3">
    <div class="col-12">
        <div class="card bg-info">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label for="cred_aut" class="form-label text-white">Cupo de Credito Autorizado:</label>
                        <input type="text" class="form-control" id="cred_aut" name="cred_aut" placeholder="Colocar comas en vez de puntos" value="<?php if ($_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) {
                                                                                                            echo $sol->cup_aut . '" readonly="';
                                                                                                        } ?>">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="numero_letras" class="form-label text-white">Cupo de Credito Autorizado en Letras:</label>
                        <input type="text" class="form-control" placeholder="Ej: Solo poner el primer número" id="numero_letras" name="numero_letras" value="<?php if ($_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) {
                                                                                                                    echo $sol->num_letra . '" readonly="';
                                                                                                                } ?>">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="termpa_aut" class="form-label text-white">Termino de Pago Autorizado</label>
                        <input type="number" class="form-control" id="termpa_aut" name="termpa_aut" value="<?php if ($_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) {
                                                                                                                echo $sol->term_auto . '" readonly="';
                                                                                                            } ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 mb-3">
        <label for="obs_aprob" class="form-label">Observaciones sobre la asignación de cupo.</label>
        <textarea class="form-control" id="obs_aprob" name="obs_aprob" rows="4" placeholder="LLena este espacio con  todo lo necesario para hacer la solicitud de credito" <?php if ($_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) {
                                                                                                                                                                                echo 'readonly';
                                                                                                                                                                            } ?>><?php if ($_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) {
                                                                                                                                                                                        echo ($sol->ob_cupasig);
                                                                                                                                                                                    } ?></textarea>
    </div>
</div>


<?php if (isset($_POST['resp']) && $_POST['resp'] == 3) { ?>
    <div class="row">
        <div class="col-12 mb-3">
            <button id="btnModificar" class="btn btn-success" onclick="confirmarActualizarSol();" data-bs-toggle="modal" data-bs-target="#smallModal">Aprobar</button>
            <button type="button" class="btn btn-danger" id="rechazar" onclick="rechazarCrm(<?php echo $sol->id_sol; ?>);"  data-bs-toggle="modal" data-bs-target="#smallModal"> Rechazar</button> 
        </div>
    </div>
<?php } else if(isset($_POST['resp']) && $_POST['resp'] == 5 && $_POST['id_est'] == 4){ ?>
    <div class="row">
        <div class="col-md-12 mb-3">
           
            <br>
            <label class="form-label">Causa de Rechazo</label>
            <br>
            <label class="">
                <input type="radio" id="caurec" name="motivoRechazo" value="Capacidad Financiera y/o nivel de endeudamiento" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) && $sol->cau_rec == "Capacidad Financiera y/o nivel de endeudamiento") {
                                                                                                                                echo 'checked';
                                                                                                                            } ?> disabled>
                Capacidad Financiera
            </label>
            <br>
            <label class="">
                <input type="radio" id="caurep" name="motivoRechazo" value="Reporte de centrales de riesgo" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) && $sol->cau_rec == "Reporte de centrales de riesgo") {
                                                                                                            echo 'checked';
                                                                                                        } ?> disabled>
                Reporte de centrales de riesgo
            </label>
            <br>
            <label class="">
                <input type="radio" id="caumon" name="motivoRechazo" value="Monto minimo mensual de compra" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7) && $sol->cau_rec == "Monto minimo mensual de compra") {
                                                                                                            echo 'checked';
                                                                                                        } ?> disabled>
                Monto mínimo mensual de compra
            </label>
        </div>
    </div>
<?php } ?>