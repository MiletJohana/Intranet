<?php
require_once('ssp.class.php');

include "ssp.conexion.php";

$columns = array(
    array('db' => 'id_sol', 'dt' => 'id_sol'),

    array('db' => 'id_cli',  'dt' => 'id_cli'),
    array('db' => 'nom_cli', 'dt' => 'nom_cli'),

    array('db' => 'id_cont',  'dt' => 'id_cont'),
    array('db' => 'nom_cont', 'dt' => 'nom_cont'),

    array('db' => 'fec_sol', 'dt' => 'fec_sol'),
    array('db' => 'ase_com', 'dt' => 'ase_com'),
    
    array('db' => 'id_usu', 'dt' => 'id_usu'),
    array('db' => 'nom_usu', 'dt' => 'nom_usu')

);

if (isset($_GET['id_cli']) && $_GET['id_cli'] != 0) {
    echo json_encode(
        SSP::complex($_GET, $conn, "negocios_view", 'id_neg', $columns, 'id_cli = ' . $_GET['id_cli'])
    );
} else {
    echo json_encode(
        SSP::simple($_GET, $conn, "negocios_view", 'id_neg', $columns)
    );
}