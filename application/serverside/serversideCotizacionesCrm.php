<?php

require_once('ssp.class.php');

include "ssp.conexion.php";

$columns = array(
    array('db' => 'id_coti', 'dt' => 'id_coti'),
    array('db' => 'doc_coti', 'dt' => 'doc_coti'),
    array('db' => 'nom_cns', 'dt' => 'nom_cns'),
    array('db' => 'cns_coti',  'dt' => 'cns_coti'),
    array('db' => 'nom_cont', 'dt' => 'nom_cont'),
    array('db' => 'fec_coti', 'dt' => 'fec_coti'),
    array('db' => 'nom_est', 'dt' => 'nom_est'),
    array('db' => 'id_tip_cot', 'dt' => 'id_tip_cot'),
    array('db' => 'id_cli', 'dt' => 'id_cli'),
    array('db' => 'id_usu', 'dt' => 'id_usu'),
    array('db' => 'id_cont', 'dt' => 'id_cont'),
    array('db' => 'doc_coti', 'dt' => 'doc_coti')
);

if (isset($_GET['id_cli']) && $_GET['id_cli'] != '') {
    echo json_encode(
        SSP::complex($_GET, $conn, "cot_crm_view", 'id_coti', $columns, 'id_cli = ' . $_GET['id_cli'])
    );
}
