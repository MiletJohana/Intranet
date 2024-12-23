<?php 
include '../../conexion.php';
include "../../resources/template/credentials.php";
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");
$fechaFirm = date("Y-m-d", strtotime($_POST['fec_firm']));
$fechaInd = date("Y-m-d", strtotime($fechaFirm . "+ 6 month"));
if (isset($_POST['action'])) {
	switch ($_POST['action']) {
		case 'add':
			$con = $_POST["con_usu"];
			$cifra = password_hash($con, PASSWORD_DEFAULT);
			$sql = "INSERT INTO mq_usu(id_usu, 
									   nom_usu, 
									   usuario, 
									   con_usu, 
									   eml_usu, 
									   fec_crea, 
									   fec_firm, 
									   fec_ind, 
									   usu_upt, 
									   id_are, 
									   id_reg, 
									   id_perf, 
									   id_rol,
									   rol_inv,
									   ext_usu,
									   cel2_usu,
									   usu_elim,
									   grup_car,
									   id_tipu,
									   cel_usu,
									   nom_cns,
									   cns_cotz,
									   id_tipumq,
									   num_perfil,
									   id_lider,
									   id_carg,
									   theme)
							VALUES ('" . $_POST['id_usu'] . "',
									'" . $_POST['nom_usu'] . "',
									'" . $_POST['usuario'] . "',
									'$cifra',
									'" . $_POST['eml_usu'] . "',
									'$fecha',
									'$fechaFirm',
									'$fechaInd',
									'$sesion_usu',
									'" . $_POST['id_are'] . "',
									'" . $_POST['id_reg'] . "',
									'',
									'" . $_POST['id_rol'] . "',
									'" . $_POST['rol_inv'] . "',
									" . $_POST['ext_usu'] . ",
									" . $_POST['cel2_usu'] . ",
									'0',
									'" . $_POST['grup_car'] . "',
									'" . $_POST['id_tipu'] . "',
									" . $_POST['cel_usu'] . ",
									'" . $_POST['nom_cns'] . "',
									'" . $_POST['cns_cotz'] . "',
									'" . $_POST['id_tipumq'] . "',
									'" . $_POST['perfil_usu'] . "',
									'" . $_POST['id_lider33'] . "',
									'" . $_POST['id_carg'] . "',
									'1')";
			$query = $conexion->query($sql);
			if ($query != null) {
				echo "Usuario " .$_POST['usuario']. " agregado correctamente.";
			} else {
				printf("Errormessage: %s\n", $conexion->error);
			}
			break;

		case 'update':
			if ($_POST["con_usu"] != '') {
				$con = $_POST["con_usu"];
				$cifra = password_hash($con, PASSWORD_DEFAULT);
			}
			$sql = "UPDATE mq_usu SET   nom_usu =   '" . $_POST['nom_usu'] . "',
										usuario =   \"$_POST[usuario]\",";
			if ($_POST["con_usu"] != '') {
				$sql .= "con_usu	='$cifra',";
			}
			$sql .= " eml_usu =	\"$_POST[eml_usu]\",
			        					usu_upt =	'$sesion_usu',
			        					id_are	=	\"$_POST[id_are]\",
			        					id_reg	=	\"$_POST[id_reg]\",
										id_rol  =   \"$_POST[id_rol]\",
										rol_inv =   \"$_POST[rol_inv]\",
										id_perf	=	'',
										ext_usu	=	'" . $_POST['ext_usu'] . "',
										cel2_usu=	'" . $_POST['cel2_usu'] . "',
										grup_car=	'" . $_POST['grup_car'] . "',
										id_tipu =	'" . $_POST['id_tipu'] . "',
										cel_usu	=   '" . $_POST['cel_usu'] . "',
										nom_cns	=	'" . $_POST['nom_cns'] . "',
										cns_cotz=	'" . $_POST['cns_cotz'] . "',
										id_tipumq=	'" . $_POST['id_tipumq'] . "',
										num_perfil=	'" . $_POST['perfil_usu'] . "',
										id_lider=  '" . $_POST['id_lider33'] . "',
										id_carg=  '" . $_POST['id_carg'] . "'
			        			  WHERE id_usu	=	\"$_POST[id_usu]\"";
			$query = $conexion->query($sql);
			if ($query != null) {
				echo "Usuario actualizado correctamente.";
			} else {
				echo $sql;
				//printf("Errormessage: %s\n", $conexion->error);
			}

			break;

		case 'delete':
			$sql = "UPDATE mq_usu SET   usu_elim = 1  WHERE id_usu = \"$_POST[id_usu]\"";
			$query = $conexion->query($sql);
			if ($query != null) {
				echo "Usuario eliminado correctamente.";
			} else {
				printf("Errormessage: %s\n", $conexion->error);
			}
			break;

		case 'addPerm':
			$sql = "DELETE FROM usu_per where id_usu=$_POST[id_usu_per]";
			$query = $conexion->query($sql);
			$per = $_POST["id_per"];

			if ($per != null) {
				foreach ($per as $r) {
					$sql1 = "INSERT INTO usu_per values($_POST[id_usu_per],$r)";
					$query1 = $conexion->query($sql1);
				}
			}
			if ($query != null) {
				echo "Permisos actualizados correctamente.";
			} else {
				echo $sql;
				//printf("Errormessage: %s\n", $conexion->error);
			}
			break;

		case 'updateContra':
			$con = $_POST["con_usu"];
			$cifra = password_hash($con, PASSWORD_DEFAULT);
			$sql = "UPDATE mq_usu SET con_usu='$cifra'";
			$query = $conexion->query($sql);
			if ($query != null) {
				echo "Contraseña actualizada correctamente.";
			} else {
				echo $sql;
				//printf("Errormessage: %s\n", $conexion->error);
			}
			break;
	}
}
