<?php
if (isset($_POST['resp']) && $_POST['resp'] == 'cerrar') {
    include '../../conexion.php';
}
$sql1 = "SELECT  * FROM cot_contactos AS cont, mq_clie AS cli WHERE cont.id_cli = cli.id_cli ORDER BY nom_cli LIMIT 100";
$query = $conexion->query($sql1);

?>
<div class="col-12">
    <?php if ($query->rowCount() > 0) { ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="tableContactos">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Cargo</th>
                        <th>Correo</th>
                        <th>Empresa</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $r["nom_cont"]; ?></td>
                            <td><?php echo $r["car_cont"]; ?></td>
                            <td><?php echo $r["eml_cont"]; ?></td>
                            <td><?php echo $r["nom_cli"]; ?></td>
                            <td class="col-td-sm">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">
                                    <?php if (!isset($_POST['id_usu2'])) { ?>
                                    <a onclick="editar(<?php if ($r['id_tip_cot'] == 2 || $r['id_tip_cot'] == 6 || $r['id_tip_cot'] == 5 || $r['id_tip_cot'] == 9 || $r['id_tip_cot'] == 3) {
                                                                    echo '16';
                                                                } else {
                                                                    echo '6';
                                                                } ?>,<?php echo $r['id_coti']; ?>,<?php echo $_SESSION['id']; ?>);" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                        <?php } ?>
                                        <a onclick="eliminar(14,'<?php echo $r['id_cont']; ?>','<?php echo $r['nom_cont'] ?>',1);" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa-solid fa-eraser"></i> Eliminar</a>
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
                $('#tableContactos').DataTable({
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
        <div class="alert alert-success alert-dismissible fade show mt-4 d-flex align-items-center" role="alert">
            <i class="fa-solid fa-circle-check me-3 fa-xl"></i>
                    No hay resultados
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
</div>