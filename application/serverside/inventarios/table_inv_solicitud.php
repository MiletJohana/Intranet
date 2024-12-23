<?php

// VIEW

/* create VIEW inv_solicitud_view 
AS SELECT sol.id_sol, sol.id_usu, usu.nom_usu, sol.est_sol, sol.fec_sol, sol.sol_elim, group_concat(sol_prod.id_prod separator ', ') AS id_products, group_concat(prod.img_prod separator ', ') AS img_products, group_concat(prod.nom_prod separator ', ') AS nom_products, group_concat(sol_prod.cant_sol separator ', ') AS cant_sol_products, est.nom_est_sol, est.color_est
FROM inv_solicitud AS sol
INNER JOIN inv_sol_x_prod AS sol_prod
ON sol.id_sol = sol_prod.id_sol
INNER JOIN inv_product AS prod
ON sol_prod.id_prod = prod.id_prod
INNER JOIN inv_est_sol AS est
ON sol.est_sol = est.id_est_sol
INNER JOIN mq_usu AS usu
ON sol.id_usu = usu.id_usu
group by sol.id_sol; */


require( '../ssp.conexion.php' );
require( '../ssp.class.php' );

$table = 'inv_solicitud_view';
$primaryKey = 'id_sol';

$where = [];

switch ($_POST['resp']) {
    case '1':
        $where[] = 'id_usu = "'.$_POST['id_usu'].'"';
        break;
    
    case '2':
        $where[] ='est_sol IN ('.$_POST['est_sol'].')';
        break;

    case '3':
        $where[] ='est_sol IN ('.$_POST['est_sol'].')';

        if($_POST['fecha1'] != '' && $_POST['fecha2'] != ''){
            $where[] = 'fec_sol BETWEEN "'.$_POST['fecha1'].'" AND "'.$_POST['fecha2'].'"';
        }

        if($_POST['empleado_mq'] != ''){;
            $where[] = 'id_usu = "'.$_POST['empleado_mq'].'"';
        }
        break;
}

$where[] ='sol_elim = 0';


$columns = array(
    array( 'db' => 'id_sol', 'dt' => 'id_sol' ),
    array( 'db' => 'id_usu', 'dt' => 'id_usu' ),
    array( 'db' => 'nom_usu', 'dt' => 'nom_usu' ),
    array( 'db' => 'est_sol', 'dt' => 'est_sol' ),
    array( 'db' => 'fec_sol', 'dt' => 'fec_sol' ),
    array( 'db' => 'sol_elim', 'dt' => 'sol_elim' ),
    array( 'db' => 'id_products', 'dt' => 'id_products' ),
    array( 'db' => 'img_products', 'dt' => 'img_products' ),
    array( 'db' => 'nom_products', 'dt' => 'nom_products' ),
    array( 'db' => 'cant_sol_products', 'dt' => 'cant_sol_products' ),
    array( 'db' => 'nom_est_sol', 'dt' => 'nom_est_sol' ),
    array( 'db' => 'color_est', 'dt' => 'color_est' ),
);


echo json_encode(
    SSP::complex($_POST, $conn, $table, $primaryKey, $columns, join('AND ', $where))
);





