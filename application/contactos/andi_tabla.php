<?php
include "../../conexion.php";

$sql1 = "SELECT * FROM contactos_andi";
$query = $conexion->query($sql1);
?>
<div class="col-12">
    <?php if ($query->rowCount() > 0) { ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="tableContactosAndi">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Cargo</th>
                        <th>Productos de interés</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
                        $sqlCat = "SELECT cat.* FROM cot_categoria AS cat 
                        INNER JOIN cat_x_cont_andi AS cxn
                        ON cat.id_cat = cxn.id_cat
                        WHERE cxn.id_cont = " . $r["id_cont"] .
                            " ORDER BY cat.id_cat ASC";
                        $queryCat = $conexion->query($sqlCat); ?>
                        <tr>
                            <td><?php echo $r["id_cont"]; ?></td>
                            <td><?php echo $r["nom_cli"]; ?></td>
                            <td><?php echo $r["nom_cont"]; ?></td>
                            <td><?php echo $r["tel_cont"]; ?></td>
                            <td><?php echo $r["eml_cont"]; ?></td>
                            <td><?php echo $r["car_cont"]; ?></td>
                            <td>
                                <?php
                                $i = 0;
                                $j = $queryCat->rowCount();
                                while ($rC = $queryCat->fetch(PDO::FETCH_ASSOC)) {
                                    echo $rC["nom_cat"];
                                    $i++;
                                    if ($i != $j) {
                                        echo ", ";
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#tableContactosAndi').DataTable({
                    "ordering": true,
                    "order": [
                        [0, "asc"]
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