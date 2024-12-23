<?php

require_once('ssp.class.php');

include "ssp.conexion.php";

$columns = array(
    array('db' => 'id_coti', 'dt' => 'id_coti'),
    array('db' => 'nom_cns', 'dt' => 'nom_cns'),
    array('db' => 'cns_coti', 'dt' => 'cns_coti'),
    array('db' => 'nom_tip_cot',  'dt' => 'nom_tip_cot'),
    array('db' => 'fec_coti', 'dt' => 'fec_coti'),
    array('db' => 'nom_cli', 'dt' => 'nom_cli'),
    array('db' => 'id_tip_cot', 'dt' => 'id_tip_cot'),
    array('db' => 'doc_coti', 'dt' => 'doc_coti')
);

echo json_encode(
    SSP::simple($_GET, $conn, "cot_historial_view", 'id_coti', $columns)
)

?>