<?php
include '../../conexion.php';
if (isset($_POST['id_sol']) && $_POST['id_sol'] != '') {
    $sqlSol = "SELECT *, DATE(fec_sol) AS fecha FROM cre_solicitud WHERE id_sol=" . $_POST['id_sol'];
    $querySol = $conexion->query($sqlSol);
    while ($r = $querySol->fetch(PDO::FETCH_OBJ)) {
        $sol = $r;
        break;
    }
    $sqlMer = "SELECT * FROM cre_env_mercancia WHERE id_sol=" . $_POST['id_sol'];
    $queryMer = $conexion->query($sqlMer);
    while ($r2 = $queryMer->fetch(PDO::FETCH_OBJ)) {
        $mer = $r2;
        break;
    }
    $sqlFac = "SELECT * FROM cre_factura WHERE id_sol=" . $_POST['id_sol'];
    $queryFac = $conexion->query($sqlFac);
    while ($r3 = $queryFac->fetch(PDO::FETCH_OBJ)) {
        $fac = $r3;
        break;
    }
    $sqlCont = "SELECT * FROM cre_contactos WHERE id_sol=" . $_POST['id_sol'];
    $queryCont = $conexion->query($sqlCont);
    while ($r4 = $queryCont->fetch(PDO::FETCH_OBJ)) {
        $cont = $r4;
        break;
    }
}
?>
<div class="row mt-3">
    <div class="col-md-12">
        <h3 class="text-center">Información de Contactos</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-sm-12">
        <label for="en_com">Encargado Compras</label>
        <input type="text" class="form-control invalid" id="en_com" name="en_com" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                echo $cont->enc_com;
                                                                                            }
                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                echo '" readonly="';
                                                                                            }
                                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                echo '" readonly="';
                                                                                            } ?>">
    </div>
    <div class="col-md-3 col-sm-12">
        <label for="ema_com">E-mail </label>
        <input type="email" class="form-control invalid" id="ema_com" name="ema_com" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                echo $cont->ema_com;
                                                                                            }
                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                echo '" readonly="';
                                                                                            }
                                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                echo '" readonly="';
                                                                                            } ?>">
    </div>
    <div class="col-md-3 col-sm-12">
        <label for="en_com1">Encargado Compras</label>
        <input type="text" class="form-control invalid" id="en_com1" name="en_com1" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                echo $cont->enc_com2;
                                                                                            }
                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                echo '" readonly="';
                                                                                            }
                                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                echo '" readonly="';
                                                                                            } ?>">
    </div>
    <div class="col-md-3 col-sm-12">
        <label for="ema_com1">E-mail</label>
        <input type="email" class="form-control invalid" id="ema_com1" name="ema_com1" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $cont->ema_com2;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>">
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-sm-12">
        <label for="cont_ocu">Salud Ocupacional</label>
        <input type="text" class="form-control invalid" id="cont_ocu" name="cont_ocu" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $cont->con_ocu;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>">
    </div>
    <div class="col-md-3 col-sm-12">
        <label for="ema_ocu">E-mail</label>
        <input type="email" class="form-control invalid" id="ema_ocu" name="ema_ocu" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                echo $cont->ema_ocu;
                                                                                            }
                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                echo '" readonly="';
                                                                                            }
                                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                echo '" readonly="';
                                                                                            } ?>">
    </div>
    <div class="col-md-3 col-sm-12">
        <label for="cont_ocu1">Salud Ocupacional</label>
        <input type="text" class="form-control invalid" id="cont_ocu1" name="cont_ocu1" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $cont->con_ocu2;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>">
    </div>
    <div class="col-md-3 col-sm-12">
        <label for="ema_ocu1">E-mail</label>
        <input type="email" class="form-control invalid" id="ema_ocu1" name="ema_ocu1" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $cont->ema_ocu2;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>">
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-sm-12">
        <label for="cont_ser">Servicios Generales</label>
        <input type="text" class="form-control invalid" id="cont_ser" name="cont_ser" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $cont->con_gen;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>">
    </div>
    <div class="col-md-3 col-sm-12">
        <label for="ema_ser">E-mail</label>
        <input type="email" class="form-control invalid" id="ema_ser" name="ema_ser" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                echo $cont->ema_gen;
                                                                                            }
                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                echo '" readonly="';
                                                                                            }
                                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                echo '" readonly="';
                                                                                            } ?>">
    </div>
    <div class="col-md-3 col-sm-12">
        <label for="cont_ser1">Servicios Generales</label>
        <input type="text" class="form-control invalid" id="cont_ser1" name="cont_ser1" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $cont->con_gen2;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>">
    </div>
    <div class="col-md-3 col-sm-12">
        <label for="ema_ser1">E-mail</label>
        <input type="email" class="form-control invalid" id="ema_ser1" name="ema_ser1" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $cont->ema_gen2;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>">
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-sm-12">
        <label for="cont_tes">Tesorería</label>
        <input type="text" class="form-control invalid" id="cont_tes" name="cont_tes" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $cont->con_teso;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>">
    </div>
    <div class="col-md-3 col-sm-12">
        <label for="ema_tes">E-mail</label>
        <input type="email" class="form-control invalid" id="ema_tes" name="ema_tes" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                echo $cont->ema_tes;
                                                                                            }
                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                echo '" readonly="';
                                                                                            }
                                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                echo '" readonly="';
                                                                                            } ?>">
    </div>
    <div class="col-md-3 col-sm-12">
        <label for="cont_tes1">Tesorería</label>
        <input type="text" class="form-control invalid" id="cont_tes1" name="cont_tes1" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $cont->con_teso2;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>">
    </div>
    <div class="col-md-3 col-sm-12">
        <label for="ema_tes1">E-mail</label>
        <input type="email" class="form-control invalid" id="ema_tes1" name="ema_tes1" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $cont->ema_tes2;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>">
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-sm-12">
        <label for="cont_cont">Contabilidad</label>
        <input type="text" class="form-control invalid" id="cont_cont" name="cont_cont" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $cont->con_cont;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>">
    </div>
    <div class="col-md-3 col-sm-12">
        <label for="ema_conta">E-mail</label>
        <input type="email" class="form-control invalid" id="ema_conta" name="ema_conta" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $cont->ema_cont;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>">
    </div>
    <div class="col-md-3 col-sm-12">
        <label for="cont_cont1">Contabilidad</label>
        <input type="text" class="form-control invalid" id="cont_cont1" name="cont_cont1" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                        echo $cont->con_cont2;
                                                                                                    }
                                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                        echo '" readonly="';
                                                                                                    }
                                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                        echo '" readonly="';
                                                                                                    } ?>">
    </div>
    <div class="col-md-3 col-sm-12">
        <label for="ema_conta1">E-mail</label>
        <input type="email" class="form-control invalid" id="ema_conta1" name="ema_conta1" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                        echo $cont->ema_cont2;
                                                                                                    }
                                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                        echo '" readonly="';
                                                                                                    }
                                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                        echo '" readonly="';
                                                                                                    } ?>">
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-12">
        <h3 class="text-center">Información general de la Solicitud</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <label for="reple">Representate Legal </label>
        <input type="text" class="form-control" id="reple" name="reple" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                    echo $sol->nom_rep;
                                                                                }
                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                    echo '" readonly="';
                                                                                }
                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                    echo '" readonly="';
                                                                                } ?>" required>
    </div>
    <div class="col-md-6 col-sm-12">
        <label for="regi">Régimen</label>
        <select id="regi" name="regi" class="form-control" required>
            <!-- Select-->
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <label for="fech_sol">Fecha de Solicitud</label>
        <input type="date" class="form-control" id="fech_sol" name="fech_sol" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                            echo $sol->fecha;
                                                                                        }
                                                                                        if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                            echo '" readonly="';
                                                                                        }
                                                                                        if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                            echo '" readonly="';
                                                                                        } ?>" required>
    </div>
    <div class="col-md-6 col-sm-12">
        <label for="ac_eco">Actividad Económica</label>
        <input type="text" class="form-control" id="ac_eco" name="ac_eco" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                        echo $sol->act_eco;
                                                                                    }
                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                        echo '" readonly="';
                                                                                    }
                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1 && $_SESSION['rol'] == 100)) {
                                                                                        echo '" readonly="';
                                                                                    } ?>">
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-sm-6">
        <label for="tie_mer">Tiempo en el mercado</label>
        <input type="number" class="form-control" id="tie_mer" name="tie_mer" min="0" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $sol->tiem_merc;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>">
    </div>
    <div class="col-md-3 col-sm-6">
        <label class="btn btn-default">
            <input type="radio" id="tiem" name="tiem" value="Anios" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $sol->tiem_rad == 'Anios') {
                                                                        echo 'checked';
                                                                    } ?>>
            Años
        </label>
        <br>
        <label class="btn btn-default">
            <input type="radio" id="tiem" name="tiem" value="Meses" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $sol->tiem_rad == 'Meses') {
                                                                        echo 'checked';
                                                                    } ?>>
            Meses
        </label>
    </div>
    <div class="col-md-6 col-sm-12">
        <label for="num_empl">Numero de Empleados </label>
        <input type="number" class="form-control" id="num_empl" name="num_empl" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                            echo $sol->num_emple;
                                                                                        }
                                                                                        if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                            echo '" readonly="';
                                                                                        }
                                                                                        if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                            echo '" readonly="';
                                                                                        } ?>" required>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <label for="cupCreSol">Cupo de crédito solicitado</label>
        <input type="number" class="form-control" id="cupCreSol" placeholder="$" name="cupCreSol" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                                echo $sol->cupo_sol;
                                                                                                            }
                                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                                echo '" readonly="';
                                                                                                            }
                                                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                                echo '" readonly="';
                                                                                                            } ?>" required>
    </div>
    <div class="col-md-6 col-sm-12" style="margin-top: 15;">
        <label class="btn btn-default">
            <input type="radio" id="reten" name="reten" value="Gran Contribuyente" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $sol->retFuen == 'Gran Contribuyente') {
                                                                                        echo 'checked';
                                                                                    } ?>>
            Gran contribuyente
        </label>
        <br>
        <label class="btn btn-default">
            <input type="radio" id="reten" name="reten" value="Autoretenedor" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $sol->retFuen == 'Autoretenedor') {
                                                                                    echo 'checked';
                                                                                } ?>>
            Autoretenedor
        </label>
        <br>
        <label class="btn btn-default">
            <input type="radio" id="reten" name="reten" value="NoAplica" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $sol->retFuen == 'NoAplica') {
                                                                                echo 'checked';
                                                                            } ?>>
            No Aplica
        </label>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <label for="ter_pag">Termino de Pago</label>
        <input type="text" class="form-control" id="ter_pag" name="ter_pag" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                        echo $sol->term_pag;
                                                                                    }
                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                        echo '" readonly="';
                                                                                    }
                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1 && $_SESSION['rol'] == 100)) {
                                                                                        echo '" readonly="';
                                                                                    } ?>">
    </div>
    <div class="col-md-6 col-sm-12">
        <label for="di_pag">Días en que se realizará el pago</label>
        <input type="text" class="form-control" id="di_pag" name="di_pag" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                        echo $sol->dia_pag;
                                                                                    }
                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                        echo '" readonly="';
                                                                                    }
                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||   $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1 && $_SESSION['rol'] == 100)) {
                                                                                        echo '" readonly="';
                                                                                    } ?>">
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-12">
        <h3 class="text-center">Puntos de Despacho</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<div class="row">
    <?php if ($_POST['resp'] == 1 || $_POST['resp'] == 7) { ?>
        <div class="col-md-1 col-sm-12">
            <button id="btnMas" type="button" class="btn btn-sm btn-success" onclick="desp2();">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    <?php } ?>
