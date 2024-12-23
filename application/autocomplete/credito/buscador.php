<?php 
include_once 'consulta.php';
$objUser= new Solicitud();
echo json_encode($objUser->buscar($_GET['term']));
?>