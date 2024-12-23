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

if($_POST['resp']==1){
    $sqlRegimen = "SELECT * FROM credit_regimen";
    $queryRegimen = $conexion->query($sqlRegimen);
} else{
    $reg_clie = $sol->reg_clie;
    $sqlRegimen = "SELECT * FROM credit_regimen";
    if ($reg_clie != '') {
        $sqlRegimen .= " WHERE id_regimen = '".$reg_clie."';";
    }
    //echo $sqlRegimen;
    $queryRegimen = $conexion->query($sqlRegimen);
    while ($reg = $queryRegimen->fetch(PDO::FETCH_OBJ)) {
        $regimen = $reg;
        break;
    }

    $sqlRegimen1 = "SELECT * FROM credit_regimen";
    if ($reg_clie != '') {
        $sqlRegimen1 .= " WHERE id_regimen != ".$reg_clie.";";
    }
    $queryRegimen1 = $conexion->query($sqlRegimen1);
}


?>
<div class="row mt-5">
    <div class="col-12">
        <h3 class="text-center">Información de Contactos</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>

<h5><i class="fa-solid fa-file-invoice-dollar me-2"></i>Contabilidad<span name="req" class="text-mq">*</span></h5>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="text" class="form-control border border-danger" require placeholder="Contacto1" id="cont_cont" name="cont_cont" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                        echo $cont->con_cont;
                                                                                                    }
                                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                        echo '" readonly="';
                                                                                                    }
                                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                        echo '" readonly="';
                                                                                                    } ?>">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="email" class="form-control border border-danger" require placeholder="E-mail 1" id="ema_conta" name="ema_conta" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                        echo $cont->ema_cont;
                                                                                                    }
                                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                        echo '" readonly="';
                                                                                                    }
                                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                        echo '" readonly="';
                                                                                                    } ?>">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="text" class="form-control border border-danger" id="cont_cont1" placeholder="Contacto2"  name="cont_cont1" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                            echo $cont->con_cont2;
                                                                                                        }
                                                                                                        if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                            echo '" readonly="';
                                                                                                        }
                                                                                                        if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                            echo '" readonly="';
                                                                                                        } ?>">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="email" class="form-control border border-danger" id="ema_conta1" placeholder="E-mail 2"  name="ema_conta1" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
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


<h5><i class="fa-solid fa-tags me-2"></i>Encargado de Compras<span name="req" class="text-mq">*</span></h5>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="text" class="form-control border border-info" require id="en_com" placeholder="Contacto1" name="en_com" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $cont->enc_com;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="email" class="form-control border border-info" require id="ema_com" placeholder="E-mail 1" name="ema_com" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $cont->ema_com;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="text" class="form-control border border-info" id="en_com1" placeholder="Contacto2" name="en_com1" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $cont->enc_com2;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="email" class="form-control border border-info" id="ema_com1" placeholder="E-mail 2" name="ema_com1" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
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

<h5><i class="fa-solid fa-id-card-clip me-2" ></i>Salud Ocupacional<span name="req" class="text-mq">*</span></h5>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="text" class="form-control border border-warning" require placeholder="Contacto1" id="cont_ocu" name="cont_ocu" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                        echo $cont->con_ocu;
                                                                                                    }
                                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                        echo '" readonly="';
                                                                                                    }
                                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                        echo '" readonly="';
                                                                                                    } ?>">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="email" class="form-control border border-warning" id="ema_ocu" require placeholder="E-mail 1" name="ema_ocu" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $cont->ema_ocu;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="text" class="form-control border border-warning" placeholder="Contacto2" id="cont_ocu1" name="cont_ocu1" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                        echo $cont->con_ocu2;
                                                                                                    }
                                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                        echo '" readonly="';
                                                                                                    }
                                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                        echo '" readonly="';
                                                                                                    } ?>">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="email" class="form-control border border-warning" id="ema_ocu1" placeholder="E-mail 2" name="ema_ocu1" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
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


<h5><i class="fa-solid fa-hand-sparkles me-2"></i>Servicios Generales<span name="req" class="text-mq">*</span></h5>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="text" class="form-control border border-success" require placeholder="Contacto1" id="cont_ser" name="cont_ser" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                        echo $cont->con_gen;
                                                                                                    }
                                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                        echo '" readonly="';
                                                                                                    }
                                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                        echo '" readonly="';
                                                                                                    } ?>">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="email" class="form-control border border-success" require placeholder="E-mail 1" id="ema_ser" name="ema_ser" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $cont->ema_gen;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="text" class="form-control border border-success" id="cont_ser1" placeholder="Contacto2" name="cont_ser1" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                        echo $cont->con_gen2;
                                                                                                    }
                                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                        echo '" readonly="';
                                                                                                    }
                                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                        echo '" readonly="';
                                                                                                    } ?>">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="email" class="form-control border border-success" placeholder="E-mail 2" id="ema_ser1" name="ema_ser1" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
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

