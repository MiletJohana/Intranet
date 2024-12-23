<?php include "../../conexion.php"; 
?>
<form role="form" id="form-comR">
    <div class="row">
        <div class="col-md-8 col-sm-8 mt-3">
            <input type="hidden" id="accion_form" name="action" value="comentario">
            <input type="hidden" id="id_coti" name="id_coti" value="<?php echo $_POST['id_coti']?>">
            <input type="text" class="form-control" id="desc_rec"  name="desc_rec" rows="3" placeholder="Envia tu comentario" value="">
        </div>
        <?php if ($_POST['resp'] == 1) {?>
        <div class="col-md-4 col-sm-4">
            <button id="btncomR" type="button" class="btn btn-danger" onclick="enviComRec();">Enviar</button>
        </div>
        <?php }?>
    </div>
</form>
