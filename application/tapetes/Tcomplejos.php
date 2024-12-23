<?php
include '../../conexion.php';
include "../../resources/template/credentials.php";
$sqlCompl="SELECT * FROM cot_tap_complejo";
$queryCompl=$conexion->query($sqlCompl);
$rC=$queryCompl->fetch(PDO::FETCH_ASSOC);
?>
<div class="row">
    <div class="col-12 text-center">
        <h3>Tapete Complejo </h3>
    </div>
</div>
<br>
<form role="form" id="form-Tcom">
<input type="hidden" id="accion_form" name="action" value="tapComple">
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Diseño logo tapete</label>
        <hr style="width:0%;">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="di_min2" name="di_min2" class="form-control" placeholder="Minutos" required onkeyup="calcularTab()" value="<?php echo round($rC['dis_tapCom_min'],2,PHP_ROUND_HALF_EVEN);?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="text" id="di_horas2" name="di_horas2" class="form-control" placeholder="Horas" required onkeyup="calcularTab()" readonly value="<?php echo round($rC['dis_tapCom_hor'],2,PHP_ROUND_HALF_EVEN);?>" >
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Calcado logo tapete</label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="cal_min2" name="cal_min2" class="form-control" placeholder="Minutos" required onkeyup="calcularTab()"  value="<?php echo round($rC['cal_tapCom_min'],2,PHP_ROUND_HALF_EVEN);?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="text" id="cal_horas2" name="cal_horas2" class="form-control" placeholder="Horas" required onkeyup="calcularTab()" readonly value="<?php echo round($rC['cal_tapCom_hor'],2,PHP_ROUND_HALF_EVEN);?>">
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Pegado logo en tapete</label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="peg_min2" name="peg_min2" class="form-control" placeholder="Minutos" required  onkeyup="calcularTab()" value="<?php echo round($rC['peg_tapCom_min'],2,PHP_ROUND_HALF_EVEN);?>">   
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="text" id="peg_horas2" name="peg_horas2" class="form-control" placeholder="Horas"  required readonly  onkeyup="calcularTab()" value="<?php echo round($rC['peg_tapCom_hor'],2,PHP_ROUND_HALF_EVEN);?>">   
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Corte tapete base de acuerdo a Dimensiones</label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="cort_min2" name="cort_min2" class="form-control"  placeholder="Minutos" required  onkeyup="calcularTab()" value="<?php echo round($rC['cort_tapCom_min'],2,PHP_ROUND_HALF_EVEN);?>">   
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="text" id="cort_horas2" name="cort_horas2" class="form-control" placeholder="Horas" required readonly  onkeyup="calcularTab()" value="<?php echo round($rC['cort_tapCom_hor'],2,PHP_ROUND_HALF_EVEN);?>" >   
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Corte base cavidad Logo</label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="base_min2" name="base_min2" class="form-control"  placeholder="Minutos" required  onkeyup="calcularTab()" value="<?php echo round($rC['cort_baseCom_min'],2,PHP_ROUND_HALF_EVEN);?>">   
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="text" id="base_Horas2" name="base_Horas2" class="form-control"  placeholder="Horas"  required readonly  onkeyup="calcularTab()" value="<?php echo round($rC['cort_baseCom_hor'],2,PHP_ROUND_HALF_EVEN);?>">   
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Corte Logo</label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="log_min2" name="log_min2" class="form-control"  placeholder="Minutos" required  onkeyup="calcularTab()" value="<?php echo round($rC['cort_logoCom_min'],2,PHP_ROUND_HALF_EVEN);?>">   
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="text" id="log_Horas2" name="log_Horas2" class="form-control"  placeholder="Horas" required readonly  onkeyup="calcularTab()" value="<?php echo round($rC['cort_logoCom_hor'],2,PHP_ROUND_HALF_EVEN);?>">   
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Union Logo - base (Plancha - Maxon)</label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="unio_min2" name="unio_min2" class="form-control"  placeholder="Minutos" required onkeyup="calcularTab()"  value="<?php echo round($rC['uni_logoCom_min'],2,PHP_ROUND_HALF_EVEN);?>">   
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="text" id="unio_Horas2" name="unio_Horas2" class="form-control"  placeholder="Horas" required readonly  onkeyup="calcularTab()" value="<?php echo round($rC['uni_logoCom_hor'],2,PHP_ROUND_HALF_EVEN);?>">   
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Escuadra tapete</label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="escu_min2" name="escu_min2" class="form-control"  placeholder="Minutos" required  onkeyup="calcularTab()" value="<?php echo round($rC['esc_tapCom_min'],2,PHP_ROUND_HALF_EVEN);?>">   
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="text" id="escu_Horas2" name="escu_Horas2" class="form-control"  placeholder="Horas" required readonly  onkeyup="calcularTab()" value="<?php echo round($rC['esc_tapCom_hor'],2,PHP_ROUND_HALF_EVEN);?>">   
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Perfilado</label>
        <hr style="width:0%;">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="perfi_min2" name="perfi_min2" class="form-control"  placeholder="Minutos" required onkeyup="calcularTab()" value="<?php echo round($rC['perf_tapCom_min'],2,PHP_ROUND_HALF_EVEN);?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="text" id="perfi_Horas2" name="perfi_Horas2" class="form-control"  placeholder="Horas" required readonly onkeyup="calcularTab()"  value="<?php echo round($rC['perf_tapCom_hor'],2,PHP_ROUND_HALF_EVEN);?>">   
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Resellado</label>
        <hr style="width:0%;">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="rell_min2" name="rell_min2" class="form-control"  placeholder="Minutos" required onkeyup="calcularTab()" value="<?php echo round($rC['rell_tapCom_min'],2,PHP_ROUND_HALF_EVEN);?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="text" id="rell_Horas2" name="rell_Horas2" class="form-control"  placeholder="Horas"  required readonly onkeyup="calcularTab()"value="<?php echo round($rC['rell_tapCom_hor'],2,PHP_ROUND_HALF_EVEN);?>"> 
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label"><strong><i>TOTAL</i></strong></label>
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="tot_Horas2" name="tot_Horas2" class="form-control"  placeholder="Horas" required readonly value="<?php echo round($rC['tot_tapCom'],2,PHP_ROUND_HALF_EVEN);?>"> 
    </div>
</div>

<div class="col-md-12 mb-3" id="respuestaCom"></div>
<div class="row mb-3" id="errorCom"></div>
</form>