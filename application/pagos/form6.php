<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
if ($_POST['resp'] == 17) {
    $sqlLi = "SELECT * FROM ind_infoli WHERE id_liqui=" . $_POST['edit'];
    $queryLi = $conexion->query($sqlLi);
    $rLi = $queryLi->fetch(PDO::FETCH_ASSOC);
    $area = $rLi['id_are'];
    $sql2 = "SELECT * FROM mq_are  WHERE id_are=$area";
    $query2 = $conexion->query($sql2);
    $sql22 = "SELECT * FROM mq_are  WHERE id_are!=$area";
    $query22 = $conexion->query($sql22);
    $liq = $rLi['id_liquiInf'];
    $sql3 = "SELECT * from ind_liqui WHERE id_liquiInf=$liq";
    $query3 = $conexion->query($sql3);
    $sql33 = "SELECT * from ind_liqui WHERE id_liquiInf!=$liq";
    $query33 = $conexion->query($sql33);
    $usu = $rLi['id_usu'];
    $sql4 = "SELECT * FROM mq_usu WHERE id_usu=$usu";
    $query4 = $conexion->query($sql4);
    $sql44 = "SELECT * FROM mq_usu WHERE id_usu!=$usu";
    $query44 = $conexion->query($sql44);
} else {
    $sql2 = "SELECT * FROM mq_are ";
    $query2 = $conexion->query($sql2);
    $sql3 = "SELECT * FROM ind_liqui";
    $query3 = $conexion->query($sql3);
    $sql4 = "SELECT * FROM mq_usu";
    $query4 = $conexion->query($sql4);
}
?>
<div class="row">
    <div class="col-12 text-center">
        <h3>Datos Liquidación </h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
    <form role="form" id="form-liqui">
        <input type="hidden" id="id_liqui" name="id_liqui" value="<?php echo $_POST['edit'] ?>">
        <input type="hidden" id="accion_form" name="action" value="<?php if ($_POST['resp'] != 16) {
                                                                        echo "liquidacion";
                                                                    } else {
                                                                        echo 'updateLiq';
                                                                    } ?>">
        <div class="row">
            <div class="col-md-3 col-sm-12 mb-3">
                <label for="are_liq" class="form-label">Área</label>
                <select class="form-select" id="are_liq" name="are_liq" onchange="usuario(this.value);" required>
                    <?php if ($_POST['resp'] == 16) { ?>
                        <option value="">Seleccionar</option>
                    <?php }
                    while ($r2 = $query2->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $r2['id_are']; ?>"><?php echo $r2['nom_are']; ?> </option>
                        <?php }
                    if ($_POST['resp'] == 17) {
                        while ($r22 = $query22->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $r22['id_are']; ?>"><?php echo $r22['nom_are']; ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
            <div class="col-md-3 col-sm-12 mb-3">
                <label for="usu_liq" class="form-label">Usuario</label>
                <select class="form-select" id="usu_liq" name="usu_liq" value="" required>
                    <?php if ($_POST['resp'] == 16) { ?>
                        <option value=""> Seleccione el área</option>
                        <?php } else {
                        while ($r4 = $query4->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $r4['id_usu']; ?>"><?php echo $r4['nom_usu']; ?> </option>
                            <?php }
                        if ($_POST['resp'] == 17) {
                            while ($r44 = $query44->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $r44['id_usu']; ?>"><?php echo $r44['nom_usu']; ?></option>
                    <?php }
                        }
                    } ?>
                </select>
            </div>
            <div class="col-md-3 col-sm-12 mb-3">
                <label for="mov_liq" class="form-label">Motivo</label>
                <select class="form-select" id="mov_liq" name="mov_liq" value="" required>
                    <?php if ($_POST['resp'] == 16) { ?>
                        <option value="">Seleccionar</option>
                    <?php }
                    while ($r3 = $query3->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $r3['id_liquiInf']; ?>"><?php echo $r3['nom_liqui']; ?></option>
                        <?php }
                    if ($_POST['resp'] == 17) {
                        while ($r33 = $query33->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $r33['id_liquiInf']; ?>"><?php echo $r33['nom_liqui']; ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
            <div class="col-md-3 col-sm-12 mb-3">
                <label for="fecha_sol" class="form-label">Fecha De Retiro</label>
                <input type="date" class="form-control" id="fecha_sol" name="fecha_sol" value="<?php if (isset($_POST['edit'])) {
                                                                                                    echo $rLi['fec_ret'];
                                                                                                } ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 mb-3">
                <label for="obse_inf" class="form-label">Observación</label>
                <textarea class="form-control" id="obse_inf" name="obse_inf" rowa="3" placeholder="Llena este espacio para  Justificar la causa de retiro"><?php if (isset($_POST['edit'])) {
                                                                                                                                                                echo $rLi['obs_info'];
                                                                                                                                                            } ?></textarea>
            </div>
        </div>

    </form>