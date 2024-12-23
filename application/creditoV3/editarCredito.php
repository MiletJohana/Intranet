<div class="d-flex flex-column justify-content-center text-center">
    <label for="" class="form-label">¿Que desea realizar?</label> <br>
    <button class="btn btn-danger mb-2"onclick="editarInfoCredito(<?php echo $_POST['id_sol'] . ',' . $_POST['id_cli'] . ',' . $_POST['id_est']; ?>);" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-pen-to-square me-2"></i>Editar Información</button> 
    <button class="btn btn-danger" onclick="editarDocument(<?php echo $_POST['id_sol'] . ',' . $_POST['id_cli'] . ',' . $_POST['id_est']; ?>);" data-bs-toggle="modal" data-bs-target="#largeModal" ><i class="fa-solid fa-file me-2"></i>Editar Documentos</button>
</div>