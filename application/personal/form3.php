<?php
// Pendiete el editar de los Seleccionados
include '../../conexion.php';
include '../../resources/template/credentials.php';
if ($_POST['resp'] == 6) {
    $sql = "SELECT * FROM ind_solcarg car,ind_select_per per WHERE id_sel=" . $_POST['edit'];
    $query = $conexion->query($sql);
    $r = $query->fetch(PDO::FETCH_ASSOC);
    $area = $r['area_sol'];
    $id = $r['id_solC'];

    $sql2 = "SELECT * from ind_solcarg sol, mq_are ar
                        WHERE sol.area_sol=ar.id_are
                        AND id_estaSol IN (2)
                        AND id_solC='" . $id . "'
                        ORDER BY nom_are";
    $query2 = $conexion->query($sql2);
    //echo $sql2;
    $sql22 = "SELECT * from ind_solcarg sol, mq_are ar, ind_cargos car
                        WHERE sol.area_sol=ar.id_are
                        AND id_estaSol IN (2)
                        AND sol.carg_sol=car.id_carg
                        AND id_solC!='" . $id . "'
                        ";
    $query22 = $conexion->query($sql22);
    echo $sql22;

} else {
    $sql2 = "SELECT * from ind_solcarg sol, mq_are ar
                        WHERE sol.area_sol=ar.id_are
                        AND id_estaSol IN (2)
                        ORDER BY nom_are";
    $query2 = $conexion->query($sql2);
    //echo $sql2;
    $sql3 = "SELECT * from mq_reg";
    $query3 = $conexion->query($sql3);
}

?>
<form role="form" id="form-Select">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center"> Entrevista Personal </h3>
            <hr class="mx-auto" style="width:60%;">
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-12 mt-3">
            <label for="id_solC" class="form-label">Cargos Disponibles</label>
            <select class="form-select" id="id_solC" name="id_solC" onchange="cargos(1,this.value);" required>
                <?php if ($_POST['resp'] == 5) { ?>
                    <option value="">Seleccionar </option>
                <?php }
                while ($r2 = $query2->fetch(PDO::FETCH_ASSOC)) {
                    $car = $r2['carg_sol'];
                    $sqlCar = "SELECT nom_carg FROM ind_cargos WHERE id_carg=" . $car;
                    echo $sqlCar;
                    $queryCar = $conexion->query($sqlCar);
                    $queryCar2 = $conexion->query($sqlCar);
                    $q = 0;
                    if ($queryCar->rowCount() > 0) {
                        $rCar = $queryCar->fetch(PDO::FETCH_ASSOC);
                        $q = 1;
                    }
                    $rCar2 = $queryCar2->fetch(PDO::FETCH_ASSOC);
                ?>
                    <option value="<?php echo $r2['carg_sol']; ?>"><?php if ($q > 0) {
                                                                        echo $rCar['nom_carg'];
                                                                    } else {
                                                                        echo $r2['carg_sol'];
                                                                    }
                                                                    echo ' (' . 
                                                                    $r2['nom_are']  . ')'; ?></option>
                    <?php }
                if ($_POST['resp'] == 6) {
                    while ($r22 = $query22->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php if ($r['req_sol'] == 0) {
                                            echo $r22['id_solC'];
                                        } else {
                                            echo $r22['id_carg'] . ',' . $r22['id_are'];
                                        } ?>"><?php if ($q > 0) {
                                                                                                                                                echo $r22['nom_carg'];
                                                                                                                                            } else {
                                                                                                                                                echo $r22['nom_carg'];
                                                                                                                                            }
                                                                                                                                            echo ' (' . $r22['nom_are'] . ')'; ?></option>
                <?php }
                } ?>
            </select>
        </div>
        <div class="col-md-3 col-sm-12 mt-3">
            <label for="id_per" class="form-label"> Identificación </label>
            <input type="number" class="form-control" name="id_per" id="id_per" value="<?php if (isset($_POST['resp']) && $_POST['resp'] == 6) {
                                                                                            echo $r['id_per'];
                                                                                        } ?>" required>
        </div>

        <div class="col-md-3 col-sm-12 mt-3">
            <label for="nom_per" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nom_per" id="nom_per" value="<?php if (isset($_POST['resp']) && $_POST['resp'] == 6) {
                                                                                            echo $r['nom_per'];
                                                                                        } ?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mt-3">
            <label for="cel_per" class="form-label">Celular</label>
            <input type="number" class="form-control" id="cel_per" name="cel_per" value="<?php if (isset($_POST['resp']) && $_POST['resp'] == 6) {
                                                                                                echo $r['cel_per'];
                                                                                            } ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-12 mt-3">
            <label for="fec_ent" class="form-label">Fecha entrevista</label>
            <input type="date" class="form-control" name="fec_ent" id="fec_ent" value="<?php if (isset($_POST['resp']) && $_POST['resp'] == 6) {
                                                                                            echo $r['fec_ent'];
                                                                                        } ?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mt-3">
            <label for="ema_ent" class="form-label">Email</label>
            <input type="email" class="form-control" name="ema_ent" id="ema_ent" value="<?php if (isset($_POST['resp']) && $_POST['resp'] == 6) {
                                                                                            echo $r['ema_ent'];
                                                                                        } ?>" min="<?php date('Y-m-d') ?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mt-3">
            <label for="hor_ent" class="form-label">Hora de Entrevista</label>
            <input type="time" class="form-control" name="hor_ent" id="hor_ent" value="<?php if (isset($_POST['resp']) && $_POST['resp'] == 6) {
                                                                                            echo $r['hor_ent'];
                                                                                        } ?>" min="<?php date('Y-m-d') ?>" required>
        </div>
    </div>
    <input type="hidden" id="accion_form" name="action" value="<?php if ($_POST['resp'] == 5) {
                                                                    echo "addSelect";
                                                                } else {
                                                                    echo 'updateSelect';
                                                                } ?>">
    <input type="hidden" name="id_sel" id="id_sel" value="<?php if (isset($_POST['resp']) && $_POST['resp'] == 6) {
                                                                echo $_POST['edit'];
                                                            } ?>">
</form>