<h5><i class="fa-solid fa-credit-card me-2" ></i>Tesorería <span name="req" class="text-mq">*</span></h5>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="text" class="form-control border border-primary" require placeholder="Contacto1" id="cont_tes" name="cont_tes" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                        echo $cont->con_teso;
                                                                                                    }
                                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                        echo '" readonly="';
                                                                                                    }
                                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                        echo '" readonly="';
                                                                                                    } ?>">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="email" class="form-control border border-primary" require placeholder="E-mail 1" id="ema_tes" name="ema_tes" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $cont->ema_tes;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="text" class="form-control border border-primary" id="cont_tes1" placeholder="Contacto2" name="cont_tes1" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                        echo $cont->con_teso2;
                                                                                                    }
                                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                        echo '" readonly="';
                                                                                                    }
                                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                        echo '" readonly="';
                                                                                                    } ?>">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <input type="email" class="form-control border border-primary" id="ema_tes1" name="ema_tes1" placeholder="E-mail 2" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
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

<div class="row mt-5">
    <div class="col-12">
        <h3 class="text-center">Información general de la Solicitud</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="reple" class="form-label">Representate Legal </label>
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
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="regi" class="form-label">Régimen</label>
        <select id="regi" name="regi" class="form-select" required <?php if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                             echo 'disabled';
                                                                        }
                                                                        if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                            echo 'disabled';
                                                                        }?>>
            <?php if ($_POST['resp'] == 1) { ?>
                <option value="">Seleccione</option>
                <?php while ($rRegimen = $queryRegimen->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $rRegimen['id_regimen']; ?>"><?php echo $rRegimen['nom_regimen']; ?></option>
                <?php }
                } if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) { ?>
                <option value="<?php echo $regimen->id_regimen; ?>"><?php echo $regimen->nom_regimen; ?></option>
                <?php if ((isset($_POST['id_est']) && ($_POST['id_est'] == 7 || $_POST['id_est'] == 8))) { 
                    while ($rRegimen2 = $queryRegimen1->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rRegimen2['id_regimen']; ?>"><?php echo $rRegimen2['nom_regimen']; ?></option>
                    <?php }
                    }
                } ?>
        </select>
    </div>
</div>

