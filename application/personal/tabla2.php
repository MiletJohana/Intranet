<?php
if (isset($_POST['resp']) && $_POST['resp'] == 'cerrar') {
    include '../../conexion.php';
    include '../../resources/template/credentials.php';
} elseif (isset($_POST['para'])) {
    include '../../conexion.php';
    include '../../resources/template/credentials.php';
} else {
    include "../../conexion.php";
    include '../../resources/template/credentials.php';
}
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");
$sqlEst = "SELECT * FROM `ind_estados` WHERE id_estaSol in(2,3,4)";
$sql1 = "SELECT per.id_sel, per.id_solC, per.id_per, per.nom_per, per.cel_per , per.fec_ent, per.obs_sel,per. id_estaSol, per.obs_lid, per.obs_ger, per.fec_cre,
per.obs_th, per.req_sol,per.pro_entre,per.pro_prue, per.pro_ana, per.pro_poli, per.pro_visi, per.fec_req, ar.nom_are, ind.carg_sol
 FROM ind_select_per per,mq_are ar,ind_estados es";
if (isset($_POST['para'])) {
    $para = $_POST['para'];
    if ($para[0] != '') {
        if ($para[0] == '1') {
            $sql1 .= ",ind_solcarg ind  WHERE per.id_are=ar.id_are AND req_sol=$para[0] AND per.fec_ent LIKE '.$para[1].'";
        } else {
            $sql1 .= ",ind_solcarg ind WHERE ind.area_sol=ar.id_are AND ind.id_solC=per.id_solC";
        }
        $sql1 .= " AND per.id_estaSol=es.id_estaSol
                     AND per.id_estaSol IN ($para[0])
                     AND per.fec_ent LIKE '$para[1]%'";
    } else {
        //$sql1.=" AND req_sol=$para[1]";
    }
} else {
    $sql1 .= ",ind_solcarg ind WHERE ind.area_sol=ar.id_are 
             AND ind.id_solC=per.id_solC
             AND per.id_estaSol=es.id_estaSol
             AND per.id_estaSol IN (1,2)
             AND req_sol=0";
}

$sql1 .= " GROUP BY per.id_sel ORDER BY fec_ent ASC";
$query = $conexion->query($sql1);
//echo $sql1;
$queryEst = $conexion->query($sqlEst);
$opc = array();
//echo $sqlEst;

function colorDropdown($estado, $conexion)
{
    $sqlColor = "SELECT * from ind_estados where id_estaSol=$estado";
    $queryColors = $conexion->query($sqlColor);
    $rC = $queryColors->fetch(PDO::FETCH_ASSOC);
    echo $rC["color"];
}
while ($val = $queryEst->fetch(PDO::FETCH_ASSOC)) {
    array_push($opc, $val);
}