</div>
<div class="row">
    <div class="col-md-3 col-sm-12">
        <label for="pun_u">Dirección</label>
        <input type="text" class="form-control" id="pun_u1" name="pun_u1" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                        echo $mer->direcion_1;
                                                                                    }
                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                        echo '" readonly="';
                                                                                    }
                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                        echo '" readonly="';
                                                                                    } ?>" required>
    </div>
    <div class="col-md-3 col-sm-12">
        <label for="ciu">Ciudad</label>
        <input type="text" class="form-control" id="ciu1" name="ciu1" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                    echo $mer->ciudad_1;
                                                                                }
                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                    echo '" readonly="';
                                                                                }
                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                    echo '" readonly="';
                                                                                } ?>" required>
    </div>
    <div class="col-md-2 col-sm-12">
        <label for="tel_fij">Teléfono Fijo</label>
        <input type="number" class="form-control" id="tel_fij1" name="tel_fij1" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                            echo $mer->telefono_1;
                                                                                        }
                                                                                        if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                            echo '" readonly="';
                                                                                        }
                                                                                        if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                            echo '" readonly="';
                                                                                        } ?>" required>
    </div>
    <div class="col-md-2 col-sm-12">
        <label for="hor_1">H. Inicial </label>
        <input type="time" class="form-control" id="hora_ini1" name="hora_ini1" value="<?php if (isset($_POST['edit'])) {
                                                                                                        echo $rPerm['fech_ini'];
                                                                                                    } else {
                                                                                                        echo "07:00:00";
                                                                                                    } ?>" required>
    </div>
    <div class="col-md-2 col-sm-12">
        <label for="hor1_1">H. Final </label>
        <input type="time" class="form-control" id="hora_fin1" name="hora_fin1" value="<?php if (isset($_POST['edit'])) {
                                                                                                        echo $rPerm['fech_fin'];
                                                                                                    } else {
                                                                                                        echo "17:00:00";
                                                                                                    } ?>" required>
    </div>
