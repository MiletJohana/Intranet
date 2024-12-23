<?php
include '../../conexion.php';
include "../../resources/template/credentials.php";
if (isset($_POST['edit']) && $_POST['edit'] != '' && ($_POST['resp'] == 6 || $_POST['resp'] == 11)) {
	$sql1 = "SELECT * FROM cot_cotizaciones AS cot, cot_tip_cotizacion AS tip, mq_clientes AS cli, contactos AS con
        WHERE cot.id_tip_cot=tip.id_tip_cot
        AND cot.id_cli=cli.id_cli
        AND cot.id_cont=con.id_cont
        AND id_coti=" . $_POST['edit'];
	$query = $conexion->query($sql1);
	$person = null;
	if ($query->rowCount() > 0) {
		while ($r = $query-> fetch(PDO::FETCH_ASSOC)) {
			$person = $r;
			break;
		}
	}
	$sql2 = "SELECT * FROM cot_tip_cotizacion 
         WHERE id_tip_cot != $person->id_tip_cot 
         AND id_tip_cot 
         IN (3,5,6)";
	$query2 = $conexion->query($sql2);
	$sql3 = "SELECT * FROM cot_pro_x_cot AS pxc, cot_cotizaciones AS cot, cot_productos AS pro
        WHERE pxc.id_coti=cot.id_coti
        AND   pxc.cod_pro=pro.cod_pro
        AND   cot.id_coti=" . $_POST['edit'];
	$query3 = $conexion->query($sql3);
	$coti = null;
	$ced_ase = $person->ced_ase;
	if ($query3->rowCount() > 0) {
		if ($ced_ase != "" || $ced_ase != null) {
			$sql4 = "SELECT * FROM mq_usu where id_usu = $ced_ase";
			$query4 = $conexion->query($sql4);
			$personCot = null;
			if ($query4->rowCount() > 0) {
				while ($r4 = $query4-> fetch(PDO::FETCH_ASSOC)) {
					$personCot = $r4;
					break;
				}
			}
		}
		if ($person->ced_sac != null) {
			$ced_sac = $person->ced_sac;
			$sql5 = "SELECT * FROM mq_usu where id_usu = $ced_sac";
			$query5 = $conexion->query($sql5);
			$personCotSac = null;
			if ($query5->rowCount() > 0) {
				while ($r5 = $query5-> fetch(PDO::FETCH_ASSOC)) {
					$personCotSac = $r5;
					break;
				}
			}
		}
	}
}
if ($_POST['resp'] == 18) {
	$id = $_POST['id_usu'];
	$sqlCli = "SELECT * FROM mq_clientes AS cli
    LEFT JOIN ciudades AS ciu
    ON cli.id_ciu = ciu.id_ciu
    WHERE cli.id_cli = $id
    GROUP BY cli.id_cli";
	$queryCli = $conexion->query($sqlCli);
	$rCli = $queryCli-> fetch(PDO::FETCH_ASSOC);

	$sqlCon = "SELECT * FROM contactos
	WHERE id_cli = $id";
	$queryCon = $conexion->query($sqlCon);
}
?>
<form role="form" id="form-cotizaciones">
	<div class="row text-center">
		<?php if (isset($_POST['resp']) && $_POST['resp'] == 11) { ?>
			<div class="col-12">
				<h3>Duplicar Cotización</h3>
				<hr class="mx-auto" style="width:60%;">
			</div>
		<?php } else { ?>
			<div class="col-12">
				<h3>Datos Cotización</h3>
				<hr class="mx-auto" style="width:60%;">
			</div>
		<?php } ?>
	</div>
	<div class="row">
		<div class="col-md-4 col-sm-12 mb-3">
			<select class="form-select" id="id_ciu" name="id_ciu" style="height: 35px;" required>
				<?php if (!isset($_POST['edit'])) {
					$sqlCiu = "SELECT * FROM cot_ciudad GROUP BY nom_ciu ORDER BY nom_ciu ASC";
					$queryCiu = $conexion->query($sqlCiu);
				?>
					<option value="">Seleccione Ciudad</option>
				<?php } elseif (isset($_POST['edit']) && $_POST['resp'] != 6 && $_POST['resp'] != 11) {
					$sqlCiu = "SELECT * FROM cot_ciudad GROUP BY nom_ciu ORDER BY nom_ciu ASC";
					$queryCiu = $conexion->query($sqlCiu);
				?>
					<option value="">Seleccione Ciudad</option>
				<?php } elseif (isset($_POST['edit']) && $_POST['edit'] != '' && ($_POST['resp'] == 6 || $_POST['resp'] == 11)) {
					$sqlCiu2 = "SELECT * FROM cot_ciudad WHERE id_ciu = $person->id_ciu GROUP BY nom_ciu ORDER BY nom_ciu ASC";
					$queryCiu2 = $conexion->query($sqlCiu2);
					$rCiu2 = $queryCiu2-> fetch(PDO::FETCH_ASSOC);
				?>
					<option value="<?php echo $rCiu2['id_ciu']; ?>"><?php echo $rCiu2['nom_ciu']; ?></option>
				<?php $sqlCiu = "SELECT * FROM cot_ciudad WHERE id_ciu != $person->id_ciu GROUP BY nom_ciu ORDER BY nom_ciu ASC";
					$queryCiu = $conexion->query($sqlCiu);
				}
				while ($rCiu = $queryCiu-> fetch(PDO::FETCH_ASSOC)) { ?>
					<option value="<?php echo $rCiu['id_ciu']; ?>"><?php echo $rCiu['nom_ciu']; ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-md-4 col-sm-12 mb-3">
			<label class="btn btn-red">
				<input type="checkbox" class="me-2" name="rem_ciu" id="rem_ciu" value="1" onclick="<?php if (isset($_POST['edit']) && ($_POST['resp'] == 6 || $_POST['resp'] == 11) && $person->rem_ciu != '') {
																							echo 'remCiu2(1)';
																						} else {
																							echo 'remCiu(2)';
																						} ?>" <?php if (isset($_POST['edit']) && ($_POST['resp'] == 6 || $_POST['resp'] == 11) && $person->rem_ciu != '') {
																									echo 'checked';
																								} ?>>
				Ciudad a Remitir:
			</label>
		</div>
		<div class="col-md-4 col-sm-12 mb-3" id="remCiu1">
			<?php if (isset($_POST['edit']) && ($_POST['resp'] == 6 || $_POST['resp'] == 11) && $person->rem_ciu != '') {
				$sqlRemCiu = "SELECT * FROM cot_ciudad WHERE id_ciu != '" . $person->rem_ciu . "' GROUP BY nom_ciu ORDER BY nom_ciu ASC";
				$queryRemCiu = $conexion->query($sqlRemCiu);
				$sqlRemCiu1 = "SELECT * FROM cot_ciudad WHERE id_ciu = '" . $person->rem_ciu . "' GROUP BY id_ciu";
				$queryRemCiu1 = $conexion->query($sqlRemCiu1);
				$rRemCiu1 = $queryRemCiu1-> fetch(PDO::FETCH_ASSOC);
			?>
				<select class="form-select" id="remCiu" name="remCiu" style="height: 35px;" required>
					<option value='<?php $rRemCiu1['id_ciu'] ?>'><?php $rRemCiu1['nom_ciu'] ?></option>
					<?php while ($rRemCiu = $queryRemCiu-> fetch(PDO::FETCH_ASSOC)) { ?>
						<option value='<?php $rRemCiu['id_ciu'] ?>'><?php $rRemCiu['nom_ciu'] ?></option>
					<?php } ?>
				</select>
			<?php } ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-sm-12 mb-3">
			<input type="text" id="nom_cli" name="nom_cli" class="form-control" placeholder="Nombre del cliente" onkeyup="auto(1)" value="<?php if (isset($_POST['edit']) && ($_POST['resp'] == 6 || $_POST['resp'] == 11)) {
																																				echo $person->nom_cli;
																																			} else if ($_POST['resp'] == 18) {
																																				echo $rCli['nom_cli'];
																																			} ?>" required>
			<input type="hidden" id="id_cli" name="id_cli" value="<?php if (isset($_POST['edit']) && ($_POST['resp'] == 6 || $_POST['resp'] == 11)) {
																		echo $person->id_cli;
																	} else if ($_POST['resp'] == 18) {
																		echo $rCli['id_cli'];
																	} ?>">
			<input type="hidden" class="form-control" id="id_coti" name="id_coti" value="<?php if (isset($_POST['edit']) && ($_POST['resp'] == 6 || $_POST['resp'] == 11) && ($_POST['resp'] == 6 || $_POST['resp'] == 11)) {
																								echo $person->id_coti;
																							} ?>">
		</div>
		<div class="col-md-6 col-sm-12 mb-3">
			<select class="form-select" id="id_cont" name="id_cont" required>
				<?php if (!isset($_POST['edit'])) { ?>
					<option value="">Seleccione contacto</option>
					<?php if ($_POST['resp'] == 18) { ?>
						<?php while ($rCon = $queryCon-> fetch(PDO::FETCH_ASSOC)) { ?>
							<option value="<?php echo $rCon['id_cont']; ?>"><?php echo $rCon["nom_cont"]; ?></option>
						<?php } ?>
					<?php } ?>
				<?php } else if (isset($_POST['edit']) && $_POST['resp'] != 6 && $_POST['resp'] != 11) { ?>
					<option value="">Seleccione contacto</option>
				<?php } else if ($_POST['resp'] == 18) { ?>
					<?php while ($rCon = $queryCon-> fetch(PDO::FETCH_ASSOC)) { ?>
						<option value="<?php echo $rCon['id_cont']; ?>"><?php echo $rCon["nom_cont"]; ?></option>
					<?php } ?>
				<?php } else { ?>
					<option value="<?php echo $person->id_cont; ?>">
						<?php echo $person->nom_cont; ?>
					</option>
				<?php
					$sqlCont = "SELECT id_cont, nom_cont 
							FROM contactos WHERE id_cli = $person->id_cli AND id_cont != $person->id_cont";
					$queryCont = $conexion->query($sqlCont);
					$rCount = $queryCont->rowCount();
					if ($rCount > 0) {
						while ($rCont = $queryCont-> fetch(PDO::FETCH_ASSOC)) {
							echo '<option value="' . $rCont['id_cont'] . '">' . $rCont["nom_cont"] . '</option>';
						}
					} else {
						echo '<option value="">No hay contactos</option>';
					}
				}
				?>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-sm-12 mb-3">
			<input type="text" id="dia_ent" name="dia_ent" class="form-control" placeholder="Días de Entrega" value="<?php if (isset($_POST['edit']) && ($_POST['resp'] == 6 || $_POST['resp'] == 11)) {
																															echo $person->dia_ent;
																														} ?>" required>
		</div>
		<div class="col-md-3 col-sm-12 mb-3">
			<input type="text" id="for_pag" name="for_pag" class="form-control" placeholder="Forma de pago" value="<?php if (isset($_POST['edit']) && ($_POST['resp'] == 6 || $_POST['resp'] == 11)) {
																														echo $person->for_pag;
																													} ?>" required>
		</div>
		<div class="col-md-3 col-sm-12 mb-3">
			<select class="form-select" id="tip_cot" name="tip_cot" required>
				<?php if (!isset($_POST['edit'])) { ?>
					<option value="">Tipo de cotización</option>
				<?php
					$sqlTipCot = "SELECT * FROM cot_tip_cotizacion WHERE id_tip_cot NOT IN(6,5,9,3)";
					$queryTipCot = $conexion->query($sqlTipCot);
				} elseif (isset($_POST['edit']) && $_POST['resp'] != 6 && $_POST['resp'] != 11) { ?>
					<option value="">Tipo de cotización</option>
				<?php
					$sqlTipCot = "SELECT * FROM cot_tip_cotizacion WHERE id_tip_cot NOT IN(6,5,9,3)";
					$queryTipCot = $conexion->query($sqlTipCot);
				} else {
					$sqlTipCot2 = "SELECT * FROM cot_tip_cotizacion WHERE id_tip_cot =$person->id_tip_cot";
					$queryTipCot2 = $conexion->query($sqlTipCot2);
					$rTipCot2 = $queryTipCot2-> fetch(PDO::FETCH_ASSOC);
				?>
					<option value="<?php echo $rTipCot2['id_tip_cot']; ?>"><?php echo $rTipCot2['nom_tip_cot']; ?></option>
				<?php
					$sqlTipCot = "SELECT * FROM cot_tip_cotizacion WHERE id_tip_cot NOT IN($person->id_tip_cot,6,5,9,3)";
					$queryTipCot = $conexion->query($sqlTipCot);
				}
				while ($rTipCot = $queryTipCot-> fetch(PDO::FETCH_ASSOC)) { ?>
					<option value="<?php echo $rTipCot['id_tip_cot']; ?>"><?php echo $rTipCot['nom_tip_cot']; ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-md-3 col-sm-12 mb-3">
			<input type="text" id="val_cot" name="val_cot" class="form-control" value="<?php if (isset($_POST['edit']) && ($_POST['resp'] == 6 || $_POST['resp'] == 11)) {
																							echo $person->val_cot;
																						} else {
																							echo 'Sujeto contra alza de precio de nuestros proveedores';
																						} ?>" placeholder="Validez de la oferta" required>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-sm-12 mb-3">
			<?php
			if (!isset($_POST['edit'])) {
				$sqlAseCom = "SELECT * FROM mq_usu WHERE id_car IN (1,4,5,6,7,8,9,10,11,12,13,14,16,17,18,19,20) AND usu_elim = 0 GROUP BY nom_usu ORDER BY nom_usu ASC";
				$queryAseCom = $conexion->query($sqlAseCom);
				$sqlRepSac = "SELECT * FROM mq_usu WHERE id_car IN (3,14) GROUP BY nom_usu ORDER BY nom_usu ASC";
				$queryRepSac = $conexion->query($sqlRepSac);
			} elseif (isset($_POST['edit']) && $_POST['resp'] != 6 && $_POST['resp'] != 11) {
				$sqlAseCom = "SELECT * FROM mq_usu WHERE id_car IN (1,4,5,6,7,8,9,10,11,12,13,14,16,17,18,19,20)  AND usu_elim = 0 GROUP BY nom_usu ORDER BY nom_usu ASC";
				$queryAseCom = $conexion->query($sqlAseCom);
				$sqlRepSac = "SELECT * FROM mq_usu WHERE id_car IN (3,14) GROUP BY nom_usu ORDER BY nom_usu ASC";
				$queryRepSac = $conexion->query($sqlRepSac);
			} else {
				//Asesor
				if ($person->ced_ase != '') {
					$sqlAseCom = "SELECT * FROM mq_usu WHERE id_car IN (1,4,5,6,7,8,9,10,11,12,13,14,16,17,18,19,20) AND id_usu != $person->ced_ase AND id_are != 10 AND usu_elim = 0 ORDER BY nom_usu ASC";
					$queryAseCom = $conexion->query($sqlAseCom);
					$sqlAseCom2 = "SELECT * FROM mq_usu WHERE id_usu = $person->ced_ase ORDER BY nom_usu";
					$queryAseCom2 = $conexion->query($sqlAseCom2);
					$rAseCom2 = $queryAseCom2-> fetch(PDO::FETCH_ASSOC);
				} else {
					$sqlAseCom = "SELECT * FROM mq_usu WHERE id_car IN (1,4,5,6,7,8,9,10,11,12,13,14,16,17,18,19,20) AND id_are != 10  AND usu_elim = 0 ORDER BY nom_usu ASC";
					$queryAseCom = $conexion->query($sqlAseCom);
				}
				// Representante
				if ($person->ced_sac != '') {
					$sqlRepSac2 = "SELECT * FROM mq_usu WHERE id_car IN (3,14) AND id_usu=$person->ced_sac AND id_are != 10  AND usu_elim = 0 ORDER BY nom_usu ASC";
					$queryRepSac2 = $conexion->query($sqlRepSac2);
					$rRepSac2 = $queryRepSac2-> fetch(PDO::FETCH_ASSOC);
					$sqlRepSac = "SELECT * FROM mq_usu WHERE id_car IN (3,14) AND id_usu!=$person->ced_sac AND id_are != 10  AND usu_elim = 0 ORDER BY nom_usu ASC";
					$queryRepSac = $conexion->query($sqlRepSac);
				} else {
					$sqlRepSac = "SELECT * FROM mq_usu WHERE id_car IN (3,14) AND id_are != 10  AND usu_elim = 0 ORDER BY nom_usu ASC";
					$queryRepSac = $conexion->query($sqlRepSac);
				}
			}
			?>
			<select class="form-select" id="ced_ase">
				<?php if (isset($_POST['edit']) && ($_POST['resp'] == 6 || $_POST['resp'] == 11) && $person->ced_ase != '') { ?>
					<option value="<?php echo $rAseCom2['id_usu']; ?>"><?php echo $rAseCom2['nom_usu']; ?></option>
				<?php } ?>
				<option value="">Seleccione el Asesor Comercial</option>
				<?php while ($rAseCom = $queryAseCom-> fetch(PDO::FETCH_ASSOC)) { ?>
					<option value="<?php echo $rAseCom['id_usu']; ?>"><?php echo $rAseCom['nom_usu']; ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-md-6 col-sm-12 mb-3">
			<select class="form-select" id="ced_sac">
				<?php if (isset($_POST['edit']) && ($_POST['resp'] == 6 || $_POST['resp'] == 11) && $person->ced_sac != '') { ?>
					<option value="<?php echo $rRepSac2['id_usu']; ?>"><?php echo $rRepSac2['nom_usu']; ?></option>
				<?php } ?>
				<option value="">Seleccione el Representante Serv. Cliente</option>
				<?php while ($rRepSac = $queryRepSac-> fetch(PDO::FETCH_ASSOC)) { ?>
					<option value="<?php echo $rRepSac['id_usu']; ?>"><?php echo $rRepSac['nom_usu']; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="row mt-5">
		<div class="col-12 col-sm-12 mt-3" align="center">
			<h3 align="center">Datos Productos</h3>
			<hr class="mx-auto" style="width:60%;">
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-sm-12 mb-3">
			<input type="text" name="nom_pro" id="nom_pro" class="form-control" placeholder="Nombre Producto" onkeyup="autoProd(1);" <?php if (isset($_POST['edit']) || $_POST['resp'] == 18) {
																																			echo '';
																																		} else {
																																			echo 'readonly';
																																		} ?>>
		</div>
		<div class="col-md-3 col-sm-12 mb-3">
			<input type="text" name="cod_ref" id="cod_ref" class="form-control" placeholder="Codigo del producto" disabled>
			<input type="hidden" name="cod_pro" id="cod_pro">
		</div>
		<div class="col-md-3 col-sm-12 mb-3">
			<input type="text" name="und_emp" id="und_emp" class="form-control" placeholder="Unidad de medida" disabled>
			<input type="hidden" name="can_emp" id="can_emp">
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-sm-12 mb-3">
			<input type="number" name="can_com" id="can_com" class="form-control" placeholder="cantidad a comprar">
		</div>
		<div class="col-md-3 col-sm-12 mb-3">
			<input type="number" name="pre_pro" id="pre_pro" class="form-control" placeholder="Precio">
		</div>
		<div class="col-md-6 col-sm-12 mb-3">
			<textarea name="des_pro" id="des_pro" class="form-control" placeholder="Descripción"></textarea>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-sm-12 mb-3">
			<textarea name="obs_cot" id="obs_cot" class="form-control" placeholder="Observación (Opcional)"></textarea>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-sm-12 mb-3">
			<button type="button" class="btn btn-success" onclick="agregarProd();" id="agrega"><i class="fa-solid fa-check me-2"></i> Agregar</button>
			<button type="button" class="btn btn-primary" onclick="editarProd();" id="edita" style="visibility: hidden;"><i class="fa-solid fa-pen-to-square me-2"></i> Editar</button>
			<button type="button" class="btn btn-danger" onclick="eliminarProd();" id="elimina" style="visibility: hidden;"><i class="fa-solid fa-eraser me-2"></i> Eliminar</button>
			<button type="button" class="btn btn-warning" onclick="cancelarEditar();" id="cancela" style="visibility: hidden;"><i class="fa-solid fa-ban me-2"></i> Cancelar</button>
		</div>
	</div>
	<div class="row mt-5">
		<div class="col-12 col-sm-12 mb-3">
			<h3 align="center">Productos</h3>
			<hr class="mx-auto" style="width:60%;">
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-sm-12 mb-3">
			<label width="60%" class="btn btn-red" style="background-color:#363a41" align="right"><input type="checkbox" class="me-2" name="cot_iva" id="cot_iva" value="1" checked> Cotización con Iva</label>
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
							<td width="15%">Observación</td>
							<td width="10%">U.E</td>
							<td width="10%">Precio U.E</td>
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
							while ($r = $query3-> fetch(PDO::FETCH_ASSOC)) { ?>
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
	<input type="hidden" id="accion_form" name="action" value="<?php echo ($_POST['resp'] == 6) ? "update" : "add"; ?>">
	<div class="row" id="error1"></div>
</form>
<script type="text/javascript" src="../js/prod.js"></script>