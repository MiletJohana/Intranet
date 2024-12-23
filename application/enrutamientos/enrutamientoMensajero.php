<?php
include '../../conexion.php';
$sql = "SELECT dlxen.num_ord,
dlxen.num_dlg,
dl.dir_dlg,
dl.obs_dlg,
dl.dil_des,
dl.est_dlg,
dl.efc_dlg,
dl.cos_dlg,
cli.id_cli,
dl.tel_dlg,
cli.hor_cli,
cli.nom_cli,
dl.con_dlg,
es.nom_est_dlg
FROM mq_clie AS cli
INNER JOIN mq_dlg AS dl
ON cli.id_cli = dl.id_cli 
INNER JOIN mq_dilig_x_enrt AS dlxen
ON dl.num_dlg = dlxen.num_dlg 
INNER JOIN mq_est_dlg AS es
ON dl.est_dlg = es.id_est_dlg
WHERE dlxen.num_enr = $_POST[id] 
ORDER BY LENGTH(dlxen.num_ord), dlxen.num_ord";
$query = $conexion->query($sql);
if ($query->rowCount() > 0) { ?>
	<div class="">
		<button class="btn btn-danger" onclick="volverAEnrutamientos();">Volver</button>
		<table class="table" id="datatable">
			<thead>
				<tr>
					<th>Diligencias</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($r = $query->fetch(PDO::FETCH_ASSOC)) { ?>
					<tr style="font-size: 80%;" onclick="editarDiligencia(<?php echo $r['num_dlg'] . ',' . $_POST['id']; ?>)">
						<td>
							<?php echo $r["nom_cli"]; ?>
							<?php echo $r["con_dlg"]; ?><br>
							<?php echo $r["dil_des"]; ?><br>
							<?php echo $r["dir_dlg"]; ?><br>
							<?php if ($r["est_dlg"] != 2) { ?>
								<p class="text-success">Actualizada</p>
							<?php } ?>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
<?php } ?>