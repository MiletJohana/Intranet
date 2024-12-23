<?php
include '../../conexion.php';
include '../../resources/template/credentials.php';
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");
if (isset($_POST['action'])) {
	switch ($_POST['action']) {
		case 'add':
			//  Datos iniciales
			$orden = 0;
			$sql1 = "SELECT max(num_enr) FROM mq_dilig_x_enrt";
			$query1 = $conexion->query($sql1);
			$r = $query1->fetch(PDO::FETCH_ASSOC);
			$fijo = $r['max(num_enr)'] + 1;
			$variable = $_POST['data'];
			$total = count($variable);
			//print_r($variable);
			//echo $total;
			//Insercion de datos
			$sql2 = "INSERT INTO mq_enrt(num_enr,fec_enr, fec_crea, usu_upt, lst_upt, est_enr, id_reg) 
					         	VALUES ('$fijo','$fecha','$fecha','$sesion_usu','$fecha','NUEVA','$sesion_reg')";
			$query2 = $conexion->query($sql2);
			if ($query2) {

				for ($i = 0; $i < $total; $i++) {
					$orden = $i + 1;
					$sql3 = "INSERT INTO mq_dilig_x_enrt (num_dlg,num_enr,num_ord) VALUES ($variable[$i],$fijo,$orden)";
					$query3 = $conexion->query($sql3);
                    //echo $sql3;
					$sql4 = "SELECT est_dlg from mq_diligencias WHERE num_dlg='$variable[$i]'";
					$query4 = $conexion->query($sql4);
					$r = $query4->fetch(PDO::FETCH_ASSOC);
					$r4 = $r["est_dlg"];
					$sql5 = "UPDATE mq_diligencias SET est_dlg='2' WHERE num_dlg='$variable[$i]'";
					$query5 = $conexion->query($sql5);

					$sql6 = "INSERT INTO mq_hist(fec_act,num_dlg,usu_upt,est_ant,est_dlg,efec_dlg) 
												  VALUES ('$fecha','$variable[$i]','$sesion_usu','$r4','2','NO')";
					$query6 = $conexion->query($sql6);
				}
			}

			if ($query2 != null) {
				echo 'Enrutamiemto creado correctamente.';
			} else {
				printf("Errormessage: %s\n", $conexion->error);
			}
			break;


		case 'update':
			$count = "SELECT COUNT(num_dlg) AS num FROM mq_dilig_x_enrt WHERE num_enr='" . $_POST['num_enr'] . "'";
			$queryC = $conexion->query($count);
			$r = $queryC->fetch(PDO::FETCH_ASSOC);
			$total = $r['num'];
			$enr = 0;
			for ($i = 1; $i <= $total; $i++) {
				$sql = "SELECT num_dlg FROM mq_dilig_x_enrt	WHERE num_enr='" . $_POST['num_enr'] . "' AND num_ord='$i'";
				$query = $conexion->query($sql);
				$s = $query->fetch(PDO::FETCH_ASSOC);
				$r = $s["num_dlg"];
				$obs = $_POST["obs_enr"][$i - 1];
				$cos = $_POST["cos_dlg"][$i - 1];
				if ($_POST["efec_enr"][$i - 1] == "true") {
					$sql2 = "UPDATE mq_diligencias 
					SET obs_dlg='$obs',
						efc_dlg='1',
						est_dlg='4',
						lst_upt='$fecha',
						cos_dlg='$cos',
						usu_upt='$sesion_usu'
						WHERE num_dlg=$r";
					$query2 = $conexion->query($sql2);
					$sql3 = "INSERT INTO mq_hist(fec_act,num_dlg,usu_upt,est_ant,est_dlg,efec_dlg) 
	  							  VALUES ('$fecha','$r','$sesion_usu','2','4','SI')";
					$query3 = $conexion->query($sql3);
					$enr = $enr + 1;
				} else {
					$sql2 = "UPDATE mq_diligencias 
						SET obs_dlg='$obs',
							efc_dlg='0',
							est_dlg='3',
							lst_upt='$fecha',
							cos_dlg='$cos',
							usu_upt='$sesion_usu'
							WHERE num_dlg=$r";
					$query2 = $conexion->query($sql2);
					$sql3 = "INSERT INTO mq_hist(fec_act,num_dlg,usu_upt,est_ant,est_dlg,efec_dlg) 
					  							  VALUES ('$fecha','$r','$sesion_usu','2','3','NO')";
					$query3 = $conexion->query($sql3);
				}
			}
			if ($enr == $total) {
				$sql3 = "UPDATE mq_enrt
				      SET est_enr='EFECTIVA',
						  lst_upt='$fecha',
						  usu_upt='$sesion_usu',
						  cos_enr='" . $_POST['cos_enr'] . "'
						  WHERE num_enr='" . $_POST['num_enr'] . "'";
				$query3 = $conexion->query($sql3);
			} else {
				$sql3 = "UPDATE mq_enrt
				      SET est_enr='INCOMPLETA',
						  lst_upt='$fecha',
						  usu_upt='$sesion_usu',
						  cos_enr='" . $_POST['cos_enr'] . "'
						  WHERE num_enr='" . $_POST['num_enr'] . "'";

				$query3 = $conexion->query($sql3);
			}

			if ($query2 != null && $query3 != null) {
				echo 'Enrutamiento actualizado correctamente.';
			} else {
				printf("Errormessage: %s\n", $conexion->error);
				echo $sql3;
				echo $sql2;
				echo $sql;
			}
			break;

		case 'delete':
			$sql2 = "SELECT num_dlg FROM mq_dilig_x_enrt WHERE num_enr='" . $_POST['num_enr'] . "'";
			$query2 = $conexion->query($sql2);
			while ($r = $query2->fetch(PDO::FETCH_ASSOC)) {
				$sql3 = "UPDATE mq_diligencias SET est_dlg='3', usu_upt='$sesion_usu', lst_upt='$fecha' 
					WHERE num_dlg='" . $r['num_dlg'] . "'";
				$query3 = $conexion->query($sql3);
			}
			$sql4 = "DELETE FROM mq_dilig_x_enrt WHERE num_enr='" . $_POST['num_enr'] . "'";
			$query4 = $conexion->query($sql4);
			$sql = "DELETE FROM mq_enrt WHERE num_enr='" . $_POST['num_enr'] . "'";
			$query = $conexion->query($sql);

			if ($query != null && $query4 != null) {
				echo 'Enrutamiento eliminado correctamente.';
			} else {
				printf("Errormessage: %s\n", $conexion->error);
			}
			break;

		case 'updateEnru':
			$sql3 = "UPDATE mq_enrt SET est_enr='EN RUTA' WHERE num_enr=" . $_POST["num_enr"];
			$query3 = $conexion->query($sql3);

			if ($query3 != null) {
				echo "1";
			} else {
				echo $sql3;
			}
			break;
	}
} else {
	echo "no sirve";
	$sesion_usu = $_SESSION["usu"];
	echo $sesion_usu;
}
