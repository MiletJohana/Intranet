<?php 
include '../../conexion.php';
include "../../plantilla/credentials.php";
$sqlmano="SELECT * FROM cot_tap_mano";
$querymano=$conexion->query($sqlmano);
$rm=$querymano->fetch(PDO::FETCH_ASSOC);

$sqlcost="SELECT * FROM cot_tap_costos";
$querycost=$conexion->query($sqlcost);
$rCos=$querycost->fetch(PDO::FETCH_ASSOC);

$sqlDepre="SELECT * FROM cot_tap_depre";
$queryDepre=$conexion->query($sqlDepre);
$rD=$queryDepre->fetch(PDO::FETCH_ASSOC);

$sqlServ="SELECT * FROM cot_tap_serpublicos";
$queryServ=$conexion->query($sqlServ);
$rS=$queryServ->fetch(PDO::FETCH_ASSOC);
$mano=$rm['hor_mes'];

?>
<div class="row">
    <div class="col-12 text-center">
        <h3>Costo Material </h3>
        <hr class="mx-auto" style="width:70%;">
    </div>
</div>
<form role="form" id="form-costos">
<input type="hidden" id="accion_form" name="action" value="costos">
<div class="row">
    <div class="col-md-3 col-sm-12 mt-5">
        <label class="form-label"><strong>Perfil Mediano</strong></label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="cl_medi" class="form-label">Valor Cl</label>
        <input type="number" id="cl_medi" name="cl_medi" class="form-control" placeholder="$" required value="<?php echo $rCos['perm_cl'];?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="ml_medi" class="form-label">Valor Ml</label>
        <input type="number" id="ml_medi" name="ml_medi" class="form-control" placeholder="$" required value="<?php echo $rCos['perm_ml'];?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="m2_medi" class="form-label">Valor M2</label>
        <input type="number" id="m2_medi" name="m2_medi" class="form-control" placeholder="$" required value="<?php echo $rCos['perm_m'];?>">
    </div>
</div><br>
<div class="row">
    <div class="col-md-3 col-sm-12 mt-5">
        <label class="form-label"><strong> Perfil Grueso</strong></label>
        <hr style="width:0%;" > 
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="cl_gru" class="form-label">Valor Cl</label>
        <input type="number" id="cl_gru" name="cl_gru" class="form-control" placeholder="$" required value="<?php echo $rCos['perg_cl'];?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="ml_gru" class="form-label">Valor Ml</label>
        <input type="number" id="ml_gru" name="ml_gru" class="form-control" placeholder="$" required value="<?php echo $rCos['perg_ml'];?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="m2_gru" class="form-label">Valor M2</label>
        <input type="number" id="m2_gru" name="m2_gru" class="form-control" placeholder="$" required value="<?php echo $rCos['perg_m'];?>">
    </div>
</div><br>
<div class="row">
    <div class="col-md-3 col-sm-12 mt-5">
        <label class="form-label"><strong> Nomad T3000</strong></label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="cl_t3" class="form-label">Valor Cl</label>
        <input type="number" id="cl_t3" name="cl_t3" class="form-control" placeholder="$" onkeyup="calcularTab()" required value="<?php echo $rCos['nomtre_cl'];?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="ml_t3" class="form-label">Valor Ml</label>
        <input type="number" id="ml_t3" name="ml_t3" class="form-control" placeholder="$" readonly  required value="<?php echo $rCos['nomtre_ml'];?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="m2_t3" class="form-label">Valor M2</label>
        <input type="text" id="m2_t3" name="m2_t3" class="form-control" placeholder="$" readonly required value="<?php echo round($rCos['nomtre_m'],3,PHP_ROUND_HALF_EVEN);?>">
    </div>
</div><br>
<div class="row">
    <div class="col-md-3 col-sm-12 mt-5">
        <label class="form-label"><strong> Tapete Nomad T1000</strong></label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="cl_t1" class="form-label">Valor Cl</label>
        <input type="number" id="cl_t1" name="cl_t1" class="form-control" placeholder="$" onkeyup="calcularTab()" required value="<?php echo $rCos['nomil_cl'];?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="ml_t1" class="form-label">Valor Ml</label>
        <input type="number" id="ml_t1" name="ml_t1" class="form-control" placeholder="$" readonly required value="<?php echo $rCos['nomil_ml'];?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="m2_t1" class="form-label">Valor M2</label>
        <input type="text" id="m2_t1" name="m2_t1" class="form-control" placeholder="$" readonly  required value="<?php echo round($rCos['nomil_m'],3,PHP_ROUND_HALF_EVEN);?>">
    </div>
