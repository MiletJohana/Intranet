<?php
    include "../../conexion_fenaseo.php";

    if ($_POST['resp'] == 2) {
        $sqlInfo = "SELECT * FROM wpgb_escala_producto WHERE id = ".$_POST['id'].";";
        $queryInfo = $conexion->query($sqlInfo);
        $rowInfo = $queryInfo->fetch(PDO::FETCH_ASSOC);

        $sqlNameProduct = "SELECT post_title FROM wpgb_posts WHERE ID = ".$rowInfo['id_producto'].";";
        $queryNameProduct = $conexion->query($sqlNameProduct);
        $rowNameProduct = $queryNameProduct->fetch(PDO::FETCH_OBJ);

        $sqlColor1 = "SELECT * FROM wpgb_escala_colores WHERE clase = '".$rowInfo['color']."';";
        $queryColor1 = $conexion->query($sqlColor1);
        $rowColor1 = $queryColor1->fetch(PDO::FETCH_ASSOC);
        $sqlColor2 = "SELECT * FROM wpgb_escala_colores WHERE clase != '".$rowInfo['color']."';";
        $queryColor2 = $conexion->query($sqlColor2);
    } else {
        $sqlColor = "SELECT * FROM wpgb_escala_colores;";
        $queryColor = $conexion->query($sqlColor);
    }

?>

<form role="form" id="form-escala-fenaseo">
    <div class="row py-3">
        <div class="col-12 text-center">
            <h3>
                Información Producto
            </h3>
            <hr class="mx-auto" style="width:60%;">
        </div>
    </div>
    <div class="row">
        <div class="col-10 mb-3" >
            <label for="nom_product" class="form-label" >Nombre del Producto</label> 
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" class="form-control" id="nom_product" name="nom_product" value="<?php echo ($_POST['resp'] == 2) ? $rowNameProduct->post_title : '';  ?>" <?php if ($_POST['resp'] == 2 ) { echo 'readonly'; }?> required onkeyup="auto();">                                                                                                       
            </div>
        </div>
        <div class="col-2 mb-3">
            <label for="id_product" class="form-label" >ID</label>
            <input type="number" class="form-control" id="id_product" name="id_product" value="<?php echo ($_POST['resp'] == 2) ? $rowInfo['id_producto'] : '';  ?>" readonly required>
        </div>
    </div> 
    
    <div class="row mt-5 mb-3">
        <div class="col-12 text-center">
            <h3>
                Información Escala
            </h3>
            <hr class="mx-auto" style="width:60%;">
        </div>
    </div>
    <?php if ($_POST['resp'] == 1) { ?>
        <div class="row">
            <div class="col-12 mb-3 d-flex justify-content-center">
                <button type="button" class="btn btn-success" onclick="agregarEscala();"><i class="fa-solid fa-circle-plus me-2"></i>Adicionar Escala</button>
            </div>
        </div>
    <?php } ?>

    <div class="row">
        <div class="col-2 mb-3">
            <label for="escala" class="form-label" >Escala</label>
            <input type="number" class="form-control" id="escala" name="escala[]" value="<?php echo ($_POST['resp'] == 2) ? $rowInfo['escala'] : '';  ?>" required>
            <?php if ($_POST['resp'] == 2) { ?>
                <input type="hidden" class="form-control" id="id_escala_product" name="id_escala_product" value="<?php echo ($_POST['resp'] == 2) ? $rowInfo['id'] : '';  ?>" readonly required>
            <?php } ?>
        </div>
        <div class="col-4 mb-3">
            <label for="precio" class="form-label" >Precio</label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" class="form-control" id="precio" name="precio[]" value="<?php echo ($_POST['resp'] == 2) ? $rowInfo['precio'] : '';  ?>" required>                                                                                                     
            </div>
        </div>
        <div class="col-2 mb-3">
            <label for="vol_min" class="form-label" >Volumen Mínimo</label>
            <input type="number" class="form-control" id="vol_min" name="vol_min[]" value="<?php echo ($_POST['resp'] == 2) ? $rowInfo['vol_min'] : '';  ?>" required>
        </div>
        <div class="col-3 mb-3">
            <label for="color" class="form-label" >Color</label>
            <select class="form-select" id="color" name="color[]" required>
                    <?php if ($_POST['resp'] == 1) { ?>
                        <option value="" selected>Seleccionar</option>
                    <?php while ($rColor = $queryColor->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $rColor['clase']; ?>" class="alert alert-<?php echo $rColor['clase']; ?>"><?php echo $rColor['color']; ?></option>
                        <?php }
                    }
                    if ($_POST['resp'] == 2) { ?>
                    <option value="<?php echo $rowColor1['clase']; ?>" class="alert alert-<?php echo $rowColor1['clase']; ?>"><?php echo $rowColor1['color']; ?></option>
                    <?php while ($rColor2 = $queryColor2->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rColor2['clase']; ?>" class="alert alert-<?php echo $rColor2['clase']; ?>"><?php echo $rColor2['color']; ?></option>
                    <?php }
                    } ?>
            </select>
        </div>
        <div class="col-1 mb-3">
            <label class="form-label" ></label>
            <button class='btn btn-danger' type="button" onclick="btn_delete_escala('escala-1');"><i class="fa-solid fa-trash"></i></button>
        </div>
    </div> 
    <input type="hidden" id="accion_form" name="action" value="<?php if ($_POST['resp'] == 1) {
                                                                echo "add";
                                                            } elseif ($_POST['resp'] == 2) {
                                                                echo "update";
                                                            } ?>">
</form>