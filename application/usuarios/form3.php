<?php
include '../../conexion.php';
?>
<div class="row">
    <div class="col-md-6">
        <label for="id_usu" class="form-label">Id:</label>
        <input type="text" class="form-control" id="id_usu333" name="id_usu3" value="" required onkeyup="auto1();">
        <input type="hidden" id="id_usu4" name="id_usu4" value="">
        <br>
        <div class="col-md-12 datosUsu">
            <p id="nom_usu"></p>
            <p id="usuario"></p>
            <p id="correo"></p>
            <p id="fec_crea"></p>
            <p id="cargo"></p>
            <p id="usu_upt"></p>
        </div>
    </div>
    <div class="col-md-6">
        <label for="id_per3" class="form-label">Opciones:</label>
        <div id="opciones"></div>
    </div>
</div>