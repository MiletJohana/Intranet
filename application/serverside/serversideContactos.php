<?php
require_once('ssp.class.php');

include "ssp.conexion.php";

$columns = array(
    array('db' => 'id_cont', 'dt' => 'id_cont'),
    array('db' => 'id_cli', 'dt' => 'id_cli'),
    array('db' => 'num_doc', 'dt' => 'num_doc'),
    array('db' => 'nom_cli',  'dt' => 'nom_cli'),
    array('db' => 'nom_cont', 'dt' => 'nom_cont'),
    array('db' => 'tel_cont', 'dt' => 'tel_cont'),
    array('db' => 'eml_cont', 'dt' => 'eml_cont'),
    array('db' => 'car_cont', 'dt' => 'car_cont')
);

echo json_encode(
    SSP::simple($_POST, $conn, "contactos_view", 'id_cont', $columns)
);
