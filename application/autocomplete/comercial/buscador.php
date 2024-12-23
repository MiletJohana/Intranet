<?php
include_once 'consulta.php';
$objUser = new Comerciales();
echo json_encode($objUser->buscar($_GET['term']));
