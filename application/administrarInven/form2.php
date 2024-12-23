<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
date_default_timezone_set("America/Bogota");

if(isset($_POST['resp']) && $_POST['resp'] == 5){
    $sql="SELECT * FROM inv_product WHERE id_prod = ".$_POST['id'].";";
    $query = $conexion ->query($sql);
    $rowInfo = $query->fetch(PDO::FETCH_ASSOC);
}

?>

<div class="row mb-3">
    <div class="col-12 text-center">
        <h3><i class="fa-solid fa-box-archive"></i></h3>
        <?php if(isset($_POST['resp']) && $_POST['resp'] == 5){ ?>
            <h3>Editar Producto</h3>
        <?php } else { ?>
            <h3>Nuevo Producto</h3>
        <?php } ?>
    </div>
</div>
<form role="form" id="form-productos-inv" enctype="multipart/form-data">
    <div class="row">
        <div class="col-12 mb-3">
            <label for="nombre_prod" class="form-label">Nombre <span name="req" class="text-mq">*</span></label>
            <input type="text" class="form-control" id="nombre_prod" name="nom_prod" value="<?php echo (($_POST['resp'] == 5) ? $rowInfo['nom_prod'] : ""); ?>" required >
            <input type="hidden" id="id_prod" name="id_prod" value="<?php echo (($_POST['resp'] == 5) ? $_POST['id'] : ""); ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-3">
            <label for="desc_prod" class="form-label">Descripción</label>
            <textarea class="form-control" id="desc_prod" name="desc_prod" rows="3"><?php echo (($_POST['resp'] == 5) ? $rowInfo['desc_prod'] : ""); ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-3">
            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" role="switch" id="req_aprob" name="req_aprob" <?php echo (($_POST['resp'] == 5 && $rowInfo['req_aprob'] == 1) ? "checked" : ""); ?>>
                <label class="form-check-label" for="req_aprob">Requiere Aprobación</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-3">
            <label for="img_prod" class="form-label">Imagen <span name="req" class="text-mq">*</span></label> 
            <br>
            <div class="fileUpload btn btn-info">
                <span id="btn_img">Seleccionar</span>
                <input type="file" name="img_prod" id="img_prod" accept="image/*" class="upload" onchange="previewImage(event, 'file-return', 'preview-img');" <?php echo (($_POST['resp'] == 1) ? "required" : ""); ?>>
            </div>
        </div>
        <div class="<?php echo (($_POST['resp'] == 1) ? "none" : ""); ?> container_preview_img col-12 mb-3">
            <p class="form-label">Imagen <?php echo (($_POST['resp'] == 5) ? "Actual" : "Seleccionada"); ?>: <span id="file-return"><?php echo (($_POST['resp'] == 5) ? $rowInfo['img_prod'] : ""); ?></span></p>
            <br> 
            <img id="preview-img" src="<?php echo (($_POST['resp'] == 5) ? "../../documentos/inventarios/productos/".$rowInfo['img_prod'] : ""); ?>" alt="">
        </div>
    </div>
    <input type="hidden" id="accion_form" name="action" value="<?php if ($_POST['resp'] == 4) {
                                                                echo "add_prod";
                                                            } elseif ($_POST['resp'] == 5) {
                                                                echo "update_prod";
                                                            } ?>">
</form>
