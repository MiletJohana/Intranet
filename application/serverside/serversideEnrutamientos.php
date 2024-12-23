<?php

// VIEW
/* create VIEW enrutamientos_view 
AS SELECT a.num_enr, a.fec_enr, a.fec_crea, a.usu_upt, a.lst_upt, a.est_enr, a.cos_enr, a.id_reg, b.nom_reg FROM mq_enrt a ,mq_reg b WHERE a.id_reg = b.id_reg AND num_enr!=9999 */

require( 'ssp.conexion.php' );

require( 'ssp.class.php' );



$table = 'enrutamientos_view';

 

// Table's primary key

$primaryKey = 'num_enr';

 

// Array of database columns which should be read and sent back to DataTables.

// The `db` parameter represents the column name in the database, while the `dt`

// parameter represents the DataTables column identifier. In this case simple

// indexes

$columns = array(

    array( 'db' => 'num_enr', 'dt' => 'num_enr' ),

    array( 'db' => 'fec_crea',  'dt' => 'fec_crea' ),

    array( 'db' => 'usu_upt',   'dt' => 'usu_upt' ),

    array( 'db' => 'lst_upt',     'dt' => 'lst_upt' ),

    array( 'db' => 'est_enr',     'dt' => 'est_enr' ),

    array( 'db' => 'nom_reg',     'dt' => 'nom_reg' ),

);



 

echo json_encode(

    SSP::simple($_POST, $conn, $table, $primaryKey, $columns)

);

