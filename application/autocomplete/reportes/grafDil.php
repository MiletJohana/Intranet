<div class="col-12">
		<div class="col-md-5">
			<h3 align="center"><strong>Resultados Diligencias</strong></h3>
			<br>
			<div id="table">
				<?php if($query->rowCount()>0){ ?>

				<p align="justify">Resultados de las diligencias realizadas en el rango del mes mostrado o solicitado. Porcentaje correspondiente por tipo de diligencia de un total de 100%.</p><br>
				<table class="table table-bordered table-hover" id="datatable">
					<thead>
						<tr>
							<th>Tipo Diligencia</th>
							<th>Cantidad</th>
							<th>Porcentaje</th>
						</tr>
					</thead>
					<tbody>
							<?php while ($r=$query->fetch(PDO::FETCH_ASSOC)) { ?>
						<tr>
							<td><?php echo $r['nom_tip_dlg']; ?></td>
							<td><?php echo $r['cant']; ?></td>
							<td><?php echo number_format((($r['cant']/$r2['cant'])*100),2,'.',''); ?>%</td>
						</tr>
							<?php } ?>
						<tr style="background-color: gray !important;">
							<td>Total</td>
							<td><?php echo $r2['cant']; ?></td>
							<td>100%</td>
							
						</tr>
					</tbody>
				</table>
			<?php }else{ ?>
				<div class="alert alert-success alert-dismissible fade show mt-4 d-flex align-items-center" role="alert">
					<i class="fa-solid fa-circle-check me-3 fa-xl"></i>
					No hay resultados disponibles.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        		</div>
				<div style="height: 360px;"></div>
			<?php } ?>
			</div>
		</div>
		<br>
		<div class="col-md-7 col-sm-12 col-xs-12">
		<form role="form" method="POST" action="reporteexcel.php">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-4">
							<label class="form-label" style="">Mes Inicial</label>
							<input type="date" name="dil_mesIn" class="form-control" onchange="tipDil();" value="<?php echo $year.'-'.$mes; ?>-01" valueAsDate min="2017-12-01" max="<?php echo $e2; ?>" style="width: 170px;">
						</div>
						<div class="col-md-4">
							<label class="form-label" style="">Mes Final</label>
							<input type="date" name="dil_mesFn" class="form-control" onchange="tipDil();" value="<?php echo $e2; ?>" valueAsDate max="<?php echo $e2; ?>" style="width: 170px;">
						</div>
						<div class="col-md-4">
							<label class="form-label" style="font-size: 16px;">Usuario</label>
							<select class="form-control" style="width: 170px;" name="mis_dlg" onchange="tipDil();">
								<option value="-">Todas las diligencias</option>
									<option value="<?php echo $sesion_id; ?>"><?php echo ucwords(strtolower($sesion_nom)); ?></option>
									<?php 
									$sql9="SELECT * from mq_usu where usuario !='$usu'";
									$query9=$conexion->query($sql9);
									while ($r9=$query9->fetch(PDO::FETCH_ASSOC)) { ?>
										<option value="<?php echo $r9['usuario']; ?>"><?php echo ucwords(strtolower($r9['nom_usu'])); ?></option>
									<?php } ?>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<button type="submit" class="btn btn-success" style="color:white; margin-bottom: 25px;" value=""><i class="fas fa-file-excel"></i> Exportar</button>
						</div>
					</div>
				</div>
		</form>
		<div class="col-md-12 col-xs-12 col-sm-12">
			<div id="grafica" style="height: 300px; margin-bottom: 50px;"></div>
		</div>
	<?php include 'grafica.php'; ?>
	</div>
	<hr>
</div>