<div class="row">
    <div class="col-md-4 col-sm-12 mb-3">
        <label for="fech_sol" class="form-label">Fecha de Solicitud</label>
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
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="num_empl" class="form-label">Numero de Empleados </label>
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
    <div class="col-md-3 col-sm-6 mb-3">
        <label for="tie_mer" class="form-label">Tiempo en el mercado</label>
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
    <div class="col-md-2 col-sm-6 mt-4 mb-3">
        <div class="form-check">
            <input type="radio" class="form-check-input" id="tiem" name="tiem" value="Meses" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $sol->tiem_rad == 'Meses') {
                                                                                                echo 'checked';
                                                                                            } 
                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                echo ' disabled';
                                                                                            }
                                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                echo ' disabled';
                                                                                            }?>>
            <label class="form-check-label" for="tiem">
                Meses
            </label>
        </div>
        <div class="form-check">
            <input type="radio" class="form-check-input" id="tiem1" name="tiem" value="Anios" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $sol->tiem_rad == 'Anios') {
                                                                                                        echo 'checked';
                                                                                                    } 
                                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                        echo ' disabled';
                                                                                                    }
                                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                        echo ' disabled';
                                                                                                    }?> >
            <label class="form-check-label" for="tiem1">
                Años
            </label>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="cupCreSol" class="form-label">Cupo de crédito solicitado</label>
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
    <div class="col-md-6 col-sm-12 mb-3" >
        <div class="form-check">
            <input type="radio" class="form-check-input" id="reten" name="reten" value="Gran Contribuyente" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $sol->retFuen == 'Gran Contribuyente') {
                                                                                                                    echo 'checked';
                                                                                                                } 
                                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                                    echo ' disabled';
                                                                                                                }
                                                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                                    echo ' disabled';
                                                                                                                }?>>
            <label class="form-check-label" for="reten">
                Gran contribuyente
            </label>
        </div>
        <br>
        <div class="form-check">
            <input type="radio" class="form-check-input" id="reten1" name="reten" value="Autoretenedor" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $sol->retFuen == 'Autoretenedor') {
                                                                                                                echo 'checked';
                                                                                                            } 
                                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                                echo ' disabled';
                                                                                                            }
                                                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                                echo ' disabled';
                                                                                                            }?>>
            <label class="form-check-label" for="reten1">
                Autoretenedor
            </label>
        </div>
        <br>
        <div class="form-check">
            <input type="radio" class="form-check-input" id="reten2" name="reten" value="NoAplica" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $sol->retFuen == 'NoAplica') {
                                                                                                            echo 'checked';
                                                                                                        } 
                                                                                                        if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                            echo ' disabled';
                                                                                                        }
                                                                                                        if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                            echo ' disabled';
                                                                                                        }?>>
            <label class="form-check-label" for="reten2">
                No Aplica
            </label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="ter_pag" class="form-label">Termino de Pago</label>
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
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="di_pag" class="form-label">Días en que se realizará el pago</label>
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
<div class="row mt-5">
    <div class="col-12 text-center">
        <div class="col-12">
            <h3 class="text-center">Puntos de Despacho
            <?php if (($_POST['resp'] == 1 || $_POST['resp'] == 7) && $mer->direcion_2 != '') { ?>
                <span class="btn-group-md ms-2">
                    <button id="btnMas" type="button" class="btn btn-sm btn-success" onclick="desp3();">
                        <i class="fa fa-plus" style="font-size:20px"></i>
                    </button>
                </span>
               
            <?php } else if ($_POST['resp'] == 1 || $_POST['resp'] == 7) { ?>
                <span class="btn-group-md ms-2">
                    <button id="btnMas" type="button" class="btn btn-sm btn-success" onclick="desp2();">
                        <i class="fa fa-plus" style="font-size:20px"></i>
                    </button>
                </span>
               
            <?php } ?>
            </h3>
            <hr class="mx-auto" style="width:60%;">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <p class="text-center text-mq" id="text-despacho"></p>
    </div>
</div>

<div class="row">
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="pun_u1" class="form-label">Dirección</label>
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
    <div class="col-md-2 col-sm-12 mb-3">
        <label for="ciu1" class="form-label">Ciudad</label>
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
    <div class="col-md-2 col-sm-12 mb-3">
        <label for="tel_fij1" class="form-label">Teléfono Fijo</label>
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
    <div class="col-md-2 col-sm-12 mb-3">
        <label for="hor_1" class="form-label">H. Inicial </label>
        <select id="hor_1" name="hor_1" class="form-select" <?php if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                    echo ' disabled';
                                                                  }
                                                                  if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                    echo ' disabled';
                                                                  }?> required>
            <?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) { ?>
                <option value="<?php echo $mer->horario_1; ?>"><?php echo $mer->horario_1; ?></option>
            <?php } else if ((isset($_POST['id_est']) && ($_POST['id_est'] == 7 || $_POST['id_est'] == 8))) { ?>
                <option value="">Horario</option>
                <?php for ($i = 1; $i <= 24; $i++) {
                    if (isset($mer->horario_1) && ($mer->horario_1 != $i)) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } else { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php }
                } ?>
            <?php } else { ?>
                <option value="">Horario</option>
                <?php for ($i = 1; $i <= 24; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php }
            } ?>
        </select>
    </div>
    <div class="col-md-2 col-sm-12 mb-3">
        <label for="hor1_1" class="form-label">H. Final </label>
        <select type="time" class="form-select" id="hor1_1" name="hor1_1" <?php if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                    echo ' disabled';
                                                                                }
                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                    echo ' disabled';
                                                                                }?> required>
            <?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) { ?>
                <option value="<?php echo $mer->horario1_1; ?>"><?php echo $mer->horario1_1; ?></option>
            <?php } else if ((isset($_POST['id_est']) && ($_POST['id_est'] == 7 || $_POST['id_est'] == 8))) { ?>
                <option value="">Horario</option>
                <?php for ($i = 1; $i <= 24; $i++) {
                    if (isset($mer->horario1_1) && ($mer->horario1_1 != $i)) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } else { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php }
                } ?>
            <?php } else { ?>
                <option value="">Horario</option>
                <?php for ($i = 1; $i <= 24; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php }
            } ?>
        </select>
    </div>
    <div class="col-md-1 col-sm-12 d-flex align-items-center">
        <button id="btnMen1" type="button" class="btn btn-sm btn-danger" onclick="remove(1);" style="height:40px" <?php if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                                            echo ' disabled';
                                                                                                                        }
                                                                                                                        if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                                            echo ' disabled';
                                                                                                                        }?>>
            <i class="fa-solid fa-trash" ></i>
        </button>
    </div>
