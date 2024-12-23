<?php

// VIEW
/* create VIEW certiPersonal_view 
AS SELECT us.id_usu, us.nom_usu, car.nom_carg, us.fec_firm, us.fec_ret, us.tip_contrato FROM  mq_usu us , ind_cargos car WHERE us.id_carg=car.id_carg */


// DB table to use

$numTable = $_POST['numTable'];

$table = 'certiPersonal_view';

 

// Table's primary key

$primaryKey = 'id_usu';

 

// Array of database columns which should be read and sent back to DataTables.

// The `db` parameter represents the column name in the database, while the `dt`

// parameter represents the DataTables column identifier. In this case simple

// indexes

$columns = array(

    array( 'db' => 'id_usu', 'dt' => 'id_usu' ),

    array( 'db' => 'nom_usu',  'dt' => 'nom_usu' ),

    array( 'db' => 'nom_carg',   'dt' => 'nom_carg' ),

    array( 'db' => 'fec_firm',     'dt' => 'fec_firm' ),

    array( 'db' => 'tip_contrato',     'dt' => 'tip_contrato')

);



 

// SQL server connection information

require( 'ssp.conexion.php' );

 

 

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *

 * If you just want to use the basic configuration for DataTables with PHP

 * server-side, there is no need to edit below this line.

 */

 

require( 'ssp.class.php' );

 



switch ($numTable) {

    case '1':

        echo json_encode(

            SSP::complex($_POST, $conn, $table, $primaryKey, $columns, "fec_ret IS NULL")

        );

        break;



    case '2':

        echo json_encode(

            SSP::complex($_POST, $conn, $table, $primaryKey, $columns, "fec_ret!=''")

        );

        break;

}

