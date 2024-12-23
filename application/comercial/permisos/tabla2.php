<?php
if (isset($_POST['resp']) && $_POST['resp'] == 'cerrar') {
    include '../../conexion.php';
    include '../../resources/template/credentials.php';
}
// consulta
$sqlEst = "SELECT * FROM per_estado WHERE id_estPer in (2,3,4)";
$sqlPen = "SELECT * FROM per_ingreso ing , mq_are are, mq_usu us, per_estado es, per_motivo mot
WHERE ing.id_are = are.id_are
AND ing.id_usu = us.id_usu
AND ing.id_estPer = es.id_estPer
AND ing.mot_per = mot.mot_per";
if (isset($_SESSION['lid']) && $_SESSION['lid'] == 2 || $_SESSION['lid'] == 1 || $_SESSION['lid'] == 4) {
    $sqlPen .= " AND es.id_estPer = 2 AND us.id_lider = " . $_SESSION['id'];
}
if (isset($_SESSION['are']) && $_SESSION['are'] == 9 && $_SESSION['lid'] == 3) {
    $sqlPen .= " AND es.id_estPer >= 3 AND ing.crea_rec != 1 AND ing.revi_rec != 1";
}
$sqlPen .= " ORDER  BY ing.id_per ASC";
$queryPen = $conexion->query($sqlPen);
$queryEst = $conexion->query($sqlEst);
$opc = array();
//echo $sqlPen;

function colorDropdown($estado, $conexion)
{
    $sqlColor = "SELECT * from per_estado where id_estPer = $estado";
    $queryColors = $conexion->query($sqlColor);
    $rC = $queryColors->fetch(PDO::FETCH_ASSOC);
    echo $rC["color"];
}
while ($val = $queryEst->fetch(PDO::FETCH_ASSOC)) {
    array_push($opc, $val);
}

$sqlAdmin = "SELECT * FROM per_ingreso ing , mq_are are, mq_usu us, per_estado es, per_motivo mot
           WHERE ing.id_are = are.id_are
           AND ing.id_usu = us.id_usu
           AND ing.id_estPer = es.id_estPer
           AND ing.mot_per = mot.mot_per
           AND es.id_estPer >= 3
           AND ing.crea_rec != 1
           AND ing.revi_rec != 1
           AND ing.id_are != 9";
$sqlAdmin .= " ORDER  BY ing.id_per ASC";
$queryAdmin = $conexion->query($sqlAdmin); ?>

