<?php
if (isset($_POST['resp']) && $_POST['resp'] == 'cerrar') {
    include '../../conexion.php';
}
$sql1 = "SELECT cot_productos.can_emp, cot_productos.cod_pro, nom_pro, des_pro, pre_pro, und_emp, img_pro, cod_ref, sin_dev
FROM cot_productos, cot_precios WHERE cot_productos.cod_pro=cot_precios.cod_pro AND nit_cli IS NULL LIMIT 100";
$query = $conexion->query($sql1);
?>
<style>
    #tableProductos_processing {
        background-color: #6b6b6b !important;
    }
</style>
<div class="col-12">
    <?php if ($query->rowCount() > 0) { ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="tableProductos">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Uni. de empaque</th>
                        <th>Devolución</th>
                        <th>Acción</th>
                    </tr>
                </thead>

                <?php if ($_SESSION['id'] == 0) { ?>
                    <tbody>
                        <?php while ($r = $query-> fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td><?php echo $r["cod_pro"]; ?></td>
                                <td><?php echo $r["cod_ref"]; ?></td>
                                <td><?php echo $r["nom_pro"]; ?>
                                    <?php if ($r["sin_dev"] == 1) { ?>
                                        <p class="text-danger">No se aceptan devoluciones</p>
                                    <?php } ?>
                                </td>
                                <td>$<?php echo substr($r["pre_pro"], 0, -3) . "." . substr($r["pre_pro"], -3); ?></td>
                                <td><?php echo $r["und_emp"] . " " . $r["can_emp"]; ?></td>
                                <td class="col-td-sm">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">
                                            <a onclick="editar(9,<?php echo $r['cod_pro']; ?>);" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                            <?php
                                            $sqlVerP = "SELECT * FROM cot_pro_x_cot where cod_pro=" . $r['cod_pro'];
                                            $queryVerP = $conexion->query($sqlVerP);
                                            if ($queryVerP->rowCount() > 0) {
                                            } else { ?>
                                                <a onclick="eliminar(14,'<?php echo $r['cod_pro']; ?>','<?php echo $r['nom_pro']; ?>',1);" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa-solid fa-eraser"></i> Eliminar</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                <?php } ?>
            </table>
        </div>
        <?php if ($_SESSION['id'] != 0) { ?>
            <script type="text/javascript">
                $(document).ready(function() {
                    serverSideProductos();
                });
            </script>
        <?php } else { ?>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#tableProductos').DataTable({
                        "ordering": true,
                        "aaSorting": [],
                        "order": [
                            [0, "asc"]
                        ]
                    });
                    $('.dataTables_length').addClass('bs-select');
                });
            </script>
        <?php } ?>
    <?php } else { ?>
        <div class="alert alert-success alert-dismissible fade show mt-4 d-flex align-items-center" role="alert">
            <i class="fa-solid fa-circle-check me-3 fa-xl"></i>
                    No hay resultados
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
</div>