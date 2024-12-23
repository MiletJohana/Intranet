<?php
include '../../conexion.php';
include "../../resources/template/credentials.php";
if ($_POST['resp'] == 33) {
    $sqlUs = "SELECT * FROM mq_usu WHERE id_usu=" . $_POST['edit'];
    $queryUs = $conexion->query($sqlUs);
    $r = $queryUs->fetch(PDO::FETCH_ASSOC);
    // echo $sqlUs;
} else {
    $sqlU = "SELECT * FROM mq_usu us, ind_cargos car WHERE us.id_carg=car.id_carg AND us.id_usu=" . $_SESSION['id'];
    $queryU = $conexion->query($sqlU);
    $r = $queryU->fetch(PDO::FETCH_ASSOC);
}
?>
<form role="form" id="form-cert">
    <div class="row">
        <div class="col-12 text-center">
            <h3>Mí Certificado</h3>
            <hr class="mx-auto" style="width:60%;">
        </div>
    </div>
    <div class="row">
        <div class="col-md-<?php if ($_SESSION['are'] == 9) {
                                echo 6;
                            } else {
                                echo 12;
                            } ?> col-sm-12">
            <input type="hidden" id="accion_form" name="action" value="<?php if ($_POST['resp'] == 32) {
                                                                            echo "certif";
                                                                        } else {
                                                                            echo "certif2";
                                                                        } ?>">
            <input type="hidden" name="id_carg" id="id_carg" value="<?php echo $r['id_carg']; ?>">
            <input type="hidden" name="usu_elim" id="usu_elim" value="<?php echo $r['usu_elim']; ?>">
            <?php if ($_POST['resp'] == 32) { ?>
                <input type="hidden" id="id_usu" name="id_usu" value="<?php echo $r['id_usu']; ?>">
            <?php } else { ?>
                <input type="hidden" id="id_usu" name="id_usu" value="<?php echo $_POST['edit']; ?>">
            <?php }?>
            <label for="des_cert" class="form-label">Destino de la Cetificación:</label>
            <input type="text" class="form-control" id="des_cert" name="des_cert" value="">

        </div>
        <?php if ($_SESSION['are'] == 9) { ?>
            <div class="col-md-6 col-sm-12">
                <label for="prom_var" class="form-label">Promedio de la Variable:</label>
                <input type="text" class="form-control" id="prom_var" name="prom_var" value="0">
            </div>
        <?php } ?>
    </div>
    <div class="row mt-3 text-center">
        <div class="col-md-12 col-sm-12">
            <label class="btn btn-success">
                <input type="checkbox" name="salario" id="salario" value="0" onchange="check(this, variable, rodamiento, nosalario);"> Con Salario
            </label>
            <label class="btn btn-dark">
                <input type="checkbox" name="variable" id="variable" value="0" onchange="check(salario, this, rodamiento, nosalario);"> Variable
            </label>
            <label class="btn btn-warning">
                <input type="checkbox" name="rodamiento" id="rodamiento" value="0" onchange="check(salario, variable, this, nosalario);"> Rodamiento
            </label>
            <label class="btn btn-danger">
                <input type="checkbox" name="nosalario" id="nosalario" value="0" onchange="check(salario, variable, rodamiento, this);"> Sin Salario
            </label>
        </div>
    </div>
</form>
<script>
    function check(salario, variable, rodamiento, sin) {
        if (sin.checked == true) {
            salario.checked = false;
            variable.checked = false;
            rodamiento.checked = false;
        } else if (salario.checked == true || variable.checked == true || rodamiento.checked == true){
            sin.checked = false;
        }
        
        if (salario.checked == true) {
            salario.value = 1;
        } else {
            salario.value = 0;
        }
        if (variable.checked == true) {
            variable.value = 1;
        } else {
            variable.value = 0;
        }
        if (rodamiento.checked == true) {
            rodamiento.value = 1;
        } else {
            rodamiento.value = 0;
        }
        if (sin.checked == true) {
            sin.value = 1;
        } else {
            sin.value = 0;
        }
    }
</script>