<?php
include "../../conexion.php";
include '../../resources/template/credentials.php';
include "functions.php";
$sqlDesc = "SELECT * FROM ind_desc WHERE id_usus = $sesion_id";
$queryDesc = $conexion->query($sqlDesc);
?>
<div class="col-12">

    <?php if ($_SESSION['lid'] == 2 || $_SESSION['lid'] == 1 /* || $_SESSION['cargo'] == 124 || $_SESSION['cargo'] == 2400 || $_SESSION['cargo'] == 17004 */ || $_SESSION['cargo'] == 129 || $_SESSION['cargo'] == 800) { ?>
        <button type="button" onclick="newIndicador(24,'<?php if ($sesion_reg != 1) {echo 'Solicitud de Descuento de Nómina';} else {echo 'Descuentos de Nómina';} ?>','../descuentos/form.php');" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#largeModal"><?php if ($sesion_reg != 1) {
                                                                                                                                                                                                                                                                                            echo 'Solicitar Descuento';
                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                            echo 'Crear Descuento';
                                                                                                                                                                                                                                                                                        } ?></button>

    <?php } ?>

        <div class="table-responsive mt-4">
            <table class="table table-bordered" id="tableDescuentos">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Valor del descuento</th>
                        <th>Fecha De Creación</th>
                        <th>Cant. Cuotas</th>
                        <th>Tipo Desc.</th>
                        <th>Descripción</th>
                        <th>Registrado por:</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $queryDesc->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $r['id_desc']; ?></td>
                            <td><?php echo '$ ' . number_format($r['val_desc']); ?></td>
                            <td><?php echo ($r['fec_sis']);?></td>
                            <td><?php echo $r['cuo_des']; ?></td>
                            <td><?php echo tip(($r['id_tip_desc']), $conexion); ?></td>
                            <?php if (($r['otro_tip_desc']) != ''){?>
                                <td><?php echo ($r['otro_tip_desc']); ?></td>
                            <?php } else {?>
                                <td>---</td>
                            <?php } ?>
                            <td><?php echo usus(($r['id_usu']), $conexion); ?></td>
                            <td><?php echo esta(($r['id_estado']), $conexion); ?></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">
                                        <a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="ver(<?php echo $r['id_desc']; ?>, 'Aprobar Descuento', '../descuentos/aproDesc.php')"><i class="fa-solid fa-check me-1"></i> Aprobar</a>
                                        <a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="ver(<?php echo $r['id_desc']; ?>, 'Seguimiento', '../descuentos/segDesc.php')"><i class="fa-solid fa-share me-1"></i> Seguimiento</a>
                                        <a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="ver(<?php echo $r['id_desc']; ?>, 'Pagos', '../descuentos/pagDesc.php')"><i class="fa-regular fa-money-bill-1 me-1"></i> Pagos</a>
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
                $('#tableDescuentos').DataTable({
                    "ordering": true,
                    "order": [
                        [0, "desc"]
                    ]
                });
                $('.dataTables_length').addClass('bs-select');
            });
        </script>

</div>