<?php
require_once('ssp.class.php');

include "ssp.conexion.php";

$columns = array(
    array('db' => 'id_tra', 'dt' => 'id_tra'),
    array('db' => 'tipo', 'dt' => 'tipo'),
    array('db' => 'nom_usu', 'dt' => 'nom_usu'),
    array('db' => 'fec_crea',  'dt' => 'fec_crea'),

    array('db' => 'id_tipo', 'dt' => 'id_tipo'),

    array('db' => 'corr_destino', 'dt' => 'corr_destino'),
    array('db' => 'corr_asunto', 'dt' => 'corr_asunto'),
    array('db' => 'corr_cuerpo', 'dt' => 'corr_cuerpo'),

    array('db' => 'nota_titulo', 'dt' => 'nota_titulo'),
    array('db' => 'nota_contenido', 'dt' => 'nota_contenido'),

    array('db' => 'rec_fecha', 'dt' => 'rec_fecha'),
    array('db' => 'rec_asunto', 'dt' => 'rec_asunto'), 

    array('db' => 'lla_destino', 'dt' => 'lla_destino'),
    array('db' => 'lla_agendar', 'dt' => 'lla_agendar'),
    array('db' => 'lla_observacion', 'dt' => 'lla_observacion')
);

if (isset($_POST['id_cli'])) {
    $id_cli = $_POST['id_cli'];

    echo json_encode(
        SSP::complex($_POST, $conn, "transacciones_view", 'id_tra', $columns, 'id_cli = ' . $id_cli . ' AND id_neg = 0')
    );
} else if (isset($_POST['id_neg'])) {
    $id_neg = $_POST['id_neg'];

    echo json_encode(
        SSP::complex($_POST, $conn, "transacciones_view", 'id_tra', $columns, 'id_neg = ' . $id_neg)
    );
}