</div>
<div class="row" id="btnMen11">
    <?php if ($_POST['resp'] == 1 || $_POST['resp'] == 7) {
        if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $mer->direcion_2 != '') { ?>
            <div class="col-md-1 col-sm-12">
                <button id="btnMen1" type="button" class="btn btn-sm btn-danger" onclick="remove(1);">
                    <i class="fa fa-remove"></i>
                </button>
            </div>
    <?php }
    } ?>
</div>
<div class="row" id="desp2">
    <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $mer->direcion_2 != '') { ?>
        <div class="col-md-3 col-sm-12">
            <label for="pun_u">Puntos</label>
            <input type="text" class="form-control" id="pun_u2" name="pun_u2" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                            echo $mer->direcion_2;
                                                                                        }
                                                                                        if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                            echo '" readonly="';
                                                                                        }
                                                                                        if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                            echo '" readonly="';
                                                                                        } ?>">
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="ciu">Ciudad</label>
            <input type="text" class="form-control" id="ciu2" name="ciu2" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                        echo $mer->ciudad_2;
                                                                                    }
                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                        echo '" readonly="';
                                                                                    }
                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                        echo '" readonly="';
                                                                                    } ?>">
        </div>

        <div class="col-md-2 col-sm-12">
            <label for="tel_fij">Teléfono Fijo</label>
            <input type="number" class="form-control" id="tel_fij2" name="tel_fij2" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                echo $mer->telefono_2;
                                                                                            }
                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                echo '" readonly="';
                                                                                            }
                                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                echo '" readonly="';
                                                                                            } ?>">
        </div>
        <div class="col-md-2 col-sm-12">
            <label for="hor_2">Horario Inicial </label>
            <select type="time" class="form-control" id="hor_2" name="hor_2">
                <?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) { ?>
                    <option value="<?php $mer->horario_2; ?>"><?php $mer->horario_2; ?></option>
                <?php } else if ((isset($_POST['id_est']) && ($_POST['id_est'] == 7 || $_POST['id_est'] == 8))) { ?>
                    <option value="">Horario</option>
                    <?php for ($i = 1; $i <= 24; $i++) {
                        if (isset($mer->horario_2) && ($mer->horario_2 != $i)) { ?>
                            <option value="<?php $i ?>"><?php $i ?></option>
                        <?php } else { ?>
                            <option value="<?php $i ?>"><?php $i ?></option>
                    <?php }
                    } ?>
                <?php } else { ?>
                    <option value="">Horario</option>
                    <?php for ($i = 1; $i <= 24; $i++) { ?>
                        <option value="<?php $i ?>"><?php $i ?></option>
                <?php }
                } ?>
            </select>
        </div>
        <div class="col-md-2 col-sm-12">
            <label for="hor2_2">Horario Final </label>
            <select type="time" class="form-control" id="hor2_2" name="hor2_2">
                <?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) { ?>
                    <option value="<?php $mer->horario2_2; ?>"><?php $mer->horario2_2; ?></option>
                <?php } else if ((isset($_POST['id_est']) && ($_POST['id_est'] == 7 || $_POST['id_est'] == 8))) { ?>
                    <option value="">Horario</option>
                    <?php for ($i = 1; $i <= 24; $i++) {
                        if (isset($mer->horario2_2) && ($mer->horario2_2 != $i)) { ?>
                            <option value="<?php $i ?>"><?php $i ?></option>
                        <?php } else { ?>
                            <option value="<?php $i ?>"><?php $i ?></option>
                    <?php }
                    } ?>
                <?php } else { ?>
                    <option value="">Horario</option>
                    <?php for ($i = 1; $i <= 24; $i++) { ?>
                        <option value="<?php $i ?>"><?php $i ?></option>
                <?php }
                } ?>
            </select>
        </div>
    <?php } ?>
