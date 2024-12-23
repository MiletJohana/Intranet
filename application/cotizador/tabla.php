<?php
if (isset($_POST['resp']) && $_POST['resp'] == 'cerrar') {
    include "../../conexion.php";
    include '../../resources/template/credentials.php';
} else if (isset($_POST['id_usu'])) {
    include '../../conexion.php';
    include '../../resources/template/credentials.php';
} else if (isset($_GET['cot'])) {
    include '../resources/template/credentials.php';
}
$mes = date('Y-m');
$sql12 = "SELECT * FROM cot_estados_cot";
$sql13 = "SELECT * FROM cot_solicitud";
$sql1 = "SELECT *, DAY(cot.fec_coti) AS fecha_dl
FROM cot_cotizaciones AS cot
INNER JOIN mq_usu AS us
ON cot.id_usu = us.id_usu
INNER JOIN mq_clientes AS cli
ON cot.id_cli = cli.id_cli
INNER JOIN cot_tip_cotizacion AS tip
ON cot.id_tip_cot = tip.id_tip_cot
INNER JOIN contactos AS cont
ON cot.id_cont = cont.id_cont
WHERE cot.id_coti IS NOT NULL";
if (isset($_POST["id_usu"])) {
    if ($_POST["id_usu"] == "100" || $_POST["id_usu"] == "200" || $_POST["id_usu"] == "300") {
        $sql1 .= " AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
        if ($_POST["id_usu"] == "100") {
            $sql1 .= " AND us.grup_car IN(18) AND us.id_reg = 1 AND us.id_are = 7";
        } else if ($_POST["id_usu"] == "200") {
            $sql1 .= " AND us.grup_car IN(19)";
        } else {
            $sql1 .= " AND us.grup_car IN(20)";
        }
    } else if (isset($_POST["id_usu2"])) {
        $sql1 .= " AND (cot.ced_ase='" . $_POST['id_usu2'] . "' OR cot.ced_sac='" . $_POST['id_usu2'] . "')
		 		 AND cot.id_usu!='" . $_POST['id_usu2'] . "'";
    } else {
        $sql1 .= " AND cot.id_usu='" . $_POST['id_usu'] . "'";
        if (isset($_POST['tot']) && $_POST['tot'] != '') {
            $sql1 .= " AND cot.fec_coti > '" . $_POST['tot'] . "%' AND cot.fec_coti < '" . $_POST['mes'] . "'";
        } else {
            $sql1 .= " AND cot.fec_coti LIKE '" . $_POST['mes'] . "%'";
        }
    }
} else {
    $sql1 .= " AND cot.id_usu='" . $_SESSION['id'] . "' 
			AND cot.fec_coti LIKE '$mes%'";
}
if (isset($_POST["est_cot"]) && $_POST["est_cot"] != "") {
    $sql1 .= " AND cot.est_cot='" . $_POST['est_cot'] . "' ";
}

$query = $conexion->query($sql1);
$query12 = $conexion->query($sql12);
$query13 = $conexion->query($sql13);
$opc = array();
$sol = array();

function colorDropdown($estado, $conexion)
{
    $sqlColor = "SELECT * from cot_estados_cot where id_est=$estado";
    $queryColors = $conexion->query($sqlColor);
    $rC = $queryColors->fetch(PDO::FETCH_ASSOC);
    echo $rC["color"];
}

function solDropdown($solicita, $conexion)
{
    $sqlSoli = "SELECT * from cot_solicitud where id_soli=$solicita";
    $querySoli = $conexion->query($sqlSoli);
    $rS = $querySoli->fetch(PDO::FETCH_ASSOC);
    echo $rS["med_soli"];
}

while ($val = $query12->fetch(PDO::FETCH_ASSOC)) {
    array_push($opc, $val);
}

