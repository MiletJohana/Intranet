<?php
include '../../conexion.php';
include "../../resources/template/credentials.php";
$sqlSim="SELECT * FROM cot_tap_sencillo";
$querySim=$conexion->query($sqlSim);
$rS=$querySim->fetch(PDO::FETCH_ASSOC);
?>

<div class="row">
    <div class="col-12 text-center">
        <h3>Tapete Sencillo </h3>
    </div>
</div>
<br>
<form role="form" id="form-Tsen">
<input type="hidden" id="accion_form" name="action" value="tapSimple">
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Diseño logo tapete</label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="di_min" name="di_min" class="form-control" placeholder="Minutos"  onkeyup="calcularTab()" value="<?php echo round($rS['dis_tap_min'],2,PHP_ROUND_HALF_EVEN); ?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="text" id="di_horas" name="di_horas" class="form-control" placeholder="Horas"  onkeyup="calcularTab()"readonly value="<?php echo round($rS['dis_tap_hor'],2,PHP_ROUND_HALF_EVEN); ?>" >
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Calcado logo tapete</label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="cal_min" name="cal_min" class="form-control" placeholder="Minutos" onkeyup="calcularTab()"  value="<?php echo round($rS['cal_tap_min'],2,PHP_ROUND_HALF_EVEN); ?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="text" id="cal_horas" name="cal_horas" class="form-control" placeholder="Horas" onkeyup="calcularTab()"  readonly value="<?php echo round($rS['cal_tap_hor'] ,2,PHP_ROUND_HALF_EVEN);?>">
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Pegado logo en tapete</label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="peg_min" name="peg_min" class="form-control" placeholder="Minutos" onkeyup="calcularTab()" value="<?php echo round($rS['peg_tap_min'],2,PHP_ROUND_HALF_EVEN); ?>">   
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="text" id="peg_horas" name="peg_horas" class="form-control" placeholder="Horas" onkeyup="calcularTab()"readonly value="<?php echo round($rS['peg_tap_hor'],2,PHP_ROUND_HALF_EVEN); ?>">   
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Corte tapete base de acuerdo a Dimensiones</label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="cort_min" name="cort_min" class="form-control"  placeholder="Minutos" onkeyup="calcularTab()" value="<?php echo round($rS['cort_tap_min'],2,PHP_ROUND_HALF_EVEN); ?>">   
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="text" id="cort_horas" name="cort_horas" class="form-control" placeholder="Horas"  onkeyup="calcularTab()" readonly value="<?php echo round($rS['cort_tap_hor'],2,PHP_ROUND_HALF_EVEN); ?>" >   
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Corte base cavidad Logo</label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="base_min" name="base_min" class="form-control"  placeholder="Minutos"  onkeyup="calcularTab()" value="<?php echo round($rS['cort_base_min'],2,PHP_ROUND_HALF_EVEN); ?>">   
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="text" id="base_Horas" name="base_Horas" class="form-control"  placeholder="Horas"  onkeyup="calcularTab()" readonly value="<?php echo round($rS['cort_base_hor'],2,PHP_ROUND_HALF_EVEN); ?>">   
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Corte Logo</label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="log_min" name="log_min" class="form-control"  placeholder="Minutos"   onkeyup="calcularTab()"value="<?php echo round($rS['cort_logo_min'],2,PHP_ROUND_HALF_EVEN); ?>">   
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="text" id="log_Horas" name="log_Horas" class="form-control"  placeholder="Horas"   onkeyup="calcularTab()" readonly value="<?php echo round($rS['cort_logo_hor'],2,PHP_ROUND_HALF_EVEN); ?>">   
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Union Logo - base (Plancha - Maxon)</label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="unio_min" name="unio_min" class="form-control"  placeholder="Minutos"  onkeyup="calcularTab()"  value="<?php echo round($rS['uni_logo_min'],2,PHP_ROUND_HALF_EVEN); ?>">   
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="text" id="unio_Horas" name="unio_Horas" class="form-control"  placeholder="Horas"  onkeyup="calcularTab()" value="<?php echo round($rS['uni_logo_hor'],2,PHP_ROUND_HALF_EVEN); ?>">   
    </div>
</div>
<div class="row"> 
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Escuadra tapete</label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="escu_min" name="escu_min" class="form-control"  placeholder="Minutos"  onkeyup="calcularTab()" value="<?php echo round($rS['esc_tap_min'],2,PHP_ROUND_HALF_EVEN); ?>">   
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="text" id="escu_Horas" name="escu_Horas" class="form-control"  placeholder="Horas"   onkeyup="calcularTab()" readonly value="<?php echo round($rS['esc_tap_hor'],2,PHP_ROUND_HALF_EVEN); ?>">   
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Perfilado</label>
        <hr style="width:0%;">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="perfi_min" name="perfi_min" class="form-control"  placeholder="Minutos"  onkeyup="calcularTab()" value="<?php echo round($rS['perf_tap_min'],2,PHP_ROUND_HALF_EVEN); ?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="text" id="perfi_Horas" name="perfi_Horas" class="form-control"  placeholder="Horas"   onkeyup="calcularTab()" readonly value="<?php echo round($rS['perf_tap_hor'],2,PHP_ROUND_HALF_EVEN);?>">   
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Resellado</label>
        <hr style="width:0%;">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="rell_min" name="rell_min" class="form-control"  placeholder="Minutos"  onkeyup="calcularTab()" value="<?php echo round($rS['rell_tap_min'],2,PHP_ROUND_HALF_EVEN); ?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="text" id="rell_Horas" name="rell_Horas" class="form-control"  placeholder="Horas"  onkeyup="calcularTab()" readonly value="<?php echo round($rS['rell_tap_hor'], 2, PHP_ROUND_HALF_EVEN); ?>"> 
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
    <label class="form-label"><strong><i>TOTAL</i></strong></label>
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="text" id="tot_Horas" name="tot_Horas" class="form-control"  placeholder="Horas" readonly value="<?php echo round($rS['tot_tapsen'],2,PHP_ROUND_HALF_EVEN); ?>"> 
    </div>
</div>
<div class="col-12 mb-3" id="respuestaSimp"></div>
<div class="row mb-3" id="errorSim"></div>
</form>
