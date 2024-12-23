<?php

// VIEW
/* create VIEW producto_escala_view 
AS SELECT product.*, info.post_title 
FROM wpgb_escala_producto AS product 
INNER JOIN wpgb_posts AS info 
ON product.id_producto = info.ID 
WHERE info.post_type = 'product'; */

require( 'ssp.conexion_fenaseo.php' );
require( '../ssp.class.php' );

$table = 'producto_escala_view';
$primaryKey = 'id';

$columns = array(
    array( 'db' => 'id', 'dt' => 'id' ),
    array( 'db' => 'id_producto', 'dt' => 'id_producto' ),
    array( 'db' => 'escala', 'dt' => 'escala' ),
    array( 'db' => 'precio', 'dt' => 'precio' ),
    array( 'db' => 'vol_min', 'dt' => 'vol_min' ),
    array( 'db' => 'color', 'dt' => 'color' ),
    array( 'db' => 'post_title', 'dt' => 'post_title' ),
);



 

echo json_encode(

    SSP::simple($_POST, $conn, $table, $primaryKey, $columns)

);

