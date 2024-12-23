<?php

// VIEW

/* create VIEW inv_sol_detallada_view
AS SELECT sol.id_sol, sol.id_usu, sol.est_sol, sol.fec_sol, sol.sol_elim, sol_prod.id_prod, prod.img_prod, prod.nom_prod, sol_prod.cant_sol, sol_prod.entregado, sol_prod.fec_ent, sol_prod.usu_ent, usu.nom_usu, sol_prod.aprob_prod, est.nom_est_sol, est.color_est
FROM inv_solicitud AS sol
INNER JOIN inv_sol_x_prod AS sol_prod
ON sol.id_sol = sol_prod.id_sol
INNER JOIN inv_product AS prod
ON sol_prod.id_prod = prod.id_prod
INNER JOIN inv_est_sol AS est
ON sol.est_sol = est.id_est_sol
LEFT JOIN mq_usu AS usu
ON sol_prod.usu_ent = usu.id_usu WHERE sol.sol_elim = 0; */


require( '../ssp.conexion.php' );
require( '../ssp.class.php' );

$table = 'inv_sol_detallada_view';
$primaryKey = 'id_sol';

$resp = $_POST['resp'];
$id_sol = $_POST['id_sol'];

$columns = array(
    array( 'db' => 'id_sol', 'dt' => 'id_sol' ),
    array( 'db' => 'id_usu', 'dt' => 'id_usu' ),
    array( 'db' => 'est_sol', 'dt' => 'est_sol' ),
    array( 'db' => 'fec_sol', 'dt' => 'fec_sol' ),
    array( 'db' => 'sol_elim', 'dt' => 'sol_elim' ),
    array( 'db' => 'id_prod', 'dt' => 'id_prod' ),
    array( 'db' => 'img_prod', 'dt' => 'img_prod' ),
    array( 'db' => 'nom_prod', 'dt' => 'nom_prod' ),
    array( 'db' => 'cant_sol', 'dt' => 'cant_sol' ),
    array( 'db' => 'entregado', 'dt' => 'entregado' ),
    array( 'db' => 'fec_ent', 'dt' => 'fec_ent' ),
    array( 'db' => 'usu_ent', 'dt' => 'usu_ent' ),
    array( 'db' => 'nom_usu', 'dt' => 'nom_usu' ),
    array( 'db' => 'aprob_prod', 'dt' => 'aprob_prod' ),
    array( 'db' => 'nom_est_sol', 'dt' => 'nom_est_sol' ),
    array( 'db' => 'color_est', 'dt' => 'color_est' ),
);

if ($resp == 1) {
    echo json_encode(
        SSP::complex($_POST, $conn, $table, $primaryKey, $columns, 'id_sol =' .$id_sol)
    );
} else if ($resp == 2) {
    echo json_encode(
        SSP::complex($_POST, $conn, $table, $primaryKey, $columns, 'id_sol =' .$id_sol. ' AND aprob_prod != 3 AND cant_sol != entregado')
    );
}



