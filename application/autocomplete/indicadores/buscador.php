<?php 
include_once 'consulta.php';
$objUser= new Usuarios();
echo json_encode($objUser->buscar($_GET['term']));
?>