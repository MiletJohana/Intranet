<?php 
include_once 'consulta.php';
$objUser= new Visita();
echo json_encode($objUser->buscar($_GET['term']));
?>