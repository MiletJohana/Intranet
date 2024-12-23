<?php

// VIEW

/* create VIEW inv_inventario_view 
AS SELECT inv.id_inv, inv.id_prod, prod.nom_prod, prod.img_prod, inv.cantidad, inv.id_reg
FROM inv_inventario AS inv
INNER JOIN inv_product AS prod
ON inv.id_prod = prod.id_prod */


require( '../ssp.conexion.php' );
require( '../ssp.class.php' );

$table = 'inv_inventario_view';
$primaryKey = 'nom_prod';
$id_reg = $_POST['reg'];

$columns = array(
    array( 'db' => 'id_inv', 'dt' => 'id_inv' ),
    array( 'db' => 'id_prod', 'dt' => 'id_prod' ),
    array( 'db' => 'nom_prod', 'dt' => 'nom_prod' ),
    array( 'db' => 'img_prod', 'dt' => 'img_prod' ),
    array( 'db' => 'cantidad', 'dt' => 'cantidad' ),
    array( 'db' => 'id_reg', 'dt' => 'id_reg' ),
);

echo json_encode(
    SSP::complex($_POST, $conn, $table, $primaryKey, $columns, 'id_reg =' .$id_reg)
);



