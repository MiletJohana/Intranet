<?php
 
// SQL server connection information
require( 'ssp.conexion.php' );
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );

$table = 'mq_pers';
 
// Table's primary key
$primaryKey = 'id_per';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'id_per', 'dt' => 'id_per' ),
    array( 'db' => 'nom_per', 'dt' => 'nom_per' ),
    array( 'db' => 'emp_per', 'dt' => 'emp_per' ),
    array( 'db' => 'eps_per', 'dt' => 'eps_per' ),
    array( 'db' => 'arl_per', 'dt' => 'arl_per' ),
    array( 'db' => 'tel_per', 'dt' => 'tel_per' ),
    array( 'db' => 'con_per', 'dt' => 'con_per' ),
    array( 'db' => 'tel_con', 'dt' => 'tel_con' ),
);

 
echo json_encode(
    SSP::simple($_POST, $conn, $table, $primaryKey, $columns)
);
