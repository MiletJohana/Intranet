<?php
if (isset($_POST['resp']) && $_POST['resp'] == 'cerrar') {
    include "../../../conexion.php";
    include '../../../resources/template/credentials.php';
} else {
    include "../../conexion.php";
    include '../../resources/template/credentials.php';
}
$mes = date('Y-m');
$sqlest = "SELECT * FROM per_estado WHERE id_estPer in (2,3,4)";
$sql13 = "SELECT * FROM ind_mes";
$sqlHis = "SELECT ing.*,us.nom_usu,are.nom_are,mot.descrip_per, mes.nom_mes,  us.id_lider   
           FROM per_ingreso ing , mq_are are, mq_usu us, per_estado es, per_ingre_x_mov mov ,per_motivo mot , ind_mes mes
           WHERE ing.id_are = are.id_are 
           AND ing.id_usu = us.id_usu 
           AND ing.id_estPer=es.id_estPer 
           AND ing.id_mes=mes.id_mes 
           AND ing.id_per=mov.id_per 
           AND ing.mot_per=mot.mot_per";
if ($_SESSION['are'] != 9) {
    $sqlHis .= " AND mov.id_usu=" . $_SESSION['id'];;
}
if (isset($_POST['para'])) {
    $para = $_POST['para'];
    $sqlHis .= " AND ing.id_estPer IN ($para[0]) AND ing.fech_aus LIKE '$para[1]%'";
} else {
    $sqlHis .= " AND ing.fech_aus LIKE '$mes%'";
}
$sqlHis .= " GROUP BY ing.id_per";
$queryHis = $conexion->query($sqlHis);
//echo $sqlHis;
$queryest = $conexion->query($sqlest);
$query13 = $conexion->query($sql13);

$opc = array();
$sol = array();
function colorDropdown($estado, $conexion)
{
    $sqlColor = "SELECT * FROM per_estado WHERE id_estPer=$estado";
    $queryColors = $conexion->query($sqlColor);
    $rC = $queryColors->fetch(PDO::FETCH_ASSOC);
    echo $rC["color"];
}
while ($val = $queryest->fetch(PDO::FETCH_ASSOC)) {
    array_push($opc, $val);
}
function solDropdown($id_mes, $conexion)
{

    $sqlMes = "SELECT * FROM ind_mes WHERE id_mes=$id_mes";
    $queryMes = $conexion->query($sqlMes);
    //echo $sqlMes;
    $rS = $queryMes->fetch(PDO::FETCH_ASSOC);
    echo $rS["nom_mes"];
}
while ($val2 = $query13->fetch(PDO::FETCH_ASSOC)) {
    array_push($sol, $val2);
}

