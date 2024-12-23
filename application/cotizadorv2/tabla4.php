<?php
if (isset($_POST['resp']) && $_POST['resp'] == 'cerrar') {
    include '../../conexion.php';
}
$sql1 = "SELECT * FROM mq_clie LIMIT 100";
$query = $conexion->query($sql1);
?>
<div class="col-12">
    <?php if ($query->rowCount() > 0) { ?>
        <div class="table-responsive-sm">
            <table class="table table-bordered" id="tableClientes">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Razón social o nombre</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $r["id_cli"]; ?></td>
                            <td><?php echo $r["nom_cli"]; ?></td>
                            <td><?php echo $r["tel_cli"]; ?></td>
                            <td><?php echo $r["dir_cli"]; ?></td>
                            <td class="table-td-sm">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">
                                        <a onclick="editar(7,'<?php echo $r['id_cli']; ?>');" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#tableClientes').DataTable({
                    "ordering": true,
                    "order": [
                        [0, "desc"]
                    ]
                });
                $('.dataTables_length').addClass('bs-select');
            });
        </script>
    <?php } else { ?>
        <div class="alert alert-success alert-dismissible fade show mt-4 d-flex align-items-center" role="alert">
            <i class="fa-solid fa-circle-check me-3 fa-xl"></i>
                    No hay resultados
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
</div>