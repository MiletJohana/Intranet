<?php
include "../../resources/template/credentials.php";
if ($_POST['resp'] == 1) { ?>
   <button id="agregar" type="button" class="btn btn-danger" onclick="crear('form-permiso','permisos','tabla.php');">Crear Permiso</button>
   <button type="button" class="btn btn-outline-dark ml-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } elseif ($_POST['resp'] == 2) { ?>
   <button id="editar" type="button" class="btn btn-danger" onclick="modPer();">Actualizar Permiso</button>
   <button id="cerrar" type="button" class="btn btn-outline-dark ml-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } elseif ($_POST['resp'] == 3) { ?>
   <button id="agregarPer" type="button" class="btn btn-danger" onclick="crear('form-perm','permisos','tabla.php');">Crear Permiso</button>
   <button id="cerrar" type="button" class="btn btn-outline-dark ml-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } elseif ($_POST['resp'] == 4) { ?>
   <button id="editar" type="button" class="btn btn-danger" onclick="modPer();">Actualizar Permiso</button>
   <button id="cerrar" type="button" class="btn btn-outline-dark ml-1" data-bs-dismiss="modal" onclick="">Cerrar</button>
<?php } elseif ($_POST['resp'] == 0) { ?>
   <button type="button" class="btn btn-outline-dark ml-1" data-bs-dismiss="modal">Cerrar</button>
<?php } ?>