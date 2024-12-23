<?php
include '../../resources/template/credentials.php';
if (isset($_POST['edit'])) {
    include '../../conexion.php';
}
?>
<div class="table-responsive-sm">
    <ul class="nav nav-tabs flex-nowrap">
        <li class="nav-item" role="presentacion">
            <a class="nav-link active" href="#formMan" area-controls="formMan" data-bs-toggle="tab" role="tab" onclick="newTapete(1,'Mano De Obra','')">Mano De Obra</a>
        </li>
        <li class="nav-item" role="presentacion">
            <a class="nav-link" href="#formTiemp" area-controls="formTiemp" data-bs-toggle="tab" role="tab" onclick="newTapete(2,'Tiempos De Operaciones','')">Tiempos De Operaciones</a>
        </li>
        <li class="nav-item" role="presentacion">
            <a class="nav-link" href="#formCosto" area-controls="formCosto" data-bs-toggle="tab" role="tab" onclick="newTapete(3,'Costo Material , Depreciación y Servicios Publicos','')">Costo Material , Depreciacion y Servicios Publicos</a>
        </li>
        
    </ul>
</div>
<div class="tab-content mt-3">
    <div role="tabpanel" class="tab-pane active" id="formMan">
        <?php include 'form.php' ?>
    </div>
    <div role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade" id="formTiemp">
        <?php include 'form2.php' ?>
    </div>
    <div role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade" id="formCosto">
        <?php include 'form3.php' ?>
    </div>
</div>