</div>

<div class="row">
        <div class="col-12">
            <div class="row" id="desp2">
            <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $mer->direcion_2 != '') { ?>
                <div class="col-md-3 col-sm-12 mb-3">
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
                <div class="col-md-2 col-sm-12 mb-3">
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

                <div class="col-md-2 col-sm-12 mb-3">
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

                <div class="col-md-2 col-sm-12 mb-3">
                    <select type="time" class="form-select" id="hor_2" name="hor_2" <?php if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                    echo ' disabled';
                                                                                }
                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                    echo ' disabled';
                                                                                }?>>
                        <?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) { ?>
                            <option value="<?php echo $mer->horario_2; ?>"><?php echo $mer->horario_2; ?></option>
                        <?php } else if ((isset($_POST['id_est']) && ($_POST['id_est'] == 7 || $_POST['id_est'] == 8))) { ?>
                            <option value="">Horario</option>
                            <?php for ($i = 1; $i <= 24; $i++) {
                                if (isset($mer->horario_2) && ($mer->horario_2 != $i)) { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php }
                            } ?>
                        <?php } else { ?>
                            <option value="">Horario</option>
                            <?php for ($i = 1; $i <= 24; $i++) { ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>

                <div class="col-md-2 col-sm-12 mb-3">
                    <select type="time" class="form-select" id="hor2_2" name="hor2_2" <?php if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                    echo ' disabled';
                                                                                }
                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                    echo ' disabled';
                                                                                }?>>
                        <?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) { ?>
                            <option value="<?php echo $mer->horario2_2; ?>"><?php echo $mer->horario2_2; ?></option>
                        <?php } else if ((isset($_POST['id_est']) && ($_POST['id_est'] == 7 || $_POST['id_est'] == 8))) { ?>
                            <option value="">Horario</option>
                            <?php for ($i = 1; $i <= 24; $i++) {
                                if (isset($mer->horario2_2) && ($mer->horario2_2 != $i)) { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php }
                            } ?>
                        <?php } else { ?>
                            <option value="">Horario</option>
                            <?php for ($i = 1; $i <= 24; $i++) { ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="col-md-1 col-sm-12 d-flex mb-3" id="btnMen11">
                    <button id="btnMen2" type="button" class="btn btn-sm btn-danger" onclick="remove(2);"      <?php if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                                            echo ' disabled';
                                                                                                                        }
                                                                                                                        if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                                            echo ' disabled';
                                                                                                                        }?>>
                            <i class="fa-solid fa-trash" ></i>
                    </button>
                </div> 
                <?php 
            } ?>   
</div> 
        </div>
    </div>   
        

<div class="row mb-3" id="desp3">
    <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $mer->direcion_3 != '') { ?>
        <div class="col-md-3 col-sm-12 mb-3">
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
        <div class="col-md-2 col-sm-12 mb-3">
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
        <div class="col-md-2 col-sm-12 mb-3">
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
        <div class="col-md-2 col-sm-12 mb-3">
            <select class="form-select" id="hor_3" name="hor_3" <?php if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                    echo ' disabled';
                                                                                }
                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                    echo ' disabled';
                                                                                }?>>
                <?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) { ?>
                    <option value="<?php echo $mer->horario_3; ?>"><?php echo $mer->horario_3; ?></option>
                <?php } else if ((isset($_POST['id_est']) && ($_POST['id_est'] == 7 || $_POST['id_est'] == 8))) { ?>
                    <option value="">Horario</option>
                    <?php for ($i = 1; $i <= 24; $i++) {
                        if (isset($mer->horario_3) && ($mer->horario_3 != $i)) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php }
                    } ?>
                <?php } else { ?>
                    <option value="">Horario</option>
                    <?php for ($i = 1; $i <= 24; $i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php }
                } ?>
            </select>
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
            <select class="form-select" id="hor3_3" name="hor3_3" <?php if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                    echo ' disabled';
                                                                                }
                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                    echo ' disabled';
                                                                                }?>>
                <?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) { ?>
                    <option value="<?php echo $mer->horario3_3; ?>"><?php echo $mer->horario3_3; ?></option>
                <?php } else if ((isset($_POST['id_est']) && ($_POST['id_est'] == 7 || $_POST['id_est'] == 8))) { ?>
                    <option value="">Horario</option>
                    <?php for ($i = 1; $i <= 24; $i++) {
                        if (isset($mer->horario3_3) && ($mer->horario3_3 != $i)) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php }
                    } ?>
                <?php } else { ?>
                    <option value="">Horario</option>
                    <?php for ($i = 1; $i <= 24; $i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php }
                } ?>
            </select>
        </div>
        <div class="col-md-1 col-sm-12 d-flex mb-3" id="btnMen22">
            <button id="btnMen3" type="button" class="btn btn-sm btn-danger" onclick="remove(3);" <?php if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                                            echo ' disabled';
                                                                                                                        }
                                                                                                                        if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                                            echo ' disabled';
                                                                                                                        }?>>
                    <i class="fa-solid fa-trash" ></i>
            </button>
        </div> 
    <?php 
    
    } ?>
