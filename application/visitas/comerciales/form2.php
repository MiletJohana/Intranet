<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
$fecha = date("Y-m-d");
$sql2 = "SELECT * FROM tip_dlg";
$query2 = $conexion->query($sql2);
$slq3 = "SELECT * FROM mq_reg";
$query3 = $conexion->query($slq3);
$sqlRaz = "SELECT * FROM agen_raz";
$queryRaz = $conexion->query($sqlRaz);
$sql4=" SELECT * FROM agen_tipclie";
$query4= $conexion->query($sql4);
?>
<form role="form" id="form-cita">
    <div class="alert alert-warning" role="alert">
        (*) Campo requerido
    </div>
    <div class="form-group row">
        <div class="col-md-12 col-sm-12">
            <label for="id_raz">Razón Visita *</label>
            <select id class="form-control" id="id_raz" name="id_raz" onchange="selectRaz(this.value)" required>
                <?php if ($_POST['resp'] == 1) { ?>
                    <option value="0">Seleccionar</option>
                <?php }
                if (isset($_POST['resp']) && $_POST['resp'] == 2) { ?>
                    <option value="<?= $rRaz2['id_raz'] ?>"><?= utf8_encode($rRaz2['nom_raz']) ?></option>
                    <?php }
                if (isset($_POST['resp']) && ($_POST['resp'] == 1 || $_POST['resp'] == 2)) {
                    $sqlRaz = "SELECT * FROM agen_raz";
                    if (isset($_POST['resp']) && $_POST['resp'] == 2) {
                        $sqlRaz .= " WHERE id_raz!=" . $rEst['id_raz'];
                    }
                    $queryRaz2 = $conexion->query($sqlRaz);
                    while ($rRaz = $queryRaz2->fetch_array()) { ?>
                        <option value="<?= $rRaz['id_raz'] ?>"><?= utf8_encode($rRaz['nom_raz']) ?></option>
                <?php }
                } ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-12 col-sm-12 text-center">
            <label for="nom_cli">
                <h3>Datos de Cliente</h3>
            </label>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6 col-sm-12">
            <label for="nom_cli">Nombre <span name="req">*</span></label>
            <input type="text" class="form-control" id="nom_cli" name="nom_cli" value="<?php echo ($_POST['resp'] == 2) ? utf8_encode($r['nom_cli']) : ''; ?>" required>
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="tip_id">Tipo <span name="req">*</span></label>
            <select class="form-control" id="tip_id" name="tip_id" required>
                <option value="Nit">Nit</option>
                <option value="C.C">C.C</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6 col-sm-12">
            <label for="id_cli">ID (NIT o Cedula) <span name="req">*</span></label>
            <input type="number" class="form-control" id="id_cli" name="id_cli" value="<?php echo ($_POST['resp'] == 2) ? $r['id_cli'] : ''; ?>" onkeyup="verificarCL();" required>
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="dir_cli">Dirección <span name="req">*</span></label>
            <input type="text" class="form-control" id="dir_cli" name="dir_cli" value="<?php echo ($_POST['resp'] == 2) ? $r['dir_cli'] : ''; ?>" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6 col-sm-12">
            <label for="tel_cli">Teléfono <span name="req">*</span></label>
            <input type="number" class="form-control" id="tel_cli" name="tel_cli" value="<?php echo ($_POST['resp'] == 2) ? $r['tel_cli'] : ''; ?>" required>
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="web_cli">Web</label>
            <input type="text" class="form-control" id="web_cli" name="web_cli" value="<?php echo ($_POST['resp'] == 2) ? $r['web_cli'] : ''; ?>">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6 col-sm-12">
            <label for="hor_cli">Horario</label>
            <input type="text" class="form-control" id="hor_cli" name="hor_cli" value="<?php echo ($_POST['resp'] == 2) ? $r['hor_cli'] : ''; ?>">
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="id_reg">Regional <span name="req">*</span></label>
            <select id="id_reg" name="id_reg" class="form-control" required>
                <?php if ($_POST['resp'] == 1) {
                    while ($r3 = $query3->fetch_array()) { ?>
                        <option value="<?php echo $r3['id_reg']; ?>"><?php echo utf8_encode($r3['nom_reg']); ?></option>
                    <?php }
                } else { ?>
                    <option value="<?php echo $r3['id_reg']; ?>"><?php echo utf8_encode($r3['nom_reg']); ?></option>
                    <?php while ($r33 = $query33->fetch_array()) { ?>
                        <option value="<?php echo $r33['id_reg']; ?>"><?php echo utf8_encode($r33['nom_reg']); ?></option>
                <?php }
                } ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6 col-sm-12">
            <label for="tip_cliD">Tipo De CLiente <span name="req">*</span></label>
            <select id="tip_cliD" name="tip_cliD" class="form-control" required>
                <?php if ($_POST['resp'] == 1) {?>
                    <option value="0">Seleccionar</option>
                        <?php while ($r4= $query4->fetch_array()) { ?>
                            <option value="<?php echo $r4['id_tipcli']; ?>"><?php echo utf8_encode($r4['nom_tipcli']); ?></option>
                        <?php }
                    } else { ?>
                        <option value="<?php echo $r4['id_tipcli']; ?>"><?php echo utf8_encode($r4['nom_tipcli']); ?></option>
                        <?php while ($r44 = $query44->fetch_array()) { ?>
                            <option value="<?php echo $r44['id_tipcli']; ?>"><?php echo utf8_encode($r44['nom_tipcli']); ?></option>
                    <?php }
                    } ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-12 col-sm-12 text-center">
            <label for="con_cli">
                <h3>Datos de Contacto</h3>
            </label>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6 col-sm-12">
            <label for="con_cli">Contacto <span name="req">*</span></label>
            <input type="text" class="form-control" id="con_cli" name="con_cli" value="<?php echo ($_POST['resp'] == 2) ? utf8_encode($r['con_cli']) : ''; ?>" required>
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="eml_con">Email <span name="req">*</span></label>
            <input type="email" class="form-control" id="eml_con" name="eml_con" value="<?php echo ($_POST['resp'] == 2) ? $r['eml_con'] : ''; ?>" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6 col-sm-12">
            <label for="carg_con">Cargo</label>
            <input type="text" class="form-control" id="carg_con" name="carg_con" value="<?php echo ($_POST['resp'] == 2) ? $r['carg_con'] : ''; ?>">
        </div>
    </div>
    <input type="hidden" id="lat_ini" name="lat_ini" value="">
    <input type="hidden" id="lon_ini" name="lon_ini" value="">
    <input type="hidden" id="action" name="action" value="<?php if ($_POST['resp'] == 1) {
                                                                echo 'add';
                                                            } elseif ($_POST['resp'] == 2) {
                                                                echo 'update';
                                                            } elseif ($_POST['resp'] == 3) {
                                                                echo 'updateIni';
                                                            } elseif ($_POST['resp'] == 4) {
                                                                echo 'updateFin';
                                                            } elseif ($_POST['resp'] == 5) {
                                                                echo 'cancel';
                                                            } ?>">
</form>