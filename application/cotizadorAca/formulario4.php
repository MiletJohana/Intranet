<?php
include '../../conexion.php';
include "../../resources/template/credentials.php";
if (isset($_POST['edit']) && $_POST['resp'] == 9 && $_POST['edit'] != '') {
    $sql = "SELECT * FROM cot_productos pro,cot_precios pre
                  WHERE pro.cod_pro=pre.cod_pro 
                    AND pro.cod_pro=" . $_POST['edit'];
    $query = $conexion->query($sql);
    $prod = null;
    if ($query->rowCount() > 0) {
        while ($r = $query->fetch(PDO::FETCH_OBJ)) {
            $prod = $r;
            break;
        }
    }
}
?>
<div class="row">
    <div class="col-12 text-center">
        <div class="col-12">
            <h3 id="titleProd">
                <?php if (isset($_POST['resp']) && $_POST['resp'] == 9) {
                    echo 'Actualizar Producto';
                } else {
                    echo 'Nuevo Producto';
                }
                ?>
            </h3>
            <hr class="mx-auto" style="width:60%;">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-1 mb-3">
        <?php if (!isset($_POST['edit'])) { ?>
            <button class="btn btn-primary" onclick="buscarProd(1)" id="buscarProd">Editar Existente</button>
        <?php } else { ?>
            <button class="btn btn-primary" onclick="buscarProd(2)" id="buscarProd">Nuevo</button>
        <?php } ?>
    </div>
    <div class="col-md-5 mb-3">
        <input class="form-control" type="hidden" name="nom_pro2" id="nom_pro2">
    </div>
