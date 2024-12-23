<?php
if (isset($_POST['resp']) && $_POST['resp'] == 'cerrar') {
    include '../../conexion.php';
    include '../../resources/template/credentials.php';
} elseif (isset($_POST['para'])) {
    include '../../conexion.php';
    include '../../resources/template/credentials.php';
} 
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");

$sql1 = "SELECT ind.id_solC, ind.area_sol, ar.nom_are, ind.carg_sol ,  ind.fecha_sol , ind.id_usu , us.nom_usu,ind.id_estaSol,est.nom_estS , ind.sal_sol, ind.cont_sol,ind.fecha_sol, ind.per_sol, ind.obs_sol, ind.concep_sol, ind.car_sol
FROM ind_solcarg ind,mq_are ar, mq_usu us, ind_estados est 
WHERE ind.area_sol=ar.id_are
AND ind.id_estaSol=est.id_estaSol
AND ind.id_usu=us.id_usu";
if (isset($_POST['para'])) {
    if (isset($_SESSION['are']) && $_SESSION['are'] != 9) {
        $sql1 .= " AND ind.id_usu=" . $_SESSION['id'];
    }
    $para = $_POST['para'];
    if ($para[0] == 1 && $_SESSION['are'] != 9) {
        $sql1 .= " AND ind.id_estaSol IN(1,2)
            GROUP BY ind.id_solC
            ORDER by fecha_sol";
    } else {
        $sql1 .= " AND ind.id_estaSol IN(" . $para[0] . ")
            GROUP BY ind.id_solC
            ORDER by fecha_sol";
    }
} elseif (isset($_SESSION['are']) && $_SESSION['are'] == 9) {
    $sql1 .= " AND ind.id_estaSol NOT IN(2,3,4,5)
           GROUP BY ind.id_solC
           ORDER by fecha_sol";
} else {
    $sql1 .= " AND ind.id_estaSol=est.id_estaSol
         AND ind.id_usu=" . $_SESSION['id'];
    $sql1 .= " GROUP BY ind.id_solC 
         ORDER by fecha_sol";
}
$query = $conexion->query($sql1);

