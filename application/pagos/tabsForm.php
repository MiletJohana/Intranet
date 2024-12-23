<?php
include '../../resources/template/credentials.php';
if (isset($_POST['edit'])) {
    include '../../conexion.php';
}
?>
<div class="table-responsive-sm">
    <ul class="nav nav-underline flex-nowrap">
        <li class="nav-item" role="presentacion">
            <a class="nav-link active" href="#formVariab" area-controls="formVariab" data-bs-toggle="tab" role="tab" onclick="newIndicador(11,'Variable','')">Variable</a>
        </li>
        <li class="nav-item" role="presentacion">
            <a class="nav-link" href="#formNom" area-controls="formNom" data-bs-toggle="tab" role="tab" onclick="newIndicador(12,'Nomina','')">Nomina</a>
        </li>
        <li class="nav-item" role="presentacion">
            <a class="nav-link" href="#formSeguridad" area-controls="formSeguridad" data-bs-toggle="tab" role="tab" onclick="newIndicador(13,'Seguridad Social','')">Seguridad Social</a>
        </li>
        <li class="nav-item" role="presentacion">
            <a class="nav-link" href="#formPrima" area-controls="formPrima" data-bs-toggle="tab" role="tab" onclick="newIndicador(14,'Prima','')">Prima</a>
        </li>
        <li class="nav-item" role="presentacion">
            <a class="nav-link" href="#formCesantias" area-controls="formCesantias" data-bs-toggle="tab" role="tab" onclick="newIndicador(15,'Cesantías','')">Cesantías</a>
        </li>
    </ul>
</div>
<div class="tab-content mt-3">
    <div role="tabpanel" class="tab-pane active" id="formVariab">
        <?php include 'form.php'; ?>
    </div>
    <div role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade" id="formNom">
        <?php include 'form2.php'; ?>
    </div>
    <div role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade" id="formSeguridad">
        <?php include 'form3.php'; ?>
    </div>
    <div role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade" id="formPrima">
        <?php include 'form4.php'; ?>
    </div>
    <div role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade " id="formCesantias">
        <?php include 'form5.php'; ?>
    </div>
</div>