</div>
<br>
<form role="form" id="form-productos" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-3 mb-3">
            <label for="cod_ref1" class="">Código Referencia</label>
            <input type="text" class="form-control" id="cod_ref1" name="cod_ref1" <?php if (!isset($_POST['edit'])) {
                                                                                        echo 'onkeyup="verifyProd(this.value,0);"';
                                                                                    } ?> value="<?php if (isset($_POST['edit']) && $_POST['resp'] == 9) {
                                                                                                    echo $prod->cod_ref . '" onkeyup="verifyProd(this.value,1);';
                                                                                                } ?>" placeholder="SKU" required>
            <input type="hidden" id="cod_pro1" name="cod_pro1" value="<?php if (isset($_POST['edit']) && $_POST['resp'] == 9) {
                                                                            echo $prod->cod_pro;
                                                                        } ?>">
            <input type="hidden" id="cod_ref2" name="cod_ref2" value="<?php if (isset($_POST['edit']) && $_POST['resp'] == 9) {
                                                                            echo $prod->cod_ref;
                                                                        } ?>">
        </div>
        <div class="col-sm-3 mb-3">
            <label for="nom_pro1" class="">Nombre</label>
            <input type="text" class="form-control" id="nom_pro1" name="nom_pro1" value="<?php if (isset($_POST['edit']) && $_POST['resp'] == 9) {
                                                                                                echo $prod->nom_pro;
                                                                                            } ?>" placeholder="Nombre del producto" required>
        </div>
        <div class="col-sm-2 mb-3">
            <label for="pre_pro1" class="">Precio</label>
            <input type="number" class="form-control" id="pre_pro1" name="pre_pro1" value="<?php if (isset($_POST['edit']) && $_POST['resp'] == 9) {
                                                                                                echo $prod->pre_pro;
                                                                                            } ?>" placeholder="Precio del producto" required>
        </div>
        <div class="col-sm-2 mb-3">
            <label for="und_emp1" class="">Unidad de empaque</label>
            <select class="form-select" id="und_emp1" name="und_emp1" style="height: 35px;" required>
                <option id="opt1" value="<?php if (isset($_POST['edit']) && $_POST['resp'] == 9) {
                                                echo $prod->und_emp;
                                            } ?>"><?php if (isset($_POST['edit']) && $_POST['resp'] == 9) {
                                                        echo $prod->und_emp;
                                                    } else {
                                                        echo 'Seleccionar';
                                                    } ?></option>
                <option value="UNID">UNID</option>
                <option value="ROLL">ROLL</option>
                <option value="BOLS">BOLS</option>
                <option value="BOTE">BOTE</option>
                <option value="CAJA">CAJA</option>
                <option value="UN">KG</option>
                <option value="CML">CML</option>
                <option value="GALO">GALO</option>
                <option value="GARR">GARR</option>
                <option value="M2">M2</option>
                <option value="PAQU">PAQU</option>
                <option value="PAR">PAR</option>
            </select>
        </div>
        <div class="col-sm-2 mb-3">
            <label for="can_emp1" class="form-label">Cantidad empaque</label>
            <input type="number" min="1" class="form-control" id="can_emp1" name="can_emp1" value="<?php if (isset($_POST['edit']) && $_POST['resp'] == 9) {
                                                                                                        echo $prod->can_emp;
                                                                                                    } ?>" placeholder="Cantidad de empaque" required>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-3 mb-3">
            <label for="des_pro1" class="form-label">Descripción</label>
            <textarea class="form-control" id="des_pro1" name="des_pro1" rows="2" value="<?php if (isset($_POST['edit']) && $_POST['resp'] == 9) {
                                                                                                echo $prod->des_pro;
                                                                                            } ?>"><?php if (isset($_POST['edit']) && $_POST['resp'] == 9) {
                                                                                                        echo $prod->des_pro;
                                                                                                    } ?></textarea>
        </div>
        <div class="col-sm-3 mb-3">
            <br>
            <label for="sin_dev1" class="btn btn-default" style="width: 270px;">
                <?php if (isset($_POST['edit']) && $_POST['resp'] == 9) { ?>
                    <input type="checkbox" id="sin_dev1" name="sin_dev1" <?php if ($prod->sin_dev == 1) {
                                                                                    echo 'checked';
                                                                                } ?>>
                <?php } else { ?>
                    <input type="checkbox" id="sin_dev1" name="sin_dev1" value="0">
                <?php } ?>
                Producto sin devolución
            </label>
            <script>
                $("#sin_dev1").on("click", function() {
                    if ($('#sin_dev1').is(':checked')) {
                        $('#sin_dev1').attr('value', '1');
                    } else {
                        $('#sin_dev1').attr('value', '0');
                    }
                });
            </script>
        </div>
        <div class="col-sm-3 mb-3">
            <label for="foto" class="form-label">Imagen</label>
            <br>
            <div class="input-file-container" style="width: 170px;">
                <input class="input-file" type="file" name="foto" id="foto" accept="image/*" style="width:170px;" <?php if (!isset($_POST['edit']) && $_POST['resp'] == 9) {
                                                                                                                        echo 'required';
                                                                                                                    } ?>>
                <label tabindex="0" for="my-file" class="input-file-trigger" id="foto1">Seleccionar</label>
                <script type="text/javascript">
                    document.getElementById('foto').onchange = function() {
                        console.log(this.value);
                        document.getElementById('foto1').innerHTML = document.getElementById('foto').files[0].name;
                    }
                </script>
            </div>
            <p class="file-return"></p>
        </div>
        <div id="img_pro1Auto"></div>
        <?php if (isset($_POST['edit']) && $_POST['resp'] == 9) { ?>
            <div class="col-sm-3 mb-3" id="img_pro1Auto1">
                <label class="">Imagen actual:</label>
                <img width="100" heigth="100" src="productos/images/<?php if (isset($_POST['edit']) && $_POST['resp'] == 9) {
                                                                            echo ($prod->img_pro);
                                                                        } ?>">
            </div>
        <?php } ?>
    </div>
    <input type="hidden" id="actionProd" name="action" value="<?php if (isset($_POST['edit']) && $_POST['resp'] == 9) {
                                                                    echo 'updateProd';
                                                                } else {
                                                                    echo 'addProd';
                                                                } ?>">
    <div class="row mb-3" id="error4"></div>
    <div class="col-md-12 mb-3" id="ProductosResp"></div>
</form>