<div class="col-md-12">
    <div class="p-3">
        <h5>Mis Pendientes</h5>
    </div>
    <?php if ($queryPen->rowCount() > 0) { ?>
        <div class="table-responsive-sm">
            <table class="table table-bordered table-sm font-table <?php if ($session_theme == 1) {
                                                                        echo "table-dark text-dark";
                                                                    } ?>" id="tablePermisos2-1">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Usuario Del Permiso</th>
                        <th>Fecha De Creación</th>
                        <th>Fecha De Ausencia</th>
                        <th>H.Inicio</th>
                        <th>H.Final</th>
                        <th>Motivo</th>
                        <th>Comentario Col</th>
                        <th>Soporte</th>
                        <?php if (isset($_SESSION['are']) && $_SESSION['are'] == 9 && $_SESSION['lid'] == 3) { ?>
                            <th> Revisado </th>
                        <?php } elseif (isset($_SESSION['lid']) && $_SESSION['lid'] == 2 || $_SESSION['lid'] == 1 || $_SESSION['lid'] == 4) { ?>
                            <th> Estado</th>
                        <?php } ?>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $queryPen->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr class="<?php if ($r['id_estPer'] == 2) {
                                        echo "table-warning";
                                    } else if ($r['id_estPer'] == 3) {
                                        echo "table-info";
                                    } else if ($r['id_estPer'] == 4) {
                                        echo "table-danger";
                                    } ?>">
                            <td><?php echo $r['id_per']; ?></td>
                            <td><?php echo $r['nom_usu']; ?></td>
                            <td class="table-td-sm center-text"><?php echo $r['fech_sis']; ?></td>
                            <td class="table-td-sm center-text"><?php echo $r['fech_aus']; ?></td>
                            <td class="table-td-sm center-text"><?php echo $r['fech_ini']; ?></td>
                            <td class="table-td-sm center-text"><?php echo $r['fech_fin']; ?></td>
                            <td><?php echo $r['descrip_per']; ?></td>
                            <td><?php if ($r['obser_perm'] != '') {
                                    echo $r['obser_perm'];
                                } else {
                                    echo '--';
                                } ?>
                            </td>
                            <td class="table-td-sm center-text">
                                <?php if ($r['doc_perm'] != '') { ?>
                                    <div>
                                        <a class="btn btn-secondary btn-sm" href="../../documentos/permisos/<?php echo $r['doc_perm']; ?>" target="_blank">
                                            <i class="fa fa-file-pdf-o icon"></i>
                                        </a>
                                    </div>
                                <?php } elseif (($r['mot_per'] == 1 || $r['mot_per'] == 2 || $r['mot_per'] == 3) && ($r['doc_perm'] == '')) { ?>
                                    <i class="glyphicon glyphicon-alert"></i>
                                <?php } else {
                                    echo '--';
                                } ?>
                            </td>
                            <?php if (isset($_SESSION['are']) && $_SESSION['are'] == 9 && $_SESSION['lid'] == 3) { ?>
                                <td class="table-td-sm center-text">
                                    <input class="custom-control-input" type="checkbox" value="0" name="estper<?php $r['id_per'] ?>" id="estPer<?php $r['id_per'] ?>" onclick="aceptado(<?php $r['id_per']; ?>,'permisos','../permisos/tabla2.php');">
                                    <label class="form-label" for="defaultChecked2"></label>
                                </td>
                            <?php } else if (isset($_SESSION['lid']) && $_SESSION['lid'] == 2 || $_SESSION['lid'] == 1 || $_SESSION['lid'] == 4) { ?>
                                <td class="table-td-sm center-text">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm rounded-circle <?php if ($r['id_estPer'] == 1) {
                                                                                                    echo 'dropdown-toggle';
                                                                                                }
                                                                                                if ($r["id_estPer"] != 1) {
                                                                                                    echo ' btn';
                                                                                                    colorDropdown($r["id_estPer"], $conexion);
                                                                                                } ?>" type="button" id="btn-<?php echo $r['id_per']; ?>" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa-regular fa-circle "></i>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-end " aria-labelledby="optionDropdown">
                                            <?php foreach ($opc as $r12) { ?>
                                                <a class="dropdown-item bg<?php echo $r12['color']; ?> " href="#btn-<?php echo $r['id_per']; ?>" onclick="updEst(<?php echo $r12['id_estPer']; ?>,<?php echo $r['id_per']; ?>,'btn-<?php echo $r['id_per']; ?>','permisos','../permisos/tabla2.php');">
                                                    <?php echo $r12['nom_estPer']; ?>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </td>
                            <?php } ?>
                            <td class="table-td-sm">
                                <div class="dropdown">

                                    <button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">
                                        <a class="btn btn-link dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="mostrarSeg(0,'Seguimiento', '../permisos/seguimiento.php',<?php $r['id_per']; ?>);"><i class="fa-solid fa-share"></i> Seguimiento</a>
                                        <?php if ($r['crea_rec'] == 1) { ?>
                                            <a class="btn btn-link dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="editarPer(4,'Actualizar Pagos','../permisos/form1.php',<?php $r['id_per']; ?>,'form-perm','permisos','tabla2.php');"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                        <?php } elseif ($r['crea_rec'] == 0) { ?>
                                            <a class="btn btn-link dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="editarPer(4,'Actualizar Pagos','../permisos/form1.php',<?php $r['id_per']; ?>,'form-permiso','permisos','tabla2.php');"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                        <?php } ?>
                                    </div>

                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <script>
            $(document).ready(function() {
                $('#tablePermisos2-1').DataTable({
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
        <div class="alert alert-success alert-dismissible fade show mt-2 d-flex align-items-center" role="alert">
            <i class="fa-solid fa-circle-check me-2 fa-xl"></i>
            No hay resultados
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php }
    if ($_SESSION['lid'] == 1) { ?>
        <div class="p-3">
            <h5>Pendientes Por Recibir</h5>
        </div>
        <?php if ($queryAdmin->rowCount() > 0) { ?>
            <div class="table-responsive-lg">
                <table class="table table-bordered table-sm font-table <?php if ($session_theme == 1) {
                                                                            echo "table-dark text-dark";
                                                                        } ?>" id="tablePermisos2-2">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Usuario Del Permiso</th>
                            <th>Fecha De Creación</th>
                            <th>Fecha De Ausencia</th>
                            <th>Área</th>
                            <th>H.Inicio</th>
                            <th>H.Final</th>
                            <th>Motivo</th>
                            <th>Soporte</th>
                            <th>Revisado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($r2 = $queryAdmin->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr class="<?php if ($r2['id_estPer'] == 2) {
                                            echo "table-primary";
                                        } else if ($r2['id_estPer'] == 3) {
                                            echo "table-success";
                                        } else if ($r2['id_estPer'] == 4) {
                                            echo "table-danger";
                                        } ?>">
                                <td><?php echo $r2['id_per']; ?></td>
                                <td><?php echo $r2['nom_usu']; ?></td>
                                <td class="table-td-sm center-text"><?php echo $r2['fech_sis']; ?></td>
                                <td class="table-td-sm center-text"><?php echo $r2['fech_aus']; ?></td>
                                <td><?php echo $r2['nom_are']; ?></td>
                                <td class="table-td-sm center-text"><?php echo $r2['fech_ini']; ?></td>
                                <td class="table-td-sm center-text"><?php echo $r2['fech_fin']; ?></td>
                                <td><?php echo $r2['descrip_per']; ?></td>
                                <td class="table-td-sm center-text">
                                    <?php if ($r2['doc_perm'] != '') { ?>
                                        <div>
                                            <a class="btn btn-secondary btn-sm" href="../../documentos/permisos/<?php echo $r2['doc_perm']; ?>" target="_blank">
                                                <i class="fa-solid fa-file-pdf fa-xl"></i>
                                            </a>
                                        </div>
                                    <?php } elseif (($r2['mot_per'] == 1 || $r2['mot_per'] == 2 || $r2['mot_per'] == 3) && ($r2['doc_perm'] == '')) { ?>
                                        <i class="fa fa-warning"></i>
                                    <?php } else {
                                        echo '--';
                                    } ?>
                                </td>
                                <td class="table-td-sm center-text">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="Revisado" onclick="aceptado(<?php $r2['id_per']; ?>,'permisos','../permisos/tabla2.php');" name="estper<?php $r2['id_per'] ?>" id="estPer<?php $r2['id_per'] ?>">
                                        </label>
                                    </div>
                                </td>
                                <td class="table-td-sm">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">
                                            <a class="btn btn-link dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="mostrarSeg(0,'Seguimiento', '../permisos/seguimiento.php',<?php $r2['id_per']; ?>);"><i class="fa-solid fa-share"></i> Seguimiento</a>
                                            <?php if ($r2['crea_rec'] == 1) { ?>
                                                <a class="btn btn-link dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="editarPer(4,'Editar Permiso','../permisos/form1.php',<?php $r2['id_per']; ?>,'form-perm','permisos','tabla2.php');"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                            <?php } elseif ($r2['crea_rec'] == 0) { ?>
                                                <a class="btn btn-link dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="editarPer(4,'Editar Permiso','../permisos/form1.php',<?php $r2['id_per']; ?>,'form-permiso','permisos','tabla2.php');"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
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
                    $('#tablePermisos2-2').DataTable({
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
                <i class="fa-solid fa-circle-check me-2 fa-xl"></i>
                No hay resultados
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    <?php }
    } ?>
</div>