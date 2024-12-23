<?php 
include_once 'consulta.php';
$objUser= new Contactos();
echo json_encode($objUser->buscar($_GET['term']));
?>