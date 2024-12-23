<?php
include "../../conexion.php";
include '../../resources/template/credentials.php';
$sqlTCap = "SELECT * FROM ind_tipcap";
$queryTCap = $conexion->query($sqlTCap);

$sqlCap1 = "SELECT * FROM ind_cap, ind_tipcap WHERE ind_cap.id_tipcap = ind_tipcap.id_tipcap";
$queryCap1 = $conexion->query($sqlCap1);
$sqlAre = "SELECT * FROM mq_are ";
$queryAre = $conexion->query($sqlAre);

if ($_POST['resp'] == 23) {
    $sqlCap = "SELECT * FROM ind_cap, ind_tipcap WHERE ind_cap.id_tipcap = ind_tipcap.id_tipcap AND id_cap= " . $_POST['edit'];
    $queryCap = $conexion->query($sqlCap);
    $rCap = $queryCap-> fetch(PDO::FETCH_ASSOC);
    //echo $sqlCap;
    $id_tip = $rCap['id_tipcap'];
    $sqlTCap2 = "SELECT * FROM ind_tipcap WHERE id_tipcap =$id_tip ";
    $queryTCap2 = $conexion->query($sqlTCap2);
    $sqlTCap22 = "SELECT * FROM ind_tipcap WHERE id_tipcap !=$id_tip ";
    $queryTCap22 = $conexion->query($sqlTCap22);
    $id_are = $rCap['id_are'];
    $sqlAre2 = "SELECT * FROM mq_are  WHERE id_are = $id_are";
    $queryAre2 = $conexion->query($sqlAre2);
    $sqlAre22 = "SELECT * FROM mq_are  WHERE id_are != $id_are";
    $queryAre22 = $conexion->query($sqlAre22);
}
?>
<form role="form" id="form-cap">
    <input type="hidden" id="accion-form" name="action" value="<?php if ($_POST['resp'] == 22) {
                                                                    echo "insCap";
                                                                } else {
                                                                    echo 'editCap';
                                                                } ?>">
    <input type="hidden" id="id_cap" name="id_cap" value="<?php echo $_POST['edit']; ?>">
    <div class="row">
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="tem_cap" class="form-label">Tema</label>
            <input type="text" class="form-control" id="tem_cap" name="tem_cap" required value="<?php if ($_POST['resp'] == 23) {
                                                                                                    echo $rCap['tem_cap'];
                                                                                                } ?>">
        </div>

        <div class="col-md-6 col-sm-12 mb-3">
            <label for="obj_cap" class="form-label">Objetivo</label>
            <input type="text" class="form-control" id="obj_cap" name="obj_cap" required value="<?php if ($_POST['resp'] == 23) {
                                                                                                    echo $rCap['obj_cap'];
                                                                                                } ?>">
        </div>
    </div>

    <div class="row">
        <!--Se acomodan automaticamente los inputs es por esto que se encuentran en una sola fila-->
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="id_tipcap" class="form-label">Tipo</label>
            <select class="form-select" id="id_tipcap" name="id_tipcap" value="" required onchange="habilitarOtro(this.value)">
                <?php if ($_POST['resp'] == 22) { ?>
                    <option value=""> Seleccionar </option>
                    <?php while ($rTCap2 = $queryTCap-> fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rTCap2['id_tipcap']; ?>"><?php echo $rTCap2['tip_cap']; ?></option>
                    <?php }
                }
                if ($_POST['resp'] == 23) {
                    while ($rTCap2 = $queryTCap2-> fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rTCap2['id_tipcap']; ?>"><?php echo $rTCap2['tip_cap']; ?></option>
                    <?php }
                    while ($rTCap22 = $queryTCap22-> fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rTCap22['id_tipcap']; ?>"><?php echo $rTCap22['tip_cap']; ?></option>
                <?php }
                } ?>
            </select>
        </div>

        <div class="none col-md-6 col-sm-12 mb-3" id="div_otro_tip">
        <label for="otro_tip" class="form-label">¿Cúal?</label>
            <input type='text' readonly class='form-control' id='otro_tip' name='otro_tip' required value='<?php if ($_POST['resp'] == 23) {
                                                                                                                echo $rCap['otro_tip'];
                                                                                                            } ?>'>
        </div>

        <div class="col-md-6 col-sm-12 mb-3">
            <label for="resp_cap" class="form-label">Dicta Capacitación</label>
            <input type="text" class="form-control" id="resp_cap" name="resp_cap" required value="<?php if ($_POST['resp'] == 23) {
                                                                                                        echo $rCap['resp_cap'];
                                                                                                    } ?>">
        </div>

        <div class="col-md-6 col-sm-12 mb-3">
            <label for="id_are" class="form-label">Área</label>
            <select class="form-select" id="id_are" name="id_are" value="" required>
                <?php if ($_POST['resp'] == 22) { ?>
                    <option value=""> Seleccionar </option>
                    <?php while ($rAre = $queryAre-> fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rAre['id_are']; ?>"><?php echo $rAre['nom_are'] ?></option>
                    <?php }
                }
                if ($_POST['resp'] == 23) {
                    while ($rAre2 = $queryAre2-> fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rAre2['id_are']; ?>"><?php echo $rAre2['nom_are'] ?></option>
                    <?php }
                    while ($rAre22 = $queryAre22-> fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rAre22['id_are']; ?>"><?php echo $rAre22['nom_are'] ?></option>
                <?php }
                } ?>

            </select>
        </div>

        <div class="col-md-6 col-sm-12 mb-3">
            <label for="fec_cap"  class="form-label">Fecha</label>
            <input type="date" class="form-control" id="fec_cap" name="fec_cap" min="<?php date('Y-m-d') ?>" value="<?php if ($_POST['resp'] == 23) {
                                                                                                                        echo $rCap['fec_cap'];
                                                                                                                    } ?>">
        </div>
    </div>

    <div class="row pt-2">
        <div class="col-sm-6 col-md-3 mb-3">
            <div><label class="form-label" for="eva_cap">Evaluación</label></div>
            <label class="btn btn-info"><input type="radio" name="eva_cap" value="Si" <?php if (isset($_POST['edit'])) {
                                                                                                if ($rCap['eva_cap'] == 'Si') {
                                                                                                    echo 'checked';
                                                                                                }
                                                                                            } ?>>Si</label>
            <label class="btn btn-info"><input type="radio" name="eva_cap" value="No" <?php if (isset($_POST['edit'])) {
                                                                                                if ($rCap['eva_cap'] == 'No') {
                                                                                                    echo 'checked';
                                                                                                }
                                                                                            } ?>>No</label>
        </div>

        <div class="col-sm-6 col-md-3 mb-3">
            <div><label class="form-label" for="prd_cap">De Producto?</label></div>
            <label class="btn btn-info"><input type="radio" name="prd_cap" value="Si" <?php if (isset($_POST['edit'])) {
                                                                                                if ($rCap['prd_cap'] == 'Si') {
                                                                                                    echo 'checked';
                                                                                                }
                                                                                            } ?>>Si</label>
            <label class="btn btn-info"><input type="radio" name="prd_cap" value="No" <?php if (isset($_POST['edit'])) {
                                                                                                if ($rCap['prd_cap'] == 'No') {
                                                                                                    echo 'checked';
                                                                                                }
                                                                                            } ?>>No</label>
        </div>

        <div class="col-sm-6 col-md-3 mb-3">
            <div><label class="form-label" for="lug_cap">Lugar, ¿Dentro de MQ?</label></div>
            <label class="btn btn-info"><input type="radio" name="lug_cap" value="Si" <?php if (isset($_POST['edit'])) {
                                                                                                if ($rCap['lug_cap'] == 'Si') {
                                                                                                    echo 'checked';
                                                                                                }
                                                                                            } ?>>Si</label>
            <label class="btn btn-info"><input type="radio" name="lug_cap" value="No" <?php if (isset($_POST['edit'])) {
                                                                                                if ($rCap['lug_cap'] == 'No') {
                                                                                                    echo 'checked';
                                                                                                }
                                                                                            } ?>>No</label>
        </div>

        <div class="col-sm-6 col-md-3 mb-3">
            <div><label class="form-label" for="real_cap">Realizada?</label></div>
            <label class="btn btn-info"><input type="radio" name="real_cap" value="Si" <?php if (isset($_POST['edit'])) {
                                                                                                if ($rCap['real_cap'] == 'Si') {
                                                                                                    echo 'checked';
                                                                                                }
                                                                                            } ?>>Si</label>
            <label class="btn btn-info"><input type="radio" name="real_cap" value="No" <?php if (isset($_POST['edit'])) {
                                                                                                if ($rCap['real_cap'] == 'No') {
                                                                                                    echo 'checked';
                                                                                                }
                                                                                            } ?>>No</label>
        </div>
    </div>
</form>