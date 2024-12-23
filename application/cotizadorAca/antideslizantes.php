<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
?>
<br>
<div class="row">
    <div class="col-12 col-sm-12 text-center">
		<h3> Productos <?php if(isset($_POST['value']) && $_POST['value']==2){echo 'Cubiertas';}elseif($_POST['value']==3){echo'Antideslizantes';}elseif($_POST['value']==4){echo 'Piso Epoxico';}?></h3>
		<hr class="mx-auto" style="width:70%;"><br>
	</div>
</div>
<div class="row">
	<div class="col-md-4 col-sm-12 mb-3">
		<input type="text" name="nom_proA" id="nom_proA" class="form-control" placeholder="Nombre Producto" onkeyup="autoProd(1);" <?php if (!isset($_POST['edit'])) {
																																		echo 'readonly';
																																	} ?>>
	</div>
	<div class="col-md-4 col-sm-12 mb-3">
		<input type="text" name="pre_unidad" id="pre_unidad" class="form-control" placeholder="Precio x Unidad">
	</div>

	<div class="col-md-4 col-sm-12 mb-3">
		<label width="60%" class="btn btn-red" style="background-color:#039be0" align="center"><input type="checkbox" name="cot_desins" id="cot_desins" value="1" checked=""> Desinstalación</label>
	</div>
</div>
<div class="row">
	<div class="col-md-2 col-sm-12 mb-3">
		<button id="btnM" type="button" class="btn btn-success" onclick="agregarTabl(1);">+</button>
	</div>
</div>
<div class="table-responsive">
    <table class="table" id="tablaC">
        <thead>
            <tr>
                <th>Ubicación</th>
                <th>Cantidad en <strong> M </strong></th>
                <th>Unidades</th>
                <th></th>
            </tr>
		</thead>
			
			
        <tbody>
	</table>
</div>
<div class="row">
	<div class="col-md-12 col-sm-12 mb-3">
		<button type="button" class="btn btn-success" onclick="agregarProd(2);" id="agregaca"><i class="fa cafa-check"></i> Agregar</button>
	</div>
</div>
<div class="row">
		<div class="col-12 col-sm-12 mt-5">
			<h3 align="center">Productos</h3>
			<hr class="mx-auto" style="width:60%;">
		</div>
	</div>
	<div class="row" style="min-height: 250px;">
		<div class="col-12">
			<div class="table-responsive-sm">
				<div class="tab-final">
					<table id="tableaca" class="table" style=" font-size: 100%;">
						<tr style="background-color: #363a41; color: white;">
							<td width="25%">Producto</td>
							<td width="25%">Descripción</td>
							<td width="15%">**Observación</td>
							<td width="10%">U.E</td>
							<td width="10%">precio U.E</td>
							<td width="10%">Cantidad</td>
							<td width="20%">Total</td>
						</tr>
					
					</table>
				</div>
			</div>
		</div>
		<div style="clear: both;">&nbsp;</div>
	</div>
	<input type="hidden" id="accion_form" name="action" value="<?php echo ($_POST['resp'] == 6) ? "update" : "add"; ?>">
	<div class="row" id="error1"></div>





