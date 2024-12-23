<?php

include '../../conexion.php';
include '../../resources/template/credentials.php';

if ($_POST['resp'] == 6) {

    $sql2 = "SELECT * FROM mq_clientes WHERE id_cli = " . $_POST['id_cli'];
    $query2 = $conexion->query($sql2);
    $r2 = $query2->fetch(PDO::FETCH_ASSOC);

    $id_ciu = $r2['id_ciu'];

    $slqCiu2 = "SELECT * FROM ciudades WHERE id_ciu = " . $id_ciu;
    $queryCiu2 = $conexion->query($slqCiu2);
    $rC2 = $queryCiu2->fetch(PDO::FETCH_ASSOC);

    $slqCiu21 = "SELECT * FROM ciudades WHERE id_ciu != " . $id_ciu;
    $queryCiu21 = $conexion->query($slqCiu21);

    if (isset($r2['id_tipo']) || $r2['id_tipo'] != '') {
        $id_tipo = $r2['id_tipo'];

        $sqlTipCli2 = "SELECT * FROM tipo_clientes WHERE id_tipo = " . $id_tipo;
        $queryTipCli2 = $conexion->query($sqlTipCli2);
        $rT2 = $queryTipCli2->fetch(PDO::FETCH_ASSOC);

        $sqlTipCli21 = "SELECT * FROM tipo_clientes WHERE id_tipo != " . $id_tipo;
        $queryTipCli21 = $conexion->query($sqlTipCli21);
    }
}

$sqlCiu = "SELECT * FROM ciudades";
$queryCiu = $conexion->query($sqlCiu);

$sqlTipCli = "SELECT * FROM tipo_clientes";
$queryTipCli = $conexion->query($sqlTipCli);
?>

<div class="row">
    <div class="col-md-4 col-sm-12 mb-3">
        <label for="tel_cli" class="form-label text-white">Teléfono o celular <span name="req" class="text-mq">*</span></label>
        <input type="number" class="form-control" id="tel_cli" name="tel_cli" placeholder="Teléfono de la empresa" onkeyup="" value="<?php if ($_POST['resp'] == 6) {
                                                                                                                                            echo $r2['tel_cli'];
                                                                                                                                        } else {
                                                                                                                                            echo '';
                                                                                                                                        } ?>" required>
    </div>
    <div class="col-md-4 col-sm-12 mb-3">
        <label for="eml_cli" class="form-label text-white">Email <span name="req" class="text-mq">*</span></label>
        <input type="email" class="form-control" id="eml_cli" name="eml_cli" placeholder="correo@empresa.com" onkeyup="" value="<?php if ($_POST['resp'] == 6) {
                                                                                                                                    echo $r2['eml_cli'];
                                                                                                                                } else {
                                                                                                                                    echo '';
                                                                                                                                } ?>" required>
    </div>
    <div class="col-md-4 col-sm-12 mb-3">
        <label for="dir_cli" class="form-label text-white">Dirección</label>
        <input type="text" class="form-control" id="dir_cli" name="dir_cli" value="<?php if ($_POST['resp'] == 6) {
                                                                                        echo $r2['dir_cli'];
                                                                                    } else {
                                                                                        echo '';
                                                                                    } ?>">
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-sm-12 mb-3">
        <label for="id_ciu1" class="form-label text-white">Ciudad</label>
        <select id="id_ciu1" name="id_ciu" class="form-select">
            <?php if ($_POST['resp'] == 1) {
                while ($rC = $queryCiu->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $rC['id_ciu']; ?>"><?php echo $rC['nom_ciu']; ?></option>
                <?php }
            } else { ?>
                <option value="<?php echo $rC2['id_ciu']; ?>"><?php echo $rC2['nom_ciu']; ?></option>
                <?php while ($rC21 = $queryCiu21->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $rC21['id_ciu']; ?>"><?php echo $rC21['nom_ciu']; ?></option>
            <?php }
            } ?>
        </select>
    </div>
</div>