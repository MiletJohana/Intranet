<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
if (isset($_POST['id_sol']) && $_POST['id_sol'] != '') {
    $sqlSol1 = "SELECT id_cli FROM cre_solicitud 
    WHERE id_sol=" . $_POST['id_sol'];
    $querySol1 = $conexion->query($sqlSol1);
    while ($r = $querySol1->fetch(PDO::FETCH_OBJ)) {
        $s = $r;
        break;
    }
    $sqlCli = "SELECT * FROM mq_clie, mq_usu, cre_solicitud 
    WHERE mq_clie.ase_com=mq_usu.id_usu AND mq_clie.id_cli='$s->id_cli' 
    GROUP BY mq_clie.id_cli";
    $queryCli = $conexion->query($sqlCli);
    while ($r = $queryCli->fetch(PDO::FETCH_OBJ)) {
        $cli = $r;
        break;
    }
}
//echo $sqlCli;
?>
<form role="form" id="form-crm">
<input type="hidden" id = "reg" value = "<?php echo $_SESSION['reg'];?>">
<input type="hidden" id = "id"  value = "<?php echo $_SESSION['id']; ?>">
<input type="hidden" id = "rol" value = "<?php echo $_SESSION['rol'];?>">
<input type="hidden" id="accion_form" name="action" value="<?php if ($_POST['resp'] == 1) {
                                                                echo "add";
                                                            } elseif ($_POST['resp'] == 7) {
                                                                echo "actualizacionForm1";
                                                             } ?>">
<div class="alert alert-info" role="alert">
    <div class="d-flex">
        <span class="pt-1">
            (*) Campo requerido
        </span>
        <button type="button" class="btn btn-info ml-auto" data-trigger="focus" data-container="body" data-bs-toggle="popover" data-placement="left" data-content="Si seleccionas el tipo de documento el formulario se adaptara al tipo." data-original-title="" title="">
            <i class="fa fa-info"></i>
        </button>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h3 class="text-center">Información general del Cliente</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <label for="nom_clie">Nombre del Cliente *</label>
        <input type="text" class="form-control invalid" id="nom_clie" name="nom_clie" value="<?php  if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $cli->nom_cli;
                                                                                                    }
                                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                                                                                                            echo '" readonly="';
                                                                                                                                                                                        }
                                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                        echo '" readonly="';
                                                                                                    } ?>" required onkeyup="autoCre(1);">

    </div>
    <div class="col-md-6 col-sm-12">
        <label for="">Cliente Nuevo</label>
        <button id="btnAddCli" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-large-2" onclick="crearClientcred('addClient');">Agregar</button>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <label for="id_nit">NIT</label>
        <input type="number" class="form-control invalid" id="id_nit" name="id_nit" readonly  value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                echo $s->id_cli;
                                                                                            }
                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                                echo '" readonly="';
                                                                                            }
                                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                echo '" readonly="';
                                                                                            } ?>" required>
    </div>
    <div class="col-md-6 col-sm-12">
        <label for="dirEmp">Dirección de la empresa *</label>
        <input type="text" class="form-control invalid" id="dirEmp" name="dirEmp" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                echo $cli->dir_cli;
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
        <label for="Actsol">Actividad Solicitada *</label>
        <select id="Actsol" name="Actsol" class="form-control" required>
            <?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) { ?>
                <option valuellll="php $cli->activ_solicitada; ?>"><?php $cli->activ_solicitada; ?></option>
                <?php if ((isset($_POST['id_est']) && ($_POST['id_est'] == 7 || $_POST['id_est'] == 8))) { ?>
                    <option value="">Seleccionar</option>
                    <option value="Nuevo Credito">Nuevo Crédito</option>
                    <option value="Actualizacion del Credito">Actualización del Crédito</option>
                <?php }
            } else { ?>
                <option value="">Seleccionar</option>
                <option value="Nuevo Credito">Nuevo Crédito</option>
                <option value="Actualizacion del Credito">Actualización del Crédito</option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-6 col-sm-12">
        <label for="nom_com">Nombre Quien Solicita el Credito *</label>
        <input type="text" class="form-control invalid" id="nom_com" name="nom_com" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                echo $cli->con_cli;
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
        <label for="correo">Correo Electrónico *</label>
        <input type="email" class="form-control invalid" id="correo" name="correo" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                echo $cli->eml_cli;
                                                                                            }
                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                echo '" readonly="';
                                                                                            }
                                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                echo '" readonly="';
                                                                                            } ?>" required>
    </div>
    <div class="col-md-6 col-sm-12">
        <label for="Car">Cargo *</label>
        <input type="text" class="form-control invalid" id="car" name="car" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                        echo $cli->cargo_conta;
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
        <label for="celCli"> Celular del Cliente *</label>
        <input type="number" class="form-control " id="celCli" name="celCli" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                        echo $cli->tel_cli;
                                                                                    }
                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                        echo '" readonly="';
                                                                                    }
                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                        echo '" readonly="';
                                                                                    } ?>">
    </div>
    <div class="col-md-6 col-sm-12">
        <label for="TelF">Teléfono Fijo *</label>
        <input type="number" class="form-control" id="TelF" name="TelF" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                    echo $cli->telefono_fijo;
                                                                                }
                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                    echo '" readonly="';
                                                                                }
                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                    echo '" readonly="';
                                                                                } ?>" required>
    </div>
