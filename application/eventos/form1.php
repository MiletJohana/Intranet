<?php
include "../../conexion.php";
include '../../resources/template/credentials.php';
if ($_POST['resp'] == 21) {
    $sqlAct = "SELECT * FROM ind_act AS a INNER JOIN mq_usu AS u ON u.id_usu = a.id_usu WHERE id_act= " . $_POST['edit'];
    $queryAct = $conexion->query($sqlAct);
    $rAct = $queryAct-> fetch(PDO::FETCH_ASSOC);
    //echo $sqlAct;
}

$mes = date('m');

?>
<div class="row">
    <div class="col-12">
        <h3 align="center">Actividades de Bienestar</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<form role="form" id="form-act">
    <input type="hidden" id="accion-form" name="action" value="<?php if ($_POST['resp'] == 20) {
                                                                    echo "insAct";
                                                                } else {
                                                                    echo 'editAct';
                                                                } ?>">
    <input type="hidden" id="id_act" name="id_act" value="<?php echo $_POST['edit'] ?>">
    <div class="row">
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="fec_act" class="form-label">Fecha de la Actividad</label>
            <input type="date" class="form-control" id="fec_act" name="fec_act" required value="<?php if ($_POST['resp'] == 21) {
                                                                                                            echo $rAct['fec_act'];
                                                                                                        } ?>">
        </div>
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="nom_act" class="form-label">Nombre de la Actividad</label>
            <input type="text" class="form-control" id="nom_act" name="nom_act" required value="<?php if ($_POST['resp'] == 21) {
                                                                                                        echo $rAct['nom_act'];
                                                                                                    } ?>">
        </div>
    </div>
</form>