<?php 
include_once 'consulta.php';
$objProduct= new Productos();
echo json_encode($objProduct->buscar($_GET['term'],$_GET['id_are']));
?>