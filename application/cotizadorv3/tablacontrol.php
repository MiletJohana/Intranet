<?php
include '../../conexion.php';
$month = "01";
$mes2 = date("m");
if (isset($_POST['id'])) {
	$id = $_POST['id'];
	$anio = substr($_POST['mes'], 0, 4);
	$month = substr($_POST['mes'], 5, 6);
	$mes2 = substr($_POST['mes2'], 5, 6);
}
setlocale(LC_ALL, 'es_ES', 'Spanish_Spain', 'Spanish');
$StrMonth = ucwords(strftime("%b", strtotime($anio . '-' . $month)));
$StrMes2 = ucwords(strftime("%b", strtotime($anio . '-' . $mes2)));

function cotXMes($conexion, $id, $month, $anio)
{

	$sql = "SELECT count(cost_cot) as total, grup_car
		   	FROM cot_cotizaciones AS cot
			INNER JOIN mq_usu AS us
			ON cot.id_usu = us.id_usu
			INNER JOIN mq_clientes AS cli
			ON cot.id_cli = cli.id_cli
			INNER JOIN cot_tip_cotizacion AS tip
			ON cot.id_tip_cot = tip.id_tip_cot
			INNER JOIN contactos AS cont
			ON cot.id_cont = cont.id_cont
			WHERE cot.id_coti IS NOT NULL";
	if ($id == '100') {
		$sql .= " AND grup_car IN(18)";
	} elseif ($id == '200') {
		$sql .= " AND grup_car IN(19)";
	} elseif ($id == '300') {
		$sql .= " AND grup_car IN(20)";
	} else {
		$sql .= " AND cot.id_usu=$id";
	}
	$sql .= " AND MONTH(fec_coti)=$month and year(fec_coti)=$anio";
	$query = $conexion->query($sql);
	$r = $query-> fetch(PDO::FETCH_ASSOC);
	if ($r["total"] == 0) {
		return 0;
	} else {
		return $r["total"];
	}
}

function estXMes($conexion, $id, $month, $est, $anio)
{
	$sql = "SELECT count(est_cot) as total, grup_car
		  	FROM cot_cotizaciones AS cot
			INNER JOIN mq_usu AS us
			ON cot.id_usu = us.id_usu
			INNER JOIN mq_clientes AS cli
			ON cot.id_cli = cli.id_cli
			INNER JOIN cot_tip_cotizacion AS tip
			ON cot.id_tip_cot = tip.id_tip_cot
			INNER JOIN contactos AS cont
			ON cot.id_cont = cont.id_cont
			WHERE cot.id_coti IS NOT NULL";
				if ($id == '100') {
					$sql .= " AND grup_car IN(18) AND us.id_are = 7  ";
				} elseif ($id == '200') {
					$sql .= " AND grup_car IN(19)";
				} elseif ($id == '300') {
					$sql .= " AND grup_car IN(20)";
				} else {
					$sql .= " AND cot.id_usu=$id";
				}
	$sql .= " AND est_cot=$est AND MONTH(fec_coti)=$month and year(fec_coti)=$anio";

	$query = $conexion->query($sql);
	$r = $query-> fetch(PDO::FETCH_ASSOC);
	//echo $sql;
	if ($r["total"] == 0) {
		return 0;
	} else {
		return $r["total"];
	}
	
}

function solXMes($conexion, $id, $month, $sol, $anio)
{
	$sql = "SELECT count(sol_cot) as total, grup_car
	 		FROM cot_cotizaciones AS cot
			INNER JOIN mq_usu AS us
			ON cot.id_usu = us.id_usu
			INNER JOIN mq_clientes AS cli
			ON cot.id_cli = cli.id_cli
			INNER JOIN cot_tip_cotizacion AS tip
			ON cot.id_tip_cot = tip.id_tip_cot
			INNER JOIN contactos AS cont
			ON cot.id_cont = cont.id_cont
			WHERE cot.id_coti IS NOT NULL";
			if ($id == '100') {
				$sql .= " AND grup_car IN(18) ";
			} elseif ($id == '200') {
				$sql .= " AND grup_car IN(19)";
			} elseif ($id == '300') {
				$sql .= " AND grup_car IN(20)";
			} else {
				$sql .= " AND cot.id_usu=$id";
			}
	$sql .= " AND sol_cot=$sol AND MONTH(fec_coti)=$month and year(fec_coti)=$anio";
	$query = $conexion->query($sql);
	$r = $query-> fetch(PDO::FETCH_ASSOC);
	if ($r["total"] == 0) {
		return 0;
	} else {
		return $r["total"];
	}
}
function porcentaje($numero1, $numero2)
{
	if ($numero2 == 0) {
		return 0;
	} else {
		return number_format($numero1 * 100 / $numero2);
	}
}

function totalCot($conexion, $id, $month, $anio)
{

	$sql = "SELECT COUNT(id_coti) as total, grup_car
		   	FROM cot_cotizaciones AS cot
			INNER JOIN mq_usu AS us
			ON cot.id_usu = us.id_usu
			INNER JOIN mq_clientes AS cli
			ON cot.id_cli = cli.id_cli
			INNER JOIN cot_tip_cotizacion AS tip
			ON cot.id_tip_cot = tip.id_tip_cot
			INNER JOIN contactos AS cont
			ON cot.id_cont = cont.id_cont
			WHERE cot.id_coti IS NOT NULL";
			if ($id == '100') {
				$sql .= " AND grup_car IN(18)";
			} elseif ($id == '200') {
				$sql .= " AND grup_car IN(19)";
			} elseif ($id == '300') {
				$sql .= " AND grup_car IN(20)";
			} else {
				$sql .= " AND cot.id_usu=$id";
			}
	$sql .= " AND MONTH(fec_coti)=$month and year(fec_coti)=$anio";
	$query = $conexion->query($sql);
	$r = $query-> fetch(PDO::FETCH_ASSOC);
	if ($r["total"] == 0) {
		return 0;
	} else {
		return $r["total"];
	}
}

function totalApr($conexion, $id, $month, $anio)
{
	$sql = "SELECT SUM(cost_cot) as total, grup_car
		   	FROM cot_cotizaciones AS cot
			INNER JOIN mq_usu AS us
			ON cot.id_usu = us.id_usu
			INNER JOIN mq_clientes AS cli
			ON cot.id_cli = cli.id_cli
			INNER JOIN cot_tip_cotizacion AS tip
			ON cot.id_tip_cot = tip.id_tip_cot
			INNER JOIN contactos AS cont
			ON cot.id_cont = cont.id_cont
			WHERE cot.id_coti IS NOT NULL
		 	AND est_cot='2'";
			if ($id == '100') {
				$sql .= " AND grup_car IN(18)";
			} elseif ($id == '200') {
				$sql .= " AND grup_car IN(19)";
			} elseif ($id == '300') {
				$sql .= " AND grup_car IN(20)";
			} else {
				$sql .= " AND cot.id_usu=$id";
			}
	$sql .= " AND MONTH(fec_coti)=$month and year(fec_coti)=$anio";
	$query = $conexion->query($sql);
	$r = $query-> fetch(PDO::FETCH_ASSOC);
	//echo ($sql);
	if ($r["total"] == 0) {
		return 0;
	} else {
		return $r["total"];
	}
}


function cumpMes($conexion, $id, $month, $anio)
{
	$sql = "SELECT count(id_coti) as total, grup_car
			FROM cot_cotizaciones AS cot
			INNER JOIN mq_usu AS us
			ON cot.id_usu = us.id_usu
			INNER JOIN mq_clientes AS cli
			ON cot.id_cli = cli.id_cli
			INNER JOIN cot_tip_cotizacion AS tip
			ON cot.id_tip_cot = tip.id_tip_cot
			INNER JOIN contactos AS cont
			ON cot.id_cont = cont.id_cont
			WHERE cot.id_coti IS NOT NULL
			AND cot.dif_diasEn ='1'";
			if ($id == '100') {
				$sql .= " AND grup_car IN(18)";
			} elseif ($id == '200') {
				$sql .= " AND grup_car IN(19)";
			} elseif ($id == '300') {
				$sql .= " AND grup_car IN(20)";
			} else {
				$sql .= " AND cot.id_usu=$id";
			}
	$sql .= "  AND MONTH(fec_coti)=$month and year(fec_coti)=$anio";
	$query = $conexion->query($sql);
	$r = $query-> fetch(PDO::FETCH_ASSOC);
	//print_r($sql);
	if ($r["total"] == 0) {
		return 0;
	} else {
		return $r["total"];
	}
}

