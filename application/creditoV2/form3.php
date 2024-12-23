<?php
include '../../conexion.php';
if (isset($_POST['id_sol']) && $_POST['id_sol'] != '') {
    if (isset($_POST['id_cli']) && $_POST['id_cli'] != '') {
        $sqlCli = "SELECT * FROM mq_clie where id_cli=" . $_POST['id_cli'];
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
    $sqlClie = "SELECT * FROM mq_clie, mq_usu,cre_solicitud  where cre_solicitud.rep_sac=mq_usu.id_usu ";
    $queryClie = $conexion->query($sqlClie);
    while ($r = $queryClie->fetch(PDO::FETCH_OBJ)) {
        $clie = $r;
        break;
    }

    $sqlCl2 = "SELECT * FROM mq_clie, mq_usu,cre_solicitud  where mq_clie.rep_sac=mq_usu.id_usu AND mq_clie.id_cli='$s->id_cli' GROUP BY mq_clie.id_cli";
    $queryCl2 = $conexion->query($sqlCl2);
    while ($r = $queryCl2->fetch(PDO::FETCH_OBJ)) {
        $cl2 = $r;
        break;
    }
}
?>
<div class="row mt-3">
    <div class="col-md-12 text-center">
        <h3>Espacio para el área de Ventas</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        Tipo de Cliente
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
        <label for="segCl">Segmento del cliente</label>
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
        <label for="conAt">Concepto del ATC</label>
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
        <label for="CupAtc">Cupo de credito sugerido por ATC</label>
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
        <label for="plazAt">Plazo de pago sugerido por ATC</label>
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
                                                                                            } ?>" required onkeyup="auto2();">
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
                                                                                                } ?>" onkeyup="auto3();">
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
            <li class="alert alert-success">
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
            <li class="alert alert-success">
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
            <li class="alert alert-success">
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
            <li class="alert alert-success">
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
            <li class="alert alert-success">
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
            <li class="alert alert-success">
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
            <li class="alert alert-success">
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
            <li class="alert alert-success">
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