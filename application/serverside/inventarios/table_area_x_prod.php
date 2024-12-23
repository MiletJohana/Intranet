<?php

// VIEW

/* create VIEW inv_prod_x_are_view AS
SELECT group_concat(prod_are.id separator ', ') AS id, group_concat(prod_are.id_prod separator ', ') AS id_products, prod_are.id_are, group_concat(prod_are.can_max separator ', ') AS cant_max, are.nom_are, group_concat(prod.nom_prod separator ', ') AS nombre_products, group_concat(prod.img_prod separator ', ') AS img_products FROM inv_prod_x_are prod_are 
INNER JOIN mq_are are ON  prod_are.id_are = are.id_are
INNER JOIN inv_product prod ON  prod_are.id_prod = prod.id_prod
group by prod_are.id_are; */


require( '../ssp.conexion.php' );
require( '../ssp.class.php' );

$table = 'inv_prod_x_are_view';
$primaryKey = 'id';

$columns = array(
    array( 'db' => 'nom_are', 'dt' => 'nom_are' ),
    array( 'db' => 'id', 'dt' => 'id' ),
    array( 'db' => 'id_are', 'dt' => 'id_are' ),
    array( 'db' => 'id_products', 'dt' => 'id_products' ),
    array( 'db' => 'nombre_products', 'dt' => 'nombre_products' ),
    array( 'db' => 'img_products', 'dt' => 'img_products' ),
    array( 'db' => 'cant_max', 'dt' => 'cant_max' ),
);

echo json_encode(
    SSP::simple($_POST, $conn, $table, $primaryKey, $columns)
);



