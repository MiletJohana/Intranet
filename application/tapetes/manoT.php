<?php
include '../../conexion.php';
include "../../resources/template/credentials.php";
$sqlmano="SELECT * FROM cot_tap_mano";
$querymano=$conexion->query($sqlmano);
$rm=$querymano->fetch_array();

$sqlsen="SELECT * FROM cot_tap_sencillo";
$querysen=$conexion->query($sqlsen);
$rs=$querysen->fetch_array();

$sqlcom="SELECT * FROM cot_tap_complejo";
$querycom=$conexion->query($sqlcom);
$rc=$querycom->fetch_array();

$sqlLog="SELECT* FROM cot_tap_sinlogo ";
$queryLog=$conexion->query($sqlLog);
$rl=$queryLog->fetch_array();

$mano=$rm['cost_hora'];
$sen=$rs['tot_tapsen'];
$com=$rc['tot_tapCom'];
$log=$rl['tot_tapSin'];

$tap_sen= round($mano * $sen);
$tap_com= round($mano * $com);
$tap_log= round($mano * $log);

?>
<div class="row">
    <div class="col-12 text-center">
        <h3>Mano De Obra (Costo Tapete)</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<br>
<form role="form" id="form-manotap">
<input type="hidden" id="accion_form" name="action" value="manotap">
<div class="row mb-3">
    <div class="col-md-6 col-sm-12">
        <label class="form-label">Tapete Sencillo</label>
    </div>
    <div class="col-md-6 col-sm-12">
        <input type="text" id="man_tapsen " name="man_tapsen " class="form-control" readonly required value="<?php echo $tap_sen ?>">

    </div>
</div><br>
<div class="row mb-3">
    <div class="col-md-6 col-sm-12">
        <label class="form-label">Tapete Complejo</label>
    </div>
    <div class="col-md-6 col-sm-12">
        <input type="text" id="man_tapcom " name="man_tapcom " class="form-control" readonly required value="<?php echo $tap_com?>">
    </div>
</div><br>
<div class="row mb-3">
    <div class="col-md-6 col-sm-12">
        <label class="form-label">Tapete Sin Logo</label>
    </div>
    <div class="col-md-6 col-sm-12">
        <input type="text" id="man_taplog " name="man_taplog " class="form-control" readonly required value="<?php echo $tap_log ?>">
    </div>
</div>
<div class="col-12 mb-3" id="respuemantap"></div>
<div class="row mb-3" id="errorMan"></div>
</form>