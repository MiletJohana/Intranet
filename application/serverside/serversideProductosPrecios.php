<?php
require_once('ssp.class.php');

include "ssp.conexion.php";

$columns = array(
    array('db' => 'id_prod', 'dt' => 'id_prod'),
    array('db' => 'cod_pro', 'dt' => 'cod_pro'),
    array('db' => 'cod_stock', 'dt' => 'cod_stock'),
    array('db' => 'nom_prod',  'dt' => 'nom_prod'),
    array('db' => 'desc_prod', 'dt' => 'desc_prod'),
    array('db' => 'id_uni_med', 'dt' => 'id_uni_med'),
    array('db' => 'uni_emp', 'dt' => 'uni_emp'),
    array('db' => 'uni_emp_mq', 'dt' => 'uni_emp_mq'),
    array('db' => 'id_fam', 'dt' => 'id_fam'),

    array('db' => 'pre_base', 'dt' => 'pre_base'),
    array('db' => 'precio18', 'dt' => 'precio18'),
    array('db' => 'precio20', 'dt' => 'precio20'),
    array('db' => 'precio22', 'dt' => 'precio22'),
    array('db' => 'precio24', 'dt' => 'precio24')
);

echo json_encode(
    SSP::simple($_GET, $conn, "productos_precios_view", 'id_prod', $columns)
);
