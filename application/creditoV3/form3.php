 <?php
include '../../conexion.php';

if (isset($_POST['id_sol']) && $_POST['id_sol'] != '') {
    if (isset($_POST['id_cli']) && $_POST['id_cli'] != '') {
        
        $sqlCli = "SELECT * FROM mq_clientes where id_cli=" . $_POST['id_cli'];
        $queryCli = $conexion->query($sqlCli);
        while ($r = $queryCli->fetch(PDO::FETCH_OBJ)) {
            $cli = $r;
            break;
        }

    } else {
        $sqlSol1 = "SELECT id_cli FROM cre_solicitud where id_sol=" . $_POST['id_sol'];
        $querySol1 = $conexion->query($sqlSol1);
        while ($r = $querySol1->fetch(PDO::FETCH_OBJ)) {
            $s = $r;
            break;
        }
    }
    /*$sqlClie = "SELECT * FROM mq_clientes, mq_usu,cre_solicitud  where cre_solicitud.rep_sac=mq_usu.id_usu ";
    $queryClie = $conexion->query($sqlClie);
    while ($r = $queryClie->fetch(PDO::FETCH_OBJ)) {
        $clie = $r;
        break;
    }

    $sqlCl2 = "SELECT * FROM mq_clientes, mq_usu,cre_solicitud  where mq_clientes.rep_sac=mq_usu.id_usu AND mq_clientes.id_cli='$s->id_cli' GROUP BY mq_clientes.id_cli";
    $queryCl2 = $conexion->query($sqlCl2);
    while ($r = $queryCl2->fetch(PDO::FETCH_OBJ)) {
        $cl2 = $r;
        break;
    }*/
    $segm_cliente = $sol->segm_clie;
    $sqlSegmento = "SELECT * FROM credit_segmento";
    if ($segm_cliente != '') {
        $sqlSegmento .= " WHERE id_segmento = '".$segm_cliente."';";
    }
    $querySegmento = $conexion->query($sqlSegmento);
    while ($regS = $querySegmento->fetch(PDO::FETCH_OBJ)) {
        $segmento = $regS;
        break;
    }

    $sqlSegmento1 = "SELECT * FROM credit_segmento";
    if ($segm_cliente != '') {
        $sqlSegmento1 .= " WHERE id_segmento != ".$segm_cliente.";";
    }
    $querySegmento1 = $conexion->query($sqlSegmento1);

    $id_conceptoATC = $sol->congen_ase;
    $sqlConceptoATC = "SELECT * FROM credit_concepAt";
    if ($id_conceptoATC != '') {
        $sqlConceptoATC .= " WHERE id_conAt = '".$id_conceptoATC."';";
    }
    $queryConceptoATC = $conexion->query($sqlConceptoATC);
    while ($regC = $queryConceptoATC->fetch(PDO::FETCH_OBJ)) {
        $conceptoATC = $regC;
        break;
    }

    $sqlConceptoATC1 = "SELECT * FROM credit_concepAt";
    if ($id_conceptoATC != '') {
        $sqlConceptoATC1 .= " WHERE id_conAt != ".$id_conceptoATC.";";
    }
    $queryConceptoATC1 = $conexion->query($sqlConceptoATC1);
} else{
    $sqlSegmento = "SELECT * FROM credit_segmento";
    $querySegmento = $conexion->query($sqlSegmento);

    $sqlConceptoATC = "SELECT * FROM credit_concepAt";
    $queryConceptoATC = $conexion->query($sqlConceptoATC);
}
?>
<div class="row mt-5">
    <div class="col-12 text-center">
        <h3>Espacio para el área de Ventas</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <p class="form-label">Tipo de Cliente</p>
        <div class="form-check">
            <input type="radio" class="form-check-input" name="tipCli" id="tipCli1" value="Desconocido" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $cli->tip_clie == 'Desconocido') {
                                                                                                                echo 'checked';
                                                                                                            } 
                                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                                echo ' disabled';
                                                                                                            }
                                                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                                echo ' disabled';
                                                                                                            }?>>
            <label class="form-check-label" for="tipCli1">
                Desconocido
            </label>
        </div>
        <div class="form-check">
            <input type="radio" class="form-check-input" name="tipCli" id="tipCli2" value="Conocido" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $cli->tip_clie == 'Conocido') {
                                                                                                            echo 'checked';
                                                                                                        } 
                                                                                                        if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                            echo ' disabled';
                                                                                                        }
                                                                                                        if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                            echo ' disabled';
                                                                                                        }?>>
            <label class="form-check-label" for="tipCli2">
                Conocido
            </label>
        </div>
        <div class="form-check">
            <input type="radio" class="form-check-input" name="tipCli" id="tipCli3" value="Gran Empresa" <?php if (($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) && $cli->tip_clie == 'Gran Empresa') {
                                                                                                                echo 'checked';
                                                                                                            } 
                                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                                echo ' disabled';
                                                                                                            }
                                                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                                echo ' disabled';
                                                                                                            }?>>
            <label class="form-check-label" for="tipCli3">
                Gran Empresa
            </label>
        </div>
    </div>
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="segCl" class="form-label">Segmento del cliente</label>
        <select id="segCl" name="segCl" class="form-select" required <?php if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                echo ' disabled';
                                                                            }
                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                echo ' disabled';
                                                                            } ?>>
            <?php if ($_POST['resp'] == 1) { ?>
                <option value="">Seleccione</option>
                <?php while ($rSegmento = $querySegmento->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $rSegmento['id_segmento']; ?>"><?php echo $rSegmento['nom_segmento']; ?></option>
                <?php }
                } if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) { ?>
                <option value="<?php echo $segmento->id_segmento; ?>"><?php echo $segmento->nom_segmento; ?></option>
                <?php if ((isset($_POST['id_est']) && ($_POST['id_est'] == 7 || $_POST['id_est'] == 8))) { 
                    while ($rSegmento1 = $querySegmento1->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rSegmento1['id_segmento']; ?>"><?php echo $rSegmento1['nom_segmento']; ?></option>
                    <?php }
                    }
                } ?>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="conAt" class="form-label">Concepto del ATC</label>
        <select id="conAt" name="conAt" class="form-select" required <?php if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                echo ' disabled';
                                                                            }
                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                echo ' disabled';
                                                                            } ?>>
            <?php if ($_POST['resp'] == 1) { ?>
                <option value="">Seleccione</option>
                <?php while ($rConcepto = $queryConceptoATC->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $rConcepto['id_conAt']; ?>"><?php echo $rConcepto['nom_conAt']; ?></option>
                <?php }
                } if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) { ?>
                <option value="<?php echo $conceptoATC->id_conAt; ?>"><?php echo $conceptoATC->nom_conAt; ?></option>
                <?php if ((isset($_POST['id_est']) && ($_POST['id_est'] == 7 || $_POST['id_est'] == 8))) { 
                    while ($rConcepto1 = $queryConceptoATC1->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rConcepto1['id_conAt']; ?>"><?php echo $rConcepto1['nom_conAt']; ?></option>
                    <?php }
                    }
                } ?>
        </select>
    </div>
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="CupAtc" class="form-label">Cupo de credito sugerido por ATC</label>
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
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="PlazAt" class="form-label">Plazo de pago sugerido por ATC</label>
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
    <div class="col-md-6 col-sm-12 mb-3">
        <label for="nomAse" class="form-label">Asesor Técnico comercial</label>
        <div class="input-group">
			<span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
            <input type="text" class="form-control" id="nomAse" name="nomAse" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                    echo $sol->nom_atc;
                                                                                                }
                                                                                                if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                    echo '" readonly="';
                                                                                                }
                                                                                                if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                    echo '" readonly="';
                                                                                                } ?>" required onkeyup="auto(2);">
            <input type="hidden" class="form-control" id="aseCom" name="aseCom" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
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
</div>
<div class="row">
    <?php if ($_SESSION['rol'] == 500 || $_SESSION['rol'] == 400 || $_SESSION['rol'] == 300 || $_SESSION['rol'] == 200) { ?>
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="nomSac" class="form-label">Servicio Al Cliente</label>
            <div class="input-group">
			    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>  
                <input type="text" class="form-control" id="nomSac" name="nomSac" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                        echo $sol->nom_sac;
                                                                                                    }
                                                                                                    if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                        echo '" readonly="';
                                                                                                    }
                                                                                                    if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                        echo '" readonly="';
                                                                                                    } ?>" onkeyup="auto(3);">
                <input type="hidden" class="form-control" id="aseSac" name="aseSac" value="<?php if ($_POST['resp'] == 2 || $_POST['resp'] == 3 || $_POST['resp'] == 4 || $_POST['resp'] == 5 || $_POST['resp'] == 7 || $_POST['resp'] == 8) {
                                                                                                echo $sol->rep_sac;
                                                                                            }
                                                                                            if ((isset($_POST['id_est']) && ($_POST['id_est'] != 7 || $_POST['id_est'] != 8) && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 300))) {
                                                                                                echo '" readonly="';
                                                                                            }
                                                                                            if (isset($_POST['id_est']) && ($_POST['id_est'] == 3 || $_POST['id_est'] == 2 ||  $_POST['id_est'] == 8 || $_POST['id_est'] == 4 || $_POST['id_est'] == 1) && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 500)) {
                                                                                                echo '" readonly="';
                                                                                            } ?>">
            </div>
        </div>
    <?php } ?>
