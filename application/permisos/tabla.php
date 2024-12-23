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
    <div class="px-2 mt-4">
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
<div class="col-12">
        <div class="table-responsive">
            <table class="table table-bordered tablePermisos1 table-sm" id="tablePermisos1">
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
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
            </table>
        </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        serverSidePermisos(1, 1, '' , '');
    });
</script>