</div>
<div class="row" id="btnMen22">
    <?php if ($_POST['resp'] == 1 || $_POST['resp'] == 7) {
        if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $mer->direcion_3 != '') { ?>
            <div class="col-md-1 col-sm-12">
                <button id="btnMen1" type="button" class="btn btn-sm btn-danger" onclick="remove(2);">
                    <i class="fa fa-remove"></i>
                </button>
            </div>
    <?php }
    } ?>
</div>
<div class="row" id="desp3">
    <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $mer->direcion_3 != '') { ?>
        <div class="col-md-3 col-sm-12">
            <label for="pun_u">Puntos</label>
            <input type="text" class="form-control" id="pun_u3" name="pun_u3" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                            echo $mer->direcion_3;
                                                                                        }
                                                                                        if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                            echo '" readonly="';
                                                                                        }
                                                                                        if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                            echo '" readonly="';
                                                                                        } ?>">
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="ciu">Ciudad</label>
            <input type="text" class="form-control" id="ciu3" name="ciu3" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                        echo $mer->ciudad_3;
                                                                                    }
                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                        echo '" readonly="';
                                                                                    }
                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                        echo '" readonly="';
                                                                                    } ?>">
        </div>
        <div class="col-md-2 col-sm-12">
            <label for="tel_fij">Teléfono Fijo</label>
            <input type="number" class="form-control" id="tel_fij3" name="tel_fij3" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                echo $mer->telefono_3;
                                                                                            }
                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                echo '" readonly="';
                                                                                            }
                                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                echo '" readonly="';
                                                                                            } ?>">
        </div>
        <div class="col-md-2 col-sm-12">
            <label for="hor_3">Horario Inicial</label>
            <select class="form-control" id="hor_3" name="hor_3">
                <?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) { ?>
                    <option value="<?php $mer->horario_3; ?>"><?php $mer->horario_3; ?></option>
                <?php } else if ((isset($_POST['id_est']) && ($_POST['id_est'] == 7 || $_POST['id_est'] == 8))) { ?>
                    <option value="">Horario</option>
                    <?php for ($i = 1; $i <= 24; $i++) {
                        if (isset($mer->horario_3) && ($mer->horario_3 != $i)) { ?>
                            <option value="<?php $i ?>"><?php $i ?></option>
                        <?php } else { ?>
                            <option value="<?php $i ?>"><?php $i ?></option>
                    <?php }
                    } ?>
                <?php } else { ?>
                    <option value="">Horario</option>
                    <?php for ($i = 1; $i <= 24; $i++) { ?>
                        <option value="<?php $i ?>"><?php $i ?></option>
                <?php }
                } ?>
            </select>
        </div>
        <div class="col-md-2 col-sm-12">
            <label for="hor3_3">Horario Final </label>
            <select class="form-control" id="hor3_3" name="hor3_3">
                <?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) { ?>
                    <option value="<?php $mer->horario3_3; ?>"><?php $mer->horario3_3; ?></option>
                <?php } else if ((isset($_POST['id_est']) && ($_POST['id_est'] == 7 || $_POST['id_est'] == 8))) { ?>
                    <option value="">Horario</option>
                    <?php for ($i = 1; $i <= 24; $i++) {
                        if (isset($mer->horario3_3) && ($mer->horario3_3 != $i)) { ?>
                            <option value="<?php $i ?>"><?php $i ?></option>
                        <?php } else { ?>
                            <option value="<?php $i ?>"><?php $i ?></option>
                    <?php }
                    } ?>
                <?php } else { ?>
                    <option value="">Horario</option>
                    <?php for ($i = 1; $i <= 24; $i++) { ?>
                        <option value="<?php $i ?>"><?php $i ?></option>
                <?php }
                } ?>
            </select>
        </div>
    <?php } ?>
