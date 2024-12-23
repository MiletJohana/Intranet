<?php
include "../../conexion.php";
$sql = "SELECT * FROM mq_per  WHERE id_per IN (1,2,3,5,6,7,9,10,12,13,15,16,18,19,23,24,25,26,27,28,29,30,32,33,34,35,36);";
$query = $conexion->query($sql);
$sql1 = "SELECT id_per from usu_per where id_usu= $_POST[id_usu]";
$query1 = $conexion->query($sql1);
$per = array();
while ($r1 = $query1->fetch(PDO::FETCH_ASSOC)) {
	array_push($per, $r1["id_per"]);
} ?>
<form role="form" id="form-usuario-perm">
	<style>
		li {
			list-style: none;
		}
	</style>
	<ul class="ps-0">
		<?php
		while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
			if (isset($r["padre"])) { ?>
				<ul>
					<li>
						<label>
							<input type="checkbox" name="id_perm[]" value="<?php echo $r["id_per"]; ?>" <?php if (in_array($r["id_per"], $per)) {
																											echo "checked";
																										} ?>>
							<?php echo $r["nom_per"]; ?>
						</label>
					</li>
				</ul>
			<?php } else { ?>
				<li>
					<?php echo $r["nom_per"]; ?>
				</li>
		<?php
			}
		}
		?>
	</ul>

	<input type="hidden" id="id_usu_per" name="id_usu_per" value="<?php echo $_POST['id_usu']; ?>">
	<input type="hidden" id="accion_form_per" name="accion_form_per" value="addPerm">
</form>