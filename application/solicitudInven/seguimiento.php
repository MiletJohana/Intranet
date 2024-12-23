<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';

$fecha2 = date("Y-m-d H:i:s");
$sql1 = "SELECT mov.id_sol, us.nom_usu, est.nom_est_sol, mov.fec_mov, mov.obs_mov FROM inv_sol_x_mov mov
         INNER JOIN inv_est_sol est ON est.id_est_sol = mov.est_sol
         INNER JOIN mq_usu us ON us.id_usu = mov.id_usu
         WHERE mov.id_sol = " . $_POST['id_sol'];
$sql1 .= " ORDER BY mov.fec_mov ASC";
$query = $conexion->query($sql1);
?>
<?php if ($query->rowCount() > 0) { ?>
    <div class="row">
        <div class="col-12 mb-4" style="font-size: 25px;">
            <h3 class="text-center"> Solicitud Nº <?php echo $_POST['id_sol'] ?></h3>
            <hr style="width: 32%;" class="mx-auto" >
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div style="overflow-y: scroll; height:220px;">
                <div class="col-12">
                    <table class="table" id="tablaCorrespondencia" style="font-size:90%; height: 200px;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Usuario Que Modifica</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Observación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($r = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                                <tr>
                                    <td><?php echo $r['id_sol']; ?></td>
                                    <td><?php echo $r['nom_usu']; ?></td>
                                    <td><?php echo $r['fec_mov']; ?></td>
                                    <td><?php echo $r['nom_est_sol']; ?></td>
                                    <td><?php echo $r['obs_mov']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="id_sol" name="id_sol" value="<?php echo $_POST['id_sol']; ?>">

<?php } ?>