//echo $sql1;
?>
<div class="col-12">
    <div class="my-3">
        <button type="button" onclick="newIndicador(1,'Crear solicitud de personal','../personal/tabsForm.php');" class="btn btn-danger btn-raised" data-bs-toggle="modal" data-bs-target="#largeModal">
            Crear solicitud
        </button>
    </div>
   
    <?php if ($query->rowCount() > 0) { ?>
        <div class="mt-4 ms-3">
            <h5>Solicitudes Nuevas</h5>
        </div>
        <div class="table-responsive-sm">
            <table class="table table-bordered table-sm font-table" id="tablePersonal1-1">
                <thead class="table-dark">
                    <tr>
                        <th> Tipo</th>
                        <th> Área solicitada</th>
                        <th> Cargo Solicitado</th>
                        <th> Fecha Solicitado</th>
                        <th> Tipo De Contrato</th>
                        <th> Salario</th>
                        <th> N° De Personas</th>
                        <th> Observacíon</th>
                        <th> Nombre Del Creador </th>
                        <th> Estado </th>
                        <?php if (isset($_POST['para']) && $para[0] == '1' && $_SESSION['are'] == 9) { ?>
                            <th> Aceptar </th>
                        <?php } elseif (isset($_SESSION['are']) && $_SESSION['are'] == 9 && !isset($para[0])) { { ?>
                            <th> Aceptar </th>
                        <?php }
                        } ?>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php   while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
                            $sqlCar = "SELECT * FROM ind_cargos WHERE id_carg='" . $r['carg_sol'] . "'";
                            $queryCar = $conexion->query($sqlCar);
                            $rCar = NULL;
                            if ($queryCar->rowCount() > 0) {
                                $rCar = $queryCar->fetch(PDO::FETCH_ASSOC);
                            }?>
                        <tr>
                            <td class="table-td-sm center-text">
                                <?php if (strlen($r["carg_sol"]) > 3) {
                                        echo 'Nuevo';
                                    } else {
                                        echo 'Existente';} ?>
                            </td>
                            <td><?php echo ($r["nom_are"]); ?></td>
                            <td><?php if ($rCar != NULL) {
                                        echo ($rCar['nom_carg']);
                                    } else {
                                        echo ($r["carg_sol"]);
                                    } ?>
                            </td>
                            <td><?php echo ($r["fecha_sol"]); ?></td>
                            <td><?php echo ($r["cont_sol"]); ?></td>
                            <td><?php echo ($r["sal_sol"]); ?></td>
                            <td><?php echo ($r["per_sol"]); ?></td>
                            <td><?php if ($r["obs_sol"] != '') {
                                        echo ($r["obs_sol"]);
                                    } elseif ($r["concep_sol"] != '') {
                                        echo ($r["concep_sol"]);
                                    } else {
                                        echo '--';} ?>
                            </td>
                            <td><?php echo ($r["nom_usu"]); ?></td>
                            <td><?php echo ($r["nom_estS"]); ?></td>
                            <?php if (isset($_POST['para']) && $para[0] == '1' && $_SESSION['are'] == 9) { ?>
                                <?php if ($r['id_estaSol'] != 2) { ?>
                                    <td align="center">
                                        <label>
                                            <input type="checkbox" value="3" name="estAp<?php $r['id_solC'] ?>" id="estAp<?php echo $r['id_solC'] ?>" onclick="aceptado(<?php echo $r['id_solC'] ?>,'<?php echo $r['carg_sol'] ?>','personal','tabla.php');">
                                        <label>
                                    </td>
                            <?php }}if (isset($_SESSION['are']) && $_SESSION['are'] == 9 && !isset($para[0])) { ?>
                                <?php if ($r['id_estaSol'] != 2) { ?>
                                    <td align="center">
                                        <label>
                                            <input type="checkbox" value="3" name="estAp<?php $r['id_solC'] ?>" id="estAp<?php echo $r['id_solC'] ?>" onclick="aceptado(<?php echo $r['id_solC'] ?>,'<?php echo $r['carg_sol'] ?>','personal','tabla.php');">
                                        </label>
                                    </td>
                            <?php }
                            } ?>
                            <td class="table-td-sm">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-secondary btn-sm bmd-btn-icon" id="optionsDropdown" data-bs-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">
                                        <?php if ($r['id_estaSol'] == 1 || $r['id_estaSol'] == 2) { ?>
                                            <a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="editarInd(2,'Actualizacion De La Solicitud','../personal/tabsForm.php','<?php echo $r['id_solC']; ?>','form-Personal','personal','tabla.php');"><i class="fa fa-edit me-2"></i> Editar</a>
                                                                                                                                                                                                                                                    <a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="informacion(0,'Información la Solicitud','../personal/informacion.php',<?php echo $r['id_solC']; ?>);"><i class="fa fa-eye me-2"></i> Ver</a>
                                            <?php if (isset($_SESSION['are']) && $_SESSION['are'] == 9) { ?>
                                                <a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="editarInd(3,'Rechazar La Solicitud','../personal/form.php','<?php echo $r['id_solC']; ?>','form-Personal','personal','tabla.php');"><i class="fa fa-user-times me-2"></i> Rechazar</a>
                                            <?php }} if ($r['id_estaSol'] != 1) { ?>
                                            <a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="informacion(0,'Información la Solicitud','../personal/informacion.php',<?php echo $r['id_solC']; ?>);"><i class="fa fa-eye me-2"></i> Ver</a>
                                            <?php } ?>
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
                $('#tablePersonal1-1').DataTable({
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
        <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
            No hay resultados
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php }
    if ($_SESSION['are'] == 9) {
        $sql1 = "SELECT ind.id_solC, ind.area_sol, ar.nom_are, ind.carg_sol , ind.fecha_sol , ind.id_usu , us.nom_usu,ind.id_estaSol,est.nom_estS , ind.sal_sol, ind.cont_sol,ind.fecha_sol, ind.per_sol,ind.obs_sol, ind.concep_sol, ind.car_sol
    FROM ind_solcarg ind,mq_are ar, mq_usu us, ind_estados est 
    WHERE ind.area_sol=ar.id_are 
    AND ind.id_estaSol=est.id_estaSol
    AND ind.id_usu=us.id_usu";
        if (isset($_POST['para']) && $para[0] != '1') {
            $sql1 .= " AND ind.id_estaSol=0";
        } else {
            $sql1 .= " AND ind.id_estaSol=2";
        }
        $sql1 .= " GROUP BY ind.id_solC
             ORDER by fecha_sol";
        $query = $conexion->query($sql1);
        //  echo $sql1;
        if ($query->rowCount() > 0) { ?>
            <div class="mt-5 ms-3">
                <h5>Solicitudes Pendientes</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-sm font-table" id="tablePersonal1-2">
                    <thead class="table-dark">
                        <tr>
                            <th> Tipo</th>
                            <th> Área solicitada</th>
                            <th> Cargo Solicitado</th>
                            <th> Fecha solicitada</th>
                            <th> Tipo De Contrato</th>
                            <th> Salario</th>
                            <th> N° De Personas</th>
                            <th> Observacíon</th>
                            <th> Nombre Del Creador </th>
                            <th> Estado </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
                            $sqlCar = "SELECT * FROM ind_cargos WHERE id_carg='" . $r['carg_sol'] . "'";
                            $queryCar = $conexion->query($sqlCar);
                            $rCar = NULL;
                            if ($queryCar->rowCount() > 0) {
                                $rCar = $queryCar->fetch(PDO::FETCH_ASSOC);
                            } ?>
                            <tr>
                                <td class="table-td-sm center-text">
                                    <?php if (strlen($r["carg_sol"]) > 3) {
                                        echo 'Nuevo';
                                    } else {
                                        echo 'Existente';} ?>
                                </td>
                                <td><?php echo($r["nom_are"]); ?></td>
                                <td><?php if ($rCar != NULL) {
                                            echo ($rCar['nom_carg']);
                                        } else {
                                            echo ($r["carg_sol"]);} ?>
                                </td>
                                <td><?php echo ($r["fecha_sol"]); ?></td>
                                <td><?php echo ($r["cont_sol"]); ?></td>
                                <td><?php echo ($r["sal_sol"]); ?></td>
                                <td><?php echo ($r["per_sol"]); ?></td>
                                <td><?php if ($r["obs_sol"] != '') {
                                            echo ($r["obs_sol"]);
                                        } elseif ($r["concep_sol"] != '') {
                                            echo ($r["concep_sol"]);
                                        } else {
                                            echo '--';} ?>
                                </td>
                                <td><?php echo ($r["nom_usu"]); ?></td>
                                <td><?php echo ($r["nom_estS"]); ?></td>                
                                <td class="table-td-sm">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-secondary btn-sm " id="optionsDropdown" data-bs-toggle="dropdown">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">
                                            <?php if ($r['id_estaSol'] == 1 || $r['id_estaSol'] == 2) { ?>
                                                <a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="editarInd(2,'Actualizacion De La Solicitud','../personal/tabsForm.php','<?php echo $r['id_solC']; ?>','form-Personal','personal','tabla.php');"><i class="fa fa-edit me-2"></i> Editar</a>
                                                <?php if (isset($_SESSION['are']) && $_SESSION['are'] == 9) { ?>
                                                    <a class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="editarInd(3,'Rechazar La Solicitud','../personal/form.php',<?php echo $r['id_solC']; ?>,'form-Personal','personal','tabla.php');"><i class="fa fa-user-times me-2"></i> Rechazar</a>
                                                <?php }} if ($r['id_estaSol'] != 1) { ?>
                                                    <a  onclick="informacion(0,'Información la Solicitud','../personal/informacion.php',<?php echo $r['id_solC']; ?>);" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal">
                                                        <i class="fa fa-eye me-2"></i> Ver
                                                    </a>
                                            <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#tablePersonal1-2').DataTable({
                        "ordering": true,
                        "responsive": true,
                        "aaSorting": [],
                        "order": [
                            [0, "desc"]
                        ]
                    });
                    $('.dataTables_length').addClass('bs-select');
                });
            </script>
            <?php } else {
            if (isset($_POST['para']) && $para[0] == '1') { ?>
                <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
                    No hay resultados
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } elseif (!isset($_POST['para'])) { ?>
                <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
                    No hay resultados
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        <?php }}} ?>
</div>