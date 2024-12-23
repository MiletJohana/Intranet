<?php
include '../../conexion.php';
$conexion->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
if ($_POST['resp'] == 2) {
    $sql = "SELECT * FROM mq_usu WHERE id_usu=\"$_POST[id_usu]\"";
    $query = $conexion->query($sql);
    $r = $query->fetch(PDO::FETCH_ASSOC);
    $area = $r['id_are'];
    $sql2 = "SELECT * FROM mq_are WHERE id_are=$area";
    $query2 = $conexion->query($sql2);
    $sql22 = "SELECT * FROM mq_are WHERE id_are != 1 AND id_are!=$area";
    $query22 = $conexion->query($sql22);
    $reg = $r['id_reg'];
    $sql3 = "SELECT * FROM mq_reg WHERE id_reg=$reg";
    $query3 = $conexion->query($sql3);
    $sql33 = "SELECT * FROM mq_reg WHERE id_reg!=$reg";
    $query33 = $conexion->query($sql33);
    $rol = $r['id_rol'];
    $sql4 = "SELECT* FROM mq_rol";
    if ($rol != '') {
        $sql4 .= " WHERE id_rol=$rol";
    }
    $query4 = $conexion->query($sql4);
    $sql44 = "SELECT* FROM mq_rol";
    if ($rol != '') {
        $sql44 .= " WHERE id_rol!=$rol";
    }
    $query44 = $conexion->query($sql44);
    $grup = $r['grup_car'];
    $sqlGrupCot = "SELECT * FROM cot_tip_cotizador WHERE id_car BETWEEN 20 AND 25 ";
    if ($grup != '') {
        $sqlGrupCot .= " AND id_car=$grup";
    }
    $queryGrupCot = $conexion->query($sqlGrupCot);
    $sqlGrupCot2 = "SELECT * FROM cot_tip_cotizador WHERE id_car BETWEEN 20 AND 25";
    if ($grup != '') {
        $sqlGrupCot2 .= " AND id_car!=$grup";
    }
    $queryGrupCot2 = $conexion->query($sqlGrupCot2);
    $tipu = $r['id_tipu'];
    $sqlTipu = "SELECT * FROM cot_tip_usuario";
    if ($tipu != '') {
        $sqlTipu .= " WHERE id_tipu=$tipu";
    }
    $queryTipu = $conexion->query($sqlTipu);
    $sqlTipu2 = "SELECT * FROM cot_tip_usuario";
    if ($tipu != '') {
        $sqlTipu2 .= " WHERE id_tipu!=$tipu";
    }
    $queryTipu2 = $conexion->query($sqlTipu2);
    $tumq = $r['id_tipumq'];
    $sqlTumq = "SELECT * FROM mq_tip_usu";
    if ($tumq != '') {
        $sqlTumq .= " WHERE id_tipumq=$tumq";
    }
    $queryTumq = $conexion->query($sqlTumq);
    $sqlTumq2 = "SELECT * FROM mq_tip_usu";
    if ($tumq != '') {
        $sqlTumq2 .= " WHERE id_tipumq!=$tumq";
    }
    $queryTumq2 = $conexion->query($sqlTumq2);

    $cargo = $r['id_carg'];
    $sqlCargo = "SELECT * FROM ind_cargos";
    if ($cargo != '') {
        $sqlCargo .= " WHERE id_carg=$cargo;";
    }
    $queryCargo = $conexion->query($sqlCargo);
    $sqlCargo1 = "SELECT * FROM ind_cargos";
    if ($cargo != '') {
        $sqlCargo1 .= " WHERE id_carg!=$cargo;";
    }
    $queryCargo1 = $conexion->query($sqlCargo1);
    
    $num_perfil = $r['num_perfil'];
    $id_lider = $r['id_lider']; 
    //echo $num_perfil . ", ";
    //echo $id_lider;

    $sqlTipoUsu = "SELECT * FROM mq_usu";
    if ($num_perfil != '' && $id_lider != '') {
        $sqlTipoUsu .= " WHERE num_perfil = 2 AND id_usu = '$id_lider' AND usu_elim = '0';";
    }
    $queryTipoUsu = $conexion->query($sqlTipoUsu);
    $sqlTipoUsu1 = "SELECT * FROM mq_usu";
    if ($num_perfil != '' && $id_lider != '') {
        $sqlTipoUsu1 .= " WHERE num_perfil = 2 AND id_usu != '$id_lider' AND usu_elim = '0';";
    }
    $queryTipoUsu1 = $conexion->query($sqlTipoUsu1);
    
    

} else {
    $sql2 = "SELECT * FROM mq_are WHERE id_are != 1";
    $query2 = $conexion->query($sql2);
    $sql3 = "SELECT * FROM mq_reg";
    $query3 = $conexion->query($sql3);
    $sql4 = "SELECT * FROM mq_rol";
    $query4 = $conexion->query($sql4);
    $sql44 = "SELECT* FROM mq_rol";
    $query44 = $conexion->query($sql44);
    $sqlGrupCot = "SELECT * FROM cot_tip_cotizador WHERE id_car BETWEEN 20 AND 25";
    $queryGrupCot = $conexion->query($sqlGrupCot);
    $sqlTipu = "SELECT * FROM cot_tip_usuario";
    $queryTipu = $conexion->query($sqlTipu);
    $sqlTumq = "SELECT * FROM mq_tip_usu";
    $queryTumq = $conexion->query($sqlTumq);
    $sqlCargo = "SELECT * FROM ind_cargos";
    $queryCargo = $conexion->query($sqlCargo);
    $sqlTipoUsu = "SELECT id_usu, nom_usu FROM mq_usu WHERE num_perfil = 2 AND usu_elim = '0'; ";
    $queryTipoUsu = $conexion->query($sqlTipoUsu);
    //echo $sqlTipoUsu;
}
$sqlRolInv = "SELECT * FROM mq_rol_inv";
$queryRolInv = $conexion->query($sqlRolInv);
?>

