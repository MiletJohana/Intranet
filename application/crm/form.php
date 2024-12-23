<?php
include "../../resources/template/credentials.php";
include '../../conexion.php';

$fecha = date('Y-m-d');

if ($_POST['resp'] == 2) {
    $sql2 = "SELECT * FROM negocios
    WHERE id_neg = " . $_POST['id_neg'];
    $query2 = $conexion->query($sql2);
    $r2 = $query2->fetch(PDO::FETCH_ASSOC);

    $id_tipo = $r2['id_tipo'];

    $sqlTip2 = "SELECT * FROM tipo_negocio WHERE id_tipo = " . $id_tipo;
    $queryTip2 = $conexion->query($sqlTip2);
    $rTip2 = $queryTip2->fetch(PDO::FETCH_ASSOC);

    $sqlTip21 = "SELECT * FROM tipo_negocio WHERE id_tipo != " . $id_tipo;
    $queryTip21 = $conexion->query($sqlTip21);

    $id_est = $r2['id_est'];

    $sqlEst2 = "SELECT * FROM neg_est WHERE id_est = " . $id_est . " AND id_est != 1";
    $queryEst2 = $conexion->query($sqlEst2);
    $rEst2 = $queryEst2->fetch(PDO::FETCH_ASSOC);

    $sqlEst21 = "SELECT * FROM neg_est WHERE id_est != " . $id_est . " AND id_est != 1";
    $queryEst21 = $conexion->query($sqlEst21);

    $id_neg = $r2['id_neg'];

    $sqlCat2 = "SELECT id_cat FROM cat_x_neg WHERE id_neg = " . $id_neg;
    $queryCat2 = $conexion->query($sqlCat2);
    $categorias = array();
    while ($rCat2 = $queryCat2->fetch(PDO::FETCH_ASSOC)) {
        array_push($categorias, $rCat2['id_cat']);
    }
}

$sqlTip = "SELECT * FROM tipo_negocio";
$queryTip = $conexion->query($sqlTip);

$sqlCat = "SELECT * FROM cot_categoria";
$queryCat = $conexion->query($sqlCat);

