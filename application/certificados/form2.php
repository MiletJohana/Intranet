<?php
include '../../conexion.php';
include "../../resources/template/credentials.php";

$sqlUsu="SELECT * FROM mq_usu AS usu INNER JOIN ind_cargos AS car 
ON usu.id_carg = car.id_carg WHERE id_usu =".$_POST['edit'];
$queryUsu=$conexion->query($sqlUsu);
$rU = $queryUsu->fetch(PDO::FETCH_ASSOC);
$tipoC = $rU['tip_contrato'];
$cargo = $rU['id_carg'];

if (isset($rU['tip_contrato'])){
    $sqlTip="SELECT * FROM ind_tipcontrato WHERE nom_contrato != '$tipoC'";
} else{
    $sqlTip="SELECT * FROM ind_tipcontrato";
}
$queryTip=$conexion->query($sqlTip);

if (isset($rU['id_carg'])){
    $sqlCarg="SELECT * FROM ind_cargos WHERE id_carg != '$cargo' ";
} else{
    $sqlCarg="SELECT * FROM ind_cargos ";
}
$sqlCarg.="ORDER BY nom_carg ASC";
$queryCarg=$conexion->query($sqlCarg);



?>
<form role="form" id="form-actUs">
<div class="col-12 text-center">
        <h3>Actualización De Nomina</h3>
        <hr class="mx-auto" style="width:60%;">
    </div>
</div>
<input type="hidden" id="id_usu" name="id_usu" value="<?php echo $_POST['edit'] ?>">
<input type="hidden" id="accion_form" name="action" value="updateCert">
<div class="row">
    <div class="col-md-4 col-sm-12">
        <label for="" class="form-label">Tipo de Contrato: </label>
        <select class="form-select" id="tip_cont" name="tip_cont" value="" required>
            <?php if (!isset($rU['tip_contrato'])){ ?>
                <option value="">Seleccione el Tipo De Contrato</option>
            <?php } else { ?>
                <option value="<?php echo $rU['tip_contrato']; ?>"><?php echo $rU['tip_contrato']; ?> </option>
            <?php } 
                while ($r = $queryTip->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?php echo $r['nom_contrato']; ?>"><?php echo $r['nom_contrato']; ?> </option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-4 col-sm-12">
        <label for="" class="form-label"> Cargo: </label>
        <select class="form-select" id="tip_carg" name="tip_carg" value="" >
        <?php if (!isset($rU['id_carg'])){?>
            <option value="">Seleccione el Cargo</option>
        <?php } else { ?>
            <option value="<?php echo $rU['id_carg']; ?>"><?php echo $rU['nom_carg']; ?> </option>
        <?php } 
            while ($rCom = $queryCarg->fetch(PDO::FETCH_ASSOC)) { ?>
            <option value="<?php echo $rCom['id_carg']; ?>"><?php echo $rCom['nom_carg']; ?> </option>
        <?php } ?>
        </select>
    </div>
    <div class="col-md-4 col-sm-12">
        <label for="" class="form-label">Fecha de firma de contrato: </label>
        <input type="date" class="form-control" id="fech_cont" name="fech_cont" value="<?php echo $rU['fec_firm'];?>">
    </div> 

</div>
<div class="row mt-3">
    <div class="col-md-4 col-sm-12">
        <label for="" class="form-label">Salario Base: </label>
        <input type="text" class="form-control" id="sal_base" name="sal_base" value="<?php echo $rU['sala_base'];?>">
    </div> 
    <div class="col-md-4 col-sm-12">
        <label for="" class="form-label">Salario Variable: </label>
        <input type="text" class="form-control" id="sal_vari" name="sal_vari" value="<?php echo $rU['sala_varia'];?>">
    </div>
    <div class="col-md-4 col-sm-12">
        <label for="" class="form-label">Salario Rodamiento: </label>
        <input type="text" class="form-control" id="sal_roda" name="sal_roda" value="<?php echo $rU['sal_roda'];?>">
    </div>
</div>
</form>