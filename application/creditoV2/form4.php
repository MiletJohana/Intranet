<?php
include '../../conexion.php';
if (isset($_POST['id_sol']) && $_POST['id_sol'] != '') {
    $sqlEva = "SELECT *,DATE(fech_ini) AS fecha_ini,DATE(fech_fin) AS fecha_fin FROM cre_eva_clie where id_sol='" . $_POST['id_sol'] . "'";
    $queryEva = $conexion->query($sqlEva);
    while ($r = $queryEva->fetch(PDO::FETCH_OBJ)) {
        $eva = $r;
        break;
    }
}
?>
<form role="form" id="form-finan">
<input type="hidden" name="id_sol" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                echo $_POST['id_sol'];
                                            } ?>">
<div class="row">
    <div class="col-md-12 text-center">
        <h3>Evaluación del cliente</h3>
        <h5>Verificación de datos</h5>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<div class="row">
    <div class="col-md-3 text-center">
        <div class="alert alert-danger">
            <b>Camara De Comercio</b>
            <br>
            <a href="../../documentos/credito/<?php echo $sol->doc_consGer; ?>" target="_blank">
                <img src="../../resources/img/imagenpdf.png" style="width:45px;">
            </a>
        </div>
    </div>
    <div class="col-md-3 text-center">
        <div class="alert alert-danger">
            <b>Rut</b>
            <br>
            <a href="../../documentos/credito/<?php echo $sol->doc_rut; ?>" target="_blank">
                <img src="../../resources/img/imagenpdf.png" style="width:45px;">
            </a>
        </div>
    </div>
    <div class="col-md-3 text-center">
        <div class="alert alert-danger">
            <b>Estados Financieros</b>
            <br>
            <a href="../../documentos/credito/<?php echo $sol->doc_estFin; ?>" target="_blank">
                <img src="../../resources/img/imagenpdf.png" style="width:45px;">
            </a>
        </div>
    </div>
    <div class="col-md-3 text-center">
        <div class="alert alert-danger">
            <b>Referencias Comerciales</b>
            <br>
            <a href="../../documentos/credito/<?php echo $sol->doc_refCom; ?>" target="_blank">
                <img src="../../resources/img/imagenpdf.png" style="width:45px;">
            </a>
            <a href="../../documentos/credito/<?php echo $sol->doc_refcom2; ?>" target="_blank">
                <img src="../../resources/img/imagenpdf.png" style="width:45px;">
            </a>
        </div>
    </div>
</div>
<div class="row text-center">
    <div class="col-md-3 text-center">
        <div class="alert alert-danger">
            <b>Referencia Bancaria</b>
            <br>
            <a href="../../documentos/credito/<?php echo $sol->doc_refBanc; ?>" target="blank">
                <img src="../../resources/img/imagenpdf.png" style="width:45px;">
            </a>
        </div>
    </div>
    <div class="col-md-3 text-center">
        <div class="alert alert-danger">
            <b>Autorización de datos personales</b>
            <br>
            <a href="../../documentos/credito/<?php echo $sol->doc_form; ?>" target="_blank">
                <img src="../../resources/img/imagenpdf.png" style="width:45px;">
            </a>
        </div>
    </div>