if ($queryHis->rowCount() > 0) { ?>
    <div class="col-md-12">
        <div class="row">
            <div class="py-3">
                <h3>Histórico</h3>
            </div>
        </div>
        <div class="table-responsive-lg">
            <table id="tablePer3" class="table table-bordered table-sm font-table ">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Usuario Del Permiso</th>
                        <th>Fecha De Creación</th>
                        <th>Fecha De Ausencia</th>
                        <th>H.Inicio</th>
                        <th>H.Final</th>
                        <?php if ($_SESSION['are'] == 9) { ?>
                            <th>M.Indicador</th>
                        <?php } ?>
                        <th>Motivo</th>
                        <th>Observaciones</th>
                        <th>Soporte</th>
                        <?php if ($_SESSION['are'] == 9) { ?>
                            <th>Estado</th>
                        <?php } ?>
                        <th>Revisado TH</th>
                        <?php if ($_SESSION['are'] == 9) { ?>
                            <th>Observacion T.H.</th>
                        <?php } ?>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $queryHis->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr class="<?php if ($r['id_estPer'] == 2) {
                                        echo "table-warning";
                                    } else if ($r['id_estPer'] == 3) {
                                        echo "table-info";
                                    } else if ($r['id_estPer'] == 4) {
                                        echo "table-danger";
                                    } ?>">
                            <td><?php echo $r['id_per']; ?></td>
                            <td><?php echo $r['nom_usu']; ?></td>
                            <td><?php echo $r['fech_sis']; ?></td>
                            <td><?php echo $r['fech_aus']; ?></td>
                            <td><?php echo $r['fech_ini']; ?></td>
                            <td><?php echo $r['fech_fin']; ?></td>
                            <?php if ($_SESSION['are'] == 9) { ?>
                                <td>
                                    <div class="dropdown dropend">
                                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="monthsDropdown" data-bs-toggle="dropdown" id="btn2-<?php echo $r['id_per']; ?>" aria-haspopup="true" aria-expanded="false">
                                            <?php solDropdown($r["id_mes"], $conexion); ?>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="monthsDropdown">
                                            <?php foreach ($sol as $r13) { ?>
                                                <a class="btn btn-link dropdown-item" href="#btn-<?php echo $r['id_per']; ?>" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="updSol(<?php echo $r13['id_mes']; ?>,<?php echo $r['id_per']; ?>,'btn2-<?php echo $r['id_per']; ?>');"><?php echo $r13['nom_mes']; ?></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </td>
                            <?php } ?>
                            <td><?php echo $r['descrip_per']; ?></td>
                            <td><?php echo $r['obser_perm']; ?></td>
                            <td class="table-td-sm center-text">
                                <?php if ($r['doc_perm'] != '') { ?>
                                    <a class="btn btn-secondary btn-sm" href="../../documentos/permisos/<?php echo $r['doc_perm']; ?>" target="_blank">
                                        <i class="fa fa-file-pdf-o icon"></i>
                                    </a>
                                <?php } else if (($r['mot_per'] == 1 || $r['mot_per'] == 2 || $r['mot_per'] == 3) && ($r['doc_perm'] == '')) { ?>
                                    <i class="fa fa-warning icon"></i>
                                <?php } else {
                                    echo '--';
                                } ?>
                            </td>
                            <?php if ($_SESSION['are'] == 9) { ?>
                                <td>
                                    <div class="dropdown dropend">
                                        <button type="button" class="btn btn-secondary btn-sm rounded-circle <?php if ($r['id_estPer'] == 6) {
                                                                                                                    echo 'dropdown-btn';
                                                                                                                }
                                                                                                                if ($r["id_estPer"] != 6) {
                                                                                                                    echo 'btn';
                                                                                                                    colorDropdown($r["id_estPer"], $conexion);
                                                                                                                } ?>" id="stateDropdown" data-bs-toggle="dropdown" id="btn2-<?php echo $r['id_per']; ?>" aria-haspopup="true" aria-expanded="false" id="btn-<?php echo $r['id_per']; ?>">
                                            <i class="fa-regular fa-circle "></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="stateDropdown">
                                            <?php foreach ($opc as $r12) { ?>
                                                <a class="dropdown-item bg<?php echo $r12['color']; ?>" href="" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="updEst(<?php echo $r12['id_estPer']; ?>,<?php echo $r['id_per']; ?>,'btn-<?php echo $r['id_per']; ?>','permisos','../permisos/tablaHistorico.php');">
                                                    <?php echo $r12['nom_estPer']; ?>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </td>
                            <?php } ?>
                            <td class="table-td-sm center-text"> <?php if ($r['revi_rec'] == 1) { ?>
                                    <i class="fa fa-thumbs-up" style="font-size:22px;">
                                    <?php } else {
                                                                        echo '--';
                                                                    } ?>
                            </td>
                            <?php if ($_SESSION['are'] == 9) { ?>
                                <td>
                                    <textarea class="form-control" rows="1" id="btn-<?php echo $r['id_per']; ?>" onblur="updObser(this.value,<?php echo $r['id_per']; ?>);" <?php if ($_SESSION['are'] != 9) : ?> disabled <?php endif ?>><?php echo $r['obs_talen']; ?></textarea>
                                </td>
                            <?php } ?>
                            <td class="table-td-sm">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-start" aria-labelledby="optionsDropdown">
                                        <a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="mostrarSeg(0,'Seguimiento', '../permisos/seguimiento.php',<?php $r['id_per']; ?>);"><i class="fa-solid fa-share mr-1"></i> Seguimiento</a>
                                        <?php if ($r['crea_rec'] == 1) { ?>
                                            <a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="editarPer(4,'Actualizar Permiso','../permisos/form1.php',<?php $r['id_per']; ?>,'form-perm','permisos','tabla3.php');"><i class="fa-solid fa-pen-to-square mr-1"></i> Editar</a>
                                        <?php } else if ($r['crea_rec'] == 0) { ?>
                                            <a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="editarPer(4,'Actualizar Permiso','../permisos/form1.php',<?php $r['id_per']; ?>,'form-permiso','permisos','tabla3.php');"><i class="fa-solid fa-pen-to-square mr-1"></i> Editar</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#tablePer3').DataTable({
                "ordering": true,
                "order": [
                    [0, "desc"]
                ]
            });
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
<?php } else { ?>
    <div class="col-md-12 mt-4">
        <div class="alert alert-success alert-dismissible fade show mt-4 d-flex align-items-center" role="alert">
            <i class="fa-solid fa-circle-check me-2 fa-xl"></i>
            No hay resultados
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php } ?>