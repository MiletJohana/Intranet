<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
date_default_timezone_set("America/Bogota");

$sqlArea="SELECT * FROM mq_are WHERE id_are != ?;";
$queryArea= $conexion ->prepare($sqlArea);
$queryArea -> execute([10]);
$rowInfoArea = $queryArea->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="row mb-3">
    <div class="col-12 text-center">
        <h3><i class="fa-solid fa-users-gear"></i></h3>
        <h3 id="text-principalA">Nueva Área</h3>
    </div>
</div>
<form role="form" id="form-areas-inv" enctype="multipart/form-data">
    <div class="row">
            <div class="col-sm-1 my-3">
                    <button id="editar_are" class="btn btn-danger btn-circle" type="button" value="8" onclick="editarAre(this.value)" for="search" data-bs-toggle="collapse" data-bs-target="#collapse-search" aria-expanded="false" aria-controls="collapse-search">
                        <i class="fa-solid fa-pen-to-square" style="font-size: .8em;"></i>
                    </button>

            </div>
            <div class="col-sm-11 my-3">
                <span class="collapse" id="collapse-search">
                    <select class="form-select" name="select_are" id="select_are" onchange="asignar_area(2);">
                        <option selected>Seleccionar el área a modificar</option>
                        <?php foreach ($rowInfoArea as $area) {?> 
                            <option value="<?php echo $area["id_are"]; ?>" id="area<?php echo $area["id_are"]; ?>"><?php echo $area["nom_are"]; ?></option>
                        <?php } ?>
                    </select>
                </span>
            </div>
    </div>
    <div class="row">
        <div class="col-12 mb-3">
            <label for="nom_are" id="label_nom_are" class="form-label">Nombre <span name="req" class="text-mq">*</span></label>
            <input type="text" class="form-control" id="nom_are" name="nom_are" value="<?php echo (($_POST['resp'] == 8) ? $rowInfo['nom_are'] : ""); ?>" required >
            <input type="hidden" id="id_are" name="id_are" value="<?php echo (($_POST['resp'] == 8) ? $_POST['id'] : ""); ?>">
        </div>
    </div>
    <input type="hidden" id="accion_form" name="action" value="add_are">
  
</form>
