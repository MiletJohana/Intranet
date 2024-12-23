<?php
include '../../resources/template/credentials.php';
if ($_POST['resp'] == 1) { ?>
   <?php if (isset($_POST['id_cli']) && $_POST['id_cli'] != 0) { ?>
      <button id="btnAgregar" type="button" class="btn btn-danger" onclick="agregarCorr(<?php echo $_POST['id_cli']; ?>);" disabled>Crear</button>
      <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
   <?php } else { ?>
      <button id="btnAgregar" type="button" class="btn btn-danger" onclick="agregarCorr(0);" disabled>Crear</button>
      <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
   <?php } ?>
<?php } else if ($_POST['resp'] == 5) { ?>
   <?php if ($_SESSION['are'] == 5) { ?>
      <button id="btnCont" type="button" class="btn btn-primary me-auto" onclick="contaCorr(<?php echo $_POST['id_seg'] . ',' . $_POST['id_nom'] . ',' . $_POST['id_prove'] ?>);">Contabilizar</button>
   <?php } ?>
   <button id="btnRemit" type="button" class="btn btn-success" onclick="remitirCorr();">Remitir</button>
   <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else if ($_POST['resp'] == 6) { ?>
   <button id="btnActualizar" type="button" class="btn btn-danger" onclick="actualiCorr();" disabled>Actualizar</button>
   <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else if ($_POST['resp'] == 7) { ?>
   <button id="btnCrearCorrespondencia" class="btn btn-danger" onclick="agregarCorr();">Si, crear</button>
   <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } else if ($_POST['resp'] == 8) { ?>
   <button id="btnEliminar" class="btn btn-danger" onclick="eliminarCorr();">Si</button>
   <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } else if ($_POST['resp'] == 0) { ?>
   <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } ?>
