<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
if (isset($_POST['id_agen']) && $_POST['id_agen'] != '') {
    $sqlAgen = "SELECT com.id_raz, com.eml_con, com.carg_con, cl.nom_cli, com.id_cli , cl.hor_cli, cl.tel_cli, com.dir_cli, cl.con_cli, com.nom_con, cl.eml_cli, cl.cargo_conta, com.id_tipcli
    FROM agen_com AS com 
    INNER JOIN mq_clie AS cl 
    ON com.id_cli = cl.id_cli 
    WHERE com.id_cli = cl.id_cli 
    AND id_agen = " . $_POST['id_agen'];
    $queryAgen = $conexion->query($sqlAgen);
    $r = $queryAgen->fetch_array();
}

$sqlEst = "SELECT * FROM agen_com WHERE id_est = 3 AND id_usu = " .$sesion_id;
$queryEst = $conexion->query($sqlEst);
//echo $sqlEst;
if (isset($_POST['resp']) && ($_POST['resp'] == 2 || $_POST['resp'] == 5)) {
    if ($queryEst->num_rows > 0) {
        $rEst = $queryEst->fetch_array();
        $sqlAgen = "SELECT com.id_raz, com.eml_con, com.carg_con, cl.nom_cli, com.id_cli , cl.hor_cli, cl.tel_cli, com.dir_cli, cl.con_cli, com.nom_con, cl.eml_cli, cl.cargo_conta, com.id_tipcli
        FROM agen_com AS com
        INNER JOIN mq_clie AS cl
        ON com.id_cli = cl.id_cli
        WHERE com.id_cli = cl.id_cli AND id_agen = " . $rEst['id_agen'];
        $queryAgen = $conexion->query($sqlAgen);
        $r = $queryAgen->fetch_array();
        //echo $sqlAgen;
    }
}
$sqlRaz = "SELECT * FROM agen_raz";
if (isset($_POST['resp']) && $_POST['resp'] == 2 && isset($rEst['id_raz'])) {
    $sqlRaz .= " WHERE id_raz=" . $rEst['id_raz'];
}
$queryRaz = $conexion->query($sqlRaz);
if (isset($_POST['resp']) && $_POST['resp'] == 2) {
    $rRaz2 = $queryRaz->fetch_array();
}
$sqltip="SELECT * FROM agen_tipclie";
if (isset($_POST['resp']) && $_POST['resp'] == 2 && isset($rEst['id_tipcli'])) {   
    $sqltip .= " WHERE id_tipcli=" . $rEst['id_tipcli'];
}
$querytip = $conexion->query($sqltip);
if (isset($_POST['resp']) && $_POST['resp'] == 2) {
    $rtip2 = $querytip->fetch_array();
}
$sql5="SELECT * FROM agen_tip_llamada";
$query5= $conexion->query($sql5);
//echo $sqlRaz;
?>
<form role="form" id="form-cita">
    <?php if (isset($_POST['resp']) && $_POST['resp'] == 5) { ?>
        <div class="form-row">
            <div class="col-md-12 col-sm-12">
                <h5>¿Está seguro de cancelar ésta cita?</h5>
                <label for="nom_cli">Motivo</label>
                <textarea class="form-control" id="obs_agenC" name="obs_agenC" placeholder="Escriba aqui el motivo por el cual desea cancelar la cita"></textarea>
                <input type="hidden" id="lat_fin" name="lat_fin" value="">
                <input type="hidden" id="lon_fin" name="lon_fin" value="">
            </div>
        </div>
    <?php } elseif (isset($_POST['resp']) && $_POST['resp'] == 1 && $queryEst->num_rows > 0) {
        $rEst = $queryEst->fetch_array(); ?>
        <div class="form-row">
            <div class="col-md-12 col-sm-12 ">
                <div class="alert alert-info alert-dismissible fade show mt-2 text-center" role="alert">
                    Tienes una cita pendiente por finalizar.<br> Por favor Recargue la página para finalizarla y poder crear una nueva cita.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" id="id_est2" name="id_est2" value="<?php echo ($_POST['resp'] == 1) ? $rEst['id_est'] : ''; ?>">
            </div>
        </div>
    <?php } else { ?>
        <div class="alert alert-warning" role="alert">
            (*) Campo requerido
        </div>
        <div class="form-row">
            <div class="col-md-12 col-sm-12">
                <label for="id_raz">Razón Visita *</label>
                <select class="form-control" id="id_raz" name="id_raz" onchange="selectRaz(this.value)" required>
                    <?php if ($_POST['resp'] == 1) { ?>
                        <option value="0">Seleccionar</option>
                    <?php }
                    if (isset($_POST['resp']) && $_POST['resp'] == 2) { ?>
                        <option value="<?php echo $rRaz2['id_raz']; ?>"><?php echo utf8_encode($rRaz2['nom_raz']); ?></option>
                        <?php }
                    if (isset($_POST['resp']) && ($_POST['resp'] == 1 || $_POST['resp'] == 2)) {
                        $sqlRaz = "SELECT * FROM agen_raz WHERE id_raz != 1";
                        if (isset($_POST['resp']) && $_POST['resp'] == 2) {
                            $sqlRaz .= " AND id_raz != " . $rEst['id_raz'];
                        }
                        $queryRaz2 = $conexion->query($sqlRaz);
                        while ($rRaz = $queryRaz2->fetch_array()) { ?>
                            <option value="<?php echo $rRaz['id_raz']; ?>"><?php echo utf8_encode($rRaz['nom_raz']); ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
        </div>
        <div class="form-row mt-4">
            <div class="col-md-12 col-sm-12 text-center">
                <label for="nom_cli">
                    <h3>Datos de cliente</h3>
                </label>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 col-sm-12">
                <label for="nom_cli">Cliente <span name="req">*</span></label>
                <input type="text" class="form-control" id="nom_cli" name="nom_cli" required value="<?php echo ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4) ? utf8_encode($r['nom_cli']) : '';
                                                                                                    echo ($_POST['resp'] == 3 || $_POST['resp'] == 4) ? '" readonly="' : '' ?>" onkeyup="auto();">
                <input type="hidden" class="form-control" id="id_cli" name="id_cli" value="<?php echo ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4) ? utf8_encode($r['id_cli']) . '" readonly="' : ''; ?>">
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="dir_cli">Dirección <span name="req">*</span></label>
                <input type="text" class="form-control" id="dir_cli" name="dir_cli" required value="<?php echo ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4) ? utf8_encode($r['dir_cli']) : '';
                                                                                                    echo ($_POST['resp'] == 3 || $_POST['resp'] == 4) ? '" readonly="' : '' ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 col-sm-12">
                <label for="tel_cli">Teléfono <span name="req">*</span></label>
                <input type="number" class="form-control" id="tel_cli" name="tel_cli" required value="<?php echo ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4) ? utf8_encode($r['tel_cli']) : '';
                                                                                                        echo ($_POST['resp'] == 3 || $_POST['resp'] == 4) ? '" readonly="' : '' ?>">
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="tip_cliD">Tipo De CLiente <span name="req">*</span></label>
                <select id="tip_cliD" name="tip_cliD" class="form-control" required>
                    <?php if ($_POST['resp'] == 1) { ?>
                    <option value="0">Seleccionar</option>
                    <?php }
                    if (isset($_POST['resp']) && $_POST['resp'] == 2) { ?>
                        <option value="<?php echo $rtip2['id_tipcli']; ?>"><?php echo utf8_encode($rtip2['nom_tipcli']); ?></option>
                        <?php }
                        while ($rtip = $querytip->fetch_array()) { ?>
                            <option value="<?php echo $rtip['id_tipcli']; ?>"><?php echo utf8_encode($rtip['nom_tipcli']); ?></option>
                        <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-row mt-4">
            <div class="col-md-12 col-sm-12 text-center">
                <label for="con_cli">
                    <h3>Datos de contacto</h3>
                </label>
            </div>
        </div>
        <div class="form-row">

            <div class="col-md-6 col-sm-12">
                <label for="con_cli">Contacto <span name="req">*</span></label>
                <input type="text" class="form-control" id="con_cli" name="con_cli" required value="<?php echo ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4) ? utf8_encode($r['nom_con']) : ''; ?>">
            </div>

            <div class="col-md-6 col-sm-12">
                <label for="eml_con">Correo <span name="req">*</span></label>
                <input type="email" class="form-control" id="eml_con" name="eml_con" required onkeyup="actOjo(this.value)" value="<?php echo ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4) ? utf8_encode($r['eml_con']) : '';
                                                                                                                                    echo ($_POST['resp'] == 3 || $_POST['resp'] == 4) ? '" readonly="' : '' ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 col-sm-12">
                <label for="carg_con">Cargo</label>
                <input type="text" class="form-control" id="carg_con" name="carg_con" value="<?php echo ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4) ? utf8_encode($r['carg_con']) : '';
                                                                                                echo ($_POST['resp'] == 3 || $_POST['resp'] == 4) ? '" readonly="' : '' ?>">
            </div>
            <?php if ($_POST['resp'] == 2) { ?>
                <div class="col-md-6 col-sm-12">
                <label for="tip_llam">Resultado De LLamada <span name="req">*</span></label>
                <select id="tip_llam" name="tip_llam" class="form-control" required>
                        <option value="0">Seleccionar</option>
                            <?php while ($r5 = $query5->fetch_array()) { ?>
                                <option value="<?php echo $r5['id_llam']; ?>"><?php echo utf8_encode($r5['nom_llamada']); ?></option>
                            <?php } ?>
                </select>
                </div>
            <?php }?>
        </div>
        <?php if ($_POST['resp'] == 2) { ?>
            <div class="form-row mt-4">
                <div class="col-md-12 col-sm-12 text-center">
                    <label for="concl_agen">
                        <h3>Conclusiones y observaciones</h3>
                    </label>
                    <div class="alert alert-danger" role="alert">
                        <b>¡Advertencia!:</b> Ten en cuenta que estas conclusiones seran enviadas al correo del contacto (<span id="correoCli"><?php echo utf8_encode($r['eml_con']); ?></span>); Al correo de tú SAC (Representante de Servicio al Cliente), al Coordinador Nacional de Ventas y al Coordinador de Servicio al Cliente se enviaran las observaciones junto con las conclusiones.
                    </div>
                </div>
            </div>
            <div class="form-row">
                <?php if ($r['id_raz'] != 1) { ?>
                    <div class="col-md-12 col-sm-12">
                        <label for="concl_agen">Conclusiones de la visita</label>
                        <textarea class="form-control" id="concl_agen" name="concl_agen" placeholder="Escriba aqui las conclusiones de la visita como: acuerdos con el cliente"></textarea>
                    </div>
                <?php } ?>
                <br>
                <div class="col-md-12 col-sm-12">
                    <label for="obs_agen">Observaciones de la visita</label>
                    <textarea class="form-control" id="obs_agen" name="obs_agen" placeholder="Escriba aqui observaciones como: ajustes, sugerencias"></textarea>
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