?>
<div class="row">
    <div class="col-12 text-center">
        <label for="nom_neg">
            <h3>Negocio</h3>
        </label>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<form role="form" id="form-neg">
    <?php if ($_POST['id_cli'] == 0 && $_POST['resp'] == 1) { ?>
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="nom_cli" class="form-label">Cliente</label>
                <input type="text" class="form-control" id="nom_cli" name="nom_cli" max="15" onkeyup="buscarCliente()" required>
            </div>
        </div>
    <?php } ?>
    <input type="hidden" id="id_cli" name="id_cli" value="<?php if ($_POST['resp'] == 2) {
                                                                echo $r2['id_cli'];
                                                            } else {
                                                                echo $_POST['id_cli'];
                                                            } ?>">
    <input type="hidden" id="action" name="action" value="<?php if ($_POST['resp'] == 1) {
                                                                echo "addNegocio";
                                                            } else if ($_POST['resp'] == 2) {
                                                                echo "uptNegocio";
                                                            } ?>">
    <?php if ($_POST['resp'] == 2) { ?>
        <input type="hidden" id="id_neg" name="id_neg" value="<?php echo $_POST['id_neg']; ?>">
    <?php } ?>
    <div class="row">
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="id_tipo" class="form-label">Tipo del negocio</label>
            <select id="id_tipo" name="id_tipo" class="form-select">
                <?php if ($_POST['resp'] == 1) { ?>
                    <option value="">Seleccionar</option>
                    <?php while ($rTip = $queryTip->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rTip['id_tipo']; ?>"><?php echo $rTip['nom_tipo']; ?> </option>
                    <?php }
                } else { ?>
                    <option value="<?php echo $rTip2['id_tipo']; ?>"><?php echo $rTip2['nom_tipo']; ?></option>
                    <?php while ($rTip21 = $queryTip21->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rTip21['id_tipo']; ?>"><?php echo $rTip21['nom_tipo']; ?></option>
                <?php }
                } ?>
            </select>
        </div>
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="des_neg" class="form-label">Descripción del negocio</label>
            <textarea class="form-control" id="des_neg" name="des_neg" max="280"><?php if ($_POST['resp'] == 2) {
                                                                                        echo $r2['des_neg'];
                                                                                    } ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="val_neg" class="form-label">Valor del negocio</label>
            <input type="number" maxlength="50" class="form-control" id="val_neg" name="val_neg" value="<?php if ($_POST['resp'] == 2) {
                                                                                                            echo $r2['val_neg'];
                                                                                                        } ?>" required>
        </div>
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="fec_ini" class="form-label">Inicio del negocio</label>
            <input type="date" class="form-control" id="fec_ini" name="fec_ini" value="<?php if ($_POST['resp'] == 2) {
                                                                                                echo $r2['fec_ini'];
                                                                                            } else {
                                                                                                echo $fecha;
                                                                                            } ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="fec_fin" class="form-label">Fin del negocio</label>
            <input type="date" class="form-control" id="fec_fin" name="fec_fin" value="<?php if ($_POST['resp'] == 2) {
                                                                                                if ($r2['fec_fin'] == '') {
                                                                                                    echo $fecha;
                                                                                                } else {
                                                                                                    echo $r2['fec_fin'];
                                                                                                }
                                                                                            } ?>" required>
        </div>
    </div>
    <div class="row">
        <?php if ($_POST['resp'] == 2) { ?>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="id_est" class="form-label">Estado del negocio</label>
                <select id="id_est" name="id_est" class="form-select">
                    <option value="<?php echo $rEst2['id_est']; ?>"><?php echo $rEst2['estado']; ?> </option>
                    <?php while ($rEst21 = $queryEst21->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rEst21['id_est']; ?>"><?php echo $rEst21['estado']; ?> </option>
                    <?php } ?>
                </select>
            </div>
        <?php } ?>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 bg-secondary rounded my-2">
            <label class="m-2" class="form-label">Tipo de productos</label>
            <br>
            <?php while ($rCat = $queryCat->fetch(PDO::FETCH_ASSOC)) { ?>
                <label class="btn btn-default">
                    <?php if ($_POST['resp'] == 1) { ?>
                        <input type="checkbox" id="tip-<?php echo $rCat['id_cat']; ?>" name="tip-<?php echo $rCat['id_cat']; ?>" value="<?php echo $rCat['id_cat']; ?>"> <?php echo $rCat['nom_cat']; ?>
                    <?php } else if ($_POST['resp'] == 2) { ?>
                        <input type="checkbox" id="tip-<?php echo $rCat['id_cat']; ?>" name="tip-<?php echo $rCat['id_cat']; ?>" value="<?php echo $rCat['id_cat']; ?>" <?php if (in_array($rCat['id_cat'], $categorias)) {
                                                                                                                                                                            echo "checked";
                                                                                                                                                                        } ?>> <?php echo $rCat['nom_cat']; ?>
                    <?php } ?>
                </label>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-5">
            <label>Etapa del negocio</label>
            <br>
            <label class="btn btn-default">
                <input type="checkbox" name="pot_crea" id="pot_crea" value="<?php if ($_POST['resp'] == 2 && $r2['pot_crea'] == 'Si') {
                                                                                echo 1;
                                                                            } else {
                                                                                echo 0;
                                                                            } ?>" onchange="check(this.value, 1)" <?php if ($_POST['resp'] == 2 && $r2['pot_crea'] == 'Si') {
                                                                                                                        echo "checked";
                                                                                                                    } ?>> Potencial creado
            </label>
            <label class="btn btn-default">
                <input type="checkbox" name="cont_rea" id="cont_rea" value="<?php if ($_POST['resp'] == 2 && $r2['cont_rea'] == 'Si') {
                                                                                echo 1;
                                                                            } else {
                                                                                echo 0;
                                                                            } ?>" onchange="check(this.value, 2)" <?php if ($_POST['resp'] == 2 && $r2['cont_rea'] == 'Si') {
                                                                                                                        echo "checked";
                                                                                                                    } ?>> Contacto realizado
            </label>
            <label class="btn btn-default">
                <input type="checkbox" name="visi_rea" id="visi_rea" value="<?php if ($_POST['resp'] == 2 && $r2['visi_rea'] == 'Si') {
                                                                                echo 1;
                                                                            } else {
                                                                                echo 0;
                                                                            } ?>" onchange="check(this.value, 3)" <?php if ($_POST['resp'] == 2 && $r2['visi_rea'] == 'Si') {
                                                                                                                        echo "checked";
                                                                                                                    } ?>> Visita realizada
            </label>
            <label class="btn btn-default">
                <input type="checkbox" name="cot_soli" id="cot_soli" value="<?php if ($_POST['resp'] == 2 && $r2['cot_soli'] == 'Si') {
                                                                                echo 1;
                                                                            } else {
                                                                                echo 0;
                                                                            } ?>" onchange="check(this.value, 4)" <?php if ($_POST['resp'] == 2 && $r2['cot_soli'] == 'Si') {
                                                                                                                        echo "checked";
                                                                                                                    } ?>> Cotizacion solicitada
            </label>
            <label class="btn btn-default">
                <input type="checkbox" name="ped_rea" id="ped_rea" value="<?php if ($_POST['resp'] == 2 && $r2['ped_rea'] == 'Si') {
                                                                                echo 1;
                                                                            } else {
                                                                                echo 0;
                                                                            } ?>" onchange="check(this.value, 5)" <?php if ($_POST['resp'] == 2 && $r2['ped_rea'] == 'Si') {
                                                                                                                        echo "checked";
                                                                                                                    } ?>> Pedido realizado
            </label>
            <?php if ($_POST['resp'] == 1) { ?>
                <label class="btn btn-default">
                    <input type="checkbox" name="neg_per" id="neg_per" value="0" onchange="check(this.value, 6)" <?php if ($_POST['resp'] == 2 && $r2['neg_per']) {
                                                                                                                        echo "checked";
                                                                                                                    } ?>> Negocio perdido
                </label>
            <?php } ?>
        </div>
    </div>
    <?php if ($_POST['resp'] == 2) { ?>
        <div class="row">
            <div class="col-12 mt-5">
                <label for="obs_neg" class="form-label">Observación</label>
                <textarea class="form-control" id="obs_neg" name="obs_neg" max="280"><?php if ($_POST['resp'] == 2) {
                                                                                            echo $r2['obs_neg'];
                                                                                        } ?></textarea>
            </div>
        </div>
    <?php } ?>
</form>