<?php
include '../../conexion.php';
include "../../resources/template/credentials.php";
$fecha = date('Y-m-d');
if ($_POST['resp'] == 2) {
    $sqlPer = " SELECT * FROM per_ingreso WHERE id_per=" . $_POST['edit'];
    $queryPer = $conexion->query($sqlPer);
    $rPer = $queryPer->fetch(PDO::FETCH_ASSOC);
    $area = $rPer['id_are'];
    $sql2 = "SELECT * FROM mq_are  WHERE id_are=$area";
    $query2 = $conexion->query($sql2);
    $sql22 = "SELECT * FROM mq_are  WHERE id_are!=$area";
    $query22 = $conexion->query($sql22);
    $usu = $rPer['id_usu'];
    $sql3 = "SELECT * FROM mq_usu WHERE id_usu=$usu";
    $query3 = $conexion->query($sql3);
    $sql33 = "SELECT * FROM mq_usu WHERE id_usu!=$usu";
    $query33 = $conexion->query($sql33);
    $mot = $rPer['mot_per'];
    $sql4 = "SELECT * FROM per_motivo WHERE mot_per=$mot and mot_per in (1,2,3,4,6,7,8,9,10,12)";
    $query4 = $conexion->query($sql4);
    $sql44 = "SELECT * FROM per_motivo WHERE mot_per!=$mot and mot_per in (1,2,3,4,6,7,8,9,10,12)";
    $query44 = $conexion->query($sql44);
} else {
    $sql2 = "SELECT * FROM mq_are ";
    $query2 = $conexion->query($sql2);
    $sql3 = "SELECT * FROM mq_usu";
    $query3 = $conexion->query($sql3);
    $sql4 = "SELECT * FROM per_motivo WHERE mot_per in (1,2,3,4,6,7,8,9,10,12);";
    $query4 = $conexion->query($sql4);
}
?>
<form role="form" id="form-permiso">
    <div class="col-12 col-sm-12">
        <?php if ($_POST['resp'] == 2){ ?>
            <input type="hidden" id="id_per" name="id_per" value="<?php echo $_POST['edit'] ?>">
        <?php } ?>
        <input type="hidden" id="accion_form" name="action" value="<?php if ($_POST['resp'] == 1) {
                                                                        echo "permiso";
                                                                    } else {
                                                                        echo 'updatepermiso';
                                                                    } ?>">
        <div class="row">
            <div class="col-md-6 col-sm-12 mt-3">
                <label for="usu_liq" class="form-label">Área</label>
                <select class="form-select" id="usu_per" name="usu_per" onchange="usuarios(this.value);" required>
                    <?php if ($_POST['resp'] == 1) { ?>
                        <option value=""> Seleccionar </option>
                    <?php }
                    while ($r2 = $query2->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $r2['id_are']; ?>"><?php echo $r2['nom_are']; ?> </option>
                        <?php }
                    if ($_POST['resp'] == 2) {
                        while ($r22 = $query22->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $r22['id_are']; ?>"><?php echo $r22['nom_are']; ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
            <div class="col-md-6 col-sm-12 mt-3">
                <label for="usu_liq" class="form-label">Usuario</label>
                <select class="form-select" id="us_per" name="us_per" value="" required>
                    <?php if ($_POST['resp'] == 1) { ?>
                        <option value=""> Seleccione el área</option>
                        <?php } else {
                        while ($r3 = $query3->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $r3['id_usu']; ?>"><?php echo $r3['nom_usu']; ?> </option>
                            <?php }
                        if ($_POST['resp'] == 2) {
                            while ($r33 = $query33->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $r33['id_usu']; ?>"><?php echo $r33['nom_usu']; ?></option>
                    <?php }
                        }
                    } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12  mt-3">
                <label for="fec_ase" class="form-label">Fecha de la Ausencia</label>
                <input type="date" class="form-control" id="fec_ase" name="fec_ase" value="<?php if (isset($_POST['edit'])) {
                                                                                                echo $rPer['fech_aus'];
                                                                                            } ?>" required>
            </div>
            <div class="col-md-6 col-sm-12 mt-3">
                <label for="mot_per" class="form-label">Motivo</label>
                <select class="form-select" id="mot_per" name="mot_per" value="" required onchange="habilitar(1,this.value)">
                    <?php if ($_POST['resp'] == 1) { ?>
                        <option value=""> Seleccione el Motivo</option>
                    <?php }
                    while ($r4 = $query4->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $r4['mot_per']; ?>"><?php echo $r4['descrip_per']; ?> </option>
                        <?php }
                    if ($_POST['resp'] == 2) {
                        while ($r44 = $query44->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $r44['mot_per']; ?>"><?php echo $r44['descrip_per']; ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12 mt-3">
                <label for="hora_ini" class="form-label">Hora Inicial</label>
                <input type="time" class="form-control" id="hora_ini" name="hora_ini" value="<?php if (isset($_POST['edit'])) {
                                                                                                    echo $rPer['fech_ini'];
                                                                                                } else {
                                                                                                    echo "07:00";
                                                                                                } ?>" required>
            </div>
            <div class="col-md-6 col-sm-12 mt-3">
                <label for="hora_fin" class="form-label">Hora Final</label>
                <input type="time" class="form-control" id="hora_fin" name="hora_fin" value="<?php if (isset($_POST['edit'])) {
                                                                                                    echo $rPer['fech_fin'];
                                                                                                } else {
                                                                                                    echo "16:40";
                                                                                                } ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <label for="obs_per" class="form-label">Observaciones</label>
                <textarea class="form-control" id="obs_per" name="obs_per" required placeholder="Llena este espacio con el concepto del permiso"><?php if (isset($_POST['edit'])) {
                                                                                                                                                        echo $rPer['obser_perm'];
                                                                                                                                                    } ?></textarea>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-3 col-sm-12">
                <div class="fileUpload btn btn-primary">
                    <?php if ($_POST['resp'] == 1) { ?>
                        <span id="perm"> Adjuntar Soporte</span>
                    <?php } else { ?>
                        <span id="perm"> Modificar Soporte</span>
                    <?php } ?>
                    <input type="file" name="doc_perm" id="doc_perm" class="upload" enctype="multipart/form-data">
                    <div>
                        <script type="text/javascript">
                            document.getElementById('doc_perm').onchange = function() {
                                let archivoOpcion = validarSize('doc_perm');
                                if(archivoOpcion == 1){
                                    console.log(this.value);
                                    document.getElementById('perm').innerHTML = document.getElementById('doc_perm').files[0].name;
                                }
                                else{
                                    alertWarningSize();
                                    document.getElementById('doc_perm').value = '';
                                }
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($_POST['resp'] == 2) {
        if ($rPer['doc_perm'] != '') { ?>
            <div class="col-md-1">
                <a class="btn btn-danger" href="../../documentos/permisos/<?php echo $rPer['doc_perm']; ?>" target="_blank"> <i class="fa-solid fa-file-pdf" style="font-size: 23px;"></i></a>
            </div>
    <?php }
    } ?>
    </div>
    </div>
</form>