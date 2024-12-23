 <?php

include "../../conexion.php";
if ($_POST['resp'] == 2) {
    //Editar
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
        $rT1 = $queryTipCli2->fetch(PDO::FETCH_ASSOC);

        $sqlTipCli21 = "SELECT * FROM tipo_clientes WHERE id_tipo != " . $id_tipo;
        $queryTipCli21 = $conexion->query($sqlTipCli21);
    }
    if (isset($r2['id_cat']) || $r2['id_cat'] != '') {
        $id_cat = $r2['id_cat'];

        $sqlCatCli2 = "SELECT * FROM cat_clientes WHERE id_cat = " . $id_cat;
        $queryCatCli2 = $conexion->query($sqlCatCli2);
        $rT2 = $queryCatCli2->fetch(PDO::FETCH_ASSOC);

        $sqlCatCli21 = "SELECT * FROM cat_clientes WHERE id_cat != " . $id_cat;
        $queryCatCli21 = $conexion->query($sqlCatCli21);
    }
    if (isset($r2['ase_com']) && $r2['ase_com'] != '') {
        $ase_com = $r2['ase_com'];

        $sqlAse2 = "SELECT id_usu, nom_usu FROM mq_usu WHERE id_usu = " . $ase_com;
        $queryAse2 = $conexion->query($sqlAse2);
        $rA2 = $queryAse2->fetch(PDO::FETCH_ASSOC);

        $sqlAse21 = "SELECT id_usu, nom_usu FROM mq_usu WHERE id_car IN (1,4,5,6,7,8,9,10,11,12,13,14,16,17) AND id_usu != " . $ase_com . " ORDER BY nom_usu";
        $queryAse21 = $conexion->query($sqlAse21);
    }
    if (isset($r2['rep_sac']) && $r2['rep_sac'] != '') {
        $rep_sac = $r2['rep_sac'];

        $sqlSac2 = "SELECT id_usu, nom_usu FROM mq_usu WHERE id_usu = " . $rep_sac;
        $querySac2 = $conexion->query($sqlSac2);
        $rS2 = $querySac2->fetch(PDO::FETCH_ASSOC);

        $sqlSac21 = "SELECT id_usu, nom_usu FROM mq_usu WHERE id_car IN (3,14) AND id_usu != " . $rep_sac . " ORDER BY nom_usu";
        $querySac21 = $conexion->query($sqlSac21);
    }

    if (isset($r2['id_act']) || $r2['id_act'] != '') {
        $id_act = $r2['id_act'];

        $sqlActEco = "SELECT * FROM act_economica WHERE id_act = " . $id_act;
        $queryActEco = $conexion->query($sqlActEco);
        $rActEco= $queryActEco->fetch(PDO::FETCH_ASSOC);

    }
}

$sqlCiu = "SELECT * FROM ciudades";
$queryCiu = $conexion->query($sqlCiu);

/*$sqlAse = "SELECT id_usu, nom_usu FROM mq_usu WHERE id_car IN (1,4,5,6,7,8,9,10,11,12,13,14,16,17) ORDER BY nom_usu"; */
$sqlAse = "SELECT id_usu, nom_usu FROM mq_usu WHERE id_are IN (6, 11, 12) AND usu_elim = 0 ORDER BY nom_usu";
$queryAse = $conexion->query($sqlAse);

/*$sqlSac = "SELECT id_usu, nom_usu FROM mq_usu WHERE id_car IN (3,14) AND usu_elim = 0 ORDER BY nom_usu"; */
$sqlSac = "SELECT id_usu, nom_usu FROM mq_usu WHERE id_are IN (7, 12) AND usu_elim = 0 ORDER BY nom_usu";
$querySac = $conexion->query($sqlSac);

$sqlTipCli = "SELECT * FROM tipo_clientes";
$queryTipCli = $conexion->query($sqlTipCli);

$sqlCatCli = "SELECT * FROM cat_clientes";
$queryCatCli = $conexion->query($sqlCatCli);

?>
<script>
    $(function() {
        $('[data-bs-toggle="popover"]').popover()
    })
