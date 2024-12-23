<?php 
include "../../conexion.php"; 

?>
<form role="form" id="form-comen">
    <div class="row">
        <input type="hidden" id="accion_form" name="action" value="comentario">
        <input type="hidden" id="id_coti"  name="id_coti" value="<?php echo $_POST['id_coti'];?>" >
        <input type="hidden" id="id_usu" name="id_usu" value="<?php echo $_POST['id_usu'];?>" >
        <input type="hidden" id="usu_mq" name="usu_mq" value="<?php echo $_POST['id_mq'];?>" >
        <input type="hidden" id="nom_usu" name="nom_usu" value="<?php echo $_POST['nom_usu'];?>" >
        <div class="col-md-8 col-sm-8">
            <input type="text" class="form-control" id="com_cot"  name="com_cot" rows="3" placeholder="Envia tu comentario" value="">
        </div>
        <?php if ($_POST['resp'] == 1) {?>
        <div class="col-md-4 col-sm-4">
            <button id="btnCom" type="button" class="btn btn-danger" onclick="enviarCom('<?php echo $_POST['id_coti']?>','<?php echo $_POST['id_cont'];?>','<?php echo $_POST['id_asc'];?>','<?php echo $_POST['id_mq'];?>','<?php echo $_POST['id_usu'];?>');">Enviar</button>
            <button id="cerrar" type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="">Cerrar</button>
        </div>
        <?php }?>
    </div>
</form>
