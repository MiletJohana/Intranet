<?php
 
// SQL server connection information
require( 'ssp.conexion.php' );
include '../../resources/template/credentials.php';

 
require( 'ssp.class.php' );


$table = 'diligencias_view';
 
// Table's primary key
$primaryKey = 'num_dlg';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'num_dlg', 'dt' => 'num_dlg' ),
    array( 'db' => 'nom_cli', 'dt' => 'nom_cli' ),
    array( 'db' => 'dia_dlg', 'dt' => 'dia_dlg' ),
    array( 'db' => 'dir_dlg', 'dt' => 'dir_dlg' ),
    array( 'db' => 'nom_tip_dlg', 'dt' => 'nom_tip_dlg' ),
    array( 'db' => 'dil_des', 'dt' => 'dil_des' ),
    array( 'db' => 'nom_est_dlg', 'dt' => 'nom_est_dlg' ),
    array( 'db' => 'nom_reg', 'dt' => 'nom_reg' ),
    array( 'db' => 'nom_res', 'dt' => 'nom_res' ),
    array( 'db' => 'est_dlg', 'dt' => 'est_dlg' ),
);

 

 
echo json_encode(
    SSP::simple($_POST, $conn, $table, $primaryKey, $columns)
);
