<?php
include "../../resources/template/credentials.php";
include '../../conexion.php';
$sql1 = "SELECT * FROM mq_usu";
$query = $conexion->query($sql1);

?>
<div class="row">
    <div class="col-12 text-center">
        <h3>Datos de Llamada Internas</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<form role="form" id="form-llam">
    <div class="row">
        <input type="hidden" id="action" name="action" value="add">
        <input type="hidden" id="id_rem" name="id_rem" value="">
    </div>
    <div class="row">
        <div class="col-md-5 col-sm-12">
            <label for="nom_rem">Usuario </label>
            <input type="text" class="form-control" id="nom_rem" name="nom_rem" value="" required onkeyup="auto();">
        </div>
        <div class="col-md-5 col-sm-12">
            <label for="ob_llam">Observación</label>
            <textarea class="form-control" id="ob_llam" name="ob_llam" value="" required></textarea>
        </div>
        <div class="col-md-2 col-sm-12">
            <br>
            <label class="btn btn-default">
                <input type="checkbox" id="correo" name="correo" onchange="checkMail(this.value)" value="0"> Correo
            </label>
        </div>
    </div>
</form>