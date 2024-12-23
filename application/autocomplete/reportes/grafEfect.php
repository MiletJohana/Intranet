<div class="col-md-12 col-xs-12 col-sm-12" style="margin-bottom: 30px;">
	<div class="row">
		<div class="col-md-6 col-xs-12 col-sm-12" id="container2" style="min-width: 270px; height: 300px; max-width: 490px; margin: 0 auto"></div>
		<div class="col-md-6 col-xs-12 col-sm-12">
			<h3 align="center"><strong>Resultados efectividad de las diligencias</strong></h3><br>
			<p align="justify">Resultados de efectividad de todas las diligencias realizadas hasta la fecha. Porcentaje correspondiente de todas las diligencia para un total de 100%.</p><br>
			<table class="table table-bordered table-hover col-xs-12 col-sm-12" id="datatable">
					<thead>
						<tr>
							<th>Efectividad</th>
							<th>Cantidad</th>
							<th>Porcentaje</th>
						</tr>
					</thead>
					<tbody>
							<?php 
							$sql3="SELECT COUNT(efc_dlg) as cant,efc_dlg from mq_dlg WHERE efc_dlg is not null group by efc_dlg"; 
							$query3=$conexion->query($sql3);
							$sql33="SELECT COUNT(efc_dlg) as cant,efc_dlg from mq_dlg";
							$query33=$conexion->query($sql33);
							$r33=$query33->fetch(PDO::FETCH_ASSOC);
							while ($r3=$query3->fetch(PDO::FETCH_ASSOC)) {
							?>
						<tr>
							<td><?php if($r3['efc_dlg']==1){ echo 'SI';}else{echo "NO";} ?></td>
							<td><?php echo $r3['cant']; ?></td>
							<td><?php echo number_format((($r3['cant']/$r33['cant'])*100),2,'.',''); ?>%</td>
						</tr>
							<?php } ?>
						<tr style="background-color: gray !important;">
							<td>Total</td>
							<td><?php echo $r33['cant']; ?></td>
							<td>100%</td>
							
						</tr>
					</tbody>
				</table>
		</div>
	</div>
</div>