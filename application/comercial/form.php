<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
if (isset($_POST['id_agen']) && $_POST['id_agen'] != '') {
    $sqlAgen = "SELECT com.id_raz, com.eml_con, com.carg_con, cl.nom_cli, cl.id_cli , com.tel_con, com.dir_cli, com.nom_con, cl.eml_cli, com.id_tipcli
    FROM agen_comerciales AS com 
    INNER JOIN mq_clientes AS cl 
    ON com.id_cli = cl.id_cli 
    WHERE com.id_cli = cl.id_cli 
    AND id_agen = " . $_POST['id_agen'];
    $queryAgen = $conexion->query($sqlAgen);
    $r = $queryAgen->fetch(PDO::FETCH_ASSOC);
}

$sqlEst = "SELECT * FROM agen_comerciales WHERE id_est = 3 AND id_usu = " .$sesion_id;
$queryEst = $conexion->query($sqlEst);
//echo $sqlEst;
if (isset($_POST['resp']) && ($_POST['resp'] == 2 || $_POST['resp'] == 5)) {
    if ($queryEst->rowCount() > 0) {
        $rEst = $queryEst->fetch(PDO::FETCH_ASSOC);
        $sqlAgen = "SELECT com.id_raz, com.eml_con, com.carg_con, cl.nom_cli, com.id_cli , com.tel_con, com.dir_cli, com.nom_con, cl.eml_cli, com.id_tipcli
        FROM agen_comerciales AS com
        INNER JOIN mq_clientes AS cl
        ON com.id_cli = cl.id_cli
        WHERE com.id_cli = cl.id_cli AND id_agen = " . $rEst['id_agen'];
        $queryAgen = $conexion->query($sqlAgen);
        $r = $queryAgen->fetch(PDO::FETCH_ASSOC);
       // echo $sqlAgen;
    }
}
$sqlRaz = "SELECT * FROM agen_raz";
if (isset($_POST['resp']) && $_POST['resp'] == 2 && isset($rEst['id_raz'])) {
    $sqlRaz .= " WHERE id_raz=" . $rEst['id_raz'];
}
$queryRaz = $conexion->query($sqlRaz);
if (isset($_POST['resp']) && $_POST['resp'] == 2) {
    $rRaz2 = $queryRaz->fetch(PDO::FETCH_ASSOC);
}
$sqltip="SELECT * FROM agen_tipclie";
if (isset($_POST['resp']) && $_POST['resp'] == 2 && isset($rEst['id_tipcli'])) {   
    $sqltip .= " WHERE id_tipcli=" . $rEst['id_tipcli'];
}
$querytip = $conexion->query($sqltip);
if (isset($_POST['resp']) && $_POST['resp'] == 2) {
    $rtip2 = $querytip->fetch(PDO::FETCH_ASSOC);
}
$sql5="SELECT * FROM agen_tip_llamada";
$query5= $conexion->query($sql5);
//echo $sqlRaz;
?>
<form role="form" id="form-cita">
    <?php if (isset($_POST['resp']) && $_POST['resp'] == 5) { ?>
        <div class="row">
            <div class="col-12 col-sm-12">
                <h5>¿Está seguro de cancelar ésta cita?</h5>
                <label for="obs_agenC" class="form-label">Motivo</label>
                <textarea class="form-control" id="obs_agenC" name="obs_agenC" placeholder="Escriba aqui el motivo por el cual desea cancelar la cita"></textarea>
                <input type="hidden" id="lat_fin" name="lat_fin" value="">
                <input type="hidden" id="lon_fin" name="lon_fin" value="">
            </div>
        </div>
    <?php } elseif (isset($_POST['resp']) && $_POST['resp'] == 1 && $queryEst->rowCount() > 0) {
        $rEst = $queryEst->fetch(PDO::FETCH_ASSOC); ?>
        <div class="row">
            <div class="col-12 col-sm-12 ">
                <div class="alert alert-warning alert-dismissible fade show mt-4 d-flex align-items-center" role="alert">
                    <i class="fa-solid fa-triangle-exclamation me-3 fa-xl"></i>
                        <div>
                        Tienes una cita pendiente por finalizar.<br> Por favor Recargue la página para finalizarla y poder crear una nueva cita.
                        </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <input type="hidden" id="id_est2" name="id_est2" value="<?php echo ($_POST['resp'] == 1) ? $rEst['id_est'] : ''; ?>">
            </div>
        </div>
    <?php } else { ?>
        <div class="alert alert-info alert-dismissible fade show mt-4 d-flex align-items-center" role="alert">
            <i class="fa-solid fa-circle-info me-3 fa-xl"></i>
                <div>
                    (*) Campo requerido
                </div>
        </div>

        <div class="row">
            <div class="col-12 col-sm-12">
                <label for="id_raz" class="form-label"><b>Razón Visita *</b></label>
                <select class="form-select" id="id_raz" name="id_raz" onchange="selectRaz(this.value)" required>
                    <?php if ($_POST['resp'] == 1) { ?>
                        <option value="0">Seleccionar</option>
                    <?php }
                    if (isset($_POST['resp']) && $_POST['resp'] == 2) { ?>
                        <option value="<?php echo $rRaz2['id_raz']; ?>"><?php echo $rRaz2['nom_raz']; ?></option>
                        <?php }
                    if (isset($_POST['resp']) && ($_POST['resp'] == 1 || $_POST['resp'] == 2)) {
                        $sqlRaz = "SELECT * FROM agen_raz WHERE id_raz != 1";
                        if (isset($_POST['resp']) && $_POST['resp'] == 2) {
                            $sqlRaz .= " AND id_raz != " . $rEst['id_raz'];
                        }
                        $queryRaz2 = $conexion->query($sqlRaz);
                        while ($rRaz = $queryRaz2->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $rRaz['id_raz']; ?>"><?php echo $rRaz['nom_raz']; ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 col-sm-12 text-center">
                <label for="nom_cli">
                    <h3>Datos de cliente</h3>
                    <hr class="mx-auto">
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12 mt-3">
                <label for="nom_cli" class="form-label">Cliente <span name="req" class="text-mq">*</span></label>
                <input type="text" class="form-control" id="nom_cli" name="nom_cli" required value="<?php echo ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4) ? $r['nom_cli'] : '';
                                                                                                    echo ($_POST['resp'] == 3 || $_POST['resp'] == 4) ? '" readonly="' : '' ?>" onkeyup="auto();">
                <input type="hidden" class="form-control" id="id_cli" name="id_cli" value="<?php echo ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4) ? $r['id_cli'] . '" readonly="' : ''; ?>">
            </div>
            <div class="col-md-6 col-sm-12 mt-3">
                <label for="dir_cli" class="form-label">Dirección <span name="req" class="text-mq">*</span></label>
                <input type="text" class="form-control" id="dir_cli" name="dir_cli" required value="<?php echo ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4) ? $r['dir_cli'] : '';
                                                                                                    echo ($_POST['resp'] == 3 || $_POST['resp'] == 4) ? '" readonly="' : '' ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12 mt-3">
                <label for="tel_cli" class="form-label">Teléfono <span name="req" class="text-mq">*</span></label>
                <input type="number" class="form-control" id="tel_cli" name="tel_cli" required value="<?php echo ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4) ? $r['tel_con'] : '';
                                                                                                        echo ($_POST['resp'] == 3 || $_POST['resp'] == 4) ? '" readonly="' : '' ?>">
            </div>
            <div class="col-md-6 col-sm-12 mt-3">
                <label for="tip_cliD" class="form-label">Tipo De CLiente <span name="req" class="text-mq">*</span></label>
                <select id="tip_cliD" name="tip_cliD" class="form-select" required>
                    <?php if ($_POST['resp'] == 1) { ?>
                    <option value="0">Seleccionar</option>
                    <?php }
                    if (isset($_POST['resp']) && $_POST['resp'] == 2) { ?>
                        <option value="<?php echo $rtip2['id_tipcli']; ?>"><?php echo $rtip2['nom_tipcli']; ?></option>
                        <?php }
                        while ($rtip = $querytip->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $rtip['id_tipcli']; ?>"><?php echo $rtip['nom_tipcli']; ?></option>
                        <?php } ?>
                </select>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 col-sm-12 text-center">
                <label for="con_cli" >
                    <h3>Datos de contacto</h3>
                    <hr class="mx-auto">
                </label>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6 col-sm-12 mt-3">
                <label for="con_cli" class="form-label">Contacto <span name="req" class="text-mq">*</span></label>
                <input type="text" class="form-control" id="con_cli" name="con_cli" required value="<?php echo ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4) ? $r['nom_con'] : ''; ?>">
            </div>

            <div class="col-md-6 col-sm-12 mt-3">
                <label for="eml_con" class="form-label">Correo <span name="req" class="text-mq">*</span></label>
                <input type="email" class="form-control" id="eml_con" name="eml_con" required onkeyup="actOjo(this.value)" value="<?php echo ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4) ? $r['eml_con'] : '';
                                                                                                                                    echo ($_POST['resp'] == 3 || $_POST['resp'] == 4) ? '" readonly="' : '' ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12 mt-3">
                <label for="carg_con" class="form-label">Cargo</label>
                <input type="text" class="form-control" id="carg_con" name="carg_con" value="<?php echo ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4) ? $r['carg_con'] : '';
                                                                                                echo ($_POST['resp'] == 3 || $_POST['resp'] == 4) ? '" readonly="' : '' ?>">
            </div>
            <?php if ($_POST['resp'] == 2) { ?>
                <div class="col-md-6 col-sm-12 mt-3">
                <label for="tip_llam" class="form-label">Resultado De LLamada <span name="req" class="text-mq">*</span></label>
                <select id="tip_llam" name="tip_llam" class="form-select" required>
                        <option value="0">Seleccionar</option>
                            <?php while ($r5 = $query5->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $r5['id_llam']; ?>"><?php echo $r5['nom_llamada']; ?></option>
                            <?php } ?>
                </select>
                </div>
            <?php }?>
        </div>
        <?php if ($_POST['resp'] == 2) { ?>
            <div class="row mt-5">
                <div class="col-12 col-sm-12 text-center ">
                    <label for="concl_agen">
                        <h3>Conclusiones para cliente y observaciones</h3>
                        <hr class="mx-auto">
                    </label>
                    <div class="alert alert-warning alert-dismissible fade show mt-4 d-flex align-items-center" role="alert">
                        <i class="fa-solid fa-triangle-exclamation me-3 fa-xl"></i>
                            <div>
                                <b>¡Advertencia!:</b> Ten en cuenta que estas conclusiones seran enviadas al correo del contacto (<span id="correoCli"><?php echo $r['eml_con']; ?></span>); Al correo de tú SAC (Representante de Servicio al Cliente), al Coordinador Nacional de Ventas y al Coordinador de Servicio al Cliente se enviaran las observaciones junto con las conclusiones.
                            </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php if ($r['id_raz'] != 1) { ?>
                    <div class="col-12 col-sm-12 mt-3">
                        <label for="concl_agen" class="form-label">Conclusiones de la visita</label>
                        <textarea class="form-control" id="concl_agen" name="concl_agen" placeholder="Escriba aqui las conclusiones de la visita como: acuerdos con el cliente"></textarea>
                    </div>
                <?php } ?>
                <br>
                <div class="col-12 col-sm-12 mt-3">
                    <label for="obs_agen" class="form-label">Observaciones de la visita</label>
                    <textarea class="form-control" id="obs_agen" name="obs_agen" placeholder="Escriba aqui observaciones como: ajustes, sugerencias"></textarea>
                </div>
                <div class="col-12 col-sm-12"><br>
                    <label class="btn btn-danger">
                        <input type="checkbox" id="correo" name="correo" onchange="checkMail(this.value)" value="0"> Correo a cliente
                    </label>
                </div>
            </div>
        <?php } ?>
        <input type="hidden" id="id_est" name="id_est" value="<?php if ($_POST['resp'] == 2) {
                                                                    echo $rEst['id_est'];
                                                                } else {
                                                                    echo '';
                                                                } ?>">
        <input type="hidden" id="lat_ini" name="lat_ini" value="">
        <input type="hidden" id="lon_ini" name="lon_ini" value="">
    <?php } ?>
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
    <input type="hidden" id="id_agen" name="id_agen" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5) {
                                                                echo $rEst['id_agen'];
                                                            } ?>">
</form>