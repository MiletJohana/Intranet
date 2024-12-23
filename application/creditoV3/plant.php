<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';

$sqlEma = "SELECT est.id_est, cli.nom_cli, sol.id_sol, cli.id_cli, us.nom_usu, sol.fec_sol, est.nom_est, cli.ase_com, us.eml_usu 
FROM mq_usu us, cre_estadosol est, mq_clie cli,cre_solicitud sol
WHERE cli.ase_com= us.id_usu 
AND sol.id_est=est.id_est
AND cli.id_cli=sol.id_cli
AND sol.id_sol=107";
$queryEma = $conexion->query($sqlEma);
$queryEma1 = $conexion->query($sqlEma);
$queryEma2 = $conexion->query($sqlEma);
while ($r = $queryEma->fetch(PDO::FETCH_OBJ)) {
    $ema = $r;
    break;
}
$sqlNom = "SELECT us.nom_usu,us.eml_usu 
FROM mq_usu us, cre_solicitud sol
WHERE sol.id_usu=us.id_usu
AND id_rol=100";
$queryNom = $conexion->query($sqlNom);
$queryNom1 = $conexion->query($sqlNom);
while ($r = $queryNom->fetch(PDO::FETCH_OBJ)) {
    $nom = $r;
    break;
}

$sqlCon = "SELECT us.nom_usu, us.eml_usu 
FROM mq_usu us
WHERE id_rol=200";
$queryCon = $conexion->query($sqlCon);
while ($r = $queryCon->fetch(PDO::FETCH_OBJ)) {
    $con = $r;
    break;
}
$sqlTe = "SELECT us.nom_usu, us.eml_usu 
FROM mq_usu us
WHERE id_rol=300";
$queryTe = $conexion->query($sqlTe);
while ($r = $queryTe->fetch(PDO::FETCH_OBJ)) {
    $te = $r;
    break;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../../resources/css/bootstrap.min.css">
</head>

<body style="color:black;background:#f9f9f9">
    <div class="col-12">
        <div class="col-12 text-center">
            <br>
            <img src="https://inventarios.masterquimica.com/empresas/img/INVENTARIOS.png" width="300">
            <h3 style="color:black">El usuario a modificado la solicituda</h3>
            <hr width="60%">
        </div>
    </div>
    <div class="col-12 text-center">
        <div class="col-12">
            <table class="table table-bordered " id="datatable" style="font-size: 15px;color:black;background:#DFDFDF;border-radius: 9px;" width="800">
                <thead style="color:white;background:#58585C">
                    <tr style="height:40px;">
                        <th style="border-radius: 0px 0px 0px 0px;"># Solicitud
                        <th width="150">Cliente</th>
                        <th width="250">Fecha de Creación</th>
                        <th width="250">Asesor Comercial</th>
                        <th width="250">Estado </th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rE2 = $queryEma2->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr class="text-center">
                            <td width="80"><?php $rE2["id_sol"] ?></td>
                            <td><?php $rE2["nom_cli"] ?></td>
                            <td><?php $rE2["fec_sol"] ?></td>
                            <td><?php $rE2["nom_usu"] ?></td>
                            <td><?php $rE2["nom_est"] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div style="color:black">
            Por favor contactese con el administrador para la entreda de los elementos.
        </div>
    </div>
</body>

</html>