<?php 
include '../../conexion.php';
include "../../resources/template/credentials.php";
date_default_timezone_set("America/Bogota");
if (isset($_POST['action'])) {
	switch ($_POST['action']) {
        case 'dark':
            $sql = "UPDATE mq_usu SET dark = " . $_POST['param'] . " WHERE mq_usu.id_usu = " . $_SESSION['id'];
            $query = $conexion->query($sql);
            if ($query != null) {
				//echo "listo";
			} else {
				printf("Errormessage: %s\n", $conexion->error);
			}
        break;
        case 'size':
            $sql = "UPDATE mq_usu SET nav_size = 'py-md-" . $_POST['param'] . "' WHERE mq_usu.id_usu = " . $_SESSION['id'];
            $query = $conexion->query($sql);
            if ($query != null) {
				//echo "listo";
			} else {
				printf("Errormessage: %s\n", $conexion->error);
			}
        break;
        case 'theme':
            $sql = "UPDATE mq_usu SET theme = " . $_POST['param'] . " WHERE mq_usu.id_usu = " . $_SESSION['id'];
            $query = $conexion->query($sql);
            if ($query != null) {
				//echo "listo";
			} else {
				printf("Errormessage: %s\n", $conexion->error);
			}
        break;
    }
}