?>
<div class="col-12 mt-3">
    <?php if ($query->rowCount() > 0) { ?>
        <div class="table-responsive">
            <table class="table table-bordered table-sm" id="tablePersonal2">
                <thead class="table-dark">
                    <tr>
                        <th> Entrevistado</th>
                        <th> Cargo</th>
                        <th style="width: 100px !important;"> Fecha Entrevista </th>
                        <?php if ($_SESSION['are'] == 9 || $_SESSION['lid'] == 1) { ?>
                            <th> Obs. TH </th>
                        <?php }
                        if ($_SESSION['are'] == 9 || $_SESSION['lid'] == 1 || $_SESSION['lid'] == 2) { ?>
                            <th> Obs. Líder </th>
                        <?php }
                        if ($_SESSION['are'] == 9 || $_SESSION['lid'] == 1 || $_SESSION['lid'] == 4) { ?>
                            <th> Obs. Gerente </th>
                        <?php }
                        if ($_SESSION['are'] == 9 || $_SESSION['lid'] == 1) { ?>
                            <th> Estado </th>
                        <?php }
                        if ($_SESSION['are'] == 9 || $_SESSION['lid'] == 4) { ?>
                            <th></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
                        if ($r['req_sol'] == 0) {
                            $sqlSol = "SELECT * FROM ind_solcarg WHERE id_solC=" . $r['id_solC'];
                            $querySol = $conexion->query($sqlSol);
                            $rSol = $querySol->fetch(PDO::FETCH_ASSOC);
                            $sqlCar = "SELECT * FROM ind_select_per WHERE id_estaSol='3' AND id_solC=" . $r['id_solC'];
                            $queryCar = $conexion->query($sqlCar);
                            if ($rSol['id_estaSol'] == 3 && $queryCar->rowCount() == $rSol['per_sol']) {
                                $est = '2,4';
                            } elseif ($rSol['id_estaSol'] == 1 || $rSol['id_estaSol'] == 2 || $queryCar->rowCount() != $rSol['per_sol']) {
                                $est = '2,3,4';
                            } elseif ($rSol['id_estaSol'] == 4) {
                                $est = '4';
                            }
                        } else {
                            $est = '2,3,4';
                        }

                        $sqlCar = "SELECT * FROM ind_carg_x_are cxa,ind_cargos car,mq_are ar
                            WHERE cxa.id_carg=car.id_carg
                            AND cxa.id_are=ar.id_are
                            AND car.id_carg='" . $r['carg_sol'] . "'";
                        $queryCar = $conexion->query($sqlCar);
                        $rCar = NULL;
                        if ($queryCar->rowCount() > 0) {
                            $rCar = $queryCar->fetch(PDO::FETCH_ASSOC);
                        }
                    ?>
                        <tr>
                            <td><?php echo $r['nom_per'] . '<br>ID: ' . $r['id_per'] . '<br>Cel: ' . $r['cel_per'] ?></td>
                            <td><?php if ($rCar != NULL) {
                                    echo $rCar['nom_carg'] . '<br>' . $rCar['nom_are'];
                                } else {
                                    echo $r['carg_sol'] . '<br>' . $r['nom_are'];
                                } ?></td>
                            <td><?php echo $r['fec_ent'] ?></td>
                            <?php if ($_SESSION['are'] == 9 || $_SESSION['lid'] == 1) { ?>
                                <td style="width: 300px !important;">
                                    <textarea type="text" name="obsTH" class="form-control" rows="2" placeholder="En pocas palabras resuma su concepto del entrevistado" onblur="updateTable(0,this.value,<?php echo $r['id_sel']; ?>,'','obsPer','','');"><?php echo $r['obs_th'] ?></textarea>
                                </td>
                            <?php }
                            if ($_SESSION['are'] == 9 || $_SESSION['lid'] == 1 || $_SESSION['lid'] == 2) { ?>
                                <td>
                                    <?php if ($_SESSION['are'] != 9 && ($_SESSION['lid'] == 1 || $_SESSION['lid'] == 2)) { ?>
                                        <textarea type="text" name="obsLid" class="form-control" rows="2" placeholder="En pocas palabras resuma su concepto del entrevistado" onblur="updateTable(0,this.value,<?php echo $r['id_sel']; ?>,'','obsPer','','');" <?php if ($_SESSION['are'] == 9) {
                                                                                                                                                                                                                                                                    echo 'readonly';
                                                                                                                                                                                                                                                                } ?>><?php echo $r['obs_lid'] ?></textarea>
                                    <?php } else if($r['obs_lid'] != ''){
                                        echo $r['obs_lid'];
                                    } else {
                                        echo '--';
                                    } ?>
                                </td>
                            <?php }
                            if ($_SESSION['are'] == 9 || $_SESSION['lid'] == 1 || $_SESSION['lid'] == 4) { ?>
                                <td>
                                    <?php if ($_SESSION['lid'] == 1 || $_SESSION['lid'] == 4) { ?>
                                        <textarea type="text" name="obsGer" class="form-control" rows="2" placeholder="En pocas palabras resuma su concepto del entrevistado" onblur="updateTable(0,this.value,<?php echo $r['id_sel']; ?>,'','obsPer','','','','');" <?php if ($_SESSION['are'] == 9) {
                                                                                                                                                                                                                                                                            echo 'readonly';
                                                                                                                                                                                                                                                                        } ?>><?php echo $r['obs_ger'] ?></textarea>
                                    <?php } else if($r['obs_ger'] != ''){
                                        echo $r['obs_ger'];
                                    } else {
                                        echo '--';
                                    }?>
                                </td>
                            <?php }
                            if ($_SESSION['are'] == 9 || $_SESSION['lid'] == 1) { ?>
                                <td>
                                    <div class="dropdown text-center" >
                                        <button type="button" class="btn btn-secondary btn-circle <?php if ($r['id_estaSol'] == 0) {
                                                                                                            echo 'dropdown-btn';
                                                                                                        }
                                                                                                        if ($r["id_estaSol"] != 0) {
                                                                                                            echo 'btn';
                                                                                                            colorDropdown($r["id_estaSol"], $conexion);
                                                                                                        } ?> btn-sm dropdown" id="btn-<?php echo $r['id_sel']; ?>" data-bs-toggle="dropdown" <?php echo (isset($_POST['id_usu2'])) ? ' disabled' : ''; ?>  style="border-radius: 30px 30px 30px 30px;">
                                            <i class="fa-regular fa-circle "></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">
                                            <?php foreach ($opc as $rEst) { ?>
                                                <a class="btn btn<?php echo $rEst['color'];?> dropdown-item text-white" onclick="updateTable(1,<?php echo $rEst['id_estaSol']; ?>,<?php echo $r['id_sel']; ?>,'btn-<?php echo $r['id_sel']; ?>','updateEst','class','btn<?php echo $rEst['color']; ?>','personal','tabla2.php' );
                                                <?php if ($rEst['id_estaSol'] == 3) { 
                                                        echo 'editarForm(7,\'Crear Usuario\',\'../personal/form4.php\',' . $r['id_sel'] . ',' . $r['id_solC'] . ',\'form-NewPer\',\'personal\',\'tabla2.php\');" data-bs-toggle="modal" data-bs-target="#largeModal'; } ?>" class="btn bg<?php echo $rEst['color'];?> dropdown-item text-white"><?php echo $rEst['nom_estS']; ?>
                                                <?php } ?>
                                                </a>
                                        
                                        </div>
                                </td>
                            <?php }
                            if ($_SESSION['are'] == 9 || $_SESSION['lid'] == 4) { ?>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-secondary btn-sm " id="optionsDropdown" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-start" aria-labelledby="optionsDropdown">
                                            <a onclick="editarForm(6,'Actualizar Entrevista','../personal/form3.php',<?php echo $r['id_sel'] ?>,<?php echo $r['id_solC'] ?>,'form-Select','personal','tabla2.php');"  class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal">
                                                <i class="fa-solid fa-pen-to-square me-2"></i>Editar
                                            </a>
                                            <a  onclick="informacion(30,'Proceso','../personal/procesos.php',<?php echo $r['id_sel'] ?>);"  class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal">
                                                <i class="fa-solid fa-check-square me-2"></i>Procesos
                                            </a>
                                            <?php /*
                            <li><a href="#" onclick="eliminar()" data-bs-toggle="modal" data-bs-target="#modal-medium"><i class="fa-solid fa-eraser"></i>Eliminar</a></li>
                        */ ?>
                                        </div>
                                    </div>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#tablePersonal2').DataTable({
                    "ordering": true,
                    responsive: true,
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