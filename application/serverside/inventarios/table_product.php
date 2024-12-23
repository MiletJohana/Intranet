<?php

require( '../ssp.conexion.php' );
require( '../ssp.class.php' );

$table = 'inv_product';
$primaryKey = 'id_prod';

$columns = array(
    array( 'db' => 'id_prod', 'dt' => 'id_prod' ),
    array( 'db' => 'nom_prod', 'dt' => 'nom_prod' ),
    array( 'db' => 'desc_prod', 'dt' => 'desc_prod' ),
    array( 'db' => 'img_prod', 'dt' => 'img_prod' ),
    array( 'db' => 'req_aprob', 'dt' => 'req_aprob' ),
);

echo json_encode(
    SSP::complex($_POST, $conn, $table, $primaryKey, $columns, 'prod_elim = 0')
);

?>

