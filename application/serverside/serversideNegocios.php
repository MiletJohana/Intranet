<?php
require_once('ssp.class.php');

include "ssp.conexion.php";

$columns = array(
    array('db' => 'id_neg', 'dt' => 'id_neg'),
    array('db' => 'nom_neg', 'dt' => 'nom_neg'),
    array('db' => 'des_neg', 'dt' => 'des_neg'),
    array('db' => 'obs_neg', 'dt' => 'obs_neg'),
    array('db' => 'val_neg', 'dt' => 'val_neg'),
    array('db' => 'neg_cat', 'dt' => 'neg_cat'),

    array('db' => 'id_est', 'dt' => 'id_est'),
    array('db' => 'estado', 'dt' => 'estado'),

    array('db' => 'id_tipo', 'dt' => 'id_tipo'),
    array('db' => 'nom_tipo', 'dt' => 'nom_tipo'),

    array('db' => 'id_cli',  'dt' => 'id_cli'),
    array('db' => 'nom_cli', 'dt' => 'nom_cli')
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
