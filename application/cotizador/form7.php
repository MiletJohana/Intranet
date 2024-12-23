<?php 
if (isset($_POST['resp']) && $_POST['resp'] == 'cerrar') {
    include '../../../conexion.php';
    include '../../../resources/template/credentials.php';
} elseif (isset($_POST['para'])) {
    include '../../conexion.php';
    include '../../resources/template/credentials.php';
} else {
    include "../../conexion.php";
    include '../../resources/template/credentials.php';
}
$sql="SELECT * FROM `cot_cotizaciones` as cot 
    INNER JOIN mq_clie AS cli ON cot.id_cli = cli.id_cli 
    INNER JOIN cot_contactos AS cont ON cot.id_cont = cont.id_cont 
    INNER JOIN mq_usu AS us ON cot.ced_ase = us.id_usu 
    WHERE cot.id_coti=".$_POST['edit'];
$query=$conexion->query($sql);
$r=$query->fetch(PDO::FETCH_ASSOC);
//echo $sql;
$sqlTipag = "SELECT * FROM cot_form_pag_mypro WHERE id_pag NOT IN(9,17)";
$queryTipag = $conexion->query($sqlTipag);

$sqlTipedi = "SELECT * FROM cot_tip_pedido WHERE id_tip_pedi NOT IN (11,31,51,71)";
$queryTipedi = $conexion->query($sqlTipedi);
?>
<form role="form" id="form-pedidoM">
    <div class="row" style="color: #02587f;background-color: #cdeefd;border-color: #b8e7fc">
        <div class="col-12 col-sm-12 mb-3">
            <p>
            ¡Recuerde que una vez aprobada la cotización, se creará en myprocess con los respectivos datos que usted colocó!
            <?php if ($r['ced_ase'] == ''){ echo '<strong >Te falta agregar el Asesor Comercial </strong>';}?> 
            </p>
        </div>       
    </div>
    <?php if ($r['ced_ase'] != ''){?>
    <div class="row text-center" style="color: #02587f;background-color: #cdeefd;border-color: #b8e7fc">
        <div class="col-12">
                <h3>Datos De La Cotización</h3>
				<hr class="mx-auto" style="width:60%;">
        </div>
    </div>
    <div class="row" style="color: #02587f;background-color: #cdeefd;border-color: #b8e7fc">
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="nom_cli" class="form-label">Nombre Del Cliente</label>
            <input type="text" class="form-control" id="nom_cli" name="nom_cli" value="<?php $r['nom_cli']; ?>" readonly >
        </div>
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="nom_cont" class="form-label">Nombre Del Contacto </label>
            <input type="text" class="form-control" id="nom_cont" name="nom_cont" value="<?php $r['nom_cont']; ?>" readonly >
        </div>
    </div>
    <div class="row" style="color: #02587f;background-color: #cdeefd;border-color: #b8e7fc">
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="ase_com" class="form-label">Asesor Comercial</label>
            <input type="text" class="form-control" id="ase_com" name="ase_com" value="<?php $r['nom_usu']; ?>" readonly>
        </div>
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="tot_cot" class="form-label">Total De La Cotizacion </label>
            <input type="text" class="form-control" id="tot_cot" name="tot_cot" value="<?php $r['cost_cot']; ?>" readonly >
        </div>
    </div>
    <div class="row text-center mt-5">
        <div class="col-md-12">
                <h3>Pedido Myprocess</h3>
				<hr class="mx-auto" style="width:60%;">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="dir_uno" class="form-label">Dirección 1</label>
            <input type="text" class="form-control" id="dir_uno" name="dir_uno" value="" required >
        </div>
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="dir_dos" class="form-label">Dirección 2</label>
            <input type="text" class="form-control" id="dir_dos" name="dir_dos" value="" >
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 mb-3">
            <label for="cod_post" class="form-label">Codigo Postal</label>
            <input type="text" class="form-control" id="cod_post" name="cod_post" value="" required >
        </div>
        <div class="col-md-6 col-sm-12 mb-3">
                <select class="form-select" id="pag_mypro" name="pag_mypro" style="height:34px;" required>
                    <option value="">Tipo de pago en myProcess</option>
                    <?php while ($rTipag = $queryTipag->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $rTipag['id_pag']; ?>"><?php echo $rTipag['nom_pag']; ?></option>
                    <?php } ?>
                </select>
        </div>
    </div>
	<div class="row">
		<div class="col-md-6 col-sm-12 mb-3">
			<select class="form-select" id="tip_pedido" name="tip_pedido" style="height:34px;" required>
				<option value="">Tipo de pedido en myProcess</option>
				<?php while ($rTiped = $queryTipedi->fetch(PDO::FETCH_ASSOC)) { ?>
					<option value="<?php echo $rTiped['id_tip_pedi']; ?>"><?php echo $rTiped['nom_tip_pedi']; ?></option>
				<?php } ?>
			</select>
		</div>
    </div>
    <?php } ?>
    <input type="hidden" id="action" name="action" value="recoAprob">
    <input type="hidden" id="id_coti" name="id_coti" value="<?php $_POST['edit'];?>">
</form>