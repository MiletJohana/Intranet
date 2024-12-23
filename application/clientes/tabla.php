<?php
include "../../conexion.php";
$sql1 = "SELECT id_cli, tip_id, nom_cli, con_cli, dir_cli, tel_cli, eml_cli, web_cli, hor_cli FROM mq_clie ORDER BY nom_cli LIMIT 100";
$query = $conexion->query($sql1);
?>
<div class="col-md-12">
    <button type="button" onclick="crearCliente();" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#largeModal">
        Crear cliente
    </button>
    <?php if ($query->rowCount() > 0) { ?>
        <div class="table-responsive mt-4">
            <table class="table table-bordered" id="tableClientes">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Contacto</th>
                        <th>Dirección</th>
                        <th>teléfono</th>
                        <th>Email</th>
                        <th>Horario</th>
                        <th></th>
                    </tr>
                </thead>
                <?php while ($r = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td class="table-td-sm center-text"><?php echo $r["id_cli"]; ?></td>
                        <td><?php echo utf8_encode($r["nom_cli"]); ?></td>
                        <td><?php echo utf8_encode($r["con_cli"]); ?></td>
                        <td><?php echo $r["dir_cli"]; ?></td>
                        <td><?php echo $r["tel_cli"]; ?></td>
                        <td><?php echo $r["eml_cli"]; ?></td>
                        <td><?php echo $r["hor_cli"]; ?></td>
                        <td class="table-td-sm">
                            <div class="dropdown">
                                <button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">
                                    <a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="actualizarCliente(<?php echo $r['id_cli']; ?>);"><i class="fa-solid fa-pen-to-square mr-1"></i> Editar</a>
                                    <a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="eliminarCliente(<?php echo $r['id_cli']; ?>);"><i class="fa fa-trash mr-1"></i> Eliminar</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#tableClientes').DataTable({
                    "ordering": true,
                    "order": [
                        [0, "asc"]
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