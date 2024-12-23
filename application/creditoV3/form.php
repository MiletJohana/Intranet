<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
if (isset($_POST['id_sol']) && $_POST['id_sol'] != '') {
    $sqlSol1 = "SELECT id_cli, id_cont, activ_solicitada FROM cre_solicitud 
    WHERE id_sol=" . $_POST['id_sol'];
    $querySol1 = $conexion->query($sqlSol1);
    while ($r = $querySol1->fetch(PDO::FETCH_OBJ)) {
        $s = $r;
        break;
    }

    $sqlCli = "SELECT * FROM mq_clientes, mq_usu
    WHERE mq_clientes.ase_com=mq_usu.id_usu AND mq_clientes.id_cli='$s->id_cli' 
    GROUP BY mq_clientes.id_cli";
    $queryCli = $conexion->query($sqlCli);

    while ($r = $queryCli->fetch(PDO::FETCH_OBJ)) {
        $cli = $r;
        break;
    }

    $sqlCont = "SELECT * FROM contactos
               WHERE id_cont ='$s->id_cont'";
    $queryCont = $conexion->query($sqlCont);
    while ($rCont = $queryCont->fetch(PDO::FETCH_OBJ)) {
        $cont = $rCont;
        break;
    }

    $id_act = $s -> activ_solicitada;
    $sqlActivSol = "SELECT * FROM credit_actSol";
    if ($id_act != '') {
        $sqlActivSol .= " WHERE id_act = '$id_act';";
    }
    $queryActivSol = $conexion->query($sqlActivSol);
    while ($rActivSol = $queryActivSol->fetch(PDO::FETCH_OBJ)) {
        $activSol = $rActivSol;
        break;
    }

    $sqlActivSol1 = "SELECT * FROM credit_actSol";
    if ($id_act != '') {
        $sqlActivSol1 .= " WHERE id_act != '$id_act';";
    }
    $queryActivSol1 = $conexion->query($sqlActivSol1);

} else{
    $sqlActivSol = "SELECT * FROM credit_actSol";
    $queryActivSol = $conexion->query($sqlActivSol);
}
//sssecho $sqlCli;

?>
 <div>
    <?php if($_POST['resp'] == 5 && $_POST['id_est'] == 3){ ?>
        <img src="../../resources/img/selloAprob.png" alt="" class="apro">
        <?php } else if($_POST['resp'] == 5 && $_POST['id_est'] == 4){ ?>
        <img src="../../resources/img/selloRecha.png" alt="" class="desa">
        <?php }  ?>    
</div>
    

<div class="row">
    <div class="col-12">
        <h3 class="text-center">Información general del Cliente</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<div class="row" id="alert-newClient">

</div>


<div class="row">
<?php if($_POST['resp'] == 1){ ?>
    <p class="text-center text-mq">* Al encontrar el cliente puede modificar la información que sea necesaria y al crear el crédito se actualizaran automaticamente *</p>
<?php } ?>
    <div class="col-md-10 col-sm-12 mb-3" >
        <label for="nom_clie" class="form-label" >Nombre del Cliente</label>
        <div class="input-group">
			<span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
            <input type="text" class="form-control" id="nom_clie" name="nom_clie" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                        echo $cli->nom_cli;
                                                                                                    }
                                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                        echo '" readonly="';
                                                                                                    }
                                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                        echo '" readonly="';
                                                                                                    } ?>" <?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                        echo 'readonly';
                                                                                                    }?> required onkeyup="auto(1);">
                                                                                                    
            <input type="hidden" id="id_cli" name="id_cli" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                            echo $cli->id_cli;
                                                                        }
                                                                        if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                            echo '" readonly="';
                                                                        }
                                                                        if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                            echo '" readonly="';
                                                                        } ?>" required>
        </div>
    </div>
    <div class="col-md-2 col-sm-12 d-flex align-items-end justify-content-evenly">
        <button type="button" onclick="crearClientCred('addClient');" class="btn btn-danger mb-4" <?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo 'disabled';
                                                                                                 }?>>
            <i class="fa-solid fa-user-plus"></i>
        </button>
    </div>
</div>

<div class="row">
    <div class="none col-12 mb-3" id="input_editNomClie">
        <h5 class="text-center mt-4">Actualizar Información</h5>
        
        
        <label for="nom_clie1" class="form-label" >Nombre del Cliente <span name="req" class="text-mq">*</span></label>
        <input type="text" class="form-control" id="nom_clie1" name="nom_clie1" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $cli->nom_cli;
                                                                                                 }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>"  required>

    </div>
</div>


