<?php
include "../../resources/template/credentials.php";
include '../../conexion.php';

$sqlNeg = "SELECT cli.*, neg.*, tip.*, est.*, usu.nom_usu FROM mq_clientes AS cli
INNER JOIN negocios AS neg
ON neg.id_cli = cli.id_cli
INNER JOIN mq_usu AS usu
ON neg.id_usu = usu.id_usu
INNER JOIN tipo_negocio AS tip
ON neg.id_tipo = tip.id_tipo
INNER JOIN neg_est AS est
ON neg.id_est = est.id_est
WHERE neg.id_neg = " . $_GET['id'];
$queryNeg = $conexion->query($sqlNeg);
$rNeg = $queryNeg->fetch(PDO::FETCH_ASSOC);

$sqlCat = "SELECT cat.* FROM cot_categoria AS cat 
                    INNER JOIN cat_x_neg AS cxn
                    ON cat.id_cat = cxn.id_cat
                    WHERE cxn.id_neg = " . $rNeg["id_neg"] .
    " ORDER BY cat.id_cat ASC";
$queryCat = $conexion->query($sqlCat);
?>

<div class="container-fluid pt-2">
    <div class="col-12">
        <div class="row">
            <div class="col-md-2" style="border-right: 1px solid #dee2e6!important;">
                <small class="form-text text-muted">Cliente</small>
                <a href="../clientes2/index.php?id=<?php echo $rNeg['id_cli']; ?>">
                    <h3><?php echo $rNeg['nom_cli']; ?></h3>
                </a>
                <small class="form-text text-muted">Nombre del Negocio</small>
                <h5><?php echo $rNeg['nom_neg']; ?></h5>
                <small class="form-text text-muted">Tipo de Negocio</small>
                <h5><?php echo $rNeg['nom_tipo']; ?></h5>
                <small class="form-text text-muted">Estado del Negocio</small>
                <?php if ($rNeg["id_est"] == 2) { ?>
                    <h5>
                        <span class="badge badge-pill badge-success text-light" style="font-size: 1em;">
                            <i class="fa-solid fa-check"></i>
                            Exitoso
                        </span>
                    </h5>
                <?php } else if ($rNeg["id_est"] == 3) { ?>
                    <h5>
                        <span class="badge badge-pill badge-info text-light" style="font-size: 1em;">
                            <i class="fa fa-clock-o"></i>
                            En proceso
                        </span>
                    </h5>
                <?php } else if ($rNeg["id_est"] == 4) { ?>
                    <h5>
                        <span class="badge badge-pill badge-danger text-light" style="font-size: 1em;">
                            <i class="fa-solid fa-xmark"></i>
                            Perdido
                        </span>
                    </h5>
                <?php } ?>
                <small class="form-text text-muted">Tipo de producto</small>
                <h5>
                    <?php
                    $i = 0;
                    $j = $queryCat->rowCount();
                    while ($rC = $queryCat->fetch(PDO::FETCH_ASSOC)) {
                        echo $rC["nom_cat"];
                        $i++;
                        if ($i != $j) {
                            echo ", ";
                        }
                    }
                    ?>
                </h5>
                <?php if (isset($rNeg['des_neg'])) { ?>
                    <small class="form-text text-muted">Descripción del Negocio</small>
                    <h5><?php echo $rNeg['des_neg']; ?></h5>
                <?php } ?>
                <?php if (isset($rNeg['obs_neg'])) { ?>
                    <small class="form-text text-muted">Observaciones del Negocio</small>
                    <h5><?php echo $rNeg['obs_neg']; ?></h5>
                <?php } ?>
                <small class="form-text text-muted">Asesor Encargado del Negocio</small>
                <h5><?php echo $rNeg['nom_usu']; ?></h5>
                <small class="form-text text-muted">Fecha de creación del Negocio</small>
                <h5><?php echo $rNeg['fec_crea']; ?></h5>
            </div>

            <div class="col-md-8" id="transacciones-container">
                <?php
                $param = 2;
                include 'transacciones.php';
                ?>
            </div>

            <div class="col-md-2" style="border-left: 1px solid #dee2e6!important;">
                <ul class="list-group">
                    <a class="list-group-item mr-0">
                        Potencial Creado
                        <?php if ($rNeg['pot_crea'] == 'Si') { ?>
                            <i class='fa-solid fa-check text-success pull-xs-right'></i>
                        <?php } else { ?>
                            <i class='fa-solid fa-xmark text-danger pull-xs-right'></i>
                        <?php } ?>
                    </a>
                    <a class="list-group-item mr-0">
                        Contacto realizado
                        <?php if ($rNeg['cont_rea'] == 'Si') { ?>
                            <i class='fa-solid fa-check text-success pull-xs-right'></i>
                        <?php } else { ?>
                            <i class='fa-solid fa-xmark text-danger pull-xs-right'></i>
                        <?php } ?>
                    </a>
                    <a class="list-group-item mr-0">
                        Visita realizada
                        <?php if ($rNeg['visi_rea'] == 'Si') { ?>
                            <i class='fa-solid fa-check text-success pull-xs-right'></i>
                        <?php } else { ?>
                            <i class='fa-solid fa-xmark text-danger pull-xs-right'></i>
                        <?php } ?>
                    </a>
                    <a class="list-group-item mr-0">
                        Cot. solicitada
                        <?php if ($rNeg['cot_soli'] == 'Si') { ?>
                            <i class='fa-solid fa-check text-success pull-xs-right'></i>
                        <?php } else { ?>
                            <i class='fa-solid fa-xmark text-danger pull-xs-right'></i>
                        <?php } ?>
                    </a>
                    <a class="list-group-item mr-0">
                        Pedido realizado
                        <?php if ($rNeg['ped_rea'] == 'Si') { ?>
                            <i class='fa-solid fa-check text-success pull-xs-right'></i>
                        <?php } else { ?>
                            <i class='fa-solid fa-xmark text-danger pull-xs-right'></i>
                        <?php } ?>
                    </a>
                </ul>
            </div>
        </div>
    </div>
</div>