<?php
if (isset($_POST['edit']) && $_POST['edit'] != '' && $_POST['resp'] == 7) {
    include '../../conexion.php';
    include "../../resources/template/credentials.php";
    $sql = "SELECT * FROM mq_clie WHERE id_cli='" . $_POST['edit'] . "'";
    $query = $conexion->query($sql);
    $cli = null;
    while ($r = $query->fetch(PDO::FETCH_OBJ)) {
        $cli = $r;
        break;
    }
    $ase = $cli->ase_com;
    if ($ase != '') {
        $sql11 = "SELECT id_usu,nom_usu FROM mq_usu where id_usu='$ase' order by nom_usu";
        $query11 = $conexion->query($sql11);
        $rA = $query11->fetch(PDO::FETCH_ASSOC);
        $sql1 = "SELECT id_usu,nom_usu FROM mq_usu where id_usu!='$ase' order by nom_usu";
        $query1 = $conexion->query($sql1);
    } else {
        $sql1 = "SELECT id_usu,nom_usu FROM mq_usu WHERE id_car IN (1,4,5,6,7,8,9,10,11,12,13,14,16,17) order by nom_usu";
        $query1 = $conexion->query($sql1);
    }
    $rep = $cli->rep_sac;
    if ($rep != '') {
        $sql22 = "SELECT id_usu,nom_usu FROM mq_usu WHERE id_usu='$rep' order by nom_usu";
        $query22 = $conexion->query($sql22);
        $rR = $query22->fetch(PDO::FETCH_ASSOC);
        $sql2 = "SELECT id_usu,nom_usu FROM mq_usu WHERE id_usu!='$rep' order by nom_usu";
        $query2 = $conexion->query($sql2);
    } else {
        $sql2 = "SELECT id_usu,nom_usu FROM mq_usu WHERE id_car IN (3,14) order by nom_usu";
        $query2 = $conexion->query($sql2);
    }
} else {
    $sql1 = "SELECT id_usu,nom_usu FROM mq_usu WHERE id_car IN (1,4,5,6,7,8,9,10,11,12,13,14,16,17) order by nom_usu";
    $query1 = $conexion->query($sql1);
    $sql2 = "SELECT id_usu,nom_usu FROM mq_usu WHERE id_car IN (3,14) order by nom_usu";
    $query2 = $conexion->query($sql2);
}
?>
<div class="row">
    <div class="col-12 text-center">
        <div class="col-12">
            <h3 id="titleClie">
                <?php if (isset($_POST['resp']) && $_POST['resp'] == 7) {
                    echo 'Actualizar Cliente';
                } else {
                    echo 'Nuevo Cliente';
                }
                ?>
            </h3>
            <hr class="mx-auto" style="width:60%;">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-2 col-sm-12 mb-3">
        <?php if (!isset($_POST['edit'])) { ?>
            <button class="btn btn-primary" onclick="buscarClie(1)" id="buscarClie">Editar Existente</button>
        <?php } else { ?>
            <button class="btn btn-primary" onclick="buscarClie(2)" id="buscarClie">Nuevo</button>
        <?php } ?>
    </div>
    <div class="col-md-5 col-sm-12 mb-3">
        <input class="form-control" type="text" name="nom_cli3" id="nom_cli3" onkeyup="auto(3);">
    </div>
    <div class="col-md-3 col-sm-12 ms-auto mb-3">
        <label class="btn btn-danger">Persona Natural
            <input type="checkbox" id="persNatural" name="persNatural" onclick="buscarClie(3)" value="1">
        </label>
    </div>
