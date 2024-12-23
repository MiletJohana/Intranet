<?php
include '../../conexion.php';
?>
<div class="row">
    <div class="col-md-6">
        <label for="id_usu3" class="form-label">Id:</label>
        <input type="text" class="form-control" id="id_usu3" name="id_usu3" value="" required onkeyup="auto();">
        <input type="hidden" id="id_usu4" name="id_usu4" value="">
        <br>
        <div class="col-md-12 datosUsu">
            <p id="nom_usu"></p>
            <p id="usuario"></p>
            <p id="cargo"></p>
        </div>
    </div>
    <div class="col-md-6">
        <label for="id_per3" class="form-label">Permisos:</label>
        <div id="permisos"></div>
    </div>
</div>