</div>
<hr class="mx-auto" style="width:60%;">
<div class="row">
    <div class="col-md-6">
        <label for="ref_ban">Referencias Bancarias</label>
        <input type="text" class="form-control" id="ref-ban" name="ref_ban" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                        echo $eva->ref_bancu;
                                                                                    }
                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 8 || $_POST['id_est'] != 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                        echo '" readonly="';
                                                                                    }
                                                                                    if (isset($_POST['id_est']) && $_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 7 || $_POST['id_est'] == 4  && $_SESSION['rol'] == 200) {
                                                                                        echo '" readonly="';
                                                                                    } ?>">
    </div>
    <div class="col-md-6">
        <label for="ref_com">Referencias Comerciales</label>
        <input type="text" class="form-control" id="ref_com" name="ref_com" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                        echo $eva->ref_comeru;
                                                                                    }
                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 8 || $_POST['id_est'] != 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                        echo '" readonly="';
                                                                                    }
                                                                                    if (isset($_POST['id_est']) && $_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 7 || $_POST['id_est'] == 4  && $_SESSION['rol'] == 200) {
                                                                                        echo '" readonly="';
                                                                                    } ?>">
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="super_soc">Superintendencia De Sociedades</label>
        <input type="text" class="form-control" id="super_soc" name="super_soc" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                            echo $eva->super_socie;
                                                                                        }
                                                                                        if ((isset($_POST['id_est']) && ($_POST['id_est'] != 8 || $_POST['id_est'] != 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                            echo '" readonly="';
                                                                                        }
                                                                                        if (isset($_POST['id_est']) && $_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 7 || $_POST['id_est'] == 4  && $_SESSION['rol'] == 200) {
                                                                                            echo '" readonly="';
                                                                                        } ?>">
    </div>
    <div class="col-md-6">
        <input type="ref_ban2" class="form-control" id="ref_ban2" name="ref_ban2" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                echo $eva->ref_bancd;
                                                                                            }
                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 8 || $_POST['id_est'] != 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                                echo '" readonly="';
                                                                                            }
                                                                                            if (isset($_POST['id_est']) && $_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 7 || $_POST['id_est'] == 4  && $_SESSION['rol'] == 200) {
                                                                                                echo '" readonly="';
                                                                                            } ?>" style="margin-top: 27px">
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <input type="ref_com2" class="form-control" id="ref_com2" name="ref_com2" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                echo $eva->ref_comerd;
                                                                                            }
                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 8 || $_POST['id_est'] != 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                                echo '" readonly="';
                                                                                            }
                                                                                            if (isset($_POST['id_est']) && $_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 7 || $_POST['id_est'] == 4  && $_SESSION['rol'] == 200) {
                                                                                                echo '" readonly="';
                                                                                            } ?>" style="margin-top: 27px">
    </div>
    <div class="col-md-6">
        <label for="reg_emp">Registro Único Empresarial R.U.E </label>
        <input type="text" class="form-control" id="reg_emp" name="reg_emp" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                        echo $eva->reg_emp;
                                                                                    }
                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 8 || $_POST['id_est'] != 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                        echo '" readonly="';
                                                                                    }
                                                                                    if (isset($_POST['id_est']) && $_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 7 || $_POST['id_est'] == 4 && $_SESSION['rol'] == 200) {
                                                                                        echo '" readonly="';
                                                                                    } ?>">
    </div>
