<?php

// VIEW

/* create VIEW inv_mov_inventario_view 
AS SELECT mov.id_mov, mov.id_prod, prod.nom_prod, prod.img_prod, mov.razon, mov.razon_det, mov.cant_ant, mov.new_cant, mov.fec_mov, mov.usu_mov, usu.nom_usu
FROM inv_mov_inventario AS mov
INNER JOIN inv_product AS prod
ON mov.id_prod = prod.id_prod
INNER JOIN mq_reg AS reg
ON mov.id_reg = reg.id_reg
INNER JOIN mq_usu AS usu
ON mov.usu_mov = usu.id_usu; */


require( '../ssp.conexion.php' );
require( '../ssp.class.php' );

$table = 'inv_mov_inventario_view';
$primaryKey = 'id_mov';

$where = [];

if($_POST['razon'] != 'Todos'){;
    $where[] = 'razon = "'.$_POST['razon'].'"';
}

if($_POST['fecha1'] != '' && $_POST['fecha2'] != ''){
    $where[] = 'fec_mov BETWEEN "'.$_POST['fecha1'].'" AND "'.$_POST['fecha2'].'"';
}


$columns = array(
    array( 'db' => 'id_mov', 'dt' => 'id_mov' ),
    array( 'db' => 'id_prod', 'dt' => 'id_prod' ),
    array( 'db' => 'nom_prod', 'dt' => 'nom_prod' ),
    array( 'db' => 'img_prod', 'dt' => 'img_prod' ),
    array( 'db' => 'razon', 'dt' => 'razon' ),
    array( 'db' => 'razon_det', 'dt' => 'razon_det' ),
    array( 'db' => 'cant_ant', 'dt' => 'cant_ant' ),
    array( 'db' => 'new_cant', 'dt' => 'new_cant' ),
    array( 'db' => 'fec_mov', 'dt' => 'fec_mov' ),
    array( 'db' => 'usu_mov', 'dt' => 'usu_mov' ),
    array( 'db' => 'nom_usu', 'dt' => 'nom_usu' )
);


echo json_encode(
    SSP::complex($_POST, $conn, $table, $primaryKey, $columns, join('AND ', $where))
);





