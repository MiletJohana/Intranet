<div class="col-md-12 col-xs-12 col-sm-12">
	<div class="col-md-6 col-xs-12 col-sm-12">
		<h3 align="center"><strong>Resultados Costos diligencias</strong></h3><br>
		<p align="justify">Resultados de efectividad de todas las diligencias realizadas hasta la fecha. Porcentaje correspondiente de todas las diligencia para un total de 100%.</p><br>
		<table class="table table-bordered table-hover col-xs-12 col-sm-12" id="datatable">
				<thead>
					<tr>
						<th>Tipo</th>
						<th>Costos</th>
						<th>Porcentaje</th>
					</tr>
				</thead>
				<tbody>
						<?php while ($r4=$query4->fetch(PDO::FETCH_ASSOC)) {?>
					<tr>
						<td><?php echo $r4['nom_tip_dlg']; ?></td>
						<td><?php echo $r4['costo']; ?></td>
						<td><?php echo number_format((($r4['costo']/$r44['total'])*100),2,'.',''); ?>%</td>
					</tr>
						<?php } ?>
					<tr style="background-color: gray !important;">
						<td>Total</td>
						<td><?php echo $r44['total']; ?></td>
						<td>100%</td>
						
					</tr>
				</tbody>
			</table>
	</div>
	<br>
	<div class="col-md-6 col-xs-12 col-sm-12">
		<form role="form" method="post" action="reporteexcel.php">
			<input type="hidden" name="resp" value="2">
			<div class="row">
				<div class="col-md-6">
					<label class="form-label" style="" >Mes Inicial</label>
					<input type="date" name="dil_mesIn" class="form-control" onchange="" value="<?php echo $year.'-'.$mes; ?>-01" valueAsDate min="2017-12-01" max="<?php echo $e2; ?>" style="width: 170px;">
				</div>
				<div class="col-md-6">
					<label class="form-label" style="">Mes Final</label>
					<input type="date" name="dil_mesFn" class="form-control" onchange="" value="<?php echo $e2; ?>" valueAsDate max="<?php echo $e2; ?>" style="width: 170px;">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<input type="hidden" name="mis_dlg" value="-">
					<input type="hidden" name="action" value="costos">
					<button type="submit" class="btn btn-success" style="color:white;" value=""><i class="fas fa-file-excel"></i> Exportar</button>
				</div>
			</div>
		</form>
	</div>
</div>