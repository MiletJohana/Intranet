<?php 
include_once 'consulta4.php';
$objUser= new sac();
echo json_encode($objUser->buscar($_GET['term']));
?>