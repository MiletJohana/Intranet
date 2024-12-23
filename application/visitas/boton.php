<?php if ($_POST['resp'] == 1) { ?>
  <button id="btnAgregar" type="button" class="btn btn-danger" onclick="agregarVisita();">Agregar</button>
  <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 2) { ?>
  <button id="btnAcatualizar" type="button" class="btn btn-danger" onclick="modificarVisita();">Actualizar</button>
  <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 3) { ?>
  <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="btnEliminar" value="" onclick="confirmVisita();">Eliminar</button>
  <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 4) { ?>
  <button id="btnAcatualizar" type="button" class="btn btn-danger" onclick="modificarVisitante();">Actualizar</button>
  <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 5) { ?>
  <button type="button" class="btn btn-secondary me-auto" onclick="crearVisita();"><i class="fa-solid fa-arrow-left me-3"></i> Volver</button>
  <button id="btnAgregar" type="button" class="btn btn-danger" onclick="agregarVisitante();">Agregar</button>
  <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } elseif ($_POST['resp'] == 6) { ?>
  <button id="btnAgregar" type="button" class="btn btn-danger" onclick="crearEncuesta();" >Crear Encuesta</button>
  <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Cerrar</button>
<?php } else { ?>
  <button type="button" class="btn btn-secondary ms-1" onclick="refreshTable();" data-bs-dismiss="modal">Cerrar</button>
<?php } ?>