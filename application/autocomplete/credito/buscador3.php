<?php 
include_once 'consulta3.php';
$objUser= new search();
echo json_encode($objUser->buscar($_GET['term']));
?>