<?php
include "../../conexion.php";
include '../../resources/template/credentials.php';

if ($_POST['resp'] == 25) {
    $sql2 = "SELECT * FROM mq_are  WHERE id_are = (SELECT id_are FROM ind_desc WHERE id_desc = '" . $_POST['edit'] . "')";
    $query2 = $conexion->query($sql2);
    $sql22 = "SELECT * FROM mq_are  WHERE id_are != (SELECT id_are FROM ind_desc WHERE id_desc = '" . $_POST['edit'] . "')";
    $query22 = $conexion->query($sql22);

    $sql3 = "SELECT * FROM mq_usu WHERE id_usu = (SELECT id_usus FROM ind_desc WHERE id_desc = '" . $_POST['edit'] . "')";
    $query3 = $conexion->query($sql3);
    $sql33 = "SELECT * FROM mq_usu WHERE id_usu != (SELECT id_usus FROM ind_desc WHERE id_desc = '" . $_POST['edit'] . "')";
    $query33 = $conexion->query($sql33);

    $sqlTDesc = "SELECT * FROM ind_desc_tip WHERE id_tip_desc = (SELECT id_tip_desc FROM ind_desc WHERE id_desc = '" . $_POST['edit'] . "')";
    $queryTDes = $conexion->query($sqlTDesc);
    $sqlTDesc2 = "SELECT * FROM ind_desc_tip WHERE id_tip_desc != (SELECT id_tip_desc FROM ind_desc WHERE id_desc = '" . $_POST['edit'] . "')";
    $queryTDes2 = $conexion->query($sqlTDesc2);

    $sqlDesc = "SELECT * FROM ind_desc WHERE id_desc = " . $_POST['edit'];
    $queryDesc = $conexion->query($sqlDesc);
    $rDesc = $queryDesc->fetch(PDO::FETCH_ASSOC);

    $sqlCuo = "SELECT * FROM ind_des_cuo WHERE id_desc = " . $_POST['edit'];
    $queryCuo = $conexion->query($sqlCuo);
} else {
    $sql2 = "SELECT * FROM mq_are  WHERE id_are != 10";
    $query2 = $conexion->query($sql2);

    $sql3 = "SELECT * FROM mq_usu";
    $query3 = $conexion->query($sql3);
    
    $sqlTDesc = "SELECT * FROM ind_desc_tip";
    $queryTDes = $conexion->query($sqlTDesc);
}
if ($_SESSION['cargo'] == 550 || $_SESSION['cargo'] == 124 || $_SESSION['cargo'] == 17004) {
    $tele = true;
} else {
    $tele = false;
}

