<?php
include '../../conexion.php';
include "../../resources/template/credentials.php";
$sqlSin="SELECT * FROM cot_tap_sinlogo";
$querySin=$conexion->query($sqlSin);
$rSin=$querySin->fetch(PDO::FETCH_ASSOC);
?>

<div class="row">
    <div class="col-12 text-center">
        <h3>Tapete Sin logo </h3>
    </div>
</div>
<br>
<form role="form" id="form-Tsin">
<input type="hidden" id="accion_form" name="action" value="tapSinlogo">
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Diseño logo tapete</label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="di_min3" name="di_min3" class="form-control" placeholder="Minutos"  onkeyup="calcularTab()" value="<?php echo round($rSin['dis_tapSin_min'],2,PHP_ROUND_HALF_EVEN);?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="di_horas3" name="di_horas3" class="form-control" placeholder="Horas"  onkeyup="calcularTab()" readonly value="<?php echo round($rSin['dis_tapSin_hor'],2,PHP_ROUND_HALF_EVEN);?>" >
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Calcado logo tapete</label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="cal_min3" name="cal_min3" class="form-control" placeholder="Minutos"  onkeyup="calcularTab()" value="<?php echo round($rSin['cal_tapSin_min'],2,PHP_ROUND_HALF_EVEN);?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="cal_horas3" name="cal_horas3" class="form-control" placeholder="Horas" readonly  onkeyup="calcularTab()" value="<?php echo round($rSin['cal_tapSin_hor'],2,PHP_ROUND_HALF_EVEN);?>">
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Pegado logo en tapete</label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="peg_min3" name="peg_min3" class="form-control" placeholder="Minutos" onkeyup="calcularTab()" value="<?php echo round($rSin['peg_tapSin_min'],2,PHP_ROUND_HALF_EVEN);?>">   
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="peg_horas3" name="peg_horas3" class="form-control" placeholder="Horas" readonly  onkeyup="calcularTab()" value="<?php echo round($rSin['peg_tapSin_hor'], 2, PHP_ROUND_HALF_EVEN);?>">   
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Corte tapete base de acuerdo a Dimensiones</label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="cort_min3" name="cort_min3" class="form-control"  placeholder="Minutos"  onkeyup="calcularTab()" value="<?php echo round($rSin['cort_tapSin_min'],2,PHP_ROUND_HALF_EVEN);?>">   
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="cort_horas3" name="cort_horas3" class="form-control" placeholder="Horas" readonly onkeyup="calcularTab()" value="<?php echo round($rSin['cort_tapSin_hor'],2,PHP_ROUND_HALF_EVEN);?>" >   
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Corte base cavidad Logo</label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="base_min3" name="base_min3" class="form-control"  placeholder="Minutos"  onkeyup="calcularTab()" value="<?php echo round($rSin['cort_baseSin_min'],2,PHP_ROUND_HALF_EVEN);?>">   
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="base_Horas3" name="base_Horas3" class="form-control"  placeholder="Horas" readonly onkeyup="calcularTab()" value="<?php echo round($rSin['cort_baseSin_hor'],2,PHP_ROUND_HALF_EVEN);?>">   
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Corte Logo</label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="log_min3" name="log_min3" class="form-control"  placeholder="Minutos" onkeyup="calcularTab()" value="<?php echo round($rSin['cort_logoSin_min'],2,PHP_ROUND_HALF_EVEN);?>">   
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="log_Horas3" name="log_Horas3" class="form-control"  placeholder="Horas" readonly  onkeyup="calcularTab()"value="<?php echo round($rSin['cort_logoSin_hor'],2,PHP_ROUND_HALF_EVEN);?>">   
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Union Logo - base (Plancha - Maxon)</label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="unio_min3" name="unio_min3" class="form-control"  placeholder="Minutos" onkeyup="calcularTab()" value="<?php echo round($rSin['uni_logoSin_min'],2,PHP_ROUND_HALF_EVEN);?>">   
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="unio_Horas3" name="unio_Horas3" class="form-control"  placeholder="Horas" readonly  onkeyup="calcularTab()" value="<?php echo round($rSin['uni_logoSin_hor'],2,PHP_ROUND_HALF_EVEN);?>">   
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Escuadra tapete</label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="escu_min3" name="escu_min3" class="form-control"  placeholder="Minutos" onkeyup="calcularTab()"value="<?php echo round($rSin['esc_tapSin_min'],2,PHP_ROUND_HALF_EVEN);?>">   
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="escu_Horas3" name="escu_Horas3" class="form-control"  placeholder="Horas" readonly onkeyup="calcularTab()" value="<?php echo round($rSin['esc_tapSin_hor'],2,PHP_ROUND_HALF_EVEN);?>">   
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Perfilado</label>
        <hr style="width:0%;">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="perfi_min3" name="perfi_min3" class="form-control"  placeholder="Minutos" onkeyup="calcularTab()" value="<?php echo round($rSin['perf_tapSin_min'],2,PHP_ROUND_HALF_EVEN);?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="perfi_Horas3" name="perfi_Horas3" class="form-control"  placeholder="Horas" readonly onkeyup="calcularTab()" value="<?php echo round($rSin['perf_tapSin_hor'],2,PHP_ROUND_HALF_EVEN);?>">   
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
        <label class="form-label">Resellado</label>
        <hr style="width:0%;">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="rell_min3" name="rell_min3" class="form-control"  placeholder="Minutos" onkeyup="calcularTab()" value="<?php echo round($rSin['rell_tapSin_min'],2,PHP_ROUND_HALF_EVEN);?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="rell_Horas3" name="rell_Horas3" class="form-control"  placeholder="Horas" readonly  onkeyup="calcularTab()" value="<?php echo round($rSin['rell_tapSin_hor'],2,PHP_ROUND_HALF_EVEN);?>"> 
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mb-3">
    <label class="form-label"><strong><i>TOTAL</i></strong></label>
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input type="number" id="tot_Horas3" name="tot_Horas3" class="form-control"  placeholder="Horas" readonly value="<?php echo round($rSin['tot_tapSin'],2,PHP_ROUND_HALF_EVEN);?>"> 
    </div>
</div>
<div class="col-12 mb-3" id="respuestaSin"></div>
<div class="row mb-3" id="errorSin"></div>
</form>