</div>
<br>
<form method="POST" id="form-cli ">
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <label for="id_cli1" class="form-label">NIT o C.C.:</label>
            <input type="number" onkeyup="verifyClie(this.value);" id="id_cli1" class="form-control" name="id_cli1" value="<?php if (isset($_POST['edit']) && $_POST['resp'] == 7) {
                                                                                                                                echo $cli->id_cli . '" readonly="';
                                                                                                                            } ?>" placeholder="Sin puntos ni guiones" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <label for="nom_cli1" class="form-label">Razón social:</label>
            <input type="text" id="nom_cli1" class="form-control" name="nom_cli1" value="<?php if (isset($_POST['edit']) && $_POST['resp'] == 7) {
                                                                                                echo $cli->nom_cli;
                                                                                            } ?>" placeholder="Nombre de la empresa" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <label for="tel_cli1" class="form-label">Teléfono: </label>
            <input type="number" class="form-control" id="tel_cli1" name="tel_cli1" value="<?php if (isset($_POST['edit']) && $_POST['resp'] == 7) {
                                                                                                echo $cli->tel_cli;
                                                                                            } ?>" placeholder="Teléfono" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <label for="dir_cli1" class="form-label">Dirección: </label>
            <input type="text" class="form-control" id="dir_cli1" name="dir_cli1" value="<?php if (isset($_POST['edit']) && $_POST['resp'] == 7) {
                                                                                                echo $cli->dir_cli;
                                                                                            } ?>" placeholder="Dirección empresa" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="ase_com1" class="form-label">Asesor Comercial </label>
            <select class="form-select" id="ase_com1" name="ase_com1" required>
                <?php if (!isset($_POST['edit'])) { ?>
                    <option value="">Seleccione el asesor</option>
                <?php } elseif ($ase != '') { ?>
                    <option value="<?php echo $rA['id_usu']; ?>"><?php echo $rA['nom_usu']; ?></option>
                <?php } else { ?>
                    <option value="">Seleccione el asesor</option>
                <?php } ?>
                <?php while ($r = $query1->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $r['id_usu']; ?>"><?php echo $r['nom_usu']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="rep_sac1" class="form-label">Rep. Servicio al cliente </label>
            <select class="form-select" id="rep_sac1" name="rep_sac1">
                <?php if (!isset($_POST['edit'])) { ?>
                    <option value="">Seleccione el representante</option>
                <?php } elseif ($rep != '') { ?>
                    <option value="<?php echo $rR['id_usu']; ?>"><?php echo $rR['nom_usu']; ?></option>
                <?php } else { ?>
                    <option value="">Seleccione el represante</option>
                <?php } ?>
                <?php while ($r = $query2->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $r['id_usu']; ?>"><?php echo $r['nom_usu']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="row" id="natura">
        <?php if (isset($_POST['resp']) && $_POST['resp'] == 7) { ?>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="eml_cli1" class="form-label">Correo</label>
                <input type="email" class="form-control" id="eml_cli1" name="eml_cli1" placeholder="Correo electrónico" value="<?php if (isset($_POST['edit']) && $_POST['resp'] == 7) {
                                                                                                                                    echo $cli->eml_cli;
                                                                                                                                } ?>" required>
                <input type="hidden" id="natura1" name="natura1" value="1">
            </div>
        <?php } ?>
    </div>
    <div id="infoCont">
        <?php if (isset($_POST['resp']) && $_POST['resp'] != 7) { ?>
            <div class="row mt-5">
                <div class="col-12 text-center mb-3">
                    <div class="col-12">
                        <h3 id="titleClie">Datos Contacto</h3>
                        <hr class="mx-auto" style="width:60%;">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12 mb-3">
                    <label for="nom_cont4" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nom_cont4" name="nom_cont4" placeholder="Nombre Contacto" required>
                </div>
                <div class="col-md-4 col-sm-12 mb-3">
                    <label for="eml_cont4" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="eml_cont4" name="eml_cont4" placeholder="Correo del contacto" required>
                </div>
                <div class="col-md-4 col-sm-12 mb-3">
                    <label for="car_cont4" class="form-label">Cargo</label>
                    <input type="text" class="form-control" id="car_cont4" name="car_cont4" placeholder="Cargo del contacto">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12 mb-3">
                    <label for="tel_cont44" class="form-label">Teléfono</label>
                    <input type="number" class="form-control" id="tel_cont44" name="tel_cont44" placeholder="Teléfono del contacto" required>
                </div>
                <div class="col-md-4 col-sm-12 mb-3">
                    <label for="tel_cont4" class="form-label">Celular</label>
                    <input type="number" class="form-control" id="tel_cont4" name="tel_cont4" placeholder="Celular del contacto">
                </div>
            </div>
        <?php } ?>
    </div>
    <input type="hidden" id="accionClie" name="action" value="<?php echo ($_POST['resp'] == 7) ? "updateClie" : "addClie"; ?>">
    <br>
    <div class="col-12" id="respuestaClie"></div>
    <div class="row" id="error2"></div>
</form>