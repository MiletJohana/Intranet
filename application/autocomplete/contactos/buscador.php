<?php
include_once 'consulta.php';
$objUser = new Contacto();
echo json_encode($objUser->buscar($_GET['term']));
