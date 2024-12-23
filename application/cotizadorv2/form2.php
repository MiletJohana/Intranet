<?php
include '../../conexion.php';
include "../../resources/template/credentials.php";
if (isset($_POST['edit']) && $_POST['edit'] != '' && $_POST['resp'] == 16) {
    $sql1 = "SELECT * 
    FROM cot_cotizaciones AS cot
    INNER JOIN cot_tip_cotizacion AS tip
    ON cot.id_tip_cot = tip.id_tip_cot
    INNER JOIN mq_clientes AS cli
    ON cot.id_cli = cli.id_cli
    INNER JOIN contactos AS con
    ON cot.id_cont = con.id_cont
    WHERE cot.id_coti = " . $_POST['edit'];
    $query = $conexion->query($sql1);
    $person = null;
    if ($query->rowCount() > 0) {
        while ($r = $query->fetch(PDO::FETCH_OBJ)) {
            $person = $r;
            break;
        }
    }
}
?>
<form role="form" id="form-SubCoti">
    <?php if (isset($_POST['resp']) && $_POST['resp'] == 16) { ?>
        <div class="row">
            <div class="col-12 text-center">
                <h3>Actualizar Cotización</h3>
                <hr class="mx-auto" style="width:60%;">
            </div>
        </div>
    <?php } else { ?>
        <div class="row">
            <div class="col-12 text-center">
                <h3>Subir Cotización</h3>
                <hr class="mx-auto" style="width:60%;">
            </div>
        </div>
    <?php } ?>

    <div class="row">
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="nom_cli" class="form-label">Cliente</label>
            <input type="text" id="nom_cli" name="nom_cli" class="form-control" onkeyup="auto(1)" value="<?php if (isset($_POST['edit']) && $_POST['resp'] == 16) {
                                                                                                                echo $person->nom_cli;
                                                                                                            } ?>" required>
            <input type="hidden" id="id_cli" name="id_cli" value="<?php if (isset($_POST['edit']) && $_POST['resp'] == 16) {
                                                                        echo $person->id_cli;
                                                                    } ?>">
            <input type="hidden" class="form-control" id="id_coti" name="id_coti" value="<?php if (isset($_POST['edit']) && $_POST['resp'] == 16) {
                                                                                                echo $person->id_coti;
                                                                                            } ?>">
        </div>
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="id_cont" class="form-label">Contacto</label>
            <select class="form-select" id="id_cont" name="id_cont" required>
                <?php if (!isset($_POST['edit'])) { ?>
                    <option value="">Seleccione contacto</option>
                <?php } elseif (isset($_POST['edit']) && $_POST['resp'] != 16) { ?>
                    <option value="">Seleccione contacto</option>
                <?php } else { ?>
                    <option value=" <?php echo $person->id_cont; ?>">
                        <?php echo $person->nom_cont; ?>
                    </option>
                <?php
                    $sqlCont = "SELECT `id_cont`, `nom_cont` 
                                FROM `cot_contactos` WHERE id_cli=$person->id_cli and id_cont!=$person->id_cont";

                    $queryCont = $conexion->query($sqlCont);
                    $rCount = $queryCont->rowCount();

                    if ($rCount > 0) {
                        while ($rCont = $queryCont->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . $rCont['id_cont'] . '">' . $rCont["nom_cont"] . '</option>';
                        }
                    } else {
                        echo '<option value="">No hay contactos</option>';
                    }
                }
                ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <label for="dia_ent" class="form-label">Días de entrega</label>
            <input type="text" id="dia_ent" name="dia_ent" class="form-control" value="<?php if (isset($_POST['edit']) && $_POST['resp'] == 16) {
                                                                                            echo $person->dia_ent;
                                                                                        } ?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <label for="for_pag" class="form-label">Forma de pago</label>
            <input type="text" id="for_pag" name="for_pag" class="form-control" value="<?php if (isset($_POST['edit']) && $_POST['resp'] == 16) {
                                                                                            echo $person->for_pag;
                                                                                        } ?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <label for="cost_cot" class="form-label">Costo total</label>
            <input type="text" class="form-control" name="cost_cot" id="cost_cot" value="<?php if (isset($_POST['edit']) && $_POST['resp'] == 16) {
                                                                                                echo $person->cost_cot;
                                                                                            } ?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <label for="tip_cot" class="form-label">Tipo de cotización</label>
            <select class="form-select" id="tip_cot" name="tip_cot" required>
                <?php if (!isset($_POST['edit'])) { ?>
                    <option value="">Selecciona</option>
                <?php
                    $sqlTipCot = "SELECT * FROM cot_tip_cotizacion WHERE id_tip_cot IN(2,6,5,9,3)";
                    $queryTipCot = $conexion->query($sqlTipCot);
                } elseif (isset($_POST['edit']) && $_POST['resp'] != 16) { ?>
                    <option value="">Tipo de cotización</option>
                <?php
                    $sqlTipCot = "SELECT * FROM cot_tip_cotizacion WHERE id_tip_cot IN(2,6,5,9,3)";
                    $queryTipCot = $conexion->query($sqlTipCot);
                } else {
                    $sqlTipCot2 = "SELECT * FROM cot_tip_cotizacion WHERE id_tip_cot =$person->id_tip_cot";
                    $queryTipCot2 = $conexion->query($sqlTipCot2);
                    $rTipCot2 = $queryTipCot2->fetch(PDO::FETCH_ASSOC);
                ?>
                    <option value="<?php echo $rTipCot2['id_tip_cot']; ?>"><?php echo $rTipCot2['nom_tip_cot']; ?></option>
                <?php
                    $sqlTipCot = "SELECT * FROM cot_tip_cotizacion WHERE id_tip_cot IN($person->id_tip_cot,2,6,5,9,3)";
                    $queryTipCot = $conexion->query($sqlTipCot);
                }
                while ($rTipCot = $queryTipCot->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $rTipCot['id_tip_cot']; ?>"><?php echo $rTipCot['nom_tip_cot']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 mb-3">
            <label>Documento</label>
            <br>
            <div class="fileUpload btn btn-primary">
                <span id="perm1"> Selecciona</span>
                <input type="file" id="docum" name="docum" accept="application/pdf" class="upload" <?php if (isset($person->doc_coti) && $person->doc_coti != '') {
                                                                                                        } else {
                                                                                                            echo 'required';
                                                                                                        } ?>>
                <div>
                    <script type="text/javascript">
                        document.getElementById('docum').onchange = function() {
                            console.log(this.value);
                            document.getElementById('fichero').innerHTML = document.getElementById('docum').files[0].name;
                        }
                    </script>
                </div>
            </div>
        </div>
        <?php if (isset($_POST['edit']) && $_POST['resp'] == 16) { ?>
            <div class="col-md-3">
                <label>Documento Actual</label>
                <a href="../../documentos/cotizador/docs/<?php echo $person->doc_coti; ?>" target="blank"><br>
                    <img src="../../resources/img/imagenpdf.png" style="width:40px;">
                    <p class="form-label" style="font-size:10px;"><em><?php echo $person->doc_coti; ?></em></p>
                    <input type="hidden" id="documActu" name="documActu" value="<?php echo $person->doc_coti; ?>">
                </a>
            </div>
        <?php } ?>
    </div>
    <input type="hidden" id="action" name="action" value="<?php if ($_POST['resp'] == 16) {
                                                                echo 'updateSubCoti';
                                                            } else {
                                                                echo 'addSubCot';
                                                            } ?>">
</form>