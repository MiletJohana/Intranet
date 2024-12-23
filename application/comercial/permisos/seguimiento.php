<?php
include "../../conexion.php";
include '../../resources/template/credentials.php';
$fecha2 = date("Y-m-d H:i:s");
$sql11 = "SELECT mov.id_per, us.nom_usu,est.nom_estPer, mov.fech_sis, are.nom_are
FROM per_ingre_x_mov mov, mq_usu us, mq_are are, per_estado est, per_ingreso per
WHERE mov.id_per=per.id_per
AND mov.id_usu=us.id_usu
AND mov.id_estPer=est.id_estPer
AND mov.id_are=are.id_are
AND mov.id_per=" . $_POST['edit'];
$sql11 .= " ORDER BY mov.fech_sis ASC";
$query11 = $conexion->query($sql11);
//echo $sql11;
$sqlEn = "SELECT mov.id_per, us.nom_usu,est.nom_estPer, mov.fech_sis, are.nom_are, mot.descrip_per, per.otro_motiv, per.obser_perm  
FROM per_ingre_x_mov mov, mq_usu us, mq_are are, per_estado est, per_ingreso per, per_motivo mot
WHERE per.id_usu=us.id_usu
AND per.id_estPer=est.id_estPer
AND per.id_are=are.id_are
AND per.mot_per=mot.mot_per
AND per.id_per=" . $_POST['edit'];
$sqlEn .= " ORDER BY mov.fech_sis ASC";
$queryEn = $conexion->query($sqlEn);
//echo $sqlEn;
while ($r2 = $queryEn->fetch(PDO::FETCH_OBJ)) {
    $per = $r2;
    break;
}
if ($query11->rowCount() > 0) { ?>
    <div class="row">
        <div class="col-md-12">
            <h3>Permiso Nº <?php echo $_POST['edit']; ?></h3>
            <hr style="width: 32%;">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 table-responsive-sm">
            <table class="table bg-light">
                <thead>
                    <tr>
                        <th class="h5">Motivo:</th>
                        <th class="h5">Especificaciones:</th>
                        <th class="h5">Observaciones:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $per->descrip_per; ?></td>
                        <td><?php if ($per->otro_motiv != '') {
                                echo $per->otro_motiv;
                            } else {
                                echo '--';
                            } ?></td>
                        <td><?php if ($per->obser_perm != '') {
                                echo $per->obser_perm;
                            } else {
                                echo '--';
                            } ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div style="overflow-y: scroll; height:220px;">
                <table class="table" id="seguimiento">
                    <thead>
                        <tr>
                            <th>Usuario:</th>
                            <th>Fecha:</th>
                            <th>Estado:</th>
                            <th>Área:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($r = $query11->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td><?php echo $r['nom_usu']; ?></td>
                                <td><?php echo $r['fech_sis']; ?></td>
                                <td><?php echo $r['nom_estPer']; ?></td>
                                <td><?php echo $r['nom_are']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php } ?>