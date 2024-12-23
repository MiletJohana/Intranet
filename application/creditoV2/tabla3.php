<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
if ((isset($_SESSION['rol']) && $_SESSION['rol'] == 100) || (isset($_POST['rol']) && $_POST['rol'] == 100)) {
    $sqltabAso = "SELECT * FROM mq_clie cl , cre_solicitud sl, cre_estadosol es, mq_usu us
    WHERE cl.id_cli = sl.id_cli 
    AND es.id_est =sl.id_est
    AND sl.id_usu=us.id_usu
    And sl.rep_sac=" . $_SESSION['id'];
    $sqltabAso .= " GROUP by sl.id_sol";
    $querytabAso = $conexion->query($sqltabAso);
} else {
    $sqltabAso = "SELECT * FROM mq_clie cl , cre_solicitud sl, cre_estadosol es, mq_usu us
    WHERE cl.id_cli = sl.id_cli 
    AND es.id_est =sl.id_est
    AND sl.id_usu=us.id_usu
    And sl.ase_com=" . $_SESSION['id'];
    $sqltabAso .= " GROUP by sl.id_sol";
    $querytabAso = $conexion->query($sqltabAso);
}
?>
<div class="col-md-12">
    <div class="p-3">
        <h5>Asociadas</h5>
    </div>
    <?php if ($querytabAso->rowCount() > 0) { ?>
        <div class="table-responsive-sm">
            <table class="table table-bordered table-sm font-table" id="tableCredito3">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre Del Cliente</th>
                        <th>Nombre de Contacto</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Actividad Solicitada</th>
                        <th>Usuario</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $querytabAso->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $r["id_sol"]; ?></td>
                            <td><?php echo $r["nom_cli"]; ?></td>
                            <td><?php echo $r["con_cli"]; ?></td>
                            <td><?php echo $r["fecha_crea"]; ?></td>
                            <td><?php echo $r['nom_est']; ?></td>
                            <td><?php echo $r["activ_solicitada"]; ?></td>
                            <td><?php echo $r["nom_usu"]; ?></td>
                            <td class="table-td-sm">
                                <?php if ($r["id_est"] == 1 && ($_SESSION['rol'] == 200 || $_SESSION['rol'] == 400)) { ?>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-secondary btn-sm rounded" id="optionsDropdown" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">
                                            <a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="EditarCrm(<?php echo $r['id_sol'] . ',' . $r['id_cli'] . ',' . $_SESSION['rol'] . ',' . $r['id_est']; ?>);"><i class="fa-solid fa-pen-to-square mr-1"></i> Editar</a>
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
                                            <a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="mostrarSeg(<?php $r['id_sol'] . ',' . $r['id_est']; ?>);"><i class="fa-solid fa-share mr-1"></i> Seguimiento</a>
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
                                            <a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="mostrarSeg(<?php $r['id_sol'] . ',' . $r['id_est']; ?>);"><i class="fa-solid fa-share mr-1"></i> Seguimiento</a>
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
                $('#tableCredito3').DataTable({
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
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            No hay resultados
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
</div>