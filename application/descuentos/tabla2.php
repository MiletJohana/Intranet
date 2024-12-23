<?php
if ((isset($_POST['resp']) && $_POST['resp'] == 'cerrar') || (isset($_POST['para']))) {
    include "../../conexion.php";
    include '../../resources/template/credentials.php';
} else {
    include "../../conexion.php";
    include '../../resources/template/credentials.php';
}
include "functions.php";

$sqlDescP = "SELECT * FROM ind_desc WHERE id_estado = 2";
$queryDescP = $conexion->query($sqlDescP);
$sqlDescApR = "SELECT * FROM ind_desc WHERE id_estado IN (3,4)";
$queryDescApR = $conexion->query($sqlDescApR);
//echo $sqlDescAp;
?>
<div class="col-12">
    <div class="p-3">
        <h5>Pendientes</h5>
    </div>
    <?php if ($queryDescP->rowCount() > 0) { ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="tableDescuentos2-1">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Solicitante</th>
                        <th>Fecha De Creación</th>
                        <th>Valor del descuento</th>
                        <th>Cant. Cuotas</th>
                        <th>Regional</th>
                        <th>Tipo Desc.</th>
                        <th>Registrado por:</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $queryDescP->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $r['id_desc']; ?></td>
                            <td><?php echo usus(($r['id_usus']), $conexion); ?></td>
                            <td><?php echo ($r['fec_sis']);?></td>
                            <td><?php echo '$ ' .  number_format($r['val_desc']); ?></td>
                            <td><?php echo $r['cuo_des']; ?></td>
                            <td><?php echo reg(($r['id_reg']), $conexion); ?></td>
                            <td><?php echo tip(($r['id_tip_desc']), $conexion); ?></td>
                            <td><?php echo usus(($r['id_usu']), $conexion); ?></td>
                            <td>
                                <button class="btn btn-success" onclick="cambiarEstado(<?php echo $r['id_desc'] ?>, 3, 0)"><i class="fa-solid fa-check"></i></button>
                                <button class="btn btn-danger" onclick="cambiarEstado(<?php echo $r['id_desc'] ?>, 4, 0)"><i class="fa-solid fa-xmark"></i></button>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">
                                        <a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="editarInd(25,'Actualizar Descuento','../descuentos/form.php',<?php echo $r['id_desc']; ?> ,'form-desc','descuentos','tabla2.php');"><i class="fa-solid fa-pen-to-square me-1"></i> Editar</a>
                                        <a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="ver(<?php echo $r['id_desc']; ?>, 'Información del Seguimiento', '../descuentos/segDesc.php')"><i class="fa-solid fa-share me-1"></i> Seguimiento</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } else { ?>
        <div class="alert alert-success alert-dismissible fade show mt-4 d-flex align-items-center" role="alert">
            <i class="fa-solid fa-circle-check me-3 fa-xl"></i>
                    No hay resultados
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <div class="p-3">
        <h5>Aprobados y Rechazados</h5>
    </div>
    <?php if ($queryDescApR->rowCount() > 0) { ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="tableDescuentos2-2">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Solicitante</th>
                        <th>Valor del descuento</th>
                        <th>Cant. Cuotas</th>
                        <th>Regional</th>
                        <th>Tipo Desc.</th>
                        <th>Registrado por:</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $queryDescApR->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $r['id_desc']; ?></td>
                            <td><?php echo usus(($r['id_usus']), $conexion); ?></td>
                            <td><?php echo '$ ' .  number_format($r['val_desc']); ?></td>
                            <td><?php echo $r['cuo_des']; ?></td>
                            <td><?php echo reg(($r['id_reg']), $conexion); ?></td>
                            <td><?php echo tip(($r['id_tip_desc']), $conexion); ?></td>
                            <td><?php echo usus(($r['id_usu']), $conexion); ?></td>
                            <td><?php echo esta(($r['id_estado']), $conexion); ?></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">
                                        <a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="editarInd(25,'Actualizar Descuento','../descuentos/form.php',<?php echo $r['id_desc']; ?> ,'form-desc','descuentos','tabla2.php');"><i class="fa-solid fa-pen-to-square me-1"></i> Editar</a>
                                        <a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="ver(<?php echo $r['id_desc']; ?>, 'Información del Seguimiento', '../descuentos/segDesc.php')"><i class="fa-solid fa-share me-1"></i> Seguimiento</a>
                                        <a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="ver(<?php echo $r['id_desc']; ?>, 'Pagos del Descuento', '../descuentos/pagDesc.php')"><i class="fa-regular fa-money-bill-1 me-1"></i> Pagos</a>
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
            $('#tableDescuentos2-1').DataTable({
                "ordering": true,
                "order": [
                    [0, "desc"]
                ]
            });
            $('#tableDescuentos2-2').DataTable({
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