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
        <div class="row justify-content-md-center">
            <div class="col-md-2 col-sm-12">
                <label for="id_usu2" class="form-label">Usuario</label>
                <select class="form-select" name="id_usu2" id="id_usu2" onchange="ctrlResum();">
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
                        <?php while ($r = $query-> fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $r['id_usu']; ?>"><?php echo ucwords(strtolower($r['nom_usu'])); ?></option>
                    <?php }
                    } ?>
                </select>
            </div> 
            <div class="col-md-2 col-sm-12">
                    <label for="mesR" class="form-label">Mes Inicial</label>
                    <input type="month" class="form-control" id="mesR" name="mesR" onchange="ctrlResum();" value="<?php echo $month; ?>">
            </div>

            <div class="col-md-2 col-sm-12">
                    <label for="mesR2" class="form-label">Mes Final</label>
                    <input type="month" class="form-control" id="mesR2" name="mesR2" onchange="ctrlResum();" value="<?php echo $mes2; ?>">

            </div>
           
            <div class="col-md-2 col-sm-12 mt-4">
                <form role="form" action="../cotizadorv3/reportes/controlCoti.php" id="formControl"  method="POST" class="mx-md-0 px-sm-2">
                    <input type="hidden" name="action" value="controlCoti">
                    <a class="btn btn-success" id="excelCont" onclick="form(3);" ><i class="fa-solid fa-file-excel"></i> Excel</a>
                </form>
            </div>
                

        </div>
       

    <div id="content-table2" class="content-table">
        <?php include 'tablacontrol.php'; ?>
    </div>
</div>