<?php
include "../../conexion.php";
$sql = "SELECT * FROM mq_usu where id_usu= $_POST[id_usu];";
$query = $conexion->query($sql);

$r = $query->fetch(PDO::FETCH_ASSOC);

 ?> 

<form role="form" id="form-usuario-perm">

		<?php

			if ($r['usu_elim']==0 || $r['usu_elim']==1) { ?>
			
			<input type="radio" name="usu_elim" id="">Activar
				<input type="radio" name="usu_elim" id="">Desactivar
				
			<?php } else { ?>
				<?php echo '<p>Usuario ya se encuentra activado.</p>'; ?>
				
		<?php
			}
		
		?>


	<input type="hidden" id="id_usu_per" name="id_usu_per" value="<?php echo $_POST['id_usu']; ?>">
	<input type="hidden" id="accion_form_per" name="accion_form_per" value="addPerm">
</form>