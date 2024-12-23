<?php
include "../../conexion.php";
if ($_GET['table'] != 4) { ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-3 ms-3">
            <li class="breadcrumb-item"><a href="../home/">Inicio</a></li>
            <?php if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sqlCli = "SELECT * FROM mq_clientes
            WHERE id_cli = $id
            GROUP BY id_cli";
                $queryCli = $conexion->query($sqlCli);
                $rCli = $queryCli->fetch(PDO::FETCH_ASSOC);
            ?>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="index.php?table=1">Clientes</a>
                </li>
                <li class="breadcrumb-item active text-mq" aria-current="page">
                    <?php echo $rCli['nom_cli']; ?>
                </li>
            <?php } else { ?>
                <li class="breadcrumb-item active text-mq" aria-current="page">
                    Clientes
                </li>
            <?php } ?>
        </ol>
    </nav>
<?php }
$sqlTipCli = "SELECT * FROM tipo_clientes";
$queryTipCli = $conexion->query($sqlTipCli);

$sqlCiu = "SELECT * FROM ciudades";
$queryCiu = $conexion->query($sqlCiu);
?>
<?php if (isset($_GET['table'])) { ?>
    <div class="col-12">
        <?php if ($_GET['table'] != 4) { ?>
            <div class="py-3">
                <h3>Clientes</h3>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-2">
                <button type="button" onclick="modalCliente(1, 0, 1);" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#largeModal">
                    Crear cliente
                </button>
            </div>
            <div class="col-md-2">
                <label for="sel_fil" class="form-label">Filtro</label>
                <select class="form-select" id="sel_fil" name="sel_fil" onchange="selFiltroCli(this.value)">
                    <option value="0">Seleccione</option>
                    <option value="1">Tipo de cliente</option>
                    <option value="2">Fecha de registro</option>
                    <option value="3">Tipo de documento</option>
                    <option value="4">Ciudad</option>
                </select>
            </div>
            <div class="col-md-2" id="filTipCli" style="display: none">
                <label for="tip_cli" class="form-label">Tipo de Cliente</label>
                <select class="form-select" id="tip_cli" name="tip_cli" onchange="filtroClie()">
                    <option value="">Seleccione</option>
                    <?php while ($rT = $queryTipCli->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rT['id_tipo']; ?>"><?php echo $rT['tipo']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2" id="filFecCrea" style="display: none">
                <label for="fec_crea" class="form-label" >Fecha de creación</label>
                <input type="month" id="fec_crea" name="fec_crea"  max="<?php echo date('Y-12'); ?>" class="form-control" onchange="filtroClie()">
            </div>
            <div class="col-md-2" id="filNitCc" style="display: none">
                <label for="nitCc" class="form-label">Tipo de documento</label>
                <select class="form-select" id="nitCc" name="nitCc" onchange="filtroClie()">
                    <option value="">Seleccione</option>
                    <option value="NIT">NIT</option>
                    <option value="C.C">C.C</option>
                </select>
            </div>
            <div class="col-md-2" id="filCiu" style="display: none">
                <label for="id_ciu" class="form-label">Ciudad</label>
                <select class="form-select" id="id_ciu" name="id_ciu" onchange="filtroClie()">
                    <option value="">Seleccione</option>
                    <?php while ($rC = $queryCiu->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rC['id_ciu']; ?>"><?php echo utf8_encode($rC['nom_ciu']); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2 col-sm-12 mt-4">
                <button type="button" class="btn btn-info" id="btn-filtros" onclick="resetFiltros();" disabled>
                    Reiniciar Filtros
                </button>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($_GET['table'] == 4) { ?>
    <div id="content-table">
        <?php include('../clientes2/tabla.php'); ?>
    </div>
<?php } ?>