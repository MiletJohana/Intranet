<?php 
include '../../conexion_fenaseo.php';
include "../../resources/template/credentials.php";
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d H:i:s");

//echo var_dump($_POST);

if (isset($_POST['action'])) {
	switch ($_POST['action']) {
		case 'add':
            $consultas = '';
            foreach ($_POST['escala'] as $key => $value_escala) {
                $consultas .= "INSERT INTO wpgb_escala_producto(id_producto, escala, precio, vol_min, color, id_usu, fec_crea) VALUES (" . $_POST['id_product'] . ", " . $value_escala . ", '" .$_POST['precio'][$key]. "', '".$_POST['vol_min'][$key]."', '".$_POST['color'][$key]."', '" . $_SESSION['id'] . "', '" . $fecha . "');";
            }
			
			$query = $conexion->query($consultas);
			if ($query != null) {
				echo 1;
			} else {
				printf("Errormessage: %s\n", $conexion->error);
			}
                 
			break;

		case 'update':
			$sqlInfo = "SELECT * FROM wpgb_escala_producto WHERE id = ".$_POST['id_escala_product'].";";
			$queryInfo = $conexion->query($sqlInfo);
			$rowInfo = $queryInfo->fetch(PDO::FETCH_OBJ);

			$info_update = [];

			if($rowInfo->escala != $_POST['escala'][0]){
				$info_update[] = "escala = '".$_POST['escala'][0]."'";
			}
			if($rowInfo->precio != $_POST['precio'][0]){
				$info_update[] = "precio = '".$_POST['precio'][0]."'";
			}
			if($rowInfo->vol_min != $_POST['vol_min'][0]){
				$info_update[] = "vol_min = '".$_POST['vol_min'][0]."'";
			}
			if($rowInfo->color != $_POST['color'][0]){
				$info_update[] = "color = '".$_POST['color'][0]."'";
			}

			if(count($info_update) != 0){
				$sqlUpdate = "UPDATE wpgb_escala_producto SET ";
				$sqlUpdate .= join(', ', array_values($info_update));
				$sqlUpdate .= " WHERE id = ".$_POST['id_escala_product'].";";

				$queryUpdate = $conexion->query($sqlUpdate);
				if ($queryUpdate != null) {
					echo 1;
				} else {
					printf("Errormessage: %s\n", $conexion->error);
				}
			} else {
				echo 2;
			}
			
			break;

	}
}