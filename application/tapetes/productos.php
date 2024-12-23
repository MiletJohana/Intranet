	<div class="row">
		<div class="col-md-12 col-sm-12 pt-3" align="center">
			<h3 align="center">Datos Productos</h3>
			<hr class="mx-auto" style="width:60%;">
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-sm-12 pt-3">
			<input type="text" name="nom_pro" id="nom_pro" class="form-control" placeholder="Nombre Producto" onkeyup="autoProd(1);" <?php if (!isset($_POST['edit'])) {
																																			echo 'readonly';
																																		} ?>>
		</div>
		<div class="col-md-3 col-sm-12 pt-3">
			<input type="text" name="cod_ref" id="cod_ref" class="form-control" placeholder="Codigo del producto" disabled>
			<input type="hidden" name="cod_pro" id="cod_pro">
		</div>
		<div class="col-md-3 col-sm-12 pt-3">
			<input type="text" name="und_emp" id="und_emp" class="form-control" placeholder="Unidad de medida" disabled>
			<input type="hidden" name="can_emp" id="can_emp">
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-sm-12 pt-3">
			<input type="number" name="can_com" id="can_com" class="form-control" placeholder="cantidad a comprar">
		</div>
		<div class="col-md-3 col-sm-12 pt-3">
			<input type="number" name="pre_pro" id="pre_pro" class="form-control" placeholder="Precio">
		</div>
		<div class="col-md-6 col-sm-12 pt-3">
			<textarea name="des_pro" id="des_pro" class="form-control" placeholder="Descripción"></textarea>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12 pt-3">
			<textarea name="obs_cot" id="obs_cot" class="form-control" placeholder="Observación (Opcional)"></textarea>
		</div>
	</div>
	<div class=" row">
		<div class="col-md-12 col-sm-12 pt-3">
			<button type="button" class="btn btn-success" onclick="agregarProd();" id="agrega"><i class="fa-solid fa-check"></i> Agregar</button>
			<button type="button" class="btn btn-primary" onclick="editarProd();" id="edita" style="visibility: hidden;"><i class="fa-solid fa-pen-to-square"></i> Editar</button>
			<button type="button" class="btn btn-danger" onclick="eliminarProd();" id="elimina" style="visibility: hidden;"><i class="fa-solid fa-eraser"></i> Eliminar</button>
			<button type="button" class="btn btn-warning" onclick="cancelarEditar();" id="cancela" style="visibility: hidden;"><i class="fa-solid fa-ban"></i> Cancelar</button>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12 pt-3">
			<h3 align="center">Productos</h3>
			<hr class="mx-auto" style="width:60%;">
		</div>
	</div>
	<div class=" row">
		<div class="col-md-12  col-sm-12 pt-3">
			<label width="60%" class="btn btn-red" style="background-color:#363a41" align="right"><input type="checkbox" name="cot_iva" id="cot_iva" value="1" checked> Cotización con Iva</label>
		</div>
	</div><br>
	<div class="row" style="min-height: 250px;">
		<div class="col-12">
			<div class="table-responsive-sm">
				<div class="tab-final">
					<table id="table" class="table" style=" font-size: 100%;">
						<tr style="background-color: #363a41; color: white;">
							<td width="25%">Producto</td>
							<td width="25%">Descripción</td>
							<td width="15%">**Observación</td>
							<td width="10%">U.E</td>
							<td width="10%">precio U.E</td>
							<td width="10%">Cantidad</td>
							<td width="20%">Total</td>
						</tr>
						<?php
						if (isset($_POST['edit']) && ($_POST['resp'] == 6 || $_POST['resp'] == 11)) {
							$sql3 = "SELECT * FROM `cot_pro_x_cot` pxc,`cot_cotizaciones` cot,`cot_productos` pro
												WHERE pxc.id_coti=cot.id_coti
												AND pxc.cod_pro=pro.cod_pro
												AND cot.id_coti=" . $_POST['edit'];
							$query3 = $conexion->query($sql3);
							while ($r = $query3->fetch(PDO::FETCH_ASSOC)) { ?>
								<tr id="<?php echo $r['cod_pro']; ?>">
									<td><?php echo $r['nom_pro']; ?></td>
									<td><?php echo $r['des_pro_cot']; ?></td>
									<td><?php echo $r['obs_prod']; ?></td>
									<td><?php echo $r['und_emp'] . ' ' . $r['can_emp']; ?></td>
									<td><?php echo $r['pre_cot']; ?></td>
									<td><?php echo $r['can_com']; ?></td>
									<td><?php echo $r['can_com'] * $r['pre_cot']; ?></td>
								</tr>
						<?php }
						} ?>
					</table>
				</div>
			</div>
		</div>
		<div style="clear: both;">&nbsp;</div>
	</div>