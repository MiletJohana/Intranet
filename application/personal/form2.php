<?php
    include '../../conexion.php';
    include "../../resources/template/credentials.php";

    $sqla = "SELECT * FROM mq_are ";
    $querya = $conexion->query($sqla);

?>

<form role="form" id="form-Cargo">
    <div class="row">
        <div class="col-12 mb-3">
            <h3 class="text-center">Solicitud de nuevo Cargo</h3>
            <hr class="mx-auto" style="width:60%;">
        </div>
    </div>
    <div class="row ">
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="are_carg1" class="form-label">Área</label>
            <select class="form-select" id="are_carg1" name="are_carg1" value="" onchange="" required>
                <?php if ($_POST['resp'] == 1) { ?>
                    <option value="">Seleccionar </option>
                <?php }
                while ($ra = $querya-> fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $ra['id_are']; ?>"><?php echo $ra['nom_are']; ?></option>
                    <?php } ?>
            </select>
        </div>
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="car_per1" class="form-label">Cargo</label>
            <input type="text" class="form-control" id="car_per1" name="car_per1" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 mb-3">
            <label for="observ_cargo" class="form-label"> Concepto de Cargo</label>
            <textarea class="form-control" id="observ_cargo" name="observ_cargo" placeholder="Llena este espacio con observaciones del nuevo cargo" required></textarea>
        </div>
    </div>
    <input type="hidden" id="accion_form" name="action" value="<?php if ($_POST['resp'] == 1) {
                                                                    echo "addCargo";
                                                                } else {
                                                                    echo 'updateCargo';
                                                                } ?>">
</form>