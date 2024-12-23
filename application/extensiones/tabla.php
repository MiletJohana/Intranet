<?php
include '../../conexion.php';

if (isset($_POST["buscar"])) {
	$buscar = utf8_decode($_POST["buscar"]);
	$sql = "SELECT * FROM mq_usu,mq_are,mq_reg 
	WHERE mq_usu.id_are=mq_are.id_are 
	AND mq_usu.id_reg=mq_reg.id_reg 
	AND mq_usu.usu_elim='0'
	AND mq_usu.ext_usu!='' 
	AND( 
		id_usu   LIKE '%$buscar%' OR 
		nom_usu  LIKE '%$buscar%' OR 
		usuario  LIKE '%$buscar%' OR 
		eml_usu  LIKE '%$buscar%' OR 
	    fec_crea LIKE '%$buscar%' OR 
		ext_usu  LIKE '%$buscar%' OR 
		nom_are  LIKE '%$buscar%' OR 
		cel_usu  LIKE '%$buscar%' OR 
		nom_reg  LIKE '%$buscar%' OR
		usu_elim LIKE '%$buscar%')
		order by nom_usu";
} else {
	$sql = "SELECT * 
	FROM mq_usu AS u
	INNER JOIN mq_are AS a
	ON u.id_are = a.id_are 
	INNER JOIN mq_reg AS r
	ON u.id_reg = r.id_reg 
	INNER JOIN ind_cargos AS c
	ON u.id_carg = c.id_carg 
	WHERE u.id_are != 10
	AND u.ext_usu != ''
	AND u.usu_elim =0
	ORDER BY nom_usu";
	$query = $conexion->query($sql);

	//echo $sql;
}
if ($query->rowCount() > 0) { ?>

<div class="col-12">
		<div class="table-responsive-lg">
			<table class="table table-sm table-hover font-table" id="tableExtensiones">
				<thead class="table-dark">
					<th>Nombre</th>
					<th>Correo</th>
					<th>Área</th>
					<th>Cargo</th>
					<th>Regional</th>
					<th>Extensión</th>
					<th>Cel</th>
				</thead>
				<?php while ($r = $query->fetch_array()) {
					if ($r['usu_elim'] != 1) { ?>
						<tr>
							<td><?php echo utf8_encode($r["nom_usu"]); ?></td>
							<td><?php echo $r["eml_usu"]; ?></td>
							<td><?php echo utf8_encode($r["nom_are"]); ?></td>
							<td><?php echo utf8_encode($r["nom_carg"]); ?></td>
							<td><?php echo utf8_encode($r["nom_reg"]); ?></td>
							<td><?php echo utf8_encode($r["ext_usu"]); ?></td>
							<td><?php echo utf8_encode($r["cel_usu"]); ?></td>
						</tr>
				<?php }
				} ?>
			</table>
		</div>
	</div>

	
	<script type="text/javascript">
		$(document).ready(function() {
			$('#tableExtensiones').DataTable({
				"ordering": true,
				"aaSorting": [],
				"order": [
					[0, "asc"]
				]
			});
			$('.dataTables_length').addClass('bs-select');
		});
	</script>
<?php } else { ?>
	<div class="col-md-12 mt-4">
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			No hay resultados
			<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	</div>
<?php } ?>