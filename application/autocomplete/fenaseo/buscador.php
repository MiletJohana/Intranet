<?php 
include_once 'consulta.php';
$objUser= new Producto();
echo json_encode($objUser->buscar($_GET['term']));
?>