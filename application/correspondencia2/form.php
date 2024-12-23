<div class="
"></div><?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
include('../../resources/template/toasts.php');
$fecha = date('Y-m-d');
if ($_POST['resp'] == 6) {
    $sql = "SELECT * FROM correspondencias WHERE id_seg=\"$_POST[id_seg]\"";
    $query = $conexion->query($sql);
    $r = $query-> fetch(PDO::FETCH_ASSOC);
    $area = $r['area_remit'];
    $sql2 = "SELECT * FROM mq_are  WHERE id_are=$area";
    $query2 = $conexion->query($sql2);
    $sql22 = "SELECT * FROM mq_are  WHERE id_are!=$area";
    $query22 = $conexion->query($sql22);
    $reg = $r['id_reg'];
    $sql3 = "SELECT * from mq_reg WHERE id_reg=$reg";
    $query3 = $conexion->query($sql3);
    $sql33 = "SELECT * from mq_reg WHERE id_reg!=$reg";
    $query33 = $conexion->query($sql33);
    $bod = $r['id_bodeg'];
    $sql4 = "SELECT * FROM seg_bodeg WHERE id_bodeg=$bod";
    $query4 = $conexion->query($sql4);
    $sql44 = "SELECT * FROM seg_bodeg WHERE id_bodeg!=$bod";
    $query44 = $conexion->query($sql44);
    $nomdoc = $r['id_nom'];
    $sql5 = "SELECT * FROM seg_nomdoc WHERE id_nom=" . $nomdoc . " AND id_nom IN (1, 2, 3, 6)";
    $query5 = $conexion->query($sql5);
    $sql55 = "SELECT * FROM seg_nomdoc WHERE id_nom!=" . $nomdoc . " AND id_nom IN (1, 2, 3, 6)";
    $query55 = $conexion->query($sql55);
    $nomUsu = $r['per_encarga'];
    $sql6 = "SELECT * FROM  mq_usu WHERE id_usu=$nomUsu";
    $query6 = $conexion->query($sql6);
    $sql66 = "SELECT * FROM  mq_usu WHERE id_usu!=$nomUsu AND id_are=$area";
    $query66 = $conexion->query($sql66);
    $nomPro = $r['id_prove'];
    $sql7 = "SELECT * FROM mq_clientes AS cli 
    INNER JOIN correspondencias AS cor 
    ON cli.id_cli = cor.id_prove WHERE cor.id_prove = $nomPro";
    $query7 = $conexion->query($sql7);
    $sql77 = "SELECT * FROM mq_clientes WHERE id_cli != $nomPro";
    $query77 = $conexion->query($sql77);
} else {
    $sql2 = "SELECT * FROM mq_are ";
    $query2 = $conexion->query($sql2);
    $sql3 = "SELECT * from mq_reg";
    $query3 = $conexion->query($sql3);
    $sql4 = "SELECT * FROM seg_bodeg";
    $query4 = $conexion->query($sql4);
    $sql5 = "SELECT * FROM seg_nomdoc WHERE id_nom IN (1, 2, 3, 6)";
    $query5 = $conexion->query($sql5);
    $sql6 = "SELECT * FROM mq_usu";
    $query6 = $conexion->query($sql6);
    $sql7 = "SELECT * FROM mq_clientes";
    $query7 = $conexion->query($sql7);
}