</div>
<div class="row mt-5">
    <div class="col-12">
        <h3 class="text-center"> Radicación de Factura </h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="direFa" class="form-label">Dirección </label>
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
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="ciu_fac" class="form-label">Ciudad</label>
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
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="telfi_fa" class="form-label">Teléfono Fijo</label>
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
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="hor_fac" class="form-label">Horario</label>
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
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">No. de Copias de factura</label>
        <br>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" id="num_copias1" name="num_copias" value="1" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $fac->num_copias == "1") {
                                                                                                                echo 'checked';
                                                                                                            } 
                                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                                echo ' disabled';
                                                                                                            }
                                                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                                echo ' disabled';
                                                                                                            }?>>
            <label class="form-check-label" for="num_copias1">
                Una
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" id="num_copias2" name="num_copias" value="2" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $fac->num_copias == "2") {
                                                                                                                echo 'checked';
                                                                                                            } 
                                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                                echo ' disabled';
                                                                                                            }
                                                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                                echo ' disabled';
                                                                                                            }?>>
            <label class="form-check-label" for="num_copias2">
                Dos
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" id="num_copias3" name="num_copias" value="3" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $fac->num_copias == "3") {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                                echo ' disabled';
                                                                                                            }
                                                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                                echo ' disabled';
                                                                                                            } ?>>
            <label class="form-check-label" for="num_copias3">
                Tres
            </label>
        </div>

    </div>
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">¿Exige Certificado de Calidad?</label>
        <br>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" id="cert_cal1" name="cert_cal" value="si" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $fac->cer_calidad == "si") {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                            echo ' disabled';
                                                                                                        }
                                                                                                        if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                            echo ' disabled';
                                                                                                        } ?>>
            <label class="form-check-label" for="cert_cal1">
                Sí
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" id="cert_cal2" name="cert_cal" value="no" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $fac->cer_calidad == "no") {
                                                                                                            echo 'checked';
                                                                                                        } 
                                                                                                        if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                            echo ' disabled';
                                                                                                        }
                                                                                                        if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                            echo ' disabled';
                                                                                                        }?>>
            <label class="form-check-label" for="cert_cal2">
                No
            </label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">¿Exige Orden de Compra?</label>
        <br>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" id="ex_comp1" name="ex_comp" value="si" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $fac->ext_comp == "si") {
                                                                                                            echo 'checked';
                                                                                                        } 
                                                                                                        if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                            echo ' disabled';
                                                                                                        }
                                                                                                        if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                            echo ' disabled';
                                                                                                        }?>>
            <label class="form-check-label" for="ex_comp1">
                Sí
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" id="ex_comp2" name="ex_comp" value="no" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $fac->ext_comp == "no") {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                            echo ' disabled';
                                                                                                        }
                                                                                                        if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                            echo ' disabled';
                                                                                                        } ?>>
            <label class="form-check-label" for="ex_comp2">
                No
            </label>
        </div>
    </div>
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">¿Exige Remisión?</label>
        <br>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" id="ex_rem1" name="ex_rem" value="si" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $fac->ext_remis == "si") {
                                                                                                        echo 'checked';
                                                                                                    } 
                                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                        echo ' disabled';
                                                                                                    }
                                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                        echo ' disabled';
                                                                                                    }?>>
            <label class="form-check-label" for="ex_rem1">
                Sí
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" id="ex_rem2" name="ex_rem" value="no" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $fac->ext_remis == "no") {
                                                                                                        echo 'checked';
                                                                                                    } 
                                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                        echo ' disabled';
                                                                                                    }
                                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                        echo ' disabled';
                                                                                                    }?>>
            <label class="form-check-label" for="ex_rem2">
                No
            </label>
        </div>
    </div>
</div>