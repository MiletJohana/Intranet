<?php

// create view capacitaciones_view as SELECT c.id_cap, c.fue_cap, c.lug_cap, tc.tip_cap, c.obj_cap, c.tem_cap, c.resp_cap, a.nom_are, c.fec_cap, c.eva_cap, c.met_cap, c.real_cap, u.nom_usu 
// FROM ind_cap AS c INNER JOIN ind_tipcap AS tc ON c.id_tipcap = tc.id_tipcap 
// INNER JOIN mq_are AS a ON c.id_are = a.id_are INNER JOIN mq_usu AS u ON c.id_usu = u.id_usu
 


// SQL server connection information

require( 'ssp.conexion.php' );

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *

 * If you just want to use the basic configuration for DataTables with PHP

 * server-side, there is no need to edit below this line.

 */

 

require( 'ssp.class.php' );



        $table = 'capacitaciones_view';

         

        // Table's primary key

        $primaryKey = 'id_cap';

         

        // Array of database columns which should be read and sent back to DataTables.

        // The `db` parameter represents the column name in the database, while the `dt`

        // parameter represents the DataTables column identifier. In this case simple

        // indexes

        $columns = array(

            array( 'db' => 'id_cap', 'dt' => 'id_cap' ),

            array( 'db' => 'lug_cap', 'dt' => 'lug_cap' ),

            array( 'db' => 'tip_cap', 'dt' => 'tip_cap' ),

            array( 'db' => 'obj_cap', 'dt' => 'obj_cap' ),

            array( 'db' => 'tem_cap', 'dt' => 'tem_cap' ),

            array( 'db' => 'resp_cap' , 'dt' => 'resp_cap' ),

            array( 'db' => 'nom_are' , 'dt' => 'nom_are' ),

            array( 'db' => 'fec_cap' , 'dt' => 'fec_cap' ),

            array( 'db' => 'eva_cap' , 'dt' => 'eva_cap' ),

            array( 'db' => 'met_cap' , 'dt' => 'met_cap' ),

            array( 'db' => 'real_cap' , 'dt' => 'real_cap' ),

            array( 'db' => 'nom_usu' , 'dt' => 'nom_usu' ),      

            

        );

        

        

         

        echo json_encode(

            SSP::simple($_POST, $conn, $table, $primaryKey, $columns)

        );

    

      