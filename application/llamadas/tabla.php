<?php
if (isset($_POST['resp']) && $_POST['resp'] == 'cerrar') {
    include '../../conexion.php';
    include '../../resources/template/credentials.php';
}
function usu($id, $conexion)
{
    $sqlUsu = "SELECT * FROM mq_usu WHERE id_usu = " . $id;
    $queryUsu = $conexion->query($sqlUsu);
    $rU = $queryUsu->fetch_array();
    return $rU['nom_usu'];
}

function correo($param)
{
    if ($param == 1) {
        return "Si";
    } else {
        return "No";
    }
}

// consulta
$sql1 = "SELECT llam.*, us.nom_usu FROM reg_llam AS llam 
INNER JOIN mq_usu AS us
ON llam.id_rem = us.id_usu
INNER JOIN mq_are AS are
ON us.id_are = are.id_are";
if (isset($_GET['table']) && $_GET['table'] == 1 || (isset($_POST['resp']) && $_POST['resp'] == 'cerrar')) {
    $sql1 .= " WHERE llam.id_usu =" . $_SESSION['id'];
} else if (isset($_GET['table']) && $_GET['table'] == 2) {
    $sql1 .= " WHERE llam.id_rem =" . $_SESSION['id'];
}
$query1 = $conexion->query($sql1);
//echo $sql1;
?>
<div class="col-12 mb-4">
    <div class="p-3">
        <h5>
            <?php
            if (isset($_GET['table']) && $_GET['table'] == 1) {
                echo "Mis llamadas";
            } else if (isset($_GET['table']) && $_GET['table'] == 2) {
                echo "Asociadas";
            } else {
                echo "Historial";
            }
            ?>
        </h5>
    </div>
    <?php if (isset($_GET['table']) && $_GET['table'] == 1 || (isset($_POST['resp']) && $_POST['resp'] == 'cerrar')) { ?>
        <button type="button" onclick="newLLam(1,'Crear Llamada','../llamadas/form.php');" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#largeModal">
            Registrar llamada
        </button>
    <?php } ?>
</div>
<div class="col-12">
    <?php if ($query1->rowCount() > 0) { ?>
        <div class="table-responsive-sm">
            <table class="table table-bordered table-sm font-table" id="tableLlamadas">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <?php if (isset($_GET['table']) && $_GET['table'] == 3) { ?>
                            <th>De:</th>
                            <th>A:</th>
                        <?php } else { ?>
                            <th>Contacto</th>
                        <?php } ?>
                        <th>Comentario</th>
                        <th>Fecha de Llamada</th>
                        <th>Correo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $query1->fetch_array()) { ?>
                        <tr>
                            <td><?php echo $r['id_llama']; ?></td>
                            <?php if (isset($_GET['table']) && $_GET['table'] == 3) { ?>
                                <td><?php echo utf8_encode(usu($r['id_usu'], $conexion)); ?></td>
                                <td><?php echo utf8_encode(usu($r['id_rem'], $conexion)); ?></td>
                            <?php } else { ?>
                                <td><?php echo $r['nom_usu']; ?></td>
                            <?php } ?>
                            <td><?php echo $r['ob_llam']; ?></td>
                            <td><?php echo $r['fec_llam']; ?></td>
                            <td><?php echo correo($r['ema_llamada']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#tableLlamadas').DataTable({
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
            <i class="fa-solid fa-circle-check me-3 fa-xl"></i>
                    No hay resultados
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
</div>