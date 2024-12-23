<?php

 
// create VIEW eventos_view 
// AS SELECT a.id_act, a.mes_act, a.nom_act, a.cum_act, u.nom_usu 
// FROM ind_act AS a INNER JOIN mq_usu AS u 
// ON u.id_usu = a.id_usu


// SQL server connection information

require( 'ssp.conexion.php' );

include '../../resources/template/credentials.php';

 

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *

 * If you just want to use the basic configuration for DataTables with PHP

 * server-side, there is no need to edit below this line.

 */

 

require( 'ssp.class.php' );



        $table = 'eventos_view';

         

        // Table's primary key

        $primaryKey = 'id_act';

         

        // Array of database columns which should be read and sent back to DataTables.

        // The `db` parameter represents the column name in the database, while the `dt`

        // parameter represents the DataTables column identifier. In this case simple

        // indexes

        $columns = array(

            array( 'db' => 'id_act', 'dt' => 'id_act' ),

            array( 'db' => 'mes_act', 'dt' => 'mes_act' ),

            array( 'db' => 'nom_act', 'dt' => 'nom_act' ),

            array( 'db' => 'cum_act', 'dt' => 'cum_act' ),

            array( 'db' => 'nom_usu', 'dt' => 'nom_usu' ),

        );

        

         

        

         

        echo json_encode(

            SSP::simple($_POST, $conn, $table, $primaryKey, $columns)

        );



    

    