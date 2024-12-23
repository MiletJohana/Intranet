
<?php 
include '../../conexion.php';
include "../../plantilla/credentials.php";
$sqlMan="SELECT * FROM cot_tap_mano";
$queryMan=$conexion->query($sqlMan);
$rM=$queryMan->fetch_array();
?>
<div class="row">
    <div class="col-md-12 text-center">
        <h3>Mano De Obra </h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<br>
<form role="form" id="form-mano">
<input type="hidden" id="accion_form" name="action" value="addMano">
<div class="row">
        <div class="col-md-6 col-sm-12">
            <label for="sal_bas" class="form-label">Salario Basicó</label>
            <input type="number" id="sal_bas" name="sal_bas" class="form-control" onkeyup="calcularTab()" required value="<?php echo $rM['sal_bas'];?>">
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="sub_tran" class="form-label">Subsidio De Transporte</label>
            <input type="number" id="sub_tran" name="sub_tran" class="form-control" onkeyup="calcularTab()" required value="<?php echo $rM['sub_tran'];?>">
        </div>
</div><br>
<div class="row">
        <div class="col-md-6 col-sm-12">
            <label for="fac_pres" class="form-label">Factor Prestacional</label>
            <input type="text" id="fac_pres" name="fac_pres" class="form-control" onkeyup="calcularTab()" required value="<?php echo $rM['fac_pres'];?>" placeholder="Solo numeros decimales">
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="tot_sal" class="form-label">Total Salario</label>
            <input type="text" id="tot_sal" name="tot_sal" class="form-control" onkeyup="calcularTab()" required value="<?php echo round($rM['tot_sal']);?>" readonly>
        </div>
</div><br>
<div class="row">
    <div class="col-md-6 col-sm-12">
            <label for="hor_dia" class="form-label">Horas Hábiles Día</label>
            <input type="number" id="hor_dia" name="hor_dia" class="form-control"  required value="<?php echo $rM['hor_dia'];?>">
    </div>
    <div class="col-md-6 col-sm-12">
            <label for="hor_mes" class="form-label">Horas Hábiles Mes</label>
            <input type="number" id="hor_mes" name="hor_mes" class="form-control" onkeyup="calcularTab()" required value="<?php echo $rM['hor_mes'];?>">
    </div>
</div><br>
<div class="row">
    <div class="col-md-6 col-sm-12">
            <label for="cos_hor" class="form-label">Costo Hora M/O</label>
            <input type="number" id="cos_hor" name="cos_hor" class="form-control" value="<?php echo $rM['cost_hora'];?>" readonly >
    </div>
</div>
</form>