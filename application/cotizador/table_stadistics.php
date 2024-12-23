<?php
if (isset($_POST['resp'])) {
	include '../../conexion.php';
	include "../../resources/template/credentials.php";
}

if (isset($month)) {
	$mes = date("Y-01");
} else {
	$mes = date("Y-m");
}
$sql1 = "SELECT id_car,nom_car FROM cot_tip_cotizador";
if (isset($_GET['id'])) {
	$action = 'GET';
	include 'filtroConsulta.php';
} else if (!isset($_POST['id_usu'])) {
	$action = 'Index';
	include 'filtroConsulta.php';
} else {
	$action = 'POST';
	include 'filtroConsulta.php';
}
$query1 = $conexion->query($sql1);
/*if ($_SESSION['id']== 1032472569){
	echo $sql1;
   }*/
?>
<div class="row justify-content-center mt-1 p-0 mx-0">
	<div class="col-md-5 table-responsive">
		<table class="table table-bordered table-hover table2" id="table_stats">
			<thead class="table-dark text-center">
				<tr>
					<th>Estado de las cotizaciones</th>
					<th>Cantidad</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<?php $f = null;
				while ($rest = $queryest-> fetch(PDO::FETCH_ASSOC)) {
					$f += 1; ?>
					<tr>
						<td><?php echo $rest["estado"]; ?></td>
						<td><?php echo $rest["cantidad"]; ?></td>
						<td><?php echo '$' . number_format($rest["total"]); ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<div class="col-md-4 table-responsive">
		<table class="table table-bordered table-hover table2">
			<thead class="table-dark text-center">
				<tr>
					<th>Total Cotizado</th>
					<th>Total aprobado</th>
					<th>Total perdido</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($prec = $queryprec-> fetch(PDO::FETCH_ASSOC)) { ?>
					<tr>
						<?php if ($prec["total"] == "") {
							echo '<td>$';
							echo number_format($precTot["totCot"]);
							echo '</td>
									<td>$0</td>
									<td>$';
							echo number_format($precTot["totCot"] - $prec["total"]);
							echo '</td>';
						} else {
							echo '<td>$' . number_format($precTot["totCot"]) . '</td>
								<td>$' . number_format($prec["total"]) . '</td>
								<td>$' . number_format(($precTot["totCot"] - $prec["total"])) . '
								</td>';
						} ?>
					</tr>
				<?php }
				?>
			</tbody>
		</table>
	</div>
</div>