function llamMes($conexion, $id, $month, $anio)
{
	$sql = "SELECT sum(llam_cot) as total, grup_car
		   	FROM cot_cotizaciones AS cot
			INNER JOIN mq_usu AS us
			ON cot.id_usu = us.id_usu
			INNER JOIN mq_clientes AS cli
			ON cot.id_cli = cli.id_cli
			INNER JOIN cot_tip_cotizacion AS tip
			ON cot.id_tip_cot = tip.id_tip_cot
			INNER JOIN contactos AS cont
			ON cot.id_cont = cont.id_cont
			WHERE cot.id_coti IS NOT NULL";
			if ($id == '100') {
				$sql .= " AND grup_car IN(18)";
			} elseif ($id == '200') {
				$sql .= " AND grup_car IN(19)";
			} elseif ($id == '300') {
				$sql .= " AND grup_car IN(20)";
			} else {
				$sql .= " AND cot.id_usu=$id";
			}
	$sql .= " AND MONTH(fec_coti)=$month and year(fec_coti)=$anio";
	$query = $conexion->query($sql);
	$r = $query-> fetch(PDO::FETCH_ASSOC);
	if ($r["total"] == 0) {
		return 0;
	} else {
		return $r["total"];
	}
}

function total($conexion, $id, $month, $anio)
{
	$sql = "SELECT SUM(cost_cot) as total, grup_car
		   	FROM cot_cotizaciones AS cot
			INNER JOIN mq_usu AS us
			ON cot.id_usu = us.id_usu
			INNER JOIN mq_clientes AS cli
			ON cot.id_cli = cli.id_cli
			INNER JOIN cot_tip_cotizacion AS tip
			ON cot.id_tip_cot = tip.id_tip_cot
			INNER JOIN contactos AS cont
			ON cot.id_cont = cont.id_cont
			WHERE cot.id_coti IS NOT NULL";
			if ($id == '100') {
				$sql .= " AND grup_car IN(18) ";
			} elseif ($id == '200') {
				$sql .= " AND grup_car IN(19)";
			} elseif ($id == '300') {
				$sql .= " AND grup_car IN(20)";
			} else {
				$sql .= " AND cot.id_usu=$id";
			}
	$sql .= " AND MONTH(fec_coti)=$month and year(fec_coti)=$anio";
	$query = $conexion->query($sql);
	$r = $query-> fetch(PDO::FETCH_ASSOC);
	if ($r["total"] == 0) {
		return 0;
	} else {
		return $r["total"];
	}
}
?>

<style>
	a {
		cursor: pointer;
	}
