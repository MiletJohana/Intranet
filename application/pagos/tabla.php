<?php
if (isset($_POST['resp']) && $_POST['resp'] == 'cerrar') {
    include '../../../conexion.php';
    include '../../../resources/template/credentials.php';
} else {
    include '../../conexion.php';
    include '../../resources/template/credentials.php';
}
$fecha = date("Y-m-d");
$mes = date("m");
$year = date("Y");
$sqlPag = "SELECT * FROM ind_fechas fec, ind_nompag  pag where fec.id_pag=pag.id_pag and MONTH(fech_pag )=$mes and YEAR(fech_pag)=$year";
$queryPag = $conexion->query($sqlPag);
$sqlLiq = "SELECT inf.id_liqui, us.nom_usu, ar.nom_are, liq.nom_liqui, inf.fec_ret, inf.fech_ref, inf.fech_pag, inf.dias_habiles 
FROM ind_infoli inf, mq_are ar, mq_usu us, ind_liqui liq
WHERE inf.id_usu=us.id_usu  AND MONTH(inf.fec_ret)=$mes AND YEAR(inf.fec_ret)=$year AND inf.id_are=ar.id_are AND inf.id_liquiInf=liq.id_liquiInf ";
$queryLiq = $conexion->query($sqlLiq);
//echo $sqlLiq;
?>
<div class="col-12">
    <button type="button" onclick="newIndicador(11,'Variable','../pagos/tabsForm.php');" class="btn btn-danger my-3" data-bs-toggle="modal" data-bs-target="#largeModal">
        Crear
    </button>
    <?php if ($queryPag->rowCount() > 0) { ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="tablePagos1-1">
                <thead class="table-dark">
                    <tr>
                        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 400) { ?>
                            <th>#</th>
                        <?php } ?>
                        <th>Pago De:</th>
                        <th>Fecha Del Pago</th>
                        <th>Fecha De Referencia</th>
                        <th>Fecha De Entrega</th>
                        <th>Dias Habiles</th>
                        <th>Entregado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rpag = $queryPag->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 400) { ?>
                                <td class="text-center"><?php echo ($rpag["id_relPag"]); ?></td>
                            <?php } ?>
                            <td class="justify-text"><?php echo $rpag["nom_pag"]; ?></td>
                            <td class="text-center"><?php echo ($rpag["fech_pag"]); ?></td>
                            <td class="text-center"><?php echo ($rpag["fech_ref"]); ?></td>
                            <td class="text-center"><?php if ($rpag["fec_ent"] != '') {
                                                        echo $rpag["fec_ent"];
                                                    } else {
                                                        echo '--';
                                                    } ?></td>
                            <td class="text-center"><?php if ($rpag["dias_indicador"] != '') {
                                                        echo $rpag["dias_indicador"];
                                                    } else {
                                                        echo '--';
                                                    } ?></td>
                            <?php if ($rpag["fec_ent"] != '') { ?>
                                <td class="text-center">
                                    <label>
                                        <input type="checkbox" value="" disabled name="estAp<?php echo $rpag['id_relPag'] ?>" id="estAp<?php echo $rpag['id_relPag'] ?>" onclick="aceptado3(<?php echo $rpag['id_relPag'] ?>,'pagos','tabla.php');"checked>
                                    </label>
                                </td>
                            <?php } else { ?>
                                <td class="text-center">
                                    <label>
                                        <input type="checkbox" value="" name="estAp<?php echo $rpag['id_relPag'] ?>" id="estAp<?php echo $rpag['id_relPag'] ?>" onclick="aceptado3(<?php echo $rpag['id_relPag'] ?>,'pagos','tabla.php');">
                                    </label>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#tablePagos1-1').DataTable({
                    "ordering": true,
                    "aaSorting": [],
                    "order": [
                        [0, "desc"]
                    ]
                });
                $('.dataTables_length').addClass('bs-select');
            });
        </script>
    <?php } else { ?>
        <div class="alert alert-success alert-dismissible fade show mt-4 d-flex align-items-center" role="alert">
            <i class="fa-solid fa-circle-check me-3 fa-xl"></i>
                    No hay resultados
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php }
    if ($queryLiq->rowCount() > 0) { ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="tablePagos1-2">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Pago De Liquidación: </th>
                        <th>Fecha De Retiro</th>
                        <th>Fecha De Entrega A Cont:</th>
                        <th>Fecha De Entrega</th>
                        <th>Dias Habiles</th>
                        <th>Entregado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rLiq = $queryLiq->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td class="text-center"><?php echo $rLiq["id_liqui"] ?></td>
                            <td class="text-center"><?php echo $rLiq["nom_usu"]; ?></td>
                            <td class="text-center"><?php echo $rLiq["fec_ret"]; ?></td>
                            <td class="text-center"><?php echo $rLiq["fech_ref"]; ?></td>
                            <td class="text-center"><?php if ($rLiq["fech_pag"] != '') {
                                                        echo $rLiq["fech_pag"];
                                                    } else {
                                                        echo '--';
                                                    } ?></td>
                            <td class="text-center"><?php if ($rLiq["dias_habiles"] != '') {
                                                        echo $rLiq["dias_habiles"];
                                                    } else {
                                                        echo '--';
                                                    } ?></td>
                            <?php if ($rLiq["fech_pag"] != '') { ?>
                                <td class="text-center">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" value="" disabled name="estAp<?php echo $rLiq['id_liqui'] ?>" id="estAp<?php echo $rLiq['id_liqui'] ?>" onclick="aceptado2(<?php echo $rLiq['id_liqui'] ?>,'pagos','tabla.php');" checked>
                                        <label class="form-label" for="defaultChecked2"></label>
                                    </div>
                                </td>
                            <?php } else { ?>
                                <td class="text-center">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" value="" name="estAp<?php echo $rLiq['id_liqui'] ?>" id="estAp<?php echo $rLiq['id_liqui'] ?>" onclick="aceptado2(<?php echo $rLiq['id_liqui'] ?>,'pagos','tabla.php');">
                                        <label class="form-label" for="defaultChecked2"></label>
                                    </div>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#tablePagos1-2').DataTable({
                    "ordering": true,
                    "aaSorting": [],
                    "order": [
                        [0, "desc"]
                    ]
                });
                $('.dataTables_length').addClass('bs-select');
            });
        </script>
    <?php } ?>
</div>