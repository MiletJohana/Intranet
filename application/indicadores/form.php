<?php
include '../../conexion.php';
include "../../resources/template/credentials.php";
?>
<div class="row">
    <div class="col-12">
        <h3 align="center">Clima Laboral</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<form role="form" id="form-clim">
    <input type="hidden" id="accion-form" name="action" value="insClima">
    <div class="row">
        <div class="col-md-6">
            <label for="clima">Resultado de Evaluación (%)</label>
            <input type="number" class="form-control" id="clima" max="100" min="1" name="clima" required value="">
        </div>
        <div class="col-md-6">
            <label for="fec_clim">Fecha</label>
            <input type="date" class="form-control" id="fec_clim" required name="fec_clim">
        </div>
    </div>
</form>