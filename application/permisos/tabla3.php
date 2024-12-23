<?php

include "../../conexion.php";
include '../../resources/template/credentials.php';

$mes = date('Y-m');
$sqlest = "SELECT * FROM per_estado WHERE id_estPer in (2,3,4)";
$sql13 = "SELECT * FROM ind_mes";
$sqlHis = "SELECT ing.*,us.nom_usu,are.nom_are, es.nom_estPer, mot.descrip_per, mes.nom_mes,  us.id_lider   
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
while ($val = $queryest->fetch(PDO::FETCH_ASSOC)) {
    array_push($opc, $val);
}
?>
    <div class="col-12">
        <div class="row">
            <div class="py-3">
                <h3>Histórico</h3>
            </div>
        </div>
    
        <div class="table-responsive-sm">
            <table class="table table-bordered table-sm font-table" id="tablePermisos3">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Usuario Del Permiso</th>
                        <th>Fecha De Creación</th>
                        <th>Fecha De Ausencia</th>
                        <th>H.Inicio</th>
                        <th>H.Final</th>
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
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $queryHis->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $r['id_per']; ?></td>
                            <td><?php echo $r['nom_usu']; ?></td>
                            <td><?php echo $r['fech_sis']; ?></td>
                            <td><?php echo $r['fech_aus']; ?></td>
                            <td><?php echo $r['fech_ini']; ?></td>
                            <td><?php echo $r['fech_fin']; ?></td>
                            <td><?php echo $r['descrip_per']; ?></td>
                            <td><?php echo $r['obser_perm']; ?></td>
                            <td class="table-td-sm center-text">
                                <?php if ($r['doc_perm'] != '') { ?>
                                    <a class="btn btn-secondary btn-sm" href="../../documentos/permisos/<?php echo $r['doc_perm']; ?>" target="_blank">
                                        <i class="fa-solid fa-file-pdf"></i>
                                    </a>
                                <?php } else if (($r['mot_per'] == 1 || $r['mot_per'] == 2 || $r['mot_per'] == 3) && ($r['doc_perm'] == '')) { ?>
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                <?php } else {
                                    echo '--';
                                } ?>
                            </td>
                            <?php if ($_SESSION['are'] == 9) { ?>
                                <td>
                                    <div class="dropdown"><button type="button" class="btn btn-<?php if($r['id_estPer']==2){ echo "info";} else if ($r['id_estPer']==3){ echo "success";} else { echo "danger";} ?> btn-sm btn-circle dropdown" id="btn-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-regular fa-circle"></i></button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">
                                        <?php foreach ($opc as $r12) { ?>
                                                <a class="dropdown-item btn btn<?php echo $r12['color']; ?> text-white" onclick="updEst(<?php echo $r12['id_estPer']; ?>,<?php echo $r['id_per']; ?>,'btn-<?php echo $r['id_per']; ?>','permisos','../permisos/tabla3.php');">
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
                                    <button type="button" class="btn btn-secondary btn-sm bmd-btn-icon" id="optionsDropdown" data-bs-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-start" aria-labelledby="optionsDropdown">
                                        <a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#mediumModal" onclick="mostrarSeg(0,'Seguimiento', '../permisos/seguimiento.php',<?php echo $r['id_per']; ?>);"><i class="fa fa-share mr-1"></i> Seguimiento</a>
                                        <?php if ($r['crea_rec'] == 1) { ?>
                                            <a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="editarPer(4,'Actualizar Permiso','../permisos/form1.php',<?php echo $r['id_per']; ?>,'form-perm','permisos','tabla3.php');"><i class="fa fa-edit mr-1"></i> Editar</a>
                                        <?php } else if ($r['crea_rec'] == 0) { ?>
                                            <a class="btn btn-link dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#largeModal" onclick="editarPer(4,'Actualizar Permiso','../permisos/form1.php',<?php echo $r['id_per']; ?>,'form-perm','permisos','tabla3.php');"><i class="fa fa-edit mr-1"></i> Editar</a>
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
            $('#tablePermisos3').DataTable({
                "ordering": true,
                "order": [
                    [0, "desc"]
                ]
            });
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