</div>
<div class="col-md-12 mt-3 text-center">
    <h4>Indices sobre estados financieros (Miles de pesos)</h4>
    <hr class="mx-auto" style="width:60%;">
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card bg-light">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <h4>A cierre de:</h4>
                    </div>
                    <div class="col-md-6">
                        <input type="date" class="form-control" id="ini_cier" name="ini_cier" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                            echo $eva->fecha_ini;
                                                                                                        }
                                                                                                        if ((isset($_POST['id_est']) && ($_POST['id_est'] != 8 || $_POST['id_est'] != 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                                            echo '" readonly="';
                                                                                                        }
                                                                                                        if (isset($_POST['id_est']) && $_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 7 || $_POST['id_est'] == 4  && $_SESSION['rol'] == 200) {
                                                                                                            echo '" readonly="';
                                                                                                        } ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="ac_cor">Activo Corriente</label>
                        <input type="number" class="form-control" id="ac_cor" name="ac_cor" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                        echo $eva->act_in;
                                                                                                    }
                                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 8 || $_POST['id_est'] != 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                                        echo '" readonly="';
                                                                                                    }
                                                                                                    if (isset($_POST['id_est']) && $_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 7 || $_POST['id_est'] == 4  && $_SESSION['rol'] == 200) {
                                                                                                        echo '" readonly="';
                                                                                                    } ?>" onkeyup="calcular()">
                    </div>
                    <div class="col-md-6">
                        <label for="pas_cor">Pasivo Corriente</label>
                        <input type="number" class="form-control" id="pas_cor" name="pas_cor" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                            echo $eva->pas_ini;
                                                                                                        }
                                                                                                        if ((isset($_POST['id_est']) && ($_POST['id_est'] != 8 || $_POST['id_est'] != 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                                            echo '" readonly="';
                                                                                                        }
                                                                                                        if (isset($_POST['id_est']) && $_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 7 || $_POST['id_est'] == 4  && $_SESSION['rol'] == 200) {
                                                                                                            echo '" readonly="';
                                                                                                        } ?>" onkeyup="calcular()">
                    </div>
                    <div class="col-md-6">
                        <label for="activ">Activo </label>
                        <input type="number" class="form-control" id="activ" name="activ" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                        echo $eva->activ_in;
                                                                                                    }
                                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 8 || $_POST['id_est'] != 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                                        echo '" readonly="';
                                                                                                    }
                                                                                                    if (isset($_POST['id_est']) && $_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 7 || $_POST['id_est'] == 4  && $_SESSION['rol'] == 200) {
                                                                                                        echo '" readonly="';
                                                                                                    } ?>" onkeyup="calcular()">
                    </div>
                    <div class="col-md-6">
                        <label for="pasi">Pasivo</label>
                        <input type="number" class="form-control" id="pasi" name="pasi" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $eva->pasiv_in;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 8 || $_POST['id_est'] != 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && $_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 7 || $_POST['id_est'] == 4  && $_SESSION['rol'] == 200) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>" onkeyup="calcular()">
                    </div>
                    <div class="col-md-12">
                        <label for="inv">Inventario </label>
                        <input type="number" class="form-control" id="inv" name="inv" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $eva->inv_ini;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 8 || $_POST['id_est'] != 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && $_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 7 || $_POST['id_est'] == 4  && $_SESSION['rol'] == 200) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>" onkeyup="calcular()">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-blue">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <h4>A cierre de:</h4>
                    </div>
                    <div class="col-md-6">
                        <input type="date" class="form-control" id="fin_cier" name="fin_cier" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                            echo $eva->fecha_fin;
                                                                                                        }
                                                                                                        if ((isset($_POST['id_est']) && ($_POST['id_est'] != 8 || $_POST['id_est'] != 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                                            echo '" readonly="';
                                                                                                        }
                                                                                                        if (isset($_POST['id_est']) && $_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 7 || $_POST['id_est'] == 4  && $_SESSION['rol'] == 200) {
                                                                                                            echo '" readonly="';
                                                                                                        } ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="ac_cor1">Activo Corriente</label>
                        <input type="number" class="form-control" id="ac_cor1" name="ac_cor1" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                            echo $eva->act_fin;
                                                                                                        }
                                                                                                        if ((isset($_POST['id_est']) && ($_POST['id_est'] != 8 || $_POST['id_est'] != 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                                            echo '" readonly="';
                                                                                                        }
                                                                                                        if (isset($_POST['id_est']) && $_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 7 || $_POST['id_est'] == 4  && $_SESSION['rol'] == 200) {
                                                                                                            echo '" readonly="';
                                                                                                        } ?>" onkeyup="calcular()">
                    </div>
                    <div class="col-md-6">
                        <label for="pas_cor1">Pasivo Corriente</label>
                        <input type="number" class="form-control" id="pas_cor1" name="pas_cor1" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                            echo $eva->pas_fin;
                                                                                                        }
                                                                                                        if ((isset($_POST['id_est']) && ($_POST['id_est'] != 8 || $_POST['id_est'] != 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                                            echo '" readonly="';
                                                                                                        }
                                                                                                        if (isset($_POST['id_est']) && $_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 7 || $_POST['id_est'] == 4  && $_SESSION['rol'] == 200) {
                                                                                                            echo '" readonly="';
                                                                                                        } ?>" onkeyup="calcular()">
                    </div>
                    <div class="col-md-6">
                        <label for="activ1">Activo </label>
                        <input type="number" class="form-control" id="activ1" name="activ1" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                        echo $eva->activ_fin;
                                                                                                    }
                                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 8 || $_POST['id_est'] != 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                                        echo '" readonly="';
                                                                                                    }
                                                                                                    if (isset($_POST['id_est']) && $_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 7 || $_POST['id_est'] == 4  && $_SESSION['rol'] == 200) {
                                                                                                        echo '" readonly="';
                                                                                                    } ?>" onkeyup="calcular()">
                    </div>
                    <div class="col-md-6">
                        <label for="pasi1">Pasivo </label>
                        <input type="number" class="form-control" id="pasi1" name="pasi1" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                        echo $eva->pasiv_fin;
                                                                                                    }
                                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 8 || $_POST['id_est'] != 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                                        echo '" readonly="';
                                                                                                    }
                                                                                                    if (isset($_POST['id_est']) && $_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 7 || $_POST['id_est'] == 4  && $_SESSION['rol'] == 200) {
                                                                                                        echo '" readonly="';
                                                                                                    } ?>" onkeyup="calcular()">
                    </div>
                    <div class="col-md-12">
                        <label for="inv1">Inventario</label>
                        <input type="number" class="form-control" id="inv1" name="inv1" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $eva->inv_fin;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 8 || $_POST['id_est'] != 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && $_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 7 || $_POST['id_est'] == 4  && $_SESSION['rol'] == 200) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>" onkeyup="calcular()">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12 mb-2">
        <div class="card bg-light">
            <div class="card-body">
                <label for="ing">Capital Pagado </label>
                <input type="number" class="form-control" id="cap_pa" name="cap_pa" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                echo $eva->capi_pag;
                                                                                            }
                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 8 || $_POST['id_est'] != 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                                echo '" readonly="';
                                                                                            }
                                                                                            if (isset($_POST['id_est']) && $_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 7 || $_POST['id_est'] == 4 && $_SESSION['rol'] == 200) {
                                                                                                echo '" readonly="';
                                                                                            } ?>">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card  bg-light">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="ing">Ingresos Operacionales</label>
                        <input type="number" class="form-control" id="ing" name="ing" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $eva->ingop_in;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 8 || $_POST['id_est'] != 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && $_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 7 || $_POST['id_est'] == 4  && $_SESSION['rol'] == 200) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>" onkeyup="calcular()">
                    </div>
                    <div class="col-md-6">
                        <label for="util">Utilidad Operacional </label>
                        <input type="number" class="form-control" id="util" name="util" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $eva->utope_in;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 8 || $_POST['id_est'] != 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && $_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 7 || $_POST['id_est'] == 4  && $_SESSION['rol'] == 200) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>" onkeyup="calcular()">
                    </div>
                    <div class="col-md-6">
                        <label for="porcent_ing"> % Sobre los Ingresos </label>
                        <input type="number" class="form-control" id="porcent_ing" name="porcent_ing" value="" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="util_an">Utilidad Antes De Impuestos </label>
                        <input type="number" class="form-control" id="util_an" name="util_an" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                            echo $eva->utdesim_in;
                                                                                                        }
                                                                                                        if ((isset($_POST['id_est']) && ($_POST['id_est'] != 8 || $_POST['id_est'] != 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                                            echo '" readonly="';
                                                                                                        }
                                                                                                        if (isset($_POST['id_est']) && $_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 7 || $_POST['id_est'] == 4  && $_SESSION['rol'] == 200) {
                                                                                                            echo '" readonly="';
                                                                                                        } ?>" onkeyup="calcular()">
                    </div>
                    <div class="col-md-6">
                        <label for="porcent_ing2"> % Sobre los Ingresos </label>
                        <input type="number" class="form-control" id="porcent_ing2" name="porcent_ing2" value="" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-blue">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="ing1">Ingresos Operacionales</label>
                        <input type="number" class="form-control" id="ing1" name="ing1" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $eva->ingop_fin;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 8 || $_POST['id_est'] != 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && $_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 7 || $_POST['id_est'] == 4  && $_SESSION['rol'] == 200) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>" onkeyup="calcular()">
                    </div>
                    <div class="col-md-6">
                        <label for="utilun">Utilidad Operacional </label>
                        <input type="number" class="form-control" id="utilun" name="utilun" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                        echo $eva->utope_fin;
                                                                                                    }
                                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 8 || $_POST['id_est'] != 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                                        echo '" readonly="';
                                                                                                    }
                                                                                                    if (isset($_POST['id_est']) && $_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 7 || $_POST['id_est'] == 4  && $_SESSION['rol'] == 200) {
                                                                                                        echo '" readonly="';
                                                                                                    } ?>" onkeyup="calcular()">
                    </div>
                    <div class="col-md-6">
                        <label for="porcent_ing1"> % Sobre los Ingresos </label>
                        <input type="number" class="form-control" id="porcent_ing1" name="porcent_ing1" value="" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="util_an1">Utilidad Antes De Impuestos </label>
                        <input type="number" class="form-control" id="util_an1" name="util_an1" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                            echo $eva->utdesim_fin;
                                                                                                        }
                                                                                                        if ((isset($_POST['id_est']) && ($_POST['id_est'] != 8 || $_POST['id_est'] != 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                                            echo '" readonly="';
                                                                                                        }
                                                                                                        if (isset($_POST['id_est']) && $_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 7 || $_POST['id_est'] == 4  && $_SESSION['rol'] == 200) {
                                                                                                            echo '" readonly="';
                                                                                                        } ?>" onkeyup="calcular()">
                    </div>
                    <div class="col-md-6">
                        <label for="porcent_ing3"> % Sobre los Ingresos </label>
                        <input type="number" class="form-control" id="porcent_ing3" name="porcent_ing3" value="" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr style="width: 60%" class="my-3">
<div class="row">
    <div class="col-md-6">
        <div class="card bg-light">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h5>Razón corriente (Miles $):</h5>
                    </div>
                    <div class="col-md-6 pr-0">
                        <input type="number" class="form-control" id="act_raz" name="act_raz" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                            echo '" readonly="';
                                                                                                        } ?>" placeholder="Activo Corriente" readonly>
                        <hr>
                        <input type="number" class="form-control" id="pas_raz" name="pas_raz" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                            echo '" readonly="';
                                                                                                        } ?>" placeholder="Pasivo Corriente" readonly>
                    </div>
                    <div class="col-md-6 py-4 pl-0">
                        <div class="d-flex">
                            <h4 class="d-inline">= </h4>
                            <input type="number" class="form-control" id="res" name="res" value="" placeholder="Total" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-blue">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h5>Razón corriente (Miles $):</h5>
                    </div>
                    <div class="col-md-6 pr-0">
                        <input type="number" class="form-control" id="act_raz1" name="act_raz1" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5  || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                            echo '" readonly="';
                                                                                                        } ?>" placeholder="Activo Corriente" readonly>
                        <hr>
                        <input type="number" class="form-control" id="pas_raz1" name="pas_raz1" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                            echo '" readonly="';
                                                                                                        } ?>" placeholder="Pasivo Corriente" readonly>
                    </div>
                    <div class="col-md-6 py-4 pl-0">
                        <div class="d-flex">
                            <h4 class="d-inline">= </h4>
                            <input type="number" class="form-control" id="res1" name="res1" value="" placeholder="Total" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-6">
        <div class="card bg-light">
            <div class="card-body">
                <h5>Por cada peso de deuda a corto plazo, dispone de </h5>
                <input type="number" class="form-control" id="pas_act" name="pas_act" value="" placeholder="para cubrir en el corto plazo" readonly="readonly">
                <h5>Para cubrir en el corto plazo.</h5>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-blue">
            <div class="card-body">
                <h5>Por cada peso de deuda a corto plazo, dispone de </h5>
                <input type="number" class="form-control" id="pas_act1" name="pas_act1" value="" placeholder="para cubrir en el corto plazo" readonly>
                <h5>Para cubrir en el corto plazo.</h5>
            </div>
        </div>
    </div>
