<?php
///FORMULARIO DE USUARIOS N.
include '../../conexion.php';
include '../../resources/template/credentials.php';
$fecha = date('Y-m-d');
if ($_POST['resp'] == 4) {
    $sqlPerm = " SELECT * FROM per_ingreso WHERE id_per=" . $_POST['edit'];
    $queryPerm = $conexion->query($sqlPerm);
    $rPerm = $queryPerm->fetch(PDO::FETCH_ASSOC);
    $mote = $rPerm['mot_per'];
    $sql4 = "SELECT * FROM per_motivo WHERE mot_per=$mote and mot_per in (1,2,3,4,6,7,8,9,10,12)";
    $query4 = $conexion->query($sql4);
    $sql44 = "SELECT * FROM per_motivo WHERE mot_per!=$mote and mot_per in (1,2,3,4,6,7,8,9,10,12)";
    $query44 = $conexion->query($sql44);
} else {
    $sql4 = "SELECT * FROM per_motivo WHERE mot_per in (1,2,3,4,6,7,8,9,10,12);";
    $query4 = $conexion->query($sql4);
}
?>
<form role="form" id="form-perm">
    <div class="row">
        <div class="col-sm-12">
            <?php if ($_POST['resp'] == 4) {?>
            <input type="hidden" id="id_per" name="id_per" value="<?php echo $_POST['edit'] ?>">
            <?php }?>
            <input type="hidden" id="accion_form" name="action" value="<?php if ($_POST['resp'] == 3) {
                                                                            echo "permiso2";
                                                                        } else {
                                                                            echo 'updatepermiso2';
                                                                        } ?>">
            <div class="row">
                <?php if ($_POST['resp'] == 3) { ?>
                <div class="col-md-6 col-sm-12 pt-3">
                    <label for="val_con" class="form-label">Validar Contraseña</label>
                    <input type="password" class="form-control" id="val_con" name="val_con" value="" required
                        onkeyup="verificar();">
                </div>
                <?php } ?>
                <div class="col-md-6 col-sm-12 pt-3">
                    <label for="fec_ase1" class="form-label">Fecha de la Ausencia</label>
                    <input type="date" class="form-control" id="fec_ase1" name="fec_ase1" min="<?php $fecha ?>"
                        value="<?php if (isset($_POST['edit'])) {
                                                                                                                            echo $rPerm['fech_aus'];
                                                                                                                        } ?>"
                        <?php if ($_POST['resp'] != 4) {
                                                                                                                                    echo 'required';
                                                                                                                                } ?>>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 pt-3">
                    <label for="hora_ini1" class="form-label">Hora Inicial</label>
                    <input type="time" class="form-control" id="hora_ini1" name="hora_ini1" value="<?php if (isset($_POST['edit'])) {
                                                                                                        echo $rPerm['fech_ini'];
                                                                                                    } else {
                                                                                                        echo "07:00";
                                                                                                    } ?>" required>
                </div>
                <div class="col-md-6 col-sm-12 pt-3">
                    <label for="hora_fin1" class="form-label">Hora Final</label>
                    <input type="time" class="form-control" id="hora_fin1" name="hora_fin1" value="<?php if (isset($_POST['edit'])) {
                                                                                                        echo $rPerm['fech_fin'];
                                                                                                    } else {
                                                                                                        echo "16:40";
                                                                                                    } ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 pt-3">
                    <label for="mot_per1" class="form-label">Motivo</label>
                    <select class="form-select" id="mot_per1" name="mot_per1" value="" required
                        onchange="habilitar(2,this.value)">
                        <?php if ($_POST['resp'] == 3) { ?>
                        <option value=""> Seleccione el Motivo</option>
                        <?php }
                        while ($r4 = $query4->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $r4['mot_per']; ?>"><?php echo $r4['descrip_per']; ?>
                        </option>
                        <?php }
                        if ($_POST['resp'] == 4) {
                            while ($r44 = $query44->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $r44['mot_per']; ?>"><?php echo $r44['descrip_per']; ?>
                        </option>
                        <?php }
                        } ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 pt-3">
                    <label for="obs_per1" class="form-label">Observaciones</label>
                    <textarea class="form-control" id="obs_per1" name="obs_per1" rows="3"
                        placeholder="Llena este espacio con el concepto del permiso"
                        required><?php if (isset($_POST['edit'])) {
                                                                    echo $rPerm['obser_perm'];
                                                                } ?></textarea>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-3 col-sm-12">
                    <div class="fileUpload btn btn-primary">
                        <?php if ($_POST['resp'] == 1 || $_POST['resp'] == 3) { ?>
                        <span id="perm1"> Adjuntar Soporte</span>
                        <?php } else { ?>
                        <span id="perm1"> Modificar Soporte</span>
                        <?php } ?>
                        <input type="file" name="doc_perm1" id="doc_perm1" class="upload" enctype="multipart/form-data">
                        <input type="image" src="" alt="">
                        <div>
                    
                            <script type="text/javascript">
                                document.getElementById('doc_perm1').onchange = function() {
                                    let archivoOpcion = validarSize('doc_perm1');
                                    if(archivoOpcion == 1){
                                        console.log(this.value);
                                        document.getElementById('perm1').innerHTML = document.getElementById('doc_perm1').files[0].name;
                                    }
                                    else{
                                        alertWarningSize();
                                        document.getElementById('doc_perm1').value = '';
                                    }
                                }
                           
                            </script>
                        </div>
                    </div>
                </div>
                <?php if ($_POST['resp'] == 4) {
                    if ($rPerm['doc_perm'] != '') { ?>
                <div class="col-md-1">
                    <a class="btn btn-danger" href="../../documentos/permisos/<?php echo $rPerm['doc_perm']; ?>"
                        target="_blank"> <i class="fa-solid fa-file-pdf"></i></a>
                </div>
                <?php }
                } ?>
            </div>
        </div>
    </div>
</form>