<?php
include '../../resources/template/credentials.php';
include '../../conexion.php';

if (isset($_POST['edit'])) {
  $sqlEdit = "SELECT * FROM ind_solcarg WHERE id_solC=\"$_POST[edit]\"";
  $queryEdit = $conexion->query($sqlEdit);
  $r = $queryEdit->fetch(PDO::FETCH_ASSOC);
}
?>

<div class="table-responsive-sm">
    <ul class="nav nav-underline ms-2 flex-nowrap">
        <li class="nav-item" role="presentacion">
            <a class="nav-link active" href="#formulario" area-controls="formulario" data-bs-toggle="tab" role="tab" onclick="newIndicador(1,'Crear solicitud de personal','')">Solicitud Personal</a>
        </li>
        <?php if (isset($_POST['resp']) && $_POST['resp'] == '1')  { ?>
            <li class="nav-item" role="presentacion">
                <a class="nav-link" href="#formularioNew" area-controls="formularioNew" data-bs-toggle="tab" role="tab" onclick="newIndicador(4,'Nueva solicitud de personal','')">Cargo Nuevo</a>
            </li>
        <?php } ?>
    </ul>
</div>
<div class="tab-content mt-3">
    <div role="tabpanel" class="tab-pane active" id="formulario">
        <?php include 'form.php' ?>
    </div>
    <?php if (isset($_POST['resp']) && $_POST['resp'] == '1') { ?>
        <div role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade" id="formularioNew">
            <?php include 'form2.php' ?>
        </div>
    <?php } ?>
</div>