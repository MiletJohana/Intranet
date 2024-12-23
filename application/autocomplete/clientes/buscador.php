<?php 
include_once 'consulta.php';
$objUser= new Cliente();
echo json_encode($objUser->buscar($_GET['term']));
?>