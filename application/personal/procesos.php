<?php
include "../../conexion.php";
include '../../resources/template/credentials.php';
$sqlPro = "SELECT * FROM ind_select_per
WHERE id_sel='" . $_POST['info'] . "'";
$queryPro = $conexion->query($sqlPro);
//echo $sqlPro;
while ($rP = $queryPro->fetch(PDO::FETCH_OBJ)) {
    $pro = $rP;
    break;
}
?>
<div class="row">
    <div class="col-12">
        <h3 class="text-center">Información del proceso de selección </h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<div class="row">
    <div class="table-responsive" style="max-height:800px;">
        <table class="table table-bordered " id="datatable" style="font-size:85%;">
            <thead>
                <tr>
                    <th>Entrevistas</th>
                    <th>Pruebas</th>
                    <th>Analisis Y Decisión</th>
                    <th>Polígrafo</th>
                    <th>Visita y Examen M</th>
                </tr>
            </thead>
            <tbody>
                <tr style="background-color: DDDDDD;">
                    <td class="text-center">
                        <div class="custom-control custom-radio">
                            <label <?php if ($pro->pro_entre == 'Si') {
                                        echo "disabled class='btn btn-danger custom-control-label'";
                                    } ?> class="btn btn-info custom-control-label"><input type="radio" class="custom-control-input" name="est_entre<?php echo $pro->id_sel ?>" value="Si" <?php if ($pro->pro_entre == 'Si') {
                                                                                                                                            echo 'checked';
                                                                                                                                        } else {
                                                                                                                                            echo "onclick='cumProces(1," . $pro->id_sel . ")'";
                                                                                                                                        } ?>>Si.</label>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="custom-control custom-radio">
                            <label <?php if ($pro->pro_prue == 'Si') {
                                        echo "disabled class='btn btn-danger custom-control-label'";
                                    } ?> class="btn btn-info custom-control-label"><input type="radio" class="custom-control-input" name="est_prue<?php echo $pro->id_sel ?>" value="Si" <?php if ($pro->pro_prue == 'Si') {
                                                                                                                                            echo 'checked';
                                                                                                                                        } else {
                                                                                                                                            echo "onclick='cumProces(2," . $pro->id_sel . ")'";
                                                                                                                                        } ?>>Si.</label>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="custom-control custom-radio">
                            <label <?php if ($pro->pro_ana == 'Si') {
                                        echo "disabled class='btn btn-danger custom-control-label'";
                                    } ?> class="btn btn-info custom-control-label"><input type="radio" class="custom-control-input" name="est_ana<?php echo $pro->id_sel ?>" value="Si" <?php if ($pro->pro_ana == 'Si') {
                                                                                                                                            echo 'checked';
                                                                                                                                        } else {
                                                                                                                                            echo "onclick='cumProces(3," . $pro->id_sel . ")'";
                                                                                                                                        } ?>>Si.</label>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="custom-control custom-radio">
                            <label <?php if ($pro->pro_poli == 'Si') {
                                        echo "disabled class='btn btn-danger custom-control-label'";
                                    } ?> class="btn btn-info custom-control-label"><input type="radio" class="custom-control-input" name="est_poli<?php echo $pro->id_sel ?>" value="Si" <?php if ($pro->pro_poli == 'Si') {
                                                                                                                                            echo 'checked';
                                                                                                                                        } else {
                                                                                                                                            echo "onclick='cumProces(4," . $pro->id_sel . ")'";
                                                                                                                                        } ?>>Si.</label>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="custom-control custom-radio">
                            <label <?php if ($pro->pro_visi == 'Si') {
                                        echo "disabled class='btn btn-danger custom-control-label'";
                                    } ?> class="btn btn-info custom-control-label"><input type="radio" class="custom-control-input" name="est_vis<?php echo $pro->id_sel ?>" value="Si" <?php if ($pro->pro_visi == 'Si') {
                                                                                                                                            echo 'checked';
                                                                                                                                        } else {
                                                                                                                                            echo "onclick='cumProces(5," . $pro->id_sel . ")'";
                                                                                                                                        } ?>>Si.</label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="col-12" id="resproc"></div>