</div>
<hr style="width: 60%" class="my-3">
<div class="row">
    <div class="col-md-6">
        <div class="card bg-light">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h5>Prueba Acida (Miles $):</h5>
                    </div>
                    <div class="col-md-6 pr-0">
                        <input type="number" class="form-control" id="act_raz2" name="act_raz2" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                            echo '" readonly="';
                                                                                                        } ?>" placeholder="Activo Corriente" readonly>
                        <hr>
                        <input type="number" class="form-control" id="pas_raz2" name="pas_raz2" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                            echo '" readonly="';
                                                                                                        } ?>" placeholder="Pasivo Corriente" readonly>
                    </div>
                    <div class="col-md-6 py-4 pl-0">
                        <div class="d-flex">
                            <h4 class="d-inline">= </h4>
                            <input type="number" class="form-control" id="res2" name="res2" value="" placeholder="Total" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-blue">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h5>Prueba Acida (Miles $):</h5>
                    </div>
                    <div class="col-md-6 pr-0">
                        <input type="number" class="form-control" id="act_raz3" name="act_raz3" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                            echo '" readonly="';
                                                                                                        } ?>" placeholder="Activo Corriente" onkeyup="calcular()" readonly>
                        <hr>
                        <input type="number" class="form-control" id="pas_raz3" name="pas_raz3" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                            echo '" readonly="';
                                                                                                        } ?>" placeholder="Pasivo Corriente" readonly>
                    </div>
                    <div class="col-md-6 py-4 pl-0">
                        <div class="d-flex">
                            <h4 class="d-inline">= </h4>
                            <input type="number" class="form-control" id="res3" name="res3" value="" placeholder="Total" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-6">
        <div class="card bg-light">
            <div class="card-body">
                <h5>Por cada peso de deuda a corto plazo, dispone de </h5>
                <input type="number" class="form-control" id="pas_act2" name="pas_act2" value="" placeholder="para cubrir en el corto plazo" readonly>
                <h5>Para cubrir sin necesidad de vender los inventarios.</h5>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-blue">
            <div class="card-body">
                <h5>Por cada peso de deuda a corto plazo, dispone de </h5>
                <input type="number" class="form-control" id="pas_act3" name="pas_act3" value="" placeholder="para cubrir en el corto plazo" readonly>
                <h5>Para cubrir sin necesidad de vender los inventarios.</h5>
            </div>
        </div>
    </div>
