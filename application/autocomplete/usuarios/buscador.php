<?php 
include_once 'consulta.php';
$objUser= new Usuario();
echo json_encode($objUser->buscar($_GET['term']));
?>