</div>
<div class="row">
    <div class="col-12 mb-3">
        <label for="just" class="form-label">Justificación del cupo y plazo</label>
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
    <div class="col-12 mb-3">
        <label for="ana_ref" class="form-label">Análisis de Referencias (Proveedores Similares a MQ)</label>
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
<div class="row mt-4 mb-3">
    <?php if ($_POST['resp'] == 1) { ?>
        <div class="col-md-4 col-sm-12 text-center">
            <li class="alert alert-warning" id="archivo1">
                Certificado de constitución y gerencia con fecha de expedición no mayor a <b>60</b> días
                <div class="fileUpload btn btn-warning mt-2" id="btn_archivo1">
                    <span id="cer_co">Seleccionar</span>
                    <input type="file" name="certCon" id="certCon" class="upload" accept="multipart/form-data">
                    <div>
                        <script type="text/javascript">
                            document.getElementById('certCon').onchange = function() {
                                let archivoOpcion = validarSize('certCon');
                                if(archivoOpcion == 1){
                                    console.log(this.value);
                                    document.getElementById('cer_co').innerHTML = document.getElementById('certCon').files[0].name;
                                    cambiarColor(1, 'success');
                                }
                                else{
                                    alertWarningSize();
                                    document.getElementById('certCon').value = '';
                                }
                            }

                        </script>
                    </div>
                </div>
            </li>
        </div>
        <div class="col-md-4 col-sm-12 text-center">
            <li class="alert alert-warning" id="archivo2">
                Copia del RUT
                <div>
                    <div class="fileUpload btn btn-warning mt-2" id="btn_archivo2">
                        <span id="cop_u">Seleccionar</span>
                        <input type="file" name="copRu" id="copRu" class="upload" accept="multipart/form-data">
                        <div>
                            <script type="text/javascript">
                                document.getElementById('copRu').onchange = function() {
                                    let archivoOpcion = validarSize('copRu');
                                    if(archivoOpcion == 1){
                                        console.log(this.value);
                                        document.getElementById('cop_u').innerHTML = document.getElementById('copRu').files[0].name;
                                        cambiarColor(2, 'success');
                                    }
                                    else{
                                        alertWarningSize();
                                        document.getElementById('copRu').value = '';
                                    }
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </li>
        </div>
        <div class="col-md-4 col-sm-12 text-center">
            <li class="alert alert-warning" id="archivo3">
                Copia de Estados Financieros de los Dos Ultimos Años Fiscales (Balance General y Estado de Resultados) <br>
                <div class="fileUpload btn btn-warning mt-2" id="btn_archivo3">
                    <span id="cop_f">Seleccionar</span>
                    <input type="file" name="copFin" id="copFin" class="upload" accept="multipart/form-data">
                    <div>
                        <script type="text/javascript">
                            document.getElementById('copFin').onchange = function() {
                                let archivoOpcion = validarSize('copFin');
                                if(archivoOpcion == 1){
                                    console.log(this.value);
                                    document.getElementById('cop_f').innerHTML = document.getElementById('copFin').files[0].name;
                                    cambiarColor(3, 'success');
                                }
                                else{
                                    alertWarningSize();
                                    document.getElementById('copFin').value = '';
                                }
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
            <li class="alert alert-warning" id="archivo7">
                Dos referencias comerciales, (En casos particulares se acepta una de estas de forma verbal) con fecha de expedicion <b>NO</b> mayor a 6 meses
                <div class="fileUpload btn btn-warning mt-2" id="btn_archivo7">
                    <span id="re_com">Seleccionar</span>
                    <input type="file" name="refComer" id="refComer" class="upload" accept="multipart/form-data">
                    <div>
                        <script type="text/javascript">
                            document.getElementById('refComer').onchange = function() {
                                let archivoOpcion = validarSize('refComer');
                                if(archivoOpcion == 1){
                                    console.log(this.value);
                                    document.getElementById('re_com').innerHTML = document.getElementById('refComer').files[0].name;
                                    cambiarColor(7, 'success');
                                }
                                else{
                                    alertWarningSize();
                                    document.getElementById('refComer').value = '';
                                }
                            }
                        </script>
                    </div>
                </div>
                <br> <br>
                <div class="fileUpload btn btn-warning" id="btn_archivo8">
                    <span id="ref_com2">Seleccionar</span>
                    <input type="file" name="refComer2" id="refComer2" class="upload" accept="multipart/form-data">
                    <div>
                        <script type="text/javascript">
                            document.getElementById('refComer2').onchange = function() {
                                let archivoOpcion = validarSize('refComer2');
                                if(archivoOpcion == 1){
                                    console.log(this.value);
                                    document.getElementById('ref_com2').innerHTML = document.getElementById('refComer2').files[0].name;
                                    cambiarColor(8, 'success');
                                }
                                else{
                                    alertWarningSize();
                                    document.getElementById('refComer2').value = '';
                                }
                            }
                        </script>
                    </div>
                </div>
            </li>
        </div>
        <div class="col-md-4 col-sm-12 text-center">
            <li class="alert alert-warning" id="archivo9">
                Una referencia bancaria con fecha de expedición <b>NO</b> Mayor a 6 Meses
                <div>
                    <div class="fileUpload btn btn-warning mt-2" id="btn_archivo9">
                        <span id="ref_ban">Seleccionar</span>
                        <input type="file" name="refBan" id="refBan" class="upload" accept="multipart/form-data">
                        <div>
                            <script type="text/javascript">
                                document.getElementById('refBan').onchange = function() {
                                    let archivoOpcion = validarSize('refBan');
                                    if(archivoOpcion == 1){
                                        console.log(this.value);
                                        document.getElementById('ref_ban').innerHTML = document.getElementById('refBan').files[0].name;
                                        cambiarColor(9, 'success');
                                    }
                                    else{
                                        alertWarningSize();
                                        document.getElementById('refBan').value = '';
                                    }
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </li>
        </div>
        <div class="col-md-4 col-sm-12 text-center">
            <li class="alert alert-warning" id="archivo10">
                Formulario de estudio de crédito
                <div>
                    <div class="fileUpload btn btn-warning mt-2" id="btn_archivo10">
                        <span id="for_cre1">Seleccionar</span>

                        <input type="file" name="form_cre" id="form_cre" class="upload" accept="multipart/form-data">
                        <div>
                            <script type="text/javascript">
                                document.getElementById('form_cre').onchange = function() {
                                    let archivoOpcion = validarSize('form_cre');
                                    if(archivoOpcion == 1){
                                        console.log(this.value);
                                        document.getElementById('for_cre1').innerHTML = document.getElementById('form_cre').files[0].name;
                                        cambiarColor(10, 'success');
                                    }
                                    else{
                                        alertWarningSize();
                                        document.getElementById('form_cre').value = '';
                                    }
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </li>
        </div>
    <?php } ?>
</div>