</div>


<div class="row mt-3">
    <div class="col-md-12">
        <h3 class="text-center">Información de Contactos</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>

<div class="row">
    <div class="col-md-3 col-sm-12">
        <label for="en_com">Encargado Compras *</label>
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
        <label for="ema_com">E-mail *</label>
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
        <label for="cont_ocu">Salud Ocupacional *</label>
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
        <label for="ema_ocu">E-mail *</label>
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
        <label for="cont_ser">Servicios Generales *</label>
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
        <label for="ema_ser">E-mail *</label>
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
        <label for="cont_tes">Tesorería *</label>
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
        <label for="ema_tes">E-mail *</label>
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
        <label for="cont_cont">Contabilidad *</label>
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
        <label for="ema_conta">E-mail *</label>
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
        <label for="reple">Representate Legal *</label>
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
        <label for="regi">Régimen *</label>
        <select id="regi" name="regi" class="form-control" required>
            <?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) { ?>
                <option value="<?php $sol->reg_clie; ?>"><?php $sol->reg_clie; ?></option>
                <?php if ((isset($_POST['id_est']) && ($_POST['id_est'] == 7 || $_POST['id_est'] == 8))) { ?>
                    <option value="Simplificado">Simplificado</option>
                    <option value="Regimen Comun">Regimen Común</option>
                    <option value="Entrega">Regimen Especial</option>
                    <option value="Financiera">No Aplica</option>
                <?php }
            } else { ?>
                <option value="">Seleccionar</option>
                <option value="Simplificado">Simplificado</option>
                <option value="Regimen Comun">Regimen Común</option>
                <option value="Entrega">Regimen Especial</option>
                <option value="Financiera">No Aplica</option>
            <?php } ?>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <label for="fech_sol">Fecha de Solicitud *</label>
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
        <label for="ac_eco">Actividad Económica </label>
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
        <label for="num_empl">Numero de Empleados *</label>
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
        <label for="cupCreSol">Cupo de crédito solicitado *</label>
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
        <label for="ter_pag">Termino de Pago *</label>
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
        <label for="di_pag">Días en que se realizará el pago *</label>
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
        <label for="pun_u">Dirección *</label>
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
        <label for="ciu">Ciudad *</label>
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
        <label for="tel_fij">Teléfono Fijo *</label>
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
        <label for="hor_1">H. Inicial *</label>
        <input type="time" class="form-control" id="hor_1" name="hor_1" value="<?php if (isset($_POST['edit'])) {
                                                                                                        echo $rPerm['fech_ini'];
                                                                                                    } else {
                                                                                                        echo "07:00:00";
                                                                                                    } ?>" required>
    </div>
    <div class="col-md-2 col-sm-12">
        <label for="hor1_1">Hora Final*</label>
        <input type="time" class="form-control" id="hor1_1" name="hor1_1" value="<?php if (isset($_POST['edit'])) {
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
            <label for="pun_u">Puntos </label>
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
            <label for="ciu">Ciudad </label>
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
            <label for="tel_fij">Teléfono Fijo </label>
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
            <label for="hor_2">Horario Inicial</label>
            <input type="time" class="form-control" id="hor_2" name="hor_2" value="<?php if (isset($_POST['edit'])) {
                                                                                                        echo $rPerm['fech_ini'];
                                                                                                    } else {
                                                                                                        echo "07:00:00";
                                                                                                    } ?>" required>
        </div>
        <div class="col-md-2 col-sm-12">
            <label for="hor2_2">Horario Final </label>
            <input type="time" class="form-control" id="hor2_2" name="hor2_2" value="<?php if (isset($_POST['edit'])) {
                                                                                                        echo $rPerm['fech_ini'];
                                                                                                    } else {
                                                                                                        echo "17:00:00";
                                                                                                    } ?>" required>
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
            <label for="pun_u">Puntos </label>
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
            <label for="ciu">Ciudad </label>
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
            <label for="tel_fij3">Teléfono Fijo</label>
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
            <input type="time" class="form-control" id="hor_3" name="hor_3" value="<?php if (isset($_POST['edit'])) {
                                                                                                        echo $rPerm['fech_ini'];
                                                                                                    } else {
                                                                                                        echo "07:00:00";
                                                                                                    } ?>" required>
        </div>
        <div class="col-md-2 col-sm-12">
            <label for="hor3_3">Horario Final </label>
            <input type="time" class="form-control" id="hor3_3" name="hor3_3" value="<?php if (isset($_POST['edit'])) {
                                                                                                        echo $rPerm['fech_ini'];
                                                                                                    } else {
                                                                                                        echo "15:00:00";
                                                                                                    } ?>" required>
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
        <label for="direFa">Dirección *</label>
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
        <label for="ciu_fac">Ciudad *</label>
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
        <label for="telfi_fa">Teléfono Fijo *</label>
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
        <label for="hor_fac">Horario*</label>
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
<div class="row mt-3">
    <div class="col-md-12 text-center">
        <h3>Espacio para el área de Ventas</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        Tipo de Cliente *
        <br>
        <div>
            <label class="custom-control custom-radio"><input type="radio" name="tipCli" id="tipCli" value="Desconocido" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $cli->tip_clie == 'Desconocido') {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>Desconocido</label>
            <label class="custom-control custom-radio"><input type="radio" name="tipCli" id="tipCli" value="Conocido" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $cli->tip_clie == 'Conocido') {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>Conocido</label>
            <label class="custom-control custom-radio"><input type="radio" name="tipCli" id="tipCli" value="Gran Empresa" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $cli->tip_clie == 'Gran Empresa') {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>Gran Empresa</label>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <label for="segCl">Segmento del cliente *</label>
        <select id="segCl" name="segCl" class="form-control" required>
            <?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) { ?>
                <option value="<?php $sol->reg_clie; ?>"><?php $sol->segm_clie; ?></option>
                <?php if ((isset($_POST['id_est']) && ($_POST['id_est'] == 7 || $_POST['id_est'] == 8))) { ?>
                    <option value="">Seleccionar</option>
                    <option value="Alimentos y Bebidas">Alimentos y Bebidas</option>
                    <option value="Cosas de Aseo">Cosas de Aseo</option>
                    <option value="Comercio">Comercio</option>
                    <option value="Comunicaciones">Comunicaciones</option>
                    <option value="Construccion">Construcción</option>
                    <option value="Financiero">Financiero</option>
                    <option value="Grandes Superficies">Grandes Superficies</option>
                    <option value="Hoteles y Turismo">Hoteles y Turismo</option>
                    <option value="Otro">Otro</option>
                <?php }
            } else { ?>
                <option value="">Seleccionar</option>
                <option value="Alimentos y Bebidas">Alimentos y Bebidas</option>
                <option value="Cosas de Aseo">Cosas de Aseo</option>
                <option value="Comercio">Comercio</option>
                <option value="Comunicaciones">Comunicaciones</option>
                <option value="Construccion">Construcción</option>
                <option value="Financiero">Financiero</option>
                <option value="Grandes Superficies">Grandes Superficies</option>
                <option value="Hoteles y Turismo">Hoteles y Turismo</option>
                <option value="Otro">Otro</option>
            <?php } ?>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 ">
        <label for="conAt">Concepto del ATC *</label>
        <select id="conAt" name="conAt" class="form-control" required>
            <?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) { ?>
                <option value="<?php $sol->reg_clie; ?>"><?php $sol->congen_ase; ?></option>
                <?php if ((isset($_POST['id_est']) && ($_POST['id_est'] == 7 || $_POST['id_est'] == 8))) { ?>
                    <option value="">Seleccionar</option>
                    <option value="Excelente">Excelente</option>
                    <option value="Bueno">Bueno</option>
                    <option value="Regular">Regular</option>
                    <option value="Malo">Malo</option>
                <?php }
            } else { ?>
                <option value="">Seleccionar</option>
                <option value="Excelente">Excelente</option>
                <option value="Bueno">Bueno</option>
                <option value="Regular">Regular</option>
                <option value="Malo">Malo</option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-6 col-sm-12">
        <label for="CupAtc">Cupo de credito sugerido por ATC *</label>
        <input type="number" class="form-control" id="CupAtc" name="CupAtc" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                        echo $sol->cupoSugA;
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
        <label for="plazAt">Plazo de pago sugerido por ATC *</label>
        <input type="number" class="form-control" id="PlazAt" name="PlazAt" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                        echo $sol->plaSugeA;
                                                                                    }
                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                        echo '" readonly="';
                                                                                    }
                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                        echo '" readonly="';
                                                                                    } ?>" required>
    </div>
    <div class="col-md-6 col-sm-12 col-md-offset-2" style="margin-top: -56">
        <label for="aseCom">C.C</label>
        <input type="text" class="form-control" id="aseCom" name="aseCom" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                        echo $sol->ase_com;
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
    <div class="col-md-6 col-sm-12" style="margin-top: -56">
        <label for="nomAse">Asesor Técnico comercial</label>
        <input type="text" class="form-control invalid" id="nomAse" name="nomAse" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                echo $sol->nom_atc;
                                                                                            }
                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                echo '" readonly="';
                                                                                            }
                                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                echo '" readonly="';
                                                                                            } ?>" required onkeyup="autoCre(2);">
    </div>
    <?php if ($_SESSION['rol'] == 500 || $_SESSION['rol'] == 400 || $_SESSION['rol'] == 300 || $_SESSION['rol'] == 200) { ?>
        <div class="col-md-6 col-sm-12" style="margin-top: -56">
            <label for="aseSac">C.C</label>
            <input type="text" class="form-control" id="aseSac" name="aseSac" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                            echo $sol->rep_sac;
                                                                                        }
                                                                                        if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                            echo '" readonly="';
                                                                                        }
                                                                                        if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                            echo '" readonly="';
                                                                                        } ?>">
        </div>
        <div class="col-md-6 col-sm-12" style="margin-top: -56">
            <label for="nomSac">Servicio Al Cliente</label>
            <input type="text" class="form-control invalid" id="nomSac" name="nomSac" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $sol->nom_sac;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>" onkeyup="autoCre(3);">
        </div>
    <?php } ?>
