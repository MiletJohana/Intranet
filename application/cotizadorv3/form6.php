<?php
include "../../resources/template/credentials.php";
$sql = "SELECT * from mq_usu where id_usu=" . $_POST["id_usu"];
$query = $conexion->query($sql);
$person = null;
if ($query->rowCount() > 0) {
    while ($r = $query->fetch(PDO::FETCH_OBJ)) {
        $person = $r;
        break;
    }
}
?>
<div class="row">
    <div class="col-12 text-center">
        <h3><i class="fa-solid fa-user-pen"></i></h3>
        <h3>Mis Datos</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<div class="row mb-3" id="error5"></div>
<div id="MisDatosResp" class="mb-3"></div>
<form id="form-misDatos" role="form">
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <label for="id_usu" class="form-label">Cédula:</label>
            <input type="text" class="form-control" id="id_usu" name="id_usu" value="<?php echo $person->id_usu; ?>" readonly>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <label for="nom_usu" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nom_usu" name="nom_usu" value="<?php echo $person->nom_usu; ?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <label for="usuario" class="form-label">Usuario:</label>
            <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $person->usuario; ?>" required readonly>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <label for="ext_usu" class="form-label">Extensión:</label>
            <input type="text" class="form-control" id="ext_usu" name="ext_usu" value="<?php echo $person->ext_usu; ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-3">
            <label for="cel2_usu" class="form-label">Teléfono:</label>
            <input type="text" class="form-control" id="cel2_usu" name="cel2_usu" value="<?php echo $person->cel2_usu; ?>" required>
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <label for="cel_usu" class="form-label">Celular:</label>
            <input type="text" class="form-control" id="cel_usu" name="cel_usu" value="<?php echo $person->cel_usu; ?>">
        </div>
        <div class="col-md-3 col-sm-12 mb-3">
            <label for="nom_cns" class="form-label">Nombre Cons:</label>
            <input type="text" class="form-control" id="nom_cns" name="nom_cns" value="<?php echo $person->nom_cns; ?>" required>
        </div>
        <div class="col-md-3 mb-3">
            <label for="cns_cotz" class="form-label">Consecutivo:</label>
            <input type="number" class="form-control" id="cns_cotz" name="cns_cotz" value="<?php echo $person->cns_cotz; ?>" required>
        </div>
    </div>
    <input type="hidden" name="action" value="updateDatos">
</form>
