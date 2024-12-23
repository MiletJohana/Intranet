<?php
include_once 'consulta.php';
$objUser = new ActEconimica();
echo json_encode($objUser->buscar($_GET['term']));
