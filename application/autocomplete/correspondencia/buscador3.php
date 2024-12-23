<?php 
include_once 'consulta3.php';
$objUser= new buscador();
echo json_encode($objUser->buscar($_GET['term']));
?>