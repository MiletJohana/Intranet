<?php
include "../../conexion.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlCli = "SELECT * FROM mq_clientes AS cli
    INNER JOIN negocios AS neg
    ON cli.id_cli = neg.id_cli
    WHERE neg.id_neg = $id
    GROUP BY cli.id_cli";
    $queryCli = $conexion->query($sqlCli);
    $rCli = $queryCli->fetch_array();
} else if (isset($_GET['id_cli'])) {
    $id_cli = $_GET['id_cli'];
    $sqlCli = "SELECT * FROM mq_clientes AS cli
    WHERE cli.id_cli = $id_cli
    GROUP BY cli.id_cli";
    $queryCli = $conexion->query($sqlCli);
    $rCli = $queryCli->fetch_array();
}
?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb mt-3 ms-3">
        <li class="breadcrumb-item"><a href="../home/">Inicio</a></li>
        <?php if (isset($_GET['table'])) { ?>
            <li class="breadcrumb-item active text-mq" aria-current="page">Negocios</li>
        <?php } else if (isset($_GET['id'])) { ?>
            <li class="breadcrumb-item"><a href="index.php?table=1">Negocios</a></li>
            <li class="breadcrumb-item acrive text-mq" aria-current="page">Negocio #<?php echo $_GET['id']; ?> - <a href="../clientes2/index.php?id=<?php echo $rCli['id_cli']; ?>"><?php echo $rCli['nom_cli']; ?></a></li>
        <?php } else if (isset($_GET['id_cli'])) { ?>
            <li class="breadcrumb-item"><a href="index.php?table=1">Negocios</a></li>
            <li class="breadcrumb-item acrive text-mq" aria-current="page">Negocios Cliente: <a href="../clientes2/index.php?id=<?php echo $rCli['id_cli']; ?>"><?php echo $rCli['nom_cli']; ?></a></li>
        <?php } ?>
    </ol>
</nav>
<?php
$sqlTipEst = "SELECT * FROM neg_est";
$queryEst = $conexion->query($sqlTipEst);

$sqlTipPro = "SELECT * FROM cot_categoria";
$queryTipPro = $conexion->query($sqlTipPro);
?>
<div class="col-12">
    <div class="py-3">
        <?php if (isset($_GET['table'])) { ?>
            <h3>Negocios</h3>
        <?php } else if (isset($_GET['id'])) { ?>
            <div class="d-flex">
                <h3>Información del Negocio #<?php echo $_GET['id']; ?></h3>
                <button onclick="modalNegocio(2, <?php echo $_GET['id']; ?>, 0, 3)" class="btn btn-danger ms-auto" data-bs-toggle="modal" data-bs-target="#largeModal">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
            </div>
        <?php } else if (isset($_GET['id_cli'])) { ?>
            <h3>Negocios de <?php echo $rCli['nom_cli']; ?></h3>
        <?php } ?>
    </div>
    <?php if (isset($_GET['table']) && $_GET['table'] == 1) { ?>
        <div class="row">
            <div class="col-md-2">
                <button type="button" onclick="modalNegocio(1, 0, 0, 1)" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#largeModal">
                    Crear
                </button>
            </div>
            
        </div>
    <?php } ?>
</div>