</div>
<div class="row mt-3">
    <div class="col-md-12">
        <h3 class="text-center"> Radicación de Factura </h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <label for="direFa">Dirección </label>
        <input type="text" class="form-control" id="direFa" name="direFa" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                        echo $fac->direccion;
                                                                                    }
                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                        echo '" readonly="';
                                                                                    }
                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                        echo '" readonly="';
                                                                                    } ?>" required>
    </div>
    <div class="col-md-6 col-sm-12">
        <label for="ciu_fac">Ciudad</label>
        <input type="text" class="form-control" id="ciu_fac" name="ciu_fac" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                        echo $fac->ciudad;
                                                                                    }
                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                        echo '" readonly="';
                                                                                    }
                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                        echo '" readonly="';
                                                                                    } ?>" required>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <label for="telfi_fa">Teléfono Fijo</label>
        <input type="number" class="form-control" id="telfi_fa" name="telfi_fa" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                            echo $fac->telfono_fac;
                                                                                        }
                                                                                        if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                            echo '" readonly="';
                                                                                        }
                                                                                        if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                            echo '" readonly="';
                                                                                        } ?>" required>
    </div>
    <div class="col-md-6 col-sm-12">
        <label for="hor_fac">Horario</label>
        <input type="text" class="form-control" id="hor_fac" name="hor_fac" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                        echo $fac->hor_fac;
                                                                                    }
                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                        echo '" readonly="';
                                                                                    }
                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                        echo '" readonly="';
                                                                                    } ?>" required>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        No. de Copias de factura
        <br>
        <label class="btn btn-default"><input type="radio" name="num_copias" value="1" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $fac->num_copias == "1") {
                                                                                            echo 'checked';
                                                                                        } ?>>Una</label>
        <label class="btn btn-default"><input type="radio" name="num_copias" value="2" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $fac->num_copias == "2") {
                                                                                            echo 'checked';
                                                                                        } ?>>Dos</label>
        <label class="btn btn-default"><input type="radio" name="num_copias" value="3" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $fac->num_copias == "3") {
                                                                                            echo 'checked';
                                                                                        } ?>>Tres</label>
    </div>
    <div class="col-md-6 col-sm-12">
        ¿Exige Certificado de Calidad?
        <br>
        <label class="btn btn-default"><input type="radio" name="cert_cal" value="si" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $fac->cer_calidad == "si") {
                                                                                            echo 'checked';
                                                                                        } ?>>Sí</label>
        <label class="btn btn-default"><input type="radio" name="cert_cal" value="no" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $fac->cer_calidad == "no") {
                                                                                            echo 'checked';
                                                                                        } ?>>No</label>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        ¿Exige Orden de Compra?
        <br>
        <label class="btn btn-default"><input type="radio" name="ex_comp" value="si" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $fac->ext_comp == "si") {
                                                                                            echo 'checked';
                                                                                        } ?>>Sí</label>
        <label class="btn btn-default"><input type="radio" name="ex_comp" value="no" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $fac->ext_comp == "no") {
                                                                                            echo 'checked';
                                                                                        } ?>>No</label>
    </div>
    <div class="col-md-6 col-sm-12">
        ¿Exige Remisión?
        <br>
        <label class="btn btn-default"><input type="radio" name="ex_rem" value="si" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $fac->ext_remis == "si") {
                                                                                        echo 'checked';
                                                                                    } ?>>Sí</label>
        <label class="btn btn-default"><input type="radio" name="ex_rem" value="no" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $fac->ext_remis == "no") {
                                                                                        echo 'checked';
                                                                                    } ?>>No</label>
    </div>
</div>