</div>
<hr style="width: 60%" class="my-3">

<!-- Aquí comienza Endeudamiento form  -->
<div class="row">
    <div class="col-md-6">
        <div class="card bg-light">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h5>Endeudamiento (Miles $):</h5>
                    </div>
                    <div class="col-md-6 pr-0">
                        <input type="number" class="form-control" id="end_raz" name="end_raz" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                            echo '" readonly="';
                                                                                                        } ?>" placeholder="Pasivo" readonly>
                        <hr>
                        <input type="number" class="form-control" id="act_end" name="act_end" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                            echo '" readonly="';
                                                                                                        } ?>" placeholder="Activo" readonly>
                    </div>
                    <div class="col-md-6 py-4 pl-0">
                        <div class="d-flex">
                            <h4 class="d-inline">= </h4>
                            <input type="number" class="form-control" id="res_end" name="res_end" value="" placeholder="Porcentaje" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-blue">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h5>Endeudamiento (Miles $):</h5>
                    </div>
                    <div class="col-md-6 pr-0">
                        <input type="number" class="form-control" id="end_raz1" name="end_raz1" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                            echo '" readonly="';
                                                                                                        } ?>" placeholder="Pasivo" readonly>
                        <hr>
                        <input type="number" class="form-control" id="act_end1" name="act_end1" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                            echo '" readonly="';
                                                                                                        } ?>" placeholder="Activo" readonly>
                    </div>
                    <div class="col-md-6 py-4 pl-0">
                        <div class="d-flex">
                            <h4 class="d-inline">= </h4>
                            <input type="number" class="form-control" id="res_end1" name="res_end1" value="" placeholder="Porcentaje" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-6">
        <div class="card bg-light">
            <div class="card-body">
                <h5>Por cada peso de activo son de los acreedores </h5>
                <input type="number" class="form-control" id="ac_acre" name="ac_acre" value="" readonly>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-blue">
            <div class="card-body">
                <h5>Por cada peso de activo son de los acreedores </h5>
                <input type="number" class="form-control" id="ac_acre1" name="ac_acre1" value="" readonly>
            </div>
        </div>
    </div>
