<?php
include '../../conexion.php';
include "../../resources/template/credentials.php";
if (isset($_POST['edit']) && $_POST['edit'] != '' && ($_POST['resp'] == 6 || $_POST['resp'] == 11)) {
	$sql1 = "SELECT * FROM cot_cotizaciones cot,cot_tip_cotizacion tip,mq_clie cli,cot_contactos con
        WHERE cot.id_tip_cot=tip.id_tip_cot
        AND cot.id_cli=cli.id_cli
        AND cot.id_cont=con.id_cont
        AND id_coti=" . $_POST['edit'];
	$query = $conexion->query($sql1);
	$person = null;
	if ($query->rowCount() > 0) {
		while ($r = $query->fetch(PDO::FETCH_OBJ)) {
			$person = $r;
			break;
		}
	}
	$sql2 = "SELECT * FROM cot_tip_cotizacion 
         WHERE id_tip_cot != $person->id_tip_cot 
         AND id_tip_cot 
         IN (3,5,6)";
	$query2 = $conexion->query($sql2);
	$sql3 = "SELECT * FROM `cot_pro_x_cot` pxc,`cot_cotizaciones` cot,`cot_productos` pro
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
				while ($r4 = $query4->fetch(PDO::FETCH_OBJ)) {
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
				while ($r5 = $query5->fetch(PDO::FETCH_OBJ)) {
					$personCotSac = $r5;
					break;
				}
			}
		}
		
	}

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
		<div class="col-md-4 col-sm-12 pt-3">
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
					$rCiu2 = $queryCiu2->fetch(PDO::FETCH_ASSOC);
				?>
					<option value="<?php echo $rCiu2['id_ciu']; ?>"><?php echo $rCiu2['nom_ciu']; ?></option>
				<?php $sqlCiu = "SELECT * FROM cot_ciudad WHERE id_ciu != $person->id_ciu GROUP BY nom_ciu ORDER BY nom_ciu ASC";
					$queryCiu = $conexion->query($sqlCiu);
				}
				while ($rCiu = $queryCiu->fetch(PDO::FETCH_ASSOC)) { ?>
					<option value="<?php echo $rCiu['id_ciu']; ?>"><?php echo $rCiu['nom_ciu']; ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-md-4 col-sm-12">
			<label class="btn btn-red">
				<input type="checkbox" name="rem_ciu" id="rem_ciu" value="1" onclick="<?php if (isset($_POST['edit']) && ($_POST['resp'] == 6 || $_POST['resp'] == 11) && $person->rem_ciu != '') {
																							echo 'remCiu2(1)';
																						} else {
																							echo 'remCiu(2)';
																						} ?>" <?php if (isset($_POST['edit']) && ($_POST['resp'] == 6 || $_POST['resp'] == 11) && $person->rem_ciu != '') {
																									echo 'checked';
																								} ?>>
				Ciudad a Remitir:
			</label>
		</div>
		<div class="col-md-4 col-sm-12" id="remCiu1">
			<?php if (isset($_POST['edit']) && ($_POST['resp'] == 6 || $_POST['resp'] == 11) && $person->rem_ciu != '') {
				$sqlRemCiu = "SELECT * FROM cot_ciudad WHERE id_ciu != '" . $person->rem_ciu . "' GROUP BY nom_ciu ORDER BY nom_ciu ASC";
				$queryRemCiu = $conexion->query($sqlRemCiu);
				$sqlRemCiu1 = "SELECT * FROM cot_ciudad WHERE id_ciu = '" . $person->rem_ciu . "' GROUP BY id_ciu";
				$queryRemCiu1 = $conexion->query($sqlRemCiu1);
				$rRemCiu1 = $queryRemCiu1->fetch(PDO::FETCH_ASSOC);
			?>
				<select class="form-control" id="remCiu" name="remCiu" style="height: 35px;" required>
					<option value='<?php $rRemCiu1['id_ciu'] ?>'><?php $rRemCiu1['nom_ciu'] ?></option>
					<?php while ($rRemCiu = $queryRemCiu->fetch(PDO::FETCH_ASSOC)) { ?>
						<option value='<?php $rRemCiu['id_ciu'] ?>'><?php $rRemCiu['nom_ciu'] ?></option>
					<?php } ?>
				</select>
			<?php } ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-sm-12 pt-3">
			<input type="text" id="nom_cli" name="nom_cli" class="form-control" placeholder="Nombre del cliente" onkeyup="auto(1)" value="<?php if (isset($_POST['edit']) && ($_POST['resp'] == 6 || $_POST['resp'] == 11)) {
																																				echo $person->nom_cli;
																																			} ?>" required>
			<input type="hidden" id="id_cli" name="id_cli" value="<?php if (isset($_POST['edit']) && ($_POST['resp'] == 6 || $_POST['resp'] == 11)) {
																		echo $person->id_cli;
																	} ?>">
			<input type="hidden" class="form-control" id="id_coti" name="id_coti" value="<?php if (isset($_POST['edit']) && ($_POST['resp'] == 6 || $_POST['resp'] == 11) && ($_POST['resp'] == 6 || $_POST['resp'] == 11)) {
																								echo $person->id_coti;
																							} ?>">
		</div>
		<div class="col-md-6 col-sm-12 pt-3">
			<select class="form-select" id="id_cont" name="id_cont" style="height:34px;" required>
				<?php if (!isset($_POST['edit'])) { ?>
					<option value="">Seleccione contacto</option>
				<?php } elseif (isset($_POST['edit']) && $_POST['resp'] != 6 && $_POST['resp'] != 11) { ?>
					<option value="">Seleccione contacto</option>
				<?php } else { ?>
					<option value="<?php echo $person->id_cont; ?>">
						<?php echo $person->nom_cont; ?>
					</option>
				<?php
					$sqlCont = "SELECT `id_cont`, `nom_cont` 
							FROM `cot_contactos` WHERE id_cli=$person->id_cli and id_cont!=$person->id_cont";
					$queryCont = $conexion->query($sqlCont);
					$rCount = $queryCont->rowCount();
					if ($rCount > 0) {
						while ($rCont = $queryCont->fetch(PDO::FETCH_ASSOC)) {
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
		<div class="col-md-3 col-sm-12 pt-3">
			<input type="text" id="dia_ent" name="dia_ent" class="form-control" placeholder="Días de Entrega" value="<?php if (isset($_POST['edit']) && ($_POST['resp'] == 6 || $_POST['resp'] == 11)) {
																															echo $person->dia_ent;
																														} ?>" required>
		</div>
		<div class="col-md-3 col-sm-12 pt-3">
			<input type="text" id="for_pag" name="for_pag" class="form-control" placeholder="Forma de pago" value="<?php if (isset($_POST['edit']) && ($_POST['resp'] == 6 || $_POST['resp'] == 11)) {
																														echo $person->for_pag;
																													} ?>" required>
		</div>
		<div class="col-md-3 col-sm-12 pt-3">
			<select class="form-select" id="tip_cot" name="tip_cot" style="height:34px;"  onchange="appear(this.value);"  required>
				<?php if (!isset($_POST['edit'])) { ?>
					<option value="">Tipo de cotización</option>
				<?php
					$sqlTipCot = "SELECT * FROM cot_tip_cotizacion WHERE id_tip_cot NOT IN(6,9,3)";
					$queryTipCot = $conexion->query($sqlTipCot);
				} elseif (isset($_POST['edit']) && $_POST['resp'] != 6 && $_POST['resp'] != 11) { ?>
					<option value="">Tipo de cotización</option>
				<?php
					$sqlTipCot = "SELECT * FROM cot_tip_cotizacion WHERE id_tip_cot NOT IN(6,9,3)";
					$queryTipCot = $conexion->query($sqlTipCot);
				} else {
					$sqlTipCot2 = "SELECT * FROM cot_tip_cotizacion WHERE id_tip_cot =$person->id_tip_cot";
					$queryTipCot2 = $conexion->query($sqlTipCot2);
					$rTipCot2 = $queryTipCot2->fetch(PDO::FETCH_ASSOC);
				?>
					<option value="<?php echo $rTipCot2['id_tip_cot']; ?>"><?php echo $rTipCot2['nom_tip_cot']; ?></option>
				<?php
					$sqlTipCot = "SELECT * FROM cot_tip_cotizacion WHERE id_tip_cot NOT IN($person->id_tip_cot,6,9,3)";
					$queryTipCot = $conexion->query($sqlTipCot);
				}
				while ($rTipCot = $queryTipCot->fetch(PDO::FETCH_ASSOC)) { ?>
					<option value="<?php echo $rTipCot['id_tip_cot']; ?>"><?php echo $rTipCot['nom_tip_cot']; ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-md-3 col-sm-12 pt-3">
			<input type="text" id="val_cot" name="val_cot" class="form-control" value="<?php if (isset($_POST['edit']) && ($_POST['resp'] == 6 || $_POST['resp'] == 11)) {
																							echo $person->val_cot;
																						} else {
																							echo 'Sujeto contra alza de precio de nuestros proveedores';
																						} ?>" placeholder="Validez de la oferta" required>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-sm-12 pt-3">
			<?php
			if (!isset($_POST['edit'])) {
				$sqlAseCom = "SELECT * FROM mq_usu WHERE id_car IN (1,4,5,6,7,8,9,10,11,12,13,14,16,17,18,19,20) GROUP BY nom_usu ORDER BY nom_usu ASC";
				$queryAseCom = $conexion->query($sqlAseCom);
				$sqlRepSac = "SELECT * FROM mq_usu WHERE id_car IN (3,14) GROUP BY nom_usu ORDER BY nom_usu ASC";
				$queryRepSac = $conexion->query($sqlRepSac);
			} elseif (isset($_POST['edit']) && $_POST['resp'] != 6 && $_POST['resp'] != 11) {
				$sqlAseCom = "SELECT * FROM mq_usu WHERE id_car IN (1,4,5,6,7,8,9,10,11,12,13,14,16,17,18,19,20) GROUP BY nom_usu ORDER BY nom_usu ASC";
				$queryAseCom = $conexion->query($sqlAseCom);
				$sqlRepSac = "SELECT * FROM mq_usu WHERE id_car IN (3,14) GROUP BY nom_usu ORDER BY nom_usu ASC";
				$queryRepSac = $conexion->query($sqlRepSac);
			} else {
				//Asesor
				if ($person->ced_ase != '') {
					$sqlAseCom = "SELECT * FROM mq_usu WHERE id_car IN (1,4,5,6,7,8,9,10,11,12,13,14,16,17,18,19,20) AND id_usu != $person->ced_ase AND id_are != 10 ORDER BY nom_usu ASC";
					$queryAseCom = $conexion->query($sqlAseCom);
					$sqlAseCom2 = "SELECT * FROM mq_usu WHERE id_usu = $person->ced_ase ORDER BY nom_usu";
					$queryAseCom2 = $conexion->query($sqlAseCom2);
					$rAseCom2 = $queryAseCom2->fetch(PDO::FETCH_ASSOC);
				} else {
					$sqlAseCom = "SELECT * FROM mq_usu WHERE id_car IN (1,4,5,6,7,8,9,10,11,12,13,14,16,17,18,19,20) AND id_are != 10 ORDER BY nom_usu ASC";
					$queryAseCom = $conexion->query($sqlAseCom);
				}
				// Representante
				if ($person->ced_sac != '') {
					$sqlRepSac2 = "SELECT * FROM mq_usu WHERE id_car IN (3,14) AND id_usu=$person->ced_sac AND id_are != 10 ORDER BY nom_usu ASC";
					$queryRepSac2 = $conexion->query($sqlRepSac2);
					$rRepSac2 = $queryRepSac2->fetch(PDO::FETCH_ASSOC);
					$sqlRepSac = "SELECT * FROM mq_usu WHERE id_car IN (3,14) AND id_usu!=$person->ced_sac AND id_are != 10 ORDER BY nom_usu ASC";
					$queryRepSac = $conexion->query($sqlRepSac);
				} else {
					$sqlRepSac = "SELECT * FROM mq_usu WHERE id_car IN (3,14) AND id_are != 10 ORDER BY nom_usu ASC";
					$queryRepSac = $conexion->query($sqlRepSac);
				}
			}
			?>
			<select class="form-select" id="ced_ase">
				<?php if (isset($_POST['edit']) && ($_POST['resp'] == 6 || $_POST['resp'] == 11) && $person->ced_ase != '') { ?>
					<option value="<?php echo $rAseCom2['id_usu']; ?>"><?php echo $rAseCom2['nom_usu']; ?></option>
				<?php } ?>
				<option value="">Seleccione el Asesor Comercial</option>
				<?php while ($rAseCom = $queryAseCom->fetch(PDO::FETCH_ASSOC)) { ?>
					<option value="<?php echo $rAseCom['id_usu']; ?>"><?php echo $rAseCom['nom_usu']; ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-md-6 col-sm-12 pt-3">
			<select class="form-select" id="ced_sac" style="height: 35px">
				<?php if (isset($_POST['edit']) && ($_POST['resp'] == 6 || $_POST['resp'] == 11) && $person->ced_sac != '') { ?>
					<option value="<?php echo $rRepSac2['id_usu']; ?>"><?php echo $rRepSac2['nom_usu']; ?></option>
				<?php } ?>
				<option value="">Seleccione el Representante Serv. Cliente</option>
				<?php while ($rRepSac = $queryRepSac->fetch(PDO::FETCH_ASSOC)) { ?>
					<option value="<?php echo $rRepSac['id_usu']; ?>"><?php echo $rRepSac['nom_usu']; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-sm-12 pt-3">
			<select class="form-select" id="pag_mypro" name="pag_mypro" style="height:34px;" required>
				<?php if (!isset($_POST['edit'])) { ?>
					<option value="">Tipo de pago en myProcess</option>
				<?php
					$sqlTipag = "SELECT * FROM cot_form_pag_mypro ";
					$queryTipag = $conexion->query($sqlTipag);
				} elseif (isset($_POST['edit']) && $_POST['resp'] != 6 && $_POST['resp'] != 11) { ?>
					<option value="">Tipo de cotización</option>
				<?php
					$sqlTipag = "SELECT * FROM cot_form_pag_mypro";
					$queryTipag = $conexion->query($sqlTipag);
				} else {
					/* arreglar la cosulta de person en la tarde  despues de las 5
					$sqlTipCot2 = "SELECT * FROM cot_tip_cotizacion WHERE id_tip_cot =$person->id_tip_cot";
					$queryTipCot2 = $conexion->query($sqlTipCot2);
					$rTipCot2 = $queryTipCot2->fetch(PDO::FETCH_ASSOC);
					<option value="<?php echo $rTipCot2['id_tip_cot']; ?>"><?php echo $rTipCot2['nom_tip_cot']; ?></option>
					despues del cerrar php 
					*/
				?>
					
				<?php
					$sqlTipag = "SELECT * FROM cot_form_pag_mypro ";
					$queryTipag = $conexion->query($sqlTipag);
				}
				while ($rTipag = $queryTipag->fetch(PDO::FETCH_ASSOC)) { ?>
					<option value="<?php echo $rTipag['id_pag']; ?>"><?php echo $rTipag['nom_pag']; ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-md-6 col-sm-12 pt-3">
			<select class="form-select" id="tip_pedido" name="tip_pedido" style="height:34px;" required>
				<?php if (!isset($_POST['edit'])) { ?>
					<option value="">Tipo de pedido en myProcess</option>
				<?php
					$sqlTipedi = "SELECT * FROM cot_tip_pedido ";
					$queryTipedi= $conexion->query($sqlTipedi);
				} elseif (isset($_POST['edit']) && $_POST['resp'] != 6 && $_POST['resp'] != 11) { ?>
					<option value="">Tipo de pedido en myProcess</option>
				<?php
					$sqlTipedi = "SELECT * FROM cot_tip_pedido";
					$queryTipedi = $conexion->query($sqlTipedi);
				} else {
					/* arreglar la cosulta de person en la tarde  despues de las 5
					$sqlTipCot2 = "SELECT * FROM cot_tip_cotizacion WHERE id_tip_cot =$person->id_tip_cot";
					$queryTipCot2 = $conexion->query($sqlTipCot2);
					$rTipCot2 = $queryTipCot2->fetch(PDO::FETCH_ASSOC);
					<option value="<?php echo $rTipCot2['id_tip_cot']; ?>"><?php echo $rTipCot2['nom_tip_cot']; ?></option>
					despues del cerrar php 
					*/
				?>
					
				<?php
					$sqlTipedi = "SELECT * FROM cot_form_pag_mypro ";
					$queryTipedi = $conexion->query($sqlTipedi);
				}
				while ($rTiped = $queryTipedi->fetch(PDO::FETCH_ASSOC)) { ?>
					<option value="<?php echo $rTiped['id_tip_pedi']; ?>"><?php echo $rTiped['nom_tip_pedi']; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<br>
	<div  id="tapetes">
	</div>
	<?php if(isset($_POST['resp']) && ($_POST['resp']==2 || $_POST['resp']==4 || $_POST['resp']==7 || $_POST['resp']==8 ||$_POST['resp']==10) ){
			include 'productos.php';
	}else{
			include 'tapetes';
	}
	?>
	<input type="hidden" id="accion_form" name="action" value="<?php echo ($_POST['resp'] == 6) ? "update" : "add"; ?>">
	<div class="row" id="error1"></div>
</form>
<script type="text/javascript" src="../js/prod.js"></script>