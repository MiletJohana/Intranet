<?php 
include_once 'consulta1.php';
$objUser= new Lider();
echo json_encode($objUser->buscar($_GET['term']));
?>