<?php
include '../../conexion.php';
$sql = "SELECT num_enr, fec_enr FROM mq_enrt WHERE est_enr = 'EN RUTA'";
$query = $conexion->query($sql);
if ($query->rowCount() > 0) {
    while ($r = $query->fetch(PDO::FETCH_ASSOC)) { ?>
        <button class="btn btn-info form-control" onclick="validarEnrutamiento(<?php echo  $r['num_enr']; ?>)">enrutamiento: <?php echo  $r['num_enr']; ?> fecha: <?php echo  $r['fec_enr']; ?></button>
<?php }
} ?>