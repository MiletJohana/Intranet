<?php
include '../../conexion.php';
$sql = "SELECT mq_per.id_per,mq_per.nom_per,usu_per.id_usu 
FROM usu_per,mq_per 
WHERE mq_per.id_per=usu_per.id_per AND id_usu=\"$_POST[id_usu]\"";
$query = $conexion->query($sql);
$sql2 = "SELECT * FROM mq_per";
$max = $query->rowCount();
if ($max > 0) {
	while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
		echo '<div class="col-md-4" align="left">
				<input type="checkbox" value="' . $r["id_per"] . '" id="checkbox" name="checkbox[]"> ' . $r["nom_per"] . '
			  </div>';
	}
} else {
	echo "<p>Ya tienes todos los permisos</p>";
}