</div>
<hr style="width: 60%" class="my-3">


<div class="row">
    <div class="col-md-6">
        <div class="card bg-light">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h5>Capital de Trabajo (Miles $):</h5>
                    </div>
                    <div class="col-md-4 pr-0">
                        <input type="number" class="form-control" id="ac_pas" name="ac_pas" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                        echo '" readonly="';
                                                                                                    } ?>" placeholder="Activo Corriente" readonly>
                    </div>
                    <div class="col-md-4 d-flex px-0">
                        <h4 class="d-inline">- </h4>
                        <input type="number" class="form-control" id="pas_ac" name="pas_ac" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                        echo '" readonly="';
                                                                                                    } ?>" placeholder="Pasivo Corriente" readonly>
                    </div>
                    <div class="col-md-4 d-flex pl-0">
                        <h4 class="d-inline">= </h4>
                        <input type="number" class="form-control" id="to_pas" name="to_pas" value="" placeholder="Total" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-blue">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h5>Capital de Trabajo (Miles $):</h5>
                    </div>
                    <div class="col-md-4 pr-0">
                        <input type="number" class="form-control" id="ac_pas1" name="ac_pas1" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                            echo '" readonly="';
                                                                                                        } ?>" placeholder="Activo Corriente" readonly>
                    </div>
                    <div class="col-md-4 d-flex px-0">
                        <h4 class="d-inline">- </h4>
                        <input type="number" class="form-control" id="pas_ac1" name="pas_ac1" value="<?php if ($_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                            echo '" readonly="';
                                                                                                        } ?>" placeholder="Pasivo Corriente" readonly>
                    </div>
                    <div class="col-md-4 d-flex pl-0">
                        <h4 class="d-inline">= </h4>
                        <input type="number" class="form-control" id="to_pas1" name="to_pas1" value="" placeholder="Total" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-6">
        <div class="card bg-light">
            <div class="card-body">
                <h5>Despúes de haber pagado todos sus pasivos a corto plazo le sobran </h5>
                <input type="number" class="form-control" id="des_pas" name="des_pas" value="" readonly>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-blue">
            <div class="card-body">
                <h5>Despúes de haber pagado todos sus pasivos a corto plazo le sobran </h5>
                <input type="number" class="form-control" id="des_pas1" name="des_pas1" value="" readonly>
            </div>
        </div>
    </div>
</div>
</form>