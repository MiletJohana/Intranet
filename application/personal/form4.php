<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
if (isset($_POST['resp']) && $_POST['resp'] == 8) {
$sql = "SELECT * FROM ind_solcarg sol , ind_cargos car 
        WHERE sol.carg_sol=car.id_carg 
        AND sol.id_solC= ".$_POST['edit'];
$query = $conexion->query($sql);
}else{
 $sql = "SELECT * FROM ind_select_per per , ind_solcarg sol , ind_cargos car
 WHERE per.id_solC=sol.id_solC 
 AND sol.carg_sol=car.id_carg ";
 $sql.= " AND per.id_sel = ".$_POST['edit'];
 $sql.= " AND per.id_solC =".$_POST['carg']; 
 $query = $conexion->query($sql);
}
$r = $query->fetch(PDO::FETCH_ASSOC);
$car = $r['carg_sol'];
$sqlCar = "SELECT * FROM ind_cargos WHERE id_carg = " . $car;
$queryCar = $conexion->query($sqlCar);
$Rca = $queryCar->fetch(PDO::FETCH_ASSOC);
$sqlCar2 = "SELECT * FROM ind_cargos  WHERE id_carg != " . $car;
$queryCar2 = $conexion->query($sqlCar2);
$Rca2 = $queryCar2->fetch(PDO::FETCH_ASSOC);
$rAre1 = $r['area_sol'];
$sqlAre = "SELECT * FROM mq_are  WHERE id_are=" . $rAre1;
$queryAre = $conexion->query($sqlAre);
$rAre = $queryAre->fetch(PDO::FETCH_ASSOC);
$sqlAre2 = "SELECT * FROM mq_are  WHERE id_are!=" . $rAre1;
$queryAre2 = $conexion->query($sqlAre2);
$sqlReg = "SELECT * FROM mq_reg";
$queryReg = $conexion->query($sqlReg);
$per = $r['id_per'];
$sqlU = "SELECT * FROM mq_usu WHERE id_usu = " . $per;
$queryU = $conexion->query($sqlU);
$u = $query->fetch(PDO::FETCH_ASSOC);
if ($r['req_sol'] == 0) {
    $sqlCar = "SELECT * FROM ind_solcarg 
                      WHERE id_solC='" . $r['id_solC'] . "'";
    $queryCar = $conexion->query($sqlCar);
    $rCar = NULL;
    if ($queryCar->rowCount() > 0) {
        $rCar = $queryCar->fetch(PDO::FETCH_ASSOC);
    }
    $rAre1 = $rCar['area_sol'];
} else {
    $rAre1 = $r['id_are'];
}

function genUsu($param, $nombre)
{
    $nombreC = explode(" ", $nombre);
    if ($param == 0) {
        if (count($nombreC) < 1) {
            $usuLogin = substr($nombre, 0, 1) . $nombreC[2];
        } else {
            $usuLogin = substr($nombre, 0, 1) . $nombreC[0];
        }
    } else {
        if (count($nombreC) != 1) {
            if (count($nombreC) > 3) {
                $usuLogin = substr($nombre, 0, 1) . $nombreC[3];
            } else {
                $usuLogin = substr($nombre, 0, 1) . $nombreC[1];
            }
        } else {
            $usuLogin = substr($nombre, 0, 1) . $nombreC[0];
        }
    }
    return strtolower($usuLogin);
}
if (isset($_POST['resp']) && $_POST['resp'] == 8) {
?>
    <form role="form" id="form-NewPer">
        <h3 align="center">¿Realmente desea rechazar ésta solicitud?</h3>
        <div class="row">
            <div class="col-md-12">
                <label for="obser_rech" class="form-label"> Motivo</label>
                <textarea class="form-control" id="obser_rech" name="obser_rech" placeholder="Llena este espacio con el motivo del Rechazo"></textarea>
                <input type="hidden" id="accion_form" name="action" value="rechPer">
                <input type="hidden" name="id_sel" id="id_sel" value="<?php $_POST['edit'] ?>">
            </div>
        </div>
    </form>
<?php } else { ?>
    <form id="form-NewPer">
        <div class="row">
            <div class="col-12">
                <h3 align="center"> Datos Usuario </h3>
                <hr class="mx-auto" style="width:60%;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="id_usu" class="form-label">ID</label>
                <input type="number" class="form-control" id="id_usu" name="id_usu" value="<?php if (isset($_POST['edit'])) {
                                                                                                echo $r['id_per'];
                                                                                            } ?>" required readonly>
            </div>
            <div class="col-md-3">
                <label for="nom_usu" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nom_usu" name="nom_usu" value="<?php if (isset($_POST['edit'])) {
                                                                                                echo $r['nom_per'];
                                                                                            } ?>" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Usuario: (Recomendados)</label>
                <br>
                <label class="btn btn-primary"><input type="radio" name="sug" id="nusu1" required value="<?php echo genUsu(0, $r['nom_per']); ?>"> <?php echo genUsu(0, $r['nom_per']); ?></label>
                <label class="btn btn-primary"><input type="radio" name="sug" id="nusu2" required value="<?php echo genUsu(1, $r['nom_per']); ?>" > <?php echo genUsu(1, $r['nom_per']); ?></label>
            </div>
            <div class="col-md-3">
                <label for="fec_firm" class="form-label">Fecha de firma de contrato</label>
                <input type="date" class="form-control" id="fec_firm" name="fec_firm" value="<?php if (isset($_POST['edit'])) {
                                                                                                    echo $u['fec-firm'];
                                                                                                } ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="id_reg" class="form-label">Regional</label>
                <select class="form-select" id="id_reg" name="id_reg" required>
                    <option value="">Selecionar</option>
                    <?php while ($rReg = $queryReg->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rReg['id_reg'] ?>"><?php echo $rReg['nom_reg'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="id_are" class="form-label">Área</label>
                <select class="form-select" id="id_are" name="id_are" required>
                    <option value="<?php echo  $rAre['id_are'] ?>"><?php echo $rAre['nom_are'] ?></option>
                </select> 
            </div>
            <div class="col-md-3">
                <label for="carg_usu" class="form-label">Cargo</label>
                <select class="form-select" id="carg_usu" name="carg_usu" required>
                    <option value="<?php echo $Rca['id_carg'] ?>"><?php  echo $Rca['nom_carg'] ?></option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="tip_con">Tipo De Contrato</label>
                <input type="text" class="form-control" id="tip_con" name="tip_con" value="<?php if (isset($_POST['edit'])) {
                                                                                                echo $r['carg_sol'];
                                                                                            } ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="sal_ba" class="form-label">Salario Básico</label>
                <input type="number" class="form-control" id="sal_ba" name="sal_ba" value="<?php if (isset($_POST['edit'])) {
                                                                                                echo $r['sal_sol'];
                                                                                            } ?>" required>
            </div>
            <div class="col-md-3">
                <label for="sal_var" class="form-label">Salario Variable</label>
                <input type="number" class="form-control" id="sal_var" name="sal_var" value="<?php if (isset($_POST['edit'])) {
                                                                                                    echo $r['var_sal'];
                                                                                                } ?>" required>
            </div>
            <div class="col-md-3">
                <label for="sal_rod" class="form-label">Salario Rodamiento</label>
                <input type="number" class="form-control" id="sal_rod" name="sal_rod" value="<?php if (isset($_POST['edit'])) {
                                                                                                    echo $r['rod_sal'];
                                                                                                } ?>" required>
            </div>

        </div>
        </div>
        <input type="hidden" name="action" id="action" value="addUsu">
    </form>
<?php } ?>