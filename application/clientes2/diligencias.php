    <div class="table-responsive">
        <table class="table table-bordered" id="tableDiligencias">
            <thead class="table-dark">
                <tr>
                    <th></th>
                    <th>#</th>
                    <th>Fecha de creación</th>
                    <th>Descripción</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <?php while ($rDil = $queryDil->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td class="table-td-sm">
                        <div class="dropdown">
                            <div class="dropdown">
                                <button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-start" aria-labelledby="optionsDropdown">
                                    <?php if ($rDil['est_dlg'] == 1) { ?>
                                        <a href="#" onclick="actualizarDilg(<?php echo $rDil['num_dlg']; ?>);" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                        <?php if ((isset($_SESSION['lid'])) && ($_SESSION['lid'] == 1 || $_SESSION['lid'] == 2)) { ?>
                                            <a href="#" onclick="eliminarDil(<?php echo $rDil['num_dlg']; ?>);" class="btn btn-link dropdown-item"><i class="fa-solid fa-eraser"></i> Eliminar</a>
                                    <?php }
                                    } ?>
                                    <a href="#" onclick="mostrarDil(<?php echo $rDil['num_dlg']; ?>);" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal"> <i class="fa fa-file"></i>Información</a>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td><?php echo $rDil['num_dlg'] ?></td>
                    <td><?php echo $rDil['fec_cre'] ?></td>
                    <td><?php echo $rDil['dil_des'] ?></td>
                    <td><?php echo $rDil['nom_tip_dlg'] ?></td>
                    <td><?php echo $rDil['nom_est_dlg'] ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tableDiligencias').DataTable({
                "ordering": true,
                "order": [
                    [0, "asc"]
                ]
            });
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