</div>
<div class="row">
    <div class="col-md-12">
        <label for="just">Justificación del cupo y plazo</label>
        <textarea class="form-control" id="just" name="just" rows="3" placeholder="LLena este espacio para justificar el cupo y  plazo que le diste al cliente " value="
                  <?php if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                        echo '" readonly="';
                    }
                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                        echo '" readonly="';
                    } ?>"><?php if ($_POST['resp'] == 2  || $_POST['resp'] == 3  || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                echo $sol->jusPlaCup;
                            } ?></textarea>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <label for="ana_ref">Análisis de Referencias (Proveedores Similares a MQ)</label>
        <textarea class="form-control" id="ana_ref" name="ana_ref" rows="3" placeholder="LLena este espacio para justificar el cupo y  plazo que le diste al cliente " value="<?php if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                                                                                                    echo '" readonly="';
                                                                                                                                                                                }
                                                                                                                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                                                                                                    echo '" readonly="';
                                                                                                                                                                                } ?>"><?php if ($_POST['resp'] == 2  || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                                                                                                            echo $sol->ana_referen;
                                                                                                                                                                                        } ?></textarea>
    </div>
</div>
<div class="row mt-2">
    <?php if ($_POST['resp'] == 1) { ?>
        <div class="col-md-4 col-sm-12 text-center">
            <li class="alert alert-success"  style="padding: 23px;">
                Certificado de constitución y gerencia con fecha de expedición no mayor a <b>60</b> días
                <div class="fileUpload btn btn-success">
                    <span id="cer_co">Seleccionar</span>
                    <input type="file" name="certCon" id="certCon" class="upload" accept="multipart/form-data">
                    <div>
                        <script type="text/javascript">
                            document.getElementById('certCon').onchange = function() {
                                console.log(this.value);
                                document.getElementById('cer_co').innerHTML = document.getElementById('certCon').files[0].name;
                            }
                        </script>
                    </div>
                </div>
            </li>
        </div>
        <div class="col-md-4 col-sm-12 text-center">
            <li class="alert alert-success" style="padding: 58px;">
                Copia del RUT
                <div>
                    <div class="fileUpload btn btn-success">
                        <span id="cop_u">Seleccionar</span>
                        <input type="file" name="copRu" id="copRu" class="upload" accept="multipart/form-data">
                        <div>
                            <script type="text/javascript">
                                document.getElementById('copRu').onchange = function() {
                                    console.log(this.value);
                                    document.getElementById('cop_u').innerHTML = document.getElementById('copRu').files[0].name;
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </li>
        </div>
        <div class="col-md-4 col-sm-12 text-center">
            <li class="alert alert-success">
                Copia de Estados Financieros de los Dos Ultimos Años Fiscales (Balance General y Estado de Resultados)
                <div class="fileUpload btn btn-success">
                    <span id="cop_f">Seleccionar</span>
                    <input type="file" name="copFin" id="copFin" class="upload" accept="multipart/form-data">
                    <div>
                        <script type="text/javascript">
                            document.getElementById('copFin').onchange = function() {
                                console.log(this.value);
                                document.getElementById('cop_f').innerHTML = document.getElementById('copFin').files[0].name;
                            }
                        </script>
                    </div>

                </div>
            </li>
        </div>
    <?php } elseif (isset($_POST['id_est']) && ($_POST['id_est'] == 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) { ?>
        <div class="col-md-4 col-sm-12 text-center">
            <li class="alert alert-success" style="padding:23px;">
                Certificado de constitución y gerencia con fecha de expedición no mayor a <b>60</b> días
                <div class="fileUpload btn btn-success">
                    <span id="cer_co">Seleccionar</span>
                    <input type="file" name="certCon" id="certCon" class="upload" accept="multipart/form-data">
                    <div>
                        <script type="text/javascript">
                            document.getElementById('certCon').onchange = function() {
                                console.log(this.value);
                                document.getElementById('cer_co').innerHTML = document.getElementById('certCon').files[0].name;
                            }
                        </script>
                    </div>
                </div>
            </li>
        </div>
        <div class="col-md-4 col-sm-12 text-center">
            <li class="alert alert-success"  style="padding: 58px;">
                Copia del RUT
                <div>
                    <div class="fileUpload btn btn-success">
                        <span id="cop_u">Seleccionar</span>
                        <input type="file" name="copRu" id="copRu" class="upload" accept="multipart/form-data">
                        <div>
                            <script type="text/javascript">
                                document.getElementById('copRu').onchange = function() {
                                    console.log(this.value);
                                    document.getElementById('cop_u').innerHTML = document.getElementById('copRu').files[0].name;
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </li>
        </div>
        <div class="col-md-4 col-sm-12 text-center">
            <li class="alert alert-success">
                Copia de Estados Financieros de los Dos Ultimos Años Fiscales (Balance General y Estado de Resultados)
                <div class="fileUpload btn btn-success">
                    <span id="cop_f">Seleccionar</span>
                    <input type="file" name="copFin" id="copFin" class="upload" accept="multipart/form-data">
                    <div>
                        <script type="text/javascript">
                            document.getElementById('copFin').onchange = function() {
                                console.log(this.value);
                                document.getElementById('cop_f').innerHTML = document.getElementById('copFin').files[0].name;
                            }
                        </script>
                    </div>

                </div>
            </li>
        </div>
    <?php } ?>
</div>
<div class="row">
    <?php if ($_POST['resp'] == 1) { ?>
        <div class="col-md-4 col-sm-12 text-center">
            <li class="alert alert-success">
                Dos referencias comerciales, (En casos particulares se acepta una de estas de forma verbal) con fecha de expedicion <b>NO</b> mayor a 6 meses
                <div class="fileUpload btn btn-success">
                    <span id="re_com">Seleccionar</span>
                    <input type="file" name="refComer" id="refComer" class="upload" accept="multipart/form-data">
                    <div>
                        <script type="text/javascript">
                            document.getElementById('refComer').onchange = function() {
                                console.log(this.value);
                                document.getElementById('re_com').innerHTML = document.getElementById('refComer').files[0].name;
                            }
                        </script>
                    </div>
                </div>
                <div class="fileUpload btn btn-success">
                    <span id="ref_com2">Seleccionar</span>
                    <input type="file" name="refComer2" id="refComer2" class="upload" accept="multipart/form-data">
                    <div>
                        <script type="text/javascript">
                            document.getElementById('refComer2').onchange = function() {
                                console.log(this.value);
                                document.getElementById('ref_com2').innerHTML = document.getElementById('refComer2').files[0].name;
                            }
                        </script>
                    </div>
                </div>
            </li>
        </div>
        <div class="col-md-4 col-sm-12 text-center">
            <li class="alert alert-success" style="padding: 54px;">
                Una referencia bancaria con fecha de expedición <b>NO</b> Mayor a 6 Meses
                <div>
                    <div class="fileUpload btn btn-success">
                        <span id="ref_ban">Seleccionar</span>
                        <input type="file" name="refBan" id="refBan" class="upload" accept="multipart/form-data">
                        <div>
                            <script type="text/javascript">
                                document.getElementById('refBan').onchange = function() {
                                    console.log(this.value);
                                    document.getElementById('ref_ban').innerHTML = document.getElementById('refBan').files[0].name;
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </li>
        </div>
        <div class="col-md-4 col-sm-12 text-center">
            <li class="alert alert-success"  style="padding: 65px;">
                Formulario de estudio de crédito
                <div>
                    <div class="fileUpload btn btn-success">
                        <span id="for_cre1">Seleccionar</span>

                        <input type="file" name="form_cre" id="form_cre" class="upload" accept="multipart/form-data">
                        <div>
                            <script type="text/javascript">
                                document.getElementById('form_cre').onchange = function() {
                                    console.log(this.value);
                                    document.getElementById('for_cre1').innerHTML = document.getElementById('form_cre').files[0].name;
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </li>
        </div>
    <?php } elseif (isset($_POST['id_est']) && ($_POST['id_est'] == 7) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) { ?>
        <div class="col-md-4 col-sm-12 text-center">
            <li class="alert alert-success">
                Dos referencias comerciales, (En casos particulares se acepta una de estas de forma verbal) con fecha de expedicion <b>NO</b> mayor a 6 meses
                <div class="fileUpload btn btn-success">
                    <span id="re_com">Seleccionar</span>
                    <input type="file" name="refComer" id="refComer" class="upload" accept="multipart/form-data">
                    <div>
                        <script type="text/javascript">
                            document.getElementById('refComer').onchange = function() {
                                console.log(this.value);
                                document.getElementById('re_com').innerHTML = document.getElementById('refComer').files[0].name;
                            }
                        </script>
                    </div>
                </div>
                <div class="fileUpload btn btn-success">
                    <span id="ref_com2">Seleccionar</span>
                    <input type="file" name="refComer2" id="refComer2" class="upload" accept="multipart/form-data">
                    <div>
                        <script type="text/javascript">
                            document.getElementById('refComer2').onchange = function() {
                                console.log(this.value);
                                document.getElementById('ref_com2').innerHTML = document.getElementById('refComer2').files[0].name;
                            }
                        </script>
                    </div>
                </div>
            </li>
        </div>
        <div class="col-md-4 col-sm-12 text-center">
            <li class="alert alert-success" style="padding: 54px;">
                Una referencia bancaria con fecha de expedición <b>NO</b> Mayor a 6 Meses
                <div>
                    <div class="fileUpload btn btn-success">
                        <span id="ref_ban">Seleccionar</span>
                        <input type="file" name="refBan" id="refBan" class="upload" accept="multipart/form-data">
                        <div>
                            <script type="text/javascript">
                                document.getElementById('refBan').onchange = function() {
                                    console.log(this.value);
                                    document.getElementById('ref_ban').innerHTML = document.getElementById('refBan').files[0].name;
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </li>
        </div>
        <div class="col-md-4 col-sm-12 text-center">
            <li class="alert alert-success" style="padding: 65px;">
                Formulario de estudio de crédito
                <div>
                    <div class="fileUpload btn btn-success">
                        <span id="for_cre1">Seleccionar</span>
                        <input type="file" name="form_cre" id="form_cre" class="upload" accept="multipart/form-data">
                        <div>
                            <script type="text/javascript">
                                document.getElementById('form_cre').onchange = function() {
                                    console.log(this.value);
                                    document.getElementById('for_cre1').innerHTML = document.getElementById('form_cre').files[0].name;
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </li>
        </div>
    <?php } ?>
</div>
</form>