<?php
if ((isset($_POST['resp']) && $_POST['resp'] == 'cerrar') || (isset($_POST['para']))) {
    include "../../conexion.php";
    include '../../resources/template/credentials.php';
} else {
    include "../../conexion.php";
    include '../../resources/template/credentials.php';
}
include "functions.php";

//historico
if ($sesion_are == 9 || $sesion_lid == 1) {
    if (isset($_POST['para'])) {
        $para = $_POST['para'];
        $sqlDescAp = "SELECT * FROM ind_desc WHERE fec_sis LIKE '$para[1]%'";
    } else {
        $sqlDescAp = "SELECT * FROM ind_desc";
    }
    $queryDescAp = $conexion->query($sqlDescAp);
} else if ($_SESSION['cargo'] == 550 || $_SESSION['cargo'] == 124 || $_SESSION['cargo'] == 17004) {
    $sqlDescAp = "SELECT * FROM ind_desc WHERE id_tip_desc = 2";
    $queryDescAp = $conexion->query($sqlDescAp);
}
$queryDescAp = $conexion->query($sqlDescAp);
//echo $sqlDescAp;
?>
<div class="col-12">
    <div class="p-3">
        <h5>Histórico</h5>
    </div>
    <?php if ($queryDescAp->rowCount() > 0) { ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="tableDescuentos3">
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
                        <th>N° Factura</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $queryDescAp->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $r['id_desc']; ?></td>
                            <td><?php echo usus(($r['id_usus']), $conexion); ?></td>
                            <td><?php echo ($r['fec_sis']);?></td>
                            <td><?php echo '$ ' .  number_format($r['val_desc']); ?></td>
                            <td><?php echo $r['cuo_des']; ?></td>
                            <td><?php echo reg(($r['id_reg']), $conexion); ?></td>
                            <td><?php echo tip(($r['id_tip_desc']), $conexion); ?></td>
                            <td><?php echo usus(($r['id_usu']), $conexion); ?></td>
                            <?php if ($r['fact_desc']!=''){?>
                                <td><?php echo ($r['fact_desc']);?></td>
                            <?php }else if ($r['fact_desc']==''){ ?>
                                <td><?php echo'--';?></td>
                            <?php } ?>
                            <td><?php echo esta(($r['id_estado']), $conexion); ?></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">
                                        <a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="editarInd(25,'Actualizar Descuento','../descuentos/form.php',<?php echo $r['id_desc']; ?> ,'form-desc','descuentos','tabla3.php');"><i class="fa-solid fa-pen-to-square me-1"></i> Editar</a>
                                        <a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="ver(<?php echo $r['id_desc']; ?>, 'Información del Seguimiento', '../descuentos/segDesc.php')"><i class="fa-solid fa-share me-1"></i> Seguimiento</a>
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
            $('#tableDescuentos3').DataTable({
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