</div><br>
<div class="row">
    <div class="col-md-3 col-sm-12 mt-5">
        <label class="form-label"> <strong>Tapete Koreano Trafico Pesado</strong></label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="cl_tkor" class="form-label">Valor Cl</label>
        <input type="number" id="cl_tkor" name="cl_tkor" class="form-control" placeholder="$" required value="<?php echo $rCos['korl_cl'];?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="ml_tkor" class="form-label">Valor Ml</label>
        <input type="number" id="ml_tkor" name="ml_tkor" class="form-control" placeholder="$" required readonly value="<?php echo $rCos['korl_ml'];?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="m2_tkor" class="form-label">Valor M2</label>
        <input type="number" id="m2_tkor" name="m2_tkor" class="form-control" placeholder="$" required onkeyup="calcularTab()" value="<?php echo $rCos['korl_m'];?>">
    </div>
</div><br>
<div class="row">
    <div class="col-md-3 col-sm-12 mt-5">
        <label class="form-label"><strong> Tapete Koreano Trafico Liviano</strong></label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="cl_tliv" class="form-label">Valor Cl</label>
        <input type="number" id="cl_tliv" name="cl_tliv" class="form-control" placeholder="$" required  value="<?php echo $rCos['korp_cl'];?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="ml_tliv" class="form-label">Valor Ml</label>
        <input type="number" id="ml_tliv" name="ml_tliv" class="form-control" placeholder="$" required readonly value="<?php echo $rCos['korp_ml'];?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="m2_tliv" class="form-label">Valor M2</label>
        <input type="text" id="m2_tliv" name="m2_tliv" class="form-control" placeholder="$" required onkeyup="calcularTab()" value="<?php echo $rCos['korp_m'];?>">
    </div>
</div><br>
<div class="row">
    <div class="col-md-3 col-sm-12 mt-5">
        <label class="form-label"><strong> Tapete Boston</strong></label><hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="cl_boston" class="form-label">Valor Cl</label>
        <input type="number" id="cl_boston" name="cl_boston" class="form-control" placeholder="$" required  onkeyup="calcularTab()" value="<?php echo $rCos['bost_cl'];?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="ml_boston" class="form-label">Valor Ml</label>
        <input type="number" id="ml_boston" name="ml_boston" class="form-control" placeholder="$" required readonly value="<?php echo $rCos['bost_ml'];?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="m2_boston" class="form-label">Valor M2</label>
        <input type="text" id="m2_boston" name="m2_boston" class="form-control" placeholder="$" required  readonly value="<?php echo round($rCos['bost_m'],3,PHP_ROUND_HALF_EVEN);?>">
    </div>
</div><br>
<div class="row">
    <div class="col-md-3 col-sm-12 mt-5">
        <label class="form-label"><strong> Tapete Aqua</strong></label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="cl_aqua" class="form-label">Valor Cl</label>
        <input type="number" id="cl_aqua" name="cl_aqua" class="form-control" placeholder="$" required onkeyup="calcularTab()" value="<?php echo $rCos['aqua_cl'];?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="ml_aqua" class="form-label">Valor Ml</label>
        <input type="number" id="ml_aqua" name="ml_aqua" class="form-control" placeholder="$" required readonly value="<?php echo $rCos['aqua_ml'];?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="m2_aqua" class="form-label">Valor M2</label>
        <input type="text" id="m2_aqua" name="m2_aqua" class="form-control" placeholder="$" required readonly value="<?php echo round($rCos['aqua_m'],3,PHP_ROUND_HALF_EVEN);?>">
    </div>
</div><br>
<div class="row">
    <div class="col-md-3 col-sm-12 mt-5">
        <label class="form-label"><strong>Nomad Sin Base</strong></label>
        <hr style="width:0%;" >
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="cl_nsb" class="form-label">Valor Cl</label>
        <input type="number" id="cl_nsb" name="cl_nsb" class="form-control" placeholder="$" required onkeyup="calcularTab()" value="<?php echo $rCos['nomsinb_cl'];?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="ml_nsb" class="form-label">Valor Ml</label>
        <input type="number" id="ml_nsb" name="ml_nsb" class="form-control" placeholder="$" required readonly value="<?php echo $rCos['nomsinb_ml'];?>">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <label for="m2_nsb" class="form-label">Valor M2</label>
        <input type="text" id="m2_nsb" name="m2_nsb" class="form-control" placeholder="$" required readonly value="<?php echo round($rCos['nomsinb_m'],3,PHP_ROUND_HALF_EVEN);?>">
    </div>
</div><br>

<div class="row">
    <div class="col-12 text-center">
        <h3>Costo Insumos </h3>
        <hr class="mx-auto" style="width:70%;">
    </div>
</div><br>
<div class="row">
    <div class="col-md-4 col-sm-12 mt-5">
        <label class="form-label"><strong>Pegante Maxon (Cuñete 8 Galones) </strong></label>
    </div>
    <div class="col-md-4 col-sm-12 mb-3">
        <label for="val_peg" class="form-label">Valor</label>
        <input type="number" id="val_peg" name="val_peg" class="form-control" placeholder="$" required value="<?php echo $rCos['val_pegan'];?>">
    </div>
    <div class="col-md-4 col-sm-12 mb-3">
        <label for="val_tapete" class="form-label">Valor x Tapete</label>
        <input type="number" id="val_tapete" name="val_tapete" class="form-control" placeholder="$" required value="<?php echo $rCos['val_pegxtap'];?>">
    </div>