<form class="row" role="form" id="form-usuario">
    <div class="row py-3">
        <div class="col-12 text-center">
            <h3 id="titleClie">
                <i class="fa-solid fa-address-card me-2"></i> Datos Generales
            </h3>
            <hr class="mx-auto" style="width:60%;">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <label class="form-label">Perfil</label><br>
            <label>
                <input type="radio" id="perf_usu" name="perfil_usu" value="1" <?php if ($_POST['resp'] == 2 && $r['num_perfil']==1) {
                                                                        echo 'checked';
                                                                    } ?> required onclick="changeOptions();">
                Usuario
            </label>
            <label >
                <input type="radio" id="perf_lid"  name="perfil_usu" value="2" <?php if ($_POST['resp'] == 2 && $r['num_perfil']==2) {
                                                                        echo 'checked';
                                                                    } ?> required onclick="changeOptions();">
                Líder
            </label>

        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 py-3">
            <label for="id_usu" class="form-label">Id (No. de Documento)</label>
            <input type="text" class="form-control" id="id_usu" name="id_usu" value="<?php echo ($_POST['resp'] == 2) ? $r['id_usu'] : '';  ?>" required onkeyup="verificar();">
            <div id="Info"></div>
        </div>
        <div class="col-md-6 col-sm-12 py-3">
            <label for="nom_usu" class="form-label">Nombres:</label>
            <input type="text" class="form-control" id="nom_usu" name="nom_usu" value="<?php echo ($_POST['resp'] == 2) ? $r['nom_usu'] : ''; ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-12 py-3">
            <label for="id_are" class="form-label">Área</label>
            <select class="form-select" id="id_are" name="id_are" required>
                <?php if ($_POST['resp'] == 1) { ?>
                    <option value="">Seleccione</option>
                <?php }
                while ($r2 = $query2->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $r2['id_are']; ?>"><?php echo $r2['nom_are']; ?></option>
                    <?php }
                if ($_POST['resp'] == 2) {
                    while ($r22 = $query22->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $r22['id_are']; ?>"><?php echo $r22['nom_are']; ?></option>
                <?php }
                } ?>
            </select>
        </div>
        <div class="col-md-4 col-sm-12 py-3">
            <label for="id_reg" class="form-label">Regional:</label>
            <select class="form-select" id="id_reg" name="id_reg" required>
                <?php if ($_POST['resp'] == 1) { ?>
                    <option value="">Seleccione</option>
                <?php } ?>
                <?php while ($r3 = $query3->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $r3['id_reg']; ?>"><?php echo $r3['nom_reg']; ?></option>
                    <?php }
                if ($_POST['resp'] == 2) {
                    while ($r33 = $query33->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $r33['id_reg']; ?>"><?php echo $r33['nom_reg']; ?></option>
                <?php }
                } ?>
            </select>
        </div>
        <div class="col-md-4 col-sm-12 py-3">
            <label for="id_tipumq" class="form-label">Tipo Usuario:</label>
            <select class="form-select" id="id_tipumq" name="id_tipumq" required>
                <?php if ($_POST['resp'] == 1) { ?>
                    <option value="">Seleccione</option>
                <?php } ?>
                <?php while ($rTUM = $queryTumq->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $rTUM['id_tipumq']; ?>"><?php echo $rTUM['nom_tip']; ?></option>
                    <?php }
                if ($_POST['resp'] == 2) {
                    while ($rTUM2 = $queryTumq2->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rTUM2['id_tipumq']; ?>"><?php echo $rTUM2['nom_tip']; ?></option>
                <?php }
                } ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 py-3">
            <label for="con_usu" class="form-label">Contraseña:</label>
            <input type="password" class="form-control" id="con_usu" name="con_usu" value="<?php echo ($_POST['resp'] == 2) ? '' : ''; ?>" required>
        </div>
        <div class="col-md-6 col-sm-12 py-3">
            <label for="eml_usu" class="form-label">Email:</label>
            <input type="email" class="form-control" id="eml_usu" name="eml_usu" value="<?php echo ($_POST['resp'] == 2) ? $r['eml_usu'] : ''; ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 py-3">
            <label for="usuario" class="form-label">Usuario:</label>
            <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo ($_POST['resp'] == 2) ? $r['usuario'] : ''; ?>" required>
        </div>
        <div class="col-md-6 col-sm-12 py-3">
            <label for="cel2_usu" class="form-label">Teléfono:</label>
            <input type="text" class="form-control" id="cel2_usu" name="cel2_usu" value="<?php echo ($_POST['resp'] == 2) ? $r['cel2_usu'] : ''; ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 py-3">
            <label class="form-label" for="ext_usu">Extensión:</label>
            <input type="text" class="form-control" id="ext_usu" name="ext_usu" value="<?php echo ($_POST['resp'] == 2) ? $r['ext_usu'] : ''; ?>" required>
        </div>
        <div class="col-md-6 col-sm-12 py-3">
            <label class="form-label" for="fec_firm">Fecha de firma de contrato:</label>
            <input type="date" class="form-control" id="fec_firm" name="fec_firm" value="<?php echo ($_POST['resp'] == 2) ? $r['fec_firm'] : ''; ?>" <?php echo ($_POST['resp'] == 2) ? "readonly" : ''; ?> required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 py-3">
            <label class="form-label" for="id_carg">Cargo:</label>
            <select class="form-select" id="id_carg" name="id_carg" required>
                <?php if ($_POST['resp'] == 1) { ?>
                    <option value="">Seleccione</option>
                <?php } ?>
                <?php while ($rCarg = $queryCargo->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $rCarg['id_carg']; ?>"><?php echo $rCarg['nom_carg']; ?></option>
                    <?php }
                if ($_POST['resp'] == 2) {
                    while ($rCarg1 = $queryCargo1->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rCarg1['id_carg']; ?>"><?php echo $rCarg1['nom_carg']; ?></option>
                <?php }
                } ?>
            </select>
        </div>
        <div class="col-md-6 col-sm-12 py-3">
            <label class="form-label" for="id_lider33">Lider:</label>
            <select class="form-select" id="id_lider33" name="id_lider33" required>
                <?php if ($_POST['resp'] == 1) { ?>
                    <option value="">Seleccione</option>
                <?php } ?>
                <?php while ($rTipoUsu = $queryTipoUsu->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $rTipoUsu['id_usu']; ?>"><?php echo $rTipoUsu['nom_usu']; ?></option>
                    <?php }
                if ($_POST['resp'] == 2) {
                    while ($rTipoUsu1 = $queryTipoUsu1->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rTipoUsu1['id_usu']; ?>"><?php echo $rTipoUsu1['nom_usu']; ?></option>
                <?php }
                } ?>
            </select>
        </div>
    
    </div>
    <div class ="row mt-5">
    <div class="col-12 text-center">
    </div>
    </div>
    <div class="row mt-4 mb-2">
        <div class="col-12 text-center">
            <h3>
                <i class="fa-solid fa-boxes-stacked me-2"></i> Inventarios
            </h3>
            <hr class="mx-auto" style="width:60%;">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 py-3" style="margin: 0 auto;">
            <label for="rol_inv" class="form-label">Rol:</label>
            <select class="form-select" id="rol_inv" name="rol_inv">
                <?php if ($_POST['resp'] == 1) { ?>
                    <option value="" selected>Seleccionar</option>
                <?php } 
                    foreach($queryRolInv->fetchAll(PDO::FETCH_ASSOC) as $rol){  ?>
                        <option value="<?php echo $rol['id_rol_inv']; ?>" <?php echo (isset($rol['id_rol_inv']) && isset($r['rol_inv']) && $rol['id_rol_inv'] == $r['rol_inv']) ? 'selected' : '' ?>><?php echo $rol['nom_rol_inv']; ?></option>
                <?php } ?>
        
            </select>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12 text-center">
            <h3 id="titleClie">
                <i class="fa-solid fa-receipt me-2"></i> Crédito
            </h3>
            <hr class="mx-auto" style="width:60%;">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 py-3" style="margin: 0 auto;">
            <label for="id_rol" class="form-label">Rol:</label>
            <select class="form-select" id="id_rol" name="id_rol">
                <option value="">Seleccione</option>
                <?php if ($_POST['resp'] == 1) { ?>
                   
                <?php }
                if ($_POST['resp'] == 2 && $r['id_rol'] == 0) { ?>
                    <option value="">Seleccione</option>
                    <?php 
                                                                                                                                                                                             
                    while ($r4 = $query4->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $r4['id_rol']; ?>"><?php echo ($r4['nom_rol']); ?></option>
                    <?php }
                }
                if ($_POST['resp'] == 1 || $_POST['resp'] == 2) {
                    while ($r44 = $query44->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $r44['id_rol']; ?>"><?php echo ($r44['nom_rol']); ?></option>
                <?php }
                } ?>
            </select>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12 text-center">
            <h3 id="titleClie">
                <i class="fa-solid fa-hand-holding-dollar me-2"></i> Cotizador
            </h3>
            <hr class="mx-auto" style="width:60%;">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 py-3">
            <label class="form-label" for="cel_usu">Celular:</label>
            <input type="text" class="form-control" id="cel_usu" name="cel_usu" value="<?php echo ($_POST['resp'] == 2) ? $r['cel_usu'] : ''; ?>">
        </div>
        <div class="col-md-6 col-sm-12 py-3">
            <label class="form-label" for="nom_cns">Nombre Cons:</label>
            <input type="text" class="form-control" id="nom_cns" name="nom_cns" value="<?php echo ($_POST['resp'] == 2) ? $r['nom_cns'] : ''; ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 py-3">
            <label class="form-label" for="cns_cotz">Consecutivo:</label>
            <input type="number" class="form-control" id="cns_cotz" name="cns_cotz" value="<?php echo ($_POST['resp'] == 2) ? $r['cns_cotz'] : ''; ?>" required>
        </div>
        <div class="col-md-6 col-sm-12 py-3">
            <label for="id_tipu" class="form-label">Tipo:</label>
            <select class="form-select" id="id_tipu" name="id_tipu">
                <?php if ($_POST['resp'] == 1) { ?>
                    <option value="">Seleccione</option>
                <?php }
                if ($_POST['resp'] == 2 && $r['id_tipu'] == 0) { ?>
                    <option value="">Seleccione</option>
                <?php }
                while ($rTU = $queryTipu->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $rTU['id_tipu']; ?>"><?php echo $rTU['nom_tipu']; ?></option>
                    <?php }
                if ($_POST['resp'] == 2) {
                    while ($rTU2 = $queryTipu2->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rTU2['id_tipu']; ?>"><?php echo $rTU2['nom_tipu']; ?></option>
                <?php }
                } ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 py-3">
            <label for="grup_car" class="form-label">Grupo:</label>
            <select class="form-select" id="grup_car" name="grup_car">
                <?php if ($_POST['resp'] == 1) { ?>
                    <option value="">Seleccione</option>
                <?php }
                if ($_POST['resp'] == 2 && $r['id_car'] == 0) { ?>
                    <option value="">Seleccione</option>
                <?php }
                while ($rGC = $queryGrupCot->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $rGC['id_car']; ?>"><?php echo $rGC['nom_car']; ?></option>
                    <?php }
                if ($_POST['resp'] == 2) {
                    while ($rGC2 = $queryGrupCot2->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rGC2['id_car']; ?>"><?php echo $rGC2['nom_car']; ?></option>
                <?php }
                } ?>
            </select>
        </div>
    </div>
    <input type="hidden" id="accion_form" name="action" value="<?php echo ($_POST['resp'] == 1) ? "add" : "update"; ?>">
    <div class="row">
        <div class="col-md-6 col-sm-12 py-3" id="error-validation"></div>
    </div>
</form>