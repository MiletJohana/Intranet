<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
$id = $_SESSION['id'];
$sql = "SELECT nom_usu,id_usu FROM mq_usu where id_usu!='$id' order by nom_usu";
$query = $conexion->query($sql);
$month = date("Y-01");
$anio = date("Y");
$mes2 = date("Y-m");
?>
<div class="container">
    <form role="form" action="../cotizador/reportes/controlCoti.php" method="POST" class="mx-md-0 px-sm-2">
        <div class="row justify-content-md-center">
            <div class="col-md-2 col-sm-12">
                <div class="row">
                    <label for="id_usu2" class="form-label">Usuario</label>
                    <select class="form-select" name="id_usu2" id="id_usu2" onchange="ctrlUsu();">
                        <option value="<?php echo $_SESSION['id']; ?>">Mis cotizaciones</option>
                        <?php
                        $sql = "SELECT nom_usu,id_usu FROM mq_usu where id_usu!='" . $_SESSION['id'] . "' order by nom_usu";
                        $query = $conexion->query($sql);
                         if (($_SESSION['lid'] == 1 ) || ($_SESSION['lid'] ==2 && ( $_SESSION['are'] == 13 ||  $_SESSION['are'] == 7 || $_SESSION['are'] == 11 || $_SESSION['are'] == 3))) { ?>
                            <option value="100">SAC</option>
                        <?php }
                        if (($_SESSION['lid'] == 1 )  || ($_SESSION['lid'] ==2 && ($_SESSION['are'] == 13 ||  $_SESSION['are'] == 11 || $_SESSION['are'] == 3))) { ?>
                            <option value="200">Ventas</option>
                        <?php }
                        if (($_SESSION['lid'] == 1 ) || ($_SESSION['lid'] ==2 && ($_SESSION['are'] == 13 ||  $_SESSION['id'] == 6 || $_SESSION['id'] == 3))) { ?>
                            <option value="300">Televentas</option>
                        <?php }
                        if (($_SESSION['lid'] == 1 ) ||  ($_SESSION['lid'] ==2 && ($_SESSION['are'] == 13 ||  $_SESSION['id'] == 6   ||  $_SESSION['are'] == 11 || $_SESSION['id'] == 3))) { ?>
                            <?php while ($r = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $r['id_usu']; ?>"><?php echo ucwords(strtolower($r['nom_usu'])); ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="row">
                    <label for="mesR" class="form-label">Mes Inicial</label>
                    <input type="month" class="form-control" id="mesR" name="mesR" onchange="ctrlUsu();" value="<?php echo $month; ?>">
                </div>
            </div>

            <div class="col-md-2">
                <div class="row">
                    <label for="mesR2" class="form-label">Mes Final</label>
                    <input type="month" class="form-control" id="mesR2" name="mesR2" onchange="ctrlUsu();" value="<?php echo $mes2; ?>">
                </div>
            </div>
            <div class="col-md-2">
                <br>
                <input type="hidden" name="action" value="controlCoti">
                <button type="submit" class="btn btn-success dropdown-btn" value=""><i class="fa-solid fa-file-excel me-1"></i>Exportar</button>
            </div>
        </div>
    </form>
    <!--<div id="estadistics2">
        <?php //include "table_stadistics.php" ?>
    </div>
    <div id="content-table2" class="content-table">-->
        <?php include 'table_control.php'; ?>
    </div>
</div>