</div><br>
<div class="row">
    <div class="col-md-4 col-sm-12 mt-5">
        <label class="form-label"><strong>Pliego papel bond</strong></label>
    </div>
    <div class="col-md-4 col-sm-12 mb-3">
        <label for="val_bond" class="form-label">Valor</label>
        <input type="number" id="val_bond" name="val_bond" class="form-control" placeholder="$" required value="<?php echo $rCos['papel_bond'];?>">
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12 text-center">
        <h3>Depreciacion</h3>
        <hr class="mx-auto" style="width:70%;">
    </div>
</div><br>
<div class="row">
    <div class="col-md-4 col-sm-12 mt-5">
        <label class="form-label"><strong>Mesa Plancha</strong></label>
    </div>
    <div class="col-md-4 col-sm-12 mb-3">
        <label for="vr_depre" class="form-label"><strong> Vr Depreciado </strong></label>
        <input type="number" id="vr_depre" name="vr_depre" class="form-control" placeholder="$" required value="<?php echo $rD['vr_depre'];?>">
    </div>
    <div class="col-md-4 col-sm-12 mb-3">
        <label for="vr_xdepre" class="form-label"><strong> Vr x Depreciado</strong></label>
        <input type="number" id="vr_xdepre" name="vr_xdepre" class="form-control" placeholder="$" required value="<?php echo $rD['vr_xdepre'];?>">
    </div>
</div><br>
<div class="row">
    <div class="col-md-4 col-sm-12 mt-5"></div>
    <div class="col-md-4 col-sm-12 mb-3">
        <label for="dep_mes" class="form-label"><strong>Dep Mes</strong></label>
        <input type="number" id="dep_mes" name="dep_mes" class="form-control" placeholder="$" onkeyup="calcularTab()" required value="<?php echo $rD['dep_mes'];?>">
    </div>
    <div class="col-md-4 col-sm-12 mb-3">
        <label for="dep_hora" class="form-label"><strong>Dep Hora</strong></label>
        <input type="number" id="dep_hora" name="dep_hora" class="form-control" placeholder="$" required value="<?php echo $rD['dep_hora'];?>">
    </div>
</div><br>
<div class="row">
    <div class="col-md-12 text-center">
        <h3>Servicios Publicos </h3>
        <hr class="mx-auto" style="width:70%;">
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-sm-12 mt-5">
        <label class="form-label"><strong>Energia</strong></label>
    </div>
    <div class="col-md-4 col-sm-12 mb-3">
        <label for="cos_mes" class="form-label"><strong>Costo mes</strong></label>
        <input type="number" id="cos_mes" name="cos_mes" class="form-control" placeholder="$" required value="<?php echo $rS['ener_mes'];?>">
    </div>
    <div class="col-md-4 col-sm-12 mb-3">
        <label for="cos_hor" class="form-label"><strong>Costo Hora</strong></label>
        <input type="number" id="cos_hor" name="cos_hor" class="form-control" placeholder="$" required value="<?php echo $rS['ener_hora'];?>">
    </div>
</div><br>
<div class="row">
    <div class="col-md-4 col-sm-12 mt-5">
        <label class="form-label"><strong>Consumo Promedio Planta</strong></label>
    </div>
    <div class="col-md-4 col-sm-12 mb-3">
        <label for="plan_mes" class="form-label"><strong>Costo mes</strong></label>
        <input type="number" id="plan_mes" name="plan_mes" class="form-control" placeholder="$" onkeyup="calcularTab()" required value="<?php echo $rS['cons_mes'];?>">
    </div>
    <div class="col-md-4 col-sm-12 mb-3">
        <label for="plan_hor" class="form-label"><strong>Costo Hora</strong></label>
        <input type="number" id="plan_hor" name="plan_hor" class="form-control" placeholder="$" required value="<?php echo $rS['cons_hora'];?>">
    </div>
</div><br>
<div class="row">siat_mes
    <div class="col-md-4 col-sm-12 mt-5">
        <label class="form-label"><strong>Consumo SIAT, Rebobinadora</strong></label>
    </div>
    <div class="col-md-4 col-sm-12 mb-3">
        <label for="siat_mes" class="form-label"><strong>Costo mes</strong></label>
        <input type="number" id="siat_mes" name="siat_mes" class="form-control" placeholder="$" onkeyup="calcularTab()" readonly required value="<?php echo $rS['siat_mes'];?>">
    </div>
    <div class="col-md-4 col-sm-12 mb-3">
        <label for="siat_hor" class="form-label"><strong>Costo Hora</strong></label>
        <input type="number" id="siat_hor" name="siat_hor" class="form-control" placeholder="$" readonly required value="<?php echo round($rS['siat_hora']);?>">
    </div>
</div>
</form>
