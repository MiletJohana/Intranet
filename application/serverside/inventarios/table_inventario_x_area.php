<?php

// VIEW

/* create VIEW inv_inventario_x_area_view 
AS SELECT inv.id_inv, inv.id_prod, prod.nom_prod, prod.img_prod, inv.cantidad, area.can_max, inv.id_reg, area.id_are
FROM inv_inventario AS inv
INNER JOIN inv_product AS prod
ON inv.id_prod = prod.id_prod
INNER JOIN inv_prod_x_are AS area
ON area.id_prod = prod.id_prod */


require( '../ssp.conexion.php' );
require( '../ssp.class.php' );

$table = 'inv_inventario_x_area_view';
$primaryKey = 'id_prod';

$id_reg = $_POST['reg'];
$id_are = $_POST['are'];

$columns = array(
    array( 'db' => 'id_inv', 'dt' => 'id_inv' ),
    array( 'db' => 'id_prod', 'dt' => 'id_prod' ),
    array( 'db' => 'nom_prod', 'dt' => 'nom_prod' ),
    array( 'db' => 'img_prod', 'dt' => 'img_prod' ),
    array( 'db' => 'can_max', 'dt' => 'can_max' ),
    array( 'db' => 'id_reg', 'dt' => 'id_reg' ),
    array( 'db' => 'id_are', 'dt' => 'id_are' ),
);

echo json_encode(
    SSP::complex($_POST, $conn, $table, $primaryKey, $columns, 'cantidad != 0 AND id_reg =' .$id_reg. ' AND id_are =' .$id_are)
);
