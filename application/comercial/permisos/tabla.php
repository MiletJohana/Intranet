<?php
if (isset($_POST['resp']) && $_POST['resp'] == 'cerrar') {
    include '../../conexion.php';
    include '../../resources/template/credentials.php';
}
// consulta
$sql1 = "SELECT * FROM per_ingreso ing , mq_are are, mq_usu us, per_estado es, per_motivo mot
WHERE ing.id_are = are.id_are
AND   ing.id_usu = us.id_usu
AND   ing.id_estPer=es.id_estPer
AND   ing.mot_per=mot.mot_per
AND   ing.id_usu=" . $_SESSION['id'];
$sql1 .= " ORDER BY `id_per`ASC";
$query1 = $conexion->query($sql1);
//echo $sql1;
?>
<div class="col-sm-12 mb-4">
    <div class="p-3 py-3">
        <h5>Mis Permisos</h5>
    </div>
    <button type="button" onclick="newPermiso(3,'Crear Permiso','../permisos/form1.php');" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#largeModal">
        Crear permiso
    </button>

    <?php if (($_SESSION['lid'] == 1 || $_SESSION['lid'] == 4) || ($_SESSION['are'] == 9 && $_SESSION['lid'] == 3)) { ?>
        <button type="button" onclick="newPermiso(1,'Crear Permiso RH','../permisos/form2.php');" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModal">
            Registrar permiso
        </button>
    <?php } ?>
</div>
<div class="col-sm-12">
    <?php if ($query1 ->rowCount() > 0) { ?>
        <div class="table-responsive-lg">
            <table class="table table-bordered table-sm font-table <?php if ($session_theme == 1) {
                                                                        echo "table-dark text-dark";
                                                                    } ?>" id="tablePermisos">
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
                        <th>Estado</th>
                        <th>Soporte</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $query1->fetch(PDO::FETCH_ASSOC)) { ?>
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
                            <td><?php echo $r['nom_are']; ?></td>
                            <td><?php echo $r['fech_ini']; ?></td>
                            <td><?php echo $r['fech_fin']; ?></td>
                            <td><?php echo $r['descrip_per']; ?></td>
                            <td><?php echo $r['nom_estPer']; ?></td>
                            <td><?php if ($r['doc_perm'] != '') { ?>
                                    <div>
                                        <a class="btn btn-secondary dropdown-btn btn-sm" style="height:32px;" href="../../documentos/permisos/<?php echo $r['doc_perm']; ?>" target="blank">
                                            <i class="fa fa-file-pdf-o icon"></i>
                                        </a>
                                    </div>
                                <?php } elseif (($r['mot_per'] == 1 || $r['mot_per'] == 2 || $r['mot_per'] == 3) && ($r['doc_perm'] == '')) { ?>
                                    <i class="fa fa-warning icon"></i>
                                <?php } else {
                                    echo '--';
                                }
                                ?>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-secondary btn-sm" id="optionsDropdown" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="optionsDropdown">
                                        <a onclick="editarPer(4,'Actualizar Permiso','../permisos/form1.php',<?php $r['id_per']; ?>,'form-perm','permisos','tabla.php');" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                        <a onclick="mostrarSeg(0,'Seguimiento', '../permisos/seguimiento.php',<?php $r['id_per']; ?>);" class="btn btn-link dropdown-item" data-bs-toggle="modal" data-bs-target="#mediumModal"><i class="fa-solid fa-share"></i> Seguimiento</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        </div>
</div>
<?php } else { ?>
    <div class="alert alert-success alert-dismissible fade show mt-4 d-flex align-items-center" role="alert">
            <i class="fa-solid fa-circle-check me-2 fa-xl"></i>
            No hay resultados
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    
<?php } ?>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tablePermisos').DataTable({
            "ordering": true,
            "aaSorting": [],
            "order": [
                [0, "desc"]
            ]
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>