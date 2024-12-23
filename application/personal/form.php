<?php
if (isset($_POST['resp']) && $_POST['resp'] == 3) {
    include '../../conexion.php';
    include "../../resources/template/credentials.php";
} else {
    include '../../conexion.php';
    include "../../resources/template/credentials.php";
}
if ($_POST['resp'] == 2) {
    $sql = "SELECT * FROM ind_solcarg WHERE id_solC=\"$_POST[edit]\"";
    $query = $conexion->query($sql);
    $r = $query->fetch(PDO::FETCH_ASSOC);
    $area = $r['area_sol'];
    $sql2 = "SELECT * FROM mq_are  WHERE id_are=$area";
    $query2 = $conexion->query($sql2);
    $sql22 = "SELECT * FROM mq_are  WHERE id_are!=$area";
    $query22 = $conexion->query($sql22);
    $carg = $r['carg_sol'];
    $sql4 = "SELECT * FROM ind_cargos WHERE id_carg=$carg";
    $query4 = $conexion->query($sql4);
    $sql44 = "SELECT * FROM ind_carg_x_are ca,ind_cargos car WHERE ca.id_carg=car.id_carg AND ca.id_carg!=$carg AND ca.id_are=$area";
    $query44 = $conexion->query($sql44);
    //  echo $sql44;

} else {
    $sql2 = "SELECT * FROM mq_are ";
    $query2 = $conexion->query($sql2);
    $sql4 = "SELECT * FROM ind_cargos";
    $query4 = $conexion->query($sql4);
}

if (isset($_POST['resp']) && $_POST['resp'] == 3) {
?>
    <form role="form" id="form-Personal">
        <h3 class="text-center">¿Desea rechazar ésta solicitud?</h3>
        <div class="row">
            <div class="col-12 col-sm-12 mb-3">
                <label for="observ" class="form-label"> Motivo</label>
                <textarea class="form-control" id="observ" name="observ" placeholder="Llena este espacio con el motivo del Rechazo"></textarea>
                <input type="hidden" id="accion_form" name="action" value="rechazarPer">
                <input type="hidden" name="id_solC" id="id_solC" value="<?php echo $_POST['edit']; ?>">
            </div>
        </div>
    </form>
<?php } else { ?>
    <form role="form" id="form-Personal">
        <div class="row">
            <div class="col-12 mb-3">
                <h3 class="text-center">Solicitud de Personal</h3>
                <hr class="mx-auto" style="width:60%;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="are_carg" class="form-label">Área</label>
                <select class="form-select" id="are_carg" name="are_carg" onchange="cargos(1,this.value);" required>
                    <?php if ($_POST['resp'] == 1) { ?>
                        <option value="">Seleccionar </option>
                    <?php }
                    while ($r2 = $query2->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $r2['id_are']; ?>"><?php echo $r2['nom_are']; ?></option>
                        <?php }
                    if ($_POST['resp'] == 2) {
                        while ($r22 = $query22->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $r22['id_are']; ?>"><?php $r22['nom_are']; ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="car_per" class="form-label">Cargo</label>
                <select class="form-select" id="car_per" name="car_per" value="" required>
                    <?php if ($_POST['resp'] == 1) { ?>
                        <option value="">Seleccione el Área </option>
                        <?php }
                    if ($_POST['resp'] == 2) {
                        if ($query4->rowCount() > 0) {
                            while ($r4 = $query4->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $r4['id_carg']; ?>"><?php echo $r4['nom_carg']; ?></option>
                            <?php }
                            while ($r44 = $query44->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $r44['id_carg']; ?>"><?php echo $r44['nom_carg']; ?></option>
                    <?php }
                        }
                    } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="fech_crea" class="form-label">Fecha Requerida</label>
                <input type="date" class="form-control" name="fech_crea" id="fech_crea" min="<?php date('Y-m-d') ?>" value="<?php if (isset($_POST['edit'])) {
                                                                                                                                echo $r['fecha_sol'];
                                                                                                                            } ?>" required>
            </div>

            <div class="col-md-6 col-sm-12 mb-3">
                <label class="form-label">Tipo De Contrato</label>
                <br>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" id="tip1" name="tip" value="Temporal" <?php if (isset($_POST['edit'])) {
                                                                                                            if ($r['cont_sol'] == 'Temporal') {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                        } ?>>
                    <label class="form-check-label" for="tip1">
                        Temporal
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" id="tip2" name="tip" value="Contrato Indefinido" <?php if (isset($_POST['edit'])) {
                                                                                                                        if ($r['cont_sol'] == 'Contrato Indefinido') {
                                                                                                                            echo 'checked';
                                                                                                                        }
                                                                                                                    } ?>>
                    <label class="form-check-label" for="tip2">
                        Contrato Indefinido
                    </label>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-12 mb-3">
                <label for="sala" class="form-label">Salario</label>
                <input type="number" class="form-control" id="sala" name="sala" placeholder="Básico" value="<?php if (isset($_POST['edit'])) {
                                                                                                                echo $r['sal_sol'];
                                                                                                            } ?>" required>
            </div>
            <div class="col-md-3 col-sm-12 mb-3">
                <label for="var_sal" class="form-label">Variable</label>
                <input type="number" class="form-control" id="var_sal" name="var_sal" value="<?php if (isset($_POST['edit'])) {
                                                                                                    echo $r['sal_sol'];
                                                                                                } ?>" required>
            </div>
            <div class="col-md-3 col-sm-12 mb-3">
                <label for="rod_sal" class="form-label"> Rodamiento (Si aplica) </label>
                <input type="number" class="form-control" id="rod_sal" name="rod_sal" placeholder="Si aplica" value="<?php if (isset($_POST['edit'])) {
                                                                                                                            echo $r['rod_sal'];
                                                                                                                        } ?>">
            </div>

            <div class="col-md-3 col-sm-12 mb-3">
                <label for="can_per" class="form-label">Personas Requeridas</label>
                <input type="number" class="form-control" name="can_per" id="can_per" value="<?php if (isset($_POST['edit'])) {
                                                                                                    echo $r['per_sol'];
                                                                                                } ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 mb-3">
                <label for="observ" class="form-label"> Observación</label><textarea class="form-control" id="observ" name="observ" placeholder="Llena este espacio con observaciones del puesto requerido"><?php if (isset($_POST['edit'])) {
                                                                                                                                                                                                echo $r['obs_sol'];
                                                                                                                                                                                            } ?></textarea>
            </div>
        </div>
        <input type="hidden" id="id_solC" name="id_solC" value="<?php if (isset($_POST['edit'])) {
                                                                    echo $_POST['edit'];
                                                                } ?>">
        <input type="hidden" id="accion_form" name="action" value="<?php if ($_POST['resp'] == 1) {
                                                                        echo "addPer";
                                                                    } else {
                                                                        echo 'updatePer';
                                                                    } ?>">
    </form>
<?php } ?>