</script>
<form role="form" id="form-cliente">
    <div class="alert alert-info" role="alert">
        <div class="d-flex">
            <span class="pt-1">
                (*) Campo requerido
            </span>
            <button type="button" class="btn btn-info ms-auto" data-bs-trigger="focus" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="left" data-bs-content="Si seleccionas el tipo de documento el formulario se adaptara al tipo.">
                <i class="fa fa-info"></i>
            </button>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-12 text-center">
            <div class="col-12">
                <h3>Datos Cliente</h3>
                <p id="info"></p>
                <hr class="mx-auto" style="width:60%;">
            </div>
        </div>
    </div>
    <?php if (isset($param) && $param == 2) { ?>
        <div class="row">
            <div class="col-sm-1 my-3">
                    <button id="editar_cli" class="btn btn-danger btn-circle" type="button" value="0" onclick="editarCli(this.value)" for="search" data-bs-toggle="collapse" data-bs-target="#collapse-search" aria-expanded="false" aria-controls="collapse-search">
                        <i class="fa-solid fa-pen-to-square" style="font-size: .8em;"></i>
                    </button>

            </div>
            <div class="col-sm-11 my-3">
                <span class="collapse" id="collapse-search">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input class="form-control" type="text" onkeyup="buscarCliente(1)" id="search" placeholder="Busca el cliente a editar">
                    </div>
                </span>
            </div>
        </div>
    <?php } ?>
    
    <div class="row">
        <input type="hidden" id="id_cli1" name="id_cli" value="<?php if ($_POST['resp'] == 2) {
                                                                    echo $r2['id_cli'];
                                                                } ?>">
        <div class="col-md-4 col-sm-12 mb-3">
            <label for="nom_cli1" class="form-label">Razón Social <span name="req" class="text-mq">*</span></label>
            <input type="text" class="form-control" id="nom_cli1" name="nom_cli" placeholder="Nombre del cliente" onkeyup="insert(this.value, 1)" required value="<?php if ($_POST['resp'] == 2) {
                                                                                                                                                                        echo $r2['nom_cli'];
                                                                                                                                                                    } else {
                                                                                                                                                                        echo '';
                                                                                                                                                                    } ?>">
        </div>
        <div class="col-md-4 col-sm-12 mb-3">
            <label for="tip_doc" class="form-label">Tipo documento <span name="req" class="text-mq">*</span></label>
            <select class="form-select" id="tip_doc" name="tip_doc" onchange="tipDoc(this.value)" required>
                <option value="NIT">NIT</option>
                <option value="C.C">C.C</option>
            </select>
        </div>
        <div class="col-md-4 col-sm-12 mb-3">
            <label for="num_doc" class="form-label"><span id="num">NIT <span name="req" class="text-mq">*</span></span></label>
            <input type="text" class="form-control" id="num_doc" name="num_doc" placeholder="XXXXXXXXX"  value="<?php if ($_POST['resp'] == 2) {
                                                                                                                                                    echo $r2['num_doc'];
                                                                                                                                                } else {
                                                                                                                                                    echo '';
                                                                                                                                                } ?>" onkeyup="verificarcli();" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-12 mb-3">
            <label for="tel_cli" class="form-label">Teléfono o celular <span name="req" class="text-mq">*</span></label>
            <input type="number" class="form-control" id="tel_cli" name="tel_cli" placeholder="Teléfono de la empresa" onkeyup="insert(this.value, 2)" value="<?php if ($_POST['resp'] == 2) {
                                                                                                                                                                    echo $r2['tel_cli'];
                                                                                                                                                                } else {
                                                                                                                                                                    echo '';
                                                                                                                                                                } ?>" required>
        </div>
        <div class="col-md-8 col-sm-12 mb-3">
            <label for="eml_cli" class="form-label">Correo de facturación <span name="req" class="text-mq">*</span></label>
            <input type="email" class="form-control" id="eml_cli" name="eml_cli" placeholder="correo@empresa.com" onkeyup="insert(this.value, 3)" value="<?php if ($_POST['resp'] == 2) {
                                                                                                                                                                echo $r2['eml_cli'];
                                                                                                                                                            } else {
                                                                                                                                                                echo '';
                                                                                                                                                            } ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <label class="form-label">Horario  </label>
            <div class="row">
                <div class="col-5 mb-3 d-flex">
                    <!--<label for="hor_cli1" class="" style="font-size:12px;">De:</label>-->
                    <input type="time" class="form-control" id="hor_cli1" name="hor_cli1" value="<?php if ($_POST['resp'] == 2) {
                                                                                                            echo $r2['hor_cli1'];
                                                                                                        } else {
                                                                                                            echo '07:00';
                                                                                                        } ?>">
                </div>
             
                <div class="col-7 d-flex align-items-baseline">
                    <label for="hor_cli2" class="" style="font-size:16px;">a:</label>
                    <input type="time" class="form-control ms-4" id="hor_cli2" name="hor_cli2" value="<?php if ($_POST['resp'] == 2) {
                                                                                                            echo $r2['hor_cli2'];
                                                                                                        } else {
                                                                                                            echo '17:00';
                                                                                                        } ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="dir_cli" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="dir_cli" name="dir_cli" value="<?php if ($_POST['resp'] == 2) {
                                                                                            echo $r2['dir_cli'];
                                                                                        } else {
                                                                                            echo '';
                                                                                        } ?>">
        </div>
        <div class="col-md-4 col-sm-12 mb-3">
            <label for="id_ciu1" class="form-label">Ciudad <span name="req" class="text-mq">*</span></label>
            <select id="id_ciu1" name="id_ciu" class="form-select" required>
                <?php if ($_POST['resp'] == 1) {
                    while ($rC = $queryCiu->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rC['id_ciu']; ?>"><?php echo $rC['nom_ciu']; ?></option>
                    <?php }
                } else if ($_POST['resp'] == 2) { ?>
                    <option value="<?php echo $rC2['id_ciu']; ?>"><?php echo $rC2['nom_ciu']; ?></option>
                    <?php while ($rC21 = $queryCiu21->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rC21['id_ciu']; ?>"><?php echo $rC21['nom_ciu']; ?></option>
                <?php }
                } ?>
            </select>
        </div>
        <div class="col-md-4 col-sm-12 mb-3">
            <label for="zip_cli" class="form-label">Código Postal</label>
            <input type="number" class="form-control" id="zip_cli" name="zip_cli" <?php if ($_POST['resp'] == 2) {
                                                                                        echo "value='" . $r2['zip_cli'] . "'";
                                                                                    } ?>>
        </div>
        <div class="col-md-4 col-sm-12 mb-3">
            <label for="web_cli" class="form-label">Web</label>
            <input type="text" class="form-control" id="web_cli" name="web_cli" value="<?php if ($_POST['resp'] == 2) {
                                                                                            echo $r2['web_cli'];
                                                                                        } else {
                                                                                            echo '';
                                                                                        } ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-12 mb-3">
            <label for="tip_cli" class="form-label">Tipo de Cliente</label>
            <select class="form-select" id="tip_cli" name="tip_cli">
                <?php if ($_POST['resp'] == 1) { ?>
                    <option value="">Seleccione</option>
                    <?php while ($rT = $queryTipCli->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rT['id_tipo']; ?>"><?php echo $rT['tipo']; ?></option>
                    <?php } ?>
                <?php } else { ?>
                    <?php if (isset($r2['id_tipo']) || $r2['id_tipo'] != '') { ?>
                        <option value="<?php echo $rT1['id_tipo']; ?>"><?php echo $rT1['tipo']; ?></option>
                        <?php while ($rT21 = $queryTipCli21->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $rT21['id_tipo']; ?>"><?php echo $rT21['tipo']; ?></option>
                        <?php } ?>
                    <?php } else { ?>
                        <option value="">Seleccione</option>
                        <?php while ($rT = $queryTipCli->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $rT['id_tipo']; ?>"><?php echo $rT['tipo']; ?></option>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-4 col-sm-12 mb-3">
            <label for="id_cat" class="form-label">Categoria de Cliente</label>
            <select class="form-select" id="id_cat" name="id_cat">
                <?php if ($_POST['resp'] == 1) { ?>
                    <option value="">Seleccione</option>
                    <?php while ($rT = $queryCatCli->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rT['id_cat']; ?>"><?php echo $rT['nom_cat']; ?></option>
                    <?php } ?>
                <?php } else { ?>
                    <?php if (isset($r2['id_cat']) || $r2['id_cat'] != '') { ?>
                        <option value="<?php echo $rT2['id_cat']; ?>"><?php echo $rT2['nom_cat']; ?></option>
                        <?php while ($rT21 = $queryCatCli21->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $rT21['id_cat']; ?>"><?php echo $rT21['nom_cat']; ?></option>
                        <?php } ?>
                    <?php } else { ?>
                        <option value="">Seleccione</option>
                        <?php while ($rT = $queryCatCli->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $rT['id_cat']; ?>"><?php echo $rT['nom_cat']; ?></option>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-4 col-sm-12 mb-3">
            <label for="act_eco" class="form-label">Actividad económica</label>
            <input type="text" class="form-control" id="act_eco" name="act_eco" onkeyup="buscarActividadEco()" value="<?php if ($_POST['resp'] == 2) { echo $rActEco['nom_act']; } ?>">
            <input type="hidden" id="id_act" name="id_act" value="<?php if ($_POST['resp'] == 2) { echo $r2['id_act']; } ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-12 mb-3" id="cargo" style="display: none">
            <label for="car_cont" class="form-label">Cargo</label>
            <input type="text" class="form-control" id="car_cont" name="car_cont" onkeyup="insert(this.value, 4)" placeholder="Cargo">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="log_cli" class="form-label me-2">Logotipo del cliente</label>
            <div class="fileUpload btn btn-danger">
                <span id="fac"><?php if (isset($_POST['resp']) && isset($r2['log_cli']) && $_POST['resp'] == 2 && $r2['log_cli'] != '') { echo "Cargar nuevo ";} else { echo "Seleccionar ";}?>Archivo</span>
                <input type="file" name="log_cli" id="log_cli" class="upload" accept="image/*">
                <div>
                    <script type="text/javascript">
                        document.getElementById('log_cli').onchange = function() {
                            console.log(this.value);
                            document.getElementById('fac').innerHTML = document.getElementById('log_cli').files[0].name;
                        }
                    </script>
                </div>
            </div>
        </div>
        <?php if (isset($_POST['resp']) && isset($r2['log_cli']) && $_POST['resp'] == 2 && $r2['log_cli'] != '') { ?>
            <div class="col-md-6 col-sm-12 mb-3" id="img_cliente">
                <label class="form-label">Logo actual:</label>
                <br>
                <img width="100" heigth="100" src="../../documentos/clientes/logos/<?php if (isset($_POST['resp']) && $_POST['resp'] == 2) {
                                                                        echo ($r2['log_cli']);
                                                                    } ?>">
            </div>
        <?php } ?>
    </div>
            
    <?php if (isset($_POST['action']) && $_POST['action'] == 'addClient') { ?>
        <br>
        <div class="alert alert-info alert-dismissible fade show mt-4 d-flex align-items-center" role="alert">
            <i class="fa-solid fa-circle-info me-3 fa-xl"></i>
            <span class="pt-1">
                Recuerde que estos campos no son obligarorio para crear un cliente para el aplicativo de <strong> Diligencias. </strong>
            </span>
        </div>
    <?php } ?>

    <div class="row mt-5">
        <div class="col-12 text-center">
            <div class="col-12">
                <h3>Encargado</h3>
                <hr class="mx-auto" style="width:60%;">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="ase_com" class="form-label">Asesor Comercial <span name="req" class="text-mq">*</span></label>
            <select class="form-select" id="ase_com" name="ase_com" required>
                <?php if ($_POST['resp'] == 1) { ?>
                    <option value="">Seleccione el asesor</option>
                    <?php while ($rA = $queryAse->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rA['id_usu']; ?>"><?php echo $rA['nom_usu']; ?></option>
                    <?php } ?>
                <?php } else { ?>
                    <?php if (isset($r2['ase_com']) && $r2['ase_com'] != '') { ?>
                        <option value="<?php echo $rA2['id_usu']; ?>"><?php echo $rA2['nom_usu']; ?></option>
                        <?php while ($rA21 = $queryAse21->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $rA21['id_usu']; ?>"><?php echo $rA21['nom_usu']; ?></option>
                        <?php } ?>
                    <?php } else { ?>
                        <option value="">Seleccione el asesor</option>
                        <?php while ($rA = $queryAse->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $rA['id_usu']; ?>"><?php echo $rA['nom_usu']; ?></option>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-6">
            <label for="rep_sac" class="form-label">Rep. Servicio al cliente</label>
            <select class="form-select" id="rep_sac" name="rep_sac">
                <?php if ($_POST['resp'] == 1) { ?>
                    <option value="">Seleccione el representante</option>
                    <?php while ($rS = $querySac->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rS['id_usu']; ?>"><?php echo $rS['nom_usu']; ?></option>
                    <?php } ?>
                <?php } else { ?>
                    <?php if (isset($r2['rep_sac']) && $r2['rep_sac'] != '') { ?>
                        <option value="<?php echo $rS2['id_usu']; ?>"><?php echo $rS2['nom_usu']; ?></option>
                        <?php while ($rS21 = $querySac21->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $rS21['id_usu']; ?>"><?php echo $rS21['nom_usu']; ?></option>
                        <?php } ?>
                    <?php } else { ?>
                        <option value="">Seleccione el representante</option>
                        <?php while ($rS = $querySac->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $rS['id_usu']; ?>"><?php echo $rS['nom_usu']; ?></option>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
    </div>
    <?php if ($_POST['resp'] == 1) { ?>
        <div id="contact-form">
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <div class="col-12">
                        <h3 id="titleCont">Datos Contacto
                            <span class="btn-group-sm">
                                <a id="addContact" class="btn btn-success" onclick="addContact(1)">
                                    <i class="fa-solid fa-plus" style="padding: 1em; color: #ffffff;"></i>
                                </a>
                            </span>
                        </h3>
                        <hr class="mx-auto" style="width:60%;">
                    </div>
                </div>
            </div>
            <?php for ($i = 0; $i < 5; $i++) { ?>
                <div class="card bg-secondary mb-1" id="cont-<?php echo $i; ?>" <?php if ($i != 0) {
                                                                                    echo "style='display: none'";
                                                                                } ?>>
                    <div class="card-body row">
                        <div class="col-md-3 col-sm-12">
                            <label for="nom_cont<?php echo $i; ?>" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nom_cont<?php echo $i; ?>" name="nom_cont<?php  echo $i; ?>" placeholder="Nombre Contacto">
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="eml_cont<?php echo $i; ?>" class="form-label">Email</label>
                            <input type="email" class="form-control" id="eml_cont<?php echo $i; ?>" name="eml_cont<?php echo $i; ?>" placeholder="Correo del contacto">
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="car_cont<?php echo $i; ?>" class="form-label">Cargo</label>
                            <input type="text" class="form-control" id="car_cont<?php echo $i; ?>" name="car_cont<?php  $i; ?>" placeholder="Cargo del contacto">
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="tel_cont<?php echo $i; ?>" class="form-label">Teléfono o celular</label>
                            <input type="number" class="form-control" id="tel_cont<?php echo $i; ?>" name="tel_cont<?php echo $i; ?>" placeholder="Teléfono del contacto">
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>

    <div class="row mt-3">
        <div class="col-12">
            <div class="alert alert-info alert-dismissible fade show" role="alert" id="alert-cliente" style="display: none;">
                <span id="alert-texto-cliente"></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>


    <input type="hidden" id="actionCli" name="actionCli" value="<?php if ($_POST['resp'] == 1) {
                                                                    echo "addCliente";
                                                                } else {
                                                                    echo "updateCliente";
                                                                } ?>">
    <?php
     if ($_POST['resp'] == 2) { ?>
        <input type="hidden" id="id_cli1" name="id_cli1" value="<?php echo $_POST['id_cli']; ?>">
    <?php } ?>

</form>
