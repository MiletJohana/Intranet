<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
$mes = date('m');
$year = date('Y');
$sqlces = "SELECT * FROM ind_fechas WHERE id_pag ='5'";
$queryces = $conexion->query($sqlces);
while ($fila1 = $queryces->fetch(PDO::FETCH_ASSOC)) {
    $fech_pag1[] = $fila1["fech_pag"];
}
?>
<div class="row">
    <div class="col-12 text-center">
        <h3>Datos Cesantías</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<form role="form" id="form-Cesan">
    <div class="row">
        <div class="col-12 col-sm-12 mb-3">
            <label for="fech_pagc2" class="form-label">Febrero</label>
            <input type="date" class="form-control" id="fech_pagc2" min="<?php echo date("Y"); ?>-02-01" max="<?php echo date("Y"); ?>-02-<?php if (date("Y") % 4 == 0) {
                                                                                                                                echo '29';
                                                                                                                            } else {
                                                                                                                                echo '28';
                                                                                                                            } ?>" name="fech_pag5[]" value="<?php echo $fech_pag1[0];
                                                                                                                                                            if ($fech_pag1[0] != '') {
                                                                                                                                                                echo '"readonly="';
                                                                                                                                                            } ?>" required>
        </div>
    </div>
</form>