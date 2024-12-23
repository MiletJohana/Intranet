<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
date_default_timezone_set("America/Bogota");
$mes = date('m') - 1;
$mes_act = date('m');
$sql = "SELECT * FROM mq_diligencias as dl, mq_clientes as cl WHERE dl.id_cli = cl.id_cli AND MONTH(dia_dlg) 
BETWEEN $mes AND $mes_act AND est_dlg IN ('1','3') AND dl.id_reg = '" . $sesion_reg . "' ORDER BY num_dlg ASC";
$query = $conexion->query($sql);
?>

<div class="row">
    <div class="col-md-12" align="center">
        <h3 align="center">Crea el Enrutamiento</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div style="overflow-y: scroll; height:220px;">
            <div class="col-12">
                <table class="table" id="tablaDiligencias" style="font-size: 90%; height: 200px">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Dirección</th>
                            <th>Cliente:</th>
                            <th>Fecha:</th>
                            <th>Descripcion:</th>
                            <th>Horario:</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody id="diligencias">
                        <?php while ($r = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr id="<?php echo $r["num_dlg"]; ?>" data-id="<?php echo $r["num_dlg"]; ?>">
                                <td><?php echo $r["num_dlg"]; ?></td>
                                <td><?php echo $r["dir_dlg"]; ?></td>
                                <td><?php echo $r["nom_cli"]; ?></td>
                                <td><?php echo $r["dia_dlg"]; ?></td>
                                <td><?php echo $r["dil_des"]; ?></td>
                                <td><?php echo $r["hor_dlg"]; ?></td>
                                <td>
                                    <button type="button" id="btn-check-dil" onclick='moverDiligencia(<?php echo $r["num_dlg"]; ?>)' class="btn btn-success">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 mt-5" align="center" >
        <h3>En Lista</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div style="overflow-y: scroll; height:220px;">
            <div class="col-12">
                <table class="table col-8" style="font-size: 90%; height: 200px" id="tableDiligenciaEnr">
                    <thead>
                        <th>#</th>
                        <th>Diligencia</th>
                        <th>Cliente</th>
                        <th style="display:none" disabled>Fecha:</th>
                        <th>Descripción</th>
                        <th>Horario</th>
                        <th>Acción</th>
                    </thead>
                    <tbody id="ruta">
                    </tbody>
                </table>
                <input type="hidden" id="accion_form" name="action" value="<?php echo ($_POST['resp'] == 1) ? "add" : "update"; ?>">
            </div>
        </div>
    </div>
</div>