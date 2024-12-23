<?php
 
// SQL server connection information
require( 'ssp.conexion.php' );
include '../../resources/template/credentials.php';
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );

$table = 'ind_cargos';
 
// Table's primary key
$primaryKey = 'id_carg';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'id_carg', 'dt' => 'id_carg' ),
    array( 'db' => 'nom_carg', 'dt' => 'nom_carg' ),
    array( 'db' => 'rec_car', 'dt' => 'rec_car' ),
    array( 'db' => 'ent_car', 'dt' => 'ent_car' ),
    array( 'db' => 'pru_car', 'dt' => 'pru_car' ),
    array( 'db' => 'ana_car', 'dt' => 'ana_car' ),
    array( 'db' => 'pol_car', 'dt' => 'pol_car' ),
    array( 'db' => 'exa_car', 'dt' => 'exa_car' ),
    array( 'db' => 'tot_car', 'dt' => 'tot_car' ),
);

 

 
echo json_encode(
    SSP::simple($_POST, $conn, $table, $primaryKey, $columns)
);
