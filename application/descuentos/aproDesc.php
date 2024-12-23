<?php
include "../../conexion.php";
include '../../resources/template/credentials.php';
include "functions.php";

$sqlSelSeg = "SELECT * FROM ind_desc_x_seg WHERE id_desc = " . $_POST['id'] . " ORDER BY fec_mod DESC";
$querySelSeg = $conexion->query($sqlSelSeg);

$sqlDesc = "SELECT * FROM ind_desc WHERE id_desc = " . $_POST['id'];
$queryDesc = $conexion->query($sqlDesc);

?>
<style>
    th {
        text-align: center;
    }
</style>
<h3 class="text-center">Descuento N°<?php echo $_POST['id'] ?></h3>
<hr class="mx-auto" style="width:60%;">
<div class="col-12">
    <div class="table-responsive">
        <table class="table text-center bg-light">
            <?php if ($queryDesc->rowCount() > 0) { ?>
                <br>
                <thead>
                    <tr>
                        <th colspan="6" style="font-size: 1.3em;">
                            Descuento
                        </th>
                    </tr>
                    <tr id="th">
                        <th>#</th>
                        <th>Solicitante</th>
                        <th>Valor del descuento</th>
                        <th>Cant. Cuotas</th>
                        <th>Registrado por:</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $queryDesc->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $r['id_desc']; ?></td>
                            <td><?php echo usus(( $r['id_usus']),$conexion); ?></td>
                            <td><?php echo '$ ' .  number_format($r['val_desc']); ?></td>
                            <td><?php echo $r['cuo_des']; ?></td>
                            <td><?php echo usus(($r['id_usu']), $conexion); ?></td>
                            <td><?php echo esta(($r['id_estado']), $conexion); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            <?php } else { ?>
                <div class="alert alert-success alert-dismissible fade show mt-4 d-flex align-items-center" role="alert">
                    <i class="fa-solid fa-circle-check me-3 fa-xl"></i>
                        No hay resultados
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
        </table>
    </div>
    <form role="form" id="form-aprdesc">
        <?php
        $sqlDesc1 = "SELECT * FROM ind_desc WHERE id_desc = " . $_POST['id'];
        $queryDesc1 = $conexion->query($sqlDesc1);
        $r1 = $queryDesc1->fetch(PDO::FETCH_ASSOC); ?>
        <div class="alert alert-info alert-dismissible fade show mt-4 d-flex align-items-center" role="alert">
            <i class="fa-solid fa-circle-info me-3 fa-xl"></i>
                <div>
                Recuerde que autoriza a MASTER QUIMICA S.A.S para que de conformidad con el Articulo 18 de la ley 1429 de 2010 ,
                deduzca de su salario la suma $<?php echo number_format($r1['val_desc']); ?>. Dejo constancia igualmentede que mi EMPLEADOR ha observado en el presente
                descuento lo previsto en la norma citada y que presente descuento no se encuentra incluido dentro de los DESCUENTOS
                PROHIBIDOS de que trata la ley en mención. En caso de mi retiro, AUTORIZO que el saldo adecuado sea descontando
                de mi Liquidación Final de prestaciones Sociales, salarios, vacaciones, auxilios legales y extralegales.
                </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div id="respAp"></div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 col-sm-12">
                <label for="pass" class="form-label">(Valide su contraseña)</label>
                <input type="password" class="form-control" id="pass" name="pass" value="" onkeyup="verificar(this.value, <?php echo $sesion_id; ?>)">
            </div>
            <div class="col-md-6 col-sm-12">
                <br>
                <button type="button" class="btn btn-success" id="apr" name="apr" onclick="cambiarEstado(<?php echo $_POST['id'] ?>, <?php if ($r1['id_tip_desc'] == 1) { echo 2; } else { echo 3; } ?>, 1)" disabled>Aprobar</button>
            </div>
        </div>
    </form>
</div>