while ($val2 = $query13->fetch(PDO::FETCH_ASSOC)) {
    array_push($sol, $val2);
}
/*if ($_SESSION['id']== 1032472569){
 echo $sql1;
}*/
?>
<div class="col-12">
    <?php if ($query->rowCount() > 0) { ?>
        <div class="table-responsive">
            <table  class="table table-bordered" id="tableCotizaciones" style="font-size: 0.6em;">
                <thead class="table-dark">
                    <tr style="font-size: 1em;">
                        <th style="font-size: 1.2em;">Acción</th>
                        <th style="font-size: 1.2em;">Cons.</th>
                        <th style="font-size: 1.2em;">Tipo de cotización</th>
                        <th style="font-size: 1.2em;">Creación</th>
                        <th style="font-size: 1.2em;">Fecha de Creación</th>
                        <th style="font-size: 1.2em;">Cliente / contacto</th>
                        <th style="font-size: 1.2em;">Estado</th>
                        <th style="font-size: 1.2em;">Solicita</th>
                        <th style="font-size: 1.2em;">Productos cotizados</th>
                        <th style="font-size: 1.2em;">Confirmado Por:</th>
                        <th style="font-size: 1.2em;">Día de envío Cot.</th>
                        <th style="font-size: 1.2em;">Comentario</th>
                        <th style="font-size: 1.2em;">Razón</th>
                        <th style="font-size: 1.2em;">Llamadas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-start" aria-labelledby="optionsDropdown">
                                        <?php if (!isset($_POST['id_usu2'])) { ?>
                                            <a onclick="editar(<?php if ($r['id_tip_cot'] == 6 || $r['id_tip_cot'] == 5 || $r['id_tip_cot'] == 9 || $r['id_tip_cot'] == 3 || $r['id_tip_cot'] == 3) {
                                                                    echo '16';
                                                                } else {
                                                                    echo '6';
                                                                } ?>,<?php echo $r['id_coti']; ?>,<?php echo $_SESSION['id']; ?>);" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-pen-to-square me-1"></i> Editar</a>
                                        <?php } ?>
                                        <a class="btn btn-link dropdown-item" href="<?php if ($r['id_tip_cot'] == 5  || $r['id_tip_cot'] == 6 || $r['id_tip_cot'] == 9) {
                                                                                        echo "../../documentos/cotizador/docs/" . $r["doc_coti"];
                                                                                    } else {
                                                                                        echo "../cotizador/cotizaciones.controller.php?id_coti=" . $r['id_coti'] . "&tip_cot=" . $r['id_tip_cot'] . "&id_cli=" . $r['id_cli'] . "&id=" . $r['id_usu'] . "&id_cont=" . $r['id_cont'];
                                                                                    } ?>" target="_blank"><i class="fa-solid fa-eye me-1"></i> Ver</a>
                                        <a class="btn btn-link dropdown-item" href="#" onclick="email(<?php echo $r['id_coti']; ?>,<?php echo $_SESSION['id']; ?>,<?php echo $r['id_cli']; ?>,<?php echo $r['id_cont']; ?>,<?php echo $r['id_tip_cot'] ?>);">
                                            <i class="fa-solid fa-envelope me-1"></i> Email
                                        </a>
                                        <a class="btn btn-link dropdown-item" href="#" onclick="contactosEma(<?php echo $r['id_coti']; ?>,<?php echo $_SESSION['id']; ?>,<?php echo $r['id_cont']; ?>,<?php echo $r['id_tip_cot'] ?>);" data-bs-toggle="modal" data-bs-target="#mediumModal">
                                            <div class="d-inline">
                                                <i class="fa-solid fa-paper-plane me-1"></i> Email a Otros
                                            </div>
                                        </a>
                                        <?php
                                        $sql3 = "SELECT * FROM `cot_pro_x_cot`,`cot_cotizaciones` cot,`cot_productos` pro 
												WHERE cot_pro_x_cot.id_coti=cot.id_coti
												AND cot_pro_x_cot.cod_pro=pro.cod_pro
												AND cot.id_coti=" . $r["id_coti"];
                                        $query3 = $conexion->query($sql3);
                                        if ($query3->rowCount() > 0) {
                                        ?>
                                            <a onclick="editar(11,<?php echo $r['id_coti']; ?>,<?php echo $_SESSION['id']; ?>);" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-clone me-1"></i>Duplicar</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="<?php if ($r['id_tip_cot'] == 5 || $r['id_tip_cot'] == 2 || $r['id_tip_cot'] == 6 || $r['id_tip_cot'] == 9) {
                                                echo "../../documentos/cotizador/docs/" . $r["doc_coti"];
                                            } else {
                                                echo "../cotizador/cotizaciones.controller.php?id_coti=" . $r['id_coti'] . "&tip_cot=" . $r['id_tip_cot'] . "&id_cli=" . $r['id_cli'] . "&id=" . $r['id_usu'] . "&id_cont=" . $r['id_cont'];
                                            } ?>" target="_blank">
                                    <?php echo $r["nom_cns"] . '-' . str_pad($r["cns_coti"], 4, "0", STR_PAD_LEFT); ?>
                                </a>
                            </td>
                            <td><?php echo $r["nom_tip_cot"]; ?></td>
                            <td><?php echo $r["fecha_dl"]; ?></td>
                            <td><?php echo $r["fec_coti"]; ?></td>
                            <td>
                                <!--<a href="../clientes2/index.php?id=<?php echo $r["id_cli"]; ?>" target="_blank">-->
                                <?php echo $r["nom_cli"]; ?>
                                <!--</a>-->
                                <br>
                                <?php echo $r["nom_cont"]; ?>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-secondary <?php if ($r['est_cot'] == 0) {
                                                                                                    echo 'dropdown-btn';
                                                                                                }
                                                                                                if ($r["est_cot"] != 0) {
                                                                                                    echo 'btn';
                                                                                                    colorDropdown($r["est_cot"], $conexion);
                                                                                                } ?> btn-sm" id="btn-<?php echo $r['id_coti']; ?>" data-bs-toggle="dropdown" <?php echo (isset($_POST['id_usu2'])) ? ' disabled' : ''; ?> style="border-radius: 30px 30px 30px 30px;">
                                        <i class="fa-regular fa-circle"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">
                                        <?php foreach ($opc as $r12) { ?>
                                            <li>
                                                <a onclick="updEst(<?php echo $r12['id_est']; ?>,<?php echo $r['id_coti']; ?>,'<?php echo $r['nom_cont']; ?>','btn-<?php echo $r['id_coti']; ?>'); <?php if ($r12['id_est'] == 2) {
                                                                                                                                                                                                        echo 'editarForm(17,\'Crear Pedido Myprocess\',\'../cotizador/form7.php\',' . $r['id_coti'] . ',\'form-pedidoM\',\'solicitud\',\'tablePer.php\');" data-bs-toggle="modal" data-bs-target="#mediumModal';
                                                                                                                                                                                                    } ?>" class="btn bg<?php echo $r12['color']; ?> dropdown-item"><?php echo $r12['nom_est']; ?>

                                                </a>
                                            <li>
                                            <?php } ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown text-center">
                                    <button class=" btn btn-secondary  dropdown-btn dropdown-toggle" type="button" id="btn2-<?php echo $r['id_coti']; ?>" <?php if ($r["sol_cot"] != 0) {
                                                                                                                                                                echo '';
                                                                                                                                                            } ?> data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" <?php if (isset($_POST['id_usu2'])) {
                                                                                                                                                                                                                                        echo 'disabled';
                                                                                                                                                                                                                                    } ?>><?php if ($r["sol_cot"] != 0) {
                                                                                                                                                                                                                                                solDropdown($r["sol_cot"], $conexion);
                                                                                                                                                                                                                                            } ?>
                                        <?php if ($r["sol_cot"] == 0) { ?>
                                            <span class="caret"></span>
                                        <?php } ?>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu2">
                                        <?php foreach ($sol as $r13) { ?>
                                            <a class="btn btn-link dropdown-item" href="#btn-<?php echo $r['id_coti']; ?>" onclick="updSol(<?php echo $r13['id_soli']; ?>,<?php echo $r['id_coti']; ?>,'btn2-<?php echo $r['id_coti']; ?>');"><?php echo $r13['med_soli']; ?></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php $sql14 = "SELECT * FROM cot_categoria";
                                $query14 = $conexion->query($sql14);
                                $coti = $r['id_coti'];
                                $sql15 = "SELECT id_cat FROM cot_cat_dlg WHERE id_coti=$coti";
                                $query15 = $conexion->query($sql15);
                                $cat = array();
                                while ($r15 = $query15->fetch(PDO::FETCH_ASSOC)) {
                                    array_push($cat, $r15["id_cat"]);
                                }
                                ?>
                                <div class="dropdown">
                                    <button class=" btn btn-secondary dropdown-btn dropdown-toggle" id="" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" <?php echo (isset($_POST['id_usu2'])) ? ' style="background-color: red;"' : ''; ?>>
                                        <span class="caret"></span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu2" style="background-color: #363a41;">
                                        <?php while ($r1 = $query14->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <li style="margin-left: 15px;color:white;">
                                                <input type="checkbox" onchange="updPrc(<?php echo $r['id_coti']; ?>);" name="id_cat[]<?php echo $r['id_coti']; ?>" value="<?php echo $r1["id_cat"]; ?>" <?php if (in_array($r1["id_cat"], $cat)) {
                                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                                            } ?> <?php echo (isset($_POST['id_usu2'])) ? ' disabled' : ''; ?>>
                                                <?php echo $r1["nom_cat"]; ?>
                                            </li>
                                        <?php } ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <textarea type="text" name="" class="form-control" style="font-size: 1.2em;" rows="1" onblur="updper(this.value,<?php echo $r['id_coti']; ?>);" <?php echo (isset($_POST['id_usu2'])) ? ' disabled' : ''; ?>><?php echo $r['conf_cotiz']; ?></textarea>
                            </td>

                            <td>
                                <input type="date" name="dia_cot" class="form-control" style="font-size: 1.2em;" onblur="updEnv(this.value,<?php echo $r['id_coti']; ?>);" value="<?php echo $r['env_cot']; ?>" <?php echo (isset($_POST['id_usu2'])) ? ' disabled' : ''; ?>>
                            </td>
                            <td>
                                <textarea type="text" name="" class="form-control" style="font-size: 1.2em;" rows="1" onblur="updCom(this.value,<?php echo $r['id_coti']; ?>);" <?php echo (isset($_POST['id_usu2'])) ? ' disabled' : ''; ?>><?php echo $r['com_cot']; ?></textarea>
                            </td>
                            <td>
                                <textarea type="text" name="" class="form-control" style="font-size: 1.2em;" rows="1" id="btn-<?php echo $r['id_coti']; ?>r" onblur="updMot(this.value,<?php echo $r['id_coti']; ?>);" <?php if ($r["est_cot"] != 3) : ?> disabled <?php endif ?> <?php echo (isset($_POST['id_usu2'])) ? ' disabled' : ''; ?>><?php echo $r['mot_cot']; ?></textarea>
                            </td>
                            <td>
                                <input type="number" name="llam_cot" class="form-control" style="font-size: 1.2em;" onblur="updLlam(this.value,<?php echo $r['id_coti']; ?>);" value="<?php if ($r["llam_cot"] != "") {
                                                                                                                                                                                            echo $r['llam_cot'];
                                                                                                                                                                                        } ?>" <?php echo (isset($_POST['id_usu2'])) ? ' disabled' : ''; ?>>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <script >
          $(document).ready(function() {
                $('#tableCotizaciones').DataTable({
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