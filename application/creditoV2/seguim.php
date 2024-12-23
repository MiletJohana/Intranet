<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
$fecha2 = date("Y-m-d H:i:s");
$sql1 = "SELECT mov.id_sol, us.nom_usu, est.nom_est, mov.fech_crm FROM cre_x_mov mov,cre_solicitud sol, cre_estadosol est, mq_usu us
WHERE mov.id_sol=sol.id_sol
AND mov.id_usu=us.id_usu
AND mov.id_est=est.id_est
AND mov.id_sol= " . $_POST['id_sol'];
$sql1 .= " ORDER BY mov.fech_crm ASC";
$query = $conexion->query($sql1);
?>
<?php if ($query->rowCount() > 0) { ?>
    <div class="row">
        <div class="col-md-12" style="font-size: 25px;">
            <h3 class="text-center"> Solicitud Nº <?php echo $_POST['id_sol'] ?></h3>
            <hr style="width: 32%;">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div style="overflow-y: scroll; height:220px;">
                <div class="col-md-12">
                    <table class="table" id="tablaCorrespondencia" style="font-size:90%; height: 200px;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Usuario Que Modifica:</th>
                                <th>Fecha :</th>
                                <th>Estado :</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($r = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                                <tr>
                                    <td><?php echo $r['id_sol']; ?></td>
                                    <td><?php echo $r['nom_usu']; ?></td>
                                    <td><?php echo $r['fech_crm']; ?></td>
                                    <td><?php echo $r['nom_est']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="id_sol" name="id_sol" value="<?php if ($_POST['resp'] == 11) {
                                                                echo $_POST['id_sol'];
                                                            } ?>">

<?php } ?>