</style>
<div class="table-responsive mt-4">
	<table class="table table-bordered table-hover table-sm font-table" id="datatable2">
		<thead class="table-dark">
			<th colspan="2" width="40"></th>
			<?php if ($month == 1) { ?>
				<th><a target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-01&mes2=' . $anio . '-01'; ?>" style="color:#fff;">ENE</a></th>
			<?php }
			if (($month == 1 || $month == 2) && ($mes2 == 2 ||$mes2 == 3 || $mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)){ ?>
				<th><a target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-02&mes2=' . $anio . '-02'; ?>" style="color:#fff;">FEB</a></th>
			<?php }
			if (($month == 1 || $month == 2 || $month == 3) && ($mes2 == 3 || $mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)){ ?>
				<th><a target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-03&mes2=' . $anio . '-03'; ?>" style="color:#fff;">MAR</a></th>
			<?php }?>
				<th class="bg-danger">TOTAL<br>1Q</th>
			<?php
			if (($month == 1 || $month == 2 || $month == 3 || $month == 4) && ($mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
				<th><a target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-04&mes2=' . $anio . '-04'; ?>" style="color:#fff;">ABR</a></th>
			<?php }
			if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5) && ($mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
				<th><a target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-05&mes2=' . $anio . '-05'; ?>" style="color:#fff;">MAY</a></th>
			<?php }
			if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6) && ($mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
				<th><a target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-06&mes2=' . $anio . '-06'; ?>" style="color:#fff;">JUN</a></th>
				<th class="bg-danger">TOTAL<br>2Q</th>
			<?php }
			if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7) && ($mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
				<th><a target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-07&mes2=' . $anio . '-07'; ?>" style="color:#fff;">JUL</a></th>
			<?php }
			if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8) && ($mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
				<TH><a target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-08&mes2=' . $anio . '-08'; ?>" style="color:#fff;">AGO</a></TH>
			<?php }
			if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8 || $month == 9) && ($mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
				<th><a target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-09&mes2=' . $anio . '-09'; ?>" style="color:#fff;">SEP</a></th>
				<th class="bg-danger">TOTAL<br>3Q</th>
			<?php }
			if ($mes2 == 10 || $mes2 == 11 || $mes2 == 12) { ?>
					<th><a target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-10&mes2=' . $anio . '-10'; ?>" style="color:#fff;">OCT</a></th>
				<?php if ($mes2 == 11 || $mes2 == 12) { ?>
					<th><a target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-11&mes2=' . $anio . '-11'; ?>" style="color:#fff;">NOV</a></th>
				<?php }
				if ($mes2 == 12) { ?>
					<th><a target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-12&mes2=' . $anio . '-12'; ?>" style="color:#fff;">DIC</a></th>
				<?php } ?>
				<th class="bg-danger">TOTAL<br>4Q</th>
			<?php } ?>
			<th>TOTAL<br>ANUAL</th>
			<th colspan="2">PROM MES <br> <?php echo $StrMonth . ' - ' . $StrMes2; ?></th>
		</thead>
		<?php $totalAnio = 0;
		for ($i = 1; $i <= 12; $i++) {
			$totalAnio += cotXMes($conexion, $id, $i, $anio);
		}
		?>
		<tbody class="text-center">
			<tr>
				<td class="bg-success text-white" colspan="2">Aprobado</td>
				<?php if ($month == 1) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-01&mes2=' . $anio . '-01'; ?>&est=2"><?php echo estXMes($conexion, $id, 1, 2, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2) && ($mes2 == 2 ||$mes2 == 3 ||$mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) {?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-02&mes2=' . $anio . '-02'; ?>&est=2"><?php echo estXMes($conexion, $id, 2, 2, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3) && ($mes2 == 3 ||$mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-03&mes2=' . $anio . '-03'; ?>&est=2"><?php echo estXMes($conexion, $id, 3, 2, $anio); ?></a></td>
				<?php }?>
					<td><?php echo estXMes($conexion, $id, 1, 2, $anio) + estXMes($conexion, $id, 2, 2, $anio) + estXMes($conexion, $id, 3, 2, $anio); ?></td>
				<?php
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4) && ($mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-04&mes2=' . $anio . '-04'; ?>&est=2"><?php echo estXMes($conexion, $id, 4, 2, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5) && ($mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-05&mes2=' . $anio . '-05'; ?>&est=2"><?php echo estXMes($conexion, $id, 5, 2, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6) && ($mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-06&mes2=' . $anio . '-06'; ?>&est=2"><?php echo estXMes($conexion, $id, 6, 2, $anio); ?></a></td>
					<td><?php echo estXMes($conexion, $id, 4, 2, $anio) + estXMes($conexion, $id, 5, 2, $anio) + estXMes($conexion, $id, 6, 2, $anio); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7) && ($mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-07&mes2=' . $anio . '-07'; ?>&est=2"><?php echo estXMes($conexion, $id, 7, 2, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8) && ($mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-08&mes2=' . $anio . '-08'; ?>&est=2"><?php echo estXMes($conexion, $id, 8, 2, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8 || $month == 9) && ($mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-09&mes2=' . $anio . '-09'; ?>&est=2"><?php echo estXMes($conexion, $id, 9, 2, $anio); ?></a></td>
					<td><?php echo estXMes($conexion, $id, 7, 2, $anio) + estXMes($conexion, $id, 8, 2, $anio) + estXMes($conexion, $id, 9, 2, $anio); ?></td>
				<?php }
				if ($mes2 == 10 || $mes2 == 11 || $mes2 == 12) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-10&mes2=' . $anio . '-10'; ?>&est=2"><?php echo estXMes($conexion, $id, 10, 2, $anio); ?></a></td>
					<?php if ($mes2 == 11 || $mes2 == 12) { ?>
						<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-11&mes2=' . $anio . '-11'; ?>&est=2"><?php echo estXMes($conexion, $id, 11, 2, $anio); ?></a></td>
					<?php }
					if ($mes2 == 12) { ?>
						<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-12&mes2=' . $anio . '-12'; ?>&est=2"><?php echo estXMes($conexion, $id, 12, 2, $anio); ?></a></td>
					<?php } ?>
					<td><?php echo estXMes($conexion, $id, 10, 2, $anio) + estXMes($conexion, $id, 11, 2, $anio) + estXMes($conexion, $id, 12, 2, $anio); ?></td>
				<?php } ?>
				<td><?php $total = 0;
					for ($i = 1; $i <= 12; $i++) {
						$total += estXMes($conexion, $id, $i, 2, $anio);
					}
					echo $total;
					?>
				</td>
				<td>
					<?php
					$totalc = 0;
					$total1 = 0;
					$total2 = 0;
					if ($month != $mes2) {
						$total2 = $total / $mes2;
						$totalc = round($total2);
					} else {
						$totalc = round($total / ($mes2 - ($month - 1)));
					}
					echo $totalc;
					?>
				</td>
				<td> <?php echo "%" . porcentaje($totalc, $totalAnio); ?></td>
			</tr>
			<tr>
				<td class="bg-warning text-white" colspan="2">Pendiente</td>
				<?php if ($month == 1) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-01&mes2=' . $anio . '-01'; ?>&est=1"><?php echo estXMes($conexion, $id, 1, 1, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2) && ($mes2 == 2 ||$mes2 == 3 ||$mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) {?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-02&mes2=' . $anio . '-02'; ?>&est=1"><?php echo estXMes($conexion, $id, 2, 1, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3) && ($mes2 == 3 ||$mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-03&mes2=' . $anio . '-03'; ?>&est=1"><?php echo estXMes($conexion, $id, 3, 1, $anio); ?></a></td>
				<?php }?>
					<td><?php echo estXMes($conexion, $id, 1, 1, $anio) + estXMes($conexion, $id, 2, 1, $anio) + estXMes($conexion, $id, 3, 1, $anio); ?></td>
				<?php
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4) && ($mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-04&mes2=' . $anio . '-04'; ?>&est=1"><?php echo estXMes($conexion, $id, 4, 1, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5) && ($mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-05&mes2=' . $anio . '-05'; ?>&est=1"><?php echo estXMes($conexion, $id, 5, 1, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6) && ($mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-06&mes2=' . $anio . '-06'; ?>&est=1"><?php echo estXMes($conexion, $id, 6, 1, $anio); ?></a></td>
					<td><?php echo estXMes($conexion, $id, 4, 1, $anio) + estXMes($conexion, $id, 5, 1, $anio) + estXMes($conexion, $id, 6, 1, $anio); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7) && ($mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-07&mes2=' . $anio . '-07'; ?>&est=1"><?php echo estXMes($conexion, $id, 7, 1, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8) && ($mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-08&mes2=' . $anio . '-08'; ?>&est=1"><?php echo estXMes($conexion, $id, 8, 1, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8 || $month == 9) && ($mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-09&mes2=' . $anio . '-09'; ?>&est=1"><?php echo estXMes($conexion, $id, 9, 1, $anio); ?></a></td>
					<td><?php echo estXMes($conexion, $id, 7, 1, $anio) + estXMes($conexion, $id, 8, 1, $anio) + estXMes($conexion, $id, 9, 1, $anio); ?></td>
				<?php }
				if ($mes2 == 10 || $mes2 == 11 || $mes2 == 12) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-10&mes2=' . $anio . '-10'; ?>&est=1"><?php echo estXMes($conexion, $id, 10, 1, $anio); ?></a></td>
					<?php if ($mes2 == 11 || $mes2 == 12) { ?>
						<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-11&mes2=' . $anio . '-11'; ?>&est=1"><?php echo estXMes($conexion, $id, 11, 1, $anio); ?></a></td>
					<?php }
					if ($mes2 == 12) { ?>
						<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-12&mes2=' . $anio . '-12'; ?>&est=1"><?php echo estXMes($conexion, $id, 12, 1, $anio); ?></a></td>
					<?php } ?>
					<td><?php echo estXMes($conexion, $id, 10, 1, $anio) + estXMes($conexion, $id, 11, 1, $anio) + estXMes($conexion, $id, 12, 1, $anio); ?></td>
				<?php } ?>
				<td>
					<?php $total = 0;
					for ($i = 1; $i <= 12; $i++) {
						$total += estXMes($conexion, $id, $i, 1, $anio);
					}
					echo $total;
					?>
				</td>
				<td>
					<?php
					$totalc = 0;
					$total1 = 0;
					$total2 = 0;
					if ($month != $mes2) {
						$total2 = $total / $mes2;
						$totalc = round($total2);
					} else {
						$totalc = round($total / ($mes2 - ($month - 1)));
					}
					echo $totalc;
					?>
				</td>
				<td> <?php echo "%" . number_format(porcentaje($totalc, $totalAnio)); ?></td>
			</tr>
			<tr>
				<td class="bg-info text-white" colspan="2">Act de precios</td>
				<?php if ($month == 1) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-01&mes2=' . $anio . '-01'; ?>&est=4"><?php echo estXMes($conexion, $id, 1, 4, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2) && ($mes2 == 2 ||$mes2 == 3 ||$mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) {?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-02&mes2=' . $anio . '-02'; ?>&est=4"><?php echo estXMes($conexion, $id, 2, 4, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3) && ($mes2 == 3 ||$mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-03&mes2=' . $anio . '-03'; ?>&est=4"><?php echo estXMes($conexion, $id, 3, 4, $anio); ?></a></td>
				<?php }?>
					<td><?php echo estXMes($conexion, $id, 1, 4, $anio) + estXMes($conexion, $id, 2, 4, $anio) + estXMes($conexion, $id, 3, 4, $anio); ?></td>
				<?php
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4) && ($mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-04&mes2=' . $anio . '-04'; ?>&est=4"><?php echo estXMes($conexion, $id, 4, 4, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5) && ($mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-05&mes2=' . $anio . '-05'; ?>&est=4"><?php echo estXMes($conexion, $id, 5, 4, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6) && ($mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-06&mes2=' . $anio . '-06'; ?>&est=4"><?php echo estXMes($conexion, $id, 6, 4, $anio); ?></a></td>
					<td><?php echo estXMes($conexion, $id, 4, 4, $anio) + estXMes($conexion, $id, 5, 4, $anio) + estXMes($conexion, $id, 6, 4, $anio); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7) && ($mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-07&mes2=' . $anio . '-07'; ?>&est=4"><?php echo estXMes($conexion, $id, 7, 4, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8) && ($mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-08&mes2=' . $anio . '-08'; ?>&est=4"><?php echo estXMes($conexion, $id, 8, 4, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8 || $month == 9) && ($mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-09&mes2=' . $anio . '-09'; ?>&est=4"><?php echo estXMes($conexion, $id, 9, 4, $anio); ?></a></td>
					<td><?php echo estXMes($conexion, $id, 7, 4, $anio) + estXMes($conexion, $id, 8, 4, $anio) + estXMes($conexion, $id, 9, 4, $anio); ?></td>
				<?php }
				if ($mes2 == 10 || $mes2 == 11 || $mes2 == 12) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-10&mes2=' . $anio . '-10'; ?>&est=4"><?php echo estXMes($conexion, $id, 10, 4, $anio); ?></a></td>
					<?php if ($mes2 == 11 || $mes2 == 12) { ?>
						<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-11&mes2=' . $anio . '-11'; ?>&est=4"><?php echo estXMes($conexion, $id, 11, 4, $anio); ?></a></td>
					<?php }
					if ($mes2 == 12) { ?>
						<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-12&mes2=' . $anio . '-12'; ?>&est=4"><?php echo estXMes($conexion, $id, 12, 4, $anio); ?></a></td>
					<?php } ?>
					<td><?php echo estXMes($conexion, $id, 10, 4, $anio) + estXMes($conexion, $id, 11, 4, $anio) + estXMes($conexion, $id, 12, 4, $anio); ?></td>
				<?php } ?>
				<td>
					<?php $total = 0;
					for ($i = 1; $i <= 12; $i++) {
						$total += estXMes($conexion, $id, $i, 4, $anio);
					}
					echo $total;
					?>
				</td>
				<td>
					<?php
					$totalc = 0;
					$total1 = 0;
					$total2 = 0;
					if ($month != $mes2) {
						$total2 = $total / $mes2;
						$totalc = round($total2);
					} else {
						$totalc = round($total / ($mes2 - ($month - 1)));
					}
					echo $totalc;
					?>
				</td>
				<td> <?php echo "%" . number_format(porcentaje($totalc, $totalAnio)); ?></td>
			</tr>
			<tr>
				<td class="bg-danger text-white" colspan="2">Rechazado</td>
				<?php if ($month == 1) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-01&mes2=' . $anio . '-01'; ?>&est=3"><?php echo estXMes($conexion, $id, 1, 3, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3) && ($mes2 == 2 || $mes2 == 3 ||$mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-02&mes2=' . $anio . '-02'; ?>&est=3"><?php echo estXMes($conexion, $id, 2, 3, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3) && ($mes2 == 3 ||$mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-03&mes2=' . $anio . '-03'; ?>&est=3"><?php echo estXMes($conexion, $id, 3, 3, $anio); ?></a></td>
				<?php }?>
					<td><?php echo estXMes($conexion, $id, 1, 3, $anio) + estXMes($conexion, $id, 2, 3, $anio) + estXMes($conexion, $id, 3, 3, $anio); ?></td>
				<?php
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4) && ($mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-04&mes2=' . $anio . '-04'; ?>&est=3"><?php echo estXMes($conexion, $id, 4, 3, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5) && ($mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-05&mes2=' . $anio . '-05'; ?>&est=3"><?php echo estXMes($conexion, $id, 5, 3, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6) && ($mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-06&mes2=' . $anio . '-06'; ?>&est=3"><?php echo estXMes($conexion, $id, 6, 3, $anio); ?></a></td>
					<td><?php echo estXMes($conexion, $id, 4, 3, $anio) + estXMes($conexion, $id, 5, 3, $anio) + estXMes($conexion, $id, 6, 3, $anio); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7) && ($mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-07&mes2=' . $anio . '-07'; ?>&est=3"><?php echo estXMes($conexion, $id, 7, 3, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8) && ($mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-08&mes2=' . $anio . '-08'; ?>&est=3"><?php echo estXMes($conexion, $id, 8, 3, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8 || $month == 9) && ($mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-09&mes2=' . $anio . '-09'; ?>&est=3"><?php echo estXMes($conexion, $id, 9, 3, $anio); ?></a></td>
					<td><?php echo estXMes($conexion, $id, 7, 3, $anio) + estXMes($conexion, $id, 8, 3, $anio) + estXMes($conexion, $id, 9, 3, $anio); ?></td>
				<?php }
				if ($mes2 == 10 || $mes2 == 11 || $mes2 == 12) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-10&mes2=' . $anio . '-10'; ?>&est=3"><?php echo estXMes($conexion, $id, 10, 3, $anio); ?></a></td>
					<?php if ($mes2 == 11 || $mes2 == 12) { ?>
						<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-11&mes2=' . $anio . '-11'; ?>&est=3"><?php echo estXMes($conexion, $id, 11, 3, $anio); ?></a></td>
					<?php }
					if ($mes2 == 12) { ?>
						<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-12&mes2=' . $anio . '-12'; ?>&est=3"><?php echo estXMes($conexion, $id, 12, 3, $anio); ?></a></td>
					<?php } ?>
					<td><?php echo estXMes($conexion, $id, 10, 3, $anio) + estXMes($conexion, $id, 11, 3, $anio) + estXMes($conexion, $id, 12, 3, $anio); ?></td>
				<?php } ?>
				<td>
					<?php $total = 0;
					for ($i = 1; $i <= 12; $i++) {
						$total += estXMes($conexion, $id, $i, 3, $anio);
					}
					echo $total;
					?>
				</td>
				<td>
					<?php
					$totalc = 0;
					$total1 = 0;
					$total2 = 0;
					if ($month != $mes2) {
						$total2 = $total / $mes2;
						$totalc = round( $total2);
					} else {
						$totalc = round($total / ($mes2 - ($month - 1)));
					}
					echo $totalc;
					?>
				</td>
				<td> <?php echo "%" . number_format(porcentaje($totalc, $totalAnio)); ?></td>
			</tr>
			<tr>
				<td class="" colspan="2"><strong>TL COTIZACIONES</strong></td>
				<?php if ($month == 1) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-01&mes2=' . $anio . '-01'; ?>&est=0&sol=NULL"><?php echo totalCot($conexion, $id, 1, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2) && ($mes2 == 2 ||$mes2 == 3 || $mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)){ ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-02&mes2=' . $anio . '-02'; ?>&est=0&sol=NULL"><?php echo totalCot($conexion, $id, 2, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3) && ($mes2 == 3 || $mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)){ ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-03&mes2=' . $anio . '-03'; ?>"><?php echo totalCot($conexion, $id, 3, $anio); ?></a></td>
				<?php } ?>
					<td><?php echo totalCot($conexion, $id, 1, $anio) + totalCot($conexion, $id, 2, $anio) + totalCot($conexion, $id, 3, $anio); ?></td>
				<?php 
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4) && ($mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-04&mes2=' . $anio . '-04'; ?>"><?php echo totalCot($conexion, $id, 4, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5) && ($mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-05&mes2=' . $anio . '-05'; ?>"><?php echo totalCot($conexion, $id, 5, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6) && ($mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-06&mes2=' . $anio . '-06'; ?>"><?php echo totalCot($conexion, $id, 6, $anio); ?></a></td>
					<td><?php echo totalCot($conexion, $id, 4, $anio) + totalCot($conexion, $id, 5, $anio) + totalCot($conexion, $id, 6, $anio); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7) && ($mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-07&mes2=' . $anio . '-07'; ?>"><?php echo totalCot($conexion, $id, 7, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8) && ($mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-08&mes2=' . $anio . '-08'; ?>"><?php echo totalCot($conexion, $id, 8, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8 || $month == 9) && ($mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-09&mes2=' . $anio . '-09'; ?>"><?php echo totalCot($conexion, $id, 9, $anio); ?></a></td>
					<td><?php echo totalCot($conexion, $id, 7, $anio) + totalCot($conexion, $id, 8, $anio) + totalCot($conexion, $id, 9, $anio); ?></td>
				<?php }
				if ($mes2 == 10 || $mes2 == 11 || $mes2 == 12) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-10&mes2=' . $anio . '-10'; ?>"><?php echo totalCot($conexion, $id, 10, $anio); ?></a></td>
					<?php if ($mes2 == 11 || $mes2 == 12) { ?>
						<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-11&mes2=' . $anio . '-11'; ?>"><?php echo totalCot($conexion, $id, 11, $anio); ?></a></td>
					<?php }
					if ($mes2 == 12) { ?>
						<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-12&mes2=' . $anio . '-12'; ?>"><?php echo totalCot($conexion, $id, 12, $anio); ?></a></td>
					<?php } ?> <td><?php echo totalCot($conexion, $id, 10, $anio) + totalCot($conexion, $id, 11, $anio) + totalCot($conexion, $id, 12, $anio); ?></td>
				<?php } ?>
				<td><?php $total = 0;
					for ($i = 1; $i <= 12; $i++) {
						$total += totalCot($conexion, $id, $i, $anio);
					}
					echo $total;
					?>
				</td>
				<td>
					<?php
					$totalc = 0;
					$total2 = 0;
					if ($month != $mes2) {
						$total2 = $total / $mes2;
						$totalc = round($total2);
					} else {
						$totalc = round($total / ($mes2 - ($month - 1)));
					}
					echo $totalc;
					?>
				</td>
				<td> <?php echo "%" . number_format(porcentaje($totalc, $totalAnio)); ?></td>
			</tr>
			<tr>
				<td style="font-size: 10px">COTIZACIONES <br> DEFINIDAS </td>
				<td>$VENTAS</td>
				<?php if ($month == 1) { ?>
					<td><?php echo "$" . number_format(totalApr($conexion, $id, 1, $anio), 0, '.', ','); ?></td>
				<?php }
				if (($month == 1 || $month == 2) && ($mes2 == 2 ||$mes2 == 3 || $mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)){ ?>
					<td><?php echo "$" . number_format(totalApr($conexion, $id, 2, $anio), 0, '.', ','); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3) && ($mes2 == 3 || $mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)){ ?>
					<td><?php echo "$" . number_format(totalApr($conexion, $id, 3, $anio), 0, '.', ','); ?></td>
				<?php }?>
					<td><?php echo "$" . number_format((totalApr($conexion, $id, 1, $anio) + totalApr($conexion, $id, 2, $anio) + totalApr($conexion, $id, 3, $anio)), 0, '.', ','); ?></td>
				<?php
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4) && ($mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><?php echo "$" . number_format(totalApr($conexion, $id, 4, $anio), 0, '.', ','); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5) && ($mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><?php echo "$" . number_format(totalApr($conexion, $id, 5, $anio), 0, '.', ','); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6) && ($mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><?php echo "$" . number_format(totalApr($conexion, $id, 6, $anio), 0, '.', ','); ?></td>
					<td><?php echo "$" . number_format((totalApr($conexion, $id, 4, $anio) + totalApr($conexion, $id, 5, $anio) + totalApr($conexion, $id, 6, $anio)), 0, '.', ','); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7) && ($mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><?php echo "$" . number_format(totalApr($conexion, $id, 7, $anio), 0, '.', ','); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8) && ($mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><?php echo "$" . number_format(totalApr($conexion, $id, 8, $anio), 0, '.', ','); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8 || $month == 9) && ($mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><?php echo "$" . number_format(totalApr($conexion, $id, 9, $anio), 0, '.', ','); ?></td>
					<td><?php echo "$" . number_format((totalApr($conexion, $id, 7, $anio) + totalApr($conexion, $id, 8, $anio) + totalApr($conexion, $id, 9, $anio)), 0, '.', ','); ?></td>
				<?php }
				if ($mes2 == 10 || $mes2 == 11 || $mes2 == 12) { ?>
					<td><?php echo "$" . number_format(totalApr($conexion, $id, 10, $anio), 0, '.', ','); ?></td>
					<?php if ($mes2 == 11 || $mes2 == 12) { ?>
						<td><?php echo "$" . number_format(totalApr($conexion, $id, 11, $anio), 0, '.', ','); ?></td>
					<?php }
					if ($mes2 == 12) { ?>
						<td><?php echo "$" . number_format(totalApr($conexion, $id, 12, $anio), 0, '.', ','); ?></td>
					<?php } ?>
					<td><?php echo "$" . number_format((totalApr($conexion, $id, 10, $anio) + totalApr($conexion, $id, 11, $anio) + totalApr($conexion, $id, 12, $anio)), 0, '.', ','); ?></td>
				<?php } ?>
				<td>
					<?php $total = 0;
					for ($i = 1; $i <= 12; $i++) {
						$total += totalApr($conexion, $id, $i, $anio);
					}
					echo "$" . number_format($total);
					?>
				</td>
				<td>
					<?php
					$totalc = 0;
					$total1 = 0;
					$total2 = 0;
					if ($month != $mes2) {
						$total2 = $total / $mes2;
						$totalc = round( $total2);
					} else {
						$totalc = round($total / ($mes2 - ($month - 1)));
					}
					echo '$' . number_format($totalc);
					?>
				</td>
				<td> <?php echo "%" . porcentaje($totalc, $total); ?></td>
			</tr>
			<tr>
				<td colspan="2" align="center">$TL COTIZACIONES </td>
				<?php if ($month == 1) { ?>
					<td><?php echo "$" . number_format(total($conexion, $id, 1, $anio), 0, '.', ','); ?></td>
				<?php }
				if (($month == 1 || $month == 2) && ($mes2 == 2 ||$mes2 == 3 || $mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)){ ?>
					<td><?php echo "$" . number_format(total($conexion, $id, 2, $anio), 0, '.', ','); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3) && ($mes2 == 3 || $mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)){ ?>
					<td><?php echo "$" . number_format(total($conexion, $id, 3, $anio), 0, '.', ','); ?></td>
				<?php }?>
					<td><?php echo "$" . number_format((total($conexion, $id, 1, $anio) + total($conexion, $id, 2, $anio) + total($conexion, $id, 3, $anio)), 0, '.', ','); ?></td>
				<?php
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4) && ($mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><?php echo "$" . number_format(total($conexion, $id, 4, $anio), 0, '.', ','); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5) && ($mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><?php echo "$" . number_format(total($conexion, $id, 5, $anio), 0, '.', ','); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6) && ($mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><?php echo "$" . number_format(total($conexion, $id, 6, $anio), 0, '.', ','); ?></td>
					<td><?php echo "$" . number_format((total($conexion, $id, 4, $anio) + total($conexion, $id, 5, $anio) + total($conexion, $id, 6, $anio)), 0, '.', ','); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7) && ($mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><?php echo "$" . number_format(total($conexion, $id, 7, $anio), 0, '.', ','); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8) && ($mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><?php echo "$" . number_format(total($conexion, $id, 8, $anio), 0, '.', ','); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8 || $month == 9) && ($mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><?php echo "$" . number_format(total($conexion, $id, 9, $anio), 0, '.', ','); ?></td>
					<td><?php echo "$" . number_format((total($conexion, $id, 7, $anio) + total($conexion, $id, 8, $anio) + total($conexion, $id, 9, $anio)), 0, '.', ','); ?></td>
				<?php }
				if ($mes2 == 10 || $mes2 == 11 || $mes2 == 12) { ?>
					<td><?php echo "$" . number_format(total($conexion, $id, 10, $anio), 0, '.', ','); ?></td>
					<?php if ($mes2 == 11 || $mes2 == 12) { ?>
						<td><?php echo "$" . number_format(total($conexion, $id, 11, $anio), 0, '.', ','); ?></td>
					<?php }
					if ($mes2 == 12) { ?>
						<td><?php echo "$" . number_format(total($conexion, $id, 12, $anio), 0, '.', ','); ?></td>
					<?php } ?>
					<td><?php echo "$" . number_format((total($conexion, $id, 10, $anio) + total($conexion, $id, 11, $anio) + total($conexion, $id, 12, $anio)), 0, '.', ','); ?></td>
				<?php } ?>
				<td>
					<?php $total = 0;
					for ($i = 1; $i <= 12; $i++) {
						$total += total($conexion, $id, $i, $anio);
					}
					echo "$" . number_format($total);
					?>
				</td>
				<td>
					<?php
					$totalc = 0;
					$total1 = 0;
					$total2 = 0;
					if ($month != $mes2) {
						$total2 = $total / $mes2;
						$totalc = round($total2);
					} else {
						$totalc = round($total / ($mes2 - ($month - 1)));
					}
					echo '$' . number_format($totalc);
					?>
				</td>
				<td> <?php echo "%" . porcentaje($totalc, $total); ?></td>
			</tr>
			<tr class="bg-danger">
				<td colspan="2" class="text-white">EFICIENCIA <br>EN COTIZACIONES</td>
				<?php if ($month == 1) { ?>
					<td class="text-white"> %<?php echo porcentaje(estXMes($conexion, $id, 1, 2, $anio), cotXMes($conexion, $id, 1, $anio)); ?></td>
				<?php }
				if (($month == 1 || $month == 2) && ($mes2 == 2 ||$mes2 == 3 || $mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)){ ?>
					<td class="text-white"> %<?php echo porcentaje(estXMes($conexion, $id, 2, 2, $anio), cotXMes($conexion, $id, 2, $anio)); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3) && ($mes2 == 3 || $mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)){ ?>
					<td class="text-white"> %<?php echo porcentaje(estXMes($conexion, $id, 3, 2, $anio), cotXMes($conexion, $id, 3, $anio)); ?></td>
				<?php }?>
					<td class="text-white">% <?php echo porcentaje(
								estXMes($conexion, $id, 1, 2, $anio) + estXMes($conexion, $id, 2, 2, $anio) + estXMes($conexion, $id, 3, 2, $anio),
								cotXMes($conexion, $id, 1, $anio) + cotXMes($conexion, $id, 2, $anio) + cotXMes($conexion, $id, 3, $anio)
							); ?>
					</td>
				<?php
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4) && ($mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td class="text-white"> %<?php echo porcentaje(estXMes($conexion, $id, 4, 2, $anio), cotXMes($conexion, $id, 4, $anio)); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5) && ($mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td class="text-white"> %<?php echo porcentaje(estXMes($conexion, $id, 5, 2, $anio), cotXMes($conexion, $id, 5, $anio)); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6) && ($mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td class="text-white"> %<?php echo porcentaje(estXMes($conexion, $id, 6, 2, $anio), cotXMes($conexion, $id, 6, $anio)); ?></td>
					<td class="text-white">% <?php echo porcentaje(
								estXMes($conexion, $id, 4, 2, $anio) + estXMes($conexion, $id, 5, 2, $anio) + estXMes($conexion, $id, 6, 2, $anio),
								cotXMes($conexion, $id, 4, $anio) + cotXMes($conexion, $id, 5, $anio) + cotXMes($conexion, $id, 6, $anio)
							); ?>

					</td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7) && ($mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td class="text-white"> %<?php echo porcentaje(estXMes($conexion, $id, 7, 2, $anio), cotXMes($conexion, $id, 7, $anio)); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8) && ($mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td class="text-white"> %<?php echo porcentaje(estXMes($conexion, $id, 8, 2, $anio), cotXMes($conexion, $id, 8, $anio)); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8 || $month == 9) && ($mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td class="text-white"> %<?php echo porcentaje(estXMes($conexion, $id, 9, 2, $anio), cotXMes($conexion, $id, 9, $anio)); ?></td>
					<td class="text-white">% <?php echo porcentaje(
								estXMes($conexion, $id, 7, 2, $anio) + estXMes($conexion, $id, 8, 2, $anio) + estXMes($conexion, $id, 9, 2, $anio),
								cotXMes($conexion, $id, 7, $anio) + cotXMes($conexion, $id, 8, $anio) + cotXMes($conexion, $id, 9, $anio)
							); ?>

					</td>
				<?php }
				if ($mes2 == 10 || $mes2 == 11 || $mes2 == 12) { ?>
					<td class="text-white"> %<?php echo porcentaje(estXMes($conexion, $id, 10, 2, $anio), cotXMes($conexion, $id, 10, $anio)); ?></td>
					<?php if ($mes2 == 11 || $mes2 == 12) { ?>
						<td class="text-white"> %<?php echo porcentaje(estXMes($conexion, $id, 11, 2, $anio), cotXMes($conexion, $id, 11, $anio)); ?></td>
					<?php }
					if ($mes2 == 12) { ?>
						<td class="text-white"> %<?php echo porcentaje(estXMes($conexion, $id, 12, 2, $anio), cotXMes($conexion, $id, 12, $anio)); ?></td>
					<?php } ?>
					<td class="text-white"> % <?php echo porcentaje(
								estXMes($conexion, $id, 10, 2, $anio) + estXMes($conexion, $id, 11, 2, $anio) + estXMes($conexion, $id, 12, 2, $anio),
								cotXMes($conexion, $id, 10, $anio) + cotXMes($conexion, $id, 11, $anio) + cotXMes($conexion, $id, 12, $anio)
							); ?>

					</td>
				<?php } ?>

				<td class="text-white">
					<?php $total = 0;
					$totaldiv = 0;
					for ($i = 1; $i <= 12; $i++) {
						$total += estXMes($conexion, $id, $i, 2, $anio);
						$totaldiv += cotXMes($conexion, $id, $i, $anio);
					}
					$totalef = porcentaje($total, $totaldiv);
					echo "%" . $totalef;
					?>
				</td>
				<td class="text-white">
					<?php $total = 0;
					$totaldiv = 0;
					for ($i = 1; $i <= 12; $i++) {
						$total += estXMes($conexion, $id, $i, 2, $anio);
						$totaldiv += cotXMes($conexion, $id, $i, $anio);
					}
					$totalef = porcentaje($total, $totaldiv);
					$totalc = 0;
					if ($month != $mes2) {
						$total1 = $totalef / $month;
						$total2 = $totalef / $mes2;
						$totalc = round($total1 - $total2);
					} else {
						$totalc = round($totalef / ($mes2 - ($month - 1)));
					}
					echo "%" . number_format($totalc);
					?>
				</td>
				<td class="text-white">N/A</td>
			</tr>
			<tr>
				<td colspan="2" style="font-size: 10px"> CUMPLIMIENTO DE ENTREGAS <br> COTIZACIONES ENVIADAS <br>EN 1 DÍA HÁBIL</td>
				<?php if ($month == 1) { ?>
					<td><?php echo cumpMes($conexion, $id, 1, $anio); ?></td>
				<?php }
				if (($month == 1 || $month == 2) && ($mes2 == 2 ||$mes2 == 3 || $mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)){ ?>
					<td><?php echo cumpMes($conexion, $id, 2, $anio); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3) && ($mes2 == 3 || $mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)){ ?>
					<td><?php echo cumpMes($conexion, $id, 3, $anio); ?></td>
				<?php }?>
					<td><?php echo cumpMes($conexion, $id, 1, $anio) + cumpMes($conexion, $id, 2, $anio) + cumpMes($conexion, $id, 3, $anio); ?></td>
				<?php
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4) && ($mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><?php echo cumpMes($conexion, $id, 4, $anio); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5) && ($mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><?php echo cumpMes($conexion, $id, 5, $anio); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6) && ($mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><?php echo cumpMes($conexion, $id, 6, $anio); ?></td>
					<td><?php echo cumpMes($conexion, $id, 4, $anio) + cumpMes($conexion, $id, 5, $anio) + cumpMes($conexion, $id, 6, $anio); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7) && ($mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><?php echo cumpMes($conexion, $id, 7, $anio); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8) && ($mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><?php echo cumpMes($conexion, $id, 8, $anio); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8 || $month == 9) && ($mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><?php echo cumpMes($conexion, $id, 9, $anio); ?></td>
					<td><?php echo cumpMes($conexion, $id, 7, $anio) + cumpMes($conexion, $id, 8, $anio) + cumpMes($conexion, $id, 9, $anio); ?></td>
				<?php }
				if ($mes2 == 10 || $mes2 == 11 || $mes2 == 12) { ?>
					<td><?php echo cumpMes($conexion, $id, 10, $anio); ?></td>
					<?php if ($mes2 == 11 || $mes2 == 12) { ?>
						<td><?php echo cumpMes($conexion, $id, 11, $anio); ?></td>
					<?php }
					if ($mes2 == 12) { ?>
						<td><?php echo cumpMes($conexion, $id, 12, $anio); ?></td>
					<?php } ?>
					<td><?php echo cumpMes($conexion, $id, 10, $anio) + cumpMes($conexion, $id, 11, $anio) + cumpMes($conexion, $id, 12, $anio); ?></td>
				<?php } ?>
				<td>
					<?php $total = 0;
					for ($i = 1; $i <= 12; $i++) {
						$total += cumpMes($conexion, $id, $i, $anio);
					}
					echo $total;
					?>
				</td>
				<td>
					<?php $total = 0;
					$totalc = 0;

					for ($i = 1; $i <= 12; $i++) {
						$total += cumpMes($conexion, $id, $i, $anio);
					}
					if ($month != $mes2) {
						$total1 = $total / $month;
						$total2 = $total / $mes2;
						$totalc = round($total1 - $total2);
					} else {
						$totalc = round($total / ($mes2 - ($month - 1)));
					}
					echo number_format($totalc);
					?>
				</td>
				<td>N/A</td>
			</tr>
			<tr>
				<td colspan="2">Teléfono</td>
				<?php if ($month == 1) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-01&mes2=' . $anio . '-01'; ?>&sol=1"><?php echo solXMes($conexion, $id, 1, 1, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2) && ($mes2 == 2 ||$mes2 == 3 || $mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)){ ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-02&mes2=' . $anio . '-02'; ?>&sol=1"><?php echo solXMes($conexion, $id, 2, 1, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3) && ($mes2 == 3 || $mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)){ ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-03&mes2=' . $anio . '-03'; ?>&sol=1"><?php echo solXMes($conexion, $id, 3, 1, $anio); ?></a></td>
				<?php } ?>
					<td><?php echo solXMes($conexion, $id, 1, 1, $anio) + solXMes($conexion, $id, 2, 1, $anio) + solXMes($conexion, $id, 3, 1, $anio); ?></td>
				<?php
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4) && ($mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-04&mes2=' . $anio . '-04'; ?>&sol=1"><?php echo solXMes($conexion, $id, 4, 1, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5) && ($mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-05&mes2=' . $anio . '-05'; ?>&sol=1"><?php echo solXMes($conexion, $id, 5, 1, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6) && ($mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-06&mes2=' . $anio . '-06'; ?>&sol=1"><?php echo solXMes($conexion, $id, 6, 1, $anio); ?></a></td>
					<td><?php echo solXMes($conexion, $id, 4, 1, $anio) + solXMes($conexion, $id, 5, 1, $anio) + solXMes($conexion, $id, 6, 1, $anio); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7) && ($mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-07&mes2=' . $anio . '-07'; ?>&sol=1"><?php echo solXMes($conexion, $id, 7, 1, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8) && ($mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-08&mes2=' . $anio . '-08'; ?>&sol=1"><?php echo solXMes($conexion, $id, 8, 1, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8 || $month == 9) && ($mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-09&mes2=' . $anio . '-09'; ?>&sol=1"><?php echo solXMes($conexion, $id, 9, 1, $anio); ?></a></td>
					<td><?php echo solXMes($conexion, $id, 7, 1, $anio) + solXMes($conexion, $id, 8, 1, $anio) + solXMes($conexion, $id, 9, 1, $anio); ?></td>
				<?php }
				if ($mes2 == 10 || $mes2 == 11 || $mes2 == 12) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-10&mes2=' . $anio . '-10'; ?>&sol=1"><?php echo solXMes($conexion, $id, 10, 1, $anio); ?></a></td>
					<?php if ($mes2 == 11 || $mes2 == 12) { ?>
						<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-11&mes2=' . $anio . '-11'; ?>&sol=1"><?php echo solXMes($conexion, $id, 11, 1, $anio); ?></a></td>
					<?php }
					if ($mes2 == 12) { ?>
						<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-12&mes2=' . $anio . '-12'; ?>&sol=1"><?php echo solXMes($conexion, $id, 12, 1, $anio); ?></a></td>
					<?php } ?>
					<td><?php echo solXMes($conexion, $id, 10, 1, $anio) + solXMes($conexion, $id, 11, 1, $anio) + solXMes($conexion, $id, 12, 1, $anio); ?></td>
				<?php } ?>
				<td>
					<?php $total = 0;
					for ($i = 1; $i <= 12; $i++) {
						$total += solXMes($conexion, $id, $i, 1, $anio);
					}
					echo $total;
					?>
				</td>
				<td>
					<?php
					$totalc = 0;
					$total1 = 0;
					$total2 = 0;
					if ($month != $mes2) {
						$total2 = $total / $mes2;
						$totalc = round($total2);
					} else {
						$totalc = round($total / ($mes2 - ($month - 1)));
					}
					echo $totalc;
					?>
				</td>
				<td> <?php echo "%" . number_format(porcentaje($totalc, $totalAnio)); ?></td>
			</tr>
			<tr>
				<td colspan="2">Email</td>
				<?php if ($month == 1) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-01&mes2=' . $anio . '-01'; ?>&sol=2"><?php echo solXMes($conexion, $id, 1, 2, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2) && ($mes2 == 2 ||$mes2 == 3 || $mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)){ ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-02&mes2=' . $anio . '-02'; ?>&sol=2"><?php echo solXMes($conexion, $id, 2, 2, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3) && ($mes2 == 3 || $mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)){ ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-03&mes2=' . $anio . '-03'; ?>&sol=2"><?php echo solXMes($conexion, $id, 3, 2, $anio); ?></a></td>
				<?php } ?>
					<td><?php echo solXMes($conexion, $id, 1, 2, $anio) + solXMes($conexion, $id, 2, 2, $anio) + solXMes($conexion, $id, 3, 2, $anio); ?></td>
				<?php
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4) && ($mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-04&mes2=' . $anio . '-04'; ?>&sol=2"><?php echo solXMes($conexion, $id, 4, 2, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5) && ($mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-05&mes2=' . $anio . '-05'; ?>&sol=2"><?php echo solXMes($conexion, $id, 5, 2, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6) && ($mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-06&mes2=' . $anio . '-06'; ?>&sol=2"><?php echo solXMes($conexion, $id, 6, 2, $anio); ?></a></td>
					<td><?php echo solXMes($conexion, $id, 4, 2, $anio) + solXMes($conexion, $id, 5, 2, $anio) + solXMes($conexion, $id, 6, 2, $anio); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7) && ($mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-07&mes2=' . $anio . '-07'; ?>&sol=2"><?php echo solXMes($conexion, $id, 7, 2, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8) && ($mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-08&mes2=' . $anio . '-08'; ?>&sol=2"><?php echo solXMes($conexion, $id, 8, 2, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8 || $month == 9) && ($mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-09&mes2=' . $anio . '-09'; ?>&sol=2"><?php echo solXMes($conexion, $id, 9, 2, $anio); ?></a></td>
					<td><?php echo solXMes($conexion, $id, 7, 2, $anio) + solXMes($conexion, $id, 8, 2, $anio) + solXMes($conexion, $id, 9, 2, $anio); ?></td>
				<?php }
				if ($mes2 == 10 || $mes2 == 11 || $mes2 == 12) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-10&mes2=' . $anio . '-10'; ?>&sol=2"><?php echo solXMes($conexion, $id, 10, 2, $anio); ?></a></td>
					<?php if ($mes2 == 11 || $mes2 == 12) { ?>
						<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-11&mes2=' . $anio . '-11'; ?>&sol=2"><?php echo solXMes($conexion, $id, 11, 2, $anio); ?></a></td>
					<?php }
					if ($mes2 == 12) { ?>
						<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-12&mes2=' . $anio . '-12'; ?>&sol=2"><?php echo solXMes($conexion, $id, 12, 2, $anio); ?></a></td>
					<?php } ?>
					<td><?php echo solXMes($conexion, $id, 10, 2, $anio) + solXMes($conexion, $id, 11, 2, $anio) + solXMes($conexion, $id, 12, 2, $anio); ?></td>
				<?php } ?>
				<td>
					<?php $total = 0;
					for ($i = 1; $i <= 12; $i++) {
						$total += solXMes($conexion, $id, $i, 2, $anio);
					}
					echo $total;
					?>
				</td>
				<td>
					<?php
					$totalc = 0;
					$total1 = 0;
					$total2 = 0;
					if ($month != $mes2) {
						$total2 = $total / $mes2;
						$totalc = round($total2);
					} else {
						$totalc = round($total / ($mes2 - ($month - 1)));
					}
					echo $totalc;
					?>
				</td>
				<td> <?php echo "%" . number_format(porcentaje($totalc, $totalAnio)); ?></td>
			</tr>
			<tr>
				<td class="" colspan="2">Vendedor</td>
				<?php if ($month == 1) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-01&mes2=' . $anio . '-01'; ?>&est=0&sol=NULL"><?php echo solXMes($conexion, $id, 1, 3, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2) && ($mes2 == 2 ||$mes2 == 3 || $mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)){ ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-02&mes2=' . $anio . '-02'; ?>&est=0&sol=NULL"><?php echo solXMes($conexion, $id, 2, 3, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3) && ($mes2 == 3 || $mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)){ ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-03&mes2=' . $anio . '-03'; ?>&est=0&sol=NULL"><?php echo solXMes($conexion, $id, 3, 3, $anio); ?></a></td>
				<?php }?>
					<td><?php echo solXMes($conexion, $id, 1, 3, $anio) + solXMes($conexion, $id, 2, 3, $anio) + solXMes($conexion, $id, 3, 3, $anio); ?></td>
				<?php
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4) && ($mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-04&mes2=' . $anio . '-04'; ?>&est=0&sol=NULL"><?php echo solXMes($conexion, $id, 4, 3, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5) && ($mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-05&mes2=' . $anio . '-05'; ?>&est=0&sol=NULL"><?php echo solXMes($conexion, $id, 5, 3, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6) && ($mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-06&mes2=' . $anio . '-06'; ?>&est=0&sol=NULL"><?php echo solXMes($conexion, $id, 6, 3, $anio); ?></a></td>
					<td><?php echo solXMes($conexion, $id, 4, 3, $anio) + solXMes($conexion, $id, 5, 3, $anio) + solXMes($conexion, $id, 6, 3, $anio); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7) && ($mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-07&mes2=' . $anio . '-07'; ?>&est=0&sol=NULL"><?php echo solXMes($conexion, $id, 7, 3, $anio);?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8) && ($mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-08&mes2=' . $anio . '-08'; ?>&est=0&sol=NULL"><?php echo solXMes($conexion, $id, 8, 3, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8 || $month == 9) && ($mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-09&mes2=' . $anio . '-09'; ?>&est=0&sol=NULL"><?php echo solXMes($conexion, $id, 9, 3, $anio); ?></a></td>
					<td><?php echo solXMes($conexion, $id, 7, 3, $anio); + solXMes($conexion, $id, 8, 3, $anio); + solXMes($conexion, $id, 9, 3, $anio); ?></td>
				<?php }
				if ($mes2 == 10 || $mes2 == 11 || $mes2 == 12) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-10&mes2=' . $anio . '-10'; ?>&est=0&sol=NULL"><?php echo solXMes($conexion, $id, 10, 3, $anio); ?></a></td>
					<?php if ($mes2 == 11 || $mes2 == 12) { ?>
						<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-11&mes2=' . $anio . '-11'; ?>&est=0&sol=NULL"><?php echo solXMes($conexion, $id, 11, 3, $anio); ?></a></td>
					<?php }
					if ($mes2 == 12) { ?>
						<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-12&mes2=' . $anio . '-12'; ?>&est=0&sol=NULL"><?php echo solXMes($conexion, $id, 12, 3, $anio); ?></a></td>
					<?php } ?> <td><?php echo estXMes($conexion, $id, 10, 3, $anio) + estXMes($conexion, $id, 11, 3, $anio) + estXMes($conexion, $id, 12, 3, $anio);  ?></td>
				<?php } ?>
				<td><?php $total = 0;
					for ($i = 1; $i <= 12; $i++) {
						$total += solXMes($conexion, $id, $i, 3, $anio);
					}
					echo $total;
					?>
				</td>
				<td>
					<?php
					$totalc = 0;
					$total1 = 0;
					$total2 = 0;
					if ($month != $mes2) {
						$total2 = $total / $mes2;
						$totalc = round($total2);
					} else {
						$totalc = round($total / ($mes2 - ($month - 1)));
					}
					echo $totalc;
					?>
				</td>
				<td> <?php echo "%" . porcentaje($totalc, $totalAnio); ?></td>
			</tr>
			<tr>
				<td class="" colspan="2">En Espera</td>
				<?php if ($month == 1) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-01&mes2=' . $anio . '-01'; ?>&est=0&sol=NULL"><?php echo solXMes($conexion, $id, 1, 4, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2) && ($mes2 == 2 ||$mes2 == 3 || $mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)){ ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-02&mes2=' . $anio . '-02'; ?>&est=0&sol=NULL"><?php echo solXMes($conexion, $id, 2, 4, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3) && ($mes2 == 3 || $mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)){ ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-03&mes2=' . $anio . '-03'; ?>&est=0&sol=NULL"><?php echo solXMes($conexion, $id, 3, 4, $anio); ?></a></td>
				<?php }?>
					<td><?php echo solXMes($conexion, $id, 1, 4, $anio) + solXMes($conexion, $id, 2, 4, $anio) + solXMes($conexion, $id, 3, 4, $anio); ?></td>
				<?php
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4) && ($mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-04&mes2=' . $anio . '-04'; ?>&est=0&sol=NULL"><?php echo solXMes($conexion, $id, 4, 4, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5) && ($mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-05&mes2=' . $anio . '-05'; ?>&est=0&sol=NULL"><?php echo solXMes($conexion, $id, 5, 4, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6) && ($mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-06&mes2=' . $anio . '-06'; ?>&est=0&sol=NULL"><?php echo solXMes($conexion, $id, 6, 4, $anio); ?></a></td>
					<td><?php echo solXMes($conexion, $id, 4, 4, $anio) + solXMes($conexion, $id, 5, 4, $anio) + solXMes($conexion, $id, 6, 4, $anio); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7) && ($mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-07&mes2=' . $anio . '-07'; ?>&est=0&sol=NULL"><?php echo solXMes($conexion, $id, 7, 4, $anio);?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8) && ($mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-08&mes2=' . $anio . '-08'; ?>&est=0&sol=NULL"><?php echo solXMes($conexion, $id, 8, 4, $anio); ?></a></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8 || $month == 9) && ($mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-09&mes2=' . $anio . '-09'; ?>&est=0&sol=NULL"><?php echo solXMes($conexion, $id, 9, 4, $anio); ?></a></td>
					<td><?php echo solXMes($conexion, $id, 7, 4, $anio); + solXMes($conexion, $id, 8, 4, $anio); + solXMes($conexion, $id, 9, 4, $anio); ?></td>
				<?php }
				if ($mes2 == 10 || $mes2 == 11 || $mes2 == 12) { ?>
					<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-10&mes2=' . $anio . '-10'; ?>&est=0&sol=NULL"><?php echo solXMes($conexion, $id, 10, 4, $anio); ?></a></td>
					<?php if ($mes2 == 11 || $mes2 == 12) { ?>
						<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-11&mes2=' . $anio . '-11'; ?>&est=0&sol=NULL"><?php echo solXMes($conexion, $id, 11, 4, $anio); ?></a></td>
					<?php }
					if ($mes2 == 12) { ?>
						<td><a target="blank" target="blank" href="index.php?cot=1&id=<?php echo $id . '&mes=' . $anio . '-12&mes2=' . $anio . '-12'; ?>&est=0&sol=NULL"><?php echo solXMes($conexion, $id, 12, 4, $anio); ?></a></td>
					<?php } ?> <td><?php echo estXMes($conexion, $id, 10, 4, $anio) + estXMes($conexion, $id, 11, 4, $anio) + estXMes($conexion, $id, 12, 4, $anio);  ?></td>
				<?php } ?>
				<td><?php $total = 0;
					for ($i = 1; $i <= 12; $i++) {
						$total += solXMes($conexion, $id, $i, 4, $anio);
					}
					echo $total;
					?>
				</td>
				<td>
					<?php
					$totalc = 0;
					$total1 = 0;
					$total2 = 0;
					if ($month != $mes2) {
						$total2 = $total / $mes2;
						$totalc = round($total2);
					} else {
						$totalc = round($total / ($mes2 - ($month - 1)));
					}
					echo $totalc;
					?>
				</td>
				<td> <?php echo "%" . porcentaje($totalc, $totalAnio); ?></td>
			</tr>
			<tr>
				<td colspan="2">TOTAL DE LLAMADAS DE SEGUIMIENTO</td>
				<?php if ($month == 1) { ?>
					<td><?php echo llamMes($conexion, $id, 1, $anio); ?></td>
				<?php }
				if (($month == 1 || $month == 2) && ($mes2 == 2 ||$mes2 == 3 || $mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)){ ?>
					<td><?php echo llamMes($conexion, $id, 2, $anio); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3) && ($mes2 == 3 || $mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)){ ?>
					<td><?php echo llamMes($conexion, $id, 3, $anio); ?></td>
				<?php } ?>
					<td><?php echo (llamMes($conexion, $id, 1, $anio) + llamMes($conexion, $id, 2, $anio) + llamMes($conexion, $id, 3, $anio)); ?></td>
				<?php
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4) && ($mes2 == 4 || $mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><?php echo llamMes($conexion, $id, 4, $anio); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5) && ($mes2 == 5 || $mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><?php echo llamMes($conexion, $id, 5, $anio); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6) && ($mes2 == 6 || $mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><?php echo llamMes($conexion, $id, 6, $anio); ?></td>
					<td><?php echo (llamMes($conexion, $id, 4, $anio) + llamMes($conexion, $id, 5, $anio) + llamMes($conexion, $id, 6, $anio)); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7) && ($mes2 == 7 || $mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><?php echo llamMes($conexion, $id, 7, $anio); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8) && ($mes2 == 8 || $mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><?php echo llamMes($conexion, $id, 8, $anio); ?></td>
				<?php }
				if (($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6  || $month == 7 || $month == 8 || $month == 9) && ($mes2 == 9 || $mes2 == 10 || $mes2 == 11 || $mes2 == 12)) { ?>
					<td><?php echo llamMes($conexion, $id, 9, $anio); ?></td>
					<td><?php echo (llamMes($conexion, $id, 7, $anio) + llamMes($conexion, $id, 8, $anio) + llamMes($conexion, $id, 9, $anio)); ?></td>
				<?php }
				if ($mes2 == 10 || $mes2 == 11 || $mes2 == 12) { ?>
					<td><?php echo llamMes($conexion, $id, 10, $anio); ?></td>
					<?php if ($mes2 == 11 || $mes2 == 12) { ?>
						<td><?php echo llamMes($conexion, $id, 11, $anio); ?></td>
					<?php }
					if ($mes2 == 12) { ?>
						<td><?php echo llamMes($conexion, $id, 12, $anio); ?></td>
					<?php } ?>
					<td><?php echo (llamMes($conexion, $id, 10, $anio) + llamMes($conexion, $id, 11, $anio) + llamMes($conexion, $id, 12, $anio)); ?></td>
				<?php } ?>
				<td>
					<?php
					$total = 0;
					for ($i = 1; $i <= 12; $i++) {
						$total += llamMes($conexion, $id, $i, $anio);
					}
					echo $total;
					?>
				</td>
				<td>
					<?php
					$totalc = 0;
					if ($month != $mes2) {
						$total1 = $total / $month;
						$total2 = $total / $mes2;
						$totalc = round($total1 - $total2);
					} else {
						$totalc = round($total / ($mes2 - ($month - 1)));
					}
					echo $totalc;
					?>
				</td>
				<td>N/A</td>
			</tr>
		</tbody>
	</table>
</div>