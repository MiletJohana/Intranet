<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
$sqlPrim = "SELECT * FROM ind_fechas WHERE id_pag=4";
$queryPrim = $conexion->query($sqlPrim);
while ($row4 = $queryPrim->fetch(PDO::FETCH_ASSOC)) {
    $fech_pag4[] = $row4["fech_pag"];
}
?>
<div class="row">
    <div class="col-12 text-center">
        <h3>Datos Prima</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<form role="form" id="form-Prim">
    <div class="row">
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="fech_pagp6" class="form-label">Junio</label>
            <input type="date" class="form-control" id="fech_pagp6" min="<?php echo date("Y"); ?>-06-01" max="<?php echo date("Y"); ?>-06-30" name="fech_pag4[]" value="<?php echo $fech_pag4[0];
                                                                                                                                                        if ($fech_pag4[0] != '') {
                                                                                                                                                            echo '"readonly="';
                                                                                                                                                        } ?>" required>
        </div>
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="fech_pagp12" class="form-label">Diciembre</label>
            <input type="date" class="form-control" id="fech_pagp12" min="<?php echo date("Y"); ?>-12-01" max="<?php echo date("Y"); ?>-12-31" name="fech_pag4[]" value="<?php echo $fech_pag4[1];
                                                                                                                                                        if ($fech_pag4[1] != '') {
                                                                                                                                                            echo '"readonly="';
                                                                                                                                                        } ?>" required>
        </div>
    </div>
</form>