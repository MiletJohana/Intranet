<?php 
include_once 'consulta2.php';
$objUser= new asesor();
echo json_encode($objUser->buscar($_GET['term']));
?>