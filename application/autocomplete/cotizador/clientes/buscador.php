<?php 
include_once 'consulta.php';
$objUser= new Clientes();
echo json_encode($objUser->buscar($_GET['term']));
?>