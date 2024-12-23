<?php
   include "../../resources/template/credentials.php";

   if ($_POST['resp'] == 1) { ?>
        <button id="adm_inv" type="button" class="btn btn-danger" onclick="adm_inventario();"><i class="fa-solid fa-floppy-disk me-2"></i> Aplicar Cambios</button>
        <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } ?>