if ($_POST['id_cli'] != 0) {
    $sqlCli = "SELECT * from mq_clientes WHERE id_cli = " . $_POST['id_cli'];
    $queryCli = $conexion->query($sqlCli);
    $rCli = $queryCli-> fetch(PDO::FETCH_ASSOC);
}
?>
<form role="form" id="form-corres">
    <div class="row">
        <div class="col-12 text-center">
            <h3>Datos de la Correspondencia</h3>
            <hr class="mx-auto" style="width:60%;">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="val_con" class="form-label">Validar Contraseña</label>
            <input type="password" class="form-control" id="val_con" name="val_con" value="" required onkeyup="verificarPass(1);">
        </div>
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="nom_fac" class="form-label">Documento </label>
            <select class="form-select" id="nom_fac" name="nom_fac" value="" onchange="appear(this.value, 0);" required>
                <?php if ($_POST['resp'] == 1) { ?>
                    <option value="">Seleccionar</option>
                <?php }
                while ($r5 = $query5-> fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $r5['id_nom']; ?>"><?php echo $r5['nom_doc']; ?> </option>
                    <?php }
                if ($_POST['resp'] == 6) {
                    while ($r55 = $query55-> fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $r55['id_nom']; ?>"><?php echo $r55['nom_doc']; ?></option>
                <?php }
                } ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="fe_rec" class="form-label">Fecha de Recibido</label>
            <input type="date" class="form-control" id="fec_rec" required name="fec_rec" max="<?php $fecha ?>" value="<?php if ($_POST['resp'] == 6) {
                                                                                                                        echo $r['fech_ini'];
                                                                                                                    } ?>">
        </div>
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="area_n" class="form-label"> Área a la que Remite </label>
            <select class="form-select" id="area_n" name="area_n" onchange="usuarios(this.value);" required>
                <?php if ($_POST['resp'] == 1) { ?>
                    <option value="">Seleccionar</option>
                <?php }
                while ($r2 = $query2-> fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $r2['id_are']; ?>"><?php echo $r2['nom_are']; ?> </option>
                    <?php }
                if ($_POST['resp'] == 6) {
                    while ($r22 = $query22-> fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $r22['id_are']; ?>"><?php echo $r22['nom_are']; ?></option>
                <?php }
                } ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <label for="per_enc" class="form-label">Persona Encargada</label>
            <select class="form-select" id="per_enc" name="per_enc" value="" required>
                <?php if ($_POST['resp'] == 1) { ?>
                    <option value="">Seleccione el área</option>
                    <?php } else {
                    while ($r6 = $query6-> fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $r6['id_usu']; ?>"><?php echo $r6['nom_usu']; ?> </option>
                        <?php }
                    if ($_POST['resp'] == 6) {
                        while ($r66 = $query66-> fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $r66['id_usu']; ?>"><?php echo $r66['nom_usu']; ?></option>
                <?php }
                    }
                } ?>
            </select>
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="justi" class="form-label">Concepto de Justificación</label>
            <textarea class="form-control" id="justi" name="justi" placeholder="Llena este espacio con el concepto de la correspondencia"><?php if ($_POST['resp'] == 6) {
                                                                                                                                                echo $r['concept_justifi'];
                                                                                                                                            } ?></textarea>
        </div>
    </div>
    <div class="row">
        <?php if ($_POST['resp'] == 6 && $r['sop_factura'] != 'NULL'){?>
            <div class="col-1" style="margin-top: 23px;" id="btn-verArchivo" >
                <a href="../../documentos/correspondencia/docum/<?php echo $r['sop_factura']; ?>" target="_blank"><button class="btn btn-info" type="button"><i class="fa-solid fa-file" style="font-size:20px;"></i></button></a>
            </div>
        <?php } ?>
        <div class="col-11" id="vis">
            <div class="fileUpload btn btn-danger" style="margin-top: 23px;">
                <span id="fac"><?php if($_POST['resp'] == 6 && $r['sop_factura'] != 'NULL'){ echo 'Cambiar';} else { echo 'Seleccionar';} ?> Archivo</span>
                <input type="file" name="fac_regi" id="fac_regi" class="upload" accept="application/pdf">
                <div>
                    <script type="text/javascript">
                        document.getElementById('fac_regi').onchange = function() {
                            let archivoOpcion = validarSize('fac_regi');
                            var btnVer =  document.getElementById('btn-verArchivo');
                            if(btnVer){
                                btnVer.classList.add('none');
                            }
                                
                            if(archivoOpcion == 1){
                                console.log(this.value);
                                document.getElementById('fac').innerHTML = document.getElementById('fac_regi').files[0].name;
                            }
                            else{
                                alertWarningSize();
                                document.getElementById('fac_regi').value = '';
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
    <div id="mp" class="mt-5">
        <?php if (isset($_POST['resp']) && $_POST['resp'] == 6 && ($r['id_nom'] == 1 || $r['id_nom'] == 10)) {
            include 'fact.php';
        } ?>
    </div>
    <input type="hidden" id="accion_form" name="action" value="<?php if ($_POST['resp'] == 1) {
                                                                    echo "add";
                                                                } elseif ($_POST['resp'] == 6) {
                                                                    echo "updateForm";
                                                                } elseif ($_POST['resp'] == 7) {
                                                                    echo "aceptado";
                                                                } ?>">
    <input type="hidden" id="id_seg" name="id_seg" value="<?php if ($_POST['resp'] == 6) {
                                                                echo $_POST['id_seg'];
                                                            } ?>">
    <?php if (isset($_POST['resp']) && $_POST['resp'] == 6 && ($r['id_nom'] == 7 || $r['id_nom'] == 8 || $r['id_nom'] == 9)) {
        $sqlCaja = "SELECT * FROM seg_caja WHERE id_seg=" . $_POST['id_seg'];
        $queryCaja = $conexion->query($sqlCaja);
        $rCaja = $queryCaja-> fetch(PDO::FETCH_ASSOC);
    } ?>
    <input type="hidden" id="id_cli" name="id_cli" value="<?php if (isset($rCaja)) {
                                                                echo $rCaja['id_prove'];
                                                            } else if (isset($_POST['resp']) && $_POST['resp'] == 6) {
                                                                echo $r['id_prove'];
                                                            } else if ($_POST['resp'] == 1 && $_POST['id_cli'] != 0) {
                                                                echo $rCli['id_cli'];
                                                            }
                                                            ?>">