?>
<form role="form" id="form-desc">
    <div class="row">
        <div class="col-12 text-center">
            <h3>Datos del solicitante</h3>
            <hr class="mx-auto" style="width:60%;">
        </div>
    </div>
    <input type="hidden" id="accion-form" name="action" value="<?php if ($_POST['resp'] == 24) {
                                                                    echo "insDesc";
                                                                } else {
                                                                    echo 'editDesc';
                                                                } ?>">
    <input type="hidden" id="id_desc" name="id_desc" value="<?php if (isset($_POST['edit'])) {
                                                                echo $_POST['edit'];
                                                            } ?>">
    <?php if ($sesion_reg == 1) { ?>
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="id_are" class="form-label">Área</label>
                <select class="form-select" id="id_are" name="id_are" onchange="usuarios(1, this.value);" required <?php if ($_POST['resp'] == 25) {
                                                                                                                        echo '';
                                                                                                                    } ?>>
                    <?php if ($_POST['resp'] == 24) { ?>
                        <option value=""> Seleccionar </option>
                        <?php while ($r2 = $query2->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $r2['id_are']; ?>"><?php echo $r2['nom_are']; ?> </option>
                        <?php }
                    } else if ($_POST['resp'] == 25) {
                        while ($r2 = $query2->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $r2['id_are']; ?>"><?php echo $r2['nom_are']; ?></option>
                        <?php }
                        while ($r22 = $query22->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $r22['id_are']; ?>"><?php echo $r22['nom_are']; ?></option>
                    <?php }
                    } ?>
                </select>
            </div>

            <div class="col-md-6 col-sm-12 mb-3">
                <label for="id_usus" class="form-label">Usuario</label>
                <select class="form-select" id="id_usus" name="id_usus" value="" required onchange="usuarios(2, this.value)" <?php if ($_POST['resp'] == 25) {
                                                                                                                                    echo '';
                                                                                                                                } ?>>
                    <?php if ($_POST['resp'] == 24) { ?>
                        <option value=""> Seleccione el área</option>
                        <?php } else {
                        while ($r3 = $query3->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $r3['id_usu']; ?>"><?php echo $r3['nom_usu']; ?> </option>
                            <?php }
                        if ($_POST['resp'] == 25) {
                            while ($r33 = $query33->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $r33['id_usu']; ?>"><?php echo $r33['nom_usu']; ?></option>
                    <?php }
                        }
                    } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="conc_desc" class="form-label">Entidad</label>
                <input type="text" class="form-control" id="conc_desc" name="conc_desc" required value="<?php if ($_POST['resp'] == 25) {
                                                                                                            echo $rDesc['conc_desc'];
                                                                                                        } ?>">
            </div>
            <?php if ($tele == false) { ?>
                <div class="col-md-6 col-sm-12 mb-3">
                    <label for="id_tip_desc" class="form-label">Tipo Descuento</label>
                    <select class="form-select" id="id_tip_desc" name="id_tip_desc" value="" required onchange="habilitarOtro(this.value, 0)">
                        <?php if ($_POST['resp'] == 24) { ?>
                            <option value=""> Seleccionar </option>
                            <?php while ($rTDesc = $queryTDes->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $rTDesc['id_tip_desc']; ?>"><?php echo $rTDesc['tip_desc']; ?></option>
                            <?php }
                        }
                        if ($_POST['resp'] == 25) {
                            while ($rTDesc = $queryTDes->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $rTDesc['id_tip_desc']; ?>"><?php echo $rTDesc['tip_desc']; ?></option>
                            <?php }
                            while ($rTDesc2 = $queryTDes2->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $rTDesc2['id_tip_desc']; ?>"><?php echo $rTDesc2['tip_desc']; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
        </div>
        <div class="row">       
            <div class="none col-md-6 col-sm-12 mb-3" id="div_otro_tip">
                <label for="otro_tip" class="form-label">¿Cúal?</label>
                <input type="text" class="form-control" id="otro_tip" name="otro_tip" <?php if ($_POST['resp'] == 25) {
                                                                                            if (isset($rDesc['otro_tip_desc']) && $rDesc['otro_tip_desc'] != "") {
                                                                                                echo "value='" . $rDesc['otro_tip_desc'] . "'";
                                                                                            } else {
                                                                                                echo 'readonly';
                                                                                            }
                                                                                        } else {
                                                                                            echo "value='' readonly";
                                                                                        } ?>>
            </div>
            <?php } ?>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="fact_desc" class="form-label">N° Factura </label>
                <input type="text" class="form-control" id="fact_desc" name="fact_desc"  value="<?php if ($_POST['resp'] == 25) {
                                                                                                        echo $rDesc['fact_desc'];
                                                                                                        } ?>">
            </div>
        </div>
    <?php } else { ?>
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="pass" class="form-label">(Valide su contraseña)</label>
                <input type="password" class="form-control" id="pass" name="pass" value="" onkeyup="verificar(this.value, <?php echo $sesion_id; ?>)" <?php if ($_POST['resp'] == 25) {
                                                                                                                                                            echo 'readonly';
                                                                                                                                                        } else {
                                                                                                                                                            echo 'required';
                                                                                                                                                        } ?>>
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="conc_desc" class="form-label">Entidad</label>
                <input type="text" class="form-control" id="conc_desc" name="conc_desc" required value="<?php if ($_POST['resp'] == 25) {
                                                                                                            echo $rDesc['conc_desc'];
                                                                                                        } ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="id_tip_desc" class="form-label">Tipo Descuento</label>
                <select class="form-select" id="id_tip_desc" name="id_tip_desc" value="" required>
                    <?php if ($_POST['resp'] == 24) { ?>
                        <option value=""> Seleccionar </option>
                        <?php while ($rTDesc = $queryTDes->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $rTDesc['id_tip_desc']; ?>"><?php echo $rTDesc['tip_desc']; ?></option>
                        <?php }
                    }
                    if ($_POST['resp'] == 25) {
                        while ($rTDesc = $queryTDes->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $rTDesc['id_tip_desc']; ?>"><?php echo $rTDesc['tip_desc']; ?></option>
                        <?php }
                        while ($rTDesc2 = $queryTDes2->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $rTDesc2['id_tip_desc']; ?>"><?php echo $rTDesc2['tip_desc']; ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
        </div>
        <div class="alert alert-warning alert-dismissible fade show mt-4 d-flex align-items-center" role="alert">
            <i class="fa-solid fa-triangle-exclamation me-3 fa-xl"></i>
                <div>
                Recuerde que autoriza a MASTER QUIMICA S.A.S para que de conformidad con el Articulo 18 de la ley 1429 de 2010 ,
                deduzca de su salario la suma $<span id="infoDesc">0</span>. Dejo constancia igualmentede que mi EMPLEADOR ha observado en el presente
                descuento lo previsto en la norma citada y que presente descuento no se encuentra incluido dentro de los DESCUENTOS
                PROHIBIDOS de que trata la ley en mención. En caso de mi retiro, AUTORIZO que el saldo adecuado sea descontando
                de mi Liquidación Final de prestaciones Sociales, salarios, vacaciones, auxilios legales y extralegales
                </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <div class="row mt-5">
        <div class="col-md-12 text-center">
            <h3>Datos del solicitante</h3>
            <hr class="mx-auto" style="width:60%;">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-12 mb-3">
            <label for="val_desc" class="form-label">Valor de Descuento</label>
            <input type="number" class="form-control" id="val_desc" name="val_desc" onkeyup="cambiarInfo(this.value)" required <?php if ($_POST['resp'] == 25) {
                                                                                                                                    echo "value='" . $rDesc['val_desc'] . "'";
                                                                                                                                } ?>>
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            <label for="cant" class="form-label">Cuotas</label>
            <input type="number" class="form-control" id="cant" name="cant" required min="1" <?php if ($tele == true) {
                                                                                                    echo "max='3' onkeyup='activarCalcular(0)'";
                                                                                                } else if ($sesion_are == 9 || $sesion_lid == 1 || $sesion_reg != 1) {
                                                                                                    echo "max='120' onkeyup='activarCalcular(1)'";
                                                                                                }
                                                                                                if ($_POST['resp'] == 25) {
                                                                                                    echo "value='" . $rDesc['cuo_des'] . "'";
                                                                                                }?>>
        </div>
        <?php if (($sesion_are == 9 || $sesion_lid == 1) || ($tele == true) || $sesion_reg != 1) { ?>
            <div class="col-md-4 col-sm-12 mb-3">
                <br>
                <input type="button" onclick="calcularCuotas(val_desc.value, cant.value)" class="btn btn-success" id="calcular" value="Calcular" disabled="disabled">
                <input type="button" onclick="cleanTable()" class="btn btn-danger" id="limpiar" value="Limpiar" <?php if ($_POST['resp'] != 25) {
                                                                                                                                echo "disabled='disabled'";
                                                                                                                            } ?>>
            </div>
        <?php } ?>
        <?php include 'cuotas.php'; ?>
    </div>
</form>

<!--La variable $tele se utiliza para saber si la persona en sesión es de telemercadeo o ventas internas "true" y si no "false" -->