<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="id_nit" class="form-label" >NIT <span name="req" class="text-mq">*</span></label>
        <input type="text" class="form-control" id="id_nit" name="id_nit" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4  || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                echo $cli->num_doc;
                                                                                            }
                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 100 || $_SESSION['rol'] == 300))) {
                                                                                                echo '" readonly="';
                                                                                            }
                                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                echo '" readonly="';
                                                                                            } ?>"readonly required >
    </div>
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="dirEmp" class="form-label" >Dirección del cliente </label>
        <input type="text" class="form-control" id="dirEmp" name="dirEmp" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                echo $cli->dir_cli;
                                                                                            }
                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                echo '" readonly="';
                                                                                            }
                                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                echo '" readonly="';
                                                                                            } ?>" required >
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="Actsol" class="form-label" >Actividad Solicitada <span name="req" class="text-mq">*</span></label>
        <select id="Actsol" name="Actsol" class="form-select" required <?php if ($_POST['resp'] == 1 || $_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5) { echo 'disabled'; }?>>
            <?php if ($_POST['resp'] == 1) { ?>
                <option value="">Seleccione</option>
                <?php while ($rActivSol = $queryActivSol->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $rActivSol['id_act']; ?>"><?php echo $rActivSol['nom_act']; ?></option>
                <?php }
                } if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) { ?>
                <option value="<?php echo $activSol->id_act; ?>"><?php echo $activSol->nom_act; ?></option>
                <?php if ((isset($_POST['id_est']) && ($_POST['id_est'] == 7 || $_POST['id_est'] == 8))) { 
                    while ($rActivSol1 = $queryActivSol1->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rActivSol1['id_act']; ?>"><?php echo $rActivSol1['nom_act']; ?></option>
                    <?php }
                    }
                } ?>
        </select>
    </div>
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="nom_com" class="form-label" >Nombre Quien Solicita el Credito <span name="req" class="text-mq">*</span></label>
        <div id="select_contact" class="d-flex">
            <select class="form-select" id="nom_com" name="nom_com" required <?php if ($_POST['resp'] == 1 || $_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5) { echo 'disabled'; }?>>
                <?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) { ?>
                    <option value="<?php echo $cont->id_cont; ?>"><?php echo $cont->nom_cont; ?></option>
                <?php } else { ?>
                    <option value="">Seleccionar</option>
                <?php } ?>

            </select>
            <button type="button" onclick="" class="btn btn-danger btn-sm ms-2" disabled>
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>
    </div>
 
</div>


<div class="row">
    <div class="none col-md-6 col-sm-12 mb-3" id="input_editNomCont">
        <label for="nom_com1" class="form-label" >Nombre del Contacto</label>
        <input type="text" class="form-control" id="nom_com1" name="nom_com1" required>
    </div>
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="telcon" class="form-label" >Celular Contacto</label>
        <input type="number" class="form-control" id="telcon" name="telcon" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                echo $cont->tel_cont;
                                                                                            }
                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                echo '" readonly="';
                                                                                            }
                                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                echo '" readonly="';
                                                                                            } ?>" >
    </div>
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="correo_cont" class="form-label" >Correo Electrónico Contacto</label>
        <input type="email" class="form-control" id="correo_cont" name="correo_cont" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                echo $cont->eml_cont;
                                                                                            }
                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                echo '" readonly="';
                                                                                            }
                                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                echo '" readonly="';
                                                                                            } ?>" required >
    </div>
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="car_cont" class="form-label" >Cargo Contacto</label>
        <input type="text" class="form-control" id="car_cont" name="car_cont" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                        echo $cont->car_cont;
                                                                                    }
                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                        echo '" readonly="';
                                                                                    }
                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                        echo '" readonly="';
                                                                                    } ?>" required >
    </div>
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="eml_cli" class="form-label" >Correo Electrónico Cliente</label>
        <input type="email" class="form-control" id="eml_cli" name="eml_cli" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                echo $cli->eml_cli;
                                                                                            }
                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                echo '" readonly="';
                                                                                            }
                                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                echo '" readonly="';
                                                                                            } ?>" required>
    </div>
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="celCli" class="form-label" >Celular del Cliente</label>
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
</div>


<input type="hidden" id="accion_form" name="action" value="<?php if ($_POST['resp'] == 1) {
                                                                echo "add";
                                                            } elseif ($_POST['resp'] == 2) {
                                                                echo "update";
                                                            } elseif ($_POST['resp'] == 7) {
                                                                echo "actualizacionForm1";
                                                            } elseif ($_POST['resp'] == 8) {
                                                                echo "actualizacionForm2";
                                                            } else {
                                                                echo "updateAprob";
                                                            } ?>">