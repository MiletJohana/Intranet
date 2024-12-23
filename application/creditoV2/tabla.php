<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
?>
<div class="col-md-12">
    <?php if ($query->rowCount() > 0) { ?>
        <div class="table-responsive-sm">
            <table class="table table-bordered table-sm font-table" id="tableCredito">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre del cliente </th>
                        <th>Nombre de Contacto</th>
                        <th>Fecha </th>
                        <th>Asesor Tecnico</th>
                        <th>Estado</th>
                        <th>Actividad Solicitada</th>
                        <th>Usuario</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td class="table-td-sm center-text">
                                <?php echo $r["id_sol"]; ?></td>
                            <td><?php echo $r["nom_cli"]; ?></td>
                            <td><?php echo $r["con_cli"]; ?></td>
                            <td><?php echo ($r["fecha_crea"]); ?></td>
                            <td><?php echo $r['nom_atc']; ?></td>
                            <td><?php echo $r['nom_est']; ?></td>
                            <td><?php echo ($r["activ_solicitada"]); ?></td>
                            <td><?php echo $r["nom_usu"]; ?></td>
                            <td class="table-td-sm">
                                <?php if ($r["id_est"] == 1 && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 400)) { ?>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-secondary btn-sm rounded" id="optionsDropdown" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">
                                            <a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="EditarCrm(<?php echo $r['id_sol'] . ',' . $r['id_cli'] . ',' . $_SESSION['rol'] . ',' . $r['id_est']; ?>);"><i class="fa-solid fa-pen-to-square mr-1"></i> Editar</a>
                                            <a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="mostrarSeg(<?php $r['id_sol'] . ',' . $r['id_est']; ?>);"><i class="fa-solid fa-share mr-1"></i> Seguimiento</a>
                                            <?php if ($_SESSION['rol'] == 400) { ?>
                                                <a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="EliminarCrm(<?php echo $r['id_sol']; ?>);"><i class="fa-solid fa-eraser mr-1"></i> Eliminar</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } else if ($r["id_est"] == 2 && ($_SESSION['rol'] == 300 || $_SESSION['rol'] == 400)) { ?>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-warning btn-sm rounded" id="optionsDropdown" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">
                                            <a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="EditarSol(<?php echo $r['id_sol'] . ',' . $r['id_cli'] . ',' . $_SESSION['rol'] . ',' . $r['id_est']; ?>);"><i class="fa-solid fa-pen-to-square mr-1"></i> Editar</a>
                                            <a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="mostrarSeg(<?php $r['id_sol'] . ',' . $r['id_est']; ?>);"><i class="fa-solid fa-share mr-1"></i> Seguimiento</a>
                                            <?php if ($_SESSION['rol'] == 400) { ?>
                                                <a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="EliminarCrm(<?php echo $r['id_sol']; ?>);"><i class="fa-solid fa-eraser mr-1"></i> Eliminar</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } else if ($r["id_est"] == 7 && ($_SESSION['rol'] == 100 || $_SESSION['rol'] == 400 ||  $_SESSION['rol'] == 500)) { ?>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-secondary btn-sm rounded" id="optionsDropdown" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">
                                            <a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="actualizaCrm(<?php echo $r['id_sol'] . ',' . $r['id_est']; ?>);"><i class="fa-solid fa-pen-to-square mr-1"></i> Editar</a>
                                            <a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="mostrarSeg(<?php $r['id_sol'] . ',' . $r['id_est']; ?>);"><i class="fa-solid fa-share mr-1"></i> Seguimiento</a>
                                            <?php if ($_SESSION['rol'] == 400) { ?>
                                                <a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="EliminarCrm(<?php echo $r['id_sol']; ?>);"><i class="fa-solid fa-eraser mr-1"></i> Eliminar</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } else if ($r["id_est"] == 8 && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 400)) { ?>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-secondary btn-sm rounded" id="optionsDropdown" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">
                                            <a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="actualizar1Crm(<?php echo $r['id_sol'] . ',' . $r['id_est']; ?>);"><i class="fa-solid fa-pen-to-square mr-1"></i> Editar</a>
                                            <a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="mostrarSeg(<?php $r['id_sol'] . ',' . $r['id_est']; ?>);"><i class="fa-solid fa-share mr-1"></i> Seguimiento</a>
                                            <?php if ($_SESSION['rol'] == 400) { ?>
                                                <a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="EliminarCrm(<?php echo $r['id_sol']; ?>);"><i class="fa-solid fa-eraser mr-1"></i> Eliminar</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-<?php if ($r["id_est"] == 1) {
                                                                                    echo 'details';
                                                                                } elseif ($r["id_est"] == 2) {
                                                                                    echo 'warning';
                                                                                } elseif ($r["id_est"] == 3) {
                                                                                    echo 'success';
                                                                                } elseif ($r["id_est"] == 4) {
                                                                                    echo 'danger';
                                                                                } else {
                                                                                    echo 'details';
                                                                                } ?> btn-sm rounded" id="optionsDropdown" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">
                                            <a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="mostrarSeg(<?php $r['id_sol'] . ',' . $r['id_est']; ?>);"><i class="fa-solid fa-share mr-1"></i> Seguimiento</a>
                                            <a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="mostrarCrm(<?php $r['id_sol'] . ',' . $r['id_est']; ?>);"><i class="fa fa-tasks mr-1"></i> Formulario</a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#tableCredito').DataTable({
                    "ordering": true,
                    "aaSorting": [],
                    "order": [
                        [0, "desc"]
                    ]
                });
                $('.dataTables_length').addClass('bs-select');
            });
        </script>
    <?php } else { ?>
        <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
            No hay resultados
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
</div>
<?php if (((isset($_SESSION['rol']) && $_SESSION['rol'] == 100) || (isset($_POST['rol']) && $_POST['rol'] == 100)) || ((isset($_SESSION['rol']) && $_SESSION['rol'] == 500) || (isset($_POST['rol']) && $_POST['rol'] == 500))) {
    include 'tabla2.php';
} ?>