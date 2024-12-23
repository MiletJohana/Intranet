<?php 
include_once 'consulta.php';
$objUser= new prov();
echo json_encode($objUser->buscar($_GET['term']));
?>