</form>

<form role="form" id="form-cliente" class="bg-blue p-4 rounded mt-5">
    <div class="row">
        <div class="col-12 text-center">
            <h3><i class="fa-solid fa-users-line text-white"></i></h3>
            <h3 style="color: white;">Datos del Proveedor </h3>
            <hr class="mx-auto text-white" style="width:60%;">
        </div>
    </div>
    <div class="row ">
        <div class="col-12">
            <div class="alert alert-info alert-dismissible fade show mt-2 d-flex align-items-center" role="alert">
                <i class="fa-solid fa-circle-info me-3 fa-xl"></i>
                <div>
                Recuerde que los datos ingresados serán modificados y agregados en el botón <b>Crear Proveedor</b>.
                El aplicativo notificara en la parte inferior sí fue creado correctamente.
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <div class="row">
        <input type="hidden" id="id_cli" name="id_cli" value="<?php if ($_POST['resp'] == 1 && $_POST['id_cli'] != 0) {
                                                                    echo $rCli['id_cli'];
                                                                } ?>">
        <input type="hidden" id="actionCli" name="actionCli" value="addCliente">
        <div class="col-md-4 col-sm-12 mb-3">
            <label for="search" class="form-label text-white">Razón Social <span name="req" class="text-mq">*</span></label>
            <input type="text" class="form-control" id="search" name="nom_cli" autocomplete="off" placeholder="Nombre del cliente" onkeyup="buscarCliente(2)"  value="<?php if ($_POST['resp'] == 2) {
                                                                                                                                                                echo $r2['nom_cli'];
                                                                                                                                                            } else if ($_POST['resp'] == 6 && $_POST['id_cli'] != 0) {
                                                                                                                                                                echo $rCli['nom_cli'];
                                                                                                                                                            } else {
                                                                                                                                                                echo '';
                                                                                                                                                            } ?>"   required>
        </div>
        <div class="col-md-4 col-sm-12 mb-3">
            <label for="tip_doc" class="form-label text-white">Tipo documento</label>
            <select class="form-select" id="tip_doc" name="tip_doc" onchange="tipDoc(this.value)" disabled>
                <option value="NIT">NIT</option>
                <option value="C.C">C.C</option>
            </select>
        </div>
        <div class="col-md-4 col-sm-12 mb-3">
            <label for="num_doc" class="form-label text-white"><span id="num">NIT</span></label>
            <input type="text" class="form-control" id="num_doc" name="num_doc" maxlength="12" pattern="[0-9]" placeholder="XXXXXXXXX" value="<?php if ($_POST['resp'] == 2) {
                                                                                                                                                    echo $r2['num_doc'];
                                                                                                                                                } else if ($_POST['resp'] == 6 && $_POST['id_cli'] != 0) {
                                                                                                                                                    echo $rCli['num_doc'];
                                                                                                                                                } else {
                                                                                                                                                    echo '';
                                                                                                                                                } ?>" readonly>
        </div>
    </div>

    <div id="pro">
        <?php if (isset($_POST['resp']) && $_POST['resp'] == 2) {
            if ($_POST['id_nom'] == 7 || $_POST['id_nom'] == 8 || $_POST['id_nom'] == 9) {
            } else {
                include 'prove.php';
            }
        } ?>
    </div>
    <?php if ($_POST['id_cli'] == 0) { ?>
        <div class="row">
            <div class="col-12 d-flex mt-3">
                <button type="button" id="buton_prov" class="btn btn-primary ms-auto" onclick="crear(1);">Crear Proveedor</button>
                <button type="button" id="buton_can" class="btn btn-danger ms-1" onclick="crear(2);">Cancelar</button>
            </div>
        </div>
    <?php } ?>

    <div class="row">
        <div class="col-12">
            <div class="alert alert-dismissible fade show" role="alert" id="alert-cliente"  style="display:none;">
                <span id="alert-texto-cliente"></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
</form>
